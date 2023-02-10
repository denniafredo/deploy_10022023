<? 
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
	include "../../includes/kantor.php";
	//include "../../includes/komisiagen.php";
	
  $DB=new database($userid, $passwd, $DBName);
	$KTR=new Kantor($userid,$passwd,$kantor);
	
	function ShowFromDate($year_interval,$YearIntervalType) {
  GLOBAL $daydari,$monthdari,$yeardari;

  //MONTH
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
	  $bulancaridari = $monthdari.$yeardari;
	}
	else
	{
	  $monthdari=date("m");
		$yeardari=date("Y");
	  $bulancaridari = $monthdari.$yeardari;
	}

if ($kdbank=="MDR"){
	switch($periodedari)
	{
	  case '1' : $tglstartdari="01"; $tglenddari="10"; $s1="selected"; break; 
		case '2' : $tglstartdari="11"; $tglenddari="20"; $s2="selected"; break;
		case '3' : $tglstartdari="21"; $tglenddari="31"; $s3="selected"; break;  
	}
}
else{
	switch($periodedari)
	{
	  case '1' : $tglstartdari="01"; $tglenddari="13"; $s1="selected"; break; 
		case '2' : $tglstartdari="14"; $tglenddari="23"; $s2="selected"; break;
		case '3' : $tglstartdari="24"; $tglenddari="31"; $s3="selected"; break;  
	}
}

	
	if(isset($periodedari))
	{
	  $bulancaridari = $monthdari.$yeardari;
/*
		Dikomentari oleh : Udi
		Deskripsi: Ordering tipe data DATE yang di konvert menjadi string harus dalam bentuk 'YYYYMMDD'   

		$tglawal	 = $tglstart.$month.$year;
		$tglakhir	 = $tglend.$month.$year;
*/
		//$tglawaldari	 = $yeardari.$monthdari.$tglstartdari;
		$tglawaldari	 = $yeardari.$monthdari.$periodedari;
	}
	else
	{
	  $monthdari=date("m");
		$yeardari=date("Y");
	  $bulancaridari = $monthdari.$yeardari;
/*
		Dikomentari oleh : Udi
		Deskripsi: Ordering tipe data DATE yang di konvert menjadi string harus dalam bentuk 'YYYYMMDD'   

		$tglawal	 = $tglstart.$month.$year;
		$tglakhir	 = $tglend.$month.$year;
*/

		$tglawaldari	 = $yeardari.$monthdari.'01';
	}
	//echo "Awal : ".$tglawal." Akhir : ".$tglakhir;
	
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
              If($i == $yearsampai) {
                 echo "<option selected> $i\n";
              }ElseIf ($i == $CurrYear && !IsSet($yearsampai)) {
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
	  $bulancarisampai = $monthsampai.$yearsampai;
	}
	else
	{
	  $monthsampai=date("m");
		$yearsampai=date("Y");
	  $bulancarisampai = $monthsampai.$yearsampai;
	}

if($kdbank=="MDR" || $kdbank=="BRI"){	
	switch($periodesampai)
	{
	  case '1' : $tglstartsampai="01"; $tglendsampai="10"; $s1="selected"; break; 
		case '2' : $tglstartsampai="11"; $tglendsampai="20"; $s2="selected"; break;
		case '3' : $tglstartsampai="21"; $tglendsampai="31"; $s3="selected"; break;  
	}
}
else{
	switch($periodesampai)
	{
	  case '1' : $tglstartsampai="01"; $tglendsampai="13"; $s1="selected"; break; 
		case '2' : $tglstartsampai="14"; $tglendsampai="23"; $s2="selected"; break;
		case '3' : $tglstartsampai="24"; $tglendsampai="31"; $s3="selected"; break;  
	}
}	

	if(isset($periodesampai))
	{
	  $bulancarisampai = $monthsampai.$yearsampai;
/*
		Dikomentari oleh : Udi
		Deskripsi: Ordering tipe data DATE yang di konvert menjadi string harus dalam bentuk 'YYYYMMDD'   

		$tglawal	 = $tglstart.$month.$year;
		$tglakhir	 = $tglend.$month.$year;
*/
		//$tglakhirsampai	 = $yearsampai.$monthsampai.$tglendsampai;
		$tglakhirsampai	 = $yearsampai.$monthsampai.$periodesampai;
	}
	else
	{
	  $monthsampai=date("m");
		$yearsampai=date("Y");
	  $bulancarisampai = $monthsampai.$yearsampai;
/*
		Dikomentari oleh : Udi
		Deskripsi: Ordering tipe data DATE yang di konvert menjadi string harus dalam bentuk 'YYYYMMDD'   

		$tglawal	 = $tglstart.$month.$year;
		$tglakhir	 = $tglend.$month.$year;
*/

		$tglakhirsampai	 = $yearsampai.$monthsampai.'10';
	}
	//echo "Awal : ".$tglawal." Akhir : ".$tglakhir;
	
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
//		echo "<body>";
	}
	else{
		echo "<body>";
?>

<form name="getpremi" action="<?=$PHP_SELF;?>" action="post">
<?
	if ($kdbank=='MDR'){
		$selbank1="selected";
		$selbank2="";
		$selbank3="";
	}
	else if ($kdbank=='BNI'){
		$selbank1="";
		$selbank2="selected";
		$selbank3="";
	}
	else if ($kdbank=='BRI'){
		$selbank1="";
		$selbank2="";
		$selbank3="selected";
	}	
?>
  <a class="verdana10blk">Nama Bank</a>
	<select name="kdbank">
	  <option value="MDR" <?=$selbank1;?>>MANDIRI</option>
		<option value="BNI" <?=$selbank2;?>>BNI</option>
        <option value="BRI" <?=$selbank3;?>>BRI</option>
	</select>
  <a class="verdana10blk">Pilih Periode</a>
	<select name="periodedari">
	  <!--option value="1" <?=$s1;?>>I</option>
		<option value="2" <?=$s2;?>>II</option>
		<option value="3" <?=$s3;?>>III</option-->
		<?php
		for ($i = 1; $i <= 31; $i++) {
			if ($i < 10){
			?><option value="<? echo '0'.$i;?>" ><? echo '0'.$i;?></option>
			<?php				
			}
			else{
			?><option value="<?=$i;?>" ><?=$i;?></option>
			<?php

			}
		}
		?>
	</select>
  <a class="verdana10blk">Bulan</a> 
  <?  ShowFromDate(10,"Past"); ?>
  <a class="verdana10blk"> s/d Periode </a> 
	<select name="periodesampai">
	  <!--option value="1" <?=$s1;?>>I</option>
		<option value="2" <?=$s2;?>>II</option>
		<option value="3" <?=$s3;?>>III</option-->
		<?php
		for ($i = 1; $i <= 31; $i++) {
			if ($i < 10){
			?><option value="<? echo '0'.$i;?>" ><? echo '0'.$i;?></option>
			<?php				
			}
			else{
			?><option value="<?=$i;?>" ><?=$i;?></option>
			<?php

			}
		}
		?>
	</select>
  <a class="verdana10blk">Bulan</a> 
  <?  ShowToDate(10,"Past"); ?>
	<input type="submit" name="submit" value="Cari">
</form>
<br />

<?
}
?>

