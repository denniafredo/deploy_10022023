<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");

	error_reporting(0);

class Jl3 extends CI_Controller{

	function masapembpremi(){
					
		$usiasekarang = $this->input->post("usiasekarang");
	
		//for ($i = 1; $i < 65 - $usiasekarang ; $i++)
		//{
			//$result = $i;
			echo $usiasekarang;
		//}
		
		
	}
	
	function masatopupsekaligus(){
					
		$usiasekarang = $this->input->post("usiasekarang");
	
		//for ($i = 1; $i < 65 - $usiasekarang ; $i++)
		//{
			//$result = $i;
			echo $usiasekarang;
		//}
		
		
	}
	
	function hitungpremitambahanCI(){
			
		$this->load->model('ModSimulasi');
		
		$juaci = $this->input->post("juaci");
		$masapemb = $this->input->post("masapemb");
		$usiasekarang = $this->input->post("usiasekarang");
		
		$result = $this->ModSimulasi->getPremiTambahanCI(1, $usiasekarang, 'CI');
		
		//$juaci2 = $this->input->get("juaci");
		//return $juaci;
		
		$faktorcb = $this->input->post("faktorcb");

		$hasil = (($result['TARIF'] / 1000) * $juaci) * $faktorcb;
			
		//echo "$juaci / 1000 * ".$result['TARIF']." * $faktorcb = ".$hasil."<br>";
		
		//echo $hasilbagi."<br><br>";
		
		if (($hasil % 1000) > 0)
		{	
			$hasil = floor($hasil / 1000); 
			$hasilpembulatan = ($hasil * 1000) + 1000;
			echo $hasilpembulatan/1000;
		}
		else
		{
			echo $hasil;
		}
			
	}
	
