<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("template/partials/head.php");  ?>
    <title>NUEVO MOVIMIENTO</title>
</head>

<body>

    <?php require_once "template/partials/menu.php"; ?>

    <div class="container">

        <?php include "views/clientes/partials/cabecera.php" ?>

        <div class="mb-3">
            <form action="<?= URL ?>movimientos/create/<?= $this->id ?>" method="POST">

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
                    <input type="text" class="form-control
                    <?= (isset($this->errores["concepto"])) ? "is-invalid" : null ?>" name="concepto" id="" value="<?= $this->mov->concepto ?>">

                    <?php if (isset($this->errores["concepto"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["concepto"] ?>
                        </span>
                    <?php endif; ?>

                </div>

                <div class="mb-3">

                    <label for="" class="form-label">Tipo de movimiento</label>

                    <div class="form-control <?= (isset($this->errores["tipo"])) ? "is-invalid" : null ?>">
                        <div class=" form-check">
                            <input class="form-check-input-inline" type="radio" <?= ($this->mov->tipo == "I") ? "checked" : null ?> name="tipo" id="1" value="I">
                            <label class="form-check-label" for="1">
                                INGRESO
                            </label>
                            <input class="form-check-input-inline" type="radio" <?= ($this->mov->tipo == "R") ? "checked" : null ?> name="tipo" id="2" value="R">
                            <label class="form-check-label" for="2">
                                REINTEGRO
                            </label>
                        </div>
                    </div>
                    <?php if (isset($this->errores["tipo"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["tipo"] ?>
                        </span>
                    <?php endif; ?>

                </div>

                <div class="mb-3">

                    <label for="" class="form-label">Cantidad</label>
                    <input type="number" step="0.01" min="0.00" class="form-control
                    <?= (isset($this->errores["cantidad"])) ? "is-invalid" : null ?>" name=" cantidad" placeholder="0.00" value="<?= $this->mov->cantidad ?>">
                    <?php if (isset($this->errores["cantidad"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["cantidad"] ?>
                        </span>
                    <?php endif; ?>

                </div>

                <div class="mb-3">

                    <a name="" id="" class="btn btn-secondary" href="<?= URL ?>movimientos/cuenta/<?= $this->id ?>" role="button">Cancelar</a>
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