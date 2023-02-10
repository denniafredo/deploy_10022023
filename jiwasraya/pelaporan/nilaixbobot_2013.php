<?  
	include "../../includes/session.php"; 
	include "../../includes/starttimer.php"; 
	include "../../includes/database.php"; 
	include "../../includes/common.php";
	include "../../includes/fungsi.php";
	include "../../includes/oradb.class.php";
//	include "../../includes/cDatabase.php";
	
	$DBA = new Database("SPI","SPI","DWLAT");	
	
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
echo "<a class=verdana10blu><b>LAPORAN PENILAIAN KINERJA KANTOR</b></a>";
echo "<hr size=1>";

#---------------------------------------------- start navigasi -----------------
function nilaiRekening($DBA,$kdktr,$tglPeriode)
{
	$sq1 = "SELECT
				NO,
				KDKANTOR, 
				KANTOR, 
				PERSEN_RASIO_TERIMA_AGEN, 			   
				NILAI_RASIO_TERIMA_AGEN, 
				BOBOT_RASIO_TERIMA_AGEN, 
				NXB_RASIO_TERIMA_AGEN, 			   
				PERSEN_RASIO_PERSISTENSI_POLIS, 
				NILAI_RASIO_PERSISTENSI_POLIS, 
				BOBOT_RASIO_PERSISTENSI_POLIS, 			   
				NXB_RASIO_PERSISTENSI_POLIS, 
				WAKTU_PENCAIRAN_PIUTANG_PREMI, 
				NILAI_PENCAIRAN_PIUTANG_PREMI, 			   
				BOBOT_PENCAIRAN_PIUTANG_PREMI, 
				NXB_PENCAIRAN_PIUTANG_PREMI, 
				PERSEN_CAPAI_PRODUK_PREMI_PP, 			   
				NILAI_CAPAI_PRODUK_PREMI_PP, 
				BOBOT_CAPAI_PRODUK_PREMI_PP, 
				NXB_CAPAI_PRODUK_PREMI_PP, 			   
				PERSEN_CAPAI_PRODUK_PREMI_PK, 
				NILAI_CAPAI_PRODUK_PREMI_PK, 
				BOBOT_CAPAI_PRODUK_PREMI_PK, 			   
				NXB_CAPAI_PRODUK_PREMI_PK, 
				PERSEN_SEIMBANG_CASH_FLOW, 
				NILAI_SEIMBANG_CASH_FLOW, 			   
				BOBOT_SEIMBANG_CASH_FLOW, 
				NXB_SEIMBANG_CASH_FLOW, 
				JML_NXB, 			   
				SASARAN, 
				RASIO_NXB, 
				PREDIKAT			
			FROM SPI.EVALUASI_KINERJA	
			WHERE 
				KDKANTOR LIKE '".$kdktr."%' AND 
				PERIODE='".$tglPeriode."'";
	
//	echo $sq1;
	$DBA->parse($sq1);
	$DBA->execute();
	$arx=$DBA->nextrow();

	if (substr($kdktr,1,1)=='Z') {
		$bg="#00FF00";
	} else {
		$bg="#FFFFFF";
	}
	
// Tampilan
	$rtnValue="<tr><td bgcolor='".$bg."'>".$arx["NO"]."</td>";
	$rtnValue=$rtnValue."<td bgcolor='".$bg."' align=\"left\">".$arx["KDKANTOR"]."</td>";
	$rtnValue=$rtnValue."<td bgcolor='".$bg."' align=\"left\">".$arx["KANTOR"]."</td>";
	$rtnValue=$rtnValue."<td bgcolor='".$bg."' align=\"right\">".number_format($arx["PERSEN_RASIO_TERIMA_AGEN"],2,",",".")."</td>";
	$rtnValue=$rtnValue."<td bgcolor='".$bg."' align=\"right\">".number_format($arx["NILAI_RASIO_TERIMA_AGEN"],2,",",".")."</td>";
	$rtnValue=$rtnValue."<td bgcolor='".$bg."' align=\"right\">".number_format($arx["BOBOT_RASIO_TERIMA_AGEN"],2,",",".")."</td>";
	$rtnValue=$rtnValue."<td bgcolor='".$bg."' align=\"right\">".number_format($arx["NXB_RASIO_TERIMA_AGEN"],2,",",".")."</td>";
	$rtnValue=$rtnValue."<td bgcolor='".$bg."' align=\"right\">".number_format($arx["PERSEN_RASIO_PERSISTENSI_POLIS"],2,",",".")."</td>";
	$rtnValue=$rtnValue."<td bgcolor='".$bg."' align=\"right\">".number_format($arx["NILAI_RASIO_PERSISTENSI_POLIS"],2,",",".")."</td>";
	$rtnValue=$rtnValue."<td bgcolor='".$bg."' align=\"right\">".number_format($arx["BOBOT_RASIO_PERSISTENSI_POLIS"],2,",",".")."</td>";
	$rtnValue=$rtnValue."<td bgcolor='".$bg."' align=\"right\">".number_format($arx["NXB_RASIO_PERSISTENSI_POLIS"],2,",",".")."</td>";
	$rtnValue=$rtnValue."<td bgcolor='".$bg."' align=\"right\">".number_format($arx["WAKTU_PENCAIRAN_PIUTANG_PREMI"],2,",",".")."</td>";
	$rtnValue=$rtnValue."<td bgcolor='".$bg."' align=\"right\">".number_format($arx["NILAI_PENCAIRAN_PIUTANG_PREMI"],2,",",".")."</td>";
	$rtnValue=$rtnValue."<td bgcolor='".$bg."' align=\"right\">".number_format($arx["BOBOT_PENCAIRAN_PIUTANG_PREMI"],2,",",".")."</td>";
	$rtnValue=$rtnValue."<td bgcolor='".$bg."' align=\"right\">".number_format($arx["NXB_PENCAIRAN_PIUTANG_PREMI"],2,",",".")."</td>";
	$rtnValue=$rtnValue."<td bgcolor='".$bg."' align=\"right\">".number_format($arx["PERSEN_CAPAI_PRODUK_PREMI_PP"],2,",",".")."</td>";
	$rtnValue=$rtnValue."<td bgcolor='".$bg."' align=\"right\">".number_format($arx["NILAI_CAPAI_PRODUK_PREMI_PP"],2,",",".")."</td>";
	$rtnValue=$rtnValue."<td bgcolor='".$bg."' align=\"right\">".number_format($arx["BOBOT_CAPAI_PRODUK_PREMI_PP"],2,",",".")."</td>";
	$rtnValue=$rtnValue."<td bgcolor='".$bg."' align=\"right\">".number_format($arx["NXB_CAPAI_PRODUK_PREMI_PP"],2,",",".")."</td>";
	$rtnValue=$rtnValue."<td bgcolor='".$bg."' align=\"right\">".number_format($arx["PERSEN_CAPAI_PRODUK_PREMI_PK"],2,",",".")."</td>";
	$rtnValue=$rtnValue."<td bgcolor='".$bg."' align=\"right\">".number_format($arx["NILAI_CAPAI_PRODUK_PREMI_PK"],2,",",".")."</td>";
	$rtnValue=$rtnValue."<td bgcolor='".$bg."' align=\"right\">".number_format($arx["BOBOT_CAPAI_PRODUK_PREMI_PK"],2,",",".")."</td>";
	$rtnValue=$rtnValue."<td bgcolor='".$bg."' align=\"right\">".number_format($arx["NXB_CAPAI_PRODUK_PREMI_PK"],2,",",".")."</td>";
	$rtnValue=$rtnValue."<td bgcolor='".$bg."' align=\"right\">".number_format($arx["PERSEN_SEIMBANG_CASH_FLOW"],2,",",".")."</td>";
	$rtnValue=$rtnValue."<td bgcolor='".$bg."' align=\"right\">".number_format($arx["NILAI_SEIMBANG_CASH_FLOW"],2,",",".")."</td>";
	$rtnValue=$rtnValue."<td bgcolor='".$bg."' align=\"right\">".number_format($arx["BOBOT_SEIMBANG_CASH_FLOW"],2,",",".")."</td>";
	$rtnValue=$rtnValue."<td bgcolor='".$bg."' align=\"right\">".number_format($arx["NXB_SEIMBANG_CASH_FLOW"],2,",",".")."</td>";
	$rtnValue=$rtnValue."<td bgcolor='".$bg."' align=\"right\">".number_format($arx["JML_NXB"],2,",",".")."</td>";
	$rtnValue=$rtnValue."<td bgcolor='".$bg."' align=\"right\">".number_format($arx["SASARAN"],2,",",".")."</td>";
	$rtnValue=$rtnValue."<td bgcolor='".$bg."' align=\"right\">".number_format($arx["RASIO_NXB"],2,",",".")."</td>";
	$rtnValue=$rtnValue."<td bgcolor='".$bg."' align=\"center\">".$arx["PREDIKAT"]."</td></tr>";
	
	return $rtnValue;
}

