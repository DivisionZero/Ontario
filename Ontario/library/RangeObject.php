<?
class RangeObject extends Object {
	private $range;

	const OBJ_TYPE = 2;
	public function __construct($id, $name, Range $range) {
		$type = new Type(self::OBJ_TYPE, 'RangeObject');
		parent::__construct($id, $name, $type);
		$this->range = $range;
	}
}
