<? 
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
	include "../../includes/kantor.php";
	//include "../../includes/komisiagen.php";
	
    $DB=new database($userid, $passwd, $DBName);
    $DBA=new database($userid, $passwd, $DBName);
	$KTR=new Kantor($userid,$passwd,$kantor);
	
	function ShowFromDate($year_interval,$YearIntervalType) {
  GLOBAL $daydari,$monthdari,$yeardari,$tglawal,$tglakhir;

	
  //MONTH
  echo "<select name=tglawal>";
  for ($i = 1; $i <= 31; $i++) {
		if($i < 10){
			echo "<option value=0".$i.">0".$i."</option>";
		}
		else{
			echo "<option value=".$i.">".$i."</option>";
		}
	}
  
  echo "</select>";
  
  echo "<select name=monthdari>\n";
  $i=1;
  $CurrMonth=date("m");
  while ($i <= 12)
       {
  		 				switch($i)
  						{
  							  case 1: $namabulandari = "JANUARI"; break;
  								case 2: $namabulandari = "PEBRUARI"; break;
									case 3: $namabulandari = "MARET"; break;
									case 4: $namabulandari = "APRIL"; break;
									case 5: $namabulandari = "MEI"; break;
									case 6: $namabulandari = "JUNI"; break;
									case 7: $namabulandari = "JULI"; break;
									case 8: $namabulandari = "AGUSTUS"; break;
  								case 9: $namabulandari = "SEPTEMBER"; break;
  								case 10: $namabulandari = "OKTOBER"; break;
									case 11: $namabulandari = "NOVEMBER"; break;
									case 12: $namabulandari = "DESEMBER"; break;
  								default : $namabulandari = $i;
  						}
  		
		if(isset($monthdari)) {
			$monthawal = $monthdari;			
		}
		 
        If(IsSet($monthdari)) {
           If($monthdari == $i || ($i == substr($monthdari,1,1) && (substr($monthdari,0,1) == 0))) {
              $n = (strlen($i)==1) ? "0$i" : "$i";
							echo "<option value=$n selected>$namabulandari\n";
              $i++;
           }Else{
  						If($i<10) {
                 echo "<option value=0$i>$namabulandari\n";
              }Else {
                 echo "<option value=$i>$namabulandari\n";
              }
              $i++;
           }
        }Else {
              If($i == $CurrMonth) {
                If($i<10) {
                   echo "<option value=0$i selected>$namabulandari\n";
                }Else {
                   echo "<option value=$i selected>$namabulandari\n";
                }
              }Else {
                If($i<10){
                   echo "<option value=0$i>$namabulandari\n";
  							}Else {
                   echo "<option value=$i>$namabulandari\n";
                }
              }
              $i++;
        }
  }
    echo "</select>\n";
  
  //YEAR
    echo "<select name=yeardari>\n";
    $CurrYear=date("Y");
    If($YearIntervalType == "Past") {
        $i=$CurrYear-$year_interval+1;
        while ($i <= $CurrYear)
             {
              If($i == $yeardari) {
                 echo "<option selected> $i\n";
              }ElseIf ($i == $CurrYear && !IsSet($yeardari)) {
                 echo "<option selected> $i\n";
              }Else {
                 echo "<option> $i\n";
              }
              $i++;
             }
         echo "</select>\n";
    }
    If($YearIntervalType == "Future") {
        $i=$CurrYear+$year_interval;
        while ($CurrYear < $i)
             {
              if ($year == $CurrYear) echo "<option selected> $CurrYear\n";
                else echo "<option> $CurrYear\n";
              $CurrYear++;
             }
         echo "</select>\n";
    }
    If($YearIntervalType == "Both") {
        $i=$CurrYear-$year_interval+1;
        while ($i < $CurrYear+$year_interval)
             {
              if ($i == $CurrYear) echo "<option selected> $i\n";
                else echo "<option> $i\n";
              $i++;
             }
         echo "</select>\n";
    }
  }
	
	if(isset($monthdari))
	{ 	 
	  $bulandari = $yeardari.$monthdari.$tglawal;
	}
	else
	{
	  $monthdari=date("m");
		$yeardari=date("Y");
	  $bulandari = $yeardari.$monthdari;
	}
	
	
	  					switch($monthdari)
  						{
  							  case '01': $namabulandari = "JANUARI"; break;
  								case '02': $namabulandari = "PEBRUARI"; break;
									case '03': $namabulandari = "MARET"; break;
									case '04': $namabulandari = "APRIL"; break;
									case '05': $namabulandari = "MEI"; break;
									case '06': $namabulandari = "JUNI"; break;
									case '07': $namabulandari = "JULI"; break;
									case '08': $namabulandari = "AGUSTUS"; break;
  								case '09': $namabulandari = "SEPTEMBER"; break;
  								case '10': $namabulandari = "OKTOBER"; break;
									case '11': $namabulandari = "NOVEMBER"; break;
									case '12': $namabulandari = "DESEMBER"; break;
  						}

	function ShowToDate($year_interval,$YearIntervalType) {
  GLOBAL $daysampai,$monthsampai,$yearsampai;

  //MONTH
  echo "<select name=tglakhir>";
  for ($i = 1; $i <= 31; $i++) {
		if($i < 10){
			echo "<option value=0".$i.">0".$i."</option>";
		}
		else{
			echo "<option value=".$i.">".$i."</option>";
		}
	}
  
  echo "</select>";
  echo "<select name=monthsampai>\n";
  $i=1;
  $CurrMonth=date("m");
  while ($i <= 12)
       {
  		 				switch($i)
  						{
  							  case 1: $namabulansampai = "JANUARI"; break;
  								case 2: $namabulansampai = "PEBRUARI"; break;
									case 3: $namabulansampai = "MARET"; break;
									case 4: $namabulansampai = "APRIL"; break;
									case 5: $namabulansampai = "MEI"; break;
									case 6: $namabulansampai = "JUNI"; break;
									case 7: $namabulansampai = "JULI"; break;
									case 8: $namabulansampai = "AGUSTUS"; break;
  								case 9: $namabulansampai = "SEPTEMBER"; break;
  								case 10: $namabulansampai = "OKTOBER"; break;
									case 11: $namabulansampai = "NOVEMBER"; break;
									case 12: $namabulansampai = "DESEMBER"; break;
  								default : $namabulansampai = $i;
  						}
  		 
        If(IsSet($monthsampai)) {
           If($monthsampai == $i || ($i == substr($monthsampai,1,1) && (substr($monthsampai,0,1) == 0))) {
              $n = (strlen($i)==1) ? "0$i" : "$i";
							echo "<option value=$n selected>$namabulansampai\n";
              $i++;
           }Else{
  						If($i<10) {
                 echo "<option value=0$i>$namabulansampai\n";
              }Else {
                 echo "<option value=$i>$namabulansampai\n";
              }
              $i++;
           }
        }Else {
              If($i == $CurrMonth) {
                If($i<10) {
                   echo "<option value=0$i selected>$namabulansampai\n";
                }Else {
                   echo "<option value=$i selected>$namabulansampai\n";
                }
              }Else {
                If($i<10){
                   echo "<option value=0$i>$namabulansampai\n";
  							}Else {
                   echo "<option value=$i>$namabulansampai\n";
                }
              }
              $i++;
        }
  }
    echo "</select>\n";
  
  //YEAR
    echo "<select name=yearsampai>\n";
    $CurrYear=date("Y");
    If($YearIntervalType == "Past") {
        $i=$CurrYear-$year_interval+1;
        while ($i <= $CurrYear)
             {
              If($i == $year) {
                 echo "<option selected> $i\n";
              }ElseIf ($i == $CurrYear && !IsSet($year)) {
                 echo "<option selected> $i\n";
              }Else {
                 echo "<option> $i\n";
              }
              $i++;
             }
         echo "</select>\n";
    }
    If($YearIntervalType == "Future") {
        $i=$CurrYear+$year_interval;
        while ($CurrYear < $i)
             {
              if ($year == $CurrYear) echo "<option selected> $CurrYear\n";
                else echo "<option> $CurrYear\n";
              $CurrYear++;
             }
         echo "</select>\n";
    }
    If($YearIntervalType == "Both") {
        $i=$CurrYear-$year_interval+1;
        while ($i < $CurrYear+$year_interval)
             {
              if ($i == $CurrYear) echo "<option selected> $i\n";
                else echo "<option> $i\n";
              $i++;
             }
         echo "</select>\n";
    }
  }
	
	if(isset($monthsampai))
	{
	  $bulansampai = $yearsampai.$monthsampai.$tglakhir;
	}
	else
	{
	  $monthsampai=date("m");
		$yearsampai=date("Y");
	  $bulansampai = $yearsampai.$monthsampai;
	}

	
	  					switch($monthsampai)
  						{
  							  case '01': $namabulansampai = "JANUARI"; break;
  								case '02': $namabulansampai = "PEBRUARI"; break;
									case '03': $namabulansampai = "MARET"; break;
									case '04': $namabulansampai = "APRIL"; break;
									case '05': $namabulansampai = "MEI"; break;
									case '06': $namabulansampai = "JUNI"; break;
									case '07': $namabulansampai = "JULI"; break;
									case '08': $namabulansampai = "AGUSTUS"; break;
  								case '09': $namabulansampai = "SEPTEMBER"; break;
  								case '10': $namabulansampai = "OKTOBER"; break;
									case '11': $namabulansampai = "NOVEMBER"; break;
									case '12': $namabulansampai = "DESEMBER"; break;
 						}
  
  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Untitled</title>
