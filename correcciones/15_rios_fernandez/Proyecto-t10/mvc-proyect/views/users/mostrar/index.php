<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("template/partials/head.php");  ?>
    <title>Nuevo Gestion Cuentas</title>

</head>

<body>

    <?php require_once "template/partials/menu.php"; ?>

    <div class="container">

        <?php include "views/clientes/partials/cabecera.php" ?>

        <?php include "template/partials/error.php" ?>

        <div class="mb-3">
            <form method="POST">

                <!-- campo name -->
                <div class="mb-3 row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Nombre Usuario</label>

                    <div class="col-md-6">
                        <input id="name" disabled type="text" class="form-control <?= (isset($this->errores['name'])) ? 'is-invalid' : null ?>" name="name" value="<?= $this->user->name ?>" autofocus>

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
                        <input id="email" disabled type="email" class="form-control <?= (isset($this->errores['email'])) ? 'is-invalid' : null ?>" name="email" value="<?= $this->user->email ?>" required autocomplete="email" autofocus>

                        <?php if (isset($this->errores['email'])) : ?>
                            <span class="form-text text-danger" role="alert">
                                <?= $this->errores['email'] ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>


                <div class="mb-3 ">
                    <label for="" class="col-md-4 col-form-label">Perfil</label>
                    <select class="form-select form-select-lg 
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




                <div class="mb-3 ">

                    <a name="" id="" class="btn btn-secondary" href="<?= URL ?>users" role="button">Volver</a>


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