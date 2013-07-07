<?
class TypeObjectList  extends ObjectList {
	private $type_id;

	public function __construct($anything = array()) {
		parent::__construct($anything);
		$this->validate_list($this->list);
	}

	private function validate_list(array $list) {
		foreach($list as $key=>$value) {
			$this->check_type($value->get_type());
		}
		return true;
	}

	private function check_type($check) {
		if(!isset($this->type_id)) {
			$this->type_id = $check;
		} else {
			if($this->type_id !== $check) {
				throw new Exception("TypeObjectList must have objects of the same type");
				return false;
			}
		}
		return true;
	}

	public function add_element($object) {
		parent::add_element($object);
		$this->check_type($object->get_type());
	}
}
