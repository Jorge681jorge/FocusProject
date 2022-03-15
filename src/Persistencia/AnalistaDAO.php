<?php
class AnalistaDAO
{
    private $idAnalista;
    private $nombre;
    private $apellido;
    private $correo;
    private $contraseña;
    private $foto;
    

    public function AnalistaDAO($idAnalista = "", $nombre = "", $apellido = "", $correo = "", $contraseña = "", $foto = "")
    {
        $this->idAnalista = $idAnalista;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;
        $this->contraseña = $contraseña;
        $this->foto = $foto;
        
    }


    public function autenticar()
    {
        return "select idAnalista
                from analista
                where correo = '" . $this->correo .  "' and contraseña = '" . md5($this->contraseña) . "'";
    }

    public function consultar()
    {
        return "select nombre, apellido, correo, contraseña, foto
                from analista
                where idAnalista = '" . $this->idAnalista .  "'";
    }
    public function consultarConCorreoAnalista(){
        return "select idAnalista, nombre, apellido, correo, contraseña, foto
                from analista
                where correo = '" . $this -> correo .  "'";
    }

    public function editar(){
        return "update analista
                set nombre = '" . $this -> nombre . "', apellido = '" . $this -> apellido . 
                "', foto = '" . $this -> foto . 
                "' where idAnalista = '" . $this -> idAnalista.  "'";
    }
    public function editarClave(){
        return "update analista
                set contraseña = '" .  md5($this -> contraseña)  . 
                "' where idAnalista = '" . $this -> idAnalista .  "'";
    }
    public function BuscarLog(){
        return "select idAnalista, nombre, apellido, correo, contraseña, foto
                from analista 
                where correo = '" . $this -> correo .  "'";
    }
}
