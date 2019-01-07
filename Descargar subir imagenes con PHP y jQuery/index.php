<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Descargar subir imágenes con PHP y jQuery - BaulPHP</title>
    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="assets/css/style.css" />
    <link href="assets/css/sticky-footer-navbar.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/script.js"></script>
  </head>

  <body>

    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">BaulPHP</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
            </li>  
                  
          </ul>
          <form class="form-inline mt-2 mt-md-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Buscar" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Busqueda</button>
          </form>
  
        </div>
      </nav>
    </header>

    <!-- Begin page content -->

<div class="container">
 <h3 class="mt-5">Carga de imágenes jQuery</h3>
 <hr>

<div class="row">
  <div class="col-12 col-md-6">
<!-- Contenido --> 



<div class="main">

<form id="uploadimage" action="" method="post" enctype="multipart/form-data">
<div id="image_preview" ><img id="previewing" src="imagen/no-image.jpg" width="250" height="230" /></div>
<hr id="line" >
<div id="selectImage">


  <div class="form-group">
    <label for="exampleFormControlFile1">Selecciona una imagen</label>
    <input type="file" class="form-control-file" id="file" name="file">
  </div>
<div class="form-group">  
<input type="submit" value="Cargar imagen" class="btn btn-primary mb-2" />
</div>

</div>
</form>
</div>




<!-- Fin Contenido --> 
</div>
<div class="col-12 col-md-6">
<h4 id='loading' >Cargando..</h4>
<div id="message"></div>
</div>


</div><!-- Fin row -->


</div><!-- Fin container -->
    <footer class="footer">
      <div class="container">
        <span class="text-muted"><p>Códigos <a href="https://www.baulphp.com/" target="_blank">BaulPHP</a></p></span>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
       <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
  </body>
</html>
</body>
</html>