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

            // Mostrará el formulario nuevo alumno

            echo "método nuevo del controlador alumno";

        }

        public function create($param = []) {

            // Añadirá un alumno a la base de datos

            echo "método create del controlador alumno";

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