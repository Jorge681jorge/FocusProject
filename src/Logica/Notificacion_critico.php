<?php
require_once "Persistencia/Conexion.php";
require_once "Persistencia/Notificacion_criticoDAO.php";
class Notificacion_critico{
    private $idNotificacion;
    private $asunto;
    private $remitente;
    private $referencia;
    private $fecha;  
    private $hora;   
    private $estado;      
     

    private $conexion;
    private $Notificacion_criticoDAO;

    public function getIdNotificacion(){
        return $this -> idNotificacion;
    }

    public function getAsunto(){
        return $this -> asunto;
    }

    public function getRemitente(){
        return $this -> remitente;
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
    

    public function Notificacion_critico($idNotificacion = "", $asunto = "", $remitente = "", $referencia = "", $fecha = "", $hora="", $estado = ""){
        $this -> idNotificacion = $idNotificacion;
        $this -> asunto = $asunto;
        $this -> remitente = $remitente;
        $this -> referencia = $referencia;       
        $this -> fecha = $fecha;
        $this -> hora = $hora;
        $this -> estado = $estado;
        $this -> conexion = new Conexion();
        $this -> notificacion_criticoDAO = new Notificacion_criticoDAO($this -> idNotificacion, $this -> asunto, $this -> remitente, $this -> referencia, $this -> fecha, $this -> hora, $this -> estado);
    }
   
    public function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> notificacion_criticoDAO -> registrar());
        $this -> conexion -> cerrar();         
    }
    
    public function registrar_2(){
     
     return($this -> notificacion_criticoDAO -> registrar());
     
    }

    public function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> notificacion_criticoDAO -> consultar());
        $this -> conexion -> cerrar();
        $resultado = $this -> conexion -> extraer();
        $this -> idNotificacion = $resultado[0];
        $this -> asunto = $resultado[1];
        $this -> remitente = $resultado[2];
        $this -> referencia = $resultado[3];
        $this -> fecha = $resultado[4];
        $this -> hora = $resultado[5];
        $this -> estado = $resultado[6];       
    }

    public function consultarTodos(){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> notificacion_criticoDAO -> consultarTodos());
        $notificaciones = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $n = new Notificacion_critico($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4], $resultado[5], $resultado[6]);
            array_push($notificaciones, $n);
        }
        $this -> conexion -> cerrar();
        return $notificaciones;
    }
    
    public function consultarCantidad(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> notificacion_criticoDAO -> consultarCantidad());
        $this -> conexion -> cerrar();
        return $this -> conexion -> extraer()[0];
    }

    public function CambiarEstadoRevisada(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> notificacion_criticoDAO -> CambiarEstadoRevisada());
        $this -> conexion -> cerrar();
    }
}
