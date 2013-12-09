<?
class Object extends DefaultList {
	private static $next_id=1;
	private $id;
	private $name;
	
	public function __construct($id = null, $name) {
		if ($id === null) {
			$this->id = $this->get_next_id();
		} else {
			$this->id = $id;
			if(!Valid::id($this->id)) {
				throw new Exception("ID is not valid: ".$this->id);
			}
			self::$next_id = $this->id + 1;
		}
		if (!is_string($name)) {
			throw new Exception("Name must be a string");
		}
		$this->name = $name;
	}

	public function get_id() {
		return $this->id;
	}

	public function get_name() {
		return $this->name;
	}

	private function get_next_id() {
		$next = self::$next_id;
		self::$next_id++;
		return $next;
	}
}
