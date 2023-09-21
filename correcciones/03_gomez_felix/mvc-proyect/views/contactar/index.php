<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">


    <!-- Bottstrap icons 1.9 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
</head>

<body style="display:flex; flex-direction:column; justify-content:center; align-items:center; height:100vh;">
    <?php require_once("template/partials/menuBar.php") ?>

    <legend class="h1" style="width:fit-content"> Formulario de contacto</legend>

    <form action="<?= URL ?>contactar/validar" method="POST" enctype="multipart/form-data">

        <div class="mb-3">

            <label for="" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre">
            <?php if (isset($this->errores["nombre"])) : ?>
                <span class="form-text text-danger" role="alert">
                    <?= $this->errores["nombre"] ?>
                </span>
            <?php endif; ?>
        </div>
        <div class="mb-3">

            <label for="" class="form-label">Correo</label>
            <input type="email" class="form-control" name="remitente">
            <?php if (isset($this->errores["remitente"])) : ?>
                <span class="form-text text-danger" role="alert">
                    <?= $this->errores["remitente"] ?>
                </span>
            <?php endif; ?>
        </div>

        <div class="mb-3">

            <label for="" class="form-label">Asunto</label>
            <input type="text" class="form-control" name="asunto">
            <?php if (isset($this->errores["asunto"])) : ?>
                <span class="form-text text-danger" role="alert">
                    <?= $this->errores["asunto"] ?>
                </span>
            <?php endif; ?>
        </div>
        <div class="mb-3">

            <div class="form-floating">
                <textarea class="form-control" name="mensaje" id="floatingTextarea"></textarea>
                <label for="floatingTextarea">Mensaje</label>
            </div>
            <?php if (isset($this->errores["mensaje"])) : ?>
                <span class="form-text text-danger" role="alert">
                    <?= $this->errores["mensaje"] ?>
                </span>
            <?php endif; ?>
        </div>

        <div class="mb-3">

            <a name="" id="" class="btn btn-secondary" href="<?= URL ?>main" role="button">Atras</a>
            <button type="submit" class="btn btn-primary">Enviar</button>

        </div>

    </form>
</body>

</html>