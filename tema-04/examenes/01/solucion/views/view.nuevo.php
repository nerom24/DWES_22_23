<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once("partials/partial.head.php");?>
    <title>Nuevo - Gestión Jugadores </title> 
</head>
<body>
    <!-- Capa Principal -->
    <div class="container">

        <?php include("partials/partial.header.php"); ?>

        <legend>Formulario Nuevo Jugador</legend>

      <form action="create.php" method="POST">
        <!-- id -->
        <div class="mb-3">
            <label for="titulo" class="form-label">Id</label>
            <input type="text" class="form-control" name="id" >
            <!-- <div class="form-text">Introduzca identificador del libro</div> -->
        </div>
        <!-- nombre -->
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" >
        </div>
        <!-- número -->
        <div class="mb-3">
          <label for="" class="form-label">Número</label>
          <input type="number" class="form-control" name="numero">
        </div>
        <!-- nacionalidad -->
        <div class="mb-3">
          <label for="" class="form-label">Nacionalidad</label>
          <input type="text" class="form-control" name="nacionalidad" >
        </div>
        <!-- equipos -->
        <div class="mb-3"> 
                <label for="" class="form-label">Equipo</label>
                <select class="form-select" name="equipo">
                <option selected disabled>Seleccione Equipo</option>
                    <?php foreach ($equipos as $key => $equipo):?>
                        <option value="<?=$key?>"><?=$equipo?></option>
                    <?php endforeach; ?>
                </select>
        </div>

        <!-- Perfiles List Checkbox -->
        <div class="mb-3">
            <label for="" class="form-label">Posiciones</label>
            <div class="form-control">
                <?php foreach($posiciones as $key => $posicion): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="posiciones[]" value="<?= $key ?>">
                        <label class="form-check-label" for="flexCheckDefault">
                            <?=$posicion ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
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