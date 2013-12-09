<?
class DefaultField {
	private $key;
	private $default;
	private $current;
	private $original_default;

	public function __construct($key, $default, $current = null) {
		$this->key = $key;
		$this->default = $default;
		$this->current = $current;
		$this->original_default = null;
	}

	public function get_value() {
		return is_null($this->current) ? $this->default : $this->current;
	}

	public function get_key() {
		return $this->key;
	}

	public function get_default() {
		return $this->default;
	}

	public function get_current() {
		return $this->current;
	}

	public function set_current($current) {
		return $this->current = $current;
	}

	public function reset_default($default_value) {
		if (is_null($this->original_default)) {
			$this->original_default = $this->default;
			$this->default = $default_value;
		} else {
			throw new Exception('Default cannot be reset more than once');
		}
	}
}
