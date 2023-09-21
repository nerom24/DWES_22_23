<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("template/partials/head.php");  ?>
    <title>Subir Álbum</title>

</head>
<body>

    <?php require_once "template/partials/menu.php"; ?>

    <div class="container">

        <?php include "views/albumes/partials/cabecera.php" ?>

        <div class="mb-3">
            <form action="<?= URL ?>albumes/upload/<?= $this->album->carpeta ?>" method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="formFile" class="form-label">Añadir imagen</label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="4000000">
                    <input class="form-control" type="file" id="formFile" name="archivo" accept="imagenes/jpeg, imagenes/gif, imagenes/png">
                </div>

                <a name="" id="" class="btn btn-secondary" href="<?= URL ?>albumes" role="button">Cancelar</a>
                <button type="submit" class="btn btn-primary">Enviar</button>

            </form>
        </div>
    </div>
    <?php require_once "template/partials/footer.php" ?>
    <?php require_once "template/partials/javascript.php" ?>
</body>
</html>