<? 
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	include "../../includes/common.php";
	include "../../includes/monthselector.php";
		
  $DB=new Database($userid, $passwd, $DBName);
?>
<body>
<link href="../jws.css" rel="stylesheet" type="text/css">

<form name="date" action="<?PHP_SELF?>"> 
<font face="Verdana" size="2"><b>INFORMASI PREMI TAGIHAN KANTOR <? echo $kantor; ?></b></font>
<hr size="1">
<table border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td class="verdana9blk">Premi Jatuh Tempo Bulan : <? DateSelector("v"); ?>
			<input type="submit" value="Cari" name="cari">
			<input type="hidden" value="1" name="on">
		</td>
  </tr>
</table>	
<hr size="1">
</form>
<div align="center">
<!----------------------------------------- End Date Selector ----------------------------------------->

<?
if($vbln==""){
							   $DB=new Database($userid, $passwd, $DBName);
	               $thnsql = "select to_char(sysdate,'MMYYYY') nowbln from dual";
		             $DB->parse($thnsql);
	               $DB->execute();
		             $x=$DB->nextrow();
		             $thisperiode=$x["NOWBLN"];
		             $vthn=substr($thisperiode,-4);
							   $bln=substr($thisperiode,0,2);
								 $periode="to_char(c.tglbooked,'MMYYYY')='$thisperiode' and a.kdstatusfile='1' and (c.status is null or c.status!='4')";				 
}else if($vbln=="all"){
	               $thisperiode="$vthn";
								 $periode="to_char(c.tglbooked,'YYYY')='$thisperiode' and a.kdstatusfile='1' and (c.status is null or c.status!='4')";
}else{
		             $bln = substr(("0".$vbln),-2);
	               $thisperiode="$bln$vthn";
								 $periode="to_char(c.tglbooked,'MMYYYY')='$thisperiode' and a.kdstatusfile='1' and (c.status is null or c.status!='4')";
}

