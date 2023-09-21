<?php

class Main extends Controller
{

    function __construct()
    {

        parent::__construct();
    }

    function render()
    {
        sec_session_start();
        if (isset($_SESSION["mensaje"])) {

            $this->view->mensaje = $_SESSION["mensaje"];
            unset($_SESSION["mensaje"]);
        }
        $this->view->render('main/index');
    }
}
