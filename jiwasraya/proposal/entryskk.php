<?
  include "../../includes/database.php";
  include "../../includes/session.php";
  $DB=New database($userid, $passwd, $DBName);
?>
<html>
<title>Pemeliharaan Proposal</title>
<head>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
<script LANGUAGE="JavaScript">
function submitForms() {
	if ((isProposal()))
	if (confirm) { 
		return true;
	} else {
		return false;      
	} else
	return false;
}
function isProposal() {
	var str = document.clntmtc.nopolbaru.value;
	if (str == "") {
		alert("Silakan isi Nomor Pertanggungan !!")
		document.clntmtc.nopolbaru.focus();
		return false;
	}
	return true;
}
var win=null;

function GantiCari(theForm) {
      var jeniscari=theForm.jnscari.value;
			var prefix=theForm.prefixpertanggungan.value;
			var noper=theForm.nopertanggungan.value;
			//var jenismutasi=theForm.jenismutasi.value;
			//var noklien=theForm.noklien.value;
      window.location.replace('entryskk.php?jnscari='+jeniscari+'&prefixpertanggungan='+prefix+'&nopertanggungan='+noper+'');
}

function PilihAo() {
var npert = document.clntmtc.nopertanggungan.value;
		NewWindow('popcaritglmutasi.php?nopertanggungan='+npert+'','popupcari',500,200,1);
}
</script>
<? include "../../includes/hide.php";  ?>

</head>
<body>
<table width="100%">
  <tr><td class="arial10blk">Entry Surat Keterangan Kesehatan</td></tr>
</table>

<hr size="1">
<table border="0" cellspacing="0" width="100%" cellpadding="0" class="tblisi">
  <tr>
		<td>
			<table border="0" width="400" cellspacing="2" cellpadding="2">
			<form name="clntmtc" action="skk1.php" method="POST"  onSubmit="return submitForms()">
			  <tr>
					<td class="verdana10blk">Jenis SKK</td>
					<td class="verdana10blk">:</td>
					<td>
					     <select name="jnscari" onChange="GantiCari(document.clntmtc)">
        				<?
        		    $a = ($jnscari=="skkutama")? "selected" : "";
        		    $b = ($jnscari=="skkterm")? "selected" : "";
								$c = ($jnscari=="skklink")? "selected" : "";
								echo "<option>-- Pilih Jenis SKK --</option>";
        				echo "<option value=\"skkutama\" $a>SKK Utama</option>";
        				echo "<option value=\"skkterm\" $b>SKK Term</option>";
								echo "<option value=\"skklink\" $c>SKK Unit Link</option>";
								?>
        				</select>
					</td>
					<td></td>
				</tr>
				<tr>
					<td class="verdana10blk">Nomor Proposal/Polis</td>
					<td class="verdana10blk">:</td>
					<td>
					  <input class="c" name="prefixpertanggungan" type="hidden" size="2" maxlength="2" onChange="javascript:this.value=this.value.toUpperCase();" value="<?=$prefixpertanggungan;?>">
						<input class="c" name="nopertanggungan" type="hidden" size="11" maxlength="9" onFocus="highlight(event)" onBlur="javascript:validasi(this.form.nopertanggungan);" value="<?=$nopertanggungan;?>">
							<?//printf("<a href=\"#\" onclick=\"NewWindow('popupprop.php?nopertanggungan=%s','',800,300,1);\"><img src=\"../img/jswindow.gif\" border=\"0\" alt=\"cari nomor proposal\"></a>","%");?>
							
						<?php
						$sql = "SELECT nopolbaru FROM $DBUser.tabel_200_pertanggungan WHERE prefixpertanggungan = '$prefixpertanggungan' AND nopertanggungan = '$nopertanggungan'";
						$DB->parse($sql);
						$DB->execute();
						$r = $DB->nextrow();
						?>
						<input class="c" name="nopolbaru" type="text" size="20" maxlength="15" onFocus="highlight(event)" value="<?=$r['NOPOLBARU']?>">
					</td>
					<td></td>
				</tr>
				<? 
				if($jnscari=="skkterm")
				{ 
				?>
				
				<tr>
					<td class="verdana10blk">Tanggal Mutasi</td>
					<td class="verdana10blk">:</td>
					<td>
						<input class="c" name="tglmutasi" type="text" size="11" maxlength="9" onFocus="highlight(event)">
						<a href="#" onClick="PilihAo()">
 		          <img src="../img/jswindow.gif" border="0" name="cariao" alt="cari tanggal mutasi">
						</a>
					</td>
					<td></td>
				</tr>
				<? } ?> 
				<tr>
					<td class="verdana10blk"></td>
					<td class="verdana10blk"></td>
					<td><input type="submit" name="lanjut" value="Lanjut"></td>
					<td></td>
				</tr>
			</form>
			</table>
		</td>
	</tr>
</table>

<hr size="1">
<font face="verdana" size="2"><a href="javascript:window.history.back();">Back</a></font>
</body>
</html>
