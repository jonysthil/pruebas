<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function send_email() {

		$this->load->library('libMailer');

		//$mail = \PHPMailer\PHPMailer\PHPMailer::IsSMTP();
		$mail = new PHPMailer\PHPMailer\PHPMailer();

		$mail->IsSMTP();
		$mail->SMTPDebug = 2;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'ssl';
		$mail->Helo = 'customcoding.com.mx';
        $mail->Host = 'mail.customcoding.com.mx';
        $mail->Port = '465';
        $mail->Username = 'noreply@customcoding.com.mx';
        $mail->Password = 'UthFjR@dfARK';
        $mail->From = 'noreply@customcoding.com.mx';
        $mail->FromName = 'Custom Coding';
        $mail->IsHTML(true);
        $mail->CharSet = "UTF-8";

        /*$mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );*/

        $mail->AddAddress('jonysthil@gmail.com', 'jonysthil@gmail.com');

        $mail->Subject = 'asunto del email';
        $mail->Body = 'contenido del email';

		$envio = $mail->Send();
		
		if ($envio) {
			echo "email enviado";
		} else {
			echo "error al envial";
		}
	}
}
