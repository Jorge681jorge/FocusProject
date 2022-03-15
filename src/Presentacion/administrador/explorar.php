<?php
$obra = new Obra();
$obra_Version = new Obra_Version();

$cantidad = 8;
if (isset($_GET["cantidad"])) {
    $cantidad = $_GET["cantidad"];
}
$pagina = 1;
if (isset($_GET["pagina"])) {
    $pagina = $_GET["pagina"];
}

$obras = $obra->consultarObrasPublicadas($cantidad, $pagina);

$totalRegistros = $obra->consultarCantidad();
$totalPaginas = intval($totalRegistros / $cantidad);

if ($totalRegistros % $cantidad != 0) {

    $totalPaginas++;
}
$ultimaPagina = ($totalPaginas == $pagina);

?>

<head>
    <link href="Style/sesionArtista.css" rel="stylesheet">
</head>

<body style="background-image: url(img/misObras.jpg);background-size:contain">

    <!-- SLIDER -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/fCliente1.jpg" class="d-block w-100" alt="...">
                <div class="info">
                    <h2 class="text-center text-white display-1 ">FOCUS</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN SLIDER -->

    <section id="galeria" class="container">

        <div class="card-header bg-dark text-white text-center ">
            <h1>Obras de nuestros artistas</h1>
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
                <div class="col-lg-4 col-md-6 col-sm-6 col-xl-4">
                    <div class="card-header bg-dark text-white">
                        <div><strong> <?php echo $ultima->getTitulo(); ?></strong></div>
                    </div>
                    <img title="<?php echo $ultima->getTitulo(); ?>" alt="<?php echo $ultima->getTitulo(); ?>" class="card-img-top img-rounded img-thumbnail" src="<?php echo $ultima->getFoto(); ?>" data-toggle="gggg" data-trigger="hover" data-content="<?php echo $ultima->getDescripcion() ?>">

                    <div class="card-footer bg-white lead">
                        <div>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalVista<?php echo $ultima->getIdVersion() ?>"><i class="fas fa-search text-dakr"></i></button>
                        </div>
                    </div>
                </div>

                <div class="modal modal fade" id="modalVista<?php echo $ultima->getIdVersion() ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">


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