<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");
	
	error_reporting(0);

class Jsdwigunamenaik extends CI_Controller{

	function hitungpremisekaligusdwigunamenaik(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		$result = $this->ModSimulasi->getPremiSekaligusDwigunaMenaik($masaasuransi, $usiasekarang);
		
		$hasil = $result['TARIF'] * ($uangasuransipokok / 1000);
		
		echo round($hasil);
	}
	
	function hitungpremi5tahunpertamadwigunamenaik(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		$result = $this->ModSimulasi->getPremi5TahunPertamaDwigunaMenaik($masaasuransi, $usiasekarang);
		
		$hasil = ($result['TARIF'] * ($uangasuransipokok / 1000)) * 1.05;
		
		echo round($hasil);
	}
	
	function hitungpremi5tahunberikutnyadwigunamenaik(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		$result = $this->ModSimulasi->getPremi5TahunBerikutnyaDwigunaMenaik($masaasuransi, $usiasekarang);
		
		$hasil = ($result['TARIF'] * ($uangasuransipokok / 1000)) * 1.05 * 0.52; 
		
		echo round($hasil);
	}
	
	function hitungpremikuartalan(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		$result = $this->ModSimulasi->getPremi5TahunBerikutnyaDwigunaMenaik($masaasuransi, $usiasekarang);
		
		$hasil = ($result['TARIF'] * ($uangasuransipokok / 1000)) * 1.05 * 0.27; 
		
		echo round($hasil);
	}
	
	function hitungpremibulanan(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		$result = $this->ModSimulasi->getPremi5TahunBerikutnyaDwigunaMenaik($masaasuransi, $usiasekarang);
		
		$hasil = ($result['TARIF'] * ($uangasuransipokok / 1000)) * 1.05 * 0.095; 
		
		echo round($hasil);
	}
	
	//RIDER 
	
	function hitungjshcpdwigunamenaik(){
		$this->load->model('ModSimulasi');
		
		$uangasuransihcpjsdwigunamenaik = $this->input->post("uangasuransihcpjsdwigunamenaik");
		
		$jeniskelamincalontertanggung = $this->input->post("jeniskelamincalontertanggung");
		
		if ($jeniskelamincalontertanggung == 'Laki-Laki')
		{
			$jeniskelamin = 'L';
		}
		else if ($jeniskelamincalontertanggung == 'Perempuan')
		{
			$jeniskelamin = 'P';
		}
		
		$usiasekarang = $this->input->post(usiasekarang);
		
		$result = $this->ModSimulasi->getBiayaAsuransiPerBulanHCPDwigunaMenaik($usiasekarang, $uangasuransihcpjsdwigunamenaik, $jeniskelamin);
		
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
		
		$hasil = $result['TARIF'] * $faktorkali;
		
		echo round($hasil);
		
	}
	
	function hitungjshcpbdwigunamenaik() {
		$this->load->model('ModSimulasi');
		
		$uangasuransihcpbjsdwigunamenaik = $this->input->post("uangasuransihcpbjsdwigunamenaik");
		
		$jeniskelamincalontertanggung = $this->input->post("jeniskelamincalontertanggung");
		
		if ($jeniskelamincalontertanggung == 'Laki-Laki')
		{
			$jeniskelamin = 'L';
		}
		else if ($jeniskelamincalontertanggung == 'Perempuan')
		{
			$jeniskelamin = 'P';
		}
		
		$usiasekarang = $this->input->post(usiasekarang);
		
		$result = $this->ModSimulasi->getBiayaAsuransiPerBulanHCPBedahDwigunaMenaik($usiasekarang, $jeniskelamin, $uangasuransihcpbjsdwigunamenaik);
		
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
		
		$hasil = $result['TARIF'] * $faktorkali;
		
		echo round($hasil);
	}
	
