<?php

    class Albumes Extends Controller {

        function __construct() {

            parent ::__construct();
            
            
        }

        function render() {

            sec_session_start();

            if (isset($_SESSION['error'])){

                $this->view->error = $_SESSION['error'];

                unset($_SESSION['error']);

            }

            if (isset($_SESSION['mensaje'])){

                $this->view->mensaje = $_SESSION['mensaje'];

                unset($_SESSION['mensaje']);

            }

            // Capa autentificación
            if(!isset($_SESSION['id'])){

                header("location:" . URL . "login");

            }else if(!in_array($_SESSION['id_rol'], $GLOBALS['consultar'])){

                $_SESSION['error'] = "Operacion sin privilegios";
                 
                header("location:" . URL . "index");

            }

            //Actualizo el titulo de la página
            $this->view->title = "Albums - Albumes";
            
            //Obtener los datos de albums que se representan en la tabla principal
            $this->view->albumes = $this->model->get();
            
            //Mostrar la vista
            $this->view->render('albumes/main/index');
        }

        function nuevo(){

            sec_session_start();

            // Capa autentificación
            if(!isset($_SESSION['id'])){

                header("location:" . URL . "login");
                exit();

            }else if(!in_array($_SESSION['id_rol'], $GLOBALS['crear'])){

                $_SESSION['error'] = "Operacion sin privilegios";

                header("location:" . URL . "index");
                exit();

            }


            if (isset($_SESSION['mensaje'])){

                $this->view->mensaje = $_SESSION['mensaje'];

                unset($_SESSION['mensaje']);

            }

            //Album en blanco incializando los campos del formulario
            $this->view->album = new Album();


            //Si existe algún error
            if (isset($_SESSION['error'])){

                //Mensaje de error
                $this->view->error = $_SESSION['error'];
                unset($_SESSION['error']);
                
                //Varialbes de autorelleno formulario
                $this->view->album = unserialize($_SESSION['album']);
                unset($_SESSION['album']);

                //Tipo de error
                $this->view->erroresVal = $_SESSION['erroresVal'];
                unset($_SESSION['erroresVal']);


            }

            //Actualizo el titulo de la página
            $this->view->title = "Añadir - Album - Albumes";

            //Cargo la vista
            $this->view->render('albumes/nuevo/index');
        }

        function create(){


             //Iniciamos o continuamos con la sesión
             sec_session_start();

             if (isset($_SESSION['error'])){
 
                 $this->view->error = $_SESSION['error'];
 
                 unset($_SESSION['error']);
 
             }
 
             if (isset($_SESSION['mensaje'])){
 
                 $this->view->mensaje = $_SESSION['mensaje'];
 
                 unset($_SESSION['mensaje']);
 
             }
 
             // Capa autentificación
             if(!isset($_SESSION['id'])){
 
                 header("location:" . URL . "login");
 
                 exit();
 
             }else if(!in_array($_SESSION['id_rol'], $GLOBALS['crear'])){
 
                 $_SESSION['error'] = "Operacion sin privilegios";

                 header("location:" . URL . "index");
 
                 exit();
 
             }

            $album = new Album();

            //Saneamiento de los datos del formulario
            $album->titulo = filter_var($_POST['titulo'] ??='', FILTER_SANITIZE_STRING);
            $album->descripcion = filter_var($_POST['descripcion'] ??='', FILTER_SANITIZE_STRING);
            $album->autor = filter_var($_POST['autor'] ??='', FILTER_SANITIZE_STRING);
            $album->fecha = filter_var($_POST['fecha'] ??='', FILTER_SANITIZE_STRING);
            $album->lugar = filter_var($_POST['lugar'] ??='', FILTER_SANITIZE_STRING);
            $album->categoria = filter_var($_POST['categoria']  ??='', FILTER_SANITIZE_STRING);
            $album->etiquetas = filter_var($_POST['etiquetas'] ??='', FILTER_SANITIZE_STRING);
            $album->carpeta = filter_var($_POST['carpeta'] ??='', FILTER_SANITIZE_STRING);

            //Validación
            $erroresVal = [];

            //Aplicaremos las reglas de validación

            //Validar titulo
            if(empty($album->titulo)){
                $erroresVal['titulo'] = "Titulo no puede estar vacio";
            }else if (strlen($album->titulo) > 100){
                $erroresVal['titulo'] = "Titulo no puede superar mas de 100 caracteres";
            }

            //Validar descripción
            if(empty($album->descripcion)){
                $erroresVal['descripcion'] = "Descripción no puede estar vacio";
            }else if (strlen($album->descripcion) > 1000){
                $erroresVal['descripcion'] = "Descripcion no puede superar mas de 1000 caracteres";
            }

            //Validar autor
            if(empty($album->autor)){
                $erroresVal['autor'] = "Autor no puede estar vacio";
            }else if (strlen($album->autor) > 50){
                $erroresVal['autor'] = "Autor no puede superar mas de 50 caracteres";
            }

            //Validar fecha
            if(empty($album->fecha)){
                $erroresVal['fecha'] = "Fecha no puede estar vacio";
            }else if (!$this->model->validarFecha($album->fecha)){
                $erroresVal['fecha'] = "Fecha no valida";
            }

            //Validar lugar
            if(empty($album->lugar)){
                $erroresVal['lugar'] = "Lugar no puede estar vacio";
            }else if (strlen($album->lugar) > 50){
                $erroresVal['lugar'] = "Lugar no puede superar mas de 50 caracteres";
            }

            //Validar categoria
            if(empty($album->categoria)){
                $erroresVal['categoria'] = "Categoria no puede estar vacio";
            }else if (strlen($album->categoria) > 50){
                $erroresVal['categoria'] = "Categoria no puede superar mas de 50 caracteres";
            }

            //Validar carpeta
            if(empty($album->carpeta)){
                $erroresVal['carpeta'] = "Carpeta no puede estar vacio";
            }else if (strlen($album->carpeta) > 50){
                $erroresVal['carpeta'] = "Carpeta no puede superar mas de 50 caracteres";
            }


            if(!empty($erroresVal)){

                //Formulario no validado
                $_SESSION['album'] = Serialize($album);
                $_SESSION['error'] = "Fallo en la validación del formulario";
                $_SESSION['erroresVal'] = $erroresVal;
                //print_r($erroresVal);
                //exit;

                //Redireccionamos a nuevo album
                header('Location: ' . URL . 'albumes/nuevo');


            }else{

                $this->model->create($album);

                //Creamos el directorio con el nombre de la carpeta
                mkdir("images/" . $album->carpeta);
        
                $_SESSION['mensaje'] = "Album añadido correctamente, directorio: ". $album->carpeta ;

                header('Location: ' . URL . 'albumes');
            }
        }

        //Este metodo se activará a partir de la url albumes/editar/$param
        //Mostrará el formulario que permitirá añadir nuevo cliente en la tabla
        function editar($param){

            sec_session_start();

            if (isset($_SESSION['mensaje'])){

                $this->view->mensaje = $_SESSION['mensaje'];

                unset($_SESSION['mensaje']);

            }

            // Capa autentificación
            if(!isset($_SESSION['id'])){

                header("location:" . URL . "login");

                exit();

            }else if(!in_array($_SESSION['id_rol'], $GLOBALS['editar'])){

                $_SESSION['error'] = "Operacion sin privilegios";

                header("location:" . URL . "index");

                exit();

            }

            // Estraigo el id del album que voy a editar
            $this->view->id = htmlspecialchars($param[0]);

            // Actualizo el título de la página
            $this->view->title = "Editar Album - Albumes";

            // Obtengo objeto de la clase album
            $this->view->album = $this->model->read($this->view->id);

            //Si existe algún error
            if (isset($_SESSION['error'])){

                //Mensaje de error
                $this->view->error = $_SESSION['error'];
                unset($_SESSION['error']);

                //Varialbes de autorelloeno formulario
                $this->view->album = unserialize($_SESSION['album']);
                unset($_SESSION['album']);

                //Tipo de error
                $this->view->erroresVal = $_SESSION['erroresVal'];
                unset($_SESSION['erroresVal']);


            }

            //Cargo la vista
            $this->view->render('albumes/editar/index');


        }

        // Este método se activara a partir de la url albumes/update/1
        // Actualizará los datos del cliente a partir de los valores
        function update($param){

            sec_session_start();

            if (isset($_SESSION['error'])){

                $this->view->error = $_SESSION['error'];

                unset($_SESSION['error']);

            }

            if (isset($_SESSION['mensaje'])){

                $this->view->mensaje = $_SESSION['mensaje'];

                unset($_SESSION['mensaje']);

            }

            // Capa autentificación
            if(!isset($_SESSION['id'])){

                header("location:" . URL . "login");

                exit();

            }else if(!in_array($_SESSION['id_rol'], $GLOBALS['editar'])){

                $_SESSION['error'] = "Operacion sin privilegios";

                header("location:" . URL . "index");

                exit();

            }

            $id = htmlspecialchars($param[0]);

            $albumAnterior = $this->model->read($id);

            $album = new Album();

            //Saneamiento de los datos del formulario
            $album->titulo = filter_var($_POST['titulo'] ??='', FILTER_SANITIZE_STRING);
            $album->descripcion = filter_var($_POST['descripcion'] ??='', FILTER_SANITIZE_STRING);
            $album->autor = filter_var($_POST['autor'] ??='', FILTER_SANITIZE_STRING);
            $album->fecha = filter_var($_POST['fecha'] ??='', FILTER_SANITIZE_STRING);
            $album->lugar = filter_var($_POST['lugar'] ??='', FILTER_SANITIZE_STRING);
            $album->categoria = filter_var($_POST['categoria']  ??='', FILTER_SANITIZE_STRING);
            $album->etiquetas = filter_var($_POST['etiquetas'] ??='', FILTER_SANITIZE_STRING);
            $album->carpeta = filter_var($_POST['carpeta'] ??='', FILTER_SANITIZE_STRING);
            
            //Validación
            $erroresVal = [];

             //Aplicaremos las reglas de validación

            //Validar titulo
            if (strcmp($albumAnterior->titulo, $album->titulo) !== 0){
                if(empty($album->titulo)){
                    $erroresVal['titulo'] = "Titulo no puede estar vacio";
                }else if (strlen($album->titulo) > 100){
                    $erroresVal['titulo'] = "Titulo no puede superar mas de 100 caracteres";
                }
            }

            //Validar descripcion
            if (strcmp($albumAnterior->descripcion, $album->descripcion) !== 0){
                if(empty($album->descripcion)){
                    $erroresVal['descripcion'] = "Descripción no puede estar vacio";
                }else if (strlen($album->descripcion) > 1000){
                    $erroresVal['descripcion'] = "Descripcion no puede superar mas de 1000 caracteres";
                }
            }

            //Validar autor
            if (strcmp($albumAnterior->autor, $album->autor) !== 0){
                //Validar autor
                if(empty($album->autor)){
                    $erroresVal['autor'] = "Autor no puede estar vacio";
                }else if (strlen($album->autor) > 50){
                    $erroresVal['autor'] = "Autor no puede superar mas de 50 caracteres";
                }
            }

            //Validar fecha
            if (strcmp($albumAnterior->fecha, $album->fecha) !== 0){
                if(empty($album->fecha)){
                    $erroresVal['fecha'] = "Fecha no puede estar vacio";
                }else if (!$this->model->validarFecha($album->fecha)){
                    $erroresVal['fecha'] = "Fecha no valida";
                }
            }

            //Validar lugar
            if (strcmp($albumAnterior->lugar, $album->lugar) !== 0){
                //Validar lugar
                if(empty($album->lugar)){
                    $erroresVal['lugar'] = "Lugar no puede estar vacio";
                }else if (strlen($album->lugar) > 50){
                    $erroresVal['lugar'] = "Lugar no puede superar mas de 50 caracteres";
                }
            }

            //Validar categoria
            if (strcmp($albumAnterior->categoria, $album->categoria) !== 0){
                //Validar categoria
                if(empty($album->categoria)){
                    $erroresVal['categoria'] = "Categoria no puede estar vacio";
                }else if (strlen($album->categoria) > 50){
                    $erroresVal['categoria'] = "Categoria no puede superar mas de 50 caracteres";
                }
            }

            //Validar carpeta
            if (strcmp($albumAnterior->carpeta, $album->carpeta) !== 0){
                if(empty($album->carpeta)){
                    $erroresVal['carpeta'] = "Carpeta no puede estar vacio";
                }else if (strlen($album->carpeta) > 50){
                    $erroresVal['carpeta'] = "Carpeta no puede superar mas de 50 caracteres";
                }
            }

            if(!empty($erroresVal)){

                //Formulario no validado
                $_SESSION['album'] = Serialize($album);
                $_SESSION['error'] = "Fallo en la validación del formulario";
                $_SESSION['erroresVal'] = $erroresVal;
                //print_r($erroresVal);
                //exit;

                //Redireccionamos a editar album
                header('Location: ' . URL . 'albumes/editar/' . $album->id);

                exit();
            }else{

                //Obtengo objeto de la clase album
                $this->model->update($album, $id);

                //Actualizamos nombre
                rename($albumAnterior->carpeta, $album->carpeta);

                header('Location: ' . URL . 'albumes');

                exit();
            }

        }

        function mostrar($param){

            sec_session_start();

            if (isset($_SESSION['error'])){

                $this->view->error = $_SESSION['error'];

                unset($_SESSION['error']);

            }

            if (isset($_SESSION['mensaje'])){

                $this->view->mensaje = $_SESSION['mensaje'];

                unset($_SESSION['mensaje']);

            }

            // Capa autentificación
            if(!isset($_SESSION['id'])){

                header("location:" . URL . "login");

                exit();

            }else if(!in_array($_SESSION['id_rol'], $GLOBALS['consultar'])){

                $_SESSION['error'] = "Operacion sin privilegios";

                header("location:" . URL . "index");

                exit();

            }

            // Estraigo el id del album que voy a mostrar
            $this->view->id = htmlspecialchars($param[0]);

            // Actualizo el título de la página
            $this->view->title = "Mostrar album - Albumes";

            // Obtengo objeto de la clase album
            $this->view->album = $this->model->read($this->view->id);

            $this->model->contadorVisitas($this->view->id);

            //Cargo la vista
            $this->view->render('albumes/mostrar/index');
 

        }
        function subir($param){

            sec_session_start();

            if (isset($_SESSION['error'])){

                $this->view->error = $_SESSION['error'];

                unset($_SESSION['error']);

            }

            if (isset($_SESSION['mensaje'])){

                $this->view->mensaje = $_SESSION['mensaje'];

                unset($_SESSION['mensaje']);

            }

             // Capa autentificación
             if(!isset($_SESSION['id'])){

                header("location:" . URL . "login");

                exit();

            }else if(!in_array($_SESSION['id_rol'], $GLOBALS['consultar'])){

                $_SESSION['error'] = "Operacion sin privilegios";

                header("location:" . URL . "index");

                exit();

            }

            // Obtengo objeto de la clase album
            $album = $this->model->read($param[0]);

            $this->model->subirArchivo($_FILES['archivos'],$album->carpeta);

            $numFotos = count(glob("images/" . $album->carpeta . "/*"));
            
            $this->model->contadorFotos($album->id, $numFotos);

            header("location:" . URL . "albumes");


        }

        function eliminar($param){

            sec_session_start();

            if (isset($_SESSION['error'])){

                $this->view->error = $_SESSION['error'];

                unset($_SESSION['error']);

            }

            if (isset($_SESSION['mensaje'])){

                $this->view->mensaje = $_SESSION['mensaje'];

                unset($_SESSION['mensaje']);

            }

            // Capa autentificación
            if(!isset($_SESSION['id'])){

                header("location:" . URL . "login");

                exit();

            }else if(!in_array($_SESSION['id_rol'], $GLOBALS['eliminar'])){

                $_SESSION['error'] = "Operacion sin privilegios";

                header("location:" . URL . "index");

                exit();

            }

            // Estraigo el id del album que voy a eliminar
            $this->view->id = htmlspecialchars($param[0]);

            $datosAlbum = $this->model->read($this->view->id);
            // Eliminamos al album
            $this->view->eliminar = $this->model->delete($this->view->id);
           
            //Eliminamos los archivos del directorio
            foreach(glob("images/" . $datosAlbum->carpeta . "/*") as $a){
                unlink($a);

            }
            
            //Una vez vacio eliminamos el directorio
            rmdir("images/" . $datosAlbum->carpeta);

            header('Location: ' . URL . 'albumes');

        }

        function ordenar($param){

            sec_session_start();

            if (isset($_SESSION['error'])){

                $this->view->error = $_SESSION['error'];

                unset($_SESSION['error']);

            }

            if (isset($_SESSION['mensaje'])){

                $this->view->mensaje = $_SESSION['mensaje'];

                unset($_SESSION['mensaje']);

            }

            // Capa autentificación
            if(!isset($_SESSION['id'])){

                header("location:" . URL . "login");

                exit();

            }else if(!in_array($_SESSION['id_rol'], $GLOBALS['consultar'])){

                $_SESSION['error'] = "Operacion sin privilegios";

                header("location:" . URL . "index");

                exit();

            }

            // Estraigo el parametro del album por el que voy a ordenar
            $this->view->criterio = (int) $param[0];

            // Llamo a la funcion orderAlbumes pasandole el parametro por que quiero que me ordene
            $this->view->albumes = $this->model->orderAlbumes($this->view->criterio);

            // Actualizo el título de la página
            $this->view->title = "Ordenar album - Gesbank";

            //Cargo la vista
            $this->view->render('albumes/main/index');

        }

        function buscar(){

            sec_session_start();

            if (isset($_SESSION['error'])){

                $this->view->error = $_SESSION['error'];

                unset($_SESSION['error']);

            }

            if (isset($_SESSION['mensaje'])){

                $this->view->mensaje = $_SESSION['mensaje'];

                unset($_SESSION['mensaje']);

            }

            // Capa autentificación
            if(!isset($_SESSION['id'])){

                header("location:" . URL . "login");

                exit();

            }else if(!in_array($_SESSION['id_rol'], $GLOBALS['consultar'])){

                $_SESSION['error'] = "Operacion sin privilegios";

                header("location:" . URL . "index");

                exit();

            }

            $this->view->albumes = $this->model->filter($_GET['busqueda']);

            // Actualizo el título de la página
            $this->view->title = "Busqueda album - Albumes";

            //Cargo la vista
            $this->view->render('albumes/main/index');

        }

        
    }

?>