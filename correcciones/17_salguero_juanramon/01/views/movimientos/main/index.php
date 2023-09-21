<!DOCTYPE html>
<html lang="es">

<head>
    <!-- head -->
    <?php require_once("template/partials/head.php");  ?>
    <title><?= $this->tittle ?></title>
</head>

<body>

    <div class="container" style="padding-top: 2%;">

    <?php require_once ("template/partials/menuAut.php") ?>    

        <?php include ("views/movimientos/partials/cabecera.php") ?>

        <?php include ("template/partials/mensaje.php") ?>

        <!-- Menu Cuentas -->
        <?php require_once ("views/movimientos/partials/menu.php") ?>

        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nº Cuenta</th>
                    <th>Concepto</th>
                    <th>Fecha</th>
                    <th>Tipo</th>
                    <th>Cantidad</th>
                    <th>Saldo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->movimientos as $movimiento): ?>
                    <tr>
                        <td><?= $movimiento->id ?></td>
                        <td><?= $movimiento->num_cuenta ?></td>
                        <td><?= $movimiento->concepto ?></td>
                        <td><?= $movimiento->fecha_hora ?></td>
                        <td><?= $movimiento->tipo ?></td>
                        <td><?= $movimiento->cantidad ?></td>
                        <td><?= $movimiento->saldo ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8">Nº Registros: <?= $this->movimientos -> rowCount() ?> </td>
                </tr>
            </tfoot>
            <caption>Tabla de Movimientos </caption>

        </table>

    </div>

    <!-- footer -->
    <?php require_once ("template/partials/footer.php") ?>

    <!-- Bootstrap JS y popper -->
    <?php require_once ("template/partials/javascript.php") ?>

</body>

</html>