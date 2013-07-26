<?
class TypeObjectList extends ObjectList {
	private $type;

	public function __construct($anything = array(), Type $type = null) {
		$this->type = $type;
		parent::__construct($anything);
		$this->validate_list($this->list);
	}

	private function validate_list(array $list) {
		foreach($list as $key=>$value) {
			$this->check_type($value->get_type());
		}
		return true;
	}

	private function check_type(Type $check = null) {
		if(!isset($this->type)) {
			$this->type = $check;
		} else {
			if($this->type->get_id() !== $check->get_id()) {
				throw new Exception("TypeObjectList expecting objects of type: ".$this->type->get_id().":".$this->type->get_name());
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
