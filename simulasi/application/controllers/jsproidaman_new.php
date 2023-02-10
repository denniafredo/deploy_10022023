<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");
	
	error_reporting(0);


class Jsproidaman_new extends CI_Controller{

	function index(){
		$dataBuildID = $this->ModSimulasi->getBuildID();
		$data['hasil']['buildID'] = $dataBuildID['BUILDID'];
		
		echo $data['hasil']['buildID']." -- BuildID  <br>";
		$this->session->set_userdata('build_id', $data['hasil']['buildID']);
		
		$NoProspek =$this->input->get('kode_prospek');
		if (($NoProspek != ''))
		{
			$this->template->display_proidaman('simulasi');
		}
		else
		{	
			redirect('https://jaim.jiwasraya.co.id', 'refresh');
		}
	}
	
	function cgetTarifAll(){
		$this->load->model('Modproidaman');
		$usiasekarang  = $this->input->post("usiacalontertanggung");

		$result = $this->Modproidaman->getTarifUA_all($usiasekarang);
		$hasil = $result;
		
		echo json_encode($hasil);
	}

	function cgetAsumsiDanaInvest(){
		$this->load->model('Modproidaman');
		$usiasekarang  = $this->input->post("usiacalontertanggung");
		$result = $this->Modproidaman->getAsumsiDanaInvest($usiasekarang);
		$hasil = $result;
		
		echo json_encode($hasil);
	}

	function cgetTarifSpousePayor(){
		$this->load->model('Modproidaman');
		$usiasekarang  = $this->input->post("usiacalonpemegangpolis");

		$result = $this->Modproidaman->getTarifUA_SpousePayor($usiasekarang);
		$hasil = $result;
		
		echo json_encode($hasil);
	}
	
	function cgetEkstraPremi(){
		$this->load->model('Modproidaman');
		$kdjenispekerjaanctt  = $this->input->post("kdjenispekerjaanctt");

		$result = $this->Modproidaman->getEkstraPremi($kdjenispekerjaanctt);
		$hasil = $result;
		
		echo json_encode($hasil);
	}

	function cgetResikoAwal(){
		$this->load->model('Modproidaman');
		$kdnpert  = $this->input->post("kdnpert");

		$result = $this->Modproidaman->getResikoAwal($kdnpert);
		$hasil = $result;
		
		echo json_encode($hasil);
	}

	function insertProPempol(){
		
		$this->load->model('Modproidaman');
		
		$data['pempol'] = array(
			'BUILD_ID' => $this->session->userdata('build_id'),
			'HUBUNGAN' => $this->input->post("hubungandenganpempol"),
			'NAMA' => $this->input->post("namalengkap"),
			'JENIS_KELAMIN' => $this->input->post("gender"),
			'TGL_LAHIR' => date("d/m/Y", strtotime($this->input->post("tanggallahir"))),
			'IS_PEROKOK' => $this->input->post("perokokpempol"),
			'TELEPON' => $this->input->post("phone"),
			'EMAIL' => $this->input->post("email"),
			'HP' => $this->input->post("handphone"),
			'KDJNSPEKERJAAN' => $this->input->post("kdjnspekerjaanpempol"),
			'NO_KTP' => $this->input->post("noktpcpp"),
		);
		
		$result = $this->Modproidaman->insertProPempolNew($data['pempol']);

	    echo $result;
	}

	function insertProTertanggung(){
		
		$this->load->model('Modproidaman');
				
		$data['tertanggung'] = array(
			'BUILD_ID' => $this->session->userdata('build_id'),
			'HUBUNGAN' => $this->input->post("hubungandenganpempol"),
			'NAMA' => $this->input->post("namalengkapcalontertanggung"),
			'JENIS_KELAMIN' => $this->input->post("jeniskelamincalontertanggung"),
			'TGL_LAHIR' => date("d/m/Y", strtotime($this->input->post("tanggallahircalontertanggung"))),
			'IS_PEROKOK' => $this->input->post("perokok"),
			'TELEPON' => $this->input->post("phone"),
			'EMAIL' => $this->input->post("email"),
			'HP' => $this->input->post("handphone"),
			'NO_KTP' => $this->input->post("noktp"),
			'KDJNSPEKERJAAN' => $this->input->post("kdjnspekerjaancalontertanggung"),
		);
		
		$result = $this->Modproidaman->insertProTertanggungNew($data['tertanggung']);

	    echo $result;
	}
	
