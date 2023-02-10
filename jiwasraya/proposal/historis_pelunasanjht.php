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
	$sqlx="SELECT KEY,KD_JENIS_ASURANSI,
			   SUM(CASE WHEN TO_CHAR(TGL_BOOKED,'MM') = '01' AND KD_JENIS_KUITANSI = 'NB' THEN
					PREMI
			   ELSE
					0
			   END) JAN_NB,
			   SUM(CASE WHEN TO_CHAR(TGL_BOOKED,'MM') = '01' AND KD_JENIS_KUITANSI = 'OB' THEN
					PREMI
			   ELSE
					0
			   END) JAN_OB,
			   SUM(CASE WHEN TO_CHAR(TGL_BOOKED,'MM') = '02' AND KD_JENIS_KUITANSI = 'NB'  THEN
					PREMI
			   ELSE
					0
			   END) FEB_NB,
			   SUM(CASE WHEN TO_CHAR(TGL_BOOKED,'MM') = '02' AND KD_JENIS_KUITANSI = 'OB'  THEN
					PREMI
			   ELSE
					0
			   END) FEB_OB,
			   SUM(CASE WHEN TO_CHAR(TGL_BOOKED,'MM') = '03' AND KD_JENIS_KUITANSI = 'NB'  THEN
					PREMI
			   ELSE
					0
			   END) MAR_NB,
			   SUM(CASE WHEN TO_CHAR(TGL_BOOKED,'MM') = '03' AND KD_JENIS_KUITANSI = 'OB'  THEN
					PREMI
			   ELSE
					0
			   END) MAR_OB,
			   SUM(CASE WHEN TO_CHAR(TGL_BOOKED,'MM') = '04' AND KD_JENIS_KUITANSI = 'NB'  THEN
					PREMI
			   ELSE
					0
			   END) APR_NB,
			   SUM(CASE WHEN TO_CHAR(TGL_BOOKED,'MM') = '04' AND KD_JENIS_KUITANSI = 'OB'  THEN
					PREMI
			   ELSE
					0
			   END) APR_OB,
			   SUM(CASE WHEN TO_CHAR(TGL_BOOKED,'MM') = '05' AND KD_JENIS_KUITANSI = 'NB'  THEN
					PREMI
			   ELSE
					0
			   END) MEI_NB,
			   SUM(CASE WHEN TO_CHAR(TGL_BOOKED,'MM') = '05' AND KD_JENIS_KUITANSI = 'OB'  THEN
					PREMI
			   ELSE
					0
			   END) MEI_OB,
			   SUM(CASE WHEN TO_CHAR(TGL_BOOKED,'MM') = '06' AND KD_JENIS_KUITANSI = 'NB'  THEN
					PREMI
			   ELSE
					0
			   END) JUN_NB,
			   SUM(CASE WHEN TO_CHAR(TGL_BOOKED,'MM') = '06' AND KD_JENIS_KUITANSI = 'OB'  THEN
					PREMI
			   ELSE
					0
			   END) JUN_OB,
			   SUM(CASE WHEN TO_CHAR(TGL_BOOKED,'MM') = '07' AND KD_JENIS_KUITANSI = 'NB'  THEN
					PREMI
			   ELSE
					0
			   END) JUL_NB,
			   SUM(CASE WHEN TO_CHAR(TGL_BOOKED,'MM') = '07' AND KD_JENIS_KUITANSI = 'OB'  THEN
					PREMI
			   ELSE
					0
			   END) JUL_OB,
			   SUM(CASE WHEN TO_CHAR(TGL_BOOKED,'MM') = '08' AND KD_JENIS_KUITANSI = 'NB'  THEN
					PREMI
			   ELSE
					0
			   END) AGU_NB,
			   SUM(CASE WHEN TO_CHAR(TGL_BOOKED,'MM') = '08' AND KD_JENIS_KUITANSI = 'OB'  THEN
					PREMI
			   ELSE
					0
			   END) AGU_OB,
			   SUM(CASE WHEN TO_CHAR(TGL_BOOKED,'MM') = '09' AND KD_JENIS_KUITANSI = 'NB'  THEN
					PREMI
			   ELSE
					0
			   END) SEP_NB,
			   SUM(CASE WHEN TO_CHAR(TGL_BOOKED,'MM') = '09' AND KD_JENIS_KUITANSI = 'OB'  THEN
					PREMI
			   ELSE
					0
			   END) SEP_OB,
			   SUM(CASE WHEN TO_CHAR(TGL_BOOKED,'MM') = '10' AND KD_JENIS_KUITANSI = 'NB'  THEN
					PREMI
			   ELSE
					0
			   END) OKT_NB,
			   SUM(CASE WHEN TO_CHAR(TGL_BOOKED,'MM') = '10' AND KD_JENIS_KUITANSI = 'OB'  THEN
					PREMI
			   ELSE
					0
			   END) OKT_OB,
			   SUM(CASE WHEN TO_CHAR(TGL_BOOKED,'MM') = '11' AND KD_JENIS_KUITANSI = 'NB'  THEN
					PREMI
			   ELSE
					0
			   END) NOV_NB,
			   SUM(CASE WHEN TO_CHAR(TGL_BOOKED,'MM') = '11' AND KD_JENIS_KUITANSI = 'OB'  THEN
					PREMI
			   ELSE
					0
			   END) NOV_OB,
			   SUM(CASE WHEN TO_CHAR(TGL_BOOKED,'MM') = '12' AND KD_JENIS_KUITANSI = 'NB'  THEN
					PREMI
			   ELSE
					0
			   END) DES_NB,
			   SUM(CASE WHEN TO_CHAR(TGL_BOOKED,'MM') = '12' AND KD_JENIS_KUITANSI = 'OB'  THEN
					PREMI
			   ELSE
					0
			   END) DES_OB                 
		FROM pladm.PELUNASAN_UPLD_MST a
		WHERE PREMI > 0
		AND TO_CHAR(TGL_BOOKED,'YYYY') = '2012'
		and key = (select key from key_kontrak where no_polis_plindo = '$no_polis')
		GROUP BY KEY,KD_JENIS_ASURANSI";	  
	//echo $sql;
	$DB->parse($sqlx);
  $DB->execute();
  $result = $DB->result();
