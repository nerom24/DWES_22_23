<?php


class albumesModel extends Model {
    public function get(){
        try { $sql = " SELECT id,titulo,descripcion,autor,lugar,categoria,etiquetas,num_fotos,num_visitas,carpeta
            FROM albumes;";
            $conexion = $this->db->connect();
            $result = $conexion->prepare($sql);
            $result->setFetchMode(PDO::FETCH_OBJ);
            $result->execute();
            return $result;
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function create($album){
        try { $sql = " INSERT INTO albumes (
                    titulo,
                    descripcion,
                    autor,
                    fecha,
                    lugar,
                    categoria,
                    etiquetas,
                    num_fotos,
                    num_visitas,
                    carpeta
                    )values( 
                    :titulo,
                    :descripcion,
                    :autor,
                    :fecha,
                    :lugar,
                    :categoria,
                    :etiquetas,
                    0,
                    0,
                    :carpeta
                )";

            $conexion = $this->db->connect();
            $pdoSt = $conexion->prepare($sql);
            $pdoSt->bindParam(":titulo", $album->titulo, PDO::PARAM_STR, 30);
            $pdoSt->bindParam(":descripcion", $album->descripcion, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(":autor", $album->autor, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(":fecha", $album->fecha, PDO::PARAM_STR, 9);
            $pdoSt->bindParam(":lugar", $album->lugar, PDO::PARAM_STR, 30);
            $pdoSt->bindParam(":categoria", $album->categoria, PDO::PARAM_STR, 9);
            $pdoSt->bindParam(":etiquetas", $album->etiquetas, PDO::PARAM_STR, 20);
            $pdoSt->bindParam(":carpeta", $album->carpeta, PDO::PARAM_STR, 50);

            $pdoSt->execute();
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function delete($id){
        try {
            $sql = " 
                   DELETE FROM albumes WHERE id=:id;";
            $conexion = $this->db->connect();
            $result = $conexion->prepare($sql);
            $result->bindParam(":id", $id, PDO::PARAM_INT);
            $result->execute();
            return $result;
        } catch (PDOException $error) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function getAlbum($id){
        try {
            $sql = " 
                SELECT 
                    titulo,
                    descripcion,
                    autor,
                    fecha,
                    lugar,
                    categoria,
                    etiquetas,
                    num_fotos,
                    num_visitas,
                    carpeta
                FROM 
                    albumes 
                    where id=:id";
            $conexion = $this->db->connect();
            $result = $conexion->prepare($sql);
            $result->bindParam(":id", $id, PDO::PARAM_INT);
            $result->setFetchMode(PDO::FETCH_OBJ);
            $result->execute();
            return $result->fetch();
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function update($id, $album){
        try {
            $sql = " UPDATE albumes SET titulo=:titulo,descripcion=:descripcion,autor=:autor,fecha=:fecha,lugar=:lugar,categoria=:categoria,etiquetas=:etiquetas,carpeta=:carpeta,update_at = now()
                    WHERE id=:id";
            $conexion = $this->db->connect();
            $pdoSt = $conexion->prepare($sql);
            $pdoSt->bindParam(":id", $id, PDO::PARAM_INT);
            $pdoSt->bindParam(":titulo", $album->titulo, PDO::PARAM_STR, 30);
            $pdoSt->bindParam(":descripcion", $album->descripcion, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(":autor", $album->autor, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(":fecha", $album->fecha, PDO::PARAM_STR, 9);
            $pdoSt->bindParam(":lugar", $album->lugar, PDO::PARAM_STR, 30);
            $pdoSt->bindParam(":categoria", $album->categoria, PDO::PARAM_STR, 9);
            $pdoSt->bindParam(":etiquetas", $album->etiquetas, PDO::PARAM_STR, 20);
            $pdoSt->bindParam(":carpeta", $album->carpeta, PDO::PARAM_STR, 50);
            $pdoSt->execute();
        } catch (PDOException $error) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function order($criterio){
        try {
            $sql = "SELECT id,titulo,lugar,categoria,etiquetas,num_fotos,num_visitas
            FROM albumes order by $criterio";
            $conexion = $this->db->connect();
            $result = $conexion->prepare($sql);
            $result->setFetchMode(PDO::FETCH_OBJ);
            $result->execute();
            return $result;
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function filter($expresion){
        try { $sql = "SELECT 
                        id,
                        titulo,
                        lugar,
                        categoria,
                        etiquetas,
                        num_fotos,
                        num_visitas
                    FROM 
                        albumes 
                    WHERE 
                        concat_ws(' ',
                        id,
                        titulo,
                        lugar,
                        categoria,
                        etiquetas,
                        num_fotos,
                        num_visitas)
                        like ? ";
            $expresion = "%" . $expresion . "%";
            $conexion = $this->db->connect();
            $result = $conexion->prepare($sql);
            $result->bindParam(1, $expresion, PDO::PARAM_STR);
            $result->setFetchMode(PDO::FETCH_OBJ);
            $result->execute();
            return $result;
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function upload($carpeta, $fichero) {
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
        $errores = [];
        if (($fichero['error']) !== UPLOAD_ERR_OK) {
           $errores[] = $phpFileUploadErrors[$fichero['error']];
        } elseif (is_uploaded_file($fichero['tmp_name'])) {
           $allowedTypes = array("image/jpeg", "image/gif", "image/png");
           $detectedType = mime_content_type($fichero['tmp_name']);
           if (!in_array($detectedType, $allowedTypes)) {
              $errores[] = "Solo se permiten archivos JPG, GIF y PNG.";
           }
           $maxFileSize = 4 * 1024 * 1024; 
           if ($fichero['size'] > $maxFileSize) {
              $errores[] = "Límite permitido de 4 MB.";
           }
        }
        
        if (empty($errores)) {
           move_uploaded_file($fichero['tmp_name'], 'images/'.$carpeta.'/'.$fichero['name']);
           $_SESSION['mensaje'] = 'El archivo se ha subido correctamente';
           header("location:" .URL. "albumes");
        } else {
           $_SESSION['errores'] = $errores;
           header("location:" .URL. "albumes");
        }
    }

    public function increaseAlbumViews($albumID) {
        try {
            $sql = "UPDATE albumes SET num_visitas = num_visitas + 1 WHERE id = :albumID";
            $dbConnection = $this->db->connect();
            $statement = $dbConnection->prepare($sql);
            $statement->bindParam(":albumID", $albumID, PDO::PARAM_INT);
            $statement->execute();
        } catch (PDOException $error) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }
    

    public function updateAlbumNumPhotos($albumID, $numVistaContador) {
        try {
            $sql = "UPDATE albumes SET num_fotos = :num_fotos WHERE id = :id";
            $dbConnection = $this->db->connect();
            $statement = $dbConnection->prepare($sql);
            $statement->bindParam(":id", $albumID, PDO::PARAM_INT);
            $statement->bindParam(":num_fotos", $numVistaContador, PDO::PARAM_INT);
            $statement->execute();
        } catch (PDOException $error) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }
    
}
?>