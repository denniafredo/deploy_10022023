<?  
  include "../../includes/database.php";
  include "../../includes/session.php";
	include "../../includes/common.php";
	include "../../includes/sortnama.php";
	
	$DB=New Database($userid, $passwd, $DBName);
?>	
  <html>
	<title>Daftar Klien</title>
	<link href="../jws.css" rel="stylesheet" type="text/css">
	<body topmargin="0">
  <div align="left">
	<table width="100%">
  <tr><td align="right"><font face="Verdana" size="1" color="#0033CC">F1315</font></td></tr>
  </table>
  <B><font face=Verdana size=2>DAFTAR KLIEN</font></B>
<?
	echo("<form method=post action=$PHP_SELF>");
	SortNama('popupclntmtc.php');
	echo "<BR>";
?>
<table align="center">
<tr class="hijao">
<td align="center">Nomor Klien</td>
<td align="center">Nama Klien</td>
</tr>
	
<?
			if ($id=='all'){
            $sql="select noklien,namaklien1,to_char(tgllahir,'DD/MM/YYYY') tgllahir from $DBUser.tabel_100_klien order by noklien desc";
			} else {
					 if ($id!=''){ 	
					 $id=$id."%";
					  $sql="select noklien,namaklien1,to_char(tgllahir,'DD/MM/YYYY') tgllahir from $DBUser.tabel_100_klien where namaklien1 like '$id' order by noklien desc";			  	 
					 }
			}
					 $DB->parse($sql);
					 $DB->execute();
					 $i=0;
					 while($arr=$DB->nextrow()) {
					 $nama=$arr["NAMAKLIEN1"];
					 $nama=ereg_replace("'","`",$nama);
  				 include "../../includes/belang.php";
					    printf("<td class=arial10ungu><a href=\"#\" onclick=\"javascript:window.opener.document.ntryclnthub.noklien.value='%s';window.opener.document.ntryclnthub.namaklien1.value='%s';window.close();\" >%s</a></td><td class=ver8ungu>%s</td></tr>",$arr["NOKLIEN"],$nama,$arr["NOKLIEN"],$nama);
  				 $i++;
					 }				 

	
?>
</table>
<?
SortNama('popupclntmtc.php');
?>
</form>
</div>
</body>
</html>
