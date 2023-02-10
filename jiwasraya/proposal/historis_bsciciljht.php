<? 
  include "../../includes/database.php";
  include "../../includes/common.php";
  //include "../../includes/formula44.php";
  include "../../includes/session.php";
	$DB=New Database("PLADM","PLADM","PLTEST");
	//$prefixpertanggungan = (!$prefixpertanggungan) ? $kantor : $prefixpertanggungan;

	/*$sql="select decode(a.status,'8','CLAIMED','9','TERMINAL','') status,a.kdproduk,a.periodebayar,a.periodebenefit,a.kdbenefit,a.nilaibenefit,a.premi,a.kdjenisbenefit, ".
			 " a.expirasi,b.kdrumusbenefit, b.kdrumuspremi, b.kdrumusexpirasi,c.namabenefit,to_char(a.expirasi,'DD/MM/YYYY') expirasi ".
       "from $DBUser.tabel_223_transaksi_produk a, $DBUser.tabel_206_produk_benefit b, $DBUser.tabel_207_kode_benefit c ".
  	   "where a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan' ".
       "and a.kdproduk=b.kdproduk(+) and a.kdbenefit=b.kdbenefit(+) and a.kdbenefit=c.kdbenefit(+) ".
			 "order by a.expirasi";*/ 
	$sqlx="select *
		   from pladm.bs_cicil_mst_upload
		   where key = (select key from key_kontrak where no_polis_plindo = '$no_polis')";	  
	//echo $sql;
	$DB->parse($sqlx);
  $DB->execute();
  $result = $DB->result();
?>
<html>
<head>
<title>HISTORIS BS CICIL</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
</head>
<body>
<form name="propmtc14" method="POST" action="<? PHP_SELF; ?>">
<table cellpadding="1" border="0" cellspacing="1" width="100%" class="tblborder">
 <tr class="arial10wht">
   <td><b>HISTORIS BS CICIL <? echo $pempol;?></b></td></tr>
 <tr class="arial10wht"><td><b>POLIS NO : <? echo $no_polis."/".$no_polis_lama;?></b></td></tr>
<tr>	
 <td>
	<table border="0" cellpadding="1" cellspacing="1" width="100%" class="tblisi">
    <tr class="hijao" align=center>
    <td>NO</td>
    <td>TGL_MULAI</td>
    <td>PREMI_SKG</td>
    <td>JANGKA_WAKTU</td>
    <td>CARA_BAYAR</td>
    <td>CICILAN</td>
    <td>LUNAS_TERAKHIR</td>
    <td>SALDO</td>
    <td>KETERANGAN</td>  
	</tr>

<? 

	$jmlpremi = 0; $jmlbenefit = 0;
  reset($result);
	$i=1;
  foreach ($result as $foo => $arr) {
 		include "../../includes/belang.php";
		echo "<td class=verdana9>$i</td>";
		echo "<td class=verdana9c>".date('d/m/Y',strtotime($arr['TGL_MULAI']))."</td>";
		echo "<td class=verdana9r>".number_format($arr['PREMI_SKG'], 2, ',', '.')."</td>";
		echo "<td class=verdana9>".$arr['JANGKA_WAKTU']."</td>";
		echo "<td class=verdana9>".$arr['CARA_BAYAR']."</td>";
		echo "<td class=verdana9r>".number_format($arr['CICILAN'], 2, ',', '.')."</td>";
		echo "<td class=verdana9c>".date('d/m/Y',strtotime($arr['LUNAS_TERAKHIR']))."</td>";
		echo "<td class=verdana9r>".number_format($arr['SALDO'], 2, ',', '.')."</td>";
		echo "<td class=verdana9>".$arr['KETERANGAN']."</td>";


		$jml_PREMI_SKG+=$arr['PREMI_SKG'];
		$jml_CICILAN+=$arr['CICILAN'];
		$jml_SALDO+=$arr['SALDO'];
	
		$i++;
		echo "</tr>";
	} //foreach
	echo "<tr class=tblhead1>";
	echo '<td align="center" colspan="1">JUMLAH</td>';
	
	echo "<td class=arial10whtr></td>";
	echo "<td class=arial10whtr>".number_format($jml_PREMI_SKG, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr></td>";
	echo "<td class=arial10whtr></td>";
	echo "<td class=arial10whtr>".number_format($jml_CICILAN, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr></td>";
	echo "<td class=arial10whtr>".number_format($jml_SALDO, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr></td>";

	echo "</tr>";

	/*$sql="select a.premistd,b.faktorbayar,c.namacarabayar ".
			 "from $DBUser.tabel_311_faktor_bayar b,$DBUser.tabel_200_pertanggungan a,$DBUser.tabel_305_cara_bayar c ".
			 "where a.kdvaluta=b.kdvaluta and a.kdcarabayar=b.kdcarabayar and c.kdcarabayar=b.kdcarabayar ".
			 "and a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan'";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$fb=$DB->nextrow();
	$faktorbayar=$fb["FAKTORBAYAR"]; 
			 
	echo "<tr class=tblhead1><td colspan=4 align=right class=arial10wht>Premi Standar Tahunan</td>";
	echo "<td align=right class=arial10wht>".number_format($fb["PREMISTD"],2)."</td>";
	echo "<td align=right class=arial10wht colspan=3></td>";
	echo "<tr class=tblisi1><td colspan=4 align=right class=verdana9>Premi ".$fb["NAMACARABAYAR"]."</td>";
	echo "<td align=right class=verdana9><b>".number_format(($jmlpremi*$faktorbayar),2)."</td>";
	echo "<td align=right class=arial10wht colspan=3></td>";*/
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
