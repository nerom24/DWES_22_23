<?php

    class Alumnos Extends Controller {

        public function render() {

            # inicio o continuo sesión
            sec_session_start();

            # compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else {

                # Comprueba si existe mensaje
                if (isset($_SESSION['mensaje'])) {
                    $this->view->mensaje = $_SESSION['mensaje'];
                    unset($_SESSION['mensaje']);
                }

                // Mostrará todos los alumnos
                $this->view->title="Tabla Alumnos";
                $this->view->alumnos = $this->model->get();
                
                $this->view->render('alumnos/main/index');

                # En la carpeta views tengo que crear la carpeta alumnos
                # Dentro de la carpeta alumnos creo main
                # En main creo index.php que corresponde a la vista que muestra los alumnos

            }

            
        }

        public function nuevo() {

            # Iniciamos o continuamos sesión
            sec_session_start();

            # Compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['crear']))){

                $_SESSION['mensaje'] = "Operación sin privilegios";
                header("location:" .URL. "alumnos");

            } else {

                # Crear objeto vacío de la clase alumno
                $this->view->alumno = new Alumno();

                # Compruebo si existe algún error en la validación
                if (isset($_SESSION['error'])) {

                    # Mensaje de error
                    $this->view->error = $_SESSION['error'];
                    unset($_SESSION['error']);

                    # Autorrelleno del formulario
                    $this->view->alumno = unserialize($_SESSION['alumno']);
                    unset($_SESSION['alumno']);

                    # Cargo los errores específicos
                    $this->view->errores = $_SESSION['errores'];
                    unset($_SESSION['errores']);


                }
                
                # título de la vista
                $this->view->title = "Formulario Nuevo Alumno";

                # obtener los cursos generar dinámicamente combox de cursos
                $this->view->cursos = $this->model->getCursos();

                # carge la vista nuevo formulario
                $this->view->render('alumnos/nuevo/index');

            }

        }

        public function create($param = []) {

            # inicio sesión
            sec_session_start();

            # Compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['crear']))){

                $_SESSION['mensaje'] = "Operación sin privilegios";
                header("location:" .URL. "alumnos");

            } else {


          

            # Validación Formularios
            # 1. Saneamos datos del formulario FILTER_SANITIZE
            $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $apellidos = filter_var($_POST['apellidos'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
            $fechaNac = filter_var($_POST['fechaNac'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $poblacion = filter_var($_POST['poblacion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $dni = filter_var($_POST['dni'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $id_curso = filter_var($_POST['id_curso'] ??= '', FILTER_SANITIZE_NUMBER_INT);
            
            # 2. Creamos el objeto alumno con los datos saneados
            $new_alumno = new Alumno(
                null,
                $nombre,
                $apellidos,
                $email,
                null,
                null,
                $poblacion,
                null,
                null, 
                $dni,      
                $fechaNac,
                $id_curso
            );

            # 3. Validación de los datos
            
            $errores = [];

            // Validamos nombre
            // Valor obligatorio
            if(empty($nombre)) {
                $errores['nombre'] = 'Campo obligatorio';
            } 

            // Validamos apellidos
            // Valor obligatorio
            if(empty($apellidos)) {
                $errores['apellidos'] = 'Campo obligatorio';
            }

            // Validamos población
            // Campo opcional

            // Validamos email
            // Verificar obligatorio, email, único
            if(empty($email)) {
                $errores['email'] = 'Campo obligatorio';
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores['email'] = 'Email incorrecto';
            } else if (!$this->model->validarEmail($email)) {
                $errores['email'] = 'Email registrado';
            }

            // Validamos fecha nacimiento
            // Campo obligatorio
            if(empty($fechaNac)) {
                $errores['fechaNac'] = 'Campo obligatorio';
            }

            // Validamos dni
            // Verificar obligatorio, formato dni, único
            $options = [
                'options' => [
                    'regexp' => '/^(\d{8})([A-Z])$/'
                ]
            ];
            if(empty($dni)) {
                $errores['dni'] = 'Campo obligatorio';
            } else if (!filter_var($dni, FILTER_VALIDATE_REGEXP, $options)) {
                $errores['dni'] = 'DNI con formato incorrecto';
            } else if (!$this->model->validarDNI($dni)) {
                $errores['dni'] = 'DNI ya ha sido registrado';
            }

            // Validamos id_curso
            // Verificar obligatorio, entero, existe
            if(empty($id_curso)) {
                $errores['id_curso'] = 'Campo obligatorio';
            } else if (!filter_var($id_curso, FILTER_VALIDATE_INT)) {
                $errores['id_curso'] = 'Curso no válido';
            } else if (!$this->model->validarCurso($id_curso)) {
                $errores['id_curso'] = 'Curso no existe';
            }

            # 4. Comprobar validación
            
            if (!empty($errores)) {

                # Debug
                //print_r($errores);
                //exit();

                // Si $errores no está vacio el formulario no ha sido validado
                $_SESSION['alumno'] = serialize($new_alumno);
                $_SESSION['error'] = 'Formulario no ha sido validado';
                $_SESSION['errores'] = $errores;

                # Redireccionamos a nuevo alumno

                header('location:'. URL. 'alumnos/nuevo');
            } else {

                # Crear alumno
                $this->model->create($new_alumno);

                # Crear mensaje
                $_SESSION['mensaje'] = 'Alumno creado correctamente';

                # Redireccionamos 
                header('location:'.URL.'alumnos');
            }
        
        }


        }


        public function editar($param = []) {

            # iniciamos o continuamos sesión
            sec_session_start();

            # Compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['editar']))){

                $_SESSION['mensaje'] = "Operación sin privilegios";
                header("location:" .URL. "alumnos");

            } else {

            # Iniciamos o continuamos sesión
            session_start();

            # Obtengo el id de alumno alumnos/editar/2
            $this->view->id = $param[0];

            # Obtengo el objeto de la clase alumno
            $this->view->alumno = $this->model->read($this->view->id);

            # Comprobar si el formulario viene de una no validación
            if (isset($_SESSION['error'])) {

                # Mensaje de error
                $this->view->error = $_SESSION['error'];
                unset($_SESSION['error']);

                # Autorrelleno del formulario
                $this->view->alumno = unserialize($_SESSION['alumno']);
                unset($_SESSION['alumno']);

                # Cargo los errores específicos
                $this->view->errores = $_SESSION['errores'];
                unset($_SESSION['errores']);

            }
            
            # título de la página
            $this->view->title= "Formulario Edición Alumnos";

            # obtener los cursos generar dinámicamente combox de cursos
            $this->view->cursos = $this->model->getCursos();

            # cargar la vista
            $this->view->render('alumnos/editar/index');
            }

        } 

        public function mostrar($param = []) {

            # inicio sesión
            sec_session_start();

             # Compruebo usuario autentificado
             if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else {



            // obtengo el id de alumno alumnos/editar/2
            $this->view->id = $param[0];

            // título de la página
            $this->view->title= "Mostrar alumno";

            // Obtengo el objeto de la clase alumno
            $this->view->alumno = $this->model->read($this->view->id);

            # obtengo los cursos
            $this->view->cursos = $this->model->getCursos();

            # cargar la vista
            $this->view->render('alumnos/mostrar/index');
            }

        }

        public function update($param = []) {

            # Inicio o continúo sesión
            sec_session_start();

            # Compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['editar']))){

                $_SESSION['mensaje'] = "Operación sin privilegios";
                header("location:" .URL. "alumnos");

            } else {

            # Saneamos el formulario
            $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $apellidos = filter_var($_POST['apellidos'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
            $fechaNac = filter_var($_POST['fechaNac'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $poblacion = filter_var($_POST['poblacion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $dni = filter_var($_POST['dni'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $id_curso = filter_var($_POST['id_curso'] ??= '', FILTER_SANITIZE_NUMBER_INT);

            # Creamos el objeto alumno con los detalles del formulario saneados
            $edit_alumno = new Alumno(
                null,
                $nombre,
                $apellidos,
                $email,
                null,
                null,
                $poblacion,
                null,
                null, 
                $dni,      
                $fechaNac,
                $id_curso
            );

            # Detalles del alumno que voy a actualizar
            $id = $param[0];

            # Obtengo el objeto de dicho alumno
            $alumno = $this->model->read($id);

            # Validación editar alumno
            # Sólo validará en caso de modificación de un detalle
            $errores=[];

            // Validar nombre: obligatorio
            if(strcmp($alumno->nombre, $nombre) !== 0) {
                if(empty($nombre)) {
                    $errores['nombre'] = 'Campo obligatorio';
                } 
            }

            // Validar apellidos: oblitatorio
            if(strcmp($alumno->apellidos, $apellidos) !== 0) {
                if(empty($nombre)) {
                    $errores['apellidos'] = 'Campo obligatorio';
                } 
            }

            // Validar población: opcional

            // Validar email: obligatorio, formato email, único
            if(strcmp($alumno->email, $email) !== 0) {
                if(empty($email)) {
                    $errores['email'] = 'Campo obligatorio';
                } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errores['email'] = 'Email incorrecto';
                } else if (!$this->model->validarEmail($email)) {
                    $errores['email'] = 'Email registrado';
                }
            }
           
            // Validar fecha nacimiento: obligatorio
            if($alumno->fechaNac != $fechaNac) {
                if(empty($fechaNac)) {
                    $errores['fechaNac'] = 'Campo obligatorio';
                } 
            }

            // Validar dni: obligatorio, formato dni, único
            if (strcmp($alumno->dni, $dni) !== 0) {
                
                $options = [
                    'options' => [
                        'regexp' => '/^(\d{8})([A-Z])$/'
                    ]
                ];

                if(empty($dni)) {
                    $errores['dni'] = 'Campo obligatorio';
                } else if (!filter_var($dni, FILTER_VALIDATE_REGEXP, $options)) {
                    $errores['dni'] = 'DNI con formato incorrecto';
                } else if (!$this->model->validarDNI($dni)) {
                    $errores['dni'] = 'DNI ya ha sido registrado';
                }
            }

            // Validar id_curso: obligatorio, entero y existente
            if ($alumno->id_curso != $id_curso)  {
                if(empty($id_curso)) {
                    $errores['id_curso'] = 'Campo obligatorio';
                } else if (!filter_var($id_curso, FILTER_VALIDATE_INT)) {
                    $errores['id_curso'] = 'Curso no válido';
                } else if (!$this->model->validarCurso($id_curso)) {
                    $errores['id_curso'] = 'Curso no existe';
                }
            }

            # comprobamos validación
            if (!empty($errores)) {

                // Si $errores el formulario no ha sido validado
                $_SESSION['alumno'] = serialize($edit_alumno);
                $_SESSION['error'] = 'Formulario no ha sido validado';
                $_SESSION['errores'] = $errores;

                # Redireccionamos a nuevo alumno

                header('location:'. URL. 'alumnos/editar/'.$id);
            } else {

                # actualizo la base de datos
                $this->model->update($edit_alumno, $id);

                # mensaje de actualización
                $_SESSION['mensaje'] = 'Alumno actualizado correctamente';

                # redirecciono al main de alumnos
                header('location:'. URL. 'alumnos');

            }
        }
        }
        
        

        public function eliminar($param = []) {

            sec_session_start();

             # Compruebo usuario autentificado
             if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['eliminar']))){

                $_SESSION['mensaje'] = "Operación sin privilegios";
                header("location:" .URL. "alumnos");

            } else {

            # obtener el id del alumno
            $this->view->id = $param[0];

            # eliminar alumno
            $this->model->delete($this->view->id);

            # redirecciono main de alumnos
            header('location:'. URL. 'alumnos');
            }

        }

        public function ordenar ($param = []) {

            sec_session_start();

             # Compruebo usuario autentificado
             if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else {

            # obtener el criterio
            $criterio = $param[0];

            # titulo
            $this->view->title ="Tabla Alumnos por ". $criterio;

            # obtener alumnos ordenado por criterio
            $this->view->alumnos = $this->model->order($criterio);

            # uso la misma vista del main
            $this->view->render('alumnos/main/index');

            }

        }

        public function buscar($param = []) {

            sec_session_start();

             # Compruebo usuario autentificado
             if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else {

                # obtener expresión búsqueda
                $expresion = $_GET['expresion'];

                # titulo 
                $this->view->title ="Tabla Alumnos filtrada por ". $expresion;

                # obtener alumnos ordenado por criterio
                $this->view->alumnos = $this->model->filter($expresion);

                # uso la misma vista del main
                $this->view->render('alumnos/main/index');
            }

        }

    }
    

?>