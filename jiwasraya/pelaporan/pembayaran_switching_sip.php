<?
  include "../../includes/session.php";
  include "../../includes/common.php";
	include "../../includes/database.php";
	include "../../includes/fungsi.php";
	$DB=new database($userid, $passwd, $DBName);
	
	$sql = "select $DBUser.terbilang($jmlpremi) terbilang from dual ";
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();
	$terbilang=$arr["TERBILANG"]; 
	$terb='';
	$k=explode(" ",$terbilang);
	for ($x=0; $x<count($k); $x++) {
	  if (strlen($terb) < (LEBARKOLOM-15)) {
	   $terb .= $k[$x]." ";
	  } 
	}
	$terbilang = ucwords(strtolower($terb))."".ucwords(strtolower(substr($terbilang,strlen($terb)))); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Surat Ijin Pembayaran :: Switching Polis</title>
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

<body onLoad="window.print();window.close()">

<div align="center">
	<table border="0" style="border-collapse: collapse" width="90%" id="table1" cellpadding="2">
		<tr>
			<td colspan="5">PT.ASURANSI JIWA IFG</td>
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
			<td>: <?=date('d/m/Y');?></td>
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
			<p align="center"><b>SURAT IZIN PEMBAYARAN (SIP)</b><br>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td nowrap>Dibayarkan Kepada</td>
			<td>:</td>
			<td colspan="3"></td>
		</tr>
		<tr>
			<td nowrap valign="top">Uang Sejumlah</td>
			<td valign="top">:</td>
			<td colspan="3">Rp. <?=number_format($jmlpremi,2,",",".");?> (<?=$terbilang;?>)</td>
		</tr>
	</table>
	<br />

	<table border="0" style="border-collapse: collapse" width="90%" id="table2" cellpadding="2">
		<tr>
			<td align="center" style="border: 1px solid #000000"><b>NO</b></td>
			<td align="center" colspan="3" style="border: 1px solid #000000"><b>
			KETERANGAN</b></td>
			<td align="center" style="border: 1px solid #000000"><b>REKENING</b></td>
			<td align="center" style="border: 1px solid #000000"><b>JUMLAH</b></td>
		</tr>
		
		<tr>
			<td align="right" style="border-left: 1px solid #000000; border-right: 1px solid #000000; border-top-width: 1px; border-bottom-width: 1px">&nbsp;</td>
			<td>&nbsp;</td>
			<td align="right">&nbsp;</td>
			<td align="right">&nbsp;</td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000; border-top-width: 1px; border-bottom-width: 1px">&nbsp;</td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000; border-top-width: 1px; border-bottom-width: 1px">&nbsp;</td>
		</tr>
		
		<tr>
			<td align="right" style="border-left: 1px solid #000000; border-right: 1px solid #000000; border-top-width: 1px; border-bottom-width: 1px">1</td>
			<td>Rek. Atr. Switching Polis</td>
			<td align="right"></td>
			<td align="right"></td>
			<td align="center" style="border-left: 1px solid #000000; border-right: 1px solid #000000; border-top-width: 1px; border-bottom-width: 1px">282.000</td>
			<td align="right" style="border-left: 1px solid #000000; border-right: 1px solid #000000; border-top-width: 1px; border-bottom-width: 1px"><?=number_format($jmlpremi,2,",",".");?></td>
		</tr>
		
		
		<tr>
			<td align="right" style="border-left: 1px solid #000000; border-right: 1px solid #000000; border-top-width: 1px; border-bottom-width: 1px">&nbsp;</td>
			<td><br />Tanggal : <?=$tglcari;?> Jam <?=$jamawal.":".$menitawal;?> s/d <?=$jamakhir.":".$menitakhir;?>&nbsp;</td>
			<td align="right">&nbsp;</td>
			<td align="right">&nbsp;</td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000; border-top-width: 1px; border-bottom-width: 1px">&nbsp;</td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000; border-top-width: 1px; border-bottom-width: 1px">&nbsp;</td>
		</tr>
		
		<tr>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000; border-top-width: 1px; border-bottom: 1px solid #000000">&nbsp;</td>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom: 1px solid #000000">&nbsp;</td>
			<td align="right" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom: 1px solid #000000">&nbsp;</td>
			<td align="right" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom: 1px solid #000000">&nbsp;</td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000; border-top-width: 1px; border-bottom: 1px solid #000000">&nbsp;</td>
			<td style="border: 1px solid #000000" align="right"><?=number_format($jmlpremi,2,",",".");?></td>

		</tr>
	</table>
	<br />
	<table border="0" style="border-collapse: collapse" width="90%" id="table3" cellpadding="2">
		<tr>
			<td align="center">Fiat Otorisasi,</td>
			<td align="center">Penerima,</td>
			<td align="center">Verifikasi/Fiat Bayar</td>
		</tr>
	</table>
</div>
</body>
</html>