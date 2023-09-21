<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= URL ?>cuentas">Cuentas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active <?= in_array($_SESSION['id_rol'], $GLOBALS['crear'])? 'active':'disabled' ?>" href="cuentas/nuevo">Nuevo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" target="_blank" href="<?= URL ?>cuentas/pdf">Pdf</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Ordenar
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= URL ?>cuentas/ordenar/id">Id</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cuentas/ordenar/num_cuenta">Nº Cuenta</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cuentas/ordenar/id_cliente">Titular</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cuentas/ordenar/fecha_alta">Fecha</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cuentas/ordenar/fecha_ul_mov">Ult Mov</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cuentas/ordenar/num_movtos">Movimientos</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cuentas/ordenar/saldo">Saldo</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex" role="search" method="GET" action="<?= URL ?>cuentas/filtrar">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="expresion">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
            </form>
        </div>
    </div>
</nav>
