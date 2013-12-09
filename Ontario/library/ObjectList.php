<?
class ObjectList implements Iterator {
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

	public function remove_element(Object $object) {
		$index = $this->find_object_index($object);
		if(!is_null($index)) {
			unset($this->list[$index]);
			$this->reindex_array();
			return true;
		} else {
			return false;
		}
	}

	public function get_list() {
		return $this->list;
	}

	public function get_object($object_id, $only_one = true) {
		if(!is_numeric($object_id)) {
			if($object_id instanceof Object) {
				$object_id = $object_id->get_id();
			} else {
				throw new Exception("Parameters must be either an object or object id");
			}
		}
		return $this->find_object($object_id, 'get_id', $only_one);
	}

	public function get_object_by_name($object_name, $only_one = true) {
		return $this->find_object($object_name, 'get_name', $only_one);
	}

	public function get_object_by_index($index) {
		if(isset($this->list[$index])) {
			return $this->list[$index];
		} else {
			return null;
		}
	}

	public function count() {
		return count($this->list);
	}

	public function update_object(Object $object, $only_one = true) {
		$found = false;
		foreach($this->list as $num => $object_element) {
			if($object->get_id() == $object_element->get_id() && 
			   $object->get_type()->get_id() == $object_element->get_type()->get_id()) {
				$this->list[$num] = $object;
				$found = true;
				if($only_one === true) {
					return true;
				}
			}
		}
		return $found;
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
		$this->list = array_values($this->list);
		$this->rewind();
	}


	private function find_object_index(Object $target) {
		foreach($this->list as $index=>$obj) {
			if($obj->get_id() == $target->get_id()) {
				return $index;
			}
		}
		return null;
	}

	private function find_object($target, $function, $only_one = true) {
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
