<?  
	include "../../includes/session.php"; 
	include "../../includes/starttimer.php"; 
	include "../../includes/database.php"; 
	include "../../includes/common.php";
	include "../../includes/fungsi.php";
	include "../../includes/oradb.class.php";
//	include "../../includes/cDatabase.php";
	
	$DBA = new Database($suid_GLLINK,$spass_GLLINK,$sdb_GLLINK);
	$DB = new Database($userid, $passwd, $DBName);
	$DBZ = new Database($userid, $passwd, $DBName);
	$DBX = new Database($userid, $passwd, $DBName);
//	$DBUL=New database($userid, $passwd, $DBName);
	
	
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
echo "<a class=verdana10blu><b>LAPORAN ARUS KAS</b></a>";
echo "<hr size=1>";

#---------------------------------------------- start navigasi -----------------
function resetCounter()
{
	GLOBAL $angbudgetAwal,$angbudget;
	GLOBAL $jmlrealisasi1,$jmlrealisasi2,$jmlrealisasi3;

	$angbudgetAwal=0;
	$angbudget=0;
	$jmlrealisasi1=0;
	$jmlrealisasi2=0;
	$jmlrealisasi3=0;
}

function countSubTotal($judul)
{
	GLOBAL $angbudgetAwal,$angbudget;
	GLOBAL $jmlrealisasi1,$jmlrealisasi2,$jmlrealisasi3;

// Tampilan
	$rtnValue="<tr bgcolor='#00FF33'><td></td><td><b>".$judul."</b></td>";
	$rtnValue=$rtnValue."<td align=\"right\">".number_format($angbudgetAwal,2,",",".")."</td>";
	$rtnValue=$rtnValue."<td align=\"right\">".number_format($angbudget,2,",",".")."</td>";
	$rtnValue=$rtnValue."<td align=\"right\">".number_format($jmlrealisasi1,2,",",".")."</td>";
	$rtnValue=$rtnValue."<td align=\"right\">".number_format($jmlrealisasi2,2,",",".")."</td>";
	$rtnValue=$rtnValue."<td align=\"right\">".number_format($jmlrealisasi3,2,",",".")."</td>";

// Rasio
	if ($angbudgetAwal==0){
		$rtnValue=$rtnValue."<td align=\"right\">".number_format(0,2,",",".")."<br><input type='hidden' name='rekening' value='".$kdrekening."'></td>";
	}
	else{
		$rtnValue=$rtnValue."<td align=\"right\">".number_format($jmlrealisasi1*100/$angbudgetAwal,2,",",".")."<br><input type='hidden' name='rekening' value='".$kdrekening."'></td>";		
	}

	if ($angbudget==0){
		$rtnValue=$rtnValue."<td align=\"right\">".number_format(0,2,",",".")."<br><input type='hidden' name='rekening' value='".$kdrekening."'></td>";
	}
	else{
		$rtnValue=$rtnValue."<td align=\"right\">".number_format($jmlrealisasi2*100/$angbudget,2,",",".")."<br><input type='hidden' name='rekening' value='".$kdrekening."'></td>";		
	}
	$rtnValue=$rtnValue."</tr>";

	return $rtnValue;
}

