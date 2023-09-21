<?php

    class Main Extends Controller {

        function __construct() {

            parent ::__construct();
            
            
        }

        function render() {

            //Actualizo el titulo de la página
            $this->view->title = "Home - Proyecto - Albumes";

            $this->view->render('main/index');
        }
    }

?>