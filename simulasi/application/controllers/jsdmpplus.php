<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");

	error_reporting(0);

class Jsdmpplus extends CI_Controller{
	
	function hitungpremi(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		$carabayarjsdmpplus = $this->input->post("carabayarjsdmpplus");
			
		$result = $this->ModSimulasi->getPremiJSDMP($masaasuransi, $usiasekarang, $uangasuransipokok, $carabayarjsdmpplus);
		
		echo $result['HASIL'];
			
	}
	
	function hitungpremi5tahunpertama(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		$carabayarjsdmpplus = $this->input->post("carabayarjsdmpplus");
			
		$result = $this->ModSimulasi->getPremiJSDMP5tahunpertama($masaasuransi, $usiasekarang, $uangasuransipokok, $carabayarjsdmpplus);
		
		echo $result['HASIL'];
			
	}

	function hitungpremisekaligusdmpplus(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		
		if (($usiasekarang <=20) && ($usiasekarang >=17))
		{
			$usiasekarang = 20;	
		}
			
		$result = $this->ModSimulasi->getPremiSekaligusDMPPlus($masaasuransi, $usiasekarang);
		
		$hasil = $result['TARIF'] * ($uangasuransipokok / 1000);
		
		echo round($hasil);
	}
	
	function hitungpremi5tahunpertamadmpplus(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		
		if (($usiasekarang <=20) && ($usiasekarang >=17))
		{
			$usiasekarang = 20;	
		}
		
		$result = $this->ModSimulasi->getPremi5TahunPertamaDMPPlus($masaasuransi, $usiasekarang);
		
		$hasil = ($result['TARIF'] * ($uangasuransipokok / 1000)) * 1.05;
		
		echo round($hasil);
	}
	
	function hitungpremisemesterandmpplus(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		
		if (($usiasekarang <=20) && ($usiasekarang >=17))
		{
			$usiasekarang = 20;	
		}
		
		$result = $this->ModSimulasi->getPremi5TahunPertamaDMPPlus($masaasuransi, $usiasekarang);
		
		$hasil = ($result['TARIF'] * ($uangasuransipokok / 1000)) * 1.05 * 0.52;
		
		echo round($hasil);
	}
	
	function hitungpremikuartalandmpplus(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		
		if (($usiasekarang <=20) && ($usiasekarang >=17))
		{
			$usiasekarang = 20;	
		}
		
		$result = $this->ModSimulasi->getPremi5TahunPertamaDMPPlus($masaasuransi, $usiasekarang);
		
		$hasil = ($result['TARIF'] * ($uangasuransipokok / 1000)) * 1.05 * 0.27;
		
		echo round($hasil);
	}
	
	function hitungpremibulanandmpplus(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		
		if (($usiasekarang <=20) && ($usiasekarang >=17))
		{
			$usiasekarang = 20;	
		}
		
		$result = $this->ModSimulasi->getPremi5TahunPertamaDMPPlus($masaasuransi, $usiasekarang);
		
		$hasil = ($result['TARIF'] * ($uangasuransipokok / 1000)) * 1.05 * 0.095;
		
		echo round($hasil);
	}
	
	//RIDER 
	
	function hitunghcpjsdmpplus(){
		$this->load->model('ModSimulasi');
		
		$uangasuransihcpjsdmpplus = $this->input->post("uangasuransihcpjsdmpplus");
		
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
		
		if (($usiasekarang <=20) && ($usiasekarang >=17))
		{
			$usiasekarang = 20;	
		}
		
		$result = $this->ModSimulasi->getBiayaAsuransiPerBulanHCPDwigunaMenaik($usiasekarang, $uangasuransihcpjsdmpplus, $jeniskelamin);
		
		$carabayarjsdmpplus = $this->input->post("carabayarjsdmpplus");
		
		if ($carabayarjsdmpplus == 'Tahunan')
		{
			$faktorkali = 1;
		}
		else if ($carabayarjsdmpplus == 'Semesteran')
		{
			$faktorkali = 0.52;
		}
		else if ($carabayarjsdmpplus == 'Kuartalan')
		{
			$faktorkali = 0.27;
		}
		else if ($carabayarjsdmpplus == 'Bulanan')
		{
			$faktorkali = 0.095;
		}
		else if ($carabayarjsdmpplus == 'Sekaligus')
		{
			$faktorkali = 0;
		}
		
		$hasil = $result['TARIF'] * $faktorkali;
		
		echo round($hasil);
		
	}
	
	function hitunghcpbjsdmpplus() {
		$this->load->model('ModSimulasi');
		
		$uangasuransihcpbjsdmpplus = $this->input->post("uangasuransihcpbjsdmpplus");
		
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
		
		if (($usiasekarang <=20) && ($usiasekarang >=17))
		{
			$usiasekarang = 20;	
		}
		
		$result = $this->ModSimulasi->getBiayaAsuransiPerBulanHCPBedahDwigunaMenaik($usiasekarang, $jeniskelamin, $uangasuransihcpbjsdmpplus);
		
		$carabayarjsdmpplus = $this->input->post("carabayarjsdmpplus");
		
		if ($carabayarjsdmpplus == 'Tahunan')
		{
			$faktorkali = 1;
		}
		else if ($carabayarjsdmpplus == 'Semesteran')
		{
			$faktorkali = 0.52;
		}
		else if ($carabayarjsdmpplus == 'Kuartalan')
		{
			$faktorkali = 0.27;
		}
		else if ($carabayarjsdmpplus == 'Bulanan')
		{
			$faktorkali = 0.095;
		}
		else if ($carabayarjsdmpplus == 'Sekaligus')
		{
			$faktorkali = 0;
		}
		
		$hasil = $result['TARIF'] * $faktorkali;
		
		echo round($hasil);
	}
	
	function hitungtpdjsdmpplus(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransijstpdjsdmpplus = $this->input->post("uangasuransijstpdjsdmpplus");
		$jeniskelamincalontertanggung = $this->input->post("jeniskelamincalontertanggung");	
		$uangasuransipokok = $this->input->post("uangasuransipokok");	
		
		if ($jeniskelamincalontertanggung == 'Perempuan')
		{
			$jeniskelamin = 'FEMALE';	
		}
		else if ($jeniskelamincalontertanggung == 'Laki-Laki')
		{
			$jeniskelamin = 'MALE';	
		}
		
		$carabayarjsdmpplus = $this->input->post("carabayarjsdmpplus");
		
		if ($carabayarjsdmpplus == 'Tahunan')
		{
			$faktorkali = 1;
		}
		else if ($carabayarjsdmpplus == 'Semesteran')
		{
			$faktorkali = 0.52;
		}
		else if ($carabayarjsdmpplus == 'Kuartalan')
		{
			$faktorkali = 0.27;
		}
		else if ($carabayarjsdmpplus == 'Bulanan')
		{
			$faktorkali = 0.095;
		}
		else if ($carabayarjsdmpplus == 'Sekaligus')
		{
			$faktorkali = 0;
		}
			
		$usiasekarang = $this->input->post("usiasekarang");
		
		if (($usiasekarang <=20) && ($usiasekarang >=17))
		{
			$usiasekarang = 20;	
		}
		
		$result = $this->ModSimulasi->getBiayaAsuransiPerBulanTPD($usiasekarang);
		
		if ($uangasuransijstpdjsdmpplus < $uangasuransipokok)
		{
			$hasil = "tidak bisa";	
		}
		else if ($uangasuransijstpdjsdmpplus > (3*$uangasuransipokok))
		{
			$hasil = "tidak bisa";	
		}
		else
		{
			$hasil = round($result[$jeniskelamin] * ($uangasuransijstpdjsdmpplus / 1000) * $faktorkali);
		}
		
		echo $hasil;
	}
	
