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
<script LANGUAGE="JavaScript">
<!-- Begin
function submitForms() {
if ( (isKantor()))
if (confirm)//("\nApakah Nomor proposal sudah benar?\n\nKlik OK untuk melanjutkan.\n\nKlik Cancel untuk membatalkan."))
{ 
//alert("\nTerima Kasih!");
return true;
}
else
{
//alert("\nAnda membatalkan mengirim komentar.");
return false;      
}
else
return false;
}

function isKantor() {
var str = document.isikantor.kdkantor.value;
if (str == "") {
alert("Silakan pilih Kantor Cabang !!")
document.isikantor.kdkantor.focus();
return false;
}
return true;
}

// End -->
</script>
<link href="../jws.css" rel="stylesheet" type="text/css">
<body topmargin="0">
<table width="100%">
<tr><td align="right"><font face="Verdana" size="2" color="#0033CC">F5310</font></td></tr>
</table>
<font face="Verdana" size="2"><b>Polis Pertanggungan Baru</b></font>
<hr size="1">
<table border="0" cellpadding="4" cellspacing="0" align="center" width="100%">
<form method="POST" name="isikantor" action="pls_agen.php" onSubmit="return submitForms()">
  <tr>
    <td width="100" bgcolor="#DDDDDD"><font face="Arial" size="2">Tahun</font></td>
    <td bgcolor="#DDDDDD" width="2"><font face="Arial" size="2"><b>:</b></font></td>
    <td bgcolor="#DDDDDD" width="100">
		<input type="text" name="thmulas" size="5" maxlength="4">
		</td>
		<td bgcolor="#DDDDDD"></td>
	</tr>
 <tr>
    <td width="100" bgcolor="#DDDDDD"><font face="Arial" size="2">Kantor Cabang</font></td>
    <td bgcolor="#DDDDDD" width="2"><font face="Arial" size="2"><b>:</b></font></td>
    <td bgcolor="#DDDDDD" width="100">
		<select size="1" name="kdkantor" style="font-family: Verdana; font-size: 10pt">
		 <option>Pilih Kantor</option>
		<? 
		  $sql = "select kdkantor,namakantor ".
			       "from $DBUser.tabel_001_kantor where kdjeniskantor='1' order by kdkantor";
			$DB->parse($sql);
			$DB->execute();
			
			while($arr=$DB->nextrow()){
			  echo("<option value=".$arr["KDKANTOR"].">".$arr["KDKANTOR"]."::".$arr["NAMAKANTOR"]."</option>");
			}			 
		?>
		</select>
		</td>
		<td bgcolor="#DDDDDD"><input type="submit" name="cari" value="CARI" style="font-family: Arial; font-size: 10pt"></td>
		</tr>
	</form>
</table>
<hr size="1">
<font face="verdana" size="2"><a href="javascript:window.history.back();">Back</a></font>
</body>
</html>
