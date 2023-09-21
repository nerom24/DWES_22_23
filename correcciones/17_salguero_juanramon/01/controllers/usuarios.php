<?php 

    class Usuarios extends Controller{
        public function render () {

            sec_session_start();

            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                header("location:". URL. "login"); 

            } else {
                if (isset($_SESSION['mensaje'])) {
                    $this->view->mensaje = $_SESSION['mensaje'];
                    unset($_SESSION['mensaje']);
                }

                // Mostrará todos los usuarios
                $this->view->tittle="Tabla Usuarios";
                $this->view->usuarios=$this->model->get();
                $this->view->render("usuarios/main/index");

            }

        }

        public function nuevo ($param=[])
        {
            sec_session_start();

            if (!isset($_SESSION['id'])) {

                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                header("location:". URL. "login"); 

            } else if (!in_array($_SESSION['id_rol'], $GLOBALS['crear'])) {

                $_SESSION['mensaje'] = "Operación sin privilegios";
                header("location:". URL. "usuarios"); 
            
            } else {

                $this->view->usuarios = new Usuario();

                if(isset($_SESSION['error'])) {

                    $this->view->error = $_SESSION['error'];
                    unset($_SESSION['error']);
                    $this->view->usuarios = unserialize($_SESSION['usuario']);
                    unset($_SESSION['usuario']);
                    $this->view->errores = $_SESSION['errores'];
                    unset($_SESSION['errores']);

                }
                $this->view->tittle="Formulario Nuevo Usuario";
                $this->view->perfiles = $this->model->getRoles();
                $this->view->render("usuarios/nuevo/index");

            }
        }

        public function create ($param=[]) {

            sec_session_start();

            if (!isset($_SESSION['id'])) {

                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                header("location:". URL. "login"); 

            } else if (!in_array($_SESSION['id_rol'], $GLOBALS['crear'])) {

                $_SESSION['mensaje'] = "Operación sin privilegios";
                header("location:". URL. "usuarios"); 
            
            } else {

                $name = filter_var($_POST['name'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
                $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
                $password = filter_var($_POST['password'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
                $password_confirm = filter_var($_POST['password_confirm'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
                $rol = filter_var($_POST['rol'] ??= '', FILTER_SANITIZE_EMAIL);

                $usuario= new Usuario(

                    null,
                    $name,
                    $email,
                    $password,
                    $password_confirm,
                    $rol
                );

                $errores = [];

                if(empty($name)) {

                    $errores['name'] = 'Campo obligatorio.';

                }


                if (empty($email)) {

                    $errores['email'] = "Campo Obligatorio.";

                } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    
                    $errores['email'] = "El email es incorrecto.";

                } else if (!$this->model->validarEmail($email)) {

                    $errores['email'] = "Email registrado";

                }

                if (empty($password) || empty($password_confirm)) {

                    $errores['$password'] = "Password y confirmacion son Campos Obligatorios";

                } else if (strcmp($password, $password_confirm) !== 0) {

                    $errores['password'] = "Password no coincidentes";

                } elseif (!$this->model->validarPass($password)) {

                    $errores['password'] = "Password: No permitido";

                }

                if(empty($rol)) {
                    $errores['rol'] = 'Campo obligatorio';
                } else if (!filter_var($rol, FILTER_VALIDATE_INT)) {
                    $errores['rol'] = 'Perfil no válido';
                } else if (!$this->model->validarperfil($rol)) {
                    $errores['rol'] = 'Perfil no existe';
                }

                $this->view->tittle="Tabla Usuarios";

    //          4.- Comprobar Validacion.
           
                if (!empty($errores)) {

                    $_SESSION['usuario'] = serialize($usuario);
                    $_SESSION['error'] = 'Formulario no ha sido validado';
                    $_SESSION['errores'] = $errores;
                    header('location:'. URL. 'usuarios/nuevo');

                } else {

                    $this->model->create($usuario, $password);
                    $_SESSION['mensaje'] = 'usuario creado correctamente';
                    header('location:'.URL.'usuarios');
                }
            }
        }

        public function editar($param=[])
        {
            # Iniciamos sesion:
            sec_session_start();
            

            if (!isset($_SESSION['id'])) {

                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                header("location:". URL. "login"); 

            } else if (!in_array($_SESSION['id_rol'], $GLOBALS['editar'])) {

                $_SESSION['mensaje'] = "Operación sin privilegios";
                header("location:". URL. "usuarios"); 
            
            } else {

                $this->view->id = $param[0];

                $this->view->usuarios = $this->model->read($this->view->id);

                if(isset($_SESSION['error'])) {

                    $this->view->error = $_SESSION['error'];
                    unset($_SESSION['error']);
                    $this->view->usuarios = unserialize($_SESSION['usuarios']);
                    unset($_SESSION['usuarios']);
                    $this->view->errores = $_SESSION['errores'];
                    unset($_SESSION['errores']);

                }


                $this->view->tittle="Editar Usuario";
                $this->view->perfiles = $this->model->getRoles();
                $this->view->render("usuarios/editar/index");

            }
        }

        public function update($param=[])
        {
            # Iniciamos sesion:
            sec_session_start();

            if (!isset($_SESSION['id'])) {

                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                header("location:". URL. "login"); 

            } else if (!in_array($_SESSION['id_rol'], $GLOBALS['editar'])) {

                $_SESSION['mensaje'] = "Operación sin privilegios";
                header("location:". URL. "usuarios"); 
            
            } else {

                # Saneamos el formulario.
                $name = filter_var($_POST['name'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
                $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
                $password = filter_var($_POST['password'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
                $rol = filter_var($_POST['rol'] ??= '', FILTER_SANITIZE_EMAIL);

                
                $edit_usuario= new Usuario(
                    
                    null,
                    $name,
                    $email,
                    $password,
                    $rol

                );

                $id = $param[0];
                
                $usuario = $this->model->read($id);

                $errores = [];
                
                if (strcmp($usuario->name, $name) !==0) {

                    if(empty($name)) {

                        $errores['name'] = 'Campo obligatorio.';
        
                    }

                }

                
                if (strcmp($usuario->email, $email) !==0) {
                    
                    if (empty($email)) {

                        $errores['email'] = "Campo Obligatorio.";
        
                    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        
                        $errores['email'] = "El email es incorrecto.";
        
                    } else if (!$this->model->validarEmail($email)) {
        
                        echo 'marivon';
                        $errores['email'] = "Email registrado";
        
                    }

                }

                 if (empty($password)) {

                    $errores['$password'] = "Password y confirmacion son Campos Obligatorios";

                } elseif (!$this->model->validarPass($password)) {

                    $errores['password'] = "Password: No permitido";

                }

                if(empty($rol)) {
                    $errores['rol'] = 'Campo obligatorio';
                } else if (!filter_var($rol, FILTER_VALIDATE_INT)) {
                    $errores['rol'] = 'Perfil no válido';
                } else if (!$this->model->validarperfil($rol)) {
                    $errores['rol'] = 'Perfil no existe';
                }

                if (!empty($errores)) {

                    $_SESSION['usuarios'] = serialize($usuario);
                    $_SESSION['error'] = 'Formulario no ha sido validado';
                    $_SESSION['errores'] = $errores;
                    header('location:'. URL. 'usuarios/editar/'.$id);

                } else {

                    $this->model->update($edit_usuario,$id);
                    $_SESSION['mensaje'] = 'cliente actualizado correctamente';
                    header('location:'.URL.'usuarios');
                }
            }
        }

        public function mostrar($param=[])
        {
            # Iniciamos sesion:
            sec_session_start();

            if (!isset($_SESSION['id'])) {

                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                header("location:". URL. "login"); 

            } else if (!in_array($_SESSION['id_rol'], $GLOBALS['mostrar'])) {

                $_SESSION['mensaje'] = "Operación sin privilegios";
                header("location:". URL. "usuarios"); 
            
            } else {

                $this->view->id = $param[0];
                $this->view->tittle="Mostrar usuarios";
                $this->view->usuarios=$this->model->read($this->view->id);
                $this->view->render("usuarios/mostrar/index");

            }
        }

        public function eliminar($param=[])
        {
            # Iniciamos sesion:
            sec_session_start();

            if (!isset($_SESSION['id'])) {

                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                header("location:". URL. "login"); 

            } else if (!in_array($_SESSION['id_rol'], $GLOBALS['eliminar'])) {

                $_SESSION['mensaje'] = "Operación sin privilegios";
                header("location:". URL. "usuarios"); 
            
            } else {

                $this->id = $param[0];
                $this->model->deleteUsuarios($this->id);
                header('location:'.URL.'usuarios');

            }
        }

        public function ordenar($param=[])
        {
            # Iniciamos sesion:
            sec_session_start();

            if (!isset($_SESSION['id'])) {

                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                header("location:". URL. "login"); 

            } else if (!in_array($_SESSION['id_rol'], $GLOBALS['ordenar'])) {

                $_SESSION['mensaje'] = "Operación sin privilegios";
                header("location:". URL. "usuarios"); 
            
            } else {

                $this->criterio = $param[0];
                $this->view->tittle="Ordenar Usuarios";
                $this->view->usuarios=$this->model->order($this->criterio);
                $this->view->render("usuarios/ordenar/index");

            }
        }

        public function filtrar($param=[])
        {
            # Iniciamos sesion:
            sec_session_start();
            
            if (!isset($_SESSION['id'])) {

                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                header("location:". URL. "login"); 

            } else if (!in_array($_SESSION['id_rol'], $GLOBALS['buscar'])) {

                $_SESSION['mensaje'] = "Operación sin privilegios";
                header("location:". URL. "usuarios"); 
            
            } else {

                $this->expresion = $_GET['expresion'];
                $this->view->tittle="Filtrar Usuarios";
                $this->view->usuarios=$this->model->filtrar($this->expresion);
                $this->view->render("usuarios/filtrar/index");

            }
        }

        public function pdf($param = []) {

            sec_session_start();
    
             # Comprobamos el usuario identificado
             if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else {
                $usuarios=$this->model->get();
                $pdf=new pdfUsuario('P', 'mm', 'A4');
    
                $pdf->AliasNbPages();
                $pdf->AddPage();            
            
                // Titulo del documento
                $pdf->Titulo();
            
            
                $pdf->CabListadoMovimientos();
                $pdf->SetFont('Times', 'B', 10);
                $fondo = true;
                foreach ($usuarios as $usuario){
                    $pdf->Cell(10, 7, iconv('UTF-8', 'ISO-8859-1', $usuario->id), 'B', 0, 'R', $fondo);
                    $pdf->Cell(30, 7, iconv('UTF-8', 'ISO-8859-1', $usuario->name), 'B', 0, 'L', $fondo);
                    $pdf->Cell(50, 7, iconv('UTF-8', 'ISO-8859-1', $usuario->email), 'B', 0, 'L', $fondo);
                    $pdf->Cell(30, 7, iconv('UTF-8', 'ISO-8859-1', $usuario->perfil), 'B', 1, 'L', $fondo);
    
                    $fondo = !($fondo);
                };
            
            
                ob_end_clean();
                // Cabecera listada
                $pdf->Output("I", "doc.pdf", true);
            }
    
        }
        
    }

?>