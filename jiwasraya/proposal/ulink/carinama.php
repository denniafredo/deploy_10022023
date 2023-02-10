<?
  include "includes/session.php";
	include "includes/database.php";
	include "includes/klien.php";
	$DB=new database($userid, $passwd, $DBName);	
	$KL=New Klien($userid,$passwd,$noklien);				
	$nama=ereg_replace("'","`",$KL->nama);
?>
<br>
<html>
<head>
<title>Untitled</title>
</head>
<?
$namahalaman = (!$namahalaman) ? "ntryclnthub" : $namahalaman;
$htm="<body onload=\"window.opener.document.".$namahalaman.".namaklien1.value='".$nama."';".
     "window.close()".
		 "\">";
echo $htm;
?>
</body>
</html>
