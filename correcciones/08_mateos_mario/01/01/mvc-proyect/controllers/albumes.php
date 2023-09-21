<?php

class Albumes extends Controller {

    function render($param = []) {

        # Inicio sesión
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

    function nuevo($param = []) {

        # Inicio sesión
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
            // Metodo formulario nuevo cliente  
            $this->view->title = "Formulario Album Nuevo";
            $this->view->render("albumes/nuevo/index");
        }
    }

    function create($param = []) {

        # Inicio sesión
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:". URL. "login"); 
        } else if((!in_array($_SESSION['id_rol'],$GLOBALS['crear']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" .URL. "albumes");
        } else {

        //Saneamos los datos del formulario Filter_sanitize
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
            null,
            $carpeta,
            null,
            null
        );

        $folder_path = "images/" . $carpeta;

        // título obligatorio y menor que 100
        if (empty($titulo)) {
            $errores["titulo"] = "Campo obligatorio.";
        } else if (strlen($titulo) > 100) {
            $errores["titulo"] = "Nombre inferior a 100 caracteres.";
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
            $errores["carpeta"] = "Campo obligatorio(sin espacios).";
        }

        //Comprobar validacion

        if (!empty($errores)) {
            //si errores no esta vacio el formulario no ha sido validado
            $_SESSION["album"] = serialize($new_album);
            $_SESSION["error"] = "Formulario no ha sido validado";
            $_SESSION["errores"] = $errores;

            //redireccionamos a nuevo alumno
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


    function delete($param = []) {
        # Inicio sesión
        sec_session_start();
        if (!isset($_SESSION['id'])) {

            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else if (!in_array($_SESSION["id_rol"], $GLOBALS["eliminar"])) {

            $_SESSION['mensaje'] = "Usuario sin privilegios";
            header("location:" . URL . "albumes");
        } else {
            $id = $param[0];
            $this->model->delete($id);
            header("Location:" . URL . "albumes");
        }
    }

    function editar($param = []) {
        # Inicio sesión
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

    function subir($param = []) {

        # inicio sesión
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

            $this->view->title = "Subir Imágenes";
            $this->view->album = $this->model->getAlbum($this->view->id);
            $this->view->render("albumes/subir/index");
            $num_fotos = count(glob('images/'.$this->view->album->carpeta.'/*'))+1;
            $this->model->updateFotos($this->view->id, $num_fotos);
        }
    }

    function cargar($param = []) {
        # inicio sesión
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

            # Crear mensaje
            $_SESSION['mensaje'] = 'Album actualizado correctamente';

            # Redirecciono al main de alumnos
            header("Location:" . URL . "albumes");
            
        }
    }

    function update($param = []) {

        # Inicio sesión
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

    function mostrar($param = []) {

        # Inicio sesión
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:". URL. "login"); 
        } else if((!in_array($_SESSION['id_rol'],$GLOBALS['mostrar']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" .URL. "albumes");
        } else  {

        $id = $param[0];
        $this->view->title = "Formulario Album Mostar";
        $this->view->album = $this->model->getAlbum($id);
        $this->view->render("albumes/mostrar/index");
    }
    }

    function ordenar($param = []) {

        # Inicio sesión
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

     function buscar($param = []) {
        
        # Inicio sesión
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
