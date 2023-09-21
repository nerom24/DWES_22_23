<?php

    /*
        Clase usuarios
    */

    Class Usuario {

        private $id;
        private $nombre;
        private $email;
        private $password;
        private $nacionalidad;
        private $perfiles;

        public function __construct(
            // Parámetros
            $id = null, 
            $nombre = null,
            $email = null,
            $password = null,
            $nacionalidad = null,
            $perfiles = []  
        )
        {
            $this->id = $id;
			$this->nombre = $nombre;
            $this->email = $email;
            $this->password = $password;
            $this->nacionalidad = $nacionalidad;
            $this->perfiles = $perfiles;
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
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

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
         * Get the value of perfiles
         */ 
        public function getPerfiles()
        {
                return $this->perfiles;
        }

        /**
         * Set the value of perfiles
         *
         * @return  self
         */ 
        public function setPerfiles($perfiles)
        {
                $this->perfiles = $perfiles;

                return $this;
        }

        
    }

?>