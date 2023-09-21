<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("template/partials/head.php");  ?>
    <title>Editar Cliente</title>

</head>

<body>

    <?php require_once "template/partials/menuAut.php"; ?>

    <div class="container">

        <?php include "views/albumes/partials/cabecera.php" ?>



        <div class="album py-5 bg-light">
            <div class="container">
                <h1 class="fs-2 lead text">DETALLES:</h1>

                <div>
                    <p class="fs-4 lead text-muted ">Título: <?= $this->album->titulo ?></p>
                    <p class="fs-4 lead text-muted">Descripción: <?= $this->album->descripcion ?></p>
                </div>


                <h1 class="fs-2 lead text">CONTENIDO:</h1>

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php for ($i = 0; $i < count($this->archivos); $i++) : ?>
                        <div class="col">
                            <div class="card">
                                <img src="" width="200px" height="200px">
                            </div>
                            <p style="font-size:25px;"><?= $i + 1 ?>: <?= $this->archivos[$i] ?> </p>
                        </div>
                    <?php endfor; ?>

                </div>
            </div>
            <div >

                <a class="btn btn-primary " href="<?= URL ?>albumes" >Volver</a>

            </div>
        </div>
    </div>

    <br><br><br>

    <!-- footer -->
    <?php require_once "template/partials/footer.php" ?>


    <!-- Bootstrap JS y popper -->
    <?php require_once "template/partials/javascript.php" ?>
</body>

</html>