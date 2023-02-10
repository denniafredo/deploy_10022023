<?
	include "../../includes/common.php";
	include "../includes/database.php";
	include "../includes/session.php";

	$DB=new Database($userid,$passwd,$DBName);
	$DBN=new Database($userid,$passwd,$DBName);

	function DateSelector($inName, $useDate=0) { 
		if($useDate == 0) {
			$useDate = Time();
		}
  
		// Tanggal
		$selected = (isset($_POST[$inName.'tgl']) && $_POST[$inName.'tgl']!='') ? $_POST[$inName.'tgl'] : date( "j", $useDate);
		print("<select name=".$inName."tgl>\n");
		for($currentDay=1;$currentDay<=31;$currentDay++) { 
			print("<option value=\"$currentDay\""); 
			if($selected==$currentDay) { 
				print(" selected"); 
			}
			print(">$currentDay\n");
		} 
		print("</select>");
  
		// Bulan
		$selected = (isset($_POST[$inName.'bln']) && $_POST[$inName.'bln']!='') ? $_POST[$inName.'bln'] : date( "n", $useDate);
		print("<select name=".$inName."bln>\n");
		for($currentMonth=1;$currentMonth<=12;$currentMonth++) {
			switch($currentMonth) {
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
			
			if($selected==$currentMonth) { 
				print(" selected"); 
			}
			
			print(">$namabulan\n");
		}
		print("</select>"); 
  
		// Tahun
		$selected	= (isset($_POST[$inName.'thn']) && $_POST[$inName.'thn']!='') ? $_POST[$inName.'thn'] : date( "Y", $useDate);
		print("<select name=" . $inName .  "thn>\n"); 
		$startYear = date( "Y", $useDate); 
		for($currentYear = 2003; $currentYear <= $startYear+0;$currentYear++) { 
			print("<option value=\"$currentYear\""); 
			
			if($selected==$currentYear) { 
				print(" selected"); 
			} 
			
			print(">$currentYear\n");
		}
		print("</select>"); 
	}
	
	$tglawal = $tglawal ? $tglawal : $dthn.(strlen($dbln)>1?$dbln:"0$dbln").(strlen($dtgl)>1?$dtgl:"0$dtgl");
	$tglakhir = $tglakhir ? $tglakhir : $sthn.(strlen($sbln)>1?$sbln:"0$sbln").(strlen($stgl)>1?$stgl:"0$stgl");

	
?>

<html>
<title>Pelunasan Premi</title>
<head>
	<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
	<script LANGUAGE="JavaScript">
		function Polis(theForm) {
			var p=theForm.prefix.value;
			var n=theForm.noper.value;
			if (!n =='') { 
				NewWindow('../../polis/polis.php?prefix='+p+'&noper='+n+'','kartupremi',700,600,1)
			}
		}
		function checkAll(source) {
			checkboxes = document.getElementsByName('chkvalidasi[]');
			for(var i=0, n=checkboxes.length;i<n;i++) {
				checkboxes[i].checked = source.checked;
			}
		}
	</script>
	<style type="text/css">
		<!-- 
		body { font-family: tahoma,verdana,geneva,sans-serif; font-size: 12px; }
		td, th { font-family: tahoma,verdana,geneva,sans-serif; font-size: 11px; }
		input { font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-width: .2em;border-width: .2em;color:333333; }
		select { font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em; }
		textarea { font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em; }
		a { color:#259dc5; text-decoration:none; }
		a:hover { color:#cc6600; }
		-->
	</style>
</head>

<body>
	<h4>Daftar Setoran Premi PP</h4>

	<?php if (!$print) { ?>
		<form action="<? $PHP_SELF; ?>" method="post">
			<table cellpadding="1" cellspacing="2" border="0">
			<tr>
				<td align="left">Tgl. Transaksi Dari</td>
				<td>:</td>
				<td><?DateSelector("d");?></td>
				<td align="left">Sampai</td>
				<td>:</td>
				<td><?DateSelector("s");?></td>
			</tr>
			<tr>
				<td>Jenis</td>
				<td>:</td>
				<td colspan="4">
					<select name="kdchannel" onFocus="highlight(event)" class="c">
						<option value="X" selected>-- Pilih Jenis Channel Pelunasan --</option>
						<?php
							$sqluser = "SELECT KDCHANNEL, NAMACHANNEL, KETERANGAN, NOMORBD FROM $DBUser.TABEL_802_SLIP_TEMPLATE ORDER BY KDCHANNEL";
							$DB->parse($sqluser);
							$DB->execute();
							while ($arru=$DB->nextrow()) {

								if($kdchannel == $arru['KDCHANNEL']){
									$selected = 'selected';
								}else{
									$selected = '';
								}
								echo "<option value='".$arru['KDCHANNEL']."' ".$selected.">".$arru['NAMACHANNEL']."</option>";
							}
							?>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="6" align="left"><input name="cari" value="Cari" type="submit"></td>
			</tr>
			</table>
		</form>
	<?php } ?>
	


	<hr size="1">
	<form action="<? $PHP_SELF; ?>" method="post">
		<input type='hidden' name='dtgl' value='<?=$dtgl?>' />
		<input type='hidden' name='dbln' value='<?=$dbln?>' />
		<input type='hidden' name='dthn' value='<?=$dthn?>' />
		<input type='hidden' name='stgl' value='<?=$stgl?>' />
		<input type='hidden' name='sbln' value='<?=$sbln?>' />
		<input type='hidden' name='sthn' value='<?=$sthn?>' />
		<table border="0" width="100%" cellspacing="1" cellpadding="2">
			<thead>
				<tr bgcolor="#7dc2d9" align="center">
					<th height="20">No</th>
					<th>KDKANTOR</th>
					<th>KDTRANS</th>
					<th>NOTRANS</th>
					<th>AKUN</th>
					<th>NAMA AKUN</th>
					<th>KETERANGAN (POLIS)</th>
					<th bgcolor="#C2CAED">NILAI</th>
				</tr>
			</thead>
			<tbody>
				<?
					if($kdchannel == 'X' || empty($kdchannel)){
						$sql = "";
						// echo "Silahkan Pilih Jenis Channel Pelunasan terlebih dahulu!";
					}else{
						$sql = "SELECT
								A.KDKANTOR,
								A.KDTRANS,
								A.NOTRANS,
								A.AKUN,
								/*
								A.DEBET,
								CASE 
									WHEN A.DEBET > 0 THEN A.DEBET 
									ELSE A.KREDIT
								END NILAI,
								*/
								(SUM(a.kredit) - SUM(a.debet)) NILAI,
								SUBSTR(a.ket, 1, 15) || CASE WHEN d.idtransaksi IS NOT NULL THEN ' - ' || d.idtransaksi ELSE NULL END KET, 
								B.NAMA
							FROM tabel_802_trvouc@gllink a
							INNER JOIN tabel_802_kodeakun@gllink b ON a.akun = b.akun
							LEFT OUTER JOIN $DBUser.tabel_200_pertanggungan c ON SUBSTR(a.ket, 1, 15) = c.nopolbaru
							LEFT OUTER JOIN $DBUser.tabel_200_temp_digital d ON c.prefixpertanggungan = d.prefixpertanggungan
								AND c.nopertanggungan = d.nopertanggungan
							WHERE kdkantor = 'KP' 
								AND notrans = (SELECT NOMORBD FROM $DBUser.TABEL_802_SLIP_TEMPLATE WHERE KDCHANNEL = '".$kdchannel."')
								--AND TO_DATE (kdtrans, 'yyyymmdd') BETWEEN TO_DATE ('".$tglawal."','yyyymmdd') AND TO_DATE ('".$tglakhir."','yyyymmdd')
								AND kdtrans BETWEEN '".$tglawal."' AND '".$tglakhir."'
								AND SUBSTR (a.akun, 1, 1) <> '3'
								AND SUBSTR (a.akun, 1, 3) <> '148'
								AND a.akun NOT IN ('122100000')
							GROUP BY A.KDKANTOR, A.KDTRANS, A.NOTRANS, A.AKUN, SUBSTR(a.ket, 1, 15), d.idtransaksi, B.NAMA";
					}
					// echo $sql;
					$DB->parse($sql);
					$DB->execute();
					$i=1;
					$jumlah_polis = 0;
					$jumlah_nilai = 0;
					while ($arr=$DB->nextrow()) {
						echo "<tr align='center'>";
						echo "<td>$i</td>";
						echo "<td>".$arr["KDKANTOR"]."</td>";
						echo "<td>".$arr["KDTRANS"]."</td>";
						echo "<td>".$arr["NOTRANS"]."</td>";
						echo "<td>".$arr["AKUN"]."</td>";
						echo "<td>".$arr["NAMA"]."</td>";
						echo "<td>".$arr["KET"]."</td>";
						echo "<td align=right>".number_format($arr["NILAI"],2,",",".")."</td>";
						echo "</tr>";

						$jumlah_nilai = $jumlah_nilai + $arr["NILAI"];
						$i++; 	
					}
				?>
			</tbody>
			<thead>
				<tr bgcolor="#f5d79c" style="height:30px;">
					<th colspan="7">TOTAL</th>
					<th align="right"><?=number_format($jumlah_nilai,2,",",".");?></th>
				</tr>
			</thead>
		</table>
	</form>

	<?php if (!$print) { ?>
		 <a href="javascript:void(0);" onclick="window.open('<?="cetak_slip_pelunasan_premi.php?tglawal=$tglawal&tglakhir=$tglakhir&kdchannel=$kdchannel"?>','','width=1000,height=600,top=100,left=100,scrollbars=yes');"><img src="../img/cetak.gif" align="absmiddle" border="0"> Cetak SLIP</a>
		<a href="javascript:void(0);" onclick="window.open('<?="cetak_lampiran_slip_pelunasan_premi.php?tglawal=$tglawal&tglakhir=$tglakhir&kdchannel=$kdchannel"?>','','width=1000,height=600,top=100,left=100,scrollbars=yes');"><img src="../img/cetak.gif" align="absmiddle" border="0"> Cetak Lampiran</a>
	<?php } ?>
</body>
</html>
