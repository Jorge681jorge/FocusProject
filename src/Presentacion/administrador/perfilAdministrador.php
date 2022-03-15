<?php
$administrador = new Administrador($_SESSION["id"]);
$administrador->consultar();

$error = 0;
if (isset($_POST["editar"])) {
    if (file_exists('ImgAd/' . $administrador->getIdAdministrador() . $administrador->getFoto())) {
        unlink('ImgAd/' . $administrador->getIdAdministrador() . $administrador->getFoto());
    }

    if (!empty($_FILES['foto']['name'])) {

        $n = $_FILES['foto']['name'];
        $tmp = $_FILES["foto"]["tmp_name"];
        $folder = 'ImgAd/' . $administrador->getIdAdministrador();
        move_uploaded_file($tmp, $folder . $n);
    }

    $administrador = new Administrador($_SESSION["id"], $_POST["nombre"], $_POST["apellido"], "", "", $_FILES['foto']['name']);
    $administrador->editar();
}
if (isset($_POST["editarc"])) {
    if ($administrador->getContraseña() == (md5($_POST["antigua"]))) {
        $admi = new Administrador($_SESSION["id"], "", "", "", $_POST["nueva"]);
        $admi->editarClave();
    } else {
        $error = 1;
        echo $administrador->getContraseña();
    }
}

$administrador->consultar();
?>
<head>
	<link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
	<script src="librerias/alertifyjs/alertify.js"></script>
	<link rel="stylesheet" type="text/css" href="librerias/select2/css/select2.css">
</head>

<body style="background-image: url(img/fondo.jpg); background-size: cover;"></body>

<!-- datos personales -->
<div class="container mt-3 mb-3">

    <div class="card mx-auto" style="max-width: 18.49rem;">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-header bg-dark text-white lead">
                    <h3>Administrador</h3>
                </div>
                <div class="card-body">
                    <img src="<?php echo ($administrador->getFoto() != "") ? "ImgAd/" . $administrador->getIdAdministrador() . $administrador->getFoto() : "http://icons.iconarchive.com/icons/custom-icon-design/silky-line-user/512/user2-2-icon.png"; ?>" width="100%" class="img-thumbnail">
                </div>

            </div>
        </div>

        <div class="row">
            <div class="card-footer mx-auto bg-dark f">
                <table class="table table-hover text-white">
                    <tr>
                        <th>Nombre</th>
                        <td><?php echo $administrador->getNombre() ?></td>
                    </tr>
                    <tr>
                        <th>Apellido</th>
                        <td><?php echo $administrador->getApellido() ?></td>
                    </tr>
                    <tr>
                        <th>Correo</th>
                        <td><?php echo $administrador->getCorreo() ?></td>
                    </tr>
                </table>
                <a data-toggle="modal" data-target="#Informacion" style="text-align: right;" href="#" title="Editar perfil"><i class="fas fa-user-edit"> </i></a>
                <a data-toggle="modal" data-target="#Clave" style="text-align: right;" href="#" title="Editar contraseña"><i class="fas fa-unlock-alt"> </i></a>
            </div>
        </div>
    </div>
</div>


<!-- Modal edicion informacion -->
<div class="modal fade" id="Informacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Actualiza tu información</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="index.php?pid=<?php echo base64_encode("Presentacion/administrador/perfilAdministrador.php") ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="<?php echo $administrador->getNombre() ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" name="apellido" class="form-control" value="<?php echo $administrador->getApellido() ?>" required>
                    </div>
                    <label>Foto de perfil</label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input name="foto" type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Imagen</label>
                        </div>
                    </div>
                    <button type="submit" name="editar" class="btn btn-success"><i class="fas fa-check-circle"></i> Confirmar</button>
                </form>
                <?php if (isset($_POST["editar"])) { ?>
                    <script>
                        $('#Informacion').modal('show');
                    </script>
                    <script>
						alertify.success("Información actualizada");
					</script>
                <?php } ?>
            </div>
        </div>
    </div>

</div>

<!-- Modal edicion contraseña-->

<div class="modal fade" id="Clave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Edita tu contraseña</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="index.php?pid=<?php echo base64_encode("Presentacion/administrador/perfilAdministrador.php") ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Contraseña actual</label>
                        <input type="password" name="antigua" class="form-control" value="" required>
                    </div>
                    <div class="form-group">
                        <label>Nueva contraseña</label>
                        <input type="password" name="nueva" class="form-control" value="" required>
                    </div>
                    <button type="submit" name="editarc" class="btn btn-success"><i class="fas fa-check-circle"></i> Cambiar contraseña</button>
                </form>
                <?php if (isset($_POST["editarc"])) { ?>
                    <script>
                        $('#Clave').modal('show');
                    </script>
                    <?php
                    if ($error != 0) {
                    ?>
                        <span aria-hidden="false"></span>
                        <script>
							alertify.error("Contraseña incorrecta");
						</script>
                    <?php
                    } else {
                    ?>
                        <script>
							alertify.success("Contraseña actualizada");
						</script>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>

</div>