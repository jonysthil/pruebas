<?php

class OpenpaySuscripcionService
{
	var $oDB     = null;
	var $opId   = null; // Id del usuario de openpay.
	var $opSk   = null; // Llave privada de openpay.
	var $opSbId = null; // Id de la suscripción.

	// Planes de openpay.
	var $opSbId100  = null;
	var $opSbId120 = null;
	var $opSbId150 = null;
	var $opSbId200 = null;

	function __construct($oDB)
	{
		$this->oDB=$oDB;

		// Variables definidas en el config.php
		global $cfg;

		$this->opId       = $cfg["openpay"]["id"];
		$this->opSk       = $cfg["openpay"]["llavePrivada"];
		$this->opSbId100  = $cfg["openpay"]["plan100"];
		$this->opSbId120  = $cfg["openpay"]["plan120"];
		$this->opSbId150  = $cfg["openpay"]["plan150"];
		$this->opSbId200  = $cfg["openpay"]["plan200"];
	}

	function suscribir($_VAR)
	{
		try
		{
			$customerData=null;
			
			// Obtenemos los datos del CLIENTE ya registrado.
			$sql="select * from cliente where clt_id='".$_VAR["clt_id"]."'";
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
					if ( $row["clt_tipoCliente"]=="1" ) {
						$this->opSbId = $this->opSbId100;
					}
					if ( $row["clt_tipoCliente"]=="2" ) {
						$this->opSbId = $this->opSbId120;
					}
					if ( $row["clt_tipoCliente"]=="3" ) {
						$this->opSbId = $this->opSbId150;
					}
					if ( $row["clt_tipoCliente"]=="4" ) {
						$this->opSbId = $this->opSbId200;
					}
				}
			}

			// Error: El id cel cliente no existe.
			if ( $this->opSbId==null ) {
				throw new Exception("Error: El cliente no existe en la base de datos.");
			}

			require ('./libs/openpay/Openpay.php');

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
			$oSS = new SuscripcionService($this->oDB);
			$oSS->actualizarCliente($_VAR,$customer,$card,$subscription);

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
?>