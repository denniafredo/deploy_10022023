<?
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	include "../../includes/common.php";
	include "../../includes/kantor.php";
  $DB=new Database($userid, $passwd, $DBName);
	$KT=new Kantor($userid,$passwd,$kdkantor);
  
echo "<body>";
echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
echo "<font face=\"verdana\" size=\"2\"><b>Rayon Penagihan : ".$KT->namakantor." (".$kdkantor.")</b></font><br>";
echo "<input type=\"hidden\" value=\"1\" name=\"on\">";
switch ($carabayar) {
	case "RUPIAH":  $sambung="and a.kdcarabayar in ('1','2','3','4','M','Q','H','A') and a.kdvaluta='1'"; break;
	case "RPBULAN":  $sambung="and a.kdcarabayar in ('1','M') and a.kdvaluta='1'"; $mayah="BULANAN"; break;
	case "RPKUARTAL":  $sambung="and a.kdcarabayar in ('2','Q') and a.kdvaluta='1'"; $mayah="KUARTALAN"; break;
	case "RPSEMESTER":  $sambung="and a.kdcarabayar in ('3','H') and a.kdvaluta='1'"; $mayah="SEMESTERAN"; break;
	case "RPTAHUN":  $sambung="and a.kdcarabayar in ('4','A') and a.kdvaluta='1'"; $mayah="TAHUNAN"; break;
	case "RPI":  $sambung="and a.kdcarabayar in ('1','2','3','4','M','Q','H','A') and a.kdvaluta='0'"; break;
	case "RPIBULAN":  $sambung="and a.kdcarabayar in ('1','M') and a.kdvaluta='0'"; $mayah="BULANAN"; break;
	case "RPIKUARTAL":  $sambung="and a.kdcarabayar in ('2','Q') and a.kdvaluta='0'"; $mayah="KUARTALAN"; break;
	case "RPISEMESTER":  $sambung="and a.kdcarabayar in ('3','H') and a.kdvaluta='0'"; $mayah="SEMESTERAN"; break;
	case "RPITAHUN":  $sambung="and a.kdcarabayar in ('4','A') and a.kdvaluta='0'"; $mayah="TAHUNAN"; break;
	case "DOLLAR":  $sambung="and a.kdcarabayar in ('1','2','3','4','M','Q','H','A') and a.kdvaluta='3'"; break;
	case "DOLLARBULAN":  $sambung="and a.kdcarabayar in ('1','M') and a.kdvaluta='3'"; $mayah="BULANAN"; break;
	case "DOLLARKUARTAL":  $sambung="and a.kdcarabayar in ('2','Q') and a.kdvaluta='3'"; $mayah="KUARTALAN"; break;
	case "DOLLARSEMESTER":  $sambung="and a.kdcarabayar in ('3','H') and a.kdvaluta='3'"; $mayah="SEMESTERAN"; break;
	case "DOLLARTAHUN":  $sambung="and a.kdcarabayar in ('4','A') and a.kdvaluta='3'"; $mayah="TAHUNAN"; break;
}
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
echo "<hr size=1>";
$qry ="select distinct(d.notasi),d.namavaluta,a.kdcarabayar ".
		 "from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_304_valuta d ".
		 "where a.kdvaluta=d.kdvaluta and a.kdpertanggungan='2' $sambung ";
