<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once("partials/partial.head.php");?>
    <title>Nuevo - Gestión Usuarios </title> 
</head>
<body>
    <!-- Capa Principal -->
    <div class="container">

        <?php include("partials/partial.header.php"); ?>

        <legend>Formulario Nuevo Usuario</legend>

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
        <!-- email -->
        <div class="mb-3">
          <label for="" class="form-label">Email</label>
          <input type="email" class="form-control" name="email" id="" placeholder="abc@mail.com">
        </div>
        <!-- password -->
        <div class="mb-3">
          <label for="" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" placeholder="">
          <small class="text-muted">Cualquier letra, 1 carácter especial y un número</small>
        </div>
        <!-- Nacionalidad -->
        <div class="mb-3">
            <label for="nacionalidad" class="form-label">Nacionalidad</label>
            <input type="text" class="form-control" name="nacionalidad" >
        </div>
        <!-- Perfiles List Checkbox -->
        <div class="mb-3">
            <label for="perfiles" class="form-label">Perfiles</label>
            <div class="form-control">
                <?php foreach($perfiles as $key => $perfil): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="perfiles[]" value="<?= $key ?>">
                        <label class="form-check-label" for="flexCheckDefault">
                            <?=$perfil ?>
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