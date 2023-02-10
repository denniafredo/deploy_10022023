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
    			 "where ".$wherekantor."substr(notrans,0,1) in ('B','K') and kdtrans>='".$tglDariCari."' and kdtrans<='".$tglSampaiCari."' and ".
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
//				print ("<option value=0>---</option>");
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
//				print ("<option value=0>------</option>");
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
				//print ("<option value=ALL>*</option>");
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
  <td bgcolor="#3366CC" align="center" colspan="36"><font color="#FFFFFF">Biaya</font></td>
 </tr>
 <tr>
  <td bgcolor="#3366CC" align="center" colspan="3"><font color="#FFFFFF">NB</font></td>
  <td bgcolor="#3366CC" align="center" colspan="3"><font color="#FFFFFF">OB</font></td> 
  <td bgcolor="#3366CC" align="center" colspan="3"><font color="#FFFFFF">NB</font></td>
  <td bgcolor="#3366CC" align="center" colspan="3"><font color="#FFFFFF">OB</font></td> 
  <td bgcolor="#3366CC" align="center" colspan="3"><font color="#FFFFFF">Penutupan</font></td>
  <td bgcolor="#3366CC" align="center" colspan="3"><font color="#FFFFFF">Gaji dan<br>Kesejahteraan Agen</font></td>
  <td bgcolor="#3366CC" align="center" colspan="3"><font color="#FFFFFF">Pembinaan/Pendidikan<br>Agen</font></td>
  <td bgcolor="#3366CC" align="center" colspan="3"><font color="#FFFFFF">Promosi dan<br>Lainnya</font></td>
  <td bgcolor="#3366CC" align="center" colspan="3"><font color="#FFFFFF">Inkaso</font></td> 
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
//  	$i=1;		
		while ($arx=$DBB->nextrow()) {	

//			if ($i==1){
?>
<!--
			<tr>
				<td bgcolor="#ccffcc" align="right"><?=$j;?></td>
				<td bgcolor="#ccffcc" align="left" nowrap colspan="28">SE-<?=$arx["NAMAKANTOR"];?></td>
			</tr>		
-->
<?
//			}

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
			$kdrekening="'305112','305122','305135','305313','305314','308002','315602','305212','305222','305312','305322','305412','305422','305512','305522','305612','305622','305712','305722','305812','305822','308101','308102','308103','308201','308202','308203','308301','308302','308303','308401','308402','308403','308501','308502','308503','308601','308602','308603','308701','308702','308703','308801','308802','308803','315102','315202','315302','315402','315502','315602','315702','315802','703112','703122','703212','703222','703312','703322','703412','703422','703512','703522','703612','703622','703712','703722','703812','703822','707102','707202','707302','707402','707502','707602','707702','707802','930004','308001','308305','305502','315502','305814',".
							"'307112','307113','307122','307212','307213','307222','307312','307313','307322','307412','307413','307422','307512','307513','307522','307523','307612','307613','307622','307712','307713','307722','307812','307813','307822','317102','317103','317202','317203','317302','317303','317402','317403','317502','317503','317602','317603','317702','317703','317802','317803','307642','307632','930004'";
			echo nilaiRekening('NBPP',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);

		// PP OB
			$kdrekening="'305111','305121','305211','305221','305311','305321','305411','305421','305511','305521','305611','305621','305711','305721','305811','305821','315101','315201','315301','315401','315501','315601','315701','315801','702100','702200','702300','702400','702500','702600','702700','702800','703111','703121','703211','703221','703311','703321','703411','703421','703511','703521','703611','703621','703711','703721','703811','703821','706100','706200','706300','706400','706500','706600','706700','706800','707101','707201','707301','707401','707501','707601','707701','707801','930003'";
			echo nilaiRekening('OBPP',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);

		// PK NB
			$kdrekening="'334115','334116','334215','334216','334315','334316','334415','334416','334515','334516','334615','334616','334715','334716','334815','334816','334105','334106','334205','334206','334305','334306','334405','334406','334505','334506','334605','334606','334705','334706','334805','334806','330123','330223','330323','330423','330523','330623','330723','330823','331103','331203','331303','331403','331503','331603','331703','331803','336114','336115','336214','336215','336314','336315','336414','336415','336514','336515','336614','336615','336714','336715','336814','336815','336104','336105','336204','336205','336304','336305','336404','336405','336504','336505','336604','336605','336704','336704','336804','336805','333113','333213','333313','333413','333513','333613','333713','333813','333103','333203','333303','333403','333503','333603','333703','333803','930006',".
							"'330112','330122','330212','330222','330312','330322','330412','330422','330512','330522','330612','330622','330712','330722','330812','330822','331002','331102','331202','331302','331402','331502','331602','331702','331802','338000','338002','338100','338102','338200','338202','338300','338302','338400','338402',".
							"'338500','338502','338600','338602','338700','338702','338800','338802','339002','339102','339202','339302','339402','339502','339602','339702','339802','717102','717112','717122','717202','717212','717222','717302','717312','717322','717402','717412','717422','717502','717512','717522','717602','717612','717622','717702','717712','717722','717802','717812','717822','332012','332212','722212','333012','333112','333212','333412','333512','725112','725212','725512','305135','337012','337013','337222','334002','334003','334012','334013','334030','334031','334032','334033','334102','334103','334112','334113','334114','334202','334203','334212','334213','334302','334303','334312','334313','334402','334403','334412','334413','334502','334503','334512','334513','334602','334603','334612','334613','334702','334703','334712','334713','334802','334803','334812','334813','337112','335000','335100','336012','336013','336112','336113','336212','336213','336412','336413','336512','336513','330013','930006'";
			echo nilaiRekening('NBPK',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);

		// PK OB
			$kdrekening="'930005','330031','330111','330121','330211','330221','330311','330321','330411','330421','330511','330521','330611','330621','330711','330721','330811','330821','331001','331101','331201','331301','331401','331501','331601','331701','331801','338001','338101','338201','338301','338401','338501','338601','338701','338801','339001','339101','339201','339301','339401','339501','339601','339701','339801','716100','716200','716300','716400','716500','716600','716700','716800','717101','717111','717121','717201','717211','717221','717301','717311','717321','717401','717411','717421','717501','717511','717521','717601','717611','717621','717701','717711','717721','717801','717811','717821','332011','332013','332211','332213','722211','722213','333011','333111','333211','333411','333511','725111','725211','725511','337011','732000'";
			echo nilaiRekening('OBPK',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);

		// BIAYA PEMASARAN
//			$kdrekening="'509000','509004','510000','511000','512000','512001','513000','514000','515000','516000','517000','518000','519000','520000','525000','525001','525002','526000','527000','528000','529000','528001','508000','508001','519000','540000','541000','543000','544000','545000','549000','500000','500001','500002','500003','500004','500005','500006','500007','500008','500009','500010','500011','500020','500021','501000','501001','501002','501003','501004','501005','501006','500100','500101','500131','500200','500111','500121','500211','500300','502000','502001','502002','503000','503001','503002','504000','505000','507000','507001','507002'";
//			echo nilaiRekening('PEMASARAN',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);

		// BIAYA PENUTUPAN
			$kdrekening="'500000','500001','500002','500003','500004','500005','500006','500007','500008','500009','500010','500011','500015','500020','500021','501000','501001','501002','501003','501004','501005','501006','500100','500101','500131','500200','500111','500121','500211','500212','500300','502000','502001','502002','503000','503001','503002','504000','505000','507000','507001','507002','508000','508001'";
			echo nilaiRekening('PENUTUPAN',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);

		// BIAYA GAJI DAN KESEJAHTERAAN AGEN
			$kdrekening="'509000','509001','509003','509004','510000','511000','512000','512001','513000','514000','515000','516000','517000','518000','519000','520000'";
			echo nilaiRekening('GAJI',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);

		// BIAYA PEMBINAAN/PENDIDIKAN AGEN
			$kdrekening="'525000','525001','525002','526000','527000','528000','528001','529000'";
			echo nilaiRekening('PEMBINAAN',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);

		// BIAYA PROMOSI DAN LAINNYA
			$kdrekening="'540000','541000','542000','543000','544000','545000','549000'";
			echo nilaiRekening('PROMOSI',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
			
		// BIAYA INKASO
			$kdrekening="'550000','550001','550002','550003','550004','551000','551001','552000','553000','553001','553002','553003','554000','554001','555000','555001','556000','557000','557001','558000','558001','558002','559000','550400','550005','550304','550401','550402'";
			echo nilaiRekening('INKASO',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);

		// BIAYA OVERHEAD
			$kdrekening="'560000','561000','562000','563000','566000','567000','568000','569000','570000','565000','571000','572000','573000','574000','575000','576000','577000','578000','579000','580000','581000','582000','583000','584000','585000','589000','600000','601000','602000','603000','604000','605000','606000','607000','608000','609000','610000','611000','612000','612001','613000','620000','621000','622000','629000','630000','631000','632000','633000','640000','641000','642000','643000','644000','645000','647000','648000','649000','650000','650001','660000','670000','670001','671000','672000','673000','673001','674000','674001','675000','676000','677000','679000','679001','941000','942000','943000','944000','945000','946000','947000','948000'";
			echo nilaiRekening('OVERHEAD',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);

		  // BIAYA KLAIM PP
			$kdrekening="'752101','752000','752102','752105','752201','752202','752205','752301','752302','752305','752401','752402','752405','752501','752502','752505','752601','752602','752605','752651','752701','752702','752705','752706','753102','753301','753501','754105','754106','754205','754206','754305','754306','754405','754406','754505','754506','754605','754606','754705','754706','754805','754806','762100','762200','762300','762400','762500','762600','762700','763300','763500','764100','764200','764300','764400','764500','764600','768000','768001','768002','768003','768004','768005','768006','769100','769200','769300','769400','769500','769600','769700','769800','771011','771012','771013','771031','930021'";
			echo nilaiRekening('KLAIMPP',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
		  
		  // BIAYA KLAIM PK
			$kdrekening="'771100','771101','771102','771103','771200','771201','771202','771203','771231','771300','771301','771302','771303','771400','771401','771402','771403','771500','771501','771502','771503','771600','771601','771602','771603','771700','771701','771702','771703','771800','771801','771802','771803','772100','772101','772102','772103','772200','772201','772202','772203','772300','772301','772302','772303','772401','772402','772403','772500','772501','772502','772503','772600','772601','772602','772603','772700','772701','772702','772703','772800','772801','772802','772803','773000','773001','773002','773003','773004','776200','777200','778200','780100','780200','780500','782100','782200','782500','786100','786200','786500','787000','788100','788101','788104','788114','788200','788201','788204','788206','788209','788406','788600','788601','788604','788700','788701','788704','788800','788801','788804','789102','930022'";
			echo nilaiRekening('KLAIMPK',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
		
		  // BIAYA EKSPIRASI PP
			$kdrekening="'750301','750302','750501','750502','751102','751201','751202','751301','751302','751401','751402','751501','751502','751601','751602','756201','756501','758301','758302','758501','758502','759300','759500','760300','760500','761200','761300','761400','761500','761600','930023'";
			echo nilaiRekening('EKSPIRASIPP',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
		  
		  // BIAYA EKSPIRASI PK
			$kdrekening="'770200','770201','770300','770500','770600','773300','773500','775200','781100','781200','781500','784100','784200','784300','784400','784500','784600','784700','784800','785100','785200','785500','788102','788202','788207','788602','788702','788802','789000','930024'";
			echo nilaiRekening('EKSPIRASIPK',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
		
		// BIAYA PENEBUSAN PP
			$kdrekening="'755201','755202','755301','755302','755501','755502','755601','765200','765300','765500','755201','755000','755102','755103','755401','755402','755602','757201','757202','757301','757302','757401','757402','757501','757502','757601','757602','765400','765600','767200','767300','767400','767500','767600','930026','930025'";
			echo nilaiRekening('PENEBUSANPP',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);

		// BIAYA PENEBUSAN PK
			$kdrekening="'774200','774400','774600','779200','783500','774201','774300','788703','788803','774001','774500','783100','783200','788103','788203','788208','788603','788703','788803','930026','930025'";
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
//		$kdktr=$arr["KDKANTOR"];

// Sub Total
//		echo nilaiRekening('NBPP',$DBA,$kdktr,$dthn,"(".$kdrekeningnbpp.")",$tglDariCari,$tglSampaiCari);
//		echo nilaiRekening('OBPP',$DBA,$kdktr,$dthn,"(".$kdrekeningobpp.")",$tglDariCari,$tglSampaiCari);
//		echo nilaiRekening('NBOBPP',$DBA,$kdktr,$dthn,"(".$kdrekeningnbobpp.")",$tglDariCari,$tglSampaiCari);
//		echo nilaiRekening('NBPK',$DBA,$kdktr,$dthn,"(".$kdrekeningnbpk.")",$tglDariCari,$tglSampaiCari);
//		echo nilaiRekening('OBPK',$DBA,$kdktr,$dthn,"(".$kdrekeningobpk.")",$tglDariCari,$tglSampaiCari);
//		echo nilaiRekening('NBOBPK',$DBA,$kdktr,$dthn,"(".$kdrekeningnbobpk.")",$tglDariCari,$tglSampaiCari);
//		echo nilaiRekening('NBPPPK',$DBA,$kdktr,$dthn,"(".$kdrekeningnbpppk.")",$tglDariCari,$tglSampaiCari);
//		echo nilaiRekening('OBPPPK',$DBA,$kdktr,$dthn,"(".$kdrekeningobpppk.")",$tglDariCari,$tglSampaiCari);
//		echo nilaiRekening('NBOBPPPK',$DBA,$kdktr,$dthn,"(".$kdrekeningnbobpppk.")",$tglDariCari,$tglSampaiCari);

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
//		$kdrekening="'305112','305122','305135','305313','305314','308002','315602','305212','305222','305312','305322','305412','305422','305512','305522','305612','305622','305712','305722','305812','305822','308101','308102','308103','308201','308202','308203','308301','308302','308303','308401','308402','308403','308501','308502','308503','308601','308602','308603','308701','308702','308703','308801','308802','308803','315102','315202','315302','315402','315502','315602','315702','315802','703112','703122','703212','703222','703312','703322','703412','703422','703512','703522','703612','703622','703712','703722','703812','703822','707102','707202','707302','707402','707502','707602','707702','707802','930004','308001','308305','305502','315502','305814',".
//						"'307112','307113','307122','307212','307213','307222','307312','307313','307322','307412','307413','307422','307512','307513','307522','307523','307612','307613','307622','307712','307713','307722','307812','307813','307822','317102','317103','317202','317203','317302','317303','317402','317403','317502','317503','317602','317603','317702','317703','317802','317803','307642','307632','930004'";
		$kdrekening="'700512','704202','704502','718202','718212','718313','718512','718513','718613','719202','723511'";
		echo nilaiRekening('NBPP',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);

	// PP OB
//		$kdrekening="'305111','305121','305211','305221','305311','305321','305411','305421','305511','305521','305611','305621','305711','305721','305811','305821','315101','315201','315301','315401','315501','315601','315701','315801','702100','702200','702300','702400','702500','702600','702700','702800','703111','703121','703211','703221','703311','703321','703411','703421','703511','703521','703611','703621','703711','703721','703811','703821','706100','706200','706300','706400','706500','706600','706700','706800','707101','707201','707301','707401','707501','707601','707701','707801','930003'";
		$kdrekening="'700211','700221','700331','700521','704201','704501'";
		echo nilaiRekening('OBPP',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);

	// PK NB
//		$kdrekening="'334115','334116','334215','334216','334315','334316','334415','334416','334515','334516','334615','334616','334715','334716','334815','334816','334105','334106','334205','334206','334305','334306','334405','334406','334505','334506','334605','334606','334705','334706','334805','334806','330123','330223','330323','330423','330523','330623','330723','330823','331103','331203','331303','331403','331503','331603','331703','331803','336114','336115','336214','336215','336314','336315','336414','336415','336514','336515','336614','336615','336714','336715','336814','336815','336104','336105','336204','336205','336304','336305','336404','336405','336504','336505','336604','336605','336704','336704','336804','336805','333113','333213','333313','333413','333513','333613','333713','333813','333103','333203','333303','333403','333503','333603','333703','333803','930006',".
//						"'330112','330122','330212','330222','330312','330322','330412','330422','330512','330522','330612','330622','330712','330722','330812','330822','331002','331102','331202','331302','331402','331502','331602','331702','331802','338000','338002','338100','338102','338200','338202','338300','338302','338400','338402',".
//						"'338500','338502','338600','338602','338700','338702','338800','338802','339002','339102','339202','339302','339402','339502','339602','339702','339802','717102','717112','717122','717202','717212','717222','717302','717312','717322','717402','717412','717422','717502','717512','717522','717602','717612','717622','717702','717712','717722','717802','717812','717822','332012','332212','722212','333012','333112','333212','333412','333512','725112','725212','725512','305135','337012','337013','337222','334002','334003','334012','334013','334030','334031','334032','334033','334102','334103','334112','334113','334114','334202','334203','334212','334213','334302','334303','334312','334313','334402','334403','334412','334413','334502','334503','334512','334513','334602','334603','334612','334613','334702','334703','334712','334713','334802','334803','334812','334813','337112','335000','335100','336012','336013','336112','336113','336212','336213','336412','336413','336512','336513','330013','930006'";
		$kdrekening="'710112','710122','710123','710212','710223','710512','710612','710723','710823','713012','713212','714202','714302','714502','720212','723112','723212','723214','723512','723514','724513','727113','727114','727115','727116','727512','729113'";
		echo nilaiRekening('NBPK',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);

	// PK OB
//		$kdrekening="'930005','330031','330111','330121','330211','330221','330311','330321','330411','330421','330511','330521','330611','330621','330711','330721','330811','330821','331001','331101','331201','331301','331401','331501','331601','331701','331801','338001','338101','338201','338301','338401','338501','338601','338701','338801','339001','339101','339201','339301','339401','339501','339601','339701','339801','716100','716200','716300','716400','716500','716600','716700','716800','717101','717111','717121','717201','717211','717221','717301','717311','717321','717401','717411','717421','717501','717511','717521','717601','717611','717621','717701','717711','717721','717801','717811','717821','332011','332013','332211','332213','722211','722213','333011','333111','333211','333411','333511','725111','725211','725511','337011','732000'";
		$kdrekening="'710211','710511','710521','710611','714201','720211','723211','723411','723511'";
		echo nilaiRekening('OBPK',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);

	// BIAYA PEMASARAN
//			$kdrekening="'509000','509004','510000','511000','512000','512001','513000','514000','515000','516000','517000','518000','519000','520000','525000','525001','525002','526000','527000','528000','529000','528001','508000','508001','519000','540000','541000','543000','544000','545000','549000','500000','500001','500002','500003','500004','500005','500006','500007','500008','500009','500010','500011','500020','500021','501000','501001','501002','501003','501004','501005','501006','500100','500101','500131','500200','500111','500121','500211','500300','502000','502001','502002','503000','503001','503002','504000','505000','507000','507001','507002'";
//			$kdrekening="'500000','500001','500002','500003','500004','500005','500006','500007','500008','500009','500010','500011','500015','500020','500021','500100','500101','500202','500300','501000','501001','501002','501003','501004','501005','502000','502002','503001','503002','504000','507000','509004','510000','511000','512000','512001','513000','514000','516000','517000','518000','520000','525000','525001','526000','527000','528000','529000','540000','543000','544000','545000'";
//			echo nilaiRekening('PEMASARAN',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);

	// BIAYA PENUTUPAN
		$kdrekening="'500000','500001','500002','500003','500004','500005','500006','500007','500008','500009','500010','500011','500015','500020','500021','501000','501001','501002','501003','501004','501005','501006','500100','500101','500131','500200','500111','500121','500211','500212','500300','502000','502001','502002','503000','503001','503002','504000','505000','507000','507001','507002','508000','508001'";
		echo nilaiRekening('PENUTUPAN',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);

	// BIAYA GAJI DAN KESEJAHTERAAN AGEN
		$kdrekening="'509000','509001','509003','509004','510000','511000','512000','512001','513000','514000','515000','516000','517000','518000','519000','520000'";
		echo nilaiRekening('GAJI',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);

	// BIAYA PEMBINAAN/PENDIDIKAN AGEN
		$kdrekening="'525000','525001','525002','526000','527000','528000','528001','529000'";
		echo nilaiRekening('PEMBINAAN',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);

	// BIAYA PROMOSI DAN LAINNYA
		$kdrekening="'540000','541000','542000','543000','544000','545000','549000'";
		echo nilaiRekening('PROMOSI',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
		
	// BIAYA INKASO
//		$kdrekening="'550000','550001','550002','550003','550004','551000','551001','552000','553000','553001','553002','553003','554000','554001','555000','555001','556000','557000','557001','558000','558001','558002','559000','550400','550005','550304','550401','550402'";
		$kdrekening="'550000','550002','550004','551000','551001','552000','553000','553001','553003','554000','554001','555000','555001','556000','557000','557001','558000','558001','558002','558003','558004','558005','559001','840001','882000','891000','559000'";
		echo nilaiRekening('INKASO',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);

	// BIAYA OVERHEAD
//		$kdrekening="'560000','561000','562000','563000','566000','567000','568000','569000','570000','565000','571000','572000','573000','574000','575000','576000','577000','578000','579000','580000','581000','582000','583000','584000','585000','589000','600000','601000','602000','603000','604000','605000','606000','607000','608000','609000','610000','611000','612000','612001','613000','620000','621000','622000','629000','630000','631000','632000','633000','640000','641000','642000','643000','644000','645000','647000','648000','649000','650000','650001','660000','670000','670001','671000','672000','673000','673001','674000','674001','675000','676000','677000','679000','679001','941000','942000','943000','944000','945000','946000','947000','948000'";
		$kdrekening="'566000','567000','568000','569000','570000','574000','575000','579000','581000','589000','600000','601000','602000','603000','604000','606000','607000','608000','609000','610000','611000','612000','613000','620000','620001','621000','622000','630000','632000','645000','648000','649000','660000','670000','670001','671000','673000','673001','674000','675000','676000','941000','942000','943000','944000','945000','946000','948000','949001','560000','561000','562000','563000','565000','571000','572000','573000','576000','578000', '580000', '582000','583000','583001','584000','585000','629000','631000','640000','641000','642000','643000','644000','672000','674001','677000','679000','679001'";
		echo nilaiRekening('OVERHEAD',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);

	  // BIAYA KLAIM PP
//		$kdrekening="'752101','752000','752102','752105','752201','752202','752205','752301','752302','752305','752401','752402','752405','752501','752502','752505','752601','752602','752605','752651','752701','752702','752705','752706','753102','753301','753501','754105','754106','754205','754206','754305','754306','754405','754406','754505','754506','754605','754606','754705','754706','754805','754806','762100','762200','762300','762400','762500','762600','762700','763300','763500','764100','764200','764300','764400','764500','764600','768000','768001','768002','768003','768004','768005','768006','769100','769200','769300','769400','769500','769600','769700','769800','771011','771012','771013','771031','930021'";
		$kdrekening="'752101','752102','752201','752301','752501','762200','762300'";
		echo nilaiRekening('KLAIMPP',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
	  
	  // BIAYA KLAIM PK
//		$kdrekening="'771100','771101','771102','771103','771200','771201','771202','771203','771231','771300','771301','771302','771303','771400','771401','771402','771403','771500','771501','771502','771503','771600','771601','771602','771603','771700','771701','771702','771703','771800','771801','771802','771803','772100','772101','772102','772103','772200','772201','772202','772203','772300','772301','772302','772303','772401','772402','772403','772500','772501','772502','772503','772600','772601','772602','772603','772700','772701','772702','772703','772800','772801','772802','772803','773000','773001','773002','773003','773004','776200','777200','778200','780100','780200','780500','782100','782200','782500','786100','786200','786500','787000','788100','788101','788104','788114','788200','788201','788204','788206','788209','788406','788600','788601','788604','788700','788701','788704','788800','788801','788804','789102','930022'";
		$kdrekening="'768000','768001','768005','768006','771100','771200','771231','771300','771600','771603','771701','771702','771703','771802','771803','772800','776200','777200','780100','780200','780500','781200','781500','782200','782500','787000','788101','788201','788206','788701','788801','789000'";
		echo nilaiRekening('KLAIMPK',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
	
	  // BIAYA EKSPIRASI PP
//		$kdrekening="'750301','750302','750501','750502','751102','751201','751202','751301','751302','751401','751402','751501','751502','751601','751602','756201','756501','758301','758302','758501','758502','759300','759500','760300','760500','761200','761300','761400','761500','761600','930023'";
		$kdrekening="'750501','751201','751202','761200','761300'";
		echo nilaiRekening('EKSPIRASIPP',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
	  
	  // BIAYA EKSPIRASI PK
//		$kdrekening="'770200','770201','770300','770500','770600','773300','773500','775200','781100','781200','781500','784100','784200','784300','784400','784500','784600','784700','784800','785100','785200','785500','788102','788202','788207','788602','788702','788802','789000','930024'";
		$kdrekening="'770200','770201','770500','770600','775200','781500','782200','785200'";
		echo nilaiRekening('EKSPIRASIPK',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);
	
	// BIAYA PENEBUSAN PP
//		$kdrekening="'755201','755202','755301','755302','755501','755502','755601','765200','765300','765500','755201','755000','755102','755103','755401','755402','755602','757201','757202','757301','757302','757401','757402','757501','757502','757601','757602','765400','765600','767200','767300','767400','767500','767600','930026','930025'";
		$kdrekening="'755201','755301','755302','765200','765300'";
		echo nilaiRekening('PENEBUSANPP',$bgcolor,$DBA,$kdktr,$dthn,"(".$kdrekening.")",$tglDariCari,$tglSampaiCari);

	// BIAYA PENEBUSAN PK
//		$kdrekening="'774200','774400','774600','779200','783500','774201','774300','788703','788803','774001','774500','783100','783200','788103','788203','788208','788603','788703','788803','930026','930025'";
		$kdrekening="'774200','774300','774500','779200','783100','783200','783500'";
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