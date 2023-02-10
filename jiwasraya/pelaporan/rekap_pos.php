<? 
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
	include "../../includes/kantor.php";
	//include "../../includes/komisiagen.php";
	
  $DB=new database($userid, $passwd, $DBName);
	$KTR=new Kantor($userid,$passwd,$kantor);
	
function DateSelector($inName, $useDate=0) 
{ 
          if($useDate == 0) 
          { 
              $useDate = Time(); 
          } 
  
      		// Tanggal
      		$selected	= (isset($_POST[$inName.'tgl']) && $_POST[$inName.'tgl']!='') ? $_POST[$inName.'tgl'] : date( "j", $useDate);
          print("<select name=" . $inName .  "tgl>\n"); 
          for($currentDay = 1; $currentDay<= 31;$currentDay++) 
          { 
              print("<option value=\"$currentDay\""); 
  						if($selected==$currentDay) 
              { 
                  print(" selected"); 
              } 					
              print(">$currentDay\n"); 						
          } 
          print("</select>"); 
  
  
  				$selected	= (isset($_POST[$inName.'bln']) && $_POST[$inName.'bln']!='') ? $_POST[$inName.'bln'] : date( "n", $useDate);			
          print("<select name=" . $inName .  "bln>\n"); 
          for($currentMonth = 1; $currentMonth <= 12;$currentMonth++) 
          { 
              switch($currentMonth)
              {
                case '1' : $namabulan ="JANUARI"; break ;
                case '2' : $namabulan ="FEBRUARI"; break ;
                case '3' : $namabulan ="MARET"; break ;
                case '4' : $namabulan ="APRIL"; break ;
                case '5' : $namabulan ="MEI"; break ;
                case '6' : $namabulan ="JUNI"; break ;
                case '7' : $namabulan ="JULI"; break ;
                case '8' : $namabulan ="AGUSTUS"; break ;
                case '9' : $namabulan ="SEPTEMBER"; break ;
                case '10' : $namabulan ="OKTOBER"; break ;
                case '11' : $namabulan ="NOVEMBER"; break ;
                case '12' : $namabulan ="DESEMBER"; break ;
              }
  						
              print("<option value=\"$currentMonth\""); 
  						if($selected==$currentMonth) 
              { 
                  print(" selected"); 
              } 					
              print(">$namabulan\n"); 						
          } 
          print("</select>"); 
  
  			
  			$selected	= (isset($_POST[$inName.'thn']) && $_POST[$inName.'thn']!='') ? $_POST[$inName.'thn'] : date( "Y", $useDate);			
          print("<select name=" . $inName .  "thn>\n"); 
          $startYear = date( "Y", $useDate); 
          for($currentYear = 2003; $currentYear <= $startYear+0;$currentYear++) 
          { 
              print("<option value=\"$currentYear\""); 
  						if($selected==$currentYear) 
              { 
                  print(" selected"); 
              } 
              print(">$currentYear\n"); 
  						
          } 
  				print("</select>"); 
} 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Untitled</title>
<style type="text/css">
<!-- 
body { 
 font-size: 12px;
 font-family: verdana;
 } 
td { 
 font-size: 11px;
 font-family: verdana;
 } 
-->
</style>
</head>
<?
	if ($mode=='print'){
		echo "<body onload=\"window.print();window.close()\">";
//		echo "<body>";
	}
	else{
		echo "<body>";
?>

<form name="getpremi" action="<?=$PHP_SELF;?>" action="post">
<?
	if ($kdbank=='POS'){
		$selbank1="selected";
	}	
?>
  <a class="verdana10blk">Pembayaran Melalui</a>
	<select name="kdbank">
	  <option value="POS" <?=$selbank1;?>>PT. POS INDONESIA (POS)</option>
	</select>
  <a class="verdana10blk">Dari <?=DateSelector("d"); ?> Sampai <?=DateSelector("s"); ?></a>
	<input type="submit" name="submit" value="Cari">
</form>
<br />

<?
}
?>

