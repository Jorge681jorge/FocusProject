<?php
require_once "Persistencia/Conexion.php";
require_once "Persistencia/ObraDAO.php";
class Obra{
    private $idObra;
    private $idArtista;
    private $estado;

    private $conexion;
    private $obraDAO;
    
    
    public function getIdObra(){
        return $this -> idObra;
    }
    public function getIdArtista(){
        return $this -> idArtista;

    }
    public function getEstado(){
        return $this -> estado;

    }
        
    public function Obra($idObra = "", $idArtista = "", $estado = ""){
        $this -> idObra = $idObra;
        $this -> idArtista = $idArtista;
        $this -> estado = $estado;
        
        $this -> conexion = new Conexion();
        $this -> obraDAO = new ObraDAO($this -> idObra, $this -> idArtista, $this -> estado);
    }
    
    public function insertar(){  
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> obraDAO -> insertar());        
        $this -> conexion -> cerrar();        
    }

    public function insertar_2(){  
     
        return($this -> obraDAO -> insertar());            
    }
    
    public function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> obraDAO -> consultar());
        $this -> conexion -> cerrar();
        $resultado = $this -> conexion -> extraer();
        $this -> idObra = $resultado[0];
        $this -> idArtista = $resultado[1];
        $this -> estado = $resultado[2];
    
    }
    public function consultarObrasArtista(){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> obraDAO -> consultarObrasArtista());
        $obras = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $o = new Obra($resultado[0], $resultado[1], $resultado[2]);
            array_push($obras, $o);
        }
        $this -> conexion -> cerrar();
        return $obras;
    
    }

    public function editarEstado(){  
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> obraDAO -> editarEstado());        
        $this -> conexion -> cerrar();   
        return  $this -> conexion -> getResultado();
    }
    
    public function consultarTodos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> obraDAO -> consultarTodos());
        $obras = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $o = new Obra($resultado[0], $resultado[1], $resultado[2]);
            array_push($obras, $o);
        }
        $this -> conexion -> cerrar();        
        return $obras;
    }
    
    
    public function consultarPaginacion($cantidad, $pagina){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> obraDAO -> consultarPaginacion($cantidad, $pagina));
        $obras = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $o = new Obra($resultado[0], $resultado[1], $resultado[2]);
            array_push($obras, $o);
        }
        $this -> conexion -> cerrar();
        return $obras;
    }
    public function consultarPaginacionRegistradas($cantidad, $pagina){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> obraDAO -> consultarPaginacionRegistradas($cantidad, $pagina));
        $obras = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $o = new Obra($resultado[0], $resultado[1], $resultado[2]);
            array_push($obras, $o);
        }
        $this -> conexion -> cerrar();
        return $obras;
    }
    public function consultarObrasAdmitidas($cantidad, $pagina){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> obraDAO -> consultarObrasAdmitidas($cantidad, $pagina));
        $obras = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $o = new Obra($resultado[0], $resultado[1], $resultado[2]);
            array_push($obras, $o);
        }
        $this -> conexion -> cerrar();
        return $obras;
    }
    public function consultarObrasPublicadas(){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> obraDAO -> consultarObrasPublicadas());
        $obras = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $o = new Obra($resultado[0], $resultado[1], $resultado[2]);
            array_push($obras, $o);
        }
        $this -> conexion -> cerrar();
        return $obras;
    }
    public function consultarCantidad(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> obraDAO -> consultarCantidad());
        $this -> conexion -> cerrar();
        return $this -> conexion -> extraer()[0];
    }
/*     public function BuscarLog()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this-> obraDAO->BuscarLog());
        $this->conexion->cerrar();
        if ($this->conexion->numFilas() == 1) {
            $resultado = $this->conexion->extraer();
            $this->idAdministrador = $resultado[0];
            $this->nombre = $resultado[1];
            $this->apellido = $resultado[2];
            $this->correo = $resultado[3];
            $this->contraseña = $resultado[4];
            $this->foto = $resultado[5];
            $this->administradorDAO = new AdministradorDAO($this->idAdministrador);
            return true;
        } else {
            return false;
        }
    } */

    public function consultarCantidadFiltro($filtro){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> obraDAO -> consultarCantidadFiltro($filtro));
        $this -> conexion -> cerrar();
        return $this -> conexion -> extraer()[0];
    }
    public function consultarFiltro($filtro){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> obraDAO -> consultarFiltro($filtro));
        $obras = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $o = new Log($resultado[0], $resultado[1], $resultado[2]);
            array_push($obras, $o);
        }
        $this -> conexion -> cerrar();
        return $obras;
    }
    
}
