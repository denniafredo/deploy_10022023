<?
  include "../../includes/common.php";
  include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";	

$DB = new Database($userid, $passwd, $DBName);
$KL = new Klien ($userid,$passwd,$noklien);
$namaklien1=stripslashes($namaklien1);
$namaklien1=($namaklien1=='') ? $KL->nama : $namaklien1;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Melihat Jumlah Polis Yang Dimiliki oleh <?echo $KL->nama;?></title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<? include "../../includes/hide.php";  ?>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js" ></script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
</head>
<body>
<div align="center">
<form method="POST" name="ntryclnthub" action="<? echo $PHP_SELF;?>">
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" class="arial10">Nomor Klien</td>
		<td>:</td>
		<td><input class="a" type="text" name="noklien" size="10" maxlength="10" readonly value="<? echo $noklien;?>">
		</td>
	</tr>
  <tr>
    <td align="left" class="arial10">Nama Klien</td>
		<td>:</td>
		<td><input class="a" type="text" name="namaklien1" size="30" maxlength="30" readonly value="<? echo $namaklien1;?>"></td>
	</tr>
</table>

<table border="0" class="tblborder" cellspacing="1" cellpadding="1" width="100%" align="center">
  <tr>
    <td class="tblhead" align="center"><b>POLIS YANG DIMILIKI OLEH <?echo $KL->nama;?></td>
	</tr>
	<tr>
    <td class="tblisi" align="center">
		  <table  width="100%" border="0" cellspacing="0" cellpadding="0">
			 <tr class="hijao">
			  <td align="center">No</td>
			  <td align="center">Nomor<br>Polis</td>
			  <td align="center">Produk</td>
			  <td align="center">Status</td>
			 	<td align="center">Kartu<br>Premi</td>
			 	<td align="center">Kartu<br>Gadai</td>
			 </tr>
<?
$sql = "select prefixpertanggungan,nopertanggungan ".
		   "from $DBUser.tabel_200_pertanggungan ".
			 "where notertanggung='$noklien' and kdpertanggungan='2' ".
			 "order by prefixpertanggungan,nopertanggungan";
$DB->parse($sql);
$DB->execute();

$i=1;
while ($arr=$DB->nextrow()) {
$PER = New Pertanggungan ($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
include "../../includes/belang.php";
  print( "	<td class=arial8ungu align=\"center\" width=3%>$i</td>\n" );
  print( "	<td class=arial8ungu align=\"center\"><a href=\"#\"><a href=\"#\" onclick=\"NewWindow('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',700,500,1);\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>\n" );
  print( "	<td class=arial8ungu align=\"left\">".$PER->namaproduk."</td>\n" );
  print( "	<td class=arial8ungu align=\"center\">".$PER->namastatusfile."</td>\n" );
  print( "	<td class=arial8ungu align=\"center\"><a href=\"#\"><a href=\"#\" onclick=\"NewWindow('../akunting/kartupremi1.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',700,500,1);\">Lihat</a></td>\n" );
  print( "	<td class=arial8ungu align=\"center\"><a href=\"#\"><a href=\"#\" onclick=\"NewWindow('../akunting/kartugadai1.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',700,500,1);\">Lihat</a></td>\n" );
  print( " </tr>" );

$i++;
}			 
?>		  
			</table>
    </td>
   </tr>
</table>
<a href="#" onclick="window.close()" class="arial10">Close</a>		
</div>
</body>
</html>