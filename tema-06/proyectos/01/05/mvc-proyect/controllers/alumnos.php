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

            # redirecciono al main de corredores
            header('location:'. URL. 'alumnos');

        }

        public function delete($param = []) {

            // Elimina un alumno

            echo "eliminar alumnos";
            echo "quiero eliminar el alumno cuyo id es: ". $param[0];

        }

    }
    

?>