<?php
class Notificacion_criticoDAO
{
    private $idNotificacion;
    private $asunto;
    private $remitente;
    private $referencia;    
    private $foto;
    private $estado;
    private $hora;
    private $fecha;  

    public function Notificacion_criticoDAO($idNotificacion = "", $asunto = "", $remitente = "", $referencia = "", $fecha = "", $hora = "", $estado = "")
    {
        $this-> idNotificacion = $idNotificacion;
        $this-> asunto = $asunto;
        $this-> remitente = $remitente;
        $this-> referencia = $referencia;
        $this -> fecha = $fecha;
        $this -> hora = $hora;
        $this-> estado = $estado;
    }

    public function registrar()
    {
        return "insert into notificacion_critico (idnotificacion, asunto, remitente, referencia, fecha, hora, estado) 
        VALUES (NULL, '" . $this->asunto .  "', '" . $this->remitente . "', '" . $this->referencia . "', '" . $this->fecha . "', '" . $this->hora . "', '" . $this->estado . "');";
    }
   
    public function consultar()
    {
        return "select idNotificacion, asunto, remitente, referencia, fecha, hora, estado
                from notificacion_critico
                where idNotificacion = '" . $this->idNotificacion . "'";
    }

    public function consultarTodos()
    {
        return "select idNotificacion, asunto, remitente, referencia, fecha, hora, estado
                from notificacion_critico
                where estado = 'SINREVISAR'";
    }
    
    public function consultarCantidad()
    {
        return "select count(idNotificacion)
                from notificacion_critico
                where estado = 'SINREVISAR'";
    }

    public function CambiarEstadoRevisada(){
        return "update notificacion_critico
                set estado = 'REVISADA'
                where idNotificacion = '" . $this -> idNotificacion  .  "'";
    }
}
