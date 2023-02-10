<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Query {
    private $ci;

    function __construct() {
        $this->ci = &get_instance();
    }


    function where_in($array) {
        $query = "(";

        if (count($array) > 0) {
            foreach ($array as $i => $v) {
                if ($i > 0) {
                    $query .= ",";
                }

                $query .= "'$v[NOAGEN]'";
            }
        }
        else {
            $query .= "''";
        }

        $query .= ")";

        return $query;
    }
}