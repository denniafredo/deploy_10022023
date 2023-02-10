<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");
	
	error_reporting(0);


class Jsanuitas_new extends CI_Controller{

	function index(){
		$dataBuildID = $this->ModSimulasi->getBuildID();
		$data['hasil']['buildID'] = $dataBuildID['BUILDID'];
		
		echo $data['hasil']['buildID']." -- BuildID  <br>";
		$this->session->set_userdata('build_id', $data['hasil']['buildID']);
		
		$NoProspek =$this->input->get('kode_prospek');
		if (($NoProspek != ''))
		{
			$this->template->display_anuitas('simulasi');
		}
		else
		{	
			redirect('https://jaim.jiwasraya.co.id', 'refresh');
		}
	}
	
	function cgetTarifAll(){
		$this->load->model('Modanuitas');
		$usiasekarang_th  = $this->input->post("usiacalontertanggung_th");
		$usiasekarang_bl  = $this->input->post("usiacalontertanggung_bl");
		$statuskawin = $this->input->post("statuskawin");

		$result = $this->Modanuitas->getTarifAnuitas($usiasekarang_th, $usiasekarang_bl, $statuskawin);
		$hasil = $result;
		
		echo json_encode($hasil);
	}

	
	function insertProPempol(){
		
		$this->load->model('Modanuitas');
		
		$data['pempol'] = array(
			'BUILD_ID' => $this->session->userdata('build_id'),
			'HUBUNGAN' => $this->input->post("hubungandenganpempol"),
			'NAMA' => $this->input->post("namalengkap_cpp"),
			'JENIS_KELAMIN' => $this->input->post("jeniskelamin_cpp"),
			'TGL_LAHIR' => date("d/m/Y", strtotime($this->input->post("tanggallahir_cpp"))),
			'IS_PEROKOK' => $this->input->post("perokok_cpp"),
			'USIA_TH' => $this->input->post("usia_cpp_th"),
			'USIA_BL' => $this->input->post("usia_cpp_bl"),
			'TELEPON' => $this->input->post("phone_cpp"),
			'EMAIL' => $this->input->post("email_cpp"),
			'HP' => $this->input->post("handphone_cpp"),
			'KDJNSPEKERJAAN' => $this->input->post("kdjnspekerjaan_cpp"),
			'NO_KTP' => $this->input->post("noktp_cpp"),
			'MARITALSTATUS' => $this->input->post("maritalstatus_cpp"),
		);
		
		$result = $this->Modanuitas->insertProPempolNew($data['pempol']);

	    echo $result;
	}

	function insertProTertanggung(){
		
		$this->load->model('Modanuitas');
				
		$data['tertanggung'] = array(
			'BUILD_ID' => $this->session->userdata('build_id'),
			'HUBUNGAN' => $this->input->post("hubungandenganpempol"),
			'NAMA' => $this->input->post("namalengkap_ctt"),
			'JENIS_KELAMIN' => $this->input->post("jeniskelamin_ctt"),
			'TGL_LAHIR' => date("d/m/Y", strtotime($this->input->post("tanggallahircalontertanggung"))),
			'IS_PEROKOK' => $this->input->post("perokok"),
			'USIA_TH' => $this->input->post("usia_ctt_th"),
			'USIA_BL' => $this->input->post("usia_ctt_bl"),
			'TELEPON' => $this->input->post("phone_cpp"),
			'EMAIL' => $this->input->post("email_cpp"),
			'HP' => $this->input->post("handphone_cpp"),
			'NO_KTP' => $this->input->post("noktp_ctt"),
			'KDJNSPEKERJAAN' => $this->input->post("kdjnspekerjaan_ctt"),
			'MARITALSTATUS' => $this->input->post("maritalstatus_ctt"),
		);
		
		$result = $this->Modanuitas->insertProTertanggungNew($data['tertanggung']);

	    echo $result;
	}
	
	// function insertProAsuransiPokok(){
		
	// 	$this->load->model('Modproidaman');
		
	// 	$data['asuransipokok'] = array(
	// 		'BUILD_ID' => $this->session->userdata('build_id'),
	// 		'ASUMSI_CUTI_PREMI' => $this->input->post("asumsicutipremi"),
	// 		'CARA_BAYAR' => $this->input->post("carabayarjspromapannew"),
	// 		'USIA_PRODUKTIF' => $this->input->post("usiaproduktif"),
	// 		'PENGHASILAN' => $this->input->post("penghasilansatutahun"),
	// 		'UA' => $this->input->post("uangpertanggungan"),
	// 		'MAKSIMAL_UA' => $this->input->post("maksimaluangasuransi"),
	// 		'PREMI_BERKALA' => $this->input->post("premidasar"),
	// 		//'TOPUP_BERKALA' => $this->input->post("topupberkala"),
	// 		'TOPUP_SEKALIGUS' => $this->input->post("topupsekaligus"),
	// 		'AKUMULASI_RESIKO_AWAL' => $this->input->post("resikoawalproposalctt"),
	// 		'PERIODE_TOPUP' => $this->input->post("periodetopupsekaligus"),
	// 		'PEMERIKSAAN' => $this->input->post("pemeriksaan"),
	// 		'MEDICAL' => $this->input->post("medical"),
	// 		//'MATERAI' => $this->input->post("beamaterai"),
	// 		'VALUTA' => 'IDR'
	// 	);
		
	// 	$result = $this->Modproidaman->insertProAsuransiPokok($data['asuransipokok']);

	//     echo $result;
	// }

	function hasil(){
		$this->load->model('Modanuitas');
		$this->load->view('hasil/hasil_anuitas');
	}

	function CetakPDF()
	{
		$buildid = $_GET['build_id'];
		
		$this->load->model('Modanuitas');
		
		$data['hasilProTertanggung'] = $this->Modanuitas->selectProTertanggungPdf($buildid);
		$data['hasilProPempol'] = $this->Modanuitas->selectProPempolPdf($buildid);
		$data['hasil300Hitung'] = $this->Modanuitas->select300HitungPdf($buildid);

		$this->load->view('pdf/jsanuitas_create_pdf',$data);

	}

	function insertDataPDF(){
		
		$this->load->model('ModSimulasi');	
		
		$idHit = $this->ModSimulasi->GetIdHit();
		$data['idHit'] = $idHit['ID_HIT'] + 1;
		
		$DataAgen = $this->ModSimulasi->GetDataAgen($this->input->post("kodeprospek"));
		$idAgen = $DataAgen['NOAGEN'];
		
		$data['hitung'] = array(
			'ID_HIT' => $data['idHit'],
			'BUILD_ID' => $this->session->userdata('build_id'),
			'ID_AGEN' => $idAgen,
			'FILE_PDF' => 'SIMULASI-'.strtoupper($this->input->post("namalengkap_ctt")).'-'.$this->session->userdata('build_id'),
			'ID_PRODUK' => 10,
			'SESSION_ID' => '',
			'NO_PROSPEK' => $this->input->post("kodeprospek"),
			'CARA_BAYAR' => 'SEKALIGUS',
			'JUMLAH_PREMI' => $this->input->post("premi"),
			'JUA' => 0,
			'PHT' => $this->input->post("manfaat_pensiun"),
		);
		
		$result = $this->ModSimulasi->insertSimulasi($data['hitung']);

		// $this->load->view('hasil/hasil_anuitas',$data);
		
	}
	  
}	

