<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generate extends CI_Controller {
    
    /*===== konstruktor =====*/
    function __construct() {
        parent::__construct();
        
        $this->url = base_url('generate');
    }
    
    function qrcode($size = null, $kode = null) {
        $this->load->library('ciqrcode');
	$kode = empty($kode) ? $this->input->get('kode') : $kode;
	$size = empty($size) ? $this->input->get('size') : $size;

        header("Content-Type: image/png");
        $params['data'] = $kode;
        $params['level'] = 'H';
        $params['size'] = $size;
        $this->ciqrcode->generate($params);
    }
    
    function mergeimage() {
        $img1 = empty($img1) ? $this->input->get('img1') : $img1;
        $img2 = empty($img2) ? $this->input->get('img2') : $img2;
        $dstx = empty($dstx) ? $this->input->get('dstx') : $dstx;
        $dsty = empty($dsty) ? $this->input->get('dsty') : $dsty;
        $srcx = empty($srcx) ? $this->input->get('srcx') : $srcx;
        $srcy = empty($srcy) ? $this->input->get('srcy') : $srcy;
        $srcw = empty($srcw) ? $this->input->get('srcw') : $srcw;
        $srch = empty($srch) ? $this->input->get('srch') : $srch;
        $pct = empty($pct) ? $this->input->get('pct') : $pct;
        // refrensi
        // https://www.php.net/manual/en/function.imagecopymerge.php
        $src1 = imagecreatefrompng($img1);
        $src2 = imagecreatefrompng($img2);

        imagecopymerge($src1, $src2, $dstx, $dsty, $srcx, $srcy, $srcw, $srch, $pct);

        header('Content-Type: image/png');
        imagepng($src1);

        imagedestroy($src1);
        imagedestroy($src2);
    }
}