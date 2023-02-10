<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");
	
	error_reporting(0);

class Jsdwiguna extends CI_Controller{
	
	function hitungjshcpdwiguna(){
		$this->load->model('ModSimulasi');
		
		$uangasuransihcpjsdwiguna = $this->input->post("uangasuransihcpjsdwiguna");
		
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
		
		$result = $this->ModSimulasi->getBiayaAsuransiPerBulanHCPDwigunaMenaik($usiasekarang, $uangasuransihcpjsdwiguna, $jeniskelamin);
		
		$carabayarjsdwiguna = $this->input->post("carabayarjsdwiguna");
		
		if ($carabayarjsdwiguna == 'Tahunan')
		{
			$faktorkali = 1;
		}
		else if ($carabayarjsdwiguna == 'Semesteran')
		{
			$faktorkali = 0.52;
		}
		else if ($carabayarjsdwiguna == 'Kuartalan')
		{
			$faktorkali = 0.27;
		}
		else if ($carabayarjsdwiguna == 'Bulanan')
		{
			$faktorkali = 0.095;
		}
		else if ($carabayarjsdwiguna == 'Sekaligus')
		{
			$faktorkali = 0;
		}
		
		$hasil = $result['TARIF'] * $faktorkali;
		
		echo round($hasil);
		
	}
	
	function hitungjshcpbdwiguna() {
		$this->load->model('ModSimulasi');
		
		$uangasuransihcpbjsdwiguna = $this->input->post("uangasuransihcpbjsdwiguna");
		
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
		
		$result = $this->ModSimulasi->getBiayaAsuransiPerBulanHCPBedahDwigunaMenaik($usiasekarang, $jeniskelamin, $uangasuransihcpbjsdwiguna);
		
		$carabayarjsdwiguna = $this->input->post("carabayarjsdwiguna");
		
		if ($carabayarjsdwiguna == 'Tahunan')
		{
			$faktorkali = 1;
		}
		else if ($carabayarjsdwiguna == 'Semesteran')
		{
			$faktorkali = 0.52;
		}
		else if ($carabayarjsdwiguna == 'Kuartalan')
		{
			$faktorkali = 0.27;
		}
		else if ($carabayarjsdwiguna == 'Bulanan')
		{
			$faktorkali = 0.095;
		}
		else if ($carabayarjsdwiguna == 'Sekaligus')
		{
			$faktorkali = 0;
		}
		
		$hasil = $result['TARIF'] * $faktorkali;
		
		echo round($hasil);
	}
	
	function hitungjsaddbdwiguna(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransijsaddbjsdwiguna = $this->input->post("uangasuransijsaddbjsdwiguna");
		$jeniskelamincalontertanggung = $this->input->post("jeniskelamincalontertanggung");	
		
		if ($jeniskelamincalontertanggung == 'Perempuan')
		{
			$jeniskelamin = 'FEMALE';	
		}
		else if ($jeniskelamincalontertanggung == 'Laki-Laki')
		{
			$jeniskelamin = 'MALE';	
		}
			
		$usiasekarang = $this->input->post("usiasekarang");
		$result = $this->ModSimulasi->getBiayaAsuransiPerBulanADDB($usiasekarang);
		
		$hasil = $result[$jeniskelamin] * ($uangasuransijsaddbjsdwiguna / 1000);
		
		echo round($hasil);
	}
	
	function hitungjstpddwiguna(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransijstpdjsdwiguna = $this->input->post("uangasuransijstpdjsdwiguna");
		$jeniskelamincalontertanggung = $this->input->post("jeniskelamincalontertanggung");	
		
		if ($jeniskelamincalontertanggung == 'Perempuan')
		{
			$jeniskelamin = 'FEMALE';	
		}
		else if ($jeniskelamincalontertanggung == 'Laki-Laki')
		{
			$jeniskelamin = 'MALE';	
		}
			
		$usiasekarang = $this->input->post("usiasekarang");
		$result = $this->ModSimulasi->getBiayaAsuransiPerBulanTPD($usiasekarang);
		
		$hasil = $result[$jeniskelamin] * ($uangasuransijstpdjsdwiguna / 1000);
		
		echo round($hasil);
	}
	
