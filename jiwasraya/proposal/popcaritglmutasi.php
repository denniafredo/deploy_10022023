<?  
  include "../../includes/database.php";
  include "../../includes/session.php";
	$DB=New database($userid, $passwd, $DBName);
?>	
  <html><title>Tanggal Mutasi</title>
  <link href="../jws.css" rel="stylesheet" type="text/css">
	
	<body topmargin="0">
	<div align=center>
	<br>
	<b><font face="Verdana" size="2">Mutasi Polis No <?=$nopertanggungan;?></b></font><br>
  <?
	$sql = "select to_char(a.tglmutasi,'DD/MM/YYYY') tglmutasi,a.kdproduk from  ".
			 	 "$DBUser.tabel_603_mutasi_pert a ".
				 "where a.kdmutasi='21' and a.nopertanggungan='$nopertanggungan'";
				 //echo $sql;
	$DB->parse($sql);
	$DB->execute();
  ?>
	<table border="0" cellpadding="2" cellspacing="2" width="100%">
  <tr bgcolor="#cadcdf">
	<td class="verdana8blk">Tgl.Mutasi</td><td class="verdana8blk">Kode Produk</td>
	</tr>
	<?
	$i=0;
	while($arr=$DB->nextrow()) {
	  echo "<tr>";
		$a="<td class=verdana8blk><a href=\"#\" onclick=\"javascript:window.opener.document.clntmtc.tglmutasi.value='".$arr["TGLMUTASI"]."';window.close();\" >".$arr["TGLMUTASI"]."</a></td>".
    	 "<td class=verdana8blk>".$arr["KDPRODUK"]."</td>".
			 "</tr>";
	  echo($a);
		$i++;
	}
?>
</table>
</div>
</body>
</html>