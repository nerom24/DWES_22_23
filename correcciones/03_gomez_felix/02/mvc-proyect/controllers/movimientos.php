<?php

class Movimientos extends Controller
{

    function cuenta($param = [])
    {
        sec_session_start();

        if (!isset($_SESSION['id'])) {

            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else {
            if (isset($_SESSION["mensaje"])) {

                $this->view->mensaje = $_SESSION["mensaje"];
                unset($_SESSION["mensaje"]);
            }
        }


        $this->view->title = "Tabla Movimientos de la cuenta:" . $param[0];
        $this->view->id = $param[0];
        $this->view->movimientos = $this->model->get($this->view->id);
        $this->view->render("movimientos/cuenta/index");
    }

    function nuevo($param = [])
    {

        sec_session_start();

        if (!isset($_SESSION['id'])) {

            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else if (!in_array($_SESSION["id_rol"], $GLOBALS["crear"])) {

            $_SESSION['mensaje'] = "Usuario sin privilegios";
            header("location:" . URL . "cuentas");
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

    function create($param = [])
    {

        //inicio sesion 

        sec_session_start();

        if (!isset($_SESSION['id'])) {

            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else if(!in_array($_SESSION["id_rol"],$GLOBALS["crear"])) {

            $_SESSION['mensaje'] = "Usuario sin privilegios";
            header("location:". URL. "cuentas");

        }else{
            //Saneamos los datos del formulario Filter_sanitize

            $cantidad = filter_var($_POST['cantidad'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

            if ($_POST['tipo'] == "R") {
                $cantidad = "-" . $cantidad;
            }
            $cantidad = floatval($cantidad);

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

            // Concepto. Obligatorio, tamaño máximo 50 caracteres
            if (empty($concepto)) {
                $errores["concepto"] = "Campo obligatorio.";
            } else if (strlen($concepto) > 50) {
                $errores["concepto"] = "concepto superior a 50 caracteres.";
            }

            // Tipo. Obligatorio, podrá ser 'I', 'R', ''
            if (empty($tipo)) {
                $errores["tipo"] = "Campo obligatorio.";
            } else if (!in_array($tipo, ["R", "I", ""])) {
                $errores["tipo"] = "Tipo no permitido";
            }

            // Cantidad. Obligatorio, valor de tipo float.
            if (empty($cantidad)) {

                $errores["cantidad"] = "Campo obligatorio.";
            } else if (!is_float($cantidad)) {
                $errores["cantidad"] = "Cantidad formato incorrecto";
            }

            //Comprobar validacion

            if (!empty($errores)) {
                //si errres no esta vacio el formulario no ha sido validado
                $_SESSION["mov"] = serialize($mov);
                $_SESSION["error"] = "Formulario no ha sido validado";
                $_SESSION["errores"] = $errores;

                //redireccionamos a nuevo alumno
                header('Location:' . URL . 'movimientos/nuevo/' . $id_cliente);
            } else {

                $this->view->title = "Tabla Movimientos";
                $this->model->create($mov, $id_cliente);
                $_SESSION["mensaje"] = "Movimiento creado correctamente";
                header("Location:" . URL . "movimientos/" . "cuenta/" . $id_cliente);
            }
        }
    }


    public function pdf($param = [])
    {

        sec_session_start();
        # Compruebo usuario autentificado
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");
        } else {

            $movimientos = $this->model->get($param[0]);

            $pdf = new pdfMovimiento('P', 'mm', 'A4');

            $pdf->AliasNbPages();

            $pdf->AddPage();
            // Muestra el titulo del documento
            $pdf->Titulo();
            $pdf->CabListadoMovimiento();
            $pdf->SetFillColor(200);
            $fondo=true;
            foreach ($movimientos as $mov) {

                $pdf->Cell(10, 7, iconv('UTF-8', 'ISO-8859-1', $mov->id), 'B', 0, 'L', $fondo);
                $pdf->Cell(40, 7, iconv('UTF-8', 'ISO-8859-1', $mov->num_cuenta), 'B', 0, 'L', $fondo);
                $pdf->Cell(40, 7, iconv('UTF-8', 'ISO-8859-1', $mov->fecha_hora), 'B', 0, 'L', $fondo);
                $pdf->Cell(40, 7, iconv('UTF-8', 'ISO-8859-1', $mov->concepto), 'B', 0, 'L', $fondo);
                $pdf->Cell(10, 7, iconv('UTF-8', 'ISO-8859-1', $mov->tipo), 'B', 0, 'L', $fondo);
                $pdf->Cell(20, 7, iconv('UTF-8', 'ISO-8859-1', $mov->cantidad), 'B', 0, 'R', $fondo);
                $pdf->Cell(20, 7, iconv('UTF-8', 'ISO-8859-1', $mov->saldo), 'B', 1, 'R', $fondo);
                $fondo=!($fondo);

            };
            // sirve para limpiar el buffer de salida y además deshabilitarlo. Es decir, termina de trabajar con el bufer y además descarta todos los cambios que se hubieran incluido en el bufer.
            ob_end_clean();
            $pdf->Output("I", "movimientos.pdf", true);
        }
    }


}