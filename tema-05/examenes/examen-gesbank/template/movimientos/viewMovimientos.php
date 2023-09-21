<!DOCTYPE html>
<html lang="es">
<!-- head -->
    <?php include_once("template/partials/head.php")?>

<body>
    <!-- cabecera -->
    <?php include_once("template/partials/cabecera.php");?>

    <div class ="container">
        <?php include_once ("template/partials/notify.php") ?>
        <legend>Movimientos de la cuenta: <?= $id_cuenta ?></legend>
        <?php include_once("template/partials/menu_movimientos.php");?>
        <!-- Tabla movimientos -->
        <table class="table">
            <thead class="">
                <tr>
                    <th>#</th>
                    <th>Id Mov</th>
                    <th>Cuenta</th>
                    <th>Fecha</th>
                    <th class="text-right">Tipo</th>
                    <th class="text-right">Cantidad</th>
                    <th class="text-right">Saldo</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php $num = 1 ?>
                <?php foreach ($movimientos as $movimiento): ?>
                    <tr>
                        <td><?= $num++ ?></td>
                        <td><?= $movimiento->id ?></td>
                        <td><?= $movimiento->cuenta ?></td>
                        <td><?= $movimiento->fecha_hora ?></td>
                        <td class="text-right"><?= $movimiento->tipo ?></td>
                        <td class="text-right"> <?= $movimiento->cantidad ?></td>
                        <td class="text-right"><?= $movimiento->saldo ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="8" >Nº Movimientos: <?= $movimientos->rowCount(); ?> </td>
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