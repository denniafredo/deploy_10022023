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
	$sqlx="select NO_KLIEN,NO_SERTIFIKAT,NIPG,NAMA,JENIS_KEL,MARITAL_STATUS,TGL_LAHIR,TGL_DINAS,TGL_MULAS,TGL_AKHAS,
		   PROS_BSX,PROS_BSI,PROS_CS,PROS_TOTAL,PROS_MAX,PROS_SISA_THT,DASAR_PENSIUN,JHT_BSX,JHT_BSI,JHT_BS,JHT_CS,
		   PRM_JHT_BSX,PRM_JHT_BSI,PRM_JHT_BS,PRM_JHT_CS,THT_BSX,THT_BSI,THT_BS,THT_CS,PRM_THT_BSX,PRM_THT_BSI,
		   PRM_THT_BS,PRM_THT_CS,JJD_CS,PRM_JJD_CS,PRM_CS,EBK,PRM_EBK,DWL,PRM_DWL,JAM_CACAT,PRM_CACAT,JAM_DPC,
		   JAM_KES,PRM_KES,JAM_YTM,JHT_BPO,JJD_BPO,DWL_BPO,THT_BPO,REST_BPO,PENS_13_BS,PRM_13_BS,PENS_13_CS,
           PRM_13_CS,TAMBAHAN_JHT,PRM_TMBH_JHT,MANFAAT_UUK,PRM_PHK,PRM_SHT_CS,PRM_SHT_BS,AKUMULASI_DANA
		   from pladm.daftar_keadaan_aktif_jht
		   where no_polis = '$no_polis'";	  
//	echo $sql;
	$DB->parse($sqlx);
  $DB->execute();
  $result = $DB->result();
?>
<html>
<head>
<title>DAFTAR KEADAAN PESERTA AKTIF</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
</head>
<body>
<form name="propmtc14" method="POST" action="<? PHP_SELF; ?>">
<table cellpadding="1" border="0" cellspacing="1" width="100%" class="tblborder">
 <tr class="arial10wht"><td><b>DAFTAR KEADAAN PESERTA AKTIF <? echo $pempol;?></b></td></tr>
 <tr class="arial10wht"><td><b>POLIS NO : <? echo $no_polis."/".$no_polis_lama;?></b></td></tr>
<tr>	
 <td>
	<table border="0" cellpadding="1" cellspacing="1" width="100%" class="tblisi">
	<tr class="hijao" align=center>
	<td>No</td>
	<td>NO_KLIEN</td>
    <td>NO_SERTIFIKAT</td>
    <td>NIPG</td>
    <td>NAMA</td>
    <td>JENIS_KEL</td>
    <td>MARITAL_STATUS</td>
    <td>TGL_LAHIR</td>
    <td>TGL_DINAS</td>
    <td>TGL_MULAS</td>
    <td>TGL_AKHAS</td>
    <td>PROS_BSX</td>
    <td>PROS_BSI</td>
    <td>PROS_CS</td>
    <td>PROS_TOTAL</td>
    <td>PROS_MAX</td>
    <td>PROS_SISA_THT</td>
    <td>DASAR_PENSIUN</td>
    <td>JHT_BSX</td>
    <td>JHT_BSI</td>
    <td>JHT_BS</td>
    <td>JHT_CS</td>
    <td>PRM_JHT_BSX</td>
    <td>PRM_JHT_BSI</td>
    <td>PRM_JHT_BS</td>
    <td>PRM_JHT_CS</td>
    <td>THT_BSX</td>
    <td>THT_BSI</td>
    <td>THT_BS</td>
    <td>THT_CS</td>
    <td>PRM_THT_BSX</td>
    <td>PRM_THT_BSI</td>
    <td>PRM_THT_BS</td>
    <td>PRM_THT_CS</td>
    <td>JJD_CS</td>
    <td>PRM_JJD_CS</td>
    <td>PRM_CS</td>
    <td>EBK</td>
    <td>PRM_EBK</td>
    <td>DWL</td>
    <td>PRM_DWL</td>
    <td>JAM_KES</td>
    <td>PRM_KES</td>
    <td>PENS_13_BS</td>
    <td>PRM_13_BS</td>
    <td>PENS_13_CS</td>
    <td>PRM_13_CS</td>
    <td>TAMBAHAN_JHT</td>
    <td>PRM_TMBH_JHT</td>
    <td>MANFAAT_UUK</td>
    <td>PRM_PHK</td>
    <td>PRM_SHT_CS</td>
    <td>PRM_SHT_BS</td>
    <td>AKUMULASI_DANA</td>
	</tr>

