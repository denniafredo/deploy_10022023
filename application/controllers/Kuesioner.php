<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kuesioner extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('kuesioner_model');

        check_session_user();
        $this->url = base_url('kuesioner');
    }


    public function index() {
        $idgrup = $this->input->get('id');
        $kategori = $this->input->get('kategori');

        if (strlen($idgrup) <= 0 || strlen($kategori) <= 0) {
            redirect(base_url());
        } else {
            $result = $this->kuesioner_model->get_list_hasil_kuesioner($idgrup);

            if (count($result) > 0) {
                redirect(base_url());
            } else {
                $data['kuesioner'] = $this->kuesioner_model->get_list_kuesioner($idgrup);
                $data['jawaban'] = $this->kuesioner_model->get_list_jawaban_kuesioner($idgrup);
                $this->template->title = "Kuesioner";

                if ($kategori == '1') {
                    $this->template->content->view("kuesioner/kuesioner1", $data);
                    $this->template->publish();
                } else if ($kategori == '2') {
                    $this->template->content->view("kuesioner/kuesioner2", $data);
                    $this->template->publish();
                }
            }
        }
    }


    public function save_kuesioner() {
        $maks = $this->input->post('maxnumber');

        for($i=0;$i<=$maks;$i++) {
            $data[$i]['IDKUESIONERJAWABAN'] = $this->input->post("kuesionerjawaban$i");
            $data[$i]['USERNAME'] = $this->session->USERNAME;
        }

        $data2['IDGRUP'] = $this->input->post('idgrup');
        $data2['USERNAME'] = $this->session->USERNAME;
        $data2['SARAN'] = $this->input->post('saran');

        $status = $this->kuesioner_model->insert($data, $data2);

        $this->session->set_flashdata('status', $status);

        redirect("$this->url/informasi");
    }


    /*===== informasi sukses gagal simpan kuesioner =====*/
    function informasi() {
        $data['status'] = $this->session->flashdata('status');

        $this->template->title = "Kuesioner";
        $this->template->content->view("kuesioner/informasi", $data);
        $this->template->publish();
    }
}