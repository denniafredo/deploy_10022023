<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");
	
	error_reporting(0);

//	session_start();

class Jspromapankakehanberubah extends CI_Controller{
	
		
	
	
	function insertProTertanggung(){
		
		$this->load->model('ModSimulasiKakean');
		
//		$result = $this->ModSimulasiKakean->selectMaxIDTertanggung();
		
		$data['tertanggung'] = array(
//			'BUILD_ID' => $result['BUILD_ID'],
			'BUILD_ID' => $this->session->userdata('build_id'),
			'HUBUNGAN' => $this->input->post("hubungandenganpempol"),
			'NAMA' => $this->input->post("namalengkapcalontertanggung"),
			'JENIS_KELAMIN' => $this->input->post("jeniskelamincalontertanggung"),
			'TGL_LAHIR' => date("d/m/Y", strtotime($this->input->post("tanggallahircalontertangggung"))),
			'IS_PEROKOK' => $this->input->post("perokok"),
			'TELEPON' => $this->input->post("phone"),
			'EMAIL' => $this->input->post("email"),
			'HP' => $this->input->post("handphone"),
			'NO_KTP' => $this->input->post("noktp"),
		);
		
		$result = $this->ModSimulasiKakean->insertProTertanggung($data['tertanggung']);

	    echo $result;
	}
	
	function insertProPempol(){
		
		$this->load->model('ModSimulasiKakean');
		
//		$result = $this->ModSimulasiKakean->selectMaxIDPempol();
		
		$data['pempol'] = array(
//			'BUILD_ID' => $result['BUILD_ID'],
			'BUILD_ID' => $this->session->userdata('build_id'),
			'HUBUNGAN' => $this->input->post("hubungandenganpempol"),
			'NAMA' => $this->input->post("namalengkap"),
			'JENIS_KELAMIN' => $this->input->post("gender"),
			'TGL_LAHIR' => date("d/m/Y", strtotime($this->input->post("tanggallahir"))),
			'IS_PEROKOK' => $this->input->post("perokokpempol"),
			'TELEPON' => $this->input->post("phone"),
			'EMAIL' => $this->input->post("email"),
			'HP' => $this->input->post("handphone"),
		);
		
		$result = $this->ModSimulasiKakean->insertProPempol($data['pempol']);

	    echo $result;
	}
	
	function insertProAsuransiPokok(){
		
		$this->load->model('ModSimulasiKakean');
		
//		$result = $this->ModSimulasiKakean->selectMaxIDAsuransiPokok();
		
		$data['asuransipokok'] = array(
//			'BUILD_ID' => $result['BUILD_ID'],
			'BUILD_ID' => $this->session->userdata('build_id'),
			'ASUMSI_CUTI_PREMI' => $this->input->post("asumsicutipremi"),
			'CARA_BAYAR' => $this->input->post("carabayarjspromapannew"),
			'USIA_PRODUKTIF' => $this->input->post("usiaproduktif"),
			'PENGHASILAN' => $this->input->post("penghasilansatutahun"),
			'UA' => $this->input->post("uangpertanggungan"),
			'MAKSIMAL_UA' => $this->input->post("maksimaluangasuransi"),
//			'MEDICAL' => '0',
			'PREMI_BERKALA' => $this->input->post("premiberkala"),
			'TOPUP_BERKALA' => $this->input->post("topupberkala"),
			'PERIODE_TOPUP' => $this->input->post("periodetopupsekaligus"),
			'TOPUP_SEKALIGUS' => $this->input->post("topupsekaligus"),
			'MATERAI' => $this->input->post("beamaterai"),
			'VALUTA' => 'IDR'
		);
		
		$result = $this->ModSimulasiKakean->insertProAsuransiPokok($data['asuransipokok']);

	    echo $result;
	}
	
	function insertProAlokasiDana(){
		
		$this->load->model('ModSimulasiKakean');
		
//		$result = $this->ModSimulasiKakean->selectMaxIDAlokasiDana();
		
		$data['alokasidana'] = array(
//			'BUILD_ID' => $result['BUILD_ID'],
			'BUILD_ID' => $this->session->userdata('build_id'),
			'NAMA_ALOKASI1' => $this->input->post("alokasidana1"),
			'ALOKASI1' => $this->input->post("persentasealokasidana1")/100,
			'NAMA_ALOKASI2' => $this->input->post("alokasidana2"),
			'ALOKASI2' => $this->input->post("persentasealokasidana2")/100,
			
		);
		
		$result = $this->ModSimulasiKakean->insertProAlokasiDana($data['alokasidana']);
		
		
		/*enhanced : iie 02052019*/
				
		$datax['as_BUILDID'] = $this->session->userdata('build_id');
		$datax['as_cb'] 	= $this->input->post("carabayarjspromapannew");
		$datax['as_usia'] 	= $this->input->post("usiasekarang");	
		$datax['as_dana'] 	= $this->input->post("totalpremi");
		
		$result = $this->ModSimulasiKakean->setUAByRider($datax);
						
		/*end of enhanced : iie 02052019*/
		
		
		

	    echo $result;
	}
	
	
	/*=================enhanced by iie : 02052019=====================*/

	function getDataProRiderAll(){
		
		$this->load->model('ModSimulasiKakean');
		
		$buildID = $this->session->userdata('build_id');
			
		$result = $this->ModSimulasiKakean->getDataProRiderAll($buildID);
		
		
		$hasil = $result;
		
		echo $hasil;
		
	}
	
	
	function recalcUAByRider()
	{
		$this->load->model('ModSimulasiKakean');
		
			
		$datax['as_BUILDID'] = $this->session->userdata('build_id');
		$datax['as_cb'] 	= $this->input->post("carabayarjspromapannew");
		$datax['as_usia'] 	= $this->input->post("usiasekarang");	
		$datax['as_dana'] 	= $this->input->post("totalpremi");		
		$pilihriderlainnya  = $this->input->post("pilihriderlainnya");
		$fieldName = "";
		$fieldNameUnset = "";
		
		switch ($pilihriderlainnya) {
			case "JS Critical Ilness":
				$fieldName = "IS_CI";
				$fieldNameUnset = "IS_TL = '0', IS_ADDB = '0', IS_TPD = '0', IS_HCP_MURNI = '0' ";
				break;
			case "JS Term Insurance":
				$fieldName = "IS_TL";
				$fieldNameUnset = "IS_CI = '0', IS_ADDB = '0', IS_TPD = '0', IS_HCP_MURNI = '0' ";
				break;
			case "JS ADDB":
				$fieldName = "IS_ADDB";
				$fieldNameUnset = "IS_CI = '0', IS_TL = '0', IS_TPD = '0', IS_HCP_MURNI = '0' ";
				break;
			case "JS TPD":
				$fieldName = "IS_TPD";
				$fieldNameUnset = "IS_CI = '0', IS_TL = '0', IS_ADDB = '0', IS_HCP_MURNI = '0' ";
				break;
			case "JS HCP":
				$fieldName = "IS_HCP_MURNI";
				$fieldNameUnset = "IS_CI = '0', IS_TL = '0', IS_ADDB = '0', IS_TPD = '0' ";
				break;
			case "":
				$fieldName = "";
				$fieldNameUnset = "IS_CI = '0', IS_TL = '0', IS_ADDB = '0', IS_TPD = '0', IS_HCP_MURNI = '0' ";
				break;
			default:
				$fieldName = "IS_CI";
				$fieldNameUnset = "IS_TL = '0', IS_ADDB = '0', IS_TPD = '0', IS_HCP_MURNI = '0' ";
		}
		
		
		/*1. update dulu tabel pro rider*/
		$result = $this->ModSimulasiKakean->updateByRider($fieldName, $fieldNameUnset, $datax['as_BUILDID']);
		
		
		/*2. recall kembali*/
		$result = $this->ModSimulasiKakean->setUAByRider($datax);
		
		
		
		
		echo $result;
	}


	/*======================end of enhanced : iie 02052019======================*/
	function insertDataPDF(){
		
		$this->load->model('ModSimulasiKakean');	
		
		$idHit = $this->ModSimulasiKakean->GetIdHit();
		$data['idHit'] = $idHit['ID_HIT'] + 1;
		
		$DataAgen = $this->ModSimulasiKakean->GetDataAgen($this->input->post("kodeprospek"));
		$idAgen = $DataAgen['NOAGEN'];
		
		$carabayar = $this->input->post("carabayarjspromapannew");
		
		if ($carabayar == 1)
		{
			$carabayar = 'Bulanan';
		}
		else if ($carabayar == 2)
		{
			$carabayar = 'Tahunan';	
		}
		
		$data['hitung'] = array(
			'ID_HIT' => $data['idHit'],
			'BUILD_ID' => $this->session->userdata('build_id'),
			'ID_AGEN' => $idAgen,
			'FILE_PDF' => 'SIMULASI-'.strtoupper($this->input->post("namalengkapcalontertanggung")).'-'.$this->session->userdata('build_id'),
			'ID_PRODUK' => 1,
			'SESSION_ID' => '',
			'NO_PROSPEK' => $this->input->post("kodeprospek"),
			'CARA_BAYAR' => $carabayar,
			'JUMLAH_PREMI' => $this->input->post("totalpremi"),
			'JUA' => $this->input->post("uangpertanggungan")
		);
		
		$result = $this->ModSimulasiKakean->insertSimulasi($data['hitung']);
		
//		$filepdf = 'SIMULASI-'.strtoupper($this->input->post("namalengkapcalontertanggung")).'-'.$this->session->userdata('build_id');
		
//		echo $filepdf;

		
		
	}
	
