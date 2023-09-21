<?php

    /*
        Ejemplo definición clase libro

        Sin cumplir la propiedad de encapsulamiento
    */

    class Libro {

        // Defino propiedades

        public $id;
        public $titulo;
        public $autor;
        public $genero;
        

        public function __construct($id=null, $titulo=null, $autor=null, $genero=null) {

            $this->id = $id;
            $this->titulo = $titulo;
            $this->autor = $autor;
            $this->genero = $genero;


        }

        
    }

?>