<?php
	include "../../includes/session.php"; 
	include "../../includes/database.php";
	$DB = new database($DBUser, $DBPass, $DBName);
?>
<!DOCTYPE html>
<html>
<head>
	<title>DETAIL DATA</title>
	<style type="text/css">
		body, html {
			height: 100%;
			width: 100%;
		}

		body {
			font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
		}
		tr.border_bottom td {
			border-bottom:1pt solid black;
		}
	</style>
</head>
<body>
	<table style="width: 90%; margin-left: 5%;border-collapse: collapse;">
		<tr bgcolor="#89acd8" align="center" height="50px">
			<th>NO</th>
			<th>NOMOR PROPOSAL</th>
			<th>NAMA PEMEGANG POLIS</th>
			<th>KODE PRODUK</th>
			<th>NAMA PRODUK</th>
			<th>JML UANG ASURANSI (Rp)</th>
			<th>CARA BAYAR</th>
			<th>TOTAL PREMI (Rp)</th>
			<th>MULAI ASURANSI</th>
		</tr>
		<?php
			if($bulan_cari == ''){
				$sendemail = "AND TO_CHAR(A.TGLSENDEMAIL, 'YYYY') = '$tahun_cari'";
			}else{
				$sendemail = "AND TO_CHAR(A.TGLSENDEMAIL, 'MMYYYY') = '$bulan_cari$tahun_cari'";
			}

			if($jenis_cari == 'LUNAS'){
				$kodepertanggungan = "AND A.KDPERTANGGUNGAN = '2'
										AND A.KDSTATUSFILE != '7'";
			}else if($jenis_cari == 'BELUM_LUNAS'){
				$kodepertanggungan = "AND A.KDPERTANGGUNGAN = '1' 
										AND A.KDSTATUSFILE = '1'
										AND A.PREFIXPERTANGGUNGAN||A.NOPERTANGGUNGAN IN (SELECT PREFIXPERTANGGUNGAN||NOPERTANGGUNGAN FROM $DBUser.TABEL_214_APPROVAL_PROPOSAL)";
			}else if($jenis_cari == 'BATAL'){
				$kodepertanggungan = "AND A.KDPERTANGGUNGAN = '1' 
										AND A.KDSTATUSFILE = '7'
										AND A.PREFIXPERTANGGUNGAN||A.NOPERTANGGUNGAN IN (SELECT PREFIXPERTANGGUNGAN||NOPERTANGGUNGAN FROM $DBUser.TABEL_214_APPROVAL_PROPOSAL)";
			}else if($jenis_cari == 'WAITING'){
				$kodepertanggungan = "AND A.KDPERTANGGUNGAN = '1'
										AND A.KDSTATUSFILE = '1'
										AND A.SUSPEND IS NULL
										AND A.KETERANGAN IS NULL
										AND A.PREFIXPERTANGGUNGAN||A.NOPERTANGGUNGAN NOT IN (SELECT PREFIXPERTANGGUNGAN||NOPERTANGGUNGAN FROM $DBUser.TABEL_214_APPROVAL_PROPOSAL)";
			}else if($jenis_cari == 'PENDING'){
				$kodepertanggungan = "AND A.KDPERTANGGUNGAN = '1'
										AND A.KDSTATUSFILE = '1'
										AND A.SUSPEND = '1'
                        				AND A.KETERANGAN IS NOT NULL";
			}

			$i = 1;
			$sql = "SELECT 
							A.PREFIXPERTANGGUNGAN||'-'||A.NOPERTANGGUNGAN AS NOMOR_POLIS,
							(SELECT NAMAKLIEN1 FROM $DBUser.TABEL_100_KLIEN WHERE NOKLIEN = A.NOPEMEGANGPOLIS) AS NAMA_PP,
							A.KDPRODUK,
							(SELECT NAMAPRODUK FROM $DBUser.TABEL_202_PRODUK WHERE KDPRODUK = A.KDPRODUK) AS NAMA_PRODUK,
							A.JUAMAINPRODUK,
							(SELECT NAMACARABAYAR FROM $DBUser.TABEL_305_CARA_BAYAR WHERE KDCARABAYAR = A.KDCARABAYAR) CARA_BAYAR,
							A.PREMI1,
							TO_CHAR(MULAS, 'DD/MM/YYYY') AS MULAS
					FROM $DBUser.TABEL_200_PERTANGGUNGAN A,
							$DBUser.TABEL_500_PENAGIH B,
							$DBUser.TABEL_001_KANTOR C,
							$DBUser.TABEL_400_PENANDATANGANAN_PKAJ D
					WHERE A.NOPENAGIH = B.NOPENAGIH
							AND B.KDRAYONPENAGIH = C.KDKANTOR
							AND C.KDKANTOR = D.KODE_KANTOR
							AND D.JABATAN_TTD = '".$rayon_cari."'
							AND D.JABATAN_AGEN = '00'
							".$kodepertanggungan."
							AND A.KDSTATUSEMAIL = '1' 
							".$sendemail."
							";
			//echo $sql;
			$DB->parse($sql);
			$DB->execute();
			while ($arr_d=$DB->nextrow()){
		?>
			<tr class="border_bottom" align="center">
				<td><?=$i;?></td>
				<td><?=$arr_d["NOMOR_POLIS"];?></td>
				<td><?=$arr_d["NAMA_PP"];?></td>
				<td><?=$arr_d["KDPRODUK"];?></td>
				<td><?=$arr_d["NAMA_PRODUK"];?></td>
				<td align="right"><?php echo(number_format($arr_d["JUAMAINPRODUK"],0,',','.'));?></td>
				<td><?=$arr_d["CARA_BAYAR"];?></td>
				<td align="right"><?php echo(number_format($arr_d["PREMI1"],0,',','.'));?></td>
				<td><?=$arr_d["MULAS"];?></td>
			</tr>
		<?php
				$i++;
			}
		?>
	</table>
</body>
</html>