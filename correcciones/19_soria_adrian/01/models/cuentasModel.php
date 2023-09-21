<?php

    Class cuentasModel extends Model{

        // Extraer todas las cuentas
        public function get(){
            try {
                //Preparo la plantilla mediante string
                $sql = "
                        SELECT 
                            cue.id,
                            cue.num_cuenta,
                            cli.apellidos,
                            cli.nombre,
                            cue.fecha_alta,
                            cue.fecha_ul_mov,
                            cue.num_movtos,
                            cue.saldo,
                            cue.create_at,
                            cue.update_at
                
                        FROM cuentas AS cue
                            JOIN clientes AS cli ON cue.id_cliente = cli.id
                
                        ORDER BY cue.id
                ";

                //conectar con la base de datos
                $conexion = $this->db->connect();

                //Ejecuto el metodo prepare PDO
                $result = $conexion->prepare($sql);

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

        public function getClientes(){
            try {
                //Preparo la plantilla mediante string
                $sql = "
                        SELECT
                            id,
                            apellidos,
                            nombre
                        from
                            clientes

                ";

                //conectar con la base de datos
                $conexion = $this->db->connect();

                //Ejecuto el metodo prepare PDO
                $result = $conexion->prepare($sql);

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

        public function create( $cuenta){
            

            try {
                //Preparo la plantilla mediante string
                $sql = "
                    INSERT INTO cuentas  (
                        num_cuenta,
                        id_cliente,
                        fecha_alta,
                        fecha_ul_mov,
                        num_movtos,
                        saldo,
                        create_at,
                        update_at
                    )
                    VALUES (
                        :num_cuenta,
                        :id_cliente,
                        :fecha_alta,
                        :fecha_ul_mov,
                        :num_movtos,
                        :saldo,
                        :create_at,
                        :update_at
                    )
                ";
                
                 //conectar con la base de datos
                 $conexion = $this->db->connect();

                //Ejecuto el metodo prepare PDO
                $pdoST = $conexion->prepare($sql);

                
                
                
                $pdoST->bindParam(':num_cuenta', $cuenta->num_cuenta, PDO::PARAM_STR,20);
                $pdoST->bindParam(':id_cliente', $cuenta->id_cliente, PDO::PARAM_STR,10);
                $pdoST->bindParam(':fecha_alta', $cuenta->fecha_alta);
                $pdoST->bindParam(':fecha_ul_mov', $cuenta->fecha_ul_mov);
                $pdoST->bindParam(':num_movtos', $cuenta->num_movtos, PDO::PARAM_STR,10);
                $pdoST->bindParam(':saldo', $cuenta->saldo, PDO::PARAM_STR,15);
                $pdoST->bindParam(':create_at', $cuenta->create_at);
                $pdoST->bindParam(':update_at', $cuenta->update_at);
                
                //Ejecuto
                $pdoST->execute();
                return $pdoST->fetchAll();

            } catch (PDOException $error) {
                include_once("template/partials/errorDB.php");
                exit();
            }

        }
        public function readcuenta($id){

            try {
                //Preparo la plantilla mediante string
                $sql = "
                    SELECT 
                            cue.id,
                            cue.num_cuenta,
                            cue.id_cliente,
                            cli.apellidos,
                            cli.nombre,
                            cue.fecha_alta,
                            cue.fecha_ul_mov,
                            cue.num_movtos,
                            cue.saldo,
                            cue.create_at,
                            cue.update_at
        
                    FROM cuentas AS cue
                            JOIN clientes AS cli ON cli.id = cue.id_cliente

                    WHERE
                            cue.id = :id  
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

            } catch (PDOException $error) {
                include_once("template/partials/errorDB.php");
                exit();
            }

        }

        public function update($cuenta, $id){

            try {
                //Preparo la plantilla mediante string
                $sql = "
                    UPDATE cuentas  
                    SET 
                        num_cuenta = :num_cuenta,
                        id_cliente = :id_cliente,
                        fecha_alta = :fecha_alta,
                        fecha_ul_mov = :fecha_ul_mov,
                        num_movtos = :num_movtos,
                        saldo = :saldo,
                        update_at = now()
                    WHERE
                        id = :id   
                    
                ";

                
                $conexion = $this->db->connect();
                //Ejecuto el metodo prepare PDO
                $pdoST = $conexion->prepare($sql);

                $pdoST->bindParam(':id', $id, PDO::PARAM_INT);
                $pdoST->bindParam(':num_cuenta', $cuenta->num_cuenta, PDO::PARAM_STR,20);
                $pdoST->bindParam(':id_cliente', $cuenta->id_cliente, PDO::PARAM_STR,10);
                $pdoST->bindParam(':fecha_alta', $cuenta->fecha_alta);
                $pdoST->bindParam(':fecha_ul_mov', $cuenta->fecha_ul_mov);
                $pdoST->bindParam(':num_movtos', $cuenta->num_movtos, PDO::PARAM_STR,10);
                $pdoST->bindParam(':saldo', $cuenta->saldo, PDO::PARAM_STR,15);

                //Ejecuto
                $pdoST->execute();

            } catch (PDOException $error) {
                include_once("template/partials/errorDB.php");
                exit();
            }

        }

        public function delete($id){

            try {
                //Preparo la plantilla mediante string
                $sql = "
                    DELETE from cuentas  
                    WHERE  id = :id limit 1   
                ";
                $conexion = $this->db->connect();
                //Ejecuto el metodo prepare PDO
                $pdoST = $conexion->prepare($sql);

                $pdoST->bindParam(':id', $id, PDO::PARAM_INT);

                //Ejecuto
                $pdoST->execute();


            } catch (PDOException $e) {
                include_once("template/partials/errorDB.php");
                exit();
            }

        }

        public function order($criterio) {
            try {
                $sql = "select 
                            cue.id,
                            cue.num_cuenta,
                            cue.id_cliente,
                            cli.apellidos,
                            cli.nombre,
                            cue.fecha_alta,
                            cue.fecha_ul_mov,
                            cue.num_movtos,
                            cue.saldo
                
                        from cuentas AS cue
                        JOIN clientes AS cli ON cue.id_cliente = cli.id

                        order by $criterio
                        ";
                $conexion = $this->db->connect();
                $pdoSt = $conexion->prepare($sql);
                $pdoSt->setFetchMode(PDO::FETCH_OBJ);
                $pdoSt->execute();
                return $pdoSt;
            }catch (PDOException $error) {
                include_once("template/partials/errorDB.php");
                exit();
            }
        }

        public function filter($expresion) {
            try {
                $sql = "
                    select 
                            cue.id,
                            cue.num_cuenta,
                            cue.id_cliente,
                            cli.apellidos,
                            cli.nombre,
                            cue.fecha_alta,
                            cue.fecha_ul_mov,
                            cue.num_movtos,
                            cue.saldo
                
                            from cuentas AS cue
                            JOIN clientes AS cli ON cue.id_cliente = cli.id

                    where 
                        CONCAT_WS (', ',
                            cue.id,
                            cue.num_cuenta,
                            cue.id_cliente,
                            cli.apellidos,
                            cli.nombre,
                            cue.fecha_alta,
                            cue.fecha_ul_mov,
                            cue.num_movtos,
                            cue.saldo)

                        like :expresion
                ";
                $conexion = $this->db->connect();
                $pdoSt = $conexion->prepare($sql);
                $pdoSt->bindValue(':expresion', '%'.$expresion.'%', PDO::PARAM_STR);
                $pdoSt->setFetchMode(PDO::FETCH_OBJ);
                $pdoSt->execute();
                return $pdoSt;
            }catch (PDOException $error) {
                include_once("views/partials/errorDB.php");
                exit();
            }
        }

        public function validarCliente($id) {
            try {
                $sql = "
                    SELECT * FROM clientes
                    WHERE id = :id
                ";
                $conexion = $this->db->connect();
                $pdoSt = $conexion->prepare($sql);
                $pdoSt->bindValue(':id', $id, PDO::PARAM_STR);
                $pdoSt->setFetchMode(PDO::FETCH_OBJ);
                $pdoSt->execute();

                if ($pdoSt->rowCount() == 1){
                    return TRUE;
                }
                return FALSE;
                
            }catch (PDOException $error) {
                include_once("template/partials/errorDB.php");
                exit();
            }

        }

        public function validarCuenta($cuenta) {
            try {
                $sql = "
                    SELECT * FROM cuentas
                    WHERE num_cuenta = :cuenta
                ";
                $conexion = $this->db->connect();
                $pdoSt = $conexion->prepare($sql);
                $pdoSt->bindValue(':cuenta', $cuenta, PDO::PARAM_STR);
                $pdoSt->setFetchMode(PDO::FETCH_OBJ);
                $pdoSt->execute();

                if ($pdoSt->rowCount() == 1){
                    return TRUE;
                }
                return FALSE;
                
            }catch (PDOException $error) {
                include_once("template/partials/errorDB.php");
                exit();
            }
        }
    }

?>