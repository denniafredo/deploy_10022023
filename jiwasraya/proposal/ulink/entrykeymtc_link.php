<?
  include "includes/database.php"; 
  include "includes/session.php"; 
	$DB=new database($userid, $passwd, $DBName);
?>
<html>
<head>
<title>Bank Data</title>
<link href="includes/jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="includes/validasi.js"></script>
<script language="JavaScript" type="text/javascript" src="includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="includes/window.js"></script>
</head>
<script LANGUAGE="JavaScript">
function submitForms() {
	if (isKlien())
	if (confirm) { 
		return true;
	} else {
		return false;      
	} else
	return false;
}
function isKlien() {
	var str=document.clntmtc.noklien.value;
	if (str=="") {
		alert("Silakan Isi Nomor Klien !!")
		document.clntmtc.noklien.focus();
		return false;
	}
	return true;
}
function isNama() {
	var str=document.clntmtc.namaklien.value;
	if (str=="") {
		alert("Silakan Isi Nama Klien !!")
		document.clntmtc.namaklien.focus();
		return false;
	}
	return true;
}
function CariNama() {
	var noklien=document.clntmtc.noklien.value;
	if (!noklien=='') {
		NewWindow('carinama.php?namahalaman=clntmtc&noklien='+noklien+'','caripage',400,300,1)
	}
}
</script>
<body topmargin="0">

<font face="Verdana" size="2"><b>PEMELIHARAAN DATA KLIEN</font></b>
<hr size="1">
<div align="center">
<table width="400" cellpadding="1" cellspacing="1" class="tblhead">
<tr>
<td  class="tblisi">
		<table border="0" width="100%" align="center" class="tblisi" cellpadding="3" cellspacing="3">
		<form name="clntmtc" method="POST" action="mnuclntmtc_link.php" onSubmit="return submitForms()">
			<tr>
				<td><font face="Arial" size="2">Jenis</font></td>
				<td>
					<select size="1" name="jenisupdate" class="c" onFocus="highlight(event)">
						<option value="E">EDIT</option>
						<option value="Q">QUERY</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><font face="Arial" size="2">Nomor Klien</font></td>
				<td> 
					<input type="text" class="c" name="noklien" size="12" maxlength="10" onFocus="highlight(event)" onBlur="javascript:validasi10(this.form.noklien);CariNama()">
					<a href="#" onClick="NewWindow('popupclntmtc.php','popuppage',420,300,1);"><img src="../../img/jswindow.gif" alt="Daftar Klien" border="0"></a>
				</td>
			</tr>
			<tr>	
				<td><font face="Arial" size="2">Nama</font></td>
				<td><input type="text" class="a" name="namaklien1" size="35" maxlength="30" readonly></td>
			</tr>
			<tr>
			  <td></td>
				<td>
					<input type="submit" value="SUBMIT" name="Submit" class="button1">
					<input type="reset" value="RESET" name="Reset" class="button1">
				</td>
			</tr>
      </form>
		</table>
</td>
</tr>
</table>		
</div>
<hr size="1" color="#9999ff">
<a class="arial10" href="entryklien_ul.php">Menu Pemeliharaan Klien</a>
</body>
</html>
