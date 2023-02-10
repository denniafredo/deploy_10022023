<?php

/* 
 * Ini adalah halaman.
 * 
 * Create by : Fendy Christianto
 */

/*===== tambah kutip satu untuk insert ke dalam database dan ganti &amp; ke dan =====*/
function replace_to_insert($str) {
    $data = str_replace("&amp;", "dan", str_replace("'", "''", $str));

    return $data;
}

/*===== mengganti comma menjadi titik =====*/
function replace_to_number($str) {
    $data = floatval(str_replace(',', '.', trim($str)));
    
    return $data;
}

/*===== hilangkan spasi didepan dan belakan karakter =====*/
function trims($str) {
    return trim($str);
}