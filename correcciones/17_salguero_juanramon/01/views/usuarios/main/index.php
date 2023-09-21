<!DOCTYPE html>
<html lang="es">

<head>
    <!-- head -->
    <?php require_once("template/partials/head.php");  ?>
    <title><?= $this->tittle ?></title>
</head>

<body>
<?php require_once ("template/partials/menuAut.php") ?>  
    <div class="container" style="padding-top: 2%;">

         

        <?php include ("views/usuarios/partials/cabecera.php") ?>

        <?php include ("template/partials/mensaje.php") ?>

        <!-- Menu clientes -->
        <?php require_once ("views/usuarios/partials/menu.php") ?>

        <table class="table">
            <thead>
                <tr>
                    <th>Id </th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Perfil</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->usuarios as $usuario): ?>
                    <tr>
                        <td><?= $usuario->id ?></td>
                        <td><?= $usuario->name ?></td>
                        <td><?= $usuario->email ?></td>
                        <td><?= $usuario->rol ?></td>
                        <td>
                            <a href="<?= URL ?>usuarios/eliminar/<?= $usuario->id ?>" title="Eliminar" <?= (!in_array($_SESSION['id_rol'], $GLOBALS['eliminar']))? 'class= "btn disabled"':null ?>> <i class="bi bi-trash"></i> </a>
                            <a href="<?= URL ?>usuarios/editar/<?= $usuario->id ?>" title="Editar" <?= (!in_array($_SESSION['id_rol'], $GLOBALS['editar']))? 'class= "btn disabled"':null ?>> <i class="bi bi-pencil"></i> </a>
                            <a href="<?= URL ?>usuarios/mostrar/<?= $usuario->id ?>" title="Mostrar" <?= (!in_array($_SESSION['id_rol'], $GLOBALS['mostrar']))? 'class= "btn disabled"':null ?>> <i class="bi bi-eye"></i> </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8">Nº Registros: <?= $this->usuarios -> rowCount() ?> </td>
                </tr>
            </tfoot>
            <caption>Tabla de Usuarios </caption>

        </table>

    </div>

    <!-- footer -->
    <?php require_once ("template/partials/footer.php") ?>

    <!-- Bootstrap JS y popper -->
    <?php require_once ("template/partials/javascript.php") ?>

</body>

</html>