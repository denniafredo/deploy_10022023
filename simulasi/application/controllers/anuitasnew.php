<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");

	error_reporting(0);

class Anuitasnew extends CI_Controller{

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
		
//		$tahunmulas = date("Y", strtotime($this->input->post('saatmulaiasuransijsanuitas')));
//		$bulanmulas = date("n", strtotime($this->input->post('saatmulaiasuransijsanuitas')));
//		
//		$tanggallahir = date("d", strtotime($this->input->post('tgllahir')));
//		$tahunlahir = date("Y", strtotime($this->input->post('tgllahir')));
//			
//		$selisihMulas = $tahunmulas + $bulanmulas/12;
//		
//		$bulanlahir = date("n", strtotime($this->input->post('tgllahir')));
		
//		$diff = abs(strtotime($this->input->post('saatmulaiasuransijsanuitas')) - strtotime($this->input->post('tgllahir')));
//
//		$years = floor($diff / (365*60*60*24));
//		$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
//		$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
//	
//		echo $months;
		
		$datetime1 = date_create($this->input->post('tgllahir'));
		$datetime2 = date_create($this->input->post('saatmulaiasuransijsanuitas'));
		
		$diff=date_diff($datetime1,$datetime2);
		$months = $diff->m;
		$years = $diff->y;
		
		/*
		if (round($tanggallahir) > 1)
		{
			$bulanlahir = date("n", strtotime($this->input->post('tgllahir')))+1;
		}
		else
		{
			$bulanlahir = date("n", strtotime($this->input->post('tgllahir')));
		}
		*/
		
//		$selisihLahir = $tahunlahir + $bulanlahir/12;
//		$selisihUmur = $selisihMulas - $selisihLahir;
//		$usiaSekarang = intval($selisihUmur);
//		$selisihBulan = round(($selisihUmur - $usiaSekarang)*12);
//		
//		$umur = floor(($tahunmulas + ($bulanmulas/12)) - ($tahunlahir + ($bulanlahir/12)));
//		$tahun = intval($umur);
//		
//		$bulan = ($umur - $tahun) * 12;
		
		$tarifanuitasani1 = $this->ModSimulasi->GetTarifAnuitasANI($years, $statuskawin, $months, $premisekaligusjsanuitas);
		//$tarifanuitasani2 = $this->Modanuitasnew2->GetTarifAnuitasANI(($usiaSekarang + 1), $statuskawin, $selisihBulan, $premisekaligusjsanuitas);
		
		//$tarifinterpolasi = (($tarifanuitasani1['TARIF']*(12-$selisihBulan)+$tarifanuitasani2['TARIF']*$selisihBulan)/12);
		
		//$pht = ($premisekaligusjsanuitas*100)/$tarifanuitasani1['TARIF'];
		
		echo ceil($tarifanuitasani1['TARIF']);
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
		
		$pht = $premisekaligusjsanuitas/$tarifinterpolasi*100;
		
//		$pht = $premisekaligusjsanuitas*100/$tarifanuitasaep1['TARIF'];
		
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
		/*
		if($data['hasil']['tanggalLahir']>1)
		{
		$data['hasil']['bulanLahir'] = date("n", strtotime($this->session->userdata('tgl_lahir'))) + 1;
		}
		else
		{
		$data['hasil']['bulanLahir'] = date("n", strtotime($this->session->userdata('tgl_lahir')));
		}
		*/
		
		$data['hasil']['bulanLahir'] = date("n", strtotime($this->session->userdata('tgl_lahir')));
		
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
		
		
		
		$statuskawin = $this->session->userdata('statuskawin');
		$data['hasil']['statuskawin'] = $this->session->userdata('statuskawin');
		
		
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
		
		$data['hasil']['pengembaliansisadanabujang'] = ($data['hasil']['premisekaligusjsanuitas'])-($data['hasil']['aikawin']*12*10);
		
		if ($data['hasil']['pengembaliansisadanabujang'] < 0)
		{
			$data['hasil']['pengembaliansisadanabujang'] = 0;	
		}
		else
		{
			$data['hasil']['pengembaliansisadanabujang'] = $data['hasil']['pengembaliansisadanabujang'];
		}
		
		$data['hasil']['pengembaliansisadanakawin'] = ($data['hasil']['premisekaligusjsanuitas'])-(($data['hasil']['aikawin']*4*12)+($data['hasil']['aikawin']*0.6*6*12));
		
