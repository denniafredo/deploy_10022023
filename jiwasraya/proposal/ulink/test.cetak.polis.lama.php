<?php

    include "./includes/session.php";
    include "./includes/database.php";
    include "./includes/common.php";
    include "./includes/pertanggungan.php";
    include "./includes/duit.php";
    include "./includes/klien.php";
    include "./libs/qr-sat/qr_img.php";

    require('./libs/fpdf181/fpdf.php');

    define("FPDF_FONTPATH", "./libs/fpdf181/font/");

    define("QRCODE", "./libs/phpqrcode");
    define("QRCODE_TEMP_DIR", "./libs/qr-sat/temp");

    $data['user_id']		 = $userid;
    $data['password']		 = $passwd;
    $data['db']				 = "JSDB";
    $data['prefix']			 = trim($_GET['prefix']);
    $data['nopertanggungan'] = trim($_GET['nopertanggungan']);
    $data['paragraph1']		 = "Penanggung dengan ini menyatakan setuju untuk membayarkan Manfaat Asuransi atas diri Tertanggung sebagaimana "
        . "yang tercantum dalam Polis ini berdasarkan syarat dan ketentuan Data Polis, Syarat Umum Polis, Ketentuan Khusus, "
        . "Ketentuan Tambahan dan ketentuan lainnya (bila ada) yang dilekatkan/dilampirkan pada Polis "
        . "dan merupakan satu kesatuan dan bagian yang tidak terpisahkan dari Polis ini.";
    $data['paragraph2']		 = "Dalam hal Pemegang Polis keberatan dan ingin membatalkan maksud untuk mempertanggungkan diri Tertanggung "
        . "berdasarkan polis ini, maka dapat mengembalikan Polis ini dalam masa Free Look Provision, yaitu dalam jangka "
        . "waktu 14 (empat belas) hari kalender sejak Polis ini diterima.";
    $data['paragraph3']		 = "Dalam hal masa Free Look Provision tersebut telah terlewati, maka \"Pemegang Polis dengan ini menyatakan bahwa "
        . "Pertanggungan sudah disetujui sesuai dengan Data Polis, Syarat Umum Polis, Ketentuan Khusus, Ketentuan Tambahan "
        . "dan atau ketentuan lainnya\".";

    class CetakPolis extends FPDF {
        private $user_id;
        private $password;
        private $db;
        private $prefix;
        private $nopertanggungan;
        private $paragraph1;
        private $paragraph2;
        private $paragraph3;
        private $tgl_cetak;
        private $jam_cetak;
        private $arr;
        private $arrs;
        private $arrr;
        private $ars;
        private $art;
        private $arrp;
        private $arrp2;
        private $arrk;
        private $arrt;
        private $arrt2;
        private $arrat;
        private $arrmp;

        private $pg_w		= 190;
        private $pg_h_b		= 268;
        private $num_space	= 10;
        private $height		= 5;
        private $premi1		= 0;
        private $premi2		= 0;
        private $cash_plan	= 0;
        private $flag_dst	= false;

        public function __construct($data) {
            parent::__construct('P', 'mm', 'A4');
            $this->SetMargins(10, 40); // Nilai ini bisa di adjust (Left, Top)
            $this->user_id		   = $data['user_id'];
            $this->password		   = $data['password'];
            $this->db			   = $data['db'];
            $this->prefix		   = $data['prefix'];
            $this->nopertanggungan = $data['nopertanggungan'];
            $this->paragraph1	   = $data['paragraph1'];
            $this->paragraph2	   = $data['paragraph2'];
            $this->paragraph3	   = $data['paragraph3'];
            $this->tgl_cetak	   = date('Ymd');
            $this->jam_cetak	   = date('His');

            $this->Init();
            $this->SPAJ();
            $this->DataPolis();
            $this->KetentuanPolis();
            //$this->AsuransiTambahan();
            $this->LampiranPolis();
        }

        public function Init() {
            $DA	  = new Database($this->user_id, $this->password, $this->db);

            $sql = "SELECT a.PREFIXPERTANGGUNGAN, a.TGLSP, TO_CHAR(a.MULAS, 'DD/MM/YYYY') AS MULAS, a.USIA_TH, a.NOPERTANGGUNGAN, 
                            TO_CHAR(a.EXPIRASI, 'DD/MM/YYYY') AS EXPIRASI, a.LAMAPEMBPREMI_BL AS PERIODE_BULAN, a.NOPEMEGANGPOLIS, 
                            a.LAMAASURANSI_TH, a.LAMAASURANSI_BL,TO_CHAR(a.TGLCETAK, 'DD/MM/YYYY') AS TGLCETAK, a.JUAMAINPRODUK, 
                            a.PREMI1, a.PREMI2, a.NOSP, a.KDVALUTA, a.KDCARABAYAR, a.KDSTATUSMEDICAL, 
                            DECODE (a.KDCARABAYAR, 'X', 1, 'E', 5, 'J', 10, a.LAMAPEMBPREMI_TH) LAMAPEMBPREMI_TH, 
                            a.KDPRODUK, i.NAMAVALUTA, i.NOTASI,
                            (SELECT CASE WHEN COUNT(*) > 0 THEN b.NAMAPRODUK || ' LENGKAP' ELSE b.NAMAPRODUK END FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE PREFIXPERTANGGUNGAN=a.PREFIXPERTANGGUNGAN AND NOPERTANGGUNGAN=a.NOPERTANGGUNGAN and KDBENEFIT='JAMLKP') NAMAPRODUK,
                            a.TGLNEXTBOOK, a.TGLLASTPAYMENT, b.KETERANGAN, 
                            CASE WHEN a.KDCARABAYAR = 'E' THEN 'Tahunan dibayar selama 5 tahun'
                                WHEN a.KDCARABAYAR = 'J' THEN 'Tahunan dibayar selama 10 tahun' 
                                ELSE c.NAMACARABAYAR END NAMACARABAYAR,
                            (SELECT NAMAKLIEN1 FROM $DBUser.TABEL_100_KLIEN WHERE NOKLIEN = a.NOAGEN) AS NAMAAGEN, 
                            (SELECT (SELECT NAMAAREAOFFICE FROM $DBUser.TABEL_410_AREA_OFFICE WHERE KDAREAOFFICE = v.KDAREAOFFICE AND KDKANTOR=v.KDKANTOR) FROM $DBUser.TABEL_400_AGEN v WHERE noagen=a.noagen) AS KTRAGEN, 
                            (SELECT kn.NAMAKANTOR FROM $DBUser.TABEL_001_KANTOR kn, $DBUser.TABEL_400_AGEN ag WHERE kn.KDKANTOR = ag.KDKANTOR AND ag.NOAGEN = a.NOAGEN ) AS KANTORFOOTER, 
                            /*CASE WHEN a.KDPRODUK IN ('JSSHTBU', 'JSSHTB') THEN (SELECT NAMAPEJABAT FROM $DBUser.TABEL_002_PEJABAT WHERE KDKANTOR = '$this->prefix' AND KDORGANISASI = '160') 
                                ELSE (SELECT pj.NAMAPEJABAT FROM $DBUser.TABEL_001_KANTOR kn, $DBUser.TABEL_400_AGEN ag, $DBUser.TABEL_002_PEJABAT pj WHERE kn.KDKANTOR = ag.KDKANTOR AND ag.NOAGEN = a.NOAGEN AND kn.KDKANTOR = pj.KDKANTOR AND pj.KDORGANISASI = '160' ) 
                            END AS NAMAPEJABAT,
                            CASE WHEN a.KDPRODUK IN ('JSSHTB') THEN (SELECT NAMAJABATAN FROM $DBUser.TABEL_002_PEJABAT WHERE KDKANTOR = '$this->prefix' AND KDORGANISASI = '160') 
                                ELSE (SELECT pj.NAMAJABATAN FROM $DBUser.TABEL_001_KANTOR kn, $DBUser.TABEL_400_AGEN ag, $DBUser.TABEL_002_PEJABAT pj WHERE kn.KDKANTOR = ag.KDKANTOR AND ag.NOAGEN = a.NOAGEN AND kn.KDKANTOR = pj.KDKANTOR AND pj.KDORGANISASI = '160' ) 
                            END AS NAMAJABATAN,*/
                            (SELECT NAMAPEJABAT FROM $DBUser.TABEL_002_PEJABAT pj INNER JOIN $DBUser.TABEL_500_PENAGIH pg ON pj.KDKANTOR = pg.KDRAYONPENAGIH WHERE pg.NOPENAGIH = a.NOPENAGIH AND KDORGANISASI = '160') AS NAMAPEJABAT, 
                            (SELECT NAMAJABATAN FROM $DBUser.TABEL_002_PEJABAT pj INNER JOIN $DBUser.TABEL_500_PENAGIH pg ON pj.KDKANTOR = pg.KDRAYONPENAGIH WHERE pg.NOPENAGIH = a.NOPENAGIH AND KDORGANISASI = '160') AS NAMAJABATAN,
                            d.GELAR AS GELARPP, d.ALAMATTETAP01, d.ALAMATTETAP02, TO_CHAR(d.TGLLAHIR, 'dd/mm/yyyy') TGLLAHIR,
                            d.KODEPOSTETAP, d.PHONETETAP01, d.NAMAKLIEN1 as PEMEGANGPOLIS, LENGTH(d.NAMAKLIEN1) PANJANG,
                            DECODE(e.GELAR, null, null, ', ' || e.GELAR) AS GELARTTG,
                            DECODE(d.GELAR, null, null, ', ' || d.GELAR) AS GELARPP, 
                            e.NAMAKLIEN1 as TERTANGGUNG,  TO_CHAR(e.TGLLAHIR, 'dd/mm/yyyy') TGLLAHIRTT, 
                            (SELECT x.FAKTORBAYAR FROM $DBUser.TABEL_311_FAKTOR_BAYAR x WHERE x.KDVALUTA = a.KDVALUTA and x.KDCARABAYAR = a.KDCARABAYAR and x.KDBASIS = f.KDBASISBAYAR) AS FAKTORBAYAR, a.PREMISTD,
                            d.ALAMATTETAP01 || ' ' || d.ALAMATTETAP02 || ' ' || g.NAMAKOTAMADYA || ' ' || h.NAMAPROPINSI AS ALAMATPEMPOL,
                            j.KDMAPPING, TO_CHAR(a.TGLCETAK, 'ddmmyyyy') TGLCETAKQR, a.NOREKENINGDEBET, d.MERITALSTATUS,
                            (SELECT NAMAPEJABAT FROM $DBUser.TABEL_002_PEJABAT WHERE KDKANTOR = 'KP' AND KDORGANISASI = '000') AS NAMADIREKTUR,
                            (SELECT NAMAJABATAN FROM $DBUser.TABEL_002_PEJABAT WHERE KDKANTOR = 'KP' AND KDORGANISASI = '000') AS JABATANDIREKTUR
                        FROM $DBUser.TABEL_200_PERTANGGUNGAN a
                        INNER JOIN $DBUser.TABEL_202_PRODUK b ON a.KDPRODUK = b.KDPRODUK
                        INNER JOIN $DBUser.TABEL_305_CARA_BAYAR c ON a.KDCARABAYAR = c.KDCARABAYAR
                        INNER JOIN $DBUser.TABEL_100_KLIEN d ON a.NOPEMEGANGPOLIS = d.NOKLIEN
                        INNER JOIN $DBUser.TABEL_100_KLIEN e ON a.NOTERTANGGUNG = e.NOKLIEN
                        LEFT OUTER JOIN $DBUser.TABEL_247_PERTANGGUNGAN_BASIS f ON a.PREFIXPERTANGGUNGAN = f.PREFIXPERTANGGUNGAN
                            AND a.NOPERTANGGUNGAN = f.NOPERTANGGUNGAN
                        LEFT OUTER JOIN $DBUser.TABEL_109_KOTAMADYA g ON d.KDKOTAMADYATETAP = g.KDKOTAMADYA
                        LEFT OUTER JOIN $DBUser.TABEL_108_PROPINSI h ON d.KDPROPINSITETAP = h.KDPROPINSI
                        LEFT OUTER JOIN $DBUser.TABEL_304_VALUTA i ON a.KDVALUTA = i.KDVALUTA
                        LEFT OUTER JOIN $DBUser.TABEL_001_KANTOR j ON a.PREFIXPERTANGGUNGAN = j.KDKANTOR
                        WHERE a.KDPERTANGGUNGAN = '2'
                            AND a.PREFIXPERTANGGUNGAN = '$this->prefix'
                            AND a.NOPERTANGGUNGAN = '$this->nopertanggungan'";
							
            $DA->parse($sql);
            $DA->execute();
            $this->arr = $DA->nextrow();

            $sql = "SELECT NVL((SELECT NVL(premi,0) 
                                            FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK 
                                            WHERE prefixpertanggungan = a.prefixpertanggungan AND nopertanggungan = a.nopertanggungan 
                                                AND kdbenefit='BNFTOPUPSG'),0) AS premitup,
                            NVL((SELECT NVL(premi,0) 
                                    FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK
                                    WHERE prefixpertanggungan = a.prefixpertanggungan AND nopertanggungan = a.nopertanggungan AND kdbenefit='BNFTOPUP'),0) AS premitub 
                        FROM $DBUser.TABEL_200_PERTANGGUNGAN a 
                        WHERE a.prefixpertanggungan = '$this->prefix' AND a.nopertanggungan = '$this->nopertanggungan'";
            $DA->parse($sql);
            $DA->execute();
            $this->arrs = $DA->nextrow();

            $sql = "SELECT SUM(a.premi) AS premi2jsap 
                        FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK a
                        INNER JOIN $DBUser.TABEL_200_PERTANGGUNGAN b ON a.PREFIXPERTANGGUNGAN = b.PREFIXPERTANGGUNGAN
                            AND a.NOPERTANGGUNGAN = b.NOPERTANGGUNGAN
                        WHERE  a.kdjenisbenefit in ('U') AND a.prefixpertanggungan = '$this->prefix' 
                            AND a.nopertanggungan = '$this->nopertanggungan'";
            $DA->parse($sql);
            $DA->execute();
            $this->arrr = $DA->nextrow();

            /*===== penerima manfaat asuransi =====*/
            $sql = "SELECT a.NOTERTANGGUNG, a.NOURUT, a.KDINSURABLE, a.NOKLIEN,
                            DECODE (b.namahubungan, 'DIRI TERTANGGUNG', 'TERTANGGUNG', 'ANAK YG DIBEASISWAKAN', b.namahubungan, 'PEMEGANG POLIS', b.namahubungan, b.namahubungan || ' TERTANGGUNG') AS NAMAHUBUNGAN,
                            c.NAMAKLIEN1 || DECODE (c.GELAR, NULL, NULL, ', ' || c.GELAR) AS NAMAKLIEN1, 
                            TO_CHAR(c.TGLLAHIR, 'dd/mm/yyyy') TGLLAHIR, b.NAMAHUBUNGAN NAMAHUBUNGANJSKEL
                        FROM $DBUser.TABEL_219_PEMEGANG_POLIS_BAW a
                        INNER JOIN $DBUser.TABEL_218_KODE_HUBUNGAN b ON a.KDINSURABLE = b.KDHUBUNGAN
                        INNER JOIN $DBUser.TABEL_100_KLIEN c ON a.NOKLIEN = c.NOKLIEN
                        WHERE a.PREFIXPERTANGGUNGAN = '$this->prefix'
                            AND a.NOPERTANGGUNGAN = '$this->nopertanggungan'
                        ORDER BY a.NOURUT";
            $DA->parse($sql);
            $DA->execute();
            $data = array();
            while($value = $DA->nextrow()) {
                $data[] = $value;
            }
            $this->ars = $data;

            // add new sql by salman sesuai req bu Liza tgl 07/12/2015, ngerubah tgl akhir bayar premi dan akhir asuransi
            $sql = "SELECT MIN (nilaibenefit) nilaibenefit,
                            kdbnfx,
                            DECODE (SUBSTR (kdbnfx, 1, 4),
                                'CPB5', 'JS HOSPITAL CPB',
                                'CPM5', 'JS HOSPITAL CPM',
                                'SP-D','JS SPOUSE PAYOR DB',
                                'SP-T','JS SPOUSE PAYOR TPD',
                                'PB-D','JS PAYOR DB',
                                'PB-T','JS PAYOR TPD',
                                MAX((SELECT MAX (namabenefit)
                                     FROM $DBUser.TABEL_207_KODE_BENEFIT
                                     WHERE   kdbenefit = xx.kdbnfx))) AS namabenefit,
                            DECODE (SUBSTR (kdbnfx, 1, 2),
                                'SP','TAMBAHAN',
                                'PB','TAMBAHAN','UTAMA') AS ATAS,
                            max(exp) AS exp,
                            max(TGLAKHIRPREMI) AS TGLAKHIRPREMI
                        FROM (
                            SELECT nilaibenefit, EXP, kdbnf,TGLAKHIRPREMI, 
                                CASE
                                    WHEN x > 0 AND SUBSTR (kdbnf, 1, 3) = 'HCP'
                                        THEN
                                            'HCPB' || SUBSTR (kdbnf, -3)
                                    WHEN x = 0 AND SUBSTR (kdbnf, 1, 3) = 'CPM'
                                        THEN
                                            'HCPM' || SUBSTR (kdbnf, -3)
                                    ELSE
                                        kdbnf
                                END AS kdbnfx
                            FROM (
                                SELECT nilaibenefit,
                                    (SELECT NVL (KDASALBENEFIT, KDBENEFIT)
                                     FROM $DBUser.TABEL_206_PRODUK_BENEFIT
                                     WHERE   KDPRODUK = A.KDPRODUK
                                          AND KDBENEFIT = A.KDBENEFIT)
                                    KDBNF,
                                    /*TO_CHAR (a.expirasi, 'dd/mm/yyyy') EXP, */
                                    (select TO_CHAR (expirasi, 'dd/mm/yyyy') 
                                     from $DBUser.tabel_200_pertanggungan 
                                     WHERE PREFIXPERTANGGUNGAN = a.PREFIXPERTANGGUNGAN
                                             AND NOPERTANGGUNGAN = a.NOPERTANGGUNGAN) exp,
                                    (select TO_CHAR (TGLAKHIRPREMI, 'dd/mm/yyyy') 
                                     from $DBUser.tabel_200_pertanggungan 
                                     WHERE PREFIXPERTANGGUNGAN = a.PREFIXPERTANGGUNGAN
                                             AND NOPERTANGGUNGAN = a.NOPERTANGGUNGAN) TGLAKHIRPREMI,		 
                                        (SELECT COUNT (*)
                                         FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK
                                         WHERE PREFIXPERTANGGUNGAN = a.PREFIXPERTANGGUNGAN
                                             AND NOPERTANGGUNGAN = a.NOPERTANGGUNGAN AND kdbenefit LIKE 'CPB%') AS x
                                FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK A,
                                $DBUser.TABEL_207_KODE_BENEFIT B
                                WHERE   PREFIXPERTANGGUNGAN = '$this->prefix'
                                    AND NOPERTANGGUNGAN = '$this->nopertanggungan'
                                    AND A.KDJENISBENEFIT = 'R'
                                    AND A.KDBENEFIT NOT LIKE '%ICU%'
                                    AND A.KDBENEFIT = B.KDBENEFIT
                                    AND A.KDBENEFIT NOT IN ('GADPOL', 'JAMLKP', 'EXTPREM'))
                        ) xx
                        GROUP BY kdbnfx";

            $DA->parse($sql);
            $DA->execute();
            $data = array();
            while($value = $DA->nextrow()) {
                $data[] = $value;
            }
            $this->art = $data;

            /*===== ketentuan polis token-token =====*/
            // DECODE(b.kdcarabayar, 'E', TO_CHAR(ADD_MONTHS(mulas, 60), 'dd/mm/yyyy'), 'J', TO_CHAR(ADD_MONTHS(mulas, 120), 'dd/mm/yyyy'), 'X', DECODE(b.kdproduk, 'P30N', TO_CHAR(ADD_MONTHS(mulas, lamapembpremi_th*12),'DD/MM/YYYY'), TO_CHAR(b.tglakhirpremi,'DD/MM/YYYY')), TO_CHAR(b.tglakhirpremi,'DD/MM/YYYY')) AS tglakhirpremi,
            $sql = "SELECT juamainproduk AS jua, $DBUser.terbilang(juamainproduk) AS juaterbilang, 
                            TO_CHAR(mulas,'DD/MM/YYYY') AS mulas, TO_CHAR(ADD_MONTHS(mulas, 12), 'DD/MM/YYYY') mulas_1year,
                            TO_CHAR(expirasi,'DD/MM/YYYY') AS expirasi, 
                            TO_CHAR(ADD_MONTHS(expirasi, -1), 'DD/MM/YYYY') expirasimin1month, 
                            premi1, premi2,
                            DECODE (b.kdcarabayar, 'E', 5, 'J', 10, lamapembpremi_th) pt,
                            DECODE (b.kdcarabayar, 'E', 0, 'J', 0, lamapembpremi_bl) ptb, usia_th,
                            b.kdproduk, b.kdvaluta,
                            (SELECT notasi FROM $DBUser.tabel_304_valuta za WHERE za.kdvaluta = b.kdvaluta) AS notasi,
                            (SELECT namaproduk FROM $DBUser.tabel_202_produk zb WHERE zb.kdproduk = b.kdproduk) AS namaproduk, b.kdcarabayar, 
                            DECODE(b.kdcarabayar, 'E', TO_CHAR(ADD_MONTHS(mulas, 60), 'dd/mm/yyyy'), 'J', TO_CHAR(ADD_MONTHS(mulas, 120), 'dd/mm/yyyy'), 'X', TO_CHAR(ADD_MONTHS(mulas, lamapembpremi_th*12),'DD/MM/YYYY'), TO_CHAR(b.tglakhirpremi,'DD/MM/YYYY')) AS tglakhirpremi, 
                            DECODE (a.meritalstatus, 'L', 'B', 'K', 'K', 'D', 'B', 'J', 'B', '*') bk,
                            c.kdbasispremi, c.kdbasistebus, c.kdbasisskg, c.kdbasiscwa, c.kdbasisbayar,
                            to_char(TRUNC(((10 * DECODE (b.kdcarabayar, 'E', 5, 'J', 10, lamapembpremi_th)) + (0.83 * DECODE (b.kdcarabayar, 'E', 0, 'J', 0, lamapembpremi_bl)) + 100),1)) AS DM0PROSEN
                        FROM $DBUser.TABEL_100_KLIEN a
                        INNER JOIN $DBUser.TABEL_200_PERTANGGUNGAN b ON a.NOKLIEN = b.NOTERTANGGUNG
                        LEFT OUTER JOIN $DBUser.TABEL_247_PERTANGGUNGAN_BASIS c ON b.PREFIXPERTANGGUNGAN = c.PREFIXPERTANGGUNGAN 
                            AND b.NOPERTANGGUNGAN = c.NOPERTANGGUNGAN
                        WHERE b.PREFIXPERTANGGUNGAN = '$this->prefix'
                            AND b.NOPERTANGGUNGAN = '$this->nopertanggungan'";
            $DA->parse($sql);
            $DA->execute();
            $this->arrp = $DA->nextrow();

            $sql = "SELECT kdbenefit,nilaibenefit, to_char(expirasi,'DD/MM/YYYY') AS expirasi, 
                            to_char(expirasi,'MM/YYYY') AS expirasib, to_char(akhirpmb,'MM/YYYY') AS akhirpmb
                        FROM $DBUser.tabel_223_transaksi_produk
                        WHERE prefixpertanggungan='$this->prefix'
                            AND nopertanggungan='$this->nopertanggungan'";
            $DA->parse($sql);
            $DA->execute();
            $data = array();
            while($value = $DA->nextrow()) {
                $data[] = $value;
            }
            $this->arrp2 = $data;

            /*===== ketentuan polis redaksi =====*/
            $sql = "SELECT b.noparagraph, b.kdparagraph, b.judul, b.teks
                        FROM $DBUser.tabel_239_redaksi_produk a, $DBUser.tabel_298_redaksi_ b
                        WHERE a.kdproduk='".$this->arrp['KDPRODUK']."' AND a.kdvaluta='".$this->arrp['KDVALUTA']."'
                              AND a.kdcarabayar='".($this->arrp['KDCARABAYAR'] == 'X' ? 'X' : 'B')."' AND a.bk IN ('".$this->arrp['BK']."','*')
                              AND a.kdredaksi=b.kdredaksi
                              AND TO_DATE('".$this->arr['MULAS']."', 'dd/mm/yyyy') BETWEEN periodeawal AND periodeakhir
                        ORDER BY b.noparagraph";

            $DA->parse($sql);
            $DA->execute();
            $data = array();
            while($value = $DA->nextrow()) {
                $data[] = $value;
            }
            $this->arrk = $data;

            /*===== nilai tebus/ekspirasi (header) =====*/
            $sql = "SELECT a.kdproduk, a.kdvaluta, 
                            DECODE(a.kdproduk, 'DMP', a.lamaasuransi_th, 'JSPEI5', a.lamaasuransi_th, 'JSPEIP', a.lamaasuransi_th, 'JSSPO7A', lamaasuransi_th, 'JSPEI5', lamaasuransi_th, 'JSPEIP', lamaasuransi_th, 'JSPEIPN', lamaasuransi_th, a.lamapembpremi_th) AS LPP,
                            a.usia_th,
                            DECODE(a.kdcarabayar, 'X', 'X', 'E', 'E', 'J', 'J', 'M', 'M', 'Q', 'Q', 'H', 'H', 'A', 'A', 'B') AS cbyr,
                            CASE WHEN SUBSTR(a.kdproduk,1,4) = 'JSSH' OR a.kdproduk IN ('JSGTP') THEN NVL(c.jualama, a.juamainproduk) ELSE
                                DECODE(a.kdproduk, 'JSPEI5', premi1, 'JSPEIP', premi1, 'JSSPO7A', (premi1/0.76923), 'JSSPO8', (premi1/0.76923), 'JSSPO9', (premi1/0.76923), a.juamainproduk) 
                            END AS jua,
                            NVL((SELECT SUM(za.juabebaspremi) FROM $DBUser.tabel_603_mutasi_pert za WHERE za.prefixpertanggungan=a.prefixpertanggungan AND za.nopertanggungan=a.nopertanggungan),0) AS juabp,
                            b.kdbasistebus, a.premi1
                        FROM $DBUser.TABEL_200_PERTANGGUNGAN a
                        INNER JOIN $DBUser.TABEL_247_PERTANGGUNGAN_BASIS b ON a.PREFIXPERTANGGUNGAN = b.PREFIXPERTANGGUNGAN
                            AND a.NOPERTANGGUNGAN = b.NOPERTANGGUNGAN
                        LEFT OUTER JOIN $DBUser.POLIS_HISTORY_JUA c ON a.PREFIXPERTANGGUNGAN = c.PREFIXPERTANGGUNGAN
                            AND a.NOPERTANGGUNGAN = c.NOPERTANGGUNGAN
                        WHERE a.PREFIXPERTANGGUNGAN = '$this->prefix'
                            AND a.NOPERTANGGUNGAN = '$this->nopertanggungan'";
            $DA->parse($sql);
            $DA->execute();
            $this->arrt = $DA->nextrow();

            /*===== nilai tebus/ekspirasi (detail) =====*/
            $kp				   = $this->arrt['KDPRODUK'];
            $this->arrt['LPP'] = ($kp == "HTB" || $kp == "HTK" || $kp == "HTS" || $kp == "HTT" || $kp == "ADB" ||
                $kp == "ADK" || $kp == "ADS" || $kp == "ADT" || $kp == "ADX") && $this->arrt['LPP'] > 20
                ? 20 : $this->arrt['LPP'];
            $this->flag_dst	   = ($kp == "HTB" || $kp == "HTK" || $kp == "HTS" || $kp == "HTT" || $kp == "ADB" ||
                $kp == "ADK" || $kp == "ADS" || $kp == "ADT" || $kp == "ADX") && $this->arrt['LPP'] > 20
                ? true : false;
            $sql = "SELECT a.t, a.tarif, NVL(b.tarif, 0) as tarifs
                        FROM $DBUser.TABEL_231_TARIF_TEBUS a
                        LEFT OUTER JOIN $DBUser.TABEL_231_tarif_tebus b ON a.kdproduk = b.kdproduk
                            AND a.masa = b.masa AND a.usia = b.usia AND a.kdvaluta = b.kdvaluta
                            AND b.cara = 'X' AND a.kdbasis = b.kdbasis AND a.kdtarif = b.kdtarif AND a.t = b.t
                        WHERE a.kdproduk = '".$this->arrt['KDPRODUK']."' AND a.masa = '".$this->arrt['LPP']."'
                            AND a.usia = '".$this->arrt['USIA_TH']."' AND a.kdvaluta = '".$this->arrt['KDVALUTA']."' 
                            AND a.cara = '".$this->arrt['CBYR']."' AND a.kdbasis = '".$this->arrt['KDBASISTEBUS']."' 
                            AND a.kdtarif = 'TEBUS'
                            AND a.tarif > 0
                        ORDER BY a.t";
            $DA->parse($sql);
            $DA->execute();
            $data = array();
            while($value = $DA->nextrow()) {
                $data[] = $value;
            }
            $this->arrt2 = $data;

            /*===== lakukan pengecekan terhadap cash plan =====*/
            $sql = "SELECT COUNT(1) AS CP
                        FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK
                        WHERE PREFIXPERTANGGUNGAN = '$this->prefix'
                            AND NOPERTANGGUNGAN = '$this->nopertanggungan'
                            AND KDPRODUK = '$kp'
                            AND KDBENEFIT LIKE 'CP%'";
            $DA->parse($sql);
            $DA->execute();
            $cp = $DA->nextrow();
            $this->cash_plan = $cp['CP'];

            /*===== asuransi tambahan =====*/
            $sql = "SELECT KDPRODUK, KDBENEFIT, NAMABENEFIT, MAX(LAMAPERIODE) 
                        FROM (
                            SELECT KDPRODUK, KDBENEFIT, NAMABENEFIT, LAMAPERIODE
                            FROM (
                                SELECT a.kdproduk,
                                    DECODE (SUBSTR (a.kdbenefit, 1, 2), 
                                    'CP', 'HCP',
                                    NVL(a.KDASALBENEFIT,a.kdbenefit)) AS kdbenefit, 
                                    DECODE (SUBSTR (a.kdbenefit, 1, 2), 'CP', 'JS HOSPITAL CASH PLAN', b.namabenefit) AS namabenefit, 
                                    lamaperiode
                                FROM $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b
                                WHERE a.kdbenefit = b.kdbenefit
                                    AND a.kdproduk = 'JL4B'
                                    AND a.kdjenisbenefit = 'R'
                                    AND b.kdbenefit <> 'RATEUP'
                                    AND b.kdkelompokbenefit IN ('B', 'E', 'D', 'T', 'C', 'R')
                                    AND b.faktorbenefit <> 'X'
                                    AND DECODE (SUBSTR (a.kdbenefit, 1, 2), 'CP', 'HCP', a.kdbenefit) NOT IN (
                                        SELECT   DECODE (SUBSTR (kdbenefit, 1, 2), 'CP', 'HCP', kdbenefit)
                                        FROM   $DBUser.tabel_223_transaksi_produk
                                        WHERE   prefixpertanggungan = '$this->prefix' AND nopertanggungan = '$this->nopertanggungan')
                            )
                            GROUP BY   KDPRODUK, KDBENEFIT, NAMABENEFIT,LAMAPERIODE
                        )
                        GROUP BY KDPRODUK, KDBENEFIT, NAMABENEFIT
                        ORDER BY max(LAMAPERIODE)";
            $DA->parse($sql);
            $DA->execute();
            $data = array();
            while($value = $DA->nextrow()) {
                $data[] = $value;
            }
            $this->arrat = $data;

            /*===== historis cetakan polis =====*/
            $sql = "SELECT CASE WHEN (
                                SELECT COUNT(KDMUTASI)
                                FROM $DBUser.TABEL_603_MUTASI_PERT 
                                WHERE PREFIXPERTANGGUNGAN = '$this->prefix' AND NOPERTANGGUNGAN = '$this->nopertanggungan' AND KDMUTASI IN ('28')
                            ) > 0 THEN '99' 
                            ELSE (
                                SELECT LPAD(COUNT(KDMUTASI), 2, '0') 
                                FROM $DBUser.TABEL_603_MUTASI_PERT 
                                WHERE PREFIXPERTANGGUNGAN = '$this->prefix' AND NOPERTANGGUNGAN = '$this->nopertanggungan' AND KDMUTASI IN ('32', '33') 
                            )END AS KDCETAK
                        FROM DUAL";
            $DA->parse($sql);
            $DA->execute();
            $this->arrmp = $DA->nextrow();

            /*===== tertanggung rider lampiran polis hospital care =====*/
            $sql = "SELECT c.noid, c.namaklien1 || DECODE(c.gelar, null, null, ',' || c.gelar) namaklien1, 
                        TO_CHAR(c.tgllahir, 'dd/mm/yyyy') tgllahir
                    FROM $DBUser.tabel_219_hospital a
                    INNER JOIN $DBUser.tabel_218_kode_hubungan b ON a.kdinsurable = b.kdhubungan
                    INNER JOIN $DBUser.tabel_100_klien c ON a.noklien = c.noklien
                    WHERE a.prefixpertanggungan = '$this->prefix'
                        AND a.nopertanggungan = '$this->nopertanggungan'
                    ORDER BY a.nourut";
            $DA->parse($sql);
            $DA->execute();
            $data = array();
            while($value = $DA->nextrow()) {
                $data[] = $value;
            }
            $this->ars2 = $data;

            /*===== nilai benefit rawat inap rider hospital care =====*/
            $sql = "SELECT a.kd_item_benefit, b.nama_item_benefit, null nama_kelas,
                            CASE WHEN a.kd_item_benefit IN ('IBA001', 'IBA002') THEN a.nilai_manfaat ELSE 99999999999.99 END nilai_manfaat, 1 urutan
                        FROM hc_item_benefit_spa@askes a
                        INNER JOIN hc_item_benefit@askes b ON a.kd_benefit = b.kd_benefit
                            AND a.kd_item_benefit = b.kd_item_benefit
                        WHERE no_spa = 'A021.01' AND kd_plan = (
                            SELECT kdbenefit
                            FROM $DBUser.tabel_223_transaksi_produk
                            WHERE prefixpertanggungan = '$this->prefix'
                                AND nopertanggungan = '$this->nopertanggungan'
                                AND kdbenefit IN ('JSHCA', 'JSHCB', 'JSHCC', 'JSHCD', 'JSHCE')
                        )
                        
                        UNION ALL
                        
                        SELECT null kd_item_benefit, null nama_item_benefit, nama_kelas, a.nilai_manfaat, 1 urutan
                        FROM hc_plan_benefit_spa@askes a
                        INNER JOIN hc_kelas_rs@askes  b ON a.kd_kelas = b.kd_kelas
                        WHERE no_spa = 'A021.01' AND kd_plan = (
                            SELECT kdbenefit
                            FROM $DBUser.tabel_223_transaksi_produk
                            WHERE prefixpertanggungan = '$this->prefix'
                                AND nopertanggungan = '$this->nopertanggungan'
                                AND kdbenefit IN ('JSHCA', 'JSHCB', 'JSHCC', 'JSHCD', 'JSHCE')
                        )
                        
                        UNION ALL
                        
                        SELECT a.kd_item_benefit, b.nama_item_benefit, null nama_kelas, a.nilai_manfaat, 2 urutan
                        FROM hc_item_benefit_spa@askes a
                        INNER JOIN hc_item_benefit@askes b ON a.kd_benefit = b.kd_benefit
                            AND a.kd_item_benefit = b.kd_item_benefit
                        WHERE no_spa = 'A021.01' AND kd_plan = (
                            SELECT kdbenefit
                            FROM $DBUser.tabel_223_transaksi_produk
                            WHERE prefixpertanggungan = '$this->prefix'
                                AND nopertanggungan = '$this->nopertanggungan'
                                AND kdbenefit IN ('JSHCA', 'JSHCB', 'JSHCC', 'JSHCD', 'JSHCE')
                        )
                        
                        UNION ALL
                        
                        SELECT null kd_item_benefit, null nama_item_benefit, nama_kelas, a.nilai_manfaat, 2 urutan
                        FROM hc_plan_benefit_spa@askes a
                        INNER JOIN hc_kelas_rs@askes  b ON a.kd_kelas = b.kd_kelas
                        WHERE no_spa = 'A021.01' AND kd_plan = (
                            SELECT kdbenefit
                            FROM $DBUser.tabel_223_transaksi_produk
                            WHERE prefixpertanggungan = '$this->prefix'
                                AND nopertanggungan = '$this->nopertanggungan'
                                AND kdbenefit IN ('JSHCA', 'JSHCB', 'JSHCC', 'JSHCD', 'JSHCE')
                        )
                        
                        ORDER BY urutan, kd_item_benefit, nama_kelas nulls last";
            $DA->parse($sql);
            $DA->execute();
            $data = array();
            while($value = $DA->nextrow()) {
                $data[] = $value;
                $this->kelasrs = !empty($value['NAMA_KELAS']) && strlen($value['NAMA_KELAS']) > 0 ? $value['NAMA_KELAS'] : $this->kelasrs;
            }
            $this->arri = $data;
        }

        public function SPAJ() {
            $this->AddPage();

            $arr			= $this->arr;
            /*$today			= date("j-g-Y");*/
            /*$premi_standard = $arrr["PREMI2JSAP"];*/
            /*$premi_2_jsap	= $arrr["PREMI2JSAP"];*/
            /*$lama_premi		= $arr["LAMAPEMBPREMI_TH"];*/
            /*$kd_produk		= $arr["KDPRODUK"];*/
            /*$kd_cara_bayar	= $arr["KDCARABAYAR"];*/
            $nama_agen		= $arr["NAMAAGEN"];
            $ktr_agen		= $arr["KTRAGEN"];
            $nama_pejabat	= strpos($arr["NAMAPEJABAT"], ',') > 0
                ? ucwords(strtolower(substr($arr["NAMAPEJABAT"], 0, strpos($arr["NAMAPEJABAT"], ','))))
                . substr($arr["NAMAPEJABAT"], strpos($arr["NAMAPEJABAT"], ","))
                : ucwords(strtolower($arr["NAMAPEJABAT"]));
            $nama_jabatan	= ucwords(strtolower($arr["NAMAJABATAN"]));
            /*$extra_premi	= 5;*/
            /*$sisa_bayar		= $lama_premi - $extra_premi;*/
            $tgl_cetak		= $arr["TGLCETAK"];
            /*$faktor_bayar	= $arr["FAKTORBAYAR"];*/
            /*$macam_polis	= $arr["KDVALUTA"] == 0 ? "RUPIAH DENGAN INDEX"
                            : ($arr["KDVALUTA"] == 1 ? "RUPIAH TANPA INDEX"
                            : ($arr['KDVALUTA'] == 3 ? "US DOLLAR" : NULL));*/
            /*$premi1			= $kd_produk == "JSAP1" && $kd_produk == "JSAP2" ? $premi1jsap * $faktor_bayar : $arr["PREMI1"];*/
            /*$premi2			= $kd_produk == "JSAP1" && $kd_produk == "JSAP2" ? $premi_2_jsap * $faktor_bayar : $arr["PREMI2"];*/
            /*$besarnya		= $kd_cara_bayar == "X" || $kd_cara_bayar == "E" || $kd_cara_bayar == "J"  || $kd_sts_medical == "M" || $kd_ht == "HT" || $lama_premi < 5
                            ? $arr['NOTASI']." ".number_format($premi1, 2)." DIBAYAR SECARA ".$arr["NAMACARABAYAR"]
                            : $arr['NOTASI']." ".number_format($premi1, 2)." DIBAYAR SECARA ".$arr["NAMACARABAYAR"]." SELAMA 5 TAHUN "." DAN ".$arr["NOTASI"]." ".number_format($premi2,2)." UNTUK ".$sisabayar." TAHUN BERIKUTNYA ";*/
            /*$macas			= $arr["KDPRODUK"]=='JL4B' ? "Regular"
                            : ($arr["KDPRODUK"]=='JL4X' ? "Single" : NULL);*/
            /*$klien			= new Klien($this->user_id, $this->password, $arr["NOPEMEGANGPOLIS"]);*/
            $height			= $this->height;

            $this->SetFont('Arial','B',14);
            $this->Cell($this->pg_w, $height, 'POLIS ASURANSI JIWA', 0, 1, 'C');
            $this->SetFont('Arial','B',10);
            $this->Cell($this->pg_w, $height, "NOMOR POLIS : $this->prefix - $this->nopertanggungan", 0, 0, 'C');


            $this->Ln(10);


            $this->font_title('B');
            $this->Cell($this->pg_w, $height, 'PT ASURANSI JIWA IFG', 0, 1, 'C');
            $this->custom_font(8,'');
            $this->Cell($this->pg_w, $height, 'BERKEDUDUKAN DI JAKARTA', 0, 1, 'C');
            $this->Cell($this->pg_w, $height, "SELANJUTNYA DISEBUT PENANGGUNG", 0, 0, 'C');


            $this->Ln(5);


            $this->font_body();
            $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
            $this->Cell($this->pg_w-$this->num_space-102, $height, "Atas Surat Permohonan Asuransi Jiwa (SPAJ) nomor : ", 0);
            $this->font_body('B');
            $x1 = $this->GetX();
            $this->Write(5, $arr["NOSP"]);
            $x2 = $this->GetX();
            $y1 = $this->GetY();
            $this->font_body();
            $this->MultiCell($this->pg_w-($this->num_space*2)-($x2-$x1)-($this->pg_w-$this->num_space-102), 5, ", beserta semua pernyataan dan keterangan yang ****************************", 0, 'J');
            $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
            $this->SetXY($this->GetX(), $y1+5);
            $this->SetFillColor(255,255,255);
            $this->MultiCell($this->pg_w-($this->num_space*2), 5, "disampaikan oleh :", 0, 'J', true);

            $this->Ln(5);


            $this->font_title('B');
            $this->Cell($this->pg_w, $height, $arr["PEMEGANGPOLIS"].$arr["GELARPP"], 0, 1, "C");
            $this->font_body();
            $this->Cell($this->pg_w, $height, "(Selanjutnya disebut Pemegang Polis)", 0, 1, "C");

            $this->Ln(5);

            $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
            $this->MultiCell($this->pg_w-($this->num_space*2), $height, $this->paragraph1, 0);


            $this->Ln(2);


            $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
            $this->Cell(($this->pg_w-($this->num_space*2))/3, $height, NULL, 0, 0, 'C');
            $this->Cell(($this->pg_w-($this->num_space*2))/3, $height, NULL, 0, 0, 'C');
            $this->Cell(($this->pg_w-($this->num_space*2))/3, $height, "Jakarta, ".ucwords(strtolower($this->tgl_indonesia($tgl_cetak))), 0, 1, 'C');
            $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
            $this->Cell(($this->pg_w-($this->num_space*2))/3, $height, '', 0, 0, 'C');
            $this->Cell(($this->pg_w-($this->num_space*2))/3, $height, NULL, 0, 0, 'C');
            $this->Cell(($this->pg_w-($this->num_space*2))/3, $height, "PT ASURANSI JIWA IFG", 0, 1, 'C');
            $this->Image('./images/tandatangan.jpg', 145, $this->GetY()+5, 37);

            $this->Ln(20);

            $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
            $x1 = $this->GetX();
            $y1 = $this->GetY();
            $this->Cell(($this->pg_w-($this->num_space*2))/3, 5, $nama_pejabat , 0, 1, 'C');
            $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
            $this->Cell(($this->pg_w-($this->num_space*2))/3, 4, $nama_jabatan, 0, 0, 'C');

            $this->SetXY($x1 + ($this->pg_w-($this->num_space*2))/3, $y1);

            $x1 = $this->GetX();
            $y1 = $this->GetY();
            $this->font_ttd();
            $this->MultiCell(($this->pg_w-($this->num_space*2))/3, 3, "Bea Materai Lunas Rp 6000 berdasarkan keputusan\nKantor Pelayanan Pajak Tanggal : 20 Juni 2013\nNomor SI-00054/SK/WPJ.06/KP.1203/2013", 0, 'C', false);
            $y2 = $this->GetY();
            $yH = $y2 - $y1;

            $this->SetXY($x1 + ($this->pg_w-($this->num_space*2))/3, $y2 - $yH);
            $this->SetFont('Arial', '', 9);
            $this->Cell(($this->pg_w-($this->num_space*2))/3, 5, $arr['NAMADIREKTUR'], 0, 1, 'C');

            $this->SetXY($x1 + ($this->pg_w-($this->num_space*2))/3, $this->GetY());
            $this->Cell(($this->pg_w-($this->num_space*2))/3, 4, $arr['JABATANDIREKTUR'], 0, 1, 'C');


            $this->Ln(15);

            $this->font_body('B');
            $this->Cell($this->pg_w, $height, "MOHON PELAJARI POLIS INI DENGAN CERMAT", 0, 1, "C");

            $this->Ln(2);

            $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
            $this->font_body();
            $this->MultiCell($this->pg_w-($this->num_space*2), $height, $this->paragraph2, 0);

            $this->Ln(2);

            $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
            $this->font_body();
            $this->MultiCell($this->pg_w-($this->num_space*2), $height, $this->paragraph3, 0);

            // italic free look provision
            $this->SetXY($this->GetX()+112.2, $this->GetY()-27);
            $this->SetFont('Arial', 'I', 9);
            $this->Cell(29.3, $height, 'Free Look Provision', 0, 1, 'L', true);
            $this->SetXY($this->GetX()+35, $this->GetY()+7);
            $this->Cell(29.3, $height, 'Free Look Provision', 0, 0, 'L', true);

            $this->SetXY(10.00125, 199.00125);

            /*QRCode engine*/
            $filename = QRCODE_TEMP_DIR."/".substr(md5(md5(strtotime('now')+date("u"))), -10, 10).".png";
            $data_qrc = ('http://www.jiwasraya.co.id/scan/?q='.base64_encode($this->prefix.$this->nopertanggungan));
            $image = new Qrcode();
            $image->setdata($data_qrc);
            $image->calculate();
            $image->save($filename);
            /*end of QRCode */

            $this->Image($filename, 158, 220, 30, 30);
            $this->Ln(49);
            $this->Cell($this->num_space + 140, $height, NULL, 0, 0, 'C');
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(26, $height, $arr['TGLCETAKQR'].$this->arrmp['KDCETAK'], 0, 0, 'C');

            /*$this->Ln(69);
            $this->SetFont('Arial','',7);
            $this->Cell($this->num_space, 4, NULL, 0, 0, 'C');
            $this->Cell(($this->pg_w-($this->num_space*2))/4, 4, NULL, 0, 0, 'C');
            $this->Cell(($this->pg_w-($this->num_space*2))*3/8, 4, NULL, 0, 0, 'C');
            $this->Cell(($this->pg_w-($this->num_space*2))*3/8, 4, $nama_agen.'/'.$ktr_agen, 0, 1, 'L');
            $this->Cell($this->num_space, 4, NULL, 0, 0, 'C');
            $this->Cell(($this->pg_w-($this->num_space*2))/4, 4, NULL, 0, 0, 'C');
            $this->Cell(($this->pg_w-($this->num_space*2))*3/8, 4, NULL, 0, 0, 'C');
            $this->Cell(($this->pg_w-($this->num_space*2))*3/8, 4, $arr["KANTORFOOTER"], 0, 1, 'L');*/
        }

        public function DataPolis() {
            $this->AddPage();

            $height			= $this->height;
            $arr			= $this->arr;
            $arrs			= $this->arrs;
            $arrr			= $this->arrr;
            $kd_cara_bayar	= $arr["KDCARABAYAR"];
            $lama_premi		= $arr["LAMAPEMBPREMI_TH"];
            $sisa_lm_bayar	= $kd_cara_bayar == 'J' ? 5 : abs($arr["LAMAPEMBPREMI_TH"]) - 5;
            $kd_produk		= $arr["KDPRODUK"];
            $kd_ht			= substr($kd_produk, 0, 2);
            $kd_sts_medical = $arr["KDSTATUSMEDICAL"];
            $premi_2_jsap	= $arrr["PREMI2JSAP"];
            $faktor_bayar	= $arr["FAKTORBAYAR"];
            $premi1			= $kd_produk == "JSAP1" && $kd_produk == "JSAP2"
                ? $premi_1_jsap * $faktor_bayar :
                ( substr($kd_produk, 0, 3) == "JL3" // jika produk link
                    ? $arr['PREMISTD'] : $arr["PREMI1"]);
            $premi2			= $kd_produk == "JSAP1" && $kd_produk == "JSAP2"
                ? $premi_2_jsap * $faktor_bayar :
                ( substr($kd_produk, 0, 3) == "JL3"
                    ? $arr['PREMISTD'] : $arr["PREMI2"]);
            $premi_standard = $arrr["PREMI2JSAP"];
            $tgl_mulas		= $arr['MULAS'];
            $tgl_expirasi_p	= $kd_produk == "JSSPKN" ? "-" : $this->arrp['TGLAKHIRPREMI']; //edited filter JSSPKN // edited $kd_produk == "JSP" ? date('d/m/Y', strtotime($arr['EXPIRASI']." -5 year")) : $arr['EXPIRASI'];

            $this->font_title('B');
            $this->Cell($this->pg_w, $height, 'DATA POLIS', 0, 1, 'C');
            $this->Cell($this->pg_w, $height, "NOMOR : $this->prefix - $this->nopertanggungan", 0, 0, 'C');


            $this->Ln(10);


            $this->SetFont('Arial','B',9);
            $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
            $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Nama Pemegang Polis", 0, 0, 'L');
            $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
            $this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, $arr["PEMEGANGPOLIS"].$arr["GELARPP"], 0, 1, 'L');
            //
            $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
            $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Alamat Pemegang Polis", 0, 0, 'L');
            $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
            //$this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, $arr["ALAMATPEMPOL"], 1, 1, 'L');
            $this->MultiCell(($this->pg_w-($this->num_space*2))*17/25, 5, $arr["ALAMATPEMPOL"], 0, 'L', true);
            //
            $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
            $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Macam Asuransi", 0, 0, 'L');
            $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
            $this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, $arr["NAMAPRODUK"], 0, 1, 'L');
            //
            /* jika produknya JSAA maka */
            if (in_array($kd_produk, array('JSAA', 'JSHAA'))) {
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Anuitas Sebulan", 0, 0, 'L');
                $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
                $this->SetFont('Arial','',9);
                $this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, $arr['NOTASI'].".".number_format($arr["JUAMAINPRODUK"],2,",","."), 0, 1, 'L');
            }
            // jika produknya JSPNSB atau JSPNSK
            else if($kd_produk == 'JSPNSB' || $kd_produk == 'JSPNSK'){
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Uang Asuransi", 0, 0, 'L');
                $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
                $this->SetFont('Arial','',9);
                $this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, $arr['NOTASI'].".".number_format($arr["JUAMAINPRODUK"],2,",","."), 0, 1, 'L');
                //
                $this->SetFont('Arial','B',9);
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Masa Asuransi", 0, 0, 'L');
                $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
                $this->SetFont('Arial','',9);
                $this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, $this->tgl_indonesia($arr["MULAS"], 2)." sampai ".$this->tgl_indonesia($arr["EXPIRASI"], 2), 0, 1, 'L');
            }
            // jika produknya JS Index Plan Assurance
            else if ($kd_produk == 'JSIPA') {
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Uang Asuransi Kecelakaan", 0, 0, 'L');
                $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
                $this->SetFont('Arial','',9);
                $this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, $arr['NOTASI'].".".number_format($premi1,2,",","."), 0, 1, 'L');
            }
            // jika produknya bukan JS Heritage Annuity Assurance
            else {
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Uang Asuransi Dasar", 0, 0, 'L');
                $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
                $this->SetFont('Arial','',9);
                $this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, $arr['NOTASI'].".".number_format($arr["JUAMAINPRODUK"],2,",","."), 0, 1, 'L');
                //
                $this->SetFont('Arial','B',9);
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Masa Asuransi", 0, 0, 'L');
                $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
                $this->SetFont('Arial','',9);
                $this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, $this->tgl_indonesia($arr["MULAS"], 2)." sampai ".$this->tgl_indonesia($arr["EXPIRASI"], 2), 0, 1, 'L');
            }
            //
            $this->SetFont('Arial','B',9);
            $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
            $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Valuta", 0, 0, 'L');
            $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
            $this->SetFont('Arial','',9);
            $this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, ucwords(strtolower($arr["NAMAVALUTA"])), 0, 1, 'L');
            //
            /* tambahan untuk produk JSSPKN oleh fendy */
            if ($kd_produk == "JSSPKN") {
                $this->SetFont('Arial','B',9);
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Periode Investasi", 0, 0, 'L');
                $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
                $this->SetFont('Arial','',9);
                $this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, "12 Bulan", 0, 1, 'L');
            }
            /* akhir tambahan oleh fendy */
            //
            /* tambahan untuk produk JSSPBTN oleh fendy */
            if ($kd_produk == "JSSPBTN") {
                $this->SetFont('Arial','B',9);
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Periode Investasi", 0, 0, 'L');
                $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
                $this->SetFont('Arial','',9);
                $this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, "12 Bulan", 0, 1, 'L');
                //
                $this->SetFont('Arial','B',9);
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Premi", 0, 0, 'L');
                $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
                $this->SetFont('Arial','',9);
                $this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, $arr['NOTASI'].".".number_format($premi1,2), 0, 1, 'L');
                //
                $this->SetFont('Arial','B',9);
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Nomor Rekening", 0, 0, 'L');
                $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
                $this->SetFont('Arial','',9);
                $this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, $arr['NOREKENINGDEBET'], 0, 1, 'L');
            }
            /* tambahan untuk produk JSREMAJA oleh fendy */
            else if (in_array($kd_produk, array('JSR1', 'JSR2', 'JSR3', 'JSR4', 'JSPNSK', 'JSPNSB'))) {
                $this->SetFont('Arial','B',9);
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Premi Asuransi", 0, 0, 'L');
                $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
                $this->SetFont('Arial','',9);
                $this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, $arr['NOTASI'].".".number_format($premi1,2), 0, 1, 'L');
                //
                $this->SetFont('Arial','B',9);
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Nomor Host to Host", 0, 0, 'L');
                $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
                $this->SetFont('Arial','',9);
                $this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, $arr["KDMAPPING"].$arr['NOPERTANGGUNGAN'], 0, 1, 'L');
            }
            // jika produknya JS Index Plan Assurance
            else if ($kd_produk == 'JSIPA') {
                $this->SetFont('Arial','B',9);
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Premi", 0, 0, 'L');
                $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
                $this->SetFont('Arial','',9);
                $this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, $arr['NOTASI'].".".number_format($premi1,2), 0, 1, 'L');
                //
                $this->SetFont('Arial','B',9);
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Periode Investasi", 0, 0, 'L');
                $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
                $this->SetFont('Arial','',9);
                $this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, "12 Bulan", 0, 1, 'L');
                //
                $this->SetFont('Arial','B',9);
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Nomor Host to Host", 0, 0, 'L');
                $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
                $this->SetFont('Arial','',9);
                $this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, $arr["KDMAPPING"].$arr['NOPERTANGGUNGAN'], 0, 1, 'L');
            }
            else {
                $this->SetFont('Arial', 'B', 9);
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                if (!in_array($kd_produk, array('JSAA', 'JSRIA', 'JSPNSK', 'JSPNSB', 'JSHAA'))) {
                    $this->Cell(($this->pg_w - ($this->num_space * 2)) * 7 / 25, $height, 'Premi Asuransi Dasar', 0, 0, 'L');
                } else {
                    $this->Cell(($this->pg_w - ($this->num_space * 2)) * 7 / 25, $height, 'Premi', 0, 0, 'L');
                }
                $this->Cell(($this->pg_w - ($this->num_space * 2)) / 25, $height, ":", 0, 0, 'L');
                //
                $this->SetFont('Arial','',9);
                if ($kd_cara_bayar == "X" /*|| $kd_cara_bayar == "E" || $kd_cara_bayar == "J"*/ || $kd_sts_medical == "M" || $kd_ht == "HT" || $lama_premi < 5) {
                    $this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, $arr['NOTASI'].".".number_format($premi1,2)." Dibayar secara ".strtolower($arr["NAMACARABAYAR"]), 0, 1, 'L');
                }
                else if ($premi2 > 0) {
                    $this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, $arr['NOTASI'].".".number_format($premi1,2,",",".")." dibayar untuk 5 tahun pertama", 0, 1, 'L'); // $premi_standard -> $premi1
                    $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                    $this->Cell(($this->pg_w-($this->num_space*2))*8/25, $height, NULL, 0, 0, 'L');
                    $this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, "dan ".$arr['NOTASI'].".".number_format($premi2,2,",",".")." untuk ".$sisa_lm_bayar." tahun berikutnya", 0, 1, 'L');
                }
                else {
                    //$this->Cell(($this->pg_w-($this->num_space*2))*16/25, $height, number_format($premi_standard,2,",",".")." DIBAYAR UNTUK 5 TAHUN PERTAMA", 0, 1, 'L');
                    $this->Cell(($this->pg_w-($this->num_space*2))*16/25, $height, number_format($premi1,2,",",".")." dibayar untuk 5 tahun pertama", 0, 1, 'L');
                }
                //
                $this->SetFont('Arial','B',9);
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Nomor Host to Host", 0, 0, 'L');
                $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
                $this->SetFont('Arial','',9);
                $this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, $arr["KDMAPPING"].$arr['NOPERTANGGUNGAN'], 0, 1, 'L');

                /* add tambahan by salman 08/12/2015 jika produknya tidak sama dengan kode berikut */
                if (!in_array($kd_produk, array('JSAA', 'JSRIA', 'JSPNSK', 'JSPNSB', 'JSHAA'))) {
                    $this->SetFont('Arial','B',9);
                    $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                    $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Premi Asuransi Tambahan", 0, 0, 'L');
                    $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
                    $this->SetFont('Arial','',9);
                    $this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, "Sesuai lembar rekapitulasi premi", 0, 1, 'L');
                }
                /* end add tambahan by salman 08/12/2015 */
            }
            //
            /* akhir tambahan untuk produk JSSPBTN oleh fendy */

            //
            /* tambahan untuk produk JSSPKN, JSSPBTN, JSR1, JSR2, JSR3, JSR4, JSAA, JSRIA topup disembunyikan oleh fendy */
            if (!in_array($kd_produk, array('JSSPKN', 'JSSPBTN', 'JSR1', 'JSR2', 'JSR3', 'JSR4', 'JSAA', 'JSRIA', 'JSPNSK', 'JSPNSB', 'JSIPA', 'JSHAA'))) {
                /*Tambahan untuk perubahan Topup agar jenis topup dimasukkan ada dua Single dan Reguler oleh Dedi 19/03/2014*/
                $this->SetFont('Arial','B',9);
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Top Up Berkala", 0, 0, 'L');
                $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
                //$this->Cell(($this->pg_w-($this->num_space*2))/25, $height, "Rp.", 0, 0, 'L');
                $this->SetFont('Arial','',9);
                $this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, $arr['NOTASI'].".".number_format($arrs["PREMITUB"],2,",","."), 0, 1, 'L');
                //
                if($arr["KDPRODUK"] == 'JL4B') {
                    $this->SetFont('Arial','B',9);
                    $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                    $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Top Up Reguler", 0, 0, 'L');
                    $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
                    $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, $arr['NOTASI'].".", 0, 0, 'L');
                    $this->SetFont('Arial','',9);
                    $this->Cell(($this->pg_w-($this->num_space*2))*16/25, $height, number_format($arrs["PREMITUP"],2,",","."), 0, 1, 'L');
                }
                /*Akhir tambahan topup  oleh Dedi 19/03/2014*/
            }
            /* akhir tambahan oleh fendy */
            //
            $this->SetFont('Arial','B',9);
            $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
            $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Cara Bayar Premi", 0, 0, 'L');
            $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
            //$this->SetFont('Arial','',9);
            $this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, ucwords(strtolower($arr["NAMACARABAYAR"])), 0, 1, 'L');
            //
            // add condition by salman 08/12/2015, req by bu Liza.
            if($arr["NAMACARABAYAR"]<>'SEKALIGUS'){
                $this->SetFont('Arial','B',9);
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Lama Pembayaran", 0, 0, 'L');
                $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
                $this->SetFont('Arial','',9);
                $this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, $arr["LAMAPEMBPREMI_TH"].' Tahun', 0, 1, 'L');
            }

            $this->Ln(4);


            $this->SetFont('Arial','B',9);
            $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
            $this->Cell($this->pg_w-($this->num_space*2), $height, "Penerima Manfaat Asuransi", 0, 1, 'L');
            $this->SetFont('Arial','',9);
            foreach($this->ars as $value) {
                $nama = strlen($value["GELAR"]) == 0 ? $value["NAMAKLIEN1"].",".$value["GELAR"] : $value["NAMAKLIEN1"];
                /*$hub  = $value["KDINSURABLE"] == '04'
                      ? ($ars["NOKLIEN"] == $ars["NOTERTANGGUNG"] ? "DIRI TERTANGGUNG" : "BELUM DIDEFINISIKAN")
                      : $ars["NAMAHUBUNGAN"];*/
                $hub  = $value['KDINSURABLE'] == '04' && $arr['KDPRODUK'] == 'JSKEL' ? 'TERTANGGUNG UTAMA'
                    : ($value['KDINSURABLE'] != '04' && $arr['KDPRODUK'] == 'JSKEL' ? $value["NAMAHUBUNGANJSKEL"] : $value["NAMAHUBUNGAN"]);
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                $this->Cell($this->pg_w-($this->num_space*2), $height, trim($value["NOURUT"]).". ".ucwords(strtolower(trim($hub))).", ".trim($nama), 0, 1, 'L');
            }


            $this->Ln(4);


            // perubahan untuk nama tertanggung jika produk JS Keluarga, maka tertanggung adalah semua penerima manfaat
            // di ubah oleh fendy pada tanggal 01 September 2015
            if ($arr["KDPRODUK"] == "JSKEL" && $arr['MERITALSTATUS'] != 'H') {
                $this->SetFont('Arial','B',9);
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Nama Tertanggung", 0, 0, 'L');
                $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
                $this->SetFont('Arial','',9);
                $this->Cell(($this->pg_w-($this->num_space*2))*9/25, $height, "1.".$arr["TERTANGGUNG"].$arr["GELARTTG"], 0, 0, 'L');
                $this->SetFont('Arial','B',9);
                $this->Cell(($this->pg_w-($this->num_space*2))*4/25, $height, "Tanggal Lahir", 0, 0, 'L');
                $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
                $this->SetFont('Arial','',9);
                $this->Cell(($this->pg_w-($this->num_space*2))*3/25, $height, $arr["TGLLAHIRTT"], 0, 1, 'L');

                foreach($this->ars as $i => $value) {
                    $nama = strlen($value["GELAR"]) == 0 ? $value["NAMAKLIEN1"].",".$value["GELAR"] : $value["NAMAKLIEN1"];

                    if ($i > 0 && $arr['MERITALSTATUS'] != 'A' && $arr['MERITALSTATUS'] != 'B' && $arr['MERITALSTATUS'] != 'I' && $arr['MERITALSTATUS'] != 'M' && $arr['MERITALSTATUS'] != 'N') {
                        $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                        $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, NULL, 0, 0, 'L');
                        $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, NULL, 0, 0, 'L');
                        $this->Cell(($this->pg_w-($this->num_space*2))*9/25, $height, ($i+1).".".$nama, 0, 0, 'L');
                        $this->SetFont('Arial','B',9);
                        $this->Cell(($this->pg_w-($this->num_space*2))*4/25, $height, "Tanggal Lahir", 0, 0, 'L');
                        $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
                        $this->SetFont('Arial','',9);
                        $this->Cell(($this->pg_w-($this->num_space*2))*3/25, $height, $value["TGLLAHIR"], 0, 1, 'L');
                    } else if ($i > 0 && ($arr['MERITALSTATUS'] == 'A' || $arr['MERITALSTATUS'] == 'B' || $arr['MERITALSTATUS'] == 'I' || $arr['MERITALSTATUS'] == 'M' || $arr['MERITALSTATUS'] == 'N') && ($value['KDINSURABLE'] == 'TA' || $value['KDINSURABLE'] == 'TB' || $value['KDINSURABLE'] == 'TC' || $value['KDINSURABLE'] == 'TI' || $value['KDINSURABLE'] == 'TS')) {
                        $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                        $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, NULL, 0, 0, 'L');
                        $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, NULL, 0, 0, 'L');
                        $this->Cell(($this->pg_w-($this->num_space*2))*9/25, $height, ($i+1).".".$nama, 0, 0, 'L');
                        $this->SetFont('Arial','B',9);
                        $this->Cell(($this->pg_w-($this->num_space*2))*4/25, $height, "Tanggal Lahir", 0, 0, 'L');
                        $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
                        $this->SetFont('Arial','',9);
                        $this->Cell(($this->pg_w-($this->num_space*2))*3/25, $height, $value["TGLLAHIR"], 0, 1, 'L');
                    }
                }
            }
            else {
                $this->SetFont('Arial','B',9);
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Nama Tertanggung", 0, 0, 'L');
                $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
                $this->SetFont('Arial','',9);
                $this->Cell(($this->pg_w-($this->num_space*2))*9/25, $height, $arr["TERTANGGUNG"].$arr["GELARTTG"], 0, 0, 'L');
                $this->SetFont('Arial','B',9);
                $this->Cell(($this->pg_w-($this->num_space*2))*4/25, $height, "Tanggal Lahir", 0, 0, 'L');
                $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
                $this->SetFont('Arial','',9);
                $this->Cell(($this->pg_w-($this->num_space*2))*3/25, $height, $arr["TGLLAHIRTT"], 0, 1, 'L');
            }
            //
            $this->SetFont('Arial','B',9);
            $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
            $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Nama Pemegang Polis", 0, 0, 'L');
            $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
            $this->SetFont('Arial','',9);
            $this->Cell(($this->pg_w-($this->num_space*2))*9/25, $height, $arr["PEMEGANGPOLIS"].$arr["GELARPP"], 0, 0, 'L');
            $this->SetFont('Arial','B',9);
            $this->Cell(($this->pg_w-($this->num_space*2))*4/25, $height, "Tanggal Lahir", 0, 0, 'L');
            $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
            $this->SetFont('Arial','',9);
            $this->Cell(($this->pg_w-($this->num_space*2))*3/25, $height, $arr["TGLLAHIR"], 0, 1, 'L');


            $this->Ln(3);


            $this->SetFont('Arial','B',8);
            $this->SetFillColor(224,224,224);
            $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
            $x = $this->GetX();
            $y = $this->GetY();
            $this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height*3, "Macam Asuransi", 0, 0, 'C', true);

            $x1 = $this->GetX();
            $y1 = $this->GetY();
            $this->MultiCell(($this->pg_w-($this->num_space*2))*3/25, 5, "Ketentuan &\nManfaat di\n ", 0, 'C', true);
            $y2 = $this->GetY();
            $yH = $y2 - $y1;

            $this->SetXY($x1 + ($this->pg_w-($this->num_space*2))*3/25, $y2 - $yH);

            // jika produknya JS Index Plan Assurance
            if ($kd_produk == 'JSIPA') {
                $x1 = $this->GetX();
                $y1 = $this->GetY();
                $this->MultiCell(($this->pg_w-($this->num_space*2))*4/25, 5, "Uang\nAsuransi\nKecelakaan", 0, 'C', true);
                $y2 = $this->GetY();
                $yH = $y2 - $y1;

                $this->SetXY($x1 + ($this->pg_w-($this->num_space*2))*4/25, $y2 - $yH);
            } else {
                $this->Cell(($this->pg_w-($this->num_space*2))*4/25, $height*3, "Uang Asuransi", 0, 0, 'C', true);
            }

            $x1 = $this->GetX();
            $y1 = $this->GetY();
            $this->MultiCell(($this->pg_w-($this->num_space*2))*4/25, 5, "Mulai\nAsuransi\n ", 0, 'C', true);
            $y2 = $this->GetY();
            $yH = $y2 - $y1;

            $this->SetXY($x1 + ($this->pg_w-($this->num_space*2))*4/25, $y2 - $yH);

            $x1 = $this->GetX();
            $y1 = $this->GetY();
            $this->MultiCell(($this->pg_w-($this->num_space*2))*4/25, 5, "Akhir\nPembayaran\nPremi", 0, 'C', true);
            $y2 = $this->GetY();
            $yH = $y2 - $y1;

            $this->SetXY($x1 + ($this->pg_w-($this->num_space*2))*4/25, $y2 - $yH);

            $this->MultiCell(($this->pg_w-($this->num_space*2))*3/25, 5, "Akhir\nAsuransi\n ", 0, 'C', true);

            $this->SetXY($x, $y + $height*2);

            $this->Ln(8);


            $this->SetFont('Arial','B',9);
            $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
            $this->Cell(($this->pg_w-($this->num_space*2)), $height, "ASURANSI DASAR", 0, 1, 'L');
            $this->Ln(1);
            //
            $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
            $this->SetFont('Arial','',7);

            $x1 = $this->GetX();
            $y1 = $this->GetY();
            $this->MultiCell(($this->pg_w-($this->num_space*2))*7/25, 4, $arr["NAMAPRODUK"], 0, 'L');
            $y2 = $this->GetY();
            $yH = $y2 - $y1;

            $this->SetXY($x1 + ($this->pg_w-($this->num_space*2))*7/25, $y2 - $yH);

            $y = $this->GetY();
            $h = $y2 == $this->GetY ? 4 : $y2 - $y;
            $x1 = $this->GetX();
            $y1 = $this->GetY();
            $this->MultiCell(($this->pg_w-($this->num_space*2))*3/25, $h, "SUP\nKK", 0, 'C');
            $y2 = $this->GetY();
            $yH = $y2 - $y1;

            $this->SetXY($x1 + ($this->pg_w-($this->num_space*2))*3/25, $y2 - $yH);

            $this->Cell(($this->pg_w-($this->num_space*2))*4/25, $h*2, number_format($kd_produk=='JSIPA' ? $arr["PREMI1"] : $arr["JUAMAINPRODUK"], 2, ",", "."), 0, 0, 'R');
            $this->Cell(($this->pg_w-($this->num_space*2))*4/25, $h*2, $tgl_mulas, 0, 0, 'C');

            if($arr["NAMACARABAYAR"]<>'SEKALIGUS' || in_array(substr($arr['KDPRODUK'], 0, 5), array('JSPNS'))){
                $this->Cell(($this->pg_w-($this->num_space*2))*4/25, $h*2, $tgl_expirasi_p, 0, 0, 'C');
            } else if (in_array($kd_produk, array('JSAA', 'JSHAA'))) {
                $this->Cell(($this->pg_w-($this->num_space*2))*4/25, $h*2, "-", 0, 0, 'C');
            } else {
                $this->Cell(($this->pg_w-($this->num_space*2))*4/25, $h*2, $tgl_mulas, 0, 0, 'C');
            }

            if (in_array($kd_produk, array('JSHAA'))) {
                $this->Cell(($this->pg_w-($this->num_space*2))*3/25, $h*2, "-", 0, 1, 'C');
            } else {
                $this->Cell(($this->pg_w-($this->num_space*2))*3/25, $h*2, $arr["EXPIRASI"], 0, 1, 'C');
            }

            $xmulas = $tgl_mulas;
            $this->Ln(5);


            $this->SetFont('Arial','B',9);
            if (!empty($this->art)) {
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                $this->Cell(($this->pg_w-($this->num_space*2)), $height, "Asuransi Tambahan", 0, 1, 'L');
                $this->Ln(1);

                $this->SetFont('Arial','',7);
                foreach($this->art as $i => $value) {
                    if (in_array($kd_produk, array('JSR1', 'JSR2', 'JSR3', 'JSR4')) && $value['KDBNFX'] == 'JSHCPS500I')
                        continue;

                    $kdbnfx = "KK ".$value['KDBNFX'];
                    $mulas = $tgl_mulas;
                    $akhirasuransi = in_array($kd_produk, array('JSR1', 'JSR2', 'JSR3', 'JSR4')) ? $value['EXP'] : $value['TGLAKHIRPREMI'];

                    $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');

                    $x1 = $this->GetX();
                    $y1 = $this->GetY();
                    $this->MultiCell(($this->pg_w-($this->num_space*2))*7/25, 4, trim($value["NAMABENEFIT"]), 0, 'L');
                    $y2 = $this->GetY();
                    $yH = $y2 - $y1;

                    $this->SetXY($x1 + ($this->pg_w-($this->num_space*2))*7/25, $y2 - $yH);

                    $y = $this->GetY();
                    $h = $y2 == $this->GetY ? 4 : $y2 - $y;
                    $this->Cell(($this->pg_w-($this->num_space*2))*3/25, $h, trim($kdbnfx), 0, 0, 'L');
                    $this->Cell(($this->pg_w-($this->num_space*2))*4/25, $h, number_format($value["NILAIBENEFIT"], 2, ",", "."), 0, 0, 'R');
                    $this->Cell(($this->pg_w-($this->num_space*2))*4/25, $h, $mulas, 0, 0, 'C');
                    $this->Cell(($this->pg_w-($this->num_space*2))*3/25, $h, $value["EXP"], 0, 0, 'R');
                    $this->Cell(($this->pg_w-($this->num_space*2))*4/25, $h, $akhirasuransi, 0, 1, 'R');
                    $this->Ln(1);
                }
            }
        }

        public function KetentuanPolis() {
            $this->AddPage();

            $height = $this->height;
            $no_h	= 1;
            $data	= array();

            $this->font_title('B');
            $this->Cell($this->pg_w, $height, 'KETENTUAN - KETENTUAN KHUSUS', 0, 1, 'C');
            $this->Cell($this->pg_w, $height, "POLIS NOMOR : $this->prefix - $this->nopertanggungan", 0, 0, 'C');

            $this->Ln(10);

            /*===== ketentuan sebelum nilai tebus =====*/
            // cek redaksi jika kdparagraph null atau = T, maka TOP
            foreach($this->arrk as $i => $value) {
                if (!$value['KDPARAGRAPH'] || $value['KDPARAGRAPH'] == 'T') {
                    $judul = str_replace("{N_NMPRODUK}", $this->arr['NAMAPRODUK'], $value['JUDUL']);
                    $text  = preg_replace('/[\\\\\r\n]/', '', $value["TEKS"]);
                    $text  = str_replace("{NEWLINE}", "\n", $text);
                    $text  = str_replace("{N_JUA}", number_format($this->arrp['JUA'], 2, ",", "."), $text);
                    $text  = str_replace("{L_JUATERBILANG}", $this->arrp['JUATERBILANG'], $text);
                    $text  = str_replace("{T_MULAS}", $this->arrp['MULAS'], $text);
                    $text  = str_replace("{T_MULAS_1YEAR}", $this->arrp['MULAS_1YEAR'], $text);
                    $text  = str_replace("{B_MULAS}", $this->arrp['MULAS'], $text);
                    $text  = str_replace("{T_EXPIRASI}", $this->arrp['EXPIRASI'], $text);
                    $text  = str_replace("{T_EXPIRASI_MINONEMONTH}", $this->arrp['EXPIRASIMIN1MONTH'], $text);
                    $text  = str_replace("{B_EXPIRASI}", substr($this->arrp['EXPIRASI'], 3), $text);
                    $text  = str_replace("{N_PREMI1}", number_format($this->arrp['PREMI1'], 2, ",", "."), $text);
                    $text  = str_replace("{N_PREMI2}", number_format($this->arrp['PREMI2'], 2, ",", "."), $text);
                    $text  = str_replace("{N_MASA}", $this->arrp['PT'], $text);
                    $text  = str_replace("{N_USIA}", $this->arrp['USIA_TH'], $text);
                    $text  = str_replace("{N_KDPRODUK}", $this->arrp['KDPRODUK'], $text);
                    $text  = str_replace("{N_NMPRODUK}", $this->arr['NAMAPRODUK'], $text);
                    $text  = str_replace("{N_KDVALUTA}", $this->arrp['KDVALUTA'], $text);
                    $text  = str_replace("{N_NOTASI}", $this->arrp['NOTASI'], $text);
                    $text  = str_replace("{N_CARABAYAR}", $this->arrp['KDCARABAYAR'], $text);
                    $text  = str_replace("{N_DM0PROSEN}", $this->arrp['DM0PROSEN'], $text);
                    $text  = str_replace("{T_AKHPRM}", $this->arrp['TGLAKHIRPREMI'], $text);
                    //$text  = str_replace("{T_AKHPRM}", substr($this->arrp['TGLAKHIRPREMI'], 3), $text);
                    $text  = str_replace("{T_LAMAPEMBPREMI_TH}", $this->arr["LAMAPEMBPREMI_TH"], $text);

                    // Custom variabel untuk produk JSIPA
                    $text  = str_replace("{N_20UAKJSIPA}", number_format($this->arrp['PREMI1'] * 20 / 100, 2, ",", "."), $text);
                    $text  = str_replace("{N_JUABKKJSIPA}", number_format($this->arrp['PREMI1'] <= 950000000 ? 20000000 : ($this->arrp['PREMI1'] >= 1000000000 && $this->arrp['PREMI1'] <= 2950000000 ? 50000000 : 100000000) , 2, ",", "."), $text);
                    $text  = str_replace("{N_NTEXIPA}", number_format($this->arrp['PREMI1'] + ($this->arrp['PREMI1'] * 7 / 100), 2, ",", "."), $text);
                    $text  = str_replace("{N_NTSEXIPA}", number_format($this->arrp['PREMI1'] - ($this->arrp['PREMI1'] * 7.5 / 100), 2, ",", "."), $text);

                    // used for unit-linked
                    if ($this->arrp['KDCARABAYAR'] == '1' || $this->arrp['KDCARABAYAR'] == 'M') {
                        $text = str_replace("{N_NMCB}", "PREMI BULANAN", $text);
                        if (substr($this->arrp['KDPRODUK'], 0, 3) == 'JL2') {
                            $text = str_replace("{N_FAKTL1}", "25 X", $text);
                            $text = str_replace("{N_FAKTL65}", "20 X", $text);
                        }
                        else {
                            $text = str_replace("{N_FAKTL1}", "25 X", $text);
                            $text = str_replace("{N_FAKTL65}", "5 X", $text);
                        }
                    }
                    else if ($this->arrp['KDCARABAYAR'] == '2' || $this->arrp['KDCARABAYAR'] == 'Q') {
                        $text = str_replace("{N_NMCB}", "PREMI KUARTALAN", $text);
                        if (substr($this->arrp['KDPRODUK'], 0, 3) == 'JL2') {
                            $text = str_replace("{N_FAKTL1}", "8 X", $text);
                            $text = str_replace("{N_FAKTL65}", "7 X", $text);
                        }
                        else {
                            $text = str_replace("{N_FAKTL1}", "15 X", $text);
                            $text = str_replace("{N_FAKTL65}", "3 X", $text);
                        }
                    }
                    else if ($this->arrp['KDCARABAYAR'] == '3' || $this->arrp['KDCARABAYAR'] == 'H') {
                        $text = str_replace("{N_NMCB}", "PREMI SEMESTERAN", $text);
                        if (substr($this->arrp['KDPRODUK'], 0, 3) == 'JL2') {
                            $text = str_replace("{N_FAKTL1}", "4 X", $text);
                            $text = str_replace("{N_FAKTL65}", "4 X", $text);
                        }
                        else {
                            $text = str_replace("{N_FAKTL1}", "10 X", $text);
                            $text = str_replace("{N_FAKTL65}", "2 X", $text);
                        }
                    }
                    else if ($this->arrp['KDCARABAYAR'] == '4' || $this->arrp['KDCARABAYAR'] == 'A' || $this->arrp['KDCARABAYAR'] == 'E' || $this->arrp['KDCARABAYAR'] == 'J') {
                        $text = str_replace("{N_NMCB}", "PREMI TAHUNAN", $text);
                        if (substr($this->arrp['KDPRODUK'], 0, 3) == 'JL2') {
                            $text = str_replace("{N_FAKTL1}", "2 X", $text);
                            $text = str_replace("{N_FAKTL65}", "2 X", $text);
                        }
                        else {
                            $text = str_replace("{N_FAKTL1}", "5 X", $text);
                            $text = str_replace("{N_FAKTL65}", "1 X", $text);
                        }
                    }
                    else {
                        $text = str_replace("{N_NMCB}", "PREMI SEKALIGUS", $text);
                        if (substr($this->arrp['KDPRODUK'], 0, 3) == 'JL2') {
                            $text = str_replace("{N_FAKTL1}", "130% X", $text);
                            $text = str_replace("{N_FAKTL65}", "50% X", $text);
                        }
                        else {
                            $text = str_replace("{N_FAKTL1}", "125% X", $text);
                            $text = str_replace("{N_FAKTL65}", "10% X", $text);
                        }
                    }

                    foreach($this->arrp2 as $i => $value2) {
                        $expirasi = empty($value2['EXPIRASI']) || strlen($value2['EXPIRASI']) <= 0 ? '01/01/1900' : $value2['EXPIRASI'];
                        $text = str_replace("{N_".$value2['KDBENEFIT']."}", number_format($value2['NILAIBENEFIT'], 2, ",", "."), $text);
                        $text = str_replace("{T_".$value2['KDBENEFIT']."}", $expirasi, $text);
                        $text = str_replace("{B_".$value2['KDBENEFIT']."}", $value2['EXPIRASIB'], $text);
                        $text = str_replace("{A_".$value2['KDBENEFIT']."}", $value2['AKHIRPMB'], $text);
                    }

                    $this->font_body('B');

                    // header text
                    if (strpos($judul, "/}") !== false) {
                        $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');

                        $no = str_replace("/}", NULL, str_replace("{NUMBER=", NULL, substr($judul, 0, strpos($judul, "/}")+2)));
                        $this->Cell(6, $height, $no, 0, 0, 'L');

                        $judul = substr($judul, strpos($judul, "/}")+2);
                        if (strpos($judul, "{STYLE=") !== false) {
                            $this->font_body(str_replace("/}", NULL, str_replace("{STYLE=", NULL, substr($judul, 0, strpos($judul, "/}")+2))));
                            $judul = substr($judul, strpos($judul, "/}")+2);
                        }
                        $this->MultiCell($this->pg_w-($this->num_space*2)-6, 5, $judul, 0, 'J');
                    }
                    else {
                        $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                        $this->MultiCell($this->pg_w-($this->num_space*2), 5, $judul, 0, 'J');
                    }

                    // $addpage true jika {ADDPAGE} ditemukan
                    if (strpos($text, "{ADDPAGE}") !== false) {
                        $addpage = true;
                        $text = str_replace("{ADDPAGE}", "", $text);
                    }
                    else {
                        $addpage = false;
                    }

                    // untuk menghapus produk js prestasi tahapan beasiswa yang 0
                    /*=== catatan harus sama = ", sebesar Rp.0,00" tanpa tanda kutip ===*/
                    $tahapan0 = strpos($text, ', sebesar Rp.0,00');
                    if ($tahapan0 > 0) {
                        $replace_tahapan = substr($text, $tahapan0-30, 47);
                        $text = str_replace($replace_tahapan, '', $text);
                    }

                    // untuk indentation
                    $text = str_replace("{TAB}", "    ", $text);

                    // detail text
                    $this->SetFont('Arial','',9);
                    if (!empty($text)) {
                        $arr_text = explode("{INDENT", $text);
                        foreach($arr_text as $j => $v) {
                            if (strpos($v, '/}') !== false && !empty($v)) {
                                $indent = substr($v, 0, strpos($v, '='));
                                $no = substr($v, 2, strpos($v, '/}') - 2);
                                $val = substr($v, strpos($v, "/}")+2);

                                switch($indent) {
                                    case 0:
                                        $nospace = 6;
                                        $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                                        $this->Cell($nospace, $height, $no, 0, 0, 'L');
                                        break;
                                    case 1:
                                        $indentspace = 6;
                                        $nospace = 6;
                                        $this->Cell($this->num_space+$indentspace, $height, NULL, 0, 0, 'C');
                                        $this->Cell($nospace, $height, $no, 0, 0, 'L');
                                        //$val = str_replace('{/INDENT1}','',substr($v, strpos($v, "/}")+2));
                                        break;
                                    case 2:
                                        $indentspace = 12;
                                        $nospace = 6;
                                        $this->Cell($this->num_space+$indentspace, $height, NULL, 0, 0, 'C');
                                        $this->Cell($nospace, $height, $no, 0, 0, 'L');
                                        //$val = str_replace('{/INDENT2}','',substr($v, strpos($v, "/}")+2));
                                        break;
                                    case 3:
                                        $indentspace = 18;
                                        $nospace = 9;
                                        $this->Cell($this->num_space+$indentspace, $height, NULL, 0, 0, 'C');
                                        $this->Cell($nospace, $height, $no, 0, 0, 'L');
                                        //$val = str_replace('{/INDENT3}','',substr($v, strpos($v, "/}")+2));
                                        break;
                                }

                                $this->MultiCell($this->pg_w-($this->num_space*2+$nospace)-$indentspace, 5, $val, 0, 'J');
                            }
                            else if (!empty($v)) {
                                $val = str_replace("}", NULL, $v);
                                $this->Cell($this->num_space+6, $height, NULL, 0, 0, 'C');
                                $this->MultiCell($this->pg_w-($this->num_space*2+5), 5, $val, 0, 'J');
                            }
                        }
                        $no_h++;
                    }

                    // addpage jika $addpage = true
                    if ($addpage) {
                        $this->AddPage();
                        $this->font_title('B');
                        $this->Cell($this->pg_w, $height, 'KETENTUAN - KETENTUAN KHUSUS', 0, 1, 'C');
                        $this->Cell($this->pg_w, $height, "POLIS NOMOR : $this->prefix - $this->nopertanggungan", 0, 0, 'C');

                        $this->Ln(10);
                    }

                    $this->Ln(2);
                }
            }

            /** perhitungan nilai tebus **/
            $this->CreateTableTitle();
            $this->arrt['LPP'] = $this->nopertanggungan == '001457864' ? 9 : $this->arrt['LPP'];

            // buat array baru untuk menampung data tebus menjadi dua tabel
            $j	   = 0;
            $lst_t = end($this->arrt2);
            //$count = count($this->arrt2) <= $this->arrt['LPP'] || $lst_t['T'] == $this->arrt['LPP'] ? count($this->arrt2) : $this->arrt['LPP'];
            $count = count($this->arrt2) <= $this->arrt['LPP'] || $lst_t['T'] == $this->arrt['LPP'] || $lst_t['T'] == count($this->arrt2) ? count($this->arrt2) : $this->arrt['LPP'];
            $k	   = $count%2 == 1 ? $count/2+0.5 : $count/2;
            $data  = array();
            foreach($this->arrt2 as $i => $value) {
                if ($i < $k && $this->arr['KDPRODUK'] != 'JSKEL') {
                    if (in_array($this->arrt['KDPRODUK'], array("JSSPO1","JSSPO2","JSSPO7A","JSSPO8","JSSPO9","JSKPD"))) {
                        $data[$i]['NO']	   = $value['T'];
                        $data[$i]['NILAI'] = round(0.001 * ($value['TARIF'] * $this->arrt['JUA'] + $value['TARIFS'] * $this->arrt['JUABP']), -3);
                    }
                    else if ($this->arrt['KDPRODUK'] == "JSPEIPN" || $this->arrt['KDPRODUK'] == "JSPEIP" || $this->arrt['KDPRODUK'] == "JSPEI5") {
                        $data[$i]['NO']	   = $value['T'];
                        $data[$i]['NILAI'] = round(0.001 * $value['TARIF'] * $this->arrt['PREMI1']);
                    }
                    else if (in_array($this->arrt['KDPRODUK'],array('JSPNS','JSPNSB','JSPNSK'))) {
                        $data[$i]['NO']	   = $value['T'];
                        $data[$i]['NILAI'] = 1000*round(0.00001 * ($value['TARIF'] * $this->arrt['JUA'] + $value['TARIFS'] * $this->arrt['JUABP']));
                    }
                    else {
                        $data[$i]['NO']	   = $value['T'];
                        $data[$i]['NILAI'] = round(0.001*($value['TARIF'] * $this->arrt['JUA'] + $value['TARIFS'] * $this->arrt['JUABP']));
                    }

                    if ($this->flag_dst) {
                        $data[$i]['NO2']	= "..";
                        $data[$i]['NILAI2'] = "DAN SETERUSNYA...";
                    }
                    else {
                        $data[$i]['NO2']	= NULL;
                        $data[$i]['NILAI2'] = NULL;
                    }
                }
                else if ($this->arr['KDPRODUK'] != 'JSKEL') {
                    if (in_array($this->arrt['KDPRODUK'], array("JSSPO1","JSSPO2","JSSPO7A","JSSPO8","JSSPO9","JSKPD"))) {
                        $data[$j]['NO2']	   = $value['T'];
                        //$data[$j]['NILAI2'] = round(0.001 * ($value['TARIF'] * $this->arrt['JUA'] + $value['TARIFS'] * $this->arrt['JUABP']), -3);
                        $data[$j]['NILAI2'] = 1000*floor(0.000001 * $value['TARIF'] * $this->arrt['JUA'] + $value['TARIFS'] * $this->arrt['JUABP']);
                    }
                    else if ($this->arrt['KDPRODUK'] == "JSPEIPN" || $this->arrt['KDPRODUK'] == "JSPEIP" || $this->arrt['KDPRODUK'] == "JSPEI5") {
                        $data[$j]['NO2']	= $value['T'];
                        $data[$j]['NILAI2'] = round(0.001 * $value['TARIF'] * $this->arrt['PREMI1']);
                    }
                    else if (in_array($this->arrt['KDPRODUK'],array('JSPNS','JSPNSB','JSPNSK'))) {
                        $data[$j]['NO2']	= $value['T'];
                        $data[$j]['NILAI2'] = 1000*round(0.00001 * ($value['TARIF'] * $this->arrt['JUA'] + $value['TARIFS'] * $this->arrt['JUABP']));
                    }
                    else {
                        $data[$j]['NO2']	= $value['T'];
                        $data[$j]['NILAI2'] = round(0.001*($value['TARIF'] * $this->arrt['JUA'] + $value['TARIFS'] * $this->arrt['JUABP']));
                    }
                    $j++;
                }
            }

            // tampilkan detail ke pdf
            $val_dst = "DAN SETERUSNYA...";
            $cek = 0;
            $title = false;
            foreach($data as $i => $value) {
                if ($i < $k) {
                    if ($title) {
                        $this->Ln(30);
                        $this->CreateTableTitle();
                        $title = false;
                    }

                    $nilai2 = empty($value['NILAI2']) ? NULL 
							: ($this->flag_dst && $value['NILAI2'] == $val_dst['NILAI2'] 
							? $value['NILAI2'] 
							: number_format($value['NILAI2'], 2, ",", "."));
                    $no2 = empty($nilai2) ? NULL : $value['NO2'];

                    $this->Cell(25, 5, NULL, 0, 0, 'L');
                    $this->Cell(140/6, 5, $value['NO'], 'LR', 0, 'C');
                    $this->Cell(140/3, 5, number_format($value['NILAI'], 2, ",", "."), 'LR', 0, 'R');
                    $this->Cell(140/6, 5, $no2, 'LR', 0, 'C');
                    $this->Cell(140/3, 5, $nilai2, 'LR', 0, 'R');
                    $this->Cell(25, 5, NULL, 0, 1, 'L');
                    $cek = 1;

                    if ($this->GetY() > $this->pg_h_b) {
                        $this->Cell(25, 5, NULL, 0, 0, 'L');
                        $this->Cell(140, 0, NULL, 1, 0, 'L');
                        $title = true;
                        $this->AddPage();
                        $this->font_title('B');
                        $this->Cell($this->pg_w, $height, 'KETENTUAN - KETENTUAN KHUSUS', 0, 1, 'C');
                        $this->Cell($this->pg_w, $height, "POLIS NOMOR : $this->prefix - $this->nopertanggungan", 0, 0, 'C');
                        $this->SetFont('Arial','',9);
                        $this->Ln(-18);
                    }
                }
            }

            if ($cek) {
                $this->Cell(25, 5, NULL, 0, 0, 'L');
                $this->Cell(140, 0, NULL, 1, 0, 'L');
            }
            /** akhir dari perhitungan nilai tebus **/

            $this->Ln(5);


            /*==== ketentuan setelah nilai tebus =====*/
            // cek redaksi jika kdparagraph = M, maka MIDDLE
            foreach($this->arrk as $i => $value) {
                if ($value['KDPARAGRAPH'] == 'M') {
                    $judul = str_replace("{N_NMPRODUK}", $this->arr['NAMAPRODUK'], $value['JUDUL']);
                    $text  = preg_replace('/[\\\\\r\n]/', '', $value["TEKS"]);
                    $text  = str_replace("{NEWLINE}", "\n", $text);
                    $text  = str_replace("{N_JUA}", number_format($this->arrp['JUA'], 2, ",", "."), $text);
                    $text  = str_replace("{L_JUATERBILANG}", $this->arrp['JUATERBILANG'], $text);
                    $text  = str_replace("{T_MULAS}", $this->arrp['MULAS'], $text);
                    $text  = str_replace("{T_MULAS_1YEAR}", $this->arrp['MULAS_1YEAR'], $text);
                    $text  = str_replace("{B_MULAS}", $this->arrp['MULAS'], $text);
                    $text  = str_replace("{T_EXPIRASI}", $this->arrp['EXPIRASI'], $text);
                    $text  = str_replace("{T_EXPIRASI_MINONEMONTH}", $this->arrp['EXPIRASIMIN1MONTH'], $text);
                    $text  = str_replace("{B_EXPIRASI}", substr($this->arrp['EXPIRASI'], 3), $text);
                    $text  = str_replace("{N_PREMI1}", number_format($this->arrp['PREMI1'], 2, ",", "."), $text);
                    $text  = str_replace("{N_PREMI2}", number_format($this->arrp['PREMI2'], 2, ",", "."), $text);
                    $text  = str_replace("{N_MASA}", $this->arrp['PT'], $text);
                    $text  = str_replace("{N_USIA}", $this->arrp['USIA_TH'], $text);
                    $text  = str_replace("{N_KDPRODUK}", $this->arrp['KDPRODUK'], $text);
                    $text  = str_replace("{N_NMPRODUK}", $this->arr['NAMAPRODUK'], $text);
                    $text  = str_replace("{N_KDVALUTA}", $this->arrp['KDVALUTA'], $text);
                    $text  = str_replace("{N_NOTASI}", $this->arrp['NOTASI'], $text);
                    $text  = str_replace("{N_CARABAYAR}", $this->arrp['KDCARABAYAR'], $text);
                    $text  = str_replace("{N_DM0PROSEN}", $this->arrp['DM0PROSEN'], $text);
                    $text  = str_replace("{T_AKHPRM}", $this->arrp['TGLAKHIRPREMI'], $text);
                    $text  = str_replace("{T_AKHPRM}", substr($this->arrp['TGLAKHIRPREMI'], 3), $text);
                    $text  = str_replace("{T_LAMAPEMBPREMI_TH}", $this->arr["LAMAPEMBPREMI_TH"], $text);

                    // used for unit-linked
                    if ($this->arrp['KDCARABAYAR'] == '1' || $this->arrp['KDCARABAYAR'] == 'M') {
                        $text = str_replace("{N_NMCB}", "PREMI BULANAN", $text);
                        if (substr($this->arrp['KDPRODUK'], 0, 3) == 'JL2') {
                            $text = str_replace("{N_FAKTL1}", "25 X", $text);
                            $text = str_replace("{N_FAKTL65}", "20 X", $text);
                        }
                        else {
                            $text = str_replace("{N_FAKTL1}", "25 X", $text);
                            $text = str_replace("{N_FAKTL65}", "5 X", $text);
                        }
                    }
                    else if ($this->arrp['KDCARABAYAR'] == '2' || $this->arrp['KDCARABAYAR'] == 'Q') {
                        $text = str_replace("{N_NMCB}", "PREMI KUARTALAN", $text);
                        if (substr($this->arrp['KDPRODUK'], 0, 3) == 'JL2') {
                            $text = str_replace("{N_FAKTL1}", "8 X", $text);
                            $text = str_replace("{N_FAKTL65}", "7 X", $text);
                        }
                        else {
                            $text = str_replace("{N_FAKTL1}", "15 X", $text);
                            $text = str_replace("{N_FAKTL65}", "3 X", $text);
                        }
                    }
                    else if ($this->arrp['KDCARABAYAR'] == '3' || $this->arrp['KDCARABAYAR'] == 'H') {
                        $text = str_replace("{N_NMCB}", "PREMI SEMESTERAN", $text);
                        if (substr($this->arrp['KDPRODUK'], 0, 3) == 'JL2') {
                            $text = str_replace("{N_FAKTL1}", "4 X", $text);
                            $text = str_replace("{N_FAKTL65}", "4 X", $text);
                        }
                        else {
                            $text = str_replace("{N_FAKTL1}", "10 X", $text);
                            $text = str_replace("{N_FAKTL65}", "2 X", $text);
                        }
                    }
                    else if ($this->arrp['KDCARABAYAR'] == '4' || $this->arrp['KDCARABAYAR'] == 'A' || $this->arrp['KDCARABAYAR'] == 'E' || $this->arrp['KDCARABAYAR'] == 'J') {
                        $text = str_replace("{N_NMCB}", "PREMI TAHUNAN", $text);
                        if (substr($this->arrp['KDPRODUK'], 0, 3) == 'JL2') {
                            $text = str_replace("{N_FAKTL1}", "2 X", $text);
                            $text = str_replace("{N_FAKTL65}", "2 X", $text);
                        }
                        else {
                            $text = str_replace("{N_FAKTL1}", "5 X", $text);
                            $text = str_replace("{N_FAKTL65}", "1 X", $text);
                        }
                    }
                    else {
                        $text = str_replace("{N_NMCB}", "PREMI SEKALIGUS", $text);
                        if (substr($this->arrp['KDPRODUK'], 0, 3) == 'JL2') {
                            $text = str_replace("{N_FAKTL1}", "130% X", $text);
                            $text = str_replace("{N_FAKTL65}", "50% X", $text);
                        }
                        else {
                            $text = str_replace("{N_FAKTL1}", "125% X", $text);
                            $text = str_replace("{N_FAKTL65}", "10% X", $text);
                        }
                    }

                    foreach($this->arrp2 as $i => $value2) {
                        $text = str_replace("{N_".$value2['KDBENEFIT']."}", number_format($value2['NILAIBENEFIT'], 2, ",", "."), $text);
                        $text = str_replace("{T_".$value2['KDBENEFIT']."}", $value2['EXPIRASI'], $text);
                        $text = str_replace("{B_".$value2['KDBENEFIT']."}", $value2['EXPIRASIB'], $text);
                        $text = str_replace("{A_".$value2['KDBENEFIT']."}", $value2['AKHIRPMB'], $text);
                    }

                    $this->font_body('B');

                    // header text
                    if (strpos($judul, "/}") !== false) {
                        $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');

                        $no = str_replace("/}", NULL, str_replace("{NUMBER=", NULL, substr($judul, 0, strpos($judul, "/}")+2)));
                        $this->Cell(6, $height, $no, 0, 0, 'L');

                        $judul = substr($judul, strpos($judul, "/}")+2);
                        if (strpos($judul, "{STYLE=") !== false) {
                            $this->font_body(str_replace("/}", NULL, str_replace("{STYLE=", NULL, substr($judul, 0, strpos($judul, "/}")+2))));
                            $judul = substr($judul, strpos($judul, "/}")+2);
                        }
                        $this->MultiCell($this->pg_w-($this->num_space*2)-6, 5, $judul, 0, 'J');
                    }
                    else {
                        $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                        $this->MultiCell($this->pg_w-($this->num_space*2), 5, $judul, 0, 'J');
                    }

                    // $addpage true jika {ADDPAGE} ditemukan
                    if (strpos($text, "{ADDPAGE}") !== false) {
                        $addpage = true;
                        $text = str_replace("{ADDPAGE}", "", $text);
                    }
                    else {
                        $addpage = false;
                    }

                    // untuk menghapus produk js prestasi tahapan beasiswa yang 0
                    /*=== catatan harus sama = ", sebesar Rp.0,00" tanpa tanda kutip ===*/
                    $tahapan0 = strpos($text, ', sebesar Rp.0,00');
                    if ($tahapan0 > 0) {
                        $replace_tahapan = substr($text, $tahapan0-30, 47);
                        $text = str_replace($replace_tahapan, '', $text);
                    }

                    // untuk indentation
                    $text = str_replace("{TAB}", "    ", $text);

                    // detail text
                    $this->SetFont('Arial','',9);
                    if (!empty($text)) {
                        $arr_text = explode("{INDENT", $text);
                        foreach($arr_text as $j => $v) {
                            if (strpos($v, '/}') !== false && !empty($v)) {
                                $indent = substr($v, 0, strpos($v, '='));
                                $no = substr($v, 2, strpos($v, '/}') - 2);
                                $val = substr($v, strpos($v, "/}")+2);

                                switch($indent) {
                                    case 0:
                                        $nospace = 6;
                                        $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                                        $this->Cell($nospace, $height, $no, 0, 0, 'L');
                                        break;
                                    case 1:
                                        $indentspace = 6;
                                        $nospace = 6;
                                        $this->Cell($this->num_space+$indentspace, $height, NULL, 0, 0, 'C');
                                        $this->Cell($nospace, $height, $no, 0, 0, 'L');
                                        //$val = str_replace('{/INDENT1}','',substr($v, strpos($v, "/}")+2));
                                        break;
                                    case 2:
                                        $indentspace = 12;
                                        $nospace = 6;
                                        $this->Cell($this->num_space+$indentspace, $height, NULL, 0, 0, 'C');
                                        $this->Cell($nospace, $height, $no, 0, 0, 'L');
                                        //$val = str_replace('{/INDENT2}','',substr($v, strpos($v, "/}")+2));
                                        break;
                                    case 3:
                                        $indentspace = 18;
                                        $nospace = 9;
                                        $this->Cell($this->num_space+$indentspace, $height, NULL, 0, 0, 'C');
                                        $this->Cell($nospace, $height, $no, 0, 0, 'L');
                                        //$val = str_replace('{/INDENT3}','',substr($v, strpos($v, "/}")+2));
                                        break;
                                }

                                $this->MultiCell($this->pg_w-($this->num_space*2+$nospace)-$indentspace, 5, $val, 0, 'J');
                            }
                            else if (!empty($v)) {
                                $val = str_replace("}", NULL, $v);
                                $this->Cell($this->num_space+6, $height, NULL, 0, 0, 'C');
                                $this->MultiCell($this->pg_w-($this->num_space*2+5), 5, $val, 0, 'J');
                            }
                        }
                    }

                    // addpage jika $addpage = true
                    if ($addpage) {
                        $this->AddPage();
                        $this->font_title('B');
                        $this->Cell($this->pg_w, $height, 'KETENTUAN - KETENTUAN KHUSUS', 0, 1, 'C');
                        $this->Cell($this->pg_w, $height, "POLIS NOMOR : $this->prefix - $this->nopertanggungan", 0, 0, 'C');

                        $this->Ln(10);
                    }

                    $this->Ln(2);
                    $no_h++;
                }
            }


            // jika valuta asing (US$)
            if ($this->arrt['KDVALUTA'] == '3') {
                $paragraph = "* SEGALA HAK DAN KEWAJIBAN BERUPA PEMBAYARAN SEJUMLAH UANG YANG TIMBUL DARI PERJANJIAN ASURANSI "
                    . "MENURUT POLIS INI DILAKUKAN DALAM MATA UANG RUPIAH BERDASARKAN NILAI TUKAR KURS TENGAH MATA UANG "
                    . "DOLLAR AMERIKA SERIKAT YANG DITETAPKAN OLEH BANK INDONESIA.";
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'L');
                $this->MultiCell($this->pg_w-($this->num_space*2+5), $height, $paragraph, 0, 'J');
                $this->Ln(2);
            }
            else if ($this->arrt['KDVALUTA'] == '0') {
                $no	   = $no_h == 1 ? 'I. '
                    : ($no_h == 2 ? 'II. '
                        : ($no_h == 3 ? 'III. '
                            : ($no_h == 4 ? 'IV. '
                                : ($no_h == 5 ? 'V. '
                                    : ($no_h == 6 ? 'VI. ' : $no_h)))));
                $judul = "PELAKSANAAN PEMBAYARAN HAK DAN KEWAJIBAN";
                $text  = "PELAKSANAAN PEMBAYARAN HAK DAN KEWAJIBAN AKAN SELALU DIKAITKAN DENGAN INDEKS ASURANSI JIWA PADA SAAT "
                    . "PEMBAYARAN. KECUALI APABILA POLIS TELAH BEBAS PREMI DALAM MASA PEMBAYARAN PREMI, MAKA PELAKSANAAN "
                    . "PEMBAYARAN HAK DAN KEWAJIBAN BERDASARKAN INDEKS YANG BERLAKU PADA SAAT POLIS DINYATAKAN BEBAS PREMI.";

                $this->font_body();
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                $this->Cell(5, $height, $no, 0, 0, 'L');
                $this->MultiCell($this->pg_w-($this->num_space*2)-5, 5, $judul, 0, 'J');
                $this->Ln(2);
                $this->SetFont('Arial','',9);
                $this->Cell($this->num_space+5, $height, NULL, 0, 0, 'C');
                $this->MultiCell($this->pg_w-($this->num_space*2+5), 5, $text, 0, 'J');
                $this->Ln(2);

                $no_h++;
            }

            //
            if ($this->arrt['KDPRODUK'] == 'JSAP1' || $this->arrt['KDPRODUK'] == 'JSAP2') {
                $paragraph = "PREMI PADA POLIS ADALAH PREMI POKOK, APABILA ADA TAMBAHAN JAMINAN TAMBAHAN, "
                    . "JUMLAH  DAN  RINCIAN  PREMI  TERCANTUM  DI  NOTICE  SEBAGAI LAMPIRAN POLIS.";
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'L');
                $this->MultiCell($this->pg_w-($this->num_space*2+5), $height, $paragraph, 0, 'J');
                $this->Ln(2);
            }

            // comment by salman 17/12/2015, sesuai request bu Liza
            /*
            if ($this->cash_plan > 0) {
                $no	   = $no_h == 1 ? 'I. '
                       : ($no_h == 2 ? 'II. '
                       : ($no_h == 3 ? 'III. '
                       : ($no_h == 4 ? 'IV. '
                       : ($no_h == 5 ? 'V. '
                       : ($no_h == 6 ? 'VI. ' : $no_h)))));
                $judul = "MANFAAT JAMINAN TAMBAHAN CASH PLAN DAN SYARAT-SYARAT JAMINAN TAMBAHAN "
                       . "CASH PLAN TERTUANG PADA LAMPIRAN JAMINAN TAMBAHAN CASH PLAN DAN SYARAT-SYARAT JAMINAN TAMBAHAN CASH PLAN.";

                $this->font_body();
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                $this->Cell(5, $height, $no, 0, 0, 'L');
                $this->MultiCell($this->pg_w-($this->num_space*2)-5, 5, $judul, 0, 'J');
                $this->Ln(2);

                $no_h++;
            }
            */

            // untuk klausula
            /*$this->AddPage();
            $no	   = $no_h == 1 ? 'I. '
                   : ($no_h == 2 ? 'II. '
                   : ($no_h == 3 ? 'III. '
                   : ($no_h == 4 ? 'IV. '
                   : ($no_h == 5 ? 'V. '
                   : ($no_h == 6 ? 'VI. '
                   : ($no_h == 7 ? 'VII. ' : $no_h))))));
            $judul = "KLAUSULA.";
            $text  = "PELAKSANAAN PEMBAYARAN HAK DAN KEWAJIBAN AKAN SELALU DIKAITKAN DENGAN INDEKS ASURANSI JIWA PADA SAAT "
                   . "PEMBAYARAN. KECUALI APABILA POLIS TELAH BEBAS PREMI DALAM MASA PEMBAYARAN PREMI, MAKA PELAKSANAAN "
                   . "PEMBAYARAN HAK DAN KEWAJIBAN BERDASARKAN INDEKS YANG BERLAKU PADA SAAT POLIS DINYATAKAN BEBAS PREMI.";
            $satu  = "APABILA TERDAPAT/TERJADI PERUBAHAN PADA MANFAAT, BIAYA, SYARAT DAN KETENTUAN UMUM POLIS, AKAN DIBERITAHUKAN "
                   . "KEPADA PEMEGANG POLIS PADA ALAMAT TERKINI PEMEGANG POLIS YANG TERCATAT PADA PENANGGUNG PALING LAMBAR 30 (TIGA "
                   . "PULUH) HARI KERJA SEJAK SEBELUM TERJADINYA PERUBAHAN.";
            $dua  = "PERJANJIAN INI TELAH DISESUAIKAN DENGAN KETENTUAN PERATURAN PERUNDANG-UNDANGAN TERMASUK PERATURAN OTORITAS JASA "
                   . "KEUANGAN.";

            $this->font_body('B');
            $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
            $this->Cell(5, $height, $no, 0, 0, 'L');
            $this->MultiCell($this->pg_w-($this->num_space*2)-5, 5, $judul, 0, 'J');
            $this->Ln(2);
            $this->SetFont('Arial','',9);
            $this->Cell($this->num_space+5, $height, NULL, 0, 0, 'C');
            $this->Cell(6, $height, '1.', 0, 0, 'L');
            $this->MultiCell($this->pg_w-($this->num_space*2+5)-6, 5, $satu, 0, 'J');
            $this->SetFont('Arial','',9);
            $this->Cell($this->num_space+5, $height, NULL, 0, 0, 'C');
            $this->Cell(6, $height, '2.', 0, 0, 'L');
            $this->MultiCell($this->pg_w-($this->num_space*2+5)-6, 5, $dua, 0, 'J');*/
        }

        public function AsuransiTambahan() {
            $this->AddPage();
            $this->Ln(10);

            $height = $this->height;

            $this->SetFont('Arial','',9);
            $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
            $this->MultiCell($this->pg_w-($this->num_space*2), 5, "Asuransi Tambahan dan Ketentuan Khusus yang tidak berlaku", 0, 'J');
            $this->Ln(2);

            $this->SetFont('Arial','B',9);
            $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
            $this->Cell(($this->pg_w-($this->num_space*2))*3/5, $height, "Asuransi Tambahan", 0, 0, 'L');
            $this->Cell(($this->pg_w-($this->num_space*2))*2/5, $height, "Ketentuan & Manfaat di", 0, 1, 'L');

            $this->SetFont('Arial','',9);
            foreach($this->arrat as $i => $value) {
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                $this->Cell(($this->pg_w-($this->num_space*2))*3/5, $height, $value['NAMABENEFIT'], 0, 0, 'L');
                $this->Cell(($this->pg_w-($this->num_space*2))*2/5, $height, $value['KDBENEFIT'], 0, 1, 'L');
            }
        }

        public function LampiranPolis() {
            $lampiranriderhospital = false;
            foreach ($this->art as $i => $v) {
                if (in_array($v['KDBNFX'], array('JSHCA', 'JSHCB', 'JSHCC', 'JSHCD', 'JSHCE'))) {
                    $lampiranriderhospital = true;
                    $namabenefit = $v['NAMABENEFIT'];
                }
            }

            if ($lampiranriderhospital) {
                $this->AddPage();

                $arr	= $this->arr;
                $height = $this->height;

                $this->font_title('B');
                $this->Cell($this->pg_w, $height, 'LAMPIRAN POLIS', 0, 1, 'C');
                $this->Cell($this->pg_w, $height, "NOMOR $this->prefix - $this->nopertanggungan", 0, 0, 'C');

                $this->Ln(13);

                $this->font_body('B');
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                $this->Cell(6, $height, "I.", 0, 0, 'L');
                $this->MultiCell($this->pg_w-($this->num_space*2)-6, 5, "MACAM ASURANSI TAMBAHAN : $namabenefit", 0, 'J');

                $this->Ln(2);

                $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                $this->Cell(6, $height, "II.", 0, 0, 'L');
                $this->MultiCell($this->pg_w-($this->num_space*2)-6, 5, "TERTANGGUNG", 0, 'J');

                $this->Ln(1);

                $this->font_body();
                $this->Cell($this->num_space+7, $height, NULL, 0, 0, 'C');
                $this->Cell(10, $height, "No", 1, 0, 'C');
                $this->Cell(38, $height, "No. Tertanggung", 1, 0, 'C');
                $this->Cell(93, $height, "Nama", 1, 0, 'C');
                $this->Cell(22, $height, "Tanggal lahir", 1, 1, 'C');

                foreach ($this->ars2 as $i => $v) {
                    $this->Cell($this->num_space+7, $height, NULL, 0, 0, 'C');
                    $this->Cell(10, $height, $i+1, 1, 0, 'C');
                    $this->Cell(38, $height, $v['NOID'], 1, 0, 'L');
                    $this->Cell(93, $height, $v['NAMAKLIEN1'], 1, 0, 'J');
                    $this->Cell(22, $height, $v['TGLLAHIR'], 1, 1, 'C');
                }

                $this->Ln(2);

                $this->font_body('B');
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                $this->Cell(6, $height, "III.", 0, 0, 'L');
                $this->MultiCell($this->pg_w-($this->num_space*2)-6, 5, "SANTUNAN RAWAT INAP", 0, 'J');

                $this->Ln(1);

                $this->font_body();
                $this->Cell($this->num_space+6, $height+3, NULL, 0, 0, 'C');
                $this->Cell($this->pg_w-($this->num_space*2)-6, $height+3, "A. Berlaku apabila menempati kamar sesuai hak kamar (plan)", 0, 1, 'L');

                $this->Cell($this->num_space+7, $height, NULL, 0, 0, 'C');
                $this->Cell(10, $height, "No", 1, 0, 'C');
                $this->Cell(118, $height, "Jenis Santunan", 1, 0, 'C');
                $this->Cell(35, $height, "Manfaat $this->kelasrs", 1, 1, 'C');

                foreach ($this->arri as $i => $v) {
                    if ($v['URUTAN'] == '1' && strlen($v['NAMA_KELAS']) == 0) {
                        $this->Cell($this->num_space+7, $height, NULL, 0, 0, 'C');
                        $this->Cell(10, $height, $i+1, 1, 0, 'C');
                        $this->Cell(118, $height, $v['NAMA_ITEM_BENEFIT'], 1, 0, 'L');
                        if ($v['NILAI_MANFAAT'] < 99999999999.99)
                            $this->Cell(35, $height, number_format($v['NILAI_MANFAAT'], 0, ',', '.'), 1, 1, 'R');
                        else
                            $this->Cell(35, $height, 'Sesuai Kuitansi', 1, 1, 'C');
                    } else if ($v['URUTAN'] == '1' && strlen($v['NAMA_KELAS']) > 0) {
                        $this->Cell($this->num_space+7, $height, NULL, 0, 0, 'C');
                        $this->Cell(10, $height, null, 1, 0, 'C');
                        $this->Cell(118, $height, "Batas Maksimum Penggantian per Tahun per Peserta", 1, 0, 'L');
                        $this->Cell(35, $height, number_format($v['NILAI_MANFAAT'], 0, ',', '.'), 1, 1, 'R');
                    }
                }

                $this->Ln(1);

                $this->font_body();
                $this->Cell($this->num_space+6, $height+3, NULL, 0, 0, 'C');
                $this->Cell($this->pg_w-($this->num_space*2)-6, $height+3, "B. Berlaku apabila menempati kamar melebihi hak kamar (plan)", 0, 1, 'L');

                $this->Cell($this->num_space+7, $height, NULL, 0, 0, 'C');
                $this->Cell(10, $height, "No", 1, 0, 'C');
                $this->Cell(118, $height, "Jenis Santunan", 1, 0, 'C');
                $this->Cell(35, $height, "Manfaat $this->kelasrs", 1, 1, 'C');

                foreach ($this->arri as $i => $v) {
                    if ($v['URUTAN'] == '2' && strlen($v['NAMA_KELAS']) == 0) {
                        $this->Cell($this->num_space+7, $height, NULL, 0, 0, 'C');
                        $this->Cell(10, $height, $i+1, 1, 0, 'C');
                        $this->Cell(118, $height, $v['NAMA_ITEM_BENEFIT'], 1, 0, 'L');
                        $this->Cell(35, $height, number_format($v['NILAI_MANFAAT'], 0, ',', '.'), 1, 1, 'R');
                    } else if ($v['URUTAN'] == '2' && strlen($v['NAMA_KELAS']) > 0) {
                        $this->Cell($this->num_space+7, $height, NULL, 0, 0, 'C');
                        $this->Cell(10, $height, null, 1, 0, 'C');
                        $this->Cell(118, $height, "Batas Maksimum Penggantian per Tahun per Peserta", 1, 0, 'L');
                        $this->Cell(35, $height, number_format($v['NILAI_MANFAAT'], 0, ',', '.'), 1, 1, 'R');
                    }
                }
				
				$this->AddPage();

                $this->font_body('B');
                $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
                $this->Cell(6, $height, "IV.", 0, 0, 'L');
                $this->MultiCell($this->pg_w-($this->num_space*2)-6, 5, "KETENTUAN NO CLAIM BONUS", 0, 'J');

                $this->Ln(1);

                $this->font_body();
                $this->Cell($this->num_space+6, $height, NULL, 0, 0, 'C');
                $this->MultiCell($this->pg_w-($this->num_space*2)-6, 5, "No Claim Bonus atau potongan premi (diskon) sebesar 3 (tiga) bulan premi diberikan kepada Pemegang Polis yang melakukan perpanjangan Asuransi Tambahan JS Hospital Care, dengan ketentuan apabila selama masa Asuransi Tambahan JS Hospital Care sebelumnya, Penanggung tidak pernah melakukan pembayaran klaim kepada Tertanggung. Besar manfaat No Claim Bonus yang menjadi hak Pemegang Polis adalah sebesar 3 (tiga) bulan premi dari premi Asuransi Tambahan JS Hospital Care dan akan dibayarkan sebagai pengembalian premi dengan ketentuan premi rider JS Hospital Care untuk tagihan berikutnya telah dibayar lunas.", 0, 'J');
            }
        }

        public function CreateTableTitle() {
            if ($this->arrt['KDPRODUK'] == "HTB" || $this->arrt['KDPRODUK'] == "HTK" || $this->arrt['KDPRODUK'] == "HTS" || $this->arrt['KDPRODUK'] == "HTT" && count($this->arrt2) > 0) {
                $this->Cell(25, 8, NULL, 0, 0, 'L');
                $x1 = $this->GetX();
                $y1 = $this->GetY();
                $this->MultiCell(140/6, 4, "AKHIR TAHUN KE", 1, 'C');
                $y2 = $this->GetY();
                $yH = $y2 - $y1;

                $this->SetXY($x1 + 140/6, $y2 - $yH);

                $this->Cell(140/3, 8, "NILAI EKSPIRASI", 1, 0, 'C');

                $x1 = $this->GetX();
                $y1 = $this->GetY();
                $this->MultiCell(140/6, 4, "AKHIR TAHUN KE", 1, 'C');
                $y2 = $this->GetY();
                $yH = $y2 - $y1;

                $this->SetXY($x1 + 140/6, $y2 - $yH);
                $this->Cell(140/3, 8, "NILAI EKSPIRASI", 1, 0, 'C');
                $this->Cell(25, 8, NULL, 0, 1, 'L');
            }
            else if ($this->arrt['KDPRODUK'] == "ADB" || $this->arrt['KDPRODUK'] == "ADK" || $this->arrt['KDPRODUK'] == "ADS" || $this->arrt['KDPRODUK'] == "ADT" || $this->arrt['KDPRODUK'] == "ADX" && count($this->arrt2) > 0) {
                $this->Cell(25, 8, NULL, 0, 0, 'L');
                $x1 = $this->GetX();
                $y1 = $this->GetY();
                $this->MultiCell(140/6, 4, "AKHIR TAHUN KE", 1, 'C');
                $y2 = $this->GetY();
                $yH = $y2 - $y1;

                $this->SetXY($x1 + 140/6, $y2 - $yH);

                $this->Cell(140/3, 8, "NILAI TEBUS", 1, 0, 'C');

                $x1 = $this->GetX();
                $y1 = $this->GetY();
                $this->MultiCell(140/6, 4, "AKHIR TAHUN KE", 1, 'C');
                $y2 = $this->GetY();
                $yH = $y2 - $y1;

                $this->SetXY($x1 + 140/6, $y2 - $yH);
                $this->Cell(140/3, 8, "NILAI TEBUS", 1, 0, 'C');
                $this->Cell(25, 8, NULL, 0, 1, 'L');
            }
            else if (count($this->arrt2) > 0 && $this->arr['KDPRODUK'] != 'JSKEL') {
                $this->Cell(25, 8, NULL, 0, 0, 'L');
                $x1 = $this->GetX();
                $y1 = $this->GetY();
                $this->MultiCell(140/6, 4, "AKHIR TAHUN KE", 1, 'C');
                $y2 = $this->GetY();
                $yH = $y2 - $y1;

                $this->SetXY($x1 + 140/6, $y2 - $yH);

                $this->Cell(140/3, 8, "NILAI TEBUS", 1, 0, 'C');

                $x1 = $this->GetX();
                $y1 = $this->GetY();
                $this->MultiCell(140/6, 4, "AKHIR TAHUN KE", 1, 'C');
                $y2 = $this->GetY();
                $yH = $y2 - $y1;

                $this->SetXY($x1 + 140/6, $y2 - $yH);
                $this->Cell(140/3, 8, "NILAI TEBUS", 1, 0, 'C');
                $this->Cell(25, 8, NULL, 0, 1, 'L');
            }
        }

        private function tgl_indonesia($tanggal, $mode = 1) {
            $tanggal = empty($tanggal) ? date('d/m/Y') : $tanggal;
            $bulan	 = array("JANUARI", "FEBRUARI", "MARET", "APRIL", "MEI", "JUNI", "JULI", "AGUSTUS", "SEPTEMBER", "OKTOBER", "NOVEMBER", "DESEMBER");
            $tgl	 = substr($tanggal, 0, 2);
            $bln	 = substr($tanggal, 3, 2);
            $thn	 = substr($tanggal, 6, 4);

            switch ($mode) {
                case 1:
                    $namabulan = $bulan[$bln-1];
                    break;
                case 2:
                    $namabulan = ucwords(strtolower($bulan[$bln-1]));
                    break;
                case 3:
                    $namabulan = strtolower($bulan[$bln-1]);
                    break;
            }

            return "$tgl $namabulan $thn";
        }

        private function font_title($bold = false) {
            $this->SetFont('Arial', $bold ? 'B' : '', 12);
        }

        private function font_body($style = '') {
            $this->SetFont('Arial', $style, 9);
        }

        private function custom_font($size, $bold) {
            $this->SetFont('Arial', $bold ? 'B' : '', $size);
        }

        private function font_ttd($bold = false) {
            $this->SetFont('Arial', $bold ? 'B' : '', 6);
        }

        private function font_footer($bold = false) {
            //$this->SetFont('Arial', $bold ? 'B' : '', 8);
        }

        /*public function Footer() {
            $this->SetFont('Arial','',8);
            $this->SetY(-15);
            $this->Cell(0,10,'Halaman '.$this->PageNo().'/{nb}',0,0,'C');
        }*/
    }


    $DA	 = new Database($data['user_id'], $data['password'], $data['db']);

    // cek apakah produk yang ingin dicetak adalah produk anuitas, jika ya redirect ke cetak anuitas
    $anuitas = array('AI0', 'AI0B', 'AI0BNI', 'ASI', 'ASIBNI', 'ASIB', 'ASP', 'ASPBNI', 'ASPB', 'JSAEP', 'AI0N', 'AI0NB');
    $pa = array('PAA', 'PAB', 'PAAC');
    $kredit = array('AKM','AKL');
    $sql = "SELECT KDPRODUK FROM $DBUser.TABEL_200_PERTANGGUNGAN WHERE PREFIXPERTANGGUNGAN = '$data[prefix]' AND NOPERTANGGUNGAN = '$data[nopertanggungan]'";
    $DA->parse($sql);
    $DA->execute();
    $produk = $DA->nextrow();
    if (in_array($produk['KDPRODUK'], $anuitas)) {
        header("Location: http://$_SERVER[SERVER_ADDR]/jiwasraya/proposal/ulink/test.cetak.polis.anuitas.php?prefix=$data[prefix]&nopertanggungan=$data[nopertanggungan]");
    }
    // cek apakah produk yang ingin dicetak adalah produk pa, jika ya redirect ke cetak pa (sekarang berubah ke akdp per 20/06/2016)
    else if (in_array($produk['KDPRODUK'], $pa)) {
        header("Location: http://$_SERVER[SERVER_ADDR]/jiwasraya/proposal/ulink/test.cetak.sertifikat.akdp.php?prefix=$data[prefix]&nopertanggungan=$data[nopertanggungan]");
    }
    // cek apakah produk yang ingin dicetak adalah produk asuransi jiwa kredit, jika ya redirect ke cetak kredit
    else if (in_array($produk['KDPRODUK'], $kredit)) {
        header("Location: http://$_SERVER[SERVER_ADDR]/jiwasraya/proposal/ulink/test.cetak.polis.kredit.php?prefix=$data[prefix]&nopertanggungan=$data[nopertanggungan]");
    }
    // cek apakah produk yang ingin dicetak adalah produk jl4 (js promapan), jika ya redirect ke cetak newlink
    else if (substr($produk['KDPRODUK'],0,3) == 'JL4') {
        header("Location: http://$_SERVER[SERVER_ADDR]/jiwasraya/proposal/ulink/test.cetak.polis.linknew.php?prefix=$data[prefix]&nopertanggungan=$data[nopertanggungan]");
    }
    else {
        $pdf = new CetakPolis($data);
        $pdf->AliasNbPages();
        $pdf->Output();
    }

?>