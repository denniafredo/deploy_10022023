<? 
  include "../../includes/database.php";
  include "../../includes/common.php";
  include "../../includes/formula44.php";
  include "../../includes/session.php";
	$DB=New database($userid, $passwd, $DBName);
	$prefixpertanggungan = (!$prefixpertanggungan) ? $kantor : $prefixpertanggungan;

	/*$sql="select decode(a.status,'8','CLAIMED','9','TERMINAL','') status,a.kdproduk,a.periodebayar,a.periodebenefit,a.kdbenefit,a.nilaibenefit,a.premi,a.kdjenisbenefit, ".
			 " a.expirasi,b.kdrumusbenefit, b.kdrumuspremi, b.kdrumusexpirasi,c.namabenefit,to_char(a.expirasi,'DD/MM/YYYY') expirasi ".
       "from $DBUser.tabel_223_transaksi_produk a, $DBUser.tabel_206_produk_benefit b, $DBUser.tabel_207_kode_benefit c ".
  	   "where a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan' ".
       "and a.kdproduk=b.kdproduk(+) and a.kdbenefit=b.kdbenefit(+) and a.kdbenefit=c.kdbenefit(+) ".
			 "order by a.expirasi";*/
	/*$sql="select * from (
  SELECT   DECODE (a.status, '8', 'CLAIMED', '9', 'TERMINAL', '') status,
           a.kdproduk,
           a.periodebayar,
           a.periodebenefit,
           a.kdbenefit,
           a.nilaibenefit,
           a.premi,
           a.kdjenisbenefit,
           a.expirasi expir,
           b.kdrumusbenefit,
           b.kdrumuspremi,
           b.kdrumusexpirasi,
           c.namabenefit,	
           TO_CHAR (a.expirasi, 'DD/MM/YYYY') expirasi
    FROM   $DBUser.tabel_223_transaksi_produk a,
           $DBUser.tabel_206_produk_benefit b,
           $DBUser.tabel_207_kode_benefit c
   WHERE       a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan'
           AND a.kdproduk = b.kdproduk(+)
           AND a.kdbenefit = b.kdbenefit(+)
           AND a.kdbenefit = c.kdbenefit(+)
		   AND a.kdjenisbenefit <> 'R'
union
SELECT   DECODE (x.status, '8', 'CLAIMED', '9', 'TERMINAL', '') status,
           x.kdproduk,
           null periodebayar,
           null periodebenefit,
           x.kdbenefit,
           x.nilaibenefit,
           x.premi,
           x.kdbenefit,
           x.tglselesai expir,
           b.kdrumusbenefit,
           b.kdrumuspremi,
           b.kdrumusexpirasi,
           c.namabenefit,
           TO_CHAR (x.tglmulai, 'DD/MM/YYYY') expirasi
    FROM   $DBUser.tabel_223_transaksi_rider x,
           $DBUser.tabel_206_produk_benefit b,
           $DBUser.tabel_207_kode_benefit c,
           $DBUser.tabel_200_pertanggungan d
   WHERE       x.prefixpertanggungan='$prefixpertanggungan' and x.nopertanggungan='$nopertanggungan'
           AND x.prefixpertanggungan=d.prefixpertanggungan
           AND x.nopertanggungan=d.nopertanggungan
           AND x.kdproduk = b.kdproduk(+)
           AND x.kdbenefit = b.kdbenefit(+)
           AND x.kdbenefit = c.kdbenefit(+)
		   AND TO_CHAR (nvl(x.tglselesai,sysdate), 'YYYMMDD') >= TO_CHAR (sysdate, 'YYYMMDD')
           --and TO_CHAR (x.tglmulai, 'YYYMM') > TO_CHAR (d.mulas, 'YYYMM')
   UNION
   SELECT   DECODE (a.status, '8', 'CLAIMED', '9', 'TERMINAL', '') status,
           a.kdproduk,
           a.periodebayar,
           a.periodebenefit,
           a.kdbenefit,
           a.nilaibenefit,
           a.premi,
           a.kdjenisbenefit,
           a.expirasi expir,
           b.kdrumusbenefit,
           b.kdrumuspremi,
           b.kdrumusexpirasi,
           c.namabenefit,
           TO_CHAR (a.expirasi, 'DD/MM/YYYY') expirasi
    FROM   $DBUser.tabel_223_transaksi_produk a,
           $DBUser.tabel_206_produk_benefit b,
           $DBUser.tabel_207_kode_benefit c
   WHERE       a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$	'
           AND a.kdproduk = b.kdproduk(+)
           AND a.kdbenefit = b.kdbenefit(+)
           AND a.kdbenefit = c.kdbenefit(+)
		   AND a.kdbenefit IN ('BNFCRIL','JMNKEC')         
           )
ORDER BY   expir desc";*/
//	echo $sql;
$sql="SELECT   *
    FROM   (
    SELECT   DECODE (a.status, '8', 'CLAIMED', '9', 'TERMINAL','X','TERMINATED', '')
                        status,
                     a.kdproduk,
                     a.periodebayar,
                     a.periodebenefit,
                     a.kdbenefit,
                     a.nilaibenefit,
                     a.premi,
                     a.kdjenisbenefit,
                     a.expirasi expir,
                     b.kdrumusbenefit,
                     b.kdrumuspremi,
                     b.kdrumusexpirasi,
                     c.namabenefit,
                     TO_CHAR (a.expirasi, 'DD/MM/YYYY') expirasi
              FROM   $DBUser.tabel_223_transaksi_produk a,
                     $DBUser.tabel_206_produk_benefit b,
                     $DBUser.tabel_207_kode_benefit c
             WHERE      a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan'
                     AND a.kdproduk = b.kdproduk(+)
                     AND a.kdbenefit = b.kdbenefit(+)
                     AND a.kdbenefit = c.kdbenefit(+)
                     AND a.kdjenisbenefit = 'R'
                     AND substr(A.KDPRODUK,1,4)='JL4B'
                     UNION
    SELECT   DECODE (a.status, '8', 'CLAIMED', '9', 'TERMINAL', '')
                        status,
                     a.kdproduk,
                     a.periodebayar,
                     a.periodebenefit,
                     a.kdbenefit,
                     a.nilaibenefit,
                     a.premi,
                     a.kdjenisbenefit,
                     a.expirasi expir,
                     b.kdrumusbenefit,
                     b.kdrumuspremi,
                     b.kdrumusexpirasi,
                     c.namabenefit,
                     TO_CHAR (a.expirasi, 'DD/MM/YYYY') expirasi
              FROM   $DBUser.tabel_223_transaksi_produk a,
                     $DBUser.tabel_206_produk_benefit b,
                     $DBUser.tabel_207_kode_benefit c
             WHERE   a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan'
                     AND a.kdproduk = b.kdproduk(+)
                     AND a.kdbenefit = b.kdbenefit(+)
                     AND a.kdbenefit = c.kdbenefit(+)
                     AND a.kdjenisbenefit <> 'R'
            UNION
            SELECT   DECODE (x.status, '8', 'CLAIMED', '9', 'TERMINAL', '')
                        status,
                     x.kdproduk,
                     NULL periodebayar,
                     NULL periodebenefit,
                     x.kdbenefit,
                     x.nilaibenefit,
                     x.premi,
                     x.kdbenefit,
                     x.tglselesai expir,
                     b.kdrumusbenefit,
                     b.kdrumuspremi,
                     b.kdrumusexpirasi,
                     c.namabenefit,
                     TO_CHAR (x.tglmulai, 'DD/MM/YYYY') expirasi
              FROM   $DBUser.tabel_223_transaksi_rider x,
                     $DBUser.tabel_206_produk_benefit b,
                     $DBUser.tabel_207_kode_benefit c,
                     $DBUser.tabel_200_pertanggungan d
             WHERE       x.prefixpertanggungan='$prefixpertanggungan' and x.nopertanggungan='$nopertanggungan'
                     AND x.prefixpertanggungan = d.prefixpertanggungan
                     AND x.nopertanggungan = d.nopertanggungan
                     AND x.kdproduk = b.kdproduk(+)
                     AND x.kdbenefit = b.kdbenefit(+)
                     AND x.kdbenefit = c.kdbenefit(+)
                     AND TO_CHAR (NVL (x.tglselesai, SYSDATE), 'YYYMMDD') >=
                           TO_CHAR (SYSDATE, 'YYYMMDD')
                     AND substr(X.KDPRODUK,1,4)!='JL4B'
            UNION
            SELECT   DECODE (a.status, '8', 'CLAIMED', '9', 'TERMINAL', '')
                        status,
                     a.kdproduk,
                     a.periodebayar,
                     a.periodebenefit,
                     a.kdbenefit,
                     a.nilaibenefit,
                     a.premi,
                     a.kdjenisbenefit,
                     a.expirasi expir,
                     b.kdrumusbenefit,
                     b.kdrumuspremi,
                     b.kdrumusexpirasi,
                     c.namabenefit,
                     TO_CHAR (a.expirasi, 'DD/MM/YYYY') expirasi
              FROM   $DBUser.tabel_223_transaksi_produk a,
                     $DBUser.tabel_206_produk_benefit b,
                     $DBUser.tabel_207_kode_benefit c
             WHERE      a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan'
                     AND a.kdproduk = b.kdproduk(+)
                     AND a.kdbenefit = b.kdbenefit(+)
                     AND a.kdbenefit = c.kdbenefit(+)
                     AND a.kdbenefit IN ('BNFCRIL', 'JMNKEC'))
