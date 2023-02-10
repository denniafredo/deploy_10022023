<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DaftarAgenAktif extends CI_Controller {

    function __construct() {
        parent::__construct();
		$this->load->model('api_model');
    }
	
	function index(){
		//$daftarAgen = $this->api_model->get_agen_aktif();
		//echo json_encode($daftarAgen,TRUE);exit;
	}
}