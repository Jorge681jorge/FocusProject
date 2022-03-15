<?php
require_once "Persistencia/Conexion.php";
require_once "Logica/Comentario.php";

$conexion = new Conexion();
$conexion->abrir();
$conexion->ejecutar("insert into comentario(idUsuario, idVersion, comentario, fecha)
values ('1','12','esteEsElComentario','2020-05-07') ");
/* 
$idCritico = "";
if (isset($_POST["idCritico"])) {
    $idCritico = $_POST["idCritico"];
}

$comentario = "";
if (isset($_POST["comentario"])) {
    $comentario = $_POST["comentario"];
}

$idVersion = ;
if (isset($_POST["idVersion"])) {

    $idVersion = $_POST["idVersion"];

    $fecha = date('YmdHis');

    $coment = new Comentario("", $idCritico, $idVersion, $comentario, $fecha);
    $coment->insertar();
}
$coment = new Comentario("", "10100", "3300", "Mi Comentario", "2020-05-07");
$coment->insertar(); 
}*/

?>