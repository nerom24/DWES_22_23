<?php 
    class PerfilModel extends Model {

    # Devuelve objeto user si lo encuentra
    # Si no lo encuentra devuelve FALSE
    public function getUserId($id) {
        try {

            $sql = "SELECT * FROM Users WHERE id= :id LIMIT 1";
            $conexion = $this->db->connect();
            $result = $conexion->prepare($sql);
            $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,'user');
            $result->bindParam(":id", $id, PDO::PARAM_INT);
            $result->execute();
            
            return $result->fetch();

        }  catch (PDOException $e) {
            
            include_once('template/partials/errorDB.php');
            exit();

        }

    }

    # Actualizar password
    public function updatePass (User $user) {
        try {
             
            $password_encriptado = password_hash($user->password, CRYPT_BLOWFISH);
            $update = "
                        UPDATE users SET
                            password = :password
                        WHERE id = :id      
                        ";

            $conexion = $this->db->connect();
            $result = $conexion->prepare($update);

            $result->bindParam(':password', $password_encriptado , PDO::PARAM_STR, 50);
            $result->bindParam(':id', $user->id, PDO::PARAM_INT) ;

            $result->execute();

        }  catch (PDOException $e) {
            
            include_once('template/partials/errorDB.php');
            exit();

        }
    }

    # Valida nombre de usuario ha de ser único
    public function validarName($name) {

        try {
            $sql = "
                    SELECT * FROM users
                    WHERE name = :name
            ";

            # Conectamos con la base de datos
            $conexion = $this->db->connect();
    
            # Ejecutamos mediante prepare la consulta SQL
            $result= $conexion->prepare($sql);
            $result->bindParam(':name', $name, PDO::PARAM_STR);
            $result -> execute();

           if ($result->rowCount() == 0) 
                    return TRUE;
            return FALSE;

        } catch(PDOException $e) {
            include_once('template/partials/errorDB.php');
            exit();
        }
        
    
    }

   # Valida nombre de usuario ha de ser único
   public function validarEmail($email) {

    try {
        $sql = "
                SELECT * FROM users
                WHERE email = :email
        ";

        # Conectamos con la base de datos
        $conexion = $this->db->connect();

        # Ejecutamos mediante prepare la consulta SQL
        $result= $conexion->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result -> execute();

        if ($result->rowCount() == 0) 
            return TRUE;
        return FALSE;

    } catch(PDOException $e) {
        include_once('template/partials/errorDB.php');
        exit();
    }
    
    }

    # Actualizar perfil name y email
    public function update (User $user) {
        try {
                     
            $update = "
                        UPDATE users SET
                            name = :name,
                            email = :email
                        WHERE id = :id
                        LIMIT 1      
                        ";

            $conexion = $this->db->connect();
            $result = $conexion->prepare($update);

            $result->bindParam(':name', $user->name, PDO::PARAM_STR, 50);
            $result->bindParam(':email', $user->email , PDO::PARAM_STR, 50);
            $result->bindParam(':id', $user->id, PDO::PARAM_INT) ;

            $result->execute();

        }  catch (PDOException $e) {
            
            include_once('template/partials/errorDB.php');
            exit();

        }
    }

    public function delete($id) {

        try {
                $delete = "
                    DELETE FROM users 
                    WHERE id = :id      
                ";

                $conexion = $this->db->connect();
                $result = $conexion->prepare($delete);

                $result->bindParam(':id', $id, PDO::PARAM_INT) ;

                $result->execute();

        }  catch (PDOException $e) {

            include_once('template/partials/errorDB.php');
            exit();

        }

    }

}
?>