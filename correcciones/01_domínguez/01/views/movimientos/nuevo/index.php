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
            <?php include("views/movimientos/partials/cabecera.php");?>
            <?php require_once("template/partials/error.php");?>
        </header>

        <form method="post" action="<?= URL ?>movimientos/create/<?= $this->cuenta->id ?>/<?= $this->cuenta->num_movtos ?>">
            
            <!-- Num Cuenta del movimiento -->
            <div class="mb-3">
                <label class="form-label">Cuenta:</label>
                <input type="number" class="form-control" name="cuenta" value = "<?= $this->cuenta->cuenta ?>" readonly>
            </div>
            <!-- id_cliente del movimiento -->
             <div class="mb-3">
                <label class="form-label">Cliente:</label>
                <input type="number" class="form-control" name="id_cliente" value = "<?= $this->cuenta->id_cliente ?>" readonly>
            </div>
            <!-- saldo del movimiento -->
            <div class="mb-3">
                <label class="form-label">Saldo:</label>
                <input type="number" class="form-control" name="saldo" value = "<?= $this->cuenta->saldo ?>" readonly required>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label  <?= (isset($this->errores['tipo']))? 'is-invalid'  : null?>">Tipo</label>
                <div class="form-control">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="I" name="tipo" 
                        <?= ($this->movimiento->tipo == 'I')? 'checked': null?>
                        >
                        <label class="form-check-label" for="inlineradio1">Ingreso</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="R" name="tipo" 
                        <?= ($this->movimiento->tipo == 'R')? 'checked': null?>
                        >
                        <label class="form-check-label" for="inlineradio2">Reintegro</label>
                    </div>
                </div>
                <?php if(isset($this->errores['tipo'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['tipo'] ?>
                    </span>
                <?php endif; ?>
            </div>
            
            <div class="mb-3">
                <label for="concepto" class="form-label">Concepto</label>
                <input type="text" class="form-control <?= (isset($this->errores['concepto']))? 'is-invalid'  : null?>" id="concepto" aria-describedby="concepto" name="concepto" required>
                <?php if(isset($this->errores['concepto'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['concepto'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control <?= (isset($this->errores['cantidad']))? 'is-invalid'  : null?>" id="cantidad" aria-describedby="cantidad" value="0" step="0.01" name="cantidad" required>
                <?php if(isset($this->errores['cantidad'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['cantidad'] ?>
                    </span>
                <?php endif; ?>
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