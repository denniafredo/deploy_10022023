<?php

class Annuitypremier extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('modsimulasi');
		$this->load->model('modmaster');
    }

    function hasil() {
		$buildid = $this->input->get('buildid');

		$data['pos'] = $this->modsimulasi->get_hitung($buildid);
		
		$this->load->view('hasil/annuitypremier', $data);
	}
	
	function cetak() {
        $buildid = $this->input->get('buildid');
		
		$data['pos'] = $this->modsimulasi->get_hitung($buildid);
		
		$this->load->view('pdf/annuitypremier', $data);
	}

    function save() {
		$kdproduk = $this->input->post('kdproduk');
        $noagen = $this->input->post('noagen');
        $sama = $this->input->post('tertanggungsamadenganpemegangpolis');
        $noidpp = $this->input->post('noktppemegangpolis');
        $manfaattertanggung = $this->input->post('manfaattertanggung');
        $buildid = $this->modmaster->gen_build_id();
        $pempol = $this->modmaster->get_klien(array(array('operator' => 'WHERE', 'text' => 'noid', 'comparison' => '=', 'value' => "'$noidpp'")));
        $produk = api_curl("/master/produk/$kdproduk", 'GET');
        
        // Tertanggung berbeda
        if (!$sama) {
            $noidtt = $this->input->post('noktpcalontertanggung');
            $tertanggung = $this->modmaster->get_klien(array(array('operator' => 'WHERE', 'text' => 'noid', 'comparison' => '=', 'value' => "'$noidtt'")));

            $data['kdpekerjaan'] = $this->input->post('kdpekerjaancalontertanggung');
            $data['kdhobi'] = $this->input->post('kdhobicalontertanggung');
            $data['namaklien'] = $this->input->post('namacalontertanggung');
            $data['kdjeniskelamin'] = $this->input->post('kdjeniskelamincalontertanggung');
            $data['tgllahir'] = "~TO_DATE('".$this->input->post('tanggallahircalontertanggung')."', 'dd-mm-yyyy')";
            $data['noid'] = $noidtt;
            $data['meritalstatus'] = $this->input->post('meritalstatustertanggung');
            
            // Tertanggung baru
            if (!$tertanggung) {
                $noctt = $this->modmaster->gen_no_klien();
                $data['noklien'] = $noctt;
                
                $this->modmaster->insert('jaim_302_klien', $data);
            } else {
                $noctt = $tertanggung['NOKLIEN'];

                $this->modmaster->update('jaim_302_klien', $data, 'noklien', $noctt);
            }

            // Hitung Klien Tertanggung
            $datat['buildid'] = $buildid;
            $datat['noklien'] = $noctt;
            $datat['kdpekerjaan'] = $data['kdpekerjaan'];
            $datat['kdhobi'] = $data['namaklien'];
            $datat['namaklien'] = $data['namaklien'];
            $datat['kdjeniskelamin'] = $data['kdjeniskelamin'];
            $datat['tgllahir'] = $data['tgllahir'];
            $datat['noid'] = $noidtt;
            $datat['meritalstatus'] = $data['meritalstatus'];
            $datat['flag'] = 0;
            $datat['tglrekam'] = "~sysdate";
            $datat['userrekam'] = $noagen;
        }

        // Hitung Klien Pempol
        $datap['buildid'] = $buildid;
        $datap['noklien'] = $pempol['NOKLIEN'];
        $datap['kdpekerjaan'] = $this->input->post('kdpekerjaanpemegangpolis');
        $datap['kdhobi'] = $this->input->post('kdhobipemegangpolis');
        $datap['namaklien'] = $this->input->post('namapemegangpolis');
        $datap['kdjeniskelamin'] = $this->input->post('kdjeniskelaminpemegangpolis');
        $datap['tgllahir'] = "~TO_DATE('".$this->input->post('tanggallahirpemegangpolis')."', 'dd-mm-yyyy')";
        $datap['noid'] = $this->input->post('noktppemegangpolis');
        $datap['meritalstatus'] = $this->input->post('meritalstatuspemegangpolis');
        $datap['kdprovinsi'] = $this->input->post('kdprovinsipemegangpolis');
        $datap['kdkotamadya'] = $this->input->post('kdkotamadyapemegangpolis');
        $datap['kdkelurahan'] = $pempol['KDKELURAHAN'];
        $datap['alamat'] = $this->input->post('alamatpemegangpolis');
        $datap['email'] = $this->input->post('emailpemegangpolis');
        $datap['telepon'] = $this->input->post('phonepemegangpolis');
        $datap['hp'] = $this->input->post('handphonepemegangpolis');
        $datap['flag'] = 0;
        $datap['tglrekam'] = "~sysdate";
        $datap['userrekam'] = $noagen;
        $this->modmaster->insert('jaim_302_hitung_klien', $datap);
        $this->modmaster->insert('jaim_302_hitung_klien', $sama ? $datap : $datat); 
        
        // Hitung
        $datah['buildid'] = $buildid;
        $datah['nocpp'] = $datap['noklien'];
        $datah['noctt'] = $sama ? $datap['noklien'] : $noctt;
        $datah['noagen'] = $noagen;
        $datah['kdproduk'] = $kdproduk;
        $datah['kdcarabayar'] = $this->input->post('kdcarabayar');
        $datah['premi'] = $this->input->post('totalpremi');
        $datah['premiberkala'] = 0;
        $datah['topupsekaligus'] = 0;
        $datah['topupberkala'] = 0;
        $datah['periodetopup'] = 0;
        $datah['jua'] = $this->input->post('manfaatharitua');
        $datah['juamaksimal'] = !$produk['error'] ? $produk['message']['UAMAX'] : 0;
        $datah['penghasilan'] = $this->input->post('penghasilansatutahun');
        $datah['usiaproduktif'] = 0;
        $datah['resikoawal'] = 0;
        $datah['sisaresiko'] = 0;
        $datah['totalresiko'] = 0;
        $datah['jpht'] = $this->input->post('manfaatharitua');
        $datah['jpjdyt'] = $this->input->post('meritalstatuspemegangpolis') == 'K' ? $this->input->post('manfaatjandaduda') : 0;
        $datah['jpjd'] = $this->input->post('manfaatjandaduda');
        $datah['jpyt'] = $this->input->post('manfaatyatim');
        $datah['flag'] = '0';
        $datah['tglrekam'] = '~sysdate';
        $this->modmaster->update('jaim_302_hitung', $datah, 'buildid', $buildid, true);

        // Insurable
        $datai['buildid'] = $buildid;
        $datai['noctt'] = $sama ? $datap['noklien'] : $noctt;
        $datai['noklien'] = $datap['noklien'];
        $datai['kdhubungan'] = $sama ? '04' : $this->input->post('kdhubungan');
        $this->modmaster->update('jaim_302_insurable', $datai, 'buildid', $buildid, true);
        
		redirect(base_url("annuitypremier/hasil?buildid=$buildid"));
	}
}