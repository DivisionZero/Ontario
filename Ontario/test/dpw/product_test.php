<?
include_once("_include.php");

class ProductTest extends PHPUNit_Framework_TestCase {
	public static function test_get_price() {
		$price = make_price();
		$rarity = make_rarity();
		$product = new Product(1, 'Diamonds', $price, $rarity);
		$price = $product->get_price();
		self::assertTrue(is_numeric($price));
		$product->make_spike_high();
		$price = $product->get_price();
		self::assertTrue(is_numeric($price));
		$product->make_spike_low();
		$price = $product->get_price();
		self::assertTrue(is_numeric($price));
	}

}
