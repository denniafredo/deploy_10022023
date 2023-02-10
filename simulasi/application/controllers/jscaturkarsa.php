<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");

	error_reporting(0);

class Jscaturkarsa extends CI_Controller{

	function hitungbeasiswayangditerimajscaturkarsa(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		//$masaasuransi = $this->input->post("masaasuransi");		
		//$usiasekarang = $this->input->post("usiasekarang");
		//$result = $this->ModSimulasi->getBeasiswaYangDiterimaJSCaturKarsa($masaasuransi, $usiasekarang);
		
		$hasil = $uangasuransipokok / 60;
		
		echo round($hasil);
	}
	
	function hitungpremisekaligusjscaturkarsa(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		$result = $this->ModSimulasi->getPremiSekaligusJSCaturKarsa($masaasuransi, $usiasekarang);
		
		$hasil = ($result['TARIF'] * ($uangasuransipokok / 1000));
		
		echo round($hasil);
	}
	
	function hitungpremitahunanjscaturkarsa(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		$result = $this->ModSimulasi->getPremiTahunanJSCaturKarsa($masaasuransi, $usiasekarang);
		
		$hasil = ($result['TARIF'] * ($uangasuransipokok / 1000) * 1.05);
		
		echo round($hasil);
	}
	
	function hitungpremisemesteranjscaturkarsa(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		$result = $this->ModSimulasi->getPremiTahunanJSCaturKarsa($masaasuransi, $usiasekarang);
		
		$hasil = (($result['TARIF'] * ($uangasuransipokok / 1000) * 1.05) * 0.52);
		
		echo round($hasil);
	}
	
	function hitungpremikwartalanjscaturkarsa(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		$result = $this->ModSimulasi->getPremiTahunanJSCaturKarsa($masaasuransi, $usiasekarang);
		
		$hasil = (($result['TARIF'] * ($uangasuransipokok / 1000) * 1.05) * 0.27);
		
		echo round($hasil);
	}
	
