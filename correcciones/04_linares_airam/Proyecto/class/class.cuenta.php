<?php


// No respeta la propiedad de encapsulamiento

class Cuenta
{

    public $id;
    public $num_cuenta;
    public $id_cliente;
    public $fecha_alta;
    public $fecha_ul_mov;
    public $num_movtos;
    public $saldo;
    public $create_at;
    public $update_at;
    

    function __construct(

        $id = null,
        $num_cuenta = null,
        $id_cliente = null,
        $fecha_alta = null,
        $fecha_ul_mov = null,
        $num_movtos = null,
        $saldo = null,
        $create_at = null,
        $update_at = null,


    ) {

        $this->id=$id;
        $this->num_cuenta=$num_cuenta;
        $this->id_cliente= $id_cliente;
        $this->fecha_alta=$fecha_alta;
        $this->fecha_ul_mov= $fecha_ul_mov;
        $this->num_movtos= $num_movtos;
        $this->saldo= $saldo;
        $this->create_at= $create_at;
        $this->update_at= $update_at;
    }

}