ORDER BY   expir DESC";
//echo $sql;
	$DB->parse($sql);
  $DB->execute();
  $result = $DB->result();
?>
<html>
<head>
<title>Benefit Polis</title>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
<link href="../jws.css" rel="stylesheet" type="text/css">
</head>
<body>
<form name="propmtc14" method="POST" action="<? PHP_SELF; ?>">
<table cellpadding="1" border="0" cellspacing="1" width="100%" class="tblborder">
 <tr class="arial10wht">
	<td align="center">
		<?php $sql = "SELECT nopolbaru FROM $DBUser.tabel_200_pertanggungan WHERE prefixpertanggungan = '$prefixpertanggungan' AND nopertanggungan = '$nopertanggungan'";
		$DB->parse($sql);
		$DB->execute();
		$r = $DB->nextrow();
		?>
		<b>Benefit Produk Proposal Nomor <?echo ($r['NOPOLBARU'] ? $r['NOPOLBARU'] : $prefixpertanggungan."-".$nopertanggungan) ?></b>
	</td>
 </tr>
<tr>	
 <td>
	<table border="0" cellpadding="1" cellspacing="1" width="100%" class="tblisi">
	<tr class="hijao" align=center>
	<td>No</td>
	<td>Kode</td>
	<td>Nama Benefit</td>
	<td>Jumlah Benefit</td>
	<td>Premi</td>
	<td>Jatuh Tempo</td>
	<td>Jenis</td>
	<td>Status</td>
	</tr>

