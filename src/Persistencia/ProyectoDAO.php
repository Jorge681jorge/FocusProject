<?php
class ProyectoDAO{
    private $idProyecto;
    private $idArtista;
    private $titulo;
    private $descripcion;
       

    public function ProyectoDAO($idProyecto = "", $idArtista = "", $titulo = "", $descripcion = ""){
        $this -> idProyecto = $idProyecto;
        $this -> idArtista = $idArtista;
        $this -> titulo = $titulo;
        $this -> descripcion = $descripcion;        
    }

       
    public function insertar(){
        return "insert into proyecto (idProyecto, idArtista, titulo, descripcion)
                values ('" . $this -> idProyecto . "','" . $this -> idArtista . "','" . $this -> titulo . "','" . $this -> descripcion . "')";
    }
    
    public function consultarTodos(){
        return "select idProyecto, idArtista, titulo, descripcion
                from proyecto";
    }
    
    public function consultarPaginacion($cantidad, $pagina){
        return "select idProyecto, idArtista, titulo, descripcion
                from proyecto
                limit " . (($pagina-1) * $cantidad) . ", " . $cantidad;
    }

    public function consultarCantidad(){
        return "select count(idProyecto)
                from proyecto";
    }
    
}

?>