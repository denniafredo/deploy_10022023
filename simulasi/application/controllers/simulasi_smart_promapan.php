<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");
	
	error_reporting(0);

class Simulasi_smart_promapan extends CI_Controller{	

	var $details;

	public function __construct()
	{
		parent::__construct();		
		$this->load->helper(array('form','date','url','email'));
		$this->load->model(array('ModSimulasi'));
		$this->load->library('pdf');
		
 	}
	
	function index(){
		$dataBuildID = $this->ModSimulasi->getBuildID();
		$data['hasil']['buildID'] = $dataBuildID['BUILDID'];
		
		echo $data['hasil']['buildID']." -- BuildID  <br>";
		
		$this->session->set_userdata('build_id', $data['hasil']['buildID']);
		
		$NoProspek =$this->input->get('kode_prospek');
		if (($NoProspek != ''))
		{
			$this->template->display_smart_promapan('simulasi');
		}
		else
		{	
			redirect('https://jaim.jiwasraya.co.id', 'refresh');
		}
	}





}