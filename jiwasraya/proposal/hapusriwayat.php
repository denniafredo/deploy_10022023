<?
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
  $DB=New database($userid, $passwd, $DBName);	

	$qry="delete from $DBUser.tabel_117_umur_keluarga where noklien='$noklien' and kdhubungan='$hub'";
	$DB->parse($qry);
	$DB->execute();

	$sql="delete from $DBUser.tabel_116_riwayat_keluarga where noklien='$noklien' and kdhubungan='$hub'";
	$DB->parse($sql);
	$DB->execute();
	
	$qry="delete from $DBUser.tabel_117_umur_keluarga where noklien='$noklien' and kdhubungan='$hub'";
	$DB->parse($qry);
	$DB->execute();
		
	$DB->commit();
?>
<html>
<head>
<title>Untitled</title>
</head>
<? echo "<body onload=\"window.opener.location.replace('skk2.php?noproposal=".$p."');window.close()\">";
?>
</body>
</html>	