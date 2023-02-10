<?php
include "../../includes/database.php";
$userid = "jsadm";
$passwd = "jsadmoke";
$DB=new database($userid, $passwd, $DBName);		


$sql="select PIC_URL,REDAKSI from EMAIL_BLAST_EVENT where ID_BLAST = '".$_GET['idblast']."'";	  
	$DB->parse($sql);
    $DB->execute();
	//echo $sql;	

	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN"
"http://www.w3.org/TR/REC-html40/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title></title>
</head>
<body style="font-family:Arial;font-size:14px">
<p>
<!--img height="797" width="583" src="iklan1.jpg"-->
<?php
while ($row=$DB->nextrow()) {
?>
<p align="center">
<img height="797" width="583" src="<?=$row["PIC_URL"];?>">
</p>
<p align="center">
<?=$row["REDAKSI"];?>
</p>
<?php
}
?>
</body>
</html>