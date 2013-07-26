<?
class EventList extends TypeObjectList {
	private $event_type_list = array();
	private $pick_list;

	public function __construct($event_count = 0, EventPicktList $pick_list) {
		parent::__construct(null, Event::get_type());
		$this->pick_list = $pick_list;
		while($event_count > 0) {
			if($this->add_random_event() === true) {
				$event_count--;
			}
		}
	}

	private function add_random_event() {
		// choose event (based off rarity?)
		$event = $this->pick_list->get_random_event();
		// check if event can stack if event type exists already
		if(in_array($event->get_id(), $this->event_type_list)) {
			if($event->can_stack()) {
				$this->add_element($event);
			} else {
				return false;
			}
		} else {
			$this->add_element($event);
		}
		// add event to list
		return true;
	}

	public function add_predicted_event() {
	}
}
