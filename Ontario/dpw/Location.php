<?
class Location extends Object {
	const OBJECT_TYPE = 4;
	private $has_bank;
	private $event_list;
	public $products;

	public function __construct($id, $name, $has_bank) {
		parent::__construct($id, $name, new Type(self::OBJECT_TYPE, 'Location'));
		$this->has_bank = $has_bank;
		$this->products = new ProductList();
	}

	public function add_product(Product $product) {
		$this->products->add_element($product);
	}

	public function add_product_list(ProductList $productlist) {
		$this->products = $productlist;
	}
}
