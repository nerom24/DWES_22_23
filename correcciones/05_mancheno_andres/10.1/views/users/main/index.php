<!DOCTYPE html>
<html lang="es">

<head>
    <!-- head -->
    <?php require_once("template/partials/head.php");  ?>

</head>

<body>
    <?php require_once "template/partials/menuAut.php"; ?>

    <div class="container" style="padding-top: 2%;">


        <?php
        include "views/users/partials/cabecera.php" ?>

        <!-- Comprobamos si existe algun mensaje -->
        <?php require_once "template/partials/mensaje.php" ?>

        <!-- Menu principal -->
        <?php require_once "views/users/partials/menu.php" ?>
        <table class="table">
            <thead>
                <tr>

                    <th>Id </th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Perfil</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->users as $user) : ?>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td><?= $user->name ?></td>
                        <td><?= $user->email ?></td>
                        <td><?= $this->roles[$user->role_id - 1]["name"] ?></td>

                        <td style="display:flex; justify-content:space-between;">
                        
                                <a href="<?= URL ?>users/delete/<?= $user->id ?>" title="Eliminar" class="btn btn-primary <?= (!in_array($_SESSION["id_rol"], $GLOBALS["eliminar"])) ? 'disabled' : null ?>" onclick="return confirm('¿Quieres Borrar?')"> <i class="bi bi-trash"></i> </a>
                                <a href="<?= URL ?>users/editar/<?= $user->id ?>" title="Editar" class="btn btn-primary <?= (!in_array($_SESSION["id_rol"], $GLOBALS["editar"])) ? 'disabled"' : null ?>"> <i class="bi bi-pencil"></i> </a>
                                <a href="<?= URL ?>users/mostrar/<?= $user->id ?>" title="Mostrar" class="btn btn-primary <?= (!in_array($_SESSION["id_rol"], $GLOBALS["mostrar"])) ? 'disabled"' : null ?>"> <i class="bi bi-eye"></i> </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5">Nº Registros: <?= count($this->users) ?> </td>
                </tr>
            </tfoot>
            <caption>Tabla de usuarios </caption>

        </table>

    </div>

    <!-- footer -->
    <?php require_once "template/partials/footer.php" ?>

    <!-- Bootstrap JS y popper -->
    <?php require_once "template/partials/javascript.php" ?>

</body>

</html>