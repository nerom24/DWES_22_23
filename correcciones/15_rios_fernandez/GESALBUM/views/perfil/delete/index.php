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
                    <div class="card-header">Eliminar Perfil Usuario</div>
                    <div class="card-body">
                        <form method="POST" action="<?=URL?>perfil/delete ?>">
                            
                            <!-- campo name -->
                            <br>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-end">Nombre Usuario</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="name" value="<?= $this->user->name; ?>" readonly>
                                </div>
                               
                            </div>

                            <!-- campo email -->
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-end">Email</label>
                                <div class="col-sm-7">
                                    <input type="email" class="form-control" value="<?= $this->user->email; ?>" readonly>
                                </div>
                                
                            </div>

                            <!-- campo perfil -->
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-end">Perfil</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" value="<?= $_SESSION['name_rol']; ?>" readonly>
                                </div>
                                
                            </div>
                            
                            <!-- botones acción -->
                            <div class="row mb-3">
                                <div class="col-sm-9 offset-sm-3">
                                    <a class="btn btn-secondary" href="<?=URL?>alumnos" role="button">Cancelar</a>
                                    <button type="submit" class="btn btn-danger">Eliminar Perfil</button>
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