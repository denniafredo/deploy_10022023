<? 
  include "../../includes/database.php";
  include "../../includes/common.php";
  include "../../includes/formula44.php";
  include "../../includes/session.php";
	$DB=New database($userid, $passwd, $DBName);
	$prefixpertanggungan = (!$prefixpertanggungan) ? $kantor : $prefixpertanggungan;

	/*$sql="select decode(a.status,'8','CLAIMED','9','TERMINAL','') status,a.kdproduk,a.periodebayar,a.periodebenefit,a.kdbenefit,a.nilaibenefit,a.premi,a.kdjenisbenefit, 'cetakklausulacp.php' doc,".
			 " a.expirasi,b.kdrumusbenefit, b.kdrumuspremi, b.kdrumusexpirasi,c.namabenefit,to_char(a.expirasi,'DD/MM/YYYY') expirasi ".
       "from $DBUser.tabel_223_transaksi_produk a, $DBUser.tabel_206_produk_benefit b, $DBUser.tabel_207_kode_benefit c ".
  	   "where premi is not null and substr(a.kdbenefit,1,3) in ('CPM','CPB') and a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan' ".
       "and a.kdproduk=b.kdproduk(+) and a.kdbenefit=b.kdbenefit(+) and a.kdbenefit=c.kdbenefit(+) ".
	   "UNION select decode(a.status,'8','CLAIMED','9','TERMINAL','') status,a.kdproduk,a.periodebayar,a.periodebenefit,a.kdbenefit,a.nilaibenefit,a.premi,a.kdjenisbenefit, 'cetakklausulaterm.php' doc,".
			 " a.expirasi,b.kdrumusbenefit, b.kdrumuspremi, b.kdrumusexpirasi,c.namabenefit,to_char(a.expirasi,'DD/MM/YYYY') expirasi ".
       "from $DBUser.tabel_223_transaksi_produk a, $DBUser.tabel_206_produk_benefit b, $DBUser.tabel_207_kode_benefit c ".
  	   "where premi is not null and a.kdbenefit in ('TERM') and a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan' ".
       "and a.kdproduk=b.kdproduk(+) and a.kdbenefit=b.kdbenefit(+) and a.kdbenefit=c.kdbenefit(+) ".
	   "UNION select decode(a.status,'8','CLAIMED','9','TERMINAL','') status,a.kdproduk,a.periodebayar,a.periodebenefit,a.kdbenefit,a.nilaibenefit,a.premi,a.kdjenisbenefit, 'cetakklausulapa.php' doc,".
			 " a.expirasi,b.kdrumusbenefit, b.kdrumuspremi, b.kdrumusexpirasi,c.namabenefit,to_char(a.expirasi,'DD/MM/YYYY') expirasi ".
       "from $DBUser.tabel_223_transaksi_produk a, $DBUser.tabel_206_produk_benefit b, $DBUser.tabel_207_kode_benefit c ".
  	   "where premi is not null and a.kdbenefit in ('PA') and a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan' ".
       "and a.kdproduk=b.kdproduk(+) and a.kdbenefit=b.kdbenefit(+) and a.kdbenefit=c.kdbenefit(+) ".
	    "UNION select decode(a.status,'8','CLAIMED','9','TERMINAL','') status,a.kdproduk,a.periodebayar,a.periodebenefit,a.kdbenefit,a.nilaibenefit,a.premi,a.kdjenisbenefit, 'cetakklausulaci.php' doc,".
			 " a.expirasi,b.kdrumusbenefit, b.kdrumuspremi, b.kdrumusexpirasi,c.namabenefit,to_char(a.expirasi,'DD/MM/YYYY') expirasi ".
       "from $DBUser.tabel_223_transaksi_produk a, $DBUser.tabel_206_produk_benefit b, $DBUser.tabel_207_kode_benefit c ".
  	   "where premi is not null and a.kdbenefit in ('CI') and a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan' ".
       "and a.kdproduk=b.kdproduk(+) and a.kdbenefit=b.kdbenefit(+) and a.kdbenefit=c.kdbenefit(+) ".
	    "UNION select decode(a.status,'8','CLAIMED','9','TERMINAL','') status,a.kdproduk,a.periodebayar,a.periodebenefit,a.kdbenefit,a.nilaibenefit,a.premi,a.kdjenisbenefit, 'cetakklausulacacad.php' doc,".
			 " a.expirasi,b.kdrumusbenefit, b.kdrumuspremi, b.kdrumusexpirasi,c.namabenefit,to_char(a.expirasi,'DD/MM/YYYY') expirasi ".
       "from $DBUser.tabel_223_transaksi_produk a, $DBUser.tabel_206_produk_benefit b, $DBUser.tabel_207_kode_benefit c ".
  	   "where premi is not null and a.kdbenefit in ('CACAD') and a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan' ".
       "and a.kdproduk=b.kdproduk(+) and a.kdbenefit=b.kdbenefit(+) and a.kdbenefit=c.kdbenefit(+) ".
	    "UNION select decode(a.status,'8','CLAIMED','9','TERMINAL','') status,a.kdproduk,a.periodebayar,a.periodebenefit,a.kdbenefit,a.nilaibenefit,a.premi,a.kdjenisbenefit, 'cetakklausulawaiver.php' doc,".
			 " a.expirasi,b.kdrumusbenefit, b.kdrumuspremi, b.kdrumusexpirasi,c.namabenefit,to_char(a.expirasi,'DD/MM/YYYY') expirasi ".
       "from $DBUser.tabel_223_transaksi_produk a, $DBUser.tabel_206_produk_benefit b, $DBUser.tabel_207_kode_benefit c ".
  	   "where premi is not null and a.kdbenefit in ('WAIVER') and a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan' ".
       "and a.kdproduk=b.kdproduk(+) and a.kdbenefit=b.kdbenefit(+) and a.kdbenefit=c.kdbenefit(+) ".
			 "--order by a.expirasi";*/
	$sql="SELECT   DECODE (a.status, '8', 'CLAIMED', '9', 'TERMINAL', '') status,
				 a.kdproduk,
				 a.kdbenefit,
				 a.nilaibenefit,
				 a.premi,
				 'cetakklausulacp.php' doc,
				 TO_CHAR (a.tglmulai, 'DD/MM/YYYY') tglmulai ,
				 a.tglselesai ,
				 b.kdrumusbenefit,
				 b.kdrumuspremi,
				 b.kdrumusexpirasi,
				 c.namabenefit,
				 TO_CHAR (a.tglselesai, 'DD/MM/YYYY') expirasi
		  FROM   $DBUser.tabel_223_transaksi_rider a,
				 $DBUser.tabel_206_produk_benefit b,
				 $DBUser.tabel_207_kode_benefit c
		 WHERE       premi IS NOT NULL
				 AND SUBSTR (a.kdbenefit, 1, 2) IN ('CP', 'CP')
				 and a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan'
				 AND a.kdproduk = b.kdproduk(+)
				 AND a.kdbenefit = b.kdbenefit(+)
				 AND a.kdbenefit = c.kdbenefit(+)
		UNION
		SELECT   DECODE (a.status, '8', 'CLAIMED', '9', 'TERMINAL', '') status,
				 a.kdproduk,
				 a.kdbenefit,
				 a.nilaibenefit,
				 a.premi,
				 'cetakklausulaterm.php' doc,
				 TO_CHAR (a.tglmulai, 'DD/MM/YYYY') tglmulai ,
				 a.tglselesai,
				 b.kdrumusbenefit,
				 b.kdrumuspremi,
				 b.kdrumusexpirasi,
				 c.namabenefit,
				 TO_CHAR (a.tglselesai, 'DD/MM/YYYY') expirasi
		  FROM   $DBUser.tabel_223_transaksi_rider a,
				 $DBUser.tabel_206_produk_benefit b,
				 $DBUser.tabel_207_kode_benefit c
		 WHERE       premi IS NOT NULL
				 AND a.kdbenefit IN ('TERM','TI')
				 and a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan'
				 AND a.kdproduk = b.kdproduk(+)
				 AND a.kdbenefit = b.kdbenefit(+)
				 AND a.kdbenefit = c.kdbenefit(+)
		UNION
		SELECT   DECODE (a.status, '8', 'CLAIMED', '9', 'TERMINAL', '') status,
				 a.kdproduk,
				 a.kdbenefit,
				 a.nilaibenefit,
				 a.premi,
				 'cetakklausulapa.php' doc,
				 TO_CHAR (a.tglmulai, 'DD/MM/YYYY') tglmulai ,
				 a.tglselesai,
				 b.kdrumusbenefit,
				 b.kdrumuspremi,
				 b.kdrumusexpirasi,
				 c.namabenefit,
				 TO_CHAR (a.tglselesai, 'DD/MM/YYYY') expirasi
		  FROM   $DBUser.tabel_223_transaksi_rider a,
				 $DBUser.tabel_206_produk_benefit b,
				 $DBUser.tabel_207_kode_benefit c
		 WHERE       premi IS NOT NULL
				 AND a.kdbenefit IN ('PA','JMNKEC')
				 and a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan'
				 AND a.kdproduk = b.kdproduk(+)
				 AND a.kdbenefit = b.kdbenefit(+)
				 AND a.kdbenefit = c.kdbenefit(+)
		UNION
		SELECT   DECODE (a.status, '8', 'CLAIMED', '9', 'TERMINAL', '') status,
				 a.kdproduk,
				 a.kdbenefit,
				 a.nilaibenefit,
				 a.premi,
				 'cetakklausulaci.php' doc,
				 TO_CHAR (a.tglmulai, 'DD/MM/YYYY') tglmulai ,
				 a.tglselesai,
				 b.kdrumusbenefit,
				 b.kdrumuspremi,
				 b.kdrumusexpirasi,
				 c.namabenefit,
				 TO_CHAR (a.tglselesai, 'DD/MM/YYYY') expirasi
		  FROM   $DBUser.tabel_223_transaksi_rider a,
				 $DBUser.tabel_206_produk_benefit b,
				 $DBUser.tabel_207_kode_benefit c
		 WHERE       premi IS NOT NULL
				 AND a.kdbenefit IN ('CI','BNFCRIL','CI53')
				 and a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan'
				 AND a.kdproduk = b.kdproduk(+)
				 AND a.kdbenefit = b.kdbenefit(+)
				 AND a.kdbenefit = c.kdbenefit(+)
		UNION
		SELECT   DECODE (a.status, '8', 'CLAIMED', '9', 'TERMINAL', '') status,
				 a.kdproduk,
				 a.kdbenefit,
				 a.nilaibenefit,
				 a.premi,
				 'cetakklausulacacad.php' doc,
				 TO_CHAR (a.tglmulai, 'DD/MM/YYYY') tglmulai ,
				 a.tglselesai,
				 b.kdrumusbenefit,
				 b.kdrumuspremi,
				 b.kdrumusexpirasi,
				 c.namabenefit,
				 TO_CHAR (a.tglselesai, 'DD/MM/YYYY') expirasi
		  FROM   $DBUser.tabel_223_transaksi_rider a,
				 $DBUser.tabel_206_produk_benefit b,
				 $DBUser.tabel_207_kode_benefit c
		 WHERE       premi IS NOT NULL
				 AND a.kdbenefit IN ('CACAD')
				 and a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan'
				 AND a.kdproduk = b.kdproduk(+)
				 AND a.kdbenefit = b.kdbenefit(+)
				 AND a.kdbenefit = c.kdbenefit(+)
		UNION
		SELECT   DECODE (a.status, '8', 'CLAIMED', '9', 'TERMINAL', '') status,
				 a.kdproduk,
				 a.kdbenefit,
				 a.nilaibenefit,
				 a.premi,
				 'cetakklausulawaiver.php' doc,
				 TO_CHAR (a.tglmulai, 'DD/MM/YYYY') tglmulai ,
				 a.tglselesai,
				 b.kdrumusbenefit,
				 b.kdrumuspremi,
				 b.kdrumusexpirasi,
				 c.namabenefit,
				 TO_CHAR (a.tglselesai, 'DD/MM/YYYY') expirasi
		  FROM   $DBUser.tabel_223_transaksi_rider a,
				 $DBUser.tabel_206_produk_benefit b,
				 $DBUser.tabel_207_kode_benefit c
		 WHERE       premi IS NOT NULL
				 AND a.kdbenefit IN ('WAIVER')
				 and a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan'
				 AND a.kdproduk = b.kdproduk(+)
				 AND a.kdbenefit = b.kdbenefit(+)
				 AND a.kdbenefit = c.kdbenefit(+)
		UNION
		SELECT   DECODE (a.status, '8', 'CLAIMED', '9', 'TERMINAL', '') status,
				 a.kdproduk,
				 a.kdbenefit,
				 a.nilaibenefit,
				 a.premi,
				 'cetakklausulatpd.php' doc,
				 TO_CHAR (a.tglmulai, 'DD/MM/YYYY') tglmulai ,
				 a.tglselesai,
				 b.kdrumusbenefit,
				 b.kdrumuspremi,
				 b.kdrumusexpirasi,
				 c.namabenefit,
				 TO_CHAR (a.tglselesai, 'DD/MM/YYYY') expirasi
		  FROM   $DBUser.tabel_223_transaksi_rider a,
				 $DBUser.tabel_206_produk_benefit b,
				 $DBUser.tabel_207_kode_benefit c
		 WHERE       premi IS NOT NULL
				 AND a.kdbenefit IN ('TPD')
				 and a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan'
				 AND a.kdproduk = b.kdproduk(+)
				 AND a.kdbenefit = b.kdbenefit(+)
				 AND a.kdbenefit = c.kdbenefit(+)				 ";
	//echo $sql;
	$DB->parse($sql);
  $DB->execute();
  $result = $DB->result();
