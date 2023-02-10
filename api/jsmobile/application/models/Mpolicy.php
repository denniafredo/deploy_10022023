<?php

class Mpolicy extends CI_Model {

    /*===== daftar pertanggungan by no klien =====*/
    function get_list_polis_by_noklien($noklien) {
        $data = array();
        $noklien = $this->db->escape($noklien);

        $sql = "SELECT b.namaproduk policy_name, a.prefixpertanggungan || a.nopertanggungan policy_number, 
                    to_char(a.mulas,'dd/mm/yyyy') start_date, to_char(a.expirasi,'dd/mm/yyyy') due_date, 
                    a.kdstatusfile policy_status_code
                FROM jsadm.tabel_200_pertanggungan".C_DBL." a
                LEFT OUTER JOIN jsadm.tabel_202_produk".C_DBL." b ON a.kdproduk = b.kdproduk
                WHERE a.nopemegangpolis = $noklien
                    AND a.kdstatusfile IN ('1', '4')
                ORDER BY kdstatusfile";

        $db = $this->db->query($sql);
        if ($db->num_rows() > 0)
            $data = $db->result_array();

        $db->free_result();

        return $data;
    }


    /*===== daftar benefit by no polis =====*/
    function get_list_benefit_polis($prefix, $noper) {
        $data = array();
        $prefix = $this->db->escape($prefix);
        $noper = $this->db->escape($noper);

        $sql = "SELECT b.namabenefit benefit_name, a.nilaibenefit amount, to_char(a.expirasi,'dd/mm/yyyy') due_date, 
                    a.premi premium
                FROM jsadm.tabel_223_transaksi_produk".C_DBL." a
                INNER JOIN jsadm.tabel_207_kode_benefit".C_DBL." b ON a.kdbenefit = b.kdbenefit
                WHERE a.prefixpertanggungan = $prefix AND a.nopertanggungan = $noper
                    AND a.kdbenefit NOT IN ('TTPPREM', 'KMSTTPJL')
                ORDER BY a.expirasi";

        $db = $this->db->query($sql);
        if ($db->num_rows() > 0)
            $data = $db->result_array();

        $db->free_result();

        return $data;
    }


    /*===== daftar nilai tebus by no polis =====*/
    function get_list_nilai_tebus_polis($prefix, $noper) {
        $data = array();
        $prefix = $this->db->escape($prefix);
        $noper = $this->db->escape($noper);

        $sql = "SELECT kdproduk, premi1, juamainproduk, kdvaluta, 
                    NVL((SELECT jualama 
                         FROM jsadm.polis_history_jua".C_DBL." 
                         WHERE prefixpertanggungan = $prefix 
                            AND nopertanggungan = $noper
                            AND tglmutasi = (SELECT MAX(tglmutasi) 
                                             FROM jsadm.polis_history_jua".C_DBL." 
                                             WHERE prefixpertanggungan = $prefix  
                                                AND nopertanggungan = $noper)
                        ), juamainproduk) jua
                FROM jsadm.tabel_200_pertanggungan".C_DBL." 
                WHERE prefixpertanggungan = $prefix
                    AND nopertanggungan = $noper";

        $db = $this->db->query($sql);
        $r = $db->row_array();

        $tabeltebus = substr($r['KDPRODUK'],0,4)=="JSAP" ? "jsadm.tabel_231_tarif_tebus_ms".C_DBL : "jsadm.tabel_231_tarif_tebus".C_DBL;
        $sql = "SELECT t, tarif 
                FROM $tabeltebus
                WHERE (kdproduk,masa,cara,usia,kdvaluta,kdbasis) = (
                    SELECT a.kdproduk,a.lamapembpremi_th,
                        decode(a.kdcarabayar,'E','E','J','J','X','X','M','M','Q','Q','H','H','A','A',/*'1','M',*/'B'),
                        a.usia_th,a.kdvaluta,b.kdbasistebus
                    FROM jsadm.tabel_200_pertanggungan".C_DBL." a,jsadm.tabel_247_pertanggungan_basis".C_DBL." b
                    WHERE a.prefixpertanggungan=b.prefixpertanggungan 
                        AND a.nopertanggungan=b.nopertanggungan 
                        AND a.prefixpertanggungan = $prefix 
                        AND a.nopertanggungan=$noper
                )
                    AND kdtarif='TEBUS'
                ORDER BY t";
        $db = $this->db->query($sql);
        $arrtarif = $db->result_array();

        $i = 0;
        foreach ($arrtarif as $i => $v) {
            if ($v['TARIF'] <> 0) {
                $data[$i]['NO'] = $i+1;

                if ($r['KDVALUTA'] == '1') {
                    if (substr($r['KDPRODUK'],0,4)=="JSSP" || substr($r['KDPRODUK'],0,4)=="JSSH") {
                        if ($r['KDPRODUK']=='JSSPO4'||$r['KDPRODUK']=='JSSPO5'||$r['KDPRODUK']=='JSSPO6'||$r['KDPRODUK']=='JSSPO9x' ){
                            $data[$i]['AMOUNT'] = number_format($r['PREMI1']/1000*$v["TARIF"],0,',','.');
                        } elseif ($r['KDPRODUK']=='JSSPO7A'||$r['KDPRODUK']=='JSSPO8'||$r['KDPRODUK']=='JSSPO9' || substr($r['KDPRODUK'],0,4)=="JSSHx" ){
                            $data[$i]['AMOUNT'] = number_format($r['PREMI1']/769.23*$v["TARIF"],0,',','.');
                        } else {
                            $data[$i]['AMOUNT'] = number_format(round($r['JUA']/1000*$v["TARIF"],-3),0,',','.');
                        }
                    } elseif ($r['KDPRODUK']=='JSPEI5' || $r['KDPRODUK']=='JSPEIP' || $r['KDPRODUK']=='JSPEIPN') {
                        $data[$i]['AMOUNT'] = number_format($r['PREMI1']/1000*$v["TARIF"],0,',','.');
                    } elseif ($r['KDPRODUK']=='JSKPD') {
                        $data[$i]['AMOUNT'] = number_format(round($r['JUAMAINPRODUK']/1000*$v["TARIF"],-3),0,',','.');
                    } elseif ($r['KDPRODUK']=='JSPNSK' || $r['KDPRODUK']=='JSPNSB') {
                        $data[$i]['AMOUNT'] = number_format(round($r['JUAMAINPRODUK']/100*$v["TARIF"],-3),0,',','.');
                    } else {
                        $data[$i]['AMOUNT'] = number_format(round($r['JUAMAINPRODUK']/1000*$v["TARIF"],0),0,',','.');
                    }
                } else {
                    $data[$i]['AMOUNT'] = number_format(round($r['JUAMAINPRODUK']/1000*$v["TARIF"],2),2,',','.');
                }

                $i++;
            }
        }

        $db->free_result();

        return $data;
    }


