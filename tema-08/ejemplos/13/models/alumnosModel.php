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



?>