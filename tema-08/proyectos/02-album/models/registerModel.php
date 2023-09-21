<?php 

    class RegisterModel extends Model{

        public function validarName($name){

            try{
                                    
                $sql = "SELECT 
                        * 
                        FROM users
                        WHERE name = :name
                        LIMIT 1
                        ";
                
                $conexion = $this->db->connect();

                $pdoSt = $conexion->prepare($sql);
                $pdoSt->bindParam(':name', $name, PDO::PARAM_STR);
                $pdoSt->execute();

                if ( $pdoSt->rowCount() == 0){
                    return TRUE;
                }
                return FALSE;
                
                
            }catch(PDOException $e){

                    include "template/partials/errordb.php";
                    // Para cortar la conexión.
                    exit();

            }

        }

        public function validarEmail($email){
            try {
                    $sql = "SELECT 
                            * 
                            FROM users
                            WHERE email = :email
                            LIMIT 1
                            ";

                    //Conectamos con la base de datos
                    $conexion = $this->db->connect();

                    //Ejecutamos mediante prepare la consulta SQL
                    $pdoSt = $conexion->prepare($sql);
                    $pdoSt->bindParam(':email', $email , PDO::PARAM_STR);
                    $pdoSt->execute();

                    if($pdoSt->rowCount() == 0){
                            return TRUE;
                    }
                    return FALSE;


                }catch(PDOException $e){

                        include "template/partials/errordb.php";
                        // Para cortar la conexión.
                        exit();

                }
        }

        //Registrar nuevo usuario con perfil registrado
        public function registrar (User $user){

            try {

                $password_encriptado = password_hash($user->password, CRYPT_BLOWFISH);

                $sql = "INSERT INTO users
                        VALUES (
                                null,
                                :name,
                                :email,
                                :password,
                                default,
                                default
                                )";

                //Conectamos con la base de datos
                $conexion = $this->db->connect();

                //Ejecutamos mediante prepare la consulta SQL
                $pdoSt = $conexion->prepare($sql);
                $pdoSt->bindParam(':name', $user->name , PDO::PARAM_STR, 50);
                $pdoSt->bindParam(':email', $user->email , PDO::PARAM_STR, 50);
                $pdoSt->bindParam(':password', $password_encriptado , PDO::PARAM_STR, 60);

                $pdoSt->execute();

                //Asignamos el rol de registrado
                //Rol que asiganremos por defecto
                $role_id = 3;

                $sql = "INSERT INTO roles_users
                        VALUES (
                                null,
                                :user_id,
                                :role_id,
                                default,
                                default
                                )";
                
                //Obtener el id del ultimo usuario resgistrado
                $utlimo_id = $conexion->lastInsertId();

                $pdoSt = $conexion->prepare($sql);
                $pdoSt->bindValue(':user_id', $utlimo_id, PDO::PARAM_INT);
                $pdoSt->bindValue(':role_id', $role_id, PDO::PARAM_INT);

                $pdoSt->execute();


            }catch(PDOException $e){

                    include "template/partials/errordb.php";
                    // Para cortar la conexión.
                    exit();

            }
        }


    }



?>