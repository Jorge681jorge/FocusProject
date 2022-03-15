function agregaform(datos){

	d=datos.split('||');

	$('#idArtista').val(d[0]);
	$('#nombre').val(d[1]);
	$('#apellido').val(d[2]);
	$('#correo').val(d[3]);
	$('#estado').val(d[4]);
	
}
function agregaformObra(datos){

	d=datos.split('||');
	$('#idObra').val(d[0]);
	$('#idArtista').val(d[1]);
	$('#estado').val(d[2]);
	
}

function actualizaDatos(idAdministrador){
	
	idArtista=$('#idArtista').val();
	nombre=$('#nombre').val();
	apellido=$('#apellido').val();
	correo=$('#correo').val();
	estado=$('#estado').val();

	cadena= "idArtista=" + idArtista +
			"&nombre=" + nombre + 
			"&apellido=" + apellido +
			"&correo=" + correo +
			"&idAdministrador=" + idAdministrador +
			"&estado=" + estado;

	$.ajax({
		type:"POST",
		url:"indexAjax.php?pid="+btoa('Presentacion/artista/php/actualizaDatos.php'),
		data:cadena,
		success:function(r){
			
			if(r==1){
				$('#tabla').load('Presentacion/artista/componentes/tabla.php');
				alertify.success("Datos actualizados");
			}else{
				alertify.error("Error en el servidor");
			}
		}
	});
}

function publicarObra(idAdministrador){


	idObra=$('#idObra').val();
	idArtista=$('#idArtista').val();
	estado=$('#estado').val();

	cadena= "idObra=" + idObra +
			"&idArtista=" + idArtista + 
			"&idAdministrador=" + idAdministrador +
			"&estado=" + estado;

	$.ajax({
		type:"POST",
		url:"indexAjax.php?pid="+btoa('Presentacion/administrador/php/actualizaDatos.php'),
		data:cadena,
		success:function(r){
			
			if(r==1){
				$('#tabla').load('Presentacion/administrador/componentes/tabla.php');
				alertify.success("Actualizado con exito");
			}else{
				alertify.error("Error en el servidor :(");
			}
		}
	});

}
