<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobile extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->url = base_url('mobile');
        $this->account_url = base_url('account');
    }

    private function check_login() {
        if(!$this->session->IDUSER) {
            redirect("$this->url/login");
        }
    }

    function index() {
        $this->check_login();

        $this->load->view('mobile/dashboard');
    }

    function login() {
        $status = $this->session->flashdata('status');

        if ($status == C_STATUS_GAGAL_LOGIN_USERNAME) {
            $data['tampilkan'] = null;
            $data['pesan']     = C_PESAN_GAGAL_LOGIN_USERNAME;
        }
        else if ($status == C_STATUS_GAGAL_LOGIN_PASSWORD) {
            $data['tampilkan'] = null;
            $data['pesan']     = C_PESAN_GAGAL_LOGIN_PASSWORD;
        }
        else if ($status == C_STATUS_GAGAL_LOGIN_NONAKTIF) {
            $data['tampilkan'] = null;
            $data['pesan']     = C_PESAN_GAGAL_LOGIN_NONAKTIF;
        }
        else {
            $data['tampilkan'] = 'display-hide';
            $data['pesan']     = 'Email & kata sandi harus diisi';
        }

        $this->load->view('mobile/login', $data);
    }
	
    function ilustrasi() {
        $this->check_login();
        $this->load->model('mobile_model', 'mblmodel');

        $data['ilustrasi'] = $this->mblmodel->get_list_ilustrasi();

        $this->load->view('mobile/ilustrasi', $data);
    }
	
	function checkin() {

        $this->load->view('mobile/geodummy', $data);
    }

    function simulasi() {
		$idagen = $this->input->get('idagen');
		if ($idagen)
			$this->set_session($idagen);
		
		$this->check_login();
		
        $this->load->model('mobile_model', 'mblmodel');
		
        $filter['s'] = strtolower(trim($this->input->get('s')));
        $filter['p'] = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $filter['noagen'] = $this->session->USERNAME;
		$data['prospek'] = $this->mblmodel->get_list_prospek($filter);
		$data['idagen'] = $idagen; // jika idagen ada maka buka dari mobile app jika tidak dari website

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/simulasi";
        $config['total_rows'] = $this->mblmodel->get_total_prospek($filter);
        $this->pagination->initialize($config);

        $data['status'] = $this->session->flashdata('status');

        $this->load->view('mobile/daftar_prospek', $data);
    }

    function proposal() {
        $this->load->model('prospek_model', 'pspmodel');

        $data['prospek'] = $this->pspmodel->get_prospek($this->input->get('id'));
        $data['proposal'] = $this->pspmodel->get_list_proposal($this->input->get('id'));
        $data['status'] = $this->session->flashdata('status');

        $this->load->view('mobile/proposal', $data);
    }

    function followup_proposal() {
        $this->load->model('prospek_model', 'pspmodel');
        $this->load->model('master_model', 'mtrmodel');

        $data['statusproposal'] = $this->mtrmodel->get_list_status_proposal();
        $data['edited'] = array('KDSTATUS' => '', 'KETERANGAN' => '', 'NOSPAJ' => '', 'TGLSPAJ' => '', 'TGLPRESENTASI' => '', 'PREMI' => '', 'TGLPELUNASAN' => '', 'TGLPEMBATALAN' => '');
        $data['followup'] = $this->pspmodel->get_list_follow_up($this->input->get('bid'));
        $data['isdelete'] = $this->pspmodel->is_delete_followup($this->input->get('bid'));
        $data['status'] = $this->session->flashdata('status');

        $this->load->view('mobile/followup_proposal', $data);
    }

    function others() {
        $data['berita'] = json_decode(file_get_contents(C_URL_API_WEBJS."/dashboard.php?r=1"), true);
        $data['kurstransaksi'] = json_decode(file_get_contents(C_URL_API_JAIM."/dashboard.php?r=1"), true);
        $data['kursjsfixed'] = json_decode(file_get_contents(C_URL_API_JAIM."/dashboard.php?r=2"), true);
        $data['kursnabjual'] = json_decode(file_get_contents(C_URL_API_JAIM."/dashboard.php?r=3"), true);
        $data['kursnabbeli'] = json_decode(file_get_contents(C_URL_API_JAIM."/dashboard.php?r=4"), true);
        $data['kursnabnew'] = json_decode(file_get_contents(C_URL_API_JAIM."/dashboard.php?r=5"), true);

        $this->load->view('mobile/others', $data);
    }

    /*===== add function =====*/

    function add_simulasi() {
        $this->load->model('master_model', 'mtrmodel');

        $data['provinsi'] = $this->mtrmodel->get_list_provinsi();
		
        $this->load->view('mobile/add_prospek', $data);
    }

    function edit_simulasi() {
        $this->load->model('master_model', 'mtrmodel');
        $this->load->model('prospek_model', 'pspmodel');

        $data['prospek'] = $this->pspmodel->get_prospek($this->input->get('id'));
        $data['provinsi'] = $this->mtrmodel->get_list_provinsi();

        $this->load->view('mobile/edit_prospek', $data);
    }

    function edit_followup_proposal() {
        $this->load->model('prospek_model', 'pspmodel');
        $this->load->model('master_model', 'mtrmodel');

        $data['statusproposal'] = $this->mtrmodel->get_list_status_proposal();
        $data['edited'] = $this->pspmodel->get_follow_up($this->input->get('nf'));
        $data['followup'] = $this->pspmodel->get_list_follow_up($this->input->get('bid'));
        $data['isdelete'] = $this->pspmodel->is_delete_followup($this->input->get('bid'));
        $data['status'] = $this->session->flashdata('status');

        $this->load->view('mobile/followup_proposal', $data);
    }

    /*===== del function =====*/

    function del_simulasi() {
        $this->load->model('prospek_model', 'pspmodel');

        $status = $this->pspmodel->delete($this->input->get('id'));
        $this->session->set_flashdata('status', $status);

        redirect("$this->url/simulasi");
    }

    function del_proposal() {
        $this->load->model('prospek_model', 'pspmodel');

        $followup = $this->pspmodel->get_list_follow_up($this->input->get('id'));
        $no_prospek = count($followup) > 0 ? $followup[0]['NO_PROSPEK'] : null;
        $pdf_file = count($followup) > 0 ? $followup[0]['FILE_PDF'] : null;
        $status = $this->pspmodel->delete_proposal($this->input->get('id'));
        $this->session->set_flashdata('status', $status);

        // hapus file pdf simulasi
        $path = str_replace('/','\\',FCPATH)."simulasi\\files\pdf\\";
        $file = $pdf_file;
        unlink($path.$file);

        redirect("$this->url/proposal?id=$no_prospek");
    }

    function del_followup_proposal() {
        $this->load->model('prospek_model', 'pspmodel');

        $status = $this->pspmodel->delete_followup($this->input->get('nf'));
        $this->session->set_flashdata('status', $status);

        redirect("$this->url/followup-proposal?id=".$this->input->get('id')."&bid=".$this->input->get('bid'));
    }

    /*===== execute function =====*/
	
	private function set_session($username) {
		$this->load->model('user_model');
		
		$result = $this->user_model->get_user_by_id($username);
		
		$api = json_decode(file_get_contents(C_URL_API_JAIM."/agen.php?r=1&p=$username"), true);

		// copy image from API JAIM to localserver
		if ($result['KDROLE'] == 1) {
			$save_location = "asset/avatar/$api[AVATAR]";
			$from_location = file_get_contents(C_URL_API_JAIM."/avatar/".rawurlencode($api['AVATAR']));

			$fp = fopen($save_location, "w");
			fwrite($fp, $from_location);
			fclose($fp);
		}

		$sid = '';
		while (strlen($sid) < 32) {
			$sid .= mt_rand(0, mt_getrandmax());
		}
		$sid .= $this->input->ip_address();
					
		$session = array(
			'IDUSER' => $result['IDUSER'],
			'KDROLE' => $result['KDROLE'],
			'USERNAME' => strtoupper($username),
			'PASSWORD' => strtoupper($result['PASSWORD']),
			'NAMALENGKAP' => ($api ? $api['NAMALENGKAP'] : $result['NAMALENGKAP']),
			'KDJABATANAGEN' => ($api ? $api['KDJABATANAGEN'] : null),
			'KDKANTOR' => ($api ? $api['KDKANTOR'] : null),
			'KDAREAOFFICE' => ($api ? $api['KDAREAOFFICE'] : null),
			'KDUNITPRODUKSI' => ($api ? $api['KDUNITPRODUKSI'] : null),
			'AVATAR' => ($api ? $api['AVATAR'] : $result['AVATAR']),
			'POINTOUR' => $result['POINTOUR'],
			'NAMAKANTOR' => ($api ? $api['NAMAKANTOR'] : null),
			'PHONEKANTOR' => ($api ? $api['PHONEKANTOR'] : null),
			'EMAILKANTOR' => ($api ? $api['EMAILKANTOR'] : null),
			'NAMAINDUK' => ($api ? $api['NAMAINDUK'] : null),
			'PHONEINDUK' => ($api ? $api['PHONEINDUK'] : null),
			'EMAILINDUK' => ($api ? $api['EMAILINDUK'] : null),
			'SESSIONID' => md5(uniqid($sid, TRUE)),
			'IPADDRESS' => $this->input->ip_address(),
			'USERAGENT' => substr($this->input->user_agent(), 0, 120),
			'LASTACTIVITY' => date('d/m/Y H:i:s'),
			'USERDEVICE' => 'mobile'
		);

        $this->session->set_userdata($session);
	}

    function login_proses() {
        $this->load->model('user_model');

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $result = $this->user_model->get_user_by_id($username);

        if ($result) {
            if (strcasecmp($result['PASSWORD'], $password) == 0) {
                if ($result['KDROLE'] == C_ROLE_AGEN)
                    $api = json_decode(file_get_contents(C_URL_API_JAIM."/agen.php?r=1&p=$username"), true);
                else if ($result['KDROLE'] == C_ROLE_KANCAB || C_ROLE_KANWIL)
                    $api = json_decode(file_get_contents(C_URL_API_JAIM."/agen.php?r=9&p=".strtoupper($username)), true);

                if ($api['KDSTATUSAGEN'] == '01' || $result['KDROLE'] != 1) {

                    // copy image from API JAIM to localserver
                    if ($result['KDROLE'] == 1) {
                        $save_location = "asset/avatar/$api[AVATAR]";
                        $from_location = file_get_contents(C_URL_API_JAIM."/avatar/".rawurlencode($api['AVATAR']));

                        $fp = fopen($save_location, "w");
                        fwrite($fp, $from_location);
                        fclose($fp);
                    }

                    $sid = '';
                    while (strlen($sid) < 32) {
                        $sid .= mt_rand(0, mt_getrandmax());
                    }
                    $sid .= $this->input->ip_address();

                    $session = array(
                        'IDUSER' => $result['IDUSER'],
                        'KDROLE' => $result['KDROLE'],
                        'USERNAME' => strtoupper($username),
                        'PASSWORD' => strtoupper($password),
                        'NAMALENGKAP' => ($api ? $api['NAMALENGKAP'] : $result['NAMALENGKAP']),
                        'KDJABATANAGEN' => ($api ? $api['KDJABATANAGEN'] : null),
                        'KDKANTOR' => ($api ? $api['KDKANTOR'] : null),
                        'KDAREAOFFICE' => ($api ? $api['KDAREAOFFICE'] : null),
                        'KDUNITPRODUKSI' => ($api ? $api['KDUNITPRODUKSI'] : null),
                        'AVATAR' => ($api ? $api['AVATAR'] : $result['AVATAR']),
                        'POINTOUR' => $result['POINTOUR'],
                        'NAMAKANTOR' => ($api ? $api['NAMAKANTOR'] : null),
                        'PHONEKANTOR' => ($api ? $api['PHONEKANTOR'] : null),
                        'EMAILKANTOR' => ($api ? $api['EMAILKANTOR'] : null),
                        'NAMAINDUK' => ($api ? $api['NAMAINDUK'] : null),
                        'PHONEINDUK' => ($api ? $api['PHONEINDUK'] : null),
                        'EMAILINDUK' => ($api ? $api['EMAILINDUK'] : null),
                        'SESSIONID' => md5(uniqid($sid, TRUE)),
                        'IPADDRESS' => $this->input->ip_address(),
                        'USERAGENT' => substr($this->input->user_agent(), 0, 120),
                        'LASTACTIVITY' => date('d/m/Y H:i:s'),
						'USERDEVICE' => 'browser'
                    );

                    $this->session->set_userdata($session);

                    $this->user_model->update_user_info();

                    redirect($this->url);

                    exit;
                }
                else {
                    $status = C_STATUS_GAGAL_LOGIN_NONAKTIF;
                }
            }
            else {
                $status = C_STATUS_GAGAL_LOGIN_PASSWORD;
            }
        }
        else {
            $status = C_STATUS_GAGAL_LOGIN_USERNAME;
        }

        $this->session->set_flashdata('status', $status);

        redirect("$this->url/login");
    }

    function logout_proses() {
        $this->session->sess_destroy();

        redirect($this->url);
    }

    function simulasi_proses() {
        $this->load->model('prospek_model', 'pspmodel');

        $noprospek = $this->input->post('txtNoProspek');
        $nogenerate = $this->generate->id($this->session->KDKANTOR, true, true, date('d'), 6, null, $this->pspmodel->get_last_no_prospek());

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
            $status = $this->pspmodel->insert($data);
        }
        else {
            $status = $this->pspmodel->update($data);
        }
        $this->session->set_flashdata('status', $status);

        redirect("$this->url/simulasi");
    }

    function followup_proses() {
        $this->load->model('prospek_model', 'pspmodel');

        $nofollowup = $this->input->post('txtnofollowup');
        $nogenerate = $this->pspmodel->get_last_no_follow_up();

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
            $status = $this->pspmodel->insert_followup($data);
        }
        else {
            $status = $this->pspmodel->update_followup($data);
        }
        $this->session->set_flashdata('status', $status);

        redirect("$this->url/followup-proposal?id=".$this->input->post('txtnoprospek')."&bid=$data[BUILD_ID]");
    }
	
	function kurs() {
     
        $data['kurstransaksi'] = json_decode(file_get_contents(C_URL_API_JAIM."/dashboard.php?r=1"), true);
        $data['kursjsfixed'] = json_decode(file_get_contents(C_URL_API_JAIM."/dashboard.php?r=2"), true);
        $data['kursnabjual'] = json_decode(file_get_contents(C_URL_API_JAIM."/dashboard.php?r=3"), true);
        $data['kursnabbeli'] = json_decode(file_get_contents(C_URL_API_JAIM."/dashboard.php?r=4"), true);
        $data['kursnabnew'] = json_decode(file_get_contents(C_URL_API_JAIM."/dashboard.php?r=5"), true);

        $this->load->view('mobile/kurs', $data);
    }
	
	function ultah() {
	
		$noagen = $this->input->get('idagen');
        $data['ultah'] = json_decode(file_get_contents(C_URL_API_JAIM."/nasabah.php?r=3&p=".rawurlencode($noagen)), true);

        $this->load->view('mobile/ultah', $data);
	}
	
	function jatuhtempobenefit() {
        //check_user_role_menu(C_MENU_JATUHTEMPO_BENEFIT);

        $noagen = $this->input->get('idagen');
        $data['jatuhtempo'] = json_decode(file_get_contents(C_URL_API_JAIM."/nasabah.php?r=4&p=".rawurlencode($noagen)), true);

        $this->load->view('mobile/jatuhtempobenefit', $data);
    }
	
	function jatuhtempopremi() {
        //check_user_role_menu(C_MENU_JATUHTEMPO_PREMI);

        $noagen = $this->input->get('idagen');
        $data['jatuhtempo'] = json_decode(file_get_contents(C_URL_API_JAIM."/nasabah.php?r=5&p=".rawurlencode($noagen)), true);

        $this->load->view('mobile/jatuhtempopremi', $data);
    }
	
}