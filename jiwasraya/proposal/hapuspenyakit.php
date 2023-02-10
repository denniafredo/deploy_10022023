<?
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
  $DB=New database($userid, $passwd, $DBName);	
	$sql="delete from $DBUser.tabel_118_klien_penyakit where noklien='$noklien' and kodepenyakit='$kodepenyakit'";
	echo $p;
	$DB->parse($sql);
	$DB->execute();
	$DB->commit();
?>
<html>
<head>
<title>Untitled</title>
</head>
<? echo "<body onload=\"window.opener.location.replace('skk3b.php?noproposal=".$p."');window.close()\">";?>
</body>
</html>
