<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");
	
	error_reporting(0);

class Prestasi extends CI_Controller{	

	var $details;
	
	function hitungpremi(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransi = $this->input->post("uangasuransi");
		$usiaanak = $this->input->post("usiaanak");		
		$usiasekarang = $this->input->post("usiasekarang");
		$carabayarjsprestasi = $this->input->post("carabayarjsprestasi");
			
		$result = $this->ModSimulasi->getPremiJSPrestasi($usiaanak, $usiasekarang, $uangasuransi, $carabayarjsprestasi);
		
		echo $result['HASIL'];
			
	}
	
	function hitungpremi5tahunpertama(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransi = $this->input->post("uangasuransi");
		$usiaanak= $this->input->post("usiaanak");		
		$usiasekarang = $this->input->post("usiasekarang");
		$carabayarjsprestasi = $this->input->post("carabayarjsprestasi");
			
		$result = $this->ModSimulasi->getPremiJSPrestasi5tahunpertama($usiaanak, $usiasekarang, $uangasuransi, $carabayarjsprestasi);
		
		echo $result['HASIL'];
			
	}
	
	function hitungpremisekaligusjsprestasi(){
		
		$this->load->model('ModSimulasi');
		
		$modul = 'prestasi';
		
		$uangasuransi = $this->input->post("uangasuransi");
		
		$usiasekarang = $this->input->post("usiasekarang");
		
		$masaasuransi = $this->input->post("masaasuransi")-5;
		
		$jenistarif = $this->input->post("jenistarif");

		$tarif = $this->ModSimulasi->getTarif($modul,$masaasuransi,$usiasekarang, $uangasuransi);
		
		echo round($tarif[$jenistarif]->HASILKALI);
	}
	
	function hitungpremicicil5tahunjsprestasi(){
		
		$this->load->model('ModSimulasi');
		
		$modul = 'prestasi';
		
		$uangasuransi = $this->input->post("uangasuransi");
		
		$usiasekarang = $this->input->post("usiasekarang");
		
		$masaasuransi = $this->input->post("masaasuransi")-5;
		
		$medical = $this->input->post("medical");
		
		if ($medical == 'N')
		{
			$jenistarif = 3;
		}
		else if ($medical == 'M')
		{
			$jenistarif = 4;
		}

		$tarif = $this->ModSimulasi->getTarif($modul,$masaasuransi,$usiasekarang, $uangasuransi);
		
		echo round($tarif[4]->HASILKALI);
	}
	
	function hitungpremitahunanjsprestasi5tahunpertama(){
		
		$this->load->model('ModSimulasi');
		
		$modul = 'prestasi';
		
		$uangasuransi = $this->input->post("uangasuransi");
		
		$usiasekarang = $this->input->post("usiasekarang");
		
		$masaasuransi = $this->input->post("masaasuransi")-5;
		
		$medical = $this->input->post("medical");
		
		/*
		if ($medical == 'N')
		{
			$jenistarif = 1;
		}
		else if ($medical == 'M')
		{
			$jenistarif = 0;
		}
		*/

		$tarif = $this->ModSimulasi->getTarif($modul,$masaasuransi,$usiasekarang, $uangasuransi);
		
		echo round($tarif[0]->HASILKALI);
	}
	
	function hitungpremitahunanjsprestasitahun2berikutnya(){
		
		$this->load->model('ModSimulasi');
		
		$modul = 'prestasi';
		
		$uangasuransi = $this->input->post("uangasuransi");
		
		$usiasekarang = $this->input->post("usiasekarang");
		
		$masaasuransi = $this->input->post("masaasuransi")-5;
		
		$medical = $this->input->post("medical");
		
		/*
		if ($medical == 'N')
		{
			$jenistarif = 1;
		}
		else if ($medical == 'M')
		{
			$jenistarif = 0;
		}
		*/

		$tarif = $this->ModSimulasi->getTarif($modul,$masaasuransi,$usiasekarang, $uangasuransi);
		
		echo round($tarif[1]->HASILKALI);
	}
	
	function hitungpremisemesteranjsprestasi(){
		
		$this->load->model('ModSimulasi');
		
		$modul = 'prestasi';
		
		$uangasuransi = $this->input->post("uangasuransi");
		
		$usiasekarang = $this->input->post("usiasekarang");
		
		$masaasuransi = $this->input->post("masaasuransi")-5;
		
		$medical = $this->input->post("medical");
		
		$jenistarif = 0;

		$tarif = $this->ModSimulasi->getTarif2($modul,$masaasuransi,$usiasekarang, $uangasuransi, $medical);
		
		echo round((0.52)*($tarif[$jenistarif]->HASILKALI));
	}
	
	function hitungpremikuartalanjsprestasi(){
		
		$this->load->model('ModSimulasi');
		
		$modul = 'prestasi';
		
		$uangasuransi = $this->input->post("uangasuransi");
		
		$usiasekarang = $this->input->post("usiasekarang");
		
		$masaasuransi = $this->input->post("masaasuransi")-5;
		
		$medical = $this->input->post("medical");
		
		$jenistarif = 0;

		$tarif = $this->ModSimulasi->getTarif2($modul,$masaasuransi,$usiasekarang, $uangasuransi, $medical);
		
		echo round((0.27)*($tarif[$jenistarif]->HASILKALI));
	}
	
