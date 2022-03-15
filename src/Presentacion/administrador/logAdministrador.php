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
  
<body style="background-image: url(img/fondo.jpg); background-size: cover;"></body>
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <div class="card f">
                <div class="card-header text-dark ">
                    <h4>Registro de actividad</h4>
                </div>
                <div class="text-right">Resultados <?php echo (($pagina - 1) * $cantidad + 1) ?> al <?php echo (($pagina - 1) * $cantidad) + count($logs) ?> de <?php echo $totalRegistros ?> registros encontrados</div>
                <div class="card-body">
                    <div style="overflow-x: scroll;">
                        <table class="table table-hover table-striped">
                            <tr>
                                <th>#</th>
                                <th>Accion</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Actor</th>
                                <th></th>
                            </tr>
                            <?php
                            $i = 1;
                            foreach ($logs as $logActual) {
                                echo "<tr>";
                                echo "<td>" . $i . "</td>";
                                echo "<td>" . $logActual->getAccion() . "</td>";
                                echo "<td>" . $logActual->getFecha() . "</td>";
                                echo "<td>" . $logActual->getHora() . "</td>";
                                echo "<td>" . $logActual->getActor() . "</td>";
                                echo "<td><a href='index.php?pid=" . base64_encode("Presentacion/administrador/logAdministrador.php") . "&idA=" . $logActual->getId() . "'><i class='fas fa-eye'></i></a></td>";
                                echo "</tr>";
                                $i++;
                            }
                            ?>
                        </table>
                    </div>
                    <div class="text-center">
                        <nav>
                            <ul class="pagination">
                                <li class="page-item <?php echo ($pagina == 1) ? "disabled" : ""; ?>"><a class="page-link" href="<?php echo "index.php?pid=" . base64_encode("Presentacion/administrador/logAdministrador.php") . "&pagina=" . ($pagina - 1) . "&cantidad=" . $cantidad ?>"> &lt;&lt; </a></li>
                                <?php
                                for ($i = 1; $i <= $totalPaginas; $i++) {
                                    if ($i == $pagina) {
                                        echo "<li class='page-item active' aria-current='page'><span class='page-link'>" . $i . "<span class='sr-only'></span></span></li>";
                                    } else {
                                        echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("Presentacion/administrador/logAdministrador.php") . "&pagina=" . $i . "&cantidad=" . $cantidad . "'>" . $i . "</a></li>";
                                    }
                                }
                                ?>
                                <li class="page-item <?php echo ($ultimaPagina) ? "disabled" : ""; ?>"><a class="page-link" href="<?php echo "index.php?pid=" . base64_encode("Presentacion/administrador/logAdministrador.php") . "&pagina=" . ($pagina + 1) . "&cantidad=" . $cantidad ?>"> &gt;&gt; </a></li>
                            </ul>
                        </nav>
                    </div>
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
        url = "index.php?pid=<?php echo base64_encode("Presentacion/administrador/logAdministrador.php") ?>&cantidad=" + $(this).val();
        location.replace(url);
    });
</script>


