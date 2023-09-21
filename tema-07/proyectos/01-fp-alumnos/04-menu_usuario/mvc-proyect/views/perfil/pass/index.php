<!doctype html>
<html lang="es"> 

<?php require_once("template/partials/head.php") ?>

<body>
    <?php require_once("template/partials/menuAut.php") ?>
    
    <!-- Page Content -->
    <div class="container">
	<br>

    <div class="row justify-content-center">
            
            <div class="col-md-8">
            <?php require_once("template/partials/mensaje.php") ?>
            <?php require_once("template/partials/error.php") ?>
                <div class="card">
                    <div class="card-header">Modificar Password</div>
                    <div class="card-body">
                        <form method="POST" action="<?=URL?>perfil/valpass">

                            <!-- campo password -->
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-end">Password Actual</label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control" name="password_actual" required autocomplete="current-password" >
                                    <span class="form-text text-danger" role="alert">
                                        <?= $this->erroresVal['password_actual'] ??= null ?>
                                    </span>
                                </div>
                               
                            </div>
                            
                            <!-- campo password -->
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-end">Nuevo Password</label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control" name="password" required autocomplete="current-password" >
                                    <span class="form-text text-danger" role="alert">
                                        <?= $this->erroresVal['password'] ??= null ?>
                                    </span>
                                </div>
                               
                            </div>
                            
                             <!-- campo password confirm-->
                             <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-end">Confirmación Nuevo Password</label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control" name="password_confirm"  required autocomplete="current-password" >
                                </div>
                            </div>
                            
                            <!-- botones acción -->
                            <div class="row mb-3">
                                <div class="col-sm-9 offset-sm-3">
                                    <a class="btn btn-secondary" href="<?=URL?>alumnos" role="button">Cancelar</a>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                            </div>
                       
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <!-- /.container -->
    
    <?php require_once("template/partials/footer.php") ?>
	<?php require_once("template/partials/javascript.php") ?>
	
</body>

</html>