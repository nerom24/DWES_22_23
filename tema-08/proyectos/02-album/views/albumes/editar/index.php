<!doctype html>
<html lang="es"> 

<?php require_once("template/partials/head.php") ?>

<body>
    <?php require_once("template/partials/menu.php") ?>
    
    <!-- Page Content -->
    <div class="container">
	<br><br><br><br>

		<?php require_once("template/partials/mensaje.php") ?>
		<?php require_once("template/partials/error.php") ?>

		<!-- Estilo card de bootstrap -->
		<div class="card">
			<div class="card-header">
				<legend>Editar Album</legend>	
			</div>
			<div class="card-body">
				<!-- Formulario editar album -->
				<form method="POST" action="<?= URL ?>albumes/update/<?= $this->album->id ?>">
					<!-- ID oculto -->
                    <input type="hidden" name="id" value="<?= $this->album->id ?>">
					<div class="mb-3">
						<label class="form-label">Titulo</label>
						<input type="text" class="form-control" name="titulo" value="<?= $this->album->titulo ?>">
						
						<span class="form-text text-danger" role="alert">
							<?= $this->erroresVal['titulo'] ??= null?>
						</span>
					</div>
					<div class="mb-3">
						<label class="form-label">Descripcion</label>
						<input type="text" class="form-control" name="descripcion" value="<?= $this->album->descripcion ?>">

						<span class="form-text text-danger" role="alert">
							<?= $this->erroresVal['descripcion'] ??= null?>
						</span>
					</div>
					<div class="mb-3">
						<label class="form-label">Autor</label>
						<input type="text" class="form-control" name="autor" value="<?= $this->album->autor ?>">

						<span class="form-text text-danger" role="alert">
							<?= $this->erroresVal['autor'] ??= null?>
						</span>
					</div>
					<div class="mb-3">
						<label class="form-label">Lugar</label>
						<input type="text" class="form-control" name="lugar" value="<?= $this->album->lugar ?>">

						<span class="form-text text-danger" role="alert">
							<?= $this->erroresVal['lugar'] ??= null?>
						</span>
					</div>
					<div class="mb-3">
						<label class="form-label">Fecha</label>
						<input type="date" class="form-control" name="fecha" value="<?= $this->album->fecha ?>">

						<span class="form-text text-danger" role="alert">
							<?= $this->erroresVal['fecha'] ??= null?>
						</span>
					</div>
					<div class="mb-3">
						<label class="form-label">Categoria</label>
						<input type="text" class="form-control" name="categoria" value="<?= $this->album->categoria ?>">

						<span class="form-text text-danger" role="alert">
							<?= $this->erroresVal['categoria'] ??= null?>
						</span>
					</div>
					<div class="mb-3">
						<label class="form-label">Etiquetas</label>
						<input type="text" class="form-control" name="etiquetas" value="<?= $this->album->etiquetas?>">
					
						<span class="form-text text-danger" role="alert">
							<?= $this->erroresVal['etiquetas'] ??= null?>
						</span>
					</div>
					<div class="mb-3">
						<label class="form-label">Carpeta</label>
						<input type="text" class="form-control" name="carpeta" pattern="[A-Za-z0-9]{1,50}" value="<?= $this->album->carpeta?>">
						<label>¡El nombre de la carpeta no puede contener espacios!</label>
						<br>
						<span class="form-text text-danger" role="alert">
							<?= $this->erroresVal['carpeta'] ??= null?>
						</span>
					</div>
			</div>
			<div class="card-footer text-muted">
				<button type="submit" class="btn btn-primary">Añadir</button>
				<button type="reset" class="btn btn-danger">Borrar</button>
				<a class="btn btn-secondary" href="<?= URL ?>albumes" role="button">Cancelar</a>
			</div>
			</form>
		</div>
    </div>
	<br><br><br>
    <!-- /.container -->
    
    <?php require_once("template/partials/footer.php") ?>
	<?php require_once("template/partials/javascript.php") ?>
	
</body>

</html>