<?php 
	$conexion = mysqli_connect('localhost', 'root', '', 'bdfocus');
	$idArtista=$_POST['idArtista'];
	$nombre=$_POST['nombre'];
	$apellido=$_POST['apellido'];
	$correo=$_POST['correo'];
	$estado=$_POST['estado'];

	$sql="UPDATE artista set nombre='$nombre',
								apellido='$apellido',
								correo='$correo',
								estado='$estado'
				where idArtista='$idArtista'";
	echo $result=mysqli_query($conexion,$sql);
	
	$administrador = new Administrador($_POST['idAdministrador']);
	$administrador->consultar();
	$log = new Log("", "Cambio estado", $administrador->getNombre() . " " . $administrador->getApellido() . "-" . $idArtista . "-" . $nombre ." " . $apellido . "-" . $estado, "NOW()", "NOW()", $administrador->getCorreo());
	$log->insertar();
 ?>



	