	function hitungpremibulananjsprestasi(){
		
		$this->load->model('ModSimulasi');
		
		$modul = 'prestasi';
		
		$uangasuransi = $this->input->post("uangasuransi");
		
		$usiasekarang = $this->input->post("usiasekarang");
		
		$masaasuransi = $this->input->post("masaasuransi")-5;
		
		$medical = $this->input->post("medical");
		
		$jenistarif = 0;

		$tarif = $this->ModSimulasi->getTarif2($modul,$masaasuransi,$usiasekarang, $uangasuransi, $medical);
		
		echo round((0.095)*($tarif[$jenistarif]->HASILKALI));
	}
	
	
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
			'NAMA' => $this->input->post('premisekaligus'),
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
		$this->load->view('hasil/prestasi',$data);
	}
	
	function detail(){
		$data['details'] = $this->ModSimulasi->getDetailProduct('prestasi');

		//echo $arr;
		//$this->load->view('prestasi',$data);
		
	}

	function hitung(){
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
			'masaasuransi' => 18 - $this->input->post('usiaanak'),
			'mulas' => $this->input->post('mulas'),
			'nomeragen' => $this->input->post('nomeragen'),
			'namaagen' => $this->input->post('namaagen'),
			'uangasuransi' => $this->input->post('uangasuransi'),
			'modul' => $this->input->post('modul'),
			'namaanak' => $this->input->post('namaanak'),
			'usiaanak' => $this->input->post('usiaanak'),
			'usiaortu' => $this->input->post('usiaortu'),
		);
		
		$dataBuildID = $this->ModSimulasi->getBuildID();
		$data['hasil']['buildID'] = $dataBuildID['BUILDID'];
		
		$filePdf = 'SIMULASI-'.strtoupper($this->input->post('namanasabah')).'-'.strtoupper($this->input->post('modul')).'-'.$data['hasil']['buildID'];
		
		//$tarif = $this->ModSimulasi->getTarif($data['premi']['modul'],$data['premi']['masaasuransi'],$data['premi']['usiaortu']);
		
		$data['hitung'] = array(
			'id_nasabah' => $nasabahID,
			'id_agen' => $this->input->post('nomeragen'),
			'file_pdf' => $filePdf.'.pdf',
			'id_produk' => $this->input->post('idproduk'),
			'session_id' => $this->input->post('sessionnasabah')
		);
		
		//$this->ModSimulasi->insertNasabah($data['hitung']);
		
		$dataBuildID = $this->ModSimulasi->getBuildID();
		$data['hasil']['buildID'] = $dataBuildID['BUILDID'];
		
		$newdata = array(
			'namanasabah' => $this->input->post('namanasabah'),
			'alamatnasabah' => $this->input->post('alamatnasabah'),
			'kotanasabah' => $this->input->post('kotanasabah'),
			'provinsinasabah' => $this->input->post('provinsinasabah'),
			'emailnasabah' => $this->input->post('emailnasabah'),
			'teleponnasabah' => $this->input->post('teleponasabah'),
			'lahirnasabah' => date("Y-m-d", strtotime($this->input->post('lahirnasabah'))),
			'gendernasabah' => $this->input->post('gendernasabah'),
			'sessionnasabah' => $this->input->post('sessionnasabah'),
			'masaasuransi' => $this->input->post('usiaanak'),
			'mulas' => $this->input->post('mulas'),
			'nomeragen' => $this->input->post('nomeragen'),
			'namaagen' => $this->input->post('namaagen'),
			'uangasuransi' => $this->input->post('uangasuransi'),
			'medical' => $this->input->post('medical'),
			'modul' => $this->input->post('modul'),
			'namaanak' => $this->input->post('namaanak'),
			'usiaanak' => $this->input->post('usiaanak'),
			'usiaortu' => $this->input->post('usiaortu'),
			'id_nasabah' => $nasabahID,
			'build_id' => $data['hasil']['buildID'],
			'id_agen' => $this->input->post('nomeragen'),
			'file_pdf' => $filePdf.'.pdf',
			'id_produk' => $this->input->post('idproduk'),
			'kodeprospek' => $this->input->post('kodeprospek'),
			
			'tabelpremisekaligus' => $this->input->post('tabelpremisekaligus'),
			'tabelpremicicil5tahun' => $this->input->post('tabelpremicicil5tahun'),
			'tabelpremicicil10tahun' => $this->input->post('tabelpremicicil10tahun'),
			'tabelpremicicil10tahuntahun2berikutnya' => $this->input->post('tabelpremicicil10tahuntahun2berikutnya'),
			'tabelpremitahunan' => $this->input->post('tabelpremitahunan'),
			'tabelpremitahunantahun2berikutnya' => $this->input->post('tabelpremitahunantahun2berikutnya'),
			'tabelpremisemesteran' => $this->input->post('tabelpremisemesteran'),
			'tabelpremikuartalan' => $this->input->post('tabelpremikuartalan'),
			'tabelpremibulanan' => $this->input->post('tabelpremibulanan'),
			
			'hubungandenganpempol' => $this->input->post('hubungandenganpempol'),
			'namalengkapcalontertanggung' => $this->input->post('namalengkapcalontertanggung'),
			'jeniskelamincalontertanggung' => $this->input->post('jeniskelamincalontertanggung'),
			'tanggallahircalontertangggung' => $this->input->post('tanggallahircalontertangggung'),
			'tertanggungsamadenganpemegangpolis' => $this->input->post('tertanggungsamadenganpemegangpolis'),
			
			'carabayarjsprestasi' => $this->input->post('carabayarjsprestasi'),
			
			'filepdf' => $filePdf
			//'tarif' => $tarif
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

		$lahir = date("Y-m-d", strtotime($this->session->userdata('tgl_lahir')));
		$mulas = date("Y-m-d", strtotime($this->session->userdata('mulas')));
		
		$tanggalMulas = date("d", strtotime($this->session->userdata('mulas')));
		$bulanMulas = $bulan[date("n", strtotime($this->session->userdata('mulas')))];
		$tahunMulas = date("Y", strtotime($this->session->userdata('mulas')));
		
		$dataBuildID = $this->ModSimulasi->getBuildID();
		$data['hasil']['buildID'] = $dataBuildID['BUILDID'];
		
		$tanggalHariIni = date("d", time());
		$bulanHariIni = $bulan[date("n", time())];
		$tahunHariIni = date("Y", time());
		
		$data['hasil']['nama'] =  $this->session->userdata('namanasabah');
		$data['hasil']['alamat'] =  $this->session->userdata('alamatnasabah');
		$data['hasil']['kota'] =  $this->session->userdata('kotanasabah');
		$data['hasil']['sapaan'] = ($this->session->userdata('gendernasabah') =='M') ? 'Bapak':'Ibu';
		$data['hasil']['provinsi'] =  $this->session->userdata('provinsinasabah');
		$data['hasil']['email'] =  $this->session->userdata('emailnasabah');
		$data['hasil']['telp'] =  $this->session->userdata('teleponnasabah');
		$data['hasil']['tgl_lahir'] =  date("Y-m-d", strtotime($this->session->userdata('lahirnasabah')));
		$data['hasil']['jenis_kel'] =  $this->session->userdata('gendernasabah');
		$data['hasil']['session_id'] =  $this->session->userdata('sessionnasabah');
		$data['hasil']['masaasuransi'] =  $this->session->userdata('usiaanak')+5;
		$data['hasil']['mulas'] =  $tanggalMulas.' '.$bulanMulas.' '.$tahunMulas;
		$data['hasil']['medical'] =  $this->session->userdata('medical');
		$data['hasil']['uangasuransi'] =  $this->session->userdata('uangasuransi');
		$data['hasil']['modul'] =  $this->session->userdata('modul');
		$data['hasil']['namaanak'] =  $this->session->userdata('namaanak');
		$data['hasil']['usiaanak'] =  $this->session->userdata('usiaanak');
		$data['hasil']['usiaortu'] =  $this->session->userdata('usiaortu');
		
		$data['hasil']['hubungandenganpempol'] =  $this->session->userdata('hubungandenganpempol');
		$data['hasil']['namalengkapcalontertanggung'] =  $this->session->userdata('namalengkapcalontertanggung');
		$data['hasil']['jeniskelamincalontertanggung'] =  $this->session->userdata('jeniskelamincalontertanggung');
		$data['hasil']['tanggallahircalontertangggung'] =  $this->session->userdata('tanggallahircalontertangggung');
		$data['hasil']['tertanggungsamadenganpemegangpolis'] =  $this->session->userdata('tertanggungsamadenganpemegangpolis');
		
		$data['hasil']['carabayarjsprestasi'] =  $this->session->userdata('carabayarjsprestasi');
		
		$lahircalonpemegangpolis = date("Y-m-d", strtotime($this->session->userdata('lahirnasabah')));
		$lahircalontertanggung = date("Y-m-d", strtotime($this->session->userdata('tanggallahircalontertangggung')));
		$sekarang = date("Y-m-d", strtotime("now"));
		
		$selisihcalonpemegangpolis = abs(strtotime($sekarang) - strtotime($lahircalonpemegangpolis));
		$selisihcalontertanggung = abs(strtotime($sekarang) - strtotime($lahircalontertanggung));
		
		$yearscalonpemegangpolis = floor($selisihcalonpemegangpolis / (365*60*60*24));
		$yearscalontertanggung = floor($selisihcalontertanggung / (365*60*60*24));
		
		$data['hasil']['usiacalonpemegangpolis'] = $yearscalonpemegangpolis;
		$data['hasil']['usiacalontertanggung'] = $yearscalontertanggung;
		
		$data['hasil']['id_nasabah'] =  $this->session->userdata('id_nasabah');
		$data['hasil']['id_agen'] =  $this->session->userdata('id_agen');
		$data['hasil']['file_pdf'] =  $this->session->userdata('file_pdf');
		$data['hasil']['id_produk'] =  $this->session->userdata('id_produk');
		$data['hasil']['filepdf'] =  $this->session->userdata('filepdf');
		
		$data['hasil']['tanggalproposal'] = $tanggalHariIni.' '.$bulanHariIni.' '.$tahunHariIni;
		
		$tarif = $this->ModSimulasi->getTarif($this->session->userdata('modul'),$this->session->userdata('masaasuransi'),$this->session->userdata('usiaortu'), $this->session->userdata('uangasuransi'));
		
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
			'CARA_BAYAR' => $this->session->userdata('carabayarjsprestasi'),
			'JUMLAH_PREMI' => $this->session->userdata('tabelpremibulanan'),
			'JUA' => $this->session->userdata('uangasuransi')
		);
		
		$this->ModSimulasi->insertSimulasi($data['hitung']);
		
		$data['hasil']['build_id'] = $data['hitung']['BUILD_ID'];
		if ($this->session->userdata('usiaanak') < 6)
		{
			$data['hasil']['tabelpremisekaligus'] = 0;
		}
		else if($this->session->userdata('usiaanak') >= 6)
		{
			$data['hasil']['tabelpremisekaligus'] =  $this->session->userdata('tabelpremisekaligus');
		}
		$data['hasil']['tabelpremicicil5tahun'] =  $this->session->userdata('tabelpremicicil5tahun');
		$data['hasil']['tabelpremicicil10tahun'] =  $this->session->userdata('tabelpremicicil10tahun');
		$data['hasil']['tabelpremicicil10tahuntahun2berikutnya'] =  $this->session->userdata('tabelpremicicil10tahuntahun2berikutnya');
		$data['hasil']['tabelpremitahunan'] =  $this->session->userdata('tabelpremitahunan');
		$data['hasil']['tabelpremitahunantahun2berikutnya'] =  $this->session->userdata('tabelpremitahunantahun2berikutnya');
		$data['hasil']['tabelpremisemesteran'] =  $this->session->userdata('tabelpremisemesteran');
		$data['hasil']['tabelpremikuartalan'] =  $this->session->userdata('tabelpremikuartalan');
		$data['hasil']['tabelpremibulanan'] =  $this->session->userdata('tabelpremibulanan');
		
		/*
		$data['hasil']['sekaligus'] = (($tarif[2]->HASILKALI));
		$data['hasil']['tahunmedical'] = (($tarif[0]->HASILKALI));
		$data['hasil']['tahunnonmedical'] = (($tarif[1]->HASILKALI));
		$data['hasil']['bulanan'] = (0.095)*$data['hasil']['tahunnonmedical'];
		$data['hasil']['kuartalan'] = (0.27)*$data['hasil']['tahunnonmedical'];
		$data['hasil']['semesteran'] = (0.52)*$data['hasil']['tahunnonmedical'];
		//$data['hasil']['limatahun'] = floatval($tarif[2]->tarif) * $this->session->userdata('uangasuransi') / 1000;
		$data['hasil']['limatahunmedical'] = (($tarif[3]->HASILKALI));
		$data['hasil']['limatahunnonmedical'] = (($tarif[4]->HASILKALI));
		*/
		
		$data['hasil']['sepuluhmedical'] = (($tarif[6]->HASILKALI));
		$data['hasil']['sepuluhnonmedical'] = (($tarif[5]->HASILKALI));
		
		$expsd = round(pow(1.05,$data['hasil']['masaasuransi'] - 12),5);
		$expsmp =round(pow(1.05,$data['hasil']['masaasuransi'] - 6),5);
		$expsma =round(pow(1.05,$data['hasil']['masaasuransi'] - 3),5);
		$expkuliah =round(pow(1.05,$data['hasil']['masaasuransi'] - 0),5);
		
		$expbeasiswabkl = pow(1.05,$data['hasil']['usiaanak']);
		$i = $data['hasil']['usiaanak'] + 1;
		$uaAwal = $data['hasil']['uangasuransi'];
		
		for($x = 1;$x<=$data['hasil']['masaasuransi'];$x++){
			$data['hasil'][$i]['tahunsekolah'] = $tahunMulas + $x;
			$data['hasil'][$i]['tahunasuransi'] = $x;
			$data['hasil'][$i]['uangasuransi'] = $uaAwal * pow(1.05,$x);
			$i++;
		}
		
