<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");
	
	error_reporting(0);

class Jsretirementassurance extends CI_Controller{

	
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
			'carabayar' => $this->input->post('carabayar'),
			'besarpremi' => $this->input->post('besarpremi'),
			'uangasuransi' => $this->input->post('uangasuransi'),
			'saatmulaiasuransi' => $this->input->post('saatmulaiasuransi')
			
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
		
		$saatmulaiasuransi = date("Y-m-d", strtotime($this->session->userdata('saatmulaiasuransi')));
		$selisihsaatmulaiasuransi= abs(strtotime($saatmulaiasuransi)- strtotime($lahirnasabah));
		//$xn = floor(65 - $selisihsaatmulaiasuransi/ (365*60*60*24));
		
		
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
		
		$xn = 65 - $data['hasil']['usiacalontertanggung'];
		
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
		$data['hasil']['calontertanggungperokok'] = $this->session->userdata('calontertanggungperokok');
		
		$data['hasil']['besarpremi'] = $this->session->userdata('besarpremi');
		$besarpremi = $data['hasil']['besarpremi'];
		$data['hasil']['uangasuransi'] = $this->session->userdata('uangasuransi');
		
		$data['hasil']['premisekaligus'] = $this->session->userdata('premisekaligus');
		$data['hasil']['masaasuransi'] = $this->session->userdata('masaasuransi');
		$data['hasil']['saatmulaiunitlink'] = $tanggalMulas.' '.$bulanMulas.' '.$tahunMulas;
		
		$data['hasil']['carabayar'] = $this->session->userdata('carabayar');
		//$carabayar  = $data['hasil']['carabayar'];
		if ($data['hasil']['carabayar'] == "Bulanan")
		{
			$carabayar = "bulanan";
			$iuran = 100000;
			$data['hasil']['akumulasipremi'] = $besarpremi * 12;
		}
		else if ($data['hasil']['carabayar'] == "Kuartalan")
		{
			$carabayar = "kuartalan";
			$iuran = 250000;
			$data['hasil']['akumulasipremi'] = $besarpremi * 4;
		}
		else if ($data['hasil']['carabayar'] == "Semesteran")
		{
			$carabayar = "semesteran";
			$iuran = 500000;
			$data['hasil']['akumulasipremi'] = $besarpremi * 2;
		}
		else if ($data['hasil']['carabayar'] == "Tahunan")
		{
			$carabayar = "tahunan";
			$iuran = 1000000;
			$data['hasil']['akumulasipremi'] = $besarpremi * 1;
		}
		else if ($data['hasil']['carabayar'] == "Sekaligus")
		{
			$carabayar = "sekaligus";
			$iuran = 5000000;
			$data['hasil']['akumulasipremi'] = $besarpremi;
		}
		
		$usiacalontertanggung = $data['hasil']['usiacalontertanggung'];
		
		if (($usiacalontertanggung > 19) && ($usiacalontertanggung < 41))
		{
			$rangeusia = 1;
		}
		else if (($usiacalontertanggung > 40) && ($usiacalontertanggung < 56))
		{
			$rangeusia = 2;
		}
		else if ($usiacalontertanggung > 55)
		{
			$rangeusia = 3;
		}	
		
		$data['hasil']['filepdf'] = $this->session->userdata('filepdf');
		$data['hasil']['id_nasabah'] = $this->session->userdata('id_nasabah');
		$data['hasil']['id_agen']	 = $this->session->userdata('id_agen');
		//$data['hasil']['file_pdf']	 = $filePdf.'.pdf',
		$data['hasil']['id_produk']  = $this->session->userdata('id_produk');
		
		$NoProspek = $this->session->userdata('kodeprospek');
		//$NoProspek = 'LC151022000001';
		$DataAgen = $this->ModSimulasi->GetDataAgen($NoProspek);
		$idAgen = $DataAgen['NOAGEN'];
		
