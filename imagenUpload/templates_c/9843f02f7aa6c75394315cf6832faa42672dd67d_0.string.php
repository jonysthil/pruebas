<?php
/* Smarty version 3.1.30, created on 2019-01-10 17:50:18
  from "9843f02f7aa6c75394315cf6832faa42672dd67d" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5c37da3a7f0c99_11782297',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c37da3a7f0c99_11782297 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="es">
	<head>
    	<meta charset="utf-8"> 
		<link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
	</head>
<body>

	<div class="container">

		<form action="subirImagen" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="imagen">Carga tu imagen</label>
				<input id="imagen" name="subir" type="file" class="form-control">
			</div>
			<button type="submit" class="btn btn-sm btn-primary">Enviar</button>
		</form>
		<?php if (isset($_GET['v']) && $_GET['v'] == 'god') {?>
		<p class="text-success">La imagen fue aceptada.</p>
		<?php } elseif (isset($_GET['v']) && $_GET['v'] == 'peso') {?>
		<p class="text-danger">El peso de la imagen sobrepasa de los 5MB permitidos.</p>
		<?php } elseif (isset($_GET['v']) && $_GET['v'] == 'tipo') {?>
		<p class="text-danger">El formato de la imagen no es permitida.</p>
		<?php }?>
	</div>


<?php echo '<script'; ?>
 src="node_modules/bootstrap/dist/js/bootstrap.min.js"><?php echo '</script'; ?>
>
</body>
</html><?php }
}
