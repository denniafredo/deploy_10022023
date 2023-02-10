<?php
	include "../../includes/common.php";
	include "../includes/database.php";
	include "../includes/session.php";
	
	$DB = new Database($userid,$passwd,$DBName);

	
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
			<td>: LD00100</td>
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

		$sql_p = "SELECT NAMAPRODUK FROM $DBUser.TABEL_202_PRODUK WHERE KDPRODUK = '".$kdproduk."'";
		$DB->parse($sql_p);
		$DB->execute();
		$arr_p=$DB->nextrow();

					
		$sqltotal= "SELECT a.notrans, 
						--SUM(a.kredit) kredit, 
						(SUM(a.kredit) - SUM(a.debet)) kredit,
						TO_CHAR(a.tgl_trans, 'dd-mm-yyyy') tgl_trans
					FROM tabel_802_trvouc@gllink a
					INNER JOIN tabel_802_kodeakun@gllink b ON a.akun = b.akun 
					WHERE kdkantor = 'KP'
						AND UPPER(a.KET) LIKE '%".$arr_p["NAMAPRODUK"]."%'
						AND a.NOTRANS = 'LD00100'
						--AND TO_DATE(kdtrans, 'yyyymmdd') BETWEEN TO_DATE('$tglawal','yyyymmdd') AND TO_DATE('$tglakhir','yyyymmdd')
						AND kdtrans BETWEEN '$tglawal' AND '$tglakhir'
						AND A.AKUN IN (SELECT AKUN FROM $DBUser.TABEL_UL_JURNAL_TEMPLATE WHERE KDPRODUK IN ('JL4B', 'JL4X'))
						AND A.NOTRANS LIKE 'LD%'
					GROUP BY a.notrans, TO_CHAR(a.tgl_trans,'dd-mm-yyyy')";
		$DB->parse($sqltotal);
		$DB->execute();
		$arrt=$DB->nextrow();

	?>

	<table border="0" style="border-collapse: collapse" width="90%" id="table2" cellpadding="2" cellspacing="2">
		<tr>
			<td width="13%">Diterima Dari</td>
			<td>: REDEMPTION COA COI COR</td>
		</tr>

		<tr>
			<td>Uang Sejumlah</td>
			<td>: <?=number_format($arrt["KREDIT"],2,',','.');?></td>
		</tr>

		<tr>
			<td>Terbilang</td>
			<td>: 
				<?php 
					echo terbilang($arrt["KREDIT"]);
					$nilai_desimal = strstr($arrt["KREDIT"],".") * 100;

					echo " ".$nilai_desimal."/100";
				?>
			</td>
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
					AND UPPER(a.KET) LIKE '%".$arr_p["NAMAPRODUK"]."%'
					AND a.NOTRANS = 'LD00100'
					AND TO_DATE(kdtrans, 'yyyymmdd') BETWEEN TO_DATE('$tglawal','yyyymmdd') AND TO_DATE('$tglakhir','yyyymmdd')
					AND A.AKUN IN (SELECT AKUN FROM $DBUser.TABEL_UL_JURNAL_TEMPLATE WHERE KDPRODUK IN ('JL4B', 'JL4X'))
					AND A.NOTRANS LIKE 'LD%'
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