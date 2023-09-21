<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= URL ?>cuentas">Cuentas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= in_array($_SESSION['id_rol'], $GLOBALS['crear'])? 'active':'disabled' ?>" href="cuentas/nuevo">Nuevo</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Ordenar
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= URL ?>cuentas/order/id">Id</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cuentas/order/num_cuenta">Cuenta</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cuentas/order/nombre">Nombre</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cuentas/order/apellidos">apellidos</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cuentas/order/fecha_alta">Fecha de Alta</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cuentas/order/fecha_ul_mov">Ultimo Mov</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cuentas/order/num_movtos">Movimientos</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cuentas/order/saldo">Saldo</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_blank" aria-current="page" href="<?= URL ?>cuentas/pdf">PDF</a>
                </li>
            </ul>
            <form class="d-flex"  method="GET" action="<?= URL ?>cuentas/filter" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="expresion">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
            </form>
        </div>
    </div>
</nav>
