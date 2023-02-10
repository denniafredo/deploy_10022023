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
							 . "waktu 14 (sepuluh) hari kalender sejak Polis ini diterima.";
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
		private $arlp;
		private $arlp2;
		
		private $pg_w		= 190;
		private $num_space	= 8;
		private $height		= 5;
		private $premi1		= 0;
		private $premi2		= 0;
		private $flag_dst	= false;
		
		public function __construct($data) {
			parent::__construct('P', 'mm', 'A4');
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
			$this->LampiranPolis();
		}
		
		public function Init() {
			$DA	  = new Database($this->user_id, $this->password, $this->db);
			
			$sql = "SELECT a.PREFIXPERTANGGUNGAN, a.TGLSP, TO_CHAR(a.MULAS, 'DD/MM/YYYY') AS MULAS, a.USIA_TH, a.NOPERTANGGUNGAN, 
						TO_CHAR(a.EXPIRASI, 'DD/MM/YYYY') AS EXPIRASI, a.LAMAPEMBPREMI_BL AS PERIODE_BULAN, a.NOPEMEGANGPOLIS, 
						a.LAMAASURANSI_TH, a.LAMAASURANSI_BL,TO_CHAR(a.TGLCETAK, 'DD/MM/YYYY') AS TGLCETAK, a.JUAMAINPRODUK, 
						a.JUAMAINPRODUK, a.PREMI1, a.PREMI2, a.NOSP, a.KDVALUTA, a.KDCARABAYAR, a.KDSTATUSMEDICAL, a.LAMAPEMBPREMI_TH, 
						a.KDPRODUK, i.NAMAVALUTA, i.NOTASI,
						a.TGLNEXTBOOK, a.TGLLASTPAYMENT, b.NAMAPRODUK, b.KETERANGAN, c.NAMACARABAYAR,
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
						d.ALAMATTETAP01 || ' ' || d.ALAMATTETAP02 || ' ' || g.NAMAKOTAMADYA || ' ' || h.NAMAPROPINSI AS ALAMATPEMPOL
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
					WHERE a.KDPERTANGGUNGAN = '2'
						AND a.PREFIXPERTANGGUNGAN = '$this->prefix'
						AND a.NOPERTANGGUNGAN = '$this->nopertanggungan'";
						//echo $sql;
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
						DECODE(b.namahubungan || ' ', 'DIRI TERTANGGUNG ', '', b.namahubungan || ' ') || 'TERTANGGUNG' AS NAMAHUBUNGAN,
						c.NAMAKLIEN1 || DECODE (c.GELAR, NULL, NULL, ', ' || c.GELAR) AS NAMAKLIEN1, 
						TO_CHAR(c.TGLLAHIR, 'dd/mm/yyyy') TGLLAHIR
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
			
			/*===== asuransi tambahan =====*/
			$sql = "SELECT MIN (nilaibenefit) nilaibenefit,
						kdbnfx,
						DECODE (SUBSTR (kdbnfx, 1, 4),
							'HCPB', 'HCP PLUS BEDAH',
							'HCPM', 'HCP MURNI',
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
						max(exp) AS exp
					FROM (
						SELECT nilaibenefit, EXP, kdbnf, 
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
								TO_CHAR (a.expirasi, 'dd/mm/yyyy') EXP, 
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
								AND A.KDBENEFIT NOT IN ('GADPOL', 'JAMLKP'))
					) xx
					GROUP BY kdbnfx";
			$DA->parse($sql);
			$DA->execute();
			$data = array();
			while($value = $DA->nextrow()) {
				$data[] = $value;
			}
			$this->art = $data;
			
			/*===== lampiran polis != JL4B =====*/
			$sql = "SELECT NAMAFUND, PORSI
					FROM $DBUser.TABEL_UL_OPSI_FUND a
					INNER JOIN $DBUser.TABEL_UL_KODE_FUND b ON a.KDFUND = b.KDFUND
					WHERE PREFIXPERTANGGUNGAN = '$this->prefix'
						AND NOPERTANGGUNGAN = '$this->nopertanggungan'";
			$DA->parse($sql);
			$DA->execute();
			$data = array();
			while($value = $DA->nextrow()) {
				$data[] = $value;
			}
			$this->arlp = $data;
			
			/*===== lampiran polis == JL4B =====*/
			$sql = "SELECT KDPRODUK, KDBENEFIT, NAMABENEFIT, MAX(LAMAPERIODE)
					FROM (
						SELECT KDPRODUK, KDBENEFIT, NAMABENEFIT, LAMAPERIODE 
						FROM (
							SELECT a.kdproduk, lamaperiode,
								DECODE (SUBSTR(a.kdbenefit, 1, 2), 'CP', 'HCP', NVL(a.KDASALBENEFIT,a.kdbenefit)) kdbenefit,
								DECODE (SUBSTR(a.kdbenefit, 1, 2), 'CP', 'JS - HOSPITAL CASH PLAN', b.namabenefit) namabenefit 
							FROM $DBUser.TABEL_206_PRODUK_BENEFIT a,
							$DBUser.TABEL_207_KODE_BENEFIT b
							WHERE a.kdbenefit = b.kdbenefit AND a.kdproduk = 'JL4B' 
								AND a.kdjenisbenefit = 'R' AND b.kdbenefit <> 'RATEUP' 
								AND b.kdkelompokbenefit IN ('B', 'E', 'D', 'T', 'C', 'R') 
								AND b.faktorbenefit <> 'X' 
								AND DECODE (SUBSTR (a.kdbenefit, 1, 2), 'CP', 'HCP', a.kdbenefit) NOT IN (
									SELECT DECODE (SUBSTR(kdbenefit, 1, 2), 'CP', 'HCP', kdbenefit) 
									FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK 
									WHERE prefixpertanggungan = '$this->prefix'
                                        AND nopertanggungan = '$this->nopertanggungan'
								)
						)
						GROUP BY KDPRODUK, KDBENEFIT, NAMABENEFIT, LAMAPERIODE
					)
					GROUP BY KDPRODUK, KDBENEFIT, NAMABENEFIT
					ORDER BY max(LAMAPERIODE)";
			$DA->parse($sql);
			$DA->execute();
			$data = array();
			while($value = $DA->nextrow()) {
				$data[] = $value;
			}
			$this->arlp2 = $data;
		}
		
		public function SPAJ() {
			$this->AddPage();
			
			$arr			= $this->arr;
			/*$today			= date("j-g-Y");*/
			/*$premi_standard = $arrr["PREMI2JSAP"];*/
			/*$premi_2_jsap	= $arrr["PREMI2JSAP"];*/
			/*$lama_premi		= $arr["LAMAPEMBPREMI_TH"];*/
			/*$kd_produk		= $arr["KDPRODUK"];*/
			/*$kd_ht			= substr($kd_produk, 0, 2);*/
			/*$kd_sts_medical = $arr["KDSTATUSMEDICAL"];*/
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
			$this->Ln(28);
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
			$this->Cell(($this->pg_w-($this->num_space*2))/3, $height, NULL, 0, 0, 'C');
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
			$this->Cell(($this->pg_w-($this->num_space*2))/3, 5, "Drs. Hendrisman Rahim, MA., FSAI., AAIJ", 0, 1, 'C');
			
			$this->SetXY($x1 + ($this->pg_w-($this->num_space*2))/3, $this->GetY());
			$this->Cell(($this->pg_w-($this->num_space*2))/3, 4, "Direktur Utama", 0, 1, 'C');
			
			
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
			$sisa_lm_bayar	= abs($arr["LAMAPEMBPREMI_TH"]) - 5;
			$kd_produk		= $arr["KDPRODUK"];
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
			$this->Ln(12);
			$this->Cell($this->pg_w, $height, 'DATA POLIS', 0, 1, 'C');
			$this->Cell($this->pg_w, $height, "NOMOR : $this->prefix - $this->nopertanggungan", 0, 0, 'C');
			
			
			$this->Ln(13);
			
			
			$this->SetFont('Arial','B',9);
			$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
			$this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Nama Pemegang Polis", 0, 0, 'L');
			$this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
			$this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, $arr["PEMEGANGPOLIS"].$arr["GELARPP"], 0, 1, 'L');
			//
			$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
			$this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Alamat Pemegang Polis", 0, 0, 'L');
			$this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
			$this->MultiCell(($this->pg_w-($this->num_space*2))*17/25, 5, $arr["ALAMATPEMPOL"], 0, 'L', true);
			//
			$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
			$this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Macam Asuransi", 0, 0, 'L');
			$this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
			$this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, $arr["NAMAPRODUK"], 0, 1, 'L');
			//
			$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
			$this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Mulai Asuransi", 0, 0, 'L');
			$this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
			$this->SetFont('Arial','',9);
			$this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, $this->tgl_indonesia($arr["MULAS"]), 0, 1, 'L');
			//			
			$this->SetFont('Arial','B',9);
			$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
			$this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Valuta", 0, 0, 'L');
			$this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
			$this->SetFont('Arial','',9);
			$this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, $arr["NAMAVALUTA"], 0, 1, 'L');
			//
			/* tambahan untuk produk JSSPKN oleh fendy*/
			if ($kd_produk == "JSSPKN") {
				$this->SetFont('Arial','B',9);
				$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Periode Investasi", 0, 0, 'L');
				$this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
				$this->SetFont('Arial','',9);
				$this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, "12 BULAN", 0, 1, 'L');
			}
			/* akhir tambahan oleh fendy */
			//
			$this->SetFont('Arial','B',9);
			$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
			$this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Premi", 0, 0, 'L');
			$this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
			$this->SetFont('Arial','',9);
			if ($kd_cara_bayar == "X" || $kd_cara_bayar == "E" || $kd_cara_bayar == "J" || $kd_cara_bayar == "M" || $kd_cara_bayar == "HT" || $lama_premi < 5) {
				$this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, $arr['NOTASI'].".".number_format($premi1,2), 0, 1, 'L');
			}
			else if ($premi2 > 0) {
				$this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, $arr['NOTASI'].".".number_format($premi1,2,",","."), 0, 1, 'L'); // $premi_standard -> $premi1
				$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))*8/25, $height, NULL, 0, 0, 'L');
				$this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, "DAN ".$arr['NOTASI'].".".number_format($premi2,2,",",".")." UNTUK ".$sisa_lm_bayar." TAHUN BERIKUTNYA", 0, 1, 'L');
			}
			else {
				$this->Cell(($this->pg_w-($this->num_space*2))*16/25, $height, number_format($premi_standard,2,",",".")." DIBAYAR UNTUK 5 TAHUN PERTAMA", 0, 1, 'L');
			}
			//
			/* tambahan untuk produk JSSPKN topup disembunyikan oleh fendy */
			if ($kd_produk != "JSHOG" && $kd_produk != "JSSPKN") {
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
					$this->SetFont('Arial','',9);
					$this->Cell(($this->pg_w-($this->num_space*2))/25, $height, $arr['NOTASI'].".", 0, 0, 'L');
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
			$this->SetFont('Arial','',9);
			$this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, $arr["NAMACARABAYAR"], 0, 1, 'L');
			//
			
			
			
			$this->Ln(4);
			
			
			$this->SetFont('Arial','B',9);
			$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
			$this->Cell($this->pg_w-($this->num_space*2), $height, "Penerima Manfaat Asuransi", 0, 1, 'L');
			$this->SetFont('Arial','',9);
			foreach($this->ars as $value) {
				$nama = strlen($value["GELAR"]) == 0 ? $value["NAMAKLIEN1"].",".$value["GELAR"] : $value["NAMAKLIEN1"];
				$hub  = $value["KDINSURABLE"] == '04' 
					  ? ($ars["NOKLIEN"] == $ars["NOTERTANGGUNG"] ? "DIRI TERTANGGUNG" : "BELUM DIDEFINISIKAN")
					  : $ars["NAMAHUBUNGAN"];
				$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
				$this->Cell($this->pg_w-($this->num_space*2), $height, trim($value["NOURUT"]).". ".trim($value["NAMAHUBUNGAN"]).", ".trim($nama), 0, 1, 'L');
			}
			
			
			$this->Ln(4);
			
			
			// perubahan untuk nama tertanggung jika produk JS Keluarga, maka tertanggung adalah semua penerima manfaat
			// di ubah oleh fendy pada tanggal 01 September 2015
			if ($arr["KDPRODUK"] == "JSKEL") {
				$this->SetFont('Arial','B',9);
				$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, "Nama Tertanggung Utama", 0, 0, 'L');
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
					
					if ($i > 0) {						
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
			$this->Cell(($this->pg_w-($this->num_space*2))*5/25, $height*3, "Macam Asuransi", 0, 0, 'C', true);
			
			$x1 = $this->GetX();
			$y1 = $this->GetY();
			$this->MultiCell(($this->pg_w-($this->num_space*2))*3/25, 5, "Ketentuan &\nManfaat di", 0, 'C', true);
			$y2 = $this->GetY();
			$yH = $y2 - $y1;
			
			$this->SetXY($x1 + ($this->pg_w-($this->num_space*2))*3/25, $y2 - $yH);
			
			$this->Cell(($this->pg_w-($this->num_space*2))*4/25, $height*3, "Uang Asuransi", 0, 0, 'C', true);
			
			$x1 = $this->GetX();
			$y1 = $this->GetY();
			$this->MultiCell(($this->pg_w-($this->num_space*2))*4/25, 5, "Atas Diri\nTertanggung", 0, 'C', true);
			$y2 = $this->GetY();
			$yH = $y2 - $y1;
			
			$this->SetXY($x1 + ($this->pg_w-($this->num_space*2))*4/25, $y2 - $yH);
			
			$x1 = $this->GetX();
			$y1 = $this->GetY();
			$this->MultiCell(($this->pg_w-($this->num_space*2))*4/25, 5, "Tanggal\nAkhir Asuransi", 0, 'C', true);
			$this->SetXY($x, $y + $height*2);
			$this->Cell(($this->pg_w-($this->num_space*2))*20/25, $height, NULL, 0, 1, 'C', true);
			
			//$y2 = $this->GetY();
			//$yH = $y2 - $y1;
			
			
			
			$this->SetXY($x1 + ($this->pg_w-($this->num_space*2))*4/25, $y2 - $yH);
			
			$this->MultiCell(($this->pg_w-($this->num_space*2))*5/25, 5, "Tanggal Akhir\nPengenaan Biaya\nAsuransi ", 0, 'C', true);
			
			$this->SetXY($x, $y + $height*2);
			$this->Cell(($this->pg_w-($this->num_space*2))*18/25, $height, NULL, 0, 1, 'C', true);
			
			
			$this->Ln(4);
			
			
			$this->SetFont('Arial','B',9);
			$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
			$this->Cell(($this->pg_w-($this->num_space*2)), $height, "ASURANSI DASAR", 0, 1, 'L');
			$this->Ln(1);
			//
			$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
			$this->SetFont('Arial','',7);
			
			$x1 = $this->GetX();
			$y1 = $this->GetY();
			$this->MultiCell(($this->pg_w-($this->num_space*2))*5/25, 4, $arr["NAMAPRODUK"], 0, 'L');
			$y2 = $this->GetY();
			$yH = $y2 - $y1;
			
			$this->SetXY($x1 + ($this->pg_w-($this->num_space*2))*5/25, $y2 - $yH);
			
			$y = $this->GetY();
			$h = $y2 == $this->GetY ? 4 : $y2 - $y;
			/*$this->Cell(($this->pg_w-($this->num_space*2))*3/25, $h, "SUP\nKK", 0, 0, 'C');
			$this->Cell(($this->pg_w-($this->num_space*2))*4/25, $h, number_format($arr["JUAMAINPRODUK"], 2, ",", "."), 0, 0, 'R');
			$this->Cell(($this->pg_w-($this->num_space*2))*4/25, $h, $arr['MULAS'], 0, 0, 'C');
			$this->Cell(($this->pg_w-($this->num_space*2))*4/25, $h, $tgl_expirasi_p, 0, 0, 'C');
			$this->Cell(($this->pg_w-($this->num_space*2))*3/25, $h, $arr["EXPIRASI"], 0, 1, 'C');*/
			$x1 = $this->GetX();
			$y1 = $this->GetY();
			$this->MultiCell(($this->pg_w-($this->num_space*2))*3/25, $h, "SUP\nKK", 0, 'C');
			$y2 = $this->GetY();
			$yH = $y2 - $y1;
			
			$this->SetXY($x1 + ($this->pg_w-($this->num_space*2))*4/25, $y2 - $yH);
			
			$this->Cell(($this->pg_w-($this->num_space*2))*5/25, 4, number_format($arr["JUAMAINPRODUK"], 2, ",", "."), 0, 0, 'L');
			$this->Cell(($this->pg_w-($this->num_space*2))*4/25, $h, "UTAMA", 0, 0, 'L');
			$this->Cell(($this->pg_w-($this->num_space*2))*4/25, $h*2, $tgl_mulas, 0, 0, 'C');
			$this->Cell(($this->pg_w-($this->num_space*2))*4/25, $h*2, $tgl_expirasi_p, 0, 0, 'C');
			$this->Cell(($this->pg_w-($this->num_space*2))*5/25, $h*2, $arr["EXPIRASI"], 0, 1, 'C');
			
			
			$this->Ln(5);
			
			
			$this->SetFont('Arial','B',9);
			if (!empty($this->art)) {
				$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2)), $height, "Asuransi Tambahan", 0, 1, 'L');
				$this->Ln(1);
				
				$this->SetFont('Arial','',7);
				foreach($this->art as $i => $value) {
					$kdbnfx = substr($kd_produk, 0, 3) == "JL3" ? "KK ".$value['KDBNFX'] : $value['KDBNFX'];
					$mulas = substr($kd_produk, 0, 3) == "JL3" ? $tgl_mulas : trim($value["ATAS"]);
					
					$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
					
					$x1 = $this->GetX();
					$y1 = $this->GetY();
					$this->MultiCell(($this->pg_w-($this->num_space*2))*7/25, 4, trim(substr($value["NAMABENEFIT"],0,25)), 0, 'L');
					$y2 = $this->GetY();
					$yH = $y2 - $y1;
					
					$this->SetXY($x1 + ($this->pg_w-($this->num_space*2))*6/25, $y2 - $yH);
					
					$y = $this->GetY();
					$h = $y2 == $this->GetY ? 4 : $y2 - $y;
					$this->Cell(($this->pg_w-($this->num_space*2))*3/25, $h, trim($kdbnfx), 0, 0, 'L');
					$this->Cell(($this->pg_w-($this->num_space*2))*4/25, $h, number_format($value["NILAIBENEFIT"], 2, ",", "."), 0, 0, 'L');
					$this->Cell(($this->pg_w-($this->num_space*2))*4/25, $h, $mulas, 0, 0, 'C');
					$this->Cell(($this->pg_w-($this->num_space*2))*3/25, $h, $value["EXP"], 0, 0, 'C');
					$this->Cell(($this->pg_w-($this->num_space*2))*4/25, $h, $value["EXP"], 0, 1, 'C');
					$this->Ln(1);
				}
			}
		}
		
		public function LampiranPolis() {
			$this->AddPage();
			
			$arr	= $this->arr;
			$height = $this->height;
			$no_h	= 1;
			$macas	= substr($arr['KDPRODUK'], 0, 4) == 'JL4B' ? 'Regular'
					: ($arr['KDPRODUK'] == 'JL4X' ? 'Single' : null);
						
			$this->font_title('B');
			$this->Ln(12);
			$this->Cell($this->pg_w, $height, 'LAMPIRAN POLIS', 0, 1, 'C');
			$this->Cell($this->pg_w, $height, "NOMOR $this->prefix - $this->nopertanggungan", 0, 0, 'C');
		
			$this->Ln(13);
			
			if(substr($arr["KDPRODUK"], 0, 4) != "JL4B") {
				$this->font_body('B');
				$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
				$this->MultiCell($this->pg_w-($this->num_space*2), 5, 'Pilihan Jenis Dana Investasi Awal :', 0, 'J');
				
				$this->font_body();
				foreach($this->arlp as $i => $value) {
					$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
					$this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, trim($value['NAMAFUND']), 0, 0, 'L');
					$this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
					$this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, trim($value["PORSI"]).' %', 0, 1, 'L');
				}
				
				$this->Ln(5);
				
				$this->font_body('B');
				$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
				$this->MultiCell($this->pg_w-($this->num_space*2), 5, "Alokasi Dana atas Premi $macas", 0, 'J');
				$this->font_body();
				$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
				$this->MultiCell($this->pg_w-($this->num_space*2), 5, "Persentasi Porsi Dana Investasi atas Premi ".(!empty($macas) ? "$macas adalah 95%" : "adalah 95%"), 0, 'J');
				$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
				$this->MultiCell($this->pg_w-($this->num_space*2), 5, "Prosentasi Biaya Akuisisi atas Premi ".(!empty($macas) ? "$macas adalah 5%" : "adalah 5%"), 0, 'J');
				
				$this->Ln(5);
				
				$this->font_body('B');
				$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
				$this->MultiCell($this->pg_w-($this->num_space*2), 5, "Alokasi Dana atas Top Up Premi $macas", 0, 'J');
				$this->font_body();
				$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
				$this->MultiCell($this->pg_w-($this->num_space*2), 5, "Persentasi Porsi Dana Investasi atas Top Up Premi ".(!empty($macas) ? "$macas adalah 95%" : "adalah 95%"), 0, 'J');
				$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
				$this->MultiCell($this->pg_w-($this->num_space*2), 5, "Prosentasi Biaya Top Up atas Top Up Premi ".(!empty($macas) ? "$macas adalah 5%" : "adalah 5%"), 0, 'J');
			}
			else {
				$this->font_body('B');
				$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
				$this->MultiCell($this->pg_w-($this->num_space*2), 5, 'Asuransi Tambahan dan Ketentuan Khusus yang tidak berlaku', 0, 'J');
				
				$this->Ln(5);
				
				$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))*15/25, $height, 'Asuransi Tambahan', 0, 0, 'L');
				$this->Cell(($this->pg_w-($this->num_space*2))*10/25, $height, 'Ketentuan & Manfaat di', 0, 1, 'L');
				
				$this->font_body();
				foreach($this->arlp2 as $i => $value) {
					$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
					$this->Cell(($this->pg_w-($this->num_space*2))*15/25, $height, trim($value['NAMABENEFIT']), 0, 0, 'L');
					$this->Cell(($this->pg_w-($this->num_space*2))*10/25, $height, trim($value["KDBENEFIT"]), 0, 1, 'L');
				}
				
				$this->Ln(5);
				
				$this->font_body('B');
				$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
				$this->MultiCell($this->pg_w-($this->num_space*2), 5, 'Pilihan Jenis Dana Investasi Awal :', 0, 'J');
				
				$this->font_body();
				foreach($this->arlp as $i => $value) {
					$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
					$this->Cell(($this->pg_w-($this->num_space*2))*7/25, $height, trim($value['NAMAFUND']), 0, 0, 'L');
					$this->Cell(($this->pg_w-($this->num_space*2))/25, $height, ":", 0, 0, 'L');
					$this->Cell(($this->pg_w-($this->num_space*2))*17/25, $height, trim($value["PORSI"]).' %', 0, 1, 'L');
				}
				
				$this->Ln(5);
				
				$this->font_body('B');
				$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
				$this->MultiCell($this->pg_w-($this->num_space*2), 5, 'Presentase Alokasi Dana Berdasarkan Tahun Polis', 0, 'J');
				
				$this->Ln(5);
				
				$this->font_body();
				$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))*3/5, 5, 'Presentase Dana Investasi dari premi dan Top Up', 'T', 0, 'L');
				$this->Cell(($this->pg_w-($this->num_space*2))*2/5, 5, 'Presentase Biaya Akuisisi dari Premi Regular', 'T', 1, 'L');
				$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))*3/5, 5, 'Regular berdasarkan Tahun Polis', 0, 0, 'L');
				$this->Cell(($this->pg_w-($this->num_space*2))*2/5, 5, 'dan Biaya Top Up dari Top Up', 0, 1, 'L');
				$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))*3/5, 5, null, 'B', 0, 'L');
				$this->Cell(($this->pg_w-($this->num_space*2))*2/5, 5, 'Berdasarkan Tahun Polis', 'B', 1, 'L');
				
				$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, 'Tahun Polis', 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, 'Premi Regular', 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, 'Top Up Regular', 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, 'Premi Regular', 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, 'Top Up Regular', 0, 1, 'C');
				
				$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, '1', 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, '10%', 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, '95%', 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, '90%', 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, '5%', 0, 1, 'C');
				
				$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, '2', 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, '50%', 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, '95%', 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, '50%', 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, '5%', 0, 1, 'C');
				
				$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, '3', 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, '60%', 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, '95%', 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, '40%', 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, '5%', 0, 1, 'C');
				
				$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, '4', 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, '70%', 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, '95%', 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, '30%', 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, '5%', 0, 1, 'C');
				
				$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, '5', 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, '90%', 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, '95%', 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, '10%', 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, '5%', 0, 1, 'C');
				
				$this->Cell($this->num_space, $height, NULL, 0, 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, '6 dst', 'B', 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, '100%', 'B', 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, '95%', 'B', 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, '0%', 'B', 0, 'C');
				$this->Cell(($this->pg_w-($this->num_space*2))/5, 5, '5%', 'B', 1, 'C');
			}
		}
		
		private function tgl_indonesia($tanggal) {
			$tanggal = empty($tanggal) ? date('d/m/Y') : $tanggal;
			$bulan	 = array("JANUARI", "FEBRUARI", "MARET", "APRIL", "MEI", "JUNI", "JULI", "AGUSTUS", "SEPTEMBER", "OKTOBER", "NOVEMBER", "DESEMBER");
			$tgl	 = substr($tanggal, 0, 2);
			$bln	 = substr($tanggal, 3, 2);
			$thn	 = substr($tanggal, 6, 4);
			
			return $tgl." ".$bulan[$bln-1]." ".$thn;
		}
		
		private function font_title($bold = false) {
			$this->SetFont('Arial', $bold ? 'B' : '', 12);
		}
		
		private function font_body($bold = false) {
			$this->SetFont('Arial', $bold ? 'B' : '', 9);
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
	
	
	// update tgl cetak polis ke dalam sistem
	$DA	 = new Database($data['user_id'], $data['password'], $data['db']);
	$sql = "UPDATE $DBUser.tabel_214_acceptance_dokumen SET kdcetakpolis = '1', tglcetakpolis = sysdate, usercetakpolis = user
			WHERE prefixpertanggungan = '$data[prefix]'
			AND nopertanggungan = '$data[nopertanggungan]'";
	$DA->parse($sql);
	$DA->execute();

	// cek apakah ada historis cetak sebelumnya
	$sql = "select * from $DBUser.tabel_603_mutasi_pert where prefixpertanggungan = '$data[prefix]' AND nopertanggungan = '$data[nopertanggungan]' AND kdmutasi = '33'";
	$DA->parse($sql);
	$DA->execute();
	$mutasi = $DA->nextrow();
	if ($mutasi['KDMUTASI'] == '33') {
		$sqlinshist="insert into $DBUser.tabel_603_mutasi_pert (PREFIXPERTANGGUNGAN,NOPERTANGGUNGAN,KDMUTASI,TGLMUTASI,NEWNOPEMEGANGPOLIS) values ('$data[prefix]','$data[nopertanggungan]','32',sysdate,user)";
	}
	else {
		$sqlinshist="insert into $DBUser.tabel_603_mutasi_pert (PREFIXPERTANGGUNGAN,NOPERTANGGUNGAN,KDMUTASI,TGLMUTASI,NEWNOPEMEGANGPOLIS) values ('$data[prefix]','$data[nopertanggungan]','33',sysdate,user)";	
	}
	$DA->parse($sqlinshist);
	$DA->execute();
	
	// cek apakah produk yang ingin dicetak adalah produk anuitas, jika ya redirect ke cetak anuitas
	$anuitas = array('AI0', 'AI0BNI', 'ASI', 'ASIBNI', 'ASP', 'ASPBNI', 'JSAEP');
	$pa = array('PAA', 'PAB');
	$sql = "SELECT KDPRODUK FROM $DBUser.TABEL_200_PERTANGGUNGAN WHERE PREFIXPERTANGGUNGAN = '$data[prefix]' AND NOPERTANGGUNGAN = '$data[nopertanggungan]'";
	$DA->parse($sql);
	$DA->execute();
	$produk = $DA->nextrow();
	if (in_array($produk['KDPRODUK'], $anuitas)) {
		header("Location: http://$_SERVER[SERVER_ADDR]/jiwasraya/proposal/ulink/test.cetak.polis.anuitas.php?prefix=$data[prefix]&nopertanggungan=$data[nopertanggungan]");
	}
	// cek apakah produk yang ingin dicetak adalah produk pa, jika ya redirect ke cetak pa
	else if (in_array($produk['KDPRODUK'], $pa)) {
		header("Location: http://$_SERVER[SERVER_ADDR]/jiwasraya/proposal/ulink/test.cetak.sertifikat.pa.php?prefix=$data[prefix]&nopertanggungan=$data[nopertanggungan]");
	}
	else {		
		$pdf = new CetakPolis($data);
		$pdf->AliasNbPages();
		$pdf->Output();
	}
	
?>