	function hitungjstpddwigunamenaik() {
		$this->load->model('ModSimulasi');
		
		$usiasekarang = $this->input->post("usiasekarang");
		
		$uangasuransijstpdjsdwigunamenaik = $this->input->post("uangasuransijstpdjsdwigunamenaik");
		
		$jeniskelamincalontertanggung = $this->input->post("jeniskelamincalontertanggung");
		
		if ($jeniskelamincalontertanggung == 'Laki-Laki')
		{
			$jeniskelamin = 'MALE';
		}
		else if ($jeniskelamincalontertanggung == 'Perempuan')
		{
			$jeniskelamin = 'FEMALE';
		}
		
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
			
		$result = $this->ModSimulasi->getBiayaAsuransiPerBulanTPD($usiasekarang);
		
		$hasil = (($result[$jeniskelamin]/1000) * $uangasuransijstpdjsdwigunamenaik) * $faktorkali;
		
		echo round($hasil);
		
	}
	
	function hitungjswpdwigunamenaik() {
		$this->load->model('ModSimulasi');
		
		$usiasekarang = $this->input->post("usiasekarang");
		
		$masaasuransi = $this->input->post("masaasuransi");
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		
		$result = $this->ModSimulasi->getPremi5TahunPertamaDwigunaMenaik($masaasuransi, $usiasekarang);
		
		//$result2 = $this->ModSimulasi->getBiayaAsuransiPerBulanSPD($usiasekarang);
		
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
		
		$result2 = $this->ModSimulasi->getPremiTambahanWPDwigunaMenaik($masaasuransi, $usiasekarang, $kdtarif, $hasiltemp, $faktorkali);
		
		echo round($result2['HASIL']);
		
	}
	
	function hitungjsci53dwigunamenaik() {
		$this->load->model('ModSimulasi');
		
		$usiasekarang = $this->input->post("usiasekarang");
		
		$uangasuransici53jsdwigunamenaik = $this->input->post("uangasuransici53jsdwigunamenaik");
		
		$jeniskelamincalontertanggung = $this->input->post("jeniskelamincalontertanggung");
		
		if ($jeniskelamincalontertanggung == 'Laki-Laki')
		{
			$jeniskelamin = 'MALE';
		}
		else if ($jeniskelamincalontertanggung == 'Perempuan')
		{
			$jeniskelamin = 'FEMALE';
		}
		
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
		
		$result = $this->ModSimulasi->getBiayaAsuransiPerBulanCI53($usiasekarang);
		
		$hasil = (($result[$jeniskelamin]/1000) * $uangasuransici53jsdwigunamenaik) * $faktorkali;
		
		echo round($hasil);
	}
	
	function hitungjsaddbdwigunamenaik() {
		$this->load->model('ModSimulasi');
		
		$usiasekarang = $this->input->post("usiasekarang");
		
		$uangasuransijsaddbjsdwigunamenaik = $this->input->post("uangasuransijsaddbjsdwigunamenaik");
		
		$jeniskelamincalontertanggung = $this->input->post("jeniskelamincalontertanggung");
		
		if ($jeniskelamincalontertanggung == 'Laki-Laki')
		{
			$jeniskelamin = 'MALE';
		}
		else if ($jeniskelamincalontertanggung == 'Perempuan')
		{
			$jeniskelamin = 'FEMALE';
		}
		
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
		
		$result = $this->ModSimulasi->getBiayaAsuransiPerBulanADDB($usiasekarang);
		
		$hasil = (($result[$jeniskelamin]/1000) * $uangasuransijsaddbjsdwigunamenaik) * $faktorkali;
		
		echo round($hasil);
	}
	
	function hitungjsspddwigunamenaik() {
		$this->load->model('ModSimulasi');
		
		$usiasekarang = $this->input->post("usiasekarang");
		
		$masaasuransi = $this->input->post("masaasuransi");
		
		$uangasuransipokok = $this->input->post(uangasuransipokok);
		
		$result = $this->ModSimulasi->getPremi5TahunPertamaDwigunaMenaik($masaasuransi, $usiasekarang);
		
		$jeniskelamincalontertanggung = $this->input->post("jeniskelamincalontertanggung");
		
		if ($jeniskelamincalontertanggung == 'Laki-Laki')
		{
			$jeniskelamin = 'MALE';
		}
		else if ($jeniskelamincalontertanggung == 'Perempuan')
		{
			$jeniskelamin = 'FEMALE';
		}
		
		$result2 = $this->ModSimulasi->getBiayaAsuransiPerBulanSPD($usiasekarang);
		
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
		
		$hasil = (($uangasuransipokok/1000 * $result['TARIF']) * ($result2[$jeniskelamin]/100) *$faktorkali);
		
		echo round($hasil);
	}
	
