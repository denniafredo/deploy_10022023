<? 
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
	include "../../includes/kantor.php";
	//include "../../includes/komisiagen.php";
	
  $DB=new database($userid, $passwd, $DBName);
	$KTR=new Kantor($userid,$passwd,$kantor);
	
function DateSelector($inName, $useDate=0) 
{ 
          if($useDate == 0) 
          { 
              $useDate = Time(); 
          } 
  
      		// Tanggal
      		$selected	= (isset($_POST[$inName.'tgl']) && $_POST[$inName.'tgl']!='') ? $_POST[$inName.'tgl'] : date( "j", $useDate);
          print("<select name=" . $inName .  "tgl>\n"); 
          for($currentDay = 1; $currentDay<= 31;$currentDay++) 
          { 
              print("<option value=\"$currentDay\""); 
  						if($selected==$currentDay) 
              { 
                  print(" selected"); 
              } 					
              print(">$currentDay\n"); 						
          } 
          print("</select>"); 
  
  
  				$selected	= (isset($_POST[$inName.'bln']) && $_POST[$inName.'bln']!='') ? $_POST[$inName.'bln'] : date( "n", $useDate);			
          print("<select name=" . $inName .  "bln>\n"); 
          for($currentMonth = 1; $currentMonth <= 12;$currentMonth++) 
          { 
              switch($currentMonth)
              {
                case '1' : $namabulan ="JANUARI"; break ;
                case '2' : $namabulan ="FEBRUARI"; break ;
                case '3' : $namabulan ="MARET"; break ;
                case '4' : $namabulan ="APRIL"; break ;
                case '5' : $namabulan ="MEI"; break ;
                case '6' : $namabulan ="JUNI"; break ;
                case '7' : $namabulan ="JULI"; break ;
                case '8' : $namabulan ="AGUSTUS"; break ;
                case '9' : $namabulan ="SEPTEMBER"; break ;
                case '10' : $namabulan ="OKTOBER"; break ;
                case '11' : $namabulan ="NOVEMBER"; break ;
                case '12' : $namabulan ="DESEMBER"; break ;
              }
  						
              print("<option value=\"$currentMonth\""); 
  						if($selected==$currentMonth) 
              { 
                  print(" selected"); 
              } 					
              print(">$namabulan\n"); 						
          } 
          print("</select>"); 
  
  			
  			$selected	= (isset($_POST[$inName.'thn']) && $_POST[$inName.'thn']!='') ? $_POST[$inName.'thn'] : date( "Y", $useDate);			
          print("<select name=" . $inName .  "thn>\n"); 
          $startYear = date( "Y", $useDate); 
          for($currentYear = 2003; $currentYear <= $startYear+0;$currentYear++) 
          { 
              print("<option value=\"$currentYear\""); 
  						if($selected==$currentYear) 
              { 
                  print(" selected"); 
              } 
              print(">$currentYear\n"); 
  						
          } 
  				print("</select>"); 
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
	if ($kdbank=='POS'){
		$selbank1="selected";
	}	

?>
  <a class="verdana10blk">Pembayaran Melalui</a>
	<select name="kdbank">
	  <option value="POS" <?=$selbank1;?>>PT. POS INDONESIA (POS)</option>
	</select>
  <a class="verdana10blk">Dari <?=DateSelector("d"); ?> Sampai <?=DateSelector("s"); ?></a>
	<input type="submit" name="submit" value="Cari"<
</form>
<br />
<br />
<div align="center">
<?
	$tglawal .= $dthn;
	$tglawal .= ((strlen($dbln)==1) ? '0'.$dbln : $dbln);
	$tglawal .= ((strlen($dtgl)==1) ? '0'.$dtgl : $dtgl);
	
	$tglakhir .= $sthn;
	$tglakhir .= ((strlen($sbln)==1) ? '0'.$sbln : $sbln);
	$tglakhir .= ((strlen($stgl)==1) ? '0'.$stgl : $stgl);

	if ($kdbank=='POS') {
		$namabank='VIA PT. POS INDONESIA (POS)';
		$namalike='POS';
	}
?>
<b>PEMBUKUAN PENERIMAAN PREMI <?=$namabank;?> <br />
PERIODE <?=$tglawal;?> S/D <?=$tglakhir;?><br />
<?=$KTR->namakantor;?> </b>
</div>
<br />
<hr size="1">
<!--------------  start Rupiah --------------->
<table width="600">
<? 
  	$sql = "select ".
              "d.kdrekeninglawan,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun=d.kdrekeninglawan) namaakun,".
							"(select nama from $DBUser.tabel_802_kodeakun where akun='148090000') namaakunperantara,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='553000') namaakunpotongan,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='604000') namaakunmatre,".
              "e.kdcabas, ".
              "sum(d.premitagihan) as premitagihan,".
              "sum(to_number(a.jumlahtagihan)/100) as jmlpremi,".	
//              "sum((select nilaimeterai from $DBUser.tabel_999_batas_materai where to_number(a.jumlahtagihan)/100 between batasbawahpremi and ".
//              "batasataspremi )) as matere, ".
              "'0' as matere, ".
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
							"substr(b.kdproduk,1,3)<>'JL2' and ".
              "a.tglbooked=d.tglbooked and ".
              "b.nopenagih=c.nopenagih and ".
              "a.statuspembayaran='2' and ".
              "b.kdvaluta='1' and ".
              //"to_char(a.tglupdated,'MMYYYY')='$bulancari' and ".
							"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
              "c.kdrayonpenagih='$kantor' and ".
              //"e.rekening2=d.kdrekeninglawan ".
							"b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' ".
           "group by d.kdrekeninglawan,e.kdcabas";//,e.rekening2";

		//echo $sql."<br /><br />";
	  $DB->parse($sql);
	  $DB->execute();
	
  	$i=1;
		$diskon = 0;
		$matre = 0;
		$premi = 0;
  	while ($arr=$DB->nextrow()) {
			$matre		= $arr["MATERE"];
//			$diskon		= $arr["DISKON"];
			$diskon = 0;			
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
//              "sum((select nilaimeterai from $DBUser.tabel_999_batas_materai where to_number(a.jumlahtagihan)/100 between batasbawahpremi and ".
//              "batasataspremi )) as matere, ".
              "'0' as matere, ".
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
							"substr(b.kdproduk,1,3)<>'JL2' and ".
              "a.tglbooked=d.tglbooked and ".
              "b.nopenagih=c.nopenagih and ".
              "a.statuspembayaran='2' and ".
              "b.kdvaluta='0' and ".
              //"to_char(a.tglupdated,'MMYYYY')='$bulancari' and ".
							"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
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
//			$diskon_di = $arr["DISKON"];
			$diskon_di = 0;

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
							"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
              "c.kdrayonpenagih='$kantor' and ".
              //"e.rekening2=d.kdrekeninglawan ".
							"b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' ".
           "group by d.kdrekeninglawan,e.kdcabas,a.tglrekam";

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
//			$diskon_va	= $arr["DISKON"]*$arr["KURS"];
			$diskon_va = 0;
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
		$sql = "select (select nama from $DBUser.tabel_802_kodeakun where akun='148090000') namaakunperantara,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='553000') namaakunpotongan,".
              "(select nama from $DBUser.tabel_802_kodeakun where akun='604000') namaakunmatre,".
            	"(select nama from $DBUser.tabel_802_kodeakun where akun='931000') selisihbedaindek ".
            "from $DBUser.tabel_802_kodeakun where akun in('148090000')";
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
  	 <td>148090000</td>
  	 <td><?=$namaakunperantara;?></td>
  	 <td align="right"><?=number_format(($jmlpremi+$jmlpremi_di+$jmlpremi_va)-($jmlmatre+$jmlmatre_di+$jmlmatre_va)+($jmldiskon+$jmldiskon_di+$jmldiskon_va),2,",",".");?></td>
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
echo "<hr size=1>";
echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a>";
echo("<font face=Verdana size=1>&nbsp;&nbsp;|&nbsp;&nbsp;</font>");
echo("<font face=Verdana size=1><a href=\"#\" onclick=\"window.open('../akunting/cetakslip_pindahbuku_pos.php?kdbank=".$kdbank."&dtgl=".$dtgl."&dbln=".$dbln."&dthn=".$dthn."&stgl=".$stgl."&sbln=".$sbln."&sthn=".$sthn."','','width=800,height=600,top=100,left=100,scrollbars=yes');\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak SLIP</a></font>");
?>
</body>
</html>