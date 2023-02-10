<? 
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
	include "../../includes/kantor.php";
	include "../../includes/klien.php";
	
  $DB=new database($userid, $passwd, $DBName);
  $DBA=new database($userid, $passwd, $DBName);
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

		//$tglawaldari	 = $yeardari.$monthdari.'01';
		$tglawaldari	 = $tglawaldari;
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

		//$tglakhirsampai	 = $yearsampai.$monthsampai.'10';
		$tglakhirsampai = $tglakhirsampai;
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
<title>Hasil Autodebet</title>
<style type="text/css">
<!-- 
body { 
 font-size: 12px;
 font-family: verdana;
 } 
td { 
 font-size: 10px;
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
		$selbank4="";
		$selbank5="";
		$selbank6="";
		$selbank7="";
		$selbank8="";
		$selbank9="";
		$selbank10="";
		$selbank11="";
	}
	else if ($kdbank=='BNI'){
		$selbank1="";
		$selbank2="selected";
		$selbank3="";
		$selbank4="";
		$selbank5="";
		$selbank6="";
		$selbank7="";
		$selbank8="";
		$selbank9="";
		$selbank10="";
		$selbank11="";
	}
	else if ($kdbank=='BRI'){
		$selbank1="";
		$selbank2="";
		$selbank3="selected";
		$selbank4="";
		$selbank5="";
		$selbank6="";
		$selbank7="";
		$selbank8="";
		$selbank9="";
		$selbank10="";
		$selbank11="";
	}
	else if ($kdbank=='BMRI'){
		$selbank1="";
		$selbank2="";
		$selbank3="";
		$selbank4="selected";
		$selbank5="";
		$selbank6="";
		$selbank7="";
		$selbank8="";
		$selbank9="";
		$selbank10="";
		$selbank11="";
	}
	else if ($kdbank=='BBRI'){
		$selbank1="";
		$selbank2="";
		$selbank3="";
		$selbank4="";
		$selbank5="selected";
		$selbank6="";
		$selbank7="";
		$selbank8="";
		$selbank9="";
		$selbank10="";
		$selbank11="";
	}	
	else if ($kdbank=='VBN'){
		$selbank1="";
		$selbank2="";
		$selbank3="";
		$selbank4="";
		$selbank5="";
		$selbank6="selected";
		$selbank7="";
		$selbank8="";
		$selbank9="";
		$selbank10="";
		$selbank11="";
	}
	else if ($kdbank=='BIMA'){
		$selbank1="";
		$selbank2="";
		$selbank3="";
		$selbank4="";
		$selbank5="";
		$selbank6="";
		$selbank7="selected";
		$selbank8="";
		$selbank9="";
		$selbank10="";
		$selbank11="";
	}
	else if ($kdbank=='BTN'){
		$selbank1="";
		$selbank2="";
		$selbank3="";
		$selbank4="";
		$selbank5="";
		$selbank6="";
		$selbank7="";
		$selbank8="selected";
		$selbank9="";
		$selbank10="";
		$selbank11="";
	}
	else if ($kdbank=='BPK'){
		$selbank1="";
		$selbank2="";
		$selbank3="";
		$selbank4="";
		$selbank5="";
		$selbank6="";
		$selbank7="";
		$selbank8="";
		$selbank9="selected";
		$selbank10="";
		$selbank11="";
	}
	else if ($kdbank=='PPOS'){
		$selbank1="";
		$selbank2="";
		$selbank3="";
		$selbank4="";
		$selbank5="";
		$selbank6="";
		$selbank7="";
		$selbank8="";
		$selbank9="";
		$selbank10="selected";
		$selbank11="";
	}
	else if ($kdbank=='BBNI'){
		$selbank1="";
		$selbank2="";
		$selbank3="";
		$selbank4="";
		$selbank5="";
		$selbank6="";
		$selbank7="";
		$selbank8="";
		$selbank9="";
		$selbank10="";
		$selbank11="selected";
	}
?>
  <a class="verdana10blk">Nama Bank</a>
	<select name="kdbank">
	  <option value="MDR" <?=$selbank1;?>>MANDIRI</option>
	  <option value="BNI" <?=$selbank2;?>>BNI</option>
      <option value="BRI" <?=$selbank3;?>>BRI</option>
      <option value="BMRI" <?=$selbank4;?>>H2H MANDIRI</option>
      <option value="BBRI" <?=$selbank5;?>>H2H BRI</option>
	  <option value="BIMA" <?=$selbank7;?>>H2H BIMASAKTI</option>
      <option value="BBNI" <?=$selbank11;?>>H2H BNI</option>
      <option value="VBN" <?=$selbank6;?>>VA BNI</option>
      <option value="BTN" <?=$selbank8;?>>BTN</option>
      <option value="BPK" <?=$selbank9;?>>BPD Kalbar</option>
      <option value="PPOS" <?=$selbank10;?>>POS</option>
	</select>
  <a class="verdana10blk">Pilih Periode</a>
	<!--<select name="periode">
	  <option value="1" <?=$s1;?>>I</option>
		<option value="2" <?=$s2;?>>II</option>
		<option value="3" <?=$s3;?>>III</option>
	</select>-->
  <!--<a class="verdana10blk">Bulan</a> -->
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
  <!--<a class="verdana10blk">Bulan</a>--> 
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
  <!--<a class="verdana10blk">Bulan</a>--> 
  <?  ShowToDate(10,"Past"); ?>
  
	<input type="submit" name="submit" value="Cari"</input>
    <? //echo $tglawaldari.$tglakhirsampai;?>

<br />
<div align="center">
<?
	if ($kdbank=='MDR') {
		$namabank='AUTO DEBET BANK MANDIRI';
		$namalike='MANDIRI';
	}
	else if ($kdbank=='BNI') {
		$namabank='AUTO DEBET BANK NEGARA INDONESIA (BNI)';
		$namalike='BNI';
	}
	else if ($kdbank=='BRI') {
		$namabank='AUTO DEBET BANK RAKYAT INDONESIA (BRI)';
		$namalike='BNI';
	}
	else if ($kdbank=='BMRI') {
		$namabank='H2H BANK MANDIRI';
		$namalike='BMRI';
	}
	else if ($kdbank=='BBRI') {
		$namabank='H2H BANK BRI';
		$namalike='BBRI';
	}
	else if ($kdbank=='BBNI') {
		$namabank='H2H BANK BNI';
		$namalike='BBNI';
	}
	else if ($kdbank=='BIMA') {
		$namabank='H2H BIMASAKTI';
		$namalike='BIMA';
	}
	else if ($kdbank=='BTN') {
		$namabank='AUTO DEBET BANK NEGARA INDONESIA (BTN)';
		$namalike='BTN';
	}
	else if ($kdbank=='BPK') {
		$namabank='AUTO DEBET BPD KALBAR';
		$namalike='BPK';
	}
	else if ($kdbank=='PPOS') {
		$namabank='H2H PT POS';
		$namalike='PPOS';
	}
	else if ($kdbank=='VBN') {
		$namabank='VA BANK NEGARA INDONESIA (BTN)';
		$namalike='VBN';
	}
}
?>

<b>HASIL <?=$namabank;?> <br />BULAN <?=$namabulan." ".$year;?> PERIODE <?=$periode=="" ? "1" : $periode;?><br /><?=$KTR->namakantor;?> </b>
</div>

<!--------------  start Rupiah --------------->
<? 
//echo $kdbank;
if($kdbank=="BMRI" || $kdbank=="BBRI" || $kdbank=="BBNI" || $kdbank=="BIMA" || $kdbank=="PPOS") {
	$sql = "select ".
				"distinct e.kdcabas as cabas ".
			  "from ".
				//X"$DBUser.tabel_300_historis_premi d,".
				"$DBUser.tabel_200_pertanggungan b,".
				"$DBUser.tabel_315_pelunasan_h2h a,".
				"$DBUser.tabel_500_penagih c, ".
							"$DBUser.tabel_202_produk e ".
			  "where ".
							"b.prefixpertanggungan=substr(a.no_polis,1,2) and ".
						"b.nopertanggungan=substr(a.no_polis,3,9) and ".
							"substr(b.kdproduk,1,2)<>'JL' and ".
				//X			"b.prefixpertanggungan=d.prefixpertanggungan and ".
				//X"b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ".
				"b.nopenagih=c.nopenagih and a.void='0' and b.kdvaluta='1' and ".
							//"to_char(a.entry_time,'YYYYMM') between '$tglawal' and  '$tglakhir' and ".
							"to_char(a.entry_time,'YYYYMMdd') between '$tglawaldari' and  '$tglakhirsampai' and ".
							//"to_char(a.tglupdated,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
							"c.kdrayonpenagih='$kantor' and ".
							"b.kdproduk=e.kdproduk and a.company_code='".$kdbank."' ";} 
	 else if($kdbank=="VBN") {	
	 $sql = "select ".
				"distinct e.kdcabas as cabas ".
			  "from ".
				//X"$DBUser.tabel_300_historis_premi d,".
				"$DBUser.tabel_200_pertanggungan b,".
				"$DBUser.tabel_315_pelunasan_va a,".
				"$DBUser.tabel_500_penagih c, ".
							"$DBUser.tabel_202_produk e ".
			  "where ".
							"b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
						"b.nopertanggungan=substr(a.nopolis,3,9) and ".
							"substr(b.kdproduk,1,2)<>'JL' and ".
				//X			"b.prefixpertanggungan=d.prefixpertanggungan and ".
				//X"b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ".
				"b.nopenagih=c.nopenagih and a.statuspembayaran='2' and b.kdvaluta='1' and ".
							//"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
							"to_char(a.tglrekam,'YYYYMMdd') between '".$tglawaldari."' and  '".$tglakhirsampai."' and ".
							//"to_char(a.tglupdated,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
							"c.kdrayonpenagih='$kantor' and ".
							"b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' ";}
	else {		
	 $sql = "select ".
				"distinct e.kdcabas as cabas ".
			  "from ".
				//X"$DBUser.tabel_300_historis_premi d,".
				"$DBUser.tabel_200_pertanggungan b,".
				"$DBUser.tabel_315_pelunasan_auto_debet a,".
				"$DBUser.tabel_500_penagih c, ".
							"$DBUser.tabel_202_produk e ".
			  "where ".
							"b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
						"b.nopertanggungan=substr(a.nopolis,3,9) and ".
							"substr(b.kdproduk,1,2)<>'JL' and ".
				//X			"b.prefixpertanggungan=d.prefixpertanggungan and ".
				//X"b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ".
				"b.nopenagih=c.nopenagih and a.statuspembayaran='2' and b.kdvaluta='1' and ".
							//"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
							"to_char(a.tglrekam,'YYYYMMdd') between '".$tglawaldari."' and  '".$tglakhirsampai."' and ".
							//"to_char(a.tglupdated,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
							"c.kdrayonpenagih='$kantor' and ".
							"b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' ";}
							//echo $sql;
							//die;
	$DB->parse($sql);
    $DB->execute();				
	$ars=$DB->nextrow();
	$ono = $ars["CABAS"];
	