	function hitungci53jsdmpplus(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransici53jsdmpplus = $this->input->post("uangasuransici53jsdmpplus");
		$jeniskelamincalontertanggung = $this->input->post("jeniskelamincalontertanggung");	
		
		if ($jeniskelamincalontertanggung == 'Perempuan')
		{
			$jeniskelamin = 'FEMALE';	
		}
		else if ($jeniskelamincalontertanggung == 'Laki-Laki')
		{
			$jeniskelamin = 'MALE';	
		}
		
		$carabayarjsdmpplus = $this->input->post("carabayarjsdmpplus");
		
		if ($carabayarjsdmpplus == 'Tahunan')
		{
			$faktorkali = 1;
		}
		else if ($carabayarjsdmpplus == 'Semesteran')
		{
			$faktorkali = 0.52;
		}
		else if ($carabayarjsdmpplus == 'Kuartalan')
		{
			$faktorkali = 0.27;
		}
		else if ($carabayarjsdmpplus == 'Bulanan')
		{
			$faktorkali = 0.095;
		}
		else if ($carabayarjsdmpplus == 'Sekaligus')
		{
			$faktorkali = 0;
		}
			
		$usiasekarang = $this->input->post("usiasekarang");
		
		if (($usiasekarang <=20) && ($usiasekarang >=17))
		{
			$usiasekarang = 20;	
		}
		
		$result = $this->ModSimulasi->getBiayaAsuransiPerBulanCI53($usiasekarang);
		
		$hasil = $result[$jeniskelamin] * ($uangasuransici53jsdmpplus / 1000) * $faktorkali;
		
		echo round($hasil);
	}
	
	function hitungaddbjsdmpplus(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransijsaddbjsdmpplus = $this->input->post("uangasuransijsaddbjsdmpplus");
		$jeniskelamincalontertanggung = $this->input->post("jeniskelamincalontertanggung");	
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		
		if ($jeniskelamincalontertanggung == 'Perempuan')
		{
			$jeniskelamin = 'FEMALE';	
		}
		else if ($jeniskelamincalontertanggung == 'Laki-Laki')
		{
			$jeniskelamin = 'MALE';	
		}
		
		$carabayarjsdmpplus = $this->input->post("carabayarjsdmpplus");
		
		if ($carabayarjsdmpplus == 'Tahunan')
		{
			$faktorkali = 1;
		}
		else if ($carabayarjsdmpplus == 'Semesteran')
		{
			$faktorkali = 0.52;
		}
		else if ($carabayarjsdmpplus == 'Kuartalan')
		{
			$faktorkali = 0.27;
		}
		else if ($carabayarjsdmpplus == 'Bulanan')
		{
			$faktorkali = 0.095;
		}
		else if ($carabayarjsdmpplus == 'Sekaligus')
		{
			$faktorkali = 0;
		}
			
		$usiasekarang = $this->input->post("usiasekarang");
		
		if (($usiasekarang <=20) && ($usiasekarang >=17))
		{
			$usiasekarang = 20;	
		}
		
		$result = $this->ModSimulasi->getBiayaAsuransiPerBulanADDB($usiasekarang);
		
		if ($uangasuransijsaddbjsdmpplus < $uangasuransipokok)
		{
			$hasil = "tidak bisa";	
		}
		else if ($uangasuransijsaddbjsdmpplus > (3*$uangasuransipokok))
		{
			$hasil = "tidak bisa";	
		}
		else
		{
			$hasil = round($result[$jeniskelamin] * ($uangasuransijsaddbjsdmpplus / 1000) * $faktorkali);
		}
		
		echo $hasil;
	}
	
	function hitungwpjsdmpplus() {
		$this->load->model('ModSimulasi');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		
		if (($usiasekarang <=20) && ($usiasekarang >=17))
		{
			$usiasekarang = 20;	
		}
		
		$result = $this->ModSimulasi->getPremi5TahunPertamaDMPPlus($masaasuransi, $usiasekarang);
		
		$carabayarjsdmpplus = $this->input->post("carabayarjsdmpplus");
		
		if ($carabayarjsdmpplus == 'Tahunan')
		{
			$faktorkali = 1;
		}
		else if ($carabayarjsdmpplus == 'Semesteran')
		{
			$faktorkali = 0.52;
		}
		else if ($carabayarjsdmpplus == 'Kuartalan')
		{
			$faktorkali = 0.27;
		}
		else if ($carabayarjsdmpplus == 'Bulanan')
		{
			$faktorkali = 0.095;
		}
		else if ($carabayarjsdmpplus == 'Sekaligus')
		{
			$faktorkali = 0;
		}
		
		$hasiltemp = (($uangasuransipokok/1000 * $result['TARIF']) * $faktorkali);
		
		$result2 = $this->ModSimulasi->getPremiTambahanCI('1', $usiasekarang, 'WPC');
		
		echo round((($result2['TARIF']/10000)/100) * $hasiltemp);
		
	}
	
	function hitungspdjsdmpplus() {
		$this->load->model('ModSimulasi');
		
		$usiasekarang = $this->input->post("usiasekarang");
		
		if (($usiasekarang <=20) && ($usiasekarang >=17))
		{
			$usiasekarang = 20;	
		}
		
		$masaasuransi = $this->input->post("masaasuransi");
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		
		$result = $this->ModSimulasi->getPremi5TahunPertamaDMPPlus($masaasuransi, $usiasekarang);
		
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
		
		$carabayarjsdmpplus = $this->input->post("carabayarjsdmpplus");
		
		if ($carabayarjsdmpplus == 'Tahunan')
		{
			$faktorkali = 1;
		}
		else if ($carabayarjsdmpplus == 'Semesteran')
		{
			$faktorkali = 0.52;
		}
		else if ($carabayarjsdmpplus == 'Kuartalan')
		{
			$faktorkali = 0.27;
		}
		else if ($carabayarjsdmpplus == 'Bulanan')
		{
			$faktorkali = 0.095;
		}
		else if ($carabayarjsdmpplus == 'Sekaligus')
		{
			$faktorkali = 0;
		}
		
		$hasil = (($uangasuransipokok/1000 * $result['TARIF']) * ($result2[$jeniskelamin]/100) *$faktorkali);
		
		echo round($hasil);
	}
	