	function insertProDataRider(){
		
		$this->load->model('ModSimulasiKakean');
		
		$data['datarider'] = array(
			'BUILD_ID' => $this->session->userdata('build_id'),
			'IS_ADDB' => $this->input->post("jsaddbjspromapannew"),
			'ADDB' => $this->input->post("uangasuransijsaddbjspromapannew"),
			'IS_TPD' => $this->input->post("jstpdjspromapannew"),
			'TPD' => $this->input->post("uangasuransijstpdjspromapannew"),
			'IS_HCP_MURNI' => $this->input->post("hcpjspromapannew"),
			'PLAFON_HCP_MURNI' => $this->input->post("uangasuransihcpjspromapannew"),
			'HCP_MURNI' => $this->input->post("premihcpjspromapannew"),
			'IS_HCP_BEDAH' => $this->input->post("hcpbjspromapannew"),
			'PLAFON_HCP_BEDAH' => $this->input->post("uangasuransihcpbjspromapannew"),
			'HCP_BEDAH' => $this->input->post("premihcpbjspromapannew"),
			'IS_CI' => $this->input->post("ci53jspromapannew"),
			'CI' => $this->input->post("uangasuransici53jspromapannew"),
			'IS_TL' => $this->input->post("termjspromapannew"),
			'TL' => $this->input->post("uangasuransitermjspromapannew"),
			'IS_PAYOR_DEATH' => $this->input->post("jspbdjspromapannew"),
			'PAYOR_DEATH' => $this->input->post("uangasuransijspbdjspromapannew"),
			'IS_PAYOR_TPD' => $this->input->post("jspbtpdjspromapannew"),
			'PAYOR_TPD' => $this->input->post("uangasuransijspbtpdjspromapannew"),
			'IS_SPOUSE_DEATH' => $this->input->post("jsspdjspromapannew"),
			'SPOUSE_DEATH' => $this->input->post("uangasuransijsspdjspromapannew"),
			'IS_WAIVER_TPD' => $this->input->post("jswptpdjspromapannew"),
			'WAIVER_TPD' => $this->input->post("uangasuransijswptpdjspromapannew"),
			'IS_WAIVER_CI' => $this->input->post("jswpcijspromapannew"),
			'WAIVER_CI' => $this->input->post("uangasuransijswpcijspromapannew"),
			'IS_SPOUSE_TPD' => $this->input->post("jssptpdjspromapannew"),
			'SPOUSE_TPD' => $this->input->post("uangasuransijssptpdjspromapannew"),
			'IS_ADB' => $this->input->post("jsadbjspromapannew"),
			'ADB' => $this->input->post("uangasuransijsadbjspromapannew"),
		);
		
		$result = $this->ModSimulasiKakean->insertProDataRider($data['datarider']);
		
		$result2 = $this->ModSimulasiKakean->GenerateAllData($this->session->userdata('build_id'));
		
	    echo $this->session->userdata('build_id');
		
	}
	
	function hitungsaranua(){
		
		$this->load->model('ModSimulasiKakean');
		
		$totalpremi = $this->input->post("totalpremi");
		$usiasekarang = $this->input->post("usiasekarang");	
		$carabayarjspromapannew = $this->input->post("carabayarjspromapannew");
		
		if ($carabayarjspromapannew == '1')
		{
			//$carabayar = '4';
			$carabayar = '1';
		}
		else if ($carabayarjspromapannew == '2') 
		{
			//$carabayar = '1';	
			$carabayar = '4';
		}
		/*echo $carabayar.'<br>';
		echo $usiasekarang.'<br>';
		echo $uangpertanggungan.'<br>';*/
		
		$result = $this->ModSimulasiKakean->getSaranUA($carabayar, $usiasekarang, $totalpremi);
		
		$hasil = $result['SUGGEST'];
		
		echo $hasil;
	}
	
	function hitungpremisekaligusdwigunamenaik(){
		
		$this->load->model('ModSimulasiKakean');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		$result = $this->ModSimulasiKakean->getPremiSekaligusDwigunaMenaik($masaasuransi, $usiasekarang);
		
		$hasil = $result['TARIF'] * ($uangasuransipokok / 1000);
		
		echo round($hasil);
	}
	
	function hitungpremi5tahunpertamadwigunamenaik(){
		
		$this->load->model('ModSimulasiKakean');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		$result = $this->ModSimulasiKakean->getPremi5TahunPertamaDwigunaMenaik($masaasuransi, $usiasekarang);
		
		$hasil = ($result['TARIF'] * ($uangasuransipokok / 1000)) * 1.05;
		
		echo round($hasil);
	}
	
	function hitungpremi5tahunberikutnyadwigunamenaik(){
		
		$this->load->model('ModSimulasiKakean');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		$result = $this->ModSimulasiKakean->getPremi5TahunBerikutnyaDwigunaMenaik($masaasuransi, $usiasekarang);
		
		$hasil = ($result['TARIF'] * ($uangasuransipokok / 1000)) * 1.05 * 0.52; 
		
		echo round($hasil);
	}
	
	function hitungpremikuartalan(){
		
		$this->load->model('ModSimulasiKakean');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		$result = $this->ModSimulasiKakean->getPremi5TahunBerikutnyaDwigunaMenaik($masaasuransi, $usiasekarang);
		
		$hasil = ($result['TARIF'] * ($uangasuransipokok / 1000)) * 1.05 * 0.27; 
		
		echo round($hasil);
	}
	
	function hitungpremibulanan(){
		
		$this->load->model('ModSimulasiKakean');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		$result = $this->ModSimulasiKakean->getPremi5TahunBerikutnyaDwigunaMenaik($masaasuransi, $usiasekarang);
		
		$hasil = ($result['TARIF'] * ($uangasuransipokok / 1000)) * 1.05 * 0.095; 
		
		echo round($hasil);
	}
	
	//RIDER 
	
	function hitungjshcppromapannew(){
		$this->load->model("ModSimulasiKakean");
		
		$uangasuransihcpjspromapannew = $this->input->post("uangasuransihcpjspromapannew");
		
		$jeniskelamincalontertanggung = $this->input->post("jeniskelamincalontertanggung");
		
		$usiasekarang = $this->input->post("usiasekarang");
		
		$result = $this->ModSimulasiKakean->getBiayaAsuransiPerBulanHCPJSProMapan($usiasekarang, $uangasuransihcpjspromapannew, $jeniskelamincalontertanggung);
		
		$hasil = $result['TARIF'] / 12;
		
		echo round($hasil);
		
	}
	
	function hitungjshcpbpromapannew(){
		
		$this->load->model("ModSimulasiKakean");
		
		$uangasuransihcpbjspromapannew = $this->input->post("uangasuransihcpbjspromapannew");
		
		$jeniskelamincalontertanggung = $this->input->post("jeniskelamincalontertanggung");
		
		$usiasekarang = $this->input->post("usiasekarang");
		
		$result = $this->ModSimulasiKakean->getBiayaAsuransiPerBulanHCPBJSProMapan($usiasekarang, $uangasuransihcpbjspromapannew, $jeniskelamincalontertanggung);
		
		$carabayarjspromapannew = $this->input->post("carabayarjspromapannew");
		
		if ($carabayarjspromapannew == 'Tahunan')
		{
			$faktorkali = 1;
		}
		else if ($carabayarjspromapannew == 'Semesteran')
		{
			$faktorkali = 0.52;
		}
		else if ($carabayarjspromapannew == 'Kuartalan')
		{
			$faktorkali = 0.27;
		}
		else if ($carabayarjspromapannew == 'Bulanan')
		{
			$faktorkali = 0.095;
		}
		else if ($carabayarjspromapannew == 'Sekaligus')
		{
			$faktorkali = 0;
		}
		
		$hasil = $result['TARIF'] / 12;
		
		echo round($hasil);
		
	}
	
	function hitungjstpdpromapannew() {
		$this->load->model('ModSimulasiKakean');
		
		$usiasekarang = $this->input->post("usiasekarang");
		
		$uangasuransijstpdjspromapannew = $this->input->post("uangasuransijstpdjspromapannew");
		
		$jeniskelamincalontertanggung = $this->input->post("jeniskelamincalontertanggung");
		
		if ($jeniskelamincalontertanggung == 'L')
		{
			$jeniskelamincalontertanggung = 'MALE';
		}
		else if ($jeniskelamincalontertanggung == 'P')
		{
			$jeniskelamincalontertanggung = 'FEMALE';
		}
			
		$result = $this->ModSimulasiKakean->getBiayaAsuransiPerBulanTPDJSProMapan($usiasekarang);
		
//		$hasil = (($result[$jeniskelamincalontertanggung]/1000) * $uangasuransijstpdjspromapannew) * $faktorkali;
		
		$hasil = ((str_replace(",",".",$result[$jeniskelamincalontertanggung])/1000) * $uangasuransijstpdjspromapannew) / 12;
		
		echo round($hasil);
		
	}
	
	function hitungjswpdwigunamenaik() {
		$this->load->model('ModSimulasiKakean');
		
		$usiasekarang = $this->input->post("usiasekarang");
		
		$masaasuransi = $this->input->post("masaasuransi");
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		
		$result = $this->ModSimulasiKakean->getPremi5TahunPertamaDwigunaMenaik($masaasuransi, $usiasekarang);
		
		//$result2 = $this->ModSimulasiKakean->getBiayaAsuransiPerBulanSPD($usiasekarang);
		
		$carabayarjsdwigunamenaik = $this->input->post("carabayarjsdwigunamenaik");
		
		if ($carabayarjsdwigunamenaik == 'Tahunan')
		{
			$faktorkali = 1;
		}
		else if ($carabayarjsdwigunamenaik == 'Semesteran')
		{
			$faktorkali = 0.52;
		}
		else if ($carabayarjsdwigunamenaik == 'Kuartalan')
		{
			$faktorkali = 0.27;
		}
		else if ($carabayarjsdwigunamenaik == 'Bulanan')
		{
			$faktorkali = 0.095;
		}
		else if ($carabayarjsdwigunamenaik == 'Sekaligus')
		{
			$faktorkali = 0;
		}
		
		$hasiltemp = (($uangasuransipokok/1000 * $result['TARIF']));
		
		$result2 = $this->ModSimulasiKakean->getPremiTambahanWPDwigunaMenaik($masaasuransi, $usiasekarang, $kdtarif, $hasiltemp, $faktorkali);
		
		echo round($result2['HASIL']);
		
	}
	
