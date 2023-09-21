<?php  
        // clase con las propiedades (atributos) que tiene la tabla
	class Conexion{

                protected $pdo;
        
	public function __construct(){
                try{

                        
                        $host = 'localhost';
                        $dbname= 'gesbank';
                        $user= "root";
                        $password= "";
                        //juego de caracteres
                        $charset ='utf8mb4';
                        //coleccion
                        $collate='utf8mb4_unicode_ci';
                        $dsn ="mysql:host=$host; dbname=$dbname; charset=$charset";

                        $options=[
                                PDO::ATTR_ERRMODE => PDO:: ERRMODE_EXCEPTION,
                                PDO::ATTR_PERSISTENT =>  false,
                                PDO::ATTR_EMULATE_PREPARES =>  false,
                                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset COLLATE $collate"
                        ];

                        $this->pdo = new PDO ($dsn, $user, $password, $options);
                }catch(PDOException $e){
                        include_once('template/partials/error_conexion.php');
                        exit(0);
                }
        }
}
?>