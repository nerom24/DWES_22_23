<?php

    Class movimientosModel extends Model{

        // Extraer todas las cuentas
        public function getMovimientos($id){
            try {
                //Preparo la plantilla mediante string
                $sql = "
                    SELECT
                            m.id,
                            m.id_cuenta,
                            m.fecha_hora,
                            m.concepto,
                            m.tipo,
                            m.cantidad,
                            m.saldo,
                            c.num_cuenta as cuenta

                    FROM
                            movimientos as m join cuentas as c 
                            ON m.id_cuenta = c.id
                    WHERE 
                            id_cuenta = :id
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

                return $result;

            } catch (PDOException $e) {
                include_once("template/partials/errorDB.php");
                exit();
            }
        }

        public function readcuenta($id){

            try {
                //Preparo la plantilla mediante string
                $sql = "
                    SELECT 
                            id,
                            num_cuenta,
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

            } catch (PDOException $e) {
                include_once("template/partials/errorDB.php");
                exit();
            }

        }


        public function create(Movimiento $movimiento) {
                        
            try {

                    $sql = 

                    "INSERT INTO movimientos VALUES (
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

                    //conectar con la base de datos
                    $conexion = $this->db->connect();
                    //Ejecuto el metodo prepare PDO
                    $result = $conexion->prepare($sql);

                    $result->bindParam(':id_cuenta', $movimiento->id_cuenta, PDO::PARAM_INT);
                    $result->bindParam(':concepto', $movimiento->concepto, PDO::PARAM_STR, 50);
                    $result->bindParam(':tipo', $movimiento->tipo, PDO::PARAM_STR, 1);
                    $result->bindParam(':cantidad', $movimiento->cantidad);
                    $result->bindParam(':saldo', $movimiento->saldo);

                    $result -> execute();

            }
            catch(PDOException $e) {
                include_once("template/partials/errorDB.php");
                exit();
            }
        }
        
        public function update(Cuenta $cuenta , $id) {

            try {
                    $sql = "
                    UPDATE cuentas 
                    SET     
                            fecha_ul_mov = :fecha_ul_mov,
                            num_movtos = :num_movtos,
                            saldo = :saldo
                    WHERE
                            id = :id_cuenta
                    ";
                    
                    //conectar con la base de datos
                    $conexion = $this->db->connect();
                    //Ejecuto el metodo prepare PDO
                    $result = $conexion->prepare($sql);
                    
                    
                    $result->bindParam(':fecha_ul_mov', $cuenta->fecha_ul_mov);
                    $result->bindParam(':num_movtos', $cuenta->num_movtos, PDO::PARAM_INT);
                    $result->bindParam(':saldo', $cuenta->saldo);
                    $result->bindParam(':id_cuenta', $id, PDO::PARAM_INT);
                    $result -> execute();

            } catch(PDOException $e) {
                    include_once("template/partials/errorDB.php");
                    exit();
            }
        }


    }

?>