<style type="text/css">
<!-- 
body { 
 font-size: 12px;
 font-family: verdana;
 } 
td { 
 font-size: 11px;
 font-family: verdana;
 } 
-->
</style>
</head>
<?
	if ($mode=='print'){
		echo "<body onload=\"window.print();window.close()\">";
		echo "<body>";
		$bulandari = $_GET['bulandari'];
		$bulansampai = $_GET['bulansampai'];
	}
	else{
		echo "<body>";
?>

<form name="getpremi" action="<?=$PHP_SELF;?>" action="post">
  <a class="verdana10blk">Pilih Periode Bulan</a>  
  <?  ShowFromDate(10,"Past"); ?>
  <a class="verdana10blk"> s/d </a>  
  <?  ShowToDate(10,"Past"); ?>
  <select name="kdbank">
                                    
                                    <?
									
                                    $sql="select * from $DBUser.TABEL_399_BANK WHERE KDBANK IN ('CBN','CTB')";
									 $DB->parse($sql);
									 $DB->execute();
									 //echo $sql;
									 print( "<option value=".$arr["KDBANK"].">--PILIH--</option>" );
									 while ($arr=$DB->nextrow()){
									 	if ($arr["KDBANK"]==$kdbank) {
										   print( "<option value=".$arr["KDBANK"]." selected>".$arr["NAMABANK"]."</option>" );
										   $nmbank=$arr["NAMABANK"];
										} else {
										   print( "<option value=".$arr["KDBANK"].">".$arr["NAMABANK"]."</option>" );
										}
									  
									 }	?>
</select>
	<input type="submit" name="submit" value="Cari">
</form>
<br />

<?
}
?>

