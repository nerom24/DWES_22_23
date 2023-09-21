<?php

   
        # Extraer todos los alumnos
        function get() {

                # Plantilla
                $sql = "
                
                    SELECT  
                            nombre,
                            apellidos,
                            email,
                            telefono,
                            dni,
                            fechaNac

                    FROM alumnos 
                    ORDER BY id
                ";
                
                # Conectar con la base de datos
                
                $host = HOST;
                $db = DB;
                $user = USER;
                $password = PASSWORD;
                $charset = CHARSET;

                $dbh = "mysql:host=".$host.";dbname=".$db;
                $charset = $charset;
                $opciones = [

                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => FALSE,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
                ];

                $pdo = new PDO($dbh, $user, $password, $opciones);
               

                # Ejecutamos mediante prepare la consulta SQL
                $result = $pdo->prepare($sql);
                $result->setFetchMode(PDO::FETCH_ASSOC);
                $result->execute();
               
                return  $result->fetchAll();

    }

    function insertar_csv($alumno) {


     
        # Conectar con la base de datos
        
        $host = HOST;
        $db = DB;
        $user = USER;
        $password = PASSWORD;
        $charset = CHARSET;

        $dbh = "mysql:host=".$host.";dbname=".$db;
        $charset = $charset;
        $opciones = [

            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => FALSE,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
        ];

        $pdo = new PDO($dbh, $user, $password, $opciones);
        

        $sql = "
                
        INSERT INTO alumnos
                (nombre,
                apellidos,
                email,
                telefono,
                dni,
                fechaNac) 
        VALUES (
                :nombre,
                :apellidos,
                :email,
                :telefono,
                :dni,
                :fechaNac
        )
        ";

        # Ejecutamos mediante prepare la consulta SQL
        $result = $pdo->prepare($sql);

        # Plantilla
        

        $result->bindParam(':nombre', $alumno[0], PDO::PARAM_STR, 30);
        $result->bindParam(':apellidos', $alumno[1], PDO::PARAM_STR, 50);
        $result->bindParam(':email', $alumno[2], PDO::PARAM_STR, 50);
        $result->bindParam(':telefono', $alumno[3], PDO::PARAM_STR, 9);
        $result->bindParam(':dni', $alumno[4], PDO::PARAM_STR, 9);
        $result->bindParam(':fechaNac', $alumno[5]);

        $result->execute();
    }

    

?>