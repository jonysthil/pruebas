<?php

use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

class PayPal
{
	var $urlResp = "http://www.cloudnetwork.mx/paypalJon/paypalResponse.php";

	function __construct() {

	}

	function boton($pd_id, $precioTotal, $costoEnvio)
	{
		$html ="";
		$html.="<form action='paypalCheckout.php' method='post'>";
		$html.="<input type='hidden' name='pd_id' value='".$pd_id."'>";
		$html.="<input type='hidden' name='precioTotal' value='".$precioTotal."'>";
		$html.="<input type='hidden' name='costoEnvio' value='".$costoEnvio."'>";
		$html.="<input type='image' name='submit' src='https://www.paypalobjects.com/webstatic/es_MX/mktg/logos-buttons/redesign/btn_10.png' border='0' alt='Pagar con PayPal' />";
		$html.="</form>";

		return $html;
	}

	function pagar($_VAR)
	{
		Global $cfg;

		if( !isset($_VAR["pd_id"],$_VAR["precioTotal"]) ) { die(); }
		
		$pd_id        = $_VAR["pd_id"];
		$precioTotal  = $_VAR["precioTotal"];
		$costoEnvio   = $_VAR["costoEnvio"];
		
		$total        = $precioTotal + $costoEnvio;

		//---------------------------------

		$paypal = new \PayPal\Rest\ApiContext(new \PayPal\Auth\OAuthTokenCredential($cfg["paypal"]["clientId"],$cfg["paypal"]["password"]));
		
		//---------------------------------
		
		$details = new Details();
		$details->setShipping($costoEnvio)->setSubtotal($precioTotal);

		//---------------------------------
		
		$amount = new Amount();
		$amount->setCurrency('MXN')->setTotal($total)->setDetails($details);
		
		//---------------------------------
		// Productos.
		$item = new Item();
		$item->setName('Pedido #'.$pd_id.'')->setCurrency('MXN')->setQuantity(1)->setPrice($precioTotal);
		
		$itemList = new ItemList();
		$itemList->setItems([$item]);
		
		//---------------------------------
		
		$transaction = new Transaction();
		$transaction->setAmount($amount)->setItemList($itemList)->setDescription('Pedido #'.$pd_id.'')->setInvoiceNumber($pd_id);
		
		//---------------------------------
		
		$redirectUrls = new RedirectUrls();
		$redirectUrls->setReturnUrl($this->urlResp.'?success=true')->setCancelUrl($this->urlResp.'?success=false');
		
		//---------------------------------
		
		$payer = new Payer();
		$payer->setPaymentMethod('paypal');
		
		//---------------------------------
		
		$payment = new Payment();
		$payment->setIntent('sale')->setPayer($payer)->setRedirectUrls($redirectUrls)->setTransactions([$transaction]);
		
		try{
			$payment->create($paypal);
			header( "location: ".$payment->getApprovalLink() );
		} catch (\PayPal\Exception\PayPalConnectionException $e) {
			$this->error="No se realizó el cargo";
			return false;
		}

		//---------------------------------
	}

	function pagoRespuesta($_VAR)
	{
		Global $cfg;

		if( !isset($_VAR["success"],$_VAR["paymentId"],$_VAR["PayerID"]) ) { die(); }
		if( (bool)$_VAR["success"]===false )                               { die(); }

		//---------------------------------

		$paymentId = $_VAR["paymentId"];
		$payerId   = $_VAR["PayerID"];

		$paypal = new \PayPal\Rest\ApiContext(new \PayPal\Auth\OAuthTokenCredential($cfg["paypal"]["clientId"],$cfg["paypal"]["password"]));

		$payment = Payment::get($paymentId,$paypal);

		$execute = new PaymentExecution();
		$execute->setPayerId($payerId);

		try {

			$result = $payment->execute($execute,$paypal);

			$data =json_decode( $result );

			return $data;
	
		}catch (Exception $e){

			$this->error="No se realizó el cargo";

			return false;
		}
	}

	function obtenerError()
	{
		return $this->error;
	}
}

