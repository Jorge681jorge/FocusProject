<?php

$error = 0;
$registrado = false;
if (isset($_POST["registrar"])) {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["correo"];
    $contraseña = $_POST["contraseña"];
    $estado = 1;
    $artista = new Artista("", $nombre, $apellido, $correo, $contraseña, 1);
    if ($artista->existeCorreo()) {
        $error = 1;
        $registrado = true;
    } else {
        $artista->registrar();
        $registrado = true;
    }
}

?>

<head>
    <link href="Style/design.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
    <script src="librerias/alertifyjs/alertify.js"></script>
    <link rel="stylesheet" type="text/css" href="librerias/select2/css/select2.css">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>


<header>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container text-light ">
            <div class="contenido-nav">
                <a class="navbar-brand" href="index.php"><strong class="text-light display-4">
                        <img src="img/logo.png" class="img-fluid" style="height: 100px;"> Focus</strong></a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <ion-icon name="menu-outline"></ion-icon>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active ">
                        <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Inicio <span class="sr-only ">(current)</span></a>
                    </li>
               

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-circle"></i> Cuenta
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" data-toggle="modal" id="iniciarSesion" data-target="#exampleModal">
                                <i class="fas fa-sign-in-alt"></i> Ingresar
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" data-toggle="modal" id="Registro" data-target="#exampleModalR">
                                <i class="fas fa-user-plus"></i> Registrarme</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<!-- Modal autenticacion-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modalfondo">

            <div class="container container-modal">
                <div class="d-flex justify-content-center h-100">
                    <div class="card bg-dark card-modal">
                        <div class="card-header header-modal">
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h3><i class="fas fa-sign-in-alt"></i> Ingreso</h3>

                        </div>
                        <div class="card-body">
                            <form action="index.php?pid=<?php echo base64_encode("Presentacion/autenticar.php") ?>" method="post">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>

                                    <input name="correo" type="email" class="form-control" placeholder="Correo" required> <!-- correo -->
                                </div>
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>

                                    <input name="clave" type="password" class="form-control" placeholder="Contraseña" required> <!-- contraseña -->
                                </div>

                                <div class="form-group">
                                    <input name="ingresar" type="submit" value="Login" class="form-control btn float-right login_btn btn-block" value="Ingresar"> <!-- botonEnviar -->
                                </div>
                            </form>

                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-center links">
                                <span class="text-white">Eres nuev@?</span> <a href="index.php?pid=<?php echo base64_encode("Presentacion/artista/registrarArtista.php") ?>"> Regístrate</a>
                            </div>

                            <?php
                        if (isset($_GET["error"]) && $_GET["error"] == 1) { ?>
                            <script>
                                alertify.error("Correo o contraseña inconrrectos");
                            </script>

                        <?php
                        } else if (isset($_GET["error"]) && $_GET["error"] == 2) {
                        ?>
                            <script>
                                alertify.error("Su cuenta no ha sido activada");
                            </script>
                        <?php
                        } else if (isset($_GET["error"]) && $_GET["error"] == 3) {
                        ?>
                            <script>
                                alertify.error("Su cuenta se encuentra inactiva");
                            </script>
                        <?php
                        }
                        ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal registro -->

<div class="modal fade" id="exampleModalR" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelR" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modalfondo">

            <div class="container container-modal">
                <div class="d-flex justify-content-center h-100">
                    <div class="card bg-dark card-modal">
                        <div class="card-header header-modal">
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h3><i class="fas fa-user-plus"></i> Registro</h3>

                        </div>
                        <div class="card-body">
                            <form action="index.php?pid=<?php echo base64_encode("Presentacion/navegacion.php") ?>" method="post">


                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>

                                    <input name="nombre" type="text" class="form-control" placeholder="Nombre" required> <!-- Nombre -->
                                </div>
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>

                                    <input name="apellido" type="text" class="form-control" placeholder="Apellido" required> <!-- Apellido -->
                                </div>

                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>

                                    <input name="correo" type="email" class="form-control" placeholder="Correo" required> <!-- correo -->
                                </div>
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>

                                    <input name="contraseña" type="password" class="form-control" placeholder="Contraseña" required> <!-- contraseña -->
                                </div>

                                <div class="form-group">
                                    <input name="registrar" type="submit" value="Registrarme" class="form-control btn float-right login_btn btn-block" > <!-- boton -->
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <?php if ($error == 1) { ?>
                    <script>
                        alertify.error("Este correo ya está en uso");
                    </script>
                <?php } else if ($registrado) { ?>
                    <script>
                        alertify.success("Registro exitoso");
                    </script>

                <?php } ?>
            </div>
        </div>
    </div>
</div>