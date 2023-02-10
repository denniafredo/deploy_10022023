<?php
	include "../../includes/common.php";
	include "../includes/database.php";
	include "../includes/session.php";
	
	$DB = new Database($userid,$passwd,$DBName);

	$sqluser = "SELECT KDCHANNEL, NAMACHANNEL, KETERANGAN, NOMORBD FROM $DBUser.TABEL_802_SLIP_TEMPLATE WHERE KDCHANNEL = '".$kdchannel."'";
	$DB->parse($sqluser);
	$DB->execute();
	$arru=$DB->nextrow();

	
	function kata($x) {
	    $x = abs($x);
	    $angka = array("", "satu", "dua", "tiga", "empat", "lima",
	    "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
	    $temp = "";
	    if ($x <12) {
	        $temp = " ". $angka[$x];
	    } else if ($x <20) {
	        $temp = kata($x - 10). " belas";
	    } else if ($x <100) {
	        $temp = kata($x/10)." puluh". kata($x % 10);
	    } else if ($x <200) {
	        $temp = " seratus" . kata($x - 100);
	    } else if ($x <1000) {
	        $temp = kata($x/100) . " ratus" . kata($x % 100);
	    } else if ($x <2000) {
	        $temp = " seribu" . kata($x - 1000);
	    } else if ($x <1000000) {
	        $temp = kata($x/1000) . " ribu" . kata($x % 1000);
	    } else if ($x <1000000000) {
	        $temp = kata($x/1000000) . " juta" . kata($x % 1000000);
	    } else if ($x <1000000000000) {
	        $temp = kata($x/1000000000) . " milyar" . kata(fmod($x,1000000000));
	    } else if ($x <1000000000000000) {
	        $temp = kata($x/1000000000000) . " trilyun" . kata(fmod($x,1000000000000));
	    }     
	        return $temp;
	}

	function terbilang($x, $style=3) {
	    if($x<0) {
	        $hasil = "minus ". trim(kata($x));
	    } else {
	        $hasil = trim(kata($x));
	    }     
	    switch ($style) {
	        case 1:
	            // mengubah semua karakter menjadi huruf besar
	            $hasil = strtoupper($hasil);
	            break;
	        case 2:
	            // mengubah karakter pertama dari setiap kata menjadi huruf besar
	            $hasil = ucwords($hasil);
	            break;
	        case 3:
	            // mengubah karakter pertama menjadi huruf besar
	            $hasil = ucfirst($hasil);
	            break;
	    }     
	    return $hasil;
	}
?>

<html>
	<head>
		<title>Slip Setoran Premi PP</title>
		
		<style type="text/css">
		<!-- 
			body{font-size: 12px;} 
			td{font-size: 12px;}
		-->
		</style>
	</head>

	<body><!-- onLoad="window.print();window.close()">-->

	<div align="center">

		<table border="0" style="border-collapse: collapse" width="90%" id="table1" cellpadding="2">
			<tr>
				<td colspan="5">PT. ASURANSI JIWA IFG <br>KANTOR PUSAT</td>
			</tr>
			<tr>
				<td width="10%">&nbsp;</td>
				<td width="10%">&nbsp;</td>
				<td width="60%">&nbsp;</td>
				<td width="5%" align="left"><p>ASLI</td>
				<td>&nbsp;</td>
			</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td align="left"><p>NOMOR</td>
			<td>: <?=$arru["NOMORBD"];?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td align="left"><p>TANGGAL</td>
			<td>: 
				<?php 
					$tahunnya = substr($tglakhir,0,4);
					$bulnanya = substr($tglakhir,4,2);
					$tanggalnya = substr($tglakhir,-2);
			
					echo $tanggalnya."/".$bulnanya."/".$tahunnya;
				?>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="5" align="center"><p><b>
				SLIP SETORAN PREMI PP</b><br>&nbsp;
			</td>
		</tr>
	</table>
	
	<br />


	<?php
		$sqltotal= "SELECT a.notrans, 
						--SUM(a.kredit) kredit, 
						(SUM(a.kredit) - SUM(a.debet)) kredit,
						--TO_CHAR(a.tgl_trans, 'dd-mm-yyyy') tgl_trans
						TO_DATE(a.kdtrans, 'yyyymmdd') tgl_trans
					FROM tabel_802_trvouc@gllink a
					INNER JOIN tabel_802_kodeakun@gllink b ON a.akun = b.akun 
					WHERE kdkantor = 'KP'
						AND notrans = (SELECT NOMORBD FROM $DBUser.TABEL_802_SLIP_TEMPLATE WHERE KDCHANNEL = '".$kdchannel."')
						--AND TO_DATE(kdtrans, 'yyyymmdd') BETWEEN TO_DATE('$tglawal','yyyymmdd') AND TO_DATE('$tglakhir','yyyymmdd')
						AND kdtrans BETWEEN '$tglawal' AND '$tglakhir'
						AND SUBSTR (a.akun, 1, 1) <> '3'
						AND SUBSTR (a.akun, 1, 3) <> '148'
						AND a.akun NOT IN ('122100000')
						--AND a.kdtabel != '88'
					GROUP BY a.notrans, a.kdtrans";
		$DB->parse($sqltotal);
		$DB->execute();
		$arrt=$DB->nextrow();

	?>

	<table border="0" style="border-collapse: collapse" width="90%" id="table2" cellpadding="2" cellspacing="2">
		<tr>
			<td width="13%">Diterima Dari</td>
			<td>: <?=$arru["KETERANGAN"];?></td>
		</tr>

		<tr>
			<td>Uang Sejumlah</td>
			<td>: <?=number_format($arrt["KREDIT"],2,',','.');?></td>
		</tr>

		<tr>
			<td>Terbilang</td>
			<td>: <?php echo terbilang($arrt["KREDIT"]);?></td>
		</tr>
	</table>

	<br />

	<table border="0" style="border-collapse: collapse" width="90%" id="table2" cellpadding="8" cellspacing="8">
		<tr>
			<td align="center" style="border: 1px solid #000000" width="2%"><b>NO</b></td>
			<td align="center" style="border: 1px solid #000000"><b>KETERANGAN AKUN</b></td>
			<td align="center" style="border: 1px solid #000000" width="15%"><b>KODE AKUN</b></td>
			<td align="center" style="border: 1px solid #000000" width="15%"><b>JUMLAH</b></td>
		</tr>
		<?php
		$sql = "SELECT b.nama, 
					a.akun, 
					SUM(
						CASE 
							WHEN SUBSTR(a.akun,1,3) = '123' 
							THEN 0 ELSE a.debet 
						END
					) debet, 
					--SUM(a.kredit) kredit, 
					(SUM(a.kredit) - SUM(a.debet)) kredit,
					TO_CHAR(a.tgl_trans, 'dd-mm-yyyy') tgl_trans
				FROM tabel_802_trvouc@gllink a
				INNER JOIN tabel_802_kodeakun@gllink b ON a.akun = b.akun
				WHERE kdkantor = 'KP'
					AND notrans = (SELECT NOMORBD FROM $DBUser.TABEL_802_SLIP_TEMPLATE WHERE KDCHANNEL = '".$kdchannel."')
					--AND TO_DATE(kdtrans, 'yyyymmdd') BETWEEN TO_DATE('$tglawal','yyyymmdd') AND TO_DATE('$tglakhir','yyyymmdd')
					AND kdtrans BETWEEN '$tglawal' AND '$tglakhir'
					AND SUBSTR (a.akun, 1, 1) <> '3'
					AND SUBSTR (a.akun, 1, 3) <> '148'
					AND a.akun NOT IN ('122100000')
				GROUP BY b.nama, a.akun, TO_CHAR(a.tgl_trans,'dd-mm-yyyy')
				ORDER BY a.akun";
		// echo $sql;
		$DB->parse($sql);
		$DB->execute();
	  
		$i=1;
		$kredit = 0;
		while ($arr=$DB->nextrow()) { ?>
			<tr>
				<td align="center" style="border-left:1px solid #000000"><?=$i;?></td>
				<td style="border-left:1px solid #000000"><?=$arr['NAMA'];?></td>
				<td align="center" style="border-left:1px solid #000000"><?=$arr["AKUN"];?></td>
				<td align="right" style="border-left:1px solid #000000;border-right:1px solid #000000"><?=number_format($arr["KREDIT"],2,',','.');?></td>
			</tr>
			<?php $i++;
			$kredit += $arr['KREDIT'];
		} ?>
		<tr>
			<td align="center" colspan="3" style="border: 1px solid #000000">TOTAL</td>
			<td style="border: 1px solid #000000" align="right"><?=number_format($kredit,2,',','.');?></td>            
		</tr>
	</table>
	
	<br />
	
	<table border="0" style="border-collapse: collapse" width="90%" id="table3" cellpadding="4">
		<tr>
			<td width="37%" align="center">Diketahui Oleh,</td>
			<td width="37%" align="center">Penyetor,</td>
			<td width="26%" align="center">Diterima Oleh,</td>
		</tr>
      
		<tr>
			<td align="center">&nbsp;<p><?=@$diketahui?strtoupper(strtolower(@$diketahui)):"POS"?></td>
			<td align="center">&nbsp;<p></td>
			<td align="center">&nbsp;<p>FINANCE</td>
		</tr>
	</table>
	
</div>

</body>
</html>