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

      <form action="update.php?key=<?= $indice ?>" method="POST">
        <!-- id -->
        <div class="mb-3">
            <label for="titulo" class="form-label">Id</label>
            <input type="text" class="form-control" name="id" value="<?= $articulo['id']?>">
            <!-- <div class="form-text">Introduzca identificador del libro</div> -->
        </div>
        <!-- Descripcion -->
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripcion</label>
            <input type="text" class="form-control" name="descripcion" value="<?= $articulo['Descripcion']?>">
        </div>
        <!-- Modelo -->
        <div class="mb-3">
            <label for="modelo" class="form-label">Modelo</label>
            <input type="text" class="form-control" name="modelo" value="<?= $articulo['Modelo']?>">
        </div>
        <!-- Categoria Select -->
        <div class="mb-3">
            <label for="genero" class="form-label">Genero</label>
            <select class="form-select" aria-label="Default select example" name="categoria" value="<?= $articulo['Categoria']?>">
                <!-- Generar dinamicamente el parametro selected en la etiqueta HTML option -->
                <?php foreach ($categorias as $key => $categoria): ?>
                    <option value="<?= $key ?>"
                        <?= ($articulo['Categoria'] == $key)?'selected':null?> 
                    >
                    <?=$categoria ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <!-- Unidades -->
        <div class="mb-3">
            <label for="unidades" class="form-label">Unidades</label>
            <input type="number" class="form-control" name="unidades" step="0.01" value="<?= $articulo['Unidades']?>">
        </div>
         <!-- Precio -->
         <div class="mb-3">
            <label for="precio" class="form-label">Precio (€)</label>
            <input type="number" class="form-control" name="precio" step="0.01" value="<?= $articulo['Precio']?>">
        </div>
        
        
        <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
        <button type="reset" class="btn btn-danger">Reset</button>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        
      </form>

      <br><br><br>

    <!-- Pie del documento -->
    <?php include("partials/partial.footer.php");?>

    <!-- Bootstrap Javascript y popper -->
    <?php include("partials/partial.javascript.php");?>
 
</body>
</html>