<?
class NumericField extends Field {
	protected $max;
	protected $min;

	public function __construct($key, $label, $default = null, $min = null, $max = null) {
		$this->min = $min;
		$this->max = $max;
		parent::__construct($key, $label, $default);
		$this->check_valid($default, 'Numeric Default');
	}

	/** SETTERS **/
	public function set_default($default) {
		if ($this->check_valid($default, "Numeric Default")) {
			parent::set_default($default);
		}
	}

	public function set_value($value) {
		if ($this->check_valid($value, "Numeric Field")) {
			parent::set_value($value);
			$this->value = $this->filter($this->value);
		}
	}

	/** VALIDATORS **/

	public function is_valid($value) {
		if (parent::is_valid($value)) {
			if (is_numeric($value)) {
				if (!is_null($this->min) && $value < $this->min) return false;
				if (!is_null($this->max) && $value >= $this->max) return false;
				return true;
			}
		}
		return false;
	}

	public function check_valid($value, $field_name) {
		if (is_null($value)) return true;

		if (parent::check_valid($value, $field_name)) {
			if (!$this->is_valid($value)) {
				throw new Exception("Numeric Field value {$value} is not valid")
			}
		}
		return true;
	}
}
