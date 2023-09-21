<?php
#|--------------------------------|
#| CLASE ALBUM CON SUS PROPIEDADES|
#|--------------------------------|
class Album {

    public $id;
    public $titulo;
    public $descripcion;
    public $autor;
    public $fecha;
    public $lugar;       
    public $categoria;
    public $etiquetas;
    public $num_fotos;
    public $num_visitas;
    public $carpeta;

    function __construct($id = null,$titulo = null,$descripcion = null,$autor = null,$fecha = null,$lugar = null,$categoria = null,$etiquetas = null,$num_fotos = null,$num_visitas = null,$carpeta = null) {

        $this->id=$id;
        $this->titulo=$titulo;
        $this->descripcion=$descripcion;
        $this->autor=$autor;
        $this->fecha=$fecha;
        $this->lugar=$lugar;
        $this->categoria=$categoria;
        $this->etiquetas=$etiquetas;
        $this->num_visitas=$num_visitas;
        $this->num_fotos=$num_fotos;
        $this->carpeta=$carpeta;
        $this->sql = "select * from albumes";
    }
}
