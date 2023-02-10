<? 
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	include "../../includes/common.php";
  $DB=new Database($userid, $passwd, $DBName);
?>
<body>
<link href="../jws.css" rel="stylesheet" type="text/css">

<!----------------------------------------- Start Date Selector ------------------------------------------------->
<?
function DateSelector($inName, $useDate=0) { 
	$monthName=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"); 
	if ($useDate==0) { 
		$useDate=Time(); 
	}
	print("<select name=".$inName."bln>\n"); 
	for ($currentMonth=1; $currentMonth<=12; $currentMonth++) { 
		print("<option value=\"");
		print(intval($currentMonth));
		print("\"");
		if (intval(date("m",$useDate))==$currentMonth) { 
			print(" selected");
		}
		print(">".$monthName[$currentMonth]."\n"); 
	}
	print("</select>"); 
	print("<select name=".$inName."th>\n"); 
	$startYear=date("Y",$useDate); 
	for ($currentYear=$startYear-3; $currentYear<=$startYear+5; $currentYear++) { 
		print("<option value=\"$currentYear\""); 
		if (date("Y", $useDate)==$currentYear) { 
			print(" selected"); 
		} 
		print(">$currentYear\n"); 
	}
	print("</select>");
}
?> 
<form name="date" action="<?PHP_SELF?>"> 
<font face="Verdana" size="2"><b>Rayon Penagihan : <? echo $kantor; ?></b></font>
<hr size="1">
<table border="0" width="100%" cellpadding="2" cellspacing="2" bgcolor="#D8E2FC">
  <tr>
    <td width="35%" class="verdana9blk">Premi Jatuh Tempo Bulan : <? DateSelector("v"); ?>
			<input type="submit" value="Cari" name="cari">
			<input type="hidden" value="1" name="on">
		</td>
  </tr>
</table>	
<hr size=1>
</form>
<div align="center">
<!----------------------------------------- End Date Selector ----------------------------------------->

<?
$tanggal="0".$vtgl;
$tglnow=substr($tanggal,-2);
$vbln="0".$vbln;
$vbln=substr($vbln,-2);
switch ($vbln) {
	case "01":  $bulan="Januari"; break;
	case "02":  $bulan="Februari"; break;
	case "03":  $bulan="Maret"; break;
	case "04":  $bulan="April"; break;
	case "05":  $bulan="Mei"; break;
	case "06":  $bulan="Juni"; break;
	case "07":  $bulan="Juli"; break;
	case "08":  $bulan="Agustus"; break;
	case "09":  $bulan="September"; break;
	case "10":  $bulan="Oktober"; break;
	case "11":  $bulan="November"; break;
	case "12":  $bulan="Desember"; break;
}
$sqly ="select c.prefixpertanggungan,c.nopertanggungan, ".
			"(select b.namaklien1 from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_100_klien b where a.notertanggung=b.noklien and ".
			"a.prefixpertanggungan=c.prefixpertanggungan and a.nopertanggungan=c.nopertanggungan) namatertanggung, ".
			"c.kdvaluta,c.tglbooked,c.tglseatled,a.tgllastpayment,c.kdkuitansi,c.premitagihan ".
			"from $DBUser.tabel_300_historis_premi c,$DBUser.tabel_200_pertanggungan a,$DBUser.tabel_500_penagih b ".
			"where a.kdpertanggungan='2' and a.nopenagih=b.nopenagih and b.kdrayonpenagih='$kantor' and ".
			"c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			"c.tglseatled is NULL and to_char(c.tglbooked,'MMYYYY')='$vbln$vth' ".
			"order by a.prefixpertanggungan, a.nopertanggungan ";