	function hitungjsci53dwiguna(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransijsci53jsdwiguna = $this->input->post("uangasuransijsci53jsdwiguna");
		$jeniskelamincalontertanggung = $this->input->post("jeniskelamincalontertanggung");	
		
		if ($jeniskelamincalontertanggung == 'Perempuan')
		{
			$jeniskelamin = 'FEMALE';	
		}
		else if ($jeniskelamincalontertanggung == 'Laki-Laki')
		{
			$jeniskelamin = 'MALE';	
		}
			
		$usiasekarang = $this->input->post("usiasekarang");
		$result = $this->ModSimulasi->getBiayaAsuransiPerBulanCI53($usiasekarang);
		
		$hasil = $result[$jeniskelamin] * ($uangasuransijsci53jsdwiguna / 1000);
		
		echo round($hasil);
	}
	
	function hitungjstermdwiguna(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransijstermjsdwiguna = $this->input->post("uangasuransijstermjsdwiguna");
		$calonpemegangpolisperokokjsdwiguna = $this->input->post("calonpemegangpolisperokokjsdwiguna");	
		
		if ($calonpemegangpolisperokokjsdwiguna == 'Ya')
		{
			$status = 'SMOKER';	
		}
		else if ($calonpemegangpolisperokokjsdwiguna == 'Tidak')
		{
			$status = 'NONSMOKER';	
		}
			
		$usiasekarang = $this->input->post("usiasekarang");
		$result = $this->ModSimulasi->getBiayaAsuransiPerBulanTerm($usiasekarang, $status, $uangasuransijstermjsdwiguna);
		
		$hasil = $result['TERM']/1000;
		
		echo round($hasil);
	}
	
	function hitungjsspdjsdwiguna(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		$usianasabah = $this->input->post("usianasabah");
		$result = $this->ModSimulasi->getPremiTahunanDwiguna($masaasuransi, $usiasekarang);
		
		$hasil = $result['TARIF'] * ($uangasuransipokok / 1000);
				
		$jeniskelamincalontertanggung = $this->input->post("jeniskelamincalontertanggung");	
		
		if ($jeniskelamincalontertanggung == 'Perempuan')
		{
			$jeniskelamin = 'FEMALE';	
		}
		else if ($jeniskelamincalontertanggung == 'Laki-Laki')
		{
			$jeniskelamin = 'MALE';	
		}
		
		$result = $this->ModSimulasi->getBiayaAsuransiPerBulanSPD($usianasabah);
		$hasil2 = ($result[$jeniskelamin]/100) * $hasil;
		
		echo round($hasil2);
		
	}
	
	function hitungjssptpdjsdwiguna(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		$result = $this->ModSimulasi->getPremiTahunanDwiguna($masaasuransi, $usiasekarang);
		
		$hasil = $result['TARIF'] * ($uangasuransipokok / 1000);
		
		$jeniskelamincalontertanggung = $this->input->post("jeniskelamincalontertanggung");	
		
		if ($jeniskelamincalontertanggung == 'Perempuan')
		{
			$jeniskelamin = 'FEMALE';	
		}
		else if ($jeniskelamincalontertanggung == 'Laki-Laki')
		{
			$jeniskelamin = 'MALE';	
		}
			
		$usiasekarang = $this->input->post("usiasekarang");
		
		$result = $this->ModSimulasi->getPremiTambahanWP('1', $usiasekarang, 'WPC');
		$hasil2 = ($result['TARIF']/1000000) * $hasil;
		
		echo round($hasil2);
		
		
	}
	