<br />
<div align="center">
<?
	$tglawal .= $dthn;
	$tglawal .= ((strlen($dbln)==1) ? '0'.$dbln : $dbln);
	$tglawal .= ((strlen($dtgl)==1) ? '0'.$dtgl : $dtgl);
	
	$tglakhir .= $sthn;
	$tglakhir .= ((strlen($sbln)==1) ? '0'.$sbln : $sbln);
	$tglakhir .= ((strlen($stgl)==1) ? '0'.$stgl : $stgl);

	if ($kdbank=='POS') {
		$namabank='VIA PT. POS INDONESIA (POS)';
		$namalike='POS';
	}
?>
<b>REKAPITULASI HASIL PEMBAYARAN PREMI <?=$namabank;?> <br /> 
PERIODE <?=$tglawal;?> s/d <?=$tglakhir;?><br />SECARA NASIONAL</b><br><br>
</div>

<? 
$sql = "select ". 
            "distinct c.kdrayonpenagih as kdkantor ". 
          "from ".
            "$DBUser.tabel_300_historis_premi d, ".
            "$DBUser.tabel_200_pertanggungan b, ".
            "$DBUser.tabel_315_pelunasan_auto_debet a, ".
            "$DBUser.tabel_500_penagih c, ".
						"$DBUser.tabel_202_produk e ".
          "where ".
						"b.prefixpertanggungan=substr(a.nopolis,1,2) and ". 
   					"b.nopertanggungan=substr(a.nopolis,3,9) and ".
						"b.prefixpertanggungan=d.prefixpertanggungan and ". 
						"substr(b.kdproduk,1,3)<>'JL2' and ".
            "b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ". 
            "b.nopenagih=c.nopenagih and a.statuspembayaran='2' and ".
//						"b.kdvaluta='1' and ". 
						"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
						"b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' order by c.kdrayonpenagih";
		//echo $sql;
		//die;

		$DB->parse($sql);
	  $DB->execute();
  	$arp = $DB->result();	
?>

<!-- COBA ------------------------------------------------------------------------>

<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
  <tr>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    <b>No</b></td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    <b>Nomor BPS</b></td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    <b>No.Rekening</b></td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    <b>Kode Kantor - Nama Kantor</b></td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    <b>Total Premi</b></td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    <b>Total Discount</b></td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    <b>Total Materai</b></td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    <b>Total Debet</b></td>

  </tr>
	<tr>
	<? 

$i=1;
$total=0;

$totalmatre=0;
$totaldiscount =0;
$totaltotaldebet =0;
$totalpremi=0;

${"totalpreminb"} =0;
${"totalpremiob"} =0;

${"totaldiscountnb"} =0;
${"totaldiscountob"} =0;

${"totalmatrenb"}=0;
${"totalmatreob"}=0;
${"totaltotaldebetnb"}=0;
${"totaltotaldebetob"} =0;

