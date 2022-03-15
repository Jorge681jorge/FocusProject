<?php
class Notificacion_artistaDAO
{
    private $idNotificacion;
    private $asunto;
    private $remitente;
    private $referencia; 
    private $destinatario;   
    private $foto;
    private $estado;
    private $hora;
    private $fecha;  
 
    public function Notificacion_artistaDAO($idNotificacion = "", $asunto = "", $remitente = "", $destinatario = "", $referencia = "", $fecha = "", $hora = "", $estado = "")
    {
        $this-> idNotificacion = $idNotificacion;
        $this-> asunto = $asunto;
        $this-> remitente = $remitente;
        $this -> destinatario = $destinatario;
        $this-> referencia = $referencia;
        $this -> fecha = $fecha;
        $this -> hora = $hora;
        $this-> estado = $estado;
    }

    public function registrar()
    {
        return "insert into notificacion_artista (idnotificacion, asunto, remitente, destinatario, referencia, fecha, hora, estado) 
        VALUES (NULL, '" . $this->asunto .  "', '" . $this->remitente . "', '" . $this->destinatario . "', '" . $this->referencia . "', '" . $this->fecha . "', '" . $this->hora . "', '" . $this->estado . "');";
    }
   
    public function consultar()
    {
        return "select idNotificacion, asunto, remitente, destinatario, referencia, fecha, hora, estado
                from notificacion_artista
                where idNotificacion = '" . $this->idNotificacion . "'";
    }

    public function consultarTodos()
    {
        return "select idNotificacion, asunto, remitente, destinatario, referencia, fecha, hora, estado
                from notificacion_artista
                where estado = 'SINREVISAR'";
    }

    public function consultarNotificacionArtista()
    {
        return "select idNotificacion, asunto, remitente, destinatario, referencia, fecha, hora, estado
                from notificacion_artista
                where estado = 'SINREVISAR' and destinatario = '" . $this->destinatario . "'";
    }
    
    public function consultarCantidad()
    {
        return "select count(idNotificacion)
                from notificacion_artista
                where estado = 'SINREVISAR' AND destinatario = '" . $this->destinatario . "'";
    }

    public function CambiarEstadoRevisada(){
        return "update notificacion_artista
                set estado = 'REVISADA'
                where idNotificacion = '" . $this -> idNotificacion  .  "'";
    }
}
