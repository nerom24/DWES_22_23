<?php
class usersModel extends Model
{

    public function get()
    {
        try {
            // plantilla
            $sql = " 
            SELECT 
                us.id,
                us.name,
                us.email,
                rus.role_id
            FROM 
                users as us
                inner join roles_users as rus on rus.user_id = us.id
                ;";

            $conexion = $this->db->connect();

            $result = $conexion->prepare($sql);
            //Establez como quiero q devuelva el resultado 

            $result->setFetchMode(PDO::FETCH_OBJ);

            // ejecuto
            $result->execute();

            return $result->fetchAll();
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }
    public function getUser($id)
    {
        try {
            // plantilla
            $sql = " 
            SELECT 
                us.id,
                us.name,
                us.email,
                rus.role_id
            FROM 
                users as us
                inner join roles_users as rus on rus.user_id = us.id
                where us.id= :id
                ;";

            $conexion = $this->db->connect();

            $result = $conexion->prepare($sql);
            //Establez como quiero q devuelva el resultado 
            $result->bindParam(":id", $id, PDO::PARAM_INT);
            $result->setFetchMode(PDO::FETCH_OBJ);

            // ejecuto
            $result->execute();

            return $result->fetch();
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function getRoles()
    {
        try {
            // plantilla
            $sql = " 
            SELECT 
                *
            FROM 
                roles;";

            $conexion = $this->db->connect();

            $result = $conexion->prepare($sql);
            //Establez como quiero q devuelva el resultado 

            $result->setFetchMode(PDO::FETCH_ASSOC);

            // ejecuto
            $result->execute();

            return $result->fetchAll();
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }


    # Valida el nombre de usuario
    public function validarName($username)
    {
        if ((strlen($username) < 5) || (strlen($username) > 50)) {
            return false;
        }
        return true;
    }

    #Validar password
    public function validarPass($pass)
    {
        if ((strlen($pass) < 5) || (strlen($pass) > 50)) {
            return false;
        }
        return true;
    }

    #Validar email unique
    public function validaEmailUnique($email)
    {

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

    public function validarIDrol($id)
    {
        try {
            $sql = "
                SELECT * FROM roles
                WHERE id = :id
        ";

            # Conectamos con la base de datos
            $conexion = $this->db->connect();

            # Ejecutamos mediante prepare la consulta SQL
            $result = $conexion->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->execute();

            if ($result->rowCount() == 0)
                return FALSE;
            return TRUE;
        } catch (PDOException $e) {
            include_once('template/partials/errorDB.php');
        }
    }
    # Creo nuevo usuario a partir de los datos de formulario de registro
    public function crear($name, $email, $pass, $id_rol)
    {
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
            $stmt->bindParam(':email', $email, PDO::PARAM_STR, 50);
            $stmt->bindParam(':pass', $password_encriptado, PDO::PARAM_STR, 60);



            $stmt->execute();



            # Asignamos rol de registrado

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
            $stmt->bindParam(':role_id', $id_rol);
            $stmt->execute();
        } catch (PDOException $e) {

            include_once('template/partials/errorDB.php');
            exit();
        }
    }


    public function update($name, $email, $pass, $id_rol, $id)
    {
        try {

            $password_encriptado = password_hash($pass, CRYPT_BLOWFISH);

            $insertarsql = "
            UPDATE users SET 
            email = :email,
            name = :nombre,
            password = :pass

             WHERE id = :id
                ";

            $pdo = $this->db->connect();
            $stmt = $pdo->prepare($insertarsql);

            $stmt->bindParam(':nombre', $name, PDO::PARAM_STR, 50);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR, 50);
            $stmt->bindParam(':pass', $password_encriptado, PDO::PARAM_STR, 60);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);



            $stmt->execute();
            # Asignamos rol de registrado

            $insertarsql = "
            UPDATE roles_users SET
                role_id=:role_id  where id=:id";

            $stmt = $pdo->prepare($insertarsql);

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':role_id', $id_rol);
            $stmt->execute();
        } catch (PDOException $e) {

            include_once('template/partials/errorDB.php');
            exit();
        }
    }


    public function delete($id)
    {
        try {
            // plantilla
            $sql = " 
                   DELETE FROM users WHERE id=:id;";

            $conexion = $this->db->connect();


            $result = $conexion->prepare($sql);

            $result->bindParam(":id", $id, PDO::PARAM_INT);

            // ejecuto
            $result->execute();

            return $result;
        } catch (PDOException $error) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function order($criterio)
    {
        try {
            // plantilla
            $sql = " 
            SELECT 
                us.id,
                us.name,
                us.email,
                rus.role_id
            FROM 
                users as us
                inner join roles_users as rus on rus.user_id = us.id
                 order by $criterio ";

            $conexion = $this->db->connect();

            $result = $conexion->prepare($sql);

            // $result->bindParam(":criterio", $criterio, PDO::PARAM_STR);

            //Establez como quiero q devuelva el resultado 
            $result->setFetchMode(PDO::FETCH_OBJ);

            // ejecuto
            $result->execute();

            return $result->fetchAll();
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function filter($expresion)
    {
        try {
            // plantilla
            $sql = " SELECT 
                us.id,
                us.name,
                us.email,
                rus.role_id
            FROM 
                users as us
                inner join roles_users as rus on rus.user_id = us.id inner join roles as rol on rus.role_id =rol.id
                    WHERE 

                        concat_ws(' ',
                        us.id,
                        us.name,
                        us.email,
                        rus.role_id,
                        rol.name)
                        like ? ";

            $expresion = "%" . $expresion . "%";

            $conexion = $this->db->connect();

            $result = $conexion->prepare($sql);

            $result->bindParam(1, $expresion, PDO::PARAM_STR);


            //Establez como quiero q devuelva el resultado 
            $result->setFetchMode(PDO::FETCH_OBJ);

            // ejecuto
            $result->execute();

            return $result->fetchAll();
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }
}
