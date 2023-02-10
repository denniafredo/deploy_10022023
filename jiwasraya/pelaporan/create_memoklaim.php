<?
  include "../../includes/session.php";
  include "../../includes/common.php";
  include "../../includes/database.php";
  include "../../includes/kantor.php";
	
	
	$DB=new Database(base64_decode("SlNBRE0="),base64_decode("SlNBRE1PS0U="),"JSDB");
	$PWK = New Kantor($userid,$passwd,$kantor);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Memorial</title>
<style type="text/css">
<!-- 
body{
 font-size: 12px;
} 

td{
 font-size: 12px;
} 
-->
</style>
</head>

<body>
<table border="0" style="border-collapse: collapse" width="90%" id="table1" cellpadding="2">
		<tr>
			<td colspan="5">PT.ASURANSI JIWA IFG<br>
			<?=$PWK->namakantor;?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>
			<p align="right">Nomor</td>
			<td>: <?=$nomorsip;?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>
			<p align="right">Tanggal</td>
			<td>: <?=$tglsip;?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td colspan="3">
			<p align="center"><b>BUKTI MEMORIAL</b><br>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>
	<br />
<table border="0" style="border-collapse: collapse" width="100%" id="table2" cellpadding="2">
  <tr>
    <td style="border: 1px solid #000000" rowspan="2"><div align="center">No.</div>      <div align="center"></div></td>
    <td style="border: 1px solid #000000" rowspan="2"><div align="center">Perkiraan Buku Besar</div>      <div align="center"></div></td>
    <td style="border: 1px solid #000000" rowspan="2"><div align="center">Kode Rekening</div>      <div align="center"></div></td>
    <td style="border: 1px solid #000000" rowspan="2"><div align="center">Keterangan</div>      <div align="center"></div></td>
    <td style="border: 1px solid #000000" colspan="2"><div align="center">Mutasi</div></td>
  </tr>
  <tr>
    <td style="border: 1px solid #000000"><div align="center">Debet</div></td>
    <td style="border: 1px solid #000000"><div align="center">Kredit</div></td>
  </tr>
  <?
	$sql="SELECT   (SELECT   nama
				FROM   $DBUser.TABEL_802_KODEAKUN@GLLINK
			   WHERE   akun = a.akun)
				namaakun,
			 akun,
			 ket,
			 debet,
			 kredit
	  FROM   $DBUser.tabel_802_trvouc@GLLINK a
	 WHERE   SUBSTR (ket, 1, 11) = '$prefix$noper'
			 AND SUBSTR (notrans, 1, 1) = 'M'
			 AND SUBSTR (AKUN, 1, 1) IN (4,2)
			 and kdkantor='$kantor'";
	//$sql="select * from $DBUser.tabel_223_transaksi_produk where prefixpertanggungan='AC' and nopertanggungan='001194284'";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$i=1;
	while ($arr=$DB->nextrow()) { ?>
	<tr>
    <td style="border: 1px solid #000000"><?=$i;?></td>
    <td style="border: 1px solid #000000"><?=$arr["NAMAAKUN"];?></td>
    <td style="border: 1px solid #000000"><?=$arr["AKUN"];?></td>
    <td style="border: 1px solid #000000"><?=$arr["KET"];?></td>
    <td align="right" style="border: 1px solid #000000"><?=number_format($arr["DEBET"],2,',','.');?></td>
    <td align="right" style="border: 1px solid #000000"><?=number_format($arr["KREDIT"],2,',','.');?></td>
  </tr>
	
<? 
	$debet= $debet+$arr["DEBET"];
    $kredit=$kredit+$arr["DEBET"];
	//echo $debet;
$i++;
	}
?>	
  
  <tr>
    <td align="center" colspan="4" style="border: 1px solid #000000">Total Debet/Kredit</td>
    <td align="right" style="border: 1px solid #000000"><b><?=number_format($debet,2,',','.');?></b></td>
    <td align="right" style="border: 1px solid #000000"><b><?=number_format($kredit,2,',','.');?></b></td>
  </tr>
</table>
</body>
</html>