    /*===== daftar ahli waris by no polis =====*/
    function get_list_ahliwaris_polis($prefix, $noper) {
        $data = array();
        $prefix = $this->db->escape($prefix);
        $noper = $this->db->escape($noper);

        $sql = "SELECT d.namaklien1 beneficiary_name, c.namahubungan relationship
                FROM jsadm.tabel_200_pertanggungan".C_DBL." a
                INNER JOIN jsadm.tabel_219_pemegang_polis_baw".C_DBL." b ON a.notertanggung = b.notertanggung
                    AND a.prefixpertanggungan = b.prefixpertanggungan AND a.nopertanggungan = b.nopertanggungan
                INNER JOIN jsadm.tabel_218_kode_hubungan".C_DBL." c ON b.kdinsurable = c.kdhubungan
                INNER JOIN jsadm.tabel_100_klien".C_DBL." d ON b.noklien = d.noklien
                WHERE a.prefixpertanggungan = $prefix AND a.nopertanggungan = $noper
                ORDER BY b.nourut";

        $db = $this->db->query($sql);
        if ($db->num_rows() > 0)
            $data = $db->result_array();

        $db->free_result();

        return $data;
    }


    /*===== daftar historis premi by no polis =====*/
    function get_list_historis_premi_polis($prefix, $noper) {
        $data = array();
        $prefix = $this->db->escape($prefix);
        $noper = $this->db->escape($noper);

        $sql = "SELECT to_char(a.tglbooked,'DD/MM/YYYY') booked_date, to_char(a.tglseatled,'DD/MM/YYYY') seatled_date,
                    to_char(a.tglbayar,'DD/MM/YYYY') payment_date, a.premitagihan premium, b.namavaluta currency
                FROM jsadm.tabel_300_historis_premi".C_DBL." a
                INNER JOIN jsadm.tabel_304_valuta".C_DBL." b ON a.kdvaluta = b.kdvaluta
                WHERE a.prefixpertanggungan = $prefix and a.nopertanggungan = $noper
                ORDER BY a.tglbooked DESC";

        $db = $this->db->query($sql);
        if ($db->num_rows() > 0)
            $data = $db->result_array();

        $db->free_result();

        return $data;
    }

    
    /*===== daftar historis premi by no polis & no sertifikat =====*/
    function get_list_historis_soe_premi_polis($nopolis, $noklien, $productcode) {
        $data = array();
        $nopolis = $this->db->escape($nopolis);
        $noklien = $this->db->escape($noklien);

        if ($productcode == C_KD_PRODUK_PMK) {
            $DB = $this->load->database('plindo', TRUE);
            
            $sql = "SELECT TO_CHAR(a.tgl_tagihan, 'dd/mm/yyyy') billing_date, TO_CHAR(a.tgl_bayar, 'dd/mm/yyyy') payment_date, 
                        TO_CHAR(a.tgl_pembukuan, 'dd/mm/yyyy') seatled_date, a.nilai_premi premium, a.kd_kuitansi receipt_code, 
                        b.nama_kuitansi receipt_name
                    FROM kartu_premi_sementara a
                    INNER JOIN jenis_kuitansi b ON a.kd_kuitansi = b.kd_kuitansi
                    WHERE a.no_pol = $nopolis
                        AND a.no_klien = $noklien
                    ORDER BY a.tgl_tagihan, a.kd_kuitansi";

            $db = $DB->query($sql);
            if ($db->num_rows() > 0)
                $data = $db->result_array();
        }
        else if ($productcode == C_KD_PRODUK_MICRO) {
            $DB = $this->load->database('micro', TRUE);
            
            $sql = "SELECT DATE_FORMAT(a.create_time, '%d/%m/%Y') BILLING_DATE, DATE_FORMAT(a.paid_time, '%d/%m/%Y') PAYMENT_DATE,
                        DATE_FORMAT(a.paid_time, '%d/%m/%Y') SEATLED_DATE, a.amount PREMIUM, 'BP3' RECEIPT_CODE, '' RECEIPT_NAME
                    FROM js_micro_mobileapps a
                    WHERE a.certificate_number = $nopolis
                    AND a.id_card_number = $noklien";
            
            $db = $DB->query($sql);
            if ($db->num_rows() > 0)
                $data = $db->result_array();
        }

        $db->free_result();

        return $data;
    }
    

