<?php

/*
 * Ini adalah halaman pertukaran data Power On Sales (POS).
 * 
 * Create by : Fendy Christianto
 */

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Pos extends \Restserver\Libraries\REST_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();
        $this->load->model('mpos');
        $this->load->model('mprospek');
        $this->load->model('mmaster');
    }

    
    /*===== Insert data pos =====*/ 
    function agen_post() {
        // Table Klien (n dimensi)
        $noklien = $this->post('noklien');
        $kdpekerjaan = $this->post('kdpekerjaan');
        $kdhobi = $this->post('kdhobi');
        $namaklien = $this->post('namaklien');
        $kdjeniskelamin = $this->post('kdjeniskelamin'); // L/P
        $tgllahir = $this->post('tgllahir'); // dd-mm-yyyy
        $email = $this->post('email');
        $telepon = $this->post('telepon');
        $hp = $this->post('hp');
        $noid = $this->post('noid');
        $merokok = $this->post('merokok'); // Y/T Opsional
        $meritalstatus = $this->post('meritalstatus'); // Opsional
        $tglrekamklien = $this->post('tglrekamklien'); // Opsional

        // Table Hitung (1 dimensi)
        $buildidmobile = $this->post('buildidmobile');
        $namaproposal = $this->post('namaproposal');
        $nocpp = $this->post('nocpp');
        $noctthitung = $this->post('noctthitung');
        $noagen = $this->post('noagen');
        $kdproduk = $this->post('kdproduk');
        $kdcarabayar = $this->post('kdcarabayar');
        $premi = $this->post('premi');
        $premiberkala = $this->post('premiberkala');
        $topupsekaligus = $this->post('topupsekaligus');
        $topupberkala = $this->post('topupberkala');
        $periodetopup = $this->post('periodetopup');
        $jua = $this->post('jua');
        $juamaksimal = $this->post('juamaksimal');
        $penghasilan = $this->post('penghasilan');
        $usiaproduktif = $this->post('usiaproduktif');
        $resikoawal = $this->post('resikoawal');
        $sisaresiko = $this->post('sisaresiko');
        $totalresiko = $this->post('totalresiko');
        $jpht = $this->post('jpht');
        $jpjdyt = $this->post('jpjdyt');
        $kdstatusmedical = $this->post('kdstatusmedical'); // M/N
        $kdpaketmedical = $this->post('kdpaketmedical');
        $tglrekamhitung = $this->post('tglrekamhitung');

        // Table Insurable (1 dimensi)
        $nocttinsurable = $this->post('nocttinsurable');
        $noklieninsurable = $this->post('noklieninsurable');
        $kdhubungan = $this->post('kdhubungan');
        $kdjenisinsurable = $this->post('kdjenisinsurable');

        // Table Extra Resiko (n dimensi)
        $noklienextraresiko = $this->post('noklienextraresiko');
        $kdpekerjaanextraresiko = $this->post('kdpekerjaanextraresiko');
        $kdhobiextraresiko = $this->post('kdhobiextraresiko');
        $kdjenisresiko = $this->post('kdjenisresiko');
        $resiko = $this->post('resiko');
        $pembagi = $this->post('pembagi');
        $tglrekamextraresiko = $this->post('tglrekamextraresiko');

        // Table Rider (n dimensi)
        $kdbenefit = $this->post('kdbenefit');
        $biaya = $this->post('biaya');
        $manfaat = $this->post('manfaat');

        // Table Opsi Fund (n dimensi)
        $kdfund = $this->post('kdfund');
        $porsi = $this->post('porsi');

        // Table Hasil (1 dimensi)
        $tahun = $this->post('tahun');
        $premihasil = $this->post('premihasil');
        $topupsekaligushasil = $this->post('topupsekaligushasil');
        $topupberkalahasil = $this->post('topupberkalahasil');
        $investasirendah = $this->post('investasirendah');
        $investasisedang = $this->post('investasisedang');
        $investasitinggi = $this->post('investasitinggi');
        $investasiuarendah = $this->post('investasiuarendah');
        $investasiuasedang = $this->post('investasiuasedang');
        $investasiuatinggi = $this->post('investasiuatinggi');
        $usia = $this->post('usia');

        $httpcode = \Restserver\Libraries\REST_Controller::HTTP_OK;
        $flag = 1;
        $tmpnoklien = null;

        // Jika parameter di table KLIEN bukan array
        if (!is_array($noklien)) {
            $message = message(true, $httpcode, 'noklien[]', 'No Klien harus berupa array');
            $flag = 0;
        } else if (!is_array($kdpekerjaan)) {
            $message = message(true, $httpcode, 'kdpekerjaan[]', 'Kode Pekerjaan harus berupa array');
            $flag = 0;
        } else if (!is_array($kdhobi)) {
            $message = message(true, $httpcode, 'kdhobi[]', 'Kode Hobi harus berupa array');
            $flag = 0;
        } else if (!is_array($namaklien)) {
            $message = message(true, $httpcode, 'namaklien[]', 'Nama Klien harus berupa array');
            $flag = 0;
        } else if (!is_array($kdjeniskelamin)) {
            $message = message(true, $httpcode, 'kdjeniskelamin[]', 'Kode Jenis Kelamin harus berupa array');
            $flag = 0;
        } else if (!is_array($tgllahir)) {
            $message = message(true, $httpcode, 'tgllahir[]', 'Tanggal Lahir harus berupa array');
            $flag = 0;
        } /* else if (!is_array($email)) {
          $message = message(true, $httpcode, 'email[]', 'Email harus berupa array');
          $flag = 0;
        } else if (!is_array($telepon)) {
            $message = message(true, $httpcode, 'telepon[]', 'Telepon harus berupa array');
            $flag = 0;
        } else if (!is_array($hp)) {
            $message = message(true, $httpcode, 'hp[]', 'HP harus berupa array');
            $flag = 0;
        }*/  else if (!is_array($noid)) {
            $message = message(true, $httpcode, 'noid[]', 'No ID harus berupa array');
            $flag = 0;
        } /* else if (!is_array($merokok)) {
          $message = message(true, $httpcode, 'merokok[]', 'Merokok harus berupa array');
          $flag = 0;
        } */ else if (!is_array($tglrekamklien)) {
            $message = message(true, $httpcode, 'tglrekamklien[]', 'Tgl Rekam Tabel Klien harus berupa array');
            $flag = 0;
        }

        // Jika parameter di table KLIEN jumlah array tidak sama
        else if (count($noklien) != count($kdpekerjaan)) {
            $message = message(true, $httpcode, 'kdpekerjaan[]', 'Kode Pekerjaan harus berjumlah ' . count($noklien) . ' array');
            $flag = 0;
        } else if (count($noklien) != count($kdhobi)) {
            $message = message(true, $httpcode, 'kdhobi[]', 'Kode Hobi harus berjumlah ' . count($noklien) . ' array');
            $flag = 0;
        } else if (count($noklien) != count($namaklien)) {
            $message = message(true, $httpcode, 'namaklien[]', 'Nama Klien harus berjumlah ' . count($noklien) . ' array');
            $flag = 0;
        } else if (count($noklien) != count($kdjeniskelamin)) {
            $message = message(true, $httpcode, 'kdjeniskelamin[]', 'Kode Jenis Kelamin harus berjumlah ' . count($noklien) . ' array');
            $flag = 0;
        } else if (count($noklien) != count($tgllahir)) {
            $message = message(true, $httpcode, 'tgllahir[]', 'Tanggal Lahir harus berjumlah ' . count($noklien) . ' array');
            $flag = 0;
        } /*else if (count($noklien) != count($email)) {
            $message = message(true, $httpcode, 'email[]', 'Email harus berjumlah ' . count($noklien) . ' array');
            $flag = 0;
        } else if (count($noklien) != count($telepon)) {
            $message = message(true, $httpcode, 'telepon[]', 'Telepon harus berjumlah ' . count($noklien) . ' array');
            $flag = 0;
        } else if (count($noklien) != count($hp)) {
            $message = message(true, $httpcode, 'hp[]', 'HP harus berjumlah ' . count($noklien) . ' array');
            $flag = 0;
        }*/ else if (count($noklien) != count($noid)) {
            $message = message(true, $httpcode, 'noid[]', 'No ID harus berjumlah ' . count($noklien) . ' array');
            $flag = 0;
        } /*else if (count($noklien) != count($merokok)) {
            $message = message(true, $httpcode, 'merokok[]', 'Merokok harus berjumlah ' . count($noklien) . ' array');
            $flag = 0;
        }*/ else if (count($noklien) != count($tglrekamklien)) {
            $message = message(true, $httpcode, 'tglrekamklien[]', 'Tanggal Rekam Tabel Klien harus berjumlah ' . count($noklien) . ' array');
            $flag = 0;
        }

        // Jika parameter di table HITUNG ada yang kosong
        else if (empty($nocpp)) {
            $message = message(true, $httpcode, 'nocpp', 'No CPP belum diisi');
            $flag = 0;
        } else if (empty($noctthitung)) {
            $message = message(true, $httpcode, 'noctthitung', 'No CTT Table Hitung belum diisi');
            $flag = 0;
        } else if (empty($noagen)) {
            $message = message(true, $httpcode, 'noagen', 'No Agen belum diisi');
            $flag = 0;
        } else if (empty($kdproduk)) {
            $message = message(true, $httpcode, 'kdproduk', 'Kode Produk belum diisi');
            $flag = 0;
        } else if (empty($kdcarabayar)) {
            $message = message(true, $httpcode, 'kdcarabayar', 'Kode Cara Bayar belum diisi');
            $flag = 0;
        } else if (empty($premi)) {
            $message = message(true, $httpcode, 'premi', 'Premi belum diisi');
            $flag = 0;
        } else if (!is_numeric($premi)) {
            $message = message(true, $httpcode, 'premi', 'Premi yang valid hanya berformat angka');
            $flag = 0;
        } /*else if ($premiberkala == '') {
            $message = message(true, $httpcode, 'premiberkala', 'Premi Berkala belum diisi');
            $flag = 0;
        } else if (!is_numeric($premiberkala)) {
            $message = message(true, $httpcode, 'premiberkala', 'Premi Berkala yang valid hanya berformat angka');
            $flag = 0;
        }*/ else if (empty($jua)) {
            $message = message(true, $httpcode, 'jua', 'JUA belum diisi');
            $flag = 0;
        } else if (!is_numeric($jua)) {
            $message = message(true, $httpcode, 'jua', 'JUA yang valid hanya berformat angka');
            $flag = 0;
        } else if ($juamaksimal == '') {
            $message = message(true, $httpcode, 'juamaksimal', 'JUA Maksimal belum diisi');
            $flag = 0;
        } else if (!is_numeric($juamaksimal)) {
            $message = message(true, $httpcode, 'juamaksimal', 'JUA Maksimal yang valid hanya berformat angka');
            $flag = 0;
        } /*else if (empty($usiaproduktif)) {
            $message = message(true, $httpcode, 'usiaproduktif', 'Usia Produktif belum diisi');
            $flag = 0;
        } else if (!ctype_digit($usiaproduktif)) {
            $message = message(true, $httpcode, 'usiaproduktif', 'Usia Produktif yang valid hanya berformat angka');
            $flag = 0;
        }*/ else if ($resikoawal == '') {
            $message = message(true, $httpcode, 'resikoawal', 'Resiko Awal belum diisi');
            $flag = 0;
        } /*else if (empty($kdstatusmedical)) {
            $message = message(true, $httpcode, 'kdstatusmedical', 'Kode Status Medical belum diisi');
            $flag = 0;
        } else if ($kdstatusmedical != 'M' && $kdstatusmedical != 'N') {
            $message = message(true, $httpcode, 'kdstatusmedical', 'Kode Status Medical yang valid adalah M/N');
            $flag = 0;
        }*/ else if (empty($tglrekamhitung)) {
            $message = message(true, $httpcode, 'tglrekamhitung', 'Tanggal Rekam Tabel Hitung belum diisi');
            $flag = 0;
        } else if (!preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-([0-9]{4}) (2[0-3]|[01][0-9]):([0-5][0-9]):([0-5][0-9])$/", $tglrekamhitung)) {
            $message = message(true, $httpcode, 'tglrekamhitung', 'Tanggal Rekam Tabel Hitung yang valid adalah format dd-mm-yyyy hh24:mi:ss ' . $tglrekamhitung);
            $flag = 0;
        }

        // Jika parameter di table INSURABLE ada yang kosong
        else if (empty($nocttinsurable)) {
            $message = message(true, $httpcode, 'nocttinsurable', 'No CTT Tabel Insurable belum diisi');
            $flag = 0;
        } else if (empty($noklieninsurable)) {
            $message = message(true, $httpcode, 'noklieninsurable', 'No Klien Tabel Insurable belum diisi');
            $flag = 0;
        } else if (empty($kdhubungan)) {
            $message = message(true, $httpcode, 'kdhubungan', 'Kode Hubungan Tabel Insurable belum diisi');
            $flag = 0;
        }

        // Jika parameter di table EXTRA RESIKO bukan array
        else if (!is_array($noklienextraresiko)) {
            $message = message(true, $httpcode, 'noklienextraresiko[]', 'No Klien Tabel Extra Resiko harus berupa array');
            $flag = 0;
        } else if (!is_array($kdjenisresiko)) {
            $message = message(true, $httpcode, 'kdjenisresiko[]', 'Kode Jenis Resiko harus berupa array');
            $flag = 0;
        } else if (!is_array($resiko)) {
            $message = message(true, $httpcode, 'resiko[]', 'Nilai Resiko harus berupa array');
            $flag = 0;
        } else if (!is_array($pembagi)) {
            $message = message(true, $httpcode, 'pembagi[]', 'Pembagi Nilai Resiko harus berupa array');
            $flag = 0;
        } else if (!is_array($tglrekamextraresiko)) {
            $message = message(true, $httpcode, 'tglrekamextraresiko[]', 'Tanggal Rekam Tabel Extra Resiko harus berupa array');
            $flag = 0;
        }

        // Jika parameter di table KLIEN jumlah array tidak sama
        else if (count($noklienextraresiko) != count($kdjenisresiko)) {
            $message = message(true, $httpcode, 'kdjenisresiko[]', 'Kode Jenis Resiko harus berjumlah ' . count($noklienextraresiko) . ' array');
            $flag = 0;
        } else if (count($noklienextraresiko) != count($resiko)) {
            $message = message(true, $httpcode, 'resiko[]', 'Nilai Resiko harus berjumlah ' . count($noklienextraresiko) . ' array');
            $flag = 0;
        } else if (count($noklienextraresiko) != count($pembagi)) {
            $message = message(true, $httpcode, 'pembagi[]', 'Pembagi Nilai Resiko harus berjumlah ' . count($noklienextraresiko) . ' array');
            $flag = 0;
        } else if (count($noklienextraresiko) != count($tglrekamextraresiko)) {
            $message = message(true, $httpcode, 'tglrekamextraresiko[]', 'Tanggal Rekam Tabel Extra Resiko harus berjumlah ' . count($noklienextraresiko) . ' array');
            $flag = 0;
        }

        if ($flag) {
            // Jika parameter di table KLIEN tidak sesuai kriteria
            foreach ($noklien as $i => $v) {
                if (empty($v)) {
                    $message = message(true, $httpcode, 'noklien[]', "No Klien indeks-$i belum diisi");
                    $flag = 0;
                    break;
                } else if (empty($kdpekerjaan[$i])) {
                    $message = message(true, $httpcode, 'kdpekerjaan[]', "Kode Pekerjaan indeks-$i belum diisi");
                    $flag = 0;
                    break;
                } else if (empty($kdhobi[$i])) {
                    $message = message(true, $httpcode, 'kdhobi[]', "Kode Hobi indeks-$i belum diisi");
                    $flag = 0;
                    break;
                } else if (empty($namaklien[$i])) {
                    $message = message(true, $httpcode, 'namaklien[]', "Nama Klien indeks-$i belum diisi");
                    $flag = 0;
                    break;
                } else if (empty($kdjeniskelamin[$i])) {
                    $message = message(true, $httpcode, 'kdjeniskelamin[]', "Kode Jenis Kelamin indeks-$i belum diisi");
                    $flag = 0;
                    break;
                } else if ($kdjeniskelamin[$i] != 'L' && $kdjeniskelamin[$i] != 'P') {
                    $message = message(true, $httpcode, 'kdjeniskelamin[]', "Kode Jenis Kelamin indeks-$i yang valid adalah L/P");
                    $flag = 0;
                    break;
                } else if (empty($tgllahir[$i])) {
                    $message = message(true, $httpcode, 'tgllahir[]', "Tanggal Lahir indeks-$i belum diisi");
                    $flag = 0;
                    break;
                } else if (!preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-([0-9]{4})$/", $tgllahir[$i])) {
                    $message = message(true, $httpcode, 'tgllahir[]', "Tanggal Lahir indeks-$i yang valid adalah format dd-mm-yyyy");
                    $flag = 0;
                    break;
                } /* else if (empty($email[$i])) {
                  $message = message(true, $httpcode, 'email[]', "Email indeks-$i belum diisi");
                  $flag = 0; break;
                } else if (!filter_var($email[$i], FILTER_VALIDATE_EMAIL)) {
                  $message = message(true, $httpcode, 'email[]', "Email indeks-$i tidak valid");
                  $flag = 0; break;
                } else if (empty($telepon[$i])) {
                    $message = message(true, $httpcode, 'telepon[]', "Telepon indeks-$i belum diisi");
                    $flag = 0;
                    break;
                } else if (!ctype_digit($telepon[$i])) {
                    $message = message(true, $httpcode, 'telepon[]', "Telepon indeks-$i yang valid hanya berformat angka");
                    $flag = 0;
                    break;
                } else if (empty($hp[$i])) {
                    $message = message(true, $httpcode, 'hp[]', "HP indeks-$i belum diisi");
                    $flag = 0;
                    break;
                } else if (!ctype_digit($hp[$i])) {
                    $message = message(true, $httpcode, 'hp[]', "HP indeks-$i yang valid hanya berformat angka");
                    $flag = 0;
                    break;
                } */ else if (!ctype_digit($noid[$i])) {
                    $message = message(true, $httpcode, 'noid[]', "No ID indeks-$i yang valid hanya berformat angka");
                    $flag = 0;
                    break;
                } else if (strlen($noid[$i]) != 16) {
                    $message = message(true, $httpcode, 'noid[]', "No ID indeks-$i tidak valid");
                    $flag = 0;
                    break;
                } /*else if (empty($merokok[$i])) {
                    $message = message(true, $httpcode, 'merokok[]', "Merokok indeks-$i belum diisi");
                    $flag = 0;
                    break;
                } else if ($merokok[$i] != 'Y' && $merokok[$i] != 'T') {
                    $message = message(true, $httpcode, 'merokok[]', "Merokok indeks-$i yang valid adalah Y/T");
                    $flag = 0;
                    break;
                } else if (!empty($meritalstatus[$i]) && $meritalstatus[$i] != 'L' && $meritalstatus[$i] != 'K') {
                    $message = message(true, $httpcode, 'meritalstatus[]', "Merital Status indeks-$i yang valid adalah L/K");
                    $flag = 0;
                    break;
                }*/ else if (empty($tglrekamklien[$i])) {
                    $message = message(true, $httpcode, 'tglrekamklien[]', "Tanggal Rekam Tabel Klien indeks-$i belum diisi");
                    $flag = 0;
                    break;
                } else if (!preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-([0-9]{4}) (?:2[0-3]|[01][1-9]|10):([0-5][0-9]):([0-5][0-9])$/", $tglrekamklien[$i])) {
                    $message = message(true, $httpcode, 'tglrekamklien[]', "Tanggal Rekam Tabel Klien indeks-$i yang valid adalah format dd-mm-yyyy hh24:mi:ss");
                    $flag = 0;
                    break;
                }
            }

            // Jika parameter di table EXTRA RESIKO tidak sesuai kriteria
            foreach ($noklienextraresiko as $i => $v) {
                if (empty($v)) {
                    $message = message(true, $httpcode, 'noklienextraresiko[]', "No Klien Table Extra Resiko indeks-$i belum diisi");
                    $flag = 0;
                    break;
                } else if (empty($kdjenisresiko[$i])) {
                    $message = message(true, $httpcode, 'kdjenisresiko[]', "Kode Jenis Resiko indeks-$i belum diisi");
                    $flag = 0;
                    break;
                } /*else if (empty($resiko[$i])) {
                    $message = message(true, $httpcode, 'resiko[]', "Resiko indeks-$i belum diisi");
                    $flag = 0;
                    break;
                }*/ else if (!is_numeric($resiko[$i])) {
                    $message = message(true, $httpcode, 'resiko[]', "Resiko indeks-$i yang valid hanya berformat numerik");
                    $flag = 0;
                    break;
                } else if ($pembagi[$i] == "") {
                    $message = message(true, $httpcode, 'pembagi[]', "Pembagi Nilai Resiko indeks-$i belum diisi");
                    $flag = 0;
                    break;
                } else if (!is_numeric($pembagi[$i])) {
                    $message = message(true, $httpcode, 'pembagi[]', "Pembagi Nilai Resiko indeks-$i yang valid hanya berformat numerik");
                    $flag = 0;
                    break;
                } else if (empty($tglrekamextraresiko[$i])) {
                    $message = message(true, $httpcode, 'tglrekamextraresiko[]', "Tanggal Rekam Tabel Extra Resiko indeks-$i belum diisi");
                    $flag = 0;
                    break;
                } else if (!preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-([0-9]{4}) (?:2[0-3]|[01][1-9]|10):([0-5][0-9]):([0-5][0-9])$/", $tglrekamextraresiko[$i])) {
                    $message = message(true, $httpcode, 'tglrekamextraresiko[]', "Tanggal Rekam Tabel Extra Resiko indeks-$i yang valid adalah format dd-mm-yyyy hh24:mi:ss");
                    $flag = 0;
                    break;
                }
            }

            // Jika parameter di table OPSI FUND tidak sesuai kriteria
            if ($kdfund) {
                foreach ($kdfund as $i => $v) {
                    if (!ctype_digit($porsi[$i])) {
                        $message = message(true, $httpcode, 'porsi[]', "Porsi indeks-$i yang valid hanya berformat angka");
                        $flag = 0;
                        break;
                    }
                }
            }

            // Jika parameter di table HASIL tidak sesuai kriteria
            if ($tahun) {
                foreach ($tahun as $i => $v) {
                    if (!ctype_digit($premihasil[$i])) {
                        $message = message(true, $httpcode, 'premihasil[]', "Premi Tabel Hasil indeks-$i yang valid hanya berformat angka");
                        $flag = 0;
                    } else if (!ctype_digit($topupsekaligushasil[$i])) {
                        $message = message(true, $httpcode, 'topupsekaligushasil[]', "Top Up Sekaligus Tabel Hasil indeks-$i yang valid hanya berformat angka");
                        $flag = 0;
                    } else if (!ctype_digit($topupberkalahasil[$i])) {
                        $message = message(true, $httpcode, 'topupberkalahasil[]', "Top Up Berkala Tabel Hasil indeks-$i yang valid hanya berformat angka");
                        $flag = 0;
                    } else if (!is_numeric($investasirendah[$i])) {
                        $message = message(true, $httpcode, 'investasirendah[]', "Investasi Rendah Tabel Hasil indeks-$i yang valid hanya berformat numerik");
                        $flag = 0;
                        break;
                    } else if (!is_numeric($investasisedang[$i])) {
                        $message = message(true, $httpcode, 'investasisedang[]', "Investasi Sedang Tabel Hasil indeks-$i yang valid hanya berformat numerik");
                        $flag = 0;
                        break;
                    } else if (!is_numeric($investasitinggi[$i])) {
                        $message = message(true, $httpcode, 'investasitinggi[]', "Investasi Tinggi Tabel Hasil indeks-$i yang valid hanya berformat numerik");
                        $flag = 0;
                        break;
                    } else if (!is_numeric($investasiuarendah[$i])) {
                        $message = message(true, $httpcode, 'investasiuarendah[]', "Investasi UA Rendah Tabel Hasil indeks-$i yang valid hanya berformat numerik");
                        $flag = 0;
                        break;
                    } else if (!is_numeric($investasiuasedang[$i])) {
                        $message = message(true, $httpcode, 'investasiuasedang[]', "Investasi UA Sedang Tabel Hasil indeks-$i yang valid hanya berformat numerik");
                        $flag = 0;
                        break;
                    } else if (!is_numeric($investasiuatinggi[$i])) {
                        $message = message(true, $httpcode, 'investasiuatinggi[]', "Investasis UA Tinggi Tabel Hasil indeks-$i yang valid hanya berformat numerik");
                        $flag = 0;
                        break;
                    } else if (!ctype_digit($usia[$i])) {
                        $message = message(true, $httpcode, 'usia[]', 'Usia Tabel Hasil indeks-$i yang valid hanya berformat angka');
                        $flag = 0;
                    }
                }
            }
        }

        if ($flag) {
            $data2['nocpp'] = null;
            $data2['noctt'] = null;
            $existbuildid = $this->mpos->get_hitung($buildidmobile, $noagen);
            $genbuildid = $existbuildid ? $existbuildid['BUILDID'] : $this->mpos->gen_build_id();

            $this->mpos->start();
            $this->mpos->strict();

            foreach ($noklien as $i => $v) {
                // cari klien berdasarkan ktp
                $klien = $this->mprospek->get_klien($noid[$i]);

                $data[$i]['kdpekerjaan'] = $kdpekerjaan[$i];
                $data[$i]['kdhobi'] = $kdhobi[$i];
                $data[$i]['namaklien'] = replace_to_insert($namaklien[$i]);
                $data[$i]['kdjeniskelamin'] = $kdjeniskelamin[$i];
                $data[$i]['tgllahir'] = to_date($tgllahir[$i]);
                if (@$email[$i]) $data[$i]['email'] = $email[$i];
                if (@$telepon[$i]) $data[$i]['telepon'] = $telepon[$i];
                if (@$hp[$i]) $data[$i]['hp'] = $hp[$i];
                $data[$i]['noid'] = $noid[$i];
                if (@$merokok[$i]) $data[$i]['merokok'] = $merokok[$i];
                if (@$meritalstatus[$i]) $data[$i]['meritalstatus'] = $meritalstatus[$i];
                //$data[$i]['noklienmobile'] = $v;

                if ($klien) {
                    // set no klien lama
                    $tmpnoklien[$i] = $klien['NOKLIEN'];
                    $data[$i]['flag'] = '0';

                    // update klien
                    $this->mpos->myupdate('jaim_302_klien', $data[$i], 'noklien', $klien['NOKLIEN']);
                    
                    $log = null;
                    if ($klien['KDPEKERJAAN'] != $kdpekerjaan[$i]) $log .= "\nkdpekerjaan : $klien[KDPEKERJAAN] => $kdpekerjaan[$i]";
                    if ($klien['KDHOBI'] != $kdhobi[$i]) $log .= "\nkdhobi : $klien[KDHOBI] => $kdhobi[$i]";
                    if ($klien['NAMAKLIEN'] != $namaklien[$i]) $log .= "\nnamaklien : $klien[NAMAKLIEN] => $namaklien[$i]";
                    if ($klien['KDJENISKELAMIN'] != $kdjeniskelamin[$i]) $log .= "\nkdjeniskelamin : $klien[KDJENISKELAMIN] => $kdjeniskelamin[$i]";
                    if ($klien['TGLLAHIR'] != $tgllahir[$i]) $log .= "\ntgllahir : $klien[TGLLAHIR] => $tgllahir[$i]";
                    if ($klien['EMAIL'] != @$email[$i] && @$email[$i]) $log .= "\nemail : $klien[EMAIL] => $email[$i]";
                    if ($klien['TELEPON'] != @$telepon[$i] && @$telepon[$i]) $log .= "\ntelepon : $klien[TELEPON] => $telepon[$i]";
                    if ($klien['HP'] != @$hp[$i] && @$hp[$i]) $log .= "\nhp : $klien[HP] => $hp[$i]";
                    if ($klien['NOID'] != @$noid[$i] && @$noid[$i]) $log .= "\nnoid : $klien[NOID] => $noid[$i]";
                    if ($klien['MEROKOK'] != @$merokok[$i] && @$merokok[$i]) $log .= "\nmerokok : $klien[MEROKOK] => $merokok[$i]";
                    if ($klien['MERITALSTATUS'] != @$meritalstatus[$i] && @$meritalstatus[$i]) $log .= "\nmeritalstatus : $klien[MERITALSTATUS] => $meritalstatus[$i]";

                    if ($log) {
                        $datalog['kdlog'] = C_IDENTIFIER_WITHOUT_QUOTES . "F_GEN_KDLOG";
                        $datalog['log'] = C_IDENTIFIER_LOG_UBAH_PROSPEK."\nnoklien : $klien[NOKLIEN]\nnoktp : $klien[NOID] $log";
                        $datalog['tglrekam'] = C_IDENTIFIER_WITHOUT_QUOTES . "sysdate";
                        $datalog['userrekam'] = $this->input->ip_address();
                        $this->mpos->myinsert('jaim_999_log', $datalog);
                    }
                    
                    // data untuk hitung klien
                    $data[$i] = array_merge($klien, array_change_key_case($data[$i], CASE_UPPER));
                } else {
                    // set no klien baru
                    $tmpnoklien[$i] = $this->mpos->gen_no_klien();
                    $data[$i]['noklien'] = $tmpnoklien[$i];
                    $data[$i]['userrekam'] = $noagen;
                    if (@$tglrekamklien[$i]) $data[$i]['tglrekam'] = to_datetime($tglrekamklien[$i]);

                    // insert klien
                    $this->mpos->myinsert('jaim_302_klien', $data[$i]);
                }
                
                // tambahkan data hitung klien
                $data[$i]['buildid'] = $genbuildid;
                $this->mpos->myinsert('jaim_302_hitung_klien', $data[$i]);
                
                $data2['nocpp'] = $noklien[$i] == $nocpp ? $tmpnoklien[$i] : $data2['nocpp'];
                $data2['noctt'] = $noklien[$i] == $noctthitung ? $tmpnoklien[$i] : $data2['noctt'];
            }

            $data2['buildid'] = $genbuildid;
            $data2['namaproposal'] = $namaproposal;
            $data2['buildidmobile'] = $buildidmobile;
            $data2['noagen'] = $noagen;
            $data2['kdproduk'] = $kdproduk;
            $data2['kdcarabayar'] = $kdcarabayar;
            $data2['premi'] = to_number($premi);
            $data2['premiberkala'] = to_number($premiberkala);
            $data2['topupsekaligus'] = to_number($topupsekaligus);
            $data2['topupberkala'] = to_number($topupberkala);
            $data2['periodetopup'] = $periodetopup;
            $data2['jua'] = to_number($jua);
            $data2['juamaksimal'] = to_number($juamaksimal);
            $data2['penghasilan'] = to_number($penghasilan);
            $data2['usiaproduktif'] = $usiaproduktif;
            $data2['resikoawal'] = to_number($resikoawal);
            $data2['sisaresiko'] = to_number($sisaresiko);
            $data2['totalresiko'] = to_number($totalresiko);
            $data2['jpht'] = to_number($jpht);
            $data2['jpjdyt'] = to_number($jpjdyt);
            $data2['kdstatusmedical'] = $kdstatusmedical;
            $data2['kdpaketmedical'] = $kdpaketmedical;
            //$data2['kdstatusproses'] = C_STATUS_PROSES_POS;
            $data2['flag'] = '0';
            $data2['tglrekam'] = to_datetime($tglrekamhitung);

            // update data hitung jika ada, jika tidak insert
            $this->mpos->myupdate('jaim_302_hitung', $data2, 'buildid', $genbuildid, true);

            $data3['buildid'] = $genbuildid;
            $data3['noctt'] = $data2['noctt'];
            $data3['noklien'] = $data2['nocpp'];
            $data3['kdhubungan'] = $kdhubungan;
            $data3['kdjenisinsurable'] = $kdjenisinsurable;

            // update data insurable jika ada, jika tidak insert
            $this->mpos->myupdate('jaim_302_insurable', $data3, 'buildid', $genbuildid, true);

            foreach ($noklienextraresiko as $i => $v) {
                foreach ($noklien as $j => $w) {
                    if ($w == $v) {
                        $data4[$i]['noklien'] = $tmpnoklien[$j];
                    }
                }
                
                $data4[$i]['buildid'] = $genbuildid;
                $data4[$i]['kdpekerjaan'] = $kdpekerjaanextraresiko[$i];
                $data4[$i]['kdhobi'] = $kdhobiextraresiko[$i];
                $data4[$i]['kdjenisresiko'] = $kdjenisresiko[$i];
                $data4[$i]['resiko'] = to_number($resiko[$i]);
                $data4[$i]['pembagi'] = to_number($pembagi[$i]);
                $data4[$i]['tglrekam'] = to_datetime($tglrekamextraresiko[$i]);

                // update data extra resiko jika ada, jika tidak insert
                $this->mpos->myupdate('jaim_302_extra_resiko', $data4[$i], array('buildid' => $genbuildid, 'noklien' => $v, 'kdjenisresiko' => $kdjenisresiko[$i]), null, true);
            }

            if (is_array($kdbenefit)) {
                foreach ($kdbenefit as $i => $v) {
                    $data5[$i]['buildid'] = $genbuildid;
                    $data5[$i]['kdbenefit'] = $v;
                    $data5[$i]['biaya'] = to_number($biaya[$i]);
                    $data5[$i]['manfaat'] = to_number($manfaat[$i]);

                    // update data rider jika ada, jika tidak insert
                    $this->mpos->myupdate('jaim_302_rider', $data5[$i], array('buildid' => $genbuildid, 'kdbenefit' => $v), null, true);
                }
            }

            if (is_array($kdfund)) {
                foreach ($kdfund as $i => $v) {
                    $data6[$i]['buildid'] = $genbuildid;
                    $data6[$i]['kdfund'] = $v;
                    $data6[$i]['porsi'] = $porsi[$i];

                    // update data fund jika ada, jika tidak insert
                    $this->mpos->myupdate('jaim_302_opsi_fund', $data6[$i], array('buildid' => $genbuildid, 'kdfund' => $v), null, true);
                }
            }

            if (is_array($tahun)) {
                foreach ($tahun as $i => $v) {
                    $data7[$i]['buildid'] = $genbuildid;
                    $data7[$i]['tahun'] = $tahun[$i];
                    $data7[$i]['premi'] = to_number($premihasil[$i]);
                    $data7[$i]['topupsekaligus'] = to_number($topupsekaligushasil[$i]);
                    $data7[$i]['topupberkala'] = to_number($topupberkalahasil[$i]);
                    $data7[$i]['investasirendah'] = to_number($investasirendah[$i]);
                    $data7[$i]['investasisedang'] = to_number($investasisedang[$i]);
                    $data7[$i]['investasitinggi'] = to_number($investasitinggi[$i]);
                    $data7[$i]['investasiuarendah'] = to_number($investasiuarendah[$i]);
                    $data7[$i]['investasiuasedang'] = to_number($investasiuasedang[$i]);
                    $data7[$i]['investasiuatinggi'] = to_number($investasiuatinggi[$i]);
                    $data7[$i]['usia'] = $usia[$i];

                    // update data hasil jika ada, jika tidak insert
                    $this->mpos->myupdate('jaim_302_hasil', $data7[$i], array('buildid' => $genbuildid, 'tahun' => $tahun[$i]), null, true);
                }
            }

            if ($this->mpos->status() === FALSE) {
                $this->mpos->rollback();

                $httpcode = \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST;
                $message = message(true, $httpcode, '', 'Gagal');
            } else {
                $this->mpos->commit();

                $httpcode = \Restserver\Libraries\REST_Controller::HTTP_CREATED;
                $message = message(false, $httpcode, '', array('buildidmobile' => $buildidmobile, 'buildidserver' => $genbuildid, 'cetak' => C_URL_AIMS."/simulasi/cetak?bid=$genbuildid"));
            }
        }
        
        // Logging parameter
        $this->mpos->log2("Request : Insert Pos", "Response : ".json_encode($message));

        // Response
        $this->response($message, $httpcode);
    }

    /*===== Insert data pos =====*/ 
    function ultimate_post() {
        // Table Klien (n dimensi)
        $noklien = $this->post('noklien');
        $kdpekerjaan = $this->post('kdpekerjaan');
        $kdhobi = $this->post('kdhobi');
        $namaklien = $this->post('namaklien');
        $kdjeniskelamin = $this->post('kdjeniskelamin'); // L/P
        $tgllahir = $this->post('tgllahir'); // dd-mm-yyyy
        $email = $this->post('email');
        $telepon = $this->post('telepon');
        $hp = $this->post('hp');
        $noid = $this->post('noid');
        $merokok = $this->post('merokok'); // Y/T Opsional
        $meritalstatus = $this->post('meritalstatus'); // Opsional
        $tglrekamklien = $this->post('tglrekamklien'); // Opsional

        // Table Hitung (1 dimensi)
        $buildidmobile = $this->post('buildidmobile');
        $namaproposal = $this->post('namaproposal');
        $nocpp = $this->post('nocpp');
        $noctthitung = $this->post('noctthitung');
        $noagen = $this->post('noagen');
        $kdproduk = $this->post('kdproduk');
        $kdcarabayar = $this->post('kdcarabayar');
        $premi = $this->post('premi');
        $premiberkala = $this->post('premiberkala');
        $topupsekaligus = $this->post('topupsekaligus');
        $topupberkala = 0;
        $periodetopup = $this->post('periodetopup');
        $jua = $this->post('jua');
        $juamaksimal = $this->post('juamaksimal');
        $penghasilan = $this->post('penghasilan');
        $usiaproduktif = $this->post('usiaproduktif');
        $resikoawal = $this->post('resikoawal');
        $sisaresiko = $this->post('sisaresiko');
        $totalresiko = $this->post('totalresiko');
        $jpht = $this->post('jpht');
        $jpjdyt = $this->post('jpjdyt');
        $kdstatusmedical = $this->post('kdstatusmedical'); // M/N
        $kdpaketmedical = $this->post('kdpaketmedical');
        $tglrekamhitung = $this->post('tglrekamhitung');

        // Table Insurable (1 dimensi)
        $nocttinsurable = $this->post('nocttinsurable');
        $noklieninsurable = $this->post('noklieninsurable');
        $kdhubungan = $this->post('kdhubungan');
        $kdjenisinsurable = $this->post('kdjenisinsurable');

        // Table Extra Resiko (n dimensi)
        $noklienextraresiko = $this->post('noklienextraresiko');
        $kdpekerjaanextraresiko = $this->post('kdpekerjaanextraresiko');
        $kdhobiextraresiko = $this->post('kdhobiextraresiko');
        $kdjenisresiko = $this->post('kdjenisresiko');
        $resiko = $this->post('resiko');
        $pembagi = $this->post('pembagi');
        //$tglrekamextraresiko = $this->post('tglrekamextraresiko');

        // Table Rider (n dimensi)
        $kdbenefit = $this->post('kdbenefit');
        $biaya = $this->post('biaya');
        $manfaat = $this->post('manfaat');

        // Table Opsi Fund (n dimensi)
        $kdfund = $this->post('kdfund');
        $porsi = $this->post('porsi');

        // Table Hasil (1 dimensi)
		$tahun = 1;
		$biayacoa = 27500;
		$persenalokasi = 95/100;
		$usiactt = $this->post('usiactt');
		$kdtarif = $this->post('kdtarif');
		$uadasar = $this->post('uadasar');
		$resikopekerjaan = $this->post('resikopekerjaan');
		$resikopembagipekerjaan = $this->post('resikopembagipekerjaan');
		$resikohobi = $this->post('resikohobi');
		$resikopembagihobi = $this->post('resikopembagihobi');
		$investasirendah1 = $this->post('investasirendah1');
		$investasirendah2 = $this->post('investasirendah2');
		$investasisedang1 = $this->post('investasisedang1');
		$investasisedang2 = $this->post('investasisedang2');
		$investasitinggi1 = $this->post('investasitinggi1');
		$investasitinggi2 = $this->post('investasitinggi2');
		
        $httpcode = \Restserver\Libraries\REST_Controller::HTTP_OK;
        $flag = 1;
        $tmpnoklien = null;

        // Jika parameter di table KLIEN bukan array
        if (!is_array($noklien)) {
            $message = message(true, $httpcode, 'noklien[]', 'No Klien harus berupa array');
            $flag = 0;
        } else if (!is_array($kdpekerjaan)) {
            $message = message(true, $httpcode, 'kdpekerjaan[]', 'Kode Pekerjaan harus berupa array');
            $flag = 0;
        } else if (!is_array($kdhobi)) {
            $message = message(true, $httpcode, 'kdhobi[]', 'Kode Hobi harus berupa array');
            $flag = 0;
        } else if (!is_array($namaklien)) {
            $message = message(true, $httpcode, 'namaklien[]', 'Nama Klien harus berupa array');
            $flag = 0;
        } else if (!is_array($kdjeniskelamin)) {
            $message = message(true, $httpcode, 'kdjeniskelamin[]', 'Kode Jenis Kelamin harus berupa array');
            $flag = 0;
        } else if (!is_array($tgllahir)) {
            $message = message(true, $httpcode, 'tgllahir[]', 'Tanggal Lahir harus berupa array');
            $flag = 0;
        } else if (!is_array($noid)) {
            $message = message(true, $httpcode, 'noid[]', 'No ID harus berupa array');
            $flag = 0;
        } else if (!is_array($tglrekamklien)) {
            $message = message(true, $httpcode, 'tglrekamklien[]', 'Tgl Rekam Tabel Klien harus berupa array');
            $flag = 0;
        }

        // Jika parameter di table KLIEN jumlah array tidak sama
        else if (count($noklien) != count($kdpekerjaan)) {
            $message = message(true, $httpcode, 'kdpekerjaan[]', 'Kode Pekerjaan harus berjumlah ' . count($noklien) . ' array');
            $flag = 0;
        } else if (count($noklien) != count($kdhobi)) {
            $message = message(true, $httpcode, 'kdhobi[]', 'Kode Hobi harus berjumlah ' . count($noklien) . ' array');
            $flag = 0;
        } else if (count($noklien) != count($namaklien)) {
            $message = message(true, $httpcode, 'namaklien[]', 'Nama Klien harus berjumlah ' . count($noklien) . ' array');
            $flag = 0;
        } else if (count($noklien) != count($kdjeniskelamin)) {
            $message = message(true, $httpcode, 'kdjeniskelamin[]', 'Kode Jenis Kelamin harus berjumlah ' . count($noklien) . ' array');
            $flag = 0;
        } else if (count($noklien) != count($tgllahir)) {
            $message = message(true, $httpcode, 'tgllahir[]', 'Tanggal Lahir harus berjumlah ' . count($noklien) . ' array');
            $flag = 0;
        } else if (count($noklien) != count($noid)) {
            $message = message(true, $httpcode, 'noid[]', 'No ID harus berjumlah ' . count($noklien) . ' array');
            $flag = 0;
        } else if (count($noklien) != count($tglrekamklien)) {
            $message = message(true, $httpcode, 'tglrekamklien[]', 'Tanggal Rekam Tabel Klien harus berjumlah ' . count($noklien) . ' array');
            $flag = 0;
        }

        // Jika parameter di table HITUNG ada yang kosong
        else if (empty($nocpp)) {
            $message = message(true, $httpcode, 'nocpp', 'No CPP belum diisi');
            $flag = 0;
        } else if (empty($noctthitung)) {
            $message = message(true, $httpcode, 'noctthitung', 'No CTT Table Hitung belum diisi');
            $flag = 0;
        } else if (empty($noagen)) {
            $message = message(true, $httpcode, 'noagen', 'No Agen belum diisi');
            $flag = 0;
        } else if (empty($kdproduk)) {
            $message = message(true, $httpcode, 'kdproduk', 'Kode Produk belum diisi');
            $flag = 0;
        } else if (empty($kdcarabayar)) {
            $message = message(true, $httpcode, 'kdcarabayar', 'Kode Cara Bayar belum diisi');
            $flag = 0;
        } else if (empty($premi)) {
            $message = message(true, $httpcode, 'premi', 'Premi belum diisi');
            $flag = 0;
        } else if (!is_numeric($premi)) {
            $message = message(true, $httpcode, 'premi', 'Premi yang valid hanya berformat angka');
            $flag = 0;
        } else if (empty($jua)) {
            $message = message(true, $httpcode, 'jua', 'JUA belum diisi');
            $flag = 0;
        } else if (!is_numeric($jua)) {
            $message = message(true, $httpcode, 'jua', 'JUA yang valid hanya berformat angka');
            $flag = 0;
        } else if ($juamaksimal == '') {
            $message = message(true, $httpcode, 'juamaksimal', 'JUA Maksimal belum diisi');
            $flag = 0;
        } else if (!is_numeric($juamaksimal)) {
            $message = message(true, $httpcode, 'juamaksimal', 'JUA Maksimal yang valid hanya berformat angka');
            $flag = 0;
        } else if ($resikoawal == '') {
            $message = message(true, $httpcode, 'resikoawal', 'Resiko Awal belum diisi');
            $flag = 0;
        } else if (empty($tglrekamhitung)) {
            $message = message(true, $httpcode, 'tglrekamhitung', 'Tanggal Rekam Tabel Hitung belum diisi');
            $flag = 0;
        } else if (!preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-([0-9]{4}) (2[0-3]|[01][0-9]):([0-5][0-9]):([0-5][0-9])$/", $tglrekamhitung)) {
            $message = message(true, $httpcode, 'tglrekamhitung', 'Tanggal Rekam Tabel Hitung yang valid adalah format dd-mm-yyyy hh24:mi:ss ' . $tglrekamhitung);
            $flag = 0;
        }

        // Jika parameter di table INSURABLE ada yang kosong
        else if (empty($nocttinsurable)) {
            $message = message(true, $httpcode, 'nocttinsurable', 'No CTT Tabel Insurable belum diisi');
            $flag = 0;
        } else if (empty($noklieninsurable)) {
            $message = message(true, $httpcode, 'noklieninsurable', 'No Klien Tabel Insurable belum diisi');
            $flag = 0;
        } else if (empty($kdhubungan)) {
            $message = message(true, $httpcode, 'kdhubungan', 'Kode Hubungan Tabel Insurable belum diisi');
            $flag = 0;
        }

        // Jika parameter di table EXTRA RESIKO bukan array
        else if (!is_array($noklienextraresiko)) {
            $message = message(true, $httpcode, 'noklienextraresiko[]', 'No Klien Tabel Extra Resiko harus berupa array');
            $flag = 0;
        } else if (!is_array($kdjenisresiko)) {
            $message = message(true, $httpcode, 'kdjenisresiko[]', 'Kode Jenis Resiko harus berupa array');
            $flag = 0;
        } else if (!is_array($resiko)) {
            $message = message(true, $httpcode, 'resiko[]', 'Nilai Resiko harus berupa array');
            $flag = 0;
        } else if (!is_array($pembagi)) {
            $message = message(true, $httpcode, 'pembagi[]', 'Pembagi Nilai Resiko harus berupa array');
            $flag = 0;
        } /*else if (!is_array($tglrekamextraresiko)) {
            $message = message(true, $httpcode, 'tglrekamextraresiko[]', 'Tanggal Rekam Tabel Extra Resiko harus berupa array');
            $flag = 0;
        }*/

        // Jika parameter di table EXTRA RESIKO jumlah array tidak sama
        else if (count($noklienextraresiko) != count($kdjenisresiko)) {
            $message = message(true, $httpcode, 'kdjenisresiko[]', 'Kode Jenis Resiko harus berjumlah ' . count($noklienextraresiko) . ' array');
            $flag = 0;
        } else if (count($noklienextraresiko) != count($resiko)) {
            $message = message(true, $httpcode, 'resiko[]', 'Nilai Resiko harus berjumlah ' . count($noklienextraresiko) . ' array');
            $flag = 0;
        } else if (count($noklienextraresiko) != count($pembagi)) {
            $message = message(true, $httpcode, 'pembagi[]', 'Pembagi Nilai Resiko harus berjumlah ' . count($noklienextraresiko) . ' array');
            $flag = 0;
        } /*else if (count($noklienextraresiko) != count($tglrekamextraresiko)) {
            $message = message(true, $httpcode, 'tglrekamextraresiko[]', 'Tanggal Rekam Tabel Extra Resiko harus berjumlah ' . count($noklienextraresiko) . ' array');
            $flag = 0;
        }*/
		
		// Jika parameter di table HASIL ada yang kosong
        else if (!is_numeric($usiactt)) {
            $message = message(true, $httpcode, 'usiactt', 'Usia CTT Tabel Hasil yang valid hanya berformat numerik');
            $flag = 0;
        } else if (empty($kdtarif)) {
            $message = message(true, $httpcode, 'kdtarif', 'Kode Tarif Tabel Hasil belum diisi');
            $flag = 0;
        } else if (!is_numeric($uadasar)) {
            $message = message(true, $httpcode, 'uadasar', 'UA Dasar Tabel Hasil yang valid hanya berformat numerik');
            $flag = 0;
        } else if (!is_numeric($resikopekerjaan)) {
            $message = message(true, $httpcode, 'resikopekerjaan', 'Resiko Pekerjaan Tabel Hasil yang valid hanya berformat numerik');
            $flag = 0;
        } else if (!is_numeric($resikopembagipekerjaan)) {
            $message = message(true, $httpcode, 'resikopembagipekerjaan', 'Resiko Pembagi Pekerjaan Tabel Hasil yang valid hanya berformat numerik');
            $flag = 0;
        } else if (!is_numeric($resikohobi)) {
            $message = message(true, $httpcode, 'resikohobi', 'Resiko Hobi Tabel Hasil yang valid hanya berformat numerik');
            $flag = 0;
        } else if (!is_numeric($resikopembagihobi)) {
            $message = message(true, $httpcode, 'resikopembagihobi', 'Resiko Pembagi Hobi Tabel Hasil yang valid hanya berformat numerik');
            $flag = 0;
        } else if (!is_numeric($investasirendah1)) {
            $message = message(true, $httpcode, 'investasirendah1', 'Investasi Rendah 1 Tabel Hasil yang valid hanya berformat numerik');
            $flag = 0;
        } else if (!is_numeric($investasirendah2)) {
            $message = message(true, $httpcode, 'investasirendah2', 'Investasi Rendah 2 Tabel Hasil yang valid hanya berformat numerik');
            $flag = 0;
        } else if (!is_numeric($investasisedang1)) {
            $message = message(true, $httpcode, 'investasisedang1', 'Investasi Sedang 1 Tabel Hasil yang valid hanya berformat numerik');
            $flag = 0;
        } else if (!is_numeric($investasisedang2)) {
            $message = message(true, $httpcode, 'investasisedang2', 'Investasi Sedang 2 Tabel Hasil yang valid hanya berformat numerik');
            $flag = 0;
        } else if (!is_numeric($investasitinggi1)) {
            $message = message(true, $httpcode, 'investasitinggi1', 'Investasi Tinggi 1 Tabel Hasil yang valid hanya berformat numerik');
            $flag = 0;
        } else if (!is_numeric($investasitinggi2)) {
            $message = message(true, $httpcode, 'investasitinggi2', 'Investasi Tinggi 2 Tabel Hasil yang valid hanya berformat numerik');
            $flag = 0;
        }

        if ($flag) {
            // Jika parameter di table KLIEN tidak sesuai kriteria
            foreach ($noklien as $i => $v) {
                if (empty($v)) {
                    $message = message(true, $httpcode, 'noklien[]', "No Klien indeks-$i belum diisi");
                    $flag = 0;
                    break;
                } else if (empty($kdpekerjaan[$i])) {
                    $message = message(true, $httpcode, 'kdpekerjaan[]', "Kode Pekerjaan indeks-$i belum diisi");
                    $flag = 0;
                    break;
                } else if (empty($kdhobi[$i])) {
                    $message = message(true, $httpcode, 'kdhobi[]', "Kode Hobi indeks-$i belum diisi");
                    $flag = 0;
                    break;
                } else if (empty($namaklien[$i])) {
                    $message = message(true, $httpcode, 'namaklien[]', "Nama Klien indeks-$i belum diisi");
                    $flag = 0;
                    break;
                } else if (empty($kdjeniskelamin[$i])) {
                    $message = message(true, $httpcode, 'kdjeniskelamin[]', "Kode Jenis Kelamin indeks-$i belum diisi");
                    $flag = 0;
                    break;
                } else if ($kdjeniskelamin[$i] != 'L' && $kdjeniskelamin[$i] != 'P') {
                    $message = message(true, $httpcode, 'kdjeniskelamin[]', "Kode Jenis Kelamin indeks-$i yang valid adalah L/P");
                    $flag = 0;
                    break;
                } else if (empty($tgllahir[$i])) {
                    $message = message(true, $httpcode, 'tgllahir[]', "Tanggal Lahir indeks-$i belum diisi");
                    $flag = 0;
                    break;
                } else if (!preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-([0-9]{4})$/", $tgllahir[$i])) {
                    $message = message(true, $httpcode, 'tgllahir[]', "Tanggal Lahir indeks-$i yang valid adalah format dd-mm-yyyy");
                    $flag = 0;
                    break;
                } else if (!ctype_digit($noid[$i])) {
                    $message = message(true, $httpcode, 'noid[]', "No ID indeks-$i yang valid hanya berformat angka");
                    $flag = 0;
                    break;
                } else if (strlen($noid[$i]) != 16) {
                    $message = message(true, $httpcode, 'noid[]', "No ID indeks-$i tidak valid");
                    $flag = 0;
                    break;
                } else if (empty($tglrekamklien[$i])) {
                    $message = message(true, $httpcode, 'tglrekamklien[]', "Tanggal Rekam Tabel Klien indeks-$i belum diisi");
                    $flag = 0;
                    break;
                } else if (!preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-([0-9]{4}) (?:2[0-3]|[01][1-9]|10):([0-5][0-9]):([0-5][0-9])$/", $tglrekamklien[$i])) {
                    $message = message(true, $httpcode, 'tglrekamklien[]', "Tanggal Rekam Tabel Klien indeks-$i yang valid adalah format dd-mm-yyyy hh24:mi:ss");
                    $flag = 0;
                    break;
                }
            }

            // Jika parameter di table EXTRA RESIKO tidak sesuai kriteria
            foreach ($noklienextraresiko as $i => $v) {
                if (empty($v)) {
                    $message = message(true, $httpcode, 'noklienextraresiko[]', "No Klien Table Extra Resiko indeks-$i belum diisi");
                    $flag = 0;
                    break;
                } else if (empty($kdjenisresiko[$i])) {
                    $message = message(true, $httpcode, 'kdjenisresiko[]', "Kode Jenis Resiko indeks-$i belum diisi");
                    $flag = 0;
                    break;
                } else if (!is_numeric($resiko[$i])) {
                    $message = message(true, $httpcode, 'resiko[]', "Resiko indeks-$i yang valid hanya berformat numerik");
                    $flag = 0;
                    break;
                } else if ($pembagi[$i] == "") {
                    $message = message(true, $httpcode, 'pembagi[]', "Pembagi Nilai Resiko indeks-$i belum diisi");
                    $flag = 0;
                    break;
                } else if (!is_numeric($pembagi[$i])) {
                    $message = message(true, $httpcode, 'pembagi[]', "Pembagi Nilai Resiko indeks-$i yang valid hanya berformat numerik");
                    $flag = 0;
                    break;
                } /*else if (empty($tglrekamextraresiko[$i])) {
                    $message = message(true, $httpcode, 'tglrekamextraresiko[]', "Tanggal Rekam Tabel Extra Resiko indeks-$i belum diisi");
                    $flag = 0;
                    break;
                } else if (!preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-([0-9]{4}) (?:2[0-3]|[01][1-9]|10):([0-5][0-9]):([0-5][0-9])$/", $tglrekamextraresiko[$i])) {
                    $message = message(true, $httpcode, 'tglrekamextraresiko[]', "Tanggal Rekam Tabel Extra Resiko indeks-$i yang valid adalah format dd-mm-yyyy hh24:mi:ss");
                    $flag = 0;
                    break;
                }*/
            }

            // Jika parameter di table OPSI FUND tidak sesuai kriteria
            if ($kdfund) {
                foreach ($kdfund as $i => $v) {
                    if (!ctype_digit($porsi[$i])) {
                        $message = message(true, $httpcode, 'porsi[]', "Porsi indeks-$i yang valid hanya berformat angka");
                        $flag = 0;
                        break;
                    }
                }
            }
        }

        if ($flag) {
            $data2['nocpp'] = null;
            $data2['noctt'] = null;
            $existbuildid = $this->mpos->get_hitung($buildidmobile, $noagen);
            $genbuildid = $existbuildid ? $existbuildid['BUILDID'] : $this->mpos->gen_build_id();

            $this->mpos->start();
            $this->mpos->strict();

            foreach ($noklien as $i => $v) {
                // cari klien berdasarkan ktp
                $klien = $this->mprospek->get_klien($noid[$i]);

                $data[$i]['kdpekerjaan'] = $kdpekerjaan[$i];
                $data[$i]['kdhobi'] = $kdhobi[$i];
                $data[$i]['namaklien'] = replace_to_insert($namaklien[$i]);
                $data[$i]['kdjeniskelamin'] = $kdjeniskelamin[$i];
                $data[$i]['tgllahir'] = to_date($tgllahir[$i]);
                if (@$email[$i]) $data[$i]['email'] = $email[$i];
                if (@$telepon[$i]) $data[$i]['telepon'] = $telepon[$i];
                if (@$hp[$i]) $data[$i]['hp'] = $hp[$i];
                $data[$i]['noid'] = $noid[$i];
                if (@$merokok[$i]) $data[$i]['merokok'] = $merokok[$i];
                if (@$meritalstatus[$i]) $data[$i]['meritalstatus'] = $meritalstatus[$i];

                if ($klien) {
                    // set no klien lama
                    $tmpnoklien[$i] = $klien['NOKLIEN'];
                    $data[$i]['flag'] = '0';

                    // update klien
                    $this->mpos->myupdate('jaim_302_klien', $data[$i], 'noklien', $klien['NOKLIEN']);
                    
                    $log = null;
                    if ($klien['KDPEKERJAAN'] != $kdpekerjaan[$i]) $log .= "\nkdpekerjaan : $klien[KDPEKERJAAN] => $kdpekerjaan[$i]";
                    if ($klien['KDHOBI'] != $kdhobi[$i]) $log .= "\nkdhobi : $klien[KDHOBI] => $kdhobi[$i]";
                    if ($klien['NAMAKLIEN'] != $namaklien[$i]) $log .= "\nnamaklien : $klien[NAMAKLIEN] => $namaklien[$i]";
                    if ($klien['KDJENISKELAMIN'] != $kdjeniskelamin[$i]) $log .= "\nkdjeniskelamin : $klien[KDJENISKELAMIN] => $kdjeniskelamin[$i]";
                    if ($klien['TGLLAHIR'] != $tgllahir[$i]) $log .= "\ntgllahir : $klien[TGLLAHIR] => $tgllahir[$i]";
                    if ($klien['EMAIL'] != @$email[$i] && @$email[$i]) $log .= "\nemail : $klien[EMAIL] => $email[$i]";
                    if ($klien['TELEPON'] != @$telepon[$i] && @$telepon[$i]) $log .= "\ntelepon : $klien[TELEPON] => $telepon[$i]";
                    if ($klien['HP'] != @$hp[$i] && @$hp[$i]) $log .= "\nhp : $klien[HP] => $hp[$i]";
                    if ($klien['NOID'] != @$noid[$i] && @$noid[$i]) $log .= "\nnoid : $klien[NOID] => $noid[$i]";
                    if ($klien['MEROKOK'] != @$merokok[$i] && @$merokok[$i]) $log .= "\nmerokok : $klien[MEROKOK] => $merokok[$i]";
                    if ($klien['MERITALSTATUS'] != @$meritalstatus[$i] && @$meritalstatus[$i]) $log .= "\nmeritalstatus : $klien[MERITALSTATUS] => $meritalstatus[$i]";

                    if ($log) {
                        $datalog['kdlog'] = C_IDENTIFIER_WITHOUT_QUOTES . "F_GEN_KDLOG";
                        $datalog['log'] = C_IDENTIFIER_LOG_UBAH_PROSPEK."\nnoklien : $klien[NOKLIEN]\nnoktp : $klien[NOID] $log";
                        $datalog['tglrekam'] = C_IDENTIFIER_WITHOUT_QUOTES . "sysdate";
                        $datalog['userrekam'] = $this->input->ip_address();
                        $this->mpos->myinsert('jaim_999_log', $datalog);
                    }
                    
                    // data untuk hitung klien
                    $data[$i] = array_merge($klien, array_change_key_case($data[$i], CASE_UPPER));
                } else {
                    // set no klien baru
                    $tmpnoklien[$i] = $this->mpos->gen_no_klien();
                    $data[$i]['noklien'] = $tmpnoklien[$i];
                    $data[$i]['userrekam'] = $noagen;
                    if (@$tglrekamklien[$i]) $data[$i]['tglrekam'] = to_datetime($tglrekamklien[$i]);

                    // insert klien
                    $this->mpos->myinsert('jaim_302_klien', $data[$i]);
                }
                
                // tambahkan data hitung klien
                $data[$i]['buildid'] = $genbuildid;
                $this->mpos->myinsert('jaim_302_hitung_klien', $data[$i]);
                
                $data2['nocpp'] = $noklien[$i] == $nocpp ? $tmpnoklien[$i] : $data2['nocpp'];
                $data2['noctt'] = $noklien[$i] == $noctthitung ? $tmpnoklien[$i] : $data2['noctt'];
            }

            $data2['buildid'] = $genbuildid;
            $data2['namaproposal'] = $namaproposal;
            $data2['buildidmobile'] = $buildidmobile;
            $data2['noagen'] = $noagen;
            $data2['kdproduk'] = $kdproduk;
            $data2['kdcarabayar'] = $kdcarabayar;
            $data2['premi'] = to_number($premi);
            $data2['premiberkala'] = to_number($premiberkala);
            $data2['topupsekaligus'] = to_number($topupsekaligus);
            $data2['topupberkala'] = to_number($topupberkala);
            $data2['periodetopup'] = $periodetopup;
            $data2['jua'] = to_number($jua);
            $data2['juamaksimal'] = to_number($juamaksimal);
            $data2['penghasilan'] = to_number($penghasilan);
            $data2['usiaproduktif'] = $usiaproduktif;
            $data2['resikoawal'] = to_number($resikoawal);
            $data2['sisaresiko'] = to_number($sisaresiko);
            $data2['totalresiko'] = to_number($totalresiko);
            $data2['jpht'] = to_number($jpht);
            $data2['jpjdyt'] = to_number($jpjdyt);
            $data2['kdstatusmedical'] = $kdstatusmedical;
            $data2['kdpaketmedical'] = $kdpaketmedical;
            $data2['flag'] = '0';
            $data2['tglrekam'] = to_datetime($tglrekamhitung);

            // update data hitung jika ada, jika tidak insert
            $this->mpos->myupdate('jaim_302_hitung', $data2, 'buildid', $genbuildid, true);

            $data3['buildid'] = $genbuildid;
            $data3['noctt'] = $data2['noctt'];
            $data3['noklien'] = $data2['nocpp'];
            $data3['kdhubungan'] = $kdhubungan;
            $data3['kdjenisinsurable'] = $kdjenisinsurable;

            // update data insurable jika ada, jika tidak insert
            $this->mpos->myupdate('jaim_302_insurable', $data3, 'buildid', $genbuildid, true);

            foreach ($noklienextraresiko as $i => $v) {
                foreach ($noklien as $j => $w) {
                    if ($w == $v) {
                        $data4[$i]['noklien'] = $tmpnoklien[$j];
                    }
                }
                
                $data4[$i]['buildid'] = $genbuildid;
                $data4[$i]['kdpekerjaan'] = $kdpekerjaanextraresiko[$i];
                $data4[$i]['kdhobi'] = $kdhobiextraresiko[$i];
                $data4[$i]['kdjenisresiko'] = $kdjenisresiko[$i];
                $data4[$i]['resiko'] = to_number($resiko[$i]);
                $data4[$i]['pembagi'] = to_number($pembagi[$i]);
                $data4[$i]['tglrekam'] = C_IDENTIFIER_WITHOUT_QUOTES.'sysdate'; //to_datetime($tglrekamextraresiko[$i]);

                // update data extra resiko jika ada, jika tidak insert
                $this->mpos->myupdate('jaim_302_extra_resiko', $data4[$i], array('buildid' => $genbuildid, 'noklien' => $v, 'kdjenisresiko' => $kdjenisresiko[$i]), null, true);
            }

            if (is_array($kdbenefit)) {
                foreach ($kdbenefit as $i => $v) {
                    $data5[$i]['buildid'] = $genbuildid;
                    $data5[$i]['kdbenefit'] = $v;
                    $data5[$i]['biaya'] = to_number($biaya[$i]);
                    $data5[$i]['manfaat'] = to_number($manfaat[$i]);

                    // update data rider jika ada, jika tidak insert
                    $this->mpos->myupdate('jaim_302_rider', $data5[$i], array('buildid' => $genbuildid, 'kdbenefit' => $v), null, true);
                }
            }

            if (is_array($kdfund)) {
                foreach ($kdfund as $i => $v) {
                    $data6[$i]['buildid'] = $genbuildid;
                    $data6[$i]['kdfund'] = $v;
                    $data6[$i]['porsi'] = $porsi[$i];

                    // update data fund jika ada, jika tidak insert
                    $this->mpos->myupdate('jaim_302_opsi_fund', $data6[$i], array('buildid' => $genbuildid, 'kdfund' => $v), null, true);
                }
            }

			for ($i=$usiactt;$i<100;$i++) {
				$tarif = $this->mmaster->get_tarif($kdtarif, $kdproduk, '', '', $i, '', '');
				$biaya = $biayacoa + ($uadasar * replace_to_number($tarif['TARIF'])/12/1000 * (1 + ($resikopekerjaan/$resikopembagipekerjaan) + ($resikohobi/$resikopembagihobi)));
				
				for ($bln=1;$bln<=12;$bln++) {
					// Ambil premi ditahun dan bulan pertama
					$premihasil = $i == $usiactt && $bln == 1 ? $premi : 0;
					// Ambil topup ditahun < periode topup dan bulan pertama
					$topuphasil = $i < ($usiactt+$periodetopup) && $bln == 1 ? $topupsekaligus : 0;
					$alokasi = ($persenalokasi * $premihasil) + ($persenalokasi * $topuphasil);
				
					$ir1 = $tahun == 1 && $bln == 1 ? (($alokasi-$biaya) * (pow((1+$investasirendah1),(1/12))) * (@$porsi[0]/100)) : ($tmpir1 + ($alokasi-$biaya) * (@$porsi[0]/100)) * (pow((1+$investasirendah1),(1/12)));
					$ir2 = $tahun == 1 && $bln == 1 ? (($alokasi-$biaya) * (pow((1+$investasirendah2),(1/12))) * (@$porsi[1]/100)) : ($tmpir2 + ($alokasi-$biaya) * (@$porsi[1]/100)) * (pow((1+$investasirendah2),(1/12)));
					$is1 = $tahun == 1 && $bln == 1 ? (($alokasi-$biaya) * (pow((1+$investasisedang1),(1/12))) * (@$porsi[0]/100)) : ($tmpis1 + ($alokasi-$biaya) * (@$porsi[0]/100)) * (pow((1+$investasisedang1),(1/12)));
					$is2 = $tahun == 1 && $bln == 1 ? (($alokasi-$biaya) * (pow((1+$investasisedang2),(1/12))) * (@$porsi[1]/100)) : ($tmpis2 + ($alokasi-$biaya) * (@$porsi[1]/100)) * (pow((1+$investasisedang2),(1/12)));
					$it1 = $tahun == 1 && $bln == 1 ? (($alokasi-$biaya) * (pow((1+$investasitinggi1),(1/12))) * (@$porsi[0]/100)) : ($tmpit1 + ($alokasi-$biaya) * (@$porsi[0]/100)) * (pow((1+$investasitinggi1),(1/12)));
					$it2 = $tahun == 1 && $bln == 1 ? (($alokasi-$biaya) * (pow((1+$investasitinggi2),(1/12))) * (@$porsi[1]/100)) : ($tmpit2 + ($alokasi-$biaya) * (@$porsi[1]/100)) * (pow((1+$investasitinggi2),(1/12)));
					
					$tmpir1 = $ir1;
					$tmpir2 = $ir2;
					$tmpis1 = $is1;
					$tmpis2 = $is2;
					$tmpit1 = $it1;
					$tmpit2 = $it2;
				}
				
				$data7['buildid'] = $genbuildid;
				$data7['tahun'] = $tahun;
				$data7['premi'] = to_number($i == $usiactt ? $premi : 0);
				$data7['topupsekaligus'] = to_number($i < ($usiactt+$periodetopup) ? $topupsekaligus : 0);
				$data7['topupberkala'] = $topupberkala;
				$data7['investasirendah'] = to_number(($ir1+$ir2)/1000);
				$data7['investasisedang'] = to_number(($is1+$is2)/1000);
				$data7['investasitinggi'] = to_number(($it1+$it2)/1000);
				$data7['investasiuarendah'] = to_number(($ir1+$ir2) < 0 ? 0 : ($uadasar + $ir1 + $ir2)/1000);
				$data7['investasiuasedang'] = to_number(($is1+$is2) < 0 ? 0 : ($uadasar + $is1 + $is2)/1000);
				$data7['investasiuatinggi'] = to_number(($it1+$it2) < 0 ? 0 : ($uadasar + $it1 + $it2)/1000);
				$data7['usia'] = $i;
				$this->mpos->myupdate('jaim_302_hasil', $data7, array('buildid' => $genbuildid, 'tahun' => $tahun), null, true);
				
				$tahun++;
			}

            if ($this->mpos->status() === FALSE) {
                $this->mpos->rollback();

                $httpcode = \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST;
                $message = message(true, $httpcode, '', 'Gagal');
            } else {
                $this->mpos->commit();

                $httpcode = \Restserver\Libraries\REST_Controller::HTTP_CREATED;
                $message = message(false, $httpcode, '', array('buildidmobile' => $buildidmobile, 'buildidserver' => $genbuildid, 'cetak' => C_URL_AIMS."/simulasi/cetak?bid=$genbuildid"));
            }
        }
        
        // Logging parameter
        $this->mpos->log2("Request : Insert Pos", "Response : ".json_encode($message));

        // Response
        $this->response($message, $httpcode);
    }

    /*===== Hapus data pos =====*/
    function agen_delete($username = null, $buildid = null) {
        $httpcode = \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST;
        
        if (empty($username)) {
            $message = message(true, $httpcode, '', 'Nomor agen wajib diisi');
        } else if (empty($buildid)) {
            $message = message(true, $httpcode, '', 'Build ID wajib diisi');
        } else {
            $httpcode = \Restserver\Libraries\REST_Controller::HTTP_OK;
            
            $this->mpos->start();
            $this->mpos->strict();
            
            // update data hasil jika ada, jika tidak insert
            $this->mpos->myupdate('jaim_302_hitung', array('flag' => 'X'), 'buildid', $buildid);
            // Sementara sebelum life prime dipindah ke 302_hitung, setelah itu mohon dihapus
            $this->mpos->myupdate('jaim_300_hitung', array('dihapus' => '1'), 'build_id', $buildid);
            $this->mpos->myupdate('tabel_spaj_online@jlindo', array('status' => '1', 'tanggalupdate' => C_IDENTIFIER_WITHOUT_QUOTES.'sysdate', 'userupdate' => $username), 'buildid', $buildid);
            //$this->mpos->myupdate('tabel_200_pertanggungan@jlindo', array('kdstatusfile' => '7'), "nosp IN (SELECT nospaj FROM tabel_spaj_online@jlindo WHERE buildid = '$buildid')");
                  
            if ($this->mpos->status() === FALSE) {
                $this->mpos->rollback();

                $httpcode = \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST;
                $message = message(true, $httpcode, '', 'Gagal');
            } else {
                $this->mpos->commit();

                $httpcode = \Restserver\Libraries\REST_Controller::HTTP_CREATED;
                $message = message(false, $httpcode, '', 'Sukses');
            }
        }
            
        // Response
        $this->response($message, $httpcode);
    }
    
    
    /*===== Ambil data pos =====*/
    function agen_get($username = null, $noid = null, $buildid = null) {
        if (!empty($username)) {
            $httpcode = \Restserver\Libraries\REST_Controller::HTTP_OK;
            
            if (empty($buildid)) {
                $data = $this->mpos->get_list_pos($username, $noid);
                
                $message = message(false, $httpcode, '', $data);
            } else {
                $data = $this->mpos->get_pos($buildid);
                
                if ($data) {
                    $agen = @$this->mmaster->get_agenjlindo($data['NOAGEN']);
                    $carabayar = @$this->mmaster->get_cara_bayar($data['KDCARABAYAR']);
                    $data['NAMACARABAYAR'] = @$carabayar['NAMACARABAYAR'];
                    $data['NAMAAGEN'] = $agen['NAMAKLIEN1'];
                    $data['KDKANTOR'] = $agen['KDKANTOR'];
                    $data['NAMAKANTOR'] = $agen['NAMAKANTOR'];
                    $data[$data['NOCPP']] = $this->mpos->get_klien($buildid, $data['NOCPP']);
                    $data[$data['NOCTT']] = $this->mpos->get_klien($buildid, $data['NOCTT']);
                    $data['STATUS'] = $this->mpos->get_list_status($buildid);
                    foreach ($this->mpos->get_list_fund($data['BUILDID']) as $i => $v) {
                        $v['RENDAH'] = replace_to_number($v['RENDAH']);
                        $v['SEDANG'] = replace_to_number($v['SEDANG']);
                        $v['TINGGI'] = replace_to_number($v['TINGGI']);
                        $data['OPSIFUND'][$i] = $v;
                    }
                    foreach ($this->mpos->get_list_rider($data['BUILDID']) as $i => $v) {
                        $v['BIAYA'] = replace_to_number($v['BIAYA']);
                        $v['MANFAAT'] = replace_to_number($v['MANFAAT']);
                        $data['RIDER'][$i] = $v;
                    }
                    foreach ($this->mpos->get_list_hasil($data['BUILDID']) as $i => $v) {
                        $v['INVESTASIRENDAH'] = replace_to_number($v['INVESTASIRENDAH']);
                        $v['INVESTASISEDANG'] = replace_to_number($v['INVESTASISEDANG']);
                        $v['INVESTASITINGGI'] = replace_to_number($v['INVESTASITINGGI']);
                        $v['INVESTASIUARENDAH'] = replace_to_number($v['INVESTASIUARENDAH']);
                        $v['INVESTASIUASEDANG'] = replace_to_number($v['INVESTASIUASEDANG']);
                        $v['INVESTASIUATINGGI'] = replace_to_number($v['INVESTASIUATINGGI']);
                        $data['HASIL'][$i] = $v;
                    }
                    
                    $message = message(false, $httpcode, '', $data);
                } else {
                    $httpcode = \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST;
            
                    $message = message(true, $httpcode, '', 'Build ID tidak ditemukan');
                }
            }
        } else {
            $httpcode = \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST;
            
            $message = message(true, $httpcode, '', 'Nomor agen wajib diisi');
        }
            
        // Response
        $this->response($message, $httpcode);
    }
    
    
    /*===== Ambil status follow up pos simulasi =====*/
    function status_get($buildid) {
        
        if (empty($buildid)) {
            $httpcode = \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST;
            
            $message = message(true, $httpcode, 'builid', 'Build ID belum diisi');
        } else {
            $httpcode = \Restserver\Libraries\REST_Controller::HTTP_OK;
            
            $data = $this->mpos->get_list_status($buildid);
            
            $message = message(false, $httpcode, '', $data);
        }
            
        // Response
        $this->response($message, $httpcode);
    }
}
