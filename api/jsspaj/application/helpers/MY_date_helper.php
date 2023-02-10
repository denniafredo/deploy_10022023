<?php

/* 
 * Ini adalah halaman helper untuk format tanggal.
 * 
 * Create by : Fendy Christianto
 */

/*===== ubah string dari autoNumeric / php ke format database =====*/
function to_datetime($tanggal) {
    return C_IDENTIFIER_WITHOUT_QUOTES."TO_DATE('$tanggal', 'dd-mm-yyyy hh24:mi:ss')";
}

function to_date($tanggal) {
    return C_IDENTIFIER_WITHOUT_QUOTES."TO_DATE('$tanggal', 'dd-mm-yyyy')";
}