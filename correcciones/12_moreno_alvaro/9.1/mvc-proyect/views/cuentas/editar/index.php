<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("template/partials/head.php");  ?>
    <title>EDITAR CUENTA</title>
</head>

<body>

    <?php require_once "template/partials/menu.php"; ?>

    <div class="container">

        <?php include "views/clientes/partials/cabecera.php" ?>

        <div class="mb-3">
            <form action="<?= URL ?>cuentas/update/<?=$this->id?>" method="POST">

                <div class="mb-3">

                    <label for="" class="form-label">Nº de cuenta</label>
                    <input type="text" class="form-control
                    <?=(isset($this->errores["num_cuenta"]))? "is-invalid":null?>"
                     name="num_cuenta" value="<?=$this->cuenta->num_cuenta ?>" disabled>

                     <?php if (isset($this->errores["num_cuenta"])):?>
                    <span class="form-text text-danger" role="alert">
                        <?=$this->errores["num_cuenta"]?>
                    </span>
                    <?php endif;?>

                </div>

                <div class="mb-3">

                    <label for="" class="form-label">Cliente</label>
                    <select class="form-select form-select-lg
                     <?=(isset($this->errores["id_cliente"]))? "is-invalid":null?>"
                     name="id_cliente" id="">

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
                    <?php if (isset($this->errores["id_cliente"])):?>
                    <span class="form-text text-danger" role="alert">
                        <?=$this->errores["id_cliente"]?>
                    </span>
                    <?php endif;?>

                </div>

                <div class="mb-3">

                    <label for="" class="form-label">Saldo</label>
                    <input type="text" class="form-control 
                    <?=(isset($this->errores["saldo"]))? "is-invalid":null?>" 
                    name="saldo" id="" value="<?=$this->cuenta->saldo ?>" readonly>
                    
                </div>

                <div class="mb-3">

                    <a name="" id="" class="btn btn-secondary" href="<?= URL ?>cuentas" role="button">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar</button>

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