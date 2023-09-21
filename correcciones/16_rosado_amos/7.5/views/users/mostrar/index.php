<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("template/partials/head.php");  ?>
    <title>Mostrar Usuario</title>

</head>

<body>

    <?php require_once "template/partials/menu.php"; ?>

    <div class="container">

        <?php include "views/users/partials/cabecera.php" ?>

        <div class="mb-3">
            <form action="<?= URL ?>users/update/<?= $this->id ?>" method="POST">
            <div class="mb-3">
                    <label for="" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="name" value="<?= $this->user->name?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="" value="<?= $this->user->email?>"disabled>
                </div>
                <div class="mb-3 ">
                    <label for="" class="col-md-4 col-form-label">Perfil</label>
                    <select class="form-select form-select-mg 
                     <?= (isset($this->errores["id_rol"])) ? "is-invalid" : null ?>" name="id_rol" id="" disabled>

                        <option selected disabled>Seleccione un perfil </option>
                        <?php foreach ($this->roles as  $rol) : ?>
                            <div class="form-check">
                                <option value="<?= $rol["id"] ?>" <?= ($rol["id"] == $this->user->role_id) ? "selected" : null ?>>
                                    <?= $rol["name"] ?>
                                </option>
                            </div>

                        <?php endforeach; ?>

                    </select>

                    <?php if (isset($this->errores["id_cliente"])) : ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores["id_cliente"] ?>
                        </span>
                    <?php endif; ?>
                </div>         
                <div class="mb-3">
                    <a name="" id="" class="btn btn-secondary" href="<?= URL ?>users" role="button">Volver</a>
                </div>
            </form>
        </div>

    </div>

    <br><br><br>

    <?php require_once "template/partials/footer.php" ?>

    <?php require_once "template/partials/javascript.php" ?>
</body>

</html>