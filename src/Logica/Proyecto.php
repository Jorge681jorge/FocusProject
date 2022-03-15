<?php
require_once "Persistencia/Conexion.php";
require_once "Persistencia/ProyectoDAO.php";
class Proyecto{
    private $idProyecto;
    private $idArtista;
    private $titulo;
    private $descripcion;
    
    
    private $conexion;
    private $proyectoDAO;

    public function getIdProyecto(){
        return $this -> idProyecto;
    }

    public function getIdArtista(){
        return $this -> idProyecto;
    }

    public function getTitulo(){
        return $this -> titulo;
    }
    
    public function getDescripcion(){
        return $this -> descripcion;
    }
    
    
        
    public function Proyecto($idProyecto = "", $idArtista = "", $titulo = "", $descripcion = ""){
        $this -> idProyecto = $idProyecto;
        $this -> idArtista = $idArtista;
        $this -> titulo = $titulo;
        $this -> descripcion = $descripcion;
        
        $this -> conexion = new Conexion();
        $this -> proyectoDAO = new ProyectoDAO($this -> idProyecto, $this -> idArtista, $this -> titulo, $this -> descripcion);
    }
    
    public function insertar(){  
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> proyectoDAO -> insertar());        
        $this -> conexion -> cerrar();
        return $this -> conexion -> getResultado();        
    }
    public function insertar_2(){  
        
        return($this -> proyectoDAO -> insertar());        
        
        
    }
    
    public function consultarTodos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proyectoDAO -> consultarTodos());
        $proyectos = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $p = new Proyecto($resultado[0], $resultado[1], $resultado[2], $resultado[3]);
            array_push($proyectos, $p);
        }
        $this -> conexion -> cerrar();        
        return $proyectos;
    }
    
    public function consultarPaginacion($cantidad, $pagina){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> proyectoDAO -> consultarPaginacion($cantidad, $pagina));
        $proyectos = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $p = new Proyecto($resultado[0], $resultado[1], $resultado[2], $resultado[3]);
            array_push($proyectos, $p);
        }
        $this -> conexion -> cerrar();
        return $proyectos;
    }
    
    public function consultarCantidad(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proyectoDAO -> consultarCantidad());
        $this -> conexion -> cerrar();
        return $this -> conexion -> extraer()[0];
    }
    
}

?>