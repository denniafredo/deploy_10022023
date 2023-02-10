<?
	include "../../includes/database.php"; 
	include "../../includes/session.php";
	include "../../includes/common.php"; 
	$DB = new Database($userid, $passwd, $DBName);

	switch ($tahun) {
		case "":  $tahunmulas = "Semua Tahun";	break;
		default:  $tahunmulas = $tahun;
	}
	$thmulas = substr($tahun,-2);

	$sql="select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdkantor='$prefixpertanggungan'";
	$DB->parse($sql);
	$DB->execute();
	if ($ass=$DB->nextrow()) {
		$namakantor=$ass["NAMAKANTOR"];
	}
	$sql="select a.noagen,b.namaklien1 from $DBUser.tabel_400_agen a,$DBUser.tabel_100_klien b ".
       "where a.noagen=b.noklien and a.noagen='$noagen'";
	$DB->parse($sql);
	$DB->execute();
	if ($ass=$DB->nextrow()) {
		$namaagen=$ass["NAMAKLIEN1"];
  }
$sql="select a.prefixpertanggungan,a.nopertanggungan,a.kdpertanggungan,a.notertanggung,".
		 "a.kdproduk,a.mulas,a.lamaasuransi_th,a.lamaasuransi_bl,a.premi1,a.premi2,a.kdvaluta,".
		 "a.kdcarabayar,a.nopenagih,a.noagen,a.juamainproduk,b.namacarabayar,c.namaklien1 ttg,".
		 "d.namaklien1 pmgpol,e.noagen,f.namaklien1 nmagen,g.namastatusfile,h.namavaluta ".
		 "from ".
		 "$DBUser.tabel_200_pertanggungan a,$DBUser.tabel_305_cara_bayar b,$DBUser.tabel_100_klien c,".
		 "$DBUser.tabel_100_klien d,$DBUser.tabel_400_agen e,$DBUser.tabel_100_klien f, ".
		 "$DBUser.tabel_299_status_file g,$DBUser.tabel_304_valuta h ".
		 "where ".
		 "a.kdcarabayar = b.kdcarabayar and a.notertanggung=c.noklien and e.noagen='$noagen' and ".
		 "a.nopemegangpolis=d.noklien and a.kdstatusfile=g.kdstatusfile and ".
		 "a.kdvaluta=h.kdvaluta and a.prefixpertanggungan='$prefixpertanggungan' and ".
		 "a.noagen=e.noagen and e.noagen=f.noklien and a.mulas like '%$thmulas'"; 
$xx = $DB->parse($sql);
$DB->execute();
$arr=$DB->nextrow();
$total = OCIRowCount($xx);                                             
if ($total== 0) { 
	echo "<br>";
	echo "<font color=\"black\" face=\"Verdana\" size=\"2\">No. Agen : ".$noagen."<br>Tahun : ".$tahun."<br>Kantor : ".$prefixpertanggungan."</font><br><br>";
	echo "<font color=\"red\" face=\"Verdana\" size=\"2\">Tidak ada Pertanggungan di database</font>";  
	echo "<br>";
	echo "<br><A HREF=\"javascript:history.go(-1)\"><font size=\"2\">Cari Agen lain</font></A>";   
} elseif ($total> 0) {
	//echo "ada $total record di database";
?>
<html>
<head>
<title>DAFTAR POLIS PERTANGGUNGAN BARU BERDASARKAN JENIS PRODUK</title>
</head>
<link href="../jws.css" rel="stylesheet" type="text/css">
<body topmargin="0">
<table width="100%">
<tr><td align="right"><font face="Verdana" size="2" color="#0033CC">F5331</font></td></tr>
</table>
<font face="Verdana" size="2"><b>DAFTAR POLIS PERTANGGUNGAN BARU BERDASARKAN JENIS PRODUK<br>
<hr size="1">
<table>
<tr><td><font face="Verdana" size="2"><b>KANTOR</b></font></td><td><font face="Verdana" size="2"><b>: <? echo "$namakantor";?></b></font></td></tr>
<tr><td><font face="Verdana" size="2"><b>AGEN  </b></font></td><td><font face="Verdana" size="2"><b>: <? echo "$namaagen";?></b></font></td></tr>
<tr><td><font face="Verdana" size="2"><b>TH. MULAS</b></font></td><td><font face="Verdana" size="2"><b>: <? echo "$tahunmulas";?></b></font></td></tr>
</table>
<table border="0" bgcolor="#DFDFBF" cellspacing="1" cellpadding="2">
  <tr>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>NO.</b></font></td>
		<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>NO. POLIS</b></font></td>
    <td bgcolor="#C2CAED" colspan="2" align="center"><p align="center"><font face="Verdana" size="1"><b>NAMA</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>JUMLAH PRODUKSI</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>MACAM ASURANSI</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>MULAI ASURANSI</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>MASA ASURANSI</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>PREMI</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>CARA BAYAR</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>VALUTA</b></font></td>
		<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>STATUS FILE</b></font></td>
  </tr>
  <tr>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>PEMEGANG PLS</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>TERTANGGUNG</b></font></td>
  </tr>
<? 
	$totpremi=0;
	$totjua=0;
	while ($arr=$DB->nextrow()) {
		$i=0;
		$i=$count+1;
?>
  <tr>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo "$i";?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]; ?></font></td>
    <td bgcolor="#FFFFFF"><font face="Verdana" size="1"><? echo $arr["PMGPOL"]; ?></font></td>
    <td bgcolor="#FFFFFF"><font face="Verdana" size="1"><? echo $arr["TTG"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["JUAMAINPRODUK"],2); ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["KDPRODUK"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["MULAS"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["LAMAASURANSI_TH"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["PREMI1"],2); ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["NAMACARABAYAR"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["NAMAVALUTA"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["NAMASTATUSFILE"]; ?></font></td>
  </tr>
<? 
	 	$totjua=$totjua+$arr["JUAMAINPRODUK"];
		$totpremi=$totpremi+$arr["PREMI1"];
		$count++;
	}
?>
  <tr>
    <td width="40%" bgcolor="#FFFFFF" colspan="4">
      <p align="center"><font face="Verdana" size="1"><b>JUMLAH</b></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><b><? echo number_format("$totjua",2); ?></b></font></td>
    <td width="30%" bgcolor="#FFFFFF" colspan="3">&nbsp;</td>
    <td width="10%" bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><b><? echo number_format("$totpremi",2); ?></b></font></td>
    <td width="10%" bgcolor="#FFFFFF" colspan="3">&nbsp;</td>
  </tr>
</table>
<hr size="1">
<table>
<tr>
<td><font face="verdana" size="2"><a href="javascript:window.history.back();">Back</a>&nbsp;&nbsp;</font></td>
<td><font face="verdana" size="2"><a href="index.php">Menu Pelaporan</a></font></td>
</tr>
</table>
<?
} 
?>
</body>
</html>
