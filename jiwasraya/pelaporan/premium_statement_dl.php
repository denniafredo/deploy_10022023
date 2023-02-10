<?  

//header("Content-type: application/vnd.ms-excel");
//header("Content-Disposition: attachment; filename=virtual_account.xls" );
//header("Expires: 0");
//header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
//header("Pragma: public");


  	include "../../includes/session.php"; 
  	include "../../includes/starttimer.php"; 
  	include "../../includes/database.php"; 
	include "../../includes/common.php";
	include "../../includes/fungsi.php";
	include "../../includes/oradb.class.php";

  $DB = new Database($userid, $passwd, $DBName);
	//$DBUL=New database($userid, $passwd, $DBName);
  $DBX = new Database($userid, $passwd, $DBName);
	//$DBX=new database($userid, $passwd, $DBName);
	
	?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Premium Statement</title>
</head>
<style type="text/css">
<!-- 
body, td, select, input {
 font-family: Verdana;
 font-size: 10px;
} 
-->
</style>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<body>
DAFTAR PREMIUM STATEMENT
<?
function toTglIna($tglid)
{
      $tgl = substr($tglid,-2);
			$bul = substr($tglid,5,2);
			$thn = substr($tglid,0,4);
			switch ($bul)	{
		          case "01": $bln = "Januari"; break;
	            case "02": $bln = "Pebruari"; break;
	            case "03": $bln = "Maret"; break;
		          case "04": $bln = "April"; break;
		          case "05": $bln = "Mei"; break;
		          case "06": $bln = "Juni"; break;
		          case "07": $bln = "Juli"; break;
		          case "08": $bln = "Agustus"; break;
		          case "09": $bln = "September"; break;
		          case "10": $bln = "Oktober"; break;
		          case "11": $bln = "Nopember"; break;
		          case "12": $bln = "Desember"; break;
           }
			$formattanggal = $tgl." ".strtoupper($bln)." ".$thn;
			return $formattanggal;
}
#---dateadd
#$newdate = dateadd("d",3,"2006-12-12");	#  add 3 days to date
#$newdate = dateadd("s",3,"2006-12-12");	#  add 3 seconds to date
#$newdate = dateadd("m",3,"2006-12-12");	#  add 3 minutes to date
#$newdate = dateadd("h",3,"2006-12-12");	#  add 3 hours to date
#$newdate = dateadd("ww",3,"2006-12-12");	#  add 3 weeks days to date
#$newdate = dateadd("m",3,"2006-12-12");	#  add 3 months to date
#$newdate = dateadd("yyyy",3,"2006-12-12");	#  add 3 years to date
#$newdate = dateadd("d",-3,"2006-12-12");	#  subtract 3 days from date

function dateAdd($interval,$number,$dateTime) {
		
	$dateTime = (strtotime($dateTime) != -1) ? strtotime($dateTime) : $dateTime;	   
	$dateTimeArr=getdate($dateTime);
				
	$yr=$dateTimeArr[year];
	$mon=$dateTimeArr[mon];
	$day=$dateTimeArr[mday];
	$hr=$dateTimeArr[hours];
	$min=$dateTimeArr[minutes];
	$sec=$dateTimeArr[seconds];

	switch($interval) {
		case "s"://seconds
			$sec += $number; 
			break;

		case "n"://minutes
			$min += $number; 
			break;

		case "h"://hours
			$hr += $number; 
			break;

		case "d"://days
			$day += $number; 
			break;

		case "ww"://Week
			$day += ($number * 7); 
			break;

		case "m": //similar result "m" dateDiff Microsoft
			$mon += $number; 
			break;

		case "yyyy": //similar result "yyyy" dateDiff Microsoft
			$yr += $number; 
			break;

		default:
			$day += $number; 
         }	   
				
		$dateTime = mktime($hr,$min,$sec,$mon,$day,$yr);
		$dateTimeArr=getdate($dateTime);
		
		$nosecmin = 0;
		$min=$dateTimeArr[minutes];
		$sec=$dateTimeArr[seconds];

		if ($hr==0){$nosecmin += 1;}
		if ($min==0){$nosecmin += 1;}
		if ($sec==0){$nosecmin += 1;}
		
		if ($nosecmin>2){ 	return(date("Y-m-d",$dateTime));} else { 	return(date("Y-m-d G:i:s",$dateTime));}
}

