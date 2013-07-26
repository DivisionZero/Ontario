<?
class ObjectList  implements Iterator {
	protected $list = array();
	private $position;
	private $count = 0;

	public function __construct($anything = array()) {
		if($anything instanceof ObjectList) {
			$this->list = $anything->get_list();
		} else if (is_array($anything)) {
			if(count($anything)) {
				if(self::validate_object_list($anything)) {
					$this->list = $anything;
				} else {
					throw new Exception("Constructor must be Object, ObjectList or empty array");
				}
			} else {
				$this->list = array();
			}
		} else if ($anything === null) {
			$this->list = array();
		} else if ($anything instanceof Object) {
			$this->list[] = $anything;
		} else {
			throw new Exception("Constructor must be Object, ObjectList, or empty array");
		}
		$this->reindex_array();
	}

	public static function validate_object_list(array $list) {
		foreach($list as $key=>$value) {
			if(!$value instanceof Object) {
				return false;
			}
		}
		return true;
	}

	public function add_element($object) {
		if($object instanceof Object) {
			$this->list[] = $object;
		} else if ($object instanceof ObjectList) {
			$this->list = array_merge($this->list, $object->get_list());
		} else {
			throw new Exception("Parameter must be an Object or ObjectList");
		}
		$this->reindex_array();
	}

	public function get_list() {
		return $this->list;
	}

	public function get_object($object_id, $only_one = true) {
		return $this->find_object($object_id, 'get_id');
	}

	public function get_object_by_name($object_name, $only_one = true) {
		return $this->find_object($object_name, 'get_name');
	}

	/* Iterator Methods */

	public function current() {
		if(!self::valid()) {
			return null;
		} else {
			return $this->list[$this->position];
		}
	}

	public function key() {
		return $this->position;
	}

	public function next() {
		$this->position++;
	}

	public function rewind() {
		if($this->count > 0) {
			$this->position = 0;
		} else {
			$this->position = null;
		}
	}

	public function valid() {
		if($this->position === null) {
			return false;
		} else if ($this->count === $this->position) {
			return false;
		} else {
			return true;
		}
	}

	/* private methods */
	private function reindex_array() {
		$this->count = count($this->list);
		$this->rewind();
	}
	
	private function find_object($target, $function) {
		$obj_list = array();
		foreach($this->list as $obj) {
			if($obj->$function() == $target) {
				if($only_one === true) {
					return $obj;
				} else {
					$obj_list[] = $obj;
				}
			}
		}
		return count($obj_list) > 0 ? $obj_list : null;
	}
}
