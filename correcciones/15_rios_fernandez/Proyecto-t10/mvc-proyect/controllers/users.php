<?php
class Users extends Controller
{

    function render($param = [])
    {
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else if ($_SESSION["id_rol"] != ADMIN) {

            $_SESSION["mensaje"] = "Usuario debe ser administrador";
            header('Location:' . URL . "cuentas");
        } else {

            if (isset($_SESSION["mensaje"])) {

                $this->view->mensaje = $_SESSION["mensaje"];
                unset($_SESSION["mensaje"]);
            }
            $this->view->title = "Tabla Usuarios";
            $this->view->roles = $this->model->getRoles();

            $this->view->users = $this->model->get();
            $this->view->render("users/main/index");
        }
    }


    function nuevo($param = [])
    {
        sec_session_start();


        if (!isset($_SESSION['id'])) {

            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else if (($_SESSION["id_rol"] != ADMIN)) {

            $_SESSION['mensaje'] = "Usuario sin privilegios";
            header("location:" . URL . "clientes");
        } else {
            $this->view->user = new User();

            if (isset($_SESSION["error"])) {

                $this->view->error = $_SESSION["error"];

                unset($_SESSION["error"]);

                $this->view->user = unserialize($_SESSION["user"]);
                unset($_SESSION["user"]);

                $this->view->errores = $_SESSION["errores"];
                unset($_SESSION["errores"]);
            }
            $this->view->title = "Formulario Usuario nuevo";
            $this->view->roles = $this->model->getRoles();
            $this->view->render("users/nuevo/index");
        }
    }

    function create($param = [])
    {

        sec_session_start();


        if (!isset($_SESSION['id'])) {

            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else if (($_SESSION["id_rol"] != ADMIN)) {

            $_SESSION['mensaje'] = "Usuario sin privilegios";
            header("location:" . URL . "cuentas");
        } else {
            $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
            $password_confirm = filter_var($_POST['password-confirm'], FILTER_SANITIZE_SPECIAL_CHARS);
            $id_rol = filter_var($_POST['id_rol'], FILTER_SANITIZE_NUMBER_INT);


            $errores = [];
            if (empty($id_rol)) {
                $errores["id_rol"] = "campo obligatorio";
            } else if (!$this->model->validarIDrol($id_rol)) {
                $errores['name'] = "Rol no válido";
            }
            if (empty($name)) {
                $errores["name"] = "campo obligatorio";
            } else if (!$this->model->validarName($name)) {
                $errores['name'] = "Nombre de usuario no permitido";
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores['email'] = "Email no válido";
            } elseif (!$this->model->validaEmailUnique($email)) {
                $errores['email'] = "Email existente";
            }
            if (empty($password) || empty($password_confirm)) {
                $errores['password'] = "Password campo obligatorio";
            } else if (strcmp($password, $password_confirm) !== 0) {
                $errores['password'] = "Password no coincidentes";
            } elseif (!$this->model->validarPass($password)) {
                $errores['password'] = "Password:No permitido";
            }


            if (!empty($errores)) {
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

                $this->model->crear($name, $email, $password, $id_rol);

                $_SESSION['mensaje'] = "Usuario registrado correctamente";
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;

                header("location:" . URL . "users");
            }
        }
    }



    function editar($param = [])
    {

        sec_session_start();
        if (!isset($_SESSION['id'])) {

            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else if ($_SESSION["id_rol"] != ADMIN) {

            $_SESSION['mensaje'] = "Usuario sin privilegios";
            header("location:" . URL . "users");
        } else {
            $this->view->id = $param[0];
            $this->view->user = $this->model->getUser($this->view->id);


            if (isset($_SESSION["error"])) {

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
        sec_session_start();
        if (!isset($_SESSION['id'])) {

            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else if ($_SESSION["id_rol"] != ADMIN) {

            $_SESSION['mensaje'] = "Usuario sin privilegios";
            header("location:" . URL . "users");
        } else {
            $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
            $password_confirm = filter_var($_POST['password-confirm'], FILTER_SANITIZE_SPECIAL_CHARS);
            $id_rol = filter_var($_POST['id_rol'], FILTER_SANITIZE_NUMBER_INT);

            $errores = [];
            $id = $param[0];


            $user = $this->model->getUser($id);
            if (empty($id_rol)) {
                $errores["id_rol"] = "campo obligatorio";
            } else if (!$this->model->validarIDrol($id_rol)) {
                $errores['name'] = "Rol no válido";
            }
            if (strcmp($user->name, $name) !== 0) {
                if (empty($name)) {
                    $errores["name"] = "campo obligatorio";
                } else if (!$this->model->validarName($name)) {
                    $errores['name'] = "Nombre de usuario no permitido";
                }
            }
            if (strcmp($user->name, $name) !== 0) {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errores['email'] = "Email no válido";
                } elseif (!$this->model->validaEmailUnique($email)) {
                    $errores['email'] = "Email existente";
                }
            }
            if (empty($password) || empty($password_confirm)) {
                $errores['password'] = "Password campo obligatorio";
            } else if (strcmp($password, $password_confirm) !== 0) {
                $errores['password'] = "Password no coincidentes";
            } elseif (!$this->model->validarPass($password)) {
                $errores['password'] = "Password:No permitido";
            }

            if (!empty($errores)) {
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

                $this->model->update($name, $email, $password, $id_rol, $id);

                $_SESSION['mensaje'] = "Usuario actualizado correctamente";
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header("location:" . URL . "users");
            }
        }
    }

    function delete($param = [])
    {
        sec_session_start();
        if (!isset($_SESSION['id'])) {
            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else if ($_SESSION["id_rol"] != ADMIN) {

            $_SESSION['mensaje'] = "Usuario sin privilegios";
            header("location:" . URL . "cuentas");
        } else {
            $id = $param[0];
            $this->model->delete($id);
            header("Location:" . URL . "users");
        }
    }

    function mostrar($param = [])
    {
        sec_session_start();
        if (!isset($_SESSION['id'])) {

            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else if ($_SESSION["id_rol"] != ADMIN) {

            $_SESSION['mensaje'] = "Usuario sin privilegios";
            header("location:" . URL . "cuentas");
        } else {
            $id = $param[0];
            $this->view->title = "Formulario User Mostar";
            $this->view->roles = $this->model->getRoles();
            $this->view->user = $this->model->getUser($id);
            $this->view->render("users/mostrar/index");
        }
    }

    function ordenar($param = [])
    {
        sec_session_start();
        if (!isset($_SESSION['id'])) {

            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else if ($_SESSION["id_rol"] != ADMIN) {
            $_SESSION['mensaje'] = "Usuario sin privilegios";
            header("location:" . URL . "cuentas");
        } else {
            $criterio = $param[0];
            $this->view->title = "Tabla Usuarios";
            $this->view->roles = $this->model->getRoles();
            $this->view->users = $this->model->order($criterio);
            $this->view->render("users/main/index");
        }
    }

    function buscar($param = [])
    {
        sec_session_start();
        if (!isset($_SESSION['id'])) {

            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else if ($_SESSION["id_rol"] != ADMIN) {
            $_SESSION['mensaje'] = "Usuario sin privilegios";
            header("location:" . URL . "cuentas");
        } else {
            $expresion = $_GET["expresion"];
            $this->view->title = "Tabla Usuarios";
            $this->view->roles = $this->model->getRoles();
            $this->view->users = $this->model->filter($expresion);
            $this->view->render("users/main/index");
        }
    }

    public function Pdf($param = [])
    {

        sec_session_start();
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");
        } else {

            $usuarios = $this->model->get();
            $pdf = new pdfUsuario('P', 'mm', 'A4');
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->Titulo();
            $pdf->Encabezado();
            $pdf->SetFont('courier', 'B', 10);
            $pdf->SetFillColor(98, 101, 103);


            foreach ($usuarios as $usuario) {
                $pdf->Cell(40, 7, iconv('UTF-8', 'ISO-8859-1', $usuario->id), 'B', 0, 'I', true);
                $pdf->Cell(80, 7, iconv('UTF-8', 'ISO-8859-1', $usuario->name), 'B', 0, 'L', true);
                $pdf->Cell(70, 7, iconv('UTF-8', 'ISO-8859-1', $usuario->email), 'B', 1, 'L', true);
            };
            $pdf->Output("I", "doc.pdf", true);
        }
    }
}
