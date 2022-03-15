<?php

$comentario = "";

if (isset($_POST["comentario"])) {
    $comentario = $_POST["comentario"];
}

$idVersion = "";
if (isset($_POST["idVersion"])) {
    $idVersion = $_POST["idVersion"];
}

    $fecha = date('YmdHis');
    $hora = date('H:i:s');
    $coment = new Comentario("",$_POST['id'], $idVersion, $comentario, $fecha, $hora);
    $coment->insertar();

    $obra = new Obra($_POST['idObra'],"",$_POST['estado']);
    echo $obra -> editarEstado();

    $obra = new Obra($_POST['idObra']);
    $obra -> consultar();

    $ultima = new Version($idVersion);
    $ultima->consultar();

    $asunto = $asunto = "Obra: " . $ultima->getTitulo()." - ". $_POST['estado'];

    $notificar = new Notificacion_artista("", $asunto, $_POST['id'], $obra->getIdArtista(), $_POST['idObra'], $fecha, $hora, "SINREVISAR");
    $notificar->registrar();

    $critico = new Critico($_POST['id']);
    $critico->consultar();
    $log = new Log("", "Califico una version", $idVersion . "-" . $ultima->getTitulo() . "-" . $comentario . "-" . $_POST["id"] . "-" . $critico->getNombre() ." " . $critico->getApellido() . "-" . $_POST['estado'], "NOW()", "NOW()", $critico->getCorreo());
    $log->insertar();
    

?>