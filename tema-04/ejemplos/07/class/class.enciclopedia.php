<?php

    /*
        Ejemplo definición clase hija o subclase

        subclase enciclopedia

    */

    Class Enciclopedia extends Libro {

        private $num_tomos;
        private $edicion;
        private $editorial;

        public function __construct(
                        $id=null, 
                        $titulo=null, 
                        $autor=null, 
                        $genero=null, 
                        $num_tomos=null,
                        $editorial=null,
                        $edicion) 
        {

            // LLamo al constructor de la clase padre
            parent::__construct($id, $titulo, $autor, $genero);

            $this->num_tomos = $num_tomos;
            $this->editorial = $editorial;
            $this->edicion = $edicion;


        }

        public function CambiarTitulo($titulo) {

            $this->titulo = $titulo;

        }


    }

    

   

?>