//		$data['hasil']['sd']['asuransi'] = (array_key_exists("6",$data['hasil'])) ? $data['hasil'][6]['uangasuransi'] : 0;
//		$data['hasil']['sd']['tahun'] = (array_key_exists("6",$data['hasil'])) ? $data['hasil'][6]['tahunsekolah'] : "-----";
//		$data['hasil']['sd']['beasiswa'] = (array_key_exists("6",$data['hasil'])) ? $data['hasil'][6]['uangasuransi']*0.1 : 0;
//		$data['hasil']['smp']['asuransi'] = (array_key_exists("12",$data['hasil'])) ? $data['hasil'][12]['uangasuransi'] : 0;
//		$data['hasil']['smp']['tahun'] = (array_key_exists("12",$data['hasil'])) ? $data['hasil'][12]['tahunsekolah'] : "-----";
//		$data['hasil']['smp']['beasiswa'] = (array_key_exists("12",$data['hasil'])) ? $data['hasil'][12]['uangasuransi']*0.2 : 0;
//		$data['hasil']['sma']['asuransi'] = (array_key_exists("15",$data['hasil'])) ? $data['hasil'][15]['uangasuransi'] : 0;
//		$data['hasil']['sma']['tahun'] = (array_key_exists("15",$data['hasil'])) ? $data['hasil'][15]['tahunsekolah'] : "-----";
//		$data['hasil']['sma']['beasiswa'] = (array_key_exists("15",$data['hasil'])) ? $data['hasil'][15]['uangasuransi']*0.3 : 0;
//		$data['hasil']['kuliah']['asuransi'] = (array_key_exists("18",$data['hasil'])) ? $data['hasil'][18]['uangasuransi'] : 0;
//		$data['hasil']['kuliah']['tahun'] = (array_key_exists("18",$data['hasil'])) ? $data['hasil'][18]['tahunsekolah'] : "-----";
//		$data['hasil']['kuliah']['beasiswa'] = (array_key_exists("18",$data['hasil'])) ? $data['hasil'][18]['uangasuransi']*0.5 : 0;
		
		
		$data['hasil']['smp']['tahun'] = $tahunMulas+($data['hasil']['usiaanak']-6);
		$data['hasil']['smp']['beasiswa'] = pow(1.05,$data['hasil']['usiaanak'] - 6) * $data['hasil']['uangasuransi'] * 0.2;
		
		$data['hasil']['sma']['tahun'] = $tahunMulas+($data['hasil']['usiaanak']-3);
		$data['hasil']['sma']['beasiswa'] = pow(1.05,$data['hasil']['usiaanak'] - 3) * $data['hasil']['uangasuransi'] * 0.3;
		
		$data['hasil']['kuliah']['tahun'] = $tahunMulas+($data['hasil']['usiaanak']);
		$data['hasil']['kuliah']['beasiswa'] = pow(1.05,$data['hasil']['usiaanak']) * $data['hasil']['uangasuransi'] * 0.5;
		
		$data['hasil']['beasiswaberkala'] = $expbeasiswabkl /* $data['hasil']['uangasuransi']*/;
		
		$this->createPDF($data['hasil']['file_pdf'],$data);
		
