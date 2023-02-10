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
 font-size: 10px;
 font-family: verdana;
 } 
-->
</style>
</head>
<body>

<form name="getpremi" action="<?=$PHP_SELF;?>" action="post">
  <a class="verdana10blk">Pilih Bulan</a> 
  <?  ShowFromDate(10,"Past"); ?>
	<input type="submit" name="submit" value="Cari"<
</form>
<br />
<div align="center">
<b>HASIL AUTO DEBET BANK MANDIRI <br />BULAN <?=$namabulan." ".$year;?><br /><?=$KTR->namakantor;?> </b>
</div>
<br /><br />
<!--------------  start Rupiah --------------->
Pembukaan pelunasan premi Auto Debet Valuta Rupiah Tanpa Index (VRTI)  <br /><br />
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
              "to_char(a.tglupdated,'MMYYYY')='$bulancari' and ".
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
  	<tr>
  	 <td>D</td>
  	 <td>272007</td>
  	 <td><?=$namaakunperantara;?></td>
  	 <td align="right"><?=number_format($jmlpremi,2,",",".");?></td>
  	 <td align="right"></td>
  	</tr>
  	<? 
  	if($jmldiskon!=0)
  	{
  	?>
  	<tr>
  	 <td>D</td>
  	 <td>553000</td>
  	 <td><?=$namaakunpotongan;?></td>
  	 <td align="right"><?=number_format($jmldiskon,2,",",".");?></td>
  	 <td align="right"></td>
  	</tr>
  	<? 
  	}
  	if($jmlmatre!=0)
  	{
  	?>
  	<tr>
  	 <td>K</td>
  	 <td>604000</td>
  	 <td><?=$namaakunmatre;?></td>
  	 <td></td>
  	 <td align="right"><?=number_format($jmlmatre,2,",",".");?></td>
  	</tr>
  	<? 
  	}
		 echo "<tr><td colspan=5><hr size=1></td></tr>";
  	 $prevkdcabas = $cabas;
  	?>
  </table>
<!----------------end valuta rupiah ------------>


<br />
<!--------------  start Rupiah dengan index --------------->
Pembukaan pelunasan premi Auto Debet Valuta Rupiah Dengan Index (VRDI)  <br />
<table width="600">
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
              "to_char(a.tglupdated,'MMYYYY')='$bulancari' and ".
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
			$kurs_id	= number_format($arr["KURS"],2);
			$premitagihan_di = $premihit_id*$kurs_id;
			//$premitagihan_di = $arr["PREMIHITUNGAN"]*$arr["KURS"];
			//$premitagihan_di = $arr["JMLPREMI"];
			
			$indexstd = $arr["KURS"];
  		?>
    	<tr>
    	 <td>K</td>
    	 <td><?=$norekening_di;?></td>
    	 <td><?=$namaakun_di;?></td>
    	 <td align="right"></td>
    	 <td align="right"><?=number_format($premitagihan_di,2,",",".");?></td>
    	</tr>
    	<?
			$jmlmatre_di += $matre_di;
			$jmldiskon_di += $diskon_di;
			$jmlpremi_di += $premi_di;
	  }
  	?>
		<? 
		if($namaakunperantara_di!="")
		{
		?>
  	<tr>
  	 <td>D</td>
  	 <td>272007</td>
  	 <td><?=$namaakunperantara_di;?></td>
  	 <td align="right"><?=number_format($jmlpremi_di,2,",",".");?></td>
  	 <td align="right"></td>
  	</tr>
		<? 
		}
		?>
  	<? 
  	if($jmldiskon_di!=0)
  	{
  	?>
  	<tr>
  	 <td>D</td>
  	 <td>553000</td>
  	 <td><?=$namaakunpotongan_di;?></td>
  	 <td align="right"><?=number_format($jmldiskon_di,2,",",".");?></td>
  	 <td align="right"></td>
  	</tr>
  	<? 
  	}
  	if($jmlmatre_di!=0)
  	{
  	?>
  	<tr>
  	 <td>K</td>
  	 <td>604000</td>
  	 <td><?=$namaakunmatre_di;?></td>
  	 <td></td>
  	 <td align="right"><?=number_format($jmlmatre_di,2,",",".");?></td>
  	</tr>
  	<? 
  	}
		echo "<tr><td colspan=5><hr size=1>Indeks Standar : ".number_format($indexstd,2,",",".")."</td></tr>";
  	?>
  </table>
<!----------------end valuta rupiah dengan index------------>

<br />
<!--------------  start Valuta Asing --------------->
Pembukaan pelunasan premi Auto Debet Valuta Asing (VA)  <br />
<table width="600">
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
              "to_char(a.tglupdated,'MMYYYY')='$bulancari' and ".
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
			
			$namaakun_va		= $arr["NAMAAKUN"];
			$namaakunmatre_va = $arr["NAMAAKUNMATRE"];
			$namaakunperantara_va = $arr["NAMAAKUNPERANTARA"];
			$namaakunpotongan_va = $arr["NAMAAKUNPOTONGAN"];
			
			$norekening_va = $arr["KDREKENINGLAWAN"];
			$namaakun_va = $arr["NAMAAKUN"];
			//$premitagihan_va = $arr["PREMITAGIHAN"];
			//$premitagihan_va = $arr["PREMIHITUNGAN"];
			$premitagihan_va = $arr["PREMITAGIHAN"]*$arr["KURS"];
			
			$indexstd = $arr["KURS"];
  		?>
    	<tr>
    	 <td>K</td>
    	 <td><?=$norekening_va;?></td>
    	 <td><?=$namaakun_va;?></td>
    	 <td align="right"></td>
    	 <td align="right"><?=number_format($premitagihan_va,2,",",".");?></td>
    	</tr>
    	<?
			$jmlmatre_va += $matre_va;
			$jmldiskon_va += $diskon_va;
			$jmlpremi_va += $premi_va;
	  }
  	?>
		
  </table>
	
	<table width="600">
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
	</table>
	<?="Indeks Standar : ".number_format($indexstd,2,",",".")."";?>

	
<!----------------end valuta asing------------>
<? 
echo "<hr size=1>";
					 echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a>";
?>
</body>
</html>