	function hitungpremibulananjscaturkarsa(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		$masaasuransi = $this->input->post("masaasuransi");		
		$usiasekarang = $this->input->post("usiasekarang");
		$result = $this->ModSimulasi->getPremiTahunanJSCaturKarsa($masaasuransi, $usiasekarang);
		
		$hasil = (($result['TARIF'] * ($uangasuransipokok / 1000) * 1.05) * 0.095);
		
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
			//'namaagen' => $this->input->post('namaagen'),
			//'kantorcabang' => $this->input->post('kantorcabang'),
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
			'namaagen' => $this->input->post('namaagen'),
			'kodekantor' => $this->input->post('kodekantor'),
			//'kantorcabang' => $this->input->post('kantorcabang'),
			'premisekaligus' => $this->input->post('premisekaligus'),
			'modul' => $this->input->post('modul'),
			//'namaagen' => $this->input->post('namaagen'),
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
			'saatmulaiasuransi' => $this->input->post('saatmulaiasuransi'),
			'namaanaktertanggung' => $this->input->post('namaanaktertanggung'),
			'umuranak' => $this->input->post('umuranak'),
			'tabelbeasiswayangditerima' => $this->input->post('tabelbeasiswayangditerima'),
			'tabelpremisekaligus' => $this->input->post('tabelpremisekaligus'),
			'tabelpremitahunan' => $this->input->post('tabelpremitahunan'),
			'tabelpremisemesteran' => $this->input->post('tabelpremisemesteran'),
			'tabelpremikwartalan' => $this->input->post('tabelpremikwartalan'),
			'tabelpremibulanan' => $this->input->post('tabelpremibulanan'),
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
		
		//if ($this->session->userdata('saatmulaiasuransi') > 12)
		//{
			//$this->session->userdata('saatmulaiasuransi') = $this->session->userdata('saatmulaiasuransi') - 12;
			$tanggalSaatMulaiAsuransi = date("d", strtotime($this->session->userdata('saatmulaiasuransi')));
			$bulanSaatMulaiAsuransi = $bulan[date("n", strtotime($this->session->userdata('saatmulaiasuransi')))];
			$bulanPembayaranSekaligus = $bulan[date("n", strtotime($this->session->userdata('saatmulaiasuransi'))) + 1];
			$tahunSaatMulaiAsuransi = date("Y", strtotime($this->session->userdata('saatmulaiasuransi')));
			$data['hasil']['saatmulaiasuransi'] = $tanggalSaatMulaiAsuransi.' '.$bulanSaatMulaiAsuransi.' '.$tahunSaatMulaiAsuransi;
		//}
		//else
		//{
			$tanggalSaatMulaiAsuransi = date("d", strtotime($this->session->userdata('saatmulaiasuransi')));
			$bulanSaatMulaiAsuransi = $bulan[date("n", strtotime($this->session->userdata('saatmulaiasuransi')))];
			$bulanPembayaranSekaligus = $bulan[date("n", strtotime($this->session->userdata('saatmulaiasuransi'))) + 1];
			$tahunSaatMulaiAsuransi = date("Y", strtotime($this->session->userdata('saatmulaiasuransi')));
			$data['hasil']['saatmulaiasuransi'] = $tanggalSaatMulaiAsuransi.' '.$bulanSaatMulaiAsuransi.' '.$tahunSaatMulaiAsuransi;
		    
		//}

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
		
		$data['hasil']['filepdf'] = $this->session->userdata('filepdf');
		$data['hasil']['id_nasabah'] = $this->session->userdata('id_nasabah');
		$data['hasil']['id_agen']	 = $this->session->userdata('id_agen');
		//$data['hasil']['file_pdf']	 = $filePdf.'.pdf',
		$data['hasil']['id_produk']  = $this->session->userdata('id_produk');
		
		$data['hasil']['namaanaktertanggung'] = $this->session->userdata('namaanaktertanggung');
		$data['hasil']['umuranak'] = $this->session->userdata('umuranak');
		
		$data['hasil']['tabelbeasiswayangditerima']  = $this->session->userdata('tabelbeasiswayangditerima');
		$data['hasil']['tabelpremisekaligus']  = $this->session->userdata('tabelpremisekaligus');
		$data['hasil']['tabelpremitahunan']  = $this->session->userdata('tabelpremitahunan');
		$data['hasil']['tabelpremisemesteran']  = $this->session->userdata('tabelpremisemesteran');
		$data['hasil']['tabelpremikwartalan']  = $this->session->userdata('tabelpremikwartalan');
		$data['hasil']['tabelpremibulanan']  = $this->session->userdata('tabelpremibulanan');
		
		$data['hasil']['saatanakberusia6th'] = $tanggalSaatMulaiAsuransi.' '.$bulanSaatMulaiAsuransi.' '.(($tahunSaatMulaiAsuransi+6) - $data['hasil']['umuranak']);
		$data['hasil']['saatanakberusia12th'] = $tanggalSaatMulaiAsuransi.' '.$bulanSaatMulaiAsuransi.' '.((($tahunSaatMulaiAsuransi+6) - $data['hasil']['umuranak']) + 6);
		$data['hasil']['saatanakberusia15th'] = $tanggalSaatMulaiAsuransi.' '.$bulanSaatMulaiAsuransi.' '.(((($tahunSaatMulaiAsuransi+6) - $data['hasil']['umuranak']) + 6) + 3);
		$data['hasil']['saatanakberusia18th'] = $tanggalSaatMulaiAsuransi.' '.$bulanSaatMulaiAsuransi.' '.((((($tahunSaatMulaiAsuransi+6) - $data['hasil']['umuranak']) + 6) + 3) + 3);
		
		$data['hasil']['saatpembayaranberkala'] = $tanggalSaatMulaiAsuransi.' '.$bulanPembayaranSekaligus.' '.((((($tahunSaatMulaiAsuransi+6) - $data['hasil']['umuranak']) + 6) + 3) + 3);
		
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
			'CARA_BAYAR' => 'Sekaligus, Tahunan, Semesteran, Kwartalan, Bulanan',
			'JUMLAH_PREMI' => $data['hasil']['uangasuransipokok']
		);
		
		$this->ModSimulasi->insertSimulasi($data['hitung']);
		
		$data['hasil']['build_id'] = $data['hitung']['BUILD_ID'];
				
		$filePdf = $this->session->userdata('filepdf');
		
		$this->createPDF($filePdf,$data);
		
