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

    function __construct(

        $id = null,
        $id_cuenta = null,
        $fecha_hora = null,
        $concepto = null,
        $tipo = null,
        $cantidad = null,
        $saldo = null


    ) {

        $this->id=$id;
        $this->id_cuenta=$id_cuenta;
        $this->fecha_hora= $fecha_hora;
        $this->concepto= $concepto;
        $this->tipo= $tipo;
        $this->cantidad=$cantidad;
        $this->saldo= $saldo;

        $this->sql = "select * from movimientos";
    }

}
