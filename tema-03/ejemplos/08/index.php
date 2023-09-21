<?php   
    $forma_pago=1;  

    switch($forma_pago) { 

        case 0: $pago='Contado';     
                break;     
        case 1: $pago='Transferencia bancaria';     
                break;     
        case 2: $pago='Contra reembolso';     
                break;     
        default: $pago='No definida';   
    }

    echo "Tipo de Pago: $pago";
?>
