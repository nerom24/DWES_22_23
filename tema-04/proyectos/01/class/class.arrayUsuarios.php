<?php

    /*
        Tabla de Usuarios.

        Es un array donde cada elemento es un objeto de la clase
        Usuario.
    */

    class arrayUsuarios {

        private $array;

        public function __construct()
        {
            $this->array = [];
        }

        


        /**
         * Get the value of array
         */ 
        public function getArray()
        {
                return $this->array;
        }

        /**
         * Set the value of array
         *
         * @return  self
         */ 
        public function setArray($array)
        {
                $this->array = $array;

                return $this;
        }

        // Create
        public function create(Usuario $usuario) {
            $this->array[]=$usuario;
        }

        # Delete
        public function delete($indice) {
            unset($this->array[$indice]);
            array_values($this->array);
        }

        # Read
        public function read($indice) {
            
            # Devuelve objeto de la clase Usuario
            return $this->array[$indice];
        }

        # Update
        public function update(Usuario $usuario, $indice) {
            $this->array[$indice] = $usuario;
        }

        public function getPerfiles() {
            $perfiles = [
                'Administrador',
                'Programador',
                'Editor',
                'Usuario',
                'Registrado'
            ];

            return $perfiles;
        }

        public function getDatos() {

            # Usuario 1
            $usuario = new Usuario (
                1, 
                'Pablo',
                'pablo@email.com',
                '12345567',
                'España',
                [0,1]

            );

            # Añade el usuario al array
            $this->create($usuario);

            # Usuario 2
            $usuario = new Usuario (
                2, 
                'Felipe',
                'felipe@email.com',
                '12345567',
                'España',
                [2,3]

            );

            $this->create($usuario);

            # Usuario 3
            $usuario = new Usuario (
                3, 
                'Ana',
                'ana@email.com',
                '12345567',
                'España',
                [0,2,3]

            );

            $this->create($usuario);

            # Usuario 4
            $usuario = new Usuario (
                4, 
                'Juan',
                'juan@email.com',
                '12345567',
                'España',
                [0,1,2,3]

            );

            $this->create($usuario);


        }


        public function getEncabezado() {
            $encabezado = [
                'Id',
                'Nombre',
                'Email',
                'Password',
                'Nacionalidad',
                'Perfiles',
                'Acciones'
            ];
            return $encabezado;
        }


        # Devuelve el array perfiles asignados a usuario
        Public function listaPerfiles($indicesPerfiles, $perfiles){
            $aux = [];
            foreach ($indicesPerfiles as $indice) {
                $aux[] = $perfiles[$indice];
            }
            
            return $aux;
        }



        
    }

?>