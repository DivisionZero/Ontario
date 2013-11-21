<?
class SpikeEvent extends Event {
	const SPIKE_HIGH = 1;
	const SPIKE_LOW = 2;
	private $product_name;
	private $spike_type;
	private $rarity_pool;

	public function __construct(Rarity $rarity, Rarity $high, Rarity $low) {
		$allows_dupes = true;
		parent::__construct(EventList::EVENT_SPIKE, 'spike event', $rarity, $allows_dupes);
		$this->rarity_pool = new RarityPool();
		$this->rarity_pool->add_element(new Rarity(self::SPIKE_HIGH, $high->get_probability(), 'high'));
		$this->rarity_pool->add_element(new Rarity(self::SPIKE_LOW, $low->get_probability(), 'low'));
	}

	public function handle_event(Location &$location, Player &$player) {
		$product = $location->products->get_random_object();
		$rarity = $this->rarity_pool->choose_rarity();
		if($rarity->get_id() == self::SPIKE_HIGH) {
			$product->make_spike_high();
			$spike_type = self::SPIKE_HIGH;
		} else {
			$product->make_spike_low();
			$spike_type = self::SPIKE_LOW;
		}
		$text_array = array(
			'product' => $product->get_name(),
		);
		$key = 'spike_'.$rarity->get_name();
		$this->current_message = DPWContent::get_text($key, $text_array);
		$location->products->update_object($product);
		return Result::create(true, $product);
	}

	public function get_response_options() {
		return parent::ok_response();
	}
}
