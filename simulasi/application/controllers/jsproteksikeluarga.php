<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");
	
	error_reporting(0);

class Jsproteksikeluarga extends CI_Controller{
	
	function hitungjuaminimalpertertanggung(){
	
		$this->load->model('ModSimulasi');
			
		$status = $this->input->post("status");

		$result = $this->ModSimulasi->getDataJSProteksiKeluarga($status);
		
		echo $result['JUAMINPERTERTANGGUNG'];
	
	}
	
	function hitungjuamaksimumpertertanggung(){
	
		$this->load->model('ModSimulasi');
			
		$status = $this->input->post("status");

		$result = $this->ModSimulasi->getDataJSProteksiKeluarga($status);
		
		echo $result['JUAMAXPERTERTANGGUNG'];
	
	}
	
	function hitungpremitahunanjuapertertanggung(){
	
		$this->load->model('ModSimulasi');
			
		$status = $this->input->post("status");

		$result = $this->ModSimulasi->getDataJSProteksiKeluarga($status);
		
		$uangasuransipertahunjsproteksikeluarga = $this->input->post("uangasuransipertahunjsproteksikeluarga");
		
		$premitahunan = ($uangasuransipertahunjsproteksikeluarga/10000000) * $result['PREMITAHUNANJUA'];
		
		echo $premitahunan;
	
	}
	