		$this->load->view('hasil/jscaturkarsa',$data);
		
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
		$this->pdf->Cell(190,5,'JS Catur Karsa (Program Beasiswa 5 Tahun)','B',0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(10);
		
		//MANFAAT
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Nama',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(32,5,''.$data['hasil']['namalengkapcalontertanggung'].' ',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Umur Tertanggung',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(32,5,''.$data['hasil']['usiacalontertanggung'].' Tahun',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Nama Anak Tertanggung',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(32,5,''.$data['hasil']['namaanaktertanggung'].' ',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Umur Anak Tertanggung',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(32,5,''.$data['hasil']['umuranak'].' Tahun',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Masa Pembayaran Premi',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(32,5,''.$data['hasil']['masaasuransi'].' Tahun',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Bea Siswa setiap Bulan',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['tabelbeasiswayangditerima'],0,'.',',').'',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Uang Asuransi',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Saat Mulai',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(32,5,$data['hasil']['saatmulaiasuransi'],0,0,'L');
		$this->pdf->ln(10);
		
		$this->pdf->SetFillColor(240,248,255);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(190,5,'Manfaat Asuransi',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(190,5,'1. Pembayaran Sekaligus Sebesar',1,0,'L', true);
		$this->pdf->ln(10);
		$this->pdf->SetFillColor(0,0,128);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(63.33,5,'Manfaat Asuransi',1,0,'C', true);
		$this->pdf->Cell(63.33,5,'Diterima Pada Tanggal',1,0,'C', true);
		$this->pdf->Cell(63.33,5,'Tahapan Usia Anak',1,0,'C', true);
		$this->pdf->SetFillColor(240,248,255);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->ln();
		$this->pdf->Cell(63.33,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'] * 0.1,0,'.',','),'LR',0,'C');
		$this->pdf->Cell(63.33,5,$data['hasil']['saatanakberusia6th'],'LR',0,'C');
		$this->pdf->Cell(63.33,5,'(saat anak berusia 6th)','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(63.33,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'] * 0.2,0,'.',','),'LR',0,'C');
		$this->pdf->Cell(63.33,5,$data['hasil']['saatanakberusia12th'],'LR',0,'C');
		$this->pdf->Cell(63.33,5,'(saat anak berusia 12th)','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(63.33,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'] * 0.3,0,'.',','),'LR',0,'C');
		$this->pdf->Cell(63.33,5,$data['hasil']['saatanakberusia15th'],'LR',0,'C');
		$this->pdf->Cell(63.33,5,'(saat anak berusia 15th)','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(63.33,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'] * 0.5,0,'.',','),'LBR',0,'C');
		$this->pdf->Cell(63.33,5,$data['hasil']['saatanakberusia18th'],'LBR',0,'C');
		$this->pdf->Cell(63.33,5,'(saat anak berusia 18th)','LBR',0,'C');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(190,5,'2. Pembayaran Berkala Sebesar',1,0,'L', true);
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Rp. '.number_format($data['hasil']['tabelbeasiswayangditerima'],0,'.',',').' setiap bulan mulai '.$data['hasil']['saatpembayaranberkala'].' selama 5 tahun.',0,0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(190,5,'3. Pembayaran Sekaligus Sebesar',1,0,'L', true);
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').' kepada ahli waris jika tertanggung meninggal dunia sebelum akhir pembayaran premi tanggal '.$data['hasil']['saatanakberusia18th'].'.',0,0,'L');
		$this->pdf->ln(10);
		
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(190,5,'Perhitungan Premi',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(25,5,'',0,0,'L');
		$this->pdf->Cell(15,5,'Premi Sekaligus',0,0,'L');
		$this->pdf->Cell(50,5,':',0,0,'L');
		$this->pdf->Cell(40,5,'Rp. '.number_format($data['hasil']['tabelpremisekaligus'],0,'.',','),0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(25,5,'',0,0,'L');
		$this->pdf->Cell(15,5,'Premi Tahunan',0,0,'L');
		$this->pdf->Cell(50,5,':',0,0,'L');
		$this->pdf->Cell(40,5,'Rp. '.number_format($data['hasil']['tabelpremitahunan'],0,'.',','),0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(25,5,'',0,0,'L');
		$this->pdf->Cell(15,5,'Premi Semesteran',0,0,'L');
		$this->pdf->Cell(50,5,':',0,0,'L');
		$this->pdf->Cell(40,5,'Rp. '.number_format($data['hasil']['tabelpremisemesteran'],0,'.',','),0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(25,5,'',0,0,'L');
		$this->pdf->Cell(15,5,'Premi Kwartalan',0,0,'L');
		$this->pdf->Cell(50,5,':',0,0,'L');
		$this->pdf->Cell(40,5,'Rp. '.number_format($data['hasil']['tabelpremikwartalan'],0,'.',','),0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(25,5,'',0,0,'L');
		$this->pdf->Cell(15,5,'Premi Bulanan',0,0,'L');
		$this->pdf->Cell(50,5,':',0,0,'L');
		$this->pdf->Cell(40,5,'Rp. '.number_format($data['hasil']['tabelpremibulanan'],0,'.',','),0,0,'L');
		$this->pdf->ln(35);
		
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
		$this->pdf->ln(15);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(190,5,'JS Catur Karsa (Program Beasiswa 5 Tahun)','B',0,'L');
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