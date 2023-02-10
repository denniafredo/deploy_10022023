<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluasi extends CI_Controller {
	
	function __construct() {
        parent::__construct();

        check_session_user();
        check_kuesioner();
		$this->url = base_url('evaluasi');
		$this->load->model('Maarpr_model');
		$this->load->model('Monitorproposal_model');
    }
	
	
	/*===== evaluasi per wilayah =====*/
	function wilayah() {
		check_user_role_menu(C_MENU_EVALUASI_WILAYAH);

		$tglawal = $this->input->get('txtTglAwal');
		$tglakhir = $this->input->get('txtTglAkhir');
		$kdkantor = $this->input->get('txtCabang');
		$kdkntrinduk = $this->session->USERNAME;
		$data['cabang'] = json_decode(file_get_contents(C_URL_API_JAIM."/evaluasi.php?r=3&p=$kdkntrinduk"), true);
		$data['kantor'] = json_decode(file_get_contents(C_URL_API_JAIM."/evaluasi.php?r=5&p=$tglawal&p2=$tglakhir&p3=$kdkantor"), true);
		$data['evaluasi'] = json_decode(file_get_contents(C_URL_API_JAIM."/evaluasi.php?r=2&p=$tglawal&p2=$tglakhir&p3=$kdkantor"), true);

		$this->template->title = 'Evaluasi Wilayah';
		$this->template->content->view("evaluasi/wilayah", $data);
        $this->template->publish();
	}

	
	/*===== evaluasi per cabang =====*/
	function cabang() {
		check_user_role_menu(C_MENU_EVALUASI_CABANG);
		
		$tglawal = $this->input->get('txtTglAwal');
		$tglakhir = $this->input->get('txtTglAkhir');
		$kdkantor = $this->session->USERNAME;
		$data['kantor'] = json_decode(file_get_contents(C_URL_API_JAIM."/evaluasi.php?r=5&p=$tglawal&p2=$tglakhir&p3=$kdkantor"), true);
		$data['evaluasi'] = json_decode(file_get_contents(C_URL_API_JAIM."/evaluasi.php?r=2&p=$tglawal&p2=$tglakhir&p3=$kdkantor"), true);

		$this->template->title = 'Evaluasi Cabang';
		$this->template->content->view("evaluasi/cabang", $data);
        $this->template->publish();
	}


	/*===== evaluasi per agen =====*/
	function agen() {
        check_user_role_menu(C_MENU_EVALUASI_AGEN);

        $kao = $this->session->KDAREAOFFICE;
        $kup = $this->session->KDUNITPRODUKSI;
        $jabatan = $this->session->KDJABATANAGEN;
        $tglawal = '01/01/'.date('Y');
        $tglakhir = date('d/m/Y');
        $kdkantor = $this->input->get('kantor');
        if(!isset($kdkantor)){
        	$kdkantor = $this->session->KDKANTOR;
        } 

        $noagen = $this->session->USERNAME;

        $data['daftarkantor'] = json_decode(file_get_contents(C_URL_API_JAIM."/coverage_sam.php?p=".rawurlencode($noagen)), true);

    	$data['evaluasi'] = json_decode(file_get_contents(C_URL_API_JAIM."/evaluasi_new2019.php?r=4&p=".rawurlencode($tglawal)."&p2=".rawurlencode($tglakhir)."&p3=".rawurlencode($kdkantor)."&p4=".rawurlencode($kao)."&p5=".rawurlencode($kup)."&p6=".rawurlencode($noagen)), true);
    	//print_r( $data['evaluasi']);
		// echo file_get_contents(C_URL_API_JAIM."/evaluasi_new2019.php?r=4&p=".rawurlencode($tglawal)."&p2=".rawurlencode($tglakhir)."&p3=".rawurlencode($kdkantor)."&p4=".rawurlencode($kao)."&p5=".rawurlencode($kup)."&p6=".rawurlencode($noagen));
		$this->template->title = 'Evaluasi Agen';
		$this->template->content->view("evaluasi/agen", $data);
		$this->template->publish();
		
	}


	/*===== download rekap prospek se kantor jiwasraya (kapus) =====*/
	function download_evaluasi_se_kapus() {
		check_user_role_menu(C_MENU_DOWNLOAD_EVALUASI_AGEN_SE_KAPUS);

		$data['cabang'] = json_decode(file_get_contents(C_URL_API_JAIM."/master.php?r=4"), true);

		$this->template->title = 'Download Rekap Evaluasi';
		$this->template->content->view("evaluasi/download_evaluasi_se_kapus", $data);
		$this->template->publish();
	}


	/*===== download rekap evaluasi se kapus format excel =====*/
	function download_evaluasi_se_kapus_excel() {
		check_user_role_menu(C_MENU_DOWNLOAD_EVALUASI_AGEN_SE_KAPUS);

		$kdkantor = $this->input->get('ktr');
		$tglawal = $this->input->get('txtTglAwal');
		$tglakhir = $this->input->get('txtTglAkhir');
		$data['rekap'] = json_decode(file_get_contents(C_URL_API_JAIM."/evaluasi.php?r=6&p=".rawurlencode($kdkantor)."&p2=".rawurlencode($tglawal)."&p3=".rawurlencode($tglakhir)), true);

		$this->load->view('evaluasi/download_evaluasi_excel', $data);
	}

	/*===== Dashboard perhitungan MAAR MAAPR pencapaian agen =====*/

	function maar_maapr() {
        check_user_role_menu(C_MENU_EVALUASI_AGEN);
        $data['kdkantor'] = $this->session->KDKANTOR;
        $data['listagen'] = $this->Maarpr_model->get_struktur_agen($data['kdkantor']);

        $param['TAHUN'] = date('Y');
        $b = date('m');
        if($b < 10){
        	$b = '0'.$b;
        }
        $param['BULAN'] = $b;
        $param['KANTOR'] = $data['kdkantor'];

        $i=0;
        $data['CMA'] = array();
        $data['MA'] = array();
        $data['AM']= array();
        $data['UM'] = array();

        foreach($data['listagen'] as $agn){
        	if($agn['KDJABATANAGEN'] == '09'){
        		array_push($data['CMA'],$agn['NOAGEN']); 
        	}else if($agn['KDJABATANAGEN'] == '00'){
        		array_push($data['MA'],$agn['NOAGEN']); 
        	}
        	else if($agn['KDJABATANAGEN'] == '02'){
        		array_push($data['AM'],$agn['NOAGEN']); 
        	}else if($agn['KDJABATANAGEN'] == '05'){
        		array_push($data['UM'],$agn['NOAGEN']); 
        	}
        	
        	$param['NOAGEN'] = $agn['NOAGEN'];
        	$hasilHitung = $this->Maarpr_model->get_maarmaapr_agen($param);

        	$data['dataDisplay'][$i]['NOAGEN'] = $agn['NOAGEN'];
        	$data['dataDisplay'][$i]['JABATANAGEN'] = $agn['NAMAJABATANAGEN'];
        	$data['dataDisplay'][$i]['NAMAAGEN'] = $agn['NAMAAGEN'];
        	$data['dataDisplay'][$i]['ATASAN'] = $agn['ATASAN'];
        	$data['dataDisplay'][$i]['FOTO'] = $agn['FOTOAGEN'];
        	$data['dataDisplay'][$i]['MAAR'] = $hasilHitung->MAAR;
        	$data['dataDisplay'][$i]['MAAPR'] = $hasilHitung->MAAPR;
        	$i++;
        }
        
		$this->template->title = 'Perhitungan MAAR-MAAPR Agen';
		$this->template->content->view("evaluasi/maar_maapr", $data);
		$this->template->publish();
	}

	function detail_maarMaapr(){
		$inp = $this->input->post();
		
		$nomoragen = $inp['noagen'];
		
		$param['NOAGEN'] = $nomoragen;
        $param['TAHUN'] = date('Y');
        $param['KANTOR'] = $this->session->KDKANTOR;

		for($bln = 1; $bln<= 12; $bln++){
			$bulan = $bln;
			if ($bln < 10){
				$bulan='0'.$bulan;
			}
			$param['BULAN'] = $bulan;
			$hasilHitung = $this->Maarpr_model->get_maarmaapr_agen($param);
			$data["maar"][$bln] =  $hasilHitung->MAAR;
			$data["maapr"][$bln] =  $hasilHitung->MAAPR;
			$hasilPribadi = $this->Maarpr_model->realisasiPribadi($param);
			$data["pribadi"][$bln] =  $hasilPribadi;
			$hasilOrganisasi = $this->Maarpr_model->realisasiOrganisasi($param);
			$data["organisasi"][$bln] =  $hasilOrganisasi;
		}

		header('Content-Type: application/json');
		echo json_encode($data);
	}

	function monitor_proposal(){
		//check_user_role_menu(C_MENU_EVALUASI_AGEN);

        $tglawal = $this->input->get('txtTglAwal');
        $tglakhir = $this->input->get('txtTglAkhir');
        $jabatan = $this->input->get('jabatan');
        $kdkantor = $this->input->get('kantor');
		
        if(!isset($kdkantor) or $kdkantor == ''){
        	//$kdkantor = $this->session->KDKANTOR;
        	$kdkantor = "all";
        } 
        if(!isset($tglawal) or $tglawal == ''){
        	$tglawal = '01/01/'.date('Y');
        } 
        if(!isset($tglakhir) or $tglakhir == ''){
        	$tglakhir = date('d/m/Y');
        } 
        $jbt =  array();
        if(!isset($jabatan) or $jabatan == ''){
        	array_push($jbt,'24','25','26','27');
        }else{
        	array_push($jbt,$jabatan);
        }
		$noagen = $this->session->USERNAME;
      

		if ($this->session->KDROLE == 5 || $this->session->KDROLE == 6 ) {
			$noagenbp = $this->input->get('noagenbp');
			$data['daftarkantor'] = $this->Monitorproposal_model->get_kantor();
			$data['listAgen'] = json_decode(file_get_contents(C_URL_API_JAIM."/hirarki_agen.php?r=6&p=".rawurlencode($tglawal)."&p2=".rawurlencode($jabatan)."&p3=".rawurlencode($kdkantor)."&p6=".rawurlencode($noagenbp)), true);
			
			$data['noagenbp'] = $noagenbp;
			$data['agenbp'] = $this->Monitorproposal_model->get_agen_bp();

		} else if($this->session->KDJABATANAGEN == '29'){
			$data['listAgen'] = json_decode(file_get_contents(C_URL_API_JAIM."/hirarki_agen.php?r=5&p=".rawurlencode($tglawal)."&p2=".rawurlencode($jabatan)."&p3=".rawurlencode($kdkantor)."&p6=".rawurlencode($noagen)), true);
		
		} else {
			$data['daftarkantor'] = json_decode(file_get_contents(C_URL_API_JAIM."/coverage_sam.php?p=".rawurlencode($noagen)), true);
			$data['listAgen'] = json_decode(file_get_contents(C_URL_API_JAIM."/hirarki_agen.php?r=4&p=".rawurlencode($tglawal)."&p2=".rawurlencode($jabatan)."&p3=".rawurlencode($kdkantor)."&p6=".rawurlencode($noagen)), true);
		}
		
		$data['kdkantor'] = $kdkantor;
        $data['jbt'] = $jabatan;
       
        $data['hasilrekap'] = array();
		if ($this->session->KDJABATANAGEN == '29') {
			foreach ($data['listAgen'] as $key => $value) {
				$rekapindividu= $this->Monitorproposal_model->get_rekap_lpa($value,$tglawal,$tglakhir,$jabatan);
				
				array_push($data['hasilrekap'], $rekapindividu);
			}
		} else {
			foreach ($data['listAgen'] as $key => $value) {
				 if (in_array($value["KDJABATANAGEN"], $jbt)){
					$kantorfilter = $value["KDKANTOR"];
					if($value["KDJABATANAGEN"] == '26'){
						$kantorfilter = $kdkantor;
					}
					$rekapindividu= $this->Monitorproposal_model->get_rekap($value,$tglawal,$tglakhir,$jabatan,$kantorfilter);
					
					array_push($data['hasilrekap'], $rekapindividu);
				 }
			}
		}
        $data['tglawal'] = str_replace('/', '', $tglawal);
        $data['tglakhir'] = str_replace('/', '', $tglakhir);
    	//print_r($data['hasilrekap']);
        //echo file_get_contents(C_URL_API_JAIM."/hirarki_agen.php?r=4&p=".rawurlencode($tglawal)."&p2=".rawurlencode($tglakhir)."&p3=".rawurlencode($kdkantor)."&p6=".rawurlencode($noagen));
		$this->template->title = 'Production Tracking';
		$this->template->content->view("evaluasi/monitor_proposal", $data);
		$this->template->publish();
	}
	
	function detail_rekap(){
		$data['noagen'] = $this->input->get('noagen');
		$data['tglawal'] = $this->input->get('tgawal');
		$data['tglakhir'] = $this->input->get('tgakhir');
		$data['kdkantor'] = $this->input->get('kantor');
		$data['kddetail'] = $this->input->get('kddetail');
		if($data['kddetail'] == 1){
			$data['detailpenawaran']= $this->Monitorproposal_model->get_detail_penawaran($data);
		}else if($data['kddetail'] == 2){
			$data['detailspaj']= $this->Monitorproposal_model->get_detail_spaj($data);
		}else if($data['kddetail'] == 3){
            $data['detailgap1']= $this->Monitorproposal_model->get_detail_gap_approval_proposal($data);
        }
        else if($data['kddetail'] == 4){
            $data['detailapproval']= $this->Monitorproposal_model->get_detail_approval($data);
        }else if($data['kddetail'] == 5){
            $data['detailpelunasan']= $this->Monitorproposal_model->get_detail_pelunasan($data);
        }
        else if($data['kddetail'] == 6){
            $data['detailterkirim']= $this->Monitorproposal_model->get_detail_terkirim($data);
        }
        else if($data['kddetail'] == 7){
            $data['detailproposal']= $this->Monitorproposal_model->get_detail_proposal($data);
        }
		$this->template->title = 'Detail Rekap';
		$this->template->content->view("evaluasi/detail_monitor_proposal", $data);
		$this->template->publish();
	}
}
