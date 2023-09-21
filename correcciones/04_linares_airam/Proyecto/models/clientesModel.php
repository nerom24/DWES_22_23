<?php


class clientesModel extends Model
{

    public function get()
    {
        try {
            // plantilla
            $sql = " 
            SELECT 
                id,
                apellidos,
                nombre,
                telefono,
                ciudad,
                dni,
                email
            FROM 
                clientes;";

            $conexion = $this->db->connect();

            $result = $conexion->prepare($sql);
            //Establez como quiero q devuelva el resultado 

            $result->setFetchMode(PDO::FETCH_OBJ);

            // ejecuto
            $result->execute();

            return $result;
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function create($cliente)
    {
        try {
            // plantilla
            $sql = " INSERT INTO clientes (nombre,apellidos,email,telefono,ciudad,dni) values( 
                    :nombre,
                    :apellidos,
                    :email,
                    :telefono,
                    :ciudad,
                    :dni
                )";

            $conexion = $this->db->connect();
            $pdoSt = $conexion->prepare($sql);

            //Bindeamos parametros
            $pdoSt->bindParam(":nombre", $cliente->nombre, PDO::PARAM_STR, 30);
            $pdoSt->bindParam(":apellidos", $cliente->apellidos, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(":email", $cliente->email, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(":telefono", $cliente->telefono, PDO::PARAM_STR, 9);
            $pdoSt->bindParam(":ciudad", $cliente->ciudad, PDO::PARAM_STR, 30);
            $pdoSt->bindParam(":dni", $cliente->dni, PDO::PARAM_STR, 9);

            // ejecuto
            $pdoSt->execute();
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function delete($id)
    {
        try {
            // plantilla
            $sql = " 
                   DELETE FROM clientes WHERE id=:id;";

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

    public function getCliente($id)
    {
        try {
            $sql = " 
                    SELECT     
                    id,
                    apellidos,
                    nombre,
                    telefono,
                    ciudad,
                    dni,
                    email
                
                    FROM  clientes  where id=:id";

            $conexion = $this->db->connect();

            $result = $conexion->prepare($sql);

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

    public function update($id, $cliente)
    {
        try {
            // plantilla
            $sql = " UPDATE clientes
                    SET
                        apellidos=:apellidos,
                        nombre=:nombre,
                        telefono=:telefono,
                        ciudad=:ciudad,
                        dni=:dni,
                        email=:email,
                        update_at = now()
                    WHERE
                        id=:id";

            $conexion = $this->db->connect();

            $pdoSt = $conexion->prepare($sql);

            //Bindeamos parametros

            $pdoSt->bindParam(":nombre", $cliente->nombre, PDO::PARAM_STR, 30);
            $pdoSt->bindParam(":apellidos", $cliente->apellidos, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(":email", $cliente->email, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(":telefono", $cliente->telefono, PDO::PARAM_STR, 9);
            $pdoSt->bindParam(":ciudad", $cliente->ciudad, PDO::PARAM_STR, 30);
            $pdoSt->bindParam(":dni", $cliente->dni, PDO::PARAM_STR, 9);
            $pdoSt->bindParam(":id", $id, PDO::PARAM_INT);

            // ejecuto
            $pdoSt->execute();
        } catch (PDOException $error) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function order($criterio)
    {
        try {
            // plantilla
            $sql = "SELECT 
                        id,
                        apellidos,
                        nombre,
                        telefono,
                        ciudad,
                        dni,
                        email
                    FROM 
                        clientes order by $criterio";

            $conexion = $this->db->connect();

            $result = $conexion->prepare($sql);

            //Establez como quiero q devuelva el resultado 
            $result->setFetchMode(PDO::FETCH_OBJ);

            // ejecuto
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
            // plantilla
            $sql = "SELECT 
                        id,
                        apellidos,
                        nombre,
                        telefono,
                        ciudad,
                        dni,
                        email
                    FROM 
                        clientes 

                    WHERE 

                        concat_ws(' ',
                        id,
                        apellidos,
                        nombre,
                        telefono,
                        ciudad,
                        dni,
                        email)
                        like ? ";

            $expresion = "%" . $expresion . "%";

            $conexion = $this->db->connect();

            $result = $conexion->prepare($sql);

            $result->bindParam(1, $expresion, PDO::PARAM_STR);


            //Establez como quiero q devuelva el resultado 
            $result->setFetchMode(PDO::FETCH_OBJ);

            // ejecuto
            $result->execute();

            return $result;
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function validarDni($dni)
    {
        try {
            $sql = " 
                    SELECT     
                   
                    *
                
                    FROM  clientes  where dni=:dni";

            $conexion = $this->db->connect();

            $result = $conexion->prepare($sql);

            $result->bindParam(":dni", $dni, PDO::PARAM_STR);

          
            // ejecuto
            $result->execute();

            if ($result->rowCount() == 1)
                return false;
            return true;
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
                
                    FROM  clientes  where email=:email";

            $conexion = $this->db->connect();

            $result = $conexion->prepare($sql);

            $result->bindParam(":email", $email, PDO::PARAM_STR);

            
            // ejecuto
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
