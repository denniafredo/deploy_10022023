<?
  include "../../includes/common.php";
  include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";	

$DB = new Database($userid, $passwd, $DBName);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Melihat Pertanggungan Yang Tidak Lengkap</title>
<link href="../../includes/new.css" rel="stylesheet" type="text/css">
<? include "../../includes/hide.php";  ?>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js" ></script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
</head>
<body>
<div align="center">
<form method="POST" name="ntryclnthub" action="<? echo $PHP_SELF;?>">
<table border="0" cellpadding="0" cellspacing="0" width="800" class="color-tabletrim">
	<tr>
		<td>
		<table border="0" cellpadding="2" cellspacing="1" width="100%" class="color-tabletrim">
		<thead>
				<tr class="color-tableheader">
					 <td height="20" colspan="7" width="100%">
					   <strong class="titlerev">Polis dengan Agen Kosong</strong>
					 </td>
				</tr>
		</thead>
		<tr class="color-columnheaders">
     <th scope="col" height="20" nowrap><font class="datasheetField">Jenis</font></th>
     <th scope="col" height="20" nowrap><font class="datasheetField">Nomor Lama</font></th>
     <th scope="col" height="20" nowrap><font class="datasheetField">Nomor Baru</font></th>
     <th scope="col" height="20" nowrap><font class="datasheetField">Pemegang Polis</font></th>
     <th scope="col" height="20" nowrap><font class="datasheetField">J U A</font></th>
     <th scope="col" height="20" nowrap><font class="datasheetField">Premi 1</font></th>
     <th scope="col" height="20" nowrap><font class="datasheetField">Status</font></th>
		</tr>
<?
$sql = "select a.prefixpertanggungan,a.nopertanggungan,a.kdpertanggungan,a.kdstatusfile,a.juamainproduk,a.premi1,a.nopol ".
		   "from $DBUser.tabel_200_pertanggungan a ".
		   "where a.noagen is null ".
			 "and a.prefixpertanggungan='$kantor' ".
			 "and a.kdstatusfile in ('1','4') ";
//echo $sql."<br>";
$DB->parse($sql);
$DB->execute();
$i=0;
while ($arr=$DB->nextrow()) {			 
 //$PER=New Pertanggungan($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
 echo ($i % 2) ?  "<tr scope=\"row\" class=\"c\">" :  "<tr scope=\"row\" class=\"g\">";
  print( "			<td height=\"20\"  nowrap><font class=\"datasheetField\">".$arr["KDPERTANGGUNGAN"]."</font></td>            \n" );
  print( "			<td height=\"20\"  nowrap><font class=\"datasheetField\">".$arr["NOPOL"]."</font></td>            \n" );
  print( "			<td height=\"20\"  nowrap><font class=\"datasheetField\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</font></td>\n" );
  print( "			<td height=\"20\"  nowrap><font class=\"datasheetField\">".$PER->namapemegangpolis."</font></td>            \n" );
  print( "			<td height=\"20\"  nowrap><font class=\"datasheetField\">".number_format($arr["JUAMAINPRODUK"],2)."</font></td>            \n" );
  print( "			<td height=\"20\"  nowrap><font class=\"datasheetField\">".number_format($arr["PREMI1"],2)."</font></td>            \n" );
  print( "			<td height=\"20\"  nowrap><font class=\"datasheetField\">".$arr["KDSTATUSFILE"]."</font></td>            \n" );
  print( "	  </tr>" );


$i++;
}
?>
    </td>
  </tr>
  </table>	 
	</td>
</tr>	

	<tr>
		<td>
		<table border="0" cellpadding="2" cellspacing="1" width="100%" class="color-tabletrim">
		<thead>
				<tr class="color-tableheader">
					 <td height="20" colspan="7" width="100%">
					   <strong class="titlerev">Polis dengan Penagih Kosong</strong>
					 </td>
				</tr>
		</thead>
		<tr class="color-columnheaders">
     <th scope="col" height="20" nowrap><font class="datasheetField">Jenis</font></th>
     <th scope="col" height="20" nowrap><font class="datasheetField">Nomor Lama</font></th>
     <th scope="col" height="20" nowrap><font class="datasheetField">Nomor Baru</font></th>
     <th scope="col" height="20" nowrap><font class="datasheetField">Pemegang Polis</font></th>
     <th scope="col" height="20" nowrap><font class="datasheetField">J U A</font></th>
     <th scope="col" height="20" nowrap><font class="datasheetField">Premi 1</font></th>
     <th scope="col" height="20" nowrap><font class="datasheetField">Status</font></th>
		</tr>
<?
$sql = "select a.prefixpertanggungan,a.nopertanggungan,a.kdpertanggungan,a.kdstatusfile,a.juamainproduk,a.premi1,a.nopol ".
		   "from $DBUser.tabel_200_pertanggungan a ".
		   "where a.nopenagih is null ".
			 "and a.prefixpertanggungan='$kantor' ".
			 "and a.kdstatusfile in ('1','4')";
echo $sql;
$DB->parse($sql);
$DB->execute();
$i=0;
while ($arr=$DB->nextrow()) {			 
 //$PER=New Pertanggungan($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
 echo ($i % 2) ?  "<tr scope=\"row\" class=\"c\">" :  "<tr scope=\"row\" class=\"g\">";


  print( "			<td height=\"20\"  nowrap><font class=\"datasheetField\">".$arr["KDPERTANGGUNGAN"]."</font></td>            \n" );
  print( "			<td height=\"20\"  nowrap><font class=\"datasheetField\">".$arr["NOPOL"]."</font></td>            \n" );
  print( "			<td height=\"20\"  nowrap><font class=\"datasheetField\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</font></td>\n" );
  print( "			<td height=\"20\"  nowrap><font class=\"datasheetField\">".$PER->namapemegangpolis."</font></td>            \n" );
  print( "			<td height=\"20\"  nowrap><font class=\"datasheetField\">".number_format($arr["JUAMAINPRODUK"],2)."</font></td>            \n" );
  print( "			<td height=\"20\"  nowrap><font class=\"datasheetField\">".number_format($arr["PREMI1"],2)."</font></td>            \n" );
  print( "			<td height=\"20\"  nowrap><font class=\"datasheetField\">".$arr["KDSTATUSFILE"]."</font></td>            \n" );
  print( "	  </tr>" );

$i++;
}
?>
    </td>
  </tr>
  </table>	 
	</td>
</tr>	

</table>
<a href="#" onclick="window.close()">Close</a>		
</div>
</body>
</html>