if($ono!="")
{	
if($kdbank=="BMRI" || $kdbank=="BBRI" || $kdbank=="BBNI" || $kdbank=="BIMA" || $kdbank=="PPOS") {
	$sql = "select ".
				"distinct e.kdcabas as cabas ".
			  "from ".
				//X"$DBUser.tabel_300_historis_premi d,".
				"$DBUser.tabel_200_pertanggungan b,".
				"$DBUser.tabel_315_pelunasan_h2h a,".
				"$DBUser.tabel_500_penagih c, ".
							"$DBUser.tabel_202_produk e ".
			  "where ".
							"b.prefixpertanggungan=substr(a.no_polis,1,2) and ".
						"b.nopertanggungan=substr(a.no_polis,3,9) and ".
							"substr(b.kdproduk,1,2)<>'JL' and ".
				//X			"b.prefixpertanggungan=d.prefixpertanggungan and ".
				//X"b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ".
				"b.nopenagih=c.nopenagih and a.void='0' and b.kdvaluta='1' and ".
							//"to_char(a.entry_time,'YYYYMM') between '$tglawal' and  '$tglakhir' and ".
							"to_char(a.entry_time,'YYYYMMdd') between '$tglawaldari' and  '$tglakhirsampai' and ".
							//"to_char(a.tglupdated,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
							"c.kdrayonpenagih='$kantor' and ".
							"b.kdproduk=e.kdproduk and a.company_code='".$kdbank."' ";} 
		else if($kdbank=="VBN") {
		$sql = "select ".
					"distinct e.kdcabas as cabas ".
				  "from ".
				   //X "$DBUser.tabel_300_historis_premi d,".
					"$DBUser.tabel_200_pertanggungan b,".
					"$DBUser.tabel_315_pelunasan_va a,".
					"$DBUser.tabel_500_penagih c, ".
								"$DBUser.tabel_202_produk e ".
				  "where ".
								"b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
							"b.nopertanggungan=substr(a.nopolis,3,9) and ".
								"substr(b.kdproduk,1,2)<>'JL' and ".
					//X			"b.prefixpertanggungan=d.prefixpertanggungan and ".
					//X"b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ".
					"b.nopenagih=c.nopenagih and a.statuspembayaran='2' and b.kdvaluta='1' and ".
								//"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
								"to_char(a.tglrekam,'YYYYMMdd') between '$tglawaldari' and  '$tglakhirsampai' and ".
								//"to_char(a.tglupdated,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
								"c.kdrayonpenagih='$kantor' and ".
								"b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' ";}
		else {
		$sql = "select ".
					"distinct e.kdcabas as cabas ".
				  "from ".
				   //X "$DBUser.tabel_300_historis_premi d,".
					"$DBUser.tabel_200_pertanggungan b,".
					"$DBUser.tabel_315_pelunasan_auto_debet a,".
					"$DBUser.tabel_500_penagih c, ".
								"$DBUser.tabel_202_produk e ".
				  "where ".
								"b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
							"b.nopertanggungan=substr(a.nopolis,3,9) and ".
								"substr(b.kdproduk,1,2)<>'JL' and ".
					//X			"b.prefixpertanggungan=d.prefixpertanggungan and ".
					//X"b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ".
					"b.nopenagih=c.nopenagih and a.statuspembayaran='2' and b.kdvaluta='1' and ".
								//"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
								"to_char(a.tglrekam,'YYYYMMdd') between '$tglawaldari' and  '$tglakhirsampai' and ".
								//"to_char(a.tglupdated,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
								"c.kdrayonpenagih='$kantor' and ".
								"b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' ";}
						//echo $sql;
  $DB->parse($sql);
  $DB->execute();				
  $arr = $DB->result();	


?>
<b>Valuta Rupiah Tanpa Indeks (VRTI)</b>
<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
  <tr>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    NO</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Cabas</td>
		<td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    No. Polis</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Nama Pemb. Polis</td>
    <!--<td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Telp/HP</td>-->
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Bulan Tagihan</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    No.Rekening</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    OB/NB</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Jml. Premi</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Jml. Rider</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Discount</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Materai</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Total Debet</td>
		<td align="center" colspan="3" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Komisi Penutupan</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Nama Penutup</td>
		<td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Penagih Lama</td>
  </tr>
	<tr>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    TH.1</td>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    TH.2</td>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    TH.3</td>
  </tr>
	<? 
  foreach ($arr as $foo => $row ) {
	$cabas = $row["CABAS"];
    if($kdbank=="BMRI" || $kdbank=="BBRI" || $kdbank=="BBNI"  || $kdbank=="BIMA" || $kdbank=="PPOS") {
			$sql="SELECT   c.kdrayonpenagih,
				   b.prefixpertanggungan,
				   b.nopertanggungan,
				   b.kdvaluta,
				   d.tglbooked AS tglbuk,
				   d.kdkuitansi,
				   b.premistd AS premitagihan,
				   d.kdrekeninglawan,
				   TO_NUMBER (a.BILL_AMOUNT) AS jmlpremi,
				   NULL nourut,
				   a.no_polis,
				   TO_CHAR (a.tgl_booked, 'MM/YYYY') AS blntagihan,
				   NULL nokontrol,
				   null norekdebet,
				   null norekkredit,
				   a.void,
				   a.nama_klien,
				   a.void,
				   a.entry_time,
				   TO_CHAR (d.tglbayar, 'DD/MM/YYYY') AS tglbayar,
				   a.entry_time,
				   TO_CHAR (d.tglbayar, 'MM/YYYY') AS blnbayar,
				   TO_CHAR (d.tglbayar, 'YYYYMM') AS blnbayarnya,
				   b.nopenagih,
				   b.noagen,
				   b.norekeningdebet,
				   (SELECT   namaklien1
					  FROM   $DBUser.tabel_100_klien
					 WHERE   noklien = b.nopembayarpremi)
					  AS namaklien,
				   CEIL (MONTHS_BETWEEN (a.entry_time, b.mulas) / 12) AS thnkomisi,
				   (SELECT   komisiagencb
					  FROM   $DBUser.tabel_404_temp
					 WHERE   prefixpertanggungan = b.prefixpertanggungan
							 AND nopertanggungan = b.nopertanggungan
							 AND thnkomisi =
								   CEIL (MONTHS_BETWEEN (a.entry_time, b.mulas) / 12)
							 AND kdkomisiagen = '01')
					  komisiagen,
				   (SELECT   namaklien1
					  FROM   $DBUser.tabel_100_klien
					 WHERE   noklien = b.noagen)
					  AS namaagen,
				   e.kdcabas,
				   (SELECT   nilaimeterai
					  FROM   $DBUser.tabel_999_batas_materai
					 WHERE   (TO_NUMBER (a.bill_amount) / 100) - 6000 BETWEEN batasbawahpremi
																			AND  batasataspremi)
					  AS matere,
				   (SELECT   premitagihan
					  FROM   $DBUser.tabel_300_historis_rider
					 WHERE   prefixpertanggungan = b.prefixpertanggungan
							 AND nopertanggungan = b.nopertanggungan
							 AND TO_CHAR (tglbooked, 'ddmmyyyy') =
								   TO_CHAR (a.tgl_booked, 'ddmmyyyy'))
					  rider
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
				   AND a.void = '0'
				   AND b.kdvaluta = '1'
				   --AND TO_CHAR (a.entry_time, 'YYYYMM') BETWEEN '$tglawal' and  '$tglakhir'
				   and to_char(a.entry_time,'YYYYMMdd') between '$tglawaldari' and  '$tglakhirsampai' 
				   AND c.kdrayonpenagih = '$kantor'
				   AND b.kdproduk = e.kdproduk
				   and e.kdcabas='$cabas'
				   AND SUBSTR (b.kdproduk, 1, 2) <> 'JL'
				   AND a.company_code = '".$kdbank."'
		ORDER BY   b.prefixpertanggungan, b.nopertanggungan, d.kdkuitansi";
	}
	else if($kdbank=="VBN") {
	$sql = "select ".
            "c.kdrayonpenagih,b.prefixpertanggungan,b.nopertanggungan,b.kdvaluta,".
            "(SELECT tglbooked FROM $DBUser.tabel_300_historis_premi where prefixpertanggungan = b.prefixpertanggungan ".
			"AND nopertanggungan= b.nopertanggungan AND trunc(tglbooked,'month') = trunc(a.tglbooked,'month')) tglbuk,".
			"(SELECT kdkuitansi FROM $DBUser.tabel_300_historis_premi where prefixpertanggungan = b.prefixpertanggungan ".
			"AND nopertanggungan= b.nopertanggungan AND trunc(tglbooked,'month') = trunc(a.tglbooked,'month')) kdkuitansi,".
			"(SELECT premitagihan FROM $DBUser.tabel_300_historis_premi where prefixpertanggungan = b.prefixpertanggungan ".
			"AND nopertanggungan= b.nopertanggungan AND trunc(tglbooked,'month') = trunc(a.tglbooked,'month')) premitagihan,".
			"(SELECT kdrekeninglawan FROM $DBUser.tabel_300_historis_premi where prefixpertanggungan = b.prefixpertanggungan ".
			"AND nopertanggungan= b.nopertanggungan AND trunc(tglbooked,'month') = trunc(a.tglbooked,'month')) kdrekeninglawan,".
						"to_number(a.jumlahtagihan)/100 as jmlpremi,".
            "a.nopolis,to_char(a.tglbooked,'MM/YYYY') as blntagihan,".
						"a.nokontrol,to_number(a.norekdebet) as norekdebet,a.norekkredit,a.statuspembayaran,".
   					"a.nourut,".
						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as namaklien, ".
						"(select phonetetap01 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as telp1, ".
						"(select phonetetap02 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as telp2, ".
						"a.beritakredit,a.statuspembayaran, ".
						"a.tglrekam,(".
						"SELECT TO_CHAR (tglbayar, 'DD/MM/YYYY') FROM $DBUser.tabel_300_historis_premi where prefixpertanggungan = b.prefixpertanggungan ".
			"AND nopertanggungan= b.nopertanggungan AND tglbooked = a.tglbooked ".
						") as tglbayar,a.tglupdated,".
						"(".
						"SELECT TO_CHAR (tglbayar, 'MM/YYYY')FROM $DBUser.tabel_300_historis_premi where prefixpertanggungan = b.prefixpertanggungan ".
			"AND nopertanggungan= b.nopertanggungan AND tglbooked = a.tglbooked ".
						") as blnbayar,".
						"b.nopenagih,b.noagen,b.norekeningdebet, ".
						"ceil(months_between(a.tglupdated,b.mulas)/12) as thnkomisi, ".
						
						"(select komisiagencb from $DBUser.tabel_404_temp ". 
               "where prefixpertanggungan=b.prefixpertanggungan ". 
          	 "and nopertanggungan=b.nopertanggungan ".
          	 "and thnkomisi= ceil(months_between(a.tglupdated,b.mulas)/12) ".
          	 "and kdkomisiagen='01') komisiagen, ".
						 
						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.noagen) as namaagen, ".
						"e.kdcabas, ".
		
            "(select nilaimeterai from $DBUser.tabel_999_batas_materai ".
  					 "where to_number(a.jumlahtagihan)/100 between ".
             "batasbawahpremi and batasataspremi ".
             ") as matere,
			  (SELECT   premitagihan
					  FROM   $DBUser.tabel_300_historis_rider
					 WHERE   prefixpertanggungan = b.prefixpertanggungan
							 AND nopertanggungan = b.nopertanggungan
							 AND TO_CHAR (tglbooked, 'ddmmyyyy') =
								   TO_CHAR (a.tglbooked, 'ddmmyyyy'))
					  rider ".
          "from ".
           // "$DBUser.tabel_300_historis_premi d,".
            "$DBUser.tabel_200_pertanggungan b,".
            "$DBUser.tabel_315_pelunasan_va a,".
            "$DBUser.tabel_500_penagih c, ".
						"$DBUser.tabel_202_produk e ".
          "where ".
						"b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
   					"b.nopertanggungan=substr(a.nopolis,3,9) and ".
					//	"b.prefixpertanggungan=d.prefixpertanggungan and ".
           // "b.nopertanggungan=d.nopertanggungan and ".
           // "a.tglbooked=d.tglbooked and ".
            "b.nopenagih=c.nopenagih and ".
						"substr(b.kdproduk,1,2)<>'JL' and ".
						"a.statuspembayaran='2' and ".
						"b.kdvaluta='1' and ".
						//"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
						"to_char(a.tglrekam,'YYYYMMdd') between '$tglawaldari' and  '$tglakhirsampai' and ".
            "c.kdrayonpenagih='$kantor' and ".
						"b.kdproduk=e.kdproduk and e.kdcabas='$cabas' and a.kdbank='".$kdbank."' ".
					"order by kdkuitansi, prefixpertanggungan, nopertanggungan";}
	else {
	$sql = "select ".
            "c.kdrayonpenagih,b.prefixpertanggungan,b.nopertanggungan,b.kdvaluta,".
            "(SELECT tglbooked FROM $DBUser.tabel_300_historis_premi where prefixpertanggungan = b.prefixpertanggungan ".
			"AND nopertanggungan= b.nopertanggungan AND trunc(tglbooked,'month') = trunc(a.tglbooked,'month')) tglbuk,".
			"(SELECT kdkuitansi FROM $DBUser.tabel_300_historis_premi where prefixpertanggungan = b.prefixpertanggungan ".
			"AND nopertanggungan= b.nopertanggungan AND trunc(tglbooked,'month') = trunc(a.tglbooked,'month')) kdkuitansi,".
			"(SELECT premitagihan FROM $DBUser.tabel_300_historis_premi where prefixpertanggungan = b.prefixpertanggungan ".
			"AND nopertanggungan= b.nopertanggungan AND trunc(tglbooked,'month') = trunc(a.tglbooked,'month')) premitagihan,".
			"(SELECT kdrekeninglawan FROM $DBUser.tabel_300_historis_premi where prefixpertanggungan = b.prefixpertanggungan ".
			"AND nopertanggungan= b.nopertanggungan AND trunc(tglbooked,'month') = trunc(a.tglbooked,'month')) kdrekeninglawan,".
						"to_number(a.jumlahtagihan)/100 as jmlpremi,".
            "a.nopolis,to_char(a.tglbooked,'MM/YYYY') as blntagihan,".
						"a.nokontrol,to_number(a.norekdebet) as norekdebet,a.norekkredit,a.statuspembayaran,".
   					"a.nourut,".
						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as namaklien, ".
						"(select phonetetap01 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as telp1, ".
						"(select phonetetap02 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as telp2, ".
						"a.beritakredit,a.statuspembayaran, ".
						"a.tglrekam,(".
						"SELECT TO_CHAR (tglbayar, 'DD/MM/YYYY') FROM $DBUser.tabel_300_historis_premi where prefixpertanggungan = b.prefixpertanggungan ".
			"AND nopertanggungan= b.nopertanggungan AND tglbooked = a.tglbooked ".
						") as tglbayar,a.tglupdated,".
						"(".
						"SELECT TO_CHAR (tglbayar, 'MM/YYYY')FROM $DBUser.tabel_300_historis_premi where prefixpertanggungan = b.prefixpertanggungan ".
			"AND nopertanggungan= b.nopertanggungan AND tglbooked = a.tglbooked ".
						") as blnbayar,".
						"b.nopenagih,b.noagen,b.norekeningdebet, ".
						"ceil(months_between(a.tglupdated,b.mulas)/12) as thnkomisi, ".
						
						"(select komisiagencb from $DBUser.tabel_404_temp ". 
               "where prefixpertanggungan=b.prefixpertanggungan ". 
          	 "and nopertanggungan=b.nopertanggungan ".
          	 "and thnkomisi= ceil(months_between(a.tglupdated,b.mulas)/12) ".
          	 "and kdkomisiagen='01') komisiagen, ".
						 
						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.noagen) as namaagen, ".
						"e.kdcabas, ".
		
            "(select nilaimeterai from $DBUser.tabel_999_batas_materai ".
  					 "where to_number(a.jumlahtagihan)/100 between ".
             "batasbawahpremi and batasataspremi ".
             ") as matere,
			  (SELECT   premitagihan
					  FROM   $DBUser.tabel_300_historis_rider
					 WHERE   prefixpertanggungan = b.prefixpertanggungan
							 AND nopertanggungan = b.nopertanggungan
							 AND TO_CHAR (tglbooked, 'ddmmyyyy') =
								   TO_CHAR (a.tglbooked, 'ddmmyyyy'))
					  rider ".
          "from ".
           // "$DBUser.tabel_300_historis_premi d,".
            "$DBUser.tabel_200_pertanggungan b,".
            "$DBUser.tabel_315_pelunasan_auto_debet a,".
            "$DBUser.tabel_500_penagih c, ".
						"$DBUser.tabel_202_produk e ".
          "where ".
						"b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
   					"b.nopertanggungan=substr(a.nopolis,3,9) and ".
					//	"b.prefixpertanggungan=d.prefixpertanggungan and ".
           // "b.nopertanggungan=d.nopertanggungan and ".
           // "a.tglbooked=d.tglbooked and ".
            "b.nopenagih=c.nopenagih and ".
						"substr(b.kdproduk,1,2)<>'JL' and ".
						"a.statuspembayaran='2' and ".
						"b.kdvaluta='1' and ".
						//"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
						"to_char(a.tglrekam,'YYYYMMdd') between '$tglawaldari' and  '$tglakhirsampai' and ".
            "c.kdrayonpenagih='$kantor' and ".
						"b.kdproduk=e.kdproduk and e.kdcabas='$cabas' and a.kdbank='".$kdbank."' ".
					"order by kdkuitansi, prefixpertanggungan, nopertanggungan";}
    //echo $sql."<br /><br />";
    //die;
	  $DB->parse($sql);
	  $DB->execute();
	
  	$i=1;
  	$discountnb = 0;
  	$discountob = 0;
  	$preminb = 0;
  	$premiob = 0;
  	$matrenb = 0;
  	$matreob = 0;
  	$totaldebetnb = 0;
  	$totaldebetob = 0;
	$totalrider = 0;
  	$jnb = 0;
  	$job = 0;
		$jmlkomisith1 = 0;
		$jmlkomisith2 = 0;
		$jmlkomisith3 = 0;
  	while ($arr=$DB->nextrow()) {
  	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	  $kdkui = substr($arr["KDKUITANSI"],0,2);
  		if($kdkui=="NB")
  		{
  		  $preminb = $arr["PREMITAGIHAN"];
  			$premiob = 0;
  			$discountnb = ($arr["PREMITAGIHAN"]* 0.01);
  			$discountob = 0;
  			$matrenb		= $arr["MATERE"];
  			$matreob		= 0;
  			$totaldebetnb = $arr["JMLPREMI"];
  			$totaldebetob = 0;
  			$jnb++;
  			${"kdreknb".$cabas} = $arr["KDREKENINGLAWAN"];
  		}
  		elseif($kdkui=="OB")
  		{
  		  $premiob = $arr["PREMITAGIHAN"];
  			$preminb = 0;
  			$discountob = ($arr["PREMITAGIHAN"]* 0.01);
  			$discountnb = 0;
  			$matreob		= $arr["MATERE"];
  			$matrenb		= 0;
  			$totaldebetob = $arr["JMLPREMI"];
  			$totaldebetnb = 0;
  			$job++;
  			${"kdrekob".$cabas} = $arr["KDREKENINGLAWAN"];
  		}
  	?>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$i;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=($prevcabas<>$arr["KDCABAS"] ? "<b>".$arr["KDCABAS"]."</b>" : "");?></td>
		<td nowrap style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NAMAKLIEN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["BLNTAGIHAN"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KDREKENINGLAWAN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$kdkui;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["PREMITAGIHAN"],2,",",".");?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["RIDER"],2,",",".");?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right">
		  <?
			//if($arr["PREMITAGIHAN"]==$arr["JMLPREMI"])
			if($arr["BLNBAYAR"]!=$arr["BLNTAGIHAN"])
			{
			  $discount = 0;
				$discountnb = 0;
				$discountob = 0;
			}
			else
			{
			  $discount = ($arr["PREMITAGIHAN"]* 0.01);
				$discountnb = $discountnb;
				$discountob = $discountob;
			}
			echo number_format($discount,2,",",".");
			?>
		</td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["MATERE"],2,",",".");?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["JMLPREMI"],2,",",".");?></td>
    <? 
		 switch($arr["THNKOMISI"])
		 {
			 case '1' : $tk1 = number_format($arr["KOMISIAGEN"],2,",","."); $tk2 = "-"; $tk3 = "-"; 
			 					$jmlkomisith1 = $arr["KOMISIAGEN"]; $jmlkomisith2 = 0; $jmlkomisith3 = 0;
								${"totkomisith1".$cabas} += $jmlkomisith1;
								break;
								
			 case '2' : $tk1 = "-"; $tk2 = number_format($arr["KOMISIAGEN"],2,",","."); $tk3 = "-"; 
			   				$jmlkomisith1 = 0; $jmlkomisith2 = $arr["KOMISIAGEN"]; $jmlkomisith3 = 0;
								${"totkomisith2".$cabas} += $jmlkomisith2;
								break;
			 case '3' : $tk1 = "-"; $tk2 = "-"; $tk3 = number_format($arr["KOMISIAGEN"],2,",","."); 
			 					$jmlkomisith1 = 0; $jmlkomisith2 = 0; $jmlkomisith3 = $arr["KOMISIAGEN"];
								${"totkomisith3".$cabas} += $jmlkomisith3;
								break;
			 default : $tk1 = "-"; $tk2 = "-"; $tk3 = "-";
		 }
