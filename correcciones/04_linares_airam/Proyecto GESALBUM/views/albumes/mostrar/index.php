<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("template/partials/head.php");  ?>
    <title>Mostar Álbum</title>

</head>

<body>

    <?php require_once "template/partials/menu.php"; ?>

    <div class="container">

        <?php include "views/albumes/partials/cabecera.php" ?>

        <div class="mb-3">
            <form action="<?= URL ?>albumes/update/<?= $this->id ?>" method="POST">

                <table class="table">
                    <tr>
                        <th>Titulo</th>
                        <th>Descripcion</th>
                        <th>Autor</th>
                        <th>Fecha</th>
                        <th>Lugar</th>
                        <th>Categoria</th>
                        <th>Etiquetas</th>
                        <th>Carpeta</th>
                    </tr>
                    <tr>
                        <td><?= $this->album->titulo ?></td>
                        <td><?= $this->album->descripcion ?></td>
                        <td><?= $this->album->autor ?></td>
                        <td><?= $this->album->fecha ?></td>
                        <td><?= $this->album->lugar ?></td>
                        <td><?= $this->album->categoria ?></td>
                        <td><?= $this->album->etiquetas ?></td>
                        <td><?= $this->album->carpeta ?></td>
                    </tr>
                </table>

                <div class="mb-3">
                    <a name="" id="" class="btn btn-secondary" href="<?= URL ?>albumes" role="button">Volver</a>
                </div>
                <div class="container">
                    <?php
                    $directory = './images/' . $this->album->carpeta . '/';
                    $images = glob($directory . "*.*", GLOB_BRACE);
                    foreach ($images as $image) {
                        echo '<div>
                                <img src="../.' . $image . '"  alt="Imagen no cargada" id="imagen" class="img-fluid img-thumbnail">
                            </div>';
                    }
                    ?>
                </div>


            </form>
        </div>

    </div>

    <br><br><br>

    <?php require_once "template/partials/footer.php" ?>

    <?php require_once "template/partials/javascript.php" ?>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</html>