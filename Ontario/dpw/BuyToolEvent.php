<?
class BuyToolEvent extends Event {
	private $tool;

	public function __construct(Rarity $rarity, Tool $tool) {
		$allows_dupes = false;
		parent::__construct(EventList::EVENT_BUY_TOOL, 'buy tool', $rarity, $allows_dupes);
		$this->tool = $tool;
	}

	public function handle_event_response(Player &$player, $response) {
		if($response == 'yes' && !$player->has_tool()) {
			$price = $this->tool->get_price();
			if($player->add_money(-1 * $price)) {
				$player->get_tool();
				return Result::create(true, null);
			} 
		} 
		return Result::create(false, $this->message_no_money());
	}

	public function handle_event(Location &$location, Player &$player) {
		if(!$player->has_tool()) {
			$text_array = [
				'name' => $this->tool->get_name(),
				'cost' => $this->tool->get_price(),
			 ];
			$this->current_message = DPWContent::get_text('buy_tool', $text_array);
			return Result::create(true, null);
		} else {
			return Result::create(false, $this->message_no_money());
		}
	}

	public function get_response_options() {
		return parent::yes_no_response();
	}

	private function message_no_money() {
		$text_array = ['tool' => $this->tool->get_name()];
		return DPWContent::get_text('no_money_tool', $text_array);
	}
}