function countTotal($judul,$groupakun)
{
	GLOBAL $angbudgetAwalA,$angbudgetA;
	GLOBAL $jmlrealisasi1A,$jmlrealisasi2A,$jmlrealisasi3A;

	GLOBAL $angbudgetAwalB,$angbudgetB;
	GLOBAL $jmlrealisasi1B,$jmlrealisasi2B,$jmlrealisasi3B;


	if ($groupakun=='01'){
		$angbudgetAwal=$angbudgetAwalA;
		$angbudget=$angbudgetA;
		$jmlrealisasi1=$jmlrealisasi1A;
		$jmlrealisasi2=$jmlrealisasi2A;
		$jmlrealisasi3=$jmlrealisasi3A;	
		$rasioAwal=$jmlrealisasi1A*100/$angbudgetAwalA;
		$rasio=$jmlrealisasi2A*100/$angbudgetA;	
	} 
	elseif ($groupakun=='02') {
		$angbudgetAwal=$angbudgetAwalB;
		$angbudget=$angbudgetB;
		$jmlrealisasi1=$jmlrealisasi1B;
		$jmlrealisasi2=$jmlrealisasi2B;
		$jmlrealisasi3=$jmlrealisasi3B;	
		$rasioAwal=$jmlrealisasi1B*100/$angbudgetAwalB;
		$rasio=$jmlrealisasi2B*100/$angbudgetB;	
	}
	elseif ($groupakun=='ALL') {
		$angbudgetAwal=$angbudgetAwalA-$angbudgetAwalB;
		$angbudget=$angbudgetA-$angbudgetB;
		$jmlrealisasi1=$jmlrealisasi1A-$jmlrealisasi1B;
		$jmlrealisasi2=$jmlrealisasi2A-$jmlrealisasi2B;
		$jmlrealisasi3=$jmlrealisasi3A-$jmlrealisasi3B;	
		$rasioAwal=($jmlrealisasi1A-$jmlrealisasi1B)*100/($angbudgetAwalA-$angbudgetAwalB);
		$rasio=($jmlrealisasi2A-$jmlrealisasi2B)*100/($angbudgetA-$angbudgetB);
	}
	
// Tampilan
	$rtnValue="<tr bgcolor='#3366CC'><td></td><td><font color='#FFFFFF'><b>".$judul."</b></font></td>";
	$rtnValue=$rtnValue."<td align=\"right\"><font color='#FFFFFF'>".number_format($angbudgetAwal,2,",",".")."</font></td>";
	$rtnValue=$rtnValue."<td align=\"right\"><font color='#FFFFFF'>".number_format($angbudget,2,",",".")."</font></td>";
	$rtnValue=$rtnValue."<td align=\"right\"><font color='#FFFFFF'>".number_format($jmlrealisasi1,2,",",".")."</font></td>";
	$rtnValue=$rtnValue."<td align=\"right\"><font color='#FFFFFF'>".number_format($jmlrealisasi2,2,",",".")."</font></td>";
	$rtnValue=$rtnValue."<td align=\"right\"><font color='#FFFFFF'>".number_format($jmlrealisasi3,2,",",".")."</font></td>";

// Rasio
	if ($angbudgetAwal==0){
		$rtnValue=$rtnValue."<td align=\"right\"><font color='#FFFFFF'>".number_format(0,2,",",".")."<br><input type='hidden' name='rekening' value='".$kdrekening."'></font></td>";
	}
	else{
		$rtnValue=$rtnValue."<td align=\"right\"><font color='#FFFFFF'>".number_format($rasioAwal,2,",",".")."<br><input type='hidden' name='rekening' value='".$kdrekening."'></font></td>";		
	}

	if ($angbudget==0){
		$rtnValue=$rtnValue."<td align=\"right\"><font color='#FFFFFF'>".number_format(0,2,",",".")."<br><input type='hidden' name='rekening' value='".$kdrekening."'></font></td>";
	}
	else{
		$rtnValue=$rtnValue."<td align=\"right\"><font color='#FFFFFF'>".number_format($rasio,2,",",".")."<br><input type='hidden' name='rekening' value='".$kdrekening."'></font></td>";		
	}
	$rtnValue=$rtnValue."</tr>";

	return $rtnValue;
}

