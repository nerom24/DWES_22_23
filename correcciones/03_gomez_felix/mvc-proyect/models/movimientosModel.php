<?php


class movimientosModel extends Model
{

    public function get($idCuenta)
    {
        try {
            // plantilla
            // id, id_cuenta, fecha_hora, concepto, tipo, cantidad, saldo

            $sql = " 
            SELECT 
                m.id,
                m.id_cuenta,
                m.fecha_hora,
                m.concepto,
                m.tipo,
                m.cantidad,
                m.saldo,
                cu.num_cuenta
            FROM 
                movimientos as m inner join cuentas as cu on m.id_cuenta=cu.id 
            WHERE
                cu.id=:id;";

            $conexion = $this->db->connect();

            $result = $conexion->prepare($sql);

            $result->bindParam(':id', $idCuenta);
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

    public function getCuenta($idCuenta)
    {
        try {
            // plantilla

            $sql = " 
            SELECT 
                
                cu.num_cuenta,
                cu.id_cliente,
                cu.saldo

            FROM 
                cuentas as cu  
            WHERE
                cu.id=:id;";

            $conexion = $this->db->connect();

            $result = $conexion->prepare($sql);

            $result->bindParam(':id', $idCuenta);
            //Establez como quiero q devuelva el resultado 

            $result->setFetchMode(PDO::FETCH_OBJ);

            // ejecuto
            $result->execute();

            return $result->fetch();
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function create($mov, $id,)
    {
        try {
            // plantilla 
            $sql =
                " INSERT INTO movimientos (id_cuenta,fecha_hora,concepto,tipo,cantidad) 
                    values( 
                        :id_cuenta,
                        :fecha_hora,
                        :concepto,
                        :tipo,
                        :cantidad
                        );
                    ";

            $conexion = $this->db->connect();
            $pdoSt = $conexion->prepare($sql);

            //Bindeamos parametros
            $pdoSt->bindParam(":id_cuenta", $mov->id_cuenta, PDO::PARAM_INT);
            $pdoSt->bindParam(":fecha_hora", $mov->fecha_hora);
            $pdoSt->bindParam(":concepto", $mov->concepto, PDO::PARAM_STR);
            $pdoSt->bindParam(":tipo", $mov->tipo, PDO::PARAM_STR);
            $pdoSt->bindParam(":cantidad", $mov->cantidad, PDO::PARAM_INT);

            $sql2 = " UPDATE cuentas 
                  set 
                    saldo=saldo + :cantidad,
                    num_movtos=num_movtos + 1,
                    fecha_ul_mov=now(),
                    update_at=now() 
                  where
                    id=:id";

            $pdoSt2 = $conexion->prepare($sql2);

            $pdoSt2->bindParam(":cantidad", $mov->cantidad, PDO::PARAM_INT);
            $pdoSt2->bindParam(":id", $id, PDO::PARAM_INT);

            $sql3 = " UPDATE movimientos 
                  set 
                    saldo=(select saldo from cuentas where id=$id)
                  where
                    id=(select id from movimientos order by id desc limit 1)";

            $pdoSt3 = $conexion->prepare($sql3);
            // $pdoSt3->bindParam(":id", $id, PDO::PARAM_INT);

            // ejecuto
            $pdoSt->execute();
            $pdoSt2->execute();
            $pdoSt3->execute();
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }
}
