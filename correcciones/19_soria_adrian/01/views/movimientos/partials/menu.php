<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= URL ?>cuentas">Cuentas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active <?= in_array($_SESSION['id_rol'], $GLOBALS['crear'])? 'active':'disabled' ?>" href="../nuevo/<?= $this->id ?>">Nuevo Movimiento</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" target="_blank" href="<?= URL ?>movimientos/pdf/<?= $this->id ?>">Pdf</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
