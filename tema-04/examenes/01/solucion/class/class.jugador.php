<?php

    /*
        Clase usuarios
    */

    Class Jugador {

        private $id;
        private $nombre;
        private $numero;
        private $nacionalidad;
        private $equipo;
        private $posiciones;
        private $contrato;

        public function __construct(
            // Parámetros
            $id = null,
            $nombre = null,
            $numero = null,
            $nacionalidad = null,
            $equipo = null,
            $posiciones = [],
            $contrato = null
        )
        {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->numero = $numero;
            $this->nacionalidad = $nacionalidad;
            $this->equipo = $equipo;
            $this->posiciones = $posiciones;
            $this->contrato = $contrato;
        }


        

        

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of nombre
         */ 
        public function getNombre()
        {
                return $this->nombre;
        }

        /**
         * Set the value of nombre
         *
         * @return  self
         */ 
        public function setNombre($nombre)
        {
                $this->nombre = $nombre;

                return $this;
        }

        /**
         * Get the value of numero
         */ 
        public function getNumero()
        {
                return $this->numero;
        }

        /**
         * Set the value of numero
         *
         * @return  self
         */ 
        public function setNumero($numero)
        {
                $this->numero = $numero;

                return $this;
        }

        /**
         * Get the value of nacionalidad
         */ 
        public function getNacionalidad()
        {
                return $this->nacionalidad;
        }

        /**
         * Set the value of nacionalidad
         *
         * @return  self
         */ 
        public function setNacionalidad($nacionalidad)
        {
                $this->nacionalidad = $nacionalidad;

                return $this;
        }

        /**
         * Get the value of equipo
         */ 
        public function getEquipo()
        {
                return $this->equipo;
        }

        /**
         * Set the value of equipo
         *
         * @return  self
         */ 
        public function setEquipo($equipo)
        {
                $this->equipo = $equipo;

                return $this;
        }

        /**
         * Get the value of contrato
         */ 
        public function getContrato()
        {
                return $this->contrato;
        }

        /**
         * Set the value of contrato
         *
         * @return  self
         */ 
        public function setContrato($contrato)
        {
                $this->contrato = $contrato;

                return $this;
        }

        /**
         * Get the value of posiciones
         */ 
        public function getPosiciones()
        {
                return $this->posiciones;
        }

        /**
         * Set the value of posiciones
         *
         * @return  self
         */ 
        public function setPosiciones($posiciones)
        {
                $this->posiciones = $posiciones;

                return $this;
        }
    }

?>