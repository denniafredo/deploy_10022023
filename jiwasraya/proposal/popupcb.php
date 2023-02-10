<?
  include "../../includes/database.php";
  include "../../includes/session.php";
	$DB=New Database($userid,$passwd);
	
	$sql="select a.kdcarabayar,b.namacarabayar ".
			 "from $DBUser.tabel_233_produk_cara_bayar a, $DBUser.tabel_305_cara_bayar b ".
			 "where a.kdproduk='$kdproduk' and a.kdcarabayar=b.kdcarabayar";
  $DB->parse($sql);	
  $DB->execute();
?>
<html>
<head>
<title></title>
<script language="JavaScript">
function SendValue(val) {
  window.opener.propmtc11.kdcarabayar.value=var;
	window.close();
} 
</script>
</head>
<body>
<?
while ($arr=$DB->nextrow()) {
  printf("<a href=\"#\" onclick=\"javascript:SendValue(%s);\">%s</a> %s",$arr["KDCARABAYAR"],$arr["KDCARABAYAR"],$arr["NAMACARABAYAR"]);
}
?>
</body>
</html>
