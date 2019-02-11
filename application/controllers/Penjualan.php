<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
	}

	function penjualan()
	{
		
	}
}
// UNSET THINGS
// $this->session->unset_userdata('sesi');
// var_dump($this->session->userdata('sesi'));