<br />
<div align="center">
<b>REKAPITULASI HASIL PREMI <? if ($kdbank=='CTB') { echo 'CITIBANK 1BILL';} else { echo 'BNI CREDIT CARD';}?> <br /> 
PERIODE <?=$namabulandari." ".$yeardari;?> s/d <?=$namabulansampai." ".$yearsampai;?> <br />SECARA NASIONAL</b><br><br>
</div>

<? 
if($kdbank=='BMRI' || $kdbank=='BBRI' || $kdbank=='BIMA') {
	$sql="SELECT   DISTINCT c.kdrayonpenagih AS kdkantor
				FROM   $DBUser.tabel_300_historis_premi d,
					   $DBUser.tabel_200_pertanggungan b,
					   $DBUser.tabel_315_pelunasan_H2H a,
					   $DBUser.tabel_500_penagih c,
					   $DBUser.tabel_202_produk e
			   WHERE       b.prefixpertanggungan = SUBSTR (a.no_polis, 1, 2)
					   AND b.nopertanggungan = SUBSTR (a.no_polis, 3, 9)
					   AND b.prefixpertanggungan = d.prefixpertanggungan
					   AND SUBSTR (b.kdproduk, 1, 2) <> 'JL'
					   AND b.nopertanggungan = d.nopertanggungan
					   AND a.tgl_booked = d.tglbooked
					   AND b.nopenagih = c.nopenagih
					   AND a.void = '0'
					   AND TO_CHAR (a.entry_time, 'YYYYMMDD') between '$bulandari' and  '$bulansampai'
					   AND b.kdproduk = e.kdproduk
					   AND a.company_code = '".$kdbank."'
			ORDER BY   c.kdrayonpenagih";
} 
else {
	$filter = $kdbank != 'CBN' ? ' and a.tglbooked = d.tglbooked ' : null;
	
$sql = "select ". 
            "distinct c.kdrayonpenagih as kdkantor ". 
          "from ".
            "$DBUser.tabel_300_historis_premi d, ".
            "$DBUser.tabel_200_pertanggungan b, ".
            "$DBUser.tabel_315_pelunasan_auto_debet a, ".
            "$DBUser.tabel_500_penagih c, ".
						"$DBUser.tabel_202_produk e ".
          "where ".
						"b.prefixpertanggungan=substr(a.nopolis,1,2) and ". 
   					"b.nopertanggungan=substr(a.nopolis,3,9) and ".
						"b.prefixpertanggungan=d.prefixpertanggungan and ". 
						"substr(b.kdproduk,1,2)<>'JL' and ".
            "b.nopertanggungan=d.nopertanggungan $filter and ". 
            "b.nopenagih=c.nopenagih and a.statuspembayaran='2' and ".
//						"b.kdvaluta='1' and ". 
						"to_char(a.tglrekam,'YYYYMMDD') between '$bulandari' and  '$bulansampai' and ".
						"b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' order by c.kdrayonpenagih";}
		//echo $sql;
    //die;
		$DB->parse($sql);
	  $DB->execute();
  	$arp = $DB->result();	
?>

<!-- COBA ------------------------------------------------------------------------>

<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
  <tr>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    <b>No</b></td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    <b>Nomor BPS</b></td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    <b>No.Rekening</b></td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    <b>Kode Kantor - Nama Kantor</b></td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    <b>Total Premi</b></td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    <b>Total Discount</b></td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    <b>Total Materai</b></td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    <b>Total Debet</b></td>

  </tr>
	<tr>
	<? 

$i=1;
$total=0;

$totalmatre=0;
$totaldiscount =0;
$totaltotaldebet =0;
$totalpremi=0;

${"totalpreminb"} =0;
${"totalpremiob"} =0;

${"totaldiscountnb"} =0;
${"totaldiscountob"} =0;

${"totalmatrenb"}=0;
${"totalmatreob"}=0;
${"totaltotaldebetnb"}=0;
${"totaltotaldebetob"} =0;

