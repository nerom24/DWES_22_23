<?php


class albumesModel extends Model
{

    public function get()
    {
        try {
            // plantilla
            $sql = " 
            SELECT 
                id,
                titulo,
                lugar,
                categoria,
                etiquetas,
                num_fotos,
                num_visitas
            FROM 
                albumes;";

            $conexion = $this->db->connect();

            $result = $conexion->prepare($sql);
            //Establez como quiero q devuelva el resultado 

            $result->setFetchMode(PDO::FETCH_OBJ);

            // ejecuto
            $result->execute();

            return $result;
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function create($album)
    {
        try {
            // plantilla
            $sql = " INSERT INTO albumes 
             values( 
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
                    default,
                    default

                )";

            $conexion = $this->db->connect();
            $pdoSt = $conexion->prepare($sql);

            //Bindeamos parametros
            $pdoSt->bindParam(":titulo", $album->titulo, PDO::PARAM_STR, 30);
            $pdoSt->bindParam(":descripcion", $album->descripcion, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(":autor", $album->autor, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(":fecha", $album->fecha, PDO::PARAM_STR, 9);
            $pdoSt->bindParam(":lugar", $album->lugar, PDO::PARAM_STR, 30);
            $pdoSt->bindParam(":categoria", $album->categoria, PDO::PARAM_STR, 9);
            $pdoSt->bindParam(":etiquetas", $album->etiquetas, PDO::PARAM_STR, 9);
            $pdoSt->bindParam(":carpeta", $album->carpeta, PDO::PARAM_STR, 9);

            // ejecuto
            $pdoSt->execute();

            mkdir("images/" . $album->carpeta);
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function delete($id)
    {
        try {
            // plantilla
            $sql = " 
                   DELETE FROM albumes WHERE id=:id;";

            $conexion = $this->db->connect();


            $result = $conexion->prepare($sql);

            $result->bindParam(":id", $id, PDO::PARAM_INT);

            // ejecuto
            $result->execute();

            return $result;
        } catch (PDOException $error) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function getAlbum($id)
    {
        try {
            $sql = " 
            SELECT 
            id,
            titulo,
            descripcion,
            autor,
            fecha,
            carpeta,
            lugar,
            categoria,
            etiquetas,
            num_fotos,
            num_visitas
        FROM 
            albumes  where id=:id";

            $conexion = $this->db->connect();

            $result = $conexion->prepare($sql);

            $result->bindParam(":id", $id, PDO::PARAM_INT);

            //Establez como quiero q devuelva el resultado 

            $result->setFetchMode(PDO::FETCH_OBJ);

            // ejecuto
            $result->execute();

            return $result->fetch();
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function update($id, $album)
    {
        try {
            // plantilla
            $sql = " UPDATE albumes
                    SET
                        titulo=:titulo,
                        descripcion=:descripcion,
                        autor=:autor,
                        fecha=:fecha,
                        lugar=:lugar,
                        categoria=:categoria,
                        etiquetas=:etiquetas,
                        carpeta=:carpeta
                    WHERE
                        id=:id";

            $conexion = $this->db->connect();

            $pdoSt = $conexion->prepare($sql);

            //Bindeamos parametros

            $pdoSt->bindParam(":titulo", $album->titulo, PDO::PARAM_STR, 100);
            $pdoSt->bindParam(":descripcion", $album->descripcion, PDO::PARAM_STR);
            $pdoSt->bindParam(":autor", $album->autor, PDO::PARAM_STR);
            $pdoSt->bindParam(":fecha", $album->fecha, PDO::PARAM_STR);
            $pdoSt->bindParam(":lugar", $album->lugar, PDO::PARAM_STR);
            $pdoSt->bindParam(":categoria", $album->categoria, PDO::PARAM_STR);
            $pdoSt->bindParam(":etiquetas", $album->etiquetas, PDO::PARAM_STR);
            $pdoSt->bindParam(":carpeta", $album->carpeta, PDO::PARAM_STR);
            $pdoSt->bindParam(":id", $id, PDO::PARAM_INT);


            // ejecuto
            $pdoSt->execute();
        } catch (PDOException $error) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }


    public function order($criterio)
    {
        try {
            // plantilla
            $sql = "SELECT 
                        id,
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
                        albumes order by $criterio";

            $conexion = $this->db->connect();

            $result = $conexion->prepare($sql);

            // $result->bindParam(":criterio", $criterio, PDO::PARAM_STR);

            //Establez como quiero q devuelva el resultado 
            $result->setFetchMode(PDO::FETCH_OBJ);

            // ejecuto
            $result->execute();

            return $result;
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }


    public function filter($expresion)
    {
        try {
            // plantilla
            $sql = "SELECT 
                        id,
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
                    WHERE 

                        concat_ws(' ',
                        id,
                        titulo,
                        descripcion,
                        autor,
                        fecha,
                        lugar,
                        categoria,
                        etiquetas,
                        num_fotos,
                        num_visitas,
                        carpeta)
                        like ? ";

            $expresion = "%" . $expresion . "%";

            $conexion = $this->db->connect();

            $result = $conexion->prepare($sql);

            $result->bindParam(1, $expresion, PDO::PARAM_STR);


            //Establez como quiero q devuelva el resultado 
            $result->setFetchMode(PDO::FETCH_OBJ);

            // ejecuto
            $result->execute();

            return $result;
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function upload($carpeta, $fichero) {
        
        # Sanemaiento
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
        
        # Validacion
        $errores = [];
     
        if (($fichero['error']) !== UPLOAD_ERR_OK) {
           $errores[] = $phpFileUploadErrors[$fichero['error']];
        } elseif (is_uploaded_file($fichero['tmp_name'])) {
           # Validamos el tipo de archivo
           $allowedTypes = array("image/jpeg", "image/gif", "image/png");
           $detectedType = mime_content_type($fichero['tmp_name']);
           if (!in_array($detectedType, $allowedTypes)) {
              $errores[] = "Tipo de archivo no permitido. Solo se permiten archivos JPG, JPGE, GIF y PNG.";
           }
           
           # Validamos el tamaño del archivo
           $maxFileSize = 4 * 1024 * 1024; // 4MB
           if ($fichero['size'] > $maxFileSize) {
              $errores[] = "El tamaño del archivo excede el límite permitido de 4 MB.";
           }
        }
        
        if (empty($errores)) {
           #Mover Archivo de la carpeta temporal a la carpeta del servidor
           move_uploaded_file($fichero['tmp_name'], 'images/'.$carpeta.'/'.$fichero['name']);
           
           $_SESSION['mensaje'] = 'El archivo se ha subido correctamente';
           header("location:" .URL. "albumes");
        } else {
           $_SESSION['errores'] = $errores;
           header("location:" .URL. "albumes");
        }
    }

    public function updateFotos($id, $num_fotos)
    {
        try {

            $sql = " 
                    UPDATE albumes SET
                        num_fotos=:num_fotos
                    WHERE
                        id=:id";

            $conexion = $this->db->connect();

            $pdoSt = $conexion->prepare($sql);


            $pdoSt->bindParam(":id", $id, PDO::PARAM_INT);
            $pdoSt->bindParam(":num_fotos", $num_fotos, PDO::PARAM_STR, 20);

            $pdoSt->execute();
        } catch (PDOException $error) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }
}