	function hitungpremisekaligusjuapertertanggung(){
	
		$this->load->model('ModSimulasi');
			
		$status = $this->input->post("status");

		$result = $this->ModSimulasi->getDataJSProteksiKeluarga($status);
		
		$uangasuransipertahunjsproteksikeluarga = $this->input->post("uangasuransipertahunjsproteksikeluarga");
		
		$premisekaligus = ($uangasuransipertahunjsproteksikeluarga/10000000) * $result['PREMISEKALIGUSJUA'];
		
		echo $premisekaligus;
	
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
			
			'tertanggungayah' => $this->input->post('tertanggungayah'),
			'tertanggungibu' => $this->input->post('tertanggungibu'),
			'tertanggunganak1' => $this->input->post('tertanggunganak1'),
			'tertanggunganak2' => $this->input->post('tertanggunganak2'),
			'tertanggunganak3' => $this->input->post('tertanggunganak3'),
			
			'uangasuransipertahunjsproteksikeluarga' => $this->input->post('uangasuransipertahunjsproteksikeluarga'),
			'premitahunanjsproteksikeluarga' => $this->input->post('premitahunanjsproteksikeluarga'),
			'premisekaligusjsproteksikeluarga' => $this->input->post('premisekaligusjsproteksikeluarga'),
			'masaasuransijsproteksikeluarga' => $this->input->post('masaasuransijsproteksikeluarga'),
			'mulaiasuransijsproteksikeluarga' => $this->input->post('mulaiasuransijsproteksikeluarga'),
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
		
		$tanggalSaatMulaiAsuransi = date("d", strtotime($this->session->userdata('mulaiasuransijsproteksikeluarga')));
		$bulanSaatMulaiAsuransi = $bulan[date("n", strtotime($this->session->userdata('mulaiasuransijsproteksikeluarga')))];
		$tahunSaatMulaiAsuransi = date("Y", strtotime($this->session->userdata('mulaiasuransijsproteksikeluarga')));
		$data['hasil']['mulaiasuransijsproteksikeluarga'] = $tanggalSaatMulaiAsuransi.' '.$bulanSaatMulaiAsuransi.' '.$tahunSaatMulaiAsuransi;
		
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
				
		$data['hasil']['filepdf'] = $this->session->userdata('filepdf');
		$data['hasil']['id_nasabah'] = $this->session->userdata('id_nasabah');
		$data['hasil']['id_agen']	 = $this->session->userdata('id_agen');
		//$data['hasil']['file_pdf']	 = $filePdf.'.pdf',
		$data['hasil']['id_produk']  = $this->session->userdata('id_produk');
		
		$data['hasil']['uangasuransipertahunjsproteksikeluarga']  = $this->session->userdata('uangasuransipertahunjsproteksikeluarga');
		$data['hasil']['premitahunanjsproteksikeluarga']  = $this->session->userdata('premitahunanjsproteksikeluarga');
		$data['hasil']['premisekaligusjsproteksikeluarga']  = $this->session->userdata('premisekaligusjsproteksikeluarga');
		$data['hasil']['masaasuransijsproteksikeluarga']  = $this->session->userdata('masaasuransijsproteksikeluarga');
		
		$data['hasil']['tertanggungayah']  = $this->session->userdata('tertanggungayah');
		$data['hasil']['tertanggungibu']  = $this->session->userdata('tertanggungibu');
		$data['hasil']['tertanggunganak1']  = $this->session->userdata('tertanggunganak1');
		$data['hasil']['tertanggunganak2']  = $this->session->userdata('tertanggunganak2');
		$data['hasil']['tertanggunganak3']  = $this->session->userdata('tertanggunganak3');
		
		if ($data['hasil']['tertanggungayah'] == 0)
		{
				$data['hasil']['jumlahtertanggungayah'] = 'Tidak Ada';
				$data['hasil']['uangtertanggungayah'] = 0;
		}
		else if ($data['hasil']['tertanggungayah'] == 1)
		{
				$data['hasil']['jumlahtertanggungayah'] = 'Ada';
				$data['hasil']['uangtertanggungayah'] = $data['hasil']['uangasuransipertahunjsproteksikeluarga'];
		}
		
		if ($data['hasil']['tertanggungibu'] == 0)
		{
				$data['hasil']['jumlahtertanggungibu'] = 'Tidak Ada';
				$data['hasil']['uangtertanggungibu'] = 0;
		}
		else if ($data['hasil']['tertanggungibu'] == 1)
		{
				$data['hasil']['jumlahtertanggungibu'] = 'Ada';
				$data['hasil']['uangtertanggungibu'] = $data['hasil']['uangasuransipertahunjsproteksikeluarga'];
		}
		
		if ($data['hasil']['tertanggunganak1'] == 0)
		{
				$data['hasil']['jumlahtertanggunganak1'] = 'Tidak Ada';
				$data['hasil']['uangtertanggunganak1'] = 0;
		}
		else if ($data['hasil']['tertanggunganak1'] == 1)
		{
				$data['hasil']['jumlahtertanggunganak1'] = 'Ada';
				$data['hasil']['uangtertanggunganak1'] = $data['hasil']['uangasuransipertahunjsproteksikeluarga'];
		}
		
		if ($data['hasil']['tertanggunganak2'] == 0)
		{
				$data['hasil']['jumlahtertanggunganak2'] = 'Tidak Ada';
				$data['hasil']['uangtertanggunganak2'] = 0;
		}
		else if ($data['hasil']['tertanggunganak2'] == 1)
		{
				$data['hasil']['jumlahtertanggunganak2'] = 'Ada';
				$data['hasil']['uangtertanggunganak2'] = $data['hasil']['uangasuransipertahunjsproteksikeluarga'];
		}
		
		if ($data['hasil']['tertanggunganak3'] == 0)
		{
				$data['hasil']['jumlahtertanggunganak3'] = 'Tidak Ada';
				$data['hasil']['uangtertanggunganak3'] = 0;
		}
		else if ($data['hasil']['tertanggunganak3'] == 1)
		{
				$data['hasil']['jumlahtertanggunganak3'] = 'Ada';
				$data['hasil']['uangtertanggunganak3'] = $data['hasil']['uangasuransipertahunjsproteksikeluarga'];
		}
		
		$data['hasil']['totaljuatertanggung'] = $data['hasil']['uangtertanggungayah'] + 
												$data['hasil']['uangtertanggungibu'] + 
												$data['hasil']['uangtertanggunganak1'] +
												$data['hasil']['uangtertanggunganak2'] +
												$data['hasil']['uangtertanggunganak3'];
		
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
		
		$this->load->view('hasil/jsproteksikeluarga',$data);
		
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
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(65,105,225);
		$this->pdf->Cell(50,5,'CALL 021500151',1,0,'L', true);
		$this->pdf->ln(7);
		$this->pdf->SetFont('Arial','I',8);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(0,0,0);
		$this->pdf->Cell(50,5,'http://www.jiwasraya.co.id',1,0,'L', true);
		$this->pdf->ln(15);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(190,5,'PROPOSAL',0,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(65,105,225);
		$this->pdf->Cell(190,5,'JS PROTEKSI KELUARGA',1,0,'C', true);
		$this->pdf->SetFont('Arial','I',8);
		$this->pdf->SetTextColor(255,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->ln(5);

		// DISAJIKAN UNTUK
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Yth Bapak/Ibu, berikut kami sampaikan ringkasan produk JS Proteksi Keluarga sesuai dengan kebutuhan Bapak/Ibu dan keluarga.',0,0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Disajikan untuk Bapak/Ibu',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,''.$data['hasil']['namalengkapcalontertanggung'].'',0,0,'L');
		$this->pdf->ln(10);

		// DATA PERTANGGUNGAN
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(50,5,'DATA PERTANGGUNGAN',1,0,'L', true);
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(63.3,5,'Tertanggung',1,0,'C');
		$this->pdf->Cell(63.3,5,'Jumlah',1,0,'C');
		$this->pdf->Cell(63.3,5,'Uang Tertanggung',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(63.3,5,'Tertanggung Ayah',1,0,'L');
		$this->pdf->Cell(63.3,5,''.$data['hasil']['jumlahtertanggungayah'].'',1,0,'C');
		$this->pdf->Cell(63.3,5,number_format($data['hasil']['uangtertanggungayah'], 0, ',', '.'),1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(63.3,5,'Tertanggung Ibu',1,0,'L');
		$this->pdf->Cell(63.3,5,''.$data['hasil']['jumlahtertanggungibu'].'',1,0,'C');
		$this->pdf->Cell(63.3,5,number_format($data['hasil']['uangtertanggungibu'], 0, ',', '.'),1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(63.3,5,'Tertanggung Anak1',1,0,'L');
		$this->pdf->Cell(63.3,5,''.$data['hasil']['jumlahtertanggunganak1'].'',1,0,'C');
		$this->pdf->Cell(63.3,5,number_format($data['hasil']['uangtertanggunganak1'], 0, ',', '.'),1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(63.3,5,'Tertanggung Anak2',1,0,'L');
		$this->pdf->Cell(63.3,5,''.$data['hasil']['jumlahtertanggunganak2'].'',1,0,'C');
		$this->pdf->Cell(63.3,5,number_format($data['hasil']['uangtertanggunganak2'], 0, ',', '.'),1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(63.3,5,'Tertanggung Anak3',1,0,'L');
		$this->pdf->Cell(63.3,5,''.$data['hasil']['jumlahtertanggunganak3'].'',1,0,'C');
		$this->pdf->Cell(63.3,5,number_format($data['hasil']['uangtertanggunganak3'], 0, ',', '.'),1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(63.3,5,'Total JUA',1,0,'C');
		$this->pdf->Cell(63.3,5,'',1,0,'C');
		$this->pdf->Cell(63.3,5,number_format($data['hasil']['totaljuatertanggung'], 0, ',', '.'),1,0,'C');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Premi Tahunan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,number_format($data['hasil']['premitahunanjsproteksikeluarga'], 0, ',', '.'),0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Premi Sekaligus',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,number_format($data['hasil']['premisekaligusjsproteksikeluarga'], 0, ',', '.'),0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Masa Asuransi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,''.$data['hasil']['masaasuransijsproteksikeluarga'].' Tahun',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Mulai Asuransi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,''.$data['hasil']['mulaiasuransijsproteksikeluarga'].'',0,0,'L');
		$this->pdf->ln(10);

		// MANFAAT ASURANSI
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(50,5,'Manfaat Asuransi',1,0,'L', true);
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Apabila anggota keluarga meninggal dunia karena sakit atau kecelakaan selama Masa Asuransi, maka akan dibayarkan 100% Jumlah Uang Asuransi',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(50,5,'JS Proteksi Keluarga.',0,0,'L');
		$this->pdf->ln(10);

		// ILUSTRASI MANFAAT
		$this->pdf->Cell(50,5,'Ilustrasi Manfaat',1,0,'L', true);
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Apabila terjadi risiko Meninggal Dunia terhadap salah seorang Tertanggung pada Masa Asuransi, maka Jiwasraya akan membayarkan sebesar Uang',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(50,5,'Asuransi Rp.'.number_format($data['hasil']['uangasuransipertahunjsproteksikeluarga'], 0, ',', '.').' kepada Penerima Manfaat.',0,0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Semoga proposal ini dapat memberikan informasi dan membantu Anda merencanakan masa depan keluarga.',0,0,'L');
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
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(65,105,225);
		$this->pdf->Cell(50,5,'CALL 021500151',1,0,'L', true);
		$this->pdf->ln(7);
		$this->pdf->SetFont('Arial','I',8);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(0,0,0);
		$this->pdf->Cell(50,5,'http://www.jiwasraya.co.id',1,0,'L', true);
		$this->pdf->ln(15);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(190,5,'PROPOSAL',0,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(65,105,225);
		$this->pdf->Cell(190,5,'JS PROTEKSI KELUARGA',1,0,'C', true);
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','I',8);
		$this->pdf->SetTextColor(255,0,0);
		$this->pdf->Cell(190,5,'Proteksi financial keluarga Anda!','0',0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(200,200,200);
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
		$this->pdf->ln(60);

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