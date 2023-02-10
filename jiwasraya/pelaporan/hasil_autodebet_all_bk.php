<? 
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
	include "../../includes/kantor.php";
	include "../../includes/klien.php";
	
  $DB=new database($userid, $passwd, $DBName);
  $DBA=new database($userid, $passwd, $DBName);
	$KTR=new Kantor($userid,$passwd,$kantor);
	
	function ShowFromDate($year_interval,$YearIntervalType) {
  GLOBAL $day,$month,$year;

  //DAY
  echo "<select name=hari>"	;
	  for($currentDay = 1; $currentDay<= 31;$currentDay++) 
			  { 
				  print("<option value=\"$currentDay\""); 
							if($selected==$currentDay) 
				  { 
					  print(" selected"); 
				  } 					
				  print(">$currentDay\n"); 						
			  } 
  echo "</select>";	
  

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
		/*$tglawal	 = $year.$month.$tglstart;
		$tglakhir	 = $year.$month.$tglend;*/
		$tglawal	 = $year.$month.$tglmulai;
		$tglakhir	 = $year.$month.$tglselesai;
		
		
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
 font-size: 10px;
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
	}
	else if ($kdbank=='BNI'){
		$selbank1="";
		$selbank2="selected";
	}	
?>
  <a class="verdana10blk">Nama Bank</a>
	<select name="kdbank">
	  <option value="MDR" <?=$selbank1;?>>MANDIRI</option>
		<option value="BNI" <?=$selbank2;?>>BNI</option>
		<option value="BRI" <?=$selbank2;?>>BRI</option>
	</select>
  <!--a class="verdana10blk">Pilih Periode</a>
	<select name="periode">
	  <option value="1" <?=$s1;?>>I</option>
		<option value="2" <?=$s2;?>>II</option>
		<option value="3" <?=$s3;?>>III</option>
	</select>
  <a class="verdana10blk">Bulan</a--> 
  <?  ShowFromDate(10,"Past"); ?>
	<input type="submit" name="submit" value="Cari"</input>
</form>
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
?>
<b>HASIL AUTO DEBET <?=$namabank;?><br />BULAN <?=$namabulan." ".$year;?> PERIODE <?=$periode=="" ? "1" : $periode;?><br />SELURUH KANTOR</b>
</div>

<!--------------  start Rupiah --------------->
<? 
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
						"substr(b.kdproduk,1,3)<>'JL2' and ".
						"b.prefixpertanggungan=d.prefixpertanggungan and ".
            "b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ".
            "b.nopenagih=c.nopenagih and a.statuspembayaran='2' and b.kdvaluta='1' and ".
						"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
						//"to_char(a.tglupdated,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
//						"c.kdrayonpenagih='$kantor' and ".
						"b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' ";
						//echo $sql;
	$DB->parse($sql);
  $DB->execute();				
	$ars=$DB->nextrow();
	$ono = $ars["CABAS"];
	
