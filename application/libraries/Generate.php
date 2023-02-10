<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generate {
    private $ci;

    function __construct() {
        $this->ci = &get_instance();
    }


    function id($leftstr, $useyear, $usemonth, $midstr, $length, $rightstr, $number) {
        $id = strlen($leftstr) > 0 ? $leftstr : "";
        $id = $useyear ? $id.date('y') : $id;
        $id = $usemonth ? $id.date('m') : $id;
        $id = strlen($midstr) > 0 ? $id.$midstr : $id;
        $id = strlen($number) > 0 ? $id.str_pad($number+1, $length, "0", STR_PAD_LEFT) : $id.str_pad(1, $length, "0", STR_PAD_LEFT);
        $id = strlen($rightstr) > 0 ? $id.$rightstr : $id;

        return $id;
    }
}