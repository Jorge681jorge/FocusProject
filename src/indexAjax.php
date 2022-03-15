
<?php
    date_default_timezone_set ("America/Bogota");
    
    require_once "Logica/Administrador.php";
    require_once "Logica/Artista.php";
    require_once "Logica/Obra.php";
    require_once "Logica/Comentario.php";
    require_once "Logica/Obra_Version.php";
    require_once "Logica/Version.php";
    require_once "Logica/Notificacion_critico.php";
    require_once "Logica/Notificacion_artista.php";
    require_once "Logica/Log.php";
    require_once "Logica/Critico.php";

    include base64_decode($_GET["pid"]);  

?>