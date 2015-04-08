<?php

	class Hooks {

		// array of input symbols of input data
		private $symbols;

		// open and close hooks association
		private $openHooks = array ('(' => ')', '[' => ']', '{' => '}');

		// closed and open hooks associations
		private $closeHooks = array ();

		// open hooks stack
		private $openStack = array ();

		// closed hooks stack
		private $closeStack = array ();

		public function __construct($input) {
			$this->symbols = str_split($input);
		}

		public function run() {
			// check each symbol
			foreach ($this->symbols as $hook) {
				$this->toStack($hook);
				$this->checkStacks();
			}

			if(count($this->openStack) != 0 || count($this->closeStack) != 0)
				echo "WRONG...\n";
			else
				echo "RIGHT!\n";
		}

		// put hook to stack
		private function toStack($hook) {
			// if it open hook
			if(isset($this->openHooks[$hook]))
				array_push($this->openStack, $hook);
			// if it close hook
			else
				array_push($this->closeStack, $hook);
		}

		// check last close and open hooks
		private function checkStacks() {
			$o = end($this->openStack);
			$c = end($this->closeStack);

			// if last item at open stack is equal with last item at close stack
			// then remove those items from stacks
			if(isset($this->openHooks[$o]) && $this->openHooks[$o] == $c) {
				array_pop($this->openStack);
				array_pop($this->closeStack);
			}
		}
	}

	// create app
	$app = new Hooks($argv[1]);

	// and start it
	$app->run();

?>
