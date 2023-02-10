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
$data['paragraph1']		 = "Adalah Tertanggung Asuransi Kecelakaan Diri Perorangan berdasarkan polis induk nomor 00112.91PAPP beserta "
    . "Syarat-syarat Umum Polis Asuransi Kecelakaan Diri Perorangan yang aslinya disimpan dalam protokol notaris "
    . "Mohamad Ali di Jakarta dengan akta nomor 15 tanggal 9 Desember 1991, dengan ketentuan sebagai berikut : ";
$data['paragraph2']		 = "Sertifikat ini merupakan bukti kepesertaan dan sekaligus untuk memperoleh pembayaran faedah asuransi menurut "
    . "Syarat-syarat Umum Polis Asuransi Kecelakaan Diri Perorangan, sebagaimana tersebut dibelakang sertifikat ini yang "
    . "merupakan bagian tidak terpisahkan dari polis induk tersebut diatas.";

class CetakSertifikat extends FPDF {
    private $paragraph1;
    private $paragraph2;
    private $arr;
    private $ars;

    private $pg_w		= 190;
    private $num_space	= 10;
    private $height		= 5;

    public function __construct($data) {
        parent::__construct('P', 'mm', 'A4');
        $this->SetMargins(10, 33);
        $this->user_id		   = $data['user_id'];
        $this->password		   = $data['password'];
        $this->db			   = $data['db'];
        $this->prefix		   = $data['prefix'];
        $this->nopertanggungan = $data['nopertanggungan'];
        $this->paragraph1	   = $data['paragraph1'];
        $this->paragraph2	   = $data['paragraph2'];
        $this->tgl_cetak	   = date('Ymd');
        $this->jam_cetak	   = date('His');

        $this->Init();
        $this->Sertifikat();
        /*$this->DataPolis();
        $this->KetentuanPolis();*/
        //$this->AsuransiTambahan();
    }

    public function Init() {
        $DA	  = new Database($this->user_id, $this->password, $this->db);

        $sql = "SELECT a.PREFIXPERTANGGUNGAN, a.TGLSP, TO_CHAR(a.MULAS, 'DD/MM/YYYY') AS MULAS, a.USIA_TH, a.NOPERTANGGUNGAN, 
						TO_CHAR(a.EXPIRASI, 'DD/MM/YYYY') AS EXPIRASI, a.LAMAPEMBPREMI_BL AS PERIODE_BULAN, a.NOPEMEGANGPOLIS, 
						a.LAMAASURANSI_TH, a.LAMAASURANSI_BL,TO_CHAR(a.TGLCETAK, 'DD/MM/YYYY') AS TGLCETAK, a.JUAMAINPRODUK, 
						a.PREMI1, a.PREMI2, a.NOSP, a.KDVALUTA, a.KDCARABAYAR, a.KDSTATUSMEDICAL, 
						DECODE (a.KDCARABAYAR, 'X', 1, a.LAMAPEMBPREMI_TH) LAMAPEMBPREMI_TH, 
						a.KDPRODUK, i.NAMAVALUTA, i.NOTASI,
						(SELECT CASE WHEN COUNT(*) > 0 THEN b.NAMAPRODUK || ' LENGKAP' ELSE b.NAMAPRODUK END FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE PREFIXPERTANGGUNGAN=a.PREFIXPERTANGGUNGAN AND NOPERTANGGUNGAN=a.NOPERTANGGUNGAN and KDBENEFIT='JAMLKP') NAMAPRODUK,
						a.TGLNEXTBOOK, a.TGLLASTPAYMENT, b.KETERANGAN, c.NAMACARABAYAR,
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
						d.ALAMATTETAP01 || ' ' || d.ALAMATTETAP02 || ' ' || g.NAMAKOTAMADYA || ' ' || h.NAMAPROPINSI AS ALAMATPEMPOL, j.NAMABENEFIT,
						k.KDMAPPING,
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
					LEFT OUTER JOIN (
                        SELECT '$this->prefix' PREFIXPERTANGGUNGAN, '$this->nopertanggungan' NOPERTANGGUNGAN,
							LISTAGG('- ' || DECODE(za.KDBENEFIT, 'BNFRWT', 'Rawat Inap di Rumah Sakit karena Kecelakaan', 
								'CCTTTPA', 'Cacat Tetap / Sebagian karena Kecelakaan', 
								'DEATHKC', 'Meninggal Dunia karena kecelakaan', INITCAP(NAMABENEFIT)), '\n') WITHIN GROUP (ORDER BY zb.KDBENEFIT) NAMABENEFIT
                        FROM $DBUser.TABEL_207_KODE_BENEFIT za
                        INNER JOIN $DBUser.TABEL_223_TRANSAKSI_PRODUK zb ON za.KDBENEFIT = zb.KDBENEFIT
                        WHERE zb.PREFIXPERTANGGUNGAN = '$this->prefix' AND zb.NOPERTANGGUNGAN = '$this->nopertanggungan'
							AND zb.NILAIBENEFIT > 0
                    ) j ON a.PREFIXPERTANGGUNGAN = j.PREFIXPERTANGGUNGAN AND a.NOPERTANGGUNGAN = j.NOPERTANGGUNGAN
					LEFT OUTER JOIN $DBUser.TABEL_001_KANTOR k ON a.PREFIXPERTANGGUNGAN = k.KDKANTOR
					WHERE a.KDPERTANGGUNGAN = '2'
						AND a.PREFIXPERTANGGUNGAN = '$this->prefix'
						AND a.NOPERTANGGUNGAN = '$this->nopertanggungan'";
        $DA->parse($sql);
        $DA->execute();
        $this->arr = $DA->nextrow();
    }