foreach ($arp as $foo => $roww ) {
	$kdrayonpenagih = $roww["KDKANTOR"];
	$jmlmatre=0;
	$jmldiscount =0;
	$jmltotaldebet =0;
	$jmlpremi=0;
	$jmltotaldisc=0;
	
	${"jmlpreminb"} =0;
	${"jmlpremiob"} =0;
	
	${"jmldiscountnb"} =0;
	${"jmldiscountob"} =0;
	
	${"jmlmatrenb"}=0;
	${"jmlmatreob"}=0;
	${"jmltotaldebetnb"}=0;
	${"jmltotaldebetob"} =0;
	
	//$i=1;
	$discountnb = 0;
	$discountob = 0;
	$preminb = 0;
	$premiob = 0;
	$matrenb = 0;
	$matreob = 0;
	$totaldebetnb = 0;
	$totaldebetob = 0;
	$jnb = 0;
	$job = 0;
	$jmlkomisith1 = 0;
	$jmlkomisith2 = 0;
	$jmlkomisith3 = 0;	
	
	
	if($kdbank=='BMRI' || $kdbank=='BBRI' || $kdbank=='BIMA') {
	$sql="SELECT   zz.*,
         0
            matere,
         (SELECT   premitagihan
            FROM   $DBUser.tabel_300_historis_rider
           WHERE   prefixpertanggungan = zz.prefixpertanggungan
                   AND nopertanggungan = zz.nopertanggungan
                   AND TO_CHAR (tglbooked, 'ddmmyyyy') =
                         TO_CHAR (zz.tglbuk, 'ddmmyyyy')
                   AND buktisetor = zz.buktistr)
            rider
  FROM   (  SELECT   c.kdrayonpenagih AS kodekantor,
                     (SELECT   namakantor
                        FROM   $DBUser.tabel_001_kantor
                       WHERE   kdkantor = c.kdrayonpenagih)
                        AS namakantor,
                     b.prefixpertanggungan,
                     b.nopertanggungan,
                     b.kdvaluta,
                     b.indexawal,
                     d.tglbooked AS tglbuk,
                     d.buktisetor AS buktistr,
                     d.kdkuitansi,
                     d.premitagihan,
                     d.kdrekeninglawan,
                     '272010' AS kodeakun,
                     (SELECT   nama
                        FROM   $DBUser.tabel_802_kodeakun
                       WHERE   akun = '272010')
                        AS namaakunperantara,
                     TO_NUMBER (a.bill_amount) / 100 AS jmlpremi,
                     a.no_polis,
                     TO_CHAR (a.tgl_booked, 'MM/YYYY') AS blntagihan,
                     null nokontrol,
                     null norekdebet,
                     null norekkredit,
                     a.void,
                     null nourut,
                     (SELECT   namaklien1
                        FROM   $DBUser.tabel_100_klien
                       WHERE   noklien = b.nopembayarpremi)
                        AS namaklien,
                     (SELECT   phonetetap01
                        FROM   $DBUser.tabel_100_klien
                       WHERE   noklien = b.nopembayarpremi)
                        AS telp1,
                     (SELECT   phonetetap02
                        FROM   $DBUser.tabel_100_klien
                       WHERE   noklien = b.nopembayarpremi)
                        AS telp2,
                     null beritakredit,
                     a.entry_time tglrekam,
                     TO_CHAR (d.tglbayar, 'DD/MM/YYYY') AS tglbayar,
                     a.entry_time tglupdated,
                     TO_CHAR (d.tglbayar, 'MM/YYYY') AS blnbayar,
                     b.nopenagih,
                     b.noagen,
                     b.norekeningdebet,
                     CEIL (MONTHS_BETWEEN (a.entry_time, b.mulas) / 12)
                        AS thnkomisi,
                     (SELECT   komisiagencb
                        FROM   $DBUser.tabel_404_temp
                       WHERE   prefixpertanggungan = b.prefixpertanggungan
                               AND nopertanggungan = b.nopertanggungan
                               AND thnkomisi =
                                     CEIL(MONTHS_BETWEEN (a.entry_time,
                                                          b.mulas)
                                          / 12)
                               AND kdkomisiagen = '01')
                        komisiagen,
                     (SELECT   kurs
                        FROM   $DBUser.tabel_999_kurs_transaksi
                       WHERE   tglkursberlaku =
                                  (SELECT   MAX (tglkursberlaku)
                                     FROM   $DBUser.tabel_999_kurs_transaksi
                                    WHERE   tglkursberlaku <= a.entry_time
                                            AND kdvaluta = b.kdvaluta)
                               AND kdvaluta = b.kdvaluta)
                        kurs,
                     (SELECT   namaklien1
                        FROM   $DBUser.tabel_100_klien
                       WHERE   noklien = b.noagen)
                        AS namaagen,
                     e.kdcabas,
                     (SELECT   nilaimeterai
                        FROM   $DBUser.tabel_999_batas_materai
                       WHERE   TO_NUMBER (a.bill_amount) / 100 BETWEEN batasbawahpremi
                                                                     AND  batasataspremi)
                        AS materex,
                     DECODE (
                        TO_CHAR (a.tgl_booked, 'MM/YYYY'),
                        TO_CHAR (a.entry_time, 'MM/YYYY'),
                        DECODE (SUBSTR (b.KDPRODUK, 1, 3),
                                'JL2', 0,
                                'JL3', 0,
                                1)
                        * DECODE (
                             b.kdvaluta,
                             '1',
                             d.premitagihan,
                             '0',
                             ROUND (d.premitagihan / b.indexawal, 2)
                             * ROUND (
                                  (SELECT   kurs
                                     FROM   $DBUser.tabel_999_kurs_transaksi x
                                    WHERE   x.kdvaluta = b.kdvaluta
                                            AND x.tglkursberlaku =
                                                  (SELECT   MAX (
                                                               y.tglkursberlaku
                                                            )
                                                     FROM   $DBUser.tabel_999_kurs_transaksi y
                                                    WHERE   x.kdvaluta =
                                                               y.kdvaluta
                                                            AND y.tglkursberlaku <=
                                                                  a.entry_time)),
                                  2
                               ),
                             d.premitagihan
                             * (SELECT   kurs
                                  FROM   $DBUser.tabel_999_kurs_transaksi x
                                 WHERE   x.kdvaluta = b.kdvaluta
                                         AND x.tglkursberlaku =
                                               (SELECT   MAX (y.tglkursberlaku)
                                                  FROM   $DBUser.tabel_999_kurs_transaksi y
                                                 WHERE   x.kdvaluta =
                                                            y.kdvaluta
                                                         AND y.tglkursberlaku <=
                                                               a.entry_time))
                          )
                        / 100,
                        '0'
                     )
                        discox
              FROM   $DBUser.tabel_300_historis_premi d,
                     $DBUser.tabel_200_pertanggungan b,
                     $DBUser.tabel_315_pelunasan_h2h a,
                     $DBUser.tabel_500_penagih c,
                     $DBUser.tabel_202_produk e
             WHERE       b.prefixpertanggungan = SUBSTR (a.no_polis, 1, 2)
                     AND b.nopertanggungan = SUBSTR (a.no_polis, 3, 9)
                     AND b.prefixpertanggungan = d.prefixpertanggungan
                     AND b.nopertanggungan = d.nopertanggungan
                     AND a.tgl_booked = d.tglbooked
                     AND b.nopenagih = c.nopenagih
                     AND SUBSTR (b.kdproduk, 1, 2) <> 'JL'
                     AND a.void = '0'
                     AND TO_CHAR (a.entry_time, 'YYYYMMDD') between '$bulandari' and  '$bulansampai'
                     AND c.kdrayonpenagih = '$kdrayonpenagih'
                     AND b.kdproduk = e.kdproduk
                     AND a.company_code = '$kdbank'
          ORDER BY   d.kdkuitansi, d.prefixpertanggungan, d.nopertanggungan) zz";
	} 
	else {
	$sql = "select zz.*,". 
      "(select nilaimeterai
      from $DBUser.tabel_999_batas_materai
      where ".	  
/* Opsi 1*/	  
	"(select
           CASE
            WHEN ((SUBSTR(".$bulandari.",1,4)*12+SUBSTR(".$bulandari.",5,2))-(to_char(g.mulas,'YYYY')*12+to_char(g.mulas,'MM'))) <= 60 THEN 
			(DECODE (KDVALUTA,
                 '0', ROUND (g.premi1 / indexawal, 2),
                 g.premi1)
         * KURS)
            ELSE (DECODE (KDVALUTA,
                 '0', ROUND (g.premi2 / indexawal, 2),
                 g.premi2)
         * KURS)
         END
            AS premi 
            from $DBUser.tabel_200_pertanggungan g
            where prefixpertanggungan = zz.prefixpertanggungan
                   AND nopertanggungan = zz.nopertanggungan)".
/* Opsi 2
"	  DECODE(
		(select premitagihan from $DBUser.tabel_300_historis_premi where 
            prefixpertanggungan = zz.prefixpertanggungan
                               AND nopertanggungan = zz.nopertanggungan
                               and to_char(tglbooked,'ddmmyyyy')=to_char(zz.tglbuk,'ddmmyyyy'))
		,NULL,'0', (select premitagihan from $DBUser.tabel_300_historis_premi where 
            prefixpertanggungan = zz.prefixpertanggungan
                               AND nopertanggungan = zz.nopertanggungan
                               and to_char(tglbooked,'ddmmyyyy')=to_char(zz.tglbuk,'ddmmyyyy'))
		)".				  				
*/

/* Opsi 3
JMLPREMI
*/
"		-   
				   DECODE(disco,NULL,'0',disco) 
		+
	  DECODE(
	  (select premitagihan from $DBUser.tabel_300_historis_rider where 
            prefixpertanggungan = zz.prefixpertanggungan
                               AND nopertanggungan = zz.nopertanggungan
                               and to_char(tglbooked,'ddmmyyyy')=to_char(zz.tglbuk,'ddmmyyyy') and buktisetor=zz.buktistr )				  				 		,NULL,'0',	  (select premitagihan from $DBUser.tabel_300_historis_rider where 
            prefixpertanggungan = zz.prefixpertanggungan
                               AND nopertanggungan = zz.nopertanggungan
                               and to_char(tglbooked,'ddmmyyyy')=to_char(zz.tglbuk,'ddmmyyyy') and buktisetor=zz.buktistr )				  				 	)	
		   ".
      "between batasbawahpremi
      and batasataspremi ) matere,".

