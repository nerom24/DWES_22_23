<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("template/partials/head.php");  ?>
    <title>Editar Cliente</title>

</head>

<body>

    <?php require_once "template/partials/menu.php"; ?>

    <div class="container">

        <?php include "views/clientes/partials/cabecera.php" ?>

        <div class="mb-3">
            <form action="<?= URL ?>clientes/update/<?= $this->id ?>" method="POST">

            
            <div class="mb-3">
                    <label for="" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" value="<?= $this->cliente->nombre?>" disabled>

                </div>
                <div class="mb-3">

                    <label for="" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" value="<?= $this->cliente->apellidos?>" disabled>
                </div>

                <div class="mb-3">

                    <label for="" class="form-label">Ciudad</label>
                    <input type="text" class="form-control" name="ciudad" value="<?= $this->cliente->ciudad?>"disabled >
                </div>
            
                <div class="mb-3">

                    <label for="" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="" value="<?= $this->cliente->email?>"disabled>
                </div>

                <div class="mb-3">

                    <label for="" class="form-label">Telefono</label>
                    <input type="text" class="form-control" name="telefono" id="" value="<?= $this->cliente->telefono?>" disabled>
                </div>



                <div class="mb-3">

                    <label for="" class="form-label">DNI</label>
                    <input type="text" class="form-control" name="dni" id="" value="<?= $this->cliente->dni?>"disabled>
                </div>



                    <div class="mb-3">

                        <a name="" id="" class="btn btn-secondary" href="<?= URL ?>clientes" role="button">Volver</a>

                    </div>

            </form>
        </div>

    </div>

    <br><br><br>

    <?php require_once "template/partials/footer.php" ?>

    <?php require_once "template/partials/javascript.php" ?>
</body>

</html>