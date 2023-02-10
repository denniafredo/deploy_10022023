<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");
	
	error_reporting(0);

class Jl3new extends CI_Controller{

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
			$jeniskelamin = 'P';
		}
		else if ($jeniskelamincalontertanggung == 'Perempuan')
		{
			$jeniskelamin = 'L';
		}
		
		$usiasekarang = $this->input->post(usiasekarang);
		
		$result = $this->ModSimulasi->getBiayaAsuransiPerBulanHCPBedahDwigunaMenaik($usiasekarang, $jeniskelamin, $uangasuransihcpjsdwigunamenaik);
		
		$carabayarjsdwigunamenaik = $this->input->post("carabayarjsdwigunamenaik");
		
		if ($carabayarjsdwigunamenaik == 'Tahunan')
		{
			$faktorkali = 1;
		}
		else if ($carabayarjsdwigunamenaik == 'Semesteran')
		{
			$faktorkali = 1/2;
		}
		else if ($carabayarjsdwigunamenaik == 'Kuartalan')
		{
			$faktorkali = 1/4;
		}
		else if ($carabayarjsdwigunamenaik == 'Bulanan')
		{
			$faktorkali = 1/12;
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
			$faktorkali = 1/2;
		}
		else if ($carabayarjsdwigunamenaik == 'Kuartalan')
		{
			$faktorkali = 1/4;
		}
		else if ($carabayarjsdwigunamenaik == 'Bulanan')
		{
			$faktorkali = 1/12;
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
			$faktorkali = 1/2;
		}
		else if ($carabayarjsdwigunamenaik == 'Kuartalan')
		{
			$faktorkali = 1/4;
		}
		else if ($carabayarjsdwigunamenaik == 'Bulanan')
		{
			$faktorkali = 1/12;
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
			$faktorkali = 1/2;
		}
		else if ($carabayarjsdwigunamenaik == 'Kuartalan')
		{
			$faktorkali = 1/4;
		}
		else if ($carabayarjsdwigunamenaik == 'Bulanan')
		{
			$faktorkali = 1/12;
		}
		else if ($carabayarjsdwigunamenaik == 'Sekaligus')
		{
			$faktorkali = 0;
		}
		
		$hasiltemp = ($uangasuransipokok/1000);
		
		$result2 = $this->ModSimulasi->getPremiTambahanWPDwigunaMenaik($masaasuransi, $usiasekarang, $kdtarif, $hasiltemp, $faktorkali);
		
		echo round($result2['HASIL'] /100);
		
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
			$faktorkali = 1/2;
		}
		else if ($carabayarjsdwigunamenaik == 'Kuartalan')
		{
			$faktorkali = 1/4;
		}
		else if ($carabayarjsdwigunamenaik == 'Bulanan')
		{
			$faktorkali = 1/12;
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
			$faktorkali = 1/2;
		}
		else if ($carabayarjsdwigunamenaik == 'Kuartalan')
		{
			$faktorkali = 1/4;
		}
		else if ($carabayarjsdwigunamenaik == 'Bulanan')
		{
			$faktorkali = 1/12;
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
			$faktorkali = 1/2;
		}
		else if ($carabayarjsdwigunamenaik == 'Kuartalan')
		{
			$faktorkali = 1/4;
		}
		else if ($carabayarjsdwigunamenaik == 'Bulanan')
		{
			$faktorkali = 1/12;
		}
		else if ($carabayarjsdwigunamenaik == 'Sekaligus')
		{
			$faktorkali = 0;
		}
		
		$hasil = (($uangasuransipokok/1000) * ($result2[$jeniskelamin]) * $faktorkali);
		
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
			$faktorkali = 1/2;
		}
		else if ($carabayarjsdwigunamenaik == 'Kuartalan')
		{
			$faktorkali = 1/4;
		}
		else if ($carabayarjsdwigunamenaik == 'Bulanan')
		{
			$faktorkali = 1/12;
		}
		else if ($carabayarjsdwigunamenaik == 'Sekaligus')
		{
			$faktorkali = 0;
		}
		
		$hasil = (($uangasuransipokok/1000) * ($result2[$jeniskelamin]) * $faktorkali);
		
		echo round($hasil);
	}
	
	function hitungjstermdwigunamenaik() {
		$this->load->model('ModSimulasi');
		
		$usiasekarang = $this->input->post("usiasekarang");
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		
		$uangasuransitermjsdwigunamenaik = $this->input->post("uangasuransitermjsdwigunamenaik");
		
		$calonpemegangpolisperokokjsdwigunamenaik = $this->input->post("calonpemegangpolisperokokjsdwigunamenaik");
		
		if ($calonpemegangpolisperokokjsdwigunamenaik == 'Tidak')
		{
			$statusperokok = 'NONSMOKER';
//			$faktorpengali = 3;
		}
		else if ($calonpemegangpolisperokokjsdwigunamenaik == 'Ya')
		{
			$statusperokok = 'SMOKER';
//			$faktorpengali = 2;
		}
		
		$carabayarjsdwigunamenaik = $this->input->post("carabayarjsdwigunamenaik");
		
		if ($carabayarjsdwigunamenaik == 'Tahunan')
		{
			$faktorkali = 1;
		}
		else if ($carabayarjsdwigunamenaik == 'Semesteran')
		{
			$faktorkali = 1/2;
		}
		else if ($carabayarjsdwigunamenaik == 'Kuartalan')
		{
			$faktorkali = 1/4;
		}
		else if ($carabayarjsdwigunamenaik == 'Bulanan')
		{
			$faktorkali = 1/12;
		}
		else if ($carabayarjsdwigunamenaik == 'Sekaligus')
		{
			$faktorkali = 0;
		}
		
		$result = $this->ModSimulasi->getBiayaAsuransiPerBulanTerm($usiasekarang);
		
		//$hasil = (($result[$statusperokok]/1000) * $uangasuransitermjsdwigunamenaik) * $faktorkali;
		
//		if ($uangasuransitermjsdwigunamenaik > ($uangasuransipokok * $faktorpengali))
//		{
//				$hasil = 'TIDAK BISA';
//		}
//		else
//		{
		$hasil = (str_replace(",", ".", $result[$statusperokok])) * ($uangasuransitermjsdwigunamenaik/1000) * $faktorkali;
//		}
		
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
		
//		$this->ModSimulasi->insertNasabah($data['hitung']);
		
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
			'id_nasabah' => $nasabahID,
			'id_agen' => $this->input->post('nomeragen'),
			'file_pdf' => $filePdf.'.pdf',
			'id_produk' => $this->input->post('idproduk'),
			'filepdf' => $filePdf,
			'kodeprospek' => $this->input->post('kodeprospek'),
			
			'usia' => $this->input->post('usia'),
			
			'hubungandenganpempol' => $this->input->post('hubungandenganpempol'),
			'calonpemegangpolisperokokjsdwigunamenaik' => $this->input->post('calonpemegangpolisperokokjsdwigunamenaik'),
			'namalengkapcalontertanggung' => $this->input->post('namalengkapcalontertanggung'),
			'jeniskelamincalontertanggung' => $this->input->post('jeniskelamincalontertanggung'),
			'tanggallahircalontertangggung' => $this->input->post('tanggallahircalontertangggung'),
			'tertanggungsamadenganpemegangpolis' => $this->input->post('tertanggungsamadenganpemegangpolis'),

			'masaasuransi' => $this->input->post('masaasuransi'),
			'uangasuransipokok' => $this->input->post('uangasuransipokok'),
			'topup' => $this->input->post('topup'),
			'carabayartopup' => $this->input->post('carabayartopup'),
			'uatl1' => $this->input->post('uatl1'),
			'uatl2' => $this->input->post('uatl2'),
			'carabayarjsdwigunamenaik' => $this->input->post('carabayarjsdwigunamenaik'),
			'jenisproduk' => $this->input->post('jenisproduk'),
			'nabawal' => $this->input->post('nabawal'),
//
//			'hcpjsdwigunamenaik' => $this->input->post('hcpjsdwigunamenaik'),
			'premihcpjsdwigunamenaik' => $this->input->post('premihcpjsdwigunamenaik'),
			'uangasuransihcpjsdwigunamenaik' => $this->input->post('uangasuransihcpjsdwigunamenaik'),
//
//			'hcpbjsdwigunamenaik' => $this->input->post('hcpbjsdwigunamenaik'),
			'premihcpbjsdwigunamenaik' => $this->input->post('premihcpbjsdwigunamenaik'),
			'uangasuransihcpbjsdwigunamenaik' => $this->input->post('uangasuransihcpbjsdwigunamenaik'),
//			
			'totalpremiriderjsdwigunamenaik1' => $this->input->post('totalpremiriderjsdwigunamenaik1'),
//			
//			'termjsdwigunamenaik' => $this->input->post('termjsdwigunamenaik'),
			'premitermjsdwigunamenaik' => $this->input->post('premitermjsdwigunamenaik'),
			'uangasuransitermjsdwigunamenaik' => $this->input->post('uangasuransitermjsdwigunamenaik'),
//
//			'jsaddbjsdwigunamenaik' => $this->input->post('jsaddbjsdwigunamenaik'),
			'premijsaddbjsdwigunamenaik' => $this->input->post('premijsaddbjsdwigunamenaik'),
			'uangasuransijsaddbjsdwigunamenaik' => $this->input->post('uangasuransijsaddbjsdwigunamenaik'),
//
//			'jstpdjsdwigunamenaik' => $this->input->post('jstpdjsdwigunamenaik'),
			'premijstpdjsdwigunamenaik' => $this->input->post('premijstpdjsdwigunamenaik'),
			'uangasuransijstpdjsdwigunamenaik' => $this->input->post('uangasuransijstpdjsdwigunamenaik'),
//
//			'ci53jsdwigunamenaik' => $this->input->post('ci53jsdwigunamenaik'),
			'premici53jsdwigunamenaik' => $this->input->post('premici53jsdwigunamenaik'),
			'uangasuransici53jsdwigunamenaik' => $this->input->post('uangasuransici53jsdwigunamenaik'),
//
//			'wpjsdwigunamenaik' => $this->input->post('wpjsdwigunamenaik'),
			'premiwpjsdwigunamenaik' => $this->input->post('premiwpjsdwigunamenaik'),
			'uangasuransiwpjsdwigunamenaik' => $this->input->post('uangasuransiwpjsdwigunamenaik'),
//
//			'jsspdjsdwigunamenaik' => $this->input->post('jsspdjsdwigunamenaik'),
			'premijsspdjsdwigunamenaik' => $this->input->post('premijsspdjsdwigunamenaik'),
			'uangasuransijsspdjsdwigunamenaik' => $this->input->post('uangasuransijsspdjsdwigunamenaik'),
//
//			'jssptpdjsdwigunamenaik' => $this->input->post('jssptpdjsdwigunamenaik'),
			'premijssptpdjsdwigunamenaik' => $this->input->post('premijssptpdjsdwigunamenaik'),
			'uangasuransijssptpdjsdwigunamenaik' => $this->input->post('uangasuransijssptpdjsdwigunamenaik'),
//
			'totalpremiriderjsdwigunamenaik2' => $this->input->post('totalpremiriderjsdwigunamenaik2'),
//			
//			'tabelpremipokok' => $this->input->post('tabelpremipokok'),
//			'tabeltopup' => $this->input->post('tabeltopup'),
			'tabelrider' => $this->input->post('tabelrider'),
			'tabeltotalpremi' => $this->input->post('tabeltotalpremi'),
			
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
		
		$data['hasil']['masaasuransi'] = $this->session->userdata('masaasuransi');
		$data['hasil']['uangasuransipokok'] = $this->session->userdata('uangasuransipokok');
		$data['hasil']['topup'] = $this->session->userdata('topup');
		$data['hasil']['carabayartopup'] = $this->session->userdata('carabayartopup');
		$data['hasil']['uatl1'] = $this->session->userdata('uatl1');
		$data['hasil']['uatl2'] = $this->session->userdata('uatl2');
		$data['hasil']['carabayarjsdwigunamenaik'] = $this->session->userdata('carabayarjsdwigunamenaik');
		
		for($i=1;$i<= 65 - $data['hasil']['usiacalontertanggung'];$i++){
			
			$data['hasil']['jenisproduk'] = $this->session->userdata('jenisproduk');
		
			if ($data['hasil']['jenisproduk'] == 'Fixed Income Fund')
			{
				$data['hasil']['asumsi_min_investasi'] = 6;
				$data['hasil']['asumsi_med_investasi'] = 8;
				$data['hasil']['asumsi_max_investasi'] = 10;

			}
			else if ($data['hasil']['jenisproduk'] == 'Balanced Fund')
			{
				$data['hasil']['asumsi_min_investasi'] = 8;
				$data['hasil']['asumsi_med_investasi'] = 10;
				$data['hasil']['asumsi_max_investasi'] = 12;	
			}
			else if ($data['hasil']['jenisproduk'] == 'Equity Fund')
			{
				$data['hasil']['asumsi_min_investasi'] = 10;
				$data['hasil']['asumsi_med_investasi'] = 12;
				$data['hasil']['asumsi_max_investasi'] = 14;	
			}
		
			$data['hasil']['nilai'][$i]['usia'] = $data['hasil']['usiacalontertanggung']+$i;
			
			if ($data['hasil']['carabayarjsdwigunamenaik'] == 'Sekaligus')
			{
				$data['hasil']['nilai'][$i]['uangasuransipokokhasil'] = $data['hasil']['uangasuransipokok'] * 1;
				
				$asumsi_min_investasi = $data['hasil']['asumsi_min_investasi'] * 0;
				$asumsi_med_investasi = $data['hasil']['asumsi_med_investasi'] * 0;
				$asumsi_max_investasi = $data['hasil']['asumsi_max_investasi'] * 0;
				
			}
			else if ($data['hasil']['carabayarjsdwigunamenaik'] == "Bulanan")
			{
				$data['hasil']['nilai'][$i]['uangasuransipokokhasil'] = $data['hasil']['uangasuransipokok'] * 12;
				
				$asumsi_min_investasi = $data['hasil']['asumsi_min_investasi'] / 12;
				$asumsi_med_investasi = $data['hasil']['asumsi_med_investasi'] / 12;
				$asumsi_max_investasi = $data['hasil']['asumsi_max_investasi'] / 12;
				
			}
			else if ($data['hasil']['carabayarjsdwigunamenaik'] == "Kuartalan")
			{
				$data['hasil']['nilai'][$i]['uangasuransipokokhasil'] = $data['hasil']['uangasuransipokok'] * 4;
				
				$asumsi_min_investasi = $data['hasil']['asumsi_min_investasi'] / 4;
				$asumsi_med_investasi = $data['hasil']['asumsi_med_investasi'] / 4;
				$asumsi_max_investasi = $data['hasil']['asumsi_max_investasi'] / 4;
				

			}
			else if ($data['hasil']['carabayarjsdwigunamenaik'] == "Semesteran")
			{

				$data['hasil']['nilai'][$i]['uangasuransipokokhasil'] = $data['hasil']['uangasuransipokok'] * 2;
				
				$asumsi_min_investasi = $data['hasil']['asumsi_min_investasi'] / 2;
				$asumsi_med_investasi = $data['hasil']['asumsi_med_investasi'] / 2;
				$asumsi_max_investasi = $data['hasil']['asumsi_max_investasi'] / 2;
				
			}
			else if ($data['hasil']['carabayarjsdwigunamenaik'] == "Tahunan")
			{
				$data['hasil']['nilai'][$i]['uangasuransipokokhasil'] = $data['hasil']['uangasuransipokok'] * 1;
				
				$asumsi_min_investasi = $data['hasil']['asumsi_min_investasi'] / 1;
				$asumsi_med_investasi = $data['hasil']['asumsi_med_investasi'] / 1;
				$asumsi_max_investasi = $data['hasil']['asumsi_max_investasi'] / 1;
				
			}
			
			if ($data['hasil']['carabayartopup'] == 'Sekaligus')
			{
					
				$data['hasil']['nilai'][$i]['topuphasil'] = $data['hasil']['topup'] * 1;
			}
			else if ($data['hasil']['carabayartopup'] == "Bulanan")
			{
				
				$data['hasil']['nilai'][$i]['topuphasil'] = $data['hasil']['topup'] * 12;
			}
			else if ($data['hasil']['carabayartopup'] == "Kuartalan")
			{
				
				$data['hasil']['nilai'][$i]['topuphasil'] = $data['hasil']['topup'] * 4 ;

			}
			else if ($data['hasil']['carabayartopup'] == "Semesteran")
			{

				
				$data['hasil']['nilai'][$i]['topuphasil'] = $data['hasil']['topup'] * 1;
			}
			else if ($data['hasil']['carabayartopup'] == "Tahunan")
			{
				
				$data['hasil']['nilai'][$i]['topuphasil'] = $data['hasil']['topup'] * 1;
			}
			
			
			if ($i == 1)
			{
				
				$pmt = (((30/100)*$data['hasil']['uangasuransipokok'])+((95/100)*$data['hasil']['topup']));
			
				$R1 = ($asumsi_min_investasi)/100;
				$R2 = ($asumsi_med_investasi)/100;
				$R3 = ($asumsi_max_investasi)/100;

				$nabxjumlahunitrendah1 = $pmt * pow(1+$R1, 1);
				$nabxjumlahunitrendah2 = $pmt * pow(1+$R1, 2);
				$nabxjumlahunitrendah3 = $pmt * pow(1+$R1, 3);
				$nabxjumlahunitrendah4 = $pmt * pow(1+$R1, 4);
				$nabxjumlahunitrendah5 = $pmt * pow(1+$R1, 5);
				$nabxjumlahunitrendah6 = $pmt * pow(1+$R1, 6);
				$nabxjumlahunitrendah7 = $pmt * pow(1+$R1, 7);
				$nabxjumlahunitrendah8 = $pmt * pow(1+$R1, 8);
				$nabxjumlahunitrendah9 = $pmt * pow(1+$R1, 9);
				$nabxjumlahunitrendah10 = $pmt * pow(1+$R1, 10);
				$nabxjumlahunitrendah11 = $pmt * pow(1+$R1, 11);
				$nabxjumlahunitrendah12 = $pmt * pow(1+$R1, 12);

				$nabxjumlahunitsedang1 = $pmt * pow(1+$R2, 1);
				$nabxjumlahunitsedang2 = $pmt * pow(1+$R2, 2);
				$nabxjumlahunitsedang3 = $pmt * pow(1+$R2, 3);
				$nabxjumlahunitsedang4 = $pmt * pow(1+$R2, 4);
				$nabxjumlahunitsedang5 = $pmt * pow(1+$R2, 5);
				$nabxjumlahunitsedang6 = $pmt * pow(1+$R2, 6);
				$nabxjumlahunitsedang7 = $pmt * pow(1+$R2, 7);
				$nabxjumlahunitsedang8 = $pmt * pow(1+$R2, 8);
				$nabxjumlahunitsedang9 = $pmt * pow(1+$R2, 9);
				$nabxjumlahunitsedang10 = $pmt * pow(1+$R2, 10);
				$nabxjumlahunitsedang11 = $pmt * pow(1+$R2, 11);
				$nabxjumlahunitsedang12 = $pmt * pow(1+$R2, 12);

				$nabxjumlahunittinggi1 = $pmt * pow(1+$R3, 1);
				$nabxjumlahunittinggi2 = $pmt * pow(1+$R3, 2);
				$nabxjumlahunittinggi3 = $pmt * pow(1+$R3, 3);
				$nabxjumlahunittinggi4 = $pmt * pow(1+$R3, 4);
				$nabxjumlahunittinggi5 = $pmt * pow(1+$R3, 5);
				$nabxjumlahunittinggi6 = $pmt * pow(1+$R3, 6);
				$nabxjumlahunittinggi7 = $pmt * pow(1+$R3, 7);
				$nabxjumlahunittinggi8 = $pmt * pow(1+$R3, 8);
				$nabxjumlahunittinggi9 = $pmt * pow(1+$R3, 9);
				$nabxjumlahunittinggi10 = $pmt * pow(1+$R3, 10);
				$nabxjumlahunittinggi11 = $pmt * pow(1+$R3, 11);
				$nabxjumlahunittinggi12 = $pmt * pow(1+$R3, 12);
				
				$data['hasil']['nilai'][$i]['nabxjumlahunitrendah'] = round( $nabxjumlahunitrendah1+$nabxjumlahunitrendah2+$nabxjumlahunitrendah3+$nabxjumlahunitrendah4+$nabxjumlahunitrendah5+$nabxjumlahunitrendah6+$nabxjumlahunitrendah7+$nabxjumlahunitrendah8+$nabxjumlahunitrendah9+$nabxjumlahunitrendah10+$nabxjumlahunitrendah11+$nabxjumlahunitrendah12);
				
				$data['hasil']['nilai'][$i]['nabxjumlahunitsedang'] = round( $nabxjumlahunitsedang1+$nabxjumlahunitsedang2+$nabxjumlahunitsedang3+$nabxjumlahunitsedang4+$nabxjumlahunitsedang5+$nabxjumlahunitsedang6+$nabxjumlahunitsedang7+$nabxjumlahunitsedang8+$nabxjumlahunitsedang9+$nabxjumlahunitsedang10+$nabxjumlahunitsedang11+$nabxjumlahunitsedang12);
				
				$data['hasil']['nilai'][$i]['nabxjumlahunittinggi'] = round( $nabxjumlahunittinggi1+$nabxjumlahunittinggi2+$nabxjumlahunittinggi3+$nabxjumlahunittinggi4+$nabxjumlahunittinggi5+$nabxjumlahunittinggi6+$nabxjumlahunittinggi7+$nabxjumlahunittinggi8+$nabxjumlahunittinggi9+$nabxjumlahunittinggi10+$nabxjumlahunittinggi11+$nabxjumlahunittinggi12);	
			}
			
		}
		
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
		
		$data['hasil']['hubungandenganpempol'] = $this->session->userdata('hubungandenganpempol');
		$data['hasil']['calonpemegangpolisperokokjsdwigunamenaik'] = $this->session->userdata('calonpemegangpolisperokokjsdwigunamenaik');
		$data['hasil']['namalengkapcalontertanggung'] = $this->session->userdata('namalengkapcalontertanggung');
		$data['hasil']['jeniskelamincalontertanggung'] = $this->session->userdata('jeniskelamincalontertanggung');
		$data['hasil']['tanggallahircalontertangggung'] = $this->session->userdata('tanggallahircalontertangggung');
		$data['hasil']['tertanggungsamadenganpemegangpolis'] = $this->session->userdata('tertanggungsamadenganpemegangpolis');
		
		$data['hasil']['nabawal'] = $this->session->userdata('nabawal');
		
		$data['hasil']['hcpjsdwigunamenaik'] = $this->session->userdata('hcpjsdwigunamenaik');
		$data['hasil']['premihcpjsdwigunamenaik'] = $this->session->userdata('premihcpjsdwigunamenaik');
		$data['hasil']['uangasuransihcpjsdwigunamenaik'] = $this->session->userdata('uangasuransihcpjsdwigunamenaik');
		
		$data['hasil']['hcpbjsdwigunamenaik'] = $this->session->userdata('hcpbjsdwigunamenaik');
		$data['hasil']['premihcpbjsdwigunamenaik'] = $this->session->userdata('premihcpbjsdwigunamenaik');
		$data['hasil']['uangasuransihcpbjsdwigunamenaik'] = $this->session->userdata('uangasuransihcpbjsdwigunamenaik');

		$data['hasil']['totalpremiriderjsdwigunamenaik1'] = $this->session->userdata('totalpremiriderjsdwigunamenaik1');
		
		$data['hasil']['termjsdwigunamenaik'] = $this->session->userdata('termjsdwigunamenaik');
		$data['hasil']['premitermjsdwigunamenaik'] = $this->session->userdata('premitermjsdwigunamenaik');
		$data['hasil']['uangasuransitermjsdwigunamenaik'] = $this->session->userdata('uangasuransitermjsdwigunamenaik');
		
		$data['hasil']['jsaddbjsdwigunamenaik'] = $this->session->userdata('jsaddbjsdwigunamenaik');
		$data['hasil']['premijsaddbjsdwigunamenaik'] = $this->session->userdata('premijsaddbjsdwigunamenaik');
		$data['hasil']['uangasuransijsaddbjsdwigunamenaik'] = $this->session->userdata('uangasuransijsaddbjsdwigunamenaik');
		
		$data['hasil']['jstpdjsdwigunamenaik'] = $this->session->userdata('jstpdjsdwigunamenaik');
		$data['hasil']['premijstpdjsdwigunamenaik'] = $this->session->userdata('premijstpdjsdwigunamenaik');
		$data['hasil']['uangasuransijstpdjsdwigunamenaik'] = $this->session->userdata('uangasuransijstpdjsdwigunamenaik');
		
		$data['hasil']['ci53jsdwigunamenaik'] = $this->session->userdata('ci53jsdwigunamenaik');
		$data['hasil']['premici53jsdwigunamenaik'] = $this->session->userdata('premici53jsdwigunamenaik');
		$data['hasil']['uangasuransici53jsdwigunamenaik'] = $this->session->userdata('uangasuransici53jsdwigunamenaik');
		
		$data['hasil']['wpjsdwigunamenaik'] = $this->session->userdata('wpjsdwigunamenaik');
		$data['hasil']['premiwpjsdwigunamenaik'] = $this->session->userdata('premiwpjsdwigunamenaik');
		$data['hasil']['uangasuransiwpjsdwigunamenaik'] = $this->session->userdata('uangasuransiwpjsdwigunamenaik');
		
		$data['hasil']['jsspdjsdwigunamenaik'] = $this->session->userdata('jsspdjsdwigunamenaik');
		$data['hasil']['premijsspdjsdwigunamenaik'] = $this->session->userdata('premijsspdjsdwigunamenaik');
		$data['hasil']['uangasuransijsspdjsdwigunamenaik'] = $this->session->userdata('uangasuransijsspdjsdwigunamenaik');
		
		$data['hasil']['jssptpdjsdwigunamenaik'] = $this->session->userdata('jssptpdjsdwigunamenaik');
		$data['hasil']['premijssptpdjsdwigunamenaik'] = $this->session->userdata('premijssptpdjsdwigunamenaik');
		$data['hasil']['uangasuransijssptpdjsdwigunamenaik'] = $this->session->userdata('uangasuransijssptpdjsdwigunamenaik');
		
		$data['hasil']['totalpremiriderjsdwigunamenaik2'] = $this->session->userdata('totalpremiriderjsdwigunamenaik2');
		
		$data['hasil']['tabelpremipokok'] = $this->session->userdata('tabelpremipokok');
		$data['hasil']['tabeltopup'] = $this->session->userdata('tabeltopup');
		$data['hasil']['tabelrider'] = $this->session->userdata('tabelrider');
		$data['hasil']['tabeltotalpremi'] = $this->session->userdata('tabeltotalpremi');
		
		$data['hasil']['filepdf'] = $this->session->userdata('filepdf');
		$data['hasil']['id_nasabah'] = $this->session->userdata('id_nasabah');
		$data['hasil']['id_agen']	 = $this->session->userdata('id_agen');
		//$data['hasil']['file_pdf']	 = $filePdf.'.pdf',
		$data['hasil']['id_produk']  = $this->session->userdata('id_produk');
		
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
			'CARA_BAYAR' => $data['hasil']['carabayarjsdwigunamenaik'],
			'JUMLAH_PREMI' => $data['hasil']['tabeltotalpremi']
		);
		
		$this->ModSimulasi->insertSimulasi($data['hitung']);
		
		$data['hasil']['build_id'] = $data['hitung']['BUILD_ID'];
				
		$filePdf = $this->session->userdata('filepdf');
		
		$this->createPDF($filePdf,$data);
		
		$this->load->view('hasil/jl3new',$data);
		
		//$this->session->sess_destroy();
	}

	function createPDF($namaFile,$data){
		$image1 = FCPATH.'assets/img/logo-js.png';
		$image2 = FCPATH.'assets/img/grafik_pertumbuhan_nab.jpg';
		
	    // Generate PDF by saying hello to the world
		
		// PAGE 1
		$this->pdf->AddPage();

		// HEADER
		$this->pdf->Image($image1, 170, 5);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',14);
		$this->pdf->Cell(190,5,'PT. ASURANSI JIWASRAYA (PERSERO)',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(190,5,'Jl. Ir. H. Juanda No. 34 Jakarta - 10120',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(65,105,225);
		$this->pdf->Cell(50,5,'CALL (021) 1500151 ',1,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','I',8);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(0,0,0);
		$this->pdf->Cell(50,5,'http://www.jiwasraya.co.id',1,0,'L', true);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI PRODUK',0,0,'C');
		$this->pdf->ln();
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(89,89,89);
		$this->pdf->Cell(190,5,'',0,0,'C', true);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->ln();

		// DATA TERTANGGUNG
		$this->pdf->Cell(47.5,5,'Nama Calon',0,0,'L');
		$this->pdf->Cell(7.5,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(57.5,5,'',0,0,'L');
		$this->pdf->Cell(30,5,'',0,0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(47.5,5,'Asumsi tingkat hasil investasi',1,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(47.5,5,'Usia',0,0,'L');
		$this->pdf->Cell(7.5,5,':',0,0,'L');
		$this->pdf->Cell(57.5,5,'',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,'Tahun',0,0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(15.83,5,'Rendah',1,0,'C');
		$this->pdf->Cell(15.83,5,'Sedang',1,0,'C');
		$this->pdf->Cell(15.83,5,'Tinggi',1,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(47.5,5,'Masa Pembayaran Premi',0,0,'L');
		$this->pdf->Cell(7.5,5,':',0,0,'L');
		$this->pdf->Cell(57.5,5,'',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,'Tahun',0,0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(15.83,5,'10%',1,0,'C');
		$this->pdf->Cell(15.83,5,'12%',1,0,'C');
		$this->pdf->Cell(15.83,5,'14%',1,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(47.5,5,'Premi Berkala',0,0,'L');
		$this->pdf->Cell(7.5,5,':',0,0,'L');
		$this->pdf->Cell(57.5,5,'Rp.',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,'',0,0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->ln();
		$this->pdf->Cell(47.5,5,'Top Up',0,0,'L');
		$this->pdf->Cell(7.5,5,':',0,0,'L');
		$this->pdf->Cell(57.5,5,'Rp.',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,'',0,0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->ln();
		$this->pdf->Cell(47.5,5,'Uang Asuransi TL1',0,0,'L');
		$this->pdf->Cell(7.5,5,':',0,0,'L');
		$this->pdf->Cell(57.5,5,'Rp.',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,'',0,0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->ln();
		$this->pdf->Cell(47.5,5,'Uang Asuransi TL2',0,0,'L');
		$this->pdf->Cell(7.5,5,':',0,0,'L');
		$this->pdf->Cell(57.5,5,'Rp.',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,'',0,0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','UB',8);
		$this->pdf->Cell(47.5,5,'Premi Rider',0,0,'L');
		$this->pdf->Cell(47.5,5,'',0,0,'L');
		$this->pdf->Cell(47.5,5,'',0,0,'L');
		$this->pdf->SetFont('Arial','UB',8);
		$this->pdf->Cell(47.5,5,'Uang Pertanggungan Rider',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(47.5,5,'-Term Insurance',0,0,'L');
		$this->pdf->Cell(7.5,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(57.5,5,'Rp.',1,0,'L');
		$this->pdf->Cell(30,5,'',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(47.5,5,'Rp.',1,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(47.5,5,'-Personal Accident',0,0,'L');
		$this->pdf->Cell(7.5,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(57.5,5,'Rp.',1,0,'L');
		$this->pdf->Cell(30,5,'',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(47.5,5,'Rp.',1,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(47.5,5,'-Total Permanent Disability',0,0,'L');
		$this->pdf->Cell(7.5,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(57.5,5,'Rp.',1,0,'L');
		$this->pdf->Cell(30,5,'',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(47.5,5,'Rp.',1,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(47.5,5,'-Critical Illness',0,0,'L');
		$this->pdf->Cell(7.5,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(57.5,5,'Rp.',1,0,'L');
		$this->pdf->Cell(30,5,'',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(47.5,5,'Rp.',1,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(47.5,5,'-Waiver Premium',0,0,'L');
		$this->pdf->Cell(7.5,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(57.5,5,'Rp.',1,0,'L');
		$this->pdf->Cell(30,5,'',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(47.5,5,'Rp.',1,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(47.5,5,'-Cash Plan',0,0,'L');
		$this->pdf->Cell(7.5,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(57.5,5,'Rp.',1,0,'L');
		$this->pdf->Cell(30,5,'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(47.5,5,'Total Premi (Unit Link + Rider)',0,0,'L');
		$this->pdf->Cell(7.5,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(57.5,5,'Rp.',1,0,'L');
		$this->pdf->Cell(30,5,'',0,0,'L');
		$this->pdf->ln();

		// MANFAAT ASURANSI 
		$this->pdf->SetFont('Arial','UB',8);
		$this->pdf->Cell(190,4,'Manfaat Asuransi',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(4,4,'1.',0,0,'L');
		$this->pdf->Cell(186,4,'Jaminan Meninggal Dunia',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(4,4,'',0,0,'L');
		$this->pdf->Cell(186,4,'Jika tertanggung meninggal dunia dalam masa Asuransi, maka akan dibayarkan Uang Asuransi (TL1) Ditambah Nilai Akumulasi Dana (Jumlah Unit',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(4,4,'',0,0,'L');
		$this->pdf->Cell(186,4,'yang dimiliki x NAB) ditambah Uang Asuransi (TL2) ditambah Uang Asuransi Rider kematian yang dimiliki.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(4,4,'2.',0,0,'L');
		$this->pdf->Cell(186,4,'Expirasi',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(4,4,'',0,0,'L');
		$this->pdf->Cell(186,4,'Jika Tertanggung hidup sampai dengan akhir masa asuransi, maka kepada Pemegang Polis akan dibayarkan sebesar Nilai Akumulasi (Jumlah Unit',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(4,4,'',0,0,'L');
		$this->pdf->Cell(186,4,'yang dimiliki X NAB).',0,0,'L');
		$this->pdf->ln();

		// TABEL PERKEMBANGAN DANA INVESTASI(ilustrasi)
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,4,'TABEL PERKEMBANGAN DANA INVESTASI(ilustrasi)',0,0,'C');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->ln();

		// DATA RINCIAN POLIS
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->SetFillColor(217,217,217);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->Cell(10,4,'Akhir th','LTR',0,'C',true);
		$this->pdf->Cell(10,4,'Usia','LTR',0,'C',true);
		$this->pdf->Cell(10,4,'Premi','LTR',0,'C',true);
		$this->pdf->Cell(10,4,'Top Up','LTR',0,'C',true);
		$this->pdf->Cell(75,4,'Santunan Kematian*','LTR',0,'C',true);
		$this->pdf->Cell(75,4,'Dana Investasi (Unit x NAB)','LTR',0,'C',true);
		$this->pdf->ln();
		$this->pdf->Cell(10,4,'ke','LBR',0,'C',true);
		$this->pdf->Cell(10,4,'','LBR',0,'C',true);
		$this->pdf->Cell(10,4,'','LBR',0,'C',true);
		$this->pdf->Cell(10,4,'','LBR',0,'C',true);
		$this->pdf->Cell(25,4,'rendah',1,0,'C',true);
		$this->pdf->Cell(25,4,'sedang',1,0,'C',true);
		$this->pdf->Cell(25,4,'tinggi',1,0,'C',true);
		$this->pdf->Cell(25,4,'rendah',1,0,'C',true);
		$this->pdf->Cell(25,4,'sedang',1,0,'C',true);
		$this->pdf->Cell(25,4,'tinggi','LTR',0,'C',true);
		$this->pdf->ln();
		for ($i=1 ; $i <= 20; $i++)
		{
			$this->pdf->SetFont('Arial','B',6);
			$this->pdf->SetFillColor(255,255,255);
			$this->pdf->SetTextColor(0,0,0);
			$this->pdf->Cell(10,4,$i,1,0,'C',true);
			$this->pdf->Cell(10,4,'',1,0,'C',true);
			$this->pdf->Cell(10,4,'',1,0,'C',true);
			$this->pdf->Cell(10,4,'',1,0,'C',true);
			$this->pdf->Cell(25,4,'',1,0,'C',true);
			$this->pdf->Cell(25,4,'',1,0,'C',true);
			$this->pdf->Cell(25,4,'',1,0,'C',true);
			$this->pdf->SetTextColor(255,0,0);
			$this->pdf->Cell(25,4,'',1,0,'C',true);
			$this->pdf->Cell(25,4,'',1,0,'C',true);
			$this->pdf->Cell(25,4,'',1,0,'C',true);
			$this->pdf->SetTextColor(0,0,0);
			$this->pdf->ln();
		}

		// FOOTER
		$this->pdf->Cell(190,5,'','B',0,'L');
		$this->pdf->ln(10);

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(13,5,'Disajikan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,5,' ',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(13,5,'Kode Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,5,'',0,0,'L');
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
		$this->pdf->Cell(29,5,'',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(13,5,'Kantor Cabang',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,5,'',0,0,'L');
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
		$this->pdf->Cell(29,5,'',0,0,'L');
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
		$this->pdf->Cell(190,5,'PT. ASURANSI JIWASRAYA (PERSERO)',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(190,5,'Jl. Ir. H. Juanda No. 34 Jakarta - 10120',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(65,105,225);
		$this->pdf->Cell(50,5,'CALL (021) 1500151 ',1,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','I',8);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(0,0,0);
		$this->pdf->Cell(50,5,'http://www.jiwasraya.co.id',1,0,'L', true);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI PRODUK',0,0,'C');
		$this->pdf->ln();
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(89,89,89);
		$this->pdf->Cell(190,5,'',0,0,'C', true);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->ln();

		// MANFAAT ASURANSI 
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Image($image2, 10);
		$this->pdf->Cell(190,4,'CATATAN PENTING',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(4,4,'1.',0,0,'L');
		$this->pdf->Cell(186,4,'Alokasi Premi Plan Pokok yang dibentuk ke dalam unit.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(4,4,'',0,0,'L');
		$this->pdf->Cell(26.57,4,'Deskripsi',0,0,'L');
		$this->pdf->Cell(26.57,4,'Tahun 1',0,0,'L');
		$this->pdf->Cell(26.57,4,'Tahun 2',0,0,'L');
		$this->pdf->Cell(26.57,4,'Tahun 3',0,0,'L');
		$this->pdf->Cell(26.57,4,'Tahun 4',0,0,'L');
		$this->pdf->Cell(26.57,4,'Tahun 5',0,0,'L');
		$this->pdf->Cell(26.57,4,'Tahun 6 dst',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(4,4,'',0,0,'L');
		$this->pdf->Cell(26.57,4,'Investasi',0,0,'L');
		$this->pdf->Cell(26.57,4,'',0,0,'LR');
		$this->pdf->Cell(26.57,4,'',0,0,'LR');
		$this->pdf->Cell(26.57,4,'',0,0,'LR');
		$this->pdf->Cell(26.57,4,'',0,0,'LR');
		$this->pdf->Cell(26.57,4,'',0,0,'LR');
		$this->pdf->Cell(26.57,4,'',0,0,'LR');
		$this->pdf->ln();
		$this->pdf->Cell(4,4,'',0,0,'L');
		$this->pdf->Cell(26.57,4,'Biaya',0,0,'L');
		$this->pdf->Cell(26.57,4,'',0,0,'LBR');
		$this->pdf->Cell(26.57,4,'',0,0,'LBR');
		$this->pdf->Cell(26.57,4,'',0,0,'LBR');
		$this->pdf->Cell(26.57,4,'',0,0,'LBR');
		$this->pdf->Cell(26.57,4,'',0,0,'LBR');
		$this->pdf->Cell(26.57,4,'',0,0,'LBR');
		$this->pdf->ln();
		$this->pdf->Cell(4,4,'2.',0,0,'L');
		$this->pdf->Cell(186,4,'Biaya Pengelolaan Investasi maksimal sebesar 1,75% x Total dana Investasi setiap Tahun.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4,4,'3.',0,0,'L');
		$this->pdf->Cell(186,4,'Uang Asuransi dan Jaminan Tambahan (Jika ada) adalah sejumlah uang yang tercantum didalam Polis yang akan dibayar oleh Penanggung apabila',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4,4,'',0,0,'L');
		$this->pdf->Cell(186,4,'syarat-syarat dan ketentuan pembayaran sebagaimana tercantum dalam polis terpenuhi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4,4,'4.',0,0,'L');
		$this->pdf->Cell(186,4,'Nilai Tunai adalah Nilai Saldo Unit yang dihitung berdasarkan harga unit pada suatu saat tertentu.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4,4,'5.',0,0,'L');
		$this->pdf->Cell(186,4,'Asumsi tinggi rendahnya hasil investasi ini hanya bertujuan untuk illustrasi saja dan bukan merupakan tolak ukur untuk perhitungan rata-rata tingkat',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4,4,'',0,0,'L');
		$this->pdf->Cell(186,4,'hasil investasi yang terendah dan tertinggi.Kinerja Investasi tidaj dijamin,tergantung dari resiko masing-masing instrumen investasi.Pemegang Polis',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4,4,'',0,0,'L');
		$this->pdf->Cell(186,4,'diberi keleluasaan untuk menempatkan alokasi dana investasi yang memungkinkan optimalisasi tingkat pengembalian investasi,sesuai dengan kebu-',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4,4,'',0,0,'L');
		$this->pdf->Cell(186,4,'tuhan dan profil risiko Pemegang Polis.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4,4,'6.',0,0,'L');
		$this->pdf->Cell(186,4,'Nilai dari setiap unit dari dana yang diinvestasikan akan berbeda dari waktu ke waktu tergantung pada kinerja investasi perusahaan dan tidak lepas',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4,4,'',0,0,'L');
		$this->pdf->Cell(186,4,'dari risiko investasi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4,4,'7.',0,0,'L');
		$this->pdf->Cell(186,4,'Besaran Nilai Tunai yang dibayarkan (dapat lebih kecil atau besar),akan tergantung pada perkembangan dari dana investasi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4,4,'8.',0,0,'L');
		$this->pdf->Cell(186,4,'Dana dikelola oleh PT.Asuransi Jiwasraya (Persero),yaitu perusahaan asuransi yang telah berpengalaman sejak tahun 1859.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4,4,'9.',0,0,'L');
		$this->pdf->Cell(186,4,'Pemegang Polis bebas melakukan penambahan (Top up) dan penarikan (Redemtion) dana investasi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4,4,'10.',0,0,'L');
		$this->pdf->Cell(186,4,'Top Up.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4,4,'',0,0,'L');
		$this->pdf->Cell(186,4,'a. Top Up Premi Berkala kelipatan Rp.1000.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4,4,'',0,0,'L');
		$this->pdf->Cell(186,4,'b. Top Up Premi Tunggal Minimum Rp.1.000.000.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4,4,'11.',0,0,'L');
		$this->pdf->Cell(186,4,'Redemption.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4,4,'',0,0,'L');
		$this->pdf->Cell(186,4,'a. Redemtion tidak dikenakan biaya.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4,4,'',0,0,'L');
		$this->pdf->Cell(186,4,'b. Dana yang tersisa setelah redemption,minimum setara dengan 1000 unit.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4,4,'12.',0,0,'L');
		$this->pdf->Cell(186,4,'Untuk penarikan sebelum 3 tahun,akan dikenakan pajak penghasilan sesuai ketentuan pemerintah yang berlaku atas kelebihan Nilai Tunai terhadap',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4,4,'',0,0,'L');
		$this->pdf->Cell(186,4,'Premi yang dibayarkan,kecuali ditentukan lain berdasarkan peraturan perundang-undangan yang berlaku.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4,4,'13.',0,0,'L');
		$this->pdf->Cell(186,4,'Harga Unit/Nilai NAB (Nilai Aktiva Bersih) akan diumumkan setiap hari pada Media Harian Bisnis Indonesia dan web site http://www.jiwasraya.co.id',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4,4,'',0,0,'L');
		$this->pdf->Cell(186,4,'Harga Jual : harga per unit yang diterapkan pada setiap transaksi yang berkaitan dengan pembentukan unit.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4,4,'',0,0,'L');
		$this->pdf->Cell(186,4,'Harga beli : harga perunit yang diterapkan pada setiap transaksi yang berkaitan dengan pembatalan dan pemindahan unit.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4,4,'14.',0,0,'L');
		$this->pdf->Cell(186,4,'Illustrasi mengasumsikan tidak ada penarikan dana selama masa asuransi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4,4,'15.',0,0,'L');
		$this->pdf->Cell(186,4,'Penilaian harga unit dilakukan pada setiap hari kerja dan perubahan NAB dilaksanakan setiap hari Rabu, dengan menggunakan metode harga pasar',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4,4,'',0,0,'L');
		$this->pdf->Cell(186,4,'yang berlaku bagi instrumen investasi yang mendasari masing-masing alokasi dan investasi yang dipilih.',0,0,'L');
		$this->pdf->ln();


		// FOOTER
		$this->pdf->Cell(190,5,'','B',0,'L');
		$this->pdf->ln(10);

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(13,5,'Disajikan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,5,' ',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(13,5,'Kode Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,5,'',0,0,'L');
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
		$this->pdf->Cell(29,5,'',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(13,5,'Kantor Cabang',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,5,'',0,0,'L');
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
		$this->pdf->Cell(29,5,'',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,5,'','LBR',0,'C');
		$this->pdf->Cell(40,5,'','LBR',0,'C');

		$this->pdf->ln(10);
		$this->pdf->AliasNbPages('{totalPages}');
		$this->pdf->Cell(190, 5, "Page " . $this->pdf->PageNo() . "/{totalPages}",' ', 0, 'R');

		// PAGE 3
		$this->pdf->AddPage();

		// HEADER
		$this->pdf->Image($image1, 170, 5);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',14);
		$this->pdf->Cell(190,5,'PT. ASURANSI JIWASRAYA (PERSERO)',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(190,5,'Jl. Ir. H. Juanda No. 34 Jakarta - 10120',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(65,105,225);
		$this->pdf->Cell(50,5,'CALL (021) 1500151 ',1,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','I',8);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(0,0,0);
		$this->pdf->Cell(50,5,'http://www.jiwasraya.co.id',1,0,'L', true);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI PRODUK',0,0,'C');
		$this->pdf->ln();
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(89,89,89);
		$this->pdf->Cell(190,5,'',0,0,'C', true);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->ln(10);

		// DEFINISI\
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(190,5,'DEFINISI',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(25,5,'Cash Plan',0,0,'L');
		$this->pdf->Cell(10,5,':',0,0,'L');
		$this->pdf->Cell(165,5,'Memberikan santunan harian Rawat inap atau Rawat ICU,jika tertanggung dirawat di Rumah Sakit.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(25,5,'Cash Plan Bedah',0,0,'L');
		$this->pdf->Cell(10,5,':',0,0,'L');
		$this->pdf->Cell(165,5,'Memberikan santunan pembedahan jika tertanggung harus mengalami pembedahan.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(25,5,'Critical Illness',0,0,'L');
		$this->pdf->Cell(10,5,':',0,0,'L');
		$this->pdf->Cell(165,5,'Mengalami kondisi salah satu dari 40 jenis penyakit kritis setelah 90 hari sejak PP CI dimulai.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(25,5,'Term',0,0,'L');
		$this->pdf->Cell(10,5,':',0,0,'L');
		$this->pdf->Cell(165,5,'Memberikan santunan jika tertanggung meninggal dunia.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(25,5,'Personal Accident',0,0,'L');
		$this->pdf->Cell(10,5,':',0,0,'L');
		$this->pdf->Cell(165,5,'Memberikan santunan jika tertanggung meninggal dunia karena kecelakaan.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(25,5,'Waiver Premium',0,0,'L');
		$this->pdf->Cell(10,5,':',0,0,'L');
		$this->pdf->Cell(165,5,'Pembebasan Premi lanjutan, jika Tertanggung mengalami cacat tetap total.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(25,5,'TPD',0,0,'L');
		$this->pdf->Cell(10,5,':',0,0,'L');
		$this->pdf->Cell(165,5,'Memberikan santunan jika Tertanggung mengalami cacat tetap total.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(25,5,'JS TL1',0,0,'L');
		$this->pdf->Cell(10,5,':',0,0,'L');
		$this->pdf->Cell(165,5,'Jika Tertanggung Meninggal dunia dalam masa asuransi akan dibayarkan Nilai Uang Asuransi ditambah Top Up dikurangi',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(25,5,'',0,0,'L');
		$this->pdf->Cell(10,5,'',0,0,'L');
		$this->pdf->Cell(165,5,'Redemption ditambah akumulasi dana.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(25,5,'JS TL1',0,0,'L');
		$this->pdf->Cell(10,5,':',0,0,'L');
		$this->pdf->Cell(165,5,'Jika tertanggung meninggal dunia dalam masa asuransi akan dibayarkan sebesar uang Asuransi JS Term Life 65.',0,0,'L');
		$this->pdf->ln(140);

		// FOOTER
		$this->pdf->Cell(190,5,'','B',0,'L');
		$this->pdf->ln(10);

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(13,5,'Disajikan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,5,' ',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(13,5,'Kode Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,5,'',0,0,'L');
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
		$this->pdf->Cell(29,5,'',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(13,5,'Kantor Cabang',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,5,'',0,0,'L');
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
		$this->pdf->Cell(29,5,'',0,0,'L');
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