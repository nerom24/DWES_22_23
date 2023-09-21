<!doctype html>
<html lang="es"> 

<?php require_once("template/partials/head.php") ?>

<body>
    <?php require_once("template/partials/menuAut.php") ?>
    
    <!-- Page Content -->
    <div class="container">
		<br><br><br><br>

		<?php require_once("template/partials/mensaje.php") ?>
		

		<!-- Estilo card de bootstrap -->
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col">
						<div class="d-grid gap-2 d-md-flex justify-content-md-end">
							<legend>Vista Mostrar Album: <?= $this->album->titulo ?></legend>
							<a class="btn btn-primary" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Información</a>
							<button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Album</button>			
							<button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">Ambos</button>
						</div>
						<h3>El album contiene: <?php echo (count(glob("images/" . $this->album->carpeta . "/*")));?> fotos</h3>
					</div>
				</div>	
			</div>
			<div class="row">
				<div class="col">
					<div class="collapse multi-collapse" id="multiCollapseExample1">
						<div class="card-body">
							<form>
								<!-- ID oculto -->
								<input type="hidden" name="id" value="<?= $this->album->id ?>">
								<div class="mb-3">
									<label class="form-label">Titulo</label>
									<input type="text" class="form-control" name="titulo" value="<?= $this->album->titulo ?>" readonly>
								</div>
								<div class="mb-3">
									<label class="form-label">Descripcion</label>
									<input type="text" class="form-control" name="descripcion" value="<?= $this->album->descripcion ?>" readonly>
								</div>
								<div class="mb-3">
									<label class="form-label">Autor</label>
									<input type="text" class="form-control" name="autor" value="<?= $this->album->autor ?>" readonly>
								</div>
								<div class="mb-3">
									<label class="form-label">Lugar</label>
									<input type="text" class="form-control" name="lugar" value="<?= $this->album->lugar ?>" readonly>
								</div>
								<div class="mb-3">
									<label class="form-label">Fecha</label>
									<input type="date" class="form-control" name="fecha" value="<?= $this->album->fecha ?>" readonly>
								</div>
								<div class="mb-3">
									<label class="form-label">Categoria</label>
									<input type="text" class="form-control" name="categoria" value="<?= $this->album->categoria ?>" readonly>
								</div>
								<div class="mb-3">
									<label class="form-label">Etiquetas</label>
									<input type="text" class="form-control" name="etiquetas" value="<?= $this->album->etiquetas?>" readonly>
								</div>
								<div class="mb-3">
									<label class="form-label">Carpeta</label>
									<input type="text" class="form-control" name="carpeta" pattern="[A-Za-z0-9]{1,50}" value="<?= $this->album->carpeta?>" readonly>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="collapse multi-collapse" id="multiCollapseExample2">
					<div class="album py-5 bg-light">
						<div class="container">
							<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
								<!-- foreach par -->
								<?php $contador = 0;?>
								<?php foreach(glob("images/" . $this->album->carpeta . "/*") as $imagen): 
									?>
									<div class="col-3">
										<div class="card shadow-sm">
											<img width="100%" height="225" src="<?=URL. $imagen?>">
											<div class="card-body">
												<p class="card-text" style="text-align: center;">Fecha: <?= $this->album->fecha ?></p>
												<p class="card-text" style="text-align: center;">Lugar: <?= $this->album->lugar ?></p>
												<div class="d-flex justify-content-between align-items-center">
													<div class="btn-group">
													<a href="<?=URL. $imagen?>" target="_blank" class="btn btn-sm btn-outline-secondary" >Ver</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach;?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer text-muted">
				<a class="btn btn-secondary" href="<?= URL ?>albumes" role="button">Volver</a>
			</div>
		</div>
    </div>
	<br><br><br>
    <!-- /.container -->
    
    <?php require_once("template/partials/footer.php") ?>
	<?php require_once("template/partials/javascript.php") ?>
	
</body>

</html>