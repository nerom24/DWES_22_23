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
                    <input type="text" class="form-control" name="nombre" value="<?= $this->cliente->nombre?>">

                </div>
                <div class="mb-3">

                    <label for="" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" value="<?= $this->cliente->apellidos?>">
                </div>

                <div class="mb-3">

                    <label for="" class="form-label">Ciudad</label>
                    <input type="text" class="form-control" name="ciudad" value="<?= $this->cliente->ciudad?>">
                </div>
            
                <div class="mb-3">

                    <label for="" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="" value="<?= $this->cliente->email?>">
                </div>

                <div class="mb-3">

                    <label for="" class="form-label">Telefono</label>
                    <input type="text" class="form-control" name="telefono" id="" value="<?= $this->cliente->telefono?>">
                </div>



                <div class="mb-3">

                    <label for="" class="form-label">DNI</label>
                    <input type="text" class="form-control" name="dni" id="" value="<?= $this->cliente->dni?>">
                </div>



                    <div class="mb-3">

                        <a name="" id="" class="btn btn-secondary" href="<?= URL ?>clientes" role="button">Cancelar</a>
                        <button type="button" class="btn btn-danger">Borrar</button>
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