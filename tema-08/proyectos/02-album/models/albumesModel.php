<?php 

    Class albumesModel extends Model{
        
        /* En esta nuevas version no hace falta por que coje el constructor del padre
        public function __construct()
        {
            parent::__construct();
        }
        */

        //Extaer todos los albumes de la base de datos.

        public function get(){
                try{
                                    
                        $sql = "SELECT 
                                        *
                                FROM
                                        albumes
                                ORDER BY
                                        albumes.id
                                ";
                    
                    $conexion = $this->db->connect();

                    $pdoSt = $conexion->prepare($sql);
                    //Forma de clase
                    $pdoSt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Album');
                    //Forma de objeto
                    //$pdoSt->setFetchMode(PDO::FETCH_OBJ);
                    //Forma asociativa
                    //$pdoSt->setFetchMode(PDO::FETCH_ASSOC);
                    $pdoSt->execute();
                    return $pdoSt;
                    
                    
            }catch(PDOException $e){

                    include "template/partials/errordb.php";
                    // Para cortar la conexión.
                    exit();

            }

            }

        public function create(Album $album){
                try{
                                
                        $sql = "INSERT INTO 
                                albumes 
                               VALUES (
                                        null,
                                        :titulo,
                                        :descripcion,
                                        :autor, 
                                        :fecha,
                                        :lugar,
                                        :categoria,
                                        :etiquetas,
                                        0,
                                        0,
                                        :carpeta,
                                        null,
                                        null
                                        )
                                ";
                        $conexion = $this->db->connect();

                        $pdoSt = $conexion->prepare($sql);
                        $pdoSt->bindParam(':titulo', $album->titulo , PDO::PARAM_STR, 100);
                        $pdoSt->bindParam(':descripcion', $album->descripcion , PDO::PARAM_STR);
                        $pdoSt->bindParam(':autor', $album->autor, PDO::PARAM_STR, 50);
                        $pdoSt->bindParam(':fecha', $album->fecha);
                        $pdoSt->bindParam(':lugar', $album->lugar, PDO::PARAM_STR, 50);
                        $pdoSt->bindParam(':categoria', $album->categoria, PDO::PARAM_STR, 50);
                        $pdoSt->bindParam(':etiquetas', $album->etiquetas, PDO::PARAM_STR, 250);
                        $pdoSt->bindParam(':carpeta', $album->carpeta, PDO::PARAM_STR, 50);
                        $pdoSt->execute();

                }catch(PDOException $e){

                        include "template/partials/errordb.php";
                        // Para cortar la conexión.
                        exit();

                }

        }

        public function read($id){
                try{
                                    
                        $sql = "SELECT *

                                FROM albumes
                                WHERE id = :id 
                                LIMIT 1
                                ";
                        
                        $conexion = $this->db->connect();
    
                        $pdoSt = $conexion->prepare($sql);
                        $pdoSt->bindParam(':id', $id , PDO::PARAM_INT);
                        //Forma de clase
                        $pdoSt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Album');
                        //Forma de objeto
                        //$pdoSt->setFetchMode(PDO::FETCH_OBJ);
                        //Forma asociativa
                        //$pdoSt->setFetchMode(PDO::FETCH_ASSOC);
                        $pdoSt->execute();
                        return $pdoSt->fetch();
                        
                        
                }catch(PDOException $e){
    
                        include "template/partials/errordb.php";
                        // Para cortar la conexión.
                        exit();
    
                }
        }
        public function update(Album $album, int $id){
                try{
                                
                        $sql = "UPDATE albumes 
                        SET
                                titulo = :titulo,
                                descripcion = :descripcion,
                                autor = :autor, 
                                fecha = :fecha,
                                lugar = :lugar,
                                categoria = :categoria,
                                etiquetas = :etiquetas,

                                carpeta = :carpeta


                        WHERE id = :id
                        LIMIT 1";

                        $conexion = $this->db->connect();

                        $pdoSt = $conexion->prepare($sql);
                        $pdoSt->bindParam(':id', $id , PDO::PARAM_INT);
                        $pdoSt->bindParam(':titulo', $album->titulo , PDO::PARAM_STR, 100);
                        $pdoSt->bindParam(':descripcion', $album->descripcion , PDO::PARAM_STR);
                        $pdoSt->bindParam(':autor', $album->autor, PDO::PARAM_STR, 50);
                        $pdoSt->bindParam(':fecha', $album->fecha);
                        $pdoSt->bindParam(':lugar', $album->lugar, PDO::PARAM_STR, 50);
                        $pdoSt->bindParam(':categoria', $album->categoria, PDO::PARAM_STR, 50);
                        $pdoSt->bindParam(':etiquetas', $album->etiquetas, PDO::PARAM_STR, 250);
                        $pdoSt->bindParam(':carpeta', $album->carpeta, PDO::PARAM_STR, 50);
                        //Forma de clase
                        //$pdoSt->setFetchMode(PDO::FETCH_CLASS, 'Album');
                        //Forma de objeto
                        //$pdoSt->setFetchMode(PDO::FETCH_OBJ);
                        //Forma asociativa
                        //$pdoSt->setFetchMode(PDO::FETCH_ASSOC);
                        $pdoSt->execute();

                }catch(PDOException $e){

                        include "template/partials/errordb.php";
                        // Para cortar la conexión.
                        exit();

                }

        }

        public function delete($id){
                try{
                                
                        $sql = "DELETE
                        FROM albumes
                        WHERE id = :id
                        LIMIT 1";

                        $conexion = $this->db->connect();

                        $pdoSt = $conexion->prepare($sql);
                        $pdoSt->bindParam(':id', $id , PDO::PARAM_INT);
                        //Forma de clase
                        //$pdoSt->setFetchMode(PDO::FETCH_CLASS, 'Album');
                        //Forma de objeto
                        //$pdoSt->setFetchMode(PDO::FETCH_OBJ);
                        //Forma asociativa
                        //$pdoSt->setFetchMode(PDO::FETCH_ASSOC);
                        $pdoSt->execute();

                }catch(PDOException $e){

                        include "template/partials/errordb.php";
                        // Para cortar la conexión.
                        exit();

                }
        }
        public function orderAlbumes(int $criterio){

                try{
                        
                        
                        $sql = "SELECT 
                                        albumes.id,
                                        albumes.titulo,
                                        albumes.lugar,
                                        albumes.fecha,
                                        albumes.categoria,
                                        albumes.etiquetas,
                                        albumes.num_fotos,
                                        albumes.num_visitas,
                                        albumes.carpeta
        
                                FROM albumes

                                ORDER BY :criterio ASC";

                        $conexion = $this->db->connect();

                        $pdoSt = $conexion->prepare($sql);
                        $pdoSt->bindParam(':criterio', $criterio , PDO::PARAM_INT);
                        //Forma de clase
                        $pdoSt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Album');
                        //Forma de objeto
                        //$pdoSt->setFetchMode(PDO::FETCH_OBJ);
                        //Forma asociativa
                        //$pdoSt->setFetchMode(PDO::FETCH_ASSOC);
                        $pdoSt->execute();
                        return $pdoSt;

                }catch(PDOException $e){

                        include "template/partials/errordb.php";
                        // Para cortar la conexión.
                        exit();

                }
        }

        public function filter($busqueda){

                try{
                        
                        $sql = "SELECT 
                                        albumes.id,
                                        albumes.titulo,
                                        albumes.lugar,
                                        albumes.fecha,
                                        albumes.categoria,
                                        albumes.etiquetas,
                                        albumes.num_fotos,
                                        albumes.num_visitas,
                                        albumes.carpeta
                
                        FROM albumes

                        WHERE 
                                CONCAT_WS(
                                        albumes.id,
                                        albumes.titulo,
                                        albumes.lugar,
                                        albumes.fecha,
                                        albumes.categoria,
                                        albumes.etiquetas,
                                        albumes.num_fotos,
                                        albumes.num_visitas,
                                        albumes.carpeta
                                        )
                                LIKE :busqueda
                        ";

                        $conexion = $this->db->connect();

                        $pdoSt = $conexion->prepare($sql);
                        //Forma de clase
                        $pdoSt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Album');
                        $pdoSt->bindValue(':busqueda', '%'. $busqueda .'%' , PDO::PARAM_STR);
                        //Forma de objeto
                        //$pdoSt->setFetchMode(PDO::FETCH_OBJ);
                        //Forma asociativa
                        //$pdoSt->setFetchMode(PDO::FETCH_ASSOC);
                        $pdoSt->execute();
                        return $pdoSt;

                }catch(PDOException $e){

                        include "template/partials/errordb.php";
                        // Para cortar la conexión.
                        exit();

                }
        }
        # Subir Archivos al directorio actual
	public function subirArchivo($archivos, $carpeta){

		$num = count($archivos['tmp_name']);

		//Comprobamos antes si ha ocurrido algún errorde archivo
		$phpFileUploadErrors = array(
			0 => 'There is no error, the file uploaded with success',
			1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
			2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
			3 => 'The uploaded file was only partially uploaded',
			4 => 'No file was uploaded',
			6 => 'Missing a temporary folder',
			7 => 'Failed to write file to disk.',
			8 => 'A PHP extension stopped the file upload.',
		);
		
		$error = null;

		for($i = 0; $i <= $num -1 && is_null($error); $i++){
			if($archivos['error'][$i] != UPLOAD_ERR_OK){
				$error = $phpFileUploadErrors[$archivos['error'][$i]];
			}else{
                                //Validar tamaño máximo 4mb
                                $max_file = 4194304;
                                if($archivos['size'][$i] > $max_file){

                                        //Errores de tipo error
                                        $error = "Archivo excede tamaño maximo 4MB";

                                }
                                $info = new SplFileInfo($archivos['name'][$i]);
                                $tipos_permitidos = ['JPEG' , 'JPG', 'GIF', 'PNG'];
                                if(!in_array(strtoupper($info->getExtension()), $tipos_permitidos)){
                                        $error = "Tipo archivo no permitido. Sólo JPG, JPEG, GIF o PNG";
                                }
                        }
		}

		//Sólo se procederá a la subida de archivos en caso de no ocurrir ningun error
		if(is_null($error)){
			for($i = 0; $i <= $num -1; $i++){
				if(is_uploaded_file($archivos['tmp_name'][$i])){
					move_uploaded_file($archivos['tmp_name'][$i],"images/".$carpeta."/".$archivos['name'][$i]);
				}
			}
			$_SESSION['mensaje'] = "Archivo/s subido/s con éxito";
		}else{
			$_SESSION['error'] = $error;
		}

                
	}
        public function contadorFotos($id, $contador){

                try{
                                
                        $sql = "UPDATE albumes 
                        SET
                                num_fotos = :num_fotos 
                        WHERE id = :id
                        LIMIT 1";

                        $conexion = $this->db->connect();

                        $pdoSt = $conexion->prepare($sql);
                        $pdoSt->bindParam(':id', $id , PDO::PARAM_INT);
                        $pdoSt->bindParam(':num_fotos', $contador, PDO::PARAM_INT);
                        //Forma de clase
                        //$pdoSt->setFetchMode(PDO::FETCH_CLASS, 'Album');
                        //Forma de objeto
                        //$pdoSt->setFetchMode(PDO::FETCH_OBJ);
                        //Forma asociativa
                        //$pdoSt->setFetchMode(PDO::FETCH_ASSOC);
                        $pdoSt->execute();

                }catch(PDOException $e){

                        include "template/partials/errordb.php";
                        // Para cortar la conexión.
                        exit();

                }

        }

        public function contadorVisitas($id){
                try{
                                
                        $sql = "UPDATE albumes 
                        SET
                                num_visitas = num_visitas + 1
                        WHERE id = :id
                        LIMIT 1";

                        $conexion = $this->db->connect();

                        $pdoSt = $conexion->prepare($sql);
                        $pdoSt->bindParam(':id', $id , PDO::PARAM_INT);;
                        //Forma de clase
                        //$pdoSt->setFetchMode(PDO::FETCH_CLASS, 'Album');
                        //Forma de objeto
                        //$pdoSt->setFetchMode(PDO::FETCH_OBJ);
                        //Forma asociativa
                        //$pdoSt->setFetchMode(PDO::FETCH_ASSOC);
                        $pdoSt->execute();

                }catch(PDOException $e){

                        include "template/partials/errordb.php";
                        // Para cortar la conexión.
                        exit();

                }

        }

        public function validarFecha(string $fecha){
                $valores = explode('-', $fecha);
                if(count($valores) == 3 && checkdate($valores[1],$valores[2],$valores[0])){
                        return TRUE;
                }
                return FALSE;
        }
    }



?>