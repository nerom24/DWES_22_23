<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("template/partials/head.php");  ?>
    <title>Editar Album</title>
</head>
<body>

    <?php require_once "template/partials/menuAut.php"; ?>
    <div class="container">
        <?php include "views/albumes/partials/cabecera.php" ?>
        <div class="mb-3">
            <form action="<?= URL ?>albumes/update/<?=$this->id?>" method="POST">
                <div class="mb-3">
                    <label for="" class="form-label">Titulo</label>
                    <input type="text" class="form-control
                    <?= (isset($this->errores["titulo"])) ? "is-invalid" : null ?>" name="titulo" value="<?= $this->album->titulo ?>">
                    <?php if (isset($this->errores["titulo"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["titulo"] ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Descripcion</label>
                    <input type="text" class="form-control
                    <?= (isset($this->errores["descripcion"])) ? "is-invalid" : null ?>" name=" descripcion" value="<?= $this->album->descripcion ?>">
                    <?php if (isset($this->errores["descripcion"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["descripcion"] ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Autor</label>
                    <input type="text" class="form-control
                    <?= (isset($this->errores["autor"])) ? "is-invalid" : null ?>" name="autor" value="<?= $this->album->autor ?>">
                    <?php if (isset($this->errores["autor"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["autor"] ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">fecha</label>
                    <input type="date" class="form-control
                    <?= (isset($this->errores["fecha"])) ? "is-invalid" : null ?>" name="fecha" value="<?= $this->album->fecha ?>">
                    <?php if (isset($this->errores["fecha"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["fecha"] ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Lugar</label>
                    <input type="text" class="form-control
                    <?= (isset($this->errores["lugar"])) ? "is-invalid" : null ?>" name="lugar" value="<?= $this->album->lugar ?>">
                    <?php if (isset($this->errores["lugar"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["lugar"] ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Categoria</label>
                    <input type="text" class="form-control 
                    <?= (isset($this->errores["categoria"])) ? "is-invalid" : null ?>" name=" categoria" id="" value="<?= $this->album->categoria ?>">
                    <?php if (isset($this->errores["categoria"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["categoria"] ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Etiquetas</label>
                    <input type="text" class="form-control
                     <?= (isset($this->errores["etiquetas"])) ? "is-invalid" : null ?>" name="etiquetas" value="<?= $this->album->etiquetas ?>">
                    <?php if (isset($this->errores["etiquetas"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["etiquetas"] ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Nº Foto</label>
                    <input type="text" class="form-control
                     <?= (isset($this->errores["num_fotos"])) ? "is-invalid" : null ?>" name="num_fotos" value="<?= $this->album->num_fotos ?>" readonly>
                    <?php if (isset($this->errores["num_fotos"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["num_fotos"] ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Nº Visitas</label>
                    <input type="text" class="form-control
                     <?= (isset($this->errores["num_visitas"])) ? "is-invalid" : null ?>" name="num_visitas" value="<?= $this->album->num_visitas ?>" readonly>
                    <?php if (isset($this->errores["num_visitas"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["num_visitas"] ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Carpeta</label>
                    <input type="text" class="form-control
                    <?= (isset($this->errores["carpeta"])) ? "is-invalid" : null ?>" name="carpeta" value="<?= $this->album->carpeta ?>">
                    <?php if (isset($this->errores["carpeta"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["carpeta"] ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <a name="" id="" class="btn btn-secondary" href="<?= URL ?>albumes" role="button">Cancelar</a>
                    <button type="reset" class="btn btn-danger">Borrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
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