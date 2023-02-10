<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asuransimikro extends CI_Controller {

    function __construct() {
        parent::__construct();
	check_session_user();
    }


    /*===== asuransi mikro demam berdarah =====*/
    function demam_berdarah() {
	check_user_role_menu(C_MENU_ASURANSI_DEMAM_BERDARAH);

	$data['username'] = $this->session->USERNAME;

	$this->template->title = 'Asuransi Demam Berdarah';
        $this->template->content->view("asuransimikro/demam_berdarah", $data);
        $this->template->publish();
    }


    /*===== asuransi mikro mikro sahabat =====*/
    function mikro_sahabat() {
	check_user_role_menu(C_MENU_ASURANSI_MIKRO_SAHABAT);

	$data['username'] = $this->session->USERNAME;

	$this->template->title = 'Asuransi Mikro Sahabat';
        $this->template->content->view("asuransimikro/mikro_sahabat", $data);
        $this->template->publish();
    }


    /*===== asuransi mikro travel insurance =====*/
    function travel_insurance() {
	check_user_role_menu(C_MENU_ASURANSI_TRAVEL_INSURANCE);

	$data['username'] = $this->session->USERNAME;

	$this->template->title = 'Asuransi Travel Insurance';
        $this->template->content->view("asuransimikro/travel_insurance", $data);
        $this->template->publish();
    }


    /*===== rekap asuransi mikro =====*/
    function rekap() {
	check_user_role_menu(C_MENU_ASURANSI_REKAP);

	$data['username'] = $this->session->USERNAME;

	$this->template->title = 'Rekap Asuransi Mikro';
        $this->template->content->view("asuransimikro/rekap", $data);
        $this->template->publish();
    }
}