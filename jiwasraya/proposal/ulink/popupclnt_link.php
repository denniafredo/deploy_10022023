<?  
  include "includes/session.php";
  include "includes/database.php";
	

	$DB=New database($userid, $passwd, $DBName);
?>	
<html>
<title>Daftar Klien</title>
<link href="includes/jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="includes/highlight.js"></script>

<script language="JavaScript" type="text/javascript">
function Cari(theForm) {
	var a=theForm.namaklien.value
	if (a.length >=3) {
	  window.location.replace('popupclnt_link.php?nama='+a+'')
		return true;
	} else {
	 alert ('Masukkan Minimal 3 Karakter Nama');
	 return false;
	} 
}
</script>
<body topmargin="0">
<div align="center">
<table width="100%">
	<tr><td align="right"><font face="Verdana" size="1" color="#0033CC">F1315</font></td></tr>
</table>


<table width="100%">
<form method="post" name="klien" action="<? $PHP_SELF; ?>">
	<tr class=vercyan>
	 <td class=ver8ungu align="center">Masukkan Nama Klien</td>
	 <td><input type="text" name="namaklien" size="20" class="a" onFocus="highlight(event)" onBlur="return Cari(document.klien);" value="<?echo strtoupper($nama)?>"></td>
	</tr>
	<tr>
	<? echo "   <td class=ver8ungu colspan=2 align=right><a href=\"#\" onclick=\"window.location.replace('".$PHP_SELF."?hi=1')\">atau klik Klien Dientry Hari Ini</a></td>\n" ; ?>
	</tr>
	</form>
</table>
<br>
<table width="100%">
  <tr><td align="center"><font face="Verdana" size="2"><b>DAFTAR KLIEN KANTOR <? echo $kantor;?></b></font></td></tr>
</table>
<table align="center">
<form name="porm" action="<?echo $PHP_SELF;?>" method="post">
	<tr class="hijao">
	  <td align="center">No.</td>
		<td align="center">No. Klien</td>
		<td align="center">Nama Klien</td>
		<td align="center">Sex</td>
		<td align="center">Tgl Lahir</td>
	</tr>
<?
	if ($nama) {
	  $nama=strtoupper($nama);
		$sql = "select namaklien1,jeniskelamin,noklien,to_char(tgllahir,'DD/MM/YYYY') tgllahir ".
		       "from $DBUser.tabel_100_klien where namaklien1 like '$nama%' order by noklien desc";
	} else {
	 if ($hi) {
		$sql = "select namaklien1,jeniskelamin,noklien, to_char(tgllahir,'DD/MM/YYYY') tgllahir ".
					 "from $DBUser.tabel_100_klien ".
					 "where trunc(tglrekam)=trunc(sysdate) and userrekam='$userid' and (status <> '9' or status is null) ".
					 "order by noklien desc";
	 } 			   	 
	}
	
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$i=1;
	while($arr=$DB->nextrow()) {
		$namaklien = ereg_replace("'","`",$arr["NAMAKLIEN1"]);
		include "includes/belang.php";
		echo "<td align=\"center\" class=arial10ungu>$i</td>";
		$htm="<td align=\"center\" class=arial10ungu><a href=\"#\" onclick=\"javascript:".
				 "window.opener.document.ntryclnthub.noklieninsurable.value='".$arr["NOKLIEN"]."';\n".
				 "window.opener.document.ntryclnthub.namaklien1.value='".$namaklien."';\n".
				 "window.close();\">".$arr["NOKLIEN"]."</a></td>".
		"<td align=\"left\" class=\"ver8ungu\">".$namaklien."</td>".
		"<td align=\"left\" class=\"ver8ungu\">".$arr["JENISKELAMIN"]."</td>".
		"<td align=\"left\" class=\"ver8ungu\">".$arr["TGLLAHIR"]."</td>".
		"</tr>";  
		echo $htm;
		$i++;
	}
?>
</table>

</form>
</div>
</body>
</html>