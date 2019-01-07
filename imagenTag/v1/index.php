<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
        crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"
        crossorigin="anonymous">

    <link rel="stylesheet" href="css/style.css">

    <script src="js/main.js"></script>
</head>

<body onload="ini()">

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <img src="imagen.jpg" data-toggle="modal" onclick="coordenadas('10');" onmouseover="mostrar();" onmousemove="mover();"
                    onmouseout="ocultar();" id="recuadro" class="img-thumbnail">
            </div>
           
        </div>
        <div id="ayuda"></div>

        <div class="modal fade" tabindex="-1" role="dialog" id="exampleModalCenter">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Asignar coordenadas</h4>
                    </div>
                    <form action="insertarCoordenada.php" name="cooImagen" method="POST">
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
                                <input type="hidden" name="tagPositionX" id="tagPositionX" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="tagPositionY" id="tagPositionY" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" name="idImagen" id="idImagen" class="form-control">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <br>

       <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Proveedor</th>
                    <th>Posición X</th>
                    <th>Posición Y</th>
                </tr>
            </thead>
            <tbody>

        <?php 
        include_once "conexion.php"; 

        $sql = "SELECT * FROM imagenProyecto";

        $result = mysqli_query($mysqli, $sql);

        while($row = mysqli_fetch_array($result)) {
        ?>
                <tr>
                    <td><?php echo $row['idImagen']; ?></td>
                    <td><?php echo $row['idProveedor']; ?></td>
                    <td><?php echo $row['tagPositionX']; ?></td>
                    <td><?php echo $row['tagPositionY']; ?></td>
                </tr>
           
        <?php } ?>

             </tbody>
        </table>

    </div>

    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

</body>

</html>