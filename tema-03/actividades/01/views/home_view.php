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
            <span class="fs-4">Plantilla Bootstrap</span>
        </header>

        <menu>

            <?php if ($perfil == 1): ?>
                <!-- menú adminstrador -->
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Nuevo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Eliminar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Actualizar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Consultar</a>
                    </li>
                </ul>
            <?php elseif($perfil == 2): ?>

                <!-- menú editor -->
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Nuevo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Eliminar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Actualizar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Consultar</a>
                    </li>
                </ul>

            <?php else: ?>

                <!-- menú registrado -->
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-current="page" href="#">Nuevo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Eliminar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Actualizar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Consultar</a>
                    </li>
                </ul>

            <?php endif; ?>
            
        </menu>


        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">Campo</th>
                        <th scope="col">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <td scope="row">Usuario</td>
                        <td><?= $user; ?></td>
                    </tr>
                    <tr class="">
                        <td scope="row">eamil</td>
                        <td><?= $email; ?></td>
                    </tr>
                    <tr class="">
                        <td scope="row">password</td>
                        <td><?= $password; ?></td>
                    </tr>
                    <tr class="">
                        <td scope="row">perfil</td>
                        <td><?= $perfil; ?></td>
                    </tr>
                </tbody>
            </table>
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