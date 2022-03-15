<?php
require_once "Persistencia/Conexion.php";
require_once "Persistencia/Obra_VersionDAO.php";
class Obra_Version{
    private $id;
    private $idObra;
    private $idVersion;

    private $conexion;
    private $obra_VersionDAO;
    
    
    public function getId(){
        return $this -> id;
    }
    public function getIdObra(){
        return $this -> idObra;

    }
    public function getIdVersion(){
        return $this -> idVersion;

    }
        
    public function Obra_Version($id = "", $idObra = "", $idVersion = ""){
        $this -> id = $id;
        $this -> idObra = $idObra;
        $this -> idVersion = $idVersion;
        
        $this -> conexion = new Conexion();
        $this -> obra_VersionDAO = new Obra_VersionDAO($this -> id, $this -> idObra, $this -> idVersion);
    }
    
    public function insertar(){  
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> obra_VersionDAO -> insertar());        
        $this -> conexion -> cerrar();        
    }

    public function insertar_2(){  
     
        return($this -> obra_VersionDAO -> insertar());            
    }
    
    public function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> obra_VersionDAO -> consultar());
        $this -> conexion -> cerrar();
        $resultado = $this -> conexion -> extraer();
        $this -> id = $resultado[0];
        $this -> idObra = $resultado[1];
        $this -> idVersion = $resultado[2];
    
    }
    public function consultarConVersion(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> obra_VersionDAO -> consultarConVersion());
        $this -> conexion -> cerrar();
        $resultado = $this -> conexion -> extraer();
        $this -> id = $resultado[0];
        $this -> idObra = $resultado[1];
        $this -> idVersion = $resultado[2];
    
    }

    public function consultarTodos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> obra_VersionDAO -> consultarTodos());
        $obras = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $o = new Obra_Version($resultado[0], $resultado[1], $resultado[2]);
            array_push($obras, $o);
        }
        $this -> conexion -> cerrar();        
        return $obras;
    }
    public function consultarUltimaVersion(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> obra_VersionDAO -> consultarUltimaVersion());
        $oo = new Obra_Version("1","2","3");
        while(($resultado = $this -> conexion -> extraer()) != null){
            $oo = new Obra_Version($resultado[0], $resultado[1], $resultado[2]);
        }
        $this -> conexion -> cerrar();        
        return $oo;
    }

    public function sentencia(){
        return ($this -> obra_VersionDAO -> consultarUltimaVersion());
    }
    
}
?>