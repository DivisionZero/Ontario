<?
class TypeObjectList extends ObjectList {
	private $type;

	public function __construct($anything = array(), $type) {
		$this->type = $type;
		parent::__construct($anything);
		$this->validate_list($this->list);
	}

	private function validate_list(array $list) {
		foreach($list as $key=>$value) {
			$this->check_type($value);
		}
		return true;
	}

	private function check_type(Object $value) {
		if ($value instanceof $this->type) {
			return true;
		} else {
			throw new Exception("Object must be of type {$this->type}");
		}
	}

	public function add_element($object) {
		parent::add_element($object);
		$this->check_type($object);
	}
}
