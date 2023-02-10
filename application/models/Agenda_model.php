<?php

class Agenda_model extends CI_Model {

    /*===== get daftar agenda by id =====*/
    function get_list_agenda($filter) {
        $data = array();

        $q = $this->db
            ->query("SELECT * FROM
        	(
        		SELECT tbl.*, rownum no
        		FROM
        		(
        			SELECT NOAGEN, AGENDA, TO_CHAR(NVL(TGLMULAI, TGLREKAM), 'DD/MM/YYYY HH24:MI:SS') TGLMULAI,
                        TO_CHAR(NVL(TGLSELESAI, TGLREKAM), 'DD/MM/YYYY HH24:MI:SS') TGLSELESAI,
                        TO_CHAR(NVL(TGLMULAI, TGLREKAM), 'YYYY') YMULAI, TO_NUMBER(TO_CHAR(NVL(TGLMULAI, TGLREKAM), 'MM')) MMULAI,
                        TO_CHAR(NVL(TGLMULAI, TGLREKAM), 'DD') DMULAI, TO_CHAR(NVL(TGLMULAI, TGLREKAM), 'HH24') HMULAI,
                        TO_CHAR(NVL(TGLMULAI, TGLREKAM), 'MI') IMULAI, TO_CHAR(NVL(TGLMULAI, TGLREKAM), 'SS') SMULAI,
                        TO_CHAR(NVL(TGLSELESAI, TGLREKAM), 'YYYY') YSELESAI, TO_CHAR(NVL(TGLSELESAI, TGLREKAM), 'MM') MSELESAI,
                        TO_CHAR(NVL(TGLSELESAI, TGLREKAM), 'DD') DSELESAI, TO_CHAR(NVL(TGLSELESAI, TGLREKAM), 'HH24') HSELESAI,
                        TO_CHAR(NVL(TGLSELESAI, TGLREKAM), 'MI') ISELESAI, TO_CHAR(NVL(TGLSELESAI, TGLREKAM), 'SS') SSELESAI,
                        TGLREKAM, USERREKAM, NOAGENDA
                    FROM JAIM_200_AGENDA
                    WHERE NOAGEN = '$filter[noagen]' AND (
                        LOWER(NOAGEN) LIKE '%$filter[s]%' OR
                        LOWER(AGENDA) LIKE '%$filter[s]%' OR
                        TO_CHAR(TGLMULAI, 'DD/MM/YYYY HH24:MI:SS') LIKE '%$filter[s]%' OR
                        TO_CHAR(TGLSELESAI, 'DD/MM/YYYY HH24:MI:SS') LIKE '%$filter[s]%'
                    )
        			ORDER BY TGLREKAM DESC
        		) tbl
        		WHERE rownum < ((".$filter['p']." * ".C_ROWS_PAGINATION.") + 1 )
        	)
        	WHERE no >= (((".$filter['p']."-1) * ".C_ROWS_PAGINATION.") + 1)");

        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }


    /*===== get last no agenda =====*/
    function get_last_no_agenda() {
        $lastno = null;

        $q = $this->db
            ->query("SELECT MAX(SUBSTR(NOAGENDA, 7, 6)) AS NO
                     FROM JAIM_200_AGENDA
                     WHERE SUBSTR(NOAGENDA, 3, 4) = TO_CHAR(SYSDATE, 'YYMM')
                         AND SUBSTR(NOAGENDA, 0, 2) = 'WA'");

        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $lastno = $data['NO'];
        }

        $q->free_result();

        return $lastno;
    }


    /*===== get no agen =====*/
    function get_noagen($iduser) {
        $noagen = null;

        $q = $this->db
            ->query("SELECT USERNAME NOAGEN FROM JAIM_900_USER WHERE IDUSER = '$iduser'");

        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $noagen = $data['NOAGEN'];
        }

        $q->free_result();

        return $noagen;
    }


