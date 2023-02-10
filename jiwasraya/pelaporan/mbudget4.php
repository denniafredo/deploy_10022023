<?  
  include "../../includes/session.php"; 
  include "../../includes/starttimer.php"; 
  include "../../includes/database.php"; 
	include "../../includes/common.php";
	include "../../includes/fungsi.php";
	include "../../includes/oradb.class.php";

  $DBA = new Database($suid_GLLINK,$spass_GLLINK,$sdb_GLLINK);
  $DB = new Database($userid, $passwd, $DBName);
  $DBB = new Database($userid, $passwd, $DBName);
	
	?>
	<style type="text/css">
<!-- 
td {
 font-family: Verdana;
 font-size: 10px;
} 
-->
</style>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
	<?
	echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
	echo "<a class=verdana10blu><b>LAPORAN PENERIMAAN PREMI & BIAYA</b></a>";
	echo "<hr size=1>";
#---------------------------------------------- start navigasi -----------------
function nilaiRekening($kategori,$bgcolor,$DBA,$kdktr,$dthn,$kdrekening,$tglDariCari,$tglSampaiCari)
{
	$ptrrekening=2;
	$akun="";
	while ($ptrrekening<=strlen($kdrekening)){
	   $akun=$akun.substr($kdrekening,$ptrrekening,6);
		 $ptrrekening=$ptrrekening+9;
	}
		
	if (strlen($kdktr)==0){
		$wherekantor="";	
	}
	else if (strlen($kdktr)==1){
		$wherekantor="kdkantor like '".$kdktr."%' and ";
	}
	else{
		$wherekantor="kdkantor ='".$kdktr."' and ";
	}	
		
    // Target Tahun Dari
    $sq1 = "select sum(budget4) AS BUDGET ".
           "from $DBUser.TABEL_802_BUDGET ".
    			 "where ".$wherekantor."tahun='".$dthn."' and ".
    			 "akun in ".$kdrekening;
//		echo $sq1;
    $DBA->parse($sq1);
    $DBA->execute();
    $budget=0;
    while ($arx=$DBA->nextrow()) {
					$budget=$arx["BUDGET"];
    }					

    // Periode Tgl Dari s/d Tgl Sampai
    $sq2 = "select sum(debet) AS DEBET, sum(kredit) AS KREDIT ".
           "from $DBUser.tabel_802_trvouc ".
    			 "where ".$wherekantor."posted in('Y') and substr(notrans,0,1) in ('B','K') and kdtrans>='".$tglDariCari."' and kdtrans<='".$tglSampaiCari."' and ".
    			 "akun in ".$kdrekening;
//	echo $sq2;
    $DBA->parse($sq2);
    $DBA->execute();
    $debet1=0;
    $kredit1=0;					 
    while ($arx=$DBA->nextrow()) {
    			$debet1=$arx["DEBET"];
    			$kredit1=$arx["KREDIT"];			
    }					

		$rtnValue="<td align=\"right\" bgcolor=$bgcolor>".number_format($budget,2,",",".")."</td>";
		$rtnValue=$rtnValue."<td align=\"right\" bgcolor=$bgcolor><a href=\"#\" onclick=\"NewWindow('nilaixbobot_gllink.php?wherektr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."&akun=".$akun."','popuppage','1000','300','yes')\">".number_format(abs($kredit1-$debet1),2,",",".")."</a></td>";

		if ($budget==0){
				$rtnValue=$rtnValue."<td align=\"right\" bgcolor=$bgcolor>".number_format(0,2,",",".")."<br><input type='hidden' name='rekening' value='".$kdrekening."'></td>";
		}
		else{
				$rtnValue=$rtnValue."<td align=\"right\" bgcolor=$bgcolor>".number_format(abs($kredit1-$debet1)*100/$budget,2,",",".")."<br><input type='hidden' name='rekening' value='".$kdrekening."'></td>";
		}
		
		return $rtnValue;
}

function DateSelector($inName, $useDate=0) 
{ 
        if($useDate == 0) 
        { 
            $useDate = Time(); 
        } 

// Tanggal
        print("<select name=" . $inName .  "tgl>\n"); 
        for($currentDay = 1; $currentDay<= 31;$currentDay++) 
        { 
            print("<option value=\"$currentDay\""); 
            if(date( "j", $useDate)==$currentDay) 
            { 
                print(" selected"); 
            } 					
            print(">$currentDay\n"); 						
        } 
        print("</select>"); 

// Bulan				
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
            if(date( "n", $useDate)==$currentMonth) 
            { 
                print(" selected"); 
            } 					
            print(">$namabulan\n"); 						
        } 
        print("</select>"); 

