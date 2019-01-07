<?php

class OpenpaySuscripcion
{
	var $link   = null;
	var $opId   = null;
	var $opSk   = null;
	var $opSbId = null;

	// Planes de openpay.
	var $opSbId500  = null;
	var $opSbId1000 = null;

	function __construct($link)
	{
		$this->link=$link;

		// Variables definidas en el config.php
		global $cfg;

		$this->opId       = $cfg["openpay"]["id"];
		$this->opSk       = $cfg["openpay"]["llavePrivada"];
		$this->opSbId500  = $cfg["openpay"]["plan500"];
		$this->opSbId1000 = $cfg["openpay"]["plan1000"];
	}

	function generarNuevaSuscripcion($_VAR)
	{
		try
		{
			$customerData=null;
			
			// Obtenemos los datos del CLIENTE ya registrado.
			$query="select * from cliente where clt_id='".$_VAR["clt_id"]."'";
			$result = $this->oDB->execSQL($sql);
			if (is_array($result) == true)
			{
				foreach ($result as $row)
				{
					$customerData = array(
						//'external_id' => $row["clt_id"],
						'name'             => $row["clt_nombre"],
						'last_name'        => $row["clt_apellido"],
						'phone_number'     => $row["clt_telefono"],
						'email'            => $row["clt_email"],
						'requires_account' => false
					);

					//Variable definida en el paneldb/config: $tipo_planes_precio=array(0=>"0",1=>"500",2=>"1000");
					if ( $row["clt_tipocliente"]=="1" ) {
						$this->opSbId = $this->opSbId500;
					}
					if ( $row["clt_tipocliente"]=="2" ) {
						$this->opSbId = $this->opSbId1000;
					}
				}
			}

			// Error: El id cel cliente no existe.
			if ( $this->opSbId==null ) {
				throw new Exception("Error: El cliente no existe en la base de datos.");
			}

			require(dirname(__FILE__) . '/openpay/Openpay.php');

			$openpay = Openpay::getInstance($this->opId,$this->opSk);
			
			// Creamos el usuario en openpay.
			$customer = $openpay->customers->add($customerData);

			// Agremos la tarjeta al usuario.
			$cardData = array(
				'token_id' => $_POST["token_id"],
				'device_session_id' => $_POST["device_session_id"]
			);
			$card = $customer->cards->add($cardData);

			// Creamos la suscripción en openpay.
			$subscriptionData = array(
				'plan_id' => $this->opSbId,
				'card_id' => $card->id
			);
			$subscription = $customer->subscriptions->add($subscriptionData);

			//--------------------------------------------------------
			//--------------------------------------------------------
			// Actualizamos datos del cliente.
			$oSS = new SuscripcionService($this->link);
			$oSS->actualizarCliente($_VAR,$customer,$card,$subscription);

			//--------------------------------------------------------
			//--------------------------------------------------------

		} catch (OpenpayApiTransactionError $e) {
			echo $e->getMessage();
		} catch (OpenpayApiRequestError $e) {
			echo $e->getMessage();
		} catch (OpenpayApiConnectionError $e) {
			echo $e->getMessage();
		} catch (OpenpayApiAuthError $e) {
			echo $e->getMessage();
		} catch (OpenpayApiError $e) {
			echo $e->getMessage();
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
}
?>