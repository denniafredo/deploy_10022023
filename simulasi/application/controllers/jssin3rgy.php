<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");
	
	error_reporting(0);

class Jssin3rgy extends CI_Controller{

	// RIDER
	
	function hitunghcpjssinergy(){
		$this->load->model('ModSimulasi');
		
		$uangasuransihcpjssinergy = $this->input->post("uangasuransihcpjssinergy");
		
		$usiasekarang = $this->input->post("usiasekarang");
		
		$carabayarpremi = $this->input->post("carabayarpremi");
		
		if ($carabayarpremi == 'Bulanan')
		{
			$carabayar = 'BULANAN';		
		}
		else if ($carabayarpremi == 'Tahunan')
		{
			$carabayar = 'TAHUNAN';
		}
		
		$result = $this->ModSimulasi->getBiayaAsuransiPerBulanHCPS($usiasekarang, $uangasuransihcpjssinergy, $carabayar);
		
		$hasil = round($result['TARIF']);
		
		echo $hasil;
		
	}
	
	function hitungaddbjssinergy() {
		$this->load->model('ModSimulasi');
		
		$usiasekarang = $this->input->post("usiasekarang");
		
		$uangasuransijsaddbjssinergy = $this->input->post("uangasuransijsaddbjssinergy");
		
		$uangasuransipokok = $this->input->post("uangasuransipokok");
		
		$jeniskelamincalontertanggung = $this->input->post("jeniskelamincalontertanggung");
		
		if ($jeniskelamincalontertanggung == 'Laki-Laki')
		{
			$jeniskelamin = 'MALE';
		}
		else if ($jeniskelamincalontertanggung == 'Perempuan')
		{
			$jeniskelamin = 'FEMALE';
		}
		
		$carabayarpremi = $this->input->post("carabayarpremi");
		
		if ($carabayarpremi == 'Tahunan')
		{
			$faktorkali = 1;
		}
		else if ($carabayarpremi == 'Semesteran')
		{
			$faktorkali = 0.52;
		}
		else if ($carabayarpremi == 'Kuartalan')
		{
			$faktorkali = 0.27;
		}
		else if ($carabayarpremi == 'Bulanan')
		{
			$faktorkali = 0.095;
		}
		else if ($carabayarpremi == 'Sekaligus')
		{
			$faktorkali = 0;
		}
		
		$result = $this->ModSimulasi->getBiayaAsuransiPerBulanADDB($usiasekarang);
		
		//$hasil = (($result[$jeniskelamin]/1000) * $uangasuransijsaddbjssinergy) * $faktorkali;
		
		if ($uangasuransijsaddbjssinergy > ($uangasuransipokok * 3))
		{
				$hasil = 'TIDAK BISA';
		}
		else if ($uangasuransijsaddbjssinergy < ($uangasuransipokok))
		{
				$hasil = 'TIDAK BISA';
		}
		else if ($uangasuransijsaddbjssinergy > 500000000)
		{
				$hasil = 'TIDAK BISA';
		}
		else
		{
				$hasilx = (($result[$jeniskelamin]/1000) * $uangasuransijsaddbjssinergy) * $faktorkali;
				$hasil = round($hasilx);
		}
		
		echo $hasil;
	}
	
	function hitungjstermsinergy(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransitermjssinergy = $this->input->post("uangasuransitermjssinergy");
		$calonpemegangpolisperokokjssinergy = $this->input->post("calonpemegangpolisperokokjssinergy");	
		
		if ($calonpemegangpolisperokokjssinergy == 'Ya')
		{
			$status = 'SMOKER';	
		}
		else if ($calonpemegangpolisperokokjssinergy == 'Tidak')
		{
			$status = 'NONSMOKER';	
		}
			
		$usiasekarang = $this->input->post("usiasekarang");
		$result = $this->ModSimulasi->getBiayaAsuransiPerBulanTerm($usiasekarang, $status, $uangasuransitermjssinergy);
		
		$hasil = $result['TERM']/1000;
		
		echo round($hasil);
	}
	
