<?php 
    /*
        
        Declaramos la clase User a partir de las columnas de la tabla
        User de la bd gesbank

        Se declaran públicas las propiedades sin mantener propiedad de encapsulamiento
    
    */

    class User {
        
        public $id;
        public $name;
        public $email;
        public $password;
        //public $password_confirm;

        public function __construct(
            $id = null,
            $name = null,
            $email = null,
            $password = null
            //$password_confirm = null
            ){
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
            //$this->password_confirm = $password_confirm;
            
        }
        
    }







?>