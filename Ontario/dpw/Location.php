<?
class Location extends Object {
	private $has_bank;
	private $event_list;

	public function __construct($id, $name, $has_bank) {
		const OBJECT_TYPE = 4;
		parent::__construct($id, $name, new Type(self::OBJECT_TYPE, 'Location'));
		$this->has_bank = $has_bank;
	}

	public function add_event(Event $event) {
		$this->event_list[] = $event;
	}
}
