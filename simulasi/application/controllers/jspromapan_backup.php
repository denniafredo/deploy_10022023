<?php 
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");
	
	ini_set('memory_limit', '2048M');
	ini_set('set_time_limit','300');


	
	
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	
	error_reporting(0);

class Jspromapan extends CI_Controller{

	function hitungpremitambahan(){
			
		$this->load->model('ModSimulasi');
		
		$juaci = $this->input->post("juaci");
		$masapembpremi = $this->input->post("masapembpremi");
		$usia = $this->input->post("usia");
		
		$result = $this->ModSimulasi->getPremiTambahanCI(1, $usia, 'CI');
		
		//$juaci2 = $this->input->get("juaci");
		//return $juaci;
		
		$faktorcb = $this->input->post("faktorcb");

		$hasil = (($juaci / 1000) * $result['TARIF']) * $faktorcb;
			
		//echo "$juaci / 1000 * ".$result['TARIF']." * $faktorcb = ".$hasil."<br>";
		
		//echo $hasilbagi."<br><br>";
		
		if (($hasil % 1000) > 0)
		{	
			$hasil = floor($hasil / 1000); 
			$hasilpembulatan = ($hasil * 1000) + 1000;
			echo $hasilpembulatan;
		}
		else
		{
			echo $hasil;
		}
			
	}

	function hitungpremitambahanPA(){
		
		$this->load->model('ModSimulasi');
			
		$juapa = $this->input->post("juapa");
		$masapembpremi = $this->input->post("masapembpremi");
		$usia = $this->input->post("usia");
		
		$result = $this->ModSimulasi->getPremiTambahanPA(1, $usia, 'PA');
		
		//$juaci2 = $this->input->get("juaci");
		//return $juaci;
		
		$faktorcb = $this->input->post("faktorcb");

		$hasil = (($juapa / 1000) * $result['TARIF']) * $faktorcb;
			
		//echo "$juaci / 1000 * ".$result['TARIF']." * $faktorcb = ".$hasil."<br>";
		
		//echo $hasilbagi."<br><br>";
		
		if (($hasil % 1000) > 0)
		{	
			$hasil = floor($hasil / 1000); 
			$hasilpembulatan = ($hasil * 1000) + 1000;
			echo $hasilpembulatan;
		}
		else
		{
			echo $hasil;
		}

	}
	
	function hitungpremitambahanCTT(){
		
		$this->load->model('ModSimulasi');
			
		$juactt = $this->input->post("juactt");
		$masapembpremi = $this->input->post("masapembpremi");
		$usia = $this->input->post("usia");
		
		$result = $this->ModSimulasi->getPremiTambahanCTT(1, $usia, 'CTT');
		
		//$juaci2 = $this->input->get("juaci");
		//return $juaci;
		
		$faktorcb = $this->input->post("faktorcb");

		$hasil = (($juactt / 1000) * $result['TARIF']) * $faktorcb;
			
		//echo "$juaci / 1000 * ".$result['TARIF']." * $faktorcb = ".$hasil."<br>";
		
		//echo $hasilbagi."<br><br>";
		
		if (($hasil % 1000) > 0)
		{	
			$hasil = floor($hasil / 1000); 
			$hasilpembulatan = ($hasil * 1000) + 1000;
			echo $hasilpembulatan;
		}
		else
		{
			echo $hasil;
		}

	}
	
	function hitungjuaWP(){
		
		$premisesuaicarabayar = $this->input->post("premisesuaicarabayar");
		$masapembpremi = $this->input->post("masapembpremi");
		$kali = $this->input->post("kali");
		
		$juawp = ((($masapembpremi - 0) * $kali) -1) * $premisesuaicarabayar;
		
		echo $juawp;

	}
	
	function hitungpremitambahanWP(){
		
		$this->load->model('ModSimulasi');
			
		$juawp = $this->input->post("juawp");
		$masapembpremi = $this->input->post("masapembpremi");
		$usia = $this->input->post("usia");
		
		$result = $this->ModSimulasi->getPremiTambahanWP(1, $usia, 'CTT');
		
		//$juaci2 = $this->input->get("juaci");
		//return $juaci;
		
		$faktorcb = $this->input->post("faktorcb");

		$hasil = (($juawp / 1000) * $result['TARIF']) * $faktorcb;
			
		//echo "$juaci / 1000 * ".$result['TARIF']." * $faktorcb = ".$hasil."<br>";
		
		//echo $hasilbagi."<br><br>";
		
		if (($hasil % 1000) > 0)
		{	
			$hasil = floor($hasil / 1000); 
			$hasilpembulatan = ($hasil * 1000) + 1000;
			echo $hasilpembulatan;
		}
		else
		{
			echo $hasil;
		}

	}
	
	function hitungpremitambahanCPM(){
		
		$this->load->model('ModSimulasi');
		
		$masacpm = $this->input->post("masacpm");
		$usia = $this->input->post("usia");		
		$kodetarif = $this->input->post("kodetarif");	
		$result = $this->ModSimulasi->getPremiTambahanCPM($masacpm, $usia, $kodetarif);
		
		$faktorcb = $this->input->post("faktorcb");
		$hasil = $result['TARIF'] * $faktorcb;
		
		if (($hasil % 1000) > 0)
		{	
			$hasil = floor($hasil / 1000); 
			$hasilpembulatan = ($hasil * 1000) + 1000;
			echo $hasilpembulatan;
		}
		else
		{
			echo $hasil;
		}
	}
	
	function hitungpremitambahanCPB(){
		
		$this->load->model('ModSimulasi');
		
		$masacpb = $this->input->post("masacpb");
		$usia = $this->input->post("usia");		
		$kodetarif = $this->input->post("kodetarif");	
		
		/*$masacpb = 5;
		$usia = 24;		
		$kodetarif = "CPBL";*/	
		
		$result = $this->ModSimulasi->getPremiTambahanCPB($masacpb, $usia, $kodetarif);
		
		$faktorcb = $this->input->post("faktorcb");
		
		//$faktorcb = 0.095;
		$hasil = $result['TARIF'] * $faktorcb;
		
		if (($hasil % 1000) > 0)
		{	
			$hasil = floor($hasil / 1000); 
			$hasilpembulatan = ($hasil * 1000) + 1000;
			echo $hasilpembulatan;
		}
		else
		{
			echo $hasil;
		}
	}
	
	function hitungpremitambahanTERM(){
		
		$this->load->model('ModSimulasi');
			
		$juaterm = $this->input->post("juaterm");
		$masapembpremi = $this->input->post("masapembpremi");
		$usia = $this->input->post("usia");
		
		$result = $this->ModSimulasi->getPremiTambahanTERM(1, $usia, 'TERM');
		
		//$juaci2 = $this->input->get("juaci");
		//return $juaci;
		
		$faktorcb = $this->input->post("faktorcb");

		$hasil = (($juaterm / 1000) * $result['TARIF']) * $faktorcb;
			
		//echo "$juaci / 1000 * ".$result['TARIF']." * $faktorcb = ".$hasil."<br>";
		
		//echo $hasilbagi."<br><br>";
		
		if (($hasil % 1000) > 0)
		{	
			$hasil = floor($hasil / 1000); 
			$hasilpembulatan = ($hasil * 1000) + 1000;
			echo $hasilpembulatan;
		}
		else
		{
			echo $hasil;
		}

	}
	
	function hitungminimalUA(){
		
		$this->load->model('ModSimulasi');
		
		$premisesuaicarabayar = $this->input->post("premisesuaicarabayar");
		$usiasekarang = $this->input->post("usiasekarang");		
		$result = $this->ModSimulasi->getMinimalUA($usiasekarang);
		
		$hasil = $result['MINIMAL'] * $premisesuaicarabayar;
		
		echo $hasil;
	}
	
	function hitungmaksimalUA(){
		
		$this->load->model('ModSimulasi');
		
		$premisesuaicarabayar = $this->input->post("premisesuaicarabayar");
		$usiasekarang = $this->input->post("usiasekarang");		
		$result = $this->ModSimulasi->getMaksimalUA($usiasekarang);
		
		$hasil = $result['MAKSIMAL'] * $premisesuaicarabayar;
		
		echo $hasil;
	}
	
	
	function hitung(){
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
		
		$filePdf = 'SIMULASI-'.strtoupper($this->input->post('namanasabah')).'-'.strtoupper($this->input->post('modul')).'-'.time();
		
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
			'modul' => $this->input->post('modul'),
			'namaagen' => $this->input->post('namaagen'),
			'kodekantor' => $this->input->post('kodekantor'),
			//'kantorcabang' => $this->input->post('kantorcabang'),
			'id_nasabah' => $nasabahID,
			'id_agen' => $this->input->post('nomeragen'),
			'file_pdf' => $filePdf.'.pdf',
			'id_produk' => $this->input->post('idproduk'),
			'kodeprospek' => $this->input->post('kodeprospek'),
			'filepdf' => $filePdf,
			
			'usia' => $this->input->post('usia'),
			
			'calonpemegangpolisperokok' => $this->input->post('calonpemegangpolisperokok'),
			'hubungandenganpempol' => $this->input->post('hubungandenganpempol'),
			'namalengkapcalontertanggung' => $this->input->post('namalengkapcalontertanggung'),
			'jeniskelamincalontertanggung' => $this->input->post('jeniskelamincalontertanggung'),
			'tanggallahircalontertangggung' => $this->input->post('tanggallahircalontertangggung'),
			'calontertanggungperokok' => $this->input->post('calontertanggungperokok'),
			'asumsicutitahunan' => $this->input->post('asumsicutitahunan'),
			'carabayar' => $this->input->post('carabayar'),
			'uangpertanggungan' => $this->input->post('uangpertanggungan'),
			'minimalua' => $this->input->post('minimalua'),
			'maksimalua' => $this->input->post('maksimalua'),
			'matauang' => $this->input->post('matauang'),
			'statusmedical' => $this->input->post('statusmedical'),
			'premiberkala' => $this->input->post('premiberkala'),
			'topupberkala' => $this->input->post('topupberkala'),
			'topupsekaligus' => $this->input->post('topupsekaligus'),
			'beamaterai' => $this->input->post('beamaterai'),
			'totalpremiyangdibayar' => $this->input->post('totalpremiyangdibayar'),
			'alokasidana1' => $this->input->post('alokasidana1'),
			'alokasidana2' => $this->input->post('alokasidana2'),
			'persentasealokasidana1' => $this->input->post('persentasealokasidana1'),
			'persentasealokasidana2' => $this->input->post('persentasealokasidana2'),
			'juaaddb' => $this->input->post('juaaddb'),
			'juatpd' => $this->input->post('juatpd'),
			'dropdownhcp' => $this->input->post('dropdownhcp'),
			'juahcp' => $this->input->post('juahcp'),
			'dropdownhcpbedah' => $this->input->post('dropdownhcpbedah'),
			'juahcpbedah' => $this->input->post('juahcpbedah'),
			'juaci53' => $this->input->post('juaci53'),
			'juatermlife' => $this->input->post('juatermlife'),
			'juapayorbenefitdeath' => $this->input->post('juapayorbenefitdeath'),
			'juapayorbenefittpd' => $this->input->post('juapayorbenefittpd'),
			'juaspousepayordeath' => $this->input->post('juaspousepayordeath'),
			'juaspousepayortpd' => $this->input->post('juaspousepayortpd')
  		);
		
		$this->session->set_userdata($newdata);
		
