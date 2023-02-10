<?
 include "../../includes/session.php";
include "../../includes/database.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<?

$DB=New database($userid, $passwd, $DBName);
$Query="select count(noagen) x from $DBUser.tabel_400_agen where noagen='$noagen'";

$DB->parse($Query);
	  $DB->execute();
	  $row=$DB->nextrow();
	  
if ($row["x"]==0) {
?>	
	<script language="JavaScript" type="text/javascript">
	//window.opener.document.frm.simpanpst.disabled=true;
	</script>
<?
//echo "Premi Salah...";
echo $Query;
//echo $row["noagen"];
				
die;}
else{
?>
	<script language="JavaScript" type="text/javascript">
	//window.opener.document.frm.ua.value='<?=$nilua;?>';
	//window.opener.document.frm.undian.value='<?=$undi;?>';
	//window.opener.document.frm.simpanpst.disabled=false;
	//window.close();
	</script>
	
<?
ECHO "DONE";
}
?>
<body>
</body>
</html>
