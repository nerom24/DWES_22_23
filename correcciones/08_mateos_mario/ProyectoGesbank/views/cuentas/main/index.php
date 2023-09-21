<!DOCTYPE html>
<html lang="es">

<head>

    <?php require_once("template/partials/head.php");  ?>

</head>

<body>
    
    <?php require_once ("template/partials/menuAut.php"); ?>
    
    <div class="container">
    <br>
    
        <?php include ("views/cuentas/partials/cabecera.php"); ?>

        <?php require_once ("template/partials/mensaje.php") ?>

        <?php require_once("template/partials/error.php")?>
        
        <?php require_once ("views/cuentas/partials/menu.php") ?>
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
                        <td>
                            <a href="<?= URL ?>cuentas/eliminar/<?=$cuenta->id?>" title="Eliminar"
                            <?= (!in_array($_SESSION['id_rol'],$GLOBALS['eliminar']))? 'class="btn disabled"': null ?>
                            ><i class="bi bi-trash-fill"></i></a>
                            <a href="<?= URL ?>cuentas/editar/<?=$cuenta->id?>" title="Editar"
                            <?= (!in_array($_SESSION['id_rol'],$GLOBALS['editar']))? 'class="btn disabled"': null ?>
                            ><i class="bi bi-pencil-fill"></i></a>
                            <a href="<?= URL ?>cuentas/mostrar/<?=$cuenta->id?>" title="Mostar"
                            <?= (!in_array($_SESSION['id_rol'],$GLOBALS['mostrar']))? 'class="btn disabled"': null ?>
                            ><i class="bi bi-eye-fill"></i></a>
                            <a href="<?= URL ?>movimientos/cuenta/<?=$cuenta->id?>" title="Mostar"><i class="bi bi-list-task"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="9">Nº Registros: <?= $this->cuentas->rowCount() ?> </td>
                </tr>
            </tfoot>

        </table>

    </div>

    <?php require_once "template/partials/footer.php" ?>

    <?php require_once "template/partials/javascript.php" ?>

</body>

</html>