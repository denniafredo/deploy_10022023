<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prestasi extends CI_Controller {

    function __construct() {
        parent::__construct();

        check_session_user();
        check_kuesioner();
        $this->url = base_url('prestasi');
    }


    /*===== agen top rekrut role agen =====*/
    function top_rekrut_agen() {
        check_user_role_menu(C_MENU_TOP_REKRUT_AGEN);

        $p = $this->session->KDKANTOR;
        $f = $this->input->get('f');
        $data['kantor'] = json_decode(file_get_contents(C_URL_API_JAIM."/master.php?r=2&p1=$p"), true);
        $data['toprekrut'] = json_decode(file_get_contents(C_URL_API_JAIM."/prestasi.php?r=1&p1=$f"), true);

        $this->template->title = 'Top Rekrut';
        $this->template->content->view("prestasi/top_rekrut", $data);
        $this->template->publish();
    }


    /*===== agen top polis role agen =====*/
    function top_polis_agen() {
        check_user_role_menu(C_MENU_TOP_POLIS_AGEN);

        $p = $this->session->KDKANTOR;
        $f = $this->input->get('f');
        $data['kantor'] = json_decode(file_get_contents(C_URL_API_JAIM."/master.php?r=2&p1=$p"), true);
        $data['toppolis'] = json_decode(file_get_contents(C_URL_API_JAIM."/prestasi.php?r=2&p1=$f"), true);

        $this->template->title = 'Top Polis';
        $this->template->content->view("prestasi/top_polis", $data);
        $this->template->publish();
    }


    /*===== agen top polis role agen =====*/
    function top_premi_agen() {
        check_user_role_menu(C_MENU_TOP_PREMI_AGEN);

        $p = $this->session->KDKANTOR;
        $f = $this->input->get('f');
        $data['kantor'] = json_decode(file_get_contents(C_URL_API_JAIM."/master.php?r=2&p1=$p"), true);
        $data['toppremi'] = json_decode(file_get_contents(C_URL_API_JAIM."/prestasi.php?r=3&p1=$f"), true);

        $this->template->title = 'Top Premi';
        $this->template->content->view("prestasi/top_premi", $data);
        $this->template->publish();
    }


    /*===== agen top rekrut role cabang =====*/
    function top_rekrut_cabang() {
        check_user_role_menu(C_MENU_TOP_REKRUT_CABANG);

        $p = $this->session->USERNAME;
        $f = $this->input->get('f');
        $data['kantor'] = json_decode(file_get_contents(C_URL_API_JAIM."/master.php?r=2&p1=$p"), true);
        $data['toprekrut'] = json_decode(file_get_contents(C_URL_API_JAIM."/prestasi.php?r=1&p1=$f"), true);

        $this->template->title = 'Top Rekrut';
        $this->template->content->view("prestasi/top_rekrut", $data);
        $this->template->publish();
    }


    /*===== agen top polis role cabang =====*/
    function top_polis_cabang() {
        check_user_role_menu(C_MENU_TOP_POLIS_CABANG);

        $p = $this->session->USERNAME;
        $f = $this->input->get('f');
        $data['kantor'] = json_decode(file_get_contents(C_URL_API_JAIM."/master.php?r=2&p1=$p"), true);
        $data['toppolis'] = json_decode(file_get_contents(C_URL_API_JAIM."/prestasi.php?r=2&p1=$f"), true);

        $this->template->title = 'Top Polis';
        $this->template->content->view("prestasi/top_polis", $data);
        $this->template->publish();
    }


    /*===== agen top polis role cabang =====*/
    function top_premi_cabang() {
        check_user_role_menu(C_MENU_TOP_PREMI_CABANG);

        $p = $this->session->USERNAME;
        $f = $this->input->get('f');
        $data['kantor'] = json_decode(file_get_contents(C_URL_API_JAIM."/master.php?r=2&p1=$p"), true);
        $data['toppremi'] = json_decode(file_get_contents(C_URL_API_JAIM."/prestasi.php?r=3&p1=$f"), true);

        $this->template->title = 'Top Premi';
        $this->template->content->view("prestasi/top_premi", $data);
        $this->template->publish();
    }


    /*===== agen top rekrut role wilayah =====*/
    function top_rekrut_wilayah() {
        check_user_role_menu(C_MENU_TOP_REKRUT_WILAYAH);

        $p = $this->session->USERNAME;
        $kw = $this->input->get('f') == $this->session->USERNAME ? $this->input->get('f') : null;
        $kc = $this->input->get('f') != $this->session->USERNAME ? $this->input->get('f') : null;
        $data['kantor'] = json_decode(file_get_contents(C_URL_API_JAIM."/master.php?r=1&p=$p"), true);
        $data['toprekrut'] = json_decode(file_get_contents(C_URL_API_JAIM."/prestasi.php?r=1&p=$kw&p1=$kc"), true);

        $this->template->title = 'Top Rekrut';
        $this->template->content->view("prestasi/top_rekrut", $data);
        $this->template->publish();
    }


    /*===== agen top polis role wilayah =====*/
    function top_polis_wilayah() {
        check_user_role_menu(C_MENU_TOP_POLIS_WILAYAH);

        $p = $this->session->USERNAME;
        $kw = $this->input->get('f') == $this->session->USERNAME ? $this->input->get('f') : null;
        $kc = $this->input->get('f') != $this->session->USERNAME ? $this->input->get('f') : null;
        $data['kantor'] = json_decode(file_get_contents(C_URL_API_JAIM."/master.php?r=1&p=$p"), true);
        $data['toppolis'] = json_decode(file_get_contents(C_URL_API_JAIM."/prestasi.php?r=2&p=$kw&p1=$kc"), true);

        $this->template->title = 'Top Polis';
        $this->template->content->view("prestasi/top_polis", $data);
        $this->template->publish();
    }


    /*===== agen top polis role wilayah =====*/
    function top_premi_wilayah() {
        check_user_role_menu(C_MENU_TOP_PREMI_WILAYAH);

        $p = $this->session->USERNAME;
        $kw = $this->input->get('f') == $this->session->USERNAME ? $this->input->get('f') : null;
        $kc = $this->input->get('f') != $this->session->USERNAME ? $this->input->get('f') : null;
        $data['kantor'] = json_decode(file_get_contents(C_URL_API_JAIM."/master.php?r=1&p=$p"), true);
        $data['toppremi'] = json_decode(file_get_contents(C_URL_API_JAIM."/prestasi.php?r=3&p=$kw&p1=$kc"), true);

        $this->template->title = 'Top Premi';
        $this->template->content->view("prestasi/top_premi", $data);
        $this->template->publish();
    }
    
	/*===== list agen kancab/kanwil =====*/
    function list_agen_kancabwil() {
        check_user_role_menu(C_MENU_TOP_PREMI_WILAYAH);

        $p = $this->session->USERNAME;
        $kw = $this->input->get('f') == $this->session->USERNAME ? $this->input->get('f') : null;
        $kc = $this->input->get('f') != $this->session->USERNAME ? $this->input->get('f') : null;
        $data['kantor'] = json_decode(file_get_contents(C_URL_API_JAIM."/master.php?r=1&p=$p"), true);
        $data['toppremi'] = json_decode(file_get_contents(C_URL_API_JAIM."/prestasi.php?r=6&p=$kw&p1=$kc"), true);

        $this->template->title = 'Top Premi';
        $this->template->content->view("prestasi/top_premi", $data);
        $this->template->publish();
    }
}