#---end dateadd 
//echo "<hr size=1>";

echo "  <form name=produksi method=post action=$PHP_SELF>";



			
//echo "<hr size=1>";
#--------------------------------------------------- end navigasi --------------

if ($kdbank=='%'){ 
	$kodebank1="";
}
else {
	$kodebank1=" AND b.kdbank = '".$kdbank."' ";
}

		
      echo "PERIODE PEMBAYARAN ".$tglDari." s/d ".$tglSampai."<br><br>";
/*	  
	  $sql= "SELECT  b.prefixpertanggungan || b.nopertanggungan AS nopol,
           b.nopol AS nopollama,
           DECODE (b.kdvaluta, '3', 'US$', '0', 'Rp', 'Rp') notasivaluta,
           e.namaklien1,
           e.alamattagih01,
           e.alamattagih02,
           e.kodepostagih, (SELECT MAX(k.NAMAKOTAMADYA)
      FROM $DBUser.TABEL_109_KOTAMADYA k
      WHERE k.KDKOTAMADYA = e.KDKOTAMADYATAGIH) AS kodya
			FROM   $DBUser.TABEL_300_HISTORIS_PREMI d,
				   $DBUser.TABEL_200_PERTANGGUNGAN b,
				   $DBUser.TABEL_315_PELUNASAN_AUTO_DEBET a,
				   $DBUser.TABEL_500_PENAGIH c,
				   $DBUser.TABEL_100_KLIEN e,
				   $DBUser.TABEL_001_KANTOR f
		   WHERE       b.prefixpertanggungan = d.prefixpertanggungan
				   AND b.nopertanggungan = d.nopertanggungan
				   AND b.prefixpertanggungan = SUBSTR (a.nopolis, 1, 2)
				   AND b.nopertanggungan = SUBSTR (a.nopolis, 3, 9)
				   AND a.tglbooked = d.tglbooked
				   AND d.tglbooked BETWEEN to_date('".$tglDari."','DD/MM/YYYY') AND to_date('".$tglSampai."','DD/MM/YYYY')
				   AND b.nopenagih = c.nopenagih
				   AND e.noklien = b.nopembayarpremi
				   AND c.kdrayonpenagih = f.kdkantor
				   AND f.kdkantor = '$kdkantor'
				   AND b.autodebet = '1' ".$kodebank1."
		GROUP BY   b.prefixpertanggungan,
				   b.nopertanggungan,
				   b.nopol,
				   b.kdvaluta,
				   e.namaklien1,
				   e.alamattagih01,
				   e.alamattagih02,
				   e.kodepostagih, e.KDKOTAMADYATAGIH";
*/ 

