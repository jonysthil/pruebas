<?php

class SuscripcionService
{
	var $oDB = null;

	function __construct($oDB)
	{
		$this->oDB=$oDB;
	}

	function actualizarCliente($_VAR,$custumer,$card,$suscription)
	{
		$sql="update cliente set clt_openpayCustomer='".$custumer->id."',clt_openpayCard='".$card->id."',clt_openpaySuscripcion='".$suscription->id."' where clt_id='".$_VAR["clt_id"]."'";
		return $this->oDB->execSQL($sql);
	}

	function yaEsUnaTransaccionRegistrada($transactionId)
	{
		$sql    = "select clt_id from pagoPlan where clt_openpayTransaction='".$transactionId."'";
		$result = $this->oDB->execSQL($sql);

		if (is_array($result) == true) {
            foreach ($result as $row) {
				return true;
			}
		}
		return false;
	}

	function registrarPago($data)
	{
		$clt_id = null;

		$sql    = "select clt_id from cliente where clt_openpayCustomer='".$data->transaction->card->customer_id."'";
		$result = $this->oDB->execSQL($sql);

		if (is_array($result) == true) {
            foreach ($result as $row) {
				$clt_id = $row["clt_id"];
			}
		}

		if( $data->type="charge.succeeded" )
		{
			$pp_estatus               = $data->status;
			$pp_monto                 = $data->transaction->amount;
			$pp_fechaCoverturaInicial = date("Y-m-d H:i:s");
			$pp_fechaCoverturaFinal   = date("Y-m-d H:i:s",strtotime ( '+1 month' , strtotime ( $pp_fechaCoverturaInicial ) ));
			$pp_fechaRegistro         = date("Y-m-d H:i:s");
			$pp_openpayTransaccion    = $data->transaction->id;
	
			$sql="
			insert into pagoPlan
				clt_id,
				pp_estatus,
				pp_monto,
				pp_fechaCoverturaInicial,
				pp_fechaCoverturaFinal,
				pp_fechaRegistro,
				pp_openpayTransaccion
			)
			values
			(
				'".$clt_id."',
				'".$pp_estatus."',
				'".$pp_monto."',
				'".$pp_fechaCoverturaInicial."',
				'".$pp_fechaCoverturaFinal."',
				'".$pp_fechaRegistro."',
				'".$pp_openpayTransaccion."'
			)
			";
			return $this->oDB->execSQL($sql);
		}

	}

}
/*
$data='{"type":"charge.succeeded","event_date":"2018-03-17T09:58:34-06:00","transaction":{"id":"trdmaysjb8f5qicbsixp","authorization":"801585","operation_type":"in","method":"card","transaction_type":"charge","card":{"id":"kxmus7awb4bh3gioflci","type":"debit","brand":"visa","address":null,"card_number":"411111XXXXXX1111","holder_name":"Jose Angel Guerrero S","expiration_year":"20","expiration_month":"12","allows_charges":true,"allows_payouts":true,"creation_date":"2018-03-17T09:58:29-06:00","bank_name":"Banamex","customer_id":"am0ufdjcye7dqvs6iyvt","bank_code":"002"},"status":"completed","conciliated":false,"creation_date":"2018-03-17T09:58:32-06:00","operation_date":"2018-03-17T09:58:32-06:00","description":"Subscription charge of period 1 of plan Contact Center $7,000 mxn / mes from customer am0ufdjcye7dqvs6iyvt","error_message":null,"order_id":null,"subscription_id":"sfqiv144s0mxvcvh0c1o","currency":"MXN","amount":7000.00,"fee":{"amount":205.50,"tax":32.8800,"currency":"MXN"}}}';
{
	"type": "charge.succeeded",
	"event_date": "2018-03-17T09:58:34-06:00",
	"transaction": {
		"id": "trdmaysjb8f5qicbsixp",
		"authorization": "801585",
		"operation_type": "in",
		"method": "card",
		"transaction_type": "charge",
		"card": {
			"id": "kxmus7awb4bh3gioflci",
			"type": "debit",
			"brand": "visa",
			"address": null,
			"card_number": "411111XXXXXX1111",
			"holder_name": "Jose Angel Guerrero S",
			"expiration_year": "20",
			"expiration_month": "12",
			"allows_charges": true,
			"allows_payouts": true,
			"creation_date": "2018-03-17T09:58:29-06:00",
			"bank_name": "Banamex",
			"customer_id": "am0ufdjcye7dqvs6iyvt",
			"bank_code": "002"
		},
		"status": "completed",
		"conciliated": false,
		"creation_date": "2018-03-17T09:58:32-06:00",
		"operation_date": "2018-03-17T09:58:32-06:00",
		"description": "Subscription charge of period 1 of plan Contact Center $7,000 mxn / mes from customer am0ufdjcye7dqvs6iyvt",
		"error_message": null,
		"order_id": null,
		"subscription_id": "sfqiv144s0mxvcvh0c1o",
		"currency": "MXN",
		"amount": 7000.00,
		"fee": {
			"amount": 205.50,
			"tax": 32.8800,
			"currency": "MXN"
		}
    }
}
*/
?>