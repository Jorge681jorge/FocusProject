function cambiarCantidad(cantidad) {

    var url = "indexAjax.php?pid=" + btoa('Presentacion/log/logAjax.php') + "&cantidad=" + cantidad;
    $("#tablaLog").load(url);

}

function pagina(pagina, cantidad) {

    var url = "indexAjax.php?pid=" + btoa('Presentacion/log/logAjax.php') + "&cantidad=" + cantidad + "&pagina=" + pagina;
    $("#tablaLog").load(url);

}

function botonVerLog(datos, nombre, cadena) {

    d = datos.split('||');

    if (nombre == "modalSesion") {
        a = d[2].split('-');

        $('#accionMS').val(a[0]);
        $('#nombreMS').val(a[1]);
        $('#actorMS').val(a[2]);
        $('#correoMS').val(a[3]);

    } else if (nombre == "modalEstado") {
        e = d[2].split('-');

        $('#nombreME').val(e[0]);
        $('#idArtistaME').val(e[1]);
        $('#nombreArtME').val(e[2]);
        $('#estadoME').val(e[3]);
        
    } else if (nombre == "modalObra") {
        
        c = d[2].split('-');
        
        $('#tituloMO').val(c[0]);
        $('#descripcionMO').val(c[1]);
        $('#valorMO').val(c[2]);
        $('#idVersionMO').val(c[3]);
      
        /* $('#fecha').val(c[5]); */
        
    }else if (nombre == "modalVersion") {
        f = d[2]+"-";
        c = f.split('-');
        $('#tituloMV').val(c[0]);
        $('#descripcionMV').val(c[1]);
        $('#valorMV').val(c[2]);
        $('#idArtistaMV').val(c[3]);
        $('#idVersionMV').val(c[4]);
        document.getElementById("fotoMV").src = c[5];
    }else if (nombre == "modalComentario") {
        
        c = d[2].split('-');
        $('#idVersionMC').val(c[0]);
        $('#tituloMC').val(c[1]);
        $('#comentarioMC').val(c[2]);
        $('#idCriticoMC').val(c[3]);
        $('#nombreMC').val(c[4]);
        $('#estadoMC').val(c[5]);
    }
    else if (nombre == "modalEstadoObra") {
        
        p = d[2].split('-');
        $('#nombreMEO').val(p[0]);
        $('#idArtistaMEO').val(p[1]);
        $('#idObraMEO').val(p[2]);
        $('#estadoObraMEO').val(p[3]);
    }

    nombre = "#" + nombre;
    $(nombre).modal('show');
}

function abrirModal(nombre) {
    nombre = "#" + nombre;
    $(nombre).modal('show');

}   