	function hitungpremitambahanPA(){
		
		$this->load->model('ModSimulasi');
			
		$juapa = $this->input->post("juapa");
		$masapemb = $this->input->post("masapemb");
		$usiasekarang = $this->input->post("usiasekarang");
		
		$result = $this->ModSimulasi->getPremiTambahanPA(1, $usiasekarang, 'PA');
		
		//$juaci2 = $this->input->get("juaci");
		//return $juaci;
		
		$faktorcb = $this->input->post("faktorcb");

		$hasil = ((floatval(preg_replace("/[^-0-9\.]/","",($result['TARIF']))) / 1000) / 1000 * $juapa) * $faktorcb;
			
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
	
	function hitungpremitambahanWP(){
		
		$this->load->model('ModSimulasi');
			
		$juawp = $this->input->post("juawp");
		$masapembpremi = $this->input->post("masapembpremi");
		$usiasekarang = $this->input->post("usiasekarang");
		
		$result = $this->ModSimulasi->getPremiTambahanWP(1, $usiasekarang, 'WPC');
		
		//$juaci2 = $this->input->get("juaci");
		//return $juaci;
		
		$faktorcb = $this->input->post("faktorcb");

		$hasil = (($result['TARIF'] / 1000) * $juawp) * $faktorcb;
			
		//echo "$juaci / 1000 * ".$result['TARIF']." * $faktorcb = ".$hasil."<br>";
		
		//echo $hasilbagi."<br><br>";
		
		if (($hasil % 1000) > 0)
		{	
			$hasil = floor($hasil / 1000); 
			$hasilpembulatan = ($hasil * 1000) + 1000;
			echo $hasilpembulatan/1000;
		}
		else
		{
			echo $hasil;
		}

	}
	
	function hitungpremitambahanCTT(){
		
		$this->load->model('ModSimulasi');
			
		$juactt = $this->input->post("juactt");
		$masapemb = $this->input->post("masapemb");
		$usiasekarang = $this->input->post("usiasekarang");
		
		$result = $this->ModSimulasi->getPremiTambahanCTT(1, $usiasekarang, 'CTT');
		
		//$juaci2 = $this->input->get("juaci");
		//return $juaci;
		
		$faktorcb = $this->input->post("faktorcb");

		$hasil = (($result['TARIF'] / 1000) * $juactt) * $faktorcb;
			
		//echo "$juaci / 1000 * ".$result['TARIF']." * $faktorcb = ".$hasil."<br>";
		
		//echo $hasilbagi."<br><br>";
		
		if (($hasil % 1000) > 0)
		{	
			$hasil = floor($hasil / 1000); 
			$hasilpembulatan = ($hasil * 1000) + 1000;
			echo $hasilpembulatan/1000;
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
		$masapemb = $this->input->post("masapemb");
		$usiasekarang = $this->input->post("usiasekarang");
		$statusperokok = $this->input->post("statusperokok");
		
		$biayaasuransiperbulantermlife = $this->ModSimulasi->getBiayaAsuransiPerBulanTermLife($usiasekarang);
		$biayaasuransiperbulantl = $biayaasuransiperbulantermlife[$statusperokok];
		
		//$result = $this->ModSimulasi->getPremiTambahanTERM(1, $usiasekarang, 'TERM');
		
		//$juaci2 = $this->input->get("juaci");
		//return $juaci;
		
		$faktorcb = $this->input->post("faktorcb");

		//$hasil = (($juaterm / 1000) * $result['TARIF']) * $faktorcb;
		
		$hasil = (($biayaasuransiperbulantl / 1000) * $juaterm) * $faktorcb;
			
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
			'filepdf' => $filePdf,
			'kodeprospek' => $this->input->post('kodeprospek'),
			
			'namacalontertanggung' => $this->input->post('namacalontertanggung'),
			'jeniskelamincalontertanggung' => $this->input->post('jeniskelamincalontertanggung'),
			'tanggallahircalontertangggung' => $this->input->post('tanggallahircalontertangggung'),
			
			'jenisproduk' => $this->input->post('jenisproduk'),
			'carabayar' => $this->input->post('carabayar'),
			'premisesuaicarabayar' => $this->input->post('premisesuaicarabayar'),
			'juatl1tl2' => $this->input->post('juatl1tl2'),
			'masapemb' => $this->input->post('masapemb'),
			'asumsinilainab' => $this->input->post('asumsinilainab'),
			'topupberkala' => $this->input->post('topupberkala'),
			'topupsekaligus' => $this->input->post('topupsekaligus'),
			'masatopupsekaligus' => $this->input->post('masatopupsekaligus'),
			'saatmulai' => $this->input->post('saatmulai'),
			
			'juatl1tl2' => $this->input->post('juatl1tl2'),
			'juaterm' => $this->input->post('juaterm'),
			'juapa' => $this->input->post('juapa'),
			'juaci' => $this->input->post('juaci'),
			'juactt' => $this->input->post('juactt'),
			'juawp' => $this->input->post('juawp'),
			'juacpm' => $this->input->post('juacpm'),
			'juacpb' => $this->input->post('juacpb'),
			
			'premitambahanterm' => $this->input->post('premitambahanterm'),
			'premitambahanpa' => $this->input->post('premitambahanpa'),
			'premitambahanci' => $this->input->post('premitambahanci'),
			'premitambahanctt' => $this->input->post('premitambahanctt'),
			'premitambahanwp' => $this->input->post('premitambahanwp'),
			'premitambahancpm' => $this->input->post('premitambahancpm'),
			'premitambahancpb' => $this->input->post('premitambahancpb'),
			
			'totalpremisesuaicarabayar' => $this->input->post('totalpremisesuaicarabayar'),
			'kesanggupanbayar' => $this->input->post('kesanggupanbayar')
			
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
		
		$sekarang = date("Y-m-d", strtotime("now"));
		
		$nilaiTunai = $this->ModSimulasi->getNilaiTunai($this->session->userdata('modul'));
		$data['nilaiTunai'] = $nilaiTunai;
		
		$data['hasil']['buildID'] = time();
		
		$tanggalLahirCalonPemegangPolis = date("d", strtotime($this->session->userdata('tgl_lahir')));
		$bulanLahirCalonPemegangPolis = $bulan[date("n", strtotime($this->session->userdata('tgl_lahir')))];
		$tahunLahirCalonPemegangPolis = date("Y", strtotime($this->session->userdata('tgl_lahir')));
		$data['hasil']['tanggallahircalonpemegangpolis'] = $tanggalLahirCalonPemegangPolis.' '.$bulanLahirCalonPemegangPolis.' '.$tahunLahirCalonPemegangPolis;
		
		$tanggalSekarang = date("d", strtotime("now"));
		$bulanSekarang = $bulan[date("n", strtotime("now"))];
		$tahunSekarang = date("Y", strtotime("now"));
		$data['hasil']['tanggalsekarang'] = $tanggalSekarang.' '.$bulanSekarang.' '.$tahunSekarang;
				
		//$data['hasil']['filepdf'] = $filepdf;
		$data['hasil']['nama'] = $this->session->userdata('nama');
		$data['hasil']['namaagen'] = strtoupper(str_replace("-"," ",$this->session->userdata('namaagen')));
		$kodeKantor = $DataAgen['KDKANTOR'];
		$dataKantor = $this->ModSimulasi->cariDataKantor($kodeKantor);
		$data['hasil']['kantorcabang'] = $dataKantor['NAMAKANTOR'];
		$data['hasil']['nomeragen'] = $this->session->userdata('nomeragen');
		
		$data['hasil']['namacalontertanggung'] = $this->session->userdata('namacalontertanggung');
		$data['hasil']['jeniskelamincalontertanggung'] = $this->session->userdata('jeniskelamincalontertanggung');
		$data['hasil']['calontertanggungperokok'] = $this->session->userdata('calontertanggungperokok');
		
		$tanggalLahirCalonTertanggung = date("d", strtotime($this->session->userdata('tanggallahircalontertangggung')));
		$bulanLahirCalonTertanggung = $bulan[date("n", strtotime($this->session->userdata('tanggallahircalontertangggung')))];
		$tahunLahirCalonTertanggung = date("Y", strtotime($this->session->userdata('tanggallahircalontertangggung')));
		$data['hasil']['tanggallahircalontertangggung'] = $tanggalLahirCalonTertanggung.' '.$bulanLahirCalonTertanggung.' '.$tahunLahirCalonTertanggung;
		
		$lahircalontertanggung = date("Y-m-d", strtotime($this->session->userdata('tanggallahircalontertangggung')));
		$selisihcalontertanggung = abs(strtotime($sekarang) - strtotime($lahircalontertanggung));
		$yearscalontertanggung = floor($selisihcalontertanggung/ (365*60*60*24));
		$data['hasil']['usiacalontertanggung'] = $yearscalontertanggung;
		
		$data['hasil']['topupberkala'] = $this->session->userdata('topupberkala');
		$data['hasil']['topupsekaligus'] = $this->session->userdata('topupsekaligus');
		
		$data['hasil']['masatopupsekaligus'] = $this->session->userdata('masatopupsekaligus');
		
		if ($data['hasil']['topupsekaligus'] < 1)
		{
			$data['hasil']['masatopupsekaligus'] = 0;
		}
		
		$data['hasil']['masapemb'] = $this->session->userdata('masapemb');
		
		$tanggalSaatMulai = date("d", strtotime("now"));
		$bulanSaatMulai = $bulan[date("n", strtotime("now"))];
		$tahunSaatMulai = date("Y", strtotime("now"));
		$data['hasil']['saatmulai'] = $tanggalSaatMulai.' '.$bulanSaatMulai.' '.$tahunSaatMulai;
		
		$data['hasil']['jenisproduk'] = $this->session->userdata('jenisproduk');
		if ($data['hasil']['jenisproduk'] == 'JS LINK EQUITY FUND')
		{	
			$kdproduk = 1;
		}
		else if ($data['hasil']['jenisproduk'] == 'JS LINK BALANCED FUND')
		{
			$kdproduk = 2;
		}
		else if ($data['hasil']['jenisproduk'] == 'JS LINK FIXED INCOME')
		{
			$kdproduk = 3;
		}
		
		$detailproduk = $this->ModSimulasi->getDetailProduk($kdproduk);
		$asumsi_inv_min = $detailproduk['ASUMSI_INV_MIN']; 
		$asumsi_inv_med = $detailproduk['ASUMSI_INV_MED'];
		$asumsi_inv_max = $detailproduk['ASUMSI_INV_MAX'];
		$data['hasil']['asumsi_inv_min'] = $asumsi_inv_min;
		$data['hasil']['asumsi_inv_med'] = $asumsi_inv_med;
		$data['hasil']['asumsi_inv_max'] = $asumsi_inv_max;
		
		$data['hasil']['carabayar'] = $this->session->userdata('carabayar');
		$data['hasil']['premisesuaicarabayar'] = $this->session->userdata('premisesuaicarabayar');
		
		if ($data['hasil']['carabayar'] == 'Sekaligus')
		{
			$data['hasil']['carabayar'] = 'Single';
			$data['hasil']['juatl1'] = (($data['hasil']['premisesuaicarabayar'] * 125) / 100);
			$data['hasil']['juatl2'] = (($data['hasil']['premisesuaicarabayar'] * 10) / 100);
			$premitemp= ($data['hasil']['premisesuaicarabayar'] * 1) ;
			$topuptemp = ($data['hasil']['topupberkala'] * 1) ; 
			$UATLI = $data['hasil']['premisesuaicarabayar'] * 125/100;
			$UATL65 = $data['hasil']['premisesuaicarabayar'] * 10/100;
			//$data['hasil']['premisesuaicarabayar'] = $premitemp;
		}
		else if ($data['hasil']['carabayar'] == "Bulanan")
		{
			$premitemp = ($data['hasil']['premisesuaicarabayar'] * 12) ;
			$topuptemp = ($data['hasil']['topupberkala']* 12) ;
			$iPlus = 1;
			$UATLI = $data['hasil']['premisesuaicarabayar'] * 25;
			$UATL65 = $data['hasil']['premisesuaicarabayar'] * 5;
			//$data['hasil']['premisesuaicarabayar'] = $premitemp;
		}
		else if ($data['hasil']['carabayar'] == "Kuartalan")
		{
			$premitemp = ($data['hasil']['premisesuaicarabayar']* 4) ;
			$topuptemp = ($data['hasil']['topupberkala'] * 4) ;
			$iPlus = 3;
			$UATLI = $data['hasil']['premisesuaicarabayar'] * 15;
			$UATL65 = $data['hasil']['premisesuaicarabayar'] * 3;
			//$data['hasil']['premisesuaicarabayar'] = $premitemp;
			
		}
		else if ($data['hasil']['carabayar'] == "Semesteran")
		{
			$premitemp = ($data['hasil']['premisesuaicarabayar'] * 2) ;
			$topuptemp = ($data['hasil']['topupberkala'] * 2) ;
			$iPlus = 12;
			$UATLI = $data['hasil']['premisesuaicarabayar'] * 25;
			$UATL65 = $data['hasil']['premisesuaicarabayar'] * 5;
			//$data['hasil']['premisesuaicarabayar'] = $premitemp;
			
		}
		else if ($data['hasil']['carabayar'] == "Tahunan")
		{
			$premitemp = ($data['hasil']['premisesuaicarabayar'] * 1) ;
			$topuptemp = ($data['hasil']['topupberkala'] * 1) ;
			$iPlus = 12;
			$UATLI = $data['hasil']['premisesuaicarabayar'] * 5;
			$UATL65 = $data['hasil']['premisesuaicarabayar'] * 1;
			//$data['hasil']['premisesuaicarabayar'] = $premitemp;
		}
		
		$data['hasil']['asumsinilainab'] = $this->session->userdata('asumsinilainab');
		
		$lahirnasabah = date("Y-m-d", strtotime($this->session->userdata('tgl_lahir')));
		$selisihnasabah = abs(strtotime($sekarang) - strtotime($lahirnasabah));
		$yearsnasabah = floor($selisihnasabah/ (365*60*60*24));
		$data['hasil']['usianasabah'] = $yearsnasabah;
		
		$data['hasil']['filepdf'] = $this->session->userdata('filepdf');
		$data['hasil']['id_nasabah'] = $this->session->userdata('id_nasabah');
		$data['hasil']['id_agen']	 = $this->session->userdata('id_agen');
		//$data['hasil']['file_pdf']	 = $filePdf.'.pdf',
		$data['hasil']['id_produk']  = $this->session->userdata('id_produk');
		
		$data['hasil']['juatl1tl2']  = $this->session->userdata('juatl1tl2');
		$data['hasil']['juaterm']  = $this->session->userdata('juaterm');
		$data['hasil']['juapa']  = $this->session->userdata('juapa');
		$data['hasil']['juaci']  = $this->session->userdata('juaci');
		$data['hasil']['juactt']  = $this->session->userdata('juactt');
		$data['hasil']['juawp']  = $this->session->userdata('juawp');
		$data['hasil']['juacpm']  = $this->session->userdata('juacpm');
		$data['hasil']['juacpb']  = $this->session->userdata('juacpb');
		
		$data['hasil']['premitambahanterm']  = $this->session->userdata('premitambahanterm');
		$data['hasil']['premitambahanpa']  = $this->session->userdata('premitambahanpa');
		$data['hasil']['premitambahanci']  = $this->session->userdata('premitambahanci');
		$data['hasil']['premitambahanctt']  = $this->session->userdata('premitambahanctt');
		$data['hasil']['premitambahanwp']  = $this->session->userdata('premitambahanwp');
		$data['hasil']['premitambahancpm']  = $this->session->userdata('premitambahancpm');
		$data['hasil']['premitambahancpb']  = $this->session->userdata('premitambahancpb');
		
		$data['hasil']['totalpremisesuaicarabayar']  = $this->session->userdata('totalpremisesuaicarabayar');
		$data['hasil']['usiacalontertanggungtemp'] = $data['hasil']['usiacalontertanggung'] + $data['hasil']['masapemb'];
		
		
		for($i=1;$i<= 65 - $data['hasil']['usiacalontertanggung'];$i++){
		
			$data['hasil']['nilai'][$i]['usia'] = $data['hasil']['usiacalontertanggung']+$i;
			
			
			if ($i == 1)
			{
				$investasi = 30;
			}
			else if ($i == 2)
			{
				$investasi = 40;
			}
			else if ($i == 3)
			{
				$investasi = 60;
			}
			else if ($i == 4)
			{
				$investasi = 70;
			}
			else if ($i == 5)
			{
				$investasi = 90;
			}
			else if ($i > 5)
			{
				$investasi = 93.5;
			}
			
			if ($i < $data['hasil']['masapemb'] + 1)
			{
					$data['hasil']['nilai'][$i]['premiribuandisplay'] = $premitemp / 1000;
					$data['hasil']['nilai'][$i]['topupribuandisplay'] = $topuptemp / 1000;
					$data['hasil']['topupberkala'] = $data['hasil']['topupberkala'];
					$data['hasil']['premisesuaicarabayar'] = $data['hasil']['premisesuaicarabayar'];
					
			}
			else
			{
					$data['hasil']['nilai'][$i]['premiribuandisplay'] = 0;
					$data['hasil']['nilai'][$i]['topupribuandisplay'] = 0;
					//$data['hasil']['topupberkala'] = 0;
					//$data['hasil']['premisesuaicarabayar'] = 0;
			}
			
			if ($i < $data['hasil']['masatopupsekaligus'] + 1)
			{
					$data['hasil']['nilai'][$i]['topupribuandisplay'] = ($topuptemp + $data['hasil']['topupsekaligus']) / 1000;
					$data['hasil']['topupsekaligus'] = $data['hasil']['topupsekaligus'];
			}
			else
			{
					//$data['hasil']['topupsekaligus'] = 0;
					//$data['hasil']['nilai'][$i]['topupribuandisplay'] = $topuptemp / 1000;
			}
			
			$data['hasil']['nilai'][0]['nabxjurendah'] = 0;
			
			if ($i == 1)
			{	
				
				$data['hasil']['nilai'][$i]['nabxjumlahunitrendah'] = (((($investasi / 100) * $data['hasil']['premisesuaicarabayar']) + ((95 / 100) * ($data['hasil']['topupberkala'] + $data['hasil']['topupsekaligus']))) * (1 + ($data['hasil']['asumsi_inv_min'] / 100)));
				$data['hasil']['nilai'][$i]['nabxjumlahunitsedang'] = (((($investasi / 100) * $data['hasil']['premisesuaicarabayar']) + ((95 / 100) * ($data['hasil']['topupberkala'] + $data['hasil']['topupsekaligus']))) * (1 + ($data['hasil']['asumsi_inv_med'] / 100)));
				$data['hasil']['nilai'][$i]['nabxjumlahunittinggi'] = (((($investasi / 100) * $data['hasil']['premisesuaicarabayar']) + ((95 / 100) * ($data['hasil']['topupberkala'] + $data['hasil']['topupsekaligus']))) * (1 + ($data['hasil']['asumsi_inv_max'] / 100)));
								
				/*
				KOMEN DULU YA
				//$data['hasil']['nilai'][$i]['nabxjurendah'] = (((($investasi / 100) * $data['hasil']['premisesuaicarabayar']) + ((95 / 100) * ($data['hasil']['topupberkala'] + $data['hasil']['topupsekaligus']))) * (1 + ($data['hasil']['asumsi_inv_min'] / (12 / $iPlus * 100))));
				$data['hasil']['nilai'][$i]['nabxjumlahunitrendah'] = (((($investasi / 100) * $data['hasil']['premisesuaicarabayar']) + ((95 / 100) * ($data['hasil']['topupberkala'] + $data['hasil']['topupsekaligus']))) * (1 + ($data['hasil']['asumsi_inv_min'] / 100)));
				$data['hasil']['nilai'][$i]['nabxjumlahunitsedang'] = (((($investasi / 100) * $data['hasil']['premisesuaicarabayar']) + ((95 / 100) * ($data['hasil']['topupberkala'] + $data['hasil']['topupsekaligus']))) * (1 + ($data['hasil']['asumsi_inv_med'] / 100)));
				$data['hasil']['nilai'][$i]['nabxjumlahunittinggi'] = (((($investasi / 100) * $data['hasil']['premisesuaicarabayar']) + ((95 / 100) * ($data['hasil']['topupberkala'] + $data['hasil']['topupsekaligus']))) * (1 + ($data['hasil']['asumsi_inv_max'] / 100)));
				
				//$data['hasil']['nilai'][$i]['nabxjumlahunitrendah'] = ($data['hasil']['nilai'][$i]['nabxjurendah']+((($investasi / 100) * $data['hasil']['premisesuaicarabayar']) + ((95 / 100) * ($data['hasil']['topupberkala'] + $data['hasil']['topupsekaligus']))) * (1 + ($data['hasil']['asumsi_inv_min'] / (12 / $iPlus * 100))));
				$data['hasil']['nilai'][$i]['nabxjumlahunitrendah'] = (((($investasi / 100) * $data['hasil']['premisesuaicarabayar']) + ((95 / 100) * ($data['hasil']['topupberkala'] + $data['hasil']['topupsekaligus']))) * (1 + ($data['hasil']['asumsi_inv_min'] / 100)));
				$data['hasil']['nilai'][$i]['nabxjumlahunitsedang'] = (((($investasi / 100) * $data['hasil']['premisesuaicarabayar']) + ((95 / 100) * ($data['hasil']['topupberkala'] + $data['hasil']['topupsekaligus']))) * (1 + ($data['hasil']['asumsi_inv_med'] / 100)));
				$data['hasil']['nilai'][$i]['nabxjumlahunittinggi'] = (((($investasi / 100) * $data['hasil']['premisesuaicarabayar']) + ((95 / 100) * ($data['hasil']['topupberkala'] + $data['hasil']['topupsekaligus']))) * (1 + ($data['hasil']['asumsi_inv_max'] / 100)));
				*/
			}
			else
			{	
				
				$data['hasil']['nilai'][$i]['nabxjumlahunitrendah'] = (((($data['hasil']['nilai'][$i-1]['nabxjumlahunitrendah'] + (($investasi / 100)) * $data['hasil']['premisesuaicarabayar'])) + ((95 / 100) * ($data['hasil']['topupberkala'] + $data['hasil']['topupsekaligus']))) * (1 + ($data['hasil']['asumsi_inv_min'] / 100)));
				$data['hasil']['nilai'][$i]['nabxjumlahunitsedang'] = (((($data['hasil']['nilai'][$i-1]['nabxjumlahunitsedang'] + (($investasi / 100)) * $data['hasil']['premisesuaicarabayar'])) + ((95 / 100) * ($data['hasil']['topupberkala'] + $data['hasil']['topupsekaligus']))) * (1 + ($data['hasil']['asumsi_inv_med'] / 100)));
				$data['hasil']['nilai'][$i]['nabxjumlahunittinggi'] = (((($data['hasil']['nilai'][$i-1]['nabxjumlahunittinggi'] + (($investasi / 100)) * $data['hasil']['premisesuaicarabayar'])) + ((95 / 100) * ($data['hasil']['topupberkala'] + $data['hasil']['topupsekaligus']))) * (1 + ($data['hasil']['asumsi_inv_max'] / 100)));
				
				/*
				KOMEN DULU YA
				///$data['hasil']['nilai'][$i]['nabxjurendah'] = (((($investasi / 100) * $data['hasil']['premisesuaicarabayar']) + ((95 / 100) * ($data['hasil']['topupberkala'] + $data['hasil']['topupsekaligus']))) * (1 + ($data['hasil']['asumsi_inv_min'] / (12 / $iPlus * 100))));
				$data['hasil']['nilai'][$i]['nabxjumlahunitrendah'] = (((($investasi / 100) * $data['hasil']['premisesuaicarabayar']) + ((95 / 100) * ($data['hasil']['topupberkala'] + $data['hasil']['topupsekaligus']))) * (1 + ($data['hasil']['asumsi_inv_min'] / 100)));
				$data['hasil']['nilai'][$i]['nabxjumlahunitsedang'] = (((($investasi / 100) * $data['hasil']['premisesuaicarabayar']) + ((95 / 100) * ($data['hasil']['topupberkala'] + $data['hasil']['topupsekaligus']))) * (1 + ($data['hasil']['asumsi_inv_med'] / 100)));
				$data['hasil']['nilai'][$i]['nabxjumlahunittinggi'] = (((($investasi / 100) * $data['hasil']['premisesuaicarabayar']) + ((95 / 100) * ($data['hasil']['topupberkala'] + $data['hasil']['topupsekaligus']))) * (1 + ($data['hasil']['asumsi_inv_max'] / 100)));
				
				//$data['hasil']['nilai'][$i]['nabxjumlahunitrendah'] = ($data['hasil']['nilai'][$i-1]['nabxjurendah']+((($data['hasil']['nilai'][$i-1]['nabxjumlahunitrendah'] + (($investasi / 100)) * $data['hasil']['premisesuaicarabayar'])) + ((95 / 100) * ($data['hasil']['topupberkala'] + $data['hasil']['topupsekaligus']))) * (1 + ($data['hasil']['asumsi_inv_min'] / 100)));
				$data['hasil']['nilai'][$i]['nabxjumlahunitrendah'] = (((($data['hasil']['nilai'][$i-1]['nabxjumlahunitsedang'] + (($investasi / 100)) * $data['hasil']['premisesuaicarabayar'])) + ((95 / 100) * ($data['hasil']['topupberkala'] + $data['hasil']['topupsekaligus']))) * (1 + ($data['hasil']['asumsi_inv_min'] / 100)));
				$data['hasil']['nilai'][$i]['nabxjumlahunitsedang'] = (((($data['hasil']['nilai'][$i-1]['nabxjumlahunitsedang'] + (($investasi / 100)) * $data['hasil']['premisesuaicarabayar'])) + ((95 / 100) * ($data['hasil']['topupberkala'] + $data['hasil']['topupsekaligus']))) * (1 + ($data['hasil']['asumsi_inv_med'] / 100)));
				$data['hasil']['nilai'][$i]['nabxjumlahunittinggi'] = (((($data['hasil']['nilai'][$i-1]['nabxjumlahunittinggi'] + (($investasi / 100)) * $data['hasil']['premisesuaicarabayar'])) + ((95 / 100) * ($data['hasil']['topupberkala'] + $data['hasil']['topupsekaligus']))) * (1 + ($data['hasil']['asumsi_inv_max'] / 100)));
				*/
			}
			
		}
		
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

		$data['hitung'] = array(
			'ID_HIT' => $data['idHit'],
			'BUILD_ID' => time(),
			'ID_AGEN' => $idAgen,
			'FILE_PDF' => $this->session->userdata('filepdf').'.pdf',
			'ID_PRODUK' => $this->session->userdata('id_produk'),
			'SESSION_ID' => $this->session->userdata('session_id'),
			'NO_PROSPEK' => $NoProspek,
			'CARA_BAYAR' => $this->session->userdata('carabayar'),
			'JUMLAH_PREMI' => $data['hasil']['premisesuaicarabayar'],
			'TOP_UP'=> $data['hasil']['topupsekaligus'] 
		);
		
		$this->ModSimulasi->insertSimulasi($data['hitung']);
		
		$data['hasil']['build_id'] = $data['hitung']['BUILD_ID'];
			
		$filePdf = $this->session->userdata('filepdf');
		
		$this->createPDF($filePdf,$data);
		
		$this->load->view('hasil/jl3',$data);
		
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
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(190,5,'ILUSTRASI PRODUK '.$data['hasil']['jenisproduk'].'','B',0,'L');
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->ln(10);
		
		// CALON TERTANGGUNG
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'CALON TERTANGGUNG',1,0,'L', true);
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,3,'Nama Calon',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,3,''.$data['hasil']['namacalontertanggung'].' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,3,'Tanggal Lahir / Usia Calon',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,3,''.$data['hasil']['tanggallahircalontertangggung'].' / '.$data['hasil']['usiacalontertanggung'].' tahun',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,3,'Top Up Berkala',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,3,'Rp. '.number_format($data['hasil']['topupberkala'],0,'.',',').' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,3,'Top Up Sekaligus',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,3,'Rp. '.number_format($data['hasil']['topupsekaligus'],0,'.',',').' selama '.$data['hasil']['masatopupsekaligus'].' tahun',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,3,'Tgl Dibuat',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,3,''.$data['hasil']['saatmulai'].'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,3,'Jenis Produk',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,3,''.$data['hasil']['jenisproduk'].'',0,0,'L');
		$this->pdf->Cell(100,3,'Asumsi tingkat hasil investasi yang digunakan adalah sebagai berikut',0,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,3,'Cara Bayar Berkala',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,3,''.$data['hasil']['carabayar'].'',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(40,3,'Dana Investasi',1,0,'C', true);
		$this->pdf->Cell(20,3,'Rendah',1,0,'C', true);
		$this->pdf->Cell(20,3,'Sedang',1,0,'C', true);
		$this->pdf->Cell(20,3,'Tinggi',1,0,'C', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,3,'Nilai Aktiva Bersih (NAB) Awal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,3,''.number_format($data['hasil']['asumsinilainab'], 2, ',', '.').'',0,0,'L');
		$this->pdf->Cell(40,3,''.$data['hasil']['jenisproduk'].'',1,0,'C');
		$this->pdf->Cell(20,3,''.$data['hasil']['asumsi_inv_min'].' %',1,0,'C');
		$this->pdf->Cell(20,3,''.$data['hasil']['asumsi_inv_med'].' %',1,0,'C');
		$this->pdf->Cell(20,3,''.$data['hasil']['asumsi_inv_max'].' %',1,0,'C');
		$this->pdf->ln(10);
		
		// RIDER
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(47.5,3,'Manfaat Asuransi','LTR',0,'C', true);
		$this->pdf->Cell(47.5,3,'Jangka Waktu','LTR',0,'C', true);
		$this->pdf->Cell(47.5,3,'Uang Asuransi','LTR',0,'C', true);
		
		if ($data['hasil']['carabayar'] != "Single")
		{
			$this->pdf->Cell(47.5,3,'Biaya Asuransi','LTR',0,'C', true);
			$this->pdf->ln();
			$this->pdf->Cell(47.5,3,'','LBR',0,'C', true);
			$this->pdf->Cell(47.5,3,'(sampai dengan)','LBR',0,'C', true);
			$this->pdf->Cell(47.5,3,'','LBR',0,'C', true);
			$this->pdf->Cell(47.5,3,'','LBR',0,'C', true);
		}
		$this->pdf->ln();
		if ($data['hasil']['carabayar'] == "Single")
		{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,3,'JS TL1',1,0,'C');
			$this->pdf->Cell(47.5,3,'Usia Tertanggung 65 tahun',1,0,'C');
			$this->pdf->Cell(47.5,3,'Rp. '.number_format($data['hasil']['juatl1'], 2, ',', '.').'',1,0,'C');
			if ($data['hasil']['carabayar'] != "Single")
			{
				$this->pdf->Cell(47.5,3,'',1,0,'C');
			}
			$this->pdf->ln();
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,3,'JS TL2',1,0,'C');
			$this->pdf->Cell(47.5,3,'Usia Tertanggung 65 tahun',1,0,'C');
			$this->pdf->Cell(47.5,3,'Rp. '.number_format($data['hasil']['juatl2'], 2, ',', '.').'',1,0,'C');
			if ($data['hasil']['carabayar'] != "Single")
			{
				$this->pdf->Cell(47.5,3,'',1,0,'C');
			}
			$this->pdf->ln(10);
		}
		else
		{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,3,'Produk Pokok TL (1+2)',1,0,'C');
			$this->pdf->Cell(47.5,3,'Usia Tertanggung '.$data['hasil']['usiacalontertanggungtemp'].' tahun',1,0,'C');
			$this->pdf->Cell(47.5,3,'Rp. '.number_format($data['hasil']['juatl1tl2'], 2, ',', '.').'',1,0,'C');
			$this->pdf->Cell(47.5,3,'Rp. '.number_format($data['hasil']['premisesuaicarabayar'], 2, ',', '.').'',1,0,'C');
			$this->pdf->ln();
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,3,'Term',1,0,'C');
			$this->pdf->Cell(47.5,3,'Usia Tertanggung '.$data['hasil']['usiacalontertanggungtemp'].' tahun',1,0,'C');
			$this->pdf->Cell(47.5,3,'Rp. '.number_format($data['hasil']['juaterm'], 2, ',', '.').'',1,0,'C');
			$this->pdf->Cell(47.5,3,'Rp. '.number_format($data['hasil']['premitambahanterm'], 2, ',', '.').' **)',1,0,'C');
			$this->pdf->ln();
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,3,'Personal Accident',1,0,'C');
			$this->pdf->Cell(47.5,3,'Usia Tertanggung '.$data['hasil']['usiacalontertanggungtemp'].' tahun',1,0,'C');
			$this->pdf->Cell(47.5,3,'Rp. '.number_format($data['hasil']['juapa'], 2, ',', '.').'',1,0,'C');
			$this->pdf->Cell(47.5,3,'Rp. '.number_format($data['hasil']['premitambahanpa'], 2, ',', '.').' **)',1,0,'C');
			$this->pdf->ln();
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,3,'Critical Ilness',1,0,'C');
			$this->pdf->Cell(47.5,3,'Usia Tertanggung '.$data['hasil']['usiacalontertanggungtemp'].' tahun',1,0,'C');
			$this->pdf->Cell(47.5,3,'Rp. '.number_format($data['hasil']['juaci'], 2, ',', '.').'',1,0,'C');
			$this->pdf->Cell(47.5,3,'Rp. '.number_format($data['hasil']['premitambahanci'], 2, ',', '.').' **)',1,0,'C');
			$this->pdf->ln();
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,3,'Total Permanent Disability',1,0,'C');
			$this->pdf->Cell(47.5,3,'Usia Tertanggung '.$data['hasil']['usiacalontertanggungtemp'].' tahun',1,0,'C');
			$this->pdf->Cell(47.5,3,'Rp. '.number_format($data['hasil']['juactt'], 2, ',', '.').'',1,0,'C');
			$this->pdf->Cell(47.5,3,'Rp. '.number_format($data['hasil']['premitambahanctt'], 2, ',', '.').' **)',1,0,'C');
			$this->pdf->ln();
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,3,'Waiver Premium',1,0,'C');
			$this->pdf->Cell(47.5,3,'Usia Tertanggung '.$data['hasil']['usiacalontertanggungtemp'].' tahun',1,0,'C');
			$this->pdf->Cell(47.5,3,'Rp. '.number_format($data['hasil']['juawp'], 2, ',', '.').'',1,0,'C');
			$this->pdf->Cell(47.5,3,'Rp. '.number_format($data['hasil']['premitambahanwp'], 2, ',', '.').' **)',1,0,'C');
			$this->pdf->ln();
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,3,'Cash Plan',1,0,'C');
			$this->pdf->Cell(47.5,3,'Usia Tertanggung '.$data['hasil']['usiacalontertanggungtemp'].' tahun',1,0,'C');
			$this->pdf->Cell(47.5,3,'Rp. '.number_format($data['hasil']['juacpm'], 2, ',', '.').'',1,0,'C');
			$this->pdf->Cell(47.5,3,'Rp. '.number_format($data['hasil']['premitambahancpm'], 2, ',', '.').' **)',1,0,'C');
			$this->pdf->ln();
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(47.5,3,'Cash Plan Bedah',1,0,'C');
			$this->pdf->Cell(47.5,3,'Usia Tertanggung '.$data['hasil']['usiacalontertanggungtemp'].' tahun',1,0,'C');
			$this->pdf->Cell(47.5,3,'Rp. '.number_format($data['hasil']['juacpb'], 2, ',', '.').'',1,0,'C');
			$this->pdf->Cell(47.5,3,'Rp. '.number_format($data['hasil']['premitambahancpb'], 2, ',', '.').' **)',1,0,'C');
			$this->pdf->ln(6);
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(190,3,' **) Adalah Premi '.strtolower($data['hasil']['carabayar']).' tahun pertama, dimana besar premi tahun berikutnya akan menyesuaikan kenaikan usia tertanggung.',0,0,'C');
			$this->pdf->ln(6);
		}
		
		// ILUSTRASI PLAN POKOK DAN PERKEMBANGAN DANA
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(190,5,'ILUSTRASI PLAN POKOK DAN PERKEMBANGAN DANA','LTR',0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,''.$data['hasil']['jenisproduk'].'','LBR',0,'C');
		$this->pdf->ln(8);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,3,'Jumlah Premi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,3,'Rp. '.number_format($data['hasil']['totalpremisesuaicarabayar'], 2, ',', '.').'',0,0,'L');
		$this->pdf->ln(6);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(10,3,'Akhir','LTR',0,'C', true);
		$this->pdf->Cell(10,3,'Usia','LTR',0,'C', true);
		$this->pdf->Cell(18.88,3,'Premi','LTR',0,'C', true);
		$this->pdf->Cell(18.88,3,'Top-Up','LTR',0,'C', true);
		$this->pdf->Cell(18.88,3,'Dana','LTR',0,'C', true);
		$this->pdf->Cell(18.88,3,'','LTR',0,'C', true);
		$this->pdf->Cell(18.88,3,'Manfaat','T',0,'C', true);
		$this->pdf->Cell(18.88,3,'','TR',0,'C', true);
		$this->pdf->Cell(18.88,3,'','LTR',0,'C', true);
		$this->pdf->Cell(18.88,3,'(NAB x','T',0,'C', true);
		$this->pdf->Cell(18.88,3,'','TR',0,'C', true);
		$this->pdf->ln();
		$this->pdf->Cell(10,3,'Tahun','LR',0,'C', true);
		$this->pdf->Cell(10,3,'','LR',0,'C', true);
		$this->pdf->Cell(18.88,3,'(Ribuan)','LR',0,'C', true);
		$this->pdf->Cell(18.88,3,'(Ribuan)','LR',0,'C', true);
		$this->pdf->Cell(18.88,3,'Pendidikan','LR',0,'C', true);
		$this->pdf->Cell(18.88,3,'','LR',0,'C', true);
		$this->pdf->Cell(18.88,3,'Meninggal','',0,'C', true);
		$this->pdf->Cell(18.88,3,'','R',0,'C', true);
		$this->pdf->Cell(18.88,3,'','LR',0,'C', true);
		$this->pdf->Cell(18.88,3,'Jumlah','',0,'C', true);
		$this->pdf->Cell(18.88,3,'','R',0,'C', true);
		$this->pdf->ln();
		$this->pdf->Cell(10,3,'Ke-','LR',0,'C', true);
		$this->pdf->Cell(10,3,'','LR',0,'C', true);
		$this->pdf->Cell(18.88,3,'','LR',0,'C', true);
		$this->pdf->Cell(18.88,3,'','LR',0,'C', true);
		$this->pdf->Cell(18.88,3,'(Ribuan)','LR',0,'C', true);
		$this->pdf->Cell(18.88,3,'','LR',0,'C', true);
		$this->pdf->Cell(18.88,3,'Dunia *)','',0,'C', true);
		$this->pdf->Cell(18.88,3,'','R',0,'C', true);
		$this->pdf->Cell(18.88,3,'','LR',0,'C', true);
		$this->pdf->Cell(18.88,3,'Unit)','',0,'C', true);
		$this->pdf->Cell(18.88,3,'','R',0,'C', true);
		$this->pdf->ln();
		$this->pdf->Cell(10,3,'','LR',0,'C', true);
		$this->pdf->Cell(10,3,'','LR',0,'C', true);
		$this->pdf->Cell(18.88,3,'','LR',0,'C', true);
		$this->pdf->Cell(18.88,3,'','LR',0,'C', true);
		$this->pdf->Cell(18.88,3,'','LR',0,'C', true);
		$this->pdf->Cell(18.88,3,'Rendah','LTR',0,'C', true);
		$this->pdf->Cell(18.88,3,'Sedang','LTR',0,'C', true);
		$this->pdf->Cell(18.88,3,'Tinggi','LTR',0,'C', true);
		$this->pdf->Cell(18.88,3,'Rendah','LTR',0,'C', true);
		$this->pdf->Cell(18.88,3,'Sedang','LTR',0,'C', true);
		$this->pdf->Cell(18.88,3,'Tinggi','LTR',0,'C', true);
		$this->pdf->ln();
		$this->pdf->Cell(10,3,'','LBR',0,'C', true);
		$this->pdf->Cell(10,3,'','LBR',0,'C', true);
		$this->pdf->Cell(18.88,3,'','LBR',0,'C', true);
		$this->pdf->Cell(18.88,3,'','LBR',0,'C', true);
		$this->pdf->Cell(18.88,3,'','LBR',0,'C', true);
		$this->pdf->Cell(18.88,3,'(Ribuan)','LBR',0,'C', true);
		$this->pdf->Cell(18.88,3,'(Ribuan)','LBR',0,'C', true);
		$this->pdf->Cell(18.88,3,'(Ribuan)','LBR',0,'C', true);
		$this->pdf->Cell(18.88,3,'(Ribuan)','LBR',0,'C', true);
		$this->pdf->Cell(18.88,3,'(Ribuan)','LBR',0,'C', true);
		$this->pdf->Cell(18.88,3,'(Ribuan)','LBR',0,'C', true);
		$this->pdf->ln();
		for($i=1;$i<=20;$i++){
			$this->pdf->Cell(10,3,' '.$i.' ','LBR',0,'C');
			$this->pdf->Cell(10,3,$data['hasil']['nilai'][$i]['usia'],'LBR',0,'C');
			$this->pdf->Cell(18.88,3,number_format($data['hasil']['nilai'][$i]['premiribuandisplay'], 0, ',', '.'),'LBR',0,'C');
			$this->pdf->Cell(18.88,3,number_format($data['hasil']['nilai'][$i]['topupribuandisplay'], 0, ',', '.'),'LBR',0,'C');
			$this->pdf->Cell(18.88,3,'','LBR',0,'C');
			$this->pdf->Cell(18.88,3,number_format(($data['hasil']['nilai'][$i]['nabxjumlahunitrendah'] / 1000 + $data['hasil']['juatl1tl2'] / 1000), 0, ',', '.'),'LBR',0,'C');
			$this->pdf->Cell(18.88,3,number_format(($data['hasil']['nilai'][$i]['nabxjumlahunitsedang'] / 1000 + $data['hasil']['juatl1tl2'] / 1000), 0, ',', '.'),'LBR',0,'C');
			$this->pdf->Cell(18.88,3,number_format(($data['hasil']['nilai'][$i]['nabxjumlahunittinggi'] / 1000 + $data['hasil']['juatl1tl2'] / 1000), 0, ',', '.'),'LBR',0,'C');
			$this->pdf->Cell(18.88,3,number_format($data['hasil']['nilai'][$i]['nabxjumlahunitrendah'] / 1000, 0, ',', '.'),'LBR',0,'C');
			$this->pdf->Cell(18.88,3,number_format($data['hasil']['nilai'][$i]['nabxjumlahunitsedang'] / 1000, 0, ',', '.'),'LBR',0,'C');
			$this->pdf->Cell(18.88,3,number_format($data['hasil']['nilai'][$i]['nabxjumlahunittinggi'] / 1000, 0, ',', '.'),'LBR',0,'C');
			$this->pdf->ln();
		}
		for($i=35;$i<=35;$i++){
			$this->pdf->SetFont('Arial','B',6);
			$this->pdf->Cell(10,3,' '.$i.' ','LBR',0,'C', true);
			$this->pdf->Cell(10,3,$data['hasil']['nilai'][$i]['usia'],'LBR',0,'C', true);
			$this->pdf->Cell(18.88,3,number_format($data['hasil']['nilai'][$i]['premiribuandisplay'], 0, ',', '.'),'LBR',0,'C', true);
			$this->pdf->Cell(18.88,3,number_format($data['hasil']['nilai'][$i]['topupribuandisplay'], 0, ',', '.'),'LBR',0,'C', true);
			$this->pdf->Cell(18.88,3,'','LBR',0,'C', true);
			$this->pdf->Cell(18.88,3,number_format(((($data['hasil']['nilai'][20]['nabxjumlahunitrendah'] / 1000) * pow((1+$data['hasil']['asumsi_inv_min'] / 100), 15)) + $data['hasil']['juatl1tl2'] / 1000), 0, ',', '.'),'LBR',0,'C', true);
			$this->pdf->Cell(18.88,3,number_format(((($data['hasil']['nilai'][20]['nabxjumlahunitsedang'] / 1000) * pow((1+$data['hasil']['asumsi_inv_med'] / 100), 15)) + $data['hasil']['juatl1tl2'] / 1000), 0, ',', '.'),'LBR',0,'C', true);
			$this->pdf->Cell(18.88,3,number_format(((($data['hasil']['nilai'][20]['nabxjumlahunittinggi'] / 1000) * pow((1+$data['hasil']['asumsi_inv_max'] / 100), 15)) + $data['hasil']['juatl1tl2'] / 1000), 0, ',', '.'),'LBR',0,'C', true);
			$this->pdf->Cell(18.88,3,number_format(((($data['hasil']['nilai'][20]['nabxjumlahunitrendah'] / 1000) * pow((1+$data['hasil']['asumsi_inv_min'] / 100), 15))), 0, ',', '.'),'LBR',0,'C', true);
			$this->pdf->Cell(18.88,3,number_format(((($data['hasil']['nilai'][20]['nabxjumlahunitsedang'] / 1000) * pow((1+$data['hasil']['asumsi_inv_med'] / 100), 15))), 0, ',', '.'),'LBR',0,'C', true);
			$this->pdf->Cell(18.88,3,number_format(((($data['hasil']['nilai'][20]['nabxjumlahunittinggi'] / 1000) * pow((1+$data['hasil']['asumsi_inv_max'] / 100), 15))), 0, ',', '.'),'LBR',0,'C', true);
			$this->pdf->ln();
		}
		$this->pdf->ln();
		
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
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(190,5,'ILUSTRASI PRODUK '.$data['hasil']['jenisproduk'].'','B',0,'L');
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->ln(8);
		
		// Data Kenaikan NAB Selama 5 tahun Sejak Emisi
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'DATA KENAIKAN NAB SELAMA 5 TAHUN SEJAK EMISI',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->ln(6);
		$this->pdf->Cell(40,3,'Produk','LTR',0,'C', true);
		$this->pdf->Cell(150,3,'Kinerja (Per 30 Desember 2014)','LTR',0,'C', true);
		$this->pdf->ln();
		$this->pdf->Cell(40,3,'','LBR',0,'C', true);
		$this->pdf->Cell(18.75,3,'Since Incept',1,0,'C', true);
		$this->pdf->Cell(18.75,3,'2009',1,0,'C', true);
		$this->pdf->Cell(18.75,3,'2010',1,0,'C', true);
		$this->pdf->Cell(18.75,3,'2011',1,0,'C', true);
		$this->pdf->Cell(18.75,3,'2012',1,0,'C', true);
		$this->pdf->Cell(18.75,3,'2013',1,0,'C', true);
		$this->pdf->Cell(18.75,3,'2014',1,0,'C', true);
		$this->pdf->Cell(18.75,3,'2015',1,0,'C', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(40,3,'JS Link Fixed Income',1,0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(18.75,3,'36.06%',1,0,'C');
		$this->pdf->Cell(18.75,3,'9.54%',1,0,'C');
		$this->pdf->Cell(18.75,3,'9.25%',1,0,'C');
		$this->pdf->Cell(18.75,3,'5.94%',1,0,'C');
		$this->pdf->Cell(18.75,3,'5.19%',1,0,'C');
		$this->pdf->Cell(18.75,3,'-9.18%',1,0,'C');
		$this->pdf->Cell(18.75,3,'9.25%',1,0,'C');
		$this->pdf->Cell(18.75,3,'1.63%',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(40,3,'JS Balanced Fund',1,0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(18.75,3,'98.59%',1,0,'C');
		$this->pdf->Cell(18.75,3,'20.51%',1,0,'C');
		$this->pdf->Cell(18.75,3,'22.03%',1,0,'C');
		$this->pdf->Cell(18.75,3,'4.32%',1,0,'C');
		$this->pdf->Cell(18.75,3,'9.09%',1,0,'C');
		$this->pdf->Cell(18.75,3,'-1.14%',1,0,'C');
		$this->pdf->Cell(18.75,3,'16.28%',1,0,'C');
		$this->pdf->Cell(18.75,3,'6.09%',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(40,3,'JS Equity Fund',1,0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(18.75,3,'128.21%',1,0,'C');
		$this->pdf->Cell(18.75,3,'34.70%',1,0,'C');
		$this->pdf->Cell(18.75,3,'28.97%',1,0,'C');
		$this->pdf->Cell(18.75,3,'1.21%',1,0,'C');
		$this->pdf->Cell(18.75,3,'10.30%',1,0,'C');
		$this->pdf->Cell(18.75,3,'-6.85%',1,0,'C');
		$this->pdf->Cell(18.75,3,'23.81%',1,0,'C');
		$this->pdf->Cell(18.75,3,'4.45%',1,0,'C');
		/*$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(40,3,'JS Link Pasar Uang',1,0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(21.42857142857143,3,'3.92%',1,0,'C');
		$this->pdf->Cell(21.42857142857143,3,'n/a',1,0,'C');
		$this->pdf->Cell(21.42857142857143,3,'n/a',1,0,'C');
		$this->pdf->Cell(21.42857142857143,3,'n/a',1,0,'C');
		$this->pdf->Cell(21.42857142857143,3,'n/a',1,0,'C');
		$this->pdf->Cell(21.42857142857143,3,'n/a',1,0,'C');
		$this->pdf->Cell(21.42857142857143,3,'n/a',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(40,3,'JS Link Pendapatan Tetap',1,0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(21.42857142857143,3,'3.54%',1,0,'C');
		$this->pdf->Cell(21.42857142857143,3,'n/a',1,0,'C');
		$this->pdf->Cell(21.42857142857143,3,'n/a',1,0,'C');
		$this->pdf->Cell(21.42857142857143,3,'n/a',1,0,'C');
		$this->pdf->Cell(21.42857142857143,3,'n/a',1,0,'C');
		$this->pdf->Cell(21.42857142857143,3,'n/a',1,0,'C');
		$this->pdf->Cell(21.42857142857143,3,'n/a',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(40,3,'JS Link Berimbang',1,0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(21.42857142857143,3,'9.03%',1,0,'C');
		$this->pdf->Cell(21.42857142857143,3,'n/a',1,0,'C');
		$this->pdf->Cell(21.42857142857143,3,'n/a',1,0,'C');
		$this->pdf->Cell(21.42857142857143,3,'n/a',1,0,'C');
		$this->pdf->Cell(21.42857142857143,3,'n/a',1,0,'C');
		$this->pdf->Cell(21.42857142857143,3,'n/a',1,0,'C');
		$this->pdf->Cell(21.42857142857143,3,'n/a',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(40,3,'JS Link Ekuitas',1,0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(21.42857142857143,3,'10.22%',1,0,'C');
		$this->pdf->Cell(21.42857142857143,3,'n/a',1,0,'C');
		$this->pdf->Cell(21.42857142857143,3,'n/a',1,0,'C');
		$this->pdf->Cell(21.42857142857143,3,'n/a',1,0,'C');
		$this->pdf->Cell(21.42857142857143,3,'n/a',1,0,'C');
		$this->pdf->Cell(21.42857142857143,3,'n/a',1,0,'C');
		$this->pdf->Cell(21.42857142857143,3,'n/a',1,0,'C');
		*/
		$this->pdf->ln(5);
		
		// CATATAN PENTING
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(1.5);
		$this->pdf->Cell(188.5,5,'CATATAN PENTING',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(1.5);
		$this->pdf->Cell(188.5,3,'1.	Alokasi Premi Plan Pokok yang dibentuk ke dalam unit.',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(5);
		$this->pdf->Cell(1.5);
		$this->pdf->Cell(25,3,'Deskripsi',1,0,'C', true);
		$this->pdf->Cell(25,3,'Tahun 1',1,0,'C', true);
		$this->pdf->Cell(25,3,'Tahun 2',1,0,'C', true);
		$this->pdf->Cell(25,3,'Tahun 3',1,0,'C', true);
		$this->pdf->Cell(25,3,'Tahun 4',1,0,'C', true);
		$this->pdf->Cell(25,3,'Tahun 5',1,0,'C', true);
		$this->pdf->Cell(25,3,'Tahun 6 dst',1,0,'C', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5);
		$this->pdf->Cell(1.5);
		$this->pdf->Cell(25,3,'Investasi',1,0,'C');
		$this->pdf->Cell(25,3,'30%',1,0,'C');
		$this->pdf->Cell(25,3,'40%',1,0,'C');
		$this->pdf->Cell(25,3,'60%',1,0,'C');
		$this->pdf->Cell(25,3,'70%',1,0,'C');
		$this->pdf->Cell(25,3,'90%',1,0,'C');
		$this->pdf->Cell(25,3,'93.5%',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5);
		$this->pdf->Cell(1.5);
		$this->pdf->Cell(25,3,'Biaya',1,0,'C');
		$this->pdf->Cell(25,3,'70%',1,0,'C');
		$this->pdf->Cell(25,3,'60%',1,0,'C');
		$this->pdf->Cell(25,3,'40%',1,0,'C');
		$this->pdf->Cell(25,3,'30%',1,0,'C');
		$this->pdf->Cell(25,3,'10%',1,0,'C');
		$this->pdf->Cell(25,3,'6.5%',1,0,'C');
		$this->pdf->ln(5);
		$this->pdf->Cell(1.5);
		$this->pdf->Cell(188.5,3,'2.	Ilustrasi manfaat di atas sudah diperhitungkan dengan: ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->Cell(190,3,'a.	Biaya administrasi selama berlakunya asuransi dengan besaran untuk tahun I: 2%, tahun II: 1,64%, tahun III: 1%, tahun IV: 1%, dan seterusnya',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->Cell(190,3,'				sebesar 0,09% x Premi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->Cell(190,3,'b.	Biaya Asuransi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->Cell(190,3,'c.	Biaya Top Up Premi Berkala 5% x Top Up Premi Berkala.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->Cell(190,3,'d.	Biaya Top Up Premi Tunggal 5% x Top Up Premi Tunggal.',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->Cell(1.5);
		$this->pdf->Cell(188.5,3,'3.	Biaya Pengelolaan Investasi sebesar 1,75% x Total dana Investasi setiap Tahun.',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->Cell(1.5);
		$this->pdf->Cell(188.5,3,'4.	Uang Asuransi dan Jaminan Tambahan (jika ada) adalah sejumlah uang yang tercantum di dalam Polis yang akan dibayar oleh Penanggung apabila',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(1.5);
		$this->pdf->Cell(188.5,3,'				syarat-syarat dan ketentuan pembayaran sebagaimana tercantum dalam Polis telah dipenuhi.',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->Cell(1.5);
		$this->pdf->Cell(188.5,3,'5.	Nilai Tunai adalah Nilai Saldo Unit yang dihitung berdasarkan Harga Unit pada suatu saat tertentu. ',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->Cell(1.5);
		$this->pdf->Cell(188.5,3,'6.	Asumsi tinggi rendahnya hasil investasi ini hanya bertujuan untuk ilustrasi saja dan bukan merupakan tolak ukur untuk perhitungan rata-rata tingkat ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(1.5);
		$this->pdf->Cell(188.5,3,'				hasil investasi yang terendah dan tertinggi. Kinerja Investasi tidak dijamin, tergantung dari risiko masing-masing instrument investasi. Pemegang',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(1.5);
		$this->pdf->Cell(188.5,3,'				Polis diberi keleluasaan untuk menempatkan alokasi dana investasi yang memungkinkan optimalisasi tingkat pengembalian investasi, sesuai',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(1.5);
		$this->pdf->Cell(188.5,3,'				dengan kebutuhan dan profil risiko Pemegang Polis.',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->Cell(1.5);
		$this->pdf->Cell(188.5,3,'7.	Nilai dari setiap unit dan dana yang diinvestasikan akan berbeda dari waktu ke waktu tergantung pada kinerja investasi perusahaan dan tidak lepas',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(1.5);
		$this->pdf->Cell(188.5,3,'				dari risiko Investasi.',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->Cell(1.5);
		$this->pdf->Cell(188.5,3,'8.	Besarnya Nilai Tunai yang dibayarkan (dapat lebih kecil atau besar), akan bergantung pada perkembangan dan dana investasi.',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->Cell(1.5);
		$this->pdf->Cell(188.5,3,'9.	Dana dikelola oleh PT. Asuransi Jiwasraya (Persero), yaitu perusahaan asuransi yang telah berpengalaman sejak tahun 1859.',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->Cell(190,3,'10.	Pemegang Polis bebas melakukan penambahan (Top Up) dan penarikan (Redemption) dana investasi.',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->Cell(190,3,'11.	Top Up',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->Cell(190,3,'a.	Top Up Premi Berkala Kelipatan Rp. 1.000,00',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->Cell(190,3,'b.	Top Up Premi Tunggal Minimum Rp. 1.000.000,00',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->Cell(190,3,'12.	Redemption',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->Cell(190,3,'a.	Redemption tidak dikenakan biaya.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->Cell(190,3,'b.	Dana yang tersisa setelah Redemption, minimum setara dengan 1.000 unit.',0,0,'L');
		/*
		$this->pdf->ln(5);
		$this->pdf->Cell(190,3,'13.	Untuk penarikan sebelum 3 tahun, akan dikenakan pajak penghasilan sesuai ketentuan pemerintah yang berlaku atas kelebihan Nilai Tunai terhadap',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,3,'						Premi yang dibayarkan, kecuali ditentukan lain berdasarkan peraturan perundang-undangan yang berlaku.',0,0,'L');
		*/
		$this->pdf->ln(5);
		$this->pdf->Cell(190,3,'13.	Harga Unit / Nilai NAB (Nilai Aktiva Bersih) akan diumumkan setiap Hari pada Media Harian Bisnis Indonesia dan web site http://www.jiwasraya.co.id.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,3,'						Harga Jual: Harga perunit yang diterapkan pada setiap transaksi yang berkaitan dengan pembentukan unit.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,3,'						Harga Beli: Harga perunit yang diterapkan pada setiap transaksi yang berkaitan dengan pembatalan dan pemindahan unit.',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->Cell(190,3,'14.	Ilustrasi mengansumsikan tidak ada penarikan dana selama masa asuransi.',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->Cell(190,3,'15.	Penilaian harga unit dilakukan pada setiap hari kerja dan perubahan NAB dilaksanakan setiap hari Rabu, dengan menggunakan metode harga pasar',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,3,'						yang berlaku bagi instrumen investasi yang mendasari masing-masing alokasi dan investasi yang dipilih.',0,0,'L');
		$this->pdf->ln(30);
		
		// FOOTER
		$this->pdf->ln(5);
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
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(190,5,'ILUSTRASI PRODUK '.$data['hasil']['jenisproduk'].'','B',0,'L');
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->ln(10);
		
		// DEFINISI
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(190,5,'DEFINISI',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(40,5,'Cash Plan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(140,5,'Memberikan santunan harian Rawat Inap atau Rawat ICU, jika Tertanggung dirawat di Rumah Sakit.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(40,5,'Cash Plan Bedah',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(140,5,'Memberikan santunan pembedahan jika tertanggung harus mengalami pembedahan.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(40,5,'Critical Ilness',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(140,5,'Mengalami kondisi salah satu dari 40 jenis penyakit kritis setelah 90 hari semenjak pertanggungan',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(40,5,'',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,'',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(140,5,'critical ilness dimulai.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(40,5,'Term',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(140,5,'Memberikan santunan jika Tertanggung meninggal dunia.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(40,5,'Personal Accident',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(140,5,'Memberikan santunan jika Tertanggung meninggal dunia karena kecelakaan.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(40,5,'Waiver Premium',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(140,5,'Pembebasan premi lanjutan, jika Tertanggung mengalami cacat tetap total.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(40,5,'TPD',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(140,5,'Memberikan santunan jika Tertanggung mengalami cacat tetap total.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(40,5,'JS TL1',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(140,5,'Jika Tertanggung Meninggal Dunia dalam Masa Asuransi akan dibayarkan Nilai Uang Asuransi',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(40,5,'',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,'',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(140,5,'ditambah Top Up dikurangi Redemption ditambah akumulasi dana.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(40,5,'JS TL2',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(140,5,'Jika Tertanggung Meninggal Dunia dalam Masa Asuransi akan dibayarkan sebesar Uang Asuransi TL2.',0,0,'L');
		$this->pdf->ln(10);
		
		// DISAJIKAN OLEH
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(190,5,'DISAJIKAN OLEH',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(40,5,'Nama Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(140,5,''.$data['hasil']['namaagen'].' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(40,5,'No Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(140,5,''.$data['hasil']['nomeragen'].' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(40,5,'No Proposal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(140,5,time(),0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(40,5,'Tanggal Proposal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(140,5,''.$data['hasil']['tanggalsekarang'].' ',0,0,'L');
		$this->pdf->ln(10);
		
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
		$this->pdf->Cell(95,5,'Saya telah memahami isi ilustrasi ini.',0,0,'L');
		$this->pdf->ln(40);
		
		// FOOTER
		$this->pdf->ln(5);
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
				
	    $this->pdf->Output('./files/pdf/'.$namaFile.'.pdf','F');
	  
	}	

}	