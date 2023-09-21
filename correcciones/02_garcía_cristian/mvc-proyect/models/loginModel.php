<?php 
    class loginModel extends Model {


    # Devuelve un objeto de la clase Users a partir del email de usuario
    public function getUserEmail($email) {
        try {

            $sql = "SELECT * FROM Users WHERE email= :email LIMIT 1";
            $pdo = $this->db->connect();
            $stmt = $pdo->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            
            return $stmt->fetch();

        }  catch (PDOException $e) {
            
            include_once('template/partials/errorDB.php');
            exit();

        }
    }

    # Devuelve id de perfil a partir del id de usuario
    public function getUserIdPerfil($id) {

        try {

            $selectSQL = "SELECT 
                        ru.role_id
                    FROM
                        users u
                    INNER JOIN
                        roles_users ru ON u.id = ru.user_id
                    WHERE
                        u.id = :id
                    LIMIT 1";
            $pdo = $this->db->connect();
            $resultado = $pdo->prepare($selectSQL);
            $resultado->setFetchMode(PDO::FETCH_OBJ);
            $resultado->bindParam(':id', $id, PDO::PARAM_INT);
            $resultado->execute();
            return $resultado->fetch()->role_id;

        } catch (PDOException $e) {
            
            include_once('template/partials/errorDB.php');
            exit();

        }

    }

        
    # Obtener el nombre perfil a partir del id de perfil
    public function getUserPerfil($id) {

        try {

            $selectSQL = "SELECT 
                        name
                    FROM
                        roles
                    WHERE
                        id = :id
                    LIMIT 1";

            $pdo = $this->db->connect();
            $resultado = $pdo->prepare($selectSQL);
            $resultado->setFetchMode(PDO::FETCH_OBJ);
            $resultado->bindParam(':id', $id, PDO::PARAM_INT);
            $resultado->execute();
            return $resultado->fetch()->name;

        } catch (PDOException $e) {
            
            include_once('template/partials/errorDB.php');
            exit();
    
        }
        

    }

}
?>