<?php
    /*
    * API file untuk aplikasi jaim
    * method untuk data master
    */
    require_once 'includes/config.php';
    require_once 'includes/database.php';

	$r	= isset($_GET['r']) ? $_GET['r'] : '';
	$p	= isset($_GET['p']) ? $_GET['p'] : '';
	$p2 = isset($_GET['p2']) ? $_GET['p2'] : '';
	$p3 = isset($_GET['p3']) ? $_GET['p3'] : '';
	$p4 = isset($_GET['p4']) ? $_GET['p4'] : '';
	$p5 = isset($_GET['p5']) ? $_GET['p5'] : '';
	$p6 = isset($_GET['p6']) ? $_GET['p6'] : '';

    $DB = new Database(C_USER_DB_JLINDO, C_PASS_DB_JLINDO, C_DB_JLINDO);

    /*===== data agen per area office =====*/
    if (strcasecmp($r, '1') == 0) {
        $p2 = preg_replace('/[\\\\\r\n]/', '', $p2);
        $p2 = str_replace("-", " ", $p2);
        $whereaktivasi = strlen($p4) ? " AND b.noaktivasi <> '$p4' " : null;
        $sql = "SELECT a.noagen, b.namaklien1
                FROM tabel_400_agen a
                INNER JOIN tabel_100_klien b ON a.noagen = b.noklien
                WHERE kdkantor = '$p'
                    AND kdareaoffice IN ($p2)
                    AND a.kdstatusagen = '01'
                    AND noagen NOT IN (SELECT noagen
                        FROM jaim_211_agen_pelaksana@jaim a
                        INNER JOIN jaim_211_aktivasi_perencanaan@jaim b ON a.noaktivasi = b.noaktivasi
                        WHERE waktupelaksanaanakhir >= TO_DATE('$p3', 'dd/mm/yyyy') $whereaktivasi
                    )
                ORDER BY b.namaklien1";

        $DB->parse($sql);
        $DB->execute();

        echo json_encode($DB->result());
    }

    /*===== data spaj per no aktivasi =====*/
    if (strcasecmp($r, '2') == 0) {
        $sql = "SELECT a.nosp, TO_CHAR(a.tglsp, 'dd/mm/yyyy') tglsp, a.namapempol, a.premi
                FROM tabel_ul_spaj_temp a
                INNER JOIN jaim_211_agen_pelaksana@jaim b ON a.noagen = b.noagen
                INNER JOIN jaim_211_aktivasi_perencanaan@jaim c ON b.noaktivasi = c.noaktivasi
                WHERE c.noaktivasi = '$p'
                    AND tglsp BETWEEN c.waktupelaksanaanawal AND c.waktupelaksanaanakhir
                    AND a.nosp NOT IN (SELECT nosp FROM tabel_200_pertanggungan WHERE nosp = a.nosp AND kdpertanggungan = '2')
                ORDER BY a.tglsp";

        $DB->parse($sql);
        $DB->execute();

        echo json_encode($DB->result());
    }

    /*===== data polis per no aktivasi =====*/
    if (strcasecmp($r, '3') == 0) {
        $sql = "SELECT a.prefixpertanggungan, a.nopertanggungan, a.kdproduk, e.namaklien1 namapemegangpolis, 
                    a.nosp, c.noaktivasi,  
                    (SELECT nilairp FROM tabel_300_historis_premi WHERE prefixpertanggungan = a.prefixpertanggungan AND nopertanggungan = a.nopertanggungan AND kdkuitansi = 'BP3') premi
                FROM tabel_200_pertanggungan a
                INNER JOIN tabel_214_acceptance_dokumen b ON a.prefixpertanggungan = b.prefixpertanggungan
                    AND a.nopertanggungan = b.nopertanggungan
                INNER JOIN jaim_211_agen_pelaksana@jaim c ON a.noagen = c.noagen
                INNER JOIN jaim_211_aktivasi_perencanaan@jaim d ON c.noaktivasi = d.noaktivasi
                LEFT OUTER JOIN tabel_100_klien e ON a.nopemegangpolis = e.noklien
                WHERE c.noaktivasi = '$p'
                    AND b.tglacceptance BETWEEN d.waktupelaksanaanawal AND d.waktupelaksanaanakhir
                    AND kdpertanggungan = '2'
                ORDER BY b.tglacceptance";

        $DB->parse($sql);
        $DB->execute();

        echo json_encode($DB->result());
    }

    /*===== data download aktivasi =====*/
    if (strcasecmp($r, '4') == 0) {
        $sql = "SELECT MAX(b.noaktivasi) noaktivasi, b.kdkantor, MAX(jeniskegiatan) AS jnskegiatan, MAX(deskripsi) deskripsikegiatan, 
                    MAX(tempat) tempatkegiatan, a.noagen, TO_CHAR(MAX(b.waktupelaksanaanawal), 'dd/mm/yyyy') wktupelaksanaanawal, 
                    TO_CHAR(MAX(b.waktupelaksanaanakhir), 'dd/mm/yyyy') wktupelaksanaanakhir, f.namaklien1 namaagen, d.kdareaoffice, 
                    e.namaareaoffice, g.nosp, TO_CHAR(g.tglsp, 'dd/mm/yyyy') tglspaj, b.potensipremiberkala, b.potensipremisekaligus, 
                    g.namapempolsp, g.premisp, h.prefixpertanggungan, h.nopertanggungan, h.kdproduk, 
                    TO_CHAR(h.tglacceptance, 'dd/mm/yyyy') tglacceptance, h.nilairp, h.namapemegangpolis
                FROM jaim_211_agen_pelaksana@jaim a
                INNER JOIN jaim_211_aktivasi_perencanaan@jaim b ON a.noaktivasi = b.noaktivasi
                INNER JOIN jaim_210_jenis_kegiatan@jaim c ON b.kdjeniskegiatan = c.kdjeniskegiatan
                INNER JOIN tabel_400_agen d ON a.noagen = d.noagen
                INNER JOIN tabel_410_area_office e ON d.kdkantor = e.kdkantor
                    AND d.kdareaoffice = e.kdareaoffice
                INNER JOIN tabel_100_klien f ON a.noagen = f.noklien
                LEFT OUTER JOIN (
                    SELECT noagen, nosp, tglsp, namapempol namapempolsp, premi premisp
                    FROM tabel_ul_spaj_temp
                    WHERE nosp IN (SELECT nosp FROM tabel_200_pertanggungan WHERE kdpertanggungan <> '2')
                ) g ON a.noagen = g.noagen AND g.tglsp BETWEEN b.waktupelaksanaanawal AND b.waktupelaksanaanakhir
                LEFT OUTER JOIN (
                    SELECT a.noagen, a.prefixpertanggungan, a.nopertanggungan, a.kdproduk, b.tglacceptance, c.nilairp,
                        d.namaklien1 namapemegangpolis
                    FROM tabel_200_pertanggungan a
                    INNER JOIN tabel_214_acceptance_dokumen b ON a.prefixpertanggungan= b.prefixpertanggungan
                        AND a.nopertanggungan = b.nopertanggungan AND a.kdpertanggungan = '2'
                    INNER JOIN tabel_300_historis_premi c ON a.prefixpertanggungan = c.prefixpertanggungan
                        AND a.nopertanggungan = c.nopertanggungan AND kdkuitansi = 'BP3'
                    INNER JOIN tabel_100_klien d ON a.nopemegangpolis = d.noklien
                ) h ON a.noagen = h.noagen AND h.tglacceptance BETWEEN b.waktupelaksanaanawal AND b.waktupelaksanaanakhir
                INNER JOIN tabel_001_kantor i ON b.kdkantor = i.kdkantor
                WHERE (TO_CHAR(b.waktupelaksanaanawal, 'mm/yyyy') = '$p2' OR TO_CHAR(b.waktupelaksanaanakhir, 'mm/yyyy') = '$p2')
                    AND (b.kdkantor LIKE '%$p%' OR i.kdkantorinduk LIKE '%$p%')
                GROUP BY b.kdkantor, a.noagen, f.namaklien1, d.kdareaoffice, e.namaareaoffice, g.nosp, g.tglsp, 
                    g.namapempolsp, g.premisp, h.prefixpertanggungan, h.nopertanggungan, h.kdproduk, h.tglacceptance, 
                    h.nilairp, h.namapemegangpolis, b.potensipremiberkala, b.potensipremisekaligus
                ORDER BY MAX(jeniskegiatan), e.namaareaoffice, f.namaklien1, g.nosp";

        $DB->parse($sql);
        $DB->execute();

        echo json_encode($DB->result());
    }