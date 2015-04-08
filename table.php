<?php
	// created at 14:45

	require_once 'console/Table.php';

	class Table {

		private $file = 'data.json';

		private $json;

		private $tbl;

		public function __construct() {
			$jsonString = file_get_contents($this->file);
			$this->json = json_decode($jsonString, true);
			$this->tbl = new Console_Table();
		}

		public function run() {
			$this->tbl->setHeaders(array_shift($this->json));

			foreach ($this->json as $data)
				$this->tbl->addRow($data);

			echo $this->tbl->getTable();
		}
	}


	$app = new Table();
	$app->run();
?>