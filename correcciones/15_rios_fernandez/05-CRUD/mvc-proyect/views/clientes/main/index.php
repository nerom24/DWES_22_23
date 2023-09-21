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
        include "views/clientes/partials/cabecera.php" ?>

        <!-- Comprobamos si existe algun mensaje -->
        <?php require_once "template/partials/mensaje.php" ?>

        <!-- Menu principal -->
        <?php require_once "views/clientes/partials/menu.php" ?>
        <table class="table">
            <thead>
                <tr>

                    <th>Id </th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Ciudad</th>
                    <th>DNI</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->clientes as $cliente) : ?>
                    <tr>
                        <td><?= $cliente->id ?></td>
                        <td><?= $cliente->nombre ?></td>
                        <td><?= $cliente->apellidos ?></td>
                        <td><?= $cliente->email ?></td>
                        <td><?= $cliente->telefono ?></td>
                        <td><?= $cliente->ciudad ?></td>
                        <td><?= $cliente->dni ?></td>
                        <td>

                            <div class="btn-group">
                                <a href="<?= URL ?>clientes/delete/<?= $cliente->id ?>" title="Eliminar" class="btn  <?= (!in_array($_SESSION["id_rol"], $GLOBALS["eliminar"])) ? ' btn-secondary disabled' : 'btn-primary' ?>" onclick="return confirm('¿Quieres Borrar?')"> <i class="bi bi-trash"></i> </a>
                                <a href="<?= URL ?>clientes/editar/<?= $cliente->id ?>" title="Editar" class="btn  <?= (!in_array($_SESSION["id_rol"], $GLOBALS["editar"])) ? ' btn-secondary disabled' : 'btn-primary' ?>"> <i class="bi bi-pencil"></i> </a>
                                <a href="<?= URL ?>clientes/mostrar/<?= $cliente->id ?>" title="Mostrar" class="btn  <?= (!in_array($_SESSION["id_rol"], $GLOBALS["mostrar"])) ? ' btn-secondary disabled' : 'btn-primary' ?>"> <i class="bi bi-eye"></i> </a>
                            </div>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8">Nº Registros: <?= $this->clientes->rowCount() ?> </td>
                </tr>
            </tfoot>
            <caption>Tabla de Cuentas </caption>

        </table>

    </div>

    <!-- footer -->
    <?php require_once "template/partials/footer.php" ?>

    <!-- Bootstrap JS y popper -->
    <?php require_once "template/partials/javascript.php" ?>

</body>

</html>