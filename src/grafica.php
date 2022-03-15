<?php
require_once "Logica/Obra.php";
require_once "Logica/Version.php";
require_once "Logica/Obra_Version.php";

$obra = new Obra();
$obra_Version = new Obra_Version();
$obras = $obra->consultarTodos();
$contOtros=0;
?>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" crossorigin="anonymous">
    <title>Graficas</title>
</head>
<div class="container text-center">

    <div class="row">

        <div class="col-lg-6 md-6">

            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load('current', {
                    'packages': ['corechart']
                });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {

                    var data = google.visualization.arrayToDataTable([
                        ['Obra', 'Valor'],

                        <?php
                        $maximo = 1;
                        foreach ($obras as $obraActual) {
                            $obra_version = new Obra_Version("", $obraActual->getIdObra());
                            $od = $obra_version->consultarUltimaVersion();
                            $ultima = new Version($od->getIdVersion());
                            $ultima->consultar();

                            if ($maximo < 10) {
                                echo "['" . $ultima->getTitulo() . "', " . $ultima->getValor() . "],";
                            } else {
                                $contOtros += $ultima->getValor();
                            }
                            $maximo++;
                        }
                            echo "['" . "Otras obras" . "', " . $contOtros . "],";
                        ?>
                    ]);

                    var options = {
                        title: 'Valor de las obras'
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                    chart.draw(data, options);
                }
            </script>
        </div>
        <div class="col-lg-6">
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load('current', {
                    packages: ['corechart', 'bar']
                });
                google.charts.setOnLoadCallback(drawBasic);

                function drawBasic() {

                    var data = google.visualization.arrayToDataTable([
                        ['Obra', 'Valor', ],
                        <?php
                        $contOtros = 0;
                        foreach ($obras as $obraActual) {
                            $obra_version = new Obra_Version("", $obraActual->getIdObra());
                            $od = $obra_version->consultarUltimaVersion();
                            $ultima = new Version($od->getIdVersion());
                            $ultima->consultar();

                            if($ultima->getValor()>1000000){
                                echo "['" . $ultima->getTitulo() . "', " . $ultima->getValor() . "],";
                            }else{
                                $contOtros+= $ultima->getValor();
                            }
                        }
                        echo "['" . "Otras obras" . "', " . $contOtros . "],";
                        ?>
                    ]);

                    var options = {
                        title: 'Valor de las obras',
                        chartArea: {
                            width: '50%',
                            height: '100%'
                        },
                        hAxis: {
                            title: 'Total productos',
                            minValue: 0
                        },
                        vAxis: {
                            title: 'Obras'
                        }
                    };

                    var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

                    chart.draw(data, options);
                }
            </script>
        </div>
    </div>
</div>

<body style="background-image: url(img/fondo.jpg);background-size: cover; margin-bottom: 100px; ">
    <div class="container">
        <h1 class="text-center ">Estadísticas del valor de las obras</h1>

        <div class="col">
            <div class="card">
                <div id="piechart" style="height: 450px; margin-bottom: 10px; margin-top: 20px;" ></div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div id="chart_div" style="margin-bottom: 40px; margin-top: 20px;"></div>
            </div>
        </div>



    </div>



</body>

</html>