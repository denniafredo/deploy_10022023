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
<font color="003399" face="Verdana"><b>DAFTAR PESERTA NO KONTRAK <? echo $nokontrak; ?></b></font><br>
<hr size="1">
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

<table>
<form name="polis" method="post" action="<? echo $PHP_SELF; ?>">

<?	
	if (!$nama) 
  	{
		$dannama = '';
	} 
	else
	{ 
   		$dannama = "and b.namapeserta like '".strtoupper($nama)."%'"; 
  	}
	$ad = ($o==1) ? 'asc' : 'desc';
	$f = (!$f) ? '1' : $f;
	
	$sql="select b.status,b.nopeserta,b.namapeserta,
    (select tglasuransi from kontrak_peserta where nokontrak=c.nokontrak 
        and nopeserta=c.nopeserta and nuke='001')tglasuransi,
    (select akhirmasa from kontrak_peserta where nokontrak=c.nokontrak 
        and nopeserta=c.nopeserta and nuke='001')akhirmasa,
    b.tgllahir,c.nomutasi,c.tglklaim,d.nosip,d.tgltransfer,e.tglbayar
from pkadm.peserta b, peserta_klaim c, sip d, pembayaran e
    where c.nokontrak='$nokontrak' and c.nopeserta=b.nopeserta
            and b.status='2' and c.nokontrak=d.nokontrak and c.nomutasi=d.nomutasi
            and c.nokontrak=e.nokontrak and c.nomutasi=e.nomutasi ".
			 $dannama.
		 " order by $f ".
			 $ad;		
    //echo $sql;
	$DB->parse($sql);
	$DB->execute();

 	$o = (int)!((boolean)$o);
?>
	<tr class="hijao">
		<td align=center>Status</td>
		<td align=center>Nomor Peserta</td>
<?
   		print( "<td align=\"center\"><a href=\"$PHP_SELF?a=$a&b=$b&nama=$nama&f=2&o=$o\">Nama Peserta</a></td>\n" );
   		print( "<td align=\"center\"><a href=\"$PHP_SELF?a=$a&b=$b&nama=$nama&f=1&o=$o\">No Sertifikat</a></td>\n" );
?>
		<td align=center>Tgl Asuransi</td>
		<td align=center>Akhir Masa</td>
		<td align=center>Tgl Lahir</td>
		<td align=center>No Klaim</td>
		<td align=center>Tgl Klaim</td>
		<td align=center>No SIP</td>
		<td align=center bgcolor="">Tgl Bayar</td>
		<td align=center bgcolor="">Tgl Transfer</td>
	</tr>
	<tr>
<?		
	while($arr=$DB->nextrow()) 
	{
		$status=$arr["STATUS"];
		if ($status == '1' ) 
		{	$stat = "aktif";
			echo("<td class=arial10ungu  bgcolor=#00FF00 align=center  style=color:#FFFFFF>".$stat."</td>");}
		elseif ($status == '2') 
		{	$stat ="klaim";
			echo("<td class=arial10ungu  bgcolor=#FFFF00 align=center  style=color:#FFFFFF>".$stat."</td>");}
		else 
		{	$stat = "pengajuan";
			echo("<td class=arial10ungu   align=center  style=color:#FFFFFF>".$stat."</td>");}
		echo("<td class=arial10ungu>".$arr["NOPESERTA"]."</font></td>");
		echo("<td class=arial10ungu>".$arr["NAMAPESERTA"]."</font></td>");
		echo("<td class=arial10ungu>".$arr["NOSERTIFIKAT"]."</font></td>");
		echo("<td class=arial10ungu>".date('d/m/Y',strtotime($arr['TGLASURANSI']))."</font></td>");
		echo("<td class=arial10ungu>".date('d/m/Y',strtotime($arr['AKHIRMASA']))."</font></td>");
		echo("<td class=arial10ungu>".date('d/m/Y',strtotime($arr['TGLLAHIR']))."</font></td>");
		echo("<td class=arial10ungu>".$arr["NOMUTASI"]."</font></td>");
		echo("<td class=arial10ungu>".date('d/m/Y',strtotime($arr['TGLKLAIM']))."</font></td>");		
		echo("<td class=arial10ungu>".$arr["NOSIP"]."</font></td>");		
		echo("<td class=arial10ungu>".date('d/m/Y',strtotime($arr['TGLBAYAR']))."</font></td>");		
		echo("<td class=arial10ungu>".date('d/m/Y',strtotime($arr['TGLTRANSFER']))."</font></td>");		
        echo("</tr>");
	}
?>	
</form>
</table>
</div>
</body>
</html>