$yy=$DB->parse($sqly);
$DB->execute();
$ary=$DB->nextrow();
$total=OCIRowCount($yy);
if ($total==0) { 
	if ($on!=1){
	} else {
		echo "<font face=\"Verdana\" size=\"2\" color=\"#ff0000\"><b>Tidak Ada Premi Jatuh Tempo Bulan $bulan $vth</b></font><br>";
	}
} elseif ($total>0) {
	echo "<table size=\"100%\" border=\"0\">";
	echo "<tr><td colspan=\"4\"><font face=\"Verdana\" size=\"2\">Premi Jatuh Tempo Bulan <b>$bulan $vth</b></font><br></td></tr>";

//-------------------------------- 1. Valuta Rupiah Tanpa Indeks Rp kdvaluta='1' --------------------------------------
  $qry ="select sum(c.premitagihan) jmlrpbln from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_300_historis_premi c, ".
			 "$DBUser.tabel_304_valuta d,$DBUser.tabel_305_cara_bayar e,$DBUser.tabel_500_penagih f ".
			 "where a.kdpertanggungan='2' and a.nopenagih=f.nopenagih and f.kdrayonpenagih='$kantor' and ". 
			 "c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			 "c.tglseatled is NULL and a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and ".
			 "to_char(c.tglbooked,'MMYYYY')='$vbln$vth' and a.kdvaluta='1' and a.kdcarabayar in ('1','M') ".
			 "order by a.prefixpertanggungan, a.nopertanggungan ";
  $DB->parse($qry);
  $DB->execute();
	$arb=$DB->nextrow();
	$jmlrpbln=$arb["JMLRPBLN"];
  $qry ="select sum(c.premitagihan) jmlrpkwt from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_300_historis_premi c,".
			 "$DBUser.tabel_304_valuta d,$DBUser.tabel_305_cara_bayar e,$DBUser.tabel_500_penagih f ".
			 "where a.kdpertanggungan='2' and a.nopenagih=f.nopenagih and f.kdrayonpenagih='$kantor' and ". 
			 "c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			 "c.tglseatled is NULL and a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and ".
			 "to_char(c.tglbooked,'MMYYYY')='$vbln$vth' and a.kdvaluta='1' and a.kdcarabayar in ('2','Q') ".
			 "order by a.prefixpertanggungan, a.nopertanggungan ";
	$DB->parse($qry);
  $DB->execute();
	$ark=$DB->nextrow();
	$jmlrpkwt=$ark["JMLRPKWT"];
  $qry ="select sum(c.premitagihan) jmlrpsmt from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_300_historis_premi c, ".
			 "$DBUser.tabel_304_valuta d,$DBUser.tabel_305_cara_bayar e,$DBUser.tabel_500_penagih f ".
			 "where a.kdpertanggungan='2' and a.nopenagih=f.nopenagih and f.kdrayonpenagih='$kantor' and ". 
			 "c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			 "c.tglseatled is NULL and a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and ".
			 "to_char(c.tglbooked,'MMYYYY')='$vbln$vth' and a.kdvaluta='1' and a.kdcarabayar in ('3','H') ".
			 "order by a.prefixpertanggungan, a.nopertanggungan ";
  $DB->parse($qry);
  $DB->execute();
	$ars=$DB->nextrow();
	$jmlrpsmt=$ars["JMLRPSMT"];
  $qry ="select sum(c.premitagihan) jmlrpthn from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_300_historis_premi c, ".
			 "$DBUser.tabel_304_valuta d,$DBUser.tabel_305_cara_bayar e,$DBUser.tabel_500_penagih f ".
			 "where a.kdpertanggungan='2' and a.nopenagih=f.nopenagih and f.kdrayonpenagih='$kantor' and ". 
			 "c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			 "c.tglseatled is NULL and a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and ".
			 "to_char(c.tglbooked,'MMYYYY')='$vbln$vth' and a.kdvaluta='1' and a.kdcarabayar in ('4','A') ".
			 "order by a.prefixpertanggungan, a.nopertanggungan ";
  $DB->parse($qry);
  $DB->execute();
	$art=$DB->nextrow();
	$jmlrpthn=$art["JMLRPTHN"];
  $qry ="select sum(c.premitagihan) jmlrp from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_300_historis_premi c, ".
			 "$DBUser.tabel_304_valuta d,$DBUser.tabel_305_cara_bayar e,$DBUser.tabel_500_penagih f ".
			 "where a.kdpertanggungan='2' and a.nopenagih=f.nopenagih and f.kdrayonpenagih='$kantor' and ". 
			 "c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			 "c.tglseatled is NULL and a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and a.kdvaluta='1' and ".
			 "to_char(c.tglbooked,'MMYYYY')='$vbln$vth' and a.kdcarabayar in ('1','M','2','Q','3','H','4','A') ".
			 "order by a.prefixpertanggungan, a.nopertanggungan ";
  $DB->parse($qry);
  $DB->execute();
	$arx=$DB->nextrow();
	$jmlrp=$arx["JMLRP"];
	echo "<tr>";
	echo "<td size=\"100%\" bgcolor=\"#6699FF\" align=\"center\" class=\"verdana8bol\">Cara Bayar</td>";
	echo "<td size=\"100%\" bgcolor=\"#6699FF\" align=\"center\" class=\"verdana8bol\">Valuta</td>";
	echo "<td size=\"100%\" bgcolor=\"#6699FF\" align=\"center\" class=\"verdana8bol\">Jumlah</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"a\" align=\"left\" colspan=\"3\"><b>Rupiah Tanpa Indeks</b></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\"><a href=\"premijt2.php?carabayar=RPBULAN&cek=$jmlrpbln&vbln=$vbln&vth=$vth\">Bulanan</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\">Rp</td>";
	echo "<td class=\"verdana8blk\" align=\"right\"><a href=\"premijt2.php?carabayar=RPBULAN&cek=$jmlrpbln&vbln=$vbln&vth=$vth\">".number_format($jmlrpbln,2)."</s></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\" bgcolor=#e0e0e4><a href=\"premijt2.php?carabayar=RPKUARTAL&cek=$jmlrpkwt&vbln=$vbln&vth=$vth\">Kwartalan</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>Rp</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4><a href=\"premijt2.php?carabayar=RPKUARTAL&cek=$jmlrpkwt&vbln=$vbln&vth=$vth\">".number_format($jmlrpkwt,2)."</a></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\"><a href=\"premijt2.php?carabayar=RPSEMESTER&cek=$jmlrpsmt&vbln=$vbln&vth=$vth\">Semesteran</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\">Rp</td>";
	echo "<td class=\"verdana8blk\" align=\"right\"><a href=\"premijt2.php?carabayar=RPSEMESTER&cek=$jmlrpsmt&vbln=$vbln&vth=$vth\">".number_format($jmlrpsmt,2)."</a></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\" bgcolor=#e0e0e4><a href=\"premijt2.php?carabayar=RPTAHUN&cek=$jmlrpthn&vbln=$vbln&vth=$vth\">Tahunan</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>Rp</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4><a href=\"premijt2.php?carabayar=RPTAHUN&cek=$jmlrpthn&vbln=$vbln&vth=$vth\">".number_format($jmlrpthn,2)."</a></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC>Total</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC>Rp</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC>".number_format($jmlrp,2)."</td>";
	echo "</tr>";
	echo "<tr><td></td></tr>";

//--------------------------------- 2. Valuta Rupiah Dengan Indeks Rp kdvaluta='0' ------------------------------------
  $qry ="select sum(c.premitagihan) jmlrpibln from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_300_historis_premi c, ".
			 "$DBUser.tabel_304_valuta d,$DBUser.tabel_305_cara_bayar e,$DBUser.tabel_500_penagih f ".
			 "where a.kdpertanggungan='2' and a.nopenagih=f.nopenagih and f.kdrayonpenagih='$kantor' and ". 
			 "c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			 "c.tglseatled is NULL and a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and ".
			 "to_char(c.tglbooked,'MMYYYY')='$vbln$vth' and a.kdvaluta='0' and a.kdcarabayar in ('1','M') ".
			 "order by a.prefixpertanggungan, a.nopertanggungan ";
  $DB->parse($qry);
  $DB->execute();
	$arb=$DB->nextrow();
	$jmlrpibln=$arb["JMLRPIBLN"];
  $qry ="select sum(c.premitagihan) jmlrpikwt from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_300_historis_premi c, ".
			 "$DBUser.tabel_304_valuta d,$DBUser.tabel_305_cara_bayar e,$DBUser.tabel_500_penagih f ".
			 "where a.kdpertanggungan='2' and a.nopenagih=f.nopenagih and f.kdrayonpenagih='$kantor' and ". 
			 "c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			 "c.tglseatled is NULL and a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and ".
			 "to_char(c.tglbooked,'MMYYYY')='$vbln$vth' and a.kdvaluta='0' and a.kdcarabayar in ('2','Q') ".
			 "order by a.prefixpertanggungan, a.nopertanggungan ";
	$DB->parse($qry);
  $DB->execute();
	$ark=$DB->nextrow();
	$jmlrpikwt=$ark["JMLRPIKWT"];
  $qry ="select sum(c.premitagihan) jmlrpismt from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_300_historis_premi c, ".
			 "$DBUser.tabel_304_valuta d,$DBUser.tabel_305_cara_bayar e,$DBUser.tabel_500_penagih f ".
			 "where a.kdpertanggungan='2' and a.nopenagih=f.nopenagih and f.kdrayonpenagih='$kantor' and ". 
			 "c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			 "c.tglseatled is NULL and a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and ".
			 "to_char(c.tglbooked,'MMYYYY')='$vbln$vth' and a.kdvaluta='0' and a.kdcarabayar in ('3','H') ".
			 "order by a.prefixpertanggungan, a.nopertanggungan ";
  $DB->parse($qry);
  $DB->execute();
	$ars=$DB->nextrow();
	$jmlrpismt=$ars["JMLRPISMT"];
  $qry ="select sum(c.premitagihan) jmlrpithn from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_300_historis_premi c, ".
			 "$DBUser.tabel_304_valuta d,$DBUser.tabel_305_cara_bayar e,$DBUser.tabel_500_penagih f ".
			 "where a.kdpertanggungan='2' and a.nopenagih=f.nopenagih and f.kdrayonpenagih='$kantor' and ". 
			 "c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			 "c.tglseatled is NULL and a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and ".
			 "to_char(c.tglbooked,'MMYYYY')='$vbln$vth' and a.kdvaluta='0' and a.kdcarabayar in ('4','A') ".
			 "order by a.prefixpertanggungan, a.nopertanggungan ";
  $DB->parse($qry);
  $DB->execute();
	$art=$DB->nextrow();
	$jmlrpithn=$art["JMLRPITHN"];
  $qry ="select sum(c.premitagihan) jmlrpi from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_300_historis_premi c, ".
			 "$DBUser.tabel_304_valuta d,$DBUser.tabel_305_cara_bayar e,$DBUser.tabel_500_penagih f ".
			 "where a.kdpertanggungan='2' and a.nopenagih=f.nopenagih and f.kdrayonpenagih='$kantor' and ". 
			 "c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			 "c.tglseatled is NULL and a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and a.kdvaluta='0' and ".
			 "to_char(c.tglbooked,'MMYYYY')='$vbln$vth' and a.kdcarabayar in ('1','M','2','Q','3','H','4','A') ".
			 "order by a.prefixpertanggungan, a.nopertanggungan ";
  $DB->parse($qry);
  $DB->execute();
	$arx=$DB->nextrow();
	$jmlrpi=$arx["JMLRPI"];
	echo "<tr>";
	echo "<td class=\"a\" align=\"left\" colspan=\"3\"><b>Rupiah Dengan Indeks</b></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\"><a href=\"premijt2.php?carabayar=RPIBULAN&cek=$jmlrpibln&vbln=$vbln&vth=$vth\">Bulanan</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\">Rp</td>";
	echo "<td class=\"verdana8blk\" align=\"right\"><a href=\"premijt2.php?carabayar=RPIBULAN&cek=$jmlrpibln&vbln=$vbln&vth=$vth\">".number_format($jmlrpibln,2)."</a></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\" bgcolor=#e0e0e4><a href=\"premijt2.php?carabayar=RPIKUARTAL&cek=$jmlrpikwt&vbln=$vbln&vth=$vth\">Kwartalan</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>Rp</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4><a href=\"premijt2.php?carabayar=RPIKUARTAL&cek=$jmlrpikwt&vbln=$vbln&vth=$vth\">".number_format($jmlrpikwt,2)."</a></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\"><a href=\"premijt2.php?carabayar=RPISEMESTER&cek=$jmlrpismt&vbln=$vbln&vth=$vth\">Semesteran</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\">Rp</td>";
	echo "<td class=\"verdana8blk\" align=\"right\"><a href=\"premijt2.php?carabayar=RPISEMESTER&cek=$jmlrpismt&vbln=$vbln&vth=$vth\">".number_format($jmlrpismt,2)."</a></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\" bgcolor=#e0e0e4><a href=\"premijt2.php?carabayar=RPITAHUN&cek=$jmlrpithn&vbln=$vbln&vth=$vth\">Tahunan</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>Rp</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4><a href=\"premijt2.php?carabayar=RPITAHUN&cek=$jmlrpithn&vbln=$vbln&vth=$vth\">".number_format($jmlrpithn,2)."</a></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC>Total</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC>Rp</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC>".number_format($jmlrpi,2)."</td>";
	echo "</tr>";
	echo "<tr><td></td></tr>";

//------------------------------------- 3. Valuta Dollar US$ kdvaluta='3' -------------------------------------
  $qry ="select sum(c.premitagihan) jmldollarbln from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_300_historis_premi c, ".
			 "$DBUser.tabel_304_valuta d,$DBUser.tabel_305_cara_bayar e,$DBUser.tabel_500_penagih f ".
			 "where a.kdpertanggungan='2' and a.nopenagih=f.nopenagih and f.kdrayonpenagih='$kantor' and ". 
			 "c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			 "c.tglseatled is NULL and a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and ".
			 "to_char(c.tglbooked,'MMYYYY')='$vbln$vth' and a.kdvaluta='3' and a.kdcarabayar in ('1','M') ".
			 "order by a.prefixpertanggungan, a.nopertanggungan ";
  $DB->parse($qry);
  $DB->execute();
	$bln=$DB->nextrow();
	$jmldollarbln=$bln["JMLDOLLARBLN"];
  $qry ="select sum(c.premitagihan) jmldollarkwt from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_300_historis_premi c, ".
			 "$DBUser.tabel_304_valuta d,$DBUser.tabel_305_cara_bayar e,$DBUser.tabel_500_penagih f ".
			 "where a.kdpertanggungan='2' and a.nopenagih=f.nopenagih and f.kdrayonpenagih='$kantor' and ". 
			 "c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			 "c.tglseatled is NULL and a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and ".
			 "to_char(c.tglbooked,'MMYYYY')='$vbln$vth' and a.kdvaluta='3' and a.kdcarabayar in ('2','Q') ".
			 "order by a.prefixpertanggungan, a.nopertanggungan ";
	$DB->parse($qry);
  $DB->execute();
	$kwt=$DB->nextrow();
	$jmldollarkwt=$kwt["JMLDOLLARKWT"];
  $qry ="select sum(c.premitagihan) jmldollarsmt from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_300_historis_premi c, ".
			 "$DBUser.tabel_304_valuta d,$DBUser.tabel_305_cara_bayar e,$DBUser.tabel_500_penagih f ".
			 "where a.kdpertanggungan='2' and a.nopenagih=f.nopenagih and f.kdrayonpenagih='$kantor' and ". 
			 "c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			 "c.tglseatled is NULL and a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and ".
			 "to_char(c.tglbooked,'MMYYYY')='$vbln$vth' and a.kdvaluta='3' and a.kdcarabayar in ('3','H') ".
			 "order by a.prefixpertanggungan, a.nopertanggungan ";
  $DB->parse($qry);
  $DB->execute();
	$smt=$DB->nextrow();
	$jmldollarsmt=$smt["JMLDOLLARSMT"];
  $qry ="select sum(c.premitagihan) jmldollarthn from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_300_historis_premi c, ".
			 "$DBUser.tabel_304_valuta d,$DBUser.tabel_305_cara_bayar e,$DBUser.tabel_500_penagih f ".
			 "where a.kdpertanggungan='2' and a.nopenagih=f.nopenagih and f.kdrayonpenagih='$kantor' and ". 
			 "c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			 "c.tglseatled is NULL and a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and ".
			 "to_char(c.tglbooked,'MMYYYY')='$vbln$vth' and a.kdvaluta='3' and a.kdcarabayar in ('4','A') ".
			 "order by a.prefixpertanggungan, a.nopertanggungan ";
  $DB->parse($qry);
  $DB->execute();
	$thn=$DB->nextrow();
	$jmldollarthn=$thn["JMLDOLLARTHN"];
  $qry ="select sum(c.premitagihan) jmldollar from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_300_historis_premi c, ".
			 "$DBUser.tabel_304_valuta d,$DBUser.tabel_305_cara_bayar e,$DBUser.tabel_500_penagih f ".
			 "where a.kdpertanggungan='2' and a.nopenagih=f.nopenagih and f.kdrayonpenagih='$kantor' and ". 
			 "c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			 "c.tglseatled is NULL and a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and a.kdvaluta='3' and ".
			 "to_char(c.tglbooked,'MMYYYY')='$vbln$vth' and a.kdcarabayar in ('1','M','2','Q','3','H','4','A') ".
			 "order by a.prefixpertanggungan, a.nopertanggungan ";
  $DB->parse($qry);
  $DB->execute();
	$dol=$DB->nextrow();
	$jmldollar=$dol["JMLDOLLAR"];
	echo "<tr>";
	echo "<td class=\"a\" align=\"left\" colspan=\"3\"><b>Dollar</b></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\"><a href=\"premijt2.php?carabayar=DOLLARBULAN&cek=$jmldollarbln&vbln=$vbln&vth=$vth\">Bulanan</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\">US$</td>";
	echo "<td class=\"verdana8blk\" align=\"right\"><a href=\"premijt2.php?carabayar=DOLLARBULAN&cek=$jmldollarbln&vbln=$vbln&vth=$vth\">".number_format($jmldollarbln,2)."</a></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\" bgcolor=#e0e0e4><a href=\"premijt2.php?carabayar=DOLLARKUARTAL&cek=$jmldollarkwt&vbln=$vbln&vth=$vth\">Kwartalan</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>US$</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4><a href=\"premijt2.php?carabayar=DOLLARKUARTAL&cek=$jmldollarkwt&vbln=$vbln&vth=$vth\">".number_format($jmldollarkwt,2)."</a></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\"><a href=\"premijt2.php?carabayar=DOLLARSEMESTER&cek=$jmldollarsmt&vbln=$vbln&vth=$vth\">Semesteran</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\">US$</td>";
	echo "<td class=\"verdana8blk\" align=\"right\"><a href=\"premijt2.php?carabayar=DOLLARSEMESTER&cek=$jmldollarsmt&vbln=$vbln&vth=$vth\">".number_format($jmldollarsmt,2)."</a></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\" bgcolor=#e0e0e4><a href=\"premijt2.php?carabayar=DOLLARTAHUN&cek=$jmldollarthn&vbln=$vbln&vth=$vth\">Tahunan</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>US$</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4><a href=\"premijt2.php?carabayar=DOLLARTAHUN&cek=$jmldollarthn&vbln=$vbln&vth=$vth\">".number_format($jmldollarthn,2)."</a></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC>Total</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC>US$</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC>".number_format($jmldollar,2)."</td>";
	echo "</tr>";
	echo "<tr><td></td></tr>";
	echo "</table>";
}
?>
</div><br>
<hr size=1>
<font face="verdana" size="2"><a href="../pelaporan/index.php">Menu Manajemen Informasi</a></font>
</body>