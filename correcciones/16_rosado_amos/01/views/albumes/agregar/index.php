<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("template/partials/head.php");  ?>
    <title>Nuevo Gestion Usuario</title>

</head>

<body>

    <?php require_once "template/partials/menuAut.php"; ?>

    <div class="container">

        <?php include "views/albumes/partials/cabecera.php" ?>


        <form action="<?= URL ?>albumes/upload/<?= $this->id ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="MAX_FILE_SIZE" value="4194304" />
            <label for="" class="form-label h2">Importar:</label>

            <div class="mb-3">

                <input class="form-control" type="file" id="formFile" name="archivo" accept="image/jpeg, image/gif, image/png">
            </div>
            <?php if (isset($this->errores["archivo"])) : ?>
                <span class="form-text text-danger" role="alert">
                    <?= $this->errores["archivo"] ?>
                </span>
            <?php endif; ?>

            <br><br><br>
            <a name="" id="" class="btn btn-secondary" href="<?= URL ?>albumes" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>





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