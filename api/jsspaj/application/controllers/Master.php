<?php

/* 
 * Ini adalah halaman pertukaran data Master.
 * 
 * Create by : Fendy Christianto
 */

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Master extends \Restserver\Libraries\REST_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();
        $this->load->model('mmaster');
    }
    
    function agen_get($username = null) {
        $user = $this->mmaster->get_agenjlindo($username);
        $httpcode = \Restserver\Libraries\REST_Controller::HTTP_OK;
        
        // Jika parameter username kosong
        if (empty($username)) {
            $data = $this->mmaster->get_list_agenjlindo();
            
            $message = message(false, $httpcode, '', $data);
        } else {
            if (count($user) == 0) {
                $message = message(true, $httpcode, '', 'Username tidak ditemukan di database');
            } else if ($user['KDSTATUSAGEN'] != '01' && ($user['KDROLE'] == '1' || $user['KDROLE'] == '29')) {
                $message = message(true, $httpcode, '', 'Agen tidak berstatus aktif');
            } else {
                $jaim = $this->mmaster->get_agen($username);
                $data['IDUSER'] = $jaim['IDUSER'];
                $data['KDROLE'] = $jaim['KDROLE'];
                $data['USERNAME'] = $jaim['USERNAME'];
                $data['PASSWORD'] = $jaim['PASSWORD'];
                $data['NAMALENGKAP'] = $user['NAMAKLIEN1'];
                $data['EMAIL'] = $user['EMAILTETAP'];
                $data['KDJABATANAGEN'] = $user['KDJABATANAGEN'];
                $data['NAMAJABATANAGEN'] = $user['NAMAJABATANAGEN'];
                $data['KDAREAOFFICE'] = $user['KDAREAOFFICE'];
                $data['KDUNITPRODUKSI'] = $user['KDUNITPRODUKSI'];
                $data['KDKANTOR'] = $user['KDKANTOR'];
                $data['NAMAKANTOR'] = $user['NAMAKANTOR'];
                $data['PHONEKANTOR'] = $user['PHONEKANTOR'];
                $data['EMAILKANTOR'] = $user['EMAILKANTOR'];
                $data['NAMAINDUK'] = $user['NAMAINDUK'];
                $data['PHONEINDUK'] = $user['PHONEINDUK'];
                $data['EMAILINDUK'] = $user['EMAILINDUK'];
                $data['FIREBASETOKEN'] = $jaim['FIREBASETOKEN'];
                $data['KDSTATUSAGEN'] = $user['KDSTATUSAGEN'];
                $data['NAMASTATUSAGEN'] = $user['NAMASTATUSAGEN'];
                $data['SESSIONID'] = $jaim['SESSIONID'];
                $message = message(false, $httpcode, '', $data);
            }
        }
        
        // Response
        $this->response($message, $httpcode);
    }
    
    function user_jaim_get($username) {
        $user = $this->mmaster->get_agen($username);
        $httpcode = \Restserver\Libraries\REST_Controller::HTTP_OK;
        
        // Jika parameter username kosong
        if (empty($username)) {
            $message = message(true, $httpcode, 'username', 'Username belum diisi');
        } else {
            if (count($user) == 0) {
                $message = message(true, $httpcode, '', 'Username tidak ditemukan di database');
            } else {
                $data['IDUSER'] = $user['IDUSER'];
                $data['KDROLE'] = $user['KDROLE'];
                $data['USERNAME'] = $user['USERNAME'];
                $data['PASSWORD'] = $user['PASSWORD'];
                $data['NAMALENGKAP'] = $user['NAMALENGKAP'];
                $data['EMAIL'] = $user['EMAIL'];
                $data['KDJABATANAGEN'] = null;
                $data['NAMAJABATANAGEN'] = null;
                $data['KDAREAOFFICE'] = null;
                $data['KDUNITPRODUKSI'] = null;
                $data['KDKANTOR'] = null;
                $data['NAMAKANTOR'] = null;
                $data['PHONEKANTOR'] = null;
                $data['EMAILKANTOR'] = null;
                $data['NAMAINDUK'] = null;
                $data['PHONEINDUK'] = null;
                $data['EMAILINDUK'] = null;
                $data['FIREBASETOKEN'] = null;
                $data['KDSTATUSAGEN'] = null;
                $data['NAMASTATUSAGEN'] = null;
                $data['SESSIONID'] = $user['SESSIONID'];
                $message = message(false, $httpcode, '', $data);
            }
        }
        
        // Response
        $this->response($message, $httpcode);
    }
    
    function otentikasi_get($username, $password) {
        $user = $this->mmaster->get_agen($username);
        $jlindo = $this->mmaster->get_agenjlindo($username);
        $httpcode = \Restserver\Libraries\REST_Controller::HTTP_OK;
        
        // Jika username tidak ditemukan
        if (@$user && count($user) == 0) {
            $message = message(true, $httpcode, '', 'Username or Password tidak valid');
        }
        // Jika password salah
        else if ($password != $user['PASSWORD']) {
            $message = message(true, $httpcode, 'password', 'Username or Password tidak valid');
        } 
        // Jika username tidak aktif
        else if ($jlindo['KDSTATUSAGEN'] != '01' && ($user['KDROLE'] == '1'  || $user['KDROLE'] == '29')) {
            $message = message(true, $httpcode, '', 'Akun Anda tidak aktif');
        } else {
            $data['sessionid'] = session_id();
            $this->mmaster->myupdate('jaim_900_user', $data, 'username', $username);
            
            $message = message(false, $httpcode, '', $data);
        }
       
        // Response
        $this->response($message, $httpcode);
    }
    
    function kirim_password_get($username) {
        $jaim = $this->mmaster->get_agen($username);
        $jlindo = $this->mmaster->get_agenjlindo($username);
        $ipaddress = $this->input->ip_address();
        $httpcode = \Restserver\Libraries\REST_Controller::HTTP_OK;
        
        $data['kdlog'] = C_IDENTIFIER_WITHOUT_QUOTES."F_GEN_KDLOG";
        $data['log'] = C_IDENTIFIER_LOG_KIRIM_KATA_SANDI."\nNo Agen : $username\nPassword : $jaim[PASSWORD]\nIP Address : $ipaddress";
        $data['tglrekam'] = C_IDENTIFIER_WITHOUT_QUOTES."sysdate";
        $data['userrekam'] = $ipaddress;
        
        $log = $this->mmaster->get_log(C_IDENTIFIER_LOG_KIRIM_KATA_SANDI."%$username");
        
        if (count($jaim) == 0) {
            $message = message(true, $httpcode, '', 'Username tidak valid');
        } else if ($jlindo['KDSTATUSAGEN'] != '01' && $jaim['KDROLE'] == '1') {
            $message = message(true, $httpcode, '', 'Akun Anda tidak aktif');
        } else if (count($log) > 0 && $log['SELISIHMENIT'] < 5) {
            $message = message(true, $httpcode, '', 'Silahkan tunggu '.(5-$log['SELISIHMENIT']).' menit lagi untuk kirim ulang');
        } else if ($jlindo['EMAILTETAP'] == '') {
            $message = message(true, $httpcode, '', 'Anda belum memiliki email. Silahkan perbaharui biodata anda dikantor Jiwasraya terdekat');
        } else {
            $this->load->library('email');

            $this->email->from('', 'Jiwasraya Agency Information Management');
            $this->email->to($jlindo['EMAILTETAP']);
            $this->email->bcc('fendy@jiwasraya.co.id');
            $this->email->subject('Akun JAIM');
            $this->email->message("Berikut ini adalah informasi akun anda di aplikasi JAIM<br><br>Nomor Agen : $jaim[USERNAME]<br>Password : $jaim[PASSWORD]<br><br>Silahkan login dan reset ulang password Anda demi keamanan.");
            
            if ($this->email->send()) {
                 $this->mmaster->myinsert('jaim_999_log', $data);
                 $message = message(false, $httpcode, '', "Informasi Akun terkirim ke email ".mask_email($jlindo['EMAILTETAP']));
            } else {
                $message = message(true, $httpcode, '', 'Gagal mengirim email');
            }
        }
        
        // Response
        $this->response($message, $httpcode);
    }
    
    function hubungan_get($kdhubungan = null) {
        if (empty($kdhubungan)) {
            $data = $this->mmaster->get_list_hubungan();
        } else {
            $data = $this->mmaster->get_hubungan($kdhubungan);
        }
        
        $httpcode = \Restserver\Libraries\REST_Controller::HTTP_OK;
        $message = message(false, $httpcode, '', $data);
        
        // Response
        $this->response($message, $httpcode);
    }
    
    function jenis_kelamin_get($kdjeniskelamin = null) {
        if (empty($kdjeniskelamin)) {
            $data = $this->mmaster->get_list_jenis_kelamin();
        } else {
            $data = $this->mmaster->get_jenis_kelamin($kdjeniskelamin);
        }
        
        $httpcode = \Restserver\Libraries\REST_Controller::HTTP_OK;
        $message = message(false, $httpcode, '', $data);
        
        // Response
        $this->response($message, $httpcode);
    }
    
    function pekerjaan_get($kdpekerjaan = null) {
        if (empty($kdpekerjaan)) {
            foreach ($this->mmaster->get_list_pekerjaan() as $i => $v) {
                foreach ($this->mmaster->get_list_resiko($v['KDPEKERJAAN'], null) as $j => $w) {
                    $v[$w['KDJENISRESIKO']] = replace_to_number($w['RESIKO']);
                    $v["PEMBAGI$w[KDJENISRESIKO]"] = replace_to_number($w['PEMBAGI']);
                    $v["FLAG$w[KDJENISRESIKO]"] = $w['FLAG'];
                }
                $data[$i] = $v;
            }
        } else {
            $data = $this->mmaster->get_pekerjaan($kdpekerjaan);
            foreach ($this->mmaster->get_list_resiko($data['KDPEKERJAAN'], null) as $i => $v) {
                $data[$v['KDJENISRESIKO']] = replace_to_number($v['RESIKO']);
                $data["PEMBAGI$v[KDJENISRESIKO]"] = replace_to_number($v['PEMBAGI']);
                $data["FLAG$v[KDJENISRESIKO]"] = $v['FLAG'];
            }
        }
        
        $httpcode = \Restserver\Libraries\REST_Controller::HTTP_OK;
        $message = message(false, $httpcode, '', $data);
        
        // Response
        $this->response($message, $httpcode);
    }
    
    function hobi_get($kdhobi = null) {
        if (empty($kdhobi)) {
            foreach ($this->mmaster->get_list_hobi() as $i => $v) {
                foreach ($this->mmaster->get_list_resiko(null, $v['KDHOBI']) as $j => $w) {
                    $v[$w['KDJENISRESIKO']] = replace_to_number($w['RESIKO']);
                    $v["PEMBAGI$w[KDJENISRESIKO]"] = replace_to_number($w['PEMBAGI']);
                    $v["FLAG$w[KDJENISRESIKO]"] = $w['FLAG'];
                }
                $data[$i] = $v;
            }
        } else {
            $data = $this->mmaster->get_hobi($kdhobi);
            foreach ($this->mmaster->get_list_resiko(null, $data['KDHOBI']) as $i => $v) {
                $data[$v['KDJENISRESIKO']] = replace_to_number($v['RESIKO']);
                $data["PEMBAGI$v[KDJENISRESIKO]"] = replace_to_number($v['PEMBAGI']);
                $data["FLAG$v[KDJENISRESIKO]"] = $v['FLAG'];
            }
        }
        
        $httpcode = \Restserver\Libraries\REST_Controller::HTTP_OK;
        $message = message(false, $httpcode, '', $data);
        
        // Response
        $this->response($message, $httpcode);
    }
    
    function produk_get($kdproduk = null) {
        $kdjabatanagen = $this->input->get('kdjabatan');
        
        if (empty($kdproduk)) {
            $data = $this->mmaster->get_list_produk($kdjabatanagen);
        } else {
            $data = $this->mmaster->get_produk($kdproduk);
        }
        $httpcode = \Restserver\Libraries\REST_Controller::HTTP_OK;
        $message = message(false, $httpcode, '', $data);
        
        // Response
        $this->response($message, $httpcode);
    }
    
    function provinsi_get($kdprovinsi = null) {
        if (empty($kdprovinsi)) {
            $data = $this->mmaster->get_list_provinsi();
        } else {
            $data = $this->mmaster->get_provinsi($kdprovinsi);
        }
        
        $httpcode = \Restserver\Libraries\REST_Controller::HTTP_OK;
        $message = message(false, $httpcode, '', $data);
        
        // Response
        $this->response($message, $httpcode);
    }
    
    function kota_get($kdkotamadya = null) {
        if (empty($kdkotamadya)) {
            $data = $this->mmaster->get_list_kota($this->input->get('kdprovinsi'));
        } else {
            $data = $this->mmaster->get_kota($kdkotamadya);
        }
        
        $httpcode = \Restserver\Libraries\REST_Controller::HTTP_OK;
        $message = message(false, $httpcode, '', $data);
        
        // Response
        $this->response($message, $httpcode);
    }
    
    function kecamatan_get($kdkecamatan = null) {
        if (empty($kdkecamatan)) {
            $data = $this->mmaster->get_list_kecamatan($this->input->get('kdkotamadya'));
        } else {
            $data = $this->mmaster->get_kecamatan($kdkecamatan);
        }
        
        $httpcode = \Restserver\Libraries\REST_Controller::HTTP_OK;
        $message = message(false, $httpcode, '', $data);
        
        // Response
        $this->response($message, $httpcode);
    }
    
    function kelurahan_get($kdkelurahan = null) {
        if (empty($kdkelurahan)) {
            $data = $this->mmaster->get_list_kelurahan($this->input->get('kdkecamatan'));
        } else {
            $data = $this->mmaster->get_kelurahan($kdkelurahan);
        }
        
        $httpcode = \Restserver\Libraries\REST_Controller::HTTP_OK;
        $message = message(false, $httpcode, '', $data);
        
        // Response
        $this->response($message, $httpcode);
    }
    
    function tarif_get() {
        $kdtarif = $this->get('kdtarif');
        $kdproduk = $this->get('kdproduk');
        $kdbenefit = $this->get('kdbenefit');
        $kdjeniskelamin = $this->get('kdjeniskelamin');
        $usiath = $this->get('usiath');
        $usiabl = $this->get('usiabl');
        $bk = $this->get('bk');
        
        $data = $this->mmaster->get_tarif($kdtarif, $kdproduk, $kdbenefit, $kdjeniskelamin, $usiath, $usiabl, $bk);
        $data['TARIF'] = replace_to_number($data['TARIF']);
        
        $httpcode = \Restserver\Libraries\REST_Controller::HTTP_OK;
        $message = message(false, $httpcode, '', $data);
        
        // Response
        $this->response($message, $httpcode);
    }
    
    function cara_bayar_get($kdcarabayar) {
        if (empty($kdcarabayar)) {
            $data = $this->mmaster->get_list_cara_bayar();
        } else {
            $data = $this->mmaster->get_cara_bayar($kdcarabayar);
        }
        
        $httpcode = \Restserver\Libraries\REST_Controller::HTTP_OK;
        $message = message(false, $httpcode, '', $data);
        
        // Response
        $this->response($message, $httpcode);
    }
    
    function dana_get($kdproduk, $kdfund = null) {
        if (empty($kdfund)) {
            foreach ($this->mmaster->get_list_dana($kdproduk) as $i => $v) {
                $v['RENDAH'] = replace_to_number($v['RENDAH']);
                $v['SEDANG'] = replace_to_number($v['SEDANG']);
                $v['TINGGI'] = replace_to_number($v['TINGGI']);
                $data[$i] = $v;
            }
        } else {
            $data = $this->mmaster->get_dana($kdproduk, $kdfund);
            $data['RENDAH'] = replace_to_number($data['RENDAH']);
            $data['SEDANG'] = replace_to_number($data['SEDANG']);
            $data['TINGGI'] = replace_to_number($data['TINGGI']);
        }
        
        $httpcode = \Restserver\Libraries\REST_Controller::HTTP_OK;
        $message = message(false, $httpcode, '', $data);
        
        // Response
        $this->response($message, $httpcode);
    }
}