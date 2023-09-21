<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once("partials/partial.head.php");?>
    <title>Artículos - Editar </title> 
</head>
<body>
    <!-- Capa Principal -->
    <div class="container">

        <?php include("partials/partial.header.php"); ?>

        <legend>Formulario Editar Usuario</legend>

      <form action="update.php?key=<?=$indice?>" method="POST">
        
        <!-- id -->
        <div class="mb-3">
            <label for="titulo" class="form-label">Id</label>
            <input type="text" class="form-control" name="id" value="<?= $usuario->getId()?>">
            <!-- <div class="form-text">Introduzca identificador del libro</div> -->
        </div>
        <!-- nombre -->
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" value="<?= $usuario->getNombre()?>">
        </div>
        <!-- email -->
        <div class="mb-3">
          <label for="" class="form-label">Email</label>
          <input type="email" class="form-control" name="email" id="" value="<?= $usuario->getEmail()?>"">
        </div>
        <!-- password -->
        <div class="mb-3">
          <label for="" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" value="<?= $usuario->getPassword()?>">
          <small class="text-muted">Cualquier letra, 1 carácter especial y un número</small>
        </div>
        <!-- Nacionalidad -->
        <div class="mb-3">
            <label for="nacionalidad" class="form-label">Nacionalidad</label>
            <input type="text" class="form-control" name="nacionalidad" value="<?= $usuario->getNacionalidad()?>">
        </div>
        <!-- Perfiles List Checkbox -->
        <div class="mb-3">
            <label for="perfiles" class="form-label">Perfiles</label>
            <div class="form-control">
                <?php foreach($perfiles as $key => $perfil): ?>
                    <div class="form-check">
                        <!-- generamos dinámicamente el parámetro checked en el input -->
                        <input class="form-check-input" type="checkbox" name="perfiles[]" value="<?= $key ?>"
                        <?=(in_array($key, $usuario->getPerfiles())?'checked':null) ?> >
                        <label class="form-check-label" for="flexCheckDefault">
                            <?=$perfil ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
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