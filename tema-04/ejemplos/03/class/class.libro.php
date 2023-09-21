<?php

    /*
        Ejemplo definición clase libro
    */

    class Libro {

        // Defino propiedades

        private $id;
        private $titulo;
        private $autor;
        private $genero;
        

        public function __construct($id=null, $titulo=null, $autor=null, $genero=null) {

            $this->id = $id;
            $this->titulo = $titulo;
            $this->autor = $autor;
            $this->genero = $genero;


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
         * Get the value of titulo
         */ 
        public function getTitulo()
        {
                return $this->titulo;
        }

        /**
         * Set the value of titulo
         *
         * @return  self
         */ 
        public function setTitulo($titulo)
        {
                $this->titulo = $titulo;

                return $this;
        }

        /**
         * Get the value of autor
         */ 
        public function getAutor()
        {
                return $this->autor;
        }

        /**
         * Set the value of autor
         *
         * @return  self
         */ 
        public function setAutor($autor)
        {
                $this->autor = $autor;

                return $this;
        }

        /**
         * Get the value of genero
         */ 
        public function getGenero()
        {
                return $this->genero;
        }

        /**
         * Set the value of genero
         *
         * @return  self
         */ 
        public function setGenero($genero)
        {
                $this->genero = $genero;

                return $this;
        }

        public function __destruct()
        {
                echo 'Libro ha sido destruido';
        }
    }

?>