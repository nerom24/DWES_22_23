<?php

class Users extends Controller
{

    function render($param = [])
    {
        # inicio o continuo sesión
        sec_session_start();

        # Compruebo usuario autentificado
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:". URL. "login"); 
        } else {

        if (isset($_SESSION["mensaje"])) {
            $this->view->mensaje = $_SESSION["mensaje"];
            unset($_SESSION["mensaje"]);
        }
        // Mostrara todos los alumnos
        $this->view->title = "Tabla Usuarios";
        $this->view->roles = $this->model->getRoles();
        $this->view->users = $this->model->get();
        $this->view->render("users/main/index");
    }
    }

    function nuevo($param = []) {
        
        # Iniciamos o continuamos sesión
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:". URL. "login"); 
        } else if((!in_array($_SESSION['id_rol'],$GLOBALS['crear']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" .URL. "users");
        } else {

        $this->view->usuario = new User();

        if (isset($_SESSION["error"])) {

            $this->view->error = $_SESSION["error"];

            unset($_SESSION["error"]);

            $this->view->user = unserialize($_SESSION["user"]);
            unset($_SESSION["user"]);

            $this->view->errores = $_SESSION["errores"];
            unset($_SESSION["errores"]);
        }

        // Metodo formulario nuevo cliente  
        $this->view->title = "Formulario cliente nuevo";
        $this->view->roles = $this->model->getRoles();
        $this->view->render("users/nuevo/index");
    }
    }

    function create($param = [])
    {

        # inicio sesión
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:". URL. "login"); 
        } else if((!in_array($_SESSION['id_rol'],$GLOBALS['crear']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" .URL. "users");
        } else {

        //Saneamos los datos del formulario Filter_sanitize

        $name = filter_var($_POST['name'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);


        $new_user = new User(
            null,
            $name,
            $email,
            $password,
            null
        );


        // Nombre. Obligatorio, tamaño máximo 20
        if (empty($name)) {
            $errores["nombre"] = "Campo obligatorio.";
        } else if (strlen($name) > 20) {
            $errores["nombre"] = "Nombre superior a 20 caracteres.";
        }

        // Email. Obligatorio, formato EMAIL válido, ha de ser único en la tabla de clientes.
        if (empty($email)) {
            $errores["email"] = "Campo obligatorio.";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores["email"] = "Formato incorrecto.";
        } else if (!$this->model->validarEmail($email)) {
            $errores["email"] = "Email duplicado.";
        }

        //Comprobar validacion

        if (!empty($errores)) {
            //si errores no esta vacio el formulario no ha sido validado
            $_SESSION["user"] = serialize($new_user);
            $_SESSION["error"] = "Formulario no ha sido validado";
            $_SESSION["errores"] = $errores;

            //redireccionamos a nuevo alumno
            header('Location:' . URL . 'users/nuevo');
        } else {

            $this->view->title = "Tabla Usuarios";
            $this->model->create($new_user);
            $_SESSION["mensaje"] = "Usuario creado correctamente";
            header("Location:" . URL . "users");
        }
    }
    }


    function delete($param = [])
    {

        # inicio o continuo sesión
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:". URL. "login"); 
        } else if((!in_array($_SESSION['id_rol'],$GLOBALS['eliminar']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" .URL. "users");
        } else  {

        $id = $param[0];
        
        $this->model->delete($id);

        header("Location:" . URL . "users");
    }
    }

    function editar($param = [])
    {
        # Iniciamos o continuamos sesión
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:". URL. "login"); 
        } else if((!in_array($_SESSION['id_rol'],$GLOBALS['editar']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" .URL. "users");
        } else {

            $this->view->id = $param[0];
            $this->view->user = $this->model->getUser($this->view->id);

        # Comprueba si el formulario no ha sido validado
        if (isset($_SESSION['error'])) {

            # Mensaje de error
            $this->view->error = $_SESSION["error"];

                unset($_SESSION["error"]);

                $this->view->cuenta = unserialize($_SESSION["user"]);
                unset($_SESSION["user"]);

                $this->view->errores = $_SESSION["errores"];
                unset($_SESSION["errores"]);

        }

            $this->view->id = $param[0];
            $this->view->title = "Formulario  editar Usuario";
            $this->view->roles = $this->model->getRoles();
            $this->view->render("users/editar/index");
    }
    }

    function update($param = [])
    {
        # inicio sesión
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:". URL. "login"); 
        } else if((!in_array($_SESSION['id_rol'],$GLOBALS['crear']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" .URL. "users");
        } else {

            # Saneamos el formulario
            $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
            $password_confirm = filter_var($_POST['password-confirm'], FILTER_SANITIZE_SPECIAL_CHARS);
            $id_rol = filter_var($_POST['id_rol'], FILTER_SANITIZE_NUMBER_INT);


            # Validaciones

            $errores = [];
            $id = $param[0];

            //Obtengo el objeto de dicho cliente

            $user = $this->model->getUser($id);

            # Validar name
            if (empty($id_rol)) {
                $errores["id_rol"] = "campo obligatorio";
            } else if (!$this->model->validarIDrol($id_rol)) {
                $errores['name'] = "Rol no válido";
            }

            # Validar name
            if (strcmp($user->name, $name) !== 0) {
                if (empty($name)) {
                    $errores["name"] = "campo obligatorio";
                } else if (!$this->model->validarName($name)) {
                    $errores['name'] = "Nombre de usuario no permitido";
                }
            }

            # Validar Email
            if (strcmp($user->name, $name) !== 0) {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errores['email'] = "Email no válido";
                } elseif (!$this->model->validarEmail($email)) {
                    $errores['email'] = "Email existente";
                }
            }
            # Validar password

            if (empty($password) || empty($password_confirm)) {
                $errores['password'] = "Password campo obligatorio";
            } else if (strcmp($password, $password_confirm) !== 0) {
                $errores['password'] = "Password no coincidentes";
            } elseif (!$this->model->validarPass($password)) {
                $errores['password'] = "Password:No permitido";
            }

            if (!empty($errores)) {
                // crear objeto user 
                $user = new User(
                    null,
                    $name,
                    $email,
                    null
                );

                $_SESSION["user"] = serialize($user);
                $_SESSION['errores'] = $errores;
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                $_SESSION['error'] = "Fallo en la validación del formulario";

                header("location:" . URL . "users/nuevo");
            } else {

                # Actualiza nuevo usuario

                $this->model->update($name, $email, $password, $id_rol, $id);

                $_SESSION['mensaje'] = "Usuario actualizado correctamente";
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;

                #Vuelve login
                header("location:" . URL . "users");
            }
        }
    }


    function mostrar($param = []) {

        # inicio o continuo sesión
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:". URL. "login"); 
        } else if((!in_array($_SESSION['id_rol'],$GLOBALS['mostrar']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" .URL. "users");
        } else  {

        $id = $param[0];
        $this->view->title = "Formulario Usuario Mostar";
        $this->view->roles = $this->model->getRoles();
        $this->view->user = $this->model->getUser($id);
        $this->view->render("users/mostrar/index");
    }
    }

    function ordenar($param = []) {

        # inicio o continuo sesión
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:". URL. "login"); 
        } else if((!in_array($_SESSION['id_rol'],$GLOBALS['ordenar']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" .URL. "users");
        } else  {

        $criterio = $param[0];
        $this->view->title = "Tabla Usuarios";
        $this->view->users = $this->model->order($criterio);
        $this->view->render("users/main/index");
    }
    }

    function buscar($param = []) {

        # inicio o continuo sesión
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:". URL. "login"); 
        } else if((!in_array($_SESSION['id_rol'],$GLOBALS['buscar']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" .URL. "users");
        } else {

        $expresion = $_GET["expresion"];
        $this->view->title = "Tabla Usuarios";
        $this->view->users = $this->model->filter($expresion);
        $this->view->render("users/main/index");
    }
    }
}