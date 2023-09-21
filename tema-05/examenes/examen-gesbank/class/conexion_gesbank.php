<?php  

        class conexion_gesbank extends Conexion {

                # Obtener cuentas
                
                public function getCuentas() {

                        try {
                                $consultaSQL = "                             
                                SELECT 
                                        cue.id,
                                        cue.num_cuenta,
                                        cli.apellidos,
                                        cli.nombre,
                                        cue.fecha_alta,
                                        cue.fecha_ul_mov,
                                        cue.num_movtos,
                                        cue.saldo
                                
                                FROM cuentas AS cue
                                         JOIN clientes AS cli ON cue.id_cliente = cli.id
                                
                                         ORDER BY cue.id
                                ";

                                $result= $this->pdo->prepare($consultaSQL);

                                //$result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,'cuenta');
                                $result->setFetchMode(PDO::FETCH_OBJ);
                                $result -> execute();

                                return $result;

                        }
                        catch(PDOException $e) {
                                include_once('template/partials/error_conexion.php');
                                //exit(0);
                        }
                }


                # Obtener los movimientos de una cuenta

                public function getMovimientos($id_cuenta) {

                        try {
                                $consultaSQL = "
                                SELECT
                                        m.id,
                                        m.id_cuenta,
                                        m.fecha_hora,
                                        m.tipo,
                                        m.cantidad,
                                        m.saldo,
                                        c.num_cuenta as cuenta

                                FROM
                                        movimientos as m join cuentas as c 
                                        ON m.id_cuenta = c.id
                                WHERE 
                                        id_cuenta = :id_cuenta
                                ";

                                $result= $this->pdo->prepare($consultaSQL);
                                $result->bindParam(':id_cuenta', $id_cuenta, PDO::PARAM_INT);
                                $result->setFetchMode(PDO::FETCH_OBJ);
                                $result -> execute();

                                return $result;

                        }
                        catch(PDOException $e) {
                                include_once('template/partials/error_conexion.php');
                                exit(0);
                        }
                }

                # Obtener el registro correspondiente a una cuenta
                
                public function getCuenta($id_cuenta) {

                        try {
                                $consultaSQL = "
                                SELECT
                                       *  
                                FROM
                                        cuentas 
                                WHERE
                                        id = :id_cuenta
                                
                                LIMIT 1
                                ";

                                $result= $this->pdo->prepare($consultaSQL);
                                $result->bindParam(':id_cuenta', $id_cuenta, PDO::PARAM_INT);
                                $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,'cuenta');
                                $result -> execute();

                                return $result->fetch();

                        } catch(PDOException $e) {
                                include_once('template/partials/error_conexion.php');
                                exit(0);
                        }
                }

                # Añadir nuevo movimiento
                
                public function createMovimiento(Movimiento $movimiento) {
                        
                        try {

                                $insertSQL = 

                                "INSERT INTO movimientos VALUES (
                                        NULL,
                                        :id_cuenta,
                                        NULL,
                                        :tipo,
                                        :cantidad,
                                        :saldo
                                )";

                                $result= $this->pdo->prepare($insertSQL);

                                $result->bindParam(':id_cuenta', $movimiento->id_cuenta, PDO::PARAM_INT);
                                $result->bindParam(':tipo', $movimiento->tipo, PDO::PARAM_STR, 1);
                                $result->bindParam(':cantidad', $movimiento->cantidad);
                                $result->bindParam(':saldo', $movimiento->saldo);

                                $result -> execute();

                        }
                        catch(PDOException $e) {
                                include_once('template/partials/error_conexion.php');
                                exit(0);
                        }
                }

                # Actualizar cuenta
                
                public function actualizar_cuenta(Cuenta $cuenta) {

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
                                
                                $result= $this->pdo->prepare($updateSQL);
                                
                                
                                $result->bindParam(':fecha_ul_mov', $cuenta->fecha_ul_mov);
                                $result->bindParam(':num_movtos', $cuenta->num_movtos, PDO::PARAM_INT);
                                $result->bindParam(':saldo', $cuenta->saldo);
                                $result->bindParam(':id_cuenta', $cuenta->id, PDO::PARAM_INT);
                                $result -> execute();

                        }
                        catch(PDOException $e) {
                                include_once('template/partials/error_conexion.php');
                                exit(0);
                        }
                }

               

}
?>