		//$data['hasil']['filepdf'] = $filepdf;
		$data['hasil']['nama'] = $this->session->userdata('nama');
		$data['hasil']['namaagen'] = strtoupper(str_replace("-"," ",$this->session->userdata('namaagen')));
		$kodeKantor = $DataAgen['KDKANTOR'];
		$dataKantor = $this->ModSimulasi->cariDataKantor($kodeKantor);
		$data['hasil']['kantorcabang'] = $dataKantor['NAMAKANTOR'];
		$data['hasil']['nomeragen'] = $this->session->userdata('nomeragen');
		
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
			'CARA_BAYAR' => $this->session->userdata('carabayar'),
			'JUMLAH_PREMI' => $data['hasil']['besarpremi']
		);
		
		$this->ModSimulasi->insertSimulasi($data['hitung']);
		
		$data['hasil']['build_id'] = $data['hitung']['BUILD_ID'];
		
		//$result = $this->ModSimulasi->getJSSiharta($carabayar, $rangeusia, $xn);
		$result = $this->ModSimulasi->getJSSiharta($carabayar, $rangeusia);
		
		$data['jsretirementassurance'] = $result;
		$data['pengali'] = ($besarpremi / $iuran);
				
		$filePdf = $this->session->userdata('filepdf');
		
		$this->createPDF($filePdf,$data);
		
		$this->load->view('hasil/jsretirementassurance',$data);
		
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
		$this->pdf->Cell(190,5,'JS Retirement Assurance','B',0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(10);

		// CALON PEMEGANG POLIS
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,4,'CALON PEMEGANG POLIS',1,0,'L', true);
		$this->pdf->ln(4);
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
		$this->pdf->ln(5);

		// CALON TERTANGGUNG
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,4,'CALON TERTANGGUNG',1,0,'L', true);
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
		$this->pdf->ln(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(190,5,'','B',0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Cara Bayar',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['carabayar'].' ',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Besar Premi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,number_format($data['hasil']['besarpremi'],0,'.',','),0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Uang Asuransi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,number_format($data['hasil']['uangasuransi'],0,'.',','),0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Mulai Asuransi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['saatmulaiasuransi'].' ',0,0,'L');
		$this->pdf->ln(5);

		// TABEL
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->SetFillColor(204,255,255);
		$this->pdf->Cell(20,3,'Akhir','LTR',0,'C', true);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->SetFillColor(204,255,255);
		$this->pdf->Cell(26.67,3,'Akumulasi','LTR',0,'C', true);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->SetFillColor(204,255,255);
		$this->pdf->Cell(26.67,3,'Nilai Tunai','LTR',0,'C', true);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->SetFillColor(204,255,255);
		$this->pdf->Cell(26.67,3,'Uang','LTR',0,'C', true);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->SetFillColor(204,255,255);
		$this->pdf->Cell(90,3,'Total dari Manfaat Meninggal Dunia *',1,0,'C', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',6, true);
		$this->pdf->SetFillColor(204,255,255);
		$this->pdf->Cell(20,3,'Tahun','LBR',0,'C', true);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->SetFillColor(204,255,255);
		$this->pdf->Cell(26.67,3,'Premi','LBR',0,'C', true);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->SetFillColor(204,255,255);
		$this->pdf->Cell(26.67,3,'Akhir Tahun','LBR',0,'C', true);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->SetFillColor(204,255,255);
		$this->pdf->Cell(26.67,3,'Asuransi','LBR',0,'C', true);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->SetFillColor(204,255,255);
		$this->pdf->Cell(45,3,'Bukan Karena Kecelakaan',1,0,'C', true);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->SetFillColor(204,255,255);
		$this->pdf->Cell(45,3,'Karena Kecelakaan',1,0,'C', true);
		$this->pdf->ln();
		
		$this->pdf->SetFont('Arial','',6);
		foreach($data['jsretirementassurance'] as $i => $v){
			$this->pdf->SetFont('Arial','B',6);
			$this->pdf->Cell(20,3,($i+1),'LBR',0,'C');
			$this->pdf->SetFont('Arial','B',6);
			if ($data['hasil']['carabayar'] == "Sekaligus")
			{
				$this->pdf->Cell(26.67,3,number_format($data['hasil']['akumulasipremi'],0,'.',','),'LBR',0,'C');
			}
			else
			{
				$this->pdf->Cell(26.67,3,number_format(($i+1) * $data['hasil']['akumulasipremi'],0,'.',','),'LBR',0,'C');
			}
			$this->pdf->SetFont('Arial','B',6);
			$this->pdf->Cell(26.67,3,number_format(($v['NILAITUNAIAKHIRTAHUN']) * $data['pengali'],0,'.',','),'LBR',0,'C');
			$this->pdf->SetFont('Arial','B',6);
			$this->pdf->Cell(26.67,3,number_format(($v['JUAMENINGGALBIASA']) * $data['pengali'],0,'.',','),'LBR',0,'C');
			$this->pdf->SetFont('Arial','B',6);
			$this->pdf->Cell(45,3,number_format(($v['NILAITUNAIAKHIRTAHUN'] * $data['pengali']) + ($v['JUAMENINGGALBIASA'] * $data['pengali']),0,'.',','),1,0,'C');
			$this->pdf->SetFont('Arial','B',6);
			$this->pdf->Cell(45,3,number_format(($v['JUAMENINGGALBIASA'] * $data['pengali']) + ($v['NILAITUNAIAKHIRTAHUN'] * $data['pengali']) + ($v['JUAMENINGGALBIASA'] * $data['pengali']),0,'.',','),1,0,'C');
			$this->pdf->ln();
		}

		
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(10,5,'* :',0,0,'L');
		$this->pdf->Cell(170,5,'Adalah total manfaat yang diberikan yang  sudah memasukan manfaat  nilai tunai.',0,0,'L');

		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(20,5,'Tambahan Manfaat Yang disediakan:',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'a)',0,0,'L');
		$this->pdf->Cell(170,5,'100% Uang Asuransi apabila Tertanggung mengalami Cacat Tetap Total karena Kecelakaan.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'b)',0,0,'L');
		$this->pdf->Cell(170,5,'Apabila Tertanggung mengalami Cacat Tetap Sebagian karena Kecelakaan akan dibayarkan sebesar persentase tertentu dari Uang Asuransi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'c)',0,0,'L');
		$this->pdf->Cell(170,5,'Manfaat Rawat Inap karena Kecelakaan akan dibayarkan sebesar maksimal 10% dari Uang Asuransi.',0,0,'L');

		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(20,5,'Semoga proposal ini dapat memberikan informasi yang memenuhi kebutuhan anda.',0,0,'L');

		$this->pdf->ln(10);
		
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
		$this->pdf->Cell(190,5,'JS Retirement Assurance','B',0,'L');
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