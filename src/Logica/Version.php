<?php
require_once "Persistencia/Conexion.php";
require_once "Persistencia/VersionDAO.php";
class Version{
    private $idVersion;
    private $titulo;
    private $descripcion;
    private $valor;
    private $foto;
    private $fecha;
    private $hora;
    private $estado;

    private $conexion;
    private $versionDAO;
    
    

    public function getIdVersion(){
        return $this -> idVersion;
    }

    public function getFoto(){
        return $this -> foto;
    }

    public function getTitulo(){
        return $this -> titulo;
    }
    
    public function getDescripcion(){
        return $this -> descripcion;
    }
    
    public function getValor(){
        return $this -> valor;
    }
    public function getFecha(){
        return $this -> fecha;
    }
    public function getHora(){
        return $this -> hora;
    }
    public function getEstado(){
        return $this -> estado;
    }
        
    public function Version($idVersion = "", $titulo = "", $descripcion = "", $valor = "", $foto = "", $fecha = "",  $hora = "",  $estado = "" ){
        $this -> idVersion = $idVersion;
        $this -> titulo = $titulo;
        $this -> descripcion = $descripcion;
        $this -> valor = $valor;
        $this -> foto = $foto;
        $this -> fecha = $fecha;
        $this -> hora = $hora;
        $this -> estado = $estado;
        $this -> conexion = new Conexion();
        $this -> versionDAO = new VersionDAO($this -> idVersion, $this -> titulo, $this -> descripcion, $this -> valor, $this -> foto, $this -> fecha, $this -> hora, $this -> estado);
    }
    
    public function insertar(){  
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> versionDAO -> insertar());        
        $this -> conexion -> cerrar();        
    }
    public function insertar_2(){  
        
        return($this -> versionDAO -> insertar());        
        
        
    }
    public function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> versionDAO -> consultar());
        $this -> conexion -> cerrar();
        $resultado = $this -> conexion -> extraer();
        $this -> idVersion = $resultado[0];
        $this -> titulo = $resultado[1];
        $this -> descripcion = $resultado[2];
        $this -> valor = $resultado[3];
        $this -> foto = $resultado[4];
        $this -> fecha = $resultado[5];
        $this -> hora = $resultado[6];
        $this -> estado = $resultado[7];
    
    }
    
    public function consultarTodos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> versionDAO -> consultarTodos());
        $obras = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $o = new Version($resultado[0], $resultado[1], $resultado[2], $resultado[3],$resultado[4], $resultado[5], $resultado[6], $resultado[7]);
            array_push($obras, $o);
        }
        $this -> conexion -> cerrar();        
        return $obras;
    }
    public function consultarUltimaVersion(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> versionDAO -> consultarUltimaVersion());
        
        while(($resultado = $this -> conexion -> extraer()) != null){
            $o = new Version($resultado[0], $resultado[1], $resultado[2], $resultado[3],$resultado[4], $resultado[5], $resultado[6], $resultado[7]);
        }
        $this -> conexion -> cerrar();        
        return $o;
    }
    
    public function consultarPaginacion($cantidad, $pagina){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> versionDAO -> consultarPaginacion($cantidad, $pagina));
        $obras = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $o = new Version($resultado[0], $resultado[1], $resultado[2], $resultado[3],$resultado[4], $resultado[5], $resultado[6], $resultado[7]);
            array_push($obras, $o);
        }
        $this -> conexion -> cerrar();
        return $obras;
    }
    
    public function consultarCantidad(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> versionDAO -> consultarCantidad());
        $this -> conexion -> cerrar();
        return $this -> conexion -> extraer()[0];
    }

    public function datos(){

    $datos = $this -> idVersion."||".
    $this -> titulo."||".
    $this -> descripcion."||".
    $this -> valor."||".
    $this -> foto."||".
    $this -> fecha."||".
    $this -> hora."||".
    $this -> estado
    ;
    
    return $datos;
    }
    
}

?>