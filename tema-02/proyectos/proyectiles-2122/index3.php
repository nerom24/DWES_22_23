
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	
	<title>Practica 06 - Movimiento de Proyectiles</title>

</head>
<body>
	<div class="container">
		<header>
				<hgroup>
					<!-- Títulos y subtítuos -->
					<h1>Tema 02 - DWES</h1>
					<h3>Practica 06 - Movimiento de Proyectiles</h3>
				</hgroup>
		</header>
		<nav>
		<!-- Especificar main-menu() -->
		</nav>
		<section>
			<article>
			<!-- Especificar Formulario  bs3-form -->
			<form method="POST" role="form" id="formulario">
				
			

				<div class="form-group">
					<label for="inputNum1">Velocidad Inicial</label>
					<input type="number" name="velInicial" id="inputvel" class="form-control" placeholder="0" step="0.1" required="required" title="Primer Operando" autofocus>
				</div>
				<div class="form-group">
					<label for="inputNum2">Ángulo de elevación</label>
					<input type="number" name="angulo" id="inputang" class="form-control" placeholder="0" step="0.1" required="required" title="Segundo Operando">
				</div>
				
				<button type="reset" class="btn btn-secondary">Borrar</button>	

				<button type="submit" class="btn btn-primary" id="formulario" formaction="calcular.php">Calcular</button>
			</form>

			</article>
		</section>
		<footer>
			<hr>
			<p>&copy; DEWS - Juan Carlos Moreno - 2º DAW - Curso 17/18</p>
		</footer>
	</div>
	</div>
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="jquery/jquery-3.2.1.min.js"></script>
    <script src="popper/popper.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>