<?
$myServer   = "danareksa";
$myUser 		= "sa";
$myPass 		= "siar";
$myDB				= "siar";
$s = mssql_connect($myServer, $myUser, $myPass) or die("Couldn't connect to SQL Server on $myServer");
$d = mssql_select_db($myDB, $s) or die("Couldn't open database $myDB");
?>