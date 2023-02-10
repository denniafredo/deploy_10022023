<? 
include "../../includes/session.php"; 
include "../../includes/database.php"; 
include "../../includes/kantor.php";
include "../../includes/klien.php";
	
$DB=new database($userid, $passwd, $DBName);
$DBA=new database($userid, $passwd, $DBName);
$KTR=new Kantor($userid,$passwd,$kdkantor);
	
function DateSelector($inName, $useDate=0) 
{ 
          if($useDate == 0) 
          { 
              $useDate = Time(); 
          } 
  
      		// Tanggal
/*      		$selected	= (isset($_POST[$inName.'tgl']) && $_POST[$inName.'tgl']!='') ? $_POST[$inName.'tgl'] : date( "j", $useDate);
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
*/  
  
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
<title>Summary Produksi</title>
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
<?
	if ($mode=='print'){
		echo "<body onload=\"window.print();window.close()\">";
//		echo "<body>";
	}
	else{
		echo "<body>";
?>

<div id="filterbox">
<form name="getpremi" action="<?=$PHP_SELF;?>" method="post">
  <table>
	<tr>

  <td>Valuta</td>
	<td>
	  <? 
		switch($valuta)
		{
		  case '1': $va = "selected"; break;
		  case '0': $vb = "selected"; break;
		  case '3': $vc = "selected"; break;
			default : $va = "selected"; break;
		}
		?>
	  <select name="valuta">
	  <option value="1" <?=$va;?>>Valuta Rupiah Tanpa Indeks</option>
	  <option value="0" <?=$vb;?>>Valuta Rupiah Dengan Indeks</option>
	  <option value="3" <?=$vc;?>>Valuta Dollar Amerika Serikat</option>
	</select></td>
<!--
  <td>Pemb.</td>
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
-->

 <td>Dari</td><td><?=DateSelector("d"); ?></td><td>Sampai</td><td><?=DateSelector("s"); ?></td>
 <td colspan="2"><input type="submit" name="submit" value="Cari"</input></td>
 </tr>
</table>
</form>
</div>
<?
}
?>

<?
	$tglawal .= $dthn;
	$tglawal .= ((strlen($dbln)==1) ? '0'.$dbln : $dbln);
//	$tglawal .= ((strlen($dtgl)==1) ? '0'.$dtgl : $dtgl);
	
	$tglakhir .= $sthn;
	$tglakhir .= ((strlen($sbln)==1) ? '0'.$sbln : $sbln);
//	$tglakhir .= ((strlen($stgl)==1) ? '0'.$stgl : $stgl);


  if($valuta=="0"){
		  $filterkantor = "";
	}	else	{
		  $filterkantor = "c.kdrayonpenagih='$kdkantor' and ";
	}
  switch($valuta)
  {
    case '0': $namavaluta = "VALUTA RUPIAH DENGAN INDEKS (IDX)"; break;
    case '1': $namavaluta = "VALUTA RUPIAH TANPA INDEKS (IDR)"; break;
    case '3': $namavaluta = "VALUTA DOLLAR AMERIKA SERIKAT (USD)"; break;
  }
	
	
?>
<div align="center">
<b>SUMMARY PRODUKSI BRANCH OFFICE<br /><?=$tglawal." s/d ".$tglakhir;?><br /><br /> </b>
</div> 
<!--------------  start Rupiah --------------->
<? 
$sql = "select ".
            "distinct s.kdrayonpenagih as kdkantor ".
    				"FROM $DBUser.tabel_202_produk p, ".
         		"(SELECT   COUNT (a.prefixpertanggungan || a.nopertanggungan)jmlpolis,sum(a.premi1)totalpremi, ".
                  "sum(a.juamainproduk)totaljua, ".
                  "a.kdproduk, a.kdvaluta, b.kdrayonpenagih, k.namakantor ".
              "FROM $DBUser.tabel_200_pertanggungan a, ".
                  "$DBUser.tabel_500_penagih b, ".
                  "$DBUser.tabel_001_kantor k ".
              "WHERE a.nopenagih = b.nopenagih AND TO_CHAR(a.mulas,'YYYYMM') between '$tglawal' and  '$tglakhir' ".
              		"AND a.kdpertanggungan='2' ".
//									"AND a.kdstatusfile='1' ".
              		"AND b.kdrayonpenagih = k.kdkantor ".
//              		"AND b.kdrayonpenagih in ('AE','DK') ".
              		"AND a.kdvaluta = '$valuta' ".
          		"GROUP BY b.kdrayonpenagih, k.namakantor, a.kdproduk, a.kdvaluta) s ".
   					"WHERE p.status IS NULL AND p.kdproduk = s.kdproduk ".
  				"ORDER BY s.kdrayonpenagih";
	//echo $sql;
	$DB->parse($sql);
  $DB->execute();				
	$ars=$DB->nextrow();
	$ono = $ars["KDKANTOR"];
	
if($ono!="")
{	

$sql = "select ".
            "distinct s.kdrayonpenagih as kdkantor,s.namakantor ".
    				"FROM $DBUser.tabel_202_produk p, ".
         		"(SELECT   COUNT (a.prefixpertanggungan || a.nopertanggungan)jmlpolis,sum(a.premi1)totalpremi, ".
                  "sum(a.juamainproduk)totaljua, ".
                  "a.kdproduk, a.kdvaluta, b.kdrayonpenagih, k.namakantor ".
              "FROM $DBUser.tabel_200_pertanggungan a, ".
                  "$DBUser.tabel_500_penagih b, ".
                  "$DBUser.tabel_001_kantor k ".
              "WHERE a.nopenagih = b.nopenagih AND TO_CHAR(a.mulas,'YYYYMM') between '$tglawal' and  '$tglakhir' ".
              		"AND a.kdpertanggungan='2' ".
//									"AND a.kdstatusfile='1' ".
              		"AND b.kdrayonpenagih = k.kdkantor ".
//              		"AND b.kdrayonpenagih in ('AE','DK') ".
              		"AND a.kdvaluta = '$valuta' ".
          		"GROUP BY b.kdrayonpenagih, k.namakantor, a.kdproduk, a.kdvaluta) s ".
   					"WHERE p.status IS NULL AND p.kdproduk = s.kdproduk ".
  				"ORDER BY s.kdrayonpenagih";
						//echo $sql;
	$DB->parse($sql);
  $DB->execute();				
  $arr = $DB->result();	

?>
<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
  <tr>
    <td bgcolor="#89acd8" align="center" colspan="6"><b><?=$namavaluta;?></b></td>
  </tr>
  <tr>
    <td bgcolor="#89acd8" align="center"><b>Kode Kantor</b></td>
    <td bgcolor="#89acd8" align="center"><b>Nama Kantor</b></td>
		<td bgcolor="#89acd8" align="center"><b>Produk</b></td>
    <td bgcolor="#89acd8" align="center"><b>Total Polis</b></td>
    <td bgcolor="#89acd8" align="center"><b>Total Premi</b></td>
    <td bgcolor="#89acd8" align="center"><b>Total JUA</b></td>
  </tr>
	<? 
   foreach ($arr as $foo => $row ) {
   $kdkantor = $row["KDKANTOR"];
	 $namakantor = $row["NAMAKANTOR"];
	
   $sql = "SELECT p.kdproduk, p.namaproduk,s.kdvaluta, p.kdcabas, s.jmlpolis, s.totalpremi, ".
   			  			"s.totaljua, s.kdrayonpenagih as kdkantor,s.namakantor ".
    				"FROM $DBUser.tabel_202_produk p, ".
         		"(SELECT   COUNT (a.prefixpertanggungan || a.nopertanggungan)jmlpolis,sum(a.premi1)totalpremi, ".
                  "sum(a.juamainproduk)totaljua, ".
                  "a.kdproduk, a.kdvaluta, b.kdrayonpenagih, k.namakantor ".
              "FROM $DBUser.tabel_200_pertanggungan a, ".
                  "$DBUser.tabel_500_penagih b, ".
                  "$DBUser.tabel_001_kantor k ".
              "WHERE a.nopenagih = b.nopenagih AND TO_CHAR(a.mulas,'YYYYMM') between '$tglawal' and  '$tglakhir' ".
              		"AND a.kdpertanggungan='2' ".
//									"AND a.kdstatusfile='1' ".
              		"AND b.kdrayonpenagih = k.kdkantor ".
              		"AND b.kdrayonpenagih = '$kdkantor' ".
              		"AND a.kdvaluta = '$valuta' ".
          		"GROUP BY b.kdrayonpenagih, k.namakantor, a.kdproduk, a.kdvaluta) s ".
   					"WHERE p.status IS NULL AND p.kdproduk = s.kdproduk ".
  				"ORDER BY s.kdrayonpenagih,s.kdvaluta,p.namaproduk";
					
		//echo $sql."<br /><br />";
	  $DB->parse($sql);
	  $DB->execute();
	
  	$i=1;
  	while ($arr=$DB->nextrow()) {
	
  	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	?>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=($prevkdkantor<>$arr["KDKANTOR"] ? "<b>".$arr["KDKANTOR"]."</b>" : "");?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=($prevnamakantor<>$arr["NAMAKANTOR"] ? "<b>".$arr["NAMAKANTOR"]."</b>" : "");?></td>
<!--		<td nowrap style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?></td> -->
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KDPRODUK"];?> - <?=$arr["NAMAPRODUK"];?></td> 
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=number_format($arr["JMLPOLIS"],0,",",".");?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["TOTALPREMI"],2,",",".");?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["TOTALJUA"],2,",",".");?></td>

  </tr>
	<? 
	$i++;
	$jmltotalpolis += $arr["JMLPOLIS"];
	$jmltotalpremi += $arr["TOTALPREMI"];
	$jmltotaljua += $arr["TOTALJUA"];
	${"jmltotalpoliskantor".$kdkantor} += $arr["JMLPOLIS"];
	${"jmltotalpremikantor".$kdkantor} += $arr["TOTALPREMI"];
	${"jmltotaljuakantor".$kdkantor} += $arr["TOTALJUA"];
	
	$prevkdkantor = $arr["KDKANTOR"];
	$prevnamakantor = $arr["NAMAKANTOR"];
	}

	?>
	<tr bgcolor="#f5d79c">
	 <td></td>
	 <td colspan="2"><b>JUMLAH <?=$kdkantor." - ".$namakantor;?></b></td>
	 <td align="center"><b><?=number_format(${"jmltotalpoliskantor".$kdkantor},0,",",".");?></b></td>
	 <td align="right"><b><?=number_format(${"jmltotalpremikantor".$kdkantor},2,",",".");?></b></td>
	 <td align="right"><b><?=number_format(${"jmltotaljuakantor".$kdkantor},2,",",".");?></b></td>
	</tr>
	<? 
	}
	?>
	<tr bgcolor="#f5d79c">
	 <td></td>
	 <td colspan="2"><b>JUMLAH <?=$namavaluta;?></b></td>
	 <td align="center"><b><?=number_format($jmltotalpolis,0,",",".");?></b></td>
	 <td align="right"><b><?=number_format($jmltotalpremi,2,",",".");?></b></td>
	 <td align="right"><b><?=number_format($jmltotaljua,2,",",".");?></b></td>
	</tr>
</table>
<!-----------------------  end rupiah -------------------------->
<br />

<?	
}
if ($mode!='print'){

echo("<font face=Verdana size=1><a href=\"index.php\">Menu Pelaporan</a></font>");
echo("<font face=Verdana size=1>&nbsp;&nbsp;|&nbsp;&nbsp;</font>");
echo("<font face=Verdana size=1><a href=\"#\" onclick=\"window.open('hasil_jl2.php?kdkantor=".$kdkantor."&metodebayar=".$metodebayar."&dtgl=".$dtgl."&dbln=".$dbln."&dthn=".$dthn."&stgl=".$stgl."&sbln=".$sbln."&sthn=".$sthn."&mode=print','','width=1000,height=600,top=100,left=100,scrollbars=yes');\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak Lampiran</a></font>");

}

?>

</body>
</html>