function nilaiRekening($groupakun,$DBA,$wherektr1,$kdktr,$whereposted,$dthn,$uraian,$tglAwalCari,$tglAwalBulan,$tglDariCari,$tglSampaiCari)
{
	GLOBAL $angbudgetAwal,$angbudget;
	GLOBAL $jmlrealisasi1,$jmlrealisasi2,$jmlrealisasi3;

	GLOBAL $angbudgetAwalA,$angbudgetA;
	GLOBAL $jmlrealisasi1A,$jmlrealisasi2A,$jmlrealisasi3A;

	GLOBAL $angbudgetAwalB,$angbudgetB;
	GLOBAL $jmlrealisasi1B,$jmlrealisasi2B,$jmlrealisasi3B;

// Proyeksi Sejak Awal Tahun
	$sq1 = "SELECT SUM(PROYEKSI) AS PROYEKSI ".
			"FROM $DBUser.TABEL_CASHFLOW ".
			"WHERE ".$wherektr1."KDTRANS<='".$tglAwalBulan."' AND GROUPAKUN='".$groupakun."'";
	$DBA->parse($sq1);
	$DBA->execute();
	$budgetAwal=0;
	while ($arx=$DBA->nextrow()) {
		$budgetAwal=$arx["PROYEKSI"];
	}					
	
// Proyeksi Sejak Awal Bulan
	$sq1 = "SELECT PROYEKSI, AKUN ".
			"FROM $DBUser.TABEL_CASHFLOW ".
			"WHERE ".$wherektr1."KDTRANS='".$tglAwalBulan."' AND GROUPAKUN='".$groupakun."'";
	$DBA->parse($sq1);
	$DBA->execute();
	$budget=0;
	while ($arx=$DBA->nextrow()) {
		$budget=$arx["PROYEKSI"];
		$kdrekening="(".$arx["AKUN"].")";
	}					

// Realisasi Awal Tahun s/d Tgl Sampai
	$sq2 = "SELECT SUM(DEBET) AS DEBET, SUM(KREDIT) AS KREDIT ".
			"FROM $DBUser.TABEL_802_TRVOUC ".
			"WHERE ".$wherektr1."SUBSTR(NOTRANS,0,1) in ('B','K','L','M') AND KDTRANS>='".$tglAwalCari."' AND KDTRANS<='".$tglSampaiCari."' AND ".
			$whereposted." AKUN IN ".$kdrekening;
	$DBA->parse($sq2);
	$DBA->execute();
    $debet1=0;
    $kredit1=0;					 
    while ($arx=$DBA->nextrow()) {
		$debet1=$arx["DEBET"];
		$kredit1=$arx["KREDIT"];			
    }					

// Realisasi Awal Bulan s/d Tgl Sampai
	$sq2 = "SELECT SUM(DEBET) AS DEBET, SUM(KREDIT) AS KREDIT ".
			"FROM $DBUser.TABEL_802_TRVOUC ".
			"WHERE ".$wherektr1."SUBSTR(NOTRANS,0,1) in ('B','K','L','M') AND KDTRANS>='".$tglAwalBulan."' AND KDTRANS<='".$tglSampaiCari."' AND ".
			$whereposted." AKUN IN ".$kdrekening;
	$DBA->parse($sq2);
	$DBA->execute();
    $debet2=0;
    $kredit2=0;					 
    while ($arx=$DBA->nextrow()) {
		$debet2=$arx["DEBET"];
		$kredit2=$arx["KREDIT"];			
    }					

// Realisasi Tgl Dari s/d Tgl Sampai
	$sq2 = "SELECT SUM(DEBET) AS DEBET, SUM(KREDIT) AS KREDIT ".
			"FROM $DBUser.TABEL_802_TRVOUC ".
			"WHERE ".$wherektr1."SUBSTR(NOTRANS,0,1) in ('B','K','L','M') AND KDTRANS>='".$tglDariCari."' AND KDTRANS<='".$tglSampaiCari."' AND ".
			$whereposted." AKUN IN ".$kdrekening;
	$DBA->parse($sq2);
	$DBA->execute();
    $debet3=0;
    $kredit3=0;					 
    while ($arx=$DBA->nextrow()) {
		$debet3=$arx["DEBET"];
		$kredit3=$arx["KREDIT"];			
    }					


// Tampilan
	$rtnValue="<tr><td></td><td>".$uraian."</td>";
	$rtnValue=$rtnValue."<td align=\"right\">".number_format($budgetAwal,2,",",".")."</td>";
	$rtnValue=$rtnValue."<td align=\"right\">".number_format($budget,2,",",".")."</td>";
	$rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_gllink.php?wherektr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."&akun=".$akun."','popuppage','1000','300','yes')\">".number_format(abs($kredit1-$debet1),2,",",".")."</a></td>";
	$rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_gllink.php?wherektr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."&akun=".$akun."','popuppage','1000','300','yes')\">".number_format(abs($kredit2-$debet2),2,",",".")."</a></td>";
	$rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_gllink.php?wherektr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."&akun=".$akun."','popuppage','1000','300','yes')\">".number_format(abs($kredit3-$debet3),2,",",".")."</a></td>";

// Rasio
	if ($budgetAwal==0){
		$rtnValue=$rtnValue."<td align=\"right\">".number_format(0,2,",",".")."<br><input type='hidden' name='rekening' value='".$kdrekening."'></td>";
	}
	else{
		$rtnValue=$rtnValue."<td align=\"right\">".number_format(abs($kredit1-$debet1)*100/$budgetAwal,2,",",".")."<br><input type='hidden' name='rekening' value='".$kdrekening."'></td>";		
	}

	if ($budget==0){
		$rtnValue=$rtnValue."<td align=\"right\">".number_format(0,2,",",".")."<br><input type='hidden' name='rekening' value='".$kdrekening."'></td>";
	}
	else{
		$rtnValue=$rtnValue."<td align=\"right\">".number_format(abs($kredit2-$debet2)*100/$budget,2,",",".")."<br><input type='hidden' name='rekening' value='".$kdrekening."'></td>";		
	}
	$rtnValue=$rtnValue."</tr>";


// SubTotal				
	$angbudgetAwal=$angbudgetAwal+$budgetAwal;
	$angbudget=$angbudget+$budget;
	$jmlrealisasi1=$jmlrealisasi1+$kredit1-$debet1;
	$jmlrealisasi2=$jmlrealisasi2+$kredit2-$debet2;
	$jmlrealisasi3=$jmlrealisasi3+$kredit3-$debet3;

// Total; 01 - PENERIMAAN (A); 02 - PENGELUARAN (B)	
	if (substr($groupakun,0,2)=='01') {
		$angbudgetAwalA=$angbudgetAwalA+$budgetAwal;
		$angbudgetA=$angbudgetA+$budget;
		$jmlrealisasi1A=$jmlrealisasi1A+$kredit1-$debet1;
		$jmlrealisasi2A=$jmlrealisasi2A+$kredit2-$debet2;
		$jmlrealisasi3A=$jmlrealisasi3A+$kredit3-$debet3;
	} else if (substr($groupakun,0,2)=='02') {
		$angbudgetAwalB=$angbudgetAwalB+$budgetAwal;
		$angbudgetB=$angbudgetB+$budget;
		$jmlrealisasi1B=$jmlrealisasi1B+$kredit1-$debet1;
		$jmlrealisasi2B=$jmlrealisasi2B+$kredit2-$debet2;
		$jmlrealisasi3B=$jmlrealisasi3B+$kredit3-$debet3;
	}
	return $rtnValue;
}

