<?  
 	include "../../includes/database.php"; 
	include "../../includes/common.php"; 

	$DB = New Database($DBUser,$DBPass,$dbName);

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
<font color="003399" face="Verdana"><b>DAFTAR POLIS RAYON PENAGIHAN <? echo $kantor; ?></b></font><br>
<hr size="1">
<table width="100%">
	<form method="post" name="porm" action="<? $PHP_SELF; ?>" onSubmit="return OnSumbit(document.porm)">
	<tr class=vercyan>
		<td class=ver8ungu align="left">Masukkan Nama Tertanggung &nbsp; <font size="1" color="red">(Minimal 3 karakter) </font>
	 		<input type="text" name="nama" size="20" class="c"  value="<?=strtoupper($nama);?>" onFocus="highlight(event)">
	 		<input type="submit" name="cari" value="Cari">
		</td>
	</tr>
	</form>	
</table>
<br>

<table>
<form name="polis" method="post" action="<? echo $PHP_SELF; ?>">

<?	
	if (!$nama) 
  	{
		$dannama = '';
	} 
	else
	{ 
   		$dannama = "and a.namatertanggung like '".strtoupper($nama)."%'"; 
  	}
	$ad = ($o==1) ? 'asc' : 'desc';
	$f = (!$f) ? '1' : $f;
	
	$sql="select a.nokontrak,a.namatertanggung, a.kontraklama,a.kdkantor
		  from pkadm.kontrak a
		   where a.kdkantor='$kantor' and a.kdkontrak<>'2' ".
			 $dannama.
		 " order by $f ".
			 $ad;		
    //echo $sql;
	$DB->parse($sql);
	$DB->execute();

 	$o = (int)!((boolean)$o);
?>
	<tr class="hijao">
		<td align=center colspan="2">Nomor Polis</td>
<?
    		print( "<td align=\"center\"  rowspan=\"2\"><a href=\"$PHP_SELF?a=$a&b=$b&nama=$nama&f=2&o=$o\">Nama</a></td>\n" );
?>					
	</tr>
	<tr class="hijao">
		<td align=center width="12%">Lama</td>
<?
    		print( "<td align=\"center\"><a href=\"$PHP_SELF?a=$a&b=$b&nama=$nama&f=1&o=$o\">Baru</a></td>\n" );
?>
	</tr>	
<?		
	$i=0;
	while($arr=$DB->nextrow()) 
	{
		include "../../includes/belang.php";
		$link = "<td class=arial10ungu><a href=\"#\" onclick=\"javascript:".
				"window.opener.document.porm.no_polis.value='".$arr["NOKONTRAK"]."';\n".
				"window.close();\n".
				"\">".$arr["KDKANTOR"]."-".$arr["NOKONTRAK"]."</a></font></td>";
		echo("<td class=arial10ungu>".$arr["KONTRAKLAMA"]."</font></td>");
		echo	$link;			
		echo("<td class=arial10ungu>".$arr["NAMATERTANGGUNG"]."</font></td>");
        echo("</tr>");
		$i++;
	}
?>	
</form>
</table>
</div>
</body>
</html>