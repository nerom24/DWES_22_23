<?php

    class loginModel extends Model{

        //Devuelve el objeto a partir de un email
        public function getUserEmail($email){

            try {
                $sql = "SELECT * FROM users
                        WHERE email = :email
                        LIMIT 1
                ";
                //Conectamos con la base de datos
                $conexion = $this->db->connect();

                //Ejecutamos mediante prepare la consulta SQL
                $pdoSt = $conexion->prepare($sql);
                $pdoSt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'user');
                $pdoSt->bindParam(':email', $email , PDO::PARAM_STR);
                $pdoSt->execute();

                return $pdoSt->fetch();


            }catch(PDOException $e){

                    include "template/partials/errordb.php";
                    // Para cortar la conexión.
                    exit();

            }
        } 
        
        public function getUserIdPerfil($id){

            //var_dump($id);
            //exit();
            try {
                $sql = "SELECT ru.role_id
                
                        FROM users u

                        INNER JOIN roles_users ru ON u.id = ru.user_id

                        WHERE u.id = :id

                        LIMIT 1
                ";
                //Conectamos con la base de datos
                $conexion = $this->db->connect();

                //Ejecutamos mediante prepare la consulta SQL
                $pdoSt = $conexion->prepare($sql);
                $pdoSt->setFetchMode(PDO::FETCH_OBJ);
                $pdoSt->bindValue(':id', $id , PDO::PARAM_INT);
                $pdoSt->execute();

                return $pdoSt->fetch()->role_id;


            }catch(PDOException $e){

                    include "template/partials/errordb.php";
                    // Para cortar la conexión.
                    exit();

            }
        }

        public function getUserPerfil($id){

            try {
                $sql = "SELECT name
                
                        FROM roles

                        WHERE id = :id

                        LIMIT 1
                ";
                //Conectamos con la base de datos
                $conexion = $this->db->connect();

                //Ejecutamos mediante prepare la consulta SQL
                $pdoSt = $conexion->prepare($sql);
                $pdoSt->setFetchMode(PDO::FETCH_OBJ);
                $pdoSt->bindValue(':id', $id , PDO::PARAM_INT);
                $pdoSt->execute();

                return $pdoSt->fetch()->name;


            }catch(PDOException $e){

                    include "template/partials/errordb.php";
                    // Para cortar la conexión.
                    exit();

            }


        }
    }

?>