<?
class Rarity extends Object {
	const COMMON = 1;
	const UNCOMMON = 2;
	const RARE = 3;
	const EXTREMELY_RARE = 4;
	const UNIQUE = 5;
	const DEFAULT_PRECISION = 3;
	const OBJECT_TYPE = 13;
	private $probability;

	public function __construct($id, $probability, $name = null) {
		if ($name === null) {
			$name = $this->create_name($id);
		}
		parent::__construct($id, $name, self::get_object_type());
		if(!Valid::percent($probability)) {
			throw new Exception("Probability must be a percent between 0%-100%, in decimal");
		}
		$this->add_default('precision', self::DEFAULT_PRECISION);
		$this->probability = $probability;
	}

	public function get_probability($precision = null) {
		$precision = $precision ? $precision : $this->precision;
		return round($this->probability, $precision);
	}

	public function get_precision() {
		return $this->get_value('precision');
	}

	private function create_name($id) {
		switch ($id) {
			case self::COMMON 			: return 'common'; break;
			case self::UNCOMMON 		: return 'uncommon'; break;
			case self::RARE 			: return 'rare'; break;
			case self::EXTREMELY_RARE 	: return 'extremely rare'; break;
			case self::UNIQUE 			: return 'unique'; break;
			default						: return ''; break;
		}
	}

	public static function get_object_type() {
		return new Type(self::OBJECT_TYPE, "Rarity");
	}
}
