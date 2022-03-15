<!-- <link  href="Style/design.css" rel="stylesheet"> -->
<?php
$analista = new Analista($_SESSION["id"]);
$analista->consultar();
?>

<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="Style/design.css" rel="stylesheet">
</head>
<nav class="navbar sticky-top navbar-expand-md navbar-dark">
	<div class="container text-light">
		<div class="contenido-nav">
			<a class="navbar-brand" href="index.php?pid=<?php echo base64_encode("Presentacion/analista/sesionAnalista.php") ?>">
				<strong class="text-light display-4">
					<img src="img/logo.png" class="img-fluid" style="height: 100px;"> Focus</strong></a>
		</div>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <ion-icon name="menu-outline"></ion-icon>
        </button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav ml-auto">
		<a  class="nav-link active" href="index.php?pid=<?php echo base64_encode("Presentacion/analista/explorar.php") ?>"><i class="fas fa-palette"></i> Exhibición</a>
			<li class="nav-item dropdown active"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-book"></i> Reportes</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="reporteArtistas.php" target="_blank"><i class="fas fa-user-friends"></i> Artistas</a>
					<a class="dropdown-item" href="reporteObras.php" target="_blank"><i class="fas fa-palette"></i> Obras</a>
					<a class="dropdown-item" href="grafica.php" target="_blank"><i class="fas fa-chart-bar"></i> Graficas</a>
				</div>
			</li>
			
				<li class="nav-item dropdown active">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-user"></i> <?php echo $analista->getNombre() ?> <?php echo $analista->getApellido() ?></a>

						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Presentacion/analista/perfilAnalista.php") ?>"><i class="fas fa-user"></i> Mi perfil</a>
						<a class="dropdown-item" href="index.php?cerrarSesion=true"><i class="fas fa-sign-out-alt"></i> Cerrar Sesion</a>

					</div>


			</ul>

		</div>
</nav>