<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once("partials/partial.head.php");?>
    <title>Libros Proyecto </title>

</head>
<body>
    <!-- Capa Principal -->
    <div class="container">

        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-app-indicator"></i>        
            <span class="fs-4">Proyecto Libros fase 4</span>
        </header>

        <legend>Formulario Editar Libro</legend>

      <form>
        <!-- id -->
        <div class="mb-3">
            <label for="titulo" class="form-label">Id</label>
            <input type="text" class="form-control" name="id" value="<?= $libro['Id'] ?>" readonly>
            <!-- <div class="form-text">Introduzca identificador del libro</div> -->
        </div>
        <!-- Título -->
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" name="titulo" value="<?= $libro['Título'] ?>" readonly>
            <!-- <div class="form-text">Introduzca título libro existente</div> -->
        </div>
        <!-- Autor -->
        <div class="mb-3">
            <label for="autor" class="form-label">Autor</label>
            <input type="text" class="form-control" name="autor" value="<?= $libro['Autor'] ?>" readonly>
            <!-- <div class="form-text">Introduzca Autor del libro</div> -->
        </div>
        <!-- Género -->
        <div class="mb-3">
            <label for="genero" class="form-label">Género</label>
            <input type="text" class="form-control" name="genero" value="<?= $libro['Género'] ?>" readonly>
            <!-- <div class="form-text">Género del libro</div> -->
        </div>
        <!-- Género -->
        <div class="mb-3">
            <label for="precio" class="form-label">Precio (€)</label>
            <input type="number" class="form-control" name="precio" step="0.01" value="<?= $libro['Precio'] ?>" readonly>
            <!-- <div class="form-text">Introduzca Precio</div> -->
        </div>
        
        
        <a class="btn btn-secondary" href="index.php" role="button">Volver</a>
        
        
      </form>

      <br><br><br>

    <!-- Pie del documento -->
    <?php include("partials/partial.footer.php");?>

    <!-- Bootstrap Javascript y popper -->
    <?php include("partials/partial.javascript.php");?>
 
</body>
</html>