<?
class Result {
	private $data;
	private $passed;
	private $error_list;

	private function __construct($passed, $data = null, ErrorList $errors = null) {
		$this->data = $data;
		$this->passed = $passed;
		$this->error_list = $errors;
	}

	public static function create($passed, $data = null, ErrorList $errors = null) {
		if ($passed) {
			$passed = 1;
		} else {
			$passed = 0;
		}
		return new Result($passed, $data, $errors);
	}

	public function passed() {
		return (bool) $this->passed;
	}

	public function failed() {
		return (bool) !$this->passed;
	}

	public function data() {
		return $this->data;
	}

	public function errors() {
		return $this->error_list;
	}
}
