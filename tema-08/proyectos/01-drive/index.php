<?php	
	session_start(); 
	require_once('class/explorador.php'); 
	
	$archivo = basename($_SERVER['PHP_SELF']);

	if (isset($_SESSION['actual'])) {
		$explorar = new Explorador("raiz", $_SESSION['actual']);
	}
	else{
		
		$explorar = new Explorador("raiz", "raiz");
		$_SESSION['actual'] = "raiz";
	}

	if (isset($_REQUEST['raiz'])) {
		$_SESSION['actual'] = "raiz";
	}

	//eliminar lote archivos y carpetas
	if (isset($_REQUEST['eliminarLote']) && (!empty($_POST['check']))) {
		$explorar->eliminar($_POST['check']);
		$_SESSION['mensaje'] = "Eliminación realizada con éxito";
	}
	
	//quitar seleccion
	if (isset($_REQUEST['noSelect'])) {			
		$_POST['check']=array();
	}

	//abrir directorio
	if (isset($_REQUEST['abrir']) && (!empty($_POST['check']))) {
		$explorar->abrirDirectorio($_POST['check'][0]);
		$_SESSION['actual'] = getcwd();
	}
	
	//cerrar directorio
	if (isset($_REQUEST['cerrar'])) {
		$explorar->cerrarDirectorio();
		$_SESSION['actual']=getcwd();
	}

	//Sube sólo un archivo seleccionado
	if (isset($_REQUEST['subirArchivo']) && isset ($_FILES['archivo'])) {
			$explorar->subirArchivo($_FILES['archivo']);
			$_SESSION['mensaje'] = "Archivo subido con éxito";
	}
	//Descarga el primer archivo seleccionado
	if (isset($_REQUEST['descargar']) && (!empty($_POST['check']))) {
		$explorar->descargarArchivos($_POST['check']);
		$_SESSION['mensaje'] = "Archivo descargado con éxito";
	}
	if (isset($_REQUEST['comprimir']) && (!empty($_POST['check']))) {
		$explorar->comprimir($_POST['check']);
		$_SESSION['mensaje'] = "Archivo comprimido con éxito";
	}
	
	//Crear directorio
	if (isset($_REQUEST['crear'])) {
		$explorar->crearDirectorio($_POST['directorio']);
		$_SESSION['mensaje'] = "Directorio creado con éxito";
	}
	if (isset($_REQUEST['cambiar']) && (!empty($_POST['check']))) {
		$explorar->cambiarNombre($_POST['check'][0], $_POST['nuevoNombre']);
		$_SESSION['mensaje'] = "Cambio de nombre realizado con éxito";
	}

	if (isset($_SESSION['mensaje'])) {
		$mensaje = $_SESSION['mensaje'];
		unset($_SESSION['mensaje']);
	}
	
	

?>

<!doctype html>
<html lang="es"> 

<?php require_once("template/partials/head.php") ?>

<body>
    <?php require_once("template/partials/menu.php") ?>
    
    <!-- Page Content -->
    <div class="container">
	<br><br><br><br>

		<?php require_once("template/partials/mensaje.php") ?>
		<form method="post" enctype="multipart/form-data">

		<!-- Estilo card de bootstrap -->
		<div class="card">
			<div class="card-header">
				Gestor de Archivos
			</div>
			
			<div class="card-header">
				<ul class="nav nav-pills card-header-pills">
				<li class="nav-item">
					<a class="nav-link" href="#">Carpetas</a>
				</li>
				<li class="nav-item">
				    <button type="submit" class="btn btn-link" name="raiz" title="Raiz"><i class="material-icons">folder_special</i></button>
				</li>
				<li class="nav-item">
				    <button type="submit" class="btn btn-link" name="abrir" title="Abrir Carpeta"><i class="material-icons">folder_open</i></button>	
				</li>
				<li class="nav-item">
				    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#crear" title="Crear Carpeta"><i class="material-icons">create_new_folder</i></button>
				</li>
				<li class="nav-item">
				    <button type="submit" class="btn btn-link" name="cerrar" title="Subir Nivel"><i class="material-icons">present_to_all</i></button>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Archivos y Carpetas</a>
				</li>
				<li class="nav-item">
				    <button type="submit" class="btn btn-link" name="eliminarLote" title="Eliminar"><i class="material-icons">delete_outline</i></button>	
				</li>
				<li class="nav-item">
					<button type="button" class="btn btn-link" data-toggle="modal" data-target="#renombrar" title="Cambiar Nombre"><i class="material-icons">spellcheck</i></button		
				</li>
				
				<li class="nav-item">
				    <button type="submit" class="btn btn-link" name="comprimir" title="Comprimir"><i class="material-icons">storage</i></button>
				</li>
				<li class="nav-item">
					<button type="button" class="btn btn-link" data-toggle="modal" data-target="#subir" title="Subir Archivo"><i class="material-icons">publish</i></button>  
				</li>
				<li class="nav-item">
				    <button type="submit" class="btn btn-link" name="descargar" title="Descargar"><i class="material-icons">get_app</i></button>
				</li>
				
				
				</ul>
  			</div>
 
			<div class="card-body">
				
			<table class="table table-striped table-hover">
				    	<thead>
					        
							<tr> 
								<th colspan=3>
									Directorio Actual: 
								</th>
								<td colspan=5>
									<?= basename($explorar->getDirActual()); ?>
								</td>
					        </tr>
							<tr> 
								<th colspan=3>
									Ruta Absoluta: 
								</th>
								<td colspan=5>
									 <?= $explorar->getDirActual(); ?>
								</td>
					        </tr>
					       
					        <tr>
					        <th>&nbsp;</th>
					        <th>#</th>
					        <th>Tipo</th>
					        <th>Nombre</th>
					        <th>Fecha</th>
					        <th>Tamaño</th>
					        </tr>
				    	</thead>
				    	
						<tbody>
						
							<?php $archivos = $explorar->leerDirectorioActual(); ?>
		                   	<?php $cont=1; foreach($archivos as $a): ?>
		                    <?php $idA = $a; ?>
		                        <tr>
		                        	<td>
		                            <input type="checkbox" value="<?php echo $idA; ?>" name="check[]" 
									    <?php
									      if (isset($_REQUEST['allSelect'])) {
									        echo 'checked="checked"';
									      }
									    ?>
									>
									</td>
									
		                            <td><?= $cont++ ?></td>
		                            <td><i class="material-icons"><?= (filetype($a)=='dir')? 'folder': 'insert_drive_file' ; ?></i></td>
		                            <td><?= $a; ?></td>
		                            <td><?= date("d-m-Y H:i:s.", filectime($a)); ?></td>
		                            <td><?= filesize($a); ?></td>
		                        </tr>
		                    <?php endforeach; ?> 
                    	</tbody>
						
                		</table>
                		<div class="btn-group" role="group" aria-label="Basic example">
	  						<button type="submit" class="btn btn-outline-secondary"
	  				 			name="allSelect">Seleccionar Todos</button>
	  						<button type="submit" class="btn btn-outline-secondary"
	  				 			name="noSelect">Quitar Selección</button>
						</div>
			<?php require_once("template/partials/modal.php") ?>
			</form>

			</div>
		</div>


    </div>

    <!-- /.container -->
    
    <?php require_once("template/partials/footer.php") ?>
	<?php require_once("template/partials/javascript.php") ?>
	
</body>

</html>

