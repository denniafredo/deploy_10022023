<?
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
  include "../../includes/common.php";
  include "../../includes/pertanggungan.php";
  include "../../includes/klien.php";	
  include "../../includes/duit.php";
  include "../../includes/koneksi.php";
  
  $DB = new database($userid, $passwd, $DBName); 
  $DSMS = new database($userid, $passwd, $DBName);
	
if (!substr($REMOTE_ADDR,0,9)=='192.168.2') {
 echo "Hanya Untuk Administrator Dari Kantor Pusat, Dont' Try Me";
 die;
}
?>

<html>
<title>Kirim Ulang SMS</title>
<head>
<link href="../jws.css" rel="stylesheet" type="text/css">
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
 var prefix = document.propmtc01.prefixpertanggungan.value;
 var noper = document.propmtc01.nopertanggungan.value;
 var nopol = document.propmtc01.nopol.value;
 if (prefix == "" && noper == "" && nopol == "") {
   alert("Silakan isi Nomor Proposal / Polis atau Nomor Polis Lama!!")
	 document.propmtc01.nopertanggungan.focus();
	 return false;
 }
 return true;
}

</script>

<body topmargin="0" bgcolor="#b9e1f7">
<table width="100%">
<tr><td align="right"><font face="Verdana" size="1" color="#0033CC">F1400</font></td></tr>
</table>
<font face="Verdana" size="2"><b>Cari Proposal/Polis</font>
<hr size=1>
<table border="0" cellspacing="0" width="60%" cellpadding="0" class="tblisi">
  <tr>
   <td>
<table width="100%" cellspacing="2"  border="0" cellpadding="0">
<form name="propmtc01" action="#" method="post" onSubmit="return submitForms()">

<tr class="arial10">
  <td>Nomor Proposal / Polis : </td>
	<td>
	<input name="prefixpertanggungan" value="<?php echo $prefixpertanggungan; ?>" class="c" type="text" size="2" maxlength="2" onFocus="highlight(event)"   onChange="javascript:this.value=this.value.toUpperCase();">
	<input name="nopertanggungan" value="<?php echo $nopertanggungan; ?>" class="c" type="text" size="9" maxlength="9" onFocus="highlight(event)" onBlur="javascript:validasi(this.form.nopertanggungan);">
	</td>
	<td></td>
</tr>
	<tr>
    <td class="verdana10blk">Atau Nomor Polis Lama: </td>
		<td><input type="text" name="nopol" class="c" size="11" maxlength="11" onFocus="highlight(event);" onChange="javascript:this.value=this.value.toUpperCase();"></td>
</tr>
<tr>
 <td colspan="2" align="center"><input type="submit" name="lanjut" value="Lanjut">
 </td>
</tr>

</form>
</table>
</td>
</tr>
</table>
<hr size=1>
<?php if($nopertanggungan!="" || $prefixpertanggungan!="") {?>
<table border="0" cellspacing="0" width="60%" cellpadding="0" class="tblisi">
  <tr>
   <td>
   <table width="100%" cellspacing="2"  border="0" cellpadding="0">
<tr class="arial10">  
	<th>Nomor Polis</th>
	<th>Kode Produk</th>
	<th>Tgl. Mulas</th>
	<th>Status Medical</th>
	<th>Pemegang Polis</th>
  <th>No. HP</th>
  <th>Kirim Ulang SMS Proposal</td>	
</tr>
<?php
	$sql = "select ".
			 	 				 "a.prefixpertanggungan,a.nopol,a.nopertanggungan,decode(a.kdpertanggungan,'1','Proposal','Polis'),a.kdproduk,".
								 "a.premi1,a.juamainproduk,a.kdstatusmedical,to_char(a.mulas,'DD/MM/YYYY') mulas,".						
								 "(select namaklien1 || namaklien2 as namaklien1 from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) namapemegangpolis,".
								 "(SELECT   NVL(NO_PONSEL, PHONETETAP02) FROM   $DBUser.TABEL_100_KLIEN WHERE   NOKLIEN = a.NOPEMEGANGPOLIS) NOHPPEMPOL,".
								 "(select namastatusfile from $DBUser.tabel_299_status_file where kdstatusfile=a.kdstatusfile) namastatusfile ".
			   "from ".
				 			 	 "$DBUser.tabel_200_pertanggungan  a ".								 
			   "where ".
				 				 "(prefixpertanggungan||nopertanggungan)='".$prefixpertanggungan.$nopertanggungan."'";
		//		 				 echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();
?>
<tr class="arial10">
  <td align="center"><?php echo "$prefixpertanggungan-$nopertanggungan"; ?></td>
	<td align="center"><?php echo $arr["KDPRODUK"]; ?></td>
	<td align="center"><?php echo $arr["MULAS"]; ?></td>
	<td align="center"><?php echo $arr["KDSTATUSMEDICAL"]; ?></td>
	<td><?php echo $arr["NAMAPEMEGANGPOLIS"]; ?></td>
	<td><?php echo $arr["NOHPPEMPOL"]; ?></td>
  <td>
	<a href="#" onclick="NewWindow('retry_sms_act.php?prefixpertanggungan=<?php echo $prefixpertanggungan;?>&nopertanggungan=<?php echo $nopertanggungan;?>','',400,200,1)">Pemegang Polis</a> |
  <a href="#" onclick="NewWindow('retry_sms_agen_act.php?prefixpertanggungan=<?php echo $prefixpertanggungan;?>&nopertanggungan=<?php echo $nopertanggungan;?>','',400,200,1)">Agen Penutup</a>	
	</td>

</tr>	
</table>
</td>
</tr>
</table>
<?php } ?>
<font face="verdana" size="2"><a href="../submenu.php?mnuinduk=200">Menu Pertanggungan Baru</a></font>
</body>
</html>
