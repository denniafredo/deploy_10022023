<?php

class Mproduct extends CI_Model {

    /*===== daftar product asuransi individu =====*/
    function get_list_product() {
        $DB = $this->load->database('website', TRUE);
        $data = array();

        $sql = "SELECT *
                FROM (SELECT f.name PRODUCT_TYPE, g.name SUB_PRODUCT1, h.name SUB_PRODUCT2, i.name SUB_PRODUCT3, 
                        j.name SUB_PRODUCT4, l.title TITLE, m.body_value DESCRIPTION, field_usia_masuk_minimum_value USIA_MIN,
                        field_usia_masuk_maksimum_value USIA_MAKS, field_masa_pertanggungan_value MASA_PERTANGGUNGAN,
                        CASE WHEN q.field_mata_uang_value = '1' THEN 'Rupiah' WHEN q.field_mata_uang_value = '2' THEN 'US Dollar' END MATA_UANG,
                        TRIM(r.cara_bayar) CARA_BAYAR, t.uri GAMBAR, 
                        CASE WHEN k.entity_id = '4817' THEN 2 ELSE k.entity_id END AS ENTITY_ID, 
                        CASE WHEN k.entity_id = '4817' THEN 2 ELSE 999 END AS URUTAN
                    FROM taxonomy_term_hierarchy a
                    LEFT OUTER JOIN taxonomy_term_hierarchy b ON a.tid = b.parent
                    LEFT OUTER JOIN taxonomy_term_hierarchy c ON b.tid = c.parent
                    LEFT OUTER JOIN taxonomy_term_hierarchy d ON c.tid = d.parent
                    LEFT OUTER JOIN taxonomy_term_hierarchy e ON d.tid = e.parent
                    INNER JOIN taxonomy_term_data f ON a.tid = f.tid
                    LEFT OUTER JOIN taxonomy_term_data g ON b.tid = g.tid
                    LEFT OUTER JOIN taxonomy_term_data h ON c.tid = h.tid
                    LEFT OUTER JOIN taxonomy_term_data i ON d.tid = i.tid
                    LEFT OUTER JOIN taxonomy_term_data j ON e.tid = j.tid
                    INNER JOIN field_data_field_product_types k ON IFNULL(IFNULL(IFNULL(IFNULL(e.tid, d.tid), c.tid), b.tid), a.tid) = k.field_product_types_tid
                    INNER JOIN node l ON k.entity_id = l.nid
                    INNER JOIN field_data_body m ON k.entity_id = m.entity_id
                    LEFT OUTER JOIN field_data_field_usia_masuk_minimum n ON k.entity_id = n.entity_id
                    LEFT OUTER JOIN field_data_field_usia_masuk_maksimum o ON k.entity_id = o.entity_id
                    LEFT OUTER JOIN field_data_field_masa_pertanggungan p ON k.entity_id = p.entity_id
                    LEFT OUTER JOIN field_data_field_mata_uang q ON k.entity_id = q.entity_id
                    LEFT OUTER JOIN (
                        SELECT entity_id, GROUP_CONCAT(CASE WHEN field_cara_bayar_value = '1' THEN ' Tahunan' WHEN field_cara_bayar_value = '2' THEN ' Semesteran'
                            WHEN field_cara_bayar_value = '3' THEN ' Kuartalan' WHEN field_cara_bayar_value = '4' THEN ' Bulanan'
                            WHEN field_cara_bayar_value = '5' THEN ' Sekaligus' END) cara_bayar
                        FROM field_data_field_cara_bayar
                        GROUP BY entity_id
                    ) r ON k.entity_id = r.entity_id
                    LEFT OUTER JOIN file_usage s ON k.entity_id = s.id
                    LEFT OUTER JOIN file_managed t ON s.fid = t.fid 
                    WHERE a.parent = '1'
                        AND l.status = '1'
                        AND t.uri LIKE '%cover%'
                        
                    UNION ALL 
                    
                    SELECT 'Proteksi' PRODUCT_TYPE, null, null, null, null, 'JS Mikro Sahabat' TITLE, 'Program Asuransi Mikro Sahabat pada dasarnya merupakan asuransi 
                        yang diarahkan untuk memberikan jaminan perlindungan khususnya atas Resiko yang diakibatkan oleh kecelakan, atau resiko bukan akibat kecelakaan.' DESCRIPTION,
                        6 USIA_MIN, 69 USIA_MAKS, '1 Tahun' MASA_PERTANGGUNGAN, 'Rupiah' MATA_UANG, 'Sekaligus' CARA_BAYAR, null, 1 ENTITY_ID, 1 URUTAN
                    FROM DUAL
                ) z
                ORDER BY URUTAN, PRODUCT_TYPE, TITLE";

        $db = $DB->query($sql);
        if ($db->num_rows() > 0)
            $data = $db->result_array();

        $db->free_result();

        return $data;
    }

    /*===== daftar manfaat produk asuransi individu =====*/
    function get_list_manfaat($id) {
        $DB = $this->load->database('website', TRUE);
        $data = array();

        $sql = "SELECT 'Manfaat Meninggal dunia' JUDUL_MANFAAT, 
                    'Jaminan pembayaran santunan rawat inap di Rumah Sakit dan 100% uang pertanggungan apabila tertanggung meninggal dunia karena Demam Berdarah' DESC_MANFAAT,
                    0 entity_id
                FROM DUAL
                WHERE '2' = '$id'
                
                UNION ALL
                
                SELECT title JUDUL_MANFAAT, body_value DESC_MANFAAT, a.entity_id
                FROM field_data_field_product_referenced a
                INNER JOIN node b ON a.entity_id = b.nid
                INNER JOIN field_data_body c ON a.entity_id = c.entity_id
                WHERE a.field_product_referenced_nid = '$id'
                ORDER BY entity_id";

        $db = $DB->query($sql);
        if ($db->num_rows() > 0)
            $data = $db->result_array();

        $db->free_result();

        return $data;
    }
}