<?php
class AdministradorDAO{
    private $idAdministrador;
    private $nombre;
    private $apellido;
    private $correo;
    private $contraseña;
    private $foto;

    public function AdministradorDAO($idAdministrador = "", $nombre = "", $apellido = "", $correo = "", $contraseña = "", $foto = ""){
        $this -> idAdministrador = $idAdministrador;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> contraseña = $contraseña;
        $this -> foto = $foto;
    }  

    public function autenticar(){
        return "select idAdministrador 
                from administrador 
                where correo = '" . $this -> correo .  "' and contraseña = '" . md5($this -> contraseña) . "'";
    }

    public function consultar(){
        return "select nombre, apellido, correo, contraseña, foto
                from administrador
                where idAdministrador = '" . $this -> idAdministrador .  "'";
    }
    public function consultarConCorreo(){
        return "select idAdministrador, nombre, apellido, correo, contraseña, foto
                from administrador
                where correo = '" . $this -> correo .  "'";
    }


    public function editar(){
        return "update administrador
                set nombre = '" . $this -> nombre . "', apellido = '" . $this -> apellido . 
                "', foto = '" . $this -> foto . 
                "' where idAdministrador = '" . $this -> idAdministrador.  "'";
    }
    public function editarClave(){
        return "update administrador
                set contraseña = '" .  md5($this -> contraseña)  . 
                "' where idAdministrador = '" . $this -> idAdministrador .  "'";
    }
    public function BuscarLog(){
        return "select idAdministrador, nombre, apellido, correo, contraseña, foto, estado
                from administrador 
                where correo = '" . $this -> correo .  "'";
    }
    
    
}

?>