<?
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	$DB=new database($userid, $passwd, $DBName);
	
	$sql="select kddokunderwriting,namadokunderwriting ".
	     "from $DBUser.tabel_217_kode_dok_uw ".
			 "order by kddokunderwriting";
  $DB->parse($sql);
	$DB->execute();
?>
<html>
<head>
<title>Daftar Proposal</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
</head>
<body topmargin="0">
<div align="center">
<table width="100%">
<tr><td align="right"><font face="Verdana" size="2" color="#0033CC">F1511</font></td></tr>
</table>
<font face="Verdana" size="2"><b>Dokumen Kesehatan</b></font>
<hr size="1">
<table>
<tr class=hijao>
<td align=center>Kode</td>
<td align=center>Nama Dokumen</td>
</tr>
<?
	$i=0;
  while($arr=$DB->nextrow()) {
	include "../../includes/belang.php";
		printf("<td class=arial10><a href=\"#\" onclick=\"javascript:window.opener.document.propdoc10.kddokunderwriting.value='%s';window.opener.document.propdoc10.namadokunderwriting.value='%s';window.close();\">%s</a></td>",$arr["KDDOKUNDERWRITING"],$arr["NAMADOKUNDERWRITING"],$arr["KDDOKUNDERWRITING"]);
		echo("<td class=arial10>".$arr["NAMADOKUNDERWRITING"]."</td>");
    echo("</tr>");
	$i++;
	}
?>
</table>
<br><br>
</div>
</body>
</html>
