<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?=URL?>clientes">Clientes</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="<?=URL?>clientes/nuevo">Nuevo</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Ordenar
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="<?=URL?>clientes/ordenar/id">ID</a></li>
                                <li><a class="dropdown-item" href="<?=URL?>clientes/ordenar/nombre">Nombre</a></li>
                                <li><a class="dropdown-item" href="<?=URL?>clientes/ordenar/apellidos">Apellidos</a></li>
                                <li><a class="dropdown-item" href="<?=URL?>clientes/ordenar/email">Email</a></li>
                                <li><a class="dropdown-item" href="<?=URL?>clientes/ordenar/telefono">Telefono</a></li>
                                <li><a class="dropdown-item" href="<?=URL?>clientes/ordenar/dni">dni</a></li>
                                <li><a class="dropdown-item" href="<?=URL?>clientes/ordenar/ciudad">ciudad</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?=URL?>clientes/pdf/">Generar Pdf</a>
                        </li>

                    </ul>
                    <form class="d-flex" method="get" action="<?=URL?>clientes/buscar">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="expresion">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>