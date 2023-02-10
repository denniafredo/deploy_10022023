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
	
	if(isset($month))
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
//	echo "Awal : ".$tglawal." Akhir : ".$tglakhir;
	
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
<div align="center">
<b>PEMBUKUAN PREMI AUTO DEBET BANK MANDIRI <br />BULAN <?=$namabulan." ".$year;?> 
PERIODE <?=$periode=="" ? "1" : $periode;?><br />
<?=$KTR->namakantor;?> </b>
</div>
<br />
<hr size="1">
<!--------------  start Rupiah --------------->
<table width="600">
<? 
  	$sql = "select ".
              "d.kdrekeninglawan,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun=e.rekening2) namaakun,".
							"(select nama from $DBUser.tabel_802_kodeakun where akun='272007') namaakunperantara,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='553000') namaakunpotongan,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='604000') namaakunmatre,".
              "e.kdcabas, ".
              "sum(d.premitagihan) as premitagihan,".
              "sum(to_number(a.jumlahtagihan)/100) as jmlpremi,".
              "sum((select nilaimeterai from $DBUser.tabel_999_batas_materai where to_number(a.jumlahtagihan)/100 between batasbawahpremi and ".
              "batasataspremi )) as matere, ".
              "sum(decode(to_char(d.tglbayar,'MM/YYYY'),to_char(a.tglbooked,'MM/YYYY'),d.premitagihan*0.01,0) ) as diskon ".
           "from $DBUser.tabel_300_historis_premi d,$DBUser.tabel_200_pertanggungan b,$DBUser.tabel_315_pelunasan_auto_debet a,$DBUser.tabel_500_penagih c, $DBUser.tabel_803_kode_rekening e where b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
              "b.nopertanggungan=substr(a.nopolis,3,9) and ".
              "b.prefixpertanggungan=d.prefixpertanggungan and ".
              "b.nopertanggungan=d.nopertanggungan and ".
              "a.tglbooked=d.tglbooked and ".
              "b.nopenagih=c.nopenagih and ".
              "a.statuspembayaran='2' and ".
              "b.kdvaluta='1' and ".
              //"to_char(a.tglupdated,'MMYYYY')='$bulancari' and ".
							"to_char(a.tglupdated,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
              "c.kdrayonpenagih='$kantor' and ".
              "e.rekening2=d.kdrekeninglawan ".
           "group by d.kdrekeninglawan,e.kdcabas,e.rekening2";

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
			$jmlpremi += $premi;
	  }
  	?>

<!----------------end valuta rupiah ------------>

