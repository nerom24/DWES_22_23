<?php

    /*
        Clase alumnos de van a definir todas las acciones con la tabla alumnos:

        - select - extraer todos los alumnos
        - insert 
        - update
        - delete
        - read
    */

    class Alumnos extends Conexion {

        public function getAlumnos () {

            try {
                # Plantilla
                $sql = "
                
                SELECT a.id,
                       a.nombre,
                       a.apellidos,
                       a.email,
                       a.poblacion,
                       a.fechaNac,
                       c.nombreCorto curso
                FROM alumnos as a inner join cursos as c
                     ON a.id_curso = c.id

                ";
                # ejecutar PREPARE
                $result = $this->pdo->prepare($sql);

                # establezco com quiero que devuelva el resultado
                $result->setFetchMode(PDO::FETCH_OBJ);

                # ejecuto
                $result->execute();

                return $result;


            } catch (PDOException $error){

                include_once('views/partials/errorDB.php');
                exit();
                
            }

        }
    }

?>