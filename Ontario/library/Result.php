<?
class Result {
	private $data;
	private $passed;
	private $error_list;

	private function __construct(boolean $passed, $data = null, ErrorList $errors = null) {
		$this->data = $data;
		$this->passed = $passed;
		$this->error_list = $errors;
	}

	public static function create(boolean $passed, $data = null, ErrorList $errors = null) {
		return new Result($passed, $data, $errors);
	}

	public function passed() {
		return $this->passed;
	}

	public function failed() {
		return !$this->passed;
	}

	public function data() {
		return $this->data;
	}

	public function errors() {
		return $this->error_list;
	}
}
