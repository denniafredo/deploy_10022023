<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");
	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);


class Jspromapannew_dimas extends CI_Controller{
	
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
		$datainput = $this->input->post("datatest");
		// Siapkan variable array untuk store respon.
        $respon = array();

        // Ambil userid (Uid) dan password (Password) yang dipost dari view.   
        //$data['Uid'] = $this->input->post('Uid');
        //$data['Password'] = $this->input->post('Password');

        // // Alamat webservice login dari OSB Jiwasraya
        $urlWebservice = 'http://192.168.4.57:8001/api/osb/Jiwasraya_ProdukBenefit_Services/getKetentuanProduk';

        // // Ubah data ke dalam bentuk json yang akan digunakan sebagai payload
        $requestPayload = json_decode($datainput,TRUE);
        //var_dump($requestPayload);
        //exit();

  //       // // Inisiasi CURL untuk mendapatkan respon dari webservices
  //       $curl = curl_init($urlWebservice);
  //       curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST'); // Method 'POST'
  //       curl_setopt($curl, CURLOPT_HEADER, FALSE);
  //       curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

  //       // // Header request agar bisa diproses di OSB
  //       curl_setopt($curl, CURLOPT_HTTPHEADER, [
  //           'Content-type: application/json', 'Content-Length: ' . strlen($requestPayload)
  //       ]);
  //       curl_setopt($curl, CURLOPT_POST, TRUE);
  //       curl_setopt($curl, CURLOPT_POSTFIELDS, $requestPayload);

  //       // // Dapatkan respon dan response code dari OSB
  //       $responsePayload = curl_exec($curl);
  //       $responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
       
  //       //exit();
  //       // // Close proses CURL
  //       curl_close($curl);

  //       // // Simpan response payload dan response code dari OSB. Hasil dari respon 
  //       // // ini akan digunakan untuk proses lain
  //       $respon['status'] = $responseCode;
  //       $respon['payload'] = $responsePayload;

  //       //return $respon;

		// //echo $respon;
		//  var_dump($responsePayload);
		// var_dump($respon);	
		print_r($requestPayload);
	}
	  
}	

