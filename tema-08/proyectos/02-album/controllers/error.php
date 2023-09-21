<?php

    class Errores extends Controller {

        function __construct() {

            parent ::__construct();
            //Actualizo el titulo de la página
            $this->view->title = "Error - Album - Albumes";
            $this->view->mensaje = "URL no existente";
            $this->view->render('error/index');
        }

      

    }

?>