<?php
	namespace App\Controller;
	
	class Utilities {
		function isJson($string) { return ((is_string($string) && (is_object(json_decode($string)) || is_array(json_decode($string))))) ? true : false; }
		
		function data_filter($string, $useDB = false, $db = null) {
			$string = strip_tags($string);
			$string = stripslashes($string);
			$string = htmlspecialchars($string);
			$string = trim($string);
			if($useDB && $db != null) {
				if($db == null) {
					//TODO
					//$string = mysqli_real_escape_string($string);
				} else {
					//$string = mysqli_real_escape_string($string, $db);
				}
			} else {
				//$string = mysqli_escape_string($string);
			}
			return $string;
		}
		
		function cURL($url, $ref, $header, $cookie, $p=null){
			$curlDefault = true;
			//чтобы тестировать на сервере, на котором нет guzzle
			if($curlDefault) {
				$ch =  curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				if(isset($_SERVER['HTTP_USER_AGENT'])) {
					curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
				}
				if($ref != '') {
					curl_setopt($ch, CURLOPT_REFERER, $ref);
				}
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				if($cookie != '') {
					curl_setopt($ch, CURLOPT_COOKIE, $cookie);
				}
				if ($p) {
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $p);
				}
				$result =  curl_exec($ch);
				curl_close($ch);
				if ($result){
					return $result;
				} else {
					return '';
				}
			} else {
				try {
					$client = new \GuzzleHttp\Client();
					if($p != null) {
						parse_str($p, $params);
						$request = $client->post($url, [], [
							'body' => $params
						]);
					} else {
						$request = $client->get($url);
					}
					return $request->getbody();
				} catch(Exception $e) {
					//TODO: обработку ошибки
					//можно обернуть в json
					echo 'guzzle error: ' . $e->getMessage();
				}
			}
		}
		
		function curl_get($url) {
			return \App\Utilities::cURL($url, '', '', '');
		}
	}
	