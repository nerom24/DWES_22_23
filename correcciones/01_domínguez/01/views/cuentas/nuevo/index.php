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
            <?php require_once("template/partials/error.php");?>
        </header>

        <form method="post" action="<?= URL ?>cuentas/create">
            
            <div class="mb-3">
                <label for="cuenta" class="form-label">Nº Cuenta</label>
                <input type="text" class="form-control <?= (isset($this->errores['cuenta']))? 'is-invalid' : null ?>" id="cuenta" aria-describedby="cuenta" name="cuenta" value="<?= $this->cuenta->num_cuenta ?>">
                <!-- Mostrar posible error -->
                <?php if(isset($this->errores['cuenta'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['cuenta'] ?>
                    </span>
                <?php endif; ?>
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
                <label for="saldo" class="form-label">Saldo</label>
                <input type="number" class="form-control" id="saldo" aria-describedby="saldo" value="0.00" step="0.01" name="saldo">
            </div>
                
            <a class="btn btn-secondary" href="<?= URL ?>cuentas" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary" >Enviar</button>
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