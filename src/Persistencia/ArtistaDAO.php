<?php
class ArtistaDAO
{
    private $idArtista;
    private $nombre;
    private $apellido;
    private $correo;
    private $contraseña;
    private $foto;
    private $estado;

    public function ArtistaDAO($idArtista = "", $nombre = "", $apellido = "", $correo = "", $contraseña = "", $foto = "", $estado = "")
    {
        $this->idArtista = $idArtista;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;
        $this->contraseña = $contraseña;
        $this->foto = $foto;
        $this->estado = $estado;
    }

    public function existeCorreo()
    {
        return "select correo
                from artista
                where correo = '" . $this->correo .  "'";
    }

    public function registrar()
    {
        return "insert into artista (nombre, apellido, correo, contraseña, estado)
                values ('" . $this->nombre . "', '" . $this->apellido . "', '" . $this->correo . "', '" . md5($this->contraseña) . "', '" . $this->estado . "')";
    }


    public function autenticar()
    {
        return "select idArtista, estado
                from artista
                where correo = '" . $this->correo .  "' and contraseña = '" . md5($this->contraseña) . "'";
    }

    public function consultar()
    {
        return "select nombre, apellido, correo, contraseña, foto, estado
                from artista
                where idArtista = '" . $this->idArtista .  "'";
    }
    public function consultarTodos(){
        return "select idArtista, nombre, apellido, correo, estado
                from artista";
    }
    public function consultarConCorreoArtista(){
        return "select idArtista, nombre, apellido, correo, contraseña, foto
                from artista
                where correo = '" . $this -> correo .  "'";
    }
    public function consultarTodosReporte(){
        return "select idArtista, nombre, apellido, correo, contraseña, foto, estado
                from artista";
    }
    public function editar(){
        return "update artista
                set nombre = '" . $this -> nombre . "', apellido = '" . $this -> apellido . 
                "', foto = '" . $this -> foto . 
                "' where idArtista = '" . $this -> idArtista.  "'";
    }
    public function editarClave(){
        return "update artista
                set contraseña = '" .  md5($this -> contraseña)  . 
                "' where idArtista = '" . $this -> idArtista .  "'";
    }
    public function BuscarLog(){
        return "select idArtista, nombre, apellido, correo, contraseña, foto, estado
                from artista 
                where correo = '" . $this -> correo .  "'";
    }
 
}
