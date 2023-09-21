<?php

class Albumes extends Controller
{

    function render($param = [])
    {
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else {

            if (isset($_SESSION["mensaje"])) {
                $this->view->mensaje = $_SESSION["mensaje"];
                unset($_SESSION["mensaje"]);
            }

            $this->view->title = "Tabla Albumes";
            $this->view->albumes = $this->model->get();
            $this->view->render("albumes/main/index");
        }
    }

    function nuevo($param = [])
    {
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else if (!in_array($_SESSION["id_rol"], $GLOBALS["crear"])) {
            $_SESSION['mensaje'] = "Usuario sin privilegios";
            header("location:" . URL . "albumes");
        } else {
            $this->view->album = new Album();
            if (isset($_SESSION["error"])) {

                $this->view->error = $_SESSION["error"];
                unset($_SESSION["error"]);

                $this->view->cliente = unserialize($_SESSION["album"]);
                unset($_SESSION["album"]);

                $this->view->errores = $_SESSION["errores"];
                unset($_SESSION["errores"]);
            }
            $this->view->title = "Formulario Album Nuevo";
            $this->view->render("albumes/nuevo/index");
        }
    }

    function create($param = [])
    {
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else if (!in_array($_SESSION["id_rol"], $GLOBALS["crear"])) {
            $_SESSION['mensaje'] = "Usuario sin privilegios";
            header("location:" . URL . "albumes");
        } else {
            $titulo = filter_var($_POST['titulo'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $descripcion = filter_var($_POST['descripcion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $autor = filter_var($_POST['autor'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $lugar = filter_var($_POST['lugar'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $fecha = filter_var($_POST['fecha'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $categoria = filter_var($_POST['categoria'] ??= '', FILTER_SANITIZE_EMAIL);
            $etiquetas = filter_var($_POST['etiquetas'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $carpeta = filter_var($_POST['carpeta'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

            $album = new Album(
                null,
                $titulo,
                $descripcion,
                $autor,
                $fecha,
                $lugar,
                $categoria,
                $etiquetas,
                null,
                null,
                $carpeta
            );

            $errores = [];

            if (empty($titulo)) {
                $errores["titulo"] = "Campo obligatorio.";
            } else if (strlen($titulo) > 100) {
                $errores["titulo"] = "Nombre superior a 100 caracteres.";
            }

            if (empty($descripcion)) {
                $errores["descripcion"] = "Campo obligatorio.";
            }

            if (empty($autor)) {
                $errores["autor"] = "Campo obligatorio.";
            }
            if (empty($fecha)) {
                $errores["fecha"] = "Campo obligatorio.";
            }
            if (empty($lugar)) {
                $errores["lugar"] = "Campo obligatorio.";
            }

            if (empty($categoria)) {
                $errores["categoria"] = "Campo obligatorio.";
            }

            if (empty($carpeta)) {
                $errores["carpeta"] = "Campo obligatorio.";
            }

            if (!empty($errores)) {

                $_SESSION["album"] = serialize($album);
                $_SESSION["error"] = "Formulario no ha sido validado";
                $_SESSION["errores"] = $errores;

                header('Location:' . URL . 'albumes/nuevo');
            } else {

                $this->view->title = "Tabla Albumes";
                $this->model->create($album);

                $_SESSION["mensaje"] = "Album creado correctamente";
                header("Location:" . URL . "Albumes");
            }
        }
    }

    function borrar_directorio($dirname)
    {
        chdir("imagenes2");
        // si es un directorio lo abro
        if (is_dir($dirname))
            $dir_handle = opendir($dirname);
        //si no es un directorio devuelvo false para avisar de que ha habido un error
        if (!$dir_handle)
            return false;
        //recorro el contenido del directorio fichero a fichero
        while ($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                //si no es un directorio elemino el fichero con unlink()
                if (!is_dir($dirname . "/" . $file))
                    unlink($dirname . "/" . $file);
                else //si es un directorio hago la llamada recursiva con el nombre del directorio
                    $this->borrar_directorio($dirname . '/' . $file);
            }
        }
        closedir($dir_handle);
        // elimino el directorio que ya he vaciado
        rmdir($dirname);
        return true;
    }

    function borrar($param = [])
    {
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION["mensaje"] = "Usuario debe autentificarse";

            header('Location:' . URL . "login");
        } else if (!in_array($_SESSION["id_rol"], $GLOBALS["eliminar"])) {
            $_SESSION['mensaje'] = "Usuario sin privilegios";

            header("location:" . URL . "albumes");
        } else {
            $id = $param[0];
            $union = $this->model->getAlbum($id)->carpeta;
            $this->borrar_directorio($union);
            $this->model->delete($id);

            header("Location:" . URL . "albumes");
        }
    }

    function editar($param = [])
    {
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else if (!in_array($_SESSION["id_rol"], $GLOBALS["editar"])) {
            $_SESSION['mensaje'] = "Usuario sin privilegios";
            header("location:" . URL . "albumes");
        } else {
            $this->view->id = $param[0];
            $this->view->album = $this->model->getAlbum($this->view->id);

            if (isset($_SESSION["error"])) {
                $this->view->error = $_SESSION["error"];
                unset($_SESSION["error"]);

                $this->view->album = unserialize($_SESSION["album"]);
                unset($_SESSION["album"]);

                $this->view->errores = $_SESSION["errores"];
                unset($_SESSION["errores"]);
            }
            $this->view->title = "Formulario Edición Album";
            $this->view->render("albumes/editar/index");
        }
    }

    function update($param = [])
    {
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else if (!in_array($_SESSION["id_rol"], $GLOBALS["editar"])) {
            $_SESSION['mensaje'] = "Usuario sin privilegios";
            header("location:" . URL . "albumes");
        } else {
            $titulo = filter_var($_POST['titulo'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $descripcion = filter_var($_POST['descripcion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $autor = filter_var($_POST['autor'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $lugar = filter_var($_POST['lugar'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $fecha = filter_var($_POST['fecha'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $categoria = filter_var($_POST['categoria'] ??= '', FILTER_SANITIZE_EMAIL);
            $etiquetas = filter_var($_POST['etiquetas'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $carpeta = filter_var($_POST['carpeta'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

            $edit_album = new Album(
                null,
                $titulo,
                $descripcion,
                $autor,
                $fecha,
                $lugar,
                $categoria,
                $etiquetas,
                null,
                null,
                $carpeta
            );

            $id = $param[0];
            $album = $this->model->getAlbum($id);
            $errores = [];

            if (strcmp($album->titulo, $titulo) !== 0) {
                if (empty($titulo)) {
                    $errores["titulo"] = "Campo obligatorio.";
                } else if (strlen($titulo) > 100) {
                    $errores["titulo"] = "Nombre superior a 100 caracteres.";
                }
            }

            if (strcmp($album->autor, $autor) !== 0) {
                if (empty($autor)) {
                    $errores["autor"] = "Campo obligatorio.";
                }
            }
            if (strcmp($album->fecha, $fecha) !== 0) {
                if (empty($fecha)) {
                    $errores["fecha"] = "Campo obligatorio.";
                }
            }
            if (strcmp($album->lugar, $lugar) !== 0) {
                if (empty($lugar)) {
                    $errores["lugar"] = "Campo obligatorio.";
                }
            }
            if (strcmp($album->categoria, $categoria) !== 0) {
                if (empty($categoria)) {
                    $errores["categoria"] = "Campo obligatorio.";
                }
            }
            if (strcmp($album->carpeta, $carpeta) !== 0) {
                if (empty($carpeta)) {
                    $errores["carpeta"] = "Campo obligatorio.";
                }
            }
            if (!empty($errores)) {
                $_SESSION["album"] = serialize($edit_album);
                $_SESSION["error"] = "Formulario no ha sido validado";
                $_SESSION["errores"] = $errores;
                header('Location:' . URL . 'albumes/editar/' . $id);
            } else {
                $this->view->title = "Tabla Albumes";
                $this->model->update($param[0], $edit_album);
                rename("imagenes2/" . $album->carpeta, "imagenes2/" . $edit_album->carpeta);
                $_SESSION["mensaje"] = "Album Editado Correctamente";
                header("Location:" . URL . "albumes");
            }
        }
    }

    function mostrar($param = [])
    {
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else if (!in_array($_SESSION["id_rol"], $GLOBALS["mostrar"])) {
            $_SESSION['mensaje'] = "Usuario sin privilegios";
            header("location:" . URL . "albumes");
        } else {
            $id = $param[0];
            $this->view->title = "Album Mostar";
            $this->view->album = $this->model->getAlbum($id);
            $this->model->añadirVisita($id);
            $archivos = $this->model->mostrarAlbum($this->view->album->carpeta);

            array_pop($archivos);
            array_pop($archivos);

            $this->view->archivos = $archivos;
            chdir("../");
            $this->view->render("albumes/mostrar/index");
        }
    }

    function añadir($param = [])
    {
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else if (!in_array($_SESSION["id_rol"], $GLOBALS["mostrar"])) {
            $_SESSION['mensaje'] = "Usuario sin privilegios";
            header("location:" . URL . "albumes");
        } else {
            if (isset($_SESSION["error"])) {
                $this->view->error = $_SESSION["error"];
                unset($_SESSION["error"]);

                $this->view->errores = $_SESSION["errores"];
                unset($_SESSION["errores"]);
            }

            $this->view->id = $param[0];
            $this->view->title = "Album Agregar";
            $this->view->album = $this->model->getAlbum($this->view->id);
            $this->view->render("albumes/agregar/index");
        }
    }
    function upload($param = [])
    {
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else if (!in_array($_SESSION["id_rol"], $GLOBALS["mostrar"])) {
            $_SESSION['mensaje'] = "Usuario sin privilegios";
            header("location:" . URL . "albumes");
        } else {
            $ficheros = $_FILES["archivo"];
            $phpFileUploadErrors = array(
                0 => 'No hay ningún error, se ha subido con éxito',
                1 => 'El archivo cargado excede la directiva upload_max_filesize en php.ini',
                2 => 'El archivo cargado excede la directiva MAX_FILE_SIZE que se especificó en el formulario HTML',
                3 => 'El archivo subido solo se cargó parcialmente',
                4 => 'ningun archivo fue subido',
                6 => 'Falta una carpeta temporal',
                7 => 'No se pudo escribir el archivo en el disco.',
                8 => 'Una extensión de PHP detuvo la carga del archivo.',
            );

            $errores = [];

            // for ($i=0; $i<count($fichero); $i++ ){
                for ($i = 0; $i<count($ficheros['name']); $i++) {
                    if ($ficheros['error'][$i] === UPLOAD_ERR_OK) {
                        if (!is_uploaded_file($ficheros['tmp_name'][$i])) {
                            $errores['archivo'] = 'Error en la subida del archivo';
                        } else {
                            $max_size = 2 * 1024 * 1024;
                            if ($ficheros['size'][$i] > $max_size) {
                                $errores['archivo'] = 'Tamaño de archivo no permitido. Máximo 2MB';
                            } else {
                                $info = new SplFileInfo($ficheros['name'][$i]);
                                $allowed_types = ['JPEG', 'JPG', 'PNG', 'GIF'];
                                if (!in_array(strtoupper($info->getExtension()), $allowed_types)) {
                                    $errores['archivo'] = 'Archivo no permitido, solo JPG, PNG y GIF';
                                }
                            }
                        }
                    } else {
                        $errores['archivo'] = $phpFileUploadErrors[$ficheros['error'][$i]];
                    }
                }
                
            // }

            if (!empty($errores)) {
                $_SESSION["error"] = "Formulario no ha sido validado";
                $_SESSION["errores"] = $errores;
                header("Location:" . URL . "albumes/agregar/" . $param[0]);
            } else {
                $this->view->id = $param[0];
                $this->view->mensaje = "Imagen añadida";
                $this->view->album = $this->model->getAlbum($this->view->id);

                for ($i = 0; $i<count($ficheros['name']); $i++) {
                    move_uploaded_file($ficheros['tmp_name'][$i], 'imagenes2/' . $this->view->album->carpeta . "/" . $ficheros['name'][$i]);
                }
                    
                $this->model->añadirFoto($this->view->id);
                $_SESSION["mensaje"] = "Archivo subido con exito";
                header("Location:" . URL . "albumes/");
            }
        }
    }
}
