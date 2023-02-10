<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");
	
	error_reporting(0);

class Paketproteksiuntukkeluarga extends CI_Controller{

	function hitungpremijsprestasi(){
		
		$this->load->model('ModSimulasi');
		
		$jumlahuangasuransianakke1 = $this->input->post("jumlahuangasuransianakke1");
		$statusmedical = $this->input->post("statusmedical");	
	
		$usiaanakke1 = $this->input->post("usiaanakke1");	
		$usiaanakke1fix = 18 - $usiaanakke1;

		if ($usiaanakke1fix == 5)
		{
			$usiaanakket = 'USIAANAK5';
		}
		else if ($usiaanakke1fix == 6)
		{
			$usiaanakket = 'USIAANAK6';
		}
		else if ($usiaanakke1fix == 7)
		{
			$usiaanakket = 'USIAANAK7';
		}
		else if ($usiaanakke1fix == 8)
		{
			$usiaanakket = 'USIAANAK8';
		}
		else if ($usiaanakke1fix == 9)
		{
			$usiaanakket = 'USIAANAK9';
		}
		else if ($usiaanakke1fix == 10)
		{
			$usiaanakket = 'USIAANAK10';
		}
		else if ($usiaanakke1fix == 11)
		{
			$usiaanakket = 'USIAANAK11';
		}
		else if ($usiaanakke1fix == 12)
		{
			$usiaanakket = 'USIAANAK12';
		}
		else if ($usiaanakke1fix == 13)
		{
			$usiaanakket = 'USIAANAK13';
		}
		else if ($usiaanakke1fix == 14)
		{
			$usiaanakket = 'USIAANAK14';
		}
		else if ($usiaanakke1fix == 15)
		{
			$usiaanakket = 'USIAANAK15';
		}
		else if ($usiaanakke1fix == 16)
		{
			$usiaanakket = 'USIAANAK16';
		}
		else if ($usiaanakke1fix == 17)
		{
			$usiaanakket = 'USIAANAK17';
		}
		else if ($usiaanakke1fix == 18)
		{
			$usiaanakket = 'USIAANAK18';
		}
		
		$usiatertanggung1jssiharta = $this->input->post("usiatertanggung1jssiharta");
		
		$result = $this->ModSimulasi->getPremiJsPrestasiAnakKe1($statusmedical, $usiaanakket, $usiatertanggung1jssiharta);
		
		//$hasil = $result[$usiasekarang] * $gaji;
	
		echo round(floatval(preg_replace("/[^-0-9\.]/","",($result[$usiaanakket]))) / 100 * ($jumlahuangasuransianakke1 / 1000) * 0.095) ;
		
	}
	
	function hitungpremijsprestasi2(){
		
		$this->load->model('ModSimulasi');
		
		$jumlahuangasuransianakke2 = $this->input->post("jumlahuangasuransianakke2");
		$statusmedical2 = $this->input->post("statusmedical2");	
	
		$usiaanakke2 = $this->input->post("usiaanakke2");	
		$usiaanakke2fix = 18 - $usiaanakke2;

		if ($usiaanakke2fix == 5)
		{
			$usiaanakket2 = 'USIAANAK5';
		}
		else if ($usiaanakke2fix == 6)
		{
			$usiaanakket2 = 'USIAANAK6';
		}
		else if ($usiaanakke2fix == 7)
		{
			$usiaanakket2 = 'USIAANAK7';
		}
		else if ($usiaanakke2fix == 8)
		{
			$usiaanakket2 = 'USIAANAK8';
		}
		else if ($usiaanakke2fix == 9)
		{
			$usiaanakket2 = 'USIAANAK9';
		}
		else if ($usiaanakke2fix == 10)
		{
			$usiaanakket2 = 'USIAANAK10';
		}
		else if ($usiaanakke2fix == 11)
		{
			$usiaanakket2 = 'USIAANAK11';
		}
		else if ($usiaanakke2fix == 12)
		{
			$usiaanakket2 = 'USIAANAK12';
		}
		else if ($usiaanakke2fix == 13)
		{
			$usiaanakket2 = 'USIAANAK13';
		}
		else if ($usiaanakke2fix == 14)
		{
			$usiaanakket2 = 'USIAANAK14';
		}
		else if ($usiaanakke2fix == 15)
		{
			$usiaanakket2 = 'USIAANAK15';
		}
		else if ($usiaanakke2fix == 16)
		{
			$usiaanakket2 = 'USIAANAK16';
		}
		else if ($usiaanakke2fix == 17)
		{
			$usiaanakket2 = 'USIAANAK17';
		}
		else if ($usiaanakke2fix == 18)
		{
			$usiaanakket2 = 'USIAANAK18';
		}
		
		$usiatertanggung2jssiharta = $this->input->post("usiatertanggung2jssiharta");
		
		$result = $this->ModSimulasi->getPremiJsPrestasiAnakKe2($statusmedical2, $usiaanakket2, $usiatertanggung2jssiharta);
		
		//$hasil = $result[$usiasekarang] * $gaji;
	
		echo round(floatval(preg_replace("/[^-0-9\.]/","",($result[$usiaanakket2]))) / 100 * ($jumlahuangasuransianakke2 / 1000) * 0.095) ;
		
	}
	
