<?php 

	class explorador { 
		
		private $dirRaiz;
		private $dirActual;
		

		public function __construct(
			$pRaiz=null, 
			$pActual=null
			)
		{
			$this->dirRaiz=$pRaiz;
			
			if (is_null($pActual)) {
				chdir($pRaiz);
			}
			else {
				chdir($pActual);
			}
			$this->dirActual=getcwd();
		} 
			

	

		public function getDirRaiz(){
			return $this->dirRaiz;
		}

		public function getDirActual() {
			return $this->dirActual;
		}

		public function setDirRaiz($pRaiz) {
			$this->dirRaiz=$pRaiz;
		}

		public function setDirActual($pActual) {
			$this->dirActual=$pActual;
		}

		public function leerDirectorioActual(){
			return glob('*');
		}

		public function eliminarArchivo($archivo){
			unlink($archivo);
		}

		//Establece directorio actual
		public function establecerDirectorio(){
			if (is_dir($this->dirActual)){
					chdir($this->dirActual); 
				}
		}

		//Método que recibe el array de check con los archivos y carpetas seleccionados.
		public function eliminar($lista) {
			foreach ($lista as $ad) {
			
				if (is_file($ad)) {
					$this->eliminarArchivo($ad);
				}
				if (is_dir($ad)) {
					$this->eliminarDirectorio($ad);
				}
			}

		}

		// Función Recursiva
		public function eliminarDirectorio($carpeta) {

			foreach(glob($carpeta . "/*") as $archivos_carpeta) {
        		
		        if (is_dir($archivos_carpeta))
		        {
		            $this->eliminarDirectorio($archivos_carpeta);
		        }
		        else
		        {
		            $this->eliminarArchivo($archivos_carpeta);
		        }
    		}
    	rmdir($carpeta);
		}
		
		// Subir Archivo al directorio actual
		public function subirArchivo($archivo){
			if (is_uploaded_file($archivo['tmp_name'])){
				move_uploaded_file($archivo['tmp_name'],$archivo['name']);
			}
		}
		//Descarga sólo el primer archivo seleccionado
		public function descargarArchivos($archivos){
			foreach ($archivos as $a) {
				header("Content-type: application/octet-stream");
				header("Content-disposition: attachment; filename=".$a);
				readfile($a); 		
			}
		}

		public function comprimir($archivos){
			$zip = new ZipArchive();
			//El nombre del archivo comprimido como primer archivo seleccionado
			$archivoComprimido= "archivo.zip";
			// $archivoComprimido = array_shift(explode('.', basename($archivos[0]))).'.zip';
			if ($zip->open($archivoComprimido, ZIPARCHIVE::CREATE) === true) {
				foreach ($archivos as $archivo) {
					if (is_file($archivo)) {
						$zip->addFile($archivo, $archivo);
					}
					else{
						$this->agregarCarpeta($archivo, $zip);
					}
				}
				$zip->close();
			}
		}

		function agregarCarpeta($carpeta, $zip) {
			$archivos = glob($carpeta . "/*");
			if (count($archivos)>0) {
				foreach ($archivos as $archivo) {
					if (is_dir($archivo)) {
						$this->agregarCarpeta($archivo, $zip);
					} 
					else{
						if (is_file($archivo)) {
							$zip->addFile($archivo, $archivo);
						}
					}
				}
			}
			else{
				$zip->addEmptyDir($carpeta);
			}
		}

	public function cambiarNombre($antiguoNombre, $nuevoNombre){
		rename($antiguoNombre, $nuevoNombre);
	}

	public function crearDirectorio($directorio){
		mkdir($directorio);
	}
	public function abrirDirectorio($directorio){
			if (is_dir($directorio)) {
				chdir($directorio);
				$this->dirActual=getcwd();
			}
			
		}

	public function cerrarDirectorio(){
		if (!(basename($this->dirActual)==$this->dirRaiz)){
			$this->dirActual=dirname($this->dirActual);
			chdir(dirname(getcwd()));
			}
	}

}

	
?>