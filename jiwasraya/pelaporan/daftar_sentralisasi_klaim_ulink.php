<?php

/*
DESKRIPSI:
FORM INI UNTUK MENAMPILKAN DAFTAR TRANSAKSI REDEMPTION JL3 & JL4 
YANG TELAH DIBAYARKAN/DIAPPROVE OLEH DIV. KEUANGAN HO.
*/

include "../../includes/session.php"; 
include "../../includes/database.php";
include "../../includes/kantor.php"; 
include "../../includes/klien.php";


$DB=new database($DBUser, $DBPass, $DBName);
//$DBA=new database($userid, $passwd, $DBName);
$KTR=new Kantor('JSADM','JSADMOKE',$kantor);

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
<title>Daftar Pembayaran Redemption Unit Link</title>
<style type="text/css">
<!-- 
body{
 font-family: tahoma,verdana,geneva,sans-serif;
 font-size: 12px;
}

td{
 font-family: tahoma,verdana,geneva,sans-serif;
 font-size: 11px;
} 

input			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-width: .2em;border-width: .2em;color:333333;}
select			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}
textarea		{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}

a { 
  color:#259dc5;  
	text-decoration:none;
}

a:hover { 
	color:#cc6600;  
}

#filterbox{
  border: solid 1px #c0c0c0;
	padding : 5px;
	width:100%;
	margin : 0 0 10px 0;
}
form{
  margin : 0;
	padding : 0;
}
-->
</style>
</head>
<?
	if ($mode=='print')
	{
		echo "<body onload=\"window.print();window.close()\">";
	}
	else
	{
		echo "<body>";
?>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<script>

</script>
<div id="filterbox">
<form name="getRedCOACOI" action="<?=$PHP_SELF;?>" method="post">
	<table>
		<tr>
			<td>Produk</td>
			<td>
				<select name="kdproduk" id="kdproduk">
					<option value="JL3EQ" <? if ($kdproduk =='JL3EQ') print 'selected' ?> >JL3 (EQUITY)</option>
					<option value="JL3BL" <? if ($kdproduk =='JL3BL') print 'selected' ?> >JL3 (BALANCED)</option>
					<option value="JL3FX" <? if ($kdproduk =='JL3FX') print 'selected' ?> >JL3 (FIXED)</option>
					<option value="JL4BEF" <? if ($kdproduk =='JL4BEF') print 'selected' ?>>PROMAPAN (EKUITAS)</option>
					<option value="JL4BBF" <? if ($kdproduk =='JL4BBF') print 'selected' ?>>PROMAPAN (BERIMBANG)</option>
					<option value="JL4BMM" <? if ($kdproduk =='JL4BMM') print 'selected' ?>>PROMAPAN (PASAR UANG)</option>
					<option value="JL4BFF" <? if ($kdproduk =='JL4BFF') print 'selected' ?>>PROMAPAN (PENDAPATAN TTP)</option>
					<option value="JL4XEF" <? if ($kdproduk =='JL4XEF') print 'selected' ?>>PROIDAMAN (EKUITAS)</option>
					<option value="JL4XBF" <? if ($kdproduk =='JL4XBF') print 'selected' ?>>PROIDAMAN (BERIMBANG)</option>
					<option value="JL4XMM" <? if ($kdproduk =='JL4XMM') print 'selected' ?>>PROIDAMAN (PASAR UANG)</option>
					<option value="JL4XFF" <? if ($kdproduk =='JL4XFF') print 'selected' ?>>PROIDAMAN (PENDAPATAN TTP)</option>
				</select>
			</td>
		</tr>
		<tr>
			<? if($kantor=="KP"){ ?>
			<td>Kantor</td> 
			<td>
				<select name="kdkantor">
					<?
					$sqa="select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdjeniskantor='2' ".
								 "order by kdkantor";
						$DB->parse($sqa);
						$DB->execute();	
						while ($arr=$DB->nextrow()) 
						{
							echo "<option ";
							if ($arr["KDKANTOR"]==$kdkantor){ echo " selected"; }
							echo " value=".$arr["KDKANTOR"].">".$arr["KDKANTOR"]." - ".$arr["NAMAKANTOR"]."</option>";
						}
					?>
					<option value="ALL"<?=(($_POST['kdkantor']=='ALL') ? ' selected' : '');?>>--ALL--</option>
				</select>
			</td>
			<? } ?>
		</tr>

		<tr>
			<td>Tgl Proses HO</td><td><?=DateSelector("d"); ?></td><td></td>
			
		</tr>
		<tr></tr>

		<tr>
			<td colspan="2"><input type="submit" name="submit" value="Proses"</input></td>
		</tr>
	</table>
</form>
</div>
<?
}
?>

		<?php					
			
			$tglawal .= $dthn;
			$tglawal .= ((strlen($dbln)==1) ? '0'.$dbln : $dbln);
			$tglawal .= ((strlen($dtgl)==1) ? '0'.$dtgl : $dtgl);
			
			$tglawalInd = substr($tglawal, 6,2)."/".substr($tglawal, 4,2)."/".substr($tglawal, 0,4);
			
			$tglakhir .= $sthn;
			$tglakhir .= ((strlen($sbln)==1) ? '0'.$sbln : $sbln);
			$tglakhir .= ((strlen($stgl)==1) ? '0'.$stgl : $stgl);
			
			$tglakhirInd = substr($tglakhir, 6,2)."/".substr($tglakhir, 4,2)."/".substr($tglakhir, 0,4);
			
			if($tglawalInd == $tglakhirInd)
				$tglParse = $tglawalInd;
			else
				$tglParse = $tglawalInd. " s/d " .$tglakhirInd;
			
			
			$kodeKantor = $kdkantor;
			$produk = substr($kdproduk, 0, 3);				
			
			if($produk == 'JL4') {
				$kdfund = substr($kdproduk, 4, 2);
				$prodXORB = substr($kdproduk, 3, 1);
			} 
			else {
				$kdfund = substr($kdproduk, 3, 2);
			}
						
			$akunKredit = "";
            $akunDebit = "";
			$kodeTransCabang = "";
			$tNett = 0;
			
			$i=1;	
			if($kdfund != "")
				print "<b>Daftar Pembayaran Redemption Unit Link $produk$prodXORB ($kdfund) Tanggal $tglawalInd<br /> </b>";
			else
				print "<b>Daftar Pembayaran Redemption Unit Link<br /> </b>";
				
			print "<table border='0' cellpadding='2' cellspacing='1' style='border-collapse: collapse' bordercolor='#CCCCCC' width='100%' id='AutoNumber1'>";
			if(substr($produk, 0, 3) == 'JL3') {			
			?>
				<tr>
					<td bgcolor="#89acd8" align="center">No.</td>
					<td bgcolor="#89acd8" align="center">No. Polis</td>
					<td bgcolor="#89acd8" align="center">Nama Pempol</td>
					<td bgcolor="#89acd8" align="center">No. Rekening</td>
					<td bgcolor="#89acd8" align="center">Penerima</td>
					<td bgcolor="#89acd8" align="center">Bank</td>
					<td bgcolor="#89acd8" align="center">Redemption</td>
					<td bgcolor="#89acd8" align="center">Pajak</td>		
					<td bgcolor="#89acd8" align="center">Selisih NAB</td>
					<td bgcolor="#89acd8" align="center">Dibayarkan</td>
					<td bgcolor="#89acd8" align="center">Cetak SIP</td>
				</tr>
			<? } else if (substr($produk, 0, 3) == 'JL4') { ?>
				<tr>
					<td bgcolor="#89acd8" align="center">No.</td>
					<td bgcolor="#89acd8" align="center">No. Polis</td>
					<td bgcolor="#89acd8" align="center">Nama Pemb. Polis</td>
					<td bgcolor="#89acd8" align="center">No. Rekening</td>
					<td bgcolor="#89acd8" align="center">Penerima</td>
					<td bgcolor="#89acd8" align="center">Bank</td>
					<td bgcolor="#89acd8" align="center">Redemption</td>
					<td bgcolor="#89acd8" align="center">Biaya COA+COI</td>		
					<td bgcolor="#89acd8" align="center">Biaya Admin</td>
					<td bgcolor="#89acd8" align="center">Pajak</td>
					<td bgcolor="#89acd8" align="center">Dibayarkan</td>
					<td bgcolor="#89acd8" align="center">Cetak SIP</td>
				</tr>
			<? } else { ?>
				<tr>
					<td bgcolor="#89acd8" align="center"></td>

				</tr>
			<? }						
						
			//Nama Cetak SIP
			$query = "SELECT NAMAUSER FROM TABEL_888_USERID WHERE USERID='" .$_SESSION['userid']. "'";
			$DB->parse($query);
			$DB->execute();
			$namaTemp = $DB->nextrow();
			$nama = $namaTemp["NAMAUSER"];
			
			if ($produk == 'JL3') {
				
				$myServer   = "danareksa";
				$myUser 	= "sa";
				$myPass 	= "siar";
				$myDB		= "unitlink";
				$s = mssql_connect($myServer, $myUser, $myPass) or die("Couldn't connect to SQL Server on $myServer");
				$d = mssql_select_db($myDB, $s) or die("Couldn't open database $myDB");							
				
				if($kdfund == "EQ") {
					$akunKredit = "148420000";
                    $akunDebit = "424000000";
					$kodeTransCabang = "BC02202";
				}
				else if ($kdfund == "BL") {
					$akunKredit = "148370000";
                    $akunDebit = "423000000";
					$kodeTransCabang = "BC02201";
				}
				else if ($kdfund == "FX") {
					$akunKredit = "148300000";
                    $akunDebit = "422000000";
					$kodeTransCabang = "BC02203";
				}	
				
				if($kodeKantor == "ALL") {
					$query = "SELECT A.*, B.CLIENT_NAME, A.RP_GROSS-A.RP_NETT AS 'SELISIHNAB' FROM UL_TRANSAKSI A, UL_NASABAH B 
					WHERE A.NOMOR_POLIS = B.NOMOR_POLIS AND A.TRX_TYPE='R' AND A.ST_PROSES='9' AND A.KODE_FUND LIKE '%$kdfund' 
					AND CONVERT(VARCHAR,A.TGL_VERIFIKASI,103)='$tglawalInd'";
				
				}
				else{
					$query = "SELECT A.*, B.CLIENT_NAME, A.RP_GROSS-A.RP_NETT AS 'SELISIHNAB' FROM UL_TRANSAKSI A, UL_NASABAH B 
					WHERE A.NOMOR_POLIS = B.NOMOR_POLIS AND A.TRX_TYPE='R' AND A.ST_PROSES='9' AND A.KODE_FUND LIKE '%$kdfund' 
					AND CONVERT(VARCHAR,A.TGL_VERIFIKASI,103)='$tglawalInd' AND A.KDRAYONPENAGIH='$kantor'";
				}
				
				$msresults= mssql_query($query);
				
				$i = 1;
				
				$jmlData = mssql_num_rows($msresults);
				
				
				if($jmlData > 0) {
				
					while ($arr = mssql_fetch_array($msresults)) {
						echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
						echo '<td align="center">'.$i."</td>";
						echo "<td>".$arr["NOMOR_POLIS"]."</td>";
						echo "<td>".$arr["CLIENT_NAME"]."</td>";
						echo '<td>'.$arr["NO_REK"]."</td>";
						echo '<td>'.$arr["PEMILIK_REK"]."</td>";
						echo '<td>'.$arr["NAMA_BANK"]."</td>";
						echo '<td align="right">'.number_format($arr["RP_GROSS"],2,",",".").'</td>';
						echo '<td align="right">0</td>';
						echo '<td align="right">'.number_format($arr["SELISIHNAB"],2,",",".").'</td>';
						echo '<td align="right">'.number_format($arr["RP_NETT"],2,",",".").'</td>';
						
						$parameterCetak = "nopol=".$arr["NOMOR_POLIS"]."&kdtranscab=".$kodeTransCabang."&tgl=".$tglawalInd."&akunDebet=".$akunDebit."&akunKredit=".$akunKredit."&nominal=".$arr["RP_NETT"]."&kantor=".$kantor."&produk=".$kdproduk."&nama=".$nama;
						echo "<td align='center'>" ?> <a href="#" onclick="window.open('../akunting/cetakslip_red_ulink_all.php?<?=$parameterCetak?>','','width=800,height=600,top=100,left=100,scrollbars=yes')">Cetak</a> <? "</td>";
						echo "</tr>";
						
						$i++;
					}
	
					$query = str_replace(
					"A.*, B.CLIENT_NAME, A.RP_GROSS-A.RP_NETT AS 'SELISIHNAB'", 
					"SUM(A.RP_GROSS) AS 'TGROSS', SUM(A.RP_GROSS-A.RP_NETT) AS 'TSELISIHNAB', SUM(A.RP_NETT) AS 'TNETT'",
					$query);
					
					$msresults= mssql_query($query);
					$arr = mssql_fetch_array($msresults);
					
					echo "<tr bgcolor=#89acd8>";
					echo "<td align='center' colspan=6><b>TOTAL</b></td>";
					echo '<td align="right">'.number_format($arr["TGROSS"],2,",",".").'</td>';
					echo '<td align="right">0</td>';
					echo '<td align="right">'.number_format($arr["TSELISIHNAB"],2,",",".").'</td>';
					echo '<td align="right">'.number_format($arr["TNETT"],2,",",".").'</td>';
					echo '<td align="right"></td>';
					echo "</tr>";
				}
				else {
					echo "<tr bgcolor=#89acd8>";
					echo "<td align='center' colspan=10><b>Tidak Ada Data</b></td>";
					echo "</tr>";
				}
				
				print "</table>";
				
				$tNett = $arr["TNETT"];
			}
			else if ($produk == 'JL4') {				
				
				if($prodXORB == "X") {
					$akunKredit = "148211120";
                    $akunDebit = "421211120";
				}
				else if ($prodXORB == "B") {
					$akunKredit = "148211110";
                    $akunDebit = "421211110";
				}
				
				if($kdfund == 'EF') $kodeTransCabang = "BC05200";
				else if($kdfund == 'BF') $kodeTransCabang = "BC05100";
				else if($kdfund == 'MM') $kodeTransCabang = "BC05400";
				else if($kdfund == 'FF') $kodeTransCabang = "BC05300";
				
				if($kodeKantor == "ALL") {
					$query = "SELECT A.*, (SELECT NAMAKLIEN1 FROM TABEL_100_KLIEN WHERE NOKLIEN=B.NOTERTANGGUNG) NAMA  
								FROM TABEL_UL_TRANSAKSI A, TABEL_200_PERTANGGUNGAN B 
								WHERE A.NOMOR_POLIS = B.prefixpertanggungan||nopertanggungan AND A.TRX_TYPE='R'
								AND A.ST_PROSES='9' AND DESCRIPTION LIKE 'TRANS%' AND A.KODE_FUND LIKE '%$prodXORB%$kdfund' 
								AND TO_CHAR(TGL_VERIFIKASI,'DD/MM/YYYY')= '$tglawalInd'";
				
				}
				else{
					$query = "SELECT A.*, (SELECT NAMAKLIEN1 FROM TABEL_100_KLIEN WHERE NOKLIEN=B.NOTERTANGGUNG) NAMA  
								FROM TABEL_UL_TRANSAKSI A, TABEL_200_PERTANGGUNGAN B 
								WHERE A.NOMOR_POLIS = B.prefixpertanggungan||nopertanggungan AND A.TRX_TYPE='R' 
								AND A.ST_PROSES='9' AND DESCRIPTION LIKE 'TRANS%' AND A.KODE_FUND LIKE '%$prodXORB%$kdfund' 
								AND TO_CHAR(TGL_VERIFIKASI,'DD/MM/YYYY')= '$tglawalInd' AND A.KDRAYONPENAGIH='$kantor'";
				}
				
				$DB->parse($query);
				$temp = $DB->execute();

				$i = 1;
				
				//$jml = count($DB->nextrow());
								//print $query;
				//if($jml > 1) {
					while ($arr = $DB->nextrow()) {
						echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
						echo '<td align="center">'.$i."</td>";
						echo "<td>".$arr["NOMOR_POLIS"]."</td>";
						echo "<td>".$arr["NAMA"]."</td>";
						echo '<td>'.$arr["NO_REK"]."</td>";
						echo '<td>'.$arr["PEMILIK_REK"]."</td>";
						echo '<td>'.$arr["NAMA_BANK"]."</td>";
						echo '<td align="right">'.number_format($arr["RP_GROSS"],2,",",".").'</td>';
						echo '<td align="right">'.number_format($arr["BIAYA"],2,",",".").'</td>';
						echo '<td align="right">'.number_format($arr["FEE_REDEMPTION"],2,",",".").'</td>';
						echo '<td align="right">0</td>';
						echo '<td align="right">'.number_format($arr["RP_NETT"],2,",",".").'</td>';
						
						$parameterCetak = "nopol=".$arr["NOMOR_POLIS"]."&kdtranscab=".$kodeTransCabang."&tgl=".$tglawalInd."&akunDebet=".$akunDebit."&akunKredit=".$akunKredit."&nominal=".$arr["RP_NETT"]."&kantor=".$kantor."&produk=".$kdproduk."&nama=".$nama;
						echo "<td align='center'>" ?> <a href="#" onclick="window.open('../akunting/cetakslip_red_ulink_all.php?<?=$parameterCetak?>','','width=800,height=600,top=100,left=100,scrollbars=yes')">Cetak</a> <? "</td>";
						echo "</tr>";
						$i++;
					}		
					
					$query = str_replace(
					"A.*, (SELECT NAMAKLIEN1 FROM TABEL_100_KLIEN WHERE NOKLIEN=B.NOTERTANGGUNG) NAMA",
					"SUM(A.RP_GROSS) TGROSS, SUM(A.BIAYA) TBIAYA, SUM(A.FEE_REDEMPTION) TFEE, SUM(A.RP_NETT) TNETT",
					$query);
					
					$DB->parse($query);
					$DB->execute();
					$arr = $DB->nextrow();

					echo "<tr bgcolor=#89acd8>";
					echo "<td align='center' colspan=6><b>TOTAL</b></td>";
					echo '<td align="right">'.number_format($arr["TGROSS"],2,",",".").'</td>';
					echo '<td align="right">'.number_format($arr["TBIAYA"],2,",",".").'</td>';
					echo '<td align="right">'.number_format($arr["TFEE"],2,",",".").'</td>';
					echo '<td align="right">0</td>';
					echo '<td align="right">'.number_format($arr["TNETT"],2,",",".").'</td>';
					echo '<td></td>';
					echo "</tr>";
				/*}
				else {
					echo "<tr bgcolor=#89acd8>";
					echo "<td align='center' colspan=11><b>Tidak Ada Data</b></td>";
					echo "</tr>";
				}*/
				
				print "</table>";
				
				$tNett = $arr["TNETT"];
			}
		?>
	</table>
	
	<?php
		if ($mode!='print')
		{
			echo("<font face=Verdana size=1><a href=\"#\" onclick=\"window.open('daftar_sentralisasi_klaim_ulink.php?kdkantor=".$kdkantor."&dtgl=".$dtgl."&dbln=".$dbln."&dthn=".$dthn."&kdproduk=".$kdproduk."&mode=print','','width=1000,height=600,top=100,left=100,scrollbars=yes');\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak</a></font>");
			echo "&nbsp;&nbsp;";
			echo("<font face=Verdana size=1><a href=\"#\" onclick=\"window.open('../akunting/cetakslip_red_ulink_all.php?nopol=&kdtranscab=".$kodeTransCabang."&tgl=".$tglawalInd."&akunDebet=".$akunDebit."&akunKredit=".$akunKredit."&nominal=".$tNett."&kantor=".$kantor."&produk=".$kdproduk."','','width=800,height=600,top=100,left=100,scrollbars=yes');\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak SIP</a></font>");
		}
	?>
</body>
</html>
