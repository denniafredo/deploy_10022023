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
<tr><td align="right"><font face="Verdana" size="2" color="#0033CC">F5510</font></td></tr>
</table>
<font face="Verdana" size="2"><b>Pertanggungan Baru</b></font>
<hr size="1">
<table border="0" cellpadding="4" cellspacing="0">
<form method="POST" action="pls_valuta.php">
 <tr>
    <td bgcolor="#FFFFFF"><font face="Arial" size="2">Nama Kantor</font></td>
    <td bgcolor="#FFFFFF">:
		<select size="1" name="kdkantor">
		<? 
		  $sql = "select kdkantor,kdjeniskantor,kdkantorinduk,namakantor ".
			       "from $DBUser.tabel_001_kantor order by kdkantor";
			$DB->parse($sql);
			$DB->execute();
			
			while($arr=$DB->nextrow()){
			  echo("<option value=".$arr["KDKANTOR"].">".$arr["KDKANTOR"]."::".$arr["NAMAKANTOR"]."</option>");
			}			 
		?>
		</select>
		</td>
		<td bgcolor="#FFFFFF"></td>
		</tr>
		<tr>
		<td bgcolor="#FFFFFF"><font face="Arial" size="2">Nama Valuta</font></td>
    <td bgcolor="#FFFFFF">:
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
  <td bgcolor="#FFFFFF"></td>
  </tr>
	<tr>
		<td bgcolor="#FFFFFF"><font face="Arial" size="2">Tahun Mulas</font></td>
    <td bgcolor="#FFFFFF">:
		    <input type="tex" size="5" name="thmulas" maxlength="4">
	  </td>
   <td bgcolor="#FFFFFF"><input type="submit" name="cari" value="CARI"></td>
  </tr>
	</form>
</table>
<hr size="1">
<font face="verdana" size="2"><a href="javascript:window.history.back();">Back</a></font>
</body>
</html>
