<?php
    Class movimientosModel extends Model{

        # Extraer todos los movimientos
        public function get($id){
            try {
                $sql = "
                    select 
                        mo.id,
                        mo.id_cuenta,
                        mo.fecha_hora,
                        mo.concepto, 
                        mo.tipo,
                        mo.cantidad,
                        mo.saldo,
                        cu.num_cuenta as cuenta
                    from 
                        movimientos as mo inner join cuentas as cu
                        ON mo.id_cuenta = cu.id
                    where 
                        id_cuenta = :id
                ";

                # Conectar la base de datos
                $conexion= $this->db->connect();

                # Ejecutamos mediante prepare la consulta SQL
                $pdoSt = $conexion->prepare($sql);

                $pdoSt->bindParam(':id', $id, PDO::PARAM_INT);

                # Establezco como quiero que devuelva el pdoStado
                $pdoSt->setFetchMode(PDO::FETCH_OBJ);

                # Ejecuto
                $pdoSt->execute();

                return $pdoSt;

            } catch (PDOException $e) {
                include_once("template/partials/errorDB.php");
                exit();
            }
        }

        public function readcuenta($id){
            try {
                $sql = "
                        SELECT 
                            id,
                            num_cuenta as cuenta,
                            id_cliente,
                            fecha_alta,
                            fecha_ul_mov,
                            num_movtos,
                            saldo,
                            create_at,
                            update_at

                        FROM cuentas 

                        WHERE
                                id = :id  
                ";

                # Conectar la base de datos
                $conexion= $this->db->connect();

                # Ejecutamos mediante prepare la consulta SQL
                $pdoSt = $conexion->prepare($sql);

                $pdoSt->bindParam(':id', $id, PDO::PARAM_INT);

                $pdoSt->setFetchMode(PDO::FETCH_OBJ);
                
                $pdoSt->execute();

                return $pdoSt->fetch();

            } catch (PDOException $e) {
                include_once("template/partials/errorDB.php");
                exit();
            }
        }

        public function create(Movimiento $movimiento){
            try {
                $sql = "
                       
                    INSERT INTO movimientos VALUES (
                        NULL,
                        :id_cuenta,
                        NULL,
                        :concepto,
                        :tipo,
                        :cantidad,
                        :saldo,
                        null,
                        null
                )";

                # Conectar la base de datos
                $conexion= $this->db->connect();

                # Ejecutamos mediante prepare la consulta SQL
                $pdoSt = $conexion->prepare($sql);

                $pdoSt->bindParam(':id_cuenta', $movimiento->id_cuenta, PDO::PARAM_INT);
                $pdoSt->bindParam(':concepto', $movimiento->concepto, PDO::PARAM_STR, 50);
                $pdoSt->bindParam(':tipo', $movimiento->tipo, PDO::PARAM_STR, 1);
                $pdoSt->bindParam(':cantidad', $movimiento->cantidad);
                $pdoSt->bindParam(':saldo', $movimiento->saldo);
                
                $pdoSt->execute();
                return $pdoSt->fetchAll();
                
            } catch (PDOException $e) {
                include_once("template/partials/errorDB.php");
                exit();
            }
        }

        public function update_Cuenta(Cuenta $cuenta, $id) {
            

            try {
                    $updateSQL = "
                    UPDATE cuentas 
                    SET     
                            fecha_ul_mov = :fecha_ul_mov,
                            num_movtos = :num_movtos,
                            saldo = :saldo
                    WHERE
                            id = :id_cuenta
                    ";
                    
                    $conexion= $this->db->connect();

                    $result = $conexion->prepare($updateSQL);

                    
                    //$result->bindParam(':id', $id, PDO::PARAM_INT);
                    $result->bindParam(':fecha_ul_mov', $cuenta->fecha_ul_mov);
                    $result->bindParam(':num_movtos', $cuenta->num_movtos, PDO::PARAM_INT);
                    $result->bindParam(':saldo', $cuenta->saldo);
                    $result->bindParam(':id_cuenta', $id, PDO::PARAM_INT);
                    $result -> execute();

            }catch (PDOException $e) {
                include_once("template/partials/errorDB.php");
                exit();
            }
        }

    }
?>