$DB->parse($qry);
$DB->execute();
$arr=$DB->nextrow();
if ($cek==NULL) {
	echo "<br><font face=\"Verdana\" size=\"2\" color=\"#ff0000\"><b>Tidak Ada Premi Jatuh Tempo Periode $bulan $vth</b></font><br>";
	echo "<font face=\"Verdana\" size=\"2\" color=\"#ff0000\"><b>Cara Bayar $mayah Valuta ".$arr["NAMAVALUTA"]."</b></font><br><br>";
} else {

  if($vbln==""){
	  $periode="to_char(c.tglbooked,'YYYY')='$vth'";
	} else {
	  $periode="to_char(c.tglbooked,'MMYYYY')='$vbln$vth'";
	}

	$qry ="select c.prefixpertanggungan,c.nopertanggungan,(select b.namaklien1 from ".
			 "$DBUser.tabel_100_klien b where a.prefixpertanggungan=c.prefixpertanggungan and ".
			 "a.nopertanggungan=c.nopertanggungan and a.notertanggung=b.noklien) namatertanggung,".
			 "to_char(a.mulas,'DD/MM/YYYY') mulas,a.kdproduk,a.kdcarabayar,e.namacarabayar,a.nopenagih,".
			 "(select b.namaklien1 from $DBUser.tabel_100_klien b where a.nopenagih=b.noklien) penagih,".
			 "to_char(a.tgllastpayment,'DD/MM/YYYY') tgllastpayment,to_char(c.tglbooked,'DD/MM/YYYY') tglbooked,".
			 "to_char(c.tglseatled,'DD/MM/YYYY') tglseatled,".
			 "d.notasi,c.premitagihan,a.juamainproduk,c.status ".
			 "from ".
			 "$DBUser.tabel_200_pertanggungan a,".
			 "$DBUser.tabel_300_historis_premi c,".
			 "$DBUser.tabel_304_valuta d,".
			 "$DBUser.tabel_305_cara_bayar e,".
			 "$DBUser.tabel_500_penagih f ".
			 "where a.kdpertanggungan='2' and a.kdstatusfile='1' and a.nopenagih=f.nopenagih and ".
			 "f.kdrayonpenagih='$kdkantor' and c.prefixpertanggungan=a.prefixpertanggungan and ".
			 "c.nopertanggungan=a.nopertanggungan and (c.status is null or c.status!='4') and ". 
			 "a.kdvaluta=d.kdvaluta and a.kdcarabayar=e.kdcarabayar and c.tglseatled is null and ".
			 "$periode $sambung ".
			 "order by a.nopenagih,a.prefixpertanggungan,a.nopertanggungan";
	//echo $qry."<br>";
	$DB->parse($qry);
	$DB->execute();
	echo "<font face=\"Verdana\" size=\"2\">Premi Jatuh Tempo Periode <b>$bulan $vth</b></font><br>";
	echo "<font face=\"Verdana\" size=\"2\">Cara Bayar <b>$mayah</b> Valuta <b>".$arr["NAMAVALUTA"]."</b></font><br>";
	echo "<table border=\"0\" cellpadding=\"2\" cellspacing=\"1\">";   
	echo "<tr>";
	echo "<td bgcolor=\"#6699FF\" align=\"center\" class=\"verdana8bol\">No</td>";
	echo "<td bgcolor=\"#6699FF\" align=\"center\" class=\"verdana8bol\">Nomor<br>Pertanggungan</td>";
	echo "<td bgcolor=\"#6699FF\" align=\"center\" class=\"verdana8bol\">Nama Tertanggung</td>";
	echo "<td bgcolor=\"#6699FF\" align=\"center\" class=\"verdana8bol\">Mulai<br>Asuransi</br></td>";
	echo "<td bgcolor=\"#6699FF\" align=\"center\" class=\"verdana8bol\">Produk</td>";
	echo "<td bgcolor=\"#6699FF\" align=\"center\" class=\"verdana8bol\">Nomor<br>Penagih</td>";
	echo "<td bgcolor=\"#6699FF\" align=\"center\" class=\"verdana8bol\">Tgl. Bayar<br>Terakhir</br></td>";
	echo "<td bgcolor=\"#6699FF\" align=\"center\" class=\"verdana8bol\">Tgl. Jatuh<br>Tempo</br></td>";
	echo "<td bgcolor=\"#6699FF\" align=\"center\" class=\"verdana8bol\">Tgl. Seatled</td>";
	echo "<td bgcolor=\"#6699FF\" align=\"center\" class=\"verdana8bol\">Valuta</td>";
	echo "<td bgcolor=\"#6699FF\" align=\"center\" class=\"verdana8bol\">Premi Tagihan</td>";
	echo "<td bgcolor=\"#6699FF\" align=\"center\" class=\"verdana8bol\">Jumlah <br>Uang Asuransi</br></td>";
	echo "</tr>";       
	$i=1;
	while($arx=$DB->nextrow()){
	  include "../../includes/belang.php";
    echo "<td class=\"verdana8blk\" align=\"right\">".$i.".</td>";
		echo "<td class=\"verdana8blk\" align=\"center\">";
		echo "<a href=\"#\" onclick=\"window.open('../akunting/kartupremi1.php?prefix=".$arx["PREFIXPERTANGGUNGAN"]."&noper=".$arx["NOPERTANGGUNGAN"]."','kartupremi','width=700,height=600,top=100,left=50,scrollbars=yes')\">".$arx["PREFIXPERTANGGUNGAN"]."-".$arx["NOPERTANGGUNGAN"]."</a></td>";
		echo "<td class=\"verdana8blk\" align=\"left\">".$arx["NAMATERTANGGUNG"]."</td>";
		echo "<td class=\"verdana8blk\" align=\"center\">".$arx["MULAS"]."</td>";
		echo "<td class=\"verdana8blk\" align=\"center\">".$arx["KDPRODUK"]."</td>";
		echo "<td class=\"verdana8blk\" align=\"center\">".$arx["NOPENAGIH"]."</td>";
		echo "<td class=\"verdana8blk\" align=\"center\">".$arx["TGLLASTPAYMENT"]."</td>";
		echo "<td class=\"verdana8red\" align=\"center\">".$arx["TGLBOOKED"]."</td>";
		echo "<td class=\"verdana8red\" align=\"center\">".$arx["TGLSEATLED"]."</td>";
		echo "<td class=\"verdana8blk\" align=\"right\">".$arx["NOTASI"]."</td>";
		echo "<td class=\"verdana8blk\" align=\"right\">".number_format($arx["PREMITAGIHAN"],2)."</td>";
		echo "<td class=\"verdana8blk\" align=\"right\">".number_format($arx["JUAMAINPRODUK"],2)."</td>";
		echo "</tr>";
	  $i++;
  }
	echo "<tr>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC colspan=\"9\"><b>Total</b></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC><b>".$arr["NOTASI"]."</b></td>";
	echo "<td class=\"verdana8blk\" align=\"right\" bgcolor=#D8E2FC><b>".number_format($cek,2)."</b></td>";
	echo "<td class=\"verdana8blk\" bgcolor=#D8E2FC></td>";
	echo "</tr>";
	echo "</table><br>";
}
echo "<hr size=\"1\">";
echo "<font face=\"verdana\" size=\"2\"><a href=\"premitagihankantor.php?kodekantor=$kdkantor&vbln=$vbln&vthn=$vth\">Back</a></font>";
echo "</body>";
?>