	function insertProAsuransiPokok(){
		
		$this->load->model('Modproidaman');
		
		$data['asuransipokok'] = array(
			'BUILD_ID' => $this->session->userdata('build_id'),
			'ASUMSI_CUTI_PREMI' => $this->input->post("asumsicutipremi"),
			'CARA_BAYAR' => $this->input->post("carabayarjspromapannew"),
			'USIA_PRODUKTIF' => $this->input->post("usiaproduktif"),
			'PENGHASILAN' => $this->input->post("penghasilansatutahun"),
			'UA' => $this->input->post("uangpertanggungan"),
			'MAKSIMAL_UA' => $this->input->post("maksimaluangasuransi"),
			'PREMI_BERKALA' => $this->input->post("premidasar"),
			//'TOPUP_BERKALA' => $this->input->post("topupberkala"),
			'TOPUP_SEKALIGUS' => $this->input->post("topupsekaligus"),
			'AKUMULASI_RESIKO_AWAL' => $this->input->post("resikoawalproposalctt"),
			'PERIODE_TOPUP' => $this->input->post("periodetopupsekaligus"),
			'PEMERIKSAAN' => $this->input->post("pemeriksaan"),
			'MEDICAL' => $this->input->post("medical"),
			//'MATERAI' => $this->input->post("beamaterai"),
			'VALUTA' => 'IDR'
		);
		
		$result = $this->Modproidaman->insertProAsuransiPokok($data['asuransipokok']);

	    echo $result;
	}

	function insertProAlokasiDana(){
		
		$this->load->model('Modproidaman');
		
		$data['alokasidana'] = array(
			'BUILD_ID' => $this->session->userdata('build_id'),
			'NAMA_ALOKASI1' => $this->input->post("alokasidana1"),
			'ALOKASI1' => $this->input->post("persentasealokasidana1")/100,
			'NAMA_ALOKASI2' => $this->input->post("alokasidana2"),
			'ALOKASI2' => $this->input->post("persentasealokasidana2")/100
		);
		$result = $this->Modproidaman->insertProAlokasiDanaNew($data['alokasidana']);
	    echo $result;
	}

	function insertProDataRider(){
		
		$this->load->model('Modproidaman');
		
		$data['datarider'] = array(
			'BUILD_ID' => $this->session->userdata('build_id'),
			'IS_UADASAR' => $this->input->post("is_uadasar"),
			'UADASAR' => $this->input->post("uadasar"),
			'BIAYA_UADASAR' => $this->input->post("biaya_uadasar")
		);

		$result = $this->Modproidaman->insertProDataRiderNew($data['datarider']);
		echo $this->session->userdata('build_id');

		
		$data['datariderold'] = array(
			'BUILD_ID' => $this->session->userdata('build_id')
		);

		$result = $this->Modproidaman->insertProDataRiderOld($data['datariderold']);

			$data['dataprojua_dasar'] = array(
				'BUILD_ID' => $this->session->userdata('build_id'),
				'JENIS' => 'POKOK',
				'NILAI' => $this->input->post("uadasar")
			);
			$this->Modproidaman->insertProJua($data['dataprojua_dasar']);
	}

	function hasil(){
		$this->load->model('Modproidaman');
		$data['prospek'] = $this->Modproidaman->GetDataAgen($_GET['kodeprospek']);
		$data['kodeprospek'] = $_GET['kodeprospek'];
		
		$this->load->view('hasil/hasil_jsproidaman', $data);
	}

	function CetakPDF()
	{
		$buildid = $_GET['build_id'];
		$data['filepdf'] = $_GET['filepdf'];
		$data['kodeprospek'] = $_GET['kodeprospek'];

		$this->load->model('Modproidaman');
		
		$data['hasilProTertanggung'] = $this->Modproidaman->selectProTertanggungPdf($buildid);
		$data['hasilProPempol'] = $this->Modproidaman->selectProPempolPdf($buildid);
		$data['hasilProAsuransiPokok'] = $this->Modproidaman->selectProAsuransiPokokPdf($buildid);
		$data['hasilProAlokasiDana'] = $this->Modproidaman->selectProAlokasiDanaPdf($buildid);
		$data['hasilProDataRiderNew'] = $this->Modproidaman->selectProDataRiderNewPdf($buildid);
		$data['hasilProKeteranganRider'] = $this->Modproidaman->selectProKeteranganRiderPdf($buildid);
		$data['hasilProTotalInvestasi1'] = $this->Modproidaman->selectProTotalInvestasi1Pdf($buildid);
		$data['hasilProTotalKomparasi'] = $this->Modproidaman->selectProTotalKomparasiPdf($buildid);
		$this->load->view('pdf/jsproidaman_create_pdf',$data);

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
			'FILE_PDF' => 'SIMULASI-'.strtoupper($this->input->post("namalengkapcalontertanggung")).'-'.$this->session->userdata('build_id'),
			'ID_PRODUK' => 4,
			'SESSION_ID' => '',
			'NO_PROSPEK' => $this->input->post("kodeprospek"),
			'CARA_BAYAR' => 'Sekaligus',
			'JUMLAH_PREMI' => $this->input->post("totalpremi"),
			'JUA' => $this->input->post("uangpertanggungan")
		);
		
		$result = $this->ModSimulasi->insertSimulasi($data['hitung']);
		
	}
	  
}	

