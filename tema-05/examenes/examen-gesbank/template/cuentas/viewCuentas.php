<!DOCTYPE html>
<html lang="es">
<!-- head -->
    <?php include_once("template/partials/head.php")?>

<body>
    <!-- cabecera -->
    <?php include_once("template/partials/cabecera.php");?>

    <div class ="container">
        <?php include_once ("template/partials/notify.php") ?>
        <legend>Tabla de Cuentas</legend>
        <?php include_once("template/partials/menu_cuentas.php");?>
        <!-- Tabla Cuentas -->
        <table class="table">
            <thead class="">
                <tr>
                    <th>Id</th>
                    <th>Cuenta</th>
                    <th>Apellidos</th>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Ul Mov</th>
                    <th># Movtos</th>
                    <th>Saldo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cuentas as $cuenta): ?>
                    <tr>

                        <td><?= $cuenta->id ?></td>
                        <td><?= $cuenta->num_cuenta ?></td>
                        <td><?= $cuenta->apellidos ?></td>
                        <td><?= $cuenta->nombre ?></td>
                        <td><?= $cuenta->fecha_alta ?></td>
                        <td><?= $cuenta->fecha_ul_mov ?></td>
                        <td class="text-right"><?= $cuenta->num_movtos ?></td>
                        <td class="text-right"><?= $cuenta->saldo ?></td>
                        

                        <td>
                            <a href="movimientos.php?id=<?= $cuenta->id ?>" title="Movimientos"><i class="material-icons">list</i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="8" >Nº Registros: <?= $cuentas->rowCount(); ?> </td>
                </tr>

            </tbody>
        </table>
        <!-- Footer -->
        <?php include_once("template/partials/footer.php");?>
    </div>
    <!-- Optional JavaScript-->
    <?php include_once("template/partials/javascript.php");?>
</body>
</html>