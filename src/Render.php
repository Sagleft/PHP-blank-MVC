<?php
	namespace App;

	class Render {
		protected $data_wrap = [
			'page'    => [],
			'version' => 1
		];

		public function __construct($data = []) {
			$this->data_wrap = [
				'page'    => $data,
				'version' => getenv('version')
			];
		}

		public function twigRender() {
			$loader = new \Twig_Loader_Filesystem(__DIR__ . '/../view/');
			$twig = new \Twig_Environment($loader, [
				'cache'       => __DIR__ . '/../view/cache',
				'auto_reload' => getenv('auto_reload')
			]);
			exit($twig->render('page.tmpl', $this->data_wrap));
		}
	}
