<?php 
    class RegisterModel extends Model {

        public function validarName($username) {
            if ((strlen($username) < 5) || (strlen($username) > 50)) {
                return false;
            }
            return true;
        }

        public function validarPass($pass) {
            if ((strlen($pass) < 5) || (strlen($pass) > 50)) {
                return false;
            }
            return true;
        }

        public function validaEmailUnique($email) {

            try {
                
                $selectSQL = "SELECT * FROM users WHERE email = :email";
                $pdo = $this->db->connect();
                $resultado = $pdo->prepare($selectSQL);
                $resultado->bindParam(':email', $email, PDO::PARAM_STR, 50);
                $resultado->execute();
                if ($resultado->rowCount() > 0){
                    return false;
                } else {
                    return true;
                }
            } catch (PDOException $e) {
                include_once('template/partials/errorDB.php');
                exit();
            }
        }

        public function crear ($name, $email, $pass) {
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
                
                $role_id = 3;
                $insertarsql = "INSERT INTO roles_users VALUES (
                    null,
                    :user_id,
                    :role_id,
                    default,
                    default)";
                
                $ultimo_id = $pdo->lastInsertId();

                $stmt = $pdo->prepare($insertarsql);

                $stmt->bindParam(':user_id', $ultimo_id);
                $stmt->bindParam(':role_id', $role_id);
                $stmt->execute();

            }  catch (PDOException $e) {
                include_once('template/partials/errorDB.php');
                exit();
            }
        }
    }
?>