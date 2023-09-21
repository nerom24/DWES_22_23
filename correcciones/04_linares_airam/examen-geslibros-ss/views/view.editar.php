<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once("partials/partial.head.php");?>
    <title>Editar - Gestión de Libros </title> 
</head>
<body>
    <!-- Capa Principal -->
    <div class="container">

        <?php include("partials/partial.header.php"); ?>

        <legend>Formulario Editar Libro</legend>

      <form action="update.php?id=<?=$libro->id?>" method="POST">
        <!-- nombre -->
        <div class="mb-3">
            <label for="nombre" class="form-label">Titulo</label>
            <input type="text" class="form-control" name="titulo" value="<?= $libro->titulo ?>">
            <!-- <div class="form-text">Introduzca identificador del libro</div> -->
        </div>
        <!-- apellidos -->
        <div class="mb-3">
            <label for="apellidos" class="form-label">ISBN</label>
            <input type="text" class="form-control" name="isbn" value="<?= $libro->isbn ?>">
        </div>
        <!-- poblacion -->
        <div class="mb-3">
            <label for="poblacion" class="form-label">Fecha Edicion</label>
            <input type="date" class="form-control" name="fecha_edicion" value="<?= $libro->fecha_edicion ?>">
            <!-- <div class="form-text">Introduzca Autor del libro</div> -->
        </div>
        <!-- email -->
        <div class="mb-3">
            <label for="" class="form-label">Curso</label>
            <select class="form-select form-select-lg" name="autor_id">
                <?php foreach ($autores as $autor): ?>
                    <option value="<?= $autor->id ?>" 
                    <?= ($libro->autor_id == $autor->id)? 'selected': null?>
                    ><?= $autor->autor ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <!-- fecha -->
        <div class="mb-3">
            <label for="" class="form-label">Curso</label>
            <select class="form-select form-select-lg" name="editorial_id">
                <?php foreach ($editoriales as $editorial): ?>
                    <option value="<?= $editorial->id ?>" 
                    <?= ($libro->editorial_id == $editorial->id)? 'selected': null?>
                    ><?= $editorial->editorial ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <!-- dni -->
        <div class="mb-3">
            <label for="dni" class="form-label">Unidades</label>
            <input type="text" class="form-control" name="stock" value="<?= $libro->stock ?>">
        </div>

        <!-- Curso -->
        <div class="mb-3">
            <label for="dni" class="form-label">Coste</label>
            <input type="text" class="form-control" name="precio_coste" value="<?= $libro->precio_venta ?>">
        </div>

        <div class="mb-3">
            <label for="dni" class="form-label">PVP</label>
            <input type="text" class="form-control" name="precio_venta" value="<?= $libro->precio_coste ?>">
        </div>
        
        <!-- Botones de acción -->
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