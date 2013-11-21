<?
class EncounterEvent extends Event {
	public function __construct($id, $label, Rarity $rarity, $event_desc = null) {
		$can_stack = false;
		parent::__construct($id, $label, $rarity Rarity, $can_stack, $event_desc);
	}

	public function handle_event(&Player $player) {
		$this->player->fight();
	}
}
