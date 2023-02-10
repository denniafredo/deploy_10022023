<?php

    /*===== get data from curl json decode =====*/
    function get_curl_json($parameter) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, C_URL_API_JAIM.$parameter);
        $content = curl_exec($ch);

        curl_close($ch);

        return json_decode($content, true);
    }