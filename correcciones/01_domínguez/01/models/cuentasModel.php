<?php

    Class cuentasModel extends Model{

        # Extraer todos los cuentas
        public function get(){
            try {
                $sql = "
                    select 
                        cu.id,
                        cu.num_cuenta,
                        cl.apellidos,
                        cl.nombre, 
                        cu.fecha_alta,
                        cu.fecha_ul_mov,
                        cu.num_movtos,
                        cu.saldo,
                        cu.create_at,
                        cu.update_at
                    from 
                        cuentas as cu inner join clientes as cl
                        ON cu.id_cliente = cl.id
                    order by cu.id;
                ";

                # Conectar la base de datos
                $conexion= $this->db->connect();

                # Ejecutamos mediante prepare la consulta SQL
                $result = $conexion->prepare($sql);

                # Establezco como quiero que devuelva el resultado
                $result->setFetchMode(PDO::FETCH_OBJ);

                # Ejecuto
                $result->execute();

                return $result;

            } catch (PDOException $e) {
                include_once("template/partials/errorDB.php");
                exit();
            }
        }

        # Extraer los clientes
        public function getClientes(){
            try {
                $sql = "
                    select 
                        id,
                        apellidos,
                        nombre
                    from 
                        clientes
                ";
                
                # Conectar la base de datos
                $conexion= $this->db->connect();

                # Ejecutamos mediante prepare la consulta SQL
                $result = $conexion->prepare($sql);

                # Establezco como quiero que devuelva el resultado
                $result->setFetchMode(PDO::FETCH_OBJ);

                # Ejecuto
                $result->execute();

                return $result;

            } catch (PDOException $e) {
                include_once("template/partials/errorDB.php");
                exit();
            }
        }

        // public function getCliente($id) {
        //     try {
    
        //         $sql = "select 
        //                         id,
        //                         apellidos,
        //                         nombre
        //                     from 
        //                         clientes
        //                     where id = :id
        //                 ";
                
        //         # Conectar la base de datos
        //         $conexion= $this->db->connect();

        //         # Ejecutamos mediante prepare la consulta SQL
        //         $result = $conexion->prepare($sql);
        //         $result->bindParam(':id', $id, PDO::PARAM_INT);
        //         $result->setFetchMode(PDO::FETCH_OBJ);
        //         $result->execute();
        //         return $result->fetch()->cliente;
    
        //     } catch (PDOException $e) {
        //         include_once("template/partials/errorDB.php");
        //         exit();
        //     }
        // }

        public function create(Cuenta $cuenta){
            try {
                $sql = "
                        INSERT INTO Cuentas(
                            num_cuenta,
                            id_cliente,
                            fecha_alta,
                            saldo,
                            create_at,
                            update_at
                        )
                        VALUES (
                            :num_cuenta,
                            :id_cliente,
                            :fecha_alta,
                            :saldo,
                            :create_at,
                            :update_at
                        )
                ";

                # Conectar la base de datos
                $conexion= $this->db->connect();

                # Ejecutamos mediante prepare la consulta SQL
                $pdoSt = $conexion->prepare($sql);

                $pdoSt->bindParam(':num_cuenta', $cuenta->num_cuenta, PDO::PARAM_STR, 50);
                $pdoSt->bindParam(':id_cliente', $cuenta->id_cliente, PDO::PARAM_INT);
                $pdoSt->bindParam(':fecha_alta', $cuenta->fecha_alta);
                $pdoSt->bindParam(':saldo', $cuenta->saldo, PDO::PARAM_STR, 13);
                $pdoSt->bindParam(':create_at', $cuenta->create_at);
                $pdoSt->bindParam(':update_at', $cuenta->update_at);
                
                $pdoSt->execute();
                return $pdoSt->fetchAll();
                
            } catch (PDOException $e) {
                include_once("template/partials/errorDB.php");
                exit();
            }
        }

        public function readCuenta($id){
            try {
                $sql = "
                    select 
                        cu.id,
                        cu.num_cuenta,
                        cu.id_cliente,
                        cl.apellidos,
                        cl.nombre, 
                        cu.fecha_alta,
                        cu.fecha_ul_mov,
                        cu.num_movtos,
                        cu.saldo,
                        cu.create_at,
                        cu.update_at
                        from 
                        cuentas as cu inner join clientes as cl
                        ON cu.id_cliente = cl.id
                    where cu.id = :id;
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

        public function update($cuenta, $id){
            try {
                $sql = "
                
                UPDATE cuentas
                    SET
                        id_cliente = :id_cliente,
                        update_at = now()
                    WHERE
                        id = :id
                    LIMIT 1
                ";
                
                # Conectar la base de datos
                $conexion= $this->db->connect();

                # Ejecutamos mediante prepare la consulta SQL
                $pdoSt = $conexion->prepare($sql);

                $pdoSt->bindParam(':id', $id, PDO::PARAM_INT);

                //$pdoSt->bindParam(':num_cuenta', $cuenta->num_cuenta, PDO::PARAM_STR, 50);
                $pdoSt->bindParam(':id_cliente', $cuenta->id_cliente, PDO::PARAM_INT);
                //$pdoSt->bindParam(':saldo', $cuenta->saldo, PDO::PARAM_STR, 13);

                $pdoSt->execute();

            } catch (PDOException $e) {
                include_once("template/partials/errorDB.php");
                exit();
            }
        }

        public function delete($id) {
            try {
                $sql = "DELETE FROM cuentas WHERE id = :id limit 1";

                # Conectar la base de datos
                $conexion= $this->db->connect();

                # Ejecutamos mediante prepare la consulta SQL
                $pdoSt = $conexion->prepare($sql);
		          
                $pdoSt->bindParam(':id', $id, PDO::PARAM_INT);
                $pdoSt->execute();
            }catch (PDOException $e) {
                include_once("template/partials/errorDB.php");
                exit();
            }
        }

        public function order($criterio) {
            try {
                $sql = "
                    select 
                        cu.id,
                        cu.num_cuenta,
                        cl.apellidos,
                        cl.nombre, 
                        cu.fecha_alta,
                        cu.fecha_ul_mov,
                        cu.num_movtos,
                        cu.saldo,
                        cu.create_at,
                        cu.update_at
            
                    from 
                        cuentas as cu inner join clientes as cl
                        ON cu.id_cliente = cl.id

                    order by $criterio
                ";
        
                # Conectar la base de datos
                $conexion= $this->db->connect();

                # Ejecutamos mediante prepare la consulta SQL
                $pdoSt = $conexion->prepare($sql);
                $pdoSt->setFetchMode(PDO::FETCH_OBJ);
                $pdoSt->execute();
                return $pdoSt;
            }catch (PDOException $e) {
                include_once("template/partials/errorDB.php");
                exit();
            }
        }

        public function filter($expresion) {
            try {
                $sql = "
                    select 
                        cu.id,
                        cu.num_cuenta,
                        cl.apellidos,
                        cl.nombre, 
                        cu.fecha_alta,
                        cu.fecha_ul_mov,
                        cu.num_movtos,
                        cu.saldo,
                        cu.create_at,
                        cu.update_at
                
                    from 
                        cuentas as cu inner join clientes as cl
                        ON cu.id_cliente = cl.id

                    where 
                        CONCAT_WS(', ', 
                        cu.id,
                        cu.num_cuenta,
                        cl.apellidos,
                        cl.nombre, 
                        cu.fecha_alta,
                        cu.fecha_ul_mov,
                        cu.num_movtos,
                        cu.saldo,
                        cu.create_at,
                        cu.update_at)
                    like :expresion
                ";
        
                # Conectar la base de datos
                $conexion= $this->db->connect();

                # Ejecutamos mediante prepare la consulta SQL
                $pdoSt = $conexion->prepare($sql);
                $pdoSt->bindValue(':expresion', '%'.$expresion.'%', PDO::PARAM_STR);
                $pdoSt->setFetchMode(PDO::FETCH_OBJ);
                $pdoSt->execute();
                return $pdoSt;
            }catch (PDOException $e) {
                include_once("template/partials/errorDB.php");
                exit();
            }
        }

        public function validarCuenta($num_cuenta) {
            try {
                $sql = "
                    SELECT * FROM cuentas
                    WHERE num_cuenta = :num_cuenta
                ";
                $conexion = $this->db->connect();
                $pdoSt = $conexion->prepare($sql);
                $pdoSt->bindValue(':num_cuenta', $num_cuenta, PDO::PARAM_STR);
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

        public function validarIdcliente($id_cliente) {
            try {
                $sql = "
                    SELECT * FROM clientes
                    WHERE id = :id_cliente
                ";
                $conexion = $this->db->connect();
                $pdoSt = $conexion->prepare($sql);
                $pdoSt->bindValue(':id_cliente', $id_cliente,  PDO::PARAM_INT);
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