<?php
require_once "Persistencia/Conexion.php";
require_once "Persistencia/CriticoDAO.php";
class Critico{
    private $idCritico;
    private $nombre;
    private $apellido;
    private $correo;
    private $contraseña;
    private $foto;
    private $conexion;
    private $criticoDAO;

    public function getIdCritico(){
        return $this -> idCritico;
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

    public function Critico($idCritico = "", $nombre = "", $apellido = "", $correo = "", $contraseña = "", $foto = ""){
        $this -> idCritico = $idCritico;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> contraseña = $contraseña;
        $this -> foto = $foto;
        $this -> conexion = new Conexion();
        $this -> criticoDAO = new CriticoDAO($this -> idCritico, $this -> nombre, $this -> apellido, $this -> correo, $this -> contraseña, $this -> foto);
    }

    public function autenticar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> criticoDAO -> autenticar());
        $this -> conexion -> cerrar();       
        if ($this -> conexion -> numFilas() == 1){            
            $resultado = $this -> conexion -> extraer();
            $this -> idCritico = $resultado[0];             
            return true;        
        }else {
            return false;
        }
    }
    
    public function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> criticoDAO -> consultar());
        $this -> conexion -> cerrar();
        $resultado = $this -> conexion -> extraer();
        $this -> nombre = $resultado[0];
        $this -> apellido = $resultado[1];
        $this -> correo = $resultado[2];
        $this -> foto = $resultado[3];
        $this -> contraseña = $resultado[4];
    }
    public function consultarConCorreoCritico(){
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->criticoDAO->consultarConCorreoCritico());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->idCritico = $resultado[0];
        $this->nombre = $resultado[1];
        $this->apellido = $resultado[2];
        $this->correo = $resultado[3];
        $this->contraseña = $resultado[4];
        $this->foto = $resultado[5];
        if ($this-> conexion->numFilas() >= 1) {
            return "true";
        }else{
            return "false";
        }
    }

    public function editar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> criticoDAO -> editar());
        $this -> conexion -> cerrar();
    }

    public function editarClave(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> criticoDAO -> editarClave());
        $this -> conexion -> cerrar();
    }
    public function BuscarLog(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> criticoDAO -> BuscarLog());
        $this -> conexion -> cerrar();
        if ($this -> conexion -> numFilas() == 1){
            $resultado = $this -> conexion -> extraer();
            $this -> idCritico = $resultado[0];
            $this -> nombre = $resultado[1];
            $this -> apellido = $resultado[2];
            $this -> correo = $resultado[3];
            $this -> foto = $resultado[4];
            $this -> contraseña = $resultado[5];
            $this -> criticoDAO = new CriticoDAO($this -> idCritico);
            return true;
        }else {
            return false;
        }
    }
    public function datos()
    {

        $datos = $this->idCriticio . "||" .
            $this->nombre . "||" .
            $this->apellido . "||" .
            $this->correo . "||" .
            $this->contraseña . "||" .
            $this->foto;

        return $datos;
    }
    
}

?>