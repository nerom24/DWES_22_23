<?php



class Cliente
{

    public $id;
    public $apellidos;
    public $nombre;       
    public $telefono;
    public $ciudad;
    public $dni;
    public $email;
    public $create_at;
    public $update_at;
    

    function __construct(

        $id = null,
        $apellidos = null,
        $nombre = null,
        $telefono = null,
        $ciudad = null,
        $dni = null,
        $email = null,
        $create_at = null,
        $update_at = null,


    ) {

        $this->id=$id;
        $this->nombre=$nombre;
        $this->apellidos= $apellidos;
        $this->email=$email;
        $this->telefono= $telefono;
        $this->dni= $dni;
        $this->ciudad= $ciudad;
        $this->create_at= $create_at;
        $this->update_at= $update_at;

        $this->sql = "select * from alumnos";
    }

}
