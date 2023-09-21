<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("template/partials/head.php");  ?>
    <title>Editar Usuario</title>

</head>

<body>

    <?php require_once "template/partials/menu.php"; ?>

    <div class="container">

        <?php include "views/users/partials/cabecera.php" ?>

        <div class="mb-3">
            <form action="<?= URL ?>users/update/<?= $this->id ?>" method="POST">
            <div class="mb-3">
                    <label for="" class="form-label">Nombre</label>
                    <input type="text" class="form-control
                    <?= (isset($this->errores["name"])) ? "is-invalid" : null ?>" name=" name" value="<?= $this->user->name ?>" disabled>

                    <?php if (isset($this->errores["name"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["name"] ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="email" class="form-control
                    <?= (isset($this->errores["email"])) ? "is-invalid" : null ?>" name="email" id="" value="<?= $this->user->email ?>" disabled>
                    <?php if (isset($this->errores["email"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["email"] ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Rol</label>
                    <select type="text" class="form-control
                    <?= (isset($this->errores["perfil"])) ? "is-invalid" : null ?>" name="perfil" value="<?= $this->user->perfil ?>">
                    <option selected disabled>Seleccione Perfil</option>
                        <?php foreach ($this->cursos as $curso): ?>
                            <option value="<?= $curso->id ?>"
                            <?= ($this->alumno->id_curso == $curso->id)? 'selected' : null ?>
                            ><?= $curso->curso ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($this->errores["perfil"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["perfil"] ?>
                        </span>
                    <?php endif; ?>
                </div>
                    <div class="mb-3">
                        <a name="" id="" class="btn btn-secondary" href="<?= URL ?>users" role="button">Cancelar</a>
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