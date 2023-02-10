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
	$data['tglrollover']	 = trim($_GET['tglrollover']);
	$data['paragraph1']		 = "Penanggung dengan ini menyatakan setuju untuk membayarkan manfaat atas penyerahan Polis ini berkenaan dengan "
							 . "diri Tertanggung berdasarkan Syarat dan ketentuan sebagaimana dalam data Polis, Syarat Umum Polis, Syarat Khusus, "
							 . "ketentuan tambahan dan ketentuan lainnya (bila ada) yang dilekatkan/dilampirkan pada Polis ini yang merupakan "
							 . "bagian yang tidak terpisahkan dari Polis ini";
	
	class CetakSertifikat extends FPDF {
		private $paragraph1;
		private $paragraph2;
		private $arr;
		private $ars;
		
		private $num_space	= 10;
		private $height		= 4;
		
		public function __construct($data) {
			parent::__construct('P', 'mm', 'A4');
			$this->user_id		   = $data['user_id'];
			$this->password		   = $data['password'];
			$this->db			   = $data['db'];
			$this->prefix		   = $data['prefix'];
			$this->nopertanggungan = $data['nopertanggungan'];
			$this->tglrollover 	   = $data['tglrollover'];
			$this->paragraph1	   = $data['paragraph1'];
			$this->tgl_cetak	   = date('Ymd');
			$this->jam_cetak	   = date('His');
			$this->showline		   = 0;
			
			$this->SetMargins(35, 30, 45);
			
			$this->Init();			
			$this->Sertifikat();
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
						CASE WHEN a.KDPRODUK IN ('JSSHTBU', 'JSSHTB') THEN (SELECT NAMAPEJABAT FROM $DBUser.TABEL_002_PEJABAT WHERE KDKANTOR = '$this->prefix' AND KDORGANISASI = '160') 
							ELSE (SELECT pj.NAMAPEJABAT FROM $DBUser.TABEL_001_KANTOR kn, $DBUser.TABEL_400_AGEN ag, $DBUser.TABEL_002_PEJABAT pj WHERE kn.KDKANTOR = ag.KDKANTOR AND ag.NOAGEN = a.NOAGEN AND kn.KDKANTOR = pj.KDKANTOR AND pj.KDORGANISASI = '160' ) 
						END AS NAMAPEJABAT,
						CASE WHEN a.KDPRODUK IN ('JSSHTB') THEN (SELECT NAMAJABATAN FROM $DBUser.TABEL_002_PEJABAT WHERE KDKANTOR = '$this->prefix' AND KDORGANISASI = '160') 
							ELSE (SELECT pj.NAMAJABATAN FROM $DBUser.TABEL_001_KANTOR kn, $DBUser.TABEL_400_AGEN ag, $DBUser.TABEL_002_PEJABAT pj WHERE kn.KDKANTOR = ag.KDKANTOR AND ag.NOAGEN = a.NOAGEN AND kn.KDKANTOR = pj.KDKANTOR AND pj.KDORGANISASI = '160' ) 
						END AS NAMAJABATAN,
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
			
			$sql = "UPDATE $DBUser.POLIS_AKDP_ROLLOVER SET kdcetakpolis = '1', tglcetakpolis = sysdate, usercetakpolis = user
			WHERE prefixpertanggungan = '$this->prefix'
			AND nopertanggungan = '$this->nopertanggungan' and to_char(tglrollover,'dd/mm/yyyy')='$this->tglrollover'";
			$DA->parse($sql);
			$DA->execute();
		}
		
		public function Sertifikat() {
			$this->AddPage();
			$height = $this->height;
			$arr = $this->arr;
			$showline = $this->showline;
			
			$this->font_title('B');
			$this->Cell(0, $height, 'POLIS ASURANSI KECELAKAAN DIRI PERORANGAN', $showline, 1, 'C');
			
			$this->font_body();
			$plan = $arr['KDPRODUK'] == 'PAA' ? 'PLAN A' : 'PLAN B';
			$this->Cell(0, $height, "$plan NOMOR POLIS : $this->prefix - $this->nopertanggungan", $showline, 1, 'C');
			
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
			$this->Cell(35, $height, 'Nama Pemegang Polis', $showline, 0, 'L');
			$this->Cell(3.5, $height, ':', $showline, 0, 'L');
			$this->Cell(94, $height, $arr['PEMEGANGPOLIS'], $showline, 1, 'L');
			
			$this->Cell(35, $height, 'Alamat', $showline, 0, 'L');
			$this->Cell(3.5, $height, ':', $showline, 0, 'L');
			$this->MultiCell(0, 3.8, $arr['ALAMATPEMPOL'], $showline, 'J');
			
			$this->Cell(35, $height, 'Nama Tertanggung', $showline, 0, 'L');
			$this->Cell(3.5, $height, ':', $showline, 0, 'L');
			$this->Cell(94, $height, $arr['TERTANGGUNG'], $showline, 1, 'L');
			
			$this->Cell(35, $height, 'Tanggal Lahir', $showline, 0, 'L');
			$this->Cell(3.5, $height, ':', $showline, 0, 'L');
			$this->Cell(94, $height, $arr['TGLLAHIRTT'], $showline, 1, 'L');
			
			$this->Cell(35, $height, 'Uang Asuransi', $showline, 0, 'L');
			$this->Cell(3.5, $height, ':', $showline, 0, 'L');
			$this->Cell(94, $height, $arr['NOTASI'].'.'.number_format($arr['JUAMAINPRODUK'], 2, ",", "."), $showline, 1, 'L');
			
			$this->Cell(35, $height, 'Masa Asuransi', $showline, 0, 'L');
			$this->Cell(3.5, $height, ':', $showline, 0, 'L');
			$this->Cell(94, $height, $this->tgl_indonesia($arr['MULAS'])." Sampai ".$this->tgl_indonesia($arr['EXPIRASI']), $showline, 1, 'L');
			
			$this->Cell(35, $height, 'Valuta', $showline, 0, 'L');
			$this->Cell(3.5, $height, ':', $showline, 0, 'L');
			$this->Cell(94, $height, ucwords(strtolower($arr['NAMAVALUTA'])), $showline, 1, 'L');
			
			$this->Cell(35, $height, 'Premi', $showline, 0, 'L');
			$this->Cell(3.5, $height, ':', $showline, 0, 'L');
			$this->Cell(94, $height, $arr['NOTASI'].'.'.number_format($arr['PREMI1'], 2, ",", ".").' Dibayar Sekaligus', $showline, 1, 'L');
			
			$this->Cell(35, $height, 'Penerima Manfaat :', $showline, 1, 'L');
			
			foreach ($this->ars as $i => $v) {
				$this->Cell(0, $height, ($i+1).". $v[NAMAHUBUNGAN], $v[NAMAKLIEN1]", $showline, 1, 'L');
			}
			
			$this->Ln(7);
			
			$x = $this->getX();
			$this->Cell(71.5, $height, "", $showline, 0, 'C');
			$this->Cell(61, $height, "Jakarta, ".ucwords(strtolower($this->tgl_indonesia($arr['TGLCETAK']))), $showline, 1, 'C');
			$this->Cell(71.5, $height, "", $showline, 0, 'C');
			$this->Cell(61, $height, 'PT ASURANSI JIWA IFG', $showline, 1, 'C');
            $this->Image('./images/tandatangan.jpg', 120, $this->GetY()+5, 37);
			
			$this->Ln();
			$this->SetXY($x, $this->getY()+14);
			
			$this->SetFont('Arial', '', 9);
			
			$this->Cell(71.5, $height, ucwords(strtolower($arr['NAMAPEJABAT'])), $showline, 0, 'C');
			$this->Cell(61, $height, $arr['NAMADIREKTUR'], $showline, 1, 'C');
			$this->Cell(71.5, $height, ucwords(strtolower($arr['NAMAJABATAN'])), $showline, 0, 'C');
			$this->Cell(61, $height, $arr['JABATANDIREKTUR'], $showline, 1, 'C');
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