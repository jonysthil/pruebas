<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Validacion con Jquery - Bootstrap</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<h2>Formulario de Validacion</h2>
		<form action="" role="form" class="form-horizontal">
			<div class="form-group">
				<label for="texto" class="control-label col-xs-2">Ingrese Texto : </label>
				<div class="col-xs-3">
					<input type="text" id="texto" class="form-control">
					<span class="help-block"></span>

				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-2"></div>
				<div class="col-xs-3">
					<input type="button" id="btnvalidar" class="btn btn-primary" value="Validar">
				</div>
			</div>
		</form>
	</div>
<script src="js/jquery-1.11.2.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/validacion.js"></script>
</body>
</html>