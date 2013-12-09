<?
class FoundEvent extends Event {
	private $product_name;
	private $num_found;

	public function __construct(Rarity $rarity, Range $range) {
		$allows_dupes = true;
		parent::__construct(EventList::EVENT_FOUND_ITEM, 'found event', $rarity, $allows_dupes);
		$this->num_found = $range->get_random(); 
	}

	public function handle_event(Location &$location, Player &$player) {
		$product = $location->products->get_random_object();
		$player->pockets->add_product($product, $this->num_found);
		$this->message = ContentHolder::$content->get_text('found_event', array('product' => $product->get_name()));
		return $product;
	}

	public function get_response_options() {
		return array('ok' => 'OK');
	}
}