//* Revisi oleh Ari 13/09/2007		 
//		 $PNG=new Klien($userid,$passwd,$arr["NOPENAGIHLAMA"]);
      	/*$sql=	"select substr(keteranganmutasi,20,10) as nopenagihlama from $DBUser.tabel_600_historis_mutasi_pert ".
      						"where kdmutasi='12' and prefixpertanggungan='".$arr["PREFIXPERTANGGUNGAN"]."' ".
      						"and nopertanggungan='".$arr["NOPERTANGGUNGAN"]."' and substr(keteranganmutasi,length(keteranganmutasi)-15,16) like '%".$namalike."%' ".
      						"group by substr(keteranganmutasi,20,10)";*/
		$sql="SELECT   nopenagih NOPENAGIHLAMA, (SELECT   namaklien1
                       FROM   $DBUser.tabel_100_klien
                      WHERE   noklien = nopenagih) namapenagihlama
			  FROM   $DBUser.tabel_600_historis_mutasi_pert a, $DBUser.TABEL_200_AGEN_PENAGIH_UPDATE b
			 WHERE       a.prefixpertanggungan = b.prefixpertanggungan
					 AND a.nopertanggungan = b.nopertanggungan
					 AND TO_CHAR(tglmutasi,'DDMMYYYY') = TO_CHAR(tglrekam,'DDMMYYYY')
					 AND a.prefixpertanggungan = '".$arr["PREFIXPERTANGGUNGAN"]."'
					 AND a.nopertanggungan = '".$arr["NOPERTANGGUNGAN"]."' ORDER BY tglrekam DESC";
					 //echo $sql;
        $DBA->parse($sql);
        $DBA->execute();
				$arrA=$DBA->nextrow();
				
		 		$PNG=new Klien($userid,$passwd,$arrA["NOPENAGIHLAMA"]);
