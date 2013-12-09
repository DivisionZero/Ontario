<?
class StringField extends Field {
	const MAX_CHARS = 50000;
	private $max_chars;

	public function __construct($key, $label = null, $default = null, $max_chars = self::MAX_CHARS) {
		$this->max_chars = self::MAX_CHARS;
		parent::__construct($key, $label, $default);
		$this->check_valid($default);
	}

	/** GETTERS **/

	/** DISPLAY **/
	public function display() {
		return htmlentities($this->get_value());
	}

	/** SETTERS **/
	public function set_value($value) {
		if ($this->check_valid($value, "String Field")) {
			parent::set_value($value);
			$this->value = $this->filter($this->value);
		}
	}

	public function set_default($default) {
		if ($this->check_valid($default, "String Default")) {
			parent::set_default($default);
		}
	}

	/** VALIDATORS **/

	public function filter($value) {
		return (string) $value;
	}

	public function is_valid($value) {
		if (parent::is_valid($value)) {
			$count = strlen($value);
			return ($count <= $this->max_chars);
		}
		return false;
	}

	public function check_valid($value, $field_name) {
		if (is_null($value)) return true;

		if (parent::check_valid($value, $field_name)) {
			if (!$this->is_valid($value)) {
				throw new Exception("String Field value {$value} is not valid.");
			}
		}
		return true;
	}

}
