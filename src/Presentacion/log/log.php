<head>
    <script src="Presentacion/log/funciones.js"></script>
</head>

<body style="background-image: url(img/fondoB.jpeg); background-size: cover">
    <div class="container text-white mt-5 ">
        <div class="">
            <input type="text" id="filtro" name="filtro" class="form-control" placeholder="Buscar actividad">
        </div>
    </div>
    <div id="tablaLog" class="mb-5"></div>

</body>



<!-- Modal de inicio sesion -->

<div class="modal" tabindex="-1" role="dialog" id="modalSesion">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Inició sesión</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    x
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <label><strong>Acción</strong></label>
                    <input disabled type="text" class="form-control input-sm-2" id="accionMS">
                    <label><strong>Nombre</strong></label>
                    <input disabled type="text" class="form-control input-sm-2" id="nombreMS">
                    <label><strong>Actor</strong></label>
                    <input disabled type="text" class="form-control input-sm-2" id="actorMS">
                    <label><strong>Correo</strong></label>
                    <input disabled type="text" class="form-control input-sm-2" id="correoMS">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Estado -->

<div class="modal" tabindex="-1" role="dialog" id="modalEstado">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Cambio de estado</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    x
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <label><strong>Administrador</strong></label>
                    <input disabled type="text" class="form-control input-sm-2" id="nombreME">
                    <label><strong>Identificación del artista</strong></label>
                    <input disabled type="text" class="form-control input-sm-2" id="idArtistaME">
                    <label><strong>Nombre del artista</strong></label>
                    <input disabled type="text" class="form-control input-sm-2" id="nombreArtME">
                    <label><strong>Estado</strong></label>
                    <input disabled type="text" class="form-control input-sm-2" id="estadoME">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Estado de obra -->

<div class="modal" tabindex="-1" role="dialog" id="modalEstadoObra">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Cambio de estado de obra</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    x
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <label><strong>Administrador</strong></label>
                    <input disabled type="text" class="form-control input-sm-2" id="nombreMEO">
                    <label><strong>Identificación del artista</strong></label>
                    <input disabled type="text" class="form-control input-sm-2" id="idArtistaMEO">
                    <label><strong>Id de la obra</strong></label>
                    <input disabled type="text" class="form-control input-sm-2" id="idObraMEO">
                    <label><strong>Estado de la obra</strong></label>
                    <input disabled type="text" class="form-control input-sm-2" id="estadoObraMEO">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Registro de obra -->

<div class="modal" tabindex="-1" role="dialog" id="modalObra">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Registró una obra</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    x
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <label><strong>Id versión</strong></label>
                    <input disabled type="text" class="form-control input-sm-2" id="idVersionMO">
                    <label><strong>Título</strong></label>
                    <input disabled type="text" class="form-control input-sm-2" id="tituloMO">
                    <label><strong>Descripción</strong></label>
                    <input disabled type="text" class="form-control input-sm-2" id="descripcionMO">
                    <label><strong>Valor</strong></label>
                    <input disabled type="text" class="form-control input-sm-2" id="valorMO">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Registro de version -->

<div class="modal" tabindex="-1" role="dialog" id="modalVersion">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Registró una obra</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    x
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <!--     <label><strong>Id artista</strong></label>
                    <input disabled type="text" class="form-control input-sm-2" id="idArtistaMV">
                    <label><strong>Id Version</strong></label>
                    <input disabled type="text" class="form-control input-sm-2" id="idVersionMV">
                    <label><strong>Título</strong></label>
                    <input disabled type="text" class="form-control input-sm-2" id="tituloMV">
                    <label><strong>Descripción</strong></label>
                    <input disabled type="text" class="form-control input-sm-2" id="descripcionMV">
                    <label><strong>Valor</strong></label>
                    <input disabled type="text" class="form-control input-sm-2" id="valorMV">
                    <label><strong>Obra</strong></label> -->
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label><strong>Id versión</strong></label>
                                <input type="text" id="idVersionMV" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label><strong>Id artista</strong></label>
                                <input type="text" id="idArtistaMV" class="form-control" disabled>
                            </div>

                            <div class="form-group">
                                <label><strong>Título</strong></label>
                                <input type="text" id="tituloMV" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label><strong>Descripción</strong></label>
                                <textarea type="text-area" id="descripcionMV" class="form-control" rows="4" disabled></textarea>
                            </div>
                            <div class="form-group">
                                <label><strong>Valor</strong></label>
                                <input type="number" id="valorMV" class="form-control" min="1" disabled>
                            </div>

                        </div>
                        <div class="col-6">
                            <label><strong>Obra</strong></label>
                            <img src="img/default.png" id="fotoMV" width="200">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal de comentario -->

<div class="modal" tabindex="-1" role="dialog" id="modalComentario">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Calificación de la obra</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    x
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <label><strong>Id versión</strong></label>
                    <input disabled type="text" class="form-control input-sm-2" id="idVersionMC">
                    <label><strong>Título de la obra</strong></label>
                    <input disabled type="text" class="form-control input-sm-2" id="tituloMC">
                    <label><strong>Identificación del crítico</strong></label>
                    <input disabled type="text" class="form-control input-sm-2" id="idCriticoMC">
                    <label><strong>Nombre</strong></label>
                    <input disabled type="text" class="form-control input-sm-2" id="nombreMC">
                    <label><strong>Comentario</strong></label>
                    <textarea type="text-area" id="comentarioMC" class="form-control" rows="4" disabled></textarea>
                    <label><strong>Estado</strong></label>
                    <input disabled type="text" class="form-control input-sm-2" id="estadoMC">


                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var url = "indexAjax.php?pid=<?php echo base64_encode('Presentacion/log/logAjax.php') ?>";
    $("#tablaLog").load(url);
</script>

<script>
    $(document).ready(function() {
        $("#filtro").keyup(function() {
            if ($(this).val().length >= 3) {

                var url = "indexAjax.php?pid=<?php echo base64_encode("Presentacion/log/logAjax.php") ?>&filtro=" + $(this).val();
                $("#tablaLog").load(url);

            } else {
                var url = "indexAjax.php?pid=<?php echo base64_encode('Presentacion/log/logAjax.php') ?>";
                $("#tablaLog").load(url);
            }
        });
    });
</script>