?>
<html>
<head>
<title>Benefit Polis</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
</head>
<body>
<form name="propmtc14" method="POST" action="<? PHP_SELF; ?>">
<table cellpadding="1" border="0" cellspacing="1" width="100%" class="tblborder">
 <tr class="arial10wht"><td align="center"><b>Benefit Produk Proposal Nomor <?echo $prefixpertanggungan."-".$nopertanggungan;?></b></td></tr>
<tr>	
 <td>
	<table border="0" cellpadding="1" cellspacing="1" width="100%" class="tblisi">
	<tr class="hijao" align=center>
	<td>No</td>
	<td>Kode</td>
	<td>Nama Benefit</td>
	<td>Jumlah Benefit</td>
	<td>Premi</td>
    <td>Mulai</td>
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
		echo "<td align=center class=verdana8blk>".$arr["TGLMULAI"]."</td>";
		echo "<td align=center class=verdana8blk>".$arr["EXPIRASI"]."</td>";
		echo "<td align=center class=verdana9>".$arr["KDJENISBENEFIT"]."</td>";
	  //echo "<td align=left class=verdana8>".$arr["STATUS"]."</td>";
	  echo "<td align=left class=verdana8><input disabled=true type='button' class='buton' name='cetakklausul'  value='CETAK' onClick=NewWindow('../polis/".$arr["DOC"]."?prefixpertanggungan=$prefixpertanggungan&nopertanggungan=$nopertanggungan&cp=".substr($arr["KDBENEFIT"],0,3)."&ex=".$arr["EXPIRASI"]."','',800,500,1)></td>";
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
			 
	echo "<tr class=tblhead1><td colspan=4 align=right class=arial10wht>Premi Standar Tahunan</td>";
	echo "<td align=right class=arial10wht>".number_format($fb["PREMISTD"],2)."</td>";
	echo "<td align=right class=arial10wht colspan=4></td>";
	echo "<tr class=tblisi1><td colspan=4 align=right class=verdana9>Premi ".$fb["NAMACARABAYAR"]."</td>";
	echo "<td align=right class=verdana9><b>".number_format(($jmlpremi/*$faktorbayar*/),2)."</td>";
	
	$sql = "select kdproduk from $DBUser.tabel_200_pertanggungan where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
	$DB->parse($sql);
	$DB->execute();
	$row = $DB->nextrow();
	
	/*===== tambahan dari fendy 04/02/2016 atas request bu liza 04/02/2016 =====*/
	if (substr($row['KDPRODUK'], 0, 3) == 'JL4') {
		echo "<td align=right class=arial10wht colspan=4>
				<input disabled=true type='button' class='buton' name='cetakklausul'  value='NOTICE' onClick=NewWindow('../polis/notice.php?prefixpertanggungan=$prefixpertanggungan&nopertanggungan=$nopertanggungan&cp=".substr($arr["KDBENEFIT"],0,3)."','',800,500,1)>
		  </td>";
	}
	else {
		echo "<td align=right class=arial10wht colspan=4>
				<input disabled=true type='button' class='buton' name='cetakklausul'  value='NOTICE' onClick=NewWindow('../polis/notice.php?prefixpertanggungan=$prefixpertanggungan&nopertanggungan=$nopertanggungan&cp=".substr($arr["KDBENEFIT"],0,3)."','',800,500,1)>
				<input type='button' class='buton' name='cetakklausulnew'  value='REKAPITULASI PREMI' onClick=NewWindow('../polis/notice_new.php?prefixpertanggungan=$prefixpertanggungan&nopertanggungan=$nopertanggungan&cp=".substr($arr["KDBENEFIT"],0,3)."','',800,500,1)>										
		  </td>";
	}
	/*===== akhir tambahan dari fendy 04/02/2016 =====*/
	
	echo "</table>";
