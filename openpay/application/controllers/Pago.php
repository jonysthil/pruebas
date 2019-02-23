<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pago extends CI_Controller {

	private $open_id;
    private $open_sk;
    private $open_pk;

    public function __construct() {
		parent::__construct();
		
        $CI =& get_instance();
        $CI->load->config('miconfig', TRUE);
        $this->open_id = $CI->config->item('open_id', 'miconfig');
        $this->open_sk = $CI->config->item('open_sk', 'miconfig');
        $this->open_pk = $CI->config->item('open_pk', 'miconfig');
    }

	public function pagarPedido($pddId) {

		if( $pddId == NULL  || $pddId == "" ) {
			echo "Error 1: La transacción no se puede realizar, contacte al administrador.";
			exit();
		}

		try {
			//require_once('./application/libraries/openpayapi/Openpaybase.php');
			$this->load->library('openpayapi/Openpaybase');

			// Obtenemos los datos del cliente.
			$clt_id         = '15';
			$pd_total       = '1000.87';
			$pd_descripcion = 'Compra #' . $pddId;
			$customer        = null;

			// Obtenemos los datos del pedido.
			$customer = array(
				'name'             => 'Jonathan',
				'last_name'        => 'Jimenez',
				'phone_number'     => '5538030380',
				'email'            => 'jonysthil@gmail.com',
				'requires_account' => false
			);

			if( $clt_id == null ) {
				echo "Error 2: La transacción no se puede realizar, contacte al administrador.";
				exit();
			}

			$openpay = Openpay::getInstance($this->open_id, $this->open_sk);

			// Realizamos el cargo.
			$chargeData = array(
				'method' => 'card',
				'source_id' => $_POST["token_id"],
				'amount' => (float)$pd_total,
				'description' => $pd_descripcion,
				'device_session_id' => $_POST["deviceIdHiddenFieldName"],
				'customer' => $customer
			);
			$charge = $openpay->charges->create($chargeData);			
			//--------------------------------------------------------
			//--------------------------------------------------------

				/*$oPS = new PedidoService($this->oDB);
				$oPS->actualizarPedido($_VAR,$charge);*/

				echo "<pre>";
				print_r($charge);
				echo "</pre>";

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
	
	function obtenerError() {
		return $this->error;
	}

}