    /*===== get total rows agenda =====*/
    function get_total_agenda($filter) {
        $rows = 0;

        $q = $this->db
            ->query("SELECT NOAGEN, AGENDA, TO_CHAR(TGLMULAI, 'DD/MM/YYYY HH24:MI:SS') TGLMULAI,
                        TO_CHAR(TGLSELESAI, 'DD/MM/YYYY HH24:MI:SS') TGLSELESAI, TO_CHAR(TGLMULAI, 'YYYY') YMULAI, TO_NUMBER(TO_CHAR(TGLMULAI, 'MM')) MMULAI,
                        TO_CHAR(TGLMULAI, 'DD') DMULAI, TO_CHAR(TGLMULAI, 'HH24') HMULAI, TO_CHAR(TGLMULAI, 'MI') IMULAI,
                        TO_CHAR(TGLMULAI, 'SS') SMULAI, TO_CHAR(TGLSELESAI, 'YYYY') YSELESAI, TO_CHAR(TGLSELESAI, 'MM') MSELESAI,
                        TO_CHAR(TGLSELESAI, 'DD') DSELESAI, TO_CHAR(TGLSELESAI, 'HH24') HSELESAI, TO_CHAR(TGLSELESAI, 'MI') ISELESAI,
                        TO_CHAR(TGLSELESAI, 'SS') SSELESAI, TGLREKAM, USERREKAM, NOAGENDA
                    FROM JAIM_200_AGENDA
                    WHERE NOAGEN = '$filter[noagen]' AND (
                        LOWER(NOAGEN) LIKE '%$filter[s]%' OR
                        LOWER(AGENDA) LIKE '%$filter[s]%' OR
                        TO_CHAR(TGLMULAI, 'DD/MM/YYYY HH24:MI:SS') LIKE '%$filter[s]%' OR
                        TO_CHAR(TGLSELESAI, 'DD/MM/YYYY HH24:MI:SS') LIKE '%$filter[s]%'
                    )
        			ORDER BY TGLREKAM DESC");

        $rows = $q->num_rows();

        return $rows;
    }


    /*===== insert data agenda =====*/
    function insert($data) {
        $sukses = 0;
        $noagen = $this->session->USERNAME;

        $this->db->trans_begin();

        $this->db
            ->query("INSERT INTO JAIM_200_AGENDA VALUES (
                     '$data[NOAGENDA]', '$noagen', '$data[AGENDA]', TO_DATE('$data[TGLMULAI]', 'DD/MM/YYYY HH24:MI:SS'),
                     TO_DATE('$data[TGLSELESAI]', 'DD/MM/YYYY HH24:MI:SS'),
                     TO_DATE(TO_CHAR(SYSDATE, 'DD/MM/YYYY HH24:MI:SS'), 'DD/MM/YYYY HH24:MI:SS'), '$noagen')");

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        }
        else {
            $sukses = $this->db->trans_commit();
        }

        return ($sukses ? C_STATUS_SUKSES_SIMPAN : C_STATUS_GAGAL_SIMPAN);
    }


    /*===== update data agenda =====*/
    function update($noagenda, $data) {
        $sukses = 0;

        $this->db->trans_begin();

        $this->db
            ->query("UPDATE JAIM_200_AGENDA SET
                         AGENDA = '$data[AGENDA]',
                         TGLMULAI = TO_DATE('$data[TGLMULAI]', 'DD/MM/YYYY HH24:MI:SS'),
                         TGLSELESAI = TO_DATE('$data[TGLSELESAI]', 'DD/MM/YYYY HH24:MI:SS')
                     WHERE NOAGENDA = '$noagenda'");

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        }
        else {
            $sukses = $this->db->trans_commit();
        }

        return ($sukses ? C_STATUS_SUKSES_SIMPAN : C_STATUS_GAGAL_SIMPAN);
    }


    /*===== delete data agenda =====*/
    function delete($noagenda) {
        $sukses = 0;

        $this->db->trans_begin();

        $this->db
            ->query("DELETE FROM JAIM_200_AGENDA WHERE NOAGENDA = '$noagenda'");

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        }
        else {
            $sukses = $this->db->trans_commit();
        }

