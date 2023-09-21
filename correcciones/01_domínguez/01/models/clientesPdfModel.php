<?php

    Class clientesPdfModel extends Model{

        // Extraer todos los alumnos
        public function get(){
            try {
                
                $sql = "
                SELECT 
                    id,
                    apellidos,
                    nombre,
                    telefono,
                    dni,
                    email
                from clientes
                    order by a.id    
                ";

                //conectar con la base de datos
                $conexion = $this->db->connect();

                //Ejecuto el metodo prepare PDO
                $result = $conexion->prepare($sql);

                //Establece como quiero que devuelva el resultado
                $result->setFetchMode(PDO::FETCH_OBJ);

                //Ejecuto
                $result->execute();

                return $result;

            } catch (PDOException $e) {
                include_once("template/partials/errorDB.php");
                exit();
            }
        }
    }

?>