    /*===== daftar transaksi js link by no polis =====*/
    function get_list_transaksi_jslink($prefix, $noper) {
        $data = array();
        $prefix = $this->db->escape($prefix);
        $noper = $this->db->escape($noper);

        // JL4
        $sql = "SELECT a.kdfund, b.namafund, a.prefixpertanggungan || a.nopertanggungan nopolis, c.nab_jual nabjual,
                    SUM(d.unit * 
                        CASE d.trx_type 
                            WHEN 'S' THEN 1
                            WHEN 'T' THEN 1
                            WHEN 'R' THEN -1
                            WHEN 'C' THEN -1
                        END
                    ) saldo,
                    SUM(d.unit * 
                        CASE d.trx_type 
                            WHEN 'S' THEN 1
                            WHEN 'T' THEN 1
                            WHEN 'R' THEN -1
                            WHEN 'C' THEN -1
                        END
                    ) * c.nab_jual TOTAL
                FROM jsadm.tabel_ul_opsi_fund".C_DBL." a
                INNER JOIN jsadm.tabel_ul_kode_fund".C_DBL." b ON a.kdfund = b.kdfund
                LEFT OUTER JOIN jsadm.tabel_ul_nab".C_DBL." c ON a.kdfund = c.kode_fund
                LEFT OUTER JOIN jsadm.tabel_ul_transaksi".C_DBL." d ON a.kdfund = SUBSTR(d.kode_fund, -2)
                    AND a.prefixpertanggungan = SUBSTR(d.nomor_polis, 0, 2)
                    AND a.nopertanggungan = SUBSTR(d.nomor_polis, 3) 
                WHERE a.prefixpertanggungan = $prefix
                    AND a.nopertanggungan = $noper
                    AND c.tgl_nab IN (
                        SELECT MAX(tgl_nab)
                        FROM jsadm.tabel_ul_nab".C_DBL."
                        WHERE kode_fund = a.kdfund
                    )
                GROUP BY a.prefixpertanggungan, a.nopertanggungan, b.namafund, a.kdfund, c.nab_jual";

        $db = $this->db->query($sql);
        $alokasi = $db->result_array();

        foreach ($alokasi as $i => $v) {
            $data[$i]['NOMOR_POLIS'] = $v['NOPOLIS'];
            $data[$i]['KDFUND'] = $v['KDFUND'];
            $data[$i]['FUND_ALLOCATION'] = $v['NAMAFUND'];
            $data[$i]['BALANCE'] = $v['SALDO'];
            $data[$i]['NAVSELL'] = $v['NABJUAL'];
            $data[$i]['AMOUNT'] = $v['TOTAL'];

            $sql = "SELECT a.*
                        FROM (
                            SELECT TO_CHAR (trx_date, 'DD/MM/YYYY') AS transaction_date, a.trx_type, rp_nett amount,
                                CASE WHEN (a.description = 'SUBSCRIPTION SWITCHING FUND' AND a.trx_type = 'S') OR a.trx_type = 'R' OR a.trx_type = 'C' THEN nab_beli
                                  WHEN (a.description != 'SUBSCRIPTION SWITCHING FUND' AND a.trx_type = 'S') OR a.trx_type = 'T' THEN nab_jual END net_asset_value,
                                CASE WHEN a.trx_type = 'R' OR a.trx_type = 'C' THEN -1*unit ELSE unit END unit,
                                CASE WHEN b.keterangan IS NULL OR b.keterangan = '' THEN a.description
                                  WHEN b.keterangan = 'GOOD FUND REDEMPTION COA+COR' THEN 'Good Fund ' || a.description
                                  WHEN b.keterangan = 'APPROVE REDEMPTION OK (AKUNTANSI)' OR b.keterangan = 'TRANSFER KE PP' THEN b.keterangan || ' Pada tgl. ' || tgl_verifikasi
                                  ELSE b.keterangan END status
                            FROM jsadm.tabel_ul_transaksi".C_DBL." a
                            LEFT OUTER JOIN jsadm.tabel_ul_st_proses".C_DBL." b ON a.trx_type = b.trx_type
                                AND a.st_proses = b.st_proses AND a.status = b.status AND b.deskripsi = substr(a.description, 1, 12)
                            WHERE a.status IN ('GOOD FUND', 'SEND', 'NEW')
                                AND nomor_polis = '$v[NOPOLIS]'
                                AND a.st_proses <> 'X'
                                AND substr(kode_fund, -2) = '$v[KDFUND]'
                            ORDER BY trx_date DESC
                            ) a
                    WHERE ROWNUM < 11";

            $db = $this->db->query($sql);
            $data[$i]['DATA'] = $db->result_array();
        }

        $db->free_result();

        return $data;
    }


