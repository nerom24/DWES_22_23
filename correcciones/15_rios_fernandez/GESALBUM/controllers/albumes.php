<?php

class Albumes extends Controller
{

    function render($param = [])
    {
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
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
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['crear']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
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

            $this->view->title = "Formulario album nuevo";
            $this->view->render("albumes/nuevo/index");
        }
    }

    function create($param = [])
    {

        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['crear']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" . URL . "albumes");
        } else {

            $titulo = filter_var($_POST['titulo'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $descripcion = filter_var($_POST['descripcion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $autor = filter_var($_POST['autor'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $fecha = filter_var($_POST['fecha'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $lugar = filter_var($_POST['lugar'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $categoria = filter_var($_POST['categoria'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $etiquetas = filter_var($_POST['etiquetas'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $carpeta = filter_var($_POST['carpeta'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);


            $new_album = new Album(
                null,
                $titulo,
                $descripcion,
                $autor,
                $fecha,
                $lugar,
                $categoria,
                $etiquetas,
                null,
                0,
                $carpeta,
                null,
                null
            );

            $folder_path = "imagenes/" . $carpeta;

            if (empty($titulo)) {
                $errores["titulo"] = "Campo obligatorio.";
            } else if (strlen($titulo) > 100) {
                $errores["titulo"] = "Nombre inferior a 100 caracteres.";
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
                $errores["carpeta"] = "Campo obligatorio(sin espacios).";
            }


            if (!empty($errores)) {
                $_SESSION["album"] = serialize($new_album);
                $_SESSION["error"] = "Formulario no ha sido validado";
                $_SESSION["errores"] = $errores;

                header('Location:' . URL . 'albumes/nuevo');
            } else {

                $this->view->title = "Tabla Cuentas";
                $this->model->create($new_album);
                $_SESSION["mensaje"] = "Album creado correctamente";

                if (!is_dir($folder_path)) {
                    mkdir($folder_path, 0777, true);
                    if (is_dir($folder_path)) {
                        $_SESSION["mensaje"] = "Carpeta creada correctamente";
                    } else {
                        $_SESSION["mensaje"] = "No se pudo crear la carpeta";
                    }
                } else {
                    $_SESSION["mensaje"] = "La carpeta ya existe";
                }

                header("Location:" . URL . "albumes");
            }
        }
    }


    function eliminar($param = [])
    {


        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['eliminar']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" . URL . "albumes");
        } else {



            $this->view->id = $param[0];
            $this->view->album = $this->model->getAlbum($this->view->id);

            $id = $param[0];
            $folder_path = 'imagenes/' . $this->view->album->carpeta . '/';

            function rmDir_rf($folder_path)
            {
                foreach (glob($folder_path . "/*") as $archivos_carpeta) {
                    if (is_dir($archivos_carpeta)) {
                        rmDir_rf($archivos_carpeta);
                    } else {
                        unlink($archivos_carpeta);
                    }
                }
                rmdir($folder_path);
            }

            rmDir_rf($folder_path);

            $this->model->delete($id);

            header("Location:" . URL . "albumes");
        }
    }

    function editar($param = [])
    {

        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['editar']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" . URL . "albumes");
        } else {

            $this->view->id = $param[0];

            if (isset($_SESSION['error'])) {

                $this->view->error = $_SESSION['error'];
                unset($_SESSION['error']);

                $this->view->album = unserialize($_SESSION['album']);
                unset($_SESSION['album']);

                $this->view->errores = $_SESSION['errores'];
                unset($_SESSION['errores']);
            }


            $this->view->title = "Formulario editar album";
            $this->view->album = $this->model->getAlbum($this->view->id);
            $this->view->render("albumes/editar/index");
        }
    }

    function update($param = [])
    {
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['crear']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" . URL . "albumes");
        } else {

            $titulo = filter_var($_POST['titulo'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $descripcion = filter_var($_POST['descripcion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $autor = filter_var($_POST['autor'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $fecha = filter_var($_POST['fecha'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $lugar = filter_var($_POST['lugar'] ??= '', FILTER_SANITIZE_EMAIL);
            $categoria = filter_var($_POST['categoria'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $etiquetas = filter_var($_POST['etiquetas'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $carpeta = filter_var($_POST['carpeta'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

            $edit_cliente = new Album(
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
                $carpeta,
                null,
                null
            );


            $id = $param[0];

            $album = $this->model->getAlbum($id);


            $errores = [];

            if (empty($titulo)) {
                $errores["titulo"] = "Campo obligatorio.";
            } else if (strlen($titulo) > 100) {
                $errores["titulo"] = "Nombre inferior a 100 caracteres.";
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


            if (empty($lugar)) {
                $errores["lugar"] = "Campo obligatorio(sin espacios).";
            }

            if (!empty($errores)) {

                $_SESSION['album'] = serialize($edit_cliente);
                $_SESSION['error'] = 'Formulario no ha sido validado';
                $_SESSION['errores'] = $errores;


                header('location:' . URL . 'albumes/editar/' . $id);
            } else {


                $this->model->update($param[0], $edit_cliente);


                $_SESSION['mensaje'] = 'Album actualizado correctamente';

                header("Location:" . URL . "albumes");
            }
        }
    }


    function mostrar($param = [])
    {

        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['mostrar']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" . URL . "albumes");
        } else {
            $id = $param[0];
            $this->view->title = "Formulario Album Mostar";
            $this->view->album = $this->model->getAlbum($id);
            $this->view->render("albumes/mostrar/index");
        }
    }

    function ordenar($param = [])
    {
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['ordenar']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" . URL . "albumes");
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
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['buscar']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" . URL . "albumes");
        } else {

            $expresion = $_GET["expresion"];
            $this->view->title = "Tabla Albumes";
            $this->view->albumes = $this->model->filter($expresion);
            $this->view->render("albumes/main/index");
        }
    }


    function subir($param = [])
    {
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['subir']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" . URL . "albumes");
        } else {

            $this->view->id = $param[0];
            if (isset($_SESSION["error"])) {

                $this->view->error = $_SESSION["error"];

                unset($_SESSION["error"]);

                $this->view->album = unserialize($_SESSION["album"]);
                unset($_SESSION["album"]);

                $this->view->errores = $_SESSION["errores"];
                unset($_SESSION["errores"]);
            }

            $this->view->title = "Subir Archivos";
            $this->view->album = $this->model->getAlbum($this->view->id);
            $this->view->render("albumes/subir/index");
        }
    }

    function upload($param = [])
    {
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['subir']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" . URL . "albumes");
        } else {

            $carpeta = $param[0];
            $fichero = $_FILES['archivo'];
            $this->model->upload($carpeta, $fichero);

            $_SESSION['mensaje'] = 'Album actualizado correctamente';

            header("Location:" . URL . "albumes");
        }
    }
}
