<?
class PercentField extends FloatField {
	const DEFAULT_PRECISION;

	public function __construct($key, $label = null, $default = null, $precision = self::DEFAULT_PRECISION) {
		parent::__construct($key, $label, $default, null, null, $precision);
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
