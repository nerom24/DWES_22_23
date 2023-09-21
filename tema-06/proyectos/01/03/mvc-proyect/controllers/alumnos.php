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

            // Mostrará un formulario con los detalles de un alumno

            echo "método editar del controlador alumnos";

        } 

        public function delete($param = []) {

            // Elimina un alumno

            echo "eliminar alumnos";
            echo "quiero eliminar el alumno cuyo id es: ". $param[0];

        }

    }
    

?>