<?php
require_once "Persistencia/Conexion.php";
require_once "Persistencia/ComentarioDAO.php";

class Comentario{

    private $idComentario;
    private $idUsuario;
    private $idVersion;
    private $comentario;
    private $fecha;
    private $hora;


    private $conexion;
    private $comentarioDAO;


    public function getIdComentario(){
        
        return  $this -> idComentario;
    }

    public function getIdUsuario(){
        
        return  $this -> idUsuario;
    }
    public function getIdVersion(){
        
        return  $this -> idVersion;
    }

    public function getComentario(){
        
        return  $this -> comentario;
    }
    public function getFecha(){
        
        return  $this -> fecha;
    }
    public function getHora(){
        
        return  $this -> hora;
    }

    public function Comentario($idComentario = "", $idUsuario = "", $idVersion = "", $comentario = "", $fecha = "",$hora = ""){

        $this -> idComentario = $idComentario;
        $this -> idUsuario = $idUsuario;
        $this -> idVersion = $idVersion;
        $this -> comentario = $comentario;
        $this -> fecha = $fecha;
        $this -> hora = $hora;

        $this -> conexion = new Conexion();
        $this -> comentarioDAO = new ComentarioDAO($this -> idComentario, $this -> idUsuario, $this -> idVersion, $this -> comentario, $this -> fecha, $this -> hora);
        
    }

    public function insertar(){  
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> comentarioDAO -> insertar());        
        $this -> conexion -> cerrar(); 
        return $this -> conexion -> getResultado();       
    }
    public function consultarTodosVersion(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> comentarioDAO -> consultarTodosVersion());
        $comentarios = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $c = new Comentario($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4], $resultado[5]);
            array_push($comentarios, $c);
        }
        $this -> conexion -> cerrar();        
        return $comentarios;
    }
    public function consultarTodos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> comentarioDAO -> consultarTodos());
        $comentarios = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $c = new Comentario($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4], $resultado[5]);
            array_push($comentarios, $c);
        }
        $this -> conexion -> cerrar();        
        return $comentarios;
    }

    public function consultarPaginacion($cantidad, $pagina){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> comentarioDAO -> consultarPaginacion($cantidad, $pagina));
        $comentarios = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $c = new Comentario($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4], $resultado[5]);
            array_push($comentarios, $c);
        }
        $this -> conexion -> cerrar();
        return $comentarios;
    }
}
