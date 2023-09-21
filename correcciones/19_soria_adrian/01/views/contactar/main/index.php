<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once("template/partials/head.php");?>
    <title>Contactar</title>

</head>
<body>
<?php include("template/partials/menuBar.php");?>
<br>
    <div class="container">
        <header class="pb-3 mb-4 border-bottom">
            <?php include("views/contactar/partials/cabecera.php");?>
            <?php include("template/partials/error.php");?>
        </header>

        <legend><?= $this->title ?></legend>

        <form method="post" action="<?= URL ?>contactar/validar"">

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control <?= (isset($this->errores['nombre']))? 'is-invalid' : null ?>" aria-describedby="nombre" name="nombre" value="<?= $this->nombre; ?>">
                <!-- Mostrar posible error -->
                <?php if(isset($this->errores['nombre'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['nombre'] ?>
                    </span>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo Electronico</label>
                <input type="email" class="form-control <?= (isset($this->errores['correo']))? 'is-invalid' : null ?>" id="email" aria-describedby="correo" name="correo" placeholder="ejemplo@email.com" value="<?= $this->correo; ?>">
                <!-- Mostrar posible error -->
                <?php if(isset($this->errores['correo'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['correo'] ?>
                    </span>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="asunto" class="form-label">Asunto</label>
                <input type="text" class="form-control <?= (isset($this->errores['asunto']))? 'is-invalid' : null ?>" aria-describedby="asunto" name="asunto" value="<?= $this->asunto; ?>">
                <!-- Mostrar posible error -->
                <?php if(isset($this->errores['asunto'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['asunto'] ?>
                    </span>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="nombre" class="form-label">Mensaje</label>
                <div class="form-floating">
                    <textarea class="form-control <?= (isset($this->errores['cuerpo']))? 'is-invalid' : null ?>" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="cuerpo"></textarea>
                    <label for="floatingTextarea2">Escribe un mensaje</label >
                    <!-- Mostrar posible error -->
                    <?php if(isset($this->errores['cuerpo'])): ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores['cuerpo'] ?>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
            
            <a class="btn btn-warning" href="<?= URL ?>index" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Reset</button>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>


        <br><br> <br><br>
        

    </div>

      
    <footer class="footer mt-auto py-3 fixed-bottom bg-light">
        <?php include("template/partials/footer.php");?>
    </footer>
    


   <!--Boostrap Javascript y popper--> 
   <?php include("template/partials/javascript.php");?>    
</body>
</html>