<div class="container">
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-xl ">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title"><?php echo strtoupper($logModal->getAccion()); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body mt-3 ">
                    <dic class="row mt-1 mb-4">
                        <?php
                        $c = new Artista("", "", "", $logModal->getActor());
                        $a = new Administrador("", "", "", $logModal->getActor());
                        $p = new Critico("", "", "", $logModal->getActor());
                        $an = new Analista("", "", "", $logModal->getActor());
                        $nombre = "";
                        $foto = "";
                        if ($c->consultarConCorreoArtista()) {
                            $nombre = $c->getNombre() . " " . $c->getApellido();
                            if ($c->getFoto() != "") {
                                $foto = "ImgAd/" . $c->getIdArtista() . $c->getFoto();
                            }
                        } else if ($a->consultarConCorreo()) {
                            $nombre = $a->getNombre() . " " . $a->getApellido();
                            if ($a->getFoto() != "") {
                                $foto = "ImgAd/" . $a->getIdAdministrador() . $a->getFoto();
                            }
                        } else if ($p->consultarConCorreoCritico()) {
                            $nombre = $p->getNombre() . " " . $p->getApellido();
                            if ($p->getFoto() != "") {
                                $foto = "ImgAd/" . $p->getIdCritico() . $p->getFoto();
                            }
                        } else if ($an->consultarConCorreoAnalista()) {
                            $nombre = $an->getNombre() . " " . $p->getApellido();
                            if ($an->getFoto() != "") {
                                $foto = "ImgAd/" . $an->getIdAnalista() . $an->getFoto();
                            }
                        }

                        if ($logModal->getAccion() == "Inicio sesion") {
                        ?>
                            <div class="col-lg-12"></div>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="<?php echo ($foto != "") ? $foto : "http://icons.iconarchive.com/icons/custom-icon-design/silky-line-user/512/user2-2-icon.png"; ?>" width="100%" class="img-thumbnail">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12" style="font-size: 20;">
                                <div class="card">
                                    <div class="card-header bg-dark text-white">
                                        <h5>Datos personales</h5>
                                    </div>
                                    <div class="card-body ">

                                        <?php
                                        echo "<b> Nombre: </b>" . $nombre . "<br>";
                                        echo "<b> Correo: </b>" . $logModal->getActor() . "<br>";
                                        echo "<b> Fecha: </b>" . $logModal->getFecha() . "<br>";
                                        echo "<b> Hora: </b>" . $logModal->getHora() . "<br>";
                                        ?>
                                    </div>

                                </div>
                            </div>
                        <?php
                        } else if ($logModal->getAccion() == "Registro una obra") {
                        ?>

                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header bg-dark text-white">
                                        <h5>Artista</h5>
                                    </div>
                                    <div class="card-body" style="font-size: 20;">
                                        <?php
                                        $vec = preg_split("'-'", $logModal->getDatos() . "-");
                                        $prov = new Artista($vec[3]);
                                        $prov->consultar();
                                        echo "<b>Codigo: </b>" . $prov->getIdArtista() . "<br>";
                                        echo "<b>Nombre: </b>" . $prov->getNombre() . " " . $prov->getApellido() . "<br>";
                                        echo "<b>Correo: </b>" . $prov->getCorreo() . "<br>";
                                        ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header bg-dark text-white">
                                        <h5>Obra registrada</h5>
                                    </div>
                                    <div class="card-body" style="font-size: 20;">
                                        <?php
                                        $vec = preg_split("'-'", $logModal->getDatos() . "-");
                                        echo "<b>Obra: </b>" . $vec[0] . "<br>";
                                        echo "<b>Descripcion: </b>" . $vec[1] . "<br>";
                                        echo "<b>Valor: </b> $" . $vec[2] . "<br>";
                                        ?>

                                    </div>
                                </div>
                            </div>
                        <?php
                        } else if ($logModal->getAccion() == "Registro una version") {
                        ?>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header bg-dark text-white">
                                        <h5>Artista</h5>
                                    </div>
                                    <div class="card-body" style="font-size: 20;">
                                        <?php
                                        $vec = preg_split("'-'", $logModal->getDatos() . "-");
                                        $prov = new Artista($vec[3]);
                                        $prov->consultar();
                                        echo "<b>Codigo: </b>" . $prov->getIdArtista() . "<br>";
                                        echo "<b>Nombre: </b>" . $prov->getNombre() . " " . $prov->getApellido() . "<br>";
                                        echo "<b>Correo: </b>" . $prov->getCorreo() . "<br>";

                                        ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header bg-dark text-white">
                                        <h5>Nueva Version</h5>
                                    </div>
                                    <div class="card-body" style="font-size: 20;">
                                        <?php
                                        $vec = preg_split("'-'", $logModal->getDatos() . "-");
                                        echo "<b>Obra: </b>" . $vec[0] . "<br>";
                                        echo "<b>Descripcion: </b>" . $vec[1] . "<br>";
                                        echo "<b>Valor: </b> $" . $vec[2] . "<br>";
                                        echo "<b>Id obra: </b>" . $vec[4] . "<br>";

                                        ?>
                                        <div class="card-body">
                                            <img src="<?php echo ($vec[5] != "") ? $vec[5] : "img/default.png"; ?>" width="100%" class="img-thumbnail">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php
                        } else if ($logModal->getAccion() == "Cambio de estado") {
                            $vec = preg_split("'-'", $logModal->getDatos() . "-");
                            $cli;
                            if ($vec[3] == "Cliente") {
                                $cli = new Artista($vec[0]);
                                $cli->consultar();
                            } else if ($vec[3] == "Administrador") {
                                $cli = new Administrador($vec[0]);
                                $cli->consultar();
                            }

                        ?>
                            <div class="col-lg-2"></div>

                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-header text-white bg-dark">
                                        <h5>USUARIO</h5>
                                    </div>
                                    <div class="card-body" style="font-size: 20;">
                                        <?php
                                        echo "<b>Codigo: </b>" . $vec[0] . "<br>";
                                        echo "<b>Nombre: </b>" . $cli->getNombre() . " " . $cli->getApellido() . "<br>";
                                        echo "<b>Correo: </b>" . $cli->getCorreo() . "<br>";

                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-header text-white bg-dark">
                                        <h5>EDICION</h5>
                                    </div>
                                    <div class="card-body" style="font-size: 20;">
                                        <?php
                                        $aux = $vec[2];
                                        if ($vec[1] == "Edicion: estado") {
                                            if ($vec[2] == "2") {
                                                $aux = "INHABILITADO";
                                            } else if ($vec[2] == "3") {
                                                $aux = "ACTIVADO";
                                            } else {
                                                $aux = "NO ACTIVADO";
                                            }
                                        }
                                        echo $vec[1] . " - " . $aux . "<br>";
                                        echo "<b>Fecha: </b>" . $logModal->getFecha() . "<br>";
                                        echo "<b>Hora: </b>" . $logModal->getHora();
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>




                </div>
            </div>

        </div>
    </div>
</div>