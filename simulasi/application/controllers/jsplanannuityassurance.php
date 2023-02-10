<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");

	error_reporting(0);

class JSplanannuityassurance extends CI_Controller{

	function hitungpremisekaligusaspjsanuitas(){
		
		$this->load->model('ModSimulasi');
		
		$statuskawin = $this->input->post("statuskawin");
		$premisekaligusjsanuitas = $this->input->post("premisekaligusjsanuitas");
		
		$tahunmulas = date("Y", strtotime($this->input->post('saatmulaiasuransijsanuitas')));
		$bulanmulas = date("n", strtotime($this->input->post('saatmulaiasuransijsanuitas')));
		
		$tanggallahir = date("d", strtotime($this->input->post('tgllahir')));
		$tahunlahir = date("Y", strtotime($this->input->post('tgllahir')));
			
		$selisihMulas = $tahunmulas + $bulanmulas/12;
		
		if (round($tanggallahir) > 1)
		{
			$bulanlahir = date("n", strtotime($this->input->post('tgllahir')))+1;
		}
		else
		{
			$bulanlahir = date("n", strtotime($this->input->post('tgllahir')));
		}
		
		$selisihLahir = $tahunlahir + $bulanlahir/12;
		$selisihUmur = $selisihMulas - $selisihLahir;
		$usiaSekarang = intval($selisihUmur);
		$selisihBulan = round(($selisihUmur - $usiaSekarang)*12);
		
		$umur = floor(($tahunmulas + ($bulanmulas/12)) - ($tahunlahir + ($bulanlahir/12)));
		$tahun = intval($umur);
		
		$bulan = ($umur - $tahun) * 12;
		
		$tarifanuitasasp1 = $this->ModSimulasi->GetTarifAnuitasASP($usiaSekarang, $statuskawin);
		$tarifanuitasasp2 = $this->ModSimulasi->GetTarifAnuitasASP(($usiaSekarang + 1), $statuskawin);
		
		$tarifinterpolasi = (($tarifanuitasasp1['TARIF']*(12-$selisihBulan)+$tarifanuitasasp2['TARIF']*$selisihBulan)/12);
		
		$pht = $premisekaligusjsanuitas/$tarifinterpolasi*100;
		
		echo round($pht);
	}
	
	function hitungpremisekaligusasijsanuitas(){
		
		$this->load->model('ModSimulasi');
		
		$statuskawin = $this->input->post("statuskawin");
		$premisekaligusjsanuitas = $this->input->post("premisekaligusjsanuitas");
		
		$tahunmulas = date("Y", strtotime($this->input->post('saatmulaiasuransijsanuitas')));
		$bulanmulas = date("n", strtotime($this->input->post('saatmulaiasuransijsanuitas')));
		
		$tanggallahir = date("d", strtotime($this->input->post('tgllahir')));
		$tahunlahir = date("Y", strtotime($this->input->post('tgllahir')));
			
		$selisihMulas = $tahunmulas + $bulanmulas/12;
		
		if (round($tanggallahir) > 1)
		{
			$bulanlahir = date("n", strtotime($this->input->post('tgllahir')))+1;
		}
		else
		{
			$bulanlahir = date("n", strtotime($this->input->post('tgllahir')));
		}
		
		$selisihLahir = $tahunlahir + $bulanlahir/12;
		$selisihUmur = $selisihMulas - $selisihLahir;
		$usiaSekarang = intval($selisihUmur);
		$selisihBulan = round(($selisihUmur - $usiaSekarang)*12);
		
		$umur = floor(($tahunmulas + ($bulanmulas/12)) - ($tahunlahir + ($bulanlahir/12)));
		$tahun = intval($umur);
		
		$bulan = ($umur - $tahun) * 12;
		
		$tarifanuitasasi1 = $this->ModSimulasi->GetTarifAnuitasASI($usiaSekarang, $statuskawin);
		$tarifanuitasasi2 = $this->ModSimulasi->GetTarifAnuitasASI(($usiaSekarang + 1), $statuskawin);
		
		$tarifinterpolasi = (($tarifanuitasasi1['TARIF']*(12-$selisihBulan)+$tarifanuitasasi2['TARIF']*$selisihBulan)/12);
		
		$pht = $premisekaligusjsanuitas/$tarifinterpolasi*100;
		
		echo round($pht);
	}
	
	function hitungpremisekaligusanijsanuitas(){
		
		$this->load->model('ModSimulasi');
		
		$statuskawin = $this->input->post("statuskawin");
		$premisekaligusjsanuitas = $this->input->post("premisekaligusjsanuitas");
		
		$tahunmulas = date("Y", strtotime($this->input->post('saatmulaiasuransijsanuitas')));
		$bulanmulas = date("n", strtotime($this->input->post('saatmulaiasuransijsanuitas')));
		
		$tanggallahir = date("d", strtotime($this->input->post('tgllahir')));
		$tahunlahir = date("Y", strtotime($this->input->post('tgllahir')));
			
		$selisihMulas = $tahunmulas + $bulanmulas/12;
		
		if (round($tanggallahir) > 1)
		{
			$bulanlahir = date("n", strtotime($this->input->post('tgllahir')))+1;
		}
		else
		{
			$bulanlahir = date("n", strtotime($this->input->post('tgllahir')));
		}
		
		$selisihLahir = $tahunlahir + $bulanlahir/12;
		$selisihUmur = $selisihMulas - $selisihLahir;
		$usiaSekarang = intval($selisihUmur);
		$selisihBulan = round(($selisihUmur - $usiaSekarang)*12);
		
		$umur = floor(($tahunmulas + ($bulanmulas/12)) - ($tahunlahir + ($bulanlahir/12)));
		$tahun = intval($umur);
		
		$bulan = ($umur - $tahun) * 12;
		
		$tarifanuitasani1 = $this->ModSimulasi->GetTarifAnuitasANI($usiaSekarang, $statuskawin);
		$tarifanuitasani2 = $this->ModSimulasi->GetTarifAnuitasANI(($usiaSekarang + 1), $statuskawin);
		
		$tarifinterpolasi = (($tarifanuitasani1['TARIF']*(12-$selisihBulan)+$tarifanuitasani2['TARIF']*$selisihBulan)/12);
		
		$pht = $premisekaligusjsanuitas/$tarifinterpolasi*100;
		
		echo round($pht);
	}
	
