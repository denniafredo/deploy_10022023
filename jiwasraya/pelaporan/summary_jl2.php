<? 
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
	include "../../includes/kantor.php";
	
  $DB=new database($userid, $passwd, $DBName);
	$KTR=new Kantor($userid,$passwd,$kantor);
	
	$DB=new database($userid, $passwd, $DBName);
	$DBA=new database($userid, $passwd, $DBName);
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
	
	if($metodebayar=="MDR"){
    	switch($periode)
    	{
    	  case '1' : $tglstart="01"; $tglend="10"; $s1="selected"; break; 
    		case '2' : $tglstart="11"; $tglend="20"; $s2="selected"; break;
    		case '3' : $tglstart="21"; $tglend="31"; $s3="selected"; break;  
    	}
    	
    	if(isset($month))
    	{
    	  $bulancari = $month.$year;
    		$tglawal	 = $year.$month.$tglstart;
    		$tglakhir	 = $year.$month.$tglend;
    	}
    	else
    	{
    	  $month=date("m");
    		$year=date("Y");
    	  $bulancari = $month.$year;
    		$tglawal	 = $year.$month.'01';
    		$tglakhir	 = $year.$month.'10';
    	}
	}
	else
	{
    	if(isset($month))
    	{
    	  $bulancari = $year.$month;
    	}
    	else
    	{
    	  $month=date("m");
    		$year=date("Y");
    	  $bulancari = $year.$month;
    	}
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
body{
 font-family: tahoma,verdana,geneva,sans-serif;
 font-size: 12px;
}

td{
 font-family: tahoma,verdana,geneva,sans-serif;
 font-size: 11px;
} 

input			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-width: .2em;border-width: .2em;color:333333;}
select			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}
textarea		{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}

a { 
  color:#259dc5;  
	text-decoration:none;
}

a:hover { 
	color:#cc6600;  
}

#filterbox{
  border: solid 1px #c0c0c0;
	padding : 5px;
	width:100%;
	margin : 0 0 10px 0;
}
form{
  margin : 0;
	padding : 0;
}
-->
</style>
</head>
<body>
<div id="filterbox">
<form name="getpremi" action="<?=$PHP_SELF;?>" action="post">
  <table>
	<tr>
  <td>Produk</td>
	<td>
	  <? 
		switch($produk)
		{
		  case 'JL2': $ja = "selected"; break;
		  case 'JL3': $jb = "selected"; break;
			default : $ja = "selected"; break;
		}
		?>
	  <select name="produk">
	  <option value="JL2" <?=$ja;?>>JL2</option>
	  <option value="JL3" <?=$jb;?>>JL3</option>
	</select></td>

  <td>Jenis Pembayaran</td>
	<td>
	  <? 
		switch($metodebayar)
		{
		  case 'MDR': $sa = "selected"; break;
			case 'BNI': $sb = "selected"; break;
			case 'CTB': $sc = "selected"; break;
			case 'POS': $sd = "selected"; break;
			case 'THO': $st = "selected"; break;
			default : $sx = "selected"; break;
		}
		?>
	  <select name="metodebayar">
	  <option value="MDR" <?=$sa;?>>Auto Debet Mandiri</option>
	  <option value="BNI" <?=$sb;?>>Auto Debet BNI</option>
		<option value="CTB" <?=$sc;?>>Credit Card Citibank</option>
		<option value="POS" <?=$sd;?>>PT. POS INDONESIA</option>
		<option value="THO" <?=$st;?>>Transfer Tunai Rek. HO</option>
	</select></td>
	
	<td>Kantor</td>
	<td><select name="kdkantor">
  			<?
  			$sqa="select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdjeniskantor='2' ".
  			     		 "order by kdkantor";
  					$DB->parse($sqa);
  					$DB->execute();	
  					while ($arr=$DB->nextrow()) {
  					  echo "<option ";
      					if ($arr["KDKANTOR"]==$kdkantor){ echo " selected"; }
      					echo " value=".$arr["KDKANTOR"].">".$arr["KDKANTOR"]." - ".$arr["NAMAKANTOR"]."</option>";
  					}
  			?>
				<option value="ALL">--ALL--</option>
 </select>
 </td>
 
 <td>Pilih Periode</td>
 <td><select name="periode">
	  <option value="1" <?=$s1;?>>I</option>
		<option value="2" <?=$s2;?>>II</option>
		<option value="3" <?=$s3;?>>III</option>
 </select></td>
	
 <td>Bulan</td> 
 <td><?  ShowFromDate(10,"Past"); ?></td>
 <td colspan="2"><input type="submit" name="submit" value="Cari"</input></td>
 </tr>
