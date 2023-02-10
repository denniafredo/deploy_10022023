<?php

/*
DESKRIPSI:
FORM INI UNTUK MENAMPILKAN DAFTAR TRANSAKSI REDEMPTION COA+COI+COR JL4.
*/

include "../../includes/session.php"; 
include "../../includes/database.php";
include "../../includes/kantor.php"; 
include "../../includes/klien.php";

//$userid = 'JSADM';
//$passwd = 'JSADMOKE';

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
<title>Data Redemption COA COI COR</title>
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
				<select name="produk">
					<option value="JL4">JL4</option>
				</select>
			</td>
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
		</tr>
		<tr>
			<td>Dari</td><td><?=DateSelector("d"); ?></td><td>Sampai</td><td><?=DateSelector("s"); ?></td>
			<td colspan="2"><input type="submit" name="submit" value="Cari"</input></td>
		</tr>
	</table>
</form>
</div>
<?
}
?>
	<b>DAFTAR TRANSAKSI REDEMPTION COA COI COR JL4<br /> </b>
	<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
	<tr>
		<td bgcolor="#89acd8" align="center">No.</td>
		<td bgcolor="#89acd8" align="center">No. Polis</td>
		<td bgcolor="#89acd8" align="center">Nama Pemb. Polis</td>
		<td bgcolor="#89acd8" align="center">Tgl. Transaksi</td>
		<td bgcolor="#89acd8" align="center">Tgl. Booked</td>
		<td bgcolor="#89acd8" align="center">Jml (Rp)</td>
		<td bgcolor="#89acd8" align="center">Tgl. NAB</td>
		<td bgcolor="#89acd8" align="center">NAB</td>		
		<td bgcolor="#89acd8" align="center">Unit</td>
		<td bgcolor="#89acd8" align="center">Deskripsi</td>
		<td bgcolor="#89acd8" align="center">Kode Fund</td>
	</tr>
		<?php		
			
			/*$tglawal .= $_POST["dthn"];
			$tglawal .= ((strlen($_POST["dbln"])==1) ? '0'.$_POST["dbln"] : $_POST["dbln"]);
			$tglawal .= ((strlen($_POST["dtgl"])==1) ? '0'.$_POST["dtgl"] : $_POST["dtgl"]);
			
			$tglakhir .= $_POST["sthn"];
			$tglakhir .= ((strlen($_POST["sbln"])==1) ? '0'.$_POST["sbln"] : $_POST["sbln"]);
			$tglakhir .= ((strlen($_POST["stgl"])==1) ? '0'.$_POST["stgl"] : $_POST["stgl"]);
			
			$kodeKantor = $_POST["kdkantor"];*/
			
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
			
			$i=1;
			
			if($kodeKantor == "ALL")
			{
				$sql = "SELECT A.NOMOR_POLIS, (SELECT NAMAKLIEN1 FROM TABEL_100_KLIEN WHERE NOKLIEN = B.NOPEMEGANGPOLIS)NAMAKLIEN,".
						"A.TRX_DATE, A.TGL_BOOKED, A.RP_NETT, A.TGL_NAB, A.NAB_JUAL, A.UNIT, A.DESCRIPTION, A.KODE_FUND ".
						"FROM TABEL_UL_TRANSAKSI A, TABEL_200_PERTANGGUNGAN b WHERE ".
						"B.PREFIXPERTANGGUNGAN||B.NOPERTANGGUNGAN = A.NOMOR_POLIS AND ".
						"A.trx_type='R' AND A.description LIKE 'Redemption%' AND ".
						"trx_date >= to_date('" .$tglawal. "','YYYYMMDD') AND trx_date <= to_date('" .$tglakhir. "','YYYYMMDD') ".
						"ORDER BY trx_date DESC, nomor_polis ASC, kode_fund";
				
			}
			else
			{
				$sql = "SELECT A.NOMOR_POLIS, (SELECT NAMAKLIEN1 FROM TABEL_100_KLIEN WHERE NOKLIEN = B.NOPEMEGANGPOLIS)NAMAKLIEN,".
						"A.TRX_DATE, A.TGL_BOOKED, A.RP_NETT, A.TGL_NAB, A.NAB_JUAL, A.UNIT, A.DESCRIPTION, A.KODE_FUND ".
						"FROM TABEL_UL_TRANSAKSI A, TABEL_200_PERTANGGUNGAN b WHERE ".
						"B.PREFIXPERTANGGUNGAN||B.NOPERTANGGUNGAN = A.NOMOR_POLIS AND ".
						"A.trx_type='R' AND A.description LIKE 'Redemption%' /*AND A.status='GOOD FUND'*/ AND ".
						"trx_date >= to_date('" .$tglawal. "','YYYYMMDD') AND trx_date <= to_date('" .$tglakhir. "','YYYYMMDD') ".
						"AND substr(A.NOMOR_POLIS, 1, 2) = '" .$kodeKantor. "' ORDER BY trx_date DESC, nomor_polis ASC, kode_fund";
			}
			//echo $sql;
			$DB->parse($sql);
			$DB->execute();
			
			while($arr = $DB->nextrow())
			{
				echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
				echo '<td align="center">'.$i."</td>";
				echo "<td>".$arr["NOMOR_POLIS"]."</td>";
				echo "<td>".$arr["NAMAKLIEN"]."</td>";
				echo '<td align="center">'.$arr["TRX_DATE"]."</td>";
				echo '<td align="center">'.$arr["TGL_BOOKED"]."</td>";
				echo '<td align="right">'.number_format($arr["RP_NETT"],2,",",".")."</td>";
				echo '<td align="center">'.$arr["TGL_NAB"]."</td>";
				echo '<td align="right">'.number_format($arr["NAB_JUAL"],2,",",".")."</td>";
				echo '<td align="right">'.$arr["UNIT"]."</td>";
				echo "<td>&nbsp;&nbsp;".$arr["DESCRIPTION"]."</td>";
				echo '<td align="center">'.$arr["KODE_FUND"]."</td>";
				echo "</tr>";
				
				$i++;
			}
			
			//=================================================
			//Hitung total COA, COI, dan COR
			//=================================================
			if($kodeKantor == "ALL")
			{
				/*$q_total = "select ".
							  "sum(case when description like '%COI%' then rp_nett else 0 end) as T_COI,".
							  "sum(case when description like '%COA%' then rp_nett else 0 end) as T_COA,".
							  "sum(case when description like '%COR%' then rp_nett else 0 end) as T_COR ".
							"from tabel_ul_transaksi ".
							"where ".
							  "trx_type='R' AND description LIKE 'Redemption%' AND ".
							  "trx_date >= to_date('".$tglawal."','YYYYMMDD') AND trx_date <= to_date('".$tglakhir."','YYYYMMDD') ";*/
							  
				$q_total = "select sum(case when description like '%COI%' and substr(kode_fund,4,1) = 'B' then rp_nett else 0 end) as T_COI_B,".
				"sum(case when description like '%COI%' and substr(kode_fund,4,1) = 'X' then rp_nett else 0 end) as T_COI_X,".
				"sum(case when description like '%COA%' and substr(kode_fund,4,1) = 'B' then rp_nett else 0 end) as T_COA_B,".
				"sum(case when description like '%COA%' and substr(kode_fund,4,1) = 'X' then rp_nett else 0 end) as T_COA_X, ".
				"sum(case when description like '%COR%' then rp_nett else 0 end) as T_COR ".
				"from tabel_ul_transaksi where ".
				"trx_type='R' AND description LIKE 'Redemption%' AND ".
				"trx_date >= to_date('" .$tglawal. "','YYYYMMDD') AND trx_date <= to_date('" .$tglakhir. "','YYYYMMDD')";			  
			}
			else
			{
				/*$q_total = "select ".
							  "sum(case when description like '%COI%' then rp_nett else 0 end) as T_COI,".
							  "sum(case when description like '%COA%' then rp_nett else 0 end) as T_COA,".
							  "sum(case when description like '%COR%' then rp_nett else 0 end) as T_COR ".
							"from tabel_ul_transaksi ".
							"where ".
							  "trx_type='R' AND description LIKE 'Redemption%' AND ".
							  "trx_date >= to_date('".$tglawal."','YYYYMMDD') AND trx_date <= to_date('".$tglakhir."','YYYYMMDD') ".
							  "AND substr(NOMOR_POLIS, 1, 2) = '" .$kodeKantor. "'"; */
							  
				$q_total = "select sum(case when description like '%COI%' and substr(kode_fund,4,1) = 'B' then rp_nett else 0 end) as T_COI_B,".
				"sum(case when description like '%COI%' and substr(kode_fund,4,1) = 'X' then rp_nett else 0 end) as T_COI_X,".
				"sum(case when description like '%COA%' and substr(kode_fund,4,1) = 'B' then rp_nett else 0 end) as T_COA_B,".
				"sum(case when description like '%COA%' and substr(kode_fund,4,1) = 'X' then rp_nett else 0 end) as T_COA_X, ".
				"sum(case when description like '%COR%' then rp_nett else 0 end) as T_COR ".
				"from tabel_ul_transaksi ".
				"where ".
				  "trx_type='R' AND description LIKE 'Redemption%' AND ".
				  "trx_date >= to_date('".$tglawal."','YYYYMMDD') AND trx_date <= to_date('".$tglakhir."','YYYYMMDD') ".
				  "AND substr(NOMOR_POLIS, 1, 2) = '" .$kodeKantor. "'";
			}
			//echo $q_total;
			$DB->parse($q_total);
			$DB->execute();
			$hasil = $DB->nextrow();
			
			$t_COIB = $hasil["T_COI_B"];
			$t_COIX = $hasil["T_COI_X"];
			$t_COAB = $hasil["T_COA_B"];
			$t_COAX = $hasil["T_COA_X"];
			$t_COR = $hasil["T_COR"];
			
			//echo $t_COI." | " .$t_COA. " | " .$t_COR;
		?>
	</table>
	
	<?php
		if ($mode!='print')
		{
			//echo("<font face=Verdana size=1><a href=\"index.php\">Menu Pelaporan</a></font>");
			//echo("<font face=Verdana size=1>&nbsp;&nbsp;|&nbsp;&nbsp;</font>");
			echo("<font face=Verdana size=1><a href=\"#\" onclick=\"window.open('hasil_jl4_red_coacoi.php?kdkantor=".$kdkantor."&dtgl=".$dtgl."&dbln=".$dbln."&dthn=".$dthn."&stgl=".$stgl."&sbln=".$sbln."&sthn=".$sthn."&produk=".$produk."&mode=print','','width=1000,height=600,top=100,left=100,scrollbars=yes');\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak</a></font>");
			echo "&nbsp;&nbsp;";
			echo("<font face=Verdana size=1><a href=\"#\" onclick=\"window.open('../akunting/cetakslip_red_coacoicor.php?tgl=".$tglParse."&tcoib=".$t_COIB."&tcoix=".$t_COIX."&tcoax=".$t_COAX."&tcoab=".$t_COAB."&tcor=".$t_COR."','','width=800,height=600,top=100,left=100,scrollbars=yes');\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak SLIP</a></font>");
		}
	?>
</body>
</html>
