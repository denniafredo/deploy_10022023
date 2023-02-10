<? 
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
	include "../../includes/kantor.php";
	include "../../includes/klien.php";
	
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
	  $bulancari = $year.$month;
	}
	else
	{
	  $month=date("m");
		$year=date("Y");
	  $bulancari = $year.$month;
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
  <a class="verdana10blk">Bulan Tagihan</a> 
  <?  ShowFromDate(10,"Past"); ?>
	<input type="submit" name="submit" value="Cari"<
</form>
<br />
<div align="center">
<b>DAFTAR TAGIHAN PREMI AUTO DEBET BANK MANDIRI <br />BULAN <?=$namabulan." ".$year;?><br /><?=$KTR->namakantor;?> </b>
</div>

<?

$sql = "select distinct ".
		 	 		"(select kdcabas from $DBUser.tabel_202_produk where kdproduk=a.kdproduk) as cabas ".
			 "from ".
			    "$DBUser.tabel_300_historis_premi c,".
					"$DBUser.tabel_200_pertanggungan a,".
					"$DBUser.tabel_500_penagih b ".
			 "where ".
			    "a.prefixpertanggungan=c.prefixpertanggungan ".
					"and a.nopertanggungan=c.nopertanggungan ".
					"and a.nopenagih=b.nopenagih ".
					"and a.autodebet='1' ".
          "AND a.kdbank = 'MDR' ".						 
					"and a.kdvaluta='1' ".
					"and b.kdrayonpenagih='$kantor' ".
					"and to_char(c.tglbooked,'YYYYMM')='".$bulancari."'";
	//echo $sql;
	$DB->parse($sql);
  $DB->execute();				
  $arr = $DB->result();	
//echo $arr["CABAS"];
?>

<b>Valuta Rupiah Tanpa Indeks (VRTI)</b>
<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
  <tr>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    NO</td>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Cabas</td>
		<td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    No. Polis</td>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Nama Pemb. Polis</td>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Bulan Tagihan</td>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    No.Rekening</td>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    OB/NB</td>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Jml. Premi</td>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Penagih Lama</td>
  </tr>
	<? 
  foreach ($arr as $foo => $row ) {
	$cabas = $row["CABAS"];
	
	$sql = "select a.prefixpertanggungan,a.nopertanggungan,".
			 	    "(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) as pemegangpolis,".
				 	  "a.kdvaluta,d.kdcabas,".
						"a.norekeningdebet,a.kdbank,b.nopenagih,c.tglbooked,c.premitagihan,c.kdrekeningpremi,".
          	"c.kdrekeninglawan,substr(c.kdkuitansi,0,2) as kdkuitansi,c.tglseatled,c.tglbayar,".
          	"(select substr(keteranganmutasi,20,10) from $DBUser.tabel_600_historis_mutasi_pert ".
          	"where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan ".
          	"and substr(keteranganmutasi,length(keteranganmutasi)-15,16) like '%MANDIRI%') as nopenagihlama   ".
         "from ".
           "$DBUser.tabel_300_historis_premi c,".
           "$DBUser.tabel_200_pertanggungan a,".
           "$DBUser.tabel_500_penagih b,".
           "$DBUser.tabel_202_produk d ".
         "where ".
           "a.prefixpertanggungan=c.prefixpertanggungan ".
           "and a.nopertanggungan=c.nopertanggungan ".
           "and a.kdproduk=d.kdproduk  ".
           "and a.autodebet='1' ".
           "AND a.kdbank = 'MDR' ".						 
					 "and a.kdvaluta='1' ".
           "and a.nopenagih=b.nopenagih  ".
           "and b.kdrayonpenagih='".$kantor."'  ".
           "and to_char(c.tglbooked,'YYYYMM')='".$bulancari."' ".
           "and d.kdcabas='".$cabas."' ".
         "order by d.kdcabas,c.kdkuitansi";
		//echo $sql."<br /><br />";
	  $DB->parse($sql);
	  $DB->execute();
	
  	$i=1;
  	$preminb = 0;
  	$premiob = 0;
  	$totaldebetnb = 0;
  	$totaldebetob = 0;
  	$jnb = 0;
  	$job = 0;
  	while ($arr=$DB->nextrow()) {
  	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	  $kdkui = substr($arr["KDKUITANSI"],0,2);
  		if($kdkui=="NB")
  		{
  		  $preminb = $arr["PREMITAGIHAN"];
  			$premiob = 0;

  			$totaldebetnb = $arr["JMLPREMI"];
  			$totaldebetob = 0;
  			$jnb++;
  			${"kdreknb".$cabas} = $arr["KDREKENINGLAWAN"];
  		}
  		elseif($kdkui=="OB")
  		{
  		  $premiob = $arr["PREMITAGIHAN"];
  			$preminb = 0;

  			$totaldebetob = $arr["JMLPREMI"];
  			$totaldebetnb = 0;
  			$job++;
  			${"kdrekob".$cabas} = $arr["KDREKENINGLAWAN"];
  		}
			$PNG=new Klien($userid,$passwd,$arr["NOPENAGIHLAMA"]);
  	?>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$i;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=($prevcabas<>$arr["KDCABAS"] ? "<b>".$arr["KDCABAS"]."</b>" : "");?></td>
		<td nowrap style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PEMEGANGPOLIS"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$namabulan;?> <?=substr($bulancari,0,4);?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KDREKENINGLAWAN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$kdkui;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["PREMITAGIHAN"],2,",",".");?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$PNG->nama;?></td>
  </tr>
	<? 
	$i++;
	$jmltotaldebet += $arr["JMLPREMI"];
	$jmlpremi += $arr["PREMITAGIHAN"];
	${"jmlpreminb".$cabas} += $preminb;
	${"jmlpremiob".$cabas} += $premiob;
	$prevcabas = $arr["KDCABAS"];
	}

	?>
	
	<? 
	if(${"jmlpremiob".$cabas}==0)
	{} else {
	?>
	<tr bgcolor="#f5d79c">
	 <td></td>
	 <td colspan="4"><b>JUMLAH <?=$cabas;?></b></td>
	 <td><?=${"kdrekob".$cabas};?></td>
	 <td>OB</td>
	 <td align="right"><?=number_format(${"jmlpremiob".$cabas},2,",",".");?></td>
	 <td></td>
	</tr>
	<? 
	}
	
	if(${"jmlpreminb".$cabas}==0)
	{} else {
	?>
	<tr bgcolor="#f5d79c">
	 <td></td>
	 <td colspan="4"></td>
	 <td><?=${"kdreknb".$cabas};?></td>
	 <td>NB</td>
	 <td align="right"><?=number_format(${"jmlpreminb".$cabas},2,",",".");?></td>
	 <td></td>
	</tr>
	<? 
	}
	
	}
	?>
</table>
<br />

<!-------------VRDI--------------->
<?
$sql = "select distinct ".
		 	 		"(select kdcabas from $DBUser.tabel_202_produk where kdproduk=a.kdproduk) as cabas ".
			 "from ".
			    "$DBUser.tabel_300_historis_premi c,".
					"$DBUser.tabel_200_pertanggungan a,".
					"$DBUser.tabel_500_penagih b ".
			 "where ".
			    "a.prefixpertanggungan=c.prefixpertanggungan ".
					"and a.nopertanggungan=c.nopertanggungan ".
					"and a.nopenagih=b.nopenagih ".
					"and a.autodebet='1' ".
          "AND a.kdbank = 'MDR' ".						 
					"and a.kdvaluta='0' ".
					"and b.kdrayonpenagih='$kantor' ".
					"and to_char(c.tglbooked,'YYYYMM')='".$bulancari."'";
	//echo $sql;
	$DB->parse($sql);
  $DB->execute();				
  $arr = $DB->result();	
	
	//$jml = $DB->affected();
?>
<b>Valuta Rupiah Dengan Indeks (VRDI)</b>
<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
  <tr>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    NO</td>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Cabas</td>
		<td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    No. Polis</td>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Nama Pemb. Polis</td>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Bulan Tagihan</td>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    No.Rekening</td>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    OB/NB</td>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Jml. Premi</td>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Penagih Lama</td>
  </tr>
	<? 
  foreach ($arr as $foo => $row ) {
	$cabas = $row["CABAS"];
	
	$sql = "select a.prefixpertanggungan,a.nopertanggungan,a.premi1,a.premi2,a.indexawal,".
			 	    "(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) as pemegangpolis,".
				 	  "a.kdvaluta,d.kdcabas,".
						"a.norekeningdebet,a.kdbank,a.indexawal,b.nopenagih,c.tglbooked,c.premitagihan,c.kdrekeningpremi,".
          	"c.kdrekeninglawan,substr(c.kdkuitansi,0,2) as kdkuitansi,c.tglseatled,c.tglbayar,".
          	"(select substr(keteranganmutasi,20,10) from $DBUser.tabel_600_historis_mutasi_pert ".
          	"where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan ".
          	"and substr(keteranganmutasi,length(keteranganmutasi)-15,16) like '%MANDIRI%') as nopenagihlama   ".					
         "from ".
           "$DBUser.tabel_300_historis_premi c,".
           "$DBUser.tabel_200_pertanggungan a,".
           "$DBUser.tabel_500_penagih b,".
           "$DBUser.tabel_202_produk d ".
         "where ".
           "a.prefixpertanggungan=c.prefixpertanggungan ".
           "and a.nopertanggungan=c.nopertanggungan ".
           "and a.kdproduk=d.kdproduk  ".
           "and a.autodebet='1' ".
           "AND a.kdbank = 'MDR' ".						 					 
					 "and a.kdvaluta='0' ".
           "and a.nopenagih=b.nopenagih  ".
           "and b.kdrayonpenagih='".$kantor."'  ".
           "and to_char(c.tglbooked,'YYYYMM')='".$bulancari."' ".
           "and d.kdcabas='".$cabas."' ".
         "order by d.kdcabas,c.kdkuitansi";
		//echo $sql."<br /><br />";
	  $DB->parse($sql);
	  $DB->execute();
	
  	$i=1;
  	$preminb = 0;
  	$premiob = 0;
  	$jnb = 0;
  	$job = 0;
  	while ($arr=$DB->nextrow()) {
  	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	  $kdkui = substr($arr["KDKUITANSI"],0,2);
			
			$premitagihan = round($arr["PREMI1"]/$arr["INDEXAWAL"],2);
			
  		if($kdkui=="NB")
  		{
  		  $preminb = $premitagihan;
  			$premiob = 0;

  			$totaldebetnb = $arr["JMLPREMI"];
  			$totaldebetob = 0;
  			$jnb++;
  			${"kdreknb".$cabas} = $arr["KDREKENINGLAWAN"];
  		}
  		elseif($kdkui=="OB")
  		{
  		  $premiob = $premitagihan;
  			$preminb = 0;

  			$totaldebetob = $arr["JMLPREMI"];
  			$totaldebetnb = 0;
  			$job++;
  			${"kdrekob".$cabas} = $arr["KDREKENINGLAWAN"];
  		}
			$PNG=new Klien($userid,$passwd,$arr["NOPENAGIHLAMA"]);
			
			
  	?>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$i;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=($prevcabas<>$arr["KDCABAS"] ? "<b>".$arr["KDCABAS"]."</b>" : "");?></td>
		<td nowrap style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PEMEGANGPOLIS"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$namabulan;?> <?=substr($bulancari,0,4);?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KDREKENINGLAWAN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$kdkui;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($premitagihan,2,",",".");?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$PNG->nama;?></td>
  </tr>
	<? 
	$i++;
	$jmltotaldebet += $arr["JMLPREMI"];
	$jmlpremi += $arr["PREMITAGIHAN"];
	${"jmlpreminb2".$cabas} += $preminb;
	${"jmlpremiob2".$cabas} += $premiob;
	$prevcabas = $arr["KDCABAS"];
	}

	?>
	<? 
	if(${"jmlpremiob2".$cabas}==0)
	{} else {
	?>
	<tr bgcolor="#f5d79c">
	 <td></td>
	 <td colspan="4"><b>JUMLAH <?=$cabas;?></b></td>
	 <td><?=${"kdrekob".$cabas};?></td>
	 <td>OB</td>
	 <td align="right"><?=number_format(${"jmlpremiob2".$cabas},2,",",".");?></td>
	 <td></td>
	</tr>
	<? 
	}
	
	if(${"jmlpreminb2".$cabas}==0)
	{} else {
	?>
	<tr bgcolor="#f5d79c">
	 <td></td>
	 <td colspan="4"></td>
	 <td><?=${"kdreknb".$cabas};?></td>
	 <td>NB</td>
	 <td align="right"><?=number_format(${"jmlpreminb2".$cabas},2,",",".");?></td>
	 <td></td>
	</tr>
	<? 
	}
	
	}
	?>
</table>
<br />

<!-------------Dolar--------------->
<?
$sql = "select distinct ".
		 	 		"(select kdcabas from $DBUser.tabel_202_produk where kdproduk=a.kdproduk) as cabas ".
			 "from ".
			    "$DBUser.tabel_300_historis_premi c,".
					"$DBUser.tabel_200_pertanggungan a,".
					"$DBUser.tabel_500_penagih b ".
			 "where ".
			    "a.prefixpertanggungan=c.prefixpertanggungan ".
					"and a.nopertanggungan=c.nopertanggungan ".
					"and a.nopenagih=b.nopenagih ".
					"and a.autodebet='1' ".
          "AND a.kdbank = 'MDR' ".						 					
					"and a.kdvaluta='3' ".
					"and b.kdrayonpenagih='$kantor' ".
					"and to_char(c.tglbooked,'YYYYMM')='".$bulancari."'";
	//echo $sql;
	$DB->parse($sql);
  $DB->execute();				
  $arr = $DB->result();	

?>
<b>Valuta Dolar</b>
<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
  <tr>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    NO</td>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Cabas</td>
		<td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    No. Polis</td>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Nama Pemb. Polis</td>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Bulan Tagihan</td>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    No.Rekening</td>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    OB/NB</td>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Jml. Premi</td>
    <td align="center" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    Penagih Lama</td>
  </tr>
	<? 
  foreach ($arr as $foo => $row ) {
	$cabas = $row["CABAS"];
	
	$sql = "select a.prefixpertanggungan,a.nopertanggungan,".
			 	    "(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) as pemegangpolis,".
				 	  "a.kdvaluta,d.kdcabas,".
						"a.norekeningdebet,a.kdbank,b.nopenagih,c.tglbooked,c.premitagihan,c.kdrekeningpremi,".
          	"c.kdrekeninglawan,substr(c.kdkuitansi,0,2) as kdkuitansi,c.tglseatled,c.tglbayar,".
          	"(select substr(keteranganmutasi,20,10) from $DBUser.tabel_600_historis_mutasi_pert ".
          	"where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan ".
          	"and substr(keteranganmutasi,length(keteranganmutasi)-15,16) like '%MANDIRI%') as nopenagihlama   ".					
         "from ".
           "$DBUser.tabel_300_historis_premi c,".
           "$DBUser.tabel_200_pertanggungan a,".
           "$DBUser.tabel_500_penagih b,".
           "$DBUser.tabel_202_produk d ".
         "where ".
           "a.prefixpertanggungan=c.prefixpertanggungan ".
           "and a.nopertanggungan=c.nopertanggungan ".
           "and a.kdproduk=d.kdproduk  ".
           "and a.autodebet='1' ".
           "AND a.kdbank = 'MDR' ".						 					 
					 "and a.kdvaluta='3' ".
           "and a.nopenagih=b.nopenagih  ".
           "and b.kdrayonpenagih='".$kantor."'  ".
           "and to_char(c.tglbooked,'YYYYMM')='".$bulancari."' ".
           "and d.kdcabas='".$cabas."' ".
         "order by d.kdcabas,c.kdkuitansi";
		//echo $sql."<br /><br />";
	  $DB->parse($sql);
	  $DB->execute();
	
  	$i=1;
  	$preminb = 0;
  	$premiob = 0;
  	$totaldebetnb = 0;
  	$totaldebetob = 0;
  	$jnb = 0;
  	$job = 0;
  	while ($arr=$DB->nextrow()) {
  	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	  $kdkui = substr($arr["KDKUITANSI"],0,2);
  		if($kdkui=="NB")
  		{
  		  $preminb = $arr["PREMITAGIHAN"];
  			$premiob = 0;

  			$totaldebetnb = $arr["JMLPREMI"];
  			$totaldebetob = 0;
  			$jnb++;
  			${"kdreknb".$cabas} = $arr["KDREKENINGLAWAN"];
  		}
  		elseif($kdkui=="OB")
  		{
  		  $premiob = $arr["PREMITAGIHAN"];
  			$preminb = 0;

  			$totaldebetob = $arr["JMLPREMI"];
  			$totaldebetnb = 0;
  			$job++;
  			${"kdrekob".$cabas} = $arr["KDREKENINGLAWAN"];
  		}
			$PNG=new Klien($userid,$passwd,$arr["NOPENAGIHLAMA"]);
  	?>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$i;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=($prevcabas<>$arr["KDCABAS"] ? "<b>".$arr["KDCABAS"]."</b>" : "");?></td>
		<td nowrap style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PEMEGANGPOLIS"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$namabulan;?> <?=substr($bulancari,0,4);?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KDREKENINGLAWAN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$kdkui;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["PREMITAGIHAN"],2,",",".");?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$PNG->nama;?></td>
  </tr>
	<? 
	$i++;
	$jmltotaldebet += $arr["JMLPREMI"];
	$jmlpremi += $arr["PREMITAGIHAN"];
	${"jmlpreminb3".$cabas} += $preminb;
	${"jmlpremiob3".$cabas} += $premiob;
	$prevcabas = $arr["KDCABAS"];
	}

	?>
	<? 
	if(${"jmlpremiob3".$cabas}==0)
	{} else {
	?>
	<tr bgcolor="#f5d79c">
	 <td></td>
	 <td colspan="4"><b>JUMLAH <?=$cabas;?></b></td>
	 <td><?=${"kdrekob".$cabas};?></td>
	 <td>OB</td>
	 <td align="right"><?=number_format(${"jmlpremiob3".$cabas},2,",",".");?></td>
	 <td></td>
	</tr>
	<? 
	}
	if(${"jmlpreminb3".$cabas}==0)
	{} else {
	?>
	<tr bgcolor="#f5d79c">
	 <td></td>
	 <td colspan="4"></td>
	 <td><?=${"kdreknb".$cabas};?></td>
	 <td>NB</td>
	 <td align="right"><?=number_format(${"jmlpreminb3".$cabas},2,",",".");?></td>
	 <td></td>
	</tr>
	<? 
	}
	
	}
	?>
</table>
<? 
echo "<hr size=1>";
					 echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a>";
?>
</body>
</html>
