<?php
$conexion = mysqli_connect('localhost', 'root', '', 'bdfocus');
?>

<head>
	<link href="Style/design.css" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> <!-- link de bootstrap -->
	<script src="js/funciones.js"></script>
</head>

<div class="container ">
	<div class="row">

		<div class="col-sm-12 col-md-12 col-lg-12 mt-5">
			<div class="card f">
				<div class="card-header text-white bg-dark text-center">
					<h2 class="text-center"><i class="fas fa-clipboard-list"></i> Artistas registrados</h2>
				</div>
				<div class="card-body">

					<table class="table table-responsive-md table-responsive-sm table-responsive-lg table-responsive-xl table-hover table-condensed table-bordered tabla  table-striped" id="tabla" name="tabla">

						<tr class="bg-primary blockquote text-center text-white">
							<td class="text-center">Id</td>
							<td class="text-center">Nombre</td>
							<td class="text-center">Apellido</td>
							<td class="text-center">Correo</td>
							<td class="text-center">Estado</td>
							<td class="text-center">Servicio</td>
						</tr>

						<?php
						$sql = "SELECT idArtista,nombre,apellido,correo,estado from artista";
						$result = mysqli_query($conexion, $sql);

						while ($mostrar = mysqli_fetch_array($result)) {

							$datos = $mostrar['idArtista'] . "||" .
								$mostrar['nombre'] . "||" .
								$mostrar['apellido'] . "||" .
								$mostrar['correo'] . "||" .
								$mostrar['estado']
						?>
							<td class="text-center"><?php echo $mostrar['idArtista'] ?></td>
							<td class="text-center"><?php echo $mostrar['nombre'] ?></td>
							<td class="text-center"><?php echo $mostrar['apellido'] ?></td>
							<td class="text-center"><?php echo $mostrar['correo'] ?></td>
							<td class="text-center"><?php echo ($mostrar['estado']==1)?"Activo":( ($mostrar['estado']==0)?"Inactivo":"En proceso") ?></td>
							<td class="text-center">
								<button class="btn btn-dark glyphicon glyphicon-pencil" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos ?>')" title="Cambiar estado"><i class="far fa-edit"></i>

								</button>
							</td>

							</tr>
						<?php
						}
						?>
					</table>
				</div>
			</div>
		</div>

	</div>
	<div>
		<br><br>
	</div>
</div>
