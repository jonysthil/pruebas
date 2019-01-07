<?php include_once "conexion.php"; ?>
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

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div style="position:relative">
                    <img src="imagen.jpg" class="img-thumbnail" >
                
                <?php
                $sql = "SELECT * FROM imagenProyecto WHERE idImagen = '10'";

                $result = mysqli_query($mysqli, $sql);

                while($row = mysqli_fetch_array($result)) {
                ?>
                <img src="marker.png" id="ubicacion" class="contorno" onclick="javascript:alert('hola');" style="position:absolute; top:<?php echo $row['tagPositionX']?>; left:<?php echo $row['tagPositionY']?>;" data-toggle="tooltip" title="Proveedor <?php echo $row['idProveedor']; ?>">
                <?php } ?>
                </div>
            </div>
            
        </div>
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