<?php

class Movimientos extends Controller
{

    function cuenta($param = [])
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

        $this->view->title = "Tabla Movimientos de la cuenta: " . $param[0];
        $this->view->id = $param[0];
        $this->view->movimientos = $this->model->get($this->view->id);
        $this->view->render("movimientos/cuenta/index");
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
            header("location:" .URL. "movimientos");
        } else {

        $this->view->mov = new Movimiento();

        if (isset($_SESSION["error"])) {

            $this->view->error = $_SESSION["error"];

            unset($_SESSION["error"]);

            $this->view->mov = unserialize($_SESSION["mov"]);
            unset($_SESSION["mov"]);

            $this->view->errores = $_SESSION["errores"];
            unset($_SESSION["errores"]);
        }

        $this->view->id = $param[0];
        $this->view->title = "Formulario Movimiento nuevo";
        $this->view->cuenta = $this->model->getCuenta($this->view->id);
        $this->view->render("movimientos/nuevo/index");
    }
    }

    function create($param = []) {

        # inicio sesión
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:". URL. "login"); 
        } else if((!in_array($_SESSION['id_rol'],$GLOBALS['crear']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" .URL. "movimientos");
        } else {

        //Saneamos los datos
        $cantidad = filter_var($_POST['cantidad'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $cantidad = floatval($cantidad);
        
        if ($_POST['tipo'] == "R") {
            $cantidad = "-" . $cantidad;
        }

        $concepto = filter_var($_POST['concepto'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $tipo = filter_var($_POST['tipo'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $id_cliente = filter_var($param[0] ??= '', FILTER_SANITIZE_NUMBER_INT);

        $mov = new Movimiento(

            null,
            $id_cliente,
            date("Y-m-d H:i:s"),
            $concepto,
            $tipo,
            $cantidad,
            null,
            null,
            null
        );

        // Concepto
        if (empty($concepto)) {
            $errores["concepto"] = "Campo obligatorio.";
        } else if (strlen($concepto) > 50) {
            $errores["concepto"] = "concepto superior a 50 caracteres.";
        }

        // Tipo
        if (empty($tipo)) {
            $errores["tipo"] = "Campo obligatorio.";
        } else if (!in_array($tipo, ["R", "I", ""])) {
            $errores["tipo"] = "Tipo no permitido";
        }

        // Cantidad
        if (empty($cantidad)) {

            $errores["cantidad"] = "Campo obligatorio.";
        } else if (!is_float($cantidad)) {
            $errores["cantidad"] = "Cantidad formato incorrecto";
        }

        //Comprobar validacion

        if (!empty($errores)) {

            $_SESSION["mov"] = serialize($mov);
            $_SESSION["error"] = "Formulario no ha sido validado";
            $_SESSION["errores"] = $errores;

            header('Location:' . URL . 'movimientos/nuevo/' . $id_cliente);
        } else {

            $this->view->title = "Tabla Movimientos";
            $this->model->create($mov, $id_cliente);
            $_SESSION["mensaje"] = "Movimiento creado correctamente";
            header("Location:" . URL . "movimientos/" . "cuenta/" . $id_cliente);
        }
    }
    }
}
