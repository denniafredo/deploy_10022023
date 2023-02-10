<?
  include "../../includes/database.php";	
  include "../../includes/session.php";
	include "../../includes/common.php";
	$DB = new Database($userid, $passwd, $DBName);
			 
	$sql = "select kdproduk,namaproduk ".
	       "from $DBUser.tabel_202_produk order by namaproduk";
	$DB->parse($sql);
	$DB->execute();
	//echo $sql; 
	?>
	<title>Daftar Produk</title>
  <link href="../jws.css" rel="stylesheet" type="text/css">
	<p><font face="Verdana" size="2">DAFTAR PRODUK</font></p>
  <table border="0" align="center" cellspacing="1" cellpadding="3">
  <tr>
    <td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">No.</font></td>
    <td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Kode Produk</font></td>
    <td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Nama Produk</font></td>
  </tr>
	<?
	$jmlpolis = 0;
	while($arr=$DB->nextrow()){
	$i = 0;
	$i = $count + 1;
	$jml = $arr["JUMLAH"];
  include "../../includes/belang.php";
		
  echo "  <td align=\"center\" class=verdana8blk>".$i."</td>";		
  echo "  <td align=\"center\" class=verdana8blk>".
	        "<a href=\"#\" onclick=\"javascript:".
		      "window.opener.document.updatekonversi.kdprodukbaru.value='".$arr["KDPRODUK"]."';".
		      "window.close();\" >".$arr["KDPRODUK"]."</a></td>";

  echo "  <td class=verdana8blk>".$arr["NAMAPRODUK"]."</td>";
  echo "</tr>";
	$count++;
	$jmlpolis += $jml;
	}
	echo "</table>";
		echo "<a href=\"#\" onclick=\"javascript:window.close();\"><font face=\"Verdana\" size=\"1\">CLOSE</font></a>";
?>
	