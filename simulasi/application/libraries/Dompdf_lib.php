<?php

class Dompdf_lib {
    
	var $_dompdf = NULL;
	
	function __construct()
	{
		require_once("dompdf/dompdf_config.inc.php");
		if(is_null($this->_dompdf)){
			$this->_dompdf = new DOMPDF();
		}
	}
	
	function convert_html_to_pdf($html) 
	{
		$this->_dompdf->load_html($html);
		$this->_dompdf->render();
		//$this->_dompdf->stream($filename);
		return $this->_dompdf->output();
		/*if ($stream) {
			$this->_dompdf->stream($filename);
		} else {*/
			//return $this->_dompdf->output();
		//}
	}
	
}
