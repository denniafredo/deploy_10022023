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
	
	
	/*===== get data from curl =====*/
	function get_curl($parameter) {
		$ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, C_URL_API_JAIM.$parameter);
        $content = curl_exec($ch);
		
		curl_close($ch);
		
		return $content;
	}
	
	
	/*===== all curl =====*/
	function api_curl($url, $method, $post = null) {
		$post = $post ? http_build_query($post) : $post;
		$curl = curl_init();
		$url = C_URL_API_CURL.$url;

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_SSL_VERIFYHOST => false,
		  CURLOPT_SSL_VERIFYPEER => false,
		  CURLOPT_CUSTOMREQUEST => $method,
		  CURLOPT_POSTFIELDS => $post,
		  CURLOPT_HTTPHEADER => array(),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		
		$result = @json_decode($response, true);
		
		return $result;
	}