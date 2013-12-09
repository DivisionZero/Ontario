<?
class Player extends Object { // extends Fighter
	const OBJECT_TYPE = 5;
	const DEFAULT_MONEY = 0;
	const DEFAULT_DEBT = 10000;
	public $pockets;
	//private $money;
	private $has_tool;

	public function __construct($id, $name, ProductList $product_list, $default_pockets = PocketList::DEFAULT_POCKETS, $max_pockets = PocketList::DEFAULT_MAX_POCKETS) {
		parent::__construct($id, $name, self::get_object_type());
		$this->pockets = new PocketList($product_list, $default_pockets, $max_pockets);
		$this->add_default('money', self::DEFAULT_MONEY);
		$this->add_default('debt', self::DEFAULT_DEBT);
	}

	public function change_money($amount) {
		if(Valid::positive_int($amount)) {
			//$this->money = $amount;
			$this->set_current('money', $amount);
			return true;
		}
		return false;
	}

	public function change_debt($amount) {
		if(Valid::positive_int($amount)) {
			//$this->debt = $amount;
			$this->set_current('debt', $amount);
			return true;
		}
		return false;
	}

	public function add_money($amount) {
		return $this->change_money($amount + $this->get_value('money'));
	}

	public function add_debt($amount) {
		return $this->change_debt($amount + $this->get_value('debt'));
	}

	public static function get_object_type() {
		return new Type(self::OBJECT_TYPE, 'Player');
	}

	public function get_tool() {
		$this->has_tool = true;
	}

	public function has_tool() {
		return $this->has_tool;
	}

	public function get_money() {
		return $this->get_value('money');
	}
}
