<?php

    /*
        Ejemplo definición clase vehículo
    */

    class Vehiculo {

        // Defino propiedades

        private $modelo;
        private $matricula;
        private $velocidad;
        

        // Defino métodos

        // Este método se ejecutará automáticamente cuando 
        // cree un objeto a partir de esta clase
        // Normalmente inicializa los valores de las propiedades declaradas

        public function __construct() {

            $this->modelo = null;
            $this->matricula = null;
            $this->velocidad = null;

        }

        # Setters

        public function setModelo($modelo) {

            $this->modelo = $modelo;

        }

        public function setMatricula($matricula) {

            $this->matricula = $matricula;

        }

        public function setVelocidad($velocidad) {

            $this->velocidad = $velocidad;

        }

        # Getters
        public function getModelo() {

            return $this->modelo;

        }

        public function getMatricula() {

            return $this->matricula;

        }

        public function getVelocidad() {

            return $this->velocidad;

        }

    }

?>