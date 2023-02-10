<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");
	
	error_reporting(0);

class Pdf_test extends CI_Controller {

	function __construct() {
		parent::__construct();
        
	}
	
	function index(){
		$file_url = './files/';
		
		$data['nama'] = 'Dimas';
		
		$html = $this->load->view('pdf/optima7',$data,true);
		
		$pdf_filename  = 'report.pdf';
		$this->load->library('dompdf_lib');
		$pdf = $this->dompdf_lib->convert_html_to_pdf($html);
		
		file_put_contents($file_url."saved_pdf.pdf", $pdf);
		//$this->dompdf_lib->convert_html_to_pdf($html, $pdf_filename, true);
		//file_put_contents($file_url, $this->dompdf_lib->convert_html_to_pdf($html, $pdf_filename, false));
		
	}
	
}