<?php
class CriticoDAO{
    private $idCritico;
    private $nombre;
    private $apellido;
    private $correo;
    private $contraseña;
    private $foto;

    public function CriticoDAO($idCritico = "", $nombre = "", $apellido = "", $correo = "", $contraseña = "", $foto = ""){
        $this -> idCritico = $idCritico;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> contraseña = $contraseña;
        $this -> foto = $foto;
    }

    public function autenticar(){
        return "select idCritico 
                from critico 
                where correo = '" . $this -> correo .  "' and contraseña = '" . md5($this -> contraseña) . "'";
    }

    public function consultar(){
        return "select nombre, apellido, correo, foto, contraseña
                from critico
                where idCritico = '" . $this -> idCritico .  "'";
    }
    public function consultarConCorreoCritico(){
        return "select idCritico, nombre, apellido, correo, contraseña, foto
                from critico
                where correo = '" . $this -> correo .  "'";
    }

    public function editar(){
        return "update critico
                set nombre = '" . $this -> nombre . "', apellido = '" . $this -> apellido . 
                "', foto = '" . $this -> foto . 
                "' where idCritico = '" . $this -> idCritico.  "'";
    }

    public function editarClave(){
        return "update critico
                set contraseña = '" .  md5($this -> contraseña)  . 
                "' where idCritico = '" . $this -> idCritico .  "'";
    }
    
    public function BuscarLog(){
        return "select idCritico, nombre, apellido, correo, contraseña, foto
                from critico 
                where correo = '" . $this -> correo .  "'";
    }
    
}

?>