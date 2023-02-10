b<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");

	error_reporting(0);

class Jsanuitas extends CI_Controller{

	function hitungpremisekaligusaspjsanuitas(){
		
		$this->load->model('ModSimulasi');
		
		$usiasekarang = $this->input->post("usiasekarang");
		$pensiunbulanan = $this->input->post("pensiunbulanan");
		$tarifanuitasasp1 = $this->ModSimulasi->GetTarifAnuitasASP($usiasekarang);
		$tarifanuitasasp2 = $this->ModSimulasi->GetTarifAnuitasASP($usiasekarang + 1);
				
		$data['hasil']['selisihbulancalontertanggung'] = round(date("m",(strtotime($this->input->post('saatmulaiasuransi')) - strtotime($this->input->post('tanggallahircalontertangggung')))))-1;

		$tarif = 1000000 / ((((12-$data['hasil']['selisihbulancalontertanggung']) * $tarifanuitasasp1['TARIF']) + (($data['hasil']['selisihbulancalontertanggung']) * $tarifanuitasasp2['TARIF'])) / 12) * 100;
		$hasil = ($pensiunbulanan * 1000000) / $tarif;
		
		echo round($hasil);
	}
	
	function hitungpremisekaligusasijsanuitas(){
		
		$this->load->model('ModSimulasi');
		
		$usiasekarang = $this->input->post("usiasekarang");
		$pensiunbulanan = $this->input->post("pensiunbulanan");
		$tarifanuitasasp1 = $this->ModSimulasi->GetTarifAnuitasASI($usiasekarang);
		$tarifanuitasasp2 = $this->ModSimulasi->GetTarifAnuitasASI($usiasekarang);
				
		$data['hasil']['selisihbulancalontertanggung'] = round(date("m",(strtotime($this->input->post('saatmulaiasuransi')) - strtotime($this->input->post('tanggallahircalontertangggung')))))-1;

		$tarif = 1000000 / ((((12-$data['hasil']['selisihbulancalontertanggung']) * $tarifanuitasasp1['TARIF']) + (($data['hasil']['selisihbulancalontertanggung']) * $tarifanuitasasp2['TARIF'])) / 12) * 100;
		$hasil = ($pensiunbulanan * 1000000) / $tarif;
		
		echo round($hasil);
	}
	
	function hitungpremisekaligusanijsanuitas(){
		
		$this->load->model('ModSimulasi');
		
		$usiasekarang = $this->input->post("usiasekarang");
		$pensiunbulanan = $this->input->post("pensiunbulanan");
		$tarifanuitasasp1 = $this->ModSimulasi->GetTarifAnuitasANI($usiasekarang);
		$tarifanuitasasp2 = $this->ModSimulasi->GetTarifAnuitasANI($usiasekarang);
				
		$data['hasil']['selisihbulancalontertanggung'] = round(date("m",(strtotime($this->input->post('saatmulaiasuransi')) - strtotime($this->input->post('tanggallahircalontertangggung')))))-1;

		$tarif = 1000000 / ((((12-$data['hasil']['selisihbulancalontertanggung']) * $tarifanuitasasp1['TARIF']) + (($data['hasil']['selisihbulancalontertanggung']) * $tarifanuitasasp2['TARIF'])) / 12) * 100;
		$hasil = ($pensiunbulanan * 1000000) / $tarif;
		
		echo round($hasil);
	}
	
	function hitungpremisekaligusaepjsanuitas(){
		
		$this->load->model('ModSimulasi');
		
		$usiasekarang = $this->input->post("usiasekarang");
		$pensiunbulanan = $this->input->post("pensiunbulanan");
		$statuskawin = $this->input->post("statuskawin");
		$tarifanuitasaep1 = $this->ModSimulasi->GetTarifAnuitasAEP($usiasekarang, $statuskawin);
		$tarifanuitasaep2 = $this->ModSimulasi->GetTarifAnuitasAEP($usiasekarang, $statuskawin);
		
		$data['hasil']['selisihbulancalontertanggung'] = round(date("m",(strtotime($this->input->post('saatmulaiasuransi')) - strtotime($this->input->post('tanggallahircalontertangggung')))))-1;

		$tarif = 1000000 / ((((12-$data['hasil']['selisihbulancalontertanggung']) * $tarifanuitasaep1['TARIF']) + (($data['hasil']['selisihbulancalontertanggung']) * $tarifanuitasaep2['TARIF'])) / 12) * 100;
		$hasil = ($pensiunbulanan * 1000000) / $tarif;
		
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
			'premisekaligus' => $this->input->post('premisekaligus'),
			'statuskawin' => $this->input->post('statuskawin'),
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
		$bulanPembayaranSekaligus = $bulan[date("n", strtotime($this->session->userdata('saatmulaiasuransi'))) + 1];
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
			
		$usiasekarang = $data['hasil']['usiacalontertanggung'];
		$tarifanuitasasp1 = $this->ModSimulasi->GetTarifAnuitasASP($usiasekarang);
		$tarifanuitasasp2 = $this->ModSimulasi->GetTarifAnuitasASP($usiasekarang);
		
		$data['hasil']['pesertasejahteraprima'] = $data['hasil']['uangasuransipokok'] / ((((12-$data['hasil']['selisihbulancalontertanggung']) * $tarifanuitasasp1['TARIF']) + (($data['hasil']['selisihbulancalontertanggung']) * $tarifanuitasasp2['TARIF'])) / 12) * 100;
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
		
		$data['hasil']['pesertaidealprima'] = $data['hasil']['uangasuransipokok'] / ((((12-$data['hasil']['selisihbulancalontertanggung']) * $tarifanuitasaip1['TARIF']) + (($data['hasil']['selisihbulancalontertanggung']) * $tarifanuitasaip2['TARIF'])) / 12) * 100;
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
		
		$data['hasil']['pesertasejahteraideal'] = $data['hasil']['uangasuransipokok'] / ((((12-$data['hasil']['selisihbulancalontertanggung']) * $tarifanuitasasi1['TARIF']) + (($data['hasil']['selisihbulancalontertanggung']) * $tarifanuitasasi2['TARIF'])) / 12) * 100;
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
		
		$data['hasil']['pesertaideal'] = $data['hasil']['uangasuransipokok'] / ((((12-$data['hasil']['selisihbulancalontertanggung']) * $tarifanuitasani1['TARIF']) + (($data['hasil']['selisihbulancalontertanggung']) * $tarifanuitasani2['TARIF'])) / 12) * 100;
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
			
		$data['hasil']['pesertaeksekutifprima'] = $data['hasil']['uangasuransipokok'] / ((((12-$data['hasil']['selisihbulancalontertanggung']) * $tarifanuitasaep1['TARIF']) + (($data['hasil']['selisihbulancalontertanggung']) * $tarifanuitasaep2['TARIF'])) / 12) * 100;
		$data['hasil']['jandadudaanakeksekutifprima'] = $data['hasil']['pesertaeksekutifprima'] * 0.6;
		
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
			'JUMLAH_PREMI' => $data['hasil']['uangasuransipokok']
		);
		
		$this->ModSimulasi->insertSimulasi($data['hitung']);
		
		$data['hasil']['build_id'] = $data['hitung']['BUILD_ID'];
				
		$filePdf = $this->session->userdata('filepdf');
		
		$this->createPDF($filePdf,$data);
		
		$this->load->view('hasil/jsanuitas',$data);
		
