<? 
  include "./includes/database.php";
  include "./includes/common.php";
  include "./includes/formula44.php";
  include "./includes/session.php";
  
	$DB=New database($userid, $passwd, $DBName);
	$prefixpertanggungan = (!$prefixpertanggungan) ? $kantor : $prefixpertanggungan;

	$sql="SELECT a.prefix, a.noawal, a.noakhir, (
SELECT MAX(a.noblanko)+1
    FROM $DBUser.tabel_248_blanko_cetak a
    WHERE a.kdkantor = 'AC'
        AND a.prefix = 'K'
        AND tglrekam=(SELECT MAX(tglrekam) 
            FROM $DBUser.tabel_248_blanko_cetak b
            WHERE b.kdkantor = a.kdkantor
                AND a.prefix = b.prefix)
) DIGUNAKAN
			FROM $DBUser.tabel_249_blanko_polis a
			WHERE a.kdkantor='$kantor'
				AND a.jnspolis='1'
				AND a.kdstatus='1'
				AND a.tglterima=(SELECT MIN(tglterima) 
					FROM $DBUser.tabel_249_blanko_polis b
					WHERE  b.kdkantor = a.kdkantor
						AND b.kdstatus = a.kdstatus
						AND b.jnspolis = a.jnspolis
						AND b.tglterima <= SYSDATE)";
	//echo $sql;		 
	$DB->parse($sql);
  $DB->execute();
  $result = $DB->result();
?>
<script language="JavaScript" type="text/javascript" src="includes/validasi.js"></script>
<script language="JavaScript" type="text/javascript" src="includes/window.js"></script>
<html>
<head>
<title>Benefit Polis</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
</head>
<body>
<form name="propmtc14" method="POST" action="<? PHP_SELF; ?>">
<table cellpadding="1" border="0" cellspacing="1" width="100%" class="tblborder">
 <tr class="arial10wht"><td align="center"><b>Blanko untuk Polis Nomor <?echo $prefixpertanggungan."-".$nopertanggungan;?></b></td></tr>
<tr>	
 <td>
	<table border="0" cellpadding="1" cellspacing="1" width="100%" class="tblisi">
	<tr class="hijao" align=center>
	<td>No</td>
	<td>Prefix</td>
	<td>No. Awal</td>
	<td>No. Akhir</td>
	<td>No. Digunakan</td>
	</tr>

<? 

	$jmlpremi = 0; $jmlbenefit = 0;
  reset($result);
	$i=1;
  foreach ($result as $foo => $arr) {
 		include "./includes/belang.php";
		echo "<td class=verdana9>$i</td>";
		echo "<td align=center class=verdana9>".$arr["PREFIX"]."</td>";
		echo "<td align=center class=verdana9>".$arr["NOAWAL"]."</td>";
		echo "<td align=center class=verdana8blk>".$arr["NOAKHIR"]."</td>";
		echo "<td align=center class=verdana10><b>".$arr["DIGUNAKAN"]."</b></td>";
	  echo "</tr>";

    // ---------------------------------------------------   tambahan untuk new js link
    if(substr($kdproduk,0,3)=='JL4' && ($arr["KDJENISBENEFIT"]=='R' || $arr["KDJENISBENEFIT"]=='I'  || $arr["KDBENEFIT"]=='BNFTOPUPSG'))
  $jmlpremi = $jmlpremi ;
  else
      $jmlpremi = $jmlpremi + $arr["PREMI"];
    // ---------------------------------------------------   akhir tambahan untuk new js link
		$jmlbenefit = $jmlbenefit + $hasilbenefit; 
		$i++;
	} //foreach
	
	$sql="select a.premistd,b.faktorbayar,c.namacarabayar ".
			 "from $DBUser.tabel_311_faktor_bayar b,$DBUser.tabel_200_pertanggungan a,$DBUser.tabel_305_cara_bayar c ".
			 "where a.kdvaluta=b.kdvaluta and a.kdcarabayar=b.kdcarabayar and c.kdcarabayar=b.kdcarabayar ".
			 "and a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan'";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$fb=$DB->nextrow();
	$faktorbayar=$fb["FAKTORBAYAR"]; 
			 
	//echo "<tr class=tblhead1><td colspan=4 align=right class=arial10wht>Premi Standar Tahunan</td>";
	//echo "<td align=right class=arial10wht>".number_format($fb["PREMISTD"],2)."</td>";
	//echo "<td align=right class=arial10wht colspan=3></td>";
	//echo "<tr class=tblisi1><td colspan=4 align=right class=verdana9>Premi ".$fb["NAMACARABAYAR"]."</td>";
	//echo "<td align=right class=verdana9><b>".number_format(($jmlpremi*$faktorbayar),2)."</td>";
	//echo "<td align=right class=arial10wht colspan=3></td>";
	echo "</table>";
?>
</td>
</tr>
</table>
</td>
</tr>
</table>
<script language="javascript" type="text/javascript">
<!--
function popitup(url) {
	newwindow=window.open(url,'name','height=200,width=150');
	if (window.focus) {newwindow.focus()}
	return false;
}

// -->
</script>

<table width="100%">
<tr>
  <td width=100%>
  <!--<input value="CLOSE" type="button" name="tutup" onClick="javascript:window.close();">&nbsp;<input value="LANJUT" type="button" name="lanjut" onClick="NewWindow('./printpol.php?prefix=<?=$arr["PREFIX"];?>&prefixpertanggungan=<?=$prefixpertanggungan;?>&nopertanggungan=<?=$nopertanggungan;?>&blanko=<?=$arr["DIGUNAKAN"];?>','',2000,500,1);javascript:window.close();">-->
  <input value="CLOSE" type="button" name="tutup" onClick="javascript:window.close();">&nbsp;<input value="LANJUT" type="button" name="lanjut" onClick="NewWindow('../../pelaporan/test.cetak.polis.php?prefix=<?=$arr["PREFIX"];?>&prefixpertanggungan=<?=$prefixpertanggungan;?>&nopertanggungan=<?=$nopertanggungan;?>&blanko=<?=$arr["DIGUNAKAN"];?>','',2000,500,1);javascript:window.close();">

	</td>
</tr> 
</table>
</form>
</body>
</html>
