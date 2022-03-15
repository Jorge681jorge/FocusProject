<?php
class VersionDAO{
    private $idVersion;
    private $titulo;
    private $descripcion;
    private $valor;
    private $foto;
    private $fecha;
    private $hora;
    private $estado;
       
    public function VersionDAO($idVersion = "",$titulo = "", $descripcion = "", $valor = "", $foto = "", $fecha = "", $hora = "",  $estado = "" ){
        $this -> idVersion = $idVersion;
        $this -> titulo = $titulo;
        $this -> descripcion = $descripcion;
        $this -> valor = $valor;
        $this -> foto = $foto;
        $this -> fecha = $fecha;
        $this -> hora = $hora;
        $this -> estado = $estado;
       
    }
       
    public function insertar(){
        return "insert into version (idVersion, titulo, descripcion, valor, foto, fecha, hora, estado)
                values ('" . $this -> idVersion . "','" . $this -> titulo . "','" . $this -> descripcion . "', '" . $this -> valor . "', '" . $this -> foto . "', '" . $this -> fecha . "', '" . $this -> hora . "', '" . $this -> estado . "')";
    }
    public function consultar(){
        return "select idVersion, titulo, descripcion, valor, foto, fecha, hora, estado
                from version
                where idVersion = '" . $this -> idVersion . "' ";
    }
    
    public function consultarTodos(){
        return "select idVersion, titulo, descripcion, valor, foto, fecha, hora, estado
                from version";
    }
    public function consultarUltimaVersion(){
        return "select idVersion, titulo, descripcion, valor, foto, fecha, hora, estado
                from  version 
                where idVersion = '" . $this -> idVersion . "' ";
    }
    public function consultarVersiones(){
        return "select idVersion, titulo, descripcion, valor, foto, fecha, hora, estado
                from  version 
                where idVersion = '" . $this -> idVersion . "' ";
    }
    public function consultarPaginacion($cantidad, $pagina){
        return "select idVersion, titulo, descripcion, valor, foto, fecha, hora, estado
                from version
                limit " . (($pagina-1) * $cantidad) . ", " . $cantidad;
    }

    public function consultarCantidad(){
        return "select count(idVersion)
                from version";
    }
    
}

?>