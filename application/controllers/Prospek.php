<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prospek extends CI_Controller {


    function __construct() {
        parent::__construct();

        $this->load->model('master_model');

        check_session_user();
        check_kuesioner();
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

        $this->template->title = 'Proposal';
        $this->template->content->view("prospek/proposal", $data);
        $this->template->publish();
	}
	
	
	/*===== follow up =====*/
    function follow_up() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);
		$buildid = $this->input->get('buildid');

        $data['followup'] = @api_curl("/pos/status/$buildid", 'GET')['message'];

        $this->template->title = 'Follow Up';
        $this->template->content->view("prospek/follow_up", $data);
        $this->template->publish();
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