	function hitungjsci53promapannew() {
		$this->load->model('ModSimulasiKakean');
		
		$usiasekarang = $this->input->post("usiasekarang");
		
		$uangasuransici53jspromapannew = $this->input->post("uangasuransici53jspromapannew");
		
		$jeniskelamincalontertanggung = $this->input->post("jeniskelamincalontertanggung");
		
		if ($jeniskelamincalontertanggung == 'L')
		{
			$jeniskelamincalontertanggung = 'MALE';
		}
		else if ($jeniskelamincalontertanggung == 'P')
		{
			$jeniskelamincalontertanggung = 'FEMALE';
		}
		
		$carabayarjspromapannew = $this->input->post("carabayarjspromapannew");
		
		if ($carabayarjspromapannew == 'Tahunan')
		{
			$faktorkali = 1;
		}
		else if ($carabayarjspromapannew == 'Semesteran')
		{
			$faktorkali = 0.52;
		}
		else if ($carabayarjspromapannew == 'Kuartalan')
		{
			$faktorkali = 0.27;
		}
		else if ($carabayarjspromapannew == 'Bulanan')
		{
			$faktorkali = 0.095;
		}
		else if ($carabayarjspromapannew == 'Sekaligus')
		{
			$faktorkali = 0;
		}
		
		$result = $this->ModSimulasiKakean->getBiayaAsuransiPerBulanCI53JSProMapan($usiasekarang);
		
		$hasil = ((str_replace(",",".",$result[$jeniskelamincalontertanggung])/1000) * $uangasuransici53jspromapannew) / 12;
		
		echo round($hasil);
	}
	
	function hitungjsaddbpromapannew() {
		$this->load->model('ModSimulasiKakean');
		
		$usiasekarang = $this->input->post("usiasekarang");
		
		$uangasuransijsaddbjspromapannew = $this->input->post("uangasuransijsaddbjspromapannew");
		
		$jeniskelamincalontertanggung = $this->input->post("jeniskelamincalontertanggung");
		
		if ($jeniskelamincalontertanggung == 'L')
		{
			$jeniskelamincalontertanggung = 'MALE';
		}
		else if ($jeniskelamincalontertanggung == 'P')
		{
			$jeniskelamincalontertanggung = 'FEMALE';
		}
		
		$result = $this->ModSimulasiKakean->getBiayaAsuransiPerBulanADDB($usiasekarang);
		
//		$hasil = (($result[$jeniskelamincalontertanggung]/1000) * $uangasuransijsaddbjspromapannew) * $faktorkali;
		
		$hasil = (($result[$jeniskelamincalontertanggung]/1000) * $uangasuransijsaddbjspromapannew) / 12;
		
		echo round($hasil);
	}
	
	function hitungjsspddwigunamenaik() {
		$this->load->model('ModSimulasiKakean');
		
		$usiasekarang = $this->input->post("usiasekarang");
		
		$masaasuransi = $this->input->post("masaasuransi");
		
		$uangasuransipokok = $this->input->post(uangasuransipokok);
		
		$result = $this->ModSimulasiKakean->getPremi5TahunPertamaDwigunaMenaik($masaasuransi, $usiasekarang);
		
		$jeniskelamincalontertanggung = $this->input->post("jeniskelamincalontertanggung");
		
		if ($jeniskelamincalontertanggung == 'L')
		{
			$jeniskelamincalontertanggung = 'MALE';
		}
		else if ($jeniskelamincalontertanggung == 'P')
		{
			$jeniskelamincalontertanggung = 'FEMALE';
		}
		
		$result2 = $this->ModSimulasiKakean->getBiayaAsuransiPerBulanSPD($usiasekarang);
		
		$carabayarjsdwigunamenaik = $this->input->post("carabayarjsdwigunamenaik");
		
		if ($carabayarjsdwigunamenaik == 'Tahunan')
		{
			$faktorkali = 1;
		}
		else if ($carabayarjsdwigunamenaik == 'Semesteran')
		{
			$faktorkali = 0.52;
		}
		else if ($carabayarjsdwigunamenaik == 'Kuartalan')
		{
			$faktorkali = 0.27;
		}
		else if ($carabayarjsdwigunamenaik == 'Bulanan')
		{
			$faktorkali = 0.095;
		}
		else if ($carabayarjsdwigunamenaik == 'Sekaligus')
		{
			$faktorkali = 0;
		}
		
		$hasil = (($uangasuransipokok/1000 * $result['TARIF']) * ($result2[$jeniskelamincalontertanggung]/100) *$faktorkali);
		
		echo round($hasil);
	}
	
	function hitungjssptpddwigunamenaik() {
		$this->load->model('ModSimulasiKakean');
		
		$usiasekarang = $this->input->post("usiasekarang");
		
		$masaasuransi = $this->input->post("masaasuransi");
		
		$uangasuransipokok = $this->input->post(uangasuransipokok);
		
		$result = $this->ModSimulasiKakean->getPremi5TahunPertamaDwigunaMenaik($masaasuransi, $usiasekarang);
		
		$jeniskelamincalontertanggung = $this->input->post("jeniskelamincalontertanggung");
		
		if ($jeniskelamincalontertanggung == 'L')
		{
			$jeniskelamincalontertanggung = 'MALE';
		}
		else if ($jeniskelamincalontertanggung == 'P')
		{
			$jeniskelamincalontertanggung = 'FEMALE';
		}
		
		$result2 = $this->ModSimulasiKakean->getBiayaAsuransiPerBulanSPTPD($usiasekarang);
		
		$carabayarjsdwigunamenaik = $this->input->post('carabayarjsdwigunamenaik');
		
		if ($carabayarjsdwigunamenaik == 'Tahunan')
		{
			$faktorkali = 1;
		}
		else if ($carabayarjsdwigunamenaik == 'Semesteran')
		{
			$faktorkali = 0.52;
		}
		else if ($carabayarjsdwigunamenaik == 'Kuartalan')
		{
			$faktorkali = 0.27;
		}
		else if ($carabayarjsdwigunamenaik == 'Bulanan')
		{
			$faktorkali = 0.095;
		}
		else if ($carabayarjsdwigunamenaik == 'Sekaligus')
		{
			$faktorkali = 0;
		}
		
		$hasil = (($uangasuransipokok/1000 * $result['TARIF']) * ($result2[$jeniskelamincalontertanggung]/100) *$faktorkali);
		
		echo round($hasil);
	}
	
	function hitungjstermpromapannew() {
		$this->load->model('ModSimulasiKakean');
		
		$usiasekarang = $this->input->post("usiasekarang");
		
		$uangasuransitermjspromapannew = $this->input->post("uangasuransitermjspromapannew");
		
		$perokok = $this->input->post("perokok");
		
		if ($perokok == 'T')
		{
			$statusperokok = 'NONSMOKER';
			$faktorpengali = 3;
		}
		else if ($perokok == 'Y')
		{
			$statusperokok = 'SMOKER';
			$faktorpengali = 2;
		}
		
		$result = $this->ModSimulasiKakean->getBiayaAsuransiPerBulanTermJSProMapan($usiasekarang);
		
		$hasil = (($result[$statusperokok]/10000)/1000 * $uangasuransitermjspromapannew) / 12;
		
		echo round($hasil);
	}
	
