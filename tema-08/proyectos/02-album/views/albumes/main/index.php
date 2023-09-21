
<!doctype html>
<html lang="es"> 

<?php require_once("template/partials/head.php") ?>

<body>
	<?php require_once("template/partials/menuAut.php") ?>
    
    <!-- Page Content -->
    <div class="container">
	<br><br><br><br>

		<?php require_once("template/partials/mensaje.php") ?>
		<?php require_once("template/partials/error.php") ?>

		<!-- Estilo card de bootstrap -->
		<div class="card">
			<div class="card-header">
				<legend>Tabla Albumes</legend>
				<?php include "template/albumes/menuAlbumes.php"?>
				
			</div>
			<div class="card-body">
				
                <table class="table table-hover">
					<thead>
						<tr>
							<th>Id</th>
							<th>Titulo</th>
							<th>Lugar</th>
							<th>Fecha</th>
							<th>Categoria</th>
							<th>Etiquetas</th>
							<th>Nº Fotos</th>
							<th>Nº Visitas</th>
							<th>Carpeta</th>
							<th>Acciones</th>
						</tr>

					</thead>
					<tbody>
						<?php foreach($this->albumes as $album): ?>
							<?php require('template/partials/modal.php'); ?>
							<tr>
								<td><?= $album->id?></td>
								<td><?= $album->titulo?></td>
								<td><?= $album->lugar?></td>
								<td><?= $album->fecha?></td>
								<td><?= $album->categoria?></td>
								<td><?= $album->etiquetas?></td>
								<td><?= $album->num_fotos?></td>
								<td><?= $album->num_visitas?></td>
								<td><?= $album->carpeta?></td>
								<td>
								<a href="<?= URL . 'albumes/eliminar/' . $album->id?>" title="Eliminar" onclick="return confirm('Confirmar la eliminacion del album')"
								<?=(!in_array($_SESSION['id_rol'], $GLOBALS['eliminar'])) ? 'class = "btn disabled"' : null ?>
								><i class="bi bi-trash-fill text-danger"></i></a>
								<a href="<?= URL . 'albumes/editar/' . $album->id?>" title="Editar"
								<?=(!in_array($_SESSION['id_rol'], $GLOBALS['editar'])) ? 'class = "btn disabled"' : null ?>
								><i class="bi bi-pencil-square"></i></a>
								<a href="<?= URL . 'albumes/mostrar/' . $album->id?>" title="Mostrar"
								<?=(!in_array($_SESSION['id_rol'], $GLOBALS['consultar'])) ? 'class = "btn disabled"' : null ?>
								><i class="bi bi-eye-fill"></i></a>
								<a href="#" title="Subir " data-bs-toggle="modal" data-bs-target="#subir<?=$album->id?>"
								<?=(!in_array($_SESSION['id_rol'], $GLOBALS['agregar'])) ? 'class = "btn disabled"' : null ?>
								><i class="bi bi-cloud-upload-fill"></i>
								</td>
							</tr>
						<?php endforeach;?>
					</tbody>
				</table>

			</div>
			<div class="card-footer text-muted">
				Nº Registros: <?= $this->albumes->rowCount();?>
			</div>

		</div>


    </div>
	<br><br><br>
    <!-- /.container -->
    
    <?php require_once("template/partials/footer.php") ?>
	<?php require_once("template/partials/javascript.php") ?>
	
</body>

</html>