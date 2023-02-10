<?

$myServer = "192.168.4.24";
$myUser = "sa";
$myPass = "jshcmis01";
$myDB = "JSBANK"; 

//connection to the database
$dbhandle = mssql_connect($myServer, $myUser, $myPass)
  or die("Couldn't connect to SQL Server on $myServer"); 

//select a database to work with
$selected = mssql_select_db($myDB, $dbhandle)
  or die("Couldn't open database $myDB"); 

	/*$qMenu = "SELECT * FROM SUB_MENU A INNER JOIN MENU B ON A.KD_MENU=B.KD_MENU"; 
	$qMenu .= " WHERE KD_SUB_MENU='$kodesubmenu'";
	$rMenu = mssql_query($qMenu);
	$row = mssql_fetch_array($rMenu);
	$namamenu=$row["NM_MENU"];
	$kodemenu=$row["KD_MENU"];
	$namasubmenu=$row["NM_SUB_MENU"];
	$link=$row["LINK"];*/
?>