if ($kdcarabayar=='all' && $kdkantor=='all'){
		$sqlx= "SELECT  b.prefixpertanggungan || b.nopertanggungan AS nopol,
				   b.nopol AS nopollama,
				   DECODE (b.kdvaluta, '3', 'US$', '0', 'Rp', 'Rp') notasivaluta,
				   e.namaklien1,
				   e.alamattagih01,
				   e.alamattagih02,
				   e.kodepostagih, g.NAMABANK,h.namakotamadya,i.namapropinsi ";
				$sqlx .=  ",(SELECT nilaimeterai From $DBUser.TABEL_999_BATAS_MATERAI WHERE (SELECT SUM(premi) From $DBUser.tabel_223_transaksi_produk Where prefixpertanggungan = b.prefixpertanggungan AND nopertanggungan = b.nopertanggungan AND NVL(premi,0) > 0) BETWEEN batasbawahpremi AND batasataspremi) materai ";
				$sqlx .=	"FROM  $DBUser.TABEL_300_HISTORIS_PREMI d,
						   $DBUser.TABEL_200_PERTANGGUNGAN b,
						   $DBUser.TABEL_315_PELUNASAN_AUTO_DEBET a,
						   $DBUser.TABEL_500_PENAGIH c,
						   $DBUser.TABEL_100_KLIEN e,
						   $DBUser.TABEL_001_KANTOR f, $DBUser.TABEL_399_BANK g,
						   $DBUser.TABEL_109_KOTAMADYA h,
						   $DBUser.TABEL_108_PROPINSI i
				   WHERE       b.prefixpertanggungan = d.prefixpertanggungan
						   AND b.nopertanggungan = d.nopertanggungan
						   AND b.prefixpertanggungan = SUBSTR (a.nopolis, 1, 2)
						   AND b.nopertanggungan = SUBSTR (a.nopolis, 3, 9)
						   AND a.tglbooked = d.tglbooked
						   AND d.tglbooked BETWEEN to_date('".$tglDari."','DD/MM/YYYY') AND to_date('".$tglSampai."','DD/MM/YYYY')
						   AND b.nopenagih = c.nopenagih
						   AND e.noklien = b.nopemegangpolis
						   AND c.kdrayonpenagih = f.kdkantor
						   /*AND f.kdkantor = '$kdkantor'*/
						   AND b.autodebet = '1' ".$kodebank1." 
						   AND b.kdbank = g.kdbank
						   /*AND b.kdcarabayar = '$kdcarabayar'*/
						   AND h.kdkotamadya = e.kdkotamadyatagih
						   AND i.kdpropinsi = e.kdpropinsitagih
				GROUP BY   b.prefixpertanggungan,
						   b.nopertanggungan,
						   b.nopol,
						   b.kdvaluta,
						   e.namaklien1,
						   e.alamattagih01,
						   e.alamattagih02,
						   e.kodepostagih, g.namabank,
						   h.namakotamadya,
						   i.namapropinsi ";
						   
		$sql = "select
				PREFIXPERTANGGUNGAN,NOPERTANGGUNGAN,NOPOL,NOPOLLAMA,NOTASIVALUTA,NAMAKLIEN1,ALAMATTAGIH01,
				ALAMATTAGIH02,kodya,KODEPOSTAGIH,KDCARABAYAR,CARABAYAR,KODYA,PREMI,
				(SELECT max(nilaimeterai) From $DBUser.TABEL_999_BATAS_MATERAI  
				 WHERE a.premi between batasbawahpremi and batasataspremi) materai  
				from 
				(      SELECT   b.prefixpertanggungan,
							   b.nopertanggungan,
							   b.prefixpertanggungan || b.nopertanggungan AS nopol,
							   b.nopol AS nopollama,
							   DECODE (b.kdvaluta, '3', 'US$', '0', 'Rp', 'Rp') notasivaluta,
							   e.namaklien1,
							   e.alamattagih01,
							   e.alamattagih02,
							   e.kodepostagih,
							   b.kdcarabayar,
							   (SELECT   cb.namacarabayar
								  FROM   $DBUser.TABEL_305_CARA_BAYAR cb
								 WHERE   cb.kdcarabayar = b.kdcarabayar)
								  AS carabayar,
							   (SELECT   MAX (k.NAMAKOTAMADYA)
								  FROM   $DBUser.TABEL_109_KOTAMADYA k
								 WHERE   k.KDKOTAMADYA = e.KDKOTAMADYATAGIH)
								  AS kodya,
							   sum(TO_NUMBER(JUMLAHTAGIHAN)/100) premi
						FROM   $DBUser.TABEL_300_HISTORIS_PREMI d,
							   $DBUser.TABEL_200_PERTANGGUNGAN b,
							   $DBUser.TABEL_315_PELUNASAN_AUTO_DEBET a,
							   $DBUser.TABEL_500_PENAGIH c,
							   $DBUser.TABEL_100_KLIEN e,
							   $DBUser.TABEL_001_KANTOR f
					   WHERE       b.prefixpertanggungan = d.prefixpertanggungan
							   AND b.nopertanggungan = d.nopertanggungan
							   AND b.prefixpertanggungan = SUBSTR (a.nopolis, 1, 2)
							   AND b.nopertanggungan = SUBSTR (a.nopolis, 3, 9)
							   AND a.tglbooked = d.tglbooked
							   AND d.tglbooked BETWEEN TO_DATE ('".$tglDari."', 'DD/MM/YYYY')
												   AND  TO_DATE ('".$tglSampai."', 'DD/MM/YYYY')
							   AND b.nopenagih = c.nopenagih
							   AND e.noklien = b.nopembayarpremi
							   AND c.kdrayonpenagih = f.kdkantor
							   AND b.autodebet = '1'
					GROUP BY   b.prefixpertanggungan,
							   b.nopertanggungan,
							   b.nopol,
							   b.kdvaluta,
							   e.namaklien1,
							   e.alamattagih01,
							   e.alamattagih02,
							   e.kodepostagih,
							   b.kdcarabayar,
							   e.KDKOTAMADYATAGIH) a                              
						   where rownum < 100000";				   
		   
	}
	else
	{
	$sqlx= "SELECT  b.prefixpertanggungan || b.nopertanggungan AS nopol,
				   b.nopol AS nopollama,
				   DECODE (b.kdvaluta, '3', 'US$', '0', 'Rp', 'Rp') notasivaluta,
				   e.namaklien1,
				   e.alamattagih01,
				   e.alamattagih02,
				   e.kodepostagih, g.NAMABANK,h.namakotamadya,i.namapropinsi ";
				$sqlx .=  ",(SELECT nilaimeterai From $DBUser.TABEL_999_BATAS_MATERAI WHERE (SELECT SUM(premi) From $DBUser.tabel_223_transaksi_produk Where prefixpertanggungan = b.prefixpertanggungan AND nopertanggungan = b.nopertanggungan AND NVL(premi,0) > 0) BETWEEN batasbawahpremi AND batasataspremi) materai ";
				$sqlx .=	"FROM  $DBUser.TABEL_300_HISTORIS_PREMI d,
						   $DBUser.TABEL_200_PERTANGGUNGAN b,
						   $DBUser.TABEL_315_PELUNASAN_AUTO_DEBET a,
						   $DBUser.TABEL_500_PENAGIH c,
						   $DBUser.TABEL_100_KLIEN e,
						   $DBUser.TABEL_001_KANTOR f, $DBUser.TABEL_399_BANK g,
						   $DBUser.TABEL_109_KOTAMADYA h,
						   $DBUser.TABEL_108_PROPINSI i
				   WHERE       b.prefixpertanggungan = d.prefixpertanggungan
						   AND b.nopertanggungan = d.nopertanggungan
						   AND b.prefixpertanggungan = SUBSTR (a.nopolis, 1, 2)
						   AND b.nopertanggungan = SUBSTR (a.nopolis, 3, 9)
						   AND a.tglbooked = d.tglbooked
						   AND d.tglbooked BETWEEN to_date('".$tglDari."','DD/MM/YYYY') AND to_date('".$tglSampai."','DD/MM/YYYY')
						   AND b.nopenagih = c.nopenagih
						   AND e.noklien = b.nopembayarpremi
						   AND c.kdrayonpenagih = f.kdkantor
						   AND f.kdkantor = '$kdkantor'
						   AND b.autodebet = '1' ".$kodebank1." 
						   AND b.kdbank = g.kdbank
						   AND b.kdcarabayar = '$kdcarabayar'
						   AND h.kdkotamadya = e.kdkotamadyatagih
						   AND i.kdpropinsi = e.kdpropinsitagih
				GROUP BY   b.prefixpertanggungan,
						   b.nopertanggungan,
						   b.nopol,
						   b.kdvaluta,
						   e.namaklien1,
						   e.alamattagih01,
						   e.alamattagih02,
						   e.kodepostagih, g.namabank,
						   h.namakotamadya,
						   i.namapropinsi ";					   
	
	$sql = "select
				PREFIXPERTANGGUNGAN,NOPERTANGGUNGAN,NOPOL,NOPOLLAMA,NOTASIVALUTA,NAMAKLIEN1,ALAMATTAGIH01,
				ALAMATTAGIH02,kodya,KODEPOSTAGIH,KDCARABAYAR,CARABAYAR,KODYA,PREMI,
				(SELECT max(nilaimeterai) From $DBUser.TABEL_999_BATAS_MATERAI  
				 WHERE a.premi between batasbawahpremi and batasataspremi) materai  
				from 
				(      SELECT   b.prefixpertanggungan,
							   b.nopertanggungan,
							   b.prefixpertanggungan || b.nopertanggungan AS nopol,
							   b.nopol AS nopollama,
							   DECODE (b.kdvaluta, '3', 'US$', '0', 'Rp', 'Rp') notasivaluta,
							   e.namaklien1,
							   e.alamattagih01,
							   e.alamattagih02,
							   e.kodepostagih,
							   b.kdcarabayar,
							   (SELECT   cb.namacarabayar
								  FROM   $DBUser.TABEL_305_CARA_BAYAR cb
								 WHERE   cb.kdcarabayar = b.kdcarabayar)
								  AS carabayar,
							   (SELECT   MAX (k.NAMAKOTAMADYA)
								  FROM   $DBUser.TABEL_109_KOTAMADYA k
								 WHERE   k.KDKOTAMADYA = e.KDKOTAMADYATAGIH)
								  AS kodya,
							   sum(TO_NUMBER(JUMLAHTAGIHAN)/100) premi
						FROM   $DBUser.TABEL_300_HISTORIS_PREMI d,
							   $DBUser.TABEL_200_PERTANGGUNGAN b,
							   $DBUser.TABEL_315_PELUNASAN_AUTO_DEBET a,
							   $DBUser.TABEL_500_PENAGIH c,
							   $DBUser.TABEL_100_KLIEN e,
							   $DBUser.TABEL_001_KANTOR f
					   WHERE       b.prefixpertanggungan = d.prefixpertanggungan
							   AND b.nopertanggungan = d.nopertanggungan
							   AND b.prefixpertanggungan = SUBSTR (a.nopolis, 1, 2)
							   AND b.nopertanggungan = SUBSTR (a.nopolis, 3, 9)
							   AND a.tglbooked = d.tglbooked
							   AND d.tglbooked BETWEEN TO_DATE ('".$tglDari."', 'DD/MM/YYYY')
												   AND  TO_DATE ('".$tglSampai."', 'DD/MM/YYYY')
							   AND b.nopenagih = c.nopenagih
							   AND e.noklien = b.nopembayarpremi
							   AND c.kdrayonpenagih = f.kdkantor
							   AND c.kdrayonpenagih = '".$kdkantor."'
							   AND b.autodebet = '1'
							   ".$carabayar."
					GROUP BY   b.prefixpertanggungan,
							   b.nopertanggungan,
							   b.nopol,
							   b.kdvaluta,
							   e.namaklien1,
							   e.alamattagih01,
							   e.alamattagih02,
							   e.kodepostagih,
							   b.kdcarabayar,
							   e.KDKOTAMADYATAGIH) a                              
						   where rownum < 100000";	

	}
	  //echo $sql;
	  //die;
