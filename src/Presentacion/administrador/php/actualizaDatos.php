<?php 
	$conexion = mysqli_connect('localhost', 'root', '', 'bdfocus');
	$idObra=$_POST['idObra'];
	$idArtista=$_POST['idArtista'];
	$estado=$_POST['estado'];

	$sql="UPDATE obra set idArtista='$idArtista',
								estado='$estado'
				where idObra='$idObra'";
	echo $result=mysqli_query($conexion,$sql);

	$administrador = new Administrador($_POST['idAdministrador']);
	$administrador->consultar();
	$log = new Log("", "Cambio estado de obra", $administrador->getNombre() . " " . $administrador->getApellido() . "-" . $idArtista . "-" . $idObra . "-" . $estado, "NOW()", "NOW()", $administrador->getCorreo());
	$log->insertar();
 ?>