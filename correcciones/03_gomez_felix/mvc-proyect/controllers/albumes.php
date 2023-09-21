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
            // Mostrara todos los clientes
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

                $this->view->album = unserialize($_SESSION["album"]);
                unset($_SESSION["album"]);

                $this->view->errores = $_SESSION["errores"];
                unset($_SESSION["errores"]);
            }
            // Metodo formulario nuevo cliente  
            $this->view->title = "Formulario Album Nuevo";
            $this->view->render("albumes/nuevo/index");
        }
    }

    function create($param = [])
    {


        //inicio sesion 

        sec_session_start();

        if (!isset($_SESSION['id'])) {

            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else if (!in_array($_SESSION["id_rol"], $GLOBALS["crear"])) {

            $_SESSION['mensaje'] = "Usuario sin privilegios";
            header("location:" . URL . "albumes");
        } else {
            //Saneamos los datos del formulario Filter_sanitize

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

            // título obligatorio y menor que 100

            if (empty($titulo)) {
                $errores["titulo"] = "Campo obligatorio.";
            } else if (strlen($titulo) > 100) {
                $errores["titulo"] = "Nombre superior a 100 caracteres.";
            }
            // descripción obligatoria

            if (empty($descripcion)) {
                $errores["descripcion"] = "Campo obligatorio.";
            }

            // autor obligatorio
            if (empty($autor)) {
                $errores["autor"] = "Campo obligatorio.";
            }
            // fecha obligatorio
            if (empty($fecha)) {
                $errores["fecha"] = "Campo obligatorio.";
            }
            // lugar obligatorio
            if (empty($lugar)) {
                $errores["lugar"] = "Campo obligatorio.";
            }

            // categoría obligatorio
            if (empty($categoria)) {
                $errores["categoria"] = "Campo obligatorio.";
            }
            // etiquetas no obligatorio
            // carpeta obligatorio (sin espacios)
            if (empty($carpeta)) {
                $errores["carpeta"] = "Campo obligatorio.";
            }

            //Comprobar validacion

            if (!empty($errores)) {
                //si errres no esta vacio el formulario no ha sido validado
                $_SESSION["album"] = serialize($album);
                $_SESSION["error"] = "Formulario no ha sido validado";
                $_SESSION["errores"] = $errores;

                //redireccionamos a nuevo alumno
                header('Location:' . URL . 'albumes/nuevo');
            } else {

                $this->view->title = "Tabla Albumes";
                $this->model->create($album);

                $_SESSION["mensaje"] = "Album creado correctamente";
                header("Location:" . URL . "Albumes");
            }
        }
    }


    function delete($param = [])
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
            $album = $this->model->getAlbum($id);
            $this->model->delete($id);
            $this->model->deleteCarpeta($album->carpeta);
            header("Location:" . URL . "albumes");
        }
    }

    function editar($param = [])
    {
        //iniciamos sesion
        sec_session_start();

        if (!isset($_SESSION['id'])) {

            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else if (!in_array($_SESSION["id_rol"], $GLOBALS["editar"])) {

            $_SESSION['mensaje'] = "Usuario sin privilegios";
            header("location:" . URL . "albumes");
        } else {
            //asignamos id
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


            $this->view->title = "Formulario  Edición Album";

            $this->view->render("albumes/editar/index");
        }
    }

    function update($param = [])
    {

        //inicio sesion 

        sec_session_start();

        if (!isset($_SESSION['id'])) {

            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else if (!in_array($_SESSION["id_rol"], $GLOBALS["editar"])) {

            $_SESSION['mensaje'] = "Usuario sin privilegios";
            header("location:" . URL . "albumes");
        } else {
            //Saneamos los datos del formulario Filter_sanitize
            $titulo = filter_var($_POST['titulo'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $descripcion = filter_var($_POST['descripcion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $autor = filter_var($_POST['autor'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $lugar = filter_var($_POST['lugar'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $fecha = filter_var($_POST['fecha'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $categoria = filter_var($_POST['categoria'] ??= '', FILTER_SANITIZE_EMAIL);
            $etiquetas = filter_var($_POST['etiquetas'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $carpeta = filter_var($_POST['carpeta'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

            //Creamos el objeto Cliente cn los detalles del formulario
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

            //Detalles del cliente que voy a actualizar
            $id = $param[0];

            $album = $this->model->getAlbum($id);



            //Validacion de Editar Cliente, solo validara en caso de modificacion de un detalle
            $errores = [];


            //Validar nombre

            if (strcmp($album->titulo, $titulo) !== 0) {
                // título obligatorio y menor que 100
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


            //Comprobar validacion

            if (!empty($errores)) {
                //si errres no esta vacio el formulario no ha sido validado
                $_SESSION["album"] = serialize($edit_album);
                $_SESSION["error"] = "Formulario no ha sido validado";
                $_SESSION["errores"] = $errores;

                //redireccionamos a editar cliente
                header('Location:' . URL . 'albumes/editar/' . $id);
            } else {

                $this->view->title = "Tabla Albumes";

                $this->model->update($param[0], $edit_album);

                rename("images/" . $album->carpeta, "images/" . $edit_album->carpeta);

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

    function agregar($param = [])
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

            //validacion

            $errores = [];

            foreach ($ficheros["name"] as $key => $fichero) {

                if (($ficheros['error'][$key]) !== UPLOAD_ERR_OK) {
                    // Buscar el error 
                    if (is_null($fichero)) {
                        $errores["archivo"] = $phpFileUploadErrors[1];
                    } else {
                        $errores["archivo"] = $phpFileUploadErrors[$ficheros["error"][$key]];
                    }
                } else if (is_uploaded_file($ficheros["tmp_name"][$key])) {

                    //Validar tamaño
                    $max_tamaño = 4 * 1024 * 1024;

                    if (
                        $ficheros['size'][$key] > $max_tamaño
                    ) {
                        $errores['archivo'] = "Tamaño de archivo no permitido. Máximo 4MB";
                    }

                    //validamos el tipo de archivo 
                    $info = new SplFileInfo($fichero);
                    $tipos_permitidos = ["JPEG", "JPG", "PNG", "GIF"];

                    if (!in_array(strtoupper($info->getExtension()), $tipos_permitidos)) {
                        $errores["archivo"] = "Archivo no permitido, Solo JPG,PNG y GIF";
                    }
                }
            }


            if (!empty($errores)) {

                $_SESSION["error"] = "Formulario no ha sido validado";
                $_SESSION["errores"] = $errores;

                header("Location:" . URL . "albumes/agregar/" . $param[0]);
            } else {

                $this->view->id = $param[0];
                $this->view->mensaje = "Imagen añadida";
                $this->view->album = $this->model->getAlbum($this->view->id);

                foreach ($ficheros["name"] as $key => $fichero) {

                    //mover el fichero de la carpeta temporal a la carpeta de nuestro servidor
                    move_uploaded_file($ficheros['tmp_name'][$key], "images/" . $this->view->album->carpeta . "/" . $fichero);
                }

                $numFotos = count(glob("images/" . $this->view->album->carpeta . "/*"));

                $this->model->añadirFoto($this->view->id, $numFotos);

                $_SESSION["mensaje"] = "Archivo subido con exito";

                header("Location:" . URL . "albumes/");
            }
        }
    }

    function ordenar($param = [])
    {
        sec_session_start();
        if (!isset($_SESSION['id'])) {

            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else {
            $criterio = $param[0];
            $this->view->title = "Tabla Albumes";
            $this->view->albumes = $this->model->order($criterio);
            $this->view->render("albumes/main/index");
        }
    }

    function buscar($param = [])
    {
        sec_session_start();
        if (!isset($_SESSION['id'])) {

            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else {
            $expresion = $_GET["expresion"];
            $this->view->title = "Tabla Albumes";
            $this->view->albumes = $this->model->filter($expresion);
            $this->view->render("albumes/main/index");
        }
    }
}