		//$this->session->sess_destroy();
	}

	function createPDF($namaFile,$data){
		$image1 = FCPATH.'assets/img/logo-js.png';
		$imageaep = FCPATH.'assets/img/aep.jpg';
		$imageaip = FCPATH.'assets/img/aip.jpg';
		$imageasi = FCPATH.'assets/img/asi.jpg';
		$imageasp = FCPATH.'assets/img/asp.jpg';
		$imageai = FCPATH.'assets/img/ai.jpg';
		
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
		$this->pdf->Cell(190,5,'PROGRAM ANUITAS PERTANGGUNGAN PERORANGAN','B',0,'L');
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
		$this->pdf->SetTextColor('0','0','255');
		$this->pdf->Cell(32,5,'Yth. '.$data['hasil']['namalengkapcalontertanggung'].' ',0,0,'L');
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Tanggal Lahir',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(32,5,''.$data['hasil']['tgl_lahir'].' ',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Mulai Program Anuitas',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(32,5,''.$data['hasil']['saatmulaiasuransi'].' ',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Usia Peserta',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(32,5,''.$data['hasil']['usiacalontertanggung'].' Tahun ',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Premi Sekaligus',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'',0,0,'L');
		$this->pdf->ln(10);
		
		$this->pdf->SetFillColor(240,248,255);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(20,5,'','LTR',0,'C', true);
		$this->pdf->Cell(85,5,'','LTR',0,'C', true);
		$this->pdf->Cell(85,5,'JENIS DAN MANFAAT ANUITAS',1,0,'C', true);
		$this->pdf->ln();
		$this->pdf->Cell(20,5,'NO','LR',0,'C', true);
		$this->pdf->Cell(85,5,'LUAS JAMINAN MANFAAT ANUITAS','LR',0,'C', true);
		$this->pdf->Cell(28.33,5,'SEJAHTERA','LTR',0,'C', true);
		$this->pdf->Cell(28.33,5,'SEJAHTERA','LTR',0,'C', true);
		$this->pdf->Cell(28.33,5,'IDEAL','LTR',0,'C', true);
		$this->pdf->ln();
		$this->pdf->Cell(20,5,'','LBR',0,'C', true);
		$this->pdf->Cell(85,5,'','LBR',0,'C', true);
		$this->pdf->Cell(28.33,5,'PRIMA','LBR',0,'C', true);
		$this->pdf->Cell(28.33,5,'IDEAL','LBR',0,'C', true);
		$this->pdf->Cell(28.33,5,'(SESUAI UU)','LBR',0,'C', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(20,5,'1.','LTR',0,'C');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(85,5,'ANUITAS BULANAN SELAMA HIDUP UNTUK :','LTR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(28.33,5,'','LTR',0,'C');
		$this->pdf->Cell(28.33,5,'','LTR',0,'C');
		$this->pdf->Cell(28.33,5,'','LTR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(20,5,'','LR',0,'C');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(85,5,'- PESERTA','LR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['pesertasejahteraprima'],0,'.',','),'LR',0,'C');
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['pesertasejahteraideal'],0,'.',','),'LR',0,'C');
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['pesertaideal'],0,'.',','),'LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(20,5,'','LR',0,'C');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(85,5,'- JANDA / DUDA','LR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['jandadudaanaksejahteraprima'],0,'.',','),'LR',0,'C');
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['jandadudaanaksejahteraideal'],0,'.',','),'LR',0,'C');
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['jandadudaanakideal'],0,'.',','),'LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(20,5,'','LR',0,'C');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(85,5,'- ANAK-ANAK','LR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['jandadudaanaksejahteraprima'],0,'.',','),'LR',0,'C');
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['jandadudaanaksejahteraideal'],0,'.',','),'LR',0,'C');
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['jandadudaanakideal'],0,'.',','),'LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(20,5,'','LBR',0,'C');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(85,5,' (s/d Usia 25 Tahun / Bekerja / Menikah) ','LBR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(28.33,5,'','LBR',0,'C');
		$this->pdf->Cell(28.33,5,'','LBR',0,'C');
		$this->pdf->Cell(28.33,5,'','LBR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(20,5,'2.','LTR',0,'C');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(85,5,'SANTUNAN DUKA UNTUK :','LTR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(28.33,5,'','LTR',0,'C');
		$this->pdf->Cell(28.33,5,'','LTR',0,'C');
		$this->pdf->Cell(28.33,5,'','LTR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(20,5,'','LR',0,'C');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(85,5,'- JANDA / DUDA (12 X PENSIUN PESERTA)','LR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil'][''],0,'.',','),'LR',0,'C');
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil'][''],0,'.',','),'LR',0,'C');
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil'][''],0,'.',','),'LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(20,5,'','LR',0,'C');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(85,5,'- ANAK-ANAK (12 X PENSIUN JANDA / DUDA)','LR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil'][''],0,'.',','),'LR',0,'C');
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil'][''],0,'.',','),'LR',0,'C');
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil'][''],0,'.',','),'LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(20,5,'','LBR',0,'C');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(85,5,'- ISTRI / SUAMI PESERTA MENDAHULUI PESERTA','LBR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil'][''],0,'.',','),'LBR',0,'C');
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil'][''],0,'.',','),'LBR',0,'C');
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil'][''],0,'.',','),'LBR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(20,5,'3.','LTR',0,'C');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(85,5,'PENGEMBALIAN PREMI SEKALIGUS :','LTR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(28.33,5,'','LTR',0,'C');
		$this->pdf->Cell(28.33,5,'','LTR',0,'C');
		$this->pdf->Cell(28.33,5,'','LTR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(20,5,'','LR',0,'C');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(85,5,'- Peserta Hidup pada Usia 65 Tahun atau','LR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil'][''],0,'.',','),'LR',0,'C');
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil'][''],0,'.',','),'LR',0,'C');
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil'][''],0,'.',','),'LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(20,5,'','LBR',0,'C');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(85,5,'- Peserta Meninggal Dunia Sebelum atau Sesudah Usia 65 Tahun','LBR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',','),'LBR',0,'C');
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil'][''],0,'.',','),'LBR',0,'C');
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil'][''],0,'.',','),'LBR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(20,5,'4.','LTR',0,'C');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(85,5,'PENGEMBALIAN PREMI SEKALIGUS :','LTR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(28.33,5,'','LTR',0,'C');
		$this->pdf->Cell(28.33,5,'','LTR',0,'C');
		$this->pdf->Cell(28.33,5,'','LTR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(20,5,'','LR',0,'C');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(85,5,'- Dikurangi Manfaat Pensiun Peserta yang Telah Diterima pada','LR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(28.33,5,'','LR',0,'C');
		$this->pdf->Cell(28.33,5,'','LR',0,'C');
		$this->pdf->Cell(28.33,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(20,5,'','LR',0,'C');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(85,5,'  Saat Peserta Meninggal Dunia, (Contoh : tahun Ke-5)','LR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil'][''],0,'.',','),'LR',0,'C');
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'] - ($data['hasil']['pesertasejahteraideal'] * 60),0,'.',','),'LR',0,'C');
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil'][''],0,'.',','),'LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(20,5,'','LR',0,'C');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(85,5,'- Dikurangi Manfaat Pensiun Peserta dan Manfaat Janda / Duda','LR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(28.33,5,'','LR',0,'C');
		$this->pdf->Cell(28.33,5,'','LR',0,'C');
		$this->pdf->Cell(28.33,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(20,5,'','LR',0,'C');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(85,5,'  serta Anak-Anak yang Telah Diterima, Apabila Seluruh Ahli Waris','LR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(28.33,5,'','LR',0,'C');
		$this->pdf->Cell(28.33,5,'','LR',0,'C');
		$this->pdf->Cell(28.33,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(20,5,'','LR',0,'C');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(85,5,'  Gugur, (Contoh : tahun Ke-3)','LR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil'][''],0,'.',','),'LR',0,'C');
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil'][''],0,'.',','),'LR',0,'C');
		$this->pdf->Cell(28.33,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(20,5,'','LR',0,'C');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(85,5,'  * Yang Telah Diterima Oleh PESERTA (Lama Pem. Pensiun 3Th)','LR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(28.33,5,'','LR',0,'C');
		$this->pdf->Cell(28.33,5,'','LR',0,'C');
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['pesertaideal'] * 36,0,'.',','),'LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(20,5,'','LR',0,'C');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(85,5,'  * Yang Telah Diterima Oleh JANDA / DUDA (Lama Pem. 3Th)','LR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(28.33,5,'','LR',0,'C');
		$this->pdf->Cell(28.33,5,'','LR',0,'C');
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['jandadudaanakideal'] * 36,0,'.',','),'LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(20,5,'','LR',0,'C');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(85,5,'  * Yang Telah Diterima Oleh YATIM-PIATU (Lama Pem. 3Th)','LR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(28.33,5,'','LR',0,'C');
		$this->pdf->Cell(28.33,5,'','LR',0,'C');
		$this->pdf->SetFont('Arial','U',8);
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['jandadudaanakideal'] * 36,0,'.',','),'LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(20,5,'','LR',0,'C');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(85,5,'  Total Pembayaran','LR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(28.33,5,'','LR',0,'C');
		$this->pdf->Cell(28.33,5,'','LR',0,'C');
		$this->pdf->Cell(28.33,5,'Rp. '.number_format(($data['hasil']['pesertaideal'] * 36) + ($data['hasil']['jandadudaanakideal'] * 36 * 2),0,'.',','),'LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(20,5,'','LBR',0,'C');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(85,5,'  Jumlah yang Dikembalikan','LBR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(28.33,5,'','LBR',0,'C');
		$this->pdf->Cell(28.33,5,'','LBR',0,'C');
		$this->pdf->SetFont('Arial','U',8);
		$this->pdf->Cell(28.33,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'] - (($data['hasil']['pesertaideal'] * 36) + ($data['hasil']['jandadudaanakideal'] * 36 * 2)),0,'.',','),'LBR',0,'C');
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
		$this->pdf->Cell(190,5,'PROGRAM ANUITAS EKSEKUTIF PRIMA','B',0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(10);
		
		//ANUITAS EKSEKUTIF PRIMA
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(190,5,'PT. Asuransi Jiwasraya (Persero)  mempersembahkan   Produk  Asuransi  Jiwa   yang  dirancang   khusus  untuk para Eksekutif agar lebih tenang',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'didalam menikmati masa pensiun bersama keluarga,  ataupun  kesejahteraan  bagi ahli waris  yang  ditunjuk untuk  menerima  faedah  asuransi.',0,0,'L');
		$this->pdf->ln(10);
		
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(190,5,'PERHITUNGAN MANFAAT & PREMI ANUITAS',1,0,'C');
		$this->pdf->ln(10);
		
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Nama Calon Peserta',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(32,5,'Yth. '.$data['hasil']['namalengkapcalontertanggung'].' ',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Usia Peserta',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,''.$data['hasil']['usiacalontertanggung'].' Tahun ',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Premi Anuitas Sekaligus',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'','B',0,'L');
		$this->pdf->ln(8);
		$this->pdf->SetFont('Arial','BU',8);
		$this->pdf->Cell(190,5,'MANFAAT YANG DIPEROLEH :','',0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'1.',1,0,'C');
		$this->pdf->Cell(150,5,'Pensiun Hari Tua ( PHT )  dibayarkan  secara  bulanan  sampai dengan usia Tertanggung 70 tahun,',0,0,'L');
		$this->pdf->Cell(30,5,'',0,0,'C');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'',0,0,'C');
		$this->pdf->Cell(150,5,'dimulai pada bulan berikut setelah premi disetor sebesar',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,': Rp. '.number_format($data['hasil']['pesertaeksekutifprima'],0,'.',',').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'2.',1,0,'C');
		$this->pdf->Cell(150,5,'Pensiun Janda/Duda ( PJD )  dibayarkan secara bulanan sampai dengan usia Janda/Duda 70 tahun',0,0,'L');
		$this->pdf->Cell(30,5,'',0,0,'C');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'',0,0,'C');
		$this->pdf->Cell(150,5,'atau sampai menikah lagi, setelah penerima manfaat PHT meninggal dunia sebesar',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,': Rp. '.number_format($data['hasil']['pesertaeksekutifprima'] * 0.6,0,'.',',').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'3.',1,0,'C');
		$this->pdf->Cell(150,5,'Pengembalian premi 50% pada saat penerima manfaat PHT  berusia  65 tahun atau meninggal dunia',0,0,'L');
		$this->pdf->Cell(30,5,'',0,0,'C');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'',0,0,'C');
		$this->pdf->Cell(150,5,'sebelumnya sebesar',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,': Rp. '.number_format(($data['hasil']['uangasuransipokok']/2),0,'.',',').'',0,0,'L');
		
		$this->pdf->Image($imageaep, 20, 170);
		
		$this->pdf->ln(100);
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
		$this->pdf->Cell(190,5,'PROGRAM ANUITAS EKSEKUTIF PRIMA','B',0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(10);
		
		// TABEL
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'DENGAN PREMI SEKALIGUS',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'NO','LTR',0,'C');
		$this->pdf->Cell(10,5,'USIA','LTR',0,'C');
		$this->pdf->Cell(30,5,'PENSIUN HARI TUA','LTR',0,'C');
		$this->pdf->Cell(30,5,'PENSIUN JANDA / DUDA','LTR',0,'C');
		$this->pdf->Cell(30,5,'PENSIUN YATIM / PIATU','LTR',0,'C');
		$this->pdf->Cell(50,5,'SANTUNAN DUKA','LTR',0,'C');
		$this->pdf->Cell(30,5,'PENGEMBALIAN','LTR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'','LBR',0,'C');
		$this->pdf->Cell(10,5,'','LBR',0,'C');
		$this->pdf->Cell(30,5,'(PHT)','LBR',0,'C');
		$this->pdf->Cell(30,5,'(PJD)','LBR',0,'C');
		$this->pdf->Cell(30,5,'(PYP)','LBR',0,'C');
		$this->pdf->Cell(25,5,'JANDA / DUDA',1,0,'C');
		$this->pdf->Cell(25,5,'YATIM / PIATU',1,0,'C');
		$this->pdf->Cell(30,5,'PREMI','LBR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'','LR',0,'C');
		$this->pdf->Cell(10,5,'','LR',0,'C');
		$this->pdf->Cell(30,5,'','LR',0,'C');
		$this->pdf->Cell(30,5,'','LR',0,'C');
		$this->pdf->Cell(30,5,'','LR',0,'C');
		$this->pdf->Cell(25,5,'','LR',0,'C');
		$this->pdf->Cell(25,5,'','LR',0,'C');
		$this->pdf->Cell(30,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'1.','LR',0,'C');
		$this->pdf->Cell(10,5,'40','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia40']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia40']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia40']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia40']) * 100) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format(((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia40']) * 100) * 0.6) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'2.','LR',0,'C');
		$this->pdf->Cell(10,5,'41','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia41']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia41']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia41']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia41']) * 100) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format(((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia41']) * 100) * 0.6) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'3.','LR',0,'C');
		$this->pdf->Cell(10,5,'42','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia42']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia42']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia42']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia42']) * 100) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format(((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia42']) * 100) * 0.6) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'4.','LR',0,'C');
		$this->pdf->Cell(10,5,'43','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia43']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia43']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia43']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia43']) * 100) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format(((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia43']) * 100) * 0.6) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'5.','LR',0,'C');
		$this->pdf->Cell(10,5,'44','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia44']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia44']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia44']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia44']) * 100) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format(((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia44']) * 100) * 0.6) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'6.','LR',0,'C');
		$this->pdf->Cell(10,5,'45','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia45']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia45']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia45']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia45']) * 100) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format(((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia45']) * 100) * 0.6) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'7.','LR',0,'C');
		$this->pdf->Cell(10,5,'46','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia46']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia46']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia46']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia46']) * 100) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format(((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia46']) * 100) * 0.6) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'8.','LR',0,'C');
		$this->pdf->Cell(10,5,'47','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia47']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia47']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia47']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia47']) * 100) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format(((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia47']) * 100) * 0.6) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'9.','LR',0,'C');
		$this->pdf->Cell(10,5,'48','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia48']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia48']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia48']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia48']) * 100) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format(((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia48']) * 100) * 0.6) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'10.','LR',0,'C');
		$this->pdf->Cell(10,5,'49','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia49']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia49']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia49']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia49']) * 100) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format(((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia49']) * 100) * 0.6) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'11.','LR',0,'C');
		$this->pdf->Cell(10,5,'50','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia50']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia50']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia50']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia50']) * 100) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format(((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia50']) * 100) * 0.6) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'12.','LR',0,'C');
		$this->pdf->Cell(10,5,'51','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia51']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia51']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia51']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia51']) * 100) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format(((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia51']) * 100) * 0.6) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'13.','LR',0,'C');
		$this->pdf->Cell(10,5,'52','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia52']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia52']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia52']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia52']) * 100) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format(((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia52']) * 100) * 0.6) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'14.','LR',0,'C');
		$this->pdf->Cell(10,5,'53','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia53']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia53']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia53']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia53']) * 100) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format(((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia53']) * 100) * 0.6) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'15.','LR',0,'C');
		$this->pdf->Cell(10,5,'54','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia54']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia54']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia54']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia54']) * 100) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format(((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia54']) * 100) * 0.6) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'16.','LR',0,'C');
		$this->pdf->Cell(10,5,'55','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia55']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia55']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia55']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia55']) * 100) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format(((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia55']) * 100) * 0.6) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'17.','LR',0,'C');
		$this->pdf->Cell(10,5,'56','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia56']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia56']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia56']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia56']) * 100) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format(((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia56']) * 100) * 0.6) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'18.','LR',0,'C');
		$this->pdf->Cell(10,5,'57','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia57']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia57']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia57']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia57']) * 100) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format(((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia57']) * 100) * 0.6) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'19.','LR',0,'C');
		$this->pdf->Cell(10,5,'58','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia58']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia58']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia58']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia58']) * 100) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format(((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia58']) * 100) * 0.6) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'20.','LR',0,'C');
		$this->pdf->Cell(10,5,'59','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia59']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia59']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia59']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia59']) * 100) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format(((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia59']) * 100) * 0.6) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'21.','LR',0,'C');
		$this->pdf->Cell(10,5,'60','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia60']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia60']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia60']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia60']) * 100) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(25,5,'Rp. '.number_format(((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaepusia60']) * 100) * 0.6) * 12,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(30,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'','LBR',0,'C');
		$this->pdf->Cell(10,5,'','LBR',0,'C');
		$this->pdf->Cell(30,5,'','LBR',0,'C');
		$this->pdf->Cell(30,5,'','LBR',0,'C');
		$this->pdf->Cell(30,5,'','LBR',0,'C');
		$this->pdf->Cell(25,5,'','LBR',0,'C');
		$this->pdf->Cell(25,5,'','LBR',0,'C');
		$this->pdf->Cell(30,5,'','LBR',0,'C');
		
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(190,5,'KETERANGAN : ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'- Pengembalian Premi usia 65 Tahun atau Meninggal Dunia Sebelum Usia 65 Tahun.',0,0,'L');
		$this->pdf->ln(50);
		
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
		
		/*
		// PAGE 4
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
		$this->pdf->Cell(190,5,'PROGRAM ANUITAS IDEAL PRIMA','B',0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(10);
		
		//ANUITAS IDEAL PRIMA
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(190,5,'PT. Asuransi Jiwasraya (Persero)  mempersembahkan   Produk  Asuransi  Jiwa   yang  dirancang   khusus  untuk para Eksekutif agar lebih tenang',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'didalam menikmati masa pensiun bersama keluarga,  ataupun  kesejahteraan  bagi ahli waris  yang  ditunjuk untuk  menerima  faedah  asuransi.',0,0,'L');
		$this->pdf->ln(10);
		
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(190,5,'PERHITUNGAN MANFAAT & PREMI ANUITAS',1,0,'C');
		$this->pdf->ln(10);
		
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Nama Calon Tertanggung',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor('0','0','255');
		$this->pdf->Cell(32,5,'Yth. '.$data['hasil']['namalengkapcalontertanggung'].' ',0,0,'L');
		$this->pdf->SetTextColor('0','0','0');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Usia Peserta',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,''.$data['hasil']['usiacalontertanggung'].' Tahun ',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Premi Anuitas Sekaligus',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'','B',0,'L');
		$this->pdf->ln(8);
		$this->pdf->SetFont('Arial','BU',8);
		$this->pdf->Cell(190,5,'MANFAAT YANG DIPEROLEH :','',0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'1.',1,0,'C');
		$this->pdf->Cell(150,5,'Pensiun Hari Tua ( PHT )  dibayarkan  secara  bulanan  selama  hidup,',0,0,'L');
		$this->pdf->Cell(30,5,'',0,0,'C');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'',0,0,'C');
		$this->pdf->Cell(150,5,'dimulai pada bulan berikut setelah premi disetor',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,': Rp. '.number_format($data['hasil']['pesertaidealprima'],0,'.',',').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'2.',1,0,'C');
		$this->pdf->Cell(150,5,'Pensiun Janda/Duda ( PJD )  dibayarkan secara bulanan selama hidup',0,0,'L');
		$this->pdf->Cell(30,5,'',0,0,'C');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'',0,0,'C');
		$this->pdf->Cell(150,5,'atau sampai menikah lagi, setelah penerima PHT meninggal dunia',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,': Rp. '.number_format($data['hasil']['pesertaidealprima'] * 0.6,0,'.',',').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'3.',1,0,'C');
		$this->pdf->Cell(150,5,'Pensiun Anak-anak  dibayarkan secara bulanan setelah  penerima PJD',0,0,'L');
		$this->pdf->Cell(30,5,'',0,0,'C');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'',0,0,'C');
		$this->pdf->Cell(150,5,'meninggal dunia, kepada anak yang berusia  belum  25 tahun,  belum  bekerja',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,'',0,0,'R');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'',0,0,'C');
		$this->pdf->Cell(150,5,'dan belum menikah.',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,': Rp. '.number_format($data['hasil']['pesertaidealprima'] * 0.6,0,'.',',').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'4.',1,0,'C');
		$this->pdf->Cell(150,5,'Pengembalian premi 100% pada saat penerima PHT  berusia  65 tahun',0,0,'L');
		$this->pdf->Cell(30,5,'',0,0,'C');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'',0,0,'C');
		$this->pdf->Cell(150,5,'atau meninggal dunia sebelum itu',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,': Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'',0,0,'L');
		
		$this->pdf->Image($imageaip, 20, 160);
		
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
		$this->pdf->Cell(29,5,time(),0,0,'L');
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
		
		
		// PAGE 5
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
		$this->pdf->Cell(190,5,'PROGRAM ANUITAS IDEAL PRIMA','B',0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(10);
		
		// TABEL
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'DENGAN PREMI SEKALIGUS',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'NO','LTR',0,'C');
		$this->pdf->Cell(10,5,'USIA','LTR',0,'C');
		$this->pdf->Cell(42.5,5,'PENSIUN HARI TUA','LTR',0,'C');
		$this->pdf->Cell(42.5,5,'PENSIUN JANDA / DUDA','LTR',0,'C');
		$this->pdf->Cell(42.5,5,'PENSIUN YATIM / PIATU','LTR',0,'C');

		$this->pdf->Cell(42.5,5,'PENGEMBALIAN','LTR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'','LBR',0,'C');
		$this->pdf->Cell(10,5,'','LBR',0,'C');
		$this->pdf->Cell(42.5,5,'(PHT)','LBR',0,'C');
		$this->pdf->Cell(42.5,5,'(PJD)','LBR',0,'C');
		$this->pdf->Cell(42.5,5,'(PYP)','LBR',0,'C');
		
		$this->pdf->Cell(42.5,5,'PREMI','LBR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'','LR',0,'C');
		$this->pdf->Cell(10,5,'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'1.','LR',0,'C');
		$this->pdf->Cell(10,5,'40','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia40']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia40']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia40']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'2.','LR',0,'C');
		$this->pdf->Cell(10,5,'41','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia41']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia41']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia41']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'3.','LR',0,'C');
		$this->pdf->Cell(10,5,'42','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia42']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia42']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia42']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'4.','LR',0,'C');
		$this->pdf->Cell(10,5,'43','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia43']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia43']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia43']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'5.','LR',0,'C');
		$this->pdf->Cell(10,5,'44','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia44']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia44']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia44']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'6.','LR',0,'C');
		$this->pdf->Cell(10,5,'45','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia45']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia45']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia45']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'7.','LR',0,'C');
		$this->pdf->Cell(10,5,'46','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia46']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia46']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia46']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'8.','LR',0,'C');
		$this->pdf->Cell(10,5,'47','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia47']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia47']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia47']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'9.','LR',0,'C');
		$this->pdf->Cell(10,5,'48','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia48']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia48']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia48']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'10.','LR',0,'C');
		$this->pdf->Cell(10,5,'49','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia49']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia49']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia49']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'11.','LR',0,'C');
		$this->pdf->Cell(10,5,'50','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia50']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia50']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia50']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'12.','LR',0,'C');
		$this->pdf->Cell(10,5,'51','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia51']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia51']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia51']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'13.','LR',0,'C');
		$this->pdf->Cell(10,5,'52','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia52']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia52']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia52']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'14.','LR',0,'C');
		$this->pdf->Cell(10,5,'53','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia53']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia53']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia53']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'15.','LR',0,'C');
		$this->pdf->Cell(10,5,'54','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia54']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia54']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia54']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'16.','LR',0,'C');
		$this->pdf->Cell(10,5,'55','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia55']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia55']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia55']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'17.','LR',0,'C');
		$this->pdf->Cell(10,5,'56','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia56']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia56']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia56']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
	
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'18.','LR',0,'C');
		$this->pdf->Cell(10,5,'57','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia57']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia57']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia57']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'19.','LR',0,'C');
		$this->pdf->Cell(10,5,'58','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia58']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia58']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia58']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'20.','LR',0,'C');
		$this->pdf->Cell(10,5,'59','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia59']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia59']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia59']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'21.','LR',0,'C');
		$this->pdf->Cell(10,5,'60','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia60']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia60']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia60']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'','LBR',0,'C');
		$this->pdf->Cell(10,5,'','LBR',0,'C');
		$this->pdf->Cell(42.5,5,'','LBR',0,'C');
		$this->pdf->Cell(42.5,5,'','LBR',0,'C');
		$this->pdf->Cell(42.5,5,'','LBR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LBR',0,'C');
		
		
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
		$this->pdf->Cell(29,5,time(),0,0,'L');
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
		*/
		
		// PAGE 6
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
		$this->pdf->Cell(190,5,'PROGRAM ANUITAS SEJAHTERA IDEAL','B',0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(10);
		
		//ANUITAS SEJAHTERA IDEAL
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(190,5,'PT. Asuransi Jiwasraya (Persero)  mempersembahkan   Produk  Asuransi  Jiwa   yang  dirancang   khusus  untuk para Eksekutif agar lebih tenang',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'didalam menikmati masa pensiun bersama keluarga,  ataupun  kesejahteraan  bagi ahli waris  yang  ditunjuk untuk  menerima  faedah  asuransi.',0,0,'L');
		$this->pdf->ln(10);
		
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetFillColor('0','191','255');
		$this->pdf->Cell(190,5,'PERHITUNGAN MANFAAT & PREMI ANUITAS',1,0,'C', true);
		$this->pdf->ln(10);
		
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Nama Calon Tertanggung',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor('0','0','255');
		$this->pdf->Cell(32,5,'Yth. '.$data['hasil']['namalengkapcalontertanggung'].' ',0,0,'L');
		$this->pdf->SetTextColor('0','0','0');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Usia Peserta',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,''.$data['hasil']['usiacalontertanggung'].' Tahun ',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Premi Anuitas Sekaligus',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'','B',0,'L');
		$this->pdf->ln(8);
		$this->pdf->SetFont('Arial','BU',8);
		$this->pdf->Cell(190,5,'MANFAAT YANG DIPEROLEH :','',0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'1.',1,0,'C', true);
		$this->pdf->Cell(150,5,'Pensiun Hari Tua ( PHT )  dibayarkan  secara  bulanan  selama  hidup, dimulai pada bulan berikut setelah premi',0,0,'L');
		$this->pdf->Cell(30,5,'',0,0,'C');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'',0,0,'C');
		$this->pdf->Cell(150,5,'disetor sampai dengan penerima manfaat PHT meninggal dunia sebesar',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,': Rp. '.number_format($data['hasil']['pesertasejahteraideal'],0,'.',',').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'2.',1,0,'C', true);
		$this->pdf->Cell(150,5,'Pensiun Janda/Duda ( PJD ) dibayarkan sebesar 60% dari PHT secara bulanan selama hidup atau sampai menikah',0,0,'L');
		$this->pdf->Cell(30,5,'',0,0,'C');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'',0,0,'C');
		$this->pdf->Cell(150,5,'lagi, setelah penerima PHT meninggal dunia sebesar',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,': Rp. '.number_format($data['hasil']['pesertasejahteraideal'] * 0.6,0,'.',',').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'3.',1,0,'C', true);
		$this->pdf->Cell(150,5,'Pensiun Anak-anak  dibayarkan sebesar 60% dari PHT secara bulanan setelah  penerima PJD meninggal dunia, kepada',0,0,'L');
		$this->pdf->Cell(30,5,'',0,0,'C');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'',0,0,'C');
		$this->pdf->Cell(150,5,'anak yang berusia  belum  25 tahun,  belum  bekerja dan belum menikah sebesar',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,': Rp. '.number_format($data['hasil']['pesertasejahteraideal'] * 0.6,0,'.',',').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'4.',1,0,'C', true);
		$this->pdf->Cell(150,5,'Dibayarkan jika ada selisih antara Premi dengan jumlah PHT, PJD, pensiun anak dimaksud angka (1), (2), (3), yang',0,0,'L');
		$this->pdf->Cell(30,5,'',0,0,'C');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'',0,0,'C');
		$this->pdf->Cell(150,5,'telah diterimakan, dan dibayarkan kepada ahli waris apabila sudah tidak ada lagi pihak yang berhak menerima',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'',0,0,'C');
		$this->pdf->Cell(150,5,'pensiun. Sebagai contoh untuk Tahun ke 5, sebesar',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,': Rp. '.number_format($data['hasil']['uangasuransipokok'] - ($data['hasil']['pesertasejahteraideal'] * 60),0,'.',','),0,0,'L');
		
		$this->pdf->Image($imageasi, 20, 160);
		
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
		
		// PAGE 7
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
		$this->pdf->Cell(190,5,'PROGRAM ANUITAS SEJAHTERA IDEAL','B',0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(10);
		
		// TABEL
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'DENGAN PREMI SEKALIGUS',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'NO','LTR',0,'C');
		$this->pdf->Cell(10,5,'USIA','LTR',0,'C');
		$this->pdf->Cell(42.5,5,'PENSIUN HARI TUA','LTR',0,'C');
		$this->pdf->Cell(42.5,5,'PENSIUN JANDA / DUDA','LTR',0,'C');
		$this->pdf->Cell(42.5,5,'PENSIUN YATIM / PIATU','LTR',0,'C');

		$this->pdf->Cell(42.5,5,'PENGEMBALIAN','LTR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'','LBR',0,'C');
		$this->pdf->Cell(10,5,'','LBR',0,'C');
		$this->pdf->Cell(42.5,5,'(PHT)','LBR',0,'C');
		$this->pdf->Cell(42.5,5,'(PJD)','LBR',0,'C');
		$this->pdf->Cell(42.5,5,'(PYP)','LBR',0,'C');
		
		$this->pdf->Cell(42.5,5,'PREMI','LBR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'','LR',0,'C');
		$this->pdf->Cell(10,5,'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'1.','LR',0,'C');
		$this->pdf->Cell(10,5,'40','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia40']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia40']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia40']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Dibayarkan sebesar selisih premi','LR',0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'2.','LR',0,'C');
		$this->pdf->Cell(10,5,'41','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia41']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia41']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia41']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Sekaligus dikurangi dengan jumlah','LR',0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'3.','LR',0,'C');
		$this->pdf->Cell(10,5,'42','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia42']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia42']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia42']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'PHT yang telah diterima.','LR',0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'4.','LR',0,'C');
		$this->pdf->Cell(10,5,'43','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia43']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia43']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaipusia43']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'5.','LR',0,'C');
		$this->pdf->Cell(10,5,'44','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia44']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia44']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia44']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'6.','LR',0,'C');
		$this->pdf->Cell(10,5,'45','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia45']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia45']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia45']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'7.','LR',0,'C');
		$this->pdf->Cell(10,5,'46','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia46']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia46']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia46']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'8.','LR',0,'C');
		$this->pdf->Cell(10,5,'47','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia47']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia47']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia47']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'9.','LR',0,'C');
		$this->pdf->Cell(10,5,'48','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia48']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia48']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia48']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'10.','LR',0,'C');
		$this->pdf->Cell(10,5,'49','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia49']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia49']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia49']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'11.','LR',0,'C');
		$this->pdf->Cell(10,5,'50','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia50']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia50']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia50']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'12.','LR',0,'C');
		$this->pdf->Cell(10,5,'51','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia51']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia51']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia51']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'13.','LR',0,'C');
		$this->pdf->Cell(10,5,'52','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia52']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia52']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia52']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'14.','LR',0,'C');
		$this->pdf->Cell(10,5,'53','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia53']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia53']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia53']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'15.','LR',0,'C');
		$this->pdf->Cell(10,5,'54','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia54']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia54']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia54']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'16.','LR',0,'C');
		$this->pdf->Cell(10,5,'55','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia55']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia55']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia55']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'17.','LR',0,'C');
		$this->pdf->Cell(10,5,'56','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia56']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia56']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia56']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
	
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'18.','LR',0,'C');
		$this->pdf->Cell(10,5,'57','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia57']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia57']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia57']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'19.','LR',0,'C');
		$this->pdf->Cell(10,5,'58','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia58']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia58']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia58']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'20.','LR',0,'C');
		$this->pdf->Cell(10,5,'59','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia59']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia59']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia59']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'21.','LR',0,'C');
		$this->pdf->Cell(10,5,'60','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia60']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia60']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasasiusia60']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'','LBR',0,'C');
		$this->pdf->Cell(10,5,'','LBR',0,'C');
		$this->pdf->Cell(42.5,5,'','LBR',0,'C');
		$this->pdf->Cell(42.5,5,'','LBR',0,'C');
		$this->pdf->Cell(42.5,5,'','LBR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LBR',0,'C');
		
		
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
		
		// PAGE 8
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
		$this->pdf->Cell(190,5,'PROGRAM ANUITAS SEJAHTERA PRIMA','B',0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(10);
		
		//ANUITAS SEJAHTERA PRIMA
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(190,5,'PT. Asuransi Jiwasraya (Persero)  mempersembahkan   Produk  Asuransi  Jiwa   yang  dirancang   khusus  untuk para Eksekutif agar lebih tenang',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'didalam menikmati masa pensiun bersama keluarga,  ataupun  kesejahteraan  bagi ahli waris  yang  ditunjuk untuk  menerima  faedah  asuransi.',0,0,'L');
		$this->pdf->ln(10);
		
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetFillColor('152','251','152');
		$this->pdf->Cell(190,5,'PERHITUNGAN MANFAAT & PREMI ANUITAS',1,0,'C', true);
		$this->pdf->ln(10);
		
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Nama Calon Tertanggung',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor('135','206','250');
		$this->pdf->Cell(32,5,'Yth. '.$data['hasil']['namalengkapcalontertanggung'].' ',0,0,'L');
		$this->pdf->SetTextColor('0','0','0');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Usia Peserta',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,''.$data['hasil']['usiacalontertanggung'].' Tahun ',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Premi Anuitas Sekaligus',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'','B',0,'L');
		$this->pdf->ln(8);
		$this->pdf->SetFont('Arial','BU',8);
		$this->pdf->Cell(190,5,'MANFAAT YANG DIPEROLEH :','',0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'1.',1,0,'C');
		$this->pdf->Cell(150,5,'Pensiun Hari Tua ( PHT )  dibayarkan  secara  bulanan  selama  hidup, dimulai pada bulan berikut setelah premi',0,0,'L');
		$this->pdf->Cell(30,5,'',0,0,'C');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'',0,0,'C');
		$this->pdf->Cell(150,5,'disetor sampai dengan penerima manfaat PHT meninggal dunia sebesar',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,': Rp. '.number_format($data['hasil']['pesertasejahteraprima'],0,'.',',').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'2.',1,0,'C');
		$this->pdf->Cell(150,5,'Pensiun Janda/Duda ( PJD )  dibayarkan sebesar 60% dari PHT secara bulanan selama hidup atau sampai menikah',0,0,'L');
		$this->pdf->Cell(30,5,'',0,0,'C');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'',0,0,'C');
		$this->pdf->Cell(150,5,'lagi, setelah penerima PHT meninggal dunia sebesar',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,': Rp. '.number_format($data['hasil']['pesertasejahteraprima'] * 0.6,0,'.',',').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'3.',1,0,'C');
		$this->pdf->Cell(150,5,'Pensiun Anak-anak dibayarkan sebesar 60% dari PHT secara bulanan setelah  penerima PJD meninggal dunia, kepada',0,0,'L');
		$this->pdf->Cell(30,5,'',0,0,'C');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'',0,0,'C');
		$this->pdf->Cell(150,5,'anak yang berusia  belum  25 tahun,  belum  bekerja dan belum menikah sebesar',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,': Rp. '.number_format($data['hasil']['pesertasejahteraprima'] * 0.6,0,'.',',').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'4.',1,0,'C');
		$this->pdf->Cell(150,5,'Pengembalian premi 100% pada saat penerima manfaat PHT  meninggal dunia yang dibayarkan kepada ahli',0,0,'L');
		$this->pdf->Cell(30,5,'',0,0,'C');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'',0,0,'C');
		$this->pdf->Cell(150,5,'waris sebesar',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,': Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',','),0,0,'L');
		
		$this->pdf->Image($imageasp, 20, 160);
		
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
		
		// PAGE 9
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
		$this->pdf->Cell(190,5,'PROGRAM ANUITAS SEJAHTERA PRIMA','B',0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(10);
		
		// TABEL
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'DENGAN PREMI SEKALIGUS',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'NO','LTR',0,'C');
		$this->pdf->Cell(10,5,'USIA','LTR',0,'C');
		$this->pdf->Cell(42.5,5,'PENSIUN HARI TUA','LTR',0,'C');
		$this->pdf->Cell(42.5,5,'PENSIUN JANDA / DUDA','LTR',0,'C');
		$this->pdf->Cell(42.5,5,'PENSIUN YATIM / PIATU','LTR',0,'C');

		$this->pdf->Cell(42.5,5,'PENGEMBALIAN','LTR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'','LBR',0,'C');
		$this->pdf->Cell(10,5,'','LBR',0,'C');
		$this->pdf->Cell(42.5,5,'(PHT)','LBR',0,'C');
		$this->pdf->Cell(42.5,5,'(PJD)','LBR',0,'C');
		$this->pdf->Cell(42.5,5,'(PYP)','LBR',0,'C');
		
		$this->pdf->Cell(42.5,5,'PREMI','LBR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'','LR',0,'C');
		$this->pdf->Cell(10,5,'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'1.','LR',0,'C');
		$this->pdf->Cell(10,5,'40','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia40']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia40']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia40']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'2.','LR',0,'C');
		$this->pdf->Cell(10,5,'41','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia41']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia41']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia41']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'3.','LR',0,'C');
		$this->pdf->Cell(10,5,'42','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia42']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia42']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia42']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'4.','LR',0,'C');
		$this->pdf->Cell(10,5,'43','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia43']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia43']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia43']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'5.','LR',0,'C');
		$this->pdf->Cell(10,5,'44','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia44']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia44']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia44']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'6.','LR',0,'C');
		$this->pdf->Cell(10,5,'45','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia45']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia45']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia45']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'7.','LR',0,'C');
		$this->pdf->Cell(10,5,'46','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia46']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia46']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia46']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'8.','LR',0,'C');
		$this->pdf->Cell(10,5,'47','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia47']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia47']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia47']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'9.','LR',0,'C');
		$this->pdf->Cell(10,5,'48','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia48']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia48']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia48']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'10.','LR',0,'C');
		$this->pdf->Cell(10,5,'49','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia49']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia49']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia49']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'11.','LR',0,'C');
		$this->pdf->Cell(10,5,'50','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia50']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia50']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia50']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'12.','LR',0,'C');
		$this->pdf->Cell(10,5,'51','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia51']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia51']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia51']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'13.','LR',0,'C');
		$this->pdf->Cell(10,5,'52','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia52']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia52']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia52']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'14.','LR',0,'C');
		$this->pdf->Cell(10,5,'53','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia53']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia53']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia53']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'15.','LR',0,'C');
		$this->pdf->Cell(10,5,'54','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia54']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia54']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia54']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'16.','LR',0,'C');
		$this->pdf->Cell(10,5,'55','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia55']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia55']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia55']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'17.','LR',0,'C');
		$this->pdf->Cell(10,5,'56','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia56']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia56']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia56']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
	
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'18.','LR',0,'C');
		$this->pdf->Cell(10,5,'57','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia57']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia57']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia57']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'19.','LR',0,'C');
		$this->pdf->Cell(10,5,'58','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia58']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia58']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia58']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'20.','LR',0,'C');
		$this->pdf->Cell(10,5,'59','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia59']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia59']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia59']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'21.','LR',0,'C');
		$this->pdf->Cell(10,5,'60','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia60']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia60']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaspusia60']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'','LBR',0,'C');
		$this->pdf->Cell(10,5,'','LBR',0,'C');
		$this->pdf->Cell(42.5,5,'','LBR',0,'C');
		$this->pdf->Cell(42.5,5,'','LBR',0,'C');
		$this->pdf->Cell(42.5,5,'','LBR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LBR',0,'C');
		
		
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
		
		// PAGE 10
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
		$this->pdf->Cell(190,5,'PROGRAM ANUITAS IDEAL','B',0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(10);
		
		//ANUITAS IDEAL
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(190,5,'PT. Asuransi Jiwasraya (Persero)  mempersembahkan   Produk  Asuransi  Jiwa   yang  dirancang   khusus  untuk para Eksekutif agar lebih tenang',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'didalam menikmati masa pensiun bersama keluarga,  ataupun  kesejahteraan  bagi ahli waris  yang  ditunjuk untuk  menerima  faedah  asuransi.',0,0,'L');
		$this->pdf->ln(10);
		
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetFillColor('255','165','0');
		$this->pdf->Cell(190,5,'PERHITUNGAN MANFAAT & PREMI ANUITAS',1,0,'C', true);
		$this->pdf->ln(10);
		
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Nama Calon Tertanggung',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor('0','0','255');
		$this->pdf->Cell(32,5,'Yth. '.$data['hasil']['namalengkapcalontertanggung'].' ',0,0,'L');
		$this->pdf->SetTextColor('0','0','0');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Usia Peserta',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,''.$data['hasil']['usiacalontertanggung'].' Tahun ',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Premi Anuitas Sekaligus',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(190,5,'','B',0,'L');
		$this->pdf->ln(8);
		$this->pdf->SetFont('Arial','BU',8);
		$this->pdf->Cell(190,5,'MANFAAT YANG DIPEROLEH :','',0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(10,5,'1.',1,0,'C', true);
		$this->pdf->Cell(150,5,'PENSIUN HARI TUA (PHT)',0,0,'L');
		$this->pdf->Cell(30,5,'',0,0,'C');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'',0,0,'C');
		$this->pdf->Cell(150,5,'Dibayarkan setiap bulan selama hidup Pemegang Polis/Tertanggung diakhiri Jika Pemegang Polis/ Tertanggung',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,'',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'',0,0,'C');
		$this->pdf->Cell(150,5,'meninggal dunia mulai bulan berikutnya setelah premi disetor sebesar',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,': Rp. '.number_format($data['hasil']['pesertaideal'],0,'.',',').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(10,5,'2.',1,0,'C', true);
		$this->pdf->Cell(150,5,'PENSIUN JANDA/DUDA (PJD)',0,0,'L');
		$this->pdf->Cell(30,5,'',0,0,'C');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'',0,0,'C');
		$this->pdf->Cell(150,5,'Jika Pemegang Polis/Tertanggung meninggal dunia dibayarkan pensiun Janda/Duda sebesar 60% dari PHT setiap',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,'',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'',0,0,'C');
		$this->pdf->Cell(150,5,'bulan yang dimulai pada bulan berikutnya setelah Pemegang Polis/Tertanggung meninggal dunia dan berakhir',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,'',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'',0,0,'C');
		$this->pdf->Cell(150,5,'setelah Janda/Duda meninggal dunia atau menikah lagi sebesar',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,': Rp. '.number_format($data['hasil']['pesertaideal'] * 0.6,0,'.',',').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(10,5,'3.',1,0,'C', true);
		$this->pdf->Cell(150,5,'PENSIUN ANAK (ANAK-ANAK)',0,0,'L');
		$this->pdf->Cell(30,5,'',0,0,'C');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'',0,0,'C');
		$this->pdf->Cell(150,5,'Jika Janda/Duda meninggal dunia atau menikah lagi atau Pemegang Polis/Tertanggung meninggal dunia dalam hal',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,'',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'',0,0,'C');
		$this->pdf->Cell(150,5,'Istri/Suami meninggal lebih dahulu, mulai bulan berikutnya dibayarkan pensiun anak setiap bulan sebesar 60%',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,'',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'',0,0,'C');
		$this->pdf->Cell(150,5,'dari PHT dan berakhir setelah anak (anak-anak) berusia 25 tahun atau sudah bekerja atau sudah menikah atau',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,'',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'',0,0,'C');
		$this->pdf->Cell(150,5,'meninggal dunia sebelumnya sebesar',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,': Rp. '.number_format($data['hasil']['pesertaideal'] * 0.6,0,'.',',').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(10,5,'4.',1,0,'C', true);
		$this->pdf->Cell(150,5,'PENGEMBALIAN PREMI',0,0,'L');
		$this->pdf->Cell(30,5,'',0,0,'C');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'',0,0,'C');
		$this->pdf->Cell(150,5,'Dibayarkan jika ada selisih antara premi dengan Jumlah PHT, PJD, pensiun anak dimaksud angka (1), (2), (3)',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,'',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'',0,0,'C');
		$this->pdf->Cell(150,5,'yang telah diterimakan, dan dibayarkan kepada ahli waris apabila sudah tidak ada lagi pihak yang berhak menerima',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,'',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'',0,0,'C');
		$this->pdf->Cell(150,5,'pensiun. Sebagai contoh PHT terima 3 tahun, PJD terima 3 tahun, Pensiun anak terima 3 tahun, sebesar',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(30,5,': Rp. '.number_format($data['hasil']['uangasuransipokok'] - (($data['hasil']['pesertaideal'] * 36)+($data['hasil']['jandadudaanakideal'] * 36 * 2)),0,'.',',').'',0,0,'L');
		
		$this->pdf->Image($imageai, 20, 170);
		
		$this->pdf->ln(75);
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
		
		// PAGE 11
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
		$this->pdf->Cell(190,5,'PROGRAM ANUITAS IDEAL','B',0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(10);
		
		// TABEL
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'DENGAN PREMI SEKALIGUS',0,0,'L');
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(32,5,'Rp. '.number_format($data['hasil']['uangasuransipokok'],0,'.',',').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'NO','LTR',0,'C');
		$this->pdf->Cell(10,5,'USIA','LTR',0,'C');
		$this->pdf->Cell(42.5,5,'PENSIUN HARI TUA','LTR',0,'C');
		$this->pdf->Cell(42.5,5,'PENSIUN JANDA / DUDA','LTR',0,'C');
		$this->pdf->Cell(42.5,5,'PENSIUN YATIM / PIATU','LTR',0,'C');

		$this->pdf->Cell(42.5,5,'PENGEMBALIAN','LTR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'','LBR',0,'C');
		$this->pdf->Cell(10,5,'','LBR',0,'C');
		$this->pdf->Cell(42.5,5,'(PHT)','LBR',0,'C');
		$this->pdf->Cell(42.5,5,'(PJD)','LBR',0,'C');
		$this->pdf->Cell(42.5,5,'(PYP)','LBR',0,'C');
		
		$this->pdf->Cell(42.5,5,'PREMI','LBR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'','LR',0,'C');
		$this->pdf->Cell(10,5,'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'1.','LR',0,'C');
		$this->pdf->Cell(10,5,'40','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia40']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia40']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia40']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'Apabila sudah tidak ada lagi orang','LR',0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'2.','LR',0,'C');
		$this->pdf->Cell(10,5,'41','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia41']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia41']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia41']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'yang berhak menerima pensiun,','LR',0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'3.','LR',0,'C');
		$this->pdf->Cell(10,5,'42','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia42']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia42']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia42']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'dibayarkan sekaligus pengembalian','LR',0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'4.','LR',0,'C');
		$this->pdf->Cell(10,5,'43','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia43']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia43']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia43']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'premi kepada ahli waris, jika masih','LR',0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'5.','LR',0,'C');
		$this->pdf->Cell(10,5,'44','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia44']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia44']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia44']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'terdapat selisih antara premi','LR',0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'6.','LR',0,'C');
		$this->pdf->Cell(10,5,'45','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia45']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia45']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia45']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'sekaligus setelah dikurangi dengan','LR',0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'7.','LR',0,'C');
		$this->pdf->Cell(10,5,'46','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia46']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia46']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia46']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'seluruh pembayaran pensiun yang','LR',0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'8.','LR',0,'C');
		$this->pdf->Cell(10,5,'47','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia47']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia47']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia47']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'telah diterimakan.','LR',0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'9.','LR',0,'C');
		$this->pdf->Cell(10,5,'48','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia48']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia48']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia48']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'10.','LR',0,'C');
		$this->pdf->Cell(10,5,'49','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia49']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia49']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia49']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'11.','LR',0,'C');
		$this->pdf->Cell(10,5,'50','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia50']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia50']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia50']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'12.','LR',0,'C');
		$this->pdf->Cell(10,5,'51','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia51']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia51']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia51']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'13.','LR',0,'C');
		$this->pdf->Cell(10,5,'52','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia52']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia52']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia52']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'14.','LR',0,'C');
		$this->pdf->Cell(10,5,'53','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia53']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia53']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia53']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'15.','LR',0,'C');
		$this->pdf->Cell(10,5,'54','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia54']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia54']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia54']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'16.','LR',0,'C');
		$this->pdf->Cell(10,5,'55','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia55']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia55']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia55']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'17.','LR',0,'C');
		$this->pdf->Cell(10,5,'56','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia56']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia56']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia56']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
	
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'18.','LR',0,'C');
		$this->pdf->Cell(10,5,'57','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia57']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia57']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia57']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'19.','LR',0,'C');
		$this->pdf->Cell(10,5,'58','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia58']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia58']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia58']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'20.','LR',0,'C');
		$this->pdf->Cell(10,5,'59','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia59']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia59']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia59']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'21.','LR',0,'C');
		$this->pdf->Cell(10,5,'60','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format(($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia60']) * 100,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia60']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		$this->pdf->Cell(42.5,5,'Rp. '.number_format((($data['hasil']['uangasuransipokok'] / $data['hasil']['tarifanuitasaiusia60']) * 100) * 0.6,0,'.',',').'','LR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LR',0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(10,5,'','LBR',0,'C');
		$this->pdf->Cell(10,5,'','LBR',0,'C');
		$this->pdf->Cell(42.5,5,'','LBR',0,'C');
		$this->pdf->Cell(42.5,5,'','LBR',0,'C');
		$this->pdf->Cell(42.5,5,'','LBR',0,'C');
		
		$this->pdf->Cell(42.5,5,'','LBR',0,'C');
		
		
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
		
		// PAGE 12
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
		$this->pdf->Cell(190,5,'PROGRAM ANUITAS PERTANGGUNGAN PERORANGAN','B',0,'L');
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