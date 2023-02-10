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
            "distinct e.kdcabas as cabas ".
          "from ".
            "$DBUser.tabel_300_historis_premi d,".
            "$DBUser.tabel_200_pertanggungan b,".
            "$DBUser.tabel_315_pelunasan_auto_debet a,".
            "$DBUser.tabel_500_penagih c, ".
            "$DBUser.tabel_803_kode_rekening e ".
          "where ".
            //"a.nopolis=b.nopol and ".
						"b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
   					"b.nopertanggungan=substr(a.nopolis,3,9) and ".
						"b.prefixpertanggungan=d.prefixpertanggungan and ".
            "b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ".
            "b.nopenagih=c.nopenagih and a.statuspembayaran='2' and b.kdvaluta='1' and ".
            "to_char(a.tglupdated,'MMYYYY')='$bulancari' and c.kdrayonpenagih='$kantor' and ".
            "e.rekening2=d.kdrekeninglawan";
	$DB->parse($sql);
  $DB->execute();				
  $arr = $DB->result();	
  foreach ($arr as $foo => $row ) {
	$cabas = $row["CABAS"];
	
	$sql = "select ".
            "c.kdrayonpenagih,b.prefixpertanggungan,b.nopertanggungan,b.kdvaluta,".
            "d.tglbooked as tglbuk,d.kdkuitansi,d.premitagihan,d.kdrekeninglawan,".
						"to_number(a.jumlahtagihan)/100 as jmlpremi,".
            "a.nopolis,to_char(a.tglbooked,'MM/YYYY') as blntagihan,".
						"a.nokontrol,to_number(a.norekdebet) as norekdebet,a.norekkredit,a.statuspembayaran,".
   					"a.nourut,a.namaklien,a.beritakredit,a.statuspembayaran, ".
						"a.tglrekam,to_char(d.tglbayar,'DD/MM/YYYY') as tglbayar,".
						"b.nopenagih,b.noagen,b.norekeningdebet, ".
						"floor(months_between(a.tglbooked,b.mulas)/12) as thnkomisi, ".
						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.noagen) as namaagen, ".
						"e.kdcabas, ".
            "(select nilaimeterai from $DBUser.tabel_999_batas_materai ".
  					 "where to_number(a.jumlahtagihan)/100 between ".
             "batasbawahpremi and batasataspremi ".
             ") as matere, ".
						 "(select nama from $DBUser.tabel_802_kodeakun where akun=e.rekening2) namaakun, ".
						 "(select nama from $DBUser.tabel_802_kodeakun where akun='272007') namaakunperantara, ".
						 "(select nama from $DBUser.tabel_802_kodeakun where akun='553000') namaakunpotongan, ".
						 "(select nama from $DBUser.tabel_802_kodeakun where akun='604000') namaakunmatre ".
          "from ".
            "$DBUser.tabel_300_historis_premi d,".
            "$DBUser.tabel_200_pertanggungan b,".
            "$DBUser.tabel_315_pelunasan_auto_debet a,".
            "$DBUser.tabel_500_penagih c, ".
						"$DBUser.tabel_803_kode_rekening e ".
          "where ".
            //"a.nopolis=b.nopol and ".
						"b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
   					"b.nopertanggungan=substr(a.nopolis,3,9) and ".
            "b.prefixpertanggungan=d.prefixpertanggungan and ".
            "b.nopertanggungan=d.nopertanggungan and ".
            "a.tglbooked=d.tglbooked and ".
            "b.nopenagih=c.nopenagih and ".
						"a.statuspembayaran='2' and ".
						"b.kdvaluta='1' and ".
						"to_char(a.tglupdated,'MMYYYY')='$bulancari' and ".
            "c.kdrayonpenagih='$kantor' and ".
						"e.kdcabas='$cabas' and ".
						"e.rekening2=d.kdrekeninglawan ".
					"order by d.kdkuitansi";
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
		$matre = 0;
		
  	while ($arr=$DB->nextrow()) {
  	  $kdkui = substr($arr["KDKUITANSI"],0,2);
			$matre		= $arr["MATERE"];
			$namaakun		= $arr["NAMAAKUN"];
			$namaakunmatre = $arr["NAMAAKUNMATRE"];
			$namaakunperantara = $arr["NAMAAKUNPERANTARA"];
			$namaakunpotongan = $arr["NAMAAKUNPOTONGAN"];
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
  			$kdreknb = $arr["KDREKENINGLAWAN"];
				$namaakunnb		= $arr["NAMAAKUN"];
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
  			$kdrekob = $arr["KDREKENINGLAWAN"];
				$namaakunob		= $arr["NAMAAKUN"];
  		}

	    if($arr["PREMITAGIHAN"]==$arr["JMLPREMI"])
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
			
    	$i++;
    	${"jmlmatre".$cabas} += $matre;
    	${"jmlpreminb".$cabas} += $preminb;
    	${"jmlpremiob".$cabas} += $premiob;
    	${"jmldiscountnb".$cabas} += $discountnb;
    	${"jmldiscountob".$cabas} += $discountob;
    	${"jmltotaldebetnb".$cabas} += $totaldebetnb;
    	${"jmltotaldebetob".$cabas} += $totaldebetob;
    	$prevcabas = $arr["KDCABAS"];
	}
	
	if($prevkdcabas<>$cabas)
	{
		echo "<tr bgcolor=#f5d79c><td colspan=5><b>$cabas</b></td></tr>";
	}
	?>
	<tr>
	 <td>D</td>
	 <td>272007</td>
	 <td><?=$namaakunperantara;?></td>
	 <td align="right"><?=number_format(${"jmltotaldebetob".$cabas}+${"jmltotaldebetnb".$cabas},2,",",".");?></td>
	 <td align="right"></td>
	</tr>
	<? 
	if(${"jmldiscountob".$cabas}!=0 || ${"jmldiscountnb".$cabas}!=0)
	{
	?>
	<tr>
	 <td>D</td>
	 <td>553000</td>
	 <td><?=$namaakunpotongan;?></td>
	 <td align="right"><?=number_format(${"jmldiscountob".$cabas}+${"jmldiscountnb".$cabas},2,",",".");?></td>
	 <td align="right"></td>
	</tr>
	<? 
	}
	if(!empty(${"jmlmatre".$cabas}) || ${"jmlmatre".$cabas}!=0)
	{
	?>
	<tr>
	 <td>K</td>
	 <td>604000</td>
	 <td><?=$namaakunmatre;?></td>
	 <td></td>
	 <td align="right"><?=number_format(${"jmlmatre".$cabas},2,",",".");?></td>
	</tr>
	<? 
	}
	if(!empty($kdrekob))
	{
	?>
	<tr>
	 <td>K</td>
	 <td><?=$kdrekob;?></td>
	 <td><?=$namaakunob;?></td>
	 <td></td>
	 <td align="right"><?=number_format(${"jmlpremiob".$cabas},2,",",".");?></td>
	</tr>
	<? 
	}
	if(!empty($kdreknb))
	{
	 ?>
	<tr>
	 <td>K</td>
	 <td><?=$kdreknb;?></td>
	 <td><?=$namaakunnb;?></td>
	 <td></td>
	 <td align="right"><?=number_format(${"jmlpreminb".$cabas},2,",",".");?></td>
	</tr>
	<? 
	 }
	 echo "<tr><td colspan=5><hr size=1></td></tr>";
	 $prevkdcabas = $cabas;
	}
	?>
