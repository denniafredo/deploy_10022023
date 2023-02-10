<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");
	
	error_reporting(0);

class Jsguardian extends CI_Controller{

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
			'masaasuransi' => $this->input->post('masaasuransi'),
			'saatmulaiunitlink' => $this->input->post('saatmulaiunitlink'),
			'nomeragen' => $this->input->post('nomeragen'),
			'premisekaligus' => $this->input->post('premisekaligus'),
			'proteksi' => $this->input->post('proteksi'),
			'uangasuransi' => $this->input->post('uangasuransi'),
			'modul' => $this->input->post('modul'),
			'namaagen' => $this->input->post('namaagen'),
			'kodekantor' => $this->input->post('kodekantor'),
			//'kantorcabang' => $this->input->post('kantorcabang'),
			'bunganett' => $this->input->post('bunganett'),
			'id_nasabah' => $nasabahID,
			'id_agen' => $this->input->post('nomeragen'),
			'file_pdf' => $filePdf.'.pdf',
			'id_produk' => $this->input->post('idproduk'),
			'filepdf' => $filePdf,
			'kodeprospek' => $this->input->post('kodeprospek'),
			
			'usia' => $this->input->post('usia'),
			'alokasidana1' => $this->input->post('alokasidana1'),
			'alokasidana2' => $this->input->post('alokasidana2'),
			'persentasealokasidana1' => $this->input->post('persentasealokasidana1'),
			'persentasealokasidana2' => $this->input->post('persentasealokasidana2'),
			'calonpemegangpolisperokok' => $this->input->post('calonpemegangpolisperokok'),
			'namalengkapcalontertanggung' => $this->input->post('namalengkapcalontertanggung'),
			'jeniskelamincalontertanggung' => $this->input->post('jeniskelamincalontertanggung'),
			'tanggallahircalontertangggung' => $this->input->post('tanggallahircalontertangggung'),
			'calontertanggungperokok' => $this->input->post('calontertanggungperokok'),
			'carabayar' => $this->input->post('carabayar'),
			'uangpertanggungan' => $this->input->post('uangpertanggungan'),
			'matauang' => $this->input->post('matauang'),
			'premisingle' => $this->input->post('premisingle'),
			'topupsingle' => $this->input->post('topupsingle'),
			'totalpremiyangdibayar' => $this->input->post('totalpremiyangdibayar')
			
  		);
		
		
		$this->session->set_userdata($newdata);
		
		//$html = $this->load->view('pdf/optima7',$data,true);
		//$this->load->view('hasil/optima7');*/
	}

	function hasil(){
		
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
		
		$data['item'] = $this->session->userdata('uangasuransi');
		$nilaiTunai = $this->ModSimulasi->getNilaiTunai($this->session->userdata('modul'));
		$data['nilaiTunai'] = $nilaiTunai;
		
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
		
		$tanggalSekarang = date("d", strtotime("now"));
		$bulanSekarang = $bulan[date("n", strtotime("now"))];
		$tahunSekarang = date("Y", strtotime("now"));
		$data['hasil']['tanggalsekarang'] = $tanggalSekarang.' '.$bulanSekarang.' '.$tahunSekarang;
		
		$usia = $this->session->userdata('usia');
		$masapembpremi = $this->session->userdata('masapembpremi');
		$jangkawaktuusia = $usia + $masapembpremi;
		
		$data['hasil']['jangkawaktuusia'] = $jangkawaktuusia;
		
		$this->load->model('ModSimulasi');
		
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
		else if ($alokasidana1 == "JS GUARDIAN 75")
		{
			$detailproduk = $this->ModSimulasi->getDetailProduk(8);
			$asumsi_inv_min = $detailproduk['ASUMSI_INV_MIN']; 
			$asumsi_inv_med = $detailproduk['ASUMSI_INV_MED'];
			$asumsi_inv_max = $detailproduk['ASUMSI_INV_MAX'];
			$data['hasil']['asumsi_inv_min1'] = $asumsi_inv_min;
			$data['hasil']['asumsi_inv_med1'] = $asumsi_inv_med;
			$data['hasil']['asumsi_inv_max1'] = $asumsi_inv_max;
			$data['hasil']['nama_produk1'] = "JS GUARDIAN 75";
			$data['hasil']['persentasealokasidana1'] = $persentasealokasidana1;
		}
		else if ($alokasidana1 == "JS GUARDIAN 85")
		{
			$detailproduk = $this->ModSimulasi->getDetailProduk(9);
			$asumsi_inv_min = $detailproduk['ASUMSI_INV_MIN']; 
			$asumsi_inv_med = $detailproduk['ASUMSI_INV_MED'];
			$asumsi_inv_max = $detailproduk['ASUMSI_INV_MAX'];
			$data['hasil']['asumsi_inv_min1'] = $asumsi_inv_min;
			$data['hasil']['asumsi_inv_med1'] = $asumsi_inv_med;
			$data['hasil']['asumsi_inv_max1'] = $asumsi_inv_max;
			$data['hasil']['nama_produk1'] = "JS GUARDIAN 85";
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
		else if ($alokasidana2 == "JS GUARDIAN 75")
		{
			$detailproduk = $this->ModSimulasi->getDetailProduk(8);
			$asumsi_inv_min = $detailproduk['ASUMSI_INV_MIN']; 
			$asumsi_inv_med = $detailproduk['ASUMSI_INV_MED'];
			$asumsi_inv_max = $detailproduk['ASUMSI_INV_MAX'];
			$data['hasil']['asumsi_inv_min2'] = $asumsi_inv_min;
			$data['hasil']['asumsi_inv_med2'] = $asumsi_inv_med;
			$data['hasil']['asumsi_inv_max2'] = $asumsi_inv_max;
			$data['hasil']['nama_produk2'] = "JS GUARDIAN 75";
			$data['hasil']['persentasealokasidana2'] = $persentasealokasidana2;
		}
		else if ($alokasidana2 == "JS GUARDIAN 85")
		{
			$detailproduk = $this->ModSimulasi->getDetailProduk(9);
			$asumsi_inv_min = $detailproduk['ASUMSI_INV_MIN']; 
			$asumsi_inv_med = $detailproduk['ASUMSI_INV_MED'];
			$asumsi_inv_max = $detailproduk['ASUMSI_INV_MAX'];
			$data['hasil']['asumsi_inv_min2'] = $asumsi_inv_min;
			$data['hasil']['asumsi_inv_med2'] = $asumsi_inv_med;
			$data['hasil']['asumsi_inv_max2'] = $asumsi_inv_max;
			$data['hasil']['nama_produk2'] = "JS GUARDIAN 85";
			$data['hasil']['persentasealokasidana2'] = $persentasealokasidana2;
		}
		
		$data['hasil']['calonpemegangpolisperokok'] = $this->session->userdata('calonpemegangpolisperokok');
		
		//$data['hasil']['filepdf'] = $filepdf;
		$data['hasil']['nama'] = $this->session->userdata('nama');
		$data['hasil']['namaagen'] = strtoupper(str_replace("-"," ",$this->session->userdata('namaagen')));
		$kodeKantor = $DataAgen['KDKANTOR'];
		$dataKantor = $this->ModSimulasi->cariDataKantor($kodeKantor);
		$data['hasil']['kantorcabang'] = $dataKantor['NAMAKANTOR'];
		$data['hasil']['nomeragen'] = $this->session->userdata('nomeragen');
		
		$data['hasil']['bunganett'] = $this->session->userdata('bunganett');
		$data['hasil']['sapaan'] = ($this->session->userdata('jenis_kel') =='M') ? 'Bapak':'Ibu';
		
		$kdkelaminpemegangpolis = $this->session->userdata('jenis_kel');
		
		if($kdkelaminpemegangpolis == 'M')
		{
			$data['hasil']['jeniskelaminpemegangpolis'] = 'Laki - Laki';
		}
		else if($kdkelaminpemegangpolis == 'F')
		{
			$data['hasil']['jeniskelaminpemegangpolis'] = 'Perempuan';
		}
		
		$data['hasil']['namalengkapcalontertanggung'] = $this->session->userdata('namalengkapcalontertanggung');
		$data['hasil']['jeniskelamincalontertanggung'] = $this->session->userdata('jeniskelamincalontertanggung');
		$data['hasil']['calontertanggungperokok'] = $this->session->userdata('calontertanggungperokok');
		
		$calontertanggungperokok = $this->session->userdata('calontertanggungperokok');
		if ($calontertanggungperokok == "Ya")
		{
			$statusperokok = "SMOKER";
		}
		else if ($calontertanggungperokok == "Tidak")
		{
			$statusperokok = "NONSMOKER";
		}
		
		$biayaAsuransi = $this->ModSimulasi->getBiayaAsuransi($yearscalontertanggung);
		$data['hasil']['biayaAsuransi'] = round(($biayaAsuransi[$statusperokok] / 1000) * ( $this->session->userdata('uangpertanggungan') / 12));
		
		$tanggalLahirCalonTertanggung = date("d", strtotime($this->session->userdata('tanggallahircalontertangggung')));
		$bulanLahirCalonTertanggung = $bulan[date("n", strtotime($this->session->userdata('tanggallahircalontertangggung')))];
		$tahunLahirCalonTertanggung = date("Y", strtotime($this->session->userdata('tanggallahircalontertangggung')));
		$data['hasil']['tanggallahircalontertangggung'] = $tanggalLahirCalonTertanggung.' '.$bulanLahirCalonTertanggung.' '.$tahunLahirCalonTertanggung;
		
		//$data['hasil']['usiaawal'] = $years;

		$carabayar = $this->session->userdata('carabayar');
		if ($carabayar == 'Sekaligus')
		{
			$data['hasil']['carabayar'] = 'Single';
		}
		
		$data['hasil']['uangpertanggungan'] = $this->session->userdata('uangpertanggungan');
		$data['hasil']['matauang'] = $this->session->userdata('matauang');
		$data['hasil']['premisingle'] = $this->session->userdata('premisingle');
		$data['hasil']['topupsingle'] = $this->session->userdata('topupsingle');
		$data['hasil']['totalpremiyangdibayar'] = $this->session->userdata('totalpremiyangdibayar');
		
		$data['hasil']['asumsinab'] = $this->session->userdata('asumsinab');
		$data['hasil']['uangasuransi'] = $this->session->userdata('uangasuransi');
		$data['hasil']['premisekaligus'] = $this->session->userdata('premisekaligus');
		$data['hasil']['masaasuransi'] = $this->session->userdata('masaasuransi');
		$data['hasil']['saatmulaiunitlink'] = $tanggalMulas.' '.$bulanMulas.' '.$tahunMulas;
		$data['hasil']['filepdf'] = $this->session->userdata('filepdf');
		$data['hasil']['premisekaligus'] = $this->session->userdata('premisekaligus');
		$data['hasil']['masaasuransi'] = $this->session->userdata('masaasuransi');
		$data['hasil']['saatmulaiunitlink'] = $tanggalMulas.' '.$bulanMulas.' '.$tahunMulas;
		$data['hasil']['tanggalproposal'] = $tanggalProposal.' '.$bulanProposal.' '.$tahunProposal;
		$data['hasil']['tanggallahir'] = $tanggalLahir.' '.$bulanLahir.' '.$tahunLahir;
		$data['hasil']['filepdf'] = $this->session->userdata('filepdf');
		$data['hasil']['id_nasabah'] = $this->session->userdata('id_nasabah');
		$data['hasil']['id_agen']	 = $this->session->userdata('id_agen');
		//$data['hasil']['file_pdf']	 = $filePdf.'.pdf',
		$data['hasil']['id_produk']  = $this->session->userdata('id_produk');
		
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
			'CARA_BAYAR' => 'Sekaligus',
			'JUMLAH_PREMI' => $data['hasil']['premisingle'],
			'TOP_UP'=> $data['hasil']['topupsingle'] 
		);
		
		$this->ModSimulasi->insertSimulasi($data['hitung']);
		
		$data['hasil']['build_id'] = $data['hitung']['BUILD_ID'];
		
		for($i=0;$i<=99;$i++){
			
			$data['hasil']['nilai'][$i]['usiacalontertanggung'] = $data['hasil']['usiacalontertanggung']+$i;
			
			$biayaAsuransi = $this->ModSimulasi->getBiayaAsuransi($yearscalontertanggung + $i);			
			$data['hasil']['nilai'][$i]['biayaAsuransi'] = ((($biayaAsuransi[$statusperokok]) * (($this->session->userdata('uangpertanggungan')) / 1000)) / 12);
			
			for($j=0;$j<=0;$j++)
			{	
				$data['hasil']['nilai'][$j]['premisingle'] = ($data['hasil']['premisingle']/1000);
				$data['hasil']['nilai'][$j]['topupsingle'] = ($data['hasil']['topupsingle']/1000);
			}
			
			if ($i==0)
			{	
				//$data['hasil']['nilai'][$i]['manfaatinvestasimin1'] = ((((95 / 100) * ((($data['hasil']['premisingle'] * $data['hasil']['persentasealokasidana1']) / 100) + (($data['hasil']['topupsingle'] * $data['hasil']['persentasealokasidana1']) / 100)) - ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_min1'] / 100) / 12))) / 1000);
				//$data['hasil']['nilai'][$i]['manfaatinvestasimed1'] = ((((95 / 100) * ((($data['hasil']['premisingle'] * $data['hasil']['persentasealokasidana1']) / 100) + (($data['hasil']['topupsingle'] * $data['hasil']['persentasealokasidana1']) / 100)) - ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_med1'] / 100) / 12))) / 1000);
				//$data['hasil']['nilai'][$i]['manfaatinvestasimax1'] = ((((95 / 100) * ((($data['hasil']['premisingle'] * $data['hasil']['persentasealokasidana1']) / 100) + (($data['hasil']['topupsingle'] * $data['hasil']['persentasealokasidana1']) / 100)) - ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_max1'] / 100) / 12))) / 1000);
				
				$COI = $data['hasil']['nilai'][$i]['biayaAsuransi'] * 12;
				$totalCOIplusCOA = $data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500;
				$premiberkala = (95 / 100) * $data['hasil']['premisingle'];
				$topupberkala = (95 / 100) * $data['hasil']['topupsingle'];
				$totalinvestasi = $premiberkala + $topupberkala;
				$data['hasil']['nilai'][$i]['manfaatinvestasimin1'] = (((((((((((((((((((((((($totalinvestasi - $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_min1'] / 100) / 12))) 
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_min1'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_min1'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_min1'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_min1'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_min1'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_min1'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_min1'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_min1'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_min1'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_min1'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_min1'] / 100) / 12)));
				$data['hasil']['nilai'][$i]['manfaatinvestasimed1'] = (((((((((((((((((((((((($totalinvestasi - $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_med1'] / 100) / 12))) 
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_med1'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_med1'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_med1'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_med1'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_med1'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_med1'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_med1'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_med1'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_med1'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_med1'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_med1'] / 100) / 12)));
				$data['hasil']['nilai'][$i]['manfaatinvestasimax1'] = (((((((((((((((((((((((($totalinvestasi - $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_max1'] / 100) / 12))) 
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_max1'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_max1'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_max1'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_max1'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_max1'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_max1'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_max1'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_max1'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_max1'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_max1'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_max1'] / 100) / 12)));
																			
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamin1'] = ((($data['hasil']['nilai'][$i]['manfaatinvestasimin1'] / 1000) + (($this->session->userdata('uangpertanggungan')) / 1000)) * ($data['hasil']['persentasealokasidana1'] / 100));
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamed1'] = ((($data['hasil']['nilai'][$i]['manfaatinvestasimed1'] / 1000) + (($this->session->userdata('uangpertanggungan')) / 1000)) * ($data['hasil']['persentasealokasidana1'] / 100));
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamax1'] = ((($data['hasil']['nilai'][$i]['manfaatinvestasimax1'] / 1000) + (($this->session->userdata('uangpertanggungan')) / 1000)) * ($data['hasil']['persentasealokasidana1'] / 100));
				
				/*
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamin1'] = (($this->session->userdata('uangpertanggungan')) / 1000);
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamed1'] = (($this->session->userdata('uangpertanggungan')) / 1000);
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamax1'] = (($this->session->userdata('uangpertanggungan')) / 1000);
				*/
				
				$data['hasil']['nilai'][$i]['manfaatinvestasimin2'] = (((((((((((((((((((((((($totalinvestasi - $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_min2'] / 100) / 12))) 
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_min2'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_min2'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_min2'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_min2'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_min2'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_min2'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_min2'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_min2'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_min2'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_min2'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_min2'] / 100) / 12)));
				$data['hasil']['nilai'][$i]['manfaatinvestasimed2'] = (((((((((((((((((((((((($totalinvestasi - $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_med2'] / 100) / 12))) 
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_med2'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_med2'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_med2'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_med2'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_med2'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_med2'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_med2'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_med2'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_med2'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_med2'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_med2'] / 100) / 12)));
				$data['hasil']['nilai'][$i]['manfaatinvestasimax2'] = (((((((((((((((((((((((($totalinvestasi - $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_max2'] / 100) / 12))) 
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_max2'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_max2'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_max2'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_max2'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_max2'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_max2'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_max2'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_max2'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_max2'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_max2'] / 100) / 12)))
																			- $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_max2'] / 100) / 12)));
																			
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamin2'] = ((($data['hasil']['nilai'][$i]['manfaatinvestasimin2'] / 1000) + (($this->session->userdata('uangpertanggungan')) / 1000)) * ($data['hasil']['persentasealokasidana2'] / 100));
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamed2'] = ((($data['hasil']['nilai'][$i]['manfaatinvestasimed2'] / 1000) + (($this->session->userdata('uangpertanggungan')) / 1000)) * ($data['hasil']['persentasealokasidana2'] / 100));
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamax2'] = ((($data['hasil']['nilai'][$i]['manfaatinvestasimax2'] / 1000) + (($this->session->userdata('uangpertanggungan')) / 1000)) * ($data['hasil']['persentasealokasidana2'] / 100));
				
				if ($data['hasil']['nilai'][$i]['manfaatinvestasimin1'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatinvestasimin1'] = 0;
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniamin1'] = 0;
				}
				if ($data['hasil']['nilai'][$i]['manfaatinvestasimed1'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatinvestasimed1'] = 0;
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniamed1'] = 0;
				}
				if ($data['hasil']['nilai'][$i]['manfaatinvestasimax1'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatinvestasimax1'] = 0;
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniamax1'] = 0;
				}
				if ($data['hasil']['nilai'][$i]['manfaatinvestasimin2'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatinvestasimin2'] = 0;
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniamin2'] = 0;
				}
				if ($data['hasil']['nilai'][$i]['manfaatinvestasimed2'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatinvestasimed2'] = 0;
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniamed2'] = 0;
				}
				if ($data['hasil']['nilai'][$i]['manfaatinvestasimax2'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatinvestasimax2'] = 0;
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniamax2'] = 0;
				}
				
				$data['hasil']['nilai'][$i]['manfaatinvestasiminringkasan'] = ($data['hasil']['nilai'][$i]['manfaatinvestasimin1'] * ($data['hasil']['persentasealokasidana1'] / 100)) + ($data['hasil']['nilai'][$i]['manfaatinvestasimin2'] * ($data['hasil']['persentasealokasidana2'] / 100));
				$data['hasil']['nilai'][$i]['manfaatinvestasimedringkasan'] = ($data['hasil']['nilai'][$i]['manfaatinvestasimed1'] * ($data['hasil']['persentasealokasidana1'] / 100)) + ($data['hasil']['nilai'][$i]['manfaatinvestasimed2'] * ($data['hasil']['persentasealokasidana2'] / 100));
				$data['hasil']['nilai'][$i]['manfaatinvestasimaxringkasan'] = ($data['hasil']['nilai'][$i]['manfaatinvestasimax1'] * ($data['hasil']['persentasealokasidana1'] / 100)) + ($data['hasil']['nilai'][$i]['manfaatinvestasimax2'] * ($data['hasil']['persentasealokasidana2'] / 100));
				
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniaminringkasan'] = $data['hasil']['nilai'][$i]['manfaatmeninggalduniamin1'] + $data['hasil']['nilai'][$i]['manfaatmeninggalduniamin2'];
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamedringkasan'] = $data['hasil']['nilai'][$i]['manfaatmeninggalduniamed1'] + $data['hasil']['nilai'][$i]['manfaatmeninggalduniamed2'];
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamaxringkasan'] = $data['hasil']['nilai'][$i]['manfaatmeninggalduniamax1'] + $data['hasil']['nilai'][$i]['manfaatmeninggalduniamax2'];
				
				
				
				/*
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamin2'] = (($this->session->userdata('uangpertanggungan')) / 1000);
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamed2'] = (($this->session->userdata('uangpertanggungan')) / 1000);
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamax2'] = (($this->session->userdata('uangpertanggungan')) / 1000);
				
				for($i=1;$i<=11;$i++)
				{	
					$data['hasil']['nilai'][$i]['manfaatinvestasimin1'] = (($data['hasil']['nilai'][$i-1]['manfaatinvestasimin1'] - $totalCOIplusCOA) * (1 + (($data['hasil']['asumsi_inv_min1'] / 100) / 12)));
				}
				
				$data['hasil']['nilai'][$i]['manfaatinvestasimin1'] = round(((($data['hasil']['premisingle']) + ($data['hasil']['topupsingle'])) * (95 / 100) * (($data['hasil']['persentasealokasidana1']) / 100) * (1 + ($data['hasil']['asumsi_inv_min1'] / 100)) - (12 * (round($data['hasil']['nilai'][$i]['biayaAsuransi']) + 27500) * (($data['hasil']['persentasealokasidana1']) / 100))) / 1000);
				$data['hasil']['nilai'][$i]['manfaatinvestasimed1'] = round(((($data['hasil']['premisingle']) + ($data['hasil']['topupsingle'])) * (95 / 100) * (($data['hasil']['persentasealokasidana1']) / 100) * (1 + ($data['hasil']['asumsi_inv_med1'] / 100)) - (12 * (round($data['hasil']['nilai'][$i]['biayaAsuransi']) + 27500) * (($data['hasil']['persentasealokasidana1']) / 100))) / 1000);
				$data['hasil']['nilai'][$i]['manfaatinvestasimax1'] = round(((($data['hasil']['premisingle']) + ($data['hasil']['topupsingle'])) * (95 / 100) * (($data['hasil']['persentasealokasidana1']) / 100) * (1 + ($data['hasil']['asumsi_inv_max1'] / 100)) - (12 * (round($data['hasil']['nilai'][$i]['biayaAsuransi']) + 27500) * (($data['hasil']['persentasealokasidana1']) / 100))) / 1000);
				
				
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamin1'] = (((($data['hasil']['persentasealokasidana1']) / 100) * (($this->session->userdata('uangpertanggungan')) / 1000)) + $data['hasil']['nilai'][$i]['manfaatinvestasimin1']);
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamed1'] = (((($data['hasil']['persentasealokasidana1']) / 100) * (($this->session->userdata('uangpertanggungan')) / 1000)) + $data['hasil']['nilai'][$i]['manfaatinvestasimed1']);
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamax1'] = (((($data['hasil']['persentasealokasidana1']) / 100) * (($this->session->userdata('uangpertanggungan')) / 1000)) + $data['hasil']['nilai'][$i]['manfaatinvestasimax1']);
				
				if ($data['hasil']['nilai'][$i]['manfaatinvestasimin1'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatinvestasimin1'] = "***";
				}
				else if ($data['hasil']['nilai'][$i]['manfaatinvestasimed1'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatinvestasimed1'] = "***";
				}
				else if ($data['hasil']['nilai'][$i]['manfaatinvestasimax1'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatinvestasimax1'] = "***";
				}
				else if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniamin1'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniamin1'] = "***";
				}
				else if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniamed1'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniamed1'] = "***";
				}
				else if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniamax1'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniamax1'] = "***";
				}
				
				$data['hasil']['nilai'][$i]['manfaatinvestasimin2'] = round(((($data['hasil']['premisingle']) + ($data['hasil']['topupsingle'])) * (95 / 100) * (($data['hasil']['persentasealokasidana2']) / 100) * (1 + ($data['hasil']['asumsi_inv_min2'] / 100)) - (12 * (round($data['hasil']['nilai'][$i]['biayaAsuransi']) + 27500) * (($data['hasil']['persentasealokasidana2']) / 100))) / 1000);
				$data['hasil']['nilai'][$i]['manfaatinvestasimed2'] = round(((($data['hasil']['premisingle']) + ($data['hasil']['topupsingle'])) * (95 / 100) * (($data['hasil']['persentasealokasidana2']) / 100) * (1 + ($data['hasil']['asumsi_inv_med2'] / 100)) - (12 * (round($data['hasil']['nilai'][$i]['biayaAsuransi']) + 27500) * (($data['hasil']['persentasealokasidana2']) / 100))) / 1000);
				$data['hasil']['nilai'][$i]['manfaatinvestasimax2'] = round(((($data['hasil']['premisingle']) + ($data['hasil']['topupsingle'])) * (95 / 100) * (($data['hasil']['persentasealokasidana2']) / 100) * (1 + ($data['hasil']['asumsi_inv_max2'] / 100)) - (12 * (round($data['hasil']['nilai'][$i]['biayaAsuransi']) + 27500) * (($data['hasil']['persentasealokasidana2']) / 100))) / 1000);
				
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamin2'] = (((($data['hasil']['persentasealokasidana2']) / 100) * (($this->session->userdata('uangpertanggungan')) / 1000)) + $data['hasil']['nilai'][$i]['manfaatinvestasimin2']);
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamed2'] = (((($data['hasil']['persentasealokasidana2']) / 100) * (($this->session->userdata('uangpertanggungan')) / 1000)) + $data['hasil']['nilai'][$i]['manfaatinvestasimed2']);
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamax2'] = (((($data['hasil']['persentasealokasidana2']) / 100) * (($this->session->userdata('uangpertanggungan')) / 1000)) + $data['hasil']['nilai'][$i]['manfaatinvestasimax2']);
				
				if ($data['hasil']['nilai'][$i]['manfaatinvestasimin2'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatinvestasimin2'] = "***";
				}
				else if ($data['hasil']['nilai'][$i]['manfaatinvestasimed2'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatinvestasimed2'] = "***";
				}
				else if ($data['hasil']['nilai'][$i]['manfaatinvestasimax2'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatinvestasimax2'] = "***";
				}
				else if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniamin2'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniamin2'] = "***";
				}
				else if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniamed2'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniamed2'] = "***";
				}
				else if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniamax2'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniamax2'] = "***";
				}
				*/
			}
			else
			{	
				
				$data['hasil']['nilai'][$i]['manfaatinvestasimin1'] = ((((((((((((((((((((((((($data['hasil']['nilai'][$i-1]['manfaatinvestasimin1']) 
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_min1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_min1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_min1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_min1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_min1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_min1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_min1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_min1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_min1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_min1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_min1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_min1'] / 100) / 12)));
																			
				$data['hasil']['nilai'][$i]['manfaatinvestasimed1'] = ((((((((((((((((((((((((($data['hasil']['nilai'][$i-1]['manfaatinvestasimed1']) 
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_med1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_med1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_med1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_med1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_med1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_med1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_med1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_med1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_med1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_med1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_med1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_med1'] / 100) / 12)));
				$data['hasil']['nilai'][$i]['manfaatinvestasimax1'] = ((((((((((((((((((((((((($data['hasil']['nilai'][$i-1]['manfaatinvestasimax1']) 
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_max1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_max1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_max1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_max1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_max1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_max1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_max1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_max1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_max1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_max1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_max1'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_max1'] / 100) / 12)));
				
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamin1'] = ((($data['hasil']['nilai'][$i]['manfaatinvestasimin1'] / 1000) + (($this->session->userdata('uangpertanggungan')) / 1000)) * ($data['hasil']['persentasealokasidana1'] / 100));
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamed1'] = ((($data['hasil']['nilai'][$i]['manfaatinvestasimed1'] / 1000) + (($this->session->userdata('uangpertanggungan')) / 1000)) * ($data['hasil']['persentasealokasidana1'] / 100));
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamax1'] = ((($data['hasil']['nilai'][$i]['manfaatinvestasimax1'] / 1000) + (($this->session->userdata('uangpertanggungan')) / 1000)) * ($data['hasil']['persentasealokasidana1'] / 100));
				
				$data['hasil']['nilai'][$i]['manfaatinvestasimin2'] = ((((((((((((((((((((((((($data['hasil']['nilai'][$i-1]['manfaatinvestasimin2']) 
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_min2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_min2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_min2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_min2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_min2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_min2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_min2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_min2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_min2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_min2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_min2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_min2'] / 100) / 12)));
																			
				$data['hasil']['nilai'][$i]['manfaatinvestasimed2'] = ((((((((((((((((((((((((($data['hasil']['nilai'][$i-1]['manfaatinvestasimed2']) 
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_med2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_med2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_med2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_med2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_med2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_med2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_med2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_med2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_med2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_med2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_med2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_med2'] / 100) / 12)));
				$data['hasil']['nilai'][$i]['manfaatinvestasimax2'] = ((((((((((((((((((((((((($data['hasil']['nilai'][$i-1]['manfaatinvestasimax2']) 
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_max2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_max2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_max2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_max2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_max2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_max2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_max2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_max2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_max2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_max2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_max2'] / 100) / 12)))
																		- ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_max2'] / 100) / 12)));
				
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamin2'] = ((($data['hasil']['nilai'][$i]['manfaatinvestasimin2'] / 1000) + (($this->session->userdata('uangpertanggungan')) / 1000)) * ($data['hasil']['persentasealokasidana2'] / 100));
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamed2'] = ((($data['hasil']['nilai'][$i]['manfaatinvestasimed2'] / 1000) + (($this->session->userdata('uangpertanggungan')) / 1000)) * ($data['hasil']['persentasealokasidana2'] / 100));
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamax2'] = ((($data['hasil']['nilai'][$i]['manfaatinvestasimax2'] / 1000) + (($this->session->userdata('uangpertanggungan')) / 1000)) * ($data['hasil']['persentasealokasidana2'] / 100));
				
				if ($data['hasil']['nilai'][$i]['manfaatinvestasimin1'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatinvestasimin1'] = 0;
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniamin1'] = 0;
				}
				if ($data['hasil']['nilai'][$i]['manfaatinvestasimed1'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatinvestasimed1'] = 0;
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniamed1'] = 0;
				}
				if ($data['hasil']['nilai'][$i]['manfaatinvestasimax1'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatinvestasimax1'] = 0;
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniamax1'] = 0;
				}
				if ($data['hasil']['nilai'][$i]['manfaatinvestasimin2'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatinvestasimin2'] = 0;
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniamin2'] = 0;
				}
				if ($data['hasil']['nilai'][$i]['manfaatinvestasimed2'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatinvestasimed2'] = 0;
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniamed2'] = 0;
				}
				if ($data['hasil']['nilai'][$i]['manfaatinvestasimax2'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatinvestasimax2'] = 0;
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniamax2'] = 0;
				}
				
				$data['hasil']['nilai'][$i]['manfaatinvestasiminringkasan'] = ($data['hasil']['nilai'][$i]['manfaatinvestasimin1'] * ($data['hasil']['persentasealokasidana1'] / 100)) + ($data['hasil']['nilai'][$i]['manfaatinvestasimin2'] * ($data['hasil']['persentasealokasidana2'] / 100));
				$data['hasil']['nilai'][$i]['manfaatinvestasimedringkasan'] = ($data['hasil']['nilai'][$i]['manfaatinvestasimed1'] * ($data['hasil']['persentasealokasidana1'] / 100)) + ($data['hasil']['nilai'][$i]['manfaatinvestasimed2'] * ($data['hasil']['persentasealokasidana2'] / 100));
				$data['hasil']['nilai'][$i]['manfaatinvestasimaxringkasan'] = ($data['hasil']['nilai'][$i]['manfaatinvestasimax1'] * ($data['hasil']['persentasealokasidana1'] / 100)) + ($data['hasil']['nilai'][$i]['manfaatinvestasimax2'] * ($data['hasil']['persentasealokasidana2'] / 100));
				
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniaminringkasan'] = $data['hasil']['nilai'][$i]['manfaatmeninggalduniamin1'] + $data['hasil']['nilai'][$i]['manfaatmeninggalduniamin2'];
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamedringkasan'] = $data['hasil']['nilai'][$i]['manfaatmeninggalduniamed1'] + $data['hasil']['nilai'][$i]['manfaatmeninggalduniamed2'];
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamaxringkasan'] = $data['hasil']['nilai'][$i]['manfaatmeninggalduniamax1'] + $data['hasil']['nilai'][$i]['manfaatmeninggalduniamax2'];
				
				//$data['hasil']['nilai'][$i]['manfaatinvestasimin1'] = (((($data['hasil']['nilai'][$i-1]['manfaatinvestasimin1'] * 1000) - ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_min1'] / 100) / 12))) / 1000 ); 
				//$data['hasil']['nilai'][$i]['manfaatinvestasimed1'] = (((($data['hasil']['nilai'][$i-1]['manfaatinvestasimed1'] * 1000) - ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_med1'] / 100) / 12))) / 1000 ); 
				//$data['hasil']['nilai'][$i]['manfaatinvestasimax1'] = (((($data['hasil']['nilai'][$i-1]['manfaatinvestasimax1'] * 1000) - ($data['hasil']['nilai'][$i]['biayaAsuransi'] + 27500)) * (1 + (($data['hasil']['asumsi_inv_max1'] / 100) / 12))) / 1000 ); 
				
				/*
				$data['hasil']['nilai'][$i]['manfaatinvestasimin1'] = round((($data['hasil']['nilai'][$i-1]['manfaatinvestasimin1'] * 1000) * (1 + ($data['hasil']['asumsi_inv_min1'] / 100)) - (12 * (round($data['hasil']['nilai'][$i]['biayaAsuransi']) + 27500) * (($data['hasil']['persentasealokasidana1']) / 100))) / 1000);
				$data['hasil']['nilai'][$i]['manfaatinvestasimed1'] = round((($data['hasil']['nilai'][$i-1]['manfaatinvestasimed1'] * 1000) * (1 + ($data['hasil']['asumsi_inv_med1'] / 100)) - (12 * (round($data['hasil']['nilai'][$i]['biayaAsuransi']) + 27500) * (($data['hasil']['persentasealokasidana1']) / 100))) / 1000);
				$data['hasil']['nilai'][$i]['manfaatinvestasimax1'] = round((($data['hasil']['nilai'][$i-1]['manfaatinvestasimax1'] * 1000) * (1 + ($data['hasil']['asumsi_inv_max1'] / 100)) - (12 * (round($data['hasil']['nilai'][$i]['biayaAsuransi']) + 27500) * (($data['hasil']['persentasealokasidana1']) / 100))) / 1000);
				
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamin1'] = (((($data['hasil']['persentasealokasidana1']) / 100) * (($this->session->userdata('uangpertanggungan')) / 1000)) + $data['hasil']['nilai'][$i]['manfaatinvestasimin1']);
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamed1'] = (((($data['hasil']['persentasealokasidana1']) / 100) * (($this->session->userdata('uangpertanggungan')) / 1000)) + $data['hasil']['nilai'][$i]['manfaatinvestasimed1']);
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamax1'] = (((($data['hasil']['persentasealokasidana1']) / 100) * (($this->session->userdata('uangpertanggungan')) / 1000)) + $data['hasil']['nilai'][$i]['manfaatinvestasimax1']);
				
				if ($data['hasil']['nilai'][$i]['manfaatinvestasimin1'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatinvestasimin1'] = "***";
				}
				else if ($data['hasil']['nilai'][$i]['manfaatinvestasimed1'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatinvestasimed1'] = "***";
				}
				else if ($data['hasil']['nilai'][$i]['manfaatinvestasimax1'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatinvestasimax1'] = "***";
				}
				else if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniamin1'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniamin1'] = "***";
				}
				else if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniamed1'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniamed1'] = "***";
				}
				else if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniamax1'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniamax1'] = "***";
				}
				
				$data['hasil']['nilai'][$i]['manfaatinvestasimin2'] = round((($data['hasil']['nilai'][$i-1]['manfaatinvestasimin2'] * 1000) * (1 + ($data['hasil']['asumsi_inv_min2'] / 100)) - (12 * (round($data['hasil']['nilai'][$i]['biayaAsuransi']) + 27500) * (($data['hasil']['persentasealokasidana2']) / 100))) / 1000);
				$data['hasil']['nilai'][$i]['manfaatinvestasimed2'] = round((($data['hasil']['nilai'][$i-1]['manfaatinvestasimed2'] * 1000) * (1 + ($data['hasil']['asumsi_inv_med2'] / 100)) - (12 * (round($data['hasil']['nilai'][$i]['biayaAsuransi']) + 27500) * (($data['hasil']['persentasealokasidana2']) / 100))) / 1000);
				$data['hasil']['nilai'][$i]['manfaatinvestasimax2'] = round((($data['hasil']['nilai'][$i-1]['manfaatinvestasimax2'] * 1000) * (1 + ($data['hasil']['asumsi_inv_max2'] / 100)) - (12 * (round($data['hasil']['nilai'][$i]['biayaAsuransi']) + 27500) * (($data['hasil']['persentasealokasidana2']) / 100))) / 1000);
				
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamin2'] = (((($data['hasil']['persentasealokasidana2']) / 100) * (($this->session->userdata('uangpertanggungan')) / 1000)) + $data['hasil']['nilai'][$i]['manfaatinvestasimin2']);
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamed2'] = (((($data['hasil']['persentasealokasidana2']) / 100) * (($this->session->userdata('uangpertanggungan')) / 1000)) + $data['hasil']['nilai'][$i]['manfaatinvestasimed2']);
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniamax2'] = (((($data['hasil']['persentasealokasidana2']) / 100) * (($this->session->userdata('uangpertanggungan')) / 1000)) + $data['hasil']['nilai'][$i]['manfaatinvestasimax2']);
				
				if ($data['hasil']['nilai'][$i]['manfaatinvestasimin2'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatinvestasimin2'] = "***";
				}
				else if ($data['hasil']['nilai'][$i]['manfaatinvestasimed2'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatinvestasimed2'] = "***";
				}
				else if ($data['hasil']['nilai'][$i]['manfaatinvestasimax2'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatinvestasimax2'] = "***";
				}
				else if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniamin2'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniamin2'] = "***";
				}
				else if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniamed2'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniamed2'] = "***";
				}
				else if ($data['hasil']['nilai'][$i]['manfaatmeninggalduniamax2'] < 0)
				{
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniamax2'] = "***";
				}
				*/
			}
			
		}
		
		$filePdf = $this->session->userdata('filepdf');
		
		$this->createPDF($filePdf,$data);
		
		$this->load->view('hasil/jsguardian',$data);
		
		//$this->session->sess_destroy();
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
		$this->pdf->Cell(190,5,'JS GUARDIAN ASSURANCE','B',0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Nomor Proposal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['buildID'].'',0,0,'L');
		$this->pdf->Cell(10);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Tanggal Ilustrasi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['tanggalsekarang'].' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->ln(10);
		
		// CALON PEMEGANG POLIS
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'CALON PEMEGANG POLIS',1,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Nama Pemegang Polis',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['nama'].' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Tanggal Lahir',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['tanggallahircalonpemegangpolis'].' / '.$data['hasil']['usiacalonpemegangpolis'].' tahun',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Jenis Kelamin',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['jeniskelaminpemegangpolis'].' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Status Perokok',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['calonpemegangpolisperokok'].' ',0,0,'L');
		$this->pdf->ln(10);
		
		// CALON TERTANGGUNG
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'CALON TERTANGGUNG',1,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Nama Tertanggung',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['namalengkapcalontertanggung'].' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Tanggal Lahir',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['tanggallahircalontertangggung'].' / '.$data['hasil']['usiacalontertanggung'].' tahun',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Jenis Kelamin',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['jeniskelamincalontertanggung'].' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Status Perokok',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['calontertanggungperokok'].' ',0,0,'L');
		$this->pdf->ln();

		$this->pdf->Cell(190,5,'','B',0,'L');
		$this->pdf->ln(10);
		
		// CARA BAYAR
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Cara Bayar',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['carabayar'].' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Uang Pertanggungan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,number_format($data['hasil']['uangpertanggungan'],0,'.',','),0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Mata Uang',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['matauang'].' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Premi Single',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,number_format($data['hasil']['premisingle'],0,'.',','),0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Top Up Single',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,number_format($data['hasil']['topupsingle'],0,'.',','),'B',0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Total Premi dibayar',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,number_format($data['hasil']['totalpremiyangdibayar'],0,'.',','),0,0,'L');
		$this->pdf->ln(10);
		
		// ALOKASI DANA INVESTASI (%)
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ALOKASI DANA INVESTASI (%)',1,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(95,5,''.$data['hasil']['nama_produk1'].' ',1,0,'L');
		$this->pdf->Cell(95,5,''.$data['hasil']['persentasealokasidana1'].'%',1,0,'L');
		$this->pdf->ln();
		
		if (($data['hasil']['nama_produk2'] != "") && ($data['hasil']['persentasealokasidana2'] != "") && ($data['hasil']['persentasealokasidana2'] != 0))
		{
			$this->pdf->Cell(95,5,''.$data['hasil']['nama_produk2'].' ',1,0,'L');
			$this->pdf->Cell(95,5,''.$data['hasil']['persentasealokasidana2'].'%',1,0,'L');
			$this->pdf->ln(10);
		}
		
		// BIAYA ASURANSI
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'BIAYA ASURANSI',1,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(63.3,5,'NAMA ASURANSI',1,0,'C');
		$this->pdf->Cell(63.3,5,'UANG ASURANSI',1,0,'C');
		$this->pdf->Cell(63.3,5,'BIAYA ASURANSI',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(63.3,5,'Asuransi Dasar',1,0,'C');
		$this->pdf->Cell(63.3,5,number_format($data['hasil']['uangpertanggungan'],0,'.',','),1,0,'C');
		$this->pdf->Cell(63.3,5,number_format($data['hasil']['biayaAsuransi'],0,'.',','),1,0,'C');
		$this->pdf->ln(10);
		
		// ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(25,5,'JS GUARDIAN','LTR',0,'C');
		$this->pdf->Cell(165,5,'Apabila Tertanggung mencapai usia 99 Tahun, manfaat yang dibayarkan adalah besar Nilai Investasi (Jumlah Unit x NAB).','LTR',0,'J');
		$this->pdf->ln();
		$this->pdf->Cell(25,5,'','LR',0,'C');
		$this->pdf->Cell(165,5,'Apabila Tertanggung meninggal dunia dalam masa perjanjian Asuransi baik karena sakit, karena kecelakaan, maka kepada ahli','LR',0,'J');
		$this->pdf->ln();
		$this->pdf->Cell(25,5,'','LBR',0,'C');
		$this->pdf->Cell(165,5,'waris atau yang ditunjuk dibayarkan Uang Asuransi JS GUARDIAN ditambah Saldo Dana Investasi.','LBR',0,'J');
		$this->pdf->ln(25);
		
		// FOOTER
		$this->pdf->ln();
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
		$this->pdf->Cell(29,5,''.$data['hasil']['buildID'].' ',0,0,'L');
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
		
		if (($data['hasil']['nama_produk1'] != "") && ($data['hasil']['persentasealokasidana1'] != "") && ($data['hasil']['persentasealokasidana1'] != 0))
		{
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
			$this->pdf->Cell(190,5,'JS GUARDIAN','B',0,'L');
			$this->pdf->ln(10);
			$this->pdf->SetFont('Arial','B',10);
			$this->pdf->SetFillColor(200,200,200);
			$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
			$this->pdf->ln(10);
			$this->pdf->SetFont('Arial','B',8);
			$this->pdf->Cell(25,5,''.$data['hasil']['nama_produk1'].'','B',0,'C');
			//$this->pdf->Cell(10,5,'('.$data['hasil']['persentasealokasidana1'].' %)','B',0,'C');
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
			
			for($i=0;$i<=19;$i++){
					$this->pdf->Cell(15,5,' '.$i.' '+1,'LBR',0,'C');
					$this->pdf->Cell(15,5,$data['hasil']['nilai'][$i]['usiacalontertanggung'],1,0,'C');
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['premisingle'],0,'.',','),1,0,'C');
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['topupsingle'],0,'.',','),1,0,'C');
					if (((($data['hasil']['nilai'][$i]['manfaatinvestasimin1'] / 1000) * ($data['hasil']['persentasealokasidana1'] / 100)) < 0) || ((($data['hasil']['nilai'][$i]['manfaatinvestasimin1'] / 1000) * ($data['hasil']['persentasealokasidana1'] / 100)) == 0))
					{
						$this->pdf->Cell(20,5,'***',1,0,'C');
					}
					else
					{
						$this->pdf->Cell(20,5,number_format((($data['hasil']['nilai'][$i]['manfaatinvestasimin1'] / 1000) * ($data['hasil']['persentasealokasidana1'] / 100)),0,'.',','),1,0,'C');
					}
					if (((($data['hasil']['nilai'][$i]['manfaatinvestasimed1'] / 1000) * ($data['hasil']['persentasealokasidana1'] / 100)) < 0) || ((($data['hasil']['nilai'][$i]['manfaatinvestasimed1'] / 1000) * ($data['hasil']['persentasealokasidana1'] / 100)) == 0))
					{
						$this->pdf->Cell(20,5,'***',1,0,'C');
					}
					else
					{
						$this->pdf->Cell(20,5,number_format((($data['hasil']['nilai'][$i]['manfaatinvestasimed1'] / 1000) * ($data['hasil']['persentasealokasidana1'] / 100)),0,'.',','),1,0,'C');
					}
					if (((($data['hasil']['nilai'][$i]['manfaatinvestasimax1'] / 1000) * ($data['hasil']['persentasealokasidana1'] / 100)) < 0) || ((($data['hasil']['nilai'][$i]['manfaatinvestasimax1'] / 1000) * ($data['hasil']['persentasealokasidana1'] / 100)) == 0))
					{
						$this->pdf->Cell(20,5,'***',1,0,'C');
					}
					else
					{
						$this->pdf->Cell(20,5,number_format((($data['hasil']['nilai'][$i]['manfaatinvestasimax1'] / 1000) * ($data['hasil']['persentasealokasidana1'] / 100)),0,'.',','),1,0,'C');
					}
					if (($data['hasil']['nilai'][$i]['manfaatmeninggalduniamin1'] < 0) || ($data['hasil']['nilai'][$i]['manfaatmeninggalduniamin1'] == 0))
					{
						$this->pdf->Cell(20,5,'***',1,0,'C');
					}
					else
					{
						$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniamin1'],0,'.',','),1,0,'C');
					}
					if (($data['hasil']['nilai'][$i]['manfaatmeninggalduniamed1'] < 0) || ($data['hasil']['nilai'][$i]['manfaatmeninggalduniamed1'] == 0))
					{
						$this->pdf->Cell(20,5,'***',1,0,'C');
					}
					else
					{
						$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniamed1'],0,'.',','),1,0,'C');
					}
					if (($data['hasil']['nilai'][$i]['manfaatmeninggalduniamax1'] < 0) || ($data['hasil']['nilai'][$i]['manfaatmeninggalduniamax1'] == 0))
					{
						$this->pdf->Cell(20,5,'***',1,0,'C');
					}
					else
					{
						$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniamax1'],0,'.',','),1,0,'C');
					}
					
					$this->pdf->ln();
			}
			for($i=99-$data['hasil']['usiacalontertanggung'];$i<=99-$data['hasil']['usiacalontertanggung'];$i++){
					$this->pdf->Cell(15,5,' '.$i.' '+1,'LBR',0,'C');
					$this->pdf->Cell(15,5,$data['hasil']['nilai'][$i]['usiacalontertanggung'],1,0,'C');
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['premisingle'],0,'.',','),1,0,'C');
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['topupsingle'],0,'.',','),1,0,'C');
					if (((($data['hasil']['nilai'][$i]['manfaatinvestasimin1'] / 1000) * ($data['hasil']['persentasealokasidana1'] / 100)) < 0) || ((($data['hasil']['nilai'][$i]['manfaatinvestasimin1'] / 1000) * ($data['hasil']['persentasealokasidana1'] / 100)) == 0))
					{
						$this->pdf->Cell(20,5,'***',1,0,'C');
					}
					else
					{
						$this->pdf->Cell(20,5,number_format((($data['hasil']['nilai'][$i]['manfaatinvestasimin1'] / 1000) * ($data['hasil']['persentasealokasidana1'] / 100)),0,'.',','),1,0,'C');
					}
					if (((($data['hasil']['nilai'][$i]['manfaatinvestasimed1'] / 1000) * ($data['hasil']['persentasealokasidana1'] / 100)) < 0) || ((($data['hasil']['nilai'][$i]['manfaatinvestasimed1'] / 1000) * ($data['hasil']['persentasealokasidana1'] / 100)) == 0))
					{
						$this->pdf->Cell(20,5,'***',1,0,'C');
					}
					else
					{
						$this->pdf->Cell(20,5,number_format((($data['hasil']['nilai'][$i]['manfaatinvestasimed1'] / 1000) * ($data['hasil']['persentasealokasidana1'] / 100)),0,'.',','),1,0,'C');
					}
					if (((($data['hasil']['nilai'][$i]['manfaatinvestasimax1'] / 1000) * ($data['hasil']['persentasealokasidana1'] / 100)) < 0) || ((($data['hasil']['nilai'][$i]['manfaatinvestasimax1'] / 1000) * ($data['hasil']['persentasealokasidana1'] / 100)) == 0))
					{
						$this->pdf->Cell(20,5,'***',1,0,'C');
					}
					else
					{
						$this->pdf->Cell(20,5,number_format((($data['hasil']['nilai'][$i]['manfaatinvestasimax1'] / 1000) * ($data['hasil']['persentasealokasidana1'] / 100)),0,'.',','),1,0,'C');
					}
					if (($data['hasil']['nilai'][$i]['manfaatmeninggalduniamin1'] < 0) || ($data['hasil']['nilai'][$i]['manfaatmeninggalduniamin1'] == 0))
					{
						$this->pdf->Cell(20,5,'***',1,0,'C');
					}
					else
					{
						$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniamin1'],0,'.',','),1,0,'C');
					}
					if (($data['hasil']['nilai'][$i]['manfaatmeninggalduniamed1'] < 0) || ($data['hasil']['nilai'][$i]['manfaatmeninggalduniamed1'] == 0))
					{
						$this->pdf->Cell(20,5,'***',1,0,'C');
					}
					else
					{
						$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniamed1'],0,'.',','),1,0,'C');
					}
					if (($data['hasil']['nilai'][$i]['manfaatmeninggalduniamax1'] < 0) || ($data['hasil']['nilai'][$i]['manfaatmeninggalduniamax1'] == 0))
					{
						$this->pdf->Cell(20,5,'***',1,0,'C');
					}
					else
					{
						$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniamax1'],0,'.',','),1,0,'C');
					}
					
					$this->pdf->ln();
			}
			
			$this->pdf->SetFillColor(204,255,255);
			$this->pdf->Cell(190,1,'',1,0,'C', true);
			$this->pdf->ln();

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
			$this->pdf->Cell(20,5,''.$data['hasil']['asumsi_inv_min1'].'%',1,0,'C');
			$this->pdf->Cell(20,5,''.$data['hasil']['asumsi_inv_med1'].'%',1,0,'C');
			$this->pdf->Cell(20,5,''.$data['hasil']['asumsi_inv_max1'].'%',1,0,'C');
			$this->pdf->ln();

			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(15,5,'^',0,0,'L');
			$this->pdf->Cell(175,5,'Masa Asuransi sampai dengan Tertanggung mencapai usia 99 tahun.',0,0,'L');
			$this->pdf->ln();
			$this->pdf->Cell(15,5,'*',0,0,'L');
			$this->pdf->Cell(175,5,'Ilustrasi di atas dalam ribuan rupiah.',0,0,'L');
			$this->pdf->ln();
			$this->pdf->Cell(15,5,'**',0,0,'L');
			$this->pdf->Cell(175,5,'Asumsi tinggi rendahnya tingkat hasil investasi ini hanya bertujuan untuk ilustrasi saja dan bukan merupakan tolak ukur untuk perhitungan',0,0,'L');
			$this->pdf->ln();
			$this->pdf->Cell(15,5,'',0,0,'L');
			$this->pdf->Cell(175,5,'rata-rata tingkat hasil investasi yang terendah dan tertinggi.',0,0,'L');
			$this->pdf->ln();
			$this->pdf->Cell(15,5,'***',0,0,'L');
			$this->pdf->Cell(175,5,'Menunjukkan bahwa Nilai Tunai pada tahun tersebut tidak mencukupi untuk membayar Biaya Asuransi dan administrasi, dan oleh karena',0,0,'L');
			$this->pdf->ln();
			$this->pdf->Cell(15,5,'',0,0,'L');
			$this->pdf->Cell(175,5,'itu Polis akan batal (lapse). Supaya Manfaat Polis dapat terus berlanjut, maka Anda diminta untuk melanjutkan pembayaran premi tahunan',0,0,'L');
			$this->pdf->ln();
			$this->pdf->Cell(15,5,'',0,0,'L');
			$this->pdf->Cell(175,5,'seperti dinyatakan dalam ilustrasi ini.',0,0,'L');
			$this->pdf->ln();
			
			// FOOTER
			$this->pdf->ln(15);
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
			$this->pdf->Cell(29,5,''.$data['hasil']['buildID'].' ',0,0,'L');
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
		
		if (($data['hasil']['nama_produk2'] != "") && ($data['hasil']['persentasealokasidana2'] != "") && ($data['hasil']['persentasealokasidana2'] != 0))
		{
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
			$this->pdf->Cell(190,5,'JS GUARDIAN','B',0,'L');
			$this->pdf->ln(10);
			$this->pdf->SetFont('Arial','B',10);
			$this->pdf->SetFillColor(200,200,200);
			$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
			$this->pdf->ln(10);
			$this->pdf->SetFont('Arial','B',8);
			$this->pdf->Cell(25,5,''.$data['hasil']['nama_produk2'].' ','B',0,'C');
			//$this->pdf->Cell(10,5,'('.$data['hasil']['persentasealokasidana2'].' %)','B',0,'C');
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
			
			for($i=0;$i<=19;$i++){
					$this->pdf->Cell(15,5,' '.$i.' '+1,'LBR',0,'C');
					$this->pdf->Cell(15,5,$data['hasil']['nilai'][$i]['usiacalontertanggung'],1,0,'C');
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['premisingle'],0,'.',','),1,0,'C');
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['topupsingle'],0,'.',','),1,0,'C');
					if (((($data['hasil']['nilai'][$i]['manfaatinvestasimin2'] / 1000) * ($data['hasil']['persentasealokasidana2'] / 100)) < 0) || ((($data['hasil']['nilai'][$i]['manfaatinvestasimin2'] / 1000) * ($data['hasil']['persentasealokasidana2'] / 100)) == 0))
					{
						$this->pdf->Cell(20,5,'***',1,0,'C');
					}
					else
					{
						$this->pdf->Cell(20,5,number_format((($data['hasil']['nilai'][$i]['manfaatinvestasimin2'] / 1000) * ($data['hasil']['persentasealokasidana2'] / 100)),0,'.',','),1,0,'C');
					}
					if (((($data['hasil']['nilai'][$i]['manfaatinvestasimed2'] / 1000) * ($data['hasil']['persentasealokasidana2'] / 100)) < 0) || ((($data['hasil']['nilai'][$i]['manfaatinvestasimed2'] / 1000) * ($data['hasil']['persentasealokasidana2'] / 100)) == 0))
					{
						$this->pdf->Cell(20,5,'***',1,0,'C');
					}
					else
					{
						$this->pdf->Cell(20,5,number_format((($data['hasil']['nilai'][$i]['manfaatinvestasimed2'] / 1000) * ($data['hasil']['persentasealokasidana2'] / 100)),0,'.',','),1,0,'C');
					}
					if (((($data['hasil']['nilai'][$i]['manfaatinvestasimax2'] / 1000) * ($data['hasil']['persentasealokasidana2'] / 100)) < 0) || ((($data['hasil']['nilai'][$i]['manfaatinvestasimax2'] / 1000) * ($data['hasil']['persentasealokasidana2'] / 100)) == 0))
					{
						$this->pdf->Cell(20,5,'***',1,0,'C');
					}
					else
					{
						$this->pdf->Cell(20,5,number_format((($data['hasil']['nilai'][$i]['manfaatinvestasimax2'] / 1000) * ($data['hasil']['persentasealokasidana2'] / 100)),0,'.',','),1,0,'C');
					}
					if (($data['hasil']['nilai'][$i]['manfaatmeninggalduniamin2'] < 0) || ($data['hasil']['nilai'][$i]['manfaatmeninggalduniamin2'] == 0))
					{
						$this->pdf->Cell(20,5,'***',1,0,'C');
					}
					else
					{
						$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniamin2'],0,'.',','),1,0,'C');
					}
					if (($data['hasil']['nilai'][$i]['manfaatmeninggalduniamed2'] < 0) || ($data['hasil']['nilai'][$i]['manfaatmeninggalduniamed2'] == 0))
					{
						$this->pdf->Cell(20,5,'***',1,0,'C');
					}
					else
					{
						$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniamed2'],0,'.',','),1,0,'C');
					}
					if (($data['hasil']['nilai'][$i]['manfaatmeninggalduniamax2'] < 0) || ($data['hasil']['nilai'][$i]['manfaatmeninggalduniamax2'] == 0))
					{
						$this->pdf->Cell(20,5,'***',1,0,'C');
					}
					else
					{
						$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniamax2'],0,'.',','),1,0,'C');
					}
					
					$this->pdf->ln();
			}
			for($i=99-$data['hasil']['usiacalontertanggung'];$i<=99-$data['hasil']['usiacalontertanggung'];$i++){
					$this->pdf->Cell(15,5,' '.$i.' '+1,'LBR',0,'C');
					$this->pdf->Cell(15,5,$data['hasil']['nilai'][$i]['usiacalontertanggung'],1,0,'C');
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['premisingle'],0,'.',','),1,0,'C');
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['topupsingle'],0,'.',','),1,0,'C');
					if (((($data['hasil']['nilai'][$i]['manfaatinvestasimin2'] / 1000) * ($data['hasil']['persentasealokasidana2'] / 100)) < 0) || ((($data['hasil']['nilai'][$i]['manfaatinvestasimin2'] / 1000) * ($data['hasil']['persentasealokasidana2'] / 100)) == 0))
					{
						$this->pdf->Cell(20,5,'***',1,0,'C');
					}
					else
					{
						$this->pdf->Cell(20,5,number_format((($data['hasil']['nilai'][$i]['manfaatinvestasimin2'] / 1000) * ($data['hasil']['persentasealokasidana2'] / 100)),0,'.',','),1,0,'C');
					}
					if (((($data['hasil']['nilai'][$i]['manfaatinvestasimed2'] / 1000) * ($data['hasil']['persentasealokasidana2'] / 100)) < 0) || ((($data['hasil']['nilai'][$i]['manfaatinvestasimed2'] / 1000) * ($data['hasil']['persentasealokasidana2'] / 100)) == 0))
					{
						$this->pdf->Cell(20,5,'***',1,0,'C');
					}
					else
					{
						$this->pdf->Cell(20,5,number_format((($data['hasil']['nilai'][$i]['manfaatinvestasimed2'] / 1000) * ($data['hasil']['persentasealokasidana2'] / 100)),0,'.',','),1,0,'C');
					}
					if (((($data['hasil']['nilai'][$i]['manfaatinvestasimax2'] / 1000) * ($data['hasil']['persentasealokasidana2'] / 100)) < 0) || ((($data['hasil']['nilai'][$i]['manfaatinvestasimax2'] / 1000) * ($data['hasil']['persentasealokasidana2'] / 100)) == 0))
					{
						$this->pdf->Cell(20,5,'***',1,0,'C');
					}
					else
					{
						$this->pdf->Cell(20,5,number_format((($data['hasil']['nilai'][$i]['manfaatinvestasimax2'] / 1000) * ($data['hasil']['persentasealokasidana2'] / 100)),0,'.',','),1,0,'C');
					}
					if (($data['hasil']['nilai'][$i]['manfaatmeninggalduniamin2'] < 0) || ($data['hasil']['nilai'][$i]['manfaatmeninggalduniamin2'] == 0))
					{
						$this->pdf->Cell(20,5,'***',1,0,'C');
					}
					else
					{
						$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniamin2'],0,'.',','),1,0,'C');
					}
					if (($data['hasil']['nilai'][$i]['manfaatmeninggalduniamed2'] < 0) || ($data['hasil']['nilai'][$i]['manfaatmeninggalduniamed2'] == 0))
					{
						$this->pdf->Cell(20,5,'***',1,0,'C');
					}
					else
					{
						$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniamed2'],0,'.',','),1,0,'C');
					}
					if (($data['hasil']['nilai'][$i]['manfaatmeninggalduniamax2'] < 0) || ($data['hasil']['nilai'][$i]['manfaatmeninggalduniamax2'] == 0))
					{
						$this->pdf->Cell(20,5,'***',1,0,'C');
					}
					else
					{
						$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniamax2'],0,'.',','),1,0,'C');
					}
					
					$this->pdf->ln();
			}
			
			$this->pdf->SetFillColor(204,255,255);
			$this->pdf->Cell(190,1,'',1,0,'C', true);
			$this->pdf->ln();

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
			$this->pdf->Cell(20,5,''.$data['hasil']['asumsi_inv_min2'].'%',1,0,'C');
			$this->pdf->Cell(20,5,''.$data['hasil']['asumsi_inv_med2'].'%',1,0,'C');
			$this->pdf->Cell(20,5,''.$data['hasil']['asumsi_inv_max2'].'%',1,0,'C');
			$this->pdf->ln();

			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(15,5,'^',0,0,'L');
			$this->pdf->Cell(175,5,'Masa Asuransi sampai dengan Tertanggung mencapai usia 99 tahun.',0,0,'L');
			$this->pdf->ln();
			$this->pdf->Cell(15,5,'*',0,0,'L');
			$this->pdf->Cell(175,5,'Ilustrasi di atas dalam ribuan rupiah.',0,0,'L');
			$this->pdf->ln();
			$this->pdf->Cell(15,5,'**',0,0,'L');
			$this->pdf->Cell(175,5,'Asumsi tinggi rendahnya tingkat hasil investasi ini hanya bertujuan untuk ilustrasi saja dan bukan merupakan tolak ukur untuk perhitungan',0,0,'L');
			$this->pdf->ln();
			$this->pdf->Cell(15,5,'',0,0,'L');
			$this->pdf->Cell(175,5,'rata-rata tingkat hasil investasi yang terendah dan tertinggi.',0,0,'L');
			$this->pdf->ln();
			$this->pdf->Cell(15,5,'***',0,0,'L');
			$this->pdf->Cell(175,5,'Menunjukkan bahwa Nilai Tunai pada tahun tersebut tidak mencukupi untuk membayar Biaya Asuransi dan administrasi, dan oleh karena',0,0,'L');
			$this->pdf->ln();
			$this->pdf->Cell(15,5,'',0,0,'L');
			$this->pdf->Cell(175,5,'itu Polis akan batal (lapse). Supaya Manfaat Polis dapat terus berlanjut, maka Anda diminta untuk melanjutkan pembayaran premi tahunan',0,0,'L');
			$this->pdf->ln();
			$this->pdf->Cell(15,5,'',0,0,'L');
			$this->pdf->Cell(175,5,'seperti dinyatakan dalam ilustrasi ini.',0,0,'L');
			$this->pdf->ln();
			
			// FOOTER
			$this->pdf->ln(15);
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
			$this->pdf->Cell(29,5,''.$data['hasil']['buildID'].' ',0,0,'L');
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
		$this->pdf->Cell(190,5,'JS GUARDIAN','B',0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(25,5,'RINGKASAN','B',0,'C');
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
		
		for($i=0;$i<=19;$i++){
				$this->pdf->Cell(15,5,' '.$i.' '+1,'LBR',0,'C');
				$this->pdf->Cell(15,5,$data['hasil']['nilai'][$i]['usiacalontertanggung'],1,0,'C');
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['premisingle'],0,'.',','),1,0,'C');
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['topupsingle'],0,'.',','),1,0,'C');
				
				if ((($data['hasil']['nilai'][$i]['manfaatinvestasiminringkasan'] / 1000) < 0) || (($data['hasil']['nilai'][$i]['manfaatinvestasiminringkasan'] / 1000) == 0))
				{
					$this->pdf->Cell(20,5,'***',1,0,'C');
				}
				else
				{
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatinvestasiminringkasan'] / 1000,0,'.',','),1,0,'C');
				}
				if ((($data['hasil']['nilai'][$i]['manfaatinvestasimedringkasan'] / 1000) < 0) || (($data['hasil']['nilai'][$i]['manfaatinvestasimedringkasan'] / 1000) == 0))
				{
					$this->pdf->Cell(20,5,'***',1,0,'C');
				}
				else
				{
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatinvestasimedringkasan'] / 1000,0,'.',','),1,0,'C');
				}
				if ((($data['hasil']['nilai'][$i]['manfaatinvestasimaxringkasan'] / 1000) < 0) || (($data['hasil']['nilai'][$i]['manfaatinvestasimaxringkasan'] / 1000) == 0))
				{
					$this->pdf->Cell(20,5,'***',1,0,'C');
				}
				else
				{
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatinvestasimaxringkasan'] / 1000,0,'.',','),1,0,'C');
				}
				if (($data['hasil']['nilai'][$i]['manfaatmeninggalduniaminringkasan'] < 0) || ($data['hasil']['nilai'][$i]['manfaatmeninggalduniaminringkasan'] == 0))
				{
					$this->pdf->Cell(20,5,'***',1,0,'C');
				}
				else
				{
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniaminringkasan'],0,'.',','),1,0,'C');
				}
				if (($data['hasil']['nilai'][$i]['manfaatmeninggalduniamedringkasan'] < 0) || ($data['hasil']['nilai'][$i]['manfaatmeninggalduniamedringkasan'] == 0))
				{
					$this->pdf->Cell(20,5,'***',1,0,'C');
				}
				else
				{
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniamedringkasan'],0,'.',','),1,0,'C');
				}
				if (($data['hasil']['nilai'][$i]['manfaatmeninggalduniamaxringkasan'] < 0) || ($data['hasil']['nilai'][$i]['manfaatmeninggalduniamaxringkasan'] == 0))
				{
					$this->pdf->Cell(20,5,'***',1,0,'C');
				}
				else
				{
					$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniamaxringkasan'],0,'.',','),1,0,'C');
				}
				
				$this->pdf->ln();
		}
		for($i=99-$data['hasil']['usiacalontertanggung'];$i<=99-$data['hasil']['usiacalontertanggung'];$i++){
				$this->pdf->Cell(15,5,' '.$i.' '+1,'LBR',0,'C');
				$this->pdf->Cell(15,5,$data['hasil']['nilai'][$i]['usiacalontertanggung'],1,0,'C');
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['premisingle'],0,'.',','),1,0,'C');
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['topupsingle'],0,'.',','),1,0,'C');
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatinvestasiminringkasan'] / 1000,0,'.',','),1,0,'C');
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatinvestasimedringkasan'] / 1000,0,'.',','),1,0,'C');
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatinvestasimaxringkasan'] / 1000,0,'.',','),1,0,'C');
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniaminringkasan'],0,'.',','),1,0,'C');
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniamedringkasan'],0,'.',','),1,0,'C');
				$this->pdf->Cell(20,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniamaxringkasan'],0,'.',','),1,0,'C');
				
				$this->pdf->ln();
		}
		
		$this->pdf->SetFillColor(204,255,255);
		$this->pdf->Cell(190,1,'',1,0,'C', true);
		$this->pdf->ln();
		
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(15,5,'^',0,0,'L');
		$this->pdf->Cell(175,5,'Masa Asuransi sampai dengan Tertanggung mencapai usia 99 tahun.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(15,5,'*',0,0,'L');
		$this->pdf->Cell(175,5,'Ilustrasi di atas dalam ribuan rupiah.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(15,5,'**',0,0,'L');
		$this->pdf->Cell(175,5,'Asumsi tinggi rendahnya tingkat hasil investasi ini hanya bertujuan untuk ilustrasi saja dan bukan merupakan tolak ukur untuk perhitungan',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(15,5,'',0,0,'L');
		$this->pdf->Cell(175,5,'rata-rata tingkat hasil investasi yang terendah dan tertinggi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(15,5,'***',0,0,'L');
		$this->pdf->Cell(175,5,'Menunjukkan bahwa Nilai Tunai pada tahun tersebut tidak mencukupi untuk membayar Biaya Asuransi dan administrasi, dan oleh karena',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(15,5,'',0,0,'L');
		$this->pdf->Cell(175,5,'itu Polis akan batal (lapse). Supaya Manfaat Polis dapat terus berlanjut, maka Anda diminta untuk melanjutkan pembayaran premi tahunan',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(15,5,'',0,0,'L');
		$this->pdf->Cell(175,5,'seperti dinyatakan dalam ilustrasi ini.',0,0,'L');
		$this->pdf->ln();
		
		// FOOTER
		$this->pdf->ln(30);
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
		$this->pdf->Cell(29,5,''.$data['hasil']['buildID'].' ',0,0,'L');
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
		$this->pdf->Cell(190,5,'JS GUARDIAN','B',0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(8);
		
		// HAL-HAL PENTING
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(190,5,'HAL-HAL PENTING',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->MultiCell(190,5,'1. Alokasi Premi yang dibentuk ke dalam Premi',0);
		$this->pdf->Cell(95,5,'',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(95,5,'Tahun 1',1,0,'C');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(95,5,'Premi Sekaligus',1,0,'L');
		$this->pdf->Cell(95,5,'',1,0,'C');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(95,5,'Investasi',1,0,'C');
		$this->pdf->Cell(95,5,'95%',1,0,'C');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(95,5,'Biaya',1,0,'C');
		$this->pdf->Cell(95,5,'5%',1,0,'C');
		$this->pdf->ln(5);
		$this->pdf->Cell(95,5,'Top Up',1,0,'L');
		$this->pdf->Cell(95,5,'',1,0,'C');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(95,5,'Investasi',1,0,'C');
		$this->pdf->Cell(95,5,'95%',1,0,'C');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(95,5,'Biaya',1,0,'C');
		$this->pdf->Cell(95,5,'5%',1,0,'C');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->MultiCell(190,5,'2. Ilustrasi di atas akan diperhitungkan dengan:',0);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->cell('3');
		$this->pdf->MultiCell(185,5,'a. Biaya administrasi sebesar Rp. 27.500,- per bulan selama masa asuransi.',0);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->cell('3');
		$this->pdf->MultiCell(185,5,'b. Biaya Asuransi (Cost Of Insurance dan Cost Of Rider) akan dikenakan setiap bulan selama masa Asuransi. Besarnya COI dan COR akan naik setiap tahun sesuai dengan bertambahnya usia Tertanggung.',0);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->cell('3');
		$this->pdf->MultiCell(185,5,'c. Biaya pengelolaan investasi maksimal 5% per tahun tergantung jenis reksadana yang dipilih.',0);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->cell('3');
		$this->pdf->MultiCell(185,5,'d. Biaya pembelian unit adalah sebesar 5% dari dana investasi.',0);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->MultiCell(190,5,'3. Nilai Tunai adalah Nilai Saldo Unit yang dihitung berdasarkan Harga Unit pada saat tertentu.',0);
		$this->pdf->MultiCell(190,5,'4. Asumsi tinggi rendahnya tingkat hasil investasi ini hanya bertujuan untuk ilustrasi saja dan bukan merupakan tolak ukur untuk perhitungan rata-rata tingkat hasil investasi yang terendah dan tertinggi.',0);
		$this->pdf->MultiCell(190,5,'5. Perubahan harga unit menggambarkan hasil investasi dari dana investasi. Kinerja dari investasi tidak dijamin tergantung dari risiko masing-masing dana investasi. Pemegang Polis diberi keleluasaan untuk menempatkan alokasi dana investasi yang memungkinkan Optimalisasi tingkat pengembalian investasi, sesuai dengan kebutuhan dan profil risiko Pemegang Polis.',0);
		$this->pdf->MultiCell(190,5,'6. Besarnya Nilai Tunai yang dibayarkan (bisa lebih besar atau lebih kecil dari yang diilustrasikan) akan bergantung pada perkembangan dari dana investasi JS GUARDIAN.',0);
		$this->pdf->MultiCell(190,5,'7. Jumlah minimum Top Up Sekaligus adalah Rp. 1.000.000,-.',0);
		$this->pdf->MultiCell(190,5,'8. Minimum penarikan dana (Redemptions) adalah Rp. 1.000.000,- dan menyisakan dana minimum setara dengan 1.000 unit.',0);
		$this->pdf->MultiCell(190,5,'9.	Pemegang Polis tidak dikenakan biaya penarikan dana, jika penarikan dilakukan setelah usia polis 2 tahun. Jika penarikan dana dilakukan selama usia Polis kurang dari 2 tahun, maka akan dikenakan biaya sebesar 2% dari total dana penarikan.',0);
		//$this->pdf->MultiCell(190,5,'10. Untuk setiap penarikan sebelum usia polis 3 tahun, akan dikenakan pajak penghasilan sesuai ketentuan pemerintah yang berlaku atas kelebihan Nilai Tunai terhadap total premi yang dibayarkan kecuali ditentukan lain berdasarkan peraturan perundang-undangan yang berlaku. Peraturan perpajakan dapat berubah sesuai keputusan legislatif dan di luar kebijakan PT. Asuransi Jiwasraya (Persero) sebagai penanggung.',0);
		$this->pdf->MultiCell(190,5,'10. Penilaian harga unit dilakukan pada setiap hari kerja, Senin sampai dengan Jum`at dengan menggunakan metode harga pasar yang berlaku bagi instrumen investasi yang mendasari masing-masing alokasi dana investasi yang dipilih.',0);
		$this->pdf->MultiCell(190,5,'11. Besarnya Nilai Tunai yang terbentuk pada polis ini (dapat lebih besar atau lebih kecil dari dana yang diinvestasikan oleh Pemegang Polis), akan dipengaruhi oleh fluktuasi dari harga unit atau faktor biaya-biaya sebagaimana disebutkan di atas.',0);
		$this->pdf->MultiCell(190,5,'12. Harga unit yang digunakan pada Premi Pertama akan terbentuk setelah diterimanya SPAJ dan teridentifikasinya seluruh pembayaran Premi Pertama di Kantor Pusat oleh Jiwasraya. Tanggal Perhitungan Harga Unit adalah Tanggal Perhitungan berikutnya setelah diterimanya SPAJ. Atau teridentifikasinya seluruh pembayaran Premi pertama di Kantor Pusat, mana yang paling akhir.',0);
		$this->pdf->MultiCell(190,5,'13. Memiliki Polis Asuransi Jiwa merupakan komitmen jangka panjang. JS GUARDIAN adalah suatu produk asuransi jiwa yang dikaitkan dengan investasi. Untuk dapat menikmati manfaat polis ini, maka kami sarankan Anda untuk melakukan pembayaran Premi selama Masa Asuransi.',0);
		
		// FOOTER
		$this->pdf->ln(20);
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
		$this->pdf->Cell(29,5,''.$data['hasil']['buildID'].' ',0,0,'L');
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
		$this->pdf->Cell(190,5,'JS GUARDIAN ASSURANCE','B',0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(5);
		
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