<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* 
 * Ini adalah halaman.
 * 
 * Create by : Fendy Christianto
 */

/*===== fungsi sql untuk pembuatan halaman =====*/
function page_forpaging($q, $p, $f) { // $q = query, $p = page, $f = filter for paging
    $ci = &get_instance();
    $perpage = $ci->input->get('per_page') ? $ci->input->get('per_page') : C_PAGE_JUMLAH;
    
    if ($f) {
        $sql = "SELECT * FROM (
                    SELECT a.*, ROWNUM no
                    FROM ($q) a
                    WHERE ROWNUM < (($p * $perpage) + 1)
                )
                WHERE no >= ((($p-1) * $perpage) + 1)";
    }
    else {
        $sql = $q;
    }

    return $sql;
}


/*===== fungsi untuk inisialisasi halaman =====*/
function page_initialize($url, $sum) {
    $ci = &get_instance();
    $ci->load->library('pagination');

    $set['base_url'] = $url;
    $set['total_rows'] = $sum;
    $set['per_page'] = C_PAGE_JUMLAH;
    $set['num_links'] = C_PAGE_JUMLAH_LINK;
    $set['attributes'] = array('class' => 'page-link');

    $ci->pagination->initialize($set);
}