</table>
<!----------------end valuta rupiah ------------>
<br />
<!--------------  start Rupiah --------------->
Pembukaan pelunasan premi Auto Debet Valuta Rupiah Dengan Index (VRDI)  <br />
<table width="600">
<? 

$sql = "select ".
            "distinct e.kdcabas as cabas ".
          "from ".
            "$DBUser.tabel_300_historis_premi d,".
            "$DBUser.tabel_200_pertanggungan b,".
            "$DBUser.tabel_315_pelunasan_auto_debet a,".
            "$DBUser.tabel_500_penagih c, ".
            "$DBUser.tabel_803_kode_rekening e ".
          "where ".
            //"a.nopolis=b.nopol and ".
						"b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
   					"b.nopertanggungan=substr(a.nopolis,3,9) and ".
						"b.prefixpertanggungan=d.prefixpertanggungan and ".
            "b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ".
            "b.nopenagih=c.nopenagih and a.statuspembayaran='2' and b.kdvaluta='0' and ".
            "to_char(a.tglupdated,'MMYYYY')='$bulancari' and c.kdrayonpenagih='$kantor' and ".
            "e.rekening2=d.kdrekeninglawan";
	//echo $sql;
	$DB->parse($sql);
  $DB->execute();				
  $arr = $DB->result();	
  foreach ($arr as $foo => $row ) {
	$cabas = $row["CABAS"];

	$sql = "select ".
            "c.kdrayonpenagih,b.prefixpertanggungan,b.nopertanggungan,b.kdvaluta,".
            "d.tglbooked as tglbuk,d.kdkuitansi,d.premitagihan,d.kdrekeninglawan,".
						"to_number(a.jumlahtagihan)/100 as jmlpremi,".
            "a.nopolis,to_char(a.tglbooked,'MM/YYYY') as blntagihan,".
						"a.nokontrol,to_number(a.norekdebet) as norekdebet,a.norekkredit,a.statuspembayaran,".
   					"a.nourut,a.namaklien,a.beritakredit,a.statuspembayaran, ".
						"a.tglrekam,to_char(d.tglbayar,'DD/MM/YYYY') as tglbayar,".
						"b.nopenagih,b.noagen,b.norekeningdebet, ".
						"floor(months_between(a.tglbooked,b.mulas)/12) as thnkomisi, ".
						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.noagen) as namaagen, ".
						"e.kdcabas, ".
            "(select nilaimeterai from $DBUser.tabel_999_batas_materai ".
  					 "where to_number(a.jumlahtagihan)/100 between ".
             "batasbawahpremi and batasataspremi ".
             ") as matere, ".
						 "(select nama from $DBUser.tabel_802_kodeakun where akun=e.rekening2) namaakun, ".
						 "(select nama from $DBUser.tabel_802_kodeakun where akun='272007') namaakunperantara, ".
						 "(select nama from $DBUser.tabel_802_kodeakun where akun='553000') namaakunpotongan, ".
						 "(select nama from $DBUser.tabel_802_kodeakun where akun='604000') namaakunmatre ".
          "from ".
            "$DBUser.tabel_300_historis_premi d,".
            "$DBUser.tabel_200_pertanggungan b,".
            "$DBUser.tabel_315_pelunasan_auto_debet a,".
            "$DBUser.tabel_500_penagih c, ".
						"$DBUser.tabel_803_kode_rekening e ".
          "where ".
            //"a.nopolis=b.nopol and ".
            "b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
   					"b.nopertanggungan=substr(a.nopolis,3,9) and ".
						"b.prefixpertanggungan=d.prefixpertanggungan and ".
            "b.nopertanggungan=d.nopertanggungan and ".
            "a.tglbooked=d.tglbooked and ".
            "b.nopenagih=c.nopenagih and ".
						"a.statuspembayaran='2' and ".
						"b.kdvaluta='0' and ".
						"to_char(a.tglupdated,'MMYYYY')='$bulancari' and ".
            "c.kdrayonpenagih='$kantor' and ".
						"e.kdcabas='$cabas' and ".
						"e.rekening2=d.kdrekeninglawan ".
					"order by d.kdkuitansi";
		//echo $sql;
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
		$matre = 0;
		
  	while ($arr=$DB->nextrow()) {
  	  $kdkui = substr($arr["KDKUITANSI"],0,2);
			$matre		= $arr["MATERE"];
			$namaakun		= $arr["NAMAAKUN"];
			$namaakunmatre = $arr["NAMAAKUNMATRE"];
			$namaakunperantara = $arr["NAMAAKUNPERANTARA"];
			$namaakunpotongan = $arr["NAMAAKUNPOTONGAN"];
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
  			$kdreknb = $arr["KDREKENINGLAWAN"];
				$namaakunnb		= $arr["NAMAAKUN"];
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
  			$kdrekob = $arr["KDREKENINGLAWAN"];
				$namaakunob		= $arr["NAMAAKUN"];
  		}

	    if($arr["PREMITAGIHAN"]==$arr["JMLPREMI"])
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
			
    	$i++;
    	${"jmlmatre".$cabas} += $matre;
    	${"jmlpreminb".$cabas} += $preminb;
    	${"jmlpremiob".$cabas} += $premiob;
    	${"jmldiscountnb".$cabas} += $discountnb;
    	${"jmldiscountob".$cabas} += $discountob;
    	${"jmltotaldebetnb".$cabas} += $totaldebetnb;
    	${"jmltotaldebetob".$cabas} += $totaldebetob;
    	$prevcabas = $arr["KDCABAS"];
	}
	
	if($prevkdcabas<>$cabas)
	{
		echo "<tr bgcolor=#f5d79c><td colspan=5><b>$cabas</b></td></tr>";
	}
	?>
	<tr>
	 <td>D</td>
	 <td>272007</td>
	 <td><?=$namaakunperantara;?></td>
	 <td align="right"><?=number_format(${"jmltotaldebetob".$cabas}+${"jmltotaldebetnb".$cabas},2,",",".");?></td>
	 <td align="right"></td>
	</tr>
	<? 
	if(${"jmldiscountob".$cabas}!=0 || ${"jmldiscountnb".$cabas}!=0)
	{
	?>
	<tr>
	 <td>D</td>
	 <td>553000</td>
	 <td><?=$namaakunpotongan;?></td>
	 <td align="right"><?=number_format(${"jmldiscountob".$cabas}+${"jmldiscountnb".$cabas},2,",",".");?></td>
	 <td align="right"></td>
	</tr>
	<? 
	}
	if(!empty(${"jmlmatre".$cabas}) || ${"jmlmatre".$cabas}!=0)
	{
	?>
	<tr>
	 <td>K</td>
	 <td>604000</td>
	 <td><?=$namaakunmatre;?></td>
	 <td></td>
	 <td align="right"><?=number_format(${"jmlmatre".$cabas},2,",",".");?></td>
	</tr>
	<? 
	}
	if(!empty($kdrekob))
	{
	?>
	<tr>
	 <td>K</td>
	 <td><?=$kdrekob;?></td>
	 <td><?=$namaakunob;?></td>
	 <td></td>
	 <td align="right"><?=number_format(${"jmlpremiob".$cabas},2,",",".");?></td>
	</tr>
	<? 
	}
	if(!empty($kdreknb))
	{
	 ?>
	<tr>
	 <td>K</td>
	 <td><?=$kdreknb;?></td>
	 <td><?=$namaakunnb;?></td>
	 <td></td>
	 <td align="right"><?=number_format(${"jmlpreminb".$cabas},2,",",".");?></td>
	</tr>
	<? 
	 }
	 echo "<tr><td colspan=5><hr size=1></td></tr>";
	 $prevkdcabas = $cabas;
	}
	?>
