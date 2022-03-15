<?php


    $notificacion = new Notificacion_artista($_POST["n"]);        
    echo $notificacion -> CambiarEstadoRevisada();


?>