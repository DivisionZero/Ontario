<?
class RarityObject extends Object {
	private $rarity;
	private $allows_stack_dupes;

	public function __construct($id, $name, Type $type, Rarity $rarity, $allows_stack_dupes = false, $description = null) {
		parent::__construct($id, $name, $type);
		$this->rarity = $rarity;
		$this->allows_stack_dupes = $allows_stack_dupes;
	}

	public function get_probability() {
		return $this->rarity->get_probability();
	}

	public function allows_stack_dupes() {
		return $this->allows_stack_dupes;
	}

	public function get_rarity() {
		return $this->rarity;
	}
}
