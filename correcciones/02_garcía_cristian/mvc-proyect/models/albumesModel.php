<?php


class albumesModel extends Model
{

    public function get()
    {
        try {
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
            $result->setFetchMode(PDO::FETCH_OBJ);
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
            $pdoSt->bindParam(":titulo", $album->titulo, PDO::PARAM_STR, 30);
            $pdoSt->bindParam(":descripcion", $album->descripcion, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(":autor", $album->autor, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(":fecha", $album->fecha, PDO::PARAM_STR, 9);
            $pdoSt->bindParam(":lugar", $album->lugar, PDO::PARAM_STR, 30);
            $pdoSt->bindParam(":categoria", $album->categoria, PDO::PARAM_STR, 9);
            $pdoSt->bindParam(":etiquetas", $album->etiquetas, PDO::PARAM_STR, 9);
            $pdoSt->bindParam(":carpeta", $album->carpeta, PDO::PARAM_STR, 9);
            $pdoSt->execute();

            mkdir("imagenes2/" . $album->carpeta);
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function delete($id)
    {
        try {
            $sql = " 
                   DELETE FROM albumes 
                   WHERE id=:id;";

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
            $result->setFetchMode(PDO::FETCH_OBJ);
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
            $sql = " 
                    UPDATE 
                        albumes
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
            $pdoSt->bindParam(":titulo", $album->titulo, PDO::PARAM_STR, 100);
            $pdoSt->bindParam(":descripcion", $album->descripcion, PDO::PARAM_STR);
            $pdoSt->bindParam(":autor", $album->autor, PDO::PARAM_STR);
            $pdoSt->bindParam(":fecha", $album->fecha, PDO::PARAM_STR);
            $pdoSt->bindParam(":lugar", $album->lugar, PDO::PARAM_STR);
            $pdoSt->bindParam(":categoria", $album->categoria, PDO::PARAM_STR);
            $pdoSt->bindParam(":etiquetas", $album->etiquetas, PDO::PARAM_STR);
            $pdoSt->bindParam(":carpeta", $album->carpeta, PDO::PARAM_STR);
            $pdoSt->bindParam(":id", $id, PDO::PARAM_INT);
            $pdoSt->execute();

        } catch (PDOException $error) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }
    public function añadirFoto($id)
    {
        try {
            $sql = " 
                    UPDATE 
                        albumes
                    SET
                        num_fotos= num_fotos+1
                    WHERE
                        id=:id";

            $conexion = $this->db->connect();

            $pdoSt = $conexion->prepare($sql);
            $pdoSt->bindParam(":id", $id, PDO::PARAM_INT);
            $pdoSt->execute();
        } catch (PDOException $error) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }
    public function añadirVisita($id)
    {
        try {
            $sql = "
                    UPDATE 
                        albumes
                    SET
                        num_visitas= num_visitas+1
                    WHERE
                        id=:id";

            $conexion = $this->db->connect();

            $pdoSt = $conexion->prepare($sql);
            $pdoSt->bindParam(":id", $id, PDO::PARAM_INT);
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
            $sql = "
                    SELECT 
                        id,
                        apellidos,
                        nombre,
                        telefono,
                        ciudad,
                        dni,
                        email
                    FROM 
                        clientes order by $criterio";

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

    public function filter($expresion)
    {
        try {
            // plantilla
            $sql = "
                    SELECT 
                        id,
                        apellidos,
                        nombre,
                        telefono,
                        ciudad,
                        dni,
                        email
                    FROM 
                        clientes 

                    WHERE 

                        concat_ws(' ',
                        id,
                        apellidos,
                        nombre,
                        telefono,
                        ciudad,
                        dni,
                        email)
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

    public function mostrarAlbum($carpeta)
    {
        chdir("imagenes2");
        return scandir($carpeta, 1);   
    }
}
