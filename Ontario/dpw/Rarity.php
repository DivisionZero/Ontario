<?
class Rarity extends Object {
	const COMMON = 1;
	const UNCOMMON = 2;
	const RARE = 3;
	const EXTREMELY_RARE = 4;
	const UNIQUE = 5;
	private $probability;

	public function __construct($id, $name, $probability) {
		parent::__construct($id, $name);
		if(!Valid::percent($probability)) {
			throw new Exception("Probability must be a percent between 0%-100%, in decimal");
		}
		$this->probability = $probability;
	}

	public function get_probability() {
		return $this->probability;
	}
}
