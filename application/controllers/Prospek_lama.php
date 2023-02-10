<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prospek extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('prospek_model');
        $this->load->model('master_model');

        check_session_user();
        check_kuesioner();
        $this->url = base_url('prospek');
    }


    /*===== daftar prospek pribadi =====*/
    function pribadi() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $filter['s'] = strtolower(trim($this->input->get('s')));
        $filter['p'] = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $filter['noagen'] = $this->session->USERNAME;
        $data['prospek'] = $this->prospek_model->get_list_prospek($filter);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/pribadi";
        $config['total_rows'] = $this->prospek_model->get_total_prospek($filter);
        $this->pagination->initialize($config);

        $data['status'] = $this->session->flashdata('status');

        $this->template->title = 'Prospek Saya';
        $this->template->content->view("prospek/pribadi", $data);
        $this->template->publish();
    }
	
	function pribadis() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $search = strtolower(trim($this->input->get('s')));
        $data['prospek'] = $this->prospek_model->get_list_prospeks($search, true);

        $config['base_url'] = "$this->url/pribadi";
        $config['total_rows'] = count($this->prospek_model->get_list_prospeks($search, false));
        $this->pagination->initialize($config);

        $data['status'] = $this->session->flashdata('status');

        $this->template->title = 'Prospek Saya';
        $this->template->content->view("prospek/pribadi", $data);
        $this->template->publish();
    }


    /*===== tambah prospek pribadi =====*/
    function add_pribadi() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);
        $this->load->model('master_model');

        $data['produk'] = json_decode(file_get_contents(C_URL_API_JAIM."/workbook.php?r=2&p=".rawurlencode($this->session->KDKANTOR)), true);
        $data['provinsi'] = $this->master_model->get_list_provinsi();
        $data['jenispekerjaan'] = $this->master_model->get_list_pekerjaan();
        $data['hobi'] = $this->master_model->get_list_hobi();

        $this->template->title = 'Tambah Data Prospek';
        $this->template->content->view("prospek/add_pribadi", $data);
        $this->template->publish();
    }

    /*===== tambah prospek pribadi dengan tambahan pekerjaan Teguh 17/09/2019=====*/
    // function add_pribadi_new() {
    //     check_user_role_menu(C_MENU_PROSPEK_SAYA);
    //     $this->load->model('master_model');

    //     $data['produk'] = json_decode(file_get_contents(C_URL_API_JAIM."/workbook.php?r=2&p=".rawurlencode($this->session->KDKANTOR)), true);
    //     $data['provinsi'] = $this->master_model->get_list_provinsi();
    //     $data['jenispekerjaan'] = $this->master_model->get_list_pekerjaan();
    //     $this->template->title = 'Tambah Data Prospek';
    //     $this->template->content->view("prospek/add_pribadi_pkj", $data);
    //     $this->template->publish();
    // }


    /*===== edit prospek pribadi =====*/
    function edit_pribadi() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);
        $this->load->model('master_model');

        $data['prospek'] = $this->prospek_model->get_prospek($this->input->get('id'));
        $data['provinsi'] = $this->master_model->get_list_provinsi();
        $data['jenispekerjaan'] = $this->master_model->get_list_pekerjaan();
        $data['hobi'] = $this->master_model->get_list_hobi();

        $this->template->title = 'Ubah Data Prospek';
        $this->template->content->view("prospek/edit_pribadi", $data);
        $this->template->publish();
    }

    /*===== edit prospek pribadi dengan tambahan pekerjaan Teguh 17/09/2019=====*/
    // function edit_pribadi_new() {
    //     check_user_role_menu(C_MENU_PROSPEK_SAYA);
    //     $this->load->model('master_model');

    //     $data['prospek'] = $this->prospek_model->get_prospek_new($this->input->get('id'));
    //     $data['provinsi'] = $this->master_model->get_list_provinsi();
    //     $data['jenispekerjaan'] = $this->master_model->get_list_pekerjaan();

    //     $this->template->title = 'Ubah Data Prospek';
    //     $this->template->content->view("prospek/edit_pribadi_pkj", $data);
    //     $this->template->publish();
    // }


    /*===== hapus prospek pribadi =====*/
    function delete_pribadi() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $status = $this->prospek_model->delete($this->input->get('id'));
        $this->session->set_flashdata('status', $status);

        redirect("$this->url/pribadi");
    }


    /*===== simpan prospek pribadi =====*/
    function save_pribadi() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $noprospek = $this->input->post('txtNoProspek');
        $nogenerate = $this->prospek_model->gen_no_prospek($this->session->KDKANTOR);
        $kdjenispekerjaan = $this->input->post('kdPekerjaan');
        $noktp = $this->input->post('noKTP');
        $exist = $this->prospek_model->get_prospekbyktp($noktp);
		$existprospek = $this->prospek_model->get_prospek($noprospek);

        $data['NOPROSPEK'] = empty($noprospek) ? $nogenerate : $noprospek;
        $data['NOAGEN'] = $this->input->post('txtNoAgen');
        $data['KDKANTOR'] = $this->session->KDKANTOR;
        $data['KDAREAOFFICE'] = $this->session->KDAREAOFFICE;
        $data['KDUNITPRODUKSI'] = $this->session->KDUNITPRODUKSI;
        $data['KDJABATANAGEN'] = $this->session->KDJABATANAGEN;
        $data['KDJENISPEKERJAAN'] = empty($kdjenispekerjaan) ? 'null' : $kdjenispekerjaan;
		$data['KDHOBI'] = $this->input->post('kdHobi');
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
		$data['NO_KTP'] = $noktp;

        if ($exist && !$existprospek) {
            $status = C_STATUS_GAGAL_SIMPAN_KTP;
        } else if (!$exist && empty($noprospek)) {
            $status = $this->prospek_model->insert($data);
        }
        else {
            $status = $this->prospek_model->update($data);
        }
        $this->session->set_flashdata('status', $status);

        redirect("$this->url/pribadi");
    }

     /*===== simpan prospek pribadi =====*/
    function save_pribadi_new() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $noprospek = $this->input->post('txtNoProspek');
        $nogenerate = $this->generate->id($this->session->KDKANTOR, true, true, date('d'), 6, null, $this->prospek_model->get_last_no_prospek());

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
        $data['KDJENISPEKERJAAN'] = $this->input->post('kdPekerjaan');
        $data['NO_KTP'] = $this->input->post('noKTP');

        if (empty($noprospek)) {
            $status = $this->prospek_model->insert_new($data);
        }
        else {
            $status = $this->prospek_model->update_new($data);
        }
        $this->session->set_flashdata('status', $status);

        redirect("$this->url/pribadi");
    }

    /*===== data proposal prospek =====*/
    function proposal_pribadi() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $data['prospek'] = $this->prospek_model->get_prospek($this->input->get('id'));
        //$data['proposal'] = $this->prospek_model->get_list_proposal($this->input->get('id'));
        $data['proposal'] = json_decode(file_get_contents(C_URL_API_JAIM."/workbook.php?r=9&p=".rawurlencode($this->input->get('id'))), true);
        $data['status'] = $this->session->flashdata('status');
		$data['produk'] = $this->master_model->get_list_produk();

        if ($data['prospek']['NOAGEN'] != $this->session->USERNAME) {
            redirect("$this->url/pribadi");
        }

        $this->template->title = 'Proposal';
        $this->template->content->view("prospek/proposal_pribadi", $data);
        $this->template->publish();
    }


    /*===== hapus proposal pribadi =====*/
    function delete_proposal_pribadi() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $followup = $this->prospek_model->get_list_follow_up($this->input->get('id'));
        $no_prospek = count($followup) > 0 ? $followup[0]['NO_PROSPEK'] : null;
        $pdf_file = count($followup) > 0 ? $followup[0]['FILE_PDF'] : null;
        $status = $this->prospek_model->delete_proposal($this->input->get('id'));
        $this->session->set_flashdata('status', $status);

        // hapus file pdf simulasi
        $path = str_replace('/','\\',FCPATH)."simulasi\\files\pdf\\";
        $file = $pdf_file;
        unlink($path.$file);

        redirect("$this->url/proposal-pribadi?id=$no_prospek");
    }


    /*===== follow up proposal =====*/
    function follow_up_proposal() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $data['statusproposal'] = $this->master_model->get_list_status_proposal();
        $data['edited'] = array('KDSTATUS' => '', 'KETERANGAN' => '', 'NOSPAJ' => '', 'TGLSPAJ' => '', 'TGLPRESENTASI' => '', 'PREMI' => '', 'TGLPELUNASAN' => '', 'TGLPEMBATALAN' => '');
        $data['followup'] = json_decode(file_get_contents(C_URL_API_JAIM."/workbook.php?r=10&p=".rawurlencode($this->input->get('id'))), true);
        $data['isdelete'] = $this->prospek_model->is_delete_followup($this->input->get('id'));
        $data['status'] = $this->session->flashdata('status');

        $this->template->title = 'Follow Up';
        $this->template->content->view("prospek/follow_up_pribadi", $data);
        $this->template->publish();
    }


    /*===== edit follow up proposal =====*/
    function edit_follow_up_proposal() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $data['statusproposal'] = $this->master_model->get_list_status_proposal();
        $data['edited'] = $this->prospek_model->get_follow_up($this->input->get('nf'));
        $data['followup'] = $this->prospek_model->get_list_follow_up($this->input->get('id'));
        $data['isdelete'] = $this->prospek_model->is_delete_followup($this->input->get('id'));
        $data['status'] = $this->session->flashdata('status');

        $this->template->title = 'Follow Up';
        $this->template->content->view("prospek/follow_up_pribadi", $data);
        $this->template->publish();
    }


    /*===== simpan follow up =====*/
    function save_follow_up() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $nofollowup = $this->input->post('txtnofollowup');
        $nogenerate = $this->prospek_model->get_last_no_follow_up();

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
            $status = $this->prospek_model->insert_followup($data);
        }
        else {
            $status = $this->prospek_model->update_followup($data);
        }
        $this->session->set_flashdata('status', $status);

        redirect("$this->url/follow-up-proposal?r=".$this->input->post('txtnoprospek')."&id=$data[BUILD_ID]");
    }


    /*===== hapus follow up =====*/
    function delete_follow_up() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $status = $this->prospek_model->delete_followup($this->input->get('nf'));
        $this->session->set_flashdata('status', $status);

        redirect("$this->url/follow-up-proposal?r=".$this->input->get('r')."&id=".$this->input->get('id'));
    }


    /*===== daftar prospek binaan =====*/
    function binaan() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $s = strtolower(trim($this->input->get('s')));
        $p = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $kdkantor = $this->session->KDKANTOR;
        $noagen = $this->session->USERNAME;
        $areaoffice = rawurlencode($this->session->KDAREAOFFICE);
        $unitproduksi = rawurlencode($this->session->KDUNITPRODUKSI);
        $data['prospekbinaan'] = json_decode(file_get_contents(C_URL_API_JAIM."/workbook.php?r=3&p=".rawurlencode($p)."&p2=".rawurlencode(C_ROWS_PAGINATION)."&p3=".rawurlencode($kdkantor)."&p4=".rawurlencode($noagen)."&p5=".rawurlencode($s)."&p6=$areaoffice&p7=$unitproduksi"), true);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/binaan?s=$s";
        $config['total_rows'] = file_get_contents(C_URL_API_JAIM."/workbook.php?r=4&p=".rawurlencode($p)."&p2=".rawurlencode(C_ROWS_PAGINATION)."&p3=".rawurlencode($kdkantor)."&p4=".rawurlencode($noagen)."&p5=".rawurlencode($s)."&p6=$areaoffice&p7=$unitproduksi");
        $this->pagination->initialize($config);

        $this->template->title = 'Prospek Binaan';
        $this->template->content->view("prospek/binaan", $data);
        $this->template->publish();
    }


    /*===== daftar detail prospek binaan =====*/
    function binaan_detail() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $filter['s'] = strtolower(trim($this->input->get('s')));
        $filter['p'] = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $filter['noagen'] = $this->input->get('id');
        $data['prospek'] = $this->prospek_model->get_list_prospek($filter);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/agen-se-cabang-detail?s=$filter[s]&id=$filter[noagen]&nm=".rawurlencode($this->input->get('nm'));
        $config['total_rows'] = $this->prospek_model->get_total_prospek($filter);
        $this->pagination->initialize($config);

        $this->template->title = ucwords(str_replace('-', ' ', $this->input->get('nm')));
        $this->template->content->view("prospek/binaan_detail", $data);
        $this->template->publish();
    }


    /*===== data proposal prospek binaan =====*/
    function proposal_binaan() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $data['prospek'] = $this->prospek_model->get_prospek($this->input->get('np'));
        $data['proposal'] = $this->prospek_model->get_list_proposal($this->input->get('np'));

        $this->template->title = 'Proposal';
        $this->template->content->view("prospek/proposal_binaan", $data);
        $this->template->publish();
    }


    /*===== follow up proposal binaan =====*/
    function follow_up_proposal_binaan() {
        check_user_role_menu(C_MENU_PROSPEK_SAYA);

        $data['followup'] = json_decode(file_get_contents(C_URL_API_JAIM."/workbook.php?r=10&p=".rawurlencode($this->input->get('pr'))), true);

        $this->template->title = 'Follow Up';
        $this->template->content->view("prospek/follow_up_binaan", $data);
        $this->template->publish();
    }


    /*===== daftar prospek agen se cabang =====*/
    function agen_se_cabang() {
        check_user_role_menu(C_MENU_PROSPEK_AGEN_SE_CABANG);

        $s = strtolower(trim($this->input->get('s')));
        $p = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $kdkantor = $this->session->USERNAME;
        $noagen = "0000000000";
        $data['prospekcabang'] = json_decode(file_get_contents(C_URL_API_JAIM."/workbook.php?r=3&p=".rawurlencode($p)."&p2=".rawurlencode(C_ROWS_PAGINATION)."&p3=".rawurlencode($kdkantor)."&p4=".rawurlencode($noagen)."&p5=".rawurlencode($s)), true);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/agen-se-cabang?s=$s";
        $config['total_rows'] = file_get_contents(C_URL_API_JAIM."/workbook.php?r=4&p=".rawurlencode($p)."&p2=".rawurlencode(C_ROWS_PAGINATION)."&p3=".rawurlencode($kdkantor)."&p4=".rawurlencode($noagen)."&p5=".rawurlencode($s));
        $this->pagination->initialize($config);

        $this->template->title = 'Prospek Agen';
        $this->template->content->view("prospek/agen_se_cabang", $data);
        $this->template->publish();
    }


    /*===== daftar detail prospek agen se cabang =====*/
    function agen_se_cabang_detail() {
        check_user_role_menu(C_MENU_PROSPEK_AGEN_SE_CABANG);

        $filter['s'] = strtolower(trim($this->input->get('s')));
        $filter['p'] = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $filter['noagen'] = $this->input->get('id');
        $data['prospek'] = $this->prospek_model->get_list_prospek($filter);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/agen-se-cabang-detail?s=$filter[s]&id=$filter[noagen]&nm=".rawurlencode($this->input->get('nm'));
        $config['total_rows'] = $this->prospek_model->get_total_prospek($filter);
        $this->pagination->initialize($config);

        $this->template->title = ucwords(str_replace('-', ' ', $this->input->get('nm')));
        $this->template->content->view("prospek/agen_se_cabang_detail", $data);
        $this->template->publish();
    }


    /*===== daftar proposal agen se cabang =====*/
    function proposal_se_cabang() {
        check_user_role_menu(C_MENU_PROSPEK_AGEN_SE_CABANG);

        $data['prospek'] = $this->prospek_model->get_prospek($this->input->get('np'));
        $data['proposal'] = $this->prospek_model->get_list_proposal($this->input->get('np'));

        if ($data['prospek']['KDKANTOR'] != $this->session->USERNAME) {
            redirect("$this->url/agen-se-cabang");
        }

        $this->template->title = "Proposal ".$data['prospek']['NAMA'];
        $this->template->content->view("prospek/proposal_se_cabang", $data);
        $this->template->publish();
    }


    /*===== daftar follow up agen se cabang =====*/
    function follow_up_se_cabang() {
        check_user_role_menu(C_MENU_PROSPEK_AGEN_SE_CABANG);

        $data['prospek'] = $this->prospek_model->get_prospek($this->input->get('np'));
        $data['followup'] = json_decode(file_get_contents(C_URL_API_JAIM."/workbook.php?r=10&p=".rawurlencode($this->input->get('pr'))), true);

        $this->template->title = 'Follow Up';
        $this->template->content->view("prospek/follow_up_se_cabang", $data);
        $this->template->publish();
    }


    /*===== daftar prospek agen se wilayah =====*/
    function agen_se_wilayah() {
        check_user_role_menu(C_MENU_PROSPEK_AGEN_SE_WILAYAH);

        $data['cabang'] = json_decode(file_get_contents(C_URL_API_JAIM."/master.php?r=1&p=".rawurlencode($this->session->USERNAME)), true);

        $s = strtolower(trim($this->input->get('s')));
        $p = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $kdkantor = $this->input->get('ktr');
        $noagen = "0000000000";
        $data['prospekwilayah'] = json_decode(file_get_contents(C_URL_API_JAIM."/workbook.php?r=5&p=".rawurlencode($p)."&p2=".rawurlencode(C_ROWS_PAGINATION)."&p3=".rawurlencode($kdkantor)."&p4=".rawurlencode($noagen)."&p5=".rawurlencode($s)), true);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/agen-se-wilayah?ktr=$kdkantor&s=$s";
        $config['total_rows'] = file_get_contents(C_URL_API_JAIM."/workbook.php?r=6&p=".rawurlencode($p)."&p2=".rawurlencode(C_ROWS_PAGINATION)."&p3=".rawurlencode($kdkantor)."&p4=".rawurlencode($noagen)."&p5=".rawurlencode($s));
        $this->pagination->initialize($config);

        $this->template->title = 'Prospek Agen';
        $this->template->content->view("prospek/agen_se_wilayah", $data);
        $this->template->publish();
    }


    /*===== daftar detail prospek agen se wilayah =====*/
    function agen_se_wilayah_detail() {
        check_user_role_menu(C_MENU_PROSPEK_AGEN_SE_WILAYAH);

        $filter['s'] = strtolower(trim($this->input->get('s')));
        $filter['p'] = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $filter['noagen'] = $this->input->get('id');
        $data['prospek'] = $this->prospek_model->get_list_prospek($filter);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/agen-se-wilayah-detail?s=$filter[s]&ktr=".$this->input->get('ktr')."&id=$filter[noagen]&nm=".rawurlencode($this->input->get('nm'));
        $config['total_rows'] = $this->prospek_model->get_total_prospek($filter);
        $this->pagination->initialize($config);

        $this->template->title = ucwords(str_replace('-', ' ', $this->input->get('nm')));
        $this->template->content->view("prospek/agen_se_wilayah_detail", $data);
        $this->template->publish();
    }


    /*===== daftar proposal agen se wilayah =====*/
    function proposal_se_wilayah() {
        check_user_role_menu(C_MENU_PROSPEK_AGEN_SE_WILAYAH);

        $data['prospek'] = $this->prospek_model->get_prospek($this->input->get('np'));
        $data['proposal'] = $this->prospek_model->get_list_proposal($this->input->get('np'));

        $arr_kantor = json_decode(file_get_contents(C_URL_API_JAIM."/master.php?r=1&p=".rawurlencode($this->session->USERNAME)), true);

        $redirect = 1;
        foreach ($arr_kantor as $i => $v) {
            if ($data['prospek']['KDKANTOR'] == $v['KDKANTOR'])
                $redirect = 0;
        }
        if ($redirect)
            redirect("$this->url/agen-se-wilayah");

        $this->template->title = "Proposal ".$data['prospek']['NAMA'];
        $this->template->content->view("prospek/proposal_se_wilayah", $data);
        $this->template->publish();
    }


    /*===== daftar follow up agen se wilayah =====*/
    function follow_up_se_wilayah() {
        check_user_role_menu(C_MENU_PROSPEK_AGEN_SE_WILAYAH);

        $data['prospek'] = $this->prospek_model->get_prospek($this->input->get('np'));
        $data['followup'] = json_decode(file_get_contents(C_URL_API_JAIM."/workbook.php?r=10&p=".rawurlencode($this->input->get('pr'))), true);

        $this->template->title = 'Follow Up';
        $this->template->content->view("prospek/follow_up_se_wilayah", $data);
        $this->template->publish();
    }


    /*===== download rekap data prospek agen se wilayah =====*/
    function download_prospek_se_wilayah() {
        check_user_role_menu(C_MENU_DOWNLOAD_PROSPEK_AGEN_SE_WILAYAH);

        $data['cabang'] = json_decode(file_get_contents(C_URL_API_JAIM."/master.php?r=1&p=".rawurlencode($this->session->USERNAME)), true);

        $this->template->title = 'Download Rekap Prospek';
        $this->template->content->view("prospek/download_prospek_se_wilayah", $data);
        $this->template->publish();
    }


    /*===== download rekap prospek se wilayah format excel =====*/
    function download_prospek_se_wilayah_excel() {
        check_user_role_menu(C_MENU_DOWNLOAD_PROSPEK_AGEN_SE_WILAYAH);

        $kdkantor = $this->input->get('ktr');
        $tglawal = $this->input->get('txtTglAwal');
        $tglakhir = $this->input->get('txtTglAkhir');
        $data['rekap'] = json_decode(file_get_contents(C_URL_API_JAIM."/workbook.php?r=7&p=".rawurlencode($kdkantor)."&p2=".rawurlencode($tglawal)."&p3=".rawurlencode($tglakhir)), true);

        $this->load->view('prospek/download_prospek_excel', $data);
    }


    /*===== download rekap data prospek agen se wilayah =====*/
    function download_prospek_se_cabang() {
        check_user_role_menu(C_MENU_DOWNLOAD_PROSPEK_AGEN_SE_CABANG);

        $this->template->title = 'Download Rekap Prospek';
        $this->template->content->view("prospek/download_prospek_se_cabang");
        $this->template->publish();
    }


    /*===== download rekap prospek se wilayah format excel =====*/
    function download_prospek_se_cabang_excel() {
        check_user_role_menu(C_MENU_DOWNLOAD_PROSPEK_AGEN_SE_CABANG);

        $username = $this->session->USERNAME;
        $tglawal = $this->input->get('txtTglAwal');
        $tglakhir = $this->input->get('txtTglAkhir');
        $data['rekap'] = json_decode(file_get_contents(C_URL_API_JAIM."/workbook.php?r=8&p=".rawurlencode($username)."&p2=".rawurlencode($tglawal)."&p3=".rawurlencode($tglakhir)), true);

        $this->load->view('prospek/download_prospek_excel', $data);
    }


    /*===== download rekap prospek se kantor jiwasraya (kapus) =====*/
    function download_prospek_se_kapus() {
        check_user_role_menu(C_MENU_DOWNLOAD_PROSPEK_AGEN_SE_KAPUS);

        $data['cabang'] = json_decode(file_get_contents(C_URL_API_JAIM."/master.php?r=4"), true);

        $this->template->title = 'Download Rekap Prospek';
        $this->template->content->view("prospek/download_prospek_se_kapus", $data);
        $this->template->publish();
    }


    /*===== download rekap prospek se kapus format excel =====*/
    function download_prospek_se_kapus_excel() {
        check_user_role_menu(C_MENU_DOWNLOAD_PROSPEK_AGEN_SE_KAPUS);

        $kdkantor = $this->input->get('ktr');
        $tglawal = $this->input->get('txtTglAwal');
        $tglakhir = $this->input->get('txtTglAkhir');
        $data['rekap'] = json_decode(file_get_contents(C_URL_API_JAIM."/workbook.php?r=8&p=".rawurlencode($kdkantor)."&p2=".rawurlencode($tglawal)."&p3=".rawurlencode($tglakhir)), true);

        $this->load->view('prospek/download_prospek_excel', $data);
    }
}