</table>
<!----------------end valuta rupiah dengan index------------>

<br />
<!--------------  start Valuta Asing --------------->
Pembukaan pelunasan premi Auto Debet Valuta Asing (VA)  <br />
<table width="600">
<? 

$sql = "select ".
            "distinct e.kdcabas as cabas ".
          "from ".
            "$DBUser.tabel_300_historis_premi d,".
            "$DBUser.tabel_200_pertanggungan b,".
            "$DBUser.tabel_315_pelunasan_auto_debet a,".
            "$DBUser.tabel_500_penagih c, ".
            "$DBUser.tabel_803_kode_rekening e ".
          "where ".
            //"a.nopolis=b.nopol and ".
						"b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
   					"b.nopertanggungan=substr(a.nopolis,3,9) and ".
						"b.prefixpertanggungan=d.prefixpertanggungan and ".
            "b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ".
            "b.nopenagih=c.nopenagih and a.statuspembayaran='2' and b.kdvaluta='3' and ".
            "to_char(a.tglupdated,'MMYYYY')='$bulancari' and c.kdrayonpenagih='$kantor' and ".
            "e.rekening2=d.kdrekeninglawan";
	//echo $sql;
	$DB->parse($sql);
  $DB->execute();				
  $arr = $DB->result();	
  foreach ($arr as $foo => $row ) {
	$cabas = $row["CABAS"];

	$sql = "select ".
            "c.kdrayonpenagih,b.prefixpertanggungan,b.nopertanggungan,b.kdvaluta,".
            "d.tglbooked as tglbuk,d.kdkuitansi,d.premitagihan,d.kdrekeninglawan,".
						"to_number(a.jumlahtagihan)/100 as jmlpremi,".
            "a.nopolis,to_char(a.tglbooked,'MM/YYYY') as blntagihan,".
						"a.nokontrol,to_number(a.norekdebet) as norekdebet,a.norekkredit,a.statuspembayaran,".
   					"a.nourut,a.namaklien,a.beritakredit,a.statuspembayaran, ".
						"a.tglrekam,to_char(d.tglbayar,'DD/MM/YYYY') as tglbayar,".
						"b.nopenagih,b.noagen,b.norekeningdebet, ".
						"floor(months_between(a.tglbooked,b.mulas)/12) as thnkomisi, ".
						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.noagen) as namaagen, ".
						"e.kdcabas, ".
            "(select nilaimeterai from $DBUser.tabel_999_batas_materai ".
  					 "where to_number(a.jumlahtagihan)/100 between ".
             "batasbawahpremi and batasataspremi ".
             ") as matere, ".
						 "(select nama from $DBUser.tabel_802_kodeakun where akun=e.rekening2) namaakun, ".
						 "(select nama from $DBUser.tabel_802_kodeakun where akun='272007') namaakunperantara, ".
						 "(select nama from $DBUser.tabel_802_kodeakun where akun='553000') namaakunpotongan, ".
						 "(select nama from $DBUser.tabel_802_kodeakun where akun='604000') namaakunmatre ".
          "from ".
            "$DBUser.tabel_300_historis_premi d,".
            "$DBUser.tabel_200_pertanggungan b,".
            "$DBUser.tabel_315_pelunasan_auto_debet a,".
            "$DBUser.tabel_500_penagih c, ".
						"$DBUser.tabel_803_kode_rekening e ".
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
						"to_char(a.tglupdated,'MMYYYY')='$bulancari' and ".
            "c.kdrayonpenagih='$kantor' and ".
						"e.kdcabas='$cabas' and ".
						"e.rekening2=d.kdrekeninglawan ".
					"order by d.kdkuitansi";
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
		$matre_a = 0;
		
  	while ($arr=$DB->nextrow()) {
  	  $kdkui = substr($arr["KDKUITANSI"],0,2);
			$matre		= $arr["MATERE"];
			$namaakun		= $arr["NAMAAKUN"];
			$namaakunmatre = $arr["NAMAAKUNMATRE"];
			$namaakunperantara = $arr["NAMAAKUNPERANTARA"];
			$namaakunpotongan = $arr["NAMAAKUNPOTONGAN"];
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
  			$jnb_a++;
  			$kdreknb_a = $arr["KDREKENINGLAWAN"];
				$namaakunnb_a		= $arr["NAMAAKUN"];
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
  			$job_a++;
  			$kdrekob_a = $arr["KDREKENINGLAWAN"];
				$namaakunob_a		= $arr["NAMAAKUN"];
  		}

	    if($arr["PREMITAGIHAN"]==$arr["JMLPREMI"])
			{
			  $discount_a = 0;
				$discountnb_a = 0;
				$discountob_a = 0;
			}
			else
			{
			  $discount_a = ($arr["PREMITAGIHAN"]* 0.01);
				$discountnb_a = $discountnb_a;
				$discountob_a = $discountob_a;
			}
			
    	$i++;
    	${"jmlmatre_a".$cabas} += $matre_a;
    	${"jmlpreminb_a".$cabas} += $preminb_a;
    	${"jmlpremiob_a".$cabas} += $premiob_a;
    	${"jmldiscountnb_a".$cabas} += $discountnb_a;
    	${"jmldiscountob_a".$cabas} += $discountob_a;
    	${"jmltotaldebetnb_a".$cabas} += $totaldebetnb_a;
    	${"jmltotaldebetob_a".$cabas} += $totaldebetob_a;
    	$prevcabas = $arr["KDCABAS"];
	}
	
	if($prevkdcabas<>$cabas)
	{
		echo "<tr bgcolor=#f5d79c><td colspan=5><b>$cabas</b></td></tr>";
	}
	?>
	<tr>
	 <td>D</td>
	 <td>272007</td>
	 <td><?=$namaakunperantara;?></td>
	 <td align="right"><?=number_format(${"jmltotaldebetob_a".$cabas}+${"jmltotaldebetnb_a".$cabas},2,",",".");?></td>
	 <td align="right"></td>
	</tr>
	<? 
	if(${"jmldiscountob_a".$cabas}!=0 || ${"jmldiscountnb_a".$cabas}!=0)
	{
	?>
	<tr>
	 <td>D</td>
	 <td>553000</td>
	 <td><?=$namaakunpotongan;?></td>
	 <td align="right"><?=number_format(${"jmldiscountob_a".$cabas}+${"jmldiscountnb_a".$cabas},2,",",".");?></td>
	 <td align="right"></td>
	</tr>
	<? 
	}
	if(!empty(${"jmlmatre_a".$cabas}) || ${"jmlmatre_a".$cabas}!=0)
	{
	?>
	<tr>
	 <td>K</td>
	 <td>604000</td>
	 <td><?=$namaakunmatre;?></td>
	 <td></td>
	 <td align="right"><?=number_format(${"jmlmatre_a".$cabas},2,",",".");?></td>
	</tr>
	<? 
	}
	if(!empty($kdrekob_a))
	{
	?>
	<tr>
	 <td>K</td>
	 <td><?=$kdrekob_a;?></td>
	 <td><?=$namaakunob_a;?></td>
	 <td></td>
	 <td align="right"><?=number_format(${"jmlpremiob_a".$cabas},2,",",".");?></td>
	</tr>
	<? 
	}
	if(!empty($kdreknb_a))
	{
	 ?>
	<tr>
	 <td>K</td>
	 <td><?=$kdreknb_a;?></td>
	 <td><?=$namaakunnb_a;?></td>
	 <td></td>
	 <td align="right"><?=number_format(${"jmlpreminb_a".$cabas},2,",",".");?></td>
	</tr>
	<? 
	 }
	 echo "<tr><td colspan=5><hr size=1></td></tr>";
	 $prevkdcabas = $cabas;
	}
	?>
</table>
<!----------------end valuta asing------------>
<? 
echo "<hr size=1>";
					 echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a>";
?>
</body>
</html>