<?php

$critico = new Critico($_SESSION["id"]);
$critico->consultar();
//------------------------------------------------------------------ Notificaciones
$notificacion_critico = new Notificacion_critico();
$notificaciones = $notificacion_critico -> consultarTodos();
$numMensajes = $notificacion_critico -> consultarCantidad();
//------------------------------------------------------------------

$error = 0;
if (isset($_POST["editar"])) {
	if (file_exists('ImgAd/' . $critico->getIdCritico() . $critico->getFoto())) {
		unlink('ImgAd/' . $critico->getIdCritico() . $critico->getFoto());
	}

	if (!empty($_FILES['foto']['name'])) {

		$n = $_FILES['foto']['name'];
		$tmp = $_FILES["foto"]["tmp_name"];
		$folder = 'ImgAd/' . $critico->getIdCritico();
		move_uploaded_file($tmp, $folder . $n);
	}

	$critico = new Critico($_SESSION["id"], $_POST["nombre"], $_POST["apellido"], "", "", $_FILES['foto']['name']);
	$critico->editar();
}
if (isset($_POST["editarc"])) {
	if ($critico->getContraseña() == (md5($_POST["antigua"]))) {
		$cri = new Critico($_SESSION["id"], "", "", "", $_POST["nueva"]);
		$cri->editarClave();
	} else {
		$error = 1;
		echo $critico->getContraseña();
	}
}

$critico->consultar();

?>

<body style="background-image: url(img/fondo.jpg); background-size: cover;" ></body>

<!-- Sesion -->
<div class="container mt-5" style="padding-top:100; padding-bottom: 100;">
	<div class="row">
		
<!-- Notificaciones-->
		<div class="col-sm-2 col-xl-2  mt-2 mb-2">
		</div>
		<div class="col-lg-12 col-sm-12 col-md-12 d-lg-block d-xl-block mt-2 mb-2">

			<div id="accordion">
							<div class="card f">
								<div class="card-header ">
									<a class="card-link" data-toggle="collapse" href="#collapseOne">
									<h4 >Notificaciones <?php echo "<span class='badge badge-danger'>" . "<i class='far fa-bell'></i> ". $numMensajes . "</span>"?></h4>
									</a>
								</div>
								<div id="collapseOne" name="collapseOne" class="collapse show" data-parent="#accordion">
									<div class="card-body">

									<div style="overflow-x: scroll; height: 300px !important; overflow-y: scroll;">
											<table class="table table-hover table-striped" id="tablem" name="tablem">
											<thead>
												<tr>                               
													<th>Asunto</th>
													<th>Fecha</th>
													<th>Remitente</th>                                
													<th></th>
												</tr>
											</thead>
											<tbody id="table-body">
												<?php

												foreach($notificaciones as $notificacion_Actual){
													echo "<tr>";                               
													echo "<td>" . $notificacion_Actual->getAsunto() . "</td>";
													echo "<td>" . $notificacion_Actual->getFecha() . "</td>";
													echo "<td>" . $notificacion_Actual->getRemitente() . "</td>";                                
													echo "<td><a href=index.php?pid=".base64_encode('Presentacion/critico/obras/obrasRegistradas.php').'&idNotificacion='.$notificacion_Actual->getIdNotificacion().'&idObra='.$notificacion_Actual->getReferencia()."><i class='fas fa-eye'></i></a></td>";
													echo "</tr>";
													
												}
												?>
											</tbody> 
											</table>
										</div>


									</div>
								</div>
							</div>

					</div>
					
			</div>


		</div>
		
	</div>
</div>

<!-- Modal edicion informacion -->
<div class="modal fade" id="Informacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edita tu información</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="index.php?pid=<?php echo base64_encode("presentacion/Critico/sesionCritico.php") ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" name="nombre" class="form-control" value="<?php echo $critico->getNombre() ?>" required>
					</div>
					<div class="form-group">
						<label>Apellido</label>
						<input type="text" name="apellido" class="form-control" value="<?php echo $critico->getApellido() ?>" required>
					</div>
					<label>Foto de perfil</label>
					<div class="input-group mb-3">
						<div class="custom-file">
							<input name="foto" type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
							<label class="custom-file-label" for="inputGroupFile01">Imagen</label>
						</div>
					</div>
					<button type="submit" name="editar" class="btn btn-info">Editar</button>
				</form>
				<?php if (isset($_POST["editar"])) { ?>
					<script>
						$('#Informacion').modal('show');
					</script>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						Informacion editada
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>

</div>

<!-- Modal edicion contraseña-->

<div class="modal fade" id="Clave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edita tu contraseña</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<form action="index.php?pid=<?php echo base64_encode("presentacion/Critico/sesionCritico.php") ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Contraseña actual</label>
						<input type="password" name="antigua" class="form-control" value="" required>
					</div>
					<div class="form-group">
						<label>Nueva contraseña</label>
						<input type="password" name="nueva" class="form-control" value="" required>
					</div>
					<button type="submit" name="editarc" class="btn btn-info">Editar</button>
				</form>
				<?php if (isset($_POST["editarc"])) { ?>
					<script>
						$('#Clave').modal('show');
					</script>
					<?php
					if ($error != 0) {
					?>
						<span aria-hidden="false"></span>
						<div class="alert alert alert-danger alert-dismissible fade show" role="alert">
							La contraseña no coincide
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
					<?php
					} else {
					?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							Contraseña editada
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
				<?php
					}
				}
				?>
			</div>
		</div>
	</div>

</div>


<script>

	jQuery('#accordion').accordion({        
    active:0,
});

</script>