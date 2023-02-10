<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");

class Cetakpdf extends CI_Controller{	

	var $details;
	
	
	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler(FALSE); // I keep this here so I dont have to manualy edit each controller to see profiler or not  
	
		/*$this->load->helper(array('form','date','url','email'));
		$this->load->library(array('form_validation','session','encrypt','upload','csvimport'));
		$this->load->model(array('ModAktiva','ModKategori','ModVendor','ModRekeningAkun'));
		$this->output->enable_profiler(true);*/
		$this->load->helper(array('form','date','url','email'));
		$this->load->model(array('ModSimulasi'));
		//$this->load->library('dompdf_lib');
		$this->load->library('pdf');
		
 	}
	


}