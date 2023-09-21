<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="https://educacionadistancia.juntadeandalucia.es/centros/cadiz/pluginfile.php/305977/mod_assign/introattachment/0/<?= URL ?>index">MVC - Gestión FP</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= URL ?>index">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= URL?>cuentas">Cuentas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="<?= URL?>clientes">Clientes</a>
        </li>
      </ul>
      <div class="d-flex">
        <ul class="nav navbar-nav flex-row  ml-auto">
            <li class="nav-item dropdown">
               
                <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-bounding-box"><?= str_pad($_SESSION['name_user'], 20, ' __ ', STR_PAD_LEFT) ?></i>
                    
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?= URL ?>logout">Logout</a>
                    <a class="dropdown-item" href="<?= URL ?>perfil/edit">Modificar Perfil</a>
                    <a class="dropdown-item" href="<?= URL ?>perfil/pass">Cambiar Password</a>
                    <a class="dropdown-item" href="<?= URL ?>perfil/show">Eliminar Perfil</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><?= $_SESSION['name_rol'] ?></a>
                </div>
            </li>

        </ul>
      </div>
    </div>
  </div>
</nav>