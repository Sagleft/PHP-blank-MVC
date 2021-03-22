<?php
	namespace App;
	class Handler {
		public $logic = null;
		public $user  = null;
		public $renderT = null;
		public $last_error = '';

		protected $db      = null;
		protected $enviro  = null;
		protected $db_enabled = false;

		public function __construct() {
			$this->enviro  = new Environment();
			$this->db_enabled = getenv('db_enabled') == '1';
			if($this->isDBEnabled()) {
				$this->db = new DataBase();
			}

			$this->logic   = new Logic();
			$this->user    = new User();
			$this->renderT = new Render([]);

			if($this->isDBEnabled()) {
				$this->logic->setdb($this->db);
				$this->user->setdb($this->db);
			}
			$this->logic->setUser($this->user);
		}

		function isDBEnabled(): bool {
			return $this->db_enabled;
		}

		public function render($data = []) {
			$this->renderT = new \App\Controller\Render($data);
			$this->renderT->twigRender();
		}

		public function dataFilter($str = ''): string {
			if($this->isDBEnabled()) {
				return Utilities::dataFilter($str, $this->db);
			} else {
				return Utilities::dataFilter($str);
			}
		}

		public function checkINT($value = 0): int {
			return Utilities::dataFilter($value, $this->db);
		}
	}