		//$html = $this->load->view('pdf/optima7',$data,true);
		//$this->load->view('hasil/optima7');
	}
	
	
	function hasil() {
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
	
		$tanggalLahir = date("d", strtotime($this->session->userdata('tgl_lahir')));
		$bulanLahir = $bulan[date("n", strtotime($this->session->userdata('tgl_lahir')))];
		$tahunLahir = date("Y", strtotime($this->session->userdata('tgl_lahir')));
		$data['hasil']['tgl_lahir'] = $tanggalLahir.' '.$bulanLahir.' '.$tahunLahir;
		
		$jeniskel = $this->session->userdata('jenis_kel');
		$data['hasil']['buildID'] = time();
		
		if ($jeniskel == 'M')
		{
			$data['hasil']['jenis_kel'] = 'Laki-laki';
		}
		else if ($jeniskel == 'F')
		{
			$data['hasil']['jenis_kel'] = 'Perempuan';
		}
		
		$data['hasil']['calonpemegangpolisperokok'] = $this->session->userdata('calonpemegangpolisperokok');
		
		$data['hasil']['namalengkapcalontertanggung'] = $this->session->userdata('namalengkapcalontertanggung');
		$tanggalLahirCalonTertanggung = date("d", strtotime($this->session->userdata('tanggallahircalontertangggung')));
		$bulanLahirCalonTertanggung = $bulan[date("n", strtotime($this->session->userdata('tanggallahircalontertangggung')))];
		$tahunLahirCalonTertanggung = date("Y", strtotime($this->session->userdata('tanggallahircalontertangggung')));
		$data['hasil']['tanggallahircalontertangggung'] =  $tanggalLahirCalonTertanggung.' '.$bulanLahirCalonTertanggung.' '.$tahunLahirCalonTertanggung;
		$data['hasil']['hubungandenganpempol'] = $this->session->userdata('hubungandenganpempol');
		
		$data['hasil']['jeniskelamincalontertanggung'] = $this->session->userdata('jeniskelamincalontertanggung');
		$jeniskelamincalontertanggung = $data['hasil']['jeniskelamincalontertanggung'];
		
		if ($jeniskelamincalontertanggung == "Laki-Laki")
		{
			$statuskelamin = "MALE";
			$statkelaminhcp = "L";
		}
		else
		{
			$statuskelamin = "FEMALE";
			$statkelaminhcp = "P";
		}
		
		$data['hasil']['calontertanggungperokok'] = $this->session->userdata('calontertanggungperokok');
		$calontertanggungperokok = $data['hasil']['calontertanggungperokok'];
		
		if ($calontertanggungperokok == "Ya")
		{
			$statusperokok = "SMOKER";
		}
		else
		{
			$statusperokok = "NONSMOKER";
		}
		
		$data['hasil']['carabayar'] = $this->session->userdata('carabayar');
		
		
		$carabayar = $data['hasil']['carabayar'];
		
		if ($carabayar == "Bulanan")
		{
			$pengalipremi = 12;
		}
		else if ($carabayar == "Kuartalan")
		{
			$pengalipremi = 4;
		}
		else if ($carabayar == "Semesteran")
		{
			$pengalipremi = 2;
		}
		else if ($carabayar == "Tahunan")
		{
			$pengalipremi = 1;
		}		
		
		$data['hasil']['uangpertanggungan'] = $this->session->userdata('uangpertanggungan');
		
		$matauang = $this->session->userdata('matauang');
		if ($matauang == "IDR")
		{
			$data['hasil']['matauang'] = "Rupiah";
		}
		$data['hasil']['premiberkala'] = $this->session->userdata('premiberkala');
		$data['hasil']['premiberkalakomparasiringkasan'] = $this->session->userdata('premiberkala');
		$data['hasil']['topupberkala'] = $this->session->userdata('topupberkala');
		$data['hasil']['topupsekaligus'] = $this->session->userdata('topupsekaligus');
		
		$data['hasil']['totalpremiyangdibayar'] = $this->session->userdata('totalpremiyangdibayar');

		$data['hasil']['alokasidana1'] = $this->session->userdata('alokasidana1');
		$data['hasil']['alokasidana2'] = $this->session->userdata('alokasidana2');
		$data['hasil']['persentasealokasidana1'] = $this->session->userdata('persentasealokasidana1');
		$data['hasil']['persentasealokasidana2'] = $this->session->userdata('persentasealokasidana2');
		
		$alokasidana1 = $this->session->userdata('alokasidana1');
		$alokasidana2 = $this->session->userdata('alokasidana2');
		$persentasealokasidana1 = $this->session->userdata('persentasealokasidana1');
		$persentasealokasidana2 = $this->session->userdata('persentasealokasidana2');
		
		if ($alokasidana1 == "JS LINK PASAR UANG")
		{
			$detailproduk = $this->ModSimulasi->getDetailProduk(4);
			$asumsi_inv_min = $detailproduk['ASUMSI_INV_MIN']; 
			$asumsi_inv_med = $detailproduk['ASUMSI_INV_MED'];
			$asumsi_inv_max = $detailproduk['ASUMSI_INV_MAX'];
			$data['hasil']['asumsi_inv_min1'] = $asumsi_inv_min;
			$data['hasil']['asumsi_inv_med1'] = $asumsi_inv_med;
			$data['hasil']['asumsi_inv_max1'] = $asumsi_inv_max;
			$data['hasil']['nama_produk1'] = "JS LINK PASAR UANG";
			$data['hasil']['persentasealokasidana1'] = $persentasealokasidana1;
		}
		else if ($alokasidana1 == "JS LINK PENDAPATAN TETAP") 
		{
			$detailproduk = $this->ModSimulasi->getDetailProduk(5);
			$asumsi_inv_min = $detailproduk['ASUMSI_INV_MIN']; 
			$asumsi_inv_med = $detailproduk['ASUMSI_INV_MED'];
			$asumsi_inv_max = $detailproduk['ASUMSI_INV_MAX'];
			$data['hasil']['asumsi_inv_min1'] = $asumsi_inv_min;
			$data['hasil']['asumsi_inv_med1'] = $asumsi_inv_med;
			$data['hasil']['asumsi_inv_max1'] = $asumsi_inv_max;
			$data['hasil']['nama_produk1'] = "JS LINK PENDAPATAN TETAP";
			$data['hasil']['persentasealokasidana1'] = $persentasealokasidana1;
		}
		else if ($alokasidana1 == "JS LINK BERIMBANG")
		{
			$detailproduk = $this->ModSimulasi->getDetailProduk(6);
			$asumsi_inv_min = $detailproduk['ASUMSI_INV_MIN']; 
			$asumsi_inv_med = $detailproduk['ASUMSI_INV_MED'];
			$asumsi_inv_max = $detailproduk['ASUMSI_INV_MAX'];
			$data['hasil']['asumsi_inv_min1'] = $asumsi_inv_min;
			$data['hasil']['asumsi_inv_med1'] = $asumsi_inv_med;
			$data['hasil']['asumsi_inv_max1'] = $asumsi_inv_max;
			$data['hasil']['nama_produk1'] = "JS LINK BERIMBANG";
			$data['hasil']['persentasealokasidana1'] = $persentasealokasidana1;
		}
		else if ($alokasidana1 == "JS LINK EKUITAS")
		{
			$detailproduk = $this->ModSimulasi->getDetailProduk(7);
			$asumsi_inv_min = $detailproduk['ASUMSI_INV_MIN']; 
			$asumsi_inv_med = $detailproduk['ASUMSI_INV_MED'];
			$asumsi_inv_max = $detailproduk['ASUMSI_INV_MAX'];
			$data['hasil']['asumsi_inv_min1'] = $asumsi_inv_min;
			$data['hasil']['asumsi_inv_med1'] = $asumsi_inv_med;
			$data['hasil']['asumsi_inv_max1'] = $asumsi_inv_max;
			$data['hasil']['nama_produk1'] = "JS LINK EKUITAS";
			$data['hasil']['persentasealokasidana1'] = $persentasealokasidana1;
		}
		
		if ($alokasidana2 == "JS LINK PASAR UANG")
		{
			$detailproduk = $this->ModSimulasi->getDetailProduk(4);
			$asumsi_inv_min = $detailproduk['ASUMSI_INV_MIN']; 
			$asumsi_inv_med = $detailproduk['ASUMSI_INV_MED'];
			$asumsi_inv_max = $detailproduk['ASUMSI_INV_MAX'];
			$data['hasil']['asumsi_inv_min2'] = $asumsi_inv_min;
			$data['hasil']['asumsi_inv_med2'] = $asumsi_inv_med;
			$data['hasil']['asumsi_inv_max2'] = $asumsi_inv_max;
			$data['hasil']['nama_produk2'] = "JS LINK PASAR UANG";
			$data['hasil']['persentasealokasidana2'] = $persentasealokasidana2;
		}
		else if ($alokasidana2 == "JS LINK PENDAPATAN TETAP") 
		{
			$detailproduk = $this->ModSimulasi->getDetailProduk(5);
			$asumsi_inv_min = $detailproduk['ASUMSI_INV_MIN']; 
			$asumsi_inv_med = $detailproduk['ASUMSI_INV_MED'];
			$asumsi_inv_max = $detailproduk['ASUMSI_INV_MAX'];
			$data['hasil']['asumsi_inv_min2'] = $asumsi_inv_min;
			$data['hasil']['asumsi_inv_med2'] = $asumsi_inv_med;
			$data['hasil']['asumsi_inv_max2'] = $asumsi_inv_max;
			$data['hasil']['nama_produk2'] = "JS LINK PENDAPATAN TETAP";
			$data['hasil']['persentasealokasidana2'] = $persentasealokasidana2;
		}
		else if ($alokasidana2 == "JS LINK BERIMBANG")
		{
			$detailproduk = $this->ModSimulasi->getDetailProduk(6);
			$asumsi_inv_min = $detailproduk['ASUMSI_INV_MIN']; 
			$asumsi_inv_med = $detailproduk['ASUMSI_INV_MED'];
			$asumsi_inv_max = $detailproduk['ASUMSI_INV_MAX'];
			$data['hasil']['asumsi_inv_min2'] = $asumsi_inv_min;
			$data['hasil']['asumsi_inv_med2'] = $asumsi_inv_med;
			$data['hasil']['asumsi_inv_max2'] = $asumsi_inv_max;
			$data['hasil']['nama_produk2'] = "JS LINK BERIMBANG";
			$data['hasil']['persentasealokasidana2'] = $persentasealokasidana2;
		}
		else if ($alokasidana2 == "JS LINK EKUITAS")
		{
			$detailproduk = $this->ModSimulasi->getDetailProduk(7);
			$asumsi_inv_min = $detailproduk['ASUMSI_INV_MIN']; 
			$asumsi_inv_med = $detailproduk['ASUMSI_INV_MED'];
			$asumsi_inv_max = $detailproduk['ASUMSI_INV_MAX'];
			$data['hasil']['asumsi_inv_min2'] = $asumsi_inv_min;
			$data['hasil']['asumsi_inv_med2'] = $asumsi_inv_med;
			$data['hasil']['asumsi_inv_max2'] = $asumsi_inv_max;
			$data['hasil']['nama_produk2'] = "JS LINK EKUITAS";
			$data['hasil']['persentasealokasidana2'] = $persentasealokasidana2;
		}
		
		$data['hasil']['juaaddb'] = $this->session->userdata('juaaddb');
		$data['hasil']['juatpd'] = $this->session->userdata('juatpd');
		$data['hasil']['juaci53'] = $this->session->userdata('juaci53');
		$data['hasil']['juatermlife'] = $this->session->userdata('juatermlife');
		
		$data['hasil']['juahcp'] = $this->session->userdata('juahcp');
		$data['hasil']['juahcpbedah'] = $this->session->userdata('juahcpbedah');
		
		$data['hasil']['juapayorbenefitdeath'] = $this->session->userdata('juapayorbenefitdeath');
		$data['hasil']['juapayorbenefittpd'] = $this->session->userdata('juapayorbenefittpd');
		$data['hasil']['juaspousepayordeath'] = $this->session->userdata('juaspousepayordeath');
		$data['hasil']['juaspousepayortpd'] = $this->session->userdata('juaspousepayortpd');
		
		$sekarang = date("Y-m-d", strtotime("now"));
		$lahircalontertanggung = date("Y-m-d", strtotime($this->session->userdata('tanggallahircalontertangggung')));
		$selisihcalontertanggung = abs(strtotime($sekarang) - strtotime($lahircalontertanggung));
		$yearscalontertanggung = floor($selisihcalontertanggung / (365*60*60*24));
		$data['hasil']['usiacalontertanggung'] = $yearscalontertanggung;
		
		$lahirnasabah = date("Y-m-d", strtotime($this->session->userdata('tgl_lahir')));
		$selisihnasabah = abs(strtotime($sekarang) - strtotime($lahirnasabah));
		$yearsnasabah = floor($selisihnasabah/ (365*60*60*24));
		$data['hasil']['usianasabah'] = $yearsnasabah;
			
		$biayaasuransiperbulanasuransidasar = $this->ModSimulasi->getBiayaAsuransiPerBulanAsuransiDasar($yearscalontertanggung);
		$biayaasuransiperbulanad = $biayaasuransiperbulanasuransidasar[$statusperokok];
		//$data['hasil']['biayaasuransiperbulanad'] = $biayaasuransiperbulanad * (($data['hasil']['uangpertanggungan'] / 12) / 10000);
		$data['hasil']['biayaasuransiperbulanad'] = round(str_replace(',', ".", $biayaasuransiperbulanad)* (($data['hasil']['uangpertanggungan'] / 12) / 10000));
		
		if ($data['hasil']['juaaddb'] != "")
		{
			$biayaasuransiperbulanaddb = $this->ModSimulasi->getBiayaAsuransiPerBulanADDB($yearscalontertanggung);
			$biayaasuransiperbulanjsaddb = $biayaasuransiperbulanaddb[$statuskelamin];
			$data['hasil']['biayaasuransiperbulanjsaddb'] = ((($biayaasuransiperbulanjsaddb/ 1000) * $data['hasil']['juaaddb']) / 12);
		}
		if ($data['hasil']['juaci53'] != "")
		{
			$biayaasuransiperbulanci53 = $this->ModSimulasi->getBiayaAsuransiPerBulanCI53($yearscalontertanggung);
			$biayaasuransiperbulanjsci53 = $biayaasuransiperbulanci53[$statuskelamin];
			$data['hasil']['biayaasuransiperbulanjsci53'] = ((($biayaasuransiperbulanjsci53/ 1000) * $data['hasil']['juaci53']) / 12);
		}
		
		$ranap = $this->session->userdata('juahcp');
		
		if ($data['hasil']['juahcp'] != "")
		{
			$biayaasuransiperbulanhcp = $this->ModSimulasi->getBiayaAsuransiPerBulanHCP($yearscalontertanggung, $ranap, $statkelaminhcp);
			$biayaasuransiperbulanjshcp = $biayaasuransiperbulanhcp['tarif'];
			$data['hasil']['icuhcp'] = $biayaasuransiperbulanhcp['icu'];
			$data['hasil']['ranaphcp'] = $biayaasuransiperbulanhcp['ranap'];
			$data['hasil']['biayaasuransiperbulanjshcp'] = $biayaasuransiperbulanjshcp / 12;
		}
		
		$plafonhcpbedah = $data['hasil']['juahcpbedah'] / 1000000;
		
		if ($data['hasil']['juahcpbedah'] != "")
		{
			$biayaasuransiperbulanhcpbedah = $this->ModSimulasi->getBiayaAsuransiPerBulanHCPBedah($yearscalontertanggung, $statkelaminhcp, $plafonhcpbedah);
			$biayaasuransiperbulanjshcpbedah = $biayaasuransiperbulanhcpbedah['tarif'];
			$data['hasil']['icuhcpbedah'] = $biayaasuransiperbulanjshcpbedah['icu'];
			$data['hasil']['ranaphcpbedah'] = $biayaasuransiperbulanjshcpbedah['ranap'];
			$data['hasil']['biayaasuransiperbulanjshcpbedah'] = $biayaasuransiperbulanjshcpbedah / 12;
		}
		
		if ($data['hasil']['juatpd'] != "")
		{
			$biayaasuransiperbulantpd = $this->ModSimulasi->getBiayaAsuransiPerBulanTPD($yearscalontertanggung);
			$biayaasuransiperbulanjstpd = $biayaasuransiperbulantpd[$statuskelamin];
			$data['hasil']['biayaasuransiperbulanjstpd'] = ((($biayaasuransiperbulanjstpd / 1000) * $data['hasil']['juatpd']) / 12);
		}
		
		if ($data['hasil']['juatermlife'] != "")
		{
			$biayaasuransiperbulantermlife = $this->ModSimulasi->getBiayaAsuransiPerBulanTermLife($yearscalontertanggung);
			$biayaasuransiperbulantl = $biayaasuransiperbulantermlife[$statusperokok];
			$data['hasil']['biayaasuransiperbulantl'] = ((($biayaasuransiperbulantl / 1000) * $data['hasil']['juatermlife']) / 12);
		}
		
		if ($data['hasil']['juapayorbenefitdeath'] != "")
		{
			$biayaasuransiperbulanpbd = $this->ModSimulasi->getBiayaAsuransiPerBulanPBD($yearsnasabah);
			$biayaasuransiperbulanjspbd = $biayaasuransiperbulanpbd[$statuskelamin];
			$data['hasil']['biayaasuransiperbulanjspbtpd'] = ((($biayaasuransiperbulanjspbd / 100) * $data['hasil']['juapayorbenefitdeath']) / 12);
		}
		
		if ($data['hasil']['juapayorbenefittpd'] != "")
		{
			$biayaasuransiperbulanpbtpd = $this->ModSimulasi->getBiayaAsuransiPerBulanPBTPD($yearsnasabah);
			$biayaasuransiperbulanjspbtpd = $biayaasuransiperbulanpbtpd[$statuskelamin];
			$data['hasil']['biayaasuransiperbulanjspbtpd'] = ((($biayaasuransiperbulanjspbtpd / 100) * $data['hasil']['juapayorbenefittpd']) / 12);
		}
		
		if ($data['hasil']['juaspousepayordeath'] != "")
		{
			$biayaasuransiperbulanspd = $this->ModSimulasi->getBiayaAsuransiPerBulanSPD($yearsnasabah);
			$biayaasuransiperbulanjsspd = $biayaasuransiperbulanspd[$statuskelamin];
			$data['hasil']['biayaasuransiperbulanjsspd'] = ((($biayaasuransiperbulanjsspd / 100) * $data['hasil']['juaspousepayordeath']) / 12);
		}
		
		if ($data['hasil']['juaspousepayortpd'] != "")
		{
			$biayaasuransiperbulansptpd = $this->ModSimulasi->getBiayaAsuransiPerBulanSPTPD($yearsnasabah);
			$biayaasuransiperbulanjssptpd = $biayaasuransiperbulansptpd[$statuskelamin];
			$data['hasil']['biayaasuransiperbulanjssptpd'] = ((($biayaasuransiperbulanjssptpd / 100) * $data['hasil']['juaspousepayortpd']) / 12);
		}
		
		if ($data['hasil']['juawp'] != "")
		{
			
		}
		
		$tanggalSekarang = date("d", strtotime("now"));
		$bulanSekarang = $bulan[date("n", strtotime("now"))];
		$tahunSekarang = date("Y", strtotime("now"));
		$data['hasil']['tanggalsekarang'] = $tanggalSekarang.' '.$bulanSekarang.' '.$tahunSekarang;
		
		$data['hasil']['asumsicutitahunan'] = $this->session->userdata('asumsicutitahunan');

		$data['hasil']['filepdf'] = $this->session->userdata('filepdf');
		$data['hasil']['nama'] = $this->session->userdata('nama');
		$data['hasil']['namaagen'] = strtoupper(str_replace("-"," ",$this->session->userdata('namaagen')));
		$kodeKantor = $this->session->userdata('kodekantor');
		$dataKantor = $this->ModSimulasi->cariDataKantor($kodeKantor);
		$data['hasil']['kantorcabang'] = $dataKantor['NAMAKANTOR'];
		$data['hasil']['nomeragen'] = $this->session->userdata('nomeragen');
		
		$NoProspek = $this->session->userdata('kodeprospek');
		//$NoProspek = 'LC151022000001';
		$DataAgen = $this->ModSimulasi->GetDataAgen($NoProspek);
		$idAgen = $DataAgen['NOAGEN'];
		
		$api = json_decode(file_get_contents(C_URL_API_JAIM."/agen.php?r=1&p=$idAgen"), true);
		
		$data['hasil']['namaagen'] = $api['NAMALENGKAP'];
		$data['hasil']['nomeragen'] = $idAgen;
		$data['hasil']['kantorcabang'] = str_replace("KANTOR CABANG","",$api['NAMAKANTOR']);
		
		$usiatemp = 99 - $data['hasil']['usiacalontertanggung'];
		$data['hasil']['indexa'] = 50 - $usiatemp;
		$data['hasil']['indexb'] = 60 - $usiatemp;
		$data['hasil']['indexc'] = 70 - $usiatemp;
		
		for($j=1;$j<=1;$j++) {	
			$data['hasil']['nilai'][$j]['topupsekaligus'] = ($data['hasil']['topupsekaligus']/1000);
		}
		
		$DataAgen = $this->ModSimulasi->GetDataAgen2($NoProspek);
		
		$IdNasabah = $DataAgen['NOPROSPEK'];
		$IdAgen = $DataAgen['NOAGEN'];
		$Nama = $DataAgen['NAMA'];
		$Alamat = $DataAgen['ALAMAT'];
		$Kota = $DataAgen['KOTA'];
		$Provinsi = $DataAgen['KDPROVINSI'];
		$Email = $DataAgen['EMAIL'];
		$Telp = $DataAgen['TELP'];
		$TglLahir = $DataAgen['TGLLAHIR'];
		$JenisKelamin = $DataAgen['JENISKELAMIN'];
		$SessionID = $this->session->userdata('session_id');
		$NomerAgen = $DataAgen['NOAGEN'];
		$Modul = $this->session->userdata('modul');
		$NamaAgen = strtoupper(str_replace("-"," ",$data['hasil']['namaagen']));
		$KodeKantor = $DataAgen['KDKANTOR'];
		$FilePDF = $this->session->userdata('filepdf');
		$IDProduk = $this->session->userdata('id_produk');
		$KodeProspek = $DataAgen['NOPROSPEK'];
		$FilePDF2 = $this->session->userdata('filepdf');
		$Usia = $data['hasil']['usiacalontertanggung'];
		$CalonPemegangPolisPerokok = $statusperokok;
		$HubunganDenganPempol = $data['hasil']['hubungandenganpempol'];
		$NamaLengkapCalonTertanggung = $data['hasil']['nama'];
		$JenisKelaminCalonTertanggung = $data['hasil']['jenis_kel'];
		$TanggalLahirCalonTertanggung = $data['hasil']['tgl_lahir'];
		$CalonTertanggungPerokok = $statusperokok;
		$AsumsiCutiTahunan = $data['hasil']['asumsicutitahunan'];
		$CaraBayar = $data['hasil']['carabayar'];
		$UangPertanggungan = $data['hasil']['uangpertanggungan'];
		$MinimalUA = $this->session->userdata('minimalua');
		$MaksimalUA = $this->session->userdata('maksimalua');
		$MataUang = $data['hasil']['matauang'];
		$StatusMedical = $this->session->userdata('statusmedical');
		$PremiBerkala = $data['hasil']['premiberkala'];
		$TopUpBerkala = $data['hasil']['topupberkala'];
		$TopUpSekaligus = $data['hasil']['topupsekaligus'];
		$BeaMaterai = $this->session->userdata('beamaterai');
		$TotalPremiYangDibayar = $data['hasil']['totalpremiyangdibayar'];
		$AlokasiDana1 = $data['hasil']['alokasidana1'];
		$AlokasiDana2 = $data['hasil']['alokasidana2'];
		$PersentaseAlokasiDana1 = $data['hasil']['persentasealokasidana1'];
		$PersentaseAlokasiDana2 = $data['hasil']['persentasealokasidana2'];
		$JuaADDB = $data['hasil']['juaaddb'];
		$JuaTPD = $data['hasil']['juatpd'];
		$DropdownHCP = $data['hasil']['juahcp']/100000;
		$JuaHCP = $data['hasil']['juahcp'];
		$DropdownHCPB = $data['hasil']['juahcpbedah']/1000000;
		$JuaHCPB = $data['hasil']['juahcpbedah'];
		$JuaCI53 = $data['hasil']['juaci53'];
		$JuaTermLife = $data['hasil']['juatermlife'];
		$JuaPayorBenefitDeath = $data['hasil']['juapayorbenefitdeath'];
		$JuaPayorBenefitTPD = $data['hasil']['juapayorbenefittpd'];
		$JuaSpousePayorDeath = $data['hasil']['juaspousepayordeath'];
		$JuaSpousePayorTPD = $data['hasil']['juaspousepayortpd'];
		$IDProposal = $data['hasil']['buildID'];
		
		/*var_dump(	$IdNasabah, $IdAgen, $Nama, $Alamat, $Kota, $Provinsi, $Email,
					$Telp, $TglLahir, $JenisKelamin, $Usia, $TanggalLahirCalonTertanggung, $AsumsiCutiTahunan, $CaraBayar, $UangPertanggungan,
					$PremiBerkala, $TopUpBerkala, $TopUpSekaligus, $AlokasiDana1, 
					$PersentaseAlokasiDana1, $PersentaseAlokasiDana2, $IDProposal	);
		*/
		
		/*$this->ModSimulasi->insertSessionTemp(	$IdNasabah, $IdAgen, $Nama, $Alamat, $Kota, $Provinsi, $Email,
												$Telp, $TglLahir, $JenisKelamin, $Usia, $TanggalLahirCalonTertanggung, $AsumsiCutiTahunan, $CaraBayar, 
												$UangPertanggungan, $PremiBerkala, $TopUpBerkala, $TopUpSekaligus, $AlokasiDana1, $AlokasiDana2, 
												$PersentaseAlokasiDana1, $PersentaseAlokasiDana2, $IDProposal
											);
		*/
		
		$data['session'] = array(
			'ID_NASABAH' => $IdNasabah,
			'ID_AGEN' => $IdAgen,
			'NAMA' => $Nama,
			'ALAMAT' => $Alamat,
			'KOTA' => $Kota,
			'PROVINSI' => $Provinsi,
			'EMAIL' => $Email,
			'TELP' => $Telp,
			'TGL_LAHIR' => $TglLahir,
			'JENIS_KEL' => $JenisKelamin,
			'USIA' => $Usia,
			'TANGGALLAHIRCALONTERTANGGGUNG' => $TanggalLahirCalonTertanggung,
			'ASUMSICUTITAHUNAN' => $AsumsiCutiTahunan,
			'CARABAYAR' => strtoupper($CaraBayar),
			'UANGPERTANGGUNGAN' => $UangPertanggungan,
			'PREMIBERKALA' => $PremiBerkala,
			'TOPUPBERKALA' => $TopUpBerkala,
			'TOPUPSEKALIGUS' => $TopUpSekaligus,
			'ALOKASIDANA1' => $AlokasiDana1,
			'ALOKASIDANA2' => $AlokasiDana2,
			'PERSENTASEALOKASIDANA1' => $PersentaseAlokasiDana1,
			'PERSENTASEALOKASIDANA2' => $PersentaseAlokasiDana2,
			'ID_PROPOSAL' => $IDProposal
		);
		
		//$this->ModSimulasi->insertSessionTemp($IDProposal);
		
		$this->ModSimulasi->insertSessionTemp($data['session']);
		
		// CALL STORED PROCEDURE FROM DATABASE
		$this->ModSimulasi->CallGenerateHasilTemp($IDProposal);
		
		//$SessionData = $this->Modsimulasi->GetSessionData($IDProposal);
		
		//echo($SessionData['IDNASABAH']);
		
		$data['hasil']['manfaat1kepret'] = $this->ModSimulasi->getManfaat1Kepret($IDProposal);
		$data['hasil']['manfaat2kepret'] = $this->ModSimulasi->getManfaat2Kepret($IDProposal);
		$data['hasil']['manfaatkeprettotal'] = $data['hasil']['manfaat1kepret'] + $data['hasil']['manfaat2kepret'] ;
			
		$filePdf = $this->session->userdata('filepdf');
		
		$this->createPDF($filePdf,$data);
		
		//var_dump($data['hasil']['manfaat1kepret']);
		
		$this->load->view('hasil/jspromapan',$data);
	}
	

	function createPDF($namaFile,$data){
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
		$this->pdf->Cell(32,5,time(),0,0,'L');
		$this->pdf->Cell(10);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Tanggal Ilustrasi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['tanggalsekarang'].'',0,0,'L');
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
		$this->pdf->Cell(32,5,''.$data['hasil']['nama'].' ',0,0,'L');
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
		
		if (($data['hasil']['juaaddb'] != "") && ($data['hasil']['biayaasuransiperbulanjsaddb'] != ""))
		{
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(47.5,5,'JS ADDB',1,0,'C');
		$this->pdf->Cell(47.5,5,'65',1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['juaaddb'],0,'.',','),1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['biayaasuransiperbulanjsaddb'],0,'.',','),1,0,'C');
		}
		
		if (($data['hasil']['juaci53'] != "") && ($data['hasil']['biayaasuransiperbulanjsci53'] != ""))
		{
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(47.5,5,'JS CI53',1,0,'C');
		$this->pdf->Cell(47.5,5,'65',1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['juaci53'],0,'.',','),1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['biayaasuransiperbulanjsci53'],0,'.',','),1,0,'C');
		}
		
		if (($data['hasil']['juahcp'] != "") && ($data['hasil']['biayaasuransiperbulanjshcp'] != ""))
		{
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(47.5,5,'JS HCP',1,0,'C');
		$this->pdf->Cell(47.5,5,'65',1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['juahcp'],0,'.',','),1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['biayaasuransiperbulanjshcp'],0,'.',','),1,0,'C');
		}
		
		if (($data['hasil']['juahcpbedah'] != "") && ($data['hasil']['biayaasuransiperbulanjshcpbedah'] != ""))
		{
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(47.5,5,'JS HCP Bedah',1,0,'C');
		$this->pdf->Cell(47.5,5,'65',1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['juahcpbedah'],0,'.',','),1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['biayaasuransiperbulanjshcpbedah'],0,'.',','),1,0,'C');
		}
		
		if (($data['hasil']['juatpd'] != "") && ($data['hasil']['biayaasuransiperbulanjstpd'] != ""))
		{
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(47.5,5,'JS TPD',1,0,'C');
		$this->pdf->Cell(47.5,5,'65',1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['juatpd'],0,'.',','),1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['biayaasuransiperbulanjstpd'],0,'.',','),1,0,'C');
		}
		
		if (($data['hasil']['juatermlife'] != "") && ($data['hasil']['biayaasuransiperbulantl'] != ""))
		{
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(47.5,5,'JS Term Life',1,0,'C');
		$this->pdf->Cell(47.5,5,'65',1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['juatermlife'],0,'.',','),1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['biayaasuransiperbulantl'],0,'.',','),1,0,'C');
		}
		
		if (($data['hasil']['juapayorbenefitdeath'] != "") && ($data['hasil']['biayaasuransiperbulanjspbd'] != ""))
		{
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(47.5,5,'JS Payor Benefit Death',1,0,'C');
		$this->pdf->Cell(47.5,5,'65',1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['juapayorbenefitdeath'],0,'.',','),1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['biayaasuransiperbulanjspbd'],0,'.',','),1,0,'C');
		}
		
		if (($data['hasil']['juapayorbenefittpd'] != "") && ($data['hasil']['biayaasuransiperbulanjspbtpd'] != ""))
		{
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(47.5,5,'JS Payor Benefit TPD',1,0,'C');
		$this->pdf->Cell(47.5,5,'65',1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['juapayorbenefittpd'],0,'.',','),1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['biayaasuransiperbulanjspbtpd'],0,'.',','),1,0,'C');
		}
		
		if (($data['hasil']['juaspousepayordeath'] != "") && ($data['hasil']['biayaasuransiperbulanjsspd'] != ""))
		{
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(47.5,5,'JS Spouse Payor Death',1,0,'C');
		$this->pdf->Cell(47.5,5,'65',1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['juaspousepayordeath'],0,'.',','),1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['biayaasuransiperbulanjsspd'],0,'.',','),1,0,'C');
		}
		
		if (($data['hasil']['juaspousepayortpd'] != "") && ($data['hasil']['biayaasuransiperbulanjssptpd'] != ""))
		{
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(47.5,5,'JS Spouse Payor TPD',1,0,'C');
		$this->pdf->Cell(47.5,5,'65',1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['juaspousepayortpd'],0,'.',','),1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['biayaasuransiperbulanjssptpd'],0,'.',','),1,0,'C');
		}
		
		$this->pdf->ln(5);
		
		// ILUSTRASI INI BUKAN MERUPAKAN KOTNRAK ASURANSI
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','B',4);
		$this->pdf->Cell(50,5,'JS PROMAPAN',0,0,'L');
		$this->pdf->Cell(140,5,'Apabila Tertanggung mencapai usia 99 Tahun, manfaat yang dibayarkan adalah sebesar Nilai investasi (Jumlah Unit x NAB). Apabila Tertanggung meninggal dunia dalam masa perjanjian Asuransi baik',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->Cell(50,5,'',0,0,'C');
		$this->pdf->Cell(140,5,'karena sakit, karena kecelakaan, maka kepada ahli waris atau yang ditunjuk dibayarkan Uang Asuransi JS PROMAPAN ditambah Saldo Dana Investasi.',0,0,'L');
		$this->pdf->ln(0);
		$this->pdf->Cell(50,5,'','B',0,'C');
		$this->pdf->Cell(140,5,'','B',0,'L');
		$this->pdf->ln(4);
		
		if (($data['hasil']['juaaddb'] != "") && ($data['hasil']['biayaasuransiperbulanjsaddb'] != ""))
		{
		$this->pdf->SetFont('Arial','B',4);
		$this->pdf->Cell(50,5,'JS ADDB',0,0,'L');
		$this->pdf->Cell(140,5,'Apabila Tertanggung meninggal dunia / cacat karena kecelakaan dan Usia Tertanggung tidak lebih dari 65 Tahun, maka akan dibayarkan Uang Asuransi JS Accident Death and Dismembermen Benefit.',0,0,'L');
		$this->pdf->ln(0);
		$this->pdf->Cell(50,5,'','B',0,'L');
		$this->pdf->Cell(140,5,'','B',0,'L');
		}
		
		if (($data['hasil']['juatpd'] != "") && ($data['hasil']['biayaasuransiperbulanjstpd'] != ""))
		{
		$this->pdf->ln(4);
		$this->pdf->SetFont('Arial','B',4);
		$this->pdf->Cell(50,5,'JS TPD',0,0,'L');
		$this->pdf->Cell(140,5,'Apabila Tertanggung mengalami Total Permanent Disability dan Usia Tertanggung tidak lebih dari 65 Tahun, maka akan dibayarkan Uang Asuransi JS Total Permanen Disability Benefit.',0,0,'L');
		$this->pdf->ln(0);
		$this->pdf->Cell(50,5,'','B',0,'L');
		$this->pdf->Cell(140,5,'','B',0,'L');
		}
		
		if (($data['hasil']['juahcp'] != "") && ($data['hasil']['biayaasuransiperbulanjshcp'] != ""))
		{
		$this->pdf->ln(4);
		$this->pdf->SetFont('Arial','B',4);
		$this->pdf->Cell(50,5,'JS HCP',0,0,'L');
		$this->pdf->Cell(140,5,'Memberikan santunan harian Rawat Inap, ICU, Pembedahan setelah JS Hospital Cash Plan berlangsung 90 hari atau lebih dan Usia Tertanggung tidak lebih dari 65 dengan minimum 2 x 24 jam dan maksimum',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->Cell(50,5,'','B',0,'L');
		$this->pdf->Cell(140,5,'180 hari dalam satu tahun.','B',0,'L');
		}
		
		if (($data['hasil']['juahcpbedah'] != "") && ($data['hasil']['biayaasuransiperbulanjshcpbedah'] != ""))
		{
		$this->pdf->ln(4);
		$this->pdf->SetFont('Arial','B',4);
		$this->pdf->Cell(50,5,'JS HCP BEDAH',0,0,'L');
		$this->pdf->Cell(140,5,'Memberikan santunan harian Rawat Inap, ICU, Pembedahan setelah JS Hospital Cash Plan berlangsung 90 hari atau lebih dan Usia Tertanggung tidak lebih dari 65 dengan minimum 2 x 24 jam dan maksimum',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->Cell(50,5,'','B',0,'L');
		$this->pdf->Cell(140,5,'180 hari dalam satu tahun.','B',0,'L');
		}
		
		if (($data['hasil']['juaci53'] != "") && ($data['hasil']['biayaasuransiperbulanjsci53'] != ""))
		{
		$this->pdf->ln(4);
		$this->pdf->SetFont('Arial','B',4);
		$this->pdf->Cell(50,5,'JS CI 53',0,0,'L');
		$this->pdf->Cell(140,5,'Apabila Tertanggung didiagnosa untuk pertama kali mengalami salah satu dari 53 jenis penyakit kritis, maka akan dibayarkan manfaat JS CI 53.',0,0,'L');
		$this->pdf->ln(0);
		$this->pdf->Cell(50,5,'','B',0,'L');
		$this->pdf->Cell(140,5,'','B',0,'L');
		}
		
		if (($data['hasil']['juatermlife'] != "") && ($data['hasil']['biayaasuransiperbulantl'] != ""))
		{
		$this->pdf->ln(4);
		$this->pdf->SetFont('Arial','B',4);
		$this->pdf->Cell(50,5,'JS TERM',0,0,'L');
		$this->pdf->Cell(140,5,'Apabila Tertanggung meninggal dunia karena Sakit atau kecelakaan usia tertanggung tidak lebih dari 65 Tahun, maka akan dibayarkan Uang Asuransi JS Term Rider.',0,0,'L');
		$this->pdf->ln(0);
		$this->pdf->Cell(50,5,'','B',0,'L');
		$this->pdf->Cell(140,5,'','B',0,'L');
		}
		
		if (($data['hasil']['juapayorbenefitdeath'] != "") && ($data['hasil']['biayaasuransiperbulanjspbd'] != ""))
		{
		$this->pdf->ln(4);
		$this->pdf->SetFont('Arial','B',4);
		$this->pdf->Cell(50,5,'JS PAYOR BENEFIT - DEATH',0,0,'L');
		$this->pdf->Cell(140,5,'Apabila Pemegang Polis meninggal dunia baik karena sakit maupun karena kecelakaan dalam masa perjanjian asuransi, maka manfaat pembebasan pembayaran premi berkala akan diberikan kepada',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->Cell(50,5,'','B',0,'L');
		$this->pdf->Cell(140,5,'pengganti Pemegang Polis.', 'B',0,'L');
		}
		
		if (($data['hasil']['juapayorbenefittpd'] != "") && ($data['hasil']['biayaasuransiperbulanjspbtpd'] != ""))
		{
		$this->pdf->ln(4);
		$this->pdf->SetFont('Arial','B',4);
		$this->pdf->Cell(50,5,'JS PAYOR BENEFIT - TPD',0,0,'L');
		$this->pdf->Cell(140,5,'Apabila Pemegang Polis menderita Cacat Tetap Total (TPD) baik karena sakit maupun karena kecelakaan dalam masa perjanjian asuransi, maka manfaat pembebasan pembayaran premi berkala akan ',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->Cell(50,5,'','B',0,'L');
		$this->pdf->Cell(140,5,'diberikan kepada Pemegang Polis.', 'B',0,'L');
		}
		
		if (($data['hasil']['juaspousepayordeath'] != "") && ($data['hasil']['biayaasuransiperbulanjsspd'] != ""))
		{
		$this->pdf->ln(4);
		$this->pdf->SetFont('Arial','B',4);
		$this->pdf->Cell(50,5,'JS SPOUSE PAYOR - DEATH',0,0,'L');
		$this->pdf->Cell(140,5,'Apabila Pemegang Polis meninggal dunia baik karena sakit maupun karena kecelakaan dalam masa perjanjian asuransi, maka manfaat pembebasan pembayaran premi berkala akan diberikan kepada',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->Cell(50,5,'','B',0,'L');
		$this->pdf->Cell(140,5,'Tertanggung.', 'B',0,'L');
		}
		
		if (($data['hasil']['juaspousepayortpd'] != "") && ($data['hasil']['biayaasuransiperbulanjssptpd'] != ""))
		{
		$this->pdf->ln(4);
		$this->pdf->SetFont('Arial','B',4);
		$this->pdf->Cell(50,5,'JS SPOUSE PAYOR - TPD',0,0,'L');
		$this->pdf->Cell(140,5,'Apabila Pemegang Polis menderita Cacat Tetap Total baik karena sakit maupun karena kecelakaan dalam masa perjanjian asuransi, maka manfaat pembebasan pembayaran premi berkala akan diberikan',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->Cell(50,5,'','B',0,'L');
		$this->pdf->Cell(140,5,'kepada Tertanggung.', 'B',0,'L');
		}
		
		$this->pdf->ln(0);
		
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
		$this->pdf->Cell(29,5,time(),0,0,'L');
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
		if (($data['hasil']['nama_produk1'] != "") && ($data['hasil']['persentasealokasidana1'] != "") && ($data['hasil']['persentasealokasidana1'] != 0))
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
		$this->pdf->Cell(190,5,'JS PROMAPAN (Jiwasraya Proteksi Masa Depan Aman)','B',0,'L');
		$this->pdf->ln(6);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(6);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,''.$data['hasil']['alokasidana1'].' ','B',0,'C');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(40,5,'',0,0,'C');
		$this->pdf->Cell(60,5,'MANFAAT INVESTASI',0,0,'C');
		$this->pdf->Cell(60,5,'MANFAAT MENINGGAL DUNIA',0,0,'C');
		$this->pdf->ln(6);
		
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(15,5,'Tahun',1,0,'C');
		$this->pdf->Cell(15,5,'Usia ^',1,0,'C');
		$this->pdf->Cell(20,5,'Premi',1,0,'C');
		$this->pdf->Cell(20,5,'Top Up',1,0,'C');
		$this->pdf->Cell(20,5,'Rendah',1,0,'C');
		$this->pdf->Cell(20,5,'Sedang',1,0,'C');
		$this->pdf->Cell(20,5,'Tinggi',1,0,'C');
		$this->pdf->Cell(20,5,'Rendah',1,0,'C');
		$this->pdf->Cell(20,5,'Sedang',1,0,'C');
		$this->pdf->Cell(20,5,'Tinggi',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		
		/*for($i=1;$i<=20;$i++){
			$this->pdf->Cell(15,5,' '.$i.' ','LBR',0,'C');
			$this->pdf->Cell(15,5,$data['hasil']['nilai'][$i]['usiacalontertanggung'],1,0,'C');
			$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['premi'],0,'.',','),1,0,'C');
			$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['topupsekaligus'],0,'.',','),1,0,'C');
			
			if ($data['hasil']['nilai'][$i]['manfaatinvestasirendah'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasirendah'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasirendah'],1,0,'C');
			}
			else if ($data['hasil']['nilai'][$i]['manfaatinvestasirendah'] == 0)
			{
				$data['hasil']['nilai'][$i]['manfaatinvestasirendah']  = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasirendah'],1,0,'C');
			}
			else
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasirendah'] = ($data['hasil']['nilai'][$i]['manfaatinvestasirendah'] / 1000);
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatinvestasirendah'] * ($data['hasil']['persentasealokasidana1'] / 100),0,'.',','),1,0,'C');
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatinvestasisedang'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasisedang'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasisedang'],1,0,'C');
			}
			else if ($data['hasil']['nilai'][$i]['manfaatinvestasisedang'] == 0)
			{
				$data['hasil']['nilai'][$i]['manfaatinvestasisedang']  = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasisedang'],1,0,'C');
			}
			else
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasisedang'] = ($data['hasil']['nilai'][$i]['manfaatinvestasisedang'] / 1000); 
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatinvestasisedang'] * ($data['hasil']['persentasealokasidana1'] / 100),0,'.',','),1,0,'C');
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatinvestasitinggi'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasitinggi'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasitinggi'],1,0,'C');
			}
			else if ($data['hasil']['nilai'][$i]['manfaatinvestasitinggi'] == 0)
			{
				$data['hasil']['nilai'][$i]['manfaatinvestasitinggi']  = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasitinggi'],1,0,'C');
			}
			else
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasitinggi'] = ($data['hasil']['nilai'][$i]['manfaatinvestasitinggi'] / 1000); 
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatinvestasitinggi'] * ($data['hasil']['persentasealokasidana1'] / 100),0,'.',','),1,0,'C');
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah'],1,0,'C');
			}
			else
			{	
				if ($data['hasil']['nilai'][$i]['manfaatinvestasirendah'] == "***")
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah'] = "***";
					$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah'],1,0,'C');
				}
				else
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah'] = ($data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah']/ 1000); 
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah'] * ($data['hasil']['persentasealokasidana1'] / 100),0,'.',','),1,0,'C');
				}
				
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang'],1,0,'C');
			}
			else
			{	
				if ($data['hasil']['nilai'][$i]['manfaatinvestasisedang'] == "***")
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang'] = "***";
					$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang'],1,0,'C');
				}
				else
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang'] = ($data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang']/ 1000); 
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang'] * ($data['hasil']['persentasealokasidana1'] / 100),0,'.',','),1,0,'C');
				}
				
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi'],1,0,'C');
			}
			else
			{	
				if ($data['hasil']['nilai'][$i]['manfaatinvestasitinggi'] == "***")
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi'] = "***";
					$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi'],1,0,'C');
				}
				else
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi'] = ($data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi']/ 1000); 
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi'] * ($data['hasil']['persentasealokasidana1'] / 100),0,'.',','),1,0,'C');
				}
				
			}
			
			
			//HIDDEN VALUE
			$this->pdf->Cell(500,5,number_format($data['hasil']['nilai'][$i]['premiberkala'],0,'.',','),0,0,'C');
			$this->pdf->Cell(500,5,number_format($data['hasil']['nilai'][$i]['topupberkala'],0,'.',','),0,0,'C');
			
			$this->pdf->ln();
		}
		for($i=100-$data['hasil']['usiacalontertanggung'];$i<=100-$data['hasil']['usiacalontertanggung'];$i++){
			$this->pdf->Cell(15,5,' '.$i.' ','LBR',0,'C');
			$this->pdf->Cell(15,5,$data['hasil']['nilai'][$i]['usiacalontertanggung'],1,0,'C');
			$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['premi'],0,'.',','),1,0,'C');
			$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['topupsekaligus'],0,'.',','),1,0,'C');
			
			if ($data['hasil']['nilai'][$i]['manfaatinvestasirendah'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasirendah'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasirendah'],1,0,'C');
			}
			else if ($data['hasil']['nilai'][$i]['manfaatinvestasirendah'] == 0)
			{
				$data['hasil']['nilai'][$i]['manfaatinvestasirendah']  = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasirendah'],1,0,'C');
			}
			else
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasirendah'] = ($data['hasil']['nilai'][$i]['manfaatinvestasirendah'] / 1000);
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatinvestasirendah'] * ($data['hasil']['persentasealokasidana1'] / 100),0,'.',','),1,0,'C');
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatinvestasisedang'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasisedang'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasisedang'],1,0,'C');
			}
			else if ($data['hasil']['nilai'][$i]['manfaatinvestasisedang'] == 0)
			{
				$data['hasil']['nilai'][$i]['manfaatinvestasisedang']  = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasisedang'],1,0,'C');
			}
			else
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasisedang'] = ($data['hasil']['nilai'][$i]['manfaatinvestasisedang'] / 1000); 
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatinvestasisedang'] * ($data['hasil']['persentasealokasidana1'] / 100),0,'.',','),1,0,'C');
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatinvestasitinggi'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasitinggi'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasitinggi'],1,0,'C');
			}
			else if ($data['hasil']['nilai'][$i]['manfaatinvestasitinggi'] == 0)
			{
				$data['hasil']['nilai'][$i]['manfaatinvestasitinggi']  = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasitinggi'],1,0,'C');
			}
			else
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasitinggi'] = ($data['hasil']['nilai'][$i]['manfaatinvestasitinggi'] / 1000); 
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatinvestasitinggi'] * ($data['hasil']['persentasealokasidana1'] / 100),0,'.',','),1,0,'C');
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah'],1,0,'C');
			}
			else
			{	
				if ($data['hasil']['nilai'][$i]['manfaatinvestasirendah'] == "***")
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah'] = "***";
					$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah'],1,0,'C');
				}
				else
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah'] = ($data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah']/ 1000); 
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah'] * ($data['hasil']['persentasealokasidana1'] / 100),0,'.',','),1,0,'C');
				}
				
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang'],1,0,'C');
			}
			else
			{	
				if ($data['hasil']['nilai'][$i]['manfaatinvestasisedang'] == "***")
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang'] = "***";
					$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang'],1,0,'C');
				}
				else
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang'] = ($data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang']/ 1000); 
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang'] * ($data['hasil']['persentasealokasidana1'] / 100),0,'.',','),1,0,'C');
				}
				
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi'],1,0,'C');
			}
			else
			{	
				if ($data['hasil']['nilai'][$i]['manfaatinvestasitinggi'] == "***")
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi'] = "***";
					$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi'],1,0,'C');
				}
				else
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi'] = ($data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi']/ 1000); 
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi'] * ($data['hasil']['persentasealokasidana1'] / 100),0,'.',','),1,0,'C');
				}
				
			}
			
			
			//HIDDEN VALUE
			$this->pdf->Cell(500,5,number_format($data['hasil']['nilai'][$i]['premiberkala'],0,'.',','),0,0,'C');
			$this->pdf->Cell(500,5,number_format($data['hasil']['nilai'][$i]['topupberkala'],0,'.',','),0,0,'C');
			
			$this->pdf->ln();
		}
		*/
		
		foreach ($data['hasil']['manfaat1kepret'] as $i => $v) {
			if ($i <= 30 || ($i > 30 && ($v['USIA'] == '50' || $v['USIA'] == '60' || $v['USIA'] == '70' || $v['USIA'] == '80' || $v['USIA'] == '90' || $v['USIA'] == '99'))) {
				$this->pdf->Cell(15,4,' '.$v['TAHUN'].' ','L',0,'C');
				$this->pdf->Cell(15,4,$v['USIA'],'L',0,'C');
				$this->pdf->Cell(20,4,number_format($v['PREMI'],0,'.',','),'L',0,'C');
				$this->pdf->Cell(20,4,number_format($v['TOPUP'],0,'.',','),'L',0,'C');
				
				$this->pdf->Cell(20,4,number_format($v['MANFAAT_RENDAH'],0,'.',','),'L',0,'R');
				$this->pdf->Cell(20,4,number_format($v['MANFAAT_SEDANG'],0,'.',','),'L',0,'R');
				$this->pdf->Cell(20,4,number_format($v['MANFAAT_TINGGI'],0,'.',','),'L',0,'R');
				$this->pdf->Cell(20,4,number_format($v['MENINGGAL_RENDAH'],0,'.',','),'L',0,'R');
				$this->pdf->Cell(20,4,number_format($v['MENINGGAL_SEDANG'],0,'.',','),'L',0,'R');
				$this->pdf->Cell(20,4,number_format($v['MENINGGAL_TINGGI'],0,'.',','),'LR',0,'R');
				
				$this->pdf->ln();
			}
		}

		$this->pdf->SetFillColor(204,255,255);
		$this->pdf->Cell(190,1,'',1,0,'C', true);
		$this->pdf->ln();
		
		// ASUMSI TINGKAT INVESTASI
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(190,5,'Asumsi tingkat investasi yang digunakan adalah sebagai berikut :',0,0,'L');
		$this->pdf->ln();
		
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,5,'Dana Investasi',1,0,'C');
		$this->pdf->Cell(20,5,'Rendah **',1,0,'C');
		$this->pdf->Cell(20,5,'Sedang **',1,0,'C');
		$this->pdf->Cell(20,5,'Tinggi **',1,0,'C');
		$this->pdf->ln();
		
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(40,5,''.$data['hasil']['nama_produk1'].' ',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(20,5,''.$data['hasil']['asumsi_inv_min1'].' %',1,0,'C');
		$this->pdf->Cell(20,5,''.$data['hasil']['asumsi_inv_med1'].' %',1,0,'C');
		$this->pdf->Cell(20,5,''.$data['hasil']['asumsi_inv_max1'].' %',1,0,'C');
		$this->pdf->ln();
		
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(20,4,'^',0,0,'L');
		$this->pdf->Cell(170,4,'Masa Asuransi sampai dengan Tertanggung mencapai usia 99 tahun.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(20,4,'*',0,0,'L');
		$this->pdf->Cell(170,4,'Ilustrasi di atas dalam ribuan rupiah.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(20,4,'**',0,0,'L');
		$this->pdf->Cell(170,4,'Asumsi tinggi rendahnya tingkat hasil investasi ini hanya bertujuan untuk ilustrasi saja dan bukan merupakan tolak ukur untuk perhitungan rata-rata tingkat hasil investasi',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(20,4,'',0,0,'L');
		$this->pdf->Cell(170,4,'yang terendah dan tertinggi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(20,4,'***',0,0,'L');
		$this->pdf->Cell(170,4,'Menunjukkan bahwa Nilai Tunai pada tahun tersebut tidak mencukupi untuk membayar Biaya Asuransi dan administrasi, dan oleh karena itu Polis akan batal (lapse).',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(20,4,'',0,0,'L');
		$this->pdf->Cell(170,4,'Supaya Manfaat Polis dapat terus berlanjut, maka Anda diminta untuk melanjutkan pembayaran premi tahunan seperti dinyatakan dalam ilutrasi ini.',0,0,'L');
		$this->pdf->ln(8);
		
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
		$this->pdf->Cell(29,5,time(),0,0,'L');
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
		
		$this->pdf->ln();
		$this->pdf->AliasNbPages('{totalPages}');
		$this->pdf->Cell(190, 5, "Page " . $this->pdf->PageNo() . "/{totalPages}",' ', 0, 'R');
		
		}
		
		// PAGE 3
		if (($data['hasil']['nama_produk2'] != "") && ($data['hasil']['persentasealokasidana2'] != "") && ($data['hasil']['persentasealokasidana2'] != 0))
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
		$this->pdf->Cell(190,5,'JS PROMAPAN (Jiwasraya Proteksi Masa Depan Aman)','B',0,'L');
		$this->pdf->ln(6);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(6);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,''.$data['hasil']['alokasidana2'].' ','B',0,'C');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(40,5,'',0,0,'C');
		$this->pdf->Cell(60,5,'MANFAAT INVESTASI',0,0,'C');
		$this->pdf->Cell(60,5,'MANFAAT MENINGGAL DUNIA',0,0,'C');
		$this->pdf->ln(6);
		
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(15,5,'Tahun',1,0,'C');
		$this->pdf->Cell(15,5,'Usia ^',1,0,'C');
		$this->pdf->Cell(20,5,'Premi',1,0,'C');
		$this->pdf->Cell(20,5,'Top Up',1,0,'C');
		$this->pdf->Cell(20,5,'Rendah',1,0,'C');
		$this->pdf->Cell(20,5,'Sedang',1,0,'C');
		$this->pdf->Cell(20,5,'Tinggi',1,0,'C');
		$this->pdf->Cell(20,5,'Rendah',1,0,'C');
		$this->pdf->Cell(20,5,'Sedang',1,0,'C');
		$this->pdf->Cell(20,5,'Tinggi',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		
		/*for($i=1;$i<=20;$i++){
			$this->pdf->Cell(15,5,' '.$i.' ','LBR',0,'C');
			$this->pdf->Cell(15,5,$data['hasil']['nilai'][$i]['usiacalontertanggung'],1,0,'C');
			$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['premi'],0,'.',','),1,0,'C');
			$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['topupsekaligus'],0,'.',','),1,0,'C');
			
			if ($data['hasil']['nilai'][$i]['manfaatinvestasirendah2'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasirendah2'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasirendah2'],1,0,'C');
			}
			else if ($data['hasil']['nilai'][$i]['manfaatinvestasirendah2'] == 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasirendah2'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasirendah2'],1,0,'C');
			}
			else
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasirendah2'] = ($data['hasil']['nilai'][$i]['manfaatinvestasirendah2'] / 1000); 
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatinvestasirendah2'] * ($data['hasil']['persentasealokasidana2'] / 100),0,'.',','),1,0,'C');
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatinvestasisedang2'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasisedang2'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasisedang2'],1,0,'C');
			}
			else if ($data['hasil']['nilai'][$i]['manfaatinvestasisedang2'] == 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasisedang2'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasisedang2'],1,0,'C');
			}
			else
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasisedang2'] = ($data['hasil']['nilai'][$i]['manfaatinvestasisedang2'] / 1000); 
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatinvestasisedang2'] * ($data['hasil']['persentasealokasidana2'] / 100),0,'.',','),1,0,'C');
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatinvestasitinggi2'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasitinggi2'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasitinggi2'],1,0,'C');
			}
			else if ($data['hasil']['nilai'][$i]['manfaatinvestasitinggi2'] == 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasitinggi2'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasitinggi2'],1,0,'C');
			}
			else
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasitinggi2'] = ($data['hasil']['nilai'][$i]['manfaatinvestasitinggi2'] / 1000); 
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatinvestasitinggi2'] * ($data['hasil']['persentasealokasidana2'] / 100),0,'.',','),1,0,'C');
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah2'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah2'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah2'],1,0,'C');
			}
			else
			{	
				if ($data['hasil']['nilai'][$i]['manfaatinvestasirendah2'] == "***")
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah2'] = "***";
					$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah2'],1,0,'C');
				}
				else
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah2'] = ($data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah2']/ 1000); 
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah2'] * ($data['hasil']['persentasealokasidana2'] / 100),0,'.',','),1,0,'C');
				}
				
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang2'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang2'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang2'],1,0,'C');
			}
			else
			{	
				if ($data['hasil']['nilai'][$i]['manfaatinvestasisedang2'] == "***")
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang2'] = "***";
					$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang2'],1,0,'C');
				}
				else
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang2'] = ($data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang2']/ 1000); 
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang2'] * ($data['hasil']['persentasealokasidana2'] / 100),0,'.',','),1,0,'C');
				}
				
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi2'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi2'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi2'],1,0,'C');
			}
			else
			{	
				if ($data['hasil']['nilai'][$i]['manfaatinvestasitinggi2'] == "***")
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi2'] = "***";
					$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi2'],1,0,'C');
				}
				else
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi2'] = ($data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi2']/ 1000); 
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi2'] * ($data['hasil']['persentasealokasidana2'] / 100),0,'.',','),1,0,'C');
				}
				
			}
			
			//HIDDEN VALUE
			$this->pdf->Cell(500,5,number_format($data['hasil']['nilai'][$i]['premiberkala'],0,'.',','),0,0,'C');
			$this->pdf->Cell(500,5,number_format($data['hasil']['nilai'][$i]['topupberkala'],0,'.',','),0,0,'C');
			
			$this->pdf->ln();
		}
		for($i=100-$data['hasil']['usiacalontertanggung'];$i<=100-$data['hasil']['usiacalontertanggung'];$i++){
			$this->pdf->Cell(15,5,' '.$i.' ','LBR',0,'C');
			$this->pdf->Cell(15,5,$data['hasil']['nilai'][$i]['usiacalontertanggung'],1,0,'C');
			$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['premi'],0,'.',','),1,0,'C');
			$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['topupsekaligus'],0,'.',','),1,0,'C');
			
			if ($data['hasil']['nilai'][$i]['manfaatinvestasirendah2'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasirendah2'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasirendah2'],1,0,'C');
			}
			else if ($data['hasil']['nilai'][$i]['manfaatinvestasirendah2'] == 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasirendah2'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasirendah2'],1,0,'C');
			}
			else
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasirendah2'] = ($data['hasil']['nilai'][$i]['manfaatinvestasirendah2'] / 1000); 
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatinvestasirendah2'] * ($data['hasil']['persentasealokasidana2'] / 100),0,'.',','),1,0,'C');
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatinvestasisedang2'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasisedang2'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasisedang2'],1,0,'C');
			}
			else if ($data['hasil']['nilai'][$i]['manfaatinvestasisedang2'] == 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasisedang2'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasisedang2'],1,0,'C');
			}
			else
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasisedang2'] = ($data['hasil']['nilai'][$i]['manfaatinvestasisedang2'] / 1000); 
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatinvestasisedang2'] * ($data['hasil']['persentasealokasidana2'] / 100),0,'.',','),1,0,'C');
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatinvestasitinggi2'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasitinggi2'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasitinggi2'],1,0,'C');
			}
			else if ($data['hasil']['nilai'][$i]['manfaatinvestasitinggi2'] == 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasitinggi2'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasitinggi2'],1,0,'C');
			}
			else
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasitinggi2'] = ($data['hasil']['nilai'][$i]['manfaatinvestasitinggi2'] / 1000); 
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatinvestasitinggi2'] * ($data['hasil']['persentasealokasidana2'] / 100),0,'.',','),1,0,'C');
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah2'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah2'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah2'],1,0,'C');
			}
			else
			{	
				if ($data['hasil']['nilai'][$i]['manfaatinvestasirendah2'] == "***")
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah2'] = "***";
					$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah2'],1,0,'C');
				}
				else
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah2'] = ($data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah2']/ 1000); 
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah2'] * ($data['hasil']['persentasealokasidana2'] / 100),0,'.',','),1,0,'C');
				}
				
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang2'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang2'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang2'],1,0,'C');
			}
			else
			{	
				if ($data['hasil']['nilai'][$i]['manfaatinvestasisedang2'] == "***")
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang2'] = "***";
					$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang2'],1,0,'C');
				}
				else
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang2'] = ($data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang2']/ 1000); 
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang2'] * ($data['hasil']['persentasealokasidana2'] / 100),0,'.',','),1,0,'C');
				}
				
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi2'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi2'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi2'],1,0,'C');
			}
			else
			{	
				if ($data['hasil']['nilai'][$i]['manfaatinvestasitinggi2'] == "***")
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi2'] = "***";
					$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi2'],1,0,'C');
				}
				else
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi2'] = ($data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi2']/ 1000); 
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi2'] * ($data['hasil']['persentasealokasidana2'] / 100),0,'.',','),1,0,'C');
				}
				
			}
			
			//HIDDEN VALUE
			$this->pdf->Cell(500,5,number_format($data['hasil']['nilai'][$i]['premiberkala'],0,'.',','),0,0,'C');
			$this->pdf->Cell(500,5,number_format($data['hasil']['nilai'][$i]['topupberkala'],0,'.',','),0,0,'C');
			
			$this->pdf->ln();
		}*/
		
		foreach ($data['hasil']['manfaat2kepret'] as $i => $v) {
			if ($i < 30 || ($i > 30 && ($v['USIA'] == '50' || $v['USIA'] == '60' || $v['USIA'] == '70' || $v['USIA'] == '80' || $v['USIA'] == '90' || $v['USIA'] == '99'))) {
				$this->pdf->Cell(15,4,' '.$v['TAHUN'].' ','L',0,'C');
				$this->pdf->Cell(15,4,$v['USIA'],'L',0,'C');
				$this->pdf->Cell(20,4,number_format($v['PREMI'],0,'.',','),'L',0,'C');
				$this->pdf->Cell(20,4,number_format($v['TOPUP'],0,'.',','),'L',0,'C');
				
				$this->pdf->Cell(20,4,number_format($v['MANFAAT_RENDAH'],0,'.',','),'L',0,'R');
				$this->pdf->Cell(20,4,number_format($v['MANFAAT_SEDANG'],0,'.',','),'L',0,'R');
				$this->pdf->Cell(20,4,number_format($v['MANFAAT_TINGGI'],0,'.',','),'L',0,'R');
				$this->pdf->Cell(20,4,number_format($v['MENINGGAL_RENDAH'],0,'.',','),'L',0,'R');
				$this->pdf->Cell(20,4,number_format($v['MENINGGAL_SEDANG'],0,'.',','),'L',0,'R');
				$this->pdf->Cell(20,4,number_format($v['MENINGGAL_TINGGI'],0,'.',','),'LR',0,'R');
				
				$this->pdf->ln();
			}
		}
		
		$this->pdf->SetFillColor(204,255,255);
		$this->pdf->Cell(190,1,'',1,0,'C', true);
		$this->pdf->ln();
		
		// ASUMSI TINGKAT INVESTASI
		
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(190,5,'Asumsi tingkat investasi yang digunakan adalah sebagai berikut :',0,0,'L');
		$this->pdf->ln();
		
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,5,'Dana Investasi',1,0,'C');
		$this->pdf->Cell(20,5,'Rendah **',1,0,'C');
		$this->pdf->Cell(20,5,'Sedang **',1,0,'C');
		$this->pdf->Cell(20,5,'Tinggi **',1,0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(40,5,''.$data['hasil']['nama_produk2'].' ',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(20,5,''.$data['hasil']['asumsi_inv_min2'].' %',1,0,'C');
		$this->pdf->Cell(20,5,''.$data['hasil']['asumsi_inv_med2'].' %',1,0,'C');
		$this->pdf->Cell(20,5,''.$data['hasil']['asumsi_inv_max2'].' %',1,0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(20,4,'^',0,0,'L');
		$this->pdf->Cell(170,4,'Masa Asuransi sampai dengan Tertanggung mencapai usia 99 tahun.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(20,4,'*',0,0,'L');
		$this->pdf->Cell(170,4,'Ilustrasi di atas dalam ribuan rupiah.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(20,4,'**',0,0,'L');
		$this->pdf->Cell(170,4,'Asumsi tinggi rendahnya tingkat hasil investasi ini hanya bertujuan untuk ilustrasi saja dan bukan merupakan tolak ukur untuk perhitungan rata-rata tingkat hasil investasi',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(20,4,'',0,0,'L');
		$this->pdf->Cell(170,4,'yang terendah dan tertinggi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(20,4,'***',0,0,'L');
		$this->pdf->Cell(170,4,'Menunjukkan bahwa Nilai Tunai pada tahun tersebut tidak mencukupi untuk membayar Biaya Asuransi dan administrasi, dan oleh karena itu Polis akan batal (lapse).',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(20,4,'',0,0,'L');
		$this->pdf->Cell(170,4,'Supaya Manfaat Polis dapat terus berlanjut, maka Anda diminta untuk melanjutkan pembayaran premi tahunan seperti dinyatakan dalam ilutrasi ini.',0,0,'L');
		$this->pdf->ln(8);
		
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
		$this->pdf->Cell(29,5,time(),0,0,'L');
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
		
		$this->pdf->ln();
		$this->pdf->AliasNbPages('{totalPages}');
		$this->pdf->Cell(190, 5, "Page " . $this->pdf->PageNo() . "/{totalPages}",' ', 0, 'R');
		
		}
		
		/*
		// PAGE 4
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
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,'RINGKASAN','B',0,'C');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(40,5,'',0,0,'C');
		$this->pdf->Cell(60,5,'MANFAAT INVESTASI',0,0,'C');
		$this->pdf->Cell(60,5,'MANFAAT MENINGGAL DUNIA',0,0,'C');
		$this->pdf->ln(10);
		
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(15,5,'Tahun',1,0,'C');
		$this->pdf->Cell(15,5,'Usia ^',1,0,'C');
		$this->pdf->Cell(20,5,'Premi',1,0,'C');
		$this->pdf->Cell(20,5,'Top Up',1,0,'C');
		$this->pdf->Cell(20,5,'Rendah',1,0,'C');
		$this->pdf->Cell(20,5,'Sedang',1,0,'C');
		$this->pdf->Cell(20,5,'Tinggi',1,0,'C');
		$this->pdf->Cell(20,5,'Rendah',1,0,'C');
		$this->pdf->Cell(20,5,'Sedang',1,0,'C');
		$this->pdf->Cell(20,5,'Tinggi',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);

		for($i=1;$i<=20;$i++){
			$this->pdf->Cell(15,5,' '.$i.' ','LBR',0,'C');
			$this->pdf->Cell(15,5,$data['hasil']['nilai'][$i]['usiacalontertanggung'],1,0,'C');
			$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['premi'],0,'.',','),1,0,'C');
			$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['topupsekaligus'],0,'.',','),1,0,'C');
			
			if ($data['hasil']['nilai'][$i]['manfaatinvestasirendahringkasan'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasirendahringkasan'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasirendahringkasan'],1,0,'C');
			}
			else if ($data['hasil']['nilai'][$i]['manfaatinvestasirendahringkasan'] == 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasirendahringkasan'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasirendahringkasan'],1,0,'C');
			}
			else
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasirendahringkasan'] = ($data['hasil']['nilai'][$i]['manfaatinvestasirendahringkasan'] / 1000);
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatinvestasirendahringkasan'],0,'.',','),1,0,'C');
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatinvestasisedangringkasan'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasisedangringkasan'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasisedangringkasan'],1,0,'C');
			}
			else if ($data['hasil']['nilai'][$i]['manfaatinvestasisedangringkasan'] == 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasisedangringkasan'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasisedangringkasan'],1,0,'C');
			}
			else
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasisedangringkasan'] = ($data['hasil']['nilai'][$i]['manfaatinvestasisedangringkasan'] / 1000); 
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatinvestasisedangringkasan'],0,'.',','),1,0,'C');
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatinvestasitinggiringkasan'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasitinggiringkasan'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasitinggiringkasan'],1,0,'C');
			}
			else if ($data['hasil']['nilai'][$i]['manfaatinvestasitinggiringkasan'] == 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasitinggiringkasan'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasitinggiringkasan'],1,0,'C');
			}
			else
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasitinggiringkasan'] = ($data['hasil']['nilai'][$i]['manfaatinvestasitinggiringkasan'] / 1000); 
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatinvestasitinggiringkasan'],0,'.',','),1,0,'C');
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahringkasan'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahringkasan'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahringkasan'],1,0,'C');
			}
			else
			{	
				if ($data['hasil']['nilai'][$i]['manfaatinvestasirendahringkasan'] == "***")
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahringkasan'] = "***";
					$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahringkasan'],1,0,'C');
				}
				else
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahringkasan'] = ($data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahringkasan']/ 1000); 
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahringkasan'],0,'.',','),1,0,'C');
				}
				
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangringkasan'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangringkasan'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangringkasan'],1,0,'C');
			}
			else
			{	
				if ($data['hasil']['nilai'][$i]['manfaatinvestasisedangringkasan'] == "***")
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangringkasan'] = "***";
					$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangringkasan'],1,0,'C');
				}
				else
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangringkasan'] = ($data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangringkasan']/ 1000); 
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangringkasan'],0,'.',','),1,0,'C');
				}
				
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggiringkasan'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggiringkasan'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggiringkasan'],1,0,'C');
			}
			else
			{	
				if ($data['hasil']['nilai'][$i]['manfaatinvestasitinggiringkasan'] == "***")
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggiringkasan'] = "***";
					$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggiringkasan'],1,0,'C');
				}
				else
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggiringkasan'] = ($data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggiringkasan']/ 1000); 
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggiringkasan'],0,'.',','),1,0,'C');
				}
				
			}
			
			//HIDDEN VALUE
			$this->pdf->Cell(500,5,number_format($data['hasil']['nilai'][$i]['premiberkala'],0,'.',','),0,0,'C');
			$this->pdf->Cell(500,5,number_format($data['hasil']['nilai'][$i]['topupberkala'],0,'.',','),0,0,'C');
			
			$this->pdf->ln();
		}
		for($i=100-$data['hasil']['usiacalontertanggung'];$i<=100-$data['hasil']['usiacalontertanggung'];$i++){
			$this->pdf->Cell(15,5,' '.$i.' ','LBR',0,'C');
			$this->pdf->Cell(15,5,$data['hasil']['nilai'][$i]['usiacalontertanggung'],1,0,'C');
			$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['premi'],0,'.',','),1,0,'C');
			$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['topupsekaligus'],0,'.',','),1,0,'C');
			
			if ($data['hasil']['nilai'][$i]['manfaatinvestasirendahringkasan'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasirendahringkasan'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasirendahringkasan'],1,0,'C');
			}
			else if ($data['hasil']['nilai'][$i]['manfaatinvestasirendahringkasan'] == 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasirendahringkasan'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasirendahringkasan'],1,0,'C');
			}
			else
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasirendahringkasan'] = ($data['hasil']['nilai'][$i]['manfaatinvestasirendahringkasan'] / 1000);
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatinvestasirendahringkasan'],0,'.',','),1,0,'C');
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatinvestasisedangringkasan'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasisedangringkasan'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasisedangringkasan'],1,0,'C');
			}
			else if ($data['hasil']['nilai'][$i]['manfaatinvestasisedangringkasan'] == 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasisedangringkasan'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasisedangringkasan'],1,0,'C');
			}
			else
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasisedangringkasan'] = ($data['hasil']['nilai'][$i]['manfaatinvestasisedangringkasan'] / 1000); 
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatinvestasisedangringkasan'],0,'.',','),1,0,'C');
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatinvestasitinggiringkasan'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasitinggiringkasan'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasitinggiringkasan'],1,0,'C');
			}
			else if ($data['hasil']['nilai'][$i]['manfaatinvestasitinggiringkasan'] == 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasitinggiringkasan'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasitinggiringkasan'],1,0,'C');
			}
			else
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasitinggiringkasan'] = ($data['hasil']['nilai'][$i]['manfaatinvestasitinggiringkasan'] / 1000); 
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatinvestasitinggiringkasan'],0,'.',','),1,0,'C');
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahringkasan'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahringkasan'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahringkasan'],1,0,'C');
			}
			else
			{	
				if ($data['hasil']['nilai'][$i]['manfaatinvestasirendahringkasan'] == "***")
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahringkasan'] = "***";
					$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahringkasan'],1,0,'C');
				}
				else
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahringkasan'] = ($data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahringkasan']/ 1000); 
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahringkasan'],0,'.',','),1,0,'C');
				}
				
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangringkasan'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangringkasan'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangringkasan'],1,0,'C');
			}
			else
			{	
				if ($data['hasil']['nilai'][$i]['manfaatinvestasisedangringkasan'] == "***")
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangringkasan'] = "***";
					$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangringkasan'],1,0,'C');
				}
				else
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangringkasan'] = ($data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangringkasan']/ 1000); 
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangringkasan'],0,'.',','),1,0,'C');
				}
				
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggiringkasan'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggiringkasan'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggiringkasan'],1,0,'C');
			}
			else
			{	
				if ($data['hasil']['nilai'][$i]['manfaatinvestasitinggiringkasan'] == "***")
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggiringkasan'] = "***";
					$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggiringkasan'],1,0,'C');
				}
				else
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggiringkasan'] = ($data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggiringkasan']/ 1000); 
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggiringkasan'],0,'.',','),1,0,'C');
				}
				
			}
			
			//HIDDEN VALUE
			$this->pdf->Cell(500,5,number_format($data['hasil']['nilai'][$i]['premiberkala'],0,'.',','),0,0,'C');
			$this->pdf->Cell(500,5,number_format($data['hasil']['nilai'][$i]['topupberkala'],0,'.',','),0,0,'C');
			
			$this->pdf->ln();
		}

		$this->pdf->SetFillColor(204,255,255);
		$this->pdf->Cell(190,1,'',1,0,'C', true);
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(10,5,'^',0,0,'L');
		$this->pdf->Cell(170,5,'Masa Asuransi sampai dengan Tertanggung mencapai usia 99 tahun.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(10,5,'*',0,0,'L');
		$this->pdf->Cell(170,5,'Ilustrasi di atas dalam ribuan rupiah.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(10,5,'**',0,0,'L');
		$this->pdf->Cell(170,5,'Asumsi tinggi rendahnya tingkat hasil investasi ini hanya bertujuan untuk ilustrasi saja dan bukan merupakan tolak ukur untuk perhitungan rata-rata tingkat hasil investasi',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(10,5,'',0,0,'L');
		$this->pdf->Cell(170,5,'yang terendah dan tertinggi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(10,5,'***',0,0,'L');
		$this->pdf->Cell(170,5,'Menunjukkan bahwa Nilai Tunai pada tahun tersebut tidak mencukupi untuk membayar Biaya Asuransi dan administrasi, dan oleh karena itu Polis',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(10,5,'',0,0,'L');
		$this->pdf->Cell(170,5,'akan batal (lapse). Supaya Manfaat Polis dapat terus berlanjut, maka Anda diminta untuk melanjutkan pembayaran premi tahunan seperti dinyatakan dalam ilutrasi ini.',0,0,'L');
		
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
		$this->pdf->Cell(29,5,time(),0,0,'L');
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
		
		
		// PAGE 5
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
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,'KOMPARASI RINGKASAN 1','B',0,'C');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(40,5,'',0,0,'C');
		$this->pdf->Cell(60,5,'MANFAAT INVESTASI',0,0,'C');
		$this->pdf->Cell(60,5,'MANFAAT MENINGGAL DUNIA',0,0,'C');
		$this->pdf->ln(10);
		
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(15,5,'Tahun',1,0,'C');
		$this->pdf->Cell(15,5,'Usia ^',1,0,'C');
		$this->pdf->Cell(20,5,'Premi',1,0,'C');
		$this->pdf->Cell(20,5,'Top Up',1,0,'C');
		$this->pdf->Cell(20,5,'Rendah',1,0,'C');
		$this->pdf->Cell(20,5,'Sedang',1,0,'C');
		$this->pdf->Cell(20,5,'Tinggi',1,0,'C');
		$this->pdf->Cell(20,5,'Rendah',1,0,'C');
		$this->pdf->Cell(20,5,'Sedang',1,0,'C');
		$this->pdf->Cell(20,5,'Tinggi',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);

		for($i=1;$i<=20;$i++){
			$this->pdf->Cell(15,5,' '.$i.' ','LBR',0,'C');
			$this->pdf->Cell(15,5,$data['hasil']['nilai'][$i]['usiacalontertanggung'],1,0,'C');
			$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['premikomparasiringkasan'],0,'.',','),1,0,'C');
			$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['topupsekaligus'],0,'.',','),1,0,'C');
			
			if ($data['hasil']['nilai'][$i]['manfaatinvestasirendahkr'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasirendahkr'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasirendahkr'],1,0,'C');
			}
			else if ($data['hasil']['nilai'][$i]['manfaatinvestasirendahkr'] == 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasirendahkr'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasirendahkr'],1,0,'C');
			}
			else
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasirendahkr'] = ($data['hasil']['nilai'][$i]['manfaatinvestasirendahkr'] / 1000);
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatinvestasirendahkr'],0,'.',','),1,0,'C');
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatinvestasisedangkr'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasisedangkr'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasisedangkr'],1,0,'C');
			}
			else if ($data['hasil']['nilai'][$i]['manfaatinvestasisedangkr'] == 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasisedangkr'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasisedangkr'],1,0,'C');
			}
			else
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasisedangkr'] = ($data['hasil']['nilai'][$i]['manfaatinvestasisedangkr'] / 1000); 
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatinvestasisedangkr'],0,'.',','),1,0,'C');
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatinvestasitinggikr'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasitinggikr'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasitinggikr'],1,0,'C');
			}
			else if ($data['hasil']['nilai'][$i]['manfaatinvestasitinggikr'] == 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasitinggikr'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasitinggikr'],1,0,'C');
			}
			else
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasitinggikr'] = ($data['hasil']['nilai'][$i]['manfaatinvestasitinggikr'] / 1000); 
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatinvestasitinggikr'],0,'.',','),1,0,'C');
			}
			
			
			if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahkr'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahkr'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahkr'],1,0,'C');
			}
			else
			{	
				if ($data['hasil']['nilai'][$i]['manfaatinvestasirendahkr'] == "***")
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahkr'] = "***";
					$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahkr'],1,0,'C');
				}
				else
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahkr'] = ($data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahkr']/ 1000); 
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahkr'],0,'.',','),1,0,'C');
				}
				
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangkr'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangkr'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangkr'],1,0,'C');
			}
			else
			{	
				if ($data['hasil']['nilai'][$i]['manfaatinvestasisedangkr'] == "***")
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangkr'] = "***";
					$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangkr'],1,0,'C');
				}
				else
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangkr'] = ($data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangkr']/ 1000); 
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangkr'],0,'.',','),1,0,'C');
				}
				
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggikr'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggikr'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggikr'],1,0,'C');
			}
			else
			{	
				if ($data['hasil']['nilai'][$i]['manfaatinvestasitinggikr'] == "***")
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggikr'] = "***";
					$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggikr'],1,0,'C');
				}
				else
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggikr'] = ($data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggikr']/ 1000); 
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggikr'],0,'.',','),1,0,'C');
				}
				
			}
			
			//HIDDEN VALUE
			$this->pdf->Cell(500,5,number_format($data['hasil']['nilai'][$i]['premiberkalakomparasiringkasan'],0,'.',','),0,0,'C');
			$this->pdf->Cell(500,5,number_format($data['hasil']['nilai'][$i]['topupberkala'],0,'.',','),0,0,'C');
			
			$this->pdf->ln();
		}
		for($i=100-$data['hasil']['usiacalontertanggung'];$i<=100-$data['hasil']['usiacalontertanggung'];$i++){
			$this->pdf->Cell(15,5,' '.$i.' ','LBR',0,'C');
			$this->pdf->Cell(15,5,$data['hasil']['nilai'][$i]['usiacalontertanggung'],1,0,'C');
			$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['premikomparasiringkasan'],0,'.',','),1,0,'C');
			$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['topupsekaligus'],0,'.',','),1,0,'C');
			
			if ($data['hasil']['nilai'][$i]['manfaatinvestasirendahkr'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasirendahkr'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasirendahkr'],1,0,'C');
			}
			else if ($data['hasil']['nilai'][$i]['manfaatinvestasirendahkr'] == 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasirendahkr'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasirendahkr'],1,0,'C');
			}
			else
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasirendahkr'] = ($data['hasil']['nilai'][$i]['manfaatinvestasirendahkr'] / 1000);
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatinvestasirendahkr'],0,'.',','),1,0,'C');
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatinvestasisedangkr'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasisedangkr'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasisedangkr'],1,0,'C');
			}
			else if ($data['hasil']['nilai'][$i]['manfaatinvestasisedangkr'] == 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasisedangkr'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasisedangkr'],1,0,'C');
			}
			else
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasisedangkr'] = ($data['hasil']['nilai'][$i]['manfaatinvestasisedangkr'] / 1000); 
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatinvestasisedangkr'],0,'.',','),1,0,'C');
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatinvestasitinggikr'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasitinggikr'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasitinggikr'],1,0,'C');
			}
			else if ($data['hasil']['nilai'][$i]['manfaatinvestasitinggikr'] == 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasitinggikr'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatinvestasitinggikr'],1,0,'C');
			}
			else
			{	
				$data['hasil']['nilai'][$i]['manfaatinvestasitinggikr'] = ($data['hasil']['nilai'][$i]['manfaatinvestasitinggikr'] / 1000); 
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatinvestasitinggikr'],0,'.',','),1,0,'C');
			}
			
			
			if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahkr'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahkr'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahkr'],1,0,'C');
			}
			else
			{	
				if ($data['hasil']['nilai'][$i]['manfaatinvestasirendahkr'] == "***")
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahkr'] = "***";
					$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahkr'],1,0,'C');
				}
				else
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahkr'] = ($data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahkr']/ 1000); 
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniarendahkr'],0,'.',','),1,0,'C');
				}
				
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangkr'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangkr'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangkr'],1,0,'C');
			}
			else
			{	
				if ($data['hasil']['nilai'][$i]['manfaatinvestasisedangkr'] == "***")
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangkr'] = "***";
					$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangkr'],1,0,'C');
				}
				else
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangkr'] = ($data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangkr']/ 1000); 
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniasedangkr'],0,'.',','),1,0,'C');
				}
				
			}
			
			if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggikr'] < 0)
			{	
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggikr'] = "***";
				$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggikr'],1,0,'C');
			}
			else
			{	
				if ($data['hasil']['nilai'][$i]['manfaatinvestasitinggikr'] == "***")
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggikr'] = "***";
					$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggikr'],1,0,'C');
				}
				else
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggikr'] = ($data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggikr']/ 1000); 
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggikr'],0,'.',','),1,0,'C');
				}
				
			}
			
			
			//HIDDEN VALUE
			$this->pdf->Cell(500,5,number_format($data['hasil']['nilai'][$i]['premiberkalakomparasiringkasan'],0,'.',','),0,0,'C');
			$this->pdf->Cell(500,5,number_format($data['hasil']['nilai'][$i]['topupberkala'],0,'.',','),0,0,'C');
			
			$this->pdf->ln();
		}

		$this->pdf->SetFillColor(204,255,255);
		$this->pdf->Cell(190,1,'',1,0,'C', true);
		$this->pdf->ln();
		
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(10,5,'1',0,0,'L');
		$this->pdf->Cell(170,5,'Apabila pembayaran premi dilakukan sampai usia Tertanggung 99 Tahun.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(10,5,'^',0,0,'L');
		$this->pdf->Cell(170,5,'Masa Asuransi sampai dengan Tertanggung mencapai usia 99 tahun.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(10,5,'*',0,0,'L');
		$this->pdf->Cell(170,5,'Ilustrasi di atas dalam ribuan rupiah.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(10,5,'**',0,0,'L');
		$this->pdf->Cell(170,5,'Asumsi tinggi rendahnya tingkat hasil investasi ini hanya bertujuan untuk ilustrasi saja dan bukan merupakan tolak ukur untuk perhitungan rata-rata tingkat hasil investasi',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(10,5,'',0,0,'L');
		$this->pdf->Cell(170,5,'yang terendah dan tertinggi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(10,5,'***',0,0,'L');
		$this->pdf->Cell(170,5,'Menunjukkan bahwa Nilai Tunai pada tahun tersebut tidak mencukupi untuk membayar Biaya Asuransi dan administrasi, dan oleh karena itu Polis',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(10,5,'',0,0,'L');
		$this->pdf->Cell(170,5,'akan batal (lapse). Supaya Manfaat Polis dapat terus berlanjut, maka Anda diminta untuk melanjutkan pembayaran premi tahunan seperti dinyatakan dalam ilutrasi ini.',0,0,'L');
		
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
		$this->pdf->Cell(29,5,time(),0,0,'L');
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
		*/
		
		// PAGE 6
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
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(5);
		
		// HAL-HAL PENTING
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'HAL-HAL PENTING',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'1. Alokasi Premi yang dibentuk ke dalam Premi',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(35,5,'',0,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'Tahun 1',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'Tahun 2',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'Tahun 3',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'Tahun 4',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'Tahun 5',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'Tahun 6',1,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(35,5,'Premi Berkala',1,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'',1,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(35,5,'Investasi',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'10%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'50%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'60%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'70%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'90%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'100%',1,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(35,5,'Biaya',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'90%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'50%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'40%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'30%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'10%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'0%',1,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(35,5,'Top Up',1,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'',1,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(35,5,'Investasi',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'95%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'95%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'95%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'95%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'95%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'95%',1,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(35,5,'Biaya',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'5%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'5%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'5%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'5%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'5%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'5%',1,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(6);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'2. Ilustrasi di atas akan diperhitungkan dengan:',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4);
		$this->pdf->Cell(190,5,'a. Biaya administrasi sebesar Rp. 27,500.- per bulan selama masa asuransi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4);
		$this->pdf->Cell(190,5,'b. Biaya Asuransi (Cost Of insurance dan Cost Of Rider) akan dikenakan setiap bulan selama masa Asuransi. Besarnya COI dan COR akan naik setiap tahun sesuai dengan bertambahnya usia',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(6);
		$this->pdf->Cell(190,5,'Tertanggung.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4);
		$this->pdf->Cell(190,5,'c. Biaya pengelolaan investasi maksimal 2% per tahun tergantung jenis reksadana yang dipilih.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4);
		$this->pdf->Cell(190,5,'d. Biaya pembelian unit adalah sebesar 5% dari dana investasi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'3. Jika unit yang terbentuk pada tahun 1 tidak mencukupi untuk membayar Biaya Asuransi, dan Biaya Administrasi, maka biaya-biaya tersebut dinyatakan sebagai biaya-biaya terhutang yang akan',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4);
		$this->pdf->Cell(190,5,'dipotong dari unit unit yang terbentuk pada bulan ke 13.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'4. Nilai Tunai adalah Nilai Saldo Unit yang dihitung berdasarkan Harga Unit pada saat tertentu.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'5. Asumsi tinggi rendahnya tingkat hasil investasi ini hanya bertujuan untuk ilustrasi saja dan bukan merupakan tolak ukur untuk perhitungan rata-rata tingkat hasil investasi yang terendah dan tertinggi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'6. Perubahan harga unit menggambarkan hasil investasi dari dana investasi. Kinerja dari investasi tidak dijamin tergantung dari risiko masing-masing dana investasi. Pemegang Polis diberi',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4);
		$this->pdf->Cell(190,5,'keleluasaan untuk menempatkan alokasi dana investasi yang memungkinkan Optimalisasi tingkat pengembalian investasi, sesuai dengan kebutuhan dan profil risiko Pemegang Polis.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(145,5,'7. Besarnya Nilai Tunai yang dibayarkan (bisa lebih besar atau lebih kecil dari yang diilustrasikan) akan bergantung pada perkembangan dari dana investasi',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(2);
		$this->pdf->Cell(0,5,'JS PROMAPAN.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'8. Jumlah minimum Top Up Sekaligus adalah Rp. 1,000,000.-,',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'9. Minimum penarikan dana (Redemptions) adalah Rp. 1,000,000.- dan menyisakan dana minimum Rp. 2,000,000.-',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(190,5,'10. Pemegang Polis tidak dikenakan biaya penarikan dana, jika penarikan dilakukan setelah usia polis 2 tahun. Jika penarikan dana dilakukan selama usia polis kurang dari 2 tahun, maka akan',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4);
		$this->pdf->Cell(12,5,'dikenakan biaya sebesar 2% dari total dana penarikan.',0,0,'L');
		$this->pdf->ln();
		/*$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(190,5,'11. Untuk setiap penarikan sebelum usia polis 3 tahun, akan dikenakan pajak penghasilan sesuai ketentuan pemerintah yang berlaku atas kelebihan Nilai Tunai terhadap total premi yang dibayarkan ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4);
		$this->pdf->Cell(12,5,'kecuali ditentukan lain berdasarkan peraturan perundang-undangan yang berlaku. Peraturan perpajakan dapat berubah sesuai keputusan legislatif dan di luar kebijakan PT. Asuransi',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4);
		$this->pdf->Cell(12,5,'Jiwasraya (Persero) sebagai Penanggung.',0,0,'L');
		$this->pdf->ln();*/
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(190,5,'11. Penilaian harga unit dilakukan pada setiap hari kerja, Senin sampai dengan Jum`at dengan menggunakan metode harga pasar yang berlaku bagi instrumen investasi yang mendasari masing-',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4);
		$this->pdf->Cell(12,5,'masing alokasi dana investasi yang dipilih.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(190,5,'12. Besarnya Nilai Tunai yang terbentuk pada polis ini (dapat lebih besar atau lebih kecil dari dana yang diinvestasikan oleh Pemegang Polis), akan dipengaruhi oleh fluktuasi dari harga unit atau faktor ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4);
		$this->pdf->Cell(12,5,'biaya-biaya sebagaimana disebutkan di atas.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(190,5,'13. Perpanjangan masa pertanggungan asuransi tambahan setelah berakhirnya masa asuransi akan dilakukan underwriting/seleksi risiko ulang sehingga perpanjangan dapat diterima dengan rate ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4);
		$this->pdf->Cell(12,5,'standar atau bahkan ditolak.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(190,5,'14. Harga unit yang digunakan pada Premi Pertama akan terbentuk setelah diterimanya SPAJ dan teridentifikasinya seluruh pembayaran Premi Pertama di Kantor Pusat oleh Jiwasraya. Tanggal',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->ln();
		$this->pdf->Cell(4);
		$this->pdf->Cell(190,5,'Perhitungan Harga Unit adalah Tanggal Perhitungan berikutnya setelah diterimanya SPAJ. Atau teridentifikasinya seluruh pembayaran Premi pertama di Kantor Pusat, mana yang paling akhir.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(190,5,'15. Memiliki Polis Asuransi Jiwa merupakan komitmen jangka panjang. JS PROMAPAN adalah suatu produk asuransi jiwa yang dikaitkan dengan investasi. Untuk dapat menikmati manfaat polis ini,',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4);
		$this->pdf->Cell(12,5,'maka kami sarankan Anda untuk melakukan pembayaran Premi selama Masa Asuransi.',0,0,'L');
		$this->pdf->ln(0);
		
		// FOOTER
		$this->pdf->Cell(190,5,'','B',0,'L');
		$this->pdf->ln(25);

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
		$this->pdf->Cell(29,5,time(),0,0,'L');
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
		
		// PAGE 7
		if (($data['hasil']['juahcp'] != "") && ($data['hasil']['biayaasuransiperbulanjshcp'] != ""))
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
		$this->pdf->Cell(190,5,'JS PROMAPAN (Jiwasraya Proteksi Masa Depan Aman)','B',0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(6);
		
		// MANFAAT JS HOSPITAL CASH PLAN
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'Manfaat JS Hospital Cash Plan',0,0,'L');
		$this->pdf->ln(6);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(31.67,5,'Santunan','LTR',0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(31.67,5,'HCP - 100','LTR',0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(31.67,5,'HCP - 200','LTR',0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(31.67,5,'HCP - 300','LTR',0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(31.67,5,'HCP - 400','LTR',0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(31.67,5,'HCP - 500','LTR',0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(31.67,5,'(dalam ribuan Rupiah)','LBR',0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(31.67,5,'','LBR',0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(31.67,5,'','LBR',0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(31.67,5,'','LBR',0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(31.67,5,'','LBR',0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(31.67,5,'','LBR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(31.67,5,'Santunan harian RS','LTR',0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(31.67,5,'100','LTR',0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(31.67,5,'200','LTR',0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(31.67,5,'300','LTR',0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(31.67,5,'400','LTR',0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(31.67,5,'500','LTR',0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(31.67,5,'Maksimal 180 hari / tahun','LBR',0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(31.67,5,'','LBR',0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(31.67,5,'','LBR',0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(31.67,5,'','LBR',0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(31.67,5,'','LBR',0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(31.67,5,'','LBR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(31.67,5,'Santunan harian ICU / ICCU','LTR',0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(31.67,5,'200','LTR',0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(31.67,5,'400','LTR',0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(31.67,5,'600','LTR',0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(31.67,5,'800','LTR',0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(31.67,5,'1,000','LTR',0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(31.67,5,'Maksimal 10 hari / perawatan','LBR',0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(31.67,5,'','LBR',0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(31.67,5,'','LBR',0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(31.67,5,'','LBR',0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(31.67,5,'','LBR',0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(31.67,5,'','LBR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(31.67,5,'Biaya Operasi',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(31.67,5,'1,000',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(31.67,5,'2,000',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(31.67,5,'3,000',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(31.67,5,'4,000',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(31.67,5,'5,000',1,0,'C');
		$this->pdf->ln(6);
		
		// PENGECUALIAN
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(2);
		$this->pdf->Cell(190,5,'Pengecualian',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(2);
		$this->pdf->Cell(190,5,'1. Masa Tunggu',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4.5);
		$this->pdf->Cell(190,5,'Penyakit yang diderita Tertanggung dalam Masa Tunggu. Perawatan rawat inap yang disebabkan oleh Kecelakaan, tidak ada masa tunggu.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(2);
		$this->pdf->Cell(190,5,'2. Akibat Perbuatan Sendiri',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4.5);
		$this->pdf->Cell(190,5,'Akibat percobaan bunuh diri atau cidera yang diakibatkan oleh perbuatan sendiri yang disengaja baik dalam keadaan sadar maupun tidak sadar.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(2);
		$this->pdf->Cell(190,5,'3. Alat Kosmetika',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4.5);
		$this->pdf->Cell(190,5,'Operasi atau perawatan kosmetika kecuali yang dinyatakan perlu karena akibat Kecelakaan yang terjadi selama Masa Asuransi.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(2);
		$this->pdf->Cell(190,5,'4. Tindak Kejahatan',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4.5);
		$this->pdf->Cell(190,5,'Perawatan yang disebabkan karena Tertanggung dengan sengaja melakukan atau turut serta dalam tindak kejahatan.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(2);
		$this->pdf->Cell(190,5,'5. Cacat Bawaan',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4.5);
		$this->pdf->Cell(190,5,'Cacat bawaan (kelainan fisik sebelum dan atau yang terbentuk dalam waktu 14 (empat belas) hari setelah lahir).',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(2);
		$this->pdf->Cell(190,5,'6. Kejiwaan',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4.5);
		$this->pdf->Cell(190,5,'Penyakit kejiwaan dan gangguan mental lainnya.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(2);
		$this->pdf->Cell(190,5,'7. Proses Kehamilan',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4.5);
		$this->pdf->Cell(190,5,'Segala jenis Abortus, penyakit yang berhubungan dengan kehamilan, usaha yang berhubungan dengan kesuburan, dan kelahiran bayi.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(2);
		$this->pdf->Cell(190,5,'8. Penyakit Kelamin',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4.5);
		$this->pdf->Cell(190,5,'Pengobatan penyakit kelamin atau penyakit yang ditularkan melalui hubungan seksual, termasuk AIDS (Acquired Immune Deficiency Syndrom) dan ARC (AIDS Related Complex).',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(2);
		$this->pdf->Cell(190,5,'9. Perawatan Kurang dari 48 jam',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4.5);
		$this->pdf->Cell(190,5,'Penyakit yang memerlukan perawatan di rumah sakit kurang dari 48(empat puluh delapan) jam.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'10. Pengobatan Gigi',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4.5);
		$this->pdf->Cell(190,5,'Perawatan dan pengobatan gigi, termasuk operasi gigi, kecuali dinyatakan perlu karena cidera akibat Kecelakaan.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'11. Perawatan Biasa / Rutin',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4.5);
		$this->pdf->Cell(190,5,'Perawatan atau pengobatan yang tidak diperlukan secara medis atau tidak berhubungan dengan pengobatan suatu penyakit atau cidera.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'12. Akibat Obat Terlarang',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4.5);
		$this->pdf->Cell(190,5,'Penyakit atau cidera yang timbul akibat pemakaian obat-obat terlarang atau alkohol.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'13. Peperangan',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4.5);
		$this->pdf->Cell(190,5,'Cidera atau penyakit yang timbul akibat perang atau tindakan peperangan, yang dinyatakan atau tidak, huru-hara, bentrokan, atau keributan sipil.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'14. Olah Raga Berbahaya',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4.5);
		$this->pdf->Cell(190,5,'Cidera atau penyakit yang timbul dari olah raga atau hobby berbahaya yaitu segala jenis perlombaan balap (kecuali balap lari), terjun payung, terbang layang, berlayar atau berenang di laut lepas,',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4.5);
		$this->pdf->Cell(190,5,'mendaki gunung, bertinju, bergulat, serta olah raga',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->ln(3);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'15. Penumpang Pesawat Terbang',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4.5);
		$this->pdf->Cell(190,5,'Tertanggung sebagai penumpang pesawat terbang :',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4.5);
		$this->pdf->Cell(190,5,'- Yang diselenggarakan oleh perusahaan penerbangan non komersial.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4.5);
		$this->pdf->Cell(190,5,'- Yang diselenggarakan oleh perusahaan penerbangan penumpang komersial (Commercial Passenger Airlines) tetapi tidak sedang melayani jalur penerbangan untuk pengangkutan umum yang',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(6);
		$this->pdf->Cell(190,5,'terjadwal tetap dan teratur (charter flight).',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4.5);
		$this->pdf->Cell(190,5,'- Helikopter.',0,0,'L');
		$this->pdf->ln(40);
		
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
		$this->pdf->Cell(29,5,time(),0,0,'L');
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
		
		// PAGE 8
		
		if (($data['hasil']['juaci53'] != "") && ($data['hasil']['biayaasuransiperbulanjsci53'] != ""))
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
		$this->pdf->Cell(190,5,'JS PROMAPAN (Jiwasraya Proteksi Masa Depan Aman)','B',0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(6);
		
		// 53 Penyakit Kritis
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'53 Penyakit Kritis',0,0,'L');
		$this->pdf->ln(4);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(2);
		$this->pdf->Cell(190,5,'1. Kanker (Cancer).',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(2);
		$this->pdf->Cell(190,5,'2. Serangan Jantung (Myocardial Infractions).',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(2);
		$this->pdf->Cell(190,5,'3. Stroke (Stroke).',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(2);
		$this->pdf->Cell(190,5,'4. Penyakit Arteri Koronaria yang mensyaratkan Pembedahan (Coronary Artery Disease Surgery).',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(2);
		$this->pdf->Cell(190,5,'5. Gagal Ginjal (Renal Failure / Kidney Failure / End Stage Renal Disease).',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(2);
		$this->pdf->Cell(190,5,'6. Pencangkokan Organ Tubuh Utama (Major Organ Transplantation).',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(2);
		$this->pdf->Cell(190,5,'7. Lumpuh (Paralysis).',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(2);
		$this->pdf->Cell(190,5,'8. Kehilangan Kemampuan Melihat (Blindness).',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(2);
		$this->pdf->Cell(190,5,'9. Operasi Katup Jantung (Heart Valve Surgery).',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'10. Operasi Pembuluh darah Aorta (Surgery of Aorta).',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'11. Alzheimer (Alzheimer`s Disease).',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'12. Amyotrophic Lateral Schlerosis.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'13. Angioplasty.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'14. Anemia Aplastik (Aplastic Anaemia).',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'15. Radang Selaput Otak (Bacterial Meningitis).',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'16. Tumor Jinak Otak (Benign Brain Tumor).',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'17. Penyakit Paru-paru Kronis (Chronic Lung Disease).',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'18. Koma (Coma).',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'19. Pengobatan Arteri Koroner dengan Laser (Coronary Laser Treatment).',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'20. Kehilangan Kemampuan Mendengar (Deafness).',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'21. Radang Otak (Enchepalitis).',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'22. Hepatitis Fulminant.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'23. Kehilangan Anggota Tubuh (Loss of Limits).',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'24. Kehilangan Kemampuan Berbicara (Loss of Speech).',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'25. Luka Bakar (Major Burns).',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'26. Memar Otak Serius (Major Head Trauma).',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'27. Penyakit Motor Neuron.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'28. Muscullar Dystrophy.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'29. Parkinson (Parkinson`s Disease).',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'30. Pulmonary Arterial Hypertension.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'31. Multiple Sclerosis.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'32. Poliomyelitis.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'33. Lupus Eritematosus Sistemik (Systemic Lupus Erythematosus).',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'34. Penyakit Hati Kronis.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'35. Colitis Ulcerative Berat (Cronh`s Disease).',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'36. HIV yang disebabkan oleh transfusi darah dan terjangkit dari suatu jenis pekerjaan.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'37. Terminal Illness.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'38. Kista Medullary.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'39. Pankreatitis menahun yang berulang.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'40. Hilangnya kemandirian hidup.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'41. Rheumatoid Arthritis Berat.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'42. Appalic Syndrome.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'43. Penyakit Kaki Gajah Kronis.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'44. Cardiomyopathy.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'45. Aneurisma pembuluh darah otak yang mensyaratkan pembedahan.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'46. Terputusnya akar-akar syaraf Plexus brachialis.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'47. Stroke yang memerlukan operasi arteri carotid.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'48. Operasi scoliosis idiopatik.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'49. Skleroderma Progresif.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'50. Kematian selaput otot atau jaringan (gangrene).',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'51. Penyakit Kawasaki Yang Mengakibatkan Komplikasi Pada Jantung.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'52. Eisenmerger.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'53. Myasthenia Gravis.',0,0,'L');
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
		$this->pdf->Cell(29,5,time(),0,0,'L');
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

		// PAGE 9
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
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(6);
		
		// RINGKASAN MANFAAT
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(190,5,'RINGKASAN MANFAAT',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Nama Tertanggung',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,''.$data['hasil']['namalengkapcalontertanggung'].' ',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Usia Tertanggung',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,''.$data['hasil']['usiacalontertanggung'].' ',0,0,'L');
		$this->pdf->ln(4);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'A. Rencana masa pembayaran premi yang dikehendaki adalah',0,0,'L');
		$this->pdf->Cell(36);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(5,5,''.$data['hasil']['asumsicutitahunan'].' ',0,0,'L');
		$this->pdf->Cell(55,5,'Tahun. *',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Total Premi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,number_format($data['hasil']['premiberkala'] * 12 * $data['hasil']['asumsicutitahunan'],0,'.',','),0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Total Top Up Berkala',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,number_format($data['hasil']['topupberkala'] * 12 * $data['hasil']['asumsicutitahunan'],0,'.',','),0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(190,5,'Informasi mengenai Uraian Biaya-biaya terdapat dalam halaman Hal-Hal Penting.',0,0,'L');
		$this->pdf->ln(4);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'B. Asumsi Nilai Tunai dimasa yang akan datang **',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(47.5,5,'USIA',1,0,'C');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(47.5,5,'RENDAH',1,0,'C');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(47.5,5,'SEDANG',1,0,'C');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(47.5,5,'TINGGI',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(47.5,5,'50',1,0,'C');
		
		if ($data['hasil']['nilai'][99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexa']]['manfaatinvestasirendahringkasan'] == 0)
		{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,5,"***",1,0,'C');
		}
		else
		{	
			if (($data['hasil']['nilai'][(99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexa']) - ($data['hasil']['usiacalontertanggung'] - 1)]['manfaatinvestasirendahringkasan']) > 999999)
			{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,5,number_format(($data['hasil']['nilai'][(99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexa']) - ($data['hasil']['usiacalontertanggung'] - 1)]['manfaatinvestasirendahringkasan']) / 1000,0,'.',','),1,0,'C');
			}
			else
			{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,5,number_format(($data['hasil']['nilai'][(99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexa']) - ($data['hasil']['usiacalontertanggung'] - 1)]['manfaatinvestasirendahringkasan']),0,'.',','),1,0,'C');
			}
		}
		
		if ($data['hasil']['nilai'][99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexa']]['manfaatinvestasisedangringkasan'] == 0)
		{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,5,"***",1,0,'C');
		}
		else
		{
			if (($data['hasil']['nilai'][(99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexa']) - ($data['hasil']['usiacalontertanggung'] - 1)]['manfaatinvestasisedangringkasan']) > 999999)
			{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,5,number_format(($data['hasil']['nilai'][(99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexa']) - ($data['hasil']['usiacalontertanggung'] - 1)]['manfaatinvestasisedangringkasan']) / 1000,0,'.',','),1,0,'C');
			}
			else
			{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,5,number_format(($data['hasil']['nilai'][(99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexa']) - ($data['hasil']['usiacalontertanggung'] - 1)]['manfaatinvestasisedangringkasan']),0,'.',','),1,0,'C');
			}
		}
		
		if ($data['hasil']['nilai'][99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexa']]['manfaatinvestasitinggiringkasan'] == 0)
		{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,5,"***",1,0,'C');
		}
		else
		{
			if (($data['hasil']['nilai'][(99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexa']) - ($data['hasil']['usiacalontertanggung'] - 1)]['manfaatinvestasitinggiringkasan']) > 999999)
			{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,5,number_format(($data['hasil']['nilai'][(99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexa']) - ($data['hasil']['usiacalontertanggung'] - 1)]['manfaatinvestasitinggiringkasan']) / 1000,0,'.',','),1,0,'C');
			}
			else
			{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,5,number_format(($data['hasil']['nilai'][(99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexa']) - ($data['hasil']['usiacalontertanggung'] - 1)]['manfaatinvestasitinggiringkasan']),0,'.',','),1,0,'C');
			}
		}
		
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(47.5,5,'60',1,0,'C');

		if ($data['hasil']['nilai'][99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexb']]['manfaatinvestasirendahringkasan'] == 0)
		{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,5,"***",1,0,'C');
		}
		else
		{
			if (($data['hasil']['nilai'][(99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexb']) - ($data['hasil']['usiacalontertanggung'] - 1)]['manfaatinvestasirendahringkasan']) > 999999)
			{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,5,number_format(($data['hasil']['nilai'][(99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexb']) - ($data['hasil']['usiacalontertanggung'] - 1)]['manfaatinvestasirendahringkasan']) / 1000,0,'.',','),1,0,'C');
			}
			else
			{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,5,number_format(($data['hasil']['nilai'][(99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexb']) - ($data['hasil']['usiacalontertanggung'] - 1)]['manfaatinvestasirendahringkasan']),0,'.',','),1,0,'C');
			}
		}
		
		if ($data['hasil']['nilai'][99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexb']]['manfaatinvestasisedangringkasan'] == 0)
		{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,5,"***",1,0,'C');
		}
		else
		{
			if (($data['hasil']['nilai'][(99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexb']) - ($data['hasil']['usiacalontertanggung'] - 1)]['manfaatinvestasisedangringkasan']) > 999999)
			{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,5,number_format(($data['hasil']['nilai'][(99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexb']) - ($data['hasil']['usiacalontertanggung'] - 1)]['manfaatinvestasisedangringkasan']) / 1000,0,'.',','),1,0,'C');
			}
			else
			{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,5,number_format(($data['hasil']['nilai'][(99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexb']) - ($data['hasil']['usiacalontertanggung'] - 1)]['manfaatinvestasisedangringkasan']),0,'.',','),1,0,'C');
			}
		}
		
		if ($data['hasil']['nilai'][99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexb']]['manfaatinvestasitinggiringkasan'] == 0)
		{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,5,"***",1,0,'C');
		}
		else
		{
			if (($data['hasil']['nilai'][(99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexb']) - ($data['hasil']['usiacalontertanggung'] - 1)]['manfaatinvestasitinggiringkasan']) > 999999)
			{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,5,number_format(($data['hasil']['nilai'][(99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexb']) - ($data['hasil']['usiacalontertanggung'] - 1)]['manfaatinvestasitinggiringkasan']) / 1000,0,'.',','),1,0,'C');
			}
			else
			{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,5,number_format(($data['hasil']['nilai'][(99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexb']) - ($data['hasil']['usiacalontertanggung'] - 1)]['manfaatinvestasitinggiringkasan']),0,'.',','),1,0,'C');
			}
		}
	
		
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(47.5,5,'70',1,0,'C');
		
		if ($data['hasil']['nilai'][99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexc']]['manfaatinvestasirendahringkasan'] == 0)
		{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,5,"***",1,0,'C');
		}
		else
		{	
			if (($data['hasil']['nilai'][(99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexc']) - ($data['hasil']['usiacalontertanggung'] - 1)]['manfaatinvestasirendahringkasan']) > 999999)
			{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,5,number_format(($data['hasil']['nilai'][(99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexc']) - ($data['hasil']['usiacalontertanggung'] - 1)]['manfaatinvestasirendahringkasan']) / 1000,0,'.',','),1,0,'C');
			}
			else
			{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,5,number_format(($data['hasil']['nilai'][(99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexc']) - ($data['hasil']['usiacalontertanggung'] - 1)]['manfaatinvestasirendahringkasan']),0,'.',','),1,0,'C');
			}
		}
		
		if ($data['hasil']['nilai'][99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexc']]['manfaatinvestasisedangringkasan'] == 0)
		{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,5,"***",1,0,'C');
		}
		else
		{	
			if (($data['hasil']['nilai'][(99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexc']) - ($data['hasil']['usiacalontertanggung'] - 1)]['manfaatinvestasisedangringkasan']) > 999999)
			{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,5,number_format(($data['hasil']['nilai'][(99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexc']) - ($data['hasil']['usiacalontertanggung'] - 1)]['manfaatinvestasisedangringkasan']) / 1000,0,'.',','),1,0,'C');
			}
			else
			{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,5,number_format(($data['hasil']['nilai'][(99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexc']) - ($data['hasil']['usiacalontertanggung'] - 1)]['manfaatinvestasisedangringkasan']),0,'.',','),1,0,'C');
			}
		}
		
		if ($data['hasil']['nilai'][99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexc']]['manfaatinvestasitinggiringkasan'] == 0)
		{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,5,"***",1,0,'C');
		}
		else
		{	
			if (($data['hasil']['nilai'][(99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexc']) - ($data['hasil']['usiacalontertanggung'] - 1)]['manfaatinvestasitinggiringkasan']) > 999999)
			{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,5,number_format(($data['hasil']['nilai'][(99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexc']) - ($data['hasil']['usiacalontertanggung'] - 1)]['manfaatinvestasitinggiringkasan']) / 1000,0,'.',','),1,0,'C');
			}
			else
			{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,5,number_format(($data['hasil']['nilai'][(99 - $data['hasil']['usiacalontertanggung'] + $data['hasil']['indexc']) - ($data['hasil']['usiacalontertanggung'] - 1)]['manfaatinvestasitinggiringkasan']),0,'.',','),1,0,'C');
			}
		}
		
		$this->pdf->ln();
		
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'*',0,0,'L');
		$this->pdf->Cell(180,5,'Sesuai dengan cuti premi yang dipilih.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'**',0,0,'L');
		$this->pdf->Cell(180,5,'Nilai Tunai dihitung dengan menggunakan asumsi tingkat investasi. Besarnya Nilai Tunai yang dibayarkan (dapat lebih',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10);
		$this->pdf->Cell(180,5,'besar atau lebih kecil dari yang diilustrasikan), akan bergantung pada perkembangan dari dana investasi.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'***',0,0,'L');
		$this->pdf->Cell(180,5,'Menunjukkan bahwa Nilai Tunai pada tahun tersebut tidak mencukupi untuk membayar Biaya Asuransi dan Administrasi, dan oleh karena itu',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10);
		$this->pdf->Cell(190,5,'Polis akan batal (lapse). Supaya Manfaat Polis dapat terus berlanjut, maka Anda diminta untuk melanjutkan pembayaran premi tahunan seperti',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10);
		$this->pdf->Cell(190,5,'dinyatakan dalam ilustrasi ini.',0,0,'L');
		$this->pdf->ln(4);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'C. Rangkuman Manfaat Meninggal Dunia',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'Jika Tertanggung meninggal dunia karena kecelakaan sebelum berusia 65 Tahun, Manfaat yang diterima','T',0,'L');
		$this->pdf->SetFont('Arial','',8);
		if ($data['hasil']['juaaddb'] == "")
		{
			$data['hasil']['juaaddb'] = 0;
		}
		$this->pdf->Cell(50,5,number_format($data['hasil']['juaaddb'] + $data['hasil']['uangpertanggungan'],0,'.',','),'T',0,'L');
		$this->pdf->ln(3);
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'adalah sejumlah Uang Asuransi ditambah dengan Nilai Tunai pada Saat Tertanggung Meninggal Dunia.','B',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'','B',0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'Jika Tertanggung meninggal dunia sebelum berusia 65 Tahun, maka Manfaat yang diterima adalah sejumlah','T',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,number_format($data['hasil']['juaaddb'] + $data['hasil']['uangpertanggungan'],0,'.',','),'T',0,'L');
		$this->pdf->ln(3);
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'Uang Pertanggungan ditambah dengan Nilai Tunai pada saat Tertanggung Meninggal Dunia.','B',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'','B',0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'D. Manfaat',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(190,5,'(Hanya untuk ilustrasi, keterangan lengkap mengenai Manfaat Asuransi tiap produk Asuransi, termasuk syarat-syarat dan pengecualian, tercantum',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(190,5,' pada Polis, berlaku dan mengikat).',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'Asuransi Dasar: Apabila Tertanggung meninggal dunia dalam masa asuransi sebelum usia 99 Tahun, maka','LTR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,number_format($data['hasil']['uangpertanggungan'],0,'.',','),'LTR',0,'C');
		$this->pdf->ln(3);
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'akan dibayarkan Uang Asuransi Dasar ditambah dengan Nilai Tunai Polis, Apabila Tertanggung hidup sampai','LR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'','LR',0,'L');
		$this->pdf->ln(3);
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'berakhirnya Masa Asuransi, maka Jiwasraya akan membayarkan Nilai Tunai (Jumlah Unit x NAB).','LBR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'','LBR',0,'L');
		
		if (($data['hasil']['juatpd'] != "") && ($data['hasil']['biayaasuransiperbulanjstpd'] != ""))
		{
		$this->pdf->ln();
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'JS Total Permanent Disability: Apabila Tertanggung mengalami Cacat Tetap Total, maka akan dibayarkan','LTR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,number_format($data['hasil']['juatpd'],0,'.',','),'LTR',0,'C');
		$this->pdf->ln(3);
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'sebesar','LBR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'','LBR',0,'L');
		}
		
		if (($data['hasil']['juapayorbenefitdeath'] != "") && ($data['hasil']['biayaasuransiperbulanjspbd'] != ""))
		{
		$this->pdf->ln();
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'JS Payor Death Benefit: Apabila Pemegang Polis meninggal dunia, maka Polis menjadi bebas premi',1,0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,number_format($data['hasil']['juapayorbenefitdeath'],0,'.',','),'LTR',0,'C');
		}
		
		if (($data['hasil']['juaspousepayordeath'] != "") && ($data['hasil']['biayaasuransiperbulanjsspd'] != ""))
		{
		$this->pdf->ln();
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'JS Spouse Payor Death Benefit: Apabila Pemegang Polis meninggal dunia, maka Polis menjadi bebas premi',1,0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,number_format($data['hasil']['juaspousepayordeath'],0,'.',','),'LTR',0,'C');
		}
		
		if (($data['hasil']['juaci53'] != "") && ($data['hasil']['biayaasuransiperbulanjsci53'] != ""))
		{
		$this->pdf->ln();
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'JS Critical Illness: Apabila Tertanggung terdiagnosa untuk pertama kali menderita salah satu dari 53 jenis','LTR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,number_format($data['hasil']['juaci53'],0,'.',','),'LTR',0,'C');
		$this->pdf->ln(3);
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'penyakit kritis sesuai dengan daftar penyakit kritis, maka akan dibayarkan sebesar','LBR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'','LBR',0,'L');
		}
		
		if (($data['hasil']['juaaddb'] != "") && ($data['hasil']['biayaasuransiperbulanjsaddb'] != ""))
		{
		$this->pdf->ln();
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'JS Accident Death & Dismemberment: Apabila Tertanggung Meninggal Dunia atau Cacat karena kecelakaan','LTR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,number_format($data['hasil']['juaaddb'],0,'.',','),'LTR',0,'C');
		$this->pdf->ln(3);
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'sebelum Tertanggung berusia 65 Tahun, maka akan dibayarkan manfaat Uang Asuransi sebesar','LBR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'','LBR',0,'L');
		}
		
		if (($data['hasil']['juatermlife'] != "") && ($data['hasil']['biayaasuransiperbulantl'] != ""))
		{
		$this->pdf->ln();
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'Apabila Tertanggung meninggal dunia karena Sakit atau kecelakaan usia tertanggung tidak lebih dari 65','LTR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,number_format($data['hasil']['juatermlife'],0,'.',','),'LTR',0,'C');
		$this->pdf->ln(3);
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'Tahun, maka akan dibayarkan Uang Asuransi JS Term Rider','LBR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'','LBR',0,'L');
		}
		
		if (($data['hasil']['juapayorbenefittpd'] != "") && ($data['hasil']['biayaasuransiperbulanjspbtpd'] != ""))
		{
		$this->pdf->ln();
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'Apabila Pemegang Polis menderita Cacat Tetap Total (TPD) baik karena sakit maupun karena kecelakaan','LTR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,number_format($data['hasil']['juapayorbenefittpd'],0,'.',','),'LTR',0,'C');
		$this->pdf->ln(3);
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'dalam masa perjanjian asuransi, maka manfaat pembebasan pembayaran premi berkala akan diberikan','LR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'','LR',0,'L');
		$this->pdf->ln(3);
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'kepada Pemegang Polis','LBR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'','LBR',0,'L');
		}
		
		if (($data['hasil']['juaspousepayortpd'] != "") && ($data['hasil']['biayaasuransiperbulanjssptpd'] != ""))
		{
		$this->pdf->ln();
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'Apabila Pemegang Polis menderita Cacat Tetap Total baik karena sakit maupun karena kecelakaan','LTR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,number_format($data['hasil']['juaspousepayortpd'],0,'.',','),'LTR',0,'C');
		$this->pdf->ln(3);
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'dalam masa perjanjian asuransi, maka manfaat pembebasan pembayaran premi berkala akan diberikan','LR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'','LR',0,'L');
		$this->pdf->ln(3);
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'kepada Pemegang Polis','LBR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'','LBR',0,'L');
		}
		
		if (($data['hasil']['juahcp'] != "") && ($data['hasil']['biayaasuransiperbulanjshcp'] != ""))
		{
		$this->pdf->ln(5);
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(190,5,'JS Hospital Care Benefit, Apabila tertanggung dirawat di Rumah Sakit sebelum berusia 65 Tahun, maka akan dibayarkan sebesar:',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'a. Rawat Inap Rumah Sakit per Hari, sebesar',0,0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,number_format($data['hasil']['ranaphcp'],0,'.',','),0,0,'C');
		$this->pdf->ln(3);
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'b. Rawat ICU/ICCU per Hari, sebesar',0,0,'L');
		$this->pdf->Cell(50,5,number_format($data['hasil']['icuhcp'],0,'.',','),0,0,'C');
		$this->pdf->SetFont('Arial','',8);
			
			if (($data['hasil']['juahcpbedah'] != "") && ($data['hasil']['biayaasuransiperbulanjshcpbedah'] != ""))
			{
				$this->pdf->ln(3);
				$this->pdf->Cell(1);
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(140,5,'c. Pembedahan ',0,0,'L');
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(50,5,number_format($data['hasil']['juahcpbedah'],0,'.',','),0,0,'C');
			}
		}
		
		if (($data['hasil']['juawp'] != "") && ($data['hasil']['premitambahanwp'] != ""))
		{
		$this->pdf->ln();
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'Waiver Premium','LTR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,number_format($data['hasil']['juawp'],0,'.',','),'LTR',0,'C');
		$this->pdf->ln(3);
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'sebesar','LBR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'','LBR',0,'L');
		}
		
		$this->pdf->ln(0);
	
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
		$this->pdf->Cell(29,5,time(),0,0,'L');
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
		
		// PAGE 10
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
		$this->pdf->Cell(29,5,time(),0,0,'L');
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
		//$this->pdf->Output();
	}	

}					