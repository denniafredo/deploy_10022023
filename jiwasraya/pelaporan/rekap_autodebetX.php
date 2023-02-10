<? 
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
	include "../../includes/kantor.php";
	//include "../../includes/komisiagen.php";
	
  $DB=new database($userid, $passwd, $DBName);
	$KTR=new Kantor($userid,$passwd,$kantor);
	
	function ShowFromDate($year_interval,$YearIntervalType) {
  GLOBAL $day,$month,$year;

  //MONTH
  echo "<select name=month>\n";
  $i=1;
  $CurrMonth=date("m");
  while ($i <= 12)
       {
  		 				switch($i)
  						{
  							  case 1: $namabulan = "JANUARI"; break;
  								case 2: $namabulan = "PEBRUARI"; break;
									case 3: $namabulan = "MARET"; break;
									case 4: $namabulan = "APRIL"; break;
									case 5: $namabulan = "MEI"; break;
									case 6: $namabulan = "JUNI"; break;
									case 7: $namabulan = "JULI"; break;
									case 8: $namabulan = "AGUSTUS"; break;
  								case 9: $namabulan = "SEPTEMBER"; break;
  								case 10: $namabulan = "OKTOBER"; break;
									case 11: $namabulan = "NOVEMBER"; break;
									case 12: $namabulan = "DESEMBER"; break;
  								default : $namabulan = $i;
  						}
  		 
        If(IsSet($month)) {
           If($month == $i || ($i == substr($month,1,1) && (substr($month,0,1) == 0))) {
              $n = (strlen($i)==1) ? "0$i" : "$i";
							echo "<option value=$n selected>$namabulan\n";
              $i++;
           }Else{
  						If($i<10) {
                 echo "<option value=0$i>$namabulan\n";
              }Else {
                 echo "<option value=$i>$namabulan\n";
              }
              $i++;
           }
        }Else {
              If($i == $CurrMonth) {
                If($i<10) {
                   echo "<option value=0$i selected>$namabulan\n";
                }Else {
                   echo "<option value=$i selected>$namabulan\n";
                }
              }Else {
                If($i<10){
                   echo "<option value=0$i>$namabulan\n";
  							}Else {
                   echo "<option value=$i>$namabulan\n";
                }
              }
              $i++;
        }
  }
    echo "</select>\n";
  
  //YEAR
    echo "<select name=year>\n";
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
	
	if(isset($month))
	{
	  $bulancari = $month.$year;
	}
	else
	{
	  $month=date("m");
		$year=date("Y");
	  $bulancari = $month.$year;
	}

	switch($periode)
	{
	  case '1' : $tglstart="01"; $tglend="10"; $s1="selected"; break; 
		case '2' : $tglstart="11"; $tglend="20"; $s2="selected"; break;
		case '3' : $tglstart="21"; $tglend="31"; $s3="selected"; break;  
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
  <a class="verdana10blk">Pilih Periode</a>
	<select name="periode">
	  <option value="1" <?=$s1;?>>I</option>
		<option value="2" <?=$s2;?>>II</option>
		<option value="3" <?=$s3;?>>III</option>
	</select>
  <a class="verdana10blk">Bulan</a> 
  <?  ShowFromDate(10,"Past"); ?>
	<input type="submit" name="submit" value="Cari"<
</form>
<br />
<br />
<div align="center">
<b>REKAPITULASI HASIL PREMI AUTO DEBET BANK MANDIRI <br /> 
PERIODE <?=$periode=="" ? "1" : $periode;?> <?=$namabulan." ".$year;?><br />SECARA NASIONAL</b><br><br>
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
            "b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ". 
            "b.nopenagih=c.nopenagih and a.statuspembayaran='2' and ".
//						"b.kdvaluta='1' and ". 
						"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
						"b.kdproduk=e.kdproduk and a.kdbank='MDR' order by c.kdrayonpenagih";
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
           "from $DBUser.tabel_300_historis_premi d,$DBUser.tabel_200_pertanggungan b,$DBUser.tabel_315_pelunasan_auto_debet a,$DBUser.tabel_500_penagih c, ".
					    "$DBUser.tabel_202_produk e, $DBUser.tabel_001_kantor f ".
					  "where b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
              "b.nopertanggungan=substr(a.nopolis,3,9) and ".
              "b.prefixpertanggungan=d.prefixpertanggungan and ".
              "b.nopertanggungan=d.nopertanggungan and ".
              "a.tglbooked=d.tglbooked and ".
              "b.nopenagih=c.nopenagih and ".
              "a.statuspembayaran='2' and ".
//              "b.kdvaluta='1' and ".
							"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
              "c.kdrayonpenagih=f.kdkantor and ".
              "c.kdrayonpenagih='$kdrayonpenagih' and ".
							"b.kdproduk=e.kdproduk and a.kdbank='MDR' ".
           "group by c.kdrayonpenagih,f.namakantor";

		//echo $sql."<br /><br />";
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