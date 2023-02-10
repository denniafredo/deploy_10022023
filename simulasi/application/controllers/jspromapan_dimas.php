<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");
	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);


class Jspromapan_dimas extends CI_Controller{
	
	function cgetTarifAll(){
		$this->load->model('ModSimulasiKakean');
		$usiasekarang  = $this->input->post("usiacalontertanggung");

		$result = $this->ModSimulasiKakean->getTarifUA_all($usiasekarang);
		$hasil = $result;
		
		echo json_encode($hasil);	
	}
	
	function cgetEkstraPremi(){
		$this->load->model('ModSimulasiKakean');
		$kdjenispekerjaanctt  = $this->input->post("kdjenispekerjaanctt");

		$result = $this->ModSimulasiKakean->getEkstraPremi($kdjenispekerjaanctt);
		$hasil = $result;
		
		echo json_encode($hasil);	
	}

	function test(){
		$datainput = $this->input->post("dataInput");
		/*$dataRespon = json_decode($datainput,TRUE);
		echo json_encode($dataRespon);*/
		
        // Siapkan variable array untuk store respon.
        $respon = array();

        // Ambil userid (Uid) dan password (Password) yang dipost dari view.   
        /*$data['Uid'] = 'dimas.primananto';
        $data['Password'] = '23juli2011kianeo123'*/;

        // Alamat webservice login dari OSB Jiwasraya
        $urlWebservice = 'http://osbadmin.jiwasraya.co.id:8001/api/osb/Jiwasraya_ProdukBenefit_Services/getKetentuanProduk';

        // Ubah data ke dalam bentuk json yang akan digunakan sebagai payload
        $jsonDataEncoded  = $datainput;

        // Inisiasi CURL untuk mendapatkan respon dari webservices
		//Tell cURL that we want to send a POST request.
		$ch = curl_init($urlWebservice);
		//Tell cURL that we want to send a POST request.
		curl_setopt($ch, CURLOPT_POST, 1);

		//Attach our encoded JSON string to the POST fields.
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

		//Set the content type to application/json
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 

		//Execute the request
		$result = curl_exec($ch);
        // Simpan response payload dan response code dari OSB. Hasil dari respon 
        // ini akan digunakan untuk proses lain
        //print_r (json_decode($datainput));
		
		print_r($urlWebservice);
	}
	  
}	