	function hitung(){
	    //echo $html;
		//echo base_url().'files/pdf';
		$idNasabah = $this->ModSimulasiKakean->GetIdNasabah();
		$data['idNasabah'] = $idNasabah['ID_NASABAH'] + 1;
		$data['nasabah'] = array(
			'ID_NASABAH' => $data['idNasabah'],
			'NAMA' => $this->input->post('namanasabah'),
			'ALAMAT' => $this->input->post('alamatnasabah'),
			'KOTA' => $this->input->post('kotanasabah'),
			'PROVINSI' => $this->input->post('provinsinasabah'),
			'EMAIL' => $this->input->post('emailnasabah'),
			'TELP' => $this->input->post('teleponnasabah'),
			'TGL_LAHIR' => date("Y-m-d", strtotime($this->input->post('lahirnasabah'))),
			'JENIS_KEL' => $this->input->post('gendernasabah'),
			'SESSION_ID' => $this->input->post('sessionnasabah')
			//'premisekaligus' => $this->input->post('premisekaligus')
		);
		
		//$nasabahID = $this->ModSimulasiKakean->insertNasabah($data['nasabah']);
		
		$data['premi'] = array(
			'masaasuransi' => $this->input->post('masaasuransi'),
			'saatmulaiunitlink' => $this->input->post('saatmulaiunitlink'),
			'nomeragen' => $this->input->post('nomeragen'),
			'namaagen' => $this->input->post('namaagen'),
			'kantorcabang' => $this->input->post('kantorcabang'),
			'premisekaligus' => $this->input->post('premisekaligus'),
			'proteksi' => $this->input->post('proteksi'),
			'uangasuransi' => $this->input->post('uangasuransi'),
			'modul' => $this->input->post('modul'),
			'bunganett' => $this->input->post('bunganett')
		);
		
		$dataBuildID = $this->ModSimulasiKakean->getBuildID();
		$data['hasil']['buildID'] = $dataBuildID['BUILDID'];
		
		$filePdf = 'SIMULASI-'.strtoupper($this->input->post('namanasabah')).'-'.strtoupper($this->input->post('modul')).'-'.$data['hasil']['buildID'];
		
		$data['hitung'] = array(
			'id_nasabah' => $nasabahID,
			'id_agen' => $this->input->post('nomeragen'),
			'file_pdf' => $filePdf.'.pdf',
			'id_produk' => $this->input->post('idproduk'),
			'session_id' => $this->input->post('sessionnasabah')
		);
		
		//$this->ModSimulasiKakean->insertNasabah($data['hitung']);
		
		$newdata = array(
			'nama' => $this->input->post('namanasabah'),
			'alamat' => $this->input->post('alamatnasabah'),
			'kota' => $this->input->post('kotanasabah'),
			'provinsi' => $this->input->post('provinsinasabah'),
			'email' => $this->input->post('emailnasabah'),
			'telp' => $this->input->post('teleponnasabah'),
			'tgl_lahir' => date("Y-m-d", strtotime($this->input->post('lahirnasabah'))),
			'jenis_kel' => $this->input->post('gendernasabah'),
			'session_id' => $this->input->post('sessionnasabah'),
			'nomeragen' => $this->input->post('nomeragen'),
			'premisekaligus' => $this->input->post('premisekaligus'),
			'modul' => $this->input->post('modul'),
			'namaagen' => $this->input->post('namaagen'),
			'kodekantor' => $this->input->post('kodekantor'),
			//'kantorcabang' => $this->input->post('kantorcabang'),
			'id_nasabah' => $nasabahID,
			'id_agen' => $this->input->post('nomeragen'),
			'file_pdf' => $filePdf.'.pdf',
			'id_produk' => $this->input->post('idproduk'),
			'filepdf' => $filePdf,
			'kodeprospek' => $this->input->post('kodeprospek'),
			
			'usia' => $this->input->post('usia'),
			'hubungandenganpempol' => $this->input->post('hubungandenganpempol'),
			'namalengkapcalontertanggung' => $this->input->post('namalengkapcalontertanggung'),
			'jeniskelamincalontertanggung' => $this->input->post('jeniskelamincalontertanggung'),
			'tanggallahircalontertangggung' => $this->input->post('tanggallahircalontertangggung'),
			'perokok' => $this->input->post('perokok'),
			'tertanggungsamadenganpemegangpolis' => $this->input->post('tertanggungsamadenganpemegangpolis'),
			
			'tanggalilustrasi' => $this->input->post('tanggalilustrasi'),
			'asumsicutipremi' => $this->input->post('asumsicutipremi'),
			'carabayarjspromapannew' => $this->input->post('carabayarjspromapannew'),
			'usiaproduktif' => $this->input->post('usiaproduktif'),
			'penghasilansatutahun' => $this->input->post('penghasilansatutahun'),
			'maksimaluangasuransi' => $this->input->post('maksimaluangasuransi'),
			'uangpertanggungan' => $this->input->post('uangpertanggungan'),
			'premiberkala' => $this->input->post('premiberkala'),
			'topupberkala' => $this->input->post('topupberkala'),
			'topupsekaligus' => $this->input->post('topupsekaligus'),
			'beamaterai' => $this->input->post('beamaterai'),
			'totalpremi' => $this->input->post('totalpremi'),
			
			'alokasidana1' => $this->input->post('alokasidana1'),
			'alokasidana2' => $this->input->post('alokasidana2'),
			'persentasealokasidana1' => $this->input->post('persentasealokasidana1'),
			'persentasealokasidana2' => $this->input->post('persentasealokasidana2'),
			
			'hcpjspromapannew' => $this->input->post('hcpjspromapannew'),
			'premihcpjspromapannew' => $this->input->post('premihcpjspromapannew'),
			'uangasuransihcpjspromapannew' => $this->input->post('uangasuransihcpjspromapannew'),
			
			'hcpbjspromapannew' => $this->input->post('hcpbjspromapannew'),
			'premihcpbjspromapannew' => $this->input->post('premihcpbjspromapannew'),
			'uangasuransihcpbjspromapannew' => $this->input->post('uangasuransihcpbjspromapannew'),
			
			'totalpremiriderjspromapannew1' => $this->input->post('totalpremiriderjspromapannew1'),
			
			'jsaddbjspromapannew' => $this->input->post('jsaddbjspromapannew'),
			'premijsaddbjspromapannew' => $this->input->post('premijsaddbjspromapannew'),
			'uangasuransijsaddbjspromapannew' => $this->input->post('uangasuransijsaddbjspromapannew'),
			
			'jstpdjspromapannew' => $this->input->post('jstpdjspromapannew'),
			'premijstpdjspromapannew' => $this->input->post('premijstpdjspromapannew'),
			'uangasuransijstpdjspromapannew' => $this->input->post('uangasuransijstpdjspromapannew'),
			
			'ci53jspromapannew' => $this->input->post('ci53jspromapannew'),
			'premici53jspromapannew' => $this->input->post('premici53jspromapannew'),
			'uangasuransici53jspromapannew' => $this->input->post('uangasuransici53jspromapannew'),
			
			'termjspromapannew' => $this->input->post('termjspromapannew'),
			'premitermjspromapannew' => $this->input->post('premitermjspromapannew'),
			'uangasuransitermjspromapannew' => $this->input->post('uangasuransitermjspromapannew'),

			'jspbdjspromapannew' => $this->input->post('jspbdjspromapannew'),
			'premijspbdjspromapannew' => $this->input->post('premijspbdjspromapannew'),
			'uangasuransijspbdjspromapannew' => $this->input->post('uangasuransijspbdjspromapannew'),
			
			'jspbtpdjspromapannew' => $this->input->post('jspbtpdjspromapannew'),
			'premijspbtpdjspromapannew' => $this->input->post('premijspbtpdjspromapannew'),
			'uangasuransijspbtpdjspromapannew' => $this->input->post('uangasuransijspbtpdjspromapannew'),
			
			'jsspdjspromapannew' => $this->input->post('jsspdjspromapannew'),
			'premijsspdjspromapannew' => $this->input->post('premijsspdjspromapannew'),
			'uangasuransijsspdjspromapannew' => $this->input->post('uangasuransijsspdjspromapannew'),
			
			'jssptpdjspromapannew' => $this->input->post('jssptpdjspromapannew'),
			'premijssptpdjspromapannew' => $this->input->post('premijssptpdjspromapannew'),
			'uangasuransijssptpdjspromapannew' => $this->input->post('uangasuransijssptpdjspromapannew'),
			
			'jswptpdjspromapannew' => $this->input->post('jswptpdjspromapannew'),
			'premijswptpdjspromapannew' => $this->input->post('premijswptpdjspromapannew'),
			'uangasuransijswptpdjspromapannew' => $this->input->post('uangasuransijswptpdjspromapannew'),
		
			'jswpcijspromapannew' => $this->input->post('jswpcijspromapannew'),
			'premijswpcijspromapannew' => $this->input->post('premijswpcijspromapannew'),
			'uangasuransijswpcijspromapannew' => $this->input->post('uangasuransijswpcijspromapannew'),
			
			'totalpremiriderjspromapannewsum' => $this->input->post('totalpremiriderjspromapannewsum'),
		
  		);
		
		
		$this->session->set_userdata($newdata);
		
		//$html = $this->load->view('pdf/optima7',$data,true);
		//$this->load->view('hasil/optima7');*/
	}