	function hitungjssptpddwigunamenaik() {
		$this->load->model('ModSimulasi');
		
		$usiasekarang = $this->input->post("usiasekarang");
		
		$masaasuransi = $this->input->post("masaasuransi");
		
		$uangasuransipokok = $this->input->post(uangasuransipokok);
		
		$result = $this->ModSimulasi->getPremi5TahunPertamaDwigunaMenaik($masaasuransi, $usiasekarang);
		
		$jeniskelamincalontertanggung = $this->input->post("jeniskelamincalontertanggung");
		
		if ($jeniskelamincalontertanggung == 'Laki-Laki')
		{
			$jeniskelamin = 'MALE';
		}
		else if ($jeniskelamincalontertanggung == 'Perempuan')
		{
			$jeniskelamin = 'FEMALE';
		}
		
		$result2 = $this->ModSimulasi->getBiayaAsuransiPerBulanSPTPD($usiasekarang);
		
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
		
		$hasil = (($uangasuransipokok/1000 * $result['TARIF']) * ($result2[$jeniskelamin]/100) *$faktorkali);
		
		echo round($hasil);
	}
	
	function hitungjstermdwigunamenaik() {
		$this->load->model('ModSimulasi');
		
		$usiasekarang = $this->input->post("usiasekarang");
		
		$uangasuransipokok = $this->input->post(uangasuransipokok);
		
		$uangasuransitermjsdwigunamenaik = $this->input->post(uangasuransitermjsdwigunamenaik);
		
		$calonpemegangpolisperokokjsdwigunamenaik = $this->input->post("calonpemegangpolisperokokjsdwigunamenaik");
		
		if ($calonpemegangpolisperokokjsdwigunamenaik == 'Tidak')
		{
			$statusperokok = 'SMOKER';
			$faktorpengali = 3;
		}
		else if ($calonpemegangpolisperokokjsdwigunamenaik == 'Ya')
		{
			$statusperokok = 'NONSMOKER';
			$faktorpengali = 2;
		}
		
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
		
		$result = $this->ModSimulasi->getBiayaAsuransiPerBulanTerm($usiasekarang, $statusperokok, $uangasuransitermjsdwigunamenaik);
		
		//$hasil = (($result[$statusperokok]/1000) * $uangasuransitermjsdwigunamenaik) * $faktorkali;
		
		if ($uangasuransitermjsdwigunamenaik > ($uangasuransipokok * $faktorpengali))
		{
				$hasil = 'TIDAK BISA';
		}
		else
		{
				$hasil = ($result['TERM']) / 1000 * $faktorkali;
		}
		
		echo round($hasil);
	}
	
	function hitung(){
	    //echo $html;
		//echo base_url().'files/pdf';
		$idNasabah = $this->ModSimulasi->GetIdNasabah();
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
		
		//$nasabahID = $this->ModSimulasi->insertNasabah($data['nasabah']);
		
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
		
		$dataBuildID = $this->ModSimulasi->getBuildID();
		$data['hasil']['buildID'] = $dataBuildID['BUILDID'];

		
		$filePdf = 'SIMULASI-'.strtoupper($this->input->post('namanasabah')).'-'.strtoupper($this->input->post('modul')).'-'.$data['hasil']['buildID'];
		
		$data['hitung'] = array(
			'id_nasabah' => $nasabahID,
			'id_agen' => $this->input->post('nomeragen'),
			'file_pdf' => $filePdf.'.pdf',
			'id_produk' => $this->input->post('idproduk'),
			'session_id' => $this->input->post('sessionnasabah')
		);
		
		//$this->ModSimulasi->insertNasabah($data['hitung']);
		
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
			'namalengkapcalontertanggung' => $this->input->post('namalengkapcalontertanggung'),
			'jeniskelamincalontertanggung' => $this->input->post('jeniskelamincalontertanggung'),
			'tanggallahircalontertangggung' => $this->input->post('tanggallahircalontertangggung'),
			'uangasuransipokok' => $this->input->post('uangasuransipokok'),
			'masaasuransi' => $this->input->post('masaasuransi'),
			'saatmulaiasuransi' => $this->input->post('saatmulaiasuransi'),
			'tabelpremisekaligus' => $this->input->post('tabelpremisekaligus'),
			'tabelpremi5tahunpertama' => $this->input->post('tabelpremi5tahunpertama'),
			'tabelpremi5tahunberikutnya' => $this->input->post('tabelpremi5tahunberikutnya'),
			
  		);
		
		
		$this->session->set_userdata($newdata);
		
