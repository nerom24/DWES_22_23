<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once("partials/partial.head.php");?>
    <title>Editar - Gestión de Alumnos </title> 
</head>
<body>
    <!-- Capa Principal -->
    <div class="container">

        <?php include("partials/partial.header.php"); ?>

        <legend>Formulario Editar Alumno</legend>

      <form action="update.php?id=<?=$alumno->id?>" method="POST">
        <!-- nombre -->
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" value="<?= $alumno->nombre ?>">
            <!-- <div class="form-text">Introduzca identificador del libro</div> -->
        </div>
        <!-- apellidos -->
        <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos</label>
            <input type="text" class="form-control" name="apellidos" value="<?= $alumno->apellidos ?>">
        </div>
        <!-- poblacion -->
        <div class="mb-3">
            <label for="poblacion" class="form-label">Población</label>
            <input type="text" class="form-control" name="poblacion" value="<?= $alumno->poblacion ?>">
            <!-- <div class="form-text">Introduzca Autor del libro</div> -->
        </div>
        <!-- email -->
        <div class="mb-3">
          <label for="" class="form-label">Email</label>
          <input type="email" class="form-control" name="email" value="<?= $alumno->email ?>">
        </div>
        <!-- fecha -->
        <div class="mb-3">
            <label for="fechaNac" class="form-label">Fecha Nacimiento</label>
            <input type="date" class="form-control" name="fechaNac" value="<?= $alumno->fechaNac ?>">
        </div>
        <!-- dni -->
        <div class="mb-3">
            <label for="dni" class="form-label">DNI</label>
            <input type="text" class="form-control" name="dni" value="<?= $alumno->dni ?>">
        </div>

        <!-- Curso -->
        <div class="mb-3">
            <label for="" class="form-label">Curso</label>
            <select class="form-select form-select-lg" name="id_curso">
                <?php foreach ($cursos as $curso): ?>
                    <option value="<?= $curso->id ?>" 
                    <?= ($alumno->id_curso == $curso->id)? 'selected': null?>
                    ><?= $curso->curso ?></option>
                <?php endforeach; ?>
            </select>
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