	function hitungjswaivertpdjsdwiguna(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		$result = $this->ModSimulasi->getPremiTahunanDwiguna($masaasuransi, $usiasekarang);
		
		$hasil = $result['TARIF'] * ($uangasuransipokok / 1000);
		
		$jeniskelamincalontertanggung = $this->input->post("jeniskelamincalontertanggung");	
		
		if ($jeniskelamincalontertanggung == 'Perempuan')
		{
			$jeniskelamin = 'FEMALE';	
		}
		else if ($jeniskelamincalontertanggung == 'Laki-Laki')
		{
			$jeniskelamin = 'MALE';	
		}
			
		$usiasekarang = $this->input->post("usiasekarang");
		
		$result = $this->ModSimulasi->getPremiTambahanWP('1', $usiasekarang, 'WPC');
		$hasil2 = ($result['TARIF']/1000000) * $hasil;
		
		echo round($hasil2);
		
		
	}

	function hitungpremisekaligusdwiguna(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		$result = $this->ModSimulasi->getPremiSekaligusDwiguna($masaasuransi, $usiasekarang);
		
		$hasil = ($result['TARIF']/1000) * ($uangasuransipokok);
		
		echo round($hasil);
	}
	
	function hitungpremitahunandwiguna(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		$result = $this->ModSimulasi->getPremiTahunanDwiguna($masaasuransi, $usiasekarang);
		
		$hasil = ($result['TARIF']/1000) * ($uangasuransipokok);
		
		echo round($hasil);
	}
	
	function hitungpremibulanandwiguna(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		$result = $this->ModSimulasi->getPremiTahunanDwiguna($masaasuransi, $usiasekarang);
		
		$hasil = (1+(5/100)) * ($result['TARIF']/1000) * ($uangasuransipokok) * 0.095;
		
		echo round($hasil);
	}
	
	function hitungpremikuartalandwiguna(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		$result = $this->ModSimulasi->getPremiTahunanDwiguna($masaasuransi, $usiasekarang);
		
		$hasil = (1+(5/100)) * ($result['TARIF']/1000) * ($uangasuransipokok) * 0.27;
		
		echo round($hasil);
	}
	
