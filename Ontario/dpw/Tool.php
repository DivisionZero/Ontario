<?
class Tool extends Object {
	const OBJECT_TYPE = 9;
	const DEFAULT_PRICE = 400;
	private $price;

	public function __construct($id, $name, $price = self::DEFAULT_PRICE) {
		parent::__construct($id, $name, self::get_object_type());
		$this->price = $price;
	}

	public function get_price() {
		return $this->price;
	}

	public static function get_object_type() {
		return new Type(self::OBJECT_TYPE, 'Tool');
	}
}
