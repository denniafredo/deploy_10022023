<?  
  include "../../includes/session.php";  
  include "../../includes/database.php";  
  include "../../includes/pertanggungan.php";
	
  $DB=new Database("PKADM","PK412M","GLINDO");
?>
<html>
<head>
<title>Daftar Polis</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript">
function OnSumbit(theForm) {
	var a = theForm.nama.value;
	if (a.length < 3) {
		if (confirm('Masukkan 3 Hurup Pertama Yang Ingin Dicari\nKlik OK Untuk Semuanya\nLama Tanggung Sendiri')) {
			theForm.nama.value='ALL';
			return true;
		} else {
			theForm.nama.focus();
		 	return false;
		}  
	} else {
		return true;
	}	
} 
</script>
</head>

<body>
<div align=center>
<font color="003399" face="Verdana"><b>DAFTAR PESERTA NO PESERTA <? echo $nopeserta; ?></b></font><br>
<hr size="1">
<!--
<table width="100%">
	<form method="post" name="porm" action="<? $PHP_SELF; ?>" onSubmit="return OnSumbit(document.porm)">
	<tr class=vercyan>
		<td class=ver8ungu align="left">Masukkan Nama Peserta &nbsp;<font size="1" color="red">(Minimal 3 karakter) 
	 		<input type="text" name="nama" size="20" class="c"  value="<?echo strtoupper($nama);?>" onFocus="highlight(event)">
	 		<input type="submit" name="cari" value="Cari"></td>
	</tr>
	</form>	
</table>
<br>
-->

<table>
<form name="polis" method="post" action="<? echo $PHP_SELF; ?>">

<?	
	$sql="select a.nokontrak,a.nopeserta,a.tglbooked,a.tglbayar,a.jmlpremi
		  from pkadm.historis_premi_peserta a
		   where a.nokontrak='$nokontrak' 
		   and a.nopeserta='$nopeserta'";
    //echo $sql;
	$DB->parse($sql);
	$DB->execute();

?>
	<tr class="hijao">
		<td align=center>No</td>
		<td align=center>Nokontrak</td>
		<td align=center>Tgl Booked</td>
		<td align=center>Jml Premi</td>
		<td align=center>Tgl Bayar</td>
		<td align=center>Keterangan</td>
	</tr>
<?		
	$i = 1;
	while($arr=$DB->nextrow()) 
	{
		echo("<tr>");
		echo("<td class=arial10ungu>$i</td>");
		echo("<td class=arial10ungu>".$arr["NOKONTRAK"]."</td>");
		echo("<td class=arial10ungu>".date('d/m/Y',strtotime($arr['TGLBOOKED']))."</td>");
		echo("<td class=arial10ungu align=right>".number_format($arr['JMLPREMI'], 2, ',', '.')."</font></td>");
		echo("<td class=arial10ungu>".date('d/m/Y',strtotime($arr['TGLBAYAR']))."</td>");
	$i++;
	}
	echo("</tr");

?>	
</form>
</table>
</div>
</body>
</html>