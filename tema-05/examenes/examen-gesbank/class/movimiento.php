<?php  
	
        class Movimiento {
                public $id; 
                public $id_cuenta;
                public $fecha_hora;
                public $tipo;
                public $cantidad;
                public $saldo;
        
                public function __construct(
                        $id=null, 
                        $id_cuenta=null, 
                        $fecha_hora=null, 
                        $tipo=null, 
                        $cantidad=null, 
                        $saldo=null
                        )
                
                {
                        $this->id=$id;
                        $this->id_cuenta=$id_cuenta;
                        $this->fecha_hora=$fecha_hora;
                        $this->tipo=$tipo;
                        $this->cantidad=$cantidad;
                        $this->saldo=$saldo;
                }
        
                public function __GET($k){ return $this->$k; }
                public function __SET($k, $v){ return $this->$k = $v; }
        }
        
        

?>