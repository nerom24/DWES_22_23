<?php  

require_once 'libs/database.php';
require_once 'libs/controller.php';
require_once 'libs/model.php';
require_once 'libs/view.php';
require_once 'sesiones/sesionesseguras.php';
require_once 'libs/privileges.php';
require_once 'class/class.user.php';
require_once 'class/class.cliente.php';
require_once 'class/class.cuenta.php';
require_once 'class/class.movimiento.php';
require_once 'fpdf185/fpdf.php';
require_once 'class/class.pdfClientes.php';
require_once 'class/class.pdfCuentas.php';
require_once 'class/class.pdfMovimientos.php';
require_once 'class/class.pdfUsuarios.php';
require_once "libs/lib.php";
require_once 'libs/app.php';
require_once 'config/config.php';
$app = new App();


?>