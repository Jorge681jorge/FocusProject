<?php
require_once "Persistencia/Conexion.php";
require_once "Persistencia/AdministradorDAO.php";
class Administrador
{
    private $idAdministrador;
    private $nombre;
    private $apellido;
    private $correo;
    private $contraseña;
    private $foto;
    private $conexion;
    private $administradorDAO;

    public function getIdAdministrador()
    {
        return $this->idAdministrador;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function getContraseña()
    {
        return $this->contraseña;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function Administrador($idAdministrador = "", $nombre = "", $apellido = "", $correo = "", $contraseña = "", $foto = "")
    {
        $this->idAdministrador = $idAdministrador;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;
        $this->contraseña = $contraseña;
        $this->foto = $foto;
        $this->conexion = new Conexion();
        $this->administradorDAO = new AdministradorDAO($this->idAdministrador, $this->nombre, $this->apellido, $this->correo, $this->contraseña, $this->foto);
    }

    public function autenticar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->administradorDAO->autenticar());
        $this->conexion->cerrar();
        if ($this->conexion->numFilas() == 1) {
            $resultado = $this->conexion->extraer();
            $this->idAdministrador = $resultado[0];
            return true;
        } else {
            return false;
        }
    }

    public function consultar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->administradorDAO->consultar());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->nombre = $resultado[0];
        $this->apellido = $resultado[1];
        $this->correo = $resultado[2];
        $this->contraseña = $resultado[3];
        $this->foto = $resultado[4];
    }
    public function consultarConCorreo()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->administradorDAO->consultarConCorreo());
        $this->conexion->cerrar();
        $resultado = $this->conexion->extraer();
        $this->idAdministrador = $resultado[0];
        $this->nombre = $resultado[1];
        $this->apellido = $resultado[2];
        $this->correo = $resultado[3];
        $this->contraseña = $resultado[4];
        $this->foto = $resultado[5];
        if ($this->conexion->numFilas() >= 1) {
            return "true";
        } else {
            return "false";
        }
    }
    public function editar()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->administradorDAO->editar());
        $this->conexion->cerrar();
    }
    public function editarClave()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->administradorDAO->editarClave());
        $this->conexion->cerrar();
    }
    public function BuscarLog()
    {
        $this->conexion->abrir();
        $this->conexion->ejecutar($this->administradorDAO->BuscarLog());
        $this->conexion->cerrar();
        if ($this->conexion->numFilas() >= 1) {
            $resultado = $this->conexion->extraer();
            $this->idAdministrador = $resultado[0];
            $this->nombre = $resultado[1];
            $this->apellido = $resultado[2];
            $this->correo = $resultado[3];
            $this->contraseña = $resultado[4];
            $this->foto = $resultado[5];
            $this->administradorDAO = new AdministradorDAO($this->idAdministrador);
            return "true";
        } else {
            return "false";
        }
    }

    public function datos()
    {
        $datos = $this->idAdministrador . "||" .
            $this->nombre . "||" .
            $this->apellido . "||" .
            $this->correo . "||" .
            $this->contraseña . "||" .
            $this->foto;

        return $datos;
    }
}