//*

		?>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=$tk1;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=$tk2;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=$tk3;?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NAMAAGEN"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$PNG->nama;?></td>
  </tr>
	<? 
	$i++;
	$jmlmatre+=$matre;
	$jmldiscount +=$discount;
	$jmltotaldebet += $arr["JMLPREMI"]+$arr["RIDER"];
	$jmlpremi += $arr["PREMITAGIHAN"];
	
	${"jmlpreminb".$cabas} += $preminb;
	${"jmlpremiob".$cabas} += $premiob;
	
	${"jmldiscountnb".$cabas} +=$discountnb;
	${"jmldiscountob".$cabas} +=$discountob;
	
	${"jmlmatrenb".$cabas}+=$matrenb;
	${"jmlmatreob".$cabas}+=$matreob;
	${"jmltotaldebetnb".$cabas} += $totaldebetnb;
	${"jmltotaldebetob".$cabas} += $totaldebetob;
	${"totalrider".$cabas} += $arr["RIDER"];
	$prevcabas = $arr["KDCABAS"];
	}
	?>
	<tr bgcolor="#f5d79c">
	 <td></td>
	 <td colspan="4"><b>JUMLAH <?=$cabas;?></b></td>
	 <td><?=${"kdrekob".$cabas};?></td>
	 <td>OB</td>
	 <td align="right"><?=number_format(${"jmlpremiob".$cabas},2,",",".");?></td>
     <td align="right"><?=number_format(${"totalrider".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"jmldiscountob".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"jmlmatreob".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"jmltotaldebetob".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"totkomisith1".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"totkomisith2".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"totkomisith3".$cabas},2,",",".");?></td>
	 <td></td>
	 <td></td>
	</tr>
	<tr bgcolor="#f5d79c">
	 <td></td>
	 <td colspan="4"></td>
	 <td><?=${"kdreknb".$cabas};?></td>
	 <td>NB</td>
	 <td align="right"><?=number_format(${"jmlpreminb".$cabas},2,",",".");?></td>
     <td align="right"><?=number_format(${"jmlpreminbx".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"jmldiscountnb".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"jmlmatrenb".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"jmltotaldebetnb".$cabas},2,",",".");?></td>
	 <td></td>
	 <td></td>
	 <td></td>
	 <td></td>
	 <td></td>
	</tr>
	<? 
	}
	?>
</table>
<!-----------------------  end rupiah -------------------------->
<br />
<? 
}
?>

<!--------------  start Rupiah Dengan Index --------------->
<? 
if($kdbank=="BMRI" || $kdbank=="BBRI" || $kdbank=="BBNI"  || $kdbank=="BIMA" || $kdbank=="PPOS" ) {
	$sql = "select ".
				"distinct e.kdcabas as cabas ".
			  "from ".
				//X"$DBUser.tabel_300_historis_premi d,".
				"$DBUser.tabel_200_pertanggungan b,".
				"$DBUser.tabel_315_pelunasan_h2h a,".
				"$DBUser.tabel_500_penagih c, ".
							"$DBUser.tabel_202_produk e ".
			  "where ".
							"b.prefixpertanggungan=substr(a.no_polis,1,2) and ".
						"b.nopertanggungan=substr(a.no_polis,3,9) and ".
							"substr(b.kdproduk,1,2)<>'JL' and ".
				//X			"b.prefixpertanggungan=d.prefixpertanggungan and ".
				//X"b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ".
				"b.nopenagih=c.nopenagih and a.void='0' and b.kdvaluta='0' and ".
							//"to_char(a.entry_time,'YYYYMM') between '$tglawal' and  '$tglakhir' and ".
							"to_char(a.entry_time,'YYYYMMdd') between '$tglawaldari' and  '$tglakhirsampai' and ".
							//"to_char(a.tglupdated,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
							"c.kdrayonpenagih='$kantor' and ".
							"b.kdproduk=e.kdproduk and a.company_code='".$kdbank."' ";}
else if($kdbank=="VBN" ) {
	$sql = "select ".
            "distinct e.kdcabas as cabas ".
          "from ".
            "$DBUser.tabel_300_historis_premi d,".
            "$DBUser.tabel_200_pertanggungan b,".
            "$DBUser.tabel_315_pelunasan_va a,".
            "$DBUser.tabel_500_penagih c, ".
            "$DBUser.tabel_202_produk e ".
          "where ".
						"b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
   					"b.nopertanggungan=substr(a.nopolis,3,9) and ".
						"b.prefixpertanggungan=d.prefixpertanggungan and ".
            "b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ".
            "b.nopenagih=c.nopenagih and a.statuspembayaran='2' and b.kdvaluta='0' and ".
						//"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
						"to_char(a.tglrekam,'YYYYMMdd') between '$tglawaldari' and  '$tglakhirsampai' and ".
						//"to_char(a.tglupdated,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
						"c.kdrayonpenagih='$kantor' and ".
            "b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' ";}  
	 else {
$sql = "select ".
            "distinct e.kdcabas as cabas ".
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
            "b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ".
            "b.nopenagih=c.nopenagih and a.statuspembayaran='2' and b.kdvaluta='0' and ".
						//"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
						"to_char(a.tglrekam,'YYYYMMdd') between '$tglawaldari' and  '$tglakhirsampai' and ".
						//"to_char(a.tglupdated,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
						"c.kdrayonpenagih='$kantor' and ".
            "b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' ";}
	$DB->parse($sql);
  $DB->execute();				
	$ars=$DB->nextrow();
	$ono_di = $ars["CABAS"];
	
