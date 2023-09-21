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
            <?php include("views/cuentas/partials/cabecera.php");?>
          
        </header>

        <div class="mb-3">
                <label for="cuenta" class="form-label">Cuenta</label>
                <input type="text" class="form-control" id="cuenta" aria-describedby="cuenta" name="cuenta" value="<?= $this->cuenta->num_cuenta ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" aria-describedby="apellidos" name="apellidos" value="<?= $this->cuenta->apellidos ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" aria-describedby="nombre" name="nombre" value="<?= $this->cuenta->nombre ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="text" class="form-control" id="fecha" aria-describedby="fecha" name="fecha" value="<?= $this->cuenta->fecha_alta ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="mov" class="form-label">Ul mov</label>
                <input type="text" class="form-control" id="mov" aria-describedby="mov" name="mov" value="<?= $this->cuenta->fecha_ul_mov ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="movimientos" class="form-label">Movtos</label>
                <input type="text" class="form-control" id="movimientos" aria-describedby="movimientos" name="movimientos" value="<?= $this->cuenta->num_movtos ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="saldo" class="form-label">Saldo</label>
                <input type="text" class="form-control" id="saldo" aria-describedby="saldo" name="saldo" value="<?= $this->cuenta->saldo ?>" disabled>
            </div>
            <a class="btn btn-warning" href="<?= URL ?>cuentas" role="button">Cancelar</a>
    </div>
    <br> <br> <br>

      
    <footer class="footer mt-auto py-3 fixed-bottom bg-light">
        <?php include("template/partials/footer.php");?>
    </footer>
    


   <!--Boostrap Javascript y popper--> 
   <?php include("template/partials/javascript.php");?>    
</body>
</html>