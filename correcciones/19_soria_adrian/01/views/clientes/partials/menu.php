<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= URL ?>clientes">Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= in_array($_SESSION['id_rol'], $GLOBALS['crear'])? 'active':'disabled' ?>" href="clientes/nuevo">Nuevo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" target="_blank" href="<?= URL ?>clientes/pdf">Pdf</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Ordenar
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= URL ?>clientes/ordenar/id">Id</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>clientes/ordenar/apellidos">Apellidos</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>clientes/ordenar/nombre">Nombre</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>clientes/ordenar/telefono">Telefono</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>clientes/ordenar/ciudad">Ciudad</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>clientes/ordenar/dni">Dni</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>clientes/ordenar/email">Email</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex" role="search" method="GET" action="<?= URL ?>clientes/filtrar">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="expresion">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
            </form>
        </div>
    </div>
</nav>
