<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");
	
	error_reporting(0);

class Optima9 extends CI_Controller{	

	var $details;
	
	
	public function __construct()
	{
		parent::__construct();

	
		/*$this->load->helper(array('form','date','url','email'));
		$this->load->library(array('form_validation','session','encrypt','upload','csvimport'));
		$this->load->model(array('ModAktiva','ModKategori','ModVendor','ModRekeningAkun'));
		$this->output->enable_profiler(true);*/
		$this->load->helper(array('form','date','url','email'));
		$this->load->model(array('ModSimulasi'));
		//$this->load->library('dompdf_lib');
		$this->load->library('pdf');
		
 	}
	
	function index(){
		//$this->insertNasabah();
		
		$this->template->display('simulasi');
	}
	
	function insertNasabah(){
		$data['nasabah'] = array(
			'NAMA' => $this->input->post('namanasabah'),
			'ALAMAT' => $this->input->post('alamat'),
			'KOTA' => $this->input->post('kota'),
			'PROVINSI' => $this->input->post('provinsi'),
			'EMAIL' => $this->input->post('email'),
			'TELP' => $this->input->post('telp'),
			'TGL_LAHIR' => date("Y-m-d", strtotime($this->input->post('tgl_lahir'))),
			'JENIS_KEL' => $this->input->post('jenis_kel'),
			'SESSION_ID' => $this->input->post('sessionid')
			//'premisekaligus' => $this->input->post('premisekaligus')
		);
		
		$data['premi'] = array(
			'masaasuransi' => $this->input->post('masaasuransi'),
			'mulas' => $this->input->post('mulas'),
			'nomeragen' => $this->input->post('nomeragen')
		);
		
		//$this->ModSimulasi->insertNasabah($data['nasabah']);
		//return $data;
		$this->load->view('hasil/optima9',$data);
	}
	
	function detail(){
		$data['details'] = $this->ModSimulasi->getDetailProduct('optima9');

		//echo $arr;
		//$this->load->view('optima8',$data);
		
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
			'mulas' => $this->input->post('mulas'),
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
			'mulas' => $this->input->post('mulas'),
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
			'kode_prospek' => $this->input->post('kodeprospek'),
			'kodeprospek' => $this->input->post('kodeprospek'),
			'filepdf' => $filePdf,
			'namalengkapcalontertanggung' => $this->input->post('namalengkapcalontertanggung'),
			'jeniskelamincalontertanggung' => $this->input->post('jeniskelamincalontertanggung'),
			'tanggallahircalontertangggung' => $this->input->post('tanggallahircalontertangggung')
  		);
		
		
		$this->session->set_userdata($newdata);
		
		//$html = $this->load->view('pdf/optima8',$data,true);
		//$this->load->view('hasil/optima8');*/
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
		
		//$lahir = date("Y-m-d", strtotime($this->session->userdata('tgl_lahir')));
		$lahir = date("Y-m-d", strtotime($this->session->userdata('tanggallahircalontertangggung')));
		$mulas = date("Y-m-d", strtotime($this->session->userdata('mulas')));
		
		$tanggalMulas = date("d", strtotime($this->session->userdata('mulas')));
		$bulanMulas = $bulan[date("n", strtotime($this->session->userdata('mulas')))];
		$tahunMulas = date("Y", strtotime($this->session->userdata('mulas')));
		
		$tanggalHariIni = date("d", time());
		$bulanHariIni = $bulan[date("n", time())];
		$tahunHariIni = date("Y", time());
		
		$masa = $this->session->userdata('masaasuransi');;
		
		$selisih = abs(strtotime($mulas) - strtotime($lahir));

		$years = floor($selisih / (365*60*60*24));
		
		//$filepdf = site_url('cetakpdf').'/pdfoptima8';
		
