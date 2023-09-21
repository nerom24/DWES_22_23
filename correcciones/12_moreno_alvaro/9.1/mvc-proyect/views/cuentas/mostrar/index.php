<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("template/partials/head.php");  ?>
    <title>MOSTRAR CUENTA</title>
</head>

<body>

    <?php require_once "template/partials/menu.php"; ?>

    <div class="container">

        <?php include "views/clientes/partials/cabecera.php" ?>

        <div class="mb-3">
            <form action="<?= URL ?>cuentas/update/<?=$this->id?>" method="POST">

                <div class="mb-3">

                    <label for="" class="form-label">Numero de cuenta</label>
                    <input type="text" class="form-control" name="num_cuenta" value="<?=$this->cuenta->num_cuenta ?>" disabled>

                </div>

                <div class="mb-3">

                    <label for="" class="form-label">Cliente</label>
                    <select class="form-select form-select-lg" name="id_cliente" id="" disabled>

                        <option selected disabled>Seleccione un cliente </option>
                        <?php foreach ($this->clientes as  $cliente) : ?>
                            <div class="form-check">

                                <option value="<?= $cliente->id ?>" 
                                <?=($this->cuenta->id_cliente== $cliente->id)?"selected" : null; ?>
                                > 
                                <?= $cliente->nombre ?>
                                </option>
                            </div>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="mb-3">

                    <label for="" class="form-label">Fecha alta</label>
                    <input type="date" class="form-control" name="fecha_alta" value="<?=$this->cuenta->fecha_alta?>" disabled>

                </div>

                <div class="mb-3">

                    <label for="" class="form-label">Saldo</label>
                    <input type="text" class="form-control" name="saldo" id="" value="<?=$this->cuenta->saldo ?>" disabled>

                </div>

                <div class="mb-3">

                    <a name="" id="" class="btn btn-secondary" href="<?= URL ?>cuentas" role="button">Volver</a>

                </div>

            </form>
        </div>
    </div>

    <br><br><br>

    <!-- footer -->
    <?php require_once "template/partials/footer.php" ?>

    <!-- Bootstrap JS y popper -->
    <?php require_once "template/partials/javascript.php" ?>
</body>

</html>