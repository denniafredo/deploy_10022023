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
	<h4>Daftar Transaksi Redemption COA COI COR</h4>

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
				<td>Kode Produk</td>
				<td>:</td>
				<td colspan="4">
					<select name="kdproduk" onFocus="highlight(event)" class="c">
						<option value="X" selected>-- Pilih Kode Produk --</option>
						<?php
							$sqluser = "SELECT KDPRODUK, NAMAPRODUK FROM $DBUser.TABEL_202_PRODUK WHERE KDPRODUK IN ('JL4BLN', 'JL4XN')";
							$DB->parse($sqluser);
							$DB->execute();
							while ($arru=$DB->nextrow()) {

								if($kdproduk == $arru['KDPRODUK']){
									$selected = 'selected';
								}else{
									$selected = '';
								}
								echo "<option value='".$arru['KDPRODUK']."' ".$selected.">".$arru['NAMAPRODUK']."</option>";
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
					if($kdproduk == 'X' || empty($kdproduk)){
						$sql = "";
						// echo "Silahkan Pilih Jenis Channel Pelunasan terlebih dahulu!";
					}else{
						$sql_p = "SELECT NAMAPRODUK FROM $DBUser.TABEL_202_PRODUK WHERE KDPRODUK = '".$kdproduk."'";
						$DB->parse($sql_p);
						$DB->execute();
						$arr_p=$DB->nextrow();

						$sql = "SELECT
								A.KDKANTOR,
								A.KDTRANS,
								A.NOTRANS,
								A.AKUN,
								(SUM(a.kredit) - SUM(a.debet)) NILAI,
								SUBSTR(a.ket, 1, 15)KET, 
								B.NAMA
							FROM tabel_802_trvouc@gllink a
							LEFT JOIN tabel_802_kodeakun@gllink b ON a.akun = b.akun
							WHERE kdkantor = 'KP' 
								AND UPPER(a.KET) LIKE '%".$arr_p["NAMAPRODUK"]."%'
								AND a.NOTRANS = 'LD00100'
								--AND TO_DATE (kdtrans, 'yyyymmdd') BETWEEN TO_DATE ('".$tglawal."','yyyymmdd') AND TO_DATE ('".$tglakhir."','yyyymmdd')
								AND kdtrans BETWEEN '".$tglawal."' AND '".$tglakhir."'
								AND A.AKUN IN (SELECT AKUN FROM $DBUser.TABEL_UL_JURNAL_TEMPLATE WHERE KDPRODUK IN ('JL4B', 'JL4X'))
								AND A.NOTRANS LIKE 'LD%' 
							GROUP BY A.KDKANTOR, A.KDTRANS, A.NOTRANS, A.AKUN, SUBSTR(a.ket, 1, 15), B.NAMA";
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
		 <a href="javascript:void(0);" onclick="window.open('<?="cetak_slip_pelunasan_redemption.php?tglawal=$tglawal&tglakhir=$tglakhir&kdproduk=$kdproduk"?>','','width=1000,height=600,top=100,left=100,scrollbars=yes');"><img src="../img/cetak.gif" align="absmiddle" border="0"> Cetak SLIP</a>
		<a href="javascript:void(0);" onclick="window.open('<?="cetak_lampiran_slip_pelunasan_redemption.php?tglawal=$tglawal&tglakhir=$tglakhir&kdproduk=$kdproduk"?>','','width=1000,height=600,top=100,left=100,scrollbars=yes');"><img src="../img/cetak.gif" align="absmiddle" border="0"> Cetak Lampiran</a>
	<?php } ?>
</body>
</html>
