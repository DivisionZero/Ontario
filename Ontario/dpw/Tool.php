<?
class Tool extends Object {
	const OBJECT_TYPE = 9;
	const DEFAULT_PRICE = 400;

	public function __construct($id, $name) {
		parent::__construct($id, $name, self::get_object_type());
		$this->add_default('price', self::DEFAULT_PRICE);
	}

	public function get_price() {
		return $this->get_value('price');
	}

	public static function get_object_type() {
		return new Type(self::OBJECT_TYPE, 'Tool');
	}
}