    /*===== daftar sisa unit untuk di redempt by no polis =====*/
    function get_list_sisa_unit_jslink($nopolis) {
        $data = array();
        $nopolis = $this->db->escape($nopolis);

        $sql = "SELECT nomor_polis,
                    SUM(unit * 
                        CASE trx_type 
                            WHEN 'S' THEN 1
                            WHEN 'T' THEN 1
                            WHEN 'R' THEN -1
                            WHEN 'C' THEN -1
                        END
                    ) saldo,
                    SUBSTR(a.kode_fund, -2) fund,
                    b.namafund, c.nab_jual
                FROM jsadm.tabel_ul_transaksi".C_DBL." a
                LEFT OUTER JOIN jsadm.tabel_ul_kode_fund".C_DBL." b ON SUBSTR(a.kode_fund, -2) = b.kdfund
                LEFT OUTER JOIN jsadm.tabel_ul_nab".C_DBL." c ON SUBSTR(a.kode_fund, -2) = c.kode_fund
                WHERE nomor_polis = $nopolis
                    AND status = 'GOOD FUND'
                    AND st_proses <> 'X'
                    AND c.tgl_nab IN (
                        SELECT MAX(tgl_nab) 
                        FROM jsadm.tabel_ul_nab".C_DBL."
                        WHERE kode_fund = SUBSTR(a.kode_fund, -2)
                    )
                GROUP BY nomor_polis, a.kode_fund, b.namafund, c.nab_jual";

        $db = $this->db->query($sql);
        if ($db->num_rows() > 0)
            $data = $db->result_array();

        $db->free_result();

        return $data;
    }


