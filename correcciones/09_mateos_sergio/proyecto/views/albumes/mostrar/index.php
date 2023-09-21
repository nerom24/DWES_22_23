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


                <div class="mb-3">
                    <label for="" class="form-label">Titulo</label>
                    <input type="text" class="form-control
                    <?= (isset($this->errores["titulo"])) ? "is-invalid" : null ?>" name="titulo" value="<?= $this->album->titulo ?>" disabled>

                    <?php if (isset($this->errores["titulo"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["titulo"] ?>
                        </span>
                    <?php endif; ?>

                </div>
                <div class="mb-3">

                    <label for="" class="form-label">Descripcion</label>
                    <input type="text" class="form-control
                    <?= (isset($this->errores["descripcion"])) ? "is-invalid" : null ?>" name="descripcion" value="<?= $this->album->descripcion ?>" disabled>
                    <?php if (isset($this->errores["descripcion"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["descripcion"] ?>
                        </span>
                    <?php endif; ?>

                </div>

                <div class="mb-3">

                    <label for="" class="form-label">Autor</label>
                    <input type="text" class="form-control
                    <?= (isset($this->errores["autor"])) ? "is-invalid" : null ?>" name="autor" value="<?= $this->album->autor ?>" disabled>
                    <?php if (isset($this->errores["autor"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["autor"] ?>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="mb-3">

                    <label for="" class="form-label">Fecha</label>
                    <input type="date" class="form-control
                    <?= (isset($this->errores["fecha"])) ? "is-invalid" : null ?>" name="fecha" id="" value="<?= $this->album->fecha ?>" disabled>
                    <?php if (isset($this->errores["fecha"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["fecha"] ?>
                        </span>
                    <?php endif; ?>

                </div>

                <div class="mb-3">

                    <label for="" class="form-label">Lugar</label>
                    <input type="text" class="form-control 
                    <?= (isset($this->errores["lugar"])) ? "is-invalid" : null ?>" name="lugar" id="" value="<?= $this->album->lugar ?>" disabled>
                    <?php if (isset($this->errores["lugar"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["lugar"] ?>
                        </span>
                    <?php endif; ?>

                </div>



                <div class="mb-3">

                    <label for="" class="form-label">Categoria</label>
                    <input type="text" class="form-control
                     <?= (isset($this->errores["categoria"])) ? "is-invalid" : null ?>" name="categoria" value="<?= $this->album->categoria ?>" disabled>
                    <?php if (isset($this->errores["categoria"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["categoria"] ?>
                        </span>
                    <?php endif; ?>

                </div>
                <div class="mb-3">

                    <label for="" class="form-label">Etiquetas</label>
                    <input type="text" class="form-control
                     <?= (isset($this->errores["etiquetas"])) ? "is-invalid" : null ?>" name="etiquetas" value="<?= $this->album->etiquetas ?>" disabled>
                    <?php if (isset($this->errores["etiquetas"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["etiquetas"] ?>
                        </span>
                    <?php endif; ?>

                </div>
                <div class="mb-3">

                    <label for="" class="form-label">Carpeta</label>
                    <input type="text" class="form-control
                     <?= (isset($this->errores["carpeta"])) ? "is-invalid" : null ?>" name="carpeta" value="<?= $this->album->carpeta ?>" disabled>
                    <?php if (isset($this->errores["carpeta"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["carpeta"] ?>
                        </span>
                    <?php endif; ?>

                </div>

                <div class="mb-3">

                    <a name="" id="" class="btn btn-secondary" href="<?= URL ?>albumes" role="button">Volver</a>

                </div>
                <div class="container">
                    <div class="album py-5 bg-light">
                        <div class="container">
                            <div class="row d-flex align-items-stretch row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                                <?php
                                function format_bytes(int $size)
                                {
                                    $base = log($size, 1024);
                                    $suffixes = array('', 'KB', 'MB', 'GB', 'TB');
                                    return round(pow(1024, $base - floor($base)), 2) . '' . $suffixes[floor($base)];
                                }
                                $directory = './images/' . $this->album->carpeta . '/';
                                $images = glob($directory . "*.*", GLOB_BRACE);
                                foreach ($images as $image) {
                                    $this->file_info = array();
                                    $pathinfo = pathinfo($image);
                                    $stat = stat($image);
                                    $this->file_info['basename'] = $pathinfo['basename'];
                                    $this->file_info['extension'] = $pathinfo['extension'];
                                    $this->file_info['size_string'] = format_bytes($stat[7]);
                                    $this->file_info['mtime'] = $stat[9];
                                    echo '<div class="col">
                                            <div class="card shadow-sm">
                                            <img src="../.' . $image . '"  width="150" height="250" alt="Imagen no cargada" id="imagen" class="bd-placeholder-img card-img-top">
                                            <div class="card-body">
                                                <p class="card-text"> Nombre: ' . $this->file_info['basename'] . '</p>
                                                <p class="card-text"> Tamaño: ' . $this->file_info['size_string'] . '</p>
                                                <p class="card-text"> Formato: ' . $this->file_info['extension'] . '</p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary">Ver</button>
                                                </div>
                                                <small class="text-muted">' . date("d/m/Y", filemtime($image)) . '</small>
                                                </div>
                                            </div>
                                            </div>
                                    </div>';
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                </div>


            </form>
        </div>

    </div>

    <br><br><br>

    <?php require_once "template/partials/footer.php" ?>

    <?php require_once "template/partials/javascript.php" ?>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $(".btn-outline-secondary").click(function() {
            var src = $(this).closest(".card").find("img").attr("src");
            $("#imageModal").modal("show");
            $("#imageModal .modal-body").html('<img src="' + src + '" class="img-fluid">');
        });
    });
</script>

<div class="modal" tabindex="-1" role="dialog" id="imageModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body"></div>
        </div>
    </div>
</div>

</html>