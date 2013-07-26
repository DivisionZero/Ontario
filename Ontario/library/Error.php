<?
class Error extends Object {
	const OBJ_TYPE = 1;
	public function __construct($id, $name, $desc = null) {
		parent::__construct($id, $name, self::get_type(), $desc);
	}

	public static function get_type() {
		return new Type(self::OBJ_TYPE, 'Error');
	}
}
