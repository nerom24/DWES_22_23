<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once("template/partials/head.php");?>
    <title>Gestión movimientos </title>

</head>
<body>
<?php include("template/partials/menuAut.php");?>
<br><br><br>
    <div class="container">
        <header class="pb-3 mb-4 border-bottom">
            <?php include("views/movimientos/partials/cabecera.php");?>
          
        </header>

        

   
        <?php include("views/movimientos/partials/menu.php");?>

        <div class="table-responsive">
            <table class="table ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Id Mov</th>
                        <th>Cuenta</th>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Cantidad</th>
                        <th>Saldo</th>
  
                    </tr>
                </thead>
                <tbody>
                    <!--recorre cada movimiento del array movimientos-->
                    <?php foreach($this->movimientos as $movimiento): ?>
                        <tr>
                            <!--muestra cada campo de cada movimiento-->
                            <td><?= $movimiento->id ?></td>
                            <td><?= $movimiento->id_cuenta ?></td>      
                            <td><?= $movimiento->cuenta ?></td>
                            <td><?= $movimiento->fecha_hora ?></td>      
                            <td><?= $movimiento->tipo ?></td>
                            <td><?= $movimiento->cantidad ?></td>
                            <td><?= $movimiento->saldo ?></td>
                            
                         
                        </tr>
                          
                    <?php endforeach; ?> 
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7">
                            Nº Registros: <?= $this->movimientos->rowCount() ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <a class="btn btn-warning" href="<?= URL ?>cuentas" role="button">Volver</a>
        </div>

        <br><br>
        

    </div>

      
    <footer class="footer mt-auto py-3 fixed-bottom bg-light">
        <?php include("template/partials/footer.php");?>
    </footer>
    


   <!--Boostrap Javascript y popper--> 
   <?php include("template/partials/javascript.php");?>    
</body>
</html>