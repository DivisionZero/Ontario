<?
class Product extends Object {
	const OBJECT_TYPE = 3;
	private $price;
	private $rarity;
	private $spike_high = array();
	private $spike_low = array();

	public function __construct($id, $name, Price $price = null, Rarity $rarity) {
		parent::__construct($id, $name, self::get_type());
		$this->price = $price;
		$this->spike_high = $this->spike_low = array();
	}

	/*
	private function update_current_price() {
		if($this->price !== null) {
			$this->price->reset_prices();
		}
	}
	 */

	public function get_price() {
		$price = 0;
		foreach($this->spike_high as $spike) {
			$price = $this->price->get_price_high();
			$this->price->reset_price($price);
		}
		foreach($this->spike_low as $spike) {
			$price = $this->price->get_price_low();
			$this->price->reset_price($price);
		}
		$this->spike_high = $this->spike_low = array();
		return $this->price->get_price();
	}

	public function make_spike_high() {
		$this->spike_high[] = 1;
	}

	public function make_spike_low() {
		$this->spike_low[] = 1;
	}

	public static function get_type() {
		return new Type(self::OBJECT_TYPE, 'Product');
	}
}