//		$this->ModSimulasi->insertProposal(strtoupper($this->session->userdata('namanasabah')), strtoupper($this->session->userdata('modul')), ($data['hasil']['build_id']), $data['hasil']['nomeragen']);
		
		$this->load->view('hasil/prestasi',$data);
		
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
		$this->pdf->Cell(160,10,'ASURANSI JS PRESTASI PENDIDIKAN',0,0,'C');
		$this->pdf->ln(20);
		
		// Judul Proposal
		// Opening Text
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(15);
		$this->pdf->Cell(160,5,'A. DATA',0,0,'L');
		$this->pdf->ln();
		// Opening Text
		// Data Pertanggungan & Content
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(15);
		$this->pdf->Cell(25,5,'Nama',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(25,5,$data['hasil']['namalengkapcalontertanggung'],0,0,'L');
		
		$this->pdf->Cell(33);
		
		$this->pdf->Cell(45,5,'Usia',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(5,5,''.$data['hasil']['usiacalontertanggung'].' Tahun',0,0,'L');
		$this->pdf->ln();
		
		$this->pdf->Cell(15);
		$this->pdf->Cell(25,5,'Jenis Kelamin',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(25,5,$data['hasil']['jeniskelamincalontertanggung'],0,0,'L');
		
		$this->pdf->Cell(33);
		
		$this->pdf->Cell(45,5,'Masa Asuransi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(5,5,''.$data['hasil']['usiaanak'].' Tahun',0,0,'L');
		$this->pdf->ln();
		
//		$this->pdf->Cell(25,5,'Usia Anak',0,0,'L');
//		$this->pdf->Cell(3);
//		$this->pdf->Cell(2,5,':',0,0,'L');
//		$this->pdf->Cell(3);
//		$this->pdf->Cell(25,5,''.$data['hasil']['usiaanak'].' Tahun',0,0,'L');
		
		$this->pdf->Cell(15);
		$this->pdf->Cell(25,5,'Uang Asuransi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(25,5,'Rp. '.number_format($data['hasil']['uangasuransi'], 0, ',', '.').'',0,0,'L');
		
		$this->pdf->Cell(33);
		
		$this->pdf->Cell(45,5,'Cara Bayar',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(5,5,''.$data['hasil']['carabayarjsprestasi'].'',0,0,'L');
		$this->pdf->ln();

		
		/*
		$this->pdf->Cell(45,5,'Masa Asuransi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(5,5,''.$data['hasil']['masaasuransi'].' Tahun',0,0,'L');
		$this->pdf->ln();
		
		
		$this->pdf->Cell(15);
		$this->pdf->Cell(25,5,'Jenis',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		
		if($data['hasil']['medical'] == 'N'){
			$this->pdf->Cell(25,5,'Non Medical',0,0,'L');
		}else{
			$this->pdf->Cell(25,5,'Medical',0,0,'L');
		}
		
		$this->pdf->Cell(40);
		
		$this->pdf->Cell(45,5,'Mulai Asuransi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(5,5,$data['hasil']['mulas'],0,0,'L');
		$this->pdf->ln();
		$this->pdf->ln();
		
		
		$this->pdf->Cell(15);
	    $this->pdf->Cell(160,5,'Sebagai gambaran keunggulan manfaat JS Prestasi, kami sampaikan sebagai berikut :',0,0,'L');
		$this->pdf->ln();
		*/
		
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(15);
		$this->pdf->Cell(160,5,'B. MANFAAT ASURANSI',0,0,'L');
		$this->pdf->ln(8);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(15);
	    $this->pdf->Cell(160,5,'1. Pembayaran Manfaat Tahapan',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(20);
		$this->pdf->Cell(62,10,'Keterangan',1,0,'C');
		$this->pdf->Cell(30,10,'Tahun',1,0,'C');
		$this->pdf->Cell(63,10,'Jumlah',1,0,'C');
		
		
//		$this->pdf->SetFont('Arial','',8);
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(40,5,'Masuk SD','LR',0,'C');
//		
//		if ($data['hasil']['masaasuransi'] < 14)
//		{
//			$this->pdf->Cell(15,5,'-','R',0,'C');
//			$this->pdf->Cell(45,5,'-','',0,'C');
//			$this->pdf->Cell(20,5,'','R',0,'C');
//			$this->pdf->Cell(10,5,'','',0,'C');
//			$this->pdf->Cell(30,5,'-','R',0,'C');
//		}
//		else
//		{
//			$this->pdf->Cell(15,5,$data['hasil']['sd']['tahun'],'R',0,'C');
//			$this->pdf->Cell(45,5,'10 % x Rp. '.number_format($data['hasil']['sd']['asuransi'], 0, ',', '.').'','',0,'R');
//			$this->pdf->Cell(20,5,'','R',0,'L');
//			$this->pdf->Cell(10,5,'Rp.','',0,'L');
//			$this->pdf->Cell(30,5,number_format($data['hasil']['sd']['beasiswa'], 0, ',', '.'),'R',0,'R');
//		}
		
		
//		$this->pdf->ln();
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(40,2,'','LBR',0,'C');
//		$this->pdf->Cell(15,2,'','B',0,'C');
//		$this->pdf->Cell(45,2,'','LB',0,'C');
//		$this->pdf->Cell(20,2,'','RB',0,'L');
//		$this->pdf->Cell(40,2,'','RB',0,'C');
//		$this->pdf->ln();
//		$this->pdf->SetFont('Arial','',5);
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(40,2,'','LR',0,'C');
//		$this->pdf->Cell(15,2,'','',0,'C');
//		$this->pdf->Cell(45,2,'','L',0,'C');
//		$this->pdf->Cell(20,2,'','R',0,'L');
//		$this->pdf->Cell(40,2,'','R',0,'C');
//		$this->pdf->ln();
//		$this->pdf->SetFont('Arial','',8);
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(40,5,'Tahapan I','LR',0,'C');
//		
//		if ($data['hasil']['usiaanak'] < 8)
//		{
//			$this->pdf->Cell(15,5,'-','R',0,'C');
//			$this->pdf->Cell(45,5,'-','',0,'C');
//			$this->pdf->Cell(20,5,'','R',0,'C');
//			$this->pdf->Cell(10,5,'','',0,'C');
//			$this->pdf->Cell(30,5,'-','R',0,'C');
//		}
//		else
//		{
//			$this->pdf->Cell(15,5,$data['hasil']['smp']['tahun'],'R',0,'C');
//			$this->pdf->Cell(45,5,'20 % x Rp. x UA Awal x (1,05)^n-6','',0,'R');
//			$this->pdf->Cell(20,5,'','R',0,'L');
//			$this->pdf->Cell(10,5,'Rp.','',0,'L');
//			$this->pdf->Cell(30,5,number_format($data['hasil']['smp']['beasiswa'], 0, ',', '.'),'R',0,'R');
//		}
//		
//		$this->pdf->ln();
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(40,2,'','LBR',0,'C');
//		$this->pdf->Cell(15,2,'','B',0,'C');
//		$this->pdf->Cell(45,2,'','LB',0,'C');
//		$this->pdf->Cell(20,2,'','RB',0,'L');
//		$this->pdf->Cell(40,2,'','RB',0,'C');
		
//		$this->pdf->ln();
//		$this->pdf->SetFont('Arial','',5);
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(40,2,'','LR',0,'C');
//		$this->pdf->Cell(15,2,'','',0,'C');
//		$this->pdf->Cell(45,2,'','L',0,'C');
//		$this->pdf->Cell(20,2,'','R',0,'L');
//		$this->pdf->Cell(40,2,'','R',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',5);
		$this->pdf->Cell(20);
		$this->pdf->Cell(62,2,'','LR',0,'C');
		$this->pdf->Cell(30,2,'','R',0,'L');
		$this->pdf->Cell(63,2,'','R',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(20);
		$this->pdf->Cell(62,5,'Tahapan I','LR',0,'C');
		$this->pdf->Cell(30,5,$data['hasil']['sma']['tahun'],'R',0,'C');
		$this->pdf->Cell(13,5,'Rp.','',0,'L');
		$this->pdf->Cell(50,5,number_format($data['hasil']['uangasuransi'] * 0.4, 0, ',', '.'),'R',0,'R');
		
//		$this->pdf->SetFont('Arial','',8);
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(40,5,'Tahapan II','LR',0,'C');
//		$this->pdf->Cell(15,5,$data['hasil']['sma']['tahun'],'R',0,'C');
//		$this->pdf->Cell(45,5,'30 % x Rp. x UA Awal x (1,05)^n-3','',0,'R');
//		$this->pdf->Cell(20,5,'','R',0,'L');
//		$this->pdf->Cell(10,5,'Rp.','',0,'L');
//		$this->pdf->Cell(30,5,number_format($data['hasil']['sma']['beasiswa'], 0, ',', '.'),'R',0,'R');
//		$this->pdf->ln();
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(40,2,'','LBR',0,'C');
//		$this->pdf->Cell(15,2,'','B',0,'C');
//		$this->pdf->Cell(45,2,'','LB',0,'C');
//		$this->pdf->Cell(20,2,'','RB',0,'L');
//		$this->pdf->Cell(40,2,'','RB',0,'C');
		
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',5);
		$this->pdf->Cell(20);
		$this->pdf->Cell(62,2,'','LR',0,'C');
		$this->pdf->Cell(30,2,'','R',0,'L');
		$this->pdf->Cell(63,2,'','R',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(20);
		$this->pdf->Cell(62,5,'Tahapan II','LR',0,'C');
		$this->pdf->Cell(30,5,$data['hasil']['kuliah']['tahun'],'R',0,'C');
		$this->pdf->Cell(13,5,'Rp.','',0,'L');
		$this->pdf->Cell(50,5,number_format($data['hasil']['uangasuransi'] * 0.6, 0, ',', '.'),'R',0,'R');
		$this->pdf->ln();
		$this->pdf->Cell(20);
		$this->pdf->Cell(62,2,'','LBR',0,'C');
		$this->pdf->Cell(30,2,'','B',0,'L');
		$this->pdf->Cell(63,2,'','RB',0,'C');
		$this->pdf->ln(4);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(20);
	    $this->pdf->Cell(160,5,'Pembayaran manfaat Tahapan dibayarkan pada saat Ulang Tahun Polis dan setelah premi LUNAS.',0,0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(15);
	    $this->pdf->Cell(160,5,'2. Santunan Meninggal Dunia',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(20);
	    $this->pdf->Cell(160,5,'Jika Tertanggung Meninggal Dunia pada masa Asuransi maka kepada Ahli Waris dibayarkan Santunan Meninggal Dunia',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(20);
	    $this->pdf->Cell(160,5,'sebesar 100% Uang Asuransi.',0,0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(15);
		$this->pdf->Cell(160,5,'C. PEMBAYARAN PREMI',0,0,'L');
		$this->pdf->ln(8);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(20);
	    $this->pdf->Cell(160,5,'Premi '.$data['hasil']['carabayarjsprestasi'].' 5 tahun pertama			: Rp. '.number_format($data['hasil']['tabelpremicicil5tahun'], 2, ',', '.'),0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(20);
	    $this->pdf->Cell(160,5,'Premi '.$data['hasil']['carabayarjsprestasi'].' setelah tahun ke 5		: Rp. '.number_format($data['hasil']['tabelpremisekaligus'], 2, ',', '.'),0,0,'L');
		
		$this->pdf->ln(65);
		
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
		

//		$this->pdf->ln();
//		$this->pdf->SetFont('Arial','B',10);
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(160,5,'Pembayaran Manfaat Bulanan',0,0,'C');
//		$this->pdf->ln();
//		$this->pdf->ln();
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(55,10,'Keterangan',1,0,'C');
//		$this->pdf->Cell(65,10,'Perhitungan',1,0,'C');
//		$this->pdf->Cell(40,10,'Jumlah',1,0,'C');
//		$this->pdf->ln();
//		$this->pdf->SetFont('Arial','',5);
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(55,2,'','L',0,'C');
//		$this->pdf->Cell(45,2,'','L',0,'C');
//		$this->pdf->Cell(20,2,'*','R',0,'L');
//		$this->pdf->Cell(40,2,'','R',0,'C');
//		$this->pdf->ln();
//		$this->pdf->SetFont('Arial','',8);
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(55,5,'Secara Bulanan Selama 5 Tahun','LR',0,'C');
//		$this->pdf->Cell(45,5,'2% x Uang Asuransi','',0,'R');
//		$this->pdf->Cell(20,5,'','R',0,'L');
//		$this->pdf->Cell(10,5,'Rp.','',0,'L');
//		$this->pdf->Cell(30,5,number_format($data['hasil']['beasiswaberkala'] * $data['hasil']['uangasuransi'] * 0.02, 2, ',', '.'),'R',0,'R');
//		$this->pdf->ln();
//		$this->pdf->SetFont('Arial','',8);
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(55,5,'','LRT',0,'C');
//		$this->pdf->Cell(45,5,'atau','LT',0,'R');
//		$this->pdf->Cell(20,5,'','RT',0,'L');
//		$this->pdf->Cell(10,5,'','LT',0,'L');
//		$this->pdf->Cell(30,5,'','RT',0,'R');
//		$this->pdf->ln();
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(55,2,'','LBR',0,'C');
//		$this->pdf->Cell(45,2,'','LB',0,'C');
//		$this->pdf->Cell(20,2,'','RB',0,'L');
//		$this->pdf->Cell(40,2,'','RB',0,'C');
//		$this->pdf->ln();
//		$this->pdf->SetFont('Arial','',5);
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(55,2,'','L',0,'C');
//		$this->pdf->Cell(45,2,'','L',0,'C');
//		$this->pdf->Cell(20,2,'*','R',0,'L');
//		$this->pdf->Cell(40,2,'','R',0,'C');
//		$this->pdf->ln();
//		$this->pdf->SetFont('Arial','',8);
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(55,5,'Secara Sekaligus','LR',0,'C');
//		$this->pdf->Cell(45,5,'Uang Asuransi','',0,'R');
//		$this->pdf->Cell(20,5,'','R',0,'L');
//		$this->pdf->Cell(10,5,'Rp.','',0,'L');
//		$this->pdf->Cell(30,5,number_format($data['hasil']['beasiswaberkala'] * $data['hasil']['uangasuransi'], 2, ',', '.'),'R',0,'R');
//		$this->pdf->ln();
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(55,2,'','LBR',0,'C');
//		$this->pdf->Cell(45,2,'','LB',0,'C');
//		$this->pdf->Cell(20,2,'','RB',0,'L');
//		$this->pdf->Cell(40,2,'','RB',0,'C');
//		$this->pdf->ln(5);
//		$this->pdf->SetFont('Arial','',6);
//		$this->pdf->Cell(15);
//	    $this->pdf->Cell(160,3,'Keterangan :',0,0,'L');
//		$this->pdf->ln();
//		$this->pdf->Cell(15);
//	    $this->pdf->Cell(10,3,'n',0,0,'R');
//		$this->pdf->Cell(5,3,':',0,0,'L');
//		$this->pdf->Cell(50,3,'Masa Pembayaran Premi ('.$data['hasil']['usiaanak'].' Tahun)',0,0,'L');
//		$this->pdf->ln();
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(10,3,'',0,0,'L');
//		$this->pdf->Cell(5,3,'',0,0,'L');
//		$this->pdf->Cell(50,3,'Pembayaran Tahapan dapat diambil maksimum 6 Bulan sebelum jatuh tempo.',0,0,'L');
//		// Data Pertanggungan & Content
//		$this->pdf->AddPage();
//		$this->pdf->Cell(15);
//		$this->pdf->SetFont('Arial','B',12);
//		$this->pdf->Cell(160,10,'PT. Asuransi Jiwasraya (Persero)',0,0,'R');
//		$this->pdf->ln(5);
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(160,10,'Jl. Ir. H. Juanda No. 34, Jakarta - 10210',0,0,'R');
//		$this->pdf->Image($image1, 15, 10);
//	    $this->pdf->ln(10);
//	    $this->pdf->SetFont('Arial','B',16);
//		// Judul Proposal
//		$this->pdf->ln(10);
//		$this->pdf->SetFont('Arial','B',10);
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(160,5,'II. Manfaat Proteksi',0,0,'L');
//		$this->pdf->ln();
//		$this->pdf->ln();
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(15);
//	    $this->pdf->MultiCell(160,5,'Jika Tertanggung meninggal dunia dalam Masa Pembayaran Premi ('.$data['hasil']['usiaanak'].' Tahun), akan dibayar manfaat sekaligus sebesar :',0);
//	    $this->pdf->ln(2);
//		$this->pdf->Cell(15);
//		$this->pdf->Write(5, "100 % x Uang Asuransi Pada Saat");
//		$this->pdf->subWrite(5, "", '', 6, 4);
//		$this->pdf->Cell(5);
//		$this->pdf->Write(5, ":");
//		$this->pdf->Cell(5);
//		$this->pdf->Write(5, "Meninggal bukan karena kecelakaan");
//		$this->pdf->ln();
//		$this->pdf->Cell(15);
//		$this->pdf->Write(5, "200 % x Uang Asuransi Pada Saat");
//		$this->pdf->subWrite(5, "", '', 6, 4);
//		$this->pdf->Cell(5);
//		$this->pdf->Write(5, ":");
//		$this->pdf->Cell(5);
//		$this->pdf->Write(5, "Meninggal karena kecelakaan");
//		$this->pdf->ln(7);
//		$this->pdf->Cell(15);
//	    $this->pdf->MultiCell(160,5,'Apabila Tertanggung meninggal dunia, maka Pemegang Polis dibebaskan dari kewajiban membayar premi. Dan manfaat tahapan yang belum diterima tetap dibayarkan sesuai jatuh tempo tahapan.',0);
//		$this->pdf->ln(2);
//		$this->pdf->Cell(15);
//	    $this->pdf->MultiCell(160,5,'Pemegang Polis dibebaskan dari kewajiban membayar premi apabila Tertanggung mengalami cacat tetap total dan manfaat tahapan yang belum diterima tetap akan dibayarkan sesuai jatuh tempo tahapan.',0);
//		$this->pdf->ln(2);
//		$this->pdf->Cell(15);
//	    $this->pdf->MultiCell(160,5,'Apabila "Anak yang dibeasiswakan " meninggal dunia, maka kepada ahli waris akan dibebaskan dari kewajiban membayar premi dan seluruh premi standard yang telah dibayar akan dikembalikan serta manfaat tahapan yang belum diterima tetap akan dibayarkan sesuai jatuh tempo tahapan.',0);
//		$this->pdf->ln();
//		$this->pdf->SetFont('Arial','B',10);
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(160,5,'III. Pembayaran Premi',0,0,'L');
//		$this->pdf->ln();
//		$this->pdf->ln();
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(40,10,'Cara Bayar',1,0,'C');
//		$this->pdf->Cell(60,10,'Jumlah Premi',1,0,'C');
//		$this->pdf->Cell(60,10,'Keterangan',1,0,'C');
//		$this->pdf->ln();
//		$this->pdf->SetFont('Arial','',10);
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(40,10,'Sekaligus','LBR',0,'L');
//		$this->pdf->Cell(10,10,'Rp.','B',0,'L');
//		//$this->pdf->Cell(50,10,number_format($data['hasil']['sekaligus'], 2, ',', '.'),'BR',0,'R');
//		$this->pdf->Cell(50,10,number_format($data['hasil']['tabelpremisekaligus'], 2, ',', '.'),'BR',0,'R');
//		$this->pdf->Cell(60,10,'','BR',0,'L');
//		$this->pdf->ln();
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(40,10,'Tahunan','LBR',0,'L');
//		$this->pdf->Cell(10,10,'Rp.','B',0,'L');
//		$this->pdf->Cell(50,10,number_format($data['hasil']['tabelpremitahunan'], 2, ',', '.'),'BR',0,'R');
		
		/*if($data['hasil']['medical'] == 'N'){
			$this->pdf->Cell(50,10,number_format($data['hasil']['tahunnonmedical'], 2, ',', '.'),'BR',0,'R');
		}else{
			$this->pdf->Cell(50,10,number_format($data['hasil']['tahunmedical'], 2, ',', '.'),'BR',0,'R');
		}*/
//		$this->pdf->Cell(60,10,'5 Tahun Pertama','BR',0,'L');
//		$this->pdf->ln();
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(40,10,'','LBR',0,'L');
//		$this->pdf->Cell(10,10,'Rp.','B',0,'L');
//		$this->pdf->Cell(50,10,number_format($data['hasil']['tabelpremitahunantahun2berikutnya'], 2, ',', '.'),'BR',0,'R');
//		$this->pdf->Cell(60,10,'Tahun Berikutnya','BR',0,'L');
//		$this->pdf->ln();
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(40,10,'Bulanan','LBR',0,'L');
//		$this->pdf->Cell(10,10,'Rp.','B',0,'L');
//		$this->pdf->Cell(50,10,number_format($data['hasil']['tabelpremibulanan'], 2, ',', '.'),'BR',0,'R');
//		$this->pdf->Cell(60,10,'','BR',0,'L');
//		$this->pdf->ln();
//		
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(40,10,'Semesteran','LBR',0,'L');
//		$this->pdf->Cell(10,10,'Rp.','B',0,'L');
//		$this->pdf->Cell(50,10,number_format($data['hasil']['tabelpremisemesteran'], 2, ',', '.'),'BR',0,'R');
//		$this->pdf->Cell(60,10,'','BR',0,'L');
//		$this->pdf->ln();
//		
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(40,10,'Kuartalan','LBR',0,'L');
//		$this->pdf->Cell(10,10,'Rp.','B',0,'L');
//		$this->pdf->Cell(50,10,number_format($data['hasil']['tabelpremikuartalan'], 2, ',', '.'),'BR',0,'R');
//		$this->pdf->Cell(60,10,'','BR',0,'L');
////		$this->pdf->ln();
//		
////		$this->pdf->Cell(15);
////		$this->pdf->Cell(40,10,'Per 5 Tahun','LBR',0,'L');
////		$this->pdf->Cell(10,10,'Rp.','B',0,'L');
////		$this->pdf->Cell(50,10,number_format($data['hasil']['tabelpremicicil5tahun'], 2, ',', '.'),'BR',0,'R');
////		/*
////		if($data['hasil']['medical'] == 'N'){
////			$this->pdf->Cell(50,10,number_format($data['hasil']['limatahunnonmedical'], 2, ',', '.'),'BR',0,'R');
////		}else{
////			$this->pdf->Cell(50,10,number_format($data['hasil']['limatahunmedical'], 2, ',', '.'),'BR',0,'R');
////		}
////		*/
////		$this->pdf->Cell(60,10,'','BR',0,'L');
////		$this->pdf->ln();
////		
////		$this->pdf->Cell(15);
////		$this->pdf->Cell(40,10,'Per 10 Tahun','LBR',0,'L');
////		$this->pdf->Cell(10,10,'Rp.','B',0,'L');
////		//if($data['hasil']['medical'] == 'N'){
////			$this->pdf->Cell(50,10,number_format($data['hasil']['tabelpremicicil10tahun'], 2, ',', '.'),'BR',0,'R');
////		//}else{
////			//$this->pdf->Cell(50,10,number_format($data['hasil']['sepuluhmedical'], 2, ',', '.'),'BR',0,'R');
////		//}
////		$this->pdf->Cell(60,10,'5 Tahun Pertama','BR',0,'L');
////		$this->pdf->ln();
////		$this->pdf->Cell(15);
////		$this->pdf->Cell(40,10,'','LBR',0,'L');
////		$this->pdf->Cell(10,10,'Rp.','B',0,'L');
////		$this->pdf->Cell(50,10,number_format($data['hasil']['tabelpremicicil10tahuntahun2berikutnya'], 2, ',', '.'),'BR',0,'R');
////		$this->pdf->Cell(60,10,'Tahun Berikutnya','BR',0,'L');
//		$this->pdf->ln();
//		$this->pdf->SetFont('Arial','I',8);
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(160,5,'* Pada saat jatuh tempo pembayaran Tahapan, Premi tidak bayar (gratis) selama 1 tahun.',0,0,'L');
//		$this->pdf->ln(5);
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(160,5,'* Manfaat Tahapan dapat diambil 6 bulan sebelum jatuh tempo.',0,0,'L');
//		$this->pdf->ln();
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(80,5,'Jakarta, '.$data['hasil']['tanggalproposal'].'',0,0,'L');
//		$this->pdf->ln();
//		
//		$this->pdf->SetFont('Arial','B',10);
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(80,5,'PT. Asuransi Jiwasraya (Persero)',0,0,'L');
//		$this->pdf->ln();
//		$this->pdf->Cell(15);
//		$this->pdf->Cell(80,5,'Marketing',0,0,'L');
//		$this->pdf->ln();
//		
//		$this->pdf->SetFont('Arial','I',8);
//		$this->pdf->Cell(15);
//	    $this->pdf->MultiCell(160,5,'Illustrasi ini hanya merupakan pendekatan/proyeksi dari jumlah dana yang diinvestasikan dan bukan merupakan bagian dari kontrak asuransi',1);
//		
//	   	// Footer
//   	    $this->pdf->SetY(260);
//   		// Select Arial italic 8
//    	$this->pdf->SetFont('Arial','I',8);
//    	// Print centered page number
//    	$this->pdf->Cell(15);
//		$this->pdf->Cell(160,5,'','B',0,'L');
//		$this->pdf->ln();
//		
//		$this->pdf->SetFont('Arial','',6);
//    	$this->pdf->Cell(15);
//    	$this->pdf->Cell(15,5,'Agen',0,0,'L');
//		$this->pdf->Cell(2,5,':',0,0,'L');
//		$this->pdf->Cell(15,5,$data['hasil']['namaagen'],0,0,'L');
//		$this->pdf->Cell(20);
//		$this->pdf->Cell(15,5,'Kode Agen',0,0,'L');
//		$this->pdf->Cell(2,5,':',0,0,'L');
//		$this->pdf->Cell(15,5,$data['hasil']['nomeragen'],0,0,'L');
//		$this->pdf->ln();
//		
//    	$this->pdf->Cell(15);
//    	$this->pdf->Cell(15,5,'Tanggal',0,0,'L');
//		$this->pdf->Cell(2,5,':',0,0,'L');
//		$this->pdf->Cell(15,5,$data['hasil']['tanggalproposal'],0,0,'L');
//		$this->pdf->Cell(20);
//		$this->pdf->Cell(15,5,'Build ID',0,0,'L');
//		$this->pdf->Cell(2,5,':',0,0,'L');
//		$this->pdf->Cell(15,5,($data['hasil']['buildID']),0,0,'L');
//		$this->pdf->ln();
	   	// Footer
	   
	   
		// LAST PAGE
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
		$this->pdf->Cell(190,5,'PROPOSAL ASURANSI JS PRESTASI PENDIDIKAN','B',0,'L');
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
		$this->pdf->ln(95);
		
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
		
		
		
	    $this->pdf->Output('./files/pdf/'.$namaFile,'F');
	  
	}	

}