if($ono!="")
{	

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
						"substr(b.kdproduk,1,3)<>'JL2' and ".
						"b.prefixpertanggungan=d.prefixpertanggungan and ".
            "b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ".
            "b.nopenagih=c.nopenagih and a.statuspembayaran='2' and b.kdvaluta='1' and ".
						"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
						//"to_char(a.tglupdated,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
//						"c.kdrayonpenagih='$kantor' and ".
						"b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' ";
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
		<!--
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    No. Polis</td>
		-->
		<td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    No. Polis</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Nama Pemb. Polis</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Telp/HP</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Bulan Tagihan</td>
    <!--
		<td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Tgl. Bayar</td> -->
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    No.Rekening</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    OB/NB</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Jml. Premi</td>
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
  
	$sql = "select ".
            "c.kdrayonpenagih,b.prefixpertanggungan,b.nopertanggungan,b.kdvaluta,".
            "d.tglbooked as tglbuk,d.kdkuitansi,d.premitagihan,d.kdrekeninglawan,".
						"to_number(a.jumlahtagihan)/100 as jmlpremi,".
            "a.nopolis,to_char(a.tglbooked,'MM/YYYY') as blntagihan,".
						"a.nokontrol,to_number(a.norekdebet) as norekdebet,a.norekkredit,a.statuspembayaran,".
   					"a.nourut,".
						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as namaklien, ".
						"(select phonetetap01 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as telp1, ".
						"(select phonetetap02 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as telp2, ".
						"a.beritakredit,a.statuspembayaran, ".
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
             ") as matere ".
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
						"substr(b.kdproduk,1,3)<>'JL2' and ".
						"a.statuspembayaran='2' and ".
						"b.kdvaluta='1' and ".
						"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
//            "c.kdrayonpenagih='$kantor' and ".
						"b.kdproduk=e.kdproduk and e.kdcabas='$cabas' and a.kdbank='".$kdbank."' ".
					"order by d.kdkuitansi, d.prefixpertanggungan, d.nopertanggungan";
		//echo $sql."<br /><br />";
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
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["TELP1"];?><br><?=$arr["TELP2"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["BLNTAGIHAN"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KDREKENINGLAWAN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$kdkui;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["PREMITAGIHAN"],2,",",".");?></td>
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
      	$sql=	"select substr(keteranganmutasi,20,10) as nopenagihlama from $DBUser.tabel_600_historis_mutasi_pert ".
      						"where kdmutasi='12' and prefixpertanggungan='".$arr["PREFIXPERTANGGUNGAN"]."' ".
      						"and nopertanggungan='".$arr["NOPERTANGGUNGAN"]."' and substr(keteranganmutasi,length(keteranganmutasi)-15,16) like '%".$namabank."%' ".
      						"group by substr(keteranganmutasi,20,10)";
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
	$jmltotaldebet += $arr["JMLPREMI"];
	$jmlpremi += $arr["PREMITAGIHAN"];
	
	${"jmlpreminb".$cabas} += $preminb;
	${"jmlpremiob".$cabas} += $premiob;
	
	${"jmldiscountnb".$cabas} +=$discountnb;
	${"jmldiscountob".$cabas} +=$discountob;
	
	${"jmlmatrenb".$cabas}+=$matrenb;
	${"jmlmatreob".$cabas}+=$matreob;
	${"jmltotaldebetnb".$cabas} += $totaldebetnb;
	${"jmltotaldebetob".$cabas} += $totaldebetob;
	
	$prevcabas = $arr["KDCABAS"];
	
	//${"totkomisith1".$cabas} += $jmlkomisith1;
	//${"totkomisith1".$cabas} += $tk1;
	//${"totkomisith2".$cabas} += $jmlkomisith2;
	//${"totkomisith3".$cabas} += $jmlkomisith3;
	}

	?>
	<tr bgcolor="#f5d79c">
	 <td></td>
	 <td colspan="5"><b>JUMLAH <?=$cabas;?></b></td>
	 <td><?=${"kdrekob".$cabas};?></td>
	 <td>OB</td>
	 <td align="right"><?=number_format(${"jmlpremiob".$cabas},2,",",".");?></td>
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
	 <td colspan="5"></td>
	 <td><?=${"kdreknb".$cabas};?></td>
	 <td>NB</td>
	 <td align="right"><?=number_format(${"jmlpreminb".$cabas},2,",",".");?></td>
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
						"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
						//"to_char(a.tglupdated,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
//						"c.kdrayonpenagih='$kantor' and ".
            "b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' ";
	$DB->parse($sql);
  $DB->execute();				
	$ars=$DB->nextrow();
	$ono_di = $ars["CABAS"];
	
if($ono_di!="")
{
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
						"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
						//"to_char(a.tglupdated,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
//						"c.kdrayonpenagih='$kantor' and ".
            "b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' ";
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
		<!--
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    No. Polis</td>
		-->
		<td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    No. Polis</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Nama Pemb. Polis</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Telp/HP</td>
	
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Bulan Tagihan</td>
    <!--
		<td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Tgl. Bayar</td> -->
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    No.Rekening</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    OB/NB</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Jml. Premi</td>
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
	
	$sql = "select ".
            "c.kdrayonpenagih,b.prefixpertanggungan,b.nopertanggungan,b.kdvaluta,b.indexawal,".
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
						
//						"(select substr(keteranganmutasi,20,10) from $DBUser.tabel_600_historis_mutasi_pert ".
//						"where kdmutasi='12' and prefixpertanggungan=b.prefixpertanggungan ".
//						"and nopertanggungan=b.nopertanggungan and keteranganmutasi like '%AUTODEBET%'".
//						"and SUBSTR (keteranganmutasi, 42, 17)='PENAGIH AUTODEBET') as nopenagihlama, ".
// Revisi oleh Ari 14/06/2007
//*						"(select substr(keteranganmutasi,20,10) from $DBUser.tabel_600_historis_mutasi_pert ".
//*						"where kdmutasi='12' and prefixpertanggungan=b.prefixpertanggungan ".
//*						"and nopertanggungan=b.nopertanggungan and substr(keteranganmutasi,length(keteranganmutasi)-15,16) like '%MANDIRI%' ".
//*						") as nopenagihlama, ".
//* Revisi oleh Ari 12/09/2007
//*						"(select substr(keteranganmutasi,20,10) from $DBUser.tabel_600_historis_mutasi_pert ".
//*						"where kdmutasi='12' and prefixpertanggungan=b.prefixpertanggungan ".
//*						"and nopertanggungan=b.nopertanggungan and substr(keteranganmutasi,length(keteranganmutasi)-15,16) like '%MANDIRI%' ".
//*						"group by substr(keteranganmutasi,20,10) ".
//*						") as nopenagihlama, ".
						
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
						"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
            //"to_char(a.tglupdated,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
//            "c.kdrayonpenagih='$kantor' and ".
						"b.kdproduk=e.kdproduk and e.kdcabas='$cabas' and a.kdbank='".$kdbank."' ".
					"order by d.kdkuitansi, d.prefixpertanggungan, d.nopertanggungan";
		//echo $sql;
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
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["TELP1"];?><br><?=$arr["TELP2"];?></td>	
	
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["BLNTAGIHAN"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KDREKENINGLAWAN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$kdkui_di;?></td>
    <? 
  		$premihitung_di = $arr["PREMITAGIHAN"]/$arr["INDEXAWAL"];
		?>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($premihitung_di,2,",",".");?></td>
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
      	$sql=	"select substr(keteranganmutasi,20,10) as nopenagihlama from $DBUser.tabel_600_historis_mutasi_pert ".
      						"where kdmutasi='12' and prefixpertanggungan='".$arr["PREFIXPERTANGGUNGAN"]."' ".
      						"and nopertanggungan='".$arr["PREFIXPERTANGGUNGAN"]."' and substr(keteranganmutasi,length(keteranganmutasi)-15,16) like '%".$namabank."%' ".
      						"group by substr(keteranganmutasi,20,10)";
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
	 <td colspan="5"><b>JUMLAH <?=$cabas;?></b></td>
	 <td><?=${"kdrekob".$cabas};?></td>
	 
	 <td><? //=$job;?>OB</td>
	 <td align="right"><?=number_format(${"jmlpremiob_di".$cabas},2,",",".");?></td>
	 <td></td>
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
	 <td colspan="5"></td>
	 <td><?=${"kdreknb".$cabas};?></td>
	 <td><? //=$jnb;?>NB</td>
	 <td align="right"><?=number_format(${"jmlpreminb_di".$cabas},2,",",".");?></td>
	 <td></td>
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
						"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
						//"to_char(a.tglupdated,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
//						"c.kdrayonpenagih='$kantor' and ".
            "b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' ";
  $DB->parse($sql);
  $DB->execute();				
	$ars=$DB->nextrow();
	$ono_va = $ars["CABAS"];
	
if($ono_va!="")
{						
						
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
						"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
						//"to_char(a.tglupdated,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
//						"c.kdrayonpenagih='$kantor' and ".
            "b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' ";
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
		<!--
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    No. Polis</td>
		-->
		<td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    No. Polis</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Nama Pemb. Polis</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Telp/HP</td>
	
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Bulan Tagihan</td>
    <!--
		<td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Tgl. Bayar</td> -->
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    No.Rekening</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    OB/NB</td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Jml. Premi</td>
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
						
//						"(select substr(keteranganmutasi,20,10) from $DBUser.tabel_600_historis_mutasi_pert ".
//						"where kdmutasi='12' and prefixpertanggungan=b.prefixpertanggungan ".
//						"and nopertanggungan=b.nopertanggungan and keteranganmutasi like '%AUTODEBET%'".
//						"and SUBSTR (keteranganmutasi, 42, 17)='PENAGIH AUTODEBET') as nopenagihlama, ".
// Revisi oleh Ari 14/06/2007
//*						"(select substr(keteranganmutasi,20,10) from $DBUser.tabel_600_historis_mutasi_pert ".
//*						"where kdmutasi='12' and prefixpertanggungan=b.prefixpertanggungan ".
//*						"and nopertanggungan=b.nopertanggungan and substr(keteranganmutasi,length(keteranganmutasi)-15,16) like '%MANDIRI%' ".
//*						") as nopenagihlama, ".
//* Revisi oleh Ari 12/09/2007
//*						"(select substr(keteranganmutasi,20,10) from $DBUser.tabel_600_historis_mutasi_pert ".
//*						"where kdmutasi='12' and prefixpertanggungan=b.prefixpertanggungan ".
//*						"and nopertanggungan=b.nopertanggungan and substr(keteranganmutasi,length(keteranganmutasi)-15,16) like '%MANDIRI%' ".
//*						"group by substr(keteranganmutasi,20,10) ".
//*						") as nopenagihlama, ".
						
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
						"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
            //"to_char(a.tglupdated,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
//            "c.kdrayonpenagih='$kantor' and ".
						"b.kdproduk=e.kdproduk and e.kdcabas='$cabas' and a.kdbank='".$kdbank."' ".
					"order by d.kdkuitansi, d.prefixpertanggungan, d.nopertanggungan";
		//echo $sql;
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
  			$discountnb_a = ($arr["PREMITAGIHAN"]* 0.01);
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
  			$discountob_a = ($arr["PREMITAGIHAN"]* 0.01);
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
    <!--<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NOPOLIS"];?></td>
    -->
		<td nowrap style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NAMAKLIEN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["TELP1"];?><br><?=$arr["TELP2"];?></td>	
	
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["BLNTAGIHAN"];?></td>
    <!--<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["TGLBAYAR"];?></td>
		-->
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KDREKENINGLAWAN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$kdkui;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["PREMITAGIHAN"],2,",",".");?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["KURS"],2,",",".");?> </td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right">
		  <?
			//if($arr["PREMITAGIHAN"]==$arr["JMLPREMI"])
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
      	$sql=	"select substr(keteranganmutasi,20,10) as nopenagihlama from $DBUser.tabel_600_historis_mutasi_pert ".
      						"where kdmutasi='12' and prefixpertanggungan='".$arr["PREFIXPERTANGGUNGAN"]."' ".
      						"and nopertanggungan='".$arr["PREFIXPERTANGGUNGAN"]."' and substr(keteranganmutasi,length(keteranganmutasi)-15,16) like '%".$namabank."%' ".
      						"group by substr(keteranganmutasi,20,10)";
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
	//$jmltotaldebet += $arr["JMLPREMI"];
	//$jmlpremi += $arr["PREMITAGIHAN"];
	/*
	${"jmlpreminb_a".$cabas} += $preminb;
	$jmlpremiob_a += $premiob;
	*/
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
	 <td colspan="5"><b>JUMLAH <?=$cabas;?></b></td>
	 <td><?=${"kdrekob_a".$cabas};?></td>
	 <td><? //=$job;?>OB</td>
	 <td align="right"><?=number_format(${"jmlpremiob_a".$cabas},2,",",".");?></td>
	 <td align="right"></td>
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
	 <td colspan="5"></td>
	 <td><?=${"kdreknb_a".$cabas};?></td>
	 <td><? //=$jnb;?>NB</td>
	 <td align="right"><?=number_format(${"jmlpreminb_a".$cabas},2,",",".");?></td>
	 <td align="right"></td>
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
 ?>
 <a href="rekap_autodebet.php"><font color="#ffffff">Rekap Autodebet</font></a>
<? 
echo "<hr size=1>";
					 echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a>";

?>
</body>
</html>