/*
	"(select nilaimeterai from $DBUser.tabel_999_batas_materai ".
		"where jmlpremi-disco between ".
		"batasbawahpremi and batasataspremi ".
		") matere,
*/		
	  "(select premitagihan from $DBUser.tabel_300_historis_rider where 
            prefixpertanggungan = zz.prefixpertanggungan
                               AND nopertanggungan = zz.nopertanggungan
                               and to_char(tglbooked,'ddmmyyyy')=to_char(zz.tglbuk,'ddmmyyyy')
                               and buktisetor=zz.buktistr ) rider ".
		"from (select ".
		"c.kdrayonpenagih as kodekantor,".
		"(select namakantor from $DBUser.tabel_001_kantor where kdkantor=c.kdrayonpenagih) as namakantor,".
		"b.prefixpertanggungan,b.nopertanggungan,b.kdvaluta,b.indexawal,".
		"d.tglbooked as tglbuk,d.buktisetor as buktistr,d.kdkuitansi,d.premitagihan,d.kdrekeninglawan,".
		"'272010' as kodeakun,".
		"(select nama from $DBUser.tabel_802_kodeakun where akun='272010') as namaakunperantara,".
		"to_number(a.jumlahtagihan)/100 as jmlpremi,".
		"a.nopolis,to_char(a.tglbooked,'MM/YYYY') as blntagihan,".
		"a.nokontrol,to_number(a.norekdebet) as norekdebet,a.norekkredit,a.statuspembayaran,".
		"a.nourut,".
		"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as namaklien, ".
		"(select phonetetap01 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as telp1, ".
		"(select phonetetap02 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as telp2, ".
		"a.beritakredit, ".
		"a.tglrekam,to_char(d.tglbayar,'DD/MM/YYYY') as tglbayar,a.tglupdated,".
		"to_char(d.tglbayar,'MM/YYYY') as blnbayar,".
		"b.nopenagih,b.noagen,b.norekeningdebet, ".
		"ceil(months_between(a.tglupdated,b.mulas)/12) as thnkomisi, ".
		
		"(select komisiagencb from $DBUser.tabel_404_temp ". 
		"where prefixpertanggungan=b.prefixpertanggungan ". 
		"and nopertanggungan=b.nopertanggungan ".
		"and thnkomisi= ceil(months_between(a.tglupdated,b.mulas)/12) ".
		"and kdkomisiagen='01') komisiagen, ".
		
		"(select kurs from $DBUser.tabel_999_kurs_transaksi where tglkursberlaku=".
      	       "(select max(tglkursberlaku) from $DBUser.tabel_999_kurs_transaksi ".
      	     	 "where tglkursberlaku<=a.tglrekam and kdvaluta=b.kdvaluta) ".
		 "and kdvaluta=b.kdvaluta ) kurs, ".
		 		
		"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.noagen) as namaagen, ".
		"e.kdcabas, ".
		
		"(select nilaimeterai from $DBUser.tabel_999_batas_materai ".
		"where to_number(a.jumlahtagihan)/100 between ".
		"batasbawahpremi and batasataspremi ".
		") as materex,		
		decode(to_char(a.tglbooked,'MM/YYYY'),to_char(a.tglrekam,'MM/YYYY'),DECODE(SUBSTR(b.KDPRODUK,1,3),'JL2',0,'JL3',0,1)*
           decode(b.kdvaluta,'1',d.premitagihan,'0',
                    ROUND(d.premitagihan/b.indexawal,2) * ROUND((SELECT kurs 
                                           FROM $DBUser.tabel_999_kurs_transaksi x 
                                        WHERE x.kdvaluta = b.kdvaluta
                                       AND x.tglkursberlaku = (SELECT max(y.tglkursberlaku) 
                                                                    FROM $DBUser.tabel_999_kurs_transaksi y
                                                               WHERE x.kdvaluta = y.kdvaluta 
                                                                 AND y.tglkursberlaku <= a.tglrekam)),2),
                    d.premitagihan * (SELECT kurs 
                                           FROM $DBUser.tabel_999_kurs_transaksi x 
                                        WHERE x.kdvaluta = b.kdvaluta
                                       AND x.tglkursberlaku = (SELECT max(y.tglkursberlaku) 
                                                                    FROM $DBUser.tabel_999_kurs_transaksi y
                                                               WHERE x.kdvaluta = y.kdvaluta 
                                                                 AND y.tglkursberlaku <= a.tglrekam))) /100,'0') disco ".
	"from ".
		"$DBUser.tabel_300_historis_premi d,".
		"$DBUser.tabel_200_pertanggungan b,".
		"$DBUser.tabel_315_pelunasan_auto_debet a,".
		"$DBUser.tabel_500_penagih c, ".
		"$DBUser.tabel_202_produk e ".
	"where ".
		"b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
		"b.nopertanggungan=substr(a.nopolis,3,9) and ".
		"b.prefixpertanggungan=d.prefixpertanggungan and ".
		"b.nopertanggungan=d.nopertanggungan and ".
		//"a.tglbooked=d.tglbooked and ".
		"to_char(a.tglbooked, 'MMYYYY')=to_char(d.tglbooked, 'MMYYYY') and ".
		"b.nopenagih=c.nopenagih and ".
		"substr(b.kdproduk,1,2)<>'JL' and ".
		"a.statuspembayaran='2' and ".
