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

        # Extraer los cursos 
        public function getCursos() {

            try {
                # Plantilla
                $sql = "
                
                    SELECT 
                            id,
                            nombreCorto curso
                    FROM 
                            cursos

                ";

                # Conectar con la base de datos
                $conexion = $this->db->connect();

                # ejecutar PREPARE
                $result = $conexion->prepare($sql);

                # establezco com quiero que devuelva el resultado
                $result->setFetchMode(PDO::FETCH_OBJ);

                # ejecuto
                $result->execute();

                return $result;


            } catch (PDOException $e){

                include_once('template/partials/errorDB.php');
                exit();
                
            }


        }

        public function create(Alumno $alumno) {

            try {

                $sql = "
                    INSERT INTO Alumnos (
                        nombre,
                        apellidos,
                        email,
                        poblacion,
                        dni,
                        fechaNac,
                        id_curso
                    )
                    VALUES (
                        :nombre,
                        :apellidos,
                        :email,
                        :poblacion,
                        :dni,
                        :fechaNac,
                        :id_curso
                    )
            ";

            # Conectar con la base de datos
            $conexion = $this->db->connect();

            $pdoSt = $conexion->prepare($sql);

            $pdoSt->bindParam(':nombre', $alumno->nombre, PDO::PARAM_STR, 30);
            $pdoSt->bindParam(':apellidos', $alumno->apellidos, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(':email', $alumno->email, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(':poblacion', $alumno->poblacion, PDO::PARAM_STR, 30);
            $pdoSt->bindParam(':dni', $alumno->dni, PDO::PARAM_STR, 9);
            $pdoSt->bindParam(':fechaNac', $alumno->fechaNac);
            $pdoSt->bindParam(':id_curso', $alumno->id_curso, PDO::PARAM_INT);

            $pdoSt->execute();
        }  catch (PDOException $e) {
            include_once('template/partials/errorDB.php');
            exit();
        }

        }

        public function read($id) {

            try {
                $sql ="
                        SELECT 
                                id,
                                nombre, 
                                apellidos,
                                email,
                                poblacion,
                                dni,
                                fechaNac,
                                id_curso
                        FROM 
                                alumnos
                        WHERE
                                id = :id
                ";

                # Conectar con la base de datos
                $conexion = $this->db->connect();

    
                $pdoSt = $conexion->prepare($sql);
    
                $pdoSt->bindParam(':id', $id, PDO::PARAM_INT);
                $pdoSt->setFetchMode(PDO::FETCH_OBJ);
                $pdoSt->execute();
                
                return $pdoSt->fetch();
    
            } catch (PDOException $e) {
                include_once('template/partials/errorDB.php');
                exit();
            }
    
        }

        public function update(Alumno $alumno, $id) {

            try {

                $sql = "
                
                UPDATE alumnos
                SET
                        nombre = :nombre,
                        apellidos = :apellidos,
                        email = :email,
                        poblacion = :poblacion,
                        dni = :dni,
                        fechaNac = :fechaNac,
                        id_curso = :id_curso
                WHERE
                        id = :id
                LIMIT 1
                ";

                $conexion = $this->db->connect();
                
                $pdoSt = $conexion->prepare($sql);

                $pdoSt->bindParam(':id', $id, PDO::PARAM_INT);

                $pdoSt->bindParam(':nombre', $alumno->nombre, PDO::PARAM_STR, 30);
                $pdoSt->bindParam(':apellidos', $alumno->apellidos, PDO::PARAM_STR, 50);
                $pdoSt->bindParam(':email', $alumno->email, PDO::PARAM_STR, 50);
                $pdoSt->bindParam(':poblacion', $alumno->poblacion, PDO::PARAM_STR, 30);
                $pdoSt->bindParam(':dni', $alumno->dni, PDO::PARAM_STR, 9);
                $pdoSt->bindParam(':fechaNac', $alumno->fechaNac);
                $pdoSt->bindParam(':id_curso', $alumno->id_curso, PDO::PARAM_INT);

                $pdoSt->execute();

        }
        catch(PDOException $e) {
            include_once('template/partials/errorDB.php');
            exit();
        }

        }

        public function delete($id) {

            try {
                $sql = "DELETE FROM alumnos WHERE id = :id limit 1";
                $conexion = $this->db->connect();
                $pdoSt = $conexion->prepare($sql);			          
                $pdoSt->bindParam(':id', $id, PDO::PARAM_INT);
                $pdoSt->execute();
            } 
        
            catch (PDOException $error) {	
        
                include_once('template/partials/errorDB.php');
                exit();
            }

        }

         # Extraer todos los alumnos
         public function order($criterio) {

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
                    ORDER BY $criterio

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