<?
class FloatField extends NumericField {
	private $precision;

	public function __construct($key, $label = null, $default = null, $min = null, $max = null, $precision = null) {
		parent::__construct($key, $label, $default, $min, $max);
		$this->precision = $precision;
	}

	/** SETTERS **/
	public function set_value($default) {
		parent::set_value($default);
		$this->value = $this->filter($default);
	}

	/** VALIDATORS **/

	public function filter($value) {
		return (is_null($this->precision)) 
				? $value 
				: round($value, $this->precision);
	}
}
