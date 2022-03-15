<!DOCTYPE html>
<html>

<head>

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">


	<link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
	<link rel="stylesheet" type="text/css" href="librerias/select2/css/select2.css">

	<script src="librerias/jquery-3.2.1.min.js"></script>
	<script src="js/funciones.js"></script>
	<script src="librerias/alertifyjs/alertify.js"></script>
	<script src="librerias/select2/js/select2.js"></script>
</head>

<body style="background-image: url(img/fondo.jpg);
background-size: cover">



	<div class="container">

		<div id="tabla"></div>

	</div>


	<!-- Modal para edicion de datos -->

	<div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<form method="POST">
					<div class="modal-header bg-dark text-white">
						<h4 class="modal-title" id="myModalLabel">Actualizar datos</h4>
						<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

					</div>
					<div class="modal-body">
						<input type="text" hidden="" id="idArtista" name="">
						<label>Nombre</label>
						<input type="text" name="" id="nombre" class="form-control input-sm " disabled>
						<label>Apellido</label>
						<input type="text" name="" id="apellido" class="form-control input-sm" disabled>
						<label>Correo</label>
						<input type="text" name="" id="correo" class="form-control input-sm" disabled>
						<label>Estado</label>
						<select class="custom-select custom-select-md mb-3 form-control" id="estado">
							<option value="1">Activo</option>
							<option value="0">Inactivo</option>
						</select>

					</div>
					<div class="modal-footer">
						<button type="submit" name="actualizadatos" class="btn btn-success form-control" id="actualizadatos" data-dismiss="modal" onclick="actualizaDatos(<?php echo $_SESSION['id'] ?>)">Actualizar</button>

					</div>
				</form>
			</div>
		</div>
	</div>
</body>

</html>


<script type="text/javascript">
	$(document).ready(function() {
		/* $('#tabla').load('componentes/tabla.php'); */
		var url = "indexAjax.php?pid=<?php echo base64_encode("Presentacion/artista/componentes/tabla.php") ?>";
		$("#tabla").load(url);
	});
</script>

<!-- <script type="text/javascript">
	$(document).ready(function() {

		$('#actualizadatos').click(function() {

			/* actualizaDatos(); */
		});

	});
</script> -->



<!-- functionOne(); -->