</table>
</form>
</div>
<?
if($metodebayar=="MDR"){
	   $filterperiode = "to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "MANDIRI";
		 $titletrans		= "AUTO DEBET MANDIRI";
	} elseif($metodebayar=="BNI"){
	   $filterperiode = "to_char(a.tglrekam,'YYYYMM') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "BNI";
		 $titletrans		= "AUTO DEBET BNI";
	} elseif($metodebayar=="CTB"){
	   $filterperiode = "to_char(a.tglrekam,'YYYYMM') = '$bulancari' and ";
		 $filterpenagih = "CITIBANK";
		 $titletrans		= "CITIBANK 1BILL";
	} elseif($metodebayar=="POS"){
	   $filterperiode = "to_char(a.tglrekam,'YYYYMM') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "POS";
		 $titletrans		= "VIA PT. POS INDONESIA";
	} else {
	   $filterperiode = "to_char(d.tglbooked,'YYYYMM') = '$bulancari' and ";
		 $filterpenagih = "TRANSFER";
		 $titletrans		= "TRANSFER REK. HO";
	}
?>
<b>PEMBUKUAN PREMI JS.LINK (<?=$produk;?>) <?=$titletrans;?><br />BULAN <?=$namabulan." ".$year;?> <?=$KTR->namakantor;?> </b>
<br />
<hr size="1">
<!--------------  start Rupiah --------------->
<table width="600">
<? 
  
	
	if($metodebayar=="MDR" || $metodebayar=="CTB" || $metodebayar=="BNI" || $metodebayar=="POS"){
  	$sql = "select ".
                "d.kdrekeninglawan,".
                "(select nama from $DBUser.tabel_802_kodeakun where akun=d.kdrekeninglawan) namaakun,".
  							//272010
								"(select nama from $DBUser.tabel_802_kodeakun where akun='282021') namaakunperantara,".
                //"(select nama from $DBUser.tabel_802_kodeakun where akun='272010') namaakunperantara,".
                "(select nama from $DBUser.tabel_802_kodeakun where akun='553000') namaakunpotongan,".
                "(select nama from $DBUser.tabel_802_kodeakun where akun='604000') namaakunmatre,".
                "e.kdcabas, ".
                "sum(d.premitagihan) as premitagihan,".
                //"sum(to_number(a.jumlahtagihan)) as jmlpremi,".
								"sum(to_number(d.premitagihan)) as jmlpremi,".
                "sum((select 0 from $DBUser.tabel_999_batas_materai where to_number(a.jumlahtagihan) between batasbawahpremi and ".
                "batasataspremi )) as matere, ".
                "sum(decode(to_char(d.tglbayar,'MM/YYYY'),to_char(a.tglbooked,'MM/YYYY'),d.premitagihan*0.01,0) ) as diskon ".
           "from ".
					 			 "$DBUser.tabel_300_historis_premi d,".
								 "$DBUser.tabel_200_pertanggungan b,".
								 "$DBUser.tabel_315_pelunasan_auto_debet a,".
								 "$DBUser.tabel_500_penagih c, ".
					    	 "$DBUser.tabel_202_produk e ".
					  "where b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
                "b.nopertanggungan=substr(a.nopolis,3,9) and ".
                "b.prefixpertanggungan=d.prefixpertanggungan and ".
                "b.nopertanggungan=d.nopertanggungan and ".
                "a.tglbooked=d.tglbooked and ".
                "b.nopenagih=c.nopenagih and ".
                "a.statuspembayaran='2' and ".
                //"b.kdvaluta='1' and ".
								$filterperiode.
  							//"to_char(a.tglrekam,'YYYYMM') = '$bulancari' and ".
                "c.kdrayonpenagih='$kdkantor' and ".
  							"b.kdproduk=e.kdproduk ".
								"and substr(b.kdproduk,1,3)='".$produk."' ".
								"and a.kdbank='".$metodebayar."' ".
           "group by d.kdrekeninglawan,e.kdcabas";
   }
	 else
	 {
	   $sql = "select ".
                "d.kdrekeninglawan,".
                "(select nama from $DBUser.tabel_802_kodeakun where akun=d.kdrekeninglawan) namaakun,".
  							"(select nama from $DBUser.tabel_802_kodeakun where akun='272010') namaakunperantara,".
                "(select nama from $DBUser.tabel_802_kodeakun where akun='553000') namaakunpotongan,".
                "(select nama from $DBUser.tabel_802_kodeakun where akun='604000') namaakunmatre,".
                "e.kdcabas, ".
                "sum(d.premitagihan) as premitagihan,".
                "sum(to_number(a.premi)) as jmlpremi,".
                "sum((select 0 from $DBUser.tabel_999_batas_materai where to_number(a.premi) between batasbawahpremi and ".
                "batasataspremi )) as matere, ".
                "sum(decode(to_char(d.tglbayar,'MM/YYYY'),to_char(a.tglbooked,'MM/YYYY'),d.premitagihan*0.01,0) ) as diskon ".
           "from ".
					 			 "$DBUser.tabel_300_historis_premi d,".
								 "$DBUser.tabel_200_pertanggungan b,".
								 "$DBUser.tabel_800_pembayaran a,".
								 "$DBUser.tabel_500_penagih c, ".
					    	 "$DBUser.tabel_202_produk e ".
					  "where b.prefixpertanggungan=a.prefixpertanggungan and ".
                "b.nopertanggungan=a.nopertanggungan and ".
                "b.prefixpertanggungan=d.prefixpertanggungan and ".
                "b.nopertanggungan=d.nopertanggungan and ".
                "a.tglbooked=d.tglbooked and ".
                "b.nopenagih=c.nopenagih and ".
                "a.kdpembayaran in ('001','003') and ".
								$filterperiode.
                "c.kdrayonpenagih='$kdkantor' and ".
  							"b.kdproduk=e.kdproduk ".
								"and substr(b.kdproduk,1,3)='".$produk."' ".
								//"and a.kb='B' ". //khusus bayar melalui bank
           "group by d.kdrekeninglawan,e.kdcabas";
	 }
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

  <!---------- summary  -------->
	<?
	  if($metodebayar=="MDR"){
	  $sql = "select (select nama from $DBUser.tabel_802_kodeakun where akun='282021') namaakunperantara,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='553000') namaakunpotongan,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='604000') namaakunmatre,".
            	"(select nama from $DBUser.tabel_802_kodeakun where akun='931000') selisihbedaindek ".
            "from $DBUser.tabel_802_kodeakun where akun in('272007')";
	  } elseif($metodebayar=="BNI"){
	  $sql = "select (select nama from $DBUser.tabel_802_kodeakun where akun='282021') namaakunperantara,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='553000') namaakunpotongan,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='604000') namaakunmatre,".
            	"(select nama from $DBUser.tabel_802_kodeakun where akun='931000') selisihbedaindek ".
            "from $DBUser.tabel_802_kodeakun where akun in('272007')";
		} elseif ($metodebayar=="CTB") {
		$sql = "select (select nama from $DBUser.tabel_802_kodeakun where akun='282021') namaakunperantara,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='553000') namaakunpotongan,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='604000') namaakunmatre,".
            	"(select nama from $DBUser.tabel_802_kodeakun where akun='931000') selisihbedaindek ".
            "from $DBUser.tabel_802_kodeakun where akun in('272010')";
	  } elseif($metodebayar=="POS"){
	  $sql = "select (select nama from $DBUser.tabel_802_kodeakun where akun='282021') namaakunperantara,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='553000') namaakunpotongan,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='604000') namaakunmatre,".
            	"(select nama from $DBUser.tabel_802_kodeakun where akun='931000') selisihbedaindek ".
            "from $DBUser.tabel_802_kodeakun where akun in('272007')";
		} else {
		$sql = "select (select nama from $DBUser.tabel_802_kodeakun where akun='282021') namaakunperantara,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='553000') namaakunpotongan,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='604000') namaakunmatre,".
            	"(select nama from $DBUser.tabel_802_kodeakun where akun='931000') selisihbedaindek ".
            "from $DBUser.tabel_802_kodeakun where akun in('272011')";
		}
		$DB->parse($sql);
	  $DB->execute();
		$akk=$DB->nextrow();
		$selisihbedaindek = $akk["SELISIHBEDAINDEK"];
		$namaakunperantara = $akk["NAMAAKUNPERANTARA"];
		$namaakunpotongan = $akk["NAMAAKUNPOTONGAN"];
		$namaakunmatre = $akk["NAMAAKUNMATRE"];
		
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
  	 <td><?=$selisihbedaindek;?></td>
  	 <td align="right"><?=$nilaiselisihD_di;?></td>
  	 <td align="right"><?=$nilaiselisihK_di;?></td>
  	</tr>
	  <? 
		}
		?>
		<tr>
  	 <td>D</td>
  	 <td>282021</td>
  	 <td><?=$namaakunperantara;?></td>
  	 <td align="right"><?=number_format($jmlpremi+$jmlpremi_di+$jmlpremi_va,2,",",".");?></td>
  	 <td align="right"></td>
  	</tr>
		<? 
		if($jmlmatre+$jmlmatre_di+$jmlmatre_va>0)
		{
		?>
		<tr>
  	 <td>K</td>
  	 <td>604000</td>
  	 <td><?=$namaakunmatre;?></td>
  	 <td></td>
  	 <td align="right"><?=number_format($jmlmatre+$jmlmatre_di+$jmlmatre_va,2,",",".");?></td>
  	</tr>
		<? 
		}
		?>
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
<? 
echo "<hr size=1>";
echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a>";
?>
</body>
</html>