	function hasil(){
		
		$this->load->model('ModSimulasiKakean');
		
		$bulan = array(
		'1'=>'Januari',
		'2'=>'Februari',
		'3'=>'Maret',
		'4'=>'April',
		'5'=>'Mei',
		'6'=>'Juni',
		'7'=>'Juli',
		'8'=>'Agustus',
		'9'=>'September',
		'10'=>'Oktober',
		'11'=>'November',
		'12'=>'Desember'
		);
		
		$tanggalSekarang = date("d", strtotime("now"));
		$bulanSekarang = $bulan[date("n", strtotime("now"))];
		$tahunSekarang = date("Y", strtotime("now"));
		$data['hasil']['tanggalsekarang'] = $tanggalSekarang.' '.$bulanSekarang.' '.$tahunSekarang;
		
		$tanggalSaatMulaiAsuransi = date("d", strtotime($this->session->userdata('saatmulaiasuransi')));
		$bulanSaatMulaiAsuransi = $bulan[date("n", strtotime($this->session->userdata('saatmulaiasuransi')))];
		$tahunSaatMulaiAsuransi = date("Y", strtotime($this->session->userdata('saatmulaiasuransi')));
		$data['hasil']['saatmulaiasuransi'] = $tanggalSaatMulaiAsuransi.' '.$bulanSaatMulaiAsuransi.' '.$tahunSaatMulaiAsuransi;
		
		$tanggalLahir = date("d", strtotime($this->session->userdata('tgl_lahir')));
		$bulanLahir = $bulan[date("n", strtotime($this->session->userdata('tgl_lahir')))];
		$tahunLahir = date("Y", strtotime($this->session->userdata('tgl_lahir')));
		$data['hasil']['tgl_lahir'] = $tanggalLahir.' '.$bulanLahir.' '.$tahunLahir;
		
		$sekarang = date("Y-m-d", strtotime("now"));
		$lahirnasabah = date("Y-m-d", strtotime($this->session->userdata('tgl_lahir')));
		$selisihnasabah = abs(strtotime($sekarang) - strtotime($lahirnasabah));
		$yearsnasabah = floor($selisihnasabah/ (365*60*60*24));
		$data['hasil']['usianasabah'] = $yearsnasabah;
		
		$lahircalonpemegangpolis = date("Y-m-d", strtotime($this->session->userdata('tgl_lahir')));
		$lahircalontertanggung = date("Y-m-d", strtotime($this->session->userdata('tanggallahircalontertangggung')));
		$sekarang = date("Y-m-d", strtotime("now"));
		
		$selisihcalonpemegangpolis = abs(strtotime($sekarang) - strtotime($lahircalonpemegangpolis));
		$selisihcalontertanggung = abs(strtotime($sekarang) - strtotime($lahircalontertanggung));
		
		$yearscalonpemegangpolis = floor($selisihcalonpemegangpolis / (365*60*60*24));
		$yearscalontertanggung = floor($selisihcalontertanggung / (365*60*60*24));
		
		$data['hasil']['usiacalonpemegangpolis'] = $yearscalonpemegangpolis;
		$data['hasil']['usiacalontertanggung'] = $yearscalontertanggung;
		
		$tanggalLahirCalonPemegangPolis = date("d", strtotime($this->session->userdata('tgl_lahir')));
		$bulanLahirCalonPemegangPolis = $bulan[date("n", strtotime($this->session->userdata('tgl_lahir')))];
		$tahunLahirCalonPemegangPolis = date("Y", strtotime($this->session->userdata('tgl_lahir')));
		$data['hasil']['tanggallahircalonpemegangpolis'] = $tanggalLahirCalonPemegangPolis.' '.$bulanLahirCalonPemegangPolis.' '.$tahunLahirCalonPemegangPolis;
		
		$tanggalLahirCalonTertanggung= date("d", strtotime($this->session->userdata('tanggallahircalontertangggung')));
		$bulanLahirCalonTertanggung = $bulan[date("n", strtotime($this->session->userdata('tanggallahircalontertangggung')))];
		$tahunLahirCalonTertanggung = date("Y", strtotime($this->session->userdata('tanggallahircalontertangggung')));
		$data['hasil']['tanggallahircalontertangggung'] = $tanggalLahirCalonTertanggung.' '.$bulanLahirCalonTertanggung.' '.$tahunLahirCalonTertanggung;
								
		$jeniskel = $this->session->userdata('jenis_kel');
		
		if ($jeniskel == 'M')
		{
			$data['hasil']['jenis_kel'] = 'L';
		}
		else if ($jeniskel == 'F')
		{
			$data['hasil']['jenis_kel'] = 'P';
		}
		
		$data['hasil']['namalengkapcalontertanggung'] = $this->session->userdata('namalengkapcalontertanggung');
		$data['hasil']['jeniskelamincalontertanggung'] = $this->session->userdata('jeniskelamincalontertanggung');
		
		$data['hasil']['tanggalilustrasi'] = $this->session->userdata('tanggalilustrasi');
		$data['hasil']['asumsicutipremi'] = $this->session->userdata('asumsicutipremi');
		$data['hasil']['carabayarjspromapannew'] = $this->session->userdata('carabayarjspromapannew');
		
		$data['hasil']['usiaproduktif'] = $this->session->userdata('usiaproduktif');
		$data['hasil']['penghasilansatutahun'] = $this->session->userdata('penghasilansatutahun');
		$data['hasil']['maksimaluangasuransi'] = $this->session->userdata('maksimaluangasuransi');
		$data['hasil']['uangpertanggungan'] = $this->session->userdata('uangpertanggungan');
		$data['hasil']['premiberkala'] = $this->session->userdata('premiberkala');
		$data['hasil']['topupberkala'] = $this->session->userdata('topupberkala');
		$data['hasil']['topupsekaligus'] = $this->session->userdata('topupsekaligus');
		$data['hasil']['beamaterai'] = $this->session->userdata('beamaterai');
		$data['hasil']['totalpremi'] = $this->session->userdata('totalpremi');

		$data['hasil']['alokasidana1'] = $this->session->userdata('alokasidana1');
		$data['hasil']['alokasidana2'] = $this->session->userdata('alokasidana2');
		$data['hasil']['persentasealokasidana1'] = $this->session->userdata('persentasealokasidana1');
		$data['hasil']['persentasealokasidana2'] = $this->session->userdata('persentasealokasidana2');
		
		$data['hasil']['hcpjspromapannew'] = $this->session->userdata('hcpjspromapannew');
		$data['hasil']['premihcpjspromapannew'] = $this->session->userdata('premihcpjspromapannew');
		$data['hasil']['uangasuransihcpjspromapannew'] = $this->session->userdata('uangasuransihcpjspromapannew');
		
		$data['hasil']['hcpbjspromapannew'] = $this->session->userdata('hcpbjspromapannew');
		$data['hasil']['premihcpbjspromapannew'] = $this->session->userdata('premihcpbjspromapannew');
		$data['hasil']['uangasuransihcpbjspromapannew'] = $this->session->userdata('uangasuransihcpbjspromapannew');
		
		$data['hasil']['totalpremiriderjspromapannew1'] = $this->session->userdata('totalpremiriderjspromapannew1');
		
		$data['hasil']['jsaddbjspromapannew'] = $this->session->userdata('jsaddbjspromapannew');
		$data['hasil']['premijsaddbjspromapannew'] = $this->session->userdata('premijsaddbjspromapannew');
		$data['hasil']['uangasuransijsaddbjspromapannew'] = $this->session->userdata('uangasuransijsaddbjspromapannew');
		
		$data['hasil']['jstpdjspromapannew'] = $this->session->userdata('jstpdjspromapannew');
		$data['hasil']['premijstpdjspromapannew'] = $this->session->userdata('premijstpdjspromapannew');
		$data['hasil']['uangasuransijstpdjspromapannew'] = $this->session->userdata('uangasuransijstpdjspromapannew');
		
		$data['hasil']['ci53jspromapannew'] = $this->session->userdata('ci53jspromapannew');
		$data['hasil']['premici53jspromapannew'] = $this->session->userdata('premici53jspromapannew');
		$data['hasil']['uangasuransici53jspromapannew'] = $this->session->userdata('uangasuransici53jspromapannew');
		
		$data['hasil']['termjspromapannew'] = $this->session->userdata('termjspromapannew');
		$data['hasil']['premitermjspromapannew'] = $this->session->userdata('premitermjspromapannew');
		$data['hasil']['uangasuransitermjspromapannew'] = $this->session->userdata('uangasuransitermjspromapannew');
		
		$data['hasil']['jspbdjspromapannew'] = $this->session->userdata('jspbdjspromapannew');
		$data['hasil']['premijspbdjspromapannew'] = $this->session->userdata('premijspbdjspromapannew');
		$data['hasil']['uangasuransijspbdjspromapannew'] = $this->session->userdata('uangasuransijspbdjspromapannew');
		
		$data['hasil']['jspbtpdjspromapannew'] = $this->session->userdata('jspbtpdjspromapannew');
		$data['hasil']['premijspbtpdjspromapannew'] = $this->session->userdata('premijspbtpdjspromapannew');
		$data['hasil']['uangasuransijspbtpdjspromapannew'] = $this->session->userdata('uangasuransijspbtpdjspromapannew');
		
		$data['hasil']['jsspdjspromapannew'] = $this->session->userdata('jsspdjspromapannew');
		$data['hasil']['premijsspdjspromapannew'] = $this->session->userdata('premijsspdjspromapannew');
		$data['hasil']['uangasuransijsspdjspromapannew'] = $this->session->userdata('uangasuransijsspdjspromapannew');
		
		$data['hasil']['jssptpdjspromapannew'] = $this->session->userdata('jssptpdjspromapannew');
		$data['hasil']['premijssptpdjspromapannew'] = $this->session->userdata('premijssptpdjspromapannew');
		$data['hasil']['uangasuransijssptpdjspromapannew'] = $this->session->userdata('uangasuransijssptpdjspromapannew');
		
		$data['hasil']['jswptpdjspromapannew'] = $this->session->userdata('jswptpdjspromapannew');
		$data['hasil']['premijswptpdjspromapannew'] = $this->session->userdata('premijswptpdjspromapannew');
		$data['hasil']['uangasuransijswptpdjspromapannew'] = $this->session->userdata('uangasuransijswptpdjspromapannew');
		
		$data['hasil']['jswpcijspromapannew'] = $this->session->userdata('jswpcijspromapannew');
		$data['hasil']['premijswpcijspromapannew'] = $this->session->userdata('premijswpcijspromapannew');
		$data['hasil']['uangasuransijswpcijspromapannew'] = $this->session->userdata('uangasuransijswpcijspromapannew');
		
		$data['hasil']['totalpremiriderjspromapannewsum'] = $this->session->userdata('totalpremiriderjspromapannewsum');
		
		$data['hasil']['filepdf'] = $this->session->userdata('filepdf');
		$data['hasil']['id_nasabah'] = $this->session->userdata('id_nasabah');
		$data['hasil']['id_agen']	 = $this->session->userdata('id_agen');
		//$data['hasil']['file_pdf']	 = $filePdf.'.pdf',
		$data['hasil']['id_produk']  = $this->session->userdata('id_produk');
		
		//$data['hasil']['filepdf'] = $filepdf;
		$data['hasil']['nama'] = $this->session->userdata('nama');
		$data['hasil']['namaagen'] = strtoupper(str_replace("-"," ",$this->session->userdata('namaagen')));
		$kodeKantor = $DataAgen['KDKANTOR'];
		$dataKantor = $this->ModSimulasiKakean->cariDataKantor($kodeKantor);
		$data['hasil']['kantorcabang'] = $dataKantor['NAMAKANTOR'];
		$data['hasil']['nomeragen'] = $this->session->userdata('nomeragen');
		
		$NoProspek = $this->session->userdata('kodeprospek');
		//$NoProspek = 'LC151022000001';
		$DataAgen = $this->ModSimulasiKakean->GetDataAgen($NoProspek);
		$idAgen = $DataAgen['NOAGEN'];
		
		$api = json_decode(file_get_contents(C_URL_API_JAIM."/agen.php?r=1&p=$idAgen"), true);
		
		//echo $api['NAMALENGKAP'];
		//echo "\n";
		//echo $api['NAMAKANTOR'];
		
		$data['hasil']['namaagen'] = $api['NAMALENGKAP'];
		$data['hasil']['nomeragen'] = $idAgen;
		$data['hasil']['kantorcabang'] = $api['NAMAKANTOR'];
		
		$idHit = $this->ModSimulasiKakean->GetIdHit();
		$data['idHit'] = $idHit['ID_HIT'] + 1;
		
		if ($data['hasil']['carabayarjspromapannew'] == 'Bulanan')
		{	  
			
		}
		else if ($data['hasil']['carabayarjspromapannew'] == 'Tahunan')
		{
			
		}
		else 
		{
			
		}
		
		$dataBuildID = $this->ModSimulasiKakean->getBuildID();
		$data['hasil']['buildID'] = $dataBuildID['BUILDID'];
		
		$data['hitung'] = array(
			'ID_HIT' => $data['idHit'],
			'BUILD_ID' => $data['hasil']['buildID'],
			'ID_AGEN' => $idAgen,
			'FILE_PDF' => $this->session->userdata('filepdf').'.pdf',
			'ID_PRODUK' => $this->session->userdata('id_produk'),
			'SESSION_ID' => $this->session->userdata('session_id'),
			'NO_PROSPEK' => $NoProspek,
			'CARA_BAYAR' => $data['hasil']['carabayarjspromapannew'],
			'JUMLAH_PREMI' => $data['hasil']['totalpremiriderjspromapannewsum']
		);
		
		$this->ModSimulasiKakean->insertSimulasi($data['hitung']);
		
		$data['hasil']['build_id'] = $data['hitung']['BUILD_ID'];
				
		$filePdf = $this->session->userdata('filepdf');
		
//		$this->createPDF($filePdf,$data);
		
		$this->load->view('hasil/jspromapannewkakean',$data);
		
		//$this->session->sess_destroy();
	}
	
