<?php
session_start();
date_default_timezone_set ("America/Bogota");
require_once "Logica/Administrador.php";
require_once "Logica/Artista.php";
require_once "Logica/Critico.php";
require_once "Logica/Obra.php";
require_once "Logica/Obra_Version.php";
require_once "Logica/Version.php";
require_once "Logica/Comentario.php";
require_once "Logica/Notificacion_critico.php";
require_once "Logica/Analista.php";
require_once "Logica/Log.php";
require_once "Logica/Notificacion_critico.php";
require_once "Logica/Notificacion_artista.php";


$pid = "";
if (isset($_GET["pid"])) {
	$pid = base64_decode($_GET["pid"]);
} else {
	$_SESSION["id"] = "";
	$_SESSION["rol"] = "";
}
if (isset($_GET["cerrarSesion"]) || !isset($_SESSION["id"])) {
	$_SESSION["id"] = "";
}
?>
<html>

<head>
	<link rel="icon" type="image/png" href="img/logo.png" />
	<title>Focus</title>
	<link rel="stylesheet" href="css/estilos.css" />

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.1/css/all.css" />

	<script src="https://code.jquery.com/jquery-3.4.1.js" ></script><!-- link de jquery -->
	<!-- <script src="funciones.js"></script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>

	<script>
	$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
	})
	</script>

	
<script src="https://www.gstatic.com/charts/loader.js"> </script><!-- links de graficos -->
	<script src="https://www.google.com/jsapi"> </script>

</head>

<body>

	<?php

	$paginasSinSesion = array(
		"Presentacion/autenticar.php",
		"Presentacion/artista/registrarArtista.php",

	);
	if (in_array($pid, $paginasSinSesion)) {
		include $pid;
	} else if ($_SESSION["id"] != "") {

		if ($_SESSION["rol"] == "Administrador") {
			include "Presentacion/administrador/menuAdministrador.php";
		} else if ($_SESSION["rol"] == "Artista") {
			include "Presentacion/artista/menuArtista.php";
		}  else if ($_SESSION["rol"] == "Critico") {
			include "Presentacion/critico/menuCritico.php";			
		}  else if ($_SESSION["rol"] == "Analista") {
			include "Presentacion/analista/menuAnalista.php";			
		}
		include $pid;

	} else {
		include "Presentacion/navegacion.php";
		include "Presentacion/inicio.php";
	}
	include "Presentacion/footer.php";
	/* Aqui footer  archivo php */
	?>

</body>

</html>