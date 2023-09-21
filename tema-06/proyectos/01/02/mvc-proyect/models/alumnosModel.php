<?php

    Class alumnosModel extends Model {

        # Extraer todos los alumnos
        public function get() {

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
                
                # Conectar con la base de datos
                $conexion = $this->db->connect();
               

                # Ejecutamos mediante prepare la consulta SQL
                $result = $conexion->prepare($sql);
                $result->setFetchMode(PDO::FETCH_OBJ);
                $result->execute();

                return $result;


            } catch (PDOException $e){

                include_once('template/partials/errorDB.php');
                exit();
                
            }


        }

    } 

?>