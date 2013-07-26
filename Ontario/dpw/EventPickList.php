<?
class EventPickList extends UniqueObjectList {
	const RARITY_PRESISION = 3;

	public function __construct($events = null) {
		parent::__construct($events, Event::get_type());
	}

	public function get_random_event() {
		$rarity_count = 0;
		$rarity_stack = array();
		// TODO, cache this so it only happens once
		foreach($this->list as $event) {
			$stack = $event->get_rarity(self::RARITY_PRESISION);
			$rarity_count += $stack;
			$rarity_stack[] = $rarity_count;
		}
		$rand = rand(1, $rarity_count * (pow(10, self::RARITY_PRESISION)));
		foreach($rarity_stack as $current=>$stack) {
			if($stack > $rand) break;
		}
		return $this->list[$current];
	}
}
