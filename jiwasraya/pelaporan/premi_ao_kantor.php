<? 
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
  $DB=new database($userid, $passwd, $DBName);
	
	function DateSelector($inName, $useDate=0) { 
	$monthName=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"); 
	if ($useDate==0) { 
		$useDate=Time(); 
	} 
	// make year selector 
	print("<select name=".$inName."thn>\n"); 
	$startYear=date("Y", $useDate); 
	for ($currentYear=$startYear-5; $currentYear<=$startYear+5;$currentYear++) {
		print("<option value=\"$currentYear\""); 
		if (date("Y", $useDate)==$currentYear) { 
			print(" selected"); 
		} 
		print(">$currentYear\n"); 
	} 
	print("</select>"); 
 } 

?>	

<html>
<head>
<title>Untitled</title>
</head>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<body>
<a class="verdana10blk"><b>REKAP PENERIMAAN PREMI BP3 NEW UNIT LINK PER AREA OFFICE KANTOR <?=$kdkantor;?></b></a>
<hr size="1">
    <table>
    <form name="date" action="<? PHP_SELF ?>"> 
    <tr>
    <td class="verdana10blk">
		Periode
		<? 
		switch($awalxpr){
		  case "01": $a1="selected"; break;
			case "02": $a2="selected"; break;
			case "03": $a3="selected"; break;
			case "04": $a4="selected"; break;
			case "05": $a5="selected"; break;
			case "06": $a6="selected"; break;
			case "07": $a7="selected"; break;
			case "08": $a8="selected"; break;
			case "09": $a9="selected"; break;
			case "10": $a10="selected"; break;
			case "11": $a11="selected"; break;
			case "12": $a12="selected"; break;
		}
		switch($akhirxpr){
		  case "01": $b1="selected"; break;
			case "02": $b2="selected"; break;
			case "03": $b3="selected"; break;
			case "04": $b4="selected"; break;
			case "05": $b5="selected"; break;
			case "06": $b6="selected"; break;
			case "07": $b7="selected"; break;
			case "08": $b8="selected"; break;
			case "09": $b9="selected"; break;
			case "10": $b10="selected"; break;
			case "11": $b11="selected"; break;
			case "12": $b12="selected"; break;
		}
		 ?>
		<select name="awalxpr" size="1">
		  <option value="01" <?=$a1;?>>Januari</option>
			<option value="02" <?=$a2;?>>Februari</option>
			<option value="03" <?=$a3;?>>Maret</option>
			<option value="04" <?=$a4;?>>April</option>
			<option value="05" <?=$a5;?>>Mei</option>
			<option value="06" <?=$a6;?>>Juni</option>
			<option value="07" <?=$a7;?>>Juli</option>
			<option value="08" <?=$a8;?>>Agustus</option>
			<option value="09" <?=$a9;?>>September</option>
			<option value="10" <?=$a10;?>>Oktober</option>
			<option value="11" <?=$a11;?>>November</option>
			<option value="12" <?=$a12;?>>Desember</option>
		</select>
		S / D
		<select name="akhirxpr" size="1">
		  <option value="01" <?=$b1;?>>Januari</option>
			<option value="02" <?=$b2;?>>Februari</option>
			<option value="03" <?=$b3;?>>Maret</option>
			<option value="04" <?=$b4;?>>April</option>
			<option value="05" <?=$b5;?>>Mei</option>
			<option value="06" <?=$b6;?>>Juni</option>
			<option value="07" <?=$b7;?>>Juli</option>
			<option value="08" <?=$b8;?>>Agustus</option>
			<option value="09" <?=$b9;?>>September</option>
			<option value="10" <?=$b10;?>>Oktober</option>
			<option value="11" <?=$b11;?>>November</option>
			<option value="12" <?=$b12;?>>Desember</option>
		</select>
		<? DateSelector("v"); ?></td>
		<?
		echo "      <td class=\"verdana9blk\"> ";
echo "         <select size=1 name=kdkantor>";
echo "				 <option value=all>PILIH KANTOR</option>";
               $sql="select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdjeniskantor='2' order by kdkantor";
							 $DB->parse($sql);
							 $DB->execute();	
							 while($ro=$DB->nextrow()){
							       echo "<option ";
    								 if ($ro["KDKANTOR"]==$kdkantor){ echo " selected"; }
    								 echo " value=".$ro["KDKANTOR"].">".$ro["KDKANTOR"]." - ".$ro["NAMAKANTOR"]."</option>";
							 }
							 
echo "         </select>";							 	
echo "      </td>";?>
		 
		<td><input type="submit" value="CARI" name="cari"></td>
    </form> 
    </tr>
		</table>
		
<hr size="1">