		//$html = $this->load->view('pdf/optima7',$data,true);
		//$this->load->view('hasil/optima7');*/
	}

	function hasil(){
		
		$this->load->model('ModSimulasi');
		
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
			$data['hasil']['jenis_kel'] = 'Laki-laki';
		}
		else if ($jeniskel == 'F')
		{
			$data['hasil']['jenis_kel'] = 'Perempuan';
		}
		
		$data['hasil']['namalengkapcalontertanggung'] = $this->session->userdata('namalengkapcalontertanggung');
		$data['hasil']['jeniskelamincalontertanggung'] = $this->session->userdata('jeniskelamincalontertanggung');
		
		$data['hasil']['uangasuransipokok'] = $this->session->userdata('uangasuransipokok');
		$data['hasil']['masaasuransi'] = $this->session->userdata('masaasuransi');
		
		$tanggalPembayaranManfaat= date("d", strtotime($this->session->userdata('saatmulaiasuransi')));
		$bulanPembayaranManfaat = $bulan[date("n", strtotime($this->session->userdata('saatmulaiasuransi')))];
		$tahunPembayaranManfaat = date("Y", strtotime($this->session->userdata('saatmulaiasuransi')))+$data['hasil']['masaasuransi'];
		$data['hasil']['saatpembayaranmanfaat'] = $tanggalPembayaranManfaat.' '.$bulanPembayaranManfaat.' '.$tahunPembayaranManfaat;
		
		$data['hasil']['filepdf'] = $this->session->userdata('filepdf');
		$data['hasil']['id_nasabah'] = $this->session->userdata('id_nasabah');
		$data['hasil']['id_agen']	 = $this->session->userdata('id_agen');
		//$data['hasil']['file_pdf']	 = $filePdf.'.pdf',
		$data['hasil']['id_produk']  = $this->session->userdata('id_produk');
		
		$data['hasil']['tabelpremisekaligus']  = $this->session->userdata('tabelpremisekaligus');
		$data['hasil']['tabelpremi5tahunpertama']  = $this->session->userdata('tabelpremi5tahunpertama');
		$data['hasil']['tabelpremi5tahunberikutnya']  = $this->session->userdata('tabelpremi5tahunberikutnya');
		
		//$data['hasil']['filepdf'] = $filepdf;
		$data['hasil']['nama'] = $this->session->userdata('nama');
		$data['hasil']['namaagen'] = strtoupper(str_replace("-"," ",$this->session->userdata('namaagen')));
		$kodeKantor = $DataAgen['KDKANTOR'];
		$dataKantor = $this->ModSimulasi->cariDataKantor($kodeKantor);
		$data['hasil']['kantorcabang'] = $dataKantor['NAMAKANTOR'];
		$data['hasil']['nomeragen'] = $this->session->userdata('nomeragen');
		
		$NoProspek = $this->session->userdata('kodeprospek');
		//$NoProspek = 'LC151022000001';
		$DataAgen = $this->ModSimulasi->GetDataAgen($NoProspek);
		$idAgen = $DataAgen['NOAGEN'];
		
		$api = json_decode(file_get_contents(C_URL_API_JAIM."/agen.php?r=1&p=$idAgen"), true);
		
		//echo $api['NAMALENGKAP'];
		//echo "\n";
		//echo $api['NAMAKANTOR'];
		
		$data['hasil']['namaagen'] = $api['NAMALENGKAP'];
		$data['hasil']['nomeragen'] = $idAgen;
		$data['hasil']['kantorcabang'] = $api['NAMAKANTOR'];
		
		$idHit = $this->ModSimulasi->GetIdHit();
		$data['idHit'] = $idHit['ID_HIT'] + 1;
		
		$dataBuildID = $this->ModSimulasi->getBuildID();
		$data['hasil']['buildID'] = $dataBuildID['BUILDID'];

		$data['hitung'] = array(
			'ID_HIT' => $data['idHit'],
			'BUILD_ID' => $data['hasil']['buildID'],
			'ID_AGEN' => $idAgen,
			'FILE_PDF' => $this->session->userdata('filepdf').'.pdf',
			'ID_PRODUK' => $this->session->userdata('id_produk'),
			'SESSION_ID' => $this->session->userdata('session_id'),
			'NO_PROSPEK' => $NoProspek,
			'CARA_BAYAR' => 'Sekaligus, Tahunan',
			'JUMLAH_PREMI' => $data['hasil']['uangasuransipokok']
		);
		
		$this->ModSimulasi->insertSimulasi($data['hitung']);
		
		$data['hasil']['build_id'] = $data['hitung']['BUILD_ID'];
				
		$filePdf = $this->session->userdata('filepdf');
		
		$this->createPDF($filePdf,$data);
		
		$this->load->view('hasil/jsdwigunamenaik',$data);
		
		//$this->session->sess_destroy();
	}

	function createPDF($namaFile,$data){
		$image1 = FCPATH.'assets/img/logo-js.png';
		$image2 = FCPATH.'assets/img/jsdwigunamenaik.jpg';
	    // Generate PDF by saying hello to the world
		
		// PAGE 1
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
		$this->pdf->Cell(190,5,'JS Dwiguna Menaik','B',0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(10);
		
		//MANFAAT
		$this->pdf->SetFillColor(255,250,205);
		$this->pdf->SetFont('Arial','UB',8);
		$this->pdf->SetTextColor(50,0,255);
		$this->pdf->Cell(190,5,'A. DATA',0,0,'L');
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Nama Calon Tertanggung','LT',0,'L', true);
		$this->pdf->Cell(2,5,':','T',0,'L', true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,''.$data['hasil']['namalengkapcalontertanggung'].' ','RT',0,'L', true);
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Usia Calon','L',0,'L', true);
		$this->pdf->Cell(2,5,':',0,0,'L', true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,''.$data['hasil']['usiacalontertanggung'].' Tahun','R',0,'L', true);
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Masa Asuransi','L',0,'L', true);
		$this->pdf->Cell(2,5,':',0,0,'L', true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,''.$data['hasil']['masaasuransi'].' Tahun','R',0,'L', true);
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Uang Asuransi','L',0,'L', true);
		$this->pdf->Cell(2,5,':',0,0,'L', true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','R',0,'L', true);
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Saat Mulai','LB',0,'L', true);
		$this->pdf->Cell(2,5,':','B',0,'L', true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,$data['hasil']['saatmulaiasuransi'],'RB',0,'L', true);
		$this->pdf->ln(10);
		
		$this->pdf->SetFont('Arial','UB',8);
		$this->pdf->SetTextColor(50,0,255);
		$this->pdf->Cell(190,5,'B. BENEFIT',0,0,'L');
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'1. KENAIKAN UANG ASURANSI SECARA PASTI',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Pembayaran Uang Asuransi sekaligus dilakukan pada tanggal '.$data['hasil']['saatpembayaranmanfaat'].' sebesar Rp.'.number_format(((1+(10*$data['hasil']['masaasuransi'])/100)*$data['hasil']['uangasuransipokok']),0,'.',',').' , jika Tertanggung masih hidup.',0,0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'2. PROTEKSI KESEJAHTERAAN KELUARGA MENINGKAT',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Apabila Tertanggung Meninggal Dunia sebelum tanggal '.$data['hasil']['saatpembayaranmanfaat'].' dibayarkan Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').' ditambah kenaikan 10% Uang Asuransi setiap',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'tahun, atau sebesar Rp. '.number_format(((10/100)*$data['hasil']['uangasuransipokok']),0,'.',',').' dikalikan Usia Pertanggungan.',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->ln(10);
		
		$this->pdf->SetFont('Arial','UB',8);
		$this->pdf->SetTextColor(50,0,255);
		$this->pdf->Cell(190,5,'C. PERHITUNGAN PREMI',0,0,'L');
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'1. Sebesar --> Rp. '.number_format($data['hasil']['tabelpremi5tahunpertama'],0,'.',',').' [Premi Tahunan untuk 5/lima tahun pertama].',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'2. Sebesar --> Rp. '.number_format($data['hasil']['tabelpremi5tahunberikutnya'],0,'.',',').' [Premi Semesteran].',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'3. Sebesar --> Rp. '.number_format($data['hasil']['tabelpremisekaligus'],0,'.',',').' [Apabila Premi dibayar SEKALIGUS].',0,0,'L');		
		$this->pdf->ln(10);
		
		$this->pdf->Image($image2, 15, 170);
		$this->pdf->ln(70);
		
		// FOOTER
		$this->pdf->Cell(190,5,'','B',0,'L');
		$this->pdf->ln(10);

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(13,5,'Disajikan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,5,''.$data['hasil']['namaagen'].' ',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(13,5,'Kode Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,5,''.$data['hasil']['nomeragen'].' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,5,'Tanda Tangan Agen','LTR',0,'C');
		$this->pdf->Cell(40,5,'Tanda Tangan Calon Pemegang Polis','LTR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(13,5,'Tanggal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,5,''.$data['hasil']['tanggalsekarang'].' ',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(13,5,'Kantor Cabang',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,5,''.$data['hasil']['kantorcabang'].' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,5,'','LR',0,'C');
		$this->pdf->Cell(40,5,'','LR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(13,5,'Build ID',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,5,$data['hasil']['buildID'],0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(13,5,'',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,'',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,5,''.$data['hasil'][''].' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,5,'','LBR',0,'C');
		$this->pdf->Cell(40,5,'','LBR',0,'C');
		
		$this->pdf->ln(10);
		$this->pdf->AliasNbPages('{totalPages}');
		$this->pdf->Cell(190, 5, "Page " . $this->pdf->PageNo() . "/{totalPages}",' ', 0, 'R');
		
		// PAGE 2
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
		$this->pdf->Cell(190,5,'JS Dwiguna Menaik','B',0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(10);
		
		// DISAJIKAN OLEH
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(190,5,'DISAJIKAN OLEH',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Nama Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,''.$data['hasil']['namaagen'].' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Nomor Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,''.$data['hasil']['nomeragen'].' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Tanggal Proposal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,''.$data['hasil']['tanggalsekarang'].' ',0,0,'L');
		$this->pdf->ln(20);

		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(95,5,'TANDA TANGAN AGEN',0,0,'L');
		$this->pdf->Cell(95,5,'TANDA TANGAN CALON PEMEGANG POLIS',0,0,'L');
		$this->pdf->ln(50);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(95,5,''.$data['hasil']['namaagen'].' ',0,0,'L');
		$this->pdf->Cell(95,5,''.$data['hasil']['nama'].' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','I',6);
		$this->pdf->Cell(95,5,'Saya telah menjelaskan Ilustrasi ini kepada Calon Pemegang Polis',0,0,'L');
		$this->pdf->Cell(95,5,'Saya telah membaca, memahami dan mengerti resiko dan isi dari ilustrasi ini.',0,0,'L');
		$this->pdf->ln(90);
		
		// FOOTER
		$this->pdf->Cell(190,5,'','B',0,'L');
		$this->pdf->ln(10);

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(13,5,'Disajikan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,5,''.$data['hasil']['namaagen'].' ',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(13,5,'Kode Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,5,''.$data['hasil']['nomeragen'].' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,5,'Tanda Tangan Agen','LTR',0,'C');
		$this->pdf->Cell(40,5,'Tanda Tangan Calon Pemegang Polis','LTR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(13,5,'Tanggal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,5,''.$data['hasil']['tanggalsekarang'].' ',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(13,5,'Kantor Cabang',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,5,''.$data['hasil']['kantorcabang'].' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,5,'','LR',0,'C');
		$this->pdf->Cell(40,5,'','LR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(13,5,'Build ID',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,5,$data['hasil']['buildID'],0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(13,5,'',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,'',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,5,''.$data['hasil'][''].' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,5,'','LBR',0,'C');
		$this->pdf->Cell(40,5,'','LBR',0,'C');
		
		$this->pdf->ln(10);
		$this->pdf->AliasNbPages('{totalPages}');
		$this->pdf->Cell(190, 5, "Page " . $this->pdf->PageNo() . "/{totalPages}",' ', 0, 'R');
		
	    $this->pdf->Output('./files/pdf/'.$namaFile.'.pdf','F');
	  
	}	

}	