if($ono_di!="")
{
  if($kdbank=="BMRI" || $kdbank=="BBRI" || $kdbank=="BBNI" || $kdbank=="BIMA" || $kdbank=="PPOS") {
	$sql = "select ".
				"distinct e.kdcabas as cabas ".
			  "from ".
				//X"$DBUser.tabel_300_historis_premi d,".
				"$DBUser.tabel_200_pertanggungan b,".
				"$DBUser.tabel_315_pelunasan_h2h a,".
				"$DBUser.tabel_500_penagih c, ".
							"$DBUser.tabel_202_produk e ".
			  "where ".
							"b.prefixpertanggungan=substr(a.no_polis,1,2) and ".
						"b.nopertanggungan=substr(a.no_polis,3,9) and ".
							"substr(b.kdproduk,1,2)<>'JL' and ".
				//X			"b.prefixpertanggungan=d.prefixpertanggungan and ".
				//X"b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ".
				"b.nopenagih=c.nopenagih and a.void='0' and b.kdvaluta='0' and ".
							//"to_char(a.entry_time,'YYYYMM') between '$tglawal' and  '$tglakhir' and ".
							"to_char(a.entry_time,'YYYYMMdd') between '$tglawaldari' and  '$tglakhirsampai' and ".
							//"to_char(a.tglupdated,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
							"c.kdrayonpenagih='$kantor' and ".
							"b.kdproduk=e.kdproduk and a.company_code='".$kdbank."' ";} 
	 else if ($kdbank=="VBN") {
  $sql = "select ".
            "distinct e.kdcabas as cabas ".
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
            "b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ".
            "b.nopenagih=c.nopenagih and a.statuspembayaran='2' and b.kdvaluta='0' and ".
						//"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
						"to_char(a.tglrekam,'YYYYMMdd') between '$tglawaldari' and  '$tglakhirsampai' and ".
						//"to_char(a.tglupdated,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
						"c.kdrayonpenagih='$kantor' and ".
            "b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' ";}
	 else {
  $sql = "select ".
            "distinct e.kdcabas as cabas ".
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
            "b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ".
            "b.nopenagih=c.nopenagih and a.statuspembayaran='2' and b.kdvaluta='0' and ".
						//"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
						"to_char(a.tglrekam,'YYYYMMdd') between '$tglawaldari' and  '$tglakhirsampai' and ".
						//"to_char(a.tglupdated,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
						"c.kdrayonpenagih='$kantor' and ".
            "b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' ";}
	$DB->parse($sql);
  $DB->execute();				
  $arr = $DB->result();	
?>
<b>Valuta Rupiah Dengan Indeks (VRDI)</b>
<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
  <tr>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    NO</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Cabas</td>
		<td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    No. Polis</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Nama Pemb. Polis</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Bulan Tagihan</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    No.Rekening</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    OB/NB</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Jml. Premi</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Jml. Rider</td>
     <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Kurs</td>
		<td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Discount</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Materai</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Total Debet</td>
		<td align="center" colspan="3" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Komisi Penutupan</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Nama Penutup</td>
		<td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Penagih Lama</td>
  </tr>
	<tr>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    TH.1</td>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    TH.2</td>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    TH.3</td>
  </tr>
	<? 

  foreach ($arr as $foo => $row ) {
	$cabas = $row["CABAS"];
	
	if($kdbank=="BMRI" || $kdbank=="BBRI" || $kdbank=="BBNI" || $kdbank=="BIMA" || $kdbank=="PPOS") {
			$sql="SELECT   c.kdrayonpenagih,
				   b.prefixpertanggungan,
				   b.nopertanggungan,
				   b.kdvaluta,
				   d.tglbooked AS tglbuk,
				   d.kdkuitansi,
				   b.premistd AS premitagihan,INDEXAWAL,
				   d.kdrekeninglawan,
				   TO_NUMBER (a.BILL_AMOUNT) AS jmlpremi,
				   NULL nourut,
				   a.no_polis,
				   TO_CHAR (a.tgl_booked, 'MM/YYYY') AS blntagihan,
				   NULL nokontrol,
				   null norekdebet,
				   null norekkredit,
				   a.void,
				   a.nama_klien,
				   a.void,
				   a.entry_time,
				   TO_CHAR (d.tglbayar, 'DD/MM/YYYY') AS tglbayar,
				   a.entry_time,
				   TO_CHAR (d.tglbayar, 'MM/YYYY') AS blnbayar,
				   TO_CHAR (d.tglbayar, 'YYYYMM') AS blnbayarnya,
				   b.nopenagih,
				   b.noagen,
				   b.norekeningdebet,
				   (SELECT   namaklien1
					  FROM   $DBUser.tabel_100_klien
					 WHERE   noklien = b.nopembayarpremi)
					  AS namaklien,
				   CEIL (MONTHS_BETWEEN (a.entry_time, b.mulas) / 12) AS thnkomisi,
				   (SELECT   komisiagencb
					  FROM   $DBUser.tabel_404_temp
					 WHERE   prefixpertanggungan = b.prefixpertanggungan
							 AND nopertanggungan = b.nopertanggungan
							 AND thnkomisi =
								   CEIL (MONTHS_BETWEEN (a.entry_time, b.mulas) / 12)
							 AND kdkomisiagen = '01')
					  komisiagen,
				   (SELECT   namaklien1
					  FROM   $DBUser.tabel_100_klien
					 WHERE   noklien = b.noagen)
					  AS namaagen,
				   e.kdcabas,
				   (SELECT   nilaimeterai
					  FROM   $DBUser.tabel_999_batas_materai
					 WHERE   (TO_NUMBER (a.bill_amount) / 100) - 6000 BETWEEN batasbawahpremi
																			AND  batasataspremi)
					  AS matere,
				   (SELECT   premitagihan
					  FROM   $DBUser.tabel_300_historis_rider
					 WHERE   prefixpertanggungan = b.prefixpertanggungan
							 AND nopertanggungan = b.nopertanggungan
							 AND TO_CHAR (tglbooked, 'ddmmyyyy') =
								   TO_CHAR (a.tgl_booked, 'ddmmyyyy'))
					  rider
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
				   AND a.void = '0'
				   AND b.kdvaluta = '0'
				   --AND TO_CHAR (a.entry_time, 'YYYYMM') BETWEEN '$tglawal' and  '$tglakhir'
				   AND to_char(a.entry_time,'YYYYMMdd') between '$tglawaldari' and  '$tglakhirsampai' 
				   AND c.kdrayonpenagih = '$kantor'
				   AND b.kdproduk = e.kdproduk
				   AND SUBSTR (b.kdproduk, 1, 2) <> 'JL'
				   AND a.company_code = '".$kdbank."'
		ORDER BY   b.prefixpertanggungan, b.nopertanggungan, d.kdkuitansi";
	}
	else if($kdbank=="VBN") {
	$sql = "select ".
            "c.kdrayonpenagih,b.prefixpertanggungan,b.nopertanggungan,b.kdvaluta,".
            "(SELECT tglbooked FROM $DBUser.tabel_300_historis_premi where prefixpertanggungan = b.prefixpertanggungan ".
			"AND nopertanggungan= b.nopertanggungan AND trunc(tglbooked,'month') = trunc(a.tglbooked,'month')) tglbuk,".
			"(SELECT kdkuitansi FROM $DBUser.tabel_300_historis_premi where prefixpertanggungan = b.prefixpertanggungan ".
			"AND nopertanggungan= b.nopertanggungan AND trunc(tglbooked,'month') = trunc(a.tglbooked,'month')) kdkuitansi,".
			"(SELECT premitagihan FROM $DBUser.tabel_300_historis_premi where prefixpertanggungan = b.prefixpertanggungan ".
			"AND nopertanggungan= b.nopertanggungan AND trunc(tglbooked,'month') = trunc(a.tglbooked,'month')) premitagihan,".
			"(SELECT kdrekeninglawan FROM $DBUser.tabel_300_historis_premi where prefixpertanggungan = b.prefixpertanggungan ".
			"AND nopertanggungan= b.nopertanggungan AND trunc(tglbooked,'month') = trunc(a.tglbooked,'month')) kdrekeninglawan,".
						"to_number(a.jumlahtagihan)/100 as jmlpremi,".
            "a.nopolis,to_char(a.tglbooked,'MM/YYYY') as blntagihan,".
						"a.nokontrol,to_number(a.norekdebet) as norekdebet,a.norekkredit,a.statuspembayaran,".
   					"a.nourut,".
						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as namaklien, ".
						"(select phonetetap01 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as telp1, ".
						"(select phonetetap02 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as telp2, ".
						"a.beritakredit,a.statuspembayaran, ".
						"a.tglrekam,(".
						"SELECT TO_CHAR (tglbayar, 'DD/MM/YYYY') FROM $DBUser.tabel_300_historis_premi where prefixpertanggungan = b.prefixpertanggungan ".
			"AND nopertanggungan= b.nopertanggungan AND tglbooked = a.tglbooked ".
						") as tglbayar,a.tglupdated,".
						"(".
						"SELECT TO_CHAR (tglbayar, 'MM/YYYY')FROM $DBUser.tabel_300_historis_premi where prefixpertanggungan = b.prefixpertanggungan ".
			"AND nopertanggungan= b.nopertanggungan AND tglbooked = a.tglbooked ".
						") as blnbayar,".
						"b.nopenagih,b.noagen,b.norekeningdebet, ".
						"ceil(months_between(a.tglupdated,b.mulas)/12) as thnkomisi, ".
						
						"(select komisiagencb from $DBUser.tabel_404_temp ". 
               "where prefixpertanggungan=b.prefixpertanggungan ". 
          	 "and nopertanggungan=b.nopertanggungan ".
          	 "and thnkomisi= ceil(months_between(a.tglupdated,b.mulas)/12) ".
          	 "and kdkomisiagen='01') komisiagen, ".
						 
						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.noagen) as namaagen, ".
						"e.kdcabas, ".
		
            "(select nilaimeterai from $DBUser.tabel_999_batas_materai ".
  					 "where to_number(a.jumlahtagihan)/100 between ".
             "batasbawahpremi and batasataspremi ".
             ") as matere,
			  (SELECT   premitagihan
					  FROM   $DBUser.tabel_300_historis_rider
					 WHERE   prefixpertanggungan = b.prefixpertanggungan
							 AND nopertanggungan = b.nopertanggungan
							 AND TO_CHAR (tglbooked, 'ddmmyyyy') =
								   TO_CHAR (a.tglbooked, 'ddmmyyyy'))
					  rider ".
          "from ".
           // "$DBUser.tabel_300_historis_premi d,".
            "$DBUser.tabel_200_pertanggungan b,".
            "$DBUser.tabel_315_pelunasan_va a,".
            "$DBUser.tabel_500_penagih c, ".
						"$DBUser.tabel_202_produk e ".
          "where ".
						"b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
   					"b.nopertanggungan=substr(a.nopolis,3,9) and ".
					//	"b.prefixpertanggungan=d.prefixpertanggungan and ".
           // "b.nopertanggungan=d.nopertanggungan and ".
           // "a.tglbooked=d.tglbooked and ".
            "b.nopenagih=c.nopenagih and ".
						"substr(b.kdproduk,1,2)<>'JL' and ".
						"a.statuspembayaran='2' and ".
						"b.kdvaluta='0' and ".
						//"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
						"to_char(a.tglrekam,'YYYYMMdd') between '$tglawaldari' and  '$tglakhirsampai' and ".
            "c.kdrayonpenagih='$kantor' and ".
						"b.kdproduk=e.kdproduk and e.kdcabas='$cabas' and a.kdbank='".$kdbank."' ".
					"order by kdkuitansi, prefixpertanggungan, nopertanggungan";}
	else {
	$sql = "select ".
            "c.kdrayonpenagih,b.prefixpertanggungan,b.nopertanggungan,b.kdvaluta,nvl(b.indexawal,1) INDEXAWAL,".
            "d.tglbooked as tglbuk,d.kdkuitansi,d.premitagihan,d.kdrekeninglawan,".
						"to_number(a.jumlahtagihan)/100 as jmlpremi,".
            "a.nopolis,to_char(a.tglbooked,'MM/YYYY') as blntagihan,".
						"a.nokontrol,to_number(a.norekdebet) as norekdebet,a.norekkredit,a.statuspembayaran,".
//   					"a.nourut,a.namaklien,a.beritakredit,a.statuspembayaran, ".
// Revisi oleh Ari 14/06/2007
   					"a.nourut,".
						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as namaklien, ".
						"(select phonetetap01 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as telp1, ".
						"(select phonetetap02 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as telp2, ".
						
						"a.beritakredit,a.statuspembayaran, ".
//

						"a.tglrekam,to_char(d.tglbayar,'DD/MM/YYYY') as tglbayar,".
						"to_char(d.tglbayar,'MM/YYYY') as blnbayar,".
						"b.nopenagih,b.noagen,b.norekeningdebet, ".
						"ceil(months_between(a.tglupdated,b.mulas)/12) as thnkomisi, ".
						"(select komisiagencb from $DBUser.tabel_404_temp ". 
               "where prefixpertanggungan=b.prefixpertanggungan ". 
          	 "and nopertanggungan=b.nopertanggungan ".
          	 "and thnkomisi= ceil(months_between(a.tglupdated,b.mulas)/12) ".
          	 "and kdkomisiagen='01') komisiagen, ".
						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.noagen) as namaagen, ".
						"e.kdcabas, ".
            "(select nilaimeterai from $DBUser.tabel_999_batas_materai ".
  					 "where to_number(a.jumlahtagihan)/100 between ".
             "batasbawahpremi and batasataspremi ".
             ") as matere, ".						
						 "(select kurs from $DBUser.tabel_999_kurs_transaksi where tglkursberlaku=".
      	       "(select max(tglkursberlaku) from $DBUser.tabel_999_kurs_transaksi ".
      	     	 "where tglkursberlaku<=a.tglrekam and kdvaluta='0') ".
      	     	 "and kdvaluta='0' ) kurs ".
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
						"a.statuspembayaran='2' and ".
						"b.kdvaluta='0' and ".
						//"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
						" to_char(a.tglrekam,'YYYYMMdd') between '$tglawaldari' and  '$tglakhirsampai' and ".
            //"to_char(a.tglupdated,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
            "c.kdrayonpenagih='$kantor' and ".
						"b.kdproduk=e.kdproduk and e.kdcabas='$cabas' and a.kdbank='".$kdbank."' ".
					"order by d.kdkuitansi, d.prefixpertanggungan, d.nopertanggungan";}
		//echo $sql;
		//die;
	  $DB->parse($sql);
	  $DB->execute();
	
  	$i=1;
  	$discountnb_di = 0;
  	$discountob_di = 0;
  	$preminb_di = 0;
  	$premiob_di = 0;
  	$matrenb_di = 0;
  	$matreob_di = 0;
  	$totaldebetnb_di = 0;
  	$totaldebetob_di = 0;
  	$jnb_di = 0;
  	$job_di = 0;
		$jmlkomisith1_di = 0;
		$jmlkomisith2_di = 0;
		$jmlkomisith3_di = 0;
		
		$premihitungnb_di=0;
		$premihitungob_di=0;
		
  	while ($arr=$DB->nextrow()) {
  	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	  $kdkui_di = substr($arr["KDKUITANSI"],0,2);
  		if($kdkui_di=="NB")
  		{
  		  $preminb_di = $arr["PREMITAGIHAN"];
  			$premiob_di = 0;
  			//$discountnb_di = ($arr["PREMITAGIHAN"]* 0.01);
  			$discountnb_di = (round(($arr["PREMITAGIHAN"]/$arr["INDEXAWAL"]),2) * 0.01 * $arr["KURS"]); // ?? apakah dipake
  			$discountob_di = 0;
  			$matrenb_di		= $arr["MATERE"];
  			$matreob_di		= 0;
  			$totaldebetnb_di = $arr["JMLPREMI"];
  			$totaldebetob_di = 0;
  			$jnb++;
  			${"kdreknb".$cabas} = $arr["KDREKENINGLAWAN"];
				$premihitungnb_di = $arr["PREMITAGIHAN"]/$arr["INDEXAWAL"];
				$premihitungob_di = 0;
  		}
  		elseif($kdkui_di=="OB")
  		{
  		  $premiob_di = $arr["PREMITAGIHAN"];
  			$preminb_di = 0;
  			//$discountob_di = ($arr["PREMITAGIHAN"]* 0.01);
				$discountob_di = (round(($arr["PREMITAGIHAN"]/$arr["INDEXAWAL"]),2) * 0.01 * $arr["KURS"]);
  			$discountnb_di = 0;
  			$matreob_di		= $arr["MATERE"];
  			$matrenb_di		= 0;
  			$totaldebetob_di = $arr["JMLPREMI"];
  			$totaldebetnb_di = 0;
  			$job++;
  			${"$kdrekob".$cabas} = $arr["KDREKENINGLAWAN"];
				$premihitungob_di = $arr["PREMITAGIHAN"]/$arr["INDEXAWAL"];
				$premihitungnb_di = 0;
  		}
			
			
  	?>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$i;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=($prevcabas<>$arr["KDCABAS"] ? "<b>".$arr["KDCABAS"]."</b>" : "");?></td>
		<td nowrap style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NAMAKLIEN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["BLNTAGIHAN"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KDREKENINGLAWAN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$kdkui_di;?></td>
    <? 
  		$premihitung_di = $arr["PREMITAGIHAN"]/$arr["INDEXAWAL"];
		?>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($premihitung_di,2,",",".");?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["RIDER"],2,",",".");?></td>
        <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["KURS"],2,",",".");?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right">
		  <?
			if($arr["BLNBAYAR"]!=$arr["BLNTAGIHAN"])
			{
			  $discount_di = 0;
				$discountnb_di = 0;
				$discountob_di = 0;
			}
			else
			{
			  //$discount_di = ($arr["PREMITAGIHAN"]* 0.01);
				$discountnb_di = $discountnb_di;
				$discountob_di = $discountob_di;
				$discount_di = round($premihitung_di,2) * $arr["KURS"] * 0.01;
			}
			
			$discounthitung = round($discount_di,2);
			echo number_format($discounthitung,2,",",".");
			//echo number_format($discount_di,2,",",".");
			?>
		</td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["MATERE"],2,",",".");?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["JMLPREMI"],2,",",".");?></td>
    <? 
		 switch($arr["THNKOMISI"])
		 {
			 case '1' : $tk1 = number_format($arr["KOMISIAGEN"],2,",","."); $tk2 = "-"; $tk3 = "-"; 
			 					$jmlkomisith1_di = $arr["KOMISIAGEN"]; $jmlkomisith2_di = 0; $jmlkomisith3_di = 0;
								${"totkomisith1_di".$cabas} += $jmlkomisith1_di;
								break;							
			 case '2' : $tk1 = "-"; $tk2 = number_format($arr["KOMISIAGEN"],2,",","."); $tk3 = "-"; 
			   				$jmlkomisith1_di = 0; $jmlkomisith2_di = $arr["KOMISIAGEN"]; $jmlkomisith3_di = 0;
								${"totkomisith2_di".$cabas} += $jmlkomisith2_di;
								break;
			 case '3' : $tk1 = "-"; $tk2 = "-"; $tk3 = number_format($arr["KOMISIAGEN"],2,",","."); 
			 					$jmlkomisith1_di = 0; $jmlkomisith2_di = 0; $jmlkomisith3_di = $arr["KOMISIAGEN"];
								${"totkomisith3_di".$cabas} += $jmlkomisith3_di;
								break;
			 default : $tk1 = "-"; $tk2 = "-"; $tk3 = "-";
		 }

