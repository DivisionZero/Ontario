<?
class LoseEvent extends Event {
	private $product_name;
	private $num_lost;

	public function __construct(Rarity $rarity, Range $range) {
		$allows_dupes = true;
		parent::__construct(EventList::EVENT_LOSE_ITEM, 'lose event', $rarity, $allows_dupes);
		$this->num_lost = $range->get_random();
	}

	public function handle_event(Location &$location, Player &$player) {
		$product = $player->pockets->get_random_product();
		if (is_null($product)) {
			return false;
		}

		$count = $player->pockets->get_product_count($product);
		if ($this->num_lost < $count) {
			$count = $this->num_lost;
		}
		$player->pockets->remove_product($product, $count);
		$this->message = ContentHolder::$content->get_text('lose_event', array('product' => $product->get_name()));
		return $product;
	}

	public function get_response_options() {
		return array('ok' => 'OK');
	}
}
