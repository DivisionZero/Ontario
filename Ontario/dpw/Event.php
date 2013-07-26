<?
abstract class Event extends Object {
	const OBJECT_TYPE = 4;

	const EVENT_ENCOUNTER = 0;
	const EVENT_SPIKE = 1;
	const EVENT_FIND_OBJ = 2;
	const EVENT_BUY_TOOL = 3;
	const EVENT_BUY_INV = 4;
	const EVENT_LOSE_OBJ = 5;

	private $rarity;

	public function __construct($id, $label, Rarity $rarity, $event_desc) {
		__construct($id, $label, self::get_type(), $event_desc);
		$this->rarity = $rarity;
	}

	public function handle_event() {
		return false;
	}

	public function get_rarity() {
		return $this->rarity->get_probablity();
	}

	public static function get_type() {
		return Type(self::OBJECT_TYPE, 'Event');
	}

	public function can_stack() {
		return true;
	}
}
