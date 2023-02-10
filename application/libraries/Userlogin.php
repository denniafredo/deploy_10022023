<?php

/**
 * 
 */
class Userlogin {
	
	protected $_ci;
	
	function __construct() {
		$this->_ci =&get_instance();
		$this->_ci->load->library('session');
		//$this->_ci->load->model('Mod_menu');
	}
		
	function sesi() {
		$loggedin= $this->_ci->session->userdata('logged_in');
		
		return $loggedin;
	}

	
}

/* End of file template.php */
/* Location: ./application/libraries/template.php */