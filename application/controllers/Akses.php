<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akses extends CI_Controller {

    /*===== konstruktor =====*/
    function __construct() {
        parent::__construct();

    }


    /*===== halaman hak akses ditolak =====*/
    function ditolak_halaman() {
        $data['h'] = $this->template->title;
        
        $this->template->title = "Akses Ditolak";
        $this->template->content->view('akses/index', $data);
        $this->template->publish();
    }
    
    /*===== halaman hak tambah ditolak =====*/
    function ditolak_tambah() {
        $data['h'] = $this->template->title;
        
        $this->template->title = "Tambah Ditolak";
        $this->template->content->view('akses/index', $data);
        $this->template->publish();
    }
    
    /*===== halaman hak ubah ditolak =====*/
    function ditolak_ubah() {
        $data['h'] = $this->template->title;
        
        $this->template->title = "Ubah Ditolak";
        $this->template->content->view('akses/index', $data);
        $this->template->publish();
    }
    
    /*===== halaman hak hapus ditolak =====*/
    function ditolak_hapus() {
        $data['h'] = $this->template->title;
        
        $this->template->title = "Hapus Ditolak";
        $this->template->content->view('akses/index', $data);
        $this->template->publish();
    }
    
    /*===== halaman hak cetak ditolak =====*/
    function ditolak_cetak() {
        $data['h'] = $this->template->title;
        
        $this->template->title = "Cetak Ditolak";
        $this->template->content->view('akses/index', $data);
        $this->template->publish();
    }
    
    /*===== halaman hak unduh ditolak =====*/
    function ditolak_unduh() {
        $data['h'] = $this->template->title;
        
        $this->template->title = "Unduh Ditolak";
        $this->template->content->view('akses/index', $data);
        $this->template->publish();
    }
    
    /*===== halaman hak unggah ditolak =====*/
    function ditolak_unggah() {
        $data['h'] = $this->template->title;
        
        $this->template->title = "Unggah Ditolak";
        $this->template->content->view('akses/index', $data);
        $this->template->publish();
    }
    
    /*===== arsip =====*/
    function arsip() {
        $data['h'] = $this->template->title;

	$this->load->view('akses/arsip', $data);
    }
}