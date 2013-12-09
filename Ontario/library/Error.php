<?
class Error extends Object {
	private $desc;

	public function __construct($id, $name, $desc = null) {
		parent::__construct($id, $name);
		$this->desc = $desc;
	}
}
