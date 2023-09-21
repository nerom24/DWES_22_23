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
                    <div class="card-header">Registrar Nuevo Usuario</div>
                    <div class="card-body">
                        <form method="POST">
                            
                            <!-- campo name -->
                            <br>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-end">Nombre Usuario</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="name" value="<?= $this->user->name; ?>" required autofocus>
                                
                                    <span class="form-text text-danger" role="alert">
                                        <?= $this->erroresVal['name'] ??= null ?>
                                    </span>
                                </div>
                               
                            </div>

                            <!-- campo email -->
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-end">Email</label>
                                <div class="col-sm-7">
                                    <input type="email" class="form-control" name="email" value="<?= $this->user->email; ?>" required autocomplete="email" autofocus>

                                    <span class="form-text text-danger" role="alert">
                                        <?= $this->erroresVal['email'] ??= null ?>
                                    </span>

                                </div>
                                
                            </div>

                            <!-- campo password -->
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-end">Password</label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control" name="password" value="<?= $this->user->password ?>" required autocomplete="current-password" >
                                    <span class="form-text text-danger" role="alert">
                                        <?= $this->erroresVal['password'] ??= null ?>
                                    </span>
                                </div>
                               
                            </div>
                            
                             <!-- campo password confirm-->
                             <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-end">Confirmación Password</label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control" name="password_confirm" value="<?= $this->user->password_confirm ?? null ?>" required autocomplete="current-password" >
                                </div>
                            </div>
                            
                            <!-- botones acción -->
                            <div class="row mb-3">
                                <div class="col-sm-9 offset-sm-3">
                                    <button type="submit" class="btn btn-primary" formaction="<?=URL?>register/validate">Enviar</button>
                                    <a class="btn btn-secondary" href="<?=URL?>login" role="button">Cancelar</a>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
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