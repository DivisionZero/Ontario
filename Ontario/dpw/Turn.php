<?
class Turn {
	// each turn has a:
	// 		1. bunch of events, up to X
	// 		2. a location to go to
	// 		3. mob hit
	// 		4. Product list creation
	const MAX_EVENTS = 5;
	//const EVENT_TYPES = 6;
	private $location;
	private $events;
	private $player;

	// event 1 - officer encounter (Player)
	// event 2 - price spike / lower (Location)
	// event 3 - find product (Player)
	// event 4 - buy gun (Player)
	// event 5 - buy pockets (Player)
	// event 6 - get mugged (Player)
	public function __construct(Location $location, EventPickList $event_pick_list, Player $player) {
		$event_count = rand(0, self::MAX_EVENTS);
		$this->location = $location;
		$this->events = new EventList($event_count, $event_pick_list);
		$this->player = $player;
	}

}
