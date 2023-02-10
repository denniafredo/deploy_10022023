<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class C_soeNotifikasiMenu extends CI_Controller {
		public function __construct()
		{
			parent::__construct();
		}

		function _remap()
		{		
			$segment_1 = $this->uri->segment(1);

			switch ($segment_1) {
				case null:
				case false:
				case '':
					$this->index();
				break;

				case 'dashboard':
					$this->dashboard();
				break;

				case 'entri':
					$this->notifEntry();
				break;

				case 'daftar':
					$this->notifTables();
				break;

				case 'about':
					$this->show_404();
				break;
				
				// case 'blog':
				// 	$this->blog($this->uri->segment(2));
				// break;			
			
			default:
				// //This is just an example to show 
				// //the 404 page if the page doesn't exist
				// $this->db->where('url_title',$segment_1);
				// $db_result = $this->db->get('webpages');
				
				// if($db_result->num_rows() == 1)
				// {
				// 	$this->view($segment_1);
				// }
				// else
				// {
				// 	show_404();
				// }

				if('tidak' != $segment_1)
				{
					$this->show_404();
				}
				else
				{
					$this->show_404();
				}
			break;
			}
		}	

		public function index()
		{		
			$data['title'] = "SOE Notifikasi";
			
			$this->load->view('login', $data);
		}

		public function notifEntry()
		{		
			$data['title'] = "SOE Entri Notifikasi";

			$this->load->model('M_soeNotifikasi');
			$data['list_klien'] = $this->M_soeNotifikasi->list_klien();

			$this->load->view('soenotifEntry', $data);
		}

		public function notifTables()
		{		
			$data['title'] = "SOE Daftar Notifikasi";

			$this->load->model('M_soeNotifikasi');
			$data['list_notifSoe'] = $this->M_soeNotifikasi->soenotifTables();

			$this->load->view('soenotifTables', $data);
		}

		public function dashboard()
		{		
			$data['title'] = "Dashboard";

			$this->load->view('dashboard', $data);
		}

		public function show_404()
		{		
			$data['title'] = "404 Page Not Found";

			$this->load->view('404', $data);
		}
	}
?>
