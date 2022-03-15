function crearComentario(idVersion, idCritico, comentario) {

    alert("holaa" + idVersion + idCritico + comentario ); /* btoa encripta en javascript */

    cadena = "id=" + id + "&comentario" + comentario + "&idCritico=" + idCritico;
    $.ajax({
        type: "POST",
        url: "crearComentario.php",
        data: cadena,
        success: function (r) {
            if (r != 1) {
                alert("Hubo un error con tu comentario :(");
            }
        }

    });

}