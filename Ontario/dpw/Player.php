<?
class Player extends Object { // extends Fighter
	const OBJECT_TYPE = 5;
	const DEFAULT_MONEY = 0;
	const DEFAULT_DEBT = 10000;
	private $pockets;
	private $money;

	public function __construct($id, $name, ProductList $product_list, $default_pockets = PocketList::MAX_POCKETS, $max_pockets = PocketList::MAX_DEFAULT_POCKETS) {
		parent::__construct($id, $name, self::get_type());
		$this->pockets = new PocketList($product_list, $default_pockets, $max_pockets);
	}

	public function change_money($amount) {
		if(Valid::positive_int($amount)) {
			$this->money = $amount;
			return true;
		}
		return false;
	}

	public function change_debt($amount) {
		if(Valid::positive_int($amount)) {
			$this->debt = $amount;
			return true;
		}
		return false;
	}

	public function add_money($amount) {
		return $this->change_money($amount + $this->money);
	}

	public function add_debt($amount) {
		return $this->change_debt($amount + $this->debt);
	}

	public static function get_type() {
		return Type(self::OBJECT_TYPE, 'Player');
	}

	public function get_pocket_list() {
		return $this->pockets;
	}
}