switch ($bln) {
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
$kodekantor = $kantor;
//$kodekantor=substr($kdkantor,0,2);
//$namakantor=substr($kdkantor,2,100);
	
$sqly ="select c.prefixpertanggungan,c.nopertanggungan, ".
			    "(select b.namaklien1 from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_100_klien b where a.notertanggung=b.noklien and ".
			    "a.prefixpertanggungan=c.prefixpertanggungan and a.nopertanggungan=c.nopertanggungan) namatertanggung, ".
			"c.kdvaluta,c.tglbooked,c.tglseatled,a.tgllastpayment,c.kdkuitansi,c.premitagihan ".
			"from ".
			"$DBUser.tabel_300_historis_premi c,".
			"$DBUser.tabel_200_pertanggungan a,".
			"$DBUser.tabel_500_penagih b ".
			"where a.kdpertanggungan='2'and a.nopenagih=b.nopenagih and a.kdstatusfile='1' and ".
			"b.kdrayonpenagih='$kodekantor' and ".
			"c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			"c.tglseatled is NULL and $periode ".
			"order by a.prefixpertanggungan, a.nopertanggungan ";
			
			//echo $sqly;
$yy=$DB->parse($sqly);
$DB->execute();
$ary=$DB->nextrow();
$total=OCIRowCount($yy);
if ($total==0) { 
	if ($on!=1){
	} else {
		echo "<font face=\"Verdana\" size=\"2\" color=\"#ff0000\"><b>Tidak Ada Premi Jatuh Tempo Periode $bulan $vthn</b></font><br>";
	}
} elseif ($total>0) {

	echo "<font face=\"Verdana\" size=\"2\"><b>Premi Jatuh Tempo Kantor $kodekantor Periode $bulan $vthn</b></font><br><br>";
	echo "<table width=\"400\" border=\"0\">";
//-------------------------------- 1. Valuta Rupiah Tanpa Indeks Rp kdvaluta='1' --------------------------------------
  $qry ="select sum(c.premitagihan) jmlrpbln from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_300_historis_premi c, ".
			 "$DBUser.tabel_304_valuta d,$DBUser.tabel_305_cara_bayar e,$DBUser.tabel_500_penagih f ".
			 "where a.kdpertanggungan='2' and a.nopenagih=f.nopenagih and f.kdrayonpenagih='$kodekantor' and ". 
			 "c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			 "c.tglseatled is NULL and a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and ".
			 "$periode and a.kdvaluta='1' and a.kdcarabayar in ('1','M') ".
			 "order by a.prefixpertanggungan, a.nopertanggungan ";
	$DB->parse($qry);
  $DB->execute();
	$arb=$DB->nextrow();
	$jmlrpbln=$arb["JMLRPBLN"];
  $qry ="select sum(c.premitagihan) jmlrpkwt from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_300_historis_premi c,".
			 "$DBUser.tabel_304_valuta d,$DBUser.tabel_305_cara_bayar e,$DBUser.tabel_500_penagih f ".
			 "where a.kdpertanggungan='2' and a.nopenagih=f.nopenagih and f.kdrayonpenagih='$kodekantor' and ". 
			 "c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			 "c.tglseatled is NULL and a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and ".
			 "$periode and a.kdvaluta='1' and a.kdcarabayar in ('2','Q') ".
			 "order by a.prefixpertanggungan, a.nopertanggungan ";
	$DB->parse($qry);
  $DB->execute();
	$ark=$DB->nextrow();
	$jmlrpkwt=$ark["JMLRPKWT"];
  $qry ="select sum(c.premitagihan) jmlrpsmt from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_300_historis_premi c, ".
			 "$DBUser.tabel_304_valuta d,$DBUser.tabel_305_cara_bayar e,$DBUser.tabel_500_penagih f ".
			 "where a.kdpertanggungan='2' and a.nopenagih=f.nopenagih and f.kdrayonpenagih='$kodekantor' and ". 
			 "c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			 "c.tglseatled is NULL and a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and ".
			 "$periode and a.kdvaluta='1' and a.kdcarabayar in ('3','H') ".
			 "order by a.prefixpertanggungan, a.nopertanggungan ";
  $DB->parse($qry);
  $DB->execute();
	$ars=$DB->nextrow();
	$jmlrpsmt=$ars["JMLRPSMT"];
  $qry ="select sum(c.premitagihan) jmlrpthn from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_300_historis_premi c, ".
			 "$DBUser.tabel_304_valuta d,$DBUser.tabel_305_cara_bayar e,$DBUser.tabel_500_penagih f ".
			 "where a.kdpertanggungan='2' and a.nopenagih=f.nopenagih and f.kdrayonpenagih='$kodekantor' and ". 
			 "c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			 "c.tglseatled is NULL and a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and ".
			 "$periode and a.kdvaluta='1' and a.kdcarabayar in ('4','A') ".
			 "order by a.prefixpertanggungan, a.nopertanggungan ";
  $DB->parse($qry);
  $DB->execute();
	$art=$DB->nextrow();
	$jmlrpthn=$art["JMLRPTHN"];
  $qry ="select sum(c.premitagihan) jmlrp from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_300_historis_premi c, ".
			 "$DBUser.tabel_304_valuta d,$DBUser.tabel_305_cara_bayar e,$DBUser.tabel_500_penagih f ".
			 "where a.kdpertanggungan='2' and a.nopenagih=f.nopenagih and f.kdrayonpenagih='$kodekantor' and ". 
			 "c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			 "c.tglseatled is NULL and a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and a.kdvaluta='1' and ".
			 "$periode and a.kdcarabayar in ('1','M','2','Q','3','H','4','A') ".
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
	echo "<td class=\"verdana8blk\" align=\"left\"><a href=\"premitagihankantor2.php?kdkantor=$kodekantor&carabayar=RPBULAN&cek=$jmlrpbln&vbln=$bln&vth=$vthn\">Bulanan</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\">Rp</td>";
	echo "<td class=\"verdana8blk\" align=\"right\"><a href=\"premitagihankantor2.php?kdkantor=$kodekantor&carabayar=RPBULAN&cek=$jmlrpbln&vbln=$bln&vth=$vthn\">".number_format($jmlrpbln,2)."</s></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\" bgcolor=#e0e0e4><a href=\"premitagihankantor2.php?kdkantor=$kodekantor&carabayar=RPKUARTAL&cek=$jmlrpkwt&vbln=$bln&vth=$vthn\">Kwartalan</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>Rp</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4><a href=\"premitagihankantor2.php?kdkantor=$kodekantor&carabayar=RPKUARTAL&cek=$jmlrpkwt&vbln=$bln&vth=$vthn\">".number_format($jmlrpkwt,2)."</a></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\"><a href=\"premitagihankantor2.php?kdkantor=$kodekantor&carabayar=RPSEMESTER&cek=$jmlrpsmt&vbln=$bln&vth=$vthn\">Semesteran</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\">Rp</td>";
	echo "<td class=\"verdana8blk\" align=\"right\"><a href=\"premitagihankantor2.php?kdkantor=$kodekantor&carabayar=RPSEMESTER&cek=$jmlrpsmt&vbln=$bln&vth=$vthn\">".number_format($jmlrpsmt,2)."</a></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\" bgcolor=#e0e0e4><a href=\"premitagihankantor2.php?kdkantor=$kodekantor&carabayar=RPTAHUN&cek=$jmlrpthn&vbln=$bln&vth=$vthn\">Tahunan</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>Rp</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4><a href=\"premitagihankantor2.php?kdkantor=$kodekantor&carabayar=RPTAHUN&cek=$jmlrpthn&vbln=$bln&vth=$vthn\">".number_format($jmlrpthn,2)."</a></td>";
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
			 "where a.kdpertanggungan='2' and a.nopenagih=f.nopenagih and f.kdrayonpenagih='$kodekantor' and ". 
			 "c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			 "c.tglseatled is NULL and a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and ".
			 "$periode and a.kdvaluta='0' and a.kdcarabayar in ('1','M') ".
			 "order by a.prefixpertanggungan, a.nopertanggungan ";
  $DB->parse($qry);
  $DB->execute();
	$arb=$DB->nextrow();
	$jmlrpibln=$arb["JMLRPIBLN"];
  $qry ="select sum(c.premitagihan) jmlrpikwt from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_300_historis_premi c, ".
			 "$DBUser.tabel_304_valuta d,$DBUser.tabel_305_cara_bayar e,$DBUser.tabel_500_penagih f ".
			 "where a.kdpertanggungan='2' and a.nopenagih=f.nopenagih and f.kdrayonpenagih='$kodekantor' and ". 
			 "c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			 "c.tglseatled is NULL and a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and ".
			 "$periode and a.kdvaluta='0' and a.kdcarabayar in ('2','Q') ".
			 "order by a.prefixpertanggungan, a.nopertanggungan ";
	$DB->parse($qry);
  $DB->execute();
	$ark=$DB->nextrow();
	$jmlrpikwt=$ark["JMLRPIKWT"];
  $qry ="select sum(c.premitagihan) jmlrpismt from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_300_historis_premi c, ".
			 "$DBUser.tabel_304_valuta d,$DBUser.tabel_305_cara_bayar e,$DBUser.tabel_500_penagih f ".
			 "where a.kdpertanggungan='2' and a.nopenagih=f.nopenagih and f.kdrayonpenagih='$kodekantor' and ". 
			 "c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			 "c.tglseatled is NULL and a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and ".
			 "$periode and a.kdvaluta='0' and a.kdcarabayar in ('3','H') ".
			 "order by a.prefixpertanggungan, a.nopertanggungan ";
  $DB->parse($qry);
  $DB->execute();
	$ars=$DB->nextrow();
	$jmlrpismt=$ars["JMLRPISMT"];
  $qry ="select sum(c.premitagihan) jmlrpithn from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_300_historis_premi c, ".
			 "$DBUser.tabel_304_valuta d,$DBUser.tabel_305_cara_bayar e,$DBUser.tabel_500_penagih f ".
			 "where a.kdpertanggungan='2' and a.nopenagih=f.nopenagih and f.kdrayonpenagih='$kodekantor' and ". 
			 "c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			 "c.tglseatled is NULL and a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and ".
			 "$periode and a.kdvaluta='0' and a.kdcarabayar in ('4','A') ".
			 "order by a.prefixpertanggungan, a.nopertanggungan ";
  $DB->parse($qry);
  $DB->execute();
	$art=$DB->nextrow();
	$jmlrpithn=$art["JMLRPITHN"];
  $qry ="select sum(c.premitagihan) jmlrpi from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_300_historis_premi c, ".
			 "$DBUser.tabel_304_valuta d,$DBUser.tabel_305_cara_bayar e,$DBUser.tabel_500_penagih f ".
			 "where a.kdpertanggungan='2' and a.nopenagih=f.nopenagih and f.kdrayonpenagih='$kodekantor' and ". 
			 "c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			 "c.tglseatled is NULL and a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and a.kdvaluta='0' and ".
			 "$periode and a.kdcarabayar in ('1','M','2','Q','3','H','4','A') ".
			 "order by a.prefixpertanggungan, a.nopertanggungan ";
  $DB->parse($qry);
  $DB->execute();
	$arx=$DB->nextrow();
	$jmlrpi=$arx["JMLRPI"];
	echo "<tr>";
	echo "<td class=\"a\" align=\"left\" colspan=\"3\"><b>Rupiah Dengan Indeks</b></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\"><a href=\"premitagihankantor2.php?kdkantor=$kodekantor&carabayar=RPIBULAN&cek=$jmlrpibln&vbln=$bln&vth=$vthn\">Bulanan</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\">Rp</td>";
	echo "<td class=\"verdana8blk\" align=\"right\"><a href=\"premitagihankantor2.php?kdkantor=$kodekantor&carabayar=RPIBULAN&cek=$jmlrpibln&vbln=$bln&vth=$vthn\">".number_format($jmlrpibln,2)."</a></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\" bgcolor=#e0e0e4><a href=\"premitagihankantor2.php?kdkantor=$kodekantor&carabayar=RPIKUARTAL&cek=$jmlrpikwt&vbln=$bln&vth=$vthn\">Kwartalan</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>Rp</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4><a href=\"premitagihankantor2.php?kdkantor=$kodekantor&carabayar=RPIKUARTAL&cek=$jmlrpikwt&vbln=$bln&vth=$vthn\">".number_format($jmlrpikwt,2)."</a></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\"><a href=\"premitagihankantor2.php?kdkantor=$kodekantor&carabayar=RPISEMESTER&cek=$jmlrpismt&vbln=$bln&vth=$vthn\">Semesteran</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\">Rp</td>";
	echo "<td class=\"verdana8blk\" align=\"right\"><a href=\"premitagihankantor2.php?kdkantor=$kodekantor&carabayar=RPISEMESTER&cek=$jmlrpismt&vbln=$bln&vth=$vthn\">".number_format($jmlrpismt,2)."</a></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\" bgcolor=#e0e0e4><a href=\"premitagihankantor2.php?kdkantor=$kodekantor&carabayar=RPITAHUN&cek=$jmlrpithn&vbln=$bln&vth=$vthn\">Tahunan</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>Rp</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4><a href=\"premitagihankantor2.php?kdkantor=$kodekantor&carabayar=RPITAHUN&cek=$jmlrpithn&vbln=$bln&vth=$vthn\">".number_format($jmlrpithn,2)."</a></td>";
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
			 "where a.kdpertanggungan='2' and a.nopenagih=f.nopenagih and f.kdrayonpenagih='$kodekantor' and ". 
			 "c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			 "c.tglseatled is NULL and a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and ".
			 "$periode and a.kdvaluta='3' and a.kdcarabayar in ('1','M') ".
			 "order by a.prefixpertanggungan, a.nopertanggungan ";
  $DB->parse($qry);
  $DB->execute();
	$jbln=$DB->nextrow();
	$jmldollarbln=$jbln["JMLDOLLARBLN"];
  $qry ="select sum(c.premitagihan) jmldollarkwt from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_300_historis_premi c, ".
			 "$DBUser.tabel_304_valuta d,$DBUser.tabel_305_cara_bayar e,$DBUser.tabel_500_penagih f ".
			 "where a.kdpertanggungan='2' and a.nopenagih=f.nopenagih and f.kdrayonpenagih='$kodekantor' and ". 
			 "c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			 "c.tglseatled is NULL and a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and ".
			 "$periode and a.kdvaluta='3' and a.kdcarabayar in ('2','Q') ".
			 "order by a.prefixpertanggungan, a.nopertanggungan ";
	$DB->parse($qry);
  $DB->execute();
	$kwt=$DB->nextrow();
	$jmldollarkwt=$kwt["JMLDOLLARKWT"];
  $qry ="select sum(c.premitagihan) jmldollarsmt from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_300_historis_premi c, ".
			 "$DBUser.tabel_304_valuta d,$DBUser.tabel_305_cara_bayar e,$DBUser.tabel_500_penagih f ".
			 "where a.kdpertanggungan='2' and a.nopenagih=f.nopenagih and f.kdrayonpenagih='$kodekantor' and ". 
			 "c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			 "c.tglseatled is NULL and a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and ".
			 "$periode and a.kdvaluta='3' and a.kdcarabayar in ('3','H') ".
			 "order by a.prefixpertanggungan, a.nopertanggungan ";
  $DB->parse($qry);
  $DB->execute();
	$smt=$DB->nextrow();
	$jmldollarsmt=$smt["JMLDOLLARSMT"];
  $qry ="select sum(c.premitagihan) jmldollarthn from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_300_historis_premi c, ".
			 "$DBUser.tabel_304_valuta d,$DBUser.tabel_305_cara_bayar e,$DBUser.tabel_500_penagih f ".
			 "where a.kdpertanggungan='2' and a.nopenagih=f.nopenagih and f.kdrayonpenagih='$kodekantor' and ". 
			 "c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			 "c.tglseatled is NULL and a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and ".
			 "$periode and a.kdvaluta='3' and a.kdcarabayar in ('4','A') ".
			 "order by a.prefixpertanggungan, a.nopertanggungan ";
  $DB->parse($qry);
  $DB->execute();
	$thn=$DB->nextrow();
	$jmldollarthn=$thn["JMLDOLLARTHN"];
  $qry ="select sum(c.premitagihan) jmldollar from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_300_historis_premi c, ".
			 "$DBUser.tabel_304_valuta d,$DBUser.tabel_305_cara_bayar e,$DBUser.tabel_500_penagih f ".
			 "where a.kdpertanggungan='2' and a.nopenagih=f.nopenagih and f.kdrayonpenagih='$kodekantor' and ". 
			 "c.prefixpertanggungan=a.prefixpertanggungan and c.nopertanggungan=a.nopertanggungan and ".
			 "c.tglseatled is NULL and a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and a.kdvaluta='3' and ".
			 "$periode and a.kdcarabayar in ('1','M','2','Q','3','H','4','A') ".
			 "order by a.prefixpertanggungan, a.nopertanggungan ";
  $DB->parse($qry);
  $DB->execute();
	$dol=$DB->nextrow();
	$jmldollar=$dol["JMLDOLLAR"];
	echo "<tr>";
	echo "<td class=\"a\" align=\"left\" colspan=\"3\"><b>Dollar</b></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\"><a href=\"premitagihankantor2.php?kdkantor=$kodekantor&carabayar=DOLLARBULAN&cek=$jmldollarbln&vbln=$bln&vth=$vthn\">Bulanan</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\">US$</td>";
	echo "<td class=\"verdana8blk\" align=\"right\"><a href=\"premitagihankantor2.php?kdkantor=$kodekantor&carabayar=DOLLARBULAN&cek=$jmldollarbln&vbln=$bln&vth=$vthn\">".number_format($jmldollarbln,2)."</a></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\" bgcolor=#e0e0e4><a href=\"premitagihankantor2.php?kdkantor=$kodekantor&carabayar=DOLLARKUARTAL&cek=$jmldollarkwt&vbln=$bln&vth=$vthn\">Kwartalan</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>US$</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4><a href=\"premitagihankantor2.php?kdkantor=$kodekantor&carabayar=DOLLARKUARTAL&cek=$jmldollarkwt&vbln=$bln&vth=$vthn\">".number_format($jmldollarkwt,2)."</a></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\"><a href=\"premitagihankantor2.php?kdkantor=$kodekantor&carabayar=DOLLARSEMESTER&cek=$jmldollarsmt&vbln=$bln&vth=$vthn\">Semesteran</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\">US$</td>";
	echo "<td class=\"verdana8blk\" align=\"right\"><a href=\"premitagihankantor2.php?kdkantor=$kodekantor&carabayar=DOLLARSEMESTER&cek=$jmldollarsmt&vbln=$bln&vth=$vthn\">".number_format($jmldollarsmt,2)."</a></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\" bgcolor=#e0e0e4><a href=\"premitagihankantor2.php?kdkantor=$kodekantor&carabayar=DOLLARTAHUN&cek=$jmldollarthn&vbln=$bln&vth=$vthn\">Tahunan</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>US$</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4><a href=\"premitagihankantor2.php?kdkantor=$kodekantor&carabayar=DOLLARTAHUN&cek=$jmldollarthn&vbln=$bln&vth=$vthn\">".number_format($jmldollarthn,2)."</a></td>";
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
<font face="verdana" size="2"><a href="../pelaporan/index.php">Menu Manajemen Informasi</a></font>
</body>