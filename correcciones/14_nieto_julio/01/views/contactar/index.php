<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("template/partials/head.php");  ?>
    <title>Contactar</title>

</head>

<body>

    <?php require_once "template/partials/menu.php"; ?>

    <div class="mb-3">
        <br><br>
        <form action="<?= URL ?>contactar/validar" method="POST">

            <div class="container">
            <div class="mb-3">
                <label for="" class="form-label">Nombre</label>
                <input type="text" class="form-control
                    <?= (isset($this->errores["nombre"])) ? "is-invalid" : null ?>" name=" nombre">

                <?php if (isset($this->errores["nombre"])) : ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores["nombre"] ?>
                    </span>
                <?php endif; ?>

            </div>
            <div class="mb-3">

                <label for="" class="form-label">Email</label>
                <input type="email" class="form-control
                    <?= (isset($this->errores["email"])) ? "is-invalid" : null ?>" name="email">
                <?php if (isset($this->errores["email"])) : ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores["email"] ?>
                    </span>
                <?php endif; ?>

            </div>

            <div class="mb-3">

                <label for="" class="form-label">Asunto</label>
                <input type="text" class="form-control
                    <?= (isset($this->errores["asunto"])) ? "is-invalid" : null ?>" name=" asunto">
                <?php if (isset($this->errores["asunto"])) : ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores["asunto"] ?>
                    </span>
                <?php endif; ?>
            </div>

            <div class="mb-3">

                <label for="" class="form-label">Mensaje</label>
                <textarea type="textarea" class="form-control 
                    <?= (isset($this->errores["mensaje"])) ? "is-invalid" : null ?>" name=" mensaje"></textarea>
                <?php if (isset($this->errores["mensaje"])) : ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores["mensaje"] ?>
                    </span>
                <?php endif; ?>

            </div>

            <div class="mb-3">

                <a name="" id="" class="btn btn-secondary" href="<?= URL ?>clientes" role="button">Cancelar</a>
                <button type="reset" class="btn btn-danger">Borrar</button>
                <button type="submit" class="btn btn-primary">Enviar</button>

            </div>
            </div>
            

        </form>
    </div>


    <br><br><br>

    <!-- footer -->
    <?php require_once "template/partials/footer.php" ?>


    <!-- Bootstrap JS y popper -->
    <?php require_once "template/partials/javascript.php" ?>
</body>

</html>