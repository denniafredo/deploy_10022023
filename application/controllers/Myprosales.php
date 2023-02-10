<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myprosales extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('myprosales_model');

        check_session_user();
        check_kuesioner();
        $this->url = base_url('myprosales');
    }

    /*===== data indeks =====*/
    function indeks() {
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
		
		
		if (!empty($file)) {
			$data['checkin'] = $file;
		}
		
        $filter['s'] = null;
        $filter['p'] = 1;
        $filter['noagen'] = $this->session->USERNAME;
		
		$data['userdata'] = $this->myprosales_model->get_token_agen($filter['noagen']);
        $data['appversion'] = $this->myprosales_model->get_app_version();
        $data['status'] = "";
		
        $this->template->title = 'My Pro Sales';
        $this->template->content->view("myprosales/indeks", $data);
        $this->template->publish();
    }



    /*===== simpan historis download =====*/
    function save_historis_dl() {
        $url = $this->input->get('url');
        $appversion = $this->myprosales_model->get_app_version();
        $username = $this->input->get('u');

        $data['username'] = strlen($username) > 0 ? $username : $this->session->userdata('USERNAME');
        $data['ipaddress'] = $this->input->ip_address();
        $data['useragent'] = substr($this->input->user_agent(), 0, 120);
        $data['noappversion'] = $appversion['NOAPPVERSION'];

        $this->myprosales_model->insert_historis_dl($data);

        redirect(base_url($url));
    }
}