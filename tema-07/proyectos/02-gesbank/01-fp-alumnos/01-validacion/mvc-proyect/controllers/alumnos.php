<?php

    class Alumnos Extends Controller {

        public function render() {

            # inicio o continuo sesión
            session_start();

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

        public function nuevo() {

            # Iniciamos o continuamos sesión
            session_start();

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

        public function create($param = []) {

            # inicio sesión
            session_start();

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


        public function editar($param = []) {

            # Iniciamos o continuamos sesión
            session_start();

            # obtengo el id de alumno alumnos/editar/2
            $this->view->id = $param[0];

            # Obtengo el objeto de la clase alumno
            $this->view->alumno = $this->model->read($this->view->id);

            # Comprueba si el formulario no ha sido validado
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


            // título de la página
            $this->view->title= "Formulario Editar alumno";

            # obtener los cursos generar dinámicamente combox de cursos
            $this->view->cursos = $this->model->getCursos();

            # cargar la vista
            $this->view->render('alumnos/editar/index');

        } 

        public function mostrar($param = []) {

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

        public function update($param = []) {

            # inicio sesión
            session_start();

            # 1. Saneamos datos del formulario FILTER_SANITIZE
            $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $apellidos = filter_var($_POST['apellidos'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
            $fechaNac = filter_var($_POST['fechaNac'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $poblacion = filter_var($_POST['poblacion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $dni = filter_var($_POST['dni'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $id_curso = filter_var($_POST['id_curso'] ??= '', FILTER_SANITIZE_NUMBER_INT);
            
            # 2. Creamos el objeto alumno con los datos saneados
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


            # cargar el id de alumno que voy a actualizar
            $id = $param[0];

            # obtengo el objeto alumno original
            $alumno = $this->model->read($id);

            # Validación del formulario editar alumno
            # Sólo realizará la validación en caso de modificación del campo

            # 3. Validación de los datos
            
            $errores = [];

            // Validamos nombre
            // Valor obligatorio
            if (strcmp($alumno->nombre, $nombre) !== 0) {
                if(empty($nombre)) {
                    $errores['nombre'] = 'Campo obligatorio';
                } 
            }  

            // Validamos apellidos
            // Valor obligatorio
            if (strcmp($alumno->apellidos, $apellidos) !== 0) {
                if(empty($apellidos)) {
                    $errores['apellidos'] = 'Campo obligatorio';
                }
            }

            // Validamos población
            // Campo opcional

            // Validamos email
            // Verificar obligatorio, email, único
            if (strcmp($alumno->email, $email) !== 0) {
                if(empty($email)) {
                    $errores['email'] = 'Campo obligatorio';
                } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errores['email'] = 'Email incorrecto';
                } else if (!$this->model->validarEmail($email)) {
                    $errores['email'] = 'Email registrado';
                }
            }

            // Validamos fecha nacimiento
            // Campo obligatorio
            if (strcmp($alumno->fechaNac, $fechaNac) !== 0) {
                if(empty($fechaNac)) {
                    $errores['fechaNac'] = 'Campo obligatorio';
                }
            }

            // Validamos dni
            // Verificar obligatorio, formato dni, único
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

            // Validamos id_curso
            // Verificar obligatorio, entero, existe
            if (strcmp($alumno->id_curso, $id_curso) !== 0) {
                if(empty($id_curso)) {
                    $errores['id_curso'] = 'Campo obligatorio';
                } else if (!filter_var($id_curso, FILTER_VALIDATE_INT)) {
                    $errores['id_curso'] = 'Curso no válido';
                } else if (!$this->model->validarCurso($id_curso)) {
                    $errores['id_curso'] = 'Curso no existe';
                }
            }

            # 4. Comprobamos validación

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

                # Crear mensaje
                $_SESSION['mensaje'] = 'Alumno actualizado correctamente';

                # redirecciono al main de alumnos
                header('location:'. URL. 'alumnos');

            }

        }

        public function eliminar($param = []) {

            # obtener el id del alumno
            $this->view->id = $param[0];

            # eliminar alumno
            $this->model->delete($this->view->id);

            # redirecciono main de alumnos
            header('location:'. URL. 'alumnos');

        }

        public function ordenar ($param = []) {

            # obtener el criterio
            $criterio = $param[0];

            # titulo
            $this->view->title ="Tabla Alumnos por ". $criterio;

            # obtener alumnos ordenado por criterio
            $this->view->alumnos = $this->model->order($criterio);

            # uso la misma vista del main
            $this->view->render('alumnos/main/index');

        }

        public function buscar($param = []) {

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
    

?>