<?php 

    class AuthModel extends Model{

        //Devuelve un objeto user si lo encuentra
        //Si no lo encuentra devuevle false
        public function getUserId(int $id) {
            try {
                # Sentencia SQL
                $sql = 'SELECT *
                    FROM users
                    WHERE id = :id
                    LIMIT 1';
    
                # Conectar con la base de datos
                $conexion = $this->db->connect();
    
                // Preparar sentencia SQL
                $pdoSt = $conexion->prepare($sql);
                // Modo de extracción
                $pdoSt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
                // Valores de los parámetros
                $pdoSt->bindValue(':id', $id, PDO::PARAM_INT);
                // Ejecutar sentencia SQL
                $pdoSt->execute();
                // Retornar resultado (false o datos)
                return $pdoSt->fetch();
    
                // En caso de excepción
            } catch (PDOException $e) {
                // Incluir HTML para tabla de error
                include 'template/partials/errordb.php';
                
            }
        }

        public function validarEmail($email){
            try{
                $sql = "SELECT * FROM users where email = :email LIMIT 1";

                $conexion = $this->db->connect();
                $pdoSt = $conexion->prepare($sql);
                $pdoSt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
                $pdoSt->bindParam(':email', $email);
                $pdoSt->execute();
                
                if($pdoSt->rowCount() == 0){
                    return true;
                } else{     
                    return false;
                }
            } catch(PDOException $e){
                include('template/partials/errordb.php');
                exit(0);
            }
        }

        public function validarName($name){
            try{
                $sql = "SELECT * FROM users where name = :name LIMIT 1";

                $conexion = $this->db->connect();
                $pdoSt = $conexion->prepare($sql);
                $pdoSt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
                $pdoSt->bindParam(':name', $name);
                $pdoSt->execute();
                
                if($pdoSt->rowCount() == 0){
                    return true;
                } else{
                    return false;
                }
            } catch(PDOException $e){
                include('template/partials/errordb.php');
                exit(0);
            }
        }

            # Método para actualizar un usuario
        public function update(User $user) {
            try {
                // Consulta para traer los corredores y su curso
                $sql = 'UPDATE users SET

                        name = :name,
                        email = :email

                        WHERE id = :id
                        LIMIT 1';


                # Conectar con la base de datos
                $conexion = $this->db->connect();

                // Preparar consulta SQL
                $pdoSt = $conexion->prepare($sql);

                // Parámetros
                $pdoSt->bindParam(':id', $user->id, PDO::PARAM_INT);
                $pdoSt->bindParam(':name', $user->name, PDO::PARAM_STR, 50);
                $pdoSt->bindParam(':email', $user->email, PDO::PARAM_STR, 50);

                // Ejecutar consulta SQL
                $pdoSt->execute();

                // Si hay resultados, retornar array
                if ($pdoSt) return true;
                // En caso de excepción
            } catch (PDOException $e) {
                // Incluir HTML para tabla de error
                include 'template/partials/errordb.php';
            }
        }

        public function updatePassword(User $user){

            try{
                $password_encriptado = password_hash($user->password, CRYPT_BLOWFISH);
                $sql = "UPDATE users SET
                    password = :password
                    WHERE id = :id
                    LIMIT 1";

                $conexion = $this->db->connect();
                $result = $conexion->prepare($sql);
                $result->bindParam(":password", $password_encriptado, PDO::PARAM_STR, 60);
                $result->bindParam(":id", $user->id, PDO::PARAM_INT);

                $result->execute();
            } catch (PDOException $e) {
                include_once('template/partials/errordb.php');
                exit(0);
            }

        }


        # Método para borrar un usuario
        public function delete($id){
            try{
                            
                    $sql = "DELETE
                    FROM users
                    WHERE id = :id
                    LIMIT 1";

                    $conexion = $this->db->connect();

                    $pdoSt = $conexion->prepare($sql);
                    $pdoSt->bindParam(':id', $id , PDO::PARAM_INT);
                    //Forma de clase
                    //$pdoSt->setFetchMode(PDO::FETCH_CLASS, 'Corredor');
                    //Forma de objeto
                    //$pdoSt->setFetchMode(PDO::FETCH_OBJ);
                    //Forma asociativa
                    //$pdoSt->setFetchMode(PDO::FETCH_ASSOC);
                    $pdoSt->execute();

            }catch(PDOException $e){

                    include "template/partials/errordb.php";
                    // Para cortar la conexión.
                    exit();

            }
        }

    }


?>