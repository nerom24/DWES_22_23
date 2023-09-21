<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once("template/partials/head.php");?>
    <title>Gestión clientes </title>

</head>
<body>
<?php include("template/partials/menuAut.php");?>
<br>
    <div class="container">
        <header class="pb-3 mb-4 border-bottom">
            <?php include("views/clientes/partials/cabecera.php");?>
            <?php include("template/partials/mensaje.php");?>
        </header>
        <?php include("views/clientes/partials/menu.php");?>

        <div class="table-responsive">
            <table class="table ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Teléfono</th>
                        <th>Ciudad</th>
                        <th>Dni</th>
                        <th>Email</th>
                        <!--columna de acciones-->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!--recorre cada cliente del array clientes-->
                    <?php foreach($this->clientes as $cliente): ?>
                        <tr>
                            <!--muestra cada campo de cada cliente-->
                            <td><?= $cliente->id ?></td>
                            <td><?= $cliente->nombre ?></td>
                            <td><?= $cliente->apellidos ?></td>
                            <td><?= $cliente->telefono ?></td>
                            <td><?= $cliente->ciudad ?></td>
                            <td><?= $cliente->dni ?></td>
                            <td><?= $cliente->email ?></td>

                            <!--columna de acciones-->  
                            <td>
                                <a onclick="return confirm('¿Desea eliminar el cliente?')" href="<?= URL ?>clientes/delete/<?=$cliente->id?>"
                                <?= (!in_array($_SESSION['id_rol'], $GLOBALS['eliminar'])? 'class= btn disabled':'null') ?>><abbr title="Botón eliminar"><i class="bi bi-trash-fill"></i></abbr></a>
                                
                                <a href="<?= URL ?>clientes/editar/<?=$cliente->id?>"
                                <?= (!in_array($_SESSION['id_rol'], $GLOBALS['editar'])? 'class= btn disabled':'null') ?>><abbr title="Botón editar"><i class="bi bi-pencil-fill"></i></abbr></a>
                                
                                <a href="<?= URL ?>clientes/mostrar/<?=$cliente->id?>"
                                <?= (!in_array($_SESSION['id_rol'], $GLOBALS['mostrar'])? 'class= btn disabled':'null') ?>><abbr title="Botón mostrar"><i class="bi bi-eye-fill"></i></abbr></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>    
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8">
                            Nº Registros: <?= $this->clientes->rowCount() ?>
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