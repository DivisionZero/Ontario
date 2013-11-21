<?
include_once("_include.php");

class RarityTest extends PHPUNit_Framework_TestCase {
	public static function test_get_probability() {
		$rarity = new Rarity(1, 0.5);
		self::assertTrue(is_numeric($rarity->get_probability()));
		$rarity = new Rarity(2, 0.4);
		self::assertTrue(is_numeric($rarity->get_probability()));
		$rarity = new Rarity(6, 0.1, 'super rare');
		self::assertTrue(is_numeric($rarity->get_probability()));
	}
}
