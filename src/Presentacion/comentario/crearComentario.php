<?php
require_once "Logica/Comentario.php";

$idCritico = "";
if (isset($_POST["idCritico"])) {
    $idCritico = $_POST["idCritico"];
}

$comentario = "";
if (isset($_POST["comentario"])) {
    $comentario = $_POST["comentario"];
}

$idVersion = "";
$idVersion = $_POST["id"];

$fecha = date('YmdHis');


if (isset($_POST["id"])) {

    $coment = new Comentario("", $idCritico, $idVersion, $comentario, $fecha, 'NOW()');
    $coment->insertar();
    
}