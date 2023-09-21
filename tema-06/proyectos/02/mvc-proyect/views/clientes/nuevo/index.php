<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("template/partials/head.php");  ?>
    <title>Nuevo Gestion Usuario</title>

</head>

<body>

<?php require_once "template/partials/menu.php"; ?>
        
    <div class="container">
        
        <?php include "views/clientes/partials/cabecera.php" ?>

        <div class="mb-3">
            <form action="<?=URL?>clientes/create" method="POST">
            
         
   
                <div class="mb-3">
                    <label for="" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre">

                </div>
                <div class="mb-3">

                    <label for="" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos">
                </div>

                <div class="mb-3">

                    <label for="" class="form-label">Ciudad</label>
                    <input type="text" class="form-control" name="ciudad">
                </div>
            
                <div class="mb-3">

                    <label for="" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="">
                </div>

                <div class="mb-3">

                    <label for="" class="form-label">Telefono</label>
                    <input type="text" class="form-control" name="telefono" id="">
                </div>



                <div class="mb-3">

                    <label for="" class="form-label">DNI</label>
                    <input type="text" class="form-control" name="dni" id="">
                </div>


                <div class="mb-3">

                    <a name="" id="" class="btn btn-secondary" href="<?=URL?>clientes" role="button">Cancelar</a>
                    <button type="button" class="btn btn-danger">Borrar</button>
                    <button type="submit" class="btn btn-primary">Crear</button>

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