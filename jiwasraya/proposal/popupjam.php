<?
  include "../../includes/database.php";
  include "../../includes/session.php";
	$DB=New database($userid, $passwd, $DBName);
	$sql="select a.kdproduk,a.kdbenefit,b.namabenefit ".
	     "from $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b ".
			 "where a.kdbenefit=b.kdbenefit and a.kdproduk='$kdproduk' and a.kdjenisbenefit='R' and a.kdbenefit like '$kdbenefit'";
	$DB->parse($sql);
	$DB->execute();
	$result=$DB->result();
?>
<title>Jaminan Tambahan</title>
<html>
<body topmargin="0">
<table width="100%">
<tr><td align="right"><font face="Verdana" size="2" color="#0033CC">F1421</font></td></tr>
</table>
<form name="popupjam" method="POST" action=<? PHP_SELF; ?>>
<font face="Verdana" size="2">Search JT : </font><input type="text" name="kdbenefit" size="10">
  <input type="submit" name="search" value="Search">
<br><br>
<?
reset($result);
foreach($result as $foo => $arr){
  printf("<font face=\"Verdana\" size=\"2\"><a href=\"#\" onclick=\"javascript:window.opener.document.propbnft.kdproduk.value='%s';window.opener.document.propbnft.kdbenefit.value='%s';window.opener.document.propbnft.namabenefit.value='%s';window.close();\" >%s</a>   %s</font><br>",$arr["KDPRODUK"],$arr["KDBENEFIT"],$arr["NAMABENEFIT"],$arr["KDBENEFIT"],$arr["NAMABENEFIT"]);
}		 
?>
</body>
</form>
</html>
