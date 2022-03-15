<html>

<head>

	<link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
	<link rel="stylesheet" type="text/css" href="librerias/select2/css/select2.css">

	<script src="librerias/jquery-3.2.1.min.js"></script>
	<script src="js/funciones.js"></script>
	<script src="librerias/alertifyjs/alertify.js"></script>
	<script src="librerias/select2/js/select2.js"></script>
</head>

<body style="background-image: url(img/fondo.jpg); background-size: cover"></body>

<div class="container">

	<div id="tabla"></div>

</div>


<!-- Modal para edicion de datos -->

<div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header bg-dark text-white">
				<h4 class="modal-title" id="myModalLabel">Actualizar datos</h4>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

			</div>
			<div class="modal-body">

				<label>IdObra</label>
				<input type="text" name="" id="idObra" class="form-control input-sm " disabled>
				<label>IdArtista</label>
				<input type="text" name="" id="idArtista" class="form-control input-sm" disabled>
				<label>Estado</label>
				<select id="estado" class="form-control">
					<option value="CENSURADA">CENSURAR OBRA</option>
					<option value="PUBLICADA">PUBLICAR OBRA</option>
				</select>

			</div>
			<div class=" text-center">
				<button type="button" name="censurar" class="btn btn-success " id="censurar" data-dismiss="modal" onclick="publicarObra(<?php echo $_SESSION['id'] ?>)"><i class="fas fa-check-circle"></i> Confirmar</button>
				<button type="button" name="btnNoEnviar" class="btn btn-danger " id="btnNoEnviar" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cerrar</button>
			</div>
			<div class="mt-3"></div>
		</div>
	</div>
</div>

</html>


<script type="text/javascript">
	$(document).ready(function() {
		/* $('#tabla').load('componentes/tabla.php'); */

		var url = "indexAjax.php?pid=<?php echo base64_encode("Presentacion/administrador/componentes/tabla.php") ?>";
		$("#tabla").load(url);
	});
</script>

<!-- <script type="text/javascript">
	$(document).ready(function() {
		$('#censurar').click(function() {
			publicarObra();

		});

	});
</script> -->
