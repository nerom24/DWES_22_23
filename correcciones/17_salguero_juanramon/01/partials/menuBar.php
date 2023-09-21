<!-- Navigation -->

<!-- En los enlaces pondremos el nombre del controlador -->

<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">MVC - Gestión FP</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= URL ?>index">Home</a>
        </li>
      </ul>
      <div class="d-flex">
        <div class="collapse navbar-collapse" id="exCollapsingNavbar">
              <ul class="nav navbar-nav flex-row justify-content-between ml-auto">
                  <li class="nav-item"><a href="<?= URL ?>login" class="nav-link active">Login</a></li>
                  <li class="nav-item"><a href="<?= URL ?>register" class="nav-link active">Register</a></li>
              </ul>
        </div>
      </div>
    </div>
    
  </div>
</nav>

