<?
  include "../../includes/database.php";
  include "../../includes/session.php";
	$DB=New database($userid, $passwd, $DBName);

	$sql = "select namaklien1 from $DBUser.tabel_100_klien where noklien = '$c'";
	$DB->parse($sql);
	$DB->execute();
	$ary=$DB->nextrow();
	$name=$ary["NAMAKLIEN1"];
	$name=ereg_replace("'","`",$name);
?>	
<html><title>Insurable</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<target=_top><body topmargin="0"><div align="center">
<table width="100%">
 <tr><td align="right" class=arial8blue>F1334</td></tr>
 <tr><td align="center" class=arial10bold><? echo "Insurable Tertanggung ".$name;?></td>
</tr>
</table>
<table border="0" width="100%" cellpadding="0" cellspacing="0" class="tblisi">
  <tr class="tblhead">
    <td align="center">Nomor</td>
    <td align="center">Nama</td>
		<td align="center">Hubungan</td>
  </tr>
<?	
if (!$mutan) {
 $porm='ntryprop';
 $no   ='no';
 $nama ='nama';
 $klienno='klienno';
 $hubungan='hubungan';
}	else {
 $porm='chry';
 $no   ='no';
 $nama ='namabaru';
 $klienno='nopempolbaru';
 $hubungan='hubbaru';
}
  $sql ="select b.noklieninsurable, namahubungan, c.namaklien1 ".
	      " from $DBUser.tabel_100_klien c, $DBUser.tabel_113_insurable b ,$DBUser.tabel_218_kode_hubungan a ".
				" where a.kdhubungan=b.kdhubungan and b.notertanggung='$c'  ".
				" and b.noklieninsurable=c.noklien(+) ".
			 "union ".
			 "select '$c','Diri Tertanggung','$name' from dual ";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$i=0;
	while($arr=$DB->nextrow()) {
	$adan=ereg_replace("'","`",$arr["NAMAKLIEN1"]);
	  include "../../includes/belang.php";
		printf("<td class=verdana8 align=center><a href=\"#\" onclick=\"javascript:".
		"window.opener.document.getElementsByName('$no$n')[0].value = '$n'; ".//"window.opener.document.$porm.$no".$n.".value='".$n."'; ".
		"window.opener.document.getElementsByName('$nama$n')[0].value = '$adan'; ".//"window.opener.document.$porm.$nama".$n.".value='%s'; ".
		"window.opener.document.getElementsByName('$klienno$n')[0].value = '$arr[NOKLIENINSURABLE]'; ".//"window.opener.document.$porm.$klienno".$n.".value='%s'; ".
		"window.opener.document.getElementsByName('$hubungan$n')[0].value = '$arr[NAMAHUBUNGAN]'; ".//"window.opener.document.$porm.$hubungan".$n.".value='%s'; ".
		"window.close();\">$arr[NOKLIENINSURABLE]</a></td><td class=verdana8>$arr[NAMAKLIEN1]</td><td class=verdana8>$arr[NAMAHUBUNGAN]</td>"); //"window.close();\">%s</a></td><td class=verdana8>%s</td><td class=verdana8>%s</td>",$adan,$arr["NOKLIENINSURABLE"].
		//"",$arr["NAMAHUBUNGAN"],$arr["NOKLIENINSURABLE"],$arr["NAMAKLIEN1"],$arr["NAMAHUBUNGAN"]);
		$i++;
	}
?>
</table>
</div>
</body>
</html>
