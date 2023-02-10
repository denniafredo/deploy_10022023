<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nasabah extends CI_Controller {

    function __construct() {
        parent::__construct();

        check_session_user();
        check_kuesioner();
        $this->url = base_url('nasabah');
    }


    /*===== nasabah agen =====*/
    function index() {
        check_user_role_menu(C_MENU_PROSPEK_NASABAH);

        $filter['s'] = strtolower(trim($this->input->get('s')));
        $filter['p'] = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $filter['noagen'] = $this->session->USERNAME;
        $data['nasabah'] = json_decode(file_get_contents(C_URL_API_JAIM."/nasabah.php?r=1&p=".rawurlencode($filter['p'])."&p1=".rawurlencode(C_ROWS_PAGINATION)."&p2=".rawurlencode($filter['noagen'])."&p3=".rawurlencode($filter['s'])), true);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url";
        $config['total_rows'] = file_get_contents(C_URL_API_JAIM."/nasabah.php?r=2&p=".rawurlencode($filter['p'])."&p1=".rawurlencode(C_ROWS_PAGINATION)."&p2=".rawurlencode($filter['noagen'])."&p3=".rawurlencode($filter['s']));
        $this->pagination->initialize($config);

        $this->template->title = 'Data Nasabah';
        $this->template->content->view("nasabah/nasabah", $data);
        $this->template->publish();
    }


    function ulangtahun() {
        check_user_role_menu(C_MENU_ULANGTAHUN_NASABAH);

        $noagen = $this->session->USERNAME;
        $data['ultah'] = json_decode(file_get_contents(C_URL_API_JAIM."/nasabah.php?r=3&p=".rawurlencode($noagen)), true);

        $this->template->title = 'Ulang Tahun';
        $this->template->content->view("nasabah/ulangtahun", $data);
        $this->template->publish();
    }


    function jatuhtempo() {
        check_user_role_menu(C_MENU_JATUHTEMPO_BENEFIT);

        $noagen = $this->session->USERNAME;
        $data['jatuhtempo'] = json_decode(file_get_contents(C_URL_API_JAIM."/nasabah.php?r=4&p=".rawurlencode($noagen)), true);

        $this->template->title = 'Jatuh Tempo Benefit';
        $this->template->content->view("nasabah/jatuhtempobenefit", $data);
        $this->template->publish();
    }


    function jatuhtempopremi() {
        check_user_role_menu(C_MENU_JATUHTEMPO_PREMI);

        $noagen = $this->session->USERNAME;
        $data['jatuhtempo'] = json_decode(file_get_contents(C_URL_API_JAIM."/nasabah.php?r=5&p=".rawurlencode($noagen)), true);
        $data['produk'] = json_decode(file_get_contents(C_URL_API_JAIM."/nasabah.php?r=21&p=".rawurlencode($noagen)), true);

        $this->template->title = 'Jatuh Tempo Premi';
        $this->template->content->view("nasabah/jatuhtempopremi", $data);
        $this->template->publish();
    }

    /*Menu Jatuh Tempo (TESTING) dengan penambahan menu sorting by produk, tanggal, status polis*/
    // function jatuhtempopremi_testing() { 
    //     check_user_role_menu(C_MENU_JATUHTEMPO_PREMI);

    //     $noagen = $this->session->USERNAME;
    //     $data['jatuhtempo'] = json_decode(file_get_contents(C_URL_API_JAIM."/nasabah.php?r=5&p=".rawurlencode($noagen)), true);
    //     $data['produk'] = json_decode(file_get_contents(C_URL_API_JAIM."/nasabah.php?r=21&p=".rawurlencode($noagen)), true);

    //     $this->template->title = 'Jatuh Tempo Premi';
    //     $this->template->content->view("nasabah/jatuhtempopremi_testing", $data);
    //     $this->template->publish();
    // }

    function jatuhtempopremi_search() { 
        check_user_role_menu(C_MENU_JATUHTEMPO_PREMI);

        $noagen = $this->session->USERNAME;
        $jp = $this->input->get('jenisproduk'); //Jenis Produk
        $sp = $this->input->get('statuspolis'); //Status Polis (AKTIF / BPO)
        $ta = $this->input->get('tglawal'); //Tanggal Awal
        $tz = $this->input->get('tglakhir'); //Tanggal Akhir
        //echo $ta."</br>".$tz;
        $data['jatuhtempo'] = json_decode(file_get_contents(C_URL_API_JAIM."/nasabah.php?r=22&jenisproduk=".$jp."&statuspolis=".$sp."&tglawal=".$ta."&tglakhir=".$tz."&p=".rawurlencode($noagen)), true);
        $data['produk'] = json_decode(file_get_contents(C_URL_API_JAIM."/nasabah.php?r=21&p=".rawurlencode($noagen)), true);

        $this->template->title = 'Jatuh Tempo Premi';
        $this->template->content->view("nasabah/jatuhtempopremi", $data);
        $this->template->publish();
    }
}