//echo "<a href=# onclick=NewWindow('download_virtual_acc.php?tglDari=".$tglDari."&tglSampai=".$tglSampai."','',700,400,1)>Download XLS</a>";				
?>
<br />

<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
  <tr>
    <td bgcolor="#89acd8" align="center">No.</td>
	<td bgcolor="#89acd8" align="center">No. Polis</td>
    <td bgcolor="#89acd8" align="center">Pemegang Polis</td>
    <td bgcolor="#89acd8" align="center">Alamat</td>
    <td bgcolor="#89acd8" align="center">Kota</td>
    <td bgcolor="#89acd8" align="center">Kode Pos</td>
    <td bgcolor="#89acd8" align="center">Premi</td>
    <td bgcolor="#89acd8" align="center">Materai</td>    
  </tr>
  <? 
	 // echo $sql;
	 //die;
  
  	$DB->parse($sql);
    $DB->execute();				
		$i = 1;
   	while ($arr=$DB->nextrow()) {
  	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	?>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=$i;?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=$arr["NOPOLLAMA"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=$arr["NAMAKLIEN1"];?></td>
	<td align="left" style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=$arr["ALAMATTAGIH01"].' '.$arr["ALAMATTAGIH02"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=$arr["KODYA"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=$arr["KODEPOSTAGIH"];?></td>
    <td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=number_format($arr["PREMI"],2,',','.');?></td>
      <td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=number_format($arr["MATERAI"],2,',','.');?></td>
	<? 
	$i++;

	}
	
	?>
      </tr>
</table>