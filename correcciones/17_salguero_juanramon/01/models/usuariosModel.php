<?php 

    class UsuariosModel extends Model{

        #Extraer todos los usuarios
        public function get () {
            try {
                $sql = "
                
                SELECT 
                    u.id,
                    u.name,
                    u.email,
                    u.password,
                    rl.name rol
                FROM users as u inner join roles_users as rlu
                    ON u.id = rlu.user_id 
                inner join roles as rl
                    ON rl.id = rlu.role_id
                ORDER BY u.id
                
                ";

                #Conectar con la base de datos

                $conexion = $this->db->connect();

                #Ejecutamos mediante prepare la sentencia SQL

                $result = $conexion->prepare($sql);

                #Establezco como quiero que devuelva el resultado
                $result->setFetchMode(PDO::FETCH_OBJ);

                #Ejecuto
                $result->execute();

                return $result;

            } catch (PDOException $e) {

                include_once("template/partials/errorDB.php");
                exit();
                
            }
        }

        # Extraer los roles 
        public function getRoles() {

            try {
                # Plantilla
                $sql = "
                
                    SELECT 
                            rl.id,
                            rl.name rol
                    FROM roles as rl 


                ";

                # Conectar con la base de datos
                $conexion = $this->db->connect();

                # ejecutar PREPARE
                $result = $conexion->prepare($sql);

                # establezco com quiero que devuelva el resultado
                $result->setFetchMode(PDO::FETCH_OBJ);

                # ejecuto
                $result->execute();

                return $result;


            } catch (PDOException $e){

                include_once('template/partials/errorDB.php');
                exit();
                
            }


        }


        function create (Usuario $usuario, $password) {

            try {

                $password_encriptado = password_hash($password, CRYPT_BLOWFISH);

                // plantilla
                $sql = " INSERT INTO users values( 
                        null,
                        :name,
                        :email,
                        :password,
                        default,
                        default
                    )";

                #Conectar con la base de datos
                $conexion = $this->db->connect();

                $result = $conexion->prepare($sql);

                //Bindeamos parametros
                $result->bindParam(":name", $usuario->name, PDO::PARAM_STR,30);
                $result->bindParam(":email", $usuario->email, PDO::PARAM_STR,50);
                $result->bindParam(":password", $usuario->password, PDO::PARAM_STR,9);

                // ejecuto
                $result->execute();

                $sql ="INSERT INTO roles_users VALUES (
                    null,
                    :user_id,
                    :role_id,
                    default,
                    default)";
                
                $conexion = $this->db->connect();

                # Obtener id del último usuario insertado
                $ultimo_id = $pdo->lastInsertId();

                $result = $conexion->prepare($sql);

                //Bindeamos parametros
                $result->bindParam(":user_id", $ultimo_id);
                $result->bindParam(":rol", $usuario->rol, PDO::PARAM_STR,30);

                // ejecuto
                $result->execute();
                
            } catch (PDOException $e) {

                    require_once("template/partials/errorDB.php");
                    exit();

            }
        }

        function read( $id)
        {

            try {
                // plantilla
                $sql = " SELECT 
                            u.id,
                            u.name,
                            u.email,
                            u.password,
                            rl.name rol
                        FROM users as u inner join roles_users as rlu
                            ON u.id = rlu.user_id 
                        inner join roles as rl
                            ON rl.id = rlu.role_id
                        where u.id = :id;";

                $conexion = $this->db->connect();

                #Ejecutamos mediante prepare la sentencia SQL

                $result = $conexion->prepare($sql);

                //Bindeamos parametros
                $result->bindParam(":id", $id, PDO::PARAM_INT);
               

                //Establez como quiero q devuelva el resultado 
                $result->setFetchMode(PDO::FETCH_OBJ);

                // ejecuto
                $result->execute();
                // print_r($result);
                return $result->fetch();
            } catch (PDOException $e) {
                require_once("template/partials/errorDB.php");
                exit();
            }
        }
        
        public function update(Usuario $usuario, $id)
        {
            try {
                // plantilla
                $sql = " Update users   
                        SET 
                        name = :name,
                        email = :email,
                        password = :password
                        where id = :id;";
    
                $conexion = $this->db->connect();

                #Ejecutamos mediante prepare la sentencia SQL

                $result = $conexion->prepare($sql);
    
    
                $result->bindParam(":name", $usuario->name, PDO::PARAM_STR,30);
                $result->bindParam(":email", $usuario->email, PDO::PARAM_STR,50);
                $result->bindParam(":password", $usuario->password, PDO::PARAM_STR,9);
                $result->bindParam(":id", $id, PDO::PARAM_INT);

                // ejecuto
                $result->execute();

            } catch (PDOException $e) {
                require_once("template/partials/errorDB.php");
                exit();
            }
        }

        function deleteUusarios($id)
        {
            try {
                // plantilla
                $sql = "Delete from usuarios where id = :id;";

                $conexion = $this->db->connect();

                #Ejecutamos mediante prepare la sentencia SQL

                $result = $conexion->prepare($sql);

                $result->bindParam(":id", $id, PDO::PARAM_INT);

                // ejecuto
                $result->execute();
                // print_r($result);
            } catch (PDOException $e) {
                require_once("template/partials/errorDB.php");
                exit();
            }
        }

        function order($criterio)
        {
            try {
                // plantilla
                $sql = "
                        SELECT 
                        u.id,
                        u.name,
                        u.email,
                        u.password,
                        rl.name rol
                    FROM users as u inner join roles_users as rlu
                        ON u.id = rlu.user_id 
                    inner join roles as rl
                        ON rl.id = rlu.role_id
                    order by $criterio";


                $conexion = $this->db->connect();

                #Ejecutamos mediante prepare la sentencia SQL

                $result = $conexion->prepare($sql);

                // Si bindeo el parametro criterio y la sentencia
                // sql lo pongo como :criterio no se me ordena
                // $result->bindParam(":criterio", $criterio, PDO::PARAM_STR);

                //Establez como quiero q devuelva el resultado 
                $result->setFetchMode(PDO::FETCH_OBJ);

                // ejecuto
                $result->execute();
                // print_r($result);
                return $result;
            } catch (PDOException $e) {
                require_once("template/partials/errorDB.php");
                exit();
            }
        }

        function filtrar($expresion)
        {
            try {
                // plantilla
                $sql = "
                        SELECT 
                        u.id,
                        u.name,
                        u.email,
                        rl.name rol
                    FROM users as u inner join roles_users as rlu
                        ON u.id = rlu.user_id 
                    inner join roles as rl
                        ON rl.id = rlu.role_id
                    where 
                        u.id like ? or
                        u.name like ? or 
                        u.email like ? or
                        rl.rol like ? or ";

                $expresion = "%" . $expresion . "%";

                $conexion = $this->db->connect();

                #Ejecutamos mediante prepare la sentencia SQL

                $result = $conexion->prepare($sql);

                $result->bindParam(1, $expresion, PDO::PARAM_STR);
                $result->bindParam(2, $expresion, PDO::PARAM_STR);
                $result->bindParam(3, $expresion, PDO::PARAM_STR);
                $result->bindParam(4, $expresion, PDO::PARAM_STR);
                $result->bindParam(5, $expresion, PDO::PARAM_STR);
                $result->bindParam(6, $expresion, PDO::PARAM_STR);
                $result->bindParam(7, $expresion, PDO::PARAM_STR);
                $result->bindParam(8, $expresion, PDO::PARAM_STR);

                //Establez como quiero q devuelva el resultado 
                $result->setFetchMode(PDO::FETCH_OBJ);

                // ejecuto
                $result->execute();
                // print_r($result);
                return $result;
            } catch (PDOException $e) {
                require_once("template/partials/errorDB.php");
                exit();
            }

        }

        // Creamos la funcion para validar el email/correo.
        public function validarEmail ($email) {

            try {
                $sql = "
                
                    select * from users 
                    where email = :email
                
                ";

                #Conectar con la base de datos

                $conexion = $this->db->connect();

                #Ejecutamos mediante prepare la sentencia SQL

                $result = $conexion->prepare($sql);

                $result->bindParam(':email', $email, PDO::PARAM_STR);

                #Ejecuto
                $result->execute();

                if ($result->rowCount() == 1)
                    return false;
                return true;

            } catch (PDOException $e) {
                include_once("template/partials/errorDB.php");
                exit();
            }
        }

        public function validarPass($pass) {
            if ((strlen($pass) < 5) || (strlen($pass) > 50)) {
                return false;
            }
            return true;
        }

        public function validarPerfil($rol) {

            try {
                $sql = "
                        SELECT * FROM roles
                        WHERE id = :rol
                ";
    
                # Conectamos con la base de datos
                $conexion = $this->db->connect();
        
                # Ejecutamos mediante prepare la consulta SQL
                $result= $conexion->prepare($sql);
                $result->bindParam(':rol', $rol, PDO::PARAM_INT);
                $result -> execute();
    
                if ($result->rowCount() == 1) 
                        return TRUE;
                return FALSE;
    
            } catch(PDOException $e) {
                    include_once('template/partials/errorDB.php');
                    exit();
            }
    
        }
    }
?>