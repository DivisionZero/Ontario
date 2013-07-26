<?
class Object {
	private static $next_id=1;
	private $id;
	private $name;
	private $desc;
	private $type;	
	
	public function __construct($id = null, $name = null, Type $type = null, $desc = null) {
		$this->id = $id === null ? $this->get_next_id() : $id;
		if(!Valid::id($this->id)) {
			throw new Exception("ID is not valid: ".$this->id);
		}
		$this->type = $type;
		$this->name = $name === null ? $this->create_name() : $name;
		$this->desc = $desc;
	}

	public function get_id() {
		return $this->id;
	}

	public function get_name() {
		return $this->name;
	}

	public function get_desc() {
		return $this->desc;
	}

	public function get_type_name() {
		return $this->type->get_name();
	}

	public function get_type() {
		return ($this->type !== null) ? $this->type : null;
	}

	private function create_name() {
		if($this->type !== null) {
			$type_name = $this->type->get_name();
		}
		if(isset($type_name)) {
			return $this->id.":{$type_name}";
		} else {
			return '';
		}
	}

	private function get_next_id() {
		$next = self::$next_id;
		self::$next_id++;
		return $next;
	}
}
