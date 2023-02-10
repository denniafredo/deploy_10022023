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
		   from pladm.new_portofolio_jht_baru
		   where key = (select key from key_kontrak where no_polis_plindo = '$no_polis')
		   and status = '2'";	  
//	echo $sql;
	$DB->parse($sqlx);
  $DB->execute();
  $result = $DB->result();
?>
<html>
<head>
<title>DAFTAR KEADAAN PESERTA PASIF</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
</head>
<body>
<form name="propmtc14" method="POST" action="<? PHP_SELF; ?>">
<table cellpadding="1" border="0" cellspacing="1" width="100%" class="tblborder">
 <tr class="arial10wht"><td><b>DAFTAR KEADAAN PESERTA PASIF <? echo $pempol;?></b></td></tr>
 <tr class="arial10wht"><td><b>POLIS NO : <? echo $no_polis."/".$no_polis_lama;?></b></td></tr>
<tr>	
 <td>
	<table border="0" cellpadding="1" cellspacing="1" width="100%" class="tblisi">
	<tr class="hijao" align=center>
	<td>No</td>
	<td>NO KLIEN</td>
    <td>NAMA</td>
    <td>NO SERTIFIKAT</td>
    <td>TANGGAL LAHIR</td>
    <td>BENEFIT PHT</td>
    <td>BENEFIT RESTITUSI</td>
    <td>BENEFIT TUNJ KES</td>
    <td></td>
	</tr>

<? 

	$jmlpremi = 0; $jmlbenefit = 0;
  reset($result);
	$i=1;
  foreach ($result as $foo => $arr) {
 		include "../../includes/belang.php";
		echo "<td class=verdana9>$i</td>";
		echo "<td class=verdana9>".$arr['NO_KLIEN']."</td>";
		echo "<td class=verdana9>".$arr['NAMA']."</td>";
		echo "<td class=verdana9>".$arr['NO_SERTIFIKAT']."</td>";		
		// date('d/m/Y',strtotime($test1));
		//echo "<td class=verdana9>".$arr['TGL_LAHIR']."</td>";
		echo "<td class=verdana9c>".date('d/m/Y',strtotime($arr['TGL_LAHIR']))."</td>";
		echo "<td class=verdana9r>".number_format($arr['BNF_PPHT'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['RESTITUSI'], 2, ',', '.')."</td>";
		echo "<td class=verdana9r>".number_format($arr['JAM_KES'], 2, ',', '.')."</td>";
		$jml_BNF_PPHT+=$arr['BNF_PPHT'];
		$jml_RESTITUSI+=$arr['RESTITUSI'];
		$jml_JAM_KES+=$arr['JAM_KES'];
		
		$i++;
		echo "</tr>";
	} //foreach
	echo "<tr class=tblhead1>";
	echo '<td align="center" colspan="5">JUMLAH</td>';
	
	echo "<td class=arial10whtr>".number_format($jml_BNF_PPHT, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_RESTITUSI, 2, ',', '.')."</td>";
	echo "<td class=arial10whtr>".number_format($jml_JAM_KES, 2, ',', '.')."</td>";	
	echo "</tr>";

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
