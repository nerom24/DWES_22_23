<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once("template/partials/head.php");  ?>
    <title>Formulario Nuevo</title>
</head>
<body>
    <?php require_once "template/partials/menu.php"; ?>

    <style>
        #img {
            width: 50px;
            height: 50px;
        }
    </style>

    <div class="container">
        <div class="mb-3">
            <br><br>
            <form action="<?= URL ?>contactar/validar" method="POST">
            <h2>CONTACTANOS</h2>
            <h4>Redacta aquí abajo</h4>
            <img id="img" src="https://images.emojiterra.com/google/android-nougat/512px/2b07.png">
            <br>
                <!-- NOMBRE -->
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

                <!-- EMAIL -->
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

                <!-- ASUNTO -->
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

                <!-- MENSAJE -->
                <div class="mb-3">
                    <label for="" class="form-label">Mensaje</label>
                    <input type="text" class="form-control 
                    <?= (isset($this->errores["mensaje"])) ? "is-invalid" : null ?>" name=" mensaje"></input>
                    <?php if (isset($this->errores["mensaje"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["mensaje"] ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <a name="" style="position: absolute;left: 42%;" class="btn btn-secondary" href="<?= URL ?>main" role="button">Volver</a>
                    <button type="submit" style="position: absolute;left: 48%;" class="btn btn-primary">Enviar</button>
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