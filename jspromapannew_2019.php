<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");
	
	error_reporting(0);


class Jspromapannew_2019 extends CI_Controller{
	
	function cgetTarifAll(){
		$this->load->model('ModSimulasiKakean');
		$usiasekarang  = $this->input->post("usiacalontertanggung");

		$result = $this->ModSimulasiKakean->getTarifUA_all($usiasekarang);
		$hasil = $result;
		
		echo json_encode($hasil);
	}

	function cgetTarifPremi(){
		$this->load->model('ModSimulasiKakean');

		$kd_produk  = $this->input->post("kdproduk");
		$usiasekarang  = $this->input->post("usiacalontertanggung");

		$result = $this->ModSimulasiKakean->getTarifUAPremi($kd_produk, $usiasekarang);
		$hasil = $result;
		
		echo json_encode($hasil);
	}

	function cgetAsumsiDanaInvest(){
		$this->load->model('ModSimulasiKakean');
		$usiasekarang  = $this->input->post("usiacalontertanggung");
		$result = $this->ModSimulasiKakean->getAsumsiDanaInvest($usiasekarang);
		$hasil = $result;
		
		echo json_encode($hasil);
	}

	function cgetTarifSpousePayor(){
		$this->load->model('ModSimulasiKakean');
		$usiasekarang  = $this->input->post("usiacalonpemegangpolis");

		$result = $this->ModSimulasiKakean->getTarifUA_SpousePayor($usiasekarang);
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

	function cgetResikoAwal(){
		$this->load->model('ModSimulasiKakean');
		$kdnpert  = $this->input->post("kdnpert");

		$result = $this->ModSimulasiKakean->getResikoAwal($kdnpert);
		$hasil = $result;
		
		echo json_encode($hasil);
	}

	function insertProPempol(){
		
		$this->load->model('ModSimulasiKakean');
		
		$tanggal = date("d/m/Y", strtotime($this->input->post("tanggallahir")));

		$data['pempol'] = array(
			'BUILD_ID' => $this->session->userdata('build_id'),
			'HUBUNGAN' => $this->input->post("hubungandenganpempol"),
			'NAMA' => $this->input->post("namalengkap"),
			'JENIS_KELAMIN' => $this->input->post("gender"),
			// 'TGL_LAHIR' => "TO_DATE('$tanggal', 'mm-dd-yyyy')",
			'IS_PEROKOK' => $this->input->post("perokokpempol"),
			'TELEPON' => $this->input->post("phone"),
			'EMAIL' => $this->input->post("email"),
			'HP' => $this->input->post("handphone"),
			'KDJNSPEKERJAAN' => $this->input->post("kdjnspekerjaanpempol"),
			'NO_KTP' => $this->input->post("noktpcpp"),
			'KDHOBI' => $this->input->post("kdhobicalonpempol"),
		);
		$this->db->set('TGL_LAHIR', "TO_DATE('$tanggal', 'DD-MM-YYYY')", FALSE);
		$result = $this->db->insert('PRO_PEMPOL', $data['pempol']);
		// $result = $this->ModSimulasiKakean->insertProPempolNew($data['pempol']);

		// var_dump($data);

	    echo $result;
	}

	function insertProTertanggung(){
		
		$this->load->model('ModSimulasiKakean');
		// echo $this->input->post("tanggallahircalontertanggung");
		$tanggal = date("d/m/Y", strtotime($this->input->post("tanggallahircalontertanggung")));
		// echo '<br>';
		// echo $tanggal;
		$data['tertanggung'] = array(
			'BUILD_ID' => $this->session->userdata('build_id'),
			'HUBUNGAN' => $this->input->post("hubungandenganpempol"),
			'NAMA' => $this->input->post("namalengkapcalontertanggung"),
			'JENIS_KELAMIN' => $this->input->post("jeniskelamincalontertanggung"),
			// 'TGL_LAHIR' => $this->db->query("TO_DATE('$tanggal', 'dd-mm-yyyy')"),
			'IS_PEROKOK' => $this->input->post("perokok"),
			'TELEPON' => $this->input->post("phone"),
			'EMAIL' => $this->input->post("email"),
			'HP' => $this->input->post("handphone"),
			'NO_KTP' => $this->input->post("noktp"),
			'KDJNSPEKERJAAN' => $this->input->post("kdjnspekerjaancalontertanggung"),
			'KDHOBI' => $this->input->post("kdhobicalontertanggung"),
		);
		$this->db->set('TGL_LAHIR', "TO_DATE('$tanggal', 'DD-MM-YYYY')", FALSE);
		$result = $this->db->insert('PRO_TERTANGGUNG', $data['tertanggung']);
		// $result = $this->ModSimulasiKakean->insertProTertanggungNew($data['tertanggung']);

	    echo $result;
	}
	
	function insertProAsuransiPokok(){
		
		$this->load->model('ModSimulasiKakean');
		
		
		$data['asuransipokok'] = array(
			'BUILD_ID' => $this->session->userdata('build_id'),
			'ASUMSI_CUTI_PREMI' => $this->input->post("asumsicutipremi"),
			'CARA_BAYAR' => $this->input->post("carabayarjspromapannew"),
			'USIA_PRODUKTIF' => $this->input->post("usiaproduktif"),
			'PENGHASILAN' => $this->input->post("penghasilansatutahun"),
			'UA' => $this->input->post("uangpertanggungan"),
			'MAKSIMAL_UA' => $this->input->post("maksimaluangasuransi"),
			'PREMI_BERKALA' => $this->input->post("premiberkala"),
			'TOPUP_BERKALA' => $this->input->post("topupberkala"),
			'TOPUP_SEKALIGUS' => $this->input->post("topupsekaligus"),
			'AKUMULASI_RESIKO_AWAL' => $this->input->post("resikoawalproposalctt"),
			'PERIODE_TOPUP' => $this->input->post("periodetopupsekaligus"),
			'PEMERIKSAAN' => $this->input->post("pemeriksaan"),
			'MEDICAL' => $this->input->post("medical"),
			//'MATERAI' => $this->input->post("beamaterai"),
			'VALUTA' => 'IDR'
		);
		
		$result = $this->ModSimulasiKakean->insertProAsuransiPokok($data['asuransipokok']);

	    echo $result;
	}

	function insertProAlokasiDana(){
		
		$this->load->model('ModSimulasiKakean');
		
		$data['alokasidana'] = array(
			'BUILD_ID' => $this->session->userdata('build_id'),
			'NAMA_ALOKASI1' => $this->input->post("alokasidana1"),
			'ALOKASI1' => $this->input->post("persentasealokasidana1")/100,
			'NAMA_ALOKASI2' => $this->input->post("alokasidana2"),
			'ALOKASI2' => $this->input->post("persentasealokasidana2")/100
		);
		$result = $this->ModSimulasiKakean->insertProAlokasiDana($data['alokasidana']);
	    echo $result;
	}

	function insertProDataRider(){
		
		$this->load->model('ModSimulasiKakean');
		
		$data['datarider'] = array(
			'BUILD_ID' => $this->session->userdata('build_id'),
			'IS_UADASAR' => $this->input->post("is_uadasar"),
			'UADASAR' => $this->input->post("uadasar"),
			'BIAYA_UADASAR' => $this->input->post("biaya_uadasar"),
			'IS_ADB' => $this->input->post("is_adb"),
			'ADB' => $this->input->post("adb"),
			'BIAYA_ADB' => $this->input->post("biaya_adb"),
			'IS_CI53' => $this->input->post("is_ci53"),
			'CI53' => $this->input->post("ci53"),
 			'BIAYA_CI53' => $this->input->post("biaya_ci53") ,
			'IS_WPCI51' => $this->input->post("is_wpci51"),
			'WPCI51' => $this->input->post("wpci51"),
			'BIAYA_WPCI51' => $this->input->post("biaya_wpci51"),
			'IS_TR' => $this->input->post("is_tr"),
			'TR' => $this->input->post("tr"),
			'BIAYA_TR' => $this->input->post("biaya_tr") ,
			'IS_HCP' => $this->input->post("is_hcp"),
			'HCP' => $this->input->post("hcp"),
			'BIAYA_HCP' => $this->input->post("biaya_hcp"),
			'IS_TPD' => $this->input->post("is_tpd"),
			'TPD' => $this->input->post("tpd"),
			'BIAYA_TPD' => $this->input->post("biaya_tpd"),
			'IS_WPTPD' => $this->input->post("is_wptpd"),
			'WPTPD' => $this->input->post("wptpd"),
			'BIAYA_WPTPD' => $this->input->post("biaya_wptpd"),
			'IS_ADDB' => $this->input->post("is_addb"),
			'ADDB' => $this->input->post("addb"),
			'BIAYA_ADDB' => $this->input->post("biaya_addb"),
			'IS_PBD' => $this->input->post("is_pbd"),
			'PBD' => $this->input->post("pbd"),
			'BIAYA_PBD' => $this->input->post("biaya_pbd"),
			'IS_PBCI' => $this->input->post("is_pbci"),
			'PBCI' => $this->input->post("pbci"),
			'BIAYA_PBCI' => $this->input->post("biaya_pbci"),
			'IS_PBTPD' => $this->input->post("is_pbtpd"),
			'PBTPD' => $this->input->post("pbtpd"),
			'BIAYA_PBTPD' => $this->input->post("biaya_pbtpd"),
			'IS_SPD' => $this->input->post("is_spd"),
			'SPD' => $this->input->post("spd"),
			'BIAYA_SPD' => $this->input->post("biaya_spd"),
			'IS_SPCI' => $this->input->post("is_spci"),
			'SPCI' => $this->input->post("spci"),
			'BIAYA_SPCI' => $this->input->post("biaya_spci"),
			'IS_SPTPD' => $this->input->post("is_sptpd"),
			'SPTPD' => $this->input->post("sptpd"),
			'BIAYA_SPTPD' => $this->input->post("biaya_sptpd") 
			
		);

		$result = $this->ModSimulasiKakean->insertProDataRiderNew($data['datarider']);
		echo $this->session->userdata('build_id');

		
		$data['datariderold'] = array(
			'BUILD_ID' => $this->session->userdata('build_id'),
			'IS_ADDB' => $this->input->post("is_addb"),
			'ADDB' => $this->input->post("addb"),
			'IS_TPD' => $this->input->post("is_tpd"),
			'TPD' => $this->input->post("tpd"),
			'IS_HCP_MURNI' => $this->input->post("is_hcp"),
			'PLAFON_HCP_MURNI' => $this->input->post("hcp"),
			'HCP_MURNI' => $this->input->post("biaya_hcp"),
			'IS_HCP_BEDAH' => $this->input->post("is_hcp"),
			'PLAFON_HCP_BEDAH' => $this->input->post("hcp")*10,
			'HCP_BEDAH' => $this->input->post("biaya_hcp"),
			'IS_CI' => $this->input->post("is_ci53"),
			'CI' => $this->input->post("ci53"),
 			'IS_TL' => $this->input->post("is_tr"),
			'TL' => $this->input->post("tr"),
			'IS_PAYOR_DEATH' => $this->input->post("is_pbd"),
			'PAYOR_DEATH' => $this->input->post("pbd"),
			'IS_PAYOR_TPD' => $this->input->post("is_pbtpd"),
			'PAYOR_TPD' => $this->input->post("pbtpd"),
			'IS_SPOUSE_DEATH' => $this->input->post("is_spd"),
			'SPOUSE_DEATH' => $this->input->post("spd"),
			'IS_WAIVER_TPD' => $this->input->post("is_wptpd"),
			'WAIVER_TPD' => $this->input->post("wptpd"),
			'IS_WAIVER_CI' => $this->input->post("is_wpci51"),
			'WAIVER_CI' => $this->input->post("wpci51"),
			'IS_SPOUSE_TPD' => $this->input->post("is_sptpd"),
			'SPOUSE_TPD' => $this->input->post("sptpd"),
			'IS_ADB' => $this->input->post("is_adb"),
			'ADB' => $this->input->post("adb"),
			'IS_PAYOR_CI' => $this->input->post("is_pbci"),
			'PAYOR_CI' => $this->input->post("pbci"),
			'IS_SPOUSE_CI' => $this->input->post("is_spci"),
			'SPOUSE_CI' => $this->input->post("spci"),
			
		);
		$result = $this->ModSimulasiKakean->insertProDataRiderOld($data['datariderold']);

			$data['dataprojua_dasar'] = array(
				'BUILD_ID' => $this->session->userdata('build_id'),
				'JENIS' => 'POKOK',
				'NILAI' => $this->input->post("uadasar")
			);
			$this->ModSimulasiKakean->insertProJua($data['dataprojua_dasar']);

			$data['dataprojua_adb'] = array(
				'BUILD_ID' => $this->session->userdata('build_id'),
				'JENIS' => 'ADB',
				'NILAI' => $this->input->post("adb")
			);
			$this->ModSimulasiKakean->insertProJua($data['dataprojua_adb']);

			$data['dataprojua_ci53'] = array(
				'BUILD_ID' => $this->session->userdata('build_id'),
				'JENIS' => 'CI',
				'NILAI' => $this->input->post("ci53")
			);
			$this->ModSimulasiKakean->insertProJua($data['dataprojua_ci53']);

			$data['dataprojua_wpci51'] = array(
				'BUILD_ID' => $this->session->userdata('build_id'),
				'JENIS' => 'WAIVER_CI',
				'NILAI' => $this->input->post("wpci51")
			);
			$this->ModSimulasiKakean->insertProJua($data['dataprojua_wpci51']);

			$data['dataprojua_tr'] = array(
				'BUILD_ID' => $this->session->userdata('build_id'),
				'JENIS' => 'TL',
				'NILAI' => $this->input->post("tr")
			);
			$this->ModSimulasiKakean->insertProJua($data['dataprojua_tr']);

			$data['dataprojua_hcp'] = array(
				'BUILD_ID' => $this->session->userdata('build_id'),
				'JENIS' => 'HCP_MURNI',
				'NILAI' => $this->input->post("hcp")
			);
			$this->ModSimulasiKakean->insertProJua($data['dataprojua_hcp']);

			$data['dataprojua_tpd'] = array(
				'BUILD_ID' => $this->session->userdata('build_id'),
				'JENIS' => 'TPD',
				'NILAI' => $this->input->post("tpd")
			);
			$this->ModSimulasiKakean->insertProJua($data['dataprojua_tpd']);

			$data['dataprojua_wptpd'] = array(
				'BUILD_ID' => $this->session->userdata('build_id'),
				'JENIS' => 'WAIVER_TPD',
				'NILAI' => $this->input->post("wptpd")
			);
			$this->ModSimulasiKakean->insertProJua($data['dataprojua_wptpd']);

			$data['dataprojua_addb'] = array(
				'BUILD_ID' => $this->session->userdata('build_id'),
				'JENIS' => 'ADDB',
				'NILAI' => $this->input->post("addb")
			);
			$this->ModSimulasiKakean->insertProJua($data['dataprojua_addb']);

			$data['dataprojua_pbd'] = array(
				'BUILD_ID' => $this->session->userdata('build_id'),
				'JENIS' => 'PAYOR_DEATH',
				'NILAI' => $this->input->post("pbd")
			);
			$this->ModSimulasiKakean->insertProJua($data['dataprojua_pbd']);

			$data['dataprojua_pbci'] = array(
				'BUILD_ID' => $this->session->userdata('build_id'),
				'JENIS' => 'PAYOR_CI',
				'NILAI' => $this->input->post("pbci")
			);
			$this->ModSimulasiKakean->insertProJua($data['dataprojua_pbci']);

			$data['dataprojua_pbtpd'] = array(
				'BUILD_ID' => $this->session->userdata('build_id'),
				'JENIS' => 'PAYOR_TPD',
				'NILAI' => $this->input->post("pbtpd")
			);
			$this->ModSimulasiKakean->insertProJua($data['dataprojua_pbtpd']);

			$data['dataprojua_spd'] = array(
				'BUILD_ID' => $this->session->userdata('build_id'),
				'JENIS' => 'SPOUSE_DEATH',
				'NILAI' => $this->input->post("spd")
			);
			$this->ModSimulasiKakean->insertProJua($data['dataprojua_spd']);

			$data['dataprojua_spci'] = array(
				'BUILD_ID' => $this->session->userdata('build_id'),
				'JENIS' => 'SPOUSE_CI',
				'NILAI' => $this->input->post("spci")
			);
			$this->ModSimulasiKakean->insertProJua($data['dataprojua_spci']);

			$data['dataprojua_sptpd'] = array(
				'BUILD_ID' => $this->session->userdata('build_id'),
				'JENIS' => 'SPOUSE_TPD',
				'NILAI' => $this->input->post("sptpd")
			);
			$this->ModSimulasiKakean->insertProJua($data['dataprojua_sptpd']);
		
	}

	function hasil(){
		$this->load->model('ModSimulasiKakean');
		$data['kodeprospek'] = $_GET['kodeprospek'];		
		$data['prospek'] = $this->ModSimulasiKakean->GetDataAgen($_GET['kodeprospek']);
		
		$this->load->view('hasil/jspromapannew_2019', $data);
	}
	
	function hasilifg() {
		$this->load->model('ModSimulasiKakean');
		$data['kodeprospek'] = $_GET['kodeprospek'];		
		$data['prospek'] = $this->ModSimulasiKakean->GetDataAgen($_GET['kodeprospek']);
		
		$this->load->view('hasil/jspromapanifg', $data);
	}

	function ilustrasi(){
		
		$this->load->model('ModSimulasiKakean');
		$data['kodeprospek'] = $_GET['kodeprospek'];	
		$this->load->view('hasil/ilustrasi_2019');
	}

	function ilustrasi_new(){
		
		$this->load->model('ModSimulasiKakean');
		$data['kodeprospek'] = $_GET['kodeprospek'];	
		$this->load->view('hasil/ilustrasi_2019_bk');
	}

	function CetakPDF()
	{
		$buildid = $_GET['build_id'];
		$data['filepdf'] = $_GET['filepdf'];
		$data['kodeprospek'] = $_GET['kodeprospek'];

		$this->load->model('modpromapannew2019');
		$this->load->model('ModSimulasiKakean');
		
		$data['hasilProTertanggung'] = $this->modpromapannew2019->selectProTertanggung($buildid);
		$data['hasilProPempol'] = $this->modpromapannew2019->selectProPempol($buildid);
		$data['hasilProAsuransiPokok'] = $this->modpromapannew2019->selectProAsuransiPokok($buildid);
		$data['hasilProAlokasiDana'] = $this->ModSimulasiKakean->selectProAlokasiDana($buildid);
		$data['hasilProDataRiderNew'] = $this->modpromapannew2019->selectProDataRiderNew($buildid); 
		$data['hasilProKeteranganRider'] = $this->modpromapannew2019->selectProKeteranganRider($buildid);
		// $data['hasilProDataRider'] = $this->mod_promapan->selectProDataRider($buildid);
		// $data['hasilProTotalBiayaAll'] = $this->mod_promapan->selectProTotalBiayaAll($buildid);
		$data['hasilProTotalInvestasi1'] = $this->modpromapannew2019->selectProTotalInvestasi1($buildid);
		$data['hasilProTotalInvestasi2'] = $this->modpromapannew2019->selectProTotalInvestasi2($buildid);
		// $data['hasilProTotalRingkasan'] = $this->mod_promapan->selectProTotalRingkasan($buildid);
		$data['hasilProTotalKomparasi'] = $this->modpromapannew2019->selectProTotalKomparasi($buildid);
		$this->load->view('pdf/promapan_create_pdf_new',$data);

	}
	
	function CetakPDFIFG()
	{
		$buildid = $_GET['build_id'];
		$data['filepdf'] = $_GET['filepdf'];
		$data['kodeprospek'] = $_GET['kodeprospek'];

		$this->load->model('modpromapannew2019');
		$this->load->model('ModSimulasiKakean');
		
		$data['hasilProTertanggung'] = $this->modpromapannew2019->selectProTertanggung($buildid);
		$data['hasilProPempol'] = $this->modpromapannew2019->selectProPempol($buildid);
		$data['hasilProAsuransiPokok'] = $this->modpromapannew2019->selectProAsuransiPokok($buildid);
		$data['hasilProAlokasiDana'] = $this->ModSimulasiKakean->selectProAlokasiDanaIFG($buildid);
		$data['hasilProDataRiderNew'] = $this->modpromapannew2019->selectProDataRiderNew($buildid); 
		$data['hasilProKeteranganRider'] = $this->modpromapannew2019->selectProKeteranganRider($buildid);
		// $data['hasilProDataRider'] = $this->mod_promapan->selectProDataRider($buildid);
		// $data['hasilProTotalBiayaAll'] = $this->mod_promapan->selectProTotalBiayaAll($buildid);
		$data['hasilProTotalInvestasi1'] = $this->modpromapannew2019->selectProTotalInvestasi1($buildid);
		$data['hasilProTotalInvestasi2'] = $this->modpromapannew2019->selectProTotalInvestasi2($buildid);
		// $data['hasilProTotalRingkasan'] = $this->mod_promapan->selectProTotalRingkasan($buildid);
		$data['hasilProTotalKomparasi'] = $this->modpromapannew2019->selectProTotalKomparasi($buildid);
		$this->load->view('pdf/lifeprimeifg',$data);

	}

	function insertDataPDF(){
		
		$this->load->model('ModSimulasi');	
		
		$idHit = $this->ModSimulasi->GetIdHit();
		$data['idHit'] = $idHit['ID_HIT'] + 1;
		
		$DataAgen = $this->ModSimulasi->GetDataAgen($this->input->post("kodeprospek"));
		$idAgen = $DataAgen['NOAGEN'];
		
		$carabayar = $this->input->post("carabayarjspromapannew");
		
		if ($carabayar == 1)
		{
			$carabayar = 'Bulanan';
		}
		else if ($carabayar == 3)
		{
			$carabayar = 'Kuartalan';	
		}else if ($carabayar == 4)
		{
			$carabayar = 'Semesteran';	
		}else
		{
			$carabayar = 'Tahunan';	
		}
		
		$data['hitung'] = array(
			'ID_HIT' => $data['idHit'],
			'BUILD_ID' => $this->session->userdata('build_id'),
			'ID_AGEN' => $idAgen,
			'FILE_PDF' => 'SIMULASI-'.strtoupper($this->input->post("namalengkapcalontertanggung")).'-'.$this->session->userdata('build_id'),
			'ID_PRODUK' => 12,
			'SESSION_ID' => '',
			'NO_PROSPEK' => $this->input->post("kodeprospek"),
			'CARA_BAYAR' => $carabayar,
			'JUMLAH_PREMI' => $this->input->post("totalpremi"),
			'JUA' => $this->input->post("uangpertanggungan")
		);
		
		$result = $this->ModSimulasi->insertSimulasi($data['hitung']);
		
	}

	function insertDataPDFIFG(){
		
		$this->load->model('ModSimulasi');	
		
		$idHit = $this->ModSimulasi->GetIdHit();
		$data['idHit'] = $idHit['ID_HIT'] + 1;
		
		$DataAgen = $this->ModSimulasi->GetDataAgen($this->input->post("kodeprospek"));
		$idAgen = $DataAgen['NOAGEN'];
		
		$carabayar = $this->input->post("carabayarjspromapannew");
		
		if ($carabayar == 1)
		{
			$carabayar = 'Bulanan';
		}
		else if ($carabayar == 3)
		{
			$carabayar = 'Kuartalan';	
		}else if ($carabayar == 4)
		{
			$carabayar = 'Semesteran';	
		}else
		{
			$carabayar = 'Tahunan';	
		}
		
		$data['hitung'] = array(
			'ID_HIT' => $data['idHit'],
			'BUILD_ID' => $this->session->userdata('build_id'),
			'ID_AGEN' => $idAgen,
			'FILE_PDF' => 'SIMULASI-'.strtoupper($this->input->post("namalengkapcalontertanggung")).'-'.$this->session->userdata('build_id'),
			'ID_PRODUK' => 16,
			'SESSION_ID' => '',
			'NO_PROSPEK' => $this->input->post("kodeprospek"),
			'CARA_BAYAR' => $carabayar,
			'JUMLAH_PREMI' => $this->input->post("totalpremi"),
			'JUA' => $this->input->post("uangpertanggungan")
		);
		
		$result = $this->ModSimulasi->insertSimulasi($data['hitung']);
		
	}
}	

