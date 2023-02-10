<?php
	include "../../includes/common.php";
	include "../../includes/database.php";
	include "../../includes/session.php";
	$DB=New Database($userid, $passwd, $DBName);
	
	/*===== Tertanggung =====*/
	$sql = "SELECT DISTINCT LOWER(namaklien1) namaklien1, jeniskelamin, 
                TO_CHAR(tgllahir,'dd/mm/yyyy') tgllahir, c.jenisasuransi, 
                c.carabayar,
                c.masaasuransi,
                c.premi,
                (SELECT TO_CHAR(tanggalrekam, 'dd/mm/yyyy') FROM $DBUser.tabel_spaj_online WHERE nospaj = '$nospaj') tglmulas
            FROM $DBUser.tabel_spaj_online_klien a
            INNER JOIN $DBUser.tabel_spaj_online_relasi b ON a.noklien = b.noklien
                AND b.statusklien IN (1, 3)
            LEFT OUTER JOIN $DBUser.tabel_spaj_online_produksi c ON b.nospaj = c.nospaj
            WHERE b.nospaj = '$nospaj'
                AND b.statusklien = 1";
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
	$sql = "SELECT DISTINCT LOWER(namaklien1) namaklien1, jeniskelamin, 
				TO_CHAR(tgllahir,'dd/mm/yyyy') tgllahir, c.jenisasuransi, 
				c.carabayar,
				c.MASAASURANSI,
				c.PREMI,
				(SELECT TO_CHAR(TANGGALREKAM,'DD/MM/YYYY') FROM $DBUser.tabel_spaj_online WHERE NOSPAJ = '$nospaj') TGLMULAS
			FROM $DBUser.tabel_spaj_online_klien a
            INNER JOIN $DBUser.tabel_spaj_online_relasi b ON a.noklien = b.noklien
                AND b.statusklien IN (1, 3)
            LEFT OUTER JOIN $DBUser.tabel_spaj_online_produksi c ON b.nospaj = c.nospaj
            WHERE b.nospaj = '$nospaj'
                AND b.statusklien = 3";
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

	if ($s) {
		echo "$s[NOKLIEN];$r[JENISASURANSI];$r[CARABAYAR];$r[MASAASURANSI];$r[PREMI];$r[TGLMULAS]";
	} else {
		echo "$u[NOKLIEN];$t[JENISASURANSI];$t[CARABAYAR];$t[MASAASURANSI];$t[PREMI];$t[TGLMULAS]";
	}
?>