// Tahun				
        print("<select name=" . $inName .  "thn>\n"); 
        $startYear = date( "Y", $useDate); 
        for($currentYear = $startYear - 2; $currentYear <= $startYear+0;$currentYear++) 
        { 
            print("<option value=\"$currentYear\""); 
            if(date( "Y", $useDate)==$currentYear) 
            { 
                print(" selected"); 
            } 
            print(">$currentYear\n"); 
						
        } 
        print("</select>"); 
} 

echo "  <table>";
echo "  <form name=produksi method=post action=$PHP_SELF>";
echo "    <tr>";
echo "      <td class=\"verdana9blk\">Periode Laporan</td>";
echo "      <td class=\"verdana9blk\"> ";
               DateSelector("d");
echo "      </td>";
echo "      <td class=\"verdana9blk\"> s/d </td> ";
echo "      <td class=\"verdana9blk\"> ";
               DateSelector("s");
echo "      </td>";
echo "      <td class=\"verdana9blk\"> ";
echo "        <input type=submit name=cari value=CARI>";               
echo "      </td>";
echo "    </tr>";
echo "  </form>";
echo "  </table>";
echo "<hr size=1>";

#--------------------------------------------------- end navigasi --------------
if($cari){

	$tglDari=substr('00'.$dtgl,-2)."/".substr('00'.$dbln,-2)."/".$dthn;
	$tglSampai=substr('00'.$stgl,-2)."/".substr('00'.$sbln,-2)."/".$sthn;
	
	$tglAwalCari=$sthn."0101";			 		 
	$tglDariCari=$dthn.substr('00'.$dbln,-2).substr('00'.$dtgl,-2);
	$tglSampaiCari=$sthn.substr('00'.$sbln,-2).substr('00'.$stgl,-2);
		
	echo "LAPORAN PENERIMAAN PREMI DAN BIAYA<br>";
	echo "PERIODE ".$tglDari." s/d ".$tglSampai."<br><br>";					

?>

 <table border="1" style="border-collapse: collapse" id="table1" cellpadding="5">
 <tr>
  <td bgcolor="#3366CC" align="center" rowspan="3"><font color="#FFFFFF">No</font></td>
  <td bgcolor="#3366CC" align="center" rowspan="3"><font color="#FFFFFF">Kantor</font></td>
  <td bgcolor="#3366CC" align="center" colspan="6"><font color="#FFFFFF">Pertanggungan Perorangan (PP)</font></td>
  <td bgcolor="#3366CC" align="center" colspan="6"><font color="#FFFFFF">Pertanggungan Kumpulan (PK) dan <br>Jaminan Hari Tua (JHT)</font></td>
  <td bgcolor="#3366CC" align="center" colspan="30"><font color="#FFFFFF">Biaya</font></td>
 </tr>
 <tr>
  <td bgcolor="#3366CC" align="center" colspan="3"><font color="#FFFFFF">NB</font></td>
  <td bgcolor="#3366CC" align="center" colspan="3"><font color="#FFFFFF">OB</font></td> 
  <td bgcolor="#3366CC" align="center" colspan="3"><font color="#FFFFFF">NB</font></td>
  <td bgcolor="#3366CC" align="center" colspan="3"><font color="#FFFFFF">OB</font></td> 
  <td bgcolor="#3366CC" align="center" colspan="3"><font color="#FFFFFF">Investasi</font></td> 
  <td bgcolor="#3366CC" align="center" colspan="3"><font color="#FFFFFF">Inkaso</font></td> 
  <td bgcolor="#3366CC" align="center" colspan="3"><font color="#FFFFFF">Pemasaran</font></td>
  <td bgcolor="#3366CC" align="center" colspan="3"><font color="#FFFFFF">Overhead</font></td> 
  <td bgcolor="#3366CC" align="center" colspan="3"><font color="#FFFFFF">Klaim PP</font></td> 
  <td bgcolor="#3366CC" align="center" colspan="3"><font color="#FFFFFF">Klaim PK</font></td> 
  <td bgcolor="#3366CC" align="center" colspan="3"><font color="#FFFFFF">Ekspirasi PP</font></td> 
  <td bgcolor="#3366CC" align="center" colspan="3"><font color="#FFFFFF">Ekspirasi PK</font></td> 
  <td bgcolor="#3366CC" align="center" colspan="3"><font color="#FFFFFF">Penebusan PP</font></td> 
  <td bgcolor="#3366CC" align="center" colspan="3"><font color="#FFFFFF">Penebusan PK</font></td> 
 </tr>
 <tr>
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Target</font></td>
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Realisasi</font></td> 
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Rasio</font></td> 
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Target</font></td>
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Realisasi</font></td> 
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Rasio</font></td> 
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Target</font></td>
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Realisasi</font></td> 
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Rasio</font></td> 
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Target</font></td>
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Realisasi</font></td> 
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Rasio</font></td> 
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Target</font></td>
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Realisasi</font></td> 
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Rasio</font></td> 
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Target</font></td>
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Realisasi</font></td> 
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Rasio</font></td> 
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Target</font></td>
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Realisasi</font></td> 
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Rasio</font></td> 
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Target</font></td>
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Realisasi</font></td> 
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Rasio</font></td> 
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Target</font></td>
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Realisasi</font></td> 
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Rasio</font></td> 
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Target</font></td>
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Realisasi</font></td> 
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Rasio</font></td> 
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Target</font></td>
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Realisasi</font></td> 
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Rasio</font></td> 
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Target</font></td>
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Realisasi</font></td> 
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Rasio</font></td> 
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Target</font></td>
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Realisasi</font></td> 
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Rasio</font></td>
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Target</font></td>
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Realisasi</font></td> 
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Rasio</font></td>
 </tr>
<?
	$sqa = "select substr(k.kdkantor,1,1) as kdkantor ".
			"from $DBUser.tabel_001_kantor k ".
			"group by substr(k.kdkantor,1,1) ".
			"order by substr(k.kdkantor,1,1)";
	$DB->parse($sqa);
	$DB->execute();					 
	$j=1;
	$i=1;
	while ($arr=$DB->nextrow()) {

		$sqx = "select k.kdkantor, k.namakantor ".
				"from $DBUser.tabel_001_kantor k ".
				"where kdkantor like '".$arr["KDKANTOR"]."%' ".
				"order by k.kdkantor";
		$DBB->parse($sqx);
		$DBB->execute();					 
		while ($arx=$DBB->nextrow()) {	
?>
<!--
			<tr>
				<td bgcolor="#ccffcc" align="right"><?=$j;?> </td>
				<td bgcolor="#ccffcc" align="left" nowrap colspan="28">SE-<?=$arx["NAMAKANTOR"];?></td>
			</tr>		
-->
<?

			if ($i%2){
				$bgcolor="#ccffff";
			}
			else{
				$bgcolor="#0099ff";
			}

			$kdktr=$arx["KDKANTOR"];
			
?>
		<tr>
		<td bgcolor=<?=$bgcolor;?> align="right"><?=substr('0'.$i,-2);?>.</td>
		<td bgcolor=<?=$bgcolor;?> align="left" nowrap><?=$arx["KDKANTOR"]." - ".$arx["NAMAKANTOR"];?></td>

<?
		// PP NB
			$kdrekening="'700512','704202','704502','718202','718212','718313','718512','718513','718613','719202','305112','305211','305212','305222','305312','305322','305512','305522','305612','305712','307030','307213','307312','307313','307512','307513','307612','307632','307642','307712','307812','308101','308201','308202','308301','308302','308303','308501','308502','308601','308701','315302','315502','317302','317303','318102','930004'";
			echo nilaiRekening('NBPP',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
		// PP OB
			$kdrekening="'700211','700221','700331','700521','704201','704501','305221','305311','305321','305411','305511','305521','305611','315201','315301','315501','930003'";
			echo nilaiRekening('OBPP',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
		// PK NB
			$kdrekening="'710112','710122','710123','710212','710223','710512','710612','710723','710823','713012','713212','714202','714302','714502','720212','723112','723212','723214','723512','723514','724513','727113','727114','727115','727116','727512','729113','330112','330123','332212','333512','334030','334032','334112','334114','334115','334116','334615','334712','334715','337012','337112','337222','338602','330223','330312','330323','330612','330623','330712','330723'";
			echo nilaiRekening('NBPK',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
		// PK OB
			$kdrekening="'710211','710511','710521','710611','714201','720211','723211','723411','723511','330111','330211','330311','330611','332211','332213','333112','333211','333511','338601','930005'";
			echo nilaiRekening('OBPK',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);	
		// BIAYA INVESTASI
			$kdrekening="'800000','800001','840001','850001','850002','850004','850402','851000','851001','852001','853001','864000','880000','891000','899000'";
			echo nilaiRekening('INVESTASI',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
		// BIAYA INKASO
			$kdrekening="'550000','550002','550004','551000','551001','552000','553000','553001','553003','554000','554001','555000','555001','556000','557000','557001','558000','558001','558002','558003','558004','558005','559001','882000','559000','550001'";
			echo nilaiRekening('INKASO',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
		// BIAYA PEMASARAN
			$kdrekening="'500000','500001','500002','500003','500004','500005','500006','500007','500008','500009','500010','500011','500015','500020','500021','500100','500101','500202','500300','501000','501001','501002','501003','501004','501005','502000','502002','503001','503002','504000','507000','509004','510000','511000','512000','512001','513000','514000','516000','517000','518000','520000','525000','525001','526000','527000','528000','529000','540000','543000','544000','545000','525002','549000','500016'";
			echo nilaiRekening('PEMASARAN',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
		// BIAYA OVERHEAD
			$kdrekening="'566000','567000','568000','569000','570000','574000','575000','579000','581000','589000','600000','601000','602000','603000','604000','606000','607000','608000','609000','610000','611000','612000','613000','620000','620001','621000','622000','630000','632000','645000','648000','649000','660000','670000','670001','671000','673000','673001','674000','675000','676000','941000','942000',
'943000','944000','945000','946000','948000','949001','560000','561000','562000','563000','565000','571000','572000','573000','576000','578000','580000','582000','583000','583001','584000','585000','629000','631000','640000','641000','642000','643000','644000',
'672000','674001','677000','679000','679001','882002','949009'";
			echo nilaiRekening('OVERHEAD',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
		  // BIAYA KLAIM PP
			$kdrekening="'752101','752102','752201','752301','752501','762200','762300','752202','752302','752601','753301','753501','762100','763500','769300','769800','771013'";
			echo nilaiRekening('KLAIMPP',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
		 // BIAYA KLAIM PK
			$kdrekening="'768000','768001','768005','768006','771100','771200','771231','771300','771600','771603','771701','771702','771703','771802','771803','772800','776200','777200','780100','780200','780500','781200','781500','782200','782500','787000','788101','788201','788206','788701','788801','789000','771103','771201','771700','772600','782100','786500','930022'";
			echo nilaiRekening('KLAIMPK',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
		  // BIAYA EKSPIRASI PP
			$kdrekening="'750301','750501','750502','751201','751202','761200','761300','751301','751302','751501','751601','758301','758302','758501','758502','759300','759500','760300','760500','761500','930023','751606','751700','761400','761600','761700'";
			echo nilaiRekening('EKSPIRASIPP',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
		  // BIAYA EKSPIRASI PK
			$kdrekening="'770200','770201','770500','770600','775200','785200','770300','781100','785100','785500','788102','788202','788207','788602','788702','788802'";
			echo nilaiRekening('EKSPIRASIPK',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
		// BIAYA PENEBUSAN PP
			$kdrekening="'755201','755301','755302','765200','765300','755000','755202','755501','755502','755601','755606','757201','757501','765500','930025'";
			echo nilaiRekening('PENEBUSANPP',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
		// BIAYA PENEBUSAN PK
			$kdrekening="'774200','774300','774500','779200','783100','783200','783500','774600'";
			echo nilaiRekening('PENEBUSANPK',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
			$i++;		
		}		
?>
		</tr>
<!--
		<tr>
			<td bgcolor="#ccffcc" align="right"></td>
			<td bgcolor="#ccffcc" align="right" nowrap>SUB-TOTAL</td>
-->
<?

?>
<!--
		</tr>		
-->
<?
		$j++;
	}
	
	$bgcolor="#ccffcc";
?>
	<tr>
		<td bgcolor=<?=$bgcolor;?> align="left" nowrap colspan="2">GRAND TOTAL</td>
<?

// Grand Total
	 	$kdktr="";
	// PP NB
		$kdrekening="'700512','704202','704502','718202','718212','718313','718512','718513','718613','719202','305112','305211','305212','305222','305312','305322','305512','305522','305612','305712','307030','307213','307312','307313','307512','307513','307612','307632','307642','307712','307812','308101','308201','308202','308301','308302','308303','308501','308502','308601','308701','315302','315502','317302','317303','318102','930004'";
		echo nilaiRekening('NBPP',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
	// PP OB
		$kdrekening="'700211','700221','700331','700521','704201','704501','305221','305311','305321','305411','305511','305521','305611','315201','315301','315501','930003'";
		echo nilaiRekening('OBPP',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
	// PK NB
		$kdrekening="'710112','710122','710123','710212','710223','710512','710612','710723','710823','713012','713212','714202','714302','714502','720212','723112','723212','723214','723512','723514','724513','727113','727114','727115','727116','727512','729113','330112','330123','332212','333512','334030','334032','334112','334114','334115','334116','334615','334712','334715','337012','337112','337222','338602','330223','330312','330323','330612','330623','330712','330723'";
		echo nilaiRekening('NBPK',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
	// PK OB
		$kdrekening="'710211','710511','710521','710611','714201','720211','723211','723411','723511','330111','330211','330311','330611','332211','332213','333112','333211','333511','338601','930005'";
		echo nilaiRekening('OBPK',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
	// BIAYA INVESTASI
		$kdrekening="'800000','800001','840001','850001','850002','850004','850402','851000','851001','852001','853001','864000','880000','891000','899000'";
		echo nilaiRekening('INVESTASI',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
	// BIAYA INKASO
		$kdrekening="'550000','550002','550004','551000','551001','552000','553000','553001','553003','554000','554001','555000','555001','556000','557000','557001','558000','558001','558002','558003','558004','558005','559001','882000','559000','550001'";
		echo nilaiRekening('INKASO',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
	// BIAYA PEMASARAN
		$kdrekening="'500000','500001','500002','500003','500004','500005','500006','500007','500008','500009','500010','500011','500015','500020','500021','500100','500101','500202','500300','501000','501001','501002','501003','501004','501005','502000','502002','503001','503002','504000','507000','509004','510000','511000','512000','512001','513000','514000','516000','517000','518000','520000','525000','525001','526000','527000','528000','529000','540000','543000','544000','545000','525002','549000','500016'";
		echo nilaiRekening('PEMASARAN',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
	// BIAYA OVERHEAD
		$kdrekening="'566000','567000','568000','569000','570000','574000','575000','579000','581000','589000','600000','601000','602000','603000','604000','606000','607000','608000','609000','610000','611000','612000','613000','620000','620001','621000','622000','630000','632000','645000','648000','649000','660000','670000','670001','671000','673000','673001','674000','675000','676000','941000','942000','943000','944000','945000','946000','948000','949001','560000','561000','562000','563000','565000','571000','572000','573000','576000','578000','580000','582000','583000','583001','584000','585000','629000','631000','640000','641000','642000','643000','644000','672000','674001','677000','679000','679001','882002','949009'";
		echo nilaiRekening('OVERHEAD',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
	  // BIAYA KLAIM PP
		$kdrekening="'752101','752102','752201','752301','752501','762200','762300','752202','752302','752601','753301','753501','762100','763500','769300','769800','771013'";
		echo nilaiRekening('KLAIMPP',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);	  
	  // BIAYA KLAIM PK
		$kdrekening="'768000','768001','768005','768006','771100','771200','771231','771300','771600','771603','771701','771702','771703','771802','771803','772800','776200','777200','780100','780200','780500','781200','781500','782200','782500','787000','788101','788201','788206','788701','788801','789000','771103','771201','771700','772600','782100','786500','930022'";
		echo nilaiRekening('KLAIMPK',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
		  // BIAYA EKSPIRASI PP
			$kdrekening="'750301','750501','750502','751201','751202','761200','761300','751301','751302','751501','751601','758301','758302','758501','758502','759300','759500','760300','760500','761500','930023','751606','751700','761400','761600','761700'";
			echo nilaiRekening('EKSPIRASIPP',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
		  // BIAYA EKSPIRASI PK
			$kdrekening="'770200','770201','770500','770600','775200','785200','770300','781100','785100','785500','788102','788202','788207','788602','788702','788802'";
			echo nilaiRekening('EKSPIRASIPK',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
		 // BIAYA PENEBUSAN PP
		$kdrekening="'755201','755301','755302','765200','765300','755000','755202','755501','755502','755601','755606','757201','757501','765500','930025'";
		echo nilaiRekening('PENEBUSANPP',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
	// BIAYA PENEBUSAN PK
		$kdrekening="'774200','774300','774500','779200','783100','783200','783500','774600'";
		echo nilaiRekening('PENEBUSANPK',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
?>
	</tr>		
</table>
<br />
<?
}
?>
<a href="index.php"><font face="Verdana" size="2">Menu Pelaporan</font></a>&nbsp;&nbsp;&nbsp;&nbsp;
<? 
  include "../../includes/endtimer.php"; 
?>