<?php
	namespace App\Controller;
	
	class Logic {
		private $coin_connection = null;
		private $db = null;
		
		public function __construct() {
			//
		}
		
		public function setdb($db) {
			$this->db = &$db;
		}
		
		public function setUser($user): void {
			$this->user = &$user;
		}
	}
	