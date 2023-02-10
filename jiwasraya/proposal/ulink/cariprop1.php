<?  
	include "./includes/session.php";
  include "./includes/database.php";

 	$DB=New database($userid, $passwd, $DBName);
?>
<title>Daftar Klien</title>
<html>
<head>
<link href="./includes/jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="./includes/validasi.js"></script>
<script language="JavaScript" type="text/javascript" src="./includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript">
function Cari(theForm) {
	var a=theForm.noklien.value
	if (!a=='') {
	  window.location.replace('cariprop1.php?no='+a+'')
	}
}

function CariNama(theForm) {
	var n=theForm.namaklien.value
	if (!n=='') {
	  window.location.replace('cariprop1.php?nama='+n+'')
	}
}
</script>
</head>
<body topmargin=0>
<div align=center>
<table width="100%">
  <tr><td align="right"><font face="Verdana" size="1" color="#0033CC">F1331</font></td></tr>
  <tr><td align="center"><font face="Verdana" size="2" color="#0033CC"><b>DAFTAR KLIEN</b></font></td></tr>
</table>

<table width="100%">
<form name="klien" method="post" action="<?echo $PHP_SELF;?>">
	<tr class="tblisi">
	 <td class="verdana8" colspan="3">Masukkan No. Klien (Jika Sudah Tahu)
	     <input type="text" name="noklien" size="10" maxlength="10" class="c" onFocus="highlight(event)" onBlur="validasi10(this.form.noklien);Cari(document.klien)"></td>
	 <td class="verdana8" colspan="4">
	 atau Nama Klien
	     <input type="text" name="namaklien" size="10" class="c" onFocus="highlight(event)" onBlur="CariNama(document.klien)" value="<?echo strtoupper($nama);?>">
	
	 </td>
	</tr>
	<tr>
	 <td colspan="7" class="ver8ungu" align=right>
	 <!--<a href="#" onclick="window.location.replace('cariklien1.php?hi=1')">Cari Klien Yang Dientry Hari Ini</a>
	 -->
	 <a href="#">Cari Klien Yang Dientry Hari Ini</a>
	 </td>
	</tr>
	<tr>
	 <td colspan="7" class="ver8ungu" align=right><hr size="1"></td>
	</tr>
  <tr class="hijao" >
	 <td>No</td>
	 <td align="center">Nomor Klien</td>
   <td align="center">Nama Klien</td>
	 <td align="center">Tinggi(cm)</td>
	 <td align="center">Berat(kg)</td>
	 <td align="center">Tgl Lahir</td>
	 <td align="center">Edit TB/BB</td>
	</tr>
<?

		
			$prefpert=substr($_GET['noprop'],0,2);
			$nopert=substr($_GET['noprop'],2,9);
			$sql="select a.noklien, namaklien1,gelar,tinggibadan,".
			     "beratbadan,to_char(tgllahir,'DD/MM/YYYY') tgllahir ".
			     "from $DBUser.tabel_100_klien a,$DBUser.TABEL_219_PEMEGANG_POLIS_BAW  b where a.noklien=b.noklien and b.nopertanggungan='$nopert' and prefixpertanggungan='$prefpert'";
					 //echo $sql;
  $DB->parse($sql);
	$DB->execute();
  $i=1;			 
	while($arr=$DB->nextrow()) {
		include "./includes/belang.php";
		echo "<td class=verdana8>$i</td>";
    if ($arr["TINGGIBADAN"]=='0'||$arr["BERATBADAN"]=='0'||is_null($arr["TGLLAHIR"])){
			printf("<td align=center class=arial10ungu>".$arr["NOKLIEN"]."</td>");
		} else {
			printf("<td align=center class=verdana8><a href=\"#\" onclick=\"javascript:window.opener.document.ntryprop.notertanggung.value='%s';window.close();\" >%s</a></td>",$arr["NOKLIEN"],$arr["NOKLIEN"]);
		}

		  $nama = (strlen($arr["GELAR"])==0 || preg_match("/^[0-9]/",substr($arr["GELAR"],0,1))) ? $arr["NAMAKLIEN1"] : $arr["NAMAKLIEN1"].",".$arr["GELAR"];
			$nama = ereg_replace("'","`",$nama);
			
			print("<td class=verdana8>$nama</td>");
			print("<td class=verdana8 align=center>".$arr["TINGGIBADAN"]."</td>");
			print("<td class=verdana8 align=center>".$arr["BERATBADAN"]."</td>");
			print("<td class=verdana8 align=center>".$arr["TGLLAHIR"]."</td>");
		if ($arr["TINGGIBADAN"]=='0'||$arr["BERATBADAN"]=='0'||is_null($arr["TGLLAHIR"])){
			print("<td align=center class=verdana8><a href=\"./klien/editclntmain.php?noklien=".$arr["NOKLIEN"]."&namaklien=".$arr["NAMAKLIEN1"]."\">Edit</a></td>");
		} else {
			print ("<td class=verdana8></td>");
		}
		  
		print("</tr>");
		$i++;	 
	}				 

?>
</table>
</form>
</div>
</body>
</html>	
