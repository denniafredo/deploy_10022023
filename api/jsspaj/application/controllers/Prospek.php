<?php

/* 
 * Ini adalah halaman untuk daftar prospek.
 * 
 * Create by : Fendy Christianto
 */

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Prospek extends \Restserver\Libraries\REST_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();
        $this->load->model('mprospek');
        $this->load->model('mmaster');
    }
    
    /*===== Insert data prospek =====*/   
    function agen_post() {
        $httpcode = \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST;
        $message = message(true, $httpcode, '', 'Sukses');
        
        $username = trims($this->post('username'));
        $kdpekerjaan = trims($this->post('kdpekerjaan'));
        $kdhobi = trims($this->post('kdhobi'));
        $namaklien = replace_to_insert($this->post('namaklien'));
        $kdjeniskelamin = trims($this->post('kdjeniskelamin'));
        $tgllahir = trims($this->post('tgllahir'));
        $alamat = replace_to_insert($this->post('alamat'));
        $kdprovinsi = trims($this->post('kdprovinsi'));
        $kdkotamadya = trims($this->post('kdkotamadya'));
        $kdkelurahan = trims($this->post('kdkelurahan'));
        $email = trims($this->post('email'));
        $telepon = grab_number($this->post('telepon'));
        $hp = grab_number($this->post('hp'));
        $noid = grab_number($this->post('noid'));
        $meritalstatus = trims($this->post('meritalstatus'));
        
        if (empty($username)) {
            $message = message(true, $httpcode, 'username', 'Username belum diisi');
        } else if (empty($kdpekerjaan)) {
            $message = message(true, $httpcode, 'kdpekerjaan', 'Kode Pekerjaan belum diisi');
        } else if (empty($kdhobi)) {
            $message = message(true, $httpcode, 'kdhobi', 'Kode Hobi belum diisi');
        } else if (empty($namaklien)) {
            $message = message(true, $httpcode, 'namaklien', 'Nama Klien belum diisi');
        } else if (empty($kdjeniskelamin)) {
            $message = message(true, $httpcode, 'kdjeniskelamin', 'Kode Jenis Kelamin belum diisi');
        } else if ($kdjeniskelamin != 'L' && $kdjeniskelamin != 'P') {
            $message = message(true, $httpcode, 'kdjeniskelamin', 'Kode Jenis Kelamin yang valid adalah L/P');
        } else if (empty($tgllahir)) {
            $message = message(true, $httpcode, 'tgllahir', 'Tanggal Lahir belum diisi');
        } else if (!preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/",$tgllahir)) {
            $message = message(true, $httpcode, 'tgllahir', 'Tanggal Lahir yang valid adalah format dd-mm-yyyy');
        } else if (empty($alamat)) {
            $message = message(true, $httpcode, 'alamat', 'Alamat belum diisi');
        } else if (empty($kdprovinsi)) {
            $message = message(true, $httpcode, 'kdprovinsi', 'Kode Provinsi belum diisi');
        } else if (empty($kdkotamadya)) {
            $message = message(true, $httpcode, 'kdkotamadya', 'Kode Kota Madya belum diisi');
        } else if (empty($kdkelurahan)) {
            $message = message(true, $httpcode, 'kdkelurahan', 'Kode Kelurahan belum diisi');
        } else if (empty($email)) {
            $message = message(true, $httpcode, 'email', 'Email belum diisi');
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = message(true, $httpcode, 'email', 'Email tidak valid');
        } /*else if (empty($telepon)) {
            $message = message(true, $httpcode, 'telepon', 'Telepon belum diisi');
        } else if (!ctype_digit($telepon)) {
            $message = message(true, $httpcode, 'telepon', 'Telepon yang valid hanya berformat angka');
        }*/ else if (empty($hp)) {
            $message = message(true, $httpcode, 'hp', 'HP belum diisi');
        } else if (!ctype_digit($hp)) {
            $message = message(true, $httpcode, 'hp', 'HP yang valid hanya berformat angka');
        } else if (empty($noid)) {
            $message = message(true, $httpcode, 'noid', 'No ID belum diisi');
        } else if (!ctype_digit($noid) || strlen($noid) != 16) {
            $message = message(true, $httpcode, 'noid', 'No ID tidak valid');
        } else if (!in_array($meritalstatus, array('L','K','J','D'))) {
            $message = message(true, $httpcode, 'meritalstatus', 'Merital Status yang valid adalah L/K/J/D');
        } else {
            // cari klien berdasarkan ktp
            $klien = $this->mprospek->get_klien($noid);
            
            $data['kdpekerjaan'] = $kdpekerjaan;
            $data['kdhobi'] = $kdhobi;
            $data['namaklien'] = $namaklien;
            $data['kdjeniskelamin'] = $kdjeniskelamin;
            $data['tgllahir'] = to_date($tgllahir);
            $data['alamat'] = $alamat;
            $data['kdprovinsi'] = $kdprovinsi;
            $data['kdkotamadya'] = $kdkotamadya;
            $data['kdkelurahan'] = $kdkelurahan;
            $data['email'] = $email;
            $data['telepon'] = $telepon;
            $data['hp'] = $hp;
            $data['meritalstatus'] = $meritalstatus;
            
            if ($klien) {
                $data['flag'] = '0';
                $data['tglubah'] = C_IDENTIFIER_WITHOUT_QUOTES.'sysdate';
                
                // update klien & klien agen
                if ($this->mprospek->myupdate('jaim_302_klien', $data, 'noklien', $klien['NOKLIEN']) &&
                    $this->mprospek->myupdate('jaim_302_klien_agen', array('noklien' => $klien['NOKLIEN'], 'noagen' => $username, 'tglubah' => C_IDENTIFIER_WITHOUT_QUOTES.'sysdate'), array('noklien' => $klien['NOKLIEN'], 'noagen' => $username), null, true)) {
                    $httpcode = \Restserver\Libraries\REST_Controller::HTTP_CREATED;
                    $message = message(false, $httpcode, '', 'Sukses');
                }
                
                $data2['kdlog'] = C_IDENTIFIER_WITHOUT_QUOTES."F_GEN_KDLOG";
                $data2['log'] = C_IDENTIFIER_LOG_UBAH_PROSPEK.
                                "\nnoklien : $klien[NOKLIEN]".
                                "\nkdpekerjaan : $klien[KDPEKERJAAN] => $kdpekerjaan".
                                "\nkdhobi : $klien[KDHOBI] => $kdhobi".
                                "\nnamaklien : ".replace_to_insert($klien['NAMAKLIEN'])." => $namaklien".
                                "\nkdjeniskelamin : $klien[KDJENISKELAMIN] => $kdjeniskelamin".
                                "\ntgllahir : $klien[TGLLAHIR] => $tgllahir".
                                "\nalamat : ".replace_to_insert($klien['ALAMAT'])." => $alamat".
                                "\nkdprovinsi : $klien[KDPROVINSI] => $kdprovinsi".
                                "\nkdkotamadya : $klien[KDKOTAMADYA] => $kdkotamadya".
                                "\nkdkelurahan : $klien[KDKELURAHAN] => $kdkelurahan".
                                "\nemail : $klien[EMAIL] => $email".
                                "\ntelepon : $klien[TELEPON] => $telepon".
                                "\nhp : $klien[HP] => $hp";
                $data2['tglrekam'] = C_IDENTIFIER_WITHOUT_QUOTES."sysdate";
                $data2['userrekam'] = $this->input->ip_address();
                $this->mprospek->myinsert('jaim_999_log', $data2);
            } else {
                $data['noklien'] = $this->mprospek->gen_noklien();
                $data['noid'] = $noid;
                $data['userrekam'] = $username;
                $data['tglrekam'] = C_IDENTIFIER_WITHOUT_QUOTES.'sysdate';
                
                // insert klien & klien agen
                if ($this->mprospek->myinsert('jaim_302_klien', $data) &&
                    $this->mprospek->myinsert('jaim_302_klien_agen', array('noklien' => $data['noklien'], 'noagen' => $username))) {
                    $httpcode = \Restserver\Libraries\REST_Controller::HTTP_CREATED;
                    $message = message(false, $httpcode, '', 'Sukses');
                }
            }
        }
        
        // Logging
        $this->mprospek->log2("Request : Insert Prospek", "Response : ".json_encode($message));
        
        // Response
	
        $this->response($message, $httpcode);
    }
    
    
    /*===== Ambil data prospek =====*/
    function agen_get($username = null, $noid = null) {
        if (!empty($username)) {
            $httpcode = \Restserver\Libraries\REST_Controller::HTTP_OK;
            
            if (empty($noid)) {
                $data = $this->mprospek->get_list_klien($username);
            } else {
                $data = $this->mprospek->get_klien_agen($noid, $username);
                
                if ($data) {
                    $kelurahan = $this->mmaster->get_kelurahan($data['KDKELURAHAN']);
                    $data['KDKECAMATAN'] = $kelurahan['KDKECAMATAN'];
                    $data['KODEPOS'] = $kelurahan['KODEPOS'];
                }
            }
            $message = message(false, $httpcode, '', $data);
        } else {
            $httpcode = \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST;
            
            $message = message(true, $httpcode, '', 'Nomor agen wajib diisi');
        }
            
        // Response
        $this->response($message, $httpcode);
    }
}