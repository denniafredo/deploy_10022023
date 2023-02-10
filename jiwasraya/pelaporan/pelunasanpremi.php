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
								 $periode="to_char(c.tglbooked,'MMYYYY')='$thisperiode'";				 
}else if($vbln=="all"){
	               $thisperiode="$vthn";
								 $periode="to_char(c.tglbooked,'YYYY')='$thisperiode'";
}else{
		             $bln = substr(("0".$vbln),-2);
	               $thisperiode="$bln$vthn";
								 $periode="to_char(c.tglbooked,'MMYYYY')='$thisperiode'";
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

	echo "<font face=\"Verdana\" size=\"2\"><b>Tagihan Premi Kantor $kodekantor Periode $bulan $vthn</b></font><br><br>";
	echo "<table border=\"0\">";
//-------------------------------- 1. Valuta Rupiah Tanpa Indeks Rp kdvaluta='1' --------------------------------------
#----------------------- RP BULANAN-------------
$qry = "select l.jmlkuilunas,l.jmlrpblnlunas,b.jmlkuibelumlunas,b.jmlrpblnbelumlunas ".
       "from ".
       "(select count(c.nopertanggungan) jmlkuilunas,sum(c.premitagihan) jmlrpblnlunas ".
       "from ".
          "$DBUser.tabel_300_historis_premi c,".
          "$DBUser.tabel_200_pertanggungan a,".
          "$DBUser.tabel_500_penagih f,  ".
          "$DBUser.tabel_304_valuta d,".
          "$DBUser.tabel_305_cara_bayar e ".
       "where ".
          "a.kdpertanggungan='2' and ".
          "a.nopenagih=f.nopenagih and ".
          "f.kdrayonpenagih='$kantor' and ".
          "c.prefixpertanggungan=a.prefixpertanggungan and ".
          "c.nopertanggungan=a.nopertanggungan and ".
          "c.tglseatled is NOT NULL and ".
          "a.kdvaluta=d.kdvaluta and ".
          "a.kdcarabayar=e.kdcarabayar and ".
          "$periode and ".
					"a.kdstatusfile='1' and (c.status is null or c.status!='4') and ".
          "a.kdstatusfile='1' and ".
          "(c.status is null or c.status!='4') and ".
          "a.kdvaluta='1' and ".
          "a.kdcarabayar in ('1','M')) l,".
       "(select count(c.nopertanggungan) jmlkuibelumlunas,sum(c.premitagihan) jmlrpblnbelumlunas ".
       "from ".
          "$DBUser.tabel_300_historis_premi c,".
          "$DBUser.tabel_200_pertanggungan a, ".
          "$DBUser.tabel_500_penagih f,".
          "$DBUser.tabel_304_valuta d,".
          "$DBUser.tabel_305_cara_bayar e ".
       "where ".
       "a.kdpertanggungan='2' and ".
       "a.nopenagih=f.nopenagih and ".
       "f.kdrayonpenagih='$kantor' and ".
       "c.prefixpertanggungan=a.prefixpertanggungan and ".
       "c.nopertanggungan=a.nopertanggungan and ".
       "c.tglseatled is NULL and ".
       "a.kdvaluta=d.kdvaluta and ".
       "a.kdcarabayar=e.kdcarabayar and ".
       "$periode and ".
			 "a.kdstatusfile='1' and (c.status is null or c.status!='4') and ".
       "a.kdstatusfile='1' and ".
       "(c.status is null or c.status!='4') and ".
       "a.kdvaluta='1' and ".
       "a.kdcarabayar in ('1','M')) b ";
	$DB->parse($qry);
  $DB->execute();
	$arb=$DB->nextrow();
	$kuilunasbln=$arb["JMLKUILUNAS"];
	$kuiblmlunasbln=$arb["JMLKUIBELUMLUNAS"];
	$rplunasbln=$arb["JMLRPBLNLUNAS"];
	$rpblmlunasbln=$arb["JMLRPBLNBELUMLUNAS"];
#----------------------- RP KWARTALAN-------------
$qry = "select l.jmlkuilunas,l.jmlrpblnlunas,b.jmlkuibelumlunas,b.jmlrpblnbelumlunas ".
       "from ".
       "(select count(c.nopertanggungan) jmlkuilunas,sum(c.premitagihan) jmlrpblnlunas ".
       "from ".
          "$DBUser.tabel_300_historis_premi c,".
          "$DBUser.tabel_200_pertanggungan a,".
          "$DBUser.tabel_500_penagih f,  ".
          "$DBUser.tabel_304_valuta d,".
          "$DBUser.tabel_305_cara_bayar e ".
       "where ".
          "a.kdpertanggungan='2' and ".
          "a.nopenagih=f.nopenagih and ".
          "f.kdrayonpenagih='$kantor' and ".
          "c.prefixpertanggungan=a.prefixpertanggungan and ".
          "c.nopertanggungan=a.nopertanggungan and ".
          "c.tglseatled is NOT NULL and ".
          "a.kdvaluta=d.kdvaluta and ".
          "a.kdcarabayar=e.kdcarabayar and ".
          "$periode and ".
					"a.kdstatusfile='1' and (c.status is null or c.status!='4') and ".
          "a.kdstatusfile='1' and ".
          "(c.status is null or c.status!='4') and ".
          "a.kdvaluta='1' and ".
          "a.kdcarabayar in ('2','Q')) l,".
       "(select count(c.nopertanggungan) jmlkuibelumlunas,sum(c.premitagihan) jmlrpblnbelumlunas ".
       "from ".
          "$DBUser.tabel_300_historis_premi c,".
          "$DBUser.tabel_200_pertanggungan a, ".
          "$DBUser.tabel_500_penagih f,".
          "$DBUser.tabel_304_valuta d,".
          "$DBUser.tabel_305_cara_bayar e ".
       "where ".
       "a.kdpertanggungan='2' and ".
       "a.nopenagih=f.nopenagih and ".
       "f.kdrayonpenagih='$kantor' and ".
       "c.prefixpertanggungan=a.prefixpertanggungan and ".
       "c.nopertanggungan=a.nopertanggungan and ".
       "c.tglseatled is NULL and ".
       "a.kdvaluta=d.kdvaluta and ".
       "a.kdcarabayar=e.kdcarabayar and ".
       "$periode and ".
			 "a.kdstatusfile='1' and (c.status is null or c.status!='4') and ".
       "a.kdstatusfile='1' and ".
       "(c.status is null or c.status!='4') and ".
       "a.kdvaluta='1' and ".
       "a.kdcarabayar in ('2','Q')) b ";
	$DB->parse($qry);
  $DB->execute();
	$ark=$DB->nextrow();
	$kuilunaskwt=$ark["JMLKUILUNAS"];
	$kuiblmlunaskwt=$ark["JMLKUIBELUMLUNAS"];
	$rplunaskwt=$ark["JMLRPBLNLUNAS"];
	$rpblmlunaskwt=$ark["JMLRPBLNBELUMLUNAS"];	
#----------------------- RP SEMETERAN-------------
$qry = "select l.jmlkuilunas,l.jmlrpblnlunas,b.jmlkuibelumlunas,b.jmlrpblnbelumlunas ".
       "from ".
       "(select count(c.nopertanggungan) jmlkuilunas,sum(c.premitagihan) jmlrpblnlunas ".
       "from ".
          "$DBUser.tabel_300_historis_premi c,".
          "$DBUser.tabel_200_pertanggungan a,".
          "$DBUser.tabel_500_penagih f,  ".
          "$DBUser.tabel_304_valuta d,".
          "$DBUser.tabel_305_cara_bayar e ".
       "where ".
          "a.kdpertanggungan='2' and ".
          "a.nopenagih=f.nopenagih and ".
          "f.kdrayonpenagih='$kantor' and ".
          "c.prefixpertanggungan=a.prefixpertanggungan and ".
          "c.nopertanggungan=a.nopertanggungan and ".
          "c.tglseatled is NOT NULL and ".
          "a.kdvaluta=d.kdvaluta and ".
          "a.kdcarabayar=e.kdcarabayar and ".
          "$periode and ".
					"a.kdstatusfile='1' and (c.status is null or c.status!='4') and ".
          "a.kdstatusfile='1' and ".
          "(c.status is null or c.status!='4') and ".
          "a.kdvaluta='1' and ".
          "a.kdcarabayar in ('3','H')) l,".
       "(select count(c.nopertanggungan) jmlkuibelumlunas,sum(c.premitagihan) jmlrpblnbelumlunas ".
       "from ".
          "$DBUser.tabel_300_historis_premi c,".
          "$DBUser.tabel_200_pertanggungan a, ".
          "$DBUser.tabel_500_penagih f,".
          "$DBUser.tabel_304_valuta d,".
          "$DBUser.tabel_305_cara_bayar e ".
       "where ".
       "a.kdpertanggungan='2' and ".
       "a.nopenagih=f.nopenagih and ".
       "f.kdrayonpenagih='$kantor' and ".
       "c.prefixpertanggungan=a.prefixpertanggungan and ".
       "c.nopertanggungan=a.nopertanggungan and ".
       "c.tglseatled is NULL and ".
       "a.kdvaluta=d.kdvaluta and ".
       "a.kdcarabayar=e.kdcarabayar and ".
       "$periode and ".
			 "a.kdstatusfile='1' and (c.status is null or c.status!='4') and ".
       "a.kdstatusfile='1' and ".
       "(c.status is null or c.status!='4') and ".
       "a.kdvaluta='1' and ".
       "a.kdcarabayar in ('3','H')) b ";
	$DB->parse($qry);
  $DB->execute();
	$ars=$DB->nextrow();
	$kuilunassmt=$ars["JMLKUILUNAS"];
	$kuiblmlunassmt=$ars["JMLKUIBELUMLUNAS"];
	$rplunassmt=$ars["JMLRPBLNLUNAS"];
	$rpblmlunassmt=$ars["JMLRPBLNBELUMLUNAS"];	
#----------------------- RP TAHUNAN-------------
$qry = "select l.jmlkuilunas,l.jmlrpblnlunas,b.jmlkuibelumlunas,b.jmlrpblnbelumlunas ".
       "from ".
       "(select count(c.nopertanggungan) jmlkuilunas,sum(c.premitagihan) jmlrpblnlunas ".
       "from ".
          "$DBUser.tabel_300_historis_premi c,".
          "$DBUser.tabel_200_pertanggungan a,".
          "$DBUser.tabel_500_penagih f,  ".
          "$DBUser.tabel_304_valuta d,".
          "$DBUser.tabel_305_cara_bayar e ".
       "where ".
          "a.kdpertanggungan='2' and ".
          "a.nopenagih=f.nopenagih and ".
          "f.kdrayonpenagih='$kantor' and ".
          "c.prefixpertanggungan=a.prefixpertanggungan and ".
          "c.nopertanggungan=a.nopertanggungan and ".
          "c.tglseatled is NOT NULL and ".
          "a.kdvaluta=d.kdvaluta and ".
          "a.kdcarabayar=e.kdcarabayar and ".
          "$periode and ".
					"a.kdstatusfile='1' and (c.status is null or c.status!='4') and ".
          "a.kdstatusfile='1' and ".
          "(c.status is null or c.status!='4') and ".
          "a.kdvaluta='1' and ".
          "a.kdcarabayar in ('4','A')) l,".
       "(select count(c.nopertanggungan) jmlkuibelumlunas,sum(c.premitagihan) jmlrpblnbelumlunas ".
       "from ".
          "$DBUser.tabel_300_historis_premi c,".
          "$DBUser.tabel_200_pertanggungan a, ".
          "$DBUser.tabel_500_penagih f,".
          "$DBUser.tabel_304_valuta d,".
          "$DBUser.tabel_305_cara_bayar e ".
       "where ".
       "a.kdpertanggungan='2' and ".
       "a.nopenagih=f.nopenagih and ".
       "f.kdrayonpenagih='$kantor' and ".
       "c.prefixpertanggungan=a.prefixpertanggungan and ".
       "c.nopertanggungan=a.nopertanggungan and ".
       "c.tglseatled is NULL and ".
       "a.kdvaluta=d.kdvaluta and ".
       "a.kdcarabayar=e.kdcarabayar and ".
       "$periode and ".
			 "a.kdstatusfile='1' and (c.status is null or c.status!='4') and ".
       "a.kdstatusfile='1' and ".
       "(c.status is null or c.status!='4') and ".
       "a.kdvaluta='1' and ".
       "a.kdcarabayar in ('4','A')) b ";
	$DB->parse($qry);
  $DB->execute();
	$art=$DB->nextrow();
	$kuilunasthn=$art["JMLKUILUNAS"];
	$kuiblmlunasthn=$art["JMLKUIBELUMLUNAS"];
	$rplunasthn=$art["JMLRPBLNLUNAS"];
	$rpblmlunasthn=$art["JMLRPBLNBELUMLUNAS"];
#----------------------- RP TOTAL -------------
$qry = "select l.jmlkuilunas,l.jmlrpblnlunas,b.jmlkuibelumlunas,b.jmlrpblnbelumlunas ".
       "from ".
       "(select count(c.nopertanggungan) jmlkuilunas,sum(c.premitagihan) jmlrpblnlunas ".
       "from ".
          "$DBUser.tabel_300_historis_premi c,".
          "$DBUser.tabel_200_pertanggungan a,".
          "$DBUser.tabel_500_penagih f,  ".
          "$DBUser.tabel_304_valuta d,".
          "$DBUser.tabel_305_cara_bayar e ".
       "where ".
          "a.kdpertanggungan='2' and ".
          "a.nopenagih=f.nopenagih and ".
          "f.kdrayonpenagih='$kantor' and ".
          "c.prefixpertanggungan=a.prefixpertanggungan and ".
          "c.nopertanggungan=a.nopertanggungan and ".
          "c.tglseatled is NOT NULL and ".
          "a.kdvaluta=d.kdvaluta and ".
          "a.kdcarabayar=e.kdcarabayar and ".
          "$periode and ".
					"a.kdstatusfile='1' and (c.status is null or c.status!='4') and ".
          "a.kdstatusfile='1' and ".
          "(c.status is null or c.status!='4') and ".
          "a.kdvaluta='1' and ".
          "a.kdcarabayar in ('1','M','2','Q','3','H','4','A')) l,".
       "(select count(c.nopertanggungan) jmlkuibelumlunas,sum(c.premitagihan) jmlrpblnbelumlunas ".
       "from ".
          "$DBUser.tabel_300_historis_premi c,".
          "$DBUser.tabel_200_pertanggungan a, ".
          "$DBUser.tabel_500_penagih f,".
          "$DBUser.tabel_304_valuta d,".
          "$DBUser.tabel_305_cara_bayar e ".
       "where ".
       "a.kdpertanggungan='2' and ".
       "a.nopenagih=f.nopenagih and ".
       "f.kdrayonpenagih='$kantor' and ".
       "c.prefixpertanggungan=a.prefixpertanggungan and ".
       "c.nopertanggungan=a.nopertanggungan and ".
       "c.tglseatled is NULL and ".
       "a.kdvaluta=d.kdvaluta and ".
       "a.kdcarabayar=e.kdcarabayar and ".
       "$periode and ".
			 "a.kdstatusfile='1' and (c.status is null or c.status!='4') and ".
       "a.kdstatusfile='1' and ".
       "(c.status is null or c.status!='4') and ".
       "a.kdvaluta='1' and ".
       "a.kdcarabayar in ('1','M','2','Q','3','H','4','A')) b ";
	$DB->parse($qry);
  $DB->execute();
	$arx=$DB->nextrow();
	$kuilunasall=$arx["JMLKUILUNAS"];
	$kuiblmlunasall=$arx["JMLKUIBELUMLUNAS"];
	$rplunasall=$arx["JMLRPBLNLUNAS"];
	$rpblmlunasall=$arx["JMLRPBLNBELUMLUNAS"];	

	echo "<tr>";
	echo "<td size=\"100%\" bgcolor=\"#6699FF\" align=\"center\" class=\"verdana8bol\">Cara Bayar</td>";
	echo "<td size=\"100%\" bgcolor=\"#6699FF\" align=\"center\" class=\"verdana8bol\">Valuta</td>";
	echo "<td size=\"100%\" bgcolor=\"#6699FF\" align=\"center\" class=\"verdana8bol\">Kuit. Lunas</td>";
	echo "<td size=\"100%\" bgcolor=\"#6699FF\" align=\"center\" class=\"verdana8bol\">Jml. Lunas</td>";
	echo "<td size=\"100%\" bgcolor=\"#6699FF\" align=\"center\" class=\"verdana8bol\">Kuit. Blm Lunas</td>";
	echo "<td size=\"100%\" bgcolor=\"#6699FF\" align=\"center\" class=\"verdana8bol\">Jml. Belum Lunas</td>";
	echo "<td size=\"100%\" bgcolor=\"#6699FF\" align=\"center\" class=\"verdana8bol\">Total Kuitansi</td>";
	echo "<td size=\"100%\" bgcolor=\"#6699FF\" align=\"center\" class=\"verdana8bol\">Total Tagihan</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"a\" align=\"left\" colspan=\"8\"><b>Rupiah Tanpa Indeks</b></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\"><a href=\"premitagihankantor2.php?kdkantor=$kodekantor&carabayar=RPBULAN&cek=$jmlrpbln&vbln=$bln&vth=$vthn\">Bulanan</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\">Rp</td>";
	echo "<td class=\"verdana8blk\" align=\"right\"><a href=\"detilpelunasanpremi.php?kdkantor=$kodekantor&carabayar=RPBULAN&cek=$rplunasbln&vbln=$bln&vth=$vthn&statuskui=SL\">".$kuilunasbln."</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\">".number_format($rplunasbln,2)."</td>";
	echo "<td class=\"verdana8blk\" align=\"right\"><a href=\"detilpelunasanpremi.php?kdkantor=$kodekantor&carabayar=RPBULAN&cek=$rpblmlunasbln&vbln=$bln&vth=$vthn&statuskui=BL\">".$kuiblmlunasbln."</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\">".number_format($rpblmlunasbln,2)."</td>";
	  $subtotkuibln=$kuilunasbln + $kuiblmlunasbln;
		$subtotuangbln=$rplunasbln + $rpblmlunasbln;
	echo "<td class=\"verdana8blk\" align=\"right\">".$subtotkuibln."</td>";
	echo "<td class=\"verdana8blk\" align=\"right\">".number_format($subtotuangbln,2)."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\" bgcolor=#e0e0e4><a href=\"premitagihankantor2.php?kdkantor=$kodekantor&carabayar=RPKUARTAL&cek=$jmlrpkwt&vbln=$bln&vth=$vthn\">Kwartalan</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>Rp</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4><a href=\"detilpelunasanpremi.php?kdkantor=$kodekantor&carabayar=RPKUARTAL&cek=$rplunaskwt&vbln=$bln&vth=$vthn&statuskui=SL\">".$kuilunaskwt."</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>".number_format($rplunaskwt,2)."</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4><a href=\"detilpelunasanpremi.php?kdkantor=$kodekantor&carabayar=RPKUARTAL&cek=$rpblmlunaskwt&vbln=$bln&vth=$vthn&statuskui=BL\">".$kuiblmlunaskwt."</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>".number_format($rpblmlunaskwt,2)."</td>";
	  $subtotkuikwt=$kuilunaskwt + $kuiblmlunaskwt;
		$subtotuangkwt=$rplunaskwt + $rpblmlunaskwt;
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>".$subtotkuikwt."</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>".number_format($subtotuangkwt,2)."</td>";
  echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\"><a href=\"premitagihankantor2.php?kdkantor=$kodekantor&carabayar=RPSEMESTER&cek=$jmlrpsmt&vbln=$bln&vth=$vthn\">Semesteran</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\">Rp</td>";
	echo "<td class=\"verdana8blk\" align=\"right\"><a href=\"detilpelunasanpremi.php?kdkantor=$kodekantor&carabayar=RPSEMESTER&cek=$rplunassmt&vbln=$bln&vth=$vthn&statuskui=SL\">".$kuilunassmt."</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\">".number_format($rplunassmt,2)."</td>";
	echo "<td class=\"verdana8blk\" align=\"right\"><a href=\"detilpelunasanpremi.php?kdkantor=$kodekantor&carabayar=RPSEMESTER&cek=$rpblmlunassmt&vbln=$bln&vth=$vthn&statuskui=BL\">".$kuiblmlunassmt."</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\">".number_format($rpblmlunassmt,2)."</td>";
	  $subtotkuismt=$kuilunassmt + $kuiblmlunassmt;
		$subtotuangsmt=$rplunassmt + $rpblmlunassmt;
	echo "<td class=\"verdana8blk\" align=\"right\">".$subtotkuismt."</td>";
	echo "<td class=\"verdana8blk\" align=\"right\">".number_format($subtotuangsmt,2)."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\" bgcolor=#e0e0e4><a href=\"premitagihankantor2.php?kdkantor=$kodekantor&carabayar=RPTAHUN&cek=$jmlrpthn&vbln=$bln&vth=$vthn\">Tahunan</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>Rp</td>";
  echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4><a href=\"detilpelunasanpremi.php?kdkantor=$kodekantor&carabayar=RPTAHUN&cek=$rplunasthn&vbln=$bln&vth=$vthn&statuskui=SL\">".$kuilunasthn."</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>".number_format($rplunasthn,2)."</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4><a href=\"detilpelunasanpremi.php?kdkantor=$kodekantor&carabayar=RPTAHUN&cek=$rpblmlunasthn&vbln=$bln&vth=$vthn&statuskui=BL\">".$kuiblmlunasthn."</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>".number_format($rpblmlunasthn,2)."</td>";
	  $subtotkuithn=$kuilunasthn + $kuiblmlunasthn;
		$subtotuangthn=$rplunasthn + $rpblmlunasthn;
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>".$subtotkuithn."</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>".number_format($subtotuangthn,2)."</td>";
 	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC>Total</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC>Rp</td>";
  echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC><a href=\"detilpelunasanpremi.php?kdkantor=$kodekantor&carabayar=RUPIAH&cek=$rplunasall&vbln=$bln&vth=$vthn&statuskui=SL\">".$kuilunasall."</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC>".number_format($rplunasall,2)."</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC><a href=\"detilpelunasanpremi.php?kdkantor=$kodekantor&carabayar=RUPIAH&cek=$rpblmlunasall&vbln=$bln&vth=$vthn&statuskui=BL\">".$kuiblmlunasall."</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC>".number_format($rpblmlunasall,2)."</td>";
	  $totalkuiall=$kuilunasall + $kuiblmlunasall;
		$totaluangall=$rplunasall + $rpblmlunasall;
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC>".$totalkuiall."</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC>".number_format($totaluangall,2)."</td>";
	echo "</tr>";
 	echo "</tr>";
	echo "<tr><td></td></tr>";

//--------------------------------- 2. Valuta Rupiah Dengan Indeks Rp kdvaluta='0' ------------------------------------
#----------------------- RP INDEKS BULANAN-------------
$qry = "select l.jmlkuilunas,l.jmlrpblnlunas,b.jmlkuibelumlunas,b.jmlrpblnbelumlunas ".
       "from ".
       "(select count(c.nopertanggungan) jmlkuilunas,sum(c.premitagihan) jmlrpblnlunas ".
       "from ".
          "$DBUser.tabel_300_historis_premi c,".
          "$DBUser.tabel_200_pertanggungan a,".
          "$DBUser.tabel_500_penagih f,  ".
          "$DBUser.tabel_304_valuta d,".
          "$DBUser.tabel_305_cara_bayar e ".
       "where ".
          "a.kdpertanggungan='2' and ".
          "a.nopenagih=f.nopenagih and ".
          "f.kdrayonpenagih='$kantor' and ".
          "c.prefixpertanggungan=a.prefixpertanggungan and ".
          "c.nopertanggungan=a.nopertanggungan and ".
          "c.tglseatled is NOT NULL and ".
          "a.kdvaluta=d.kdvaluta and ".
          "a.kdcarabayar=e.kdcarabayar and ".
          "$periode and ".
					"a.kdstatusfile='1' and (c.status is null or c.status!='4') and ".
          "a.kdstatusfile='1' and ".
          "(c.status is null or c.status!='4') and ".
          "a.kdvaluta='0' and ".
          "a.kdcarabayar in ('1','M')) l,".
       "(select count(c.nopertanggungan) jmlkuibelumlunas,sum(c.premitagihan) jmlrpblnbelumlunas ".
       "from ".
          "$DBUser.tabel_300_historis_premi c,".
          "$DBUser.tabel_200_pertanggungan a, ".
          "$DBUser.tabel_500_penagih f,".
          "$DBUser.tabel_304_valuta d,".
          "$DBUser.tabel_305_cara_bayar e ".
       "where ".
       "a.kdpertanggungan='2' and ".
       "a.nopenagih=f.nopenagih and ".
       "f.kdrayonpenagih='$kantor' and ".
       "c.prefixpertanggungan=a.prefixpertanggungan and ".
       "c.nopertanggungan=a.nopertanggungan and ".
       "c.tglseatled is NULL and ".
       "a.kdvaluta=d.kdvaluta and ".
       "a.kdcarabayar=e.kdcarabayar and ".
       "$periode and ".
			 "a.kdstatusfile='1' and (c.status is null or c.status!='4') and ".
       "a.kdstatusfile='1' and ".
       "(c.status is null or c.status!='4') and ".
       "a.kdvaluta='0' and ".
       "a.kdcarabayar in ('1','M')) b ";
	$DB->parse($qry);
  $DB->execute();
	$arb=$DB->nextrow();
	$kuilunasbln=$arb["JMLKUILUNAS"];
	$kuiblmlunasbln=$arb["JMLKUIBELUMLUNAS"];
	$rpilunasbln=$arb["JMLRPBLNLUNAS"];
	$rpiblmlunasbln=$arb["JMLRPBLNBELUMLUNAS"];

#----------------------- RP INDEKS KWARTALAN-------------
$qry = "select l.jmlkuilunas,l.jmlrpblnlunas,b.jmlkuibelumlunas,b.jmlrpblnbelumlunas ".
       "from ".
       "(select count(c.nopertanggungan) jmlkuilunas,sum(c.premitagihan) jmlrpblnlunas ".
       "from ".
          "$DBUser.tabel_300_historis_premi c,".
          "$DBUser.tabel_200_pertanggungan a,".
          "$DBUser.tabel_500_penagih f,  ".
          "$DBUser.tabel_304_valuta d,".
          "$DBUser.tabel_305_cara_bayar e ".
       "where ".
          "a.kdpertanggungan='2' and ".
          "a.nopenagih=f.nopenagih and ".
          "f.kdrayonpenagih='$kantor' and ".
          "c.prefixpertanggungan=a.prefixpertanggungan and ".
          "c.nopertanggungan=a.nopertanggungan and ".
          "c.tglseatled is NOT NULL and ".
          "a.kdvaluta=d.kdvaluta and ".
          "a.kdcarabayar=e.kdcarabayar and ".
          "$periode and ".
					"a.kdstatusfile='1' and (c.status is null or c.status!='4') and ".
          "a.kdstatusfile='1' and ".
          "(c.status is null or c.status!='4') and ".
          "a.kdvaluta='0' and ".
          "a.kdcarabayar in ('2','Q')) l,".
       "(select count(c.nopertanggungan) jmlkuibelumlunas,sum(c.premitagihan) jmlrpblnbelumlunas ".
       "from ".
          "$DBUser.tabel_300_historis_premi c,".
          "$DBUser.tabel_200_pertanggungan a, ".
          "$DBUser.tabel_500_penagih f,".
          "$DBUser.tabel_304_valuta d,".
          "$DBUser.tabel_305_cara_bayar e ".
       "where ".
       "a.kdpertanggungan='2' and ".
       "a.nopenagih=f.nopenagih and ".
       "f.kdrayonpenagih='$kantor' and ".
       "c.prefixpertanggungan=a.prefixpertanggungan and ".
       "c.nopertanggungan=a.nopertanggungan and ".
       "c.tglseatled is NULL and ".
       "a.kdvaluta=d.kdvaluta and ".
       "a.kdcarabayar=e.kdcarabayar and ".
       "$periode and ".
			 "a.kdstatusfile='1' and (c.status is null or c.status!='4') and ".
       "a.kdstatusfile='1' and ".
       "(c.status is null or c.status!='4') and ".
       "a.kdvaluta='0' and ".
       "a.kdcarabayar in ('2','Q')) b ";
	$DB->parse($qry);
  $DB->execute();
	$ark=$DB->nextrow();
	$kuilunaskwt=$ark["JMLKUILUNAS"];
	$kuiblmlunaskwt=$ark["JMLKUIBELUMLUNAS"];
	$rpilunaskwt=$ark["JMLRPBLNLUNAS"];
	$rpiblmlunaskwt=$ark["JMLRPBLNBELUMLUNAS"];	
#----------------------- RP INDEKS SEMETERAN-------------
$qry = "select l.jmlkuilunas,l.jmlrpblnlunas,b.jmlkuibelumlunas,b.jmlrpblnbelumlunas ".
       "from ".
       "(select count(c.nopertanggungan) jmlkuilunas,sum(c.premitagihan) jmlrpblnlunas ".
       "from ".
          "$DBUser.tabel_300_historis_premi c,".
          "$DBUser.tabel_200_pertanggungan a,".
          "$DBUser.tabel_500_penagih f,  ".
          "$DBUser.tabel_304_valuta d,".
          "$DBUser.tabel_305_cara_bayar e ".
       "where ".
          "a.kdpertanggungan='2' and ".
          "a.nopenagih=f.nopenagih and ".
          "f.kdrayonpenagih='$kantor' and ".
          "c.prefixpertanggungan=a.prefixpertanggungan and ".
          "c.nopertanggungan=a.nopertanggungan and ".
          "c.tglseatled is NOT NULL and ".
          "a.kdvaluta=d.kdvaluta and ".
          "a.kdcarabayar=e.kdcarabayar and ".
          "$periode and ".
					"a.kdstatusfile='1' and (c.status is null or c.status!='4') and ".
          "a.kdstatusfile='1' and ".
          "(c.status is null or c.status!='4') and ".
          "a.kdvaluta='0' and ".
          "a.kdcarabayar in ('3','H')) l,".
       "(select count(c.nopertanggungan) jmlkuibelumlunas,sum(c.premitagihan) jmlrpblnbelumlunas ".
       "from ".
          "$DBUser.tabel_300_historis_premi c,".
          "$DBUser.tabel_200_pertanggungan a, ".
          "$DBUser.tabel_500_penagih f,".
          "$DBUser.tabel_304_valuta d,".
          "$DBUser.tabel_305_cara_bayar e ".
       "where ".
       "a.kdpertanggungan='2' and ".
       "a.nopenagih=f.nopenagih and ".
       "f.kdrayonpenagih='$kantor' and ".
       "c.prefixpertanggungan=a.prefixpertanggungan and ".
       "c.nopertanggungan=a.nopertanggungan and ".
       "c.tglseatled is NULL and ".
       "a.kdvaluta=d.kdvaluta and ".
       "a.kdcarabayar=e.kdcarabayar and ".
       "$periode and ".
			 "a.kdstatusfile='1' and (c.status is null or c.status!='4') and ".
       "a.kdstatusfile='1' and ".
       "(c.status is null or c.status!='4') and ".
       "a.kdvaluta='0' and ".
       "a.kdcarabayar in ('3','H')) b ";
	$DB->parse($qry);
  $DB->execute();
	$ars=$DB->nextrow();
	$kuilunassmt=$ars["JMLKUILUNAS"];
	$kuiblmlunassmt=$ars["JMLKUIBELUMLUNAS"];
	$rpilunassmt=$ars["JMLRPBLNLUNAS"];
	$rpiblmlunassmt=$ars["JMLRPBLNBELUMLUNAS"];	
#----------------------- RP INDEKS TAHUNAN-------------
$qry = "select l.jmlkuilunas,l.jmlrpblnlunas,b.jmlkuibelumlunas,b.jmlrpblnbelumlunas ".
       "from ".
       "(select count(c.nopertanggungan) jmlkuilunas,sum(c.premitagihan) jmlrpblnlunas ".
       "from ".
          "$DBUser.tabel_300_historis_premi c,".
          "$DBUser.tabel_200_pertanggungan a,".
          "$DBUser.tabel_500_penagih f,  ".
          "$DBUser.tabel_304_valuta d,".
          "$DBUser.tabel_305_cara_bayar e ".
       "where ".
          "a.kdpertanggungan='2' and ".
          "a.nopenagih=f.nopenagih and ".
          "f.kdrayonpenagih='$kantor' and ".
          "c.prefixpertanggungan=a.prefixpertanggungan and ".
          "c.nopertanggungan=a.nopertanggungan and ".
          "c.tglseatled is NOT NULL and ".
          "a.kdvaluta=d.kdvaluta and ".
          "a.kdcarabayar=e.kdcarabayar and ".
          "$periode and ".
					"a.kdstatusfile='1' and (c.status is null or c.status!='4') and ".
          "a.kdstatusfile='1' and ".
          "(c.status is null or c.status!='4') and ".
          "a.kdvaluta='0' and ".
          "a.kdcarabayar in ('4','A')) l,".
       "(select count(c.nopertanggungan) jmlkuibelumlunas,sum(c.premitagihan) jmlrpblnbelumlunas ".
       "from ".
          "$DBUser.tabel_300_historis_premi c,".
          "$DBUser.tabel_200_pertanggungan a, ".
          "$DBUser.tabel_500_penagih f,".
          "$DBUser.tabel_304_valuta d,".
          "$DBUser.tabel_305_cara_bayar e ".
       "where ".
       "a.kdpertanggungan='2' and ".
       "a.nopenagih=f.nopenagih and ".
       "f.kdrayonpenagih='$kantor' and ".
       "c.prefixpertanggungan=a.prefixpertanggungan and ".
       "c.nopertanggungan=a.nopertanggungan and ".
       "c.tglseatled is NULL and ".
       "a.kdvaluta=d.kdvaluta and ".
       "a.kdcarabayar=e.kdcarabayar and ".
       "$periode and ".
			 "a.kdstatusfile='1' and (c.status is null or c.status!='4') and ".
       "a.kdstatusfile='1' and ".
       "(c.status is null or c.status!='4') and ".
       "a.kdvaluta='0' and ".
       "a.kdcarabayar in ('4','A')) b ";
	$DB->parse($qry);
  $DB->execute();
	$art=$DB->nextrow();
	$kuilunasthn=$art["JMLKUILUNAS"];
	$kuiblmlunasthn=$art["JMLKUIBELUMLUNAS"];
	$rpilunasthn=$art["JMLRPBLNLUNAS"];
	$rpiblmlunasthn=$art["JMLRPBLNBELUMLUNAS"];
#----------------------- RP INDEKS TOTAL -------------
$qry = "select l.jmlkuilunas,l.jmlrpblnlunas,b.jmlkuibelumlunas,b.jmlrpblnbelumlunas ".
       "from ".
       "(select count(c.nopertanggungan) jmlkuilunas,sum(c.premitagihan) jmlrpblnlunas ".
       "from ".
          "$DBUser.tabel_300_historis_premi c,".
          "$DBUser.tabel_200_pertanggungan a,".
          "$DBUser.tabel_500_penagih f,  ".
          "$DBUser.tabel_304_valuta d,".
          "$DBUser.tabel_305_cara_bayar e ".
       "where ".
          "a.kdpertanggungan='2' and ".
          "a.nopenagih=f.nopenagih and ".
          "f.kdrayonpenagih='$kantor' and ".
          "c.prefixpertanggungan=a.prefixpertanggungan and ".
          "c.nopertanggungan=a.nopertanggungan and ".
          "c.tglseatled is NOT NULL and ".
          "a.kdvaluta=d.kdvaluta and ".
          "a.kdcarabayar=e.kdcarabayar and ".
          "$periode and ".
					"a.kdstatusfile='1' and (c.status is null or c.status!='4') and ".
          "a.kdstatusfile='1' and ".
          "(c.status is null or c.status!='4') and ".
          "a.kdvaluta='0' and ".
          "a.kdcarabayar in ('1','M','2','Q','3','H','4','A')) l,".
       "(select count(c.nopertanggungan) jmlkuibelumlunas,sum(c.premitagihan) jmlrpblnbelumlunas ".
       "from ".
          "$DBUser.tabel_300_historis_premi c,".
          "$DBUser.tabel_200_pertanggungan a, ".
          "$DBUser.tabel_500_penagih f,".
          "$DBUser.tabel_304_valuta d,".
          "$DBUser.tabel_305_cara_bayar e ".
       "where ".
       "a.kdpertanggungan='2' and ".
       "a.nopenagih=f.nopenagih and ".
       "f.kdrayonpenagih='$kantor' and ".
       "c.prefixpertanggungan=a.prefixpertanggungan and ".
       "c.nopertanggungan=a.nopertanggungan and ".
       "c.tglseatled is NULL and ".
       "a.kdvaluta=d.kdvaluta and ".
       "a.kdcarabayar=e.kdcarabayar and ".
       "$periode and ".
			 "a.kdstatusfile='1' and (c.status is null or c.status!='4') and ".
       "a.kdstatusfile='1' and ".
       "(c.status is null or c.status!='4') and ".
       "a.kdvaluta='0' and ".
       "a.kdcarabayar in ('1','M','2','Q','3','H','4','A')) b ";
	$DB->parse($qry);
  $DB->execute();
	$arx=$DB->nextrow();
	$kuilunasall=$arx["JMLKUILUNAS"];
	$kuiblmlunasall=$arx["JMLKUIBELUMLUNAS"];
	$rpilunasall=$arx["JMLRPBLNLUNAS"];
	$rpiblmlunasall=$arx["JMLRPBLNBELUMLUNAS"];	
	
	echo "<tr>";
	echo "<td class=\"a\" align=\"left\" colspan=\"8\"><b>Rupiah Dengan Indeks</b></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\">Bulanan</td>";
	echo "<td class=\"verdana8blk\" align=\"right\">Rp</td>";
	echo "<td class=\"verdana8blk\" align=\"right\"><a href=\"detilpelunasanpremi.php?kdkantor=$kodekantor&carabayar=RPIBULAN&cek=$rpilunasbln&vbln=$bln&vth=$vthn&statuskui=SL\">".$kuilunasbln."</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\">".number_format($rpilunasbln,2)."</td>";
	echo "<td class=\"verdana8blk\" align=\"right\"><a href=\"detilpelunasanpremi.php?kdkantor=$kodekantor&carabayar=RPIBULAN&cek=$rpiblmlunasbln&vbln=$bln&vth=$vthn&statuskui=BL\">".$kuiblmlunasbln."</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\">".number_format($rpiblmlunasbln,2)."</td>";
	  $subtotkuirpibln=$kuilunasbln + $kuiblmlunasbln;
		$subtotuangrpibln=$rpilunasbln + $rpiblmlunasbln;
	echo "<td class=\"verdana8blk\" align=\"right\">".$subtotkuirpibln."</td>";
	echo "<td class=\"verdana8blk\" align=\"right\">".number_format($subtotuangrpibln,2)."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\" bgcolor=#e0e0e4>Kwartalan</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>Rp</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4><a href=\"detilpelunasanpremi.php?kdkantor=$kodekantor&carabayar=RPIKUARTAL&cek=$rpilunaskwt&vbln=$bln&vth=$vthn&statuskui=SL\">".$kuilunaskwt."</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>".number_format($rpilunaskwt,2)."</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4><a href=\"detilpelunasanpremi.php?kdkantor=$kodekantor&carabayar=RPIKUARTAL&cek=$rpiblmlunaskwt&vbln=$bln&vth=$vthn&statuskui=BL\">".$kuiblmlunaskwt."</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>".number_format($rpiblmlunaskwt,2)."</td>";
	  $subtotkuirpikwt=$kuilunaskwt + $kuiblmlunaskwt;
		$subtotuangrpikwt=$rpilunaskwt + $rpiblmlunaskwt;
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>".$subtotkuirpikwt."</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>".number_format($subtotuangrpikwt,2)."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\">Semesteran</td>";
	echo "<td class=\"verdana8blk\" align=\"right\">Rp</td>";
	echo "<td class=\"verdana8blk\" align=\"right\"><a href=\"detilpelunasanpremi.php?kdkantor=$kodekantor&carabayar=RPISEMESTER&cek=$rpilunassmt&vbln=$bln&vth=$vthn&statuskui=SL\">".$kuilunassmt."</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\">".number_format($rpilunassmt,2)."</td>";
	echo "<td class=\"verdana8blk\" align=\"right\"><a href=\"detilpelunasanpremi.php?kdkantor=$kodekantor&carabayar=RPISEMESTER&cek=$rpiblmlunassmt&vbln=$bln&vth=$vthn&statuskui=BL\">".$kuiblmlunassmt."</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\">".number_format($rpiblmlunassmt,2)."</td>";
		$subtotkuirpismt=$kuilunassmt + $kuiblmlunassmt;
		$subtotuangrpismt=$rpilunassmt + $rpiblmlunassmt;
	echo "<td class=\"verdana8blk\" align=\"right\">".$subtotkuirpismt."</td>";
	echo "<td class=\"verdana8blk\" align=\"right\">".number_format($subtotuangrpismt,2)."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\" bgcolor=#e0e0e4>Tahunan</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>Rp</td>";
  echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4><a href=\"detilpelunasanpremi.php?kdkantor=$kodekantor&carabayar=RPITAHUN&cek=$rpilunasthn&vbln=$bln&vth=$vthn&statuskui=SL\">".$kuilunasthn."</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>".number_format($rpilunasthn,2)."</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4><a href=\"detilpelunasanpremi.php?kdkantor=$kodekantor&carabayar=RPITAHUN&cek=$rpiblmlunasthn&vbln=$bln&vth=$vthn&statuskui=BL\">".$kuiblmlunasthn."</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>".number_format($rpiblmlunasthn,2)."</td>";
	  $subtotkuirpithn=$kuilunasthn + $kuiblmlunasthn;
		$subtotuangrpithn=$rpilunasthn + $rpiblmlunasthn;
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>".$subtotkuirpithn."</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>".number_format($subtotuangrpithn,2)."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC>Total</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC>Rp</td>";
  echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC><a href=\"detilpelunasanpremi.php?kdkantor=$kodekantor&carabayar=RPI&cek=$rpilunasall&vbln=$bln&vth=$vthn&statuskui=SL\">".$kuilunasall."</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC>".number_format($rpilunasall,2)."</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC><a href=\"detilpelunasanpremi.php?kdkantor=$kodekantor&carabayar=RPI&cek=$rpiblmlunasall&vbln=$bln&vth=$vthn&statuskui=BL\">".$kuiblmlunasall."</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC>".number_format($rpiblmlunasall,2)."</td>";
	  $totalrpikuiall=$kuilunasall + $kuiblmlunasall;
		$totalrpiuangall=$rpilunasall + $rpiblmlunasall;
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC>".$totalrpikuiall."</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC>".number_format($totalrpiuangall,2)."</td>";
	echo "</tr>";
	echo "<tr><td></td></tr>";

//------------------------------------- 3. Valuta Dollar US$ kdvaluta='3' -------------------------------------
#----------------------- DOLLAR US BULANAN-------------
$qry = "select l.jmlkuilunas,l.jmlrpblnlunas,b.jmlkuibelumlunas,b.jmlrpblnbelumlunas ".
       "from ".
       "(select count(c.nopertanggungan) jmlkuilunas,sum(c.premitagihan) jmlrpblnlunas ".
       "from ".
          "$DBUser.tabel_300_historis_premi c,".
          "$DBUser.tabel_200_pertanggungan a,".
          "$DBUser.tabel_500_penagih f,  ".
          "$DBUser.tabel_304_valuta d,".
          "$DBUser.tabel_305_cara_bayar e ".
       "where ".
          "a.kdpertanggungan='2' and ".
          "a.nopenagih=f.nopenagih and ".
          "f.kdrayonpenagih='$kantor' and ".
          "c.prefixpertanggungan=a.prefixpertanggungan and ".
          "c.nopertanggungan=a.nopertanggungan and ".
          "c.tglseatled is NOT NULL and ".
          "a.kdvaluta=d.kdvaluta and ".
          "a.kdcarabayar=e.kdcarabayar and ".
          "$periode and ".
					"a.kdstatusfile='1' and (c.status is null or c.status!='4') and ".
          "a.kdstatusfile='1' and ".
          "(c.status is null or c.status!='4') and ".
          "a.kdvaluta='3' and ".
          "a.kdcarabayar in ('1','M')) l,".
       "(select count(c.nopertanggungan) jmlkuibelumlunas,sum(c.premitagihan) jmlrpblnbelumlunas ".
       "from ".
          "$DBUser.tabel_300_historis_premi c,".
          "$DBUser.tabel_200_pertanggungan a, ".
          "$DBUser.tabel_500_penagih f,".
          "$DBUser.tabel_304_valuta d,".
          "$DBUser.tabel_305_cara_bayar e ".
       "where ".
       "a.kdpertanggungan='2' and ".
       "a.nopenagih=f.nopenagih and ".
       "f.kdrayonpenagih='$kantor' and ".
       "c.prefixpertanggungan=a.prefixpertanggungan and ".
       "c.nopertanggungan=a.nopertanggungan and ".
       "c.tglseatled is NULL and ".
       "a.kdvaluta=d.kdvaluta and ".
       "a.kdcarabayar=e.kdcarabayar and ".
       "$periode and ".
			 "a.kdstatusfile='1' and (c.status is null or c.status!='4') and ".
       "a.kdstatusfile='1' and ".
       "(c.status is null or c.status!='4') and ".
       "a.kdvaluta='3' and ".
       "a.kdcarabayar in ('1','M')) b ";
	$DB->parse($qry);
  $DB->execute();
	$arb=$DB->nextrow();
	$kuilunasbln=$arb["JMLKUILUNAS"];
	$kuiblmlunasbln=$arb["JMLKUIBELUMLUNAS"];
	$usdlunasbln=$arb["JMLRPBLNLUNAS"];
	$usdblmlunasbln=$arb["JMLRPBLNBELUMLUNAS"];

#----------------------- DOLLAR US KWARTALAN-------------
$qry = "select l.jmlkuilunas,l.jmlrpblnlunas,b.jmlkuibelumlunas,b.jmlrpblnbelumlunas ".
       "from ".
       "(select count(c.nopertanggungan) jmlkuilunas,sum(c.premitagihan) jmlrpblnlunas ".
       "from ".
          "$DBUser.tabel_300_historis_premi c,".
          "$DBUser.tabel_200_pertanggungan a,".
          "$DBUser.tabel_500_penagih f,  ".
          "$DBUser.tabel_304_valuta d,".
          "$DBUser.tabel_305_cara_bayar e ".
       "where ".
          "a.kdpertanggungan='2' and ".
          "a.nopenagih=f.nopenagih and ".
          "f.kdrayonpenagih='$kantor' and ".
          "c.prefixpertanggungan=a.prefixpertanggungan and ".
          "c.nopertanggungan=a.nopertanggungan and ".
          "c.tglseatled is NOT NULL and ".
          "a.kdvaluta=d.kdvaluta and ".
          "a.kdcarabayar=e.kdcarabayar and ".
          "$periode and ".
					"a.kdstatusfile='1' and (c.status is null or c.status!='4') and ".
          "a.kdstatusfile='1' and ".
          "(c.status is null or c.status!='4') and ".
          "a.kdvaluta='3' and ".
          "a.kdcarabayar in ('2','Q')) l,".
       "(select count(c.nopertanggungan) jmlkuibelumlunas,sum(c.premitagihan) jmlrpblnbelumlunas ".
       "from ".
          "$DBUser.tabel_300_historis_premi c,".
          "$DBUser.tabel_200_pertanggungan a, ".
          "$DBUser.tabel_500_penagih f,".
          "$DBUser.tabel_304_valuta d,".
          "$DBUser.tabel_305_cara_bayar e ".
       "where ".
       "a.kdpertanggungan='2' and ".
       "a.nopenagih=f.nopenagih and ".
       "f.kdrayonpenagih='$kantor' and ".
       "c.prefixpertanggungan=a.prefixpertanggungan and ".
       "c.nopertanggungan=a.nopertanggungan and ".
       "c.tglseatled is NULL and ".
       "a.kdvaluta=d.kdvaluta and ".
       "a.kdcarabayar=e.kdcarabayar and ".
       "$periode and ".
			 "a.kdstatusfile='1' and (c.status is null or c.status!='4') and ".
       "a.kdstatusfile='1' and ".
       "(c.status is null or c.status!='4') and ".
       "a.kdvaluta='3' and ".
       "a.kdcarabayar in ('2','Q')) b ";
	$DB->parse($qry);
  $DB->execute();
	$ark=$DB->nextrow();
	$kuilunaskwt=$ark["JMLKUILUNAS"];
	$kuiblmlunaskwt=$ark["JMLKUIBELUMLUNAS"];
	$usdlunaskwt=$ark["JMLRPBLNLUNAS"];
	$usdblmlunaskwt=$ark["JMLRPBLNBELUMLUNAS"];	
#----------------------- DOLLAR US SEMETERAN-------------
$qry = "select l.jmlkuilunas,l.jmlrpblnlunas,b.jmlkuibelumlunas,b.jmlrpblnbelumlunas ".
       "from ".
       "(select count(c.nopertanggungan) jmlkuilunas,sum(c.premitagihan) jmlrpblnlunas ".
       "from ".
          "$DBUser.tabel_300_historis_premi c,".
          "$DBUser.tabel_200_pertanggungan a,".
          "$DBUser.tabel_500_penagih f,  ".
          "$DBUser.tabel_304_valuta d,".
          "$DBUser.tabel_305_cara_bayar e ".
       "where ".
          "a.kdpertanggungan='2' and ".
          "a.nopenagih=f.nopenagih and ".
          "f.kdrayonpenagih='$kantor' and ".
          "c.prefixpertanggungan=a.prefixpertanggungan and ".
          "c.nopertanggungan=a.nopertanggungan and ".
          "c.tglseatled is NOT NULL and ".
          "a.kdvaluta=d.kdvaluta and ".
          "a.kdcarabayar=e.kdcarabayar and ".
          "$periode and ".
					"a.kdstatusfile='1' and (c.status is null or c.status!='4') and ".
          "a.kdstatusfile='1' and ".
          "(c.status is null or c.status!='4') and ".
          "a.kdvaluta='3' and ".
          "a.kdcarabayar in ('3','H')) l,".
       "(select count(c.nopertanggungan) jmlkuibelumlunas,sum(c.premitagihan) jmlrpblnbelumlunas ".
       "from ".
          "$DBUser.tabel_300_historis_premi c,".
          "$DBUser.tabel_200_pertanggungan a, ".
          "$DBUser.tabel_500_penagih f,".
          "$DBUser.tabel_304_valuta d,".
          "$DBUser.tabel_305_cara_bayar e ".
       "where ".
       "a.kdpertanggungan='2' and ".
       "a.nopenagih=f.nopenagih and ".
       "f.kdrayonpenagih='$kantor' and ".
       "c.prefixpertanggungan=a.prefixpertanggungan and ".
       "c.nopertanggungan=a.nopertanggungan and ".
       "c.tglseatled is NULL and ".
       "a.kdvaluta=d.kdvaluta and ".
       "a.kdcarabayar=e.kdcarabayar and ".
       "$periode and ".
			 "a.kdstatusfile='1' and (c.status is null or c.status!='4') and ".
       "a.kdstatusfile='1' and ".
       "(c.status is null or c.status!='4') and ".
       "a.kdvaluta='3' and ".
       "a.kdcarabayar in ('3','H')) b ";
	$DB->parse($qry);
  $DB->execute();
	$ars=$DB->nextrow();
	$kuilunassmt=$ars["JMLKUILUNAS"];
	$kuiblmlunassmt=$ars["JMLKUIBELUMLUNAS"];
	$usdlunassmt=$ars["JMLRPBLNLUNAS"];
	$usdblmlunassmt=$ars["JMLRPBLNBELUMLUNAS"];	
#----------------------- DOLLAR US TAHUNAN-------------
$qry = "select l.jmlkuilunas,l.jmlrpblnlunas,b.jmlkuibelumlunas,b.jmlrpblnbelumlunas ".
       "from ".
       "(select count(c.nopertanggungan) jmlkuilunas,sum(c.premitagihan) jmlrpblnlunas ".
       "from ".
          "$DBUser.tabel_300_historis_premi c,".
          "$DBUser.tabel_200_pertanggungan a,".
          "$DBUser.tabel_500_penagih f,  ".
          "$DBUser.tabel_304_valuta d,".
          "$DBUser.tabel_305_cara_bayar e ".
       "where ".
          "a.kdpertanggungan='2' and ".
          "a.nopenagih=f.nopenagih and ".
          "f.kdrayonpenagih='$kantor' and ".
          "c.prefixpertanggungan=a.prefixpertanggungan and ".
          "c.nopertanggungan=a.nopertanggungan and ".
          "c.tglseatled is NOT NULL and ".
          "a.kdvaluta=d.kdvaluta and ".
          "a.kdcarabayar=e.kdcarabayar and ".
          "$periode and ".
					"a.kdstatusfile='1' and (c.status is null or c.status!='4') and ".
          "a.kdstatusfile='1' and ".
          "(c.status is null or c.status!='4') and ".
          "a.kdvaluta='3' and ".
          "a.kdcarabayar in ('4','A')) l,".
       "(select count(c.nopertanggungan) jmlkuibelumlunas,sum(c.premitagihan) jmlrpblnbelumlunas ".
       "from ".
          "$DBUser.tabel_300_historis_premi c,".
          "$DBUser.tabel_200_pertanggungan a, ".
          "$DBUser.tabel_500_penagih f,".
          "$DBUser.tabel_304_valuta d,".
          "$DBUser.tabel_305_cara_bayar e ".
       "where ".
       "a.kdpertanggungan='2' and ".
       "a.nopenagih=f.nopenagih and ".
       "f.kdrayonpenagih='$kantor' and ".
       "c.prefixpertanggungan=a.prefixpertanggungan and ".
       "c.nopertanggungan=a.nopertanggungan and ".
       "c.tglseatled is NULL and ".
       "a.kdvaluta=d.kdvaluta and ".
       "a.kdcarabayar=e.kdcarabayar and ".
       "$periode and ".
			 "a.kdstatusfile='1' and (c.status is null or c.status!='4') and ".
       "a.kdstatusfile='1' and ".
       "(c.status is null or c.status!='4') and ".
       "a.kdvaluta='3' and ".
       "a.kdcarabayar in ('4','A')) b ";
	$DB->parse($qry);
  $DB->execute();
	$art=$DB->nextrow();
	$kuilunasthn=$art["JMLKUILUNAS"];
	$kuiblmlunasthn=$art["JMLKUIBELUMLUNAS"];
	$usdlunasthn=$art["JMLRPBLNLUNAS"];
	$usdblmlunasthn=$art["JMLRPBLNBELUMLUNAS"];
#----------------------- DOLLAR US TOTAL -------------
$qry = "select l.jmlkuilunas,l.jmlrpblnlunas,b.jmlkuibelumlunas,b.jmlrpblnbelumlunas ".
       "from ".
       "(select count(c.nopertanggungan) jmlkuilunas,sum(c.premitagihan) jmlrpblnlunas ".
       "from ".
          "$DBUser.tabel_300_historis_premi c,".
          "$DBUser.tabel_200_pertanggungan a,".
          "$DBUser.tabel_500_penagih f,  ".
          "$DBUser.tabel_304_valuta d,".
          "$DBUser.tabel_305_cara_bayar e ".
       "where ".
          "a.kdpertanggungan='2' and ".
          "a.nopenagih=f.nopenagih and ".
          "f.kdrayonpenagih='$kantor' and ".
          "c.prefixpertanggungan=a.prefixpertanggungan and ".
          "c.nopertanggungan=a.nopertanggungan and ".
          "c.tglseatled is NOT NULL and ".
          "a.kdvaluta=d.kdvaluta and ".
          "a.kdcarabayar=e.kdcarabayar and ".
          "$periode and ".
					"a.kdstatusfile='1' and (c.status is null or c.status!='4') and ".
          "a.kdstatusfile='1' and ".
          "(c.status is null or c.status!='4') and ".
          "a.kdvaluta='3' and ".
          "a.kdcarabayar in ('1','M','2','Q','3','H','4','A')) l,".
       "(select count(c.nopertanggungan) jmlkuibelumlunas,sum(c.premitagihan) jmlrpblnbelumlunas ".
       "from ".
          "$DBUser.tabel_300_historis_premi c,".
          "$DBUser.tabel_200_pertanggungan a, ".
          "$DBUser.tabel_500_penagih f,".
          "$DBUser.tabel_304_valuta d,".
          "$DBUser.tabel_305_cara_bayar e ".
       "where ".
       "a.kdpertanggungan='2' and ".
       "a.nopenagih=f.nopenagih and ".
       "f.kdrayonpenagih='$kantor' and ".
       "c.prefixpertanggungan=a.prefixpertanggungan and ".
       "c.nopertanggungan=a.nopertanggungan and ".
       "c.tglseatled is NULL and ".
       "a.kdvaluta=d.kdvaluta and ".
       "a.kdcarabayar=e.kdcarabayar and ".
       "$periode and ".
			 "a.kdstatusfile='1' and (c.status is null or c.status!='4') and ".
       "a.kdstatusfile='1' and ".
       "(c.status is null or c.status!='4') and ".
       "a.kdvaluta='3' and ".
       "a.kdcarabayar in ('1','M','2','Q','3','H','4','A')) b ";
	$DB->parse($qry);
  $DB->execute();
	$arx=$DB->nextrow();
	$kuilunasall=$arx["JMLKUILUNAS"];
	$kuiblmlunasall=$arx["JMLKUIBELUMLUNAS"];
	$usdlunasall=$arx["JMLRPBLNLUNAS"];
	$usdblmlunasall=$arx["JMLRPBLNBELUMLUNAS"];	
	
	echo "<tr>";
	echo "<td class=\"a\" align=\"left\" colspan=\"8\"><b>Dollar</b></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\">Bulanan</td>";
	echo "<td class=\"verdana8blk\" align=\"right\">US$</td>";
	echo "<td class=\"verdana8blk\" align=\"right\"><a href=\"detilpelunasanpremi.php?kdkantor=$kodekantor&carabayar=DOLLARBULAN&cek=$usdlunasbln&vbln=$bln&vth=$vthn&statuskui=SL\">".$kuilunasbln."</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\">".number_format($usdlunasbln,2)."</td>";
	echo "<td class=\"verdana8blk\" align=\"right\"><a href=\"detilpelunasanpremi.php?kdkantor=$kodekantor&carabayar=DOLLARBULAN&cek=$usdblmlunasbln&vbln=$bln&vth=$vthn&statuskui=BL\">".$kuiblmlunasbln."</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\">".number_format($usdblmlunasbln,2)."</td>";
	  $subtotkuiusdbln=$kuilunasbln + $kuiblmlunasbln;
		$subtotuangusdbln=$usdlunasbln + $usdblmlunasbln;
	echo "<td class=\"verdana8blk\" align=\"right\">".$subtotkuiusdbln."</td>";
	echo "<td class=\"verdana8blk\" align=\"right\">".number_format($subtotuangusdbln,2)."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\" bgcolor=#e0e0e4>Kwartalan</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>US$</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4><a href=\"detilpelunasanpremi.php?kdkantor=$kodekantor&carabayar=DOLLARKUARTAL&cek=$usdlunaskwt&vbln=$bln&vth=$vthn&statuskui=SL\">".$kuilunaskwt."</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>".number_format($usdlunaskwt,2)."</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4><a href=\"detilpelunasanpremi.php?kdkantor=$kodekantor&carabayar=DOLLARKUARTAL&cek=$usdblmlunaskwt&vbln=$bln&vth=$vthn&statuskui=BL\">".$kuiblmlunaskwt."</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>".number_format($usdblmlunaskwt,2)."</td>";
	  $subtotkuiusdkwt=$kuilunaskwt + $kuiblmlunaskwt;
		$subtotuangusdkwt=$usdlunaskwt + $usdblmlunaskwt;
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>".$subtotkuiusdkwt."</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>".number_format($subtotuangusdkwt,2)."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\">Semesteran</td>";
	echo "<td class=\"verdana8blk\" align=\"right\">US$</td>";
	echo "<td class=\"verdana8blk\" align=\"right\"><a href=\"detilpelunasanpremi.php?kdkantor=$kodekantor&carabayar=DOLLARSEMESTER&cek=$usdlunassmt&vbln=$bln&vth=$vthn&statuskui=SL\">".$kuilunassmt."</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\">".number_format($usdlunassmt,2)."</td>";
	echo "<td class=\"verdana8blk\" align=\"right\"><a href=\"detilpelunasanpremi.php?kdkantor=$kodekantor&carabayar=DOLLARSEMESTER&cek=$usdblmlunassmt&vbln=$bln&vth=$vthn&statuskui=BL\">".$kuiblmlunassmt."</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\">".number_format($usdblmlunassmt,2)."</td>";
	  $subtotkuiusdsmt=$kuilunassmt + $kuiblmlunassmt;
		$subtotuangusdsmt=$usdlunassmt + $usdblmlunassmt;
	echo "<td class=\"verdana8blk\" align=\"right\">".$subtotkuiusdsmt."</td>";
	echo "<td class=\"verdana8blk\" align=\"right\">".number_format($subtotuangusdsmt,2)."</td>";
  echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"left\" bgcolor=#e0e0e4>Tahunan</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>US$</td>";
  echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4><a href=\"detilpelunasanpremi.php?kdkantor=$kodekantor&carabayar=DOLLARTAHUN&cek=$usdlunasthn&vbln=$bln&vth=$vthn&statuskui=SL\">".$kuilunasthn."</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>".number_format($usdlunasthn,2)."</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4><a href=\"detilpelunasanpremi.php?kdkantor=$kodekantor&carabayar=DOLLARTAHUN&cek=$usdblmlunasthn&vbln=$bln&vth=$vthn&statuskui=BL\">".$kuiblmlunasthn."</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>".number_format($usdblmlunasthn,2)."</td>";
	  $subtotkuiusdthn=$kuilunasthn + $kuiblmlunasthn;
		$subtotuangusdthn=$usdlunasthn + $usdblmlunasthn;
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>".$subtotkuiusdthn."</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#e0e0e4>".number_format($subtotuangusdthn,2)."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC>Total</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC>US$</td>";
  echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC><a href=\"detilpelunasanpremi.php?kdkantor=$kodekantor&carabayar=DOLLAR&cek=$usdlunasall&vbln=$bln&vth=$vthn&statuskui=SL\">".$kuilunasall."</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC>".number_format($usdlunasall,2)."</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC><a href=\"detilpelunasanpremi.php?kdkantor=$kodekantor&carabayar=DOLLAR&cek=$usdblmlunasall&vbln=$bln&vth=$vthn&statuskui=BL\">".$kuiblmlunasall."</a></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC>".number_format($usdblmlunasall,2)."</td>";
	  $totalusdkuiall=$kuilunasall + $kuiblmlunasall;
		$totalusduangall=$usdlunasall + $usdblmlunasall;
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC>".$totalusdkuiall."</td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC>".number_format($totalusduangall,2)."</td>";
	echo "</tr>";
	echo "<tr><td></td></tr>";
	echo "</table>";

?>
</div><br>
<font face="verdana" size="2"><a href="../pelaporan/index.php">Menu Manajemen Informasi</a></font>
</body>