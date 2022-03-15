<link href="Style/design.css" rel="stylesheet">

<head>
    <!--link de bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" crossorigin="anonymous">
</head>

<body>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="index.php?pid=<?php echo base64_encode("Presentacion/autenticar.php") ?>" method="post">
                        <div class="form-group">
                            <input name="correo" type="email" class="form-control" placeholder="Correo" required>
                        </div>
                        <div class="form-group">
                            <input name="clave" type="password" class="form-control" placeholder="Contraseña" required>
                        </div>
                        <div class="form-group">
                            <input name="ingresar" type="submit" class="form-control btn btn-dark" value="Ingresar">
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>
</body>


<div class="col-lg-3 col-md-4 col-12 ml-auto mr-auto text-center mt-5">
    <div class="card ">
        <div class="card-header text-white bg-dark">
            <h4>Autenticacion</h4>
        </div>
        <div class="card-body">

            <p>Eres nuevo? <a href="index.php?pid=<?php echo base64_encode("presentacion/cliente/registrarCliente.php") ?>">Registrate</a></p>
        </div>
    </div>
</div>