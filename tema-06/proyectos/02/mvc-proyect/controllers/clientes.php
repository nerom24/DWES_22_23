<?php

class Clientes extends Controller
{

    function render($param = [])
    {
        // Mostrara todos los alumnos
        $this->view->title = "Tabla Clientes";
        $this->view->clientes = $this->model->get();
        $this->view->render("clientes/main/index");
    }

    function nuevo($param = [])
    {
        // Metodo formulario nuevo cliente  
        $this->view->title = "Formulario cliente nuevo";
        $this->view->render("clientes/nuevo/index");
    }

    function create($param = [])
    {
        $cliente = new Cliente(
            null,
            $_POST["apellidos"],
            $_POST["nombre"],
            $_POST["telefono"],
            $_POST["ciudad"],
            $_POST["dni"],
            $_POST["email"],
            null,
            null
        );

        $this->model->create($cliente);
        header("Location:" . URL . "clientes");
    }

    
    function delete($param = [])
    {
        $id=$param[0];
        $this->model->delete($id);
        header("Location:" . URL . "clientes");
    }

    function editar($param = [])
    {
        $this->view->id = $param[0];
        $this->view->title = "Formulario  editar cliente";
        $this->view->cliente = $this->model->getCliente($this->view->id);
        $this->view->render("clientes/editar/index");
    }

    function update($param = [])
    {
        $cliente = new Cliente(
            null,
            $_POST["apellidos"],
            $_POST["nombre"],
            $_POST["telefono"],
            $_POST["ciudad"],
            $_POST["dni"],
            $_POST["email"],
            null,
            null
        );

        $this->model->update($param[0], $cliente);
        header("Location:" . URL . "clientes");
    }

    

    function mostrar($param = [])
    {
        $id = $param[0];
        $this->view->title = "Formulario Cliente Mostar";
        $this->view->cliente=$this->model->getCliente($id);
        $this->view->render("clientes/mostrar/index");
    }

    function ordenar($param=[])
    {
        $criterio=$param[0];
        $this->view->title = "Tabla Clientes";
        $this->view->clientes=$this->model->order($criterio);
        $this->view->render("clientes/main/index");

    }

    function buscar($param=[])
    {
        $expresion=$_GET["expresion"];
        $this->view->title = "Tabla Clientes";
        $this->view->clientes= $this->model->filter($expresion);
        $this->view->render("clientes/main/index");
    }
}
