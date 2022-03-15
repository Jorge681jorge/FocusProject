<?php
require_once "Persistencia/Conexion.php";
require_once "Persistencia/ArtistaDAO.php";
class Artista{
    private $idArtista;
    private $nombre;
    private $apellido;
    private $correo;
    private $contraseña;
    private $foto;
    private $estado;     
     
    private $conexion;
    private $artistaDAO;

    public function getIdArtista(){
        return $this -> idArtista;
    }

    public function getNombre(){
        return $this -> nombre;
    }

    public function getApellido(){
        return $this -> apellido;
    }

    public function getCorreo(){
        return $this -> correo;
    }

    public function getContraseña(){
        return $this -> contraseña;
    }

    public function getFoto(){
        return $this -> foto;
    }

    public function getEstado(){
        return $this -> estado;
    }
    
    public function Artista($idArtista = "", $nombre = "", $apellido = "", $correo = "", $contraseña = "", $foto = "", $estado = ""){
        $this -> idArtista = $idArtista;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> contraseña = $contraseña;
        $this -> foto = $foto;
        $this -> estado = $estado;
        $this -> conexion = new Conexion();
        $this -> artistaDAO = new ArtistaDAO($this -> idArtista, $this -> nombre, $this -> apellido, $this -> correo, $this -> contraseña, $this -> foto, $this -> estado);
    }
   
    public function existeCorreo(){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> artistaDAO -> existeCorreo());        
        $this -> conexion -> cerrar();        
        return $this -> conexion -> numFilas();
    }
    
    public function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> artistaDAO -> registrar());
        $this -> conexion -> cerrar();         
    }
    
    
    
    public function autenticar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> artistaDAO -> autenticar());
        $this -> conexion -> cerrar();
        if ($this -> conexion -> numFilas() == 1){
            $resultado = $this -> conexion -> extraer();
            $this -> idArtista = $resultado[0];
            $this -> estado = $resultado[1];
            return true;
        }else {
            return false;
        }
    }
    
    public function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> artistaDAO -> consultar());
        $this -> conexion -> cerrar();
        $resultado = $this -> conexion -> extraer();
        $this -> nombre = $resultado[0];
        $this -> apellido = $resultado[1];
        $this -> correo = $resultado[2];
        $this -> contraseña = $resultado[3];
        $this -> foto = $resultado[4];
        $this -> estado = $resultado[5];
    }
    public function consultarTodos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> artistaDAO -> consultarTodos());
        $artistas = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $a = new Artista($resultado[0], $resultado[1], $resultado[2], $resultado[3], "", "", $resultado[4]);
            array_push($artistas, $a);
        }
        $this -> conexion -> cerrar();        
        return $artistas;
    }
    public function consultarConCorreoArtista(){
        $this-> conexion->abrir();
        $this-> conexion->ejecutar($this->artistaDAO->consultarConCorreoArtista());
        $this-> conexion->cerrar();
        $resultado = $this-> conexion->extraer();
        $this-> idArtista = $resultado[0];
        $this-> nombre = $resultado[1];
        $this-> apellido = $resultado[2];
        $this-> correo = $resultado[3];
        $this-> contraseña = $resultado[4];
        $this-> foto = $resultado[5];
        
        if ($this-> conexion->numFilas() >= 1) {
            return "true";
        }else{
            return "false";
        }
    }
    public function consultarTodosReporte(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> artistaDAO -> consultarTodosReporte());
        $artistas = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $a = new Artista($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4], $resultado[5], $resultado[6]);
            array_push($artistas, $a);
        }
        $this -> conexion -> cerrar();        
        return $artistas;
    }
    public function editar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> artistaDAO -> editar());
        $this -> conexion -> cerrar();
    }
    public function editarClave(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> artistaDAO -> editarClave());
        $this -> conexion -> cerrar();
    }

    public function BuscarLog(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> artistaDAO -> BuscarLog());
        $this -> conexion -> cerrar();
        if ($this -> conexion -> numFilas() == 1){
            $resultado = $this -> conexion -> extraer();
            $this -> idArtista = $resultado[0];
            $this -> nombre = $resultado[1];
            $this -> apellido = $resultado[2];
            $this -> correo = $resultado[3];
            $this -> contraseña = $resultado[4];
            $this -> foto = $resultado[5];
            $this -> estado = $resultado[6];
            $this -> artistaDAO = new ArtistaDAO($this -> idArtista);
            return true;
        }else {
            return false;
        }
    }
    public function datos()
    {

        $datos = $this->idArtista . "||" .
            $this->nombre . "||" .
            $this->apellido . "||" .
            $this->correo . "||" .
            $this->contraseña . "||" .
            $this->foto;

        return $datos;
    }
  
}
