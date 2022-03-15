<?php
class ObraDAO
{
    private $idObra;
    private $idArtista;
    private $estado;

    private $conexion;
    private $obraDAO;
    
    public function ObraDAO($idObra = "", $idArtista = "", $estado = ""){
        $this -> idObra = $idObra;
        $this -> idArtista = $idArtista;
        $this -> estado = $estado;
    }
    
    public function insertar()
    {
        return "insert into obra (idObra, idArtista, estado)
                values ('" . $this -> idObra . "','" . $this -> idArtista . "','REGISTRADA')";
    }
    public function consultar(){
        return "select idObra, idArtista, estado
                from obra
                where idObra = '" . $this -> idObra .  "'";
    }
    public function consultarObrasArtista(){
        return "select idObra, idArtista, estado
                from obra where idArtista = '" . $this-> idArtista . "' ";
    }

    public function editarEstado()
    {
        return " update obra set estado='".$this -> estado."'
        WHERE idObra='". $this -> idObra ."'";
    }
    
    public function consultarTodos()
    {
        return "select idObra, idArtista, estado
                from obra";
    }
    
    
    public function consultarPaginacion($cantidad, $pagina)
    {
        return "select idObra, idArtista, estado
                from obra
                limit " . (($pagina-1) * $cantidad) . ", " . $cantidad;
    }
    public function consultarPaginacionRegistradas($cantidad, $pagina)
    {
        return "select idObra, idArtista, estado
                from obra where estado = 'REGISTRADA'
                limit " . (($pagina-1) * $cantidad) . ", " . $cantidad;
    }
    public function consultarObrasAdmitidas($cantidad, $pagina)
    {
        return "select idObra, idArtista, estado
                from obra where estado = 'ADMITIDA'
                limit " . (($pagina-1) * $cantidad) . ", " . $cantidad;
    }
    public function consultarObrasPublicadas()
    {
        return "select idObra, idArtista, estado
                from obra where estado = 'PUBLICADA'
                ";
    }

    public function consultarCantidad()
    {
        return "select count(idObra)
                from obra";
    }
    public function consultarCantidadFiltro($filtro){
        return "select count(idObra)
                from obra
                where idObra like '%" . $filtro . "%' or idArtista like '" . $filtro . "%' or estado like '" . $filtro . "%'";
    }
    public function consultarFiltro($filtro){
        return "select idObra, idArtista, estado
                from obra
                where idObra like '%" . $filtro . "%' or idArtista like '" . $filtro . "%' or estado like '" . $filtro . "%'";
    }  
}
