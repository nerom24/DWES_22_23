<?php

    /*
        Creamos una clase para cada tabla
        las propiedades públicas y una propiedad para cada columna

        No respetará la propiedad de encapsulamiento.
    */

    class Libro {

        public $id;
        public $titulo;
        public $isbn;
        public $autor_id;
        public $editorial_id;
        public $stock;
        public $precio_coste;
        public $precio_venta;
        public $fecha_edicion;


        public function __construct(
            $id     = null,
            $titulo = null,
            $isbn= null,
            $autor_id= null,
            $editorial_id= null,
            $stock= null,
            $precio_coste= null,
            $precio_venta= null,
            $fecha_edicion = null
        ) {
            $this->id = $id;
            $this->titulo = $titulo;
            $this->isbn = $isbn;
            $this->autor_id = $autor_id;
            $this->editorial_id = $editorial_id;
            $this->stock = $stock;
            $this->precio_coste = $precio_coste;
            $this->precio_venta = $precio_venta;
            $this->fecha_edicion = $fecha_edicion;

        }
    }

?>