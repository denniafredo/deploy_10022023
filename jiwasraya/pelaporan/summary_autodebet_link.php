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


if($kdbank=="MDR"){
	switch($periode)
	{
	  case '1' : $tglstart="01"; $tglend="10"; $s1="selected"; break; 
		case '2' : $tglstart="11"; $tglend="20"; $s2="selected"; break;
		case '3' : $tglstart="21"; $tglend="31"; $s3="selected"; break;  
	}
}
elseif($kdbank=="BNI"){
	switch($periode)
	{
	  case '1' : $tglstart="01"; $tglend="13"; $s1="selected"; break; 
		case '2' : $tglstart="14"; $tglend="23"; $s2="selected"; break;
		case '3' : $tglstart="24"; $tglend="31"; $s3="selected"; break;  
	}
}
elseif($kdbank=="VBN"){
	switch($periode)
	{
	  case '1' : $tglstart="01"; $tglend="13"; $s1="selected"; break; 
		case '2' : $tglstart="14"; $tglend="23"; $s2="selected"; break;
		case '3' : $tglstart="24"; $tglend="31"; $s3="selected"; break;  
	}
}
elseif($kdbank=="POS"){
	switch($periode)
	{
	  case '1' : $tglstart="01"; $tglend="10"; $s1="selected"; break; 
		case '2' : $tglstart="11"; $tglend="20"; $s2="selected"; break;
		case '3' : $tglstart="21"; $tglend="31"; $s3="selected"; break;  
	}
}
elseif($kdbank=="BRI"){
	switch($periode)
	{
	  case '1' : $tglstart="01"; $tglend="13"; $s1="selected"; break; 
		case '2' : $tglstart="14"; $tglend="23"; $s2="selected"; break;
		case '3' : $tglstart="24"; $tglend="31"; $s3="selected"; break;  
	}
}	
	if(isset($periode))
	{
	  $bulancari = $month.$year;
/*
		Dikomentari oleh : Udi
		Deskripsi: Ordering tipe data DATE yang di konvert menjadi string harus dalam bentuk 'YYYYMMDD'   

		$tglawal	 = $tglstart.$month.$year;
		$tglakhir	 = $tglend.$month.$year;
*/
		$tglawal	 = $year.$month.$tglstart;
		$tglakhir	 = $year.$month.$tglend;
	}
	else
	{
	  $month=date("m");
		$year=date("Y");
	  $bulancari = $month.$year;
/*
		Dikomentari oleh : Udi
		Deskripsi: Ordering tipe data DATE yang di konvert menjadi string harus dalam bentuk 'YYYYMMDD'   

		$tglawal	 = $tglstart.$month.$year;
		$tglakhir	 = $tglend.$month.$year;
*/

		$tglawal	 = $year.$month.'01';
		$tglakhir	 = $year.$month.'10';
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
	
	  					switch($month)
  						{
  							  case '01': $namabulan = "JANUARI"; break;
  								case '02': $namabulan = "PEBRUARI"; break;
									case '03': $namabulan = "MARET"; break;
									case '04': $namabulan = "APRIL"; break;
									case '05': $namabulan = "MEI"; break;
									case '06': $namabulan = "JUNI"; break;
									case '07': $namabulan = "JULI"; break;
									case '08': $namabulan = "AGUSTUS"; break;
  								case '09': $namabulan = "SEPTEMBER"; break;
  								case '10': $namabulan = "OKTOBER"; break;
									case '11': $namabulan = "NOVEMBER"; break;
									case '12': $namabulan = "DESEMBER"; break;
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
<body>


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
	}
	else if ($kdbank=='BNI'){
		$selbank1="";
		$selbank2="selected";
		$selbank3="";
		$selbank4="";
		$selbank5="";
		$selbank6="";
		$selbank7="";
	}	
	else if ($kdbank=='POS'){
		$selbank1="";
		$selbank2="";
		$selbank3="selected";
		$selbank4="";
		$selbank5="";
		$selbank6="";
		$selbank7="";
	}	
	else if ($kdbank=='BRI'){
		$selbank1="";
		$selbank2="";
		$selbank3="";
		$selbank4="selected";
		$selbank5="";
		$selbank6="";
		$selbank7="";
	}
	else if ($kdbank=='BMRI'){
		$selbank1="";
		$selbank2="";
		$selbank3="";
		$selbank4="";
		$selbank5="selected";
		$selbank6="";
		$selbank7="";
	}
	else if ($kdbank=='VBN'){
		$selbank1="";
		$selbank2="";
		$selbank3="";
		$selbank4="";
		$selbank5="";
		$selbank6="selected";
		$selbank7="";
	}
	else if ($kdbank=='BBRI'){
		$selbank1="";
		$selbank2="";
		$selbank3="";
		$selbank4="";
		$selbank5="";
		$selbank6="";
		$selbank7="selected";
	}

?>
  <a class="verdana10blk">Nama Bank</a>
	<select name="kdbank">
	  <option value="MDR" <?=$selbank1;?>>MANDIRI</option>
		<option value="BNI" <?=$selbank2;?>>BNI</option>
		<option value="POS" <?=$selbank3;?>>POS</option>
        <option value="BRI" <?=$selbank4;?>>BRI</option>
        <option value="BMRI" <?=$selbank5;?>>H2H MANDIRI</option>
        <option value="VBN" <?=$selbank6;?>>VA BNI</option>
        <option value="BBRI" <?=$selbank7;?>>H2H BRI</option>
	</select>

	<a class="verdana10blk">Pilih Periode</a>
	<select name="periodedari">
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
	<input type="submit" name="submit" value="Cari">
</form>

<?
if ($submit){
?>

<br />
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
		$namalike='BRI';
	}
	else if ($kdbank=='POS') {
		$namabank='VIA PT. POS INDONESIA (POS)';
		$namalike='POS';
	}
	else if ($kdbank=='BMRI') {
		$namabank='H2H BANK MANDIRI';
		$namalike='BMRI';
	}
	else if ($kdbank=='BBRI') {
		$namabank='H2H BANK BRI';
		$namalike='BBRI';
	}
	else if ($kdbank=='VBN') {
		$namabank='VIRTUAL ACCOUNT BNI';
		$namalike='VBN';
	}
?>
<b>PEMBUKUAN PREMI <?=$namabank;?> <br />BULAN <?=$namabulan." ".$year;?> 
PERIODE <?=$periode=="" ? "1" : $periode;?><br />
<?=$KTR->namakantor;?> </b>
</div>
<br />
<hr size="1">
<!--------------  start Rupiah --------------->
<table width="600">
<? 
if($kdbank=="BMRI" || $kdbank=="BBRI") {
	$sql="SELECT   d.kdrekeninglawan,
				   (SELECT   nama
					  FROM   $DBUser.tabel_802_kodeakun
					 WHERE   akun = d.kdrekeninglawan)
					  namaakun,
				   (SELECT   nama
					  FROM   $DBUser.tabel_802_kodeakun
					 WHERE   akun = '148091000')
					  namaakunperantara,
				   (SELECT   nama
					  FROM   $DBUser.tabel_802_kodeakun
					 WHERE   akun = '553000')
					  namaakunpotongan,
				   (SELECT   nama
					  FROM   $DBUser.tabel_802_kodeakun
					 WHERE   akun = '604000')
					  namaakunmatre,
				   e.kdcabas,
				   SUM (d.premitagihan) AS premitagihan,
				   SUM (TO_NUMBER (a.bill_amount)) AS jmlpremi,
				   0 matere,
				   0 diskon
			FROM   $DBUser.tabel_300_historis_premi d,
				   $DBUser.tabel_200_pertanggungan b,
				   $DBUser.tabel_315_pelunasan_h2h a,
				   $DBUser.tabel_500_penagih c,
				   $DBUser.tabel_202_produk e
		   WHERE       b.prefixpertanggungan = SUBSTR (a.no_polis, 1, 2)
				   AND b.nopertanggungan = SUBSTR (a.no_polis, 3, 9)
				   AND b.prefixpertanggungan = d.prefixpertanggungan
				   AND b.nopertanggungan = d.nopertanggungan
				   AND SUBSTR (b.kdproduk, 1, 3) in ('JL2', 'JL3')
				   AND a.tgl_booked = d.tglbooked
				   AND b.nopenagih = c.nopenagih
				   AND a.void = '0'
				   AND b.kdvaluta = '1'
				   AND TO_CHAR (a.entry_time, 'YYYYMMdd') BETWEEN '$tglawaldari' and  '$tglakhirsampai'
				   AND c.kdrayonpenagih = '$kantor'
				   AND b.kdproduk = e.kdproduk
				   AND a.company_code = '".$kdbank."'
		GROUP BY   d.kdrekeninglawan, e.kdcabas";
	}
else if($kdbank=="VBN") {
	$sql= "select ".
              "d.kdrekeninglawan,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun=d.kdrekeninglawan) namaakun,".
							"(select nama from $DBUser.tabel_802_kodeakun where akun='148090000') namaakunperantara,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='553000') namaakunpotongan,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='604000') namaakunmatre,".
              "e.kdcabas, ".
              "sum(d.premitagihan) as premitagihan,".
              "sum(to_number(a.jumlahtagihan)/100) as jmlpremi,".
              "sum((select nilaimeterai from $DBUser.tabel_999_batas_materai where to_number(a.jumlahtagihan)/100 between batasbawahpremi and ".
              "batasataspremi )) as matere, ".
              "sum(decode(to_char(d.tglbayar,'MM/YYYY'),to_char(a.tglbooked,'MM/YYYY'),d.premitagihan*0.01,0) ) as diskon ".
           "from ".
					 		"$DBUser.tabel_300_historis_premi d,".
							"$DBUser.tabel_200_pertanggungan b,".
							"$DBUser.tabel_315_pelunasan_va a,".
							"$DBUser.tabel_500_penagih c, ".
					    "$DBUser.tabel_202_produk e ".
					    //"$DBUser.tabel_803_kode_rekening e ".
					  "where b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
              "b.nopertanggungan=substr(a.nopolis,3,9) and ".
              "b.prefixpertanggungan=d.prefixpertanggungan and ".
              "b.nopertanggungan=d.nopertanggungan and ".
			  " SUBSTR (b.kdproduk, 1, 3) in ('JL2', 'JL3') and ".
              "a.tglbooked=d.tglbooked and ".
              "b.nopenagih=c.nopenagih and ".
              "a.statuspembayaran='2' and ".
              "b.kdvaluta='1' and ".
              //"to_char(a.tglupdated,'MMYYYY')='$bulancari' and ".
			  "to_char(a.tglrekam,'YYYYMMDD') between '$tglawaldari' and  '$tglakhirsampai' and ".
              "c.kdrayonpenagih='$kantor' and ".
              //"e.rekening2=d.kdrekeninglawan ".
							"b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' ".
           "group by d.kdrekeninglawan,e.kdcabas";
	} 
else {
  	$sql = "select ".
              "d.kdrekeninglawan,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun=d.kdrekeninglawan) namaakun,".
							"(select nama from $DBUser.tabel_802_kodeakun where akun='148090000') namaakunperantara,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='553000') namaakunpotongan,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='604000') namaakunmatre,".
              "e.kdcabas, ".
              "sum(d.premitagihan) as premitagihan,".
              "sum(to_number(a.jumlahtagihan)/100) as jmlpremi,".
              "sum((select nilaimeterai from $DBUser.tabel_999_batas_materai where to_number(a.jumlahtagihan)/100 between batasbawahpremi and ".
              "batasataspremi )) as matere, ".
              "sum(decode(to_char(d.tglbayar,'MM/YYYY'),to_char(a.tglbooked,'MM/YYYY'),d.premitagihan*0.01,0) ) as diskon ".
           "from ".
					 		"$DBUser.tabel_300_historis_premi d,".
							"$DBUser.tabel_200_pertanggungan b,".
							"$DBUser.tabel_315_pelunasan_auto_debet a,".
							"$DBUser.tabel_500_penagih c, ".
					    "$DBUser.tabel_202_produk e ".
					    //"$DBUser.tabel_803_kode_rekening e ".
					  "where b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
              "b.nopertanggungan=substr(a.nopolis,3,9) and ".
              "b.prefixpertanggungan=d.prefixpertanggungan and ".
              "b.nopertanggungan=d.nopertanggungan and ".
			  " SUBSTR (b.kdproduk, 1, 3) in ('JL2', 'JL3') and ".
              "a.tglbooked=d.tglbooked and ".
              "b.nopenagih=c.nopenagih and ".
              "a.statuspembayaran='2' and ".
              "b.kdvaluta='1' and ".
              //"to_char(a.tglupdated,'MMYYYY')='$bulancari' and ".
			  "to_char(a.tglrekam,'YYYYMMDD') between '$tglawaldari' and  '$tglakhirsampai' and ".
              "c.kdrayonpenagih='$kantor' and ".
              //"e.rekening2=d.kdrekeninglawan ".
							"b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' ".
			"group by d.kdrekeninglawan,e.kdcabas ".
			" union ".
		   "select ".
              "d.kdrekeninglawan,".
              "NVL((select nama from $DBUser.tabel_802_kodeakun where akun=d.kdrekeninglawan),'Piutang Premi Rider') namaakun,".
							"(select nama from $DBUser.tabel_802_kodeakun where akun='148090000') namaakunperantara,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='553000') namaakunpotongan,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='604000') namaakunmatre,".
              "e.kdcabas, ".
              "sum(d.premitagihan) as premitagihan,".
              "sum(to_number(a.jumlahtagihan)/100) as jmlpremi,".
              "0 as matere, ".
              "0 as diskon ".
           "from ".
					 		"$DBUser.tabel_300_historis_rider d,".
							"$DBUser.tabel_200_pertanggungan b,".
							"$DBUser.tabel_315_pelunasan_auto_debet a,".
							"$DBUser.tabel_500_penagih c, ".
					    "$DBUser.tabel_202_produk e ".
					    //"$DBUser.tabel_803_kode_rekening e ".
					  "where b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
              "b.nopertanggungan=substr(a.nopolis,3,9) and ".
              "b.prefixpertanggungan=d.prefixpertanggungan and ".
              "b.nopertanggungan=d.nopertanggungan and ".
				//			"substr(b.kdproduk,1,2)='JL' and ".
			  " SUBSTR (b.kdproduk, 1, 3) in ('JL2', 'JL3') and ".
              "a.tglbooked=d.tglbooked and ".
              "b.nopenagih=c.nopenagih and ".
              "a.statuspembayaran='2' and ".
              "b.kdvaluta='1' and ".
              //"to_char(a.tglupdated,'MMYYYY')='$bulancari' and ".
							"to_char(a.tglrekam,'YYYYMMDD') between '$tglawaldari' and  '$tglakhirsampai' and ".
              "c.kdrayonpenagih='$kantor' and ".
              //"e.rekening2=d.kdrekeninglawan ".
							"b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' ".
           "group by d.kdrekeninglawan,e.kdcabas";}//,e.rekening2";

		//echo $sql."<br /><br />";
	  $DB->parse($sql);
	  $DB->execute();
	
  	$i=1;
		$diskon = 0;
		$matre = 0;
		$premi = 0;
  	while ($arr=$DB->nextrow()) {
			$matre		= $arr["MATERE"];
			$diskon		= $arr["DISKON"];
			$premi		= $arr["JMLPREMI"];
			
			$namaakun		= $arr["NAMAAKUN"];
			$namaakunmatre = $arr["NAMAAKUNMATRE"];
			$namaakunperantara = $arr["NAMAAKUNPERANTARA"];
			$namaakunpotongan = $arr["NAMAAKUNPOTONGAN"];
			
			$norekening = $arr["KDREKENINGLAWAN"];
			$namaakun = $arr["NAMAAKUN"];
			$premitagihan = $arr["PREMITAGIHAN"];
  		?>
    	<tr>
    	 <td>K</td>
    	 <td><?=$norekening;?></td>
    	 <td><?=$namaakun;?></td>
    	 <td align="right"></td>
    	 <td align="right"><?=number_format($premitagihan,2,",",".");?></td>
    	</tr>
    	<?
			$jmlmatre += $matre;
			$jmldiskon += $diskon;
			//$jmlpremi += $premi;
			$jmlpremi += $premitagihan;
	  }
  	?>

<!----------------end valuta rupiah ------------>

<!--------------  start Rupiah dengan index --------------->
<? 
  	$sql = "select ".
              "d.kdrekeninglawan,".
//			  "b.indexawal,".
							//"to_char(a.tglbooked,'MM/YYYY') as blntagihan,".
							//"to_char(d.tglbayar,'MM/YYYY') as blnbayar,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun=d.kdrekeninglawan) namaakun,".
							"(select nama from $DBUser.tabel_802_kodeakun where akun='148090000') namaakunperantara,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='553000') namaakunpotongan,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='604000') namaakunmatre,".
							"(select kurs from $DBUser.tabel_999_kurs_transaksi where tglkursberlaku=".
                  "(select max(tglkursberlaku) from $DBUser.tabel_999_kurs_transaksi ".
                  "where tglkursberlaku<=a.tglrekam and kdvaluta='0') and kdvaluta='0' ) kurs,". 
							"(select kurs from $DBUser.tabel_999_kurs where tglkursberlaku=".
                  "(select max(tglkursberlaku) from $DBUser.tabel_999_kurs ".
                  "where tglkursberlaku<=a.tglrekam and kdvaluta='0') and kdvaluta='0' ) kursstd,".
              "e.kdcabas, ".
              "sum(d.premitagihan) as premitagihan,".
							"sum((d.premitagihan/b.indexawal)) as premihitungan,".
							
              "sum(to_number(a.jumlahtagihan)/100) as jmlpremi,".
              "sum((select nilaimeterai from $DBUser.tabel_999_batas_materai where to_number(a.jumlahtagihan)/100 between batasbawahpremi and ".
              "batasataspremi )) as matere, ".
              "sum(decode(to_char(d.tglbayar,'MM/YYYY'),to_char(a.tglbooked,'MM/YYYY'),".
							// "d.premitagihan*0.01".
							"round((d.premitagihan/ b.indexawal),2) * 0.01 * ".
                      "(SELECT kurs ".
                      "FROM $DBUser.tabel_999_kurs_transaksi ".
                      "WHERE tglkursberlaku = ".
                              "(SELECT MAX (tglkursberlaku) ".
                                 "FROM $DBUser.tabel_999_kurs_transaksi ".
                                 "WHERE tglkursberlaku <= a.tglrekam ".
                                  "AND kdvaluta = '0') ".
            										  "AND kdvaluta = '0') ".
							 ",0) ) as diskon ".
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
			  " SUBSTR (b.kdproduk, 1, 3) in ('JL2', 'JL3') and ".
              "a.tglbooked=d.tglbooked and ".
              "b.nopenagih=c.nopenagih and ".
              "a.statuspembayaran='2' and ".
              "b.kdvaluta='0' and ".
              //"to_char(a.tglupdated,'MMYYYY')='$bulancari' and ".
			  "to_char(a.tglrekam,'YYYYMMDD') between '$tglawaldari' and  '$tglakhirsampai' and ".
              "c.kdrayonpenagih='$kantor' and ".
              //"e.rekening2=d.kdrekeninglawan ".
							"b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' ".
           "group by d.kdrekeninglawan,e.kdcabas,a.tglrekam ";

		//echo $sql."<br /><br />";
	  $DB->parse($sql);
	  $DB->execute();
	
  	$i=1;
		$diskon_di = 0;
		$matre_di  = 0;
		$premi_di  = 0;
  	while ($arr=$DB->nextrow()) {
			$matre_di		= $arr["MATERE"];
			//$diskon_di	= $arr["DISKON"];
			$premi_di		= $arr["JMLPREMI"];
			
			$namaakun_di		= $arr["NAMAAKUN"];
			$namaakunmatre_di = $arr["NAMAAKUNMATRE"];
			$namaakunperantara_di = $arr["NAMAAKUNPERANTARA"];
			$namaakunpotongan_di = $arr["NAMAAKUNPOTONGAN"];
			
			$norekening_di = $arr["KDREKENINGLAWAN"];
			$namaakun_di = $arr["NAMAAKUN"];
			//$premitagihan_di = $arr["PREMITAGIHAN"];
			$premihit_id = number_format($arr["PREMIHITUNGAN"],2);
			$kurs_idstd	= number_format($arr["KURSSTD"],2);
			$kurs_idbkl	= number_format($arr["KURS"],2);
			//$premitagihan_di = $arr["PREMIHITUNGAN"]*$arr["KURSSTD"];
			//$premitagihan_di2 = $arr["PREMIHITUNGAN"]*$arr["KURS"];
			
			$premitagihan_di = round($arr["PREMIHITUNGAN"],2)*round($arr["KURSSTD"],2);
			$premitagihan_di2 = round($arr["PREMIHITUNGAN"],2)*round($arr["KURS"],2);
			
			//round(1.95583, 2)
			$indexberlaku = $arr["KURS"];
			$indexstd = $arr["KURSSTD"];
			
			//$diskon_di = round($arr["PREMITAGIHAN"]/$arr["INDEXAWAL"],2) * 0.01 * $arr["KURS"];
			$diskon_di = $arr["DISKON"];
  		?>
    	<tr>
    	 <td>K <?=$kurs_id;?></td>
    	 <td><?=$norekening_di;?></td>
    	 <td><?=$namaakun_di;?></td>
    	 <td align="right"></td>
    	 <td align="right"><?=number_format($premitagihan_di,2);?></td>
    	</tr>
    	<?
			$jmlmatre_di += $matre_di;
			$jmldiskon_di += $diskon_di;
			$jmlpremi_di += $premi_di;
			$totpremistd_di +=$premitagihan_di;
			$totpremibkl_di +=$premitagihan_di2;
	  }
  	?>
	<!--------------  start valuta asing --------------->
	<? 
  	$sql = "select ".
              "d.kdrekeninglawan,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun=d.kdrekeninglawan) namaakun,".
							"(select nama from $DBUser.tabel_802_kodeakun where akun='148090000') namaakunperantara,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='553000') namaakunpotongan,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='604000') namaakunmatre,".
							"(select kurs from $DBUser.tabel_999_kurs_transaksi where tglkursberlaku=".
                  "(select max(tglkursberlaku) from $DBUser.tabel_999_kurs_transaksi ".
                  "where tglkursberlaku<=a.tglrekam and kdvaluta='3') and kdvaluta='3' ) kurs,". 
							"(select kurs from $DBUser.tabel_999_kurs where tglkursberlaku=".
                  "(select max(tglkursberlaku) from $DBUser.tabel_999_kurs ".
                  "where tglkursberlaku<=a.tglrekam and kdvaluta='3') and kdvaluta='3' ) kursstd,". 
              "e.kdcabas, ".
              "sum(d.premitagihan) as premitagihan,".
							//"sum((d.premitagihan/b.indexawal)) as premihitungan,".
              "sum(to_number(a.jumlahtagihan)/100) as jmlpremi,".
              "sum((select nilaimeterai from $DBUser.tabel_999_batas_materai where to_number(a.jumlahtagihan)/100 between batasbawahpremi and ".
              "batasataspremi )) as matere, ".
              "sum(decode(to_char(d.tglbayar,'MM/YYYY'),to_char(a.tglbooked,'MM/YYYY'),d.premitagihan*0.01,0) ) as diskon ".
           "from $DBUser.tabel_300_historis_premi d,$DBUser.tabel_200_pertanggungan b,$DBUser.tabel_315_pelunasan_auto_debet a,$DBUser.tabel_500_penagih c, ".
					    "$DBUser.tabel_202_produk e where b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
              "b.nopertanggungan=substr(a.nopolis,3,9) and ".
              "b.prefixpertanggungan=d.prefixpertanggungan and ".
              "b.nopertanggungan=d.nopertanggungan and ".
              "a.tglbooked=d.tglbooked and ".
              "b.nopenagih=c.nopenagih and ".
              "a.statuspembayaran='2' and ".
              "b.kdvaluta='3' and ".
              //"to_char(a.tglupdated,'MMYYYY')='$bulancari' and ".
			  "to_char(a.tglrekam,'YYYYMMDD') between '$tglawaldari' and  '$tglakhirsampai' and ".
              "c.kdrayonpenagih='$kantor' and ".
              //"e.rekening2=d.kdrekeninglawan ".
							"b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' ".
           "group by d.kdrekeninglawan,e.kdcabas,a.tglrekam";

		//echo $sql."<br /><br />";
		//die;
	  $DB->parse($sql);
	  $DB->execute();
	
  	$i=1;
		$diskon_va = 0;
		$matre_va  = 0;
		$premi_va  = 0;
  	while ($arr=$DB->nextrow()) {
			$matre_va		= $arr["MATERE"];
			//$diskon_va	= $arr["DISKON"];
			$diskon_va	= $arr["DISKON"]*$arr["KURS"];
			$premi_va		= $arr["JMLPREMI"];
			$kursstd		= $arr["KURSSTD"];
			$namaakun_va		= $arr["NAMAAKUN"];
			$namaakunmatre_va = $arr["NAMAAKUNMATRE"];
			$namaakunperantara_va = $arr["NAMAAKUNPERANTARA"];
			$namaakunpotongan_va = $arr["NAMAAKUNPOTONGAN"];
			
			$norekening_va = $arr["KDREKENINGLAWAN"];
			$namaakun_va = $arr["NAMAAKUN"];
			//$premitagihan_va = $arr["PREMITAGIHAN"];
			//$premitagihan_va = $arr["PREMIHITUNGAN"];
			$premitagihan_va = $arr["PREMITAGIHAN"]*$arr["KURSSTD"];
			$premitagihan_va2 = $arr["PREMITAGIHAN"]*$arr["KURS"];
			$kursberlaku = $arr["KURS"];
  		?>
    	<tr>
    	 <td>K</td>
    	 <td><?=$norekening_va;?></td>
    	 <td><?=$namaakun_va;?></td>
    	 <td align="right"></td>
    	 <td align="right"><?=number_format($premitagihan_va,2,",",".");?>  </td>
    	</tr>
    	<?
			$totpremistd +=$premitagihan_va;
			$totpremibkl +=$premitagihan_va2;
			
			$jmlmatre_va += $matre_va;
			$jmldiskon_va += $diskon_va;
			$jmlpremi_va += $premi_va;
	  }
  	?>
  <!---------- summary  -------->
	  <?
		if($kdbank=="BMRI" || $kdbank=="BBRI") {
		$sql = "select 148091000 akun,(select nama from $DBUser.tabel_802_kodeakun where akun='148091000') namaakunperantara,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='553000') namaakunpotongan,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='604000') namaakunmatre,".
            	"(select nama from $DBUser.tabel_802_kodeakun where akun='931000') selisihbedaindek ".
            "from $DBUser.tabel_802_kodeakun where akun in('148091000')";} 
		else 
		{$sql = "select 148090000 akun, (select nama from $DBUser.tabel_802_kodeakun where akun='148090000') namaakunperantara,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='553000') namaakunpotongan,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='604000') namaakunmatre,".
            	"(select nama from $DBUser.tabel_802_kodeakun where akun='931000') selisihbedaindek ".
            "from $DBUser.tabel_802_kodeakun where akun in('148090000')";}
		$DB->parse($sql);
	  $DB->execute();
		$akk=$DB->nextrow();
		$selisihbedaindek = $akk["SELISIHBEDAINDEK"];
		$namaakunperantara = $akk["NAMAAKUNPERANTARA"];
		$namaakunpotongan = $akk["NAMAAKUNPOTONGAN"];
		$namaakunmatre = $akk["NAMAAKUNMATRE"];
		$akunperantara = $akk["AKUN"];
		
		if($totpremibkl > $totpremistd)
		{
		  $nilaiselisihK = number_format($totpremibkl-$totpremistd,2,",",".");
			$nilaiselisihD = ""; 
			$notasi				= "K";
		}
		else
		{
		  $nilaiselisihD = number_format($totpremistd-$totpremibkl,2,",",".");
			$nilaiselisihK = "";
			$notasi				= "D";
		}
		if($kursstd!=$kursberlaku)
		{
		?>
		<tr>
  	 <td><?=$notasi;?></td>
  	 <td>710500000</td>
  	 <td>Sel.Kurs Premi PP OB</td>
  	 <td align="right"><?=$nilaiselisihD;?></td>
  	 <td align="right"><?=$nilaiselisihK;?></td>
  	</tr>
		<? 
		}
		if($totpremibkl_di > $totpremistd_di)
		{
		  $nilaiselisihK_di = number_format($totpremibkl_di-$totpremistd_di,2,",",".");
			$nilaiselisihD_di = ""; 
			$notasi_di				= "K";
		}
		else
		{
		  $nilaiselisihD_di = number_format($totpremistd_di-$totpremibkl_di,2,",",".");
			$nilaiselisihK_di = "";
			$notasi_di				= "D";
		}
		if($indexberlaku!=$indexstd)
		{
		?>
		<tr>
  	 <td><?=$notasi_di;?></td>
  	 <td>931000</td>
  	 <td><?=$selisihbedaindek;?></td>
  	 <td align="right"><?=$nilaiselisihD_di;?></td>
  	 <td align="right"><?=$nilaiselisihK_di;?></td>
  	</tr>
	  <? 
		}
		?>
		<tr>
  	 <td>D</td>
<!--  	 <td>272007</td>-->
  	 <td><?=$akunperantara?></td>
  	 <td><?=$namaakunperantara;?></td>
  	 <td align="right"><?=number_format($jmlpremi,2,",",".");?></td><? //echo $jmlpremix+$jmlpremi_di+$jmlpremi_va;?>
  	 <td align="right"></td>
  	</tr>
<!--
		<tr>
  	 <td>D</td>
  	 <td>553000</td>
  	 <td><?=$namaakunpotongan;?></td>
  	 <td align="right"><?=number_format($jmldiskon+$jmldiskon_di+$jmldiskon_va,2,",",".");?></td>
  	 <td align="right"></td>
  	</tr>
-->
		<? 
		if($jmlmatre+$jmlmatre_di+$jmlmatre_va>0)
		{
		?>
<!--
		<tr>
  	 <td>K</td>
  	 <td>604000</td>
  	 <td><?=$namaakunmatre;?></td>
  	 <td></td>
  	 <td align="right"><?=number_format($jmlmatre+$jmlmatre_di+$jmlmatre_va,2,",",".");?></td>
  	</tr>
-->
		<? 
		}
		?>
		<tr>
  	 <td colspan="2">&nbsp;</td>
  	 <td colspan="3">&nbsp;</td>
  	</tr>		
		<? 
		if(!empty($indexstd))
		{
		?>
		<tr>
  	 <td colspan="2">Indeks Standar</td>
  	 <td colspan="3">: <?=number_format($indexstd,2,",",".");?></td>
  	</tr>
		<? 
		}
		if(!empty($indexberlaku))
		{
		?>
		<tr>
  	 <td colspan="2">Indeks Berlaku</td>
  	 <td colspan="3">: <?=number_format($indexberlaku,2,",",".");?></td>
  	</tr>
		<? 
		}
		if(!empty($kursstd))
		{
		?>
		<tr>
  	 <td colspan="2">Kurs Standar</td>
  	 <td colspan="3">: <?=number_format($kursstd,2,",",".");?></td>
  	</tr>
		<? 
		}
		if(!empty($kursberlaku))
		{
		?>
		<tr>
  	 <td colspan="2">Kurs Berlaku</td>
  	 <td colspan="3">: <?=number_format($kursberlaku,2,",",".");?></td>
  	</tr>
		<? } ?>
	</table>
<!----------------end valuta asing------------>
<? 
}
echo "<hr size=1>";
echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a>";
echo("<font face=Verdana size=1>&nbsp;&nbsp;|&nbsp;&nbsp;</font>");
echo("<font face=Verdana size=1><a href=\"#\" onclick=\"window.open('../akunting/cetakslip_pindahbuku_autodebetlink.php?tglawaldari=".$tglawaldari."&tglakhirsampai=".$tglakhirsampai."&kdbank=".$kdbank."&periode=".$periode."&month=".$month."&year=".$year."','','width=800,height=600,top=100,left=100,scrollbars=yes');\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak SLIP</a></font>");
?>

</body>
</html>