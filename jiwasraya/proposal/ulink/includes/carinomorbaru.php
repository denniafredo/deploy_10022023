<?
  include "../../includes/session.php";
	include "../../includes/database.php";
	//$DB=new Database("JSADM","JSADM","JSDB10");	
	$DB=new database($userid, $passwd, $DBName);
	
  $prefix=strtoupper($prefix);
	$nopert=strtoupper($nopert);
  //	  echo $prefix."-".$nopert." : ".$jnscari."<br>";
	
	if($jnscari=="OTON"){
	  $sql = "select a.prefixpertanggungan,a.nopertanggungan ".
		  	   "from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_500_penagih b ".
			   	 "where b.nopenagih=a.nopenagih and b.kdrayonpenagih='$kantor' and ".
				   "a.nopol='$nopert'";
  } else {
		$sql = "select a.prefixpertanggungan,a.nopol as nopertanggungan ".
		  	   "from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_500_penagih b ".
			   	 "where b.nopenagih=a.nopenagih and b.kdrayonpenagih='$kantor' and ".
				   "a.prefixpertanggungan='$prefix' and a.nopertanggungan='$nopert'";
	}
	//	echo $sql;			 
  $DB->parse($sql);
	$DB->execute();			
	if(!$arr=$DB->nextrow()){
	 echo "<title>Cari Nomor Pertanggungan Baru</title>";
	 echo "<div align=center>";
	 echo "<h3>Nomor Polis $nopert di kantor $kantor<br><br>tidak ditemukan !</h3>";
	 echo "<a href=\"javascript:window.close()\">CLOSE</a>";
	 echo "<div>";
	} else {
	echo "Tunggu! Sedang proses ....";
	$prefix = $arr["PREFIXPERTANGGUNGAN"]; 
	$nopertbaru = $arr["NOPERTANGGUNGAN"];
?>
<br>
<html>
<head>
<title>Cari Nomor Pertanggungan Baru</title>
</head>
<?
$htm="<body onload=\"window.opener.document.clntmtc.prefix.value='".$prefix."';".
     "window.opener.document.clntmtc.nopertanggungan.value='".$nopertbaru."';".
     "window.close()".
		 "\">";
echo $htm;
}
?>
</body>
</html>
