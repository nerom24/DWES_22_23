<?php 
    /*
        
        Declaramos la clase album a partir de las columnas de la bd
        albumes

        Se declaran públicas las propiedades sin mantener propiedad de encapsulamiento
    
    */

    class Album {
        
        public $id;
        public $titulo;
        public $descripcion;
        public $autor;
        public $fecha;
        public $lugar;
        public $categoria;
        public $etiquetas;
        public $num_fotos;
        public $num_visitas;
        public $carpeta;

        public function __construct(
            $id = null,
            $titulo = null,
            $descripcion = null,
            $fecha = null,
            $lugar = null,
            $categoria = null,
            $etiquetas = null,
            $num_fotos = null,
            $num_visitas = null,
            $carpeta = null,
            ){
            $this->id = $id;
            $this->titulo = $titulo;
            $this->descripcion = $descripcion;
            $this->fecha = $fecha;
            $this->lugar = $lugar;            
            $this->categoria = $categoria;
            $this->etiquetas = $etiquetas;
            $this->num_fotos = $num_fotos;
            $this->num_visitas = $num_visitas;
            $this->carpeta = $carpeta;
        }
        
    }







?>