<?php
    include "../../includes/common.php";
    include "../../includes/database.php";
    include "../../includes/session.php";
    include "mysqldatabase.php";
    $DB=New Database($userid, $passwd, $DBName);

    // Data nasabah & polis mobile bancas
    /* Direct connect ke database
    $sql = "SELECT date_format(a.tanggal_booking, '%d/%m/%Y') AS tanggal_booking, a.nilai_premi,
                            b.no_telp, b.alamat, b.nama_lengkap, date_format(b.tanggal_lhir, '%d/%m/%Y') AS tanggal_lhir,
                            b.jenkel, b.tempat_lhir, b.no_identitas
                        FROM polis a
                        INNER JOIN nasabah b ON a.id_nasabah = b.id
                        WHERE a.kode_booking = '".substr($nospaj, 1)."'";
    $hasil = mysql_query($sql);
    $r = mysql_fetch_array ($hasil);*/

    // Get data from API
    $r = json_decode(file_get_contents(C_URL_ELIFE."jsmobileapi/spaj.php?r=3&p=$nospaj"), true);

    // Cek data spaj jlindo
    $sql = "SELECT nosp
            FROM $DBUser.tabel_ul_spaj_temp
            WHERE nosp = '$nospaj'";
    $DB->parse($sql);
    $DB->execute();
    $arrspaj = $DB->nextrow();

    // Tambahkan jika data spaj belum ada
    if (!is_array($arrspaj)) {
        $sql = "INSERT INTO $DBUser.tabel_ul_spaj_temp (nosp, tglsp, noagen, taltup, premi, kdkantor, topup, hp, alamat, 
                    namapempol, tglrekam, userrekam)
                VALUES ('$nospaj', TO_DATE('$r[tanggal_booking]', 'dd/mm/yyyy'), '$noagen', 0, $r[nilai_premi],
                    '$kantor', 0, '$r[no_telp]', '$r[alamat]', '$r[nama_lengkap]', sysdate, '$userid')";
        $DB->parse($sql);
        $DB->execute();
    }

    // Cek data pemegang polis jlindo
    $sql = "SELECT noklien, kdagama, meritalstatus, tinggibadan, beratbadan, kdid, noid, kdpekerjaan, alamatkerja, phonetetap02, no_ponsel
                FROM $DBUser.tabel_100_klien
                WHERE LOWER(namaklien1) LIKE '%".strtolower($r['nama_lengkap'])."%'
                    AND jeniskelamin = '$r[jenkel]'
                    AND TO_CHAR(tgllahir,'dd/mm/yyyy') = '$r[tanggal_lhir]'";
    $DB->parse($sql);
    $DB->execute();
    $s = $DB->nextrow();

    // Perbaharui atau tambahkan jika calon pemegang polis belum ada
    if (is_array($s)) {
        $noklien = $s['NOKLIEN'];

        $sql = "UPDATE $DBUser.tabel_100_klien SET 
                    tglupdated = sysdate,
                    userupdated = user
                WHERE noklien = '$s[NOKLIEN]'";
        $DB->parse($sql);
        $DB->execute();

        echo "X1";
    } else {
        $sql = "SELECT LPAD($DBUser.no_klien.nextval+1, 10, '0') noklien FROM DUAL";
        $DB->parse($sql);
        $DB->execute();
        $t = $DB->nextrow();
        $tgllahir = !empty($r['tanggal_lhir']) && strlen($r['tanggal_lhir']) > 0 ? "TO_DATE('$r[tanggal_lhir]', 'dd/mm/yyyy')" : "";

        $sql = "INSERT INTO $DBUser.tabel_100_klien (kdklien,noklien,namaklien1,jeniskelamin,tempatlahir,
					tgllahir,kdid,noid,tglrekam,userrekam,tglupdated,userupdated,phonetetap02,no_ponsel)
				VALUES ('N', '$t[NOKLIEN]', UPPER('$r[nama_lengkap]'), '$r[jenkel]', 
				    UPPER('$r[tempat_lhir]'), $tgllahir, 'KT', '$r[no_identitas]', sysdate, 
				    '$userid', sysdate, '$userid', '$r[no_telp]', '$r[no_telp]')";

        $DB->parse($sql);
        $DB->execute();

        $noklien = $t['NOKLIEN'];
        echo "B1";
    }

    // Cek data ahliwaris mobile bancas
    /* Direct connect ke database
    $sql = "SELECT a.nama_waris, a.no_identitas, a.tempat_lhir, date_format(a.tanggal_lhir, '%d/%m/%Y') AS tanggal_lhir,
                a.jenkel, a.alamat, a.kode_pos, a.no_telp, a.hubungan
            FROM ahli_waris a
            INNER JOIN polis b ON a.id_tertanggung = b.id_tertanggung
            WHERE b.kode_booking = '".substr($nospaj, 1)."'";
    $hasil = mysql_query($sql);
    $i = 0;
    while ($u = mysql_fetch_array ($hasil)) {*/

    // Get data from API
    $hasil = json_decode(file_get_contents(C_URL_ELIFE."jsmobileapi/spaj.php?r=4&p=$nospaj"), true);
    foreach ($hasil as $i => $u) {
        $sql = "SELECT noklien, b.noklieninsurable
                    FROM $DBUser.tabel_100_klien a
                    LEFT OUTER JOIN $DBUser.tabel_113_insurable b ON a.noklien = b.noklieninsurable
                    WHERE LOWER(namaklien1) LIKE '%".strtolower($u['nama_waris'])."%'
                        AND jeniskelamin = '$u[jenkel]'
                        AND TO_CHAR(tgllahir,'dd/mm/yyyy') = '$u[tanggal_lhir]'";
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
            $tgllahir = !empty($u['tanggal_lhir']) && strlen($u['tanggal_lhir']) > 0 ? "TO_DATE('$u[tanggal_lhir]', 'dd/mm/yyyy')" : "";

            $sql = "INSERT INTO $DBUser.tabel_100_klien (kdklien,noklien,namaklien1,jeniskelamin,tempatlahir,
                        tgllahir,kdid,noid,tglrekam,userrekam,tglupdated,userupdated,phonetetap02,no_ponsel)
                    VALUES ('N', '$w[NOKLIEN]', UPPER('$u[nama_waris]'), '$u[jenkel]',
                            UPPER('$u[tempat_lhir]'), $tgllahir, 'KT', '$u[no_identitas]', sysdate,
                            '$userid', sysdate, '$userid', '$u[no_telp]', '$u[no_telp]')";
            $DB->parse($sql);

            if ($DB->execute()) {
                $kdhubungan = '';
                switch (strtolower(trim($u['hubungan']))) {
                    case 'ayah tiri':
                        $kdhubungan = 'AT';
                        break;
                    case 'saudara':
                        $kdhubungan = 'T1';
                        break;
                    case 'tertanggung anak 1':
                        $kdhubungan = 'TA';
                        break;
                    case 'tertanggung anak 2':
                        $kdhubungan = 'TB';
                        break;
                    case 'tertanggung anak 3':
                        $kdhubungan = 'TC';
                        break;
                    case 'anak tiri':
                        $kdhubungan = '1T';
                        break;
                    case 'anak tiri yg dibeasiswakan':
                        $kdhubungan = '2T';
                        break;
                    case 'istri':
                        $kdhubungan = 'I';
                        break;
                    case 'suami':
                        $kdhubungan = 'S';
                        break;
                    case 'anak':
                        $kdhubungan = '1';
                        break;
                    case 'anak kandung':
                        $kdhubungan = '1';
                        break;
                    case 'ayah':
                        $kdhubungan = 'A';
                        break;
                    case 'Ibu':
                        $kdhubungan = 'U';
                        break;
                    case 'kakek':
                        $kdhubungan = 'K';
                        break;
                    case 'nenek':
                        $kdhubungan = 'N';
                        break;
                    case 'karyawan':
                        $kdhubungan = 'P';
                        break;
                    case 'saudara perempuan':
                        $kdhubungan = 'W';
                        break;
                    case 'saudara laki-laki':
                        $kdhubungan = 'L';
                        break;
                    case 'kakak kandung':
                        $kdhubungan = 'B';
                        break;
                    case 'adik kandung':
                        $kdhubungan = 'C';
                        break;
                    case 'dummy':
                        $kdhubungan = 'X';
                        break;
                    case 'anak angkat':
                        $kdhubungan = 'D';
                        break;
                    case 'adik ipar':
                        $kdhubungan = 'E';
                        break;
                    case 'bibi':
                        $kdhubungan = 'F';
                        break;
                    case 'cucu':
                        $kdhubungan = 'G';
                        break;
                    case 'debitur':
                        $kdhubungan = 'H';
                        break;
                    case 'kakak ipar':
                        $kdhubungan = 'V';
                        break;
                    case 'mertua':
                        $kdhubungan = 'J';
                        break;
                    case 'mertua?':
                        $kdhubungan = 'M';
                        break;
                    case 'orang tua angkat':
                        $kdhubungan = 'Q';
                        break;
                    case 'paman':
                        $kdhubungan = 'R';
                        break;
                    case 'saudara angkat':
                        $kdhubungan = 'T';
                        break;
                    case 'diri tertanggung':
                        $kdhubungan = '04';
                        break;
                    case 'cucu yang dibeasiswakan':
                        $kdhubungan = 'G2';
                        break;
                    case 'keponakan yang dibeasiswakan':
                        $kdhubungan = 'K2';
                        break;
                    case 'keponakan':
                        $kdhubungan = 'K1';
                        break;
                    case 'menantu':
                        $kdhubungan = 'M1';
                        break;
                    case 'saudara yang dibeasiswakan':
                        $kdhubungan = 'T2';
                        break;
                    case 'kakak sepupu':
                        $kdhubungan = 'KS';
                        break;
                    case 'adik sepupu':
                        $kdhubungan = 'AS';
                        break;
                    case 'pemegang polis':
                        $kdhubungan = 'O2';
                        break;
                    case 'anak yang dibeasiswakan':
                        $kdhubungan = 'A2';
                        break;
                    case 'pemilik perusahaan':
                        $kdhubungan = 'PP';
                        break;
                    case 'ibu tiri':
                        $kdhubungan = 'UT';
                        break;
                    case 'tertanggung istri':
                        $kdhubungan = 'TI';
                        break;
                    case 'tertanggung suami':
                        $kdhubungan = 'TS';
                        break;
                }

                $sql = "INSERT INTO $DBUser.tabel_113_insurable (notertanggung, kdhubungan, noklieninsurable)
                            VALUES ('$noklien', '$kdhubungan', '$w[NOKLIEN]')";
                // echo "$sql<br><br>";
                $DB->parse($sql);
                $DB->execute();

                echo "|AB$i";
            }
        }

        $i++;
    }

    if ($i == 0)
        echo "TA";