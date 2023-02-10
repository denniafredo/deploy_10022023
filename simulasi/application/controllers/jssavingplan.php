<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");
	
	error_reporting(0);

class Jssavingplan extends CI_Controller{
	
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
			'tanggallahircalontertangggung' => $this->input->post('tanggallahircalontertangggung'),
			'usiacalontertanggung' => $this->input->post('usiacalontertanggung'),
			'premisekaligus' => $this->input->post('premisekaligus'),
			'saatmulaiasuransi' => $this->input->post('saatmulaiasuransi'),
			'masaasuransi' => $this->input->post('masaasuransi'),
			
			'nilaitunai1' => $this->input->post('nilaitunai1'),
			'nilaitunai2' => $this->input->post('nilaitunai2'),
			'nilaitunai3' => $this->input->post('nilaitunai3'),
			'nilaitunai4' => $this->input->post('nilaitunai4'),
			'nilaitunai5' => $this->input->post('nilaitunai5'),
			
			'manfaatmeninggaldunia1' => $this->input->post('manfaatmeninggaldunia1'),
			'manfaatmeninggaldunia2' => $this->input->post('manfaatmeninggaldunia2'),
			'manfaatmeninggaldunia3' => $this->input->post('manfaatmeninggaldunia3'),
			'manfaatmeninggaldunia4' => $this->input->post('manfaatmeninggaldunia4'),
			'manfaatmeninggaldunia5' => $this->input->post('manfaatmeninggaldunia5'),
			
			'totalmanfaat1' => $this->input->post('totalmanfaat1'),
			'totalmanfaat2' => $this->input->post('totalmanfaat2'),
			'totalmanfaat3' => $this->input->post('totalmanfaat3'),
			'totalmanfaat4' => $this->input->post('totalmanfaat4'),
			'totalmanfaat5' => $this->input->post('totalmanfaat5'),
			
			'pilihanproduk' => $this->input->post('pilihanproduk'),
			
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
		
		$data['hasil']['premisekaligus']  = $this->session->userdata('premisekaligus');
		
		$tanggalsaatmulaiasuransi= date("d", strtotime($this->session->userdata('saatmulaiasuransi')));
		$bulansaatmulaiasuransi = $bulan[date("n", strtotime($this->session->userdata('saatmulaiasuransi')))];
		$tahunsaatmulaiasuransi = date("Y", strtotime($this->session->userdata('saatmulaiasuransi')));
		$data['hasil']['saatmulaiasuransi'] = $tanggalsaatmulaiasuransi.' '.$bulansaatmulaiasuransi.' '.$tahunsaatmulaiasuransi;
		
		$data['hasil']['masaasuransi']  = $this->session->userdata('masaasuransi');
		
		$data['hasil']['nilaitunai1']  = $this->session->userdata('nilaitunai1');
		$data['hasil']['nilaitunai2']  = $this->session->userdata('nilaitunai2');
		$data['hasil']['nilaitunai3']  = $this->session->userdata('nilaitunai3');
		$data['hasil']['nilaitunai4']  = $this->session->userdata('nilaitunai4');
		$data['hasil']['nilaitunai5']  = $this->session->userdata('nilaitunai5');
		
		$data['hasil']['manfaatmeninggaldunia1']  = $this->session->userdata('manfaatmeninggaldunia1');
		$data['hasil']['manfaatmeninggaldunia2']  = $this->session->userdata('manfaatmeninggaldunia2');
		$data['hasil']['manfaatmeninggaldunia3']  = $this->session->userdata('manfaatmeninggaldunia3');
		$data['hasil']['manfaatmeninggaldunia4']  = $this->session->userdata('manfaatmeninggaldunia4');
		$data['hasil']['manfaatmeninggaldunia5']  = $this->session->userdata('manfaatmeninggaldunia5');
		
		$data['hasil']['totalmanfaat1']  = $this->session->userdata('totalmanfaat1');
		$data['hasil']['totalmanfaat2']  = $this->session->userdata('totalmanfaat2');
		$data['hasil']['totalmanfaat3']  = $this->session->userdata('totalmanfaat3');
		$data['hasil']['totalmanfaat4']  = $this->session->userdata('totalmanfaat4');
		$data['hasil']['totalmanfaat5']  = $this->session->userdata('totalmanfaat5');
		
