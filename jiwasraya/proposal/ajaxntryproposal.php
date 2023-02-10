<?php
	include "../../includes/common.php";
	include "../../includes/database.php";
	include "../../includes/session.php";
	$DA=New database($DBUser, $DBPass, $DBName);
	$DB=New Database($userid, $passwd, $DBName);
	$DC=New Database($userid, $passwd, $DBName);
	$pesan = null;
	
	// Cek data pempol / tertanggung di SPAJOL & JLINDO
	$sql = "SELECT UPPER(a.namaklien1) namaklien1, a.gelar, a.jeniskelamin, a.tempatlahir, 
				TO_CHAR(a.tgllahir, 'dd/mm/yyyy') tgllahir, a.kdagama, a.meritalstatus,
				a.tinggibadan, a.beratbadan, a.kdid, a.noid, a.kdpekerjaan, a.kdhobby,
				a.alamatkerja, a.phonetetap02, a.no_ponsel, c.noklien, 
				d.jenisasuransi, 
				CASE d.carabayar 
					WHEN '1' THEN 'M'
					WHEN '2' THEN 'Q'
					WHEN '3' THEN 'H'
					WHEN '4' THEN 'A'
					ELSE d.carabayar
				END carabayar, d.masaasuransi, NVL(NVL(f.premi_berkala, g.jumlah_premi), h.premi) premi, 
				d.uangasuransi, e.buildid, e.guid
			FROM $DBUser.tabel_spaj_online_klien a
			INNER JOIN $DBUser.tabel_spaj_online_relasi b ON  a.noklien = b.noklien
				AND b.statusklien IN (1, 3)
			LEFT OUTER JOIN $DBUser.tabel_100_klien c ON UPPER(a.namaklien1) = UPPER(c.namaklien1)
				AND a.jeniskelamin = c.jeniskelamin
				AND a.tgllahir = c.tgllahir
			LEFT OUTER JOIN $DBUser.tabel_spaj_online_produksi d ON b.nospaj = d.nospaj
			INNER JOIN $DBUser.tabel_spaj_online e ON b.nospaj = e.nospaj
			LEFT OUTER JOIN pro_asuransi_pokok@jaim f ON e.buildid = f.build_id
			LEFT OUTER JOIN jaim_300_hitung@jaim g ON e.buildid = g.build_id
			LEFT OUTER JOIN jaim_302_hitung@jaim h ON e.buildid = h.buildid
			WHERE b.nospaj = '$nospaj'
			GROUP BY a.namaklien1, a.gelar, a.jeniskelamin, a.tempatlahir, a.tgllahir, a.kdagama,
				a.meritalstatus, a.tinggibadan, a.beratbadan, a.kdid, a.noid, a.kdpekerjaan,
				a.kdhobby, a.alamatkerja, a.phonetetap02, a.no_ponsel, c.noklien,
				d.jenisasuransi, d.carabayar, d.masaasuransi, f.premi_berkala, g.jumlah_premi, 
				h.premi, d.uangasuransi, e.buildid, e.guid
			ORDER BY a.kdpekerjaan";
	$DA->parse($sql);
	$DA->execute();
	$r = $DA->nextrow();
	
	// Cek data spaj jika belum ada tambahkan
	$sql = "SELECT a.nospaj, TO_CHAR (tanggalrekam, 'dd/mm/yyyy') tglrekam, kodeagen, 0, 
				NVL(g.premi_berkala, h.jumlah_premi) premi, c.kdkantor, 0, no_ponsel, 
				e.alamattinggalktp, e.namaklien1, a.userupdate, 
				TO_CHAR(a.tanggalrekam, 'dd/mm/yyyy hh24:mi:ss') tanggalrekam, 'SPAJOL', 
				a.buildid, 1, f.nosp
			FROM $DBUser.tabel_spaj_online a
			INNER JOIN $DBUser.tabel_spaj_online_produksi b ON a.nospaj = b.nospaj
			INNER JOIN $DBUser.tabel_400_agen c ON a.kodeagen = c.noagen
			INNER JOIN $DBUser.tabel_spaj_online_relasi d ON a.nospaj = d.nospaj
				AND d.statusklien IN (2, 3)
			INNER JOIN $DBUser.tabel_spaj_online_klien e ON d.noklien = e.noklien
			LEFT OUTER JOIN $DBUser.tabel_ul_spaj_temp f ON a.nospaj = f.nosp
			LEFT OUTER JOIN pro_asuransi_pokok@jaim g ON a.buildid = g.build_id
			LEFT OUTER JOIN jaim_300_hitung@jaim h ON a.buildid = h.build_id
			WHERE a.nospaj = '$nospaj'
			GROUP BY a.nospaj, tanggalrekam, kodeagen, g.premi_berkala, h.jumlah_premi, 
				c.kdkantor, no_ponsel, e.alamattinggalktp, e.namaklien1, a.userupdate, 
				a.tanggalrekam, a.buildid, f.nosp"; 
	$DA->parse($sql);
	$DA->execute();
	$s = $DA->nextrow();
	if (empty($s['NOSP'])) {
		$sql = "INSERT INTO $DBUser.tabel_ul_spaj_temp (nosp, tglsp, noagen, taltup, premi, kdkantor, topup, hp, alamat, namapempol, userrekam, tglrekam, cif, buildid, dokumenlengkap)
				VALUES ('$s[NOSPAJ]', TO_DATE('$s[TGLREKAM]', 'dd/mm/yyyy'), '$s[KODEAGEN]', 0, $s[PREMI], '$s[KDKANTOR]', 0, '$s[NO_PONSEL]', '$s[ALAMATTINGGALKTP]', 
					'$s[NAMAKLIEN1]', '$s[USERUPDATE]', TO_DATE('$s[TANGGALREKAM]', 'dd/mm/yyyy hh24:mi:ss'), 'SPAJOL', '$s[BUILDID]', 1)";
		$DB->parse($sql);
		$DB->execute();
	}
	
	
	// bentuk data klien
	if ($klien) {
		if (empty($r['NOKLIEN'])) {
			// Tambah jika klien belum ada
			$sql = "SELECT LPAD($DBUser.no_klien.nextval, 10, '0') noklien FROM DUAL";
			$DB->parse($sql);
			$DB->execute();
			$seq = $DB->nextrow();
			$noklien = $seq['NOKLIEN'];
			
			$sql = "INSERT INTO $DBUser.tabel_100_klien (kdklien, noklien, namaklien1, kdagama, gelar, jeniskelamin, meritalstatus, tempatlahir,
						tgllahir, tinggibadan, kdpekerjaan, beratbadan, kdhobby, noid, pendapatan, alamattetap01, kdkotamadyatetap, alamattetap02,
						kodepostetap, phonetetap01, kdpropinsitetap, emailtetap, alamattagih01, kdkotamadyatagih, alamattagih02, kodepostagih, kdpropinsitagih,
						phonetagih01, phonetagih02, emailtagih, tglkawin, kdpekerjaanlama, kdgantipekerjaan, alamatkerja, status, npwp, warganegara, 
						dik_akhir, namaibukand, status_tinggal, pangkat, nama_pers, alamat_pers, telpon_pers, fax_pers, ket_usaha, bid_usaha, nama_usaha, 
						alamat_usaha, besar_pendapatan, almt_surat, tuj_email, no_ponsel, alamattinggalktp, alamattinggalktp2, kdpropinsiktp, 
						kdkotamadyaktp, kdposktp, alamattinggalkp, alamattinggalkp2, tglrekam, userrekam)
					SELECT DISTINCT 'N', '$seq[NOKLIEN]',
						trim(UPPER(namaklien1)),
						trim(kdagama), trim(gelar), trim(jeniskelamin), trim(meritalstatus), trim(tempatlahir),
						trim(tgllahir), trim(tinggibadan), DECODE(trim(kdpekerjaan), 'otherpekerjaan', NULL, trim(kdpekerjaan)), trim(beratbadan), trim(kdhobby), trim(noid), trim(pendapatangaji), trim(alamattetap01), trim(kdkotamadyatetap), trim(alamattetap02),
						trim(kodepostetap), trim(phonetetap01), trim(kdpropinsitetap), trim(emailtetap), trim(alamattagih01), trim(kdkotamadyatagih), trim(alamattagih02), trim(kodepostagih), trim(kdpropinsitagih),
						trim(phonetagih01), trim(phonetagih02), trim(emailtagih), trim(tglkawin), trim(kdpekerjaanlama), trim(kdgantipekerjaan), trim(alamatkerja), trim(status), trim(npwp), trim(warganegara), trim(dik_akhir), trim(namaibukand), trim(status_tinggal),
						trim(pangkat), trim(nama_pers), trim(alamat_pers), trim(telpon_pers), trim(fax_pers), trim(ket_usaha), trim(bid_usaha), trim(nama_usaha), trim(alamat_usaha), trim(besar_pendapatan), trim(almt_surat),
						trim(tuj_email), trim(no_ponsel), trim(alamattinggalktp), trim(alamattinggalktp2), trim(kdpropinsiktp), trim(kdkotamadyaktp), trim(kdposktp), trim(alamattinggalkp), trim(alamattinggalkp2), 
						sysdate,
						user
					FROM $DBUser.tabel_spaj_online_klien a
					INNER JOIN $DBUser.tabel_spaj_online_relasi b ON a.noklien = b.noklien
						AND b.statusklien IN (1, 3)
						AND b.relasi = '04'
					WHERE b.nospaj = '$nospaj'";
			$DB->parse($sql);
			if ($DB->execute()) {
				$pesan = "Sukses ditambah";
			} else {
				$noklien = '';
				$pesan = "Gagal ditambah ";
			}
		} else {
			$pesan = "Klien existing";
			$noklien = $r['NOKLIEN'];
		}
		
		$data['pesan'] = $pesan;
		$data['noklien'] = $noklien;
		
		echo json_encode($data);
	} 
	// ambil data e-spaj
	else {
		$data['buildid'] = $r['BUILDID'];
		$data['pesan'] = empty($r['NOKLIEN']) ? "Pilih Klien" : "";
		$data['noklien'] = $r['NOKLIEN'];
		$data['jenisasuransi'] = $r['JENISASURANSI'];
		$data['carabayar'] = $r['CARABAYAR'];
		$data['masaasuransi'] = $r['MASAASURANSI'];
		$data['premi'] = $r['PREMI'];
		$data['uangasuransi'] = $r['UANGASURANSI'];
		$data['mulas'] = $s['TGLREKAM'];
		$data['noagen'] = $s['KODEAGEN'];
		$data['guid'] = $r['GUID'];
		
		echo json_encode($data);
	}
	