?>
<html>
<head>
<title>HISTORIS PELUNASAN</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
</head>
<body>
<form name="propmtc14" method="POST" action="<? PHP_SELF; ?>">
<table cellpadding="1" border="0" cellspacing="1" width="100%" class="tblborder">
 <tr class="arial10wht">
   <td><b>HISTORIS PELUNASAN <? echo $pempol;?></b></td></tr>
 <tr class="arial10wht"><td><b>POLIS NO : <? echo $no_polis."/".$no_polis_lama;?></b></td></tr>
<tr>	
 <td>
	<table border="0" cellpadding="1" cellspacing="1" width="100%" class="tblisi">
    <tr class="hijao" align=center>
    <td>NO</td>
    <td>JENIS ASURANSI</td>
	<td colspan="2">JANUARI</td>
    <td colspan="2">FEBRUARI</td>
    <td colspan="2">MARET</td>
    <td colspan="2">APRIL</td>
    <td colspan="2">MEI</td>
    <td colspan="2">JUNI</td>
    <td colspan="2">JULI</td>
    <td colspan="2">AGUSTUS</td>
    <td colspan="2">SEPTEMBER</td>
    <td colspan="2">OKTOBER</td>
    <td colspan="2">NOVEMBER</td>
    <td colspan="2">DESEMBER</td>	  
	</tr>
	<tr class="hijao" align=center>
    <td></td>
    <td></td>
	<td>NB</td>
	<td>OB</td>
    <td>NB</td>
	<td>OB</td>
    <td>NB</td>
	<td>OB</td>
    <td>NB</td>
	<td>OB</td>
    <td>NB</td>
	<td>OB</td>
    <td>NB</td>
	<td>OB</td>
    <td>NB</td>
	<td>OB</td>
    <td>NB</td>
	<td>OB</td>
    <td>NB</td>
	<td>OB</td>
    <td>NB</td>
	<td>OB</td>
    <td>NB</td>
	<td>OB</td>
    <td>NB</td>
	<td>OB</td>   
	</tr>

