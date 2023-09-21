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
            <?php include("views/usuarios/partials/cabecera.php");?>
            <?php require_once("template/partials/error.php");?>
          
        </header>

        <form method="post" action="<?= URL ?>usuarios/create">
            
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control <?= (isset($this->errores['nombre']))? 'is-invalid' : null ?>" id="nombre" aria-describedby="nombre" name="nombre" value="<?= $this->name; ?>">
                <!-- Mostrar posible error -->
                <?php if(isset($this->errores['nombre'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['nombre'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control <?= (isset($this->errores['email']))? 'is-invalid' : null ?>" id="email" aria-describedby="email" name="email" placeholder="ejemplo@email.com" value="<?= $this->email; ?>">
                <!-- Mostrar posible error -->
                <?php if(isset($this->errores['email'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['email'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="cliente" class="form-label">Rol</label>
                <select class="form-select <?= (isset($this->errores['id']))? 'is-invalid' : null ?>" aria-label="Default select example" name="id">
                    <option selected readonly>Selecciona el rol</option>
                    <?php foreach ($this->roles as $rol): ?>
                        <option value="<?= $rol->id ?>"
                        <?= ($rol->id == $this->rol)? 'selected' : null ?>>
                        <?= $rol->name?></option>
                    <?php endforeach; ?>  
                </select>
                <!-- Mostrar posible error -->
                <?php if(isset($this->errores['cliente'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['cliente'] ?>
                    </span>
                <?php endif; ?>
            </div>


            <div class="mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                <input id="password" type="password" class="form-control <?= (isset($this->errores['password']))? 'is-invalid': null ?>" name="password" value="<?= $this->password; ?>">
                <!-- Mostrar posible error -->
                <?php if (isset($this->errores['password'])): ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores['password'] ?>
                        </span>
                <?php endif; ?>
            </div>
                            
            <!-- password confirm -->
            <div class="mb-3">
                <label for="password_confirm" class="col-md-4 col-form-label text-md-right">Confirmar Password</label>
                <input id="password" type="password" class="form-control <?= (isset($this->errores['password_confirm']))? 'is-invalid': null ?>" name="password_confirm">
            </div>
                
            <a class="btn btn-secondary" href="<?= URL ?>usuarios" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Reset</button>
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