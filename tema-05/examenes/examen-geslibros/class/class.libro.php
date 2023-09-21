<?php

    /*
        Creamos una clase para cada tabla
        las propiedades públicas y una propiedad para cada columna

        No respetará la propiedad de encapsulamiento.
    */

    class Libro {

        public $id;
        public $isbn;
        public $ean;
        public $titulo;
        public $autor_id;
        public $editorial_id;
        public $precio_coste;
        public $precio_venta;
        public $stock;
        public $stock_min;
        public $stock_max;
        public $fecha_edicion;

        public function __construct(
            $id     = null,
            $isbn = null,
            $ean= null,
            $titulo= null,
            $autor_id= null,
            $editorial_id= null,
            $precio_coste= null,
            $precio_venta= null,
            $stock= null,
            $stock_min= null,
            $stock_max= null,
            $fecha_edicion= null
        ) {
            $this->id = $id;
            $this->isbn = $isbn;
            $this->ean = $ean;
            $this->titulo = $titulo;
            $this->autor_id = $autor_id;
            $this->editorial_id = $editorial_id;
            $this->precio_coste = $precio_coste;
            $this->precio_venta = $precio_venta;
            $this->stock = $stock;
            $this->stock_min = $stock_min;
            $this->stock_max = $stock_max;
            $this->fecha_edicion = $fecha_edicion;

        }
        
    }

?>