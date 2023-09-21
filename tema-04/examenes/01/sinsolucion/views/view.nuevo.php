<!DOCTYPE html>
<html lang="es">
<head>
    <?php include("partials/partial.head.php");?>
    <title>Nuevo - Gestión Jugadores </title> 
</head>
<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- header -->
        <?php include("partials/partial.header.php"); ?>

        <!-- Formulario -->
        <legend>Formulario Nuevo Jugador</legend>

        <form>
        
            <!-- botones de accion del formulario -->
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