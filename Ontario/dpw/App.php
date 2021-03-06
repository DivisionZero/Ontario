<?
class App {
	private $player;
	private $locations;
	private $event_list;
	private $total_turns;
	private $current_turn;
	private $current_screen;

	public function __construct(GameTemplate $game_template) {
		$this->player = DPRSession::user();
		$this->location = DPRSession::location();
		$this->current_turn = DPRSession::turn();
		$this->unresolved_events = DPRSEssion::unresolved_events();
		$this->locations = $game_template->get_locations();
		$this->event_list = $game_template->get_events();
		$this->total_turns = $game_template->get_turns();
	}

	public function take_turn($location_id) {
		// handle events
		// arrive at location
		//		handle bank transactions
		//		handle sales/purchases
		//	go to location screen	
	}

	public function buy_product($product, $amount) {
		if($this->current_screen === App::SCREEN_LOCATION) {
			return $this->player->buy_product($product, $amount);
		} else {
			return false;
		}
	}

	public function sell_product($product, $amount) {
		if($this->current_screen === App::SCREEN_LOCATION) {
			return $this->player->sell_product($product, $amount);
		} else {
			return false;
		}
	}

	public function buy_pockets() {
		if($this->current_screen === App::SCREEN_EVENTS) {
			return $this->player->buy_pockets();
		} else {
			return false;
		}
	}

	public function buy_tool() {
		if($this->current_screen === App::SCREEN_EVENTS) {
			return $this->player->buy_tool();
		} else {
			return false;
		}
	}

	public function get_loan($amount) {
		if($this->current_screen === App::SCREEN_LOCATION && $this->location->has_bank()) {
			return $this->player->add_loan($amount);	
		} else {
			return false;
		}
	}

	public function change_location($location_id) {
		// can't go to location without handling events
		if(/* has events */) {
			$this->current_screen = App::SCREEN_EVENTS;
		} else {
			$this->current_screen = App::SCREEN_LOCATION;
		}
		if($this->current_screen === App::SCREEN_LOCATION_SELECT && $location_id !== $this->location->get_id()) {
			$this->location = $this->locations[$location_id];
			$this->turn = new Turn($this->location, $this->event_list, $this->player);
			return true;
		} else {
			if($location_id == $this->location->get_id()) {
				$this->current_screen = App::SCREEN_LOCATION;
			} else {
				return false;
			}
		}
	}

	public function start_game() {
		if($this->current_screen === App:SCREEN_START) {
			$this->current_screen = App::SCREEN_LOCATION_SELECT;
			return true;
		} else {
			return false;
		}
	}
}
