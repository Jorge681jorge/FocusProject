<?php
$idNotificacion = "";
if (isset($_GET["idNotificacion"])) {
  $idNotificacion = $_GET["idNotificacion"];
}

$idObra = "";
if (isset($_GET["idObra"])) {
  $idObra = $_GET["idObra"];
}

?>

<head>
  <script src="Presentacion/critico/obras/funciones/funciones.js"></script>
  <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
  <script src="librerias/alertifyjs/alertify.js"></script>
  <link rel="stylesheet" type="text/css" href="librerias/select2/css/select2.css">
</head>

<body style="background-image: url(img/fondo.jpg); background-size: cover;">
  <div class="container mt-3" style="margin-bottom: 100px; padding-top:40px">

    <input hidden="" type="text" name="iddd" id="iddd" value="<?php echo $_SESSION["id"] ?>">

    <div id="obrasRegistradas"></div>

  </div>

</body>


<div class="modal" tabindex="-1" role="dialog" id="modalCalificar">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title">Calificar Obra</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <div class="text-center">
              <img src="" alt="" id="foto" width="200">
            </div>
          </div>
          <div class="col">
            <label><strong>Título</strong></label>
            <input disabled type="text" class="form-control input-sm-2" id="titulo" aria-describedby="basic-addon3">
            <label><strong>Autor</strong></label>
            <input disabled type="text" class="form-control input-sm-2" id="autor" aria-describedby="basic-addon3">
            <label><strong>Descripción</strong></label>
            <textarea disabled type="text" class="form-control input-sm-2" id="descripcion" aria-describedby="basic-addon3"></textarea>
            <label><strong>ID Obra / ID Version</strong></label>
            <div class="input-group">
              <input disabled type="text" class="form-control" id="idObra">
              <input disabled type="text" class="form-control" id="idVersion">
            </div>

          </div>
        </div>
        <div class="row">
          <div class="col">
            <label><strong>Comentario</strong></label>
            <textarea type="text" name="" id="comentario" class="form-control input-sm" style="height: 100px !important;" required> </textarea>

            <label><strong>Acción</strong></label>
            <select id="estado" class="form-control">
              <option value="PUBLICADA">PUBLICAR OBRA</option>
              <option value="RECHAZADA">RECHAZAR OBRA</option>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="realizarCalificacion" onclick="agregarComentario()"><i class="fas fa-check-circle"></i> Calificar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cerrar</button>
      </div>
    </div>
  </div>
</div>


<script>
  var url = "indexAjax.php?pid=<?php echo base64_encode('Presentacion/critico/obras/obrasRegistradasAjax.php') . '&idNotificacion=' . $idNotificacion . '&idObra=' . $idObra ?>";
  $("#obrasRegistradas").load(url);
</script>