	function hitungpremisekaligusaepjsanuitas(){
		
		$this->load->model('ModSimulasi');
		
		$statuskawin = $this->input->post("statuskawin");
		$premisekaligusjsanuitas = $this->input->post("premisekaligusjsanuitas");
		
		$tahunmulas = date("Y", strtotime($this->input->post('saatmulaiasuransijsanuitas')));
		$bulanmulas = date("n", strtotime($this->input->post('saatmulaiasuransijsanuitas')));
		
		$tanggallahir = date("d", strtotime($this->input->post('tgllahir')));
		$tahunlahir = date("Y", strtotime($this->input->post('tgllahir')));
			
		$selisihMulas = $tahunmulas + $bulanmulas/12;
		
		if (round($tanggallahir) > 1)
		{
			$bulanlahir = date("n", strtotime($this->input->post('tgllahir')))+1;
		}
		else
		{
			$bulanlahir = date("n", strtotime($this->input->post('tgllahir')));
		}
		
		$selisihLahir = $tahunlahir + $bulanlahir/12;
		$selisihUmur = $selisihMulas - $selisihLahir;
		$usiaSekarang = intval($selisihUmur);
		$selisihBulan = round(($selisihUmur - $usiaSekarang)*12);
		
		$umur = floor(($tahunmulas + ($bulanmulas/12)) - ($tahunlahir + ($bulanlahir/12)));
		$tahun = intval($umur);
		
		$bulan = ($umur - $tahun) * 12;
		
		$tarifanuitasaep1 = $this->ModSimulasi->GetTarifAnuitasAEP($usiaSekarang, $statuskawin);
		$tarifanuitasaep2 = $this->ModSimulasi->GetTarifAnuitasAEP(($usiaSekarang + 1), $statuskawin);
		
		$tarifinterpolasi = (($tarifanuitasaep1['TARIF']*(12-$selisihBulan)+$tarifanuitasaep2['TARIF']*$selisihBulan)/12);
		
		//$pht = $premisekaligusjsanuitas/$tarifinterpolasi*100;
		
		$pht = $premisekaligusjsanuitas*100/$tarifanuitasaep1['TARIF'];
		
		echo round($pht);
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
			'statuskawin' => $this->input->post('statuskawin'),
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
			'nomeragen' => $this->input->post('nomeragen'),
			'kodekantor' => $this->input->post('kodekantor'),
			//'kantorcabang' => $this->input->post('kantorcabang'),
			'premisekaligusjsanuitas' => $this->input->post('premisekaligusjsanuitas'),
			'statuskawin' => $this->input->post('statuskawin'),
			'pilihananuitas' => $this->input->post('pilihananuitas'),
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
			'premisekaligusjsanuitas' => $this->input->post('premisekaligusjsanuitas'),
			'masaasuransi' => $this->input->post('masaasuransi'),
			'saatmulaiasuransijsanuitas' => $this->input->post('saatmulaiasuransijsanuitas'),
			
			'aspkawin' => $this->input->post('aspkawin'),
			'aspbujang' => $this->input->post('aspbujang'),
			'asikawin' => $this->input->post('asikawin'),
			'asibujang' => $this->input->post('asibujang'),
			'aikawin' => $this->input->post('aikawin'),
			'aibujang' => $this->input->post('aibujang'),
			'aepkawin' => $this->input->post('aepkawin'),
			'aepbujang' => $this->input->post('aepbujang')
			
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
		
		$tanggalSaatMulaiAsuransi = date("d", strtotime($this->session->userdata('saatmulaiasuransijsanuitas')));
		$bulanSaatMulaiAsuransi = $bulan[date("n", strtotime($this->session->userdata('saatmulaiasuransijsanuitas')))];
		$bulanPembayaranSekaligus = $bulan[date("n", strtotime($this->session->userdata('saatmulaiasuransi'))) + 1];
		$tahunSaatMulaiAsuransi = date("Y", strtotime($this->session->userdata('saatmulaiasuransijsanuitas')));
		$data['hasil']['saatmulaiasuransi'] = $tanggalSaatMulaiAsuransi.' '.$bulanSaatMulaiAsuransi.' '.$tahunSaatMulaiAsuransi;
		
		$data['hasil']['tahunSaatMulaiAsuransi'] = $tahunSaatMulaiAsuransi;
		$data['hasil']['bulanSaatMulaiAsuransi'] = date("n", strtotime($this->session->userdata('saatmulaiasuransijsanuitas')));
		
		$data['hasil']['selisihMulas'] = ($data['hasil']['tahunSaatMulaiAsuransi']+ $data['hasil']['bulanSaatMulaiAsuransi']/12);
		
		$tanggalLahir = date("d", strtotime($this->session->userdata('tgl_lahir')));
		$bulanLahir = $bulan[date("n", strtotime($this->session->userdata('tgl_lahir')))];
		$tahunLahir = date("Y", strtotime($this->session->userdata('tgl_lahir')));
		$data['hasil']['tgl_lahir'] = $tanggalLahir.' '.$bulanLahir.' '.$tahunLahir;
		
		$data['hasil']['tanggalLahir'] = $tanggalLahir;
		if($data['hasil']['tanggalLahir']>1)
		{
		$data['hasil']['bulanLahir'] = date("n", strtotime($this->session->userdata('tgl_lahir'))) + 1;
		}
		else
		{
		$data['hasil']['bulanLahir'] = date("n", strtotime($this->session->userdata('tgl_lahir')));
		}
		
		$data['hasil']['selisihLahir'] = ($data['hasil']['tahunLahir']+ $data['hasil']['bulanLahir']/12);
		
		$data['hasil']['selisihUmur'] = round((($data['hasil']['selisihMulas'] - $data['hasil']['selisihLahir']) - intval($data['hasil']['selisihMulas'] - $data['hasil']['selisihLahir']))*12);
		
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
		
		$data['hasil']['selisihbulancalonpemegangpolis'] = 0;
		$data['hasil']['selisihbulancalontertanggung'] = 0;
									
		$data['hasil']['jeniskelamin'] = $this->session->userdata('jeniskelamincalontertanggung');
		
		if ($data['hasil']['jeniskelamin'] == 'Laki-Laki')
		{
			$data['hasil']['jeniskelamincalontertanggung'] = 'Bpk. ';
		}
		else if ($data['hasil']['jeniskelamin'] == 'Perempuan')
		{
			$data['hasil']['jeniskelamincalontertanggung'] = 'Ibu. ';
		}
		
		$jeniskel = $this->session->userdata('jenis_kel');
		
		if ($jeniskel == 'M')
		{
			$data['hasil']['jenis_kel'] = 'Laki-laki';
		}
		else if ($jeniskel == 'F')
		{
			$data['hasil']['jenis_kel'] = 'Perempuan';
		}
		
		$data['hasil']['pilihananuitas'] = $this->session->userdata('pilihananuitas');
		
		$data['hasil']['namalengkapcalontertanggung'] = $this->session->userdata('namalengkapcalontertanggung');
		
		$data['hasil']['premisekaligusjsanuitas'] = $this->session->userdata('premisekaligusjsanuitas');
		$data['hasil']['masaasuransi'] = $this->session->userdata('masaasuransi');
		
		$data['hasil']['filepdf'] = $this->session->userdata('filepdf');
		$data['hasil']['id_nasabah'] = $this->session->userdata('id_nasabah');
		$data['hasil']['id_agen']	 = $this->session->userdata('id_agen');
		//$data['hasil']['file_pdf']	 = $filePdf.'.pdf',
		$data['hasil']['id_produk']  = $this->session->userdata('id_produk');
			
		$usiasekarang = $data['hasil']['usiacalontertanggung'];
		$tarifanuitasasp1 = $this->ModSimulasi->GetTarifAnuitasASP($usiasekarang);
		$tarifanuitasasp2 = $this->ModSimulasi->GetTarifAnuitasASP($usiasekarang);
		
		$data['hasil']['pesertasejahteraprima'] = $data['hasil']['premisekaligusjsanuitas'] / ((((12-$data['hasil']['selisihbulancalontertanggung']) * $tarifanuitasasp1['TARIF']) + (($data['hasil']['selisihbulancalontertanggung']) * $tarifanuitasasp2['TARIF'])) / 12) * 100;
		$data['hasil']['jandadudaanaksejahteraprima'] = $data['hasil']['pesertasejahteraprima'] * 0.6;
		
		$tarifanuitasaspusia40 = $this->ModSimulasi->GetTarifAnuitasASP(40);
		$tarifanuitasaspusia41 = $this->ModSimulasi->GetTarifAnuitasASP(41);
		$tarifanuitasaspusia42 = $this->ModSimulasi->GetTarifAnuitasASP(42);
		$tarifanuitasaspusia43 = $this->ModSimulasi->GetTarifAnuitasASP(43);
		$tarifanuitasaspusia44 = $this->ModSimulasi->GetTarifAnuitasASP(44);
		$tarifanuitasaspusia45 = $this->ModSimulasi->GetTarifAnuitasASP(45);
		$tarifanuitasaspusia46 = $this->ModSimulasi->GetTarifAnuitasASP(46);
		$tarifanuitasaspusia47 = $this->ModSimulasi->GetTarifAnuitasASP(47);
		$tarifanuitasaspusia48 = $this->ModSimulasi->GetTarifAnuitasASP(48);
		$tarifanuitasaspusia49 = $this->ModSimulasi->GetTarifAnuitasASP(49);
		$tarifanuitasaspusia50 = $this->ModSimulasi->GetTarifAnuitasASP(50);
		$tarifanuitasaspusia51 = $this->ModSimulasi->GetTarifAnuitasASP(51);
		$tarifanuitasaspusia52 = $this->ModSimulasi->GetTarifAnuitasASP(52);
		$tarifanuitasaspusia53 = $this->ModSimulasi->GetTarifAnuitasASP(53);
		$tarifanuitasaspusia54 = $this->ModSimulasi->GetTarifAnuitasASP(54);
		$tarifanuitasaspusia55 = $this->ModSimulasi->GetTarifAnuitasASP(55);
		$tarifanuitasaspusia56 = $this->ModSimulasi->GetTarifAnuitasASP(56);
		$tarifanuitasaspusia57 = $this->ModSimulasi->GetTarifAnuitasASP(57);
		$tarifanuitasaspusia58 = $this->ModSimulasi->GetTarifAnuitasASP(58);
		$tarifanuitasaspusia59 = $this->ModSimulasi->GetTarifAnuitasASP(59);
		$tarifanuitasaspusia60 = $this->ModSimulasi->GetTarifAnuitasASP(60);
		
		$data['hasil']['tarifanuitasaspusia40'] = $tarifanuitasaspusia40['TARIF'];
		$data['hasil']['tarifanuitasaspusia41'] = $tarifanuitasaspusia41['TARIF'];
		$data['hasil']['tarifanuitasaspusia42'] = $tarifanuitasaspusia42['TARIF'];
		$data['hasil']['tarifanuitasaspusia43'] = $tarifanuitasaspusia43['TARIF'];
		$data['hasil']['tarifanuitasaspusia44'] = $tarifanuitasaspusia44['TARIF'];
		$data['hasil']['tarifanuitasaspusia45'] = $tarifanuitasaspusia45['TARIF'];
		$data['hasil']['tarifanuitasaspusia46'] = $tarifanuitasaspusia46['TARIF'];
		$data['hasil']['tarifanuitasaspusia47'] = $tarifanuitasaspusia47['TARIF'];
		$data['hasil']['tarifanuitasaspusia48'] = $tarifanuitasaspusia48['TARIF'];
		$data['hasil']['tarifanuitasaspusia49'] = $tarifanuitasaspusia49['TARIF'];
		$data['hasil']['tarifanuitasaspusia50'] = $tarifanuitasaspusia50['TARIF'];
		$data['hasil']['tarifanuitasaspusia51'] = $tarifanuitasaspusia51['TARIF'];
		$data['hasil']['tarifanuitasaspusia52'] = $tarifanuitasaspusia52['TARIF'];
		$data['hasil']['tarifanuitasaspusia53'] = $tarifanuitasaspusia53['TARIF'];
		$data['hasil']['tarifanuitasaspusia54'] = $tarifanuitasaspusia54['TARIF'];
		$data['hasil']['tarifanuitasaspusia55'] = $tarifanuitasaspusia55['TARIF'];
		$data['hasil']['tarifanuitasaspusia56'] = $tarifanuitasaspusia56['TARIF'];
		$data['hasil']['tarifanuitasaspusia57'] = $tarifanuitasaspusia57['TARIF'];
		$data['hasil']['tarifanuitasaspusia58'] = $tarifanuitasaspusia58['TARIF'];
		$data['hasil']['tarifanuitasaspusia59'] = $tarifanuitasaspusia59['TARIF'];
		$data['hasil']['tarifanuitasaspusia60'] = $tarifanuitasaspusia60['TARIF'];
		
		$tarifanuitasaip1 = $this->ModSimulasi->GetTarifAnuitasAIP($usiasekarang);
		$tarifanuitasaip2 = $this->ModSimulasi->GetTarifAnuitasAIP($usiasekarang + 1);
		
		$data['hasil']['pesertaidealprima'] = $data['hasil']['premisekaligusjsanuitas'] / ((((12-$data['hasil']['selisihbulancalontertanggung']) * $tarifanuitasaip1['TARIF']) + (($data['hasil']['selisihbulancalontertanggung']) * $tarifanuitasaip2['TARIF'])) / 12) * 100;
		$data['hasil']['jandadudaidealprima'] = $data['hasil']['pesertaidealprima'] * 0.6;
		
		$tarifanuitasaipusia40 = $this->ModSimulasi->GetTarifAnuitasAIP(40);
		$tarifanuitasaipusia41 = $this->ModSimulasi->GetTarifAnuitasAIP(41);
		$tarifanuitasaipusia42 = $this->ModSimulasi->GetTarifAnuitasAIP(42);
		$tarifanuitasaipusia43 = $this->ModSimulasi->GetTarifAnuitasAIP(43);
		$tarifanuitasaipusia44 = $this->ModSimulasi->GetTarifAnuitasAIP(44);
		$tarifanuitasaipusia45 = $this->ModSimulasi->GetTarifAnuitasAIP(45);
		$tarifanuitasaipusia46 = $this->ModSimulasi->GetTarifAnuitasAIP(46);
		$tarifanuitasaipusia47 = $this->ModSimulasi->GetTarifAnuitasAIP(47);
		$tarifanuitasaipusia48 = $this->ModSimulasi->GetTarifAnuitasAIP(48);
		$tarifanuitasaipusia49 = $this->ModSimulasi->GetTarifAnuitasAIP(49);
		$tarifanuitasaipusia50 = $this->ModSimulasi->GetTarifAnuitasAIP(50);
		$tarifanuitasaipusia51 = $this->ModSimulasi->GetTarifAnuitasAIP(51);
		$tarifanuitasaipusia52 = $this->ModSimulasi->GetTarifAnuitasAIP(52);
		$tarifanuitasaipusia53 = $this->ModSimulasi->GetTarifAnuitasAIP(53);
		$tarifanuitasaipusia54 = $this->ModSimulasi->GetTarifAnuitasAIP(54);
		$tarifanuitasaipusia55 = $this->ModSimulasi->GetTarifAnuitasAIP(55);
		$tarifanuitasaipusia56 = $this->ModSimulasi->GetTarifAnuitasAIP(56);
		$tarifanuitasaipusia57 = $this->ModSimulasi->GetTarifAnuitasAIP(57);
		$tarifanuitasaipusia58 = $this->ModSimulasi->GetTarifAnuitasAIP(58);
		$tarifanuitasaipusia59 = $this->ModSimulasi->GetTarifAnuitasAIP(59);
		$tarifanuitasaipusia60 = $this->ModSimulasi->GetTarifAnuitasAIP(60);
		
		$data['hasil']['tarifanuitasaipusia40'] = $tarifanuitasaipusia40['TARIF'];
		$data['hasil']['tarifanuitasaipusia41'] = $tarifanuitasaipusia41['TARIF'];
		$data['hasil']['tarifanuitasaipusia42'] = $tarifanuitasaipusia42['TARIF'];
		$data['hasil']['tarifanuitasaipusia43'] = $tarifanuitasaipusia43['TARIF'];
		$data['hasil']['tarifanuitasaipusia44'] = $tarifanuitasaipusia44['TARIF'];
		$data['hasil']['tarifanuitasaipusia45'] = $tarifanuitasaipusia45['TARIF'];
		$data['hasil']['tarifanuitasaipusia46'] = $tarifanuitasaipusia46['TARIF'];
		$data['hasil']['tarifanuitasaipusia47'] = $tarifanuitasaipusia47['TARIF'];
		$data['hasil']['tarifanuitasaipusia48'] = $tarifanuitasaipusia48['TARIF'];
		$data['hasil']['tarifanuitasaipusia49'] = $tarifanuitasaipusia49['TARIF'];
		$data['hasil']['tarifanuitasaipusia50'] = $tarifanuitasaipusia50['TARIF'];
		$data['hasil']['tarifanuitasaipusia51'] = $tarifanuitasaipusia51['TARIF'];
		$data['hasil']['tarifanuitasaipusia52'] = $tarifanuitasaipusia52['TARIF'];
		$data['hasil']['tarifanuitasaipusia53'] = $tarifanuitasaipusia53['TARIF'];
		$data['hasil']['tarifanuitasaipusia54'] = $tarifanuitasaipusia54['TARIF'];
		$data['hasil']['tarifanuitasaipusia55'] = $tarifanuitasaipusia55['TARIF'];
		$data['hasil']['tarifanuitasaipusia56'] = $tarifanuitasaipusia56['TARIF'];
		$data['hasil']['tarifanuitasaipusia57'] = $tarifanuitasaipusia57['TARIF'];
		$data['hasil']['tarifanuitasaipusia58'] = $tarifanuitasaipusia58['TARIF'];
		$data['hasil']['tarifanuitasaipusia59'] = $tarifanuitasaipusia59['TARIF'];
		$data['hasil']['tarifanuitasaipusia60'] = $tarifanuitasaipusia60['TARIF'];
		
		$tarifanuitasasi1 = $this->ModSimulasi->GetTarifAnuitasASI($usiasekarang);
		$tarifanuitasasi2 = $this->ModSimulasi->GetTarifAnuitasASI($usiasekarang);
		
		$data['hasil']['pesertasejahteraideal'] = $data['hasil']['premisekaligusjsanuitas'] / ((((12-$data['hasil']['selisihbulancalontertanggung']) * $tarifanuitasasi1['TARIF']) + (($data['hasil']['selisihbulancalontertanggung']) * $tarifanuitasasi2['TARIF'])) / 12) * 100;
		$data['hasil']['jandadudaanaksejahteraideal'] = $data['hasil']['pesertasejahteraideal'] * 0.6;
		
		$tarifanuitasasiusia40 = $this->ModSimulasi->GetTarifAnuitasASI(40);
		$tarifanuitasasiusia41 = $this->ModSimulasi->GetTarifAnuitasASI(41);

		$tarifanuitasasiusia42 = $this->ModSimulasi->GetTarifAnuitasASI(42);
		$tarifanuitasasiusia43 = $this->ModSimulasi->GetTarifAnuitasASI(43);
		$tarifanuitasasiusia44 = $this->ModSimulasi->GetTarifAnuitasASI(44);
		$tarifanuitasasiusia45 = $this->ModSimulasi->GetTarifAnuitasASI(45);
		$tarifanuitasasiusia46 = $this->ModSimulasi->GetTarifAnuitasASI(46);
		$tarifanuitasasiusia47 = $this->ModSimulasi->GetTarifAnuitasASI(47);
		$tarifanuitasasiusia48 = $this->ModSimulasi->GetTarifAnuitasASI(48);
		$tarifanuitasasiusia49 = $this->ModSimulasi->GetTarifAnuitasASI(49);
		$tarifanuitasasiusia50 = $this->ModSimulasi->GetTarifAnuitasASI(50);
		$tarifanuitasasiusia51 = $this->ModSimulasi->GetTarifAnuitasASI(51);
		$tarifanuitasasiusia52 = $this->ModSimulasi->GetTarifAnuitasASI(52);
		$tarifanuitasasiusia53 = $this->ModSimulasi->GetTarifAnuitasASI(53);
		$tarifanuitasasiusia54 = $this->ModSimulasi->GetTarifAnuitasASI(54);
		$tarifanuitasasiusia55 = $this->ModSimulasi->GetTarifAnuitasASI(55);
		$tarifanuitasasiusia56 = $this->ModSimulasi->GetTarifAnuitasASI(56);
		$tarifanuitasasiusia57 = $this->ModSimulasi->GetTarifAnuitasASI(57);
		$tarifanuitasasiusia58 = $this->ModSimulasi->GetTarifAnuitasASI(58);
		$tarifanuitasasiusia59 = $this->ModSimulasi->GetTarifAnuitasASI(59);
		$tarifanuitasasiusia60 = $this->ModSimulasi->GetTarifAnuitasASI(60);
		
		$data['hasil']['tarifanuitasasiusia40'] = $tarifanuitasasiusia40['TARIF'];
		$data['hasil']['tarifanuitasasiusia41'] = $tarifanuitasasiusia41['TARIF'];
		$data['hasil']['tarifanuitasasiusia42'] = $tarifanuitasasiusia42['TARIF'];
		$data['hasil']['tarifanuitasasiusia43'] = $tarifanuitasasiusia43['TARIF'];
		$data['hasil']['tarifanuitasasiusia44'] = $tarifanuitasasiusia44['TARIF'];
		$data['hasil']['tarifanuitasasiusia45'] = $tarifanuitasasiusia45['TARIF'];
		$data['hasil']['tarifanuitasasiusia46'] = $tarifanuitasasiusia46['TARIF'];
		$data['hasil']['tarifanuitasasiusia47'] = $tarifanuitasasiusia47['TARIF'];
		$data['hasil']['tarifanuitasasiusia48'] = $tarifanuitasasiusia48['TARIF'];
		$data['hasil']['tarifanuitasasiusia49'] = $tarifanuitasasiusia49['TARIF'];
		$data['hasil']['tarifanuitasasiusia50'] = $tarifanuitasasiusia50['TARIF'];
		$data['hasil']['tarifanuitasasiusia51'] = $tarifanuitasasiusia51['TARIF'];
		$data['hasil']['tarifanuitasasiusia52'] = $tarifanuitasasiusia52['TARIF'];
		$data['hasil']['tarifanuitasasiusia53'] = $tarifanuitasasiusia53['TARIF'];
		$data['hasil']['tarifanuitasasiusia54'] = $tarifanuitasasiusia54['TARIF'];
		$data['hasil']['tarifanuitasasiusia55'] = $tarifanuitasasiusia55['TARIF'];
		$data['hasil']['tarifanuitasasiusia56'] = $tarifanuitasasiusia56['TARIF'];
		$data['hasil']['tarifanuitasasiusia57'] = $tarifanuitasasiusia57['TARIF'];
		$data['hasil']['tarifanuitasasiusia58'] = $tarifanuitasasiusia58['TARIF'];
		$data['hasil']['tarifanuitasasiusia59'] = $tarifanuitasasiusia59['TARIF'];
		$data['hasil']['tarifanuitasasiusia60'] = $tarifanuitasasiusia60['TARIF'];
		
		$tarifanuitasani1 = $this->ModSimulasi->GetTarifAnuitasANI($usiasekarang);
		$tarifanuitasani2 = $this->ModSimulasi->GetTarifAnuitasANI($usiasekarang);
		
		$data['hasil']['pesertaideal'] = $data['hasil']['premisekaligusjsanuitas'] / ((((12-$data['hasil']['selisihbulancalontertanggung']) * $tarifanuitasani1['TARIF']) + (($data['hasil']['selisihbulancalontertanggung']) * $tarifanuitasani2['TARIF'])) / 12) * 100;
		$data['hasil']['jandadudaanakideal'] = $data['hasil']['pesertaideal'] * 0.6;
		
		$tarifanuitasaiusia40 = $this->ModSimulasi->GetTarifAnuitasANI(40);
		$tarifanuitasaiusia41 = $this->ModSimulasi->GetTarifAnuitasANI(41);
		$tarifanuitasaiusia42 = $this->ModSimulasi->GetTarifAnuitasANI(42);
		$tarifanuitasaiusia43 = $this->ModSimulasi->GetTarifAnuitasANI(43);
		$tarifanuitasaiusia44 = $this->ModSimulasi->GetTarifAnuitasANI(44);
		$tarifanuitasaiusia45 = $this->ModSimulasi->GetTarifAnuitasANI(45);
		$tarifanuitasaiusia46 = $this->ModSimulasi->GetTarifAnuitasANI(46);
		$tarifanuitasaiusia47 = $this->ModSimulasi->GetTarifAnuitasANI(47);
		$tarifanuitasaiusia48 = $this->ModSimulasi->GetTarifAnuitasANI(48);
		$tarifanuitasaiusia49 = $this->ModSimulasi->GetTarifAnuitasANI(49);
		$tarifanuitasaiusia50 = $this->ModSimulasi->GetTarifAnuitasANI(50);
		$tarifanuitasaiusia51 = $this->ModSimulasi->GetTarifAnuitasANI(51);
		$tarifanuitasaiusia52 = $this->ModSimulasi->GetTarifAnuitasANI(52);
		$tarifanuitasaiusia53 = $this->ModSimulasi->GetTarifAnuitasANI(53);
		$tarifanuitasaiusia54 = $this->ModSimulasi->GetTarifAnuitasANI(54);
		$tarifanuitasaiusia55 = $this->ModSimulasi->GetTarifAnuitasANI(55);
		$tarifanuitasaiusia56 = $this->ModSimulasi->GetTarifAnuitasANI(56);
		$tarifanuitasaiusia57 = $this->ModSimulasi->GetTarifAnuitasANI(57);
		$tarifanuitasaiusia58 = $this->ModSimulasi->GetTarifAnuitasANI(58);
		$tarifanuitasaiusia59 = $this->ModSimulasi->GetTarifAnuitasANI(59);
		$tarifanuitasaiusia60 = $this->ModSimulasi->GetTarifAnuitasANI(60);
		
		$data['hasil']['tarifanuitasaiusia40'] = $tarifanuitasaiusia40['TARIF'];
		$data['hasil']['tarifanuitasaiusia41'] = $tarifanuitasaiusia41['TARIF'];
		$data['hasil']['tarifanuitasaiusia42'] = $tarifanuitasaiusia42['TARIF'];
		$data['hasil']['tarifanuitasaiusia43'] = $tarifanuitasaiusia43['TARIF'];
		$data['hasil']['tarifanuitasaiusia44'] = $tarifanuitasaiusia44['TARIF'];
		$data['hasil']['tarifanuitasaiusia45'] = $tarifanuitasaiusia45['TARIF'];
		$data['hasil']['tarifanuitasaiusia46'] = $tarifanuitasaiusia46['TARIF'];
		$data['hasil']['tarifanuitasaiusia47'] = $tarifanuitasaiusia47['TARIF'];
		$data['hasil']['tarifanuitasaiusia48'] = $tarifanuitasaiusia48['TARIF'];
		$data['hasil']['tarifanuitasaiusia49'] = $tarifanuitasaiusia49['TARIF'];
		$data['hasil']['tarifanuitasaiusia50'] = $tarifanuitasaiusia50['TARIF'];
		$data['hasil']['tarifanuitasaiusia51'] = $tarifanuitasaiusia51['TARIF'];
		$data['hasil']['tarifanuitasaiusia52'] = $tarifanuitasaiusia52['TARIF'];
		$data['hasil']['tarifanuitasaiusia53'] = $tarifanuitasaiusia53['TARIF'];
		$data['hasil']['tarifanuitasaiusia54'] = $tarifanuitasaiusia54['TARIF'];
		$data['hasil']['tarifanuitasaiusia55'] = $tarifanuitasaiusia55['TARIF'];
		$data['hasil']['tarifanuitasaiusia56'] = $tarifanuitasaiusia56['TARIF'];
		$data['hasil']['tarifanuitasaiusia57'] = $tarifanuitasaiusia57['TARIF'];
		$data['hasil']['tarifanuitasaiusia58'] = $tarifanuitasaiusia58['TARIF'];
		$data['hasil']['tarifanuitasaiusia59'] = $tarifanuitasaiusia59['TARIF'];
		$data['hasil']['tarifanuitasaiusia60'] = $tarifanuitasaiusia60['TARIF'];
		
		
		$statuskawin = $this->session->userdata('statuskawin');
		$data['hasil']['statuskawin'] = $this->session->userdata('statuskawin');
		$tarifanuitasaep1 = $this->ModSimulasi->GetTarifAnuitasAEP($usiasekarang, $statuskawin);
		$tarifanuitasaep2 = $this->ModSimulasi->GetTarifAnuitasAEP($usiasekarang + 1, $statuskawin);
		
		$tarifanuitasaepusia40 = $this->ModSimulasi->GetTarifAnuitasAEP(40, $statuskawin);
		$tarifanuitasaepusia41 = $this->ModSimulasi->GetTarifAnuitasAEP(41, $statuskawin);
		$tarifanuitasaepusia42 = $this->ModSimulasi->GetTarifAnuitasAEP(42, $statuskawin);
		$tarifanuitasaepusia43 = $this->ModSimulasi->GetTarifAnuitasAEP(43, $statuskawin);
		$tarifanuitasaepusia44 = $this->ModSimulasi->GetTarifAnuitasAEP(44, $statuskawin);
		$tarifanuitasaepusia45 = $this->ModSimulasi->GetTarifAnuitasAEP(45, $statuskawin);
		$tarifanuitasaepusia46 = $this->ModSimulasi->GetTarifAnuitasAEP(46, $statuskawin);
		$tarifanuitasaepusia47 = $this->ModSimulasi->GetTarifAnuitasAEP(47, $statuskawin);
		$tarifanuitasaepusia48 = $this->ModSimulasi->GetTarifAnuitasAEP(48, $statuskawin);
		$tarifanuitasaepusia49 = $this->ModSimulasi->GetTarifAnuitasAEP(49, $statuskawin);
		$tarifanuitasaepusia50 = $this->ModSimulasi->GetTarifAnuitasAEP(50, $statuskawin);
		$tarifanuitasaepusia51 = $this->ModSimulasi->GetTarifAnuitasAEP(51, $statuskawin);
		$tarifanuitasaepusia52 = $this->ModSimulasi->GetTarifAnuitasAEP(52, $statuskawin);
		$tarifanuitasaepusia53 = $this->ModSimulasi->GetTarifAnuitasAEP(53, $statuskawin);
		$tarifanuitasaepusia54 = $this->ModSimulasi->GetTarifAnuitasAEP(54, $statuskawin);
		$tarifanuitasaepusia55 = $this->ModSimulasi->GetTarifAnuitasAEP(55, $statuskawin);
		$tarifanuitasaepusia56 = $this->ModSimulasi->GetTarifAnuitasAEP(56, $statuskawin);
		$tarifanuitasaepusia57 = $this->ModSimulasi->GetTarifAnuitasAEP(57, $statuskawin);
		$tarifanuitasaepusia58 = $this->ModSimulasi->GetTarifAnuitasAEP(58, $statuskawin);
		$tarifanuitasaepusia59 = $this->ModSimulasi->GetTarifAnuitasAEP(59, $statuskawin);
		$tarifanuitasaepusia60 = $this->ModSimulasi->GetTarifAnuitasAEP(60, $statuskawin);
		
		$data['hasil']['tarifanuitasaepusia40'] = $tarifanuitasaepusia40['TARIF'];
		$data['hasil']['tarifanuitasaepusia41'] = $tarifanuitasaepusia41['TARIF'];
		$data['hasil']['tarifanuitasaepusia42'] = $tarifanuitasaepusia42['TARIF'];
		$data['hasil']['tarifanuitasaepusia43'] = $tarifanuitasaepusia43['TARIF'];
		$data['hasil']['tarifanuitasaepusia44'] = $tarifanuitasaepusia44['TARIF'];
		$data['hasil']['tarifanuitasaepusia45'] = $tarifanuitasaepusia45['TARIF'];
		$data['hasil']['tarifanuitasaepusia46'] = $tarifanuitasaepusia46['TARIF'];
		$data['hasil']['tarifanuitasaepusia47'] = $tarifanuitasaepusia47['TARIF'];
		$data['hasil']['tarifanuitasaepusia48'] = $tarifanuitasaepusia48['TARIF'];
		$data['hasil']['tarifanuitasaepusia49'] = $tarifanuitasaepusia49['TARIF'];
		$data['hasil']['tarifanuitasaepusia50'] = $tarifanuitasaepusia50['TARIF'];
		$data['hasil']['tarifanuitasaepusia51'] = $tarifanuitasaepusia51['TARIF'];
		$data['hasil']['tarifanuitasaepusia52'] = $tarifanuitasaepusia52['TARIF'];
		$data['hasil']['tarifanuitasaepusia53'] = $tarifanuitasaepusia53['TARIF'];
		$data['hasil']['tarifanuitasaepusia54'] = $tarifanuitasaepusia54['TARIF'];
		$data['hasil']['tarifanuitasaepusia55'] = $tarifanuitasaepusia55['TARIF'];
		$data['hasil']['tarifanuitasaepusia56'] = $tarifanuitasaepusia56['TARIF'];
		$data['hasil']['tarifanuitasaepusia57'] = $tarifanuitasaepusia57['TARIF'];
		$data['hasil']['tarifanuitasaepusia58'] = $tarifanuitasaepusia58['TARIF'];
		$data['hasil']['tarifanuitasaepusia59'] = $tarifanuitasaepusia59['TARIF'];
		$data['hasil']['tarifanuitasaepusia60'] = $tarifanuitasaepusia60['TARIF'];
			
		$data['hasil']['pesertaeksekutifprima'] = $data['hasil']['premisekaligusjsanuitas'] / ((((12-$data['hasil']['selisihbulancalontertanggung']) * $tarifanuitasaep1['TARIF']) + (($data['hasil']['selisihbulancalontertanggung']) * $tarifanuitasaep2['TARIF'])) / 12) * 100;
		$data['hasil']['jandadudaanakeksekutifprima'] = $data['hasil']['pesertaeksekutifprima'] * 0.6;
		
		//$data['hasil']['filepdf'] = $filepdf;
		$data['hasil']['nama'] = $this->session->userdata('nama');
		$data['hasil']['namaagen'] = strtoupper(str_replace("-"," ",$this->session->userdata('namaagen')));
		$kodeKantor = $DataAgen['KDKANTOR'];
		$dataKantor = $this->ModSimulasi->cariDataKantor($kodeKantor);
		$data['hasil']['kantorcabang'] = $dataKantor['NAMAKANTOR'];
		$data['hasil']['nomeragen'] = $this->session->userdata('nomeragen');
		
		$data['hasil']['aspkawin'] = $this->session->userdata('aspkawin');
		$data['hasil']['aspbujang'] = $this->session->userdata('aspbujang');
		$data['hasil']['asikawin'] = $this->session->userdata('asikawin');
		$data['hasil']['asibujang'] = $this->session->userdata('asibujang');
		$data['hasil']['aikawin'] = $this->session->userdata('aikawin');
		$data['hasil']['aibujang'] = $this->session->userdata('aibujang');
		$data['hasil']['aepkawin'] = $this->session->userdata('aepkawin');
		$data['hasil']['aepbujang'] = $this->session->userdata('aepbujang');
		
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
			'JUMLAH_PREMI' => $data['hasil']['premisekaligusjsanuitas']
		);
		
