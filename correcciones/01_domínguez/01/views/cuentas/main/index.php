<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once("template/partials/head.php");?>
    <title>Gestión cuentas </title>

</head>
<body>
<?php include("template/partials/menuAut.php");?>
<br>
    <div class="container">
        <header class="pb-3 mb-4 border-bottom">
            <?php include("views/cuentas/partials/cabecera.php");?>
            <?php include("template/partials/mensaje.php");?>
        </header>
        <?php include("views/cuentas/partials/menu.php");?>

        <div class="table-responsive">
            <table class="table ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cuenta</th>
                        <th>Apellidos</th>
                        <th>Nombre</th>
                        <th>Fecha de alta</th>
                        <th>Fecha ult mov</th>
                        <th>Movtos</th>
                        <th>Saldo</th>
                        <!--columna de acciones-->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!--recorre cada cuenta del array cuentas-->
                    <?php foreach($this->cuentas as $cuenta): ?>
                        <tr>
                            <!--muestra cada campo de cada cuenta-->
                            <td><?= $cuenta->id ?></td>
                            <td><?= $cuenta->num_cuenta ?></td>      
                            <td><?= $cuenta->apellidos ?></td>
                            <td><?= $cuenta->nombre ?></td>      
                            <td><?= $cuenta->fecha_alta ?></td>
                            <td><?= $cuenta->fecha_ul_mov ?></td>
                            <td><?= $cuenta->num_movtos ?></td>
                            <td><?= $cuenta->saldo ?></td>
                            
                    
                            <!--columna de acciones-->  
                            <td>
                                <a href="<?= URL ?>movimientos/cuenta/<?=$cuenta->id?>"><abbr title="Botón movimientos"><i class="bi bi-list-ul"></i></abbr></a>
                                
                                <a onclick="return confirm('¿Desea eliminar la cuenta?')" href="<?= URL ?>cuentas/delete/<?=$cuenta->id?>"
                                <?= (!in_array($_SESSION['id_rol'], $GLOBALS['eliminar'])? 'class= btn disabled':'null') ?>><abbr title="Botón eliminar"><i class="bi bi-trash-fill"></i></abbr></a>
                                
                                <a href="<?= URL ?>cuentas/editar/<?=$cuenta->id?>"
                                <?= (!in_array($_SESSION['id_rol'], $GLOBALS['editar'])? 'class= btn disabled':'null') ?>><abbr title="Botón editar"><i class="bi bi-pencil-fill"></i></abbr></a>
                                
                                <a href="<?= URL ?>cuentas/mostrar/<?=$cuenta->id?>"
                                <?= (!in_array($_SESSION['id_rol'], $GLOBALS['mostrar'])? 'class= btn disabled':'null') ?>><abbr title="Botón mostrar"><i class="bi bi-eye-fill"></i></abbr></a>
                            </td>
                         
                        </tr>
                          
                    <?php endforeach; ?> 
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8">
                            Nº Registros: <?= $this->cuentas->rowCount() ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
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