<?php
/* Smarty version 3.1.30, created on 2018-12-01 01:46:01
  from "58ab63c1e858713df3c88de6b17c8309ef881562" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5c023c39c7cca1_33483679',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c023c39c7cca1_33483679 (Smarty_Internal_Template $_smarty_tpl) {
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