		if ($data['hasil']['pengembaliansisadanakawin'] < 0)
		{
			$data['hasil']['pengembaliansisadanakawin'] = 0;	
		}
		else
		{
			$data['hasil']['pengembaliansisadanakawin'] = $data['hasil']['pengembaliansisadanakawin'];
		}
		
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
		
		$this->load->view('hasil/anuitasnew',$data);
		
		//$this->session->sess_destroy();
	}

	function createPDF($namaFile,$data){
		$image1 = FCPATH.'assets/img/logo-js.png';
		$imageai = FCPATH.'assets/img/anuitas1.png';
		$imageai2 = FCPATH.'assets/img/anuitas2.png';
		/*
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
		$this->pdf->ln(10);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(0,32,96);
		$this->pdf->SetFont('Arial','',20);
		$this->pdf->Cell(190,8,'PROPOSAL ANUITAS',1,0,'C',true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',20);
		$this->pdf->SetTextColor(0,0,255);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(190,8,'Tarip Baru Basis AN-03D3/04',1,0,'C', true);
		$this->pdf->ln(10);

		// DATA
		$this->pdf->SetFont('Arial','BU',12);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(91,155,213);
		$this->pdf->Cell(95,5,'Data',0,0,'L',true);
		$this->pdf->SetFont('Arial','B',0);
		$this->pdf->SetTextColor(248,203,173);
		$this->pdf->SetFillColor(219,219,219);
		$this->pdf->Cell(95,5,'','LTR',0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(188,214,238);
		$this->pdf->Cell(30,5,'',0,0,'L',true);
		$this->pdf->Cell(65,5,'Created by Divisi Teknologi Informasi',0,0,'L',true);
		$this->pdf->SetFont('Arial','B',0);
		$this->pdf->SetTextColor(248,203,173);
		$this->pdf->SetFillColor(219,219,219);
		$this->pdf->Cell(95,5,'','LR',0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(188,214,238);
		$this->pdf->Cell(48,5,'Nama Calon Tertanggung',0,0,'L', true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(3,5,':',0,0,'L', true);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(191,191,191);
		$this->pdf->Cell(44,5,''.$data['hasil']['namalengkapcalontertanggung'].' ',1,0,'L', true);
		$this->pdf->SetFont('Arial','B',0);
		$this->pdf->SetTextColor(248,203,173);
		$this->pdf->SetFillColor(219,219,219);
		$this->pdf->Cell(95,5,'','LR',0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(188,214,238);
		$this->pdf->Cell(48,5,'Tanggal Lahir Calon Tertanggung',0,0,'L',true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(3,5,':',0,0,'L', true);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(191,191,191);
		$this->pdf->Cell(44,5,''.$data['hasil']['tanggallahircalontertangggung'].' ',1,0,'L', true);
		$this->pdf->SetFont('Arial','B',54);
		$this->pdf->SetTextColor(248,203,173);
		$this->pdf->SetFillColor(219,219,219);
		$this->pdf->Cell(95,5,'Program','LR',0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(188,214,238);
		$this->pdf->Cell(48,5,'Saat Mulai Asuransi',0,0,'L',true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(3,5,':',0,0,'L', true);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(191,191,191);
		$this->pdf->Cell(44,5,''.$data['hasil']['saatmulaiasuransi'].' ',1,0,'L', true);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(248,203,173);
		$this->pdf->SetFillColor(219,219,219);
		$this->pdf->Cell(95,5,'','LR',0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(188,214,238);
		$this->pdf->Cell(48,5,'Premi Sekaligus',0,0,'L', true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(3,5,':',0,0,'L', true);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(191,191,191);
		$this->pdf->Cell(44,5,'Rp. '.number_format($data['hasil']['premisekaligusjsanuitas'],0,'.',',').'',1,0,'L', true);
		$this->pdf->SetFont('Arial','B',0);
		$this->pdf->SetTextColor(248,203,173);
		$this->pdf->SetFillColor(219,219,219);
		$this->pdf->Cell(95,5,'','LR',0,'L');

		$this->pdf->ln();
		$this->pdf->SetFont('Arial','BU',10);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(40,5,'','',0,'L',true);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(27.5,5,'',0,0,'L',true);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(27.5,5,'',0,0,'L',true);
		$this->pdf->SetFont('Arial','B',54);
		$this->pdf->SetTextColor(248,203,173);
		$this->pdf->SetFillColor(219,219,219);
		$this->pdf->Cell(95,5,'','LR',0,'L');


		// NILAI ANUITAS
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','BU',12);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(91,155,213);
		$this->pdf->Cell(35,5,'Nilai Anuitas','',0,'L',true);
		if($data['hasil']['statuskawin'] == 'kawin')
		{
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(91,155,213);
		$this->pdf->Cell(30,5,'Kawin',0,0,'L',true);
		}
		else if($data['hasil']['statuskawin'] == 'bujang')
		{
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(91,155,213);
		$this->pdf->Cell(30,5,'Lajang',0,0,'L',true);
		}
		$this->pdf->Cell(30);
		$this->pdf->SetFont('Arial','B',54);
		$this->pdf->SetTextColor(248,203,173);
		$this->pdf->SetFillColor(219,219,219);
		$this->pdf->Cell(95,5,'Pensiun','LR',0,'L');
		
		if ($data['hasil']['pilihananuitas'] == 'SEJAHTERA PRIMA')
		{
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(188,214,238);
		$this->pdf->Cell(35,5,'Anuitas Sejahtera Prima',0,0,'L',true);
		if($data['hasil']['statuskawin'] == 'kawin')
		{
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(188,214,238);
		$this->pdf->Cell(30,5,'Rp. '.number_format($data['hasil']['aspkawin'],0,'.',',').'',0,0,'L',true);
		}
		else if($data['hasil']['statuskawin'] == 'bujang')
		{
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(188,214,238);
		$this->pdf->Cell(30,5,'Rp. '.number_format($data['hasil']['aspbujang'],0,'.',',').'',0,0,'L',true);
		}
		$this->pdf->Cell(30);
		$this->pdf->SetFont('Arial','B',54);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(188,214,238);
		$this->pdf->Cell(95,5,'','LR',0,'L');
		}
		else if ($data['hasil']['pilihananuitas'] == 'SEJAHTERA IDEAL')
		{
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(188,214,238);
		$this->pdf->Cell(35,5,'Anuitas Sejahtera Ideal',0,0,'L',true);
		if($data['hasil']['statuskawin'] == 'kawin')
		{
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(188,214,238);
		$this->pdf->Cell(30,5,'Rp. '.number_format($data['hasil']['asikawin'],0,'.',',').'',0,0,'L',true);
		}
		else if($data['hasil']['statuskawin'] == 'bujang')
		{
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(188,214,238);
		$this->pdf->Cell(30,5,'Rp. '.number_format($data['hasil']['asibujang'],0,'.',',').'',0,0,'L',true);
		}
		$this->pdf->Cell(30);
		$this->pdf->SetFont('Arial','B',54);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(188,214,238);
		$this->pdf->Cell(95,5,'','LR',0,'L');
		}
		else if ($data['hasil']['pilihananuitas'] == 'IDEAL (SESUAI UU)')
		{
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(188,214,238);
		$this->pdf->Cell(35,5,'Anuitas Ideal',0,0,'L',true);
		if($data['hasil']['statuskawin'] == 'kawin')
		{
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(188,214,238);
		$this->pdf->Cell(30,5,'Rp. '.number_format($data['hasil']['aikawin'],0,'.',',').'',0,0,'L',true);
		}
		else if($data['hasil']['statuskawin'] == 'bujang')
		{
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(188,214,238);
		$this->pdf->Cell(30,5,'Rp. '.number_format($data['hasil']['aibujang'],0,'.',',').'',0,0,'L',true);
		}
		$this->pdf->Cell(30);
		$this->pdf->SetFont('Arial','B',54);
		$this->pdf->SetTextColor(248,203,173);
		$this->pdf->SetFillColor(219,219,219);
		$this->pdf->Cell(95,5,'','LR',0,'L');
		}
		else if ($data['hasil']['pilihananuitas'] == 'EKSEKUTIF PRIMA')
		{
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(188,214,238);
		$this->pdf->Cell(35,5,'Anuitas Eksekutif Prima',0,0,'L',true);
		if($data['hasil']['statuskawin'] == 'kawin')
		{
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(188,214,238);
		$this->pdf->Cell(30,5,'Rp. '.number_format($data['hasil']['aepkawin'],0,'.',',').'',0,0,'L',true);
		}
		else if($data['hasil']['statuskawin'] == 'bujang')
		{
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(188,214,238);
		$this->pdf->Cell(30,5,'Rp. '.number_format($data['hasil']['aepbujang'],0,'.',',').'',0,0,'L',true);
		}
		$this->pdf->Cell(30);
		$this->pdf->SetFont('Arial','B',54);
		$this->pdf->SetTextColor(248,203,173);
		$this->pdf->SetFillColor(219,219,219);
		$this->pdf->Cell(95,5,'','LR',0,'L');
		}
		
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(35,5,'',0,0,'L',true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(30,5,'',0,0,'L',true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(30,5,'',0,0,'L',true);
		$this->pdf->SetFont('Arial','B',54);
		$this->pdf->SetTextColor(248,203,173);
		$this->pdf->SetFillColor(219,219,219);
		$this->pdf->Cell(95,5,'','LR',0,'L');
		
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(35,5,'',0,0,'L',true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(30,5,'',0,0,'L',true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(30,5,'',0,0,'L',true);
		$this->pdf->SetFont('Arial','B',54);
		$this->pdf->SetTextColor(248,203,173);
		$this->pdf->SetFillColor(219,219,219);
		$this->pdf->Cell(95,5,'','LR',0,'L');
		
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(35,5,'',0,0,'L',true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(30,5,'',0,0,'L',true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(30,5,'',0,0,'L',true);
		$this->pdf->SetFont('Arial','B',54);
		$this->pdf->SetTextColor(248,203,173);
		$this->pdf->SetFillColor(219,219,219);
		$this->pdf->Cell(95,5,'ANUITAS','LR',0,'L');

		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(35,5,'',0,0,'L',true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(30,5,'',0,0,'L',true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(30,5,'',0,0,'L',true);
		$this->pdf->SetFont('Arial','B',54);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(95,5,'','LR',0,'L');

		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(35,5,'',0,0,'L',true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(30,5,'',0,0,'L',true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(30,5,'',0,0,'L',true);
		$this->pdf->SetFont('Arial','B',54);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(95,5,'','LR',0,'L');

		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(35,5,'',0,0,'L',true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(30,5,'',0,0,'L',true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(30,5,'',0,0,'L',true);
		$this->pdf->SetFont('Arial','B',16);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(95,5,'DIVISI TEKNOLOGI INFORMASI','LR',0,'L');

		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(35,5,'',0,0,'L',true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(30,5,'',0,0,'L',true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(30,5,'',0,0,'L',true);
		$this->pdf->SetFont('Arial','B',11);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(219,219,219);
		$this->pdf->Cell(95,5,'KANTOR PUSAT','LR',0,'L');

		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(35,5,'',0,0,'L',true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(30,5,'',0,0,'L',true);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(30,5,'',0,0,'L',true);
		$this->pdf->SetFont('Arial','B',11);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(219,219,219);
		$this->pdf->Cell(95,5,'Jl. Ir H. Juanda No 34','LBR',0,'L');

		$this->pdf->ln(100);

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
		$this->pdf->Cell(190,8,'Program Pensiun',0,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Times','BI',20);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(0,0,0);
		$this->pdf->Cell(190,8,'JS Anuitas Eksekutif Prima (Kawin)',0,0,'C');
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
		$this->pdf->Cell(190,5,'1. Pensiun Hari Tua (PHT)  dibayarkan  secara  bulanan  sampai dengan, usia Tertanggung 70 tahun, dimulai pada bulan berikut ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'setelah premi disetor sebesar Rp. '.number_format($data['hasil']['aepkawin'],0,'.',',').'.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(3,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'2. Pensiun Janda/Duda (PJD)  dibayarkan secara bulanan sampai dengan usia Janda/Duda 70 tahun atau sampai menikah lagi,',0,0,'L');
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
		$this->pdf->Cell(190,8,'Program Pensiun',0,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Times','BI',20);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(0,0,0);
		$this->pdf->Cell(190,8,'JS Anuitas Eksekutif Prima',0,0,'C');
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
		$this->pdf->Cell(190,5,'1. Pensiun Hari Tua (PHT)  dibayarkan  secara  bulanan  sampai dengan, usia Tertanggung 70 tahun, dimulai pada bulan berikut ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'setelah premi disetor sebesar Rp. '.number_format($data['hasil']['aepbujang'],0,'.',',').'.',0,0,'L');
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

		// PAGE 4
		
		if (($data['hasil']['pilihananuitas'] == 'SEJAHTERA PRIMA') && ($data['hasil']['statuskawin'] == 'kawin'))
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
		$this->pdf->Cell(190,8,'Program Pensiun',0,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Times','B',20);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(0,0,0);
		$this->pdf->Cell(190,8,'JS Anuitas Sejahtera Prima',0,0,'C');
		$this->pdf->ln(10);

		// DATA
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(0,32,96);
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
		$this->pdf->SetTextColor(51,102,255);
		$this->pdf->SetFont('Arial','BU',8);
		$this->pdf->Cell(3,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'a. Pensiun Hari Tua',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'Dibayarkan satu bulan sesudah premi disetor sebesar Rp. '.number_format($data['hasil']['aspkawin'],0,'.',',').' setiap bulan.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'Diakhiri jika Tertanggung meninggal dunia.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(51,102,255);
		$this->pdf->SetFont('Arial','BU',8);
		$this->pdf->Cell(3,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'b. Pensiun Janda/Duda',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'Dimulai pada bulan berikutnya setelah Tertanggung meninggal dunia sebesar Rp. '.number_format($data['hasil']['aspkawin']*0.6,0,'.',',').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'Diakhiri jika Janda/Duda meninggal dunia atau menikah lagi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(51,102,255);
		$this->pdf->SetFont('Arial','BU',8);
		$this->pdf->Cell(3,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'c. Pensiun Anak (Anak-anak)',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'Dibayarkan 100% dari pensiun Janda/Duda setiap bulan setelah Janda/Duda meninggal dunia atau menikah lagi atau setelah Tertanggung ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'meninggal dunia dalam hal Istri/Suami telah meninggal lebih dahulu. Diakhiri setelah anak(anak-anak) berusia 25 tahun, sudah bekerja, sudah',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'menikah atau meninggal dunia.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(51,102,255);
		$this->pdf->SetFont('Arial','BU',8);
		$this->pdf->Cell(3,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'d. Pengembalian Premi',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'100% dari Premi sekaligus sebesar Rp. '.number_format($data['hasil']['premisekaligusjsanuitas'],0,'.',',').' dibayarkan jika Tertanggung meninggal dunia.',0,0,'L');
		$this->pdf->ln(75);

		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(64,64,64);
		$this->pdf->Cell(190,5,'Proposal ini merupakan perhitungan pendekatan sebelum kontrak asuransi yang sesungguhnya dilaksanakan','LTR',0,'L',true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(64,64,64);
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
		
		
		if (($data['hasil']['pilihananuitas'] == 'SEJAHTERA PRIMA') && ($data['hasil']['statuskawin'] == 'bujang'))
		{
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
		$this->pdf->Cell(190,8,'Program Pensiun',0,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Times','B',20);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(0,0,0);
		$this->pdf->Cell(190,8,'JS Anuitas Sejahtera Prima',0,0,'C');
		$this->pdf->ln(10);

		// DATA
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(0,32,96);
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
		$this->pdf->SetTextColor(51,102,255);
		$this->pdf->SetFont('Arial','BU',8);
		$this->pdf->Cell(3,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'a. Pensiun Hari Tua',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'Dibayarkan satu bulan sesudah premi disetor sebesar Rp. '.number_format($data['hasil']['aspbujang'],0,'.',',').' setiap bulan.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'Diakhiri jika Tertanggung meninggal dunia.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(51,102,255);
		$this->pdf->SetFont('Arial','BU',8);
		$this->pdf->Cell(3,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'b. Pengembalian Premi',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'100% dari Premi sekaligus sebesar Rp. '.number_format($data['hasil']['premisekaligusjsanuitas'],0,'.',',').' dibayarkan jika Tertanggung meninggal dunia.',0,0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','BU',12);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->SetTextColor(255,0,0);
		$this->pdf->Cell(190,5,'Ilustrasi',0,0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(51,102,255);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(8,5,'',0,0,'C');
		$this->pdf->Cell(58,5,'Mulai Anuitas','',0,'L');
		$this->pdf->Cell(8,5,'',0,0,'C');
		$this->pdf->Cell(58,5,'Tertanggung Meninggal Dunia','L',0,'L');
		$this->pdf->Cell(8,5,'',0,0,'C');
		$this->pdf->Cell(58,5,'','',0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(8,5,'',0,0,'C');
		$this->pdf->Cell(58,5,'(Pembayaran','',0,'L');
		$this->pdf->Cell(8,5,'',0,0,'C');
		$this->pdf->Cell(58,5,'- Pengembalian Premi','L',0,'L');
		$this->pdf->Cell(8,5,'',0,0,'C');
		$this->pdf->Cell(58,5,'','',0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(8,5,'',0,0,'C');
		$this->pdf->Cell(58,5,'Premi)','',0,'L');
		$this->pdf->Cell(8,5,'',0,0,'C');
		$this->pdf->Cell(58,5,'','L',0,'L');
		$this->pdf->Cell(8,5,'',0,0,'C');
		$this->pdf->Cell(58,5,'','',0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,204,204);
		$this->pdf->Cell(8,5,'',0,0,'C');
		$this->pdf->Cell(174,5,'',1,0,'C',true);
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(51,102,255);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(8,5,'',0,0,'C');
		$this->pdf->Cell(174,5,'Pembayaran PHT, dimulai satu bulan sejak premi sekaligus dibayar ke kas perusahaan',0,0,'C',true);
		$this->pdf->ln(65);

		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(64,64,64);
		$this->pdf->Cell(190,5,'Proposal ini merupakan perhitungan pendekatan sebelum kontrak asuransi yang sesungguhnya dilaksanakan','LTR',0,'L',true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(64,64,64);
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
		
		// PAGE 6
		if (($data['hasil']['pilihananuitas'] == 'SEJAHTERA IDEAL') && ($data['hasil']['statuskawin'] == 'kawin'))
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
		$this->pdf->Cell(190,8,'Program Pensiun',0,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Times','B',20);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(0,0,0);
		$this->pdf->Cell(190,8,'JS Anuitas Sejahtera Ideal',0,0,'C');
		$this->pdf->ln(10);

		// DATA
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(0,32,96);
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
		$this->pdf->SetFont('Arial','B',8);
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
		$this->pdf->SetTextColor(51,102,255);
		$this->pdf->SetFont('Arial','BU',8);
		$this->pdf->Cell(3,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'a. Pensiun Hari Tua',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'Dibayarkan satu bulan sesudah premi disetor sebesar Rp. '.number_format($data['hasil']['asikawin'],0,'.',',').' setiap bulan.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'Diakhiri jika Tertanggung meninggal dunia.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(51,102,255);
		$this->pdf->SetFont('Arial','BU',8);
		$this->pdf->Cell(3,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'b. Pensiun Janda/Duda',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'Dimulai pada bulan berikutnya setelah Tertanggung meninggal dunia sebesar Rp. '.number_format($data['hasil']['asikawin']*0.6,0,'.',',').'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'Diakhiri jika Janda/Duda meninggal dunia atau menikah lagi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(51,102,255);
		$this->pdf->SetFont('Arial','BU',8);
		$this->pdf->Cell(3,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'c. Pensiun Anak (Anak-anak)',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'Dibayarkan 100% dari pensiun Janda/Duda setiap bulan setelah Janda/Duda meninggal dunia atau menikah lagi atau setelah Tertanggung ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'meninggal dunia dalam hal Istri/Suami telah meninggal lebih dahulu. Diakhiri setelah anak(anak-anak) berusia 25 tahun, sudah bekerja, sudah',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'menikah atau meninggal dunia.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(51,102,255);
		$this->pdf->SetFont('Arial','BU',8);
		$this->pdf->Cell(3,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'d. Pengembalian Sisa Dana',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'Pembayaran Pengembalian Sisa Dana (Jika ada), selisih antara premi yang dilunasi oleh Pemegang Polis dengan manfaat yang telah',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(19,5,'dibayarkan selama',0,0,'L');
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'hidup penerima PHT.',0,0,'L');
		$this->pdf->ln(65);

		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(64,64,64);
		$this->pdf->Cell(190,5,'Proposal ini merupakan perhitungan pendekatan sebelum kontrak asuransi yang sesungguhnya dilaksanakan','LTR',0,'L',true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(64,64,64);
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
		
		// PAGE 7
		if (($data['hasil']['pilihananuitas'] == 'SEJAHTERA IDEAL') && ($data['hasil']['statuskawin'] == 'bujang'))
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
		$this->pdf->Cell(190,8,'Program Pensiun',0,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Times','B',20);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(0,0,0);
		$this->pdf->Cell(190,8,'JS Anuitas Sejahtera Ideal',0,0,'C');
		$this->pdf->ln(10);

		// DATA
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(0,32,96);
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
		$this->pdf->SetFont('Arial','B',8);
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
		$this->pdf->SetTextColor(51,102,255);
		$this->pdf->SetFont('Arial','BU',8);
		$this->pdf->Cell(3,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'a. Pensiun Hari Tua',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'Dibayarkan satu bulan sesudah premi disetor sebesar Rp. '.number_format($data['hasil']['asibujang'],0,'.',',').' setiap bulan.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'Diakhiri jika Tertanggung meninggal dunia.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(51,102,255);
		$this->pdf->SetFont('Arial','BU',8);
		$this->pdf->Cell(3,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'b. Pengembalian Sisa Dana',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'Pembayaran Pengembalian Sisa Dana (Jika ada), selisih antara premi yang dilunasi oleh Pemegang Polis dengan manfaat yang telah',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(19,5,'dibayarkan selama',0,0,'L');
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'hidup penerima PHT.',0,0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','BU',12);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->SetTextColor(255,0,0);
		$this->pdf->Cell(190,5,'Ilustrasi',0,0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(51,102,255);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(8,5,'',0,0,'C');
		$this->pdf->Cell(58,5,'Mulai Anuitas','',0,'L');
		$this->pdf->Cell(8,5,'',0,0,'C');
		$this->pdf->Cell(58,5,'Tertanggung Meninggal Dunia','L',0,'L');
		$this->pdf->Cell(8,5,'',0,0,'C');
		$this->pdf->Cell(58,5,'','',0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(8,5,'',0,0,'C');
		$this->pdf->Cell(58,5,'(Pembayaran','',0,'L');
		$this->pdf->Cell(8,5,'',0,0,'C');
		$this->pdf->Cell(58,5,'- Pengembalian Premi','L',0,'L');
		$this->pdf->Cell(8,5,'',0,0,'C');
		$this->pdf->Cell(58,5,'','',0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(8,5,'',0,0,'C');
		$this->pdf->Cell(58,5,'Premi)','',0,'L');
		$this->pdf->Cell(8,5,'',0,0,'C');
		$this->pdf->Cell(58,5,'','L',0,'L');
		$this->pdf->Cell(8,5,'',0,0,'C');
		$this->pdf->Cell(58,5,'','',0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(51,204,204);
		$this->pdf->Cell(8,5,'',0,0,'C');
		$this->pdf->Cell(174,5,'',1,0,'C',true);
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(51,102,255);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Cell(8,5,'',0,0,'C');
		$this->pdf->Cell(174,5,'Pembayaran PHT, dimulai satu bulan sejak premi sekaligus dibayar ke kas perusahaan',0,0,'C',true);
		$this->pdf->ln(60);

		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(64,64,64);
		$this->pdf->Cell(190,5,'Proposal ini merupakan perhitungan pendekatan sebelum kontrak asuransi yang sesungguhnya dilaksanakan','LTR',0,'L',true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(64,64,64);
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

		// PAGE 8
		if (($data['hasil']['statuskawin'] == 'kawin'))
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
		$this->pdf->Cell(190,8,'Program Pensiun',0,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Times','B',20);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(0,0,0);
		$this->pdf->Cell(190,8,'JS ANUITAS',0,0,'C');
		$this->pdf->ln(10);

		// DATA
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(0,32,96);
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
		$this->pdf->SetFont('Arial','BU',12);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->SetTextColor(255,0,0);
		$this->pdf->Cell(190,5,'MANFAAT YANG DIPEROLEH:',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(3,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'1. Pensiun Hari Tua (PHT) dibayarkan secara bulanan, dimulai satu bulan berikutnya  setelah premi lunas sampai dengan Tertanggung meninggal ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'dunia, sebesar: Rp. '.number_format($data['hasil']['aikawin'],0,'.',',').'.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(3,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'2. Pensiun Janda/Duda (PJD) dibayarkan secara bulanan setelah penerima PHT meninggal dunia sampai dengan Janda/Duda meninggal dunia',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'atau menikah lagi sebesar Rp. '.number_format($data['hasil']['aikawin']*0.6,0,'.',',').'.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(3,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'3. Pensiun Yatim (PYT) atau menikah lagi dibayarkan secara bulanan setelah penerima PJD meninggal dunia, diakhiri ketika Yatim berusia',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'25 tahun dan/atau sudah menikah dan/atau sudah bekerja dan/atau meninggal dunia, sebesar Rp. '.number_format($data['hasil']['aikawin']*0.6,0,'.',',').'.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(3,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'4. Pengembalian sisa dana (jika ada) kepada AhliWaris yang sah secara hukum pada saat penerima PHT, PJD telah Meninggal Dunia dan Penerima',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'PYT berusia 25 tahun atau sudah menikah atau sudah bekerja atau Meninggal Dunia.',0,0,'L');
		$this->pdf->ln();
//		$this->pdf->SetTextColor(0,0,0);
//		$this->pdf->SetFont('Arial','',8);
//		$this->pdf->Cell(6,5,'',0,0,'L');
//		$this->pdf->Cell(190,5,'Contoh:',0,0,'L');	
//		$this->pdf->ln();
//		$this->pdf->SetTextColor(0,0,0);
//		$this->pdf->SetFont('Arial','',8);
//		$this->pdf->Cell(6,5,'',0,0,'L');
//		$this->pdf->Cell(190,5,'Jika Tertanggung Meninggal di tahun ke-4 setelah masa asuransi, penerima PJD Meninggal/Menikah di tahun ke 7 setelah mulai asuransi',0,0,'L');
//		$this->pdf->ln();
//		$this->pdf->SetTextColor(0,0,0);
//		$this->pdf->SetFont('Arial','',8);
//		$this->pdf->Cell(6,5,'',0,0,'L');
//		$this->pdf->Cell(190,5,'dan Pembayaran PYT berakhir pada tahun ke 10 setelah mulai asuransi maka pengembalian sisa dananya sebesar Rp. '.number_format($data['hasil']['pengembaliansisadanakawin'],0,'.',',').'.',0,0,'L');
		

		$this->pdf->Image($imageai, 23, 155, -195);
			
		$this->pdf->ln(90);
		
		/*
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(64,64,64);
		$this->pdf->Cell(190,5,'Proposal ini merupakan perhitungan pendekatan sebelum kontrak asuransi yang sesungguhnya dilaksanakan','LTR',0,'L',true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(64,64,64);
		$this->pdf->Cell(190,5,'dan bukan merupakan bagian dari kontrak asuransi.','LBR',0,'L',true);
		$this->pdf->ln();
		*/

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

		// PAGE 9
		if (($data['hasil']['statuskawin'] == 'bujang'))
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
		$this->pdf->Cell(190,8,'Program Pensiun',0,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Times','B',20);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(0,0,0);
		$this->pdf->Cell(190,8,'JS ANUITAS',0,0,'C');
		$this->pdf->ln(10);

		// DATA
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(0,32,96);
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
		$this->pdf->SetFont('Arial','BU',12);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->SetTextColor(255,0,0);
		$this->pdf->Cell(190,5,'MANFAAT YANG DIPEROLEH:',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(3,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'1. Pensiun Hari Tua (PHT) dibayarkan secara bulanan, dimulai satu bulan berikutnya setelah premi lunas sampai dengan Tertanggung meninggal ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(6,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'dunia, sebesar: Rp. '.number_format($data['hasil']['aikawin'],0,'.',',').'.',0,0,'L');	
		$this->pdf->ln();
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(3,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'2. Pengembalian sisa dana (jika ada) kepada Ahli Waris pada saat penerima PHT Meninggal Dunia.',0,0,'L');
		$this->pdf->ln();
//		$this->pdf->SetTextColor(0,0,0);
//		$this->pdf->SetFont('Arial','',8);
//		$this->pdf->Cell(6,5,'',0,0,'L');
//		$this->pdf->Cell(190,5,'Contoh:',0,0,'L');
//		$this->pdf->ln();
//		$this->pdf->SetTextColor(0,0,0);
//		$this->pdf->SetFont('Arial','',8);
//		$this->pdf->Cell(6,5,'',0,0,'L');
//		$this->pdf->Cell(190,5,'Jika Tertanggung Meninggal di tahun ke-10 setelah masa asuransi maka pengembalian sisa dananya sebesar Rp. '.number_format($data['hasil']['pengembaliansisadanabujang'],0,'.',',').'.',0,0,'L');
			
		$this->pdf->Image($imageai2, 12, 140, -175);
			
		$this->pdf->ln(120);
			
		/*
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(64,64,64);
		$this->pdf->Cell(190,5,'Proposal ini merupakan perhitungan pendekatan sebelum kontrak asuransi yang sesungguhnya dilaksanakan','LTR',0,'L',true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(64,64,64);
		$this->pdf->Cell(190,5,'dan bukan merupakan bagian dari kontrak asuransi.','LBR',0,'L',true);
		$this->pdf->ln();
		*/

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
		$this->pdf->Cell(95,5,'Saya mengerti proposal ini bukan merupakan kontrak asuransi dan manfaat selengkapnya tertera di Polis',0,0,'L');
		$this->pdf->ln(80);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(190,5,'Produk JS Anuitas merupakan produk Asuransi Jiwa seumur hidup dan saya bersedia untuk tidak melakukan penebusan nilai Polis sampai dengan masa Asuransi JS Anuitas berakhir',1,0,'C');
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
		
		
	    $this->pdf->Output('./files/pdf/'.$namaFile.'.pdf','F');
	  
	}	

}	