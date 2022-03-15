<?php
$idObra = "";
$boton = true;
if (isset($_POST["agregar"])) {
    $boton = false;
}



if (isset($_GET["idObra"])) {
    $idObra = $_GET["idObra"];

    $obra = new Obra($idObra);
    $obra->consultar();
    $obra_version = new Obra_Version("", $idObra);
    $od = $obra_version->consultarUltimaVersion();
    $ultima = new Version($od->getIdVersion());
    $ultima->consultar();

    if(isset($_GET["notificacion"])){
        $notificacion = new Notificacion_artista($_GET["notificacion"]);        
        $notificacion -> CambiarEstadoRevisada();
    }
}

$titulo = "";
if (isset($_POST["tituloObra"])) {
    $titulo = $_POST["tituloObra"];
}
$descripcion = "";
if (isset($_POST["descripcionObra"])) {
    $descripcion = $_POST["descripcionObra"];
}
$valor = "";
if (isset($_POST["valorObra"])) {
    $valor = $_POST["valorObra"];
}

$fecha = date("Y-m-d");

$img_nomb = "default.png";
$src = "";
$tiempo = new DateTime();
$destino = "img/galeria/";


?>

<html>

<head>
    <script src="Presentacion/obra/funciones.js"></script>
    <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
    <script src="librerias/alertifyjs/alertify.js"></script>
    <link rel="stylesheet" type="text/css" href="librerias/select2/css/select2.css">
</head>


<body style="background-image: url(img/fondoB.jpeg); background-size: cover">

    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-3 col-md-0"></div>
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-header text-white bg-dark text-center">
                        <h4>Actualizar Version de la obra</h4>
                    </div>
                    <div class="card-body">
                        <form action="index.php?pid=<?php echo base64_encode("Presentacion/obra/registrarVersion.php") . "&idObra=" . $idObra ?>" method="post" enctype="multipart/form-data">
                            <div class="row">


                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Id obra</label>
                                        <input type="text" name="idObra" class="form-control" value="<?php echo $idObra ?>" disabled>
                                    </div>
                                    <div class="form-group">

                                        <input type="text" name="tituloObra" id="tituloObra" class="form-control" placeholder="Título" value="<?php echo $ultima->getTitulo() ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <textarea type="text-area" name="descripcionObra" id="descripcionObra" class="form-control" placeholder="Descripción" rows="4" required><?php echo $ultima->getDescripcion() ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="valorObra" id="valorObra" class="form-control" placeholder="Valor" min="1" value="<?php echo $ultima->getValor() ?>" required>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <img src="<?php echo $ultima->getFoto() ?>" id="versionFoto" class="img-fluid">

                                    <div class="custom-file form-group">
                                        <input type="file" name="foto" class="custom-file-input" aria-describedby="inputGroupFileAddon01" id="foto">
                                        <label class="custom-file-label text-center" for="inputGroupFile01">IMAGEN</label>
                                        <!-- <input type="file" class="form-control" name="foto" id="foto" aria-describedby="foto">
									<label class="custom-file-label form-control" for="foto">Buscar archivo</label> -->
                                    </div>

                                </div>
                                <?php if ($boton && $obra->getEstado()=="RECHAZADA") {
                                ?>
                                    <button type="submit" name="agregar" class="btn btn-success btn-block"> <i class="fas fa-check-circle"></i> Agregar versión</button>
                                <?php
                                }
                                ?>

                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-3"></div>
</body>

</html>
<!-- <script>
    actualizarFoto($("#nuevaFoto").val());    
</script> -->
<?php
if (isset($_POST["agregar"])) {
    if ($_FILES["foto"]["name"] != "") {
        $auxfoto = $_FILES["foto"]["tmp_name"];
        $type_foto = $_FILES["foto"]["type"];
        $img_nomb = "img_" . $titulo . $tiempo->getTimestamp() . (($type_foto == "img/png") ? ".png" : ".jpg");
        $src = $destino . $img_nomb;
        copy($auxfoto, $src);
    } else {
        $src = $ultima->getFoto();
    }
    $idVersion = time();
    $hora = date('H:i:s');
    $version = new Version($idVersion, $titulo, $descripcion, $valor, $src, $fecha, $hora, "REGISTRADA");
    $version->insertar();
    $resultados_2 = $version->insertar_2();

    if (!empty($resultados_2)) {

        //notificacion critico

        $obra_version = new Obra_Version("", $idObra, $idVersion);
        $obra_version->insertar();
        $asunto = "Revision Obra: " . $titulo;
        $notificacion_critico = new Notificacion_critico("", $asunto, $_SESSION["correo"], $idObra, $fecha, $hora, "SINREVISAR");
        $notificacion_critico->registrar();
        $no = $notificacion_critico->registrar_2();
        $obra2 = new Obra($idObra, "", "REGISTRADA");
        $obra2->editarEstado();

?>
        <input type="text" hidden='' id="fotoNueva" name="fotoNueva" value="<?php echo $src ?>">
        <input type="text" hidden='' id="tituloNuevo" name="tituloNuevo" value="<?php echo $titulo ?>">
        <input type="text" hidden='' id="descripcionNueva" name="descripcionNueva" value="<?php echo $descripcion ?>">
        <input type="text" hidden='' id="valorNuevo" name="valorNuevo" value="<?php echo $valor ?>">
        <script>
            actualizarFoto($("#fotoNueva").val());
            $("#tituloObra").val($("#tituloNuevo").val());
            $("#descripcionObra").val($("#descripcionNueva").val());
            $("#valorObra").val($("#valorNuevo").val());
            
            alertify.success("La versión se registró con exito");
        </script>
        
    <?php
    $artista = new Artista($_SESSION["id"]);
    $artista->consultar();
    $log = new Log("", "Registro una version", $titulo . "-" . $descripcion . "-" . $valor . "-" . $_SESSION["id"] . "-". $idObra . "-" . $src, "NOW()", "NOW()", $artista->getCorreo());
    $log->insertar();
    } else {

    ?>
        <script>
            alertify.error("Ha ocurrido un problema con la versión");
        </script>
<?php
    }
}

?>