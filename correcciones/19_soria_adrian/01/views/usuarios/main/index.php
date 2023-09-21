<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once("template/partials/head.php");?>
    <title>Gestión usuarios </title>

</head>
<body>
<?php include("template/partials/menuAut.php");?>
<br>
    <div class="container">
        <header class="pb-3 mb-4 border-bottom">
            <?php include("views/usuarios/partials/cabecera.php");?>
            <?php include("template/partials/mensaje.php");?>
        </header>
        <?php include("views/usuarios/partials/menu.php");?>

        <div class="table-responsive">
            <table class="table ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <!--columna de acciones-->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!--recorre cada usuario del array usuarios-->
                    <?php foreach($this->usuarios as $usuario): ?>
                        <tr>
                            <!--muestra cada campo de cada usuario-->
                            <td><?= $usuario->id ?></td>
                            <td><?= $usuario->name ?></td>
                            <td><?= $usuario->email ?></td>
                            <td><?= $usuario->rol ?></td>
    

                            <!--columna de acciones-->  
                            <td>
                                <a onclick="return confirm('¿Desea eliminar el usuario?')" href="<?= URL ?>usuarios/delete/<?=$usuario->id?>"
                                <?= (!in_array($_SESSION['id_rol'], $GLOBALS['eliminar'])? 'class= btn disabled':'null') ?>><abbr title="Botón eliminar"><i class="bi bi-trash-fill"></i></abbr></a>
                                
                                <a href="<?= URL ?>usuarios/editar/<?=$usuario->id?>"
                                <?= (!in_array($_SESSION['id_rol'], $GLOBALS['editar'])? 'class= btn disabled':'null') ?>><abbr title="Botón editar"><i class="bi bi-pencil-fill"></i></abbr></a>
                                
                                <a href="<?= URL ?>usuarios/mostrar/<?=$usuario->id?>"
                                <?= (!in_array($_SESSION['id_rol'], $GLOBALS['mostrar'])? 'class= btn disabled':'null') ?>><abbr title="Botón mostrar"><i class="bi bi-eye-fill"></i></abbr></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>    
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">
                            Nº Registros: <?= $this->usuarios->rowCount() ?>
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