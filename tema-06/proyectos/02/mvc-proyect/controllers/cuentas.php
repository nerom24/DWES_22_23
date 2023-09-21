<?php

class Cuentas extends Controller
{

    function render($param = [])
    {
        // Mostrara todos los alumnos
        $this->view->title = "Tabla Cuentas";
        $this->view->cuentas = $this->model->get();
        $this->view->render("cuentas/main/index");
    }

    function nuevo($param = [])
    {
        // Metodo formulario nuevo cliente  
        $this->view->title = "Formulario cuenta nuevo";
        $this->view->clientes= $this->model->getClientes();
        $this->view->render("cuentas/nuevo/index");
    }

    function create($param = [])
    {
        $cuenta = new Cuenta(
            null,
            $_POST["num_cuenta"],
            $_POST["id_cliente"],
            $_POST["fecha_alta"],
            date("d-m-Y H:i:s"),
            0,
            $_POST["saldo"],
            null,
            null
        );
        $this->model->create($cuenta);
        header("Location:" . URL . "cuentas");
    }

    
    function delete($param = [])
    {
        $id=$param[0];
        $this->model->delete($id);
        header("Location:" . URL . "cuentas");
    }

    function editar($param = [])
    {
        $this->view->id = $param[0];
        $this->view->title = "Formulario  editar cuenta";
        $this->view->clientes = $this->model->getClientes();
        $this->view->cuenta = $this->model->getCuenta($this->view->id);
        
        // formateamos la fecha
        $fechaf=(str_split($this->view->cuenta->fecha_alta));
        for ($i=0; $i <9 ; $i++) { 
            array_pop($fechaf);
        }
        $fechafort=implode($fechaf);
        $this->view->cuenta->fecha_alta=$fechafort;

        $this->view->render("cuentas/editar/index");
    }

    function update($param = [])
    {
        $cuenta = new Cuenta(
            null,
            $_POST["num_cuenta"],
            $_POST["id_cliente"],
            $_POST["fecha_alta"],
            null,
            null,
            $_POST["saldo"],
            null,
            null
        );

        $this->model->update($param[0], $cuenta);
        header("Location:" . URL . "cuentas");
    }

    

    function mostrar($param = [])
    {
        $id = $param[0];
        $this->view->title = "Formulario Cuenta Mostar";
        $this->view->clientes = $this->model->getClientes();
        $this->view->cuenta = $this->model->getCuenta($id);
        // formateamos la fecha
        $fechaf=(str_split($this->view->cuenta->fecha_alta));
        for ($i=0; $i <9 ; $i++) { 
            array_pop($fechaf);
        }
        $fechafort=implode($fechaf);
        $this->view->cuenta->fecha_alta=$fechafort;

        $this->view->render("cuentas/mostrar/index");
    }

    function ordenar($param=[])
    {
        $criterio=$param[0];
        $this->view->title = "Tabla Cuentas";
        $this->view->cuentas=$this->model->order($criterio);
        $this->view->render("cuentas/main/index");

    }

    function buscar($param=[])
    {
        $expresion=$_GET["expresion"];
        $this->view->title = "Tabla Cuentas";
        $this->view->cuentas= $this->model->filter($expresion);
        $this->view->render("cuentas/main/index");
    }
}
