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
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
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
	
	$sql="select b.nopeserta,b.namapeserta,b.status,b.tgllahir,a.tglasuransi,a.akhirmasa,b.nosertifikat,
			(select sum(nilaibenefit) from benefit_peserta where nokontrak=a.nokontrak 
				and nopeserta=a.nopeserta and jenisbenefit in ('1','B'))jua,
			(select sum(nilaipremi) from benefit_peserta where nokontrak=a.nokontrak 
				and nopeserta=a.nopeserta and jenisbenefit in ('1','B'))premi				
		  from pkadm.kontrak_peserta a, peserta b
		   where a.nokontrak='$nokontrak' 
		   and a.nuke='001' and a.nopeserta=b.nopeserta and nvl(b.status,0)='1' ".
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
		<td align=center>JUA</td>
		<td align=center>Premi</td>
		<td align=center>Pelunasan Premi</td>
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
		echo("<td class=arial10ungu>".$arr["NOPESERTA"]."</td>");
		echo("<td class=arial10ungu>".$arr["NAMAPESERTA"]."</td>");
		echo("<td class=arial10ungu>".$arr["NOSERTIFIKAT"]."</td>");
		echo("<td class=arial10ungu>".date('d/m/Y',strtotime($arr['TGLASURANSI']))."</td>");
		echo("<td class=arial10ungu>".date('d/m/Y',strtotime($arr['AKHIRMASA']))."</td>");
		echo("<td class=arial10ungu>".date('d/m/Y',strtotime($arr['TGLLAHIR']))."</td>");
		echo("<td class=arial10ungu align=right>".number_format($arr['JUA'], 2, ',', '.')."</font></td>");
		echo("<td class=arial10ungu align=right>".number_format($arr['PREMI'], 2, ',', '.')."</font></td>");
		$nopeserta=$arr["NOPESERTA"];
		?>
		<td class=arial10ungu align="center">
		<a href="#" onclick="NewWindow('cekpolispkpesertapremi.php?nokontrak=<?=$nokontrak;?>&nopeserta=<?=$nopeserta;?>','',780,400,1)">cek premi</a></td>
	  </tr>
<?
	}
?>	
</form>
</table>
</div>
</body>
</html>