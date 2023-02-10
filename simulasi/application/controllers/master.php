<?php

class Master extends CI_Controller {
	
	function pekerjaan($kdpekerjaan) {
		echo json_encode(api_curl("/master/pekerjaan/$kdpekerjaan", 'GET'));
	}
	
	function hobi($kdhobi) {
		echo json_encode(api_curl("/master/hobi/$kdhobi", 'GET'));
	}
	
	function tarif() {
		$kdproduk = $this->input->get('kdproduk');
		$usiath = $this->input->get('usiath');
		$bk = $this->input->get('bk');
		
		echo json_encode(api_curl("/master/tarif?kdproduk=$kdproduk&usiath=$usiath&bk=$bk", 'GET'));
	}
	
	function dana($kdproduk, $kdfund) {
		echo json_encode(api_curl("/master/dana/$kdproduk/$kdfund", 'GET'));
	}
}