        return ($sukses ? C_STATUS_SUKSES_HAPUS : C_STATUS_GAGAL_HAPUS);
    }


    /*===== get daftar agenda agen se cabang by id =====*/
    function get_list_agenda_se_cabang_wilayah($filter) {
        $data = array();

        $q = $this->db
            ->query("SELECT * FROM
        	(
        		SELECT tbl.*, rownum no
        		FROM
        		(
        			SELECT NOAGEN, AGENDA, TO_CHAR(TGLMULAI, 'DD/MM/YYYY HH24:MI:SS') TGLMULAI,
                        TO_CHAR(TGLSELESAI, 'DD/MM/YYYY HH24:MI:SS') TGLSELESAI, TO_CHAR(TGLMULAI, 'YYYY') YMULAI, TO_NUMBER(TO_CHAR(TGLMULAI, 'MM')) MMULAI,
                        TO_CHAR(TGLMULAI, 'DD') DMULAI, TO_CHAR(TGLMULAI, 'HH24') HMULAI, TO_CHAR(TGLMULAI, 'MI') IMULAI,
                        TO_CHAR(TGLMULAI, 'SS') SMULAI, TO_CHAR(TGLSELESAI, 'YYYY') YSELESAI, TO_CHAR(TGLSELESAI, 'MM') MSELESAI,
                        TO_CHAR(TGLSELESAI, 'DD') DSELESAI, TO_CHAR(TGLSELESAI, 'HH24') HSELESAI, TO_CHAR(TGLSELESAI, 'MI') ISELESAI,
                        TO_CHAR(TGLSELESAI, 'SS') SSELESAI, TGLREKAM, USERREKAM, NOAGENDA
                    FROM JAIM_200_AGENDA
                    WHERE NOAGEN IN $filter[noagen] AND (
                        LOWER(NOAGEN) LIKE '%$filter[s]%' OR
                        LOWER(AGENDA) LIKE '%$filter[s]%' OR
                        TO_CHAR(TGLMULAI, 'DD/MM/YYYY HH24:MI:SS') LIKE '%$filter[s]%' OR
                        TO_CHAR(TGLSELESAI, 'DD/MM/YYYY HH24:MI:SS') LIKE '%$filter[s]%'
                    )
        			ORDER BY TGLREKAM DESC
        		) tbl
        		WHERE rownum < ((".$filter['p']." * ".C_ROWS_PAGINATION.") + 1 )
        	)
        	WHERE no >= (((".$filter['p']."-1) * ".C_ROWS_PAGINATION.") + 1)");

        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }


    /*===== get total rows agenda se cabang =====*/
    function get_total_agenda_se_cabang_wilayah($filter) {
        $rows = 0;

        $q = $this->db
            ->query("SELECT NOAGEN, AGENDA, TO_CHAR(TGLMULAI, 'DD/MM/YYYY HH24:MI:SS') TGLMULAI,
                        TO_CHAR(TGLSELESAI, 'DD/MM/YYYY HH24:MI:SS') TGLSELESAI, TO_CHAR(TGLMULAI, 'YYYY') YMULAI, TO_NUMBER(TO_CHAR(TGLMULAI, 'MM')) MMULAI,
                        TO_CHAR(TGLMULAI, 'DD') DMULAI, TO_CHAR(TGLMULAI, 'HH24') HMULAI, TO_CHAR(TGLMULAI, 'MI') IMULAI,
                        TO_CHAR(TGLMULAI, 'SS') SMULAI, TO_CHAR(TGLSELESAI, 'YYYY') YSELESAI, TO_CHAR(TGLSELESAI, 'MM') MSELESAI,
                        TO_CHAR(TGLSELESAI, 'DD') DSELESAI, TO_CHAR(TGLSELESAI, 'HH24') HSELESAI, TO_CHAR(TGLSELESAI, 'MI') ISELESAI,
                        TO_CHAR(TGLSELESAI, 'SS') SSELESAI, TGLREKAM, USERREKAM, NOAGENDA
                    FROM JAIM_200_AGENDA
                    WHERE NOAGEN IN $filter[noagen] AND (
                        LOWER(NOAGEN) LIKE '%$filter[s]%' OR
                        LOWER(AGENDA) LIKE '%$filter[s]%' OR
                        TO_CHAR(TGLMULAI, 'DD/MM/YYYY HH24:MI:SS') LIKE '%$filter[s]%' OR
                        TO_CHAR(TGLSELESAI, 'DD/MM/YYYY HH24:MI:SS') LIKE '%$filter[s]%'
                    )
        			ORDER BY TGLREKAM DESC");

        $rows = $q->num_rows();

        return $rows;
    }
}