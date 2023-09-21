<?php


class usersModel extends Model
{

    public function get()
    {
        try {

            $sql = " 
            SELECT 
                u.id,
                u.name,
                u.email,
                u.password,
                ru.role_id,
                r.name perfil
            FROM 
                users as u inner join roles_users as ru on u.id = ru.user_id
                inner join roles as r on ru.role_id = r.id";

            $conexion = $this->db->connect();

            $result = $conexion->prepare($sql);

            $result->setFetchMode(PDO::FETCH_OBJ);

            $result->execute();

            return $result;
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function create($user)
    {
        try {

                $sql = " INSERT INTO users (name, email, password) values( 
                    :name,
                    :email,
                    :password
                )";

            $conexion = $this->db->connect();
            $pdoSt = $conexion->prepare($sql);

            $pdoSt->bindParam(":name", $user->name, PDO::PARAM_STR, 30);
            $pdoSt->bindParam(":email", $user->email, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(":password", $user->password, PDO::PARAM_STR, 50);

            $pdoSt->execute();
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function delete($id)
    {
        try {

            $sql = " 
                DELETE FROM users WHERE id=:id;";

            $conexion = $this->db->connect();


            $result = $conexion->prepare($sql);

            $result->bindParam(":id", $id, PDO::PARAM_INT);

            $result->execute();

            return $result;
        } catch (PDOException $error) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function getUser($id)
    {
        try {
            $sql = " 
                SELECT 
                    u.id,
                    u.name,
                    u.email,
                    u.password,
                    ru.role_id,
                    r.name perfil
                FROM 
                    users as u inner join roles_users as ru on u.id = ru.user_id
                    inner join roles as r on ru.role_id = r.id 
                    where u.id = :id";

            $conexion = $this->db->connect();

            $result = $conexion->prepare($sql);

            $result->bindParam(":id", $id, PDO::PARAM_INT);


            $result->setFetchMode(PDO::FETCH_OBJ);

            $result->execute();

            return $result->fetch();
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function update($id, $user)
    {
        try {

                $sql = " UPDATE users
                    SET
                        name = :name,
                        email = :email,
                        password = :password,
                        update_at = now()
                    WHERE
                        id = :id";

            $conexion = $this->db->connect();

            $pdoSt = $conexion->prepare($sql);


            $pdoSt->bindParam(":name", $user->name, PDO::PARAM_STR, 30);
            $pdoSt->bindParam(":email", $user->email, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(":password", $user->password, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(":id", $id, PDO::PARAM_INT);

            $pdoSt->execute();
        } catch (PDOException $error) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function order($criterio)
    {
        try {

                $sql = "SELECT 
                        u.id,
                        u.name,
                        u.email,
                        u.password,
                        ru.role_id,
                        r.name perfil
                    FROM 
                        users as u inner join roles_users as ru on u.id=ru.user_id inner join roles as r on ru.role_id = r.id order by $criterio";
                    

            $conexion = $this->db->connect();

            $result = $conexion->prepare($sql);

            $result->setFetchMode(PDO::FETCH_OBJ);

            $result->execute();

            return $result;
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }


    public function filter($expresion)
    {
        try {

                $sql = "SELECT 
                            u.id,
                            u.name,
                            u.email,
                            ru.role_id,
                            r.name as perfil
                        FROM 
                            users as u
                            INNER JOIN roles_users as ru ON u.id = ru.user_id
                            INNER JOIN roles as r ON ru.role_id = r.id
                        WHERE 
                            CONCAT_WS(' ', u.name, u.email, r.name) LIKE ? ";

            $expresion = "%" . $expresion . "%";

            $conexion = $this->db->connect();

            $result = $conexion->prepare($sql);

            $result->bindParam(1, $expresion, PDO::PARAM_STR);


            $result->setFetchMode(PDO::FETCH_OBJ);

            $result->execute();

            return $result;
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function validarEmail($email)
    {
        try {
            $sql = " 
                    SELECT     
                
                    *
                
                    FROM  users  where email=:email";

            $conexion = $this->db->connect();

            $result = $conexion->prepare($sql);

            $result->bindParam(":email", $email, PDO::PARAM_STR);

            
            $result->execute();

            if ($result->rowCount() == 1)
                return false;
            return true;
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }
}
