<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
require_once 'PHPMailer/src/Exception.php';

class LibMailer {

    public function __contruct() {
        $this->ci =& get_instance();
    }
}

?>
