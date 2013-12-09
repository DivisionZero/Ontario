<?
class IntegerField extends NumericField {

	public function __construct($key, $label = null, $default = null, $min = -PHP_INT_MAX, $max = PHP_INT_MAX) {
		parent::__construct($key, $label, $default, $min, $max);
		$this->check_valid($default, 'Integer Default');
	}

	/** SETTERS **/
	public function set_default($default) {
		if ($this->check_valid($default, "Integer Default")) {
			parent::set_default($default);
		}
	}

	public function set_value($value) {
		if ($this->check_valid($value, "Integer Field")) {
			parent::set_value($value);
			$this->value = $this->filter($this->value);
		}
	}

	/** VALIDATORS **/

	public function filter($value) {
		return (int) $value;
	}

	public function is_valid($value) {
		if (parent::is_valid($value)) {
			return intval($integer) == $integer)
		}
		return false;
	}

	public function check_valid($value, $field_name) {
		if (is_null($value)) return true;

		if (parent::check_valid($value, $field_name)) {
			if (!$this->is_valid($value)) {
				throw new Exception("Integer Field value {$value} is invalid.");
			}
		}
		return true;
	}
}