    /*===== daftar status klaim redempt by no klien =====*/
    function get_list_status_redempt($noklien) {
        $data = array();
        $noklien = $this->db->escape($noklien);

        $sql = "SELECT a.prefixpertanggungan || a.nopertanggungan nopolis, a.confirmid, b.namastatus, a.jumlah, a.kode_jenis,
                    TO_CHAR(a.tgl_pengajuan, 'dd') || ' ' || TRIM(TO_CHAR(a.tgl_pengajuan, 'Month')) || ' ' || TO_CHAR(a.tgl_pengajuan, 'yyyy') tglpengajuan
                FROM jsadm.tabel_901_pengajuan_redempt_ol".C_DBL." a
                INNER JOIN jsadm.tabel_999_kode_status".C_DBL." b ON a.status = b.kdstatus
                    AND b.jenisstatus = 'KLAIM'
                WHERE clientid = $noklien
                ORDER BY a.tgl_pengajuan DESC";

        $db = $this->db->query($sql);
        if ($db->num_rows() > 0)
            $data = $db->result_array();

        $db->free_result();

        return $data;
    }
    
    
    /*===== daftar sertifikat polis kumpulan =====*/
    function get_list_sertifikat_soe_by_email($email) {
        $DB = $this->load->database('plindo', TRUE);
        $DB2 = $this->load->database('micro', TRUE);
        $data = array();
        $email = $this->db->escape($email);

        // C_KD_PRODUK_PMK
        $sql = "SELECT e.nama_produk policy_product, e.keterangan policy_product_description, b.no_polis policy_number, c.pemegang_polis policy_name, 
                    TO_CHAR(MIN(b.tgl_mulas), 'dd/mm/yyyy') start_date, TO_CHAR(MAX(b.tgl_akhas), 'dd/mm/yyyy') end_date, a.no_sertifikat certificate_number, 
                    a.no_klien client_number, TRIM(MAX(a.nama_klien)) participant_name, MAX(status) certificate_status, '".C_KD_PRODUK_PMK."' product_code
                FROM klien a
                INNER JOIN polis_peserta b ON a.no_klien = b.no_klien
                INNER JOIN polis c ON b.no_polis = c.no_polis
                LEFT OUTER JOIN polis_produk d ON b.no_polis = d.no_polis
                LEFT OUTER JOIN produk e ON d.kd_produk = e.kd_produk
                WHERE a.email = $email
                    AND status = '1'
                GROUP BY b.no_polis, c.pemegang_polis, a.no_sertifikat, a.no_klien, e.nama_produk, e.keterangan";

        $db = $DB->query($sql);
        if ($db->num_rows() > 0)
            $data = $db->result_array();

        $db->free_result();
        
        // C_KD_PRODUK_MICRO
        $sql = "SELECT a.product_code POLICY_PRODUCT, 'JS Mikro Sahabat' POLICY_PRODUCT_DESCRIPTION, a.certificate_number POLICY_NUMBER, a.full_name POLICY_NAME, 
                    DATE_FORMAT(a.paid_time, '%d/%m/%Y') START_DATE, DATE_FORMAT(DATE_ADD(a.paid_time, INTERVAL 1 YEAR), '%d/%m/%Y') END_DATE, 
                    a.certificate_number CERTIFICATE_NUMBER, a.id_card_number CLIENT_NUMBER, a.full_name PARTICIPANT_NAME, a.status CERTIFICATE_STATUS, 
                    '".C_KD_PRODUK_MICRO."' PRODUCT_CODE
                FROM js_micro_mobileapps a
                WHERE (email_address = $email AND status = 1)
                    OR (email_address = $email AND status = 0 AND DATE_ADD(a.create_time, INTERVAL 1 DAY) >= sysdate())";
        
        $db = $DB2->query($sql);
        if ($db->num_rows() > 0)
            $data = array_merge($data, $db->result_array());

        $db->free_result();

        return $data;
    }


    /*===== data tertanggung by no polis =====*/
    function get_tertanggung_by_polis($prefix, $noper) {
        $data = array();
        $prefix = $this->db->escape($prefix);
        $noper = $this->db->escape($noper);

        $sql = "SELECT prefixpertanggungan, nopertanggungan, a.notertanggung, 
                    TRIM(NVL(b.emailtetap, b.emailtagih)) email, b.noklien, 
                    TRIM(NVL(NVL(b.no_ponsel, b.phonetetap01), b.phonetagih01)) nohp,
                    b.fax_rmh fax, namaklien1 namalengkap, TO_CHAR(tgllahir, 'dd-mm-yyyy') tgllahir,
                    trim(jeniskelamin) jeniskelamin, alamattetap01 || ' ' || alamattetap02 alamat,
                    b.kdkotamadyatetap kdkota, c.namakotamadya kota, 
                    c.kdpropinsi, namapropinsi propinsi, b.kodepostetap kdpos
                FROM jsadm.tabel_200_pertanggungan".C_DBL." a 
                LEFT OUTER JOIN jsadm.tabel_100_klien".C_DBL." b ON a.nopemegangpolis = b.noklien 
                LEFT OUTER JOIN jsadm.tabel_109_kotamadya".C_DBL." c ON b.kdkotamadyatetap = c.kdkotamadya 
                LEFT OUTER JOIN jsadm.tabel_108_propinsi".C_DBL." d ON c.kdpropinsi = d.kdpropinsi
                WHERE prefixpertanggungan = $prefix 
                    AND nopertanggungan = $noper";

        $db = $this->db->query($sql);
        if ($db->num_rows() > 0)
            $data = $db->row_array();

        $db->free_result();

        return $data;
    }
    
    
    /*===== data peserta by email & nik =====*/
    function get_peserta_by_email($email) {
        $data = array();
        $email = $this->db->escape($email);
        
        $sql = "SELECT kdsoe
                FROM tabel_soe
                WHERE LOWER($email) LIKE '%' || LOWER(email) || '%'
                    AND aktif = 1";
        
        $db = $this->db->query($sql);
        if ($db->num_rows() > 0)
            $data = $db->row_array();
        
        $db->free_result();
        
        return $data;
    }


