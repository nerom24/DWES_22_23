<!doctype html>
<html lang="es"> 

<?php require_once("template/partials/head.php") ?>

<body>
    <?php require_once("template/partials/menuprin.php") ?>
    
    <!-- Page Content -->
    <div class="container">
	<br><br>

    <div class="row justify-content-center">
            
            <div class="col-md-8">
            <?php require_once("template/partials/mensaje.php") ?>
            <?php require_once("template/partials/error.php") ?>
                <div class="card">
                    <div class="card-header">LOGIN</div>
                    <div class="card-body">
                        <form method="POST">
                            
                            <!-- campo email -->
                            <br>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-end">Email</label>
                                <div class="col-sm-7">
                                    <input type="email" class="form-control" name="email" value="<?= $this->email; ?>" required autocomplete="email" autofocus>
                                
                                    <span class="form-text text-danger" role="alert">
                                        <?= $this->erroresVal['email'] ??= null ?>
                                    </span>
                                </div>
                                
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-end">Password</label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control" name="password" value="<?= $this->password ?>" required autocomplete="current-password" >
                                    <span class="form-text text-danger" role="alert">
                                        <?= $this->erroresVal['password'] ??= null ?>
                                    </span>
                                </div>
                                
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-9 offset-sm-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="gridCheck1" name="remember">
                                        <label class="form-check-label" for="gridCheck1">
                                        Recordar
                                        </label>
                                    </div>
                                </div>
                            </div>
                           
                            <!-- botones -->
                            
                            <div class="row mb-3">
                                <div class="col-sm-9 offset-sm-3">
                                    <button type="submit" class="btn btn-primary" formaction="<?=URL?>login/validate">Entrar</button>
                                    <a class="btn btn-secondary" href="<?=URL?>register" role="button">Registrar</a>
                                    <a class="btn btn-link" href="#">Olvidó su contraseña?</a>
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