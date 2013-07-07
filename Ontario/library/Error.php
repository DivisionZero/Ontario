<?
class Error extends Object {
	const OBJ_TYPE = 1;
	public function __construct($id, $name, $desc = null) {
		$type = new Type(self::OBJ_TYPE, 'Error');
		parent::__construct($id, $name, $type, $desc);
	}
}
