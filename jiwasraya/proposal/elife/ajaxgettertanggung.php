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

    // Cek data pemegang polis jlindo
    $sql = "SELECT noklien, kdagama, meritalstatus, tinggibadan, beratbadan, kdid, noid, kdpekerjaan, alamatkerja, phonetetap02, no_ponsel
            FROM $DBUser.tabel_100_klien
            WHERE LOWER(namaklien1) LIKE '%".strtolower($r['nama_lengkap'])."%'
                AND jeniskelamin = '$r[jenkel]'
                AND TO_CHAR(tgllahir,'dd/mm/yyyy') = '$r[tanggal_lhir]'";
    $DB->parse($sql);
    $DB->execute();
    $s = $DB->nextrow();

    echo $s['NOKLIEN'];
?>