?>
</td>
</tr>
</table>
</td>
</tr>
</table>
<!--a href='http://192.168.2.23/jiwasraya/file/download/dl.php?act=dl&file=SYARAT_JAMINAN_TAMBAHAN_WAIVER.pdf'><font size="2" face="Verdana, Arial, Helvetica, sans-serif">CETAK SYARAT JAMINAN TAMBAHAN WAIVER</font></a></br>
<a href='http://192.168.2.23/jiwasraya/file/download/dl.php?act=dl&file=SYARAT_JAMINAN_TAMBAHAN_CI.pdf'><font size="2" face="Verdana, Arial, Helvetica, sans-serif">CETAK SYARAT JAMINAN TAMBAHAN CI</a></font></br>
<a href='http://192.168.2.23/jiwasraya/file/download/dl.php?act=dl&file=SYARAT_JAMINAN_TAMBAHAN_CP.pdf'><font size="2" face="Verdana, Arial, Helvetica, sans-serif">CETAK SYARAT JAMINAN TAMBAHAN CP</a></font></br>
<a href='http://192.168.2.23/jiwasraya/file/download/dl.php?act=dl&file=SYARAT_JAMINAN_TAMBAHAN_TPD.pdf'><font size="2" face="Verdana, Arial, Helvetica, sans-serif">CETAK SYARAT JAMINAN TAMBAHAN CACAD</font></a-->

<!--a href='#'><font size="2" face="Verdana, Arial, Helvetica, sans-serif">CETAK SYARAT JAMINAN TAMBAHAN WAIVER</font></a></br>
<a href='#'><font size="2" face="Verdana, Arial, Helvetica, sans-serif">CETAK SYARAT JAMINAN TAMBAHAN CI</a></font></br>
<a href='#'><font size="2" face="Verdana, Arial, Helvetica, sans-serif">CETAK SYARAT JAMINAN TAMBAHAN CP</a></font></br>
<a href='#'><font size="2" face="Verdana, Arial, Helvetica, sans-serif">CETAK SYARAT JAMINAN TAMBAHAN CACAD</font></a-->

<a href="./kk_js_hcp_sinergy..pdf">Cetak KK JS HCP Sinergy</a>

<table width="100%">
<tr>
  <td COLSPAN="3" width=100>
	  <font face="verdana" size="2"><a href="javascript:window.close();">Close</a></font>
	</td>
</tr> 
</table>

</form>
</body>
</html>
