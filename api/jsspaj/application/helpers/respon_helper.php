<?php

    /*===== fungsi standar untuk membentuk response message =====*/
    function message($a, $b, $c, $d) {
        return ['error' => $a, 'status' => $b, 'id' => $c, 'message' => $d];
    }

