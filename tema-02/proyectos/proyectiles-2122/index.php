<!doctype html>
<html lang="es">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css">
  </head>
  <body>
  
  <div class="container">
      <header>
          <hgroup>
            <div class="jumbotron jumbotron-fluid">
              <div class="container">
                <h1 class="display-3">Examen Práctico - Tema 3 DWES</h1>
                <p class="lead">Lanzamiento de Proyectiles</p>
                <hr class="my-2">
              </div>
            </div>
          </hgroup>
      </header>
      <nav>
      <!-- Especificar main-menu() -->
      </nav>
      <section>
        <article>
        <h4 class="display-6">Lanzamiento de Proyectiles</h4>
        <form method="POST" action="calcular.php">
            <div class="form-group">
              <label for="velInicial">Velocidad Inicial:</label>
              <input type="number" step="0.01" name="velInicial" class="form-control" placeholder="0" aria-describedby="helpId">
              <small id="helpId" class="text-muted">Velocidad en m/s</small>
            </div>
            <div class="form-group">
              <label for="angulo">Angulo Lanzamiento:</label>
              <input type="number" step="0.01" name="angulo" class="form-control" placeholder="0" aria-describedby="helpId">
              <small id="helpId" class="text-muted">Introduzca el ángulo en grados</small>
            </div>
            <button type="reset" class="btn btn-secondary">Borrar</button>	
				    <button type="submit" class="btn btn-primary">Calcular</button>
        </form>  
        </article>
      </section>
      <footer>
        <hr>
        <p>&copy; Juan Carlos - DWES - 2º DAW - Curso 19/20</p>
      </footer>
  </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="jquery-341/jquery-3.4.1.js" ></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap4/js/bootstrap.min.js"></script>
  </body>
</html>