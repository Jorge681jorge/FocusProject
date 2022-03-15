
function cambiarCantida(cantidad){	
    
    var url = "indexAjax.php?pid="+btoa('Presentacion/critico/obras/obrasRegistradasAjax.php')+"&cantidad="+cantidad;
    $("#obrasRegistradas").load(url);
	
} 

function pagina(pagina,cantidad){	
    
    var url = "indexAjax.php?pid="+btoa('Presentacion/critico/obras/obrasRegistradasAjax.php')+"&cantidad="+cantidad+"&pagina="+pagina;
    $("#obrasRegistradas").load(url);
} 

function botonCalificar(datos,autor, idObra){	
    
    

    d=datos.split('||');
    
    $('#idVersion').val(d[0]);
    $('#idObra').val(idObra);
	$('#titulo').val(d[1]);
	$('#descripcion').val(d[2]);
	$('#valor').val(d[3]);
	//$('#foto').val(d[4]);
	$('#fecha').val(d[5]);
    $('#autor').val(autor);
                
	document.getElementById("foto").src=d[4];
}

function abrirmodal(){	  
    
        $('#modalCalificar').modal('show');        
	
}

function agregarComentario(){
    
    cadena="comentario="+$('#comentario').val()+
	"&id="+$('#iddd').val()+
    "&idVersion="+$('#idVersion').val()+
    "&idObra="+$('#idObra').val()+
    "&estado="+$('#estado').val();
        
    $.ajax({
		type:"POST",
		url:"indexAjax.php?pid="+btoa('Presentacion/critico/obras/funciones/agregarComentario.php'),
		data:cadena,
		success:function(r){
            
			if(r==1){

                var url = "indexAjax.php?pid="+btoa('Presentacion/critico/obras/obrasRegistradasAjax.php');
                $("#obrasRegistradas").load(url);								
                
                $('#modalCalificar').modal('hide');
                
               alertify.success("Se ha registrado la calificación");
			}else{
				alertify.error("Falló el servidor :(");
			}
		}
	});
}