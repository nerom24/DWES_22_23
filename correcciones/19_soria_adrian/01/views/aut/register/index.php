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
                    <div class="card-header">Registro Usuarios</div>
                    <div class="card-body">
                        <form method="POST" action="<?= URL ?>register/validate">
                            
                            <!-- campo name -->
                            <div class="mb-3 row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control <?= (isset($this->errores['name']))? 'is-invalid': null ?>" name="name" value="<?= $this->name; ?>" required autocomplete="name" autofocus>

                                    <?php if (isset($this->errores['name'])): ?>
                                        <span class="form-text text-danger" role="alert">
                                            <?= $this->errores['name'] ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

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
                            
                            <!-- campo password -->
                            <div class="mb-3 row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control <?= (isset($this->errores['password']))? 'is-invalid': null ?>" name="password" value="<?= $this->password ?>" required autocomplete="new-password">

                                    <?php if (isset($this->errores['password'])): ?>
                                        <span class="form-text text-danger" role="alert">
                                            <?= $this->errores['password'] ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- password confirm -->
                            <div class="mb-3 row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmar Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password-confirm" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="mb-3 row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <a class="btn btn-secondary" href="<?=URL?>login" role="button">Cancelar</a>
                                    <button type="reset" class="btn btn-secondary" >Reset</button>
                                    <button type="submit" class="btn btn-primary">Registrar</button>
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