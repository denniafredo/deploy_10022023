<?
  include "../../includes/database.php";
  include "../../includes/session.php";
?>

<html>
<title>Pemeliharaan Proposal</title>
<head>
<link href="../../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
</head>
<script LANGUAGE="JavaScript">
function submitForms() {
if ( (isProposal()))
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

function isProposal() {
var str = document.propmtc01.nopertanggungan.value;
if (str == "") {
alert("Silakan isi Nomor Proposal !!")
document.propmtc01.nopertanggungan.focus();
return false;
}
return true;
}

</script>

<body topmargin="0">
<?php
	
	if (isset($_GET['noproposal']) && !empty($_GET['noproposal']) ){
	echo "<script language='javascript'>".
				"alert('No proposal ".$_GET['noproposal']." telah di akseptasi');</script>";
	}
?>
<table width="100%">
<tr><td align="right"><font face="Verdana" size="1" color="#0033CC">F1400</font></td></tr>
</table>
<font face="Verdana" size="2"><b>Pemeliharaan Proposal</b></font>
<hr size=1>
<table border="0" cellspacing="0" width="100%" cellpadding="0" class="tblisi">
  <tr>
   <td>
<table width="350" cellspacing="2">
<form method="post" name="propmtc01" action="propmtc10_link.php" onSubmit="return submitForms()">
<tr class="arial10">
  <td>Mode Operasi</td>
  <td>:</td>
  <td><select name="modeopr" onFocus="highlight(event)" class="c">
	      <option value="update">UPDATE</option>
	      <option value="query">QUERY</option>
				<!--<option value="drop">DROP</option>-->
			</select>
	</td>
	<td></td>
</tr>
<tr class="arial10">
  <td>Nomor Proposal</td>
	<td>:</td>
	<td>
		<input name="nopertanggungan" class="c" type="hidden" size="9" maxlength="9" onFocus="highlight(event)" onBlur="javascript:validasi(this.form.nopertanggungan);">
		<input name="nopolis" class="c" type="text" size="15" maxlength="15" onFocus="highlight(event)" readonly placeholder="Silahkan klik cari =>">
	 <? 
	  printf("<a href=\"#\" onclick=\"NewWindow('../popupprop.php?nopertanggungan=%s','','800','300','yes');\"><img src=\"../../img/jswindow.gif\" border=\"0\" alt=\"cari nomor proposal\"></a>","%"); 
	 ?>
	</td>
	<td><input type="submit" name="lanjut" value="Lanjut"></td>
</tr>
</form>
</table>
</td>
</tr>
</table>
<hr size=1>
<font face="verdana" size="2"><a href="javascript:window.history.back();">Back</a></font>
</body>
</html>
