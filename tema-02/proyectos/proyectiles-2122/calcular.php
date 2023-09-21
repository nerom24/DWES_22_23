<?php 
	
	define ("G",9.8);
	$velInicial = $_POST["velInicial"];
	$angulo = deg2rad($_POST["angulo"]);

	// Cálculos movimientos proyectil
	$V0x = $velInicial  * cos($angulo);
	$V0y =  $velInicial  * sin($angulo);
	$t = 2 * ($V0y / G);
	$yMax =  (pow($velInicial,2) * pow(sin($angulo),2)) / (2 * G);
	$xMax = pow($velInicial,2) * sin(2 * $angulo) / G;
	
	// Formateo de resultados
	$velInicial = number_format($velInicial, 2,",",".");
	$angulo = number_format($angulo, 5,",",".");
	$V0x = number_format($V0x, 2,",",".");
	$V0y = number_format($V0y, 2,",",".");
	$t = number_format($t, 2,",",".");
	$yMax = number_format($yMax, 2,",",".");
	$xMax = number_format($xMax, 2,",",".");

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<header>
          <hgroup>
            <div class="jumbotron jumbotron-fluid">
              <div class="container">
                <h1 class="display-3">Examen Práctico - Tema 3 DWES</h1>
                <p class="lead">Lanzamiento de Proyectiles</p>
                <hr class="my-2">
              </div>
            </div>
          </hgroup>
     	</header>
		<nav>
		<!-- Especificar main-menu() -->
		</nav>
		<section>
			<article>
			<!-- Especificar tabla  bs3-table -->
			<h4 class="display-6">Lanzamiento de Proyectiles</h4>
			<table class="table">
				<tbody>
				<tr>
					<th>Valores Iniciales:</th>
					<td></td>
				</tr>
				<tr>
					<td>Velocidad Inicial:</td>
					<td><?php echo $velInicial ?> m/s</td>
				</tr>
				<tr>
					<td>Ángulo Inclinación:</td>
					<td><?php echo $_POST["angulo"] ?> º</td>
				</tr>
				<tr>
					<th>Resultados:</th>
					<td></td>
				</tr>
				<tr>
					<td>Angulo Radianes:</td>
					<td><?php print $angulo ?> Radianes</td>
				</tr>
				<tr>
					<td>Velocidad Inicial X:</td>
					<td><?php echo $V0x; ?> m/s</td>
				</tr>
				<tr>
					<td>Velocidad Inicial Y:</td>
					<td><?php echo $V0y; ?> m/s</td>
				</tr>
				<tr>
					<td>Alcance Máximo del Proyectil:</td>
					<td><?php echo $xMax; ?> m</td>
				</tr>
				<tr>
					<td>Tiempo de Vuelo del proyectil:</td>
					<td><?php echo $t; ?> s</td>
				</tr>
				<tr>
					<td>Altura Máxima del Proyectil:</td>
					<td><?php echo $yMax; ?> m</td>
				</tr>
				</tbody>
			</table>
			<a class="btn btn-primary" href="index.php" role="button">Volver</a>

			</article>
		</section>
		<footer>
			<hr>
			<p>&copy; DEWS - Juan Carlos Moreno - 2º DAW - Curso 17/18</p>
		</footer>
	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="jquery-341/jquery-3.4.1.js" ></script>
	<script src="popper/popper.min.js"></script>
	<script src="bootstrap4/js/bootstrap.min.js"></script>
</body>
</html>



