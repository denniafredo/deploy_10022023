<?php

/**
 * 
 */
class Template {
	
	protected $_ci;
	
	function __construct() {
		$this->_ci =&get_instance();
		$this->_ci->load->library('session');
		$this->_ci->load->model(array('ModSimulasi'));
	}
	
	// Modifikasi fendy
	function show($file, $data = null) {
		$template = 'simulasi';
		
		$data['_content'] = $this->_ci->load->view($template, $data, TRUE);
		$data['_hasil'] = $this->_ci->load->view($template, $data, TRUE);
		$data['_header'] = $this->_ci->load->view('template/header', $data, TRUE);
		$data['provinsis'] = $this->_ci->ModSimulasi->allProvince();
		$data['products'] = $this->_ci->ModSimulasi->allProduct();
		$data['pekerjaans'] = $this->_ci->ModSimulasi->allPekerjaan();
		$data['tarifs'] = $this->_ci->ModSimulasi->allTarif();
		//$data['_menu'] = $this->_ci->load->view('menu', $data, TRUE);
		$data['session_id'] = $this->_ci->session->userdata('session_id');
		
		$this->_ci->load->view($file, $data);
	}
		
	function display($template, $data=NULL) {
		
			$data['_content'] = $this->_ci->load->view($template, $data, TRUE);
			$data['_hasil'] = $this->_ci->load->view($template, $data, TRUE);
			$data['_header'] = $this->_ci->load->view('template/header', $data, TRUE);
			$data['provinsis'] = $this->_ci->ModSimulasi->allProvince();
			$data['products'] = $this->_ci->ModSimulasi->allProduct();
			//$data['_menu'] = $this->_ci->load->view('menu', $data, TRUE);
			$data['session_id'] = $this->_ci->session->userdata('session_id');
   			//echo $session_id;
			$this->_ci->load->view('template/main', $data);
			
	}

	//Testing Teguh 17/09/2019
	function display_new($template, $data=NULL) {
		
			$data['_content'] = $this->_ci->load->view($template, $data, TRUE);
			$data['_hasil'] = $this->_ci->load->view($template, $data, TRUE);
			$data['_header'] = $this->_ci->load->view('template/header', $data, TRUE);
			$data['provinsis'] = $this->_ci->ModSimulasi->allProvince();
			$data['products'] = $this->_ci->ModSimulasi->allProduct();
			$data['pekerjaans'] = $this->_ci->ModSimulasi->allPekerjaan();
			$data['tarifs'] = $this->_ci->ModSimulasi->allTarif();
			//$data['_menu'] = $this->_ci->load->view('menu', $data, TRUE);
			$data['session_id'] = $this->_ci->session->userdata('session_id');
			$this->_ci->load->view('template/main_new', $data);
			
	}

	//Halaman untuk testing ketika ada perubahan - Teguh 30/10/2019
	function display_testing($template, $data=NULL) {
		
			$data['_content'] = $this->_ci->load->view($template, $data, TRUE);
			$data['_hasil'] = $this->_ci->load->view($template, $data, TRUE);
			$data['_header'] = $this->_ci->load->view('template/header', $data, TRUE);
			$data['provinsis'] = $this->_ci->ModSimulasi->allProvince();
			$data['products'] = $this->_ci->ModSimulasi->allProduct();
			$data['pekerjaans'] = $this->_ci->ModSimulasi->allPekerjaan();
			$data['tarifs'] = $this->_ci->ModSimulasi->allTarif();
			$data['session_id'] = $this->_ci->session->userdata('session_id');
			$this->_ci->load->view('template/main_testing', $data);
			
	}

	//Halaman untuk produk SMART PROMAPAN - Teguh 13/11/2019
	function display_smart_promapan($template, $data=NULL) {
		
			$data['_content'] = $this->_ci->load->view($template, $data, TRUE);
			$data['_hasil'] = $this->_ci->load->view($template, $data, TRUE);
			$data['_header'] = $this->_ci->load->view('template/header', $data, TRUE);
			$data['provinsis'] = $this->_ci->ModSimulasi->allProvince();
			$data['products'] = $this->_ci->ModSimulasi->allProduct();
			$data['pekerjaans'] = $this->_ci->ModSimulasi->allPekerjaan();
			$data['tarifs'] = $this->_ci->ModSimulasi->allTarif();
			$data['session_id'] = $this->_ci->session->userdata('session_id');
			$this->_ci->load->view('template/main_smart_promapan', $data);
	}
	
	//Halaman untuk produk PROIDAMAN - Teguh 13/11/2019
	function display_proidaman($template, $data=NULL) {
		
			$data['_content'] = $this->_ci->load->view($template, $data, TRUE);
			$data['_hasil'] = $this->_ci->load->view($template, $data, TRUE);
			$data['_header'] = $this->_ci->load->view('template/header', $data, TRUE);
			$data['provinsis'] = $this->_ci->ModSimulasi->allProvince();
			$data['products'] = $this->_ci->ModSimulasi->allProduct();
			$data['pekerjaans'] = $this->_ci->ModSimulasi->allPekerjaan();
			$data['tarifs'] = $this->_ci->ModSimulasi->allTarif();
			$data['session_id'] = $this->_ci->session->userdata('session_id');
			$this->_ci->load->view('template/main_proidaman', $data);
			
	}

	//Halaman untuk produk ANUITAS - Teguh 20/07/2020
	function display_anuitas($template, $data=NULL) {
		
			$data['_content'] = $this->_ci->load->view($template, $data, TRUE);
			$data['_hasil'] = $this->_ci->load->view($template, $data, TRUE);
			$data['_header'] = $this->_ci->load->view('template/header', $data, TRUE);
			$data['provinsis'] = $this->_ci->ModSimulasi->allProvince();
			$data['products'] = $this->_ci->ModSimulasi->allProduct();
			$data['pekerjaans'] = $this->_ci->ModSimulasi->allPekerjaan();
			$data['tarifs'] = $this->_ci->ModSimulasi->allTarif();
			$data['session_id'] = $this->_ci->session->userdata('session_id');
			$this->_ci->load->view('template/main_anuitas', $data);
			
	}

	function body($template, $data=NULL){
		$this->_ci->load->view($template, $data, TRUE);
	}

}

/* End of file template.php */
/* Location: ./application/libraries/template.php */