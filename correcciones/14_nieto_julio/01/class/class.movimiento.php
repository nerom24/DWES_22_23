<?php


// No respeta la propiedad de encapsulamiento

class Movimiento
{

    public $id;
    public $id_cuenta;
    public $fecha_hora;
    public $concepto;
    public $tipo;
    public $cantidad;
    public $saldo;
    public $create_at;
    public $update_at;
    

    function __construct(

        $id = null,
        $id_cuenta = null,
        $fecha_hora = null,
        $concepto = null,
        $tipo = null,
        $cantidad = null,
        $saldo = null,
        $create_at = null,
        $update_at = null,


    ) {

        $this->id=$id;
        $this->id_cuenta=$id_cuenta;
        $this->fecha_hora= $fecha_hora;
        $this->concepto=$concepto;
        $this->tipo= $tipo;
        $this->cantidad= $cantidad;
        $this->saldo= $saldo;
        $this->create_at= $create_at;
        $this->update_at= $update_at;
    }

}
