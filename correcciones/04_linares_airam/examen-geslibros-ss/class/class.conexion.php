<?php

    /*
        Clase conexion

        Mediante PDO
    */

    class Conexion {

        protected $pdo;

        public function __construct() {

            try {
            
                $dsn = "mysql:host=" . SERVER . ";dbname=". BD;

                $options = [

                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_PERSISTENT =>  false,
                    PDO::ATTR_EMULATE_PREPARES =>  false,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES ".CHARSET. " COLLATE ". COLECCION
                    
                ];

                $this->pdo = new PDO($dsn, USER, PASS, $options);

    } catch (PDOException $error){

        include_once('views/partials/errorDB.php');
        exit();

    }


    }
    }


?>