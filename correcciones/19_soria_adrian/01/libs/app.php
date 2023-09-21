<?php



class App {

    function __construct() {

              
        # El primer elemento de la url es el controlador
        # El segundo es el método del controlador
        # El resto me imagino que son parámetros del método
        
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        # Si no se introduce ningún controlador en la barra de direcciones
        # cargará el controlador Main.php
        # Si se introduce index también cargará el controlador Main

        if ((empty($url[0])) || ($url[0]=='index')) {

            $archivoController = 'controllers/main.php';
            require_once $archivoController;
            $controller = new Main();
            $controller->loadModel('main');
            $controller->render();
            return false;
        }
        
        $archivoController = 'controllers/' . $url[0] . '.php';
        
        # Carga el controlador sólo si existe el archivo

        if (file_exists($archivoController)) {

            require_once $archivoController;
            $controller = new $url[0];
            $controller->loadModel($url[0]);

            # obtengo el número de elementos de la dirección
            $nparam = sizeof($url);

            if ($nparam > 1) {

                if ($nparam>2) {

                    $param = [];
                    for ($i=2; $i<$nparam; $i++) {
                        $param[]=$url[$i];
                    }
                    $controller->{$url[1]}($param);
                } else {
                    $controller->{$url[1]}();
                }
            } else {

                $controller->render();
            }


        } else {

            require_once 'controllers/error.php';
            $controller = new Errores();
        }

    }
}

?>