<?php

    Class clientesModel extends Model{

        // Extraer todos los clientes
        public function get(){
            try {
                //Preparo la plantilla mediante string
                $sql = "
                    SELECT id,
                           apellidos,
                           nombre,
                           telefono,
                           ciudad,
                           dni,
                           email,
                           create_at,
                           update_at
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


        public function create(Cliente $cliente){

            try {
                //Preparo la plantilla mediante string
                $sql = "
                    INSERT INTO clientes  (
                        apellidos,
                        nombre,
                        telefono,
                        ciudad,
                        dni,
                        email,
                        create_at,
                        update_at
                    )
                    VALUES (
                        :apellidos,
                        :nombre,
                        :telefono,
                        :ciudad,
                        :dni,
                        :email,
                        :create_at,
                        :update_at
                    )
                ";

                 //conectar con la base de datos
                 $conexion = $this->db->connect();

                //Ejecuto el metodo prepare PDO
                $pdoST = $conexion->prepare($sql);

                $pdoST->bindParam(':apellidos', $cliente->apellidos, PDO::PARAM_STR,45);
                $pdoST->bindParam(':nombre', $cliente->nombre, PDO::PARAM_STR,20);
                $pdoST->bindParam(':telefono', $cliente->telefono, PDO::PARAM_INT,9);
                $pdoST->bindParam(':ciudad', $cliente->ciudad, PDO::PARAM_STR,20);
                $pdoST->bindParam(':dni', $cliente->dni, PDO::PARAM_STR,9);
                $pdoST->bindParam(':email', $cliente->email, PDO::PARAM_STR,50);
                $pdoST->bindParam(':create_at', $cliente->create_at);
                $pdoST->bindParam(':update_at', $cliente->update_at);

                //Ejecuto
                $pdoST->execute();
                return $pdoST->fetchAll();

            } catch (PDOException $e) {
                include_once("template/partials/errorDB.php");
                exit();
            }

        }
        public function readcliente($id){

            try {
                //Preparo la plantilla mediante string
                $sql = "
                    SELECT
                            id,
                            apellidos,
                            nombre,
                            telefono,
                            ciudad,
                            dni,
                            email,
                            create_at,
                            update_at
                    FROM
                        clientes
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

            } catch (PDOException $error) {
                include_once("template/partials/errorDB.php");
                exit();
            }

        }

        public function update(cliente $cliente, $id){

            try {
                //Preparo la plantilla mediante string
                $sql = "
                    UPDATE clientes  
                    SET 
                        apellidos = :apellidos,
                        nombre = :nombre,
                        telefono = :telefono,
                        ciudad = :ciudad,
                        dni = :dni,
                        email = :email,
                        update_at = now()
                    WHERE
                        id = :id   
                    
                ";

                
                $conexion = $this->db->connect();
                //Ejecuto el metodo prepare PDO
                $pdoST = $conexion->prepare($sql);

                $pdoST->bindParam(':id', $id, PDO::PARAM_INT);
                $pdoST->bindParam(':apellidos', $cliente->apellidos, PDO::PARAM_STR,45);
                $pdoST->bindParam(':nombre', $cliente->nombre, PDO::PARAM_STR,20);
                $pdoST->bindParam(':telefono', $cliente->telefono, PDO::PARAM_INT,9);
                $pdoST->bindParam(':ciudad', $cliente->ciudad, PDO::PARAM_STR,20);
                $pdoST->bindParam(':dni', $cliente->dni, PDO::PARAM_STR,9);
                $pdoST->bindParam(':email', $cliente->email, PDO::PARAM_STR,50);
                //$pdoST->bindParam(':update_at', $cliente->update_at);

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
                    DELETE from clientes  
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
                            id,
                            apellidos,
                            nombre,
                            telefono,
                            ciudad,
                            dni,
                            email
                
                        from clientes 

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
                        id,
                        apellidos,
                        nombre,
                        telefono,
                        ciudad,
                        dni,
                        email
                
                    from clientes 

                    where 
                        CONCAT_WS (', ',
                            id,
                            apellidos,
                            nombre,
                            telefono,
                            ciudad,
                            dni,
                            email)

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

        public function validarEmail($email) {
            try {
                $sql = "
                    SELECT * FROM clientes
                    WHERE email = :email
                ";
                $conexion = $this->db->connect();
                $pdoSt = $conexion->prepare($sql);
                $pdoSt->bindValue(':email', $email, PDO::PARAM_STR);
                $pdoSt->setFetchMode(PDO::FETCH_OBJ);
                $pdoSt->execute();

                if ($pdoSt->rowCount() == 1){
                    return FALSE;
                }
                return TRUE;
                
            }catch (PDOException $error) {
                include_once("template/partials/errorDB.php");
                exit();
            }
        }

        public function validarDni($dni) {
            try {
                $sql = "
                    SELECT * FROM clientes
                    WHERE dni = :dni
                ";
                $conexion = $this->db->connect();
                $pdoSt = $conexion->prepare($sql);
                $pdoSt->bindValue(':dni', $dni, PDO::PARAM_STR);
                $pdoSt->setFetchMode(PDO::FETCH_OBJ);
                $pdoSt->execute();

                if ($pdoSt->rowCount() == 1){
                    return FALSE;
                }
                return TRUE;
                
            }catch (PDOException $error) {
                include_once("template/partials/errorDB.php");
                exit();
            }
        }


    }

?>