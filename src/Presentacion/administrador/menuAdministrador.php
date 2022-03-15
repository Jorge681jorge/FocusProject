<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="Style/design.css" rel="stylesheet">
</head>
<?php
$administrador = new Administrador($_SESSION["id"]);
$administrador->consultar();
?>
<nav class="navbar navbar-expand-lg sticky-top ">
	<div class="container text-light ">
		<div class="contenido-nav">
			<a class="navbar-brand" href="index.php?pid=<?php echo base64_encode("Presentacion/administrador/sesionAdministrador.php") ?>">
				<strong class="text-light display-4">
					<img src="img/logo.png" class="img-fluid" style="height: 100px;"> Focus</strong></a>
		</div>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <ion-icon name="menu-outline"></ion-icon>
        </button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active">
					<a class="nav-link" href="index.php?pid=<?php echo base64_encode("Presentacion/administrador/sesionAdministrador.php") ?>"><i class="fas fa-home"></i> Inicio</a>
				</li>
				<a class="nav-link" href="index.php?pid=<?php echo base64_encode("Presentacion/artista/consultarArtista.php") ?>"><i class="far fa-address-book"></i> Artistas</a>
				<a class="nav-link" href="index.php?pid=<?php echo base64_encode("Presentacion/administrador/obrasAdmitidas.php") ?>"><i class="fas fa-clipboard-list"></i> Obras admitidas</a>
				<a class="nav-link" href="index.php?pid=<?php echo base64_encode("Presentacion/log/log.php") ?>"><i class="fas fa-clipboard-list"></i> Log</a>
				<a class="nav-link" href="index.php?pid=<?php echo base64_encode("Presentacion/administrador/explorar.php") ?>"><i class="fas fa-palette"></i> Exhibición</a>

			</ul>
			<ul class="navbar-nav">
				<li class="nav-item dropdown active">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-user"></i> <?php echo $administrador->getNombre() ?> <?php echo $administrador->getApellido() ?></a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Presentacion/administrador/perfilAdministrador.php") ?>"><i class="fas fa-user"></i> Mi perfil</a>
						<a class="dropdown-item" href="index.php?cerrarSesion=true"><i class="fas fa-sign-out-alt"></i> Cerrar Sesion</a>

					</div>
				</li>

			</ul>
		</div>
</nav>