foreach ($arp as $foo => $roww ) {
	$kdrayonpenagih = $roww["KDKANTOR"];

	$jmlmatre=0;
	$jmldiscount =0;
	$jmltotaldebet =0;
	$jmlpremi=0;
	
	${"jmlpreminb"} =0;
	${"jmlpremiob"} =0;
	
	${"jmldiscountnb"} =0;
	${"jmldiscountob"} =0;
	
	${"jmlmatrenb"}=0;
	${"jmlmatreob"}=0;
	${"jmltotaldebetnb"}=0;
	${"jmltotaldebetob"} =0;
	
	//$i=1;
	$discountnb = 0;
	$discountob = 0;
	$preminb = 0;
	$premiob = 0;
	$matrenb = 0;
	$matreob = 0;
	$totaldebetnb = 0;
	$totaldebetob = 0;
	$jnb = 0;
	$job = 0;
	$jmlkomisith1 = 0;
	$jmlkomisith2 = 0;
	$jmlkomisith3 = 0;	
	
	$sql = "select ".
		"c.kdrayonpenagih as kodekantor,".
		"(select namakantor from $DBUser.tabel_001_kantor where kdkantor=c.kdrayonpenagih) as namakantor,".
		"b.prefixpertanggungan,b.nopertanggungan,b.kdvaluta,b.indexawal,".
		"d.tglbooked as tglbuk,d.kdkuitansi,d.premitagihan,d.kdrekeninglawan,".
		"'148090000' as kodeakun,".
		"(select nama from $DBUser.tabel_802_kodeakun where akun='148090000') as namaakunperantara,".
		"to_number(a.jumlahtagihan)/100 as jmlpremi,".
		"a.nopolis,to_char(a.tglbooked,'MM/YYYY') as blntagihan,".
		"a.nokontrol,to_number(a.norekdebet) as norekdebet,a.norekkredit,a.statuspembayaran,".
		"a.nourut,".
		"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as namaklien, ".
		"(select phonetetap01 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as telp1, ".
		"(select phonetetap02 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as telp2, ".
		"a.beritakredit,a.statuspembayaran, ".
		"a.tglrekam,to_char(d.tglbayar,'DD/MM/YYYY') as tglbayar,a.tglupdated,".
		"to_char(d.tglbayar,'MM/YYYY') as blnbayar,".
		"b.nopenagih,b.noagen,b.norekeningdebet, ".
		"ceil(months_between(a.tglupdated,b.mulas)/12) as thnkomisi, ".
		
		"(select komisiagencb from $DBUser.tabel_404_temp ". 
		"where prefixpertanggungan=b.prefixpertanggungan ". 
		"and nopertanggungan=b.nopertanggungan ".
		"and thnkomisi= ceil(months_between(a.tglupdated,b.mulas)/12) ".
		"and kdkomisiagen='01') komisiagen, ".
		
		"(select kurs from $DBUser.tabel_999_kurs_transaksi where tglkursberlaku=".
      	       "(select max(tglkursberlaku) from $DBUser.tabel_999_kurs_transaksi ".
      	     	 "where tglkursberlaku<=a.tglrekam and kdvaluta=b.kdvaluta) ".
		 "and kdvaluta=b.kdvaluta ) kurs, ".
		 		
		"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.noagen) as namaagen, ".
		"e.kdcabas, ".
		
//		"(select nilaimeterai from $DBUser.tabel_999_batas_materai ".
//		"where to_number(a.jumlahtagihan)/100 between ".
//		"batasbawahpremi and batasataspremi ".
//		") as matere ".
		"'0' as matere ".
	"from ".
		"$DBUser.tabel_300_historis_premi d,".
		"$DBUser.tabel_200_pertanggungan b,".
		"$DBUser.tabel_315_pelunasan_auto_debet a,".
		"$DBUser.tabel_500_penagih c, ".
		"$DBUser.tabel_202_produk e ".
	"where ".
		"b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
		"b.nopertanggungan=substr(a.nopolis,3,9) and ".
		"b.prefixpertanggungan=d.prefixpertanggungan and ".
		"b.nopertanggungan=d.nopertanggungan and ".
		"a.tglbooked=d.tglbooked and ".
		"b.nopenagih=c.nopenagih and ".
		"substr(b.kdproduk,1,3)<>'JL2' and ".
		"a.statuspembayaran='2' and ".
//		"b.kdvaluta='1' and ".
		"to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ".
		"c.kdrayonpenagih='$kdrayonpenagih' and ".
		"b.kdproduk=e.kdproduk and a.kdbank='".$kdbank."' ".
	"order by d.kdkuitansi, d.prefixpertanggungan, d.nopertanggungan";
	
	//echo $sql."asdasdasd<br /><br />";
	//die;
	$DB->parse($sql);
	$DB->execute();

	while ($arr=$DB->nextrow()) {
		$tglbayar=$arr["TGLBAYAR"];
		$kodeakun=$arr["KODEAKUN"];
		$kodekantor=$arr["KODEKANTOR"];
		$namakantor=$arr["NAMAKANTOR"];

		$kdkui = substr($arr["KDKUITANSI"],0,2);
		if($kdkui=="NB"){
			// IDX
			if ($arr["KDVALUTA"]=='0'){
				$preminb = round($arr["PREMITAGIHAN"]/ $arr["INDEXAWAL"],2) * $arr["KURS"];
				$premiob = 0;
				$discountnb = (round($arr["PREMITAGIHAN"]/ $arr["INDEXAWAL"],2) * 0.01 * $arr["KURS"]);
				$discountob = 0;
			}
			// USD
			elseif ($arr["KDVALUTA"]=='3'){
				$preminb = $arr["PREMITAGIHAN"] * $arr["KURS"];
				$premiob = 0;
				$discountnb = ($arr["PREMITAGIHAN"] * 0.01 * $arr["KURS"]);
				$discountob = 0;
			}
			// IDR
			elseif ($arr["KDVALUTA"]=='1'){
				$preminb = $arr["PREMITAGIHAN"];
				$premiob = 0;
				$discountnb = ($arr["PREMITAGIHAN"] * 0.01);
				$discountob = 0;
			}

			$matrenb		= $arr["MATERE"];
			$matreob		= 0;
			$totaldebetnb = $arr["JMLPREMI"];
			$totaldebetob = 0;
			$jnb++;
			${"kdreknb".$cabas} = $arr["KDREKENINGLAWAN"];
		}elseif($kdkui=="OB"){
			$premiob = $arr["PREMITAGIHAN"];
			$preminb = 0;
			// IDX
			if ($arr["KDVALUTA"]=='0'){
				$premiob = round($arr["PREMITAGIHAN"]/ $arr["INDEXAWAL"],2) * $arr["KURS"];
				$preminb = 0;
				$discountob = (round($arr["PREMITAGIHAN"]/ $arr["INDEXAWAL"],2) * 0.01 * $arr["KURS"]);
				$discountnb = 0;
			}
			// USD
			elseif ($arr["KDVALUTA"]=='3'){
				$premiob = $arr["PREMITAGIHAN"] * $arr["KURS"];
				$preminb = 0;
				$discountob = ($arr["PREMITAGIHAN"] * 0.01 * $arr["KURS"]);
				$discountnb = 0;
			}
			// IDR
			elseif ($arr["KDVALUTA"]=='1'){
				$premiob = $arr["PREMITAGIHAN"];
				$preminb = 0;
				$discountob = ($arr["PREMITAGIHAN"] * 0.01);
				$discountnb = 0;
			}

			$matreob		= $arr["MATERE"];
			$matrenb		= 0;
			$totaldebetob = $arr["JMLPREMI"];
			$totaldebetnb = 0;
			$job++;
			${"kdrekob".$cabas} = $arr["KDREKENINGLAWAN"];
		}

		if($arr["BLNBAYAR"]!=$arr["BLNTAGIHAN"]){
			$discount = 0;
			$discountnb = 0;
			$discountob = 0;
			$matreob = 0;
			$matrenb = 0;
		}else{
			// IDX
			if ($arr["KDVALUTA"]=='0'){
				$discount = (round($arr["PREMITAGIHAN"]/ $arr["INDEXAWAL"],2) * 0.01 * $arr["KURS"]);
			}
			// USD
			elseif ($arr["KDVALUTA"]=='3'){
				$discount = ($arr["PREMITAGIHAN"] * 0.01 * $arr["KURS"]);
			}
			// IDR
			elseif ($arr["KDVALUTA"]=='1'){
				$discount = ($arr["PREMITAGIHAN"] * 0.01);
			}

			$discountnb = $discountnb;
			$discountob = $discountob;

// Tambahan dari Ari utk menganulir nilai di atas
			$discount = 0;
			$discountnb = 0;
			$discountob = 0;
			$matreob = 0;
			$matrenb = 0;

		}		

	//	$i++;
		$jmlmatre+=$matre;
		$jmldiscount +=$discount;
		$jmltotaldebet += $arr["JMLPREMI"];
		$jmlpremi += $arr["PREMITAGIHAN"];
		
		${"jmlpreminb"} += $preminb;
		${"jmlpremiob"} += $premiob;
		
		${"jmldiscountnb"} +=$discountnb;
		${"jmldiscountob"} +=$discountob;
		
		${"jmlmatrenb"}+=$matrenb;
		${"jmlmatreob"}+=$matreob;
		${"jmltotaldebetnb"} += $totaldebetnb;
		${"jmltotaldebetob"} += $totaldebetob;


// Total
		$totalmatre+=$matre;
		$totaldiscount +=$discount;
		$totaltotaldebet += $arr["JMLPREMI"];
		$totalpremi += $arr["PREMITAGIHAN"];
		
		${"totalpreminb"} += $preminb;
		${"totalpremiob"} += $premiob;
		
		${"totaldiscountnb"} +=$discountnb;
		${"totaldiscountob"} +=$discountob;
		
		${"totalmatrenb"}+=$matrenb;
		${"totalmatreob"}+=$matreob;
		${"totaltotaldebetnb"} += $totaldebetnb;
		${"totaltotaldebetob"} += $totaldebetob;
		
	}
	
	?>	

	<tr>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=$i;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"></td>		
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$kodeakun;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"> <?=$kodekantor;?> - <?=$namakantor;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($jmlpreminb+$jmlpremiob,2,",",".");?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($jmldiscountnb+$jmldiscountob,2,",",".");?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($jmlmatrenb+$jmlmatreob,2,",",".");?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($jmltotaldebetnb+$jmltotaldebetob,2,",",".");?></td>
	</tr>
	<? 
  	$total=$total+$arr["JMLPREMI"];

		$i++;
	} 
	?>
	<tr bgcolor="#f5d79c">
	 <td></td>
	 <td colspan="3" align="center"><b>T O T A L</b></td>
	 <td align="right"><?=number_format($totalpreminb+$totalpremiob,2,",",".");?></td>
	 <td align="right"><?=number_format($totaldiscountnb+$totaldiscountob,2,",",".");?></td>
	 <td align="right"><?=number_format($totalmatrenb+$totalmatreob,2,",",".");?></td>
	 <td align="right"><?=number_format($totaltotaldebetnb+$totaltotaldebetob,2,",",".");?></td>
	</tr>
