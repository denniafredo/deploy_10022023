<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");
	
	error_reporting(0);

class Jsreplacementincomeassurance extends CI_Controller{

	function hitungjumlahrisikoawaljsgajiterusanplatinum(){
		
		$this->load->model('ModSimulasi');
		
		$gaji = $this->input->post("gaji");
		$usiasekarang = $this->input->post("usiasekarang");		
		
		$masaasuransijsgajiterusan = $this->input->post("masaasuransijsgajiterusan");	
		$result = $this->ModSimulasi->getJumlahRisikoAwalJSGajiTerusanPlatinum($masaasuransijsgajiterusan);
		
		$hasil = ($result['TARIF'] / 100) * $gaji;b
		
		echo $hasil;
	}
	
	function hitungpremitahunke6danseterusnyajsgajiterusanplatinum(){
		
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
	
	function hitungpremi5tahunpertamajsgajiterusanplatinum(){
		
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
	
		echo floatval(preg_replace("/[^-0-9\.]/","",($result[$usiasekarang]))) / 1000 * $gaji * (1+ (5/100));
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
			'gaji' => $this->input->post('gaji'),
			'jumlahrisikoawaljsgajiterusanplatinum' => $this->input->post('jumlahrisikoawaljsgajiterusanplatinum'),
			'premi5tahunpertama' => $this->input->post('premi5tahunpertama'),
			'premitahunke6danseterusnya' => $this->input->post('premitahunke6danseterusnya'),
			'masaasuransijsgajiterusan' => $this->input->post('masaasuransijsgajiterusan'),
			'carabayarpremijsgajiterusan' => $this->input->post('carabayarpremijsgajiterusan'),
			'saatmulaiasuransijsgajiterusan' => $this->input->post('saatmulaiasuransijsgajiterusan'),
			
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
		
		$data['hasil']['uangasuransipokok'] = $this->session->userdata('uangasuransipokok');
		$data['hasil']['masaasuransi'] = $this->session->userdata('masaasuransi');
		$data['hasil']['gaji'] = $this->session->userdata('gaji');
		
		$data['hasil']['filepdf'] = $this->session->userdata('filepdf');
		$data['hasil']['id_nasabah'] = $this->session->userdata('id_nasabah');
		$data['hasil']['id_agen']	 = $this->session->userdata('id_agen');
		//$data['hasil']['file_pdf']	 = $filePdf.'.pdf',
		$data['hasil']['id_produk']  = $this->session->userdata('id_produk');
		
		$data['hasil']['jumlahrisikoawaljsgajiterusanplatinum']  = $this->session->userdata('jumlahrisikoawaljsgajiterusanplatinum');
		$data['hasil']['premi5tahunpertama']  = $this->session->userdata('premi5tahunpertama');
		$data['hasil']['premitahunke6danseterusnya']  = $this->session->userdata('premitahunke6danseterusnya');
		$data['hasil']['masaasuransijsgajiterusan']  = $this->session->userdata('masaasuransijsgajiterusan');

		$data['hasil']['carabayarpremijsgajiterusan']  = $this->session->userdata('carabayarpremijsgajiterusan');
		
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
			'CARA_BAYAR' => $data['hasil']['carabayarpremijsgajiterusan'],
			'JUMLAH_PREMI' => $data['hasil']['premi5tahunpertama']
		);
		
		$this->ModSimulasi->insertSimulasi($data['hitung']);
		
		$data['hasil']['build_id'] = $data['hitung']['BUILD_ID'];
				
		$filePdf = $this->session->userdata('filepdf');
		
		$this->createPDF($filePdf,$data);
		
		$this->load->view('hasil/jsreplacementincomeassurance',$data);
		
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
		$this->pdf->Cell(190,5,'JS Replacement Income Assurance',1,0,'C', true);
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','I',8);
		$this->pdf->SetTextColor(255,0,0);
		$this->pdf->Cell(190,5,'Proteksi financial keluarga Anda!','0',0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'Yth Bapak/Ibu Prospek, berikut ini kami sampaikan ringkasan produk JS Kelangsungan Pendidikan untuk membantu buah hati tercinta dalam mewujud-',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'kan cita-cita,',0,0,'L');
		$this->pdf->ln(10);

		// CALON TERTANGGUNG
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(50,5,'DATA PERTANGGUNGAN',1,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Nama Tertangggung',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['namalengkapcalontertanggung'].' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Tanggal Lahir / Usia',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['tanggallahircalontertangggung'].' / '.$data['hasil']['usiacalontertanggung'].' tahun',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(50,5,'Gaji',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['gaji'],0,'.',',').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Premi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['premi5tahunpertama'],0,'.',',').' premi 5 Tahun Pertama ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['premitahunke6danseterusnya'],0,'.',',').' premi tahun ke-6 dan seterusnya ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Resiko Awal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['jumlahrisikoawaljsgajiterusanplatinum'],0,'.',',').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Masa Asuransi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['masaasuransijsgajiterusan'].' tahun',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Cara Bayar Premi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['carabayarpremijsgajiterusan'].' ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Mulai Asuransi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,5,''.$data['hasil']['saatmulaiasuransijsgajiterusan'].' ',0,0,'L');
		$this->pdf->ln(10);

		// MANFAAT ASURANSI
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(50,5,'MANFAAT ASURANSI',1,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'a. Manfaat Ekspirasi',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(165,5,'			 Apabila Tertanggung hidup sampai akhir Masa Asuransi, maka Jiwasraya akan mengembalikan 100% Akumulasi Premi',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(165,5,'			 yang telah dibayarkan, sebesar',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(25,5,'Rp. '.number_format(12 * $data['hasil']['premitahunke6danseterusnya'] * $data['hasil']['masaasuransijsgajiterusan'],0,'.',',').'',0,0,'R');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'b. Meninggal Dunia Asumsi Meninggal di akhir tahun ke-'.($data['hasil']['masaasuransijsgajiterusan'] - 3).'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(165,5,'			 Apabila Tertanggung meninggal dunia dalam masa asuransi, maka kepada ahliwaris akan dibayarkan:',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(165,5,'				- Pengembalian 100% Premi yang telah dibayarkan',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(25,5,'Rp. '.number_format(12 * $data['hasil']['premitahunke6danseterusnya'] * ($data['hasil']['masaasuransijsgajiterusan'] - 3),0,'.',',').'',0,0,'R');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(165,5,'				- Pembayaran Gaji Bulanan sebesar ',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(25,5,'Rp. '.number_format($data['hasil']['gaji'],0,'.',',').'',0,0,'R');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(165,5,'			 		setiap bulan mulai bulan berikutnya setelah Tertanggung meninggal dunia sampai berakhirnya Masa Asuransi. ',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'c. Batal Dalam masa Asuransi',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(165,5,'			 Pemegang Polis dapat melakukan penarikan Nilai Tebus Polis setelah Masa Asuransi berjalan lebih dari 1 Tahun.',0,0,'L');
		$this->pdf->ln(40);
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
		$this->pdf->Cell(190,5,'JS Replacement Income Assurance',1,0,'C', true);
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