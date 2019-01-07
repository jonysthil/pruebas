<?php
/* Smarty version 3.1.30, created on 2018-12-01 01:40:07
  from "e4faf6dc567ea90f6ef432247808e27ddf1ac740" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5c023ad77834e6_14639092',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
  ),
  'includes' => 
  array (
    'file:openpay/openpay/assets/form.html' => 1,
  ),
),false)) {
function content_5c023ad77834e6_14639092 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8"> 
  </head>
<body>

<?php echo '<script'; ?>
 type="text/javascript">
function abrirFormaPago()
{
    document.getElementById("payment-form").action = "pagarPedido.html";

    //--
    var input = document.createElement("input");
    input.setAttribute("type", "hidden");
    input.setAttribute("name", "pd_id");
    input.setAttribute("value", "1");

    document.getElementById("payment-form").appendChild(input);
    //--
                
    $('#myModal').modal('show');
}
<?php echo '</script'; ?>
>

<button type="button" onClick="javascript:abrirFormaPago()" class="btn btn-primary"> Pagar con Tarjeta</button>



<?php $_smarty_tpl->_subTemplateRender("file:openpay/openpay/assets/form.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>



<?php if (isset($_GET['msg']) == true) {
echo '<script'; ?>
>
  alert("<?php echo $_GET['msg'];?>
");
<?php echo '</script'; ?>
>
<?php }?>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"><?php echo '</script'; ?>
>

<!-- Latest compiled JavaScript -->
<?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"><?php echo '</script'; ?>
>

</body>
</html><?php }
}
