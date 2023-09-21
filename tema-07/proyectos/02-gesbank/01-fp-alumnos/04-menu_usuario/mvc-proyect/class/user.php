<?php 
    class User{

        public $id;
        public $name;
        public $email;
        public $password;
        public $password_confirm;

        public function __construct(
            $id = null, 
            $name = null,
            $email = null,
            $password = null,
            $password_confirm = null
    ){
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
            $this->password_confirm = $password_confirm;
    }

  
    }

?>-