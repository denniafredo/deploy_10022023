<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produk extends CI_Controller {


	public function __construct() {
		parent::__construct();
		$this->load->model('modmaster');
		$this->load->model('modsimulasi');
		$this->noagen = $this->input->get('noagen');
		$this->noid = $this->input->get('noid');
		$this->kdproduk = $this->input->get('kdproduk');
		$this->noprospek = $this->ModSimulasi->GetDataProspek($this->noagen, $this->noid);

		// $this->noprospek = $this->ModSimulasi->GetDataProspek($this->noagen);
		
		/*Nanti setelah modifikasi simulasi life prime & ultimate dihapus ya*/
		$this->provinsis = $this->ModSimulasi->allProvince();
		$this->pekerjaans = $this->ModSimulasi->allPekerjaan(); 
		/*Akhir Nanti setelah modifikasi simulasi life prime & ultimate dihapus ya*/
		
		$this->provinsi = $this->modmaster->get_list_provinsi();
		$this->pekerjaan = $this->modmaster->get_list_pekerjaan(array(array('operator' => 'WHERE', 'text' => 'kdstatus', 'comparison' => '=', 'value' => 1)));
		$this->hobi = $this->modmaster->get_list_hobi(array(array('operator' => 'WHERE', 'text' => 'kdstatus', 'comparison' => '=', 'value' => 1))); 		
		
		// load file css dan javascript
		$this->load->view('produk/header');
 	}
	
	
	function index() {
		if ($this->noagen && $this->noid && $this->kdproduk) { 
			// Jika produk IFG Life Prime Protection
			if ($this->kdproduk == 'JL4BLN') { 
				$this->_lifeprime();
			}
			// Jika produk IFG Life Protection Platinum
			else if ($this->kdproduk == 'JL4BPRO') {
				$this->_lifeprotect();
			}
			// Jika produk IFG Ultimate Protection
			else if ($this->kdproduk == 'JL4XN') { 
				$this->_ultimate();
			}
			// Jika produk PA
			else if (in_array($this->kdproduk, array('PAA', 'PAB'))) {
				$this->_personalaccident();
			}
			// Jika produk IFG Premier Annuity Plan 65
			else if ($this->kdproduk == 'APP65') {
				$this->_annuitypremier65();
			}
			// Jika produk IFG Premier Annuity Plan 75
			else if ($this->kdproduk == 'APP75') {
				$this->_annuitypremier75();
			}
			// Jika produk IFG Premier Annuity Plan 85
			else if ($this->kdproduk == 'APP85') {
				$this->_annuitypremier85();
			}
			// Jika produk IFG Premier Annuity Plan Seumur Hidup
			else if ($this->kdproduk == 'APPSH') {
				$this->_annuitypremiersh();
			}
			// Jika test
			else if (in_array($this->kdproduk, array('TES'))) {
				$this->_tes();
			}
			else {
				echo "Produk belum tersetup";
				sleep(2);
				redirect(C_URL_JAIM, 'refresh');
			}
		} else {	
			redirect(C_URL_JAIM, 'refresh');
		}
	}


	// Produk IFG Life Prime Protection
	function _lifeprime() {
		$buildid = $this->ModSimulasi->getBuildID();
		$this->session->set_userdata('build_id', $buildid['BUILDID']);
		
		$data['noprospek'] = $this->noprospek;
		$data['provinsis'] = $this->provinsis;
		$data['pekerjaans'] = $this->pekerjaans;
		$data['hobi'] = api_curl("/master/hobi", 'GET');
		$data['session_id'] = $this->session->userdata('session_id');
		$data['DataAgen'] = $this->ModSimulasi->GetDataAgen_new($this->noprospek);
		
		$this->load->view('produk/lifeprime', $data);
	}
	
	// Produk IFG Life Protection Platinum
	function _lifeprotect() {
		$buildid = $this->ModSimulasi->getBuildID();
		$this->session->set_userdata('build_id', $buildid['BUILDID']);
		
		$data['noprospek'] = $this->noprospek;

		$data['provinsis'] = $this->provinsis;
		$data['pekerjaans'] = $this->pekerjaans;
		$data['hobi'] = api_curl("/master/hobi", 'GET');
		$data['session_id'] = $this->session->userdata('session_id');
		$data['DataAgen'] = $this->ModSimulasi->GetDataAgen_new($this->noprospek);
		$data['usia'] = $this->nearest_birthday($data['DataAgen']['TGLLAHIR'], true);
		
		$this->load->view('produk/lifeprotect', $data);
	}

	//tambahan nearest birthday untuk LPP 13022023
	function nearest_birthday($birthday) {
	    $now = new DateTime();
	    $dob = new DateTime($birthday);
	    $diff = $dob->diff(new DateTime);

	    if ($diff->format('%m') >= 6) {
		   $age = $diff->format('%y') + 1;
		} else {
		   $age = $diff->format('%y');
		}
	    return $age;
	}



	
	function lifeprime() {
		$data['kdproduk'] = $this->kdproduk;
		
		$prospek = @api_curl("/prospek/agen/$this->noagen/$this->noid", 'GET')['message'];
		$data['prospek'] = $prospek;
		$produk = @api_curl("/master/produk/$this->kdproduk", 'GET')['message'];
		$data['produk'] = $produk;
		$data['pekerjaan'] = api_curl("/master/pekerjaan", 'GET');
		$data['hobi'] = api_curl("/master/hobi", 'GET');
		$data['provinsi'] = api_curl("/master/provinsi/$prospek[KDPROVINSI]", 'GET');
		$data['kota'] = api_curl("/master/kota/$prospek[KDKOTAMADYA]", 'GET');
		$data['kecamatan'] = api_curl("/master/kecamatan/$prospek[KDKECAMATAN]", 'GET');
		$data['kelurahan'] = api_curl("/master/kelurahan/$prospek[KDKELURAHAN]", 'GET');
		$data['jeniskelamin'] = api_curl("/master/jenis-kelamin", 'GET');
		$data['hubungan'] = api_curl("/master/hubungan", 'GET');
		$data['fund'] = api_curl("/master/dana/$this->kdproduk", 'GET');
		
		$this->load->view('produk/lifeprime_', $data);
	}
	
	
	// Produk IFG Ultimate Protection
	function _ultimate() {
		$data['kdproduk'] = $this->kdproduk;
		
		$prospek = @api_curl("/prospek/agen/$this->noagen/$this->noid", 'GET')['message'];
		$data['prospek'] = $prospek;
		$produk = @api_curl("/master/produk/$this->kdproduk", 'GET')['message'];
		$data['produk'] = $produk;
		$data['pekerjaan'] = api_curl("/master/pekerjaan", 'GET');
		$data['hobi'] = api_curl("/master/hobi", 'GET');
		$data['provinsi'] = api_curl("/master/provinsi/$prospek[KDPROVINSI]", 'GET');
		$data['kota'] = api_curl("/master/kota/$prospek[KDKOTAMADYA]", 'GET');
		$data['kecamatan'] = api_curl("/master/kecamatan/$prospek[KDKECAMATAN]", 'GET');
		$data['kelurahan'] = api_curl("/master/kelurahan/$prospek[KDKELURAHAN]", 'GET');
		$data['jeniskelamin'] = api_curl("/master/jenis-kelamin", 'GET');
		$data['hubungan'] = api_curl("/master/hubungan", 'GET');
		$data['fund'] = api_curl("/master/dana/$this->kdproduk", 'GET');
		
		$this->load->view('produk/ultimate', $data);
	}
	
	
	// Produk Personal Accident
	function _personalaccident() {
		$data['kdproduk'] = $this->kdproduk;
		
		$prospek = @api_curl("/prospek/agen/$this->noagen/$this->noid", 'GET')['message'];
		$data['prospek'] = $prospek;
		$produk = @api_curl("/master/produk/$this->kdproduk", 'GET')['message'];
		$data['produk'] = $produk;
		$data['pekerjaan'] = api_curl("/master/pekerjaan", 'GET');
		$data['hobi'] = api_curl("/master/hobi", 'GET');
		$data['jeniskelamin'] = api_curl("/master/jenis-kelamin", 'GET');
		$data['hubungan'] = api_curl("/master/hubungan", 'GET');
		$data['provinsi'] = api_curl("/master/provinsi/$prospek[KDPROVINSI]", 'GET');
		$data['kota'] = api_curl("/master/kota/$prospek[KDKOTAMADYA]", 'GET');
		$data['kecamatan'] = api_curl("/master/kecamatan/$prospek[KDKECAMATAN]", 'GET');
		$data['kelurahan'] = api_curl("/master/kelurahan/$prospek[KDKELURAHAN]", 'GET');
		
		$this->load->view('produk/personalaccident', $data);
	}


	// Produk IFG Premier Annuity Plan 65
	function _annuitypremier65() {
		$produk = @api_curl("/master/produk/$this->kdproduk", 'GET')['message'];
		$prospek = @api_curl("/prospek/agen/$this->noagen/$this->noid", 'GET')['message'];

		$data['kdproduk'] = $this->kdproduk;
		$data['produk'] = $produk;
		$data['prospek'] = $prospek;
		$data['pekerjaan'] = api_curl("/master/pekerjaan", 'GET');
		$data['hobi'] = api_curl("/master/hobi", 'GET');
		$data['jeniskelamin'] = api_curl("/master/jenis-kelamin", 'GET');
		$data['hubungan'] = api_curl("/master/hubungan", 'GET');
		$data['provinsi'] = api_curl("/master/provinsi/$prospek[KDPROVINSI]", 'GET');
		$data['kota'] = api_curl("/master/kota/$prospek[KDKOTAMADYA]", 'GET');
		$data['kecamatan'] = api_curl("/master/kecamatan/$prospek[KDKECAMATAN]", 'GET');
		$data['kelurahan'] = api_curl("/master/kelurahan/$prospek[KDKELURAHAN]", 'GET');

		$this->load->view('produk/annuitypremier65', $data);
	}


	// Produk IFG Premier Annuity Plan 75
	function _annuitypremier75() {
		$produk = @api_curl("/master/produk/$this->kdproduk", 'GET')['message'];
		$prospek = @api_curl("/prospek/agen/$this->noagen/$this->noid", 'GET')['message'];

		$data['kdproduk'] = $this->kdproduk;
		$data['produk'] = $produk;
		$data['prospek'] = $prospek;
		$data['pekerjaan'] = api_curl("/master/pekerjaan", 'GET');
		$data['hobi'] = api_curl("/master/hobi", 'GET');
		$data['jeniskelamin'] = api_curl("/master/jenis-kelamin", 'GET');
		$data['hubungan'] = api_curl("/master/hubungan", 'GET');
		$data['provinsi'] = api_curl("/master/provinsi/$prospek[KDPROVINSI]", 'GET');
		$data['kota'] = api_curl("/master/kota/$prospek[KDKOTAMADYA]", 'GET');
		$data['kecamatan'] = api_curl("/master/kecamatan/$prospek[KDKECAMATAN]", 'GET');
		$data['kelurahan'] = api_curl("/master/kelurahan/$prospek[KDKELURAHAN]", 'GET');

		$this->load->view('produk/annuitypremier75', $data);
	}


	// Produk IFG Premier Annuity Plan 85
	function _annuitypremier85() {
		$produk = @api_curl("/master/produk/$this->kdproduk", 'GET')['message'];
		$prospek = @api_curl("/prospek/agen/$this->noagen/$this->noid", 'GET')['message'];

		$data['kdproduk'] = $this->kdproduk;
		$data['produk'] = $produk;
		$data['prospek'] = $prospek;
		$data['pekerjaan'] = api_curl("/master/pekerjaan", 'GET');
		$data['hobi'] = api_curl("/master/hobi", 'GET');
		$data['jeniskelamin'] = api_curl("/master/jenis-kelamin", 'GET');
		$data['hubungan'] = api_curl("/master/hubungan", 'GET');
		$data['provinsi'] = api_curl("/master/provinsi/$prospek[KDPROVINSI]", 'GET');
		$data['kota'] = api_curl("/master/kota/$prospek[KDKOTAMADYA]", 'GET');
		$data['kecamatan'] = api_curl("/master/kecamatan/$prospek[KDKECAMATAN]", 'GET');
		$data['kelurahan'] = api_curl("/master/kelurahan/$prospek[KDKELURAHAN]", 'GET');

		$this->load->view('produk/annuitypremier85', $data);
	}


	// Produk IFG Premier Annuity Plan Seumur Hidup
	function _annuitypremiersh() {
		$produk = @api_curl("/master/produk/$this->kdproduk", 'GET')['message'];
		$prospek = @api_curl("/prospek/agen/$this->noagen/$this->noid", 'GET')['message'];

		$data['kdproduk'] = $this->kdproduk;
		$data['produk'] = $produk;
		$data['prospek'] = $prospek;
		$data['pekerjaan'] = api_curl("/master/pekerjaan", 'GET');
		$data['hobi'] = api_curl("/master/hobi", 'GET');
		$data['jeniskelamin'] = api_curl("/master/jenis-kelamin", 'GET');
		$data['hubungan'] = api_curl("/master/hubungan", 'GET');
		$data['provinsi'] = api_curl("/master/provinsi/$prospek[KDPROVINSI]", 'GET');
		$data['kota'] = api_curl("/master/kota/$prospek[KDKOTAMADYA]", 'GET');
		$data['kecamatan'] = api_curl("/master/kecamatan/$prospek[KDKECAMATAN]", 'GET');
		$data['kelurahan'] = api_curl("/master/kelurahan/$prospek[KDKELURAHAN]", 'GET');

		$this->load->view('produk/annuitypremiersh', $data);
	}

	
	// Produk tes
	function _tes() {
		$data['kdproduk'] = $this->kdproduk;
		
		$prospek = api_curl_tes("/prospek/agen/$this->noagen/$this->noid", 'GET')['message']; exit;
		$data['prospek'] = $prospek;
		$produk = @api_curl("/master/produk/$this->kdproduk", 'GET')['message'];
		$data['produk'] = $produk;
		$data['pekerjaan'] = api_curl("/master/pekerjaan", 'GET');
		$data['hobi'] = api_curl("/master/hobi", 'GET');
		$data['jeniskelamin'] = api_curl("/master/jenis-kelamin", 'GET');
		$data['hubungan'] = api_curl("/master/hubungan", 'GET');
		$data['provinsi'] = api_curl("/master/provinsi/$prospek[KDPROVINSI]", 'GET');
		$data['kota'] = api_curl("/master/kota/$prospek[KDKOTAMADYA]", 'GET');
		$data['kecamatan'] = api_curl("/master/kecamatan/$prospek[KDKECAMATAN]", 'GET');
		$data['kelurahan'] = api_curl("/master/kelurahan/$prospek[KDKELURAHAN]", 'GET');
		
		$this->load->view('produk/personalaccident', $data);
	}

}