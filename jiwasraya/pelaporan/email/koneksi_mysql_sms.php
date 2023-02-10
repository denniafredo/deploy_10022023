<?php
$hostmysql = "192.168.1.5";
$username = "root";
$password = "p4ss!@#$";
$database = "ifgsms";

$userid="jsadm";
$passwd="jsdeploy";

/*$hostmysql = "localhost";
$username = "root";
$password = "";
$database = "test";*/
$conn = mysql_connect($hostmysql,$username,$password);
if (!$conn) die ("Koneksi gagal");
mysql_select_db($database,$conn) or die ("Database tidak ditemukan"); 
?>