<br />
<div align="center">
<?
	if ($kdbank=='MDR') {
		$namabank='BANK MANDIRI';
		$namalike='MANDIRI';
	}
	else if ($kdbank=='BNI') {
		$namabank='BANK NEGARA INDONESIA (BNI)';
		$namalike='BNI';
	}
	else if ($kdbank=='BRI') {
		$namabank='BANK RAKYAT INDONESIA (BRI)';
		$namalike='BRI';
	}
?>
<b>REKAPITULASI HASIL PREMI AUTO DEBET <?=$namabank;?> <br /> 
PERIODE <?=$periodedari=="" ? "1" : $periodedari;?> <?=$namabulandari." ".$yeardari;?> s/d PERIODE <?=$periodesampai=="" ? "1" : $periodesampai;?> <?=$namabulansampai." ".$yearsampai;?><br />SECARA NASIONAL</b><br><br>
</div>

<? 
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
            "b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ". 
            "b.nopenagih=c.nopenagih and a.statuspembayaran='2' and ".
//						"b.kdvaluta='1' and ". 
						"to_char(a.tglrekam,'YYYYMMDD') between '$tglawaldari' and  '$tglakhirsampai' and ".
						"b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' order by c.kdrayonpenagih";
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
	
	$sql = "select zz.*,". 
      "(select nilaimeterai
      from $DBUser.tabel_999_batas_materai
      where ".
	  
/* Opsi 1*/	  
	"(select
           CASE
            WHEN ((SUBSTR(".$tglawaldari.",1,4)*12+SUBSTR(".$tglawaldari.",5,2))-(to_char(g.mulas,'YYYY')*12+to_char(g.mulas,'MM'))) <= 60 THEN 
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
		"'148090000' as kodeakun,".
		"(select nama from $DBUser.tabel_802_kodeakun where akun='148090000') as namaakunperantara,".
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
		"a.tglbooked=d.tglbooked and ".
		"b.nopenagih=c.nopenagih and ".
		"substr(b.kdproduk,1,2)<>'JL' and ".
		"a.statuspembayaran='2' and ".
