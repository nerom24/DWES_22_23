<?php

    /* 
        Creamos una clase para cada tabla
        las propiedades públicas y una propiedad para cada columna
        no respetara la propiedad de encapsulamiento
    */

    class Cliente {
        public $conexion;

        public $id;
        public $apellidos;
        public $nombre;
        public $telefono;
        public $ciudad;
        public $dni;
        public $email;
        public $create_at;
        public $update_at;

        public function __construct(
            $id = null,
            $apellidos = null,
            $nombre = null,
            $telefono = null,
            $ciudad = null,
            $dni = null,
            $email = null,
            $create_at = null,
            $update_at = null,
        )
        {
            $this->id = $id;
            $this->apellidos = $apellidos;
            $this->nombre = $nombre;
            $this->telefono = $telefono;
            $this->ciudad = $ciudad;
            $this->dni = $dni;
            $this->email = $email;
            $this->create_at = $create_at;
            $this->update_at = $update_at;
            
            
        }

    }

?>