<?
class Range {
	private $high;
	private $low;
	private $middle;
	const CEIL = 1;
	const FLOOR = 2;
	const FLOAT = 3;

	public function __construct($low, $high, $middle = null) {
		if(!is_numeric($high) || !is_numeric($low) || ($middle !== null && !is_numeric($middle))) {
			throw new Exception("Range values must be numeric");
		} else if (!Valid::higher($high, $low)) {
			throw new Exception("High param must be greater or equal to low param");
		} else {
			$this->high = $high;
			$this->low = $low;
			$this->middle = $middle;
		}
		
		if($middle === null) {
			$this->middle = self::create_middle($low, $high);
		}
	}

	public function get_random() {
		return rand($this->low, $this->high);
	}

	public function get_middle() {
		return $this->middle;
	}

	public function get_low() {
		return $this->low;
	}

	public function get_high() {
		return $this->high;
	}

	public function adjust_range($new_middle) {
		$delta_high = $this->high - $this->middle;
		$delta_low = $this->middle - $this->low;
		$this->middle = $new_middle;
		$this->low = $this->middle - $this->low;
		$this->high = $this->high + $this->middle;
	}

	public function move_middle($middle) {
		if(!is_numeric($middle)) {
			throw new Exception("Middle must be numeric");
		} else if($middle > $this->high || $middle < $this->low) {
			throw new Exception("Middle must be between high and low");
		} else {
			$this->middle = $middle;
		}
	}

	public static function create_middle($low, $high, $type = self::CEIL) {
		if(!Valid::higher($high, $low)) {
			throw new Exception("High must be a higher number than low");
		} 
		$middle = ($high + $low) / 2;
		switch($type) {
			case self::CEIL		: return ceil($middle); break;
			case self::FLOOR	: return floor($middle); break;
			case self::FLOAT	: return (float) $middle; break;
			default				: throw new Exception("Unexpected middle type: {$type}"); break;
		}
	}

}
