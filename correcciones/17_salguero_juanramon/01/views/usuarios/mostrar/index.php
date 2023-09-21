<!DOCTYPE html>
<html lang="es">

<head>
<?php require_once("template/partials/head.php");  ?>
    <title><?= $this->tittle ?></title>

</head>

<body>

<?php require_once ("template/partials/menuAut.php") ?>  

    <div class="container">

        <?php include ("views/usuarios/partials/cabecera.php") ?>

        <div class="mb-3">
            <form action="<?= URL?>usuarios/update/<?=$this->id?>" method="POST">

                <div class="mb-3">
                    <label for="" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="name" value="<?= $this->usuarios-> name?>" disabled>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">email</label>
                    <input type="text" class="form-control" name="nombre" value="<?= $this->usuarios->email?>" disabled>

                </div>

                <!--Perfil -->
                <div class="mb-3">
                    <label for="" class="form-label">Perfil</label>
                    <select class="form-select form-select-lg <?= (isset($this->errores['rol']))? 'is-invalid': null ?>" name="rol">
                        <option selected disabled>Seleccione Perfil</option>
                        <?php foreach ($this->perfiles as $perfil): ?>
                            <option value="<?= $perfil->id ?>"
                            <?= ($this->usuarios->rol == $perfil->id)? 'selected' : null ?>
                            ><?= $perfil->rol ?></option>
                        <?php endforeach; ?>
                    </select>
                    <!-- Mostrar posible error -->
                    <?php if (isset($this->errores['rol'])): ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores['rol'] ?>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="mb-3">

                    <a name="" id="" class="btn btn-secondary" href="<?= URL?>/usuarios" role="button">Volver</a>

                </div>

            </form>
        </div>

    </div>

    <br><br><br>

    <!-- footer -->
    <?php require_once ("template/partials/footer.php") ?>

    <!-- Bootstrap JS y popper -->
    <?php require_once ("template/partials/javascript.php") ?>
</body>

</html>