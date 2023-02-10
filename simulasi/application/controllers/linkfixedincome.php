<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");
	
	error_reporting(0);

class Linkfixedincome extends CI_Controller{

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
		$data['nasabah'] = array(
			'nama' => $this->input->post('namanasabah'),
			'alamat' => $this->input->post('alamatnasabah'),
			'kota' => $this->input->post('kotanasabah'),
			'provinsi' => $this->input->post('provinsinasabah'),
			'email' => $this->input->post('emailnasabah'),
			'telp' => $this->input->post('teleponnasabah'),
			'tgl_lahir' => date("Y-m-d", strtotime($this->input->post('lahirnasabah'))),
			'jenis_kel' => $this->input->post('gendernasabah'),
			'session_id' => $this->input->post('sessionnasabah')
			//'premisekaligus' => $this->input->post('premisekaligus')
		);
		
		$nasabahID = $this->ModSimulasi->insertNasabah($data['nasabah']);
		
		$data['premi'] = array(
			'masaasuransi' => $this->input->post('masaasuransi'),
			'saatmulaiunitlink' => $this->input->post('saatmulaiunitlink'),
			'nomeragen' => $this->input->post('nomeragen'),
			'namaagen' => $this->input->post('namaagen'),
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
			'masaasuransi' => $this->input->post('masaasuransi'),
			'saatmulaiunitlink' => $this->input->post('saatmulaiunitlink'),
			'nomeragen' => $this->input->post('nomeragen'),
			'premisekaligus' => $this->input->post('premisekaligus'),
			'proteksi' => $this->input->post('proteksi'),
			'uangasuransi' => $this->input->post('uangasuransi'),
			'modul' => $this->input->post('modul'),
			'namaagen' => $this->input->post('namaagen'),
			'bunganett' => $this->input->post('bunganett'),
			'id_nasabah' => $nasabahID,
			'id_agen' => $this->input->post('nomeragen'),
			'file_pdf' => $filePdf.'.pdf',
			'id_produk' => $this->input->post('idproduk'),
			'filepdf' => $filePdf,
			
			'usia' => $this->input->post('usia'),
			'topupberkalaunitlink' => $this->input->post('topupberkalaunitlink'),
			'topupsekaligusunitlink' => $this->input->post('topupsekaligusunitlink'),
			'masapembpremi' => $this->input->post('masapembpremi'),
			'dibuatunitlink' => $this->input->post('dibuatunitlink'),
			'carabayar' => $this->input->post('carabayar'),
			'asumsinab' => $this->input->post('asumsinab'),
			
			'juatl' => $this->input->post('juatl'),
			'totalpremisesuaicarabayarunitlink' => $this->input->post('totalpremisesuaicarabayarunitlink'),
			
			'juaterm' => $this->input->post('juaterm'),
			'premitambahanterm' => $this->input->post('premitambahanterm'),
			
			'juapa' => $this->input->post('juapa'),
			'premitambahanpa' => $this->input->post('premitambahanpa'),
			
			'juaci' => $this->input->post('juaci'),
			'premitambahanci' => $this->input->post('premitambahanci'),
			
			'juactt' => $this->input->post('juactt'),
			'premitambahanctt' => $this->input->post('premitambahanctt'),
			
			'juawp' => $this->input->post('juawp'),
			'premitambahanwp' => $this->input->post('premitambahanwp'),
			
			'juacpm' => $this->input->post('juacpm'),
			'premitambahancpm' => $this->input->post('premitambahancpm'),
			
			'juacpb' => $this->input->post('juacpb'),
			'premitambahancpb' => $this->input->post('premitambahancpb'),
			
			'selama' => $this->input->post('selama'),
			
			'premisesuaicarabayar' => $this->input->post('premisesuaicarabayar')

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
		
		$lahir = date("Y-m-d", strtotime($this->session->userdata('tgl_lahir')));
		$saatmulaiunitlink = date("Y-m-d", strtotime($this->session->userdata('saatmulaiunitlink')));
		
		$tanggalLahir = date("d", strtotime($this->session->userdata('tgl_lahir')));
		$bulanLahir = $bulan[date("n", strtotime($this->session->userdata('tgl_lahir')))];
		$tahunLahir = date("Y", strtotime($this->session->userdata('tgl_lahir')));
		
		$tanggalMulas = date("d", strtotime($this->session->userdata('saatmulaiunitlink')));
		$bulanMulas = $bulan[date("n", strtotime($this->session->userdata('saatmulaiunitlink')))];
		$tahunMulas = date("Y", strtotime($this->session->userdata('saatmulaiunitlink')));
		
		$tanggalProposal = date("d", strtotime($this->session->userdata('dibuatunitlink')));
		$bulanProposal = $bulan[date("n", strtotime($this->session->userdata('dibuatunitlink')))];
		$tahunProposal = date("Y", strtotime($this->session->userdata('dibuatunitlink')));
		
		$masa = $this->session->userdata('masaasuransi');
		
		$selisih = abs(strtotime($saatmulaiunitlink) - strtotime($lahir));

		$years = floor($selisih / (365*60*60*24));
		
		$idprod = $this->session->userdata('id_produk');
		if ($idprod == 7)
		{
			$jenis_produk = "JS LINK FIXED INCOME"; 
		}
		
		$topupsekaligus = $this->session->userdata('topupsekaligusunitlink');
		
		if ($topupsekaligus == '')
		{
			$topupsekaligus = 0;
		}
		
		$topupberkala = $this->session->userdata('topupberkalaunitlink');
		
		if ($topupberkala == '')
		{
			$topupberkala = 0;
		}
		
		$carabayar = $this->session->userdata('carabayar');
		$premisesuaicarabayar = $this->session->userdata('premisesuaicarabayar');
		
		if ($carabayar == "Bulanan")
		{
			$premiribuan = ($premisesuaicarabayar * 12) ;
			$topupribuan = ($topupberkala * 12) ;
			$pengalimanfaatmeninggaldunia = 30;
		}
		else if ($carabayar == "Kuartalan")
		{
			$premiribuan = ($premisesuaicarabayar* 4) ;
			$topupribuan = ($topupberkala * 4) ;
			$pengalimanfaatmeninggaldunia = 18;
		}
		else if ($carabayar == "Semesteran")
		{
			$premiribuan = ($premisesuaicarabayar * 2) ;
			$topupribuan = ($topupberkala * 2) ;
			$pengalimanfaatmeninggaldunia = 12;
		}
		else if ($carabayar == "Tahunan")
		{
			$premiribuan = ($premisesuaicarabayar * 1) ;
			$topupribuan = ($topupberkala * 1) ;
			$pengalimanfaatmeninggaldunia = 6;
		}
		else if ($carabayar == "Sekaligus")
		{
			$premiribuan = ($premisesuaicarabayar * 1) ;
			$topupribuan = ($topupberkala * 1) ;
		}
		
		$usia = $this->session->userdata('usia');
		$masapembpremi = $this->session->userdata('masapembpremi');
		$jangkawaktuusia = $usia + $masapembpremi;
		
		$data['hasil']['jangkawaktuusia'] = $jangkawaktuusia;
		
		$this->load->model('ModSimulasi');
		$detailproduk = $this->ModSimulasi->getDetailProduk(3);
		$asumsi_inv_min = $detailproduk['ASUMSI_INV_MIN']; 
		$asumsi_inv_med = $detailproduk['ASUMSI_INV_MED'];
		$asumsi_inv_max = $detailproduk['ASUMSI_INV_MAX'];
		$data['hasil']['asumsi_inv_min'] = $asumsi_inv_min;
		$data['hasil']['asumsi_inv_med'] = $asumsi_inv_med;
		$data['hasil']['asumsi_inv_max'] = $asumsi_inv_max;
		
		$data['hasil']['juatl'] = $this->session->userdata('juatl');
		
		$juatl = $data['hasil']['juatl'];
		
		if ($carabayar == "Sekaligus")
		{
			$juatl1 = (($premisesuaicarabayar * 125) / 100);
			$juatl2 = (($premisesuaicarabayar * 10) / 100);
			$data['hasil']['juatl1'] = $juatl1;
			$data['hasil']['juatl2'] = $juatl2;
			$data['hasil']['juatl'] = "-";
			$data['hasil']['premisesuaicarabayar'] = "-";
			$data['hasil']['juaterm'] = "-";
			$data['hasil']['premitambahanterm'] = "-";
			$data['hasil']['juapa'] = "-";
			$data['hasil']['premitambahanpa'] = "-";
			$data['hasil']['juaci'] = "-";
			$data['hasil']['premitambahanci'] = "-";
			$data['hasil']['juactt'] = "-";
			$data['hasil']['premitambahanctt'] = "-";
			$data['hasil']['juawp'] = "-";
			$data['hasil']['premitambahanwp'] = "-";
			$data['hasil']['juacpm'] = "-";
			$data['hasil']['premitambahancpm'] = "-";
			$data['hasil']['juacpb'] = "-";
			$data['hasil']['premitambahancpb'] = "-";
			$data['hasil']['totalpremisesuaicarabayarunitlink'] = $this->session->userdata('totalpremisesuaicarabayarunitlink');
			
			$data['hasil']['jangkawaktuusia'] = "-";
		}
		else
		{
			$juatl1 = "-";
			$juatl2 = "-";
		
			$data['hasil']['juatl1'] = $juatl1;
			$data['hasil']['juatl2'] = $juatl2;
			
			$data['hasil']['totalpremisesuaicarabayarunitlink'] = $this->session->userdata('totalpremisesuaicarabayarunitlink');
			
			$data['hasil']['juaterm'] = $this->session->userdata('juaterm');
			$data['hasil']['premitambahanterm'] = $this->session->userdata('premitambahanterm');
			
			$data['hasil']['juapa'] = $this->session->userdata('juapa');
			$data['hasil']['premitambahanpa'] = $this->session->userdata('premitambahanpa');
			
			$data['hasil']['juaci'] = $this->session->userdata('juaci');
			$data['hasil']['premitambahanci'] = $this->session->userdata('premitambahanci');
			
			$data['hasil']['juactt'] = $this->session->userdata('juactt');
			$data['hasil']['premitambahanctt'] = $this->session->userdata('premitambahanctt');
			
			$data['hasil']['juawp'] = $this->session->userdata('juawp');
			$data['hasil']['premitambahanwp'] = $this->session->userdata('premitambahanwp');
			
			$data['hasil']['juacpm'] = $this->session->userdata('juacpm');
			$data['hasil']['premitambahancpm'] = $this->session->userdata('premitambahancpm');
			
			$data['hasil']['juacpb'] = $this->session->userdata('juacpb');
			$data['hasil']['premitambahancpb'] = $this->session->userdata('premitambahancpb');
			
			$data['hasil']['premisesuaicarabayar'] = $this->session->userdata('premisesuaicarabayar');
			
			$data['hasil']['jangkawaktuusia'] = $jangkawaktuusia;
		
		}
		//$filepdf = site_url('cetakpdf').'/pdfoptima7';
		
		//$data['hasil']['filepdf'] = $filepdf;
		$data['hasil']['nama'] = $this->session->userdata('nama');
		$data['hasil']['namaagen'] = $this->session->userdata('namaagen');
		$data['hasil']['nomeragen'] = $this->session->userdata('nomeragen');
		$data['hasil']['bunganett'] = $this->session->userdata('bunganett');
		$data['hasil']['sapaan'] = ($this->session->userdata('jenis_kel') =='M') ? 'Bapak':'Ibu';
		//$data['hasil']['usiaawal'] = $years;
		$data['hasil']['usia'] = $this->session->userdata('usia');
		$data['hasil']['usiamax'] = 65 - $data['hasil']['usia'];
		$data['hasil']['topupberkalaunitlink'] = $topupberkala;
		$data['hasil']['topupsekaligusunitlink'] = $topupsekaligus;
		$data['hasil']['selama'] = $this->session->userdata('selama');
		$data['hasil']['masapembpremi'] = $this->session->userdata('masapembpremi');
		//$data['hasil']['dibuatunitlink'] = $this->session->userdata('dibuatunitlink');
		$data['hasil']['jenis_produk']  = $jenis_produk;
		$data['hasil']['carabayar'] = $this->session->userdata('carabayar');
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

		$data['hitung'] = array(
			'id_nasabah' => $this->session->userdata('id_nasabah'),
			'id_agen' => $this->session->userdata('id_agen'),
			'file_pdf' => $this->session->userdata('filepdf').'.pdf',
			'id_produk' => $this->session->userdata('id_produk'),
			'session_id' => $this->session->userdata('session_id'),
			'build_id' => time()
		);
		
		$this->ModSimulasi->insertSimulasi($data['hitung']);
		
		$data['hasil']['build_id'] = $data['hitung']['build_id'];
		
		$uangAsuransi = $data['hasil']['uangasuransi'];
		$tabunganAwal = $data['hasil']['premisekaligus'];
		$bungaNett = $data['hasil']['bunganett'];
		//$deposito = $tabunganAwal;
		
		for($i=1;$i<=$data['hasil']['usiamax'];$i++){
		
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
			else
			{
				$investasi = 93.5;
			}
			
			$masaPembayaranPremi = $data['hasil']['masapembpremi'];
			if ($i <= $masaPembayaranPremi)
			{
				
				$data['hasil']['nilai'][$i]['topupribuan'] = ((95 / 100) * $topupribuan);
				$topupribuanhasil = $data['hasil']['nilai'][$i]['topupribuan'];
				$data['hasil']['nilai'][$i]['premiribuandisplay'] = $premiribuan / 1000;
			}
			else 
			{
				$data['hasil']['nilai'][$i]['topupribuan'] = 0;
				$topupribuanhasil = $data['hasil']['nilai'][$i]['topupribuan'];
				$data['hasil']['nilai'][$i]['premiribuandisplay'] = 0;
			}
			
			$data['hasil']['nilai'][$i]['premiribuan'] = ($premiribuan * ($investasi / 100));
			
			$selama = $data['hasil']['selama'];
			
			if ($selama == '')
			{
				$selama = 0;
			}
			
			if ($i <= $selama)
			{
				$data['hasil']['nilai'][$i]['topupribuan'] = ((95 / 100) * $topupribuan) + ((95 / 100) * $topupsekaligus);
				$data['hasil']['nilai'][$i]['topupribuandisplay'] = (($topupribuan) + ($topupsekaligus)) / 1000;
			}
			else 
			{
				$data['hasil']['nilai'][$i]['topupribuan'] = $topupribuanhasil ;
				$data['hasil']['nilai'][$i]['topupribuandisplay'] = $topupribuan / 1000;
			}
			
			$data['hasil']['nilai'][$i]['danapendidikan'] = $data['hasil']['nilai'][$i]['premiribuan'] + $data['hasil']['nilai'][$i]['topupribuan'] ;
			
			if ($carabayar == "Sekaligus")
			{
				if ($i == 1)
				{
					$nabxjumlahunitrendah = (((1+$data['hasil']['asumsi_inv_min']) / 100) * $data['hasil']['nilai'][$i]['danapendidikan']);
					$data['hasil']['nilai'][$i]['nabxjumlahunitrendah'] = $nabxjumlahunitrendah;
					$nabxjumlahunitsedang = (((1+$data['hasil']['asumsi_inv_med']) / 100) * $data['hasil']['nilai'][$i]['danapendidikan']);
					$data['hasil']['nilai'][$i]['nabxjumlahunitsedang'] = $nabxjumlahunitsedang;
					$nabxjumlahunittinggi = (((1+$data['hasil']['asumsi_inv_max']) / 100) * $data['hasil']['nilai'][$i]['danapendidikan']);
					$data['hasil']['nilai'][$i]['nabxjumlahunittinggi'] = $nabxjumlahunittinggi;
					
					$manfaatmeninggalduniarendah = ($nabxjumlahunitrendah + ($juatl / 1000)); 
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah'] = $manfaatmeninggalduniarendah;
					$manfaatmeninggalduniasedang = ($nabxjumlahunitsedang + ($juatl / 1000));
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang'] = $manfaatmeninggalduniasedang;
					$manfaatmeninggalduniatinggi = ($nabxjumlahunittinggi + ($juatl / 1000));
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi'] = $manfaatmeninggalduniatinggi;
				}
				else if ($i > 1) 
				{
					$data['hasil']['nilai'][$i]['nabxjumlahunitrendah'] = ($data['hasil']['nilai'][$i-1]['nabxjumlahunitrendah'] + $data['hasil']['nilai'][$i]['danapendidikan']);
					$data['hasil']['nilai'][$i]['nabxjumlahunitsedang'] = ($data['hasil']['nilai'][$i-1]['nabxjumlahunitsedang'] + $data['hasil']['nilai'][$i]['danapendidikan']);
					$data['hasil']['nilai'][$i]['nabxjumlahunittinggi'] = ($data['hasil']['nilai'][$i-1]['nabxjumlahunittinggi'] + $data['hasil']['nilai'][$i]['danapendidikan']);
					
					$manfaatmeninggalduniarendah = ($pengalimanfaatmeninggaldunia * ($premisesuaicarabayar)) + $data['hasil']['nilai'][$i]['nabxjumlahunitrendah']; 
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah'] = $manfaatmeninggalduniarendah;
					$manfaatmeninggalduniasedang = ($pengalimanfaatmeninggaldunia * ($premisesuaicarabayar)) + $data['hasil']['nilai'][$i]['nabxjumlahunitsedang'];
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang'] = $manfaatmeninggalduniasedang;
					$manfaatmeninggalduniatinggi = ($pengalimanfaatmeninggaldunia * ($premisesuaicarabayar)) + $data['hasil']['nilai'][$i]['nabxjumlahunittinggi'];
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi'] = $manfaatmeninggalduniatinggi;
				}
			}
			else
			{
				if ($i == 1)
				{
					$nabxjumlahunitrendah = ((1+($data['hasil']['asumsi_inv_min'] / 100)) * $data['hasil']['nilai'][$i]['danapendidikan']);
					$data['hasil']['nilai'][$i]['nabxjumlahunitrendah'] = $nabxjumlahunitrendah / 1000;
					$nabxjumlahunitsedang = ((1+($data['hasil']['asumsi_inv_med'] / 100)) * $data['hasil']['nilai'][$i]['danapendidikan']);
					$data['hasil']['nilai'][$i]['nabxjumlahunitsedang'] = $nabxjumlahunitsedang / 1000;
					$nabxjumlahunittinggi = ((1+($data['hasil']['asumsi_inv_max'] / 100)) * $data['hasil']['nilai'][$i]['danapendidikan']);
					$data['hasil']['nilai'][$i]['nabxjumlahunittinggi'] = $nabxjumlahunittinggi / 1000;
					
					$manfaatmeninggalduniarendah = ($pengalimanfaatmeninggaldunia * ($premisesuaicarabayar)) + $nabxjumlahunitrendah; 
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah'] = $manfaatmeninggalduniarendah / 1000;
					$manfaatmeninggalduniasedang = ($pengalimanfaatmeninggaldunia * ($premisesuaicarabayar)) + $nabxjumlahunitsedang;
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang'] = $manfaatmeninggalduniasedang / 1000;
					$manfaatmeninggalduniatinggi = ($pengalimanfaatmeninggaldunia * ($premisesuaicarabayar)) + $nabxjumlahunittinggi;
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi'] = $manfaatmeninggalduniatinggi / 1000;
				}
				else if ($i > 1) 
				{
					$data['hasil']['nilai'][$i]['nabxjumlahunitrendah'] = ($data['hasil']['nilai'][$i-1]['nabxjumlahunitrendah'] + ($data['hasil']['nilai'][$i]['danapendidikan'] / 1000));
					$data['hasil']['nilai'][$i]['nabxjumlahunitsedang'] = ($data['hasil']['nilai'][$i-1]['nabxjumlahunitsedang'] + ($data['hasil']['nilai'][$i]['danapendidikan'] / 1000));
					$data['hasil']['nilai'][$i]['nabxjumlahunittinggi'] = ($data['hasil']['nilai'][$i-1]['nabxjumlahunittinggi'] + ($data['hasil']['nilai'][$i]['danapendidikan'] / 1000));
					
					$manfaatmeninggalduniarendah = (($pengalimanfaatmeninggaldunia * ($premisesuaicarabayar)) / 1000) + $data['hasil']['nilai'][$i]['nabxjumlahunitrendah']; 
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah'] = $manfaatmeninggalduniarendah;
					$manfaatmeninggalduniasedang = (($pengalimanfaatmeninggaldunia * ($premisesuaicarabayar)) / 1000) + $data['hasil']['nilai'][$i]['nabxjumlahunitsedang'];
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang'] = $manfaatmeninggalduniasedang;
					$manfaatmeninggalduniatinggi = (($pengalimanfaatmeninggaldunia * ($premisesuaicarabayar)) / 1000) + $data['hasil']['nilai'][$i]['nabxjumlahunittinggi'];
					$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi'] = $manfaatmeninggalduniatinggi;
				}
			}
			
			$data['hasil']['nilai'][$i]['usia'] = $data['hasil']['usia']+$i;
				
			/*$key = 't'.$i;
						
			$faktor = floatval($nilaiTunai->$key);
			
			$nilai = ($faktor / 1000) * $uangAsuransi;
			$manfaat = ($uangAsuransi > $nilai) ? $uangAsuransi:$nilai;
			
			$bungaDeposito = (floatval($bungaNett)/100) * $tabunganAwal * $i;
			$totalDeposito = $tabunganAwal + $bungaDeposito;
						
			$data['hasil']['nilai'][$i]['manfaat'] = $manfaat; 
			$data['hasil']['nilai'][$i]['nilaitunai'] = $nilai;
			$data['hasil']['nilai'][$i]['tahun'] = ($i == 0) ? 'Awal':$i;
			$data['hasil']['nilai'][$i]['usia'] = $data['hasil']['usia']+$i;
			$data['hasil']['nilai'][$i]['bungadeposito'] = $bungaDeposito;
			$data['hasil']['nilai'][$i]['tabungan'] = $tabunganAwal;
			$data['hasil']['nilai'][$i]['totaldeposito'] = $totalDeposito;
			
			for($j=1;$j<=$masaPembayaranPremi;$j++)
			{	
				$data['hasil']['nilai'][$j]['premiribuan'] = $premiribuan;
				$data['hasil']['nilai'][$j]['topupribuan'] = $topupribuan;
				$data['hasil']['nilai'][$j]['topupsekaligus'] = $topupsekaligus;
				
				//TESTING
				for($k=1;$k<=$selama;$k++)
				{
					$data['hasil']['nilai'][$k]['topupribuan'] = $data['hasil']['nilai'][$j]['topupribuan']  + ($data['hasil']['nilai'][$j]['topupsekaligus']/1000);
					$data['hasil']['nilai'][$k]['topupsekaligus'] = $data['hasil']['nilai'][$j]['topupsekaligus'] / 1000;
				}
				
			}
			
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
			else
			{
				$investasi = 93.5;
			}
			
			if ($carabayar == "Sekaligus")
			{
				$nabxjumlahunitrendah = ((($investasi / 100) * $premiribuan) + ((95 / 100) * $topupribuan) + $data['hasil']['nilai'][$i-1]['nabxjumlahunitrendah']) * ((1+$data['hasil']['asumsi_inv_min']) / 100); 
				$data['hasil']['nilai'][$i]['nabxjumlahunitrendah'] = $nabxjumlahunitrendah;
				$nabxjumlahunitsedang = ((($investasi / 100) * $premiribuan) + ((95 / 100) * $topupribuan) + $data['hasil']['nilai'][$i-1]['nabxjumlahunitsedang']) * ((1+$data['hasil']['asumsi_inv_med']) / 100); 
				$data['hasil']['nilai'][$i]['nabxjumlahunitsedang'] = $nabxjumlahunitsedang;
				$nabxjumlahunittinggi = ((($investasi / 100) * $premiribuan) + ((95 / 100) * $topupribuan) + $data['hasil']['nilai'][$i-1]['nabxjumlahunittinggi']) * ((1+$data['hasil']['asumsi_inv_max']) / 100); 
				$data['hasil']['nilai'][$i]['nabxjumlahunittinggi'] = $nabxjumlahunittinggi;
			
				$manfaatmeninggalduniarendah = ($nabxjumlahunitrendah + ($juatl / 1000)); 
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah'] = $manfaatmeninggalduniarendah;
				$manfaatmeninggalduniasedang = ($nabxjumlahunitsedang + ($juatl / 1000));
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang'] = $manfaatmeninggalduniasedang;
				$manfaatmeninggalduniatinggi = ($nabxjumlahunittinggi + ($juatl / 1000));
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi'] = $manfaatmeninggalduniatinggi;
			}
			else
			{	
				$nabxjumlahunitrendah = ((($investasi / 100) * $premiribuan) + ((95 / 100) * $topupribuan) + $data['hasil']['nilai'][$i-1]['nabxjumlahunitrendah']) * ((1+$data['hasil']['asumsi_inv_min']) / 100); 
				$data['hasil']['nilai'][$i]['nabxjumlahunitrendah'] = $nabxjumlahunitrendah;
				$nabxjumlahunitsedang = ((($investasi / 100) * $premiribuan) + ((95 / 100) * $topupribuan) + $data['hasil']['nilai'][$i-1]['nabxjumlahunitsedang']) * ((1+$data['hasil']['asumsi_inv_med']) / 100); 
				$data['hasil']['nilai'][$i]['nabxjumlahunitsedang'] = $nabxjumlahunitsedang;
				$nabxjumlahunittinggi = ((($investasi / 100) * $premiribuan) + ((95 / 100) * $topupribuan) + $data['hasil']['nilai'][$i-1]['nabxjumlahunittinggi']) * ((1+$data['hasil']['asumsi_inv_max']) / 100); 
				$data['hasil']['nilai'][$i]['nabxjumlahunittinggi'] = $nabxjumlahunittinggi;
				
				$manfaatmeninggalduniarendah = ($pengalimanfaatmeninggaldunia * ($premisesuaicarabayar / 1000)) + $nabxjumlahunitrendah; 
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah'] = $manfaatmeninggalduniarendah;
				$manfaatmeninggalduniasedang = ($pengalimanfaatmeninggaldunia * ($premisesuaicarabayar / 1000)) + $nabxjumlahunitsedang;
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang'] = $manfaatmeninggalduniasedang;
				$manfaatmeninggalduniatinggi = ($pengalimanfaatmeninggaldunia * ($premisesuaicarabayar / 1000)) + $nabxjumlahunittinggi;
				$data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi'] = $manfaatmeninggalduniatinggi;
			}
			
			$masaPembayaranPremi = $data['hasil']['masapembpremi'];
			$selama = $data['hasil']['selama'];*/

		}
		
		
		$filePdf = $this->session->userdata('filepdf');
		
		$this->createPDF($filePdf,$data);
		
		$this->load->view('hasil/linkfixedincome',$data);
		
		//$this->session->sess_destroy();
	}