    public function Header() {
        // watermark
        $this->Watermark(30, 223,'D   U   P   L   I   K   A   T', 59, 44);
    }

    public function Footer() {
        $this->SetY(-15);
        $this->AliasNbPages();
        $this->SetFont('Arial','i',8);
        $this->Cell(0,10,'Halaman '.$this->PageNo().'/{nb}',0,0,'R');
    }

    public function Sertifikat() {
        $this->AddPage();
        $arr = $this->arr;

        $height = $this->height;
        $nama_pejabat	= strpos($arr["NAMAPEJABAT"], ',') > 0
            ? ucwords(strtolower(substr($arr["NAMAPEJABAT"], 0, strpos($arr["NAMAPEJABAT"], ','))))
            . substr($arr["NAMAPEJABAT"], strpos($arr["NAMAPEJABAT"], ","))
            : ucwords(strtolower($arr["NAMAPEJABAT"]));
        $nama_jabatan	= ucwords(strtolower($arr["NAMAJABATAN"]));

        //$this->SetFont('Arial','B',14);
        $this->font_title('B');
        $this->Cell($this->pg_w, $height, 'SERTIFIKAT ASURANSI KECELAKAAN', 0, 1, 'C');
        $this->Cell($this->pg_w, $height, "DIRI PERORANGAN", 0, 0, 'C');

        $this->Ln(5);

        $this->SetFont('Arial','B',10);
        $this->Cell($this->pg_w - $this->num_space - 45, $height, '', 0, 0, 'C');
        $this->Cell(45, $height, 'NOMOR SERTIFIKAT', 'LTR', 1, 'C');
        $this->Cell($this->pg_w - $this->num_space - 45, $height, '', 0, 0, 'C');
        $this->Cell(45, $height, "$this->prefix - $this->nopertanggungan", 'LRB', 1, 'C');

        $this->Ln(5);

        $this->font_body();
        $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
        $this->MultiCell($this->pg_w-($this->num_space*2), 5, "Berdasarkan Surat Permintaan Asuransi Kecelakaan Diri Perorangan nomor : ".$arr['NOSP']." tanggal ".$this->tgl_indonesia($arr['MULAS'])." Dari :", 0, 'J');

        $this->Ln(2);

        $this->font_body('B');
        $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
        $this->Cell(($this->pg_w-($this->num_space*2))*3/25, $height, "Nama", 0, 0, 'L');
        $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
        $this->Cell(($this->pg_w-($this->num_space*2))*21/25, $height, $arr['PEMEGANGPOLIS'], 0, 1, 'L');
        $this->font_body(true);
        $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
        $this->Cell(($this->pg_w-($this->num_space*2))*3/25, $height, "Alamat", 0, 0, 'L');
        $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
        $this->MultiCell(($this->pg_w-($this->num_space*2))*21/25, $height, $arr["ALAMATPEMPOL"], 0, 'L');

        $this->Ln(5);

        $this->font_body('B');
        $this->Cell($this->pg_w, $height, 'SELANJUTNYA DISEBUT PEMEGANG SERTIFIKAT', 0, 1, 'C');

        $this->Ln(2);

        $this->font_body();
        $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
        $this->Cell($this->pg_w-($this->num_space*2), 5, "Dengan ini PT. Asuransi Jiwa IFG menerangkan bahwa :", 0, 1, 'J');

        $this->Ln(2);

        $this->font_body('B');
        $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
        $this->Cell(($this->pg_w-($this->num_space*2))*3/25, $height, "Nama", 0, 0, 'L');
        $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
        $this->Cell(($this->pg_w-($this->num_space*2))*21/25, $height, $arr['TERTANGGUNG'], 0, 1, 'L');
        $this->font_body('B');
        $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
        $this->Cell(($this->pg_w-($this->num_space*2))*3/25, $height, "Tgl Lahir", 0, 0, 'L');
        $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
        $this->MultiCell(($this->pg_w-($this->num_space*2))*21/25, $height, $arr["TGLLAHIRTT"], 0, 'L');

        $this->Ln(5);

        $this->font_body();
        $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
        $this->MultiCell($this->pg_w-($this->num_space*2), $height, $this->paragraph1, 0, 'J');

        $this->Ln(8);

        $this->font_body('B');
        $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
        $this->Cell(($this->pg_w-($this->num_space*2))*6/25, $height, "1. Uang Asuransi", 0, 0, 'L');
        $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
        $this->Cell(($this->pg_w-($this->num_space*2))*18/25, $height, $arr['NOTASI'].'.'.number_format($arr['JUAMAINPRODUK'], 2, ",", "."), 0, 1, 'L');

        $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
        $this->Cell(($this->pg_w-($this->num_space*2))*6/25, $height, "2. Jaminan Asuransi", 0, 0, 'L');
        $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
        $this->MultiCell(($this->pg_w-($this->num_space*2))*18/25, $height, $arr['NAMABENEFIT'], 0, 'J');

        $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
        $this->Cell(($this->pg_w-($this->num_space*2))*6/25, $height, "3. Masa Asuransi", 0, 0, 'L');
        $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
        $this->Cell(($this->pg_w-($this->num_space*2))*18/25, $height, $arr['MULAS']." Sampai ".$arr['EXPIRASI'], 0, 1, 'L');

        $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
        $this->Cell(($this->pg_w-($this->num_space*2))*6/25, $height, "4. Premi", 0, 0, 'L');
        $this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
        $this->Cell(($this->pg_w-($this->num_space*2))*18/25, $height, $arr['NOTASI'].'.'.number_format($arr['PREMI1'], 0, ",", "."), 0, 1, 'L');
        //$height = $height - 1;

        $this->Ln(8);

        $this->font_body();
        $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
        $this->MultiCell($this->pg_w-($this->num_space*2), 5, $this->paragraph2, 0, 'J');

        $this->Ln(7);

        $x = $this->getX();
        $this->SetFont('Arial','B',9);
        $this->Cell($this->pg_w - $this->num_space - 62, $height, '', 0, 0, 'C');
        $this->Cell(62, $height, "Jakarta, ".ucwords(strtolower($this->tgl_indonesia($arr['TGLCETAK']))), 0, 1, 'L');

        $this->Cell($this->pg_w - $this->num_space - 62, $height, '', 0, 0, 'C');
        $this->Cell(62, $height, 'PT ASURANSI JIWA IFG', 0, 1, 'L');
        $this->Image('./images/tandatangan.jpg', 145, $this->GetY()+5, 37);

        $this->Ln();
        $this->SetXY($x, $this->getY()+18);

        $this->SetFont('Arial', '', 9);

        $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
        $this->Cell(62, $height, null, 0, 0, 'C');
        $this->Cell($this->pg_w - ($this->num_space * 2) - 124, $height, '', 0, 0, 'C');
        $this->Cell(62, $height, $arr['NAMADIREKTUR'], 0, 1, 'L');
        $this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
        $this->Cell(62, $height, null, 0, 0, 'C');
        $this->Cell($this->pg_w - ($this->num_space * 2) - 124, $height, '', 0, 0, 'C');
        $this->Cell(62, $height, $arr['JABATANDIREKTUR'], 0, 1, 'L');
    }

    private function tgl_indonesia($tanggal, $capital = false) {
        $tanggal = empty($tanggal) ? date('d/m/Y') : $tanggal;
        $bulan	 = array("JANUARI", "FEBRUARI", "MARET", "APRIL", "MEI", "JUNI", "JULI", "AGUSTUS", "SEPTEMBER", "OKTOBER", "NOVEMBER", "DESEMBER");
        $tgl	 = substr($tanggal, 0, 2);
        $bln	 = substr($tanggal, 3, 2);
        $thn	 = substr($tanggal, 6, 4);
        $nmbulan = $capital ? $bulan[$bln-1] : ucfirst(strtolower($bulan[$bln-1]));

        return $tgl." ".$nmbulan." ".$thn;
    }

    private function font_title($bold = false) {
        $this->SetFont('Arial', $bold ? 'B' : '', 14);
    }

    private function font_body($bold = false) {
        $this->SetFont('Arial', $bold ? 'B' : '', 10);
    }
}

$pdf = new CetakSertifikat($data);
$pdf->AliasNbPages();
$pdf->Output();
?>