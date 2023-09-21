<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora Básica - Proyecto 2.1</title>

    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- Bootstrap Icons 1.9.1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" integrity="sha384-xeJqLiuOvjUBq3iGOjvSQSIlwrpqjSHXpduPd6rQpuiM3f5/ijby8pCsnbu5S81n" crossorigin="anonymous">
</head>
<body>
    <!-- Capa Principal -->
    <div class="container">

        <header class="pb-3 mb-4 border-bottom">
            <i class="bi-calculator"></i>        
            <span class="fs-4">Proyecto 2.1 - Calculadora Básica</span>
        </header>

        <legend><?= $operacion?></legend>
        <!-- Mostrar Valor 1 -->
        <div class="mb-3">
            <label class="form-label">Valor 1</label>
            <input type="number" class="form-control" placeholder=""  value="<?= $valor1 ?>" readonly>
        </div>

        <!-- Mostrar Valor 2 -->
        <div class="mb-3">
            <label class="form-label">Valor 2</label>
            <input type="number" class="form-control" placeholder=""  value="<?= $valor2 ?>" readonly>
        </div>

        <!-- Mostrar Resultado -->
        <div class="mb-3">
            <label class="form-label"><h5>Resultado</h5></label>
            <input type="number" class="form-control" placeholder=""  value="<?= $resultado ?>" readonly>
        </div>

        <!-- Botones de acción -->
        <div class="btn-group" role="group" >
            <a class="btn btn-primary" href="index.php" role="button">Volver</a>
        </div>

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