<!--------------  start Rupiah dengan index --------------->
<? 
  	$sql = "select ".
              "d.kdrekeninglawan,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun=e.rekening2) namaakun,".
							"(select nama from $DBUser.tabel_802_kodeakun where akun='272007') namaakunperantara,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='553000') namaakunpotongan,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='604000') namaakunmatre,".
							"(select kurs from $DBUser.tabel_999_kurs_transaksi where tglkursberlaku=".
                  "(select max(tglkursberlaku) from $DBUser.tabel_999_kurs_transaksi ".
                  "where tglkursberlaku<=a.tglupdated and kdvaluta='0') and kdvaluta='0' ) kurs,". 
							"(select kurs from $DBUser.tabel_999_kurs where tglkursberlaku=".
                  "(select max(tglkursberlaku) from $DBUser.tabel_999_kurs ".
                  "where tglkursberlaku<=a.tglupdated and kdvaluta='0') and kdvaluta='0' ) kursstd,".
              "e.kdcabas, ".
              "sum(d.premitagihan) as premitagihan,".
							"sum((d.premitagihan/b.indexawal)) as premihitungan,".
							
              "sum(to_number(a.jumlahtagihan)/100) as jmlpremi,".
              "sum((select nilaimeterai from $DBUser.tabel_999_batas_materai where to_number(a.jumlahtagihan)/100 between batasbawahpremi and ".
              "batasataspremi )) as matere, ".
              "sum(decode(to_char(d.tglbayar,'MM/YYYY'),to_char(a.tglbooked,'MM/YYYY'),d.premitagihan*0.01,0) ) as diskon ".
           "from $DBUser.tabel_300_historis_premi d,$DBUser.tabel_200_pertanggungan b,$DBUser.tabel_315_pelunasan_auto_debet a,$DBUser.tabel_500_penagih c, $DBUser.tabel_803_kode_rekening e where b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
              "b.nopertanggungan=substr(a.nopolis,3,9) and ".
              "b.prefixpertanggungan=d.prefixpertanggungan and ".
              "b.nopertanggungan=d.nopertanggungan and ".
              "a.tglbooked=d.tglbooked and ".
              "b.nopenagih=c.nopenagih and ".
              "a.statuspembayaran='2' and ".
              "b.kdvaluta='0' and ".
              //"to_char(a.tglupdated,'MMYYYY')='$bulancari' and ".
							"to_char(a.tglupdated,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
              "c.kdrayonpenagih='$kantor' and ".
              "e.rekening2=d.kdrekeninglawan ".
           "group by d.kdrekeninglawan,e.kdcabas,e.rekening2,a.tglupdated";

		//echo $sql."<br /><br />";
	  $DB->parse($sql);
	  $DB->execute();
	
  	$i=1;
		$diskon_di = 0;
		$matre_di  = 0;
		$premi_di  = 0;
  	while ($arr=$DB->nextrow()) {
			$matre_di		= $arr["MATERE"];
			$diskon_di	= $arr["DISKON"];
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
			$premitagihan_di = $arr["PREMIHITUNGAN"]*$arr["KURSSTD"];
			$premitagihan_di2 = $arr["PREMIHITUNGAN"]*$arr["KURS"];
			
			$indexberlaku = $arr["KURS"];
			$indexstd = $arr["KURSSTD"];
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
              "(select nama from $DBUser.tabel_802_kodeakun where akun=e.rekening2) namaakun,".
							"(select nama from $DBUser.tabel_802_kodeakun where akun='272007') namaakunperantara,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='553000') namaakunpotongan,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='604000') namaakunmatre,".
							"(select kurs from $DBUser.tabel_999_kurs_transaksi where tglkursberlaku=".
                  "(select max(tglkursberlaku) from $DBUser.tabel_999_kurs_transaksi ".
                  "where tglkursberlaku<=a.tglupdated and kdvaluta='3') and kdvaluta='3' ) kurs,". 
							"(select kurs from $DBUser.tabel_999_kurs where tglkursberlaku=".
                  "(select max(tglkursberlaku) from $DBUser.tabel_999_kurs ".
                  "where tglkursberlaku<=a.tglupdated and kdvaluta='3') and kdvaluta='3' ) kursstd,". 
              "e.kdcabas, ".
              "sum(d.premitagihan) as premitagihan,".
							//"sum((d.premitagihan/b.indexawal)) as premihitungan,".
              "sum(to_number(a.jumlahtagihan)/100) as jmlpremi,".
              "sum((select nilaimeterai from $DBUser.tabel_999_batas_materai where to_number(a.jumlahtagihan)/100 between batasbawahpremi and ".
              "batasataspremi )) as matere, ".
              "sum(decode(to_char(d.tglbayar,'MM/YYYY'),to_char(a.tglbooked,'MM/YYYY'),d.premitagihan*0.01,0) ) as diskon ".
           "from $DBUser.tabel_300_historis_premi d,$DBUser.tabel_200_pertanggungan b,$DBUser.tabel_315_pelunasan_auto_debet a,$DBUser.tabel_500_penagih c, $DBUser.tabel_803_kode_rekening e where b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
              "b.nopertanggungan=substr(a.nopolis,3,9) and ".
              "b.prefixpertanggungan=d.prefixpertanggungan and ".
              "b.nopertanggungan=d.nopertanggungan and ".
              "a.tglbooked=d.tglbooked and ".
              "b.nopenagih=c.nopenagih and ".
              "a.statuspembayaran='2' and ".
              "b.kdvaluta='3' and ".
              //"to_char(a.tglupdated,'MMYYYY')='$bulancari' and ".
							"to_char(a.tglupdated,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
              "c.kdrayonpenagih='$kantor' and ".
              "e.rekening2=d.kdrekeninglawan ".
           "group by d.kdrekeninglawan,e.kdcabas,e.rekening2,a.tglupdated";

		//echo $sql."<br /><br />";
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
    	 <td align="right"><?=number_format($premitagihan_va,2,",",".");?>  <?=//number_format($premitagihan_va2,2,",",".");?></td>
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
  	 <td>930003</td>
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
  	 <td>Sel.Indeks Premi PP OB</td>
  	 <td align="right"><?=$nilaiselisihD_di;?></td>
  	 <td align="right"><?=$nilaiselisihK_di;?></td>
  	</tr>
	  <? 
		}
		?>
		<tr>
  	 <td>D</td>
  	 <td>272007</td>
  	 <td><?=$namaakunperantara_va;?></td>
  	 <td align="right"><?=number_format($jmlpremi+$jmlpremi_di+$jmlpremi_va,2,",",".");?></td>
  	 <td align="right"></td>
  	</tr>
		<tr>
  	 <td>D</td>
  	 <td>553000</td>
  	 <td><?=$namaakunpotongan_va;?></td>
  	 <td align="right"><?=number_format($jmldiskon+$jmldiskon_di+$jmldiskon_va,2,",",".");?></td>
  	 <td align="right"></td>
  	</tr>
		<tr>
  	 <td>K</td>
  	 <td>604000</td>
  	 <td><?=$namaakunmatre_va;?></td>
  	 <td></td>
  	 <td align="right"><?=number_format($jmlmatre+$jmlmatre_di+$jmlmatre_va,2,",",".");?></td>
  	</tr>
		<tr>
  	 <td colspan="2">Indeks Standar</td>
  	 <td colspan="3">: <?=number_format($indexstd,2,",",".");?></td>
  	</tr>
		<tr>
  	 <td colspan="2">Indeks Berlaku</td>
  	 <td colspan="3">: <?=number_format($indexberlaku,2,",",".");?></td>
  	</tr>
		<tr>
  	 <td colspan="2">Kurs Standar</td>
  	 <td colspan="3">: <?=number_format($kursstd,2,",",".");?></td>
  	</tr>
		<tr>
  	 <td colspan="2">Kurs Berlaku</td>
  	 <td colspan="3">: <?=number_format($kursberlaku,2,",",".");?></td>
  	</tr>
	</table>
<!----------------end valuta asing------------>
<? 
echo "<hr size=1>";
					 echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a>";
?>
</body>
</html>