//* Revisi oleh Ari 13/09/2007		 
//		 $PNG=new Klien($userid,$passwd,$arr["NOPENAGIHLAMA"]);
      	/*$sql=	"select substr(keteranganmutasi,20,10) as nopenagihlama from $DBUser.tabel_600_historis_mutasi_pert ".
      						"where kdmutasi='12' and prefixpertanggungan='".$arr["PREFIXPERTANGGUNGAN"]."' ".
      						"and nopertanggungan='".$arr["PREFIXPERTANGGUNGAN"]."' and substr(keteranganmutasi,length(keteranganmutasi)-15,16) like '%".$namalike."%' ".
      						"group by substr(keteranganmutasi,20,10)";*/
		$sql="SELECT   nopenagih NOPENAGIHLAMA, (SELECT   namaklien1
                       FROM   $DBUser.tabel_100_klien
                      WHERE   noklien = nopenagih) namapenagihlama
			  FROM   $DBUser.tabel_600_historis_mutasi_pert a, $DBUser.TABEL_200_AGEN_PENAGIH_UPDATE b
			 WHERE       a.prefixpertanggungan = b.prefixpertanggungan
					 AND a.nopertanggungan = b.nopertanggungan
					 AND TO_CHAR(tglmutasi,'DDMMYYYY') = TO_CHAR(tglrekam,'DDMMYYYY')
					 AND a.prefixpertanggungan = '".$arr["PREFIXPERTANGGUNGAN"]."'
					 AND a.nopertanggungan = '".$arr["NOPERTANGGUNGAN"]."'";
        $DBA->parse($sql);
        $DBA->execute();
				$arrA=$DBA->nextrow();
      	
		 		$PNG=new Klien($userid,$passwd,$arrA["NOPENAGIHLAMA"]);
//*

		?>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=$tk1;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=$tk2;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=$tk3;?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NAMAAGEN"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$PNG->nama;?></td>
  </tr>
	<? 
	$i++;
	$jmlmatre+=$matre_di;
	//$jmldiscount +=$discount_di;
	$jmldiscount += $discounthitung;
	$jmltotaldebet += $arr["JMLPREMI"];
	$jmlpremi += $arr["PREMITAGIHAN"];
	
	${"jmlpreminb_di".$cabas} += $premihitungnb_di;
	${"jmlpremiob_di".$cabas} += $premihitungob_di;
	
	${"jmldiscountnb_di".$cabas} +=$discountnb_di;
	${"jmldiscountob_di".$cabas} +=$discountob_di;
	
	${"jmlmatrenb_di".$cabas}+=$matrenb_di;
	${"jmlmatreob_di".$cabas}+=$matreob_di;
	${"jmltotaldebetnb_di".$cabas} += $totaldebetnb_di;
	${"jmltotaldebetob_di".$cabas} += $totaldebetob_di;
	
	$prevcabas = $arr["KDCABAS"];
	}
	?>
	<tr bgcolor="#f5d79c">
	 <td></td>
	 <td colspan="4"><b>JUMLAH <?=$cabas;?></b></td>
	 <td><?=${"kdrekob".$cabas};?></td>
	 
	 <td><? //=$job;?>OB</td>
	 <td align="right"><?=number_format(${"jmlpremiob_di".$cabas},2,",",".");?></td>
	 <td></td><td></td>
	 <td align="right"><?=number_format(${"jmldiscountob_di".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"jmlmatreob_di".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"jmltotaldebetob_di".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"totkomisith1_di".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"totkomisith2_di".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"totkomisith3_di".$cabas},2,",",".");?></td>
	 <td></td>
	 <td></td>
	</tr>
	<tr bgcolor="#f5d79c">
	 <td></td>
	 <td colspan="4"></td>
	 <td><?=${"kdreknb".$cabas};?></td>
	 <td><? //=$jnb;?>NB</td>
	 <td align="right"><?=number_format(${"jmlpreminb_di".$cabas},2,",",".");?></td>
	 <td></td><td align="right"></td>
	 <td align="right"><?=number_format(${"jmldiscountnb_di".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"jmlmatrenb_di".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"jmltotaldebetnb_di".$cabas},2,",",".");?></td>
	 <td></td>
	 <td></td>
	 <td></td>
	 <td></td>
	 <td></td>
	</tr>
	<? 
	}
	?>
</table>
<!-----------------------  end rupiah dengan index -------------------------->
<br />
<? 
}
?>

<!--------------  start valuta asing --------------->
<? 
if($kdbank=="BMRI" || $kdbank=="BBRI" || $kdbank=="BBNI" || $kdbank=="BIMA" || $kdbank=="PPOS") {
	$sql = "select ".
				"distinct e.kdcabas as cabas ".
			  "from ".
				//X"$DBUser.tabel_300_historis_premi d,".
				"$DBUser.tabel_200_pertanggungan b,".
				"$DBUser.tabel_315_pelunasan_h2h a,".
				"$DBUser.tabel_500_penagih c, ".
							"$DBUser.tabel_202_produk e ".
			  "where ".
							"b.prefixpertanggungan=substr(a.no_polis,1,2) and ".
						"b.nopertanggungan=substr(a.no_polis,3,9) and ".
							"substr(b.kdproduk,1,2)<>'JL' and ".
				//X			"b.prefixpertanggungan=d.prefixpertanggungan and ".
				//X"b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ".
				"b.nopenagih=c.nopenagih and a.void='0' and b.kdvaluta='3' and ".
							//"to_char(a.entry_time,'YYYYMMdd') between '$tglawal' and  '$tglakhir' and ".
							"to_char(a.entry_time,'YYYYMMdd') between '$tglawaldari' and  '$tglakhirsampai' and ".
							"c.kdrayonpenagih='$kantor' and ".
							"b.kdproduk=e.kdproduk and a.company_code='".$kdbank."' ";} 
	 else if ($kdbank=="VBN") {
  $sql = "select ".
            "distinct e.kdcabas as cabas ".
          "from ".
            "$DBUser.tabel_300_historis_premi d,".
            "$DBUser.tabel_200_pertanggungan b,".
            "$DBUser.tabel_315_pelunasan_va a,".
            "$DBUser.tabel_500_penagih c, ".
            "$DBUser.tabel_202_produk e ".
          "where ".
						"b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
   					"b.nopertanggungan=substr(a.nopolis,3,9) and ".
						"b.prefixpertanggungan=d.prefixpertanggungan and ".
            "b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ".
            "b.nopenagih=c.nopenagih and a.statuspembayaran='2' and b.kdvaluta='3' and ".
						//"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
						"to_char(a.tglrekam,'YYYYMMdd') between '$tglawaldari' and  '$tglakhirsampai' and ".
						//"to_char(a.tglupdated,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
						"c.kdrayonpenagih='$kantor' and ".
            "b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' ";}
	 else {
$sql = "select ".
            "distinct e.kdcabas as cabas ".
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
            "b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ".
            "b.nopenagih=c.nopenagih and a.statuspembayaran='2' and b.kdvaluta='3' and ".
						//"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
						" to_char(a.tglrekam,'YYYYMMdd') between '$tglawaldari' and  '$tglakhirsampai' and ".
						//"to_char(a.tglupdated,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
						"c.kdrayonpenagih='$kantor' and ".
            "b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' ";}
  $DB->parse($sql);
  $DB->execute();				
	$ars=$DB->nextrow();
	$ono_va = $ars["CABAS"];
	
