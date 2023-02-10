<?
  include "../../includes/database.php";
  include "../../includes/session.php";

?>
<html>
<title>Pemeliharaan Proposal</title>
<head>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>

<? include "../../includes/hide.php";  ?>

<script LANGUAGE="JavaScript">
/*
function submitForms() {
	if (isNoPolis() || )
	if (confirm) { 
		return true;
	} else {
		return false;      
	} else
	return false;
}
function isKlien() {
	var str=document.clntmtc.nopertanggungan.value;
	if (str=="") {
		alert("Silakan Isi Nomor Pertanggungan !!")
		document.clntmtc.nopertanggungan.focus();
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
*/
function PilihAo() {
var npert = document.clntmtc.nopertanggungan.value;
		NewWindow('popcaritglmutasi.php?nopertanggungan='+npert+'','popupcari',500,200,1);
}

function PilihAnak() {
var prefx = document.clntmtc.prefixpertanggungan.value;
var npert = document.clntmtc.nopertanggungan.value;
		NewWindow('popcaritertanggung.php?prefixpertanggungan='+prefx+'&nopertanggungan='+npert+'','popupcari',500,200,1);
}
</script>
</head>
<body>
<table width="100%">
  <tr><td align="right"><font face="Verdana" size="1" color="#0033CC">F1400</font></td></tr>
  <tr><td class="arial10blk">Entry Surat Keterangan Kesehatan Calon Anak yang Dibeasiswakan</td></tr>
</table>

<hr size="1">
<table border="0" cellspacing="0" width="100%" cellpadding="0" class="tblisi">
  <tr>
		<td>
			<table border="0" cellspacing="2" cellpadding="2">
			<form name="clntmtc" action="skk_anak.php" onSubmit="return submitForms()">
				
				<tr>
					<td class="verdana10blk">Nomor Polis</td>
					<td class="verdana10blk">:</td>
					<td> 
					  <input class="c" name="prefixpertanggungan" type="text" size="2" maxlength="2" onChange="javascript:this.value=this.value.toUpperCase();">
						<input class="c" name="nopertanggungan" type="text" size="11" maxlength="9" onfocus="highlight(event)" onblur="javascript:validasi(this.form.nopertanggungan);">
					</td>
					<td></td>
				</tr>
				<tr>
					<td class="verdana10blk">Tanggal Mutasi</td>
					<td class="verdana10blk">:</td>
					<td>
					  <input class="c" name="tglmutasi" type="text" size="11">
						<a href="#" onclick="PilihAo()">
 		          <img src="../img/jswindow.gif" border="0" name="cariao" alt="cari tanggal mutasi">
						</a>
					</td>
					<td></td>
				</tr>
				<tr>
					<td class="verdana10blk">Nomor klien anak yang di-BS-kan</td>
					<td class="verdana10blk">:</td>
					<td>
						<input class="c" readonly name="klienno" type="text" size="11" maxlength="10" onfocus="highlight(event)" onblur="javascript:validasi10(this.form.klienno);">
					  <a href="#" onclick="PilihAnak()">
 		          <img src="../img/jswindow.gif" border="0" name="cariao" alt="Pilih tertanggung">
						</a>
					</td>
					<td><input type="submit" name="lanjut" value="Lanjut"></td>
				</tr>
			</form>
			</table>
		</td>
	</tr>
</table>
<hr size="1">
<font face="verdana" size="2"><a href="../mnuptgbaru">Menu Pertanggungan Baru</a></font>
</body>
</html>
