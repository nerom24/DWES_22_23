        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="bi bi-currency-euro" style="font-size: 2rem; color: black;"></a>
                <ul></ul>
                <a class="navbar-brand" style="color: grey;" href="<?= URL ?>cuentas">Cuentas</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" disabled>
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active <?= in_array($_SESSION['id_rol'],$GLOBALS['crear'])? 'active':'disabled'?>" aria-current="page" href="<?= URL ?>movimientos/nuevo/<?=$this->id?>">Nuevo Movimiento</a>
            </li>
            <li class="nav-item">
                    <a class="nav-link active" href="<?= URL ?>movimientos/Pdf/<?=$this->id?>">PDF</a>
            </li>
                </ul>
                </div>
            </div>
        </nav>