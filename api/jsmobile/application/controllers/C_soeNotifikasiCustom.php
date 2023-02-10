<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class C_soeNotifikasiCustom extends CI_Controller {
		public function __construct()
		{
			parent::__construct();
		}	

		public function index()
		{		
			$data['title'] = "SOE Notifikasi";
			
			$this->load->view('login', $data);
		}

		public function validation()
		{	
			$username = isset($_POST['username']) ? trim($this->input->post('username', true)) : null;
			$password = isset($_POST['password']) ? trim($this->input->post('password', true)) : null; 

			if ( $username == 'admin' AND $password == 'pass' ) {
			    echo 'sukses';
			} else {
			    echo 'gagal';
			}
		}

		public function notifInsert()
		{		
			$arr_role['list_klien'] = isset($_POST['list_klien']) ? trim($this->input->post('list_klien', true)) : null;
			$arr_role['list_type'] = isset($_POST['list_type']) ? trim($this->input->post('list_type', true)) : null; 
			$arr_role['tittleInput'] = isset($_POST['tittleInput']) ? trim($this->input->post('tittleInput', true)) : null;   
	        $arr_role['messageInput'] = isset($_POST['messageInput']) ? trim($this->input->post('messageInput', true)) : null;   
	        $arr_role['contentInput'] = isset($_POST['contentInput']) ? trim($this->input->post('contentInput', true)) : null;

	        $this->load->model('M_soeNotifikasi');
	        header('Content-Type: application/json');
	        $result = $this->M_soeNotifikasi->notifInsert($arr_role['list_klien'], $arr_role['list_type'], $arr_role['tittleInput'], $arr_role['messageInput'], $arr_role['contentInput']);
	        echo json_encode($result);
		}

		public function soenotifDetail($id)
		{	
			$data['title'] = "SOE Detail Notifikasi";

			$this->load->model('M_soeNotifikasi');
			$data['detail_notifSoe'] = $this->M_soeNotifikasi->soenotifDetail($id);
			echo json_encode($data);
		}

		public function pushDetail($id)
		{	
			$data['title'] = "SOE Push Notifikasi";

			$this->load->model('M_soeNotifikasi');
			$data['push_notifSoe'] = $this->M_soeNotifikasi->pushDetail($id);
			echo json_encode($data);
		}

		public function deleteDetail($id)
		{	
			$data['title'] = "SOE delete Notifikasi";

			$this->load->model('M_soeNotifikasi');
			$data['delete_notifSoe'] = $this->M_soeNotifikasi->deleteDetail($id);
			echo json_encode($data);
		}
	}
?>
