<?
class EventList extends RarityObjectList {
	const EVENT_SPIKE 		= 1;
	const EVENT_ENCOUNTER 	= 2;
	CONST EVENT_FOUND_ITEM  = 3;
	CONST EVENT_BUY_TOOL 	= 4;
	CONST EVENT_BUY_POCKET  = 5;
	private $predicted_events;
	private $random_events;

	public function __construct($num_events = 0) {
		parent::__construct(Event::get_type());
		$this->predicted_events = new EventList();
		$this->random_events = $this->get_random_object($num_events);
	}

	public function add_predicted_event(Event $event) {
		$this->predicted_events->add_element($event);
	}

	public function get_next_event() {
		$object = $this->predicted_events->get_object_by_index(0);
		if($object) {
			$this->predicted_events->remove_element($object);
			return $object;
		} else {
			$object = $this->random_events->remove_element($object);
			if($object) {
				$this->random_events->remove_element($object);
				return $object;
			} else {
				return null;
			}
		}
	}
}
