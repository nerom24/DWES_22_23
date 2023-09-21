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

                <div style="display: flex; justify-content: space-around; margin-bottom:30px; margin-top:35px; ">
                    <p class="fs-4 lead text-muted ">Título: <?= $this->album->titulo ?></p>
                    <p class="fs-4 lead text-muted">Descripción: <?= $this->album->descripcion ?></p>
                    <p class="fs-4 lead text-muted">Fecha Creación: <?= $this->album->fecha ?></p>
                    <p class="fs-4 lead text-muted">Autor: <?= $this->album->autor ?></p>
                </div>


                <h1 class="fs-2 lead text">CONTENIDO:</h1>

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

                    <?php foreach ($this->archivos as $indice => $archivo) : ?>

                        <div class="col">


                            <div class="card" style="width: 18rem;">
                                <img src="../../../mvc-proyect/images/<?= $this->album->carpeta ?>/<?= $archivo ?>" class="card-img-top" width="200px" height="200px" alt="">

                            </div>
                            <p class="fs-4 lead text-muted"><?= $indice + 1 ?>: <?= $archivo ?> </p>
                        </div>

                    <?php endforeach; ?>

                </div>
            </div>
            <div class="d-grid gap-2">

                <a class="btn btn-primary " href="<?= URL ?>albumes" role="button">Volver</a>

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