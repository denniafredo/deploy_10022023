<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Learning extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('master_model');

        check_session_user();
        check_kuesioner();
        $this->url = base_url('learning');
    }


    /*===== daftar tabel ebook =====*/
    function ebook() {
        check_user_role_menu(C_MENU_LEARNING_EBOOK);

        $filter['s'] = strtolower(trim($this->input->get('s')));
        $filter['p'] = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $data['ebook'] = $this->master_model->get_list_ebook($filter);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/ebook";
        $config['total_rows'] = $this->master_model->get_total_ebook($filter);
        $this->pagination->initialize($config);

        $this->template->title = "Ebook";
        $this->template->content->view("learning/ebook", $data);
        $this->template->publish();
    }


    /*===== daftar tabel video =====*/
    function video() {
        check_user_role_menu(C_MENU_LEARNING_VIDEO);

        $filter['s'] = strtolower(trim($this->input->get('s')));
        $filter['p'] = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $data['video'] = $this->master_model->get_list_video($filter);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/video";
        $config['total_rows'] = $this->master_model->get_total_video($filter);
        $this->pagination->initialize($config);

        $this->template->title = "Video";
        $this->template->content->view("learning/video", $data);
        $this->template->publish();
    }
	
	
    /*===== daftar tabel e-sertifikat =====*/
    function esertifikat() {
        check_user_role_menu(C_MENU_LEARNING_ESERTIFIKAT);
        
        $filter['s'] = strtolower(trim($this->input->get('s')));
        $filter['p'] = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $data['esertifikat'] = $this->master_model->get_list_esertifikat($filter);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/esertifikat";
        $config['total_rows'] = $this->master_model->get_total_esertifikat($filter);
        $this->pagination->initialize($config);

        $this->template->title = "E-Sertifikat";
        $this->template->content->view("learning/esertifikat", $data);
        $this->template->publish();
    }
    
    /*===== cetak e-sertifikat =====*/
    function print_esertifikat() {
        $nopelatihan = $this->input->get('nopelatihan');
        $noagen = $this->input->get('noagen');
        $this->load->library('fpdf/FPDF');
        
        $pelatihan = $this->master_model->get_esertifikat($nopelatihan, $noagen);
        $data['pelatihan'] = $pelatihan;
        
        /*if (!$pelatihan['CETAKAGEN']) {
            file_get_contents(C_URL_API_JAIM."/agen.php?r=15&p=$pelatihan[NOPELATIHAN]&p2=$pelatihan[NOAGEN]");
        }*/
        
        $this->load->view('learning/print_esertifikat', $data);
    }
}