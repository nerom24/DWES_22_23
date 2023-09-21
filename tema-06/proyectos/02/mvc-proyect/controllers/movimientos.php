<?php

class Movimientos extends Controller
{

    function cuenta($param = [])
    {
        $this->view->title = "Tabla Movimientos de la cuenta:" . $param[0];
        $this->view->id = $param[0];
        $this->view->movimientos = $this->model->get($this->view->id);
        $this->view->render("movimientos/cuenta/index");
    }

    function nuevo($param = [])
    {

        $this->view->id = $param[0];
        $this->view->title = "Formulario Movimiento nuevo";
        $this->view->cuenta = $this->model->getCuenta($this->view->id);
        $this->view->render("movimientos/nuevo/index");
    }

    function create($param = [])
    {
        $cantidad=$_POST['cantidad'];

        if ($_POST['tipo'] == "R") {
            $cantidad="-".$_POST['cantidad'];
        }

        $mov = new Movimiento(

            null,
            $param[0],
            date("Y-m-d H:i:s"),
            $_POST["concepto"],
            $_POST["tipo"],
            $cantidad,
            null,
            null,
            null
        );

        $this->model->create($mov,$param[0]);
        header("Location:" . URL . "movimientos/"."cuenta/".$param[0]);
    }

}