	function hitungpremijssin3rgy(){
	
		$this->load->model('ModSimulasi');
		
		$usiasekarang = $this->input->post("usiasekarang");	
		$pilihanpaketbenefit = $this->input->post("pilihanpaketbenefit");
		
		if ($pilihanpaketbenefit == 'Paket 1')
		{
			$paket = 'PAKET1';	
		}
		else if ($pilihanpaketbenefit == 'Paket 2')
		{
			$paket = 'PAKET2';		
		}
		else if ($pilihanpaketbenefit == 'Paket 3')
		{
			$paket = 'PAKET3';		
		}
		else if ($pilihanpaketbenefit == 'Paket 4')
		{
			$paket = 'PAKET4';		
		}
		
		$carabayarpremi = $this->input->post("carabayarpremi");

		$result = $this->ModSimulasi->getPremiJSSin3rgy($paket, $carabayarpremi, $usiasekarang);
		
		echo round($result[$paket]);
	
	}
	
	function hitungjstpdsinergy(){
		
		$this->load->model('ModSimulasi');
		
		$uangasuransijstpdjssinergy = $this->input->post("uangasuransijstpdjssinergy");
		$jeniskelamincalontertanggung = $this->input->post("jeniskelamincalontertanggung");	
		
		if ($jeniskelamincalontertanggung == 'Perempuan')
		{
			$jeniskelamin = 'FEMALE';	
		}
		else if ($jeniskelamincalontertanggung == 'Laki-Laki')
		{
			$jeniskelamin = 'MALE';	
		}
			
		$usiasekarang = $this->input->post("usiasekarang");
		$result = $this->ModSimulasi->getBiayaAsuransiPerBulanTPD($usiasekarang);
		
		$hasil = $result[$jeniskelamin] * ($uangasuransijstpdjssinergy / 1000);
		
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
			
			'pilihanpaketbenefit' => $this->input->post('pilihanpaketbenefit'),
			'mulaiasuransi' => $this->input->post('mulaiasuransi'),
			'masaasuransijssin3rgy' => $this->input->post('masaasuransijssin3rgy'),
			'carabayarpremi' => $this->input->post('carabayarpremi'),
			'premijsremaja' => $this->input->post('premijsremaja'),			
			'masapembayaranpremi' => $this->input->post('masapembayaranpremi'),
			
			//RIDER
			'hcpjssinergy' => $this->input->post('hcpjssinergy'),
			'premihcpjssinergy' => $this->input->post('premihcpjssinergy'),
			'uangasuransihcpjssinergy' => $this->input->post('uangasuransihcpjssinergy'),
			'totalpremiriderjssinergy1' => $this->input->post('totalpremiriderjssinergy1'),
			'jsaddbjssinergy' => $this->input->post('jsaddbjssinergy'),			
			'premijsaddbjssinergy' => $this->input->post('premijsaddbjssinergy'),
			'uangasuransijsaddbjssinergy' => $this->input->post('uangasuransijsaddbjssinergy'),
			'termjssinergy' => $this->input->post('termjssinergy'),
			'premitermjssinergy' => $this->input->post('premitermjssinergy'),
			'uangasuransitermjssinergy' => $this->input->post('uangasuransitermjssinergy'),
			'totalpremiriderjssinergy2' => $this->input->post('totalpremiriderjssinergy2'),			
			'totalpremiriderjssinergysum' => $this->input->post('totalpremiriderjssinergysum'),
			'tabelpremibulanan' => $this->input->post('tabelpremibulanan'),
			'tabelriderbulanan' => $this->input->post('tabelriderbulanan'),
			'tabelriderpremibulanan' => $this->input->post('tabelriderpremibulanan'),
			'tabelpremi5tahunpertama' => $this->input->post('tabelpremi5tahunpertama'),
			'tabelridertahunan' => $this->input->post('tabelridertahunan'),			
			'tabelriderpremitahunan' => $this->input->post('tabelriderpremitahunan')

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
		$data['hasil']['mulaiasuransijssin3rgy'] = $tanggalSaatMulaiAsuransi.' '.$bulanSaatMulaiAsuransi.' '.$tahunSaatMulaiAsuransi;
		
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
		
		$data['hasil']['pilihanpaketbenefit']  = $this->session->userdata('pilihanpaketbenefit');
		if ($data['hasil']['pilihanpaketbenefit'] == 'Paket 1')
		{
			$data['hasil']['paketbenefit'] = 'PAKET 1';	
		}
		else if ($data['hasil']['pilihanpaketbenefit'] == 'Paket 2')
		{
			$data['hasil']['paketbenefit'] = 'PAKET 2';	
		}
		else if ($data['hasil']['pilihanpaketbenefit'] == 'Paket 3')
		{
			$data['hasil']['paketbenefit'] = 'PAKET 3';		
		}
		else if ($data['hasil']['pilihanpaketbenefit'] == 'Paket 4')
		{
			$data['hasil']['paketbenefit'] = 'PAKET 4';		
		}
		

		$data['hasil']['masaasuransijssin3rgy']  = $this->session->userdata('masaasuransijssin3rgy');
		$data['hasil']['carabayarpremi']  = $this->session->userdata('carabayarpremi');
		$data['hasil']['premijsremaja']  = $this->session->userdata('premijsremaja');
		$data['hasil']['masapembayaranpremi']  = $this->session->userdata('masapembayaranpremi');
		
		$data['hasil']['hcpjssinergy'] = $this->session->userdata('hcpjssinergy');
		$data['hasil']['premihcpjssinergy'] = $this->session->userdata('premihcpjssinergy');
		$data['hasil']['uangasuransihcpjssinergy'] = $this->session->userdata('uangasuransihcpjssinergy');
		$data['hasil']['totalpremiriderjssinergy1'] = $this->session->userdata('totalpremiriderjssinergy1');
		$data['hasil']['termjssinergy'] = $this->session->userdata('termjssinergy');	
		$data['hasil']['premitermjssinergy'] = $this->session->userdata('premitermjssinergy');
		$data['hasil']['uangasuransitermjssinergy'] = $this->session->userdata('uangasuransitermjssinergy');
		$data['hasil']['jsaddbjssinergy'] = $this->session->userdata('jsaddbjssinergy');
		$data['hasil']['premijsaddbjssinergy'] = $this->session->userdata('premijsaddbjssinergy');
		$data['hasil']['uangasuransijsaddbjssinergy'] = $this->session->userdata('uangasuransijsaddbjssinergy');
		$data['hasil']['totalpremiriderjssinergy2'] = $this->session->userdata('totalpremiriderjssinergy2');			
		$data['hasil']['totalpremiriderjssinergysum'] = $this->session->userdata('totalpremiriderjssinergysum');
		$data['hasil']['tabelpremibulanan'] = $this->session->userdata('tabelpremibulanan');
		$data['hasil']['tabelriderbulanan'] = $this->session->userdata('tabelriderbulanan');
		$data['hasil']['tabelriderpremibulanan'] = $this->session->userdata('tabelriderpremibulanan');
		$data['hasil']['tabelpremi5tahunpertama'] = $this->session->userdata('tabelpremi5tahunpertama');
		$data['hasil']['tabelridertahunan'] = $this->session->userdata('tabelridertahunan');			
		$data['hasil']['tabelriderpremitahunan'] = $this->session->userdata('tabelriderpremitahunan');
		
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
		
		$DataPaket = $this->ModSimulasi->getDataPaket($data['hasil']['pilihanpaketbenefit']);
		$data['hasil']['uangasuransi'] = $DataPaket['UANGASURANSI'];
		$data['hasil']['ri'] = $DataPaket['RI'];
		$data['hasil']['icu'] = $DataPaket['ICU'];
		
		if ($data['hasil']['uangasuransihcpjssinergy'] == '1')
		{
			$data['hasil']['ririder'] = $data['hasil']['uangasuransihcpjssinergy'] * 100000;
			$data['hasil']['icurider'] = $data['hasil']['uangasuransihcpjssinergy'] * 200000;	
		}
		else if ($data['hasil']['uangasuransihcpjssinergy'] == '2')
		{
			$data['hasil']['ririder'] = $data['hasil']['uangasuransihcpjssinergy'] * 100000;
			$data['hasil']['icurider'] = $data['hasil']['uangasuransihcpjssinergy'] * 200000;	
		}
		else if ($data['hasil']['uangasuransihcpjssinergy'] == '3')
		{
			$data['hasil']['ririder'] = $data['hasil']['uangasuransihcpjssinergy'] * 100000;
			$data['hasil']['icurider'] = $data['hasil']['uangasuransihcpjssinergy'] * 200000;	
		}
		else if ($data['hasil']['uangasuransihcpjssinergy'] == '4')
		{ 
			$data['hasil']['ririder'] = $data['hasil']['uangasuransihcpjssinergy'] * 100000;
			$data['hasil']['icurider'] = $data['hasil']['uangasuransihcpjssinergy'] * 200000;		
		}
		else if ($data['hasil']['uangasuransihcpjssinergy'] == '5')
		{ 
			$data['hasil']['ririder'] = $data['hasil']['uangasuransihcpjssinergy'] * 100000;
			$data['hasil']['icurider'] = $data['hasil']['uangasuransihcpjssinergy'] * 200000;		
		}
		else
		{
			$data['hasil']['ririder'] = 0;
			$data['hasil']['icurider'] = 0;	
		}
		
		
		if ($data['hasil']['pilihanpaketbenefit'] == 'Paket 1')
		{
			$paket = 'PAKET1';	
		}
		else if ($data['hasil']['pilihanpaketbenefit'] == 'Paket 2')
		{
			$paket = 'PAKET2';		
		}
		else if ($data['hasil']['pilihanpaketbenefit'] == 'Paket 3')
		{
			$paket = 'PAKET3';		
		}
		else if ($data['hasil']['pilihanpaketbenefit'] == 'Paket 4')
		{
			$paket = 'PAKET4';		
		}
		
		$premibulanan = $this->ModSimulasi->getPremiBulananJSSin3rgy($paket, $data['hasil']['usiacalontertanggung']);
		
		$data['hasil']['premibulanan'] = $premibulanan[$paket];
		
		$premitahunan= $this->ModSimulasi->getPremiTahunanJSSin3rgy($paket, $data['hasil']['usiacalontertanggung']);
		
		$data['hasil']['premitahunan'] = $premitahunan[$paket];
		
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
			'CARA_BAYAR' => $this->session->userdata('carabayarpremi'),
			'JUMLAH_PREMI' => $data['hasil']['premijsremaja']
		);
		
