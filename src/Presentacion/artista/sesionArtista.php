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
      <!--   <div class="container text-white mt-3 ">
            <div class="">
                <input type="text" id="filtro" name="filtro" class="form-control" placeholder="Buscar actividad">
            </div>
        </div> -->
        <div id="buscarObras"></div>
    </section>
</body>


<script>
    var url = "indexAjax.php?pid=<?php echo base64_encode('Presentacion/obra/mostrarBuscarObras.php') ?>";
    $("#buscarObras").load(url);
</script>

<script>
    $(document).ready(function() {
        $("#filtro").keyup(function() {
            if ($(this).val().length >= 3) {

                var url = "indexAjax.php?pid=<?php echo base64_encode("Presentacion/obra/mostrarBuscarObras.php") ?>&filtro=" + $(this).val();
                $("#buscarObras").load(url);

            } else {
                var url = "indexAjax.php?pid=<?php echo base64_encode('Presentacion/obra/mostrarBuscarObras.php') ?>";
                $("#buscarObras").load(url);
            }
        });
    });
</script>