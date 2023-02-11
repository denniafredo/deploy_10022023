<?php
	
	/*=============================================
		created by : Rizal Jihadudin
		date : 23-09-2022
		note : SEOJK - Report Nilai Tunai Unit Link 
	================================================*/

	include "../../../includes/common.php";
	include "../../includes/database.php"; 

	function createPDF($nopertanggungan){

		$DB = new Database($DBUser,$DBPass,$DBName);
	 	$DB2 = new Database($DBUser,$DBPass,$DBName);
	 	$DB3 = new Database($DBUser,$DBPass,$DBName);
	 	$DB4 = new Database($DBUser,$DBPass,$DBName);
	 	$DB5 = new Database($DBUser,$DBPass,$DBName);

	 	/*** Set Time untuk filter **/
	 	$timeToday 		= strtotime(date("Y/m/d"));

	 	/** Setelah testing, update ke yang ini **/
		$startDate 		= date("01/m/Y", strtotime("-1 month", $timeToday));
		$tglSaldoAwal 	= date("t/m/Y", strtotime("-2 month", $timeToday));
		$endDate 		= date("01/m/Y");
		/** end */

		
		/*** end Set Filter **/
		
		$nopertanggungan = $nopertanggungan;

	 	/** query untuk mendapatkan data header PDF nilai tunai **/
	 	$sql = "SELECT * FROM (
				  SELECT A.PREFIXPERTANGGUNGAN,
				         TO_CHAR (a.tglakhirpremi, 'DD/MM/YYYY') as AKHIRPREMI,
				         A.NOPERTANGGUNGAN,
				         A.NOPOLBARU,
				         NVL (A.NOPOLBARU, A.PREFIXPERTANGGUNGAN || A.NOPERTANGGUNGAN)
				             NOMOR_POLIS,
				         UPPER(B.ALAMATTAGIH01)
				             AS ALAMAT01,
				         B.ALAMATTAGIH02
				             AS ALAMAT02,
				         (SELECT NAMAKOTAMADYA
				            FROM TABEL_109_KOTAMADYA
				           WHERE KDKOTAMADYA = B.KDKOTAMADYATAGIH)
				             KOTA,
				         (SELECT NAMAPROPINSI
				            FROM TABEL_108_PROPINSI
				           WHERE KDPROPINSI = (SELECT KDPROPINSI
				                                 FROM TABEL_109_KOTAMADYA
				                                WHERE KDKOTAMADYA = B.KDKOTAMADYATAGIH))
				             PROPINSI,
				         B.KODEPOSTAGIH
				             AS KODEPOS,
				         B.NAMAKLIEN1
				             AS NAMA_PP,
				         C.NAMAKLIEN1
				             AS NAMA_TU,
				         TO_CHAR (B.TGLLAHIR, 'DDMMYYYY')
				             PASSWORD_TGLLAHIR,
				         TO_CHAR(C.TGLLAHIR, 'DD/MM/YYYY')
                               TGLLAHIR_TU,
                         (SELECT MAX(TGLSEATLED) FROM TABEL_300_HISTORIS_PREMI
		    		 WHERE PREFIXPERTANGGUNGAN=A.PREFIXPERTANGGUNGAN and NOPERTANGGUNGAN=A.NOPERTANGGUNGAN
						 ) as TGL_AKHIR_PELUNASAN_PREMI,
                         trunc(months_between(sysdate,C.TGLLAHIR)/12) USIA,
				         A.KDPRODUK,
				         (SELECT NAMAPRODUK
				            FROM TABEL_202_PRODUK
				           WHERE KDPRODUK = A.KDPRODUK)
				             NAMAPRODUK,
				         TO_CHAR (A.MULAS, 'DD/MM/YYYY')
				             MULAS,
				         A.LAMAASURANSI_BL,
				         A.LAMAASURANSI_TH,
				         A.LAMAPEMBPREMI_TH,
				         A.LAMAPEMBPREMI_BL,
				         A.JUAMAINPRODUK,
				         (SELECT NOTASI
				            FROM TABEL_304_VALUTA
				           WHERE KDVALUTA = A.KDVALUTA)
				             NOTASI,
				         A.KDSTATUSFILE,
				         (SELECT NAMASTATUSFILE
				            FROM TABEL_299_STATUS_FILE
				           WHERE KDSTATUSFILE = A.KDSTATUSFILE)
				             NAMASTATUSFILE,
				         (SELECT NAMACARABAYAR
				            FROM TABEL_305_CARA_BAYAR
				           WHERE KDCARABAYAR = A.KDCARABAYAR)
				             NAMACARABAYAR,
				         DECODE (A.KDCARABAYAR, 'X', 'X', 'B')
				             KDCARABAYAR,
				         A.PREMI1,
				         A.PREMI2,
				         CASE
				             WHEN (FLOOR (
				                         (MONTHS_BETWEEN (TO_DATE ('17/12/2021', 'DD/MM/YYYY'),
				                                          A.MULAS))
				                       / 12)) >
				                  5
				             THEN
				                 A.PREMI1
				             ELSE
				                 A.PREMI2
				         END
				             PREMI,
				         A.PREMISTD,
				         (SELECT NOACCOUNT
				            FROM TABEL_100_KLIEN_ACCOUNT
				           WHERE     PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN
				                 AND NOPERTANGGUNGAN = A.NOPERTANGGUNGAN
				                 AND JENIS = 'HH'
				                 AND KDBANK = 'BMRI')
				             NO_H2H,
				         (SELECT NOACCOUNT
				            FROM TABEL_100_KLIEN_ACCOUNT
				           WHERE     PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN
				                 AND NOPERTANGGUNGAN = A.NOPERTANGGUNGAN
				                 AND JENIS = 'VA'
				                 AND KDBANK = 'BNI')
				             NO_VA,
				         (SELECT PREMI
				            FROM TABEL_223_TRANSAKSI_PRODUK
				           WHERE     PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN
				                 AND NOPERTANGGUNGAN = A.NOPERTANGGUNGAN
				                 AND KDBENEFIT = 'BNFTOPUP')
				             PREMI_TOPUPBERKALA,
				         (SELECT PREMI
				            FROM TABEL_223_TRANSAKSI_PRODUK
				           WHERE     PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN
				                 AND NOPERTANGGUNGAN = A.NOPERTANGGUNGAN
				                 AND KDBENEFIT = 'BNFTOPUPSG')
				             PREMI_TOPUPSEKALIGUS,
				         CASE
				             WHEN (KDCARABAYAR = 'X')
				             THEN
				                 PREMISTD * 0.95
				            
				             ELSE
				                 CASE
				                     WHEN (FLOOR (
				                               MONTHS_BETWEEN (SYSDATE, TRUNC (MULAS, 'MM'))) <=
				                           '12')
				                     THEN
				                         PREMISTD * 0.1
				                     WHEN     (FLOOR (
				                                   MONTHS_BETWEEN (SYSDATE,
				                                                   TRUNC (MULAS, 'MM'))) >
				                               '12')
				                          AND (FLOOR (
				                                   MONTHS_BETWEEN (SYSDATE,
				                                                   TRUNC (MULAS, 'MM'))) <=
				                               '24')
				                     THEN
				                         PREMISTD * 0.5
				                     WHEN     (FLOOR (
				                                   MONTHS_BETWEEN (SYSDATE,
				                                                   TRUNC (MULAS, 'MM'))) >
				                               '24')
				                          AND (FLOOR (
				                                   MONTHS_BETWEEN (SYSDATE,
				                                                   TRUNC (MULAS, 'MM'))) <=
				                               '36')
				                     THEN
				                         PREMISTD * 0.6
				                     WHEN     (FLOOR (
				                                   MONTHS_BETWEEN (SYSDATE,
				                                                   TRUNC (MULAS, 'MM'))) >
				                               '36')
				                          AND (FLOOR (
				                                   MONTHS_BETWEEN (SYSDATE,
				                                                   TRUNC (MULAS, 'MM'))) <=
				                               '48')
				                     THEN
				                         PREMISTD * 0.7
				                     WHEN     (FLOOR (
				                                   MONTHS_BETWEEN (SYSDATE,
				                                                   TRUNC (MULAS, 'MM'))) >
				                               '48')
				                          AND (FLOOR (
				                                   MONTHS_BETWEEN (SYSDATE,
				                                                   TRUNC (MULAS, 'MM'))) <=
				                               '60')
				                     THEN
				                         PREMISTD * 0.9
				                     ELSE
				                         PREMISTD
				                 END
				         END
				             AS INVESTASI_PREMI,
				         (SELECT PREMI * 0.95
				            FROM TABEL_223_TRANSAKSI_PRODUK
				           WHERE     PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN
				                 AND NOPERTANGGUNGAN = A.NOPERTANGGUNGAN
				                 AND KDBENEFIT = 'BNFTOPUP')
				             AS INVESTASI_TOPUPBERKALA,
				         (SELECT PREMI * 0.95
				            FROM TABEL_223_TRANSAKSI_PRODUK
				           WHERE     PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN
				                 AND NOPERTANGGUNGAN = A.NOPERTANGGUNGAN
				                 AND KDBENEFIT = 'BNFTOPUPSG')
				             AS INVESTASI_TOPUPSEKALIGUS,
				                 (SELECT   sum(TO_NUMBER (FORMULA.runy (
				                                  A1.PREFIXPERTANGGUNGAN,
				                                  A1.NOPERTANGGUNGAN,
				                                    TO_DATE (TO_CHAR(C.TGLLAHIR,'DDMM')
				                                    ||TO_CHAR(SYSDATE,'YYYY'), 'DD/MM/YYYY'),
				                                  REPLACE (RUMUS, 'UABNF', A1.NILAIBENEFIT)))
				                 * porsi
				                 / 100) NIL
				            FROM TABEL_223_TRANSAKSI_PRODUK A1,
				                 TABEL_206_PRODUK_BENEFIT  B1,
				                 TABEL_224_RUMUS           C1,
				                 TABEL_200_PERTANGGUNGAN   E1,
				                 TABEL_UL_OPSI_FUND D1
				           WHERE     A1.PREFIXPERTANGGUNGAN = D1.PREFIXPERTANGGUNGAN
				                 AND A1.NOPERTANGGUNGAN = E1.NOPERTANGGUNGAN
				                 AND A1.PREFIXPERTANGGUNGAN = E1.PREFIXPERTANGGUNGAN
				                 AND A1.NOPERTANGGUNGAN = D1.NOPERTANGGUNGAN
				                 AND B1.KDRUMUSPREMI = C1.KDRUMUS
				                 AND A1.KDPRODUK = B1.KDPRODUK
				                 AND A1.KDBENEFIT = B1.KDBENEFIT
				                 AND A1.PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN
				                 AND A1.NOPERTANGGUNGAN = A.NOPERTANGGUNGAN
				                 AND A1.KDJENISBENEFIT = 'R')
				             AS COR,
				                (SELECT   sum(TO_NUMBER (FORMULA.runy (
				                                  AA.PREFIXPERTANGGUNGAN,
				                                  AA.NOPERTANGGUNGAN,
				                                    TO_DATE (TO_CHAR(C.TGLLAHIR,'DDMM')
				                                    ||TO_CHAR(SYSDATE,'YYYY'), 'DD/MM/YYYY'),
				                                  REPLACE (RUMUS, 'UABNF', AA.NILAIBENEFIT)))
				                 * porsi
				                 / 100)    NILAI
				            FROM TABEL_223_TRANSAKSI_PRODUK AA,
				                 TABEL_206_PRODUK_BENEFIT  BB,
				                 TABEL_224_RUMUS           CC,
				                 TABEL_200_PERTANGGUNGAN   EE,
				                 TABEL_UL_OPSI_FUND DD
				           WHERE     AA.PREFIXPERTANGGUNGAN = DD.PREFIXPERTANGGUNGAN
				                 AND AA.NOPERTANGGUNGAN = EE.NOPERTANGGUNGAN
				                 AND AA.PREFIXPERTANGGUNGAN = EE.PREFIXPERTANGGUNGAN
				                 AND AA.NOPERTANGGUNGAN = DD.NOPERTANGGUNGAN
				                 AND BB.KDRUMUSPREMI = CC.KDRUMUS
				                 AND AA.KDPRODUK = BB.KDPRODUK
				                 AND AA.KDBENEFIT = BB.KDBENEFIT
				                 AND AA.PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN
				                 AND AA.NOPERTANGGUNGAN = A.NOPERTANGGUNGAN
				                 AND AA.KDBENEFIT IN ('COI'))
				             AS COI,
				         (SELECT   sum(TO_NUMBER (FORMULA.runy (
				                                  AA.PREFIXPERTANGGUNGAN,
				                                  AA.NOPERTANGGUNGAN,
				                                    TO_DATE (TO_CHAR(C.TGLLAHIR,'DDMM')
				                                    ||TO_CHAR(SYSDATE,'YYYY'), 'DD/MM/YYYY')
				                                  + INTERVAL '1' YEAR,
				                                  REPLACE (RUMUS, 'UABNF', AA.NILAIBENEFIT)))
				                 * porsi
				                 / 100)    NILAI
				            FROM TABEL_223_TRANSAKSI_PRODUK AA,
				                 TABEL_206_PRODUK_BENEFIT  BB,
				                 TABEL_224_RUMUS           CC,
				                 TABEL_200_PERTANGGUNGAN   EE,
				                 TABEL_UL_OPSI_FUND DD
				           WHERE     AA.PREFIXPERTANGGUNGAN = DD.PREFIXPERTANGGUNGAN
				                 AND AA.NOPERTANGGUNGAN = EE.NOPERTANGGUNGAN
				                 AND AA.PREFIXPERTANGGUNGAN = EE.PREFIXPERTANGGUNGAN
				                 AND AA.NOPERTANGGUNGAN = DD.NOPERTANGGUNGAN
				                 AND BB.KDRUMUSPREMI = CC.KDRUMUS
				                 AND AA.KDPRODUK = BB.KDPRODUK
				                 AND AA.KDBENEFIT = BB.KDBENEFIT
				                 AND AA.PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN
				                 AND AA.NOPERTANGGUNGAN = A.NOPERTANGGUNGAN
				                 AND AA.KDBENEFIT IN ('COI'))
				             AS COI_1THN,
				         (SELECT   sum(TO_NUMBER (FORMULA.runy (
				                                  A1.PREFIXPERTANGGUNGAN,
				                                  A1.NOPERTANGGUNGAN,
				                                    TO_DATE (TO_CHAR(C.TGLLAHIR,'DDMM')
				                                    ||TO_CHAR(SYSDATE,'YYYY'), 'DD/MM/YYYY')
				                                  + INTERVAL '1' YEAR,
				                                  REPLACE (RUMUS, 'UABNF', A1.NILAIBENEFIT)))
				                 * porsi
				                 / 100) NIL
				            FROM TABEL_223_TRANSAKSI_PRODUK A1,
				                 TABEL_206_PRODUK_BENEFIT  B1,
				                 TABEL_224_RUMUS           C1,
				                 TABEL_200_PERTANGGUNGAN   E1,
				                 TABEL_UL_OPSI_FUND D1
				           WHERE     A1.PREFIXPERTANGGUNGAN = D1.PREFIXPERTANGGUNGAN
				                 AND A1.NOPERTANGGUNGAN = E1.NOPERTANGGUNGAN
				                 AND A1.PREFIXPERTANGGUNGAN = E1.PREFIXPERTANGGUNGAN
				                 AND A1.NOPERTANGGUNGAN = D1.NOPERTANGGUNGAN
				                 AND B1.KDRUMUSPREMI = C1.KDRUMUS
				                 AND A1.KDPRODUK = B1.KDPRODUK
				                 AND A1.KDBENEFIT = B1.KDBENEFIT
				                 AND A1.PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN
				                 AND A1.NOPERTANGGUNGAN = A.NOPERTANGGUNGAN
				                 AND A1.KDJENISBENEFIT = 'R')
				             AS COR_1THN
				    FROM TABEL_200_PERTANGGUNGAN A
				         INNER JOIN TABEL_100_KLIEN B ON B.NOKLIEN = A.NOPEMEGANGPOLIS
				         INNER JOIN TABEL_100_KLIEN C ON C.NOKLIEN = A.NOTERTANGGUNG
				   WHERE (   A.PREFIXPERTANGGUNGAN || A.NOPERTANGGUNGAN = '$nopertanggungan'
				          OR A.NOPOLBARU = '$nopertanggungan') ) z
				    GROUP BY z.PREFIXPERTANGGUNGAN,
				            z.AKHIRPREMI,
				            z.NOPERTANGGUNGAN,
				            z.NOPOLBARU,
				            z.NOMOR_POLIS,
				            z.ALAMAT01,
				            z.ALAMAT02,
				            z.KOTA,
				            z.PROPINSI,
				            z.KODEPOS,
				            z.NAMA_PP,
				            z.NAMA_TU,
				            z.PASSWORD_TGLLAHIR,
				            z.TGLLAHIR_TU,
				            Z.TGL_AKHIR_PELUNASAN_PREMI,
				            z.USIA,
				            z.KDPRODUK,
				            z.NAMAPRODUK,
				            z.MULAS,
				            z.LAMAASURANSI_BL,
				            z.LAMAASURANSI_TH,
				            z.LAMAPEMBPREMI_BL,
				            z.LAMAPEMBPREMI_TH,
				            z.JUAMAINPRODUK,
				            z.NOTASI,
				            z.KDSTATUSFILE,
				            z.NAMASTATUSFILE,
				            z.NAMACARABAYAR,
				            z.KDCARABAYAR,
				            z.PREMI1,
				            z.PREMI2,
				            z.PREMI,
				            z.PREMISTD,
				            z.NO_H2H,
				            z.NO_VA,
				            z.PREMI_TOPUPBERKALA,
				            z.PREMI_TOPUPSEKALIGUS,
				            z.INVESTASI_PREMI,
				            z.INVESTASI_TOPUPBERKALA,
				            z.INVESTASI_TOPUPSEKALIGUS,
				            z.COR,
				            z.COI,
				            z.COI_1THN,
				            z.COR_1THN";

		$DB->parse($sql);
	    $DB->execute();
	    $arr=$DB->nextrow(); 
	    /** end query **/

	    $noper = $arr["PREFIXPERTANGGUNGAN"].$arr["NOPERTANGGUNGAN"];


	    require_once('../../pelaporan/libs/fpdf/fpdf_1.81.php');
	    require_once('../../pelaporan/libs/fpdf/fpdf_protection.php');

	    $pdf = new FPDF('P','mm','A4');
	   	$pdf = new FPDF_Protection();
	   	$pdf->SetProtection(array('print'),$arr["PASSWORD_TGLLAHIR"]);

	   	/** Menghitung usia **/
	    $age = $arr['USIA'];

	   	$pdf->AddPage();

	   	$pdf->ln(15);
	    $pdf->SetLeftMargin(20);

	    $pdf->SetTitle('Laporan Perkembangan Nilai Tunai');
	    
	    $logo_ifg = '../../restru/img/logo_ifg.png';
		$garis = '../../restru/img/garis.png';
	    $pdf->Image($logo_ifg, 20, 5, 40, 17);
	    $pdf->Image($garis, 20, 24, 170, 0.8);

	    $pdf->ln(2);
	    $pdf->SetDrawColor(235, 131, 5);
		$pdf->SetFont('Arial','B',8);
	    $pdf->Cell(6,4,$arr['NAMA_PP'],0,0,'L');
	    $pdf->ln(7);

	    $pdf->ln(2);
	    $pdf->SetDrawColor(235, 131, 5);
		$pdf->SetFont('Arial','',8);
	    $pdf->MultiCell(80,4,$arr['ALAMAT01'],0,'L');
	    $pdf->ln(3);

	    $pdf->ln(2);
	    $pdf->SetDrawColor(235, 131, 5);
		$pdf->SetFont('Arial','B',8);
	    $pdf->MultiCell(185, 5, 'LAPORAN PERKEMBANGAN NILAI TUNAI', 0, 'C');
	    $pdf->ln(2);

	    $pdf->ln(2);
	    $pdf->SetDrawColor(235, 131, 5);
		$pdf->SetFont('Arial','B',8);
	    $pdf->Cell(6,4,'Data Polis',0,0,'L');

	    $pdf->SetFont('Arial','',6);
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell(34,5,'Nomor Polis',0,0,'L');
		$pdf->Cell(3,5,':',0,0,'L');
		$pdf->Cell(45,5,$arr['NOMOR_POLIS'],0,0,'L');

			

		if ($arr['NAMACARABAYAR'] == 'SEKALIGUS' ||  $arr['NAMACARABAYAR'] == 'Sekaligus') {
			
			$pdf->Cell(72,5,'Alokasi Dana Investasi dari Premi Single',0,0,'L');
			$pdf->Cell(3,5,':',0,0,'L');
			$pdf->Cell(30,5,'Rp'.number_format($arr['INVESTASI_PREMI'],2,',','.'),0,0,'L');
		}else{
			$pdf->Cell(72,5,'Alokasi Dana Investasi dari Premi Reguler',0,0,'L');
			$pdf->Cell(3,5,':',0,0,'L');
			$pdf->Cell(30,5,'Rp'.number_format($arr['INVESTASI_PREMI'],2,',','.'),0,0,'L');
		}

		$pdf->Ln();
		$pdf->Cell(34,5,'Nama Pemegang Polis',0,0,'L');
		$pdf->Cell(3,5,':',0,0,'L');
		$pdf->Cell(45,5,$arr['NAMA_PP'],0,0,'L');

		if ($arr['NAMACARABAYAR'] == 'SEKALIGUS' ||  $arr['NAMACARABAYAR'] == 'Sekaligus') {
			
			$pdf->Cell(72,5,'Alokasi Dana Investasi dari Top Up Premi Single',0,0,'L');
			$pdf->Cell(3,5,':',0,0,'L');
			$pdf->Cell(30,5,'Rp'.number_format($arr['INVESTASI_TOPUPSEKALIGUS'],2,',','.'),0,0,'L');

		}else{

			$pdf->Cell(72,5,'Alokasi Dana Investasi dari Top Up Premi Reguler',0,0,'L');
			$pdf->Cell(3,5,':',0,0,'L');
			$pdf->Cell(30,5,'Rp'.number_format($arr['INVESTASI_TOPUPBERKALA'],2,',','.'),0,0,'L');
		}

		$pdf->Ln();
		$pdf->Cell(34,5,'Nama Tertanggung',0,0,'L');
		$pdf->Cell(3,5,':',0,0,'L');
		$pdf->Cell(45,5,$arr['NAMA_TU'],0,0,'L');
		$pdf->Cell(72,5,'Biaya Administrasi*',0,0,'L');
		$pdf->Cell(3,5,':',0,0,'L');
		$pdf->Cell(30,5,'Rp27.500,00',0,0,'L');
		$pdf->Ln();
		$pdf->Cell(34,5,'Jenis Produk',0,0,'L');
		$pdf->Cell(3,5,':',0,0,'L');
		$pdf->Cell(45,5,$arr['NAMAPRODUK'],0,0,'L');
		$pdf->Cell(72,5,'Biaya Asuransi Dasar usia '.$age.' tahun*',0,0,'L');
		$pdf->Cell(3,5,':',0,0,'L');

		/** Replace COI number format **/
		if($arr['COI'] != '' || $arr['COI'] != null || $arr['COI'] != '0'){
			$coi = str_replace(',', '.', $arr['COI']);
		}else{
			$coi = 0;
		}
		/** end Replace COI **/

		$pdf->Cell(30,5,'Rp'.number_format($coi,2,',','.'),0,0,'L');
		$pdf->Ln();
		$pdf->Cell(34,5,'Status Polis',0,0,'L');
		$pdf->Cell(3,5,':',0,0,'L');
		$pdf->Cell(45,5,$arr['NAMASTATUSFILE'],0,0,'L');
		$pdf->Cell(72,5,'Biaya Asuransi Dasar usia '.intval($age+1).' tahun*',0,0,'L');
		$pdf->Cell(3,5,':',0,0,'L');

		/** Replace COI 1thn number format **/
		if($arr['COI_1THN'] != '' || $arr['COI_1THN'] != null || $arr['COI_1THN'] != '0'){
			$n1 = str_replace(',', '.', $arr['COI_1THN']);
		}else{
			$n1 = 0;
		}
		/** end Replace **/

		$pdf->Cell(30,5,'Rp'.number_format($n1,2,',','.'),0,0,'L');
		$pdf->Ln();
		$pdf->Cell(34,5,'Cara Bayar Premi',0,0,'L');
		$pdf->Cell(3,5,':',0,0,'L');
		$pdf->Cell(45,5,$arr['NAMACARABAYAR'],0,0,'L');
		$pdf->Cell(72,5,'Biaya Asuransi Tambahan usia '.$age.' tahun*',0,0,'L');
		$pdf->Cell(3,5,':',0,0,'L');

		/*** Replace COR number format **/
		if($arr['COR'] != '' || $arr['COR'] != null || $arr['COR'] != '0'){
			$cor = str_replace(',', '.', $arr['COR']);
		}else{
			$cor = 0;
		}

		$pdf->Cell(30,5,'Rp'.number_format($cor,2,',','.'),0,0,'L');
		$pdf->Ln();
		$pdf->Cell(34,5,'Pelunasan Premi Terakhir',0,0,'L');
		$pdf->Cell(3,5,':',0,0,'L');
		$pdf->Cell(45,5,date("d/m/Y", strtotime($arr['TGL_AKHIR_PELUNASAN_PREMI'])),0,0,'L');
		$pdf->Cell(72,5,'Biaya Asuransi Tambahan usia '.intval($age+1).' tahun*',0,0,'L');
		$pdf->Cell(3,5,':',0,0,'L');

		if($arr['COR_1THN'] != '' || $arr['COR_1THN'] != null || $arr['COR_1THN'] != '0'){
			$n2 = str_replace(',', '.', $arr['COR_1THN']);
		}else{
			$n2 = 0;
		}

		$pdf->Cell(30,5,'Rp'.number_format($n2,2,',','.') ,0,0,'L');
		$pdf->Ln();

		if ($arr['NAMACARABAYAR'] == 'SEKALIGUS' ||  $arr['NAMACARABAYAR'] == 'Sekaligus') {

			$pdf->Cell(34,5,'Premi Single',0,0,'L');
			$pdf->Cell(3,5,':',0,0,'L');
			$pdf->Cell(45,5,'Rp'.number_format($arr['PREMISTD'],2,',','.'),0,0,'L');

		}else{

			$pdf->Cell(34,5,'Premi Reguler',0,0,'L');
			$pdf->Cell(3,5,':',0,0,'L');
			$pdf->Cell(45,5,'Rp'.number_format($arr['PREMISTD'],2,',','.'),0,0,'L');
		}

		$pdf->Cell(72,5,'Tanggal Cetak',0,0,'L');
		$pdf->Cell(3,5,':',0,0,'L');
		$pdf->Cell(30,5,date('d/m/Y'),0,0,'L');
		$pdf->Ln();
			
		if ($arr['NAMACARABAYAR'] == 'SEKALIGUS' ||  $arr['NAMACARABAYAR'] == 'Sekaligus') {
			$txt = 'Single';
			$premiTopup = $arr['PREMI_TOPUPSEKALIGUS'];
		}else{
			$txt = 'Reguler';
			$premiTopup = $arr['PREMI_TOPUPBERKALA'];
		}

		$pdf->Cell(34,5,'Top Up '.$txt,0,0,'L');
		$pdf->Cell(3,5,':',0,0,'L');
		$pdf->Cell(45,5,'Rp'.number_format($premiTopup,2,',','.'),0,0,'L');
		$pdf->Cell(72,5,'Periode Laporan',0,0,'L');
		$pdf->Cell(3,5,':',0,0,'L');
		$pdf->Cell(30,5,$startDate.' - '.$endDate,0,0,'L');
		$pdf->Ln();
		$pdf->Cell(34,5,'Uang Asuransi',0,0,'L');
		$pdf->Cell(3,5,':',0,0,'L');
		$pdf->Cell(45,5,'Rp'.number_format($arr['JUAMAINPRODUK'],2,',','.'),0,0,'L');
		$pdf->Ln(3);
		$pdf->Ln();
		$pdf->SetFont('Arial','B',6);
		$pdf->Cell(6,4,'*Biaya per bulan',0,0,'L');
		$pdf->Ln();
	  	$pdf->SetFont('Arial','B',6);
	    // Background color
	    $pdf->SetFillColor(0,0,0);
	    $pdf->SetTextColor(255,255,255);
	    // Title
	    $pdf->Cell(25,8,"Tgl Transaksi",0,0,'C',true);
	    $pdf->Cell(20,8,"Kode Transaksi",0,0,'C', true);
	    $pdf->Cell(35,8,"Keterangan",0,0,'C', true);
	    $pdf->Cell(25,8,"Jumlah (Rp)",0,0,'C', true);
	    $pdf->Cell(25,8,"Nilai Aktiva Bersih (NAB)",0,0,'C', true);
	    $pdf->Cell(25,8,"Jumlah (Unit)",0,0,'C', true);
	    $pdf->Cell(25,8,"Nilai Tunai (Rp)",0,0,'C', true);
	    $pdf->Ln();

	    /** Get Kode FUnd **/
	    $sql = "SELECT b.kdfund,b.namafund,a.porsi ||'%' porsi from tabel_ul_opsi_fund a,tabel_ul_kode_fund b where a.prefixpertanggungan='".$arr["PREFIXPERTANGGUNGAN"]."' and a.nopertanggungan='".$arr["NOPERTANGGUNGAN"]."' and a.kdfund=b.kdfund";
			//echo $sql;
		$DB2->parse($sql);
		$DB2->execute();
		/** end get kode fund **/

		$time 				= strtotime(date("Y/m/d"));
		$tglNab 			= date("01/m/Y", strtotime("-1 month", $time));
		$final 				= date("t/m/Y", strtotime("-1 month", $time));
		$totalUnitNilaiAwal = 0;
		$totalAllUnit		= 0;
		$allNilaiTunai		= 0;


		while ($arr2=$DB2->nextrow()){

	    		/** get nilai tunai saldo awal **/
	    		$msquery = " SELECT   id_nasabah,
								 nomor_polis,
								 TO_CHAR(trx_date, 'DD/MM/YYYY') AS tgltrans,
								 trx_date,
								 rp_nett,
								 TO_CHAR(tgl_nab, 'DD/MM/YYYY')AS tgl_nab,
								 nab_beli,
								 unit,
								 rp_gross,
								 trx_type,
								 premi,
								 fee_agent,
								 fee_premi,
								 fee_subcription,
								 fee_topup,
								 fee_redemption,
								 nab_jual,
								 kode_fund,
								 tgl_proses,
								 tgl_verifikasi,
								 description,
								 (SELECT   keterangan
									FROM    TABEL_UL_ST_PROSES
								   WHERE       trx_type = a.trx_type
										   AND st_proses = a.st_proses
										   AND status = a.status
										   AND deskripsi = SUBSTR (a.description, 1,12))
									status
						  FROM   TABEL_UL_TRANSAKSI a
						 WHERE   status IN ('GOOD FUND', 'SEND', 'NEW') and nomor_polis='$noper'and st_proses<>'X' AND SUBSTR(kode_fund,-2)='".$arr2["KDFUND"]."'
						 	AND trx_date <= TO_DATE ('$tglSaldoAwal', 'DD/MM/YYYY')
						  ORDER BY trx_date";

				$DB4->parse($msquery);
				$DB4->execute();
				$saldoAwalx = $DB4->result();
				/** end query **/

				$tanggalZZ = date("01-m-Y", strtotime("-1 month", $timeToday));

				/** cuma buat testing bang **/
				$tanggalX 	= '';
				$kondisi 	= '';
				$tanggalV	= '';

				/*=====================================
					Untuk kondisi < 1 bulan beli polis
				=====================================*/
				if(count($saldoAwalx <= 0)){

					$kondisi = 'sebulan';

					/** untuk mengambil tanggal 1 di bulan tersebut */
					$startDate2		= date("01/m/Y");
					$tglSaldoAwal2 	= date("t/m/Y");
					/** end untuk mengambil */

					$msquery = " SELECT   id_nasabah,
								 nomor_polis,
								 TO_CHAR(trx_date, 'DD/MM/YYYY') AS tgltrans,
								 trx_date,
								 rp_nett,
								 TO_CHAR(tgl_nab, 'DD/MM/YYYY')AS tgl_nab,
								 nab_beli,
								 unit,
								 rp_gross,
								 trx_type,
								 premi,
								 fee_agent,
								 fee_premi,
								 fee_subcription,
								 fee_topup,
								 fee_redemption,
								 nab_jual,
								 kode_fund,
								 tgl_proses,
								 tgl_verifikasi,
								 description,
								 (SELECT   keterangan
									FROM    TABEL_UL_ST_PROSES
								   WHERE       trx_type = a.trx_type
										   AND st_proses = a.st_proses
										   AND status = a.status
										   AND deskripsi = SUBSTR (a.description, 1,12))
									status
						  FROM   TABEL_UL_TRANSAKSI a
						 WHERE   status IN ('GOOD FUND', 'SEND', 'NEW') 
						 	and nomor_polis='$noper'
						 	and st_proses<>'X' 
						 	AND SUBSTR(kode_fund,-2)='".$arr2["KDFUND"]."'
						 	AND trx_date <= TO_DATE ('$tglSaldoAwal2', 'DD/MM/YYYY')
						 	AND DESCRIPTION LIKE 'SUBSCRIPTION%'
						  ORDER BY trx_date";

						$DB4->parse($msquery);
						$DB4->execute();
						$saldoAwal = $DB4->result();


					$queryKdFund = "SELECT id_nasabah,
	         				nomor_polis,
					         TO_CHAR (trx_date, 'DD-MM-YYYY') AS tgltrans,
					         trx_date,
					         rp_nett,
					         TO_CHAR (tgl_nab, 'DD/MM/YYYY') AS tgl_nab,
					         nab_beli,
					         unit,
					         rp_gross,
					         trx_type,
					         premi,
					         fee_agent,
					         fee_premi,
					         fee_subcription,
					         fee_topup,
					         fee_redemption,
					         nab_jual,
					         kode_fund,
					         tgl_proses,
					         tgl_verifikasi,
					         description,
					         substr(DESCRIPTION, 16) as tgl_desc,
					         (SELECT keterangan
					            FROM TABEL_UL_ST_PROSES
					           WHERE     trx_type = a.trx_type
					                 AND st_proses = a.st_proses
					                 AND status = a.status
					                 AND deskripsi = SUBSTR (a.description, 1, 12))    status
							    FROM TABEL_UL_TRANSAKSI a
							   WHERE     status IN ('GOOD FUND', 'SEND', 'NEW')
							   		AND trx_date BETWEEN TO_DATE ('$startDate2', 'DD/MM/YYYY')
							        AND TO_DATE ('$tglSaldoAwal2', 'DD/MM/YYYY')
						       and nomor_polis='$noper' "."and st_proses<>'X' AND SUBSTR(kode_fund,-2)='".$arr2["KDFUND"]."' ORDER BY trx_date";     
						$DB3->parse($queryKdFund);
			    		$DB3->execute();
			    		$aru = $DB3->result();

			    		/** to get Nilai Saldo Awal **/
						foreach ($saldoAwal as $saldoAwal) {

							/** get data Unit saldo Awal **/
							if($saldoAwal["TRX_TYPE"]=="S"){
								$totalUnitNilaiAwal += str_replace(',', '.', $saldoAwal["UNIT"]);
								$tanggalX = $saldoAwal['TRX_DATE'];
						 	}
								
							
							/** get data NAB saldo Awal **/
							$nabBeliNilaiAwal = str_replace(',', '.', $saldoAwal["NAB_BELI"]);
						}

						$tanggalX = date("d-m-Y", strtotime($tanggalX));

				}else{

					$kondisi = 'lebih sebulan';
					$saldoAwal = $saldoAwalx;
					/** to get Nilai Saldo Awal **/
					foreach ($saldoAwal as $saldoAwal) {

						/** get data Unit saldo Awal **/
						if($saldoAwal["TRX_TYPE"]=="T" or $saldoAwal["TRX_TYPE"]=="S"){
							$totalUnitNilaiAwal += str_replace(',', '.', $saldoAwal["UNIT"]);
					 	}elseif($saldoAwal["TRX_TYPE"]=="R" or $saldoAwal["TRX_TYPE"]=="C"){
					 		 $totalUnitNilaiAwal -= str_replace(',', '.', $saldoAwal["UNIT"]);
						}
						/** get data NAB saldo Awal **/
						$nabBeliNilaiAwal = str_replace(',', '.', $saldoAwal["NAB_BELI"]);
					}

					$tanggalX = date("01-m-Y", strtotime("-1 month", $timeToday));

								/** Query get data for KDFUND **/
					$queryKdFund = "SELECT id_nasabah,
	         				nomor_polis,
				         TO_CHAR (trx_date, 'DD-MM-YYYY') AS tgltrans,
				         trx_date,
				         rp_nett,
				         TO_CHAR (tgl_nab, 'DD/MM/YYYY') AS tgl_nab,
				         nab_beli,
				         unit,
				         rp_gross,
				         trx_type,
				         premi,
				         fee_agent,
				         fee_premi,
				         fee_subcription,
				         fee_topup,
				         fee_redemption,
				         nab_jual,
				         kode_fund,
				         tgl_proses,
				         tgl_verifikasi,
				         description,
				         substr(DESCRIPTION, 16) as tgl_desc,
				         (SELECT keterangan
				            FROM TABEL_UL_ST_PROSES
				           WHERE     trx_type = a.trx_type
				                 AND st_proses = a.st_proses
				                 AND status = a.status
				                 AND deskripsi = SUBSTR (a.description, 1, 12))    status
				    FROM TABEL_UL_TRANSAKSI a
				   WHERE     status IN ('GOOD FUND')
				   		AND trx_date BETWEEN TO_DATE ('$startDate', 'DD/MM/YYYY')
				        AND TO_DATE ('$endDate', 'DD/MM/YYYY')
				       and nomor_polis='$noper' "."and st_proses<>'X' AND SUBSTR(kode_fund,-2)='".$arr2["KDFUND"]."' ORDER BY trx_date";
				$DB3->parse($queryKdFund);
	    		$DB3->execute();
	    		$aru = $DB3->result();
	    		/** end query **/


				}
				/*====================================
					end kondisi
				=====================================*/
				

				$jumlahNilaiAwal 	= ($nabBeliNilaiAwal*$totalUnitNilaiAwal);
				$totalAllUnit 		= $totalUnitNilaiAwal;

			$pdf->SetFont('Arial','',6);
		    $pdf->SetFillColor(255,255,255);
		    $pdf->SetTextColor(0,0,0);
		    $pdf->Cell(6,4,'Jenis Dana Investasi',0,0,'L');
		    $pdf->Ln();
		    $pdf->SetFont('Arial','B',6);
		   	$pdf->SetFillColor(255,255,255);
		    $pdf->SetTextColor(0,0,0);
		    $pdf->Cell(6,4,$arr2["NAMAFUND"].' '.$arr2["PORSI"],0,0,'L');
		    $pdf->Ln();
		    $pdf->SetFont('Arial','',8);
		    $pdf->SetFillColor(255,255,255);
		    $pdf->SetTextColor(0,0,0);
		    // $pdf->Cell(25,8,date("01-m-Y", strtotime("-1 month", $timeToday)),0,0,'C',true);
		    $pdf->Cell(25,8,$tanggalX,0,0,'C',true);
		    $pdf->Cell(20,8,'SA',0,0,'C', true);
		    $pdf->Cell(35,8,'Saldo Awal',0,0,'C', true);
		    $pdf->Cell(25,8,number_format($jumlahNilaiAwal,2,",","."),0,0,'C', true);
		    $pdf->Cell(25,8,number_format($nabBeliNilaiAwal,4,",","."),0,0,'C', true);
		    $pdf->Cell(25,8,number_format($totalUnitNilaiAwal,4,",","."),0,0,'C', true);
		    $pdf->Cell(25,8," ",0,0,'C', true);
		    $pdf->Ln();


		    /** buat dapetin data selain saldo Awal **/
		    $nilaiAwalSubs 	= '-';
			$nabBeliSubs 	= '-';
			$totalUnitSubs 	= '-';
			$trxDateSubs	= '';

		    $nilaiAwalTopUp 	= '-';
		    $nabBeliTopUp		= '-';
		    $totalUnitTopUp		= '-';
		    $trxDateTopUp		= '';

		    $nilaiAwalTopUp = '-';
			$nabBeliTopUp 	= '-';
			$totalUnitTopUp = '-';
			$trxDateTopUp	= '';

			$nilaiAwalCoa 	= '-';
			$nabBeliCoa 	= '-';
			$totalUnitCoa 	= '-';
			$trxDateCoa		= '';

			$nilaiAwalCor 	= '-';
			$nabBeliCor 	= '-';
			$totalUnitCor 	= '-';
			$trxDateCor		= '';

			$nilaiAwalCoi 	= '-';
			$nabBeliCoi 	= '-';
			$totalUnitCoi 	= '-';
			$trxDateCoi		= ''; 

			$jt 			= '';
			$kt 			= '';
			$tglKet 		= '';
			$nmbr 			= 0;
		    foreach($aru as $key){
		    		
		    	if(strpos($key['DESCRIPTION'], 'SUBSCRIPTION') !== false || strpos($key['DESCRIPTION'], 'Subscription') !== false){
		    		$tglKet 	= substr($key['TGL_DESC'], 1, 10);
			    	$ztglKet 	= strtotime($tglKet);
			    	$xtglKet	= date("d-m-Y", $ztglKet);
					$jt = 'Nilai Investasi dari Premi ('.$xtglKet.')';
					$kt = 'I';
				}


				if(strpos($key['DESCRIPTION'], 'TOPUP') !== false ){
					$tglKet 	= substr($key['TGL_DESC'], 1, 10);
			    	$ztglKet 	= strtotime($tglKet);
			    	$xtglKet	= date("d-m-Y", $ztglKet);
					$jt = 'Nilai Investasi Top Up Premi ('.$xtglKet.')';
					$kt = 'TU';
				}

				if(strpos($key['DESCRIPTION'], 'COA') !== false){
					$tglKet 	= substr($key['TGL_DESC'], 1, 10);
			    	$ztglKet 	= strtotime($tglKet);
			    	$xtglKet	= date("d-m-Y", $ztglKet);
					$jt = 'Biaya Administrasi ('.$xtglKet.')';
					$kt = 'CA';
				}

				if(strpos($key['DESCRIPTION'], 'COR') !== false){
					$tglKet 	= substr($key['TGL_DESC'], 1, 10);
			    	$ztglKet 	= strtotime($tglKet);
			    	$xtglKet	= date("d-m-Y", $ztglKet);
					$jt = 'Biaya Asuransi Rider ('.$xtglKet.')';
					$kt = 'CR';
				}

				if(strpos($key['DESCRIPTION'], 'COI') !== false){
					$tglKet 	= substr($key['TGL_DESC'], 1, 10);
			    	$ztglKet 	= strtotime($tglKet);
			    	$xtglKet	= date("d-m-Y", $ztglKet);
					$jt = 'Biaya Asuransi ('.$xtglKet.')';
					$kt = 'CI';
				}


			    $txta = $jt;
			    $cellWidth=35; //lebar sel
				$cellHeight=8;

				if($pdf->GetStringWidth($txta) < $cellWidth){
					//jika tidak, maka tidak melakukan apa-apa
					$line=1;
				}else{
					
					$textLength=strlen($txta);	//total panjang teks
					$errMargin=5;		//margin kesalahan lebar sel, untuk jaga-jaga
					$startChar=0;		//posisi awal karakter untuk setiap baris
					$maxChar=0;			//karakter maksimum dalam satu baris, yang akan ditambahkan nanti
					$textArray=array();	//untuk menampung data untuk setiap baris
					$tmpString="";		//untuk menampung teks untuk setiap baris (sementara)
					
					while($startChar < $textLength){ //perulangan sampai akhir teks
						//perulangan sampai karakter maksimum tercapai
						while( 
						$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
						($startChar+$maxChar) < $textLength ) {
							$maxChar++;
							$tmpString=substr($txta,$startChar,$maxChar);
						}
						//pindahkan ke baris berikutnya
						$startChar=$startChar+$maxChar;
						//kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
						array_push($textArray,$tmpString);
						//reset variabel penampung
						$maxChar=0;
						$tmpString='';
						
					}
					//dapatkan jumlah baris
					$line=count($textArray);
				}

				if($kondisi == 'sebulan'){

					if($key["TRX_TYPE"] != 'S'){

						$pdf->Cell(25,($line * $cellHeight),$key['TGLTRANS'],0,0,'C',true);
					    $pdf->Cell(20,($line * $cellHeight),$kt,0,0,'C', true);
					    $xPos=$pdf->GetX();
						$yPos=$pdf->GetY();
						$pdf->MultiCell($cellWidth,$cellHeight,$txta,0, 'C', true);
						$pdf->SetXY($xPos + $cellWidth , $yPos);
						$pdf->Cell(25,($line * $cellHeight),number_format(str_replace(',', '.', $key["RP_NETT"]),2,",","."),0,0,'C', true);
						$pdf->Cell(25,($line * $cellHeight),number_format(str_replace(',', '.', $key["NAB_BELI"]),4,",","."),0,0,'C', true);

						if($key["TRX_TYPE"]=="T" or $key["TRX_TYPE"]=="S"){
							$nmbr = 1;
						}elseif($key["TRX_TYPE"]=="R" or $key["TRX_TYPE"]=="C"){
							$nmbr = -1;
						}

						$pdf->Cell(25,($line * $cellHeight),number_format(str_replace(',', '.', $key["UNIT"])*$nmbr,4,",","."),0,0,'C', true);
						$pdf->Cell(25,($line * $cellHeight)," ",0,0,'C', true);
					    $pdf->Ln();

						if($key["TRX_TYPE"]=="T"){
							$totalAllUnit += str_replace(',', '.', $key["UNIT"]);
					 	}elseif($key["TRX_TYPE"]=="R" or $key["TRX_TYPE"]=="C"){
					 		$totalAllUnit -= str_replace(',', '.', $key["UNIT"]);
						}

					}

				}else{

					$pdf->Cell(25,($line * $cellHeight),$key['TGLTRANS'],0,0,'C',true);
				    $pdf->Cell(20,($line * $cellHeight),$kt,0,0,'C', true);
				    $xPos=$pdf->GetX();
					$yPos=$pdf->GetY();
					$pdf->MultiCell($cellWidth,$cellHeight,$txta,0, 'C', true);
					$pdf->SetXY($xPos + $cellWidth , $yPos);
					$pdf->Cell(25,($line * $cellHeight),number_format(str_replace(',', '.', $key["RP_NETT"]),2,",","."),0,0,'C', true);
					$pdf->Cell(25,($line * $cellHeight),number_format(str_replace(',', '.', $key["NAB_BELI"]),4,",","."),0,0,'C', true);

					if($key["TRX_TYPE"]=="T" or $key["TRX_TYPE"]=="S"){
						$nmbr = 1;
					}elseif($key["TRX_TYPE"]=="R" or $key["TRX_TYPE"]=="C"){
						$nmbr = -1;
					}

					$pdf->Cell(25,($line * $cellHeight),number_format(str_replace(',', '.', $key["UNIT"])*$nmbr,4,",","."),0,0,'C', true);
					$pdf->Cell(25,($line * $cellHeight)," ",0,0,'C', true);
				    $pdf->Ln();

					if($key["TRX_TYPE"]=="T" or $key["TRX_TYPE"]=="S"){
						$totalAllUnit += str_replace(',', '.', $key["UNIT"]);
				 	}elseif($key["TRX_TYPE"]=="R" or $key["TRX_TYPE"]=="C"){
				 		$totalAllUnit -= str_replace(',', '.', $key["UNIT"]);
					}

				}

			}

			/** end dapetin data selain Saldo Awal **/
			

		   

		    $kdfund = $arr2["KDFUND"];	

		    $querymax = "SELECT to_char(tgl_nab, 'dd/mm/yyyy') as tglmax,nab_jual as nilainab from TABEL_UL_NAB where tgl_nab in (select max(tgl_nab) from tabel_ul_nab where kode_fund='$kdfund') and kode_fund = '$kdfund' order by tgl_nab desc, kode_fund desc";
			$DB5->parse($querymax);
			$DB5->execute();
			$row1=$DB5->nextrow();
    		$nilainab 	= str_replace(',','.',$row1["NILAINAB"]);
    		$tglnabx	= $row1["TGLMAX"];
    		$nilaiTunai = $totalAllUnit*$nilainab;

    		$allNilaiTunai += $nilaiTunai;

    		//$dateNab 	= new DateTime($row1["TGLMAX"]);

    		$pdf->SetFont('Arial','B',8);
		    $pdf->SetFillColor(128,128,128);
		    $pdf->SetTextColor(255,255,255);
		    $pdf->Cell(25,8,$tglnabx,0,0,'C',true);
	    	$pdf->Cell(20,8,"",0,0,'C', true);
	    	$pdf->Cell(35,8,"",0,0,'C', true);
	    	$pdf->Cell(25,8,"",0,0,'C', true);
	    	$pdf->Cell(25,8,$row1["NILAINAB"],0,0,'C', true);
	    	$pdf->Cell(25,8,number_format($totalAllUnit,4,",","."),0,0,'C', true);
	    	$pdf->Cell(25,8,number_format($nilaiTunai,2,",","."),0,0,'C', true);
	    	$pdf->Ln();

		
	    	$totalUnitNilaiAwal = 0;
		}

	
		$pdf->Ln();
		$pdf->SetFont('Arial','B',11);
	    $pdf->SetFillColor(80,80,80);
	    $pdf->SetTextColor(255,255,255);
	    $pdf->Cell(60,8,'SALDO AKHIR NILAI TUNAI',0,0,'C',true);
		$pdf->Cell(20,8,"",0,0,'C', true);
		$pdf->Cell(15,8,"",0,0,'C', true);
		$pdf->Cell(15,8,"",0,0,'C', true);
		$pdf->Cell(20,8,"",0,0,'C', true);
		$pdf->Cell(20,8,"",0,0,'C', true);
		$pdf->Cell(30,8,number_format($allNilaiTunai,2,",","."),0,0,'C', true);
		$pdf->SetFillColor(255,255,255);
	    $pdf->SetTextColor(0,0,0);
		$pdf->Ln();
		$pdf->Ln();

		/** Jika status polis LAPSE */
		if($arr['KDSTATUSFILE'] == 'A'){
			$pdf->SetFont('Arial','B',6);
			$pdf->SetFillColor(80,80,80);
	    	$pdf->SetTextColor(255,255,255);
			$pdf->Cell(80,8,'(Belum di perhitungkan tunggakan Biaya Administrasi dan Biaya Asuransi)',0,0,'T',true);
			$pdf->Cell(10,8,"",0,0,'C', true);
			$pdf->Cell(15,8,"",0,0,'C', true);
			$pdf->Cell(15,8,"",0,0,'C', true);
			$pdf->Cell(10,8,"",0,0,'C', true);
			$pdf->Cell(20,8,"",0,0,'C', true);
			$pdf->Cell(30,8,'',0,0,'C', true);
		}
		/** end */

		$pdf->SetFont('Arial','B',8);
	    $pdf->SetFillColor(80,80,80);
	    $pdf->SetTextColor(255,255,255);
	    $pdf->Cell(100,8,'Nilai maksimum penarikan yang dapat dilakukan per '.$tglnabx. ' adalah :',0,0,'L',true);
		$pdf->Cell(20,8,"",0,0,'C', true);
		$pdf->Cell(15,8,"",0,0,'C', true);
		$pdf->Cell(15,8,"",0,0,'C', true);
		$pdf->Cell(20,8,"",0,0,'C', true);
		$pdf->Cell(10,8,"",0,0,'C', true);
		$pdf->Cell(0,8,"",0,0,'C', true);
		$pdf->Ln();
		$pdf->Cell(60,8,'Sebagian',0,0,'L',true);
		$pdf->Cell(20,8,"",0,0,'C', true);
		$pdf->Cell(15,8,"",0,0,'C', true);
		$pdf->Cell(15,8,"",0,0,'C', true);
		$pdf->Cell(20,8,"",0,0,'C', true);
		$pdf->Cell(20,8,"",0,0,'C', true);
		$pdf->Cell(30,8,"00,00",0,0,'R', true);
		$pdf->Ln();
		$pdf->Cell(60,8,'Seluruhnya',0,0,'L',true);
		$pdf->Cell(20,8,"",0,0,'C', true);
		$pdf->Cell(15,8,"",0,0,'C', true);
		$pdf->Cell(15,8,"",0,0,'C', true);
		$pdf->Cell(20,8,"",0,0,'C', true);
		$pdf->Cell(20,8,"",0,0,'C', true);
		$pdf->Cell(30,8,number_format($allNilaiTunai,2,",","."),0,0,'R', true);

		$pdf->Ln();
		$pdf->Ln();

		$pdf->SetFont('Arial','B',7);
	    $pdf->SetFillColor(255,255,255);
	    $pdf->SetTextColor(0,0,0);
	    $pdf->Cell(6,4,'Keterangan:',0,0,'L');
	    $pdf->Ln();

	    $pdf->SetFont('Arial','',7);
	    $pdf->SetFillColor(255,255,255);
	    $pdf->SetTextColor(0,0,0);
	    $pdf->Cell(6,4,'1.   Jenis Dana Investasi adalah pilihan investasi yang dimiliki oleh Pemegang Polis pada saat laporan ini dicetak.',0,0,'FJ');
	    $pdf->Ln();
	    $pdf->Cell(6,4,'2.   Biaya Pengelolaan Investasi maksimum sebesar 2% (dua persen) per tahun untuk masing-masing jenis Dana Investasi.',0,0,'FJ');
	    $pdf->Ln();
	    $pdf->SetFont('Arial','',7);
	    // $pdf->Cell(39,4,'3. Biaya Penarikan sebagian Dana ',0,0,'FJ');
	    // $pdf->SetFont('Arial','I',7);
	    // $pdf->Cell(13,4, '(withdrawal)',0,0,'FJ');
	    // $pdf->SetFont('Arial','',7);
	    // $pdf->Cell(33,4,' atau penarikan seluruh Dana',0,0,'FJ');
	    // $pdf->SetFont('Arial','I',7);
	    // $pdf->Cell(13,4, '(surrender)',0,0,'FJ');
	    // $pdf->SetFont('Arial','',7);
	    // $pdf->Cell(37,4,'dikenakan 2% (dua persen) dari jumlah dana yang ditarik apabila penarikan',0,0,'FJ');
	    // $pdf->Ln();
	    // $pdf->Cell(38,4,'    Dana dilakukan saat usia Polis ',0,0,'L');
	    // $pdf->SetFont('Symbol');
	    // $pdf->Cell(3,4,chr(163),0,0, 'L');
	    // $pdf->SetFont('Arial','',7);
	    // $pdf->Cell(6,4,'2 (dua) tahun sejak Tanggal Berlaku Polis.',0,0,'L');
	    // $pdf->Ln();
	    $pdf->Cell(31,4,'3.	  Biaya Pengalihan Dana ',0,0,'FJ');
	    $pdf->SetFont('Arial','I',7);
	    $pdf->Cell(20,4, '(Switching Fund)',0,0,'FJ');
	    $pdf->SetFont('Arial','',7);
	    $pdf->Cell(38,4, 'dikenakan sebesar 1% (satu persen) apabila dilakukan lebih dari 2 (dua) kali dalam 1 (satu) tahun.',0,0,'FJ');
	    $pdf->Ln();
	    $pdf->Cell(11,4,'4.	  Biaya ',0,0,'FJ');
	    $pdf->SetFont('Arial','I',7);
	    $pdf->Cell(9,4, 'Top Up',0,0,'FJ');
	    $pdf->SetFont('Arial','',7);
	    $pdf->Cell(76,4, '(Penambahan Dana) dikenakan sebesar 5% (lima persen) dari Premi',0,0,'FJ');
	    $pdf->SetFont('Arial','I',7);
	    $pdf->Cell(60,4, 'Top Up',0,0,'FJ');
	    $pdf->SetFont('Arial','',7);
	    $pdf->Ln();
	    $pdf->Cell(62.5,4,'5.	  Pembatalan Polis oleh Pemegang Polis dalam masa ',0,0,'FJ');
	    $pdf->SetFont('Arial','I',7);
	    $pdf->Cell(21,4, 'Freelook Provision',0,0,'FJ');
	    $pdf->SetFont('Arial','',7);
	    $pdf->Cell(38,4, 'dikenakan Biaya Pembatalan Polis sebesar Rp150.000,00 (seratus lima puluh ribu rupiah).',0,0,'FJ');
	    $pdf->Ln();
	    $pdf->Cell(80,4,'6.	  Pemegang polis diberikan keleluasaan untuk mengajukan Cuti Premi ',0,0,'FJ');
    	$pdf->SetFont('Arial','I',7);
    	$pdf->Cell(21,4, '(Premium Holiday)',0,0,'FJ');
    	$pdf->SetFont('Arial','',7);
    	$pdf->Cell(38,4, 'apabila polis telah melewati 5 (lima) tahun terhitung sejak tanggal berlaku',0,0,'FJ');
    	$pdf->Ln();
    	$pdf->Cell(32.5,4,'      polis. Selama Cuti Premi ',0,0,'FJ');
    	$pdf->SetFont('Arial','I',7);
    	$pdf->Cell(21,4, '(Premium Holiday),',0,0,'FJ');
    	$pdf->SetFont('Arial','',7);
    	$pdf->Cell(38,4, ' pemotongan Nilai Investasi dilakukan secara otomatis sebesar biaya-biaya yang diperlukan agar Polis tetap berlaku.',0,0,'FJ');
	    $pdf->Ln();
	    $pdf->Cell(108,4,'7.	  Apabila premi regular tidak dibayar lunas oleh Pemegang Polis sampai melewati masa leluasa  ',0,0,'FJ');
	    $pdf->SetFont('Arial','I',7);
    	$pdf->Cell(17,4, '(Grace Period),',0,0,'FJ');
    	$pdf->SetFont('Arial','',7);
    	$pdf->Cell(38,4, ' dari tanggal jatuh tempo pembayaran Premi, maka',0,0,'FJ');
	    $pdf->Ln();
	    $pdf->Cell(26,4,'      Polis menjadi batal ',0,0,'FJ');
	    $pdf->SetFont('Arial','I',7);
    	$pdf->Cell(18,4, '(Lapse).',0,0,'FJ');
	    $pdf->Ln();
    	$pdf->SetFont('Arial','',7);
	    $pdf->Cell(6,4,'8.	  Apabila saldo Nilai Investasi ternyata tidak mencukupi untuk membayar biaya-biaya yang timbul berkaitan dengan pertanggungan Polis baik dalam masa Cuti Premi',0,0,'FJ');
	    $pdf->Ln();
	    $pdf->SetFont('Arial','I',7);
	    $pdf->Cell(25.5,4,'     (Premium Holiday), ',0,0,'FJ');
	    $pdf->SetFont('Arial','',7);
	    $pdf->Cell(38,4,'maka polis otomatis menjadi batal ',0,0,'FJ');
	    $pdf->SetFont('Arial','I',7);
	    $pdf->Cell(18,4,'(Lapse).',0,0,'FJ');
	    $pdf->Ln();
	    $pdf->SetFont('Arial','',7);
	    $pdf->Cell(43,4,'9.	  Minimum penarikan sebagian dana',0,0,'FJ');
	    $pdf->SetFont('Arial','I',7);
	    $pdf->Cell(14,4,'(withdrawal) ',0,0,'FJ');
	    $pdf->SetFont('Arial','',7);
	    $pdf->Cell(50,4,'per transaksi adalah sebesar Rp1.000.000,00 (satu juta rupiah) atau jika dalam bentuk unit adalah jumlah unit',0,0,'FJ');
	    $pdf->Ln();
	    $pdf->Cell(151,4,'      yang setara dengan Rp1.000.000,00 (satu juta rupiah) dan Saldo Nilai Investasi setelah dilakukan penarikan sebagian Dana Investasi',0,0,'FJ');
	    $pdf->SetFont('Arial','I',7);
	    $pdf->Cell(14,4,'(withdrawal) ',0,0,'FJ');
	    $pdf->SetFont('Arial','',7);
	    $pdf->Cell(31,4,'adalah ',0,0,'FJ');
	    $pdf->Ln();
	    $pdf->Cell(31,4,'      minimal sebesar Rp2.000.000,00 (dua juta rupiah).',0,0,'FJ');
	    $pdf->Ln();
	    $pdf->Cell(62,4,'10. Apabila dilakukan penarikan seluruh Dana Investasi',0,0,'FJ');
	    $pdf->SetFont('Arial','I',7);
	    $pdf->Cell(14,4,'(surrender), ',0,0,'FJ');
	    $pdf->SetFont('Arial','',7);
	    $pdf->Cell(42,4,'maka mengakibatkan Polis berakhir (batal).',0,0,'FJ');
	    $pdf->Ln();



	    /** Redaksi Informasi untuk Cara Bayar selain 'Sekaligus' fungsi ini buat kdproduk 'JL4BLN' **/
	    // if ($arr['KDCARABAYAR'] == 'B') {
	    // 	$pdf->Cell(79,4,'7.	Pemegang polis diberikan keleluasaan untuk mengajukan Cuti Premi ',0,0,'FJ');
	    // 	$pdf->SetFont('Arial','I',7);
	    // 	$pdf->Cell(21,4, '(Premium Holiday)',0,0,'FJ');
	    // 	$pdf->SetFont('Arial','',7);
	    // 	$pdf->Cell(38,4, 'apabila polis telah melewati 5 (lima) tahun terhitung sejak tanggal berlaku',0,0,'FJ');
	    // 	$pdf->Ln();
	    // 	$pdf->Cell(31,4,'    polis. Selama Cuti Premi ',0,0,'FJ');
	    // 	$pdf->SetFont('Arial','I',7);
	    // 	$pdf->Cell(21,4, '(Premium Holiday),',0,0,'FJ');
	    // 	$pdf->SetFont('Arial','',7);
	    // 	$pdf->Cell(38,4, ' pemotongan Nilai Investasi dilakukan secara otomatis sebesar biaya-biaya yang diperlukan agar Polis tetap berlaku.',0,0,'FJ');
		   //  $pdf->Ln();
		   //  $pdf->Cell(107,4,'8.	Apabila premi regular tidak dibayar lunas oleh Pemegang Polis sampai melewati masa leluasa  ',0,0,'FJ');
		   //  $pdf->SetFont('Arial','I',7);
	    // 	$pdf->Cell(17,4, '(Grace Period),',0,0,'FJ');
	    // 	$pdf->SetFont('Arial','',7);
	    // 	$pdf->Cell(38,4, ' dari tanggal jatuh tempo pembayaran Premi, maka',0,0,'FJ');
		   //  $pdf->Ln();
		   //  $pdf->Cell(24,4,'    Polis menjadi batal ',0,0,'FJ');
		   //  $pdf->SetFont('Arial','I',7);
	    // 	$pdf->Cell(18,4, '(Lapse).',0,0,'FJ');
		   //  $pdf->Ln();
		   //  $pdf->SetFont('Arial','',7);
		   //  $pdf->Cell(6,4,'9.	Apabila saldo Nilai Investasi ternyata tidak mencukupi untuk membayar biaya-biaya yang timbul berkaitan dengan pertanggungan Polis baik dalam masa Cuti Premi',0,0,'FJ');
		   //  $pdf->Ln();
		   //  $pdf->SetFont('Arial','I',7);
		   //  $pdf->Cell(24,4,'    (Premium Holiday) ',0,0,'FJ');
		   //  $pdf->SetFont('Arial','',7);
		   //  $pdf->Cell(38,4,'maka polis otomatis menjadi batal ',0,0,'FJ');
		   //  $pdf->SetFont('Arial','I',7);
		   //  $pdf->Cell(18,4,'(Lapse).',0,0,'FJ');
		   //  $pdf->Ln();

	    // }
	    /** End Redaksi **/
	    $pdf->SetFont('Arial','',7);
	    $pdf->Ln();
	    $pdf->Cell(116,4,'Apabila membutuhkan informasi dan penjelasan lebih lanjut mengenai polis tersebut, dapat menghubungi ',0,0,'FJ');
	    $pdf->SetFont('Arial','B',7);
	    $pdf->Cell(25,4,'Call Center 1500 176, ',0,0,'FJ');
	    $pdf->SetFont('Arial','',7);
	    $pdf->Cell(50,4,'email ke customer_care@ifg-life.id,',0,0,'FJ');
	    $pdf->Ln();
	    $pdf->Cell(66,4,'kantor representative terdekat, atau melalui website kami di ',0,0,'FJ');
	    $pdf->Cell(6,4,'https://ifg-life.id/', '','','',false, "https://ifg-life.id/");
	    $pdf->Ln();
	    $pdf->Ln();
	    $pdf->Ln();
	    $pdf->SetFont('Arial','',8);
	    $pdf->SetFillColor(255,255,255);
	    $pdf->SetTextColor(0,0,0);   
	    $pdf->Cell(6,4,'PT ASURANSI JIWA IFG',0,0,'L');

	    $pdf->Output('F', "./PDF/LAPORAN_PERKEMBANGAN_NILAITUNAI_".$nopertanggungan.".pdf", true);
	}


    
	
?>