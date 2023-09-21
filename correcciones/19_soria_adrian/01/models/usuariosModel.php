<?php

    Class usuariosModel extends Model{

        // Extraer todos los Usuarios
        public function get(){
            try {
                //Preparo la plantilla mediante string
                $sql = "
                    SELECT 
                        u.id, 
                        u.name, 
                        u.email, 
                        r.name as rol 
                    FROM 
                        users as u inner join roles_users ru
                        ON u.id = ru.user_id
                        inner join roles r
                        ON ru.role_id = r.id
                    
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

        // Extraer todos los roles
        public function getRol(){
            try {
                //Preparo la plantilla mediante string
                $sql = "
                    SELECT 
                        *
                    FROM 
                        roles
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

        # Valida el nombre de usuario
        public function validarName($username) {
            if ((strlen($username) < 5) || (strlen($username) > 50)) {
                return false;
            }
            return true;
        
        }

        #Validar password
        public function validarPass($pass) {
             if ((strlen($pass) < 5) || (strlen($pass) > 50)) {
                return false;
            }
            return true;
        }

        #Validar email unique
        public function validaEmailUnique($email) {

            try {
                
                $selectSQL = "SELECT * FROM users WHERE email = :email";
                $pdo = $this->db->connect();
                $resultado = $pdo->prepare($selectSQL);
                $resultado->bindParam(':email', $email, PDO::PARAM_STR, 50);
                $resultado->execute();
                if ($resultado->rowCount() > 0)
                    return false;
                else 
                    return true;
            } catch (PDOException $e) {
                
                include_once('template/partials/errorDB.php');
                exit();

            }
        
            
        }

        #Validar rol
        public function validarRol($rol) {

            try {
                
                $selectSQL = "SELECT * FROM roles WHERE id = :id";
                $pdo = $this->db->connect();
                $resultado = $pdo->prepare($selectSQL);
                $resultado->bindParam(':id', $rol, PDO::PARAM_INT);
                $resultado->execute();
                if ($resultado->rowCount() == 1)
                    return true;
                else 
                    return false;
            } catch (PDOException $e) {
                
                include_once('template/partials/errorDB.php');
                exit();

            }
        
            
        }


        # Creo nuevo usuario a partir de los datos de formulario de registro
        public function create ($name, $email, $pass, $rol) {
            try {
                
                $password_encriptado = password_hash($pass, CRYPT_BLOWFISH);
            
                $insertarsql = "INSERT INTO users VALUES (
                    null,
                    :nombre,
                    :email,
                    :pass,
                    default,
                    default)";

                $pdo = $this->db->connect();
                $stmt = $pdo->prepare($insertarsql);

                $stmt->bindParam(':nombre', $name, PDO::PARAM_STR, 50);
                $stmt->bindParam(':email', $email , PDO::PARAM_STR, 50);
                $stmt->bindParam(':pass', $password_encriptado, PDO::PARAM_STR, 60) ;
    
                $stmt->execute();

                # Asignamos rol de registrado
                // Rol que asignaremos por defecto

                $insertarsql = "INSERT INTO roles_users VALUES (
                    null,
                    :user_id,
                    :role_id,
                    default,
                    default)";
                
                # Obtener id del último usuario insertado
                $ultimo_id = $pdo->lastInsertId();

                $stmt = $pdo->prepare($insertarsql);

                $stmt->bindParam(':user_id', $ultimo_id);
                $stmt->bindParam(':role_id', $rol);
                $stmt->execute();

            }  catch (PDOException $e) {
                
                include_once('template/partials/errorDB.php');
                exit();

            }
        }
        public function readuser($id){

            try {
                //Preparo la plantilla mediante string
                $sql = "
                        SELECT 
                            u.id, 
                            u.name, 
                            u.email, 
                            r.name as rol,
                            r.id as idrol
                        FROM 
                            users as u inner join roles_users ru
                            ON u.id = ru.user_id
                            inner join roles r
                            ON ru.role_id = r.id
                        WHERE
                            u.id = :id    
                ";

                //conectar con la base de datos
                $conexion = $this->db->connect();
                //Ejecuto el metodo prepare PDO
                $result = $conexion->prepare($sql);

                $result->bindParam(':id', $id, PDO::PARAM_INT);

                //Establece como quiero que devuelva el resultado
                $result->setFetchMode(PDO::FETCH_OBJ);

                //Ejecuto
                $result->execute();

                return $result->fetch();

            } catch (PDOException $error) {
                include_once("template/partials/errorDB.php");
                exit();
            }

        }

        public function update($name, $email, $password, $rol, $id){


            try {
                //Preparo la plantilla mediante string

                if ($password != "") {
                    $password_encriptado = password_hash($password, CRYPT_BLOWFISH);
                    $sql = "
                    UPDATE users 
                    SET 
                        name = :name,
                        email = :email,
                        password = :pass
                        
                    WHERE
                        id = :id   
                    
                    ";

                
                    $conexion = $this->db->connect();
                    //Ejecuto el metodo prepare PDO
                    $pdoST = $conexion->prepare($sql);

                    $pdoST->bindParam(':id', $id, PDO::PARAM_INT);
                    $pdoST->bindParam(':name', $name, PDO::PARAM_STR, 50);
                    $pdoST->bindParam(':email', $email , PDO::PARAM_STR, 50);
                    $pdoST->bindParam(':pass', $password_encriptado, PDO::PARAM_STR, 60) ;


                    //Ejecuto
                    $pdoST->execute();

                } else {

                    $sql = "
                    UPDATE users 
                    SET 
                        name = :name,
                        email = :email
                        
                    WHERE
                        id = :id   
                    
                    ";

                
                    $conexion = $this->db->connect();
                    //Ejecuto el metodo prepare PDO
                    $pdoST = $conexion->prepare($sql);

                    $pdoST->bindParam(':id', $id, PDO::PARAM_INT);
                    $pdoST->bindParam(':name', $name, PDO::PARAM_STR, 50);
                    $pdoST->bindParam(':email', $email , PDO::PARAM_STR, 50);

                    //Ejecuto
                    $pdoST->execute();

                }
                


                $sql = "
                UPDATE roles_users 
                SET 
                    role_id = :role_id
                WHERE
                    user_id = :id   
                
            ";

            
            $conexion = $this->db->connect();
            //Ejecuto el metodo prepare PDO
            $pdoST = $conexion->prepare($sql);

            $pdoST->bindParam(':id', $id, PDO::PARAM_INT);
            $pdoST->bindParam(':role_id', $rol, PDO::PARAM_INT);


            //Ejecuto
            $pdoST->execute();

            } catch (PDOException $error) {
                include_once("template/partials/errorDB.php");
                exit();
            }

        }

        public function delete($id){

            try {
                //Preparo la plantilla mediante string
                $sql = "
                    DELETE from users  
                    WHERE  id = :id limit 1   
                ";
                $conexion = $this->db->connect();
                //Ejecuto el metodo prepare PDO
                $pdoST = $conexion->prepare($sql);

                $pdoST->bindParam(':id', $id, PDO::PARAM_INT);

                //Ejecuto
                $pdoST->execute();


            } catch (PDOException $e) {
                include_once("template/partials/errorDB.php");
                exit();
            }

        }

        public function order($criterio) {
            try {
                $sql = "
                    SELECT 
                        u.id, 
                        u.name, 
                        u.email, 
                        r.name as rol 
                    FROM 
                        users as u inner join roles_users ru
                        ON u.id = ru.user_id
                        inner join roles r
                        ON ru.role_id = r.id
                    order by $criterio    
                    
                ";
                $conexion = $this->db->connect();
                $pdoSt = $conexion->prepare($sql);
                $pdoSt->setFetchMode(PDO::FETCH_OBJ);
                $pdoSt->execute();
                return $pdoSt;
            }catch (PDOException $error) {
                include_once("template/partials/errorDB.php");
                exit();
            }
        }

        public function filter($expresion) {
            try {
                $sql = "
                    SELECT 
                        u.id, 
                        u.name, 
                        u.email, 
                        r.name as rol
                
                    FROM 
                        users as u inner join roles_users ru
                        ON u.id = ru.user_id
                        inner join roles r
                        ON ru.role_id = r.id 

                    WHERE 
                        CONCAT_WS (', ',
                            u.id,
                            u.name,
                            u.email,
                            r.name)

                        like :expresion
                ";
                $conexion = $this->db->connect();
                $pdoSt = $conexion->prepare($sql);
                $pdoSt->bindValue(':expresion', '%'.$expresion.'%', PDO::PARAM_STR);
                $pdoSt->setFetchMode(PDO::FETCH_OBJ);
                $pdoSt->execute();
                return $pdoSt;
            }catch (PDOException $error) {
                include_once("template/partials/errorDB.php");
                exit();
            }
        }


    }

?>