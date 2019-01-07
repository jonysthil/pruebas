<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConektaPagar extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//require_once('./application/libraries/conekta/lib/conekta.php');
		$this->load->library('conekta/lib/conekta');
		\Conekta\Conekta::setApiKey("key_jmEBFSNVWgCXK8TVqoEsXA");
		\Conekta\Conekta::setApiVersion("2.0.0");
		\Conekta\Conekta::setLocale('es');
	}
	
	public function pagar()
	{
		

		try {
			$customer = \Conekta\Customer::create(
				array(
				  'name'  => "Mario Perez",
				  'email' => "usuario@example.com",
				  'phone' => "+5215555555555",
				  'payment_sources' => array(array(
					  'token_id' => "tok_test_visa_4242",
					  'type' => "card"
				  )),
				  'shipping_contacts' => array(array(
					'phone' => "+5215555555555",
					'receiver' => "Marvin Fuller",
					'address' => array(
					  'street1' => "Nuevo Leon 4",
					  'street2' => "fake street",
					  'country' => "MX",
					  'postal_code' => "06100"
					)
				  ))
				)
			  );

			
		  } catch (\Conekta\ProccessingError $error){
			echo $error->getMesage();
		  } catch (\Conekta\ParameterValidationError $error){
			echo $error->getMessage();
		  } catch (\Conekta\Handler $error){
			echo $error->getMessage();
		  }
		
		  

		  try{
			$order = \Conekta\Order::create(
			  array(
				"line_items" => array(
				  array(
					"name" => "Tacos",
					"unit_price" => 1000,
					"quantity" => 12
				  )//first line_item
				), //line_items
				"shipping_lines" => array(
				  array(
					"amount" => 1500,
					 "carrier" => "FEDEX"
				  )
				), //shipping_lines - physical goods only
				"currency" => "MXN",
				"customer_info" => array(
				  "customer_id" => $customer->id
				), //customer_info
				"shipping_contact" => array(
				  "address" => array(
					"street1" => "Calle 123, int 2",
					"postal_code" => "06100",
					"country" => "MX"
				  )//address
				), //shipping_contact - required only for physical goods
				"metadata" => array("reference" => "12987324097", "more_info" => "lalalalala"),
				"charges" => array(
					array(
						"payment_method" => array(
								"type" => "default"
						) //payment_method - use customer's default - a card
						  //to charge a card, different from the default,
						  //you can indicate the card's source_id as shown in the Retry Card Section
					) //first charge
				) //charges
			  )//order
			);
		  } catch (\Conekta\ProcessingError $error){
			echo $error->getMessage();
		  } catch (\Conekta\ParameterValidationError $error){
			echo $error->getMessage();
		  } catch (\Conekta\Handler $error){
			echo $error->getMessage();
		  }	
		  echo "ID: ". $order->id . "<br>";
			echo "Status: ". $order->payment_status. "<br>";
			echo "Monto $". $order->amount/100 . $order->currency. "<br>";
			echo "Order". "<br>";
			echo $order->line_items[0]->quantity .
				"-". $order->line_items[0]->name .
				"- $". $order->line_items[0]->unit_price/100;
			echo "Payment info";
			echo "CODE:". $order->charges[0]->payment_method->auth_code;
			echo "Card info:" .
			"- ". $order->charges[0]->payment_method->name .
			"- ". $order->charges[0]->payment_method->last4 .
			"- ". $order->charges[0]->payment_method->brand .
			"- ". $order->charges[0]->payment_method->type;


// Response
// ID: ord_2fsQdMUmsFNP2WjqS
// $ 135.0 MXN
// Order
// 12 - Tacos - $10.0
// Payment info
// CODE: 035315
// Card info: 4242 - visa - banco - credit

		  
		  
		
	}
}
