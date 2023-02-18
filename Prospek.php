<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prospek extends CI_Controller {


    function __construct() {
        parent::__construct();

        $this->load->model('master_model');

        if(@$this->uri->segment(2) != 'getfileupload'){
	        check_session_user();
	        check_kuesioner();
        }
        
        $this->url = base_url('prospek');
    }


	function index() {
		check_user_role_menu(C_MENU_PROSPEK_SAYA);
		
		$search = strtolower(trim($this->input->get('s')));
		$page = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
		$noagen = $this->session->USERNAME;
		$prospek = api_curl("/prospek/agen/$noagen/?search=$search&page=$page&per_page=".C_PAGE_JUMLAH, 'GET');
        $data['prospek'] = @$prospek['message'];

        $config['base_url'] = "$this->url/index";
		$total = api_curl("/prospek/agen/$noagen/?search=$search", 'GET');
		$config['total_rows'] = count(@$total['message']);
        $this->pagination->initialize($config);

        $data['status'] = $this->session->flashdata('status');
		$data['message'] = $this->session->flashdata('message');

        $this->template->title = 'Prospek Saya';
        $this->template->content->view("prospek/index", $data);
        $this->template->publish();
	}
	
	
	function add() {
		check_user_role_menu(C_MENU_PROSPEK_SAYA);

		$data['provinsi'] = api_curl("/master/provinsi", 'GET');
		$data['pekerjaan'] = api_curl("/master/pekerjaan", 'GET');
		$data['hobi'] = api_curl("/master/hobi", 'GET');

        $this->template->title = 'Tambah Data Prospek';
        $this->template->content->view("prospek/add", $data);
        $this->template->publish();
	}
	
	function edit() {
		check_user_role_menu(C_MENU_PROSPEK_SAYA);
		$noagen = $this->session->USERNAME;
		$noktp = $this->input->get('id');

		$prospek = @api_curl("/prospek/agen/$noagen/$noktp", 'GET')['message'];
		$data['prospek'] = $prospek;
		$data['provinsi'] = api_curl("/master/provinsi", 'GET');
		$data['kota'] = api_curl("/master/kota?kdprovinsi=$prospek[KDPROVINSI]", 'GET');
		$data['kecamatan'] = api_curl("/master/kecamatan?kdkotamadya=$prospek[KDKOTAMADYA]", 'GET');
		$data['kelurahan'] = api_curl("/master/kelurahan?kdkecamatan=$prospek[KDKECAMATAN]", 'GET');
		$data['pekerjaan'] = api_curl("/master/pekerjaan", 'GET');
		$data['hobi'] = api_curl("/master/hobi", 'GET');

        $this->template->title = 'Ubah Data Prospek';
        $this->template->content->view("prospek/edit", $data);
        $this->template->publish();
	}
	
	
	function save() {
		$result = api_curl("/prospek/agen", 'POST', $_POST);
		
		if (!@$result['error']) {
			$status = C_STATUS_SUKSES_SIMPAN;
			$message = null;
		} else {
			$status = C_STATUS_GAGAL_SIMPAN;
			$message = @$result['message'];
		}
		
		$this->session->set_flashdata('status', $status);
		$this->session->set_flashdata('message', $message);

        redirect("$this->url");
	}
	
	function uploadfile() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);
		$buildid = $this->input->get('buildid');
		$id = $this->input->get('id');
		
		$data = [
			'build' => $buildid,
			'noid' => $id
		];

		$this->template->title = 'Upload File Proposal';
        $this->template->content->view("prospek/uploadfile_recording", $data);
        $this->template->publish();
    }

    function getfileupload(){
    	$files = base64_decode($this->input->get('files'));
    	$file = FCPATH."api/jsspaj/assets/web/upload/{$files}";

    	if (file_exists($file)) {
			redirect("api/jsspaj/assets/web/upload/{$files}");
		}else{
			$this->load->library('ftp');
			$this->load->helper('download');

			$config['hostname'] = 'ftp://storage.ifg-life.id';
			$config['username'] = 'root';
			$config['password'] = 'ahc6y96uy7xik6x96hbwd94oi0f8ap';
			$config['debug']    = TRUE;
			$config['port']     = 21;
			
			$this->ftp->connect($config);

			$list = $this->ftp->list_files('/VOLUME1/JLINDO/WELCOME/'.$files);

			foreach ($list as $val) {
				$local = tempnam(sys_get_temp_dir(), $val);
				$download = $this->ftp->download($val, $local, FTP_BINARY);
				$data = file_get_contents($local);
				file_put_contents(FCPATH."api/jsspaj/assets/web/upload/{$val}",$data);
			}
			$this->ftp->close();
			redirect("api/jsspaj/assets/web/upload/{$files}");
		}
    }
	
	function proposal() {
		check_user_role_menu(C_MENU_PROSPEK_SAYA);
		

		$username = $this->session->USERNAME;
		$log = $this->master_model->postPOS_login($username);
		
		$noagen = $this->session->USERNAME;
		$noktp = $this->input->get('id');
		$kdjabatanagen = $this->session->KDJABATANAGEN;
		
		$prospek = @api_curl("/prospek/agen/$noagen/$noktp", 'GET')['message'];
		$data['prospek'] = $prospek;
		
		$data['produk'] = api_curl("/master/produk?kdjabatan=$kdjabatanagen", 'GET');
		
		$data['proposal'] = api_curl("/pos/agen/$noagen/$noktp", 'GET');
        $data['status'] = $this->session->flashdata('status');
		
		$data['key'] = @$this->session->TOKEN;
		

        $this->template->title = 'Proposal';
        $this->template->content->view("prospek/proposal", $data);
        $this->template->publish();
	}
	
	
	/*===== follow up =====*/
    function follow_up() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);
		$buildid = $this->input->get('buildid');

        $data['followup'] = @api_curl("/pos/status/$buildid", 'GET')['message'];
		$data['histories'] = @api_curl("/master/history-mutasi?buildId=$buildid", 'GET')['message'];
		$data['buildid'] = $buildid;
		
		if(!$data['histories']['data']){
			$data['histories']['data'] = [];
		}
		
	
        $this->template->title = 'Follow Up';
        $this->template->content->view("prospek/follow_up", $data);
        $this->template->publish();
    }
	
	function follow_up_polis() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);
		$buildid = $this->input->get('buildid');

        $data['followup'] = @api_curl("/pos/status/$buildid", 'GET')['message'];
		$data['histories'] = @api_curl("/master/history-mutasi?buildId=$buildid", 'GET')['message'];
		$data['buildid'] = $buildid;
		
        $this->template->title = 'Follow Up Polis';
        $this->template->content->view("prospek/follow_up_proposal", $data);
        $this->template->publish();
    }
	
	function save_followup_polis(){
		
		$result = api_curl("/master/followup-polis", 'POST', $_POST);
		
		if (@$result['status']) {
			$status = C_STATUS_SUKSES_SIMPAN;
			$message = null;
		} else {
			$status = C_STATUS_GAGAL_SIMPAN;
			$message = @$result['massage'];
		}
		
		$this->session->set_flashdata('status', $status);
		$this->session->set_flashdata('message', $message);

        redirect("$this->url/follow-up?buildid=".$this->input->post('buildId'));
	}
	
	
	function delete_proposal() {
		$noagen = $this->session->USERNAME;
		$buildid = $this->input->get('buildid');
		$id = $this->input->get('id');
		
		$result = api_curl("/pos/agen/$noagen/$buildid", 'DELETE');
		
		if (!@$result['error']) {
			$status = C_STATUS_SUKSES_SIMPAN;
			$message = null;
		} else {
			$status = C_STATUS_GAGAL_SIMPAN;
			$message = @$result['message'];
		}
		
		$this->session->set_flashdata('status', $status);
		$this->session->set_flashdata('message', $message);

        redirect("$this->url/proposal?id=$id");
	}
}