	function createPDF($namaFile,$data){
		$image1 = FCPATH.'assets/img/logo-js.png';
	    // Generate PDF by saying hello to the world
		
		// Page 1
		$this->pdf->AddPage();

		// Header
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->MultiCell(190, 4, 'ILUSTRASI INI BUKANLAH SEBUAH KONTRAK ASURANSI,','LTR', 'C', false);
		$this->pdf->MultiCell(190, 4, 'HANYA PENDEKATAN PROYEKSI DARI JUMLAH DANA YANG DIINVESTASIKAN', 'LBR', 'C', false);
		$this->pdf->Image($image1, 10, 22);
		$this->pdf->ln(8);
		$this->pdf->SetFont('Arial','',12);
		$this->pdf->Cell(190,5,'PT. ASURANSI JIWASRAYA (PERSERO)',0,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'ILUSTRASI PRODUK',0,0,'C');
		$this->pdf->ln(12);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,10,'JS LINK FIXED INCOME',1,0,'C', true);
		$this->pdf->ln(15);
		
		// Data Pertanggungan
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(1);
		$this->pdf->Cell(50,5,'Nama',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(35,5,''.$data['hasil']['nama'].' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(1);
		$this->pdf->Cell(50,5,'Tanggal Lahir / Usia Calon',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(35,5,''.$data['hasil']['tanggallahir'].' / '.$data['hasil']['usia'].' tahun',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(1);
		$this->pdf->Cell(50,5,'Top-Up Berkala',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(35,5,'Rp. '.$data['hasil']['topupberkalaunitlink'].' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(1);
		$this->pdf->Cell(50,5,'Top-Up Sekaligus',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(35,5,'Rp. '.$data['hasil']['topupsekaligusunitlink'].' selama '.$data['hasil']['selama'].' tahun',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(1);
		$this->pdf->Cell(50,5,'Masa Pembayaran Premi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(35,5,''.$data['hasil']['masapembpremi'].' tahun',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(1);
		$this->pdf->Cell(50,5,'Tanggal Dibuat',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(35,5,''.$data['hasil']['tanggalproposal'].'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(1);
		$this->pdf->Cell(50,5,'Jenis Produk',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(35,5,''.$data['hasil']['jenis_produk'].'',0,0,'L');
		$this->pdf->Cell(6);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(90,5,'Asumsi tingkat hasil investasi yang digunakan adalah sebagai berikut',0,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(1);
		$this->pdf->Cell(50,5,'Cara Bayar Berkala',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(35,5,''.$data['hasil']['carabayar'].'',0,0,'L');
		$this->pdf->Cell(6);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(36,5,'Dana Investasi',1,0,'C', true);
		$this->pdf->Cell(18,5,'Rendah',1,0,'C' , true);
		$this->pdf->Cell(18,5,'Sedang',1,0,'C', true);
		$this->pdf->Cell(18,5,'Tinggi',1,0,'C', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(1);
		$this->pdf->Cell(50,5,'Nilai Aktiva Bersih (NAB) Awal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(35,5,number_format($data['hasil']['asumsinab'], 2, ',', '.'),0,0,'L');
		$this->pdf->Cell(6);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(36,5,''.$data['hasil']['jenis_produk'].'',1,0,'C');
		$this->pdf->Cell(18,5,''.$data['hasil']['asumsi_inv_min'].'%',1,0,'C');
		$this->pdf->Cell(18,5,''.$data['hasil']['asumsi_inv_med'].'%',1,0,'C');
		$this->pdf->Cell(18,5,''.$data['hasil']['asumsi_inv_max'].'%',1,0,'C');
		$this->pdf->ln(10);
		
		//	Rider
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(50,5,'Manfaat Asuransi',1,0,'C', true);
		$this->pdf->Cell(60,5,'Jangka Waktu (sampai dengan)',1,0,'C', true);
		$this->pdf->Cell(40,5,'Uang Asuransi',1,0,'C', true);
		$this->pdf->Cell(40,5,'Biaya Asuransi',1,0,'C', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'JS TL1',1,0,'L');
		$this->pdf->Cell(60,5,'Usia Tertanggung 65 tahun',1,0,'C');
		$this->pdf->Cell(40,5,' '.$data['hasil']['juatl1'].' ',1,0,'C');
		$this->pdf->Cell(40,5,'-',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'JS TL2',1,0,'L');
		$this->pdf->Cell(60,5,'Usia Tertanggung 65 tahun',1,0,'C');
		$this->pdf->Cell(40,5,' '.$data['hasil']['juatl2'].' ',1,0,'C');
		$this->pdf->Cell(40,5,'-',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Produk Pokok TL (1+2)',1,0,'L');
		$this->pdf->Cell(60,5,'Usia Tertanggung '.$data['hasil']['jangkawaktuusia'].' tahun',1,0,'C');
		$this->pdf->Cell(40,5,' '.$data['hasil']['juatl'].' ',1,0,'C');
		$this->pdf->Cell(40,5,' '.$data['hasil']['premisesuaicarabayar'].' ',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Term',1,0,'L');
		$this->pdf->Cell(60,5,'Usia Tertanggung '.$data['hasil']['jangkawaktuusia'].' tahun',1,0,'C');
		$this->pdf->Cell(40,5,' '.$data['hasil']['juaterm'].' ',1,0,'C');
		$this->pdf->Cell(40,5,' '.$data['hasil']['premitambahanterm'].'	**)',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Personal Accident',1,0,'L');
		$this->pdf->Cell(60,5,'Usia Tertanggung '.$data['hasil']['jangkawaktuusia'].' tahun',1,0,'C');
		$this->pdf->Cell(40,5,' '.$data['hasil']['juapa'].' ',1,0,'C');
		$this->pdf->Cell(40,5,' '.$data['hasil']['premitambahanpa'].'	**)',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Critical Illness',1,0,'L');
		$this->pdf->Cell(60,5,'Usia Tertanggung '.$data['hasil']['jangkawaktuusia'].' tahun',1,0,'C');
		$this->pdf->Cell(40,5,' '.$data['hasil']['juaci'].' ',1,0,'C');
		$this->pdf->Cell(40,5,' '.$data['hasil']['premitambahanci'].'	**)',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Total Permanent Disability',1,0,'L');
		$this->pdf->Cell(60,5,'Usia Tertanggung '.$data['hasil']['jangkawaktuusia'].' tahun',1,0,'C');
		$this->pdf->Cell(40,5,' '.$data['hasil']['juactt'].' ',1,0,'C');
		$this->pdf->Cell(40,5,' '.$data['hasil']['premitambahanctt'].'	**)',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Waiver Premium',1,0,'L');
		$this->pdf->Cell(60,5,'Usia Tertanggung '.$data['hasil']['jangkawaktuusia'].' tahun',1,0,'C');
		$this->pdf->Cell(40,5,' '.$data['hasil']['juawp'].' ',1,0,'C');
		$this->pdf->Cell(40,5,' '.$data['hasil']['premitambahanwp'].'	**)',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Cash Plan',1,0,'L');
		$this->pdf->Cell(60,5,'Usia Tertanggung '.$data['hasil']['jangkawaktuusia'].' tahun',1,0,'C');
		$this->pdf->Cell(40,5,' '.$data['hasil']['juacpm'].' ',1,0,'C');
		$this->pdf->Cell(40,5,' '.$data['hasil']['premitambahancpm'].'	**)',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(50,5,'Cash Plan Bedah',1,0,'L');
		$this->pdf->Cell(60,5,'Usia Tertanggung '.$data['hasil']['jangkawaktuusia'].' tahun',1,0,'C');
		$this->pdf->Cell(40,5,' '.$data['hasil']['juacpb'].' ',1,0,'C');
		$this->pdf->Cell(40,5,' '.$data['hasil']['premitambahancpb'].'	**)',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(190,5,'**) Adalah Premi bulanan tahun pertama, dimana besar premi tahun berikutnya akan menyesuaikan kenaikan usia tertanggung',0,0,'C');
		
		// Ilustrasi
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(190,5,'ILUSTRASI PLAN POKOK DAN PERKEMBANGAN DANA',0,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'JS LINK FIXED INCOME',0,0,'C');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(1);
		$this->pdf->Cell(50,5,'Jumlah Premi '.$data['hasil']['carabayar'].'',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(35,5,'Rp. '.$data['hasil']['totalpremisesuaicarabayarunitlink'].' ',0,0,'L');
		$this->pdf->ln(10);
		
		// Tabel
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(14,5,'Akhir','LTR',0,'C', true);
		$this->pdf->Cell(14,5,'Usia','LTR',0,'C', true);
		$this->pdf->Cell(14,5,'Premi *)','LTR',0,'C', true);
		$this->pdf->Cell(14,5,'Top-Up *)','LTR',0,'C', true);
		$this->pdf->Cell(14,5,'Dana','LTR',0,'C', true);
		$this->pdf->Cell(60,5,'Manfaat Meninggal Dunia','LBTR',0,'C', true);
		$this->pdf->Cell(60,5,'(NAB X Jumlah Unit)','LBTR',0,'C', true);
		$this->pdf->ln();
		$this->pdf->Cell(14,5,'Tahun Ke','LBR',0,'C', true);
		$this->pdf->Cell(14,5,'','LBR',0,'C', true);
		$this->pdf->Cell(14,5,'','LBR',0,'C', true);
		$this->pdf->Cell(14,5,'','LBR',0,'C', true);
		$this->pdf->Cell(14,5,'Pendidikan *)','LBR',0,'C', true);
		$this->pdf->Cell(20,5,'Rendah *)','LTBR',0,'C', true);
		$this->pdf->Cell(20,5,'Sedang *)','LTBR',0,'C', true);
		$this->pdf->Cell(20,5,'Tinggi *)','LTBR',0,'C', true);
		$this->pdf->Cell(20,5,'Rendah *)','LTBR',0,'C', true);
		$this->pdf->Cell(20,5,'Sedang *)','LTBR',0,'C', true);
		$this->pdf->Cell(20,5,'Tinggi *)','LTBR',0,'C', true);
		$this->pdf->ln();
		
		$this->pdf->SetFont('Arial','',6);
		for($i=1;$i<=$data['hasil']['usiamax'];$i++){
			$this->pdf->Cell(14,5,' '.$i.' ','LBR',0,'C');
			$this->pdf->Cell(14,5,$data['hasil']['nilai'][$i]['usia'],'BR',0,'C');
			$this->pdf->Cell(14,5,$data['hasil']['nilai'][$i]['premiribuandisplay'],'BL',0,'C');
			$this->pdf->Cell(14,5,$data['hasil']['nilai'][$i]['topupribuandisplay'],'BL',0,'C');
			$this->pdf->Cell(14,5,'','BL',0,'C');
			$this->pdf->Cell(10,5,'','BL',0,'C');
			$this->pdf->Cell(10,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniarendah'], 0, ',', '.'),'BR',0,'C');
			$this->pdf->Cell(10,5,'','BL',0,'C');
			$this->pdf->Cell(10,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniasedang'], 0, ',', '.'),'BR',0,'C');
			$this->pdf->Cell(10,5,'','BL',0,'C');
			$this->pdf->Cell(10,5,number_format($data['hasil']['nilai'][$i]['manfaatmeninggalduniatinggi'], 0, ',', '.'),'BR',0,'C');
			$this->pdf->Cell(10,5,'','BL',0,'C');
			$this->pdf->Cell(10,5,number_format($data['hasil']['nilai'][$i]['nabxjumlahunitrendah'], 0, ',', '.'),'BR',0,'C');
			$this->pdf->Cell(10,5,'','BL',0,'C');
			$this->pdf->Cell(10,5,number_format($data['hasil']['nilai'][$i]['nabxjumlahunitsedang'], 0, ',', '.'),'BR',0,'C');
			$this->pdf->Cell(10,5,'','BL',0,'C');
			$this->pdf->Cell(10,5,number_format($data['hasil']['nilai'][$i]['nabxjumlahunittinggi'], 0, ',', '.'),'BR',0,'C');
			$this->pdf->ln();
		}
		
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(190,5,'*) Keterangan : Ribuan.',0,0,'C');
		$this->pdf->ln(110);
		
		// Footer
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(190,5,'HO - HEAD OFFICE JL. HR. H. JUANDA 34 JAKARTA PUSAT Telp. 021-3845031 Fax.021-3808001',1,0,'C', true);
		
		// Page 2
		$this->pdf->AddPage();

		// Header
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->MultiCell(190, 4, 'ILUSTRASI INI BUKANLAH SEBUAH KONTRAK ASURANSI,','LTR', 'C', false);
		$this->pdf->MultiCell(190, 4, 'HANYA PENDEKATAN PROYEKSI DARI JUMLAH DANA YANG DIINVESTASIKAN', 'LBR', 'C', false);
		$this->pdf->Image($image1, 10, 22);
		$this->pdf->ln(8);
		$this->pdf->SetFont('Arial','',12);
		$this->pdf->Cell(190,5,'PT. ASURANSI JIWASRAYA (PERSERO)',0,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'ILUSTRASI PRODUK',0,0,'C');
		$this->pdf->ln(12);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,10,'JS LINK FIXED INCOME',1,0,'C', true);
		$this->pdf->ln(15);
		
		// Catatan Penting
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(190,5,'CATATAN PENTING',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(190,5,'1.	Alokasi Premi Plan Pokok yang dibentuk ke dalam unit.',0,0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(5);
		$this->pdf->Cell(25,5,'Deskripsi',1,0,'C', true);
		$this->pdf->Cell(25,5,'Tahun 1',1,0,'C', true);
		$this->pdf->Cell(25,5,'Tahun 2',1,0,'C', true);
		$this->pdf->Cell(25,5,'Tahun 3',1,0,'C', true);
		$this->pdf->Cell(25,5,'Tahun 4',1,0,'C', true);
		$this->pdf->Cell(25,5,'Tahun 5',1,0,'C', true);
		$this->pdf->Cell(25,5,'Tahun 6 dst',1,0,'C', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5);
		$this->pdf->Cell(25,5,'Investasi',1,0,'C');
		$this->pdf->Cell(25,5,'30%',1,0,'C');
		$this->pdf->Cell(25,5,'40%',1,0,'C');
		$this->pdf->Cell(25,5,'60%',1,0,'C');
		$this->pdf->Cell(25,5,'70%',1,0,'C');
		$this->pdf->Cell(25,5,'90%',1,0,'C');
		$this->pdf->Cell(25,5,'93.5%',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5);
		$this->pdf->Cell(25,5,'Biaya',1,0,'C');
		$this->pdf->Cell(25,5,'70%',1,0,'C');
		$this->pdf->Cell(25,5,'60%',1,0,'C');
		$this->pdf->Cell(25,5,'40%',1,0,'C');
		$this->pdf->Cell(25,5,'30%',1,0,'C');
		$this->pdf->Cell(25,5,'10%',1,0,'C');
		$this->pdf->Cell(25,5,'6.5%',1,0,'C');
		$this->pdf->ln(10);
		$this->pdf->Cell(190,5,'2.	Ilustrasi manfaat di atas sudah diperhitungkan dengan: ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->Cell(190,5,'a.	Biaya administrasi selama berlakunya asuransi dengan besaran untuk tahun I: 2%, tahun II: 1,64%, tahun III: 1%, tahun IV: 1%, dan seterusnya',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->Cell(190,5,'				sebesar 0,09% x Premi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->Cell(190,5,'b.	Biaya Asuransi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->Cell(190,5,'c.	Biaya Top Up Premi Berkala 5% x Top Up Premi Berkala.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->Cell(190,5,'d.	Biaya Top Up Premi Tunggal 5% x Top Up Premi Tunggal.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'3.	Biaya Pengelolaan Investasi sebesar 1,75% x Total dana Investasi setiap Tahun.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'4.	Uang Asuransi dan Jaminan Tambahan (jika ada) adalah sejumlah uang yang tercantum di dalam Polis yang akan dibayar oleh Penanggung apabila',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'				syarat-syarat dan ketentuan pembayaran sebagaimana tercantum dalam Polis telah dipenuhi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'5.	Nilai Tunai adalah Nilai Saldo Unit yang dihitung berdasarkan Harga Unit pada suatu saat tertentu. ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'6.	Asumsi tinggi rendahnya hasil investasi ini hanya bertujuan untuk ilustrasi saja dan bukan merupakan tolak ukur untuk perhitungan rata-rata tingkat ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'				hasil investasi yang terendah dan tertinggi. Kinerja Investasi tidak dijamin, tergantung dari risiko masing-masing instrument investasi. Pemegang',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'				Polis diberi keleluasaan untuk menempatkan alokasi dana investasi yang memungkinkan optimalisasi tingkat pengembalian investasi, sesuai',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'				dengan kebutuhan dan profil risiko Pemegang Polis.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'7.	Nilai dari setiap unit dan dana yang diinvestasikan akan berbeda dari waktu ke waktu tergantung pada kinerja investasi perusahaan dan tidak lepas',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'				dari risiko Investasi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'8.	Besarnya Nilai Tunai yang dibayarkan (dapat lebih kecil atau besar), akan bergantung pada perkembangan dan dana investasi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'9.	Dana dikelola oleh PT. Asuransi Jiwasraya (Persero), yaitu perusahaan asuransi yang telah berpengalaman sejak tahun 1859.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'10.	Pemegang Polis bebas melakukan penambahan (Top Up) dan penarikan (Redemption) dana investasi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'11.	Top Up',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->Cell(190,5,'a.	Top Up Premi Berkala Kelipatan Rp. 1000,-',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->Cell(190,5,'b.	Top Up Premi Tunggal Minimum Rp. 1000000,-',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'12.	Redemption',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->Cell(190,5,'a.	Redemption tidak dikenakan biaya.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->Cell(190,5,'b.	Dana yang tersisa setelah Redemption, minimum setara dengan 1000 unit.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'13.	Untuk penarikan sebelum 3 tahun, akan dikenakan pajak penghasilan sesuai ketentuan pemerintah yang berlaku atas kelebihan Nilai Tunai terhadap',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'						Premi yang dibayarkan, kecuali ditentukan lain berdasarkan peraturan perundang-undangan yang berlaku.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'14.	Harga Unit / Nilai NAB (Nilai Aktiva Bersih) akan diumumkan setiap Hari pada Media Harian Bisnis Indonesia dan web site http://www.jiwasraya.co.id.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'						Harga Jual: Harga perunit yang diterapkan pada setiap transaksi yang berkaitan dengan pembentukan unit.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'						Harga Beli: Harga perunit yang diterapkan pada setiap transaksi yang berkaitan dengan pembatalan dan pemindahan unit.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'15.	Ilustrasi mengansumsikan tidak ada penarikan dana selama masa asuransi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'16.	Penilaian harga unit dilakukan pada setiap hari kerja dan perubahan NAB dilaksanakan setiap hari Rabu, dengan menggunakan metode harga pasar',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'						yang berlaku bagi instrumen investasi yang mendasari masing-masing alokasi dan investasi yang dipilih.',0,0,'L');
		
		// Footer
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(190,5,'HO - HEAD OFFICE JL. HR. H. JUANDA 34 JAKARTA PUSAT Telp. 021-3845031 Fax.021-3808001',1,0,'C', true);
		
		// Page 3
		$this->pdf->AddPage();

		// Header
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->MultiCell(190, 4, 'ILUSTRASI INI BUKANLAH SEBUAH KONTRAK ASURANSI,','LTR', 'C', false);
		$this->pdf->MultiCell(190, 4, 'HANYA PENDEKATAN PROYEKSI DARI JUMLAH DANA YANG DIINVESTASIKAN', 'LBR', 'C', false);
		$this->pdf->Image($image1, 10, 22);
		$this->pdf->ln(8);
		$this->pdf->SetFont('Arial','',12);
		$this->pdf->Cell(190,5,'PT. ASURANSI JIWASRAYA (PERSERO)',0,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'ILUSTRASI PRODUK',0,0,'C');
		$this->pdf->ln(12);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,10,'JS LINK FIXED INCOME',1,0,'C', true);
		$this->pdf->ln(15);
		
		// Definisi
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

		// Disajikan Oleh
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
		$this->pdf->Cell(140,5,''.$data['hasil']['tanggalproposal'].' ',0,0,'L');
		$this->pdf->ln(10);
		
		// Tanda Tangan 
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(95,5,'TANDA TANGAN AGEN',0,0,'C');
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(95,5,'TANDA TANGAN CALON PEMEGANG POLIS',0,0,'C');
		$this->pdf->ln(50);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(95,5,''.$data['hasil']['namaagen'].' ',0,0,'C');
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(95,5,''.$data['hasil']['nama'].' ',0,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(95,5,'Saya telah menjelaskan isi ilustrasi ini kepada Calon Pemegang Polis.',0,0,'C');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(95,5,'Saya telah memahami isi ilustrasi ini.',0,0,'C');
		
		// Footer
		$this->pdf->ln(60);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(190,5,'HO - HEAD OFFICE JL. HR. H. JUANDA 34 JAKARTA PUSAT Telp. 021-3845031 Fax.021-3808001',1,0,'C', true);
		
	    $this->pdf->Output('./files/pdf/'.$namaFile.'.pdf','F');
	  
	}	

}	