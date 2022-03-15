<?php
$artista = new Artista($_SESSION["id"]);
$artista->consultar();
$items = 1;
if ($artista->getNombre() != "") {
	$items++;
}
if ($artista->getApellido() != "") {
	$items++;
}
if ($artista->getFoto() != "") {
	$items++;
}
$porcentaje = $items / 4 * 100;

//------------------------------------------------------------------ Notificaciones
$notificacion_artista = new Notificacion_artista("","","",$_SESSION["id"]);
$notificaciones = $notificacion_artista -> consultarNotificacionArtista();
$numMensajes = $notificacion_artista -> consultarCantidad();
//------------------------------------------------------------------

$fecha = date('Y-m-d  H:i:s');
$datetime2 = new DateTime($fecha);

?>

<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="Style/design.css" rel="stylesheet">
</head>

<nav class="navbar navbar-expand-lg sticky-top ">
	<div class="container text-light ">
		<div class="contenido-nav">
			<a class="navbar-brand" href="index.php?pid=<?php echo base64_encode("Presentacion/artista/sesionArtista.php") ?>">
				<strong class="text-light display-4">
					<img src="img/logo.png" class="img-fluid" style="height: 100px;"> Focus</strong></a>
		</div>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <ion-icon name="menu-outline"></ion-icon>
        </button>
		
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			
			<ul class="navbar-nav ml-auto">				
			

			</ul>

			<ul class="navbar-nav ml-auto">
				
				<li class="nav-item active">
					<a class="nav-link" href="index.php?pid=<?php echo base64_encode("Presentacion/artista/sesionArtista.php") ?>"><i class="fas fa-home"></i> Inicio</a>
				</li>
				<li class="nav-item dropdown">
					
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">											
					<span class="badge badge-pill badge-warning"> <?php echo $numMensajes ?> <i class="far fa-bell"></i></span>					
					</a>
					
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					
					<?php 
						if($numMensajes==0){
							echo "<a class='dropdown-item'>No tienes Notificaciones</a>" ;
							
						}else{

							foreach($notificaciones as $notificacion_Actual){
								
								$datetime1 = new DateTime($notificacion_Actual->getFecha()." ".$notificacion_Actual->getHora());
								$interval = $datetime1->diff($datetime2);
								?>	
								<a class="dropdown-item"  onclick="n(<?php echo $notificacion_Actual->getIdNotificacion() ?>)" href="index.php?pid=<?php echo base64_encode('Presentacion/obra/registrarVersion.php').'&idObra='.$notificacion_Actual->getReferencia()?>" >
								<span class="badge badge-pill badge-warning"><i class="fas fa-envelope"></i></span>
									<?php echo $notificacion_Actual -> getAsunto() . " - " . $interval->format('hace %a dias y %H:%I:%S Segundos');?>
								</a>
						<?php						
							}
						}?>												
					
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-image"></i> Obra
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item " href="index.php?pid=<?php echo base64_encode("Presentacion/artista/obrasArtista.php") ?>"><i class="fas fa-book"></i> Mis obras</a>
						<a class="dropdown-item " href="index.php?pid=<?php echo base64_encode("Presentacion/obra/registrarObra.php") ?>"><i class="far fa-plus-square"></i> Registrar obra</a>
					</div>
				</li>
				
				<li class="nav-item dropdown active">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="badge badge-danger"><?php echo $porcentaje . "%" ?></span>
						<?php echo ($artista->getNombre() != "" ? $artista->getNombre() : $artista->getCorreo()) ?> <?php echo $artista->getApellido() ?></a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Presentacion/artista/perfilArtista.php") ?>"><i class="fas fa-user"></i> Mi perfil</a>
						<a class="dropdown-item" href="index.php?cerrarSesion=true"><i class="fas fa-sign-out-alt"></i> Cerrar Sesion</a>

					</div>
				</li>

			</ul>
		</div>
	</div>
</nav>

<script>

	function n(n) {
		
		cadena="&n="+n;
        
    $.ajax({
		type:"POST",
		url:"indexAjax.php?pid="+btoa('Presentacion/artista/php/actualizarNotificacion.php'),
		data:cadena,
		success:function(r){
            			
		}
	});

    }  

</script>

