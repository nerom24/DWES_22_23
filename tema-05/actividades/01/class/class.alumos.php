<?php

    class Alumnos extends Conexion {

        public function getAlumnos() {

            // Creamos la sentencia sql como string
            $sql = "
                    select 
                            alumnos.id,
                            alumnos.nombre,
                            alumnos.apellidos,
                            alumnos.email,
                            alumnos.poblacion,
                            alumnos.fechaNac,
                            cursos.nombreCorto curso
                    from 
                            alumnos inner join cursos
                            ON alumnos.id_curso = cursos.id
            ";

            // Ejecutamos la sentencia sql
            // El resultado lo almacenará en un objeto de la clase
            // mysqli_result
            $alumnos = $this->conexion->query($sql);

            // fetch_assoc() - devuelve el primer elemento 
            // fetch_all(MYSQLI_ASSOC) - devuelve todo el array

            return $alumnos->fetch_all(MYSQLI_ASSOC);
        }

    }

?>