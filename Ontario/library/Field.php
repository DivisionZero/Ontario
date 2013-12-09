<?
class Field {
	protected $key;
	protected $value;
	protected $default;
	protected $original_default;
	protected $unfiltered;
	protected $label;

	public function __construct($key, $label = null, $default = null) {
		$this->key = $key;
		$this->label = $this->set_label($label);
		$this->value = null;
		$this->unfiltered = null;
		$this->original_default = null;
		$this->default = $default;
		$this->check_valid($default, 'Field Default');
	}

	/** GETTERS **/

	public function get_key() {
		return $this->key;
	}

	public function get_unfiltered() {
		return $this->unfiltered;
	}

	public function get_default() {
		return $this->default;
	}

	public function get_value() {
		if ($this->is_empty()) {
			if (!is_null($this->default)) {
				return $this->default;
			}
		}
		return $this->value;
	}


	/** SETTERS **/

	public function set_value($value) {
		if ($this->check_valid($value)) {
			if (!is_null($value)) {
				$this->value = $this->filter($value);
				$this->unfiltered = $value;
			} else {
				$this->value = $this->unfiltered = null;
			}
		}
	}

	public function set_default($default) {
		if (is_null($this->original_default)) {
			if ($this->check_valid($default, 'Default')) {
				$this->original_default = $this->default;
				$this->default = $default;
			}	
		} else {
			throw new Exception("Default cannot be set more than once");
		}
	}

	public function set_label($label) {
		if ($this->is_empty($label)) {
			$this->label = ucwords(str_replace('_', ' ', $this->key));
		} else {
			$this->label = $label;
		}
	}

	/** VALIDATORS **/

	public function is_valid($value) {
		return is_scalar($value);
	}

	public function is_empty() {
		$value = $this->get_value();
		return ($value == '' || is_null($value));
	}

	public function filter($value) {
		return $value;
	}

	public function check_valid($value, $field_name) {
		if (!is_null($value) && !$this->is_valid($value)) {
			throw new Exception("i{$field_name} Value is not valid: {$value}");
		}
		return true;
	}

	/** DISPLAY **/

	public function display() {
		return $this->get_value();
	}

	public function format() {
		return $this->get_value();
	}

	public function get_label() {
		return $this->label;
	}
}
