<?php
#|--------------------------------|
#| CLASE USERS CON SUS PROPIEDADES|
#|--------------------------------|
    class User {
        public $id;
        public $name;
        public $email;
        public $password;
        public $password_confirm;
        public $role_id;
        public $perfil;

        public function __construct($id = null,$name = null,$email = null,$password = null,$password_confirm = null,$role_id = null,$perfil = null){
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
            $this->password_confirm = $password_confirm;
            $this->role_id = $role_id;
            $this->perfil = $perfil;
        }
    }
?>