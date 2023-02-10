<? 
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
	include "../../includes/kantor.php";
	include "../../includes/klien.php";
	
  $DB=new database($userid, $passwd, $DBName);
	$KTR=new Kantor($userid,$passwd,$kantor);
  $bulancari = $year.$month;
	switch($month)
  {
  							  case '01': $namabulan = "JANUARI"; break;
  								case '02': $namabulan = "PEBRUARI"; break;
									case '03': $namabulan = "MARET"; break;
									case '04': $namabulan = "APRIL"; break;
									case '05': $namabulan = "MEI"; break;
									case '06': $namabulan = "JUNI"; break;
									case '07': $namabulan = "JULI"; break;
									case '08': $namabulan = "AGUSTUS"; break;
  								case '09': $namabulan = "SEPTEMBER"; break;
  								case '10': $namabulan = "OKTOBER"; break;
									case '11': $namabulan = "NOVEMBER"; break;
									case '12': $namabulan = "DESEMBER"; break;
  }
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Nota Debet</title>
<style type="text/css">
<!-- 
body { 
 font-size: 12px;
 font-family: verdana;
 } 
td { 
 font-size: 10px;
 font-family: verdana;
 } 
-->
</style>
</head>
<body onload="window.print();window.close()">

<table border="0" width="60%" cellpadding="4" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" id="AutoNumber1">
	<tr>
		<td colspan="4" align="center">
		<b><font size="2">NOTA DEBET<br />
		TAGIHAN PREMI AUTO DEBET BANK MANDIRI <br />BULAN <?=$namabulan." ".$year;?><br /><?=$KTR->namakantor;?> </b>
		<br /><br /></font>
		</td>
	</tr>	
	
	<tr>
		<td colspan="4" align="center">
		<b><font size="2">NOMOR : _____/<?=$month;?>/<?=$year;?>/<?=$kantor;?></font></b>
		</td>
	</tr>	
	
	<tr>
		<td height="20" bgcolor="#89acd8"><b>CABAS</b></td>
		<td bgcolor="#89acd8"><b>REKENING PREMI</b></td>
		<td align="right" bgcolor="#89acd8"><b>JUMLAH KWT</b></td>
		<td align="right" bgcolor="#89acd8"><b>JUMLAH PREMI</b></td>
	</tr>
	<!--- VRTI --->
	<? 
	$sql = "SELECT ".
			 	 		 "d.kdcabas,c.kdrekeningpremi, c.kdrekeninglawan,sum(c.premitagihan) as premi,".
						 "sum(decode(a.kdvaluta,'0',c.premitagihan/a.indexawal,c.premitagihan)) as premihitung,".
						 "count(a.nopertanggungan) as jmlkuit ".
    		 "FROM ".
				 		 "$DBUser.tabel_300_historis_premi c,".
             "$DBUser.tabel_200_pertanggungan a,".
             "$DBUser.tabel_500_penagih b,".
             "$DBUser.tabel_202_produk d ".
         "WHERE a.prefixpertanggungan = c.prefixpertanggungan ".
             "AND a.nopertanggungan = c.nopertanggungan ".
             "AND a.kdproduk = d.kdproduk ".
             "AND a.autodebet = '1' ".
						 "AND a.kdbank = 'MDR' ".	
             "AND a.kdvaluta = '1' ".
             "AND a.nopenagih = b.nopenagih ".
             "AND b.kdrayonpenagih = '".$kantor."' ".
             "AND TO_CHAR (c.tglbooked, 'YYYYMM') = '".$bulancari."' ".
      	 		 "AND SUBSTR(c.kdkuitansi, 0, 2)='OB' ".
         "group BY d.kdcabas, c.kdrekeningpremi, c.kdrekeninglawan";
  $DB->parse($sql);
	$DB->execute();
	?>
	<tr>
		<td height="20" colspan="4" bgcolor="#FFDCB9"><b>RUPIAH TANPA INDEX OB</b></td>
	</tr>
	<? 
	$i=1;
	while ($row=$DB->nextrow()) {
	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
	?>
		<td><?=$row["KDCABAS"];?></td>
		<td><?=$row["KDREKENINGPREMI"];?> / <?=$row["KDREKENINGLAWAN"];?></td>
		<td align="right"><?=$row["JMLKUIT"];?></td>
		<td align="right"><?=number_format(round($row["PREMIHITUNG"],2),2,",",".");?></td>
	</tr>
	<?
	$totkuit_rpob += $row["JMLKUIT"];
	$totpremi_rpob += round($row["PREMIHITUNG"],2);
	$i++;
	}
	
	if($totkuit_rpob!="")
	{
	?>
	<tr>
		<td bgcolor="#E2E2E2" colspan="2">
		<p align="center"><b>JUMLAH</b></td>
		<td align="right" bgcolor="#E2E2E2"><?=$totkuit_rpob;?></td>
		<td align="right" bgcolor="#E2E2E2"><?=number_format($totpremi_rpob,2,",",".");?></td>
	</tr>
	<?
	}
	 
  $sql = "SELECT ".
			 	 		 "d.kdcabas,c.kdrekeningpremi, c.kdrekeninglawan,sum(c.premitagihan) as premi,".
						 "sum(decode(a.kdvaluta,'0',c.premitagihan/a.indexawal,c.premitagihan)) as premihitung,".
						 "count(a.nopertanggungan) as jmlkuit ".
    		 "FROM ".
				 		 "$DBUser.tabel_300_historis_premi c,".
             "$DBUser.tabel_200_pertanggungan a,".
             "$DBUser.tabel_500_penagih b,".
             "$DBUser.tabel_202_produk d ".
         "WHERE a.prefixpertanggungan = c.prefixpertanggungan ".
             "AND a.nopertanggungan = c.nopertanggungan ".
             "AND a.kdproduk = d.kdproduk ".
             "AND a.autodebet = '1' ".
						 "AND a.kdbank = 'MDR' ".	
             "AND a.kdvaluta = '1' ".
             "AND a.nopenagih = b.nopenagih ".
             "AND b.kdrayonpenagih = '".$kantor."' ".
             "AND TO_CHAR (c.tglbooked, 'YYYYMM') = '".$bulancari."' ".
      	 		 "AND SUBSTR(c.kdkuitansi, 0, 2)='NB' ".
         "group BY d.kdcabas, c.kdrekeningpremi, c.kdrekeninglawan";
  $DB->parse($sql);
	$DB->execute();
	?>
	<tr>
		<td height="20" colspan="4" bgcolor="#FFDCB9"><b>RUPIAH TANPA INDEX NB</b></td>
	</tr>
	<? 
	$i=1;
	while ($row=$DB->nextrow()) {
	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
	?>
		<td><?=$row["KDCABAS"];?></td>
		<td><?=$row["KDREKENINGPREMI"];?> / <?=$row["KDREKENINGLAWAN"];?></td>
		<td align="right"><?=$row["JMLKUIT"];?></td>
		<td align="right"><?=number_format(round($row["PREMIHITUNG"],2),2,",",".");?></td>
	</tr>
	<?
	$totkuit_rpnb += $row["JMLKUIT"];
	$totpremi_rpnb += round($row["PREMIHITUNG"],2);
	$i++;
	}
	
	if($totkuit_rpnb!="")
	{
	?>
	<tr>
		<td bgcolor="#E2E2E2" colspan="2">
		<p align="center"><b>JUMLAH</b></td>
		<td align="right" bgcolor="#E2E2E2"><?=$totkuit_rpnb;?></td>
		<td align="right" bgcolor="#E2E2E2"><?=number_format($totpremi_rpnb,2,",",".");?></td>
	</tr>
	<? 
	}
	?>
	
	<!--- VRDI --->
	<? 
	$sql = "SELECT ".
			 	 		 "d.kdcabas,c.kdrekeningpremi, c.kdrekeninglawan,sum(c.premitagihan) as premi,".
						 "sum(decode(a.kdvaluta,'0',c.premitagihan/a.indexawal,c.premitagihan)) as premihitung,".
						 "count(a.nopertanggungan) as jmlkuit ".
    		 "FROM ".
				 		 "$DBUser.tabel_300_historis_premi c,".
             "$DBUser.tabel_200_pertanggungan a,".
             "$DBUser.tabel_500_penagih b,".
             "$DBUser.tabel_202_produk d ".
         "WHERE a.prefixpertanggungan = c.prefixpertanggungan ".
             "AND a.nopertanggungan = c.nopertanggungan ".
             "AND a.kdproduk = d.kdproduk ".
             "AND a.autodebet = '1' ".
						 "AND a.kdbank = 'MDR' ".	
             "AND a.kdvaluta = '0' ".
             "AND a.nopenagih = b.nopenagih ".
             "AND b.kdrayonpenagih = '".$kantor."' ".
             "AND TO_CHAR (c.tglbooked, 'YYYYMM') = '".$bulancari."' ".
      	 		 "AND SUBSTR(c.kdkuitansi, 0, 2)='OB' ".
         "group BY d.kdcabas, c.kdrekeningpremi, c.kdrekeninglawan";
  $DB->parse($sql);
	$DB->execute();
	?>
	<tr>
		<td height="20" colspan="4" bgcolor="#FFDCB9"><b>RUPIAH DENGAN INDEX OB</b></td>
	</tr>
	<? 
	$i=1;
	while ($row=$DB->nextrow()) {
	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
	?>
		<td><?=$row["KDCABAS"];?></td>
		<td><?=$row["KDREKENINGPREMI"];?> / <?=$row["KDREKENINGLAWAN"];?></td>
		<td align="right"><?=$row["JMLKUIT"];?></td>
		<td align="right"><?=number_format(round($row["PREMIHITUNG"],2),2,",",".");?></td>
	</tr>
	<?
	$totkuit_rpiob += $row["JMLKUIT"];
	$totpremi_rpiob += round($row["PREMIHITUNG"],2);
	$i++;
	}
	
	if($totkuit_rpiob!="")
	{
	?>
	<tr>
		<td bgcolor="#E2E2E2" colspan="2">
		<p align="center"><b>JUMLAH</b></td>
		<td align="right" bgcolor="#E2E2E2"><?=$totkuit_rpiob;?></td>
		<td align="right" bgcolor="#E2E2E2"><?=number_format($totpremi_rpiob,2,",",".");?></td>
	</tr>
	<?
	}
	 
  $sql = "SELECT ".
			 	 		 "d.kdcabas,c.kdrekeningpremi, c.kdrekeninglawan,sum(c.premitagihan) as premi,".
						 "sum(decode(a.kdvaluta,'0',c.premitagihan/a.indexawal,c.premitagihan)) as premihitung,".
						 "count(a.nopertanggungan) as jmlkuit ".
    		 "FROM ".
				 		 "$DBUser.tabel_300_historis_premi c,".
             "$DBUser.tabel_200_pertanggungan a,".
             "$DBUser.tabel_500_penagih b,".
             "$DBUser.tabel_202_produk d ".
         "WHERE a.prefixpertanggungan = c.prefixpertanggungan ".
             "AND a.nopertanggungan = c.nopertanggungan ".
             "AND a.kdproduk = d.kdproduk ".
             "AND a.autodebet = '1' ".
						 "AND a.kdbank = 'MDR' ".	
             "AND a.kdvaluta = '0' ".
             "AND a.nopenagih = b.nopenagih ".
             "AND b.kdrayonpenagih = '".$kantor."' ".
             "AND TO_CHAR (c.tglbooked, 'YYYYMM') = '".$bulancari."' ".
      	 		 "AND SUBSTR(c.kdkuitansi, 0, 2)='NB' ".
         "group BY d.kdcabas, c.kdrekeningpremi, c.kdrekeninglawan";
  $DB->parse($sql);
	$DB->execute();
	?>
	<tr>
		<td height="20" colspan="4" bgcolor="#FFDCB9"><b>RUPIAH DENGAN INDEX NB</b></td>
	</tr>
	<? 
	$i=1;
	while ($row=$DB->nextrow()) {
	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
	?>
		<td><?=$row["KDCABAS"];?></td>
		<td><?=$row["KDREKENINGPREMI"];?> / <?=$row["KDREKENINGLAWAN"];?></td>
		<td align="right"><?=$row["JMLKUIT"];?></td>
		<td align="right"><?=number_format(round($row["PREMIHITUNG"],2),2,",",".");?></td>
	</tr>
	<?
	$totkuit_rpinb += $row["JMLKUIT"];
	$totpremi_rpinb += round($row["PREMIHITUNG"],2);
	$i++;
	}
	
	if($totkuit_rpinb!=""){
	?>
	<tr>
		<td bgcolor="#E2E2E2" colspan="2">
		<p align="center"><b>JUMLAH</b></td>
		<td align="right" bgcolor="#E2E2E2"><?=$totkuit_rpinb;?></td>
		<td align="right" bgcolor="#E2E2E2"><?=number_format($totpremi_rpinb,2,",",".");?></td>
	</tr>
	<? 
	}
	?>
	
	<!--- VA --->
	<? 
	$sql = "SELECT ".
			 	 		 "d.kdcabas,c.kdrekeningpremi, c.kdrekeninglawan,sum(c.premitagihan) as premi,".
						 "sum(decode(a.kdvaluta,'0',c.premitagihan/a.indexawal,c.premitagihan)) as premihitung,".
						 "count(a.nopertanggungan) as jmlkuit ".
    		 "FROM ".
				 		 "$DBUser.tabel_300_historis_premi c,".
             "$DBUser.tabel_200_pertanggungan a,".
             "$DBUser.tabel_500_penagih b,".
             "$DBUser.tabel_202_produk d ".
         "WHERE a.prefixpertanggungan = c.prefixpertanggungan ".
             "AND a.nopertanggungan = c.nopertanggungan ".
             "AND a.kdproduk = d.kdproduk ".
             "AND a.autodebet = '1' ".
						 "AND a.kdbank = 'MDR' ".	
             "AND a.kdvaluta = '3' ".
             "AND a.nopenagih = b.nopenagih ".
             "AND b.kdrayonpenagih = '".$kantor."' ".
             "AND TO_CHAR (c.tglbooked, 'YYYYMM') = '".$bulancari."' ".
      	 		 "AND SUBSTR(c.kdkuitansi, 0, 2)='OB' ".
         "group BY d.kdcabas, c.kdrekeningpremi, c.kdrekeninglawan";
  $DB->parse($sql);
	$DB->execute();
	?>
	<tr>
		<td height="20" colspan="4" bgcolor="#FFDCB9"><b>DOLLAR AMERIKA SERIKAT OB</b></td>
	</tr>
	<? 
	$i=1;
	while ($row=$DB->nextrow()) {
	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
	?>
		<td><?=$row["KDCABAS"];?></td>
		<td><?=$row["KDREKENINGPREMI"];?> / <?=$row["KDREKENINGLAWAN"];?></td>
		<td align="right"><?=$row["JMLKUIT"];?></td>
		<td align="right"><?=number_format(round($row["PREMIHITUNG"],2),2,",",".");?></td>
	</tr>
	<?
	$totkuit_usdob += $row["JMLKUIT"];
	$totpremi_usdob += round($row["PREMIHITUNG"],2);
	$i++;
	}
	
	if($totkuit_usdob!=""){
	?>
	<tr>
		<td bgcolor="#E2E2E2" colspan="2">
		<p align="center"><b>JUMLAH</b></td>
		<td align="right" bgcolor="#E2E2E2"><?=$totkuit_usdob;?></td>
		<td align="right" bgcolor="#E2E2E2"><?=number_format($totpremi_usdob,2,",",".");?></td>
	</tr>
	<? 
  }
	
	$sql = "SELECT ".
			 	 		 "d.kdcabas,c.kdrekeningpremi, c.kdrekeninglawan,sum(c.premitagihan) as premi,".
						 "sum(decode(a.kdvaluta,'0',c.premitagihan/a.indexawal,c.premitagihan)) as premihitung,".
						 "count(a.nopertanggungan) as jmlkuit ".
    		 "FROM ".
				 		 "$DBUser.tabel_300_historis_premi c,".
             "$DBUser.tabel_200_pertanggungan a,".
             "$DBUser.tabel_500_penagih b,".
             "$DBUser.tabel_202_produk d ".
         "WHERE a.prefixpertanggungan = c.prefixpertanggungan ".
             "AND a.nopertanggungan = c.nopertanggungan ".
             "AND a.kdproduk = d.kdproduk ".
             "AND a.autodebet = '1' ".
						 "AND a.kdbank = 'MDR' ".	
             "AND a.kdvaluta = '3' ".
             "AND a.nopenagih = b.nopenagih ".
             "AND b.kdrayonpenagih = '".$kantor."' ".
             "AND TO_CHAR (c.tglbooked, 'YYYYMM') = '".$bulancari."' ".
      	 		 "AND SUBSTR(c.kdkuitansi, 0, 2)='NB' ".
         "group BY d.kdcabas, c.kdrekeningpremi, c.kdrekeninglawan";
  $DB->parse($sql);
	$DB->execute();
	?>
	<tr>
		<td height="20" colspan="4" bgcolor="#FFDCB9"><b>DOLLAR AMERIKA SERIKAT NB</b></td>
	</tr>
	<? 
	$i=1;
	while ($row=$DB->nextrow()) {
	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
	?>
		<td><?=$row["KDCABAS"];?></td>
		<td><?=$row["KDREKENINGPREMI"];?> / <?=$row["KDREKENINGLAWAN"];?></td>
		<td align="right"><?=$row["JMLKUIT"];?></td>
		<td align="right"><?=number_format(round($row["PREMIHITUNG"],2),2,",",".");?></td>
	</tr>
	<?
	$totkuit_usdnb += $row["JMLKUIT"];
	$totpremi_usdnb += round($row["PREMIHITUNG"],2);
	$i++;
	}
	
	if($totkuit_usdnb!=""){
	?>
	<tr>
		<td bgcolor="#E2E2E2" colspan="2">
		<p align="center"><b>JUMLAH</b></td>
		<td align="right" bgcolor="#E2E2E2"><?=$totkuit_usdnb;?></td>
		<td align="right" bgcolor="#E2E2E2"><?=number_format($totpremi_usdnb,2,",",".");?></td>
	</tr>
	<? } ?>
	
</table>
<br />
<?=$KTR->kotamadya;?>, <?=date("d-m-Y"); ;?><br />
SEKSI ADMINISTRASI &AMP LOGISTIK<br /><br /><br /><br />
<b><?=$KTR->kasieadlog;?></b><br />
Kasi Adm &amp Logistik

</body>
</html>
