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
	
 <td>Bulan</td> 
 <td><?  ShowFromDate(10,"Past"); ?></td>
 <td colspan="2"><input type="submit" name="submit" value="Cari"</input></td>
 </tr>
</table>
</form>
</div>
<?
if($metodebayar=="MDR"){
	   $filterpenagih = "MANDIRI";
		 $titletrans		= "AUTO DEBET MANDIRI";
		 $filtermetode	= "and a.autodebet='1' and a.kdbank = '".$metodebayar."' ";
	} elseif($metodebayar=="BNI"){
	   $filterpenagih = "BNI";
		 $titletrans		= "AUTO DEBET BNI";
		 $filtermetode	= "and a.autodebet='1' and a.kdbank = '".$metodebayar."' ";
	} elseif($metodebayar=="CTB"){
	   $filterpenagih = "CITIBANK";
		 $titletrans		= "CITIBANK 1BILL";
		 $filtermetode	= "and a.autodebet='1' and a.kdbank = '".$metodebayar."' ";
	} elseif($metodebayar=="BNI"){
	   $filterpenagih = "POS";
		 $titletrans		= "PT. POS INDONESIA";
		 $filtermetode	= "";
	} else {
	   $filterpenagih = "TRANSFER";
		 $titletrans		= "TRANSFER REK. HO";
		 $filtermetode	= "";
		 //$filtermetode	= "and a.autodebet='2' ";
	}
?>
<b>DAFTAR TAGIHAN PREMI JS.LINK (<?=$produk;?>) <?=$titletrans;?> BULAN <?=$namabulan." ".$year;?> <?=$KTR->namakantor;?> </b>
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
					$filtermetode.
					//"and a.kdvaluta='1' and a.kdbank = '".$metodebayar."' ".
					"and b.kdrayonpenagih='".$kdkantor."'".
					"and substr(a.kdproduk,1,3)='".$produk."' ".
					"and to_char(c.tglbooked,'YYYYMM')='".$bulancari."'";
	//echo $sql;
	$DB->parse($sql);
  $DB->execute();				
  $arr = $DB->result();	
	
  foreach ($arr as $foo => $row ) {
	$cabas = $row["CABAS"];
	
	$sql = "select a.prefixpertanggungan,a.nopertanggungan,".
			 	    "(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) as pemegangpolis,".
				 	  "a.kdvaluta,d.kdcabas,".
						"a.norekeningdebet,a.kdbank,b.nopenagih,c.tglbooked,c.premitagihan,c.kdrekeningpremi,".
          	"c.kdrekeninglawan,substr(c.kdkuitansi,0,2) as kdkuitansi,c.tglseatled,c.tglbayar,".
          	"(select substr(keteranganmutasi,20,10) from $DBUser.tabel_600_historis_mutasi_pert ".
          	"where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan ".
          	"and substr(keteranganmutasi,length(keteranganmutasi)-15,16) like '%".$filterpenagih."%') as nopenagihlama   ".					
         "from ".
           "$DBUser.tabel_300_historis_premi c,".
           "$DBUser.tabel_200_pertanggungan a,".
           "$DBUser.tabel_500_penagih b,".
           "$DBUser.tabel_202_produk d ".
         "where ".
           "a.prefixpertanggungan=c.prefixpertanggungan ".
           "and a.nopertanggungan=c.nopertanggungan ".
           "and a.kdproduk=d.kdproduk  ".
					 "and a.kdvaluta='1' ".
					 $filtermetode.
           //"and a.autodebet='1' and a.kdbank = '".$metodebayar."' ".						 
           "and a.nopenagih=b.nopenagih  ".
					 "and substr(a.kdproduk,1,3)='".$produk."' ".
           "and b.kdrayonpenagih='".$kdkantor."'  ".
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

<? 
echo "<hr size=1>";
					 echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a>";
?>
</body>
</html>
