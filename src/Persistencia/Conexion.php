<?php
class Conexion{
    private $mysqli;
    private $resultado;

    private $conn = "";
    private $host = "db";
    private $user = "root";
    private $password = "example";
    private $database = "bdfocus";
   
    public function getResultado(){
        return $this -> resultado;
    }
    function abrir_2(){
        $this -> conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
    return $this -> conn;
    } 
    function abrir(){
        $this -> mysqli = new mysqli("db", "root", "example", "bdfocus");        
        $this -> mysqli -> set_charset("utf8");
    } 

    function cerrar(){
        $this -> mysqli -> close();
    }
    
    function ejecutar($sentencia){
        $this -> resultado = $this -> mysqli -> query($sentencia);
    }

    function ejecutar_2($sentencia){
        $result = mysqli_query($this -> mysqli,$sentencia);
		return $result;
    }
    
    function extraer(){
        return $this -> resultado -> fetch_row();
    }
    
    function numFilas(){
        return ($this -> resultado!=null)?$this -> resultado -> num_rows:0;
    }
    
    
}
?>