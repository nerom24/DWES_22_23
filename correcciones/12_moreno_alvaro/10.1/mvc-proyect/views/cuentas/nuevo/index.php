<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("template/partials/head.php");  ?>
    <title>Nueva Cuenta</title>

</head>

<body>

    <?php require_once "template/partials/menu.php"; ?>

    <div class="container">

        <?php include "views/clientes/partials/cabecera.php" ?>

        <?php include "template/partials/error.php" ?>

        <div class="mb-3">
            <form action="<?= URL ?>cuentas/create" method="POST">


                <div class="mb-3">
                    <label for="" class="form-label">Numero de cuenta</label>
                    <input type="text" class="form-control 
                    <?= (isset($this->errores["num_cuenta"])) ? "is-invalid" : null ?>" name="num_cuenta" value="<?= $this->cuenta->num_cuenta ?>">

                    <?php if (isset($this->errores["num_cuenta"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["num_cuenta"] ?>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Cliente</label>
                    <select class="form-select form-select-lg
                     <?= (isset($this->errores["id_cliente"])) ? "is-invalid" : null ?>" name="id_cliente" id="">

                        <option selected disabled>Seleccione un cliente </option>
                        <?php foreach ($this->clientes as  $cliente) : ?>
                            <div class="form-check">

                                <option value="<?= $cliente->id ?>" <?= ($this->cuenta->id_cliente == $cliente->id) ? "selected" : null; ?>>
                                    <?= $cliente->nombre ?>
                                </option>
                            </div>

                        <?php endforeach; ?>

                    </select>

                    <?php if (isset($this->errores["id_cliente"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["id_cliente"] ?>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="mb-3">

                    <label for="" class="form-label">Fecha alta</label>
                    <input type="date" class="form-control <?= (isset($this->errores["fecha_alta"])) ? "is-invalid" : null ?>" name="fecha_alta" value="<?= $this->cuenta->fecha_alta ?>">

                    <?php if (isset($this->errores["fecha_alta"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["fecha_alta"] ?>
                        </span>
                    <?php endif; ?>
                </div>


                <div class="mb-3">

                    <label for="" class="form-label">Saldo</label>
                    <input type="text" class="form-control <?= (isset($this->errores["saldo"])) ? "is-invalid" : null ?>" name="saldo" id="" value="<?= $this->cuenta->saldo ?>">

                </div>



                <div class="mb-3">

                    <a name="" id="" class="btn btn-secondary" href="<?= URL ?>cuentas" role="button">Cancelar</a>
                    <button type="reset" class="btn btn-danger">Borrar</button>
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