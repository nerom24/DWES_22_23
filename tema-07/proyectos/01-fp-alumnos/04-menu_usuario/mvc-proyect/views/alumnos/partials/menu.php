<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= URL ?>alumnos">Alumnos</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link <?= in_array($_SESSION['id_rol'],$GLOBALS['crear'])? 'active':'disabled' ?>" aria-current="page" href="alumnos/nuevo">Nuevo</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Ordenar
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?= URL ?>alumnos/ordenar/nombre">Nombre</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>alumnos/ordenar/apellidos">Apellidos</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>alumnos/ordenar/email">Email</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>alumnos/ordenar/poblacion">Población</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>alumnos/ordenar/fechaNac">Edad</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>alumnos/ordenar/id_curso">Curso</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                    </li>
            
                </ul>
                <form class="d-flex" method="GET" action="<?= URL ?>alumnos/buscar">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="expresion">
                    <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                </form>
                </div>
            </div>
        </nav>