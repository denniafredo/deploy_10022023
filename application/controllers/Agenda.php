<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('agenda_model');

        check_session_user();
        check_kuesioner();
        $this->url = base_url('agenda');
    }


    /*===== daftar agenda pribadi =====*/
    function daftar_pribadi() {
        check_user_role_menu(C_MENU_AGENDA_SAYA);

        $filter['s'] = strtolower(trim($this->input->get('s')));
        $filter['p'] = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $filter['noagen'] = $this->session->USERNAME;
        $data['agenda'] = $this->agenda_model->get_list_agenda($filter);
        $data['status'] = $this->session->flashdata('status');

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/daftar-pribadi";
        $config['total_rows'] = $this->agenda_model->get_total_agenda($filter);
        $this->pagination->initialize($config);

        $this->template->title = 'Daftar Agenda Saya';
        $this->template->content->view("agenda/daftar_pribadi", $data);
        $this->template->publish();
    }


    /*===== daftar checkin pribadi =====*/
    function daftar_checkin() {
        check_user_role_menu(C_MENU_AGENDA_SAYA);
        $noagen = $this->session->USERNAME;

        //$all = glob("/mobileapi/incoming/*_$noagen.json");
        $folder = FCPATH."mobileapi/incoming/";
        $arr_file = array_diff(scandir($folder), array('..', '.'));

        foreach ($arr_file as $i => $v) {
            if (strpos($v, "_$noagen.json")) {
                $string = file_get_contents(FCPATH."mobileapi/incoming/$v");
                $json = json_decode($string, true);
                $file[] = $json;
            }
        }

        $data['checkin'] = $file;

        $this->template->title = 'Daftar Checkin';
        $this->template->content->view("agenda/daftar_checkin", $data);
        $this->template->publish();
        //var_dump($data);
    }


    /*===== ubah data agenda daftar pribadi =====*/
    function edit_daftar_pribadi() {
        check_user_role_menu(C_MENU_AGENDA_SAYA);

        $noagenda = $this->input->post("txtNoAgenda");
        $data['NOAGEN'] = $this->session->USERNAME;
        $data['AGENDA'] = $this->input->post('txtAgenda');
        $data['TGLMULAI'] = $this->input->post('txtTglAwal');
        $data['TGLSELESAI'] = $this->input->post('txtTglAkhir');

        $status = $this->agenda_model->update($noagenda, $data);
        $this->session->set_flashdata('status', $status);

        redirect("$this->url/daftar-pribadi");
    }


    /*===== hapus data agenda daftar pribadi =====*/
    function hapus_daftar_pribadi() {
        check_user_role_menu(C_MENU_AGENDA_SAYA);

        $noagenda = $this->input->get('id');
        $status = $this->agenda_model->delete($noagenda);

        $this->session->set_flashdata('status', $status);

        redirect("$this->url/daftar-pribadi");
    }


    /*===== data kalender agenda pribadi =====*/
    function pribadi() {
        check_user_role_menu(C_MENU_AGENDA_SAYA);

        $filter['s'] = null;
        $filter['p'] = 1;
        $filter['noagen'] = $this->session->USERNAME;
        $data['agenda'] = $this->agenda_model->get_list_agenda($filter);
        $data['status'] = $this->session->flashdata('status');

        $this->template->title = 'Agenda Saya';
        $this->template->content->view("agenda/pribadi", $data);
        $this->template->publish();
    }


    /*===== ubah data agenda pribadi =====*/
    function edit_pribadi() {
        check_user_role_menu(C_MENU_AGENDA_SAYA);

        $noagenda = $this->input->post("txtNoAgendaBaru");
        $data['NOAGEN'] = $this->session->USERNAME;
        $data['AGENDA'] = $this->input->post('txtAgenda');
        $data['TGLMULAI'] = $this->input->post('txtTglAwal');
        $data['TGLSELESAI'] = $this->input->post('txtTglAkhir');

        if (empty($noagenda)) {
            $data['NOAGENDA'] = $this->generate->id("WA", true, true, null, 6, null, $this->agenda_model->get_last_no_agenda());

            $status = $this->agenda_model->insert($data);
        }
        else {
            $status = $this->agenda_model->update($noagenda, $data);
        }

        $this->session->set_flashdata('status', $status);

        redirect("$this->url/pribadi");
    }


    /*===== hapus data agenda pribadi =====*/
    function hapus_pribadi() {
        check_user_role_menu(C_MENU_AGENDA_SAYA);

        $noagenda = $this->input->get('id');
        $status = $this->agenda_model->delete($noagenda);

        $this->session->set_flashdata('status', $status);

        redirect("$this->url/pribadi");
    }


    /*===== daftar agenda binaan =====*/
    function binaan() {
        check_user_role_menu(C_MENU_AGENDA_BINAAN);

        $s = strtolower(trim($this->input->get('s')));
        $p = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $kdkantor = $this->session->KDKANTOR;
        $noagen = $this->session->USERNAME;
        $areaoffice = rawurlencode($this->session->KDAREAOFFICE);
        $unitproduksi = rawurlencode($this->session->KDUNITPRODUKSI);
        $data['agendabinaan'] = json_decode(file_get_contents(C_URL_API_JAIM."/workbook.php?r=1&p=".rawurlencode($p)."&p2=".rawurlencode(C_ROWS_PAGINATION)."&p3=".rawurlencode($kdkantor)."&p4=".rawurlencode($noagen)."&p5=".rawurlencode($s)."&p6=$areaoffice&p7=$unitproduksi"), true);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/binaan?s=$s";
        $config['total_rows'] = file_get_contents(C_URL_API_JAIM."/workbook.php?r=2&p=".rawurlencode($p)."&p2=".rawurlencode(C_ROWS_PAGINATION)."&p3=".rawurlencode($kdkantor)."&p4=".rawurlencode($noagen)."&p5=".rawurlencode($s)."&p6=$areaoffice&p7=$unitproduksi");
        $this->pagination->initialize($config);

        $this->template->title = 'Agenda Binaan';
        $this->template->content->view("agenda/binaan", $data);
        $this->template->publish();
    }


    /*===== daftar agenda binaan by id =====*/
    function agenda_binaan() {
        check_user_role_menu(C_MENU_AGENDA_BINAAN);

        $data['namaagen'] = ucwords($this->input->get('nm'));
        $data['noagen'] = $this->input->get('id');
        $data['urlback'] = "binaan";

        $filter['s'] = strtolower(trim($this->input->get('s')));
        $filter['p'] = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $filter['noagen'] = $data['noagen'];
        $data['agenda'] = $this->agenda_model->get_list_agenda($filter);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/agenda-binaan?id=$data[noagen]&nm=$data[namaagen]&s=$filter[s]";
        $config['total_rows'] = $this->agenda_model->get_total_agenda($filter);
        $this->pagination->initialize($config);

        $this->template->title = "Daftar Agenda Agen $data[namaagen] ($data[noagen])";
        $this->template->content->view("agenda/agenda_agen", $data);
        $this->template->publish();
    }


    /*===== daftar agenda agen per cabang =====*/
    function agen_se_cabang() {
        check_user_role_menu(C_MENU_AGENDA_AGEN_SE_CABANG);

        $s = strtolower(trim($this->input->get('s')));
        $p = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $kdkantor = $this->session->USERNAME;
        $noagen = "0000000000";
        $data['agendacabang'] = json_decode(file_get_contents(C_URL_API_JAIM."/workbook.php?r=1&p=".rawurlencode($p)."&p2=".rawurlencode(C_ROWS_PAGINATION)."&p3=".rawurlencode($kdkantor)."&p4=".rawurlencode($noagen)."&p5=".rawurlencode($s)), true);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/agen-se-cabang?s=$s";
        $config['total_rows'] = file_get_contents(C_URL_API_JAIM."/workbook.php?r=2&p=".rawurlencode($p)."&p2=".rawurlencode(C_ROWS_PAGINATION)."&p3=".rawurlencode($kdkantor)."&p4=".rawurlencode($noagen)."&p5=".rawurlencode($s));
        $this->pagination->initialize($config);

        $this->template->title = 'Agenda Agen';
        $this->template->content->view("agenda/agen_se_cabang", $data);
        $this->template->publish();
    }


    /*===== daftar agenda agen cabang by id =====*/
    function agenda_agen_se_cabang() {
        check_user_role_menu(C_MENU_AGENDA_AGEN_SE_CABANG);

        $data['namaagen'] = ucwords($this->input->get('nm'));
        $data['noagen'] = $this->input->get('id');
        $data['urlback'] = "agen-se-cabang";

        $filter['s'] = strtolower(trim($this->input->get('s')));
        $filter['p'] = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $filter['noagen'] = $data['noagen'];
        $data['agenda'] = $this->agenda_model->get_list_agenda($filter);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/agenda-agen-se-cabang?id=$data[noagen]&nm=$data[namaagen]&s=$filter[s]";
        $config['total_rows'] = $this->agenda_model->get_total_agenda($filter);
        $this->pagination->initialize($config);

        $this->template->title = "Daftar Agenda Agen $data[namaagen] ($data[noagen])";
        $this->template->content->view("agenda/agenda_agen", $data);
        $this->template->publish();
    }


    /*===== daftar agenda agen per wilayah =====*/
    function agen_se_wilayah() {
        check_user_role_menu(C_MENU_AGENDA_AGEN_SE_WILAYAH);

        $data['cabang'] = json_decode(file_get_contents(C_URL_API_JAIM."/master.php?r=1&p=".rawurlencode($this->session->USERNAME)), true);

        $s = strtolower(trim($this->input->get('s')));
        $p = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $kdkantor = $this->input->get('ktr');
        $noagen = "0000000000";
        $data['agendawilayah'] = json_decode(file_get_contents(C_URL_API_JAIM."/workbook.php?r=1&p=".rawurlencode($p)."&p2=".rawurlencode(C_ROWS_PAGINATION)."&p3=".rawurlencode($kdkantor)."&p4=".rawurlencode($noagen)."&p5=".rawurlencode($s)), true);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/agen-se-wilayah?ktr=$kdkantor&s=$s";
        $config['total_rows'] = file_get_contents(C_URL_API_JAIM."/workbook.php?r=2&p=".rawurlencode($p)."&p2=".rawurlencode(C_ROWS_PAGINATION)."&p3=".rawurlencode($kdkantor)."&p4=".rawurlencode($noagen)."&p5=".rawurlencode($s));
        $this->pagination->initialize($config);

        $this->template->title = 'Agenda Agen';
        $this->template->content->view("agenda/agen_se_wilayah", $data);
        $this->template->publish();
    }


    /*===== daftar agenda agen wilayah by id =====*/
    function agenda_agen_se_wilayah() {
        check_user_role_menu(C_MENU_AGENDA_AGEN_SE_WILAYAH);

        $data['namaagen'] = ucwords($this->input->get('nm'));
        $data['noagen'] = $this->input->get('id');
        $data['urlback'] = "agen-se-wilayah?ktr=".rawurlencode($this->input->get('ktr'));

        $filter['s'] = strtolower(trim($this->input->get('s')));
        $filter['p'] = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $filter['noagen'] = $data['noagen'];
        $data['agenda'] = $this->agenda_model->get_list_agenda($filter);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/agenda-agen-se-wilayah?id=$data[noagen]&nm=$data[namaagen]&s=$filter[s]";
        $config['total_rows'] = $this->agenda_model->get_total_agenda($filter);
        $this->pagination->initialize($config);

        $this->template->title = "$data[namaagen] ($data[noagen])";
        $this->template->content->view("agenda/agenda_agen", $data);
        $this->template->publish();
    }
}