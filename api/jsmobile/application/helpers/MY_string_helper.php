<?php defined('BASEPATH') OR exit('No direct script access allowed');

    /*===== membuang semua tag html dan spesial tag dari database =====*/
    function remove_tag($str) {
        $str = preg_replace("/&#?[a-z0-9]+;/i","", htmlentities(strip_tags($str)));
        $str = str_replace("nbsp;", "", $str);
        $str = str_replace(":", ": ", $str);

        return $str;
    }