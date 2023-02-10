<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendapatan extends CI_Controller {

    function __construct() {
        parent::__construct();

        check_session_user();
        check_kuesioner();
        $this->url = base_url('pendapatan');
        $this->load->model('Monitorproposal_model');
    }

	 /*===== View Komisi lpa =====*/
	function pendapatan_agen_lpa (){
		$kdjabatanagen = $this->session->KDJABATANAGEN;
		if($kdjabatanagen != '29') {
			show_error('error_401');
		} else {
		$username = $this->session->USERNAME;
		$tglawal = $this->input->get('txtTglAwal');
        $tglakhir = $this->input->get('txtTglAkhir');
		
		if(($tglawal == null || $tglawal == '') && ($tglakhir == null || $tglakhir == '')) {
		$tanggal = '';
		} else {
		$tanggal = "and a.tglproses between to_date('$tglawal','dd-mm-yyyy') and to_date('$tglakhir','dd-mm-yyyy')";
		}
		
		$data['pendapatan'] = json_decode(file_get_contents(C_URL_API_JAIM."/pendapatan.php?r=6&p=".rawurlencode($username)."&p1=".rawurlencode($tanggal)),true);
		
		$this->template->title = 'Daftar Slip Gaji LPA';
        $this->template->content->view("pendapatan/tabel_pendapatan_lpa", $data);
        $this->template->publish();
		}
	}
	

	 /*===== Slip gaji lpa =====*/
	function slip_gaji_lpa($kdkomisi,$tglproses){
		$kdjabatanagen = $this->session->KDJABATANAGEN;
		if($kdjabatanagen != '29') {
			show_error('error_401');
		} else {
		$username = $this->session->USERNAME;
		$data['pendapatan'] = json_decode(file_get_contents(C_URL_API_JAIM."/pendapatan.php?r=5&p=".rawurlencode($kdkomisi)."&p1=".rawurlencode($tglproses)."&p2=".rawurlencode($username)),true);
		
		$data['tgl'] = $tglproses;
		$data['kdkomisi'] = $kdkomisi;
		
		//var_dump($data['tgl']);die;
		$this->template->title = 'Slip Gaji LPA';
        $this->template->content->view("pendapatan/agen_lpa", $data);
        $this->template->publish();
		}
	}


    /*===== pendapatan per wilayah =====*/
    function se_wilayah() {
        check_user_role_menu(C_MENU_PENDAPATAN_AGEN_SE_WILAYAH);

        $kdkntrinduk = $this->session->USERNAME;
        $kantor = $this->input->get('txtCabang');
        $tglawal = $this->input->get('txtTglAwal');
        $tglakhir = $this->input->get('txtTglAkhir');
        $data['cabang'] = json_decode(file_get_contents(C_URL_API_JAIM."/evaluasi.php?r=3&p=$kdkntrinduk"), true);
        $data['pendapatan'] = json_decode(file_get_contents(C_URL_API_JAIM."/pendapatan.php?r=3&p=".rawurlencode($kantor)."&p1=".rawurlencode($tglawal)."&p2=".rawurlencode($tglakhir)), true);

        $this->template->title = 'Pendapatan Se-Wilayah';
        $this->template->content->view("pendapatan/se_wilayah", $data);
        $this->template->publish();
    }


    /*===== pendapatan per wilayah by agen =====*/
    function agen_se_wilayah() {
        check_user_role_menu(C_MENU_PENDAPATAN_AGEN_SE_WILAYAH);

        $kantor = $this->input->get('txtCabang');
        $noagen = $this->input->get('id');
        $tglawal = $this->input->get('txtTglAwal');
        $tglakhir = $this->input->get('txtTglAkhir');

        $data['pendapatan'] = json_decode(file_get_contents(C_URL_API_JAIM."/pendapatan.php?r=1&p=".rawurlencode($kantor)."&p2=".rawurlencode($noagen)."&p3=".rawurlencode($tglawal)."&p4=".rawurlencode($tglakhir)), true);

        $this->template->title = "No Agen: $noagen";
        $this->template->content->view("pendapatan/agen_se_wilayah", $data);
        $this->template->publish();
    }


    /*===== pendapatan per cabang =====*/
    function se_cabang() {
        check_user_role_menu(C_MENU_PENDAPATAN_AGEN_SE_CABANG);

        $kantor = $this->session->USERNAME;
        $tglawal = $this->input->get('txtTglAwal');
        $tglakhir = $this->input->get('txtTglAkhir');

        $data['pendapatan'] = json_decode(file_get_contents(C_URL_API_JAIM."/pendapatan.php?r=2&p=".rawurlencode($kantor)."&p1=".rawurlencode($tglawal)."&p2=".rawurlencode($tglakhir)), true);

        $this->template->title = 'Pendapatan Se-Cabang';
        $this->template->content->view("pendapatan/se_cabang", $data);
        $this->template->publish();
    }


    /*===== pendapatan per cabang by agen =====*/
    function agen_se_cabang() {
        check_user_role_menu(C_MENU_PENDAPATAN_AGEN_SE_CABANG);

        $kantor = $this->session->USERNAME;
        $noagen = $this->input->get('id');
        $tglawal = $this->input->get('txtTglAwal');
        $tglakhir = $this->input->get('txtTglAkhir');

        $data['pendapatan'] = json_decode(file_get_contents(C_URL_API_JAIM."/pendapatan.php?r=1&p=".rawurlencode($kantor)."&p2=".rawurlencode($noagen)."&p3=".rawurlencode($tglawal)."&p4=".rawurlencode($tglakhir)), true);

        $this->template->title = "No Agen: $noagen";
        $this->template->content->view("pendapatan/agen_se_cabang", $data);
        $this->template->publish();
    }


    /*===== pendapatan per agen =====*/
     function agen() {
         check_user_role_menu(C_MENU_PENDAPATAN_AGEN);

         $kao = $this->session->KDAREAOFFICE;
         $kup = $this->session->KDUNITPRODUKSI;
         $jabatan = $this->session->KDJABATANAGEN;
         // $kantor = $this->session->KDKANTOR;
         $kantor = $this->input->get('kantor');
         
        //  if(!isset($kantor)){
        // 	$kantor = $this->session->KDKANTOR;
        //  } 
        
         # end created ismi
         $noagen = $this->session->USERNAME;
         $tglawal = $this->input->get('txtTglAwal');
         $tglakhir = $this->input->get('txtTglAkhir');

         # created ismi
         if ($this->session->KDROLE == 5 || $this->session->KDROLE == 6) {
			$noagenbp = $this->input->get('noagenbp');
			$data['daftarkantor'] = $this->Monitorproposal_model->get_kantor();
   
            $data['kdkantor'] = $kantor;
			$data['noagenbp'] = $noagenbp;
			$data['agenbp'] = $this->Monitorproposal_model->get_agen_bp();

            $data['pendapatan'] = json_decode(file_get_contents(C_URL_API_JAIM."/pendapatan_new2020.php?r=4&p=".rawurlencode($kantor)."&p2=".rawurlencode($tglawal)."&p3=".rawurlencode($tglakhir)."&p4=".rawurlencode($noagenbp)."&p5=".rawurlencode($kao)."&p6=".rawurlencode($kup)."&p7=".rawurlencode($noagenbp)), true);
            
        } else {
         # end created ismi
         // if ($jabatan == '02' || $jabatan == '05' || $jabatan == '06' || $jabatan == '19') { 
         //    $data['pendapatan'] = json_decode(file_get_contents(C_URL_API_JAIM."/pendapatan.php?r=4&p=".rawurlencode($kantor)."&p2=".rawurlencode($tglawal)."&p3=".rawurlencode($tglakhir)."&p4=".rawurlencode($noagen)."&p5=".rawurlencode($kao)."&p6=".rawurlencode($kup)), true);
         // }
         // else {
         //     $data['pendapatan'] = json_decode(file_get_contents(C_URL_API_JAIM."/pendapatan.php?r=4&p=".rawurlencode($kantor)."&p2=".rawurlencode($tglawal)."&p3=".rawurlencode($tglakhir)."&p4=".rawurlencode($noagen)."&p5=".rawurlencode($kao)."&p6=".rawurlencode($kup)."&p7=".rawurlencode($noagen)), true);
         // }
         $data['daftarkantor'] = json_decode(file_get_contents(C_URL_API_JAIM."/coverage_sam.php?p=".rawurlencode($noagen)), true);
         
         $data['pendapatan'] = json_decode(file_get_contents(C_URL_API_JAIM."/pendapatan_new2020.php?r=4&p=".rawurlencode($kantor)."&p2=".rawurlencode($tglawal)."&p3=".rawurlencode($tglakhir)."&p4=".rawurlencode($noagen)."&p5=".rawurlencode($kao)."&p6=".rawurlencode($kup)."&p7=".rawurlencode($noagen)), true);
        }

		 // echo file_get_contents(C_URL_API_JAIM."/pendapatan_new2020.php?r=4&p=".rawurlencode($kantor)."&p2=".rawurlencode($tglawal)."&p3=".rawurlencode($tglakhir)."&p4=".rawurlencode($noagen)."&p5=".rawurlencode($kao)."&p6=".rawurlencode($kup)."&p7=".rawurlencode($noagen));
         $this->template->title = 'Pendapatan Agen';
         $this->template->content->view("pendapatan/agen", $data);
         $this->template->publish();
     }
	 
	 /*nampilin data produksi lpa*/
	 function agen_lpa() {
         //check_user_role_menu(C_MENU_PENDAPATAN_AGEN_LPA);
		 $kdjabatanagen = $this->session->KDJABATANAGEN;
		if($kdjabatanagen != '29') {
					show_error('error_401');
		} else {
         $kao = $this->session->KDAREAOFFICE;
         $kup = $this->session->KDUNITPRODUKSI;
         $jabatan = $this->session->KDJABATANAGEN;
         // $kantor = $this->session->KDKANTOR;
         $kantor = $this->input->get('kantor');
         if(!isset($kantor)){
        	$kantor = $this->session->KDKANTOR;
         } 
         $noagen = $this->session->USERNAME;
         $tglawal = $this->input->get('txtTglAwal');
         $tglakhir = $this->input->get('txtTglAkhir');

         $data['daftarkantor'] = json_decode(file_get_contents(C_URL_API_JAIM."/coverage_sam.php?p=".rawurlencode($noagen)), true);

         $data['pendapatan'] = json_decode(file_get_contents(C_URL_API_JAIM."/pendapatan_lpa.php?r=4&p=".rawurlencode($kantor)."&p2=".rawurlencode($tglawal)."&p3=".rawurlencode($tglakhir)."&p7=".rawurlencode($noagen)), true);
		 //var_dump($data['pendapatan']);die;
         $this->template->title = 'Pendapatan Agen LPA';
         $this->template->content->view("pendapatan/pendapatan_lpa", $data);
         $this->template->publish();
		}
     }
}