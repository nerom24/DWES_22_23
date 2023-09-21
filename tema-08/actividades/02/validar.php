<?php

    # iniciar sesión
    session_start();

    # Saneamiento
    $usuario = filter_var($_POST['usuario'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var($_POST['email'] ??= null, FILTER_SANITIZE_EMAIL);

    $fichero = $_FILES['archivo'];

    $FileUploadErrors = array(
		0 => 'No hay error, fichero subido con éxito.',
		1 => 'El fichero subido excede la directiva upload_max_filesize de php.ini.',
		2 => 'El fichero subido excede la directiva MAX_FILE_SIZE especificada en el formulario HTML.',
		3 => 'El fichero fue sólo parcialmente subido.',
		4 => 'No se subió ningún fichero.',
		6 => 'Falta la carpeta temporal.',
		7 => 'No se pudo escribir el fichero en el disco.',
		8 => 'Una extensión de PHP detuvo la subida de ficheros.',
	);

    # Validación
    $errores = [];

    if (($fichero['error']) !== UPLOAD_ERR_OK) {
        
        # Comprobar el error
        if (is_null($fichero)) {

            $errores['archivo'] = $FileUploadErrors[1];

        } else {

            $errores['archivo'] = $FileUploadErrors[$fichero['error']];
        }


    } elseif (is_uploaded_file($fichero['tmp_name'])) {

        # Validar máximo tamaño
        $max_tamano = 2*1024*1024;

        if ($fichero['size'] > $max_tamano) {

            $errores['archivo'] = "Tamaño de archivo no permitido. Máximo 2MB";

        }

        # Validamos el tipo de archivo
        # Validamos el tipo
		$info = new SplFileInfo($fichero['name']);
		$tipos_permitidos =['JPEG','JPG', 'GIF', 'PNG'];
		
		if (!in_array (strtoupper($info->getExtension()) , $tipos_permitidos )) {
			$errores['archivo'] = "Tipo archivo no permitido. Sólo JPG, PNG y GIF";
        }


    } 


    if (!empty($errores)) {

        $_SESSION['error'] = "Formulario No Validado";
        $_SESSION['errores'] = $errores;
        $_SESSION['usuario'] = $usuario;
        $_SESSION['email'] = $email;
        $_SESSION['archivo'] = $archivo;

        # Regresamos al formulario
        header("location: index.php");


    } else {

        # Mover el fichero de la carpeta temporal a la carpeta de nuestro servidor
        move_uploaded_file($fichero['tmp_name'], 'ficheros/'.$fichero['name']);

        $_SESSION['mensaje'] = 'Archivo subido con éxito';

        header('location: index.php');

    }


?>