<?php

/* 
 * Ini adalah halaman helper untuk format angkat.
 * 
 * Create by : Fendy Christianto
 */

/*===== ubah string dari autoNumeric / php ke format database =====*/
function to_number($angka) {
    return C_IDENTIFIER_WITHOUT_QUOTES."TO_NUMBER('".str_replace('.', ',', $angka)."')";
}

/*===== hanya mengambil angka =====*/
function grab_number($string) {
    return preg_replace("/[^0-9]/", "", $string);
}