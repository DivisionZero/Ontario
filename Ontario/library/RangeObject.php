<?
class RangeObject extends Object {
	private $range;

	public function __construct($id, $name, Range $range) {
		parent::__construct($id, $name);
		$this->range = $range;
	}
}