//		"b.kdvaluta='1' and ".
		"to_char(a.tglrekam,'YYYYMMDD') between '$bulandari' and  '$bulansampai' and ".
		"c.kdrayonpenagih='$kdrayonpenagih' and ".
		"b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' ".
	"order by d.kdkuitansi, d.prefixpertanggungan, d.nopertanggungan) zz";	
	}
	
	//echo $sql."<br /><br />";
	//die;
	$DB->parse($sql);
	$DB->execute();

	while ($arr=$DB->nextrow()) {
		$tglbayar=$arr["TGLBAYAR"];
		$kodeakun=$arr["KODEAKUN"];
		$kodekantor=$arr["KODEKANTOR"];
		$namakantor=$arr["NAMAKANTOR"];

		$kdkui = substr($arr["KDKUITANSI"],0,2);
		if($kdkui=="NB"){
			// IDX
			if ($arr["KDVALUTA"]=='0'){
				$preminb = round(($arr["PREMITAGIHAN"]+$arr["RIDER"])/ $arr["INDEXAWAL"],2) * $arr["KURS"];
				$premiob = 0;
				$discountnb = (round(($arr["PREMITAGIHAN"]+$arr["RIDER"])/ $arr["INDEXAWAL"],2) * 0.01 * $arr["KURS"]);
				$discountob = 0;
			}
			// USD
			elseif ($arr["KDVALUTA"]=='3'){
				$preminb = ($arr["PREMITAGIHAN"]+$arr["RIDER"]) * $arr["KURS"];
				$premiob = 0;
				$discountnb = (round(($arr["PREMITAGIHAN"]+$arr["RIDER"]),2) * 0.01 * $arr["KURS"]);
				$discountob = 0;
			}
			// IDR
			elseif ($arr["KDVALUTA"]=='1'){
				$preminb = ($arr["PREMITAGIHAN"]+$arr["RIDER"]);
				$premiob = 0;
				$discountnb = (($arr["PREMITAGIHAN"]+$arr["RIDER"]) * 0.01);
				$discountob = 0;
			}

			$matrenb		= $arr["MATERE"];
			$matreob		= 0;
			$totaldebetnb = $arr["JMLPREMI"];
			$totaldebetob = 0;
			$jnb++;
			${"kdreknb".$cabas} = $arr["KDREKENINGLAWAN"];
		}elseif($kdkui=="OB"){
			$premiob = ($arr["PREMITAGIHAN"]+$arr["RIDER"]);
			$preminb = 0;
			// IDX
			if ($arr["KDVALUTA"]=='0'){
				$premiob = round(($arr["PREMITAGIHAN"]+$arr["RIDER"])/ $arr["INDEXAWAL"],2) * $arr["KURS"];
				$preminb = 0;
				$discountob = (round(($arr["PREMITAGIHAN"]+$arr["RIDER"])/ $arr["INDEXAWAL"],2) * 0.01 * $arr["KURS"]);
				$discountnb = 0;
			}
			// USD
			elseif ($arr["KDVALUTA"]=='3'){
				$premiob = ($arr["PREMITAGIHAN"]+$arr["RIDER"]) * $arr["KURS"];
				$preminb = 0;
				$discountob = (round(($arr["PREMITAGIHAN"]+$arr["RIDER"]),2) * 0.01 * $arr["KURS"]);
				$discountnb = 0;
			}
			// IDR
			elseif ($arr["KDVALUTA"]=='1'){
				$premiob = ($arr["PREMITAGIHAN"]+$arr["RIDER"]);
				$preminb = 0;
				$discountob = (($arr["PREMITAGIHAN"]+$arr["RIDER"]) * 0.01);
				$discountnb = 0;
			}

			$matreob		= $arr["MATERE"];
			$matrenb		= 0;
			$totaldebetob = $arr["JMLPREMI"];
			$totaldebetnb = 0;
			$job++;
			${"kdrekob".$cabas} = $arr["KDREKENINGLAWAN"];
		}

		if($arr["BLNBAYAR"]!=$arr["BLNTAGIHAN"]){
			$discount = 0;
			$discountnb = 0;
			$discountob = 0;
		}else{
			// IDX
			if ($arr["KDVALUTA"]=='0'){
				$discount = (round(($arr["PREMITAGIHAN"]+$arr["RIDER"])/ $arr["INDEXAWAL"],2) * 0.01 * $arr["KURS"]);
			}
			// USD
			elseif ($arr["KDVALUTA"]=='3'){
				$discount = (round(($arr["PREMITAGIHAN"]+$arr["RIDER"]),2) * 0.01 * $arr["KURS"]);
			}
			// IDR
			elseif ($arr["KDVALUTA"]=='1'){
				$discount = (($arr["PREMITAGIHAN"]+$arr["RIDER"]) * 0.01);
			}

			$discountnb = $discountnb;
			$discountob = $discountob;
		}		

	//	$i++;
		$jmlmatre+=$matre;
		$jmldiscount +=$discount;
		$jmltotaldebet += $arr["JMLPREMI"];
		$jmltotaldisc += $arr["DISC"];
		$jmlpremi += $arr["PREMITAGIHAN"]+$arr["RIDER"];
		
		${"jmlpreminb"} += $preminb;
		${"jmlpremiob"} += $premiob;
		
		${"jmldiscountnb"} +=$discountnb;
		${"jmldiscountob"} +=$discountob;
		
		${"jmlmatrenb"}+=$matrenb;
		${"jmlmatreob"}+=$matreob;
		${"jmltotaldebetnb"} += $totaldebetnb;
		${"jmltotaldebetob"} += $totaldebetob;


// Total
		$totalmatre+=$matre;
		$totaldiscount +=$discount;
		$totaltotaldebet += $arr["JMLPREMI"];
		$totalpremi += $arr["PREMITAGIHAN"]+$arr["RIDER"];
		
		${"totalpreminb"} += $preminb;
		${"totalpremiob"} += $premiob;
		
		${"totaldiscountnb"} +=$discountnb;
		${"totaldiscountob"} +=$discountob;
		
		${"totalmatrenb"}+=$matrenb;
		${"totalmatreob"}+=$matreob;
		${"totaltotaldebetnb"} += $totaldebetnb;
		${"totaltotaldebetob"} += $totaldebetob;
		
	}
	
	$sqlr="SELECT   c.kdrayonpenagih, SUM (TO_NUMBER (jumlahtagihan) / 100) jmlrider, sum (SELECT   nilaimeterai
            FROM   $DBUser.tabel_999_batas_materai where  (TO_NUMBER (jumlahtagihan) / 100) between BETWEEN batasbawahpremi
                           AND  batasataspremi)
    FROM   $DBUser.tabel_300_historis_rider d,
           $DBUser.tabel_200_pertanggungan b,
           $DBUser.tabel_315_pelunasan_auto_rider a,
           $DBUser.tabel_500_penagih c,
           $DBUser.tabel_202_produk e
   WHERE       b.prefixpertanggungan = SUBSTR (a.nopolis, 1, 2)
           AND b.nopertanggungan = SUBSTR (a.nopolis, 3, 9)
           AND b.prefixpertanggungan = d.prefixpertanggungan
           AND SUBSTR (b.kdproduk, 1, 2) <> 'JL'
           AND b.nopertanggungan = d.nopertanggungan
           AND a.tglbooked = d.tglbooked
           AND b.nopenagih = c.nopenagih
           AND a.statuspembayaran = '2'
           AND TO_CHAR (a.tglrekam, 'YYYYMMDD') between '$bulandari' and  '$bulansampai' and 
		   c.kdrayonpenagih='$kodekantor' and 
		   b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."'
