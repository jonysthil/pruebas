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

                $x = $rs['tagPositionX'];
                $y = $rs['tagPositionY'];

                $x9 = $x*.80;
                $y9 = $y*.80;

                $x7 = $x*.60;
                $y7 = $y*.60;

                $x76 = $x*.45;
                $y76 = $y*.45;

                $x4 = $x*.20;
                $y4 = $y*.20;
            ?>

                
            <style>
            
                /* Large desktops and laptops */
                @media (min-width: 1200px) {
                    #view_<?php echo $rs['id'];?> {
                        left:<?php echo $x; ?>;
                        top:<?php echo $y; ?>;
                    }
                }

                /* Landscape tablets and medium desktops */
                @media (min-width: 992px) and (max-width: 1199.98px) {
                    #view_<?php echo $rs['id'];?> {
                        left:<?php echo $x9; ?>;
                        top:<?php echo $y9; ?>;
                    }
                }

                /* Portrait tablets and small desktops */
                @media (min-width: 768px) and (max-width: 991.98px) {
                    #view_<?php echo $rs['id'];?> {
                        left:<?php echo $x7; ?>;
                        top:<?php echo $y7; ?>;
                    }
                }

                /* Landscape phones and portrait tablets */
                @media (min-width: 576px) and (max-width: 767.98px) {
                    #view_<?php echo $rs['id'];?> {
                        left:<?php echo $x76; ?>;
                        top:<?php echo $y76; ?>;
                    }
                }

                /* Portrait phones and smaller */
                @media (max-width: 575.98px) {
                    #view_<?php echo $rs['id'];?> {
                        left:<?php echo $x4; ?>;
                        top:<?php echo $y4; ?>;
                    }
                }
            </style>

            <div onclick="alert('Visitando al proveedor: <?php echo $rs['idProveedor']; ?>');" class="tagview" id="view_<?php echo $rs['id'];?>" data-toggle="tooltip" title="Proveedor <?php echo $rs['idProveedor']; ?>">
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