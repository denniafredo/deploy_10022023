<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
		//$this->output->enable_profiler(TRUE);
        $this->load->model('master_model');

        check_session_user();
        check_kuesioner();
        $this->url = base_url('dashboard');
    }

    public function index() {
	error_reporting(E_ERROR | E_PARSE);
        $this->load->model('user_model');
        $this->load->model('prestasi_model');
        
          /**
         * 
         * Conection Model untuk Super User
         * 
         */

        if ($this->session->KDROLE == 5 || $this->session->KDROLE == 6 ) {
            $data['nasabah_lapse_super'] = $this->user_model->get_jumlah_nasabah_lapse_super();
            $data['topape_super']        = $this->prestasi_model->get_list_top_ape_super();
            $data['toprekrut_super']    = $this->prestasi_model->get_list_top_rekrut_super();
            $data['toppolis_super']     = $this->prestasi_model->get_list_top_polis_super();
            $data['jumlah_rekrut_super'] = $this->user_model->get_total_jumlah_rekrut();
            $data['total_fyp_super'] = $this->user_model->get_total_fyp_super();
            $data['total_agen_aktif'] = $this->user_model->get_total_agen_aktif();
            $data['data_polis_dan_ape'] = $this->user_model->get_polis_and_ape_super();
            $data['total_polis_aktif_super'] = $this->user_model->get_polis_aktif_super();
            $data['total_polis_tebus_super'] = $this->user_model->get_polis_tebus_super();
            $data['total_polis_expirasi_super'] = $this->user_model->get_polis_expirasi_super();
            $data['kursnabnew'] = json_decode(file_get_contents(C_URL_API_JAIM."/dashboard.php?r=5"), true);
            /** total polis */
            $data['total_polis_super']           = $data['data_polis_dan_ape']['TOTAL_POLIS'];
            /**total ape */
            $data['total_ape_super']              = $data['data_polis_dan_ape']['TOTAL_APE']; 
            } else {
             /**
              * 
              * END
              */
    
            # created by Rizal
            /** total rekrut */
            $data['jumlah_rekrut'] = $this->user_model->get_jumlah_rekrut_by_id($this->session->USERNAME);
    
            /** total FYP */
            $data['total_fyp'] = $this->user_model->get_total_fyp($this->session->USERNAME);
    
            /** Get Man Power  */
            $data['agen_rekrut']            = $this->user_model->get_agen_rekrut_by_id($this->session->USERNAME);
            $data['jumlah_agen_aktif']      = $data['agen_rekrut']['JML_SEBAWAH'];
    
            $data['list_data'] = $this->user_model->get_polis_and_ape($this->session->USERNAME);
    
            $data['list_data2'] = $this->user_model->get_polis_aktif($this->session->USERNAME);
    
            /** total polis */
            $data['jumlah_polis']           = $data['list_data']['JML'];
            /** total polis katif **/
            $data['jumlah_polis_aktif']     = $data['list_data2']['JML'];
            /**total ape */
            $data['total_APE']              = $data['list_data']['ANP'];
           #end created by rizal
    
       
            
            $data['polpremkom'] = $this->user_model->get_polis_premi_komisi($this->session->USERNAME); //json_decode(file_get_contents(C_URL_API_JAIM."/agen.php?r=13&p=".$this->session->USERNAME), true);
            //$data['polis'] = $this->user_model->get_list_polis_by_id($this->session->USERNAME); //json_decode(file_get_contents(C_URL_API_JAIM."/agen.php?r=14&p=".$this->session->USERNAME), true);
            // $data['toppremi'] = $this->prestasi_model->get_list_top_premi($this->session->KDKANTOR); //json_decode(file_get_contents(C_URL_API_JAIM."/prestasi.php?r=3&p1=".$this->session->KDKANTOR), true);
            # CREATED ISMI
            $data['toppolis'] = $this->prestasi_model->get_list_top_polis($this->session->USERNAME); 
            $data['toprekrut']= $this->prestasi_model->get_list_top_rekrut($this->session->USERNAME); 
            $data['topape']   = $this->prestasi_model->get_list_top_ape($this->session->USERNAME);
            /* Komen dulu belum kepake :)
            $data['toppolis'] = $this->prestasi_model->get_list_top_polis($this->session->KDKANTOR); //json_decode(file_get_contents(C_URL_API_JAIM."/prestasi.php?r=4&p1=".$this->session->KDKANTOR), true);
            $data['toprekrut']= $this->prestasi_model->get_list_top_rekrut($this->session->KDKANTOR); //json_decode(file_get_contents(C_URL_API_JAIM."/prestasi.php?r=5&p1=".$this->session->KDKANTOR), true);
            $data['topape']   = $this->prestasi_model->get_list_top_ape($this->session->KDKANTOR); //json_decode(file_get_contents(C_URL_API_JAIM."/prestasi.php?r=6&p1=".$this->session->KDKANTOR), true);
            */
            # END CREATED ISMI
            $data['track'] = $this->user_model->get_list_proposal_pos_by_id($this->session->USERNAME); //json_decode(file_get_contents(C_URL_API_JAIM."/workbook.php?r=11&p=".$this->session->USERNAME), true);
            //$data['pointur'] = $this->user_model->get_poin_tur($this->session->USERNAME, "01/01/".date('Y'), "31/12/".date('Y')); //json_decode(file_get_contents(C_URL_API_JAIM."/agen.php?r=11&p=".$this->session->USERNAME."&p2=01/01/".date('Y')."&p3=31/12/".date('Y')), true);
            //$data['tour'] = $this->master_model->get_list_tour();
            $data['agen'] = $this->user_model->get_biodata_by_id($this->session->USERNAME); //json_decode(file_get_contents(C_URL_API_JAIM."/agen.php?r=2&p=".$this->session->USERNAME), true);
            $data['spaj_pending'] = $this->user_model->get_jumlah_spaj_pending($this->session->USERNAME); //json_decode(file_get_contents(C_URL_API_JAIM."/agen.php?r=2&p=".$this->session->USERNAME), true);
            $data['nasabah_lapse'] = $this->user_model->get_jumlah_nasabah_lapse($this->session->USERNAME); //json_decode(file_get_contents(C_URL_API_JAIM."/agen.php?r=2&p=".$this->session->USERNAME), true);
            $data['kurstransaksi'] = false;//json_decode(file_get_contents(C_URL_API_JAIM."/dashboard.php?r=1"), true);
            //$data['kursjsfixed'] = json_decode(file_get_contents(C_URL_API_JAIM."/dashboard.php?r=2"), true);
            //$data['kursnabjual'] = json_decode(file_get_contents(C_URL_API_JAIM."/dashboard.php?r=3"), true);
            //$data['kursnabbeli'] = json_decode(file_get_contents(C_URL_API_JAIM."/dashboard.php?r=4"), true);
            $data['kursnabnew'] = json_decode(file_get_contents(C_URL_API_JAIM."/dashboard.php?r=5"), true);
            $data['notif'] = $this->master_model->get_list_notifikasi();
            $data['ultah'] = count(json_decode(file_get_contents(C_URL_API_JAIM."/nasabah.php?r=3&p=".rawurlencode($this->session->USERNAME)), true));
            $data['jtbenefit'] = count(json_decode(file_get_contents(C_URL_API_JAIM."/nasabah.php?r=4&p=".rawurlencode($this->session->USERNAME)), true));
            $data['jtpremi'] = count(json_decode(file_get_contents(C_URL_API_JAIM."/nasabah.php?r=5&p=".rawurlencode($this->session->USERNAME)), true));
            }
            $data['popimages'] = $this->master_model->get_list_popimages();
            $data['popimage'] = $this->master_model->get_popimages();
            /* created by reza*/
            $data['cd'] = $this->user_model->countdown($this->session->USERNAME);

        $this->template->title = "Beranda";
        $this->template->content->view("dashboard", $data);
        $this->template->publish();
    }

    function getNasabahLapse(){

        $result = $this->user_model->get_data_nasabah_lapse($this->session->USERNAME);

        echo json_encode($result);
    }

    function getSpajPending(){

        $result = $this->user_model->get_data_spaj_pending($this->session->USERNAME);

        echo json_encode($result);
    }

    //statistik untuk admin menampilkan log total
    function getstatistikDay(){
		$data = $this->master_model->getStatistikDay();
		echo json_encode($data);
	}
	
	function getstatistikTotal(){
		$data = $this->master_model->getStatistikTotal();
		echo json_encode($data);
	}



    //function untuk data chart Tahun Berjalan
	function getChartTahun(){
		
		$noagen = $this->session->USERNAME;
		$kdkantor = $this->session->KDKANTOR;
		$kdjabatan = $this->session->KDJABATANAGEN;
		$data = $this->master_model->getDataChartTahun($noagen,$kdkantor,$kdjabatan);
		//var_dump($kdkantor);die;
		echo json_encode($data);
	}
	
    //function untuk data chart Bulan Berjalan
	function getChartBulan(){
		
		$noagen = $this->session->USERNAME;
		$kdkantor = $this->session->KDKANTOR;
		$kdjabatan = $this->session->KDJABATANAGEN;
		$data = $this->master_model->getDataChartBulan($noagen,$kdkantor,$kdjabatan);
		//var_dump($kdkantor);die;
		echo json_encode($data);
	}


    /*===== detail bod message =====*/
    function bodmsg($id) {
        $data['bodmsg'] = $this->master_model->get_bodmsg($id, false);

        $this->template->title = $data['bodmsg']['JUDUL'];
        $this->template->content->view("dashboard/bodmsg", $data);
        $this->template->publish();
    }


    /*===== detail agen of the month =====*/
    function aotm($id) {
        $data['aotm'] = $this->master_model->get_aotm($id);

        $this->template->title = "Agen of the Month";
        $this->template->content->view("dashboard/aotm", $data);
        $this->template->publish();
    }


    /*==================================================================================================================
                                            AREA MENU ADMINISTRATOR FRONT END
    ==================================================================================================================*/

    /*===== administrator frontend bod message =====*/
    function admin_bod_message() {
        check_user_role_menu(C_MENU_FRONTEND_BODMSG);

        $filter['s'] = strtolower(trim($this->input->get('s')));
        $filter['p'] = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $data['bodmsg'] = $this->master_model->get_list_bodmsg($filter);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/admin-bod-message?s=$filter[s]";
        $config['total_rows'] = $this->master_model->get_total_bodmsg($filter);
        $this->pagination->initialize($config);

        $data['status'] = $this->session->flashdata('status');
        $data['pesan'] = $this->session->flashdata('pesan');

        $this->template->title = 'Pesan BOD';
        $this->template->content->view("dashboard/admin_bod_message", $data);
        $this->template->publish();
    }


    /*===== add bod message administrator frontend =====*/
    function add_bod_message() {
        check_user_role_menu(C_MENU_FRONTEND_BODMSG);

        $this->template->title = "Tambah";
        $this->template->content->view("dashboard/add_bod_message");
        $this->template->publish();
    }


    /*===== edit bod message adminstrator frontend =====*/
    function edit_bod_message($id) {
        check_user_role_menu(C_MENU_FRONTEND_BODMSG);

        $data['bodmsg'] = $this->master_model->get_bodmsg($id);

        $this->template->title = $data['bodmsg']['JUDUL'];
        $this->template->content->view("dashboard/edit_bod_message", $data);
        $this->template->publish();
    }


    /*===== save bod message administrator frontend =====*/
    function save_bod_message() {
        check_user_role_menu(C_MENU_FRONTEND_BODMSG);

        $this->load->model('nomor_model');
        $idbodmsg = $this->input->post('idbodmsg');

        $data['IDBODMSG'] = empty($idbodmsg) ? $this->nomor_model->get_no_bod_msg() : $idbodmsg;
        $data['JUDUL'] = $this->input->post('judul');
        $data['PESAN'] = $this->input->post('pesan');
        $data['KDSTATUS'] = $this->input->post('status');
        $data['NAMA'] = $this->input->post('nama');
        $data['TEMPAT'] = $this->input->post('tempat');
        $data['USERREKAM'] = $this->session->USERNAME;

        // upload image file
        if ($_FILES['gambar']['size'] > 0) {
            $nmgambar = $data['IDBODMSG'].'_'.str_replace(' ', '-', strtolower($data['NAMA']));

            $config = array(
                "upload_path"	=> "asset/bodmsg/",
                "allowed_types"	=> "gif|jpg|jpeg|png",
                "overwrite"		=> TRUE,
                "max_size"		=> "5000",
                "max_width"		=> "1900",
                "max_height"	=> "1280",
                "file_name"     => $nmgambar
            );
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {
                $this->session->set_flashdata('status', C_STATUS_GAGAL_UPLOAD);
                $this->session->set_flashdata('pesan', $this->upload->display_errors());

                redirect("$this->url/admin-bod-message");
            }
            else {
                $finfo = $this->upload->data();
                $data['GAMBAR'] = $nmgambar.$finfo['file_ext'];
            }
        }

        if (!empty($data['JUDUL']) && !empty($data['PESAN']))
            $status = empty($idbodmsg) ? $this->master_model->insert_bodmsg($data) : $this->master_model->update_bodmsg($data);
        else
            $status = C_STATUS_GAGAL_SIMPAN;

        $this->session->set_flashdata('status', $status);

        redirect("$this->url/admin-bod-message");
    }


    /*===== aktifkan bod message administrator frontend =====*/
    function aktif_bod_message($id) {
        check_user_role_menu(C_MENU_FRONTEND_BODMSG);

        $data['IDBODMSG'] = $id;
        $data['KDSTATUS'] = 1;

        $status = $this->master_model->update_bodmsg($data);

        $this->session->set_flashdata('status', $status);

        redirect("$this->url/admin-bod-message");
    }


    /*===== delete bod message administrator frontend =====*/
    function delete_bod_message($id) {
        check_user_role_menu(C_MENU_FRONTEND_BODMSG);

        $bodmsg = $this->master_model->get_bodmsg($id);
        $status = $this->master_model->delete_bodmsg($id);

        if ($status && $bodmsg['GAMBAR']) {
            $file = FCPATH."asset\bodmsg\\$bodmsg[GAMBAR]";
            unlink($file);
        }

        $this->session->set_flashdata('status', $status);

        redirect("$this->url/admin-bod-message");
    }


    /*===== administrator frontend agen of the month =====*/
    function admin_aotm() {
        check_user_role_menu(C_MENU_FRONTEND_AOTM);

        $filter['s'] = strtolower(trim($this->input->get('s')));
        $filter['p'] = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $data['aotm'] = $this->master_model->get_list_aotm($filter);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/admin-aotm?s=$filter[s]";
        $config['total_rows'] = $this->master_model->get_total_aotm($filter);
        $this->pagination->initialize($config);

        $data['status'] = $this->session->flashdata('status');
        $data['pesan'] = $this->session->flashdata('pesan');

        $this->template->title = 'Agen of the Month';
        $this->template->content->view("dashboard/admin_aotm", $data);
        $this->template->publish();
    }


    /*===== add agen of the month administrator frontend =====*/
    function add_aotm() {
        check_user_role_menu(C_MENU_FRONTEND_AOTM);

        $this->template->title = "Tambah";
        $this->template->content->view("dashboard/add_aotm");
        $this->template->publish();
    }


    /*===== edit agen of the month administrator frontend =====*/
    function edit_aotm($id) {
        check_user_role_menu(C_MENU_FRONTEND_AOTM);

        $data['aotm'] = $this->master_model->get_aotm($id);

        $this->template->title = $data['aotm']['NAMA'];
        $this->template->content->view("dashboard/edit_aotm", $data);
        $this->template->publish();
    }


    /*===== save agen of the month administrator frontend =====*/
    function save_aotm() {
        check_user_role_menu(C_MENU_FRONTEND_AOTM);

        $this->load->model('nomor_model');
        $idagenmonth = $this->input->post('idagenmonth');

        $data['IDAGENMONTH'] = empty($idagenmonth) ? $this->nomor_model->get_no_aotm() : $idagenmonth;
        $data['NAMA'] = $this->input->post('nama');
        $data['PRAKATA'] = $this->input->post('prakata');
        $data['NARASI'] = $this->input->post('narasi');
        $data['KDSTATUS'] = $this->input->post('status');
        $data['NOAGEN'] = $this->input->post('noagen');
        $data['NAMAKANTOR'] = $this->input->post('kantor');
        $data['BULAN'] = $this->input->post('bulan');
        $data['TAHUN'] = $this->input->post('tahun');
        $data['USERREKAM'] = $this->session->USERNAME;

        // upload image file
        if ($_FILES['gambar']['size'] > 0) {
            $nmgambar = $data['IDAGENMONTH'].'_'.str_replace(' ', '-', strtolower($data['NAMA']));

            $config = array(
                "upload_path"	=> "asset/aotm/",
                "allowed_types"	=> "gif|jpg|jpeg|png",
                "overwrite"		=> TRUE,
                "max_size"		=> "5000",
                "max_width"		=> "1900",
                "max_height"	=> "1280",
                "file_name"     => $nmgambar
            );
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {
                $this->session->set_flashdata('status', C_STATUS_GAGAL_UPLOAD);
                $this->session->set_flashdata('pesan', $this->upload->display_errors());

                //redirect("$this->url/admin-aotm");
            }
            else {
                $finfo = $this->upload->data();
                $data['GAMBAR'] = $nmgambar.$finfo['file_ext'];
            }
        }

        if (!empty($data['NAMA']) && !empty($data['PRAKATA']))
            $status = empty($idagenmonth) ? $this->master_model->insert_aotm($data) : $this->master_model->update_aotm($data);
        else
            $status = C_STATUS_GAGAL_SIMPAN;

        $this->session->set_flashdata('status', $status);

        redirect("$this->url/admin-aotm");
    }


    /*===== delete agen of the month administrator frontend =====*/
    function delete_aotm($id) {
        check_user_role_menu(C_MENU_FRONTEND_AOTM);

        $aotm = $this->master_model->get_aotm($id);
        $status = $this->master_model->delete_aotm($id);

        if ($status && $aotm['GAMBAR']) {
            $file = FCPATH."asset\aotm\\$aotm[GAMBAR]";
            unlink($file);
        }

        $this->session->set_flashdata('status', $status);

        redirect("$this->url/admin-aotm");
    }


    /*===== administrator front end list user agen jaim =====*/
    function admin_user_agen_kancab_kanwil() {
        check_user_role_menu(C_MENU_FRONTEND_USERAGEN);

        $filter['s'] = strtolower(trim($this->input->get('s')));
        $filter['p'] = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $data['user'] = json_decode(file_get_contents(C_URL_API_JAIM."/dashboard.php?r=7&p=$filter[s]&p2=$filter[p]&p3=".C_ROWS_PAGINATION), true);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/admin-user-agen-kancab-kanwil?s=$filter[s]";
        $config['total_rows'] = file_get_contents(C_URL_API_JAIM."/dashboard.php?r=8&p=$filter[s]&p2=$filter[p]&p3=".C_ROWS_PAGINATION);
        $this->pagination->initialize($config);

        $this->template->title = 'Daftar User Agen Kancab Kanwil';
        $this->template->content->view("dashboard/admin_user_agen_kancab_kanwil", $data);
        $this->template->publish();
    }


    /*===== akses dasboard kantor pusat =====*/
    function dasbor() {
        check_user_role_menu(C_MENU_FRONTEND_DASBOR);
        $kdkantor = $this->session->KDROLE == 4 ? 'KP' : $this->session->USERNAME;

        $data['r'] = json_decode(file_get_contents(C_URL_API_JAIM."/dashboard.php?r=9&p=$kdkantor"), true);
        $data['formasi'] = json_decode(file_get_contents(C_URL_API_JAIM."/dashboard.php?r=10&p=$kdkantor"), true);
	$data['list_agen'] = json_decode($this->__get_agen($kdkantor), true);

        $this->template->title = "Dasbor Kantor ".$this->session->USERNAME;
        $this->template->content->view("dashboard/dasbor", $data);
        $this->template->publish();
    }
	
	function __get_agen($kdkantor){
		$res = file_get_contents(C_URL_API_JAIM."/master.php?r=6&p1=$kdkantor");
		return $res;
	}
	
	function get_profile_agen($idagen){
		echo file_get_contents(C_URL_API_JAIM."/agen.php?r=1&p=".$idagen);
	}

}