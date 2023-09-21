<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once("template/partials/head.php");?>
    <title>Proyecto Artículos</title>

</head>
<body>
    <?php require_once("template/partials/menuAut.php");?>
    <div class="container">
        <br><br><br><br>
        <header class="pb-3 mb-4 border-bottom">
            <?php include("views/clientes/partials/cabecera.php");?>
            <?php require_once("template/partials/error.php");?>
        </header>

        <form method="post" action="<?= URL ?>clientes/update/<?= $this->cliente->id ?>">
        <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control <?= (isset($this->errores['nombre']))? 'is-invalid' : null ?>" id="nombre" aria-describedby="nombre" name="nombre" value="<?= $this->cliente->nombre ?>">
                <!-- Mostrar posible error -->
                <?php if(isset($this->errores['nombre'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['nombre'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control <?= (isset($this->errores['apellidos']))? 'is-invalid' : null ?>" id="apellidos" aria-describedby="apellidos" name="apellidos" value="<?= $this->cliente->apellidos ?>">
                <!-- Mostrar posible error -->
                <?php if(isset($this->errores['apellidos'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['apellidos'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" class="form-control <?= (isset($this->errores['telefono']))? 'is-invalid' : null ?>" id="telefono" aria-describedby="telefono" name="telefono" value="<?= $this->cliente->telefono ?>">
                <!-- Mostrar posible error -->
                <?php if(isset($this->errores['telefono'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['telefono'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad</label>
                <input type="text" class="form-control <?= (isset($this->errores['ciudad']))? 'is-invalid' : null ?>" id="ciudad" aria-describedby="ciudad" name="ciudad" value="<?= $this->cliente->ciudad ?>">
                <!-- Mostrar posible error -->
                <?php if(isset($this->errores['ciudad'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['ciudad'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <input type="text" pattern="[0-9]{8}[A-Z]{1}" size="9" maxlength="9" class="form-control <?= (isset($this->errores['dni']))? 'is-invalid' : null ?>" id="dni" aria-describedby="dni" name="dni" value="<?= $this->cliente->dni ?>">
                <!-- Mostrar posible error -->
                <?php if(isset($this->errores['dni'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['dni'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control <?= (isset($this->errores['email']))? 'is-invalid' : null ?>" id="email" aria-describedby="email" name="email" placeholder="ejemplo@email.com" value="<?= $this->cliente->email ?>">
                <!-- Mostrar posible error -->
                <?php if(isset($this->errores['email'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['email'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <a class="btn btn-warning" href="<?= URL ?>clientes" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Reset</button>
            <button type="submit" class="btn btn-primary">Actualizar</button>
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