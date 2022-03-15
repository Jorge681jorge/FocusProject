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

$filtro = "";
if (isset($_GET["filtro"])) {
    $filtro = $_GET["filtro"];
    $obras = $obra->consultarFiltro($filtro);
    $totalRegistros = $obra->consultarCantidadFiltro($filtro);
} else {
    $obras = $obra->consultarObrasPublicadas();
    $totalRegistros = $obra->consultarCantidad();
}

$totalPaginas = intval($totalRegistros / $cantidad);

if ($totalRegistros % $cantidad != 0) {

    $totalPaginas++;
}
$ultimaPagina = ($totalPaginas == $pagina);

?>

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
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalVista<?php echo $ultima->getIdVersion() ?>" title="Detalles"><i class="fas fa-search text-dakr"></i></button>
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