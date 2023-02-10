<?  
  include "../../includes/database.php";
  include "../../includes/session.php";
	include "../../includes/klien.php";
	$DB=New database($userid, $passwd, $DBName);
?>	
  <html><title>Klien Polis No. <?=$prefixpertanggungan."-".$nopertanggungan;?></title>
  <link href="../jws.css" rel="stylesheet" type="text/css">
	
	<body topmargin="0">
	<div align=center>
	
	<?
	$sql = "select notertanggung from  ".
			 	 "$DBUser.tabel_200_pertanggungan ".
				 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
				 //echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$kln=$DB->nextrow();
	$noklien=$kln["NOTERTANGGUNG"];
	
	
	
	$sqa="select a.noklieninsurable,a.kdhubungan,b.namaklien1 ".
	     "from $DBUser.tabel_100_klien b, $DBUser.tabel_113_insurable a ".
	     "where a.notertanggung='$noklien' and a.noklieninsurable=b.noklien(+)";
	//echo $sqa;
	$DB->parse($sqa);
	$DB->execute();
	$insurable=$DB->result();
	
	$sql="select kdhubungan,namahubungan from $DBUser.tabel_218_kode_hubungan";
	$DB->parse($sql);
	$DB->execute();		
	$result=$DB->result();
	?>
	
  <b><font face="Verdana" size="2">Insurable Polis No <?=$prefixpertanggungan."-".$nopertanggungan;?> Tertanggung No. <?=$noklien;?></b></font><br>
    	
  <table border="0" width="100%" cellspacing="1" cellpadding="0" align="center" class="tblisi">
   <tr class="hijao"> 
  	<td align="center">No.</td>
    <td align="center">No. Klien</td>
    <td align="center">Nama Klien</td>
    <td align="center">Jenis Hubungan</td>
    <td align="center">Umur</td>
   </tr>	
  <? 
    $i=1;
  	//while ($arr=$DB->nextrow()) {
  	foreach ($insurable as $foo => $val) {
  	  include "../../includes/belang.php";
  		$noklieninsurable = $val["NOKLIENINSURABLE"];
  		$kdhubungan = $val["KDHUBUNGAN"];
  		$KL=new Klien($userid,$passwd,$noklieninsurable);
  		echo("<td class=\"arial10\" align=\"right\">".$i.".</td>");
  		echo("<td class=\"arial10\" align=\"center\"><a href=\"#\" onclick=\"javascript:window.opener.document.clntmtc.klienno.value='".$noklieninsurable."';window.close();\" >".$noklieninsurable."</a></td>"); 
  		echo("<td class=\"arial10\" align=\"left\">".$val["NAMAKLIEN1"]."</td>"); 
  		echo("<td class=\"arial10\" align=\"left\">");
  		foreach($result as $coo => $data) {
    	  if ($val["KDHUBUNGAN"]==$data["KDHUBUNGAN"]) {
  		    echo($data["NAMAHUBUNGAN"]);
  	    } 
  		}
  		echo("</td>"); 
  		echo("<td class=\"arial10\" align=\"center\">".$KL->Umur()." th, ".$KL->Umurbl()." bl</td>"); 
  		echo("</tr>");
  		$i++;
  	}
  
  ?>  
  </table>
 
</div>
</body>
</html>