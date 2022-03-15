<?php

$obra = new Obra("", $_SESSION["id"]);
$obra_Version = new Obra_Version();
$obras = $obra->consultarObrasArtista();

$cantidad = 8;
if (isset($_GET["cantidad"])) {
    $cantidad = $_GET["cantidad"];
}
$pagina = 1;
if (isset($_GET["pagina"])) {
    $pagina = $_GET["pagina"];
}

?>

<head>
    <!-- <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
	<script src="librerias/alertifyjs/alertify.js"></script>
    <link rel="stylesheet" type="text/css" href="librerias/select2/css/select2.css"> -->

    <link href="Style/sesionArtista.css" rel="stylesheet">
    <!-- <script src="js/script.js" defer></script> -->
</head>

<body style="background-image: url(img/galeria.jpg);background-size:contain">


    <section id="galeria" class="container">

        <div class="card-header bg-dark text-white text-center ">
            <h1>Mis obras</h1>
        </div>
        <div class="row">
            <?php foreach ($obras as $obraActual) {
                $obra_version = new Obra_Version("", $obraActual->getIdObra());
                $od = $obra_version->consultarUltimaVersion();
                $ultima = new Version($od->getIdVersion());
                $ultima->consultar();

                $a = new Artista($obraActual->getIdArtista());
                $a->consultar();

            ?>
                <div class="col-lg-4 col-md-6 col-sm-10 ">
                    <div class="card-header bg-dark text-white">
                        <div><strong> <?php echo $ultima->getTitulo(); ?></strong></div>
                    </div>
                    <img title="<?php echo $ultima->getTitulo(); ?>" alt="<?php echo $ultima->getTitulo(); ?>" class="card-img-top img-rounded img-thumbnail" src="<?php echo $ultima->getFoto(); ?>" data-toggle="gggg" data-trigger="hover" data-content="<?php echo $ultima->getDescripcion() ?>">

                    <div class="card-footer bg-white lead">
                        <div class="row text-center">


                            <button class="col-sm-4 col-md-6 btn btn-primary" data-toggle="modal" data-target="#modalVista<?php echo $ultima->getIdVersion() ?>" title="Detalles"><i class="fas fa-search text-dakr"></i></button>
                            <a class="col-sm-4 col-md-6 btn btn-dark" href="indexPdf.php?pid=<?php echo base64_encode('Pdf/procesoObra.php') . '&idObra=' . $obraActual->getIdObra() . '&idAutor=' . $a->getIdArtista() ?>" target="_blank" title="Ver proceso">
                                <i class="fas fa-file-alt"></i>
                            </a>
                            <?php
                            if ("RECHAZADA" == $obraActual->getEstado()) {
                            ?>
                                <a class="col-sm-12 col-md-12 lg-12 btn btn-warning text-white" style="" href="index.php?pid=<?php echo base64_encode('Presentacion/obra/registrarVersion.php') . '&idObra=' . $obraActual->getIdObra() ?>" title="Editar">
                                    <i class="fas fa-pencil-alt text-dark"></i>
                                </a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="modal modal fade" id="modalVista<?php echo $ultima->getIdVersion() ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <!--  <div class="modal-header lead">
                                <div>
                                    <h2 class="text-center"> <?php echo $ultima->getTitulo(); ?></h2>
                                </div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>-->


                            <div class="modal-body ventana">
                                <img title="<?php echo $ultima->getTitulo(); ?>" alt="<?php echo $ultima->getTitulo(); ?>" class="card-img-top img-rounded img-thumbnail" src="<?php echo $ultima->getFoto(); ?>" data-toggle="gggg" data-trigger="hover" data-content="<?php echo $ultima->getDescripcion() ?>">
                                <div class="card-footer bg-white lead">
                                    <div>
                                        <h2 class="text-center"><?php echo $ultima->getTitulo(); ?></h2>
                                    </div>
                                    <div><strong>Autor: </strong><?php echo $a->getNombre() . " " . $a->getApellido(); ?></div>
                                    <div><strong> <?php echo $ultima->getDescripcion(); ?></strong></div>
                                    <div><strong>Valor: $<?php echo $ultima->getValor(); ?></strong></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </section>
</body>