<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");
	
	error_reporting(0);

class Simulasi extends CI_Controller{	

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
		$this->build();
 	}
	
	function index(){
		//$this->insertNasabah();
		//echo 'sdkjfhiudshfiudsf';
		//$this->template->display('simulasi');
		
		$dataBuildID = $this->ModSimulasi->getBuildID();
		$data['hasil']['buildID'] = $dataBuildID['BUILDID'];
		
		
		
		echo $data['hasil']['buildID']." -- BuildID  <br>";
		
		
		
		
		
		$NoProspek =$this->input->get('kode_prospek');
		if (($NoProspek != ''))
		{
			$this->template->display('simulasi');
		}
		else
		{	
			redirect('https://aims-aws.ifg-life.id', 'refresh');
		}
		
		//$this->agenJaim();
	}


	//Testing Teguh
	function simulasi_new(){		
		$dataBuildID = $this->ModSimulasi->getBuildID();
		$data['hasil']['buildID'] = $dataBuildID['BUILDID'];
		
		echo $data['hasil']['buildID']." -- BuildID  <br>";
		$this->session->set_userdata('build_id', $data['hasil']['buildID']);
		
		$NoProspek =$this->input->get('kode_prospek');
		if (($NoProspek != ''))
		{
			$this->template->display_new('simulasi');
		}
		else
		{	
			redirect('https://aims-aws.ifg-life.id', 'refresh');
		}
	}

	//Development
	function simulasi_proidaman(){
		$dataBuildID = $this->ModSimulasi->getBuildID();
		$data['hasil']['buildID'] = $dataBuildID['BUILDID'];
		
		echo $data['hasil']['buildID']." -- BuildID  <br>";
		$this->session->set_userdata('build_id', $data['hasil']['buildID']);
		
		$NoProspek =$this->input->get('kode_prospek');
		if (($NoProspek != ''))
		{
			$this->template->display_proidaman('simulasi');
		}
		else
		{	
			redirect('https://aims-aws.ifg-life.id', 'refresh');
		}
	}


	//Testing Dimas
	// function simulasi_dimas(){
	// 	//$this->insertNasabah();
	// 	//echo 'sdkjfhiudshfiudsf';
	// 	//$this->template->display('simulasi');
		
	// 	$dataBuildID = $this->ModSimulasi->getBuildID();
	// 	$data['hasil']['buildID'] = $dataBuildID['BUILDID'];
		
		
		
	// 	echo $data['hasil']['buildID']." -- BuildID  <br>";
		
		
		
		
	// 	$this->session->set_userdata('build_id', $data['hasil']['buildID']);
		
	// 	$NoProspek =$this->input->get('kode_prospek');
	// 	if (($NoProspek != ''))
	// 	{
	// 		$this->template->display_dimas('simulasi');
	// 	}
	// 	else
	// 	{	
	// 		redirect('https://aims-aws.ifg-life.id', 'refresh');
	// 	}
		
	// 	//$this->agenJaim();
	// }
	
	function agenJaim($NoProspek=null){
		
		
		if (($kodeProspek != ''))
		{
			$this->template->display('simulasi');
		}
		else
		{	
			print "<script type=\"text/javascript\">alert('Anda harus login terlebih dahulu untuk dapat mengakses menu POS!');</script>";
			redirect('https://aims-aws.ifg-life.id', 'refresh');
		}
		
		
		$this->template->display('simulasi');
	}
	
	function insertNasabah(){
		$data['nasabah'] = array(
			'nama' => $this->input->post('premisekaligus'),
			'alamat' => $this->input->post('alamat'),
			'kota' => $this->input->post('kota'),
			'provinsi' => $this->input->post('provinsi'),
			'email' => $this->input->post('email'),
			'telp' => $this->input->post('telp'),
			'tgl_lahir' => date("Y-m-d", strtotime($this->input->post('tgl_lahir'))),
			'jenis_kel' => $this->input->post('jenis_kel'),
			'session_id' => $this->input->post('sessionid')
			//'premisekaligus' => $this->input->post('premisekaligus')
		);
		
		$data['premi'] = array(
			'masaasuransi' => $this->input->post('masaasuransi'),
			'mulas' => $this->input->post('mulas'),
			'nomeragen' => $this->input->post('nomeragen')
		);
		
		/*$data = array(
			'alamat' => $this->input->post('alamat'),
			'email' => $this->input->post('email'),
			'jenis_kel' => $this->input->post('jenis_kel'),
			'kota' => $this->input->post('kota'),
			'masaasuransi' => $this->input->post('masaasuransi'),
			'mulas' => $this->input->post('mulas'),
			'nama' => $this->input->post('nama'),
			'nomeragen' => $this->input->post('nomeragen'),
			'premisekaligus' => $this->input->post('premisekaligus'),
			'proteksi' => $this->input->post('proteksi'),
			'provinsi' => $this->input->post('provinsi'),
			'sessionid' => $this->input->post('sessionid'),
			'telp' => $this->input->post('telp'),
			'tgl_lahir' => date("Y-m-d", strtotime($this->input->post('tgl_lahir'))),
			'uangasuransi' => $this->input->post('uangasuransi'),
			'modul' => $this->input->post('modul')
		);*/
		
		$this->ModSimulasi->insertNasabah($data['nasabah']);
		//return $data;
		$this->load->view('hasil/optima7',$data);
		//var_dump($data);
		//$this->ModSimulasi->insertNasabah($data);
		//$this->load->view('hasil/optima7',$data);
		
		//print_r($arr); 
	}
	
	function hasil(){
		//$data['hasil'] = $this->insertNasabah();
		$this->load->view('hasil/optima7');
	}
	
	function optima7(){
		$data['details'] = $this->ModSimulasi->getDetailProduct('optima7');

		//echo $arr;
		$this->load->view('optima7',$data);
		
	}
	
	function optima8(){
		$this->load->view('optima8');
	}
	
	function optima9(){
		$this->load->view('optima9');
	}

	function linkequityfund(){
		$this->load->view('linkequityfund');
	}
	
	function extraincome(){
		$this->load->view('extraincome');
	}
	
	function linkbalancedfund(){
		$this->load->view('linkbalancedfund');
	}
	
	function linkfixedincome(){
		$this->load->view('linkfixedincome');
	}
	
	function prestasi(){
		$this->load->view('prestasi');
	}
	
	function jspromapan(){
		$this->load->view('jspromapan');
	}
	
	function jspromapannew(){
		$this->load->view('jspromapannew');
	}
	
	function jspromapannew2(){
		$this->load->view('jspromapannew2');
	}
	
	function jspromapankakehanberubah(){
		$this->load->view('jspromapankakehanberubah');
	}
	
	function jsproidaman(){
		$this->load->view('jsproidaman');
	}
	
	function jsproidaman_dev(){
		$data['pekerjaans'] = $this->ModSimulasi->allPekerjaan();
		$this->load->view('jsproidaman_dev', $data);
	}

	function jsguardian(){
		$this->load->view('jsguardian');
	}
	
	function jssiharta(){
		$this->load->view('jssiharta');
	}
	
	function jsdwiguna(){
		$this->load->view('jsdwiguna');
	}
	
	function jsdwigunamenaik(){
		$this->load->view('jsdwigunamenaik');
	}
	
	function jsdmpplus(){
		$this->load->view('jsdmpplus');
	}
	
	function jscaturkarsa(){
		$this->load->view('jscaturkarsa');
	}
	
	function jsanuitas(){
		$this->load->view('jsanuitas');
	}
	
	function anuitasnew(){
		$this->load->view('anuitasnew');
	}
	
	function anuitasnew2(){
		$this->load->view('anuitasnew2');
	}
	
	function jsgajiterusanplatinum(){
		$this->load->view('jsgajiterusanplatinum');
	}
	
	function jskelangsunganpendidikan(){
		$this->load->view('jskelangsunganpendidikan');
	}
	
	/*function paketproteksiuntukkeluarga(){
		$this->load->view('paketproteksiuntukkeluarga');
	}*/
	
	function jsproteksikeluarga(){
		$this->load->view('jsproteksikeluarga');
	}
	
	function jssin3rgy(){
		$this->load->view('jssin3rgy');
	}
	
	function jl3(){
	
		$data['details'] = '1';
		$this->load->view('jl3', $data);
	}
	
	function jl3new(){
		$this->load->view('jl3new');
	}
	
	function akdp(){
		$this->load->view('akdp');
	}
	
	function askred(){
		$this->load->view('askred');
	}
	
	function jspns(){
		$this->load->view('jspns');
	}
	
	//BANCASSURANCE
	function jsretirementassurance(){
		$this->load->view('jsretirementassurance');
	}
	function jsplanannuityassurance(){
		$this->load->view('jsplanannuityassurance');
	}
	function jsreplacementincomeassurance(){
		$this->load->view('jsreplacementincomeassurance');
	}
	
