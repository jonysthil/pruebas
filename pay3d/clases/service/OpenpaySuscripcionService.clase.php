<?php

class OpenpaySuscripcionService
{
	var $oDB     = null;
	var $opId   = null; // Id del usuario de openpay.
	var $opSk   = null; // Llave privada de openpay.
	var $opSbId = null; // Id de la suscripción.

	// Planes de openpay.
	var $opSbId500  = null;
	var $opSbId1000 = null;

	function __construct($oDB)
	{
		$this->oDB=$oDB;

		// Variables definidas en el config.php
		global $cfg;

		$this->opId       = $cfg["openpay"]["id"];
		$this->opSk       = $cfg["openpay"]["llavePrivada"];
		$this->opSbId500  = $cfg["openpay"]["plan500"];
		$this->opSbId1000 = $cfg["openpay"]["plan1000"];
	}

	function suscribir($_VAR)
	{
		try
		{
			$customerData=null;
			
			// Obtenemos los datos del CLIENTE ya registrado.
			//$sql="select * from cliente where clt_id='".$_VAR["clt_id"]."'";
			//$result = $this->oDB->execSQL($sql);
			//if (is_array($result) == true)
			//{
				//foreach ($result as $row)
				//{
					$customerData = array(
						'external_id'      => uniqid(),//$row["clt_id"],
						'name'             => "José Angel",                //$row["clt_nombre"],
						'last_name'        => "Guerrero Sánchez",          //$row["clt_apellido"],
						'phone_number'     => "5518229808",                //$row["clt_telefono"],
						'email'            => "guerreroangel@hotmail.com", //$row["clt_email"],
						'requires_account' => false
					);

					//Variable definida en el paneldb/config: $tipo_planes_precio=array(0=>"0",1=>"500",2=>"1000");
					/*
					if ( $row["clt_tipoCliente"]=="1" ) {
						$this->opSbId = $this->opSbId500;
					}
					if ( $row["clt_tipoCliente"]=="2" ) {
						$this->opSbId = $this->opSbId1000;
					}
					*/
					$this->opSbId = "p3odwoysv1mf7klyucqm";
				//}
			//}

			// Error: El id cel cliente no existe.
			if ( $this->opSbId==null ) {
				throw new Exception("Error: El cliente no existe en la base de datos.");
			}

			require ('./libs/Openpay/Openpay.php');

			$openpay = Openpay::getInstance($this->opId,$this->opSk);
			
			// Creamos el usuario en openpay.
			$customer = $openpay->customers->add($customerData);

			// Agremos la tarjeta al usuario.
			
			$cardData = array(
				'token_id' => $_POST["token_id"],
				'device_session_id' => $_POST["device_session_id"],
				"use_3d_secure" => "true",
				"redirect_url" => "http://www.proyectosweb.mx/demos/Openpay/pagarSuscripcionRespuesta"
			);
			$card = $customer->cards->add($cardData);
			

			/*
			$chargeData = array(
				'method' => 'card',
				//"order_id" => uniqid(),
				//'amount' => (float)$pd_total,
				//'description' => $pd_descripcion,
				'source_id' => $_POST["token_id"],
				'device_session_id' => $_POST["device_session_id"],
				"use_3d_secure" => "true",
				"redirect_url" => "http://www.proyectosweb.mx/demos/openpay/pagarPedidoRespuesta",
				'customer' => $customer
			);
			$card = $customer->cards->add($chargeData);
			*/

			// Creamos la suscripción en openpay.
			$subscriptionData = array(
				'plan_id' => $this->opSbId,
				'card_id' => $card->id
			);
			$subscription = $customer->subscriptions->add($subscriptionData);

			echo "url: ".$subscription->payment_method->url;

			print_r($subscription);



			/*
			if( $subscription!=null )
        	{
            	header("location: ".$subscription->payment_method->url."");
			}
			*/

			//--------------------------------------------------------
			//--------------------------------------------------------
			// Actualizamos datos del cliente.
			/*
			$oSS = new SuscripcionService($this->oDB);
			$oSS->actualizarCliente($_VAR,$customer,$card,$subscription);
			*/

			//--------------------------------------------------------
			//--------------------------------------------------------

			return true;

		} catch (OpenpayApiTransactionError $e) {
			$this->error = "Error ".$e->getErrorCode().": ".$e->getMessage();echo $this->error;
			return false;
		} catch (OpenpayApiRequestError $e) {
			$this->error = "Error ".$e->getErrorCode().": ".$e->getMessage();echo $this->error;
			return false;
		} catch (OpenpayApiConnectionError $e) {
			$this->error = "Error ".$e->getErrorCode().": ".$e->getMessage();echo $this->error;
			return false;
		} catch (OpenpayApiAuthError $e) {
			$this->error = "Error ".$e->getErrorCode().": ".$e->getMessage();echo $this->error;
			return false;
		} catch (OpenpayApiError $e) {
			$this->error = "Error ".$e->getErrorCode().": ".$e->getMessage();echo $this->error;
			return false;
		} catch (Exception $e) {
			$this->error = "Error ".$e->getErrorCode().": ".$e->getMessage();echo $this->error;
			return false;
		}
	}

	function  suscribirRespuesta($transactionId)
	{
		require ('./libs/Openpay/Openpay.php');

		try
		{
			$openpay = Openpay::getInstance($this->opId,$this->opSk);

			$charge = $openpay->charges->get($transactionId);

			//return $charge;

			print_r($charge);

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