	function hitungpremisemesterandwiguna(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		$result = $this->ModSimulasi->getPremiTahunanDwiguna($masaasuransi, $usiasekarang);
		
		$hasil = (1+(5/100)) * ($result['TARIF']/1000) * ($uangasuransipokok) * 0.52;
		
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
			'statusmedical' => $this->input->post('statusmedical'),
			'tabelpremitahunan' => $this->input->post('tabelpremitahunan'),
			'tabelpremibulanan' => $this->input->post('tabelpremibulanan'),
			'tabelpremikuartalan' => $this->input->post('tabelpremikuartalan'),
			'tabelpremisemesteran' => $this->input->post('tabelpremisemesteran'),
			'tabelpremisekaligus' => $this->input->post('tabelpremisekaligus'),
			
			//RIDER
			
			'jsaddbjsdwiguna' => $this->input->post('jsaddbjsdwiguna'),
			'premijsaddbjsdwiguna' => $this->input->post('premijsaddbjsdwiguna'),
			'uangasuransijsaddbjsdwiguna' => $this->input->post('uangasuransijsaddbjsdwiguna'),
			
			'jstpdjsdwiguna' => $this->input->post('jstpdjsdwiguna'),
			'premijstpdjsdwiguna' => $this->input->post('premijstpdjsdwiguna'),
			'uangasuransijstpdjsdwiguna' => $this->input->post('uangasuransijstpdjsdwiguna'),
			
			'jswaivertpdjsdwiguna' => $this->input->post('jswaivertpdjsdwiguna'),
			'premijswaivertpdjsdwiguna' => $this->input->post('premijswaivertpdjsdwiguna'),
			'uangasuransijswaivertpdjsdwiguna' => $this->input->post('uangasuransijswaivertpdjsdwiguna'),
	
			'jsci53jsdwiguna' => $this->input->post('jsci53jsdwiguna'),
			'premijsci53jsdwiguna' => $this->input->post('premijsci53jsdwiguna'),
			'uangasuransijsci53jsdwiguna' => $this->input->post('uangasuransijsci53jsdwiguna'),
			
			'jstermjsdwiguna' => $this->input->post('jstermjsdwiguna'),
			'premijstermjsdwiguna' => $this->input->post('premijstermjsdwiguna'),
			'uangasuransijstermjsdwiguna' => $this->input->post('uangasuransijstermjsdwiguna'),
			
			'jsspdjsdwiguna' => $this->input->post('jsspdjsdwiguna'),
			'premijsspdjsdwiguna' => $this->input->post('premijsspdjsdwiguna'),
			'uangasuransijsspdjsdwiguna' => $this->input->post('uangasuransijsspdjsdwiguna'),
			
			'jssptpdjsdwiguna' => $this->input->post('jssptpdjsdwiguna'),
			'premijssptpdjsdwiguna' => $this->input->post('premijssptpdjsdwiguna'),
			'uangasuransijssptpdjsdwiguna' => $this->input->post('uangasuransijssptpdjsdwiguna'),
			
			'hcpjsdwiguna' => $this->input->post('hcpjsdwiguna'),
			'premihcpjsdwiguna' => $this->input->post('premihcpjsdwiguna'),
			'uangasuransihcpjsdwiguna' => $this->input->post('uangasuransihcpjsdwiguna'),
			
			'hcpbjsdwiguna' => $this->input->post('hcpbjsdwiguna'),
			'premihcpbjsdwiguna' => $this->input->post('premihcpbjsdwiguna'),
			'uangasuransihcpbjsdwiguna' => $this->input->post('uangasuransihcpbjsdwiguna'),
			
			'totalpremiriderjsdwigunasum' => $this->input->post('totalpremiriderjsdwigunasum'),
			
			'totalpokokpremirider' => $this->input->post('totalpokokpremirider')
			
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
		$data['hasil']['statusmedical'] = $this->session->userdata('statusmedical');
		
		$data['hasil']['filepdf'] = $this->session->userdata('filepdf');
		$data['hasil']['id_nasabah'] = $this->session->userdata('id_nasabah');
		$data['hasil']['id_agen']	 = $this->session->userdata('id_agen');
		//$data['hasil']['file_pdf']	 = $filePdf.'.pdf',
		$data['hasil']['id_produk']  = $this->session->userdata('id_produk');
		
		$data['hasil']['tabelpremisekaligus']  = $this->session->userdata('tabelpremisekaligus');
		$data['hasil']['tabelpremitahunan']  = $this->session->userdata('tabelpremitahunan');
		$data['hasil']['tabelpremibulanan']  = $this->session->userdata('tabelpremibulanan');
		$data['hasil']['tabelpremikuartalan']  = $this->session->userdata('tabelpremikuartalan');
		$data['hasil']['tabelpremisemesteran']  = $this->session->userdata('tabelpremisemesteran');
		
		//RIDER
		$data['hasil']['jsaddbjsdwiguna'] = $this->session->userdata('jsaddbjsdwiguna');
		$data['hasil']['premijsaddbjsdwiguna'] = $this->session->userdata('premijsaddbjsdwiguna');
		$data['hasil']['uangasuransijsaddbjsdwiguna']	 = $this->session->userdata('uangasuransijsaddbjsdwiguna');
		
		$data['hasil']['jstpdjsdwiguna'] = $this->session->userdata('jstpdjsdwiguna');
		$data['hasil']['premijstpdjsdwiguna'] = $this->session->userdata('premijstpdjsdwiguna');
		$data['hasil']['uangasuransijstpdjsdwiguna']	 = $this->session->userdata('uangasuransijstpdjsdwiguna');
		
		$data['hasil']['jswaivertpdjsdwiguna'] = $this->session->userdata('jswaivertpdjsdwiguna');
		$data['hasil']['premijswaivertpdjsdwiguna'] = $this->session->userdata('premijswaivertpdjsdwiguna');
		$data['hasil']['uangasuransijswaivertpdjsdwiguna']	 = $this->session->userdata('uangasuransijswaivertpdjsdwiguna');
		
		$data['hasil']['jsci53jsdwiguna'] = $this->session->userdata('jsci53jsdwiguna');
		$data['hasil']['premijsci53jsdwiguna'] = $this->session->userdata('premijsci53jsdwiguna');
		$data['hasil']['uangasuransijsci53jsdwiguna']	 = $this->session->userdata('uangasuransijsci53jsdwiguna');
		
		$data['hasil']['jstermjsdwiguna'] = $this->session->userdata('jstermjsdwiguna');
		$data['hasil']['premijstermjsdwiguna'] = $this->session->userdata('premijstermjsdwiguna');
		$data['hasil']['uangasuransijstermjsdwiguna']	 = $this->session->userdata('uangasuransijstermjsdwiguna');
		
		$data['hasil']['jsspdjsdwiguna'] = $this->session->userdata('jsspdjsdwiguna');
		$data['hasil']['premijsspdjsdwiguna'] = $this->session->userdata('premijsspdjsdwiguna');
		$data['hasil']['uangasuransijsspdjsdwiguna']	 = $this->session->userdata('uangasuransijsspdjsdwiguna');
		
		$data['hasil']['jssptpdjsdwiguna'] = $this->session->userdata('jssptpdjsdwiguna');
		$data['hasil']['premijssptpdjsdwiguna'] = $this->session->userdata('premijssptpdjsdwiguna');
		$data['hasil']['uangasuransijssptpdjsdwiguna']	 = $this->session->userdata('uangasuransijssptpdjsdwiguna');
		
		$data['hasil']['totalpremiriderjsdwigunasum'] = $this->session->userdata('totalpremiriderjsdwigunasum');
		
		$data['hasil']['hcpjsdwiguna'] = $this->session->userdata('hcpjsdwiguna');
		$data['hasil']['premihcpjsdwiguna'] = $this->session->userdata('premihcpjsdwiguna');
		$data['hasil']['uangasuransihcpjsdwiguna']	 = $this->session->userdata('uangasuransihcpjsdwiguna');
		
		if ($data['hasil']['uangasuransihcpjsdwiguna'] == '1')
		{
			$data['hasil']['uahcpjsdwiguna'] = 200000;
		}
		else if ($data['hasil']['uangasuransihcpjsdwiguna'] == '2')
		{
			$data['hasil']['uahcpjsdwiguna'] = 400000;	
		}
		else if ($data['hasil']['uangasuransihcpjsdwiguna'] == '3')
		{
			$data['hasil']['uahcpjsdwiguna'] = 600000;	
		}
		else if ($data['hasil']['uangasuransihcpjsdwiguna'] == '4')
		{
			$data['hasil']['uahcpjsdwiguna'] = 800000;	
		}
		else if ($data['hasil']['uangasuransihcpjsdwiguna'] == '5')
		{
			$data['hasil']['uahcpjsdwiguna'] = 1000000;	
		}
		
		$data['hasil']['hcpbjsdwiguna'] = $this->session->userdata('hcpbjsdwiguna');
		$data['hasil']['premihcpbjsdwiguna'] = $this->session->userdata('premihcpbjsdwiguna');
		$data['hasil']['uangasuransihcpbjsdwiguna']	 = $this->session->userdata('uangasuransihcpbjsdwiguna');
		
		$data['hasil']['totalpokokpremirider']	 = $this->session->userdata('totalpokokpremirider');
		
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
		$data['hasil']['kantorcabang'] = str_replace("KANTOR CABANG","",$api['NAMAKANTOR']);
		
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
			'JUMLAH_PREMI' => $data['hasil']['premihcpbjsdwiguna'],
			'JUA' => $data['hasil']['uangasuransihcpbjsdwiguna'],
		);
		
