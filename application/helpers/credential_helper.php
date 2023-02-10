<?php

    /*===== tambah user session =====*/
    function add_session($user, $rememberme) {
        $ci = &get_instance();
        $ci->load->library('encryption');
        
        $session = array(
            'IDUSER' => $user['IDUSER'],
            'KDROLE' => $user['KDROLE'],
            'USERNAME' => $user['USERNAME'],
            'PASSWORD' => $user['PASSWORD'],
            'NAMALENGKAP' => $user['NAMALENGKAP'],
            'KDJABATANAGEN' => $user['KDJABATANAGEN'],
            'KDKANTOR' => $user['KDKANTOR'],
            'KDAREAOFFICE' => $user['KDAREAOFFICE'],
            'KDUNITPRODUKSI' => $user['KDUNITPRODUKSI'],
            'AVATAR' => $user['AVATAR'],
            'POINTOUR' => $user['POINTOUR'],
            'NAMAKANTOR' => $user['NAMAKANTOR'],
            'PHONEKANTOR' => $user['PHONEKANTOR'],
            'EMAILKANTOR' => $user['EMAILKANTOR'],
            'NAMAINDUK' => $user['NAMAINDUK'],
            'PHONEINDUK' => $user['PHONEINDUK'],
            'EMAILINDUK' => $user['EMAILINDUK'],
            'SESSIONID' => md5(uniqid($ci->input->ip_address(), TRUE)),
            'IPADDRESS' => $ci->input->ip_address(),
            'USERAGENT' => substr($ci->input->user_agent(), 0, 120),
            'LASTACTIVITY' => date('d/m/Y H:i:s'),
            'APPVERSION' => $user['VERSI']
        );
        
        $ci->session->set_userdata($session);

        // set cookie file
        if ($rememberme) {
            $userencrypt = $ci->encryption->encrypt($user['USERNAME']);

            $cookie = array(
                'name' => 'jaimcookie',
                'value' => $userencrypt,
                'expire' => 604800, // 7 hari
                'httponly' => true,
				'secure' => true
            );

            $ci->input->set_cookie($cookie);
        }
    }

    /*====== cek user session =====*/
    function check_session_user() {
        $ci = &get_instance();
        $ci->load->library('encryption');
        $ci->load->model('user_model');
        $cookiesetvalue = $ci->input->cookie('jaimcookie', true);

        $session = $ci->session->IDUSER;

        if (isset($session) && !empty($session)) {
            
        } else if (isset($cookiesetvalue) && !empty($cookiesetvalue)) {
            $userdecrypt = $ci->encryption->decrypt($cookiesetvalue);
            $user = $ci->user_model->get_user_by_id($userdecrypt);
            
            add_session($user, 0);
        } else {
            redirect(base_url().'account/signin', 'refresh');
        }
    }
	
	
    /*===== cek user role menu =====*/
    function check_user_role_menu($kd_menu) {
        $CI = &get_instance();
        $CI->load->model('user_model');

        $jml = $CI->user_model->check_user_role_menu($kd_menu);

        if ($jml == 0) {
                show_error('error_401');
        }
    }

    
    /*===== cek kuesioner yang wajib diisi =====*/
    function check_kuesioner() {
        $CI = &get_instance();
        $CI->load->model('kuesioner_model');
        $kuesioner = $CI->kuesioner_model->get_grup_kuesioner_wajib_user();

        if (count($kuesioner) > 0) {
            redirect(base_url("kuesioner?id=$kuesioner[IDGRUP]&kategori=$kuesioner[IDKATEGORI]"));
        }
    }