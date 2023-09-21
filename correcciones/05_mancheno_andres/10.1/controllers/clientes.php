<?php

class Clientes extends Controller
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
            
            $this->view->title = "Tabla Clientes";
            $this->view->clientes = $this->model->get();
            $this->view->render("clientes/main/index");
        }
    }

    function nuevo($param = [])
    {
        sec_session_start();


        if (!isset($_SESSION['id'])) {

            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else if(!in_array($_SESSION["id_rol"],$GLOBALS["crear"])) {

            $_SESSION['mensaje'] = "Usuario sin privilegios";
            header("location:". URL. "clientes");

        }else {
            $this->view->cliente = new Cliente();

            if (isset($_SESSION["error"])) {

                $this->view->error = $_SESSION["error"];

                unset($_SESSION["error"]);

                $this->view->cliente = unserialize($_SESSION["cliente"]);
                unset($_SESSION["cliente"]);

                $this->view->errores = $_SESSION["errores"];
                unset($_SESSION["errores"]);
            }
            
            $this->view->title = "Formulario cliente nuevo";
            $this->view->render("clientes/nuevo/index");
        }
    }

    function create($param = [])
    {


        

        sec_session_start();

        if (!isset($_SESSION['id'])) {

            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else if(!in_array($_SESSION["id_rol"],$GLOBALS["crear"])) {

            $_SESSION['mensaje'] = "Usuario sin privilegios";
            header("location:". URL. "clientes");

        }else  {
            

            $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $apellidos = filter_var($_POST['apellidos'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $telefono = filter_var($_POST['telefono'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $ciudad = filter_var($_POST['ciudad'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
            $dni = filter_var($_POST['dni'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);


            $cliente = new Cliente(
                null,
                $apellidos,
                $nombre,
                $telefono,
                $ciudad,
                $dni,
                $email,
                null,
                null
            );


            
            if (empty($nombre)) {
                $errores["nombre"] = "Campo obligatorio.";
            } else if (strlen($nombre) > 20) {
                $errores["nombre"] = "Nombre superior a 20 caracteres.";
            }


            
            if (empty($apellidos)) {
                $errores["apellidos"] = "Campo obligatorio.";
            } else if (strlen($apellidos) > 45) {
                $errores["apellidos"] = "apellidos superior a 45 caracteres.";
            }


            
            $options = [
                'options' => [
                    'regexp' => '/[0-9]{9}$/'
                ]
            ];
            if (!empty($telefono)) {
                if (!filter_var($telefono, FILTER_VALIDATE_REGEXP, $options)) {
                    $errores["telefono"] = "Formato incorrecto.";
                }
            }

            
            if (empty($ciudad)) {
                $errores["ciudad"] = "Campo obligatorio.";
            } else if (strlen($ciudad) > 20) {
                $errores["ciudad"] = "ciudad superior a 20 caracteres.";
            }

            
            

            $options = [
                'options' => [
                    'regexp' => '/[0-9]{7,8}[A-Z]$/'
                ]
            ];
            if (empty($dni)) {
                $errores["dni"] = "Campo obligatorio.";
            } else if (!filter_var($dni, FILTER_VALIDATE_REGEXP, $options)) {
                $errores["dni"] = "Formato incorrecto.";
            } else if (!$this->model->validarDni($dni)) {
                $errores["dni"] = "Numero de dni duplicado.";
            }


            
            if (empty($email)) {
                $errores["email"] = "Campo obligatorio.";
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores["email"] = "Formato incorrecto.";
            } else if (!$this->model->validarEmail($email)) {
                $errores["email"] = "Email duplicado.";
            }

            

            if (!empty($errores)) {
                
                $_SESSION["cliente"] = serialize($cliente);
                $_SESSION["error"] = "Formulario no ha sido validado";
                $_SESSION["errores"] = $errores;

                
                header('Location:' . URL . 'clientes/nuevo');
            } else {

                $this->view->title = "Tabla Cuentas";
                $this->model->create($cliente);
                $_SESSION["mensaje"] = "Cliente creado correctamente";
                header("Location:" . URL . "clientes");
            }
        }
    }


    function delete($param = [])
    {

        sec_session_start();
        if (!isset($_SESSION['id'])) {

            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else if(!in_array($_SESSION["id_rol"],$GLOBALS["eliminar"])) {

            $_SESSION['mensaje'] = "Usuario sin privilegios";
            header("location:". URL. "clientes");

        }else  {
            $id = $param[0];
            $this->model->delete($id);
            header("Location:" . URL . "clientes");
        }
    }

    function editar($param = [])
    {
        
        sec_session_start();

        if (!isset($_SESSION['id'])) {

            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else if(!in_array($_SESSION["id_rol"],$GLOBALS["editar"])) {

            $_SESSION['mensaje'] = "Usuario sin privilegios";
            header("location:". URL. "clientes");

        }else  {
            
            $this->view->id = $param[0];

            $this->view->cliente = $this->model->getCliente($this->view->id);

            if (isset($_SESSION["error"])) {
                $this->view->error = $_SESSION["error"];

                unset($_SESSION["error"]);

                $this->view->cliente = unserialize($_SESSION["cliente"]);
                unset($_SESSION["cliente"]);

                $this->view->errores = $_SESSION["errores"];
                unset($_SESSION["errores"]);
            }

            $this->view->title = "Formulario  Edición Cliente";

            $this->view->render("clientes/editar/index");
        }
    }

    function update($param = [])
    {

        

        sec_session_start();

        if (!isset($_SESSION['id'])) {

            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else if(!in_array($_SESSION["id_rol"],$GLOBALS["editar"])) {

            $_SESSION['mensaje'] = "Usuario sin privilegios";
            header("location:". URL. "clientes");

        } else {
            

            $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $apellidos = filter_var($_POST['apellidos'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $telefono = filter_var($_POST['telefono'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $ciudad = filter_var($_POST['ciudad'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
            $dni = filter_var($_POST['dni'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);


            

            $edit_cliente = new Cliente(
                null,
                $apellidos,
                $nombre,
                $telefono,
                $ciudad,
                $dni,
                $email,
                null,
                null
            );

            

            $id = $param[0];

            

            $cliente = $this->model->getCliente($id);


            
            $errores = [];


            

            if (strcmp($cliente->nombre, $nombre) !== 0) {

                if (empty($nombre)) {
                    $errores["nombre"] = "Campo obligatorio.";
                } else if (strlen($nombre) > 20) {
                    $errores["nombre"] = "Nombre superior a 20 caracteres.";
                }
            }



            if (strcmp($cliente->apellidos, $apellidos) !== 0) {
                if (empty($apellidos)) {
                    $errores["apellidos"] = "Campo obligatorio.";
                } else if (strlen($apellidos) > 45) {
                    $errores["apellidos"] = "apellidos superior a 45 caracteres.";
                }
            }



            if (strcmp($cliente->telefono, $telefono) !== 0) {
                $options = [
                    'options' => [
                        'regexp' => '/[0-9]{9}$/'
                    ]
                ];
                if (!empty($telefono)) {
                    if (!filter_var($telefono, FILTER_VALIDATE_REGEXP, $options)) {
                        $errores["telefono"] = "Formato incorrecto.";
                    }
                }
            }

            if (strcmp($cliente->ciudad, $ciudad) !== 0) {
                if (empty($ciudad)) {
                    $errores["ciudad"] = "Campo obligatorio.";
                } else if (strlen($ciudad) > 20) {
                    $errores["ciudad"] = "ciudad superior a 20 caracteres.";
                }
            }


            if (strcmp($cliente->dni, $dni) !== 0) {

                $options = [
                    'options' => [
                        'regexp' => '/[0-9]{7,8}[A-Z]$/'
                    ]
                ];
                if (empty($dni)) {
                    $errores["dni"] = "Campo obligatorio.";
                } else if (!filter_var($dni, FILTER_VALIDATE_REGEXP, $options)) {
                    $errores["dni"] = "Formato incorrecto.";
                } else if (!$this->model->validarDni($dni)) {
                    $errores["dni"] = "Numero de dni duplicado.";
                }
            }


            if (strcmp($cliente->email, $edit_cliente->email) !== 0) {

                if (empty($email)) {
                    $errores["email"] = "Campo obligatorio.";
                } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errores["email"] = "Formato incorrecto.";
                } else if (!$this->model->validarEmail($email)) {
                    $errores["email"] = "Email duplicado.";
                }
            }


            

            if (!empty($errores)) {
                
                $_SESSION["cliente"] = serialize($edit_cliente);
                $_SESSION["error"] = "Formulario no ha sido validado";
                $_SESSION["errores"] = $errores;

                
                header('Location:' . URL . 'clientes/editar/' . $id);
            } else {

                $this->view->title = "Tabla Clientes";
                $this->model->update($param[0], $edit_cliente);
                $_SESSION["mensaje"] = "Cliente Editado Correctamente";
                header("Location:" . URL . "clientes");
            }
        }
    }



    function mostrar($param = [])
    {
        sec_session_start();
        if (!isset($_SESSION['id'])) {

            $_SESSION["mensaje"] = "Usuario debe autentificarse";
            header('Location:' . URL . "login");
        } else if(!in_array($_SESSION["id_rol"],$GLOBALS["mostrar"])) {

            $_SESSION['mensaje'] = "Usuario sin privilegios";
            header("location:". URL. "clientes");

        }else  {
            $id = $param[0];
            $this->view->title = "Formulario Cliente Mostar";
            $this->view->cliente = $this->model->getCliente($id);
            $this->view->render("clientes/mostrar/index");
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
            $this->view->title = "Tabla Clientes";
            $this->view->clientes = $this->model->order($criterio);
            $this->view->render("clientes/main/index");
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
            $this->view->title = "Tabla Clientes";
            $this->view->clientes = $this->model->filter($expresion);
            $this->view->render("clientes/main/index");
        }
    }

    public function pdf($param = []) {

        sec_session_start();

         # Compruebo usuario autentificado
         if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            
            header("location:". URL. "login");
            
        } else {

            $clientes=$this->model->get();
            $pdf=new pdfCliente('P', 'mm', 'A4');

            // $pdf -> SetFillColor(240);
            $pdf->AliasNbPages();
            $pdf->AddPage();
            // $pdf->SetFont('Arial','', 10);
            // $pdf->SetFillColor(200,220,255);
        
        
            // Muestra el titulo del documento
            $pdf->Titulo();
        
        
            $pdf->CabListadoClientes();
            $pdf->SetFont('Times', 'B', 10);
        
            foreach ($clientes as $cliente){
                $pdf->Cell(10, 7, iconv('UTF-8', 'ISO-8859-1', $cliente->id), 'B', 0, 'R', true);
                $pdf->Cell(40, 7, iconv('UTF-8', 'ISO-8859-1', $cliente->nombre), 'B', 0, 'L', true);
                $pdf->Cell(40, 7, iconv('UTF-8', 'ISO-8859-1', $cliente->apellidos), 'B', 0, 'L', true);
                $pdf->Cell(60, 7, iconv('UTF-8', 'ISO-8859-1', $cliente->email), 'B', 0, 'L', true);
                $pdf->Cell(30, 7, iconv('UTF-8', 'ISO-8859-1', $cliente->ciudad), 'B', 0, 'L', true);
                $pdf->Cell(25, 7, iconv('UTF-8', 'ISO-8859-1', $cliente->dni), 'B', 1, 'L', true);
            };
        

            ob_end_clean();
            // Cabecera de listado
            $pdf->Output("I", "clientes.pdf", true);
        }

    }
}
