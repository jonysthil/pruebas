<?php

class OpenpayWebhookService
{
    var $link=null;

    function __construct($link)
    {
        $this->link=$link;
	}
	
	function validar()
	{
		$data = trim(file_get_contents("php://input"));
		$fp=fopen("webhook.log","a");
		fwrite($fp, $data."\n");
		fclose($fp);		
	}

    function exec($_VAR)
    {
        //Receive the RAW post data.
        $data = trim(file_get_contents("php://input"));
        //$data='{"type":"charge.succeeded","event_date":"2018-03-17T09:58:34-06:00","transaction":{"id":"trdmaysjb8f5qicbsixp","authorization":"801585","operation_type":"in","method":"card","transaction_type":"charge","card":{"id":"kxmus7awb4bh3gioflci","type":"debit","brand":"visa","address":null,"card_number":"411111XXXXXX1111","holder_name":"Jose Angel Guerrero S","expiration_year":"20","expiration_month":"12","allows_charges":true,"allows_payouts":true,"creation_date":"2018-03-17T09:58:29-06:00","bank_name":"Banamex","customer_id":"am0ufdjcye7dqvs6iyvt","bank_code":"002"},"status":"completed","conciliated":false,"creation_date":"2018-03-17T09:58:32-06:00","operation_date":"2018-03-17T09:58:32-06:00","description":"Subscription charge of period 1 of plan Contact Center $7,000 mxn / mes from customer am0ufdjcye7dqvs6iyvt","error_message":null,"order_id":null,"subscription_id":"sfqiv144s0mxvcvh0c1o","currency":"MXN","amount":7000.00,"fee":{"amount":205.50,"tax":32.8800,"currency":"MXN"}}}';

        // Guardamos la cadena recibida para su análisis.
        $this->log($data);

        //Intentamos decodificar los datos de entrada (RAW post) data desde un JSON.
        $json = json_decode($data, true);

        //If json_decode failed, the JSON is invalid.
        if( !is_array($json) ) {
            //throw new Exception('Received content contained invalid JSON!');
            exit();
        }

        // SUSCRIPCIÓN :: El evento fue generado por un cargo aceptado de una suscripción.
        if( isset($json["type"]) && $json["type"]=="charge.succeeded" && isset($json["transaction"]["subscription_id"]) && isset($json["transaction"]["card"]["customer_id"]) )
        {            
            //----------------------------
            //----------------------------
            //----------------------------
            // Actualizamos datos del asociado

            $oSS = new SuscripcionService($this->link);

            // Existe el id de transaccion
            if( $oSS->yaEsUnaTransaccionRegistrada($json["transaction"]["id"])==true ) {
                // Le decimos que ya está registrada la notificación.
                header("HTTP/1.1 200 OK");
            }

            //$oRP->registrarPago($json["transaction"]["id"],$json["transaction"]["card"]["customer_id"],$json["transaction"]["card"]["id"],$json["transaction"]["subscription_id"]);
            $oSS->registrarPago($data);

            //----------------------------
            //----------------------------
            //----------------------------

            mysqli_close($this->link);

            header("HTTP/1.1 200 OK");
        }

        header("HTTP/1.1 200 OK");
    }
    
    function log($cad)
    {
        $fp=fopen("webhook.log","a");
        fwrite($fp, $cad."\n");
        fclose($fp);
    }
}

/*
$json='{"type":"verification","event_date":"2018-05-01T09:25:26-05:00","verification_code":"GKr8F4zD","id":"w8vmm66jftkf3gy6za7l"}';
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