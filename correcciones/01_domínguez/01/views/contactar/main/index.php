<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once("template/partials/head.php");?>
    <title>Proyecto Artículos</title>

</head>
<body>
    <?php require_once("template/partials/menubar.php") ?>
    <div class="container">
        <br><br><br><br>
        <header class="pb-3 mb-4 border-bottom">
            <?php include("views/clientes/partials/cabecera.php");?>
            <?php require_once("template/partials/error.php");?>
          
        </header>

        <form action="<?= URL ?>contactar/validar" method="POST" role="form">
            <legend>Formulario Email</legend>

            <?php require_once("template/partials/mensaje.php") ?>
            <?php require_once("template/partials/error.php") ?>
            
            <!-- Formulario -->
            <div class="form-group">
                <label for="">Nombre</label>
                <input type="text" name="nombre" class="form-control"  title="nombre" required="required"  autofocus>
                <small id="nombre" class="form-text text-danger"><?= (isset($errores['nombre']))? $errores['nombre']:null ?></small>
            </div>

            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control" required="required" title="email " autofocus>
            </div>


            <div class="form-group">
                <label for="">Asunto</label>
                <input type="text" name="asunto" class="form-control" required="required" title="Asunto" >
                <small id="emailHelp" class="form-text text-danger"><?= (isset($errores['asunto']))? $errores['asunto']:null ?></small>
            </div>

            <div class="form-group">
                <label for="comment">Mensaje:</label>
                <textarea class="form-control" name="cuerpo" rows="5" id="comment" required="required"></textarea>
                <small id="emailHelp" class="form-text text-danger"><?= (isset($errores['cuerpo']))? $errores['cuerpo']:null ?></small>
            </div>
            <br>

            <a class="btn btn-secondary" href="<?= URL ?>index" role="button">Cancelar</a>
            <button type="reset" class="btn btn-secondary">Borrar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
    <br> <br> <br>

      
    <footer class="footer mt-auto py-3 fixed-bottom bg-light">
        <?php include("template/partials/footer.php");?>
    </footer>
    


   <!--Boostrap Javascript y popper--> 
   <?php include("template/partials/javascript.php");?>    
</body>
</html>