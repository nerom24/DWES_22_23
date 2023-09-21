<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once("partials/partial.head.php");?>
    <title>Articulo - Editar </title> 
</head>
<body>
    <!-- Capa Principal -->
    <div class="container">

        <?php include("partials/partial.header.php"); ?>

        <legend>Formulario Editar Articulo</legend>

      <form>
        <!-- id -->
        <div class="mb-3">
            <label for="titulo" class="form-label">Id</label>
            <input type="text" class="form-control" name="id" value="<?= $articulo['id']?>" readonly>
            <!-- <div class="form-text">Introduzca identificador del libro</div> -->
        </div>
        <!-- Descripcion -->
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripcion</label>
            <input type="text" class="form-control" name="descripcion" value="<?= $articulo['Descripcion']?>" readonly>
        </div>
        <!-- Modelo -->
        <div class="mb-3">
            <label for="modelo" class="form-label">Modelo</label>
            <input type="text" class="form-control" name="modelo" value="<?= $articulo['Modelo']?>" readonly>
        </div>
        <!-- Categoria Select -->
        <div class="mb-3">
            <label for="categoria" class="form-label">Genero</label>
            <input type="text" class="form-control" name="categoria" value="<?= $categorias[$articulo['Categoria']]?>" readonly>
        </div>
        <!-- Unidades -->
        <div class="mb-3">
            <label for="unidades" class="form-label">Unidades</label>
            <input type="number" class="form-control" name="unidades" step="0.01" value="<?= $articulo['Unidades']?>" readonly>
        </div>
         <!-- Precio -->
         <div class="mb-3">
            <label for="precio" class="form-label">Precio (€)</label>
            <input type="number" class="form-control" name="precio" step="0.01" value="<?= $articulo['Precio']?>" readonly>
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