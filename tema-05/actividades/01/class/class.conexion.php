<?php

    /*
        Clase conexion

        Clase que me contectará con la base de datos
    */

    class Conexion {

        public $conexion;

        public function __construct() {
            
            $this->conexion = new mysqli('localhost', 'root', null, 'fp');

            if ($this->conexion->connect_errno) {
                
                echo 'Error de conexión: '. $this->conexion->connect_error;
                exit();

            }

        }
    }


?>