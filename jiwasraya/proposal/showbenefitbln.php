<? 
  include "../../includes/database.php";
  include "../../includes/common.php";
  include "../../includes/formula44.php";
  include "../../includes/session.php";
	$DB=New database($userid, $passwd, $DBName);
	$prefixpertanggungan = (!$prefixpertanggungan) ? $kantor : $prefixpertanggungan;

	$sql="select a.*,decode(a.status,'1','CLAIMED','') status,to_char(a.expirasi,'DD/MM/YYYY') expirasi ".
       "from $DBUser.tabel_223_benefit_savingplan a where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
	//echo $sql;		 
	$DB->parse($sql);
  $DB->execute();
  $result = $DB->result();
?>
<html>
<head>
<title>Benefit Polis</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
</head>
<body>
<form name="propmtc14" method="POST" action="<? PHP_SELF; ?>">
<table cellpadding="1" border="0" cellspacing="1" width="100%" class="tblborder">
 <tr class="arial10wht"><td align="center"><b>Benefit Bulanan Proposal Nomor <? echo $prefixpertanggungan."-".$nopertanggungan;?></b></td></tr>
<tr>	
 <td>
	<table border="0" cellpadding="1" cellspacing="1" width="100%" class="tblisi">
	<tr class="hijao" align=center>
	<td>No.</td>
	<td>Bruto</td>
	<td>Pajak</td>
	<td>Netto</td>
	<td>Jatuh Tempo</td>
	<td>Status</td>
	</tr>

<? 

	$jmlpremi = 0; $jmlbenefit = 0;
  reset($result);
	$i=1;
  foreach ($result as $foo => $arr) {
 		include "../../includes/belang.php";
		echo "<td class=verdana9>$i</td>";
		echo "<td class=verdana9>".number_format($arr["NILAIBRUTO"],2)."</td>";
		echo "<td class=verdana9>".number_format($arr["NILAIPAJAK"],2)."</td>";
		echo "<td class=verdana9>".number_format($arr["NILAINETTO"],2)."</td>";
		echo "<td class=verdana9>".$arr["EXPIRASI"]."</td>";
		echo "<td class=verdana9>".$arr["STATUS"]."</td>";
        echo "</tr>";
		$jmlpremi = $jmlpremi + $arr["PREMI"]; 
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

<table width="100%">
<tr>
  <td width=100>
	  <font face="verdana" size="2"><a href="javascript:window.close();">Close</a></font>
	</td>
</tr> 
</table>
</form>
</body>
</html>
