<?
abstract class Event extends RarityObject {
	protected $current_message;
	const OBJECT_TYPE = 4;

	const EVENT_ENCOUNTER = 0;
	const EVENT_SPIKE = 1;
	const EVENT_FIND_OBJ = 2;
	const EVENT_BUY_TOOL = 3;
	const EVENT_BUY_INV = 4;
	const EVENT_LOSE_OBJ = 5;

	public function __construct($id, $label, Rarity $rarity, $allows_stack_dupes, $event_desc = null) {
		parent::__construct($id, $label, self::get_object_type(), $rarity, $allows_stack_dupes, $event_desc);
	}

	public function handle_event() {
		return Result::create(false, 'no event to handle');
	}

	public function handle_event_response($choice) {
		return Result::create(true, 'no response to handle');
	}

	public function get_response_options() {
		return array();
	}

	public static function get_object_type() {
		return new Type(self::OBJECT_TYPE, 'Event');
	}

	public function get_current_message() {
		return $this->current_message;
	}

	protected function yes_no_response() {
		return ['yes' => 'Yes', 'no' => 'No'];
	}

	protected function ok_response() {
		return ['ok' => 'OK'];
	}
}
