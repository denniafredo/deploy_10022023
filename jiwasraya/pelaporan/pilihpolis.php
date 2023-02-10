<?php 
  include "../../includes/database.php";
  include "../../includes/session.php";
	include "../../includes/common.php";
?>
<html>
<head>
<title>PT Asuransi Jiwa IFG Private Network</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
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
alert("Silakan isi Nomor Polis !!")
document.propmtc01.nopertanggungan.focus();
return false;
}
if (str == "000000000") {
alert("Nomor Polis \"000000000\" tidak ada !!")
document.propmtc01.nopertanggungan.focus();
return false;
}
return true;
}

</script>
</head>
<body topmargin="0">
<table width="100%">
<tr><td align="right"><font face="Verdana" size="2" color="#0033CC">F5200</font></td></tr>
</table>
<font face="Verdana" size="2">
<b>Check Polis</b>
<hr size=1>
<table border="0" width="500" cellspacing="3" cellpadding="0" align="center">
<form name="propmtc01" method="post" action="show_polis.php" onSubmit="return submitForms()">
  <tr>
    <td width="100%" colspan="5" height="21"><font face="arial" size="2">Masukkan nomor polis.</font></td>
  </tr>
  <tr>
    <td width="80" height="21"><font face="arial" size="2">No Polis</font></td>
    <td width="3" height="21">:</td>
    <td width="130" height="21"><input type="text" onfocus="highlight(event)" name="nopertanggungan" size="11" maxlength="9" onblur="javascript:validasi(this.form.nopertanggungan)">
		<!--<a href="#" onclick="window.open('poppolis.php?nopertanggungan=%s','popuppage','scrollbars=yes,width=700,height=300,top=100,left=50');"> -->
		<a href="#" onclick="NewWindow('poppolis.php','popuppage','700','300','yes');return true;">
		<img src="../img/jswindow.gif" border="0" alt="cari nomor polis"></a></td>
    <td width="80" height="21">&nbsp;<input type="submit" value="Submit" name="submit"></td>
    <td width="200" height="21"></td>
  </tr>
</table>
</font>
<hr size=1>
<font face="verdana" size="2"><a href="javascript:window.history.back();">Back</a></font>
</form>
</body>
</html>