		$this->ModSimulasi->insertSimulasi($data['hitung']);
		
		$data['hasil']['build_id'] = $data['hitung']['BUILD_ID'];
				
		$filePdf = $this->session->userdata('filepdf');
		
		$this->createPDF($filePdf,$data);
		
		$this->load->view('hasil/jssin3rgy',$data);
		
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
		$this->pdf->Cell(190,5,'ASURANSI JS SIN3RGY',1,0,'C', true);
		$this->pdf->ln(6);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(173.5,5,'Produk ASURANSI JS SIN3RGY disiapkan untuk anda  dengan jaminan yang lengkap dengan hanya membayar satu premi mendapatkan ',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(0,5,'tiga',0,0,'L');
		$this->pdf->ln(4);
		$this->pdf->Cell(26,5,'manfaat pasti',0,0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(0,5,'meliputi:',0,0,'L');
		$this->pdf->ln(4);
		$this->pdf->Cell(190,5,'1. Santunan proteksi Rawat Inap (*) bagi Tertanggung selama 5 Tahun (selama masa pembayaran premi), karena sakit (**) atau kecelakaan. Maksimal',0,0,'L');
		$this->pdf->ln(4);
		$this->pdf->Cell(3);
		$this->pdf->Cell(190,5,'setiap tahun adalah selama 90 hari.',0,0,'L');
		$this->pdf->ln(4);
		$this->pdf->Cell(190,5,'2. Santunan proteksi santunan duka sebesar 100% Uang Asuransi selama Masa Asuransi 10 Tahun, apabila Tertanggung meninggal dunia karena',0,0,'L');
		$this->pdf->ln(4);
		$this->pdf->Cell(3);
		$this->pdf->Cell(190,5,'sakit (**) atau kecelakaan.',0,0,'L');
		$this->pdf->ln(4);
		$this->pdf->Cell(190,5,'3. Santunan Pembayaran 100% Uang Asuransi apabila Tertanggung hidup sampai dengan akhir kontrak asuransi 10 (sepuluh) tahun.',0,0,'L');
		$this->pdf->ln(4);
		$this->pdf->Cell(190,5,'Keunggulan lain dari produk ini pembayaran premi hanya 5 (lima) tahun dengan masa kontrak asuransi 10 (sepuluh) tahun.',0,0,'L');
		$this->pdf->ln(6);
		
		// DATA CALON TERTANGGUNG
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(50,5,'Data Calon Tertanggung',1,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Nama',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['namalengkapcalontertanggung'].' ',0,0,'L');
		$this->pdf->ln(4);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Tanggal Lahir / Usia',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['tanggallahircalontertangggung'].' / '.$data['hasil']['usiacalontertanggung'].' Tahun',0,0,'L');
		$this->pdf->ln();
		
		// DATA PERTANGGUNGAN
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(50,5,'Data Pertanggungan',1,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Paket Benefit',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['paketbenefit'].' ',0,0,'L');
		$this->pdf->ln(4);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Mulai Asuransi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['mulaiasuransijssin3rgy'].' ',0,0,'L');
		$this->pdf->ln(4);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Masa Asuransi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['masaasuransijssin3rgy'].' Tahun',0,0,'L');
		$this->pdf->ln(4);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Cara Bayar Premi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(32,5,''.$data['hasil']['carabayarpremi'].'',0,0,'L');
		$this->pdf->ln(4);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Masa Pembayaran Premi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['masapembayaranpremi'].' Tahun',0,0,'L');
		$this->pdf->ln(4);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Premi Pokok',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['premijsremaja'],0,'.',',').' '.$data['hasil']['carabayarpremi'].'',0,0,'L');
		$this->pdf->ln(4);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Total Premi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','B',8);
		if ($data['hasil']['carabayarpremi'] == 'Bulanan')
		{
			$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['tabelriderpremibulanan'],0,'.',',').' '.$data['hasil']['carabayarpremi'].'',0,0,'L');
		}
		else if ($data['hasil']['carabayarpremi'] == 'Tahunan')
		{
			$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['tabelriderpremitahunan'],0,'.',',').' '.$data['hasil']['carabayarpremi'].'',0,0,'L');	
		}
		$this->pdf->ln(6);
		
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(47.5,3,'','LTR',0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(47.5,3,'','LTR',0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(47.5,3,'SANTUNAN',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(47.5,3,'PREMI',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(47.5,3,'PAKET','LR',0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(47.5,3,'UANG ASURANSI','LR',0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(23.75,3,'RAWAT INAP DI','LR',0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(23.75,3,'RAWAT INAP DI','LR',0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(23.75,3,'BULANAN','LR',0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(23.75,3,'TAHUNAN','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(47.5,3,'','LR',0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(47.5,3,'','LR',0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(23.75,3,'RS/HARI','LR',0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(23.75,3,'ICU/HARI','LR',0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(23.75,3,'','LR',0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(23.75,3,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(47.5,5,''.$data['hasil']['paketbenefit'].'',1,0,'C');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(47.5,5,'Rp. '.number_format($data['hasil']['uangasuransi'],0,'.',',').' ',1,0,'C');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(23.75,5,'Rp. '.number_format($data['hasil']['ri'],0,'.',',').' ',1,0,'C');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(23.75,5,'Rp. '.number_format($data['hasil']['icu'],0,'.',',').' ',1,0,'C');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(23.75,5,'Rp. '.number_format($data['hasil']['premibulanan'],0,'.',',').' ',1,0,'C');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(23.75,5,'Rp. '.number_format($data['hasil']['premitahunan'],0,'.',',').' ',1,0,'C');
		$this->pdf->ln(6);
		
		// MANFAAT DASAR
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(50,5,'A. MANFAAT DASAR',1,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(165,5,'1. Apabila dalam masa pembayaran premi Tertanggung menjalani Rawat Inap (*) di Rumah Sakit, maka akan mendapatkan santunan Rawat Inap (*)',0,0,'L');
		$this->pdf->ln(4);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,5,'perhari sebesar',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(45,5,'Rp. '.number_format($data['hasil']['ri'],0,'.',',').'. ',0,0,'C');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(15,5,'Pembayaran santunan Rawat Inap (*) dalam setahun maksimal 90 hari.',0,0,'L');
		$this->pdf->ln(4);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(165,5,'2. Apabila dalam masa pembayaran premi Tertanggung menjalani Rawat ICU di Rumah Sakit, maka akan mendapatkan manfaat Rawat ICU perhari',0,0,'L');
		$this->pdf->ln(4);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,5,'sebesar',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(45,5,'Rp. '.number_format($data['hasil']['icu'],0,'.',',').',',0,0,'C');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(15,5,'dan dalam satu tahun maksimum Rawat Inap (*) selama 10 hari.',0,0,'L');
		$this->pdf->ln(4);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(165,5,'3. Apabila Tertanggung Meninggal Dunia dalam masa asuransi karena sebab apapun, maka dibayarkan manfaat asuransi kepada Ahliwaris sebesar',0,0,'L');
		$this->pdf->ln(4);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(45,5,'Rp. '.number_format($data['hasil']['uangasuransi'],0,'.',',').' ',0,0,'C');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(15,5,'dan pertanggungan menjadi berakhir.',0,0,'L');
		$this->pdf->ln(4);
		$this->pdf->Cell(150,5,'4. Apabila Tertanggung hidup sampai akhir masa asuransi, maka akan dibayarkan manfaat asuransi sebesar ',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(15,5,'Rp. '.number_format($data['hasil']['uangasuransi'],0,'.',',').'. ',0,0,'C');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->ln(6);
		
		// MANFAAT RIDER
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetFillColor(200,200,200);
			if (($data['hasil']['premihcpjssinergy']!=0)||($data['hasil']['premijsaddbjssinergy']!=0)||($data['hasil']['premitermjssinergy']!=0))
			{
					$this->pdf->Cell(50,5,'B. MANFAAT RIDER',1,0,'L', true);
					$this->pdf->ln();
					if ($data['hasil']['premitermjssinergy']!=0)				
					{
						$this->pdf->SetFont('Arial','',8);
						$this->pdf->Cell(165,5,'* Apabila Tertangggung meninggal dunia atau cacat, maka akan dibayarkan (*) perhari sebesar',0,0,'L');
						$this->pdf->ln(4);
						$this->pdf->SetFont('Arial','B',8);
						$this->pdf->Cell(45,5,'Rp. '.number_format($data['hasil']['uangasuransi'],0,'.',',').'. ',0,0,'C');
						$this->pdf->SetFont('Arial','',8);
						$this->pdf->Cell(15,5,'untuk cacat sebagian sesuai tabel manfaat.',0,0,'L');
						$this->pdf->ln(4);
					}
					if ($data['hasil']['premijsaddbjssinergy']!=0)				
					{
						$this->pdf->SetFont('Arial','',8);
						$this->pdf->Cell(165,5,'* Apabila Tertangggung meninggal dunia baik karena sakit atau kecelakaan, maka akan dibayarkan 100% Uang Asuransi JS ADDB sebesar',0,0,'L');
						$this->pdf->ln(4);
						$this->pdf->SetFont('Arial','B',8);
						$this->pdf->Cell(45,5,'Rp. '.number_format($data['hasil']['uangasuransi'],0,'.',',').'. ',0,0,'C').'.';
						$this->pdf->ln(4);
					}
					if ($data['hasil']['premihcpjssinergy']!=0)				
					{
						$this->pdf->SetFont('Arial','',8);
						$this->pdf->Cell(165,5,'* Apabila Tertanggung sakit dan dirawat di rumah Sakit, maka akan dibayarkan tambahan santunan Rawat Inap sebesar',0,0,'L');
						$this->pdf->ln(4);
						$this->pdf->SetFont('Arial','B',8);
						$this->pdf->Cell(45,5,'Rp. '.number_format($data['hasil']['ririder'],0,'.',',').'/hari',0,0,'C');
						$this->pdf->SetFont('Arial','',8);
						$this->pdf->Cell(15,5,'atau dirawat di ICU dengan santunan',0,0,'L');
						$this->pdf->SetFont('Arial','B',8);
						$this->pdf->Cell(100,5,'Rp. '.number_format($data['hasil']['icurider'],0,'.',',').'/hari. ',0,0,'C');
					}
			}
		$this->pdf->ln();
		
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(3);
		$this->pdf->Cell(165,5,'(*) Minimum Rawat Inap adalah 2 x 24 jam.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(3);
		$this->pdf->Cell(165,5,'(**) Penyakit-penyakit yang tidak dikecualikan pada Polis.',0,0,'L');
		$this->pdf->ln(8);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(255,0,0);
		$this->pdf->Cell(190,5,'Ilustrasi ini bukan merupakan kontrak asuransi, namun hanya ilustrasi. Manfaat sebenarnya tercantum dalam polis',1,0,'C', true);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->ln();
		
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
		$this->pdf->Cell(190,5,'ASURANSI JS SIN3RGY',1,0,'C', true);
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
		$this->pdf->ln(52);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(190,5,'*Keterangan: Untuk daftar provider dapat dilihat pada website berikut ini http://www.jiwasraya.co.id/id/provider',0,0,'C');
		
		$this->pdf->SetFont('Arial','I',6);
		$this->pdf->ln(8);
		$this->pdf->Cell(190,5,'PT. Asuransi Jiwasraya (Persero) terdaftar dan diawasi oleh Otoritas Jasa Keuangan (OJK)',1,0,'C', true);
		$this->pdf->ln();
		
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