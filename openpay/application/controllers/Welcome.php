<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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

	public function index() {
		$data = array(
			'open_id' => $this->open_id,
			'open_sk' => $this->open_sk,
			'open_pk' => $this->open_pk,
		);
		$this->load->view('home', $data);
	}
}
