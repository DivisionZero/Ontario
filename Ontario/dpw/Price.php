<?
class Price {
	private $range;
	private $spike_high;
	private $spike_low;
	private $price;
	private $price_high;
	private $price_low;

	public __construct(Range $range, Spike $spike_high, Spike $spike_low) {
		$this->range = $range;
		$this->spike_high = $spike_high;
		$this->spike_low = $spike_low;
		$this->price = $this->reset_prices();
	}

	public function get_price() {
		return $this->price;
	}

	public function get_price_high() {
		return $this->price_high;
	}

	public function get_price_low() {
		return $this->price_low;
	}

	public function reset_prices($adjust_middle = null) {
		if($adjust_middle !== null) {
			$this->range->adjust_range($adjust_middle);
		}
		// get base price
		$is_high = rand(0,1);
		if($is_high) {
			$this->price = rand($this->range->get_middle(), $this->range->get_high());
		} else {
			$this->price = rand($this->range->get_low(), $this->range->get_middle());
		}
		// get high price
		$this->price_high = $this->price + $this->spike_hight->get_spike();
		// get low price
		$this->price_low = $this->price - $this->spike_low->get_spike();
	}
}
