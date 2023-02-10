<?
  include "../../includes/database.php";
  include "../../includes/session.php";
?>
<html>
<head>
<title>PT Asuransi Jiwa IFG Private Network</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
<? include "../../includes/hide.php";  ?>
<script LANGUAGE="JavaScript">
function submitForms() {
if ( (isKlien()))
if (confirm)
{ 
return true;
}
else
{
return false;      
}
else
return false;
}

function isKlien() {
var str = document.propmtc01.nopertanggungan.value;
if (str == "") {
alert("Silakan isi Nomor Proposal !!")
document.propmtc01.nopertanggungan.focus();
return false;
}
if (str == "000000000") {
alert("Nomor Proposal \"000000000\" tidak ada !!")
document.propmtc01.nopertanggungan.focus();
return false;
}
return true;
}

</script>
</head>
<body topmargin="0">
<table width="100%">
<tr><td align="right"><font face="Verdana" size="1" color="#0033CC">F1500</font></td></tr>
</table>
<font face="Verdana" size="2">
<b>Dokumen Pemeriksaan Kesehatan</b>
<hr size=1>
<table border="0" cellspacing="0" width="100%" cellpadding="0" class="tblisi">
  <tr>
   <td>
<table border="0" cellspacing="3" cellpadding="0">
<form name="propmtc01" method="post" action="propdoc10.php" onSubmit="return submitForms()">
  <tr class="arial10">
    <td>Masukkan nomor proposal</td>
    <td></td>
    <td><input type="text" onfocus="highlight(event)" class="c" name="nopertanggungan" size="9" maxlength="9" onblur="javascript:validasi(this.form.nopertanggungan)">
		<a href="#" onclick="NewWindow('popupprop.php','',800,300,1);return true;">
		<img src="../img/jswindow.gif" border="0" alt="cari nomor proposal"></a></td>
    <td><input type="submit" value="Submit" name="submit"></td>
  </tr>
</table>
   </td>
  </tr>
</table>
</font>
<hr size=1>
<font face="verdana" size="2"><a href="javascript:window.history.back();">Back</a></font>
</form>
</body>
</html>
