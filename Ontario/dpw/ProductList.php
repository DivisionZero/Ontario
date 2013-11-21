<?
class ProductList extends RarityObjectList {
	public function __construct($products = null) {
		parent::__construct(Product::get_object_type(), $products);
	}	
}
