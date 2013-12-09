<?
class BooleanField extends Field {

	public function __construct($key, $label, $default = null) {
		if (!is_null($default)) {
			$default = $this->filter($default);
		}
		parent::__construct($key, $label, $default);
	}

	/** SETTERS **/
	public function set_value($value) {
		if (!is_null($value)) {
			$value = $this->filter($value);
		}
		parent::set_value($value);
	}

	public function set_default($value) {
		parent::set_default($this->filter($value));
	}

	/** VALIDATORS **/
	public function filter($value) {
		return ($value) ? 1 : 0;
	}

	public function is_valid($value) {
		return $value === 0 || $value === 1;
	}
}
