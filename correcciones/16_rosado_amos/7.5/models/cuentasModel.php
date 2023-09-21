<?php


class cuentasModel extends Model
{

    public function get()
    {
        try {

            $sql = " 
            SELECT 
                c.id,
                c.num_cuenta,
                c.id_cliente,
                c.fecha_alta,
                c.fecha_ul_mov,
                c.num_movtos,
                c.saldo,
                cl.nombre, 
                cl.apellidos
            FROM 
                cuentas as c inner join clientes as cl on c.id_cliente=cl.id order by c.id;";

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

    public function create($cuenta)
    {
        try {

            $sql =
                " INSERT INTO cuentas (num_cuenta,id_cliente,fecha_alta,fecha_ul_mov,num_movtos,saldo) values( 
                    :num_cuenta,
                    :id_cliente,
                    :fecha_alta,
                    :fecha_ul_mov,
                    :num_movtos,
                    :saldo
                )";

            $conexion = $this->db->connect();
            $pdoSt = $conexion->prepare($sql);

            $pdoSt->bindParam(":num_cuenta", $cuenta->num_cuenta, PDO::PARAM_INT);
            $pdoSt->bindParam(":id_cliente", $cuenta->id_cliente, PDO::PARAM_INT);
            $pdoSt->bindParam(":fecha_alta", $cuenta->fecha_alta);
            $pdoSt->bindParam(":fecha_ul_mov", $cuenta->fecha_ul_mov);
            $pdoSt->bindParam(":num_movtos", $cuenta->num_movtos, PDO::PARAM_INT);
            $pdoSt->bindParam(":saldo", $cuenta->saldo, PDO::PARAM_INT);

            $pdoSt->execute();
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }


    public function getClientes()
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
            FROM 
                clientes;";

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


    public function delete($id)
    {
        try {

            $sql = " 
                   DELETE FROM cuentas WHERE id=:id;";

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
    public function getCuenta($id)
    {
        try {

            $sql = " 
            SELECT 
                c.id,
                c.num_cuenta,
                c.id_cliente,
                c.fecha_alta,
                c.fecha_ul_mov,
                c.num_movtos,
                c.saldo
            FROM 
                cuentas as c where id=:id;";

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
    public function update($id, $cuenta)
    {
        try {

            $sql = " UPDATE cuentas
                    SET
                    num_cuenta=:num_cuenta,
                    id_cliente=:id_cliente,
                    fecha_alta=:fecha_alta,
                    saldo=:saldo,
                    update_at = now()

                    WHERE
                        id=:id";

            $conexion = $this->db->connect();

            $pdoSt = $conexion->prepare($sql);


            $pdoSt->bindParam(":num_cuenta", $cuenta->num_cuenta, PDO::PARAM_STR, 30);
            $pdoSt->bindParam(":id_cliente", $cuenta->id_cliente, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(":fecha_alta", $cuenta->fecha_alta, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(":saldo", $cuenta->saldo, PDO::PARAM_STR, 9);
            $pdoSt->bindParam(":id", $id, PDO::PARAM_INT);

            $pdoSt->execute();
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function order($criterio)
    {
        try {

            $sql = " SELECT 
            c.id,
            c.num_cuenta,
            c.id_cliente,
            c.fecha_alta,
            c.fecha_ul_mov,
            c.num_movtos,
            c.saldo,
            cl.nombre, 
            cl.apellidos
        FROM 
            cuentas as c inner join clientes as cl on c.id_cliente=cl.id order by $criterio ";

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
                        c.id,
                        c.num_cuenta,
                        c.id_cliente,
                        c.fecha_alta,
                        c.fecha_ul_mov,
                        c.num_movtos,
                        c.saldo,
                        cl.nombre, 
                        cl.apellidos
                    FROM 
                        cuentas as c inner join clientes as cl on c.id_cliente=cl.id
                    WHERE 

                        concat_ws(' ',
                        c.num_cuenta,
                        c.id_cliente,
                        c.fecha_alta,
                        c.fecha_ul_mov,
                        c.num_movtos,
                        c.saldo,
                        cl.nombre,
                        cl.apellidos)
                        like ? ";

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


    public function validarNumCuenta($num_cuenta)
    {
        try {

            $sql = "SELECT 
                        *
                    FROM 
                        cuentas 
                        
                    WHERE 
                        num_cuenta = :num_cuenta ";


            $conexion = $this->db->connect();

            $result = $conexion->prepare($sql);
            $result->bindParam(":num_cuenta", $num_cuenta);

            $result->execute();

            if($result->rowCount()==1)
                return false;
            return true;
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }
    public function validarIdCliente($id_cliente)
    {
        try {

            $sql = "SELECT 
                        *
                    FROM 
                        clientes 
                        
                    WHERE 
                        id = :id_cliente";


            $conexion = $this->db->connect();

            $result = $conexion->prepare($sql);
            $result->bindParam(":id_cliente", $id_cliente, PDO::PARAM_STR);

            $result->setFetchMode(PDO::FETCH_OBJ);

            $result->execute();

            if($result->rowCount()==1)
                return true;
            return false;
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }
}
