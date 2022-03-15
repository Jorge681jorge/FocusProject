<?php

$obra = new Obra();
$comentario = new Comentario();
$obra_Version = new Obra_Version();

$cantidad = 8;
if (isset($_GET["cantidad"])) {
    $cantidad = $_GET["cantidad"];
}

$pagina = 1;
if (isset($_GET["pagina"])) {
    $pagina = $_GET["pagina"];
}

$obras = $obra->consultarPaginacionRegistradas($cantidad, $pagina);
$comentarios = $comentario->consultarpaginacion($cantidad, $pagina);

$totalRegistros = $obra->consultarCantidad();
$totalPaginas = intval($totalRegistros / $cantidad);

if ($totalRegistros % $cantidad != 0) {

    $totalPaginas++;
}
$ultimaPagina = ($totalPaginas == $pagina);

?>

<head>
    <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
    <script src="librerias/alertifyjs/alertify.js"></script>
    <link rel="stylesheet" type="text/css" href="librerias/select2/css/select2.css">
    <link href="Style/design.css" rel="stylesheet">
</head>


<div class="row">
    <div class="col">
        <div class="">

            <div class="card-header text-white bg-dark text-center">
                <h4><i class="fas fa-shopping-basket"></i> Proyectos registrados</h4>
            </div>

            <div class="container text-left lead">Resultados <?php echo (($pagina - 1) * $cantidad + 1) ?> al <?php echo (($pagina - 1) * $cantidad) + count($obras) ?> de <?php echo $totalRegistros ?> Proyectos registrados</div>

            <div class="card-body">
                <div class="row">
                    <?php foreach ($obras as $obraActual) {
                        $obra_version = new Obra_Version("", $obraActual->getIdObra());
                        $od = $obra_version->consultarUltimaVersion();
                        $ultima = new Version($od->getIdVersion());
                        $ultima->consultar();
                        

                        $a = new Artista($obraActual->getIdArtista());
                        $a->consultar();

                    ?>
                        <div class="col-lg-3 col-md-6 col-sm-10">

                            <div class="card">

                                <div class="card-header bg-dark text-white ">
                                    <?php
                                    echo $ultima->getTitulo();
                                    ?>
                                </div>
                                <div class="card-body lead contenido-container">
                                    <img title="<?php echo $ultima->getTitulo(); ?>" alt="<?php echo $ultima->getTitulo(); ?>" class="card-img-top" src="<?php echo $ultima->getFoto(); ?>" data-toggle="gggg" data-trigger="hover" data-content="<?php echo $ultima->getDescripcion() ?>" height="300px">


                                    <div><span>Autor: </span><?php echo $a->getNombre() . " " . $a->getApellido(); ?></div>
                                    <div><?php echo $ultima->getDescripcion(); ?></div>
                                    <div><span class="text-left">Valor: $</span><?php echo $ultima->getValor(); ?></div>
                                    <div class="dropdown-divider"></div>
                                    <div class="row text-center">
                                        <button class="col-sm-4 col-md-6 btn btn-primary" name="btnCalificar" data-toggle="modal" data-target="#modalCalificar" onclick="botonCalificar('<?php echo $ultima->datos() ?>','<?php echo $a->getNombre() . ' ' . $a->getApellido()?>','<?php echo $obraActual->getIdObra()?>')">
                                        <i class="fas fa-clipboard"></i> Calificar
                                        </button>
                                        <a class="col-sm-4 col-md-6 btn btn-dark" href="indexPdf.php?pid=<?php echo base64_encode('Pdf/procesoObra.php').'&idObra='.$obraActual->getIdObra().'&idAutor='.$a->getIdArtista()?>" target="_blank">
                                        <i class="far fa-file"></i> Ver proceso
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    <?php } ?>
                </div>
                <div class="text-center" style="padding-top:50px">
                    <nav>
                        <ul class="pagination">
                            <li class="page-item <?php echo ($pagina == 1) ? "disabled" : ""; ?>"><a class="page-link" <?php echo "onClick='pagina(" . ($pagina - 1) . "," . $cantidad . ")'" ?>><i class="fas fa-angle-double-left"></i></a></li>
                            <?php
                            for ($i = 1; $i <= $totalPaginas; $i++) {
                                if ($i == $pagina) {
                                    echo "<li class='page-item active' aria-current='page'><span class='page-link'>" . $i . "<span class='sr-only'></span></span></li>";
                                } else {
                                    echo "<li class='page-item'><a class='page-link'  onClick='pagina(" . $i . "," . $cantidad . ")'>" . $i . "</a></li>";
                                }
                            }
                            ?>
                            <li class="page-item <?php echo ($ultimaPagina) ? "disabled" : ""; ?>"><a class="page-link" <?php echo "onClick='pagina(" . ($pagina + 1) . "," . $cantidad . ")'" ?>><i class="fas fa-angle-double-right"></i></a></li>
                        </ul>
                    </nav>
                </div>
                <select id="cantidad">
                    <option value="8" <?php echo ($cantidad == 8) ? "selected" : "" ?>>8</option>
                    <option value="16" <?php echo ($cantidad == 16) ? "selected" : "" ?>>16</option>
                    <option value="24" <?php echo ($cantidad == 24) ? "selected" : "" ?>>24</option>
                    <option value="32" <?php echo ($cantidad == 32) ? "selected" : "" ?>>32</option>
                </select>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('[data-toggle="gggg"]').popover()
    });
    $("#cantidad").on("change", function() {

        cambiarCantida('16');

    });
</script>

<script>
    function n() {
        alert("hesoyam");

    }  
    
</script>

<?php
$idNotificacion = "";
if (isset($_GET["idNotificacion"]) and $_GET["idNotificacion"]!="") {
    $idNotificacion =$_GET["idNotificacion"];
    $notificacion = new Notificacion_critico($idNotificacion);
    $notificacion -> CambiarEstadoRevisada();    

    $idObra = "";
        if (isset($_GET["idObra"])) {
            $idObra =$_GET["idObra"];
        }
                        $obra_version = new Obra_Version("", $idObra);
                        $od = $obra_version->consultarUltimaVersion();
                        $ultima = new Version($od->getIdVersion());
                        $ultima->consultar();                        
                        $obra = new Obra($idObra);
                        $obra -> consultar();
                        $a = new Artista($obra->getIdArtista());
                        $a->consultar();                               

    ?>
    <input hidden="" type="text" id="datosNotificacion"  value="<?php echo $ultima->datos() ?>">    
    <input hidden="" type="text" id="nombreArtistaNotificacion"  value="<?php echo $a->getNombre() . ' ' . $a->getApellido()?>">    
    <input hidden="" type="text" id="idObraNotificacion"  value="<?php echo $idObra?>">        
    <script>
         botonCalificar($('#datosNotificacion').val(),$('#nombreArtistaNotificacion').val(),$('#idObraNotificacion').val());         
         abrirmodal();
        
    </script>    
    <?php
}
?>

    