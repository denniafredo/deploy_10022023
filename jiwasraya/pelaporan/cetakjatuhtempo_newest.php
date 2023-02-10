<?
	include "../../includes/database.php";
	include "../../includes/session.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";
	include "../../includes/kantor.php";
	$DB=New database($userid, $passwd, $DBName);
	$DBX=New database($userid, $passwd, $DBName);
	$DBP=New database($userid, $passwd, $DBName);		

	//$prefixpertanggungan="AC";
	//$nopertanggungan="001226250";
	$PER=New Pertanggungan($userid,$passwd,$prefixpertanggungan,$nopertanggungan);
	$KLN=New Klien($userid,$passwd,$PER->nopemegangpolis);
	$KTR=New Kantor($userid,$passwd,$kantor);


	if ($carabayar=='B') {$cara=" and a.kdcarabayar in ('1','M') ";}
	elseif ($carabayar=='K') {$cara=" and a.kdcarabayar in ('2','Q') ";}
	elseif ($carabayar=='S') {$cara=" and a.kdcarabayar in ('3','H') ";}
	elseif ($carabayar=='T') {$cara=" and a.kdcarabayar in ('4','A') ";}
	elseif ($carabayar=='E') {$cara=" and a.kdcarabayar in ('E') ";}
	elseif ($carabayar=='J') {$cara=" and a.kdcarabayar in ('J') ";}

	$query="select prefixpertanggungan, nopertanggungan,  TO_CHAR(mulas, 'DD') tmulas, TO_CHAR(TO_DATE ('".$tglcari."01', 'YYYYMMDD'),'DD/MM/YYYY') tglexp FROM   
			$DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih p
			WHERE   a.nopenagih=p.nopenagih
			--AND p.KDRAYONPENAGIH='$kdkantor'
			AND a.kdpertanggungan = '2'
			AND a.kdstatusfile = '1'
			AND a.kdcarabayar <> 'X'
			-- AND SUBSTR(a.kdproduk,1,3) in ('JL2','JL3','JL4')
			AND MOD (
			MONTHS_BETWEEN (
			TO_DATE ('".$tglcari."', 'YYYYMM'),
			TO_DATE (TO_CHAR ( (a.mulas), 'MM/YYYY'), 'MM/YYYY')
			),
			DECODE (a.kdcarabayar,
			'1',
			1,
			'M',
			1,
			'2',
			3,
			'Q',
			3,
			'3',
			6,
			'H',
			6,
			'4',
			12,
			'A',
			12,
			'E',
			12,
			'J',
			12)
			) = 0  and a.PREFIXPERTANGGUNGAN = '$prefixpertanggungan'
			AND a.NOPERTANGGUNGAN = '$nopertanggungan'
			AND NOT EXISTS (
			SELECT   'X'
			FROM   $DBUser.TABEL_UL_BENEFIT_KLAIM
			WHERE       PREFIXPERTANGGUNGAN = a.PREFIXPERTANGGUNGAN
			AND NOPERTANGGUNGAN = a.NOPERTANGGUNGAN
			AND TO_DATE ( '".$tglcari."'||TO_CHAR(SYSDATE, 'DD') , 'YYYYMMDD')
			BETWEEN TGLMULAI AND TGLSELESAI)";
	//echo $query;
	$DBX->parse($query);
	$DBX->execute();				
	while ($arr=$DBX->nextrow()) {			


	$sql = "SELECT ptg.prefixpertanggungan PREFIXPERTANGGUNGAN, 
			ptg.nopertanggungan NOPERTANGGUNGAN, 
			ptg.nopol,
			ptg.kdvaluta,
			(SELECT (namavaluta)
			FROM $DBUser.tabel_304_valuta
			WHERE kdvaluta = ptg.kdvaluta)
			NAMAVALUTA,
			norekeningdebet,
			case
			when (SELECT   (NAMAKLIEN1)
			FROM   $DBUser.TABEL_100_KLIEN
			WHERE   noklien = ptg.nopenagih) like '%AUTODEBET%' then substr(norekeningdebet,1,3)||'******'||substr(norekeningdebet,-3)
			end rek,
			ptg.notertanggung,decode(ptg.indexawal,0,1,ptg.indexawal) indexawal, to_char(sysdate,'dd/mm/yyyy') tgl,
			TO_CHAR(add_months(TO_DATE ('".$tglcari.$arr["TMULAS"]."', 'YYYYMMDD'),(SELECT GRACEPERIODE  
                     FROM $DBUser.TABEL_241_GRACE_PERIODE
                    WHERE kdproduk = ptg.kdproduk)-2)-1,'DD/MM/YYYY') tglexp1,
			TO_CHAR(add_months(TO_DATE ('".$tglcari.$arr["TMULAS"]."', 'YYYYMMDD'),(SELECT GRACEPERIODE  
                     FROM $DBUser.TABEL_241_GRACE_PERIODE
                    WHERE kdproduk = ptg.kdproduk)-2),'DD/MM/YYYY') tglbpo1,
			TO_CHAR(TO_DATE ('".$tglcari.$arr["TMULAS"]."', 'YYYYMMDD')+(SELECT   GRACEPERIODE*30
			FROM   $DBUser.TABEL_241_GRACE_PERIODE 
			WHERE   kdproduk = ptg.kdproduk),'DD/MM/YYYY') tglexp,
			TO_CHAR(TO_DATE ('".$tglcari.$arr["TMULAS"]."', 'YYYYMMDD')+(SELECT   GRACEPERIODE*30
			FROM   $DBUser.TABEL_241_GRACE_PERIODE 
			WHERE   kdproduk = ptg.kdproduk)+1,'DD/MM/YYYY') tglbpo,
			CASE
			WHEN (MONTHS_BETWEEN (TO_DATE ('$tglexp', 'DD/MM/YYYY'), MULAS) / 12) >=5
			THEN
			PREMI2
			ELSE
			PREMI1
			END
			PREMI,
			(SELECT STATUS
			FROM $DBUser.tabel_300_historis_premi
			WHERE     prefixpertanggungan = ptg.prefixpertanggungan
			   AND nopertanggungan = ptg.nopertanggungan
			   AND TO_CHAR (tglbooked, 'MMYYYY') = '".$tglcari."')
			STATUS,
			TO_CHAR(mulas,'DD/MM/YYYY') MULAS,to_char(sysdate,'dd/mm/yyyy') cetak,
			(select SUM(PREMITAGIHAN) from $DBUser.tabel_300_historis_premi where prefixpertanggungan=ptg.prefixpertanggungan and nopertanggungan=ptg.nopertanggungan and tglseatled is null) PREMITAGIHAN,
			(SELECT   GRACEPERIODE*30
			FROM   $DBUser.TABEL_241_GRACE_PERIODE 
			WHERE   kdproduk = ptg.kdproduk) gp,
			(SELECT   (NAMAKLIEN1)
			FROM   $DBUser.TABEL_100_KLIEN
			WHERE   noklien = ptg.nopenagih) PENAGIH,
			(SELECT   NAMACARABAYAR
			FROM   $DBUser.TABEL_305_CARA_BAYAR
			WHERE   kdcarabayar = ptg.kdcarabayar) CARA,
			(SELECT   NAMAVALUTA
			FROM   $DBUser.TABEL_304_VALUTA
			WHERE   kdvaluta = ptg.kdvaluta) valuta,
			(SELECT   namaproduk
			FROM   $DBUser.TABEL_202_PRODUK 
			WHERE   kdproduk = ptg.kdproduk) produk,
			(SELECT  max(noaccount) from $DBUser.TABEL_100_KLIEN_ACCOUNT where jenis='VA' and kdbank='BNI'
			and prefixpertanggungan=ptg.prefixpertanggungan and nopertanggungan=ptg.nopertanggungan) virtual,
			(SELECT  kdmapping from $DBUser.TABEL_001_kantor where kdkantor=ptg.prefixpertanggungan) mapping,
			(SELECT namaklien1
			FROM $DBUser.tabel_100_klien kli
			WHERE kli.noklien = ptg.nopemegangpolis) PEMPOL,
			(SELECT alamattagih01||' '||alamattagih02
			FROM $DBUser.tabel_100_klien kli
			WHERE kli.noklien = ptg.notertanggung) ALAMAT,
			(SELECT decode(jeniskelamin,'P','Ibu','L','Bapak','Bapak/Ibu')
			FROM $DBUser.tabel_100_klien kli
			WHERE kli.noklien = ptg.nopemegangpolis) anda,
			(SELECT namakotamadya
			FROM $DBUser.tabel_100_klien kli, $DBUser.TABEL_109_KOTAMADYA ktm
			WHERE kli.noklien = ptg.notertanggung and kdkotamadyatagih=kdkotamadya) KOTA,
			(SELECT TO_CHAR(MAX (tglbooked),'DD/MM/YYYY') FROM $DBUser.tabel_300_historis_premi hpl WHERE hpl.prefixpertanggungan=ptg.prefixpertanggungan AND hpl.nopertanggungan=ptg.nopertanggungan AND not(hpl.tglseatled is null)) lunas
			FROM $DBUser.tabel_200_pertanggungan ptg
			WHERE ptg.prefixpertanggungan = '".$arr["PREFIXPERTANGGUNGAN"]."' AND ptg.nopertanggungan = '".$arr["NOPERTANGGUNGAN"]."'";

	//echo $sql;

	$DB->parse($sql);
	$DB->execute();
	$row=$DB->nextrow();

?>
<?php

require( "fpdf.php" );

$pdf = new FPDF('P','mm','A4');

// PAGE 1
$pdf->AddPage();

// HEADER
$pdf->Image('img/logo-js.png', 170, 5);
$pdf->ln();
$pdf->SetFont('Arial','B',14);
$pdf->Cell(190,4,'PT. ASURANSI JIWA IFG',0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','',8);
$pdf->Cell(190,4,'Jl. Ir. H. Juanda No. 34 Jakarta - 10120',0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','B',8);
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(65,105,225);
$pdf->Cell(50,4,'CALL (021) 1500151 ',1,0,'L', true);
$pdf->ln(7);
$pdf->SetFont('Arial','I',8);
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(0,0,0);
$pdf->Cell(50,4,'http://www.ifg-life.co.id',1,0,'L', true);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(200,200,200);
$pdf->ln(7);

// HEADER
$pdf->SetFont('Arial','',8);
$pdf->SetFillColor(200,200,200);
$pdf->Cell(190,4,ucwords(strtolower($KTR->kotamadya)).', '.$row["TGL"],0,0,'R');
$pdf->ln(10);
$pdf->Cell(190,4,'Kepada Yth.',0,0,'L');
$pdf->ln();
$pdf->Cell(190,4,$row["ANDA"].' '.$row["PEMPOL"] ,0,0,'L');
$pdf->ln();
$pdf->Cell(190,4,$row["ALAMAT"],0,0,'L');
$pdf->ln();
$pdf->Cell(190,4,$row["KOTA"],0,0,'L');
$pdf->ln(7);
$pdf->Cell(190,4,'Dengan Hormat,',0,0,'L');
$pdf->ln(7);
$pdf->Cell(190,4,'Terima kasih atas kepercayaan '.$row["ANDA"].' kepada PT Asuransi Jiwa IFG dalam memberikan perlindungan asuransi bagi '.$row["ANDA"].' dan keluarga.',0,0,'L');
$pdf->ln(7);
$pdf->Cell(190,4,'Berikut kami informasikan data rincian Polis '.$row["ANDA"].':',0,0,'L');
$pdf->ln(7);

// DATA RINCIAN POLIS
$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(0,32,96);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(38,4,'Nomor Polis','LTR',0,'C',true);
$pdf->Cell(38,4,'Lunas Terakhir','LTR',0,'C',true);
$pdf->Cell(38,4,'Tagihan Baru','LTR',0,'C',true);
$pdf->Cell(38,4,'Tanggal Cetak','LTR',0,'C',true);
$pdf->Cell(38,4,'Batas Waktu Pembayaran','LTR',0,'C',true);
$pdf->ln();
$pdf->SetFont('Arial','I',8);
$pdf->SetFillColor(0,32,96);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(38,4,'Policy Number','LBR',0,'C',true);
$pdf->Cell(38,4,'Last Payment Date','LBR',0,'C',true);
$pdf->Cell(38,4,'New Balance','LBR',0,'C',true);
$pdf->Cell(38,4,'Statement Date','LBR',0,'C',true);
$pdf->Cell(38,4,'Due Date','LBR',0,'C',true);
$pdf->ln();
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
if ($row["PREFIXPERTANGGUNGAN"].$row["NOPERTANGGUNGAN"]==$row["NOPOL"]) 
{	
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(38,4,$row["PREFIXPERTANGGUNGAN"].'-'.$row["NOPERTANGGUNGAN"],1,0,'C',true);
} else 
{ 	
	$pdf->SetFont('Arial','',6);
	$pdf->Cell(38,4,$row["PREFIXPERTANGGUNGAN"].'-'.$row["NOPERTANGGUNGAN"].'/ '.$row["NOPOL"],1,0,'C',true);
}
$pdf->Cell(38,4,$row["LUNAS"],1,0,'C',true);
//$premitagihan = $row["KDVALUTA"]==0 ? $row["PREMITAGIHAN"]/$row["INDEXAWAL"] : $row["PREMITAGIHAN"]; 
$pdf->Cell(38,4,number_format($row["PREMITAGIHAN"],2),1,0,'C',true);
$pdf->Cell(38,4,$row["CETAK"],1,0,'C',true);
$pdf->Cell(38,4,$row["TGLEXP1"],1,0,'C',true);
$pdf->ln();
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',8);
$pdf->Cell(38,5,'','LTB',0,'C',true);
$pdf->Cell(38,5,'','TB',0,'C',true);
$pdf->Cell(38,5,'','TB',0,'C',true);
$pdf->Cell(38,5,'','TB',0,'C',true);
$pdf->Cell(38,5,'','RTB',0,'C',true);
$pdf->ln();
$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(0,32,96);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(38,4,'Tanggal Tagihan','LTR',0,'C',true);
$pdf->Cell(38,4,'Keterangan','LTR',0,'C',true);
$pdf->Cell(38,4,'Jumlah','LTR',0,'C',true);
$pdf->Cell(76,4,'Informasi Pembayaran','LTR',0,'C',true);
$pdf->ln();
$pdf->SetFont('Arial','I',8);
$pdf->SetFillColor(0,32,96);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(38,4,'Billing Date','LBR',0,'C',true);
$pdf->Cell(38,4,'Description','LBR',0,'C',true);
$pdf->Cell(38,4,'Amounts','LBR',0,'C',true);
$pdf->Cell(76,4,'Payment Information','LBR',0,'C',true);
$pdf->ln();
	$queryhp="select to_char(tglbooked,'dd/mm/yyyy') booked, to_char(tglbooked,'mm/yyyy') blnbooked, PREMITAGIHAN from $DBUser.tabel_300_historis_premi where 
		prefixpertanggungan='".$row["PREFIXPERTANGGUNGAN"]."' and nopertanggungan= '".$row["NOPERTANGGUNGAN"]."' and tglseatled is null";
	$DBP->parse($queryhp);
	$DBP->execute();	
	//echo $queryhp;	
	$totalpremi=0;		
	while ($hp=$DBP->nextrow()) {	
	$totalpremi+=$hp["PREMITAGIHAN"];
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(38,4,$hp["BOOKED"],'L',0,'C',true);
		if ($hp["BLNBOOKED"] != '')
		{
		$pdf->Cell(38,4,'premi bulan '.$hp["BLNBOOKED"],0,0,'C',true);
		}
		else
		{
		$pdf->Cell(38,4,'',0,0,'C',true);
		}
		$pdf->Cell(38,4,number_format($hp["PREMITAGIHAN"],2,",","."),0,0,'C',true);
		$pdf->Cell(38,4,'','LR',0,'L',true);
		$pdf->SetFont('Arial','',6);
		$pdf->Cell(38,4,'','LR',0,'L',true);
		$pdf->ln();
	}
	/*
	else {
        // Else
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(38,4,$hp["BOOKED"],'L',0,'C',true);
		if ($hp["BLNBOOKED"] != '')
		{
		$pdf->Cell(38,4,'premi bulan '.$hp["BLNBOOKED"],0,0,'C',true);
		}
		else
		{
		$pdf->Cell(38,4,'',0,0,'C',true);
		}
		$pdf->Cell(38,4,number_format($hp["PREMITAGIHAN"],2,",","."),0,0,'C',true);
		$pdf->Cell(38,4,'Cara Pembayaran','LR',0,'L',true);
		$pdf->SetFont('Arial','',6);
		$pdf->Cell(38,4,$row["PENAGIH"],'LR',0,'L',true);
		$pdf->ln();
	}
	*/
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',8);
$pdf->Cell(38,4,'','L',0,'C',true);
$pdf->Cell(38,4,'',0,0,'C',true);
$pdf->Cell(38,4,'',0,0,'C',true);
$pdf->Cell(38,4,'Valuta','LR',0,'L',true);
$pdf->SetFont('Arial','',6);
$pdf->Cell(38,4,$row["NAMAVALUTA"],'LR',0,'L',true);
$pdf->ln();
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',8);
$pdf->Cell(38,4,'','L',0,'C',true);
$pdf->Cell(38,4,'',0,0,'C',true);
$pdf->Cell(38,4,'',0,0,'C',true);
$pdf->Cell(38,4,'Cara Pembayaran','LR',0,'L',true);
$pdf->SetFont('Arial','',6);
$pdf->Cell(38,4,$row["PENAGIH"],'LR',0,'L',true);
$pdf->ln();
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',8);
$pdf->Cell(38,4,'','L',0,'C',true);
$pdf->Cell(38,4,'',0,0,'C',true);
$pdf->Cell(38,4,'',0,0,'C',true);
$pdf->Cell(38,4,'Rek. Pendebetan','LR',0,'L',true);
$pdf->Cell(38,4,$row["REK"],'LR',0,'L',true);
$pdf->ln();
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',6);
$pdf->Cell(38,4,'','L',0,'C',true);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',8);
if ($row["STATUS"]!= 'X')
{
	$pdf->Cell(38,4,'TOTAL TAGIHAN',0,0,'C',true);
	$pdf->Cell(38,4,number_format($totalpremi,2,",","."),0,0,'C',true);
}
else
{
	$pdf->Cell(38,4,'',0,0,'C',true);
	$pdf->Cell(38,4,'',0,0,'C',true);
}
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',8);
$pdf->Cell(38,4,'Nomor Host-to-Host','LR',0,'L',true);
$pdf->Cell(38,4,$row["MAPPING"].$row["NOPERTANGGUNGAN"],'LR',0,'L',true);
$pdf->ln();
$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(0,32,96);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(38,4,'','L',0,'C');
$pdf->Cell(38,4,'',0,0,'C');
$pdf->Cell(38,4,'',0,0,'C');
$pdf->Cell(76,4,'Informasi Pembayaran','LTR',0,'C',true);
$pdf->ln();
$pdf->SetFont('Arial','I',8);
$pdf->SetFillColor(0,32,96);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(38,4,'','L',0,'C');
$pdf->Cell(38,4,'',0,0,'C');
$pdf->Cell(38,4,'',0,0,'C');
$pdf->Cell(76,4,'Payment Information','LBR',0,'C',true);
$pdf->ln();
$pdf->SetFont('Arial','',7.8);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(38,4,'','L',0,'C');
$pdf->Cell(38,4,'',0,0,'C');
$pdf->Cell(38,4,'',0,0,'C');
$pdf->Cell(76,4,'Bagi Nasabah dengan cara bayar Autodebet, akan dilakukan','LTR',0,'L',true);
$pdf->ln();
$pdf->SetFont('Arial','',7.8);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(38,4,'','L',0,'C');
$pdf->Cell(38,4,'',0,0,'C');
$pdf->Cell(38,4,'',0,0,'C');
$pdf->Cell(76,4,'pendebetan secara otomatis setiap bulannya.','LR',0,'L',true);
$pdf->ln();
$pdf->SetFont('Arial','',7.8);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(38,4,'','L',0,'C');
$pdf->Cell(38,4,'',0,0,'C');
$pdf->Cell(38,4,'',0,0,'C');
$pdf->Cell(76,4,'Jadwal pendebetan mengikuti ketetapan sebagai berikut:','LR',0,'L',true);
$pdf->ln();
$pdf->SetFont('Arial','',7.8);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(38,4,'','L',0,'C');
$pdf->Cell(38,4,'',0,0,'C');
$pdf->Cell(38,4,'',0,0,'C');
$pdf->Cell(76,4,'1. Mandiri : Tgl 5, 15, 25','LR',0,'L',true);
$pdf->ln();
$pdf->SetFont('Arial','',7.8);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(38,4,'','L',0,'C');
$pdf->Cell(38,4,'',0,0,'C');
$pdf->Cell(38,4,'',0,0,'C');
$pdf->Cell(76,4,'2. BNI : Tgl 7, 17, 27','LR',0,'L',true);
$pdf->ln();
$pdf->SetFont('Arial','',7.8);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(38,4,'','L',0,'C');
$pdf->Cell(38,4,'',0,0,'C');
$pdf->Cell(38,4,'',0,0,'C');
$pdf->Cell(76,4,'3. BRI : Tgl 9, 19, 29','LR',0,'L',true);
$pdf->ln();
$pdf->SetFont('Arial','',7.8);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(38,4,'','L',0,'C');
$pdf->Cell(38,4,'',0,0,'C');
$pdf->Cell(38,4,'',0,0,'C');
$pdf->Cell(76,4,'4. Credit Card : Tgl 22','LR',0,'L',true);
$pdf->ln();
$pdf->SetFont('Arial','',7.8);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(38,4,'','L',0,'C');
$pdf->Cell(38,4,'',0,0,'C');
$pdf->Cell(38,4,'',0,0,'C');
$pdf->Cell(76,4,'5. BTN : Tgl 3, 13, 23 (*)','LR',0,'L',true);
$pdf->ln();
$pdf->SetFont('Arial','',7.8);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(38,4,'','L',0,'C');
$pdf->Cell(38,4,'',0,0,'C');
$pdf->Cell(38,4,'',0,0,'C');
$pdf->Cell(76,4,'6. BPD Kalbar : Tgl 6, 16, 26 (*)','LR',0,'L',true);
$pdf->ln();
$pdf->SetFont('Arial','',7.8);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(38,4,'','L',0,'C');
$pdf->Cell(38,4,'',0,0,'C');
$pdf->Cell(38,4,'',0,0,'C');
$pdf->Cell(76,4,'','LR',0,'L',true);
$pdf->ln();
$pdf->SetFont('Arial','',7.8);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(38,4,'','L',0,'C');
$pdf->Cell(38,4,'',0,0,'C');
$pdf->Cell(38,4,'',0,0,'C');
$pdf->Cell(76,4,'Jika tanggal pendebetan jatuh pada hari libur, pendebetan','LR',0,'L',true);
$pdf->ln();
$pdf->SetFont('Arial','',7.8);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(38,4,'','L',0,'C');
$pdf->Cell(38,4,'',0,0,'C');
$pdf->Cell(38,4,'',0,0,'C');
$pdf->Cell(76,4,'akan dilakukan pada hari kerja berikutnya.','LR',0,'L',true);
$pdf->ln();
$pdf->SetFont('Arial','',7.8);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(38,4,'','L',0,'C');
$pdf->Cell(38,4,'',0,0,'C');
$pdf->Cell(38,4,'',0,0,'C');
$pdf->Cell(76,4,'','LR',0,'L',true);
$pdf->ln();
$pdf->SetFont('Arial','B',7.8);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(38,4,'','LB',0,'C');
$pdf->Cell(38,4,'','B',0,'C');
$pdf->Cell(38,4,'','B',0,'C');
$pdf->Cell(76,4,'*Syarat dan ketentuan berlaku','LBR',0,'L',true);
$pdf->ln(7);

$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',8);
$pdf->Cell(190,4,'Untuk tetap menjaga Manfaat Asuransi sesuai ketentuan dalam Syarat-syarat Umum Polis Asuransi diharapkan '.$row["ANDA"].' untuk melakukan pembayaran',0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','',8);
$pdf->Cell(190,4,'premi sampai dengan batas waktu yang ditetapkan. Dalam hal pembayaran premi belum dilunasi sampai dengan batas waktu yang telah ditentukan,',0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','',8);
$pdf->Cell(190,4,'maka kondisi polis menjadi Lapse/Batal per '. $row["TGLBPO1"].'.',0,0,'L');
$pdf->ln(7);
$pdf->SetFont('Arial','',8);
$pdf->Cell(190,4,'Dalam hal pembayaran Premi telah dilakukan oleh '.$row["ANDA"].' dan atau data Polis di atas tidak sesuai, serta jika ada informasi lain yang ingin '.$row["ANDA"].' ketahui,',0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','',8);
$pdf->Cell(190,4,'mohon untuk dapat menghubungi Kantor Cabang PT Asuransi Jiwa IFG terdekat atau Call Center PT Asuransi Jiwa IFG di nomor (021) 1500151 atau',0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','',8);
$pdf->Cell(190,4,'email : customer_service@ifg-life.co.id, dengan melampirkan bukti pelunasan premi yang sah.',0,0,'L');
$pdf->ln(7);
$pdf->SetFont('Arial','',8);
$pdf->Cell(190,4,'Demikian pemberitahuan ini kami sampaikan, dan terima kasih atas kerjasama yang telah terjalin selama ini.',0,0,'L');
$pdf->ln(7);
$pdf->SetFont('Arial','',8);
$pdf->Cell(190,4,'Hormat kami',0,0,'L');
$pdf->ln(7);
$pdf->SetFont('Arial','',8);
$pdf->Cell(190,4,'PT ASURANSI JIWA IFG',0,0,'L');
$pdf->ln(7);
$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(160,160,164);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(190,4,'Info dan Promo Penting',1,0,'C',true);
$pdf->ln();
$pdf->SetFont('Arial','',7.7);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(63.3,4,'Gunakanlah kemudahan pembayaran tagihan','LTR',0,'L',true);
$pdf->Cell(63.3,4,'Program PT Asuransi Jiwa IFG Terbang ke Inggris adalah','LTR',0,'L',true);
$pdf->Cell(63.3,4,'Dapatkan official merchandise PT Asuransi Jiwa IFG branding ','LTR',0,'L',true);
$pdf->ln();
$pdf->Cell(63.3,4,'premi melalui channel Host-to-Host Bank BNI, BRI, ','LR',0,'L',true);
$pdf->Cell(63.3,4,'program yang akan memberikan reward kepada ','LR',0,'L',true);
$pdf->Cell(63.3,4,'Manchester City FC melalui PT Asuransi Jiwa IFG Super Poin','LR',0,'L',true);
$pdf->ln();
$pdf->Cell(63.3,4,'Mandiri, Kantor Pos, Indomaret, Alfamart dan ','LR',0,'L',true);
$pdf->Cell(63.3,4,'Pemegang Polis PT Asuransi Jiwa IFG untuk Tour di Kota ','LR',0,'L',true);
$pdf->Cell(63.3,4,'periode 2016/2017 degan sistem pengumpulan ','LR',0,'L',true);
$pdf->ln();
$pdf->Cell(63.3,4,'Bimasakti','LR',0,'L',true);
$pdf->Cell(63.3,4,'London serta menonton pertandingan Manchester ','LR',0,'L',true);
$pdf->Cell(63.3,4,'Poin dari setiap pembelian polis PT Asuransi Jiwa IFG','LR',0,'L',true);
$pdf->ln();
$pdf->Cell(63.3,4,'Info : http://goo.gl/mH77Fq','LBR',0,'L',true);
$pdf->Cell(63.3,4,'City di Etihad Stadium secara gratis','LBR',0,'L',true);
$pdf->Cell(63.3,4,'Info : https://jiwasraya.co.id/poin/','LBR',0,'L',true);
$pdf->ln(7);


$pdf->AliasNbPages('{totalPages}');
$pdf->Cell(190, 4, "Halaman " . $pdf->PageNo() . "/{totalPages}",' ', 0, 'R');

// OUTPUT
$pdf->Output('JATUH_TEMPO_PREMI_'.$row["PREFIXPERTANGGUNGAN"].'-'.$row["NOPERTANGGUNGAN"].'.pdf','D');

?>


<? 
							};
?>