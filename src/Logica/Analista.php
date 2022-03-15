<?php
require_once "Persistencia/Conexion.php";
require_once "Persistencia/AnalistaDAO.php";
class Analista{
    private $idAnalista;
    private $nombre;
    private $apellido;
    private $correo;
    private $contraseña;
    private $foto;
          
    private $conexion;
    private $AdministradorDAO;

    public function getIdAnalista(){
        return $this -> idAnalista;
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
    
    public function Analista($idAnalista = "", $nombre = "", $apellido = "", $correo = "", $contraseña = "", $foto = ""){
        $this -> idAnalista = $idAnalista;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> contraseña = $contraseña;
        $this -> foto = $foto;
        
        $this -> conexion = new Conexion();
        $this -> analistaDAO = new AnalistaDAO($this -> idAnalista, $this -> nombre, $this -> apellido, $this -> correo, $this -> contraseña, $this -> foto);
    }

    
    public function autenticar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> analistaDAO -> autenticar());
        $this -> conexion -> cerrar();
        if ($this -> conexion -> numFilas() == 1){
            $resultado = $this -> conexion -> extraer();
            $this -> idAnalista = $resultado[0];
            $this -> estado = $resultado[1];
            return true;
        }else {
            return false;
        }
    }
    
    public function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> analistaDAO -> consultar());
        $this -> conexion -> cerrar();
        $resultado = $this -> conexion -> extraer();
        $this -> nombre = $resultado[0];
        $this -> apellido = $resultado[1];
        $this -> correo = $resultado[2];
        $this -> contraseña = $resultado[3];
        $this -> foto = $resultado[4];
    }
    public function consultarConCorreoAnalista(){
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->analistaDAO->consultarConCorreoAnalista());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->idAnalista = $resultado[0];
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
        $this -> conexion -> ejecutar($this -> analistaDAO -> editar());
        $this -> conexion -> cerrar();
    }
    public function editarClave(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> analistaDAO -> editarClave());
        $this -> conexion -> cerrar();
    }
    public function BuscarLog(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> analistaDAO -> BuscarLog());
        $this -> conexion -> cerrar();
        if ($this -> conexion -> numFilas() == 1){
            $resultado = $this -> conexion -> extraer();
            $this -> idAnalista = $resultado[0];
            $this -> nombre = $resultado[1];
            $this -> apellido = $resultado[2];
            $this -> correo = $resultado[3];
            $this -> contraseña = $resultado[4];
            $this -> foto = $resultado[5];
            $this -> analistaDAO = new AnalistaDAO($this -> idAnalista);
            return true;
        }else {
            return false;
        }
    }
    public function datos()
    {

        $datos = $this->idAnalista . "||" .
            $this->nombre . "||" .
            $this->apellido . "||" .
            $this->correo . "||" .
            $this->contraseña . "||" .
            $this->foto;

        return $datos;
    }
}
