<?php
	
	include "./includes/session.php";
	include "./includes/database.php"; 
	include "../../../includes/common.php";
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
	$data['db']				 = $DBName;
	$data['dbuser']			 = $DBUser;
	$data['prefix']			 = trim($_GET['prefix']);
	$data['nopertanggungan'] = trim($_GET['nopertanggungan']);
	$data['paragraph1']		 = "Penanggung dengan ini menyatakan setuju untuk membayarkan manfaat atas penyerahan Polis ini berkenaan dengan "
							 . "diri Tertanggung berdasarkan Syarat dan ketentuan sebagaimana dalam data Polis, Syarat Umum Polis, Syarat Khusus, "
							 . "ketentuan tambahan dan ketentuan lainnya (bila ada) yang dilekatkan/dilampirkan pada Polis ini yang merupakan "
							 . "bagian yang tidak terpisahkan dari Polis ini";
	
	class CetakSertifikat extends FPDF {
		private $paragraph1;
		private $paragraph2;
		private $arr;
		private $ars;
		private $DBUser;
		
		private $pg_w = 128.5;
		private $num_space = 0.1;
		private $height = 4;
		private $kolom_datapolis = array(40, 5, 83.5);
		private $showline = 0;
		
		public function __construct($data) {
			parent::__construct('P', 'mm', 'A5');
			$this->user_id		   = $data['user_id'];
			$this->password		   = $data['password'];
			$this->DBUser		   = $data['dbuser'];
			$this->db			   = $data['db'];
			$this->prefix		   = $data['prefix'];
			$this->nopertanggungan = $data['nopertanggungan'];
			$this->paragraph1	   = $data['paragraph1'];
			$this->tgl_cetak	   = date('Ymd');
			$this->jam_cetak	   = date('His');
			
			$this->SetMargins(10, 10, 10);
			
			$this->Init();			
			$this->Sertifikat();
			$this->KetentuanPolis();
		}
		
		public function Init() {
			$DA	  = new Database($this->user_id, $this->password, $this->db);
			$DBUser = $this->DBUser;
			
			$sql = "SELECT a.PREFIXPERTANGGUNGAN, a.TGLSP, TO_CHAR(a.MULAS, 'DD/MM/YYYY') AS MULAS, a.USIA_TH, a.NOPERTANGGUNGAN, a.NOPOLBARU, 
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
						CASE WHEN a.KDPRODUK IN ('JSSHTBU', 'JSSHTB') THEN (SELECT NAMAPEJABAT FROM $DBUser.TABEL_002_PEJABAT WHERE KDKANTOR = '$this->prefix' AND KDORGANISASI = '160') 
							ELSE (SELECT pj.NAMAPEJABAT FROM $DBUser.TABEL_001_KANTOR kn, $DBUser.TABEL_400_AGEN ag, $DBUser.TABEL_002_PEJABAT pj WHERE kn.KDKANTOR = ag.KDKANTOR AND ag.NOAGEN = a.NOAGEN AND kn.KDKANTOR = pj.KDKANTOR AND pj.KDORGANISASI = '160' ) 
						END AS NAMAPEJABAT,
						CASE WHEN a.KDPRODUK IN ('JSSHTB') THEN (SELECT NAMAJABATAN FROM $DBUser.TABEL_002_PEJABAT WHERE KDKANTOR = '$this->prefix' AND KDORGANISASI = '160') 
							ELSE (SELECT pj.NAMAJABATAN FROM $DBUser.TABEL_001_KANTOR kn, $DBUser.TABEL_400_AGEN ag, $DBUser.TABEL_002_PEJABAT pj WHERE kn.KDKANTOR = ag.KDKANTOR AND ag.NOAGEN = a.NOAGEN AND kn.KDKANTOR = pj.KDKANTOR AND pj.KDORGANISASI = '160' ) 
						END AS NAMAJABATAN,
						(SELECT NAMAPEJABAT FROM $DBUser.TABEL_002_PEJABAT pj INNER JOIN $DBUser.TABEL_500_PENAGIH pg ON pj.KDKANTOR = pg.KDRAYONPENAGIH WHERE pg.NOPENAGIH = a.NOPENAGIH AND KDORGANISASI = '160s') AS NAMAPEJABAT, 
						(SELECT NAMAJABATAN FROM $DBUser.TABEL_002_PEJABAT pj INNER JOIN $DBUser.TABEL_500_PENAGIH pg ON pj.KDKANTOR = pg.KDRAYONPENAGIH WHERE pg.NOPENAGIH = a.NOPENAGIH AND KDORGANISASI = '160s') AS NAMAJABATAN,
						d.NOID, d.GELAR AS GELARPP, d.ALAMATTETAP01, d.ALAMATTETAP02, TO_CHAR(d.TGLLAHIR, 'dd/mm/yyyy') TGLLAHIR,
						d.KODEPOSTETAP, d.PHONETETAP01, d.NAMAKLIEN1 as PEMEGANGPOLIS, LENGTH(d.NAMAKLIEN1) PANJANG,
						DECODE(e.GELAR, null, null, ', ' || e.GELAR) AS GELARTTG,
						DECODE(d.GELAR, null, null, ', ' || d.GELAR) AS GELARPP, 
						e.NAMAKLIEN1 as TERTANGGUNG,  TO_CHAR(e.TGLLAHIR, 'dd/mm/yyyy') TGLLAHIRTT, 
						(SELECT x.FAKTORBAYAR FROM $DBUser.TABEL_311_FAKTOR_BAYAR x WHERE x.KDVALUTA = a.KDVALUTA and x.KDCARABAYAR = a.KDCARABAYAR and x.KDBASIS = f.KDBASISBAYAR) AS FAKTORBAYAR, a.PREMISTD,
						d.ALAMATTETAP01 || ' ' || d.ALAMATTETAP02 || ' ' || g.NAMAKOTAMADYA || ' ' || h.NAMAPROPINSI AS ALAMATPEMPOL, j.NAMABENEFIT,
						k.KDMAPPING,
                        (SELECT NAMAPEJABAT FROM $DBUser.TABEL_002_PEJABAT WHERE KDKANTOR = 'KP' AND KDORGANISASI = '000') AS NAMADIREKTUR,
                        (SELECT NAMAJABATAN FROM $DBUser.TABEL_002_PEJABAT WHERE KDKANTOR = 'KP' AND KDORGANISASI = '000') AS JABATANDIREKTUR,
						l.NOACCOUNT NOH2H
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
					LEFT OUTER JOIN $DBUser.TABEL_100_KLIEN_ACCOUNT l ON a.prefixpertanggungan = l.prefixpertanggungan
						AND a.nopertanggungan = l.nopertanggungan
						AND l.jenis = 'HH'
						AND l.kdbank = 'BMRI'
					WHERE a.KDPERTANGGUNGAN = '2'
						AND a.PREFIXPERTANGGUNGAN = '$this->prefix'
						AND a.NOPERTANGGUNGAN = '$this->nopertanggungan'";
			$DA->parse($sql);
			$DA->execute();
			$this->arr = $DA->nextrow();
			
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
                        WHERE a.kdproduk='".$this->arr['KDPRODUK']."' AND a.kdvaluta='".$this->arr['KDVALUTA']."'
                              AND a.kdcarabayar='".($this->arr['KDCARABAYAR'] == 'X' ? 'X' : 'B')."'
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
		}
		
		public function Sertifikat() {
			$this->AddPage();
			$height = $this->height;
			$arr = $this->arr;
			$showline = $this->showline;
			
			$this->font_title('B');
			$this->Cell(0, $height, 'ASURANSI IFG PERSONAL ACCIDENT', $showline, 1, 'C');
			
			$this->font_body();
			$plan = $arr['KDPRODUK'] == 'PAA' ? 'PLAN A' : 'PLAN B';
			$this->Cell(0, $height, "$plan NOMOR POLIS : $arr[NOPOLBARU]", $showline, 1, 'C');
			
			$this->Ln(3);
			
			$this->font_title('B');
			$this->Cell(0, $height, 'PT ASURANSI JIWA IFG', $showline, 1, 'C');
			$this->font_body();
			$this->Cell(0, $height, 'SELANJUTNYA DISEBUT PENANGGUNG', $showline, 1, 'C');
			
			$this->Ln(2);
			
			$this->font_body();
			$this->MultiCell(0, 4, "Atas Surat Permohonan Asuransi Jiwa (SPAJ) nomor : ".$arr['NOSP'].", beserta semua pernyataan dan keterangan yang disampaikan oleh :", $showline, 'J');
			
			$this->Ln(4);
			
			$this->font_title('B');
			$this->Cell(0, $height, "$arr[PEMEGANGPOLIS]", $showline, 1, 'C');
			$this->font_body();
			$this->Cell(0, $height, '(Selanjutnya disebut Pemegang Polis)', $showline, 1, 'C');
			
			$this->Ln(3);
			
			$this->MultiCell(0, 4, $this->paragraph1, $showline, 'J');
			
			$this->Ln(3);
			
			$this->font_title('B');
			$this->Cell(0, $height, "DATA POLIS", $showline, 1, 'L');
			$this->font_body();
			$this->Cell($this->kolom_datapolis[0], $height, 'Nama Pemegang Polis', $showline, 0, 'L');
			$this->Cell($this->kolom_datapolis[1], $height, ':', $showline, 0, 'L');
			$this->Cell($this->kolom_datapolis[2], $height, $arr['PEMEGANGPOLIS'], $showline, 1, 'L');
			
			$this->Cell($this->kolom_datapolis[0], $height, 'Nomor Induk Kependudukan', $showline, 0, 'L');
			$this->Cell($this->kolom_datapolis[1], $height, ':', $showline, 0, 'L');
			$this->Cell($this->kolom_datapolis[2], $height, $arr['NOID'], $showline, 1, 'L');
			
			$this->Cell($this->kolom_datapolis[0], $height, 'Alamat', $showline, 0, 'L');
			$this->Cell($this->kolom_datapolis[1], $height, ':', $showline, 0, 'L');
			$this->MultiCell(0, 3.8, $arr['ALAMATPEMPOL'], $showline, 'J');
			
			$this->Cell($this->kolom_datapolis[0], $height, 'Nama Tertanggung', $showline, 0, 'L');
			$this->Cell($this->kolom_datapolis[1], $height, ':', $showline, 0, 'L');
			$this->Cell($this->kolom_datapolis[2], $height, $arr['TERTANGGUNG'], $showline, 1, 'L');
			
			$this->Cell($this->kolom_datapolis[0], $height, 'Tanggal Lahir', $showline, 0, 'L');
			$this->Cell($this->kolom_datapolis[1], $height, ':', $showline, 0, 'L');
			$this->Cell($this->kolom_datapolis[2], $height, $arr['TGLLAHIRTT'], $showline, 1, 'L');
			
			$this->Cell($this->kolom_datapolis[0], $height, 'Uang Asuransi', $showline, 0, 'L');
			$this->Cell($this->kolom_datapolis[1], $height, ':', $showline, 0, 'L');
			$this->Cell($this->kolom_datapolis[2], $height, $arr['NOTASI'].'.'.number_format($arr['JUAMAINPRODUK'], 2, ",", "."), $showline, 1, 'L');
			
			$this->Cell($this->kolom_datapolis[0], $height, 'Masa Asuransi', $showline, 0, 'L');
			$this->Cell($this->kolom_datapolis[1], $height, ':', $showline, 0, 'L');
			$this->Cell($this->kolom_datapolis[2], $height, $this->tgl_indonesia($arr['MULAS'])." Sampai ".$this->tgl_indonesia($arr['EXPIRASI']), $showline, 1, 'L');
			
			$this->Cell($this->kolom_datapolis[0], $height, 'Valuta', $showline, 0, 'L');
			$this->Cell($this->kolom_datapolis[1], $height, ':', $showline, 0, 'L');
			$this->Cell($this->kolom_datapolis[2], $height, ucwords(strtolower($arr['NAMAVALUTA'])), $showline, 1, 'L');
			
			$this->Cell($this->kolom_datapolis[0], $height, 'Premi', $showline, 0, 'L');
			$this->Cell($this->kolom_datapolis[1], $height, ':', $showline, 0, 'L');
			$this->Cell($this->kolom_datapolis[2], $height, $arr['NOTASI'].'.'.number_format($arr['PREMI1'], 2, ",", ".").' Dibayar Sekaligus', $showline, 1, 'L');
			
			$this->Cell(0, $height, 'Penerima Manfaat :', $showline, 1, 'L');
			
			foreach ($this->ars as $i => $v) {
				$this->Cell(0, $height, ($i+1).". $v[NAMAHUBUNGAN], $v[NAMAKLIEN1]", $showline, 1, 'L');
			}
			
			$this->Ln(7);
			
			$x = $this->getX();
			$y = $this->GetY();
			$this->Cell($this->pg_w/2, $height, "", $showline, 0, 'C');
			$this->Cell($this->pg_w/2, $height, "Jakarta, ".ucwords(strtolower($this->tgl_indonesia($arr['TGLCETAK']))), $showline, 1, 'C');
			$this->Cell($this->pg_w/2, $height, "", $showline, 0, 'C');
			$this->Cell($this->pg_w/2, $height, 'PT ASURANSI JIWA IFG', $showline, 1, 'C');
            $this->Image('./images/tandatangan.jpg', $x+($this->pg_w/1.6), $this->GetY(), 37);
			
			$this->Ln();
			$this->SetXY($x, $this->getY()+14);
			
			$this->SetFont('Arial', '', 9);
			
			$this->Cell($this->pg_w/2, $height, ucwords(strtolower($arr['NAMAPEJABAT'])), $showline, 0, 'C');
			$this->Cell($this->pg_w/2, $height, $arr['NAMADIREKTUR'], $showline, 1, 'C');
			$this->Cell($this->pg_w/2, $height, ucwords(strtolower($arr['NAMAJABATAN'])), $showline, 0, 'C');
			$this->Cell($this->pg_w/2, $height, $arr['JABATANDIREKTUR'], $showline, 1, 'C');
			
			//$this->SetXY(10.00125, 199.00125);
			
			/*QRCode engine*/
			$filename = QRCODE_TEMP_DIR."/".substr(md5(md5(strtotime('now')+date("u"))), -10, 10).".png";
			$data_qrc = ('https://asuransi.ifg-life.id/scan/?q=retail&n='.base64_encode($this->prefix.$this->nopertanggungan));
			$image = new Qrcode();
			$image->setdata($data_qrc);
			$image->calculate();
			$image->save($filename);
			/*end of QRCode */
			
			$this->Image($filename, $x+($this->pg_w/8), $y+2, 30, 30);
		}
		
		public function KetentuanPolis() {
			$this->AddPage();
			
			$height = $this->height;
			$no_h	= 1;
			$data	= array();
			$showline = $this->showline;
						
			$this->font_title('B');
			$this->Cell(0, $height, 'KETENTUAN - KETENTUAN KHUSUS', $showline, 1, 'C');
			$this->Cell(0, $height, 'PERSONAL ACCIDENT '.($this->arr['KDPRODUK'] == 'PAA' ? 'PLAN A' : 'PLAN B'), $showline, 1, 'C');
			$this->Cell(0, $height, "POLIS NOMOR : "/*$this->prefix - $this->nopertanggungan*/.$this->arr['NOPOLBARU'], $showline, 0, 'C');
			
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
                        $this->Cell($this->num_space, $height, NULL, $this->showline, 0, 'C');

                        $no = str_replace("/}", NULL, str_replace("{NUMBER=", NULL, substr($judul, 0, strpos($judul, "/}")+2)));
                        $this->Cell(6, $height, $no, $this->showline, 0, 'L');

                        $judul = substr($judul, strpos($judul, "/}")+2);
                        if (strpos($judul, "{STYLE=") !== false) {
                            $this->font_body(str_replace("/}", NULL, str_replace("{STYLE=", NULL, substr($judul, 0, strpos($judul, "/}")+2))));
                            $judul = substr($judul, strpos($judul, "/}")+2);
                        }
                        $this->MultiCell($this->pg_w-($this->num_space*2)-6, $height, $judul, $this->showline, 'J');
                    }
                    else {
                        $this->Cell($this->num_space, $height, NULL, $this->showline, 0, 'C');
                        $this->MultiCell($this->pg_w-($this->num_space*2), $height, $judul, $this->showline, 'J');
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
                                        $this->Cell($this->num_space, $height, NULL, $this->showline, 0, 'C');
                                        $this->Cell($nospace, $height, $no, $this->showline, 0, 'L');
                                        break;
									case 1:
										$indentspace = 6;
										$nospace = 6;
										$this->Cell($this->num_space+$indentspace, $height, NULL, $this->showline, 0, 'C');
										$this->Cell($nospace, $height, $no, $this->showline, 0, 'L');
										//$val = str_replace('{/INDENT1}','',substr($v, strpos($v, "/}")+2));
										break;
									case 2:
										$indentspace = 12;
										$nospace = 6;
										$this->Cell($this->num_space+$indentspace, $height, NULL, $this->showline, 0, 'C');
										$this->Cell($nospace, $height, $no, $this->showline, 0, 'L');
										//$val = str_replace('{/INDENT2}','',substr($v, strpos($v, "/}")+2));
										break;
									case 3:
										$indentspace = 18;
										$nospace = 9;
										$this->Cell($this->num_space+$indentspace, $height, NULL, $this->showline, 0, 'C');
										$this->Cell($nospace, $height, $no, $this->showline, 0, 'L');
										//$val = str_replace('{/INDENT3}','',substr($v, strpos($v, "/}")+2));
										break;
								}

                                $this->MultiCell($this->pg_w-($this->num_space*2+$nospace)-$indentspace, $this->height, $val, $this->showline, 'J');
							}
							else if (!empty($v)) {
								$val = str_replace("}", NULL, $v);
								$this->Cell($this->num_space+6, $height, NULL, $this->showline, 0, 'C');
								$this->MultiCell($this->pg_w-($this->num_space*2+5), $this->height, $val, $this->showline, 'J');
							}
						}
						$no_h++;
					}
					
					// addpage jika $addpage = true
					if ($addpage) {
						$this->AddPage();
						$this->font_title('B');
						$this->Cell($this->pg_w, $height, 'KETENTUAN - KETENTUAN KHUSUS', $this->showline, 1, 'C');
						$this->Cell($this->pg_w, $height, "POLIS NOMOR : $this->prefix - $this->nopertanggungan", $this->showline, 0, 'C');
						
						$this->Ln(10);
					}
					
					$this->Ln(2);
				}
			}
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
			$this->SetFont('Arial', $bold ? 'B' : '', 10);
		}
		
		private function font_body($bold = false) {
			$this->SetFont('Arial', $bold ? 'B' : '', 8);
		}
	}
	
	$pdf = new CetakSertifikat($data);
	$pdf->AliasNbPages();
	$pdf->Output();
?>