<?
class Spike {
	public function __construct($amount, $percent) {
		if(!is_numeric($amount) && !is_numeric($percent)) {
			throw new Exception("Spike amount and percent must be numbers");
		}
		$this->amount = $amount;
		$this->percent = $percent;
	}

	public function get_spike() {
		return $this->amount * $this->percent;
	}
}
