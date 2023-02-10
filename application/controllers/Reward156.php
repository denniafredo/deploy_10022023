<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reward156 extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->url = base_url('reward156');
    }


    /*===== kategori polis =====*/
    function polis() {
        check_session_user();
        check_kuesioner();
        check_user_role_menu(C_MENU_KONTES_REWARD_156);

        $data['polis'] = json_decode(file_get_contents(C_URL_API_JAIM."/kontes.php?r=1"), true);

        $this->template->title = 'Reward 156';
        $this->template->content->view("kontes/reward156_polis", $data);
        $this->template->publish();
    }


    /*===== kategori premi =====*/
    function premi() {
        check_session_user();
        check_kuesioner();
        check_user_role_menu(C_MENU_KONTES_REWARD_156);

        $data['premi'] = json_decode(file_get_contents(C_URL_API_JAIM."/kontes.php?r=2"), true);

        $this->template->title = 'Reward 156';
        $this->template->content->view("kontes/reward156_premi", $data);
        $this->template->publish();
    }


    /*===== kategori rekrut =====*/
    function rekrut() {
        session_destroy();

        $noagen = $this->input->get('noagen');
        $kdkelas = $this->input->get('kdkelas');
        $session = json_decode(file_get_contents(C_URL_API_JAIM."/agenda.php?r=0"), true);
        $this->session->set_userdata($session); var_dump($session);

        if ($noagen == '') {
            $data['rekrut'] = json_decode(file_get_contents(C_URL_API_JAIM."/kontes.php?r=2"), true);
        }
        else if ($noagen != '' && $kdkelas == '') {
            $data['rekrut'] = json_decode(file_get_contents(C_URL_API_JAIM."/kontes.php?r=2"), true);
            $no = json_decode(file_get_contents(C_URL_API_JAIM."/agenda.php?r=1&p=$noagen"), true);
            if ($no) {
                $data['noagen'] = $no;
            }
            else {
                redirect('http://jaim.jiwasraya.co.id');
            }
        }
        else if ($kdkelas != '') {
            $data['rekrut'] = json_decode(file_get_contents(C_URL_API_JAIM."/kontes.php?r=2"), true);
            $data['pesen'] = file_get_contents(C_URL_API_JAIM."/agenda.php?r=2&p=$noagen&p2=$kdkelas");
        }

        $this->template->title = 'Reward 156';
        $this->template->content->view("kontes/reward156_rekrut", $data);
        $this->template->publish();
    }
}