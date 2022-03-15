<?php
$correo = $_POST["correo"];
$clave = $_POST["clave"];
$administrador = new Administrador("", "", "", $correo, $clave);
$artista = new Artista("", "", "", $correo, $clave);
$critico = new Critico("", "", "", $correo, $clave);
$analista = new Analista("", "", "", $correo, $clave);

if ($administrador->autenticar()) {
    $_SESSION["id"] = $administrador->getIdAdministrador();
    $_SESSION["rol"] = "Administrador";
    $_SESSION["correo"] = $correo;

    $administrador = new Administrador($_SESSION["id"]);
    $administrador->consultar();
    $log = new Log("", "Inicio sesion","Inició sesión" . "-" . $administrador->getNombre() . " " . $administrador->getApellido() . "-" . "ADMINISTRADOR" . "-" . $correo, "NOW()", "NOW()", $correo);
    $log->insertar();

    #header("Location: http://localhost/index.php?pid=" . base64_encode("Presentacion/administrador/sesionAdministrador.php"));
    ?> 
        <script> window.location.href='index.php?pid="<?php echo(base64_encode("Presentacion/administrador/sesionAdministrador.php"))?>"'</script>
    <?php

} else if ($artista->autenticar()) {
    if ($artista->getEstado() == -1) {
        #header("Location: http://localhost/index.php?error=2");
        ?> 
        <script> window.location.href='index.php?error=2'</script>
        <?php
    } else if ($artista->getEstado() == 0) {
        #header("Location: http://localhost/index.php?error=3");
        ?> 
        <script> window.location.href='index.php?error=3'</script>
        <?php
    } else {
        $_SESSION["id"] = $artista->getIdArtista();
        $_SESSION["rol"] = "Artista";
        $_SESSION["correo"] = $correo;

        $artista = new Artista($_SESSION["id"]);
        $artista->consultar();
        $log = new Log("", "Inicio sesion","Inició sesión" . "-" . $artista->getNombre() . " " . $artista->getApellido() . "-" . "ARTISTA" . "-" . $correo, "NOW()", "NOW()", $correo);
        $log->insertar();

        #header("Location: http://localhost/index.php?pid=" . base64_encode("Presentacion/artista/sesionArtista.php"));
        ?> 
        <script> window.location.href='index.php?pid="<?php echo(base64_encode("Presentacion/artista/sesionArtista.php"))?>"'</script>
        <?php
    }
} else if ($critico->autenticar()) {

    $_SESSION["id"] = $critico->getIdCritico();
    $_SESSION["rol"] = "Critico";
    $_SESSION["correo"] = $correo;

    $critico = new Critico($_SESSION["id"]);
    $critico->consultar();
    $log = new Log("", "Inicio sesion","Inició sesión" . "-" . $critico->getNombre() . " " . $critico->getApellido() . "-" . "CRITICO" . "-" . $correo, "NOW()", "NOW()", $correo);
    $log->insertar();

    #header("Location: http://localhost/index.php?pid=" . base64_encode("Presentacion/critico/sesionCritico.php"));
    ?> 
    <script> window.location.href='index.php?pid="<?php echo(base64_encode("Presentacion/critico/sesionCritico.php"))?>"'</script>
    <?php

} else if ($analista->autenticar()) {

    $_SESSION["id"] = $analista->getIdAnalista();
    $_SESSION["rol"] = "Analista";
    $_SESSION["correo"] = $correo;

    $analista = new Analista($_SESSION["id"]);
    $analista->consultar();
    $log = new Log("", "Inicio sesion","Inició sesión" . "-" . $analista->getNombre() . " " . $analista->getApellido() . "-" . "ANALISTA" . "-" . $correo, "NOW()", "NOW()", $correo);
    $log->insertar();

    #header("Location: http://localhost/index.php?pid=" . base64_encode("Presentacion/analista/sesionAnalista.php"));
    ?> 
    <script> window.location.href='index.php?pid="<?php echo(base64_encode("Presentacion/analista/sesionAnalista.php"))?>"'</script>
    <?php

} else {
    #header("Location: http://localhost/index.php?error=1");
    ?> 
    <script> window.location.href='index.php?error=1'</script>
    <?php
}
