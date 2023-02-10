<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('menu_model');

        check_session_user();
        check_kuesioner();
        $this->url = base_url('pengaturan');
    }


    //func untuk menampilkan konfigurasi popup, doc, vidio
	function viewPopupImages(){
		
		$data['data'] = $this->menu_model->getDataPopImages();
		//var_dump($data['data']);die;
		
		$this->template->title = "Konfigurasi";
        $this->template->content->view("pengaturan/konfigurasi_popupimage", $data);
        $this->template->publish();
	}
	
	function viewDokumen(){
		
		$data['data'] = $this->menu_model->getDataDokumen();
		
		$this->template->title = "Konfigurasi";
        $this->template->content->view("pengaturan/konfigurasi_dokumen", $data);
        $this->template->publish();
	}
	
	function viewVidio(){
		
		$data['data'] = $this->menu_model->getDataVidio();
		
		$this->template->title = "Konfigurasi";
        $this->template->content->view("pengaturan/konfigurasi_vidio", $data);
        $this->template->publish();
	}
	//sampe disini viewkonfigurasi

	//func post data image, vidio, dokumen untuk jaim
	function postDataPopUpImage(){
		
		$data['judul'] 		= $this->input->post('judul');
		$data['deskripsi'] 	= $this->input->post('deskripsi');
		$data['tglawal'] 	= $this->input->post('tglawal');
		$data['tglakhir'] 	= $this->input->post('tglakhir');

		/** penambahan kategori 16012023 **/
		$data['kategori']	= $this->input->post('kategori');
		

		 // upload image file
        if ($_FILES['gambar']['size'] > 0) {
			
		   $type = explode('/',$_FILES['gambar']['type']);
		   $typefile = $type[1];
			
           $nmgambar = str_replace(' ', '-', strtolower($data['judul'].'_'.date('dmYhis').'.'.$typefile));
			
            $config = array(
                "upload_path"	=> "./asset/popimages/",
                "allowed_types"	=> "gif|jpg|jpeg|png",
                "overwrite"		=> TRUE,
                "max_size"		=> "10000",
                "max_width"		=> "1900",
                "max_height"	=> "1280",
                "file_name"     => $nmgambar
            );
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {
				
                $this->session->set_flashdata('status', 'Gagal Upload');
                $this->session->set_flashdata('pesan', $this->upload->display_errors());
				
                //redirect("pengaturan/viewPopupImages");
				$this->viewPopupImages();
            }
            else {
                $finfo = $this->upload->data();
				$data['gambar'] = $nmgambar;
				
				$insert = $this->menu_model->postDataPopUpImage($data);
				
				redirect('pengaturan/viewPopupImages');
            }
        }	
	}
	
	function postVidio(){
		$data['judul'] 		= $this->input->post('judul');
		$data['deskripsi'] 	= $this->input->post('deskripsi');
		$data['nourut'] 	= $this->input->post('nourut');
		$data['kategori']	= $this->input->post('kategori');
		
			//upload file
		  if ($_FILES['vidio']['size'] > 0) {
			
		   $type = explode('/',$_FILES['vidio']['type']);
		   $typefile = $type[1];
			
           $nmgambar = str_replace(' ', '-', strtolower($data['judul'].'_'.date('dmYhis').'.'.$typefile));
			
            $config = array(
                "upload_path"	=> "./asset/learning/video/",
                "allowed_types"	=> "mp4|mkv|wmv",
                "overwrite"		=> TRUE,
                "max_size"		=> 1024 * 100,
                //"max_width"		=> "1900",
                //"max_height"	=> "1280",
                "file_name"     => $nmgambar
            );
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('vidio')) {
				
                $this->session->set_flashdata('status', 'Gagal Upload');
                $this->session->set_flashdata('pesan', $this->upload->display_errors());
				$this->viewVidio();
                //redirect("pengaturan/viewVidio");
            }
            else {
				
                $finfo = $this->upload->data();
				$data['vidio'] = $nmgambar;
				$insert = $this->menu_model->postVidio($data);
				
				redirect('pengaturan/viewVidio');
            }
        }	
	}
	
	function postDokumen(){
		$data['namabook'] 	= $this->input->post('namabook');
		$data['deskripsi'] 	= $this->input->post('deskripsi');
		$data['nourut'] 	= $this->input->post('nourut');
		$data['kategori']	= $this->input->post('kategori');
			
			//upload file
		  if ($_FILES['doc']['size'] > 0) {
			
		   $type = explode('/',$_FILES['doc']['type']);
		   $typefile = $type[1];
			
           $nmgambar = str_replace(' ', '-', strtolower($data['namabook'].'_'.date('dmYhis').'.'.$typefile));
			
            $config = array(
                "upload_path"	=> "./asset/learning/ebook/",
                "allowed_types"	=> "pdf|doc|docx",
                "overwrite"		=> TRUE,
                "max_size"		=> 10240,
                //"max_width"		=> "1900",
                //"max_height"	=> "1280",
                "file_name"     => $nmgambar
            );
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('doc')) {
				
                $this->session->set_flashdata('status', 'Gagal Upload');
                $this->session->set_flashdata('pesan', $this->upload->display_errors());
				$this->viewDokumen();
                //redirect("pengaturan/viewDokumen");
            }
            else {
                $finfo = $this->upload->data();
				$data['doc'] = $nmgambar;
				
				$insert = $this->menu_model->postDokumen($data);
				
				redirect('pengaturan/viewDokumen');
            }
        }	
	}
	//sampe disini untuk post data image, vidio, dokumen untuk jaim

	//delete vidio dokumen popupimage
	function deletepopUpImage($id){
		$dataimg = $this->menu_model->getImage($id);
		$gambar = $dataimg[0]['GAMBAR'];
		$url = './asset/popimages/'.$gambar;
		unlink($url);
		$data = $this->menu_model->deleteImage($id);
		
		redirect('pengaturan/viewPopupImages');
	}
	
	function deleteDokumen($id){
		$dataimg = $this->menu_model->getDokumen($id);
		$gambar = $dataimg[0]['EBOOK'];
		$url = './asset/popimages/'.$gambar;
		unlink($url);
		$data = $this->menu_model->deleteDokumen($id);
		
		redirect('pengaturan/viewDokumen');
	}
	
	function deleteVidio($id){
		$dataimg = $this->menu_model->getVidio($id);
		$gambar = $dataimg[0]['URL'];
		$url = './asset/popimages/'.$gambar;
		unlink($url);
		$data = $this->menu_model->deleteVidio($id);
		
		redirect('pengaturan/viewVidio');
	}
	
	//sampe disini func delete vidio doc image

	//function edit dokumen, vidio, image
	function getDataImage(){
		
		$id = $this->input->post('id');
		$data = $this->menu_model->getImage($id);
	
		echo json_encode($data);
	}
	
	function saveImage(){
		
		$data['idimage'] 	= $this->input->post('idimage');
		$data['judul'] 		= $this->input->post('judul');
		$data['deskripsi'] 	= $this->input->post('deskripsi');
		$data['tglawal'] 	= $this->input->post('tglawal');
		$data['tglakhir'] 	= $this->input->post('tglakhir');
		$data['gambarold'] 	= $this->input->post('gambarold');

		/** tambahan kategori Agen, Agen LPA, & ALL 16012023**/
		$data['kategori']	= $this->input->post('kategori');
		/** end **/

		 // upload image file & save data jika ada upload file
        if ($_FILES['gambar']['size'] > 0) {
		   $type = explode('/',$_FILES['gambar']['type']);
		   $typefile = $type[1];
			
           $nmgambar = str_replace(' ', '-', strtolower($data['judul'].'_'.date('dmYhis').'.'.$typefile));
			
            $config = array(
                "upload_path"	=> "./asset/popimages/",
                "allowed_types"	=> "gif|jpg|jpeg|png",
                "overwrite"		=> TRUE,
                "max_size"		=> 10240,
                "max_width"		=> 1900,
                "max_height"	=> 1280,
                "file_name"     => $nmgambar
            );
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {
				
                $this->session->set_flashdata('status', 'Gagal Upload');
                $this->session->set_flashdata('pesan', $this->upload->display_errors());
				
				$this->viewPopupImages();
                //redirect("pengaturan/viewPopupImages");
            }
            else {
                $finfo = $this->upload->data();
				$data['gambar'] = $nmgambar;
				$url = './asset/popimages/'.$data['gambarold'];
				unlink($url);
				
				$save = $this->menu_model->saveImage($data);
				
				redirect('pengaturan/viewPopupImages');
            }
        } else {
			//untuk save data tidak ada penguploadan file
			
			$data = $this->menu_model->saveDataImage($data);
			
			redirect('pengaturan/viewPopupImages');
		}
		
	}
	
	function getDataVidio(){
		
		$id = $this->input->post('id');
		$data = $this->menu_model->getVidio($id);
		
		echo json_encode($data);
	}
	
	function saveVidio(){
		
		$data['idvidio'] 	= $this->input->post('idvidio');
		$data['judul'] 		= $this->input->post('judul');
		$data['deskripsi'] 	= $this->input->post('deskripsi');
		$data['nourut'] 	= $this->input->post('nourut');
		$data['vidioold'] 	= $this->input->post('vidioold');
		$data['status'] 	= $this->input->post('status');
		$data['kategori']	= $this->input->post('kategori');
	
		 // upload image file & save data jika ada upload file
        if ($_FILES['vidio']['size'] > 0) {
			
		   $type = explode('/',$_FILES['vidio']['type']);
		   $typefile = $type[1];
			
           $nmgambar = str_replace(' ', '-', strtolower($data['judul'].'_'.date('dmYhis').'.'.$typefile));
			
            $config = array(
                "upload_path"	=> "./asset/learning/video/",
                "allowed_types"	=> "*",
                "overwrite"		=> TRUE,
                "max_size"		=> 1024 * 100,
                //"max_width"		=> "1900",
                //"max_height"	=> "1280",
                "file_name"     => $nmgambar
            );
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('vidio')) {
			
                $this->session->set_flashdata('status', 'Gagal Upload');
                $this->session->set_flashdata('pesan', $this->upload->display_errors());
				$this->viewVidio();
                //redirect("pengaturan/viewVidio");
            }
            else {
                $finfo = $this->upload->data();
				$data['vidio'] = $nmgambar;
				$url = './asset/popimages/'.$data['gambarold'];
				unlink($url);
				
				$save = $this->menu_model->saveVidio($data);
				
				redirect('pengaturan/viewVidio');
            }
        } else {
			//untuk save data tidak ada penguploadan file
			
			$data = $this->menu_model->saveDataVidio($data);
			
			redirect('pengaturan/viewVidio');
		}
	}
		
	function getDataDokumen(){
		
		$id = $this->input->post('id');
		$data = $this->menu_model->getDokumen($id);
		
		echo json_encode($data);
	}
	
	function saveDokumen(){
		
		$data['iddoc'] 		= $this->input->post('iddoc');
		$data['judul'] 		= $this->input->post('namabook');
		$data['deskripsi'] 	= $this->input->post('deskripsi');
		$data['docold'] 	= $this->input->post('docold');
		$data['nourut'] 	= $this->input->post('nourut');
		$data['status'] 	= $this->input->post('status');
		$data['kategori'] 	= $this->input->post('kategori');
		
		 // upload image file & save data jika ada upload file
        if ($_FILES['doc']['size'] > 0) {
			
		   $type = explode('/',$_FILES['doc']['type']);
		   $typefile = $type[1];
			
           $nmgambar = str_replace(' ', '-', strtolower($data['judul'].'_'.date('dmYhis').'.'.$typefile));
			
            $config = array(
                "upload_path"	=> "./asset/learning/ebook/",
                "allowed_types"	=> "pdf|doc|docx",
                "overwrite"		=> TRUE,
                "max_size"		=> "10000",
                //"max_width"		=> "1900",
                //"max_height"	=> "1280",
                "file_name"     => $nmgambar
            );
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('doc')) {
			
                $this->session->set_flashdata('status', 'Gagal Upload');
                $this->session->set_flashdata('pesan', $this->upload->display_errors());
				$this->viewDokumen();
                //redirect("pengaturan/viewDokumen");
            }
            else {
                $finfo = $this->upload->data();
				$data['doc'] = $nmgambar;
				$url = './asset/popimages/'.$data['gambarold'];
				unlink($url);
				
				$save = $this->menu_model->saveDokumen($data);
				
				redirect('pengaturan/viewDokumen');
            }
        } else {
			//untuk save data tidak ada penguploadan file
			$data = $this->menu_model->saveDataDokumen($data);
			
			redirect('pengaturan/viewDokumen');
		}
		
	}
	
	// sampe disini func edit dokumen vidio image

    /*===== daftar menu aplikasi =====*/
    function menu() {
        check_user_role_menu(C_MENU_PENGATURAN_MENU);

        $filter['s'] = strtolower(trim($this->input->get('s')));
        $filter['p'] = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $filter['ip'] = null;
        $filter['kk'] = $this->input->get('f') ? 1 : $this->input->get('f');
        $data['menu'] = $this->menu_model->get_list_parent_menu($filter);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/menu?s=$filter[s]";
        $config['total_rows'] = $this->menu_model->get_total_parent_menu($filter);
        $this->pagination->initialize($config);

        $data['kategori'] = $this->menu_model->get_list_kategori_menu();
        $data['status'] = $this->session->flashdata('status');

        $this->template->title = 'Menu';
        $this->template->content->view("pengaturan/menu", $data);
        $this->template->publish();
    }


    /*===== tambah menu aplikasi =====*/
    function add_menu() {
        check_user_role_menu(C_MENU_PENGATURAN_MENU);

        $data['kategori'] = $this->menu_model->get_list_kategori_menu();

        $this->template->title = 'Tambah';
        $this->template->content->view("pengaturan/add_menu", $data);
        $this->template->publish();
    }


    /*===== edit menu aplikasi =====*/
    function edit_menu($kdmenu) {
        check_user_role_menu(C_MENU_PENGATURAN_MENU);

        $data['menu'] = $this->menu_model->get_menu_by_id($kdmenu);
        $data['parent'] = $this->menu_model->get_list_menu_by_id($data['menu']['KDKATEGORI']);
        $data['kategori'] = $this->menu_model->get_list_kategori_menu();

        $this->template->title = 'Edit';
        $this->template->content->view("pengaturan/edit_menu", $data);
        $this->template->publish();
    }


    /*===== save menu aplikasi =====*/
    function save_menu() {
        check_user_role_menu(C_MENU_PENGATURAN_MENU);

        $kdmenu = $this->input->post('kdmenu');
        $nogenerate = $this->generate->id('MN', true, true, null, 4, null, $this->menu_model->get_last_kd_menu());

        $data['KDMENU'] = empty($kdmenu) ? $nogenerate : $kdmenu;
        $data['IDPARENT'] = $this->input->post('idparent');
        $data['KDKATEGORI'] = $this->input->post('kdkategori');
        $data['KDSTATUS'] = $this->input->post('kdstatus');
        $data['MENU'] = $this->input->post('menu');
        $data['URL'] = $this->input->post('url');
        $data['ICON'] = $this->input->post('icon');
        $data['KETERANGAN'] = $this->input->post('keterangan');

        if (empty($kdmenu)) {
            $status = $this->menu_model->insert($data);
        }
        else {
            $status = $this->menu_model->update($data);
        }

        $this->session->set_flashdata('status', $status);

        redirect("$this->url/menu");
    }


    /*===== delete menu aplikasi =====*/
    function delete_menu($kdmenu) {
        check_user_role_menu(C_MENU_PENGATURAN_MENU);

        $status = $this->menu_model->delete($kdmenu);

        $this->session->set_flashdata('status', $status);

        redirect("$this->url/menu");
    }


    /*===== detail rincian menu =====*/
    function detail_menu() {
        check_user_role_menu(C_MENU_PENGATURAN_MENU);

        $idparent = $this->input->get('id');
        $data['menu'] = $this->menu_model->get_menu_by_id($idparent);

        $filter['s'] = strtolower(trim($this->input->get('s')));
        $filter['p'] = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
        $filter['ip'] = $idparent;
        $filter['kk'] = $data['menu']['KDKATEGORI'];
        $data['child'] = $this->menu_model->get_list_parent_menu($filter);

        $this->load->library('pagination');
        $config['base_url'] = "$this->url/detail-menu?id=$idparent&s=$filter[s]";
        $config['total_rows'] = $this->menu_model->get_total_parent_menu($filter);
        $this->pagination->initialize($config);

        $this->template->title = 'Detail Menu';
        $this->template->content->view("pengaturan/detail_menu", $data);
        $this->template->publish();
    }


    /*===== ajax kategori menu =====*/
    function ajax_kategori_menu() {
        $menu = $this->menu_model->get_list_menu_by_id($this->input->post('id'));

        echo json_encode($menu);
    }


    /*===== daftar urutan menu =====*/
    function urutan_menu() {
        $filter['idparent'] = $this->input->get('f');
        $filter['kdrole'] = $this->input->get('r');

        $data['role'] = $this->menu_model->get_list_role();
        $data['parent'] = $this->menu_model->get_list_all_parent_menu_by_id($filter['kdrole']);
        $data['menu'] = $this->menu_model->get_list_role_menu($filter);

        $this->template->title = 'Urutan Menu';
        $this->template->content->view("pengaturan/urutan_menu", $data);
        $this->template->publish();
    }


    /*===== ajax role menu =====*/
    function ajax_role_menu() {
        $menu = $this->menu_model->get_list_all_parent_menu_by_id($this->input->post('id'));

        echo json_encode($menu);
    }


    /*===== ajax simpan urutan menu =====*/
    function ajax_save_urutan_menu() {
        $sukses = 0;
        $arr_menu = $this->input->post("id");

        foreach ($arr_menu as $i => $v) {
            $data['NOURUT'] = $i + 1;

            $sukses = $this->menu_model->update_urutan($v, $data);
        }

        echo $sukses;
    }
}