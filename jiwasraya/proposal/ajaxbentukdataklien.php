<?php
	include "../../includes/common.php";
	include "../../includes/database.php";
	include "../../includes/session.php";
	$DB=New Database($userid, $passwd, $DBName);
	//$DI=New database($DBUser,$DBPass,$DBName);
	
	// Tarik data klien di spajol
	$sql = "SELECT LOWER(namaklien1) namaklien1, UPPER(namaklien1) namaklien2,alamatkerja, phonetetap02, 
				jeniskelamin, gelar, tempatlahir, kdagama, meritalstatus, tinggibadan, beratbadan, 
				TO_CHAR(tgllahir,'dd/mm/yyyy') tgllahir, kdid, noid, kdpekerjaan, kdhobby, no_ponsel,
				DECODE(pendapatan,'under10',10000000,'10sd50',50000000,'50sd100',100000000, pendapatan) pendapatan
			FROM $DBUser.tabel_spaj_online_klien a
            INNER JOIN $DBUser.tabel_spaj_online_relasi b ON a.noklien = b.noklien
                AND b.statusklien IN (1, 3)
            WHERE b.nospaj = '$nospaj'
            ORDER BY b.statusklien DESC";
	$DB->parse($sql);
	$DB->execute();
	$r = $DB->nextrow();
	
	// Tarik data klien jlindo berdasarkan kriteria spajol
	$sql = "SELECT noklien, kdagama, meritalstatus, tinggibadan, beratbadan, kdid, noid, kdpekerjaan, alamatkerja, phonetetap02, no_ponsel
			FROM $DBUser.tabel_100_klien
			WHERE LOWER(namaklien1) LIKE '%$r[NAMAKLIEN1]%'
				AND jeniskelamin = '$r[JENISKELAMIN]'
				AND TO_CHAR(tgllahir,'dd/mm/yyyy') = '$r[TGLLAHIR]'
				AND kdklien = 'N'";
	$DB->parse($sql);
	$DB->execute();
	$s = $DB->nextrow();
	
	if (is_array($s)) {
		$noklien = $s['NOKLIEN'];
		
		/*$sql = "UPDATE $DBUser.tabel_100_klien SET
					kdagama = '$s[KDAGAMA]',
					meritalstatus = '$s[MERITALSTATUS]',
					tinggibadan = '$s[TINGGIBADAN]',
					beratbadan = '$s[BERATBADAN]',
					kdid = '$s[KDID]',
					noid = '$s[NOID]',
					kdpekerjaan = '$s[KDPEKERJAAN]',
					alamatkerja = '$s[ALAMATKERJA]',
					phonetetap02 = '$s[PHONETETAP02]',
					no_ponsel = '$s[NO_PONSEL]',
					tglupdated = sysdate,
					userupdated = user
				WHERE noklien = '$s[NOKLIEN]'";
		$DB->parse($sql);
		$DB->execute();*/
		
		echo "X1";
	} else {
		$sql = "SELECT LPAD($DBUser.no_klien.nextval+1, 10, '0') noklien FROM DUAL";
		$DB->parse($sql);
		$DB->execute();
		$t = $DB->nextrow();
		
		$sql = "INSERT INTO $DBUser.tabel_100_klien (kdklien,noklien,namaklien1,gelar,jeniskelamin,tempatlahir,
					tgllahir,kdagama,meritalstatus,tinggibadan,beratbadan,kdid,noid,kdpekerjaan,kdhobby,pendapatan,
					tglrekam,userrekam,tglupdated,userupdated,alamatkerja,phonetetap02,no_ponsel)
				SELECT DISTINCT 'N',
					'$t[NOKLIEN]',
					UPPER(namaklien1),
					gelar,
					jeniskelamin,
					tempatlahir,
					tgllahir,
					kdagama,
					meritalstatus,
					tinggibadan,
					beratbadan,
					kdid,
					noid,
					kdpekerjaan,
					kdhobby,
					DECODE(pendapatan,'under10',10000000,'10sd50',50000000,'50sd100',100000000, pendapatan),
					sysdate,
					user,
					null,
					null,
					alamatkerja,
					phonetetap02,
					no_ponsel
				FROM $DBUser.tabel_spaj_online_klien a
                INNER JOIN $DBUser.tabel_spaj_online_relasi b ON a.noklien = b.noklien
                    AND b.statusklien IN (1, 3)
                WHERE b.nospaj = '$nospaj'";
			
		$DB->parse($sql);
		$DB->execute();
		
		$noklien = $t['NOKLIEN'];
		echo "N1";
	}
	
	/*===== Cek data Ahli Waris =====*/
	$sql = "SELECT DISTINCT LOWER(namalengkap) namaklien1, TO_CHAR(tanggallahir,'dd/mm/yyyy') tgllahir, jeniskelamin, tempatlahir,
				statusmarital meritalstatus, hubungan
			FROM $DBUser.tabel_spaj_online_ahliwaris
			WHERE nospaj = '$nospaj'
				AND hubungan NOT IN ('04', 'sendiri')";
	$DB->parse($sql);
	$DB->execute();
	
	$i = 0;
	while ($u = $DB->nextrow()) {
		$sql = "SELECT noklien, b.noklieninsurable
				FROM $DBUser.tabel_100_klien a
				LEFT OUTER JOIN $DBUser.tabel_113_insurable b ON a.noklien = b.noklieninsurable
				WHERE LOWER(namaklien1) LIKE '%$u[NAMAKLIEN1]%'
					AND jeniskelamin = '$u[JENISKELAMIN]'
					AND TO_CHAR(tgllahir,'dd/mm/yyyy') = '$u[TGLLAHIR]'";
		$DB->parse($sql);
		$DB->execute();
		$v = $DB->nextrow();
		
		if (is_array($v)) {
			echo "|AX$i";			
		} else {
			$sql = "SELECT LPAD($DBUser.no_klien.nextval+1, 10, '0') noklien FROM DUAL";
			$DB->parse($sql);
			$DB->execute();
			$w = $DB->nextrow();
			
			$sql = "INSERT INTO $DBUser.tabel_100_klien (kdklien,noklien,namaklien1,gelar,jeniskelamin,tempatlahir,
						tgllahir,kdagama,meritalstatus,tinggibadan,beratbadan,kdid,noid,kdpekerjaan,kdhobby,pendapatan,
						tglrekam,userrekam,tglupdated,userupdated,alamatkerja,phonetetap02,no_ponsel)
					SELECT 'N',
						'$w[NOKLIEN]',
						UPPER('$u[NAMAKLIEN1]'),
						null,
						'$u[JENISKELAMIN]',
						'$u[TEMPATLAHIR]',
						TO_DATE('$u[TGLLAHIR]','dd/mm/yyyy'),
						null,
						'$u[MERITALSTATUS]',
						null,
						null,
						null,
						'',
						null,
						null,
						0,
						sysdate,
						user,
						null,
						null,
						null,
						null,
						null
					FROM DUAL";
			$DB->parse($sql);
		
			if ($DB->execute()) {
				$sql = "INSERT INTO $DBUser.tabel_113_insurable (notertanggung, kdhubungan, noklieninsurable)
						VALUES ('$noklien', '$u[HUBUNGAN]', '$w[NOKLIEN]')";
				$DB->parse($sql);
				$DB->execute();
				
				echo "|AB$i";
			}
		}
		
		$i++;
	}
	
	if ($i == 0)
		echo "TA";
	
	// Insert data spaj ke tabel spaj temp
	$sql = "INSERT INTO $DBUser.tabel_ul_spaj_temp (nosp, tglsp, noagen, taltup, premi, kdkantor, topup, hp, alamat, namapempol, userrekam, tglrekam, cif, buildid, dokumenlengkap)
			SELECT DISTINCT a.nospaj, TO_DATE(TO_CHAR (tanggalrekam, 'dd/mm/yyyy'), 'dd/mm/yyyy'), kodeagen, 0, b.premi, c.kdkantor,
				0, no_ponsel, e.alamattinggalktp, e.namaklien1, a.userupdate, a.tanggalrekam, 'SPAJOL', a.buildid, 1
			FROM $DBUser.tabel_spaj_online a
			INNER JOIN $DBUser.tabel_spaj_online_produksi b ON a.nospaj = b.nospaj
			INNER JOIN $DBUser.tabel_400_agen c ON a.kodeagen = c.noagen
			INNER JOIN $DBUser.tabel_spaj_online_relasi d ON a.nospaj = d.nospaj
				AND d.statusklien IN (2, 3)
			INNER JOIN $DBUser.tabel_spaj_online_klien e ON d.noklien = e.noklien
			WHERE a.nospaj = '$nospaj'";
	$DB->parse($sql);
	$DB->execute();
?>