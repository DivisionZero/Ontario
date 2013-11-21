<?
include_once("_include.php");

class PocketListTest extends PHPUNit_Framework_TestCase {
	public static function test_add_pockets() {
		$pocketlist = new PocketList(make_product_list());
		self::assertTrue($pocketlist->add_pockets(50));
		self::assertTrue($pocketlist->add_pockets(50));
		self::assertTrue(!$pocketlist->add_pockets(50));
		self::assertTrue($pocketlist->add_pockets(-50));
	}

	public static function test_add_product() {
		$pocketlist = new PocketList(make_product_list());
		self::assertTrue($pocketlist->add_product(make_product(1, 'Diamond'), 50));
		self::assertTrue($pocketlist->add_product(make_product(2, 'Pearls'), 40));
		self::assertTrue(!$pocketlist->add_product(make_product(3, 'Sapphires'), 50));
		self::assertTrue($pocketlist->add_product(make_product(1, 'Diamond'), 5));
		self::assertTrue($pocketlist->add_pockets(50));
		self::assertTrue($pocketlist->add_product(make_product(3, 'Sapphires'), 50));
		//$pocketlist->add_product(make_product(10, 'bad'),1);
	}

	public static function test_remove_product() {
		$pocketlist = new PocketList(make_product_list());
		self::assertTrue($pocketlist->add_product(make_product(2, 'Pearls'), 5));
		self::assertTrue(!$pocketlist->remove_product(make_product(2, 'Pearls'), 10));
		self::assertTrue(!$pocketlist->remove_product(make_product(1, 'Diamonds'), 5));
	}
}