function DateSelector($inName, $useDate=0) 
{ 
	if($useDate == 0) { 
		$useDate = Time(); 
	} 

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
echo "      <td class=\"verdana9blk\"> ";
echo "        <input type=submit name=cari value=PROSES>";               
echo "      </td>";
echo "    </tr>";
echo "  </form>";
echo "  </table>";
echo "<hr size=1>";

#--------------------------------------------------- end navigasi --------------
if($cari){
			
	$tglPeriode=$dthn."/".substr('00'.$dbln,-2);

	echo "LAPORAN PENILAIAN KINERJA KANTOR<br>";
	echo "PERIODE ".substr('00'.$dbln,-2)."/".$dthn."<br>";					
	echo "(generated ".date('l, d F Y')." ".date('H:i A').")<br><br>";					

?>

<!-- Header ------------------------------------------------------------------------------------------------------------------->
	<table border="1" style="border-collapse: collapse" id="table1" cellpadding="5">
		<tr>
			<td bgcolor="#3366CC" align="center" rowspan="3"><font color="#FFFFFF">No</font></td>
			<td bgcolor="#3366CC" align="center" rowspan="3"><font color="#FFFFFF">Kode Kantor</font></td>
			<td bgcolor="#3366CC" align="center" rowspan="3"><font color="#FFFFFF">Kantor</font></td>
			<td bgcolor="#3366CC" align="center" colspan="8"><font color="#FFFFFF">Aktifitas Operasional</font></td>
			<td bgcolor="#3366CC" align="center" colspan="16"><font color="#FFFFFF">Hasil Usaha</font></td>
			<td bgcolor="#3366CC" align="center" rowspan="3"><font color="#FFFFFF">Jumlah Nilai x Bobot</font></td>
			<td bgcolor="#3366CC" align="center" rowspan="3"><font color="#FFFFFF">Sasaran</font></td>
			<td bgcolor="#3366CC" align="center" rowspan="3"><font color="#FFFFFF">Rasio Nilai x Bobot</font></td>
			<td bgcolor="#3366CC" align="center" rowspan="3"><font color="#FFFFFF">Predikat</font></td>
		</tr>
		
		<tr>	
			<td bgcolor="#3366CC" align="center" colspan="4"><font color="#FFFFFF">Rasio Penerimaan Agen Baru PP dan PK</font></td>
			<td bgcolor="#3366CC" align="center" colspan="4"><font color="#FFFFFF">Rasio Persistensi Polis PP</font></td>
			<td bgcolor="#3366CC" align="center" colspan="4"><font color="#FFFFFF">Rata-rata Waktu Pencairan Piutang Premi OB PP dan PK</font></td>
			<td bgcolor="#3366CC" align="center" colspan="4"><font color="#FFFFFF">Rasio Pencapaian Produksi Premi NB PP</font></td>
			<td bgcolor="#3366CC" align="center" colspan="4"><font color="#FFFFFF">Rasio Pencapaian Produksi Premi NB PK</font></td>
			<td bgcolor="#3366CC" align="center" colspan="4"><font color="#FFFFFF">Rasio Keseimbangan Cashflow</font></td>
		</tr>

		<tr>	
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF">%</font></td>
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Nilai</font></td>
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Bobot</font></td>
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Nilai x Bobot</font></td>
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF">%</font></td>
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Nilai</font></td>
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Bobot</font></td>
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Nilai x Bobot</font></td>
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF">%</font></td>
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Nilai</font></td>
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Bobot</font></td>
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Nilai x Bobot</font></td>
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF">%</font></td>
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Nilai</font></td>
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Bobot</font></td>
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Nilai x Bobot</font></td>
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF">%</font></td>
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Nilai</font></td>
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Bobot</font></td>
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Nilai x Bobot</font></td>
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF">%</font></td>
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Nilai</font></td>
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Bobot</font></td>
			<td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Nilai x Bobot</font></td>
		</tr>
	
<!-- Mulai Detail ------------------------------------------------------------------------------------------------------------------->
		<tr bgcolor="#FFFF00"><td><font color="#FFFF00">XXXXXXX</font></td><td colspan="30"><font color="#FFFF00">XXXXXXX</font></td></tr>
		
<?
	$sq2= "SELECT * FROM SPI.KANTOR ORDER BY KDKANTOR";
	$DBA->parse($sq2);
	$DBA->execute();
	while ($arb=$DBA->nextrow()){
		echo nilaiRekening($DBA,$arb["KDKANTOR"],$tglPeriode);
	} 
?>
<!-- End Detail ------------------------------------------------------------------------------------------------------------------->
	
	</table>

	<br />
	<hr size="1">
<?
}
?>

<a href="index.php"><font face="Verdana" size="2">Menu Pelaporan</font></a>&nbsp;&nbsp;&nbsp;&nbsp;
<? 
include "../../includes/endtimer.php"; 
?>