		if ($this->session->userdata('pilihanproduk') == 1)
		{	
			$data['hasil']['pilihanproduk']  = 'Akhir 3 Bulan ke-';
		}
		else if ($this->session->userdata('pilihanproduk') == 2)
		{	
			$data['hasil']['pilihanproduk']  = 'Akhir 6 Bulan ke-';
		}
		
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
			'CARA_BAYAR' => 'Sekaligus',
			'JUMLAH_PREMI' => $data['hasil']['premisekaligus']
		);
		
		$this->ModSimulasi->insertSimulasi($data['hitung']);
		
		$data['hasil']['build_id'] = $data['hitung']['BUILD_ID'];
				
		$filePdf = $this->session->userdata('filepdf');
		
		$this->createPDF($filePdf,$data);
		
		$this->load->view('hasil/jssavingplan',$data);
		
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
		$this->pdf->ln(10);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(89,89,89);
		$this->pdf->Cell(190,5,'JS SAVING PLAN','LTR',0,'C', true);
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'PENAWARAN SAMPAI DENGAN 31 DESEMBER 2018','LBR',0,'C', true);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->ln();

		// DATA TERTANGGUNG
		$this->pdf->Cell(47.5,5,'Nama Calon',0,0,'L');
		$this->pdf->Cell(7.5,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(57.5,5,$data['hasil']['namalengkapcalontertanggung'],0,0,'L');
		$this->pdf->Cell(30,5,'',0,0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->ln();
		$this->pdf->Cell(47.5,5,'Tanggal Lahir/Usia',0,0,'L');
		$this->pdf->Cell(7.5,5,':',0,0,'L');
		$this->pdf->Cell(57.5,5,$data['hasil']['tanggallahircalontertangggung'].'/'.$data['hasil']['usiacalontertanggung'].' Tahun',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(47.5,5,'Premi Sekaligus',0,0,'L');
		$this->pdf->Cell(7.5,5,':',0,0,'L');
		$this->pdf->Cell(57.5,5,'Rp. '.number_format($data['hasil']['premisekaligus'],0,'.',',').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(47.5,5,'Uang Asuransi',0,0,'L');
		$this->pdf->Cell(7.5,5,':',0,0,'L');
		$this->pdf->Cell(57.5,5,'Rp. '.number_format($data['hasil']['premisekaligus']*0.25,0,'.',',').'',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,'',0,0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->ln();
		$this->pdf->Cell(47.5,5,'Masa Asuransi',0,0,'L');
		$this->pdf->Cell(7.5,5,':',0,0,'L');
		$this->pdf->Cell(57.5,5,$data['hasil']['masaasuransi'],0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,'',0,0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->ln();
		$this->pdf->Cell(47.5,5,'Saat Mulai',0,0,'L');
		$this->pdf->Cell(7.5,5,':',0,0,'L');
		$this->pdf->Cell(57.5,5,$data['hasil']['saatmulaiasuransi'],0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,'',0,0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->ln(10);
		
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(190,5,'PENGEMBANGAN DANA PRODUK JS SAVING PLAN',0,0,'C');
		$this->pdf->ln(10);

		// TABEL PERBANDINGAN PERKEMBANGAN DANA INVESTASI
		$this->pdf->SetFont('Arial','B',8);
		//$this->pdf->SetTextColor(255,255,255);
		//$this->pdf->SetFillColor(89,89,89);
		$this->pdf->Cell(47.5,5,'Akhir Tahun ke-',1,0,'C', true);
		$this->pdf->Cell(47.5,5,'Manfaat Meninggal Dunia',1,0,'C', true);
		$this->pdf->Cell(47.5,5,'Nilai Tunai/Dana Akhir',1,0,'C', true);
		$this->pdf->Cell(47.5,5,'Keterangan',1,0,'C', true);
//		$this->pdf->Cell(38,5,'Deposito (*)',1,0,'C', true);
//		$this->pdf->Cell(38,5,'Tabungan (**)',1,0,'C', true);
		//$this->pdf->SetTextColor(0,0,0);
		//$this->pdf->SetFillColor(200,200,200);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(47.5,5,'1',1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['manfaatmeninggaldunia1'],0,'.',','),1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['nilaitunai1'],0,'.',','),1,0,'C');
		$this->pdf->Cell(47.5,5,'',1,0,'C');
//		$this->pdf->Cell(38,5,number_format($data['hasil']['premisekaligus']*(1+(4.8/100)),0,'.',','),1,0,'C');
//		$this->pdf->Cell(38,5,number_format($data['hasil']['premisekaligus']*(1+(4/100)),0,'.',','),1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(47.5,5,'2',1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['manfaatmeninggaldunia2'],0,'.',','),1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['nilaitunai2'],0,'.',','),1,0,'C');
		$this->pdf->Cell(47.5,5,'*',1,0,'C');
//		$this->pdf->Cell(38,5,number_format($data['hasil']['premisekaligus']*(1+(4.8/100))*(1+(4.8/100)),0,'.',','),1,0,'C');
//		$this->pdf->Cell(38,5,number_format($data['hasil']['premisekaligus']*(1+(4/100))*(1+(4/100)),0,'.',','),1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(47.5,5,'3',1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['manfaatmeninggaldunia3'],0,'.',','),1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['nilaitunai3'],0,'.',','),1,0,'C');
		$this->pdf->Cell(47.5,5,'*',1,0,'C');
//		$this->pdf->Cell(38,5,number_format($data['hasil']['premisekaligus']*(1+(4.8/100))*(1+(4.8/100))*(1+(4.8/100)),0,'.',','),1,0,'C');
//		$this->pdf->Cell(38,5,number_format($data['hasil']['premisekaligus']*(1+(4/100))*(1+(4/100))*(1+(4/100)),0,'.',','),1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(47.5,5,'4',1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['manfaatmeninggaldunia4'],0,'.',','),1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['nilaitunai4'],0,'.',','),1,0,'C');
		$this->pdf->Cell(47.5,5,'*',1,0,'C');
//		$this->pdf->Cell(38,5,number_format($data['hasil']['premisekaligus']*(1+(4.8/100))*(1+(4.8/100))*(1+(4.8/100))*(1+(4.8/100)),0,'.',','),1,0,'C');
//		$this->pdf->Cell(38,5,number_format($data['hasil']['premisekaligus']*(1+(4/100))*(1+(4/100))*(1+(4/100))*(1+(4/100)),0,'.',','),1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(47.5,5,'5',1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['manfaatmeninggaldunia5'],0,'.',','),1,0,'C');
		$this->pdf->Cell(47.5,5,number_format($data['hasil']['nilaitunai5'],0,'.',','),1,0,'C');
		$this->pdf->Cell(47.5,5,'*',1,0,'C');
//		$this->pdf->Cell(38,5,number_format($data['hasil']['premisekaligus']*(1+(4.8/100))*(1+(4.8/100))*(1+(4.8/100))*(1+(4.8/100))*(1+(4.8/100)),0,'.',','),1,0,'C');
//		$this->pdf->Cell(38,5,number_format($data['hasil']['premisekaligus']*(1+(4/100))*(1+(4/100))*(1+(4/100))*(1+(4/100))*(1+(4/100)),0,'.',','),1,0,'C');
		$this->pdf->ln(10);

		// KETERANGAN
		$this->pdf->SetFont('Arial','B',8);
		//$this->pdf->SetTextColor(255,255,255);
		//$this->pdf->SetFillColor(89,89,89);
		$this->pdf->Cell(190,5,'KETERANGAN:',1,0,'L', true);
		//$this->pdf->SetTextColor(0,0,0);
		//$this->pdf->SetFillColor(200,200,200);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5,5,'(*)',0,0,'L');
		$this->pdf->Cell(46.25,5,'Bunga Garansi JS Saving Plan tahun pertama',0,0,'L');
		$this->pdf->Cell(46.25,5,'',0,0,'L');
		$this->pdf->Cell(46.25,5,'',0,0,'L');
		$this->pdf->Cell(46.25,5,'5.00% p.a. nett',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5,5,'',0,0,'L');
		$this->pdf->Cell(46.25,5,'Tahun ke-2 dan seterusnya hanya asumsi dan akan',0,0,'L');
		$this->pdf->Cell(46.25,5,'',0,0,'L');
		$this->pdf->Cell(46.25,5,'',0,0,'L');
		$this->pdf->Cell(46.25,5,'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5,5,'',0,0,'L');
		$this->pdf->Cell(46.25,5,'diberitahukan kepada Pemegang Polis 1 (satu) bulan sebelum ulang tahun polis.',0,0,'L');
		$this->pdf->Cell(46.25,5,'',0,0,'L');
		$this->pdf->Cell(46.25,5,'',0,0,'L');
		$this->pdf->Cell(46.25,5,'',0,0,'L');
		$this->pdf->ln(10);

		//MANFAAT ASURANSI
		$this->pdf->SetFont('Arial','B',8);
		//$this->pdf->SetTextColor(255,255,255);
		//$this->pdf->SetFillColor(89,89,89);
		$this->pdf->Cell(190,5,'MANFAAT ASURANSI:',1,0,'L', true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->ln();
		//$this->pdf->SetTextColor(255,255,255);
		//$this->pdf->SetFillColor(89,89,89);
		$this->pdf->Cell(190,5,'Apabila Tertanggung meninggal dunia, maka kepada Ahli Waris akan dibayarkan:',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5,5,'1.',0,0,'L');
		$this->pdf->Cell(46.25,5,'Segera, sebesar Uang Asuransi, yaitu 25% dari Premi sekaligus, dan',0,0,'L');
		$this->pdf->Cell(46.25,5,'',0,0,'L');
		$this->pdf->Cell(46.25,5,'',0,0,'L');
		$this->pdf->Cell(46.25,5,'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5,5,'2.',0,0,'L');
		$this->pdf->Cell(46.25,5,'Sebesar Nilai Tunai, pada saat akhir Periode Investasi',0,0,'L');
		$this->pdf->Cell(46.25,5,'',0,0,'L');
		$this->pdf->Cell(46.25,5,'',0,0,'L');
		$this->pdf->Cell(46.25,5,'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(5,5,'',0,0,'L');
		$this->pdf->Cell(46.25,5,'dan pertanggungan berakhir secara otomatis. ',0,0,'L');
		$this->pdf->ln(10);

		$this->pdf->SetFont('Arial','I',8);
		//$this->pdf->SetTextColor(255,255,255);
		//$this->pdf->SetFillColor(89,89,89);
		$this->pdf->Cell(190,5,'Saya mengerti sepenuhnya, bahwa proposal ini merupakan ilustrasi dan bukan menjadi bagian dari Kontrak Asuransi',1,0,'C', true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->ln(50);

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
		$this->pdf->ln(10);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(89,89,89);
		$this->pdf->Cell(190,5,'JS SAVING PLAN','LTR',0,'C', true);
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'PENAWARAN SAMPAI DENGAN 31 DESEMBER 2018','LBR',0,'C', true);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->ln();
		
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
		$this->pdf->Cell(95,5,'TANDA TANGAN AGEN',0,0,'C');
		$this->pdf->Cell(95,5,'TANDA TANGAN CALON PEMEGANG POLIS',0,0,'C');
		$this->pdf->ln(50);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(95,5,''.$data['hasil']['namaagen'].' ',0,0,'C');
		$this->pdf->Cell(95,5,''.$data['hasil']['nama'].' ',0,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','I',6);
		$this->pdf->Cell(95,5,'Saya telah menjelaskan Ilustrasi ini kepada Calon Pemegang Polis',0,0,'C');
		$this->pdf->Cell(95,5,'Saya telah membaca, memahami dan mengerti resiko dan isi dari ilustrasi ini.',0,0,'C');
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