<? 
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
	include "../../includes/kantor.php";
	//include "../../includes/komisiagen.php";
	
  $DB=new database($userid, $passwd, $DBName);
	$KTR=new Kantor($userid,$passwd,$kantor);
	
	function ShowFromDate($year_interval,$YearIntervalType) {
  GLOBAL $day,$month,$year;

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
<br />
<b>
HASIL AUTO DEBET BANK MANDIRI <br />
BULAN <?=$namabulan." ".$year;?><br />
<?=$KTR->namakantor;?> 
</b>
<br />
<hr size="1">
<? 
//start rupiah 
//-------------------------------------------------------------------------------------------
 $sql = "select ".
          "z.tagihan as tagihannb_rp,".
          "z.premidibayar as premidibayarnb_rp,".
          "x.tagihan as tagihanob_rp,".
          "x.premidibayar as premidibayarob_rp,".
          "(z.premidibayar+x.premidibayar) as rp272007,".
          "y.discount,  ".
					"o.matere ".
        "from ".
        
        "(select ".
           //"e.kdcabas,";
					 "sum(d.premitagihan) tagihan,".
           "sum(to_number(a.jumlahtagihan)/100) as premidibayar ".
        "from ".
           "$DBUser.tabel_300_historis_premi d,".
           "$DBUser.tabel_200_pertanggungan b,".
           "$DBUser.tabel_315_pelunasan_auto_debet a,".
           "$DBUser.tabel_500_penagih c ".
					// "$DBUser.tabel_803_kode_rekening e ".
        "where ".
           "a.nopolis=b.nopol and b.prefixpertanggungan=d.prefixpertanggungan and ".
           "b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ".
           "b.nopenagih=c.nopenagih and a.statuspembayaran='2' and ".
					 //"e.rekening2=d.kdrekeninglawan and ".
           "b.kdvaluta='1' and to_char(a.tglupdated,'MMYYYY')='$bulancari' and c.kdrayonpenagih='$kantor' ". 
           "and d.kdkuitansi like 'NB%' ". 
				//"group by e.kdcabas ".	 
				") z,".
        
        "(select ".
           "sum(d.premitagihan) tagihan,".
           "sum(to_number(a.jumlahtagihan)/100) as premidibayar ".
        "from ".
           "$DBUser.tabel_300_historis_premi d,".
           "$DBUser.tabel_200_pertanggungan b,".
           "$DBUser.tabel_315_pelunasan_auto_debet a,".
           "$DBUser.tabel_500_penagih c ".
        "where ".
           "a.nopolis=b.nopol and b.prefixpertanggungan=d.prefixpertanggungan and ".
           "b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ".
           "b.nopenagih=c.nopenagih and a.statuspembayaran='2' and ".
           "b.kdvaluta='1' and to_char(a.tglupdated,'MMYYYY')='$bulancari' and c.kdrayonpenagih='$kantor' ".
           "and d.kdkuitansi like 'OB%') x,".
        
        "(select ".
          "sum(d.premitagihan*0.01) discount ".
        "from ".
           "$DBUser.tabel_300_historis_premi d,".
           "$DBUser.tabel_200_pertanggungan b,".
           "$DBUser.tabel_315_pelunasan_auto_debet a,".
           "$DBUser.tabel_500_penagih c ".
        "where ".
           "a.nopolis=b.nopol and b.prefixpertanggungan=d.prefixpertanggungan and ".
           "b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ".
           "b.nopenagih=c.nopenagih and a.statuspembayaran='2' and ".
           "b.kdvaluta='1' and to_char(a.tglupdated,'MMYYYY')='$bulancari' and c.kdrayonpenagih='$kantor' ".
           "and to_char(a.tglupdated,'MMYYYY')=to_char(a.tglbooked,'MMYYYY') ) y, ".
				
				"(select ".
           "sum((select nilaimeterai from $DBUser.tabel_999_batas_materai ".
					 "where to_number(a.jumlahtagihan)/100 between ".
           "batasbawahpremi and batasataspremi ".
           ")) as matere ".
        "from ".
           "$DBUser.tabel_300_historis_premi d,".
           "$DBUser.tabel_200_pertanggungan b,".
           "$DBUser.tabel_315_pelunasan_auto_debet a,".
           "$DBUser.tabel_500_penagih c ".
        "where ".
           "a.nopolis=b.nopol and b.prefixpertanggungan=d.prefixpertanggungan and ".
           "b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ".
           "b.nopenagih=c.nopenagih and a.statuspembayaran='2' and ".
           "b.kdvaluta='1' and to_char(a.tglupdated,'MMYYYY')='$bulancari' and c.kdrayonpenagih='$kantor' ".
        ") o";
	$DB->parse($sql);
	$DB->execute();
	$row=$DB->nextrow();
	
	$rp_272007 = $row["RP272007"];
	$rp_553000 = $row["DISCOUNT"];
	$rp_604000 = $row["MATERE"];
	$rp_305311 = $row["TAGIHANOB_RP"];
	$rp_305312 = $row["TAGIHANNB_RP"];
	
	?>
  <br />
	Pembukaan pelunasan premi Auto Debet Valuta Rupiah Tanpa Index (VRTI)  <br /><br />
	<table border="0" cellpadding="2" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber1" width="600">
    <tr>
      <td>D</td>
      <td>272007</td>
      <td>Rk. Perantara Autodebet</td>
      <td align="right"><?=number_format($rp_272007,2,",",".");?></td>
      <td align="right">&nbsp;</td>
    </tr>
    <tr>
      <td>D</td>
      <td>553000</td>
      <td>Pot/Disc Pins per Kas</td>
      <td align="right"><?=number_format($rp_553000,2,",",".");?></td>
      <td align="right">&nbsp;</td>
    </tr>
    <tr>
      <td>K</td>
      <td>604000</td>
      <td>Materai</td>
      <td align="right">&nbsp;</td>
      <td align="right"><?=number_format($rp_604000,2,",",".");?></td>
    </tr>
    <tr>
      <td>K</td>
      <td>305311</td>
      <td>Piutang Premi PP VR TI</td>
      <td align="right">&nbsp;</td>
      <td align="right"><?=number_format($rp_305311,2,",",".");?></td>
    </tr>
    <tr>
      <td>K</td>
      <td>305312</td>
      <td>Piutang Premi PP VR TI</td>
      <td align="right">&nbsp;</td>
      <td align="right"><?=number_format($rp_305312,2,",",".");?></td>
    </tr>
  </table>

	<?
echo "<hr size=1>";
					 echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a>";
?>

</body>
</html>
