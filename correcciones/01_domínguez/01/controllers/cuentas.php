<?php

    class Cuentas extends Controller {

        function render(){

            // Inicio o continuo sesion
            sec_session_start();

            # compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else {
                // Compruebo si existe mensaje
                if (isset($_SESSION['mensaje'])) {
                    $this->view->mensaje = $_SESSION['mensaje'];
                    unset($_SESSION['mensaje']);
                }

                //mostrara todos los cuentas
                $this->view->title = "Tabla Cuentas";
                $this->view->cuentas = $this->model->get();
                $this->view->render('cuentas/main/index');

                //en la carpeta views tengo que crear la carpeta cuentas
                //dentro de la carpeta cuentas creo main
                //en la main creo index.php que corresponde a la vista que muestra cuentas
            }
        }

        public function nuevo(){

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
                // Crear objeto vacio de la clase alumno
                $this->view->cuenta = new Cuenta();

                // Compruebo si existe algún error en la validación
                if (isset($_SESSION['error'])) {

                    // Mensaje de error
                    $this->view->error = $_SESSION['error'];
                    unset($_SESSION['error']);

                    // Autorrelleno del formulario
                    $this->view->cuenta = unserialize($_SESSION['cuenta']);
                    unset($_SESSION['cuenta']);

                    // Cargo los errores especificos
                    $this->view->errores = $_SESSION['errores'];
                    unset($_SESSION['errores']);
                }
                //mostrara el formulario nuevo
                $this->view->title = "Formulario Nuevo Cuenta";
                $this->view->clientes = $this->model->getClientes();
                $this->view->render('cuentas/nuevo/index');
            }
        }

        public function create(){
            //añadira un Cuenta a la bd

             # Inicia sesion
             sec_session_start();

             if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['crear']))) {

                $_SESSION['mensaje'] = "Usuario sin privilegios";
                
                header("location:". URL. "cuentas");

            } else {

                # VALIDACION FORMULARIOS
                // 1.Saneamos datos del formulario
                $num_cuenta = filter_var($_POST['num_cuenta'] ??= '', FILTER_SANITIZE_NUMBER_INT);
                $id = filter_var($_POST['id'] ??= '', FILTER_SANITIZE_NUMBER_INT);
                $saldo = filter_var($_POST['saldo'] ??= '', FILTER_SANITIZE_NUMBER_INT);

                // 2.Creamos el objeto alumno con los datos saneados
                $new_cuenta = new Cuenta(
                    null,
                    $num_cuenta,
                    $id,
                    null,
                    null,
                    null,
                    $saldo,                
                    null,
                    null
                );

                // 3.Validación de los datos
                $errores = [];

                // Validamos el num_cuenta
                // Valor obligatorio
                $options = [
                    'options' => [
                        'regexp' => "/[a-zA-Z](2)[0-9](20)/"
                        ]
                ];

                if (empty($num_cuenta)){
                    $errores['num_cuenta'] = 'Campo obligatorio';
                } else if (!filter_var($num_cuenta, FILTER_VALIDATE_REGEXP, $options)){
                    $errores['num_cuenta'] = 'Cuenta con formato incorrecto';
                } else if (!$this->model->validarCuentas($num_cuenta)){
                    $errores['num_cuenta'] = 'Cuenta en uso';
                }

                // Validamos los id_cliente
                // Valor obligatorio
                if (empty($id)){
                    $errores['id'] = 'Campo obligatorio';
                } else if (!filter_var($id,  FILTER_VALIDATE_INT)){
                    $errores['id'] = 'Curso no válido';
                } else if (!$this->model->validarIdcliente($id)){
                    $errores['id'] = 'Curso no existe';
                }
                // Validamos saldo
                // Campo opcional

                // 4. Comprobar validación 

                // Si $errores no está vacio el formulario no ha sido validado
                if (!empty($errores)){

                    $_SESSION['cuenta'] = Serialize($new_cuenta);
                    $_SESSION['error'] = "Fallo en la validación del formulario";
                    $_SESSION['errores'] = $errores;

                    # Redireccionamos a nueva cuenta
                    header("location:" .URL. "cuentas/nuevo");

                } else {

                    // Creamos alumno
                    // print_r($new_Cuenta);
                    // exit();
                    $this->model->create($new_cuenta);

                    // Creamos mensaje
                    $_SESSION['mensaje'] = "Cuenta creada correctamente";

                    // Redireccionamos
                    header('location:'.URL.'cuentas');
                }
            }
        }

        public function editar($param){
            //mostrara un formulario para editar

            // Inicio o continuo sesion
            sec_session_start();

            # compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {

                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                header("location:". URL. "login");
                
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['editar']))) {

                $_SESSION['mensaje'] = "Usuario sin privilegios";
                header("location:". URL. "cuentas");

            } else {

                # obtengo el id del cuenta
                $this->view->id = $param[0];

                # obtengo el objeto de la clase cuenta
                $this->view->cuenta = $this->model->readCuenta($this->view->id);

                # Comprobar si el formulario viene de una no validación
                if(isset($_SESSION['error'])){

                    # Mensaje de error
                    $this->view->error = $_SESSION['error'];
                    unset($_SESSION['error']);

                    # Autorrelleno del formulario
                    $this->view->cuenta = unserialize($_SESSION['cuenta']);
                    unset($_SESSION['cuenta']);

                    # Cargo los errores específicos
                    $this->view->errores = $_SESSION['errores'];
                    unset($_SESSION['errores']);
                }
                $this->view->id = $param[0];
                $this->view->title = "Formulario Editar Cuenta";
                $this->view->cuenta = $this->model->readCuenta($this->view->id);
                $this->view->clientes = $this->model->getClientes();

                $this->view->render('cuentas/editar/index');
            }
        }

        public function update($param){

            # Inicia sesion
            sec_session_start();

            # compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {

                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                header("location:". URL. "login");
                
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['editar']))) {

                $_SESSION['mensaje'] = "Usuario sin privilegios";
                header("location:". URL. "cuentas");

            } else {
                 # VALIDACION FORMULARIOS
                //1.Saneamos datos del formulario
                $id_cliente = filter_var($_POST['id'] ??= '', FILTER_SANITIZE_NUMBER_INT);
                
                // Detalles de la cuenta que voy a actualizar
                $id = $param[0];
        
                // Obtengo el objeto de dicha cuenta
                $cuenta = $this->model->readCuenta($id);
                $cuenta->id_cliente = $id_cliente;

                // Validación editar cuenta (Solo validará en caso de modificación de un detalle)
                $errores = [];
        
                if ($cuenta->id_cliente != $id_cliente) {
                    if (empty($id_cliente)){
                        $errores['cliente'] = 'Campo obligatorio';
                    } else if (!$this->model->validarCliente($id)){
                        $errores['cliente'] = 'Cliente no encontrado';
                    }
                }
        
                // Si $errores no está vacio el formulario no ha sido validado
                if (!empty($errores)){
        
                    $_SESSION['cuenta'] = Serialize($cuenta);
                    $_SESSION['error'] = "Fallo en la validación del formulario";
                    $_SESSION['errores'] = $errores;
        
                    # Redireccionamos a nueva cuenta
                    header("location:" .URL. "cuentas/nuevo/".$id);
        
                } else {
        
                    // Actualizamos cuetna
                    $this->model->update($cuenta, $id);
        
                    // Creamos mensaje
                    $_SESSION['mensaje'] = "Cuenta actualizada correctamente";
        
                    // Redireccionamos
                    header('location:'.URL.'cuentas');
                }
            }
        }

        public function mostrar($param){

            # Inicia sesion
            sec_session_start();

            # compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['mostrar']))) {

                $_SESSION['mensaje'] = "Usuario sin privilegios";
                
                header("location:". URL. "cuentas");

            } else {
               # obtengo el id del cuenta
               $this->view->id = $param[0];

               # título de la vista
               $this->view->title= "Formulario Mostrar cuenta";

               # obtener los cursos generar dinamicamente combox de cursos
               $this->view->cuenta = $this->model->readcuenta($this->view->id);

               $this->view->render('cuentas/mostrar/index');
            }
        }

        public function delete($param){
            # Inicia sesion
            sec_session_start();

            # compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['eliminar']))) {

                $_SESSION['mensaje'] = "Usuario sin privilegios";
                
                header("location:". URL. "cuentas");

            } else {
                //eliminara el Cuenta
                $this->model->delete($param[0]);

                header('location:'.URL.'cuentas');
            }
        }

        public function order($param){
            //ordenara los cuentas
           # Inicia sesion
           sec_session_start();
           # compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['ordenar']))) {

                $_SESSION['mensaje'] = "Usuario sin privilegios";
                
                header("location:". URL. "cuentas");

            } else {
                $criterio = htmlspecialchars($param[0]);
                $this->view->title = "Ordenar Cuenta por " . $criterio;
                $this->view->cuentas = $this->model->order($criterio);
                $this->view->render('cuentas/main/index');
            }
        }
           

        public function filter(){
            //filtrara los cuentas
            # Inicia sesion
            sec_session_start();

            # compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['buscar']))) {

                $_SESSION['mensaje'] = "Usuario sin privilegios";
                
                header("location:". URL. "cuentas");

            } else {
                $expresion = $_GET["expresion"];
                
                $this->view->title = "Filtrar Cuenta por " .$expresion;
                $this->view->cuentas = $this->model->filter($expresion);

                $this->view->render('cuentas/main/index');
            }
        }

        public function pdf(){
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
                $cuentas = $this->model->get();

                require('fpdf185/fpdf.php');
                require('class/pdfCuentas.php');

                $pdf= new pdfCuentas('P', 'mm', 'A4');

                $pdf->AliasNbPages();
                $pdf->AddPage();

                $pdf->Titulo();
                # Muestro el enncabezado de los articulos
                $pdf->encabezado();

                foreach($cuentas as $cuenta){
                    $pdf->Cell(10, 7, iconv ("UTF-8","ISO-8859-1", $cuenta->id), 'B', 0, 'R');
                    $pdf->Cell(45, 7, iconv ("UTF-8","ISO-8859-1", $cuenta->num_cuenta), 'B', 0, 'R');
                    $pdf->Cell(40, 7, iconv ("UTF-8","ISO-8859-1", $cuenta->nombre), 'B', 0, 'L');
                    $pdf->Cell(35, 7, iconv ("UTF-8","ISO-8859-1", $cuenta->fecha_alta), 'B', 0, 'R');
                    $pdf->Cell(40, 7, iconv ("UTF-8","ISO-8859-1", $cuenta->fecha_ul_mov), 'B', 0, 'R');
                    $pdf->Cell(20, 7, iconv ("UTF-8","ISO-8859-15", $cuenta->saldo), 'B', 1, 'R');
                };
                ob_end_clean();
                $pdf->Output("I", "cuentas.pdf", true);
            }
        }
    }

?>