if($ono_va!="")
{						
if($kdbank=="BMRI" || $kdbank=="BBRI" || $kdbank=="BBNI" || $kdbank=="BIMA" || $kdbank=="PPOS") {
	$sql = "select ".
				"distinct e.kdcabas as cabas ".
			  "from ".
				//X"$DBUser.tabel_300_historis_premi d,".
				"$DBUser.tabel_200_pertanggungan b,".
				"$DBUser.tabel_315_pelunasan_h2h a,".
				"$DBUser.tabel_500_penagih c, ".
							"$DBUser.tabel_202_produk e ".
			  "where ".
							"b.prefixpertanggungan=substr(a.no_polis,1,2) and ".
						"b.nopertanggungan=substr(a.no_polis,3,9) and ".
							"substr(b.kdproduk,1,2)<>'JL' and ".
				//X			"b.prefixpertanggungan=d.prefixpertanggungan and ".
				//X"b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ".
				"b.nopenagih=c.nopenagih and a.void='0' and b.kdvaluta='3' and ".
							//"to_char(a.entry_time,'YYYYMM') between '$tglawal' and  '$tglakhir' and ".
							" to_char(a.entry_time,'YYYYMMdd') between '$tglawaldari' and  '$tglakhirsampai' and ".
							//"to_char(a.tglupdated,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
							"c.kdrayonpenagih='$kantor' and ".
							"b.kdproduk=e.kdproduk and a.company_code='".$kdbank."' ";} 
else if($kdbank=="VBN") {						
$sql = "select ".
            "distinct e.kdcabas as cabas ".
          "from ".
            "$DBUser.tabel_300_historis_premi d,".
            "$DBUser.tabel_200_pertanggungan b,".
            "$DBUser.tabel_315_pelunasan_va a,".
            "$DBUser.tabel_500_penagih c, ".
            "$DBUser.tabel_202_produk e ".
          "where ".
						"b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
   					"b.nopertanggungan=substr(a.nopolis,3,9) and ".
						"b.prefixpertanggungan=d.prefixpertanggungan and ".
            "b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ".
            "b.nopenagih=c.nopenagih and a.statuspembayaran='2' and b.kdvaluta='3' and ".
						//"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
						" to_char(a.tglrekam,'YYYYMMdd') between '$tglawaldari' and  '$tglakhirsampai' and ".
						//"to_char(a.tglupdated,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
						"c.kdrayonpenagih='$kantor' and ".
            "b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' ";}
	 else {						
$sql = "select ".
            "distinct e.kdcabas as cabas ".
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
            "b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ".
            "b.nopenagih=c.nopenagih and a.statuspembayaran='2' and b.kdvaluta='3' and ".
						//"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
						" to_char(a.tglrekam,'YYYYMMdd') between '$tglawaldari' and  '$tglakhirsampai' and ".
						//"to_char(a.tglupdated,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
						"c.kdrayonpenagih='$kantor' and ".
            "b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' ";}
						//echo $sql;
	$DB->parse($sql);
  $DB->execute();				
  $arr = $DB->result();	
?>
<b>Valuta Asing (VA)</b>
<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
  <tr>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    NO</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Cabas</td>
		<td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    No. Polis</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Nama Pemb. Polis</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Bulan Tagihan</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    No.Rekening</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    OB/NB</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Jml. Premi</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Jml. Rider</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Kurs</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Discount</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Materai</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Total Debet</td>
		<td align="center" colspan="3" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Komisi Penutupan</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Nama Penutup</td>
		<td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Penagih Lama</td>
  </tr>
	<tr>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    TH.1</td>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    TH.2</td>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    TH.3</td>
  </tr>
	<? 
  foreach ($arr as $foo => $row ) {
	$cabas = $row["CABAS"];
	if($kdbank=="BMRI" || $kdbank=="BBRI" || $kdbank=="BBNI"  || $kdbank=="BIMA" || $kdbank=="PPOS") {
			$sql="SELECT   c.kdrayonpenagih,
				   b.prefixpertanggungan,
				   b.nopertanggungan,
				   b.kdvaluta,
				   d.tglbooked AS tglbuk,
				   d.kdkuitansi,
				   b.premistd AS premitagihan,
				   d.kdrekeninglawan,
				   TO_NUMBER (a.BILL_AMOUNT) AS jmlpremi,
				   NULL nourut,
				   a.no_polis,
				   TO_CHAR (a.tgl_booked, 'MM/YYYY') AS blntagihan,
				   NULL nokontrol,
				   null norekdebet,
				   null norekkredit,
				   a.void,
				   a.nama_klien,
				   a.void,
				   a.entry_time,
				   TO_CHAR (d.tglbayar, 'DD/MM/YYYY') AS tglbayar,
				   a.entry_time,
				   TO_CHAR (d.tglbayar, 'MM/YYYY') AS blnbayar,
				   TO_CHAR (d.tglbayar, 'YYYYMM') AS blnbayarnya,
				   b.nopenagih,
				   b.noagen,
				   b.norekeningdebet,
				   (SELECT   namaklien1
					  FROM   $DBUser.tabel_100_klien
					 WHERE   noklien = b.nopembayarpremi)
					  AS namaklien,
				   CEIL (MONTHS_BETWEEN (a.entry_time, b.mulas) / 12) AS thnkomisi,
				   (SELECT   komisiagencb
					  FROM   $DBUser.tabel_404_temp
					 WHERE   prefixpertanggungan = b.prefixpertanggungan
							 AND nopertanggungan = b.nopertanggungan
							 AND thnkomisi =
								   CEIL (MONTHS_BETWEEN (a.entry_time, b.mulas) / 12)
							 AND kdkomisiagen = '01')
					  komisiagen,
				   (SELECT   namaklien1
					  FROM   $DBUser.tabel_100_klien
					 WHERE   noklien = b.noagen)
					  AS namaagen,
				   e.kdcabas,
				   (SELECT   nilaimeterai
					  FROM   $DBUser.tabel_999_batas_materai
					 WHERE   (TO_NUMBER (a.bill_amount) / 100) - 6000 BETWEEN batasbawahpremi
																			AND  batasataspremi)
					  AS matere,
				   (SELECT   premitagihan
					  FROM   $DBUser.tabel_300_historis_rider
					 WHERE   prefixpertanggungan = b.prefixpertanggungan
							 AND nopertanggungan = b.nopertanggungan
							 AND TO_CHAR (tglbooked, 'ddmmyyyy') =
								   TO_CHAR (a.tgl_booked, 'ddmmyyyy'))
					  rider
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
				   AND a.void = '0'
				   AND b.kdvaluta = '3'
				   --AND TO_CHAR (a.entry_time, 'YYYYMM') BETWEEN '$tglawal' and  '$tglakhir'
				   and to_char(a.entry_time,'YYYYMMdd') between '$tglawaldari' and  '$tglakhirsampai' 
				   AND c.kdrayonpenagih = '$kantor'
				   AND b.kdproduk = e.kdproduk
				   AND SUBSTR (b.kdproduk, 1, 2) <> 'JL'
				   AND a.company_code = '".$kdbank."'
		ORDER BY   b.prefixpertanggungan, b.nopertanggungan, d.kdkuitansi";
	}
	else if($kdbank=="VBN") {
	$sql = "select ".
            "c.kdrayonpenagih,b.prefixpertanggungan,b.nopertanggungan,b.kdvaluta,".
            "(SELECT tglbooked FROM $DBUser.tabel_300_historis_premi where prefixpertanggungan = b.prefixpertanggungan ".
			"AND nopertanggungan= b.nopertanggungan AND trunc(tglbooked,'month') = trunc(a.tglbooked,'month')) tglbuk,".
			"(SELECT kdkuitansi FROM $DBUser.tabel_300_historis_premi where prefixpertanggungan = b.prefixpertanggungan ".
			"AND nopertanggungan= b.nopertanggungan AND trunc(tglbooked,'month') = trunc(a.tglbooked,'month')) kdkuitansi,".
			"(SELECT premitagihan FROM $DBUser.tabel_300_historis_premi where prefixpertanggungan = b.prefixpertanggungan ".
			"AND nopertanggungan= b.nopertanggungan AND trunc(tglbooked,'month') = trunc(a.tglbooked,'month')) premitagihan,".
			"(SELECT kdrekeninglawan FROM $DBUser.tabel_300_historis_premi where prefixpertanggungan = b.prefixpertanggungan ".
			"AND nopertanggungan= b.nopertanggungan AND trunc(tglbooked,'month') = trunc(a.tglbooked,'month')) kdrekeninglawan,".
						"to_number(a.jumlahtagihan)/100 as jmlpremi,".
            "a.nopolis,to_char(a.tglbooked,'MM/YYYY') as blntagihan,".
						"a.nokontrol,to_number(a.norekdebet) as norekdebet,a.norekkredit,a.statuspembayaran,".
   					"a.nourut,".
						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as namaklien, ".
						"(select phonetetap01 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as telp1, ".
						"(select phonetetap02 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as telp2, ".
						"a.beritakredit,a.statuspembayaran, ".
						"a.tglrekam,(".
						"SELECT TO_CHAR (tglbayar, 'DD/MM/YYYY') FROM $DBUser.tabel_300_historis_premi where prefixpertanggungan = b.prefixpertanggungan ".
			"AND nopertanggungan= b.nopertanggungan AND tglbooked = a.tglbooked ".
						") as tglbayar,a.tglupdated,".
						"(".
						"SELECT TO_CHAR (tglbayar, 'MM/YYYY')FROM $DBUser.tabel_300_historis_premi where prefixpertanggungan = b.prefixpertanggungan ".
			"AND nopertanggungan= b.nopertanggungan AND tglbooked = a.tglbooked ".
						") as blnbayar,".
						"b.nopenagih,b.noagen,b.norekeningdebet, ".
						"ceil(months_between(a.tglupdated,b.mulas)/12) as thnkomisi, ".
						
						"(select komisiagencb from $DBUser.tabel_404_temp ". 
               "where prefixpertanggungan=b.prefixpertanggungan ". 
          	 "and nopertanggungan=b.nopertanggungan ".
          	 "and thnkomisi= ceil(months_between(a.tglupdated,b.mulas)/12) ".
          	 "and kdkomisiagen='01') komisiagen, ".
						 
						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.noagen) as namaagen, ".
						"e.kdcabas, ".
		
            "(select nilaimeterai from $DBUser.tabel_999_batas_materai ".
  					 "where to_number(a.jumlahtagihan)/100 between ".
             "batasbawahpremi and batasataspremi ".
             ") as matere,
			  (SELECT   premitagihan
					  FROM   $DBUser.tabel_300_historis_rider
					 WHERE   prefixpertanggungan = b.prefixpertanggungan
							 AND nopertanggungan = b.nopertanggungan
							 AND TO_CHAR (tglbooked, 'ddmmyyyy') =
								   TO_CHAR (a.tglbooked, 'ddmmyyyy'))
					  rider ".
          "from ".
           // "$DBUser.tabel_300_historis_premi d,".
            "$DBUser.tabel_200_pertanggungan b,".
            "$DBUser.tabel_315_pelunasan_va a,".
            "$DBUser.tabel_500_penagih c, ".
						"$DBUser.tabel_202_produk e ".
          "where ".
						"b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
   					"b.nopertanggungan=substr(a.nopolis,3,9) and ".
					//	"b.prefixpertanggungan=d.prefixpertanggungan and ".
           // "b.nopertanggungan=d.nopertanggungan and ".
           // "a.tglbooked=d.tglbooked and ".
            "b.nopenagih=c.nopenagih and ".
						"substr(b.kdproduk,1,2)<>'JL' and ".
						"a.statuspembayaran='2' and ".
						"b.kdvaluta='3' and ".
						//"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
						"to_char(a.tglrekam,'YYYYMMdd') between '$tglawaldari' and  '$tglakhirsampai' and ".
            "c.kdrayonpenagih='$kantor' and ".
						"b.kdproduk=e.kdproduk and e.kdcabas='$cabas' and a.kdbank='".$kdbank."' ".
					"order by kdkuitansi, prefixpertanggungan, nopertanggungan";}
	else {
	$sql = "select ".
            "c.kdrayonpenagih,b.prefixpertanggungan,b.nopertanggungan,b.kdvaluta,".
            "d.tglbooked as tglbuk,d.kdkuitansi,d.premitagihan,d.kdrekeninglawan,".
						"to_number(a.jumlahtagihan)/100 as jmlpremi,".
            "a.nopolis,to_char(a.tglbooked,'MM/YYYY') as blntagihan,".
						"a.nokontrol,to_number(a.norekdebet) as norekdebet,a.norekkredit,a.statuspembayaran,".
//   					"a.nourut,a.namaklien,a.beritakredit,a.statuspembayaran, ".
// Revisi oleh Ari 14/06/2007
   					"a.nourut,".
						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as namaklien, ".
						"(select phonetetap01 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as telp1, ".
						"(select phonetetap02 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as telp2, ".
						"a.beritakredit,a.statuspembayaran, ".
//

						"a.tglrekam,to_char(d.tglbayar,'DD/MM/YYYY') as tglbayar,a.tglupdated,".
						"to_char(d.tglbayar,'MM/YYYY') as blnbayar,".
						"b.nopenagih,b.noagen,b.norekeningdebet, ".
						"ceil(months_between(a.tglupdated,b.mulas)/12) as thnkomisi, ".
						"(select komisiagencb from $DBUser.tabel_404_temp ". 
               "where prefixpertanggungan=b.prefixpertanggungan ". 
          	 "and nopertanggungan=b.nopertanggungan ".
          	 "and thnkomisi= ceil(months_between(a.tglupdated,b.mulas)/12) ".
          	 "and kdkomisiagen='01') komisiagen, ".
						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.noagen) as namaagen, ".
						"e.kdcabas, ".
            "(select nilaimeterai from $DBUser.tabel_999_batas_materai ".
  					 "where to_number(a.jumlahtagihan)/100 between ".
             "batasbawahpremi and batasataspremi ".
             ") as matere, ".					
						"(select kurs from $DBUser.tabel_999_kurs_transaksi where tglkursberlaku=".
      	       "(select max(tglkursberlaku) from $DBUser.tabel_999_kurs_transaksi ".
      	     	 "where tglkursberlaku<=a.tglrekam and kdvaluta='3') ".
      	     	 "and kdvaluta='3' ) kurs ".
          "from ".
            "$DBUser.tabel_300_historis_premi d,".
            "$DBUser.tabel_200_pertanggungan b,".
            "$DBUser.tabel_315_pelunasan_auto_debet a,".
            "$DBUser.tabel_500_penagih c, ".
						"$DBUser.tabel_202_produk e ".
          "where ".
            //"a.nopolis=b.nopol and ".
            "b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
   					"b.nopertanggungan=substr(a.nopolis,3,9) and ".
						"b.prefixpertanggungan=d.prefixpertanggungan and ".
            "b.nopertanggungan=d.nopertanggungan and ".
            "a.tglbooked=d.tglbooked and ".
            "b.nopenagih=c.nopenagih and ".
						"a.statuspembayaran='2' and ".
						"b.kdvaluta='3' and ".
						//"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
						" to_char(a.tglrekam,'YYYYMMdd') between '$tglawaldari' and  '$tglakhirsampai' and ".
            //"to_char(a.tglupdated,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
            "c.kdrayonpenagih='$kantor' and ".
						"b.kdproduk=e.kdproduk and e.kdcabas='$cabas' and a.kdbank='".$kdbank."' ".
					"order by d.kdkuitansi, d.prefixpertanggungan, d.nopertanggungan";}
		//echo $sql;
		//die;
	  $DB->parse($sql);
	  $DB->execute();
	
  	$i=1;
  	$discountnb_a = 0;
  	$discountob_a = 0;
  	$preminb_a = 0;
  	$premiob_a = 0;
  	$matrenb_a = 0;
  	$matreob_a = 0;
  	$totaldebetnb_a = 0;
  	$totaldebetob_a = 0;
  	$jnb_a = 0;
  	$job_a = 0;
		$jmlkomisith1_a = 0;
		$jmlkomisith2_a = 0;
		$jmlkomisith3_a = 0;
  	while ($arr=$DB->nextrow()) {
  	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	  $kdkui = substr($arr["KDKUITANSI"],0,2);
  		if($kdkui=="NB")
  		{
  		  $preminb_a = $arr["PREMITAGIHAN"];
  			$premiob_a = 0;
  			$discountnb_a = ($arr["PREMITAGIHAN"]* 0.01 * $arr["KURS"]);
  			$discountob_a = 0;
  			$matrenb_a		= $arr["MATERE"];
  			$matreob_a		= 0;
  			$totaldebetnb_a = $arr["JMLPREMI"];
  			$totaldebetob_a = 0;
  			$jnb++;
  			${"kdreknb_a".$cabas} = $arr["KDREKENINGLAWAN"];
  		}
  		elseif($kdkui=="OB")
  		{
  		  $premiob_a = $arr["PREMITAGIHAN"];
  			$preminb_a = 0;
  			$discountob_a = ($arr["PREMITAGIHAN"]* 0.01 * $arr["KURS"]);
  			$discountnb_a = 0;
  			$matreob_a		= $arr["MATERE"];
  			$matrenb_a		= 0;
  			$totaldebetob_a = $arr["JMLPREMI"];
  			$totaldebetnb_a = 0;
  			$job++;
  			${"kdrekob_a".$cabas} = $arr["KDREKENINGLAWAN"];
  		}
  	?>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$i;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=($prevcabas<>$arr["KDCABAS"] ? "<b>".$arr["KDCABAS"]."</b>" : "");?></td>
		<td nowrap style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NAMAKLIEN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["BLNTAGIHAN"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KDREKENINGLAWAN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$kdkui;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["PREMITAGIHAN"],2,",",".");?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["RIDER"],2,",",".");?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["KURS"],2,",",".");?> </td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right">
		  <?
			if($arr["BLNBAYAR"]!=$arr["BLNTAGIHAN"])
			{
			  $discount_a = 0;
				$discountnb_a = 0;
				$discountob_a = 0;
			}
			else
			{
			  $discount_a = ($arr["PREMITAGIHAN"]* 0.01 * $arr["KURS"]);
				$discountnb_a = $discountnb_a * $arr["KURS"];
				$discountob_a = $discountob_a * $arr["KURS"];
			}
			echo number_format($discount_a,2,",",".");
			?>
		</td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["MATERE"],2,",",".");?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["JMLPREMI"],2,",",".");?></td>
    <? 
		 switch($arr["THNKOMISI"])
		 {
			 case '1' : $tk1 = number_format($arr["KOMISIAGEN"],2,",","."); $tk2 = "-"; $tk3 = "-"; 
			 					$jmlkomisith1_a = $arr["KOMISIAGEN"]; $jmlkomisith2_a = 0; $jmlkomisith3_a = 0;
              	${"totkomisith1_a".$cabas} += $jmlkomisith1_a;
								break;				
			 case '2' : $tk1 = "-"; $tk2 = number_format($arr["KOMISIAGEN"],2,",","."); $tk3 = "-"; 
			   				$jmlkomisith1_a = 0; $jmlkomisith2_a = $arr["KOMISIAGEN"]; $jmlkomisith3_a = 0;
								${"totkomisith2_a".$cabas} += $jmlkomisith2_a;
								break;
			 case '3' : $tk1 = "-"; $tk2 = "-"; $tk3 = number_format($arr["KOMISIAGEN"],2,",","."); 
			 					$jmlkomisith1_a = 0; $jmlkomisith2_a = 0; $jmlkomisith3_a = $arr["KOMISIAGEN"];
								${"totkomisith3_a".$cabas} += $jmlkomisith3_a;
								break;
			 default : $tk1 = "-"; $tk2 = "-"; $tk3 = "-";
		 }

