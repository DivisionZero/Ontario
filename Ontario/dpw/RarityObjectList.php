<?
class RarityObjectList extends TypeObjectList {
	private $rarity_pool;

	public function __construct(Type $object_type, $objects = array()) {
		parent::__construct($objects, $object_type);
		$this->rarity_pool = new RarityPool();
		foreach($this->list as $object) {
			if(!($object instanceof RarityObject)) {
				throw new Exception("All objects must be RarityObjects");
			}
			$this->rarity_pool->add_rarity($object->get_rarity());
		}
	}

	public function get_random_object() {
		return $this->get_random_objects(1)->get_object_by_index(0);
	}

	public function get_range_objects(Range $range) {
		$objectlist = new ObjectList($this->list);
		$count = $range->get_random();
		return $this->get_random_objects($count);
	}

	public function get_random_objects($count = 1) {
		if(!is_numeric($count)) return new ObjectList();
		$return = array();

		$objectlist = new ObjectList($this->list);
		while($count > 0) {
			$object = $this->choose_one_object();
			if($object->allows_stack_dupes() === false) {
				$objectlist->remove_element($object);	
			}
			$return[] = $object;
			$count--;
			if($objectlist->count() === 0) {
				break;
			}
		}
		return new ObjectList($return);
	}

	private function choose_one_object() {
		$index = $this->rarity_pool->choose_rarity_index();
		return $this->get_object_by_index($index);
	}

	public function add_element(RarityObject $object) {
		parent::add_element($object);
		$this->rarity_pool->add_element($object->get_rarity());
	}

	public function remove_element(RarityObject $object) {
		parent::remove_element($object);
		$this->rarity_pool->remove_element($object->get_rarity());
	}
}
