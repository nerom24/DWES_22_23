<?php

    /*
        Tabla de Usuarios.

        Es un array donde cada elemento es un objeto de la clase
        Usuario.
    */

    class arrayJugadores {

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
        public function create(Jugador $jugador) {
            $this->array[]=$jugador;
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
        public function update(Jugador $jugador, $indice) {
            $this->array[$indice] = $jugador;
        }

        public function getPosiciones() {
            $posiciones = [
                'Portero',
                'Central',
                'Lateral',
                'Mediocentro',
                'Centrocampista',
                'Extremo',
                'Delantero'
            ];

            return $posiciones;
        }

        public function getEquipos() {
            $naciones = [
                'Real Madrid',
                'Barcelona',
                'Betis',
                'Sevilla',
                'Valencia',
                'Rayo Vallecano',
                'Ath Bilbao',
                'Levante',
                'Real Sociedad',
                'Osasuna'
            ];

            return $naciones;
        }

        public function getDatos() {

            # Jugador 1
            $jugador = new Jugador (
                1, 
                'Marco Asensio',
                10,
                'España',
                0,
                [4, 5, 6],
                '7'

            );

            # Añade el usuario al array
            $this->create($jugador);

             # Jugador 2
             $jugador = new Jugador (
                1, 
                'Ansu Fati',
                10,
                'España',
                1,
                [5, 6],
                '4.5'

            );

            # Añade el usuario al array
            $this->create($jugador);

            # Jugador 3
            $jugador = new Jugador (
                1, 
                'Sergio Canales',
                10,
                'España',
                2,
                [4, 5],
                '3.5'

            );

            # Añade el usuario al array
            $this->create($jugador);

        }


        public function getEncabezado() {
            $encabezado = [
                'Id',
                'Nombre',
                'Num',
                'Nacionalidad',
                'Equipo',
                'Posiciones',
                'Contrato',
                'Acciones'
            ];
            return $encabezado;
        }


        # Devuelve el array perfiles asignados a usuario
        Public function listaPosiciones($indicesPosiciones, $posiciones){
            $aux = [];
            foreach ($indicesPosiciones as $indice) {
                $aux[] = $posiciones[$indice];
            }
            
            return $aux;
        }



        
    }

?>