//* Revisi oleh Ari 13/09/2007		 
//		 $PNG=new Klien($userid,$passwd,$arr["NOPENAGIHLAMA"]);
      	/*$sql=	"select substr(keteranganmutasi,20,10) as nopenagihlama from $DBUser.tabel_600_historis_mutasi_pert ".
      						"where kdmutasi='12' and prefixpertanggungan='".$arr["PREFIXPERTANGGUNGAN"]."' ".
      						"and nopertanggungan='".$arr["PREFIXPERTANGGUNGAN"]."' and substr(keteranganmutasi,length(keteranganmutasi)-15,16) like '%".$namalike."%' ".
      						"group by substr(keteranganmutasi,20,10)";*/
		$sql="SELECT   nopenagih NOPENAGIHLAMA, (SELECT   namaklien1
                       FROM   $DBUser.tabel_100_klien
                      WHERE   noklien = nopenagih) namapenagihlama
			  FROM   $DBUser.tabel_600_historis_mutasi_pert a, $DBUser.TABEL_200_AGEN_PENAGIH_UPDATE b
			 WHERE       a.prefixpertanggungan = b.prefixpertanggungan
					 AND a.nopertanggungan = b.nopertanggungan
					 AND TO_CHAR(tglmutasi,'DDMMYYYY') = TO_CHAR(tglrekam,'DDMMYYYY')
					 AND a.prefixpertanggungan = '".$arr["PREFIXPERTANGGUNGAN"]."'
					 AND a.nopertanggungan = '".$arr["NOPERTANGGUNGAN"]."'";
        $DBA->parse($sql);
        $DBA->execute();
				$arrA=$DBA->nextrow();
      	
		 		$PNG=new Klien($userid,$passwd,$arrA["NOPENAGIHLAMA"]);
//*
		 
		?>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=$tk1;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=$tk2;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=$tk3;?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NAMAAGEN"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$PNG->nama;?></td>
  </tr>
	<? 
	$i++;
	$jmlmatre_a+=$matre_a;
	$jmldiscount_a +=$discount_a;
	${"jmlpreminb_a".$cabas} += $preminb_a;
	${"jmlpremiob_a".$cabas} += $premiob_a;
	
	${"jmldiscountnb_a".$cabas} +=$discountnb_a;
	${"jmldiscountob_a".$cabas} +=$discountob_a;
	
	${"jmlmatrenb_a".$cabas}+=$matrenb_a;
	${"jmlmatreob_a".$cabas}+=$matreob_a;
	
	${"jmltotaldebetnb_a".$cabas} += $totaldebetnb_a;
	${"jmltotaldebetob_a".$cabas} += $totaldebetob_a;
	
	$prevcabas = $arr["KDCABAS"];
	}
	?>
	<tr bgcolor="#f5d79c">
	 <td></td>
	 <td colspan="4"><b>JUMLAH <?=$cabas;?></b></td>
	 <td><?=${"kdrekob_a".$cabas};?></td>
	 <td><? //=$job;?>OB</td>
	 <td align="right"><?=number_format(${"jmlpremiob_a".$cabas},2,",",".");?></td>
	 <td align="right"></td><td></td>
	 <td align="right"><?=number_format(${"jmldiscountob_a".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"jmlmatreob_a".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"jmltotaldebetob_a".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"totkomisith1_a".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"totkomisith2_a".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"totkomisith3_a".$cabas},2,",",".");?></td>
	 <td></td>
	 <td></td>
	</tr>
	<tr bgcolor="#f5d79c">
	 <td></td>
	 <td colspan="4"></td>
	 <td><?=${"kdreknb_a".$cabas};?></td>
	 <td><? //=$jnb;?>NB</td>
	 <td align="right"><?=number_format(${"jmlpreminb_a".$cabas},2,",",".");?></td>
	 <td align="right"></td><td align="right"></td>
	 <td align="right"><?=number_format(${"jmldiscountnb_a".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"jmlmatrenb_a".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"jmltotaldebetnb_a".$cabas},2,",",".");?></td>
	 <td></td>
	 <td></td>
	 <td></td>
	 <td></td>
	 <td></td>
	</tr>
	<? 
	}
	?>
</table>
<!-----------------------  end valuta asing -------------------------->
<? 
}

if ($mode!='print'){
?>
	 	<a href="rekap_autodebet.php"><font color="#ffffff">Rekap Autodebet</font></a> 
	 	<a href="hasil_autodebet_all.php"><font color="#ffffff">Detail Autodebet Seluruh Kantor</font></a>
<? 
		echo "<hr size=1>";
		echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a>";
		echo("<font face=Verdana size=1>&nbsp;&nbsp;|&nbsp;&nbsp;</font>");
		echo("<font face=Verdana size=1><a href=\"#\" onclick=\"window.open('hasil_autodebet.php?tglawaldari=".$tglawaldari."&tglakhirsampai=".$tglakhirsampai."&kdbank=".$kdbank."&kantor=".$kantor."&mode=print','','width=1000,height=600,top=100,left=100,scrollbars=yes');\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak Laporan</a></font>&nbsp;&nbsp;&nbsp;<img src=../img/cetak.gif align=absmiddle border=0><a href='hasil_h2h_pulih_nonlink.php'>SLIP Pemulihan</a></font>");
}


?>
</form>
</body>
</html>
