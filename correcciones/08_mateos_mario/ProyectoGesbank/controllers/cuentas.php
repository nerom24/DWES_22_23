<?php

class Cuentas extends Controller
{

    function render($param = [])
    {

        # inicio o continuo sesión
        sec_session_start();

        # Compruebo usuario autentificado
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:". URL. "login"); 
        } else {

        if (isset($_SESSION["mensaje"])) {
            $this->view->mensaje = $_SESSION["mensaje"];
            unset($_SESSION["mensaje"]);
        }
        // Mostrara todos los alumnos
        $this->view->title = "Tabla Cuentas";
        $this->view->cuentas = $this->model->get();
        $this->view->render("cuentas/main/index");
    }
    }

    function nuevo($param = []) {

        # Iniciamos o continuamos sesión
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:". URL. "login"); 
        } else if((!in_array($_SESSION['id_rol'],$GLOBALS['crear']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" .URL. "cuentas");
        } else {

        $this->view->cuenta = new Cuenta();

        if (isset($_SESSION["error"])) {

            $this->view->error = $_SESSION["error"];

            unset($_SESSION["error"]);

            $this->view->cuenta = unserialize($_SESSION["cuenta"]);
            unset($_SESSION["cuenta"]);

            $this->view->errores = $_SESSION["errores"];
            unset($_SESSION["errores"]);
        }

        // Metodo formulario nuevo cliente  
        $this->view->title = "Formulario cuenta nuevo";
        $this->view->clientes = $this->model->getClientes();
        $this->view->render("cuentas/nuevo/index");
    }
    }

    function create($param = [])
    {
        # inicio sesión
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:". URL. "login"); 
        } else if((!in_array($_SESSION['id_rol'],$GLOBALS['crear']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" .URL. "cuentas");
        } else {

        //Saneamos los datos del formulario Filter_sanitize

        $num_cuenta = filter_var($_POST['num_cuenta'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $id_cliente = filter_var($_POST['id_cliente'] ??= '', FILTER_SANITIZE_NUMBER_INT);
        $fecha_alta = filter_var($_POST['fecha_alta'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $saldo = filter_var($_POST['saldo'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

        $cuenta = new Cuenta(
            null,
            $num_cuenta,
            $id_cliente,
            $fecha_alta,
            0,
            0,
            $saldo,
            null,
            null
        );

        //Validacion datos

        $errores = [];

        //Validamos num_cuenta
        //Valor obligatorio


        $options = [
            'options' => [
                'regexp' => '/[0-9]{20}$/'
            ]
        ];
        if (empty($num_cuenta)) {
            $errores["num_cuenta"] = "Campo obligatorio.";
        } else if (!filter_var($num_cuenta, FILTER_VALIDATE_REGEXP, $options) && strlen($num_cuenta) != 20) {
            $errores["num_cuenta"] = "Formato incorrecto.";
        } else if (!$this->model->validarNumCuenta($num_cuenta)) {
            $errores["num_cuenta"] = "Numero de cuenta duplicado.";
        }

        //Validamos id_cliente
        //Valor obligatorio
        //valor numérico, ha de existir en la tabla clientes.

        if (empty($id_cliente)) {
            $errores["id_cliente"] = "Campo obligatorio.";
        } else if (!is_numeric($id_cliente)) {
            $errores["id_cliente"] = "No es numerico.";
        } else if (!$this->model->validarIdCliente($id_cliente)) {
            $errores["id_cliente"] = "No existe ese cliente.";
        }

        //Validamos fecha alta
        //valor obligatorio

        if (empty($fecha_alta)) {
            $errores["fecha_alta"] = "Campo obligatorio.";
        }

        //Comprobar validacion

        if (!empty($errores)) {
            //si errres no esta vacio el formulario no ha sido validado
            $_SESSION["cuenta"] = serialize($cuenta);
            $_SESSION["error"] = "Formulario no ha sido validado";
            $_SESSION["errores"] = $errores;

            //redireccionamos a nuevo alumno
            header('Location:' . URL . 'cuentas/nuevo');
        } else {

            $this->view->title = "Tabla Cuentas";
            $this->model->create($cuenta);
            $_SESSION["mensaje"] = "Cuenta creada correctamente";
            header("Location:" . URL . "cuentas");
        }
    }
    }


    function delete($param = []) {

        # inicio sesión
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:". URL. "login"); 
        } else if((!in_array($_SESSION['id_rol'],$GLOBALS['eliminar']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" .URL. "cuentas");
        } else {

        $id = $param[0];

        $this->model->delete($id);

        header("Location:" . URL . "cuentas");
    }
    }

    function editar($param = []) {

        # inicio sesión
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:". URL. "login"); 
        } else if((!in_array($_SESSION['id_rol'],$GLOBALS['editar']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" .URL. "cuentas");
        } else {

        $this->view->cuenta = new Cuenta();

        if (isset($_SESSION["error"])) {

            $this->view->error = $_SESSION["error"];

            unset($_SESSION["error"]);

            $this->view->cuenta = unserialize($_SESSION["cuenta"]);
            unset($_SESSION["cuenta"]);

            $this->view->errores = $_SESSION["errores"];
            unset($_SESSION["errores"]);
        }

        $this->view->id = $param[0];
        $this->view->title = "Formulario  editar cuenta";
        $this->view->clientes = $this->model->getClientes();
        $this->view->cuenta = $this->model->getCuenta($this->view->id);

        // formateamos la fecha
        $fechaf = (str_split($this->view->cuenta->fecha_alta));
        for ($i = 0; $i < 9; $i++) {
            array_pop($fechaf);
        }
        $fechafort = implode($fechaf);
        $this->view->cuenta->fecha_alta = $fechafort;

        $this->view->render("cuentas/editar/index");
    
    }
    }

    function update($param = [])
    {

        # inicio sesión
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:". URL. "login"); 
        } else if((!in_array($_SESSION['id_rol'],$GLOBALS['crear']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" .URL. "cuentas");
        } else {

        //Saneamos los datos del formulario Filter_sanitize

        $num_cuenta = filter_var($_POST['num_cuenta'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $id_cliente = filter_var($_POST['id_cliente'] ??= '', FILTER_SANITIZE_NUMBER_INT);
        $fecha_alta = filter_var($_POST['fecha_alta'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $saldo = filter_var($_POST['saldo'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

        $edit_cuenta = new Cuenta(
            null,
            $num_cuenta,
            $id_cliente,
            $fecha_alta,
            null,
            null,
            $saldo,
            null,
            null
        );

        //Validacion datos

        $errores = [];

        //Validamos id_cliente
        //Valor obligatorio
        //valor numérico, ha de existir en la tabla clientes.

        if (empty($id_cliente)) {
            $errores["id_cliente"] = "Campo obligatorio.";
        } else if (!is_numeric($id_cliente)) {
            $errores["id_cliente"] = "No es numerico.";
        } else if (!$this->model->validarIdCliente($id_cliente)) {
            $errores["id_cliente"] = "No existe ese cliente.";
        }

        //Comprobar validacion

        if (!empty($errores)) {
            //si errres no esta vacio el formulario no ha sido validado
            $_SESSION["cuenta"] = serialize($edit_cuenta);
            $_SESSION["error"] = "Formulario no ha sido validado";
            $_SESSION["errores"] = $errores;

            //redireccionamos a nuevo alumno
            header('Location:' . URL . 'cuentas/editar/' . $param[0]);
        } else {

            $this->view->title = "Tabla Cuentas";
            $this->model->update($param[0], $edit_cuenta);
            $_SESSION["mensaje"] = "Cuenta modificada correctamente";
            header("Location:" . URL . "cuentas");
        }
    }
    }

    function mostrar($param = []) {

        # inicio sesión
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:". URL. "login"); 
        } else if((!in_array($_SESSION['id_rol'],$GLOBALS['mostrar']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" .URL. "cuentas");
        } else {

        $id = $param[0];
        $this->view->title = "Formulario Cuenta Mostar";
        $this->view->clientes = $this->model->getClientes();
        $this->view->cuenta = $this->model->getCuenta($id);

        $fechaf = (str_split($this->view->cuenta->fecha_alta));
        for ($i = 0; $i < 9; $i++) {
            array_pop($fechaf);
        }
        $fechafort = implode($fechaf);
        $this->view->cuenta->fecha_alta = $fechafort;

        $this->view->render("cuentas/mostrar/index");
    }
    }

    function ordenar($param = []) {

        # inicio sesión
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:". URL. "login"); 
        } else if((!in_array($_SESSION['id_rol'],$GLOBALS['ordenar']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" .URL. "cuentas");
        } else {

        $criterio = $param[0];
        $this->view->title = "Tabla Cuentas";
        $this->view->cuentas = $this->model->order($criterio);
        $this->view->render("cuentas/main/index");
    }
    }

    function buscar($param = []) {

        # inicio sesión
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:". URL. "login"); 
        } else if((!in_array($_SESSION['id_rol'],$GLOBALS['buscar']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" .URL. "cuentas");
        } else {

        $expresion = $_GET["expresion"];
        $this->view->title = "Tabla Cuentas";
        $this->view->cuentas = $this->model->filter($expresion);
        $this->view->render("cuentas/main/index");
    }   
    }

    public function Pdf($param = []) {

        # inicio sesión
        sec_session_start();

         if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            
            header("location:". URL. "login");
            
        } else {

            $cuentas=$this->model->get();
            
            $pdf=new pdfCuenta('P', 'mm', 'A4');

            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->Titulo();
            $pdf->CabListadoArticulos();
        
            foreach ($cuentas as $cuenta){
                $pdf->Cell(10, 7, iconv('UTF-8', 'ISO-8859-1', $cuenta->id), 'B', 0, 'R', true);
                $pdf->Cell(20, 7, iconv('UTF-8', 'ISO-8859-1', $cuenta->num_cuenta), 'B', 0, 'L', true);
                $pdf->Cell(40, 7, iconv('UTF-8', 'ISO-8859-1', $cuenta->id_cliente), 'B', 0, 'L', true);
                $pdf->Cell(50, 7, iconv('UTF-8', 'ISO-8859-1', $cuenta->fecha_alta), 'B', 0, 'L', true);
                $pdf->Cell(30, 7, iconv('UTF-8', 'ISO-8859-1', $cuenta->num_movtos), 'B', 0, 'L', true);
                $pdf->Cell(40, 7, iconv('UTF-8', 'ISO-8859-1', $cuenta->saldo), 'B', 1, 'L', true);
            };
             
            ob_end_clean();
            $pdf->Output("I", "doc.pdf", true);
        }

    }
}   