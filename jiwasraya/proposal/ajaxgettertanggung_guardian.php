<?php
	include "../../includes/common.php";
	include "../../includes/database.php";
	include "../../includes/session.php";
	$DB=New Database($userid, $passwd, $DBName);
	
	/*===== Tertanggung =====*/
	$sql = "SELECT LOWER(namaklien1) namaklien1, jeniskelamin, 
				TO_CHAR(tgllahir,'dd/mm/yyyy') tgllahir, b.jenisasuransi, 
				DECODE(b.carabayar, 'bulanan', '1', 'tahunan', '4', 'sekaligus', 'X') carabayar
				b.MASAASURANSI,
				b.PREMI,
				(SELECT TO_CHAR(TANGGALREKAM,'DD/MM/YYYY') FROM TABEL_SPAJ_ONLINE@SPAJOL WHERE NOSPAJ= '$nospaj') TGLMULAS
			FROM tabel_klien_spaj_online@SPAJOL a
			LEFT OUTER JOIN tabel_produk_spaj_online@SPAJOL b ON a.nospaj = b.nospaj
			WHERE a.nospaj = '$nospaj'
			AND statusklien = 1";
	$DB->parse($sql);
	$DB->execute();
	$r = $DB->nextrow();
	
	$sql = "SELECT noklien
			FROM $DBUser.tabel_100_klien
			WHERE LOWER(namaklien1) LIKE '%$r[NAMAKLIEN1]%'
				AND jeniskelamin = '$r[JENISKELAMIN]'
				AND TO_CHAR(tgllahir,'dd/mm/yyyy') = '$r[TGLLAHIR]'";
	$DB->parse($sql);
	$DB->execute();
	$s = $DB->nextrow();
	
	/*===== Tertanggung Pempegang Polis =====*/
	$sql = "SELECT LOWER(namaklien1) namaklien1, jeniskelamin, 
				TO_CHAR(tgllahir,'dd/mm/yyyy') tgllahir, b.jenisasuransi, 
				DECODE(b.carabayar, 'bulanan', '1', 'tahunan', '4', 'sekaligus', 'X') carabayar,
				b.MASAASURANSI,
				b.PREMI,
				(SELECT TO_CHAR(TANGGALREKAM,'DD/MM/YYYY') FROM TABEL_SPAJ_ONLINE@SPAJOL WHERE NOSPAJ= '$nospaj') TGLMULAS
			FROM tabel_klien_spaj_online@SPAJOL a
			LEFT OUTER JOIN tabel_produk_spaj_online@SPAJOL b ON a.nospaj = b.nospaj
			WHERE a.nospaj = '$nospaj'
			AND statusklien = 3";
	$DB->parse($sql);
	$DB->execute();
	$t = $DB->nextrow();
	
	$sql = "SELECT noklien
			FROM $DBUser.tabel_100_klien
			WHERE LOWER(namaklien1) LIKE '%$t[NAMAKLIEN1]%'
				AND jeniskelamin = '$t[JENISKELAMIN]'
				AND TO_CHAR(tgllahir,'dd/mm/yyyy') = '$t[TGLLAHIR]'";
	$DB->parse($sql);
	$DB->execute();
	$u = $DB->nextrow();
	
	if (strlen($s['NOKLIEN']) > 0) {
		echo "$s[NOKLIEN];$r[JENISASURANSI];$r[CARABAYAR];$r[MASAASURANSI];$r[PREMI];$r[TGLMULAS]";
	} else {
		echo "$u[NOKLIEN];$t[JENISASURANSI];$t[CARABAYAR];$t[MASAASURANSI];$t[PREMI];$t[TGLMULAS]";
	}
?>