<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Películas</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="nuevo.php">Nuevo</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Ordenar
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="ordenar.php?criterio=id">Id</a></li>
            <li><a class="dropdown-item" href="ordenar.php?criterio=titulo">Título</a></li>
            <li><a class="dropdown-item" href="ordenar.php?criterio=director">Director</a></li>
            <li><a class="dropdown-item" href="ordenar.php?criterio=nacionalidad">Nacionalidad</a></li>
            <li><a class="dropdown-item" href="ordenar.php?criterio=año">Año</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" method="GET" action="buscar.php">
        <input class="form-control me-2" type="search" placeholder="Expresión" aria-label="Search" name="expresion">
        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
      </form>
    </div>
  </div>
</nav>