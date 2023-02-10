<?  
  include "includes/database.php";
  include "includes/session.php";
	//include "../../includes/sortnama.php";
	$DB=New database($userid, $passwd, $DBName);
?>	
<html>
<title>Daftar Klien</title>
<link href="../../jws.css" rel="stylesheet" type="text/css">

<script language="JavaScript" type="text/javascript">
function Cari(theForm) {
	var a=theForm.namaklien.value;
	var minLength = 3; 
	if (a.length < minLength) {
        alert('Nama minimal ' + minLength + ' karakter. Coba lagi!');
        return false;
  }
	if (!a=='') {
	  window.location.replace('popupclntmtc.php?nama='+a+'');
	}
}
</script>

<body topmargin="0">
<div align="center">

<table width="100%">
	<tr><td align="right"><font face="Verdana" size="1" color="#0033CC">F1315</font></td></tr>
</table>
<table width="100%">
<form name="klien" action="<? echo $PHP_SELF; ?>">
<tr class=vercyan>
	 <td class=ver8ungu align="center">Masukkan Nama Klien</td>
	 <td><input type="text" name="namaklien" size="20" class="a" onBlur="Cari(document.klien);"></td>
	<tr>
	<? echo "<td class=ver8ungu colspan=2 align=right><a href=\"#\" onclick=\"window.location.replace('".$PHP_SELF."?hi=1')\">atau klik Klien Dientry Hari Ini</a></td>\n" ; ?>
	</tr>
	</form>
</table>

<?
	//SortNama('popupclntmtc.php');
  print( "<table width=\"100%\" align=\"center\">\n" );
?>	
	<tr class="hijao">
	  <td align="center">No.</td>
		<td align="center">Nomor Klien</td>
		<td align="center">Nama Klien</td>
        <td align="center">Tgl. Lahir</td>
	</tr>

<?

	if ($id && !$hi) {
	 if ($id=='all'){
		$sql = "select noklien,namaklien1 as shownama,namaklien1 ,to_char(tgllahir,'DD/MM/YYYY') tgllahir from $DBUser.tabel_100_klien ".
				    "where (status <> '9' or status is null) order by noklien";
	 } else if ($id!='') { 	
		$id=$id."%";
		$sql = "select noklien,namaklien1 as shownama,namaklien1,to_char(tgllahir,'DD/MM/YYYY') tgllahir from $DBUser.tabel_100_klien ".
					 "where (status <> '9' or status is null) and namaklien1 like '$id' order by noklien";			  	 
	 }
	} else if ($hi) {
		$sql = "select noklien,namaklien1 as shownama,namaklien1,to_char(tgllahir,'DD/MM/YYYY') tgllahir ".
					 "from $DBUser.tabel_100_klien ".
					 "where trunc(tglrekam)=trunc (sysdate) and userrekam='$userid' and (status <> '9' or status is null) ";
  }	elseif ($nama) {
	  $nama = strtoupper($nama);
		$sql  = "select noklien,replace(namaklien1,'$nama','<font color=#cc6666><b>".$nama."</b></font>') shownama,".
		        "namaklien1,".
					  "to_char(tgllahir,'DD/MM/YYYY') tgllahir ".
		        "from $DBUser.tabel_100_klien where namaklien1 like '$nama%'";
  } 
	
	$DB->parse($sql);
	$DB->execute();
	$i=1;
	while ($arr=$DB->nextrow()) {
		include "includes/belang.php";
		$nama=$arr["NAMAKLIEN1"];
		$nama=str_replace("'","`",$nama);
		echo  "<td align=\"center\" class=\"arial10ungu\">$i</td>";
		printf("<td align=\"center\" class=\"arial10ungu\"><a href=\"#\" onclick=\"javascript:".
					 "window.opener.document.clntmtc.noklien.value='%s';\n".
					 "window.opener.document.clntmtc.namaklien1.value='%s';\n".
					 "window.close();\">%s</a></td>".
		"<td class=\"ver8ungu\">%s</td>".
		"<td class=\"ver8ungu\">%s</td></tr>".
		"",$arr["NOKLIEN"],$nama,$arr["NOKLIEN"],$arr["SHOWNAMA"],$arr["TGLLAHIR"]);
		$i++;
	}				 
?>
</table>
<?
//SortNama('popupclntmtc.php');
?>
</form>
</div>
</body>
</html>
