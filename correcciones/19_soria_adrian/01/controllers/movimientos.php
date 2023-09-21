<?php

    class Movimientos extends Controller {

        function cuenta($param){

            # Inicia sesion
            sec_session_start();

            # compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else {
                $id = $param[0];
                //mostrara todos los movimientos
                $this->view->id = $id;
                $this->view->title = "Movimientos de la cuenta: " . $id;
                $this->view->movimientos = $this->model->getMovimientos($id);
                $this->view->render('movimientos/main/index');
                
                //en la carpeta views tengo que crear la carpeta movimientos
                //dentro de la carpeta movimientos creo main
                //en la main creo index.php que corresponde a la vista que muestra movimientos
            }
            
            
        }

        public function nuevo($param){

            // Inicio o continuo sesion
            sec_session_start();

            # compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['crear']))) {

                $_SESSION['mensaje'] = "Usuario sin privilegios";
                
                header("location:". URL. "cuentas");

            } else {
                // Crear objeto vacio de la clase movimiento
                $this->view->movimiento = new Movimiento();

                // Compruebo si existe algún error en la validación
                if (isset($_SESSION['error'])) {

                    // Mensaje de error
                    $this->view->error = $_SESSION['error'];
                    unset($_SESSION['error']);

                    // Autorrelleno del formulario
                    $this->view->movimiento = unserialize($_SESSION['movimiento']);
                    
                    unset($_SESSION['movimiento']);

                    // Cargo los errores especificos
                    $this->view->errores = $_SESSION['errores'];
                    unset($_SESSION['errores']);
                }

                $this->view->id = $param[0];
                // print_r( $id);
                // exit();
                //mostrara el formulario nuevo
                $this->view->title = "Formulario Nuevo Movimiento";
                $this->view->cuenta = $this->model->readCuenta($this->view->id);
                $this->view->tipos = ['I', 'R'];
                
                $this->view->render('movimientos/nuevo/index');
            }

            
        }

        public function create($param){

             # Inicia sesion
             sec_session_start();

             # compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['crear']))) {

                $_SESSION['mensaje'] = "Usuario sin privilegios";
                
                header("location:". URL. "cuentas");

            } else {
                # VALIDACION FORMULARIOS
                //1.Saneamos datos del formulario
                $saldo = $_POST['saldo'];
                $cantidad = filter_var($_POST['cantidad'] ??= '', FILTER_SANITIZE_NUMBER_FLOAT);
                $tipo = filter_var($_POST['tipo'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
                $concepto = filter_var($_POST['concepto'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
                $movimientos = filter_var($param[1] ??= '', FILTER_SANITIZE_NUMBER_INT);
                $id_cuenta = filter_var($param[0] ??= '', FILTER_SANITIZE_NUMBER_INT);

                //añadira un movimiento a la bd
                if($tipo == 'I'){
                    $saldo += $cantidad;
                } else {
                    $saldo -= $cantidad;
                }

                // 2.Creamos el objeto alumno con los datos saneados
                $new_movimiento = new Movimiento (
                    null,
                    $id_cuenta,
                    null,
                    $concepto,
                    $tipo,
                    $cantidad,
                    $saldo,
                    null,
                    null
            
                );

                // 3.Validación de los datos
                $errores = [];

                // Validamos el concepto
                // Valor obligatorio
                if (empty($concepto)){
                    $errores['concepto'] = 'Campo obligatorio';
                } else if (strlen($concepto) > 50) {
                    $errores['concepto'] = 'Concepto demasiado largo, máximo 50 caracteres';
                }

                // Validamos el tipo
                // Valor obligatorio

                $tipos = ["I", "R"];
                if (empty($tipo)){
                    $errores['tipo'] = 'Campo obligatorio';
                } else if (!in_array($tipo, $tipos)) {
                    $errores['tipo'] = 'Tipo seleccionado no es correcto';
                }


                // Validamos la cantidad
                // Valor obligatorio
                if (empty($cantidad)){
                    $errores['cantidad'] = 'Campo obligatorio';
                } else if ($cantidad == '0.00'){
                    $errores['cantidad'] = 'La cantidad no puede ser 0,00';
                }

                // 4. Comprobar validación 

                // Si $errores no está vacio el formulario no ha sido validado
                if (!empty($errores)){

                    //print_r($errores);
                    //exit();

                    $_SESSION['movimiento'] = Serialize($new_movimiento);
                    $_SESSION['error'] = "Fallo en la validación del formulario";
                    $_SESSION['errores'] = $errores;

                    # Redireccionamos a nuevo movimiento
                    header("location:" .URL. "movimientos/nuevo/".$id_cuenta);

                } else {

                    // Creamos movimiento
                    $this->model->create($new_movimiento);

                    $update_cuenta = new Cuenta (
                        //Actualizar cuenta
                        null,
                        null,
                        null,
                        null,
                        $new_movimiento->fecha_ul_mov = date('Y-m-d H:i:s'),
                        $new_movimiento->num_movtos = $movimientos + 1,
                        $new_movimiento->saldo = $saldo,
                        null,
                        null,
                    
                
                    );
                    
                    $this->model->update($update_cuenta, $id_cuenta);

                    // Redireccionamos
                    header('location:'.URL.'cuentas');

                    // Creamos mensaje
                    $_SESSION['mensaje'] = "Movimiento creado correctamente";

                }
            }

        }

        public function pdf($param){

            sec_session_start();

                
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else {
                // Compruebo si existe mensaje
                if (isset($_SESSION['mensaje'])) {
                    $this->view->mensaje = $_SESSION['mensaje'];
                    unset($_SESSION['mensaje']);
                }
                $id = $param[0];
                $movimientos = $this->model->getMovimientos($id);

        

                require('fpdf185/fpdf.php');
                require('class/pdfMovimientos.php');

                $pdf= new pdfMovimientos('P', 'mm', 'A4');

                $pdf->AliasNbPages();
                $pdf->AddPage();

                # Muestro el titulo del documento
                $pdf->Titulo();

                # Muestro el enncabezado de los movimiento
                $pdf->Linea_movim();

                $fondo = false;
                $pdf->SetFillColor(200);

                foreach($movimientos as $movimiento){

                    $pdf->Cell(10, 7, iconv ("UTF-8","ISO-8859-1", $movimiento->id), 'B', 0, 'R', $fondo);
                    $pdf->Cell(40, 7, iconv ("UTF-8","ISO-8859-1", $movimiento->cuenta), 'B', 0, 'L', $fondo);
                    $pdf->Cell(50, 7, iconv ("UTF-8","ISO-8859-1", $movimiento->fecha_hora), 'B', 0, 'L', $fondo);
                    $pdf->Cell(30, 7, iconv ("UTF-8","ISO-8859-15", $movimiento->tipo), 'B', 0, 'L', $fondo);
                    $pdf->Cell(30, 7, iconv ("UTF-8","ISO-8859-1", $movimiento->cantidad), 'B', 0, 'L', $fondo);
                    $pdf->Cell(30, 7, iconv ("UTF-8","ISO-8859-15", $movimiento->saldo), 'B', 1, 'L', $fondo);

                    $fondo = (!$fondo);
                };

                $pdf->Output("I", "movimientos.pdf", true);
            } 
        }

    }

?>