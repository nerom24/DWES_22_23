<?php

    session_start();

    # campos vacios del formulario

    $usuario = null;
    $email = null;
    $archivo = null;

    # compruebo existe un error
    if (isset($_SESSION['error'])) {

        $error = $_SESSION['error'];
        $errores = $_SESSION['errores'];
        $email = $_SESSION['email'];
        $usuario = $_SESSION['usuario'];
        $archivo = $_SESSION['archivo'];

    }

    # compruebo si existe algún mensaje
    if (isset($_SESSION['mensaje'])) {
        $mensaje = $_SESSION['mensaje'];
    }

    session_unset();
    session_destroy();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plantilla Bootstrap 5.2.2</title>

    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- Bootstrap Icons 1.9.1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" integrity="sha384-xeJqLiuOvjUBq3iGOjvSQSIlwrpqjSHXpduPd6rQpuiM3f5/ijby8pCsnbu5S81n" crossorigin="anonymous">
</head>
<body>
    <!-- Capa Principal -->
    <div class="container">

        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-app-indicator"></i>        
            <span class="fs-4">Formulario con subida archivos</span>
        </header>

         <!-- Error -->
         <?php if (isset($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>ERROR</strong> <?= $error ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif;?>

        <!-- Mensaje -->
        <?php if (isset($mensaje)): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Mensaje</strong> <?= $mensaje ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif;?>

        <form action="validar.php" method="POST" enctype="multipart/form-data">

            <!-- Campo oculto máximo tamaño archivo subidos -->
            <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
            <!-- campo usuario -->
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input type="text" class="form-control" name="usuario" value="<?= $usuario ?>">
                <span class="form-text text-danger" role="alert">
                    <?= $errores['usuario'] ??= null ?>
                </span>
            </div>

            <!-- campo email -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?= $email ?>">
                <span class="form-text text-danger" role="alert">
                    <?= $errores['email'] ??= null ?>
                </span>
            </div>

            <!-- campo file -->
            <div class="mb-3">
                <label for="formFile" class="form-label">Añadir imagen</label>
                <input class="form-control" type="file" id="formFile" name="archivo"  accept="image/*" value="<?= $archivo ?>">
                <span class="form-text text-danger" role="alert">
                    <?= $errores['archivo'] ??= null ?>
                </span>
            </div>

            <button type="reset" class="btn btn-danger">Cancelar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>

        </form>

    </div>

    <!-- Pie del documento -->
    <footer class="footer mt-auto py-3 fixed-bottom bg-light">
        <div class="container">
            <span class="text-muted">© 2022
                Juan Carlos Moreno - DWES - 2º DAW - Curso 22/23</span>
        </div>
    </footer>

    <!-- Bootstrap Javascript y popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
 
</body>
</html>