<?
class BuyPocketEvent extends Event {
	const DEFAULT_POCKET_COST = 10;
	const DEFAULT_POCKET_SIZE = 40;
	private $pocket_cost;
	private $pocket_size;

	public function __construct(
		Rarity $rarity, 
		$pocket_cost = self::DEFAULT_POCKET_COST, 
		$pocket_size = self::DEFAULT_POCKET_SIZE
	) {
		$allows_dupes = false;
		parent::__construct(EventList::EVENT_BUY_POCKET, 'buy pockets', $rarity, $allows_dupes);
		$this->pocket_cost = $pocket_cost;
		$this->pocket_size = $pocket_size;
	}

	public function handle_event(Location &$location, Player $player) {
		if ($player->pockets->get_pocket_count() >= PocketList::DEFAULT_MAX_POCKETS) {
			return Result::create(false, 'max pockets reached');
		}

		$text_array = [
			'size' => self::DEFAULT_POCKET_SIZE,
			'cost' => self::DEFAULT_POCKET_SIZE * self::DEFAULT_POCKET_COST,
			
		];
		$this->current_message = DPWContent::get_text('buy_pockets', $text_array);
		return Result::create(true, null);
	}

	public function handle_event_response(Player &$player, $response) {
		if ($response == 'no') return Result::create(true, 'no pockets added');
		
		$player->pockets->add_pockets($this->pocket_size);
		return Result::create(true, $this->pocket_size ." pockets added");
	}

	public function get_response_options() {
		return parent::yes_no_response();
	}
}
