<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pkajonline extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('prospek_model');
        $this->load->model('master_model');
        $this->load->model('Pkaj_model');

        check_session_user();
        check_kuesioner();
        $this->url = base_url('pkajonline');
    }


    /*===== daftar pkaj online =====*/
    function list_pkajonline() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA); 

        $filter['s'] = strtolower(trim($this->input->get('s')));
        $filter['p'] = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $filter['NOAGEN'] = $this->session->USERNAME;
        $data['pkaj'] = $this->Pkaj_model->get_list_pkajonline($filter);

        // print_r($filter['NOAGEN']);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/list-pkajonline";
        $config['total_rows'] = $this->Pkaj_model->get_total_pkajonline($filter['NOAGEN']);
        $this->pagination->initialize($config);

        $data['status'] = $this->session->flashdata('status');

        // print_r($data);

        $this->template->title = 'Pkajonline';
        $this->template->content->view("pkajonline/list_pkajonline", $data);
        $this->template->publish();
    }


    /*===== term and condition pkaj online =====*/
    function term_pkajonline() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $filter['NOAGEN']=$this->input->get('noagen');
        $filter['TGLPKAJAGEN']=$this->input->get('tglpkaj');

        $datas = $this->Pkaj_model->data_pkajonline($filter);
        $this->Pkaj_model->insert_history_sign('Document viewed', $this->input->get('name'), $this->input->get('noagen'), $this->input->get('nopkaj'), 'PDF', 'TESTING');
        foreach($datas as $i => $d) { 
            $nopkaj = $d['NOPKAJAGEN'];
            $kdkantor = $d['KDKANTOR'];
            $noagenbm = $d['NOAGENBM'];
            $namabm = $d['NAMABM'];
            $noagen = $d['NOAGEN'];
            $jabatanbm = $d['JABATANBM'];
            $nipbm = $d['NIPBM'];
            $alamatktr = $d['ALAMATKTR'];
            $telponktr = $d['TELPONKTR'];
            $faxktr = $d['FAXKTR'];  
            $noidagen = $d['NOMORIDAGEN'];
            $alamatagen = $d['ALAMATAGEN'];
            $notelponagen = $d['NOTELPONAGEN'];
            $namaklien = $d['NAMAKLIEN1'];
            $tgl = $d['TGL'];
            $bln = $d['BLN'];
            $thn = $d['THN'];
            $tmptlhr = $d['TEMPATLAHIR'];
            $tgllhr = $d['TGLLAHIR'];    
            $jnskel = $d['JENISKELAMIN'];
            $tglpkaj = $d['TGLPKAJAGEN'];        
        }

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

        $hari = array(
            'Monday'=>'Senin',
            'Tuesday'=>'Selasa',
            'Wednesday'=>'Rabu',
            'Thursday'=>'Kamis',
            'Friday'=>'Jumat',
            'Saturday'=>'Sabtu',
            'Sunday'=>'Minggu'
        );

        $x = mktime(0, 0, 0, $bln, $tgl, $thn);

        $data['TANGGAL'] = date("d", $x);
        $data['BULAN'] = $bulan[date("n", $x)];
        $data['TAHUN'] = date("Y", $x);
        $data['HARI'] = $hari[date("l", $x)];
        

        $filter['s'] = strtolower(trim($this->input->get('s')));
        $filter['p'] = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $filter['noagen'] = $this->session->USERNAME;
        $data['pkaj'] = $this->Pkaj_model->data_pkajonline($filter);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/preview_pkajonline";
        $config['total_rows'] = $this->Pkaj_model->get_total_pkajonline($filter['noagen']);
        $this->pagination->initialize($config);

        $data['status'] = $this->session->flashdata('status');


        $this->load->model('master_model');

        $data['noagen'] = $this->input->get('noagen');
        $data['nopkaj'] = $this->input->get('nopkaj');
        $data['urlback'] = "pkajonline";

        $datas = $this->Pkaj_model->cek_pkajonline($data['noagen'], $data['nopkaj']);
        foreach($datas as $i => $v) {
            //Cek apakah agen merupakan agen PK Dedi 29092014
            if(in_array($v["KDJABATANAGEN"], array("00","10","11","12","13"))) {

                // $this->preview_pkajonline($v);
                $this->template->title = "Cetak PKAJ Agen $filter[NOAGEN]";
                $this->template->content->view("pkajonline/term_pkajonline", $data);
                $this->template->publish();

            } else if($v["KDJABATANAGEN"]=="16") {

                // $this->preview_pkajonline($v);
                $this->template->title = "Cetak PKAJ Agen $filter[NOAGEN]";
                $this->template->content->view("pkajonline/term_pkajonline", $data);
                $this->template->publish();

                // $pkajnya_x="cetak_pkaj_aap.php";
                // $pkaj = "PKAJSAF";
            } else if($v["KDJABATANAGEN"]=="17") {

                // $this->preview_pkajonline($v);
                $this->template->title = "Cetak PKAJ Agen $filter[NOAGEN]";
                $this->template->content->view("pkajonline/term_pkajonline", $data);
                $this->template->publish();

                // $pkajnya_x="cetak_pkaj_saf.php";
                // $pkaj = "PKAJSAF";
            } else if($v["KDKANTOR"]=="KN") { // Cek apakah agen merupakan BSO Bancassurance Fendy 19122017

                // $this->preview_pkajonline($v);
                $this->template->title = "Cetak PKAJ Agen $filter[NOAGEN]";
                $this->template->content->view("pkajonline/term_pkajonline", $data);
                $this->template->publish();

                // $pkajnya_x = "cetak_pkaj_bas.php";
                // $pkaj = "PKAJ";
            } else {

                // $this->preview_pkajonline($v);
                $this->template->title = "Cetak PKAJ Agen $filter[NOAGEN]";
                $this->template->content->view("pkajonline/term_pkajonline", $data);
                $this->template->publish();

                // $pkajnya=substr($data["KDKANTOR"],-1)=="A"? "cetak_pkajpk.php" : "cetak_pkaj.php";
                // $pkajnya_x=substr($data["KDKANTOR"],-1)=="A"? "cetak_pkaj_xpk.php" : "cetak_pkaj_x.php";
                // $pkaj = "PKAJ";
            }
        } 
    }


    /*===== cetak pkaj online =====*/
    function cetak_pkajonline() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $filter['NOAGEN']=$this->input->get('noagen');
        $filter['TGLPKAJAGEN']=$this->input->get('tglpkaj');
        $datas = $this->Pkaj_model->data_pkajonline($filter);
        foreach($datas as $i => $d) { 
            $nopkaj = $d['NOPKAJAGEN'];
            $kdkantor = $d['KDKANTOR'];
            $noagenbm = $d['NOAGENBM'];
            $namabm = $d['NAMABM'];
            $noagen = $d['NOAGEN'];
            $jabatanbm = $d['JABATANBM'];
            $nipbm = $d['NIPBM'];
            $alamatktr = $d['ALAMATKTR'];
            $telponktr = $d['TELPONKTR'];
            $faxktr = $d['FAXKTR'];  
            $noidagen = $d['NOMORIDAGEN'];
            $alamatagen = $d['ALAMATAGEN'];
            $notelponagen = $d['NOTELPONAGEN'];
            $namaklien = $d['NAMAKLIEN1'];
            $tgl = $d['TGL'];
            $bln = $d['BLN'];
            $thn = $d['THN'];
            $tmptlhr = $d['TEMPATLAHIR'];
            $tgllhr = $d['TGLLAHIR'];    
            $jnskel = $d['JENISKELAMIN'];
            $tglpkaj = $d['TGLPKAJAGEN'];        
        }

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

        $hari = array(
            'Monday'=>'Senin',
            'Tuesday'=>'Selasa',
            'Wednesday'=>'Rabu',
            'Thursday'=>'Kamis',
            'Friday'=>'Jumat',
            'Saturday'=>'Sabtu',
            'Sunday'=>'Minggu'
        );

        $x = mktime(0, 0, 0, $bln, $tgl, $thn);

        $data['TANGGAL'] = date("d", $x);
        $data['BULAN'] = $bulan[date("n", $x)];
        $data['TAHUN'] = date("Y", $x);
        $data['HARI'] = $hari[date("l", $x)];

        $filter['s'] = strtolower(trim($this->input->get('s')));
        $filter['p'] = $this->input->get('per_page') ? $this->input->get('per_page') : 1;

        $filter['noagen']=$this->input->get('noagen');
        $filter['nopkaj']=$this->input->get('nopkaj');
        $filter['tglpkaj']=$this->input->get('tglpkaj');
          
        $data['pkaj'] = $this->Pkaj_model->pkajonline($filter);

        $datas = $this->Pkaj_model->cek_pkajonline($filter['noagen'], $filter['nopkaj']);
        foreach($datas as $i => $v) {
            //Cek apakah agen merupakan agen PK Dedi 29092014
            if(in_array($v["KDJABATANAGEN"], array("00","10","11","12","13"))) {

                // $this->preview_pkajonline($v);
                $this->template->title = "Cetak PKAJ Agen $filter[noagen]";
                $this->template->content->view("pkajonline/cetak_epkajpk", $data);
                $this->template->publish();

            } else if($v["KDJABATANAGEN"]=="16") {

                // $this->preview_pkajonline($v);
                $this->template->title = "Cetak PKAJ Agen $filter[noagen]";
                $this->template->content->view("pkajonline/cetak_epkaj_aap", $data);
                $this->template->publish();
            } else if($v["KDJABATANAGEN"]=="17") {

                // $this->preview_pkajonline($v);
                $this->template->title = "Cetak PKAJ Agen $filter[noagen]";
                $this->template->content->view("pkajonline/cetak_epkaj_saf", $data);
                $this->template->publish();
            } else if($v["KDKANTOR"]=="KN") { // Cek apakah agen merupakan BSO Bancassurance Fendy 19122017

                // $this->preview_pkajonline($v);
                $this->template->title = "Cetak PKAJ Agen $filter[noagen]";
                $this->template->content->view("pkajonline/cetak_epkaj_bas", $data);
                $this->template->publish();
            } else {

                // $this->preview_pkajonline($v);
                $this->template->title = "Cetak PKAJ Agen $filter[noagen]";
                $this->template->content->view("pkajonline/cetak_epkaj", $data);
                $this->template->publish();
            }
        }
    }


    /*===== daftar preview pkaj online =====*/
    // function preview_pkajonline($cdata) {
    //     check_user_role_menu(C_MENU_PROSPEK_SAYA);

    //     $datas = $this->Pkaj_model->data_pkajonline($cdata);
    //     foreach($datas as $i => $d) { 
    //         $nopkaj = $d['NOPKAJAGEN'];
    //         $kdkantor = $d['KDKANTOR'];
    //         $noagenbm = $d['NOAGENBM'];
    //         $namabm = $d['NAMABM'];
    //         $noagen = $d['NOAGEN'];
    //         $jabatanbm = $d['JABATANBM'];
    //         $nipbm = $d['NIPBM'];
    //         $alamatktr = $d['ALAMATKTR'];
    //         $telponktr = $d['TELPONKTR'];
    //         $faxktr = $d['FAXKTR'];  
    //         $noidagen = $d['NOMORIDAGEN'];
    //         $alamatagen = $d['ALAMATAGEN'];
    //         $notelponagen = $d['NOTELPONAGEN'];
    //         $namaklien = $d['NAMAKLIEN1'];
    //         $tgl = $d['TGL'];
    //         $bln = $d['BLN'];
    //         $thn = $d['THN'];
    //         $tmptlhr = $d['TEMPATLAHIR'];
    //         $tgllhr = $d['TGLLAHIR'];    
    //         $jnskel = $d['JENISKELAMIN'];
    //         $tglpkaj = $d['TGLPKAJAGEN'];        
    //     }

    //     $bulan = array(
    //     '1'=>'Januari',
    //     '2'=>'Februari',
    //     '3'=>'Maret',
    //     '4'=>'April',
    //     '5'=>'Mei',
    //     '6'=>'Juni',
    //     '7'=>'Juli',
    //     '8'=>'Agustus',
    //     '9'=>'September',
    //     '10'=>'Oktober',
    //     '11'=>'November',
    //     '12'=>'Desember'
    //     );

    //     $hari = array(
    //     'Monday'=>'Senin',
    //     'Tuesday'=>'Selasa',
    //     'Wednesday'=>'Rabu',
    //     'Thursday'=>'Kamis',
    //     'Friday'=>'Jumat',
    //     'Saturday'=>'Sabtu',
    //     'Sunday'=>'Minggu'
    //     );

    //     $x = mktime(0, 0, 0, $bln, $tgl, $thn);

    //     $data['TANGGAL'] = date("d", $x);
    //     $data['BULAN'] = $bulan[date("n", $x)];
    //     $data['TAHUN'] = date("Y", $x);
    //     $data['HARI'] = $hari[date("l", $x)];
        

    //     $filter['s'] = strtolower(trim($this->input->get('s')));
    //     $filter['p'] = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
    //     $filter['noagen'] = $this->session->USERNAME;
    //     $data['pkaj'] = $this->Pkaj_model->data_pkajonline($cdata);

    //     $this->load->library('pagination');
    //     $config['base_url'] = "$this->url/preview_pkajonline";
    //     $config['total_rows'] = $this->Pkaj_model->get_total_pkajonline($filter['noagen']);
    //     $this->pagination->initialize($config);

    //     $data['status'] = $this->session->flashdata('status');

    //     $this->template->title = "Cetak PKAJ Agen $cdata[NOAGEN]";
    //     $this->template->content->view("pkajonline/term_pkajonline", $data);
    //     $this->template->publish();
    // }


    /*===== cek otp pkaj online =====*/
    function otp_pkajonline() {        
        include 'RundomString.php';

        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $filter['s'] = strtolower(trim($this->input->get('s')));
        $filter['p'] = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $noagen = $this->input->get('noagen');

        $filter['NOAGEN'] = $this->input->get('noagen');
        $filter['NMAGEN'] = $this->input->get('nmagen');
        $filter['NOPKAJ'] = $this->input->get('nopkaj'); 
        $data['statusjoin'] = $this->input->get('statusjoin');
        $filter['TGLPKAJAGEN'] = $this->input->get('tglpkaj');        
        $result = $this->Pkaj_model->dataotp_pkajonline($filter);

            if($result>0){
                foreach ($result as $key => $value) {

                    // kirim OTP
                    $new_otp    = RandomString(4);
                    $notlp      = $value['NOTELPONAGEN'];
                    $kantor     = $value['KDKANTOR'];
                    $nopkaj     = $value['NOPKAJAGEN'];

                    $nmagen     = $filter['NMAGEN'];

                    $send = $this->Pkaj_model->sendOtp($kantor, $nopkaj, $notlp, 'KODE OTP EPKAJ ANDA ADALAH : '.$new_otp, $nmagen);

                    //redirect ke halaman step 2
                    if($nopkaj){
                        $data['otp'] = $this->Pkaj_model->get_sendOtp($notlp, $kantor, $nopkaj);
                        $data['pkaj'] = $this->Pkaj_model->data_pkajonline($filter);
                        $data['keterangan'] = "KODE OTP SUDAH DIKIRIM KE NO HP ANDA " . $notlp;
                    }                
                }

                // print_r( $data['otp']);
            }else{
            
            echo "gagal";
        }

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/otp_pkajonline";
        $config['total_rows'] = $this->Pkaj_model->get_total_pkajonline($noagen);
        $this->pagination->initialize($config);

        $data['status'] = $this->session->flashdata('status');

        $this->template->title = 'Verifikasi OTP';
        $this->template->content->view("pkajonline/cek_otp", $data);
        $this->template->publish();
    }


    /*===== insert pkaj online =====*/
    function insert_pkajonline() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $filter['s'] = strtolower(trim($this->input->get('s')));
        $filter['p'] = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $filter['noagen'] = $this->session->USERNAME;

        $cdata['NOAGEN']            = isset($_POST['noagen']) ? trim($this->input->post('noagen', true)) : null;  
        $cdata['NOPKAJAGEN']        = isset($_POST['nopkaj']) ? trim($this->input->post('nopkaj', true)) : null; 
        $cdata['TGLPKAJAGEN']       = isset($_POST['tglpkaj']) ? trim($this->input->post('tglpkaj', true)) : null; 
        $cdata['KDKANTOR']          = isset($_POST['kdkantor']) ? trim($this->input->post('kdkantor', true)) : null; 
        $cdata['NOTELPONAGEN']       = isset($_POST['notlp']) ? trim($this->input->post('notlp', true)) : null; 
        $cdata['SMS_OTP']           = isset($_POST['sms_otp']) ? trim($this->input->post('sms_otp', true)) : null;

        $data = $this->Pkaj_model->get_sendOtp($cdata['NOTELPONAGEN'], $cdata['KDKANTOR'], $cdata['NOPKAJAGEN']);
        
            $data = $this->Pkaj_model->data_pkajonline($cdata);

            $now = date('d-m-Y H:i:s');

            foreach($data as $i => $d) { 
                $nopkaj = $d['NOPKAJAGEN'];
                $kdkantor = $d['KDKANTOR'];
                $noagenbm = $d['NOAGENBM'];
                $namabm = $d['NAMABM'];
                $noagen = $d['NOAGEN'];
                $jabatanbm = $d['JABATANBM'];
                $nipbm = $d['NIPBM'];
                $alamatktr = $d['ALAMATKTR'];
                $telponktr = $d['TELPONKTR'];
                $faxktr = $d['FAXKTR'];  
                $noidagen = $d['NOMORIDAGEN'];
                $alamatagen = $d['ALAMATAGEN'];
                $notelponagen = $d['NOTELPONAGEN'];
                $namaklien = $d['NAMAKLIEN1'];
                $tgl = $d['TGL'];
                $bln = $d['BLN'];
                $thn = $d['THN'];
                $tmptlhr = $d['TEMPATLAHIR'];
                $tgllhr = $d['TGLLAHIR'];    
                $jnskel = $d['JENISKELAMIN'];
                $tglpkaj = $d['TGLPKAJAGEN'];        
            }

            $this->load->library('ciqrcode'); //pemanggilan library QR CODE

            $config['cacheable']    = true; //boolean, the default is true
            $config['cachedir']     = ''; //string, the default is application/cache/
            $config['errorlog']     = ''; //string, the default is application/logs/
            $config['imagedir']     = '/asset/images_qrcode/'; //direktori penyimpanan qr code
            $config['quality']      = true; //boolean, the default is true
            $config['size']         = '1024'; //interger, the default is 1024
            $config['black']        = array(224,255,255); // array, default is array(255,255,255)
            $config['white']        = array(70,130,180); // array, default is array(0,0,0)
            $this->ciqrcode->initialize($config);

            $image_qragen='EPKAJ-'.$nopkaj.'_'.$noagen.'.png'; //buat name dari qr code sesuai dengan nim

            $qragen['data'] = 'EPKAJ-'.$nopkaj.' / '.$noagen.' / '.$namaklien.' / '.$now; //data yang akan di jadikan QR CODE
            $qragen['level'] = 'H'; //H=High
            $qragen['size'] = 3;
            $qragen['savename'] = FCPATH.$config['imagedir'].$image_qragen; //simpan image QR CODE ke folder assets/images_qrcode/
            $this->ciqrcode->generate($qragen); // fungsi untuk generate QR CODE

            $image_noagenbm='EPKAJ-'.$nopkaj.'_'.$noagenbm.'.png'; //buat name dari qr code sesuai dengan nim

            $qrkancab['data'] = 'EPKAJ-'.$nopkaj.' / '.$noagenbm.' / '.$namabm.' / '.$now; //data yang akan di jadikan QR CODE
            $qrkancab['level'] = 'H'; //H=High
            $qrkancab['size'] = 3; 
            $qrkancab['savename'] = FCPATH.$config['imagedir'].$image_noagenbm; //simpan image QR CODE ke folder assets/images_qrcode/
            $this->ciqrcode->generate($qrkancab); // fungsi untuk generate QR CODE

            $result = $this->Pkaj_model->insert_pkajonline($nopkaj,$kdkantor,$noagenbm,$namabm,$noagen,$jabatanbm,$nipbm,$alamatktr,$telponktr,$faxktr,$noidagen,$alamatagen,$notelponagen,$namaklien,$tgl,$bln,$thn,$tmptlhr,$tgllhr,$jnskel,$tglpkaj,$image_qragen,$image_noagenbm); //simpan ke database

            json_encode($result); 
    }


    /*===== daftar prospek pribadi =====*/
    function pribadi() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $filter['s'] = strtolower(trim($this->input->get('s')));
        $filter['p'] = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $filter['noagen'] = $this->session->USERNAME;
        $data['prospek'] = $this->prospek_model->get_list_prospek($filter);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/pribadi";
        $config['total_rows'] = $this->prospek_model->get_total_prospek($filter);
        $this->pagination->initialize($config);

        $data['status'] = $this->session->flashdata('status');

        $this->template->title = 'Prospek Saya';
        $this->template->content->view("prospek/pribadi", $data);
        $this->template->publish();
    }


    /*===== tambah prospek pribadi =====*/
    function add_pribadi() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);
        $this->load->model('master_model');

        $data['produk'] = json_decode(file_get_contents(C_URL_API_JAIM."/workbook.php?r=2&p=".rawurlencode($this->session->KDKANTOR)), true);
        $data['provinsi'] = $this->master_model->get_list_provinsi();

        $this->template->title = 'Tambah Data Prospek';
        $this->template->content->view("prospek/add_pribadi", $data);
        $this->template->publish();
    }


    /*===== edit prospek pribadi =====*/
    function edit_pribadi() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);
        $this->load->model('master_model');

        $data['prospek'] = $this->prospek_model->get_prospek($this->input->get('id'));
        $data['provinsi'] = $this->master_model->get_list_provinsi();

        $this->template->title = 'Ubah Data Prospek';
        $this->template->content->view("prospek/edit_pribadi", $data);
        $this->template->publish();
    }


    /*===== hapus prospek pribadi =====*/
    function delete_pribadi() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $status = $this->prospek_model->delete($this->input->get('id'));
        $this->session->set_flashdata('status', $status);

        redirect("$this->url/pribadi");
    }


    /*===== simpan prospek pribadi =====*/
    function save_pribadi() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $noprospek = $this->input->post('txtNoProspek');
        $nogenerate = $this->generate->id($this->session->KDKANTOR, true, true, date('d'), 6, null, $this->prospek_model->get_last_no_prospek());

        $data['NOPROSPEK'] = empty($noprospek) ? $nogenerate : $noprospek;
        $data['NOAGEN'] = $this->input->post('txtNoAgen');
        $data['KDKANTOR'] = $this->session->KDKANTOR;
        $data['KDAREAOFFICE'] = $this->session->KDAREAOFFICE;
        $data['KDUNITPRODUKSI'] = $this->session->KDUNITPRODUKSI;
        $data['KDJABATANAGEN'] = $this->session->KDJABATANAGEN;
        $data['NAMA'] = $this->input->post('txtNamaLengkap');
        $data['ALAMAT'] = $this->input->post('txtAlamat');
        $data['KOTA'] = $this->input->post('txtKota');
        $data['KDPROVINSI'] = $this->input->post('ddlKdProvinsi');
        $data['TGLLAHIR'] = $this->input->post('txtTglLahir');
        $data['JENISKELAMIN'] = $this->input->post('rbJnsKelamin');
        $data['TELP'] = $this->input->post('txtPhone1');
        $data['HP'] = $this->input->post('txtPhone2');
        $data['EMAIL'] = $this->input->post('txtEmail');
        $data['DIHAPUS'] = 0;

        if (empty($noprospek)) {
            $status = $this->prospek_model->insert($data);
        }
        else {
            $status = $this->prospek_model->update($data);
        }
        $this->session->set_flashdata('status', $status);

        redirect("$this->url/pribadi");
    }


    /*===== data proposal prospek =====*/
    function proposal_pribadi() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $data['prospek'] = $this->prospek_model->get_prospek($this->input->get('id'));
        //$data['proposal'] = $this->prospek_model->get_list_proposal($this->input->get('id'));
        $data['proposal'] = json_decode(file_get_contents(C_URL_API_JAIM."/workbook.php?r=9&p=".rawurlencode($this->input->get('id'))), true);
        $data['status'] = $this->session->flashdata('status');

        if ($data['prospek']['NOAGEN'] != $this->session->USERNAME) {
            redirect("$this->url/pribadi");
        }

        $this->template->title = 'Proposal';
        $this->template->content->view("prospek/proposal_pribadi", $data);
        $this->template->publish();
    }


    /*===== hapus proposal pribadi =====*/
    function delete_proposal_pribadi() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $followup = $this->prospek_model->get_list_follow_up($this->input->get('id'));
        $no_prospek = count($followup) > 0 ? $followup[0]['NO_PROSPEK'] : null;
        $pdf_file = count($followup) > 0 ? $followup[0]['FILE_PDF'] : null;
        $status = $this->prospek_model->delete_proposal($this->input->get('id'));
        $this->session->set_flashdata('status', $status);

        // hapus file pdf simulasi
        $path = str_replace('/','\\',FCPATH)."simulasi\\files\pdf\\";
        $file = $pdf_file;
        unlink($path.$file);

        redirect("$this->url/proposal-pribadi?id=$no_prospek");
    }


    /*===== follow up proposal =====*/
    function follow_up_proposal() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $data['statusproposal'] = $this->master_model->get_list_status_proposal();
        $data['edited'] = array('KDSTATUS' => '', 'KETERANGAN' => '', 'NOSPAJ' => '', 'TGLSPAJ' => '', 'TGLPRESENTASI' => '', 'PREMI' => '', 'TGLPELUNASAN' => '', 'TGLPEMBATALAN' => '');
        $data['followup'] = json_decode(file_get_contents(C_URL_API_JAIM."/workbook.php?r=10&p=".rawurlencode($this->input->get('id'))), true);
        $data['isdelete'] = $this->prospek_model->is_delete_followup($this->input->get('id'));
        $data['status'] = $this->session->flashdata('status');

        $this->template->title = 'Follow Up';
        $this->template->content->view("prospek/follow_up_pribadi", $data);
        $this->template->publish();
    }


    /*===== edit follow up proposal =====*/
    function edit_follow_up_proposal() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $data['statusproposal'] = $this->master_model->get_list_status_proposal();
        $data['edited'] = $this->prospek_model->get_follow_up($this->input->get('nf'));
        $data['followup'] = $this->prospek_model->get_list_follow_up($this->input->get('id'));
        $data['isdelete'] = $this->prospek_model->is_delete_followup($this->input->get('id'));
        $data['status'] = $this->session->flashdata('status');

        $this->template->title = 'Follow Up';
        $this->template->content->view("prospek/follow_up_pribadi", $data);
        $this->template->publish();
    }


    /*===== simpan follow up =====*/
    function save_follow_up() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $nofollowup = $this->input->post('txtnofollowup');
        $nogenerate = $this->prospek_model->get_last_no_follow_up();

        $tglpresentasi = $this->input->post('txttglpresentasi');
        $nospaj = $this->input->post('txtnospaj');
        $tglspaj = $this->input->post('txttglspaj');
        $premi = $this->input->post('txtpremipelunasan');
        $tglpelunasan = $this->input->post('txttglpelunasan');
        $tglpembatalan = $this->input->post('txttglpembatalan');

        $data['NOFOLLOWUP'] = empty($nofollowup) ? $nogenerate : $nofollowup;
        $data['BUILD_ID'] = $this->input->post('txtbuildid');
        $data['KDSTATUS'] = $this->input->post('ddlstatus');
        $data['KETERANGAN'] = $this->input->post('txtketerangan');

        switch ($data['KDSTATUS']) {
            case 3:
                $data['TGLPRESENTASI'] = $tglpresentasi;
                break;
            case 4:
                $data['NOSPAJ'] = $nospaj;
                $data['TGLSPAJ'] = $tglspaj;
                break;
            case 5:
                $data['PREMI'] = $premi;
                $data['TGLPELUNASAN'] = $tglpelunasan;
                break;
            case 99:
                $data['TGLPEMBATALAN'] = $tglpembatalan;
                break;
        }

        if (empty($nofollowup)) {
            $data['USERREKAM'] = $this->session->USERNAME;
            $status = $this->prospek_model->insert_followup($data);
        }
        else {
            $status = $this->prospek_model->update_followup($data);
        }
        $this->session->set_flashdata('status', $status);

        redirect("$this->url/follow-up-proposal?r=".$this->input->post('txtnoprospek')."&id=$data[BUILD_ID]");
    }


    /*===== hapus follow up =====*/
    function delete_follow_up() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $status = $this->prospek_model->delete_followup($this->input->get('nf'));
        $this->session->set_flashdata('status', $status);

        redirect("$this->url/follow-up-proposal?r=".$this->input->get('r')."&id=".$this->input->get('id'));
    }


    /*===== daftar detail prospek binaan =====*/
    function binaan_detail() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $filter['s'] = strtolower(trim($this->input->get('s')));
        $filter['p'] = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $filter['noagen'] = $this->input->get('id');
        $data['prospek'] = $this->prospek_model->get_list_prospek($filter);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/agen-se-cabang-detail?s=$filter[s]&id=$filter[noagen]&nm=".rawurlencode($this->input->get('nm'));
        $config['total_rows'] = $this->prospek_model->get_total_prospek($filter);
        $this->pagination->initialize($config);

        $this->template->title = ucwords(str_replace('-', ' ', $this->input->get('nm')));
        $this->template->content->view("prospek/binaan_detail", $data);
        $this->template->publish();
    }


    /*===== data proposal prospek binaan =====*/
    function proposal_binaan() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $data['prospek'] = $this->prospek_model->get_prospek($this->input->get('np'));
        $data['proposal'] = $this->prospek_model->get_list_proposal($this->input->get('np'));

        $this->template->title = 'Proposal';
        $this->template->content->view("prospek/proposal_binaan", $data);
        $this->template->publish();
    }


    /*===== follow up proposal binaan =====*/
    function follow_up_proposal_binaan() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $data['followup'] = json_decode(file_get_contents(C_URL_API_JAIM."/workbook.php?r=10&p=".rawurlencode($this->input->get('pr'))), true);

        $this->template->title = 'Follow Up';
        $this->template->content->view("prospek/follow_up_binaan", $data);
        $this->template->publish();
    }


    /*===== daftar prospek agen se cabang =====*/
    function agen_se_cabang() {
        check_user_role_menu(C_MENU_PROSPEK_AGEN_SE_CABANG);

        $s = strtolower(trim($this->input->get('s')));
        $p = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $kdkantor = $this->session->USERNAME;
        $noagen = "0000000000";
        $data['prospekcabang'] = json_decode(file_get_contents(C_URL_API_JAIM."/workbook.php?r=3&p=".rawurlencode($p)."&p2=".rawurlencode(C_ROWS_PAGINATION)."&p3=".rawurlencode($kdkantor)."&p4=".rawurlencode($noagen)."&p5=".rawurlencode($s)), true);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/agen-se-cabang?s=$s";
        $config['total_rows'] = file_get_contents(C_URL_API_JAIM."/workbook.php?r=4&p=".rawurlencode($p)."&p2=".rawurlencode(C_ROWS_PAGINATION)."&p3=".rawurlencode($kdkantor)."&p4=".rawurlencode($noagen)."&p5=".rawurlencode($s));
        $this->pagination->initialize($config);

        $this->template->title = 'Prospek Agen';
        $this->template->content->view("prospek/agen_se_cabang", $data);
        $this->template->publish();
    }


    /*===== daftar detail prospek agen se cabang =====*/
    function agen_se_cabang_detail() {
        check_user_role_menu(C_MENU_PROSPEK_AGEN_SE_CABANG);

        $filter['s'] = strtolower(trim($this->input->get('s')));
        $filter['p'] = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $filter['noagen'] = $this->input->get('id');
        $data['prospek'] = $this->prospek_model->get_list_prospek($filter);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/agen-se-cabang-detail?s=$filter[s]&id=$filter[noagen]&nm=".rawurlencode($this->input->get('nm'));
        $config['total_rows'] = $this->prospek_model->get_total_prospek($filter);
        $this->pagination->initialize($config);

        $this->template->title = ucwords(str_replace('-', ' ', $this->input->get('nm')));
        $this->template->content->view("prospek/agen_se_cabang_detail", $data);
        $this->template->publish();
    }


    /*===== daftar proposal agen se cabang =====*/
    function proposal_se_cabang() {
        check_user_role_menu(C_MENU_PROSPEK_AGEN_SE_CABANG);

        $data['prospek'] = $this->prospek_model->get_prospek($this->input->get('np'));
        $data['proposal'] = $this->prospek_model->get_list_proposal($this->input->get('np'));

        if ($data['prospek']['KDKANTOR'] != $this->session->USERNAME) {
            redirect("$this->url/agen-se-cabang");
        }

        $this->template->title = "Proposal ".$data['prospek']['NAMA'];
        $this->template->content->view("prospek/proposal_se_cabang", $data);
        $this->template->publish();
    }


    /*===== daftar follow up agen se cabang =====*/
    function follow_up_se_cabang() {
        check_user_role_menu(C_MENU_PROSPEK_AGEN_SE_CABANG);

        $data['prospek'] = $this->prospek_model->get_prospek($this->input->get('np'));
        $data['followup'] = json_decode(file_get_contents(C_URL_API_JAIM."/workbook.php?r=10&p=".rawurlencode($this->input->get('pr'))), true);

        $this->template->title = 'Follow Up';
        $this->template->content->view("prospek/follow_up_se_cabang", $data);
        $this->template->publish();
    }


    /*===== daftar prospek agen se wilayah =====*/
    function agen_se_wilayah() {
        check_user_role_menu(C_MENU_PROSPEK_AGEN_SE_WILAYAH);

        $data['cabang'] = json_decode(file_get_contents(C_URL_API_JAIM."/master.php?r=1&p=".rawurlencode($this->session->USERNAME)), true);

        $s = strtolower(trim($this->input->get('s')));
        $p = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $kdkantor = $this->input->get('ktr');
        $noagen = "0000000000";
        $data['prospekwilayah'] = json_decode(file_get_contents(C_URL_API_JAIM."/workbook.php?r=5&p=".rawurlencode($p)."&p2=".rawurlencode(C_ROWS_PAGINATION)."&p3=".rawurlencode($kdkantor)."&p4=".rawurlencode($noagen)."&p5=".rawurlencode($s)), true);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/agen-se-wilayah?ktr=$kdkantor&s=$s";
        $config['total_rows'] = file_get_contents(C_URL_API_JAIM."/workbook.php?r=6&p=".rawurlencode($p)."&p2=".rawurlencode(C_ROWS_PAGINATION)."&p3=".rawurlencode($kdkantor)."&p4=".rawurlencode($noagen)."&p5=".rawurlencode($s));
        $this->pagination->initialize($config);

        $this->template->title = 'Prospek Agen';
        $this->template->content->view("prospek/agen_se_wilayah", $data);
        $this->template->publish();
    }


    /*===== daftar detail prospek agen se wilayah =====*/
    function agen_se_wilayah_detail() {
        check_user_role_menu(C_MENU_PROSPEK_AGEN_SE_WILAYAH);

        $filter['s'] = strtolower(trim($this->input->get('s')));
        $filter['p'] = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $filter['noagen'] = $this->input->get('id');
        $data['prospek'] = $this->prospek_model->get_list_prospek($filter);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/agen-se-wilayah-detail?s=$filter[s]&ktr=".$this->input->get('ktr')."&id=$filter[noagen]&nm=".rawurlencode($this->input->get('nm'));
        $config['total_rows'] = $this->prospek_model->get_total_prospek($filter);
        $this->pagination->initialize($config);

        $this->template->title = ucwords(str_replace('-', ' ', $this->input->get('nm')));
        $this->template->content->view("prospek/agen_se_wilayah_detail", $data);
        $this->template->publish();
    }


    /*===== daftar proposal agen se wilayah =====*/
    function proposal_se_wilayah() {
        check_user_role_menu(C_MENU_PROSPEK_AGEN_SE_WILAYAH);

        $data['prospek'] = $this->prospek_model->get_prospek($this->input->get('np'));
        $data['proposal'] = $this->prospek_model->get_list_proposal($this->input->get('np'));

        $arr_kantor = json_decode(file_get_contents(C_URL_API_JAIM."/master.php?r=1&p=".rawurlencode($this->session->USERNAME)), true);

        $redirect = 1;
        foreach ($arr_kantor as $i => $v) {
            if ($data['prospek']['KDKANTOR'] == $v['KDKANTOR'])
                $redirect = 0;
        }
        if ($redirect)
            redirect("$this->url/agen-se-wilayah");

        $this->template->title = "Proposal ".$data['prospek']['NAMA'];
        $this->template->content->view("prospek/proposal_se_wilayah", $data);
        $this->template->publish();
    }


    /*===== daftar follow up agen se wilayah =====*/
    function follow_up_se_wilayah() {
        check_user_role_menu(C_MENU_PROSPEK_AGEN_SE_WILAYAH);

        $data['prospek'] = $this->prospek_model->get_prospek($this->input->get('np'));
        $data['followup'] = json_decode(file_get_contents(C_URL_API_JAIM."/workbook.php?r=10&p=".rawurlencode($this->input->get('pr'))), true);

        $this->template->title = 'Follow Up';
        $this->template->content->view("prospek/follow_up_se_wilayah", $data);
        $this->template->publish();
    }


    /*===== download rekap data prospek agen se wilayah =====*/
    function download_prospek_se_wilayah() {
        check_user_role_menu(C_MENU_DOWNLOAD_PROSPEK_AGEN_SE_WILAYAH);

        $data['cabang'] = json_decode(file_get_contents(C_URL_API_JAIM."/master.php?r=1&p=".rawurlencode($this->session->USERNAME)), true);

        $this->template->title = 'Download Rekap Prospek';
        $this->template->content->view("prospek/download_prospek_se_wilayah", $data);
        $this->template->publish();
    }


    /*===== download rekap prospek se wilayah format excel =====*/
    function download_prospek_se_wilayah_excel() {
        check_user_role_menu(C_MENU_DOWNLOAD_PROSPEK_AGEN_SE_WILAYAH);

        $kdkantor = $this->input->get('ktr');
        $tglawal = $this->input->get('txtTglAwal');
        $tglakhir = $this->input->get('txtTglAkhir');
        $data['rekap'] = json_decode(file_get_contents(C_URL_API_JAIM."/workbook.php?r=7&p=".rawurlencode($kdkantor)."&p2=".rawurlencode($tglawal)."&p3=".rawurlencode($tglakhir)), true);

        $this->load->view('prospek/download_prospek_excel', $data);
    }


    /*===== download rekap data prospek agen se wilayah =====*/
    function download_prospek_se_cabang() {
        check_user_role_menu(C_MENU_DOWNLOAD_PROSPEK_AGEN_SE_CABANG);

        $this->template->title = 'Download Rekap Prospek';
        $this->template->content->view("prospek/download_prospek_se_cabang");
        $this->template->publish();
    }


    /*===== download rekap prospek se wilayah format excel =====*/
    function download_prospek_se_cabang_excel() {
        check_user_role_menu(C_MENU_DOWNLOAD_PROSPEK_AGEN_SE_CABANG);

        $username = $this->session->USERNAME;
        $tglawal = $this->input->get('txtTglAwal');
        $tglakhir = $this->input->get('txtTglAkhir');
        $data['rekap'] = json_decode(file_get_contents(C_URL_API_JAIM."/workbook.php?r=8&p=".rawurlencode($username)."&p2=".rawurlencode($tglawal)."&p3=".rawurlencode($tglakhir)), true);

        $this->load->view('prospek/download_prospek_excel', $data);
    }


    /*===== download rekap prospek se kantor jiwasraya (kapus) =====*/
    function download_prospek_se_kapus() {
        check_user_role_menu(C_MENU_DOWNLOAD_PROSPEK_AGEN_SE_KAPUS);

        $data['cabang'] = json_decode(file_get_contents(C_URL_API_JAIM."/master.php?r=4"), true);

        $this->template->title = 'Download Rekap Prospek';
        $this->template->content->view("prospek/download_prospek_se_kapus", $data);
        $this->template->publish();
    }


    /*===== download rekap prospek se kapus format excel =====*/
    function download_prospek_se_kapus_excel() {
        check_user_role_menu(C_MENU_DOWNLOAD_PROSPEK_AGEN_SE_KAPUS);

        $kdkantor = $this->input->get('ktr');
        $tglawal = $this->input->get('txtTglAwal');
        $tglakhir = $this->input->get('txtTglAkhir');
        $data['rekap'] = json_decode(file_get_contents(C_URL_API_JAIM."/workbook.php?r=8&p=".rawurlencode($kdkantor)."&p2=".rawurlencode($tglawal)."&p3=".rawurlencode($tglakhir)), true);

        $this->load->view('prospek/download_prospek_excel', $data);
    }
}