</table>
	
<?	
$kom=$totaltotaldebetnb+$totaltotaldebetob;
$nilai1=$totalpreminb+$totalpremiob;
$nilai2=$totaldiscountnb+$totaldiscountob;
$nilai3=$totalmatrenb+$totalmatreob;

if ($mode!='print'){

echo("<font face=Verdana size=1><a href=\"index.php\">Menu Pelaporan</a></font>");
echo("<font face=Verdana size=1>&nbsp;&nbsp;|&nbsp;&nbsp;</font>");
echo("<font face=Verdana size=1><a href=\"#\" onclick=\"window.open('../akunting/cetakslip_pos.php?kdbank=".$kdbank."&tgl=".$tglbayar."&kom=".$kom."&nilai1=".$nilai1."&nilai2=".$nilai2."&nilai3=".$nilai3."','','width=800,height=600,top=100,left=100,scrollbars=yes');\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak SLIP</a></font>");
echo("<font face=Verdana size=1>&nbsp;&nbsp;|&nbsp;&nbsp;</font>");
echo("<font face=Verdana size=1><a href=\"#\" onclick=\"window.open('rekap_pos.php?kdbank=".$kdbank."&dtgl=".$dtgl."&dbln=".$dbln."&dthn=".$dthn."&stgl=".$stgl."&sbln=".$sbln."&sthn=".$sthn."&mode=print','','width=1000,height=600,top=100,left=100,scrollbars=yes');\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak Lampiran</a></font>");

}
?>

</body>
</html>