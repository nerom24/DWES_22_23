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
                <input type="text" class="form-control" id="nombre" aria-describedby="nombre" name="nombre" value="<?= $this->cliente->nombre ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" aria-describedby="apellidos" name="apellidos" value="<?= $this->cliente->apellidos ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" aria-describedby="telefono" name="telefono" value="<?= $this->cliente->telefono ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad</label>
                <input type="text" class="form-control" id="ciudad" aria-describedby="ciudad" name="ciudad" value="<?= $this->cliente->ciudad ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <input type="text" class="form-control" id="dni" aria-describedby="dni" name="dni" value="<?= $this->cliente->dni ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" aria-describedby="email" name="email" placeholder="ejemplo@email.com" value="<?= $this->cliente->email ?>" disabled>
            </div>
            <a class="btn btn-warning" href="<?= URL ?>clientes" role="button">Cancelar</a>
    </div>
    <br> <br> <br>

      
    <footer class="footer mt-auto py-3 fixed-bottom bg-light">
        <?php include("template/partials/footer.php");?>
    </footer>
    


   <!--Boostrap Javascript y popper--> 
   <?php include("template/partials/javascript.php");?>    
</body>
</html>