	function CetakPDF()
	{
		$buildid = $_GET['build_id'];
		$data['filepdf'] = $_GET['filepdf'];
		$data['kodeprospek'] = $_GET['kodeprospek'];
		//var_dump($buildid);
		//$this->load->model('ModSimulasiKakean');
		$this->load->model('mod_promapan');
		
		//$buildid = $this->input->post('buildid');
		
		//$ProTertanggung = $this->ModSimulasiKakean->selectProTertanggung($buildid);
		
		$data['hasilProTertanggung'] = $this->mod_promapan->selectProTertanggung($buildid);
		$data['hasilProPempol'] = $this->mod_promapan->selectProPempol($buildid);
		$data['hasilProAsuransiPokok'] = $this->mod_promapan->selectProAsuransiPokok($buildid);
		$data['hasilProAlokasiDana'] = $this->mod_promapan->selectProAlokasiDana($buildid);
		$data['hasilProDataRider'] = $this->mod_promapan->selectProDataRider($buildid);
		$data['hasilProTotalBiayaAll'] = $this->mod_promapan->selectProTotalBiayaAll($buildid);
		$data['hasilProTotalInvestasi1'] = $this->mod_promapan->selectProTotalInvestasi1($buildid);
		$data['hasilProTotalInvestasi2'] = $this->mod_promapan->selectProTotalInvestasi2($buildid);
		$data['hasilProTotalRingkasan'] = $this->mod_promapan->selectProTotalRingkasan($buildid);
		$data['hasilProTotalKomparasi'] = $this->mod_promapan->selectProTotalKomparasi($buildid);
		$this->load->view('promapan_create_pdf_kakean',$data);
		//$this->createPDF($data);
		
//		header('Content-Type: application/pdf');
//		echo file_get_contents('filename.pdf');
		
		/* try
		$ProTertanggung = array('pro','ProTertanggung');
		$ProPempol = array('pro','ProPempol');
		$ProAsuransiPokok = array('pro','ProAsuransiPokok');
		$ProAlokasiDana = array('pro','ProAlokasiDana');
		$ProDataRider = array('pro','ProDataRider');
		$ProTotalBiayaAll = array('pro','ProTotalBiayaAll');
		$ProTotalInvestasi1 = array('pro','ProTotalInvestasi1');
		$ProTotalInvestasi2 = array('pro','ProTotalInvestasi2');
		$ProTotalRingkasan = array('pro','ProTotalRingkasan');
		$ProTotalKomparasi = array('pro','ProTotalKomparasi');
		*/
		
		//$data = array();
		/*array_push($data, $ProTertanggung);
		array_push($data, $ProPempol);
		array_push($data, $ProAsuransiPokok);
		array_push($data, $ProAlokasiDana);
		array_push($data, $ProDataRider);
		array_push($data, $ProTotalBiayaAll);
		array_push($data, $ProTotalInvestasi1);
		array_push($data, $ProTotalInvestasi2);
		array_push($data, $ProTotalRingkasan);
		array_push($data, $ProTotalKomparasi);
		
		//var_dump($data);
		//die;
		foreach ($ProTotalKomparasi as $data) {
			//echo $data["BUILD_ID"][0].'<br><br>';
			//ar_dump($data);
			foreach ($data as $data1) {
				echo $data1.'<br><br>';
			}
		}
		die;
		*/
		/* tracing */
		/*
		echo '<br><br> ProTertanggung';
		var_dump($ProTertanggung);
		
		echo '<br><br> ProPempol';
		var_dump($ProPempol);
		
		echo '<br><br> ProAsuransiPokok';
		var_dump($ProAsuransiPokok);
		
		echo '<br><br> ProAlokasiDana';
		var_dump($ProAlokasiDana);
		
		echo '<br><br> ProDataRider';
		var_dump($ProDataRider);
		
		echo '<br><br> ProTotalBiayaAll';
		var_dump($ProTotalBiayaAll);
		
		echo '<br><br> ProTotalInvestasi1';
		var_dump($ProTotalInvestasi1);
		
		echo '<br><br> ProTotalInvestasi2';
		var_dump($ProTotalInvestasi2);
		
		echo '<br><br> ProTotalRingkasan';
		var_dump($ProTotalRingkasan);
		
		echo '<br><br> ProTotalKomparasi';
		var_dump($ProTotalKomparasi);
		
//		echo $ProTertanggung['NAMA'];
		
		die;
		$this->createPDF($ProTertanggung);
		
//		header('Content-Type: application/pdf');
//		echo file_get_contents('filename.pdf');
		
		// PAGE 1
//		$this->pdf->AddPage();
//		$pdf->output();
		*/
		
	}

	function createPDF($data){
		
		foreach ($hasilProTertanggung as $data1) {
				echo $data1.'<br><br>';
		}
		//echo $data['hasilProTertanggung']['NAMA'];
		die;
		$image1 = FCPATH.'assets/img/logo-js.png';
	    // Generate PDF by saying hello to the world
		
		// Page 1
		$this->pdf->AddPage();

		// HEADER
		$this->pdf->Image($image1, 170, 5);
		
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',14);
		$this->pdf->Cell(190,5,'PT ASURANSI JIWASRAYA (PERSERO)',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(190,5,'Jl. Ir. H. Juanda No. 34 Jakarta - 10120',0,0,'L');
		$this->pdf->ln(15);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(190,5,'JS PROMAPAN (Jiwasraya Proteksi Masa Depan Aman)','B',0,'L');
		$this->pdf->ln(6);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Nomor Proposal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,$data['hasil']['buildID'],0,0,'L');
		$this->pdf->Cell(10);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Tanggal Ilustrasi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.date('d/m/Y').'',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->ln(5);
		
		
		
		// CALON PEMEGANG POLIS
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'CALON PEMEGANG POLIS',1,0,'L', true);
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Nama Pemegang Polis',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasilProTertanggung']['NAMA'].' ',0,0,'L');
		$this->pdf->Cell(10);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Jenis Kelamin',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['jenis_kel'].' ',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Tanggal Lahir',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['tgl_lahir'].' / '.$data['hasil']['usianasabah'].' tahun',0,0,'L');
		$this->pdf->Cell(10);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Status Perokok',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['calonpemegangpolisperokok'].' ',0,0,'L');
		$this->pdf->ln(5);

		// CALON TERTANGGUNG
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'CALON TERTANGGUNG',1,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Nama Tertangggung',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['namalengkapcalontertanggung'].' ',0,0,'L');
		$this->pdf->Cell(10);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Jenis Kelamin',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['jeniskelamincalontertanggung'].' ',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Tanggal Lahir',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['tanggallahircalontertangggung'].' / '.$data['hasil']['usiacalontertanggung'].' tahun',0,0,'L');
		$this->pdf->Cell(10);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Status Perokok',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['calontertanggungperokok'].' ',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Hubungan dengan Pemegang Polis',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['hubungandenganpempol'].' ',0,0,'L');
		$this->pdf->ln(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(190,5,'','B',1,'L');
		$this->pdf->ln(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Cara Bayar',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['carabayar'].' ',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Uang Pertanggungan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,number_format($data['hasil']['uangpertanggungan'],0,'.',','),0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Mata Uang',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['matauang'].' ',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Premi Berkala',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,number_format($data['hasil']['premiberkala'],0,'.',','),0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Top Up Berkala',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,number_format($data['hasil']['topupberkala'],0,'.',','),0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Top Up Sekaligus',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,number_format($data['hasil']['topupsekaligus'],0,'.',','),'B',0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Total Premi yang dibayar',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,number_format($data['hasil']['totalpremiyangdibayar'],0,'.',','),0,0,'L');
		$this->pdf->SetFont('Arial','I',6);
		$this->pdf->Cell(10);
		$this->pdf->Cell(90,5,'Jiwasraya berhak melakukan pemeriksaan medis bagi SPAJ non medical secara acak.',0,0,'L');
		$this->pdf->ln(6);
		
		// ALOKSI DANA INVESTASI (%)
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ALOKASI DANA INVESTASI (%)',1,0,'L', true);
		if (($data['hasil']['nama_produk1'] != "") && ($data['hasil']['persentasealokasidana1'] != "") && ($data['hasil']['persentasealokasidana1'] != 0))
		{
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(95,5,''.$data['hasil']['alokasidana1'].' ','LRTB',0,'L');
		$this->pdf->Cell(95,5,''.$data['hasil']['persentasealokasidana1'].' %','LRTB',0,'L');
		}
		
		if (($data['hasil']['nama_produk2'] != "") && ($data['hasil']['persentasealokasidana2'] != "") && ($data['hasil']['persentasealokasidana2'] != 0))
		{
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(95,5,''.$data['hasil']['alokasidana2'].' ','LRTB',0,'L');
		$this->pdf->Cell(95,5,''.$data['hasil']['persentasealokasidana2'].' %','LRTB',0,'L');
		}
		
		$this->pdf->ln(5);
		
		// BIAYA ASURANSI
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'BIAYA ASURANSI',1,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(47.5,5,'NAMA ASURANSI',1,0,'C');
		$this->pdf->Cell(47.5,5,'SAMPAI USIA TERTANGGUNG',1,0,'C');
		$this->pdf->Cell(47.5,5,'UANG ASURANSI',1,0,'C');
		$this->pdf->Cell(47.5,5,'BIAYA ASURANSI PER BULAN',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(47.5,5,'Asuransi Dasar',1,0,'C');
		$this->pdf->Cell(47.5,5,'99',1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['uangpertanggungan'],0,'.',','),1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['biayaasuransiperbulanad'],0,'.',','),1,0,'C');
		
		$this->pdf->Output();
