<?
class PocketList {
	const DEFAULT_POCKETS = 100;
	const DEFAULT_MAX_POCKETS = 200;
	private $product_list;
	private $pockets;
	private $max_pockets;
	private $pocket_count;
	private $filled_pockets;

	public function __construct(ProductList $product_list, $starting_pockets = self::DEFAULT_POCKETS, $max_pockets = self::DEFAULT_MAX_POCKETS) {
		$this->product_list = $product_list;
		$this->pocket_count = $starting_pockets;
		$this->max_pockets = $max_pockets;
		$this->filled_pockets = 0;
	}

	public function get_pocket_count() {
		return $this->pocket_count;
	}

	public function add_pockets($num) {
		$total = $num + $this->pocket_count;
		if($total > $this->max_pockets) {
			$this->pocket_count = $this->max_pockets;
			return false;
		} else {
			if($total < 0) {
				$this->pocket_count = 0;
				return false;
			} else {
				$this->pocket_count = $total;
				return true;
			}
		}
	}

	public function add_product(Product $product, $quantity) {
		$product_id = $product->get_id();
		$total = $quantity + $this->filled_pockets;
		if($total <= $this->pocket_count) {
			//$this->pocket_count = $total;
			$this->filled_pockets = $total;
			$found = $this->product_list->get_object($product_id);
			if($found !== null) {
				if(isset($pockets[$product_id])) {
					$pockets[$product_id] += $quantity;
				} else {
					$pockets[$product_id] = $quantity;
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
			if(isset($pockets[$product_id]) && $pockets[$product_id] >= $quantity) {
				$this->filled_pockets = $total;
				$pockets[$product_id] -= $quantity;
				return true;
			} 
		} 
		return false;
	}
}
