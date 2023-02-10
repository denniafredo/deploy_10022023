<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");
	
	error_reporting(0);

class Akdp extends CI_Controller{
	
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
			
			'uangasuransiakdp' => $this->input->post('uangasuransiakdp'),
			'jenisplan' => $this->input->post('jenisplan'),
			'mulaiasuransi' => $this->input->post('mulaiasuransi'),
			'kelasrisiko' => $this->input->post('kelasrisiko'),
			'masaasuransiakdp' => $this->input->post('masaasuransiakdp'),
			'premiakdp' => $this->input->post('premiakdp'),
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
		
		$tanggalSaatMulaiAsuransi = date("d", strtotime($this->session->userdata('mulaiasuransi')));
		$bulanSaatMulaiAsuransi = $bulan[date("n", strtotime($this->session->userdata('mulaiasuransi')))];
		$tahunSaatMulaiAsuransi = date("Y", strtotime($this->session->userdata('mulaiasuransi')));
		$data['hasil']['mulaiasuransi'] = $tanggalSaatMulaiAsuransi.' '.$bulanSaatMulaiAsuransi.' '.$tahunSaatMulaiAsuransi;
		
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
		
		$data['hasil']['uangasuransiakdp']  = $this->session->userdata('uangasuransiakdp');
		$data['hasil']['jenisplan']  = $this->session->userdata('jenisplan');
		$data['hasil']['kelasrisiko']  = $this->session->userdata('kelasrisiko');
		$data['hasil']['premiakdp']  = $this->session->userdata('premiakdp');
		