<? 

	$jmlpremi = 0; $jmlbenefit = 0;
  reset($result);
	$i=1;
  foreach ($result as $foo => $arr) {
 		include "../../includes/belang.php";
		echo "<td class=verdana9>$i</td>";
		echo "<td class=verdana9c>".$arr['KD_JENIS_ASURANSI']."</td>";
		echo "<td class=verdana9r>".number_format($arr['JAN_NB'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['JAN_OB'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['FEB_NB'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['FEB_OB'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['MAR_NB'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['MAR_OB'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['APR_NB'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['APR_OB'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['MEI_NB'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['MEI_OB'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['JUN_NB'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['JUN_OB'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['JUL_NB'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['JUL_OB'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['AGU_NB'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['AGU_OB'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['SEP_NB'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['SEP_OB'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['OKT_NB'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['OKT_OB'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['NOV_NB'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['NOV_OB'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['DES_NB'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['DES_OB'], 2, ',', '.')."</td>";

		$jml_JAN_NB+=$arr['JAN_NB'];
		$jml_JAN_OB+=$arr['JAN_OB'];
		$jml_FEB_NB+=$arr['FEB_NB'];
		$jml_FEB_OB+=$arr['FEB_OB'];
		$jml_MAR_NB+=$arr['MAR_NB'];
		$jml_MAR_OB+=$arr['MAR_OB'];
		$jml_APR_NB+=$arr['APR_NB'];
		$jml_APR_OB+=$arr['APR_OB'];
		$jml_MEI_NB+=$arr['MEI_NB'];
		$jml_MEI_OB+=$arr['MEI_OB'];
		$jml_JUN_NB+=$arr['JUN_NB'];
		$jml_JUN_OB+=$arr['JUN_OB'];
		$jml_JUL_NB+=$arr['JUL_NB'];
		$jml_JUL_OB+=$arr['JUL_OB'];
		$jml_AGU_NB+=$arr['AGU_NB'];
		$jml_AGU_OB+=$arr['AGU_OB'];
		$jml_SEP_NB+=$arr['SEP_NB'];
		$jml_SEP_OB+=$arr['SEP_OB'];
		$jml_OKT_NB+=$arr['OKT_NB'];
		$jml_OKT_OB+=$arr['OKT_OB'];
		$jml_NOV_NB+=$arr['NOV_NB'];
		$jml_NOV_OB+=$arr['NOV_OB'];
		$jml_DES_NB+=$arr['DES_NB'];
		$jml_DES_OB+=$arr['DES_OB'];		
		$i++;
		echo "</tr>";
	} //foreach
	echo "<tr class=tblhead1>";
	echo '<td align="center" colspan="2">JUMLAH</td>';
	
	echo "<td class=arial10whtr>".number_format($jml_JAN_NB, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_JAN_OB, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_FEB_NB, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_FEB_OB, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_MAR_NB, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_MAR_OB, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_APR_NB, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_APR_OB, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_MEI_NB, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_MEI_OB, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_JUN_NB, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_JUN_OB, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_JUL_NB, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_JUL_OB, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_AGU_NB, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_AGU_OB, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_SEP_NB, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_SEP_OB, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_OKT_NB, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_OKT_OB, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_NOV_NB, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_NOV_OB, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_DES_NB, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_DES_OB, 2, ',', '.')."</td>";

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
