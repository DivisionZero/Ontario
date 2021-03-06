<?
class UniqueObjectList extends TypeObjectList {
	private $id_array;

	public function __construct($anything = array(), $type) {
		parent::__construct($anything, $type);
		$this->id_array = array();
		$this->validate_list($this->list);
	}

	private function validate_list(array $list) {
		foreach($list as $key=>$value) {
			$this->add_id($value->get_id());
		}
	}

	private function add_id($id) {
		if(in_array($id, $this->id_array)) {
			throw new Exception("UniqueObjectList must have unique objects");
		} else {
			$this->id_array[] = $id;
		}
	}

	public function add_element($object) {
		parent::add_element($object);
		$this->add_id($object->get_id());
	}

	public function get_object($object_id) {
		return parent::get_object($object_id, true);
	}

	public function get_object_by_name($object_name) {
		return parent::get_object_by_name($object_name, true);
	}
}
