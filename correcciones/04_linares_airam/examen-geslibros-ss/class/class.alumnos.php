<?php

/*
    Clase alumnos de van a definir todas las acciones con la tabla alumnos:

    - select - extraer todos los alumnos
    - insert 
    - update
    - delete
    - read
*/

class Libros extends Conexion {

    public function getLibros() {

        try {
            # Plantilla
            $sql = "
            
            SELECT l.id,
                   l.titulo,
                   l.isbn,
                   l.fecha_edicion,
                   a.nombre autor,
                   e.nombre editorial,
                   l.stock,
                   l.precio_coste,
                   l.precio_venta
            FROM libros as l inner join autores as a
                 ON l.autor_id = a.id 
                 inner join editoriales as e
                 on l.editorial_id = e.id

            ";
            # ejecutar PREPARE
            $result = $this->pdo->prepare($sql);

            # establezco com quiero que devuelva el resultado
            $result->setFetchMode(PDO::FETCH_OBJ);

            # ejecuto
            $result->execute();

            return $result;


        } catch (PDOException $error){

            include_once('views/partials/errorDB.php');
            exit();
            
        }

    }

    public function getCursos () {

        try {
            # Plantilla
            $sql = "
            
            SELECT 
                    id,
                    nombre autor
            FROM 
                    autores

            ";
            # ejecutar PREPARE
            $result = $this->pdo->prepare($sql);

            # establezco com quiero que devuelva el resultado
            $result->setFetchMode(PDO::FETCH_OBJ);

            # ejecuto
            $result->execute();

            return $result;


        } catch (PDOException $error){

            include_once('views/partials/errorDB.php');
            exit();
            
        }

    }

    public function getEditoriales () {

        try {
            # Plantilla
            $sql = "
            
            SELECT 
                    id,
                    nombre editorial
            FROM 
                    editoriales

            ";
            # ejecutar PREPARE
            $result = $this->pdo->prepare($sql);

            # establezco com quiero que devuelva el resultado
            $result->setFetchMode(PDO::FETCH_OBJ);

            # ejecuto
            $result->execute();

            return $result;


        } catch (PDOException $error){

            include_once('views/partials/errorDB.php');
            exit();
            
        }

    }

