<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once("partials/partial.head.php");?>
    <title>Artículos - Nuevo </title> 
</head>
<body>
    <!-- Capa Principal -->
    <div class="container">

        <?php include("partials/partial.header.php"); ?>

        <legend>Formulario Nuevo Artículo</legend>

      <form action="create.php" method="POST">
        <!-- id -->
        <div class="mb-3">
            <label for="titulo" class="form-label">Id</label>
            <input type="text" class="form-control" name="id" >
            <!-- <div class="form-text">Introduzca identificador del libro</div> -->
        </div>
        <!-- Descripción -->
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" class="form-control" name="descripcion" >
        </div>
        <!-- Modelo -->
        <div class="mb-3">
            <label for="modelo" class="form-label">Modelo</label>
            <input type="text" class="form-control" name="modelo" >
            <!-- <div class="form-text">Introduzca Autor del libro</div> -->
        </div>

        <!-- Categorias checkbox -->
        <div class="mb-3">
            <label for="categorias" class="form-label">Categorías</label>
            <div class="form-control">
                <?php foreach($categorias as $key =>$categoria): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="<?= $key?>" name="categorias[]">
                        <label class="form-check-label" for="">
                            <?= $categoria ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>


        <!-- Unidades -->
        <div class="mb-3">
            <label for="unidades" class="form-label">Unidades</label>
            <input type="number" class="form-control" name="unidades" step="0.01" >
            <!-- <div class="form-text">Introduzca Precio</div> -->
        </div>
        <!-- Precio -->
        <div class="mb-3">
            <label for="precio" class="form-label">Precio (€)</label>
            <input type="number" class="form-control" name="precio" step="0.01" >
            <!-- <div class="form-text">Introduzca Precio</div> -->
        </div>
        
        
        <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
        <button type="reset" class="btn btn-danger">Borrar</button>
        <button type="submit" class="btn btn-primary">Enviar</button>
        
      </form>

      <br><br><br>

    <!-- Pie del documento -->
    <?php include("partials/partial.footer.php");?>

    <!-- Bootstrap Javascript y popper -->
    <?php include("partials/partial.javascript.php");?>
 
</body>
</html>