GROUP BY   c.kdrayonpenagih";
	//echo $sqlr;
	 $sqlr = "select kdrayonpenagih, sum(jmlrider) jmlrider, sum(x) x from (
SELECT c.kdrayonpenagih,  (TO_NUMBER (jumlahtagihan) / 100) jmlrider,  (
      SELECT nilaimeterai
      FROM $DBUser.tabel_999_batas_materai
      where TO_NUMBER (jumlahtagihan) BETWEEN batasbawahpremi
      AND batasataspremi) x
      FROM $DBUser.tabel_300_historis_rider d, $DBUser.tabel_200_pertanggungan b,
      $DBUser.tabel_315_pelunasan_auto_rider a, $DBUser.tabel_500_penagih c, jsadm
      .tabel_202_produk e
      WHERE b.prefixpertanggungan = SUBSTR (a.nopolis, 1, 2)
      AND b.nopertanggungan = SUBSTR (a.nopolis, 3, 9)
      AND b.prefixpertanggungan = d.prefixpertanggungan
      AND SUBSTR (b.kdproduk, 1, 2) <> 'JL'
      AND b.nopertanggungan = d.nopertanggungan
      AND a.tglbooked = d.tglbooked
      AND b.nopenagih = c.nopenagih
      AND a.statuspembayaran = '2'
      AND TO_CHAR (a.tglrekam, 'YYYYMMDD') between '$bulandari' and  '$bulansampai' and 
		   c.kdrayonpenagih='$kodekantor' and 
		   b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."'
      ) GROUP BY kdrayonpenagih";
	  //echo $sqlr;
	$DBA->parse($sqlr);
	$DBA->execute();
	$rarr=$DBA->nextrow();
	?>	

	<tr>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=$i;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"></td>		
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$kodeakun;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"> <?=$kodekantor;?> - <?=$namakantor;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($jmlpreminb+$jmlpremiob+$rarr["JMLRIDER"],2,",",".");?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($jmldiscountnb+$jmldiscountob,2,",",".");?></td>
    
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($jmlmatrenb+$jmlmatreob,2,",",".");?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?
	if($kdbank=='BMRI' || $kdbank=='BBRI' || $kdbank=='BIMA'){echo number_format($jmlpreminb+$jmlpremiob,2,",",".");} else {echo number_format($jmltotaldebetnb+$jmltotaldebetob+$rarr["JMLRIDER"],2,",",".");};?></td>
	</tr>
	<? 
	
  	$total=$total+$rarr["JMLPREMI"];
	$totalr += $rarr["JMLRIDER"];
	//$totalmr=$totalmr+$rarr["X"];
	$tt += ($jmltotaldebetnb+$jmltotaldebetob+$rarr["JMLRIDER"]);
		$i++;
	} 
	?>
	<tr bgcolor="#f5d79c">
	 <td></td>
	 <td colspan="3" align="center"><b>T O T A L</b></td>
     <? if($kdbank=='BMRI' || $kdbank=='BBRI' || $kdbank=='BIMA'){ ?> 
	 <td align="right"><?=number_format($totalpreminb+$totalpremiob,2,",",".");?></td>
	 <td align="right"><?=number_format(0,2,",",".");?></td>
	 <td align="right"><?=number_format(0,2,",",".");?></td>
	 <td align="right"><?=number_format($totalpreminb+$totalpremiob,2,",",".");?></td>
	 <? } else {?>
	 <td align="right"><?=number_format($totalpreminb+$totalpremiob+$totalr,2,",",".");?></td>
	 <td align="right"><?=number_format($totaldiscountnb+$totaldiscountob,2,",",".");?></td>
	 <td align="right"><?=number_format($totalmatrenb+$totalmatreob+$totalmr,2,",",".");?></td>
	 <td align="right"><?=number_format($tt,2,",",".");//number_format($totaltotaldebetnb+$totaltotaldebetob+$totalr+$totalmr,2,",",".");?></td>
     <? }?>
	</tr>
