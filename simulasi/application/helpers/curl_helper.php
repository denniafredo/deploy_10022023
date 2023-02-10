<?php
	
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
		  CURLOPT_TIMEOUT => 3,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => $method,
		  CURLOPT_SSL_VERIFYHOST => false,
		  CURLOPT_SSL_VERIFYPEER => false,
		  CURLOPT_POSTFIELDS => $post,
		  CURLOPT_HTTPHEADER => array(),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		
		$result = @json_decode($response, true);
		
		return $result;
	}


	/*===== all curl =====*/
	function api_curl_tes($url, $method, $post = null) {
echo '<pre>'; print_r($post); echo '</pre><br><br><br>';
		$post = $post ? http_build_query($post) : $post;
var_dump($post); echo "<br><br><br>";
		$curl = curl_init();
		$url = C_URL_API_CURL.$url;
var_dump($url); echo "<br><br><br>";
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
var_dump($response); echo "<br><br><br>";
		curl_close($curl);
		
		$result = @json_decode($response, true);
		
		return $result;
	}
