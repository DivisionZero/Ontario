<?
include_once("_include.php");

class PriceTest extends PHPUNit_Framework_TestCase {
	public static function test_reset_prices() {
		$range1 = new Range(1,300);
		$sp1 = new Spike(10, 30);
		$sp2 = new Spike(1, 330);
		$pr1 = new Price($range1, $sp1, $sp2);
		self::assertTrue(is_numeric($pr1->get_price()));
		$pr1->reset_prices();
		self::assertTrue(is_numeric($pr1->get_price()));
		$pr1->reset_prices(155);
		self::assertTrue(is_numeric($pr1->get_price()));

		$range2 = new Range(100,3000, 2300);
		$sp3 = new Spike(101, 30);
		$sp4 = new Spike(12, 30);
		$pr2 = new Price($range2, $sp3, $sp4);
		self::assertTrue(is_numeric($pr2->get_price()));
		$pr1->reset_prices();
		self::assertTrue(is_numeric($pr2->get_price()));
		$pr1->reset_prices(155);
		self::assertTrue(is_numeric($pr2->get_price()));
	}
}