<? 

	$jmlpremi = 0; $jmlbenefit = 0;
  reset($result);
	$i=1;
  foreach ($result as $foo => $arr) {
 		include "../../includes/belang.php";
		echo "<td class=verdana9>$i</td>";
		echo "<td class=verdana9>".$arr["KDBENEFIT"]."</td>";
		echo "<td class=verdana9>".$arr["NAMABENEFIT"]."</td>";
		$test=$arr["PREMI"]!=0 ? number_format($arr["PREMI"],2):' ';
		$tist=$arr["NILAIBENEFIT"]!=0 ? number_format($arr["NILAIBENEFIT"],2):' ';
		echo "<td align=right class=verdana9>".$tist."</td>";
		echo "<td align=\"right\" class=verdana9>".$test."</td>";
		
		echo "<td align=center class=verdana8blk>".$arr["EXPIRASI"]."</td>";
		echo "<td align=center class=verdana9>".$arr["KDJENISBENEFIT"]."</td>";
	  echo "<td align=left class=verdana8>".$arr["STATUS"]."</td>";
	  echo "</tr>";
		//$jmlpremi = $jmlpremi + $test; 
		$jmlpremi = $jmlpremi + $arr["PREMI"]; 
		$jmlbenefit = $jmlbenefit + $hasilbenefit; 
		$i++;
		$kdproduk = $arr['KDPRODUK'];
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
			 
	echo "<tr class=tblhead1><td colspan=4 align=right class=arial10wht>Premi Standar Tahunan</td>";
	echo "<td align=right class=arial10wht>".number_format($fb["PREMISTD"],2)."</td>";
	echo "<td align=right class=arial10wht colspan=3></td>";
	echo "<tr class=tblisi1><td colspan=4 align=right class=verdana9>Premi ".$fb["NAMACARABAYAR"]."</td>";
	echo "<td align=right class=verdana9><b>".number_format(($jmlpremi*$faktorbayar),2)."</td>";
	echo "<td align=right class=arial10wht colspan=3></td>";
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
	  <font face="verdana" size="2">
		<? if ($kdproduk == 'JSR1' || $kdproduk == 'JSR2' || $kdproduk == 'JSR3') {
			echo "<a href='javascript:void(0);' onclick=\"NewWindow('../polis/pop_his_cp_ho.php?prefix=$prefixpertanggungan&noper=$nopertanggungan','pupuphistoriklaim','900','450','yes');return false\">Histori Klaim CP</a> | ";
		} ?>
		<a href="javascript:window.close();">Close</a>
	  </font>
	</td>
</tr> 
</table>
</form>
</body>
</html>
