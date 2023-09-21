<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("template/partials/head.php");  ?>
    <title>Nuevo Gestion Cuentas</title>

</head>

<body>

    <?php require_once "template/partials/menu.php"; ?>

    <div class="container">

        <?php include "views/clientes/partials/cabecera.php" ?>

        <div class="mb-3">
            <form action="<?= URL ?>movimientos/create/<?=$this->id?>" method="POST">


                <div class="mb-3">
                    <label for="" class="form-label">Nºcuenta</label>
                    <input type="text" class="form-control" name="num_cuenta" value="<?= $this->cuenta->num_cuenta ?>" disabled>

                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Cliente</label>
                    <input type="text" class="form-control" name="id_cliente" value="<?= $this->cuenta->id_cliente ?>" disabled>
                </div>


                <div class="mb-3">

                    <label for="" class="form-label">Saldo</label>
                    <input type="text" class="form-control" name="saldo" id="" value="<?= $this->cuenta->saldo ?>" disabled>
                </div>

                <div class="mb-3">

                    <label for="" class="form-label">Concepto</label>
                    <input type="text" class="form-control" name="concepto" id="" >
                </div>


                <div class="mb-3">
                <label for="" class="form-label">Tipo de movimiento</label>

                    <div class="form-control">
                        <div class="form-check">
                            <input class="form-check-input-inline" type="radio" name="tipo" id="1" value="I">
                            <label class="form-check-label" for="1">
                                INGRESO
                            </label>
                            <input class="form-check-input-inline" type="radio" name="tipo" id="2" value="R">
                            <label class="form-check-label" for="2">
                                REINTEGRO
                            </label>

                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" name="cantidad" id=""  placeholder="0.00">
                </div>


                <div class="mb-3">

                    <a name="" id="" class="btn btn-secondary" href="<?= URL ?>movimientos/cuenta/<?=$this->id?>" role="button">Cancelar</a>
                    <button type="button" class="btn btn-danger">Borrar</button>
                    <button type="submit" class="btn btn-primary">Crear</button>

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