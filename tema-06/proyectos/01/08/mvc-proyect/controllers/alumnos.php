<?php

    class Alumnos Extends Controller {

        public function render() {

            // Mostrará todos los alumnos
            $this->view->title="Tabla Alumnos";
            $this->view->alumnos = $this->model->get();
            $this->view->render('alumnos/main/index');

            # En la carpeta views tengo que crear la carpeta alumnos
            # Dentro de la carpeta alumnos creo main
            # En main creo index.php que corresponde a la vista que muestra los alumnos

            
        }

        public function nuevo() {

            # título de la vista
            $this->view->title = "Formulario Nuevo Alumno";

            # obtener los cursos generar dinámicamente combox de cursos
            $this->view->cursos = $this->model->getCursos();

            # carge la vista nuevo formulario
            $this->view->render('alumnos/nuevo/index');


        }

        public function create($param = []) {

            # Cargamos los datos del formulario
            $new_alumno = new Alumno(
                null,
                $_POST['nombre'],
                $_POST['apellidos'],
                $_POST['email'],
                null,
                null,
                $_POST['poblacion'],
                null,
                null, 
                $_POST['dni'],      
                $_POST['fechaNac'],
                $_POST['id_curso']
            );

            $this->model->create($new_alumno);

            header('location:'.URL.'alumnos');

        }

        public function editar($param = []) {

            // obtengo el id de alumno alumnos/editar/2
            $this->view->id = $param[0];

            // título de la página
            $this->view->title= "Editar alumno";

            // Obtengo el objeto de la clase alumno
            $this->view->alumno = $this->model->read($this->view->id);

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

            # cargar el id de alumno que voy a actualizar
            $id = $param[0];

            # objeto de tipo alumno con los datos del formulario
            $edit_alumno = new Alumno (

                null,
                $_POST['nombre'],
                $_POST['apellidos'],
                $_POST['email'],
                null,
                null,
                $_POST['poblacion'],
                null,
                null, 
                $_POST['dni'],      
                $_POST['fechaNac'],
                $_POST['id_curso']

            );

            # actualizo la base de datos
            $this->model->update($edit_alumno, $id);

            # redirecciono al main de alumnos
            header('location:'. URL. 'alumnos');

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