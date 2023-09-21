<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="bootstrap-5.1.1-dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>Calculadora - Proyecto Tema 2 </title>
  </head>
  <body>
    <div class="container">
        <!-- Cabecera -->
        <div class="p-5 bg-light">
          <div class="container">
            <h1 class="display-3">Proyecto Calculadora Básica</h1>
            <hr class="my-2">
            <p class="lead">Tema 2 - Inserción de código Páginas Web</p>
            
          </div>

        </div>
        <!-- formulario -->
        <legend>Resultado Calculadora</legend>
        <!-- <form method="POST"> -->
          <div class="mb-3">
            <label for="" class="form-label">Valor 1</label>
            <input type="number" id="" class="form-control" placeholder="" aria-describedby="helpId"  value="<?= $num1 ?>" readonly>
            <small id="helpId" class="text-muted">Primer operando</small>
          </div>
          <div class="mb-3">
            <label for="" class="form-label">Valor 2</label>
            <input type="number" id="" class="form-control" placeholder="" aria-describedby="helpId" value="<?= $num2 ?>" readonly>
            <small id="helpId" class="text-muted">Segundo operando</small>
          </div>
          <hr>
          <!-- resultado -->
          <div class="mb-3">
            <label for="" class="form-label"><h5><?= $operacion ?></h5></label>
            <input type="number" id="" class="form-control" placeholder="" aria-describedby="helpId" value="<?= $resultado ?>" readonly>
            <small id="helpId" class="text-muted">Resultado de la operación</small>
          </div>

          <!-- Botones de acción -->
          <div class="btn-group" role="group" aria-label="Basic outlined example">
            <!--  Botones de acción del formulario -->
            <a class="btn btn-secondary" href="index.html" role="button">Volver</a>
          </div>

        <!-- </form> -->

        <footer>
            <hr>
            <p>&copy; Juan Carlos - DWES - 2º DAW - Curso 21/22</p>
        </footer>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="bootstrap-5.1.1-dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
  </body>
</html>