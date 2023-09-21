<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen Tema 2. </title>

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
            <span class="fs-4">Examen Práctico - Tema 2. Inserción de código en páginas web</span>
        </header>

        <legend>Conversión entre Sistemas Numéricos</legend>

        <!-- Formulario  -->
    
        <form method="POST" action="conversor.php">
            <div class="mb-3">
                <label for="exampleInputNum" class="form-label">Número</label>
                <input type="text" class="form-control" id="exampleInputNumber"  value="<?=$num ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="exampleInputBase" class="form-label">Base</label>
                <input type="text" class="form-control"  value="<?=$base ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="exampleInputBase" class="form-label">Convertir a base</label>
                <input type="text" class="form-control"  value="<?=$base_convert ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="exampleInputBase" class="form-label">Conversión</label>
                <input type="text" class="form-control"  value="<?=$num_convert ?>" readonly>
            </div>
            <a class="btn btn-primary" href="index.php" role="button">Nueva Conversión</a>
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