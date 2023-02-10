<?php

class Aktivasi_model extends CI_Model {

    /*===== get daftar aktivasi by id =====*/
    function get_list_aktivasi($filter) {
        $data = array();

        $q = $this->db
            ->query("SELECT * FROM
        	(
        		SELECT tbl.*, rownum no
        		FROM
        		(
        			SELECT a.kdkantor, b.jeniskegiatan, TO_CHAR(a.waktupelaksanaanawal, 'dd/mm/yyyy') AS waktupelaksanaanawal, 
        			    TO_CHAR(a.waktupelaksanaanakhir, 'dd/mm/yyyy') AS waktupelaksanaanakhir,
                        tempat, potensipremiberkala, potensipremisekaligus, potensiprospek, a.filejawabankp, 
                        TO_CHAR(c.tglpelaksanaan, 'dd/mm/yyyy') tglpelaksanaan, a.noaktivasi, a.biaya, a.filenotadinas
                    FROM jaim_211_aktivasi_perencanaan a
                    LEFT OUTER JOIN jaim_210_jenis_kegiatan b ON a.kdjeniskegiatan = b.kdjeniskegiatan
                    LEFT OUTER JOIN jaim_212_monitor_aktivasi c ON a.noaktivasi = c.noaktivasi
                    WHERE a.kdkantor LIKE '%$filter[kdkantor]%' AND ( 
                        LOWER(a.kdkantor) LIKE '%$filter[s]%' OR
                        LOWER(b.jeniskegiatan) LIKE '%$filter[s]%' OR
                        TO_CHAR(a.waktupelaksanaanawal, 'dd/mm/yyyy') LIKE '%$filter[s]%' OR
                        TO_CHAR(a.waktupelaksanaanakhir, 'dd/mm/yyyy') LIKE '%$filter[s]%' OR
                        LOWER(tempat) LIKE '%$filter[s]%' OR
                        LOWER(potensipremiberkala) LIKE '%$filter[s]%' OR
                        LOWER(potensipremisekaligus) LIKE '%$filter[s]%' OR
                        LOWER(potensiprospek) LIKE '%$filter[s]%' OR
                        LOWER(biaya) LIKE '%$filter[s]%' OR
                        TO_CHAR(c.tglpelaksanaan, 'dd/mm/yyyy') LIKE '%$filter[s]%')
        			ORDER BY a.waktupelaksanaanawal DESC NULLS LAST
        		) tbl
        		WHERE rownum < ((".$filter['p']." * ".C_ROWS_PAGINATION.") + 1 )
        	)
        	WHERE no >= (((".$filter['p']."-1) * ".C_ROWS_PAGINATION.") + 1)");

        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }

    /*===== get daftar jenis kegiatan =====*/
    function get_list_jenis_kegiatan() {
        $data = array();

        $q = $this->db
            ->query("SELECT kdjeniskegiatan, jeniskegiatan
                     FROM JAIM_210_JENIS_KEGIATAN");

        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }

    /*===== get daftar jenis kegiatan =====*/
    function get_list_pelaksana_kegiatan($noaktivasi) {
        $data = array();

        $q = $this->db
            ->query("SELECT kdareaoffice, kdkantor
                     FROM JAIM_211_PELAKSANA_KEGIATAN
                     WHERE noaktivasi = '$noaktivasi'");

        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }

    /*===== get daftar jenis kegiatan =====*/
    function get_list_agen_pelaksana($noaktivasi) {
        $data = array();

        $q = $this->db
            ->query("SELECT noagen
                     FROM JAIM_211_AGEN_PELAKSANA
                     WHERE noaktivasi = '$noaktivasi'");

        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }

    /*===== get aktivasi ====== */
    function get_aktivasi($noaktivasi) {
        $data = array();

        $q = $this->db
            ->query("SELECT a.kdjeniskegiatan, TO_CHAR(a.waktupelaksanaanawal, 'dd/mm/yyyy') waktupelaksanaanawal, 
                         TO_CHAR(a.waktupelaksanaanakhir, 'dd/mm/yyyy') waktupelaksanaanakhir, a.tempat,
                         a.deskripsi, a.potensipremiberkala, a.potensipremisekaligus, a.potensiprospek, a.noaktivasi,
                         a.biaya, a.filenotadinas, a.filejawabankp
                     FROM jaim_211_aktivasi_perencanaan a
                     LEFT OUTER JOIN jaim_211_pelaksana_kegiatan b ON a.noaktivasi = b.noaktivasi
                     LEFT OUTER JOIN jaim_211_agen_pelaksana c ON a.noaktivasi = c.noaktivasi
                     LEFT OUTER JOIN jaim_210_jenis_kegiatan d ON a.kdjeniskegiatan = d.kdjeniskegiatan
                     WHERE a.noaktivasi = '$noaktivasi'");

        if ($q->num_rows() > 0)
            $data = $q->row_array();

        $q->free_result();

        return $data;
    }

    /*===== get monitor ====== */
    function get_monitor($noaktivasi) {
        $data = array();

        $q = $this->db
            ->query("SELECT noaktivasi, TO_CHAR(tglpelaksanaan, 'dd/mm/yyyy') tglpelaksanaan, kendala, solusi
                     FROM jaim_212_monitor_aktivasi
                     WHERE noaktivasi = '$noaktivasi'");

        if ($q->num_rows() > 0)
            $data = $q->row_array();

        $q->free_result();

        return $data;
    }

    /*===== get last no aktivasi =====*/
    function get_last_no_aktivasi() {
        $lastno = null;
        $kdkantor = $this->session->KDKANTOR;

        $q = $this->db
            ->query("SELECT MAX(SUBSTR(NOAKTIVASI, 9, 6)) AS NO
                     FROM JAIM_211_AKTIVASI_PERENCANAAN
                     WHERE SUBSTR(NOAKTIVASI, 0, 2) = '$kdkantor'
                         AND SUBSTR(NOAKTIVASI, 3, 6) = TO_CHAR(SYSDATE, 'YYMMDD')");

        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $lastno = $data['NO'];
        }

        $q->free_result();

        return $lastno;
    }

    /*===== get total rows aktivasi =====*/
    function get_total_aktivasi($filter) {
        $rows = 0;

        $q = $this->db
            ->query("SELECT a.kdkantor, b.jeniskegiatan, TO_CHAR(a.waktupelaksanaanawal, 'dd/mm/yyyy') AS waktupelaksanaanawal, 
        			     TO_CHAR(a.waktupelaksanaanakhir, 'dd/mm/yyyy') AS waktupelaksanaanakhir,
                         tempat, potensipremiberkala, potensipremisekaligus, potensiprospek, 
                         TO_CHAR(c.tglpelaksanaan, 'dd/mm/yyyy') tglpelaksanaan, a.noaktivasi, a.biaya
                     FROM jaim_211_aktivasi_perencanaan a
                     LEFT OUTER JOIN jaim_210_jenis_kegiatan b ON a.kdjeniskegiatan = b.kdjeniskegiatan
                     LEFT OUTER JOIN jaim_212_monitor_aktivasi c ON a.noaktivasi = c.noaktivasi
                     WHERE a.kdkantor LIKE '%$filter[kdkantor]%' AND ( 
                         LOWER(a.kdkantor) LIKE '%$filter[s]%' OR
                         LOWER(b.jeniskegiatan) LIKE '%$filter[s]%' OR
                         TO_CHAR(a.waktupelaksanaanawal, 'dd/mm/yyyy') LIKE '%$filter[s]%' OR
                         TO_CHAR(a.waktupelaksanaanakhir, 'dd/mm/yyyy') LIKE '%$filter[s]%' OR
                         LOWER(tempat) LIKE '%$filter[s]%' OR
                         LOWER(potensipremiberkala) LIKE '%$filter[s]%' OR
                         LOWER(potensipremisekaligus) LIKE '%$filter[s]%' OR
                         LOWER(potensiprospek) LIKE '%$filter[s]%' OR
                         LOWER(biaya) LIKE '%$filter[s]%' OR
                         TO_CHAR(c.tglpelaksanaan, 'dd/mm/yyyy') LIKE '%$filter[s]%')
        			 ORDER BY a.waktupelaksanaanawal DESC NULLS LAST");

        $rows = $q->num_rows();

        return $rows;
    }

    /*===== insert data aktivasi =====*/
    function insert($data, $data2, $data3) {
        $sukses = 0;

        $this->db->trans_begin();

        $this->db
            ->query("INSERT INTO JAIM_211_AKTIVASI_PERENCANAAN (NOAKTIVASI, KDKANTOR, KDJENISKEGIATAN, WAKTUPELAKSANAANAWAL, 
                         WAKTUPELAKSANAANAKHIR, TEMPAT, DESKRIPSI, POTENSIPREMIBERKALA, POTENSIPREMISEKALIGUS, POTENSIPROSPEK,
                         BIAYA, FILENOTADINAS)
                     VALUES ('$data[noaktivasi]', '$data[kdkantor]', '$data[kdjeniskegiatan]', 
                         TO_DATE('$data[waktupelaksanaanawal]', 'DD/MM/YYYY'), TO_DATE('$data[waktupelaksanaanakhir]', 'DD/MM/YYYY'),
                         '$data[tempat]', '$data[deskripsi]', TO_NUMBER('$data[potensipremiberkala]'), 
                         TO_NUMBER('$data[potensipremisekaligus]'), TO_NUMBER('$data[potensiprospek]'), '$data[biaya]',
                         '$data[filenotadinas]')");

        foreach ($data2 as $i => $v) {
            $this->db
                ->query("INSERT INTO JAIM_211_PELAKSANA_KEGIATAN (NOAKTIVASI, KDAREAOFFICE, KDKANTOR)
                     VALUES ('$v[noaktivasi]', '$v[kdareaoffice]', '$v[kdkantor]')");
        }

        foreach ($data3 as $i => $v) {
            $this->db
                ->query("INSERT INTO JAIM_211_AGEN_PELAKSANA (NOAKTIVASI, NOAGEN)
                     VALUES ('$v[noaktivasi]', '$v[noagen]')");
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        }
        else {
            $sukses = $this->db->trans_commit();
        }

        return ($sukses ? C_STATUS_SUKSES_SIMPAN : C_STATUS_GAGAL_SIMPAN);
    }

    /*===== re insert data aktivasi =====*/
    function reinsert($data, $data2, $data3) {
        $sukses = 0;

        $this->db->trans_begin();

        $this->db->query("DELETE FROM JAIM_211_AGEN_PELAKSANA WHERE NOAKTIVASI = '$data[noaktivasi]'");
        $this->db->query("DELETE FROM JAIM_211_PELAKSANA_KEGIATAN WHERE NOAKTIVASI = '$data[noaktivasi]'");
        $this->db->query("DELETE FROM JAIM_211_AKTIVASI_PERENCANAAN WHERE NOAKTIVASI = '$data[noaktivasi]'");

        $this->db
            ->query("INSERT INTO JAIM_211_AKTIVASI_PERENCANAAN (NOAKTIVASI, KDKANTOR, KDJENISKEGIATAN, WAKTUPELAKSANAANAWAL, 
                         WAKTUPELAKSANAANAKHIR, TEMPAT, DESKRIPSI, POTENSIPREMIBERKALA, POTENSIPREMISEKALIGUS, POTENSIPROSPEK,
                         BIAYA, FILENOTADINAS)
                     VALUES ('$data[noaktivasi]', '$data[kdkantor]', '$data[kdjeniskegiatan]', 
                         TO_DATE('$data[waktupelaksanaanawal]', 'DD/MM/YYYY'), TO_DATE('$data[waktupelaksanaanakhir]', 'DD/MM/YYYY'),
                         '$data[tempat]', '$data[deskripsi]', TO_NUMBER('$data[potensipremiberkala]'), 
                         TO_NUMBER('$data[potensipremisekaligus]'), TO_NUMBER('$data[potensiprospek]'), '$data[biaya]',
                         '$data[filenotadinas]')");

        foreach ($data2 as $i => $v) {
            $this->db
                ->query("INSERT INTO JAIM_211_PELAKSANA_KEGIATAN (NOAKTIVASI, KDAREAOFFICE, KDKANTOR)
                     VALUES ('$v[noaktivasi]', '$v[kdareaoffice]', '$v[kdkantor]')");
        }

        foreach ($data3 as $i => $v) {
            $this->db
                ->query("INSERT INTO JAIM_211_AGEN_PELAKSANA (NOAKTIVASI, NOAGEN)
                     VALUES ('$v[noaktivasi]', '$v[noagen]')");
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        }
        else {
            $sukses = $this->db->trans_commit();
        }

        return ($sukses ? C_STATUS_SUKSES_SIMPAN : C_STATUS_GAGAL_SIMPAN);
    }

    /*===== insert data aktivasi =====*/
    function insert_monitor($data) {
        $sukses = 0;

        $this->db->trans_begin();

        $q = $this->db->query("SELECT * FROM jaim_212_monitor_aktivasi WHERE noaktivasi = '$data[noaktivasi]'");

        if ($q->num_rows() > 0) {
            $this->db
                ->query("UPDATE JAIM_212_MONITOR_AKTIVASI SET tglpelaksanaan = TO_DATE('$data[tglpelaksanaan]', 'DD/MM/YYYY'),
                             kendala = '$data[kendala]', solusi = '$data[solusi]'
                         WHERE noaktivasi = '$data[noaktivasi]'");
        } else {
            $this->db
                ->query("INSERT INTO JAIM_212_MONITOR_AKTIVASI (NOAKTIVASI, TGLPELAKSANAAN, KENDALA, SOLUSI)
                         VALUES ('$data[noaktivasi]', TO_DATE('$data[tglpelaksanaan]', 'DD/MM/YYYY'),
                             '$data[kendala]', '$data[solusi]')");
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        }
        else {
            $sukses = $this->db->trans_commit();
        }

        return ($sukses ? C_STATUS_SUKSES_SIMPAN : C_STATUS_GAGAL_SIMPAN);
    }

    /*===== update data aktivasi =====*/
    function update($data) {
        $sukses = 0;

        $this->db->trans_begin();

        $this->db
            ->query("UPDATE JAIM_211_AKTIVASI_PERENCANAAN SET
                         FILEJAWABANKP = '$data[filejawabankp]'
                     WHERE NOAKTIVASI = '$data[noaktivasi]'");

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        }
        else {
            $sukses = $this->db->trans_commit();
        }

        return ($sukses ? C_STATUS_SUKSES_SIMPAN : C_STATUS_GAGAL_SIMPAN);
    }

}