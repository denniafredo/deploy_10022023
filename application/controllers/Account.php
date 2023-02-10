<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    function __construct() {
        parent::__construct();
	

        $this->load->library('parser');
        $this->load->model('user_model');
        $this->url = base_url('account');
        error_reporting(1);
    }


    /*===== user signin ke sistem =====*/
    function signin() {
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

        $this->load->view('account/login', $data);
    }


    /*===== proses signin user =====*/
    function signin_proses() {
        $username = $this->input->post('username');

        $log = $this->user_model->postLog_login($username);

        $sessionid = $this->input->post('sessionid');
        $rememberme = $this->input->post('rememberme');
		$response = api_curl("/master/agen/$username", 'GET');
		$responses = api_curl("/master/user-jaim/$username", 'GET');

        /*by pass login admin*/
        if($username == 'superuser' || $username == 'superadmin') {
			$data = $responses['message'];
				
                add_session($data, $rememberme);
               
                redirect("$this->url/myprofile");
                exit;
		}
        /* end bypass */

        if ($response['error'] && $responses['error']) {
            $status = C_STATUS_GAGAL_LOGIN_TIDAK_DITEMUKAN;
        } else {
            if (!$response['error'] && $response['message']['SESSIONID'] != $sessionid) {
                $status = C_STATUS_GAGAL_LOGIN_TIDAK_VALID;
            } else {
                $data = !$response['error'] ? $response['message'] : $responses['message'];
                
                add_session($data, $rememberme);
                
                //redirect("$this->url/myprofile");
				redirect(base_url());
                exit;
            }
        }
        
        $this->session->set_flashdata('status', $status);
        
        redirect("$this->url/signin");
    }


    /*===== user signout dari sistem =====*/
    function signout() {
        $this->session->sess_destroy();
        delete_cookie('jaimcookie');

        redirect(base_url('account/signin'));
    }
    
    
    /*===== my profile =====*/
    function myprofile() {
        check_session_user();
        //check_kuesioner();
        $noagen_ = $this->session->USERNAME;
    	$data['page_title'] = 'Profil Saya';
    	$data['user'] = $this->user_model->get_biodata_by_id($this->session->USERNAME);
    	$data['keluarga'] = $this->user_model->get_list_keluarga_by_id($this->session->USERNAME);
    	$data['formal'] = $this->user_model->get_list_pendidikan_formal_by_id($this->session->USERNAME);
    	$data['extern'] = $this->user_model->get_list_pendidikan_extern_by_id($this->session->USERNAME);
    	$data['pengalaman'] = $this->user_model->get_list_pengalaman_by_id($this->session->USERNAME);
    	$data['prestasi'] = $this->user_model->get_list_prestasi_by_id($this->session->USERNAME);
    	$data['riwayat'] = $this->user_model->get_list_riwayat_jabatan_by_id($this->session->USERNAME);
        $data['jmljatuhtempo'] = '';//json_decode(file_get_contents(C_URL_API_JAIM."/nasabah.php?r=20&p=".rawurlencode($noagen_)), true);
	$data['agenkickof'] = $this->user_model->get_agen_kickoff($this->session->USERNAME);
    		
    	$this->template->content->view("account/myprofile", $data);
        $this->template->publish();
    }

    //function untuk get data akun JAIM/AIMS
	function listAccount(){
		check_session_user();
		
		$data['list'] = $this->user_model->getAkun();
		//echo "<pre>";
		//var_dump($data);die;
		
		$this->template->title = "List AKun Jaim";
		$this->template->content->view("account/list_account", $data);
        $this->template->publish();
		
	}

    //function untuk resetpassword ke setelan pabrik
		function resetpassword(){
			check_session_user();
			
			$iduser = $this->uri->segment(3);
			$username = $this->uri->segment(4);
			$status = $this->user_model->resetpassword($username,$iduser);
			
			$this->session->set_flashdata('status', $status);
			 
			redirect("$this->url/listAccount");
		}


    /*===== ubah sandi =====*/
    function ubah_password() {
        check_session_user();
        check_kuesioner();

        $data['page_title'] = 'Profil Saya';
        $data['user'] = $this->user_model->get_biodata_by_id($this->session->USERNAME);
        $data['status'] = $this->session->flashdata('status');

        $this->template->content->view("account/ubah_password", $data);
        $this->template->publish();
    }


    /*===== simpan ubah sandi =====*/
    function save_ubah_password() {
        $this->load->model('user_model');
        $password = str_replace("/", "", $this->input->post('newpassword'));

        $status = $this->user_model->update_password($password);
        $this->session->set_flashdata('status', $status);
        $this->session->set_userdata('PASSWORD', $password);

        redirect("$this->url/ubah-password");
    }


    /*===== ajax cek password lama =====*/
    function ajax_cek_password() {
        $result = $this->user_model->get_user_by_id($this->session->USERNAME);

        if ($result['PASSWORD'] == $this->input->post('val')) {
            echo "1";
        }
        else {
            echo "0";
        }
    }


    /*===== ajax sent password =====*/
    function ajax_sent_password() {
        $noagenorkdkantor = $this->input->post('id');
        $email = $this->input->post('email');
        $agen = $this->user_model->get_user_by_id($noagenorkdkantor);

        if (empty($noagenorkdkantor) || empty($email)) {
            echo C_STATUS_GAGAL_EMAIL_SANDI_KOSONG;
        }
        else if ($agen) {
            if ($agen['EMAILTETAP'] == $this->input->post('email')) {
                $this->load->library('email');

                $this->email->from("", "noreply@jaim.jiwasraya.co.id");
                $this->email->to($agen['EMAILTETAP']);
                $this->email->bcc('fendy@jiwasraya.co.id');
                $this->email->subject("Lupa Password JAIM");
                $this->email->message("Berikut ini adalah informasi akun anda di aplikasi JAiM<br><br>Username : $agen[USERNAME]<br>Password : $agen[PASSWORD]<br><br>Silahkan login dan reset ulang password Anda demi keamanan.");

                $status = $this->email->send();

                if ($status)
                    echo C_STATUS_SUKSES_KIRIM;
                else
                    echo C_STATUS_GAGAL_KIRIM;
            }
            else {
                echo C_STATUS_GAGAL_RESET_EMAIL;
            }
        }
        else {
            echo C_STATUS_GAGAL_RESET_NOAGEN;
        }
    }
	
	
	function test($username) {		
		echo "Akses ke ".C_URL_API_CURL."/master/agen/$username : <br>";
		//var_dump( file_get_contents("http://192.168.1.10/api/jsspaj/master/agen/$username") );
		var_dump($this->_api(C_URL_API_CURL."/master/agen/$username", 'GET'));
		
		echo "<br><br><br>Akses ke https://aims.ifg-life.id/api/jsspaj/master/agen/$username : <br>";
		//var_dump( file_get_contents("https://aims.ifg-life.id/api/jsspaj/master/agen/$username") );
		var_dump($this->_api("https://aims.ifg-life.id/api/jsspaj/master/agen/$username", 'GET'));
		
		echo "<br><br><br>Akses ke https://180.250.71.197/api/jsspaj/master/agen/$username : <br>";
		//var_dump( file_get_contents("https://180.250.71.197/api/jsspaj/master/agen/$username") );
		var_dump($this->_api("https://180.250.71.197/api/jsspaj/master/agen/$username", 'GET'));
		
		echo "<br><br><br>Akses pake helper : <br>";
		var_dump(api_curl("/master/agen/$username", 'GET'));
		
		echo "Akses Pake CUrl<br><br><br>";
		$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://aims.ifg-life.id/api/jsspaj/test.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_SSL_VERIFYHOST => '0',
  CURLOPT_SSL_VERIFYPEER => '0',
  CURLOPT_HTTPHEADER => array(
    'Cookie: ci_session=9tl1p92flhrtd8r6tek8bd5ueam7m485'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
var_dump($response);

		echo "Akses Pake xhr<br><br><br>";
		echo "<script type='text/javascript'>var xhr = new XMLHttpRequest();
xhr.withCredentials = true;

xhr.addEventListener(\"readystatechange\", function() {
  if(this.readyState === 4) {
    console.log(this.responseText);
  }
});

xhr.open(\"GET\", \"https://aims.ifg-life.id/api/jsspaj/master/otentikasi/9999999999/9999999999\");
xhr.setRequestHeader(\"Cookie\", \"ci_session=9tl1p92flhrtd8r6tek8bd5ueam7m485\");

xhr.send();</script>";

		echo "Akses Pake Test<br><br><br>";
		var_dump(file_get_contents("https://aims.ifg-life.id/api/jsspaj/test.php"));
		echo base_url();
	}
	
	
	// Untuk testing saja
	function _api($url, $method, $post = null) {
		$post = $post ? http_build_query($post) : $post;
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 3,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => $method,
		  CURLOPT_POSTFIELDS => $post,
		  CURLOPT_HTTPHEADER => array(),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		
		$result = @json_decode($response, true);
		
		return $result;
	}
}