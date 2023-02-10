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
function isProposal() {
var str = document.propmtc01.noproposal.value;
if (str == "") {
  alert("Silakan isi NO PROPOSAL !!")
	document.propmtc01.noproposal.focus();
	return false;
}
  return true;
}

function submitForms() {
if ((isProposal()))
  if (confirm) { 
	  return true;
  } else {
	  return false;      
  } else
	return false;
}

// End -->
</script>
</head>
<body topmargin="0">	
<table width="100%">
<tr><td align="right"><font face="Verdana" size="1" color="#0033CC">F1200</font></td></tr>
</table>
<font face="Verdana" size="2"><b>Entry Proposal BP3 Dibayar Didepan</b></font>
<hr size=1>
<table border="0" cellspacing="0" width="100%" cellpadding="0" class="tblisi">
  <tr>
   <td>
<table border="0" width="500" cellspacing="2" cellpadding="2">
<form name="propmtc01" method="post" action="ntrypropbd.php" onSubmit="return submitForms()">
  <tr class="arial10">
    <td>Masukkan nomor proposal, jika Premi Pertama telah dibayar sebelumnya.</td>
  </tr>
  <tr class="arial10">
    <td width="31%">Nomor Proposal :
		  <input type="text" class="c" name="noproposal" size="9" maxlength="9" onfocus="highlight(event)" onblur="javascript:validasi9(this.form.noproposal)">
    <? printf("<a href=\"#\" onclick=\"NewWindow('popuppropbd.php','popuppage','800','300','yes');\"><img src=\"../img/jswindow.gif\" border=\"0\" alt=\"cari nomor proposal\"></a>");?>
		  &nbsp;&nbsp;<input type="submit" value="Submit" name="submit">
		</td>
  </tr>
</table>
		</td>
  </tr>
</table>

<hr size=1>
<font face="verdana" size="2"><a href="javascript:window.history.back();">Back</a></font>
</form>
</body>
</html>
