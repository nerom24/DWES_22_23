<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("template/partials/head.php");  ?>
    <title>Nuevo Gestion Usuario</title>

</head>

<body>

    <?php require_once "template/partials/menu.php"; ?>

    <div class="container">

        <?php include "views/users/partials/cabecera.php" ?>

        <div class="mb-3">
            <form action="<?= URL ?>users/create" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control
                    <?= (isset($this->errores["name"])) ? "is-invalid" : null ?>" name="name" value="<?= $this->user->name ?>">
                    <?php if (isset($this->errores["name"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["name"] ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control
                    <?= (isset($this->errores["email"])) ? "is-invalid" : null ?>" name="email" id="" value="<?= $this->user->email ?>">
                    <?php if (isset($this->errores["email"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["email"] ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Rol</label>
                    <select class="form-select form-select-lg 
                     <?= (isset($this->errores["id_rol"])) ? "is-invalid" : null ?>" name="id_rol" id="">
                        <option selected disabled>Seleccione un rol </option>
                        <?php foreach ($this->roles as $rol) : ?>
                            <div class="form-check">
                                <option value="<?= $rol["id"] ?>">
                                    <?= $rol["name"] ?>
                                </option>
                            </div>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($this->errores["id_rol"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["id_rol"] ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control
                    <?= (isset($this->errores["password"])) ? "is-invalid" : null ?>" name="password" id="" value="<?= $this->user->password ?>">
                    <?php if (isset($this->errores["password"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["password"] ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="password-confirm" class="form-label">Confirmar Password</label>
                        <input id="password" type="password" class="form-control" name="password-confirm" required autocomplete="new-password">
                </div>
                <div class="mb-3">
                    <a name="" id="" class="btn btn-secondary" href="<?= URL ?>users" role="button">Cancelar</a>
                    <button type="button" class="btn btn-danger">Borrar</button>
                    <button type="submit" class="btn btn-primary">Crear</button>

                </div>

            </form>
        </div>

    </div>

    <br><br><br>

    <?php require_once "template/partials/footer.php" ?>

    <?php require_once "template/partials/javascript.php" ?>
</body>

</html>