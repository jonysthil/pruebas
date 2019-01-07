<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prueba código QR</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <br>
                <h3 class="text-center">Crear Código QR <i class="fa fa-qrcode text-primary"></i></h3>
                <form method="POST" action="qr_exe.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="qrUrl">URL a incluir en el QR:</label>
                        <input type="text" class="form-control" required id="qrUrl" name="qrUrl" aria-describedby="qrUrl" placeholder="http://">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="qrNivel">Calidad</label>
                                <select class="form-control" id="qrNivel" name="qrNivel">
                                    <option value="L">L - Baja</option>
                                    <option value="M">M - Media</option>
                                    <option value="Q">Q - Alta</option>
                                    <option value="H">H - Muy Alta</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="qrTamano">Tamaño</label>
                                <select class="form-control" id="qrTamano" name="qrTamano">
                                <?php for($i = 4; $i <= 10; $i++) { ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="qrLogo">Icono / Logo</label>
                        <input type="file" size="16384" class="form-control-file" id="qrLogo" onchange="validaImagen(this);" name="qrLogo" accept="image/x-png,image/jpeg">
                    </div>
                    <div id="errorFormato" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none;">
                        <strong>Oops</strong> El formato no es valido solo, permite (.png, .jpeg).
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div id="errorTamano" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none;">
                        <strong>Oops</strong> La imagen sobre pasa el peso permitido.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <button type="submit" class="btn btn-primary">Crear QR</button>
                </form>
                <br>
                <span>Por: Jonathan Jimenez Gamero</span>
            </div>
            <div class="col-md-4">
                <?php if (isset($_GET["qr"]) && $_GET["qr"] != '') {?>
                <div class="text-center">
                    <img class="img-fluid" src="temp/<?php echo $_GET["qr"]; ?>.png"/>
                    <br>
                    <a class="btn btn-info btn-block" href="temp/<?php echo $_GET["qr"]; ?>.png" download="QR-<?php echo $_GET["qr"]; ?>.png">
                        Descargar Código QR <i class="fa fa-download"></i>
                    </a>
                </div>
                <?php } ?>
                <br>
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script>
    function validaImagen(obj) {
        var uploadFile = obj.files[0];
        document.getElementById('qrLogo').value;

        if (!(/\.(jpg|png|jpeg)$/i).test(uploadFile.name)) {
            document.getElementById('errorFormato').style.display = 'block';
            document.getElementById('errorTamano').style.display = 'none';
            document.getElementById('qrLogo').value = '';
        } 
        if (uploadFile.size > 2097152){
            document.getElementById('errorTamano').style.display = 'block';
            document.getElementById('errorFormato').style.display = 'none';
            document.getElementById('qrLogo').value = '';
        }
            /*var archivoInput = document.getElementById('qrLogo');
            var archivoRuta = archivoInput.value;
            var extPermitidas = /(.png|.jpej|.jpg)$/i;
            if (!extPermitidas.exec(archivoRuta)) { 
                document.getElementById('errorFormato').style.display = 'block';
                archivoInput.value = '';
                return false;
            }
            var fileSize = document.getElementById('qrLogo');
            var sizeFile = filesize[0].files[0].size;
            var siezekiloByte = parseInt(sizeFile / 1024);
            if (siezekiloByte >  $('#qrLogo').attr('size')) {
                alert("Imagen muy grande");
                archivoInput.value = '';
                return false;
            }*/
    }
    </script>

</body>
</html>