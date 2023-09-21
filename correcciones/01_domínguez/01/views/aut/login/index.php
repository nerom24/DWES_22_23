<!doctype html>
<html lang="es"> 

<?php require_once("template/partials/head.php") ?>

<body>
    <?php require_once("template/partials/menuBar.php") ?>
    
    <!-- Page Content -->
    <div class="container">
	<br><br><br><br>

        <div class="row justify-content-center">
            
            <div class="col-md-8">
            <?php require_once("template/partials/mensaje.php") ?>
            <?php require_once("template/partials/error.php") ?>
                <div class="card">
                    <div class="card-header">LOGIN</div>
                    <div class="card-body">
                        <form method="POST" action="<?=URL?>login/validate" >
                            
                            <!-- campo email -->
                            <div class="mb-3 row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control <?= (isset($this->errores['email']))? 'is-invalid': null ?>" name="email" value="<?= $this->email; ?>" required autocomplete="email" autofocus>

                                   <?php if (isset($this->errores['email'])): ?>  
                                        <span class="form-text text-danger" role="alert">
                                            <?= $this->errores['email'] ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control <?= (isset($this->errores['password']))? 'is-invalid': null ?>" name="password" value="<?= $this->password ?>" required autocomplete="current-password">

                                    <?php if (isset($this->errores['password'])): ?>
                                        <span class="form-text text-danger" role="alert">
                                            <?= $this->errores['password'] ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                        <label class="form-check-label" for="remember">
                                            Recordar
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <a class="btn btn-secondary" href="<?=URL?>register" role="button">Registrar</a>
                                    <button type="submit" class="btn btn-primary">Login</button>

                                    <a class="btn btn-link" href="#">
                                            ¿Olvidó su contraseña?
                                    </a>
                            
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