<?
class Turn {
	// each turn has a:
	// 		1. bunch of events, up to X
	// 		2. a location to go to
	// 		3. mob hit
	// 		4. Product list creation
	const DEFAULT_MAX_EVENTS = 5;
	const DEFAULT_MIN_PRODUCTS = 3;
	//const EVENT_TYPES = 6;
	private $location;
	private $events;
	private $product_picket_list;
	private $current_events;
	private $bank_amount;
	private $owed;
	private $turn;
	private $bank_interest;
	private $loan_interest;
	private $max_events;
	private $products;	

	// event 1 - officer encounter (Player)
	// event 2 - price spike / lower (Location)
	// event 3 - find product (Player)
	// event 4 - buy gun (Player)
	// event 5 - buy pockets (Player)
	// event 6 - get mugged (Player)
	public function __construct(EventPickList $event_pick_list, ProductList $product_pick_list, $owed, $bank_amount, $loan_interest, $bank_interest, $max_events = self::DEFAULT_MAX_EVENTS, $min_products = self::DEFAULT_MIN_PRODUCTS) {
		$this->location = null;
		$this->events = new EventList($event_count, $event_pick_list);
		$this->product_pick_list = $product_pick_list;
		$this->owed = $owed;
		$this->bank_amount = $bank_amount;
		$this->turn = 0;
		$this->loan_interest = $loan_interest;
		$this->bank_interest = $bank_intest;
		$this->max_events = $max_events;
		$this->min_products = $min_products;
		$this->products = null;
	}

	public function change_location($location, Player $player) {
		if (is_null($this->location) || $location->get_id() != $this->location->get_id()) {
			$this->turn++;
			$this->location = $location;
			$this->change_events();
			$this->change_products();
			$this->change_interest($player);
			return true; // ??
		} else {
			return false;
		}
	}

	private function change_interest(Player $player) {

	}

	private function change_events() {
		$range = new Range(0, $this->max_events);
		$this->current_events = $this->product_pick_list->get_range_objects($range);
	}

	private function change_products() {
		$range = new Range($this->min_products, $this->product_pick_list->count());
		$this->products = $this->product_pick_list->get_range_objects($range);
	}

	public function get_products() {
	}

	public function get_current_events() {
		return $this->events();
	}

	public function get_location() {
		return $this->location;
	}

	public function get_owed() {
		return $this->owed;
	}

	public function get_bank_amount() {
		return $this->bank_amount;
	}
}