/*
//Respuesta exitosa

stdClass Object
(
    [id] => PAY-8WS02652PS7221351LNDZ6OA
    [intent] => sale
    [state] => approved
    [cart] => 5RT95917U69172830
    [payer] => stdClass Object
        (
            [payment_method] => paypal
            [status] => VERIFIED
            [payer_info] => stdClass Object
                (
                    [email] => guerreroangel-buyer@hotmail.com
                    [first_name] => test
                    [last_name] => buyer
                    [payer_id] => P6YXEJSD29ASW
                    [shipping_address] => stdClass Object
                        (
                            [recipient_name] => test buyer
                            [line1] => Calle Juarez 1
                            [city] => Miguel Hidalgo
                            [state] => Ciudad de Mexico
                            [postal_code] => 11580
                            [country_code] => MX
                        )

                    [country_code] => MX
                )

        )

    [transactions] => Array
        (
            [0] => stdClass Object
                (
                    [amount] => stdClass Object
                        (
                            [total] => 12.00
                            [currency] => MXN
                            [details] => stdClass Object
                                (
                                    [subtotal] => 10.00
                                    [shipping] => 2.00
                                )

                        )

                    [payee] => stdClass Object
                        (
                            [merchant_id] => EZSBQ9RPCTPDQ
                            [email] => guerreroangel-facilitator@hotmail.com
                        )

                    [description] => PayForSomthing
                    [invoice_number] => 5b479f37b7fb4
                    [item_list] => stdClass Object
                        (
                            [items] => Array
                                (
                                    [0] => stdClass Object
                                        (
                                            [name] => Producto 1
                                            [price] => 10.00
                                            [currency] => MXN
                                            [quantity] => 1
                                        )

                                )

                            [shipping_address] => stdClass Object
                                (
                                    [recipient_name] => test buyer
                                    [line1] => Calle Juarez 1
                                    [city] => Miguel Hidalgo
                                    [state] => Ciudad de Mexico
                                    [postal_code] => 11580
                                    [country_code] => MX
                                )

                        )

                    [related_resources] => Array
                        (
                            [0] => stdClass Object
                                (
                                    [sale] => stdClass Object
                                        (
                                            [id] => 74469753K9090074E
                                            [state] => completed
                                            [amount] => stdClass Object
                                                (
                                                    [total] => 12.00
                                                    [currency] => MXN
                                                    [details] => stdClass Object
                                                        (
                                                            [subtotal] => 10.00
                                                            [shipping] => 2.00
                                                        )

                                                )

                                            [payment_mode] => INSTANT_TRANSFER
                                            [protection_eligibility] => ELIGIBLE
                                            [protection_eligibility_type] => ITEM_NOT_RECEIVED_ELIGIBLE,UNAUTHORIZED_PAYMENT_ELIGIBLE
                                            [transaction_fee] => stdClass Object
                                                (
                                                    [value] => 5.19
                                                    [currency] => MXN
                                                )

                                            [parent_payment] => PAY-8WS02652PS7221351LNDZ6OA
                                            [create_time] => 2018-07-12T18:35:02Z
                                            [update_time] => 2018-07-12T18:35:02Z
                                            [links] => Array
                                                (
                                                    [0] => stdClass Object
                                                        (
                                                            [href] => https://api.sandbox.paypal.com/v1/payments/sale/74469753K9090074E
                                                            [rel] => self
                                                            [method] => GET
                                                        )

                                                    [1] => stdClass Object
                                                        (
                                                            [href] => https://api.sandbox.paypal.com/v1/payments/sale/74469753K9090074E/refund
                                                            [rel] => refund
                                                            [method] => POST
                                                        )

                                                    [2] => stdClass Object
                                                        (
                                                            [href] => https://api.sandbox.paypal.com/v1/payments/payment/PAY-8WS02652PS7221351LNDZ6OA
                                                            [rel] => parent_payment
                                                            [method] => GET
                                                        )

                                                )

                                        )

                                )

                        )

                )

        )

    [redirect_urls] => stdClass Object
        (
            [return_url] => http://www.cloudnetwork.mx/paypal/pay.php?success=true&paymentId=PAY-8WS02652PS7221351LNDZ6OA
            [cancel_url] => http://www.cloudnetwork.mx/paypal/pay.php?success=false
        )

    [create_time] => 2018-07-12T18:35:04Z
    [update_time] => 2018-07-12T18:35:01Z
    [links] => Array
        (
            [0] => stdClass Object
                (
                    [href] => https://api.sandbox.paypal.com/v1/payments/payment/PAY-8WS02652PS7221351LNDZ6OA
                    [rel] => self
                    [method] => GET
                )

        )

)
*/
?>