		//$data['hasil']['filepdf'] = $filepdf;
		$data['hasil']['nama'] = $this->session->userdata('nama');
		$data['hasil']['bunganett'] = $this->session->userdata('bunganett');
		$data['hasil']['sapaan'] = ($this->session->userdata('jenis_kel') =='M') ? 'Bapak':'Ibu';
		$data['hasil']['usiaawal'] = $years;
		$data['hasil']['uangasuransi'] = $this->session->userdata('uangasuransi');
		$data['hasil']['premisekaligus'] = $this->session->userdata('premisekaligus');
		$data['hasil']['masaasuransi'] = $this->session->userdata('masaasuransi');
		$data['hasil']['mulas'] = $tanggalMulas.' '.$bulanMulas.' '.$tahunMulas;
		$data['hasil']['tanggalproposal'] = $tanggalHariIni.' '.$bulanHariIni.' '.$tahunHariIni;
		$data['hasil']['filepdf'] = $this->session->userdata('filepdf');
		$data['hasil']['premisekaligus'] = $this->session->userdata('premisekaligus');
		$data['hasil']['masaasuransi'] = $this->session->userdata('masaasuransi');
		$data['hasil']['mulas'] = $tanggalMulas.' '.$bulanMulas.' '.$tahunMulas;
		$data['hasil']['tanggalproposal'] = $tanggalHariIni.' '.$bulanHariIni.' '.$tahunHariIni;
		$data['hasil']['filepdf'] = $this->session->userdata('filepdf');
		$data['hasil']['id_nasabah'] = $this->session->userdata('id_nasabah');
		$data['hasil']['id_agen']	 = $this->session->userdata('id_agen');
		//$data['hasil']['file_pdf']	 = $filePdf.'.pdf',
		$data['hasil']['id_produk']  = $this->session->userdata('id_produk');
		
