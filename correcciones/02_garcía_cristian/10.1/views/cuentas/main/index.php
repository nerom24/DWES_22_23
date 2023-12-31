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
        include "views/cuentas/partials/cabecera.php" ?>

        <!-- Comprobamos si existe algun mensaje -->
        <?php require_once "template/partials/mensaje.php" ?>

        <!-- Menu principal -->
        <?php require_once "views/cuentas/partials/menu.php" ?>
        <table class="table">
            <thead>
                <tr>

                    <th>Id </th>
                    <th>Numero de cuenta</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Fecha Alta</th>
                    <th>Fecha ultimo movimiento</th>
                    <th>num_movtos</th>
                    <th>saldo</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->cuentas as $cuenta) : ?>
                    <tr>
                        <td><?= $cuenta->id ?></td>
                        <td><?= $cuenta->num_cuenta ?></td>
                        <td><?= $cuenta->nombre ?></td>
                        <td><?= $cuenta->apellidos ?></td>
                        <td><?= $cuenta->fecha_alta ?></td>
                        <td><?= $cuenta->fecha_ul_mov ?></td>
                        <td><?= $cuenta->num_movtos ?></td>
                        <td><b><?= $cuenta->saldo ?></b></td>
                        <td style="display:flex; justify-content:space-between;">
                        
                                <a href="<?= URL ?>cuentas/delete/<?= $cuenta->id ?>" title="Eliminar" class="btn btn-primary <?= (!in_array($_SESSION["id_rol"], $GLOBALS["eliminar"])) ? 'disabled' : null ?>"  onclick="return confirm('¿Quieres Borrar?')"> <i class="bi bi-trash"></i> </a>
                                <a href="<?= URL ?>cuentas/editar/<?= $cuenta->id ?>" title="Editar"  class="btn btn-primary <?= (!in_array($_SESSION["id_rol"], $GLOBALS["editar"])) ? 'disabled"' : null ?>"> <i class="bi bi-pencil"></i> </a>
                                <a href="<?= URL ?>cuentas/mostrar/<?= $cuenta->id ?>" title="Mostrar"  class="btn btn-primary <?= (!in_array($_SESSION["id_rol"], $GLOBALS["mostrar"])) ? 'disabled"' : null ?>"> <i class="bi bi-eye"></i> </a>
                                <a href="<?= URL ?>movimientos/cuenta/<?= $cuenta->id ?>" title="Movimientos" class="btn btn-primary"> <i class="bi bi-list-task"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="9">Nº Registros: <?= $this->cuentas->rowCount() ?> </td>
                </tr>
            </tfoot>
            <caption>Tabla de clientes </caption>

        </table>

    </div>

    <!-- footer -->
    <?php require_once "template/partials/footer.php" ?>

    <!-- Bootstrap JS y popper -->
    <?php require_once "template/partials/javascript.php" ?>

</body>

</html>