//		"b.kdvaluta='1' and ".
		"to_char(a.tglrekam,'YYYYMMDD') between '$tglawaldari' and  '$tglakhirsampai' and ".
		"c.kdrayonpenagih='$kdrayonpenagih' and ".
		"b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' ".
	"order by d.kdkuitansi, d.prefixpertanggungan, d.nopertanggungan) zz";
	
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
				$preminb = round($arr["PREMITAGIHAN"]/ $arr["INDEXAWAL"],2) * $arr["KURS"];
				$premiob = 0;
				$discountnb = (round($arr["PREMITAGIHAN"]/ $arr["INDEXAWAL"],2) * 0.01 * $arr["KURS"]);
				$discountob = 0;
			}
			// USD
			elseif ($arr["KDVALUTA"]=='3'){
				$preminb = $arr["PREMITAGIHAN"] * $arr["KURS"];
				$premiob = 0;
				$discountnb = ($arr["PREMITAGIHAN"] * 0.01 * $arr["KURS"]);
				$discountob = 0;
			}
			// IDR
			elseif ($arr["KDVALUTA"]=='1'){
				$preminb = $arr["PREMITAGIHAN"]+$arr["RIDER"];
				$premiob = 0;
				$discountnb = ($arr["PREMITAGIHAN"] * 0.01);
				$discountob = 0;
			}

			$matrenb		= $arr["MATERE"];
			$matreob		= 0;
			$totaldebetnb = $arr["JMLPREMI"];
			$totaldebetob = 0;
			$jnb++;
			${"kdreknb".$cabas} = $arr["KDREKENINGLAWAN"];
		}elseif($kdkui=="OB"){
			$premiob = $arr["PREMITAGIHAN"];
			$preminb = 0;
			// IDX
			if ($arr["KDVALUTA"]=='0'){
				$premiob = round($arr["PREMITAGIHAN"]/ $arr["INDEXAWAL"],2) * $arr["KURS"];
				$preminb = 0;
				$discountob = (round($arr["PREMITAGIHAN"]/ $arr["INDEXAWAL"],2) * 0.01 * $arr["KURS"]);
				$discountnb = 0;
			}
			// USD
			elseif ($arr["KDVALUTA"]=='3'){
				$premiob = $arr["PREMITAGIHAN"] * $arr["KURS"];
				$preminb = 0;
				$discountob = ($arr["PREMITAGIHAN"] * 0.01 * $arr["KURS"]);
				$discountnb = 0;
			}
			// IDR
			elseif ($arr["KDVALUTA"]=='1'){
				$premiob = $arr["PREMITAGIHAN"]+$arr["RIDER"];
				$preminb = 0;
				$discountob = ($arr["PREMITAGIHAN"] * 0.01);
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
				$discount = (round($arr["PREMITAGIHAN"]/ $arr["INDEXAWAL"],2) * 0.01 * $arr["KURS"]);
			}
			// USD
			elseif ($arr["KDVALUTA"]=='3'){
				$discount = ($arr["PREMITAGIHAN"] * 0.01 * $arr["KURS"]);
			}
			// IDR
			elseif ($arr["KDVALUTA"]=='1'){
				$discount = ($arr["PREMITAGIHAN"] * 0.01);
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
	
	?>	

	<tr>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=$i;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"></td>		
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$kodeakun;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"> <?=$kodekantor;?> - <?=$namakantor;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($jmlpreminb+$jmlpremiob,2,",",".");?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($jmldiscountnb+$jmldiscountob,2,",",".");?></td>
    
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($jmlmatrenb+$jmlmatreob,2,",",".");?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($jmltotaldebetnb+$jmltotaldebetob,2,",",".");?></td>
	</tr>
	<? 
	
  	$total=$total+$arr["JMLPREMI"];

		$i++;
	} 
	?>
	<tr bgcolor="#f5d79c">
	 <td></td>
	 <td colspan="3" align="center"><b>T O T A L</b></td>
	 <td align="right"><?=number_format($totalpreminb+$totalpremiob,2,",",".");?></td>
	 <td align="right"><?=number_format($totaldiscountnb+$totaldiscountob,2,",",".");?></td>
	 <td align="right"><?=number_format($totalmatrenb+$totalmatreob,2,",",".");?></td>
	 <td align="right"><?=number_format($totaltotaldebetnb+$totaltotaldebetob,2,",",".");?></td>
	</tr>
</table>
<a href="hasil_tradisional.php">detail</a>	<br/>
<?	
$kom=$totaltotaldebetnb+$totaltotaldebetob;
$nilai1=$totalpreminb+$totalpremiob;
$nilai2=$totaldiscountnb+$totaldiscountob;
$nilai3=$totalmatrenb+$totalmatreob;

if ($mode!='print'){

echo("<font face=Verdana size=1><a href=\"index.php\">Menu Pelaporan</a></font>");
echo("<font face=Verdana size=1>&nbsp;&nbsp;|&nbsp;&nbsp;</font>");
echo("<font face=Verdana size=1><a href=\"#\" onclick=\"window.open('../akunting/cetakslip_autodebet.php?kdbank=".$kdbank."&tgl=".$tglbayar."&kom=".$kom."&nilai1=".$nilai1."&nilai2=".$nilai2."&nilai3=".$nilai3."','','width=800,height=600,top=100,left=100,scrollbars=yes');\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak SLIP</a></font>");
echo("<font face=Verdana size=1>&nbsp;&nbsp;|&nbsp;&nbsp;</font>");
echo("<font face=Verdana size=1><a href=\"#\" onclick=\"window.open('rekap_autodebet.php?kdbank=".$kdbank."&periodedari=".$periodedari."&monthdari=".$monthdari."&yeardari=".$yeardari."&periodesampai=".$periodesampai."&monthsampai=".$monthsampai."&yearsampai=".$yearsampai."&mode=print','','width=1000,height=600,top=100,left=100,scrollbars=yes');\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak Lampiran</a></font>");

}
?>

</body>
</html>