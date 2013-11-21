<?
abstract class Content {
	protected $content;
	private static $default_filename;

	public static function init($filename) {
		self::$default_filename = $filename;
	}

	public function __construct($filename = null) {
		if ($filename) {
			self::$default_filename = $filename;
			$this->content = [];
		}
		if (!$this->content) {
			if (file_exists(self::$default_filename)) {
				$this->$content = parse_ini_file($filename, true);
			} else {
				throw new Exception("Content file: {$filename} does not exist");
			}
		}
		if (!$this->content) {
			throw new Exception("There are no contents");
		}
	}

	public function get_text($key, array $values) {
		$high = $this->count_content($key);
		if ($high >= 1) {
			$random = rand(1, $high);
			return $this->_get_parent_text($key, $values, $random);
		} else {
			throw new Exception("Config file has no keys for {$key}");
		}
	}

	public function count_content($content_key) {
		if ($this->has_key($content_key)) {
			return count($this->$content[$content_key]);
		} else {
			return 0;
		}
	}

	protected function _get_parent_text($key, array $values, $index = null) {
		$called = get_called_class();
		if (method_exists($called, $key)) {
			$expected = $called->$key();
			if ($this->has_expected($key, $expected, $values, $index)) {
				return $this->create_content($key, $values, $index);
			}
		} else {
			throw new Exception("Key {$key} has no Content function");
		}
	}


	private function has_expected($content_key, array $expected, array $check, $index = null) {
		foreach ($expected as $to_check) {
			if (!isset($check[$to_check])) {
				throw new Exception("Content  {$content_key} missing expected value: {$to_check}");
				return false;
			}
		}
		if (!$this->has_key($content_key, $index)) {
			throw new Exception("Content key {$content_key} does not exist");
		}
		return true;
	}

	private function has_key($content_key, $index = null) {
		if (is_null($index)) {
			return isset($this->$content[$content_key]);
		} else {
			return isset($this->$content[$content_key][$index]);
		}
	}

	private function create_content($content_key, $values, $index = null) {
		$string = $index ? $this->$content[$content_key][$index] : $this->$content[$content_key];
		foreach ($values as $key => $value) {
			$string = str_replace('{'.$key.'}', $value, $string);
		}
		return $string;
	}

}
