<?php

/* 
 * Ini adalah halaman untuk daftar spaj.
 * 
 * Create by : Fendy Christianto
 */

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Spaj extends \Restserver\Libraries\REST_Controller {
    function __construct() {
        // Construct the parent class
        parent::__construct();
        $this->load->model('mspaj');
        
        // Data calon pemegang polis (1 dimensi)
        $namaklien = $this->input->post('namaklien');
        $noid = $this->input->post('noid');
        $tempatlahir = $this->input->post('tempatlahir');
        $tgllahir = $this->input->post('tgllahir');
        $jeniskelamin = $this->input->post('jeniskelamin');
        $kdagama = $this->input->post('kdagama');
        $tinggibadan = $this->input->post('tinggibadan');
        $beratbadan = $this->input->post('beratbadan');
        $namaibukand = $this->input->post('namaibukand');
        $kdwarganegara = $this->input->post('kdwarganegara');
        $kdjenispendidikan = $this->input->post('kdjenispendidikan');
        $npwp = $this->input->post('npwp');
        $meritalstatus = $this->input->post('meritalstatus');
        $tglkawin = $this->input->post('tglkawin');
        $statustinggal = $this->input->post('statustinggal');
        $alamat = $this->input->post('alamat');
        $kdkotamadya = $this->input->post('kdkotamadya');
        $kodepos = $this->input->post('kodepos');
        $kdprovinsi = $this->input->post('kdprovinsi');
        $alamattagih = $this->input->post('alamattagih');
        $kdkotamadyatagih = $this->input->post('kdkotamadyatagih');
        $kodepostagih = $this->input->post('kodepostagih');
        $kdprovinsitagih = $this->input->post('kdprovinsitagih');
        $telepon = $this->input->post('telepon');
        $hp = $this->input->post('hp');
        $email = $this->input->post('email');
        $kdpekerjaan = $this->input->post('kdpekerjaan');
        $jabatankerja = $this->input->post('jabatankerja');
        $tempatkerja = $this->input->post('tempatkerja');
        $alamatkerja = $this->input->post('alamatkerja');
        $kdkotamadyakerja = $this->input->post('kdkotamadyakerja');
        $kdprovinsikerja = $this->input->post('kdprovinsikerja');
        $kodeposkerja = $this->input->post('kodeposkerja');
        $teleponkerja = $this->input->post('teleponkerja');
        $hpkerja = $this->input->post('hpkerja');
        $emailkerja = $this->input->post('emailkerja');
        $kdusaha = $this->input->post('kdusaha');
        $bidangusaha = $this->input->post('bidangusaha');
        $namausaha = $this->input->post('namausaha');
        $alamatusaha = $this->input->post('alamatusaha');
        $norekeningbank = $this->input->post('norekeningbank');
        $kdbank = $this->input->post('kdbank');
        $atasnamabank = $this->input->post('atasnamabank');
        $cabangbank = $this->input->post('cabangbank');
        $statuswajibpajak = $this->input->post('statuswajibpajak');
        $kdnegarawajibpajak = $this->input->post('kdnegarawajibpajak');
        $nomorwajibpajak = $this->input->post('nomorwajibpajak');
        $alasanwajibpajak = $this->input->post('alasanwajibpajak');
        
        // Data calon pembayar premi (1 dimensi)
        $kdhubungancpr = $this->input->post('kdhubungancpr');
        $namakliencpr = $this->input->post('namakliencpr');
        $noidcpr = $this->input->post('noidcpr');
        $tempatlahircpr = $this->input->post('tempatlahircpr');
        $tgllahircpr = $this->input->post('tgllahircpr');
        $jeniskelamincpr = $this->input->post('jeniskelamincpr');
        $kdwarganegaracpr = $this->input->post('kdwarganegaracpr');
        $npwpcpr = $this->input->post('npwpcpr');
        $meritalstatuscpr = $this->input->post('meritalstatuscpr');
        $tglkawincpr = $this->input->post('tglkawincpr');
        $statustinggalcpr = $this->input->post('statustinggalcpr');
        $alamatcpr = $this->input->post('alamatcpr');
        $kdkotamadyacpr = $this->input->post('kdkotamadyacpr');
        $kodeposcpr = $this->input->post('kodeposcpr');
        $kdprovinsicpr = $this->input->post('kdprovinsicpr');
        $alamattagihcpr = $this->input->post('alamattagihcpr');
        $kdkotamadyatagihcpr = $this->input->post('kdkotamadyatagihcpr');
        $kodepostagihcpr = $this->input->post('kodepostagihcpr');
        $kdprovinsitagihcpr = $this->input->post('kdprovinsitagihcpr');
        $teleponcpr = $this->input->post('teleponcpr');
        $hpcpr = $this->input->post('hpcpr');
        $emailcpr = $this->input->post('emailcpr');
        $kdpekerjaancpr = $this->input->post('kdpekerjaancpr');
        $jabatankerjacpr = $this->input->post('jabatankerjacpr');
        $tempatkerjacpr = $this->input->post('tempatkerjacpr');
        $alamatkerjacpr = $this->input->post('alamatkerjacpr');
        $kdkotamadyakerjacpr = $this->input->post('kdkotamadyakerjacpr');
        $kdprovinsikerjacpr = $this->input->post('kdprovinsikerjacpr');
        $kodeposkerjacpr = $this->input->post('kodeposkerjacpr');
        $teleponkerjacpr = $this->input->post('teleponkerjacpr');
        $hpkerjacpr = $this->input->post('hpkerjacpr');
        $emailkerjacpr = $this->input->post('emailkerjacpr');
        $kdusahacpr = $this->input->post('kdusahacpr');
        $bidangusahacpr = $this->input->post('bidangusahacpr');
        $namausahacpr = $this->input->post('namausahacpr');
        $alamatusahacpr = $this->input->post('alamatusahacpr');
        $gajicpr = $this->input->post('gajicpr');
        $penghasilancpr = $this->input->post('penghasilancpr');
        $hasilinvestasicpr = $this->input->post('hasilinvestasicpr');
        $bisniscpr = $this->input->post('bisniscpr');
        $bonuscpr = $this->input->post('bonuscpr');
        $pendapatanlainnyacpr = $this->input->post('pendapatanlainnyacpr');
        $sumberpremicpr = $this->input->post('sumberpremicpr');
        $tujuanasuransicpr = $this->input->post('tujuanasuransicpr');
        
        // Data calon tertanggung utama (1 dimensi)
        $namaklienctu = $this->input->post('namaklienctu');
        $noidctu = $this->input->post('noidctu');
        $tempatlahirctu = $this->input->post('tempatlahirctu');
        $tgllahirctu = $this->input->post('tgllahirctu');
        $jeniskelaminctu = $this->input->post('jeniskelaminctu');
        $tinggibadanctu = $this->input->post('tinggibadanctu');
        $beratbadanctu = $this->input->post('beratbadanctu');
        $kdagamactu = $this->input->post('kdagamactu');
        $namaibukandctu = $this->input->post('namaibukandctu');
        $kdjenispendidikanctu = $this->input->post('kdjenispendidikanctu');
        $npwpctu = $this->input->post('npwpctu');
        $meritalstatusctu = $this->input->post('meritalstatusctu');
        $tglkawinctu = $this->input->post('tglkawinctu');
        $kdpekerjaanctu = $this->input->post('kdpekerjaanctu');
        $jabatankerjactu = $this->input->post('jabatankerjactu');
        $tempatkerjactu = $this->input->post('tempatkerjactu');
        $alamatkerjactu = $this->input->post('alamatkerjactu');
        $kdkotamadyakerjactu = $this->input->post('kdkotamadyakerjactu');
        $kdprovinsikerjactu = $this->input->post('kdprovinsikerjactu');
        $kodeposkerjactu = $this->input->post('kodeposkerjactu');
        $teleponkerjactu = $this->input->post('teleponkerjactu');
        $hpkerjactu = $this->input->post('hpkerjactu');
        $kdusahactu = $this->input->post('kdusahactu');
        $bidangusahactu = $this->input->post('bidangusahactu');
        $namausahactu = $this->input->post('namausahactu');
        $alamatusahactu = $this->input->post('alamatusahactu');
        $kdhubunganctu = $this->input->post('kdhubunganctu');
        $usiaproduktifctu = $this->input->post('usiaproduktifctu');
        $gajictu = $this->input->post('gajictu');
        $penghasilanctu = $this->input->post('penghasilanctu');
        $hasilinvestasictu = $this->input->post('hasilinvestasictu');
        $bisnisctu = $this->input->post('bisnisctu');
        $bonusctu = $this->input->post('bonusctu');
        $pendapatanlainnyactu = $this->input->post('pendapatanlainnyactu');
        $namapenerimamanfaat = $this->input->post('namapenerimamanfaat');
        $jeniskelaminpenerimamanfaat = $this->input->post('jeniskelaminpenerimamanfaat');
        $tempatlahir = $this->input->post('tempatlahirpenerimamanfaat');
        $tgllahir = $this->input->post('tgllahirpenerimamanfaat');
        $kdhubunganpenerimamanfaat = $this->input->post('kdhubunganpenerimamanfaat');
        $kdproduk = $this->input->post('kdproduk');
        $jua = $this->input->post('jua');
        
        // Data Rider (n dimensi)
        $kdbenefit = $this->input->post('kdbenefit');
        $biaya = $this->input->post('biaya');
        $manfaat = $this->input->post('manfaat');
        
        // Pembayaran (1 dimensi)
        $kdcarabayar = $this->input->post('kdcarabayar');
        $premi = $this->input->post('premi');
        $premiberkala = $this->input->post('premiberkala');
        $topupsekaligus = $this->input->post('topupsekaligus');
        $topupberkala = $this->input->post('topupberkala');
        
        // Polis Dimiliki (n dimensi)
        $nopolis = $this->input->post('nopolis');
        $uangasuransi = $this->input->post('uangasuransi');
        $premi = $this->input->post('premi');
        $mulas = $this->input->post('mulas');
        $perusahaan = $this->input->post('perusahaan');
        $status = $this->input->post('status');
        
        // SKK Keluarga Tertanggung (n dimensi)
        $kdjeniscalon = $this->input->post('kdjeniscalon');
        $kdhubunganskk = $this->input->post('kdhubunganskk');
        $usiaskk = $this->input->post('usiaskk');
        $hidupmeninggal = $this->input->post('hidupmeninggal');
        $penyakit = $this->input->post('penyakit');
        
        // SKK Jawaban (n dimensi)
        $idpertanyaan = $this->input->post('idpertanyaan');
        $kdjeniscalon = $this->input->post('kdjeniscalon');
        $yatidak = $this->input->post('yatidak');
        $penyakit = $this->input->post('penyakit');
        $tanggal = $this->input->post('tanggal');
        $namaalamatdokter = $this->input->post('namaalamatdokter');
        $lainnya = $this->input->post('lainnya');
        
        
    }
    
}