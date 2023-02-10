<?php defined('BASEPATH') OR exit('No direct script access allowed');
    $ci = &get_instance();
    $ci->load->config('credential');

    function get_db_username() {
        $ci = &get_instance();

        return $ci->config->item('db_username');
    }

    function get_db_password() {
        $ci = &get_instance();

        return $ci->config->item('db_password');
    }