//		$pdf = new FPDF('P','mm','A4');
////		
//		
//		ob_end_clean(); //    the buffer and never prints or returns anything.
//		ob_start(); // it starts buffering
//		// PAGE 1
//		
////
////		// HEADER
////		$this->pdf->Image($image1, 170, 5);
////		$this->pdf->ln();
////		$this->pdf->SetFont('Arial','B',14);
////		$this->pdf->Cell(190,5,'PT ASURANSI JIWASRAYA (PERSERO)',0,0,'L');
////		$this->pdf->ln();
////		$this->pdf->SetFont('Arial','',10);
////		$this->pdf->Cell(190,5,'Jl. Ir. H. Juanda No. 34 Jakarta - 10120',0,0,'L');
////		$this->pdf->ln(15);
////		$this->pdf->SetFont('Arial','B',12);
////		$this->pdf->Cell(190,5,'JS Dwiguna Menaik','B',0,'L');
////		$this->pdf->ln(10);
////		$this->pdf->SetFont('Arial','B',10);
////		$this->pdf->SetFillColor(200,200,200);
////		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
////		$this->pdf->ln(10);
////		
////		//MANFAAT
//		$pdf->SetFillColor(255,250,205);
//		$pdf->SetFont('Arial','UB',8);
//		$pdf->SetTextColor(50,0,255);
//		$pdf->Cell(190,5,'A. DATA',0,0,'L');
//		$pdf->SetTextColor(0,0,0);
//		$pdf->ln(10);
//		$pdf->SetFont('Arial','',8);
//		$pdf->Cell(50,5,'Nama Calon Tertanggung','LT',0,'L', true);
//		$pdf->Cell(2,5,':','T',0,'L', true);
//		$pdf->SetFont('Arial','',8);
//		$pdf->Cell(32,5,$data['NAMA'],'RT',0,'L', true);
////		$this->pdf->ln(5);
////		$this->pdf->SetFont('Arial','',8);
////		$this->pdf->Cell(50,5,'Usia Calon','L',0,'L', true);
////		$this->pdf->Cell(2,5,':',0,0,'L', true);
////		$this->pdf->SetFont('Arial','',8);
////		$this->pdf->Cell(32,5,''.$data['hasil']['usiacalontertanggung'].' Tahun','R',0,'L', true);
////		$this->pdf->ln(5);
////		$this->pdf->SetFont('Arial','',8);
////		$this->pdf->Cell(50,5,'Masa Asuransi','L',0,'L', true);
////		$this->pdf->Cell(2,5,':',0,0,'L', true);
////		$this->pdf->SetFont('Arial','',8);
////		$this->pdf->Cell(32,5,''.$data['hasil']['masaasuransi'].' Tahun','R',0,'L', true);
////		$this->pdf->ln(5);
////		$this->pdf->SetFont('Arial','',8);
////		$this->pdf->Cell(50,5,'Uang Asuransi','L',0,'L', true);
////		$this->pdf->Cell(2,5,':',0,0,'L', true);
////		$this->pdf->SetFont('Arial','',8);
////		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','R',0,'L', true);
////		$this->pdf->ln(5);
////		$this->pdf->SetFont('Arial','',8);
////		$this->pdf->Cell(50,5,'Saat Mulai','LB',0,'L', true);
////		$this->pdf->Cell(2,5,':','B',0,'L', true);
////		$this->pdf->SetFont('Arial','',8);
////		$this->pdf->Cell(32,5,$data['hasil']['saatmulaiasuransi'],'RB',0,'L', true);
////		$this->pdf->ln(10);
////		
////		$this->pdf->SetFont('Arial','UB',8);
////		$this->pdf->SetTextColor(50,0,255);
////		$this->pdf->Cell(190,5,'B. BENEFIT',0,0,'L');
////		$this->pdf->SetTextColor(0,0,0);
////		$this->pdf->ln(10);
////		$this->pdf->SetFont('Arial','B',8);
////		$this->pdf->Cell(50,5,'1. KENAIKAN UANG ASURANSI SECARA PASTI',0,0,'L');
////		$this->pdf->ln(5);
////		$this->pdf->SetFont('Arial','',8);
////		$this->pdf->Cell(50,5,'Pembayaran Uang Asuransi sekaligus dilakukan pada tanggal '.$data['hasil']['saatpembayaranmanfaat'].' sebesar Rp.'.number_format(((1+(10*$data['hasil']['masaasuransi'])/100)*$data['hasil']['uangasuransipokok']),0,'.',',').' , jika Tertanggung masih hidup.',0,0,'L');
////		$this->pdf->ln(10);
////		$this->pdf->SetFont('Arial','B',8);
////		$this->pdf->Cell(50,5,'2. PROTEKSI KESEJAHTERAAN KELUARGA MENINGKAT',0,0,'L');
////		$this->pdf->ln(5);
////		$this->pdf->SetFont('Arial','',8);
////		$this->pdf->Cell(50,5,'Apabila Tertanggung Meninggal Dunia sebelum tanggal '.$data['hasil']['saatpembayaranmanfaat'].' dibayarkan Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').' ditambah kenaikan 10% Uang Asuransi setiap',0,0,'L');
////		$this->pdf->ln(5);
////		$this->pdf->SetFont('Arial','',8);
////		$this->pdf->Cell(50,5,'tahun, atau sebesar Rp. '.number_format(((10/100)*$data['hasil']['uangasuransipokok']),0,'.',',').' dikalikan Usia Pertanggungan.',0,0,'L');
////		$this->pdf->ln(5);
////		$this->pdf->ln(10);
////		
////		$this->pdf->SetFont('Arial','UB',8);
////		$this->pdf->SetTextColor(50,0,255);
////		$this->pdf->Cell(190,5,'C. PERHITUNGAN PREMI',0,0,'L');
////		$this->pdf->SetTextColor(0,0,0);
////		$this->pdf->ln(10);
////		$this->pdf->SetFont('Arial','',8);
////		$this->pdf->Cell(50,5,'1. Sebesar --> Rp. '.number_format($data['hasil']['tabelpremi5tahunpertama'],0,'.',',').' [Premi Tahunan untuk 5/lima tahun pertama].',0,0,'L');
////		$this->pdf->ln(5);
////		$this->pdf->SetFont('Arial','',8);
////		$this->pdf->Cell(50,5,'2. Sebesar --> Rp. '.number_format($data['hasil']['tabelpremi5tahunberikutnya'],0,'.',',').' [Premi Semesteran].',0,0,'L');
////		$this->pdf->ln(5);
////		$this->pdf->SetFont('Arial','',8);
////		$this->pdf->Cell(50,5,'3. Sebesar --> Rp. '.number_format($data['hasil']['tabelpremisekaligus'],0,'.',',').' [Apabila Premi dibayar SEKALIGUS].',0,0,'L');		
////		$this->pdf->ln(10);
////		
////		//$this->pdf->Image($image2, 15, 170);
////		$this->pdf->ln(70);
////		
////		// FOOTER
////		$this->pdf->Cell(190,5,'','B',0,'L');
////		$this->pdf->ln(10);
////
////		$this->pdf->SetFont('Arial','B',6);
////		$this->pdf->Cell(13,5,'Disajikan',0,0,'L');
////		$this->pdf->Cell(3);
////		$this->pdf->Cell(2,5,':',0,0,'L');
////		$this->pdf->SetFont('Arial','',6);
////		$this->pdf->Cell(3);
////		$this->pdf->Cell(29,5,''.$data['hasil']['namaagen'].' ',0,0,'L');
////		$this->pdf->SetFont('Arial','B',6);
////		$this->pdf->Cell(5);
////		$this->pdf->Cell(13,5,'Kode Agen',0,0,'L');
////		$this->pdf->Cell(3);
////		$this->pdf->Cell(2,5,':',0,0,'L');
////		$this->pdf->SetFont('Arial','',6);
////		$this->pdf->Cell(3);
////		$this->pdf->Cell(29,5,''.$data['hasil']['nomeragen'].' ',0,0,'L');
////		$this->pdf->Cell(5);
////		$this->pdf->SetFont('Arial','',6);
////		$this->pdf->Cell(40,5,'Tanda Tangan Agen','LTR',0,'C');
////		$this->pdf->Cell(40,5,'Tanda Tangan Calon Pemegang Polis','LTR',0,'C');
////		$this->pdf->ln();
////
////		$this->pdf->SetFont('Arial','B',6);
////		$this->pdf->Cell(13,5,'Tanggal',0,0,'L');
////		$this->pdf->Cell(3);
////		$this->pdf->Cell(2,5,':',0,0,'L');
////		$this->pdf->SetFont('Arial','',6);
////		$this->pdf->Cell(3);
////		$this->pdf->Cell(29,5,''.$data['hasil']['tanggalsekarang'].' ',0,0,'L');
////		$this->pdf->SetFont('Arial','B',6);
////		$this->pdf->Cell(5);
////		$this->pdf->Cell(13,5,'Kantor Cabang',0,0,'L');
////		$this->pdf->Cell(3);
////		$this->pdf->Cell(2,5,':',0,0,'L');
////		$this->pdf->SetFont('Arial','',6);
////		$this->pdf->Cell(3);
////		$this->pdf->Cell(29,5,''.$data['hasil']['kantorcabang'].' ',0,0,'L');
////		$this->pdf->Cell(5);
////		$this->pdf->SetFont('Arial','',6);
////		$this->pdf->Cell(40,5,'','LR',0,'C');
////		$this->pdf->Cell(40,5,'','LR',0,'C');
////		$this->pdf->ln();
////
////		$this->pdf->SetFont('Arial','B',6);
////		$this->pdf->Cell(13,5,'Build ID',0,0,'L');
////		$this->pdf->Cell(3);
////		$this->pdf->Cell(2,5,':',0,0,'L');
////		$this->pdf->SetFont('Arial','',6);
////		$this->pdf->Cell(3);
////		$this->pdf->Cell(29,5,time(),0,0,'L');
////		$this->pdf->SetFont('Arial','B',6);
////		$this->pdf->Cell(5);
////		$this->pdf->Cell(13,5,'',0,0,'L');
////		$this->pdf->Cell(3);
////		$this->pdf->Cell(2,5,'',0,0,'L');
////		$this->pdf->SetFont('Arial','',6);
////		$this->pdf->Cell(3);
////		$this->pdf->Cell(29,5,''.$data['hasil'][''].' ',0,0,'L');
////		$this->pdf->Cell(5);
////		$this->pdf->SetFont('Arial','',6);
////		$this->pdf->Cell(40,5,'','LBR',0,'C');
////		$this->pdf->Cell(40,5,'','LBR',0,'C');
////		
////		$this->pdf->ln(10);
////		$this->pdf->AliasNbPages('{totalPages}');
////		$this->pdf->Cell(190, 5, "Page " . $this->pdf->PageNo() . "/{totalPages}",' ', 0, 'R');
////		
////		// PAGE 2
////		$this->pdf->AddPage();
////		
////		// HEADER
////		$this->pdf->Image($image1, 170, 5);
////		$this->pdf->ln();
////		$this->pdf->SetFont('Arial','B',14);
////		$this->pdf->Cell(190,5,'PT ASURANSI JIWASRAYA (PERSERO)',0,0,'L');
////		$this->pdf->ln();
////		$this->pdf->SetFont('Arial','',10);
////		$this->pdf->Cell(190,5,'Jl. Ir. H. Juanda No. 34 Jakarta - 10120',0,0,'L');
////		$this->pdf->ln(15);
////		$this->pdf->SetFont('Arial','B',12);
////		$this->pdf->Cell(190,5,'JS Dwiguna Menaik','B',0,'L');
////		$this->pdf->ln(10);
////		$this->pdf->SetFont('Arial','B',10);
////		$this->pdf->SetFillColor(200,200,200);
////		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
////		$this->pdf->ln(10);
////		
////		// DISAJIKAN OLEH
////		$this->pdf->SetFont('Arial','B',8);
////		$this->pdf->Cell(190,5,'DISAJIKAN OLEH',0,0,'L');
////		$this->pdf->ln();
////		$this->pdf->SetFont('Arial','',8);
////		$this->pdf->Cell(50,5,'Nama Agen',0,0,'L');
////		$this->pdf->Cell(3);
////		$this->pdf->Cell(2,5,':',0,0,'L');
////		$this->pdf->Cell(3);
////		$this->pdf->SetFont('Arial','',8);
////		$this->pdf->Cell(32,5,''.$data['hasil']['namaagen'].' ',0,0,'L');
////		$this->pdf->ln();
////		$this->pdf->SetFont('Arial','',8);
////		$this->pdf->Cell(50,5,'Nomor Agen',0,0,'L');
////		$this->pdf->Cell(3);
////		$this->pdf->Cell(2,5,':',0,0,'L');
////		$this->pdf->Cell(3);
////		$this->pdf->SetFont('Arial','',8);
////		$this->pdf->Cell(32,5,''.$data['hasil']['nomeragen'].' ',0,0,'L');
////		$this->pdf->ln();
////		$this->pdf->SetFont('Arial','',8);
////		$this->pdf->Cell(50,5,'Tanggal Proposal',0,0,'L');
////		$this->pdf->Cell(3);
////		$this->pdf->Cell(2,5,':',0,0,'L');
////		$this->pdf->Cell(3);
////		$this->pdf->SetFont('Arial','',8);
////		$this->pdf->Cell(32,5,''.$data['hasil']['tanggalsekarang'].' ',0,0,'L');
////		$this->pdf->ln(20);
////
////		$this->pdf->SetFont('Arial','B',8);
////		$this->pdf->Cell(95,5,'TANDA TANGAN AGEN',0,0,'L');
////		$this->pdf->Cell(95,5,'TANDA TANGAN CALON PEMEGANG POLIS',0,0,'L');
////		$this->pdf->ln(50);
////		$this->pdf->SetFont('Arial','',8);
////		$this->pdf->Cell(95,5,''.$data['hasil']['namaagen'].' ',0,0,'L');
////		$this->pdf->Cell(95,5,''.$data['hasil']['nama'].' ',0,0,'L');
////		$this->pdf->ln();
////		$this->pdf->SetFont('Arial','I',6);
////		$this->pdf->Cell(95,5,'Saya telah menjelaskan Ilustrasi ini kepada Calon Pemegang Polis',0,0,'L');
////		$this->pdf->Cell(95,5,'Saya telah membaca, memahami dan mengerti resiko dan isi dari ilustrasi ini.',0,0,'L');
////		$this->pdf->ln(90);
////		
////		// FOOTER
////		$this->pdf->Cell(190,5,'','B',0,'L');
////		$this->pdf->ln(10);
////
////		$this->pdf->SetFont('Arial','B',6);
////		$this->pdf->Cell(13,5,'Disajikan',0,0,'L');
////		$this->pdf->Cell(3);
////		$this->pdf->Cell(2,5,':',0,0,'L');
////		$this->pdf->SetFont('Arial','',6);
////		$this->pdf->Cell(3);
////		$this->pdf->Cell(29,5,''.$data['hasil']['namaagen'].' ',0,0,'L');
////		$this->pdf->SetFont('Arial','B',6);
////		$this->pdf->Cell(5);
////		$this->pdf->Cell(13,5,'Kode Agen',0,0,'L');
////		$this->pdf->Cell(3);
////		$this->pdf->Cell(2,5,':',0,0,'L');
////		$this->pdf->SetFont('Arial','',6);
////		$this->pdf->Cell(3);
////		$this->pdf->Cell(29,5,''.$data['hasil']['nomeragen'].' ',0,0,'L');
////		$this->pdf->Cell(5);
////		$this->pdf->SetFont('Arial','',6);
////		$this->pdf->Cell(40,5,'Tanda Tangan Agen','LTR',0,'C');
////		$this->pdf->Cell(40,5,'Tanda Tangan Calon Pemegang Polis','LTR',0,'C');
////		$this->pdf->ln();
////
////		$this->pdf->SetFont('Arial','B',6);
////		$this->pdf->Cell(13,5,'Tanggal',0,0,'L');
////		$this->pdf->Cell(3);
////		$this->pdf->Cell(2,5,':',0,0,'L');
////		$this->pdf->SetFont('Arial','',6);
////		$this->pdf->Cell(3);
////		$this->pdf->Cell(29,5,''.$data['hasil']['tanggalsekarang'].' ',0,0,'L');
////		$this->pdf->SetFont('Arial','B',6);
////		$this->pdf->Cell(5);
////		$this->pdf->Cell(13,5,'Kantor Cabang',0,0,'L');
////		$this->pdf->Cell(3);
////		$this->pdf->Cell(2,5,':',0,0,'L');
////		$this->pdf->SetFont('Arial','',6);
////		$this->pdf->Cell(3);
////		$this->pdf->Cell(29,5,''.$data['hasil']['kantorcabang'].' ',0,0,'L');
////		$this->pdf->Cell(5);
////		$this->pdf->SetFont('Arial','',6);
////		$this->pdf->Cell(40,5,'','LR',0,'C');
////		$this->pdf->Cell(40,5,'','LR',0,'C');
////		$this->pdf->ln();
////
////		$this->pdf->SetFont('Arial','B',6);
////		$this->pdf->Cell(13,5,'Build ID',0,0,'L');
////		$this->pdf->Cell(3);
////		$this->pdf->Cell(2,5,':',0,0,'L');
////		$this->pdf->SetFont('Arial','',6);
////		$this->pdf->Cell(3);
////		$this->pdf->Cell(29,5,time(),0,0,'L');
////		$this->pdf->SetFont('Arial','B',6);
////		$this->pdf->Cell(5);
////		$this->pdf->Cell(13,5,'',0,0,'L');
////		$this->pdf->Cell(3);
////		$this->pdf->Cell(2,5,'',0,0,'L');
////		$this->pdf->SetFont('Arial','',6);
////		$this->pdf->Cell(3);
////		$this->pdf->Cell(29,5,''.$data['hasil'][''].' ',0,0,'L');
////		$this->pdf->Cell(5);
////		$this->pdf->SetFont('Arial','',6);
////		$this->pdf->Cell(40,5,'','LBR',0,'C');
////		$this->pdf->Cell(40,5,'','LBR',0,'C');
////		
////		$this->pdf->ln(10);
////		$this->pdf->AliasNbPages('{totalPages}');
////		$this->pdf->Cell(190, 5, "Page " . $this->pdf->PageNo() . "/{totalPages}",' ', 0, 'R');
////		
////	    $this->pdf->Output('./files/pdf/'.$namaFile.'.pdf','F');
		//$pdf->Output();
//		ob_end_flush();
	  
	}	

}	