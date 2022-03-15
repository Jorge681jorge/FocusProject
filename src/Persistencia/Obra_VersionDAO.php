<?php
class Obra_VersionDAO
{
    private $id;
    private $idObra;
    private $idVersion;

    
    public function Obra_VersionDAO($id = "", $idObra = "", $idVersion = ""){
        $this -> id = $id;
        $this -> idObra = $idObra;
        $this -> idVersion = $idVersion;
    }
    
    public function insertar()
    {
        return "insert into obra_version (idObra, idVersion)
                values ('" . $this -> idObra . "','" . $this -> idVersion . "')";
    }
    public function consultar(){
        return "select id, idObra, idVersion
                from obra_version
                where idObra = '" . $this -> idObra .  "'";
    }
    public function consultarConVersion(){
        return "select id, idObra, idVersion
                from obra_version
                where idVersion = '" . $this -> idVersion .  "'";
    }
    
    public function consultarTodos()
    {
        return "select id, idObra, idVersion
                from obra_version 
                where idObra = '" . $this -> idObra .  "'";
    }

    public function consultarUltimaVersion(){
        return "select id, idObra, idVersion
                from  obra_version 
                where idObra = '".$this-> idObra."'";
    }

   
}