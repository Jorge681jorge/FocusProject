<?php
$idObra =  date('YmdHis') . $_SESSION["id"];
$titulo = "";
if (isset($_POST["tituloObra"])) {
	$titulo = $_POST["tituloObra"];
}
$descripcion = "";
if (isset($_POST["descripcionObra"])) {
	$descripcion = $_POST["descripcionObra"];
}
$valor = "";
if (isset($_POST["valorObra"])) {
	$valor = $_POST["valorObra"];
}

$fecha = date("Y-m-d");

$img_nomb = "default.png";
$src = "";
$tiempo = new DateTime();
$destino = "img/galeria/";

?>

<html>

<head>
	<link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
	<script src="librerias/alertifyjs/alertify.js"></script>
	<link rel="stylesheet" type="text/css" href="librerias/select2/css/select2.css">
</head>


<body style="background-image: url(img/fondoB.jpeg); background-size: cover">

	<div class="container mt-3">
		<div class="row">
			<div class="col-lg-3 col-md-0"></div>
			<div class="col-lg-6 col-md-12">
				<div class="card">
					<div class="card-header text-white bg-dark text-center">
						<h4>Registrar Obra</h4>
					</div>
					<div class="card-body">
						<form method="post" enctype="multipart/form-data">
							<div class="row">
								<div class="col-6">
									<div class="form-group">

										<input type="text" name="tituloObra" class="form-control" placeholder="Título" value="<?php echo $titulo ?>" required>
									</div>
									<div class="form-group">
										<textarea type="text-area" name="descripcionObra" class="form-control" placeholder="Descripción" value="<?php echo $descripcion ?>" rows="4" required></textarea>
									</div>
									<div class="form-group">
										<input type="number" name="valorObra" class="form-control" placeholder="Valor" min="1" value="<?php echo $valor ?>" required>
									</div>

								</div>
								<div class="col-6">
									<img src="img/default.png" class="img-fluid">

									<div class="custom-file form-group">
										<input type="file" name="foto" class="custom-file-input" aria-describedby="inputGroupFileAddon01" id="foto">
										<label class="custom-file-label text-center" for="inputGroupFile01">IMAGEN</label>
										<!-- <input type="file" class="form-control" name="foto" id="foto" aria-describedby="foto">
									<label class="custom-file-label form-control" for="foto">Buscar archivo</label> -->
									</div>

								</div>
								<button type="submit" name="registrar" class="btn btn-success btn-block"> <i class="fas fa-check-circle"></i> Registrar</button>
							</div>

						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="mt-3"></div>
</body>

</html>

<?php
if (isset($_POST["registrar"])) {
	if ($_FILES["foto"]["name"] != "") {
		$auxfoto = $_FILES["foto"]["tmp_name"];
		$type_foto = $_FILES["foto"]["type"];
		$img_nomb = "img_" . $titulo . $tiempo->getTimestamp() . (($type_foto == "img/png") ? ".png" : ".jpg");
		$src = $destino . $img_nomb;
		copy($auxfoto, $src);
	} else {
		$src = $destino . $img_nomb;
	}
	$obra = new Obra($idObra, $_SESSION["id"]);
	$obra->insertar();
	$resultados = $obra->insertar_2();

	if (!empty($resultados)) {

		$idVersion = time();
		$hora = date('H:i:s');
		$version = new Version($idVersion, $titulo, $descripcion, $valor, $src, $fecha, $hora, "REGISTRADA");
		$version->insertar();
		$resultados_2 = $version->insertar_2();

		if (!empty($resultados_2)) {

			//notificacion critico

			$obra_version = new Obra_Version("", $idObra, $idVersion);
			$obra_version->insertar();
			$asunto = "Revision Obra: " . $titulo;
			$notificacion_critico = new Notificacion_critico("", $asunto, $_SESSION["correo"], $idObra, $fecha, $hora, "SINREVISAR");
			$notificacion_critico->registrar();
			$no = $notificacion_critico->registrar_2();
?>
			<script>
				alertify.success("Obra registrada con exito");
			</script>

		<?php

			$artista = new Artista($_SESSION["id"]);
			$artista->consultar();
			$log = new Log("", "Registro una obra", $titulo . "-" . $descripcion . "-" . $valor . "-" . $_SESSION["id"], "NOW()", "NOW()", $artista->getCorreo());
			$log->insertar();
		} else {

		?>
			<script>
				alertify.error("Hubo un problema con la versión de la obra");
			</script>
		<?php
		}
	} else {
		?>
		<script>
			alertify.error("Hubo un problema con la versión de la obra");
		</script>
<?php
	}
}
?>