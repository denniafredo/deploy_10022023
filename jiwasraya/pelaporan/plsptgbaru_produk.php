<?
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	include "../../includes/common.php";
  
  $DB = new Database($userid, $passwd, $DBName);
	?>
<html>
<head>
<title>Untitled</title>
</head>
<link href="../jws.css" rel="stylesheet" type="text/css">
<body topmargin="0">
<table width="100%">
<tr><td align="right"><font face="Verdana" size="2" color="#0033CC">F5410</font></td></tr>
</table>
<font face="Verdana" size="2"><b>Pertanggungan Baru berdasarkan Produk</b></font>
<hr size="1">
<table border="0" cellpadding="4" cellspacing="0" align="center" width="100%">
<form method="POST" action="pls_produk.php">
 <tr>
    <td width="100" bgcolor="#DDDDDD"><font face="Arial" size="2">Nama Kantor</font></td>
    <td bgcolor="#DDDDDD"><font size="2"><b>:</b></font></td>
    <td bgcolor="#DDDDDD" width="100">
		<select size="1" name="kdkantor">
		<? 
		  $sql = "select kdkantor,kdjeniskantor,kdkantorinduk,namakantor ".
			       "from $DBUser.tabel_001_kantor where kdjeniskantor='2' order by kdkantor";
			$DB->parse($sql);
			$DB->execute();
			
			while($arr=$DB->nextrow()){
			  echo("<option value=".$arr["KDKANTOR"].">".$arr["KDKANTOR"]."::".$arr["NAMAKANTOR"]."</option>");
			}			 
		?>
		</select>
		</td>
		<td bgcolor="#DDDDDD"></td>
		</tr>
		<tr>
		<td bgcolor="#DDDDDD"><font face="Arial" size="2">Nama Produk</font></td>
    <td bgcolor="#DDDDDD">
        <font size="2"><b>:</b></font>
	  </td>
    <td bgcolor="#DDDDDD">
		<select size="1" name="kdproduk">
        <? 
		  $sql = "select kdproduk,namaproduk ".
			       "from $DBUser.tabel_202_produk order by namaproduk";
			$DB->parse($sql);
			$DB->execute();
			
			while($arr=$DB->nextrow()){
			  echo("<option value=".$arr["KDPRODUK"].">$arr[NAMAPRODUK]</option>");
			}			 
		?>
    </select>
	</td>
	  <td bgcolor="#DDDDDD"></td>
  </tr>
			<tr>
		<td bgcolor="#DDDDDD"><font face="Arial" size="2">Nama Valuta</font></td>
    <td bgcolor="#DDDDDD">
        <font size="2"><b>:</b></font>
	  </td>
    <td bgcolor="#DDDDDD">
		<select size="1" name="kdvaluta">
        <? 
		  $sql = "select kdvaluta,namavaluta ".
			       "from $DBUser.tabel_304_valuta";
			$DB->parse($sql);
			$DB->execute();
			
			while($arr=$DB->nextrow()){
			  echo("<option value=".$arr["KDVALUTA"].">$arr[NAMAVALUTA]</option>");
			}			 
		?>
    </select>
	</td>
  <td bgcolor="#DDDDDD"><input type="submit" name="cari" value="CARI"></td>
  </tr>
	</form>
</table>
<hr size="1">
<font face="verdana" size="2"><a href="javascript:window.history.back();">Back</a></font>
</body>
</html>