	function hitungsptpdjsdmpplus() {
		$this->load->model('ModSimulasi');
		
		$usiasekarang = $this->input->post("usiasekarang");
		
		if (($usiasekarang <=20) && ($usiasekarang >=17))
		{
			$usiasekarang = 20;	
		}
		
		$masaasuransi = $this->input->post("masaasuransi");
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		
		$result = $this->ModSimulasi->getPremi5TahunPertamaDMPPlus($masaasuransi, $usiasekarang);
		
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
		
		$carabayarjsdmpplus = $this->input->post("carabayarjsdmpplus");
		
		if ($carabayarjsdmpplus == 'Tahunan')
		{
			$faktorkali = 1;
		}
		else if ($carabayarjsdmpplus == 'Semesteran')
		{
			$faktorkali = 0.52;
		}
		else if ($carabayarjsdmpplus == 'Kuartalan')
		{
			$faktorkali = 0.27;
		}
		else if ($carabayarjsdmpplus == 'Bulanan')
		{
			$faktorkali = 0.095;
		}
		else if ($carabayarjsdmpplus == 'Sekaligus')
		{
			$faktorkali = 0;
		}
		
		$hasil = (($uangasuransipokok/1000 * $result['TARIF']) * ($result2[$jeniskelamin]/100) *$faktorkali);
		
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
			'tabelpremisemesteran' => $this->input->post('tabelpremisemesteran'),
			'tabelpremikuartalan' => $this->input->post('tabelpremikuartalan'),
			'tabelpremibulanan' => $this->input->post('tabelpremibulanan'),
			
			'tabelrider5tahunpertama' => $this->input->post('tabelrider5tahunpertama'),
			'tabelridersemesteran' => $this->input->post('tabelridersemesteran'),
			'tabelriderkuartalan' => $this->input->post('tabelriderkuartalan'),
			'tabelriderbulanan' => $this->input->post('tabelriderbulanan'),
			
			'tabelriderpremi5tahunpertama' => $this->input->post('tabelriderpremi5tahunpertama'),
			'tabelriderpremisemesteran' => $this->input->post('tabelriderpremisemesteran'),
			'tabelriderpremikuartalan' => $this->input->post('tabelriderpremikuartalan'),
			'tabelriderpremibulanan' => $this->input->post('tabelriderpremibulanan'),
			
			'uangasuransihcpjsdmpplus' => $this->input->post('uangasuransihcpjsdmpplus'),
			'uangasuransihcpbjsdmpplus' => $this->input->post('uangasuransihcpbjsdmpplus'),
			
			'uangasuransijstpdjsdmpplus' => $this->input->post('uangasuransijstpdjsdmpplus'),
			'uangasuransici53jsdmpplus' => $this->input->post('uangasuransici53jsdmpplus'),
			'uangasuransijsaddbjsdmpplus' => $this->input->post('uangasuransijsaddbjsdmpplus'),
			
			'premijstpdjsdmpplus' => $this->input->post('premijstpdjsdmpplus'),
			'premiwpjsdmpplus' => $this->input->post('premiwpjsdmpplus'),
			'premici53jsdmpplus' => $this->input->post('premici53jsdmpplus'),
			'premijsaddbjsdmpplus' => $this->input->post('premijsaddbjsdmpplus'),
			'premijsspdjsdmpplus' => $this->input->post('premijsspdjsdmpplus'),
			'premijssptpdjsdmpplus' => $this->input->post('premijssptpdjsdmpplus'),
			
			'carabayarjsdmpplus' => $this->input->post('carabayarjsdmpplus'),
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
		
		$data['hasil']['carabayarjsdmpplus'] = $this->session->userdata('carabayarjsdmpplus');
		
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
		
		$data['hasil']['filepdf'] = $this->session->userdata('filepdf');
		$data['hasil']['id_nasabah'] = $this->session->userdata('id_nasabah');
		$data['hasil']['id_agen']	 = $this->session->userdata('id_agen');
		//$data['hasil']['file_pdf']	 = $filePdf.'.pdf',
		$data['hasil']['id_produk']  = $this->session->userdata('id_produk');
		
		$data['hasil']['tabelpremisekaligus']  = $this->session->userdata('tabelpremisekaligus');
		$data['hasil']['tabelpremi5tahunpertama']  = $this->session->userdata('tabelpremi5tahunpertama');
		$data['hasil']['tabelpremisemesteran']  = $this->session->userdata('tabelpremisemesteran');
		$data['hasil']['tabelpremikuartalan']  = $this->session->userdata('tabelpremikuartalan');
		$data['hasil']['tabelpremibulanan']  = $this->session->userdata('tabelpremibulanan');
		
		$data['hasil']['tabelrider5tahunpertama']  = $this->session->userdata('tabelrider5tahunpertama');
		$data['hasil']['tabelridersemesteran']  = $this->session->userdata('tabelridersemesteran');
		$data['hasil']['tabelriderkuartalan']  = $this->session->userdata('tabelriderkuartalan');
		$data['hasil']['tabelriderbulanan']  = $this->session->userdata('tabelriderbulanan');
		
		$data['hasil']['tabelriderpremi5tahunpertama']  = $this->session->userdata('tabelriderpremi5tahunpertama');
		$data['hasil']['tabelriderpremisemesteran']  = $this->session->userdata('tabelriderpremisemesteran');
		$data['hasil']['tabelriderpremikuartalan']  = $this->session->userdata('tabelriderpremikuartalan');
		$data['hasil']['tabelriderpremibulanan']  = $this->session->userdata('tabelriderpremibulanan');
			
		$idx = ($data['hasil']['usiacalontertanggung'] * 100) + ($data['hasil']['masaasuransi']);  
		$resultsekaligus = $this->ModSimulasi->GetPremiSekaligusNilaiTebusJSDMPPlus($idx);
		$data['hasil']['nilaitebusekaligus1'] = (($resultsekaligus['NILAITEBUS1']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebusekaligus2'] = (($resultsekaligus['NILAITEBUS2']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebusekaligus3'] = (($resultsekaligus['NILAITEBUS3']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebusekaligus4'] = (($resultsekaligus['NILAITEBUS4']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebusekaligus5'] = (($resultsekaligus['NILAITEBUS5']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebusekaligus6'] = (($resultsekaligus['NILAITEBUS6']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebusekaligus7'] = (($resultsekaligus['NILAITEBUS7']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebusekaligus8'] = (($resultsekaligus['NILAITEBUS8']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebusekaligus9'] = (($resultsekaligus['NILAITEBUS9']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebusekaligus10'] = (($resultsekaligus['NILAITEBUS10']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebusekaligus11'] = (($resultsekaligus['NILAITEBUS11']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebusekaligus12'] = (($resultsekaligus['NILAITEBUS12']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebusekaligus13'] = (($resultsekaligus['NILAITEBUS13']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebusekaligus14'] = (($resultsekaligus['NILAITEBUS14']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebusekaligus15'] = (($resultsekaligus['NILAITEBUS15']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebusekaligus16'] = (($resultsekaligus['NILAITEBUS16']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebusekaligus17'] = (($resultsekaligus['NILAITEBUS17']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebusekaligus18'] = (($resultsekaligus['NILAITEBUS18']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebusekaligus19'] = (($resultsekaligus['NILAITEBUS19']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebusekaligus20'] = (($resultsekaligus['NILAITEBUS20']) * ($data['hasil']['uangasuransipokok'] / 1000));
		
		$data['hasil']['nilaitunaipolissekaligusmax'] = max(	$data['hasil']['nilaitebusekaligus1'],	$data['hasil']['nilaitebusekaligus2'], 	$data['hasil']['nilaitebusekaligus3'],
											$data['hasil']['nilaitebusekaligus4'], 	$data['hasil']['nilaitebusekaligus5'], 	$data['hasil']['nilaitebusekaligus6'],
											$data['hasil']['nilaitebusekaligus7'], 	$data['hasil']['nilaitebusekaligus8'], 	$data['hasil']['nilaitebusekaligus9'],
											$data['hasil']['nilaitebusekaligus10'], $data['hasil']['nilaitebusekaligus11'], $data['hasil']['nilaitebusekaligus12'],
											$data['hasil']['nilaitebusekaligus13'], $data['hasil']['nilaitebusekaligus14'], $data['hasil']['nilaitebusekaligus15'],
											$data['hasil']['nilaitebusekaligus16'], $data['hasil']['nilaitebusekaligus17'], $data['hasil']['nilaitebusekaligus18'],
											$data['hasil']['nilaitebusekaligus19'], $data['hasil']['nilaitebusekaligus20']	); 
		
		$resulttahunan = $this->ModSimulasi->GetPremiTahunanNilaiTebusJSDMPPlus($idx);
		$data['hasil']['nilaitebustahunan1'] = (($resulttahunan['NILAITEBUS1']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebustahunan2'] = (($resulttahunan['NILAITEBUS2']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebustahunan3'] = (($resulttahunan['NILAITEBUS3']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebustahunan4'] = (($resulttahunan['NILAITEBUS4']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebustahunan5'] = (($resulttahunan['NILAITEBUS5']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebustahunan6'] = (($resulttahunan['NILAITEBUS6']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebustahunan7'] = (($resulttahunan['NILAITEBUS7']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebustahunan8'] = (($resulttahunan['NILAITEBUS8']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebustahunan9'] = (($resulttahunan['NILAITEBUS9']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebustahunan10'] = (($resulttahunan['NILAITEBUS10']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebustahunan11'] = (($resulttahunan['NILAITEBUS11']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebustahunan12'] = (($resulttahunan['NILAITEBUS12']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebustahunan13'] = (($resulttahunan['NILAITEBUS13']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebustahunan14'] = (($resulttahunan['NILAITEBUS14']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebustahunan15'] = (($resulttahunan['NILAITEBUS15']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebustahunan16'] = (($resulttahunan['NILAITEBUS16']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebustahunan17'] = (($resulttahunan['NILAITEBUS17']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebustahunan18'] = (($resulttahunan['NILAITEBUS18']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebustahunan19'] = (($resulttahunan['NILAITEBUS19']) * ($data['hasil']['uangasuransipokok'] / 1000));
		$data['hasil']['nilaitebustahunan20'] = (($resulttahunan['NILAITEBUS20']) * ($data['hasil']['uangasuransipokok'] / 1000));
		
		$data['hasil']['nilaitunaipolistahunanmax'] = max(	$data['hasil']['nilaitebustahunan1'],	$data['hasil']['nilaitebustahunan2'], 	$data['hasil']['nilaitebustahunan3'],
											$data['hasil']['nilaitebustahunan4'], $data['hasil']['nilaitebustahunan5'], 	$data['hasil']['nilaitebustahunan6'],
											$data['hasil']['nilaitebustahunan7'], $data['hasil']['nilaitebustahunan8'], 	$data['hasil']['nilaitebustahunan9'],
											$data['hasil']['nilaitebustahunan10'], $data['hasil']['nilaitebustahunan11'], $data['hasil']['nilaitebustahunan12'],
											$data['hasil']['nilaitebustahunan13'], $data['hasil']['nilaitebustahunan14'], $data['hasil']['nilaitebustahunan15'],
											$data['hasil']['nilaitebustahunan16'], $data['hasil']['nilaitebustahunan17'], $data['hasil']['nilaitebustahunan18'],
											$data['hasil']['nilaitebustahunan19'], $data['hasil']['nilaitebustahunan20']	); 

		
		$result = $this->ModSimulasi->getPremi5TahunPertamaDMPPlus($data['hasil']['masaasuransi'], $data['hasil']['usiacalontertanggung']);
		
		$data['hasil']['tabelpremi5tahunberikutnya'] = ($data['hasil']['uangasuransipokok']/1000 * $result['TARIF']);
		
		$data['hasil']['premitahunansum'] = ((5 * $data['hasil']['tabelpremi5tahunpertama']) + (($data['hasil']['masaasuransi'] - 5) * ($data['hasil']['tabelpremi5tahunberikutnya'])));
		
		//$data['hasil']['filepdf'] = $filepdf;
		$data['hasil']['nama'] = $this->session->userdata('nama');
		$data['hasil']['namaagen'] = strtoupper(str_replace("-"," ",$this->session->userdata('namaagen')));
		$kodeKantor = $DataAgen['KDKANTOR'];
		$dataKantor = $this->ModSimulasi->cariDataKantor($kodeKantor);
		$data['hasil']['kantorcabang'] = $dataKantor['NAMAKANTOR'];
		$data['hasil']['nomeragen'] = $this->session->userdata('nomeragen');
		
		$data['hasil']['uangasuransihcpjsdmpplus'] = $this->session->userdata('uangasuransihcpjsdmpplus');
		
		if ($data['hasil']['uangasuransihcpjsdmpplus'] == 1)
		{
			$data['hasil']['ri'] = 100000;
			$data['hasil']['icu'] = 200000;
		}
		else if ($data['hasil']['uangasuransihcpjsdmpplus'] == 2)
		{
			$data['hasil']['ri'] = 200000;	
			$data['hasil']['icu'] = 400000;
		}
		else if ($data['hasil']['uangasuransihcpjsdmpplus'] == 3)
		{
			$data['hasil']['ri'] = 300000;
			$data['hasil']['icu'] = 600000;
		}
		else if ($data['hasil']['uangasuransihcpjsdmpplus'] == 4)
		{
			$data['hasil']['ri'] = 400000;
			$data['hasil']['icu'] = 800000;
		}
		else if ($data['hasil']['uangasuransihcpjsdmpplus'] == 5)
		{
			$data['hasil']['ri'] = 500000;	
			$data['hasil']['icu'] = 1000000;
		}
		
		$data['hasil']['uangasuransihcpbjsdmpplus'] = $this->session->userdata('uangasuransihcpbjsdmpplus');
		
		if ($data['hasil']['uangasuransihcpbjsdmpplus'] == 1)
		{
			$data['hasil']['bedah'] = 1000000;
		}
		else if ($data['hasil']['uangasuransihcpbjsdmpplus'] == 2)
		{
			$data['hasil']['bedah'] = 2000000;	
		}
		else if ($data['hasil']['uangasuransihcpbjsdmpplus'] == 3)
		{
			$data['hasil']['bedah'] = 3000000;
		}
		else if ($data['hasil']['uangasuransihcpbjsdmpplus'] == 4)
		{
			$data['hasil']['bedah'] = 4000000;
		}
		else if ($data['hasil']['uangasuransihcpbjsdmpplus'] == 5)
		{
			$data['hasil']['bedah'] = 5000000;	
		}
		
		$data['hasil']['premijstpdjsdmpplus'] = $this->session->userdata('premijstpdjsdmpplus');
		$data['hasil']['premiwpjsdmpplus'] = $this->session->userdata('premiwpjsdmpplus');
		$data['hasil']['premici53jsdmpplus'] = $this->session->userdata('premici53jsdmpplus');
		$data['hasil']['premijsaddbjsdmpplus'] = $this->session->userdata('premijsaddbjsdmpplus');
		$data['hasil']['premijsspdjsdmpplus'] = $this->session->userdata('premijsspdjsdmpplus');
		$data['hasil']['premijssptpdjsdmpplus'] = $this->session->userdata('premijssptpdjsdmpplus');
		
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
			'CARA_BAYAR' => $this->session->userdata('carabayarjsdmpplus'),
			'JUMLAH_PREMI' => $data['hasil']['uangasuransipokok']
		);
		
		$this->ModSimulasi->insertSimulasi($data['hitung']);
		
		$data['hasil']['build_id'] = $data['hitung']['BUILD_ID'];
				
		$filePdf = $this->session->userdata('filepdf');
		
		$this->createPDF($filePdf,$data);
		
		$this->load->view('hasil/jsdmpplus',$data);
		
		//$this->session->sess_destroy();
	}

	function createPDF($namaFile,$data){
		$image1 = FCPATH.'assets/img/logo-js.png';
		
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
		$this->pdf->Cell(190,5,'JS Dana Multi Proteksi','B',0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(10);
		
		//MANFAAT
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(50,0,255);
		$this->pdf->Cell(190,5,'A. DATA PERTANGGUNGAN',0,0,'L');
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Nama Calon Tertanggung',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(32,5,''.$data['hasil']['namalengkapcalontertanggung'].' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Usia Calon',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(32,5,''.$data['hasil']['usiacalontertanggung'].' Tahun',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Masa Asuransi',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(32,5,''.$data['hasil']['masaasuransi'].' Tahun',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Uang Asuransi',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Saat Mulai',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(32,5,$data['hasil']['saatmulaiasuransi'],0,0,'L');
		$this->pdf->ln(10);
		
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(50,0,255);
		$this->pdf->Cell(190,5,'B. MANFAAT ASURANSI',0,0,'L');
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(255,0,0);
		$this->pdf->Cell(50,5,'1. Manfaat Akhir Masa Asuransi',0,0,'L');
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Apabila Tertanggung hidup pada akhir masa asuransi, maka dibayarkan sebesar 300% Uang Asuransi atau sebesar:',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),0,0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(255,0,0);
		$this->pdf->Cell(50,5,'2. Manfaat Santunan Meninggal Dunia',0,0,'L');
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Apabila Tertanggung meninggal dunia dalam masa asuransi karena sebab apapun yang tidak dikecualikan dalam Syarat',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Umum Polis (SUP), maka akan dibayarkan sebesar 300% dari Uang Asuransi atau sebesar: Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),0,0,'L');
		$this->pdf->ln(10);
	
		/*
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(255,0,0);
		$this->pdf->Cell(50,5,'3. SANTUNAN KELUARGA',0,0,'L');
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Jika Tertanggung meninggal dunia dalam masa asuransi, maka ahli waris akan menerima santunan setiap bulan sebesar 1% Uang Asuransi yang',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'dibayarkan bulan berikutnya sampai dengan akhir masa asuransi',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'atau sebesar : Rp. '.number_format(((1/100)*$data['hasil']['uangasuransipokok']),0,'.',',').' / bulan',0,0,'L');
		$this->pdf->ln();
		*/
		
		/*
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(50,0,255);
		$this->pdf->Cell(190,5,'C. JAMINAN TAMBAHAN (RIDER)',0,0,'L');
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->ln();
		if ($data['hasil']['premijsaddbjsdmpplus'] != 0)
        {
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->Cell(50,5,'JS ADDB',0,0,'L');
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Apabila Tertanggung meninggal dunia atau cacat karena kecelakaan, maka akan dibayarkan 100% Uang Asuransi JS ADDB atau sesuai faktor',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'untuk cacat tetap sebagian : Rp. '.number_format(($data['hasil']['uangasuransijsaddbjsdmpplus']),0,'.',','),0,0,'L');
		}
		if ($data['hasil']['premijstpdjsdmpplus'] != 0)
        {
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->Cell(50,5,'JS TPD',0,0,'L');
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Apabila Tertanggung mengalami cacat tetap total karena sakit atau kecelakaan, maka akan dibayar 100% Uang Asuransi JS TPD : Rp.'.number_format(($data['hasil']['uangasuransijstpdjsdmpplus']),0,'.',','),0,0,'L');
		}
		if ($data['hasil']['premiwpjsdmpplus'] != 0)
        {
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->Cell(50,5,'JS Waiver Premium',0,0,'L');
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Apabila Tertanggung mengalami cacat tetap total karena sakit atau kecelakaan, maka akan dibebaskan dari kewajiban membayar premi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Dan tetap akan menerima manfaat diakhir kontrak sesuai yang tertera didalam Polis.',0,0,'L');
		}
		if ($data['hasil']['premici53jsdmpplus'] != 0)
        {
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->Cell(50,5,'JS CI53',0,0,'L');
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Apabila Tertanggung diDiagnosa untuk pertama kali mengalami  satu dari 53 Penyakit Kritis maka kepada tertanggung akan dibayarkan ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'100% Uang Asuransi JS CI53.',0,0,'L');
		}
		if ($data['hasil']['premijsspdjsdmpplus'] != 0)
        {
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->Cell(50,5,'JS SP - Death',0,0,'L');
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Apabila Pemegang Polis meninggal dunia, maka Tertanggung akan dibebaskan dari kewajiban pembayaran premi.',0,0,'L');
		}
		if ($data['hasil']['premijssptpdjsdmpplus'] != 0)
        {
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->Cell(50,5,'JS SP - TPD',0,0,'L');
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Apabila Pemegang Polis mengalami cacat tetap total, maka Tertanggung akan dibebaskan dari kewajiban pembayaran premi.',0,0,'L');
		}
		if ($data['hasil']['ri'] != '')
        {
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->Cell(50,5,'JS HCP',0,0,'L');
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Apabila Tertanggung dirawat di Rumah Sakit maka akan dibayarkan santunan harian sesuai dengan plan yang dipilih : Rp.'.number_format(($data['hasil']['ri']),0,'.',','),0,0,'L');
		}
		if ($data['hasil']['icu'] != '')
        {
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Apabila Tertanggung dirawat di ICU maka akan dibayarkan santunan harian sesuai dengan plan yang dipilih : Rp.'.number_format(($data['hasil']['icu']),0,'.',','),0,0,'L');
		$this->pdf->ln();
		}
		if ($data['hasil']['bedah'] != '')
        {
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Apabila Tertanggung memerlukan tindakan pembedahan, maka akan dibayarkan santunan sesuai dengan plan yang dipilih : Rp.'.number_format(($data['hasil']['bedah']),0,'.',','),0,0,'L');
		}
		
		*/
		
		/*
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(50,0,255);
		$this->pdf->Cell(190,5,'D. PERHITUNGAN PREMI',0,0,'L');
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(31,78,120);
		$this->pdf->Cell(47.5,5,'CARA BAYAR',1,0,'C', true);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(47.5,5,'PREMI POKOK',1,0,'C', true);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(47.5,5,'RIDER',1,0,'C', true);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(47.5,5,'PREMI+RIDER',1,0,'C', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
//		$this->pdf->Cell(47.5,5,'Premi Sekaligus',1,0,'C', true);
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(47.5,5,number_format($data['hasil']['tabelpremisekaligus'],0,'.',','),1,0,'C', true);
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(47.5,5,'',1,0,'C', true);
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(47.5,5,'',1,0,'C', true);
//		$this->pdf->ln();
		$this->pdf->Cell(47.5,5,'Premi 5 thn Pertama',1,0,'C', true);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['tabelpremi5tahunpertama'],0,'.',','),1,0,'C', true);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['tabelrider5tahunpertama'],0,'.',','),1,0,'C', true);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['tabelriderpremi5tahunpertama'],0,'.',','),1,0,'C', true);
		$this->pdf->ln();
		$this->pdf->Cell(47.5,5,'Premi Semesteran',1,0,'C', true);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['tabelpremisemesteran'],0,'.',','),1,0,'C', true);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['tabelridersemesteran'],0,'.',','),1,0,'C', true);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['tabelriderpremisemesteran'],0,'.',','),1,0,'C', true);
		$this->pdf->ln();
		$this->pdf->Cell(47.5,5,'Premi Kuartalan',1,0,'C', true);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['tabelpremikuartalan'],0,'.',','),1,0,'C', true);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['tabelriderkuartalan'],0,'.',','),1,0,'C', true);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['tabelriderpremikuartalan'],0,'.',','),1,0,'C', true);
		$this->pdf->ln();
		$this->pdf->Cell(47.5,5,'Premi Bulanan',1,0,'C', true);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['tabelpremibulanan'],0,'.',','),1,0,'C', true);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['tabelriderbulanan'],0,'.',','),1,0,'C', true);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['tabelriderpremibulanan'],0,'.',','),1,0,'C', true);				
		$this->pdf->ln(20);
		*/
		
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(50,0,255);
		$this->pdf->Cell(190,5,'C. PEMBAYARAN PREMI',0,0,'L');
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
//		$this->pdf->Cell(47.5,5,'Premi Sekaligus',1,0,'C', true);
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(47.5,5,number_format($data['hasil']['tabelpremisekaligus'],0,'.',','),1,0,'C', true);
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(47.5,5,'',1,0,'C', true);5
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(47.5,5,'',1,0,'C', true);
//		$this->pdf->ln();
		$this->pdf->Cell(47.5,5,'Premi '.$data['hasil']['carabayarjsdmpplus'].' 5 Tahun Pertama',0,0,'L');
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(67.5,5,'Rp. '.number_format($data['hasil']['tabelpremi5tahunpertama'],0,'.',','),0,0,'C');
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(37.5,5,'',0,0,'C');
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(37.5,5,'',0,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
//		$this->pdf->Cell(47.5,5,'Premi Sekaligus',1,0,'C', true);
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(47.5,5,number_format($data['hasil']['tabelpremisekaligus'],0,'.',','),1,0,'C', true);
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(47.5,5,'',1,0,'C', true);
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(47.5,5,'',1,0,'C', true);
//		$this->pdf->ln();
		$this->pdf->Cell(47.5,5,'Premi '.$data['hasil']['carabayarjsdmpplus'].' 6 Tahun dan Seterusnya',0,0,'L');
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(67.5,5,'Rp. '.number_format($data['hasil']['tabelpremisekaligus'],0,'.',','),0,0,'C');
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(37.5,5,'',0,0,'C');
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(37.5,5,'',0,0,'C');
		$this->pdf->ln(95);
		
		
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
		$this->pdf->Cell(29,5,''.str_replace('KANTOR CABANG','', $data['hasil']['kantorcabang']).' ',0,0,'L');
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
		
		/*
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
		$this->pdf->Cell(190,5,'JS Dana Multi Proteksi Plus','B',0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(10);
		
		//MANFAAT
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(190,5,'PERBANDINGAN PENGEMBANGAN DANA MULTI PROTEKSI',0,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'CARA PEMBAYARAN PREMI SEKALIGUS DENGAN PREMI TAHUNAN',0,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'VALUTA RUPIAH',0,0,'C');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Nama Calon Tertanggung',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(32,5,''.$data['hasil']['namalengkapcalontertanggung'].' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Usia Calon',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(32,5,''.$data['hasil']['usiacalontertanggung'].' Tahun',0,0,'L');
		$this->pdf->ln(10);
		
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(31,78,120);
		$this->pdf->Cell(20,5,'Akhir','LTR',0,'C', true);
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(85,5,'PREMI SEKALIGUS',1,0,'C', true);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(85,5,'PREMI TAHUNAN',1,0,'C', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(20,5,'Tahun','LR',0,'C', true);
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(28.33,5,'Premi','LTR',0,'C', true);
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(28.33,5,'Nilai Tunai Polis','LTR',0,'C', true);
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(28.33,5,'Santunan','LTR',0,'C', true);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(28.33,5,'Premi','LTR',0,'C', true);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(28.33,5,'Nilai Tunai Polis','LTR',0,'C', true);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(28.33,5,'Santunan','LTR',0,'C', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(20,5,'Ke','LBR',0,'C', true);
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(28.33,5,'','LBR',0,'C', true);
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(28.33,5,'','LBR',0,'C', true);
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(28.33,5,'Meninggal','LBR',0,'C', true);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(28.33,5,'','LBR',0,'C', true);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(28.33,5,'','LBR',0,'C', true);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(28.33,5,'Meninggal','LBR',0,'C', true);
		$this->pdf->SetTextColor(0,0,0);
		
		//1
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(20,5,'1','LTR',0,'C');
		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['tabelpremisekaligus'],0,'.',','),'LTR',0,'C');
		$this->pdf->SetFont('Arial','',10);
		if (($data['hasil']['nilaitebusekaligus1']) > 0)
		{
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebusekaligus1'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['tabelpremi5tahunpertama'],0,'.',','),'LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebustahunan1'],0,'.',','),'LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
		}
		else
		{
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
		}
		
		//2
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(20,5,'2','LR',0,'C');
		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(28.33,5,'','LR',0,'C');
		$this->pdf->SetFont('Arial','',10);
		if (($data['hasil']['nilaitebusekaligus2']) > 0)
		{
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebusekaligus2'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['tabelpremi5tahunpertama'],0,'.',','),'LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebustahunan2'],0,'.',','),'LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
		}
		else
		{
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
		}
		
		//3
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(20,5,'3','LR',0,'C');
		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(28.33,5,'','LR',0,'C');
		$this->pdf->SetFont('Arial','',10);
		if (($data['hasil']['nilaitebusekaligus3']) > 0)
		{
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebusekaligus3'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['tabelpremi5tahunpertama'],0,'.',','),'LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebustahunan3'],0,'.',','),'LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
		}
		else
		{
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
		}
		
		//4
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(20,5,'4','LR',0,'C');
		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(28.33,5,'','LR',0,'C');
		$this->pdf->SetFont('Arial','',10);
		if (($data['hasil']['nilaitebusekaligus4']) > 0)
		{
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebusekaligus4'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['tabelpremi5tahunpertama'],0,'.',','),'LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebustahunan4'],0,'.',','),'LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
		}
		else
		{
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
		}
		
		//5
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(20,5,'5','LR',0,'C');
		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(28.33,5,'','LR',0,'C');
		$this->pdf->SetFont('Arial','',10);
		if (($data['hasil']['nilaitebusekaligus5']) > 0)
		{
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebusekaligus5'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['tabelpremi5tahunpertama'],0,'.',','),'LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebustahunan5'],0,'.',','),'LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
		}
		else
		{
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
		}
		
		//6
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(20,5,'6','LR',0,'C');
		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(28.33,5,'','LR',0,'C');
		$this->pdf->SetFont('Arial','',10);
		if (($data['hasil']['nilaitebusekaligus6']) > 0)
		{
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebusekaligus6'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['tabelpremi5tahunberikutnya'],0,'.',','),'LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebustahunan6'],0,'.',','),'LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
		}
		else
		{
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
		}
		
		//7
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(20,5,'6','LR',0,'C');
		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(28.33,5,'','LR',0,'C');
		$this->pdf->SetFont('Arial','',10);
		if (($data['hasil']['nilaitebusekaligus7']) > 0)
		{
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebusekaligus7'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['tabelpremi5tahunberikutnya'],0,'.',','),'LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebustahunan7'],0,'.',','),'LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
		}
		else
		{
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
		}
		
		//8
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(20,5,'8','LR',0,'C');
		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(28.33,5,'','LR',0,'C');
		$this->pdf->SetFont('Arial','',10);
		if (($data['hasil']['nilaitebusekaligus8']) > 0)
		{
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebusekaligus8'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['tabelpremi5tahunberikutnya'],0,'.',','),'LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebustahunan8'],0,'.',','),'LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
		}
		else
		{
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
		}
		
		//9
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(20,5,'6','LR',0,'C');
		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(28.33,5,'','LR',0,'C');
		$this->pdf->SetFont('Arial','',10);
		if (($data['hasil']['nilaitebusekaligus9']) > 0)
		{
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebusekaligus9'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['tabelpremi5tahunberikutnya'],0,'.',','),'LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebustahunan9'],0,'.',','),'LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
		}
		else
		{
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
		}
		
		//10
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(20,5,'10','LR',0,'C');
		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(28.33,5,'','LR',0,'C');
		$this->pdf->SetFont('Arial','',10);
		if (($data['hasil']['nilaitebusekaligus10']) > 0)
		{
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebusekaligus10'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['tabelpremi5tahunberikutnya'],0,'.',','),'LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebustahunan10'],0,'.',','),'LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
		}
		else
		{
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
		}
		
//		//11
//		$this->pdf->ln();
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(20,5,'11','LR',0,'C');
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(28.33,5,'','LR',0,'C');
//		$this->pdf->SetFont('Arial','',10);
//		if (($data['hasil']['nilaitebusekaligus11']) > 0)
//		{
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebusekaligus11'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['tabelpremi5tahunberikutnya'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebustahunan11'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
//		}
//		else
//		{
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//		}
//		
//		//12
//		$this->pdf->ln();
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(20,5,'12','LR',0,'C');
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(28.33,5,'','LR',0,'C');
//		$this->pdf->SetFont('Arial','',10);
//	if (($data['hasil']['nilaitebusekaligus12']) > 0)
//		{
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebusekaligus12'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['tabelpremi5tahunberikutnya'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebustahunan12'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
//		}
//		else
//		{
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//		}
//		
//		//13
//		$this->pdf->ln();
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(20,5,'13','LR',0,'C');
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(28.33,5,'','LR',0,'C');
//		$this->pdf->SetFont('Arial','',10);
//		if (($data['hasil']['nilaitebusekaligus13']) > 0)
//		{
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebusekaligus13'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['tabelpremi5tahunberikutnya'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebustahunan13'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
//		}
//		else
//		{
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//		}
//		
//		//14
//		$this->pdf->ln();
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(20,5,'14','LR',0,'C');
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(28.33,5,'','LR',0,'C');
//		$this->pdf->SetFont('Arial','',10);
//		if (($data['hasil']['nilaitebusekaligus14']) > 0)
//		{
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebusekaligus14'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['tabelpremi5tahunberikutnya'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebustahunan14'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
//		}
//		else
//		{
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//		}
//		
//		//15
//		$this->pdf->ln();
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(20,5,'15','LR',0,'C');
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(28.33,5,'','LR',0,'C');
//		$this->pdf->SetFont('Arial','',10);
//		if (($data['hasil']['nilaitebusekaligus15']) > 0)
//		{
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebusekaligus15'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['tabelpremi5tahunberikutnya'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebustahunan15'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
//		}
//		else
//		{
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//		}
//		
//		//16
//		$this->pdf->ln();
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(20,5,'16','LR',0,'C');
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(28.33,5,'','LR',0,'C');
//		$this->pdf->SetFont('Arial','',10);
//		if (($data['hasil']['nilaitebusekaligus16']) > 0)
//		{
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebusekaligus16'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['tabelpremi5tahunberikutnya'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebustahunan16'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
//		}
//		else
//		{
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//		}
//		
//		//17
//		$this->pdf->ln();
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(20,5,'17','LR',0,'C');
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(28.33,5,'','LR',0,'C');
//		$this->pdf->SetFont('Arial','',10);
//		if (($data['hasil']['nilaitebusekaligus17']) > 0)
//		{
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebusekaligus17'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['tabelpremi5tahunberikutnya'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebustahunan17'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
//		}
//		else
//		{
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//		}
//		
//		//18
//		$this->pdf->ln();
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(20,5,'18','LR',0,'C');
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(28.33,5,'','LR',0,'C');
//		$this->pdf->SetFont('Arial','',10);
//		if (($data['hasil']['nilaitebusekaligus18']) > 0)
//		{
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebusekaligus18'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['tabelpremi5tahunberikutnya'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebustahunan18'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
//		}
//		else
//		{
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//		}
//		
//		//19
//		$this->pdf->ln();
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(20,5,'19','LR',0,'C');
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(28.33,5,'','LR',0,'C');
//		$this->pdf->SetFont('Arial','',10);
//		if (($data['hasil']['nilaitebusekaligus19']) > 0)
//		{
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebusekaligus19'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['tabelpremi5tahunberikutnya'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebustahunan19'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
//		}
//		else
//		{
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//		}
//		
//		//20
//		$this->pdf->ln();
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(20,5,'20','LR',0,'C');
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(28.33,5,'','LR',0,'C');
//		$this->pdf->SetFont('Arial','',10);
//		if (($data['hasil']['nilaitebusekaligus16']) > 0)
//		{
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebusekaligus20'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['tabelpremi5tahunberikutnya'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitebustahunan20'],0,'.',','),'LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),'LR',0,'C');
//		}
//		else
//		{
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//			$this->pdf->Cell(28.33,5,'Rp. -','LR',0,'C');
//		}
		
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(20,5,'',1,0,'C');
//		$this->pdf->SetFont('Arial','B',10);
//		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['tabelpremisekaligus'],0,'.',','),1,0,'C');
//		$this->pdf->SetFont('Arial','B',10);
//		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitunaipolissekaligusmax'],0,'.',','),1,0,'C');
//		$this->pdf->SetFont('Arial','B',10);
//		$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),1,0,'C');
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['premitahunansum'],0,'.',','),1,0,'C');
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['nilaitunaipolistahunanmax'],0,'.',','),1,0,'C');
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(28.33,5,'Rp. '.number_format((3*$data['hasil']['uangasuransipokok']),0,'.',','),1,0,'C');
		
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Keterangan',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(50,5,'Besar manfaat santunan Keluarga yang diterima ahli waris jika tertanggung meninggal dunia adalah sebesar 1% UA',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(50,5,'setiap bulan sampai dengan akhir masa asuransi atau sebesar : Rp. '.number_format(((1/100)*$data['hasil']['uangasuransipokok']),0,'.',',').' / Bulan',0,0,'L');
		$this->pdf->ln(60);
		
		// FOOTER
		$this->pdf->Cell(190,5,'','B',0,'L');
		$this->pdf->ln(10);

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(13,5,'Disajikan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,5,''.$data['hasil']['namaagen'].' ',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(13,5,'Kode Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,5,''.$data['hasil']['nomeragen'].' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(40,5,'Tanda Tangan Agen','LTR',0,'C');
		$this->pdf->Cell(40,5,'Tanda Tangan Calon Pemegang Polis','LTR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(13,5,'Tanggal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,5,''.$data['hasil']['tanggalsekarang'].' ',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(13,5,'Kantor Cabang',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,5,''.str_replace('KANTOR CABANG','', $data['hasil']['kantorcabang']).' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(40,5,'','LR',0,'C');
		$this->pdf->Cell(40,5,'','LR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(13,5,'Build ID',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,5,$data['hasil']['buildID'],0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(13,5,'',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,'',0,0,'L');
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,5,''.$data['hasil'][''].' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(40,5,'','LBR',0,'C');
		$this->pdf->Cell(40,5,'','LBR',0,'C');
		
		$this->pdf->ln(10);
		$this->pdf->AliasNbPages('{totalPages}');
		$this->pdf->Cell(190, 5, "Page " . $this->pdf->PageNo() . "/{totalPages}",' ', 0, 'R');
		*/
		
		// PAGE 3
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
		$this->pdf->Cell(190,5,'JS Dana Multi Proteksi Plus','B',0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(10);
		
		// DISAJIKAN OLEH
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(190,5,'DISAJIKAN OLEH',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Nama Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(32,5,''.$data['hasil']['namaagen'].' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Nomor Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(32,5,''.$data['hasil']['nomeragen'].' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Tanggal Proposal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(32,5,''.$data['hasil']['tanggalsekarang'].' ',0,0,'L');
		$this->pdf->ln(20);

		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(95,5,'TANDA TANGAN AGEN',0,0,'L');
		$this->pdf->Cell(95,5,'TANDA TANGAN CALON PEMEGANG POLIS',0,0,'L');
		$this->pdf->ln(50);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(95,5,''.$data['hasil']['namaagen'].' ',0,0,'L');
		$this->pdf->Cell(95,5,''.$data['hasil']['nama'].' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','I',8);
		$this->pdf->Cell(95,5,'Saya telah menjelaskan Ilustrasi ini kepada Calon Pemegang Polis',0,0,'L');
		$this->pdf->Cell(95,5,'Saya telah membaca, memahami dan mengerti resiko dan isi dari ilustrasi ini.',0,0,'L');
		$this->pdf->ln(95);
		
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
		$this->pdf->Cell(29,5,''.str_replace('KANTOR CABANG','', $data['hasil']['kantorcabang']).' ',0,0,'L');
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