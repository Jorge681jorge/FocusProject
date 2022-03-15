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
					<h2 class="text-center"><i class="fas fa-clipboard-list"></i> Control de obras</h2>
				</div>
				<div class="card-body">

					<table class="table table-responsive-md table-responsive-sm table-responsive-lg table-responsive-xl table-hover table-condensed table-bordered tabla  table-striped" id="tabla" name="tabla">

						<tr class="bg-primary blockquote text-center text-white">
						<td class="text-center">Id de la obra</td>
							<td class="text-center">Id del artista</td>
							<td class="text-center">Estado</td>
							<td class="text-center">Servicio</td>
						</tr>

						<?php
						$sql = "SELECT idObra, idArtista, estado FROM obra WHERE estado='PUBLICADA' or estado='CENSURADA' ";
						$result = mysqli_query($conexion, $sql);

						while ($mostrar = mysqli_fetch_array($result)) { 

							$datos = $mostrar['idObra'] . "||" .
								$mostrar['idArtista'] . "||" .
								$mostrar['estado']
						?>
							<td class="text-center"><?php echo $mostrar['idObra'] ?></td>
							<td class="text-center"><?php echo $mostrar['idArtista'] ?></td>
							<td class="text-center"><?php echo $mostrar['estado'] ?></td>
							<td class="text-center">
								<button class="btn btn-dark glyphicon glyphicon-pencil" data-toggle="modal" data-target="#modalEdicion" 
								onclick="agregaformObra('<?php echo $datos ?>')" title="Cambiar estado de obra"><i class="far fa-edit"></i>

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