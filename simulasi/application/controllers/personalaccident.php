<?php

class Personalaccident extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('modmaster');
 	}
	
	function hasil() {
		$noagen = $this->input->get('noagen');
		$noid = $this->input->get('noid');
		$buildid = $this->input->get('buildid');
		$pos = @api_curl("/pos/agen/$noagen/$noid/$buildid", 'GET')['message'];
		$data['pos'] = $pos;
		
		$this->load->view('hasil/personalaccident', $data);
	}
	
	function cetak() {
        $buildid = $this->input->get('buildid');
		$pos = @api_curl("/pos/agen/null/null/$buildid", 'GET')['message'];
		$data['pos'] = $pos;
		
		$this->load->view('pdf/personalaccident',$data);
	}
	
	function save() {
		$kdproduk = $this->input->post('kdproduk');
		$noagen = $this->input->post('noagen');
		$noidpp = $this->input->post('noktppemegangpolis');
		$produk = api_curl("/master/produk/$kdproduk", 'GET');
		$sama = $this->input->post('tertanggungsamadenganpemegangpolis');
		$kdpekerjaancalontertanggung = $sama ? $this->input->post('kdpekerjaanpemegangpolis') : $this->input->post('kdpekerjaancalontertanggung');
		$kdhobicalontertanggung = $sama ? $this->input->post('kdhobipemegangpolis') : $this->input->post('kdhobicalontertanggung');
		$namacalontertanggung = $sama ? $this->input->post('namapemegangpolis') : $this->input->post('namacalontertanggung');
		$kdjeniskelamincalontertanggung = $sama ? $this->input->post('kdjeniskelaminpemegangpolis') : $this->input->post('kdjeniskelamincalontertanggung');
		$tanggallahircalontertanggung = $sama ? $this->input->post('tanggallahirpemegangpolis') : $this->input->post('tanggallahircalontertanggung');
		$noktpcalontertanggung = $sama ? $noidpp : $this->input->post('noktpcalontertanggung');
		$kdhubungan = $this->input->post('kdhubungan') ? $this->input->post('kdhubungan') : '04';
	
		// data klien
		$data['noagen'] = $noagen;
		$data['noklien'][] = 1;
		$data['kdpekerjaan'][] = $this->input->post('kdpekerjaanpemegangpolis');
		$data['kdhobi'][] = $this->input->post('kdhobipemegangpolis');
		$data['namaklien'][] = $this->input->post('namapemegangpolis');
		$data['kdjeniskelamin'][] = $this->input->post('kdjeniskelaminpemegangpolis');
		$data['tgllahir'][] = $this->input->post('tanggallahirpemegangpolis');
		$data['noid'][] = $noidpp;
		$data['tglrekamklien'][] = date('d-m-Y H:i:s');
		$data['noklien'][] = 2;
		$data['kdpekerjaan'][] = $kdpekerjaancalontertanggung;
		$data['kdhobi'][] = $kdhobicalontertanggung;
		$data['namaklien'][] = $namacalontertanggung;
		$data['kdjeniskelamin'][] = $kdjeniskelamincalontertanggung;
		$data['tgllahir'][] = $tanggallahircalontertanggung;
		$data['noid'][] = $noktpcalontertanggung;
		$data['tglrekamklien'][] = date('d-m-Y H:i:s');
		
		// data hitung
		$data['nocpp'] = 1;
		$data['noctthitung'] = 2;
		$data['kdproduk'] = $kdproduk;
		$data['kdcarabayar'] = $this->input->post('kdcarabayar');
		$data['premi'] = $this->input->post('totalpremi');
		$data['jua'] = $this->input->post('uangasuransi');
		$data['juamaksimal'] = !$produk['error'] ? $produk['message']['UAMAX'] : 0;
		$data['penghasilan'] = $this->input->post('penghasilansatutahun');
		$data['resikoawal'] = 0;
		$data['tglrekamhitung'] = date('d-m-Y H:i:s');
		
		// data insurable
		$data['nocttinsurable'] = 2;
		$data['noklieninsurable'] = 1;
		$data['kdhubungan'] = $kdhubungan;
		
		// data extra resiko
		$data['noklienextraresiko'][] = 1;
		$data['kdpekerjaanextraresiko'][] = $this->input->post('kdpekerjaanpemegangpolis');
		$data['kdhobiextraresiko'][] = "";
		$data['kdjenisresiko'][] = C_KD_JENIS_RESIKO_PA;
		$pekerjaan = api_curl("/master/pekerjaan/".$this->input->post('kdpekerjaanpemegangpolis'), 'GET');
		$data['resiko'][] = !$pekerjaan['error'] ? $pekerjaan['message']['PA'] : 0;
		$data['pembagi'][] = !$pekerjaan['error'] ? $pekerjaan['message']['PEMBAGIPA'] : 0;
		$data['tglrekamextraresiko'][] = date('d-m-Y H:i:s');
		$data['noklienextraresiko'][] = 1;
		$data['kdpekerjaanextraresiko'][] = "";
		$data['kdhobiextraresiko'][] = $this->input->post('kdhobipemegangpolis');
		$data['kdjenisresiko'][] = C_KD_JENIS_RESIKO_PA;
		$hobi = api_curl("/master/hobi/".$this->input->post('kdhobipemegangpolis'), 'GET');
		$data['resiko'][] = !$hobi['error'] ? $hobi['message']['PA'] : 0;
		$data['pembagi'][] = !$hobi['error'] ? $hobi['message']['PEMBAGIPA'] : 0;
		$data['tglrekamextraresiko'][] = date('d-m-Y H:i:s');
		
		// jika tertanggung beda dengan pempol maka tambah data extra resiko
		if (!$sama) {
			$data['noklienextraresiko'][] = 2;
			$data['kdpekerjaanextraresiko'][] = $kdpekerjaancalontertanggung;
			$data['kdhobiextraresiko'][] = "";
			$data['kdjenisresiko'][] = C_KD_JENIS_RESIKO_PA;
			$pekerjaan = api_curl("/master/pekerjaan/$kdpekerjaancalontertanggung", 'GET');
			$data['resiko'][] = !$pekerjaan['error'] ? $pekerjaan['message']['PA'] : 0;
			$data['pembagi'][] = !$pekerjaan['error'] ? $pekerjaan['message']['PEMBAGIPA'] : 0;
			$data['tglrekamextraresiko'][] = date('d-m-Y H:i:s');
			$data['noklienextraresiko'][] = 2;
			$data['kdpekerjaanextraresiko'][] = "";
			$data['kdhobiextraresiko'][] = $kdhobicalontertanggung;
			$data['kdjenisresiko'][] = C_KD_JENIS_RESIKO_PA;
			$hobi = api_curl("/master/hobi/$kdhobicalontertanggung", 'GET');
			$data['resiko'][] = !$hobi['error'] ? $hobi['message']['PA'] : 0;
			$data['pembagi'][] = !$hobi['error'] ? $hobi['message']['PEMBAGIPA'] : 0;
			$data['tglrekamextraresiko'][] = date('d-m-Y H:i:s');
		}
		
		$result = api_curl("/pos/agen", 'POST', $data);

		if ($result['error']) {
			echo "<script>alert('Gagal menyimpan data!');</script>";
			echo "Gagal Menyimpan Data, Error : $result[message]<br><br><a href='".str_replace("/simulasi/", "", base_url())."/prospek/proposal?id=$noidpp'>Kembali</a>";
		} else {
			redirect(base_url("personalaccident/hasil?noagen=$noagen&noid=$noidpp&buildid=".$result['message']['buildidserver']));
		}
	}
	
	
	// Private function untuk API
	function _api($url, $method, $post = null) {
		$post = $post ? http_build_query($post) : $post;
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => $method,
		  CURLOPT_POSTFIELDS => $post,
		  CURLOPT_HTTPHEADER => array(),
		));

		$response = curl_exec($curl);
		
		curl_close($curl);
		
		$result = @json_decode($response, true);
		
		return $result;
	}
}