    /*===== data polis by no polis =====*/
    function get_polis_by_no_polis($prefix, $noper) {
        $data = array();
        $prefix = $this->db->escape($prefix);
        $noper = $this->db->escape($noper);

        $sql = "SELECT a.nopol || ' / ' || a.prefixpertanggungan || '-' || a.nopertanggungan policy_number,
                    a.nosp application_number, to_char(tglsp,'dd/mm/yyyy') application_date,
					a.kdproduk,
                    b.namaproduk policy_name, usia_th || ' tahun, ' || usia_bl || ' bulan' entry_age,
                    to_char(a.mulas,'dd/mm/yyyy') start_date, to_char(a.expirasi,'dd/mm/yyyy') due_date,
                    a.lamaasuransi_th || ' tahun, ' || a.lamaasuransi_bl || ' bulan' duration,
                    a.lamapembpremi_th || ' tahun, ' || a.lamapembpremi_bl || ' bulan' payment_duration,
                    to_char(a.tglakhirpremi, 'dd/mm/yyyy') payment_due_date, c.namacarabayar payment_method,
                    case when a.autodebet = '1' then 'Ya, Rekening ' || d.namabank || ' No. ' || a.norekeningdebet else 'Tidak' end autodebet,
                    decode(a.kdvaluta,'0','RUPIAH INDEX','1','RUPIAH','DOLLAR AS') currency, a.indexawal initial_index,
                    decode(a.kdstatusmedical,'M','Medical','Non Medical') medical_status, a.juamainproduk sum_assured,
                    a.premistd standard_premium, a.premi1 premium_first_5_years, a.premi2 premium_after_5_years,
                    a.tglnextbook premium_due_date, e.namaklien1 agent, f.namaklien1 biller, g.namastatusfile policy_status,
                    a.kdstatusfile policy_status_code, h.notasi notation
                FROM jsadm.tabel_200_pertanggungan".C_DBL." a
                INNER JOIN jsadm.tabel_202_produk".C_DBL." b ON a.kdproduk = b.kdproduk
                INNER JOIN jsadm.tabel_305_cara_bayar".C_DBL." c ON a.kdcarabayar = c.kdcarabayar
                LEFT OUTER JOIN jsadm.tabel_399_bank".C_DBL." d ON a.kdbank = d.kdbank
                LEFT OUTER JOIN jsadm.tabel_100_klien".C_DBL." e ON a.noagen = e.noklien AND e.kdklien = 'A'
                LEFT OUTER JOIN jsadm.tabel_100_klien".C_DBL." f ON a.nopenagih = f.noklien AND f.kdklien = 'P'
                LEFT OUTER JOIN jsadm.tabel_299_status_file".C_DBL." g ON a.kdstatusfile = g.kdstatusfile
                LEFT OUTER JOIN jsadm.tabel_304_valuta".C_DBL." h ON a.kdvaluta = h.kdvaluta
                WHERE a.prefixpertanggungan = $prefix AND a.nopertanggungan = $noper";

        $db = $this->db->query($sql);
        if ($db->num_rows() > 0)
            $data = $db->row_array();

        $db->free_result();

        return $data;
    }

    
    /*===== data polis by no polis & no klien =====*/
    function get_polis_soe_by_no_polis_no_klien($nopolis, $noklien, $productcode) {
        $data = array();
        $wnopolis = $this->db->escape($nopolis);
        $wnoklien = $this->db->escape($noklien);

        if ($productcode == C_KD_PRODUK_PMK) {
            $DB = $this->load->database('plindo', TRUE);
        
            $sql = "SELECT a.no_polis policy_number, a.pemegang_polis policy_name, d.nama_frekuensi_bayar payment_method, e.nama_valuta currency, e.notasi notation,
                        g.nama_produk policy_product, g.keterangan policy_product_description, c.no_sertifikat certificate_number, b.no_klien participant_number, 
                        TRIM(MAX(c.nama_klien)) participant_name, TO_CHAR(MIN(b.tgl_mulas), 'dd/mm/yyyy') start_date, TO_CHAR(MAX(b.tgl_akhas), 'dd/mm/yyyy') end_date, 
                        h.nama_status_peserta participant_status, TO_CHAR(c.tgl_lahir, 'dd/mm/yyyy') birthdate, c.email, c.no_peg employee_id, MAX(ponsel) mobile_number
                    FROM polis a
                    INNER JOIN polis_peserta b ON a.no_polis = b.no_polis
                    INNER JOIN klien c ON b.no_klien = c.no_klien
                    LEFT OUTER JOIN frekuensi_bayar d ON a.kd_frekuensi_bayar = d.kd_frekuensi_bayar
                    LEFT OUTER JOIN valuta e ON a.kd_valuta = e.kd_valuta
                    LEFT OUTER JOIN polis_produk f ON a.no_polis = f.no_polis
                    LEFT OUTER JOIN produk g ON f.kd_produk = g.kd_produk
                    LEFT OUTER JOIN status_peserta h ON b.status = h.kd_status_peserta
                    WHERE b.status = '1'
                        AND a.no_polis = $wnopolis
                        AND c.no_klien = $wnoklien
                    GROUP BY a.no_polis, a.pemegang_polis, d.nama_frekuensi_bayar, e.nama_valuta, e.notasi, g.nama_produk, g.keterangan,
                        c.no_sertifikat, b.no_klien, h.nama_status_peserta, c.tgl_lahir, c.email, c.no_peg";
        
            $db = $DB->query($sql);
            if ($db->num_rows() > 0)
                $data = $db->row_array();
            
            $db->free_result();
        } else if ($productcode == C_KD_PRODUK_MICRO) {
            $DB = $this->load->database('micro', TRUE);
            
            $sql = "SELECT a.certificate_number POLICY_NUMBER, a.full_name POLICY_NAME, 'SEKALIGUS' PAYMENT_METHOD, 'RUPIAH TANPA INDEKS' CURRENCY, 'Rp' NOTATION, 
                        a.product_code POLICY_PRODUCT, 'JS Mikro Sahabat' POLICY_PRODUCT_DESCRIPTION, a.certificate_number CERTIFICATE_NUMBER, 
                        a.id_card_number PARTICIPANT_NUMBER, a.full_name PARTICIPANT_NAME, DATE_FORMAT(a.paid_time, '%d/%m/%Y') START_DATE, 
                        DATE_FORMAT(DATE_ADD(a.paid_time, INTERVAL 1 YEAR), '%d/%m/%Y') END_DATE,
                        CASE WHEN a.status = 0 THEN '".C_PRODUK_BELUM_BAYAR."' WHEN a.status = 1 THEN 'AKTIF' END PARTICIPANT_STATUS, 
                        DATE_FORMAT(a.date_of_birth, '%d/%m/%Y') BIRTHDATE, a.email_address EMAIL, null EMPLOYEE_ID, a.handphone MOBILE_NUMBER
                    FROM js_micro_mobileapps a
                    WHERE a.certificate_number = $wnopolis
                        AND a.id_card_number = $wnoklien";
            
            $db = $DB->query($sql);
            if ($db->num_rows() > 0)
                $data = $db->row_array();
            
            $db->free_result();
        }

        return $data;
    }
    
    
    /*===== data uang asuransi nilai tunai by no polis no klien =====*/
    function get_ua_nt_soe_by_no_polis_no_klien($nopolis, $noklien, $productcode) {
        $DB = $this->load->database('plindo', TRUE);
        $data = array();
        $wnopolis = $this->db->escape($nopolis);
        $wnoklien = $this->db->escape($noklien);
        
        if ($productcode == C_KD_PRODUK_PMK) {
            // HARCODE (Karena Tidak Bisa di-Standard-kan
            if ($nopolis == "0000000342") {
                $sql = "SELECT (
                                SELECT ROUND(SUM(z.BENEFIT))
                                FROM peserta_benefit z
                                WHERE z.NO_POLIS = $wnopolis
                                    AND z.NO_KLIEN = $wnoklien
                                    AND z.KD_BENEFIT IN ('BNF_THT_CS', 'BNF_THT_BS')
                            ) sum_assured,
                            (
                                SELECT ROUND(SUM(
                                    (
                                        (SUM(CASE WHEN kd_benefit = 'BNF_THT_CS' THEN BENEFIT ELSE 0 END))
                                        * 
                                        (tarif_utility.tbssu2x ('JSR_NTTHTB','TU-05/02','1','B',TO_CHAR (TGL_MUTASI, 'DD/MM/YYYY'),TO_CHAR (TRUNC (SYSDATE, 'month'), 'DD/MM/YYYY'),TO_CHAR (TGL_LAHIR, 'DD/MM/YYYY')))
                                        / 
                                        1000
                                    )
                                ))
                                FROM peserta_benefit a, klien b, mutasi c
                                WHERE a.NO_POLIS = $wnopolis
                                    AND a.no_klien = $wnoklien
                                    AND a.no_klien = b.no_klien
                                    AND a.no_polis = c.no_polis
                                    AND a.no_mutasi = c.no_mutasi
                                GROUP BY nama_klien, a.no_klien, a.no_polis, tgl_mutasi, TGL_LAHIR
                            ) sum_surrendered
                        FROM dual";
            } 
            else if ($nopolis == "0000000281") {
                $sql = "SELECT 
                            SUM(
                                ROUND(
                                    SUM(CASE WHEN kd_benefit = 'BNF_THT_BS' THEN BENEFIT ELSE 0 END)
                                    * 
                                    POWER ('1,05', ROUND(MONTHS_BETWEEN(TRUNC(SYSDATE, 'MONTH'), TRUNC(c.tgl_mutasi, 'MONTH')) / 12, 2))
                                )
                            ) sum_assured,
                            SUM (
                                ROUND(
                                    (SUM(CASE WHEN kd_benefit = 'BNF_THT_BS' THEN BENEFIT ELSE 0 END))
                                    * 
                                    POWER ((1 + 5 / 100), ROUND((MONTHS_BETWEEN (TRUNC (SYSDATE, 'month'), c.TGL_MUTASI) / 12), 2))
                                    * (tarif_utility.tbssu2x ('JSRAHARJA_NTTHT','TU-05/02','1','X',TO_CHAR (TGL_MUTASI, 'DD/MM/YYYY'),TO_CHAR (TRUNC (SYSDATE, 'month'), 'DD/MM/YYYY'),TO_CHAR (TGL_LAHIR, 'DD/MM/YYYY')))
                                    / 1000
                                )
                            ) sum_surrendered
                        FROM peserta_benefit a, klien b, mutasi c
                        WHERE a.NO_POLIS = $wnopolis
                            AND a.no_klien = $wnoklien
                            AND a.no_klien = b.no_klien
                            AND a.no_polis = c.no_polis
                            AND a.no_mutasi = c.no_mutasi
                        GROUP BY nama_klien, c.tgl_mutasi, a.no_klien, a.no_polis, tgl_lahir";
            } else {
                $sql = "SELECT 1 FROM DUAL WHERE 1<>1";
            }

            $db = $DB->query($sql);
            if ($db->num_rows() > 0)
                $data = $db->row_array();

            $db->free_result();
        }
        else if ($productcode == C_KD_PRODUK_MICRO) {
            $data['SUM_ASSURED'] = 5000000;
            $data['SUM_SURRENDERED'] = 0;
        }

        return $data;
    }
    

    /*===== insert data redepmtion =====*/
    function insert_redemption($data) {
        $sql = "INSERT INTO jsadm.tabel_901_pengajuan_redempt_ol".C_DBL."
                    (prefixpertanggungan, nopertanggungan, tgl_pengajuan, kode_jenis, jumlah, status, penerima,
                    rekening, bank, cabang, kode_fund, clientid, confirmid)
                VALUES (".$this->db->escape($data['prefixpertanggungan']).",
                    ".$this->db->escape($data['nopertanggungan']).", sysdate,
                    ".$this->db->escape($data['kode_jenis']).",
                    REPLACE(REPLACE(".$this->db->escape($data['jumlah']).",'.',''),',','.'), 0,
                    ".$this->db->escape($data['penerima']).",
                    ".$this->db->escape($data['rekening']).",
                    ".$this->db->escape($data['bank']).",
                    ".$this->db->escape($data['cabang']).",
                    ".$this->db->escape($data['kode_fund']).",
                    ".$this->db->escape($data['clientid']).",
                    ".$this->db->escape($data['confirmid']).")";
        $this->db->query($sql);

        return $this->db->affected_rows();
    }
}