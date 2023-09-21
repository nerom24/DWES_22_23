<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once("template/partials/head.php");?>
    <title>Proyecto Gesbank</title>

</head>
<body>
    <?php require_once("template/partials/menuAut.php");?>
    <div class="container">
        <br><br><br><br>
        <header class="pb-3 mb-4 border-bottom">
            <?php include("views/clientes/partials/cabecera.php");?>
            <?php require_once("template/partials/error.php");?>
        </header>

        <form method="post" action="<?= URL ?>cuentas/update/<?= $this->cuenta->id ?>">
        <div class="mb-3">
                <label for="cuenta" class="form-label">Cuenta</label>
                <input type="text" class="form-control" id="cuenta" aria-describedby="cuenta" value="<?= $this->cuenta->num_cuenta ?>" name="num_cuenta" readonly>
            </div>
            <div class="mb-3">
                <label for="cliente" class="form-label">Titular</label>
                <select class="form-select <?= (isset($this->errores['id']))? 'is-invalid' : null ?>" aria-label="Default select example" name="id">
                    <option selected readonly>Selecciona el titular</option>
                    <?php foreach ($this->clientes as $cliente): ?>
                        <option value="<?= $cliente->id ?>"
                        <?= ($this->cuenta->id_cliente == $cliente->id)? 'selected' : null ?>>
                        <?= $cliente->apellidos?>, <?= $cliente->nombre?></option>
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
                <label for="fecha" class="form-label">Fecha</label>
                <input type="text" class="form-control" id="fecha" aria-describedby="fecha" name="fecha_alta" value="<?= $this->cuenta->fecha_alta ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="mov" class="form-label">Ul mov</label>
                <input type="text" class="form-control" id="mov" aria-describedby="mov" name="fecha_ul_mov" value="<?= $this->cuenta->fecha_ul_mov ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="movimientos" class="form-label">Movtos</label>
                <input type="text" class="form-control" id="movimientos" aria-describedby="num_movtos" name="movimientos" value="<?= $this->cuenta->num_movtos ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="saldo" class="form-label">Saldo</label>
                <input type="text" class="form-control" id="saldo" aria-describedby="saldo" step="0.01" name="saldo" value="<?= $this->cuenta->saldo ?>" readonly>
            </div>
            <a class="btn btn-secondary" href="<?= URL ?>cuentas" role="button">Cancelar</a>
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