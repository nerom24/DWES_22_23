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
          
        </header>

        <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" aria-describedby="nombre" name="nombre" value="<?= $this->usuario->name; ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" aria-describedby="email" name="email" placeholder="ejemplo@email.com" value="<?= $this->usuario->email; ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="cliente" class="form-label">Rol</label>
                <select class="form-select" aria-label="Default select example" name="id" disabled>
                    <option selected disabled>Selecciona el rol</option>
                    <?php foreach ($this->roles as $rol): ?>
                        <option value="<?= $rol->id ?>"
                        <?= ($rol->id == $this->usuario->idrol)? 'selected' : null ?>>
                        <?= $rol->name?></option>
                    <?php endforeach; ?>  
                </select>
            </div>
            <a class="btn btn-warning" href="<?= URL ?>usuarios" role="button">Cancelar</a>
    </div>
    <br> <br> <br>

      
    <footer class="footer mt-auto py-3 fixed-bottom bg-light">
        <?php include("template/partials/footer.php");?>
    </footer>
    


   <!--Boostrap Javascript y popper--> 
   <?php include("template/partials/javascript.php");?>    
</body>
</html>