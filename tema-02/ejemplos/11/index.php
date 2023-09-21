<?php

   include ('variables.php');
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <!-- Mostrar el valor de una variable en plantilla HTML -->
    <h1> <?php echo $apellidos ?> </h1>
    <h1> <?= $apellidos ?> </h1>
    
</body>
</html>