<?php
$hostmysql = "smsgw.ifg-life.id";
$username = "root";
$password = "p4ss!@#$";
$database = "ifgsms";

//$hostmysql = "localhost";
//$username = "root";
//$password = "";
//$database = "test";

$conn = mysql_connect($hostmysql,$username,$password);
if (!$conn) die ("Koneksi gagal");
mysql_select_db($database,$conn) or die ("Database tidak ditemukan"); 

?>
