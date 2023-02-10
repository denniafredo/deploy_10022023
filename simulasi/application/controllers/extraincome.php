<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");
	
	error_reporting(0);

class Extraincome extends CI_Controller{	

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
		$this->load->view('hasil/extraincome',$data);
	}
	
	function detail(){
		$data['details'] = $this->ModSimulasi->getDetailProduct('extraincome');

		//echo $arr;
		//$this->load->view('extraincome',$data);
		
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
			'bunganett' => $this->input->post('bunganett'),
			'bungatabungan' => $this->input->post('bungatabungan')
		);
		
		$dataBuildID = $this->ModSimulasi->getBuildID();
		$data['hasil']['buildID'] = $dataBuildID['BUILDID'];
		
		$filePdf = 'SIMULASI-'.strtoupper($this->input->post('namanasabah')).'-'.strtoupper($this->input->post('modul')).'-'.$data['hasil']['buildID'];
		
		$data['hitung'] = array(
			'id_nasabah' => $nasabahID,
			'id_agen' => $this->input->post('nomeragen'),
			'file_pdf' => $filePdf.'.pdf',
			'id_produk' => $this->input->post('idproduk'),
			'session_id' => $this->input->post('sessionnasabah'),
			'build_id' => $buildId
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
			'masaasuransi' => 5,
			'mulas' => $this->input->post('mulas'),
			'nomeragen' => $this->input->post('nomeragen'),
			'premisekaligus' => $this->input->post('premisekaligus'),
			'uangasuransi' => $this->input->post('premisekaligus') * 0.25,
			'modul' => $this->input->post('modul'),
			'namaagen' => $this->input->post('namaagen'),
			'bunganett' => $this->input->post('bunganett'),
			'bungatabungan' => $this->input->post('bungatabungan'),
			'id_nasabah' => $nasabahID,
			'id_agen' => $this->input->post('nomeragen'),
			'file_pdf' => $filePdf.'.pdf',
			'id_produk' => $this->input->post('idproduk'),
			'filepdf' => $filePdf,
			'kodeprospek' => $this->input->post('kodeprospek'),
			'build_id' => $buildId,
			'namalengkapcalontertanggung' => $this->input->post('namalengkapcalontertanggung'),
			'jeniskelamincalontertanggung' => $this->input->post('jeniskelamincalontertanggung'),
			'tanggallahircalontertangggung' => $this->input->post('tanggallahircalontertangggung')
  		);
		
		
		$this->session->set_userdata($newdata);
		
		//$html = $this->load->view('pdf/extraincome',$data,true);
		//$this->load->view('hasil/extraincome');*/
	}

	function hasil(){
		
		$bonus = 1;
		$rate = 7.5;
		$hariTahun = 365;
		$hariBulan = 30;
		$pajak = 80;
		$bungaAwal = 5;
		$bungaSelanjutnya = 2.5;
		$rateDeposito = $this->session->userdata('bunganett');
		$rateTabungan = $this->session->userdata('bungatabungan');
		
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
		//$nilaiTunai = $this->ModSimulasi->getNilaiTunai($this->session->userdata('modul'));
		//$data['nilaiTunai'] = $nilaiTunai;
		
		//$lahir = date("Y-m-d", strtotime($this->session->userdata('tgl_lahir')));
		$lahir = date("Y-m-d", strtotime($this->session->userdata('tanggallahircalontertangggung')));
		$mulas = date("Y-m-d", strtotime($this->session->userdata('mulas')));
		
		$tanggalMulas = date("d", strtotime($this->session->userdata('mulas')));
		$bulanMulas = $bulan[date("n", strtotime($this->session->userdata('mulas')))];
		$tahunMulas = date("Y", strtotime($this->session->userdata('mulas')));
		
		$tanggalLahir = date("d", strtotime($this->session->userdata('tgl_lahir')));
		$bulanLahir = $bulan[date("n", strtotime($this->session->userdata('tgl_lahir')))];
		$tahunLahir = date("Y", strtotime($this->session->userdata('tgl_lahir')));
		
		$tanggalHariIni = date("d", $data['hasil']['buildID']);
		$bulanHariIni = $bulan[date("n", $data['hasil']['buildID'])];
		$tahunHariIni = date("Y", $data['hasil']['buildID']);
		
		$masa = $this->session->userdata('masaasuransi');;
		
		$selisih = abs(strtotime($mulas) - strtotime($lahir));

		$years = floor($selisih / (365*60*60*24));
		
		//$filepdf = site_url('cetakpdf').'/pdfextraincome';
		
		//$data['hasil']['filepdf'] = $filepdf;
		$data['hasil']['nama'] = $this->session->userdata('nama');
		$data['hasil']['namaagen'] = strtoupper(str_replace("-"," ",$this->session->userdata('namaagen')));
		//$kodeKantor = $this->session->userdata('kodekantor');
		//$dataKantor = $this->ModSimulasi->cariDataKantor($kodeKantor);
		//$data['hasil']['kantorcabang'] = $dataKantor['NAMAKANTOR'];
		$data['hasil']['nomeragen'] = $this->session->userdata('nomeragen');
		$data['hasil']['bunganett'] = $this->session->userdata('bunganett');
		$data['hasil']['bungatabungan'] = $rateTabungan;
		$data['hasil']['pajak'] = $pajak;
		$data['hasil']['rate'] = $rate;
		$data['hasil']['sapaan'] = ($this->session->userdata('jenis_kel') =='M') ? 'Bapak':'Ibu';
		$data['hasil']['usiaawal'] = $years;
		$data['hasil']['uangasuransi'] = $this->session->userdata('uangasuransi');
		$data['hasil']['masaasuransi'] = $this->session->userdata('masaasuransi');
		$data['hasil']['mulas'] = $tanggalMulas.' '.$bulanMulas.' '.$tahunMulas;
		$data['hasil']['tanggalproposal'] = $tanggalHariIni.' '.$bulanHariIni.' '.$tahunHariIni;
		$data['hasil']['tanggallahir'] = $tanggalLahir.' '.$bulanLahir.' '.$tahunLahir;
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
		
		$uangAsuransi = $data['hasil']['uangasuransi'];
		$tabunganAwal = $data['hasil']['premisekaligus'];
		$bungaNett = $data['hasil']['bunganett'];
		$premiBonus = $data['hasil']['premisekaligus'];
		$premiAwal = $data['hasil']['premisekaligus'];
		$manfaat = (($rate/100)/12)*$premiBonus;
		$uangasuransimeninggaldunia = (25/100)*$premiBonus; 
		
		//$deposito = $tabunganAwal;
		
		for($i=1;$i<=$masa+1;$i++){	
			$data['hasil']['nilai'][$i]['uangasuransimeninggaldunia'] = $uangasuransimeninggaldunia;
			
			$data['hasil']['nilai'][$i]['premibonus'] = round($premiBonus); 
			$data['hasil']['nilai'][$i]['manfaat'] = round($manfaat); 
			$premiBonus = (1+($bonus/100))*$premiBonus;
			$manfaat = (($rate/100)/12)*$premiBonus;
			$data['hasil']['nilai'][$i]['deposito'] = round((($premiAwal*($rateDeposito/100))/$hariTahun)*($pajak/100)*$hariBulan);
			$data['hasil']['nilai'][$i]['tabungan'] = round((($premiAwal*($rateTabungan/100))/$hariTahun)*($pajak/100)*$hariBulan);
			$data['hasil']['nilai'][$i]['usia'] = $years + $i; 
		}

		$data['hasil']['nilaitunai'] = $data['hasil']['nilai'][$masa+1]['premibonus'];
		
		$filePdf = $this->session->userdata('filepdf');
		
		$this->ModSimulasi->insertProposal(strtoupper($this->session->userdata('namanasabah')), strtoupper($this->session->userdata('modul')), ($data['hasil']['build_id']-1), $data['hasil']['nomeragen']);
		
		$this->createPDF($filePdf,$data);
		
		$this->load->view('hasil/extraincome',$data);
		
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
		$this->pdf->ln(8);
		$this->pdf->Cell(15);
	    $this->pdf->Cell(160,10,'Proposal',0,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(15);
		$this->pdf->Cell(160,10,'JS Proteksi Extra Income Platinum',0,0,'C');
		$this->pdf->ln();
		// Judul Proposal
		// Opening Text
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(15);
		$this->pdf->Cell(160,5,'DATA PERTANGGUNGAN',0,0,'L');
		$this->pdf->ln();
		// Opening Text
		// Data Pertanggungan & Content
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(15);
		$this->pdf->Cell(25,5,'Tanggal Lahir (Usia)',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(25,5,''.$data['hasil']['tanggallahir'].' ('.$data['hasil']['usiaawal'].' Tahun)',0,0,'L');
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
	    $this->pdf->Cell(160,5,'Sebagai gambaran keunggulan manfaat JS Proteksi Extra Income Platinum, kami sampaikan sebagai berikut :',0,0,'L');
		$this->pdf->ln();
		$this->pdf->ln();
		
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(15);
	    $this->pdf->Cell(160,5,'Tabel Perbandingan Perkembangan Dana Investasi',0,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(15);
	    $this->pdf->Cell(160,5,'JS Proteksi Extra Income Platinum Dengan Deposito Bank',0,0,'C');
		$this->pdf->ln();
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(15);
		$this->pdf->Cell(15,5,'Akhir','LTR',0,'C');
		$this->pdf->Cell(20,5,'Usia','TR',0,'C');
		$this->pdf->Cell(75,5,'JS Extra Income','BTR',0,'C');
		$this->pdf->Cell(25,5,'Deposito','TR',0,'C');
		$this->pdf->Cell(25,5,'Tabungan','TR',0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(15);
		$this->pdf->Cell(15,5,'Tahun Ke','LBR',0,'C');
		$this->pdf->Cell(20,5,'(thn)','BR',0,'C');
		$this->pdf->Cell(25,5,'Manfaat Bulanan','BR',0,'C');
		$this->pdf->Cell(25,5,'Premi + Bonus','BR',0,'C');
		$this->pdf->Cell(25,5,'Nilai Tunai','BR',0,'C');
		$this->pdf->Cell(25,5,'(*)','BR',0,'C');
		$this->pdf->Cell(25,5,'(**)','BR',0,'C');
		$this->pdf->ln();
		
		$masaAsuransi = $data['hasil']['masaasuransi'];
		$this->pdf->SetFont('Arial','',8);
		for($i=1;$i<=$masaAsuransi;$i++){
			$this->pdf->Cell(15);
			$this->pdf->Cell(15,5,$i,'LBR',0,'C');
			$this->pdf->Cell(20,5,$data['hasil']['nilai'][$i]['usia'],'BR',0,'C');
			$this->pdf->Cell(10,5,'Rp. ','BL',0,'L');
			$this->pdf->Cell(15,5,number_format($data['hasil']['nilai'][$i]['manfaat'], 0, ',', '.'),'BR',0,'R');
			$this->pdf->Cell(10,5,'Rp. ','BL',0,'L');
			$this->pdf->Cell(15,5,number_format($data['hasil']['nilai'][$i]['premibonus'], 0, ',', '.'),'BR',0,'R');
			
			
			if($i == $masaAsuransi){
				$this->pdf->Cell(10,5,'Rp. ','BL',0,'L');
				$this->pdf->Cell(15,5,number_format($data['hasil']['nilaitunai'], 0, ',', '.'),'BR',0,'R');
			}else{
				$this->pdf->Cell(25,5,'***','BL',0,'C');
			}
			
			$this->pdf->Cell(10,5,'Rp. ','BL',0,'L');
			$this->pdf->Cell(15,5,number_format($data['hasil']['nilai'][$i]['deposito'], 0, ',', '.'),'BR',0,'R');
			$this->pdf->Cell(10,5,'Rp. ','BL',0,'L');
			$this->pdf->Cell(15,5,number_format($data['hasil']['nilai'][$i]['tabungan'], 0, ',', '.'),'BR',0,'R');
			$this->pdf->ln();
		}

		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(15);
	    $this->pdf->Cell(160,3,'Keterangan :',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(15);
	    $this->pdf->Cell(50,3,'Bunga Deposito (*)',0,0,'L');
		$this->pdf->Cell(5,3,':',0,0,'L');
		$this->pdf->Cell(50,3,''.$data['hasil']['bunganett'].'% p.a. gross '.$data['hasil']['bunganett']*($data['hasil']['pajak']/100).'% p.a. nett',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(15);
	    $this->pdf->Cell(50,3,'Bunga Tabungan (**)',0,0,'L');
		$this->pdf->Cell(5,3,':',0,0,'L');
		$this->pdf->Cell(50,3,''.$data['hasil']['bungatabungan'].'% p.a. gross '.$data['hasil']['bungatabungan']*($data['hasil']['pajak']/100).'% p.a. nett',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(15);
	    $this->pdf->Cell(50,3,'Nilai Tunai tertera di Polis (***)',0,0,'L');
		//$this->pdf->Cell(5,3,':',0,0,'L');
		//$this->pdf->Cell(50,3,''.$data['hasil']['rate'].'% p.a. gross '.$data['hasil']['rate']*($data['hasil']['pajak']/100).'% p.a. nett',0,0,'L');
		$this->pdf->ln();
		$this->pdf->ln(5);
		
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(15);
	    $this->pdf->Cell(160,5,'Manfaat Asuransi :',0,0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->ln();
		$this->pdf->Cell(15);
		$this->pdf->Cell(2,5,'I.',0,0,'L');
		$this->pdf->Cell(3);
	    $this->pdf->Cell(5,5,'-',0,0,'L');
		$this->pdf->Cell(2);
		$this->pdf->Cell(148,5,'Pembayaran manfaat bulanan selama Masa Asuransi sebesar 7,5% setiap tahun',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(15);
		$this->pdf->Cell(2,5,'',0,0,'L');
		$this->pdf->Cell(3);
	    $this->pdf->Cell(5,5,'-',0,0,'L');
		$this->pdf->Cell(2);
		$this->pdf->Cell(148,5,'Bonus 1% (compounded) dari Premi Sekaligus setiap tahun sampai akhir tahun ke-'.$masaAsuransi.'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(15);
		$this->pdf->Cell(2,5,'',0,0,'L');
		$this->pdf->Cell(3);
	    $this->pdf->Cell(5,5,'-',0,0,'L');
		$this->pdf->Cell(2);
		$this->pdf->Cell(148,5,'Pada akhir tahun ke-'.$masaAsuransi.' akan dibayarkan sebesar Nilai Tunai Akhir Tahun',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(15);
		$this->pdf->Cell(2,5,'II.',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(148,5,'Jika Tertanggung meninggal dunia, maka kepada Ahli Waris akan dibayarkan :',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(15);
		$this->pdf->Cell(2,5,'',0,0,'L');
		$this->pdf->Cell(3);
	    $this->pdf->Cell(5,5,'1.',0,0,'L');
		$this->pdf->Cell(2);
		$this->pdf->Cell(148,5,'Segera, sebesar Uang Asuransi, yaitu 25% dari Premi sekaligus sebesar : '.number_format($data['hasil']['uangasuransi'], 0, ',', '.').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(15);
		$this->pdf->Cell(2,5,'',0,0,'L');
		$this->pdf->Cell(3);
	    $this->pdf->Cell(5,5,'2.',0,0,'L');
		$this->pdf->Cell(2);
		$this->pdf->Cell(148,5,'Manfaat bulanan tetap dibayarkan, dan',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(15);
		$this->pdf->Cell(2,5,'',0,0,'L');
		$this->pdf->Cell(3);
	    $this->pdf->Cell(5,5,'3.',0,0,'L');
		$this->pdf->Cell(2);
		$this->pdf->Cell(148,5,'Pembayaran sebesar Nilai Tunai, pada saat akhir Periode Investasi dan pertanggungan berakhir secara otomatis. ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->ln();
		$this->pdf->Cell(15);
	    $this->pdf->Cell(160,5,'Semoga proposal ini dapat memberikan informasi yang memenuhi kebutuhan anda.',0,0,'L');
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
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(15);
	    $this->pdf->Cell(60,5,$data['hasil']['namaagen'],'T',0,'C');
		$this->pdf->Cell(40);
		$this->pdf->Cell(60,5,$data['hasil']['namalengkapcalontertanggung'],'T',0,'C');
		$this->pdf->ln();
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','I',5);
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
		$this->pdf->Cell(15,5,date("d/m/Y h:i:s A", $data['hasil']['buildID']),0,0,'L');
		$this->pdf->Cell(20);
		$this->pdf->Cell(15,5,'Build ID',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(15,5,$data['hasil']['buildID'],0,0,'L');
		$this->pdf->ln();
	   	// Footer
	   
	   
	    $this->pdf->Output('./files/pdf/'.$namaFile.'.pdf','F');
	  
	}	

}