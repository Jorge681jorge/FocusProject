<!-- <link  href="Style/design.css" rel="stylesheet"> -->
<?php
$critico = new Critico($_SESSION["id"]);
$critico->consultar();

$items = 1;
if ($critico->getNombre() != "") {
    $items++;
}
if ($critico->getApellido() != "") {
    $items++;
}
if ($critico->getFoto() != "") {
    $items++;
}
$porcentaje = $items / 4 * 100;

$color = 'badge-danger';
if ($items >= 3) {
    $color = 'badge-success';
} elseif ($items >= 2) {
    $color = 'badge-primary';
} elseif ($items >= 1) {
    $color = 'badge-danger';
}


?>

<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="Style/design.css" rel="stylesheet">
</head>
<nav class="navbar  navbar-expand-md navbar-dark">  <!-- sticky-top -->
    <div class="container text-light">
        <div class="contenido-nav">
            <a class="navbar-brand" href="index.php?pid=<?php echo base64_encode("Presentacion/critico/sesionCritico.php") ?>">
                <strong class="text-light display-4">
                    <img src="img/logo.png" class="img-fluid" style="height: 100px;"> Focus</strong></a>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <ion-icon name="menu-outline"></ion-icon>
        </button>

        
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                <a class="nav-link" href="index.php?pid=<?php echo base64_encode("Presentacion/critico/sesionCritico.php") ?>"><i class="fas fa-home"></i> Inicio</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?pid=<?php echo base64_encode("Presentacion/critico/obras/obrasRegistradas.php"); ?>"><i class="fas fa-clipboard-list"></i> Obras registradas</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?pid=<?php echo base64_encode("Presentacion/critico/explorar.php"); ?>"><i class="fas fa-palette"></i> Exhibición</a>
                </li>


                <li class="nav-item dropdown active">
					<a class="nav-link dropdown-toggle" href="index.php?pid=<?php echo base64_encode("Presentacion/critico/sesionCritico.php"); ?>"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i> <?php echo ($critico->getNombre() != "") ? $critico->getNombre() : $critico->getCorreo();
                        if ($porcentaje != 100) {
                            echo "<span class='badge " . $color . "'>" . $porcentaje . '%' . "</span>";
                        }
                        ?></a>

					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Presentacion/critico/perfilCritico.php") ?>"><i class="fas fa-user"></i> Mi perfil</a>
						<a class="dropdown-item" href="index.php?cerrarSesion=true") ?><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
					</div>
				</li>
                
            </ul>
        </div>
    </div>
</nav>