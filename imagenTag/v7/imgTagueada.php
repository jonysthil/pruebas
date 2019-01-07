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

        <h1>Ejemplo etiquetado tipo Facebook</h1>

        <div id="imgtag1"> 
            <img class="img-responsive img-thumbnail" src="imagen.jpg" /> 
            <div id="tagbox"></div>


            <?php 
            $sql = "SELECT * FROM imagenProyecto WHERE idImagen = '20'";

            $result = mysqli_query($mysqli, $sql);

            while($rs = mysqli_fetch_array($result)) {
            ?>

            <div class="tagview" style="left:<?php echo $rs['tagPositionX'];?>; top:<?php echo $rs['tagPositionY'];?>;" id="view_<?php echo $rs['id'];?>" data-toggle="tooltip" title="Proveedor <?php echo $rs['idProveedor']; ?>">
            </div>
            
            <?php } ?>

        </div>

        <br>

        <a class="btn btn-primary" href="index.php">Agregar Etiqueta</a>

        <br>

    </div>

    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

</body>

</html>