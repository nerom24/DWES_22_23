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
    public function añadirFoto($id, $num_fotos)
    {
        try {
            // plantilla
            $sql = " UPDATE albumes
                    SET
                        num_fotos= :num_fotos
                    WHERE
                        id=:id";

            $conexion = $this->db->connect();

            $pdoSt = $conexion->prepare($sql);

            //Bindeamos parametros

            $pdoSt->bindParam(":id", $id, PDO::PARAM_INT);
            $pdoSt->bindParam(":num_fotos", $num_fotos, PDO::PARAM_INT);

            // ejecuto
            $pdoSt->execute();
        } catch (PDOException $error) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }
    public function añadirVisita($id)
    {
        try {
            // plantilla
            $sql = " UPDATE albumes
                    SET
                        num_visitas= num_visitas+1
                    WHERE
                        id=:id";

            $conexion = $this->db->connect();

            $pdoSt = $conexion->prepare($sql);

            //Bindeamos parametros

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
                lugar,
                categoria,
                etiquetas,
                num_fotos,
                num_visitas
            FROM 
                albumes order by $criterio desc";

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

    public function mostrarAlbum($carpeta)
    {

        chdir("images");

        return scandir($carpeta, 1);
    }

    public function deleteCarpeta($carpeta)
    {
        chdir("images");
        $this->borrar_directorio($carpeta);
    }

    public function borrar_directorio($carpeta)
    {
        //si es un directorio lo abro
        if (is_dir($carpeta))
            $dir_handle = opendir($carpeta);
        //si no es un directorio devuelvo false para avisar de que ha habido un error
        if (!$dir_handle)
            return false;
        //recorro el contenido del directorio fichero a fichero
        while ($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                //si no es un directorio elemino el fichero con unlink()
                if (!is_dir($carpeta . "/" . $file))
                    unlink($carpeta . "/" . $file);
                else //si es un directorio hago la llamada recursiva con el nombre del directorio
                    $this->borrar_directorio($carpeta . '/' . $file);
            }
        }
        closedir($dir_handle);
        //elimino el directorio que ya he vaciado
        rmdir($carpeta);
        return true;
    }
}