<?
      
      switch ($awalxpr) {
         case "01":  $vbulanawal = "Januari"; break;
         case "02":  $vbulanawal = "Pebruari"; break;
         case "03":  $vbulanawal = "Maret"; break;
         case "04":  $vbulanawal = "April"; break;
         case "05":  $vbulanawal = "Mei"; break;
         case "06":  $vbulanawal = "Juni"; break;
         case "07":  $vbulanawal = "Juli"; break;
         case "08":  $vbulanawal = "Agustus"; break;
         case "09":  $vbulanawal = "September"; break;					
         case "10":  $vbulanawal = "Oktober"; break;
         case "11":  $vbulanawal = "Nopember"; break;
         case "12":  $vbulanawal = "Desember"; break;										
      }
      
      switch ($akhirxpr) {
         case "01":  $vbulan = "Januari"; break;
         case "02":  $vbulan = "Pebruari"; break;
         case "03":  $vbulan = "Maret"; break;
         case "04":  $vbulan = "April"; break;
         case "05":  $vbulan = "Mei"; break;
         case "06":  $vbulan = "Juni"; break;
         case "07":  $vbulan = "Juli"; break;
         case "08":  $vbulan = "Agustus"; break;
         case "09":  $vbulan = "September"; break;					
         case "10":  $vbulan = "Oktober"; break;
         case "11":  $vbulan = "Nopember"; break;
         case "12":  $vbulan = "Desember"; break;										
      }

		  $sql= "select ".
              "n.namaareaoffice,".
              "x.polisrp,x.premirp,x.juarp,".
              "y.polisrpi,y.premirpi,y.juarpi,".
              "z.polisusd,z.premiusd,z.juausd ".
            "from ".
              "$DBUser.tabel_410_area_office n,".
              "(select ".
            	"b.kdareaoffice,count(a.nopertanggungan) polisrp,".
            	"sum(a.premi1) as premirp,sum(a.juamainproduk) as juarp ".
              "from ".
              "$DBUser.tabel_300_historis_premi c,".
            	"$DBUser.tabel_200_pertanggungan a,".
            	"$DBUser.tabel_400_agen b ".
              "where ".
            	"a.prefixpertanggungan=c.prefixpertanggungan and ".
            	"a.nopertanggungan=c.nopertanggungan and ".
							"a.kdpertanggungan='2' and ".
            	"a.kdvaluta='1' and ".
            	"c.kdkuitansi='BP3' and ".
            	"a.noagen=b.noagen and ".
            	"b.kdkantor='$kdkantor' and a.kdproduk like 'JL2%' and ".
            	"a.mulas between to_date('$awalxpr$vthn','MMYYYY') and to_date('$akhirxpr$vthn','MMYYYY') ".
              "group by b.kdareaoffice) x,".
              "(select ".
            	"b.kdareaoffice,count(a.nopertanggungan) polisrpi,".
            	"sum(a.premi1) as premirpi,sum(a.juamainproduk) as juarpi ".
              "from ".
              "$DBUser.tabel_300_historis_premi c,".
            	"$DBUser.tabel_200_pertanggungan a,".
            	"$DBUser.tabel_400_agen b ".
              "where ".
            	"a.prefixpertanggungan=c.prefixpertanggungan and ".
            	"a.nopertanggungan=c.nopertanggungan and ".
							"a.kdpertanggungan='2' and ".
            	"a.kdvaluta='0' and ".
            	"c.kdkuitansi='BP3' and ".
            	"a.noagen=b.noagen and ".
            	"b.kdkantor='$kdkantor' AND a.kdproduk like 'JL2%' and ".
            	"a.mulas between to_date('$awalxpr$vthn','MMYYYY') and to_date('$akhirxpr$vthn','MMYYYY') ".
              "group by b.kdareaoffice) y,".
              "(select ".
            	"b.kdareaoffice,count(a.nopertanggungan) polisusd,".
            	"sum(a.premi1) as premiusd,sum(a.juamainproduk) as juausd ".
              "from ".
              "$DBUser.tabel_300_historis_premi c,".
            	"$DBUser.tabel_200_pertanggungan a,".
            	"$DBUser.tabel_400_agen b ".
              "where ".
            	"a.prefixpertanggungan=c.prefixpertanggungan and ".
            	"a.nopertanggungan=c.nopertanggungan and ".
							"a.kdpertanggungan='2' and ".
            	"a.kdvaluta='3' and ".
            	"c.kdkuitansi='BP3' and ".
            	"a.noagen=b.noagen and ".
            	"b.kdkantor='$kdkantor' AND a.kdproduk like 'JL2%' and ".
            	"a.mulas between to_date('$awalxpr$vthn','MMYYYY') and to_date('$akhirxpr$vthn','MMYYYY') ".
              "group by b.kdareaoffice) z ".
            "where ".
                "n.kdareaoffice=x.kdareaoffice(+) and ".
                "n.kdareaoffice=y.kdareaoffice(+) and ".
                "n.kdareaoffice=z.kdareaoffice(+) and ".
                "n.kdkantor='$kdkantor' ".
						"order by n.namaareaoffice";
				 $DB->parse($sql);
				 $DB->execute();
				 //echo "<br>".$sql."<br>";
				 echo "<a class=verdana10blk>Periode : <b> $vbulanawal s/d $vbulan Tahun $vthn</b></a><br>";
	    	?>
				<div align="center">
      	<table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#C0C0C0" id="AutoNumber1" width="100%">
        <tr>
          <td class="verdana8blk" rowspan="2" align="center" bgcolor="#D8E7FA">Nama Area Office</td>
          <td class="verdana8blk" colspan="3" align="center" bgcolor="#D8E7FA">Rupiah</td>
          <td class="verdana8blk" colspan="3" align="center" bgcolor="#D8E7FA">Rupiah Index</td>
          <td class="verdana8blk" colspan="3" align="center" bgcolor="#D8E7FA">US Dolar</td>
        </tr>
        <tr>
          <td class="verdana8blk" align="center" bgcolor="#D8E7FA">Premi</td>
          <td class="verdana8blk" align="center" bgcolor="#D8E7FA">JUA</td>
          <td class="verdana8blk" align="center" bgcolor="#D8E7FA">Polis</td>
          <td class="verdana8blk" align="center" bgcolor="#D8E7FA">Premi</td>
          <td class="verdana8blk" align="center" bgcolor="#D8E7FA">JUA</td>
          <td class="verdana8blk" align="center" bgcolor="#D8E7FA">Polis</td>
          <td class="verdana8blk" align="center" bgcolor="#D8E7FA">Premi</td>
          <td class="verdana8blk" align="center" bgcolor="#D8E7FA">JUA</td>
          <td class="verdana8blk" align="center" bgcolor="#D8E7FA">Polis</td>
        </tr>
				<?
				$i=1;
				while ($arr=$DB->nextrow()) {
				$premirp  = $arr["PREMIRP"];
				$juarp		= $arr["JUARP"];
				$polisrp	= $arr["POLISRP"];
				$premirpi = $arr["PREMIRPI"];
				$juarpi		= $arr["JUARPI"];
				$polisrpi	= $arr["POLISRPI"];
				$premiusd = $arr["PREMIUSD"];
				$juausd		= $arr["JUAUSD"];
				$polisusd	= $arr["POLISUSD"];
				echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "dddddd").">";
				?>
          <td class="verdana8blk"><?=$arr["NAMAAREAOFFICE"];?></td>
          <td class="verdana8blk" align="right"><?=number_format($arr["PREMIRP"],2,",",".");?></td>
          <td class="verdana8blk" align="right"><?=number_format($arr["JUARP"],2,",",".");?></td>
          <td class="verdana8blk" align="right"><?=$arr["POLISRP"];?></td>
          <td class="verdana8blk" align="right"><?=number_format($arr["PREMIRPI"],2,",",".");?></td>
          <td class="verdana8blk" align="right"><?=number_format($arr["JUARPI"],2,",",".");?></td>
          <td class="verdana8blk" align="right"><?=$arr["POLISRPI"];?></td>
          <td class="verdana8blk" align="right"><?=number_format($arr["PREMIUSD"],2,",",".");?></td>
          <td class="verdana8blk" align="right"><?=number_format($arr["JUAUSD"],2,",",".");?></td>
          <td class="verdana8blk" align="right"><?=$arr["POLISUSD"];?></td>
        </tr>
				<?
				$totalpremirp+=$premirp;
				$totaljuarp+=$juarp;
				$totalpolisrp+=$polisrp;
				$totalpremirpi+=$premirpi;
				$totaljuarpi+=$juarpi;
				$totalpolisrpi+=$polisrpi;
				$totalpremiusd+=$premiusd;
				$totaljuausd+=$juausd;
				$totalpolisusd+=$polisusd;
				$i++;
				}
				?>
				<tr bgcolor="#d9dfe8">
          <td class="verdana8blk" align="center">JUMLAH</td>
          <td class="verdana8blk" align="right"><?=number_format($totalpremirp,2,",",".");?></td>
          <td class="verdana8blk" align="right"><?=number_format($totaljuarp,2,",",".");?></td>
          <td class="verdana8blk" align="right"><?=$totalpolisrp;?></td>
          <td class="verdana8blk" align="right"><?=number_format($totalpremirpi,2,",",".");?></td>
          <td class="verdana8blk" align="right"><?=number_format($totaljuarpi,2,",",".");?></td>
          <td class="verdana8blk" align="right"><?=$totalpolisrpi;?></td>
          <td class="verdana8blk" align="right"><?=number_format($totalpremiusd,2,",",".");?></td>
          <td class="verdana8blk" align="right"><?=number_format($totaljuausd,2,",",".");?></td>
          <td class="verdana8blk" align="right"><?=$totalpolisusd;?></td>
        </tr>
      </table>

<br>
</div>
<hr size="1">
<a href="index.php"><font face="Verdana" size="2">Menu Pelaporan</font></a>&nbsp;&nbsp;&nbsp;&nbsp;
</body>
</html>
