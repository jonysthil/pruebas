<?php

class OpenpayPagoService
{
	var $oDB = null;
	var $opId = null;
	var $opSk = null;
	var $error = null;

	function __construct($oDB)
	{
		$this->oDB=$oDB;

		// Variables definidas en el config.php
		global $cfg;

		$this->opId       = $cfg["openpay"]["id"];
		$this->opSk       = $cfg["openpay"]["llavePrivada"];
	}

	function realizarCargo($_VAR)
	{
		if( $_VAR["pd_id"]==null  || $_VAR["pd_id"]=="" ) {
			echo "Error 1: La transacción no se puede realizar, contacte al administrador.";
			exit();
		}

		try
		{
			require ('./libs/Openpay/Openpay.php');

			// Obtenemos los datos del pedido.
			//$sql="select * from pedido left join cliente on cliente.clt_id=pedido.clt_id where pd_id='".$_VAR["pd_id"]."'";
			//$result = $this->oDB->execSQL($sql);
			//if (is_array($result) == true)
			//{
				//foreach ($result as $row)
				//{
					$clt_id                = "1";                          //$row["clt_id"];
					$pd_total              = "99.99";                      //$row["pd_total"];
					$pd_descripcion        = "Pago del pedido : #1";       //"Pago del pedido : #".$row["pd_id"];

					$customer = array(
						'name'             => "José Angel",                //$row["clt_nombre"],
						'last_name'        => "Guerrero Sánchez",          //$row["clt_apellido"],
						'phone_number'     => "5518229808",                //$row["clt_telefono"],
						'email'            => "guerreroangel@hotmail.com", //$row["clt_email"],
						'requires_account' => false
					);
				//}
			//}

			if( $clt_id==null ) {
				echo "Error 2: La transacción no se puede realizar, contacte al administrador.";
				exit();
			}

			$openpay = Openpay::getInstance($this->opId,$this->opSk);

			// Realizamos el cargo.
			$chargeData = array(
				'method' => 'card',
				"order_id" => uniqid(),
				'amount' => (float)$pd_total,
				'description' => $pd_descripcion,
				'source_id' => $_POST["token_id"],
				'device_session_id' => $_POST["device_session_id"],
				"use_3d_secure" => "true",
				"redirect_url" => "http://www.proyectosweb.mx/demos/openpay/pagarPedidoRespuesta",
				'customer' => $customer
			);
			$charge = $openpay->charges->create($chargeData);

			return $charge;
			

		} catch (OpenpayApiTransactionError $e) {
			$this->error = "Error ".$e->getErrorCode().": ".$e->getMessage();
			return false;
		} catch (OpenpayApiRequestError $e) {
			$this->error = "Error ".$e->getErrorCode().": ".$e->getMessage();
			return false;
		} catch (OpenpayApiConnectionError $e) {
			$this->error = "Error ".$e->getErrorCode().": ".$e->getMessage();
			return false;
		} catch (OpenpayApiAuthError $e) {
			$this->error = "Error ".$e->getErrorCode().": ".$e->getMessage();
			return false;
		} catch (OpenpayApiError $e) {
			$this->error = "Error ".$e->getErrorCode().": ".$e->getMessage();
			return false;
		} catch (Exception $e) {
			$this->error = "Error ".$e->getErrorCode().": ".$e->getMessage();
			return false;
		}
	}

	function  realizarCargoComprobar($transactionId)
	{
		require ('./libs/Openpay/Openpay.php');

		try
		{
			$openpay = Openpay::getInstance($this->opId,$this->opSk);

			$charge = $openpay->charges->get($transactionId);

			return $charge;


		} catch (OpenpayApiTransactionError $e) {
			$this->error = "Error ".$e->getErrorCode().": ".$e->getMessage();
			return false;
		} catch (OpenpayApiRequestError $e) {
			$this->error = "Error ".$e->getErrorCode().": ".$e->getMessage();
			return false;
		} catch (OpenpayApiConnectionError $e) {
			$this->error = "Error ".$e->getErrorCode().": ".$e->getMessage();
			return false;
		} catch (OpenpayApiAuthError $e) {
			$this->error = "Error ".$e->getErrorCode().": ".$e->getMessage();
			return false;
		} catch (OpenpayApiError $e) {
			$this->error = "Error ".$e->getErrorCode().": ".$e->getMessage();
			return false;
		} catch (Exception $e) {
			$this->error = "Error ".$e->getErrorCode().": ".$e->getMessage();
			return false;
		}
	}

	function obtenerError()
	{
		return $this->error;
	}

    function debug($cad)
    {
        $fp=fopen("debug.log","a");
        fwrite($fp, $cad."\n");
        fclose($fp);
    }
}

/*
Ejemplo de respuesta
{
   "id":"trzjaozcik8msyqshka4",
   "amount":100.00,
   "authorization":"801585",
   "method":"card",
   "operation_type":"in",
   "transaction_type":"charge",
   "card":{
      "id":"kqgykn96i7bcs1wwhvgw",
      "type":"debit",
      "brand":"visa",
      "address":null,
      "card_number":"411111XXXXXX1111",
      "holder_name":"Juan Perez Ramirez",
      "expiration_year":"20",
      "expiration_month":"12",
      "allows_charges":true,
      "allows_payouts":true,
      "creation_date":"2014-05-26T11:02:16-05:00",
      "bank_name":"Banamex",
      "bank_code":"002"
   },
   "status":"completed",
   "currency":"USD",
   "exchange_rate" : {
      "from" : "USD",
      "date" : "2014-11-21",
      "value" : 13.61,
      "to" : "MXN"
   },
   "creation_date":"2014-05-26T11:02:45-05:00",
   "operation_date":"2014-05-26T11:02:45-05:00",
   "description":"Cargo inicial a mi cuenta",
   "error_message":null,
   "order_id":"oid-00051"
}
*/
?>