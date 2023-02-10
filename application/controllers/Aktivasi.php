<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aktivasi extends CI_Controller {

    function __construct() {
        parent::__construct();

        check_session_user();
        check_kuesioner();
        $this->url = base_url('aktivasi');
        $this->load->model('aktivasi_model');
    }

    function index() {
        check_user_role_menu(C_MENU_AKTIVASI_PENJUALAN);

        $filter['s'] = strtolower(trim($this->input->get('s')));
        $filter['kdkantor'] = $this->session->KDKANTOR;
        $filter['p'] = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $data['aktivasi'] = $this->aktivasi_model->get_list_aktivasi($filter);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url";
        $config['total_rows'] = $this->aktivasi_model->get_total_aktivasi($filter);
        $this->pagination->initialize($config);

        $data['status'] = $this->session->flashdata('status');

        $this->template->title = 'Aktivasi Penjualan';
        $this->template->content->view("aktivasi/index", $data);
        $this->template->publish();
    }

    function add_cabang() {
        check_user_role_menu(C_MENU_AKTIVASI_PENJUALAN);

        $data['jeniskegiatan'] = $this->aktivasi_model->get_list_jenis_kegiatan();
        $data['areaoffice'] = json_decode(file_get_contents(C_URL_API_JAIM."/master.php?r=5&p=".rawurlencode($this->session->KDKANTOR)), true);

        $this->template->title = 'Tambah Data Aktivasi Penjualan';
        $this->template->content->view("aktivasi/add_cabang", $data);
        $this->template->publish();
    }

    function edit_cabang() {
        check_user_role_menu(C_MENU_AKTIVASI_PENJUALAN);
        $noaktivasi = $this->input->get('id');

        $data['jeniskegiatan'] = $this->aktivasi_model->get_list_jenis_kegiatan();
        $data['areaoffice'] = json_decode(file_get_contents(C_URL_API_JAIM."/master.php?r=5&p=".rawurlencode($this->session->KDKANTOR)), true);
        $data['aktivasi'] = $this->aktivasi_model->get_aktivasi($noaktivasi);
        $data['pelaksana'] = $this->aktivasi_model->get_list_pelaksana_kegiatan($noaktivasi);

        $this->template->title = 'Tambah Data Aktivasi Penjualan';
        $this->template->content->view("aktivasi/edit_cabang", $data);
        $this->template->publish();
    }

    function monitor_cabang() {
        check_user_role_menu(C_MENU_AKTIVASI_PENJUALAN);
        $noaktivasi = $this->input->get('id');

        $data['aktivasi'] = $this->aktivasi_model->get_aktivasi($noaktivasi);
        $data['spaj'] = json_decode(file_get_contents(C_URL_API_JAIM."/aktivasi.php?r=2&p=$noaktivasi"), true);
        $data['polis'] = json_decode(file_get_contents(C_URL_API_JAIM."/aktivasi.php?r=3&p=$noaktivasi"), true);
        $data['monitor'] = $this->aktivasi_model->get_monitor($noaktivasi);

        $this->template->title = 'Monitor Data Aktivasi Penjualan';
        $this->template->content->view("aktivasi/monitor_cabang", $data);
        $this->template->publish();
    }

    function save_cabang() {
        $noaktivasi = $this->input->post('noaktivasi');
        $nogenerate = $this->generate->id($this->session->KDKANTOR, true, true, date('d'), 6, null, $this->aktivasi_model->get_last_no_aktivasi());
        $usenoaktivasi = empty($noaktivasi) ? $nogenerate : $noaktivasi;
        $arrareaoffice = $this->input->post('kdareaoffice');
        $arragen = $this->input->post('noagen');

        $data['noaktivasi'] = $usenoaktivasi;
        $data['kdkantor'] = $this->session->KDKANTOR;
        $data['kdjeniskegiatan'] = $this->input->post('ddlkdjeniskegiatan');
        $data['waktupelaksanaanawal'] = $this->input->post('txtPelaksanaanAwal');
        $data['waktupelaksanaanakhir'] = $this->input->post('txtPelaksanaanAkhir');
        $data['tempat'] = str_replace("'","''",$this->input->post('txtTempat'));
        $data['deskripsi'] = str_replace("'","''",$this->input->post('txtDeskripsi'));
        $data['potensipremiberkala'] = $this->input->post('premiberkala');
        $data['potensipremisekaligus'] = $this->input->post('premisekaligus');
        $data['potensiprospek'] = $this->input->post('prospek');
        $data['biaya'] = $this->input->post('ddlbiaya');

        foreach ($arrareaoffice as $i => $v) {
            $data2[$i]['noaktivasi'] = $usenoaktivasi;
            $data2[$i]['kdareaoffice'] = $v;
            $data2[$i]['kdkantor'] = $this->session->KDKANTOR;
        }

        foreach ($arragen as $i => $v) {
            $data3[$i]['noaktivasi'] = $usenoaktivasi;
            $data3[$i]['noagen'] = $v;
        }

        // dokumen upload kantor pusat
        $config = array(
            "upload_path" => 'asset/notdin/aktivasi/',
            "allowed_types" => '*',
            "file_name" => $usenoaktivasi,
            "overwrite" => true
        );
        $this->load->library('upload', $config);
        $this->upload->do_upload('fnotadinas');
        if (strlen($_FILES['fnotadinas']['name']) > 0) {
            $data['filenotadinas'] = $data['biaya'] == 'pusat' ? "$usenoaktivasi.".pathinfo($_FILES['fnotadinas']['name'], PATHINFO_EXTENSION) : null;
        } else {
            $data['filenotadinas'] = $this->input->post('oldfnotadinas');
        }

        if (empty($noaktivasi)) {
            $status = $this->aktivasi_model->insert($data, $data2, $data3);
        }
        else {
            $status = $this->aktivasi_model->reinsert($data, $data2, $data3);
        }

        $this->session->set_flashdata('status', $status);

        redirect("$this->url");
    }

    function save_monitor() {
        $data['noaktivasi'] = $this->input->post('noaktivasi');
        $data['tglpelaksanaan'] = $this->input->post('txtWaktuPelaksanaan');
        $data['kendala'] = str_replace("'","''",$this->input->post('txtKendala'));
        $data['solusi'] = str_replace("'","''",$this->input->post('txtSolusi'));

        $status = $this->aktivasi_model->insert_monitor($data);

        $this->session->set_flashdata('status', $status);

        redirect("$this->url");
    }

    function save_kapus() {
        // dokumen upload kantor pusat
        $data['noaktivasi'] = trim($this->input->post('noaktivasi'));
        $config = array(
            "upload_path" => 'asset/notdin/aktivasi/',
            "allowed_types" => '*',
            "file_name" => "$data[noaktivasi]-2",
            "overwrite" => true
        );
        $this->load->library('upload', $config);
        $this->upload->do_upload('fnotadinaskapus');
        if (strlen($_FILES['fnotadinaskapus']['name']) > 0) {
            $data['filejawabankp'] = "$data[noaktivasi]-2.".pathinfo($_FILES['fnotadinaskapus']['name'], PATHINFO_EXTENSION);
        } else {
            $data['filejawabankp'] = $this->input->post('oldfnotadinaskapus');
        }

        $status = $this->aktivasi_model->update($data);

        $this->session->set_flashdata('status', $status);

        redirect("$this->url/index-kapus");
    }

    function ajax_agen_pelaksana() {
        $p2 = str_replace(" ", "-", $this->input->post('kdareaoffice'));
        $p3 = $this->input->post('waktupelaksanaanawal');
        $noaktivasi = $this->input->post('noaktivasi');
        $data = json_decode(file_get_contents(C_URL_API_JAIM."/aktivasi.php?r=1&p=".rawurlencode($this->session->KDKANTOR)."&p2=$p2&p3=$p3&p4=$noaktivasi"), true);
        $arragen = $this->aktivasi_model->get_list_agen_pelaksana($noaktivasi);

        if (count($data) > 0){
            foreach ($data as $i => $v) {
                $i++;
                $checked = null;
                foreach ($arragen as $j => $w) {
                    if ($v['NOAGEN'] == $w['NOAGEN']) {
                        $checked = 'checked';
                        break;
                    }
                }
                echo "<label>$i <input type='checkbox' name='noagen[]' value='$v[NOAGEN]' $checked /> &nbsp; $v[NOAGEN] $v[NAMAKLIEN1]</label> <br>";
            }
        } else {
            echo "<label>Semua agent sedang mengikuti aktivasi penjualan atau tidak ada agen di area yang anda pilih</label>";
        }
    }

    function download_aktivasi_se_cabang() {
        check_user_role_menu(C_MENU_AKTIVASI_PENJUALAN);

        $kdkantor = $this->session->KDKANTOR;
        $data['cabang'] = json_decode(file_get_contents(C_URL_API_JAIM."/evaluasi.php?r=3&p=$kdkantor"), true);

        $this->template->title = 'Download Aktivasi Penjualan';
        $this->template->content->view("aktivasi/download_aktivasi_se_cabang", $data);
        $this->template->publish();
    }

    function download_aktivasi_se_cabang_excel() {
        check_user_role_menu(C_MENU_AKTIVASI_PENJUALAN);

        $kdkantor = $this->session->KDKANTOR;
        $tanggal = $this->input->get('txtTanggal');
        $data['aktivasi'] = json_decode(file_get_contents(C_URL_API_JAIM."/aktivasi.php?r=4&p=".rawurlencode($kdkantor)."&p2=".rawurlencode($tanggal)), true);

        $this->load->view('aktivasi/download_aktivasi_excel', $data);
    }

    function download_aktivasi_se_kanwil() {
        check_user_role_menu(C_MENU_DOWNLOAD_AKTIVASI_SE_KANWIL);

        $kdkntrinduk = $this->session->USERNAME;
        $data['cabang'] = json_decode(file_get_contents(C_URL_API_JAIM."/evaluasi.php?r=3&p=$kdkntrinduk"), true);

        $this->template->title = 'Download Aktivasi Penjualan';
        $this->template->content->view("aktivasi/download_aktivasi_se_kanwil", $data);
        $this->template->publish();
    }

    function download_aktivasi_se_kanwil_excel() {
        check_user_role_menu(C_MENU_DOWNLOAD_AKTIVASI_SE_KANWIL);

        $kdkantor = $this->input->get('ktr');
        $kdkantor = !empty($kdkantor) ? $kdkantor : $this->session->USERNAME;
        $tanggal = $this->input->get('txtTanggal');
        $data['aktivasi'] = json_decode(file_get_contents(C_URL_API_JAIM."/aktivasi.php?r=4&p=".rawurlencode($kdkantor)."&p2=".rawurlencode($tanggal)), true);

        $this->load->view('aktivasi/download_aktivasi_excel', $data);
    }

    function index_kapus() {
        check_user_role_menu(C_MENU_DOWNLOAD_AKTIVASI_SE_KAPUS);

        $filter['s'] = strtolower(trim($this->input->get('s')));
        $filter['kdkantor'] = null;
        $filter['p'] = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $data['aktivasi'] = $this->aktivasi_model->get_list_aktivasi($filter);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/index-kapus";
        $config['total_rows'] = $this->aktivasi_model->get_total_aktivasi($filter);
        $this->pagination->initialize($config);

        $data['status'] = $this->session->flashdata('status');

        $this->template->title = 'Aktivasi Penjualan';
        $this->template->content->view("aktivasi/index_kapus", $data);
        $this->template->publish();
    }

    function download_aktivasi_se_kapus() {
        check_user_role_menu(C_MENU_DOWNLOAD_AKTIVASI_SE_KAPUS);

        $data['cabang'] = json_decode(file_get_contents(C_URL_API_JAIM."/master.php?r=4"), true);

        $this->template->title = 'Download Aktivasi Penjualan';
        $this->template->content->view("aktivasi/download_aktivasi_se_kapus", $data);
        $this->template->publish();
    }

    function download_aktivasi_se_kapus_excel() {
        check_user_role_menu(C_MENU_DOWNLOAD_AKTIVASI_SE_KAPUS);

        $kdkantor = $this->input->get('ktr');
        $tanggal = $this->input->get('txtTanggal');
        $data['aktivasi'] = json_decode(file_get_contents(C_URL_API_JAIM."/aktivasi.php?r=4&p=".rawurlencode($kdkantor)."&p2=".rawurlencode($tanggal)), true);

        $this->load->view('aktivasi/download_aktivasi_excel', $data);
    }

    function upload_nota_kapus() {
        check_user_role_menu(C_MENU_DOWNLOAD_AKTIVASI_SE_KAPUS);
        $noaktivasi = $this->input->get('id');

        $data['aktivasi'] = $this->aktivasi_model->get_aktivasi($noaktivasi);

        $this->template->title = 'Unggah nota kantor pusat';
        $this->template->content->view("aktivasi/upload_nota_kapus", $data);
        $this->template->publish();
    }
}