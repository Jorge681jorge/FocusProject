<?php
require_once "Persistencia/Conexion.php";
require_once "Persistencia/Notificacion_artistaDAO.php";
class Notificacion_artista{
    private $idNotificacion;
    private $asunto;
    private $remitente;
    private $destinatario;
    private $referencia;
    private $fecha;  
    private $hora;   
    private $estado;      
     

    private $conexion;
    private $Notificacion_artistaDAO;

    public function getIdNotificacion(){
        return $this -> idNotificacion;
    }

    public function getAsunto(){
        return $this -> asunto;
    }

    public function getRemitente(){
        return $this -> remitente;
    }

    public function getDestinatario(){
        return $this -> destinatario;
    }

    public function getReferencia(){
        return $this -> referencia;
    }

    public function getEstado(){
        return $this -> estado;
    }
    
    public function getFecha(){
        return $this -> fecha;
    }
    public function getHora(){
        return $this -> hora;
    }
    

    public function Notificacion_artista($idNotificacion = "", $asunto = "", $remitente = "", $destinatario = "", $referencia = "", $fecha = "", $hora="", $estado = ""){
        $this -> idNotificacion = $idNotificacion;
        $this -> asunto = $asunto;
        $this -> remitente = $remitente;
        $this -> destinatario = $destinatario;
        $this -> referencia = $referencia;       
        $this -> fecha = $fecha;
        $this -> hora = $hora;
        $this -> estado = $estado;
        $this -> conexion = new Conexion();
        $this -> notificacion_artistaDAO = new Notificacion_artistaDAO($this -> idNotificacion, $this -> asunto, $this -> remitente, $this -> destinatario, $this -> referencia, $this -> fecha, $this -> hora, $this -> estado);
    }
   
    public function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> notificacion_artistaDAO -> registrar());
        $this -> conexion -> cerrar();                 
    }
    
    public function registrar_2(){
     
     return($this -> notificacion_artistaDAO -> registrar());
     
    }

    public function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> notificacion_artistaDAO -> consultar());
        $this -> conexion -> cerrar();
        $resultado = $this -> conexion -> extraer();
        $this -> idNotificacion = $resultado[0];
        $this -> asunto = $resultado[1];
        $this -> remitente = $resultado[2];
        $this -> destinatario = $resultado[3];
        $this -> referencia = $resultado[4];
        $this -> fecha = $resultado[5];
        $this -> hora = $resultado[6];
        $this -> estado = $resultado[7];       
    }

    public function consultarTodos(){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> notificacion_artistaDAO -> consultarTodos());
        $notificaciones = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $n = new Notificacion_artista($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4], $resultado[5], $resultado[6], $resultado[7]);
            array_push($notificaciones, $n);
        }
        $this -> conexion -> cerrar();
        return $notificaciones;
    }

    public function consultarNotificacionArtista(){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> notificacion_artistaDAO -> consultarNotificacionArtista());
        $notificaciones = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $n = new Notificacion_artista($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4], $resultado[5], $resultado[6], $resultado[7]);
            array_push($notificaciones, $n);
        }
        $this -> conexion -> cerrar();
        return $notificaciones;
    }
     
    public function consultarCantidad(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> notificacion_artistaDAO -> consultarCantidad());
        $this -> conexion -> cerrar();
        return $this -> conexion -> extraer()[0];
    }

    public function CambiarEstadoRevisada(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> notificacion_artistaDAO -> CambiarEstadoRevisada());
        $this -> conexion -> cerrar();
        return  $this -> conexion -> getResultado();
    }
}