		$data['hasil']['namalengkapcalontertanggung'] = $this->session->userdata('namalengkapcalontertanggung');
		$data['hasil']['jeniskelamincalontertanggung'] = $this->session->userdata('jeniskelamincalontertanggung');

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
		//$data['hasil']['kantorcabang'] = $api['NAMAKANTOR'];
		
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
			'CARA_BAYAR' => 'Sekaligus',
			'JUMLAH_PREMI' => $data['hasil']['premisekaligus']
		);
		
		$this->ModSimulasi->insertSimulasi($data['hitung']);
		
		$data['hasil']['build_id'] = $data['hitung']['BUILD_ID'];
		
		$uangAsuransi = $data['hasil']['uangasuransi'];
		$tabunganAwal = $data['hasil']['premisekaligus'];
		$bungaNett = $data['hasil']['bunganett'];
		//$deposito = $tabunganAwal;
		
		for($i=0;$i<=$masa;$i++){
			$key = 'T'.$i;
			
			$nilaiTunaiTot = $this->ModSimulasi->getNilaiTunaiTotalOpt9($key, $this->session->userdata('modul'), $uangAsuransi);
						
			//$faktor = floatval($nilaiTunai->$key);
			
			//$nilai = ($faktor / 1000) * $uangAsuransi;
			$manfaat = ($uangAsuransi > $nilaiTunaiTot['NT']) ? $uangAsuransi:$nilaiTunaiTot['NT'];
			
			$bungaDeposito = (floatval($bungaNett)/100) * $tabunganAwal * $i;
			$totalDeposito = $tabunganAwal + $bungaDeposito;
						
			$data['hasil']['nilai'][$i]['manfaat'] = $manfaat; 
			$data['hasil']['nilai'][$i]['nilaitunai'] = $nilaiTunaiTot['NT'];
			$data['hasil']['nilai'][$i]['usia'] = $years+$i;
			$data['hasil']['nilai'][$i]['tahun'] = ($i == 0) ? 'Awal':$i;
			$data['hasil']['nilai'][$i]['bungadeposito'] = $bungaDeposito;
			$data['hasil']['nilai'][$i]['tabungan'] = $tabunganAwal;
			$data['hasil']['nilai'][$i]['totaldeposito'] = $totalDeposito;
		}
		
		$filePdf = $this->session->userdata('filepdf');
		
		$this->createPDF($filePdf,$data);
		
		$this->ModSimulasi->insertProposal(strtoupper($this->session->userdata('nama')), strtoupper($this->session->userdata('modul')), ($data['hasil']['build_id']-1), $data['hasil']['nomeragen']);
		
		$this->load->view('hasil/optima9',$data);
		
		//$this->session->sess_destroy();
	}

	function createPDF($namaFile,$data){
		$image1 = FCPATH.'assets/img/logo-js.png';
	    // Generate PDF by saying hello to the world
	    $this->pdf->AddPage();
		$this->pdf->Cell(15);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(160,10,'PT. Asuransi Jiwasraya (Persero)',0,0,'R');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(15);
		$this->pdf->Cell(160,10,'Jl. Ir. H. Juanda No. 34, Jakarta - 10210',0,0,'R');
		$this->pdf->Image($image1, 15, 10);
	    $this->pdf->ln(10);
	    $this->pdf->SetFont('Arial','B',16);
		// Judul Proposal
		$this->pdf->ln(10);
		$this->pdf->Cell(15);
	    $this->pdf->Cell(160,10,'Proposal',0,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(15);
		$this->pdf->Cell(160,10,'JS Plan Optima 9',0,0,'C');
		$this->pdf->ln();
		$this->pdf->ln();
		// Judul Proposal
		// Opening Text
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(15);
	    $this->pdf->Cell(160,5,'Disajikan untuk '.$data['hasil']['sapaan'].' '.$data['hasil']['namalengkapcalontertanggung'].'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(15);
		$this->pdf->Cell(160,5,'DATA PERTANGGUNGAN',0,0,'L');
		$this->pdf->ln();
		// Opening Text
		// Data Pertanggungan & Content
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(15);
		$this->pdf->Cell(25,5,'Usia',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(25,5,''.$data['hasil']['usiaawal'].' Tahun',0,0,'L');
		$this->pdf->ln();
		
		$this->pdf->Cell(15);
		$this->pdf->Cell(25,5,'Uang Asuransi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(25,5,'Rp. '.number_format($data['hasil']['uangasuransi'], 0, ',', '.').'',0,0,'L');
		
		$this->pdf->Cell(40);
		
		$this->pdf->Cell(25,5,'Masa Asuransi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(25,5,''.$data['hasil']['masaasuransi'].' Tahun',0,0,'L');
		$this->pdf->ln();
		
		$this->pdf->Cell(15);
		$this->pdf->Cell(25,5,'Premi Sekaligus',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(25,5,'Rp. '.number_format($data['hasil']['premisekaligus'], 0, ',', '.').'',0,0,'L');
		
		$this->pdf->Cell(40);
		
		$this->pdf->Cell(25,5,'Mulai Asuransi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(30,5,$data['hasil']['mulas'],0,0,'L');
		$this->pdf->ln();
		$this->pdf->ln();
		
		$this->pdf->Cell(15);
	    $this->pdf->Cell(160,5,'Sebagai gambaran keunggulan manfaat JS Plan Optima 9, kami sampaikan sebagai berikut :',0,0,'L');
		$this->pdf->ln();
		$this->pdf->ln();
		
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(15);
	    $this->pdf->Cell(160,5,'Tabel Perbandingan Perkembangan Dana Investasi',0,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(15);
	    $this->pdf->Cell(160,5,'JS Plan Optima 9 Dengan Deposito Bank',0,0,'C');
		$this->pdf->ln();
		$this->pdf->ln();

		$this->pdf->Cell(15);
		$this->pdf->Cell(25,5,'Akhir','LTR',0,'C');
		$this->pdf->Cell(15,5,'Usia','TR',0,'C');
		$this->pdf->Cell(80,5,'JS Plan Optima 9','BTR',0,'C');
		$this->pdf->Cell(40,5,'Deposito Bank Nett','TR',0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(15);
		$this->pdf->Cell(25,5,'Tahun Ke','LBR',0,'C');
		$this->pdf->Cell(15,5,'','BR',0,'C');
		$this->pdf->Cell(40,5,'Manfaat Meninggal Dunia','BR',0,'C');
		$this->pdf->Cell(40,5,'Nilai Tunai','BR',0,'C');
		$this->pdf->Cell(40,5,'(Pokok + Bunga)','BR',0,'C');
		$this->pdf->ln();
		
		$masaAsuransi = $data['hasil']['masaasuransi'];
		$this->pdf->SetFont('Arial','',8);
		for($i=0;$i<=$masaAsuransi;$i++){
			$this->pdf->Cell(15);
			$this->pdf->Cell(25,5,$data['hasil']['nilai'][$i]['tahun'],'LBR',0,'C');
			$this->pdf->Cell(15,5,$data['hasil']['nilai'][$i]['usia'],'BR',0,'C');
			$this->pdf->Cell(10,5,'Rp. ','BL',0,'L');
			$this->pdf->Cell(30,5,number_format($data['hasil']['nilai'][$i]['manfaat'], 0, ',', '.'),'BR',0,'R');
			$this->pdf->Cell(10,5,'Rp. ','BL',0,'L');
			$this->pdf->Cell(30,5,number_format($data['hasil']['nilai'][$i]['nilaitunai'], 0, ',', '.'),'BR',0,'R');
			$this->pdf->Cell(10,5,'Rp. ','BL',0,'L');
			if ($i > 0)
			{
			$this->pdf->Cell(30,5,number_format($data['hasil']['nilai'][$i]['totaldeposito'], 0, ',', '.'),'BR',0,'R');
			}
			else 
			{
			$this->pdf->Cell(30,5,number_format('0', 0, ',', '.'),'BR',0,'R');			
			}
			$this->pdf->ln();
		}
		
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(15);
	    $this->pdf->Cell(160,3,'Keterangan :',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(15);
	    $this->pdf->Cell(50,3,'Bunga JS Plan Optima 9',0,0,'L');
		$this->pdf->Cell(5,3,':',0,0,'L');
		$this->pdf->Cell(50,3,'9% Per Tahun (Nett) - Compounded / Majemuk',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(15);
	    $this->pdf->Cell(50,3,'Bunga Deposito',0,0,'L');
		$this->pdf->Cell(5,3,':',0,0,'L');
		$this->pdf->Cell(50,3,''.$data['hasil']['bunganett'].'% Per Tahun (Nett)',0,0,'L');
		$this->pdf->ln();
		$this->pdf->ln(5);
		
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(15);
	    $this->pdf->Cell(160,5,'Semoga proposal ini dapat memberikan informasi yang memenuhi kebutuhan anda.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->ln();
		$this->pdf->ln();
		$this->pdf->Cell(15);
	    $this->pdf->Cell(160,5,'Jakarta, '.$data['hasil']['tanggalproposal'].'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->ln();
		$this->pdf->Cell(15);
	    $this->pdf->Cell(60,5,'Disajikan Oleh',0,0,'C');
		$this->pdf->Cell(40);
		$this->pdf->Cell(60,5,'Disetujui Oleh',0,0,'C');
		$this->pdf->ln();
		$this->pdf->ln();
		$this->pdf->ln();
		$this->pdf->ln();
		$this->pdf->ln();
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(15);
	    $this->pdf->Cell(60,5,$data['hasil']['namaagen'],'T',0,'C');
		$this->pdf->Cell(40);
		$this->pdf->Cell(60,5,$data['hasil']['nama'],'T',0,'C');
		$this->pdf->ln();
		$this->pdf->ln();
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','I',8);
		$this->pdf->Cell(15);
	    $this->pdf->MultiCell(160,5,'Illustrasi ini hanya merupakan pendekatan/proyeksi dari jumlah dana yang diinvestasikan dan bukan merupakan bagian dari kontrak asuransi',1);
		// Data Pertanggungan & Content
	   	// Footer
   	    $this->pdf->SetY(260);
   		// Select Arial italic 8
    	$this->pdf->SetFont('Arial','I',8);
    	// Print centered page number
    	$this->pdf->Cell(15);
		$this->pdf->Cell(160,5,'','B',0,'L');
		$this->pdf->ln();
		
		$this->pdf->SetFont('Arial','',6);
    	$this->pdf->Cell(15);
    	$this->pdf->Cell(15,5,'Agen',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(15,5,$data['hasil']['namaagen'],0,0,'L');
		$this->pdf->Cell(20);
		$this->pdf->Cell(15,5,'Kode Agen',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(15,5,$data['hasil']['nomeragen'],0,0,'L');
		$this->pdf->ln();
		
    	$this->pdf->Cell(15);
    	$this->pdf->Cell(15,5,'Tanggal',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(15,5,date("d/m/Y h:i:s A", time()),0,0,'L');
		$this->pdf->Cell(20);
		$this->pdf->Cell(15,5,'Build ID',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(15,5,($data['hasil']['build_id']-1),0,0,'L');
		$this->pdf->ln();
	   	// Footer
	   
	   
	    $this->pdf->Output('./files/pdf/'.$namaFile.'.pdf','F');
	  
	}	

}