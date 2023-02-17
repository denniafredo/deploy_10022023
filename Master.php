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
		date_default_timezone_set('Asia/Jakarta');
		// header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Token-Access, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Origin, token-access");
        // header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
		
        $this->load->model('mmaster');
		//$this->methods['otentikasi_post']['limit'] = 5;
		
        //$this->load->model('mmaster');
    }
	
	
	
	public function token_get($id='')
	{
		if(@$id){
			$get = $this->db->get_where('JAIM_900_USER', [
				'USERNAME' => "'".$id."'"
			]);

			if ($get->num_rows() == 1) {
				$row = $get->row();
				if(@token_key_exists($row->TOKEN)){
					$newTokenGenerate = [
						'TOKEN' => "'".token_generate_key()."'"
					];
					token_update_key($row->TOKEN, $newTokenGenerate);
					$data = [
						'status' => true,
						'massage' => "Token Success Generate",
						'data' => $newTokenGenerate['TOKEN']
					];
			
					$this->response( $data, 200 );
				}
			}
		}
		
		$user = $this->mmaster->get_user_log();
		
		shuffle($user);
		$newToken = $user[0]['TOKEN'];
		
		if($newToken == null){
			$newToken = $this->_updateToken($user[0]['IDUSER'], $newToken);
		}
	
		$data = [
			'status' => true,
			'massage' => "Success Get Token",
			'token' => $newToken
		];
		

		$this->response( $data, 200 );
	}
	
	private function _updateToken($id,$token = null){
		$newToken = token_generate_key();
		if($token == null){
			$data = [
				'TOKEN' => "'{$newToken}'"
			];
			$this->db->where('IDUSER',"'{$id}'");
			$this->db->update('JAIM_900_USER', $data);
			
			if($this->db->affected_rows() > 0){
				$token = $newToken;
			}
			
			return $token;
		}
		return $token;
	}
	
	public function getToken_get($ip)
	{
		$get = $this->db->get_where('JAIM_900_USER', [
			'IPADDRESS' => "'{$ip}'"
		]);

		if ($get->num_rows() == 0) {
			$data = [
				'status' => false,
				'massage' => "Data is not valid",
				'data' => $get->row()
			];
		}else{
			$data = [
				'status' => true,
				'massage' => "get data from user data",
				'data' => $get->row()
			];
		}

		$this->response( $data, 200 );
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
	
	public function otentikasi_post()
    {
		$this->load->library('form_validation');

        $setData = $this->form_validation->set_data($this->post());
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');

        if ($this->form_validation->run() == FALSE) {
            $response = [
				'status' => false,
				'massage' => validation_errors(),
				'data' => []
			];

			$this->response($response, 400 );
        } 
        else{
            $username = $this->post('username');
            $password = $this->post('password');

            $user = $this->mmaster->get_agen($username);
            $jlindo = $this->mmaster->get_agenjlindo($username);
            $httpcode = \Restserver\Libraries\REST_Controller::HTTP_OK;
		

        // Jika username tidak ditemukan
            if (@$user && count($user) == 0) {
                $httpcode = \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND;

                $message = message(true, $httpcode, '', 'Username or Password tidak valid');
            }
        // Jika password salah
            else if ($password != $user['PASSWORD']) {
                $httpcode = \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST;
                $message = message(true, $httpcode, 'password', 'Username or Password tidak valid');
            } 
        // Jika username tidak aktif
            else if ($jlindo['KDSTATUSAGEN'] != '01' && ($user['KDROLE'] == '1'  || $user['KDROLE'] == '29')) {
                $httpcode = \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST;
                $message = message(true, $httpcode, '', 'Akun Anda tidak aktif');
            } else {
                $data['sessionid'] = session_id();
				
				/*
					Added this function for generate token access, for user to hit api
					Add by : Farhan Afif Aldiansyah
					Dated  : 11 Agustus 2022 
				
				if(empty($user['TOKEN'])){
					$forUpdate = ['TOKEN' => "'".token_generate_key()."'"];
					$this->db->where('username', "'{$username}'");
					$this->db->update('jaim_900_user', $forUpdate);
				}
				
					end this function
				*/
				
                $this->mmaster->myupdate('jaim_900_user', $data, 'username', $username);

                $message = message(false, $httpcode, '', $data);
            }

        // Response
            $this->response($message, $httpcode);
			
        }		
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
	
	function history_mutasi_get(){
		
		$arrWhere = [
			'BUILDID' => "'{$this->input->get('buildId')}'",
			'KDMUTASI' => 52
		];
		
		$getMutasi = $this->mmaster->get_history_mutasi($arrWhere, 'c.TGLMUTASI', 'asc')->result();
		
		$getStatusMutasi = $this->mmaster->get_history_mutasi($arrWhere, 'c.TGLMUTASI', 'asc')->row();
		
		$getPolis = $this->mmaster->get_polis_mutasi(['BUILDID' => "'{$this->input->get('buildId')}'"])->row();
		
		$data = [
			'result' => true,
			'message' => 'Successful get jenis document',
			'data' => $getMutasi,
			'status' => $getStatusMutasi,
			'polis' => $getPolis
		];
        
        $httpcode = \Restserver\Libraries\REST_Controller::HTTP_OK;
        $message = message(false, $httpcode, '', $data);
        
        // Response
        $this->response($message, $httpcode);
	}
	
	function history_followup_get(){
		
		$arrWhere = [
			'KDSTATUS' => 9,
			'KDMUTASI' => 52
		];
		
		/*
		$getStatusMutasi = $this->mmaster->get_history_mutasi($arrWhere)->result();
		
		if(@$this->input->get('tanggal')){
			$arrWhere['trunc(AGENDA_DATE)'] = "TO_DATE('{$this->input->get('tanggal')}', 'dd-mm-yyyy')";
			$getStatusMutasi = $this->mmaster->get_history_mutasi($arrWhere, 'c.AGENDA_DATE', 'asc')->result();
		}
		*/
		
		$getStatusMutasi = $this->mmaster->history_mutasi_followup($arrWhere);
		
		if(@$this->input->get('tanggal')){
			$arrWhere['AGENDA_DATE'] = "TO_DATE('{$this->input->get('tanggal')}', 'dd-mm-yyyy')";
			$getStatusMutasi = $this->mmaster->history_mutasi_followup($arrWhere, 'tgl_mutasi DESC');
		}elseif(@$this->input->get('from') && @$this->input->get('to')){
			$arrWhere['from'] = "TO_DATE('{$this->input->get('from')}', 'dd-mm-yyyy')";
			$arrWhere['to'] = "TO_DATE('{$this->input->get('to')}', 'dd-mm-yyyy')";
			$getStatusMutasi = $this->mmaster->history_mutasi_followup($arrWhere, 'z.AGENDA_DATE DESC');
		}elseif(@$this->input->get('from') && !$this->input->get('to')){
			$arrWhere['from'] = "TO_DATE('{$this->input->get('from')}', 'dd-mm-yyyy')";
			$arrWhere['to'] = "TO_DATE('".date('d-m-Y')."', 'dd-mm-yyyy')";
			$getStatusMutasi = $this->mmaster->history_mutasi_followup($arrWhere, 'z.AGENDA_DATE DESC');
		}elseif(!$this->input->get('from') && @$this->input->get('to')){
			$arrWhere['from'] = "TO_DATE('".date('d-m-Y')."', 'dd-mm-yyyy')";
			$arrWhere['to'] = "TO_DATE('{$this->input->get('to')}', 'dd-mm-yyyy')";
			$getStatusMutasi = $this->mmaster->history_mutasi_followup($arrWhere, 'z.AGENDA_DATE DESC');
		}elseif(@$this->input->get('bundle')){
			$arrWhere['bundle'] = "TO_DATE('{$this->input->get('bundle')}', 'dd-mm-yyyy')";
			$getStatusMutasi = $this->mmaster->history_mutasi_followup($arrWhere, 'z.AGENDA_DATE DESC');
		}
		
		
		
		
		$data = [
			'result' => true,
			'message' => 'Successful get jenis document',
			'data' => $getStatusMutasi
		];
        
        $httpcode = \Restserver\Libraries\REST_Controller::HTTP_OK;
        $message = message(false, $httpcode, '', $data);
        
        // Response
        $this->response($message, $httpcode);
	}
	
	private function _changeMonthToIndo($month){
		switch ($month) {
			case '01':
				$blm = "Januari";
				break;
			case '02':
				$blm = "Februari";
				break;
			case '03':
				$blm = "Maret";
				break;
			case '04':
				$blm = "April";
				break;
			case '05':
				$blm = "Mei";
				break;
			case '06':
				$blm = "Juni";
				break;
			case '07':
				$blm = "Juli";
				break;
			case '08':
				$blm = "Agustus";
				break;
			case '09':
				$blm = "September";
				break;
			case '10':
				$blm = "Oktober";
				break;
			case '11':
				$blm = "November";
				break;
			default:
				$blm = "Desember";
				break;
		}
		return $blm;
	}
	
	function followup_polis_post(){
		$this->form_validation->set_rules('agen', 'Agen Terkait', 'required');
        $this->form_validation->set_rules('nospaj', 'No SPAJ', 'required');
        $this->form_validation->set_rules('nopolis', 'No POLIS', 'required');
        $this->form_validation->set_rules('prefix', 'No PREFIX PERTANGGUNGAN', 'required');
        $this->form_validation->set_rules('noper', 'No PERTANGGUNGAN', 'required');
		$this->form_validation->set_rules('hasil', 'Keteranan Hasil', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $response = [
                'status' => false,
                'massage' => validation_errors('<div class="error">', '</div>'),
                'data' => []
            ];
            $this->response($response, self::HTTP_BAD_REQUEST );
        } else{
			$tanggal = date('d-m-Y H:i:s');
			$tgl = date('d {-} Y', strtotime($this->input->post('tanggal')));
			
			$month = $this->_changeMonthToIndo(date('m', strtotime($this->input->post('tanggal'))));
			$tgl = str_replace('{-}', $month, $tgl);
			
			$waktu = date('H:i', strtotime($this->input->post('tanggal')));
			$tglInsert = date('d-m-Y H:i:s', strtotime($this->input->post('tanggal')));

			$dataMutasi = [
				'TGLMUTASI' => "TO_DATE('{$tanggal}', 'dd-mm-yyyy hh24:mi:ss')",
				'PREFIXPERTANGGUNGAN' => "'{$this->input->post('prefix')}'",
				'NOPERTANGGUNGAN' => "'{$this->input->post('noper')}'",
				'KDMUTASI' => 52,
				'KETERANGANMUTASI' => "'Followup Agen <b>{$this->input->post('username')}</b> : {$this->input->post('hasil')} pada {$tgl} pukul {$waktu}'",
				'KDSTATUS' => 9,
				'AGENDA_DATE' => "TO_DATE('{$tglInsert}', 'dd-mm-yyyy hh24:mi:ss')",
				'FINALSTATUS' => 1
			];
			
			$result = $this->mmaster->insertMutasiWelcoming($dataMutasi);
			if($result){
				$response = [
					'status' => true,
					'massage' => 'Successfully Upload Followup Agent',
					'data' => [],
					'result' => 0
				];
				$http = 201;
			}else{
				$response[] = [
					'status' => false,
					'massage' => 'Error Upload! Please Try Again.',
					'data' => [],
					'result' => 0
				];
				$http = 400;
			}
			
            $this->response($response, $http);
		}
	}
	
	function jenis_document_get($jenis='') {
		
		$getJenisDokumen = $this->mmaster->get_jenis_document()->result();
		//$this->response($getJenisDokumen, 200);
		
		if(@$jenis){
			$getJenisDokumen = $this->mmaster->get_jenis_document([
                    'ID' => "'{$jenis}'"
            ])->row();
		}
				
        $data = [
			'result' => true,
			'message' => 'Successful get jenis document',
			'data' => $getJenisDokumen
		];
        
        $httpcode = \Restserver\Libraries\REST_Controller::HTTP_OK;
        $message = message(false, $httpcode, '', $data);
        
        // Response
        $this->response($message, $httpcode);
    }
	
	public function bundle_document_local_get()
	{
		
		$buildId = '';
		
		$getSPAJOnline = $this->mmaster->get_processBuildWelcoming([
			'NOSPAJ' => "'{$this->input->get('nosp')}'"
		]);

		$collectSPAJOnline = $getSPAJOnline->row();

		if ($getSPAJOnline->num_rows() > 0) {
			$buildId = $collectSPAJOnline->BUILDID; // Collect Build Id to processed
		}else{
			$response = [
				 'status' => false,
				 'massage' => 'Polis not found',
				 'data' => []
			];
			$http = 404;
			$this->response($response, $http);
		}

		$paramsDocument = [
			'BUILDID' => "'{$buildId}'",
			//'NOID' => "'{$this->input->get('noid')}'"
		];
		
		$getDocument = $this->mmaster->get_BuildId($paramsDocument);
		
		if($getDocument->num_rows() == 0){
			$response = [
				 'status' => false,
				 'massage' => 'File is not found',
				 'data' => []
			];
			$http = 404;
			$this->response($response, $http);
		}
		$document = [];
		foreach($getDocument->result() as $docs){
			$document[] = [
				"ID" => $docs->ID,
				"BUILDID" => $docs->BUILDID,
				"NOID" => $docs->NOID,
				"NOAGEN" => $docs->NOAGEN,
				"JENIS_DOKUMEN_ID" => $docs->JENIS_DOKUMEN,
				"META_FILES" => C_URL_AIMS.$docs->META_FILES
			];
		}
		$response = [
			 'status' => true,
			 'massage' => 'Successfully get file uploaded',
			 'data' => $document,
		];
		$http = 201;
		$this->response($response, $http);
	}
	
	public function bundle_document_ftp_get()
	{
		$this->load->library('ftp');
		$this->load->helper('download');

		$config['hostname'] = 'ftp://storage.ifg-life.id';
		$config['username'] = 'root';
		$config['password'] = 'ahc6y96uy7xik6x96hbwd94oi0f8ap';
		$config['debug']    = TRUE;
		$config['port']     = 21;

		$this->ftp->connect($config);
	
		$buildId = '';
		
		$getSPAJOnline = $this->mmaster->get_processBuildWelcoming([
			'NOSPAJ' => "'{$this->input->get('nosp')}'"
		]);

		$collectSPAJOnline = $getSPAJOnline->row();

		if ($getSPAJOnline->num_rows() > 0) {
			$buildId = $collectSPAJOnline->BUILDID; // Collect Build Id to processed
		}else{
			$response = [
				 'status' => false,
				 'massage' => 'Polis not found',
				 'data' => []
			];
			$http = 404;
			$this->response($response, $http);
		}

		$paramsDocument = [
			'BUILDID' => "'{$buildId}'",
			//'NOID' => "'{$this->input->get('noid')}'"
		];
		
		$getDocument = $this->mmaster->get_BuildId($paramsDocument);
		
		if($getDocument->num_rows() == 0){
			$response = [
				 'status' => false,
				 'massage' => 'File is not found',
				 'data' => []
			];
			$http = 404;
			$this->response($response, $http);
		}
		$document = [];
		foreach($getDocument->result() as $docs){
			$list = $this->ftp->list_files('/VOLUME1/JLINDO/WELCOME/'.$docs->META_FILES);
			$document[] = [
				"ID" => $docs->ID,
				"BUILDID" => $docs->BUILDID,
				"NOID" => $docs->NOID,
				"NOAGEN" => $docs->NOAGEN,
				"JENIS_DOKUMEN_ID" => $docs->JENIS_DOKUMEN,
				"META_FILES" => $list[0]
			];
		}
		$response = [
			 'status' => true,
			 'massage' => 'Successfully get file uploaded',
			 'data' => $document,
		];
        $this->ftp->close();
        
		$http = 201;
		$this->response($response, $http);
		
		

        /*
		foreach ($list as $val) {

			$local = $temp_file = tempnam(sys_get_temp_dir(), $val);
			$download = $this->ftp->download($val, $local, FTP_BINARY);
			
			$data = file_get_contents($local);
			
			force_download(str_replace("/VOLUME1/JLINDO/WELCOME/", '', $val), $data);
			unlink($local);
		}
		
        */
	}
	
	//method validate image yang nantinya akan di panggil dalam validasi form menggunakan callback
    private function _valid_files($files)
    {
        $check = TRUE;
        $message = '';
        if ((!isset($files)) || $files['size'] == 0) {
            $this->form_validation->set_message('valid_files', 'The {field} field is required');
            $check = FALSE;
        } else {
            $allowedExts = array("pdf", "png", "jpg", "jpeg", "mp4", "m4a", "ogg", "mp3", "aac","webm");
            $extension = pathinfo($files["name"], PATHINFO_EXTENSION);
            $detectedType = exif_imagetype($files['tmp_name']);
            $type = $files['type'];

            if (!in_array($extension, $allowedExts)) {
                $this->form_validation->set_message('valid_files', "Invalid file extension {$extension}");
                $message = "Invalid file extension {$extension}";
                $check = FALSE;
            }
        }
        return [
            'result' => $check,
            'message' => $message
        ];
    }
	
	// For Welcoming Call
    public function welcoming_call_post()
    {
        $this->form_validation->set_rules('nosp', 'No SPAJ', 'required');
        $this->form_validation->set_rules('noid', 'No Identitas', 'required');
        $this->form_validation->set_rules('noagen', 'No Agen', 'required');
        $this->form_validation->set_rules('nopolis', 'No POLIS', 'required');
        $this->form_validation->set_rules('prefix', 'No PREFIX PERTANGGUNGAN', 'required');
        $this->form_validation->set_rules('noper', 'No PERTANGGUNGAN', 'required');

        //$this->form_validation->set_rules('item[][]', 'Item List', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $response = [
                'status' => false,
                'massage' => validation_errors('<div class="error">', '</div>'),
                'data' => []
            ];
            $this->response($response, self::HTTP_BAD_REQUEST );
        } else{
            $response = [];
            $dataMutasi = [];
            $http = 200;            
            
            // Collect master data
            $data = [
                'NOID' => "'{$this->input->post('noid')}'",
                'NOAGEN' => "'{$this->input->post('noagen')}'",
            ];

            // Collect Build id from SPAJ ONLINE in NADM Database
            if (@$this->input->post('nosp') && empty($this->input->post('buildid'))) {
                $getSPAJOnline = $this->mmaster->get_processBuildWelcoming([
                    'NOSPAJ' => "'{$this->input->post('nosp')}'"
                ]);

                $collectSPAJOnline = $getSPAJOnline->row();

                if ($getSPAJOnline->num_rows() > 0) {
                    $data['BUILDID'] = $collectSPAJOnline->BUILDID; // Collect Build Id to processed
                }
            }
			
			$tanggal = date('d-m-Y H:i:s');
			$addOn = '';
            // Check status welcoming call process
            if (@$this->input->post('status') == 1 || @$this->input->post('status') == 2) { // if welcoming call success
                foreach ($this->input->post('item') as $key => $val) {
					// Get Existing Data on Tabel Jaim_302_Document
					$getId = $this->mmaster->get_BuildId([
						'BUILDID' => "'{$data['BUILDID']}'",
						'NOID' => "'{$this->input->post('noid')}'",
						'JENIS_DOKUMEN_ID' => "'{$val['status']}'"
					]);
                    $data['JENIS_DOKUMEN_ID'] = $val['status'];
                    
                    if (@$_FILES['item']['name'][$key]) {

                        $_FILES['upload']['name']       = $_FILES['item']['name'][$key]['upload'];
                        $_FILES['upload']['type']       = $_FILES['item']['type'][$key]['upload'];
                        $_FILES['upload']['tmp_name']   = $_FILES['item']['tmp_name'][$key]['upload'];
                        $_FILES['upload']['error']      = $_FILES['item']['error'][$key]['upload'];
                        $_FILES['upload']['size']       = $_FILES['item']['size'][$key]['upload'];
                        
                        $fileUpload = $this->upload_document($_FILES['upload'], $data);
                        
                        if ($fileUpload['result']) { // Action upload success result is 'true'
                            $data['META_FILES'] = "'{$fileUpload['namefile']}'"; // collect name file after upload
							
                            $href = $fileUpload['namefile'];
							
							$tanggal = date('d-m-Y');
                            if ($getId->num_rows() > 0) {
                                $data['UPDATED_AT'] = "TO_DATE('{$tanggal}', 'dd-mm-yyyy')";
                                $whereUpdate = [
                                    'ID' => "'{$getId->row()->ID}'"
                                ];
                                $result = $this->mmaster->updateDokumen($data, $whereUpdate);
								
                            }else{
                                $data['ID'] = 'SEQ_DOKUMEN.NEXTVAL';
                                $data['CREATED_AT'] = "TO_DATE('{$tanggal}', 'dd-mm-yyyy')";
                                $result = $this->mmaster->insertDokumen($data);
                            }

                            if($result){
								
								// Added file attach
								if(@$val['status'] == 6){
									$addOn = '<b><a href="'.C_URL_AIMS.$href.'" target="_blank">Attach File!</a></b>';
								}
								
                                $response = [
                                     'status' => true,
                                     'massage' => $fileUpload['doc_type'] . ' Successfully Upload',
                                     'data' => [],
									 'result' => 1
                                ];
                                $http = 201;
                            }
                        }
                    }
                }
				
				
				$tanggal = date('d-m-Y H:i:s');
				// Added mutasi history
				//$ket_Mutasi = (@$val['status'] == 1) ? 
				$ket_Mutasi = (@$this->input->post('status') == 1) ? 
					"'Welcoming Call dengan Nomor Polis <b>{$this->input->post('newNopolis')}</b> dan Nama Tertanggung <b>{$this->input->post('namatertanggung')}</b> pada tanggal {$tanggal} telah <b>BERHASIL</b> di laksanakan oleh {$this->input->post('pelaksana')}. {$addOn}'" : 
					"'Welcoming Call dengan Nomor Polis <b>{$this->input->post('newNopolis')}</b> dan Nama Tertanggung <b>{$this->input->post('namatertanggung')}</b> pada tanggal {$tanggal} telah <b>BERHASIL</b> di laksanakan oleh {$this->input->post('pelaksana')}, dengan catatan {$this->input->post('keterangan')}. {$addOn}'";
				
				$dataMutasi = [
					'TGLMUTASI' => "TO_DATE('{$tanggal}', 'dd-mm-yyyy hh24:mi:ss')",
					'PREFIXPERTANGGUNGAN' => "'{$this->input->post('prefix')}'",
					'NOPERTANGGUNGAN' => "'{$this->input->post('noper')}'",
					'KDMUTASI' => 52,
					'KETERANGANMUTASI' => $ket_Mutasi,
					//'PEMEGANGPOLIS' => "'{$this->input->post('noid')}'",
					'KDSTATUS' => $this->input->post('status'),
					'FINALSTATUS' => 1
				];
				
				$this->mmaster->insertMutasiWelcoming($dataMutasi);
				
            }else{ // if welcoming call failed			
                
				foreach ($this->input->post('item') as $key => $val) {
					if(@$val['status'] == 6){
						// Get Existing Data on Tabel Jaim_302_Document
						$getId = $this->mmaster->get_BuildId([
							'BUILDID' => "'{$data['BUILDID']}'",
							'NOID' => "'{$this->input->post('noid')}'",
							'JENIS_DOKUMEN_ID' => "'{$val['status']}'"
						]);
						$data['JENIS_DOKUMEN_ID'] = $val['status'];
						
						if (@$_FILES['item']['name'][$key]) {

							$_FILES['upload']['name']       = $_FILES['item']['name'][$key]['upload'];
							$_FILES['upload']['type']       = $_FILES['item']['type'][$key]['upload'];
							$_FILES['upload']['tmp_name']   = $_FILES['item']['tmp_name'][$key]['upload'];
							$_FILES['upload']['error']      = $_FILES['item']['error'][$key]['upload'];
							$_FILES['upload']['size']       = $_FILES['item']['size'][$key]['upload'];
							
							$fileUpload = $this->upload_document($_FILES['upload'], $data);
							
							if ($fileUpload['result']) { // Action upload success result is 'true'
								$data['META_FILES'] = "'{$fileUpload['namefile']}'"; // collect name file after upload
								
								$href = $fileUpload['namefile'];
								
								$tanggal = date('d-m-Y');
								if ($getId->num_rows() > 0) {
									$data['UPDATED_AT'] = "TO_DATE('{$tanggal}', 'dd-mm-yyyy')";
									$whereUpdate = [
										'ID' => "'{$getId->row()->ID}'"
									];
									$result = $this->mmaster->updateDokumen($data, $whereUpdate);
									
								}else{
									$data['ID'] = 'SEQ_DOKUMEN.NEXTVAL';
									$data['CREATED_AT'] = "TO_DATE('{$tanggal}', 'dd-mm-yyyy')";
									$result = $this->mmaster->insertDokumen($data);
								}

								if($result){
									// Added file attach
									if(@$val['status'] == 6){
										$addOn = '<b><a href="'.C_URL_AIMS.$href.'" target="_blank">Attach File!</a></b>';
									}
									
									$response = [
										 'status' => true,
										 'massage' => $fileUpload['doc_type'] . ' Successfully Upload',
										 'data' => [],
										 'result' => 1
									];
									$http = 201;
								}
							}else{
								$response = [
									 'status' => false,
									 'massage' => $fileUpload['doc_type'] . ' Error Upload! '. $fileUpload['error'],
									 'data' => [],
									 'result' => 1
								];
								$http = 400;
								$this->response($response, $http);
							}
						}else{
							$response = [
								 'status' => false,
								 'massage' => 'Error Upload! File is invalid upload',
								 'data' => [],
								 'result' => 1
							];
							$http = 400;
							$this->response($response, $http);
						}
					}
                }
				$tanggal = date('d-m-Y H:i:s');
                $dataMutasi = [
                    'TGLMUTASI' => "TO_DATE('{$tanggal}', 'dd-mm-yyyy hh24:mi:ss')",
                    'PREFIXPERTANGGUNGAN' => "'{$this->input->post('prefix')}'",
                    'NOPERTANGGUNGAN' => "'{$this->input->post('noper')}'",
                    'KDMUTASI' => 52,
                    'KETERANGANMUTASI' => "'Welcoming Call dengan Nomor Polis <b>{$this->input->post('newNopolis')}</b> dan Nama Tertanggung <b>{$this->input->post('namatertanggung')}</b> pada tanggal {$tanggal} telah <b>GAGAL</b> di laksanakan oleh {$this->input->post('pelaksana')}, di karenakan {$this->input->post('keterangan')}. {$addOn}'",
                    //'PEMEGANGPOLIS' => "'{$this->input->post('noid')}'",
                    'KDSTATUS' => 0,
					'FINALSTATUS' => 1
                ];
                
                $result = $this->mmaster->insertMutasiWelcoming($dataMutasi);
				
				if($result){
					$response = [
						'status' => true,
						'massage' => 'Successfully Upload Welcoming Call',
						'data' => [],
						'result' => 0
					];
					$http = 201;
				}else{
					$response = [
						'status' => false,
						'massage' => 'Error Upload! Please Try Again.',
						'data' => [],
						'result' => 0
					];
					$http = 400;
				}
            }
            
            $this->response($response, $http);
        }
    }
	
	// For penawaran
	public function dokumen_penawaran_post()
    {
        $this->form_validation->set_rules('buildid', 'Build Id', 'required');
        $this->form_validation->set_rules('noid', 'No Identitas', 'required');
        $this->form_validation->set_rules('noagen', 'No Agen', 'required');
        $this->form_validation->set_rules('item[][]', 'Item List', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $response = [
                'status' => false,
                'massage' => validation_errors('<div class="error">', '</div>'),
                'data' => []
            ];
            $this->response($response, self::HTTP_BAD_REQUEST );
        } else{
            $response = [];
            $http = 200;
			
            $data = [
                'BUILDID' => "'{$this->input->post('buildid')}'",
                'NOID' => "'{$this->input->post('noid')}'",
                'NOAGEN' => "'{$this->input->post('noagen')}'",
            ];
			
            foreach ($this->input->post('item') as $key => $val) {
				$getId = $this->mmaster->get_BuildId([
					'BUILDID' => "'{$this->input->post('buildid')}'",
					'NOID' => "'{$this->input->post('noid')}'",
					'JENIS_DOKUMEN_ID' => "'{$val['status']}'"
				]);
				
				$data['JENIS_DOKUMEN_ID'] = $val['status'];
				
                if (@$_FILES['item']['name'][$key]) {
                    

                    $_FILES['upload']['name'] = $_FILES['item']['name'][$key]['upload'];
                    $_FILES['upload']['type'] = $_FILES['item']['type'][$key]['upload'];
                    $_FILES['upload']['tmp_name'] = $_FILES['item']['tmp_name'][$key]['upload'];
                    $_FILES['upload']['error'] = $_FILES['item']['error'][$key]['upload'];
                    $_FILES['upload']['size'] = $_FILES['item']['size'][$key]['upload'];
					
                    $fileUpload = $this->upload_document($_FILES['upload'], $data);
					
                    if ($fileUpload['result']) {
                        $data['META_FILES'] = "'{$fileUpload['namefile']}'";
						$tanggal = date('d-m-Y');
						if ($getId->num_rows() == 1) {
							$data['UPDATED_AT'] = "TO_DATE('{$tanggal}', 'dd-mm-yyyy')";
							$whereUpdate = [
								'ID' => "'{$getId->row()->ID}'"
							];
							$result = $this->mmaster->updateDokumen($data, $whereUpdate);
							$msg = 'Update';
						}else{
							$data['ID'] = 'SEQ_DOKUMEN.NEXTVAL';
							$data['CREATED_AT'] = "TO_DATE('{$tanggal}', 'dd-mm-yyyy')";
							$result = $this->mmaster->insertDokumen($data);
							$msg = 'Create New';
						}
						
						if($result){
							$response[] = [
								 'status' => true,
								 'massage' => $fileUpload['doc_type'] . ' Successfully '. $msg .' Upload',
								 'data' => [],
								 'result' => 1
							];
							$http = 201;
						}else{
							$response[] = [
								 'status' => false,
								 'massage' => $fileUpload['doc_type'] . ' Error Upload! '. $fileUpload['error'],
								 'data' => $getId->row(),
								 'result' => 0
							];
							$http = 400;
						}
					}else{
						$response[] = [
							 'status' => false,
							 'massage' => $fileUpload['doc_type'] . ' Error Upload! '. $fileUpload['error'],
							 'data' => [],
							 'result' => 0
						];
						$http = 400;
					}
                }
            }
			$this->response($response, $http);
        }
    }
	
	private function upload_document_local($files, $support)
    {
        $check = TRUE;
        $message = '';
        if ((!isset($files)) || $files['size'] == 0) {
            $message = 'The field is required';
            $check = FALSE;
        } else {
			if($support['JENIS_DOKUMEN_ID'] == 5 || $support['JENIS_DOKUMEN_ID'] == 2){
				$allowedExts = array("mp4", "m4a", "ogg", "mp3", "aac","gsm","webm");
			}elseif($support['JENIS_DOKUMEN_ID'] == 6){
				$allowedExts = array("pdf");
			}else{
				$allowedExts = array("pdf", "png", "jpg", "jpeg", "mp4", "m4a", "ogg", "mp3", "aac","webm");
			}
            
            $extension = pathinfo($files["name"], PATHINFO_EXTENSION);
            $detectedType = exif_imagetype($files['tmp_name']);
            $type = $files['type'];

            if (!in_array($extension, $allowedExts)) {
                $message = "Invalid file extension {$extension}";
                $check = FALSE;
            }else{
                $getJenisDokumen = $this->mmaster->get_jenis_document([
                    'ID' => "'{$support['JENIS_DOKUMEN_ID']}'"
                ])->row();

                if ($support['JENIS_DOKUMEN_ID'] == 5) {
                    $status = 'Welcoming Call';
                }elseif ($support['JENIS_DOKUMEN_ID'] == 6) {
                    $status = 'Attach';
                }else{
                    $status = 'Penawaran';
                }
				
                // Set the config upload
                $config['allowed_types']        = '*';
                $config['overwrite']            = 1;
                $config['remove_spaces']        = TRUE;
				
				if($support['JENIS_DOKUMEN_ID'] != 5 && $support['JENIS_DOKUMEN_ID'] != 2){
					$config['max_size']			= 1024*10;
				}

                $config['upload_path']          = './assets/web/upload/'.strtolower(str_replace(' ','_', $getJenisDokumen->JENIS_DOKUMEN)).'/';

                //$keyTab = random_string('numeric', 6);
				$keyTab = date('dmYHis');
				
				$support['NOAGEN'] = preg_replace("/[^a-zA-Z0-9]/", "", $support['NOAGEN']);
				$filename = strtolower(str_replace(' ', '_', "{$getJenisDokumen->JENIS_DOKUMEN} {$support['NOAGEN']} {$support['BUILDID']} {$status} {$support['NOID']}"));
				//$putObject = $this->_ftp_put_ci($files, $filename);
                
				if($support['JENIS_DOKUMEN_ID'] == 6){
					$filename .= " {$keyTab}";
				}
				
				$config['file_name'] = $filename;
                $this->load->library('upload',$config);
				
                if ($this->upload->do_upload('upload')){ 
					$newFileName = str_replace('/opt/bitnami/apps/aims/htdocs', '', $this->upload->data()['file_path']);
					$newFileName .= str_replace("'", "",$this->upload->data()['file_name']);
					
                    $return = array(
                        'result'    => true, 
                        'file'      => [],
						'namefile'	=> $newFileName,
						'doc_type' 	=> $getJenisDokumen->JENIS_DOKUMEN,
                        'error'     => '',
						'message'	=> 'Success'
                    );
                }else{
                    $return = array(
                        'result'    => false, 
                        'file'      => [], 
						'namefile'	=> '',
						'doc_type' 	=> $getJenisDokumen->JENIS_DOKUMEN,
                        'error'     => $this->upload->display_errors(),
						'message'	=> 'Failed'
                    );
                }
                return $return;
            }
        }
    }

    private function upload_document($files, $support)
    {
        $check = TRUE;
        $message = '';
        if ((!isset($files)) || $files['size'] == 0) {
            $message = 'The field is required';
            $check = FALSE;
        } else {
			if($support['JENIS_DOKUMEN_ID'] == 5 || $support['JENIS_DOKUMEN_ID'] == 2){
				$allowedExts = array("mp4", "m4a", "ogg", "mp3", "aac","gsm","webm");
			}elseif($support['JENIS_DOKUMEN_ID'] == 6){
				$allowedExts = array("pdf");
			}else{
				$allowedExts = array("pdf", "png", "jpg", "jpeg", "mp4", "m4a", "ogg", "mp3", "aac","webm");
			}
            
            $extension = pathinfo($files["name"], PATHINFO_EXTENSION);
            $detectedType = exif_imagetype($files['tmp_name']);
            $type = $files['type'];

            if (!in_array($extension, $allowedExts)) {
                $message = "Invalid file extension {$extension}";
                $check = FALSE;
            }else{
                $getJenisDokumen = $this->mmaster->get_jenis_document([
                    'ID' => "'{$support['JENIS_DOKUMEN_ID']}'"
                ])->row();

                if ($support['JENIS_DOKUMEN_ID'] == 5) {
                    $status = 'Welcoming Call';
                }elseif ($support['JENIS_DOKUMEN_ID'] == 6) {
                    $status = 'Attach';
                }else{
                    $status = 'Penawaran';
                }

				/*
                // Set the config upload
                $config['allowed_types']        = 'pdf|jpeg|jpg|png|mp4|ogg|mp3|m4a|aac|gsm';
                $config['overwrite']            = 1;
                $config['remove_spaces']        = TRUE;
				
				if($support['JENIS_DOKUMEN_ID'] != 5){
					$config['max_size']			= 1024;
				}

                $config['upload_path']          = './assets/web/upload/'.strtolower(str_replace(' ','_', $getJenisDokumen->JENIS_DOKUMEN)).'/';

                $keyTab = random_string('numeric', 6);
                // $config['file_name'] = strtolower(str_replace(' ', '_', "{$getJenisDokumen['jenis_dokumen']}/{$support['noagen']} {$support['buildid']} {$keyTab} {$status} ". $files['upload']['name']));
				*/
				$keyTab = date('dmYHis');
                
                $support['NOAGEN'] = preg_replace("/[^a-zA-Z0-9]/", "", $support['NOAGEN']);
                $filename = strtolower(str_replace(' ', '_', "{$getJenisDokumen->JENIS_DOKUMEN} {$support['NOAGEN']} {$support['BUILDID']} {$status} {$support['NOID']} {$files['name']}")); //add $files[name]
                if($support['JENIS_DOKUMEN_ID'] == 6){
                    $filename .= " {$keyTab}";
                }
				$putObject = $this->_ftp_put_ci($files, $filename);
                
				/*
				$config['file_name'] = $filename;
                $this->load->library('upload',$config);
				*/
                if ($putObject){ 
					//$newFileName = str_replace('/opt/bitnami/apps/aims/htdocs', '', $this->upload->data()['file_path']);
					$filename = str_replace("'", "",$filename);
					
                    $return = array(
                        'result'    => true, 
                        'file'      => [],
						'namefile'	=> $filename,
						'doc_type' 	=> $getJenisDokumen->JENIS_DOKUMEN,
                        'error'     =>  $putObject['message'],
						'message'	=> 'Success'
                    );
                }
                else{
                    $return = array(
                        'result'    => false, 
                        'file'      =>'', 
						'namefile'	=> '',
						'doc_type' 	=> $getJenisDokumen->JENIS_DOKUMEN,
                        'error'     => $putObject['message'],
						'message'	=> 'Failed'
                    );
                }
				
                return $return;
            }
        }
    }
	
	private function _ftp_put_ci($filex, $filename){
		$this->load->library('ftp');
		$remote_file = "/VOLUME1/JLINDO/WELCOME/$filename";
		
		$config['hostname'] = 'ftp://storage.ifg-life.id';
        $config['username'] = 'root';
        $config['password'] = 'ahc6y96uy7xik6x96hbwd94oi0f8ap';
        $config['debug']    = TRUE;
        $config['port']     = 21;
		
		$this->ftp->connect($config);

		$return = $this->ftp->upload($filex['tmp_name'], $remote_file, 'ascii', 0775);

		$this->ftp->close();
		
			if (!$return){
				$msg = $php_errormsg;
				$result = array(
					"status"=>FALSE,
					"message"=>"Failed to move to FTP Server. please reupload."
				);
			}
			else{
				$result = array(
					"status"=>TRUE,
					"message"=>"Successfully to move to FTP Server."
				);
			}
		return $result;
	}
	
	private function _ftp_put($filex, $filename){
		try{
			$ftp_server = FTP_SERVER;
			$file = $filex;
			$remote_file = "/VOLUME1/JLINDO/WELCOME/$filename";
			$conn_id = ftp_connect($ftp_server);
			
			if(!$conn_id){
				throw new Exception('Connection false.');
			}

			// login with username and password
			$xFtpStat = @ftp_login($conn_id, FTP_USER, FTP_PWD);

			//$res = ftp_size($conn_id, $file);
			if($xFtpStat)
			{
					ftp_pasv($conn_id, TRUE);
					if (!ftp_put($conn_id, $remote_file, $file, FTP_BINARY)){
						$msg = $php_errormsg;
						$result = array(
							"status"=>FALSE,
							"message"=>"Failed to move to FTP Server. please reupload."
						);
						
					}
					else{
						$result = array(
							"status"=>TRUE,
							"message"=>"Successfully to move to FTP Server."
						);
						//unlink($filex);
					}
				return $result;
			}
		}catch (Exception $e) {
			$result = array(
				"status"=> false,
				"message"=> "Error! {$e->getMessage()}"
			);
			return $result;
		}
	}

    private function _upload_document_post()
    {
        $this->form_validation->set_rules('noid', 'Item', 'required');

        if ($this->form_validation->run() == FALSE) {
            $response = [
                'status' => false,
                'massage' => validation_errors('<div class="error">', '</div>'),
                'data' => []
            ];
            $this->response($response, self::HTTP_BAD_REQUEST );
        } else {
			
			$response = [
				'status' => true,
				'massage' => 'success',
				'data' => $this->input->post(),
				'files' => $_FILES

			];
			$http = 200;

			$this->response($response, $http );
			
            try {
                $response = [];
                $http = 200;

                // Set the config upload
                
                $config['allowed_types']        = 'pdf|jpeg|jpg|png|mp4|ogg|mp3|m4a|aac|webm';
                $config['overwrite']            = 1;
                $config['remove_spaces']        = TRUE;
                
                $this->load->library('upload',$config);

				//$post = $this->input->post();
                foreach ($this->input->post('item') as $val => $post) {
                    $validFiles = $this->_valid_files($_FILES['item'], $val);

                    $getJenisDokumen = $this->mmaster->get_jenis_document([
                        'ID' => "'{$post['status']}'"
                    ])->row();


                    if (@$post['nosp']) {
                        $getBuildId = $this->mmaster->get_BuildId([
                            'NOSPAJ' => "'{$post['nosp']}'"
                        ]);

                        if ($getBuildId->num_rows() > 0) {
                            $post['buildid'] = $getBuildId->row()->BUILDID;
                        }
                    }

                    if ($post['status'] == 5) {
                        $status = 'Welcoming Call';
                    }else{
                        $status = 'Penawaran';
                    }

                    if(@$_FILES['item']['name'][$val]){

                        if ($validFiles['result'] == TRUE) {

                            $_FILES['upload']['name'] = $_FILES['item']['name'][$val]['upload'];
                            $_FILES['upload']['type'] = $_FILES['item']['type'][$val]['upload'];
                            $_FILES['upload']['tmp_name'] = $_FILES['item']['tmp_name'][$val]['upload'];
                            $_FILES['upload']['error'] = $_FILES['item']['error'][$val]['upload'];
                            $_FILES['upload']['size'] = $_FILES['item']['size'][$val]['upload'];

                            $config['upload_path']          = './assets/web/upload/'.strtolower(str_replace(' ','_', $getJenisDokumen['jenis_dokumen'])).'/';
							
							$keyTab = random_string('numeric', 6);

                            $config['file_name'] = strtolower(str_replace(' ', '_', "{$getJenisDokumen['jenis_dokumen']}/{$post['noagen']} {$post['buildid']} {$keyTab} {$status} ". $_FILES['item']['name'][$val]['upload']));
                            //$config['file_name'] = strtolower(str_replace(' ', '_', "{$getJenisDokumen['jenis_dokumen']}/{$post['noagen']} {$post['buildid']} {$status} ". $_FILES['item']['name'][$val]['upload']));

                            $this->upload->initialize($config);

                            if ($this->upload->do_upload('upload')){
                                $return = array(
                                    'result'    => true, 
                                    'file'      =>  $this->upload->data(),
                                    'error'     =>  ''
                                );
                            }
                            else{
                                $return = array(
                                    'result'    => false, 
                                    'file'      =>'', 
                                    'error'     =>$this->upload->display_errors()
                                );
                            }

                            $arrInsert = [
                                'BUILDID' => "'{$post['buildid']}'",
                                'NOID' => "'{$post['noid']}'",
                                'NOAGEN' => "'{$post['noagen']}'",
                                'JENIS_DOKUMEN_ID' => "'{$post['status']}'",
                                'CREATED_AT' => to_datetime(date('Y-m-d H:i:s')),
                                'META_FILES' => "'{$return['file']['file_name']}'"
                            ];

                            // $insertAbs = $this->mmaster->insertDokumen($arrInsert);

                            // if ($insertAbs) {
                            //     $response[] = [
                            //         'status' => true,
                            //         'massage' => 'Successfully Upload',
                            //         'data' => []
                            //     ];
                            //     $http = 201;
                            // }

                            $response[] = [
                                'status' => true,
                                'massage' => $validFiles['message'],
                                'data' => $arrInsert,

                            ];
                            $http = 200;
                        }else{
                            $response[] = [
                                'status' => false,
                                'massage' => $validFiles['message'],
                                'data' => [],

                            ];
                            $http = 400;
                        }
                    }
                }


                $this->response($response, $http );
            }catch (Exception $e) {
                $response = [
                    'status' => false,
                    'massage' => $e->getMessage(),
                    'data' => []
                ];
                $this->response($response, 400 );
            }
        }
    }
}