    public function create(Libro $libro) {

        try {

            $sql = "
                INSERT INTO libros (
                    titulo,
                    isbn,
                    autor_id,
                    editorial_id,
                    stock,
                    precio_coste,
                    precio_venta,
                    fecha_edicion
                )
                VALUES (
                    :titulo,
                    :isbn,
                    :autor_id,
                    :editorial_id,
                    :stock,
                    :precio_coste,
                    :precio_venta,
                    :fecha_edicion
                )
        ";

        $pdoSt = $this->pdo->prepare($sql);

        $pdoSt->bindParam(':titulo', $libro->titulo, PDO::PARAM_STR, 30);
        $pdoSt->bindParam(':isbn', $libro->isbn, PDO::PARAM_STR, 50);
        $pdoSt->bindParam(':autor_id', $libro->autor_id, PDO::PARAM_INT);
        $pdoSt->bindParam(':editorial_id', $libro->editorial_id, PDO::PARAM_INT);
        $pdoSt->bindParam(':stock', $libro->stock, PDO::PARAM_STR, 9);
        $pdoSt->bindParam(':precio_coste', $libro->precio_coste, PDO::PARAM_INT);
        $pdoSt->bindParam(':precio_venta', $libro->precio_venta, PDO::PARAM_INT);
        $pdoSt->bindParam(':fecha_edicion', $libro->fecha_edicion);

        $pdoSt->execute();

    }  catch (PDOException $error) {
        include_once('views/partials/errorDB.php');
        exit();
    }

        
}

public function readLibro($id) {

    try {
        $sql ="
                SELECT 
                    id,
                    titulo,
                    isbn,
                    autor_id,
                    editorial_id,
                    stock,
                    precio_coste,
                    precio_venta
                FROM 
                        libros
                WHERE
                        id = :id
        ";

        $pdoSt = $this->pdo->prepare($sql);

        $pdoSt->bindParam(':id', $id, PDO::PARAM_INT);
        $pdoSt->setFetchMode(PDO::FETCH_OBJ);
        $pdoSt->execute();
        
        return $pdoSt->fetch();

    } catch (PDOException $error) {
        include_once('views/partials/errorDB.php');
        exit();
    }

}

public function update(Libro $libro, $id) {

    try {
            $sql = "
            
            UPDATE libros
            SET
                    titulo = :titulo,
                    isbn = :isbn,
                    autor_id = :autor_id,
                    editorial_id = :editorial_id,
                    stock = :stock,
                    precio_coste = :precio_coste,
                    precio_venta = :precio_venta,
                    fecha_edicion = :fecha_edicion,
            WHERE
                    id = :id
            LIMIT 1
            ";
            
            $pdoSt = $this->pdo->prepare($sql);

            $pdoSt->bindParam(':id', $id, PDO::PARAM_INT);

            $pdoSt->bindParam(':titulo', $libro->titulo, PDO::PARAM_STR, 30);
            $pdoSt->bindParam(':isbn', $libro->isbn, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(':autor_id', $libro->autor_id, PDO::PARAM_INT);
            $pdoSt->bindParam(':editorial_id', $libro->editorial_id, PDO::PARAM_INT);
            $pdoSt->bindParam(':stock', $libro->stock, PDO::PARAM_STR, 9);
            $pdoSt->bindParam(':precio_coste', $libro->precio_coste, PDO::PARAM_INT);
            $pdoSt->bindParam(':precio_venta', $libro->precio_venta, PDO::PARAM_INT);
            $pdoSt->bindParam(':fecha_edicion', $libro->fecha_edicion);

            $pdoSt->execute();

    }
    catch(PDOException $error) {
        include_once('views/partials/errorDB.php');
        exit(0);
    }
}

public function delete($id) {

    try {
        $sql = "DELETE FROM libros WHERE id = :id limit 1";
        $pdoSt = $this->pdo->prepare($sql);			          
        $pdoSt->bindParam(':id', $id, PDO::PARAM_INT);
        $pdoSt->execute();
    } 

    catch (PDOException $error) {	

        include_once('views/partials/errorDB.php');
        exit(0);
    }

}

public function order($criterio) {

    try {
            $sql = "
            
            SELECT a.id,
                   a.nombre,
                   a.apellidos,
                   a.email,
                   a.poblacion,
                   a.fechaNac,
                   c.nombreCorto curso
            FROM alumnos as a inner join cursos as c
                 ON a.id_curso = c.id

            order by $criterio
            
            ";
    
            $pdoSt = $this->pdo->prepare($sql);
            // $pdoSt->bindParam(':criterio', $criterio, PDO::PARAM_INT);
            $pdoSt->setFetchMode(PDO::FETCH_OBJ);
            $pdoSt->execute();
            return $pdoSt;
    } 

    catch (PDOException $error) {	

            include('views/partials/errordb.php');
            exit();
    } 

}

public function filtrar($expresion) {

    try {
            $sql = "
            
            SELECT a.id,
                   a.nombre,
                   a.apellidos,
                   a.email,
                   a.poblacion,
                   a.fechaNac,
                   c.nombreCorto curso
            FROM alumnos as a inner join cursos as c
                 ON a.id_curso = c.id
            WHERE 
                    CONCAT_WS(', ', 
                              a.id,
                              a.nombre,
                              a.apellidos,
                              a.poblacion,
                              TIMESTAMPDIFF(YEAR, a.fechaNac, now()),
                              c.nombreCorto) 
                    like :expresion
            ";
    
            $pdoSt = $this->pdo->prepare($sql);
            $pdoSt->bindValue(':expresion', '%'.$expresion.'%', PDO::PARAM_STR);
            $pdoSt->setFetchMode(PDO::FETCH_OBJ);
            $pdoSt->execute();
            return $pdoSt;
    } 

    catch (PDOException $error) {	

            include('views/partials/errordb.php');
            exit();
    } 

}









}

?>