		$data['hasil']['masaasuransiakdp']  = $this->session->userdata('masaasuransiakdp');
		
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
			'CARA_BAYAR' => 'Sekaligus',
			'JUMLAH_PREMI' => $data['hasil']['premiakdp']
		);
		
		$this->ModSimulasi->insertSimulasi($data['hitung']);
		
		$data['hasil']['build_id'] = $data['hitung']['BUILD_ID'];
				
		$filePdf = $this->session->userdata('filepdf');
		
		$this->createPDF($filePdf,$data);
		
		$this->load->view('hasil/akdp',$data);
		
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
		$this->pdf->Cell(190,4,'PT ASURANSI JIWASRAYA (PERSERO)',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(190,4,'Jl. Ir. H. Juanda No. 34 Jakarta - 10120',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(65,105,225);
		$this->pdf->Cell(50,4,'CALL 021500151',1,0,'L', true);
		$this->pdf->ln(7);
		$this->pdf->SetFont('Arial','I',8);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(0,0,0);
		$this->pdf->Cell(50,4,'http://www.jiwasraya.co.id',1,0,'L', true);
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','IB',14);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->Cell(80,4,'JS',0,0,'C');
		$this->pdf->SetTextColor(255,51,0);
		$this->pdf->SetFillColor(65,105,225);
		$this->pdf->Cell(35,4,'Asuransi Kecelakaan Diri Perorangan (AKDP)',0,0,'C');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->ln(8);

		// DATA PERTANGGUNGAN
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(50,4,'DATA PERTANGGUNGAN',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,4,'Tertanggung',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,4,''.$data['hasil']['namalengkapcalontertanggung'].' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,4,'Uang Asuransi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,4,'Rp. '.number_format($data['hasil']['uangasuransiakdp'], 0, ',', '.').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,4,'Jenis Plan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,4,''.$data['hasil']['jenisplan'].' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,4,'Mulai Asuransi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,4,''.$data['hasil']['mulaiasuransi'].' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,4,'Kelas Risiko',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,4,''.$data['hasil']['kelasrisiko'].' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,4,'Premi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,4,'Rp. '.number_format($data['hasil']['premiakdp'], 0, ',', '.').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,4,'Masa Asuransi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,4,''.$data['hasil']['masaasuransiakdp'].' Tahun',0,0,'L');
		$this->pdf->ln();

		// MANFAAT ASURANSI
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetFillColor(0,32,96);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->Cell(190,4,'Manfaat Asuransi',1,0,'L', true);

		if ($data['hasil']['jenisplan']== 'Plan A')
		{
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetFillColor(216,216,216);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->Cell(190,4,'PLAN A',1,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(190,4,'a. Apabila terjadi risiko meninggal dunia karena kecelakaan terhadap Tertanggung, maka akan dibayarkan 100% Uang Asuransi  Kecelakaan Diri',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(3);
		$this->pdf->Cell(70,4,'Perorangan Sebesar',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(10,4,'Rp. '.number_format($data['hasil']['uangasuransiakdp'], 0, ',', '.').'.',0,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(190,4,'b. Apabila terjadi risiko cacat tetap total atau sebagian karena kecelakaan, maka kepada Tertanggung akan dibayarkan maksimal sebesar 250% Uang',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(3);
		$this->pdf->Cell(70,4,'Asuransi Kecelakaan Diri Perorangan.',0,0,'L');
		}
		else
		{
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetFillColor(216,216,216);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->Cell(190,4,'PLAN B',1,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(190,4,'a. Apabila terjadi risiko meninggal karena kecelakaan dunia terhadap Tertanggung, maka akan dibayarkan 100% Uang Asuransi Kecelakaan Diri',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(3);
		$this->pdf->Cell(70,4,'Perorangan Sebesar',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(10,4,'Rp. '.number_format($data['hasil']['uangasuransiakdp'], 0, ',', '.').'.',0,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(190,4,'b. Apabila terjadi risiko cacat tetap total atau sebagian karena kecelakaan, maka kepada Tertanggung akan dibayarkan maksimal sebesar 250%',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(3);
		$this->pdf->Cell(70,4,'Uang Asuransi Kecelakaan Diri Perorangan Tabel Terlampir.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(190,4,'c. Apabila Tertanggung menjalani Rawat Inap di Rumah Sakit akibat kecelakaan, maka akan dibayarkan sesuai dengan kuitansi atau maksimal 40%.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetFillColor(216,216,216);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->Cell(190,4,'1.  Rawat Inap di Rumah Sakit',1,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5,4,'',0,0,'L');
		$this->pdf->Cell(5,4,'*',0,0,'L');
		$this->pdf->Cell(90,4,'Per Kecelakaan maksimal',0,0,'L');
		$this->pdf->Cell(10,4,'40%',0,0,'L');
		$this->pdf->Cell(10,4,'=',0,0,'L');
		$this->pdf->Cell(80,4,'Rp. '.number_format($data['hasil']['uangasuransiakdp']*40/100, 0, ',', '.').' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5,4,'',0,0,'L');
		$this->pdf->Cell(5,4,'',0,0,'L');
		$this->pdf->Cell(90,4,'(Maksimal 2 x Kecelakaan/tahun)',0,0,'L');
		$this->pdf->Cell(10,4,'',0,0,'L');
		$this->pdf->Cell(10,4,'',0,0,'L');
		$this->pdf->Cell(80,4,'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetFillColor(216,216,216);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->Cell(190,4,'2.  Cacad Tetap seluruhnya',1,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5,4,'',0,0,'L');
		$this->pdf->Cell(5,4,'*',0,0,'L');
		$this->pdf->Cell(90,4,'Jaminan Atas Resiko',0,0,'L');
		$this->pdf->Cell(10,4,'250%',0,0,'L');
		$this->pdf->Cell(10,4,'=',0,0,'L');
		$this->pdf->Cell(80,4,'Rp. '.number_format($data['hasil']['uangasuransiakdp']*250/100, 0, ',', '.').' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetFillColor(216,216,216);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->Cell(190,4,'3.  Cacad tetap Sebagian',1,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5,4,'',0,0,'L');
		$this->pdf->Cell(5,4,'*',0,0,'L');
		$this->pdf->Cell(90,4,'Lengan kanan mulai dari pundak kebawah',0,0,'L');
		$this->pdf->Cell(10,4,'70%',0,0,'L');
		$this->pdf->Cell(10,4,'=',0,0,'L');
		$this->pdf->Cell(80,4,'Rp. '.number_format($data['hasil']['uangasuransiakdp']*70/100, 0, ',', '.').' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5,4,'',0,0,'L');
		$this->pdf->Cell(5,4,'*',0,0,'L');
		$this->pdf->Cell(90,4,'Lengan kiri mulai dari pundak kebawah',0,0,'L');
		$this->pdf->Cell(10,4,'56%',0,0,'L');
		$this->pdf->Cell(10,4,'=',0,0,'L');
		$this->pdf->Cell(80,4,'Rp. '.number_format($data['hasil']['uangasuransiakdp']*56/100, 0, ',', '.').' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5,4,'',0,0,'L');
		$this->pdf->Cell(5,4,'*',0,0,'L');
		$this->pdf->Cell(90,4,'Lengan kanan mulai dari siku/atas siku kebawah',0,0,'L');
		$this->pdf->Cell(10,4,'65%',0,0,'L');
		$this->pdf->Cell(10,4,'=',0,0,'L');
		$this->pdf->Cell(80,4,'Rp. '.number_format($data['hasil']['uangasuransiakdp']*65/100, 0, ',', '.').' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5,4,'',0,0,'L');
		$this->pdf->Cell(5,4,'*',0,0,'L');
		$this->pdf->Cell(90,4,'Lengan kiri mulai dari siku/atas siku kebawah',0,0,'L');
		$this->pdf->Cell(10,4,'52%',0,0,'L');
		$this->pdf->Cell(10,4,'=',0,0,'L');
		$this->pdf->Cell(80,4,'Rp. '.number_format($data['hasil']['uangasuransiakdp']*52/100, 0, ',', '.').' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5,4,'',0,0,'L');
		$this->pdf->Cell(5,4,'*',0,0,'L');
		$this->pdf->Cell(90,4,'Tangan kanan mulai pergelangan/atas pergelangan kebawah',0,0,'L');
		$this->pdf->Cell(10,4,'60%',0,0,'L');
		$this->pdf->Cell(10,4,'=',0,0,'L');
		$this->pdf->Cell(80,4,'Rp. '.number_format($data['hasil']['uangasuransiakdp']*60/100, 0, ',', '.').' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5,4,'',0,0,'L');
		$this->pdf->Cell(5,4,'*',0,0,'L');
		$this->pdf->Cell(90,4,'Tangan kiri mulai pergelangan/atas pergelangan kebawah',0,0,'L');
		$this->pdf->Cell(10,4,'50%',0,0,'L');
		$this->pdf->Cell(10,4,'=',0,0,'L');
		$this->pdf->Cell(80,4,'Rp. '.number_format($data['hasil']['uangasuransiakdp']*50/100, 0, ',', '.').' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5,4,'',0,0,'L');
		$this->pdf->Cell(5,4,'*',0,0,'L');
		$this->pdf->Cell(90,4,'Sebelah kaki dari pinggul kebawah',0,0,'L');
		$this->pdf->Cell(10,4,'50%',0,0,'L');
		$this->pdf->Cell(10,4,'=',0,0,'L');
		$this->pdf->Cell(80,4,'Rp. '.number_format($data['hasil']['uangasuransiakdp']*50/100, 0, ',', '.').' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5,4,'',0,0,'L');
		$this->pdf->Cell(5,4,'*',0,0,'L');
		$this->pdf->Cell(90,4,'Kedua belah kaki dari mata kaki kebawah',0,0,'L');
		$this->pdf->Cell(10,4,'70%',0,0,'L');
		$this->pdf->Cell(10,4,'=',0,0,'L');
		$this->pdf->Cell(80,4,'Rp. '.number_format($data['hasil']['uangasuransiakdp']*70/100, 0, ',', '.').' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5,4,'',0,0,'L');
		$this->pdf->Cell(5,4,'*',0,0,'L');
		$this->pdf->Cell(90,4,'Sebelah kaki dari mata kaki kebawah',0,0,'L');
		$this->pdf->Cell(10,4,'35%',0,0,'L');
		$this->pdf->Cell(10,4,'=',0,0,'L');
		$this->pdf->Cell(80,4,'Rp. '.number_format($data['hasil']['uangasuransiakdp']*35/100, 0, ',', '.').' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5,4,'',0,0,'L');
		$this->pdf->Cell(5,4,'*',0,0,'L');
		$this->pdf->Cell(90,4,'Penglihatan sebelah mata',0,0,'L');
		$this->pdf->Cell(10,4,'50%',0,0,'L');
		$this->pdf->Cell(10,4,'=',0,0,'L');
		$this->pdf->Cell(80,4,'Rp. '.number_format($data['hasil']['uangasuransiakdp']*50/100, 0, ',', '.').' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5,4,'',0,0,'L');
		$this->pdf->Cell(5,4,'*',0,0,'L');
		$this->pdf->Cell(90,4,'Pendengaran kedua belah telinga',0,0,'L');
		$this->pdf->Cell(10,4,'50%',0,0,'L');
		$this->pdf->Cell(10,4,'=',0,0,'L');
		$this->pdf->Cell(80,4,'Rp. '.number_format($data['hasil']['uangasuransiakdp']*50/100, 0, ',', '.').' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5,4,'',0,0,'L');
		$this->pdf->Cell(5,4,'*',0,0,'L');
		$this->pdf->Cell(90,4,'Pendengaran sebelah telinga',0,0,'L');
		$this->pdf->Cell(10,4,'15%',0,0,'L');
		$this->pdf->Cell(10,4,'=',0,0,'L');
		$this->pdf->Cell(80,4,'Rp. '.number_format($data['hasil']['uangasuransiakdp']*15/100, 0, ',', '.').' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5,4,'',0,0,'L');
		$this->pdf->Cell(5,4,'*',0,0,'L');
		$this->pdf->Cell(90,4,'Ibu jari tangan kanan',0,0,'L');
		$this->pdf->Cell(10,4,'25%',0,0,'L');
		$this->pdf->Cell(10,4,'=',0,0,'L');
		$this->pdf->Cell(80,4,'Rp. '.number_format($data['hasil']['uangasuransiakdp']*25/100, 0, ',', '.').' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5,4,'',0,0,'L');
		$this->pdf->Cell(5,4,'*',0,0,'L');
		$this->pdf->Cell(90,4,'Ibu jari tangan kiri',0,0,'L');
		$this->pdf->Cell(10,4,'20%',0,0,'L');
		$this->pdf->Cell(10,4,'=',0,0,'L');
		$this->pdf->Cell(80,4,'Rp. '.number_format($data['hasil']['uangasuransiakdp']*20/100, 0, ',', '.').' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5,4,'',0,0,'L');
		$this->pdf->Cell(5,4,'*',0,0,'L');
		$this->pdf->Cell(90,4,'Jari telunjuk kanan',0,0,'L');
		$this->pdf->Cell(10,4,'25%',0,0,'L');
		$this->pdf->Cell(10,4,'=',0,0,'L');
		$this->pdf->Cell(80,4,'Rp. '.number_format($data['hasil']['uangasuransiakdp']*25/100, 0, ',', '.').' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5,4,'',0,0,'L');
		$this->pdf->Cell(5,4,'*',0,0,'L');
		$this->pdf->Cell(90,4,'Jari telunjuk kiri',0,0,'L');
		$this->pdf->Cell(10,4,'12%',0,0,'L');
		$this->pdf->Cell(10,4,'=',0,0,'L');
		$this->pdf->Cell(80,4,'Rp. '.number_format($data['hasil']['uangasuransiakdp']*12/100, 0, ',', '.').' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5,4,'',0,0,'L');
		$this->pdf->Cell(5,4,'*',0,0,'L');
		$this->pdf->Cell(90,4,'Salah satu jari selain ibu jari dan jari telunjuk tangan kanan',0,0,'L');
		$this->pdf->Cell(10,4,'5%',0,0,'L');
		$this->pdf->Cell(10,4,'=',0,0,'L');
		$this->pdf->Cell(80,4,'Rp. '.number_format($data['hasil']['uangasuransiakdp']*5/100, 0, ',', '.').' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5,4,'',0,0,'L');
		$this->pdf->Cell(5,4,'*',0,0,'L');
		$this->pdf->Cell(90,4,'Salah satu jari selain ibu jari dan jari telunjuk tangan kiri',0,0,'L');
		$this->pdf->Cell(10,4,'4%',0,0,'L');
		$this->pdf->Cell(10,4,'=',0,0,'L');
		$this->pdf->Cell(80,4,'Rp. '.number_format($data['hasil']['uangasuransiakdp']*4/100, 0, ',', '.').' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5,4,'',0,0,'L');
		$this->pdf->Cell(5,4,'*',0,0,'L');
		$this->pdf->Cell(90,4,'Salah satu ibu jari kaki',0,0,'L');
		$this->pdf->Cell(10,4,'4%',0,0,'L');
		$this->pdf->Cell(10,4,'=',0,0,'L');
		$this->pdf->Cell(80,4,'Rp. '.number_format($data['hasil']['uangasuransiakdp']*4/100, 0, ',', '.').' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5,4,'',0,0,'L');
		$this->pdf->Cell(5,4,'*',0,0,'L');
		$this->pdf->Cell(90,4,'Salah satu jari selain ibu jari kaki',0,0,'L');
		$this->pdf->Cell(10,4,'3%',0,0,'L');
		$this->pdf->Cell(10,4,'=',0,0,'L');
		$this->pdf->Cell(80,4,'Rp. '.number_format($data['hasil']['uangasuransiakdp']*3/100, 0, ',', '.').' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(5,4,'',0,0,'L');
		$this->pdf->Cell(5,4,'*',0,0,'L');
		$this->pdf->Cell(90,4,'Maksimal Cacad Tetap Sebagian',0,0,'L');
		$this->pdf->Cell(10,4,'250%',0,0,'L');
		$this->pdf->Cell(10,4,'=',0,0,'L');
		$this->pdf->Cell(80,4,'Rp. '.number_format($data['hasil']['uangasuransiakdp']*250/100, 0, ',', '.').' ',0,0,'L');
		}
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','I',8);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(0,32,92);
		$this->pdf->Cell(190,4,'Masa Asuransi dapat diperpanjang otomatis setiap tahun, pilihan perpanjangan terdapat di SPAJ',1,0,'C', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','I',8);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(255,51,0);
		$this->pdf->Cell(190,4,'Maksimal Kecelakaan dalam masa asuransi (Satu Tahun)',1,0,'C', true);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->ln(5);

		// FOOTER
		$this->pdf->Cell(190,4,'','B',0,'L');
		$this->pdf->ln(10);

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(13,4,'Disajikan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,4,''.$data['hasil']['namaagen'].' ',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(13,4,'Kode Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,4,''.$data['hasil']['nomeragen'].' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,4,'Tanda Tangan Agen','LTR',0,'C');
		$this->pdf->Cell(40,4,'Tanda Tangan Calon Pemegang Polis','LTR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(13,4,'Tanggal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,4,''.$data['hasil']['tanggalsekarang'].' ',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(13,4,'Kantor Cabang',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,4,''.$data['hasil']['kantorcabang'].' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,4,'','LR',0,'C');
		$this->pdf->Cell(40,4,'','LR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(13,4,'Build ID',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,4,$data['hasil']['buildID'],0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(13,4,'',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,'',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,4,''.$data['hasil'][''].' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,4,'','LBR',0,'C');
		$this->pdf->Cell(40,4,'','LBR',0,'C');

		$this->pdf->ln(10);
		$this->pdf->AliasNbPages('{totalPages}');
		$this->pdf->Cell(190, 5, "Page " . $this->pdf->PageNo() . "/{totalPages}",' ', 0, 'R');

		// PAGE 2
		$this->pdf->AddPage();

		// HEADER
		$this->pdf->Image($image1, 170, 5);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',14);
		$this->pdf->Cell(190,4,'PT ASURANSI JIWASRAYA (PERSERO)',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(190,4,'Jl. Ir. H. Juanda No. 34 Jakarta - 10120',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(65,105,225);
		$this->pdf->Cell(50,4,'CALL 021500151',1,0,'L', true);
		$this->pdf->ln(7);
		$this->pdf->SetFont('Arial','I',8);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(0,0,0);
		$this->pdf->Cell(50,4,'http://www.jiwasraya.co.id',1,0,'L', true);
		$this->pdf->ln(15);
		$this->pdf->SetFont('Arial','IB',14);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->Cell(80,4,'JS',0,0,'C');
		$this->pdf->SetTextColor(255,51,0);
		$this->pdf->SetFillColor(65,105,225);
		$this->pdf->Cell(35,4,'Asuransi Kecelakaan Diri Perorangan (AKDP)',0,0,'C');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',7.5);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(65,105,225);
		$this->pdf->Cell(190,4,'Ilustrasi ini hanya merupakan pendekatan/proyeksi dari jumlah dana yang diinvestaasikan dan bukan merupakan baagian dari kontrak asuransi',1,0,'C', true);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->ln(10);

		// DISAJIKAN OLEH
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(190,4,'DISAJIKAN OLEH',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,4,'Nama Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,4,''.$data['hasil']['namaagen'].' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,4,'Nomor Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,4,''.$data['hasil']['nomeragen'].' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,4,'Tanggal Proposal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,4,''.$data['hasil']['tanggalsekarang'].' ',0,0,'L');
		$this->pdf->ln(20);

		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(95,4,'TANDA TANGAN AGEN',0,0,'L');
		$this->pdf->Cell(95,4,'TANDA TANGAN CALON PEMEGANG POLIS',0,0,'L');
		$this->pdf->ln(50);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(95,4,''.$data['hasil']['namaagen'].' ',0,0,'L');
		$this->pdf->Cell(95,4,''.$data['hasil']['nama'].' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','I',6);
		$this->pdf->Cell(95,4,'Saya telah menjelaskan Ilustrasi ini kepada Calon Pemegang Polis',0,0,'L');
		$this->pdf->Cell(95,4,'Saya telah membaca, memahami dan mengerti resiko dan isi dari ilustrasi ini.',0,0,'L');
		$this->pdf->ln(70);

		// FOOTER
		$this->pdf->Cell(190,4,'','B',0,'L');
		$this->pdf->ln(10);

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(13,4,'Disajikan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,4,''.$data['hasil']['namaagen'].' ',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(13,4,'Kode Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,4,''.$data['hasil']['nomeragen'].' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,4,'Tanda Tangan Agen','LTR',0,'C');
		$this->pdf->Cell(40,4,'Tanda Tangan Calon Pemegang Polis','LTR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(13,4,'Tanggal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,4,''.$data['hasil']['tanggalsekarang'].' ',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(13,4,'Kantor Cabang',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,4,''.$data['hasil']['kantorcabang'].' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,4,'','LR',0,'C');
		$this->pdf->Cell(40,4,'','LR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(13,4,'Build ID',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,4,$data['hasil']['buildID'],0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(13,4,'',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,'',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(29,4,''.$data['hasil'][''].' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,4,'','LBR',0,'C');
		$this->pdf->Cell(40,4,'','LBR',0,'C');

		$this->pdf->ln(10);
		$this->pdf->AliasNbPages('{totalPages}');
		$this->pdf->Cell(190, 5, "Page " . $this->pdf->PageNo() . "/{totalPages}",' ', 0, 'R');
		
	    $this->pdf->Output('./files/pdf/'.$namaFile.'.pdf','F');
	  
	}	

}	