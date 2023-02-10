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

	switch($periodedari)
	{
	  case '1' : $tglstartdari="01"; $tglenddari="10"; $s1="selected"; break; 
		case '2' : $tglstartdari="11"; $tglenddari="20"; $s2="selected"; break;
		case '3' : $tglstartdari="21"; $tglenddari="31"; $s3="selected"; break;  
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
		$tglawaldari	 = $yeardari.$monthdari.$tglstartdari;
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

	switch($periodesampai)
	{
	  case '1' : $tglstartsampai="01"; $tglendsampai="10"; $s1="selected"; break; 
		case '2' : $tglstartsampai="11"; $tglendsampai="20"; $s2="selected"; break;
		case '3' : $tglstartsampai="21"; $tglendsampai="31"; $s3="selected"; break;  
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
		$tglakhirsampai	 = $yearsampai.$monthsampai.$tglendsampai;
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
<body>

<form name="getpremi" action="<?=$PHP_SELF;?>" action="post">
  <a class="verdana10blk">Pilih Periode</a>
	<select name="periodedari">
	  <option value="1" <?=$s1;?>>I</option>
		<option value="2" <?=$s2;?>>II</option>
		<option value="3" <?=$s3;?>>III</option>
	</select>
  <a class="verdana10blk">Bulan</a> 
  <?  ShowFromDate(10,"Past"); ?>
  <a class="verdana10blk"> s/d Periode </a> 
	<select name="periodesampai">
	  <option value="1" <?=$s1;?>>I</option>
		<option value="2" <?=$s2;?>>II</option>
		<option value="3" <?=$s3;?>>III</option>
	</select>
  <a class="verdana10blk">Bulan</a> 
  <?  ShowToDate(10,"Past"); ?>
	<input type="submit" name="submit" value="Cari"<
</form>
<br />
<br />
<div align="center">
<b>REKAPITULASI HASIL PREMI AUTO DEBET BANK MANDIRI <br /> 
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
						"substr(b.kdproduk,1,3)<>'JL2' and ".
            "b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ". 
            "b.nopenagih=c.nopenagih and a.statuspembayaran='2' and ".
//						"b.kdvaluta='1' and ". 
						"to_char(a.tglrekam,'YYYYMMDD') between '$tglawaldari' and  '$tglakhirsampai' and ".
						"b.kdproduk=e.kdproduk and a.kdbank='MDR' order by c.kdrayonpenagih";
//		echo $sql;

		$DB->parse($sql);
	  $DB->execute();
  	$arr = $DB->result();	
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
    <b>Total</b></td>
  </tr>
	<tr>
	<? 

	$i=1;
  $total=0;
	foreach ($arr as $foo => $row ) {
		$kdrayonpenagih = $row["KDKANTOR"];
  	$sql = "select ".
              "c.kdrayonpenagih as kodekantor,".
              "f.namakantor as namakantor,".
              "'272007' as kdakun,".
							"(select nama from $DBUser.tabel_802_kodeakun where akun='272007') namaakunperantara,".
              "sum(to_number(a.jumlahtagihan)/100) as jmlpremi ".
           "from ".
					 		"$DBUser.tabel_300_historis_premi d,".
							"$DBUser.tabel_200_pertanggungan b,".
							"$DBUser.tabel_315_pelunasan_auto_debet a,".
							"$DBUser.tabel_500_penagih c, ".
					    "$DBUser.tabel_202_produk e, $DBUser.tabel_001_kantor f ".
					  "where b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
              "b.nopertanggungan=substr(a.nopolis,3,9) and ".
              "b.prefixpertanggungan=d.prefixpertanggungan and ".
              "b.nopertanggungan=d.nopertanggungan and ".
							"substr(b.kdproduk,1,3)<>'JL2' and ".
              "a.tglbooked=d.tglbooked and ".
              "b.nopenagih=c.nopenagih and ".
              "a.statuspembayaran='2' and ".
//              "b.kdvaluta='1' and ".
							"to_char(a.tglrekam,'YYYYMMDD') between '$tglawaldari' and  '$tglakhirsampai' and ".
              "c.kdrayonpenagih=f.kdkantor and ".
              "c.kdrayonpenagih='$kdrayonpenagih' and ".
							"b.kdproduk=e.kdproduk and a.kdbank='MDR' ".
           "group by c.kdrayonpenagih,f.namakantor";

//		echo $sql."<br /><br />";
	  $DB->parse($sql);
	  $DB->execute();
		$arr=$DB->nextrow();	
	?>	

	<tr>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=$i;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"></td>		
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["KDAKUN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"> <?=$arr["KODEKANTOR"];?> - <?=$arr["NAMAKANTOR"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["JMLPREMI"],2,",",".");?></td>
	</tr>
	<? 
  	$total=$total+$arr["JMLPREMI"];

		$i++;
	} 
	?>
	<tr bgcolor="#f5d79c">
	 <td></td>
	 <td colspan="3" align="center"><b>T O T A L</b></td>
	 <td align="right"><?=number_format($total,2,",",".");?></td>
	</tr>
	
</table>	

<hr size=1><a class=verdana10blk href="index.php">Menu Pelaporan</a>
</body>
</html>