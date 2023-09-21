<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("template/partials/head.php");  ?>
    <title>Añadir Imagen</title>
</head>
<body>
    <?php require_once "template/partials/menu.php"; ?>
    <div class="container">

        <?php include "views/albumes/partials/cabecera.php" ?>
        <div class="mb-3">
        <form action="<?= URL ?>albumes/cargar/<?= $this->album->carpeta ?>" method="POST" enctype="multipart/form-data">
        <br><br>
            <div class="mb-3">
                <label for="formFile" class="form-label">Añadir imagen</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="4000000">
                <input class="form-control" type="file" id="formFile" name="archivo" accept="image/jpeg, image/gif, image/png">
            </div>
            <br><br>   
            <a name="" id="" class="btn btn-secondary" href="<?= URL ?>albumes" role="button">Volver</a>
            <button type="submit" class="btn btn-primary">Enviar</button>

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