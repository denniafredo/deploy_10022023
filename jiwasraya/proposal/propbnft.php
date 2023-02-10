<? 
  include "../../includes/database.php";
  include "../../includes/session.php";
	$DB=New database($userid, $passwd, $DBName);
	$prefixpertanggungan="BX";
	$nopertanggungan="000000029";
		
	if ($submit=="Lanjut") {
    if ($oldproduk != $kdproduk) {
		
		}	
	} else if($submit=="Submit") {
	  $sql="insert into $DBUser.tabel_223_transaksi_produk (prefixpertanggungan,nopertanggungan,kdproduk,kdbenefit,periodebayar,periodebenefit,kdjenisbenefit) ".
		     "values ('$prefixpertanggungan','$nopertanggungan','$kdproduk','$kdbenefit',null,null,'R')";
	  
    $DB->parse($sql);
		$DB->execute();
  	$DB->commit();
	} else if($lanjut=="Lanjut") {
    header("location:compbnft.php?nopertanggungan=$nopertanggungan&$SID");
		exit;
	}
	
	$sql="select kdproduk,periodebayar,periodebenefit,kdbenefit,nilaibenefit,premi,kdjenisbenefit ".
	     "from $DBUser.tabel_223_transaksi_produk ".
			 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
  $DB->parse($sql);
	$DB->execute();
//	$DB->errorstring;
?>

<html>
<head>
<title>Benefit Proposal</title>
</head>
<body>

<b>Benefit Produk</b>
<hr size=1>
<form name="propbnft" method="POST" action="<? PHP_SELF; ?>">
<table width=700>
<tr>
  <td width=150>No. SP</td>
	<td colspan=3>: <? echo $nopertanggungan; ?> </td>
</tr>
<tr>
  <td width=150>Kode Produk</td>
	<td>: <? echo $kdproduk; ?> </td>
  <td>Term</td>
	<td>: <? echo $juamainproduk; ?> </td>
</tr>
</table>

<hr size=1>
<table width=700 bgcolor="#d3d3d3">
<tr>
  <td width=200>Premi yang diinginkan Klien</td>
	<td>:</td>
  <td><input type="text" name="premi"></td>
  <td align=right> &nbsp;&nbsp; Insert</td>
</tr>
</table>
<hr size=1>

<? 
  echo "<table border=0 width=\"700\" bgcolor=#d3d3d3>";
	echo "<tr>";
	echo "<td width=10 bgcolor=#9999cc>No.</td>";
	echo "<td width=\"100\" bgcolor=#9999cc>Kode Benefit</td>";
	echo "<td width=\"100\" bgcolor=#9999cc>Periode Bayar</td>";
	echo "<td bgcolor=#9999cc>Periode Benefit</td>";
	echo "<td bgcolor=#9999cc>Jumlah Benefit</td>";
	echo "<td bgcolor=#9999cc>Premi</td>";
	echo "<td bgcolor=#9999cc>Jenis</td>";
	echo "</tr>";

	$no = 1;
  while ($arr=$DB->nextrow()) {
	  echo "<tr>";
		echo "<td>$no</td>";
		echo "<td width=\"100\">".$arr["KDBENEFIT"]."</td>";
		echo "<td width=\"100\" align=right>".$arr["PERIODEBAYAR"]."</td>";
		echo "<td width=\"100\" align=right>".$arr["PERIODEBENEFIT"]."</td>";
		echo "<td width=\"100\" align=right>".$arr["NILAIBENEFIT"]."</td>";
		echo "<td width=\"100\" align=right>".$arr["PREMI"]."</td>";
		echo "<td width=\"10\" align=center>".$arr["KDJENISBENEFIT"]."</td>";
	  echo "</tr>";
	  
		$no ++;
	}
	echo "<tr>";
	echo "<td>$no</td>";
	echo "<td><input type=hidden name=kdproduk>";
	echo "    <input type=text name=kdbenefit size=14>";
  echo "</td>";
	echo "<td><input type=text name=periodebayar size=20></td>";
	echo "<td><input type=text name=periodebenefit size=15></td>";
	echo "<td><input type=text name=jumlahbenefit size=15></td>";
	echo "<td><input type=text name=premi size=15></td>";
	printf("<td><a href=\"#\" onclick=\"window.open('popupjam.php?kdproduk=%s&kdbenefit=%s','popuppage','width=400,height=300,top=100,left=100')\"><img src=\"../img/jswindow.gif\"></a></td>",$kdproduk,"%");
	echo "</tr>";
	echo "</table>";
?>

<hr size=1>
<table>
<tr>
	<td width=550>&nbsp;</td>
	<td>
	 <input type="hidden" name="mode" value="insert">
	 <input type="hidden" name="noklien" value="<? echo $noklien; ?>">
	 <input type="hidden" name="nopertanggungan" value="<? echo $nopertanggungan; ?>">
   <input type="submit" name="submit" value="Submit">
   <input type="submit" name="lanjut" value="Lanjut">
	</td>
</tr> 
</table>
</form>
</body>
</html>
