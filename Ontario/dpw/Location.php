<?
class Location extends Object {
	private $has_bank;
	private $event_list;
	private $products;

	public function __construct($id, $name, $has_bank) {
		const OBJECT_TYPE = 4;
		parent::__construct($id, $name, new Type(self::OBJECT_TYPE, 'Location'));
		$this->has_bank = $has_bank;
		$this->products = new ProductList();
	}

	public function add_product(Product $product) {
		$this->products->add_element($product);
	}
}