	function hitungpremijsgajiterusanplatinum(){
		
		$this->load->model('ModSimulasi');
		
		$gaji = $this->input->post("gaji");
		$masaasuransijsgajiterusan = $this->input->post("masaasuransijsgajiterusan");	
	
		$usiasekarang = $this->input->post("usiasekarang");	

		if ($usiasekarang == 20)
		{
			$usiasekarang = 'UMUR20';
		}
		else if ($usiasekarang == 21)
		{
			$usiasekarang = 'UMUR21';
		}
		else if ($usiasekarang == 22)
		{
			$usiasekarang = 'UMUR22';
		}
		else if ($usiasekarang == 23)
		{
			$usiasekarang = 'UMUR23';
		}
		else if ($usiasekarang == 24)
		{
			$usiasekarang = 'UMUR24';
		}
		else if ($usiasekarang == 25)
		{
			$usiasekarang = 'UMUR25';
		}
		else if ($usiasekarang == 26)
		{
			$usiasekarang = 'UMUR26';
		}
		else if ($usiasekarang == 27)
		{
			$usiasekarang = 'UMUR27';
		}
		else if ($usiasekarang == 28)
		{
			$usiasekarang = 'UMUR28';
		}
		else if ($usiasekarang == 29)
		{
			$usiasekarang = 'UMUR29';
		}
		else if ($usiasekarang == 30)
		{
			$usiasekarang = 'UMUR30';
		}
		else if ($usiasekarang == 31)
		{
			$usiasekarang = 'UMUR31';
		}
		else if ($usiasekarang == 32)
		{
			$usiasekarang = 'UMUR32';
		}
		else if ($usiasekarang == 33)
		{
			$usiasekarang = 'UMUR33';
		}
		else if ($usiasekarang == 34)
		{
			$usiasekarang = 'UMUR34';
		}
		else if ($usiasekarang == 35)
		{
			$usiasekarang = 'UMUR35';
		}
		else if ($usiasekarang == 36)
		{
			$usiasekarang = 'UMUR36';
		}
		else if ($usiasekarang == 37)
		{
			$usiasekarang = 'UMUR37';
		}
		else if ($usiasekarang == 38)
		{
			$usiasekarang = 'UMUR38';
		}
		else if ($usiasekarang == 39)
		{
			$usiasekarang = 'UMUR39';
		}
		else if ($usiasekarang == 40)
		{
			$usiasekarang = 'UMUR40';
		}
		else if ($usiasekarang == 41)
		{
			$usiasekarang = 'UMUR41';
		}
		else if ($usiasekarang == 42)
		{
			$usiasekarang = 'UMUR42';
		}
		else if ($usiasekarang == 43)
		{
			$usiasekarang = 'UMUR43';
		}
		else if ($usiasekarang == 44)
		{
			$usiasekarang = 'UMUR44';
		}
		else if ($usiasekarang == 45)
		{
			$usiasekarang = 'UMUR45';
		}
		else if ($usiasekarang == 46)
		{
			$usiasekarang = 'UMUR46';
		}
		else if ($usiasekarang == 47)
		{
			$usiasekarang = 'UMUR47';
		}
		else if ($usiasekarang == 48)
		{
			$usiasekarang = 'UMUR48';
		}
		else if ($usiasekarang == 49)
		{
			$usiasekarang = 'UMUR49';
		}
		else if ($usiasekarang == 50)
		{
			$usiasekarang = 'UMUR50';
		}
		else if ($usiasekarang == 51)
		{
			$usiasekarang = 'UMUR51';
		}
		else if ($usiasekarang == 52)
		{
			$usiasekarang = 'UMUR52';
		}
		else if ($usiasekarang == 53)
		{
			$usiasekarang = 'UMUR53';
		}
		else if ($usiasekarang == 54)
		{
			$usiasekarang = 'UMUR54';
		}
		else if ($usiasekarang == 55)
		{
			$usiasekarang = 'UMUR55';
		}
		
		$result = $this->ModSimulasi->getPremiJSGajiTerusanPlatinum($masaasuransijsgajiterusan, $usiasekarang);
		
		//$hasil = $result[$usiasekarang] * $gaji;
	
		echo floatval(preg_replace("/[^-0-9\.]/","",($result[$usiasekarang]))) / 1000 * $gaji;
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
			
			'namajsgajiterusanplatinum' => $this->input->post('namajsgajiterusanplatinum'),
			
			'gajijsgajiterusanplatinum' => $this->input->post('gajijsgajiterusanplatinum'),
			'premijsgajiterusanplatinum' => $this->input->post('premijsgajiterusanplatinum'),
			
			'premibulananjssiharta' => $this->input->post('premibulananjssiharta'),
			
			'jumlahuangasuransianakke1jssiharta' => $this->input->post('jumlahuangasuransianakke1jssiharta'),
			'premianakke1jsprestasi' => $this->input->post('premianakke1jsprestasi'),
			
			'jumlahuangasuransianakke2jssiharta' => $this->input->post('jumlahuangasuransianakke2jssiharta'),
			'premianakke2jsprestasi' => $this->input->post('premianakke2jsprestasi'),
			
			'totalpremikeluarga' => $this->input->post('totalpremikeluarga'),
			
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
		
		$tanggalSaatMulaiAsuransi = date("d", strtotime($this->session->userdata('saatmulaiasuransijsgajiterusan')));
		$bulanSaatMulaiAsuransi = $bulan[date("n", strtotime($this->session->userdata('saatmulaiasuransijsgajiterusan')))];
		$tahunSaatMulaiAsuransi = date("Y", strtotime($this->session->userdata('saatmulaiasuransijsgajiterusan')));
		$data['hasil']['saatmulaiasuransijsgajiterusan'] = $tanggalSaatMulaiAsuransi.' '.$bulanSaatMulaiAsuransi.' '.$tahunSaatMulaiAsuransi;
		
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
		
		$data['hasil']['namajsgajiterusanplatinum']  = $this->session->userdata('namajsgajiterusanplatinum');
		
		$data['hasil']['gajijsgajiterusanplatinum']  = $this->session->userdata('gajijsgajiterusanplatinum');
		$data['hasil']['premijsgajiterusanplatinum']  = $this->session->userdata('premijsgajiterusanplatinum');
		
		$data['hasil']['premibulananjssiharta']  = $this->session->userdata('premibulananjssiharta');
		
		$data['hasil']['jumlahuangasuransianakke1jssiharta']  = $this->session->userdata('jumlahuangasuransianakke1jssiharta');
		$data['hasil']['premianakke1jsprestasi']  = $this->session->userdata('premianakke1jsprestasi');
		
		$data['hasil']['jumlahuangasuransianakke2jssiharta']  = $this->session->userdata('jumlahuangasuransianakke2jssiharta');
		$data['hasil']['premianakke2jsprestasi']  = $this->session->userdata('premianakke2jsprestasi');
		
		$data['hasil']['totalpremikeluarga']  = $this->session->userdata('totalpremikeluarga');
		
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
		
		$this->load->view('hasil/paketproteksiuntukkeluarga',$data);
		
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
		$this->pdf->Cell(190,5,'PAKET PROTEKSI UNTUK KELUARGA',1,0,'C', true);
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','I',8);
		$this->pdf->SetTextColor(255,0,0);
		$this->pdf->Cell(190,5,'Proteksi financial keluarga Anda!','0',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->ln(10);

		// CALON TERTANGGUNG
		$this->pdf->Cell(50,5,'Disajikan untuk Bapak/Ibu',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(32,5,''.$data['hasil']['namajsgajiterusanplatinum'].' ',0,0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(38,5,'',1,0,'C');
		$this->pdf->Cell(38,5,'RINCIAN PREMI',1,0,'C');
		$this->pdf->Cell(38,5,'PRODUK',1,0,'C');
		$this->pdf->Cell(38,5,'PREMI',1,0,'C');
		$this->pdf->Cell(38,5,'UANG ASURANSI',1,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(38,5,'A.','LBR',0,'C');
		$this->pdf->Cell(38,5,'Tertanggung Ayah',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(38,5,'JS GTP',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(38,5,'Rp. '.number_format($data['hasil']['premijsgajiterusanplatinum'],0,'.',',').'',1,0,'C');
		$this->pdf->Cell(38,5,'Rp. '.number_format($data['hasil']['gajijsgajiterusanplatinum'],0,'.',',').'',1,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(38,5,'B.','LBR',0,'C');
		$this->pdf->Cell(38,5,'Tertanggung Ibu',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(38,5,'JS SIHARTA',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(38,5,'Rp. '.number_format($data['hasil']['premibulananjssiharta'],0,'.',',').'',1,0,'C');
		$this->pdf->Cell(38,5,'Rp. '.number_format($data['hasil']['premibulananjssiharta'] * 25,0,'.',',').'',1,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(38,5,'C.','LBR',0,'C');
		$this->pdf->Cell(38,5,'Tertanggung Anak1',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(38,5,'JS PRESTASI',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(38,5,'Rp. '.number_format($data['hasil']['premianakke1jsprestasi'],0,'.',',').'',1,0,'C');
		$this->pdf->Cell(38,5,'Rp. '.number_format($data['hasil']['jumlahuangasuransianakke1jssiharta'],0,'.',',').'',1,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(38,5,'D.','LBR',0,'C');
		$this->pdf->Cell(38,5,'Tertanggung Anak2',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(38,5,'JS PRESTASI',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(38,5,'Rp. '.number_format($data['hasil']['premianakke2jsprestasi'],0,'.',',').'',1,0,'C');
		$this->pdf->Cell(38,5,'Rp. '.number_format($data['hasil']['jumlahuangasuransianakke2jssiharta'],0,'.',',').'',1,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(38,5,'','LBR',0,'C');
		$this->pdf->Cell(38,5,'',1,0,'C');
		$this->pdf->Cell(38,5,'TOTAL',1,0,'C');
		$this->pdf->Cell(38,5,'Rp. '.number_format($data['hasil']['totalpremikeluarga'],0,'.',',').'',1,0,'C');
		$this->pdf->Cell(38,5,'',1,0,'C');
		$this->pdf->ln(10);

		// MANFAAT PRODUK
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(50,5,'MANFAAT PRODUK',1,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'A. JS Gaji Terusan Platinum',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(165,5,'					Produk Asuransi Jiwa yang memberikan jaminan keuangan keluarga apabila Ayah sebagai pencari nafkah mengalami risiko meninggal dunia di usia',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(165,5,'			 	aktif bekerja.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'B. JS Siharta',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(165,5,'			  Produk Asuransi Jiwa yang memberikan perlindungan keuangan keluarga, apabila terjadi risiko meninggal dunia karena sakit atau kecelakaan',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(165,5,'					terhadap Ibu selama masa asuransi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'C. JS Prestasi',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(165,5,'			 	Produk Asuransi Pendidikan yang menjamin biaya pendidikan putera-puteri Tertanggung mulai dari SD sampai Perguruan Tinggi, walaupun terjadi',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(165,5,'					risiko meninggal dunia atau cacat tetap total karena sakit atau kecelakaan terhadap Tertanggung.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'D. JS Prestasi',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(165,5,'			 	Produk Asuransi Pendidikan yang menjamin biaya pendidikan putera-puteri Tertanggung mulai dari SD sampai Perguruan Tinggi, walaupun terjadi',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(165,5,'					risiko meninggal dunia atau cacat tetap total karena sakit atau kecelakaan terhadap Tertanggung.',0,0,'L');
		$this->pdf->ln(55);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(255,0,0);
		$this->pdf->Cell(190,5,'Saya mengerti bahwa Ilustrasi ini bukan merupakan kontrak asuransi, namun hanya ilustrasi. Manfaat sebenarnya tercantum dalam Polis',1,0,'C', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->Cell(190,5,'Untuk informasi lebih lanjut dapat menghubungi Call Canter (021) 1 500 151 atau Kantor Cabang Jiwasraya terdekat.',0,0,'C');
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
		$this->pdf->Cell(190,5,'PAKET PROTEKSI UNTUK KELUARGA',1,0,'C', true);
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