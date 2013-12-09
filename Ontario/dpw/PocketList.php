<?
class PocketList {
	const DEFAULT_POCKETS = 100;
	const DEFAULT_MAX_POCKETS = 200;
	private $product_list;
	private $pockets;
	//private $max_pockets;
	//private $pocket_count;
	private $filled_pockets;

	public function __construct(ProductList $product_list) {
		$this->product_list = $product_list;
		$this->add_default('starting_pockets', self::DEFAULT_POCKETS);
		$this->add_default('max_pockets', self::DEFAULT_MAX_POCKETS);
		//$this->pocket_count = $starting_pockets;
		//$this->max_pockets = $max_pockets;
		$this->filled_pockets = 0;
		$this->pockets = [];
	}

	public function get_pocket_count() {
		return $this->get_value('pocket_count');
	}

	public function get_max_pockets() {
		return $this->get_value('max_pockets');
	}

	public function get_random_product() {
		$keys = array_keys($this->pockets);
		$count = count($keys);
		if ($count > 0) {
			$rand = rand(0, $count - 1);
			return $this->product_list->get_object($keys[$rand]);
		} else {
			return null;
		}
	}

	public function get_product_count(Product $product) {
		$product_id = $product->get_id();
		if (isset($this->pockets[$product_id])) {
			return $this->pockets[$product_id];
		} else {
			return 0;
		}
	}

	public function add_pockets($num) {
		$total = $num + $this->get_pocket_count();
		if($total > $this->max_pockets) {
			$this->set_value('pocket_count', $this->get_max_pockets());
			return false;
		} else {
			if($total < 0) {
				$this->set_value('pocket_count', 0);
				return false;
			} else {
				$this->set_value('pocket_count', $total);
				return true;
			}
		}
	}

	public function add_product(Product $product, $quantity) {
		$product_id = $product->get_id();
		$total = $quantity + $this->filled_pockets;
		if($total <= $this->get_pocket_count()) {
			$this->filled_pockets = $total;
			$found = $this->product_list->get_object($product_id);
			if($found !== null) {
				if(isset($this->pockets[$product_id])) {
					$this->pockets[$product_id] += $quantity;
				} else {
					$this->pockets[$product_id] = $quantity;
				}
				return true;
			} else {
				throw new Exception("Cannot add product not in the constructor ProductList");
				return false;
			}
		} else {
			return false;
		}
	}

	public function remove_product(Product $product, $quantity) {
		$product_id = $product->get_id();
		$total = $this->filled_pockets - $quantity;
		if($total > 0) {
			if(isset($this->pockets[$product_id]) && $this->pockets[$product_id] >= $quantity) {
				$this->filled_pockets = $total;
				$this->pockets[$product_id] -= $quantity;
				return true;
			} 
		} 
		return false;
	}
}
