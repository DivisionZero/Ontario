<?
class Rarity extends Object {
	const COMMON = 1;
	const UNCOMMON = 2;
	const RARE = 3;
	const EXTREMELY_RARE = 4;
	const UNIQUE = 5;
	private $probability;
	private $presision;

	public function __construct($id, $name, $probability, $presision = 3) {
		parent::__construct($id, $name);
		if(!Valid::percent($probability)) {
			throw new Exception("Probability must be a percent between 0%-100%, in decimal");
		}
		$this->probability = $probability;
		$this->presision = $presision;
	}

	public function get_probability($presision = null) {
		$presision = $presision ? $presision : $this->presision;
		return round($this->probability, $presision);
	}

	public function get_presision() {
		return $this->presision;
	}
}