</table>	
<p><a href="hasil_tradisional_1bill.php">DETAIL</a></p>
<p>
  <?	
$kom=$tt;//$kom=$total;
$nilai1=$totalpreminb+$totalpremiob+$totalr;//$nilai1=$total;
$nilai2=$totaldiscountnb+$totaldiscountob;
$nilai3=$totalmatrenb+$totalmatreob+$totalmr;


if ($mode!='print'){

echo("<font face=Verdana size=1><a href=\"index.php\">Menu Pelaporan</a></font>");
echo("<font face=Verdana size=1>&nbsp;&nbsp;|&nbsp;&nbsp;</font>");
echo("<font face=Verdana size=1><a href=\"#\" onclick=\"window.open('../akunting/cetakslip_autodebet.php?kdbank=".$kdbank."&tgl=".$tglbayar."&kom=".$kom."&nilai1=".$nilai1."&nilai2=".$nilai2."&nilai3=".$nilai3."','','width=800,height=600,top=100,left=100,scrollbars=yes');\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak SLIP</a></font>");
echo("<font face=Verdana size=1>&nbsp;&nbsp;|&nbsp;&nbsp;</font>");
echo("<font face=Verdana size=1><a href=\"#\" onclick=\"window.open('rekap_1bill.php?kdbank=".$kdbank."&daydari=$daydari&monthdari=".$monthdari."&yeardari=".$yeardari."&daysampai=$daysampai&monthsampai=".$monthsampai."&yearsampai=".$yearsampai."&bulandari=$bulandari&bulansampai=$bulansampai&mode=print','','width=1000,height=600,top=100,left=100,scrollbars=yes');\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak Lampiran</a></font>");

}
?>
  
</p>
</body>
</html>