		$this->ModSimulasi->insertSimulasi($data['hitung']);
		
		$data['hasil']['build_id'] = $data['hitung']['BUILD_ID'];
				
		$filePdf = $this->session->userdata('filepdf');
		
		$this->createPDF($filePdf,$data);
		
		$this->load->view('hasil/jsdwiguna',$data);
		
		//$this->session->sess_destroy();
	}

	function createPDF($namaFile,$data){
		$image1 = FCPATH.'assets/img/logo-js.png';
		$image2 = FCPATH.'assets/img/jsdwiguna.jpg';
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
		$this->pdf->Cell(190,5,'JS Dwiguna (Proteksi menuju Keluarga Sejahtera)','B',0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(10);
		
		//MANFAAT
		$this->pdf->SetFont('Arial','UB',8);
		$this->pdf->SetTextColor(50,0,255);
		$this->pdf->Cell(190,5,'I. JAMINAN MANFAAT POKOK',0,0,'L');
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'Produk Asuransi JS Dwiguna memberikan manfaat berupa:',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'1. Sebesar 100 % x Uang Asuransi apabila Tertanggung masih hidup pada akhir Masa Asuransi, Titik C.',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'2.	Sebesar 100 % Uang Asuransi apabila Tertanggung meninggal dunia dalam Masa Asuransi, titik B.',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->Image($image2, 2, 70, 0, 0);
		$this->pdf->ln(60);
		$this->pdf->SetFont('Arial','UB',8);
		$this->pdf->SetTextColor(50,0,255);
		$this->pdf->Cell(190,5,'II. PENETAPAN BESARNYA PREMI POLIS JS DWIGUNA',0,0,'L');
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->ln(6);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Nama Pemegang Polis',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,''.$data['hasil']['namalengkapcalontertanggung'].' ',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Usia Tertanggung',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,''.$data['hasil']['usiacalontertanggung'].' Tahun',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Masa Asuransi / Masa Kontrak',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,''.$data['hasil']['masaasuransi'].' Tahun',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Jumlah Uang Asuransi Pokok',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Pembayaran Premi Sekaligus',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['tabelpremisekaligus'],0,'.',',').'',0,0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Premi Tahunan 5 Tahun Pertama',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['tabelpremitahunan']* 1.05,0,'.',',').'',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Premi Tahunan 5 Tahun Berikutnya',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['tabelpremitahunan'] ,0,'.',',').'',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Premi Bulanan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['tabelpremibulanan'] ,0,'.',',').'',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Premi Kuartalan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['tabelpremikuartalan'] ,0,'.',',').'',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Premi Semesteran',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['tabelpremisemesteran'] ,0,'.',',').'',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Total Premi Rider',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['totalpremiriderjsdwigunasum'],0,'.',',').'',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Total Premi Tahunan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['totalpokokpremirider'],0,'.',',').'',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Uang Asuransi yang diterima setelah selesai kontrak sebesar',0,0,'L');
		$this->pdf->Cell(30);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'',0,0,'L');
		$this->pdf->ln(40);
		/*
		$this->pdf->SetFont('Arial','UB',8);
		$this->pdf->SetTextColor(50,0,255);
		$this->pdf->Cell(190,5,'2. PENGHITUNGAN MANFAAT',0,0,'L');
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->ln(6);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Jika Premi dibayar sekaligus',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Jumlah Uang yang akan diterima setelah selesai kontrak',0,0,'L');
		$this->pdf->Cell(30);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Jumlah setoran selama kontrak (n)',0,0,'L');
		$this->pdf->Cell(30);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['tabelpremisekaligus'],0,'.',',').'',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Selisih',0,0,'L');
		$this->pdf->Cell(30);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] - $data['hasil']['tabelpremisekaligus']),0,'.',',').'',1,0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Jika Premi dibayar tahunan',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Jumlah Uang yang akan diterima setelah selesai kontrak',0,0,'L');
		$this->pdf->Cell(30);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Jumlah setoran selama kontrak (n)',0,0,'L');
		$this->pdf->Cell(30);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format((($data['hasil']['masaasuransi'] ) * ($data['hasil']['tabelpremitahunan'])),0,'.',',').'',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Selisih',0,0,'L');
		$this->pdf->Cell(30);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] - (($data['hasil']['masaasuransi']) * ($data['hasil']['tabelpremitahunan']))),0,'.',',').'',1,0,'L');
		$this->pdf->ln(5);
		*/
		
		
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
		
		// RIDER
		
		if (($data['hasil']['uangasuransijsaddbjsdwiguna']!=0)||($data['hasil']['uangasuransijstpdjsdwiguna']!=0)
		||($data['hasil']['uangasuransijsci53jsdwiguna']!=0)||($data['hasil']['uangasuransijstermjsdwiguna']!=0)
		||($data['hasil']['uangasuransijsspdjsdwiguna']!=0)||($data['hasil']['uangasuransijssptpdjsdwiguna']!=0)
		||($data['hasil']['premihcpjsdwiguna']!=0)||($data['hasil']['premihcpbjsdwiguna']!=0)
		)
		{
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
			$this->pdf->Cell(190,5,'JS Dwiguna (Proteksi menuju Keluarga Sejahtera)','B',0,'L');
			$this->pdf->ln(10);
			$this->pdf->SetFont('Arial','B',10);
			$this->pdf->SetFillColor(200,200,200);
			$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
			$this->pdf->ln(10);
			
			//MANFAAT
			
			$this->pdf->SetFont('Arial','UB',8);
			$this->pdf->SetTextColor(50,0,255);
			$this->pdf->Cell(190,5,'III. JAMINAN TAMBAHAN',0,0,'L');
			$this->pdf->SetTextColor(0,0,0);
			if ($data['hasil']['uangasuransijsaddbjsdwiguna'] != 0)
			{	
				$this->pdf->ln(10);
				$this->pdf->SetFont('Arial','B',8);
				$this->pdf->Cell(190,5,'JS ADDB',0,0,'L');
				$this->pdf->ln();
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(150,5,'Jika Tertanggung Meninggal Dunia karena Kecelakaan, maka akan dibayarkan',0,0,'L');
				$this->pdf->SetFont('Arial','B',8);
				$this->pdf->Cell(40,5,'Rp. '.number_format($data['hasil']['uangasuransijsaddbjsdwiguna'],0,'.',',').'',0,0,'L');
			}
			if ($data['hasil']['uangasuransijstpdjsdwiguna'] != 0)
			{
				$this->pdf->ln(10);
				$this->pdf->SetFont('Arial','B',8);
				$this->pdf->Cell(190,5,'JS TPD',0,0,'L');
				$this->pdf->ln();
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(150,5,'Jika Tertanggung mengalami Cacat Tetap Total, maka kepada Tertanggung akan dibayarkan sebesar',0,0,'L');
				$this->pdf->SetFont('Arial','B',8);
				$this->pdf->Cell(40,5,'Rp. '.number_format($data['hasil']['uangasuransijstpdjsdwiguna'],0,'.',',').'',0,0,'L');
			}
			if ($data['hasil']['uangasuransijswaivertpdjsdwiguna'] != 0)
			{
				$this->pdf->ln(10);
				$this->pdf->SetFont('Arial','B',8);
				$this->pdf->Cell(190,5,'JS WP TPD',0,0,'L');
				$this->pdf->ln();
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(190,5,'Jika Tertanggung mengalami Cacat Tetap Total, maka Polis menjadi bebas premi dan manfaat tetap akan dibayarkan sampai berakhirnya Masa',0,0,'L');
				$this->pdf->ln();
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(190,5,'Asuransi.',0,0,'L');
			}
			if ($data['hasil']['uangasuransijsci53jsdwiguna'] != 0)
			{
				$this->pdf->ln(10);
				$this->pdf->SetFont('Arial','B',8);
				$this->pdf->Cell(190,5,'JS CI53',0,0,'L');
				$this->pdf->ln();
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(150,5,'Jika Tertanggung didiagnosa mengalami satu dari 53 Penyakit Kritis maka kepada Tertanggung akan dibayarkan',0,0,'L');
				$this->pdf->SetFont('Arial','B',8);
				$this->pdf->Cell(40,5,'Rp. '.number_format($data['hasil']['uangasuransijsci53jsdwiguna'],0,'.',',').'',0,0,'L');
			}
			if ($data['hasil']['premihcpjsdwiguna'] != 0)
			{
				$this->pdf->ln(10);
				$this->pdf->SetFont('Arial','B',8);
				$this->pdf->Cell(190,5,'JS Hospital Cash Plan',0,0,'L');
				$this->pdf->ln();
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(150,5,'Jika Tertanggung dirawat di Rumah Sakit maka akan dibayarkan santunan sebesar',0,0,'L');
				$this->pdf->SetFont('Arial','B',8);
				$this->pdf->Cell(40,5,'Rp. '.number_format($data['hasil']['premihcpjsdwiguna'],0,'.',',').'',0,0,'L');
				$this->pdf->ln();
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(150,5,'per hari selama Tertanggung dirawat di ruang ICU.',0,0,'L');
				$this->pdf->ln();
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(150,5,'Dan jika Teranggung dirawati di ruang ICU maka akan dibayarkan santunan',0,0,'L');
				$this->pdf->SetFont('Arial','B',8);
				$this->pdf->Cell(40,5,'Rp. '.number_format($data['hasil']['uahcpjsdwiguna'],0,'.',',').'',0,0,'L');
				$this->pdf->ln();
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(150,5,'per hari selama Tertanggung dirawat di ruang ICU.',0,0,'L');
				$this->pdf->ln();
				if ($data['hasil']['premihcpbjsdwiguna'] != 0)
				{
					$this->pdf->SetFont('Arial','',8);
					$this->pdf->Cell(150,5,'Jika Tertanggung di operasi/bedah maka akan dibayarkan sebesar',0,0,'L');
					$this->pdf->SetFont('Arial','B',8);
					$this->pdf->Cell(40,5,'Rp. '.number_format($data['hasil']['premihcpbjsdwiguna'],0,'.',',').'',0,0,'L');
				}
			}
			if ($data['hasil']['uangasuransijstermjsdwiguna'] != 0)
			{
				$this->pdf->ln(10);
				$this->pdf->SetFont('Arial','B',8);
				$this->pdf->Cell(190,5,'JS Term Insurance',0,0,'L');
				$this->pdf->ln();
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(150,5,'Jika Tertanggung Meninggal Dunia dalam Masa Asuransi maka kepada ahliwaris dibayarkan tambahan Uang Asuransi',0,0,'L');
				$this->pdf->SetFont('Arial','B',8);
				$this->pdf->Cell(40,5,'Rp. '.number_format($data['hasil']['uangasuransijstermjsdwiguna'],0,'.',',').'',0,0,'L');
			}
			if ($data['hasil']['uangasuransijsspdjsdwiguna'] != 0)
			{
				$this->pdf->ln(10);
				$this->pdf->SetFont('Arial','B',8);
				$this->pdf->Cell(190,5,'JS Spouse Payor Death Benefit',0,0,'L');
				$this->pdf->ln();
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(190,5,'Apabila Pemegang Polis Meninggal Dunia, maka Polis akan menjadi bebas Premi dan manfaat Polis tetap akan dibayarkan sampai berakhirnya ',0,0,'L');
				$this->pdf->ln();
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(190,5,'Masa Asuransi.',0,0,'L');
			}
			if ($data['hasil']['uangasuransijssptpdjsdwiguna'] != 0)
			{
				$this->pdf->ln(10);
				$this->pdf->SetFont('Arial','B',8);
				$this->pdf->Cell(190,5,'JS Spouse Payor - TPD',0,0,'L');
				$this->pdf->ln();
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(190,5,'Apabila Pemegang Polis menderita Cacat Tetap Total, maka Polis menjadi bebas Premi dan manfaat Polis tetap akan dibayarkan sampai',0,0,'L');
				$this->pdf->ln();
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(190,5,'berakhirnya Masa Asuransi.',0,0,'L');
			}
			$this->pdf->ln(30);
			
			
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
		
		}
		
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
		$this->pdf->Cell(190,5,'JS Dwiguna (Proteksi menuju Keluarga Sejahtera)','B',0,'L');
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