<? 

	$jmlpremi = 0; $jmlbenefit = 0;
  reset($result);
	$i=1;
  foreach ($result as $foo => $arr) {
 		include "../../includes/belang.php";
		echo "<td class=verdana9>$i</td>";
		echo "<td class=verdana9>".$arr['NO_KLIEN']."</td>";
		echo "<td class=verdana9>".$arr['NO_SERTIFIKAT']."</td>";
		echo "<td class=verdana9>".$arr['NIPG']."</td>";
		echo "<td class=verdana9>".$arr['NAMA']."</td>";
		echo "<td class=verdana9>".$arr['JENIS_KEL']."</td>";
		echo "<td class=verdana9>".$arr['MARITAL_STATUS']."</td>";
		// date('d/m/Y',strtotime($test1));
		//echo "<td class=verdana9>".$arr['TGL_LAHIR']."</td>";
		echo "<td class=verdana9>".date('d/m/Y',strtotime($arr['TGL_LAHIR']))."</td>";
		echo "<td class=verdana9>".date('d/m/Y',strtotime($arr['TGL_DINAS']))."</td>";
		echo "<td class=verdana9>".date('d/m/Y',strtotime($arr['TGL_MULAS']))."</td>";
		echo "<td class=verdana9>".date('d/m/Y',strtotime($arr['TGL_AKHAS']))."</td>";
		/*echo "<td class=verdana9>".$arr['TGL_DINAS']."</td>";
		echo "<td class=verdana9>".$arr['TGL_MULAS']."</td>";
		echo "<td class=verdana9>".$arr['TGL_AKHAS']."</td>";*/
		echo "<td class=verdana9c>".number_format($arr['PROS_BSX'], 2, ',', '.')." %</td>";
		echo "<td class=verdana9c>".number_format($arr['PROS_BSI'], 2, ',', '.')." %</td>";
		echo "<td class=verdana9c>".number_format($arr['PROS_CS'], 2, ',', '.')." %</td>";
		echo "<td class=verdana9c>".number_format($arr['PROS_TOTAL'], 2, ',', '.')." %</td>";
		echo "<td class=verdana9c>".number_format($arr['PROS_MAX'], 2, ',', '.')." %</td>";
		echo "<td class=verdana9c>".number_format($arr['PROS_SISA_THT'], 2, ',', '.')." %</td>";		
		echo "<td class=verdana9r>".number_format($arr['DASAR_PENSIUN'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['JHT_BSX'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['JHT_BSI'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['JHT_BS'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['JHT_CS'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['PRM_JHT_BSX'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['PRM_JHT_BSI'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['PRM_JHT_BS'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['PRM_JHT_CS'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['THT_BSX'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['THT_BSI'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['THT_BS'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['THT_CS'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['PRM_THT_BSX'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['PRM_THT_BSI'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['PRM_THT_BS'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['PRM_THT_CS'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['JJD_CS'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['PRM_JJD_CS'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['PRM_CS'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['EBK'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['PRM_EBK'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['DWL'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['PRM_DWL'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['JAM_KES'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['PRM_KES'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['PENS_13_BS'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['PRM_13_BS'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['PENS_13_CS'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['PRM_13_CS'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['TAMBAHAN_JHT'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['PRM_TMBH_JHT'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['MANFAAT_UUK'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['PRM_PHK'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['PRM_SHT_CS'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['PRM_SHT_BS'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['AKUMULASI_DANA'], 2, ',', '.')."</td>";
		$jml_DASAR_PENSIUN+=$arr['DASAR_PENSIUN'];
		$jml_JHT_BSX+=$arr['JHT_BSX'];
		$jml_JHT_BSI+=$arr['JHT_BSI'];
		$jml_JHT_BS+=$arr['JHT_BS'];
		$jml_JHT_CS+=$arr['JHT_CS'];
		$jml_PRM_JHT_BSX+=$arr['PRM_JHT_BSX'];
		$jml_PRM_JHT_BSI+=$arr['PRM_JHT_BSI'];
		$jml_PRM_JHT_BS+=$arr['PRM_JHT_BS'];
		$jml_PRM_JHT_CS+=$arr['PRM_JHT_CS'];
		$jml_THT_BSX+=$arr['THT_BSX'];
		$jml_THT_BSI+=$arr['THT_BSI'];
		$jml_THT_BS+=$arr['THT_BS'];
		$jml_THT_CS+=$arr['THT_CS'];
		$jml_PRM_THT_BSX+=$arr['PRM_THT_BSX'];
		$jml_PRM_THT_BSI+=$arr['PRM_THT_BSI'];
		$jml_PRM_THT_BS+=$arr['PRM_THT_BS'];
		$jml_PRM_THT_CS+=$arr['PRM_THT_CS'];
		$jml_JJD_CS+=$arr['JJD_CS'];
		$jml_PRM_JJD_CS+=$arr['PRM_JJD_CS'];
		$jml_PRM_CS+=$arr['PRM_CS'];
		$jml_EBK+=$arr['EBK'];
		$jml_PRM_EBK+=$arr['PRM_EBK'];
		$jml_DWL+=$arr['DWL'];
		$jml_PRM_DWL+=$arr['PRM_DWL'];
		$jml_JAM_KES+=$arr['JAM_KES'];
		$jml_PRM_KES+=$arr['PRM_KES'];
		$jml_PENS_13_BS+=$arr['PENS_13_BS'];
		$jml_PRM_13_BS+=$arr['PRM_13_BS'];
		$jml_PENS_13_CS+=$arr['PENS_13_CS'];
		$jml_PRM_13_CS+=$arr['PRM_13_CS'];
		$jml_TAMBAHAN_JHT+=$arr['TAMBAHAN_JHT'];
		$jml_PRM_TMBH_JHT+=$arr['PRM_TMBH_JHT'];
		$jml_MANFAAT_UUK+=$arr['MANFAAT_UUK'];
		$jml_PRM_PHK+=$arr['PRM_PHK'];
		$jml_PRM_SHT_CS+=$arr['PRM_SHT_CS'];
		$jml_PRM_SHT_BS+=$arr['PRM_SHT_BS'];
		$jml_AKUMULASI_DANA+=$arr['AKUMULASI_DANA'];
		$i++;
		echo "</tr>";
	} //foreach
	echo "<tr class=tblhead1>";
	echo '<td align="center" colspan="8">JUMLAH</td>';
	echo '<td></td>';
	echo '<td></td>';
	echo '<td></td>';
	echo '<td></td>';
	echo '<td></td>';
	echo '<td></td>';
	echo '<td></td>';
	echo '<td></td>';
	echo '<td></td>';
	echo "<td class=arial10whtr>".number_format($jml_DASAR_PENSIUN, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_JHT_BSX, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_JHT_BSI, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_JHT_BS, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_JHT_CS, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_PRM_JHT_BSX, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_PRM_JHT_BSI, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_PRM_JHT_BS, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_PRM_JHT_CS, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_THT_BSX, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_THT_BSI, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_THT_BS, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_THT_CS, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_PRM_THT_BSX, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_PRM_THT_BSI, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_PRM_THT_BS, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_PRM_THT_CS, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_JJD_CS, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_PRM_JJD_CS, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_PRM_CS, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_EBK, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_PRM_EBK, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_DWL, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_PRM_DWL, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_JAM_KES, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_PRM_KES, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_PENS_13_BS, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_PRM_13_BS, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_PENS_13_CS, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_PRM_13_CS, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_TAMBAHAN_JHT, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_PRM_TMBH_JHT, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_MANFAAT_UUK, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_PRM_PHK, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_PRM_SHT_CS, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_PRM_SHT_BS, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_AKUMULASI_DANA, 2, ',', '.')."</td>";
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
