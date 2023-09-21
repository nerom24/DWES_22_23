<!doctype html>
<html lang="es"> 

<?php require_once("template/partials/head.php") ?>

<body>   
    <div class="container">
	<br><br><br><br>

		<div class="card">
			<div class="card-header">
				ERROR
			</div>
			<div class="card-body">
				
                <p class="lead"><?php echo $this->mensaje ?></p>

			</div>
		</div>
    </div>
    
    <?php require_once("template/partials/footer.php") ?>
	<?php require_once("template/partials/javascript.php") ?>
	
</body>

</html>