//	JS SAVING PLAN 2018
	function jssavingplan(){
		$this->load->view('jssavingplan');
	}
	
	
	function hitoptima7(){
		
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
			'bunganett' => $this->input->post('bunganett')
  		);
		
		$this->ModSimulasi->insertNasabah($data['nasabah']);
		$this->session->set_userdata($newdata);
		
		$html = $this->load->view('pdf/optima7',$data,true);
		
	   
	    

		//$this->load->view('hasil/optima7');*/
	}

	/*function hasil(){
		
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
		$mulas = date("Y-m-d", strtotime($this->session->userdata('mulas')));
		
		$tanggalMulas = date("d", strtotime($this->session->userdata('mulas')));
		$bulanMulas = $bulan[date("n", strtotime($this->session->userdata('mulas')))];
		$tahunMulas = date("Y", strtotime($this->session->userdata('mulas')));
		
		$masa = $this->session->userdata('masaasuransi');;
		
		$selisih = abs(strtotime($mulas) - strtotime($lahir));

		$years = floor($selisih / (365*60*60*24));
		
		$filepdf = site_url('cetakpdf').'/pdfoptima7';
		
		$data['hasil']['filepdf'] = $filepdf;
		$data['hasil']['nama'] = $this->session->userdata('nama');
		$data['hasil']['namaagen'] = $this->session->userdata('namaagen');
		$data['hasil']['bunganett'] = $this->session->userdata('bunganett');
		$data['hasil']['sapaan'] = ($this->session->userdata('jenis_kel') =='M') ? 'Bapak':'Ibu';
		$data['hasil']['usiaawal'] = $years;
		$data['hasil']['uangasuransi'] = $this->session->userdata('uangasuransi');
		$data['hasil']['premisekaligus'] = $this->session->userdata('premisekaligus');
		$data['hasil']['masaasuransi'] = $this->session->userdata('masaasuransi');
		$data['hasil']['mulas'] = $tanggalMulas.' '.$bulanMulas.' '.$tahunMulas;

		$uangAsuransi = $data['hasil']['uangasuransi'];
		$tabunganAwal = $data['hasil']['premisekaligus'];
		$bungaNett = $data['hasil']['bunganett'];
		//$deposito = $tabunganAwal;
		
		for($i=0;$i<=$masa;$i++){
			$key = 't'.$i;
						
			$faktor = floatval($nilaiTunai->$key);
			
			$nilai = ($faktor / 1000) * $uangAsuransi;
			$manfaat = ($uangAsuransi > $nilai) ? $uangAsuransi:$nilai;
			
			$bungaDeposito = (floatval($bungaNett)/100) * $tabunganAwal * $i;
			$totalDeposito = $tabunganAwal + $bungaDeposito;
						
			$data['hasil']['nilai'][$i]['manfaat'] = $manfaat; 
			$data['hasil']['nilai'][$i]['nilaitunai'] = $nilai;
			$data['hasil']['nilai'][$i]['usia'] = $years+$i;
			$data['hasil']['nilai'][$i]['tahun'] = ($i == 0) ? 'Awal':$i;
			$data['hasil']['nilai'][$i]['bungadeposito'] = $bungaDeposito;
			$data['hasil']['nilai'][$i]['tabungan'] = $tabunganAwal;
			$data['hasil']['nilai'][$i]['totaldeposito'] = $totalDeposito;
		}
		
		$this->load->view('hasil/optima7',$data);
		
		//$this->session->sess_destroy();
	}*/

	function testPdf(){

	    // Generate PDF by saying hello to the world
	    $this->pdf->AddPage();
	    $this->pdf->SetFont('Arial','B',16);
	    $this->pdf->Cell(40,10,'Hello World!');
	    $this->pdf->Output();
	  
	}
	//31536000
	function cetakPDF($namaFile){
 		$this->pdf->AddPage();
	    $this->pdf->SetFont('Arial','',10);
	    $pdf->Cell(100, 16, "Hello, World!");
	    $this->pdf->Output('./files/pdf/'.$namaFile.'.pdf','F');
	}

	function build()
	{
		$this->session->set_userdata('build_id', $data['hasil']['buildID']);
		$this->session->set_userdata('kode_prospek',$this->input->get('kode_prospek'));
		var_dump($_SESSION);
	}
	
	public function destroy()
    {
        $this->session->set_userdata('favourite_website', 'http://tutsplus.com');
         
        // destory session
        $this->session->sess_destroy();
    }
	

}