function DateSelector($inName, $useDate=0) 
{ 
	if($useDate == 0) { 
		$useDate = Time(); 
	} 

// Tanggal
	print("<select name=" . $inName .  "tgl>\n"); 
	//print ("<option value=0>---</option>");
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
	//print ("<option value=0>------</option>");
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
echo "    </tr>";
echo "    <tr>";
echo "      <td class=\"verdana9blk\">Kantor Produksi</td>";
echo "      <td class=\"verdana9blk\" colspan=5>";
echo "          <select name=ktr>";
echo "				<option value=\"all\" selected>-- SEMUA KANTOR --</option>";

				$sqa = "select k.kdkantor,k.namakantor ".
					   	"from $DBUser.tabel_001_kantor k ".
						"where k.kdkantor like '%A' or k.kdkantor='KP' ". 
              			"order by k.kdkantor";
          		$DBZ->parse($sqa);
          		$DBZ->execute();					 
          		while ($arz=$DBZ->nextrow()) {
                  	$sqa = "select k.kdkantor,k.namakantor ".
                  	       	"from $DBUser.tabel_001_kantor k ".
							"where k.kdkantor like '".substr($arz["KDKANTOR"],0,1)."%' ".
                  			"order by k.kdkantor";
              		$DB->parse($sqa);
              		$DB->execute();					 
              		while ($art=$DB->nextrow()) {
echo "								 <option value='".$art["KDKANTOR"]."'>".$art["KDKANTOR"]." - ".$art["NAMAKANTOR"]."</option>";
              		}										
					if (!($arz["KDKANTOR"]=='KP'||$arz["KDKANTOR"]=='RA')){
echo "								 <option value='".substr($arz["KDKANTOR"],0,1)."Z'>-- ".substr($arz["KDKANTOR"],0,1)."Z - SE-".$arz["NAMAKANTOR"]." --</option>";										
          			}
				}

echo "          </select>";
echo "      </td></tr>";
echo "      <tr><td class=\"verdana9blk\">Status Pembukuan</td>";
echo "      <td class=\"verdana9blk\" colspan=5>";
echo "          <select name=stposted>";
echo "				<option value='all'>SELURUH STATUS (ALL)</option>";
echo "				<option value='Y'>POSTED (Y) -- Setelah Tutup Buku</option>";
echo "				<option value='N'>UNPOSTED (N) -- Sebelum Tutup Buku</option>";
echo "          </select></td>";
//echo "       *) Khusus Data dari GL-LiNk</td>";
echo "      <td class=\"verdana9blk\"> ";
echo "        <input type=submit name=cari value=CARI>";               
echo "      </td>";
echo "    </tr>";
echo "  </form>";
echo "  </table>";
echo "<hr size=1>";

#--------------------------------------------------- end navigasi --------------
if($cari){
	if ($ktr=='all'){
		$wherektr="";
		$wherektr1="";
		$kdktr="";
		
		$namakantor="SELURUH KANTOR IFG LIFE";
	}
	elseif (substr($ktr,1,1)!='Z'){
		$sqa = "select k.kdkantor,k.namakantor ".
				"from $DBUser.tabel_001_kantor k ".
				"where k.kdkantor='".$ktr."' ".
				"order by k.kdkantor";
		$DB->parse($sqa);
		$DB->execute();					 
		while ($arr=$DB->nextrow()) {
			$namakantor=$arr["NAMAKANTOR"];
		}					
		$wherektr="prefixpertanggungan='".$ktr."' and ";
		$wherektr1="kdkantor='".$ktr."' and ";
		$kdktr=$ktr;
	 }
	 elseif (substr($ktr,1,1)=='Z'){
		$sqa = "select k.kdkantor,k.namakantor ".
				"from $DBUser.tabel_001_kantor k ".
				"where k.kdkantor='".substr($ktr,0,1)."A' ".
				"order by k.kdkantor";
		$DB->parse($sqa);
		$DB->execute();					 
		while ($arr=$DB->nextrow()) {
			$namakantor="SE-".$arr["NAMAKANTOR"];
		}					
		$wherektr="prefixpertanggungan like '".substr($ktr,0,1)."%' and ";
		$wherektr1="kdkantor like '".substr($ktr,0,1)."%' and ";
		$kdktr=$ktr;
	}

	if ($stposted=='all') {
		$whereposted="";
	}
	else if ($stposted=='Y') {
		$whereposted="posted='Y' and ";
	}
	else if ($stposted=='N') {
		$whereposted="posted='N' and ";
	}
			
	$tglDari=substr('00'.$dtgl,-2)."/".substr('00'.$dbln,-2)."/".$dthn;
	$tglSampai=substr('00'.$stgl,-2)."/".substr('00'.$sbln,-2)."/".$sthn;

	$tglAwalCari=$sthn."0101";			 		 
	$tglAwalBulan=$dthn.substr('00'.$dbln,-2)."01";
	$tglDariCari=$dthn.substr('00'.$dbln,-2).substr('00'.$dtgl,-2);
	$tglSampaiCari=$sthn.substr('00'.$sbln,-2).substr('00'.$stgl,-2);
			
	echo "LAPORAN ARUS KAS<br>";
	echo $namakantor."<br>";					
	echo "PERIODE ".$tglDari." s/d ".$tglSampai."<br>";					
	echo "(generated ".date('l, d F Y')." ".date('H:i A').")<br><br>";					

?>

<!-- Header ------------------------------------------------------------------------------------------------------------------->
	<table border="1" style="border-collapse: collapse" id="table1" cellpadding="5">
		<tr>
			<td bgcolor="#3366CC" align="center" rowspan="2"><font color="#FFFFFF">No</font></td>
			<td bgcolor="#3366CC" align="center" rowspan="2"><font color="#FFFFFF">Uraian</font></td>
			<td bgcolor="#3366CC" align="center" colspan="2"><font color="#FFFFFF">Proyeksi</font></td>
			<td bgcolor="#3366CC" align="center" colspan="3"><font color="#FFFFFF">Realisasi</font></td>
			<td bgcolor="#3366CC" align="center" colspan="2"><font color="#FFFFFF">Rasio(%)</font></td>
		</tr>
		
		<tr>	
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF">01/<?=$dthn?> s/d <br /><?=substr('00'.$dbln,-2)."/".$dthn?><br />(a)</font></td>
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF"><?=substr('00'.$dbln,-2)."/".$dthn?><br />(b)</font></td>
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF">01/01/<?=$dthn?> s/d <?=$tglSampai?><br />(c)</font></td>
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF">01/<?=substr('00'.$dbln,-2)."/".$dthn?> s/d <?=$tglSampai?><br />(d)</font></td>
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF"><?=$tglDari?> s/d <?=$tglSampai?><br />(periode laporan)</font></td> 
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF">01/01/<?=$dthn?> s/d <?=$tglSampai?><br />(c/a)</font></td>
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF">01/<?=substr('00'.$dbln,-2)."/".$dthn?> s/d <?=$tglSampai?><br />(d/b)</font></td>
		</tr>
	
	<!-- Mulai Detail ------------------------------------------------------------------------------------------------------------------->
		<tr bgcolor="#FFFF00"><td><b>I</b></td><td colspan="8"><b>PENERIMAAN (ARUS KAS MASUK)</b></td></tr>
		
		<? resetCounter();?>
		<? echo nilaiRekening('01-01',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,'01. Penerimaan Premi',$tglAwalCari,$tglAwalBulan,$tglDariCari,$tglSampaiCari);?>
		<? echo nilaiRekening('01-02',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,'02. Penerimaan Hasil Investasi',$tglAwalCari,$tglAwalBulan,$tglDariCari,$tglSampaiCari);?>
		<? echo nilaiRekening('01-03',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,'03. Penerimaan Klaim Reasuransi',$tglAwalCari,$tglAwalBulan,$tglDariCari,$tglSampaiCari);?>
		<? echo nilaiRekening('01-04',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,'04. Penerimaan Lain-lain (Titipan Premi, Pajak, dll)',$tglAwalCari,$tglAwalBulan,$tglDariCari,$tglSampaiCari);?>
		<? echo countSubTotal('SUB-TOTAL (I. 01 s.d 04)');?>
		<? echo countTotal('TOTAL PENERIMAAN (I)','01');?>
		
		<tr bgcolor="#FFFF00"><td><b>II</b></td><td colspan="8"><b>PENGELUARAN (ARUS KAS KELUAR)</b></td></tr>
		
		<? resetCounter();?>
		<? echo nilaiRekening('02-01',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,'01. Pengeluaran Klaim',$tglAwalCari,$tglAwalBulan,$tglDariCari,$tglSampaiCari);?>
		<? echo nilaiRekening('02-02',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,'02. Pengeluaran Tebus',$tglAwalCari,$tglAwalBulan,$tglDariCari,$tglSampaiCari);?>
		<? echo nilaiRekening('02-03',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,'03. Pengeluaran Ekspirasi',$tglAwalCari,$tglAwalBulan,$tglDariCari,$tglSampaiCari);?>
		<? echo countSubTotal('SUB-TOTAL (II. 01 s.d 03)');?>
		
		<? resetCounter();?>
		<? echo nilaiRekening('02-04',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,'04. Pengeluaran Premi Reasuransi',$tglAwalCari,$tglAwalBulan,$tglDariCari,$tglSampaiCari);?>
		<? echo nilaiRekening('02-05',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,'05. Pengeluaran Komisi/Operasional',$tglAwalCari,$tglAwalBulan,$tglDariCari,$tglSampaiCari);?>
		<? echo nilaiRekening('02-06',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,'06. Pengeluaran Beban Kepegawaian',$tglAwalCari,$tglAwalBulan,$tglDariCari,$tglSampaiCari);?>
		<? echo nilaiRekening('02-07',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,'07. Pengeluaran Beban Inkaso',$tglAwalCari,$tglAwalBulan,$tglDariCari,$tglSampaiCari);?>
		<? echo nilaiRekening('02-08',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,'08. Pengeluaran Beban Umum dan Pajak',$tglAwalCari,$tglAwalBulan,$tglDariCari,$tglSampaiCari);?>
		<? echo nilaiRekening('02-09',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,'09. Pengeluaran Mekanisasi',$tglAwalCari,$tglAwalBulan,$tglDariCari,$tglSampaiCari);?>
		<? echo nilaiRekening('02-10',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,'10. Pengeluaran Beban Manajemen',$tglAwalCari,$tglAwalBulan,$tglDariCari,$tglSampaiCari);?>
		<? echo nilaiRekening('02-11',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,'11. Pengeluaran Lain-lain',$tglAwalCari,$tglAwalBulan,$tglDariCari,$tglSampaiCari);?>	
		<? echo countSubTotal('SUB-TOTAL (II. 04 s.d 11)');?>
		<? echo countTotal('TOTAL PENGELUARAN (II)','02');?>
	
		<? echo countTotal('T O T A L (PENERIMAAN-PENGELUARAN)','ALL');?>
	
	</table>
<!-- End Detail ------------------------------------------------------------------------------------------------------------------->

	<br />
	<hr size="1">
<?
}
?>

<a href="index.php"><font face="Verdana" size="2">Menu Pelaporan</font></a>&nbsp;&nbsp;&nbsp;&nbsp;
<? 
include "../../includes/endtimer.php"; 
?>