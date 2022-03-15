<?php
$log = new Log();
$cantidad = 5;
if (isset($_GET["cantidad"])) {
    $cantidad = $_GET["cantidad"];
}
$pagina = 1;
if (isset($_GET["pagina"])) {
    $pagina = $_GET["pagina"];
}

$logs = $log->consultarPaginacion($cantidad, $pagina);
$totalRegistros = $log->consultarCantidad();


$filtro = "";
if (isset($_GET["filtro"])) {
    $filtro = $_GET["filtro"];
    $logs = $log->consultarFiltro($filtro);
    $totalRegistros = $log->consultarCantidadFiltro($filtro);
} else {
    $logs = $log->consultarPaginacion($cantidad, $pagina);
    $totalRegistros = $log->consultarCantidad();
}



$totalPaginas = intval($totalRegistros / $cantidad);
if ($totalRegistros % $cantidad != 0 || $totalRegistros % $cantidad == 0) {
    $totalPaginas++;
}
$ultimaPagina = ($totalPaginas == $pagina);
$idA = "";
if (isset($_GET["idA"])) {
    $idA = $_GET["idA"];
    $logModal = new log($idA);
    $logModal->consultar();
?>

    <script>
        $(document).ready(function() {
            $("#myModal").modal("show");
        });
    </script>

<?php
}
?>

<div class="container mt-3">
    <div class="row">
        <div class="col">
            <div class="card f">
                <div class="card-header text-white bg-dark">
                    <h4>Registro de actividad</h4>
                </div>
                <div class="text-right container">Resultados <?php echo (($pagina - 1) * $cantidad + 1) ?> al <?php echo (($pagina - 1) * $cantidad) + count($logs) ?> de <?php echo $totalRegistros ?> registros encontrados</div>
                <div class="card-body">
                    <div style="overflow-x: scroll;">
                        <table class="table table-hover table-striped">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Accion</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Hora</th>
                                <th class="text-center">Actor</th>
                                <th class="text-center">Información</th>
                            </tr>
                            <?php
                            $i = 1;
                            foreach ($logs as $logActual) {
                                echo "<tr class='text-center'>";
                                echo "<td class='text-center'>" . $i . "</td>";
                                echo "<td class='text-center'>" . $logActual->getAccion() . "</td>";
                                echo "<td class='text-center'>" . $logActual->getFecha() . "</td>";
                                echo "<td class='text-center'>" . $logActual->getHora() . "</td>";
                                echo "<td class='text-center'>" . $logActual->getActor() . "</td>";
                                /* echo "<td><a href='index.php?pid=" . base64_encode("Presentacion/administrador/logAdministrador.php") . "&idA=" . $logActual->getId() . "'><i class='fas fa-eye'></i></a></td>"; */
                                $nombre = "";
                                $vec = "";

                                if($logActual->getAccion()=="Inicio sesion"){
                                    $nombre = "modalSesion";
                                }else if($logActual->getAccion()=="Cambio estado"){
                                    $nombre = "modalEstado";
                                }else if($logActual->getAccion()=="Registro una obra"){
                                    $nombre = "modalObra";
                                }else if($logActual->getAccion()=="Registro una version"){
                                    $nombre = "modalVersion";
                                }else if($logActual->getAccion()=="Califico una version"){
                                    $nombre = "modalComentario";
                                }else if($logActual->getAccion()=="Cambio estado de obra"){
                                    $nombre = "modalEstadoObra";
                                }
                                ?>  <td><a onClick="botonVerLog('<?php echo $logActual->datos() ?>','<?php echo $nombre ?>')"><i class='fas fa-eye text-primary'></i></a></td> <?php
                                echo "</tr>";
                                $i++;
                            }
                            ?>
                        </table>
                    </div>
                    <?php
                    if (isset($_GET["filtro"])) {
                    }else{
                        ?>
                    <div class="text-center">
                        <nav>
                            <ul class="pagination">
                                <li class="page-item <?php echo ($pagina == 1) ? "disabled" : ""; ?>"><a class="page-link" <?php echo "onClick='pagina(" . ($pagina - 1) . "," . $cantidad . ")'" ?>><i class="fas fa-angle-double-left"></i></a></li>
                                <?php
                                for ($i = 1; $i <= $totalPaginas; $i++) {
                                    if ($i == $pagina) {
                                        echo "<li class='page-item active' aria-current='page'><span class='page-link'>" . $i . "<span class='sr-only'></span></span></li>";
                                    } else {
                                        echo "<li class='page-item'><a class='page-link' onClick='pagina(" . $i . "," . $cantidad . ")'>" . $i . "</a></li>";
                                    }
                                } ?>
                                <li class="page-item <?php echo ($ultimaPagina) ? "disabled" : ""; ?>"><a class="page-link" <?php echo "onClick='pagina(" . ($pagina + 1) . "," . $cantidad . ")'" ?>><i class="fas fa-angle-double-right"></i></a></li>
                            </ul>
                        </nav>
                    </div>
                    <?php
                    }
                    ?>
                    <select id="cantidad">
                        <option value="5" <?php echo ($cantidad == 5) ? "selected" : "" ?>>5</option>
                        <option value="10" <?php echo ($cantidad == 10) ? "selected" : "" ?>>10</option>
                        <option value="15" <?php echo ($cantidad == 15) ? "selected" : "" ?>>15</option>
                        <option value="20" <?php echo ($cantidad == 20) ? "selected" : "" ?>>20</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#cantidad").on("change", function() {
        cambiarCantidad($(this).val());
        
    });
</script>