<?php
	include "../../includes/session.php"; 
	include "../../includes/database.php"; 
	include "../../includes/month_selector.php";
	include "../../includes/fungsi.php";
	
	$DB=new database($userid, $passwd, $DBName);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>Daftar Rincian Jatuh Tempo Benefit</title>
		<link href="../jws.css" rel="stylesheet" type="text/css">
		<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
	</head>
	
	<body>
		<a class="verdana10blk"><b>RINCIAN JATUH TEMPO</b></a>
		<hr size="1">
 
		<table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#006699" id="AutoNumber1">
			<tr>
				<td align="center" bgcolor="#00CCFF" class="verdana7blu"><b>NO PERTANGGUNGAN</b></td>
				<td align="center" bgcolor="#00CCFF" class="verdana7blu"><b>PEMEGANG POLIS</b></td>
				<td align="center" bgcolor="#00CCFF" class="verdana7blu"><b>MULAS</b></td>
				<td align="center" bgcolor="#00CCFF" class="verdana7blu"><b>BENEFIT</b></td>
				<td align="center" bgcolor="#00CCFF" class="verdana7blu"><b>VALUTA</b></td>
				<!--td align="center" bgcolor="#00CCFF" class="verdana7blu"><b>KURS/INDEKS</b></td-->
				<td align="center" bgcolor="#00CCFF" class="verdana7blu"><b>NILAI</b></td>
				<!--td align="center" bgcolor="#00CCFF" class="verdana7blu"><b>NILAI RP</b></td-->
				<td align="center" bgcolor="#00CCFF" class="verdana7blu"><b>BLN JT</b></td>
			</tr>
			
			<?php
			$status = strlen($kdstatus) > 0 ? "a.kdstatus LIKE '%$kdstatus%'" : "a.kdstatus IS NULL";
			$sql = "SELECT a.prefixpertanggungan, a.nopertanggungan, c.namaklien1, TO_CHAR(b.mulas, 'dd/mm/yyyy') mulas,
				a.kdbenefit, d.namabenefit, b.kdvaluta, e.namavaluta, a.nilaibenefit, a.blnjatuhtempo,
				CASE WHEN b.kdvaluta = '0' THEN 1800
                    WHEN b.kdvaluta = '1' THEN 1
                    WHEN b.kdvaluta = '3' THEN 13800
                END kursindeks
			FROM $DBUser.tabel_proyeksi_vs_bias a
			LEFT OUTER JOIN $DBUser.tabel_200_pertanggungan b ON a.prefixpertanggungan = b.prefixpertanggungan
				AND a.nopertanggungan = b.nopertanggungan
			LEFT OUTER JOIN $DBUser.tabel_100_klien c ON b.nopemegangpolis = c.noklien
			LEFT OUTER JOIN $DBUser.tabel_207_kode_benefit d ON a.kdbenefit = d.kdbenefit
			LEFT OUTER JOIN $DBUser.tabel_304_valuta e ON b.kdvaluta = e.kdvaluta
			WHERE $status
				AND a.kdstatusfilerkap LIKE '%$kdstatusfilerkap%'
				AND a.kdbenefit LIKE '%$kdbenefit%'
				AND a.kdstatusfile LIKE '%$kdstatusfile%'
				AND a.blnjatuhtempo LIKE '%$bln%'";
			$DB->parse($sql);
			$DB->execute();
			
			$jumlah = 0;
			while ($r=$DB->nextrow()) { ?>
				<tr>
					<td bgcolor="#E1EFF7" class="verdana7blu"><b><?="$r[PREFIXPERTANGGUNGAN]-$r[NOPERTANGGUNGAN]"?></b></td>
					<td bgcolor="#E1EFF7" class="verdana7blu"><b><?="$r[NAMAKLIEN1]"?></b></td>
					<td bgcolor="#E1EFF7" class="verdana7blu"><b><?="$r[MULAS]"?></b></td>
					<td bgcolor="#E1EFF7" class="verdana7blu"><b><?="$r[NAMABENEFIT]"?></b></td>
					<td bgcolor="#E1EFF7" class="verdana7blu"><b><?="$r[NAMAVALUTA]"?></b></td>
					<!--td bgcolor="#E1EFF7" class="verdana7blu" align="right"><b><?=number_format($r['KURSINDEKS'], 0, ",", ".")?></b></td-->
					<td bgcolor="#E1EFF7" class="verdana7blu" align="right"><b><?=number_format($r['NILAIBENEFIT'], 0, ",", ".")?></b></td>
					<!--td bgcolor="#E1EFF7" class="verdana7blu" align="right"><b><?=number_format($r['KURSINDEKS']*$r['NILAIBENEFIT'], 0, ",", ".")?></b></td-->
					<td bgcolor="#E1EFF7" class="verdana7blu" align="center"><b><?="$r[BLNJATUHTEMPO]"?></b></td>
				</tr>
				<?php $jumlah += $r['KURSINDEKS'] * $r['NILAIBENEFIT'];
			} ?>
		</table>
	</body>
</html>