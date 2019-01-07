<?php include_once "conexion.php"; ?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
        crossorigin="anonymous">

    <!-- Optional theme -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"
        crossorigin="anonymous">-->
    
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <div class="container">

        <h1>Ejemplo etiquetar tipo Facebook</h1>

        <div id="imgtag"> 
            <img class="img-responsive img-thumbnail" src="imagen.jpg" /> 
            <div id="tagbox"></div>


            <?php 
            $sql = "SELECT * FROM imagenProyecto WHERE idImagen = '20'";

            $result = mysqli_query($mysqli, $sql);

            while($rs = mysqli_fetch_array($result)) {
            ?>

            <div class="tagview" style="left:<?php echo $rs['tagPositionX'];?>; top:<?php echo $rs['tagPositionY'];?>;" id="view_<?php echo $rs['id'];?>" data-toggle="tooltip" title="Proveedor <?php echo $rs['idProveedor']; ?>">
                <a class="btn btn-xs btn-danger" href="insertarCoordenada.php?deleteCoor=<?php echo $rs['id'];?>">Quitar</a>
            </div>
            
            <?php } ?>

        </div>

        <br>

        <a class="btn btn-primary" href="imgTagueada.php">Ver Etiquetas</a>

        <br>

    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="exampleModalCenter">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Asignar Etiqueta</h4>
                    </div>
                    <form action="insertarCoordenada.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="idProveedor">Proveedor</label>
                                <select name="idProveedor" id="idProveedor" class="form-control">
                                    <option value="1">Proveedor 1</option>
                                    <option value="2">Proveedor 2</option>
                                    <option value="3">Proveedor 3</option>
                                    <option value="4">Proveedor 4</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="tagPositionX" id="tagPositionX" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" name="tagPositionY" id="tagPositionY" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" name="idImagen" id="idImagen" value="20" class="form-control">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="saveCoor" class="btn btn-primary">Guardar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

    <script src="js/main.js"></script>

    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

</body>

</html>