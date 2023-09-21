<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("template/partials/head.php");  ?>
    <title>Editar Gestion Usuario</title>

</head>

<body>

    <?php require_once "template/partials/menu.php"; ?>

    <div class="container">

        <?php include "views/clientes/partials/cabecera.php" ?>

        <?php include "template/partials/error.php" ?>

        <div class="mb-3">
            <form action="<?= URL ?>users/update/<?= $this->id ?>" method="POST">

                <!-- campo name -->
                <div class="mb-3 row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Nombre Usuario</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control <?= (isset($this->errores['name'])) ? 'is-invalid' : null ?>" name="name" value="<?= $this->user->name ?>" autofocus>

                        <?php if (isset($this->errores['name'])) : ?>
                            <span class="form-text text-danger" role="alert">
                                <?= $this->errores['name'] ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- campo email -->
                <div class="mb-3 row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control <?= (isset($this->errores['email'])) ? 'is-invalid' : null ?>" name="email" value="<?= $this->user->email ?>" required autocomplete="email" autofocus>

                        <?php if (isset($this->errores['email'])) : ?>
                            <span class="form-text text-danger" role="alert">
                                <?= $this->errores['email'] ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- campo password -->
                <div class="mb-3 row">
                    <label for="password" class="col-md-4 col-form-label ">Password</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control <?= (isset($this->errores['password'])) ? 'is-invalid' : null ?>" name="password" required autocomplete="new-password">

                        <?php if (isset($this->errores['password'])) : ?>
                            <span class="form-text text-danger" role="alert">
                                <?= $this->errores['password'] ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- password confirm -->
                <div class="mb-3 row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmar Password</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password-confirm" required autocomplete="new-password">
                    </div>
                </div>


                <div class="mb-3 ">
                    <label for="" class="col-md-4 col-form-label">Perfil</label>
                    <select class="form-select form-select-lg 
                     <?= (isset($this->errores["id_rol"])) ? "is-invalid" : null ?>" name="id_rol" id="">

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




                <div class="mb-3 ">

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