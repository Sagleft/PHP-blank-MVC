<?php
	namespace App;

	class Utilities {
		public static function isJson($string): bool {
			return ((is_string($string) && (is_object(json_decode($string)) || is_array(json_decode($string))))) ? true : false;
		}

		public static function dataFilter($string = "", $db_link = null) {
			$string = strip_tags($string);
			$string = stripslashes($string);
			$string = htmlspecialchars($string);
			$string = trim($string);
			if(isset($db_link) && $db_link != null) {
				$string = $db_link->filter_string($string);
			}
			return $string;
		}

		public static function cURL($url, $ref, $header, $cookie, $p=null){
			$curlDefault = true;
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
					//TODO
					echo 'guzzle error: ' . $e->getMessage();
				}
			}
		}

		public static function curl_get($url) {
			return Utilities::cURL($url, '', '', '');
		}

		public static function generateCode($length = 6): string {
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
			$code = "";
			$clen = strlen($chars) - 1;
			while (strlen($code) < $length) {
				$code .= $chars[mt_rand(0, $clen)];
			}
			return $code;
		}

		//кажется, return: mixed
		public static function checkFields($arr = [], $keysArr = [], $errCode = "error", $db_link = null, $ignore_errors = false) {
			$data = [];
			foreach ($keysArr as $key) {
				if(!isset($arr[$key]) || (empty($arr[$key]) && $arr[$key] != "0" && $arr[$key] != 0)) {
					if(!$ignore_errors) {
						exit($errCode.' ('.$key.' is empty)');
					}
				} else {
					$data[$key] = Utilities::dataFilter($arr[$key], $db_link);
				}
			}
			return $data;
		}

		public static function checkINT($value = 0, $db_link = null): int {
			$value = Utilities::dataFilter($value, $db_link) + 0;
			if(!is_int($value)) {
				$value = 0;
			}
			return $value;
		}

		public static function checkFloat($value = 0, $db_link = null): float {
			$value = floatval(Utilities::dataFilter($value, $db_link));
			if(!is_float($value)) {
				$value = 0;
			}
			return $value;
		}

		public static function checkINTFields($arr = [], $keysArr = [], $db_link = null): array {
			$data = [];
			foreach ($keysArr as $key) {
				if(!isset($arr[$key]) || empty($arr[$key])) {
					$data[$key] = 0;
				} else {
					$data[$key] = Utilities::checkINT($arr[$key], $db_link);
				}
			}
			return $data;
		}
	}