		$this->ModSimulasi->insertSimulasi($data['hitung']);
		
		$data['hasil']['build_id'] = $data['hitung']['BUILD_ID'];
				
		$filePdf = $this->session->userdata('filepdf');
		
		$this->createPDF($filePdf,$data);
		
		$this->load->view('hasil/jsplanannuityassurance',$data);
		
		//$this->session->sess_destroy();
	}

	function createPDF($namaFile,$data){
		$image1 = FCPATH.'assets/img/logo-js.png';

		// PAGE 2
		if (($data['hasil']['pilihananuitas'] == 'EKSEKUTIF PRIMA') && ($data['hasil']['statuskawin'] == 'kawin'))
		{
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
		$this->pdf->ln(10);
		$this->pdf->SetTextColor(178,178,178);
		$this->pdf->SetFillColor(0,0,0);
		$this->pdf->SetFont('Arial','B',20);
		$this->pdf->Cell(190,8,'',0,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Times','BI',20);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(0,0,0);
		$this->pdf->Cell(190,8,'JS Plan Annuity Assurance (Kawin)',0,0,'C');
		$this->pdf->ln(10);

		// DATA
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(255,0,0);
		$this->pdf->Cell(190,5,'Data',0,0,'L',true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,102,255);
		$this->pdf->Cell(5,5,'',0,0,'L', true);
		$this->pdf->Cell(70,5,'Nama Pemegang Polis/Tertanggung',0,0,'L', true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,':',0,0,'L', true);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,102,255);
		$this->pdf->Cell(44,5,$data['hasil']['jeniskelamincalontertanggung'].''.$data['hasil']['namalengkapcalontertanggung'].' ',0,0,'L', true);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,102,255);
		$this->pdf->Cell(60.9,5,'',0,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(5,5,'',0,0,'L', true);
		$this->pdf->Cell(70,5,'Tanggal Lahir Pemegang Polis/Tertanggung',0,0,'L', true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,':',0,0,'L', true);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,102,255);
		$this->pdf->Cell(44,5,''.$data['hasil']['tanggallahircalontertangggung'].' ',0,0,'L', true);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,102,255);
		$this->pdf->Cell(60.9,5,'',0,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,102,255);
		$this->pdf->Cell(5,5,'',0,0,'L', true);
		$this->pdf->Cell(70,5,'Status',0,0,'L', true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,':',0,0,'L', true);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,102,255);
		$this->pdf->Cell(44,5,'Kawin',0,0,'L', true);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,102,255);
		$this->pdf->Cell(60.9,5,'',0,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(5,5,'',0,0,'L', true);
		$this->pdf->Cell(70,5,'Mulai Asuransi',0,0,'L', true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,':',0,0,'L', true);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,102,255);
		$this->pdf->Cell(44,5,''.$data['hasil']['saatmulaiasuransi'].' ',0,0,'L', true);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,102,255);
		$this->pdf->Cell(60.9,5,'',0,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(5,5,'',0,0,'L', true);
		$this->pdf->Cell(70,5,'Usia Pemegang Polis/Tertanggung',0,0,'L', true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,':',0,0,'L', true);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,102,255);
		$this->pdf->Cell(44,5,''.$data['hasil']['usiacalontertanggung'].' TAHUN '.$data['hasil']['selisihUmur'].' BULAN ',0,0,'L', true);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,102,255);
		$this->pdf->Cell(60.9,5,'',0,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(5,5,'',0,0,'L', true);
		$this->pdf->Cell(70,5,'Dana yang disetor',0,0,'L', true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,':',0,0,'L', true);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,102,255);
		$this->pdf->Cell(44,5,'Rp. '.number_format($data['hasil']['premisekaligusjsanuitas'],0,'.',',').'',0,0,'L', true);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,102,255);
		$this->pdf->Cell(60.9,5,'',0,0,'L', true);
		$this->pdf->ln(10);

		// MANFAAT YANG DITERIMA
		$this->pdf->SetFont('Arial','BU',12);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->SetTextColor(255,0,0);
		$this->pdf->Cell(190,5,'Manfaat yang diterima :',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(3,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'1. Pensiun Hari Tua ( PHT )  dibayarkan  secara  bulanan  sampai dengan, usia Tertanggung 70 tahun, dimulai pada bulan berikut ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'setelah premi disetor sebesar Rp. '.number_format($data['hasil']['aepkawin'],0,'.',',').'.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(3,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'2. Pensiun Janda/Duda ( PJD )  dibayarkan secara bulanan sampai dengan usia Janda/Duda 70 tahun atau sampai menikah lagi,',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'setelah penerima PHT tutup usia sebesar Rp. '.number_format($data['hasil']['aepkawin']*0.6,0,'.',',').'.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(3,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'3. Pengembalian premi 50% pada saat penerima PHT  berusia  65 tahun atau tutup usia sebelum itu sebesar Rp. '.number_format($data['hasil']['premisekaligusjsanuitas']*0.5,0,'.',',').'.',0,0,'L');
		$this->pdf->ln(110);

		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,204,204);
		$this->pdf->Cell(190,5,'Proposal ini merupakan perhitungan pendekatan sebelum kontrak asuransi yang sesungguhnya dilaksanakan','LTR',0,'L',true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,204,204);
		$this->pdf->Cell(190,5,'dan bukan merupakan bagian dari kontrak asuransi.','LBR',0,'L',true);
		$this->pdf->ln();

		// FOOTER
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(190,5,'','B',0,'L');
		$this->pdf->ln(10);

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(13,5,'Disajikan Oleh',0,0,'L');
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
		}

		// PAGE 3
		if (($data['hasil']['pilihananuitas'] == 'EKSEKUTIF PRIMA') && ($data['hasil']['statuskawin'] == 'bujang'))
		{
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
		$this->pdf->ln(10);
		$this->pdf->SetTextColor(178,178,178);
		$this->pdf->SetFillColor(0,0,0);
		$this->pdf->SetFont('Arial','B',20);
		$this->pdf->Cell(190,8,'',0,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Times','BI',20);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(0,0,0);
		$this->pdf->Cell(190,8,'JS Plan Annuity Assurance',0,0,'C');
		$this->pdf->ln(10);

		// DATA
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(255,0,0);
		$this->pdf->Cell(190,5,'Data',0,0,'L',true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,102,255);
		$this->pdf->Cell(5,5,'',0,0,'L', true);
		$this->pdf->Cell(70,5,'Nama Pemegang Polis/Tertanggung',0,0,'L', true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,':',0,0,'L', true);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,102,255);
		$this->pdf->Cell(44,5,$data['hasil']['jeniskelamincalontertanggung'].''.$data['hasil']['namalengkapcalontertanggung'].' ',0,0,'L', true);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,102,255);
		$this->pdf->Cell(60.9,5,'',0,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(5,5,'',0,0,'L', true);
		$this->pdf->Cell(70,5,'Tanggal Lahir Pemegang Polis/Tertanggung',0,0,'L', true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,':',0,0,'L', true);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,102,255);
		$this->pdf->Cell(44,5,''.$data['hasil']['tanggallahircalontertangggung'].' ',0,0,'L', true);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,102,255);
		$this->pdf->Cell(60.9,5,'',0,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,102,255);
		$this->pdf->Cell(5,5,'',0,0,'L', true);
		$this->pdf->Cell(70,5,'Status',0,0,'L', true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,':',0,0,'L', true);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,102,255);
		$this->pdf->Cell(44,5,'Lajang',0,0,'L', true);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,102,255);
		$this->pdf->Cell(60.9,5,'',0,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(5,5,'',0,0,'L', true);
		$this->pdf->Cell(70,5,'Mulai Asuransi',0,0,'L', true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,':',0,0,'L', true);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,102,255);
		$this->pdf->Cell(44,5,''.$data['hasil']['saatmulaiasuransi'].' ',0,0,'L', true);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,102,255);
		$this->pdf->Cell(60.9,5,'',0,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(5,5,'',0,0,'L', true);
		$this->pdf->Cell(70,5,'Usia Pemegang Polis/Tertanggung',0,0,'L', true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,':',0,0,'L', true);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,102,255);
		$this->pdf->Cell(44,5,''.$data['hasil']['usiacalontertanggung'].' TAHUN '.$data['hasil']['selisihUmur'].' BULAN ',0,0,'L', true);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,102,255);
		$this->pdf->Cell(60.9,5,'',0,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(5,5,'',0,0,'L', true);
		$this->pdf->Cell(70,5,'Dana yang disetor',0,0,'L', true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,':',0,0,'L', true);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,102,255);
		$this->pdf->Cell(44,5,'Rp. '.number_format($data['hasil']['premisekaligusjsanuitas'],0,'.',',').'',0,0,'L', true);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,102,255);
		$this->pdf->Cell(60.9,5,'',0,0,'L', true);
		$this->pdf->ln(10);

		// MANFAAT YANG DITERIMA
		$this->pdf->SetFont('Arial','BU',12);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->SetTextColor(255,0,0);
		$this->pdf->Cell(190,5,'Manfaat yang diterima :',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(3,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'1. Pensiun Hari Tua ( PHT )  dibayarkan  secara  bulanan  sampai dengan, usia Tertanggung 70 tahun, dimulai pada bulan berikut ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'setelah premi disetor sebesar Rp. '.number_format($data['hasil']['aepkawin'],0,'.',',').'.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(3,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'2. Pengembalian premi 50% pada saat penerima PHT  berusia  65 tahun atau tutup usia sebelum itu sebesar Rp. '.number_format($data['hasil']['premisekaligusjsanuitas']*0.5,0,'.',',').'.',0,0,'L');
		$this->pdf->ln(110);

		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,204,204);
		$this->pdf->Cell(190,5,'Proposal ini merupakan perhitungan pendekatan sebelum kontrak asuransi yang sesungguhnya dilaksanakan','LTR',0,'L',true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,204,204);
		$this->pdf->Cell(190,5,'dan bukan merupakan bagian dari kontrak asuransi.','LBR',0,'L',true);
		$this->pdf->ln();

		// FOOTER
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(190,5,'','B',0,'L');
		$this->pdf->ln(10);

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(13,5,'Disajikan Oleh',0,0,'L');
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
		}
		
	    $this->pdf->Output('./files/pdf/'.$namaFile.'.pdf','F');
	  
	}	

}	