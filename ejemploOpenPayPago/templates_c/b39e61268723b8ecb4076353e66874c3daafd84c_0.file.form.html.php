<?php
/* Smarty version 3.1.30, created on 2019-01-10 17:47:03
  from "C:\wamp64\www\pruebas\ejemploOpenPayPago\openpay\openpay\assets\form.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5c37d977d40b19_13079168',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b39e61268723b8ecb4076353e66874c3daafd84c' => 
    array (
      0 => 'C:\\wamp64\\www\\pruebas\\ejemploOpenPayPago\\openpay\\openpay\\assets\\form.html',
      1 => 1546637979,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c37d977d40b19_13079168 (Smarty_Internal_Template $_smarty_tpl) {
?>

<!-- Openpay :: Inicio -->
<!--<?php echo '<script'; ?>
 type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"><?php echo '</script'; ?>
>-->
<?php echo '<script'; ?>
 type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="https://openpay.s3.amazonaws.com/openpay.v1.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type='text/javascript' src="https://openpay.s3.amazonaws.com/openpay-data.v1.min.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="openpay/openpay/assets/css/styles.css" type="text/css" media="all">

<?php echo '<script'; ?>
>
$(document).ready(function()
{
	OpenPay.setId("<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
");
	OpenPay.setApiKey("<?php echo $_smarty_tpl->tpl_vars['apiKey']->value;?>
");
	OpenPay.setSandboxMode(true);

	//Se genera el id de dispositivo
	var deviceSessionId = OpenPay.deviceData.setup("payment-form", "device_session_id");

	$('#pay-button').on('click', function(event) {
		event.preventDefault();
		$("#pay-button").prop( "disabled", true);
		OpenPay.token.extractFormAndCreate('payment-form', sucess_callbak, error_callbak);                
	});

	var sucess_callbak = function(response) {
		var token_id = response.data.id;
		$('#token_id').val(token_id);
		$('#payment-form').submit();
	};

	var error_callbak = function(response) {
	var desc = response.data.description != undefined ? response.data.description : response.message;
		alert("ERROR [" + response.status + "] " + desc);
		$("#pay-button").prop("disabled", false);
	};
});
<?php echo '</script'; ?>
>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog  modal-lg">

		<!-- Modal content-->
		<div class="modal-content">

			<!-- -->
			<div class="bkng-tb-cntnt">
				<div class="pymnts">

					<form action="" method="POST" id="payment-form">
					<input type="hidden" name="token_id" id="token_id">

					<div class="modal-header mdl-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Tarjeta de crédito o débito</h4>
						<p>Aceptamos una gran variedad de opciones de pago.</p>
					</div>

					<div class="modal-body">

						<div class="row op-cards">
							<div class="col-sm-5">
								<h2>Tarjetas de Crédito</h2>
								<img src="openpay/openpay/assets/images/cards/07.jpg" alt="Visa">
								<img src="openpay/openpay/assets/images/cards/08.jpg" alt="MasterCard">
								<img src="openpay/openpay/assets/images/cards/09.jpg" alt="Carnet">
								<img src="openpay/openpay/assets/images/cards/10.jpg" alt="American Express">
							</div>
							<div class="col-sm-7 op-l-border">
								<h2>Tarjetas de Débito</h4>
								<!-- Se pueden meter las otras tarjetas, ver "/cards/" -->
								<img src="openpay/openpay/assets/images/cards/12.jpg" alt="Bancomer">
								<img src="openpay/openpay/assets/images/cards/05.jpg" alt="Santander">
								<img src="openpay/openpay/assets/images/cards/01.jpg" alt="HSBC">
								<img src="openpay/openpay/assets/images/cards/02.jpg" alt="Scotiabank">
								<img src="openpay/openpay/assets/images/cards/04.jpg" alt="Inbursa">
								<img src="openpay/openpay/assets/images/cards/06.jpg" alt="IXE">
							</div>
							<div class="clearfix"></div>
							<hr>
						</div>

						<div class="row op-payform">

							<!-- Left Column -->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="ux-nomtitular">Nombre del Titular</label>
									<input type="text" name="holder_name" class="form-control" id="ux-nomtitular" value="Jose Angel Guerrero Sanchez" placeholder="Como aparece en la tarjeta" autocomplete="off" data-openpay-card="holder_name">
								</div>
								<div class="form-group op-bigfont">
									<label for="ux-numcard">Número de tarjeta</label>
									<input type="text" name="card_number" class="form-control" id="ux-numcard" autocomplete="off" value="4111111111111111" data-openpay-card="card_number" placeholder="···· ···· ···· 1234" maxlength="16">
								</div>
							</div>

							<!-- Right Column -->
							<div class="col-sm-6 form-inline">
								<div class="form-group op-bigfont">
									<label>Fecha de expiración</label><br>
									<input class="form-control" type="text" name="expiration_month" value="12" placeholder="mm" data-openpay-card="expiration_month" maxlength="3">
									<input class="form-control" type="text" name="expiration_year" value="18" placeholder="aa" data-openpay-card="expiration_year" maxlength="2">
									<div class="clearfix"></div>
								</div>

								<div class="form-group op-bigfont">
									<label for="ux-secnum">Código de seguridad</label><br>
									<input type="text" name="cvv2" class="form-control" id="ux-secnum" value="123" placeholder="3 dígitos" autocomplete="off" data-openpay-card="cvv2" maxlength="3">
									<img class="op-cvv-icos" src="openpay/openpay/assets/images/cvv2.png" alt="cvv">
								</div>
							</div>
						</div>

						<div class="clearfix"></div>
						<hr>

						<!-- Secure notice -->
						<div class="col-sm-6 op-notices">
							<div class="openpay">Transacciones realizadas vía: <img src="openpay/openpay/assets/images/openpay.png" alt="OpenPay"></div>
							<div class="shield"><img src="openpay/openpay/assets/images/security.png" alt="Secure">Tus pagos se realizan de forma segura con encriptación de 256 bits</div>
							<div class="clearfix"></div>
						</div>

						<!-- Pay Button -->
						<div class="col-sm-6">
							<a class="btn btn-md btn-block btn-default btn-custom" id="pay-button">Pagar  <i class="fa fa-credit-card"></i></a>
						</div>
						<div class="clearfix"></div>

					</div>

				</form>
				</div>
			</div>
			<!-- -->
		</div>

	</div>
</div>
<!-- Openpay :: Fin -->
<?php }
}
