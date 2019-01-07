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
			require ('./libs/openpay/Openpay.php');

			// Obtenemos los datos del cliente.
			$clt_id         = null;
			$pd_total       = null;
			$pd_descripcion = null;
			$customer       = null;

			// Obtenemos los datos del pedido.
			$sql="select * from pedido left join cliente on cliente.clt_id=pedido.clt_id where pd_id='".$_VAR["pd_id"]."'";
			$result = $this->oDB->execSQL($sql);
			if (is_array($result) == true)
			{
				foreach ($result as $row)
				{
					$clt_id                = $row["clt_id"];
					$pd_total              = $row["pd_total"];
					$pd_descripcion        = "Pago del pedido : #".$row["pd_id"];

					$customer = array(
						'name'             => $row["clt_nombre"],
						'last_name'        => $row["clt_apellido"],
						'phone_number'     => $row["clt_telefono"],
						'email'            => $row["clt_email"],
						'requires_account' => false
					);
				}
			}

			if( $clt_id==null ) {
				echo "Error 2: La transacción no se puede realizar, contacte al administrador.";
				exit();
			}

			$openpay = Openpay::getInstance($this->opId,$this->opSk);

			// Realizamos el cargo.
			$chargeData = array(
				'method' => 'card',
				'source_id' => $_POST["token_id"],
				'amount' => (float)$pd_total,
				'description' => $pd_descripcion,
				'device_session_id' => $_POST["device_session_id"],
				'customer' => $customer
			);
			$charge = $openpay->charges->create($chargeData);			
			//--------------------------------------------------------
			//--------------------------------------------------------

				$oPS = new PedidoService($this->oDB);
				$oPS->actualizarPedido($_VAR,$charge);

			//--------------------------------------------------------
			//--------------------------------------------------------

			return true;

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